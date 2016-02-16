<div class="wrapper">
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($payment_methods) { ?>

  <p><?php echo $text_payment_method; ?></p>
  <table class="radio">
    <?php foreach ($payment_methods as $payment_method) { ?>
    <tr class="highlight">
      <td width="1%"><?php if ($payment_method['code'] == $code || !$code) { ?>
        <?php $code = $payment_method['code']; ?>
        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" checked="checked" />
        <?php } else { ?>
        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" />
        <?php } ?></td>
      <td><label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></label></td>
    </tr>
    <?php } ?>
  </table>

  <?php } ?>
  <div class="form-group">
    <label><?php echo $text_comments; ?></label>
    <textarea name="comment" rows="3" ><?php echo $comment; ?></textarea>
  </div>

  <?php if ($text_agree) { ?>
  <div class="button-block right-side">
    <div class="right"><?php echo $text_agree; ?>
      <?php if ($agree) { ?>
      <input type="checkbox" name="agree" value="1" checked="checked" />
      <?php } else { ?>
      <input type="checkbox" name="agree" value="1" />
      <?php } ?>
      &nbsp;<input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" class="btn" />
    </div>
  </div>
  <?php } else { ?>
  <div class="button-block right-side">

      <input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" class="btn" />

  </div>
</div>
<?php } ?>
<script type="text/javascript"><!--
$('.colorbox').colorbox({
	overlayClose: true,
opacity: 0.5,
width: '95%',
height: '95%',
maxWidth: '800px',
maxHeight: '500px',

});
//--></script>