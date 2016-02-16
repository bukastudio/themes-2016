<?php    
class ControllerCatalogBanks extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->load->language('catalog/banks');
		
		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('catalog/banks');
		
    	$this->getList();
  	}
  
  	public function insert() {
		$this->load->language('catalog/banks');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/banks');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_banks->addBank($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . $url);
		}
    
    	$this->getForm();
  	} 
   
  	public function update() {
		$this->load->language('catalog/banks');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/banks');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_banks->editBank($this->request->get['bank_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			//$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . $url);
			$this->redirect($this->url->link('catalog/banks', 'token=' . $this->session->data['token'], 'SSL'));
		}
    
    	$this->getForm();
  	}   

  	public function delete() {
		$this->load->language('catalog/banks');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/banks');
			
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $bank_id) {
				$this->model_catalog_banks->deleteBank($bank_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			//$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . $url);
			$this->redirect($this->url->link('catalog/banks', 'token=' . $this->session->data['token'], 'SSL'));
    	}
	
    	$this->getList();
  	}  
    
  	private function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
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
		
		$url = '';
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = HTTPS_SERVER . 'index.php?route=catalog/banks/insert&token=' . $this->session->data['token'] . $url;
		$this->data['delete'] = HTTPS_SERVER . 'index.php?route=catalog/banks/delete&token=' . $this->session->data['token'] . $url;	

		$this->data['banks'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$banks_total = $this->model_catalog_banks->getTotalBanks();
	
		$results = $this->model_catalog_banks->getBanks($data);
 
    	foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => HTTPS_SERVER . 'index.php?route=catalog/banks/update&token=' . $this->session->data['token'] . '&bank_id=' . $result['bank_id'] . $url
			);
						
			$this->data['banks'][] = array(
				'bank_id' => $result['bank_id'],
				'name'            => $result['name'],
				'branch'            => $result['branch'],
				'account_number'            => $result['account_number'],
				'account_holder'            => $result['account_holder'],
				'sort_order'      => $result['sort_order'],
				'selected'        => isset($this->request->post['selected']) && in_array($result['bank_id'], $this->request->post['selected']),
				'action'          => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_branch'] = $this->language->get('column_branch');
		$this->data['column_account_number'] = $this->language->get('column_account_number');
		$this->data['column_account_holder'] = $this->language->get('column_account_holder');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
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
		
		$this->data['sort_name'] = HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . '&sort=name' . $url;
		$this->data['sort_sort_order'] = HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . '&sort=sort_order' . $url;
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $banks_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . $url . '&page={page}';
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'catalog/banks_list.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
  
  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');

		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_branch'] = $this->language->get('entry_branch');
		$this->data['entry_account_number'] = $this->language->get('entry_account_number');
		$this->data['entry_account_holder'] = $this->language->get('entry_account_holder');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_bank_logo'] = $this->language->get('entry_bank_logo');
  
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
	  
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->error['branch'])) {
			$this->data['error_branch'] = $this->error['branch'];
		} else {
			$this->data['error_branch'] = '';
		}
		
		if (isset($this->error['account_number'])) {
			$this->data['error_account_number'] = $this->error['account_number'];
		} else {
			$this->data['error_account_number'] = '';
		}
		
		if (isset($this->error['account_holder'])) {
			$this->data['error_account_holder'] = $this->error['account_holder'];
		} else {
			$this->data['error_account_holder'] = '';
		}
		    
		$url = '';
			
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
							
		if (!isset($this->request->get['bank_id'])) {
			$this->data['action'] = HTTPS_SERVER . 'index.php?route=catalog/banks/insert&token=' . $this->session->data['token'] . $url;
		} else {
			$this->data['action'] = HTTPS_SERVER . 'index.php?route=catalog/banks/update&token=' . $this->session->data['token'] . '&bank_id=' . $this->request->get['bank_id'] . $url;
		}
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=catalog/banks&token=' . $this->session->data['token'] . $url;

		$this->data['token'] = $this->session->data['token'];
		
    	if (isset($this->request->get['bank_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$banks_info = $this->model_catalog_banks->getBank($this->request->get['bank_id']);
    	}

		

    	if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (isset($banks_info)) {
			$this->data['name'] = $banks_info['name'];
		} else {	
      		$this->data['name'] = '';
    	}
    	
    	if (isset($this->request->post['branch'])) {
      		$this->data['branch'] = $this->request->post['branch'];
    	} elseif (isset($banks_info)) {
			$this->data['branch'] = $banks_info['branch'];
		} else {	
      		$this->data['branch'] = '';
    	}
    	
    	if (isset($this->request->post['account_number'])) {
      		$this->data['account_number'] = $this->request->post['account_number'];
    	} elseif (isset($banks_info)) {
			$this->data['account_number'] = $banks_info['account_number'];
		} else {	
      		$this->data['account_number'] = '';
    	}
    	
    	if (isset($this->request->post['account_holder'])) {
      		$this->data['account_holder'] = $this->request->post['account_holder'];
    	} elseif (isset($banks_info)) {
			$this->data['account_holder'] = $banks_info['account_holder'];
		} else {	
      		$this->data['account_holder'] = '';
    	}
		
		if (isset($this->request->post['sort_order'])) {
      		$this->data['sort_order'] = $this->request->post['sort_order'];
    	} elseif (isset($banks_info)) {
			$this->data['sort_order'] = $banks_info['sort_order'];
		} else {
      		$this->data['sort_order'] = '';
    	}
		
		$this->template = 'catalog/banks_form.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}  
	 
  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/banks')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) > 32)) {
      		$this->error['name'] = $this->language->get('error_name');
    	}
    	
    	if ((strlen(utf8_decode($this->request->post['branch'])) < 3) || (strlen(utf8_decode($this->request->post['branch'])) > 32)) {
      		$this->error['branch'] = $this->language->get('error_branch');
    	}
    	
    	if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) > 32)) {
      		$this->error['account_number'] = $this->language->get('error_account_number');
    	}
    	
    	if ((strlen(utf8_decode($this->request->post['account_holder'])) < 3) || (strlen(utf8_decode($this->request->post['account_holder'])) > 32)) {
      		$this->error['account_holder'] = $this->language->get('error_account_holder');
    	}
		
		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}
  	}    

  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'catalog/banks')) {
			$this->error['warning'] = $this->language->get('error_permission');
    	}	
		
		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}  
  	}
}
?>