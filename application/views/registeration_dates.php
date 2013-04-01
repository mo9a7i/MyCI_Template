<h2>القبول والتسجيل</h2>
<hr>

<div id="admissions">
<div id='errors'>
	<?php echo validation_errors('<p class="error">'); ?>
</div>
<p>في هذه الصفحة, ستجد معلومات حول طرق وعناوين القبول والتسجيل في أغلب الجامعات السعودية. يفضل إستخدام أكثر الطرق الممكنة للتواصل مع الجامعات لضمان إستلام الطلبات. نسأل الله العلي الجليل لنا ولكم التوفيق والنجاح في الدنيا والآخرة.</p>
	<table id="regDates" class="table table-striped">
	<thead>
		<tr>
			<th>العنوان</th>
			<th>تاريخ البدء</th>
			<th>تاريخ الإنتهاء</th>
			<th>المؤسسة</th>
			<th>روابط</th>
		</tr>
	</thead>
	
	<tfoot><tr><td colspan="7"><span><?=count($reg_dates);?></span> موعد في قاعدة البيانات. <em>يتم تحديث هذه البيانات يومياً, زورونا مجدداً لمتابعة التحديثات</em></td></tr></tfoot>

	<tbody>
	<!-- load another view here! -->
		<?php $this->load->view('rows/registeration_dates_table_rows.php'); ?>
	</tbody>
	</table>
</div>