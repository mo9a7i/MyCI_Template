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
class Tags extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/tags/index';
		$config['total_rows'] = $this->db->get('tags')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_tags();
		$data['main_content'] = 'admin/tags/tags';
		$this->load->view('admin/includes/template', $data);
	}
	
	function edit($id)
	{
		$data['records'] = $this->mo9a7i_model->get_tags(array('tag_id'=>$id));
		$data['main_content'] = 'admin/tags/tags_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		$config = array(
			   array(
					 'field'   => 'title', 
					 'label'   => 'Tag title', 
					 'rules'   => 'trim|required'
				  )
			);
		
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (is_null($id))redirect(base_url().'admin/tags');
			else redirect(base_url().'admin/tags/edit/'.$id);
		}
		else 
		{
			$this->session->set_flashdata('success', 'تم إضافة القسم  بنجاح!'); //Set Success Message
			
			//Set $data
			$data = array(
						'title' => $this->input->post('title'),
						'slug' => $this->mo9a7i_model->create_slug($this->input->post('slug')),
						'description' => $this->input->post('description'),
						'count' => $this->input->post('count')
					);
					
			//Call Model
			if (empty($id))
			{
				$this->mo9a7i_model->add_tags($data); //New category
				redirect(base_url().'admin/tags');
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_tags($data,$id); //Edit category 
				redirect(base_url().'admin/tags');	
			}
		}
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_tags(array('tag_id'=>$id));
		else redirect(base_url().'admin/tags');
		$data['main_content'] = 'admin/tags/tags_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_tags($id);
		redirect(base_url().'admin/tags');
	}
}