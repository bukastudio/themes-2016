<?php

class ControllerPosPos extends Controller {

    private $error = array();

    public function index() {

        $this->data['dicount_status'] = $this->config->get('discount_status');
        $this->data['logged'] = '<span></span><span class="name">' . $this->user->getUserName().'</span>';

        $this->load->model('setting/setting');
        $this->load->model('pos/pos');
        $this->load->model('tool/image');

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);
        $this->cart->clear();

        //set store id
        $this->data['store_id'] = $this->getStoreId();
        $this->session->data['store_id'] = $this->data['store_id'];
        $this->model_pos_pos->loadConfig();//load pos configuration
        $this->currency->set($this->config->get('config_currency'));

        unset($this->session->data['voucher']);
        unset($this->session->data['coupon']);
        unset($this->session->data['discount_amount']);
        unset($this->session->data['discount_type']);

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->language->load('pos/pos');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->data['user'] = $this->user->getUserName();

        $default_country_id = $this->config->get('config_country_id');
        $default_zone_id = $this->config->get('config_zone_id');

        $this->data['currency_code'] = $this->config->get('config_currency');
        $this->data['currency_value'] = '1.0';
        $this->data['token'] = $this->session->data['token'];
        $this->data['text_select'] = 'Select';
        $this->data['button_upload'] = 'Upload';

