<?php if ($testmode) { ?>
<div class="warning"><?php echo $text_testmode; ?></div>
<?php } ?>
<form action="<?php echo $action; ?>" method="post" id="payment">
  <input type="hidden" name="fp_acc" value="<?php echo $akunFP; ?>" />
  <input type="hidden" name="fp_store" value="<?php echo $store; ?>" />
  <input type="hidden" name="fp_item" value="<?php echo $detail; ?>" />
  <input type="hidden" name="fp_amnt" value="<?php echo $totalfix; ?>" />
  <input type="hidden" name="fp_currency" value="<?php echo $currency_code; ?>" />
  <input type="hidden" name="fp_merchant_ref" value="<?php echo $custom; ?>" />
  <input type="hidden" name="order_id" value="<?php echo $custom; ?>" />
  
</form>
<div class="buttons">
  <div class="right"><a id="button-confirm" class="button" onclick="$('#payment').submit();"><span><?php echo $button_confirm; ?></span></a></div>
</div>
</div>