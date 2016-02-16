<?php echo $header; ?>

<div id="wishlistPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
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
            <?php if ($products) { ?>
              <table class="table--noborder table--hover">
                <thead>
                  <tr>
                    <!-- <th class="image"><//?php echo $column_image; ?></th> -->
                    <th class="name"><?php echo $column_name; ?></th>
                    <!-- <th class="model"><//?php echo $column_model; ?></th> -->
                    <th class="stock"><?php echo $column_stock; ?></th>
                    <th class="price"><?php echo $column_price; ?></th>
                    <th class="action"><?php echo $column_action; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $product) { ?>
                    <tr id="wishlist-row<?php echo $product['product_id']; ?>">
                      <td class="name">
                        <?php if ($product['thumb']) { ?>
                          <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
                        <?php } ?>
                        <div>
                          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><br>
                          <span>
                            <small><?php echo $column_model; ?></small> <?php echo $product['model']; ?>
                          </span>
                        </div>
                      </td>
                      <!-- <td class="model"><//?php echo $product['model']; ?></td> -->
                      <td class="stock"><?php echo $product['stock']; ?></td>
                      <td class="price">
                        <?php if ($product['price']) { ?>
                          <?php if (!$product['special']) { ?>
                            <?php echo $product['price']; ?>
                          <?php } else { ?>
                            <?php echo $product['special']; ?><br><s><?php echo $product['price']; ?></s>
                          <?php } ?>
                        <?php } ?>
                      </td>
                      <td class="action">
                        <a onclick="addToCart('<?php echo $product['product_id']; ?>');"><i class="icon-basket">&nbsp;</i><span><?php echo $button_cart ?></span></a><a href="<?php echo $product['remove']; ?>"><i class="icon-trash-bin">&nbsp;</i><span><?php echo $button_delete; ?></span></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>

            <?php } else { ?>
              <?php echo $text_empty; ?>
            <?php } ?>

            <div class="button-block">
              <a href="<?php echo $continue; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
