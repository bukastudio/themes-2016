<p><strong><?php echo $text_instruction; ?></strong></p>
<p><?php echo $text_description; ?></p>
<p><?php echo $bank; ?></p>
<p><?php echo $text_payment; ?></p>
<!-- <div class="buttons" style="display:none">
  <div class="right"><a id="button-confirm" class="button btn-primary"><span><?php echo $button_confirm; ?></span></a></div>
</div> -->
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({
		type: 'GET',
		url: 'index.php?route=payment/bank_transfer_bii/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}
	});
});
//--></script>
