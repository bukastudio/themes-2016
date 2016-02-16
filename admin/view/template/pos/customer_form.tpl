<!DOCTYPE html>
<html>
    <head>
        <title>POS</title>
        <link rel="stylesheet" href="view/stylesheet/pos/style.css">
        <link rel="stylesheet" href="view/stylesheet/pos/iconFont.css">
        <link rel="stylesheet" href="view/stylesheet/pos/metro-bootstrap.css">
        <link rel="stylesheet" href="view/stylesheet/pos/themes/ui-lightness/jquery-ui-1.8.16.custom.css">
        <script type="text/javascript" src="view/javascript/pos/jquery.min.js"></script>
        <script type="text/javascript" src="view/javascript/pos/jquery-ui-1.8.16.custom.min.js"></script>

        <!-- Dialog -->        
        <script type="text/javascript" src="view/javascript/pos/metro/metro.min.js"></script>

    </head>
    <body class="metro">
        <div class="container">    
            <div class="grid">
                <div class="">
                    <div class="span9">
                        <?php if ($error_warning) { ?>
                        <div class="alert alert-warning">
                            <?php echo $error_warning; ?>
                        </div>
                        <?php } ?>
                        
                        <?php if($msg){ ?>
                        <div class="alert alert-success">
                            <?= $msg ?>
                        </div>
                        <?php } ?>
                        
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

                            <div class="box">
                                <div class="box-heading">
                                    <h2 class="box-title place-left">
                                        &nbsp;Add New Customer
                                    </h2>
                                    <div class="buttons place-right box-tools">
                                        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>                                        
                                    </div>
                                    <div class="clear"></div>
                                    <hr style="margin:5px 0 15px;">
                                </div>
                                <div class="box-content">

                                    <div data-role="tab-control" class="tab-control">
                                        <ul id="vtabs" class="tabs">
                                            <li class="active"><a href="#tab-customer"><?php echo $tab_general; ?></a></li>
                                            <?php $address_row = 1; ?>
                                            <?php foreach ($addresses as $address) { ?>
                                            <li>
                                                <a href="#tab-address-<?php echo $address_row; ?>" id="address-<?php echo $address_row; ?>"><?php echo $tab_address . ' ' . $address_row; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('#vtabs a:first').trigger('click'); $('#address-<?php echo $address_row; ?>').remove(); $('#tab-address-<?php echo $address_row; ?>').remove(); return false;" /></a>
                                            </li>    
                                            <?php $address_row++; ?>
                                            <?php } ?>
                                            <li>
                                                <span id="address-add" onclick="addAddress();"><?php echo $button_add_address; ?>&nbsp;
                                                    <img src="view/image/add.png" alt="" />
                                                </span>
                                            </li>    
                                        </ul>

                                        <div class="frames">                                                    
                                            <div id="tab-customer" class="vtabs-content frame">
                                                <fieldset>
                                                    <label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                                                        <?php if ($error_firstname) { ?>
                                                        <span class="error"><?php echo $error_firstname; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                                                        <?php if ($error_lastname) { ?>
                                                        <span class="error"><?php echo $error_lastname; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_email; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="email" value="<?php echo $email; ?>" />
                                                        <?php if ($error_email) { ?>
                                                        <span class="error"><?php echo $error_email; ?></span>
                                                        <?php  } ?>
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_telephone; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                                                        <?php if ($error_telephone) { ?>
                                                        <span class="error"><?php echo $error_telephone; ?></span>
                                                        <?php  } ?>
                                                    </div>

                                                    <label><?php echo $entry_fax; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="fax" value="<?php echo $fax; ?>" />
                                                    </div>                                                

                                                    <label><?php echo $entry_password; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="password" name="password" value="<?php echo $password; ?>"  />
                                                        <?php if ($error_password) { ?>
                                                        <span class="error"><?php echo $error_password; ?></span>
                                                        <?php  } ?>
                                                    </div>

                                                    <label><?php echo $entry_confirm; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="password" name="confirm" value="<?php echo $confirm; ?>" />
                                                        <?php if ($error_confirm) { ?>
                                                        <span class="error"><?php echo $error_confirm; ?></span>
                                                        <?php  } ?>
                                                    </div>

                                                    <label><?php echo $entry_newsletter; ?></label>
                                                    <div data-role="input-control" class="css3-metro-dropdown">
                                                        <select name="newsletter">
                                                            <?php if ($newsletter) { ?>
                                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                            <option value="0"><?php echo $text_disabled; ?></option>
                                                            <?php } else { ?>
                                                            <option value="1"><?php echo $text_enabled; ?></option>
                                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <label><?php echo $entry_customer_group; ?></label>
                                                    <div data-role="input-control" class="css3-metro-dropdown">
                                                        <select name="customer_group_id">
                                                            <?php foreach ($customer_groups as $customer_group) { ?>
                                                            <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                                                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                                                            <?php } else { ?>
                                                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <label><?php echo $entry_status; ?></label>
                                                    <div data-role="input-control" class="css3-metro-dropdown">
                                                        <select name="status">
                                                            <?php if ($status) { ?>
                                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                            <option value="0"><?php echo $text_disabled; ?></option>
                                                            <?php } else { ?>
                                                            <option value="1"><?php echo $text_enabled; ?></option>
                                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                
                                                </fieldset>                                              
                                            </div>
                                            <?php $address_row = 1; ?>
                                            <?php foreach ($addresses as $address) { ?>                                            
                                            <div id="tab-address-<?php echo $address_row; ?>" class="vtabs-content frame">
                                                <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>" />

                                                <fieldset class="form">
                                                    <label><span class="required">*</span> <?php echo $entry_firstname; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo $address['firstname']; ?>" />
                                                        <?php if (isset($error_address_firstname[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_firstname[$address_row]; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_lastname; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo $address['lastname']; ?>" />
                                                        <?php if (isset($error_address_lastname[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_lastname[$address_row]; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><?php echo $entry_company; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo $address['company']; ?>" />
                                                    </div>

                                                    <label><?php echo $entry_company_id; ?></label>
                                                    <div data-role="input-control" class="input-control text">
                                                        <input type="text" name="address[<?php echo $address_row; ?>][company_id]" value="<?php echo $address['company_id']; ?>" />
                                                    </div>

                                                    <label><?php echo $entry_tax_id; ?></label>
                                                    <div data-role="input-control" class="input-control text">   
                                                        <input type="text" name="address[<?php echo $address_row; ?>][tax_id]" value="<?php echo $address['tax_id']; ?>" />
                                                        <?php if (isset($error_address_tax_id[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_tax_id[$address_row]; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_address_1; ?></label>
                                                    <div data-role="input-control" class="input-control text">   
                                                        <input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo $address['address_1']; ?>" />
                                                        <?php if (isset($error_address_address_1[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_address_1[$address_row]; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><?php echo $entry_address_2; ?></label>
                                                    <div data-role="input-control" class="input-control text">   
                                                        <input type="text" name="address[<?php echo $address_row; ?>][address_2]" value="<?php echo $address['address_2']; ?>" />
                                                    </div>

                                                    <label><span class="required">*</span> <?php echo $entry_city; ?></label>
                                                    <div data-role="input-control" class="input-control text">   
                                                        <input type="text" name="address[<?php echo $address_row; ?>][city]" value="<?php echo $address['city']; ?>" />
                                                        <?php if (isset($error_address_city[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_city[$address_row]; ?></span>
                                                        <?php } ?>
                                                    </div>

                                                    <label><span id="postcode-required<?php echo $address_row; ?>" class="required">*</span> <?php echo $entry_postcode; ?></label>
                                                    <div data-role="input-control" class="input-control text">   
                                                        <input type="text" name="address[<?php echo $address_row; ?>][postcode]" value="<?php echo $address['postcode']; ?>" />
                                                    </div>

                                                    <div>
                                                    <label><span class="required">*</span> <?php echo $entry_country; ?></label>
                                                    <div style="margin-bottom: 9px;" class="css3-metro-dropdown" data-role="input-control">
                                                        <select name="address[<?php echo $address_row; ?>][country_id]" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo $address['zone_id']; ?>');">
                                                            <option value=""><?php echo $text_select; ?></option>
                                                            <?php foreach ($countries as $country) { ?>
                                                            <?php if ($country['country_id'] == $address['country_id']) { ?>
                                                            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                                            <?php } else { ?>
                                                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </select>                                                        
                                                    </div>
                                                    <?php if (isset($error_address_country[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_country[$address_row]; ?></span>
                                                    <?php } ?>
                                                    </div>    

                                                    <div>
                                                    <label><span class="required">*</span> <?php echo $entry_zone; ?></label>
                                                    <div style="margin-bottom: 9px;" class="css3-metro-dropdown" data-role="input-control">
                                                        <select name="address[<?php echo $address_row; ?>][zone_id]">
                                                        </select>                                                        
                                                    </div>
                                                    <?php if (isset($error_address_zone[$address_row])) { ?>
                                                        <span class="error"><?php echo $error_address_zone[$address_row]; ?></span>
                                                    <?php } ?>
                                                    </div>
                                                    
                                                    <div>
                                                        <div data-role="input-control" class="input-control radio default-style">
                                                            <label>
                                                                <?php if (($address['address_id'] == $address_id) || !$addresses) { ?>
                                                                <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" checked="checked" /></td>
                                                                <?php } else { ?>
                                                                <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" />
                                                                <?php } ?>
                                                                <span class="check"></span>
                                                                <?php echo $entry_default; ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                </fieldset>
                                            </div>
                                            <?php $address_row++; ?>
                                            <?php } ?>
                                        </div>
                                    </div>    
                                </div>
                            </div><!-- END .box -->
                        </form><!-- END .form -->
                    </div><!-- END .span9 -->
                </div><!-- END .row -->
            </div><!-- END .grid -->
        </div><!-- END .container -->        
    </body>
</html>

<script type="text/javascript"><!--
$('select[name=\'customer_group_id\']').live('change', function() {
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('.company-id-display').show();
		} else {
			$('.company-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('.tax-id-display').show();
		} else {
			$('.tax-id-display').hide();
		}
	}
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--
function country(element, index, zone_id) {
  if (element.value != '') {
		$.ajax({
			url: 'index.php?route=pos/customer/country&token=<?php echo $token; ?>&country_id=' + element.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'address[' + index + '][country_id]\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},			
			success: function(json) {
				if (json['postcode_required'] == '1') {
					$('#postcode-required' + index).show();
				} else {
					$('#postcode-required' + index).hide();
				}
				
				html = '<option value=""><?php echo $text_select; ?></option>';
				
				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';
						
						if (json['zone'][i]['zone_id'] == zone_id) {
							html += ' selected="selected"';
						}
		
						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0"><?php echo $text_none; ?></option>';
				}
				
				$('select[name=\'address[' + index + '][zone_id]\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('select[name$=\'[country_id]\']').trigger('change');

//--></script> 
<script type="text/javascript"><!--
var address_row = <?php echo $address_row; ?>;

function addAddress() {	
    html  = '<div id="tab-address-' + address_row + '" class="vtabs-content frame" style="display: none;">';
    html += '  <input type="hidden" name="address[' + address_row + '][address_id]" value="" />';

    html += '<fieldset class="form">';
    html += '<label><span class="required">*</span> <?php echo $entry_firstname; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';
    html += '<input type="text" name="address[' + address_row + '][firstname]" value="" />';
    html += '</div>';

    html += '<label><span class="required">*</span> <?php echo $entry_lastname; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][lastname]" value="" />';
    html += '</div>';
    
    html += '<label><?php echo $entry_company; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][company]" value="" />';
    html += '</div>';	
    
    html += '<label class="company-id-display"><?php echo $entry_company_id; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][company_id]" value="" />';
    html += '</div>';
    
    html += '<label class="tax-id-display"><?php echo $entry_tax_id; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][tax_id]" value="" /></label>';
    html += '</div>';			
    
    html += '<label<span class="required">*</span> <?php echo $entry_address_1; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][address_1]" value="" />';
    html += '</div>';
    
    html += '<label><?php echo $entry_address_2; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][address_2]" value="" />';
    html += '</div>';
    
    html += '<label><span class="required">*</span> <?php echo $entry_city; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][city]" value="" />';
    html += '</div>';
    
    html += '<label><span id="postcode-required' + address_row + '" class="required">*</span> <?php echo $entry_postcode; ?></label>';
    html += '<div data-role="input-control" class="input-control text">';        
    html += '<input type="text" name="address[' + address_row + '][postcode]" value="" />';
    html += '</div>';
    
    html += '<label><span class="required">*</span> <?php echo $entry_country; ?></label>';
    html += '<div style="margin-bottom: 9px;" class="css3-metro-dropdown" data-role="input-control">';
    html += '<select name="address[' + address_row + '][country_id]" onchange="country(this, \'' + address_row + '\', \'0\');">';
    html += '         <option value=""><?php echo $text_select; ?></option>';
    <?php foreach ($countries as $country) { ?>
    html += '         <option value="<?php echo $country['country_id']; ?>"><?php echo addslashes($country['name']); ?></option>';
    <?php } ?>
    html += '</select>';
    html += '</div>';
    
    html += '<label><span class="required">*</span> <?php echo $entry_zone; ?></label>';
    html += '<div style="margin-bottom: 9px;" class="css3-metro-dropdown" data-role="input-control">';
    html += '<select name="address[' + address_row + '][zone_id]"><option value="false"><?php echo $this->language->get('text_none'); ?></option></select>';
    html += '</div>';
    
    html += '<div>';
    html += '<div data-role="input-control" class="input-control radio default-style">';
    html += '<label>';
    html += '<input type="radio" value="1" name="address[' + address_row + '][default]">';
    html += '<span class="check"></span>';
    html += '<?php echo $entry_default; ?>';
    html += '</label>';
    html += '</div>';
    html += '</div>';

    html += '</fieldset>';
    html += '</div>';
	
    $('.frames').append(html);

    $('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');	

    $('#address-add').parents('li').before('<li><a href="#tab-address-' + address_row + '" id="address-' + address_row + '"><?php echo $tab_address; ?> ' + address_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#vtabs a:first\').trigger(\'click\'); $(\'#address-' + address_row + '\').remove(); $(\'#tab-address-' + address_row + '\').remove(); return false;" /></a></li>');

    $('.vtabs a').tabs();

    $('#address-' + address_row).trigger('click');

    address_row++;
}
//--></script> 

<script type="text/javascript"><!--
$('.htabs a').tabs();
$('.vtabs a').tabs();
//--></script> 

<style>
    html, body{
        background: white;
    }
    #address-add {
      cursor: pointer;
      padding: 0 8px;
      position: relative;
      top: 7px;
    }
    .box-tools a {
      margin-left: 10px !important;
    }
    .box-tools {
      line-height: 100%;
      position: relative;
      top: 10px;
    }
</style>