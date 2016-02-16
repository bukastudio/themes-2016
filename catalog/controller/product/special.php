<?php
class ControllerProductSpecial extends Controller {
	public function index() {
		$this->language->load('product/special');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		// Bukatoko
    if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
      $server = $this->config->get('config_ssl');
    } else {
      $server = $this->config->get('config_url');
    }
    // End


		if (isset($this->request->get['sort'])) {
      $sort = $this->request->get['sort'];
    } else {
      // $sort = 'p.sort_order';
      $sort = 'ps.date_end';
    }

    if (isset($this->request->get['order'])) {
      $order = $this->request->get['order'];
    } else {
      // $order = 'ASC';
      $order = 'ASC';
    }

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}

		$this->document->setTitle($this->language->get('heading_title'));
		//$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/special', $url),
			'separator' => $this->language->get('text_separator')
		);

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_empty'] = $this->language->get('text_empty');
		$this->data['text_quantity'] = $this->language->get('text_quantity');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_model'] = $this->language->get('text_model');
		$this->data['text_price'] = $this->language->get('text_price');
		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['text_points'] = $this->language->get('text_points');
		$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$this->data['text_display'] = $this->language->get('text_display');
		$this->data['text_list'] = $this->language->get('text_list');
		$this->data['text_grid'] = $this->language->get('text_grid');
		$this->data['text_sort'] = $this->language->get('text_sort');
		$this->data['text_limit'] = $this->language->get('text_limit');

		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_wishlist'] = $this->language->get('button_wishlist');
		$this->data['button_compare'] = $this->language->get('button_compare');

		$this->data['compare'] = $this->url->link('product/compare');

		$this->data['products'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $limit,
			'limit' => $limit
		);

		$product_total = $this->model_catalog_product->getTotalProductSpecials($data);

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
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
			} else {
				$tax = false;
			}

			if ($this->config->get('config_review_status')) {
				$rating = (int)$result['rating'];
			} else {
				$rating = false;
			}

			$this->data['products'][] = array(
				'product_id'  => $result['product_id'],
				// Bukatoko
				'quantity'  => $result['quantity'],
				'stock_status'  => $result['stock_status'],
				// End
				'thumb'       => $image,
				'name'        => $result['name'],
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
				'price'       => $price,
				'special'     => $special,
        'discount'    => $discount,
        'special_start' => $special_start, // Countdown Timer
        'special_end' => $special_end, // Countdown Timer
        'percentage' => $percentage, // Countdown Timer
				'tax'         => $tax,
				'rating'      => $result['rating'],
				'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url)
			);
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$this->data['sorts'] = array();

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'p.date_added-DESC',
			'href'  => $this->url->link('product/special', 'sort=p.date_added&order=DESC' . $url)
		);

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('product/special', 'sort=pd.name&order=ASC' . $url)
		);

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('product/special', 'sort=pd.name&order=DESC' . $url)
		);

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'ps.price-ASC',
			'href'  => $this->url->link('product/special', 'sort=ps.price&order=ASC' . $url)
		);

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'ps.price-DESC',
			'href'  => $this->url->link('product/special', 'sort=ps.price&order=DESC' . $url)
		);

		if ($this->config->get('config_review_status')) {
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('product/special', 'sort=rating&order=DESC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('product/special', 'sort=rating&order=ASC' . $url)
			);
		}

		$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/special', 'sort=p.model&order=ASC' . $url)
		);

		$this->data['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('product/special', 'sort=p.model&order=DESC' . $url)
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$this->data['limits'] = array();

		$limits = array_unique(array($this->config->get('config_catalog_limit'), 32, 48, 64, 80));

		sort($limits);

		foreach($limits as $value){
			$this->data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('product/special', $url . '&limit=' . $value)
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/special', $url . '&page={page}');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->data['limit'] = $limit;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/special.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/special.tpl';
		} else {
			$this->template = 'default/template/product/special.tpl';
		}

		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);

		$this->response->setOutput($this->render());
	}
}
?>
