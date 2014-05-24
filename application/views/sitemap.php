<div id="body">
	<div class="page-header">
		<h1><?=$title;?></h1>	
	</div>
	
	<div id="site_tags" class="row">
			<div class="col-md-12">
			<h3>أقسام الموقع</h3>
			<ul class="list-unstyled">
			<?php 
			foreach($this->tags as $tag): ?>
			<li><strong><a href="<?php echo base_url(); ?>tag/<?=urlencode($tag->slug)?>"><?=$tag->title?></a></strong>(<?=$tag->count?>) <?=$tag->description?></li>
			<?php endforeach; ?>
			
			</ul>
			</div>
	</div>
	
	<div id="last_jokes" class="row">
			<div class="col-md-12">
			<h3>آخر النكت</h3>
			<ol>
			<?php foreach($jokes as $joke): ?>
			
				<li class="last_jokes"><a href="<?=base_url().'jokes/'.urlencode($joke->slug);?>"><?=mb_substr($joke->content,0,100,'utf-8');?></a></li>
			<?php endforeach; ?>
			
			</ol>
			</div>
	</div>
	
	<div id="last_comments" class="row">
			<div class="col-md-12">
			<h3>آخر التعليقات</h3>
			<ol>
			<?php foreach($comments as $comment): ?>
			
				<li class="last_reply"><strong dir=rtl ><?=$comment->author_link;?> : </strong> <a href="<?=base_url()."jokes/".urlencode($this->mo9->get_post_slug($comment->resource_id)->slug)."/#comment-".$comment->id;?>"><?=mb_substr($comment->content,0,100,'utf-8');?></a></li>
			<?php endforeach; ?>
			
			</ol>
			</div>
		</div>
	
</div>