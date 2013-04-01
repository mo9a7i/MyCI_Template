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
class Dashboard extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('error', 'هذه الصفحة للمدراء فقط!');
			redirect(base_url().'home');
		}
	}
	
	function index()
	{
		$data['main_content'] = 'admin/dashboard';
		$this->load->view('admin/includes/template', $data);

	}
}