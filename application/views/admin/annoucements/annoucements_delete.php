<h1>مسح إعلان</h1>
<div id="body">
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/annoucements"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/annoucements/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li><a href="<?=base_url()?>admin/annoucements/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/annoucements/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح <?=$records[0]->title ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/annoucements/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/annoucements" class="btn btn-default">لا</a>
	  </div>
</div>
</div>