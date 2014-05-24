<?php
if ($this->Settings->maintenance && !$this->ion_auth->is_admin())
{
	echo "عذراً, الموقع مغلق حاليا للصيانة, زورونا في وقت لاحق!";
	exit(0);
}
if (isset($_SERVER['HTTP_USER_AGENT'])  AND (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
        header('X-UA-Compatible: IE=edge,chrome=1');
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="ar" class="no-js"> <!--<![endif]-->

<html dir="rtl" lang="ar">
  <head>
  <?php $this->load->view('template/header_include'); ?>
  </head>
  <body>
    <!-- Fixed navbar -->
    <?php $this->load->view('template/navbar'); ?>
    <div class="container">
	
