<div id="body">
<div class="page-header">	
	<h1>إضافة عضو</h1>
	<p>في هذه الصفحة, إستعرض الأعضاء المسجلين بالموقع أو قم بإضافتهم, التعديل عليهم أو مسحهم</p>
</div>
<ul class="nav nav-tabs">
	<li><a href="<?=base_url()?>admin/users"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="<?=base_url()?>admin/users/pending"> <i class="icon-time"></i> بالإنتظار</a></li>
	<li><a href="<?=base_url()?>admin/users/deleted"><i class="icon-trash"></i> المحذوفين</a></li>

	<li class="active"><a href="#"> <i class="icon-plus"></i> إضافة</a></li>
</ul>
<?php echo form_open_multipart('admin/users/submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="span5">
<div>
<h2>معلومات رئيسية</h2>

<?php text_box_item('إسم المستخدم','user_name','',''); ?>
<?php text_box_item('كلمة المرور','password','',''); ?>
<?php text_box_item('البريد الإلكتروني','user_email','',''); ?>
<?php
$options = array(
				array('label' => 'مفعل','value' => '1','check'=>1),
				array('label' => 'معطل','value' => '0','check'=>0)
				);
radio_item('عرض البريد الإلكتروني للزوار','show_email',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية البريد الإلكتروني الخاص بك'); 
?>
<?php dropdown_item('المجموعة','user_group','groups',TRUE,'2',$help='');?>
<?php dropdown_item('الحالة','status_id','statuses',TRUE,'1',$help='');?>
<?php
$options = array(array('label' => 'معطل','value' => '1','check'=>0),array('label' => 'مفعل','value' => '0','check'=>1));
radio_item('الوضع الآمن','adult_content',$options,'الوضع الآمن مفعل بالعادة لإخفاء النكت التي قد تسيء إلى البعض أو غير مناسبة لعموم الجمهور'); 
?>

<h2>صورة العضو</h2>
<?php thumbnail_field(); ?>


</div>
</div>

<div class="span4">

<h2>معلومات إضافية</h2>	
<?php text_box_item('الإسم الأول','first_name','',''); ?>
<?php text_box_item('إسم الأب','middle_name','',''); ?>
<?php text_box_item('الإسم الأخير','last_name','',''); ?>
<?php
$options = array(array('label' => 'ذكر','value' => '1','check'=>1),array('label' => 'أنثى','value' => '2','check'=>0));
radio_item('الجنس','gender',$options,''); 
?>
<?php date_box_item($label='تاريخ الميلاد',$name='date_of_birth',$id='date_of_birth',date("Y-m-d"),$help='')?>		
<?php text_box_item('رقم الجوال','phone_number','',''); ?>
<?php
$options = array(
				array('label' => 'مفعل','value' => '1','check'=> 1),
				array('label' => 'معطل','value' => '0','check'=> 0));
radio_item('عرض رقم الجوال للزوار','show_phone',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية رقم الجوال الخاص بك'); 
?>
<?php text_box_item('بلاك بيري','bb_pin','',''); ?>
<?php
$options = array(array('label' => 'مفعل','value' => '1','check'=>1),array('label' => 'معطل','value' => '0','check'=>0));
radio_item('عرض البلاك بيري للزوار','show_bb_pin',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية البلاك بيري الخاص بك'); 
?>
<?php text_box_item('السيرة الذاتية','user_bio','',''); ?>
<?php dropdown_item('الدولة','country','countries',TRUE,'1',$help='');?>

</div>
<div class="clear">
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
		<?php echo form_reset(array('class'=>'btn','value'=>'إلغاء الأمر')); ?>
	</div>
</div>
</fieldset>		
<?php echo form_close(); ?>
</div>