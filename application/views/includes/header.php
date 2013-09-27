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
<?php $this->load->view('includes/header_include'); ?>
</head>
<body>
<!-- Breaking News --><?php // breaking_news(); ?><!-- Breaking News -->
<div class="container main">
	<header class="row">
		<div class="rainbow">
		</div>
		<?php $this->load->view('includes/login_bar'); ?>
		<?php $this->load->view('includes/reports'); ?>
		<div id="header-content">
			<div id="titleBar" class="row">
				<div class="col-md-4">
					<h1><a href="<?php echo base_url(); ?>" title="<?php echo $this->Settings->site_description; ?>"><img src="<?php echo base_url().'assets/img/f6snylogo.png'; ?>" alt="<?php echo $this->Settings->site_title; ?>" /></a></h1>
				</div>
				<div class="col-md-8">
					<div id="headerBanner" class="pull-left">
						<script type="text/javascript"><!--
						google_ad_client = "ca-pub-8882866984702449";
						/* F6sny Header */
						google_ad_slot = "3804844972";
						google_ad_width = 728;
						google_ad_height = 90;
						//-->
						</script>
						<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
						</script>

					</div>
				</div>
			</div>
			<?php $this->load->view('includes/informational_messages'); ?>
		</div>
	</header>
	<div class="row">
		<div class="col-md-9 add_shadow">
		<section>