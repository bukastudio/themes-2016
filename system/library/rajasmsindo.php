<?php
class sms {
	protected $to;
	protected $text;
	public $key;
	public $username;
	public $phone;
	public $password;
	public $smsmode;
	public $modem;

	public function setTo($to) {
		$this->to = $to;
	}
	public function setText($text) {
		$this->text = $text;
	}
	public function send() {
		if (!$this->to) {
			trigger_error('Error: Phone to required!');
			exit();			
		}

		if (!$this->text)  {
			trigger_error('Error: Text Message required!');
			exit();					
		}
		$nohp  = $this->to;
		$pesan = urlencode($this->text); 
		if ($this->smsmode==0) { //reguler  		
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smsreguler.php?username=".$this->username."&password=".$this->password."&key=".$this->key."&number=".$nohp."&message=".$pesan;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);	
		} elseif ($this->smsmode==1) { //private  
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smsprivate.php?username=".$this->username."&password=".$this->password."&key=".$this->key."&number=".$nohp."&message=".$pesan."&modem=".$this->modem;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);			
		} elseif ($this->smsmode==2) { //masking
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smsmasking.php?username=".$this->username."&password=".$this->password."&key=".$this->key."&number=".$nohp."&message=".$pesan;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);	
		}
		return $hasil;
	}
	public function saldo() {
		if ($this->smsmode==0) { //reguler  
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smssaldo.php?username=".$this->username."&password=".$this->password."&key=".$this->key;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);			
		} elseif ($this->smsmode==1) { //private
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smspulsaprivate.php?username=".$this->username."&password=".$this->password."&key=".$this->key."&modem=".$this->modem;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);				
		} elseif ($this->smsmode==2) { //masking
			$curlHandle = curl_init();
			$url="http://162.211.84.203/sms/smssaldo.php?username=".$this->username."&password=".$this->password."&key=".$this->key;
			curl_setopt($curlHandle, CURLOPT_URL,$url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
			$hasil = curl_exec($curlHandle);
			curl_close($curlHandle);				
		}
		return $hasil;
	}	
}
?>