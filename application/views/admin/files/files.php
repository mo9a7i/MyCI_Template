<h1>مركز الملفات</h1>
<div id="body">
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">تحذير!</h4>
  هذه الصفحة غير مكتملة بعد ولايمكن إستخدامها...
</div>
<p>في هذه الصفحة, الملفات المرفوعة أو قم بإضافتها, التعديل عليهم أو مسحهم</p>
<ul class="nav nav-tabs">
	<li class="active"><a href="#"><i class="icon-th-list"></i> القائمة</a></li>
	<li><a href="<?=base_url();?>admin/files/create"> <i class="icon-plus"></i> إضافة</a></li>
</ul>
<h2>تجربة رفع الملفات</h2>
<!-- The file upload form used as target for the file upload widget -->
	<?php echo form_open_multipart('admin/files/jqueryUpload',array('id'=>'fileupload','class'=>'form-horizontal')); ?>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class=" fileupload-buttonbar">
            <div class="col-md-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>إضافة ملفات...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>إبدأ الرفع</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>إلغاء الأمر</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>مسح</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="col-md-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
	
	<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-default modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>



<h2>رفع ملف</h2>
<?php echo form_open_multipart('admin/files/upload',array('class'=>'form-horizontal')); ?><fieldset>
	<!-- Text Box -->
	<div class="control-group">
		<label class="control-label">إختر الملف</label>
		<div class="controls">
			<?php echo form_upload('Filedata',set_value('Filedata'),array('class'=>'input-xlarge')); ?>        
		</div>
	</div>
<div class="control-group">
	<label class="control-label">القسم</label>
	<div class="controls">
		<?php 
		$options = $this->mo9a7i_model->get_categories_dropdown('files_categories');
		echo form_dropdown('cat_id', $options, '');
		?>        
	</div>
</div>
	
	<!-- Submit button -->
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'OK')); ?>
		<?php echo form_reset(array('class'=>'btn btn-default','value'=>'Cancel')); ?>
	  </div>
</fieldset><?php echo form_close(); ?>


<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>الرقم</th>
			<th>إسم الملف</th>
			<th>العضو</th>
			<th>حجم الملف (kb)</th>
			<th>التاريخ</th>
			
			<th>حذف</th>
			
		</tr>
	</thead>

<tfoot>
	<tr>
		<td colspan="7"><span><?=count($records);?></span> ملف في قاعدة البيانات</td>
	</tr>
</tfoot>

<tbody>
	
	<!-- load another view here! -->
	<?php $this->load->view('admin/files/files_table_rows.php'); ?>					

</tbody>
</table>
<?= $this->pagination->create_links();?>

</div>