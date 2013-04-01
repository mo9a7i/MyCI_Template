<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'myci_db';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* For migration use, from root.php controller, set the old DB information here */
$db['old']['hostname'] = "localhost";
$db['old']['username'] = "root";
$db['old']['password'] = "";
$db['old']['database'] = "myci_dbold";
$db['old']['dbdriver'] = "mysql";
$db['old']['dbprefix'] = "";
$db['old']['pconnect'] = TRUE;
$db['old']['db_debug'] = TRUE;
$db['old']['cache_on'] = FALSE;
$db['old']['cachedir'] = "";
$db['old']['char_set'] = "utf8";
$db['old']['dbcollat'] = "utf8_general_ci";


/* End of file database.php */
/* Location: ./application/config/database.php */