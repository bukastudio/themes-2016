<?php echo $header; ?>

<div id="affiliatePaymentPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

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
          </div>

          <div id="pageContent">
            <div class="row">

              <div class="column">
                <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><?php echo $entry_payment; ?></label>
                      <div class="control">
                        <div class="radio">
                          <label for="cheque"><?php if ($payment == 'cheque') { ?>
                            <input type="radio" name="payment" value="cheque" id="cheque" checked="checked" />
                          <?php } else { ?>
                            <input type="radio" name="payment" value="cheque" id="cheque" />
                          <?php } ?>
                          <?php echo $text_cheque; ?></label>
                        </div>
                        <div class="radio">
                          <label for="paypal"><?php if ($payment == 'paypal') { ?>
                          <input type="radio" name="payment" value="paypal" id="paypal" checked="checked" />
                          <?php } else { ?>
                          <input type="radio" name="payment" value="paypal" id="paypal" />
                          <?php } ?>
                          <?php echo $text_paypal; ?></label>
                        </div>
                        <div class="radio">
                          <label for="bank"><?php if ($payment == 'bank') { ?>
                          <input type="radio" name="payment" value="bank" id="bank" checked="checked" />
                          <?php } else { ?>
                          <input type="radio" name="payment" value="bank" id="bank" />
                          <?php } ?>
                          <?php echo $text_bank; ?></label>
                        </div>
                      </div>
                    </div>
                    <div id="payment-cheque" class="payment">
                      <div class="form-group">
                        <label for=""><?php echo $entry_cheque; ?></label>
                        <div class="control">
                          <input type="text" name="cheque" value="<?php echo $cheque; ?>" />
                        </div>
                      </div>
                    </div>
                    <div class="payment" id="payment-paypal">
                      <div class="form-group">
                        <label for=""><?php echo $entry_paypal; ?></label>
                        <div class="control">
                          <input type="text" name="paypal" value="<?php echo $paypal; ?>" />
                        </div>
                      </div>
                    </div>
                    <div id="payment-bank" class="payment">
                      <div class="form-group">
                        <label for=""><?php echo $entry_bank_name; ?></label>
                        <div class="control">
                          <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for=""><?php echo $entry_bank_branch_number; ?></label>
                        <div class="control">
                          <input type="text" name="bank_branch_number" value="<?php echo $bank_branch_number; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for=""><?php echo $entry_bank_swift_code; ?></label>
                        <div class="control">
                          <input type="text" name="bank_swift_code" value="<?php echo $bank_swift_code; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for=""><?php echo $entry_bank_account_name; ?></label>
                        <div class="control">
                          <input type="text" name="bank_account_name" value="<?php echo $bank_account_name; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for=""><?php echo $entry_bank_account_number; ?></label>
                        <div class="control">
                          <input type="text" name="bank_account_number" value="<?php echo $bank_account_number; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="button-block">
                          <input type="submit" value="<?php echo $button_continue; ?>" class="button" /><a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                </form>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('input[name=\'payment\']').bind('change', function() {
	$('.payment').hide();

	$('#payment-' + this.value).show();
});

$('input[name=\'payment\']:checked').trigger('change');
//--></script>
<?php echo $footer; ?>
