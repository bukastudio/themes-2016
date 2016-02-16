  <?php if($products) { ;?>
  <div id="moduleRandom" class="module module--catalog">
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
