<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Replies extends CI_Controller {

	
	function submit()
	{
		$user_id = $this->mo9a7i_model->get_user_id();
		$author = $this->input->post('author');
		$author_email = $this->input->post('author_email');
		$author_url = $this->input->post('author_url');
		
		if($author_url == "موقعك")
		{
			$author_url = '';
		}
		
		if($user_id == 0)
		{
			if(!$author)
			{
				$this->session->set_flashdata('error', 'لازم تحط إسمك إذا منت مسجل دخول');
				redirect($this->agent->referrer());
			}
			elseif(!$author_email)
			{
				$this->session->set_flashdata('error', 'لازم تحط إيميلك إذا منت مسجل دخول');
				redirect($this->agent->referrer());
			}
			
			$visitor_info = array('author'=>$author,
									'author_email'=>$author_email,
									'author_url'=>$author_url
									);
			$visitor_cookie = json_encode($visitor_info);
			$this->input->set_cookie("visitor_info",$visitor_cookie,"432000000");
		}
		
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'resource_id' => $this->input->post('resource_id'),
			'resource_type' => $this->input->post('resource_type'),
			'date_added' =>  date('Y-m-d H:i:s'),
			'author' =>  $author,
			'author_email' =>  $author_email,
			'author_url' =>  $author_url,
			'author_ip' =>  $_SERVER['REMOTE_ADDR'],
			'user_id' => $user_id,
			'status_id' => 1
		);
		$this->mo9a7i_model->add_replies($data);
		redirect($this->agent->referrer());
	}
}