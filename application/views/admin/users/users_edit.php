<div id="body">
<div class="page-header">	
	<h1>تعديل عضو رقم #<?=$records[0]->id;?></h1>
	<p>في هذه الصفحة, إستعرض الأعضاء المسجلين بالموقع أو قم بإضافتهم, التعديل عليهم أو مسحهم</p>
</div>

<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/users"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/users/pending"> <i class="icon-time"></i> بالإنتظار</a></li>
  <li><a href="<?=base_url()?>admin/users/deleted"><i class="icon-trash"></i> المحذوفين</a></li>
  <li><a href="<?=base_url()?>admin/users/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/users/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li><a href="<?=base_url()?>admin/users/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<?php
if($records[0]->active == 4):
?>
<div class="alert alert-error clearfix">
<a class="btn btn-success" href="<?=base_url()?>admin/users/activate/<?=$records[0]->id?>">تفعيل <span class="icon-ok icon-white"></span></a>     

هذا العضو بإنتظار تفعيل الإدارة, إضغط زر التفعيل لتفعيله!

</div>

<?php
endif;
?>
<div class="row-fluid">
<?php echo form_open_multipart('admin/users/submit',array('class'=>'form-horizontal')); ?>
<div class="span6">
<div>
<h2>معلومات رئيسية</h2>
<?php echo form_hidden('id', $records[0]->id); ?>

<?php text_box_item('إسم المستخدم','user_name',$records[0]->username,''); ?>
<?php text_box_item('كلمة المرور','password','','لتغيير كلمة المرور, ضع كلمة مرور جديدة هنا'); ?>
<?php text_box_item('البريد الإلكتروني','user_email',$records[0]->email,''); ?>
<?php
$options = array(array('label' => 'مفعل','value' => '1','check'=>$records[0]->show_email),array('label' => 'معطل','value' => '0','check'=>$records[0]->show_email));
radio_item('عرض البريد الإلكتروني للزوار','show_email',$options,'عند تفعيل هذا الخيار, سيتمكن الآخرون من رؤية البريد الإلكتروني الخاص بك'); 
?>
<?php dropdown_item('المجموعة','user_group','groups',TRUE,$records[0]->group_id,$help='');?>
<?php dropdown_item('الحالة','status_id','statuses',TRUE,$records[0]->active,$help='');?>
<?php
$options = array(array('label' => 'معطل','value' => '1','check'=>$records[0]->adult_content),array('label' => 'مفعل','value' => '0','check'=>$records[0]->adult_content));
radio_item('الوضع الآمن','adult_content',$options,'الوضع الآمن مفعل بالعادة لإخفاء النكت التي قد تسيء إلى البعض أو غير مناسبة لعموم الجمهور'); 
?>

<h2>صورة العضو</h2>
<?php thumbnail_field($image); ?>

</div>
</div>
<div class="span5">
<h2>معلومات إضافية</h2>	

<?php text_box_item('الإسم الأول','first_name',$records[0]->first_name,''); ?>
<?php text_box_item('إسم الأب','middle_name',$records[0]->middle_name,''); ?>
<?php text_box_item('الإسم الأخير','last_name',$records[0]->last_name,''); ?>
<?php
$options = array(array('label' => 'ذكر','value' => '1','check'=>$records[0]->gender),array('label' => 'أنثى','value' => '2','check'=>$records[0]->gender));
radio_item('الجنس','gender',$options,''); 
?>
<?php date_box_item($label='تاريخ الميلاد',$name='date_of_birth',$id='date_of_birth',$records[0]->date_of_birth,$help='')?>		
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

</div>
<div class="clear">
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
		<?php echo form_reset(array('class'=>'btn','value'=>'إلغاء الأمر')); ?>
	</div>
</div>	
<?php echo form_close(); ?>
</div>
</div>