        if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
            $this->data['logo'] = HTTP_IMAGE . $this->config->get('config_logo');
        } else {
            $this->data['logo'] = '';
        }

        //get categories
        $categories = $this->model_pos_pos->getTopCategories();

        $this->data['categories'] = array();

        foreach ($categories as $category_info) {
            $this->data['categories'][] = array(
                'category_id' => $category_info['category_id'],
                //'image' => $category_info['image'] ? 'view/image/pos/logo.png' : 'view/image/pos/logo.png',
                'image' => $category_info['image'] ? $this->model_tool_image->resize($category_info['image'], 64, 64) : 'view/image/pos/logo.png',
                'name' => $category_info['name'],
            );
        }

        $balance = $this->model_pos_pos->get_user_balance($this->user->getId());
        $this->data['cash'] = $this->currency->format($balance['cash']);
        $this->data['card'] = $this->currency->format($balance['card']);
        $this->data['hold_carts'] = $this->model_pos_pos->get_hold_cart_list();

        $this->load->model('setting/store');
        $this->data['stores'] = $this->model_setting_store->getStores();

        //load template
        $this->template = 'pos/index.tpl';
        $this->response->setOutput($this->render());
    }

    public function saveInvoice(){
        $this->session->data['invoice_html'] = $this->request->post['html'];
    }

    public function confirm(){

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax');
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart');
        $this->cart = new Pos_cart($this->registry);

        //list payment methods available
        $payment_address['country_id'] =  $this->config->get('config_country_id');
        $payment_address['zone_id'] =  $this->config->get('config_zone_id');

        $total = $this->cart->getTotal();
        $results = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'payment'")->rows;
        $cart_has_recurring = $this->cart->hasRecurringProducts();

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->language->load('payment/' . $result['code'], true);//load catalog language
                $this->load->model('payment/' . $result['code'], true);//load catalog model
                $method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);
                if ($method) {
                    if ($cart_has_recurring > 0) {
                        if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments')) {
                            if ($this->{'model_payment_' . $result['code']}->recurringPayments() == true) {
                                $method_data[$result['code']] = $method;
                            }
                        }
                    } else {
                        $method_data[$result['code']] = $method;
                    }
                }
            }
        }
        $sort_order = array();
        foreach ($method_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
        }
        array_multisort($sort_order, SORT_ASC, $method_data);

        $this->data['payment_methods'] = $method_data;
        $this->data['token'] = $this->session->data['token'];

        //load template
        $this->template = 'pos/confirm.tpl';
        $this->response->setOutput($this->render());
    }

    public function updateConfirm(){

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax');
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart');
        $this->cart = new Pos_cart($this->registry);

        //list payment methods available
        $payment_address['country_id'] =  $this->config->get('config_country_id');
        $payment_address['zone_id'] =  $this->config->get('config_zone_id');

        $total = $this->cart->getTotal();
        $results = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'payment'")->rows;
        $cart_has_recurring = $this->cart->hasRecurringProducts();

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->language->load('payment/' . $result['code'], true);//load catalog language
                $this->load->model('payment/' . $result['code'], true);//load catalog model
                $method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);
                if ($method) {
                    if ($cart_has_recurring > 0) {
                        if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments')) {
                            if ($this->{'model_payment_' . $result['code']}->recurringPayments() == true) {
                                $method_data[$result['code']] = $method;
                            }
                        }
                    } else {
                        $method_data[$result['code']] = $method;
                    }
                }
            }
        }
        $sort_order = array();
        foreach ($method_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
        }
        array_multisort($sort_order, SORT_ASC, $method_data);

        $this->data['payment_methods'] = $method_data;
        $this->data['token'] = $this->session->data['token'];

        //load template
        $this->template = 'pos/update_confirm.tpl';
        $this->response->setOutput($this->render());
    }

    public function get_total() {

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        echo $this->currency->format($total, false, false, false);
    }

    public function product() {


        $this->language->load('pos/product');
        $this->load->model('setting/setting');
        $this->load->model('pos/pos');
        $this->load->model('tool/image');

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $product_id = $this->request->get['product_id'];
        $this->data['currency_code'] = $this->config->get('config_currency');
        $this->data['currency_value'] = '1.0';
        $this->data['store_id'] = $this->getStoreId();
        $product_info = $this->model_pos_pos->getProduct($product_id);

        if ($product_info) {

            $this->data['heading_title'] = $product_info['name'];
            $this->data['text_select'] = $this->language->get('text_select');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_reward'] = $this->language->get('text_reward');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_discount'] = $this->language->get('text_discount');
            $this->data['text_stock'] = $this->language->get('text_stock');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_discount'] = $this->language->get('text_discount');
            $this->data['text_option'] = $this->language->get('text_option');
            $this->data['text_qty'] = $this->language->get('text_qty');
            $this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
            $this->data['text_or'] = $this->language->get('text_or');
            $this->data['text_write'] = $this->language->get('text_write');
            $this->data['text_note'] = $this->language->get('text_note');
            $this->data['text_share'] = $this->language->get('text_share');
            $this->data['text_wait'] = $this->language->get('text_wait');
            $this->data['text_tags'] = $this->language->get('text_tags');

            $this->data['entry_name'] = $this->language->get('entry_name');
            $this->data['entry_review'] = $this->language->get('entry_review');
            $this->data['entry_rating'] = $this->language->get('entry_rating');
            $this->data['entry_good'] = $this->language->get('entry_good');
            $this->data['entry_bad'] = $this->language->get('entry_bad');
            $this->data['entry_captcha'] = $this->language->get('entry_captcha');

            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_upload'] = $this->language->get('button_upload');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->load->model('catalog/review');

            $this->data['tab_description'] = $this->language->get('tab_description');
            $this->data['product_id'] = $this->request->get['product_id'];
            $this->data['model'] = $product_info['model'];

            if ($product_info['quantity'] <= 0) {
                $this->data['stock'] = $product_info['stock_status'];
            } elseif ($this->config->get('config_stock_display')) {
                $this->data['stock'] = $product_info['quantity'];
            } else {
                $this->data['stock'] = $this->language->get('text_instock');
            }

            $this->load->model('tool/image');

            if ($product_info['image']) {
                //$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
                $this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 124, 124);
            } else {
                $this->data['thumb'] = '';
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $this->data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $this->data['price'] = false;
            }

            if ((float) $product_info['special']) {
                $this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $this->data['special'] = false;
            }

            if ($this->config->get('config_tax')) {
                $this->data['tax'] = $this->currency->format((float) $product_info['special'] ? $product_info['special'] : $product_info['price']);
            } else {
                $this->data['tax'] = false;
            }

            $this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');

            //load template
            $this->template = 'pos/product.tpl';
            $this->response->setOutput($this->render());
        }
    }

    public function removeFromCart() {

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->model('catalog/product');

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);
        $this->cart->remove($this->request->post['remove']);

        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $json = array();
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;
        $json['total'] = $this->currency->format($total);

        echo json_encode($json);
    }

    public function addToCart() {

        //load store config
        $this->load->model('setting/setting');
        $this->load->model('pos/pos');

        $json = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $this->load->model('catalog/product');

        if (isset($this->request->post['product_id'])) {
            $product_id = $this->request->post['product_id'];
        } else {
            $product_id = 0;
        }

        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {
            if (isset($this->request->post['quantity'])) {
                $quantity = $this->request->post['quantity'];
            } else {
                $quantity = 1;
            }

            if (isset($this->request->post['option'])) {
                $option = array_filter($this->request->post['option']);
            } else {
                $option = array();
            }

            $product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

            foreach ($product_options as $product_option) {
                if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
                    $json['error']['option'][$product_option['product_option_id']] = sprintf('%s field required', $product_option['name']);
                }
            }

            if (!$json) {

                $this->cart->add($this->request->post['product_id'], $quantity, $option);

                //validate
                $err_validation = $this->validateCart();

                if(!empty($err_validation)){
                    $json['error'] = $err_validation;
                    $json['status'] = 0;
                    $this->cart->remove($product_id);//revert product add
                } else {
                    $json['success'] = 1;
                    $json['status'] = 1;
                }

                // Totals
                $this->load->model('pos/extension');

                $total_data = array();
                $total = 0;
                $taxes = $this->cart->getTaxes();

                // Display prices
                $sort_order = array();

                $results = $this->model_pos_extension->getExtensions('total');

                foreach ($results as $key => $value) {
                    $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
                }

                array_multisort($sort_order, SORT_ASC, $results);

                foreach ($results as $result) {
                    if ($this->config->get($result['code'] . '_status')) {
                        $this->load->model('pos/' . $result['code']);

                        $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
                    }

                    $sort_order = array();

                    foreach ($total_data as $key => $value) {
                        $sort_order[$key] = $value['sort_order'];
                    }

                    array_multisort($sort_order, SORT_ASC, $total_data);
                }

                $json['total_data'] = $total_data;
                $json['total'] = $this->currency->format($total);
            }
        }

        //html for cart
        $json['products'] = array();

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'name' => $option['name'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type']
                );
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($product['price']);
            } else {
                $price = false;
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
            } else {
                $total = false;
            }

            //tax
            $a = $product['price'] * $product['quantity'];
            $b = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
            $tax = $this->currency->format($b - $a);

            $json['products'][] = array(
                'key' => $product['key'],
                'name' => $product['name'],
                'model' => $product['model'],
                'option' => $option_data,
                'quantity' => $product['quantity'],
                'price' => $price,
                'tax' => $tax,
                'total' => $total,
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
            );
        }

        $this->response->setOutput(json_encode($json));
    }

    function validateCart(){

        $error = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $products = $this->cart->getProducts();

        foreach ($products as $product) {
            if (!$product['stock']) {
                $error[] = 'Products named ('.$product['name'].') is not available in the desired quantity or not in stock!';
            }
        }
        if($error)
            return $error;
        else
            return false;
    }

    public function updateCart() {

        $qty = $this->request->post['quantity'];
        $key = $this->request->post['key'];

        $qty_bkp = $this->session->data['cart'][$key];//backup for restore if error in cart
        $this->session->data['cart'][$key] = (int) $qty;

        //validate
        $err_validation = $this->validateCart();

        if(!empty($err_validation)){
            $json['error'] = $err_validation;
            $json['status'] = 0;
            $this->session->data['cart'][$key] = (int) $qty_bkp;//revert qty update
        } else {
            $json['success'] = 1;
            $json['status'] = 1;
        }

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;
        $json['total'] = $this->currency->format($total);

        //html for cart
        $json['products'] = array();

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'name' => $option['name'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type']
                );
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($product['price']);
            } else {
                $price = false;
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
            } else {
                $total = false;
            }

            //tax
            $a = $product['price'] * $product['quantity'];
            $b = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
            $tax = $this->currency->format($b - $a);

            $json['products'][] = array(
                'key' => $product['key'],
                'name' => $product['name'],
                'model' => $product['model'],
                'option' => $option_data,
                'quantity' => $product['quantity'],
                'price' => $price,
                'total' => $total,
                'tax' => $tax,
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
            );
        }

        $this->response->setOutput(json_encode($json));
    }

    public function install() {
        /*
          if (!$this->checkVqmod()) {
          // not existing
          $this->language->load('pos/pos');
          $this->session->data['error'] = $this->language->get('text_vqmod_not_installed');
          $this->load->model('setting/extension');
          // remove from the extension table
          $this->model_setting_extension->uninstall('module', 'pos');
          return false;
          }
         */

        // create tables
        $this->load->model('pos/pos');
        // add default settings
        $this->load->model('setting/setting');
        // create vqmod files
        $this->createFile();

        // copy language file is English not set to default
        //$this->copyLangFile();
        //$this->model_setting_setting->editSetting('POS', array('pos_user_group_id' => 'Credit Card'));
        // add permission for report
        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getId(), 'access', 'pos/pos');
        $this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'pos/pos');
    }

    public function uninstall() {
        // $this->load->model('pos/pos');
        // $this->model_pos_pos->deleteModuleTables();

        $this->load->model('setting/setting');

        // remove the files
        $this->deleteFile();


        // $this->model_setting_setting->deleteSetting('POS');
    }

    private function checkVqmod() {
        return file_exists(DIR_APPLICATION . '/../vqmod');
    }

    private function createFile() {
        $path = dirname(DIR_APPLICATION);
        rename($path . '/pos_', $path . '/pos');

        //set module status = 1
        $this->model_setting_setting->editSetting('pos', array('pos_user_group_id' => 1, 'pos_status' => 1));

        //rename(DIR_APPLICATION.'../admin/controller/pos/pos.php_',DIR_APPLICATION.'../admin/controller/pos/pos.php');
        unlink(DIR_APPLICATION . '../vqmod/mods.cache');
        rename(DIR_APPLICATION . '../vqmod/xml/pos.xml_', DIR_APPLICATION . '../vqmod/xml/pos.xml');
    }

    private function deleteFile() {
        //set module status = 0
        $this->model_setting_setting->editSetting('pos', array('pos_user_group_id' => 1, 'pos_status' => 0));

        //rename(DIR_APPLICATION.'../admin/controller/pos/pos.php',DIR_APPLICATION.'../admin/controller/pos/pos.php_');
        rename(DIR_APPLICATION . '../vqmod/xml/pos.xml', DIR_APPLICATION . '../vqmod/xml/pos.xml_');

        $path = dirname(DIR_APPLICATION);
        rename($path . '/pos', $path . '/pos_');
        //unlink(DIR_APPLICATION . '../vqmod/xml/pos.xml');
    }

    private function getStoreId() {

        $pos_default_store = $this->config->get('pos_default_store');

        if (isset($this->request->get['store_id'])) {
            $store_id = $this->request->get['store_id'];
        } else if(isset($pos_default_store)){
            $store_id = $pos_default_store;
        } else {
            $store_id = 0;
            // get the default store id
            $this->load->model('setting/store');
            $stores = $this->model_setting_store->getStores();
            if (!empty($stores)) {
                $store_id = $stores[0]['store_id'];
            }
        }
        return $store_id;
    }

    public function searchCustomer() {
        $this->load->model('pos/pos');
        $q = $this->request->get['q'];
        $json = $this->model_pos_pos->searchCustomer($q);
        return $this->response->setOutput(json_encode($json));
    }

    public function searchProducts() {

        $this->load->model('pos/pos');

        if (isset($this->request->post['q'])) {
            $q = $this->request->post['q'];
        } else {
            $q = '';
        }

        if (isset($this->request->post['page'])) {
            $page = $this->request->post['page'];
        } else {
            $page = 1;
        }

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $total = $this->model_pos_pos->total_search_products($q);

        $products = $this->model_pos_pos->searchProducts($q, $limit, $offset);

        //check if last page
        $total_pages = ceil($total / $limit);
        if ($total_pages > $page) {
            $json['has_more'] = 1;
        }

        $json['products'] = array();
        foreach ($products as $product) {
            $json['products'][] = array('type' => 'P',
                'name' => $product['name'],
                'image' => !empty($product['image']) ? '../image/' . $product['image'] : '../image/no_image.jpg',
                'price_text' => $this->currency->format($product['price']), //, $currency_code, $currency_value
                //'stock_text' => $product['quantity'], // . ' ' . $this->language->get('text_remaining'),
                'hasOptions' => $product['options'] ? '1' : '0',
                'id' => $product['product_id']
            );
        }

        return $this->response->setOutput(json_encode($json));
    }

    public function getCategoryItems() {
        $json['categories'] = $json['products'] = array();
        $parent_category_id = $this->request->post['category_id'];
        // get the direct sub-category and product in the given category
        $this->load->model('pos/pos');
        $sub_categories = $this->model_pos_pos->getSubCategories($parent_category_id);

        if (isset($this->request->post['page'])) {
            $page = $this->request->post['page'];
        } else {
            $page = 1;
        }

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $total = $this->model_pos_pos->total_products($parent_category_id);

        if ($page == 1) {
            foreach ($sub_categories as $sub_category) {
                $json['categories'][] = array('type' => 'C',
                    'name' => $sub_category['name'],
                    'image' => !empty($sub_category['image']) ? '../image/' . $sub_category['image'] : '../image/folder.jpg',
                    'id' => $sub_category['category_id']
                );
            }
            //$category_offset = sizeof($json['categories']);
            //$offset += $category_offset;
            //$limit  -= $category_offset;
        }

        //check if last page
        if (($offset + $limit) < $total) {
            $json['has_more'] = 1;
        }

        $products = $this->model_pos_pos->getProducts($parent_category_id, $limit, $offset);

        $this->language->load('pos/pos');

        foreach ($products as $product) {
            $json['products'][] = array('type' => 'P',
                'name' => $product['name'],
                'image' => !empty($product['image']) ? '../image/' . $product['image'] : '../image/no_image.jpg',
                'price_text' => $this->currency->format($product['price']), //, $currency_code, $currency_value
                'stock_text' => $product['quantity'], // . ' ' . $this->language->get('text_remaining'),
                'hasOptions' => $product['options'] ? '1' : '0',
                'id' => $product['product_id']
            );
        }

        return $this->response->setOutput(json_encode($json));
    }

    public function getProductOptions() {
        $json = array();
        $option_data = array();

        $this->load->model('catalog/product');
        $this->load->model('catalog/option');
        $product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

        foreach ($product_options as $product_option) {
            $option_info = $this->model_catalog_option->getOption($product_option['option_id']);

            if ($option_info) {
                if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
                    $option_value_data = array();

                    foreach ($product_option['product_option_value'] as $product_option_value) {
                        $option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

                        if ($option_value_info) {
                            $option_value_data[] = array(
                                'product_option_value_id' => $product_option_value['product_option_value_id'],
                                'option_value_id' => $product_option_value['option_value_id'],
                                'name' => $option_value_info['name'],
                                'price' => (float) $product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
                                'price_prefix' => $product_option_value['price_prefix']
                            );
                        }
                    }

                    $option_data[] = array(
                        'product_option_id' => $product_option['product_option_id'],
                        'option_id' => $product_option['option_id'],
                        'name' => $option_info['name'],
                        'type' => $option_info['type'],
                        'option_value' => $option_value_data,
                        'required' => $product_option['required']
                    );
                } else {
                    $option_data[] = array(
                        'product_option_id' => $product_option['product_option_id'],
                        'option_id' => $product_option['option_id'],
                        'name' => $option_info['name'],
                        'type' => $option_info['type'],
                        'option_value' => $product_option['option_value'],
                        'required' => $product_option['required']
                    );
                }
            }
        }

        $json['option_data'] = $option_data;
        $this->response->setOutput(json_encode($json));
    }

    public function addOrder() {

        unset($this->session->data['shipping_method']);

        $data = array(); $errors = '';
        $pg_type = $this->request->post['pg_type'];

        $payment_method = $this->request->post['payment_method'];
        $is_guest = $this->request->post['is_guest'];
        $customer_id = $this->request->post['customer_id'];
        $card_no = $this->request->post['card_no'];
        $data['comment'] = $this->request->post['comment'];

        if ($is_guest == 'false' && $customer_id == '') {
            $errors .= 'Select the customer.<br />';
        }

        if (($payment_method == 'Card') && $card_no == '') {
            $errors .= 'Enter the card number.<br />';
        }

        if ($errors != '') {
            $data['errors'] = $errors;
            $this->response->setOutput(json_encode($data));
            return;
        }

        $this->load->model('pos/pos');

        $data['store_id'] = $this->getStoreId();

        $default_country_id = $this->config->get('config_country_id');
        $default_zone_id = $this->config->get('config_zone_id');

        $data['shipping_country_id'] = $default_country_id;
        $data['shipping_zone_id'] = $default_zone_id;
        $data['payment_country_id'] = $default_country_id;
        $data['payment_zone_id'] = $default_zone_id;
        $data['customer_id'] = 0;
        $data['customer_group_id'] = 1;
        $data['firstname'] = 'Walkin';
        $data['lastname'] = "Customer";
        $data['email'] = '';
        $data['telephone'] = '';
        $data['fax'] = '';

        $data['payment_firstname'] = 'Walkin';
        $data['payment_lastname'] = "Customer";
        $data['payment_company'] = '';
        $data['payment_company_id'] = '';
        $data['payment_tax_id'] = '';
        $data['payment_address_1'] = '';
        $data['payment_address_2'] = '';
        $data['payment_city'] = '';
        $data['payment_postcode'] = '';
        $data['payment_country_id'] = '';
        $data['payment_zone_id'] = '';
        $data['payment_method'] = $payment_method;
        $data['payment_code'] = 'in_store';
        $data['shipping_firstname'] = '';
        $data['shipping_lastname'] = '';
        $data['shipping_company'] = '';
        $data['shipping_address_1'] = '';
        $data['shipping_address_2'] = '';
        $data['shipping_city'] = '';
        $data['shipping_postcode'] = '';
        $data['shipping_country_id'] = '';
        $data['shipping_zone_id'] = '';
        $data['shipping_method'] = 'Pickup From Store';
        $data['shipping_code'] = 'pickup.pickup';
        $data['affiliate_id'] = 0;
        $data['card_no'] = $card_no;
        $data['user_id'] = $this->user->getId();

        if($pg_type=='opencart'){
            $data['order_status_id'] = 0;//opencart payment option chosen
        }else{
            $data['order_status_id'] = $this->config->get('config_order_status_id');//pos payment options chosen
        }

        //override for customer
        if ($is_guest == 'false') {
            $customer = $this->model_pos_pos->getCustomer($customer_id);
            $data['customer_id'] = $customer_id;
            $data['customer_group_id'] = $customer['customer_group_id'];
            $data['firstname'] = $customer['firstname'];
            $data['lastname'] = $customer['lastname'];
            $data['email'] = $customer['email'];
            $data['telephone'] = $customer['telephone'];
            $data['fax'] = $customer['fax'];
            $data['payment_firstname'] = $customer['firstname'];
            $data['payment_lastname'] = $customer['lastname'];
        }

        //get product list
        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $data['order_product'] = array();

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'product_option_id' => $option['product_option_id'],
                    'product_option_value_id' => $option['product_option_value_id'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type'],
                    'name' => $option['name'],
                );
            }

            $data['order_product'][] = array(
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'model' => $product['model'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'total' => $product['price'] * $product['quantity'],
                'tax' => $this->tax->getTax($product['price'], $product['tax_class_id']),
                'reward' => $product['reward'],
                'order_option' => $option_data,
            );
        }//foreach products

        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $data['order_total'] = $total_data;
        $data['total'] = $total;

        if (isset($this->session->data['voucher'])) {
            $data['order_voucher'] = $this->session->data['voucher'];
        }

        // Gift Voucher
        $voucher_data = array();

        if (!empty($this->session->data['vouchers'])) {
                foreach ($this->session->data['vouchers'] as $voucher) {
                        $voucher_data[] = array(
                                'description'      => $voucher['description'],
                                'code'             => substr(md5(mt_rand()), 0, 10),
                                'to_name'          => $voucher['to_name'],
                                'to_email'         => $voucher['to_email'],
                                'from_name'        => $voucher['from_name'],
                                'from_email'       => $voucher['from_email'],
                                'voucher_theme_id' => $voucher['voucher_theme_id'],
                                'message'          => $voucher['message'],
                                'amount'           => $voucher['amount']
                        );
                }
        }

        $data['vouchers'] = $voucher_data;

        //end of order total
        $json['customer_name'] = $data['firstname'] . ' ' . $data['lastname'];

        $order_id = $this->model_pos_pos->addOrder($data);

        unset($this->session->data['discount_amount']);
        unset($this->session->data['discount_type']);

        if($pg_type=='pos'){
            if ($payment_method == 'Card') {
                $cash = 0;
                $card = $total;
            } else {
                $cash = $total;
                $card = 0;
            }
            $data = array(
                'user_id' => $this->user->getId(),
                'cash' => $cash,
                'card' => $card,
            );
            $this->model_pos_pos->addPayment($data);
        }else{
            $this->session->data['order_user_id'] =  $this->user->getId();
            $this->session->data['order_id'] = $order_id;
            $this->session->data['payment_method']['code'] = $payment_method;
            $json['payment_link'] = HTTP_CATALOG.'index.php?route=pos/index';
        }

        $json['order_id'] = $order_id;
        $balance = $this->model_pos_pos->get_user_balance($this->user->getId());
        $json['cash'] = $this->currency->format($balance['cash']);
        $json['card'] = $this->currency->format($balance['card']);
        $json['success'] = 'Success: new order placed with ID: ' . $order_id;
        $this->response->setOutput(json_encode($json));
    }
    //END add order

    public function discount() {

        $json = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $this->session->data['discount_amount'] = $this->request->post['discount_amount'];
        $this->session->data['discount_type'] = $this->request->post['discount_type'];

        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;

        $this->response->setOutput(json_encode($json));
    }

    public function editOrder() {

        unset($this->session->data['shipping_method']);

        $data = array(); $errors = '';
        $pg_type = $this->request->post['pg_type'];

        /*
          customer_id
          is_guest
          card_no
         */

        //validation
        $errors = '';

        $payment_method = $this->request->post['payment_method'];
        $is_guest = $this->request->post['is_guest'];
        $customer_id = $this->request->post['customer_id'];
        $card_no = $this->request->post['card_no'];
        $order_id = $this->request->post['order_id'];
        $data['comment'] = $this->request->post['comment'];

        if ($is_guest == 'false' && $customer_id == '') {
            $errors .= 'Select the customer.<br />';
        }

        if (($payment_method == 'Card') && $card_no == '') {
            $errors .= 'Enter the card number.<br />';
        }

        if ($errors != '') {
            $data['errors'] = $errors;
            $this->response->setOutput(json_encode($data));
            return;
        }

        $this->load->model('pos/pos');

        $data['store_id'] = $this->getStoreId();

        $default_country_id = $this->config->get('config_country_id');
        $default_zone_id = $this->config->get('config_zone_id');

        $data['shipping_country_id'] = $default_country_id;
        $data['shipping_zone_id'] = $default_zone_id;
        $data['payment_country_id'] = $default_country_id;
        $data['payment_zone_id'] = $default_zone_id;
        $data['customer_id'] = 0;
        $data['customer_group_id'] = 1;
        $data['firstname'] = 'Walkin';
        $data['lastname'] = "Customer";
        $data['email'] = '';
        $data['telephone'] = '';
        $data['fax'] = '';

        $data['payment_firstname'] = 'Walkin';
        $data['payment_lastname'] = "Customer";
        $data['payment_company'] = '';
        $data['payment_company_id'] = '';
        $data['payment_tax_id'] = '';
        $data['payment_address_1'] = '';
        $data['payment_address_2'] = '';
        $data['payment_city'] = '';
        $data['payment_postcode'] = '';
        $data['payment_country_id'] = '';
        $data['payment_zone_id'] = '';
        $data['payment_method'] = $payment_method;
        $data['payment_code'] = 'in_store';
        $data['shipping_firstname'] = '';
        $data['shipping_lastname'] = '';
        $data['shipping_company'] = '';
        $data['shipping_address_1'] = '';
        $data['shipping_address_2'] = '';
        $data['shipping_city'] = '';
        $data['shipping_postcode'] = '';
        $data['shipping_country_id'] = '';
        $data['shipping_zone_id'] = '';
        $data['shipping_method'] = 'Pickup From Store';
        $data['shipping_code'] = 'pickup.pickup';
        $data['order_status_id'] = 5;


        $data['affiliate_id'] = 0;
        $data['card_no'] = $card_no;
        $data['user_id'] = $this->user->getId();

        //override for customer
        if ($is_guest == 'false') {

            $customer = $this->model_pos_pos->getCustomer($customer_id);

            $data['customer_id'] = $customer_id;
            $data['customer_group_id'] = $customer['customer_group_id'];
            $data['firstname'] = $customer['firstname'];
            $data['lastname'] = $customer['lastname'];
            $data['email'] = $customer['email'];
            $data['telephone'] = $customer['telephone'];
            $data['fax'] = $customer['fax'];

            $data['payment_firstname'] = $customer['firstname'];
            $data['payment_lastname'] = $customer['lastname'];
        }

        //get product list
        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $data['order_product'] = array();

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'product_option_id' => $option['product_option_id'],
                    'product_option_value_id' => $option['product_option_value_id'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type'],
                    'name' => $option['name'],
                );
            }

            $data['order_product'][] = array(
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'model' => $product['model'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'total' => $product['price'] * $product['quantity'],
                'tax' => $this->tax->getTax($product['price'], $product['tax_class_id']),
                'reward' => $product['reward'],
                'order_option' => $option_data,
            );
        }//foreach products

        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $data['order_total'] = $total_data;

        if (isset($this->session->data['voucher'])) {
            $data['order_voucher'] = $this->session->data['voucher'];
        }

        // Gift Voucher
        $voucher_data = array();

        if (!empty($this->session->data['vouchers'])) {
                foreach ($this->session->data['vouchers'] as $voucher) {
                        $voucher_data[] = array(
                                'description'      => $voucher['description'],
                                'code'             => substr(md5(mt_rand()), 0, 10),
                                'to_name'          => $voucher['to_name'],
                                'to_email'         => $voucher['to_email'],
                                'from_name'        => $voucher['from_name'],
                                'from_email'       => $voucher['from_email'],
                                'voucher_theme_id' => $voucher['voucher_theme_id'],
                                'message'          => $voucher['message'],
                                'amount'           => $voucher['amount']
                        );
                }
        }

        $data['vouchers'] = $voucher_data;

        if($pg_type=='pos'){
            //record for counter payment
            $payment = array(
                'user_id' => $this->user->getId(),
                'total' => $total,
                'payment_method' => $payment_method
            );
            $this->model_pos_pos->editPayment($order_id, $payment);
        }else{
            $this->session->data['order_user_id'] = $data['user_id'];
            $this->session->data['order_id'] = $order_id;
            $this->session->data['payment_method']['code'] = $payment_method;
            $json['payment_link'] = HTTP_CATALOG.'index.php?route=pos/index';
        }

        $this->model_pos_pos->editOrder($order_id, $data);
        unset($this->session->data['discount_amount']);
        $json['order_id'] = $order_id;
        $json['customer_name'] = $data['firstname'] . ' ' . $data['lastname'];

        $balance = $this->model_pos_pos->get_user_balance($this->user->getId());
        $json['cash'] = $this->currency->format($balance['cash']);
        $json['card'] = $this->currency->format($balance['card']);

        $json['success'] = 'Success: Order data updated with ID: ' . $order_id;

        $this->response->setOutput(json_encode($json));
    }

    public function getProductByBarcode() {
        if ($this->request->post['barcode']) {
            $barcode = $this->request->post['barcode'];
        } else {
            $barcode = false;
        }

        $this->load->model('pos/pos');

        $product = $this->model_pos_pos->getProductByBarcode($barcode);

        $json['product_id'] = $product['product_id'];

        $json['has_option'] = $product['options'] ? '1' : '0';

        $this->response->setOutput(json_encode($json));
    }

    public function coupon() {

        $json = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);


        $this->load->model('pos/coupon');


        $coupon_info = $this->model_pos_coupon->getCoupon($this->request->post['coupon']);

        if ($coupon_info) {
            $this->session->data['coupon'] = $this->request->post['coupon'];
        }

        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;

        $this->response->setOutput(json_encode($json));
    }

    public function voucher() {

        $json = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);


        $this->load->model('pos/voucher');

        $voucher_info = $this->model_pos_voucher->getVoucher($this->request->post['voucher']);

        if ($voucher_info) {
            $this->session->data['voucher'] = $this->request->post['voucher'];
        }

        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;

        $this->response->setOutput(json_encode($json));
    }

    public function logout() {
        $this->user->logout();

        unset($this->session->data['token']);

        $this->redirect($this->url->link('pos/pos', '', 'SSL'));
    }

    public function orders() {

        $this->document->setTitle($this->language->get('heading_title'));

        $limit = 6; //per page limit

        $page = 1;

        $data = array(
            'order' => 'DESC',
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        );

        $this->load->model('sale/order');

        $order_total = $this->model_sale_order->getTotalOrders($data);

        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        $this->data['rows'] = $this->model_sale_order->getOrders($data);
        $this->data['text_missing'] = 'Missing Orders';
        $this->data['currency_code'] = $this->config->get('config_currency');
        $this->data['currency_value'] = '1.0';
        $this->data['store_id'] = $this->getStoreId();
        $this->data['token'] = $this->session->data['token'];

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('pos/pos/ordersAJAX', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_order_id'] = '';
        $this->data['filter_customer'] = '';
        $this->data['filter_order_status_id'] = '';
        $this->data['filter_total'] = '';
        $this->data['filter_date_added'] = '';
        $this->data['filter_date_modified'] = '';

        $this->template = 'pos/orders.tpl';

        $this->response->setOutput($this->render());
    }

    /*
     * List order
     */
    public function ordersAJAX() {

        $this->document->setTitle($this->language->get('heading_title'));

        $limit = 6; //per page limit

        if (isset($this->request->get['filter_order_id'])) {
            $filter_order_id = $this->request->get['filter_order_id'];
        } else {
            $filter_order_id = null;
        }

        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = $this->request->get['filter_customer'];
        } else {
            $filter_customer = null;
        }

        if (isset($this->request->get['filter_order_status_id'])) {
            $filter_order_status_id = $this->request->get['filter_order_status_id'];
        } else {
            $filter_order_status_id = null;
        }

        if (isset($this->request->get['filter_total'])) {
            $filter_total = $this->request->get['filter_total'];
        } else {
            $filter_total = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
        } else {
            $filter_date_modified = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.order_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status_id'])) {
            $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }

        if (isset($this->request->get['filter_total'])) {
            $url .= '&filter_total=' . $this->request->get['filter_total'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data = array(
            'filter_order_id' => $filter_order_id,
            'filter_customer' => $filter_customer,
            'filter_order_status_id' => $filter_order_status_id,
            'filter_total' => $filter_total,
            'filter_date_added' => $filter_date_added,
            'filter_date_modified' => $filter_date_modified,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $limit,
            'limit' => $limit
        );

        $this->load->model('sale/order');

        $order_total = $this->model_sale_order->getTotalOrders($data);

        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $rows = $this->model_sale_order->getOrders($data);

        $this->data['rows'] = array();

        foreach ($rows as $row) {
            $row['total'] = $this->currency->format($row['total']);
            $this->data['rows'][] = $row;
        }

        $this->data['text_missing'] = 'Missing Orders';
        $this->data['currency_code'] = $this->config->get('config_currency');
        $this->data['currency_value'] = '1.0';
        $this->data['store_id'] = $this->getStoreId();
        $this->data['token'] = $this->session->data['token'];

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('pos/pos/ordersAJAX', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_order_id'] = $filter_order_id;
        $this->data['filter_customer'] = $filter_customer;
        $this->data['filter_order_status_id'] = $filter_order_status_id;
        $this->data['filter_total'] = $filter_total;
        $this->data['filter_date_added'] = $filter_date_added;
        $this->data['filter_date_modified'] = $filter_date_modified;

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode($this->data);
        } else {
            $this->template = 'pos/orders.tpl';
            $this->response->setOutput($this->render());
        }
    }

    //get order
    public function getOrder() {

        $this->load->model('sale/order');

        $json = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        $this->load->model('catalog/product');

        $order_products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
        $this->cart->clear();
        foreach ($order_products as $order_product) {
            if (isset($order_product['order_option'])) {
                $order_option = $order_product['order_option'];
            } elseif (isset($this->request->get['order_id'])) {
                $order_option = $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $order_product['order_product_id']);
            } else {
                $order_option = array();
            }

            $this->cart->add($order_product['product_id'], $order_product['quantity'], $order_option);
        }

        //html for cart
        $json['products'] = array();

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'name' => $option['name'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type']
                );
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($product['price']);
            } else {
                $price = false;
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
            } else {
                $total = false;
            }

            //tax
            $a = $product['price'] * $product['quantity'];
            $b = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
            $tax = $this->currency->format($b - $a);

            $json['products'][] = array(
                'key' => $product['key'],
                'name' => $product['name'],
                'model' => $product['model'],
                'option' => $option_data,
                'quantity' => $product['quantity'],
                'price' => $price,
                'total' => $total,
                'tax' => $tax,
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
            );
        }//foreach product in cart generate html
        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        //get order comment
        $json['comment'] = $this->db->query('select comment from `' . DB_PREFIX . 'order` where order_id="' . $this->request->get['order_id'] . '"')->row['comment'];

        $json['total_data'] = $total_data;
        $json['total'] = $this->currency->format($total);

        //customer info
        $this->load->model('pos/pos');
        $json['customer'] = $this->model_pos_pos->getCustomer['customer_id'];
        $json['order_id'] = $this->request->get['order_id'];
        echo json_encode($json);
    }

    public function hold_cart_delete() {
        $this->load->model('pos/pos');
        $this->model_pos_pos->hold_cart_delete($_POST['cart_holder_id']);
    }

    public function hold_cart() {

        $json = array();

        if ($_POST['name'] == '') {
            $json['error'] = 'Error: Please enter hold name.';
            echo json_encode($json);
            die();
        }

        $data = array(
            'name' => $this->request->post['name'],
            'cart' => $this->session->data['cart'],
            'user_id' => $this->user->getId(),
        );

        $this->load->model('pos/pos');

        $id = $this->model_pos_pos->hold_cart($data);

        //html update
        $row = $this->model_pos_pos->hold_cart_select($id);

        $json['html'] = '<tr><td>' . $row['name'] . '</td><td align="center">' . $row['date_created'] . '</td><td align="center">';
        $json['html'].= "[<a data_cart_holder_id='" . $row["cart_holder_id"] . "' href='#' class='select'>Select</a>]&nbsp;";
        $json['html'].= "[<a data_cart_holder_id='" . $row["cart_holder_id"] . "' href='#' class='delete'>Delete</a>]</td></tr>";

        $json['success'] = 'Success: cart moved to hold list.';

        echo json_encode($json);
    }

    public function hold_cart_select() {

        $this->load->model('pos/pos');

        $row = $this->model_pos_pos->hold_cart_select($_POST['cart_holder_id']);

        $this->session->data['cart'] = unserialize($row['cart']);

        $json['products'] = array();

        $this->load->library('customer');
        $this->customer = new Customer($this->registry);

        $this->load->library('tax'); //
        $this->tax = new Tax($this->registry);

        $this->load->library('pos_cart'); //
        $this->cart = new Pos_cart($this->registry);

        foreach ($this->cart->getProducts() as $product) {

            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['option_value'];
                } else {
                    $filename = $this->encryption->decrypt($option['option_value']);

                    $value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'name' => $option['name'],
                    'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
                    'type' => $option['type']
                );
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($product['price']);
            } else {
                $price = false;
            }

            // Display prices
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
            } else {
                $total = false;
            }

            //tax
            $a = $product['price'] * $product['quantity'];
            $b = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
            $tax = $this->currency->format($b - $a);

            $json['products'][] = array(
                'key' => $product['key'],
                'name' => $product['name'],
                'model' => $product['model'],
                'option' => $option_data,
                'quantity' => $product['quantity'],
                'price' => $price,
                'total' => $total,
                'tax' => $tax,
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
            );
        }//foreach product in cart generate html
        // Totals
        $this->load->model('pos/extension');

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        $sort_order = array();

        $results = $this->model_pos_extension->getExtensions('total');

        foreach ($results as $key => $value) {
            $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
        }

        array_multisort($sort_order, SORT_ASC, $results);

        foreach ($results as $result) {
            if ($this->config->get($result['code'] . '_status')) {
                $this->load->model('pos/' . $result['code']);

                $this->{'model_pos_' . $result['code']}->getTotal($total_data, $total, $taxes);
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
        }

        $json['total_data'] = $total_data;
        $json['total'] = $this->currency->format($total);

        $json['success'] = 'Success: cart restored from hold list.';

        echo json_encode($json);
    }

}

?>