<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
/**
* For Admin control panel testing and interaction
*/
class Users extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/users/index';
		$config['total_rows'] = count($this->mo9a7i_model->get_users(array('status_id'=>1,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records'] = $this->mo9a7i_model->get_users(array('status_id'=>1));
		$data['main_content'] = 'admin/users/users';
		$this->load->view('admin/includes/template', $data);
	}
	
	function pending()
	{
		$config['base_url'] = base_url().'admin/users/pending';
		$config['total_rows'] = count($this->mo9a7i_model->get_users(array('status_id'=>4,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_users(array('status_id'=>4));
		$data['main_content'] = 'admin/users/users_pending';
		$this->load->view('admin/includes/template', $data);
	}
	
	function deleted()
	{
		$config['base_url'] = base_url().'admin/users/deleted';
		$config['total_rows'] = count($this->mo9a7i_model->get_users(array('status_id'=>3,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_users(array('status_id'=>3));
		$data['main_content'] = 'admin/users/users_deleted';
		$this->load->view('admin/includes/template', $data);
	}
	
	function activate($id = null)
	{
		$this->mo9a7i_model->activate_user(array('id'=>$id));
		
		// Send user a notification email
		$user = $this->mo9a7i_model->get_users(array('user_id'=>$id));
		$this->mo9a7i_model->email_activated_user($user[0]->email);
		
		redirect(base_url().'admin/users/pending');
	}
	
	function add()
	{
		$data['main_content'] = 'admin/users/users_add';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		$edit = (empty($id) ? FALSE : TRUE );
		$config = array(
               array(
                     'field'   => 'user_email', 
                     'label'   => 'User Email Address', 
                     'rules'   => 'trim|required|valid_email'
                  )               
            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (!$edit)redirect(base_url().'admin/users/add');
			else redirect(base_url().'admin/users/edit/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');

			//Set $data
			$data = array(
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'username' => $this->input->post('user_name'),
				'email' => $this->input->post('user_email'),
				'active' => $this->input->post('status_id')
			);
			
			//Generate Password and Salt 
			$password = $this->input->post('password');
			if(!empty($password))
			{
				$salty = $this->ion_auth_model->salt();
				$password = $this->ion_auth_model->hash_password($this->input->post('password'),$salty);
				$data['password'] = $password;
				$data['salt'] = $salty;
			}

			if(!$edit)
			{
				$data['created_on'] = time();

				//Create User
				$this->mo9a7i_model->add_user($data);
				//Get User ID
				$user_id = $this->db->insert_id();
				//Insert user in groups
				$this->ion_auth->add_to_group($this->input->post('user_group'), $user_id); //This is ion_auth function, the edit is not.
			}
			else
			{
				$this->mo9a7i_model->edit_user($data,$id);
				$user_id = $id;
				//Insert user in groups
				$this->mo9a7i_model->edit_users_groups(array('group_id' =>$this->input->post('user_group')), $user_id);
			}

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
			if(!$edit)
			{
				//Create Meta
				$this->mo9a7i_model->add_meta($meta);
			}
			else
			{
				//Create Meta
				$this->mo9a7i_model->edit_meta($meta,$user_id);
			}
			
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
				if(!$edit){
				$this->session->set_flashdata('error', 'حصل خطأ اثناء رفع الصورة الرمزية: '.$this->upload->display_errors('<p>', '</p>'));
				redirect(base_url().'admin/users');
				}
				else
				{
					redirect(base_url().'admin/users/edit/'.$id);
				}
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
				redirect(base_url().'admin/jcrop/thumbnailize/'.$image_id);
			}	
			
			redirect(base_url().'admin/users');
		}
	}
	
	function edit($id = null)
	{
		$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$id));
		if (is_null($id))
		{
			redirect(base_url().'admin/users/');
		}
		$data['records'] = $this->mo9a7i_model->get_users(array('user_id'=>$id));
		$data['main_content'] = 'admin/users/users_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	
	function delete($id = null)
	{
		if (is_null($id))
		{
			redirect(base_url().'admin/users');
		}
		
		$data['records'] = $this->mo9a7i_model->get_users(array('user_id'=>$id));
		$data['main_content'] = 'admin/users/users_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_user($id);
		redirect(base_url().'admin/users');
	}

}
