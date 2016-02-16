<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta property="og:title" content="<?php echo $title; ?>">
		<title><?php echo $title; ?></title>

    <style type="text/css">

        @media only screen and (max-width: 480px){
          .templateColumnContainer{
              display:block !important;
              width:100% !important;
          }
          #table-product th.model,
          #table-product th.price,
          #table-product td.model,
          #table-product td.price{
            display: none;
          }
        }
        @media only screen and (max-width: 400px){

          #header tr td {
            display: block !important;
            padding-bottom: 0;
            padding-top: 0;
            text-align: center;
            width: 100%;
          }
          #header tr td img {
            padding-bottom: 20px;
            padding-top: 10px;
          }
        }
    </style>

  </head>

  <body leftmargin="20px" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="font-family: Arial, Helvetica, sans-serif;font-size: 13px; padding: 0 20px 0 20px">
    <center>

      <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" >
        <tr>
          <td align="center" valign="top" style="padding: 0 20px">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="header" style="max-width:600px">
              <tr>
                <td valign="middle" style="padding-bottom: 20px;padding-top: 20px;">
                  <p><?php echo $text_greeting; ?></p>
                  <?php if ($customer_id) { ?>
                    <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_link; ?></p>
                    <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></p><br />
                  <?php } ?>
                  <?php if ($download) { ?>
                    <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_download; ?></p>
                    <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $download; ?>"><?php echo $download; ?></a></p><br />
                  <?php } ?>
                </td>
                <td width="1%" style="padding-top: 20px;">
                  <a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="display:inline; max-width: 125px;height:auto" /></a>
                </td>
              </tr>
            </table>

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="order-detail" style="max-width:600px">
              <tr>
                <td colspan="3" style="font-size:16px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; text-transform: uppercase;border-bottom:2px solid #A9ABB1">
                  <?php echo $text_order_detail; ?>
                </td>
              </tr>
              <tr>
                <td valign="top" width="48%" style="padding-top:20px; font-size: 12px;color: #666666; line-height:16px">
                  <?php echo $text_order_id; ?><br>
                  <strong style="color:#404245; font-size: 13px;">#<?php echo $order_id; ?></strong>
                </td>
                <td width="4%">&nbsp;</td>
                <td valign="top" width="48%" style="padding-top: 20px;font-size: 12px;color: #666666; line-height:16px">
                  <?php echo $text_date_added; ?><br>
                  <strong style="color:#404245; font-size: 13px;"><?php echo $date_added; ?></strong>
                </td>
              </tr>
              <tr>
                <td valign="top" width="48%" style="padding-top:20px; font-size: 12px;color: #666666; line-height:16px">
                  <?php echo $text_email; ?><br>
                  <strong style="color:#404245; font-size: 13px;"><?php echo $email; ?></strong>
                </td>
                <td width="4%">&nbsp;</td>
                <td valign="top" width="48%" style="padding-top: 20px;font-size: 12px;color: #666666; line-height:16px">
                  <?php echo $text_telephone; ?><br>
                  <strong style="color:#404245; font-size: 13px;"><?php echo $telephone; ?></strong>
                </td>
              </tr>
              <tr>
                <td valign="top" width="48%" style="padding-top:20px; font-size: 12px;color: #666666; line-height:16px">
                  <?php echo $text_payment_method; ?><br>
                  <strong style="color:#404245; font-size: 13px;"><?php echo $payment_method; ?></strong>
                </td>
                <td width="4%">&nbsp;</td>
                <td valign="top" width="48%" style="padding-top: 20px;font-size: 12px;color: #666666; line-height:16px">
                  <?php if ($shipping_method) { ?>
                    <?php echo $text_shipping_method; ?><br>
                    <strong style="color:#404245; font-size: 13px;"><?php echo $shipping_method; ?></strong>
                  <?php } else {?>
                    <?php echo $text_ip; ?> <br />
                    <strong style="color:#404245; font-size: 13px;"><?php echo $ip; ?></strong>
                  <?php } ?>
                </td>
              </tr>
            </table>

            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="address-detail" style="max-width:600px">
              <tr>
                <td valign="top" width="48%" style="color: #666666; line-height: 1.25em; padding-top:30px;">
                  <strong style="color: black;font-size:14px; font-weight: bold; padding-top: 8px; text-transform: uppercase; display:block; margin-bottom:5px"><?php echo $text_payment_address; ?></strong>
                  <?php echo $payment_address; ?>
                </td>
                <td width="4%">&nbsp;</td>
                <td valign="top" width="48%" style="color: #666666; line-height: 1.25em; padding-top:30px;">
                  <?php if ($shipping_address) { ?>
                  	<strong style="color: black;font-size:14px; font-weight: bold; padding-top: 8px; text-transform: uppercase; display:block; margin-bottom:5px"><?php echo $text_shipping_address; ?></strong>
                    <?php echo $shipping_address; ?>
                  <?php } else { ?>
                    <strong style="color: black;font-size:14px; font-weight: bold; padding-top: 8px; text-transform: uppercase; display:block; margin-bottom:5px"><?php echo $text_shipping_address; ?></strong>
                    <?php echo $payment_address; ?>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="height: 45px">
                  &nbsp;
                </td>
              </tr>
            </table>

            <table id="table-product" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
              <thead>
                <tr>
                  <th colspan="2" style="background-color: #A9ABB1; color:black; font-size:14px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; padding-left: 10px; padding-right: 10px; text-transform: uppercase;" align="left"><?php echo $text_product; ?></th>
                  <th class="model" style="background-color: #A9ABB1; color:black; font-size:14px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; padding-right: 10px; text-transform: uppercase;" align="left"><?php echo $text_model; ?></th>
                  <th style="background-color: #A9ABB1; color:black; font-size:14px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; padding-left: 10px; padding-right: 10px; text-transform: uppercase;" align="center"><?php echo $text_quantity; ?></th>
                  <th class="price" style="background-color: #A9ABB1; color:black; font-size:14px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; padding-left: 10px;  text-transform: uppercase;" align="right"><?php echo $text_price; ?></th>
                  <th style="background-color: #A9ABB1; color:black; font-size:14px; font-weight: bold; padding-bottom: 8px; padding-top: 8px; padding-left: 10px; padding-right: 10px; text-transform: uppercase;" align="right"><?php echo $text_total; ?></th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach ($products as $product) { ?>
              		<tr>
	                  <td valign="top" style="font-size: 13px; color: #65676D; padding: 10px 10px 10px 0; border-bottom: 1px solid #C8CACD;">
	                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" style="float:left;" /></a>
	                  </td>
	                  <td valign="top" style="font-size: 13px; color: #65676D; padding: 10px 10px 10px 0; border-bottom: 1px solid #C8CACD;">
	                    <a style="color:black" href="http://demo.bukatoko.com/denim/knitwear-street-style-strong-eyebrows-leather-shorts-choupette"><?php echo $product['name']; ?></a>

	                    <?php foreach ($product['option'] as $option) { ?>
	                    	<br />
                        &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
	                    <?php } ;?>
	                  </td>
	                  <td class="model" valign="top" style="font-size: 13px; color: #65676D; padding: 10px 10px 10px 0; border-bottom: 1px solid #C8CACD;" align="left">
	                    <?php echo $product['model']; ?>
	                  </td>
	                  <td valign="top" style="font-size: 13px; color: #65676D; padding: 10px; border-bottom: 1px solid #C8CACD;" align="center">
	                    <?php echo $product['quantity']; ?>
	                  </td>
	                  <td class="price" valign="top" style="font-size: 13px; color: #65676D; padding: 10px 0 10px 20px; border-bottom: 1px solid #C8CACD; white-space:nowrap" align="right">
	                    <?php echo $product['price']; ?>
	                  </td>
	                  <td valign="top" style="font-size: 13px; color:#252627; padding: 10px 0 10px 20px; border-bottom: 1px solid #C8CACD; white-space:nowrap; padding-right: 10px;" align="right">
	                    <?php echo $product['total']; ?>
	                  </td>
	                </tr>
              	<?php } ?>

              	<?php foreach ($vouchers as $voucher) { ?>
              		<tr>
	                  <td colspan="3" valign="top" style="font-size: 13px; color: #65676D; padding: 10px 10px 10px 0; border-bottom: 1px solid #C8CACD;">
	                    <?php echo $voucher['description']; ?>
	                  </td>
	                  <td valign="top" style="font-size: 13px; color: #65676D; padding: 10px; border-bottom: 1px solid #C8CACD;" align="center">
	                    1
	                  </td>
	                  <td class="price" valign="top" style="font-size: 13px; color: #65676D; padding: 10px 0 10px 20px; border-bottom: 1px solid #C8CACD; white-space:nowrap" align="right">
	                    <?php echo $voucher['amount']; ?>
	                  </td>
	                  <td valign="top" style="font-size: 13px; color:#252627; padding: 10px 0 10px 20px; border-bottom: 1px solid #C8CACD; white-space:nowrap; padding-right: 10px;" align="right">
	                    <?php echo $voucher['amount']; ?>
	                  </td>
	                </tr>
              	<?php } ;?>
               </tbody>
            </table>

            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
              <tbody>
                <?php foreach ($totals as $total) { ?>
                	<tr>
                    <td valign="top" style="padding: 10px 0; font-weight: bold; color: #252627; font-size: 13px; border-bottom: 1px solid #C8CACD;" align="right">
                      <?php echo $total['title']; ?>
                    </td>
                    <td width="1%" valign="top" style="padding: 10px 0 0 20px; color: #252627; ; font-size: 13px; border-bottom: 1px solid #C8CACD; white-space: nowrap; padding-right: 10px;" align="right">
                    	<?php echo $total['text']; ?>
                    </td>
                  </tr>
                <?php } ;?>
              </tbody>
            </table>

            <?php if ($comment) { ?>
            	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-top:20px">
	              <tr>
	                <td>
	                	<?php echo $comment; ?>
	                </td>
	              </tr>
            	</table>
            <?php } ;?>

            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-top:20px; margin-bottom:40px">
              <tr>
                <td style="border-top: 1px solid #C8CACD; padding-top:20px">
                  <?php echo $text_footer; ?><br><br>

                  <a href="<?php echo $store_url; ?>index.php?route=information/payment_confirmation">Confirm Payment »</a>
                  <br />
                  <br />
                  <p>Thank you for shopping with us.</p>                        <br />
                  With regards,
                  <br />
                  <a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><?php echo $store_name; ?></a>
                </td>
              </tr>
            </table>

          </td>
        </tr>


      </table>
    </center>
  </body>
</html>