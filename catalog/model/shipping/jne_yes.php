<?php
class ModelShippingjneyes extends Model {
  	public function getQuote($address) {
		$this->load->language('shipping/jne_yes');

		$quote_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo_zone ORDER BY name");

		foreach ($query->rows as $result) {
			if ($this->config->get('jne_yes_' . $result['geo_zone_id'] . '_status')) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$result['geo_zone_id'] . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

				if ($query->num_rows) {
					$status = true;
				} else {
					$status = false;
				}
			} else {
				$status = false;
			}



			if ($status) {
				$cost = '';
				$weight = $this->cart->getWeight();
				$berat = explode('.',$weight);

				$rates = preg_split('/\r\n/', $this->config->get('jne_yes_' . $result['geo_zone_id'] . '_rate'));

				if(!isset($berat[1])) {
								$berat[1] = 0;
					}
				else{
					$berat[1]="0.$berat[1]";
				}
				//echo $berat[1];
				foreach ($rates as $rate) {
					$data = explode(',', $rate);

					if(strtoupper($address['city'] . $address['zone'])==strtoupper($data[2] . $data[1])){
						if(isset($data[3])){
							if ($berat[0] < 1){
								$cost = $data[3];

							}

							elseif(($berat[1])<=0.3){
								$cost = $berat[0] * $data[3];
							}
							else{
								$cost = ($berat[0]+1) * $data[3];
							}

						}
						break;
					}

				}

				if ((string)$cost != '') {
					$quote_data['jne_yes_' . $result['geo_zone_id']] = array(
						'code'         => 'jne_yes.jne_yes_' . $result['geo_zone_id'],

						'title'        => 'JNE YES (' . $this->weight->format($weight, $this->config->get('config_weight_class_id')) . ')',
						'cost'         => $cost,
						'tax_class_id' => $this->config->get('jne_yes_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('jne_yes_tax_class_id'), $this->config->get('config_tax')))
					);
				}
			}
		}

		$method_data = array();

		if ($quote_data) {
      		$method_data = array(
        		'code'       => 'jne_yes',
        		'title'      => $this->language->get('text_title'),
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('jne_yes_sort_order'),
        		'error'      => false
      		);
		}

		return $method_data;
  	}
}
?>