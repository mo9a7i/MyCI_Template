<h1>مسح تقرير</h1>
<div id="body">
<ul class="nav nav-tabs">
  <li><a href="<?=base_url()?>admin/reports"><i class="icon-th-list"></i> القائمة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/reports/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<p>هل أنت متأكد من أنك تريد مسح التقرير رقم <?=$records[0]->id ?> ؟ </p>
<div class="clear">
	<div class="form-actions">
		<a href="<?=base_url()?>admin/reports/confirm_delete/<?=$records[0]->id?>" class="btn btn-primary">نعم</a>
		<a href="<?=base_url()?>admin/reports" class="btn">لا</a>
	  </div>
</div>
</div>