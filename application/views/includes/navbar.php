<div id="navigation">
	<ul class="nav nav-pills">
		<li class="gotJoke bootstro" data-bootstro-step="2" data-bootstro-placement="bottom" data-bootstro-title="نكّت علينا" data-bootstro-content="إذا عندك نكتة ودك تقولها, إضغط هنا, مايحتاج تكون عضو عشان تقرا أو تنكت"><a href="#addJoke" role="button" data-toggle="modal"><span class="addJoke">عندك نكتة؟</span></a></li>
		<li class="dropdown">
			<a href="<?php echo base_url(); ?>posts" class="dropdown-toggle" data-toggle="dropdown">أقسامنا<b class="caret"></b></a>
			<ul class="dropdown-menu">
			<li><a href="<?php echo base_url(); ?>posts">كل الأقسام</a></li>
			<?php 
			foreach($this->tags as $tag): ?>
			<li><a href="<?php echo base_url(); ?>tag/<?=urlencode($tag->slug);?>"><?=$tag->title?></a></li>
			<?php endforeach; ?>
			</ul>
		</li>
		<li class="bootstro" data-bootstro-step="3" data-bootstro-placement="bottom" data-bootstro-title="انشر" data-bootstro-content="هنا تقدر تساعدنا نراقب النكت, ونشوف وش يصلح للعرض ووش مايصلح"><a href="<?php echo base_url(); ?>posts/moderate">مراقبة<span class="badge badge-important"><?=$this->mo9a7i_model->navbar_moderation_number();?></span></a></li>
		<li><a <?=(($this->mo9a7i_model->filter_status())? 'title="الوضع الآمن فعال, إضغط هنا لإيقافه" href="#filter_popup" role="button" data-toggle="modal"' : 'title="الوضع الآمن غير فعال, إضغط هنا لتفعيله" href="'.base_url().'home/enable_filter"')?> class="<?=(($this->mo9a7i_model->filter_status())? "text-success" : "text-error" )?>">الوضع الآمن</a></li>
	</ul>
</div>



