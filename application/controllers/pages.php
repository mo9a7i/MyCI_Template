<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Pages extends CI_Controller {

	function index()
	{
		$data['title'] = "خطأ";
		$data['main_content'] = 'pages/pages';
		$this->load->view('includes/template', $data);
	}
	
	
	function by_slug($slug)
	{
		if(is_null($slug))
		{
			redirect('posts/posts');
		}
		else
		{
			$slug = rawurldecode($slug);
			$data['pages'] = $this->mo9a7i_model->get_pages(array('slug'=>$slug));
			if(count($data['pages']) == 0)
			{
				redirect('pages/pages');
			}
			$this->mo9a7i_model->set_views(array('resource_id'=>$data['pages'][0]->id,'resource_type'=>3));
			$data['replies'] = $this->mo9a7i_model->get_replies(array('resource_id'=>$data['pages'][0]->id,'resource_type'=>3));
			$data['title'] = $data['pages'][0]->title;
			
			$keyword = new stdClass;
			$keyword->title = $data['pages'][0]->title;
			$data['keywords'] = array($keyword);
			
			$data['total_rows'] = 1;
			$data['main_content'] = '/pages/page_item';
			$this->load->view('includes/template', $data);
		}
	}
	
	function id($id = null)
	{
		if(is_null($id))
		{
			redirect('pages/pages');
		}
		else
		{
			$this->mo9a7i_model->set_views(array('resource_id'=>$id,'resource_type'=>3));
			$data['replies'] = $this->mo9a7i_model->get_replies(array('resource_id'=>$id,'resource_type'=>3));
			$data['pages'] = $this->mo9a7i_model->get_pages(array('page_id'=>$id));
			
			$data['title'] = $data['pages'][0]->title;
			
			$keyword = new stdClass;
			$keyword->title = $data['pages'][0]->title;
			$data['keywords'] = array($keyword);
			
			
			$data['total_rows'] = 1;
			$data['main_content'] = '/pages/page_item';
			$this->load->view('includes/template', $data);
		}
	}
}