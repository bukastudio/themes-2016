<?php
class ControllerModuleBestSeller extends Controller {
	protected function index($setting) {
		$this->language->load('module/bestseller');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['button_cart'] = $this->language->get('button_cart');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		// Bukatoko
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		// End
    $this->data['size'] = $setting['catalog_size'];

		$this->data['products'] = array();

		$results = $this->model_catalog_product->getBestSellerProducts($setting['limit']);

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
			} else {
				$image = false;
			}

				// Bukatoko
		    if ($this->config->get('config_sale_label') && file_exists(DIR_IMAGE . $this->config->get('config_sale_label'))) {
		      //$this->data['sale_label'] = HTTP_IMAGE . $this->config->get('config_sale_label');
		      $this->data['sale_label'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_sale_label')));
		    } else {
		      $this->data['sale_label'] = '';
		    }
		    // End

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			if ((float)$result['special']) {
	        $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
	        $discount = number_format((100 - ($result['special'] / $result['price']) * 100),0);
	      } else {
	        $special = false;
	        $discount = false;
	      }

			if ($this->config->get('config_review_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}

			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
					// Bukatoko
					'quantity'  => $result['quantity'],
					'stock_status'  => $result['stock_status'],
					// End
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'price'   	 => $price,
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
				'special' 	 => $special,
        'discount'    => $discount,
				'rating'     => $rating,
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/bestseller.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/bestseller.tpl';
		} else {
			$this->template = 'default/template/module/bestseller.tpl';
		}

		$this->render();
	}
}
?>
