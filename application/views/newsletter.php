<h1> Newsletter! </h1>
<div id="newsletter_form">
	<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open('email/send'); ?>
	
	<?php
	
	$name_data = array(
		'name' => 'name',
		'id' => 'name',
		'value' => set_value('name')
	);
	
	?>
	
	<p><label for="name">Name: </label><?php echo form_input($name_data); ?> </p>
	<p>
		<label for="name">Email Address: </label>
		<input type="text" name="email" id="email" value="<?php echo set_value('email');?>">
	</p>
	
	<p><?php echo form_submit('submit','submit');?></p>
	<?php echo form_close(); ?>
	
	
</div>
