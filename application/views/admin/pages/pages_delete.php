<div id="body">
<div class="page-header">	
	<h1>مسح صفحة</h1>
</div>
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/pages"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/pages/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li><a href="<?=base_url()?>admin/pages/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/pages/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح الصفحة:  <?=$records[0]->title ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/pages/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/pages" class="btn">لا</a>
	  </div>
</div>
</div>