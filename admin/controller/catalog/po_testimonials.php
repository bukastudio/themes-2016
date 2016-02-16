<?php
class ControllerCatalogPOTestimonials extends Controller {
	private $error = array();
 
	public function index() {
		$this->load->language('catalog/po_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/po_testimonials');
		
		$this->getList();
	} 

	public function insert() {
		$this->load->language('catalog/po_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/po_testimonials');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_po_testimonials->addTestimonial($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

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
						
			$this->redirect($this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/po_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/po_testimonials');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_po_testimonials->editTestimonial($this->request->get['testimonial_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

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
						
			$this->redirect($this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() { 
		$this->load->language('catalog/po_testimonials');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/po_testimonials');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $testimonial_id) {
				$this->model_catalog_po_testimonials->deleteTestimonial($testimonial_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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
						
			$this->redirect($this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 't.date_added';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
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

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->link('catalog/po_testimonials/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/po_testimonials/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['testimonials'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$testimonials_total = $this->model_catalog_po_testimonials->getTotalTestimonials();
	
		$results = $this->model_catalog_po_testimonials->getTestimonials($data);
 
    	foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/po_testimonials/update', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $result['testimonial_id'] . $url, 'SSL')
			);
						
			$this->data['testimonials'][] = array(
				'testimonial_id'  => $result['testimonial_id'],
				'text'       => $result['text'],
				'author'	=> $result['firstname'] . ' ' . $result['lastname'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'   => isset($this->request->post['selected']) && in_array($result['testimonial_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_text'] = $this->language->get('column_text');
		$this->data['column_author'] = $this->language->get('column_author');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_author'] = $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . '&sort=c.firstname' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . '&sort=t.status' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . '&sort=t.date_added' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $testimonials_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/po_testimonials_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_select'] = $this->language->get('text_select');

		$this->data['entry_author'] = $this->language->get('entry_author');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_text'] = $this->language->get('entry_text');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->error['author'])) {
			$this->data['error_author'] = $this->error['author'];
		} else {
			$this->data['error_author'] = '';
		}
		
 		if (isset($this->error['text'])) {
			$this->data['error_text'] = $this->error['text'];
		} else {
			$this->data['error_text'] = '';
		}

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
				
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
										
		if (!isset($this->request->get['testimonial_id'])) { 
			$this->data['action'] = $this->url->link('catalog/po_testimonials/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/po_testimonials/update', 'token=' . $this->session->data['token'] . '&testimonial_id=' . $this->request->get['testimonial_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('catalog/po_testimonials', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['testimonial_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$testimonial_info = $this->model_catalog_po_testimonials->getTestimonial($this->request->get['testimonial_id']);
		}
		
		$this->load->model('sale/customer');
		
		if (isset($this->request->post['customer_id'])) {
			$this->data['customer_id'] = $this->request->post['customer_id'];
		} elseif (!empty($testimonial_info)) {
			$this->data['customer_id'] = $testimonial_info['customer_id'];
		} else {
			$this->data['customer_id'] = '';
		}

		if (isset($this->request->post['author'])) {
			$this->data['author'] = $this->request->post['author'];
		} elseif (!empty($testimonial_info)) {
			$this->data['author'] = $testimonial_info['firstname'] . ' ' . $testimonial_info['lastname'];
		} else {
			$this->data['author'] = '';
		}

		if (isset($this->request->post['text'])) {
			$this->data['text'] = $this->request->post['text'];
		} elseif (!empty($testimonial_info)) {
			$this->data['text'] = $testimonial_info['text'];
		} else {
			$this->data['text'] = '';
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($testimonial_info)) {
			$this->data['status'] = $testimonial_info['status'];
		} else {
			$this->data['status'] = '';
		}

		$this->template = 'catalog/po_testimonials_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/po_testimonials')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
			$this->error['author'] = $this->language->get('error_author');
		}

		if (utf8_strlen($this->request->post['text']) < 1) {
			$this->error['text'] = $this->language->get('error_text');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/po_testimonials')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}	
	public function autocomplete() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			
			$this->load->model('sale/customer');
		
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = null;
			}
	
			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = null;
			}
			
			if (isset($this->request->get['filter_customer_group_id'])) {
				$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
			} else {
				$filter_customer_group_id = null;
			}
	
			if (isset($this->request->get['filter_status'])) {
				$filter_status = $this->request->get['filter_status'];
			} else {
				$filter_status = null;
			}
			
			if (isset($this->request->get['filter_approved'])) {
				$filter_approved = $this->request->get['filter_approved'];
			} else {
				$filter_approved = null;
			}
			
			if (isset($this->request->get['filter_ip'])) {
				$filter_ip = $this->request->get['filter_ip'];
			} else {
				$filter_ip = null;
			}
					
			if (isset($this->request->get['filter_date_added'])) {
				$filter_date_added = $this->request->get['filter_date_added'];
			} else {
				$filter_date_added = null;
			}		
			
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'name'; 
			}
			
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}
							
			$url = '';
	
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}
			
			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . $this->request->get['filter_email'];
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
			
			$this->data['customers'] = array();
	
			$data = array(
				'filter_name'              => $filter_name, 
				'filter_email'             => $filter_email, 
				'filter_customer_group_id' => $filter_customer_group_id, 
				'filter_status'            => $filter_status, 
				'filter_approved'          => $filter_approved, 
				'filter_date_added'        => $filter_date_added,
				'filter_ip'                => $filter_ip,
				'sort'                     => $sort,
				'order'                    => $order,
				'start'                    => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit'                    => $this->config->get('config_admin_limit')
			);
				
			$results = $this->model_sale_customer->getCustomers($data);
	 
			foreach ($results as $result) {
				$action = array();
			
				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
				);
				
				$this->data['customers'][] = array(
					'customer_id'    => $result['customer_id'],
					'name'           => $result['firstname'] . ' ' .$result['lastname'],
				);
				
				$json[] = array(
					'customer_id'    => $result['customer_id'],
					'name'           => $result['firstname'] . ' ' .$result['lastname'],
				);	
			}		
		
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>