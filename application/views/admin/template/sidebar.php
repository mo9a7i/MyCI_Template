<div class="well sidebar-nav">  
	<ul class="nav nav-list">
		<li class="nav-header">عام</li>
		<li class="divider"></li>
		<?php echo sidebar_item('رئيسية التحكم','admin/dashboard','dashboard','icon-home'); ?>
		<?php echo sidebar_item('إعدادات الموقع','admin/settings','settings','icon-cog'); ?>
		<?php echo sidebar_item('الإعلانات','admin/annoucements','annoucements','icon-star'); ?>

		
		<li class="nav-header">أعضاء</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('الأعضاء','admin/users','users','icon-user'); ?>
		<?php echo sidebar_item('مجموعات الأعضاء','admin/users_groups','users_groups','icon-th-list'); ?>

		
		<li class="nav-header">النكت</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('النكت','admin/posts','posts','icon-film'); ?>
		<?php echo sidebar_item('أقسام النكت','admin/tags','tags','icon-book'); ?>
		<?php echo sidebar_item('التعليقات','admin/replies','replies','icon-film'); ?>	
		
		
		<li class="nav-header">أخرى</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('رسائل إتصل بنا','admin/contactus','contactus','icon-envelope'); ?>
		<?php echo sidebar_item('البلاغات','admin/reports','reports','icon-warning-sign'); ?>
		<?php echo sidebar_item('الصفحات','admin/pages','pages','icon-book'); ?>
		
		<?php if($this->Settings->advanced_settings) : ?>
		<li class="nav-header">للمطورين</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('إصلاح الصور المصغرة','admin/fixthumbs','fixthumbs','icon-book'); ?>
		<?php echo sidebar_item('إعدادات البريد','admin/emails/settings','emails/settings','icon-cog'); ?>
		<?php echo sidebar_item('القائمة البريدية','admin/emails/settings','emails/settings','icon-envelope'); ?>
		<?php echo sidebar_item('العناوين (الدول والمناطق)','admin/locations','locations','icon-book'); ?>
		<?php echo sidebar_item('مساعدة','admin/help','help','icon-book'); ?>
		<li class="nav-header">التذاكر</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('التذاكر المفتوحة','admin/tickets','tickets','icon-book'); ?>
		<?php echo sidebar_item('تم الرد عليها','admin/tickets/answered','tickets/answered','icon-book'); ?>
		<?php echo sidebar_item('التذاكر المغلقة','admin/tickets/closed','tickets/closed','icon-book'); ?>
		<?php echo sidebar_item('أقسام التذاكر','admin/tickets/categories','tickets/categories','icon-book'); ?>
		<?php echo sidebar_item('إعدادات التذاكر','admin/tickets/settings','tickets/settings','icon-cog'); ?>
		<li class="nav-header">ملفات مرفوعة</li>
		<li class="divider"></li>		
		<?php echo sidebar_item('قائمة الملفات','admin/files','upload','icon-film'); ?>
		<?php echo sidebar_item('التصنيفات','admin/files_categories','upload_categories','icon-road'); ?>

		
		<?php endif; ?>
		
	</ul>       
</div><!--/.well -->