<?php
class ControllerPaymentFasapay extends Controller {
	protected function index() {
	$this->language->load('payment/fasapay');
	
	$this->data['text_testmode'] = $this->language->get('text_testmode');		
    	
	$this->data['button_confirm'] = $this->language->get('button_confirm');
		
	$this->data['testmode'] = $this->config->get('fasapay_test');
	
	if (!$this->config->get('fasapay_test')) {
    		$this->data['action'] = 'https://sci.fasapay.com';
  		} else {
			$this->data['action'] = 'https://sandbox.fasapay.com/sci';
		}
	
	
	$this->load->model('checkout/order');
	
	$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
	
	if ($order_info) {
			$currencies = array(
				'USD',
				'IDR'
			);
			
			if (in_array($order_info['currency_code'], $currencies)) {
				$currency = $order_info['currency_code'];
			} else {
				$currency = 'USD';
			}
			
			$this->data['akunFP'] = $this->config->get('fasapay_akun');
			$this->data['store'] = $this->config->get('fasapay_store');
			
			$this->data['products'] = array();
			$this->data['detail'] ="";
			$this->data['total2'] =0;
			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();
	
				foreach ($product['option'] as $option) {
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => $option['option_value']
					);
				}
				
				$this->data['products'][] = array(
					'name'     => $product['name'],
					'model'    => $product['model'],
					'price'    => $this->currency->format($product['price'], $currency, false, false),
					'quantity' => $product['quantity'],
					'option'   => $option_data,
					'weight'   => $product['weight']
				);
				$this->data['total2']+=$this->currency->format( $this->cart->getSubTotal(), $currency, false, false);
				$this->data['detail'] .= $product['quantity'].'x '.$product['name']." \n"; 
			}	
			$this->data['detail'].="(Termasuk Shipping) \n";
			$this->data['total']=$this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $currency, false, false);
			$this->data['totalfix']=$this->data['total2']+$this->data['total'];
			$this->data['currency_code'] = $currency;
			$this->load->library('encryption');
			
			$encryption = new Encryption($this->config->get('config_encryption'));
	
			$this->data['custom'] =$this->session->data['order_id'];
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/fasapay.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/payment/fasapay.tpl';
			} else {
				$this->template = 'default/template/payment/fasapay.tpl';
			}
	
			$this->render();
	}
	}
	
	public function confirm() {
	$this->load->model('checkout/order');
	if ( $this->validate($this->request->post, $this->config->get('fasapay_sword'))) {
	
	$this->model_checkout_order->confirm($this->request->post['order_id'],$this->config->get('fasapay_success_status'));
	$this->redirect($this->url->link('checkout/success'));
	} else {
	
	$this->model_checkout_order->confirm($this->request->post['order_id'],$this->config->get('fasapay_failed_status'));
	}
	}
	
	public function fail() {
	$this->load->model('checkout/order');
	$this->language->load('payment/fasapay_fail');
	$this->session->data['last_order_id'] = $this->request->post['order_id'];
	$this->model_checkout_order->confirm($this->request->post['order_id'],$this->config->get('fasapay_failed_status'));
	$this->data['heading_title'] = $this->language->get('heading_title');
	
	$this->data['text_message'] = sprintf($this->language->get('text_message'), $this->session->data['last_order_id'], $this->url->link('information/contact'));
	$this->data['store_owner'] = $this->url->link('information/contact');
	
	
	$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'			
		);
	$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_cart'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);		
	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('payment/fasapay/fail'),
        	'text'      => $this->language->get('text_fail'),
        	'separator' => $this->language->get('text_separator')
      	);
	$this->template = $this->config->get('config_template') . '/template/payment/fasapay_fail.tpl';
	$this->response->setOutput($this->render());
	}
	
	public function success() {
	$this->session->data['last_order_id'] = $this->request->post['order_id'];
	$this->session->data['order_id'] = $this->request->post['order_id'];
	$this->language->load('payment/fasapay_success');
	
	$this->data['heading_title'] =  sprintf($this->language->get('heading_title'), $this->session->data['last_order_id']);
	
	$this->data['text_message'] = sprintf($this->language->get('text_message'), $this->session->data['last_order_id'], $this->url->link('information/contact'));
	$this->data['store_owner'] = $this->url->link('information/contact');
	
	
	$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'			
		);
	$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_cart'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);		
	
	$this->template = $this->config->get('config_template') . '/template/payment/fasapay_success.tpl';
	$this->response->setOutput($this->render());
	}
	
	private function validate($dpost, $sword) {
	$msg = '';
	$msg .= $dpost['fp_paidto'].':';
	$msg .= $dpost['fp_paidby'].':';
	$msg .= $dpost['fp_store'].':';
	$msg .= $dpost['fp_amnt'].':';
	$msg .= $dpost['fp_batchnumber'].':';
	$msg .= $dpost['fp_currency'].':';
	$msg .= $sword;				
	$hsl = hash('sha256', $msg);	
	return ($dpost['fp_hash'] == $hsl);
	}

}
?>