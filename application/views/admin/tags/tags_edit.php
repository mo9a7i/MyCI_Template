<h1>أقسام النكت</h1>
<div id="body">
<p>في هذه الصفحة, استعرض تصنيفات الأخبار أو قم بإضافتها, التعديل عليهم أو مسحهم</p>

<div class="row">

<div class="col-md-6">
<h2>تعديل قسم</h2>
<?php echo form_open(base_url().'admin/tags/submit',array('class'=>'form-horizontal')); ?><fieldset>
<?php echo form_hidden('id', $records[0]->id); ?>
<?php echo form_hidden('count', $records[0]->count); ?>
	<!-- Text Box -->
		<?php text_box_item('إسم القسم','title',$records[0]->title,'أضف أقسام النكت!'); ?>
	<?php text_box_item('الإختصار','slug',$records[0]->slug,'الإختصار للروابط الجميلة!'); ?>
	<?php text_area_item('الشرح','description',$records[0]->description,'شرح القسم!'); ?>
	
	
	<!-- Submit button -->
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'OK')); ?>
		<?php echo form_reset(array('class'=>'btn btn-default','value'=>'Cancel')); ?>
	  </div>
</fieldset><?php echo form_close(); ?>
</div>

<div class="col-md-6">

<h2>قائمة الأقسام</h2>
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>الرقم</th>
			<th>القسم</th>
			<th>العدد</th>
			<th>تعديل/حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> قسم في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/tags/tags_table_rows.php'); ?>					

</tbody>
</table>
</div>
</div>
</div>