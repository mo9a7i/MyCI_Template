<h1>رسائل إتصل بنا</h1>
<div id="body">
<p>إستعرض في هذه الصفحة رسائل إتصل بنا التي تم إستلامها عن طريق الموقع, نسخة من هذه الرسائل تم إرساله لبريد الإدارة</p>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>

			<th>العنوان</th>
			<th>بريد المرسل</th>
			<th>التاريخ</th>
			<th>الردود</th>
			
			<th>عرض/حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> رسالة في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/contactus/contactus_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>
</div>