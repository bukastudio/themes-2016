<?php
class ModelShippingIdex extends Model {
  	public function getQuote($address) {
		$this->load->language('shipping/idex');

		$quote_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name");

		foreach ($query->rows as $result) {
			if ($this->config->get('idex_' . $result['geo_zone_id'] . '_status')) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$result['geo_zone_id'] . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

				if ($query->num_rows) {
					$status = true;
				} else {
					$status = false;
				}
			} else {
				$status = false;
			}

			// Data[0] = Kota/Kab
			// Data[1] = Rate per kg untuk maks 2kg
			// Data[2] = flat rate untuk 3-5 kg
			// Data[3] = Additional Cost untuk > 5kg



			if ($status) {
				$cost = '';
				$weight = $this->cart->getWeight();
				$berat = explode('.',$weight);

				$rates = preg_split('/\r\n/', $this->config->get('idex_' . $result['geo_zone_id'] . '_rate'));

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

				$beratsisa = $beratfinal - 5;


				//echo $berat[1];
				foreach ($rates as $rate) {
					$data = explode(',', $rate);

					if(strtoupper($address['city'])==strtoupper($data[0])){
						if(isset($data[1])){

							if ($beratfinal <= 2){
								$cost = $data[1] * $beratfinal;
							} elseif ($beratfinal <= 5){
								$cost = $data[2];
							} else {
								$cost = $data[2] + ($data[3] * $beratsisa);
							}

						}
						break;
					}

				}

				if ((string)$cost != '') {
					$quote_data['idex_' . $result['geo_zone_id']] = array(
						'code'         => 'idex.idex_' . $result['geo_zone_id'],

						'title'        => 'IDEX Cargo (' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . '), Delivery time: '.$data[4].' day(s)',
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('idex_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('idex_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}
		}

		$method_data = array();

		if ($quote_data) {
      		$method_data = array(
        		'code'       => 'idex',
        		'title'      => $this->language->get('text_title'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('idex_sort_order'),
        		'error'      => false
      		);
		}

		return $method_data;
  	}
}
?>