<?php
	$fullname = $user[0]->first_name . ' ' . $user[0]->middle_name . ' ' . $user[0]->last_name;
?>

<div id="body">
	<div class="page-header">
		<div class="row">
			<div class="col-md-2" style="width:100px;">
				<?php show_thumb(@$image[0]->server_name); ?>
			</div>
			<div dir="rtl" class="col-md-9">
				<h1 dir="rtl"><?=$fullname; if(!empty($user[0]->username)):?> <em dir=rtl><small>(<?=$user[0]->username;?>)</small></em><?php endif;?></h1>
			<?php if(!empty($user[0]->bio)) : ?>
				<p id="biography"><?=$user[0]->bio;?></p>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="row">
			<div class="col-md-12">
			<h3>معلومات عامة</h3>
				<ul class="userinfo list-unstyled">
					<li><strong>الدولة:</strong><?=$user[0]->country_name;?></li>
					<li><strong>تاريخ الميلاد:</strong><time><?=mdate("%d / %m / %Y", mysql_to_unix($user[0]->date_of_birth))?></time></li>
					<li><strong>الجنس:</strong><?=(($user[0]->gender) ? "ذكر" : "أنثى");?></li>
					
					<?php if(!empty($user[0]->email) AND $user[0]->show_email) : ?>
							<li><strong>البريد الإلكتروني:</strong><?=$user[0]->email;?></li>
					<?php endif; ?>
					
					<?php if(!empty($user[0]->phone) AND $user[0]->show_phone) : ?>
							<li><strong>الهاتف:</strong><?=$user[0]->phone;?></li>
					<?php endif; ?>
					
					<?php if(!empty($user[0]->bb_pin) AND $user[0]->show_bb_pin) : ?>
							<li><strong>البلاك بيري:</strong><?=$user[0]->bb_pin;?></li>
					<?php endif; ?>

				</ul>
			</div>
		</div>
		<div id="user_jokes" class="row">
			<div class="col-md-12">
			<h3>آخر النكت</h3>
			<ol>
			<?php foreach($jokes as $joke): ?>
			
				<li class="last_jokes"><a href="<?=base_url().'jokes/'.urlencode($joke->slug);?>"><?=mb_substr($joke->content,0,100,'utf-8');?></a></li>
			<?php endforeach; ?>
			
			</ol>
			
			
			</div>
		</div>
		<div id="user_comments" class="row">
			<div class="col-md-12">
			<h3>آخر التعليقات</h3>
			<ol>
			<?php foreach($comments as $comment): ?>
			
				<li class="last_reply"><a href="<?=base_url()."jokes/".urlencode($this->mo9a7i_model->get_post_slug($comment->resource_id)->slug)."/#comment-".$comment->id;?>"><?=mb_substr($comment->content,0,100,'utf-8');?></a></li>
			<?php endforeach; ?>
			
			</ol>
			</div>
		</div>
		
	</div>
</div>