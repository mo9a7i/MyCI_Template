<div id="topBar" class="span12">
<?php $this->load->view('includes/navbar'); ?>
	<span id="login_span" class="pull-left bootstro" data-bootstro-step="4" data-bootstro-placement="bottom" data-bootstro-title="أخيراً" data-bootstro-content="إذا بغيت تسجل دخول أو تشترك بالموقع, هذا الزر اللي تجيه, اذا سجلت معنا تقدر تحفظ النكت بإسمك وتحط معلومات بعضويتك الناس يقدرون يشوفونها, وبرضه تعليقاتك تنحفظ بإسمك" >
		<?php 
		if(!$this->ion_auth->logged_in())
		{
		?>
		<a data-toggle="modal" href="#loginPopup" class="login"><i class="icon-user"></i> هل لديك عضوية؟</a>
	</span>
			<div id="loginPopup" class="modal hide fade">
			<?php echo form_open(base_url().'auth/login',array('id'=>'signForm','class'=>'form-horizontal')); ?>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>سجل دخولك <?=($this->Settings->registeration) ? 'او عضويتك الجديدة': '' ;?> الآن!</h3>
				</div>
				<div class="modal-body">
					<div id="Form1" class="row-fluid">
						<div id="login" class="span6">
							<fieldset>
								<div class="control-group"><input type="text" name="identity" id="identity" placeholder="البريد الإلكتروني"><p id="email-help" class="help-block"></p></div>
								<div class="control-group">
								<div class="input-prepend">
								
								<input type="password"  name="password" id="password" placeholder="كلمة المرور">
								<span class="add-on"><a title="نسيت كلمة المرور؟" href="<?=base_url();?>auth/forgot_password">؟</a></span>
								</div>
								</div>
								<div class="control-group"><label class="checkbox">تذكرني!<input name="remember" id="remember" type="checkbox"></label></div>
							</fieldset>
						</div>
						<div class="span5 information">
							<strong>تسجيلنا غير</strong>
							<?php if($this->Settings->registeration) : ?>
							<p>تسجيل العضوية الجديدة لدينا سهل جداً, ماعليك سوى إدخال بريدك الإلكتروني وكلمة المرور والضغط على زر "تسجيل" بالأسفل بدلاً من زر "دخول"</p>
							<?php else : ?>
							<p>التسجيل غير متاح حالياً</p>
							<?php endif; ?>
						</div>	
					</div>
					<?php if($this->Settings->registeration) : ?>
					<div id="Form2" class="row-fluid">
						<div id="pickUser" class="span6">
							<fieldset>
								<div class="control-group"><input type="text" name="username" id="username" placeholder="إسم المستخدم"><p id="user-help" class="help-block"></p></div>
								<div class="control-group"><input type="submit" id="checkAvailability" class="btn" value="تأكد من الإتاحة" /></div>
							</fieldset>
						</div>
						<div class="span5 information">
							<strong>إختر إسم المستخدم</strong>
							<p>لاتقلق, لن تحتاج لإسم المستخدم لتسجيل الدخول في موقعنا, ستحتاج فقط إلى بريدك الإلكتروني وكلمة المرور</p>
							<p>سيتم عرض إسم مستخدمك في مشاركاتك وتعليقاتك في موقعنا فقط!</p>
						</div>					
					</div>
					<?php endif; ?>
				</div>
				
				<div id="Submit1" class="modal-footer clear">
					<button type="submit" class="btn btn-primary">دخول</button>
					<?php if($this->Settings->registeration) : ?>
						<input id="registerMe" class="btn" value="تسحيل جديد!" />
					<?php endif;?>				
				</div>
				<?php if($this->Settings->registeration) : ?>
					<div id="Submit2" class="modal-footer clear">
						<button id="signupButton" type="submit" disabled="disabled" class="btn">سجل الآن</button>
						<input id="signMe" class="btn btn-danger" value="لا أريد التسجيل!" />					
					</div>
				<?php endif;?>
				<?php echo form_close(); ?>	
			</div>					
		<?php
		}
		else
		{
		?>
			<a data-toggle="modal" href="#loginPopup" class="login"><i class="icon-user"></i> مرحبا <?php echo $this->ion_auth->user()->row()->username;?></a>
	</span>
			<div id="loginPopup" class="modal hide fade">
				<div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3>خيارات عضويتك</h3></div>
				<div class="modal-body">					
					<ul class="nav nav-list">
						<li><a href="<?=base_url();?>auth/change_password"><i class="icon-key"></i> كلمة المرور</a></li>
						<li><a href="<?=base_url();?>users/edit_profile"><i class="icon-th-list"></i> ملفك الشخصي</a></li>
						<?php if($this->ion_auth->is_admin()){ ?><li><a href="<?=base_url();?>admin/"><i class="icon-eye-close"></i> لوحة الإدارة</a></li><?php } ?>
						<li><a href="<?=base_url();?>auth/logout"><i class="icon-signout"></i> تسجيل خروج</a></li>
					</ul>
				</div>
			</div>
		<?php
		}
		?>
</div>