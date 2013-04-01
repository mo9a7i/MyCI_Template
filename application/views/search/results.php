<div class="page-header"><h1>نتائج بحثك<?=((is_null($results['keyword'])) ? " " : " عن \"".$results['keyword']."\"" );?></h1>
</div>
<div id="body">
<p>تم إيجاد <?=$results['institutes'] . " مؤسسات و " . $results['faculty'] . " أعضاء هيئة تدريس و " . $results['news'] . " خبر و " . $results['users'] . " عضواً.";?></p>

	<?php if(!empty($institutes)): ?>
	<h2>المؤسسات</h2>
	<table class="table table-condensed table-striped">
		<thead><tr><th>المؤسسة</th><th>الدولة</th><th>العنوان</th></tr></thead>
		<tfoot><tr><td colspan="7"><span><?=count($institutes);?></span> مؤسسة تم العثور عليها</td></tr></tfoot>
		<tbody><?php $this->load->view('rows/search_institutes.php'); ?></tbody>
	</table>
	<?php endif; ?>
	<?php if(!empty($faculty)): ?>
	<h2>الأساتذة</h2>
	<table class="table table-condensed table-striped">
		<thead><tr><th>الإسم الحقيقي</th><th>الجامعة</th></tr></thead>
		<tfoot><tr><td colspan="7"><span><?=count($faculty);?></span> أستاذ تم العثور عليها</td></tr></tfoot>
		<tbody><?php $this->load->view('rows/search_faculty.php'); ?></tbody>
	</table>
	<?php endif; ?>
	<?php if(!empty($news)): ?>
	<h2>الأخبار</h2>
	<table class="table table-condensed table-striped">
		<thead><tr><th>العنوان</th><th>تاريخ الخبر</th></tr></thead>
		<tfoot><tr><td colspan="7"><span><?=count($news);?></span> خبر تم العثور عليها</td></tr></tfoot>
		<tbody><?php $this->load->view('rows/search_news.php'); ?></tbody>
	</table>
	<?php endif; ?>
	<?php if(!empty($users)): ?>
	<h2>الأعضاء</h2>
	<table class="table table-condensed table-striped">
		<thead><tr><th>إسم المستخدم</th><th>الإسم الحقيقي</th><th>الجامعة</th></tr></thead>
		<tfoot><tr><td colspan="7"><span><?=count($users);?></span> عضو تم العثور عليها</td></tr></tfoot>
		<tbody><?php $this->load->view('rows/search_users.php'); ?></tbody>
	</table>
	<?php endif; ?>
</div>