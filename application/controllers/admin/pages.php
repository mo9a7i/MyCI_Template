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
class Pages extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/pages/index';
		$config['total_rows'] = $this->db->get('pages')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_pages();
		$data['main_content'] = 'admin/pages/pages';
		$this->load->view('admin/includes/template', $data);
	}
	
	function add()
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')
		);
		$data['main_content'] = 'admin/pages/pages_add';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{		
		$id = $this->input->post('id');
		$edit = (empty($id) ? FALSE : TRUE );
		
		$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => 'News Title', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'content', 
                     'label'   => 'News content', 
                     'rules'   => 'trim|required'
                  )
            );
		
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (!$edit)redirect(base_url().'admin/pages/add');
			else redirect(base_url().'admin/pages/edit/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');
						
			//Set $data
			$data = array(
				'title' => $this->input->post('title'),
				'slug' => $this->input->post('slug'),
				'content' => $this->input->post('content'),
				'date_added' => $this->input->post('date_added'),
				'status_id' => $this->input->post('status_id'),
				'user_id' => $this->mo9a7i_model->get_user_id()
			);
			
			
			if (!$edit)
			{
				$this->mo9a7i_model->add_pages($data);
				redirect(base_url().'admin/pages');
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_pages($data,$id);
				redirect(base_url().'admin/pages');
			}
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
			redirect(base_url().'admin/pages');
		}
		$data['records'] = $this->mo9a7i_model->get_pages(array('page_id'=>$id));
		$data['main_content'] = 'admin/pages/pages_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($id = null)
	{
		if (is_null($id))
		{
			redirect(base_url().'admin/pages');
		}
		
		$data['records'] = $this->mo9a7i_model->get_pages(array('page_id'=>$id));
		$data['main_content'] = 'admin/pages/pages_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_pages(array('id'=>$id));
		redirect(base_url().'admin/pages');
	}
}