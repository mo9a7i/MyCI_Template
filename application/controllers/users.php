<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Users extends CI_Controller {

	function index()
	{
		$data['title'] = "قائمة الأعضاء";
		$config['base_url'] = base_url().'users/index';
		$config['total_rows'] = count($this->mo9a7i_model->get_users(array('nolimit'=>TRUE,'status_id'=>1)));
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		//List of users
		$data['users'] = $this->mo9a7i_model->get_users(array('status_id'=>1));
		$data['main_content'] = 'users/users';
		$this->load->view('includes/template', $data);
	}
	
	function by_name($username)
	{
		if(is_null($username))
		{
			redirect('users/users');
		}
		else
		{
			$username = rawurldecode($username);
			$data['user'] = $this->mo9a7i_model->get_users(array('username'=>$username));
			if(count($data['user']) == 0)
			{
				redirect('users/users');
			}
			$data['comments'] = $this->mo9a7i_model->get_replies(array('user_id'=>$data['user'][0]->id,'limit'=>15));
			$data['jokes'] = $this->mo9a7i_model->get_posts(array('user_id'=>$data['user'][0]->id,'limit'=>15));
			$data['title'] = $data['user'][0]->username." | الأعضاء";
			$data['description'] = $this->mo9a7i_model->sanitize_text($data['user'][0]->bio);
			$keyword = new stdClass;
			$keyword->title = $data['user'][0]->username;
			$data['keywords'] = array($keyword);
			$data['total_rows'] = 1;
			$data['main_content'] = '/users/user_item';
			$this->load->view('includes/template', $data);
			

			
		}
	}
	
	function id($id = null)
	{
		//profile page of a user
		if(is_null($id))
		{
			redirect('users/users');
		}
		else
		{	
			$data['user'] = $this->mo9a7i_model->get_users(array('user_id'=>$id));
			$data['comments'] = $this->mo9a7i_model->get_replies(array('user_id'=>$id,'limit'=>15));
			$data['jokes'] = $this->mo9a7i_model->get_posts(array('user_id'=>$id,'limit'=>15));
			$data['title'] = $data['user'][0]->username." | الأعضاء";
			$data['description'] = $this->mo9a7i_model->sanitize_text($data['user'][0]->bio);
			$keyword = new stdClass;
			$keyword->title = $data['user'][0]->username;
			$data['keywords'] = array($keyword);
			$data['total_rows'] = 1;
			$data['main_content'] = '/users/user_item';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit_profile()
	{
		$id = $this->mo9a7i_model->get_user_id();
		$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$id));
		if (is_null($id))
		{
			redirect(base_url().'users/');
		}
		
		$data['records'] = $this->mo9a7i_model->get_users(array('user_id'=>$id));
		$data['title'] = "تعديل الملف الشخصي";
		$data['main_content'] = 'users/profile_edit';
		$this->load->view('includes/template', $data);
	}
	
	function edit_profile_submit()
	{
		$id = $this->mo9a7i_model->get_user_id();
		$current_data = $this->mo9a7i_model->get_users(array('user_id'=>$id));
		$edit = TRUE;
		//echo $this->input->post('user_email').':'.$current_data[0]->email;die();
		if($this->input->post('user_email') != $current_data[0]->email)
		{
			$config = array(
				   array(
						 'field'   => 'user_email', 
						 'label'   => 'User Email Address', 
						 'rules'   => 'trim|required|valid_email|is_unique[users.email]'
					  )			  
				);
		}
		else
		{
			$config = array(
				   array(
						 'field'   => 'user_email', 
						 'label'   => 'User Email Address', 
						 'rules'   => 'trim|required|valid_email'
					  )			  
				);
		}
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{	
			$this->session->set_flashdata('error', validation_errors());
			redirect(base_url().'users/edit_profile');
		}
		else
		{
			//die('OK');
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');

			//Set $data
			$data = array(
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'email' => $this->input->post('user_email'),
			);
			

			$this->mo9a7i_model->edit_user($data,$id);
			$user_id = $id;
			//Insert user in groups
			
			//Set $Meta
			$meta = array(
				'user_id' => $user_id,
				'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'last_name' => $this->input->post('last_name'),
				'phone' => $this->input->post('phone_number'),
				'show_phone' => $this->input->post('show_phone'),
				'show_email' => $this->input->post('show_email'),
				'bb_pin' => $this->input->post('bb_pin'),
				'show_bb_pin' => $this->input->post('show_bb_pin'),
				'bio' => $this->input->post('user_bio'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'country' => $this->input->post('country'),
				'gender' => $this->input->post('gender'),
				'adult_content' => $this->input->post('adult_content'),
			);
				//Create Meta
			$this->mo9a7i_model->edit_meta($meta,$user_id);
			
			//Check image and upload
			$config = array(
				'allowed_types' => 'jpg|jpe|bmp|gif|png',
				'upload_path' => realpath(APPPATH . '../uploads/images/'),
				'max_size' => 200000,
				'encrypt_name' => TRUE,
				'remove_spaces' => TRUE
			);
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('Filedata'))
			{
				redirect(base_url().'users/edit_profile');
			}
			else
			{ 
				$info = $this->upload->data();
				$data = array(
					'image_name' => $info['orig_name'],
					'server_name' => $info['file_name'],
					'date_added' =>  date('Y-m-d H:i:s'),
					'user_id' => $this->mo9a7i_model->get_user_id(),
					'resource_id' => $id,
					'resource_type' => 1
				);
				$image_id = $this->mo9a7i_model->add_images($data);
				redirect(base_url().'jcrop/thumbnailize/'.$image_id);
			}	
			
			redirect(base_url().'users/edit_profile');
		}
	}
	
	
	
	
}