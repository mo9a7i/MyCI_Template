<div id="body">
<div class="page-header">	
	<h1>إضافة صفحة</h1>
	<p>ضيف صفحة جديدة للموقع</p>
</div>
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/pages"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="#"> <i class="icon-plus"></i> إضافة</a></li>
</ul>
<?php echo form_open('admin/pages/submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="col-md-12">

<?php text_box_item('عنوان الصفحة','title','','','input-block-level'); ?>

<?php text_box_item('الرابط الجميل','slug','','','input-block-level'); ?>

<?php text_area_item('محتوى الصفحة','content','',''); ?>

<?php echo display_ckeditor($ckeditor); ?>

	<hr />
</div>
<div class="col-md-12"> 	
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
<?php date_box_item($label='تاريخ الخبر',$name='date_added',$id='dp2',date("Y-m-d"),$help='')?>	

</div>
<div class="clear">
		<div class="form-actions">
            <?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
            <?php echo form_reset(array('class'=>'btn btn-default','value'=>'إلغاء الأمر')); ?>
          </div>
</div>
</fieldset>		
<?php echo form_close(); ?>
</div>