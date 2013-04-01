<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Search extends CI_Controller {

	function index()
	{
		$data['main_content'] = 'search/search';
		$data['title'] = "البحث";
		$this->load->view('includes/template', $data);
	}
	
	function submit()
	{
		$keyword = $this->input->post('keyword');
		//show results
		if(is_null($keyword))
		{
			redirect('search');
		}
		else
		{
			$data['title'] = "بحث عن ".$keyword;
			$data['institutes'] = $this->mo9a7i_model->search_institutes($keyword);
			$data['faculty'] = $this->mo9a7i_model->search_users($keyword,TRUE);
			$data['posts'] = $this->mo9a7i_model->search_posts($keyword);
			$data['users'] = $this->mo9a7i_model->search_users($keyword,FALSE);
			$results = array(
				'keyword' => $keyword,
				'institutes' => count($data['institutes']),
				'faculty' => count($data['faculty']),
				'posts' => count($data['posts']),
				'users' => count($data['users'])
			);

			$data['results'] = $results ;
			$data['main_content'] = 'search/results';
			$this->load->view('includes/template', $data);
		}
	}
}