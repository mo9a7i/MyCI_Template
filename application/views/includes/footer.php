
<div id="statistics" class="row">
	
	<div class="col-md-9 statisticsBox add_shadow">
	<div class="page-header">	
		<h1>لدينا في فطسني! <small>(حتى هذه الساعة)</small></h1>	
	</div>
		<div class="row">
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->total_active_jokes;?></p> نكتة مفعلة
			</div>
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->total_pending_jokes;?></p> نكتة بالإنتظار
			</div>
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->total_deleted_jokes;?></p> نكتة ممسوحة
			</div>
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->total_users;?></p> عضو
			</div>
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->total_replies;?></p> تعليق
			</div>
			<div class="col-md-2 statistic">
				<p><?=$this->statistics->visits;?></p> زيارة
			</div>
		</div>
		
	</div>
	<div class="col-md-3">
	</div>
</div>
</div>
<footer class="row">
	<div class="padder12 container">
		<div class="row">
			<div class="col-md-4">
				<ul class="list-unstyled">
					<li><img src="<?php echo base_url().'assets/images/logo-xsmall.png'; ?>" alt="<?php echo $this->Settings->site_title; ?>" /></li>
					<li><a href="<?php echo base_url(); ?>sitemap"><i class="icon-sitemap"></i> خريطة الموقع</a></li>
					<li><a href="<?php echo base_url(); ?>page/ليه_ماطلعت_نكتتي"><i class="icon-question-sign"></i> ليه ماطلعت نكتتي؟</a></li>
					<li><a href="<?php echo base_url(); ?>contactus"><i class="icon-envelope"></i> إتصل بنا</a></li>
				</ul>
			</div>
			
			<div class="col-md-4">
				<ul class="list-unstyled">
					<li>أدواتك</li>
						<?php 
						if(!$this->ion_auth->logged_in())
						{
						?>
						<li><a  data-toggle="modal" href="#loginPopup" ><i class="icon-ok" style="color:#ffffff;"></i> إشترك معنا</a></li>
						<li><a  data-toggle="modal" href="#loginPopup" ><i class="icon-user" style="color:#ffffff;"></i> تسجيل الدخول</a></li>
						<?php
						}
						else
						{
						?>
						<li><a href="<?=base_url();?>auth/change_password"><i class="icon-asterisk" style="color:#ffffff;"></i> كلمة المرور</a></li>
						<li><a href="<?=base_url();?>users/edit_profile"><i class="icon-cogs" style="color:#ff6b60;"></i> ملفك الشخصي</a></li>
						<?php
						}
						?>
				
				</ul>
			</div>
			<div class="col-md-4">
				<ul class="list-unstyled">
					<li>الشبكات الإجتماعية</li>
					<li><a target="_blank" href="https://www.facebook.com/F6sny"><i class="icon-facebook-sign" style="color:#2d9aff;"></i> Like us on Facebook</a></li>
					<li><a target="_blank" href="https://twitter.com/F6sny"><i class="icon-twitter" style="color:#66ceff;"></i> Follow us on Twitter</a></li>
					<!--<li><a href="">RSS2</a></li>-->
				</ul>
			</div>
		</div>	
		<div id="copyrights" class="row">
			<div class="row">
				<div class="col-md-12">
					<p class="text-warning">موقع فطسني.كوم غير مسئول بأي شكل من الأشكال عن أي محتوى يقوم المستخدم بنشره على الموقع بمقتضى اشتراكه وتقع كافة المسئوليات القانونية والأدبية على عاتق المشترك.</p>
				
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="muted">جميع الحقوق محفوظة لـ <a href="<?php echo base_url(); ?>"><?php echo $this->Settings->site_title; ?>&copy; </a> | تم تحميل الصفحة في {elapsed_time} جزء من الثانية</p>
				</div>
				<div dir="rtl" class="col-md-6 pull-left text-left">
					<p>برمجة وتطوير <a href="http://www.MohannadOtaibi.com">@Mohannad</a></p>
				</div>
			</div>
			
			
		</div>
	</div>
</footer>	

<?php $this->load->view('includes/hidden_modals'); ?>
<?php $this->load->view('includes/footer_include'); ?>

  </body>
</html>