<?php if (count($currencies) > 1) { ?>
  <div id="currency">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

      <div class="selection">
        <?php foreach ($currencies as $currency) { ?>
          <?php if ($currency['symbol_left']) { ?>
            <a title="<?php echo $currency['title']; ?>" onclick="$('input[name='currency_code']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_left']; ?></a>
          <?php } else { ?>
            <a title="<?php echo $currency['title']; ?>" onclick="$('input[name='currency_code']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_right']; ?></a>
          <?php } ?>
        <?php } ?>
      </div>

      <div class="selected">
        <?php foreach ($currencies as $currency) { ?>
          <?php if ($currency['code'] == $currency_code) { ?>
            <?php if ($currency['symbol_left']) { ?>
              <a title="<?php echo $currency['title']; ?>" class="active"><?php echo $currency['symbol_left']; ?></a>
            <?php } else { ?>
              <a title="<?php echo $currency['title']; ?>" class="active"><?php echo $currency['symbol_right']; ?></a>
            <?php } ?>
          <?php } ?>
        <?php } ?>
      </div>

      <input type="hidden" name="currency_code" value="" />
      <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
    </form>
  </div>
<?php } ?>
