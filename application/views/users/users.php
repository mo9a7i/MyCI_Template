<h1>الأعضاء</h1>
<hr />
<div id="body">
<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>إسم المستخدم</th>
			<th>الإسم الحقيقي</th>
		</tr>
	</thead>
<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('rows/users_rows.php'); ?>				

</tbody>
</table>
<?= $this->pagination->create_links();?>
</div>