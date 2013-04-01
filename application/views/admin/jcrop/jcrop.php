<h1>الصورة المصغرة</h1>
<div id="body">
<p>قم بتعديل الصورة التي قمت برفعها وإختيار صورة مصغره منها لتحسين شكلها عند العرض</p>

<?php echo form_open('admin/jcrop/submit',array('onsubmit'=>"return checkCoords();",'class'=>'form-horizontal')); ?>
<fieldset>
	<!-- Text Box -->
	<script>
	//Jcrop and Thumbnail creation
				
			// Create variables (in this scope) to hold the API and image size
			var jcrop_api, boundx, boundy;

			jQuery(function($) { 
			
				$('#source').Jcrop({
				trueSize: [<?=$image_dimensions[0];?>,<?=$image_dimensions[1];?>],
				onChange: updatePreview,
				onSelect: updatePreview,
				aspectRatio: 1,
				bgOpacity: .4
				},function(){
					// Use the API to get the real image size
					var bounds = this.getBounds();
					boundx = bounds[0];
					boundy = bounds[1];
					// Store the API in the jcrop_api variable
					jcrop_api = this;
			});
			
			
			});
			
			
			function updatePreview(c)
			{
				if (parseInt(c.w) > 0)
				{
				  var rx = <?=$dimension;?> / c.w;
				  var ry = <?=$dimension;?> / c.h;

				  $('#preview').css({
					width: Math.round(rx * boundx) + 'px',
					height: Math.round(ry * boundy) + 'px',
					marginLeft: '-' + Math.round(rx * c.x) + 'px',
					marginTop: '-' + Math.round(ry * c.y) + 'px'
				  });
				}
				jQuery('#x').val(c.x);
				jQuery('#y').val(c.y);
				jQuery('#w').val(c.w);
				jQuery('#h').val(c.h);
			};


			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};
		
	</script>
	<div class="row-fluid" dir="" id="jcrop_box">
		<div class="span8">
			<div id="source_image">
				<img src="<?=uploads_url().'images/'.$image->server_name;?>" alt="Source" id="source"  style="max-width:400px;max-height:400px;" />
			</div>
		</div>
		<div class="span4">
			<ul class="thumbnails">
				<li>
					<div class="row-fluid">
						<div dir="ltr" id="preview_image" class="span5" style="width:<?=$dimension;?>px;height:<?=$dimension;?>px;overflow:hidden;">
							<img src="<?=uploads_url().'images/'.$image->server_name;?>" id="preview" alt="Preview" class="jcrop-preview" />
						</div>
						<div class="span7">
							<h4>عرض تجريبي</h4>
							<p>هكذا ستظهر الصورة عند عرضها مصغرة, عند الضغط على الصورة سيتم فتح الصورة الأصلية</p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<input type="hidden" id="image_id" name="image_id" value="<?=$image->id;?>" />
	<input type="hidden" id="image_server_name" name="image_server_name" value="<?=$image->server_name;?>" />
	<input type="hidden" id="x" name="x" value=""/>
	<input type="hidden" id="referrer" name="referrer" value="<?=$referrer;?>"/>
	<input type="hidden" id="y" name="y" value=""/>
	<input type="hidden" id="w" name="w" value=""/>
	<input type="hidden" id="h" name="h" value=""/>
	
	<!-- Submit button -->
	<div class="form-actions">
		<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'OK')); ?>
		<?php echo form_reset(array('class'=>'btn','value'=>'Cancel')); ?>
	  </div>
</fieldset>

<?php echo form_close(); ?>

</div>