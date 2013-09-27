<h1>إضافة صفحة جديدة</h1>
<div id="body">
<p>روق وإكتب الصفحة مع كوباية قهوة! إستخدم الفورم اللي تحت لكتابة الصفحة اللي ودك فيه ولا تنسى تختار التصنيف المناسب</p>
<ul class="nav nav-tabs">
  <li><a href="<?=base_url();?>admin/pages"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="#"> <i class="icon-plus"></i> إضافة</a></li>
</ul>
<?php echo form_open('admin/pages/submit',array('class'=>'form-horizontal')); ?>
<fieldset>
<div class="col-md-10">

<?php text_box_item('عنوان الصفحة','title','',''); ?>

<?php text_area_item('محتوى الصفحة','content','',''); ?>
<?php echo display_ckeditor($ckeditor); ?>

	<hr />
</div>
<div class="col-md-6"> 	
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

<div class="control-group">
	<label class="control-label">تاريخ الخبر</label>
	<div class="controls">
		<?php
			$data = array(
		  'name'        => 'date_added',
		  'id'          => 'date_added',
		  'data-date-format'=>'mm/dd/yy',
		  'id'=>'dp2',
		  'value'       => set_value('date_added',date("d/m/Y")),
		  'dir'       => 'ltr',
		);
		echo form_input($data); ?>  
	</div>
</div>	

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