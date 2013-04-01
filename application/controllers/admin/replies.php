<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Replies extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/replies/index';
		$config['total_rows'] = count($this->mo9a7i_model->get_replies(array('status_id'=>1,'nolimit'=>TRUE)));
		
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records'] = $this->mo9a7i_model->get_replies(array('status_id'=>1));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/replies/replies';
		$this->load->view('admin/includes/template', $data);
	}
	
	function pending()
	{
		$config['base_url'] = base_url().'admin/replies/pending';
		$config['total_rows'] = count($this->mo9a7i_model->get_replies(array('status_id'=>4,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_replies(array('status_id'=>4));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/replies/replies_pending';
		$this->load->view('admin/includes/template', $data);
	}
	
	function deleted()
	{
		$config['base_url'] = base_url().'admin/replies/deleted';
		$config['total_rows'] = count($this->mo9a7i_model->get_replies(array('status_id'=>3,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_replies(array('status_id'=>3));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/replies/replies_deleted';
		$this->load->view('admin/includes/template', $data);
	}
	
	function activate($id = null)
	{
		$this->mo9a7i_model->activate_reply(array('id'=>$id));
		redirect(base_url().'admin/replies/pending');
	}
	
	function add()
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')
		);
		$data['main_content'] = 'admin/replies/replies_add';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		$edit = (empty($id) ? FALSE : TRUE );
		
		$config = array(
				  array(
                     'field'   => 'content', 
                     'label'   => 'replies content', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'date_added', 
                     'label'   => 'Addition Date', 
                     'rules'   => 'trim|required'
                  )
            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (!$edit)redirect(base_url().'admin/replies/add');
			else redirect(base_url().'admin/replies/edit/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');
						
			//Set $data
			$data = array(
				'content' => $this->input->post('content'),
				'date_added' => $this->input->post('date_added'),
				'status_id' => $this->input->post('status_id'),
				//'user_id' => $this->mo9a7i_model->get_user_id()
			);
			
			if (!$edit)
			{
				$id = $this->mo9a7i_model->add_replies($data);
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_replies($data,$id);
			}

			redirect(base_url().'admin/replies/edit/'.$id);	
		}
	}
	
	function edit($id = null)
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')

		);
		if (is_null($id))
		{
			redirect(base_url().'admin/replies/');
		}
		$data['records'] = $this->mo9a7i_model->get_replies(array('id'=>$id));
		$data['main_content'] = 'admin/replies/replies_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($id = null)
	{
		if (!is_null($id))
		{
			$data['records'] = $this->mo9a7i_model->get_replies(array('id'=>$id));
		}
		else redirect(base_url().'admin/replies');
		$data['main_content'] = 'admin/replies/replies_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_replies($id);
		redirect(base_url().'admin/replies');
	}
}