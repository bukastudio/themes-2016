<?php
class ModelShippingPayLater extends Model {
	function getQuote($address) {
		$this->load->language('shipping/pay_later');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('pay_later_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('pay_later_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		if ($this->cart->getSubTotal() < $this->config->get('pay_later_total')) {
			$status = false;
		}

		$method_data = array();



			if ($status) {
			$quote_data = array();

      		$quote_data['pay_later'] = array(
        		'code'         => 'pay_later.pay_later',
        		'title'        => '<strong>' . $this->language->get('text_title') . '</strong> - ' . $this->language->get('text_description'),
        		'cost'         => 0.00,
        		'tax_class_id' => 0,
				'text'         => $this->currency->format(0.00)
      		);

      		$method_data = array(
        		'code'       => 'pay_later',
        		'title'      => '<strong>' . $this->language->get('text_title') . '</strong> - ' . $this->language->get('text_description'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('pay_later_sort_order'),
        		'error'      => false
      		);
		}

		return $method_data;
	}
}
?>