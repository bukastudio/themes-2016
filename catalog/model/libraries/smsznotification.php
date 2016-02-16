<?php 
class ModelLibrariesSmszNotification extends Model {
	public function send_message($destination, $message, $gateway) {
		$this->language->load('module/smsznotification');
		
		if( $gateway == "onewaymasking" ){
			$userkey = $this->config->get('userkey_onewaymasking');
			$passkey = $this->config->get('passkey_onewaymasking');
			$url = "http://masking.sms-notifikasi.com/apps/smsapi.php";
			mb_internal_encoding("UTF-8");
	    mb_http_output("UTF-8");
			$text = urlencode($message);			
			$content =  'userkey='.rawurlencode($userkey).
					          '&passkey='.rawurlencode($passkey).
					          '&nohp='.rawurlencode($destination).
					          '&pesan='.htmlentities($text);
					
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$getresponse = curl_exec($ch);
			curl_close($ch);
			$xmldata = new SimpleXMLElement($getresponse);
			$status = $xmldata->message[0]->text;
		}elseif( $gateway == "oneway" ){
			$userkey = $this->config->get('userkey_oneway');
			$passkey = $this->config->get('passkey_oneway');
			$url = "http://reguler.sms-notifikasi.com/apps/smsapi.php";
			mb_internal_encoding("UTF-8");
	    mb_http_output("UTF-8");
			$text = urlencode($message);			
			$content =  'userkey='.rawurlencode($userkey).
					          '&passkey='.rawurlencode($passkey).
					          '&nohp='.rawurlencode($destination).
					          '&pesan='.htmlentities($text);
					
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$getresponse = curl_exec($ch);
			curl_close($ch);
			$xmldata = new SimpleXMLElement($getresponse);
			$status = $xmldata->message[0]->text;
		}elseif( $gateway == "twoway" ){
			$userkey = $this->config->get('userkey_twoway');
			$passkey = $this->config->get('passkey_twoway');
			$url = "http://".$this->config->get('httpapi').".sms-notifikasi.com/apps/smsapi.php";
			mb_internal_encoding("UTF-8");
	    mb_http_output("UTF-8");
			$text = urlencode($message);			
			$content =  'userkey='.rawurlencode($userkey).
					          '&passkey='.rawurlencode($passkey).
					          '&nohp='.rawurlencode($destination).
					          '&tipe=reguler'.
					          '&pesan='.htmlentities($text);
					
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$getresponse = curl_exec($ch);
			curl_close($ch);
			$xmldata = new SimpleXMLElement($getresponse);
			$status = $xmldata->message[0]->text;
		}else{
			$status = $this->language->get('error_gateway_null');
		}
		
		return $status;
	}
	
}
?>