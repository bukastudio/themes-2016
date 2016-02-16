<?php echo $header; ?>

<div id="orderInfoPage" class="contentSlot">
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

            <div class="order-info table table--noborder">
              <div class="tableBody">
                <div class="tableRow">
                  <div class="half">
                    <?php if ($invoice_no) { ?>
                      <strong><?php echo $text_invoice_no; ?>:</strong> <?php echo $invoice_no; ?><br />
                    <?php } ?>
                    <strong><?php echo $text_order_id; ?>:</strong> #<?php echo $order_id; ?><br />
                    <strong><?php echo $text_date_added; ?>:</strong> <?php echo $date_added; ?>
                  </div>
                  <div class="half">
                    <?php if ($payment_method) { ?>
                      <strong><?php echo $text_payment_method; ?>:</strong> <?php echo $payment_method; ?><br />
                    <?php } ?>
                    <?php if ($shipping_method) { ?>
                      <strong><?php echo $text_shipping_method; ?>:</strong> <?php echo $shipping_method; ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="order-info table table--noborder">
              <div class="tableBody">
                <div class="tableRow">
                  <div class="half">
                    <h3><?php echo $text_payment_address; ?></h3>
                    <?php echo $payment_address; ?>
                  </div>
                  <?php if ($shipping_address) { ?>
                    <div class="half">
                      <h3><?php echo $text_shipping_address; ?></h3>
                      <?php echo $shipping_address; ?>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <h2 id="order-detail-heading"><?php echo $text_order_detail; ?></h2>

            <div class="table table-clean table--noborder table--hover" id="order-detail">

              <div class="tableHead">
                <div class="tableRow">
                  <div><?php echo $column_name; ?></div>
                  <div><?php echo $column_model; ?></div>
                  <div class="qty"><?php echo $column_quantity; ?></div>
                  <div class="price"><?php echo $column_price; ?></div>
                  <div class="total"><?php echo $column_total; ?></div>
                  <?php if ($products) { ?>
                    <div style="width: 1px;">&nbsp;</div>
                  <?php } ?>
                </div>
              </div>

              <div class="tableBody">
                <?php foreach ($products as $product) { ?>
                  <div class="tableRow">
                    <div>
                      <span class="show_mobile"><?php echo $product['quantity']; ?>x <?php echo $column_name; ?>: </span><?php echo $product['name']; ?>
                      <?php foreach ($product['option'] as $option) { ?>
                        <br />&nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                      <?php } ?>
                    </div>
                    <div><span class="show_mobile"><?php echo $column_model; ?>: </span><?php echo $product['model']; ?></div>
                    <div class="qty"><?php echo $product['quantity']; ?></div>
                    <div class="price"><span class="show_mobile"><?php echo $column_price; ?></span><?php echo $product['price']; ?></div>
                    <div class="total"><span class="show_mobile"><?php echo $column_total; ?></span><?php echo $product['total']; ?></div>
                    <?php if ($products) { ?>
                      <div class="action"><a href="<?php echo $product['return']; ?>"><i class="icon-rotate"></i><?php echo $button_return; ?></a></div>
                    <?php } ?>
                  </div>
                <?php } ?>
                <?php foreach ($vouchers as $voucher) { ?>
                  <div class="tableRow">
                    <div><?php echo $voucher['description']; ?></div>
                    <div>&nbsp;</div>
                    <div class="qty">1</div>
                    <div class="price"><?php echo $voucher['amount']; ?></div>
                    <div class="total"><?php echo $voucher['amount']; ?></div>
                  <?php if ($products) { ?>
                    <div>&nbsp;</div>
                  <?php } ?>
                  </div>
                <?php } ?>
              </div>

              <div class="tableFoot">
                <?php foreach ($totals as $total) { ?>
                  <div class="tableRow">
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div class="price"><strong><?php echo $total['title']; ?>:</strong></div>
                    <div class="total"><?php echo $total['text']; ?></div>
                    <?php if ($products) { ?>
                      <div></div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>

            </div>

            <?php if ($comment) { ?>
              <h2><?php echo $text_comment; ?></h2>
              <?php echo $comment; ?><br>
            <?php } ?>

            <?php if ($histories) { ?>
              <h2><?php echo $text_history; ?></h2>
              <div id="table-history" class="table table-clean table--noborder">
                <div class="tableHead">
                  <div class="tableRow">
                    <div style="white-space:nowrap"><?php echo $column_date_added; ?></div>
                    <div style="width:1%"><?php echo $column_status; ?></div>
                    <div><?php echo $column_comment; ?></div>
                  </div>
                </div>
                <div class="tableBody">
                  <?php foreach ($histories as $history) { ?>
                    <div class="tableRow">
                      <div><?php echo $history['date_added']; ?></div>
                      <div style="width:1%"><?php echo $history['status']; ?></div>
                      <div><?php echo $history['comment']; ?></div>
                    </div>
                  <?php } ?>
                </div>
              </div>
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
