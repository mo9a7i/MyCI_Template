<h1>نتائج البحث<?=((is_null($keyword)) ? : " عن ".$keyword );?></h1>
<hr />
<div id="body">
	<?php $this->load->view('rows/news_rows.php'); ?>
</div>