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
class Jcrop extends CI_Controller{

	var $dimension;
	function __construct()
	{
		parent::__construct();
		$this->dimension = 200;
	}

	function index()
	{	
		echo "You must have reached this by mistake";
	}
	
	function submit()
	{
		$post = $this->input->post();
		
		$src = realpath(APPPATH . '../uploads/images/'.$post['image_server_name']);
		$params['image'] = $src;
		$thumb_file_dir = str_replace('images','images/thumbs',$params['image']);
		
		$this->load->library('ImageManipulation' , $params);
		$objImage = new ImageManipulation($params);
		
		if ( $objImage->imageok ) 
		{
			$objImage->setCrop($post['x'],$post['y'], $post['w'],$post['h']);
			$objImage->resize($this->dimension);
			$objImage->save($thumb_file_dir);
			$this->session->set_flashdata('success', 'تم ضبط الصورة الرمزية بنجاح');
		} 
		else 
		{
			$this->session->set_flashdata('error', 'لم يتم ضبط الصورة الرمزية');
		}
		
		redirect($post['referrer']);
	}
	
	function thumbnailize($img_id = NULL)
	{
		$data['image'] = $this->mo9a7i_model->get_image_name($img_id);
		$data['image_dimensions'] = getimagesize(realpath(APPPATH . '../uploads/images/'.$data['image']->server_name));
		$data['referrer'] = $this->agent->referrer();
		$data['dimension'] = $this->dimension;
		$data['main_content'] = 'admin/jcrop/jcrop';
		$this->load->view('admin/includes/template', $data);
	}
	
	function delete($img_id = NULL)
	{
		if(!$img_id == NULL)
		{
			$this->mo9a7i_model->delete_thumbnail($img_id);
		}
		redirect($this->agent->referrer());
	}
	
}