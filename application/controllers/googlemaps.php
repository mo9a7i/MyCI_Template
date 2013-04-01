<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Googlemaps extends CI_Controller {

	function index()
	{
		$data['title'] = "خرائط قوقل";
		$data['main_content'] = 'googlemaps/map';
		$this->load->view('includes/template', $data);

	}
}