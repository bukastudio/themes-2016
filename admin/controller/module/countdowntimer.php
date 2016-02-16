<?php
class ControllerModuleCountdowntimer extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/countdowntimer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('countdowntimer', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			if( !empty($this->request->post['stay']) ){
				$this->redirect($this->url->link('module/countdowntimer', 'token=' . $this->session->data['token'], 'SSL'));
			}else{
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		if(isset($this->session->data['success'])){
			$this->data['success'] =  $this->session->data['success'];
			unset($this->session->data['success']);
		}
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['tab_product_settings'] = $this->language->get('tab_product_settings');
		$this->data['tab_category_settings'] = $this->language->get('tab_category_settings');
		$this->data['tab_help'] = $this->language->get('tab_help');

		$this->data['entry_show_in_product'] = $this->language->get('entry_show_in_product');
		$this->data['entry_show_in_category'] = $this->language->get('entry_show_in_category');

		$this->data['entry_text_timer'] = $this->language->get('entry_text_timer');
		$this->data['entry_text_timer_help'] = $this->language->get('entry_text_timer_help');
		$this->data['entry_countdays_timer'] = $this->language->get('entry_countdays_timer');
		$this->data['entry_countdays_timer_help'] = $this->language->get('entry_countdays_timer_help');
		$this->data['entry_days_timer'] = $this->language->get('entry_days_timer');
		$this->data['entry_sec_timer'] = $this->language->get('entry_sec_timer');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['text_description'] = $this->language->get('text_description');
		$this->data['text_help'] = $this->language->get('text_help');


		$this->data['button_save_go'] = $this->language->get('button_save_go');
		$this->data['button_save_stay'] = $this->language->get('button_save_stay');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		// Product
		if (isset($this->request->post['countdowntimer_product'])) {
			$this->data['countdowntimer_product'] = $this->request->post['countdowntimer_product'];
		} elseif ($this->config->get('countdowntimer_product')) {
			$this->data['countdowntimer_product'] = $this->config->get('countdowntimer_product');
		} else {
			$this->data['countdowntimer_product'] = 0;
		}

		if (isset($this->request->post['countdowntimer_product_texttimer'])) {
			$this->data['countdowntimer_product_texttimer'] = $this->request->post['countdowntimer_product_texttimer'];
		} elseif ($this->config->get('countdowntimer_product_texttimer')) {
			$this->data['countdowntimer_product_texttimer'] = $this->config->get('countdowntimer_product_texttimer');
		} else {
			$this->data['countdowntimer_product_texttimer'] = 0;
		}

		if (isset($this->request->post['countdowntimer_product_countdays'])) {
			$this->data['countdowntimer_product_countdays'] = $this->request->post['countdowntimer_product_countdays'];
		} elseif ($this->config->get('countdowntimer_product_countdays')) {
			$this->data['countdowntimer_product_countdays'] = $this->config->get('countdowntimer_product_countdays');
		} else {
			$this->data['countdowntimer_product_countdays'] = 0;
		}

		if (isset($this->request->post['countdowntimer_product_days'])) {
			$this->data['countdowntimer_product_days'] = $this->request->post['countdowntimer_product_days'];
		} elseif ($this->config->get('countdowntimer_product_days')) {
			$this->data['countdowntimer_product_days'] = $this->config->get('countdowntimer_product_days');
		} else {
			$this->data['countdowntimer_product_days'] = 0;
		}

		if (isset($this->request->post['countdowntimer_product_seconds'])) {
			$this->data['countdowntimer_product_seconds'] = $this->request->post['countdowntimer_product_seconds'];
		} elseif ($this->config->get('countdowntimer_product_seconds')) {
			$this->data['countdowntimer_product_seconds'] = $this->config->get('countdowntimer_product_seconds');
		} else {
			$this->data['countdowntimer_product_seconds'] = 0;
		}

		// Category

		if (isset($this->request->post['countdowntimer_category'])) {
			$this->data['countdowntimer_category'] = $this->request->post['countdowntimer_category'];
		} elseif ($this->config->get('countdowntimer_category')) {
			$this->data['countdowntimer_category'] = $this->config->get('countdowntimer_category');
		} else {
			$this->data['countdowntimer_category'] = 0;
		}

		if (isset($this->request->post['countdowntimer_category_texttimer'])) {
			$this->data['countdowntimer_category_texttimer'] = $this->request->post['countdowntimer_category_texttimer'];
		} elseif ($this->config->get('countdowntimer_category_texttimer')) {
			$this->data['countdowntimer_category_texttimer'] = $this->config->get('countdowntimer_category_texttimer');
		} else {
			$this->data['countdowntimer_category_texttimer'] = 0;
		}

		if (isset($this->request->post['countdowntimer_category_countdays'])) {
			$this->data['countdowntimer_category_countdays'] = $this->request->post['countdowntimer_category_countdays'];
		} elseif ($this->config->get('countdowntimer_category_countdays')) {
			$this->data['countdowntimer_category_countdays'] = $this->config->get('countdowntimer_category_countdays');
		} else {
			$this->data['countdowntimer_category_countdays'] = 0;
		}

		if (isset($this->request->post['countdowntimer_category_days'])) {
			$this->data['countdowntimer_category_days'] = $this->request->post['countdowntimer_category_days'];
		} elseif ($this->config->get('countdowntimer_category_days')) {
			$this->data['countdowntimer_category_days'] = $this->config->get('countdowntimer_category_days');
		} else {
			$this->data['countdowntimer_category_days'] = 0;
		}

		if (isset($this->request->post['countdowntimer_category_seconds'])) {
			$this->data['countdowntimer_category_seconds'] = $this->request->post['countdowntimer_category_seconds'];
		} elseif ($this->config->get('countdowntimer_category_seconds')) {
			$this->data['countdowntimer_category_seconds'] = $this->config->get('countdowntimer_category_seconds');
		} else {
			$this->data['countdowntimer_category_seconds'] = 0;
		}

		//============================================

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
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/countdowntimer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('module/countdowntimer', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');


		$this->template = 'module/countdowntimer.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/countdowntimer')) {
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