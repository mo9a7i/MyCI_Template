<div id="body">
<div class="page-header ">
	<div class="row">
		<div class="col-md-6"><h1>نكت تحت تصنيف: <?=$tag_name;?></h1>	</div>
		<div class="col-md-6"><a class="show-hide-comments pull-left" href="#">إخفاء / إظهار الردود</a></div>
	</div>
		
</div>
	<?php $this->load->view('rows/posts_rows.php'); ?>
</div>
<div id="LoadMoreButton" class="text-center">
	<a id="more_button" data-url="<?=base_url();?>ajax/get_posts_by_slug/<?=$original_slug;?>/" class="btn btn-lg btn-block">عرض المزيد</a>
</div>