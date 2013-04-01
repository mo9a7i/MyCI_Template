<html dir="rtl">
<body>
	<h1>تفعيل الحساب: <?php echo $identity;?></h1>
	<p>إضغط على هذا الرابط لتفعيل الحساب <?php echo anchor('auth/activate/'. $id .'/'. $activation, 'تفعيل الحساب');?>.</p>
</body>
</html>