<?php
ini_set("memory_limit","256M");

	$export_html_all_details ="<html><head>";
	$export_html_all_details .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
	$export_html_all_details .="</head>";
	$export_html_all_details .="<body>";
	$export_html_all_details .="<style type='text/css'>
	.list_detail {
		border-collapse: collapse;
		width: 100%;
		border-top: 1px solid #DDDDDD;
		border-left: 1px solid #DDDDDD;
		font-family: Arial, Helvetica, sans-serif;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	.list_detail td {
		border-right: 1px solid #DDDDDD;
		border-bottom: 1px solid #DDDDDD;
	}
	.list_detail thead td {
		background-color: #F0F0F0;
		padding: 0px 3px;
		font-size: 11px;
		font-weight: bold;	
	}
	.list_detail tbody td {
		padding: 0px 3px;
		font-size: 11px;	
	}
	.list_detail .left {
		text-align: left;
		padding: 3px;
	}
	.list_detail .right {
		text-align: right;
		padding: 3px;
	}
	.list_detail .center {
		text-align: center;
		padding: 3px;
	}
	</style>";
	$export_html_all_details .="<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
	$export_html_all_details .="<tr><td>";		
	foreach ($results as $result) {	
	if ($result['product_pidc']) {	
	$export_html_all_details .="<table class='list_detail' style='border-bottom:2px solid #999; border-top:2px solid #999'>";
	$export_html_all_details .="<thead>";
	$export_html_all_details .="<tr>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_order_id')."</td>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_date_added')."</td>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$this->language->get('column_order_inv_no')."</td>";
	isset($_POST['cop43']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_customer')."</td>" : '';
	isset($_POST['cop44']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_email')."</td>" : '';
	isset($_POST['cop45']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_customer_group')."</td>" : '';
	isset($_POST['cop46']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_shipping_method')."</td>" : '';
	isset($_POST['cop47']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_payment_method')."</td>" : '';
	isset($_POST['cop48']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_status')."</td>" : '';
	isset($_POST['cop49']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_order_store')."</td>" : '';
	isset($_POST['cop50']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_currency')."</td>" : '';
	isset($_POST['cop51']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_quantity')."</td>" : '';	
	isset($_POST['cop52']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_sub_total')."</td>" : '';
	isset($_POST['cop54']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_shipping')."</td>" : '';
	isset($_POST['cop55']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_tax')."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_value')."</td>" : '';
	isset($_POST['cop53']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_sales')."</td>" : '';
	isset($_POST['cop57']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_costs')."</td>" : '';
	isset($_POST['cop58']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_order_profit')."</td>" : '';
	isset($_POST['cop59']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';	
	$export_html_all_details .="</tr>";
	$export_html_all_details .="</thead>";
	$export_html_all_details .="<tbody><tr>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_ord_idc']."</td>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_order_date']."</td>";
	$export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_inv_no']."</td>";
	isset($_POST['cop43']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_name']."</td>" : '';	
	isset($_POST['cop44']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_email']."</td>" : '';
	isset($_POST['cop45']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_group']."</td>" : '';
	isset($_POST['cop46']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_shipping_method']."</td>" : '';
	isset($_POST['cop47']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".strip_tags($result['order_payment_method'], '<br>')."</td>" : '';
	isset($_POST['cop48']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_status']."</td>" : '';
	isset($_POST['cop49']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['order_store']."</td>" : '';
	isset($_POST['cop50']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_currency']."</td>" : '';
	isset($_POST['cop51']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_products']."</td>" : '';	
	isset($_POST['cop52']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_sub_total']."</td>" : '';
	isset($_POST['cop54']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_shipping']."</td>" : '';
	isset($_POST['cop55']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_tax']."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['order_value']."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#DCFFB9;'>".$result['order_sales']."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#ffd7d7;'>-".$result['order_costs']."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee; font-weight:bold;'>".$result['order_profit']."</td>" : '';
	isset($_POST['cop56']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee; font-weight:bold;'>".$result['order_profit_margin_percent']."</td>" : '';	
	$export_html_all_details .="</tr>";	
	$export_html_all_details .="<tr>";
	$export_html_all_details .="<td colspan='3'></td><td colspan='17'>";
	$export_html_all_details .="<table class='list_detail'>";
	$export_html_all_details .="<thead>";
	$export_html_all_details .="<tr>";
	isset($_POST['cop63']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_id')."</td>" : '';
	isset($_POST['cop64']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_sku')."</td>" : '';
	isset($_POST['cop65']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_model')."</td>" : '';	
	isset($_POST['cop66']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_name')."</td>" : '';
	isset($_POST['cop67']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_option')."</td>" : '';
	isset($_POST['cop77']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_attributes')."</td>" : '';	
	isset($_POST['cop68']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_manu')."</td>" : '';	
	isset($_POST['cop79']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_prod_category')."</td>" : '';		
	isset($_POST['cop70']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_price')."</td>" : '';
	isset($_POST['cop71']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_quantity')."</td>" : '';
	isset($_POST['cop73']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_tax')."</td>" : '';		
	isset($_POST['cop72']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_total')."</td>" : '';
	isset($_POST['cop78']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_coupons')."</td>" : '';	
	isset($_POST['cop74']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_costs')."</td>" : '';	
	isset($_POST['cop75']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_prod_profit')."</td>" : '';	
	isset($_POST['cop76']) ? $export_html_all_details .= "<td align='right'>".$this->language->get('column_profit_margin')."</td>" : '';
	$export_html_all_details .="</tr>";
	$export_html_all_details .="</thead>";
	$export_html_all_details .="<tr>";
	isset($_POST['cop63']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_pidc']."</td>" : '';
	isset($_POST['cop64']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_sku']."</td>" : '';
	isset($_POST['cop65']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_model']."</td>" : '';	
	isset($_POST['cop66']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_name']."</td>" : '';
	isset($_POST['cop67']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_option']."</td>" : '';
	isset($_POST['cop77']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_attributes']."</td>" : '';
	isset($_POST['cop68']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_manu']."</td>" : '';	
	isset($_POST['cop79']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['product_category']."</td>" : '';
	isset($_POST['cop70']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['product_price']."</td>" : '';
	isset($_POST['cop71']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['product_quantity']."</td>" : '';
	isset($_POST['cop73']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap'>".$result['product_tax']."</td>" : '';	
	isset($_POST['cop72']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#DCFFB9;'>".$result['product_total']."</td>" : '';
	isset($_POST['cop78']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='color:#F00;'>".$result['product_coupon']."</td>" : '';
	isset($_POST['cop74']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#ffd7d7;'>-".$result['product_costs']."</td>" : '';
	isset($_POST['cop75']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee; font-weight:bold;'>".$result['product_profit']."</td>" : '';
	isset($_POST['cop76']) ? $export_html_all_details .= "<td align='right' nowrap='nowrap' style='background-color:#c4d9ee; font-weight:bold;'>".$result['product_profit_margin_percent']."</td>" : '';
	$export_html_all_details .="</tr>";	
	$export_html_all_details .="</table>";
	$export_html_all_details .="<table class='list_detail'>";
	$export_html_all_details .="<thead>";
	$export_html_all_details .="<tr>";
	isset($_POST['cop83']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_customer_cust_id'))."</td>" : '';
	isset($_POST['cop84']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_name'))."</td>" : '';	
	isset($_POST['cop85']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_company'))."</td>" : '';
	isset($_POST['cop86']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_address_1'))."</td>" : '';
	isset($_POST['cop87']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_address_2'))."</td>" : '';
	isset($_POST['cop88']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_city'))."</td>" : '';
	isset($_POST['cop89']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_zone'))."</td>" : '';
	isset($_POST['cop90']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_postcode'))."</td>" : '';
	isset($_POST['cop91']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_billing_country'))."</td>" : '';
	isset($_POST['cop92']) ? $export_html_all_details .= "<td align='left'>".$this->language->get('column_customer_telephone')."</td>" : '';
	isset($_POST['cop93']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_name'))."</td>" : '';
	isset($_POST['cop94']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_company'))."</td>" : '';
	isset($_POST['cop95']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_address_1'))."</td>" : '';
	isset($_POST['cop96']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_address_2'))."</td>" : '';
	isset($_POST['cop97']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_city'))."</td>" : '';
	isset($_POST['cop98']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_zone'))."</td>" : '';
	isset($_POST['cop99']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_postcode'))."</td>" : '';
	isset($_POST['cop100']) ? $export_html_all_details .= "<td align='left'>".strip_tags($this->language->get('column_shipping_country'))."</td>" : '';	
	$export_html_all_details .="</tr>";
	$export_html_all_details .="</thead>";
	$export_html_all_details .="<tr>";
	isset($_POST['cop83']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['customer_cust_idc']."</td>" : '';
	isset($_POST['cop84']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_name']."</td>" : '';
	isset($_POST['cop85']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_company']."</td>" : '';
	isset($_POST['cop86']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_address_1']."</td>" : '';
	isset($_POST['cop87']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_address_2']."</td>" : '';
	isset($_POST['cop88']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_city']."</td>" : '';
	isset($_POST['cop89']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_zone']."</td>" : '';
	isset($_POST['cop90']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_postcode']."</td>" : '';
	isset($_POST['cop91']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['billing_country']."</td>" : '';
	isset($_POST['cop92']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['customer_telephone']."</td>" : '';
	isset($_POST['cop93']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_name']."</td>" : '';
	isset($_POST['cop94']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_company']."</td>" : '';
	isset($_POST['cop95']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_address_1']."</td>" : '';
	isset($_POST['cop96']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_address_2']."</td>" : '';
	isset($_POST['cop97']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_city']."</td>" : '';
	isset($_POST['cop98']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_zone']."</td>" : '';
	isset($_POST['cop99']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_postcode']."</td>" : '';
	isset($_POST['cop100']) ? $export_html_all_details .= "<td align='left' nowrap='nowrap'>".$result['shipping_country']."</td>" : '';	
	$export_html_all_details .="</tr>";	
	$export_html_all_details .="</table>";
	$export_html_all_details .="</td></tr>";	
	$export_html_all_details .="</tbody></table>";	
	}
	}
	$export_html_all_details .="</td></tr>";	
	$export_html_all_details .="</table>";		
	$export_html_all_details .="</body></html>";

$filename = "customer_profit_report_all_details_".date("Y-m-d",time());
header('Expires: 0');
header('Cache-control: private');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Description: File Transfer');			
header('Content-Disposition: attachment; filename='.$filename.".html");
print $export_html_all_details;			
exit;		
?>