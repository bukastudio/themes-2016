<?php
//==============================================================================
// MailChimp Integration v156.1
//
// Author: Clear Thinking, LLC
// E-mail: johnathan@getclearthinking.com
// Website: http://www.getclearthinking.com
//==============================================================================
?>

<?php $module_id = rand(); ?>

<!-- <style type="text/css">
	.mi-message {
		display: none;
		font-size: 11px;
		margin-bottom: 6px;
	}
	.mi-message a {
		font-size: 11px;
	}
	.mi-block {
		display: inline-block;
		margin: 4px;
	}
	.mi-email, .mi-name {
		width: 140px;
	}
	.mi-loading {
		display: none;
	}
</style> -->

<?php if ($popup) { ?>
	<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/colorbox/colorbox.css" media="screen" />
	<script type="text/javascript" src="catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js"></script>
	<style type="text/css">
		.mailchimp-integration {
			display: none;
		}
	</style>
	<script type="text/javascript"><!--
		$(document).ready(function(){
			$('.mailchimp-popup').colorbox({
				fixed: true,
				inline: true,
				width: '184px',
				height: '250px'
			});
		});
	//--></script>
<?php } ?>
<div class="mi-message"></div>
<div class="module-mailchimp">

  <div class="module_header">
    <div id="mailchimp-title" class="mi-block"><?php echo $heading_title ;?></div>
  </div>
	<div class="module_content">


		<div class="wrapper">
		  <?php if ($name_field != 'none') { ?>
		    <div id="mailchimp-name" class="mi-block">
		      <input placeholder="<?php echo $text_name; ?>" type="text" class="mi-name" onkeydown="if (event.keyCode == 13) miSubscribe<?php echo $module_id; ?>($(this))" />
		    </div>
		  <?php } ?>

		  <div id="mailchimp-email" class="mi-block">
		    <input placeholder="<?php echo $text_email_address; ?>" type="text" class="mi-email" onkeydown="if (event.keyCode == 13) miSubscribe<?php echo $module_id; ?>($(this))" />
		  </div>


		  <div id="mailchimp-button" class="mi-block">
		    <a class="button" onclick="miSubscribe<?php echo $module_id; ?>($(this))"><i class="icon-paper-plane "></i><span><?php echo $button_subscribe; ?></span></a>
		    <img class="mi-loading" src="catalog/view/theme/default/image/loading<?php if ($version < 150) echo '_1'; ?>.gif" />
		  </div>
		</div>

	</div>
</div>

<script type="text/javascript"><!--
	function miSubscribe<?php echo $module_id; ?>(element) {
		var message = element.parent().parent().find('.mi-message');
		var email = $.trim(element.parent().parent().find('.mi-email').val());
		var name = $.trim(element.parent().parent().find('.mi-name').val());
		var loading = element.parent().parent().find('.mi-loading');

		loading.show();
		message.slideUp(function(){
			message.removeClass('attention success warning');
			if (!email.match(/^[^\@]+@.*\.[a-z]{2,6}$/i)) {
				message.html('<?php echo str_replace("'", "\'", $text_please_use); ?>').addClass('<?php echo ($version < 150) ? 'warning' : 'attention'; ?>').slideDown();
				loading.hide();
		<?php if ($name_field == 'required') { ?>
			} else if (!name) {
				message.html('<?php echo str_replace("'", "\'", $text_please_fill_in); ?>').addClass('<?php echo ($version < 150) ? 'warning' : 'attention'; ?>').slideDown();
				loading.hide();
		<?php } ?>
			} else {
				$.ajax({
					type: 'POST',
					url: 'index.php?route=<?php echo $type; ?>/<?php echo $name; ?>/subscribe',
					data: {email: email, name: name},
					dataType: 'json',
					success: function(error) {
						if (error['code'] == 0) {
							<?php if ($redirect) { ?>
								alert('<?php echo $text_success; ?>');
								location = '<?php echo $redirect; ?>';
							<?php } else { ?>
								message.html('<?php echo str_replace("'", "\'", $text_success); ?>').addClass('success').slideDown();
							<?php } ?>
						} else if (error['code'] == 214) {
							message.html(<?php echo ($text_already_subscribed) ? '\'' . str_replace("'", "\'", $text_already_subscribed) . '\'' : 'error[\'error\']'; ?>).addClass('attention').slideDown();
						} else {
							message.html(<?php echo ($text_error) ? '\'' . str_replace("'", "\'", $text_error) . '\'' : 'error[\'error\']'; ?>).addClass('warning').slideDown();
						}
						loading.hide();
					}
				});
			}
		});
	}
//--></script>
