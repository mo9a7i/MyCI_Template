<h1>إعدادات التذاكر</h1>
<div id="body">
<?php echo form_open('admin/tickets_settings_submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<h2>خيارات عامة</h2>

<?php
$options = array(array('label' => 'مفعل','value' => '1'),array('label' => 'معطل','value' => '0'));
radio_item('وضع الصيانة','maintenance',$options,'عند تفعيل وضع الصيانة, جميع صفحات الموقع سيتم إغلاقها عن الزوار والأعضاء ماعدا لوحة الإدارة'); 
 ?>

<?php text_box_item('إسم الموقع','site_title',$this->Settings->site_title,'أكتب هنا إسم الموقع ليظهر في أعلى المتصفح وبالرئيسية'); ?>
<?php text_box_item('وصف الموقع','site_description',$this->Settings->site_description,'إكتب هنا وصف الموقع وهو ما سيأتي ملاحقاً لإسم الموقع'); ?>
	
	
	<?php text_box_item('بريد الإدارة','admin_email',$this->Settings->admin_email,'البريد الرئيسي لتحويل رسائل إتصل بنا وغيره من رسائل الموقع'); ?>
	

		<div class="form-actions">
            <?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
            <?php echo form_reset(array('class'=>'btn btn-default','value'=>'إلغاء الأمر')); ?>
          </div>

</fieldset>		
<?php echo form_close(); ?>
</div>