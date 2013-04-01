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
class Users_groups extends CI_Controller{

	function index()
	{
		
		$data['records'] = $this->mo9a7i_model->get_users_groups();
		$data['main_content'] = 'admin/users/groups';
		$this->load->view('admin/includes/template', $data);
	}
	
	function edit($id)
	{
		$data['records'] = $this->mo9a7i_model->get_users_groups($id);
		$data['main_content'] = 'admin/users/groups_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		
		$config = array(
			   array(
					 'field'   => 'name', 
					 'label'   => 'Category name title', 
					 'rules'   => 'trim|required'
				  )
			);
		
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (is_null($id))redirect(base_url().'admin/users_groups');
			else redirect(base_url().'admin/users_groups/edit/'.$id);
		}
		else 
		{
			$this->session->set_flashdata('success', 'تم إضافة التصنيف  بنجاح!'); //Set Success Message
			
			//Set $data
			$data = array(
						'name' => $this->input->post('name')
					);
					
			//Call Model
			if (empty($id))
			{
				$this->mo9a7i_model->add_groups($data); //New category
				redirect(base_url().'admin/users_groups');
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_groups($data,$id); //Edit category 
				redirect(base_url().'admin/users_groups');	
			}
		}
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_users_groups($id);
		else redirect(base_url().'admin/users_groups');
		$data['main_content'] = 'admin/users/groups_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_groups(array('id'=>$id));
		redirect(base_url().'admin/users_groups');
	}
}