<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Tags extends CI_Controller {

	function index()
	{
		redirect(base_url());
	}
	
	function by_slug($slug)
	{
		if(is_null($slug))
		{
			redirect('posts/posts');
		}
		else
		{
			$data['original_slug'] = $slug;
			$slug = rawurldecode($slug);
			# Get the tag_id
			$id = $this->mo9a7i_model->get_tagid_by_slug($slug)->id;
			$data['posts'] = $this->mo9a7i_model->get_posts(array('tag_id'=>$id,'status_id'=>1));
			if(count($data['posts']) == 0)
			{
				redirect('posts/posts');
			}
			$data['title'] = str_replace('-',' ',$slug);
			$config['base_url'] = base_url().'tag/'.urlencode($slug);
			$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('tag_id'=>$id,'nolimit'=>TRUE,'status_id'=>1)));
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			
			$data['total_rows'] = $config['total_rows'];
			$tag_name = $this->mo9a7i_model->get_tags(array('tag_id'=>$id));
			$data['tag_name'] = $tag_name[0]->title;
			$data['main_content'] = 'tags/tags';
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
			
			$config['base_url'] = base_url().'tags/id/'.$id;
			$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('tag_id'=>$id,'nolimit'=>TRUE,'status_id'=>1)));//$this->db->get('posts')->num_rows();
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['posts'] = $this->mo9a7i_model->get_posts(array('tag_id'=>$id,'status_id'=>1));
			$tag_name = $this->mo9a7i_model->get_tags(array('tag_id'=>$id));
			$data['tag_name'] = $tag_name[0]->title;
			$data['title'] = $data['tag_name'];
			$data['main_content'] = 'tags/tags';
			$this->load->view('includes/template', $data);
		}
	}
}