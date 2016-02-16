<?php
// Heading
$_['heading_title']       		= 'SMS Setting (sms-notifikasi.com)';
$_['intruction_title']    		= 'Instruction';

// Text
$_['text_module']         		= 'Modules';
$_['text_success']        		= 'Success: You have modified SMS Notifikasi module!';
$_['text_content_top']    		= 'Content Top';
$_['text_content_bottom'] 		= 'Content Bottom';
$_['text_column_left']    		= 'Column Left';
$_['text_column_right']   		= 'Column Right';
$_['text_yes']      					= 'Yes';
$_['text_no']      						= 'No';
$_['text_none']      					= '-- Select SMS Type --';
$_['text_limit']      				= 'SMS/day';
$_['text_balance']      			= 'CREDIT :';
$_['text_aktif']      				= 'Active Until :';

// Gateway
$_['entry_gateway']       		= 'SMS Type:<br /><span class="help">Select the type of SMS package who you used.</span>';

// SMS Notifikasi
$_['entry_userkey']       		= 'Userkey:<br /><span class="help">API Userkey.</span>';
$_['entry_passkey']       		= 'Passkey:<br /><span class="help">API Passkey.</span>';
$_['entry_httpapi']       		= 'Business Name:<br /><span class="help">Insert your bussiness name.</span>';
$_['httpapi_example']					= '<span class="help"><b>Use this for HTTP API-></b> http://reguler.sms-notifikasi.com/apps/smsapi.php</span>';

// Entry
$_['entry_layout']        		= 'Layout:';
$_['entry_position']      		= 'Position:';
$_['entry_status']        		= 'Status:';
$_['entry_sort_order']    		= 'Sort Order:';
$_['entry_nohp']    					= 'Mobile Number:';
$_['entry_message']    				= 'Message:';
$_['entry_smslimit']    			= 'SMS Limit:<br /><span class="help">You can limit the message who can sending of visitor for a day. Leave blank to disable limit.</span>';
$_['entry_alert_reg']   			= 'Register Message Alert:<br /><span class="help">You can insert a <b>{firstname}</b>, <b>{lastname}</b>, <b>{email}</b>, <b>{password}</b> and <b>{storename}</b> in the message.<br /><b>eg</b>: <i>Thanks for sign up {firstname} {lastname}. Your login email: {email} and password: {password}. {storename}</i></span>';
$_['entry_alert_order']   		= 'Place Order Message Alert:<br /><span class="help">You can insert a <b>{firstname}</b>, <b>{lastname}</b>, <b>{email}</b>, <b>{orderid}</b>, <b>{orderstatus}</b>, <b>{shippingmethod}</b>, <b>{paymentmethod}</b>, <b>{total}</b>, <b>{storename}</b> in the message.</span>';
$_['entry_additional_alert']	= 'Additional Alert SMS:<br /><span class="help">Any additional admin mobile number (with Country Code) you want to receive the register and order alert sms. (comma separated)</span>';
$_['entry_alert_sms']    			= 'New Order Alert (For Admin):<br /><span class="help">Send a SMS to the store owner when a new order is created.<br />You can insert a <b>{orderid}</b>, <b>{shippingmethod}</b>, <b>{paymentmethod}</b>, <b>{total}</b>, <b>{storename}</b> in the message.</span>';
$_['entry_account_sms']  			= 'New Account Alert (For Admin):<br /><span class="help">Send a SMS to the store owner when a new account is registered.You can insert a <b>{firstname}</b>, <b>{lastname}</b>, <b>{email}</b> and <b>{storename}</b> in the message.</span>';
$_['entry_alert_blank']    		= '<span class="help">Leave blank to disable this alert</span>';

// Button
$_['button_save']							= 'Save';
$_['button_cancel']						= 'Cancel';
$_['button_add_module']				= 'Add Module';
$_['button_remove']						= 'Remove';

// Error
$_['error_permission']    		= 'Warning: You do not have permission to modify SMS Notifikasi module!';
$_['error_gateway']       		= 'SMS Type required';
$_['error_userkey']       		= 'Userkey required';
$_['error_passkey']       		= 'Passkey required';
$_['error_httpapi']       		= 'Bussiness Name required';
$_['error_senderid']       		= 'Sender ID required';
$_['error_nohp']       				= 'Phone number required';
$_['error_message']       		= 'Text message required';
$_['error_gateway_null']   		= 'SMS Type is null ! Please set the type of SMS package';

// Anounce
$_['text_instruction']				= '<span class="help">You can add <b>SMS Notifikasi</b> module to enable your web visitor can Sending Message for free from your web. This can increase visitor traffic of your web.<br />Click <b>Add Module</b> button and set the configuration of module.<br/><br/><b>Layout</b>: On the page where the module will be displayed.<br/><b>Position</b>: Position of module.<br/><b>Status</b>: You can enable or disable the module.<br/><b>Sort Order</b>: Order position of the module.</span>';
?>