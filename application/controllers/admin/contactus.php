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
class Contactus extends CI_Controller{

	function index()
	{
	
		$config['base_url'] = base_url().'admin/contactus/link';
		$config['total_rows'] = $this->db->get('contactus_messages')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['records'] = $this->mo9a7i_model->get_contactus();
		$data['main_content'] = 'admin/contactus/contactus';
		$this->load->view('admin/includes/template', $data);
	}
	
	function view($id=null)
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')
		);
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_contactus($id);
		else redirect(base_url().'admin/contactus');
		$data['records'] = $this->mo9a7i_model->get_contactus($id);
		
		$data['replies'] = $this->mo9a7i_model->get_contactus_replies($id);
		$data['main_content'] = 'admin/contactus/view_message';
		$this->load->view('admin/includes/template', $data);
	}
	
	function reply()
	{
		$id = $this->input->post('id');
		
		$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => 'Reply Title', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'content', 
                     'label'   => 'Reply content', 
                     'rules'   => 'trim|required'
                  )
            );
		
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url().'admin/contactus/view/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ الرد!');
						
			//Set $data
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'date_added' => $this->input->post('news_date'),
				'resource_id' => $this->input->post('id'),
				'resource_type' => 5,
				'user_id' => $this->mo9a7i_model->get_user_id()
			);

			$sent = $this->mo9a7i_model->send_email($this->Settings->site_title, $this->Settings->admin_email, $this->input->post('send_to'), $this->input->post('title'), $this->input->post('content'));
	
			if($sent)
			{
				$data['status_id'] = 1;
				$this->mo9a7i_model->contactus_message_reply($data);
				$this->session->set_flashdata('success', 'تم الإرسال بنجاح!');
				redirect(base_url().'admin/contactus');
			}
			else
			{
				$data['status_id'] = 2;
				$this->mo9a7i_model->contactus_message_reply($data);
				$this->session->set_flashdata('error', 'تم حفظ الرد بقاعدة البيانات, ولكن لم يتم الإرسال!');
				redirect(base_url().'admin/contactus');
				//show_error($this->email->print_debugger());
			}
		}
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_contactus($id);
		else redirect(base_url().'admin/contactus');
		$data['main_content'] = 'admin/contactus/delete_message';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$id = array('id'=>$id);
		$this->mo9a7i_model->contactus_message_delete($id);
		$this->session->set_flashdata('success', 'تم مسح الرسالة بنجاح!');
		redirect(base_url().'admin/contactus');
	}
}