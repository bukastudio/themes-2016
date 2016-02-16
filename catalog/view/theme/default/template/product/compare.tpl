<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarRight";} else {$slotclass = "sidebarNone";};?>

<div id="comparisonPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow">
      <?php echo $content_top ;?>
    </div>

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnCenter">

          <div class="categoryHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

        <?php if ($products) { ?>
          <div class="responsiveBox">

            <table id="tableCompare" class="table--clean table--noborder table--hover">
              <thead>
                <tr>
                  <!-- <th><strong><?php echo $text_name; ?></strong></th> -->
                  <?php foreach ($products as $product) { ?>
                    <th class="product"><a href="<?php echo $products[$product['product_id']]['href']; ?>"><?php echo $products[$product['product_id']]['name']; ?></a></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_image; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><?php if ($products[$product['product_id']]['thumb']) { ?><img src="<?php echo $products[$product['product_id']]['thumb']; ?>" alt="<?php echo $products[$product['product_id']]['name']; ?>" /><?php } ?></td>
                  <?php } ?>
                </tr>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_price; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_price; ?></small><?php if ($products[$product['product_id']]['price']) { ?><?php if (!$products[$product['product_id']]['special']) { ?><?php echo $products[$product['product_id']]['price']; ?><?php } else { ?><span class="price-new"><?php echo $products[$product['product_id']]['special']; ?></span> <span class="price-old"><?php echo $products[$product['product_id']]['price']; ?></span><?php } ?><?php } ?></td>
                  <?php } ?>
                </tr>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_model; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_model; ?></small><?php echo $products[$product['product_id']]['model']; ?></td>
                  <?php } ?>
                </tr>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_manufacturer; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_manufacturer; ?></small><?php echo $products[$product['product_id']]['manufacturer']; ?></td>
                  <?php } ?>
                </tr>

                <tr>
                  <td class="headerColumn"><strong><?php echo $text_availability; ?></strong></td>
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_availability; ?></small><?php echo $products[$product['product_id']]['availability']; ?></td>
                  <?php } ?>
                </tr>

                <?php if ($review_status) { ?>
                  <tr>
                    <!-- <td class="headerColumn"><strong><?php echo $text_rating; ?></strong></td> -->
                    <?php foreach ($products as $product) { ?>
                      <td class="product"><small><?php echo $text_rating; ?></small><img src="catalog/view/theme/default/image/stars-<?php echo $products[$product['product_id']]['rating']; ?>.png" alt="<?php echo $products[$product['product_id']]['reviews']; ?>" /><br /><?php echo $products[$product['product_id']]['reviews']; ?></td>
                    <?php } ?>
                  </tr>
                <?php } ?>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_summary; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_summary; ?></small><p><?php echo $products[$product['product_id']]['description']; ?></p></td>
                  <?php } ?>
                </tr>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_weight; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_weight; ?></small><?php echo $products[$product['product_id']]['weight']; ?></td>
                  <?php } ?>
                </tr>

                <tr>
                  <!-- <td class="headerColumn"><strong><?php echo $text_dimension; ?></strong></td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><small><?php echo $text_dimension; ?></small><?php echo $products[$product['product_id']]['length']; ?> x <?php echo $products[$product['product_id']]['width']; ?> x <?php echo $products[$product['product_id']]['height']; ?></td>
                  <?php } ?>
                </tr>

                <?php foreach ($attribute_groups as $attribute_group) { ?>
                  <tr>
                    <!-- <td class="headerColumn"><br><strong><?php echo $attribute_group['name']; ?></strong></td> -->
                    <td class="product">&nbsp;</td>
                    <td class="product">&nbsp;</td>
                    <td class="product">&nbsp;</td>
                    <td class="product">&nbsp;</td>
                  </tr>
                  <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
                    <tr>
                      <td class="headerColumn"><em><?php echo $attribute['name']; ?></em></td>
                      <?php foreach ($products as $product) { ?>
                        <?php if (isset($products[$product['product_id']]['attribute'][$key])) { ?>
                          <td class="product"><small><?php echo $attribute_group['name']; ?> &rsaquo; <?php echo $attribute['name']; ?></small><?php echo $products[$product['product_id']]['attribute'][$key]; ?></td>
                        <?php } else { ?>
                          <td class="product">&nbsp;</td>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  <?php } ?>
                <?php } ?>

              </tbody>
              <tfoot>
                <tr>
                  <!-- <td class="headerColumn">&nbsp;</td> -->
                  <?php foreach ($products as $product) { ?>
                    <td class="product"><br><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /><br><a href="<?php echo $product['remove']; ?>"><?php echo $button_remove; ?></a></td>
                  <?php } ?>
                </tr>

              </tfoot>
            </table>

          </div>
        <?php } else { ?>
          <br><br><?php echo $text_empty; ?><br><br><br><br>
        <?php } ?>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
