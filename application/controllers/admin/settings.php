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
class Settings extends CI_Controller{

	function index()
	{
		$data['main_content'] = 'admin/settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">خطأ!</h4>', '</div>');
		$config = array(
               array(
                     'field'   => 'site_title', 
                     'label'   => 'Site Title', 
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'admin_email', 
                     'label'   => 'Admin Email', 
                     'rules'   => 'trim|required|valid_email'
                  )
                  
            );

		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'admin/settings';
			$this->load->view('admin/includes/template', $data);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');

			//Set $data
			$data = array(
						'maintenance' => $this->input->post('maintenance'),
						'site_title' => $this->input->post('site_title'),
						'admin_email' => $this->input->post('admin_email'),
						'auto_activate_user' => $this->input->post('auto_activate_user'),
						'auto_activate_faculty' => $this->input->post('auto_activate_faculty'),
						'advanced_settings' => $this->input->post('advanced_settings'),
						'site_description' => $this->input->post('site_description'),
						'registeration' => $this->input->post('registeration'),
						'default_user_points' => $this->input->post('default_user_points'),
						'registeration_schedule' => $this->input->post('registeration_schedule'),
						'welcome_message' => $this->input->post('welcome_message'),
						'up_votes_count' => $this->input->post('up_votes_count'),
						'down_votes_count' => $this->input->post('down_votes_count'),
						'comment_auto_active' => $this->input->post('comment_auto_active'),
						'visitor_comments' => $this->input->post('visitor_comments'),
						
					);
					
			//Call Model
			$this->mo9a7i_model->update_settings($data);
			redirect(base_url().'admin/settings');
		}
	}
	

}
