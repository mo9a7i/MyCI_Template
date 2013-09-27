	</section>
	</div>
	<div id="sidebar" class="col-md-3 sidebar-nav pull-left">
		<div class="sidebar-content">
		
		<!--
		<div class="widget">
				<h3>إبحث بالموقع</h3>
			<div class="widget-content">
				<?php echo form_open(base_url().'search/submit',array('class'=>'form-search')); ?>
				<input type="text" name="keyword" class="input-lg search-query">
				<?php echo form_close(); ?>	
			</div>
		</div>
		-->
		<div class="widget">
				<h3>آخر التعليقات</h3>
			<div class="widget-content">
			<ul class="list-unstyled">
			<?php foreach($this->latest_replies as $latest_reply): ?>
			
				<li class="last_reply"><strong dir=rtl ><?=$latest_reply->author_link;?> : </strong> <a href="<?=base_url()."jokes/".urlencode($this->mo9a7i_model->get_post_slug($latest_reply->resource_id)->slug)."/#comment-".$latest_reply->id;?>"><?=mb_substr($latest_reply->content,0,20,'utf-8');?></a></li>
			<?php endforeach; ?>
			
			</ul>
			</div>
		</div>
		<div class="widget google">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-8882866984702449";
				/* F6sny Sidebar 2 */
				google_ad_slot = "1848603772";
				google_ad_width = 200;
				google_ad_height = 200;
				//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>

		</div>
		<div class="widget">
				<h3>أقسام الموقع</h3>
			<div class="widget-content">
			<ul class="list-unstyled">
			<?php 
			foreach($this->tags as $tag): ?>
			<li><a dir="rtl" href="<?php echo base_url(); ?>tag/<?=urlencode($tag->slug);?>"><?=$tag->title?></a> <span class="pull-left">(<?=$tag->count;?>)</span></li>
			<?php endforeach; ?>
			</ul>
			
			</div>
		</div>
		

		</div>
	</div>
</div>
	
	
