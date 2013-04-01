<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Posts extends CI_Controller {

	function index()
	{
		redirect(base_url());
	}
	
	function moderate()
	{

		$posts = $this->mo9a7i_model->get_posts(array('status_id'=>4,'moderate'=>TRUE));
		$posts_to_skip = $this->mo9a7i_model->get_posts_to_skip();
		foreach($posts as $key => $post)
		{
			if(in_array($post->id,$posts_to_skip))
			{
				unset($posts[$key]);
			}
		}
		
		//Finally, Show random post
		
		$data['title'] = "مراقبة النكت";
		$data['posts'] = array_values($posts);
		if(count($data['posts']) > 0)
		{
			$data['up_votes'] 	= $this->mo9a7i_model->get_votes($data['posts'][0]->id,2,'1');
			$data['down_votes']	= $this->mo9a7i_model->get_votes($data['posts'][0]->id,2,'-1');
		}
		$data['total_rows'] = 1;
		$data['main_content'] = 'posts/moderate';
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
			$data['posts'] = $this->mo9a7i_model->get_posts(array('slug'=>$slug));
			if(count($data['posts']) == 0)
			{
				redirect('posts/posts');
			}
			$this->mo9a7i_model->set_views(array('resource_id'=>$data['posts'][0]->id,'resource_type'=>2));
			$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$data['posts'][0]->id,'resource_type'=>2));
			//$data['replies'] = $this->mo9a7i_model->get_replies(array('resource_id'=>$data['posts'][0]->id));
			
			$data['title'] = $data['posts'][0]->title;
			$data['description'] = $this->mo9a7i_model->sanitize_text($data['posts'][0]->content);
			$data['keywords'] = $data['posts'][0]->tags;
			$data['total_rows'] = 1;
			$data['main_content'] = '/posts/posts_item';
			$this->load->view('includes/template', $data);
		}
	}
	
	function id($id = null)
	{
		if(is_null($id))
		{
			redirect('posts/posts');
		}
		else
		{
			
			$this->mo9a7i_model->set_views(array('resource_id'=>$id,'resource_type'=>2));
			
			$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$id,'resource_type'=>2));
			$data['replies'] = $this->mo9a7i_model->get_replies(array('resource_id'=>$id));
			
			$data['posts'] = $this->mo9a7i_model->get_posts(array('post_id'=>$id));
			
			$data['description'] = $this->mo9a7i_model->sanitize_text($data['posts'][0]->content);
			$data['title'] = $data['posts'][0]->title;
			$data['total_rows'] = 1;
			$data['main_content'] = '/posts/posts_item';
			$this->load->view('includes/template', $data);
		}
	}
}