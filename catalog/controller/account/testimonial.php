<?php
class ControllerAccountTestimonial extends Controller {
	private $error = array();

  	public function index() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}

		$this->language->load('account/testimonial');

		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('catalog/po_testimonials');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_po_testimonials->addTestimonial($this->request->post);

	  		$this->redirect($this->url->link('account/testimonial/success', '', 'SSL'));
    	}

		$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account'),
        	'separator' => $this->language->get('text_separator')
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/testimonial'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_testimonial'] = $this->language->get('entry_testimonial');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');
		$this->data['button_submit'] = $this->language->get('button_submit');
    $this->data['continue'] = $this->url->link('account/account', '', 'SSL');
		$this->data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['testimonial'])) {
			$this->data['error_testimonial'] = $this->error['testimonial'];
		} else {
			$this->data['error_testimonial'] = '';
		}

		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}


		if (isset($this->request->post['testimonial'])) {
			$this->data['testimonial'] = $this->request->post['testimonial'];
		} else {
			$this->data['testimonial'] = '';
		}

		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}
		//$this->customer->getId();

		$this->data['action'] = $this->url->link('account/testimonial');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/testimonial.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/testimonial.tpl';
		} else {
			$this->template = 'default/template/account/testimonial.tpl';
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

  	public function success() {
		$this->language->load('account/testimonial');

		$this->document->setTitle($this->language->get('heading_title'));

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('account/testimonial'),
        	'separator' => $this->language->get('text_separator')
      	);

    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_message'] = $this->language->get('text_message');

    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
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

  	private function validate() {
    	if ((utf8_strlen($this->request->post['testimonial']) < 10) || (utf8_strlen($this->request->post['testimonial']) > 3000)) {
      		$this->error['testimonial'] = $this->language->get('error_testimonial');
    	}

    	if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}

		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}

	public function captcha() {
		$this->load->library('captcha');

		$captcha = new Captcha();

		$this->session->data['captcha'] = $captcha->getCode();

		$captcha->showImage();
	}
}
?>
