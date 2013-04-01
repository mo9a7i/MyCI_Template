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
class Tickets extends CI_Controller{

	function index()
	{
		$data['main_content'] = 'admin/tickets';
		$this->load->view('admin/includes/template', $data);
	}
	
	function settings()
	{
		$data['main_content'] = 'admin/tickets_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function answered()
	{
		$data['main_content'] = 'admin/tickets_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function closed()
	{
		$data['main_content'] = 'admin/tickets_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
	function categories()
	{
		$data['main_content'] = 'admin/tickets_settings';
		$this->load->view('admin/includes/template', $data);
	}
	
}