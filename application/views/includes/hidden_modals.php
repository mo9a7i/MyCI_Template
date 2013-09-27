<!-- Welcome Message -->
<?php if($this->mo9a7i_model->show_welcome()):?>
<div id="welcome" class="modal show">
	<div class="modal-dialog">
		<div class="modal-content">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>مرحباً بك في فطسني.كوم</h3>
	</div>
	<div class="modal-body">
	<div class="alert alert-error">
		<h4 class="alert-heading">تنبيه!</h4>
		
	<p>ممنوع دخول الجادين واللي صدورهم ضيقة, إذا كان صدرك ضيقاً عزيزي الزائر,
	<a href="http://www.google.com.sa/search?hl=ar&amp;q=%D9%82%D8%B5%D8%B5+%D8%AD%D8%B2%D9%8A%D9%86%D8%A9+%D8%AC%D8%A7%D8%AF%D8%A9+%D8%B5%D8%A7%D8%AF%D9%82%D8%A9&amp;oq=%D9%82%D8%B5%D8%B5+%D8%AD%D8%B2%D9%8A%D9%86%D8%A9+%D8%AC%D8%A7%D8%AF%D8%A9+%D8%B5%D8%A7%D8%AF%D9%82%D8%A9&amp;aq=f&amp;aqi=&amp;aql=&amp;gs_sm=e&amp;gs_upl=1191l1191l0l1372l1l1l0l0l0l0l0l0ll0l0" style="color:#0054bb;">إضغط هنا</a> </p>
</div>
		<p>حياكم الله ونورتوا ياقمامير, الموقع موقعكم لاحد يستحي, ننصحكم تاخذون جولة عالموقع بالضغط على الزر اللي تحت قبل لا تحوسون موقعنا </p>
		<p>إذا ودكم تعطونا ملاحظاتكم, جربوا و  <a href="contactus">إتصلوا بنا</a></p>
	</div>
	<div class="modal-footer">
		<a href="#" id="f6sny-tour" class="btn btn-primary">خذني بجولة</a>
		<a href="<?=base_url();?>home/disable_welcome" class="btn btn-default">لاعاد اشوفك</a>
	</div>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<?php endif;?>





<?php $menu_tags = $this->tags;?>
<!-- Modal -->
<div id="addJoke" class="modal hide fade" style="width: 750px;margin-left: -375px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo form_open(base_url().'ajax/submit_post',array('id'=>'JokeAdd','class'=>'form-horizontal')); ?>
	<div class="modal-dialog">
		<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close pull-left" data-dismiss="modal" aria-hidden="true"><i class=" icon-remove"></i></button>
	<a href="#" class="close pull-left" data-original-title="إضغط عشان تشوف القوانين" data-placement="bottom" data-title="مساعدة" id="newJokeHelp"><i class=" icon-question-sign"></i></a>
    <h3 id="myModalLabel">تكفى تكفى سمعناها!</h3>
  </div>
<div class="modal-body">
	<div class="row hide" id="newJokeRules">
		<div class="alert alert-warning" style="margin-bottom:0px;">
			<ul class="ordered">
				<li><strong>مبادئ لازم نعرفها كويس:</strong>
					<ul>
						<li>تبدا النكتة دائماً بكلمة يقول لك, وفاصلة</li>
						<li>اكتب النكتة بدون زخرفة ومدات وشخطات وخذ راحتك</li>
					</ul>
				</li>
				<li><strong>النشر:</strong>جميع النكت لازم تمر على <a href="<?=base_url();?>moderate">المراقبة</a> قبل لا يتم نشرها ف لا تنقد علينا إذا ماطلعت على طول!</li>
			</ul>
		</div>
	</div>
	<div class="row" id="addJokeMessages">
		<div id="failure_message" class="alert alert-error hide"></div>
		<div id="success_message" class="alert alert-success hide"></div>
		<div id="loading" class="text-center"><i class="icon-spinner icon-spin icon-2x hide"></i></div>
	</div>
	<div class="row" id="textArea">
		
		<div class="row" id="authorWillBe">
		<span class="help-block pull-left">سيتم نشر النكتة بإسم: <?=(($this->mo9a7i_model->get_user_id() ==0)? '<span class="text-warning">زائر</span>' : '<span class="text-success">'.$this->ion_auth->user()->row()->username.'</span>');?></span>
		</div>
		<div class="row">
		<textarea id="joke_area" name="content" placeholder="يقول لك, " rows="5" class="input-block-level">يقول لك, </textarea>
		</div>
	</div>
	
	<div class="row" id="tags">
		<h4>التصنيفات</h4>
		<div class="">
			<ul id="Tagsaty" class="list-inline">
				<?php
				foreach($menu_tags as $tag)
				{
				?>
				<li><input type="checkbox" name="tag[]" id="tags-<?=$tag->id;?>" value="<?=$tag->id;?>" class="CheckTags"><label for="tags-<?=$tag->id;?>" class="checkbox">#<?=$tag->title;?></label></li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>
  
<div class="modal-footer">
	<input type="submit" class="btn btn-primary" value="أرررسل" />
	<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">لالالا إستحيت</button>
</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
<?php echo form_close(); ?>	

</div>

<!-- +18 filter popup -->
<div id="filter_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="filterPopupLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="filterPopupLabel">أنت الآن تحاول تطفي الوضع الآمن!</h3>
  </div>
  <div class="modal-body">
		<div class="alert alert-error alert-block">
		<h4>تحذير!</h4>
		الوضع الآمن يقوم بإخفاء النكت التي تحتوي على مواد غير مناسبة لمن هم تحت الـ18 سنة أو التي لا تليق بالذوق العام
		</div>
    <p>بضغطك على موافق فهذا يعني أنك تقر على التالي:</p>
	<ul>
		<li>أنا فوق الـ18 سنة!</li>
		<li>لن تسيء إلي النكت المعروضة بعد إلغاء الوضع الآمن!</li>
	</ul>
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" href="<?=base_url();?>home/disable_filter">تمام</a>
	<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">لا ياعمي!</button>

  </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>