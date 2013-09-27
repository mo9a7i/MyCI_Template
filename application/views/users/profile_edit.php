<div id="body">
	<div class="page-header">
		<h1>تعديل الملف الشخصي</h1>
		<p>قم بتعديل بياناتك الشخصية في هذه الصفحة, وتذكر أن تقوم بزيارتها للتحديث دورياً</p>
	</div>
	<div class="row">
		<?php echo form_open_multipart('users/edit_profile_submit',array('class'=>'form-horizontal')); ?>
		<div class="col-md-6">
		
				
				<h2>معلوماتك الرئيسية</h2>
				<?php echo form_hidden('id', $records[0]->id); ?>
				<?php text_box_item('البريد الإلكتروني','user_email',$records[0]->email,''); ?>
				<?php
				$options = array(array('label' => 'مفعل','value' => '1','check'=>$records[0]->show_email),array('label' => 'معطل','value' => '0','check'=>$records[0]->show_email));
				radio_item('عرض البريد الإلكتروني للزوار','show_email',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية البريد الإلكتروني الخاص بك'); 
				?>
				<?php text_box_item('الإسم الأول','first_name',$records[0]->first_name,''); ?>
				<?php text_box_item('إسم الأب','middle_name',$records[0]->middle_name,''); ?>
				<?php text_box_item('الإسم الأخير','last_name',$records[0]->last_name,''); ?>
				<?php thumbnail_field($image); ?>
				<?php
				$options = array(array('label' => 'ذكر','value' => '1','check'=>$records[0]->gender),array('label' => 'أنثى','value' => '2','check'=>$records[0]->gender));
				radio_item('الجنس','gender',$options,''); 
				?>
				<?php date_box_item($label='تاريخ الميلاد',$name='date_of_birth',$id='date_of_birth',$records[0]->date_of_birth,$help='')?>	
		</div>
		<div class="col-md-6">
				<h2>معلومات إضافية</h2>	
				<?php text_box_item('رقم الجوال','phone_number',$records[0]->phone,''); ?>
				<?php
				$options = array(array('label' => 'مفعل','value' => '1','check'=>$records[0]->show_phone),array('label' => 'معطل','value' => '0','check'=>$records[0]->show_phone));
				radio_item('عرض رقم الجوال للزوار','show_phone',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية رقم الجوال الخاص بك'); 
				?>
				<?php text_box_item('بلاك بيري','bb_pin',$records[0]->bb_pin,''); ?>
				<?php
				$options = array(array('label' => 'مفعل','value' => '1','check'=>$records[0]->show_bb_pin),array('label' => 'معطل','value' => '0','check'=>$records[0]->show_bb_pin));
				radio_item('عرض البلاك بيري للزوار','show_bb_pin',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية البلاك بيري الخاص بك'); 
				?>
				<?php text_box_item('السيرة الذاتية','user_bio',$records[0]->bio,''); ?>
				<?php dropdown_item('الدولة','country','countries',TRUE,$records[0]->country,$help='');?>	
				<?php
				$options = array(array('label' => 'معطل','value' => '1','check'=>$records[0]->adult_content),array('label' => 'مفعل','value' => '0','check'=>$records[0]->adult_content));
				radio_item('الوضع الآمن','adult_content',$options,'الوضع الآمن مفعل بالعادة لإخفاء النكت التي قد تسيء إلى البعض أو غير مناسبة لعموم الجمهور'); 
				?>
		</div>
		<div>
			<div class="clear">
				<div class="form-actions">
					<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
					<?php echo form_reset(array('class'=>'btn btn-default','value'=>'إلغاء الأمر')); ?>
				  </div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>