<div id="body">
<div class="page-header">	
	<h1>مجموعات الأعضاء</h1>
<p>في هذه الصفحة, استعرض مجموعات الأعضاء أو قم بإضافتها, التعديل عليهم أو مسحهم</p>
</div>

<h2>إضافة مجموعة</h2>
<?php echo form_open('admin/users_groups/submit',array('class'=>'form-horizontal')); ?><fieldset>
	<!-- Text Box -->
	<div class="control-group">
		<label class="control-label">إسم المجموعة</label>
		<div class="controls">
			<?php echo form_input('name',set_value('name'),array('class'=>'input-xlarge')); ?>        
			<p class="help-block">أضف مجموعات الأعضاء!</p>
		</div>
	</div>
	
	<!-- Submit button -->
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'OK')); ?>
		<?php echo form_reset(array('class'=>'btn','value'=>'Cancel')); ?>
	  </div>
</fieldset><?php echo form_close(); ?>

<h2>قائمة المجموعات</h2>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>المجموعة</th>
			<th>عدد الأعضاء</th>
			<th>تعديل/حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> مجموعة في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/users/groups_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>


</div>