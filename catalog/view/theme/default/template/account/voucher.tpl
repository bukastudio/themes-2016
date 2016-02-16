



<?php echo $header; ?>

<div id="voucherPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
      <?php } ?>

      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow">
      <?php echo $content_top ;?>
    </div>

    <div class="contentRow sidebarNone">
      <div class="row">

        <div class="columnCenter">

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
            <p><?php echo $text_description; ?></p>
          </div>

          <div id="pageContent">
            <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="column">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_to_name; ?></label>
                      <div class="control">
                        <input type="text" name="to_name" value="<?php echo $to_name; ?>" />
                      <?php if ($error_to_name) { ?>
                        <span class="error"><?php echo $error_to_name; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_to_email; ?></label>
                      <div class="control">
                        <input type="text" name="to_email" value="<?php echo $to_email; ?>" />
                      <?php if ($error_to_email) { ?>
                        <span class="error"><?php echo $error_to_email; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_from_name; ?></label>
                      <div class="control">
                        <input type="text" name="from_name" value="<?php echo $from_name; ?>" />
                      <?php if ($error_from_name) { ?>
                        <span class="error"><?php echo $error_from_name; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_from_email; ?></label>
                      <div class="control">
                        <input type="text" name="from_email" value="<?php echo $from_email; ?>" />
                      <?php if ($error_from_email) { ?>
                        <span class="error"><?php echo $error_from_email; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_theme; ?></label>
                      <div class="control">
                        <?php foreach ($voucher_themes as $voucher_theme) { ?>
                          <?php if ($voucher_theme['voucher_theme_id'] == $voucher_theme_id) { ?>
                            <div class="checkbox">
                              <label for="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>"><input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" id="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>" checked="checked" />
                              <?php echo $voucher_theme['name']; ?></label>
                            </div>
                          <?php } else { ?>
                            <div class="checkbox">
                              <label for="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>"><input type="radio" name="voucher_theme_id" value="<?php echo $voucher_theme['voucher_theme_id']; ?>" id="voucher-<?php echo $voucher_theme['voucher_theme_id']; ?>" />
                              <?php echo $voucher_theme['name']; ?></label>
                            </div>
                          <?php } ?>
                        <?php } ?>
                        <?php if ($error_theme) { ?>
                          <span class="error"><?php echo $error_theme; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                  </fieldset>
                </div>

                <div class="column">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><?php echo $entry_message; ?></label>
                      <div class="control">
                        <textarea name="message" cols="40" rows="3"><?php echo $message; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_amount; ?></label>
                      <div class="control">
                        <input type="text" name="amount" value="<?php echo $amount; ?>" size="5" />
                      <?php if ($error_amount) { ?>
                        <span class="error"><?php echo $error_amount; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="button-block">
                        <?php if ($text_agree) { ?>
                          <div class="agree-term">
                            <?php if ($agree) { ?>
                              <input type="checkbox" name="agree" value="1" checked="checked" />
                            <?php } else { ?>
                              <input type="checkbox" name="agree" value="1" />
                            <?php } ?>
                            <?php echo $text_agree; ?>
                          </div>
                        <?php } ;?><br>
                        <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
                      </div>
                    </div>
                  </fieldset>
                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
