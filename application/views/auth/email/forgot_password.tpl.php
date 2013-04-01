<html dir="rtl">
<body>
	<h1>تغيير كلمة المرور لـ:  <?php echo $identity;?></h1>
	<p>إضغط على الرابط التالي لتغيير كلمة المرور  <?php echo anchor('auth/reset_password/'. $forgotten_password_code, 'تغيير كلمة المرور');?>.</p>
</body>
</html>