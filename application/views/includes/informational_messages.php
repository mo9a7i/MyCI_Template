<?php
if ($this->Settings->maintenance && $this->ion_auth->is_admin())
{
	?>
		<div class="alert alert-error">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">تحذير!</h4>
		 وضع الصيانة مفعل, الرجاء إغلاقه من لوحة تحكم الإدارة!
		</div>
	<?php
}
?>

<?php
if($this->session->flashdata('success')!=FALSE)
{
	?>
		<div class="alert alert-success">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">تم!</h4>
		 <?php echo $this->session->flashdata('success'); ?>
		</div>
	<?php
}
if($this->session->flashdata('error')!=FALSE)
{
	?>
		<div class="alert alert-error">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">خطأ!</h4>
		 <?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php
}

if($this->session->flashdata('message')!=FALSE)
{
	 echo $this->session->flashdata('message');
}
?>
<?php if(false) : ?>
<div class="alert alert-error">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">تنبيه!</h4>
		 الموقع مازال تحت التطوير حالياً, للإستفسارات والإقتراحات يرجى التواصل معنا عن طريق <a href="<?=base_url()?>contactus"> فورم الإتصال بنا</a> وشكراً
</div>
<?php endif; ?>