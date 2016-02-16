<?php
//-----------------------------------------
// Author: Qphoria@gmail.com
// Web: http://www.OpenCartGuru.com/
//-----------------------------------------
class ControllerTotalAutoDiscount extends Controller { 
	private $error = array();
	private $name = '';

	public function index() {

		/* START ERRORS */
		$errors = array(
			'warning'
		);
		/* END ERRORS */



		/* START COMMON STUFF */
		$this->name = basename(__FILE__, '.php');

		if (!isset($this->session->data['token'])) { $this->session->data['token'] = 0; }
		$this->data['token'] = $this->session->data['token'];
		$this->data = array_merge($this->data, $this->load->language('total/' . $this->name));

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate($errors))) {
			foreach ($this->request->post as $key => $value) {
				if (is_array($value)) { $this->request->post[$key] = implode(',', $value); }
			}

			$this->model_setting_setting->editSetting($this->name, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect((((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/total'));
		}

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=common/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/total'),
       		'text'      => $this->language->get('text_total'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=total/' . $this->name),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=total/' . $this->name);

		$this->data['cancel'] = (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/total');

		$this->id       = 'content';
		$this->template = 'total/' . $this->name . '.tpl';

		/* 14x backwards compatibility */
		if (method_exists($this->document, 'addBreadcrumb')) { //1.4.x
			$this->document->breadcrumbs = $this->data['breadcrumbs'];
			unset($this->data['breadcrumbs']);
		}//

		$this->children = array(
            'common/header',
            'common/footer'
        );

        foreach ($errors as $error) {
			if (isset($this->error[$error])) {
				$this->data['error_' . $error] = $this->error[$error];
			} else {
				$this->data['error_' . $error] = '';
			}
		}
		/* END COMMON STUFF */




		/* START FIELDS */
		$this->data['extension_class'] = 'total';
		$this->data['tab_class'] = 'htabs';

		$geo_zones = array();

		$this->load->model('localisation/geo_zone');

		$geo_zones[0] = $this->language->get('text_all_zones');
		foreach ($this->model_localisation_geo_zone->getGeoZones() as $geozone) {
			$geo_zones[$geozone['geo_zone_id']] = $geozone['name'];
		}
		
		$customer_groups = array();

		$this->load->model('sale/customer_group');

		foreach ($this->model_sale_customer_group->getCustomerGroups() as $customer_group) {
			$customer_groups[$customer_group['customer_group_id']] = $customer_group['name'];
		}

		$this->data['tabs'] = array();

		$this->data['tabs'][] = array(
			'id'		=> 'tab_general',
			'title'		=> $this->language->get('tab_general')
		);

		$this->data['fields'] = array();

		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_status'),
			'type'			=> 'select',
			'name' 			=> $this->name . '_status',
			'value' 		=> (isset($this->request->post[$this->name . '_status'])) ? $this->request->post[$this->name . '_status'] : $this->config->get($this->name . '_status'),
			'required' 		=> false,
			'options'		=> array(
				'0' => $this->language->get('text_disabled'),
				'1' => $this->language->get('text_enabled')
			)
		);

		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_mode'),
			'type'			=> 'select',
			'name' 			=> $this->name . '_mode',
			'value' 		=> (isset($this->request->post[$this->name . '_mode'])) ? $this->request->post[$this->name . '_mode'] : $this->config->get($this->name . '_mode'),
			'required' 		=> false,
			'options'		=> array(
				'0' => $this->language->get('text_subtotal'),
				'1' => $this->language->get('text_quantity')
			)
		);
		
		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_rate'),
			'type'			=> 'text',
			'size'			=> '60',
			'name' 			=> $this->name . '_rate',
			'value' 		=> (isset($this->request->post[$this->name . '_rate'])) ? $this->request->post[$this->name . '_rate'] : $this->config->get($this->name . '_rate'),
			'required' 		=> true,
			'help' 			=> $this->language->get('help_rate'),
			'error'			=> (isset($this->error['rate'])) ? $this->error['rate'] : ''
		);

		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_special'),
			'type'			=> 'select',
			'name' 			=> $this->name . '_special',
			'value' 		=> (isset($this->request->post[$this->name . '_special'])) ? $this->request->post[$this->name . '_special'] : $this->config->get($this->name . '_special'),
			'required' 		=> false,
			'options'		=> array(
				'0' => $this->language->get('text_no'),
				'1' => $this->language->get('text_yes')
			)
		);

/*
		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_customer_group'),
			'type'			=> 'select',
			'multiple'		=> true,
			'name' 			=> $this->name . '_customer_group[]',
			'value' 		=> (isset($this->request->post[$this->name . '_customer_group'])) ? $this->request->post[$this->name . '_customer_group'] : $this->config->get($this->name . '_customer_group'),
			'required' 		=> false,
			'options'		=> $customer_groups
		);
*/
		
		$this->data['fields'][] = array(
			'entry' 		=> $this->language->get('entry_geo_zone'),
			'type'			=> 'select',
			'name' 			=> $this->name . '_geo_zone_id',
			'value' 		=> (isset($this->request->post[$this->name . '_geo_zone_id'])) ? $this->request->post[$this->name . '_geo_zone_id'] : $this->config->get($this->name . '_geo_zone_id'),
			'required' 		=> false,
			'options'		=> $geo_zones
		);

		$this->data['fields'][] = array(
			'entry'			=> $this->language->get('entry_sort_order'),
			'type'			=> 'text',
			'name'			=> $this->name . '_sort_order',
			'value'			=> (isset($this->request->post[$this->name . '_sort_order'])) ? $this->request->post[$this->name . '_sort_order'] : $this->config->get($this->name . '_sort_order'),
			'required'		=> false,
		);
		/* END FIELDS */

        $this->response->setOutput($this->render(TRUE));
	}

	private function validate($errors = array()) {
		if (!$this->user->hasPermission('modify', 'total/' . $this->name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($errors as $error) {
			if (isset($this->request->post[$this->name . '_' . $error]) && !$this->request->post[$this->name . '_' . $error]) {
				$this->error[$error] = $this->language->get('error_' . $error);
			}
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>