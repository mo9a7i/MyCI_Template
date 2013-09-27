<!-- Non Human Friendly Stuff goes here -->
   <?php $this->mo9a7i_model->set_views(array('resource_id'=>0,'resource_type'=>3)); ?>
	
	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstro/bootstro.js"></script>
	<!-- <script src="<?php echo asset_url(); ?>js/graphs.js"></script> -->
	<script src="<?php echo asset_url(); ?>js/jcrop/jquery.Jcrop.js"></script>
	<!--<script src="<?php echo asset_url(); ?>js/jquery.rating/jquery.rating.js"></script>-->
	<script src="<?php echo asset_url(); ?>js/jquery.form/jquery.form.js"></script>
	<script src="<?php echo asset_url(); ?>js/bootstrap-editable.js"></script>
	<script src="<?php echo asset_url(); ?>js/jquery.timeago/jquery.timeago.js"></script>
	<script src="<?php echo asset_url(); ?>js/jquery.timeago/locales/jquery.timeago.ar.js"></script>
	
	<!-- Show Hide comments -->
	<script>
	$(document).ready(function(){
		$(".show-hide-comments").click(function(){
			$(".comment-hide").toggle();
			return false;
		});
	});
	</script>
	
	
	<!-- Time ago -->
	<script>
	$(document).ready(function() {
		$("time.timeago").timeago();
	});
	</script>
	

	<!-- Replies -->
	<script>
	$(document).ready(function(){
		$(".joke_reply_button").click(function(){
			var resource_id = $(this).attr("resource-id");
			var identifier = "#comment-form-"+resource_id;
			$(identifier).toggle();
			//return false;
		});
	});
	</script>
	<!-- Tooltips and popovers -->
	<script>
	$(document).ready(function(){
		$('#newJokeHelp').tooltip();
		$("#newJokeHelp").click(function(){
			$("#newJokeRules").toggle();
		});
		
		$('#moderateHelp').tooltip();
		$("#moderateHelp").click(function(){
			$("#moderateRules").toggle();
		});
	});
	</script>
	
	<?php if($this->mo9a7i_model->show_welcome()):?>
	<!-- Tour System -->
	<script>
	$(document).ready(function(){
		$("#f6sny-tour").click(function(){
			$('#welcome').modal('toggle');
			var options = {
				nextButton: '<button class="btn btn-primary btn-xs bootstro-next-btn">وش بعد؟</button>',
				prevButton: '<button class="btn btn-primary btn-xs bootstro-prev-btn">إرجع!</button>',
				finishButton: '<button class="btn btn-xs btn-success bootstro-finish-btn"><i class="icon-ok" ></i> خلاص خلاص فهمت!</button>'

			};
			bootstro.start('.bootstro',options);
			
		});
	});
	</script>
	<?php endif; ?>
	
	<!-- Login System -->
	<script>
		$(function(){
			$('#login').modal({
				keyboard: false,
				show: false
			});
			$('#welcome').modal({
				keyboard: false,
				show: true
			});
		});
	</script>
	
	<!-- Voting System -->
	<script>
		$(document).ready(function(){	
			$(function() {
				$(".vote").click(function() 
				{
					var resource_type = $(this).attr("resource-type");
					var resource_id = $(this).attr("resource-id");
					var value = $(this).attr("vote-value");
					var vote = -1;
					if (value=='upvote')
					{
						vote = 1;
						
					}
						$.ajax({
							type: "POST",
							url: "<?=base_url();?>ajax/submit_vote",
							data: { resource_type: resource_type, resource_id : resource_id, value: vote } 
						});
					$(this).parent().html('شكراً لتصويتك!');
					$(this).parent().attr('class',value);
					return false;
					location.reload();
				});
			});
		});
		</script>
		
		<?php if ($this->ion_auth->is_admin()) : ?>
		<!-- admin tweeting System -->
		<script>
		$("body").delegate(".admin-tweet", "click", function(){
			  var resource_id = $(this).attr("resource-id");
						$.ajax({
							type: "POST",
							url: "<?=base_url();?>ajax/tweet",
							data: { resource_id : resource_id },
							success: function(returned){ 
							 if(returned=="error1")
							 {
								alert('Characters more than 140, cannot be tweeted');return;
							 }
							 else if(returned=="error2")
							 {
								alert('something else happend');
							 }
							 else if(returned=="ok")
							 {
								alert('tweeted successfully'); return; 
							 }
							 else
							 {
								alert('something wrong happened');
							 }
						}});
					
					return;
			});
		</script>
		<?php endif; ?>
		
		<!-- inline Editing System -->
		<script>
		$("body").delegate(".edit_joke", "click", function(){
			$.fn.editable.defaults.mode = 'popup';
				$.fn.editable.defaults.placement = 'bottom';
			  $('.edit_joke').click(function(e) {
					e.stopPropagation();
					var joke_id = $(this).attr("joke-id");
					$('#post-'+joke_id+' .joke_content').editable('show');
					return false;
				});
			});
			
		</script>
		
		<!-- Load more Posts System -->
		<script>
			$(document).ready(function(){
			var num_messages = <?=$total_rows?>;
			var loaded_messages = 0;
			
			
				$("#more_button").click(function(){
					var data_url = $(this).attr("data-url");
					loaded_messages += 20;
					$.get( data_url + loaded_messages, function(data){
						$("#body").append(data);

					});

					if(loaded_messages >= num_messages - 20)
					{
						$("#more_button").hide();
					}
				})
			if(loaded_messages >= num_messages - 20)
					{
						$("#more_button").hide();
					}
			})
		</script>
		
		<!-- Load more Replies System -->
		<script>
			$(document).ready(function(){
			
			var num_comments = <?=$total_rows?>;
			var loaded_messages = 0;
				$(".load_more_comments").click(function(){
				
					var comments_count = $(this).attr("comments-count");
					var resource_id = $(this).attr("resource-id");
					var loaded_comments = $(this).attr("loaded-comments");
					
					$.get( '<?=base_url();?>ajax/get_replies/' + resource_id + '/2/' + loaded_comments, function(data){
						$("#comment-form-" + resource_id).before(data);
					});
				$(this).parent().parent().hide();
				return false;
				})
			})
		</script>
	
	
