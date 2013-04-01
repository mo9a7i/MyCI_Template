<?php
if (!$this->ion_auth->is_admin())
{
	$this->session->set_flashdata('error', 'هذه الصفحة للمدراء فقط!');
	redirect('home');
	exit(0);
}

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>لوحة تحكم الإدارة</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo asset_url(); ?>css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="<?php echo asset_url(); ?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo asset_url(); ?>css/datepicker.css" rel="stylesheet">
	<link href="<?php echo asset_url(); ?>css/admin.css" rel="stylesheet">
	<link href="<?php echo asset_url(); ?>css/admin_rtl.css" rel="stylesheet">
	<link href="<?php echo asset_url(); ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo asset_url(); ?>css/jquery.Jcrop.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo asset_url(); ?>ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo asset_url(); ?>ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo asset_url(); ?>ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo asset_url(); ?>ico/apple-touch-icon-57-precomposed.png">
	
	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo asset_url(); ?>js/jquerydynelements/jquery-ui-1.8.2.custom.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/jquerydynelements/jquery-dynamic-form.js"></script>
	<script src="<?php echo asset_url(); ?>js/jcrop/jquery.Jcrop.js"></script>
	
	<?php jqup_head() ?>

  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
		<div class="row-fluid">
		<div class="span3">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
			<a class="brand" href="<?php echo base_url(); ?>"><?php echo $this->Settings->site_title; ?></a>
          
		  </div>
		  <div class="span9">
          <div class="nav-collapse">
            <ul class="nav">
             

			  <li class="navbar-text pull-left dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->ion_auth->user()->row()->username;?> <b class="caret"></b></a>
				<ul class="dropdown-menu" id="dropdown">
					<li><a href="auth/change_password">تعديل كلمة المرور</a></li>
					<li><a href="auth/logout">تسجيل خروج</a></li>
				</ul>
				</li>
            </ul>
          </div><!--/.nav-collapse -->
		  </div>
		  </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
	   <div class="span3">
          <?php $this->load->view('admin/includes/sidebar'); ?>
        </div><!--/span-->
        <div class="span9">
		<?php $this->load->view('admin/includes/informational_messages'); ?>