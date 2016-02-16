<?php echo $header; ?>

<?php

    $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $prefix  = substr(str_shuffle($letters), 0, 4);

    function get_payment_list($channel_list, $channel)
    {
        if ( isset($channel_list) )
        {
            if ( in_array($channel, $channel_list) )
            {
                $result = "checked";
            }
            else
            {
                $result = "";
            }
        }
        else
        {
            $result = "";
        }
        
        return $result;
    }

    function get_payment_name($channel_list, $channel, $default)
    {
        if ( isset($channel_list) )
        {
            if ( is_array($channel_list) && array_key_exists($channel, $channel_list) )
            {
                $result = $channel_list[$channel];
            }
            else
            {
                $result = $default;
            }
        }
        else
        {
            $result = $default;
        }
        
        return $result;
    }
    
?>

<div id="content">

<div class="breadcrumb">
<?php 
    foreach ($breadcrumbs as $breadcrumb) 
    {
        echo $breadcrumb['separator']; 
?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
<?php 
    } 
?>
</div>

<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>

<div class="box">
    <div class="heading">
        <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
        <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    
    <div class="content">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      
        <div class="dashboard-heading"><?php echo $server_params; ?></div>
        <div class="dashboard-content">
        <table class="form">
            
            <tr>
                <td><span class="required">*</span> <?php echo $entry_storeid; ?></td>
                <td><input size="30" type="text" name="myshortcart_storeid" placeholder="Input your Store ID here" value="<?php echo ( $myshortcart_storeid=='' ? "99999999" : $myshortcart_storeid ) ?>" />
                <?php if ($error_storeid) { ?>
                <span class="error"><?php echo $error_storeid; ?></span>
                <?php } ?>
                </td>
                <td align="left"><span class="breadcrumb"> * Input your Store ID given by Myshortcart</span></td>
            </tr>

            <tr>
                <td><span class="required">*</span> <?php echo $entry_sharedkey; ?></td>
                <td><input size="30" type="text" name="myshortcart_sharedkey" placeholder="Input your Sharedkey here" value="<?php echo ( $myshortcart_sharedkey=='' ? "99999999" : $myshortcart_sharedkey ) ?>" />
                <?php if ($error_sharedkey) { ?>
                <span class="error"><?php echo $error_sharedkey; ?></span>
                <?php } ?>
                </td>
                <td align="left"><span class="breadcrumb"> * Input your Sharedkey given by Myshortcart</span></td>
            </tr>

            <tr>
                <td><span class="required">*</span> <?php echo $entry_prefix; ?></td>
                <td><input size="30" type="text" name="myshortcart_prefix" placeholder="Input your Prefix here" value="<?php echo ( $myshortcart_prefix=='' ? $prefix : $myshortcart_prefix ) ?>" />
                <?php if ($error_prefix) { ?>
                <span class="error"><?php echo $error_prefix; ?></span>
                <?php } ?>
                </td>
                <td align="left"><span class="breadcrumb"> * Input your 4 Prefix Character for set unique invoice number. Do not use _ (underscore)</span></td>
            </tr>
            
        </table>
        </div>
        
        <br>
        
        <div class="dashboard-heading"><?php echo $opencart_params; ?></div>
        <div class="dashboard-content">
        <table class="form">
          
          <!-- Make order status default -->
          <input type="hidden" name="myshortcart_order_status_id" value=2>
          <!-- So we don't display this -->
          <!-- 
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="myshortcart_order_status_id">
                <?php
                    foreach ($order_statuses as $order_status) {
                        if ($order_status['order_status_id'] == $myshortcart_order_status_id) {
                ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php   } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" <?php echo ( $order_status['order_status_id']==2 && !isset($myshortcart_order_status_id) ? "selected":" disabled=\"disabled\"" ) ?>><?php echo $order_status['name']; ?></option>
                <?php   } ?>
                <?php } ?>
              </select>
            </td>
            <td align="left"><span class="breadcrumb"> * Transaction status when redirect to Myshortcart. Default is 'Processing'.</span></td>
          </tr>
          -->
          
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="myshortcart_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $myshortcart_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <td align="left"><span class="breadcrumb">Choose your default Geo Zone</span></td>
          </tr>

          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="myshortcart_status">
                <?php if ($myshortcart_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </td>
            <td align="left"><span class="breadcrumb">Disable or Enable Myshortcart Plugin</span></td>
          </tr>

            <tr>
                <td><span class="required">*</span> <?php echo $entry_minimal_amount; ?></td>
                <td><input size="30" type="text" name="myshortcart_minimal_amount" placeholder="Minimal amount to process" value="<?php echo ( $myshortcart_minimal_amount=='' ? "10000.00" : $myshortcart_minimal_amount ) ?>" />
                <?php if ($error_minimal_amount) { ?>
                <span class="error"><?php echo $error_minimal_amount; ?></span>
                <?php } ?>                
                </td>
                <td align="left"><span class="breadcrumb"> * Minimal amount to be processed. Default 10000.00, 999999999999 means no limit.</span></td>
            </tr>
                      
            <tr>
                <td><?php echo $entry_sort_order; ?></td>
                <td><input size="30" type="text" name="myshortcart_sort_order" placeholder="Input your expired time for transaction here" value="<?php echo ( $myshortcart_sort_order=='' ? "1" : $myshortcart_sort_order ) ?>" /></td>
                <td align="left"><span class="breadcrumb"> Sort Order on Payment Method</span></td>
            </tr>
            
        </table>
    </div>

       <br>

        <div class="dashboard-heading"><?php echo $paymentchannel_params; ?></div>
        <div class="dashboard-content">
        <table class="form">
            
            <tr>
                <td><span class="required">*</span> <?php echo $entry_payment_name; ?></td>
                <td><input size="30" type="text" name="myshortcart_payment_name" placeholder="Input Myshortcart name to display" value="<?php echo ( $myshortcart_payment_name=='' ? "Myshortcart Payment Gateway" : $myshortcart_payment_name ) ?>" />
                <?php if ($error_payment_name) { ?>
                <span class="error"><?php echo $error_payment_name; ?></span>
                <?php } ?>
                </td>
                <td align="left"><span class="breadcrumb"> * Input Myshortcart name to be displayed on Payment Method selection</span></td>
            </tr>

        </table>
                
        </div>
        </form>
          
        <br>
        
       <div class="dashboard-heading"><?php echo $url_title; ?></div>
             <div class="dashboard-content">
               <div class="content">
                 <table class="form">
                    <tr>
                        <td>Identify :</td>
                        <td>
                            <input type="text" value="<?php echo $url_verify ?>" size="100" readonly="true" />
                        </td>
                    </tr>
                    <tr>
                        <td>Notify :</td>
                        <td>
                            <input type="text" value="<?php echo $url_notify ?>" size="100" readonly="true" />
                        </td>
                    </tr>
                    <tr>
                        <td>Redirect :</td>
                        <td>
                            <input type="text" value="<?php echo $url_redirect ?>" size="100" readonly="true" />
                        </td>
                    </tr>
                    <tr>
                        <td>Cancel :</td>
                        <td>
                            <input type="text" value="<?php echo $url_cancel ?>" size="100" readonly="true" />
                        </td>
                    </tr>                    
                </table>
              </div>    
        </div>  
   </div>    
  </div>
</div>

<?php if ($error_warning) { ?>
<span class="error"><?php echo $error_warning; ?></span>
<?php } ?>
            
<?php echo $footer; ?> 