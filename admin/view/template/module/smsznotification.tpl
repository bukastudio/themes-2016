<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/setting.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      	<table class="form" id="setgate">
      		<?php if ($balance != "") { ?>
	      		<tr>
		          <td><span class="required"><?php echo $text_balance; ?><br /><br /><?php echo $text_aktif; ?></span></td>
		          <td><span class="required"><?php echo $balance; ?><br /><br /><?php echo $aktif; ?></span></td>
		        </tr>
	      	<?php } ?>
      		<tr>
            <td><span class="required">*</span> <?php echo $entry_gateway; ?></td>
            <td><select name="gateway">
            		<option value=""><?php echo $text_none; ?></option>
            		
            		<?php if ($gateway=="onewaymasking") { ?>
            			<option value="onewaymasking" selected="selected">One Way Masking</option>
            		<?php }else{ ?>
            			<option value="onewaymasking">One Way Masking</option>
            		<?php } ?>
            		
            		<?php if ($gateway=="oneway") { ?>
            			<option value="oneway" selected="selected">One Way GSM</option>
            		<?php }else{ ?>
            			<option value="oneway">One Way GSM</option>
            		<?php } ?>
            		
            		<?php if ($gateway=="twoway") { ?>
            			<option value="twoway" selected="selected">Two Way</option>
            		<?php }else{ ?>
            			<option value="twoway">Two Way</option>
            		<?php } ?>
            		
              </select>
              <?php if ($error_gateway) { ?>
              <span class="error"><?php echo $error_gateway; ?></span>
              <?php } ?></td>
          </tr>
          <tbody id="gateway-onewaymasking" class="gateway">
	          <tr>
	            <td><span class="required">*</span> <?php echo $entry_userkey; ?></td>
	            <td><input type="text" name="userkey_onewaymasking" value="<?php echo $userkey_onewaymasking; ?>" size="30px">
	            <?php if ($error_userkey_onewaymasking) { ?>
	              <span class="error"><?php echo $error_userkey_onewaymasking; ?></span>
	              <?php } ?></td>
	          </tr>
	          <tr>
	          	<td><span class="required">*</span> <?php echo $entry_passkey; ?></td>
	            <td><input type="password" name="passkey_onewaymasking" value="<?php echo $passkey_onewaymasking; ?>" size="30px">
	            <?php if ($error_passkey_onewaymasking) { ?>
	              <span class="error"><?php echo $error_passkey_onewaymasking; ?></span>
	              <?php } ?></td>
	          </tr>
	      	</tbody>
	      	<tbody id="gateway-oneway" class="gateway">
	          <tr>
	            <td><span class="required">*</span> <?php echo $entry_userkey; ?></td>
	            <td><input type="text" name="userkey_oneway" value="<?php echo $userkey_oneway; ?>" size="30px">
	            <?php if ($error_userkey_oneway) { ?>
	              <span class="error"><?php echo $error_userkey_oneway; ?></span>
	              <?php } ?></td>
	          </tr>
	          <tr>
	          	<td><span class="required">*</span> <?php echo $entry_passkey; ?></td>
	            <td><input type="password" name="passkey_oneway" value="<?php echo $passkey_oneway; ?>" size="30px">
	            <?php if ($error_passkey_oneway) { ?>
	              <span class="error"><?php echo $error_passkey_oneway; ?></span>
	              <?php } ?></td>
	          </tr>
	      	</tbody>
	      	<tbody id="gateway-twoway" class="gateway">
	      		<tr>
	          	<td><span class="required">*</span> <?php echo $entry_httpapi; ?></td>
	            <td><input type="text" name="httpapi" value="<?php echo $httpapi; ?>" size="30px">
	            <?php if ($error_httpapi) { ?>
	              <span class="error"><?php echo $error_httpapi; ?></span>
	              <?php } ?></td>
	          </tr>
	          <tr>
	            <td><span class="required">*</span> <?php echo $entry_userkey; ?></td>
	            <td><input type="text" name="userkey_twoway" value="<?php echo $userkey_twoway; ?>" size="30px">
	            <?php if ($error_userkey_twoway) { ?>
	              <span class="error"><?php echo $error_userkey_twoway; ?></span>
	              <?php } ?></td>
	          </tr>
	          <tr>
	          	<td><span class="required">*</span> <?php echo $entry_passkey; ?></td>
	            <td><input type="password" name="passkey_twoway" value="<?php echo $passkey_twoway; ?>" size="30px">
	            <?php if ($error_passkey_twoway) { ?>
	              <span class="error"><?php echo $error_passkey_twoway; ?></span>
	              <?php } ?></td>
	          </tr>
	      	</tbody>
	      	<tr>
          	<td><?php echo $entry_alert_reg; ?></td>
          	<td><textarea name="message_reg" cols="47" rows="5" ><?php echo $message_reg; ?></textarea><?php echo $entry_alert_blank; ?>
            </td>
          </tr>
          <tr>
          	<td><?php echo $entry_alert_order; ?></td>
          	<td><textarea name="message_order" cols="47" rows="5" ><?php echo $message_order; ?></textarea><?php echo $entry_alert_blank; ?>
            </td>
          </tr>
          
          <tr>
          	<td><?php echo $entry_alert_sms; ?></td>
          	<td><textarea name="config_alert_sms" cols="47" rows="5" ><?php echo $config_alert_sms; ?></textarea><?php echo $entry_alert_blank; ?>
            </td>
          </tr>
          <tr>
          	<td><?php echo $entry_account_sms; ?></td>
          	<td><textarea name="config_account_sms" cols="47" rows="5" ><?php echo $config_account_sms; ?></textarea><?php echo $entry_alert_blank; ?>
            </td>
          </tr>
          <tr>
          	<td><?php echo $entry_additional_alert; ?></td>
          	<td><textarea name="message_alert" cols="47" rows="5" ><?php echo $message_alert; ?></textarea><?php echo $entry_alert_blank; ?>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript"><!--	
$('select[name=\'gateway\']').bind('change', function() {
	$('#setgate .gateway').hide();
	
	$('#setgate #gateway-' + $(this).attr('value').replace('_', '-')).show();
});

$('select[name=\'gateway\']').trigger('change');
//--></script>
<?php echo $footer; ?>