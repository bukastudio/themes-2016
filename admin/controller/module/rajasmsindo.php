<?php
class ControllerModulerajasmsindo extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/rajasmsindo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('rajasmsindo', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['button_testsms'] = $this->language->get('button_testsms');

		$this->data['entry_smsphone'] = $this->language->get('entry_smsphone');
		$this->data['entry_saldo'] = $this->language->get('entry_saldo');
		$this->data['entry_key'] = $this->language->get('entry_key');
		$this->data['entry_key_info'] = $this->language->get('entry_key_info');
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_password'] = $this->language->get('entry_password');
		$this->data['entry_smsmode'] = $this->language->get('entry_smsmode');
		$this->data['entry_adminnumber'] = $this->language->get('entry_adminnumber');
		$this->data['entry_defaultsms'] = $this->language->get('entry_defaultsms');
		$this->data['entry_ordersms'] = $this->language->get('entry_ordersms');
		$this->data['entry_statussms'] = $this->language->get('entry_statussms');
		$this->data['entry_smsprovider'] = $this->language->get('entry_smsprovider');
		$this->data['entry_modem'] = $this->language->get('entry_modem');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['smsphone'])) {
			$this->data['error_smsphone'] = $this->error['smsphone'];
		} else {
			$this->data['error_smsphone'] = '';
		}
		
		if (isset($this->error['modem'])) {
			$this->data['error_modem'] = $this->error['modem'];
		} else {
			$this->data['error_modem'] = '';
		}
		
		if (isset($this->error['key'])) {
			$this->data['error_key'] = $this->error['key'];
		} else {
			$this->data['error_key'] = '';
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
			'href'      => $this->url->link('module/rajasmsindo', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/rajasmsindo', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['rajasmsindo_smsmode'])) {
			$this->data['rajasmsindo_smsmode'] = $this->request->post['rajasmsindo_smsmode'];
		} else {
			$this->data['rajasmsindo_smsmode'] = $this->config->get('rajasmsindo_smsmode');
		}	
		if (isset($this->request->post['rajasmsindo_key'])) {
			$this->data['rajasmsindo_key'] = $this->request->post['rajasmsindo_key'];
		} else {
			$this->data['rajasmsindo_key'] = $this->config->get('rajasmsindo_key');
		}
		if (isset($this->request->post['rajasmsindo_modem'])) {
			$this->data['rajasmsindo_modem'] = $this->request->post['rajasmsindo_modem'];
		} else {
			$this->data['rajasmsindo_modem'] = $this->config->get('rajasmsindo_modem');
		}		
		if (isset($this->request->post['rajasmsindo_smsphone'])) {
			$this->data['rajasmsindo_smsphone'] = $this->request->post['rajasmsindo_smsphone'];
		} else {
			$this->data['rajasmsindo_smsphone'] = $this->config->get('rajasmsindo_smsphone');
		}			
		if (isset($this->request->post['rajasmsindo_user'])) {
			$this->data['rajasmsindo_user'] = $this->request->post['rajasmsindo_user'];
		} else {
			$this->data['rajasmsindo_user'] = $this->config->get('rajasmsindo_user');
		}	
		if (isset($this->request->post['rajasmsindo_password'])) {
			$this->data['rajasmsindo_password'] = $this->request->post['rajasmsindo_password'];
		} else {
			$this->data['rajasmsindo_password'] = $this->config->get('rajasmsindo_password');
		}	
		if (isset($this->request->post['rajasmsindo_adminnumber'])) {
			$this->data['rajasmsindo_adminnumber'] = $this->request->post['rajasmsindo_adminnumber'];
		} else {
			$this->data['rajasmsindo_adminnumber'] = $this->config->get('rajasmsindo_adminnumber');
		}	
		if (isset($this->request->post['rajasmsindo_defaultsms'])) {
			$this->data['rajasmsindo_defaultsms'] = $this->request->post['rajasmsindo_defaultsms'];
		} else {
			$this->data['rajasmsindo_defaultsms'] = $this->config->get('rajasmsindo_defaultsms');
		}	
		if (isset($this->request->post['rajasmsindo_ordersms'])) {
			$this->data['rajasmsindo_ordersms'] = $this->request->post['rajasmsindo_ordersms'];
		} else {
			$this->data['rajasmsindo_ordersms'] = $this->config->get('rajasmsindo_ordersms');
		}	
		if (isset($this->request->post['rajasmsindo_statussms'])) {
			$this->data['rajasmsindo_statussms'] = $this->request->post['rajasmsindo_statussms'];
		} else {
			$this->data['rajasmsindo_statussms'] = $this->config->get('rajasmsindo_statussms');
		}	
		// sms 
		$sms = new sms();
		$sms->key = $this->data['rajasmsindo_key'];
		$sms->phone = $this->data['rajasmsindo_smsphone'];			
		$sms->username = $this->data['rajasmsindo_user'];
		$sms->password = $this->data['rajasmsindo_password'];
		$sms->smsmode = $this->data['rajasmsindo_smsmode'];	
		$sms->modem = $this->data['rajasmsindo_modem'];			
		$this->data['rajasmsindo_saldo'] = $sms->saldo();
		// sms 
		$this->data['modules'] = array();		
		if (isset($this->request->post['rajasmsindo_module'])) {
			$this->data['modules'] = $this->request->post['rajasmsindo_module'];
		} elseif ($this->config->get('rajasmsindo_module')) { 
			$this->data['modules'] = $this->config->get('rajasmsindo_module');
		}		
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/rajasmsindo.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/rajasmsindo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['rajasmsindo_key']) {
			$this->error['key'] = $this->language->get('error_key');
		}
		
		if (!$this->request->post['rajasmsindo_smsphone']) {
			$this->error['smsphone'] = $this->language->get('error_smsphone');
		}
		
		if ($this->request->post['rajasmsindo_smsmode']==1) {
			if(!$this->request->post['rajasmsindo_modem']){
			$this->error['modem'] = $this->language->get('error_modem');
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