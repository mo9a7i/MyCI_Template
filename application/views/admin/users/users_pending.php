<div id="body">
<div class="page-header">	
	<h1>الأعضاء</h1>
	<p>قائمة الأعضاء الغير مفعلين</p>
</div>
<ul class="nav nav-tabs">
	<li><a href="<?=base_url()?>admin/users"><i class="icon-th-list"></i> القائمة</a></li>
	<li class="active"><a href="<?=base_url()?>admin/users/pending"> <i class="icon-time"></i> بالإنتظار</a></li>
	<li><a href="<?=base_url()?>admin/users/deleted"><i class="icon-trash"></i> المحذوفين</a></li>
	<li><a href="users/add"> <i class="icon-plus"></i> إضافة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>إسم المستخدم</th>
			<th>البريد الإلكتروني</th>
			<th>تاريخ التسجيل</th>
			<th>المجموعة</th>
			<th>أوامر</th>
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> عضو في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	<!-- load another view here! -->
	<?php $this->load->view('admin/users/users_table_rows_pending.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>
</div>