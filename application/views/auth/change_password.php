<div id="body">
<div class="page-header">
	<h1>تغيير كلمة المرور!</h1>
</div>

<?php echo form_open("auth/change_password");?>

	<br />
	<div class="alert">
		<strong>كلمة مرورك القديمة:</strong>
		<p>
			<?php echo form_input($old_password);?>
		</p>
	</div>

     
	<div class="alert alert-info">
		<strong>كلمة مرورك الجديدة:</strong>
		<p>
			<?php echo form_input($new_password);?>
		</p>
		<strong>تأكيد كلمة المرور:</strong>
		<p>
			<?php echo form_input($new_password_confirm);?>
		</p>
	</div>
	
      <?php echo form_input($user_id);?>
	<div class="form-actions">
		<input type="submit" name="submit" value="حفظ التغييرات" class="btn btn-primary" />
	</div>
      
<?php echo form_close();?>
</div>