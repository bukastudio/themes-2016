<?php  
class ControllerModuleSmszNotification extends Controller {
	private $error = array();
	
	protected function index() {
		$this->language->load('module/smsznotification');
		
    $this->data['heading_title'] = $this->language->get('heading_title');
    
    $this->data['text_nohp'] = $this->language->get('text_nohp');
    $this->data['text_message'] = $this->language->get('text_message');
    $this->data['text_characters'] = $this->language->get('text_characters');
    $this->data['button_send'] = $this->language->get('button_send');
    $this->data['text_success'] = $this->language->get('text_success');
    
    $this->data['error_nohp'] = '';
		$this->data['error_message'] = '';
		$this->data['success'] = '';
		$this->data['error'] = '';
		$this->data['error_limit'] = '';
		
		$this->load->model('setting/setting');
    
    //if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
    if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
    	
    	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			    {
			      $ip=$_SERVER['HTTP_CLIENT_IP'];
			    }
			    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			    {
			      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			    }
			    else
			    {
			      $ip=$_SERVER['REMOTE_ADDR'];
			    }
			    
			$tgl=date('y-m-d');
    	
    	if (!$this->request->post['nohp']) {
				$this->data['error_nohp'] = $this->language->get('error_nohp');
			}else
			if (!$this->request->post['message']) {
				$this->data['error_message'] = $this->language->get('error_message');
			}else{
			  $ceklimit = $this->config->get('smslimit');
				$traceip = $this->config->get($ip);
				
				if($traceip == ""){
					$visitor_data = array(
									$ip => '1:'.$tgl
					);
					$this->model_setting_setting->editSetting('sendsmsznotification', $visitor_data);
				  $traceip = '0';
				  $tglnya = $tgl;
				} else {
			  	$traceip = $this->config->get($ip);
			  	$pecah = explode(":", $traceip);
					$traceip = $pecah[0];
					$tglnya = $pecah[1];
			  }
			  
			  if( ($ceklimit != 0 || $ceklimit != "") && $ceklimit <= $traceip && $tgl == $tglnya ){
					$this->data['error_limit'] = $this->language->get('error_limit');
				}else{
					if($tgl != $tglnya){
						$traceip = 1;
					}else{
						$traceip = $traceip+1;
					}
					
					$gateway = $this->config->get('gateway');
					// ZENZIVA
					if($gateway == "zenziva"){
						$userkey = $this->config->get('userkey');
						$passkey = $this->config->get('passkey');
						$url = $this->config->get('httpapi');
						$text = urlencode(substr($this->request->post['message'],0,150));
						$destination = $this->request->post['nohp'];
						
						$content =  $url.
					    					'?userkey='.rawurlencode($userkey).
					              '&passkey='.rawurlencode($passkey).
					              '&nohp='.rawurlencode($destination).
					              '&pesan='.htmlentities($text);
					
					  $getresponse = file_get_contents($content);
					  $xmldata = new SimpleXMLElement($getresponse);
					  $status = $xmldata->message[0]->text;
					}					
					// AMD Telecom
					elseif($gateway == "amd"){
						mb_internal_encoding("UTF-8");
	        	mb_http_output("UTF-8");
	        	
						$userkey = $this->config->get('userkey_amd');
						$passkey = $this->config->get('passkey_amd');
						$from = $this->config->get('senderid_amd');
						$url = $this->config->get('httpapi_amd');
						//$text = urlencode(substr($this->request->post['message'],0,150));
						$text = urlencode($this->request->post['message']);
						$destination = $this->request->post['nohp'];
						/*
						$destination=str_replace("+62","62",$destination);
						$tes=substr($destination,0,1);
						if($tes=="0"){
							$destination="62".substr($destination,1,strlen($destination));
						}
						*/
						//$content = 'https://api2.amdtelecom.net/?username='.$userkey.'&password='.$passkey.'&from=OC&to='.$destination.'&text='.urlencode($text);
						$content =  $url.
					    						'/?username='.rawurlencode($userkey).
					                '&password='.rawurlencode($passkey).
					                '&from='.rawurlencode($from).
					                '&to='.rawurlencode($destination).
					                '&text='.$text;
					
					   //$getresponse = file_get_contents($content);
					  $ch = curl_init();
			      curl_setopt($ch, CURLOPT_URL, $content);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						$output = curl_exec($ch);
						curl_close($ch);
						
						$pos = strpos(strtoupper($output),"SUCCESS");
					  if($pos !== false){
					    	$status = "Success";
					  } else {
						    $status = $output;
						}
					}else{
						$status = "";
					}
				  
				  if($status == "Success"){
						$this->data['success'] = $this->language->get('text_success');
						
						$this->db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $traceip.":".$tgl . "' WHERE `key` = '" . $ip . "'");
						//$this->model_setting_setting->editSetting('zenzivasms', $visitor_data);
						
					}else{
						$this->data['error'] = $this->language->get('text_error');
					}
				}
    		
    	}
    }
    
    //$this->data['action'] = $this->url->link('common/home');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/smsznotification.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/smsznotification.tpl';
		} else {
			$this->template = 'default/template/module/smsznotification.tpl';
		}
		
		$this->render();
		//$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->request->post['nohp']) {
			$this->error['nohp'] = $this->language->get('error_nohp');
		}
		
		if (!$this->request->post['message']) {
			$this->error['message'] = $this->language->get('error_message');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>