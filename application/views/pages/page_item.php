<div id="body">
	<div class="page-header">
		<h1><?=$pages[0]->title;?></h1>
		<time><?=mdate("بتاريخ: %Y / %m / %d الساعة %h:%i %a", mysql_to_unix($pages[0]->date_added))?></time>
	</div>
	<article class="pages" id="page-<?=$pages[0]->id;?>">
			<p><?=$pages[0]->content?></p>
		<?=comment_box($pages[0]->id,3,'Comment on Page');?>
	</article>
</div>