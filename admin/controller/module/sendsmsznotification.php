<?php
class ControllerModuleSendsmszNotification extends Controller {
	private $error = array(); 
	
	public function index() {
		$this->language->load('module/sendsmsznotification');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->load->model('sale/customer');
			$this->load->model('sale/customer_group');
			$this->load->model('sale/affiliate');
			$this->load->model('sale/order');
			
			/*
			$userkey = $this->config->get('userkey');
			$passkey = $this->config->get('passkey');
			$url = $this->config->get('httpapi');
			$text = urlencode(substr($this->request->post['message'],0,150));
			*/
			switch ($this->request->post['to']) {
				case 'nohp':
					$numbers[] = $this->request->post['nohp'];
				break;
				case 'newsletter':
					$customer_data = array(
							'filter_newsletter' => 1
					);
						
					$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
					$results = $this->model_sale_customer->getCustomers($customer_data);
					foreach ($results as $result) {
						$numbers[] = $result['telephone'];
					}
				break;
				case 'customer_all':
					$customer_data = array();
									
					$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
					$results = $this->model_sale_customer->getCustomers($customer_data);
					foreach ($results as $result) {
						$numbers[] = $result['telephone'];
					}
				break;
				case 'customer_group':
					$customer_data = array(
							'filter_customer_group_id' => $this->request->post['customer_group_id']
					);
						
					$email_total = $this->model_sale_customer->getTotalCustomers($customer_data);
					$results = $this->model_sale_customer->getCustomers($customer_data);
					foreach ($results as $result) {
						$numbers[] = $result['telephone'];
					}
				break;
				case 'customer':
					if (!empty($this->request->post['customer'])) {					
						foreach ($this->request->post['customer'] as $customer_id) {
							$customer_info = $this->model_sale_customer->getCustomer($customer_id);
								
							if ($customer_info) {
								$numbers[] = $customer_info['telephone'];
							}
						}
					}
				break;
				case 'affiliate_all':
					$affiliate_data = array();
						
					$email_total = $this->model_sale_affiliate->getTotalAffiliates($affiliate_data);						
					$results = $this->model_sale_affiliate->getAffiliates($affiliate_data);
					foreach ($results as $result) {
						$numbers[] = $result['telephone'];
					}
				break;
				case 'affiliate':
					if (!empty($this->request->post['affiliate'])) {					
						foreach ($this->request->post['affiliate'] as $affiliate_id) {
							$affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);
								
							if ($affiliate_info) {
								$numbers[] = $affiliate_info['telephone'];
							}
						}
					}
				break;
				case 'product':
					if (isset($this->request->post['product'])) {
						$results = $this->model_sale_order->getTelephoneByProductsOrdered($this->request->post['product']);
													
						foreach ($results as $result) {
							$numbers[] = $result['telephone'];
						}
					}
				break;
			}
			
			if ($numbers) {
				
				$this->load->model('libraries/smsznotification');
				
				$gateway = $this->config->get('gateway');
				
				foreach ($numbers as $destination) {
					$getresponse = $this->model_libraries_smsznotification->send_message($destination, $this->request->post['message'], $gateway);
				}
				
				$status = $getresponse;
			}
			
	    if($status == "Success"){
				$this->session->data['success'] = $this->language->get('text_success_sent');
			}else{
				$this->session->data['error'] = $this->language->get('text_error').'<b><i>'.$status.'</i></b>)';
			}
						
			$this->redirect($this->url->link('module/sendsmsznotification', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
		
			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$defaultgateway = $this->config->get('gateway');
		if($defaultgateway == "onewaymasking"){
			$this->data['gateway'] = "One Way Masking";
		}elseif($defaultgateway == "oneway"){
			$this->data['gateway'] = "One Way GSM";
		}elseif($defaultgateway == "twoway"){
			$this->data['gateway'] = "Two Way";
		}else{
			$this->data['gateway'] = "Not found!";
		}
		
		
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_nohp'] = $this->language->get('text_nohp');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_customer_all'] = $this->language->get('text_customer_all');	
		$this->data['text_customer'] = $this->language->get('text_customer');	
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');	
		$this->data['text_product'] = $this->language->get('text_product');
		$this->data['text_default'] = $this->language->get('text_default');
		
		$this->data['entry_nohp'] = $this->language->get('entry_nohp');
		$this->data['entry_message'] = $this->language->get('entry_message');
		$this->data['entry_or'] = $this->language->get('entry_or');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$this->data['entry_product'] = $this->language->get('entry_product');
		
		$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_setting'] = $this->language->get('button_setting');
		
		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['nohp'])) {
			$this->data['error_nohp'] = $this->error['nohp'];
		} else {
			$this->data['error_nohp'] = '';
		}
		
		if (isset($this->error['message'])) {
			$this->data['error_message'] = $this->error['message'];
		} else {
			$this->data['error_message'] = '';
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
			'href'      => $this->url->link('module/sendsmsznotification', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/sendsmsznotification', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['setting'] = $this->url->link('module/smsznotification', 'token=' . $this->session->data['token'], 'SSL');
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('sale/customer_group');
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(0);
						
		$this->template = 'module/sendsmsznotification.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/sendsmsznotification')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['to']) {
			$this->error['nohp'] = $this->language->get('error_nohp');
		}
		
		switch ($this->request->post['to']) {
			case 'nohp':
				if (!$this->request->post['nohp']) {
					$this->error['nohp'] = $this->language->get('error_nohp');
				}
			break;
			case 'customer':
				if (!$this->request->post['customers']) {
					$this->error['nohp'] = $this->language->get('error_nohp');
				}
			break;
			case 'affiliate':
				if (!$this->request->post['affiliates']) {
					$this->error['nohp'] = $this->language->get('error_nohp');
				}
			break;
			case 'product':
				if (!$this->request->post['products']) {
					$this->error['nohp'] = $this->language->get('error_nohp');
				}
			break;
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