<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Myshortcart
 *
 * @lordsanjay
 */
 
class ControllerPaymentMyshortcart extends Controller {
    
    private $error = array();
                             
    public function index() 
    {
						
				# Set Initial Parameters
				$this->load->language('payment/myshortcart');
				$this->document->setTitle($this->language->get('heading_title'));		
				$this->load->model('setting/setting');
					
				if ( ($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate() ) 
				{
						$this->model_setting_setting->editSetting('myshortcart', $this->request->post);							
						$this->session->data['success'] = $this->language->get('text_success');
						$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
				}
		
						
				# Get Form Data
				$this->data['heading_title']                = $this->language->get('heading_title');        
				$this->data['server_params']                = $this->language->get('server_params');
				$this->data['opencart_params']              = $this->language->get('opencart_params');
				$this->data['paymentchannel_params']        = $this->language->get('paymentchannel_params');        
				$this->data['entry_storeid']                = $this->language->get('entry_storeid');
				$this->data['entry_sharedkey']              = $this->language->get('entry_sharedkey');
				$this->data['entry_prefix']                 = $this->language->get('entry_prefix');
				$this->data['entry_payment_name']           = $this->language->get('entry_payment_name');
				$this->data['entry_status']                 = $this->language->get('entry_status');
				$this->data['entry_order_status']           = $this->language->get('entry_order_status');        
				$this->data['text_all_zones']               = $this->language->get('text_all_zones');
				$this->data['entry_geo_zone']               = $this->language->get('entry_geo_zone');
				$this->data['entry_minimal_amount']         = $this->language->get('entry_minimal_amount');
				$this->data['entry_sort_order']             = $this->language->get('entry_sort_order');
				$this->data['text_enabled']                 = $this->language->get('text_enabled');
				$this->data['text_disabled']                = $this->language->get('text_disabled');
				$this->data['url_title']                    = $this->language->get('url_title');
				$this->data['url_verify']                   = $this->language->get('url_verify');
				$this->data['url_notify']                   = $this->language->get('url_notify');
				$this->data['url_redirect']                 = $this->language->get('url_redirect');
				$this->data['url_cancel']                   = $this->language->get('url_cancel');
				$this->data['button_save']                  = $this->language->get('button_save');
				$this->data['button_cancel']                = $this->language->get('button_cancel');
						
						
				# Set Error Message
				if ( isset($this->error['warning']) ) 
				{
						$this->data['error_warning'] = $this->error['warning'];
				} 
				else 
				{
						$this->data['error_warning'] = '';
				}
				
				if ( isset($this->error['storeid']) ) 
				{
						$this->data['error_storeid'] = $this->error['storeid'];
				} 
				else 
				{
						$this->data['error_storeid'] = '';
				}
		
				if ( isset($this->error['sharedkey']) ) 
				{
						$this->data['error_sharedkey'] = $this->error['sharedkey'];
				} 
				else 
				{
						$this->data['error_sharedkey'] = '';
				}

				if ( isset($this->error['prefix']) ) 
				{
						$this->data['error_prefix'] = $this->error['prefix'];
				} 
				else 
				{
						$this->data['error_prefix'] = '';
				}
				
				if ( isset($this->error['payment_method']) ) 
				{
						$this->data['error_payment_method'] = $this->error['payment_method'];
				} 
				else 
				{
						$this->data['error_payment_method'] = '';
				}
		
				if ( isset($this->error['minimal_amount']) ) 
				{
						$this->data['error_minimal_amount'] = $this->error['minimal_amount'];
				} 
				else 
				{
						$this->data['error_minimal_amount'] = '';
				}
		
				if ( isset($this->error['payment_name']) ) 
				{
						$this->data['error_payment_name'] = $this->error['payment_name'];
				} 
				else 
				{
						$this->data['error_payment_name'] = '';
				}
					
						
				# Get POST or Config Data      
				if ( isset($this->request->post['myshortcart_storeid']) ) 
				{
						$this->data['myshortcart_storeid'] = $this->request->post['myshortcart_storeid'];
				} 
				else 
				{
						$this->data['myshortcart_storeid'] = $this->config->get('myshortcart_storeid');
				}
				
				if ( isset($this->request->post['myshortcart_sharedkey']) ) 
				{
						$this->data['myshortcart_sharedkey'] = $this->request->post['myshortcart_sharedkey'];
				} 
				else 
				{
						$this->data['myshortcart_sharedkey'] = $this->config->get('myshortcart_sharedkey');
				}                  

				if ( isset($this->request->post['myshortcart_prefix']) ) 
				{
						$this->data['myshortcart_prefix'] = $this->request->post['myshortcart_prefix'];
				} 
				else 
				{
						$this->data['myshortcart_prefix'] = $this->config->get('myshortcart_prefix');
				}
				
				if ( isset($this->request->post['myshortcart_payment_method']) ) 
				{
						$this->data['myshortcart_payment_method'] = $this->request->post['myshortcart_payment_method'];
				} 
				else 
				{
						$this->data['myshortcart_payment_method'] = $this->config->get('myshortcart_payment_method');
				}        
											
				if ( isset($this->request->post['myshortcart_order_status_id']) ) 
				{
						$this->data['myshortcart_order_status_id'] = $this->request->post['myshortcart_order_status_id'];
				} 
				else 
				{
						$this->data['myshortcart_order_status_id'] = $this->config->get('myshortcart_order_status_id'); 
				}
			
			
				# Payment Channel	
				if ( isset($this->request->post['myshortcart_payment_name']) ) 
				{
						$this->data['myshortcart_payment_name'] = $this->request->post['myshortcart_payment_name'];
				} 
				else 
				{
						$this->data['myshortcart_payment_name'] = $this->config->get('myshortcart_payment_name'); 
				}
		
				$this->load->model('localisation/order_status');		
				$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
				
				if ( isset($this->request->post['myshortcart_geo_zone_id']) ) 
				{
						$this->data['myshortcart_geo_zone_id'] = $this->request->post['myshortcart_geo_zone_id'];
				} 
				else 
				{
						$this->data['myshortcart_geo_zone_id'] = $this->config->get('myshortcart_geo_zone_id'); 
				} 
		
				$this->load->model('localisation/geo_zone');										
				$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
				
				if ( isset($this->request->post['myshortcart_status']) ) 
				{
						$this->data['myshortcart_status'] = $this->request->post['myshortcart_status'];
				} 
				else 
				{
						$this->data['myshortcart_status'] = $this->config->get('myshortcart_status');
				}
		
				if ( isset($this->request->post['myshortcart_minimal_amount']) ) 
				{
						$this->data['myshortcart_minimal_amount'] = $this->request->post['myshortcart_minimal_amount'];
				} 
				else 
				{
						$this->data['myshortcart_minimal_amount'] = $this->config->get('myshortcart_minimal_amount'); 
				}
						
				if ( isset($this->request->post['myshortcart_sort_order']) ) 
				{
						$this->data['myshortcart_sort_order'] = $this->request->post['myshortcart_sort_order'];
				} 
				else 
				{
						$this->data['myshortcart_sort_order'] = $this->config->get('myshortcart_sort_order');
				}
		
				# Set Breadcrumbs
				$this->data['breadcrumbs'] = array();
		
				$this->data['breadcrumbs'][] = array(
					 'text'      => $this->language->get('text_home'),
					 'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
					 'separator' => false
				);
		
				$this->data['breadcrumbs'][] = array(
					 'text'      => $this->language->get('text_payment'),
					 'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
					 'separator' => ' :: '
				);
		
				$this->data['breadcrumbs'][] = array(
					 'text'      => $this->language->get('heading_title'),
					 'href'      => $this->url->link('payment/myshortcart', 'token=' . $this->session->data['token'], 'SSL'),
					 'separator' => ' :: '
				);
								
				$this->data['action'] = $this->url->link('payment/myshortcart', 'token=' . $this->session->data['token'], 'SSL');        
				$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
											
				$this->template = 'payment/myshortcart.tpl';
				$this->children = array(
					'common/header',
					'common/footer'
				);
						
				$this->response->setOutput($this->render());
				
		}

    private function validate()
    {
        if ( !$this->user->hasPermission('modify', 'payment/myshortcart') ) 
        {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ( !$this->request->post['myshortcart_storeid'] ) 
        {
            $this->error['storeid'] = $this->language->get('error_storeid');
        }
        
        if ( !$this->request->post['myshortcart_sharedkey'] ) 
        {
            $this->error['sharedkey'] = $this->language->get('error_sharedkey');
        }        

        if ( !$this->request->post['myshortcart_prefix']  || strlen($this->request->post['myshortcart_prefix']) <> 4 || strpos( $this->request->post['myshortcart_prefix'], "_" ) !== FALSE ) 
        {
            $this->error['prefix'] = $this->language->get('error_prefix');
        }
				
        if ( !$this->request->post['myshortcart_minimal_amount'] || $this->request->post['myshortcart_minimal_amount'] < 1 ) 
        {
            $this->error['minimal_amount'] = $this->language->get('error_minimal_amount');
        }        
				
        if ( !$this->request->post['myshortcart_payment_name'] ) 
        {
            $this->error['payment_name'] = $this->language->get('error_payment_name');
        }
	
				if ( !$this->error ) 
				{
						return true;
				} 
				else 
				{
						return false;
				}	
		}
}

?>
