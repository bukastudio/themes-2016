<!DOCTYPE html>
<html>
<head>
    <title>POS</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href='https://fonts.googleapis.com/css?family=Rubik:400,700,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="view/stylesheet/pos/style.css" media="screen">
    <!-- <link rel="stylesheet" href="view/stylesheet/pos/iconFont.css"> -->
    <link rel="stylesheet" href="view/stylesheet/pos/metro-bootstrap.css" media="screen">
    <!-- <link rel="stylesheet" href="view/stylesheet/pos/jquery.bxslider.css"> -->
    <link rel="stylesheet" href="view/stylesheet/pos/themes/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen">
    <link rel="stylesheet" href="view/javascript/pos/tinyscrollbar/tinyscrollbar.css" media="screen">
    <link rel="stylesheet" href="view/javascript/pos/fancybox/jquery.fancybox.css" media="screen">
    <script type="text/javascript" src="view/javascript/pos/jquery.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/print/printThis.js"></script>
    <script type="text/javascript" src="view/javascript/pos/tinyscrollbar/jquery.tinyscrollbar.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.bxslider.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.keyboard.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="view/javascript/pos/fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.maskedinput-1.3.js"></script>
    <link rel="stylesheet" href="view/stylesheet/pos/bukatoko.css" media="screen">
    <link type="text/css" rel="stylesheet" href="view/stylesheet/pos/print.css" media="print" />

    <!-- Dialog -->
    <script type="text/javascript" src="view/javascript/pos/metro/metro.min.js"></script>

