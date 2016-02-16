<?php
// Heading
$_['heading_title']    = 'Automatic Discount';

// Text
$_['text_total']       = 'Order Totals';
$_['text_success']     = 'Success: You have modified total auto discount!';
$_['text_subtotal']    = 'Subtotal';
$_['text_quantity']    = 'Quantity';

// Entry
$_['entry_rate']       = 'Rates:<br/><span class="help">(value or %)</span>';
$_['entry_status']     = 'Status:';
$_['entry_mode']       = 'Mode:<br/><span class="help">Subtotal Mode means it will calculate discount based on cart subtotal. Quantity Mode means it will be based on number of total items in the cart</span>';
$_['entry_special']    = 'Discount Special Prices:<br/><span class="help">Add discount to items already on special.</span>';
$_['entry_sort_order'] = 'Sort Order:';
$_['entry_geo_zone']   = 'Geo Zone:';

$_['help_rate']		   = '(unit:discount, unit:discount, etc). <br />Prices are based on the unit amount or lower. 100:10%, 200:20% means if the cart is less than 100, a 10% discount will apply. If the cart is between 100 and 200, the 20% will apply. If more than 200, no discount will apply unless you add a max like 999999:25%';

// Error
$_['error_permission'] = 'Warning: You do not have permission to modify total auto discount!';
?>