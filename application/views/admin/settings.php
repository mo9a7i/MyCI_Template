<div id="body">
	<div class="page-header">	
			<h1>إعدادات الموقع</h1>
	</div>
	<?php echo form_open('admin/settings/submit',array('class'=>'form-horizontal')); ?>
	<fieldset>
	<div class="row">
		<div class="col-md-6">
			<h2>خيارات عامة</h2>
			<?php
			$options = array(array('label' => 'مفعل','value' => '1'),array('label' => 'معطل','value' => '0'));
			settings_radio_item('رسالة الترحيب','welcome_message',$options,'رسالة الترحيب التي تظهر للزائر بأول زيارة للتعريف بالموقع.'); 

			$options = array(array('label' => 'نعم','value' => '1'),array('label' => 'لا','value' => '0'));
			settings_radio_item('تفعيل تقائي للردود','comment_auto_active',$options,'تفعيل التعليقات تلقائياً عند إضافتها.'); 

			$options = array(array('label' => 'نعم','value' => '1'),array('label' => 'لا','value' => '0'));
			settings_radio_item('السماح للزوار بالتعليق','visitor_comments',$options,''); 

			$options = array(array('label' => 'مفعل','value' => '1'),array('label' => 'معطل','value' => '0'));
			settings_radio_item('وضع الصيانة','maintenance',$options,'عند تفعيل وضع الصيانة, جميع صفحات الموقع سيتم إغلاقها عن الزوار والأعضاء ماعدا لوحة الإدارة'); 
			text_box_item('إسم الموقع','site_title',$this->Settings->site_title,'أكتب هنا إسم الموقع ليظهر في أعلى المتصفح وبالرئيسية'); 
			text_box_item('وصف الموقع','site_description',$this->Settings->site_description,'إكتب هنا وصف الموقع وهو ما سيأتي ملاحقاً لإسم الموقع'); 
			text_box_item('بريد الإدارة','admin_email',$this->Settings->admin_email,'البريد الرئيسي لتحويل رسائل إتصل بنا وغيره من رسائل الموقع'); 
			?>

		</div>
		<div class="col-md-6">
			<h2>خيارات مخصصة</h2>
			<?php
			$options = array(array('label' => 'مفعل','value' => '1'),array('label' => 'معطل','value' => '0'));
			settings_radio_item('التسجيل','registeration',$options,'عند تفعيل التسجيل, سيتم السماح للزوار بالتسجيل في الموقع'); 
			
			$options = array(array('label' => 'نعم','value' => '1'),array('label' => 'لا','value' => '0'));
			settings_radio_item('تفعيل تلقائي للأعضاء','auto_activate_user',$options,'عند تفعيل هذه الخاصية, سيتم تفعيل الأعضاء آلياً. عند إختيار (لا) سيتطلب تفعيل الأعضاء موافقة الإدارة أولاً'); 
			text_box_item('عدد التصويتات قبل الموافقة','up_votes_count',$this->Settings->up_votes_count,''); 
			text_box_item('عدد التصويتات قبل المسح','down_votes_count',$this->Settings->down_votes_count,''); 
			?>

			<h2>للمبرمجين</h2>
			<?php
			$options = array(array('label' => 'مفعل','value' => '1'),array('label' => 'غير مفعل','value' => '0'));
			settings_radio_item('إعدادات متقدمة','advanced_settings',$options,'ستظهر قائمة جانبية جديدة عند تفعيل هذا الخيار'); 
			 ?>
		</div>
	</div>
	<div class="row">
		<div class="form-actions">
			<?php 
			echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); 
			echo form_reset(array('class'=>'btn btn-default','value'=>'إلغاء الأمر')); 
			?>
		</div>
	</div>
	</fieldset>		
	<?php echo form_close(); ?>
</div>