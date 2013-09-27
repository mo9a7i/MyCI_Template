<div style="" id="report" class="modal hide fade">
<div class="modal-dialog">
    <div class="modal-content">
	<div id="report-form" class="row">
	<?php echo form_open(base_url().'ajax/submit_report',array('id'=>'reportForm','class'=>'form-horizontal')); ?>
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>شكراً لإهتمامك بتبليغنا!</h3>
		</div>
		<div class="modal-body">
			<div id="report-message" class="row" style="display:none;">
				<div class="alert alert-success" >
				شكراً لتبليغك, سيتم الإهتمام ببلاغك قريباً
				</div>
			</div>
			<div class="row">
				<div id="myreport" class="col-md-6">
					<fieldset>
						<div class="control-group">
						<?php 
				
				$options = $this->mo9a7i_model->get_categories_dropdown('reports_categories');
				$options = $this->mo9a7i_model->add_blank_option($options,'بدون تصنيف');
				echo form_dropdown('report_category',$options,0);
				?>
						</div>
						<div class="control-group"><input type="text"  name="report_content" id="report_content"></div>
						<input type="hidden"  name="report_resource_id" id="report_resource_id">
						<input type="hidden"  name="report_resource_type" id="report_resource_type">
					</fieldset>
				</div>
				<div class="col-md-5 information">
					<strong>بلاغ عن محتوى</strong>
					<p>إستخدم خاصية التبليغ, للإبلاغ عن محتوى مسيء أو خاطئ. شاكرين لكم إهتمامكم بالموقع</p>
				</div>	
			</div>
		</div>
		<div style="" class="modal-footer clear">
			<input id="reportSubmit" class="btn btn-danger" value="تبليغ!" />					
		</div>
		<?php echo form_close(); ?>	
	</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>