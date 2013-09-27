<h1>مسح ملف</h1>
<div id="body">
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/files"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/files/delete/<?=$records[0]->id;?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح <?=$records[0]->file_name ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/files/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/files" class="btn btn-default">لا</a>
	  </div>
</div>
</div>