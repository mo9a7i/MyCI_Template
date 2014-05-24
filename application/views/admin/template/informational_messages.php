<?php
if($this->session->flashdata('success')!=FALSE)
{
	?>
		<div class="alert alert-success">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">تم!</h4>
		 <?php echo $this->session->flashdata('success'); ?>
		</div>
	<?php
}
if($this->session->flashdata('error')!=FALSE)
{
	?>
		<div class="alert alert-error">
		 <a class="close" data-dismiss="alert">×</a>
		 <h4 class="alert-heading">خطأ!</h4>
		 <?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php
}

?>