<?php echo $header; ?>

<div id="productPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div class="row">
        <div id="breadCrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
        </div>
        <div id="productCompare">
          <a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>
      </div>
    </div>

    <div class="contentRow">
      <?php echo $content_top ;?>
    </div>

    <div class="contentRow sidebarNone">

      <div id="ticket--info">
        <div class="row">
          <div class="left">
            <div class="productTitle">
              <h1><?php echo $heading_title; ?></h1>
              <!-- <?php echo $price; ?> -->
            </div>
          </div>
          <div class="right">
            <?php if ($description) { ?>
              <div id="product-description"><?php echo $description; ?></div>
            <?php } else {?>
              &nbsp;
            <?php } ;?>
          </div>
        </div>
      </div>

      <div id="ticket--order">
        <div class="productOptions">
          <?php foreach ($options as $option) { ?>

            <?php if ($option['type'] == 'select') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--select">
                <label class="title-label" for="option[<?php echo $option['product_option_id']; ?>]"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                <select id="select-<?php echo $option['product_option_id']; ?>" name="option[<?php echo $option['product_option_id']; ?>]"><option value=""><?php echo $text_select; ?></option><?php foreach ($option['option_value'] as $option_value) { ?><option <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?><?php if ($option_value['price'] && $config_display_option_value == 1) { ?>(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)<?php } ?></option><?php } ?>
                </select>
              </div>
            <?php } ?>

            <?php if ($option['type'] == 'radio') { ?>
                <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--radio">
                  <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                  <?php foreach ($option['option_value'] as $option_value) { ?>
                  <div class="radio <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?>">
                    <label class="radio-inline" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
                    <input type="radio" <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><span><?php echo $option_value['name']; ?></span><?php if ($option_value['price'] && $config_display_option_value == 1) { ?><span>(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)</span><?php } ?>
                    </label>
                  </div>
                  <?php } ?>
                </div>
            <?php } ?>

            <?php if ($option['type'] == 'checkbox') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--checkbox">
                <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                <?php foreach ($option['option_value'] as $option_value) { ?>

                  <div class="checkbox <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?>">
                    <label class="radio-inline" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
                      <input type="checkbox" <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                      <?php echo $option_value['name']; ?>
                      <?php if ($option_value['price'] && $config_display_option_value == 1) { ?>
                        <span>(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)</span>
                      <?php } ?>
                    </label>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>



            <?php if ($option['type'] == 'text') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--text">
                <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
              </div>
            <?php } ?>

            <?php if ($option['type'] == 'textarea') { ?>
              <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--textarea">
                <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
              </div>
            <?php } ?>
          <?php } ?>

        </div>
      </div>

      <div id="ticket--cart">
        <div class="productCart">
          <label for=""><?php echo $text_qty;?></label>
          <div class="row">

            <div class="quantitySelector">
              <div class="left">
                  <input type="text" name="quantity" size="4" value="<?php echo $minimum; ?>" />
              </div>
              <div class="right"><i class="icon-plus" plus-minus-icon plus"></i><i class="icon-minus" plus-minus-icon minus"></i></div>
            </div>
            <div class="cartButton"><a id="button-cart" class="button"><i class="icon-basket""></i> <?php echo $button_cart; ?></a>
            </div>
          </div>
          <?php if ($minimum > 1) { ?>
            <div class="productMinimum"><?php echo $text_minimum; ?></div>
          <?php } ?>
          <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">//<!--
  $(function() {
    //$('#option-275').hide();
    //$('#option-276').hide();
    $('#select-274').change(function(){
      if($('#select-274').val() == '136') {
        $('#option-275').show();
        $('#option-276').hide();
      } else if($('#select-274').val() == '137') {
        $('#option-275').hide();
        $('#option-276').show();
      } else if($('#select-274').val() == '138') {
        $('#option-275').show();
        $('#option-276').show();
      } else {
          $('#option-275').hide();
          $('#option-276').hide();
      }
    });
});

