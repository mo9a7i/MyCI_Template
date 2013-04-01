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
class Fixthumbs extends CI_Controller{

	function index()
	{
		$images = $this->db->get('images')->result();
		foreach($images as $image)
		{
			if(is_file(FCPATH."uploads/images/thumbs/".$image->server_name))
			{
				echo "1";
			}
			else
			{
				echo '<a href='.base_url().'admin/jcrop/thumbnailize/'.$image->id.'>'.$image->server_name.'</a>';
			echo "<br />";
			}
				
		}
	}
}