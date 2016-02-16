<div id="cart">
  <div class="heading">
    <a><span id="cart-total"><i class="icon-basket"></i> <span class="text"><?php echo $text_items; ?></span></span></a><i class="icon-angle-down"></i></div>
  <div class="content">
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
      <table>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="image"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
              <?php } ?>
              <?php if ($product['recurring']): ?>
              - <small><?php echo $text_payment_profile ?> <?php echo $product['profile']; ?></small><br />
              <?php endif; ?>
            </div></td>
          <td class="quantity">x&nbsp;<?php echo $product['quantity']; ?></td>
          <td class="total"><?php echo $product['total']; ?></td>
          <td class="remove"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABUUlEQVQ4T6WTzSuEURTGZ7ZY0GyUwoo0aZSVJGuRmJUshNXUTGn+gbFkoZR8lDULSpRmsrAaG7MTC42dIsnCxz/A76l76rrNVZpbv27nvOc855z73ptMNLmSkfwM/hnog294gFO4C+NDgRQB+5CFR7hxCUPsPXAMOXg3IV9AyVfQ4oIugmqT2HvwCWPwoe++wAn2MIzAS2S0LvzXrtC8L6CZ1e4EhJVDrWkcZ5CGe+tgFWMJeiOVfbdynmAb1kzgEKMVdPKjUIwIbbgRyuxvsGgCBxhtTkBnsBIR2MRfgwq8qmsTKGEs/2OEZ2K3YN0EBjFuYQrU3l9rlo/6YwNQ93/jEQ61L1Sh0ep2Z3DJvqAAX6ADuwrtkIdz0DW2OB3wDmj2cfgKBWQreRfmQJdJd0NFdJU7QYddsORGAta25lPFftdFnV2PSfuvFXuNYVzU/gFKgz0R4Zk77AAAAABJRU5ErkJggg==" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $product['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $product['key']; ?>' + ' #cart > *');" /></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="image"></td>
          <td class="name"><?php echo $voucher['description']; ?></td>
          <td class="quantity">x&nbsp;1</td>
          <td class="total"><?php echo $voucher['amount']; ?></td>
          <td class="remove"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABUUlEQVQ4T6WTzSuEURTGZ7ZY0GyUwoo0aZSVJGuRmJUshNXUTGn+gbFkoZR8lDULSpRmsrAaG7MTC42dIsnCxz/A76l76rrNVZpbv27nvOc855z73ptMNLmSkfwM/hnog294gFO4C+NDgRQB+5CFR7hxCUPsPXAMOXg3IV9AyVfQ4oIugmqT2HvwCWPwoe++wAn2MIzAS2S0LvzXrtC8L6CZ1e4EhJVDrWkcZ5CGe+tgFWMJeiOVfbdynmAb1kzgEKMVdPKjUIwIbbgRyuxvsGgCBxhtTkBnsBIR2MRfgwq8qmsTKGEs/2OEZ2K3YN0EBjFuYQrU3l9rlo/6YwNQ93/jEQ61L1Sh0ep2Z3DJvqAAX6ADuwrtkIdz0DW2OB3wDmj2cfgKBWQreRfmQJdJd0NFdJU7QYddsORGAta25lPFftdFnV2PSfuvFXuNYVzU/gFKgz0R4Zk77AAAAABJRU5ErkJggg==" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $voucher['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $voucher['key']; ?>' + ' #cart > *');" /></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="mini-cart-total">
      <table>
        <?php foreach ($totals as $total) { ?>
        <tr>
          <td class="total"><b><?php echo $total['title']; ?>:</b></td>
          <td class="total"><?php echo $total['text']; ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="checkout">
      <!-- <a href="<?php echo $cart; ?>" class="btn btn-neutral"><?php echo $text_cart; ?></a> -->
      <a href="<?php echo $checkout; ?>" class="button btn--wide"><?php echo $text_checkout; ?> <i class="icon-arrow-right"></i></a>
    </div>
    <?php } else { ?>
    <div class="empty center"><?php echo $text_empty; ?></div>
    <?php } ?>
  </div>
</div>
