<div id="body">
<div class="page-header">	
	<h1>التعليقات</h1>
</div>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="<?=base_url()?>admin/replies/pending"> <i class="icon-time"></i> بالإنتظار</a></li>
	<li><a href="<?=base_url()?>admin/replies/deleted"> <i class="icon-trash"></i> الممسوحة</a></li>
	<li><a href="<?=base_url();?>admin/replies/add"> <i class="icon-plus"></i> إضافة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>العنوان</th>
			<th>العضو</th>
			<th>التاريخ</th>

			<th>تعديل/حذف</th>
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=$total_rows;?></span> تعليق في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/replies/replies_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>