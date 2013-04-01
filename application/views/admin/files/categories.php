<h1>تصنيفات الملفات</h1>
<div id="body">
<p>في هذه الصفحة, استعرض تصنيفات الملفات أو قم بإضافتها, التعديل عليهم أو مسحهم</p>

<h2>إضافة تصنيف</h2>
<?php echo form_open('admin/files_categories/submit',array('class'=>'form-horizontal')); ?><fieldset>
	<!-- Text Box -->
	<div class="control-group">
		<label class="control-label">إسم التصنيف</label>
		<div class="controls">
			<?php echo form_input('name',set_value('name'),array('class'=>'input-xlarge')); ?>        
			<p class="help-block">أضف التصنيفات الخاصة بالملفات!</p>
		</div>
	</div>
	
	<!-- Submit button -->
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'OK')); ?>
		<?php echo form_reset(array('class'=>'btn','value'=>'Cancel')); ?>
	  </div>
</fieldset><?php echo form_close(); ?>

<h2>قائمة التصنيفات</h2>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>الرقم</th>
			<th>التصنيف</th>
		
			<th>تعديل/حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> تصنيف في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/files/categories_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>


</div>