</head>
<body class="metro page-pos-home">
 <div class="container">
  <div class="grid">
    <div id="pos-header" class="row">
      <div class="top-left">
        <div class="logged ">
            Cashier: <?= $logged; ?>
        </div>
        <div class="footer_timer">
          <span></span>
        </div>
      </div>
      <div class="top-right">
        <div class="top_menu">
          <ul>
              <li>
                  <a class="fancybox.iframe" href="index.php?route=pos/customer&token=<?= $token ?>" id="add_customer">
                    <i class="icon-user-add-uno"></i>
                    <span>Add Customer</span>
                  </a>
              </li>
              <li>
                  <a class="fancybox.ajax" href="index.php?route=pos/pos/orders&token=<?= $token ?>" id="order_list">
                    <i class="icon-paper-word-text-reading"></i>
                    <span>Order list</span>
                  </a>
              </li>
              <li>
                  <a onclick="print_link(); return false;" href="#">
                    <i class="icon-printer-print"></i>
                    <span>Print</span>
                  </a>
              </li>
              <li>
                  <a href="index.php?route=pos/pos/index&token=<?= $token ?>">
                    <i class="icon-sync""></i>
                    <span>Refresh</span>
                  </a>
              </li>
              <li>
                  <a href="index.php?route=pos/pos/logout&token=<?= $token ?>">
                    <i class="icon-exit-logout"></i>
                    <span>Logout</span>
                  </a>
              </li>
          </ul>
      </div>
      </div>
    </div>
    <div class="row">

        <!-- END .span4 -->

        <!--=========================== top category list ==========================-->


        <!-- END .span1 -->

        <!---=========================  product list ============================-->
        <div id="category-container" class="product_container">

          <div class="search_bar_wrapper">

            <div class="search_bar ">
                <div class="input-control text nrm">
                    <input type="text" placeholder="Search..." name="q" id="q" />
                    <button type="button" class="btn-search"></button>
                </div>
            </div>
            <div class="logo ">
                <h3>KRAFTY POS</h3>
            </div>
            <div class='clear'></div>
          </div>
          <!-- END .search_bar_wrapper -->

          <div id="cat-container" class="category_container bg-black">

            <ul class="top_category_list">

                <?php

                $color_array = array('bg-lightBlue','bg-darkViolet','bg-darkCyan','bg-violet','bg-indigo','bg-magenta');
                $i = 0;
                $length = sizeof($color_array);

                foreach($categories as $category){ ?>

                <li data-category-id="<?= $category['category_id'] ?>" >
                    <center><img src="<?= $category['image'] ?>" /></center>
                    <span><?= $category['name'] ?></span>
                </li>

                <?php $i++; if($i == $length) $i=0; } ?>

            </ul>

        </div>

          <div class="product_list">
            <div class="scrollbar_wrapper" id="scrollbar1">
              <div class="scrollbar">
                <div class="track">
                    <div class="thumb">
                        <div class="end"></div>
                    </div>
                </div>
              </div>
              <!-- scrollbar -->
              <div class="viewport">
                  <div class="overview">
                  </div>
              </div>
            </div>
          </div>
          <!-- END .product_list -->

          <div class="product_pager hide">
              <button class="button info large ">Load more...</button>
          </div>

          <div class="clear"></div>
          <div class="product-info product_list_bottom hide">
              <input type="hidden" name="product_id" class="product_id" />
              <div id="option"></div>
          </div>
        </div>
        <!-- END .span6 -->

        <div id="cart-container">
            <div class="drdw_store css3-metro-dropdown">
                <select id="stores" name="stores" onchange="location = 'index.php?route=pos/pos/index&store_id='+this.value+'&token=<?= $token ?>';">
                    <option value='0'><?= $this->config->get('default_store'); ?></option>
                    <?php foreach($stores as $store){ ?>
                        <option <?php if($store['store_id'] == $store_id) echo 'selected'; ?> value="<?= $store['store_id'] ?>"><?= $store['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="top_menu_wrapper">

            <div class="">
                <div class="balance">
                    Cash : <?= $cash; ?><br>
                    Card : <?= $card; ?>
                </div>
            </div>




            <div class="clear"></div>
            </div>
            <!-- END .top_menu_wrapper -->

            <div id="barcode-box" class='input_wrapper'>
                <input class='input-element' placeholder="Enter Barcode" type="text" name="barcode" id="barcode" />
                <button href="#hold_carts_wrapper" class=" btn_cart_hold_count">HOLDS: <?= sizeof($hold_carts); ?></button>
                <button href="#hold_wrapper" class=" btn_cart_hold_add">+ HOLD</button>
            </div>

            <div class="scrollbar_wrapper" id="scrollbar2">
              <div class="scrollbar">
                <div class="track">
                    <div class="thumb">
                        <div class="end"></div>
                    </div>
                </div>
              </div>
              <!-- scrollbar -->
              <div class="viewport">
                  <div class="overview">

                    <div class="order_head">
                      <?php
                        $show_store = $this->config->get('pos_show_store_name');
                        $show_tin = $this->config->get('pos_show_tin_no');
                        $show_address = $this->config->get('pos_show_address');
                        $show_telephone = $this->config->get('pos_show_telephone');
                        $store = $this->config->get('config_name');
                        $config_address = $this->config->get('config_address');
                        $config_telephone = $this->config->get('config_telephone');
                        $tin = $this->config->get('pos_tin_no');


                        ?>

                      <div class="stor_logo ">
                        <img src="<?php echo $logo; ?>" title="<?php echo $store; ?>" alt="<?php echo $store; ?>" />

                      </div>

                      <div class="address">
                        <?php if($show_address){ ?>
                          <?= nl2br($config_address) ?>
                        <?php } if($show_telephone){ ?>
                          <br/><?= $config_telephone ?>
                        <?php } ?>
                      </div>

                      <table class="info">
                        <tr>
                          <td>
                            Cashier: <?= $logged; ?>
                          </td>
                          <td>
                            <?php echo date("D j M Y G:i:s") ;?>
                          </td>
                        </tr>
                      </table>

                    </div>

                    <table class='table table-bordered cart_table'>
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th class="center">Qty</th>
                            <th class="right">Price</th>
                            <!-- <th>Tax</th> -->
                            <th class="right">Total</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <!--
                           <tr>
                               <td>MacBook<br></td>
                               <td><span class="minus">-</span><span class="qty">1</span><span class="plus">+</span></td>
                               <td>$500.00</td>
                               <td>$587.50</td>
                               <td><a data-key="43::" class="cart_remove"><i class="icon-cancel-2"></i></a></td>
                           </tr>
                           -->
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <!-- END #scrollbar2 -->
            <div class="total_wrapper">

                <div>

                    <span id="cart-total"><?= $this->currency->format('0.00') ?></span>
                    <strong>Sub total</strong>
                </div>
                <!-- <div>
                    <strong>TAX</b><br>
 strong                  <span id="cart-total"><?= $this->currency->format('0.00') ?></span>
                </div> -->
                <div>

                    <span id="cart-total"><?= $this->currency->format('0.00') ?></span>
                    <strong>Order Totals</strong>
                </div>

            </div>
            <div class="thanks">Thank you for shopping<br><?php if($show_store){echo $store;} ?></div>
<div class="input_wrapper discount_wrapper">

                  <?php if($dicount_status){ ?>
                  <div class="input_row">
                    <input class=' input-element' placeholder="Enter Discount" type="text" name="discount_amount" id="discount_amount" />
                    <div class=" css3-metro-dropdown">
                        <select name="discount_type" id="discount_type">
                            <option value="F">Fixed</option>
                            <option value="P">Percentage</option>
                        </select>
                    </div>
                    <button onclick="discount()" class="button">Apply Discount</button>
                  </div>
                  <?php }else{ ?>
                  <div class="label alert">
                      Discount module not enabled!
                  </div>
                  <?php } ?>
                  <div class="input_row">
                    <input class='input-element' placeholder="Enter Coupon Code" type="text" name="coupon" id="coupon" />
                    <button onclick="coupon()" class="button">Apply Coupon</button>
                  </div>
                  <div class="input_row">
                    <input class='input-element' placeholder="Apply Voucher Code" type="text" name="voucher" id="voucher" />
                    <button onclick="voucher()" class="button">Apply Voucher</button>
                  </div>

            </div>




            <div id="confirm-button">
                    <button id="order" href="index.php?route=pos/pos/confirm&token=<?= $token ?>" class="fancybox.ajax command-button">

                        Checkout

                    </button>
                </div>




        </div>
    </div>
  </div>
  <!-- END .grid -->
</div>
<!-- END .page -->

<!--========================================= hold cart list pop up ============================================-->
<div class="hide">
<div id="hold_carts_wrapper">
    <h3>Holded Cart</h3><hr>
    <table class="table striped">
      <thead>
        <tr>
            <th>Name</th>
            <th>Date created</th>
            <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($hold_carts as $cart){ ?>
          <tr>
              <td><?= $cart['name'] ?></td>
              <td align="center"><?= $cart['date_created'] ?></td>
              <td align="center">
                  [<a data_cart_holder_id='<?= $cart["cart_holder_id"] ?>' href="#" class="select">Select</a>]&nbsp;
                  [<a data_cart_holder_id='<?= $cart["cart_holder_id"] ?>' href="#" class="delete">Delete</a>]
              </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
</div>
<!-- END .hold_wrapper -->

<!--========================== cart to hold pop up =========================================-->
<div id="hold_wrapper">
    <div class="hold_form">
        <h3>Put Current Cart to Hold</h3><hr>
        <div class="message_wrapper"></div>
        <div class="grid">
            <div class="row">
                <div>
                    <div data-role="input-control" class="input-control text">
                        <input id="hold_name" type="text" name="hold_name" placeholder="Enter Hold Name">
                        <button id="hold_confirm" class="button">Apply</button>
                    </div>
                </div>
                <!-- END .span4 -->
            </div>
            <!-- END .row -->
        </div>
        <!-- END .grid -->
    </div>
    <!-- END .hold_form -->
</div>
<!-- END .hold_wrapper -->
</div>
<!-- END .hide -->

<!-- Contain order id to edit -->
<input type="hidden" name="order_id" value="" />


<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':62182/autorefresh.js"></' + 'script>')</script>

</body>
</html>

<script type="text/javascript">
    var token = '<?= $token ?>';
    var total_hold = '<?= sizeof($hold_carts); ?>';
    var total = 0;
    var zero_price = "<?= $this->currency->format('0.00') ?>";

    $(document).ready(function() {
        $('.date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>

<script type="text/javascript" src="view/javascript/pos/application/timer.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/scrollbar.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/product.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/print.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/order.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/fancybox.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/discount.js"></script>
<script type="text/javascript" src="view/javascript/pos/application/cart.js"></script>

<script>
    $(function(){
        getItems("<?= $categories[0]['category_id'] ?>",1);
    });
</script>