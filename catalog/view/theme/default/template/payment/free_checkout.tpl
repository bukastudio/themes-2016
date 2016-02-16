<div class="button-block right-side">
  <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({
		type: 'get',
		url: 'index.php?route=payment/free_checkout/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}
	});
});
//--></script>
