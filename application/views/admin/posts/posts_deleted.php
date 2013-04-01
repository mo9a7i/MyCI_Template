
<div id="body">
<div class="page-header">	
	<h1>النكت</h1>
<p>قائمة النكت الممسوحة</p>
</div>
<ul class="nav nav-tabs">
	<li><a href="<?=base_url()?>admin/posts"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="<?=base_url()?>admin/posts/pending""> <i class="icon-time"></i> بالإنتظار</a></li>
	<li class="active"><a href="#"> <i class="icon-trash"></i> الممسوحة</a></li>
	<li><a href="<?=base_url();?>admin/posts/add"> <i class="icon-plus"></i> إضافة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>العنوان</th>
			<th><i class="icon-thumbs-up"></i></th>
			<th><i class="icon-thumbs-down"></i></th>
			<th>العضو</th>
			<th>التاريخ</th>

			<th>تعديل/حذف</th>
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=$total_rows;?></span> نكتة في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/posts/posts_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>