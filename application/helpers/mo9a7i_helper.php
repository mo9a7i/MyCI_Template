<?php
// application/helpers/mo9a7i_helper.php
/**
* F6sny.com 
* ===========
* code
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
//Prints admin panel sidebar menu items
if (!function_exists('print_header'))
{
	function print_header($title)
	{
		$CI =& get_instance();
		echo ( empty($title)?  '':$title.' | ' ). $CI->Settings->site_title; 
	}
}

if (!function_exists('print_description'))
{
	function print_description($description)
	{
		$CI =& get_instance();
		echo ( empty($description)?  $CI->Settings->site_description : $description ) ; 
	}
}

if (!function_exists('print_keywords'))
{
	function print_keywords($keywords)
	{
		if(!empty($keywords))
		{
			$tags = "";
			foreach($keywords as $keyword)
			{
				$tags = $tags . "," . $keyword->title;
			}
			echo $tags;
		}
		else echo "";
	}
}

if (!function_exists('sidebar_item'))
{   
    function sidebar_item($item_name = '', $item_url = '', $item_url_segment='', $icon ='')
    {
        $CI =& get_instance();

		$compare_to = str_replace("/","",$CI->uri->segment(2).$CI->uri->segment(3));
		$item_url_segment = str_replace("/","",$item_url_segment);
		
        // return the item
$item = "<li class=\"".($compare_to === $item_url_segment ? 'active':'')."\"><a href=\"".base_url().$item_url."\"><i class=\"".$icon."\"></i> $item_name</a></li>";
        return $item;
    }
}
//Just an asset path producer, this is changable in the configs
if (!function_exists('asset_url'))
{   
    function asset_url()
    {
        $CI =& get_instance();

        // return the asset_url
        return base_url() . $CI->config->item('asset_path');
    }	
}
//Upload folder, changable in the configs.
if (!function_exists('uploads_url'))
{  
	function uploads_url()
	{
		$CI =& get_instance();

		// return the uploads_url
		return base_url() . $CI->config->item('uploads_path');
	}
}
//form items helper
//text_box_item('بريد الإدارة','admin_email',$this->Settings->admin_email,'البريد الرئيسي لتحويل رسائل إتصل بنا وغيره من رسائل الموقع');
if (!function_exists('text_box_item'))
{  
	function text_box_item($label='',$name='',$value='',$help='',$optional_class = '')
	{
		$attributes = array(
			'class' =>$optional_class,
			'name' =>$name,
			'value' =>set_value($name,$value)
		);
		?>
		<div class="control-group ">
			<label class="control-label"><?php echo $label; ?></label>
			<div class="controls">
				<?php echo form_input($attributes); ?>        
				<p class="help-block"><?php echo $help; ?></p>
			</div>
		</div>
		<?php
	}
}
if (!function_exists('text_area_item'))
{  
	function text_area_item($label='',$name='',$value='',$help='',$class= '')
	{
		$attributes = array(
			'class' =>$class,
			'name' =>$name,
			'value' =>set_value($name,$value),
			'rows' => 10,
			'id' => $name
		);
		?>
		<div class="control-group">
			<label class="control-label"><?php echo $label; ?></label>
			<div class="controls">
				<?php echo form_textarea($attributes); ?>        
				<p class="help-block"><?php echo $help; ?></p>
			</div>
		</div>
		<?php
	}
}
//radio_item('إعدادات متقدمة','advanced_settings',$options,'ستظهر قائمة جانبية جديدة عند تفعيل هذا الخيار'); 
if (!function_exists('settings_radio_item'))
{  
	function settings_radio_item($label='',$name='',$options=array(),$help='')
	{
		$CI =& get_instance();
		?>
		<div class="control-group">
			<label class="control-label"><?php echo $label; ?></label>
			<div class="controls">
			<?php 
			foreach($options as $option)
			{
				?>
				<label class="radio">
					<?php echo form_radio($name,$option['value'],$CI->Settings->$name == $option['value']); ?>
				<?php echo $option['label']; ?>
				</label>
				
				<?php
			}
			?>
			<p class="help-block"><?php echo $help; ?></p>
			</div>
		</div>
		<?php
	}
}
if (!function_exists('radio_item'))
{  
	function radio_item($label='',$name='',$options=array(),$help='')
	{
		$CI =& get_instance();
		?>
		<div class="control-group">
			<label class="control-label"><?php echo $label; ?></label>
			<div class="controls">
			<?php 
			foreach($options as $option)
			{
				?>
				<label class="radio">
					<?php echo form_radio($name,$option['value'],$option['check'] == $option['value']); ?>
				<?php echo $option['label']; ?>
				</label>
				
				<?php
			}
			?>
			<p class="help-block"><?php echo $help; ?></p>
			</div>
		</div>
		<?php
	}
}
if (!function_exists('dropdown_item'))
{
	function dropdown_item($label='',$name='',$db='',$blank=TRUE,$value='',$help='')
	{
		$CI =& get_instance();
		$options = $CI->mo9->get_categories_dropdown($db);
		if($blank)
		{
			$options = $CI->mo9->add_blank_option($options,' ');
		}
		?>
			<div class="control-group">
				<label class="control-label"><?php echo $label; ?></label>
				<div class="controls">
				<?php 
				echo form_dropdown($name, $options, $value);
				?>        
				</div>
			</div>
		<?php
	}
}

if (!function_exists('date_box_item'))
{
	function date_box_item($label='',$name='',$id='datepciker',$value='',$help='')
	{
		$data = array(
						'name'        => $name,
						'id'          => $id,
						'data-date-format'=>'yy-mm-dd',
						'value'       => set_value($name,$value),
						'dir'       => 'ltr',
						);
		?>

		<div class="control-group">
			<label class="control-label"><?php echo $label; ?></label>
			<div class="controls">
				<?php echo form_input($data); ?> 
				<p class="help-block"><?php echo $help; ?></p>
				
			</div>
		</div>	
		<script>
		$(function(){
			$('#<?=$id;?>').datepicker({ format: 'yyyy-mm-dd' });
		});

	</script>
		<?php
	}
}

if (!function_exists('jqup_head'))
{
	function jqup_head()
	{
		?>
		<!-- Bootstrap Image Gallery styles -->
		<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
		<link href="<?php echo asset_url(); ?>js/jqueryupload/css/jquery.fileupload-ui.css" rel="stylesheet">
		<?php
	}
}

if (!function_exists('jqup_footer'))
{
	function jqup_footer()
	{
		?>
<script id="template-upload" type="text/x-tmpl"><!-- The template to display files available for upload -->

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="icon-trash icon-white"></i>
                <span>{%=locale.fileupload.destroy%}</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/vendor/jquery.ui.widget.js"></script><!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script><!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script><!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script><!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.com/cdn/js/bootstrap.min.js"></script><!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->
<script src="http://blueimp.github.com/Bootstrap-Image-Gallery/js/bootstrap-image-gallery.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/jquery.iframe-transport.js"></script><!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/jquery.fileupload.js"></script><!-- The basic File Upload plugin -->
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/jquery.fileupload-fp.js"></script><!-- The File Upload file processing plugin -->
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/jquery.fileupload-ui.js"></script><!-- The File Upload user interface plugin -->
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/locale.js"></script><!-- The localization script -->
<script src="<?php echo asset_url(); ?>js/jqueryupload/js/main.js"></script><!-- The main application script -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->
		<?php
	}
}

if (!function_exists('vote_box'))
{
	function vote_box($resource_id,$resource_type)
	{
		$CI =& get_instance();
		?>
		<!--<div class="votebox pull-left">-->
			<?php
				if($CI->mo9->user_voted($CI->mo9->get_user_id(),$resource_id,$resource_type)):
					?>
					<li class="upvote"><?php echo $CI->mo9->get_votes($resource_id,$resource_type,'1');?></li>
					<li class="downvote"><?php echo $CI->mo9->get_votes($resource_id,$resource_type,'-1');?></li>
					<li><a  data-toggle="modal" href="#report" class="reportme" title="تبليغ" resource-type="<?=$resource_type;?>" resource-id="<?=$resource_id;?>"><i class="icon-bullhorn"></i></a>
					</li>
					<?php
				else:
					?>
					<li><a title="<?php echo $CI->mo9->get_votes($resource_id,$resource_type,'1');?>"><i resource-type="<?=$resource_type;?>" resource-id="<?=$resource_id;?>" vote-value="upvote" class="icon-thumbs-up vote"></i></a></li>
					<li><a title="<?php echo $CI->mo9->get_votes($resource_id,$resource_type,'-1');?>"><i resource-type="<?=$resource_type;?>" resource-id="<?=$resource_id;?>" vote-value="downvote" class="icon-thumbs-down vote"></i></a></li>
					<li><a><i  data-toggle="modal" href="#report" class="reportme icon-bullhorn" title="تبليغ" resource-type="<?=$resource_type;?>" resource-id="<?=$resource_id;?>"></i></a></li>
					<?php
				endif;
			?>
		<!--</div>-->
		
		<?php
	}
}


if (!function_exists('show_comment'))
{
	function show_comment($comment)
	{
		$CI =& get_instance();
		?>
		<li id="comment-<?=$comment->id;?>" class="media comment-container comment-hide" itemscope itemtype="http://schema.org/UserComments">
			<a class="pull-right" href="#">
				<img class="media-object" data-src="holder.js/32x32" alt="32x32" style="width: 32px; height: 32px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACDUlEQVR4Xu2Yz6/BQBDHpxoEcfTjVBVx4yjEv+/EQdwa14pTE04OBO+92WSavqoXOuFp+u1JY3d29rvfmQ9r7Xa7L8rxY0EAOAAlgB6Q4x5IaIKgACgACoACoECOFQAGgUFgEBgEBnMMAfwZAgaBQWAQGAQGgcEcK6DG4Pl8ptlsRpfLxcjYarVoOBz+knSz2dB6vU78Lkn7V8S8d8YqAa7XK83ncyoUCjQej2m5XNIPVmkwGFC73TZrypjD4fCQAK+I+ZfBVQLwZlerFXU6Her1eonreJ5HQRAQn2qj0TDukHm1Ws0Ix2O2260RrlQqpYqZtopVAoi1y+UyHY9Hk0O32w3FkI06jkO+74cC8Dh2y36/p8lkQovFgqrVqhFDEzONCCoB5OSk7qMl0Gw2w/Lo9/vmVMUBnGi0zi3Loul0SpVKJXRDmphvF0BOS049+n46nW5sHRVAXMAuiTZObcxnRVA5IN4DJHnXdU3dc+OLP/V63Vhd5haLRVM+0jg1MZ/dPI9XCZDUsbmuxc6SkGxKHCDzGJ2j0cj0A/7Mwti2fUOWR2Km2bxagHgt83sUgfcEkN4RLx0phfjvgEdi/psAaRf+lHmqEviUTWjygAC4EcKNEG6EcCOk6aJZnwsKgAKgACgACmS9k2vyBwVAAVAAFAAFNF0063NBAVAAFAAFQIGsd3JN/qBA3inwDTUHcp+19ttaAAAAAElFTkSuQmCC">
			</a>
			<div class="media-body">
				<?=$comment->author_link;?>
				
				<!-- <a class="author" href="<?=(($comment->user_id==0)? $comment->author_url : base_url().'/members/'.$comment->username);?>" itemprop="creator">
				<?=(($comment->user_id==0)?$comment->author:$comment->username);?>
				</a>-->
				<span itemprop="commentText"><?=$comment->content?></span>
			</div>
			<div class="muted meta">
				<time class="timeago" datetime="<?=mdate("%c", mysql_to_unix($comment->date_added));?>" itemprop="commentTime"><?=mdate("%Y / %m / %d", mysql_to_unix($comment->date_added));?></time>
				<div class="admin-tools pull-left">
					<ul class="inline">
					<?php vote_box($comment->id,10); ?>
					<?php if($CI->ion_auth->is_admin()):?>
						<li><a href="#deleteModal" role="button" data-toggle="modal"><i class="icon-trash"></i></a></li>
					<?php endif; ?>	
					</ul>
				</div>
			</div>
		</li>
	
		<!-- if is admin: Put delete modal markup -->
		<?php if($CI->ion_auth->is_admin()):?>
			<div class="modal hide fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">تأكيد الحذف</h3>
				</div>
				<div class="modal-body">
					<p>هل أنت متأكد من أنك تريد مسح هذا التعليق؟</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">إلغاء</button>
					<a href="<?=base_url();?>home/delete_replies/<?=$comment->id;?>" class="btn btn-primary">حذف</a>
				</div>
			</div>
		<?php endif;?>
		<?php
	}
}

if (!function_exists('comment_box'))
{
	function comment_box($resource_id,$resource_type,$title,$limit,$hide_comment_input)
	{
		$CI =& get_instance();
		$comments = $CI->mo9->get_replies(array('resource_id'=>$resource_id));
		$comments_count = count($comments);
		$has_more = FALSE;
		if(isset($limit))
		{
			$comments = $CI->mo9->get_replies(array('resource_id'=>$resource_id,'limit'=>$limit));
			$has_more = ($comments_count > $limit);
			//echo $has_more;
		}
	?>
	<!-- Comments Area -->
	<div id="comments" class="comments row-fluid">
			<div class="row-fluid">
				<ul id="post-<?=$resource_id;?>-comments" class="media-list">
				<?php if(!empty($comments)) : ?>
						<?php foreach($comments as $comment) :?>
							<?php show_comment($comment); ?>
						<?php endforeach; ?>
				<?php else: ?>
					<!--<div dir="rtl" class="alert alert">
						<p>لايوجد تعليقات حالياً, قم بإضافة تعليقك</p>
					</div>-->
				<?php endif; ?>
				
				<?php if($has_more) : ?>
					<li class="media comment-container comment-load-more">
						<div class="media-body">باقي <?=($comments_count - $limit);?> تعليقات غير معروضة, <a loaded-comments="<?=$limit;?>" comments-count="<?=$comments_count;?>" resource-id="<?=$resource_id;?>" title="اعرض التعليقات الباقية" class="load_more_comments" href="#">إعرضها</a></div>
					</li>
				<?php endif; ?>
				
					<li id="comment-form-<?=$resource_id;?>" class="media <?=($hide_comment_input)? "hide " : "" ?>comment-container">
						<a class="pull-right" href="#">
							<img class="media-object" data-src="holder.js/32x32" alt="32x32" style="width: 32px; height: 32px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACDUlEQVR4Xu2Yz6/BQBDHpxoEcfTjVBVx4yjEv+/EQdwa14pTE04OBO+92WSavqoXOuFp+u1JY3d29rvfmQ9r7Xa7L8rxY0EAOAAlgB6Q4x5IaIKgACgACoACoECOFQAGgUFgEBgEBnMMAfwZAgaBQWAQGAQGgcEcK6DG4Pl8ptlsRpfLxcjYarVoOBz+knSz2dB6vU78Lkn7V8S8d8YqAa7XK83ncyoUCjQej2m5XNIPVmkwGFC73TZrypjD4fCQAK+I+ZfBVQLwZlerFXU6Her1eonreJ5HQRAQn2qj0TDukHm1Ws0Ix2O2260RrlQqpYqZtopVAoi1y+UyHY9Hk0O32w3FkI06jkO+74cC8Dh2y36/p8lkQovFgqrVqhFDEzONCCoB5OSk7qMl0Gw2w/Lo9/vmVMUBnGi0zi3Loul0SpVKJXRDmphvF0BOS049+n46nW5sHRVAXMAuiTZObcxnRVA5IN4DJHnXdU3dc+OLP/V63Vhd5haLRVM+0jg1MZ/dPI9XCZDUsbmuxc6SkGxKHCDzGJ2j0cj0A/7Mwti2fUOWR2Km2bxagHgt83sUgfcEkN4RLx0phfjvgEdi/psAaRf+lHmqEviUTWjygAC4EcKNEG6EcCOk6aJZnwsKgAKgACgACmS9k2vyBwVAAVAAFAAFNF0063NBAVAAFAAFQIGsd3JN/qBA3inwDTUHcp+19ttaAAAAAElFTkSuQmCC">
						</a>
						<div class="media-body">
							<div>
								<?php if($CI->ion_auth->logged_in() ||  $CI->Settings->visitor_comments) : ?>
									<?php echo form_open('replies/submit');?>
										<?php echo form_hidden('resource_id', $resource_id); ?>
										<?php echo form_hidden('resource_type', $resource_type); ?>
										<?php echo form_hidden('title', $title); ?>
										
										<?php if(!$CI->ion_auth->logged_in()): ?>
											<?php
											$visitor_cookie = array('author'=>'','author_email'=>'','author_url'=>'');
											$visit_cookie = $CI->input->cookie('visitor_info');
											if($visit_cookie)
											{
												$visitor_cookie = json_decode($visit_cookie);
											}
											$author = ((!empty($visitor_cookie->author))? $visitor_cookie->author : 'إسمك');
											$author_email = ((!empty($visitor_cookie->author_email))? $visitor_cookie->author_email : 'إيميلك');
											$author_url = ((!empty($visitor_cookie->author_url))? $visitor_cookie->author_url : 'موقعك');
											?>
											<?php text_box_item('','author',$author,'',' highlight'); ?>
											<?php text_box_item('','author_email',$author_email,'',' highlight'); ?>
											<?php text_box_item('','author_url',$author_url,'',' highlight'); ?>
										<?php endif; ?>

										<?php text_box_item('','content','تعليقك','','input-block-level'); ?>
											<?php echo form_submit(array('class'=>'btn btn-primary','value'=>'إرسال')); ?>
									<?php echo form_close();?>
								<?php else : ?>
									<div dir="rtl" class="alert alert">
										<p>قم <a data-toggle="modal" href="#login" >بالتسجيل</a> معنا لإضافة تعليقك.</p>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	<?php
	}
}

if (!function_exists('show_post'))
{
	function show_post($record,$show_comments = FALSE,$comment_limit = null,$hide_comment_input = FALSE)
	{
		$CI =& get_instance();
	?>
	<article class="posts" id="post-<?=$record->id;?>" itemscope itemtype="http://schema.org/BlogPosting">
		<div class="row-fluid">
		<!-- Thumbnail -->
			<div class="span1" style="width:60px;">
				<?php show_thumb(@$record->image); ?>
			</div>
		<!-- Post Content -->
			<div class="span11">	
				<div class="joke_content" >
					<p data-inputclass="input-block-level" data-toggle="manual" data-type="textarea" data-pk="<?=$record->id;?>" data-url="<?=base_url();?>posts/ajax_edit" data-original-title="عدل النكتة براحتك" itemprop="articleBody"> <?=nl2br($record->content);?></p>
				</div>
				<div class="joke_tags">
				<?php show_post_tags($record->tags); ?>
				</div>
				<div class="joke_meta">
					<div class="muted meta">
						<div class="meta-content row-fluid">
							<div dir="rtl" class="pull-right span6">
								<span itemprop="author">
									كتبها <a dir="rtl" class="author" href="<?=base_url().'members/'.$record->username;?>"><?=$record->username;?></a>
								</span>
								<span>
									<time class="timeago" datetime="<?=mdate("%c", mysql_to_unix($record->date_modified));?>" itemprop="dateModified">
									<?=mdate("%d/%m/%Y", mysql_to_unix($record->date_modified))?>
									</time>
								</span>
							</div>
							<div class="span4 pull-left admin-tools">
								<!-- <a href="Tweet"><i class=" icon-twitter"></i></a> -->
								<?php if($CI->ion_auth->is_admin()) : ?>
									<a href="#post-<?=$record->id;?>" title="force tweet" class="admin-tweet" resource-id="<?=$record->id?>"><i style="color:red;" class="icon-twitter"></i></a>
									<a class="edit_joke" title="تحرير" joke-id="<?=$record->id?>" href="#post-<?=$record->id;?>"><i class="icon-edit"></i></a>
								<?php endif; ?>
								<!--<?=base_url().'jokes/'.urlencode($record->slug)."/#comments";?>-->
								<a class="joke_reply_button" title="رد" resource-id="<?=$record->id;?>" href="#comment-form-<?=$record->id;?>"><i class="icon-comments"></i> <small>(<?=$record->comments_count;?>)</small></a>
								<a href="<?=base_url().'jokes/'.urlencode($record->slug)?>" title="رابط مباشر"><i class="icon-link"></i></a>
								
								<!--<a href="#">حذف</a>-->
							</div>
						</div>
					</div>
					<?php if($show_comments) comment_box($record->id,2,'Comment on posts',$comment_limit,$hide_comment_input); ?>
				</div>
			</div>
		</div>
	</article>
	<?php
	}
}

if (!function_exists('show_post_tags'))
{
	function show_post_tags($record)
	{
	?>
		<ul class="inline tags">
			<?php foreach($record as $taggy) : ?>
			<li class="tag-<?=$taggy->id;?>"><a href="<?php echo base_url(); ?>tag/<?=urlencode($taggy->slug);?>">#<?=$taggy->title;?></a></li>
			<?php endforeach; ?>
		</ul>
	
	<?php
	}
}


if (!function_exists('show_thumb'))
{
	function show_thumb($imagename,$width=100,$height=100)
	{
	?>
		<div class="thumbnails" style="max-width:90%;">
		<?php if(!empty($imagename)) : ?>
				<a href="<?=uploads_url().'images/'.$imagename;?>" ><img  alt="<?=$imagename?>" src="<?=uploads_url().'images/thumbs/'.$imagename;?>" /></a>
		<?php else : ?>
				<img alt="<?=$imagename?>" width="<?=$width;?>" height="<?=$height;?>" src="http://placehold.it/<?=$width;?>x<?=$height;?>" />
		<?php endif; ?>
		</div>
	<?php
	}
}

if (!function_exists('thumbnail_field'))
{
	function thumbnail_field($image = null)
	{
		$CI =& get_instance();
		if(!empty($image)) : ?>
			<div class="control-group">
				<ul class="thumbnails">
					<li class="">
						<div class="thumbnail">
							<a href="<?=uploads_url().'images/'.$image[0]->server_name;?>">
								<img src="<?=uploads_url().'images/thumbs/'.$image[0]->server_name;?>" />
							</a>
							<h4>الصورة الرمزية</h4>
							<p>إضغط على الصورة الرمزية لعرض الصورة الأصلية</p>
							<a class="btn" href="<?=base_url();?><?=($CI->ion_auth->is_admin())? "admin/" : "" ;?>jcrop/thumbnailize/<?=$image[0]->id;?>">إعادة تعيين</a>
							<a class="btn btn-danger" href="<?=base_url();?><?=($CI->ion_auth->is_admin())? "admin/" : "" ;?>jcrop/delete/<?=$image[0]->id;?>">إزالة</a>
						</div>
					</li>
				</ul>
			</div>
			<?php else : ?>
			<div class="control-group">
				<label class="control-label">إختر الملف</label>
				<div class="controls">
					<?php echo form_upload('Filedata',set_value('Filedata'),array('class'=>'input-xlarge')); ?>
					<p class="help-block">لايوجد صورة رمزية, قم بتعيين واحدة الآن</p>
				</div>
			</div>
		<?php endif;
	}
}


if (!function_exists('breaking_news'))
{
	function breaking_news()
	{
		$CI =& get_instance();
		if($CI->mo9->get_annoucements(null,1)->num_rows >0) : ?>

		<div id="annoucements">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<div class="row-fluid">
			
				<div class="ajel gess2b">عاجل</div>
				<div class="newsfeed">
				<?php 
				$anns = $CI->mo9->get_annoucements(null,1)->result();
				foreach($anns as $an)
				{
					?>
					<a href="<?=($an->link) ? $an->link : "#" ;?>"><?=$an->title;?></a>
				<?php } ?>
				</div>
			</div>
		</div>

		<script>
			$(function() {
			
				$("#annoucements .newsfeed > a:gt(0)").hide();

				setInterval(function() { 
				  $('#annoucements .newsfeed > a:first')
					.fadeOut(1000)
					.next()
					.fadeIn(1000)
					.end()
					.appendTo('#annoucements .newsfeed');
				},  10000);
				
			});
		</script>
		<?php endif; 
	}
}

