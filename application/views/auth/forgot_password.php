<div id="body">
<div class="page-header">
	<h1>إستعادة كلمة المرور!</h1>
</div>
<br />
<div class="alert">
  <strong>فضلاً!</strong> ضع بريدك الإلكتروني لنقوم بإرسال رسالة إستعادة كلمة المرور إليك.
</div>

<?php echo form_open("auth/forgot_password");?>

      <p>البريد الإلكتروني:<br />
      <?php echo form_input($email);?>
      </p>
      
 	<div class="form-actions">
		<input type="submit" name="submit" value="إرسال" class="btn btn-primary" />
	</div>
           
<?php echo form_close();?>
</div>
