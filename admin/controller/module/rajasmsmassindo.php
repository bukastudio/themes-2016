<?php 
class Controllermodulerajasmsmassindo extends Controller {
	private $error = array();
	 
	public function index() {
		$this->load->language('module/rajasmsmassindo');
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		$this->data['text_customer_all'] = $this->language->get('text_customer_all');	
		$this->data['text_customer'] = $this->language->get('text_customer');	
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');	
		$this->data['text_product'] = $this->language->get('text_product');	

		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_to'] = $this->language->get('entry_to');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_message'] = $this->language->get('entry_message');
		
		$this->data['button_send'] = $this->language->get('button_send');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['token'] = $this->session->data['token'];

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/rajasmsmassindo', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
    	$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		$this->load->model('sale/customer_group');
				
		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(0);
				
		$this->template = 'module/rajasmsmassindo.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function send() {
		$this->load->language('module/rajasmsmassindo');
		$json = array();
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'module/rajasmsmassindo')) {
				$json['error']['warning'] = $this->language->get('error_permission');
			}
					
			if (!$this->request->post['message']) {
				$json['error']['message'] = $this->language->get('error_message');
			}
			if (!$this->config->get('rajasmsindo_statussms')) {
				$json['error']['message'] = $this->language->get('error_disabled');
			}

			
			if (!$json) {
				$this->load->model('setting/store');
			
				$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
				
				if ($store_info) {
					$store_name = $store_info['name'];
				} else {
					$store_name = $this->config->get('config_name');
				}
	
				$this->load->model('sale/customer');
				
				$this->load->model('sale/customer_group');
				
				$this->load->model('sale/affiliate');
	
				$this->load->model('sale/order');
	
				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}
								
				$telephone_total = 0;
							
				$telephones = array();
				
				switch ($this->request->post['to']) {
					case 'newsletter':
						$customer_data = array(
							'filter_newsletter' => 1,
							'start'             => ($page - 1) * 10,
							'limit'             => 10
						);
						
						$telephone_total = $this->model_sale_customer->getTotalCustomers($customer_data);
							
						$results = $this->model_sale_customer->getCustomers($customer_data);
					
						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}
						break;
					case 'customer_all':
						$customer_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);
									
						$telephone_total = $this->model_sale_customer->getTotalCustomers($customer_data);
										
						$results = $this->model_sale_customer->getCustomers($customer_data);
				
						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}						
						break;
					case 'customer_group':
						$customer_data = array(
							'filter_customer_group_id' => $this->request->post['customer_group_id'],
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);
						
						$telephone_total = $this->model_sale_customer->getTotalCustomers($customer_data);
										
						$results = $this->model_sale_customer->getCustomers($customer_data);
				
						foreach ($results as $result) {
							$telephones[$result['customer_id']] = $result['telephone'];
						}						
						break;
					case 'customer':
						if (!empty($this->request->post['customer'])) {					
							foreach ($this->request->post['customer'] as $customer_id) {
								$customer_info = $this->model_sale_customer->getCustomer($customer_id);
								
								if ($customer_info) {
									$telephones[] = $customer_info['telephone'];
								}
							}
						}
						break;	
					case 'affiliate_all':
						$affiliate_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);
						
						$telephone_total = $this->model_sale_affiliate->getTotalAffiliates($affiliate_data);		
						
						$results = $this->model_sale_affiliate->getAffiliates($affiliate_data);
				
						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}						
						break;	
					case 'affiliate':
						if (!empty($this->request->post['affiliate'])) {					
							foreach ($this->request->post['affiliate'] as $affiliate_id) {
								$affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);
								
								if ($affiliate_info) {
									$telephones[] = $affiliate_info['telephone'];
								}
							}
						}
						break;											
					case 'product':
						if (isset($this->request->post['product'])) {
							$telephone_total = $this->model_sale_order->getTotalEmailsByProductsOrdered($this->request->post['product']);	
							
							$results = $this->model_sale_order->getEmailsByProductsOrdered($this->request->post['product'], ($page - 1) * 10, 10);
													
							foreach ($results as $result) {
								$telephones[] = $result['telephone'];
							}
						}
						break;												
				}
				$telephones = array_unique($telephones);		
				if ($telephones) {
					$start = ($page - 1) * 10;
					$end = $start + 10;
					
					if ($end < $telephone_total) {
						$json['success'] = sprintf($this->language->get('text_sent'), $start, $telephone_total);
					} else { 
						$json['success'] = $this->language->get('text_success');
					}				
						
					if ($end < $telephone_total) {
						$json['next'] = str_replace('&amp;', '&', $this->url->link('module/rajasmsmassindo/send', 'token=' . $this->session->data['token'] . '&page=' . ($page + 1)));
					} else {
						$json['next'] = '';
					}
										
					$message    = $store_name.' '.html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8');
					foreach ($telephones as $nohp) {
						$sms = new sms();
						$sms->key = $this->config->get('rajasmsindo_key');
						$sms->phone = $this->config->get('rajasmsindo_smsphone');			
						$sms->username = $this->config->get('rajasmsindo_user');
						$sms->password = $this->config->get('rajasmsindo_password');
						$sms->smsmode = $this->config->get('rajasmsindo_smsmode');
						$sms->modem = $this->config->get('rajasmsindo_modem');
						$sms->setTo($nohp);
						$sms->setText($message);
						$sms->send();
					}
				}
			}
		}
		
		$this->response->setOutput(json_encode($json));	
	}
}
?>