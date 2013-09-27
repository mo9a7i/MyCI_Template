<div id="body">
	<div class="page-header ">	
		<h1>إتصل بنا!</h1>	
	</div>
	<?php echo form_open('contactus/submit',array('class'=>'form-horizontal'));?>
	<fieldset>

		<?php text_box_item('البريد الإلكتروني','email_address','',''); ?>
		<?php text_box_item('إسمك','sender_name','',''); ?>
		<?php dropdown_item('نوع الرسالة','category_id','contactus_categories',FALSE,'1',$help='');?>
		<?php text_box_item('العنوان','title','',''); ?>
		<?php text_area_item('رسالتك','content','','','input-xxlarge'); ?>

		<div class="clear">
			<div class="form-actions">
				<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
				<?php echo form_reset(array('class'=>'btn btn-default','value'=>'إلغاء الأمر')); ?>
			</div>
		</div>

	</fieldset>
	<?php echo form_close();?>
</div>