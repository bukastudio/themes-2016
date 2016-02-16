<br><br>
<?php if (!isset($redirect)) { ?>
<div class="checkout-product">
  <div id="cart-info" class="table table-clean table-hover table-striped table-noborder">

    <div class="table-head">
      <div class="table-row">
        <div class="name"><?php echo $column_name; ?></div>
        <div class="model"><?php echo $column_model; ?></div>
        <div class="quantity"><?php echo $column_quantity; ?></div>
        <div class="price"><?php echo $column_price; ?></div>
        <div class="total"><?php echo $column_total; ?></div>
      </div>
    </div>

    <div class="table-body">
      <?php foreach ($products as $product) { ?>
      <?php if($product['recurring']): ?>
        <div class="table-row">
            <div colspan="6" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" /><span style="float:left;line-height:18px; margin-left:10px;">
                <strong><?php echo $text_recurring_item ?></strong>
                <?php echo $product['profile_description'] ?>
            </div>
        </div>
      <?php endif; ?>
      <div class="table-row">
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
          <?php } ?>
          <?php if($product['recurring']): ?>
          <br />
          &nbsp;<small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
          <?php endif; ?>
        </div>
        <div class="model"><?php echo $product['model']; ?></div>
        <div class="quantity"><?php echo $product['quantity']; ?></div>
        <div class="price"><?php echo $product['price']; ?></div>
        <div class="total"><?php echo $product['total']; ?></div>
      </div>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <div class="table-row">
        <div class="name"><?php echo $voucher['description']; ?></div>
        <div class="model"></div>
        <div class="quantity">1</div>
        <div class="price"><?php echo $voucher['amount']; ?></div>
        <div class="total"><?php echo $voucher['amount']; ?></div>
      </div>
      <?php } ?>
    </div>

    <div class="table-foot">
      <?php foreach ($totals as $total) { ?>
      <div class="table-row">
        <div class="name">&nbsp;</div>
        <div class="model">&nbsp;</div>
        <div class="quantity"><strong><?php echo $total['title']; ?>:</strong></div>
        <div  class="price"><strong><?php echo $total['title']; ?>:</strong></div>
        <div class="total"><?php echo $total['text']; ?></div>
      </div>
      <?php } ?>
    </div>

  </div>
  <!-- /End .table -->
</div>
<div class="payment"><?php echo $payment; ?></div>

<?php } else { ?>
<script type="text/javascript"><!--
location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>