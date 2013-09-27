<div id="body">
<div class="page-header">	
<h1>مسح مجموعة أعضاء</h1>
</div>
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/users_groups"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/users_groups/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/categories/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح المجموعة:  <?=$records[0]->name ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/users_groups/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/users_groups" class="btn btn-default">لا</a>
	  </div>
</div>
</div>