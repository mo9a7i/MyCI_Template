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
* For Admin control panel testing and interaction
*/
class Emails extends CI_Controller{

	function index()
	{
		$data['main_content'] = 'admin/email_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function settings()
	{
		$data['main_content'] = 'admin/email_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit_settings()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">خطأ!</h4>', '</div>');
		$config = array(
               array(
                     'field'   => 'mail_protocol', 
                     'label'   => 'Protocol', 
                     'rules'   => 'trim|required'
                  )
                  
            );

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'admin/emails/settings';
			$this->load->view('admin/includes/template', $data);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');

			//Set $data
			$data = array(
						'mail_protocol' => $this->input->post('mail_protocol'),
						'smtp_host' => $this->input->post('smtp_host'),
						'smtp_port' => $this->input->post('smtp_port'),
						'smtp_user' => $this->input->post('smtp_user'),
						'smtp_password' => $this->input->post('smtp_password')
					);
					
			//Call Model
			$this->mo9a7i_model->update_settings($data);
			redirect(base_url().'admin/emails/settings');
		}
	}	
}