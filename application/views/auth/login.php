<div id="body">
<div class="page-header">
	<h1>تسجيل الدخول!</h1>
	<p>إستخدم بريدك الإلكتروني لتسجيل الدخول لحسابك</p>
</div>
	
    <?php echo form_open(base_url().'auth/login',array('id'=>'signForm','class'=>'form-horizontal'));?>
    	
      <p>
      	<label for="identity">بريدك الإلكتروني:</label>
      	<?php echo form_input($identity);?>
      </p>
      
      <p>
      	<label for="password">كلمةالمرور:</label>
      	<?php echo form_input($password);?>
		
      </p>
	  <p>
		<a href="<?=base_url();?>auth/forgot_password">نسيت كلمة المرور؟</a></p>
      
      <p>
	      <label for="remember">تذكرني:</label>
	      <?php echo form_checkbox('remember', '1', FALSE);?>
	  </p>
      
	<div class="form-actions">
		<input type="submit" name="submit" value="تسجيل الدخول" class="btn btn-primary" />
	</div>

<?php echo form_close();?>
</div>