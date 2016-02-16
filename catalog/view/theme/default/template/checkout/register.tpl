<br>
<form action="" class="horizontal">
  <h4><?php echo $text_your_details; ?></h4>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_firstname; ?></label>
    <div class="control"><input type="text" name="firstname" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_lastname; ?></label>
    <div class="control"><input type="text" name="lastname" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_email; ?></label>
    <div class="control"><input type="text" name="email" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_telephone; ?></label>
    <div class="control"><input type="text" name="telephone" value="" class="large-field" /></div>
  </div>
</form>
<form action="" class="horizontal">
  <h4><?php echo $text_your_password; ?></h4>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_password; ?></label>
    <div class="control"><input type="password" name="password" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_confirm; ?></label>
    <div class="control"><input type="password" name="confirm" value="" class="large-field" /></div>
  </div>
</form>

<form action="" class="horizontal">
  <h4><?php echo $text_your_address; ?></h4>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_address_1; ?></label>
    <div class="control"><input type="text" name="address_1" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><?php echo $entry_address_2; ?></label>
    <div class="control"><input type="text" name="address_2" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_city; ?></label>
    <div class="control"><input type="text" name="city" value="" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span id="payment-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></label>
    <div class="control"><input type="text" name="postcode" value="<?php echo $postcode; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_country; ?></label>
    <div class="control">
      <select name="country_id" class="large-field">
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
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_zone; ?></label>
    <div class="control"><select name="zone_id" class="large-field"></select></div>
  </div>

  <div class="form-group">
    <label for=""><?php echo $entry_company; ?></label>
    <div class="control">
      <?php foreach ($customer_groups as $customer_group) { ?>
        <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
          <div class="radio">
            <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
            <label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
          </div>
        <?php } else { ?>
          <div class="radio">
            <input type="radio" name="customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" id="customer_group_id<?php echo $customer_group['customer_group_id']; ?>" />
            <label for="customer_group_id<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></label>
          </div>
        <?php } ?>
        <?php } ?>
    </div>
  </div>

  <!-- /Hidden -->
  <input type="hidden" name="fax" value="" class="large-field" />
  <input type="hidden" name="company" value="" class="large-field" />
  <input type="hidden" name="company_id" value="" class="large-field" />
  <input type="hidden" name="tax_id" value="" class="large-field" />

</form>

<br>
<div>
  <div class="checkbox">
    <input type="checkbox" name="newsletter" value="1" id="newsletter" checked="checked" />
    <label for="newsletter"><?php echo $entry_newsletter; ?></label>
  </div>
</div>

<?php if ($shipping_required) { ?>
<div>
  <div class="checkbox">
    <input type="checkbox" name="shipping_address" value="1" id="shipping" checked="checked" />
  <label for="shipping"><?php echo $entry_shipping; ?></label>
  </div>
</div>
<?php } ?>

<?php if ($text_agree) { ?>
<div class="button-block right-side">
  <?php echo $text_agree; ?> <input type="checkbox" name="agree" value="1" />
  <input type="button" value="<?php echo $button_continue; ?>" id="button-register" class="btn" />
</div>
<?php } else { ?>
<div class="button-block right-side">
  <input type="button" value="<?php echo $button_continue; ?>" id="button-register" class="btn" />
</div>
<?php } ?>

<script type="text/javascript"><!--
$('#payment-address select[name=\'country_id\']').bind('change', function() {
  if (this.value == '') return;
  $.ajax({
    url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
    dataType: 'json',
    beforeSend: function() {
      $('#payment-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
    },
    complete: function() {
      $('.wait').remove();
    },
    success: function(json) {
      if (json['postcode_required'] == '1') {
        $('#payment-postcode-required').show();
      } else {
        $('#payment-postcode-required').hide();
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

      $('#payment-address select[name=\'zone_id\']').html(html);
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('#payment-address select[name=\'country_id\']').trigger('change');
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