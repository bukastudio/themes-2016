<?php echo $header; ?>
<?php if($this->config->get('countdowntimer_category')){ ?>
  <script type="text/javascript"><!--
  function countdown(product_start, product_date, product_id){
  <?php if($countdowntimer_category_texttimer){ ?>
  var names = {days:      JSON.parse(JSON.stringify(<?php echo $text_countdown_days; ?>)),
            hours:     JSON.parse(JSON.stringify(<?php echo $text_countdown_hours; ?>)),
            minutes:   JSON.parse(JSON.stringify(<?php echo $text_countdown_minutes; ?>)),
            seconds:   JSON.parse(JSON.stringify(<?php echo $text_countdown_seconds; ?>)),
  };

  var day_name = names['days'][3];
  var hur_name = names['hours'][3];
  var min_name = names['minutes'][3];
  var sec_name = names['seconds'][3];
  <?php }else{ ?>
  var day_name = ":";
  var hur_name = ":";
  var min_name = ":";
  var sec_name = "";
  <?php } ?>


  var today = new Date();

  var BigDay = new Date(product_date);
  var timeLeft = (BigDay.getTime() - today.getTime());

  var dateStart = new Date(product_start);
  var dateEnd = new Date(product_date);
  var dateToday = new Date();
  var percentage = (Math.floor(dateToday.getTime()/1000) - Math.floor(dateStart.getTime()/1000)) / (Math.floor(dateEnd.getTime()/1000) - Math.floor(dateStart.getTime()/1000)) * 100;


  var progress = new Date(product_date);

  var e_daysLeft = timeLeft / 86400000;
  <?php if($countdowntimer_category_days || $countdowntimer_category_countdays){ ?>
  var daysLeft = Math.floor(e_daysLeft);
  <?php if($countdowntimer_category_texttimer){ ?>
    <?php if($config_language == "en"){ ?>
    if(parseInt(daysLeft) == 1){
        day_name = names['days'][1];
    }else{
        day_name = names['days'][2];
    }
    <?php }else{ ?>
    var slice_day = String(daysLeft).slice(-1);
    if(parseInt(slice_day) == 1 && (parseInt(daysLeft) < 10 || parseInt(daysLeft) > 20)){
        day_name = names['days'][1];
    }else if((parseInt(slice_day) == 2 || parseInt(slice_day) == 3 || parseInt(slice_day) == 4) && (parseInt(daysLeft) < 10 || parseInt(daysLeft) > 20)){
        day_name = names['days'][2];
    }else{
        day_name = names['days'][3];
    }
    <?php } ?>
  <?php } ?>
  <?php }else{ ?>
  var daysLeft = 0;
  <?php } ?>

  var e_hrsLeft = (e_daysLeft - daysLeft)*24;
  var hrsLeft = Math.floor(e_hrsLeft);
  if(hrsLeft < 10){
  hrsLeft = '0'+hrsLeft;
  }
  <?php if($countdowntimer_category_texttimer){ ?>
  <?php if($config_language == "en"){ ?>
    if(parseInt(hrsLeft) == 1){
        hur_name = names['hours'][1];
    }else{
        hur_name = names['hours'][2];
    }
    <?php }else{ ?>
    var slice_hours = String(hrsLeft).slice(-1);
    if(parseInt(slice_hours) == 1 && (parseInt(hrsLeft) < 10 || parseInt(hrsLeft) > 20)){
        hur_name = names['hours'][1];
    }else if((parseInt(slice_hours) == 2 || parseInt(slice_hours) == 3 || parseInt(slice_hours) == 4)  && (parseInt(hrsLeft) < 10 || parseInt(hrsLeft) > 20)){
        hur_name = names['hours'][2];
    }else{
        hur_name = names['hours'][3];
    }
    <?php } ?>
  <?php } ?>

  var e_minsLeft = (e_hrsLeft - hrsLeft)*60;
  var minsLeft = Math.floor(e_minsLeft);
  if(minsLeft < 10){
  minsLeft = '0'+minsLeft;
  }
  <?php if($countdowntimer_category_texttimer){ ?>
  <?php if($config_language == "en"){ ?>
    if(parseInt(minsLeft) == 1){
        min_name = names['minutes'][1];
    }else{
        min_name = names['minutes'][2];
    }
    <?php }else{ ?>
    var slice_min = String(minsLeft).slice(-1);
    if(parseInt(slice_min) == 1 && (parseInt(minsLeft) < 10 || parseInt(minsLeft) > 20)){
        min_name = names['minutes'][1];
    }else if((parseInt(slice_min) == 2 || parseInt(slice_min) == 3 || parseInt(slice_min) == 4) && (parseInt(minsLeft) < 10 || parseInt(minsLeft) > 20)){
        min_name = names['minutes'][2];
    }else{
        min_name = names['minutes'][3];
    }
    <?php } ?>
  <?php } ?>

  var seksLeft = Math.floor((e_minsLeft - minsLeft)*60);
  if(seksLeft < 10){
  seksLeft = '0'+seksLeft;
  }
  <?php if($countdowntimer_category_texttimer){ ?>
  <?php if($config_language == "en"){ ?>
    if(parseInt(seksLeft) == 1){
        sec_name = names['seconds'][1];
    }else{
        sec_name = names['seconds'][2];
    }
    <?php }else{ ?>
    var slice_sec = String(seksLeft).slice(-1);
    if(parseInt(slice_sec) == 1 && (parseInt(seksLeft) < 10 || parseInt(seksLeft) > 20)){
        sec_name = names['seconds'][1];
    }else if((parseInt(slice_sec) == 2 || parseInt(slice_sec) == 3 || parseInt(slice_sec) == 4) && (parseInt(seksLeft) < 10 || parseInt(seksLeft) > 20)){
        sec_name = names['seconds'][2];
    }else{
        sec_name = names['seconds'][3];
    }
    <?php } ?>
  <?php } ?>
  <?php if(!$countdowntimer_category_seconds && !$countdowntimer_category_texttimer){ ?>
    min_name = '';
  <?php } ?>

  if (BigDay.getTime() > today.getTime() ){
    document.getElementById("countdown"+product_id).innerHTML = <?php if($countdowntimer_category_days){ ?>daysLeft+day_name+<?php } ?>hrsLeft+hur_name+minsLeft+min_name<?php if($countdowntimer_category_seconds){ ?>+seksLeft+sec_name<?php } ?>;
    document.getElementById("progressbar"+product_id).style.width = percentage+"%";
  }
  }
//--></script>
<?php } ?>
<?php if($column_left) {$slotclass = "sidebarRight";} else {$slotclass = "sidebarNone";};?>

