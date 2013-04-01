<!-- Welcome Message -->

<?php if($this->mo9a7i_model->show_welcome()):?>
<div id="welcome" class="modal show ">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>مرحباً بك في فطسني.كوم</h3>
	</div>
	<div class="modal-body">
	<div class="alert alert-error">
		<h4 class="alert-heading">تنبيه!</h4>
		
	<p>ممنوع دخول الجادين واللي صدورهم ضيقة, إذا كان صدرك ضيقاً عزيزي الزائر,
	<a href="http://www.google.com.sa/search?hl=ar&amp;q=%D9%82%D8%B5%D8%B5+%D8%AD%D8%B2%D9%8A%D9%86%D8%A9+%D8%AC%D8%A7%D8%AF%D8%A9+%D8%B5%D8%A7%D8%AF%D9%82%D8%A9&amp;oq=%D9%82%D8%B5%D8%B5+%D8%AD%D8%B2%D9%8A%D9%86%D8%A9+%D8%AC%D8%A7%D8%AF%D8%A9+%D8%B5%D8%A7%D8%AF%D9%82%D8%A9&amp;aq=f&amp;aqi=&amp;aql=&amp;gs_sm=e&amp;gs_upl=1191l1191l0l1372l1l1l0l0l0l0l0l0ll0l0" style="color:#0054bb;">إضغط هنا</a> </p>
</div>
		<p>الموقع موقعكم, لاحد يستحي </p>
		<p>إذا ودكم تعطونا ملاحظاتكم, جربوا و  <a href="contactus">إتصلوا بنا</a></p>
	</div>
	<div class="modal-footer">
		<a href="<?=base_url();?>home/disable_welcome" class="btn">عدم الإظهار مرة أخرى</a>
	</div>
</div>
<?php endif;?>



<div id="body">
<div class="page-header">
	<div class="row-fluid">
		<div class="span6"><h1>آخر النكت</h1></div>
		<div class="span6"><!--<a style="font-weight:bold;font-size:16px;" class="pull-left" href="#">إخفاء / إظهار الردود</a>--></div>
	</div>
		
</div>
		<?php $this->load->view('rows/posts_rows.php'); ?>
		<?= $this->pagination->create_links();?>
			
</div>

