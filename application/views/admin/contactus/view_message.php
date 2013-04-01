<h1>إتصل بنا # <?=$records[0]->id;?></h1>
<div id="body">
<p>إستعرض في هذه الصفحة رسائل إتصل بنا التي تم إستلامها عن طريق الموقع, نسخة من هذه الرسائل تم إرساله لبريد الإدارة</p>


<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/contactus"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/contactus/view/<?=$records[0]->id?>"><i class="icon-pencil"></i> عرض</a></li>
  <li><a href="<?=base_url()?>admin/contactus/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>

<table class="table  table-bordered table-striped">
	<tbody>
		<tr>
			<th>بريد المرسل</th>
			<td><?=$records[0]->email_address?></td>
		</tr>
		<tr>
			<th>التاريخ</th>
			<td><?=$records[0]->date_added?></td>
		</tr>
		<tr>
			<th>العنوان</th>
			<td><?=$records[0]->title?></td>
		</tr>
		<tr>
			<th>محتوى الرسالة</th>
			<td><?=$records[0]->content?></td>
		</tr>
	</tbody>
</table>


<h2>رد على الرسالة</h2>
<h3>ردود سابقة</h3>
<?php 
if ((count($replies) < 1))
{
	?>
		<div class="alert">
		<a class="close" data-dismiss="alert">×</a>
		لايوجد ردود على هذه الرسالة.
		</div>
	<?php
}
else
{
	?>
	<table class="table table-condensed table-bordered table-striped">
	<thead>
		<tr>
			<th>الرقم</th>
			<th>عنوان الرسالة</th>
			<th>نص الرسالة</th>
			<th>التاريخ</th>
			<th>العضو</th>
			<th>حالة الإرسال</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> رد في قاعدة البيانات </td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/contactus/replies_table_rows.php'); ?>					

</tbody>
</table>
	
	
	<?php
}

?>
<h3>رد جديد</h3>
<?php echo form_open('admin/contactus/reply',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="span10">
<?php echo form_hidden('id', $records[0]->id); ?>
<?php echo form_hidden('send_to', $records[0]->email_address); ?>
<?php text_box_item('عنوان الرد','title','رد على: '.$records[0]->title,''); ?>

<?php text_area_item('نص الرد','content','',''); ?>
<?php echo display_ckeditor($ckeditor); ?>
<div class="clear">
		<div class="form-actions">
            <?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
            <?php echo form_reset(array('class'=>'btn','value'=>'إلغاء الأمر')); ?>
          </div>
</div>
</div>


</fieldset>		
<?php echo form_close(); ?>

</div>