<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			20/3/2013
*/
class Home extends CI_Controller {
	public function index()
	{
		$data['posts'] = $this->mo9a7i_model->get_posts(array('status_id'=>1));
		$data['title'] = "ÇáÑÆíÓíÉ";
		$config['base_url'] = base_url().'homeload/index';
		$config['total_rows'] = count($this->mo9a7i_model->get_posts(array('status_id'=>1,'nolimit'=>TRUE)));
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['main_content'] = 'homeload';
		$this->load->view('includes/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */