<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('email','pagination','OAuth2',/*'cli'*/'table','database','form_validation','session','template','ion_auth','user_agent','twitter','Curl');

$autoload['helper'] = array('date','cookie','url','form','file','download','directory','mo9a7i_helper','ckeditor','text');

$autoload['config'] = array('validation_rules','email');

$autoload['language'] = array();

$autoload['model'] = array('ion_auth_model','mo9');

/* End of file autoload.php */
/* Location: ./application/config/autoload.php */