<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* code
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			20/3/2013
*/
class Home extends CI_Controller {

	public function index()
	{
		$data['posts'] = $this->mo9->get_posts(array('status_id'=>1));
		$data['title'] = "الرئيسية";
		
		$config['base_url'] = base_url().'home/index';
		$config['total_rows'] = count($this->mo9->get_posts(array('status_id'=>1,'nolimit'=>TRUE)));
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
	
		$data['total_rows'] = $config['total_rows'];
		$data['main_content'] = 'home';
		$this->load->view('template/template', $data);
	}
	
	
	function facebook_adult()
	{
		$this->mo9->disable_filter();
		redirect(base_url().'tag/فوق-ثمانطعش');
	}
	
	function disable_filter()
	{
		$this->mo9->disable_filter();
		redirect($this->agent->referrer());

	}
	
	function enable_filter()
	{
		$this->mo9->enable_filter();
		redirect($this->agent->referrer());

	}
	
	function disable_welcome()
	{
		$this->mo9->disable_welcome();
		redirect(base_url());
	}
	
	function delete_replies($id = null)
	{
		if($this->ion_auth->is_admin())
			$this->mo9->delete_replies($id);
		redirect($this->agent->referrer());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */