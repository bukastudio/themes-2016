<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta property="og:title" content="<?php echo $title; ?>">
    <title><?php echo $title; ?></title>
  </head>

  <style>
    img {
      max-width: 100%;
    }
  </style>

  <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="font-family: Helvetica, sans-serif;font-size: 13px;">
    <center>
      <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
        <tr>
          <td align="center" valign="top">

            <table bgcolor="#FDF5E5" border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainer" style="max-width:600px">

              <tr>
                <td align="center" valign="top">

                  <!-- CONTENT -->
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">

                    <tr>
                      <td align="center">
                        <a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $store_name; ?>" style="max-width:100%" /></a>
                      </td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellpadding="20" cellspacing="0">

                    <?php if ($message) { ?>
                      <tr>
                        <td align="center">
                          <?php echo $text_greeting; ?>
                          <p style="margin-top:35px"><?php echo $text_message; ?></p>
                          <p style="padding: 0 40px; line-height: 1.25em"><em>“<?php echo $message; ?>”</em></p>
                          <p><strong>- <?php echo $text_from; ?> -</strong></p>
                        </td>
                      </tr>
                    <?php } ;?>

                    <tr>
                      <td align="center" style="padding:0 20px 40px">
                        <p style="font-size:12px;">Your Redemption Code:</p>
                        <p>
                          <span style="font-size:16px; padding: 10px; background-color: white;"><strong><?php echo $text_redeem; ?></strong></span>
                        </p>
                      </td>
                    </tr>

                  </table>
                  <!-- end CONTENT -->

                </td>
              </tr>

            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateContainer" style="margin-top:20px; max-width:600px">
              <tr>
                <td align="center" valign="top" style="font-size:11px; padding: 0 30px 50px;">
                  <p>To redeem this Gift Certificate, write down the redemption code then click on the the link below and purchase the product you wish to use this gift voucher on. You can enter the gift voucher code on the checkout page.</p>

                  <p style="margin-bottom:30px;">
                    <a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><?php echo $store_url; ?></a>
                  </p>

                  <p><?php echo $text_footer; ?></p>
                </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
    </center>

  </body>
</html>