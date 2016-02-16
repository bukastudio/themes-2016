<?php

class ControllerPosCustomer extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('sale/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('sale/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_sale_customer->addCustomer($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_approved'])) {
                $url .= '&filter_approved=' . $this->request->get['filter_approved'];
            }

            if (isset($this->request->get['filter_ip'])) {
                $url .= '&filter_ip=' . $this->request->get['filter_ip'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
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

            $this->redirect($this->url->link('pos/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        //success msg
        if(isset($this->session->data['success'])){
            $this->data['msg'] = $this->session->data['success'];
            $this->session->data['success'] = '';
        }else{
            $this->data['msg'] = '';
        }
                
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_wait'] = $this->language->get('text_wait');
        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
        $this->data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');

        $this->data['column_ip'] = $this->language->get('column_ip');
        $this->data['column_total'] = $this->language->get('column_total');
        $this->data['column_date_added'] = $this->language->get('column_date_added');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['entry_firstname'] = $this->language->get('entry_firstname');
        $this->data['entry_lastname'] = $this->language->get('entry_lastname');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
        $this->data['entry_fax'] = $this->language->get('entry_fax');
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_confirm'] = $this->language->get('entry_confirm');
        $this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_company'] = $this->language->get('entry_company');
        $this->data['entry_company_id'] = $this->language->get('entry_company_id');
        $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
        $this->data['entry_address_1'] = $this->language->get('entry_address_1');
        $this->data['entry_address_2'] = $this->language->get('entry_address_2');
        $this->data['entry_city'] = $this->language->get('entry_city');
        $this->data['entry_postcode'] = $this->language->get('entry_postcode');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_default'] = $this->language->get('entry_default');
        $this->data['entry_comment'] = $this->language->get('entry_comment');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_amount'] = $this->language->get('entry_amount');
        $this->data['entry_points'] = $this->language->get('entry_points');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_address'] = $this->language->get('button_add_address');
        $this->data['button_add_history'] = $this->language->get('button_add_history');
        $this->data['button_add_transaction'] = $this->language->get('button_add_transaction');
        $this->data['button_add_reward'] = $this->language->get('button_add_reward');
        $this->data['button_remove'] = $this->language->get('button_remove');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_address'] = $this->language->get('tab_address');
        $this->data['tab_history'] = $this->language->get('tab_history');
        $this->data['tab_transaction'] = $this->language->get('tab_transaction');
        $this->data['tab_reward'] = $this->language->get('tab_reward');
        $this->data['tab_ip'] = $this->language->get('tab_ip');

        $this->data['token'] = $this->session->data['token'];

        if (isset($this->request->get['customer_id'])) {
            $this->data['customer_id'] = $this->request->get['customer_id'];
        } else {
            $this->data['customer_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['firstname'])) {
            $this->data['error_firstname'] = $this->error['firstname'];
        } else {
            $this->data['error_firstname'] = '';
        }

        if (isset($this->error['lastname'])) {
            $this->data['error_lastname'] = $this->error['lastname'];
        } else {
            $this->data['error_lastname'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }

        if (isset($this->error['telephone'])) {
            $this->data['error_telephone'] = $this->error['telephone'];
        } else {
            $this->data['error_telephone'] = '';
        }

        if (isset($this->error['password'])) {
            $this->data['error_password'] = $this->error['password'];
        } else {
            $this->data['error_password'] = '';
        }

        if (isset($this->error['confirm'])) {
            $this->data['error_confirm'] = $this->error['confirm'];
        } else {
            $this->data['error_confirm'] = '';
        }

        if (isset($this->error['address_firstname'])) {
            $this->data['error_address_firstname'] = $this->error['address_firstname'];
        } else {
            $this->data['error_address_firstname'] = '';
        }

        if (isset($this->error['address_lastname'])) {
            $this->data['error_address_lastname'] = $this->error['address_lastname'];
        } else {
            $this->data['error_address_lastname'] = '';
        }

        if (isset($this->error['address_tax_id'])) {
            $this->data['error_address_tax_id'] = $this->error['address_tax_id'];
        } else {
            $this->data['error_address_tax_id'] = '';
        }

        if (isset($this->error['address_address_1'])) {
            $this->data['error_address_address_1'] = $this->error['address_address_1'];
        } else {
            $this->data['error_address_address_1'] = '';
        }

        if (isset($this->error['address_city'])) {
            $this->data['error_address_city'] = $this->error['address_city'];
        } else {
            $this->data['error_address_city'] = '';
        }

        if (isset($this->error['address_postcode'])) {
            $this->data['error_address_postcode'] = $this->error['address_postcode'];
        } else {
            $this->data['error_address_postcode'] = '';
        }

        if (isset($this->error['address_country'])) {
            $this->data['error_address_country'] = $this->error['address_country'];
        } else {
            $this->data['error_address_country'] = '';
        }

        if (isset($this->error['address_zone'])) {
            $this->data['error_address_zone'] = $this->error['address_zone'];
        } else {
            $this->data['error_address_zone'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_approved'])) {
            $url .= '&filter_approved=' . $this->request->get['filter_approved'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
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

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );
        
        $this->data['action'] = $this->url->link('pos/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_info = $this->model_sale_customer->getCustomer($this->request->get['customer_id']);
        }

        if (isset($this->request->post['firstname'])) {
            $this->data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($customer_info)) {
            $this->data['firstname'] = $customer_info['firstname'];
        } else {
            $this->data['firstname'] = '';
        }

        if (isset($this->request->post['lastname'])) {
            $this->data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($customer_info)) {
            $this->data['lastname'] = $customer_info['lastname'];
        } else {
            $this->data['lastname'] = '';
        }

        if (isset($this->request->post['email'])) {
            $this->data['email'] = $this->request->post['email'];
        } elseif (!empty($customer_info)) {
            $this->data['email'] = $customer_info['email'];
        } else {
            $this->data['email'] = '';
        }

        if (isset($this->request->post['telephone'])) {
            $this->data['telephone'] = $this->request->post['telephone'];
        } elseif (!empty($customer_info)) {
            $this->data['telephone'] = $customer_info['telephone'];
        } else {
            $this->data['telephone'] = '';
        }

        if (isset($this->request->post['fax'])) {
            $this->data['fax'] = $this->request->post['fax'];
        } elseif (!empty($customer_info)) {
            $this->data['fax'] = $customer_info['fax'];
        } else {
            $this->data['fax'] = '';
        }

        if (isset($this->request->post['newsletter'])) {
            $this->data['newsletter'] = $this->request->post['newsletter'];
        } elseif (!empty($customer_info)) {
            $this->data['newsletter'] = $customer_info['newsletter'];
        } else {
            $this->data['newsletter'] = '';
        }

        $this->load->model('sale/customer_group');

        $this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

        if (isset($this->request->post['customer_group_id'])) {
            $this->data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($customer_info)) {
            $this->data['customer_group_id'] = $customer_info['customer_group_id'];
        } else {
            $this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
        }

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($customer_info)) {
            $this->data['status'] = $customer_info['status'];
        } else {
            $this->data['status'] = 1;
        }

        if (isset($this->request->post['password'])) {
            $this->data['password'] = $this->request->post['password'];
        } else {
            $this->data['password'] = '';
        }

        if (isset($this->request->post['confirm'])) {
            $this->data['confirm'] = $this->request->post['confirm'];
        } else {
            $this->data['confirm'] = '';
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if (isset($this->request->post['address'])) {
            $this->data['addresses'] = $this->request->post['address'];
        } elseif (isset($this->request->get['customer_id'])) {
            $this->data['addresses'] = $this->model_sale_customer->getAddresses($this->request->get['customer_id']);
        } else {
            $this->data['addresses'] = array();
        }

        if (isset($this->request->post['address_id'])) {
            $this->data['address_id'] = $this->request->post['address_id'];
        } elseif (!empty($customer_info)) {
            $this->data['address_id'] = $customer_info['address_id'];
        } else {
            $this->data['address_id'] = '';
        }


        $this->template = 'pos/customer_form.tpl';
        $this->response->setOutput($this->render());
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'pos/customer')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
            $this->error['firstname'] = $this->language->get('error_firstname');
        }

        if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
            $this->error['lastname'] = $this->language->get('error_lastname');
        }

        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }

        $customer_info = $this->model_sale_customer->getCustomerByEmail($this->request->post['email']);

        if (!isset($this->request->get['customer_id'])) {
            if ($customer_info) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        } else {
            if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
                $this->error['warning'] = $this->language->get('error_exists');
            }
        }

        if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
            $this->error['telephone'] = $this->language->get('error_telephone');
        }

        if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
            if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
                $this->error['password'] = $this->language->get('error_password');
            }

            if ($this->request->post['password'] != $this->request->post['confirm']) {
                $this->error['confirm'] = $this->language->get('error_confirm');
            }
        }

        if (isset($this->request->post['address'])) {
            foreach ($this->request->post['address'] as $key => $value) {
                if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
                    $this->error['address_firstname'][$key] = $this->language->get('error_firstname');
                }

                if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
                    $this->error['address_lastname'][$key] = $this->language->get('error_lastname');
                }

                if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
                    $this->error['address_address_1'][$key] = $this->language->get('error_address_1');
                }

                if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
                    $this->error['address_city'][$key] = $this->language->get('error_city');
                }

                $this->load->model('localisation/country');

                $country_info = $this->model_localisation_country->getCountry($value['country_id']);

                if ($country_info) {
                    if ($country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2) || (utf8_strlen($value['postcode']) > 10)) {
                        $this->error['address_postcode'][$key] = $this->language->get('error_postcode');
                    }

                    // VAT Validation
                    $this->load->helper('vat');

                    if ($this->config->get('config_vat') && $value['tax_id'] && (vat_validation($country_info['iso_code_2'], $value['tax_id']) == 'invalid')) {
                        $this->error['address_tax_id'][$key] = $this->language->get('error_vat');
                    }
                }

                if ($value['country_id'] == '') {
                    $this->error['address_country'][$key] = $this->language->get('error_country');
                }

                if (!isset($value['zone_id']) || $value['zone_id'] == '') {
                    $this->error['address_zone'][$key] = $this->language->get('error_zone');
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function country() {
            $json = array();

            $this->load->model('localisation/country');

            $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

            if ($country_info) {
                    $this->load->model('localisation/zone');

                    $json = array(
                            'country_id'        => $country_info['country_id'],
                            'name'              => $country_info['name'],
                            'iso_code_2'        => $country_info['iso_code_2'],
                            'iso_code_3'        => $country_info['iso_code_3'],
                            'address_format'    => $country_info['address_format'],
                            'postcode_required' => $country_info['postcode_required'],
                            'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                            'status'            => $country_info['status']		
                    );
            }

            $this->response->setOutput(json_encode($json));
    }
}
