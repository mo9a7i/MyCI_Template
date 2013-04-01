<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
	$config['useragent']			= "MyCI_Template";
	$config['mailpath']				= "/usr/sbin/sendmail"; // or "/usr/bin/sendmail"
	$config['protocol']				= "smtp";
	$config['smtp_host']			= "smtp.gmail.com";
	$config['smtp_port']			= "587";
	$config['smtp_user']			= "";
	$config['smtp_pass']			= "";
	$config['mailtype']				= 'html';
	$config['charset']				= 'utf-8';
	$config['newline']				= "\r\n";
	$config['crlf']					= "\r\n";
	$config['wordwrap'] 			= FALSE;
