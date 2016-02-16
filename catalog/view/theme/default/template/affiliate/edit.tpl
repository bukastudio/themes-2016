<?php echo $header; ?>

<div id="affiliateEditPage" class="contentSlot">
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
                      <legend><?php echo $text_your_details; ?></legend>
                      <div class="form-group">
                        <label for=""><span class="required">*</span><?php echo $entry_firstname; ?></label>
                        <div class="control">
                          <input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                        <?php if ($error_firstname) { ?>
                          <span class="error"><?php echo $error_firstname; ?></span>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for=""><span class="required">*</span><?php echo $entry_lastname; ?></label>
                        <div class="control">
                          <input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                        <?php if ($error_lastname) { ?>
                          <span class="error"><?php echo $error_lastname; ?></span>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for=""><span class="required">*</span><?php echo $entry_email; ?></label>
                        <div class="control">
                          <input type="text" name="email" value="<?php echo $email; ?>" />
                        <?php if ($error_email) { ?>
                          <span class="error"><?php echo $error_email; ?></span>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for=""><span class="required">*</span><?php echo $entry_telephone; ?></label>
                        <div class="control">
                          <input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                        <?php if ($error_telephone) { ?>
                          <span class="error"><?php echo $error_telephone; ?></span>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for=""><?php echo $entry_fax; ?></label>
                        <div class="control">
                          <input type="text" name="fax" value="<?php echo $fax; ?>" />
                        </div>
                      </div>
                    </fieldset>

                </div>

                <div class="column">
                  <fieldset>
                    <legend><?php echo $text_your_address; ?></legend>
                    <div class="form-group">
                      <label for=""><?php echo $entry_website; ?></label>
                      <div class="control">
                        <input type="text" name="website" value="<?php echo $website; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                    <label for=""><span class="required">*</span><?php echo $entry_address_1; ?></label>
                      <div class="control">
                        <input type="text" name="address_1" value="<?php echo $address_1; ?>" />
                      <?php if ($error_address_1) { ?>
                        <span class="error"><?php echo $error_address_1; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for=""><?php echo $entry_address_2; ?></label>
                      <div class="control">
                        <input type="text" name="address_2" value="<?php echo $address_2; ?>" />
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_country; ?></label>
                      <div class="control">
                        <select name="country_id">
                          <option value="false"><?php echo $text_select; ?></option>
                          <?php foreach ($countries as $country) { ?>
                          <?php if ($country['country_id'] == $country_id) { ?>
                          <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                      <?php if ($error_country) { ?>
                        <span class="error"><?php echo $error_country; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_zone; ?></label>
                      <div class="control">
                        <select name="zone_id">
                        </select>
                      <?php if ($error_zone) { ?>
                        <span class="error"><?php echo $error_zone; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group"><label for=""><span class="required">*</span><?php echo $entry_city; ?></label>
                      <div class="control">
                        <input type="text" name="city" value="<?php echo $city; ?>" />
                      <?php if ($error_city) { ?>
                        <span class="error"><?php echo $error_city; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><span id="postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></label>
                      <div class="control">
                        <input type="text" name="postcode" value="<?php echo $postcode; ?>" />
                      <?php if ($error_postcode) { ?>
                        <span class="error"><?php echo $error_postcode; ?></span>
                      <?php } ?>
                      </div>
                    </div>
                  </fieldset>
                </div>

              </div>
              <div id="contentRow-2">
                <div class="row">
                  <div class="column">
                    <div class="button-block">
                      <input type="submit" value="<?php echo $button_continue; ?>" class="button" /><a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                    </div>
                  </div>
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
$('select[name=\'country_id\']').bind('change', function() {
  $.ajax({
    url: 'index.php?route=affiliate/edit/country&country_id=' + this.value,
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
<?php echo $footer; ?>
