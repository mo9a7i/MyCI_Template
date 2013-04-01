<h1>إضافة إعلان جديد</h1>
<div id="body">
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/annoucements"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="#"> <i class="icon-plus"></i> إضافة</a></li>
</ul>
<?php echo form_open_multipart('admin/annoucements/submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="span10">

<?php text_box_item('عنوان الإعلان','title','',''); ?>

<?php text_box_item('رابط الإعلان','link','',''); ?>

	<hr />
</div>


<div class="span10"> 	

<h2>معلومات إضافية</h2>	
<div class="control-group">
	<label class="control-label">الحالة</label>
	<div class="controls">
		<?php 
		$options = $this->mo9a7i_model->get_categories_dropdown('statuses');
		
		echo form_dropdown('status_id', $options, '1');
		?>        
	</div>
</div>

<?php date_box_item($label='تاريخ الخبر',$name='date_added',$id='dp1',date("Y-m-d"),$help='')?>	
	
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