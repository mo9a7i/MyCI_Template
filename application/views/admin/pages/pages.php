<div id="body">
<div class="page-header">	
	<h1>الصفحات</h1>
	<p>في هذه الصفحة, إستعرض صفحات الموقع أو قم بإضافتها, التعديل عليهم أو مسحهم</p>
</div>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="pages/add"> <i class="icon-plus"></i> إضافة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>عنوان الصفحة</th>
			<th>العضو</th>
			<th>التاريخ</th>
			
			<th>تعديل/حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> صفحة في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/pages/pages_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>