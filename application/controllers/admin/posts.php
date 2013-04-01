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
class Posts extends CI_Controller{

	function index()
	{
		$config['base_url'] = base_url().'admin/posts/index';
		$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('status_id'=>1,'nolimit'=>TRUE)));
		
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records'] = $this->mo9a7i_model->get_posts(array('status_id'=>1));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/posts/posts';
		$this->load->view('admin/includes/template', $data);
	}
	
	function pending()
	{
		$config['base_url'] = base_url().'admin/posts/pending';
		$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('status_id'=>4,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_posts(array('status_id'=>4));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/posts/posts_pending';
		$this->load->view('admin/includes/template', $data);
	}
	
	function deleted()
	{
		$config['base_url'] = base_url().'admin/posts/deleted';
		$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('status_id'=>3,'nolimit'=>TRUE)));
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records'] = $this->mo9a7i_model->get_posts(array('status_id'=>3));
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'admin/posts/posts_deleted';
		$this->load->view('admin/includes/template', $data);
	}
	
	function activate($id = null)
	{
		$this->mo9a7i_model->activate_post(array('id'=>$id));
		redirect(base_url().'admin/posts/pending');
	}
	
	function add()
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')
		);
		$data['main_content'] = 'admin/posts/posts_add';
		$this->load->view('admin/includes/template', $data);
	}
	
	function submit()
	{
		$id = $this->input->post('id');
		$edit = (empty($id) ? FALSE : TRUE );
		
		$config = array(
               array(
                     'field'   => 'title', 
                     'label'   => 'posts Title', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'content', 
                     'label'   => 'posts content', 
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'date_added', 
                     'label'   => 'Addition Date', 
                     'rules'   => 'trim|required'
                  )
            );

		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			if (!$edit)redirect(base_url().'admin/posts/add');
			else redirect(base_url().'admin/posts/edit/'.$id);
		}
		else
		{
			//Set Success Message
			$this->session->set_flashdata('success', 'تم حفظ المعلومات بنجاح');
						
			//Set $data
			$data = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'date_added' => $this->input->post('date_added'),
				'date_modified' => date('Y-m-d H:i:s'),
				'status_id' => $this->input->post('status_id'),
				'slug' => $this->input->post('slug'),
				'user_id' => $this->mo9a7i_model->get_user_id()
			);
			
			if (!$edit)
			{
				$id = $this->mo9a7i_model->add_posts($data);
			}
			else
			{
				//Edit
				$this->mo9a7i_model->edit_posts($data,$id);
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
				redirect(base_url().'admin/posts');
				}
				else
				{
					redirect(base_url().'admin/posts/edit/'.$id);
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
					'resource_type' => 2
				);
				$image_id = $this->mo9a7i_model->add_images($data);
				redirect(base_url().'admin/jcrop/thumbnailize/'.$image_id);
			}	
		}
	}
	
	function edit($id = null)
	{
		$data['ckeditor'] = array(
 			'id' 	=> 	'content',
			'path'	=> 'assets/js/ckeditor',
			'config' => array('toolbar'=>'Mo9a7iToolbar')

		);
		$data['image'] = $this->mo9a7i_model->get_image(array('resource_id'=>$id,'resource_type'=>2));
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_posts(array('post_id'=>$id));
		else redirect(base_url().'admin/posts/');
		$data['records'] = $this->mo9a7i_model->get_posts(array('post_id'=>$id));
		$data['tags'] = $this->mo9a7i_model->get_post_tags($id,2);
		$data['main_content'] = 'admin/posts/posts_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_posts(array('post_id'=>$id));
		else redirect(base_url().'admin/posts');
		$data['main_content'] = 'admin/posts/posts_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		$this->mo9a7i_model->delete_posts($id);
		redirect(base_url().'admin/posts');
	}
}