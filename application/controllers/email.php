<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
/**
* SENDS EMAIL WITH GMAIL
*/
class Email extends CI_Controller{

	function index()
	{
		$data['main_content'] = 'newsletter';
		$this->load->view('includes/template', $data);
	}
	function send() 
	{	
		//field name, error message, validation rules
		$this->form_validation->set_rules('name','Name', 'trim|required');
		$this->form_validation->set_rules('email','Email Address', 'trim|required|valid_email');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->index();
		}
		else
		{
			//validation has passed, send the email
			$name = $this->input->post('name');
			$email =  $this->input->post('email');
			

			$this->email->set_newline("\r\n");
			
			$this->email->from('mohannad.otaibi@gmail.com', 'Mohannad Otaibi');
			$this->email->to('mohannad.otaibi@gmail.com');	
			$this->email->subject('A new signup in your newsletter!');		
			$this->email->message('This fool has signed up, '.$name.' with this email: '. $email.' and that\'s it!');
					
			if($this->email->send())
			{
				//echo 'Your email was sent, fool.';
				$data['main_content'] = 'signup_confirmation';
				$this->load->view('includes/template', $data);
			}
			else
			{
				show_error($this->email->print_debugger());
			}	
		}
	}
}
/* End of file email.php */
/* Location: ./application/controllers/email.php */