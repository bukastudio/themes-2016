<?php echo $header; ?>

<div id="returnFormPage" class="contentSlot">
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
          </div>

          <div id="pageContent">
            <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="column">
                  <fieldset>
                    <legend><?php echo $text_order; ?></legend>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_firstname; ?></label>
                      <div class="control">
                        <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="large-field" />
                        <?php if ($error_firstname) { ?>
                          <span class="error"><?php echo $error_firstname; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_lastname; ?></label>
                      <div class="control">
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>" class="large-field" />
                        <?php if ($error_lastname) { ?>
                          <span class="error"><?php echo $error_lastname; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_email; ?></label>
                      <div class="control">
                        <input type="text" name="email" value="<?php echo $email; ?>" class="large-field" />
                        <?php if ($error_email) { ?>
                          <span class="error"><?php echo $error_email; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_telephone; ?></label>
                      <div class="control">
                        <input type="text" name="telephone" value="<?php echo $telephone; ?>" class="large-field" />
                        <?php if ($error_telephone) { ?>
                          <span class="error"><?php echo $error_telephone; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_order_id; ?></label>
                      <div class="control">
                        <input type="text" name="order_id" value="<?php echo $order_id; ?>" class="large-field" />
                        <?php if ($error_order_id) { ?>
                          <span class="error"><?php echo $error_order_id; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $entry_date_ordered; ?></label>
                      <div class="control"><input type="text" name="date_ordered" value="<?php echo $date_ordered; ?>" class="large-field date" /></div>
                    </div>
                  </fieldset>
                </div>

                <div class="column">
                  <fieldset>
                    <legend><?php echo $text_product; ?></legend>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_product; ?></label>
                      <div class="control">
                        <input type="text" name="product" value="<?php echo $product; ?>" />
                        <?php if ($error_product) { ?>
                          <span class="error"><?php echo $error_product; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_model; ?></label>
                      <div class="control">
                        <input type="text" name="model" value="<?php echo $model; ?>" />
                        <?php if ($error_model) { ?>
                          <span class="error"><?php echo $error_model; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $entry_quantity; ?></label>
                      <div class="control"><input type="text" name="quantity" value="<?php echo $quantity; ?>" /></div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span> <?php echo $entry_reason; ?></label>
                      <div class="control">

                        <?php foreach ($return_reasons as $return_reason) { ?>
                          <?php if ($return_reason['return_reason_id'] == $return_reason_id) { ?>
                            <div class="radio">
                              <label for="return-reason-id<?php echo $return_reason['return_reason_id']; ?>"><input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" id="return-reason-id<?php echo $return_reason['return_reason_id']; ?>" checked="checked" />
                              <?php echo $return_reason['name']; ?></label>
                            </div>
                          <?php } else { ?>
                            <div class="radio">
                              <label for="return-reason-id<?php echo $return_reason['return_reason_id']; ?>"><input type="radio" name="return_reason_id" value="<?php echo $return_reason['return_reason_id']; ?>" id="return-reason-id<?php echo $return_reason['return_reason_id']; ?>" />
                              <?php echo $return_reason['name']; ?></label>
                            </div>
                          <?php  } ?>
                        <?php  } ?>
                        <?php if ($error_reason) { ?>
                          <span class="error"><?php echo $error_reason; ?></span>
                        <?php } ?>

                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $entry_opened; ?></label>
                      <div class="control">
                        <div class="radio radio--inline">
                          <label for="opened">
                          <?php if ($opened) { ?>
                            <input type="radio" name="opened" value="1" id="opened" checked="checked" />
                          <?php } else { ?>
                            <input type="radio" name="opened" value="1" id="opened" />
                          <?php } ?>
                          <?php echo $text_yes; ?></label>

                          <label for="unopened">
                          <?php if (!$opened) { ?>
                            <input type="radio" name="opened" value="0" id="unopened" checked="checked" />
                          <?php } else { ?>
                            <input type="radio" name="opened" value="0" id="unopened" />
                          <?php } ?>
                          <?php echo $text_no; ?></label>
                        </div>
                      </div>
                    </div>


                  </fieldset>
                </div>

                <div class="column">
                  <fieldset>
                    <legend><?php echo $text_other_details; ?></legend>
                    <div class="form-group">
                      <label for=""><?php echo $entry_fault_detail; ?></label>
                      <div class="control"><textarea name="comment" cols="150" rows="3"><?php echo $comment; ?></textarea></div>
                    </div>
                    <div class="form-group captcha">
                      <label for=""><?php echo $entry_captcha; ?></label>
                      <div class="control">

                        <img src="index.php?route=account/return/captcha" alt="" /> <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
                        <?php if ($error_captcha) { ?>
                          <span class="error"><?php echo $error_captcha; ?></span>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                      <div class="control">
                        <div class="button-block">
                          <?php if ($text_agree) { ?>
                            <div class="agree-term">
                              <label for="" class="checkbox"><?php if ($agree) { ?>
                                  <input type="checkbox" name="agree" value="1" checked="checked" />
                                <?php } else { ?>
                                  <input type="checkbox" name="agree" value="1" />
                                <?php } ?>
                                <?php echo $text_agree; ?></label>
                            </div><br>
                            <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
                            <a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                          <?php } else { ?>
                           <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
                            <a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                          <?php } ?>
                        </div>
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


<script type="text/javascript"><!--
$(document).ready(function() {
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<script type="text/javascript"><!--
$('.colorbox').colorbox({
  overlayClose: true,
opacity: 0.5,
width: '95%',
height: '95%',
maxWidth: '800px',
maxHeight: '500px'
});
//--></script>
<?php echo $footer; ?>
