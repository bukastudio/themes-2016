<?php
class ControllerModuleAutoSeoTitle extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('module/autoseotitle');
		$this->document->setTitle($this->language->get('ast_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$arr_ast = array('ast_custom' => $this->request->post['ast_custom'], 'ast_custom1' => $this->request->post['ast_custom1'], 'ast_custom2' => $this->request->post['ast_custom2'], 'ast_sep' => implode(',', $this->request->post['ast_sep']), 'ast_ssep' => implode(',', $this->request->post['ast_ssep']), 'ast_hsep' => implode(',', $this->request->post['ast_hsep']), 'ast_order' => implode(',', $this->request->post['ast_order']), 'ast_sorder' => implode(',', $this->request->post['ast_sorder']), 'ast_horder' => implode(',', $this->request->post['ast_horder']));
			$this->model_setting_setting->editSetting('autoseotitle', $arr_ast);
			$this->session->data['success'] = $this->language->get('ast_success_text');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error']) ) {
			$this->data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}
		else {
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
			'text'      => $this->language->get('ast_title'),
			'href'      => $this->url->link('module/autoseotitle', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['button_save'] = $this->language->get('ast_save');
		$this->data['button_cancel'] = $this->language->get('ast_cancel');

		if (isset($this->request->post['ast_custom'])) {
			$this->data['ast_custom'] = $this->request->post['ast_custom'];
		} else {
			$this->data['ast_custom'] = $this->config->get('ast_custom');
		}

		if (isset($this->request->post['ast_custom1'])) {
			$this->data['ast_custom1'] = $this->request->post['ast_custom1'];
		} else {
			$this->data['ast_custom1'] = $this->config->get('ast_custom1');
		}

		if (isset($this->request->post['ast_custom2'])) {
			$this->data['ast_custom2'] = $this->request->post['ast_custom2'];
		} else {
			$this->data['ast_custom2'] = $this->config->get('ast_custom2');
		}

		if (isset($this->request->post['ast_order'])) {
			$this->data['ast_order'] = $this->request->post['ast_order'];
		} else {
			$this->data['ast_order'] = explode(",", $this->config->get('ast_order'));
		}

		if (isset($this->request->post['ast_sorder'])) {
			$this->data['ast_sorder'] = $this->request->post['ast_sorder'];
		} else {
			$this->data['ast_sorder'] = explode(",", $this->config->get('ast_sorder'));
		}

		if (isset($this->request->post['ast_horder'])) {
			$this->data['ast_horder'] = $this->request->post['ast_horder'];
		} else {
			$this->data['ast_horder'] = explode(",", $this->config->get('ast_horder'));
		}

		if (isset($this->request->post['ast_sep'])) {
			$this->data['ast_sep'] = $this->request->post['ast_sep'];
		} else {
			$this->data['ast_sep'] = explode(",", $this->config->get('ast_sep'));
		}

		if (isset($this->request->post['ast_ssep'])) {
			$this->data['ast_ssep'] = $this->request->post['ast_ssep'];
		} else {
			$this->data['ast_ssep'] = explode(",", $this->config->get('ast_ssep'));
		}

		if (isset($this->request->post['ast_hsep'])) {
			$this->data['ast_hsep'] = $this->request->post['ast_hsep'];
		} else {
			$this->data['ast_hsep'] = explode(",", $this->config->get('ast_hsep'));
		}

		$this->data['action'] = $this->url->link('module/autoseotitle', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['heading_title'] = $this->language->get('ast_title');
		$this->data['description'] = $this->language->get('ast_description');
		$this->data['entry_sitename'] = $this->language->get('ast_entry_sitename');
		$this->data['entry_sitename_description'] = $this->language->get('ast_entry_sitename_description');
		$this->data['entry_brandname'] = $this->language->get('ast_entry_brandname');
		$this->data['entry_brandname_description'] = $this->language->get('ast_entry_brandname_description');
		$this->data['entry_price'] = $this->language->get('ast_entry_price');
		$this->data['entry_price_description'] = $this->language->get('ast_entry_price_description');
		$this->data['entry_special'] = $this->language->get('ast_entry_special');
		$this->data['entry_special_description'] = $this->language->get('ast_entry_special_description');
		$this->data['entry_order'] = $this->language->get('ast_entry_order');
		$this->data['entry_order_description'] = $this->language->get('ast_entry_order_description');
		$this->data['entry_sorder'] = $this->language->get('ast_entry_sorder');
		$this->data['entry_sorder_description'] = $this->language->get('ast_entry_sorder_description');
		$this->data['entry_horder'] = $this->language->get('ast_entry_horder');
		$this->data['entry_horder_description'] = $this->language->get('ast_entry_horder_description');
		$this->data['entry_cat'] = $this->language->get('ast_entry_cat');
		$this->data['entry_cat_description'] = $this->language->get('ast_entry_cat_description');
		$this->data['entry_separator'] = $this->language->get('ast_entry_separator');
		$this->data['entry_separator_description'] = $this->language->get('ast_entry_separator_description');
		$this->data['entry_custom'] = $this->language->get('ast_entry_custom');
		$this->data['entry_custom_description'] = $this->language->get('ast_entry_custom_description');
		$this->data['entry_custom1'] = $this->language->get('ast_entry_custom1');
		$this->data['entry_custom1_description'] = $this->language->get('ast_entry_custom1_description');
		$this->data['entry_custom2'] = $this->language->get('ast_entry_custom2');
		$this->data['entry_custom2_description'] = $this->language->get('ast_entry_custom2_description');
		$this->data['entry_example'] = $this->language->get('ast_entry_example');
		$this->data['entry_example_description'] = $this->language->get('ast_entry_example_description');
		$this->data['yes'] = $this->language->get('ast_yes');
		$this->data['no'] = $this->language->get('ast_no');
		$this->data['order_pagename'] = $this->language->get('ast_order_pagename');
		$this->data['order_sitename'] = $this->language->get('ast_order_sitename');
		$this->data['order_brand'] = $this->language->get('ast_order_brand');
		$this->data['order_price'] = $this->language->get('ast_order_price');
		$this->data['order_model'] = $this->language->get('ast_order_model');
		$this->data['order_special'] = $this->language->get('ast_order_special');
		$this->data['order_product'] = $this->language->get('ast_order_product');
		$this->data['order_cat'] = $this->language->get('ast_order_cat');
		$this->data['order_custom'] = $this->language->get('ast_order_custom');
		$this->data['order_custom1'] = $this->language->get('ast_order_custom1');
		$this->data['order_custom2'] = $this->language->get('ast_order_custom2');
		$this->data['order_nothing'] = $this->language->get('ast_order_nothing');

		$this->data['modules'] = array();

		if (isset($this->request->post['autoseotitle_module'])) {
			$this->data['modules'] = $this->request->post['autoseotitle_module'];
		} else {
			$this->data['modules'] = $this->config->get('autoseotitle_module');
		}

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/autoseotitle.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());

	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/autoseotitle')) {
			$this->error['warning'] = $this->language->get('ast_error_access');
		}

		if (isset($this->request->post['autoseotitle_module'])) {
			foreach ($this->request->post['autoseotitle_module'] as $key => $value) {

			}
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function install() {
		$vqmod_xml_dir = substr_replace(DIR_SYSTEM, '/vqmod/xml/', -8);
		rename($vqmod_xml_dir . 'auto-seo-title-vqmod.xml', $vqmod_xml_dir . 'auto-seo-title-vqmod.xml');
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_custom','','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_custom1','','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_custom2','','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_order','0,4,2,5,3,6,1,0','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_sorder','0,1,2','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_horder','0,1,2','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_sep',', - , - , - , - , - ,','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_ssep',', - ','0')");
		$this->db->query("INSERT INTO ". DB_PREFIX . "setting VALUES (NULL,'". (int)$this->config->get('store_admin') ."','autoseotitle','ast_hsep',', - ','0')");
	}

	public function uninstall() {
		$vqmod_xml_dir = substr_replace(DIR_SYSTEM, '/vqmod/xml/', -8);
		rename($vqmod_xml_dir . 'auto-seo-title-vqmod.xml', $vqmod_xml_dir . 'auto-seo-title-vqmod.xml_');
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_custom'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_custom1'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_custom2'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_order'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_sorder'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_horder'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_sep'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_ssep'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `key` = 'ast_hsep'");
	}

}
?>
