<h1>إعدادات البريد</h1>
<div id="body">
<?php echo form_open('admin/emails/submit_settings',array('class'=>'form-horizontal')); ?>
<fieldset>
<h2>البريد والمراسلة</h2>
	<?php text_box_item('بروتوكول','mail_protocol',$this->Settings->mail_protocol,''); ?>
	<?php text_box_item('خادم SMTP','smtp_host',$this->Settings->smtp_host,''); ?>
	<?php text_box_item('منفذ SMTP','smtp_port',$this->Settings->smtp_port,''); ?>
	<?php text_box_item('إسم المستخدم','smtp_user',$this->Settings->smtp_user,''); ?>
	<?php text_box_item('كلمة المرور','smtp_password',$this->Settings->smtp_password,''); ?>


	
		<div class="form-actions">
            <?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
            <?php echo form_reset(array('class'=>'btn','value'=>'إلغاء الأمر')); ?>
          </div>

</fieldset>		
<?php echo form_close(); ?>
</div>