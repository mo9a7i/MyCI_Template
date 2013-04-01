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
class Reports extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/reports/index';
		$config['total_rows'] = $this->db->get('reports')->num_rows();
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records'] = $this->mo9a7i_model->get_reports();
		$data['main_content'] = 'admin/reports/reports';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_report_by_id($id);
		else redirect(base_url().'admin/reports');
		$data['main_content'] = 'admin/reports/reports_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_report($id);
		redirect(base_url().'admin/reports');
	}
}