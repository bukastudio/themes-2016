<?php
class ModelShippingWahana extends Model {
  	public function getQuote($address) {
		$this->load->language('shipping/wahana');

		$quote_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name");

		foreach ($query->rows as $result) {
			if ($this->config->get('wahana_' . $result['geo_zone_id'] . '_status')) {
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
			// [1]	1kg
			// [2]	1.1kg - 5kg
			// [3]	5.1kg - 10kg
			// [4]	10.1kg - 25kg
			// [5]	25.1kg - 50kg
			// [6]	50.1kg - 100kg
			// [7]	> 100kg
			// [8]	Lead Time



			if ($status) {
				$cost = '';
				$weight = $this->cart->getWeight();
				$berat = explode('.',$weight);

				$rates = preg_split('/\r\n/', $this->config->get('wahana_' . $result['geo_zone_id'] . '_rate'));

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
							} elseif ($beratfinal <= 5) {
								$cost = $beratfinal * $data[2];
							} elseif ($beratfinal <= 10) {
								$cost = $beratfinal * $data[3];
							} elseif ($beratfinal <= 25) {
								$cost = $beratfinal * $data[4];
							} elseif ($beratfinal <= 50) {
								$cost = $beratfinal * $data[5];
							} elseif ($beratfinal <= 100) {
								$cost = $beratfinal * $data[6];
							} else {
								$cost = $beratfinal * $data[7];
							}
						}
						break;
					}

				}

				if ((string)$cost != '') {
					$quote_data['wahana_' . $result['geo_zone_id']] = array(
						'code'         => 'wahana.wahana_' . $result['geo_zone_id'],
						'title'        => 'Wahana Logistic (' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . '), Delivery time: '.$data[8].' day(s)',
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('wahana_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('wahana_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}
		}

		$method_data = array();

		if ($quote_data) {
      		$method_data = array(
        		'code'       => 'wahana',
        		'title'      => $this->language->get('text_title'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('wahana_sort_order'),
        		'error'      => false
      		);
		}

		return $method_data;
  	}
}
?>