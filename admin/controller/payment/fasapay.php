<?php
class ControllerPaymentFasapay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/fasapay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('fasapay', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_authorization'] = $this->language->get('text_authorization');
		$this->data['text_sale'] = $this->language->get('text_sale');
		$this->data['entry_secretword'] = $this->language->get('secretword');
		$this->data['entry_debug'] = $this->language->get('entry_debug');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_akun'] = $this->language->get('entry_akun');
		$this->data['entry_test'] = $this->language->get('entry_test');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['entry_success_status'] = $this->language->get('entry_success_status');
		$this->data['entry_failed_status'] = $this->language->get('entry_failed_status');
		$this->data['base'] = $this->config->get('config_url');
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/fasapay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('payment/fasapay', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		
		if (isset($this->request->post['fasapay_akun'])) {
			$this->data['fasapay_akun'] = $this->request->post['fasapay_akun'];
		} else {
			$this->data['fasapay_akun'] = $this->config->get('fasapay_akun');
		}

		if (isset($this->request->post['fasapay_sword'])) {
			$this->data['fasapay_sword'] = $this->request->post['fasapay_sword'];
		} else {
			$this->data['fasapay_sword'] = $this->config->get('fasapay_sword');
		}
		
		if (isset($this->request->post['fasapay_success_status'])) {
			$this->data['fasapay_success_status'] = $this->request->post['fasapay_success_status'];
		} else {
			$this->data['fasapay_success_status'] = $this->config->get('fasapay_success_status');
		}
		
		if (isset($this->request->post['fasapay_failed_status'])) {
			$this->data['fasapay_failed_status'] = $this->request->post['fasapay_failed_status'];
		} else {
			$this->data['fasapay_failed_status'] = $this->config->get('fasapay_failed_status');
		}
		
		if (isset($this->request->post['fasapay_store'])) {
			$this->data['fasapay_store'] = $this->request->post['fasapay_store'];
		} else {
			$this->data['fasapay_store'] = $this->config->get('fasapay_store');
		}
		
		if (isset($this->request->post['fasapay_test'])) {
			$this->data['fasapay_test'] = $this->request->post['fasapay_test'];
		} else {
			$this->data['fasapay_test'] = $this->config->get('fasapay_test');
		}

		if (isset($this->request->post['fasapay_status'])) {
			$this->data['fasapay_status'] = $this->request->post['fasapay_status'];
		} else {
			$this->data['fasapay_status'] = $this->config->get('fasapay_status');
		}
		
		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['fasapay_geo_zone_id'])) {
			$this->data['fasapay_geo_zone_id'] = $this->request->post['fasapay_geo_zone_id'];
		} else {
			$this->data['fasapay_geo_zone_id'] = $this->config->get('fasapay_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		
		if (isset($this->request->post['fasapay_sort_order'])) {
			$this->data['fasapay_sort_order'] = $this->request->post['fasapay_sort_order'];
		} else {
			$this->data['fasapay_sort_order'] = $this->config->get('fasapay_sort_order');
		}

		$this->template = 'payment/fasapay.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/fasapay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>