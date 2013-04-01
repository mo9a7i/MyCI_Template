<div id="body">
<div class="page-header">	
	<h1>تعديل التعليق</h1>
<p>وش تبي تعدل بالضبط؟ ياخي التعليق زين</p>
</div>
<ul class="nav nav-tabs">

  <li><a href="<?=base_url()?>admin/replies"><i class="icon-th-list"></i> القائمة</a></li>
  <li><a href="<?=base_url()?>admin/replies/add"> <i class="icon-plus"></i> إضافة</a></li>
  <li class="active"><a href="<?=base_url()?>admin/replies/edit/<?=$records[0]->id?>"><i class="icon-pencil"></i> تعديل</a></li>
  <li><a href="<?=base_url()?>admin/replies/delete/<?=$records[0]->id?>"><i class="icon-remove"></i> حذف</a></li>
</ul>
<?php echo form_open_multipart(base_url().'admin/replies/submit',array('class'=>'form-horizontal')); ?>
<fieldset>

<div class="row-fluid">
<div class="span12">
<?php echo form_hidden('id', $records[0]->id); ?>
<?php 	if($records[0]->user_id == 0):?>
<?php text_box_item('الكاتب','author',$records[0]->author,'','input-block-level" disabled=disabled'); ?>
<?php text_box_item('الإيميل','author_email',$records[0]->author_email,'','input-block-level" disabled=disabled'); ?>
<?php text_box_item('العنوان','author_url',$records[0]->author_url,'','input-block-level" disabled=disabled'); ?>
<?php text_box_item('IP','author_ip',$records[0]->author_ip,'','input-block-level" disabled=disabled'); ?>
<?php endif; ?>
<?php text_area_item('التعليق','content',$records[0]->content,'','input-block-level'); ?>


<h2>معلومات إضافية</h2>	
<div class="control-group">
	<label class="control-label">الحالة</label>
	<div class="controls">
		<?php 
		$options = $this->mo9a7i_model->get_categories_dropdown('statuses');
		
		echo form_dropdown('status_id', $options, $records[0]->status_id);
		?>        
	</div>
</div>

<?php date_box_item($label='تاريخ الخبر',$name='date_added',$id='dp1',$records[0]->date_added,$help='')?>	


<div class="clear">
		<div class="form-actions">
            <?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
            <?php echo form_reset(array('class'=>'btn','value'=>'إلغاء الأمر')); ?>
          </div>
</div>
</div>
</div>
</fieldset>		
<?php echo form_close(); ?>
</div>