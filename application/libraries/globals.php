<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* F6sny.com 
* ===========
* code
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Globals
{
	public function __construct($config = array() )
	{
		foreach($config as $key => $value)
		{
			$data[$key] = $value;
		}
		$data['tags'] = $this->mo9->get_tags();
		//echo "Hi";die();
		
		$CI =& get_instance();
		$CI->load->vars($data);
	}
}