<div id="body">
<div class="page-header">	
	<h1>مسح نكتة</h1>
<p>وش تبي تعدل بالضبط؟ ياخي النكتة زينة</p>
</div>

<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/posts"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/posts/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li><a href="<?=base_url()?>admin/posts/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/posts/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح <?=$records[0]->title ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/posts/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/posts" class="btn btn-default">لا</a>
	  </div>
</div>
</div>