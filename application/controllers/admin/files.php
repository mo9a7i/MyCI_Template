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
class Files extends CI_Controller{

	function index()
	{
		$data['records'] = $this->mo9a7i_model->get_files();
		$data['main_content'] = 'admin/files/files';
		$this->load->view('admin/includes/template', $data);
	}
	
	
	
	function upload()
	{	

		$config = array(
			'allowed_types' => 'jpg|jpe|bmp|gif|png|ico|zip|rar|7z|doc|docx|xls|xlsx|pdf|ppt|pptx|avi|mpg|mpeg|avi|wmv|rm|ram|txt',
			'upload_path' => realpath(APPPATH . '../uploads/files/'),
			'max_size' => 200000,
			'encrypt_name' => TRUE,
			'remove_spaces' => TRUE
		);
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('Filedata'))
		{
			$this->session->set_flashdata('error', 'لم يتم رفع الملف للأسباب التالية: '.$this->upload->display_errors('<p>', '</p>'));
			redirect(base_url().'admin/files');
			
		}
		else
		{ 
			$this->session->set_flashdata('success', 'تم رفع الملف بنجاح');
			$info = $this->upload->data();
			$data = array(
				'file_name' => $info['orig_name'],
				'file_size' => $info['file_size'],
				'server_name' => $info['file_name'],
				'date_added' => now(),
				'user_id' => $this->mo9a7i_model->get_user_id(),
				'cat_id' => $this->input->post('cat_id'),
				'reference_id' => 1
			);
			$this->mo9a7i_model->add_files($data);
			redirect(base_url().'admin/files');
		}
	}
	
	function testy()
	{
		echo realpath(APPPATH . '../uploads/images/');
		
	}
	function jqueryUpload()
	{
		
		$upload_path_url = base_url().'uploads/';
		$upload_directory = realpath(APPPATH . '../uploads/images/');
		$thumbs_path_url = $upload_path_url.'thumbs';
		$thumbs_upload_directory = $upload_directory. '/thumbs';
		
		$config = array(
			'allowed_types' => 'jpg|jpe|bmp|gif|png|ico|zip|rar|7z|doc|docx|xls|xlsx|pdf|ppt|pptx|avi|mpg|mpeg|avi|wmv|rm|ram|txt',
			'upload_path' => $upload_directory,
			'max_size' => 200000,
			'encrypt_name' => TRUE,
			'remove_spaces' => TRUE
		);
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('userfile'))
		{	redirect(base_url().'admin/'.$this->upload->display_errors());
			$error = array('error' => $this->upload->display_errors());
			//die('Hi');
			$this->load->view('admin/files/files', $error);
			
		}
		else
		{ 		
			$data = $this->upload->data();
				
			// to re-size for thumbnail images un-comment and set path here and in json array	
			$config = array(
			'source_image' => $data['full_path'],
			'new_image' => $thumbs_upload_directory,
			'maintain_ration' => true,
			'width' => 80,
			'height' => 80
			);
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			
			//set the data for the json array	
			$info->name = $data['file_name'];
			$info->size = $data['file_size'];
			$info->type = $data['file_type'];
			$info->url = $upload_path_url .$data['file_name'];
			$info->thumbnail_url = $thumbs_path_url .$data['file_name'];
			$info->delete_url = base_url().'admin/files/delete_file/'.$data['file_name'];
			$info->delete_type = 'DELETE';
			
			if (IS_AJAX) 
			{   
				echo json_encode(array($info));
			}
			else 
			{   
				$file_data['upload_data'] = $this->upload->data();
				$this->load->view('admin/upload_success', $file_data);
			}
		}
	}
	
	function delete_file($file)
	{
		$success =unlink(FCPATH.'uploads/' .$file);
		//info to see if it is doing what it is supposed to	
		$info->sucess =$success;
		$info->path =base_url().'uploads/' .$file;
		$info->file =is_file(FCPATH.'uploads/' .$file);
		
		if (IS_AJAX) 
		{
			echo json_encode(array($info));
		}
		else 
		{     
			$file_data['delete_data'] = $file;
			$this->load->view('admin/delete_success', $file_data); 
		}
	}
	
	function ajaxUpload()
	{	
		$status = "";
		$msg = "";
		$file_element_name = 'Filedata';
		if ($status != "error")
		{
			$config = array(
				'allowed_types' => 'jpg|jpe|bmp|gif|png|ico|zip|rar|7z|doc|docx|xls|xlsx|pdf|ppt|pptx|avi|mpg|mpeg|avi|wmv|rm|ram|txt',
				'upload_path' => realpath(APPPATH . '../uploads/files/'),
				'max_size' => 200000,
				'encrypt_name' => TRUE,
				'remove_spaces' => TRUE
			);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload($file_element_name))
			{
				$status = 'error';
				$msg = $this->upload->display_errors('', '');
			}
			else
			{
				$info = $this->upload->data();
				$data = array(
					'file_name' => $info['orig_name'],
					'file_size' => $info['file_size'],
					'server_name' => $info['file_name'],
					'date_added' => now(),
					'user_id' => $this->mo9a7i_model->get_user_id(),
					'cat_id' => $this->input->post('cat_id'),
					'reference_id' => 1
				);
				$file_id = $this->mo9a7i_model->add_files($data);
	
				if($file_id)
				{
					$status = "success";
					$msg = "File successfully uploaded";
				}
				else
				{
					unlink($info['full_path']);
					$status = "error";
					$msg = "Something went wrong when saving the file, please try again.";
				}
			}
			@unlink($_FILES[$file_element_name]);
		}
	}
	
	function get($id = null)
	{
		$file = $this->mo9a7i_model->get_files($id);
		redirect(base_url() . 'uploads/files/'.$file[0]->server_name);
	}
	
	function delete($id = null)
	{
		if (!is_null($id))$data['records'] = $this->mo9a7i_model->get_files($id);
		else redirect(base_url().'admin/files');
		$data['main_content'] = 'admin/files/files_delete';
		$this->load->view('admin/includes/template', $data);
	}
	
	function confirm_delete($id = null)
	{
		if($this->mo9a7i_model->delete_files(array('id'=>$id)))
		{
			$this->session->set_flashdata('success', 'تم مسح الملف  بنجاح!');
		}
		else
		{
			$this->session->set_flashdata('error', 'لم يتم مسح الملف!');
		}
		redirect(base_url().'admin/files');
	}

	function test($session_id)
	{
		$this->mo9a7i_model->get_user_from_session($session_id);
	}
	
}