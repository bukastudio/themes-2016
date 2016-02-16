<?php

require_once(dirname(__FILE__) . '/../Veritrans.php');

Veritrans_Config::$serverKey = '<your server key>';

$notif = new Veritrans_Notification();

$transaction = $notif->transaction_status;
$fraud = $notif->fraud_status;

error_log("Order ID $notif->order_id: " .
  "transaction status = $transaction, fraud staus = $fraud");

if ($transaction == 'capture') {
	if ($fraud == 'challenge') {
	  // Todo-note Set payment status in merchant's database to 'challenge'
	}
	else if ($fraud == 'accept') {
	  // Todo-note Set payment status in merchant's database to 'success'
	}
}
else if ($transaction == 'cancel') {
	if ($fraud == 'challenge') {
	  // Todo-note Set payment status in merchant's database to 'failure'
	}
	else if ($fraud == 'accept') {
	  // Todo-note Set payment status in merchant's database to 'failure'
	}
}
else if ($transaction == 'deny') {
  // Todo-note Set payment status in merchant's database to 'failure'
}

?>