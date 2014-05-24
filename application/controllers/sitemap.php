<?php
/**
* F6sny.com 
* ===========
* code
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Sitemap extends CI_Controller{
  
	function Sitemap()
    {
        parent::__construct();
            $this->load->library('sitemap_lib'); 
    }
    
    function index()
    {
        // Show the index page of each controller (default is FALSE)
        //$this->sitemap_lib->set_option('show_index', true);

        // // Exclude all methods from the "Test" controller
        // $this->sitemap->ignore('Test', '*');

        // // Exclude all methods from the "Job" controller
        // $this->sitemap->ignore('Job', '*');

        // // Exclude a list of methods from any controller
        // $this->sitemap->ignore('*', array('view', 'create', 'edit', 'delete'));

        // // Exclude this controller
        $this->sitemap_lib->ignore('Sitemap', '*'); 

        // Show the sitemap
		
		$data['title'] = "خريطة الموقع";
		$data['comments'] = $this->mo9->get_replies(array('status_id'=>1,'limit'=>100));
		$data['jokes'] = $this->mo9->get_posts(array('status_id'=>1,'limit'=>100));
		$data['main_content'] = 'sitemap';
		$this->load->view('template/template', $data);
		
		
        // echo '<h1>Sitemap</h1>';
        // echo $this->sitemap_lib->generate();
    }
}