<h1>تعديل الإعلان</h1>
<div id="body">
<ul class="nav nav-tabs">

  <li><a href="<?=base_url()?>admin/annoucements"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/annoucements/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/annoucements/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li><a href="<?=base_url()?>admin/annoucements/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<?php echo form_open_multipart(base_url().'admin/annoucements/submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="span10">
<?php echo form_hidden('id', $records[0]->id); ?>
<?php text_box_item('عنوان الإعلان','title',$records[0]->title,''); ?>

<?php text_box_item('نص الإعلان','link',$records[0]->link,''); ?>

	<hr />
</div>

<div class="span10"> 		
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

<?php date_box_item($label='تاريخ الإعلان',$name='date_added',$id='dp1',$records[0]->date_added,$help='')?>	

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