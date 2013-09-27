<?php if(empty($posts)): ?>

<div class="alert">
  <strong>للأسف!</strong>ماعاد باقي نكت للمراقبة. (<a href="javascript:location.reload(true)">تحديث الصفحة</a>)
</div>
<article>
<p>بالعادة نعرض هنا نكتة, ونخليك تقيمها على مزاجك, إذا عجبت النكتة ناس واجد نفعلها ونعرضها بالموقع, وإذا ماعجبت ناس واجد, نمسحها قبل لا تنعرض</p>
</article>

<?php else: ?>

<div class="page-header">
	<h1>تقييم النكت <a href="#" class="close pull-left" data-original-title="إضغط عشان تشوف القوانين" data-placement="bottom" data-title="مساعدة" id="moderateHelp">شسالفة؟</a></h1>
</div>
<article>
	<div class="row hide" id="moderateRules">
		<div class="alert alert-warning" style="margin-bottom:0px;">
		<p>ساعدنا نختار الخيار الأفضل. إذا راقبت نكتة, فهي وحدة من الثنتين, يا إنها تنعرض بالموقع أو إنها تنمسح.</p>
		<ul>
		<li>أحيانا تواجهكم نكت ماتبدا ب (يقول لك,)</li>
		<li>وأحيانا مو نكت</li>
		<li>وأحيانا تكون سخيفة أو قديمة ومسجلة بالموقع.</li>
		</ul>
	<p>إختر من الخيارات بالأسفل اللي يناسبك وشاكرين لك مساعدتك</p>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<h4>النكتة تقووول</h4>
		<p id="jokeContent"><?=nl2br($posts[0]->content)?></p>
	</div>
	<div class="col-md-12">
		<h4>ف, أنت وشرايك؟</h4>
		<div class="row text-center">
			<div class="col-md-12">
			<p>
				<button moderate_value="like" class="moderate btn btn-lg btn-success" type="button" resource-type="2" resource-id="<?=$posts[0]->id;?>">عجبتني!</button>
				<button moderate_value="skip" class="moderate btn btn-lg btn-warning" type="button" resource-type="2" resource-id="<?=$posts[0]->id;?>">لاتعليق</button>
				<button moderate_value="dislike" class="moderate btn btn-lg btn-danger" type="button" resource-type="2" resource-id="<?=$posts[0]->id;?>">ماعجبتني</button>
				</p>
			</div>
			<?php if($this->ion_auth->is_admin()) : ?>
			<div class="col-md-12">
			<p>
				<button moderate_value="force_like" class="moderate btn btn-lg btn-inverse" type="button" resource-type="2" resource-id="<?=$posts[0]->id;?>">عجبني بالغصب! (<?=$up_votes;?>)</button>
				<button moderate_value="force_dislike" class="moderate btn btn-lg btn-inverse" type="button" resource-type="2" resource-id="<?=$posts[0]->id;?>">ماعجبني بالغصب(<?=$down_votes;?>)</button>
			</p>
			</div>
			<?php endif;?>
		</div>
	</div>
	</div>
</article>


<?php endif; ?>