<?php echo $header; ?>

<div id="orderListPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

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
            <?php if ($orders) { ?>
              <div id="order-history" class="table table--noborder table--hover">
                <div class="tableHead">
                  <div class="tableRow">
                    <div class="order-id"><?php echo $text_order_id; ?></div>
                    <div class="status"><?php echo $text_status; ?></div>
                    <div class="date-added"><?php echo $text_date_added; ?></div>
                    <div class="customer"><?php echo $text_customer; ?></div>
                    <div class="qty"><?php echo $text_products; ?></div>
                    <div class="price"><?php echo $text_total; ?></div>
                    <div class="action">Action</div>
                  </div>
                </div>
                <div class="tableBody">
                  <?php foreach ($orders as $order) { ?>
                    <div class="tableRow">
                      <div class="order-id"><strong>#<?php echo $order['order_id']; ?></strong><span class="show_mobile"><?php echo $order['status']; ?> - <?php echo $order['date_added']; ?></span></div>
                      <div class="status"><?php echo $order['status']; ?></div>
                      <div class="date-added"><?php echo $order['date_added']; ?></div>
                      <div class="customer"><?php echo $order['name']; ?></div>
                      <div class="qty"><?php echo $order['products']; ?></div>
                      <div class="price"><?php echo $order['total']; ?><span class="show_mobile small"><?php echo $text_products; ?>: <?php echo $order['products']; ?></span></div>
                      <div class="action">
                        <a href="<?php echo $order['href']; ?>"><i class="icon-view"></i>View</a><a href="<?php echo $order['reorder']; ?>"><i class="icon-rotate"></i><?php echo $button_reorder; ?></a>
                      </div>
                    </div>
                  <?php } ;?>
                </div>
              </div>
              <div class="pagination"><?php echo $pagination; ?></div>
            <?php } else { ?>
              <?php echo $text_empty; ?><br><br>
            <?php } ;?>

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
