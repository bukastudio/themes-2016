<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarLeft";} else {$slotclass = "sidebarNone";};?>

<div id="paymentConfirmationPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnLeft sideBar">
          <?php echo $column_left ;?>
        </div>

        <div class="columnCenter">
          <?php echo $content_top ;?>

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <div class="formContainer">
            <div class="row">
              <div class="formBox">

                <form class="form--horizontal" action="<?php echo str_replace('&', '&amp;', $action); ?>" method="post" enctype="multipart/form-data" id="contact">
                  <fieldset>
                    <legend>
                      Please fill in the form below
                    </legend>
            					<div class="form-group">
            						<label for="invoice_number"><?php echo $entry_invoice_number; ?><span class="required">*</span></label>
            						<div class="form-control">
            							<input type="text" name="invoice_number" value="<?php echo $invoice_number; ?>" />
            							<?php if ($error_invoice_number) { ?>
                            <span class="error"><?php echo $error_invoice_number; ?></span>
                          <?php } ?>
            						</div>
            					</div>

                      <div class="form-group">
            						<label for="email"><?php echo $entry_email; ?><span class="required">*</span></label>
            						<div class="form-control">
            							<input type="text" name="email" value="<?php echo $email; ?>" />
                          <?php if ($error_email) { ?>
                            <span class="error"><?php echo $error_email; ?></span>
                          <?php } ?>
            						</div>
            					</div>

                      <div class="form-group">
            						<label for=""><?php echo $text_bank_receiver; ?><span class="required">*</span></label>
            						<div class="form-control">
            							<?php if($banks){ ?>
                            <select name="bank_receiver" size="1">
                              <option value="">--- <?php echo $text_select_account; ?> ---</option>
                              <?php foreach ($banks as $bank) { ?>
                                 <?php if ($bank['bank_id'] == $bank_receiver) { ?>
                                    <option value="<?php echo $bank['name']; ?> <?php echo $bank['branch']; ?>, <?php echo $text_acc_no; ?> <?php echo $bank['account_number']; ?>, <?php echo $text_acc_holder; ?> <?php echo $bank['account_holder']; ?>" selected="selected"><?php echo $bank['name']; ?> <?php echo $bank['branch']; ?>, <?php echo $text_acc_no; ?> <?php echo $bank['account_number']; ?>, <?php echo $text_acc_holder; ?> <?php echo $bank['account_holder']; ?></option>
                                 <?php } else { ?>
                                    <option value="<?php echo $bank['name']; ?> <?php echo $bank['branch']; ?>, <?php echo $text_acc_no; ?> <?php echo $bank['account_number']; ?>, <?php echo $text_acc_holder; ?> <?php echo $bank['account_holder']; ?>"><?php echo $bank['name']; ?> <?php echo $bank['branch']; ?>, <?php echo $text_acc_no; ?> <?php echo $bank['account_number']; ?>, <?php echo $text_acc_holder; ?> <?php echo $bank['account_holder']; ?></option>
                                 <?php } ?>
            		               <?php } ?>
            		             </select>
            		            <?php if ($error_bank_receiver) { ?>
            		              <span class="error"><?php echo $error_bank_receiver; ?></span>
            		            <?php } ?>
            		          <?php } ?>
            						</div>
            					</div>
            					<div class="form-group">
            						<label for=""><?php echo $entry_payment_amount; ?><span class="required">*</span></label>
            						<div class="form-control">
            							<input type="text" name="payment_amount" value="<?php echo $payment_amount; ?>" />
                          <?php if ($error_payment_amount) { ?>
                            <span class="error"><?php echo $error_payment_amount; ?></span>
                          <?php } ?>
            						</div>
            					</div>
            					<div class="form-group date-selector">
            						<label for=""><?php echo $entry_payment_date; ?><span class="required">*</span></label>
            						<div class="form-control">
            							<input class="day-input" type="text" size="3" maxlength="2" name="payment_date_day" value="<?php echo $payment_date_day; ?>" />
                          <select class="month-input" name="payment_date_month" size="1">
                            <option value="<?php echo $text_january; ?>"><?php echo $text_january; ?></option>
                            <option value="<?php echo $text_february; ?>"><?php echo $text_february; ?></option>
                            <option value="<?php echo $text_march; ?>"><?php echo $text_march; ?></option>
                            <option value="<?php echo $text_april; ?>"><?php echo $text_april; ?></option>
                            <option value="<?php echo $text_may; ?>"><?php echo $text_may; ?></option>
                            <option value="<?php echo $text_june; ?>"><?php echo $text_june; ?></option>
                            <option value="<?php echo $text_july; ?>"><?php echo $text_july; ?></option>
                            <option value="<?php echo $text_august; ?>"><?php echo $text_august; ?></option>
                            <option value="<?php echo $text_september; ?>"><?php echo $text_september; ?></option>
                            <option value="<?php echo $text_october; ?>"><?php echo $text_october; ?></option>
                            <option value="<?php echo $text_november; ?>"><?php echo $text_november; ?></option>
                            <option value="<?php echo $text_december; ?>"><?php echo $text_december; ?></option>
                          </select>
                          <select class="year-input" name="payment_date_year" size="1">
                            <option value="<?php echo $one_year_before; ?>"><?php echo $one_year_before; ?></option>
                            <option value="<?php echo $this_year; ?>" selected="selected"><?php echo $this_year; ?></option>
                          </select>
                          <?php if ($error_payment_date_day) { ?>
                            <span class="error"><?php echo $error_payment_date_day; ?></span>
                          <?php } ?>
            						</div>
            					</div>
            					<div class="form-group captcha">
            						<label for="">&nbsp;</label>
            						<div class="form-control">
            							<?php echo $entry_captcha; ?><br>
                          <img src="index.php?route=information/contact/captcha" />
                          <input class="input-mini" type="text" name="captcha" value="<?php echo $captcha; ?>" autocomplete="off" />
                          <?php if ($error_captcha) { ?>
                            <span class="error"><?php echo $error_captcha; ?></span>
                          <?php } ?>
            						</div>
            					</div>
            					<div class="form-group">
            						<label for="">&nbsp;</label>
            						<div class="form-control">
            							<div class="button-block"><a onclick="$('#contact').submit();" class="button btn--large"><span><?php echo $button_continue; ?></span></a>
                          </div>
            						</div>
            					</div>

                  </fieldset>
                </form>

              </div>
            </div>
          </div>

          <?php echo $content_bottom ;?>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>
