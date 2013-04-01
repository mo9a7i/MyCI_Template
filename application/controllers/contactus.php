<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Contactus extends CI_Controller{

	//The form
	function index()
	{
		$data['title'] = "إتصل بنا";
		$data['main_content'] = 'contactus';
		$this->load->view('includes/template', $data);
	}

	function submit()
	{
		$config = array(
               array(
                     'field'   => 'email_address', 
                     'label'   => 'News Title', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'content', 
                     'label'   => 'Message content', 
                     'rules'   => 'trim|required'
                  )
            );
		
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url().'contactus/');
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم إستلام رسالتك وسنقوم بالرد عليك قريباً!');
						
			//Set $data
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'sender_name' => $this->input->post('sender_name'),
				'email_address' => $this->input->post('email_address'),
				'date_added' => date('Y-m-d H:i:s'),
				'category_id' => $this->input->post('category_id')
				);
		
			$sent = $this->mo9a7i_model->send_email($this->input->post('sender_name'), $this->input->post('email_address'), $this->Settings->admin_email, "إتصل بنا: ".$this->input->post('title'), $this->input->post('content'));
			

			if($sent)
			{
				$data['status_id'] = 1;
				$this->mo9a7i_model->contactus_message_add($data);
				$this->session->set_flashdata('success', 'تم إستلام رسالتك بنجاح, وسيتم الرد عليك في أقرب فرصة ممكنة!');
			}
			else
			{
				$data['status_id'] = 2;
				$this->mo9a7i_model->contactus_message_add($data);
				$this->session->set_flashdata('success', 'تم إستلام رسالتك بنجاح, وسيتم الرد عليك في أقرب فرصة ممكنة!');
				//show_error($this->email->print_debugger());
			}
			redirect(base_url());
		}
	}
}
/* End of file contactus.php */
/* Location: ./application/controllers/contactus.php */