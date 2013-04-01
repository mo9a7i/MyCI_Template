<h1>البلاغات</h1>
<div id="body">
<p>هذي بلاغات على بعض محتويات الموقع من الأعضاء والزوار</p>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
</ul>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>النوع</th>
			<th>البلاغ</th>
			<th>على</th>
			<th>العضو</th>
			<th>التاريخ</th>

			<th>إخفاء</th>
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> بلاغ في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/reports/reports_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>