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
class Annoucements extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/annoucements/index';
		$config['total_rows'] = $this->db->get('annoucements')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records'] = $this->mo9a7i_model->get_annoucements()->result();
		$data['main_content'] = 'admin/annoucements/annoucements';
		$this->load->view('admin/includes/template', $data);
	}
	
	function add()
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')
		);
		$data['main_content'] = 'admin/annoucements/annoucements_add';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		$edit = (empty($id) ? FALSE : TRUE );
		
		$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => 'annoucement Title', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'link', 
                     'label'   => 'annoucement link', 
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
			if (!$edit)redirect(base_url().'admin/annoucements/add');
			else redirect(base_url().'admin/annoucements/edit/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');
						
			//Set $data
			$data = array(
				'title' => $this->input->post('title'),
				'link' => $this->input->post('link'),
				'date_added' => $this->input->post('date_added'),
				'status_id' => $this->input->post('status_id')
				);
			
			if (!$edit)
			{
				$this->mo9a7i_model->add_annoucements($data);
				redirect(base_url().'admin/annoucements');
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_annoucements($data,$id);
				redirect(base_url().'admin/annoucements/edit/'.$id);
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
		$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$id,'resource_type'=>2));
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_annoucements($id);
		else redirect(base_url().'admin/annoucements/');
		$data['records'] = $this->mo9a7i_model->get_annoucements($id)->result();
		$data['main_content'] = 'admin/annoucements/annoucements_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_annoucements($id);
		else redirect(base_url().'admin/annoucements');
		$data['main_content'] = 'admin/annoucements/annoucements_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_annoucements(array('id'=>$id));
		redirect(base_url().'admin/annoucements');
	}
}