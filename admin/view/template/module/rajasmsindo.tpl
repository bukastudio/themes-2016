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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<table class="form">
		  <tr>
			  <td><span class="required">*</span> <?php echo $entry_smsmode; ?></td>
              <td class="left"><select name="rajasmsindo_smsmode" id="rajasmsindo_smsmode">
                  <?php if ($rajasmsindo_smsmode==0) { ?>
                  <option value="0" selected="selected"><?php echo "SMS Reguler"; ?></option>
                  <option value="1"><?php echo "SMS Private"; ?></option>
				  <option value="2"><?php echo "SMS Masking"; ?></option>
                  <?php } elseif ($rajasmsindo_smsmode==1){ ?>
                  <option value="0"><?php echo "SMS Reguler"; ?></option>
                  <option value="1" selected="selected"> <?php echo "SMS Private"; ?></option>
				  <option value="2"><?php echo "SMS Masking"; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo "SMS Reguler"; ?></option>
                  <option value="1"><?php echo "SMS Private"; ?></option>
				  <option value="2" selected="selected"><?php echo "SMS Masking"; ?></option>				  
                  <?php } ?>
                </select></td>		
          </tr>		  		
		<tr>
            <td><span class="required"></span> <?php echo $entry_saldo; ?></td>
			<td><input type="textbox" name="rajasmsindo_saldo" size="50" value=<?php echo $rajasmsindo_saldo; ?> ></td>
          </tr>		  
          <tr>
            <td><span class="required">*</span> <?php echo $entry_key; ?></td>
			<td><input type="textbox" name="rajasmsindo_key" size="50" value=<?php echo $rajasmsindo_key; ?> >
              <?php if ($error_key) { ?>
              <span class="error"><?php echo $error_key; ?></span>
              <?php } ?></td>
          </tr>
		  <tr id="contentmodem">
            <td><span class="required">*</span> <?php echo $entry_modem; ?></td>
			<td><input type="textbox" name="rajasmsindo_modem" size="20" value=<?php echo $rajasmsindo_modem; ?> >
              <?php if ($error_modem) { ?>
              <span class="error"><?php echo $error_modem; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_smsphone; ?></td>
			<td><input type="textbox" name="rajasmsindo_smsphone" size="20" value=<?php echo $rajasmsindo_smsphone; ?> >
              <?php if ($error_smsphone) { ?>
              <span class="error"><?php echo $error_smsphone; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required"></span> <?php echo $entry_user; ?></td>
			<td><input type="textbox" name="rajasmsindo_user" size="20" value=<?php echo $rajasmsindo_user; ?> ></td>
          </tr>
          <tr>
            <td><span class="required"></span> <?php echo $entry_password; ?></td>
			<td><input type="textbox" name="rajasmsindo_password" size="20" value=<?php echo $rajasmsindo_password; ?> ></td>
          </tr>		  
          <tr>
            <td><span class="required"></span> <?php echo $entry_adminnumber; ?></td>
			<td><input type="textbox" name="rajasmsindo_adminnumber" size="50" value=<?php echo $rajasmsindo_adminnumber; ?> ></td>
          </tr>		  
		  <tr>
		    <td><span class="required"></span> <?php echo $entry_defaultsms; ?></td>
		    <td><select name="rajasmsindo_defaultsms">
                  <?php if ($rajasmsindo_defaultsms) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
             </select></td>
          </tr>		  		  		  
		  <tr>
		    <td><span class="required"></span> <?php echo $entry_ordersms; ?></td>
		    <td><select name="rajasmsindo_ordersms">
                  <?php if ($rajasmsindo_ordersms) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
             </select></td>
          </tr>		  		  		  
		  <tr>
		    <td><span class="required"></span> <?php echo $entry_statussms; ?></td>
		    <td><select name="rajasmsindo_statussms">
                  <?php if ($rajasmsindo_statussms) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
             </select></td>
          </tr>		  			  
		<tr>
		    <td><span class="required"></span> <?php echo $entry_smsprovider; ?></td>
		    <td><a href="http://raja-sms.com" target="_blank"><IMG SRC="view/image/rajasmsindo.jpg" ALT="Raja-Sms.Com"></a></td>
          </tr>		  		  
		  </table>	  
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$(document).ready(function() {$('#rajasmsindo_smsmode').change();});
$('#rajasmsindo_smsmode').live('change', function() {
if($(this).val()==1){$('#contentmodem').show();}else{$('#contentmodem').hide();}
});
//--></script>
<?php echo $footer; ?>