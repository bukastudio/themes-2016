<?php
class ControllerModuleSmszNotification extends Controller {
	private $error = array(); 
	
	public function index() {
		$this->language->load('module/smsznotification');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('smsznotification', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['intruction_title'] = $this->language->get('intruction_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_instruction'] = $this->language->get('text_instruction');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_limit'] = $this->language->get('text_limit');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_balance'] = $this->language->get('text_balance');
		$this->data['text_aktif'] = $this->language->get('text_aktif');
		
		$this->data['entry_gateway'] = $this->language->get('entry_gateway');
		$this->data['entry_userkey'] = $this->language->get('entry_userkey');
		$this->data['entry_passkey'] = $this->language->get('entry_passkey');
		$this->data['entry_httpapi'] = $this->language->get('entry_httpapi');
		$this->data['httpapi_example'] = $this->language->get('httpapi_example');
		
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_smslimit'] = $this->language->get('entry_smslimit');
		$this->data['entry_alert_reg'] = $this->language->get('entry_alert_reg');
		$this->data['entry_alert_blank'] = $this->language->get('entry_alert_blank');
		$this->data['entry_alert_order'] = $this->language->get('entry_alert_order');
		$this->data['entry_additional_alert'] = $this->language->get('entry_additional_alert');
		$this->data['entry_alert_sms'] = $this->language->get('entry_alert_sms');
		$this->data['entry_account_sms'] = $this->language->get('entry_account_sms');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['gateway'])) {
			$this->data['error_gateway'] = $this->error['gateway'];
		} else {
			$this->data['error_gateway'] = '';
		}
		
		// One Way Masking
		if (isset($this->error['userkey_onewaymasking'])) {
			$this->data['error_userkey_onewaymasking'] = $this->error['userkey_onewaymasking'];
		} else {
			$this->data['error_userkey_onewaymasking'] = '';
		}
		
		if (isset($this->error['passkey_onewaymasking'])) {
			$this->data['error_passkey_onewaymasking'] = $this->error['passkey_onewaymasking'];
		} else {
			$this->data['error_passkey_onewaymasking'] = '';
		}
		
		// One Way GSM
		if (isset($this->error['userkey_oneway'])) {
			$this->data['error_userkey_oneway'] = $this->error['userkey_oneway'];
		} else {
			$this->data['error_userkey_oneway'] = '';
		}
		
		if (isset($this->error['passkey_oneway'])) {
			$this->data['error_passkey_oneway'] = $this->error['passkey_oneway'];
		} else {
			$this->data['error_passkey_oneway'] = '';
		}
		
		// Two Way
		if (isset($this->error['userkey_twoway'])) {
			$this->data['error_userkey_twoway'] = $this->error['userkey_twoway'];
		} else {
			$this->data['error_userkey_twoway'] = '';
		}
		
		if (isset($this->error['passkey_twoway'])) {
			$this->data['error_passkey_twoway'] = $this->error['passkey_twoway'];
		} else {
			$this->data['error_passkey_twoway'] = '';
		}
		
		if (isset($this->error['httpapi'])) {
			$this->data['error_httpapi'] = $this->error['httpapi'];
		} else {
			$this->data['error_httpapi'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/smsznotification', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/smsznotification', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['gateway'])) {
			$this->data['gateway'] = $this->request->post['gateway'];
		} else {
			$this->data['gateway'] = $this->config->get('gateway');
		}
		
		if (isset($this->request->post['smslimit'])) {
			$this->data['smslimit'] = $this->request->post['smslimit'];
		} else {
			$this->data['smslimit'] = $this->config->get('smslimit');
		}
		
		if (isset($this->request->post['message_order'])) {
			$this->data['message_order'] = $this->request->post['message_order'];
		} else {
			$this->data['message_order'] = $this->config->get('message_order');
		}
		
		if (isset($this->request->post['message_reg'])) {
			$this->data['message_reg'] = $this->request->post['message_reg'];
		} else {
			$this->data['message_reg'] = $this->config->get('message_reg');
		}
		
		if (isset($this->request->post['message_alert'])) {
			$this->data['message_alert'] = $this->request->post['message_alert'];
		} else {
			$this->data['message_alert'] = $this->config->get('message_alert');
		}
		
		if (isset($this->request->post['config_alert_sms'])) {
			$this->data['config_alert_sms'] = $this->request->post['config_alert_sms'];
		} else {
			$this->data['config_alert_sms'] = $this->config->get('config_alert_sms');
		}
		
		if (isset($this->request->post['config_account_sms'])) {
			$this->data['config_account_sms'] = $this->request->post['config_account_sms'];
		} else {
			$this->data['config_account_sms'] = $this->config->get('config_account_sms');
		}
		
		// One Way Masking
		if (isset($this->request->post['userkey_onewaymasking'])) {
			$this->data['userkey_onewaymasking'] = $this->request->post['userkey_onewaymasking'];
		} else {
			$this->data['userkey_onewaymasking'] = $this->config->get('userkey_onewaymasking');
		}
		
		if (isset($this->request->post['passkey_onewaymasking'])) {
			$this->data['passkey_onewaymasking'] = $this->request->post['passkey_onewaymasking'];
		} else {
			$this->data['passkey_onewaymasking'] = $this->config->get('passkey_onewaymasking');
		}
		
		// ---
		
		// One Way GSM
		if (isset($this->request->post['userkey_oneway'])) {
			$this->data['userkey_oneway'] = $this->request->post['userkey_oneway'];
		} else {
			$this->data['userkey_oneway'] = $this->config->get('userkey_oneway');
		}
		
		if (isset($this->request->post['passkey_oneway'])) {
			$this->data['passkey_oneway'] = $this->request->post['passkey_oneway'];
		} else {
			$this->data['passkey_oneway'] = $this->config->get('passkey_oneway');
		}
		
		// ---
		
		// Two Way
		if (isset($this->request->post['userkey_twoway'])) {
			$this->data['userkey_twoway'] = $this->request->post['userkey_twoway'];
		} else {
			$this->data['userkey_twoway'] = $this->config->get('userkey_twoway');
		}
		
		if (isset($this->request->post['passkey_twoway'])) {
			$this->data['passkey_twoway'] = $this->request->post['passkey_twoway'];
		} else {
			$this->data['passkey_twoway'] = $this->config->get('passkey_twoway');
		}
		
		if (isset($this->request->post['httpapi'])) {
			$this->data['httpapi'] = $this->request->post['httpapi'];
		} else {
			$this->data['httpapi'] = $this->config->get('httpapi');
		}
				
		// ---
		
		$defaultgateway = $this->config->get('gateway');
		if($defaultgateway){
			$this->load->model('libraries/smsznotification');
			$balance = explode(",",$this->model_libraries_smsznotification->get_balance($defaultgateway));
			
			$this->data['balance'] = $balance[0];
			$this->data['aktif'] = $balance[1];
		}else{
			$this->data['balance'] = "";
			$this->data['aktif'] = "";
		}

		$this->data['modules'] = array();
		
		if (isset($this->request->post['smsznotification_module'])) {
			$this->data['modules'] = $this->request->post['smsznotification_module'];
		} elseif ($this->config->get('smsznotification_module')) { 
			$this->data['modules'] = $this->config->get('smsznotification_module');
		}	
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
						
		$this->template = 'module/smsznotification.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/smsznotification')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['gateway']) {
			$this->error['gateway'] = $this->language->get('error_gateway');
		} else {
			
			if($this->request->post['gateway'] == "onewaymasking"){				
				// One Way Masking
				if (!$this->request->post['userkey_onewaymasking']) {
					$this->error['userkey_onewaymasking'] = $this->language->get('error_userkey');
				}
				
				if (!$this->request->post['passkey_onewaymasking']) {
					$this->error['passkey_onewaymasking'] = $this->language->get('error_passkey');
				}
			}
			
			if($this->request->post['gateway'] == "oneway"){
				// One Way GSM
				if (!$this->request->post['userkey_oneway']) {
					$this->error['userkey_oneway'] = $this->language->get('error_userkey');
				}
				
				if (!$this->request->post['passkey_oneway']) {
					$this->error['passkey_oneway'] = $this->language->get('error_passkey');
				}
			}
			
			if($this->request->post['gateway'] == "twoway"){
				// Two Way
				if (!$this->request->post['userkey_twoway']) {
					$this->error['userkey_twoway'] = $this->language->get('error_userkey');
				}
				
				if (!$this->request->post['passkey_twoway']) {
					$this->error['passkey_twoway'] = $this->language->get('error_passkey');
				}
				
				if (!$this->request->post['httpapi']) {
					$this->error['httpapi'] = $this->language->get('error_httpapi');
				}
			}
			
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>