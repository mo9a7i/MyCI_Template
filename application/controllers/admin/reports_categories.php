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
class Reports_categories extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/reports_categories/index';
		$config['total_rows'] = $this->db->get('reports_categories')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_reports_categories();
		$data['main_content'] = 'admin/reports/categories';
		$this->load->view('admin/includes/template', $data);
	}
	
	function edit($id)
	{
		$data['records'] = $this->mo9a7i_model->get_news_categories($id);
		$data['main_content'] = 'admin/news/categories_edit';
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
			if (is_null($id))redirect(base_url().'admin/news_categories');
			else redirect(base_url().'admin/news_categories/edit/'.$id);
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
				$this->mo9a7i_model->add_news_categories($data); //New category
				redirect(base_url().'admin/news_categories');
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_news_categories($data,$id); //Edit category 
				redirect(base_url().'admin/news_categories');	
			}
		}
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_news_categories($id);
		else redirect(base_url().'admin/news_categories');
		$data['main_content'] = 'admin/news/categories_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_news_categories(array('id'=>$id));
		redirect(base_url().'admin/news_categories');
	}
}