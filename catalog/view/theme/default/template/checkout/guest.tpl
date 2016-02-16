<br>
<form action="" class="horizontal">
  <h4><?php echo $text_your_details; ?></h4>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_firstname; ?></label>
    <div class="control"><input type="text" name="firstname" value="<?php echo $firstname; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_lastname; ?></label>
    <div class="control"><input type="text" name="lastname" value="<?php echo $lastname; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_email; ?></label>
    <div class="control"><input type="text" name="email" value="<?php echo $email; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_telephone; ?></label>
    <div class="control"><input type="text" name="telephone" value="<?php echo $telephone; ?>" class="large-field" /></div>
  </div>
</form>

<form action="" class="horizontal">
  <h4><?php echo $text_your_address; ?></h4>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_address_1; ?></label>
    <div class="control"><input type="text" name="address_1" value="<?php echo $address_1; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><?php echo $entry_address_2; ?></label>
    <div class="control"><input type="text" name="address_2" value="<?php echo $address_2; ?>" class="large-field" /></div>
  </div>
  <div class="form-group">
    <label for=""><span class="required">*</span> <?php echo $entry_city; ?></label>
    <div class="control"><input type="text" name="city" value="<?php echo $city; ?>" class="large-field" /></div>
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
  <input type="hidden" name="fax" value="<?php echo $fax; ?>" class="large-field" />
  <input type="hidden" name="company" value="<?php echo $company; ?>" class="large-field" />
  <input type="hidden" name="company_id" value="<?php echo $company_id; ?>" class="large-field" />
  <input type="hidden" name="tax_id" value="<?php echo $tax_id; ?>" class="large-field" />

</form>

<?php if ($shipping_required) { ?>
<br>
<div>
  <div class="checkbox">
    <?php if ($shipping_address) { ?>
      <input type="checkbox" name="shipping_address" value="1" id="shipping" checked="checked" />
    <?php } else { ?>
      <input type="checkbox" name="shipping_address" value="1" id="shipping" />
    <?php } ?>
    <label for="shipping"><?php echo $entry_shipping; ?></label>
  </div>
</div>
<?php } ?>

<div class="button-block right-side">
  <input type="button" value="<?php echo $button_continue; ?>" id="button-guest" class="btn" />
</div>


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