<!-- Reporting System -->
	<script>
	$(document).ready(function(){
		// Add onclick handler to checkbox w/id checkme
		$('.reportme').click(function(){
			
			$('#report_resource_id').val($(this).attr("resource-id"))
			$('#report_resource_type').val($(this).attr("resource-type"))
			return true;
		});
		
		$('#reportSubmit').click(function(){
			var content = $('#report_content').val();
			var category = $('[name=report_category]').val();
			var resource_type = $('#report_resource_type').val();
			var resource_id = $('#report_resource_id').val();
			var pathname = window.location.href;
			$.ajax({
				type: "POST",
				url: "<?=base_url();?>ajax/submit_report",
				data: { content: content,report_category:category,resource_id:resource_id,resource_type:resource_type, pathname:pathname },
				success: function(){
							$('#report-message').fadeIn();
							setTimeout(function(){
								$("#report").modal('hide');
								$('#report-message').fadeOut();
							},1500);
							
						  } 
			});
			
			return false;
			location.reload();
		});
	});
</script>


<!-- Joke Posting System -->
<script>
$(document).ready(function()
{
	var options = 
	{
		beforeSubmit: function(before) 
		{
			$('#loading').css('display','block');
			$("#success_message").html('');
			$("#failure_message").html('');
			$("#tags").css('display','none');
			$("#textArea").css('display','none');
		},
		success: function(returned) 
		{
			$('#loading').css('display','none');
			
			if(returned == 'error1') {
				$('#failure_message').fadeIn(400);
				$('#failure_message').html('<p>خطأ: إختر على الأقل تصنيف واحد للنكتة.</p>');
				setTimeout("$('#failure_message').fadeOut();",2000);
			}
			else if(returned == 'error2') {
				$('#failure_message').fadeIn(400);
				$('#failure_message').html('<p>خطأ: نكتتك قصيرة مرة.</p>');
				setTimeout("$('#failure_message').fadeOut();",2000);
			}
			else if(returned == 'error3') {
				$('#failure_message').fadeIn(400);
				$('#failure_message').html('<p>خطأ: نكتتك ما تبدا ب <strong>يقول لك, </strong>.</p>');
				setTimeout("$('#failure_message').fadeOut();",2000);
			}
			else if(returned == 'ok'){
				$('#success_message').fadeIn(400);
				$('#success_message').html('<p>ههههههههههههههههه حلوة حلوة, عطنا وحدة بعد</p>');
				$('#joke_area').val('يقول لك, ');
				$(".CheckTags").attr('checked', false);
				setTimeout("$('#success_message').fadeOut();",2000);
				
			}
			else {
				$('#failure_message').fadeIn(400);
				$('#failure_message').html('<p>فيه حاقة غلط ياباشا</p>');
				setTimeout("$('#failure_message').fadeOut();",2000);
			}
			setTimeout("$('#tags').fadeIn();",2000);	
			setTimeout("$('#textArea').fadeIn();",2000);	
			setTimeout("$('#myModalLabel').html('عندك غيرها؟');",2000);
		}
	};
	$("#JokeAdd").submit(function() {$(this).ajaxSubmit(options); return false;	});	
});
</script>

	<!-- Registeration System -->
	<script>
				function IsEmail(email) {
				  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				  return regex.test(email);
				}
						$(document).ready(function()
						{
							$("#checkAvailability").click(function(){
								var username = $('#username').val(); 
								$('#username').parent().removeClass('success').removeClass('error').addClass("warning");
								$('#user-help').html('جاري التأكد من الإتاحة'); 
								check_username_availability();
								return false;
							});
							//Hide div w/id extra
							// Add onclick handler to checkbox w/id checkme
							$('#signupButton').click(function(){
								var email = $('#identity').val();
								var password = $('#password').val();
								var username = $('#username').val();
								$.post("<?php echo base_url(); ?>ajax/register_user", { username: username,password:password,email:email },  
								function(result){  
								//if the result is 1  
								if(result == 1){  
									//Success
									$('#signForm').submit();
									
								}else{  
									//Error  
									alert('حصل خطأ في التسجيل');
								}  
								});
								return false;
							});
							$("#signMe").click(function(){
									//to Show sign in
									$("#Form1").show("fast");
									$("#Form2").hide("fast");
									$("#Submit1").show("fast");
									$("#Submit2").hide("fast");
							});
							
							$("#registerMe").click(function(){
									var email_address = $('#identity').val();
									if(!IsEmail(email_address))
									{
										alert('البريد الإلكتروني الذي وضعته خاطئ, الرجاء وضع بريد إلكتروني صحيح!');
										return false;
									}
									var password = $('#password').val();
									if (!(email_address && password))
									{
										alert('يجب عليك وضع إيميلك وإختيار كلمة مرور للتسجيل بالموقع!');
										return false;
									}
									checkEMailValidity();
							// If checked
							});
						});
						function check_username_availability(){  

							//get the username  
							var username = $('#username').val();  

							//use ajax to run the check  
							$.post("<?php echo base_url(); ?>ajax/check_username_availbility", { username: username },  
							function(result)
							{  
								//if the result is 1  
								if(result == 1)
								{  
									//show that the username is available  
									$('#username').parent().removeClass('warning').removeClass('error').addClass("success");
									$('#user-help').html('الإسم الذي إخترته متاح'); 
									$('#signupButton').removeAttr("disabled");
									$('#signupButton').addClass("btn-success");
								}
								else
								{  
									//show that the username is NOT available  
									$('#username').parent().removeClass('warning').removeClass('success').addClass("error");
									$('#user-help').html('الإسم الذي إخترته غير متاح'); 
									$('#signupButton').attr("disabled", "disabled");
									$('#signupButton').removeClass('btn-success');
								}  
							}
							);  

						}  
						
						function checkEMailValidity()
						{  
							//get the username  
							var email = $('#identity').val();  

							//use ajax to run the check  
							$.post("<?php echo base_url(); ?>ajax/check_email_availbility", { email: email },  
							function(result)
							{  
								//if the result is 1  
								if(result == 1)
								{  
									//show that the username is available  
									$("#Form2").show("fast");
									$("#Form1").hide("fast");
									$("#Submit2").show("fast");
									$("#Submit1").hide("fast");
								}
								else
								{  
									//show that the username is NOT available  
									$('#identity').parent().removeClass('warning').removeClass('success').addClass("error");
									$('#email-help').html('البريد الإلكتروني الذي إخترته غير متاح'); 
									return false;
								}  
							});  
 						}  
					
				</script>
				
	<!-- Moderation System -->
	<script>
	$(document).ready(function(){
		$(".moderate").click(function() 
		{
			var resource_type = $(this).attr("resource-type");
			var resource_id = $(this).attr("resource-id");
			var value = $(this).attr("moderate_value");
				$.ajax({
					type: "POST",
					url: "<?=base_url();?>ajax/moderate",
					data: { resource_type: resource_type, resource_id : resource_id, value: value },
					success: function(){ location.reload(); }
				});
			
			return false;
			
		});
	});
	</script>

	<!--Google Analytics Google Analytics-->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-19560189-1']);
	  _gaq.push(['_setDomainName', 'f6sny.com']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
<!-- 
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			20/3/2013 (My 26th Birthday)
*/
-->