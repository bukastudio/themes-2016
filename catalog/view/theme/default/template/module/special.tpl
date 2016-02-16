<?php if($this->config->get('countdowntimer_category')){ ?>
  <script type="text/javascript"><!--
  function countdownspecial(product_start, product_date, product_id){
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
    document.getElementById("countdownspecial"+product_id).innerHTML = <?php if($countdowntimer_category_days){ ?>daysLeft+day_name+<?php } ?>hrsLeft+hur_name+minsLeft+min_name<?php if($countdowntimer_category_seconds){ ?>+seksLeft+sec_name<?php } ?>;
    document.getElementById("progressbarspecial"+product_id).style.width = percentage+"%";
  }
  }
//--></script>
<?php } ?>

  <?php if($products) { ;?>
  <div id="moduleSpecial" class="module module--catalog">
   <div class="module_header">
      <span><?php echo $heading_title; ?></span>
    </div>
    <div class="module_content">
      <div class="catalog <?php echo $size ;?>">
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

            <?php if ($product['special_end'] && $this->config->get('countdowntimer_category')) { ?>
              <div class="item_timer">
                <div class="countdown">
                  <div class="progressbar">
                    <div id="progressbarspecial<?php echo $product['product_id']?>"></div>
                  </div>
                  <strong><?php echo $text_countdown; ?></strong> <span id="countdownspecial<?php echo $product['product_id']?>"></span>
                </div>
                <script>
                  setInterval(function(){ countdownspecial("<?php echo $product['special_start'];  ?>", "<?php echo $product['special_end'];  ?>", <?php echo $product['product_id']?>); }, 50);
                </script>
              </div>
            <?php } ?>

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

    </div>
  </div>
<?php } ;?>