//--></script>
<script type="text/javascript">//<!--
$(document).ready(function (){
  $(".plus-minus-icon").unbind('click');
  $('.plus-minus-icon').live("click", (function() {
    var Value = $(".quantitySelector input").val();
    if ($(this).hasClass("plus")) {
      Value = parseFloat(Value) + 1;
    } else {
      if (Value > 1) {
        Value = parseFloat(Value) - 1;
      }
    }
    $(".quantitySelector input").val(Value);
    livepriceupdate();
  }));


});
//--></script>

<script type="text/javascript"><!--

$('#button-cart').bind('click', function() {
  $.ajax({
    url: 'index.php?route=checkout/cart/add',
    type: 'post',
    data: $('.productContent input[type=\'text\'], .productContent input[type=\'hidden\'], .productContent input[type=\'radio\']:checked, .productContent input[type=\'checkbox\']:checked, .productContent select, .productContent textarea'),
    dataType: 'json',
    success: function(json) {
      $('.success, .warning, .attention, information, .error').remove();

      if (json['error']) {
        if (json['error']['option']) {
          for (i in json['error']['option']) {
            $('#option-' + i ).append('<span class="error">' + json['error']['option'][i] + '</span>');
          }
        }

                if (json['error']['profile']) {
                    $('select[name="profile_id"]').after('<span class="error">' + json['error']['profile'] + '</span>');
                }
      }

      if (json['success']) {
        $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<i class="icon-close"></i></div>');

        $('.success').fadeIn('slow');
        $('#cart').load('index.php?route=module/cart #cart > *');
        $('#cart-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    }
  });
});
//--></script>
<?php if ($options) { ?>
  <script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
  <?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
  action: 'index.php?route=product/product/upload',
  name: 'file',
  autoSubmit: true,
  responseType: 'json',
  onSubmit: function(file, extension) {
    $('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
    $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
  },
  onComplete: function(file, json) {
    $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);

    $('.error').remove();

    if (json['success']) {
      alert(json['success']);

      $('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
    }

    if (json['error']) {
      $('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
    }

    $('.loading').remove();
  }
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>

<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
  $('#review').fadeOut('slow');

  $('#review').load(this.href);

  $('#review').fadeIn('slow');

  return false;
});

$('#review-box').hide();
$('#review-button a#view-review').addClass("btn--disabled");

$('#review-button a#write-review').live('click', function() {
  $(this).addClass("btn--disabled");
  $('#review-button a#view-review').removeClass("btn--disabled");
  $('#review').slideUp('slow');
  $('#review-box').slideDown('slow');
  return false;
});
$('#review-button a#view-review').live('click', function() {
  $(this).addClass("btn--disabled");
  $('#review-button a#write-review').removeClass("btn--disabled");
  $('#review-box').slideUp('slow');
  $('#review').slideDown('slow');
  return false;
});

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

$('#button-review').bind('click', function() {
  $.ajax({
    url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
    type: 'post',
    dataType: 'json',
    data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-review').attr('disabled', true);
      $('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-review').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(data) {
      if (data['error']) {
        $('#review-title').after('<div class="warning">' + data['error'] + '</div>');
      }

      if (data['success']) {
        $('#review-title').after('<div class="success">' + data['success'] + '</div>');

        $('input[name=\'name\']').val('');
        $('textarea[name=\'text\']').val('');
        $('input[name=\'rating\']:checked').attr('checked', '');
        $('input[name=\'captcha\']').val('');
      }
    }
  });
});
//--></script>

<script type="text/javascript"><!--
  $('.productImage .flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails",
    slideshow: false,
  });
//--></script>

<script type="text/javascript"><!--
  $('#tabs a').tabs();
//--></script>

<script type="text/javascript"><!--
$(document).ready(function() {
  if ($.browser.msie && $.browser.version == 6) {
    $('.date, .datetime, .time').bgIframe();
  }

  $('.date').datepicker({dateFormat: 'yy-mm-dd'});
  $('.datetime').datetimepicker({
    dateFormat: 'yy-mm-dd',
    timeFormat: 'h:m'
  });
  $('.time').timepicker({timeFormat: 'h:m'});
});
//--></script>

<?php echo $footer; ?>
