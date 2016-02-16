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
      <div class="row">

        <div class="columnCenter">

            <div class="productHeader">
              <div class="row">
                <div class="contentLeft">

                  <div class="productRating">
                    <img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />
                  </div>
                  <div class="productTitle">
                    <h1><?php echo $heading_title; ?></h1>
                  </div>

                  <div class="productPrice">
                    <?php if (!$special) { ?>
                        <?php echo $price; ?>
                    <?php } else { ?>
                        <span class="price-new"><?php echo $special; ?></span> <span class="price-old"><?php echo $price; ?></span>
                    <?php } ?>
                  </div>
                  <?php if ($special_end) { ?>
            			<div class="countdown">
            				<strong><?php echo $text_countdown; ?></strong>&nbsp;&nbsp;<span id="countdown"></span>
            			</div>
            			<script>
            			function countdown(){
            				<?php if($countdowntimer_product_texttimer){ ?>
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

            				var BigDay = new Date("<?php echo $special_end;  ?>");
            				var timeLeft = (BigDay.getTime() - today.getTime());

            				var e_daysLeft = timeLeft / 86400000;
            				<?php if($countdowntimer_product_days || $countdowntimer_product_countdays){ ?>
            				var daysLeft = Math.floor(e_daysLeft);
            				    <?php if($countdowntimer_product_texttimer){ ?>
            					    <?php if($config_language == "en"){ ?>
            					    if(parseInt(daysLeft) == 1){
            					        day_name = " <em>day</em> ";
            					    }else{
            					        day_name = " <em>days</em> ";
            					    }
            					    <?php }else{ ?>
            					    var slice_day = String(daysLeft).slice(-1);
            					    if(parseInt(slice_day) == 1 && (parseInt(daysLeft) < 10 || parseInt(daysLeft) > 20)){
            					        day_name = names['days'][1];
            					    }else if((parseInt(slice_day) == 2 || parseInt(slice_day) == 3 || parseInt(slice_day) == 4) && (parseInt(daysLeft) < 10 || parseInt(daysLeft) > 20)){
            					        day_name = " <em>days</em> ";
            					    }else{
            					        day_name = " <em>days</em> ";
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
            					<?php if($countdowntimer_product_texttimer){ ?>
            						<?php if($config_language == "en"){ ?>
            					    if(parseInt(hrsLeft) == 1){
            					        hur_name = " <em>hour</em> ";
            					    }else{
            					        hur_name = " <em>hours</em> ";
            					    }
            					    <?php }else{ ?>
            					    var slice_hours = String(hrsLeft).slice(-1);
            					    if(parseInt(slice_hours) == 1 && (parseInt(hrsLeft) < 10 || parseInt(hrsLeft) > 20)){
            					        hur_name = names['hours'][1];
            					    }else if((parseInt(slice_hours) == 2 || parseInt(slice_hours) == 3 || parseInt(slice_hours) == 4)  && (parseInt(hrsLeft) < 10 || parseInt(hrsLeft) > 20)){
            					        hur_name = " <em>hours</em> ";
            					    }else{
            					        hur_name = " <em>hours</em> ";
            					    }
            					    <?php } ?>
            				    <?php } ?>

            				var e_minsLeft = (e_hrsLeft - hrsLeft)*60;
            				var minsLeft = Math.floor(e_minsLeft);
            				if(minsLeft < 10){
            					minsLeft = '0'+minsLeft;
            				}
            					<?php if($countdowntimer_product_texttimer){ ?>
            						<?php if($config_language == "en"){ ?>
            					    if(parseInt(minsLeft) == 1){
            					        min_name = " <em>minute</em> ";
            					    }else{
            					        min_name = " <em>minutes</em> ";
            					    }
            					    <?php }else{ ?>
            					    var slice_min = String(minsLeft).slice(-1);
            					    if(parseInt(slice_min) == 1 && (parseInt(minsLeft) < 10 || parseInt(minsLeft) > 20)){
            					        min_name = names['minutes'][1];
            					    }else if((parseInt(slice_min) == 2 || parseInt(slice_min) == 3 || parseInt(slice_min) == 4) && (parseInt(minsLeft) < 10 || parseInt(minsLeft) > 20)){
            					        min_name = " <em>minutes</em> ";
            					    }else{
            					        min_name = " <em>minutes</em> ";
            					    }
            					    <?php } ?>
            				    <?php } ?>

            				var seksLeft = Math.floor((e_minsLeft - minsLeft)*60);
            				if(seksLeft < 10){
            					seksLeft = '0'+seksLeft;
            				}
            					<?php if($countdowntimer_product_texttimer){ ?>
            						<?php if($config_language == "en"){ ?>
            					    if(parseInt(seksLeft) == 1){
            					        sec_name = " <em>second</em> ";
            					    }else{
            					        sec_name = " <em>seconds</em> ";
            					    }
            					    <?php }else{ ?>
            					    var slice_sec = String(seksLeft).slice(-1);
            					    if(parseInt(slice_sec) == 1 && (parseInt(seksLeft) < 10 || parseInt(seksLeft) > 20)){
            					        sec_name = names['seconds'][1];
            					    }else if((parseInt(slice_sec) == 2 || parseInt(slice_sec) == 3 || parseInt(slice_sec) == 4) && (parseInt(seksLeft) < 10 || parseInt(seksLeft) > 20)){
            					        sec_name = " <em>seconds</em> ";
            					    }else{
            					        sec_name = " <em>seconds</em> ";
            					    }
            					    <?php } ?>
            				    <?php } ?>
            				    <?php if(!$countdowntimer_product_seconds && !$countdowntimer_product_texttimer){ ?>
            					    min_name = '';
            				    <?php } ?>

            				if (BigDay.getTime() > today.getTime() ){
            					document.getElementById("countdown").innerHTML = <?php if($countdowntimer_product_days){ ?>daysLeft+day_name+<?php } ?>hrsLeft+hur_name+minsLeft+min_name<?php if($countdowntimer_product_seconds){ ?>+seksLeft+sec_name<?php } ?>;
            				}
            			}
            			setInterval("countdown()", 50);
            			</script>
            			<?php } ?>

                  <div class="productShare">
                      <a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(html_entity_decode($breadcrumb['href']));?>&amp;title=<?php echo $heading_title; ?>"><img src="http://cdn.bukatoko.com/icon/icon-facebook.png" alt="Facebook"></a>
                      <a target="_blank" href="http://twitter.com/intent/tweet?status=<?php echo $heading_title; ?>+<?php echo urlencode(html_entity_decode($breadcrumb['href']));?>"><img src="http://cdn.bukatoko.com/icon/icon-twitter.png" alt="Twitter"></a>
                      <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(html_entity_decode($breadcrumb['href']));?>&amp;media=<?php echo $popup; ?>&amp;description=<?php echo urlencode($heading_title);?>%20from%20<?php echo urlencode($store);?>%20%2D%20<?php echo urlencode($price);?>" class="pin-it-button" count-layout="horizontal"><img src="http://cdn.bukatoko.com/icon/icon-pinterest.png" alt="Pinterest"></a>
                      <a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(html_entity_decode($breadcrumb['href']));?>"><img src="http://cdn.bukatoko.com/icon/icon-google-plus.png" alt="Google-Plus"></a>
                      <a target="_blank" href="whatsapp://send?text=<?php echo urlencode(html_entity_decode($breadcrumb['href']));?>" data-action="share/whatsapp/share"><img src="http://cdn.bukatoko.com/icon/icon-whatsapp.png" alt="WhatsApp"></a>
                  </div>

                </div>
              </div>
            </div>
            <div class="productContent">
              <div class="row">
                <div class="contentLeft">

                  <div class="productImage">
                    <div class="flexslider">
                       <ul class="slides">
                        <?php if ($thumb) { ?>
                          <li data-thumb="<?php echo $thumb; ?>"><img src="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></li>
                        <?php } ?>
                        <?php if ($images) { ?>
                          <?php foreach ($images as $image) { ?>
                            <li class="additional" data-thumb="<?php echo $image['popup']; ?>">
                              <img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                            </li>
                          <?php } ?>
                        <?php } ?>
                       </ul>
                    </div>
                    <!-- <div id="imageDownload"><a href="<?php echo $popup; ?>" title="Download Image" target="_blank"><i class="icon-download"></i>Download this image</a></div> -->
                  </div>

                  <div class="productDescription">

                    <div id="tabs" class="htabs">
                      <a class="selected" href="#tab-description"><?php echo $tab_description; ?></a>
                      <?php if ($attribute_groups) { ?>
                        <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
                      <?php } ;?>

                      <?php if ($review_status) { ?>
                        <a href="#tab-review"><?php echo $tab_review; ?></a>
                      <?php } ?>
                    </div>

                    <div class="content">

                      <div id="tab-description" class="tab-content">
                        <?php if ($description) { ?><div id="product-description"><?php echo $description; ?></div><?php } ?>
                      </div>

                      <?php if ($attribute_groups) { ?>
                        <div id="tab-attribute" class="tab-content">
                          <div class="productAttributes">
                            <table class="table--noborder table--narrow">
                              <?php foreach ($attribute_groups as $attribute_group) { ?>
                              <thead>
                                <tr><th colspan="2"><?php echo $attribute_group['name']; ?></th></tr>
                              </thead>
                              <tbody>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                  <tr>
                                    <td><?php echo $attribute['name']; ?></td>
                                    <td><?php echo $attribute['text']; ?></td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                              <?php } ?>
                            </table>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if ($review_status) { ?>
                        <div id="tab-review" class="tab-content" style="display:none">
                          <div id="productReview">
                            <div id="review-button"><a class="button btn--neutral btn--small" id="write-review" href=""><?php echo $text_write; ?></a> <a class="button btn--neutral btn--small" href="" id="view-review">View</a></div>

                            <div id="review-box">
                              <form action="" class="horizontal">
                                <fieldset>
                                  <legend id="review-title"><?php echo $text_write; ?></legend>
                                  <div class="form-group">
                                    <label for=""><?php echo $entry_name; ?></label>
                                    <div class="control">
                                      <input type="text" name="name" value="" />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for=""><?php echo $entry_review; ?>
                                      </label>
                                    <div class="control">
                                      <textarea name="text" cols="40" rows="3"></textarea>
                                      <span class="help"><?php echo $text_note; ?></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for=""><?php echo $entry_rating; ?></label>

                                    <div class="control">
                                      <div class="radio-control">
                                        <span><?php echo $entry_bad; ?></span>
                                        &nbsp;
                                        <input type="radio" name="rating" value="1" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="2" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="3" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="4" />
                                        &nbsp;
                                        <input type="radio" name="rating" value="5" />
                                        &nbsp;
                                        <span><?php echo $entry_good; ?></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group captcha">
                                    <label for=""><?php echo $entry_captcha; ?></label>
                                    <div class="control">
                                      <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><input type="text" name="captcha" value="" class="captcha" />
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="control">
                                      <a id="button-review" class="button"><?php echo $button_continue; ?></a>
                                    </div>
                                  </div>
                                </fieldset>
                              </form>
                            </div>
                            <div id="review"></div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>
                  </div>

                  <?php if ($tags) { ?>
                    <div id="product-tags" class="productTags">
                      <ul>
                        <li>Tags:</li>
                        <?php for ($i = 0; $i < count($tags); $i++) { ?>
                          <li><a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>

                </div>
                <div class="contentRight">

                  <?php if ($config_attributes_on_product_page == 1) { ?>
                    <div class="productDetails">
                      <ul>
                        <?php if ($manufacturer) { ?>
                          <li><small><?php echo $text_manufacturer; ?></small><?php echo $manufacturer; ?></li>
                        <?php } else {?>
                          <li><small><?php echo $text_manufacturer; ?></small>-</li>
                        <?php } ;?>
                        <?php if ($model) { ?>
                          <li><small><?php echo $text_model; ?></small><?php echo $model; ?></li>
                        <?php } else {?>
                          <li><small><?php echo $text_model; ?></small>-</li>
                        <?php } ;?>
                        <li><small><?php echo $text_weight; ?></small><?php echo $weight; ?></li>
                        <li><small><?php echo $text_dimension; ?></small><?php echo $dimension; ?></li>
                      </ul>
                    </div>
                  <?php } ;?>

                  <?php if ($discounts) { ?>
                    <div class="productWholesale">
                      <h4><?php echo $text_wholesale ;?></h4>
                      <table class="table--narrow">
                        <thead>
                          <tr>
                            <th class="left">Quantity</th>
                            <th class="price">Price per item</th>
                            <th class="right">Discount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($discounts as $discount) { ?>
                            <tr>
                              <td class="left">&geq; <?php echo $discount['quantity'];?></td>
                              <td class="price"><?php echo  $discount['price'];?></td>
                              <td class="right"><?php echo  $discount['margin'];?>%</td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  <?php } ?>

                  <div class="productPointReward">
                    <ul>
                      <?php if($points > 0) { ;?>
                        <li><?php echo $text_points ;?> <strong><?php echo $points ;?></strong> points</li>
                      <?php } ?>
                      <?php if ($reward) { ?>
                        <li>Get <strong><?php echo $reward; ?></strong> points by purchasing this product</li>
                      <?php } ?>
                    </ul>
                  </div>

                  <?php if($sizechart != ''){ ?>
                  <div id="productSizeChart">
                    <a href="#sizechart_content" class="inline-colorbox button btn--neutral btn--small"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAAHCAYAAADu4qZ8AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTNui8sowAAAAVdEVYdENyZWF0aW9uIFRpbWUAMi8xMC8xNkPojqcAAABASURBVBiVpZBBDgAgCMPAz+8tvLLenRGNvRFGsxCSiA8kMW5CXcYkVXU8WveASzoy0+ZnCXjRZ8mO3D0OsNonJnJ2GVB3pIU1AAAAAElFTkSuQmCC" alt="Size Icon" style="vertical-align: baseline"> <?php echo $text_sizechart; ?></a>
                    <div style="display:none;">
                      <div id="sizechart_content">
                          <?php echo @html_entity_decode($sizechart, ENT_QUOTES, 'UTF-8'); ?>
                      </div>
                    </div>
                  </div><br>
                  <?php } ?>

                  <div class="productOptions">
                    <?php foreach ($options as $option) { ?>

                      <?php if ($option['type'] == 'select') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--select">
                          <label class="title-label" for="option[<?php echo $option['product_option_id']; ?>]"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <select name="option[<?php echo $option['product_option_id']; ?>]"><option value=""><?php echo $text_select; ?></option><?php foreach ($option['option_value'] as $option_value) { ?><option <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?><?php if ($option_value['price'] && $config_display_option_value == 1) { ?> (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)<?php } ?></option><?php } ?>
                          </select>
                        </div>
                      <?php } ?>

                      <?php if ($option['type'] == 'radio') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option break option--radio">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <?php foreach ($option['option_value'] as $option_value) { ?>
                          <div class="radio <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?>">
                            <label class="radio-inline" for="option-value-<?php echo $option_value['product_option_value_id']; ?>">
                            <input type="radio" <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /><?php echo $option_value['name']; ?><?php if ($option_value['price'] && $config_display_option_value == 1) { ?><span> (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)</span><?php } ?>
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
                                  <span> (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)</span>
                                <?php } ?>
                              </label>
                            </div>
                          <?php } ?>
                        </div>
                      <?php } ?>

                      <?php if ($option['type'] == 'image') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--image">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <ul class="option-images">
                            <?php foreach ($option['option_value'] as $option_value) { ?>
                              <li >
                                <div class="option-image">
                                  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label>

                                </div>
                                <div class="option-name">
                                  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                    <?php if ($option_value['price'] && $config_display_option_value == 1) { ?>
                                      <span> (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)</span>
                                    <?php } ?>
                                  </label>
                                </div>
                                <div class="option-input">
                                  <input type="radio" <?php if ($option_value['quantity'] <= 0) echo 'disabled'; ?> name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
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

                      <?php if ($option['type'] == 'file') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--file">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="btn btn-black btn-sm">
                          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
                        </div>
                      <?php } ?>

                      <?php if ($option['type'] == 'date') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--date">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="input-small date" />
                        </div>
                      <?php } ?>

                      <?php if ($option['type'] == 'datetime') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--datetime">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="input-medium datetime" />
                        </div>
                      <?php } ?>

                      <?php if ($option['type'] == 'time') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option option--time">
                          <label class="title-label"><?php if ($option['required']) { ?><span class="required">*</span><?php } ?><?php echo $option['name']; ?>:</label>
                          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="input-mini time" />
                        </div>
                      <?php } ?>

                    <?php } ?>

                  </div>


                  <div class="productCart">
                    <label for=""><?php echo $text_qty;?></label>
                    <div class="row">

                      <div class="quantitySelector">
                        <div class="left">
                            <input type="text" name="quantity" size="4" value="<?php echo $minimum; ?>" />
                        </div>
                        <div class="right">
                          <div class="plus-minus-box">
                            <div class="plus-minus-icon plus"><i class="icon-plus"></i></div>
                            <div class="plus-minus-icon minus"><i class="icon-minus"></i></div>
                          </div>

                        </div>
                      </div>
                      <div class="cartButton"><a id="button-cart" class="button"><i class="icon-basket""></i> <?php echo $button_cart; ?></a>
                      </div>
                    </div>
                    <?php if ($minimum > 1) { ?>
                      <div class="productMinimum"><?php echo $text_minimum; ?></div>
                    <?php } ?>
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                  </div>

                  <div class="compareWishlist">
                    <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a> <?php echo $text_or ;?> <a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a>
                  </div>

                  <?php if ($products) { ?>
                    <div class="productRelated">
                      <h4><?php echo $tab_related; ?> <!--<span>(<?php echo count($products); ?>)</span>--></h4>
                      <ul class="row">
                        <?php foreach ($products as $product) { ?>
                        <li>
                          <?php if ($product['thumb']) { ?>
                            <div class="productRelated_image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                          <?php } ?>
                          <div class="productRelated_info">
                            <div class="productRelated__name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                            <?php if ($product['price']) { ?>
                              <div class="productRelated__price">
                                <?php if (!$product['special']) { ?>
                                  <?php echo $product['price']; ?>
                                  <?php } else { ?>
                                    <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                                  <?php } ?>
                              </div>
                            <?php } ?>
                          </div>
                        </li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>

                </div>
              </div>
            </div>
            <div class="productFooter"><?php echo $content_bottom ;?></div>

          <?php echo $content_bottom ;?>
        </div>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript">//<!--
$(document).ready(function (){
  $(".plus-minus-icon").unbind("click");
  $(".plus-minus-icon").live("click", (function() {

    var Value = $(this).parent().parent().siblings().find("input").val();
    if ($(this).hasClass("plus")) {
      Value = parseFloat(Value) + 1;
    } else {
      if (Value > 1) {
        Value = parseFloat(Value) - 1;
      }
    }
    $(this).parent().parent().siblings().find("input").val(Value);

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
