<?php
class ModelTotalAutoDiscount extends Model {

	private $name = '';

	public function getTotal(&$total_data, &$total, &$taxes) {

		$this->name = basename(__FILE__, '.php');
		if ($this->config->get($this->name . '_status')) {

		 	// Get Address Data (Model)
		    $address = array();
			if (isset($this->session->data['payment_address_id']) && $this->session->data['payment_address_id']) { // Normal checkout
				$this->load->model('account/address');
				$address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
			} else { // Guest checkout
				$address = (isset($this->session->data['guest'])) ? $this->session->data['guest'] : array();
			}

			$country_id	= (isset($address['country_id'])) ? $address['country_id'] : 0;
			$zone_id 	= (isset($address['zone_id'])) ? $address['zone_id'] : 0;
			//

      		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get($this->name . '_geo_zone_id') . "' AND country_id = '" . (int)$country_id . "' AND (zone_id = '" . (int)$zone_id . "' OR zone_id = '0')");
			if (!$this->config->get($this->name . '_geo_zone_id')) {
        		$status = TRUE;
      		} elseif ($query->num_rows) {
      		  	$status = TRUE;
      		} else {
     	  		$status = FALSE;
			}

		 	if (!$status) { return; }
		 	//

		 	$this->load->language('total/' . $this->name);
			$this->load->model('localisation/currency');

			$discount = $this->config->get($this->name . '_rate');

			$subtotal = $this->cart->getSubTotal();

			// Experimental. Try to guess if there are other discount systems at work and apply discount on existing discounted total
			// Assumes all discounts are directly below subtotal
			if ($total < $subtotal) {
				$subtotal = $total;
			}//

			$itemCount = $this->cart->countProducts();

			// Don't discount if product is on special
			if (!$this->config->get($this->name . '_special')) {
				$subtotal = 0;
				$itemCount = 0;
				$this->load->model('catalog/product');
				foreach ($this->cart->getProducts() as $product) {
					if (method_exists($this->document, 'addBreadcrumb')) { //1.4.x
						$results = $this->model_catalog_product->getProductSpecial($product['product_id']);
						if (!$results) {
							$subtotal += (float)$product['price'] * (float)$product['quantity'];
							$itemCount += (int)$product['quantity'];
						}
					} else { //v1.5.x
						$results = $this->model_catalog_product->getProduct($product['product_id']);
						if (!$results['special']) {
							$subtotal += (float)$product['price'] * (float)$product['quantity'];
							$itemCount += (int)$product['quantity'];
						}
					}
				}
			}

			### SUBTOTAL MODE ###
			if (!$this->config->get($this->name . '_mode')) {
				$unit = $subtotal;
			} else { ### QUANTITY MODE ###
				$unit = $itemCount;
			}
			$discount_text = '';
			// If there is only one rate, use that. If there is ranged, then find the matching range.
			if (strpos($discount, ':') === false) {
				if (strpos($discount, '%') !== false) {
					$discount_text = $discount;
					$discount = trim($discount, '%');
					$discount = $unit * ($discount/100);
				} else {
					$discount = (float)$this->config->get($this->name . '_rate');
					//$discount_text = ("-" . $discount);
					$discount_text = '';
				}
			} else {

				$rates = explode(',', $this->config->get($this->name . '_rate'));

				foreach ($rates as $rate) {
					$data = explode(':', $rate);

					if ($data[0] >= $unit) {
						if (isset($data[1])) {
							$discount = $data[1];
							if (strpos($discount, '%') !== false) {
								$discount_text = '('.$data[1].')';
								$discount = trim($discount, '%');
								$discount = $subtotal * ($discount/100);
							} else {
								$discount_text = '';
							}
						}

						break;
					}
				}
			}


			// Deduct discount amount from taxable amount
			$tax_amount = 0;
			$tax_rates = 0;
			if ($discount != 0) {
				$discountRate = (trim($data[1],'%'))/100;
			} else {
				$discountRate = 0;
				$tax_rates = 0;
			}

			foreach ($this->cart->getProducts() as $product) {
				if ($product['tax_class_id']) {
					if (method_exists($this->tax, 'getRates')) { //v1.5.1.3 or later

						$tax_rates = $this->tax->getRates($product['total'], $product['tax_class_id']);

						foreach ($tax_rates as $tax_rate) {
							$tax_amount += $tax_rate['amount']*(1-$discountRate);
						}
					} else { //v1.5.1.2 or older
						$taxes[$product['tax_class_id']] -= ($product['total'] / 100 * $this->tax->getRate($product['tax_class_id'])) - (($product['total'] - $discount) / 100 * $this->tax->getRate($product['tax_class_id']));
					}
				}
			}

			if (method_exists($this->tax, 'getRates') && !empty($tax_rates) && is_array($tax_rates)) { //v1.5.1.3 or later
				reset($tax_rates);
				$tax_id = key($tax_rates);
				$taxes[$tax_id] = $tax_amount;
			}

			if ($discount) {
				$total_data[] = array(
					'code'		 => $this->name, //v15x
					'title'      => ($this->language->get('text_' . $this->name) . " $discount_text"),
					'text'       => '-'.$this->currency->format($discount),
					'value'      => $discount,
					'sort_order' => $this->config->get($this->name . '_sort_order')
				);

				$total -= $discount;
				$this->session->data['adflag'] = true;
			} else {
				unset($this->session->data['adflag']);
			}
		}
	}
}
?>