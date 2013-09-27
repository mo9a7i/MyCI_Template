<div id="body">
<div class="page-header">	
	<h1>مسح عضو</h1>
</div>
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/users"><i class="icon-th-list"></i> القائمة</a></li>
    <li><a href="<?=base_url()?>admin/users/pending"> <i class="icon-time"></i> بالإنتظار</a></li>
  	<li><a href="<?=base_url()?>admin/users/deleted"><i class="icon-trash"></i> المحذوفين</a></li>

  <li><a href="<?=base_url()?>admin/users/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li><a href="<?=base_url()?>admin/users/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li class="active"><a href="<?=base_url()?>admin/users/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح العضو #<?=$records[0]->id	 ?>: <?=$records[0]->username ?> (<?=$records[0]->email ?>)؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/users/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/users" class="btn btn-default">لا</a>
	  </div>
</div>
</div>