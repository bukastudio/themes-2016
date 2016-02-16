<div class="row">

  <div id="login" class="left column">
    <h3><?php echo $text_returning_customer; ?></h3>
    <p><?php echo $text_i_am_returning_customer; ?></p>

    <div class="form-group">
      <label for=""><?php echo $entry_email; ?></label>
      <input type="text" name="email" value="" />
    </div>

    <div class="form-group">
      <label for=""><?php echo $entry_password; ?></label>
      <input type="password" name="password" value="" />
    </div>

    <div class="form-group">
      <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
    </div>

    <div class="form-group">
      <input type="button" value="<?php echo $button_login; ?>" id="button-login" class="btn" />
    </div>

  </div>
  <div class="right column">
    <h3><?php echo $text_new_customer; ?></h3>
    <p><?php echo $text_checkout; ?></p>
    <div class="form-group">
      <div class="radio">
        <?php if ($account == 'register') { ?>
        <input type="radio" name="account" value="register" id="register" checked="checked" />
        <?php } else { ?>
        <input type="radio" name="account" value="register" id="register" />
        <?php } ?>
        <label for="register"><?php echo $text_register; ?></label>
      </div>
      <?php if ($guest_checkout) { ?>
        <div class="radio">
          <?php if ($account == 'guest') { ?>
          <input type="radio" name="account" value="guest" id="guest" checked="checked" />
          <?php } else { ?>
          <input type="radio" name="account" value="guest" id="guest" />
          <?php } ?>
          <label for="guest"><?php echo $text_guest; ?></label>
        </div>
      <?php } ?>
    </div><br>
    <p><?php echo $text_register_account; ?></p>
    <input type="button" value="<?php echo $button_continue; ?>" id="button-account" class="btn btn-neutral" />
  </div>

</div>