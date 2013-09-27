<div id="body">
<div class="page-header">	
	<h1>مسح التعليق</h1>
</div>

<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/replies"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/replies/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li><a href="<?=base_url()?>admin/replies/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/replies/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح <?=$records[0]->content ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/replies/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/replies" class="btn btn-default">لا</a>
	  </div>
</div>
</div>