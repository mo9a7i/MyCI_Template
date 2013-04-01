<h1>الإعلانات</h1>
<div id="body">
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="<?=base_url();?>admin/annoucements/add"> <i class="icon-plus"></i> إضافة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>العنوان</th>
			<th>الرابط</th>
			<th>التاريخ</th>

			<th>تعديل/حذف</th>
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> خبر في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/annoucements/annoucements_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>