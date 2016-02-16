<?php
class ControllerModuleSpecial extends Controller {
	protected function index($setting) {
		$this->language->load('module/special');

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

		$this->data['products'] = array();

		$data = array(
			'sort'  => 'ps.date_end',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);
    $this->data['size'] = $setting['catalog_size'];

		$results = $this->model_catalog_product->getProductSpecials($data);

		// Countdown Timer
if($this->config->get('countdowntimer_category')){
  $this->load->language('module/countdowntimer');
  $this->data['text_countdown'] = $this->language->get('text_countdown');

  $this->data['countdowntimer_category_texttimer'] = $this->config->get('countdowntimer_category_texttimer');
  $this->data['countdowntimer_category_days'] = $this->config->get('countdowntimer_category_days');
  $this->data['countdowntimer_category_countdays'] = $this->config->get('countdowntimer_category_countdays');
  $this->data['countdowntimer_category_seconds'] = $this->config->get('countdowntimer_category_seconds');

  if($this->config->get('countdowntimer_category_texttimer')){
    $this->data['config_language'] = $this->config->get('config_language');
    $this->data['text_countdown_days'] = $this->language->get('text_countdown_days');
    $this->data['text_countdown_hours'] = $this->language->get('text_countdown_hours');
    $this->data['text_countdown_minutes'] = $this->language->get('text_countdown_minutes');
    $this->data['text_countdown_seconds'] = $this->language->get('text_countdown_seconds');
  }
}
// End

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
        // Countdown Timer
        $special_end = $this->model_catalog_product->getProductSpecialData($result['product_id']);
        if($special_end['date_end'] && $this->config->get('countdowntimer_category') && time() < strtotime($special_end['date_end'])){
          $special_start = $special_end['date_start'];
          $special_end = $special_end['date_end'];
          $date_s = strtotime($special_start);
          $date_e = strtotime($special_end);
          $today = strtotime(date("Y-m-d"));
          $percentage = ($today - $date_s) / ($date_e - $date_s) * 100;

        }else{
          // Countdown Timer
          $special_start = false;
          $special_end = false;
          $date_s = false;
          $date_e = false;
          $today = false;
          $percentage = false;
          // End
        }
        // End
      } else {
        $special = false;
        $discount = false;
        // Countdown Timer
        $special_start = false;
        $special_end = false;
        $date_s = false;
        $date_e = false;
        $today = false;
        $percentage = false;
        // End
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
        'special_start' => $special_start, // Countdown Timer
        'special_end' => $special_end, // Countdown Timer
        'percentage' => $percentage, // Countdown Timer
				'rating'     => $rating,
        'discount'    => $discount,
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/special.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/special.tpl';
		} else {
			$this->template = 'default/template/module/special.tpl';
		}

		$this->render();
	}
}
?>
