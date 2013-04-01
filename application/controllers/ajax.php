<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2013
*/
class Ajax extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		redirect(base_url());
	}
	
	function moderate()
	{
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$user_id = $this->mo9a7i_model->get_user_id();
		$resource_id = $this->input->post('resource_id');
		$resource_type = $this->input->post('resource_type');
		$value = $this->input->post('value');
		
		switch($value)
		{
			case "like": $value = "1" ; break;
			case "dislike": $value = "-1" ; break;
			case "skip": $value = "0" ; break;
			case "force_like": $value = $this->Settings->up_votes_count ; break;
			case "force_dislike": $value = $this->Settings->down_votes_count*-1 ; break;
			default: $value = "0";
		}
		
		if($value == $this->Settings->up_votes_count)
		{
			for($i = 1; $i <= $this->Settings->up_votes_count; $i++)
			{
				$this->mo9a7i_model->set_votes($resource_id,$resource_type,1);
			}
		}
		elseif($value == $this->Settings->down_votes_count*-1)
		{
			for($i = -1; $i >= $this->Settings->down_votes_count*-1; $i--)
			{
				$this->mo9a7i_model->set_votes($resource_id,$resource_type,-1);
			}
		}
		else
		{
			$this->mo9a7i_model->set_votes($resource_id,$resource_type,$value);
		}
		$this->mo9a7i_model->add_moderation_ip($resource_id,$ip_address,$user_id);
		
		$up_votes 	= $this->mo9a7i_model->get_votes($resource_id,$resource_type,'1');
		$down_votes	= $this->mo9a7i_model->get_votes($resource_id,$resource_type,'-1')*-1;
		$moderated_ips = $this->mo9a7i_model->get_moderation_ips($resource_id);
		
		$this->input->set_cookie('moderated_posts',$this->mo9a7i_model->appendstr($this->input->cookie('moderated_posts'),$resource_id),time() + (86400 * 10));
		
		if($up_votes >= $this->Settings->up_votes_count)
		{
			$this->mo9a7i_model->edit_posts(array('status_id'=>'1'),$resource_id);
			$tags = $this->get_post_tags($resource_id,2);
			$check = TRUE;
			foreach($tags as $tag)
			{
				if($tag->filtered)
				{
					$check = FALSE;
				}
			}
			if($check)
			{
				$this->mo9a7i_model->tweet($resource_id);
			}
		}
		
		if($down_votes >= $this->Settings->down_votes_count)
		{
			$this->mo9a7i_model->edit_posts(array('status_id'=>'3'),$resource_id);
		}
		
		return true;
		
	}

	function tweet()
	{
		$post_id = $this->input->post('resource_id');
		echo $this->mo9a7i_model->tweet($post_id);
	}
	
	function submit_vote()
	{
			//Set $data
			$data = array(
				'value' => $this->input->post('value'),
				'resource_id' => $this->input->post('resource_id'),
				'resource_type' => $this->input->post('resource_type')
			);
			$this->mo9a7i_model->set_votes($data['resource_id'],$data['resource_type'],$data['value']);
	}
	
	function ajax_edit_post()
	{
		$post_content = $this->input->post('value');
		$post_id = $this->input->post('pk');
		
		$this->mo9a7i_model->edit_posts(array('content'=>$post_content),$post_id);
	}
	
	function submit_post()
	{
		$tags_array = $this->input->post('tag');
		$clen = mb_strlen($this->input->post('content'),'utf-8');
		$error = "";
		if (empty($tags_array))
		{	
			$error="1";	
			echo "error1";	
		}
		elseif ($clen < 20)
		{	
			$error = "2";	
			echo "error2";	
		}
		elseif(mb_substr($this->input->post('content'),0,7,'utf-8') != "يقول لك")
		{
			//echo mb_substr($this->input->post('content'),0,7,'utf-8');
			$error = "3";	
			echo "error3";
		}

		if ($error == "")
		{	
			$title = $this->mo9a7i_model->create_slug($this->input->post('content'));
			$title = str_replace('-',' ',$title);
			$data = array(
				'title' => $title,
				'content' => $this->input->post('content'),
				'date_added' => date('Y-m-d H:i:s'),
				'date_modified' => date('Y-m-d H:i:s'),
				'status_id' => 4,
				'user_id' => ($this->mo9a7i_model->get_user_id()==0 ? 88 : $this->mo9a7i_model->get_user_id())
			);
			$id = $this->mo9a7i_model->add_posts($data);
			$this->mo9a7i_model->add_post_tags($id,2,$tags_array);
			echo "ok";	
		}
	}
	
	function get_replies($resource_id,$resource_type,$offset = 0)
	{
		$data['comments'] = $this->mo9a7i_model->get_replies(array('resource_id'=>$resource_id,'resource_type'=>$resource_type,'limit'=>'999','offset'=>$offset,'status_id'=>1));
		$this->load->view('posts/ajax_replies', $data);
	}
	
	function get_posts($offset = 0)
	{
		$data['posts'] = $this->mo9a7i_model->get_posts(array('offset'=>$offset,'status_id'=>1));
		$this->load->view('posts/ajax_posts', $data);
	}
	
	//For tags
	function get_posts_by_slug($slug,$offset = 0)
	{
		if(is_null($slug))
		{
			echo "";
		}
		else
		{
			
			$slug = rawurldecode($slug);
			$id = $this->mo9a7i_model->get_tagid_by_slug($slug)->id;
			$data['posts'] = $this->mo9a7i_model->get_posts(array('tag_id'=>$id, 'limit'=> 20,'status_id'=>1,'offset'=>$offset));
			if(count($data['posts']) == 0)
			{
				echo "";
			}
			
		}
		//echo count($data['posts']);die();
		$this->load->view('posts/ajax_posts', $data);
	}
	
	function submit_report()
	{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم إستلام بلاغك بنجاح!');
			
			//Set $data
			$data = array(
				'content' => $this->input->post('content'),
				'report_category' => $this->input->post('report_category'),
				'resource_type' => $this->input->post('resource_type'),
				'resource_id' => $this->input->post('resource_id'),
				'pathname' => $this->input->post('pathname'),
				'user_id' => $this->mo9a7i_model->get_user_id(),
				'date_added' => date('Y-m-d H:i:s'),
				'status_id' => 1
			);
				//Create User
				$check1 = $this->mo9a7i_model->add_report($data);
				//Get User ID
				echo $check1;
			if(!empty($check1))
				echo 1;
			else
				echo 2;
	}
	
	function check_username_availbility()
	{
		echo $this->mo9a7i_model->check_user_availbility($this->input->post('username'));
	}
	
	function check_email_availbility()
	{
		echo $this->mo9a7i_model->check_email_availbility($this->input->post('email'));
	}
	
	function register_user()
	{
		//Set Success Message
			$this->session->set_flashdata('success', 'تم تسجيلك بنجاح!');

			//Set $data
			if($this->Settings->auto_activate_user)
			{
				$status_id = 1;
			}
			else
			{
				$status_id = 4;
				$this->mo9a7i_model->email_not_active_user($this->input->post('email'));
			}
			$data = array(
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'active' => $status_id
			);
			
			//Generate Password and Salt 
				$password = $this->input->post('password');

				$salty = $this->ion_auth_model->salt();
				$password = $this->ion_auth_model->hash_password($this->input->post('password'),$salty);
				$data['password'] = $password;
				$data['salt'] = $salty;
			
				$data['created_on'] = date('Y-m-d H:i:s');

				//Create User
				$check1 = $this->mo9a7i_model->add_user($data);
				//Get User ID
				$user_id = $this->db->insert_id();
				//Insert user in groups
				$check2 = $this->ion_auth->add_to_group(2, $user_id); //This is ion_auth function, the edit is not.
				
				$data = array(
					'user_id' => $user_id,
				);
				$this->mo9a7i_model->add_meta($data);

			
			if($check1 AND $check2)
				echo 1;
			else
				echo 2;
	}
}