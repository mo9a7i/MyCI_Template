<div id="body">
<div class="page-header">	
	<h1>تعديل صفحة</h1>
	<p>عدل الصفحة بالخيارات اللي تحت</p>
</div>

<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/pages"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/pages/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/pages/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li><a href="<?=base_url()?>admin/pages/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<?php echo form_open('admin/pages/submit',array('class'=>'form-horizontal')); ?>
<div class="row-fluid">
<div class="span12">
<?php echo form_hidden('id', $records[0]->id); ?>

<?php text_box_item('عنوان الخبر','title',$records[0]->title,''); ?>

<?php text_box_item('الرابط الجميل','slug',$records[0]->slug,'','input-block-level'); ?>

<?php text_area_item('نص الخبر','content',$records[0]->content,''); ?>

<?php echo display_ckeditor($ckeditor); ?>

	<hr />
</div>
</div>
<div class="row-fluid">
<div class="span12"> 	
<h2>معلومات إضافية</h2>	

<div class="control-group">
	<label class="control-label">الحالة</label>
	<div class="controls">
		<?php 
		$options = $this->mo9a7i_model->get_categories_dropdown('statuses');
		
		echo form_dropdown('status_id', $options, $records[0]->status_id);
		?>        
	</div>
</div>

<?php date_box_item($label='تاريخ الخبر',$name='date_added',$id='dp1',$records[0]->date_added,$help='')?>


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