<div id="manufacturerPage" class="contentSlot">
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

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnCenter">

          <div class="categoryHeader">
            <img class="categoryImage" src="<?php echo $image; ?>" alt="<?php echo $heading_title; ?>" />
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <?php if ($products) { ?>
            <div class="filterBar">

              <div class="filterBar_display">
                <strong><?php echo $text_display; ?></strong> <span><?php echo $text_grid; ?></span> / <a onclick="display('list');"><?php echo $text_list; ?></a>
              </div>

              <div class="filterBar_limit">
                <strong><?php echo $text_limit; ?></strong>
                <select onchange="location = this.value;">
                  <?php foreach ($limits as $limits) { ?>
                  <?php if ($limits['value'] == $limit) { ?>
                  <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </select>

              </div>
              <div class="filterBar_sort">
                <strong><?php echo $text_sort; ?></strong>
                <select onchange="location = this.value;">
                  <?php foreach ($sorts as $sorts) { ?>
                  <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                  <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>

            </div>
          <?php } ;?>

          <?php if ($products) { ?>
            <div id="mainCatalog" class="catalog <?php echo $this->config->get('config_catalog_size') ;?>">
              <?php foreach ($products as $product) { ?>
                <div class="item">

                  <?php if ($product['thumb']) { ?>
                    <?php if ($product['special']) { ?>
                      <div class="item_label"><img src="data: image/jpeg;base64,<?php echo $sale_label; ?>" title="SALE" alt="SALE" /></div>
                    <?php } ;?>
                    <div class="item_image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a>
                    </div>
                  <?php } ?>

                  <!-- /Product Info -->
                  <div class="item_info">

                    <div class="item_info__name">
                      <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                    </div>

                    <div class="item_info__description">
                      <?php echo $product['description']; ?>
                    </div>

                    <?php if ($product['price']) { ?>
                      <div class="item_info__price">
                        <?php if (!$product['special']) { ?>
                          <?php echo $product['price']; ?>
                        <?php } else { ?>
                          <div class="price-old"><?php echo $product['price']; ?></div> <div class="price-new"><?php echo $product['special']; ?></div>

                        <?php } ?>
                      </div>
                    <?php } ?>

                  </div>

                  <!-- /Product Actions -->
                  <div class="item_action">
                    <?php if ($product['quantity']>0) { ?>
                      <a title="Add to cart" class="add-to-cart-button button" onclick="addToCart('<?php echo $product['product_id']; ?>');"><span><?php echo $button_cart ?></span></a>
                    <?php } else { ;?>
                      <a onclick='outOfStockEnquiry(this);'   class='out-of-stock button btn--neutral' data-subject='<?php echo $product['name']; ?> (<?php echo $product['model']; ?>)' >Enquiry Now</a>
                    <?php } ;?>
                  </div>

                </div>
              <?php } ;?>
            </div>
          <?php } ;?>

          <?php if ($products) { ?><div class="pagination"><?php echo $pagination; ?></div><?php } ;?>

<?php echo $content_bottom ;?>

        </div>

        <div class="columnRight sideBar">
          <?php echo $column_left ;?>
        </div>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript"><!--
function display(view) {
  if (view == 'list') {
    $('.columnCenter .catalog').addClass('catalog--list');
    $('.filterBar_display').html('<strong><?php echo $text_display; ?></strong> <span><?php echo $text_list; ?></span> / <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
    $.totalStorage('display', 'list');
  } else {
    $('.columnCenter .catalog').removeClass('catalog--list');
    $('.filterBar_display').html('<strong><?php echo $text_display; ?></strong> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> / <span><?php echo $text_grid; ?></span>');
    $.totalStorage('display', 'grid');
  }
}
view = $.totalStorage('display');
if (view) {
  display(view);
} else {
  display('grid');
}
//--></script>


<?php echo $footer; ?>
