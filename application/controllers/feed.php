<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feed extends CI_Controller {

	function __construct()
	{  
		parent::__construct();

		$this->load->helper('xml');  
		$this->load->helper('text');  
	}
	
	function index()  
	{  
		$data['feed_name'] = 'F6sny.com'; // your website  
		$data['encoding'] = 'utf-8'; // the encoding  
		$data['feed_url'] = 'http://www.F6sny.com/feed'; // the url to your feed  
		$data['page_description'] = 'الموقع اللي تجيه عشان تفطس ضحك!'; // some description  
		$data['page_language'] = 'ar-ar'; // the language  
		$data['creator_email'] = 'admin@f6sny.com'; // your email  
		$data['posts'] = $this->mo9a7i_model->get_posts(array('limit'=>10,'status_id'=>1));    
		header("Content-Type: application/rss+xml"); // important!
		$this->load->view('rss', $data); 
	}  
}  