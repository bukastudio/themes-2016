<?php
class ModelShippingEsl extends Model {
  	public function getQuote($address) {
		$this->load->language('shipping/esl');

		$quote_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name");

		foreach ($query->rows as $result) {
			if ($this->config->get('esl_' . $result['geo_zone_id'] . '_status')) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$result['geo_zone_id'] . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

				if ($query->num_rows) {
					$status = true;
				} else {
					$status = false;
				}
			} else {
				$status = false;
			}

			// Data
			// -----
			// [0]	Kota
			// [1]	0kg - 1kg
			// [2]	2kg - 99kg
			// [3]	>= 100kg
			// [4]	Lead Time



			if ($status) {
				$cost = '';
				$weight = $this->cart->getWeight();
				$berat = explode('.',$weight);

				$rates = preg_split('/\r\n/', $this->config->get('esl_' . $result['geo_zone_id'] . '_rate'));

				if(!isset($berat[1])) {
								$berat[1] = 0;
					}
				else{
					$berat[1]="0.$berat[1]";
				}

				if(($berat[1]) <= 0.3){
					$beratfinal = $berat[0];
				} else {
					$beratfinal = $berat[0] + 1;
				}

				foreach ($rates as $rate) {
					$data = explode(',', $rate);

					if(strtoupper($address['city'])==strtoupper($data[0])){
						if(isset($data[1])){

							if($beratfinal <= 1) {
								$cost = $data[1];
							} elseif ($beratfinal < 100) {
								$cost = $beratfinal * $data[2];
							} else {
								$cost = $beratfinal * $data[3];
							}
						}
						break;
					}

				}

				if ((string)$cost != '') {
					$quote_data['esl_' . $result['geo_zone_id']] = array(
						'code'         => 'esl.esl_' . $result['geo_zone_id'],
						'title'        => 'ESL Express (' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . '), Delivery time: '.$data[4].' day(s)',
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('esl_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('esl_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}
		}

		$method_data = array();

		if ($quote_data) {
      		$method_data = array(
        		'code'       => 'esl',
        		'title'      => $this->language->get('text_title'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('esl_sort_order'),
        		'error'      => false
      		);
		}

		return $method_data;
  	}
}
?>