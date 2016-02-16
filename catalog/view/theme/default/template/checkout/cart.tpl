<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarLeft";} else {$slotclass = "sidebarNone";};?>

<!-- /CONTENT -->
<div id="content-slot" class="checkout-page cart-page <?php echo $slotclass ;?>">

  <div class="container">

    <?php if ($attention) { ?>
      <div class="attention"><?php echo $attention; ?><i class="icon-close"></i></div>
    <?php } ?>
    <?php if ($success) { ?>
      <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <?php if ($error_warning) { ?>
      <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div id="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
    </div>

    <div class="row">

      <?php echo $column_left ;?>

      <!-- /Contents -->
      <div id="main-content">
        <?php echo $content_top ;?>

        <h1>
          <?php echo $heading_title; ?>
          <?php if ($weight) { ?>
            &nbsp;<small>(<?php echo $weight; ?>)</small>
          <?php } ?>
        </h1>

        <div id="shopping-cart-column">
          <div class="row">

            <div class="left">
              <form id="basket" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

                <div id="cart-info" class="table table-noborder table-clean table-stiped table-hover">

                  <!-- Heading -->
                  <div class="table-head">
                    <div class="table-row">
                      <div class="image"><?php echo $column_image; ?></div>
                      <div class="name"><?php echo $column_name; ?></div>
                      <div class="model"><?php echo $column_model; ?></div>
                      <div class="quantity"><?php echo $column_quantity; ?></div>
                      <div class="price"><?php echo $column_price; ?></div>
                      <div class="total"><?php echo $column_total; ?></div>
                    </div>
                  </div>
                  <div class="table-body">

                    <!-- /Products -->
                    <?php foreach ($products as $product) { ?>
                      <div class="table-row <?php if (!$product['stock']) { echo "out-of-stock"; } ?>">
                        <div class="image">
                          <?php if ($product['thumb']) { ?>
                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                          <?php } ?>
                        </div>
                        <div class="name">
                          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                          <?php if (!$product['stock']) { ?>
                          <span class="stock">***</span>
                          <?php } ?>
                          <div>
                            <?php foreach ($product['option'] as $option) { ?>
                            <small>- <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                            <?php } ?>
                            <?php if($product['recurring']): ?>
                            <small>- <?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                            <?php endif; ?>

                          <?php if ($product['reward']) { ?>
                            <small>- <?php echo $product['reward']; ?></small>
                          <?php } ?>
                          </div>
                        </div>
                        <div class="model"><?php echo $product['model']; ?></div>
                        <div class="quantity">
                          <input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" />

                          <div>
                            <a onclick="$('#basket').submit();"><i class="icon-sync"></i><span><?php echo $button_update; ?></span></a>

                            <a href="<?php echo $product['remove']; ?>"><i class="icon-close"></i> <span><?php echo $button_remove; ?></span></a>
                          </div>

                        </div>
                        <div class="price"><?php echo $product['price']; ?></div>
                        <div class="total"><?php echo $product['total']; ?><small>@ <?php echo $product['price']; ?></small></div>
                      </div>
                    <?php } ;?>

                    <!-- /Vouchers -->
                    <?php foreach ($vouchers as $vouchers) { ?>
                      <div class="image">&nbsp;</div>
                      <div class="name"><?php echo $vouchers['description']; ?></div>
                      <div class="model">&nbsp;</div>
                      <div class="quantity">
                        <input type="text" name="" value="1" size="1" disabled="disabled" /><a href="<?php echo $vouchers['remove']; ?>">

                        <img src="catalog/view/theme/default/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a>
                      </div>
                      <div class="price"><?php echo $vouchers['amount']; ?></div>
                      <div class="total"><?php echo $vouchers['amount']; ?></div>
                    <?php } ;?>

                  </div>

                  <div class="table-foot">
                    <?php foreach ($totals as $total) { ?>
                      <div class="table-row">
                        <div class="image">&nbsp;</div>
                        <div class="name">&nbsp;</div>
                        <div class="model">&nbsp;</div>
                        <div class="quantity"><strong><?php echo $total['title']; ?>:</strong></div>
                        <div class="price"><strong><?php echo $total['title']; ?>:</strong></div>
                        <div class="total"><strong><?php echo $total['text']; ?></strong></div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div><i class="icon-arrow-left"></i> <a href="<?php echo $continue; ?>"><?php echo $button_shopping; ?></a></div>
              </form>
            </div>
            <!-- End .left -->

            <div class="right">

              <!-- /Cart Total -->
              <div id="cart-total">
                <div class="table table-noborder">
                  <div class="table-body">
                    <?php foreach ($totals as $total) { ?>
                      <div class="table-row">
                        <div class="name"><?php echo $total['title']; ?>:</div>
                        <div class="total"><strong><?php echo $total['text']; ?></strong></div>
                      </div>
                    <?php } ;?>
                  </div>
                </div>
                <div class="button-block">
                  <a href="<?php echo $checkout; ?>" class="btn"><i class="icon-yes"></i> <?php echo $button_checkout; ?></a>
                </div>
              </div>
              <!-- Coupon, Voucher, Reward Points dan Shipping Status -->
              <?php if ($coupon_status || $voucher_status || $reward_status || $shipping_status) { ?>
                <!-- <h4><?php echo $text_next; ?></h4> -->
                <p><?php echo $text_next_choice; ?></p>

                <div class="wrapper">
                  <div class="radio inline">
                    <?php if ($coupon_status) { ?>
                      <?php if ($next == 'coupon') { ?>
                        <input type="radio" name="next" value="coupon" id="use_coupon" checked="checked" />
                      <?php } else { ?>
                        <input type="radio" name="next" value="coupon" id="use_coupon" />
                      <?php } ?></td>
                      <label for="use_coupon"><?php echo $text_use_coupon; ?></label>
                    <?php } ;?>
                  </div>
                  <div class="radio inline">
                    <?php if ($voucher_status) { ?>
                      <?php if ($next == 'voucher') { ?>
                        <input type="radio" name="next" value="voucher" id="use_voucher" checked="checked" />
                      <?php } else { ?>
                        <input type="radio" name="next" value="voucher" id="use_voucher" />
                      <?php } ?></td>
                      <label for="use_voucher"><?php echo $text_use_voucher; ?></label>
                    <?php } ?>
                  </div>
                  <div class="radio inline">
                    <?php if ($reward_status) { ?>
                      <?php if ($next == 'reward') { ?>
                        <input type="radio" name="next" value="reward" id="use_reward" checked="checked" />
                      <?php } else { ?>
                        <input type="radio" name="next" value="reward" id="use_reward" />
                      <?php } ?></td>
                      <label for="use_reward"><?php echo $text_use_reward; ?></label>
                    <?php } ?>
                  </div>
                </div>

                <div id="cart-module">
                  <div id="coupon" class="content" style="display: <?php echo ($next == 'coupon' ? 'block' : 'none'); ?>;">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                      <fieldset>
                        <legend><?php echo $text_use_coupon; ?></legend>
                        <div class="form-group">
                          <label for=""><?php echo $entry_coupon; ?></label>
                          <input type="text" name="coupon" value="<?php echo $coupon; ?>" />
                        </div>
                          <input type="hidden" name="next" value="coupon" />
                          <input type="submit" value="<?php echo $button_coupon; ?>" class="btn" />
                      </fieldset>
                    </form>
                  </div>

                  <div id="voucher" class="content" style="display: <?php echo ($next == 'voucher' ? 'block' : 'none'); ?>;">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                      <fieldset>
                        <legend><?php echo $text_use_voucher; ?></legend>
                        <div class="form-group">
                          <label for=""><?php echo $entry_voucher; ?></label>
                          <input type="text" name="voucher" value="<?php echo $voucher; ?>" />
                          <input type="hidden" name="next" value="voucher" />
                        </div>

                        <input type="submit" value="<?php echo $button_voucher; ?>" class="btn" />
                      </fieldset>
                    </form>
                  </div>

                  <div id="reward" class="content" style="display: <?php echo ($next == 'reward' ? 'block' : 'none'); ?>;">
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                      <fieldset>
                        <legend><?php echo $text_use_reward; ?></legend>
                        <div class="form-group">
                          <label for=""><?php echo $entry_reward; ?></label>
                          <input type="text" name="reward" value="<?php echo $reward; ?>" />
                          <input type="hidden" name="next" value="reward" />
                        </div>

                        <input type="submit" value="<?php echo $button_reward; ?>" class="btn" />
                      </fieldset>
                    </form>
                  </div>

                </div>
                <!-- End #cart-module -->

              <?php } ;?>

              <!-- /Cart Total Mobile-->
              <div id="cart-total" class="mobile">
                <div class="table table-noborder">
                  <div class="table-body">
                    <?php foreach ($totals as $total) { ?>
                      <div class="table-row">
                        <div class="name"><?php echo $total['title']; ?>:</div>
                        <div class="total"><strong><?php echo $total['text']; ?></strong></div>
                      </div>
                    <?php } ;?>
                  </div>
                </div>
                <div class="button-block">
                  <a href="<?php echo $checkout; ?>" class="btn"><i class="icon-yes"></i> <?php echo $button_checkout; ?></a>
                </div>
              </div>
            </div>
            <!-- End .right -->

          </div>
        </div>

        <?php echo $content_bottom ;?>
      </div>

    </div>
    <!-- /End .row -->
    <div id="shipping-estimator">
      <h4><?php echo $text_shipping_estimate; ?></h4>

        <div class="row">
          <div id="country-column" class="form-group">
            <label for=""><?php echo $entry_country; ?><span class="required">*</span></label>
            <select name="country_id">
              <option value=""><?php echo $text_select; ?></option>
              <?php foreach ($countries as $country) { ?>
              <?php if ($country['country_id'] == $country_id) { ?>
              <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div id="zone-column" class="form-group">
            <label for=""><?php echo $entry_zone; ?><span class="required">*</span></label>
            <select name="zone_id"></select>
          </div>
          <div id="postcode-column" class="form-group">
            <label for=""><?php echo $entry_postcode; ?><span id="postcode-required" class="required">*</span></label>
            <input type="text" name="postcode" value="<?php echo $postcode; ?>" />
          </div>
          <div class="form-group" id="button-column">
            <label for="">&nbsp;</label>
            <input type="button" value="<?php echo $button_quote; ?>" id="button-quote" class="btn btn-neutral" />
          </div>
        </div>

    </div>

  </div>
</div>

<script type="text/javascript"><!--
$('input[name=\'next\']').bind('change', function() {
	$('#cart-module > div').hide();

	$('#' + this.value).show();
});
//--></script>
<?php if ($shipping_status) { ?>
<script type="text/javascript"><!--
$('#button-quote').live('click', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/quote',
		type: 'post',
		data: 'country_id=' + $('select[name=\'country_id\']').val() + '&zone_id=' + $('select[name=\'zone_id\']').val() + '&postcode=' + encodeURIComponent($('input[name=\'postcode\']').val()),
		dataType: 'json',
		beforeSend: function() {
			$('#button-quote').attr('disabled', true);
			$('#button-quote').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('#button-quote').attr('disabled', false);
			$('.wait').remove();
		},
		success: function(json) {
			$('.success, .warning, .attention, .error').remove();

			if (json['error']) {
				if (json['error']['warning']) {
					$('#notification').html('<div class="warning" style="display: none;">' + json['error']['warning'] + '<i class="icon-close"></i></div>');

					$('.warning').fadeIn('slow');

					//$('html, body').animate({ scrollTop: 0 }, 'slow');
				}

				if (json['error']['country']) {
					$('select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
				}

				if (json['error']['zone']) {
					$('select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
				}

				if (json['error']['postcode']) {
					$('input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
				}
			}

			if (json['shipping_method']) {
				html  = '<p><?php echo $text_shipping_method; ?></p>';
				html += '<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">';
				html += '  <table class="radio">';

				for (i in json['shipping_method']) {
					html += '<tr>';
					html += '  <td colspan="3"><b>' + json['shipping_method'][i]['title'] + '</b></td>';
					html += '</tr>';

					if (!json['shipping_method'][i]['error']) {
						for (j in json['shipping_method'][i]['quote']) {
							html += '<tr class="highlight">';

							if (json['shipping_method'][i]['quote'][j]['code'] == '<?php echo $shipping_method; ?>') {
								html += '<td width="1%"><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" checked="checked" /></td>';
							} else {
								html += '<td width="1%"><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" /></td>';
							}

							html += '  <td><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</label></td>';
							html += '  <td style="text-align: right;"><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['text'] + '</label></td>';
							html += '</tr>';
						}
					} else {
						html += '<tr>';
						html += '  <td colspan="3"><div class="error">' + json['shipping_method'][i]['error'] + '</div></td>';
						html += '</tr>';
					}
				}

				html += '  </table>';
				//html += '  <br />';
				html += '  <input type="hidden" name="next" value="shipping" />';

				<?php if ($shipping_method) { ?>
				html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="btn" />';
				<?php } else { ?>
				html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="btn" disabled="disabled" />';
				<?php } ?>

				html += '</form>';

				$.colorbox({
					overlayClose: true,
					opacity: 0.5,
					width: '95%',
          height: '95%',
          maxWidth: '800px',
          maxHeight: '500px',
					href: false,
					html: html
				});

				$('input[name=\'shipping_method\']').bind('change', function() {
					$('#button-shipping').attr('disabled', false);
				});
			}
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/cart/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#postcode-required').show();
			} else {
				$('#postcode-required').hide();
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}

	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>
<?php } ?>
<?php echo $footer; ?>
