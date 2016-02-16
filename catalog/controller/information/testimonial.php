<?php 
class ControllerInformationTestimonial extends Controller {
	public function index() {  
		$this->document->addStyle('catalog/view/theme/default/stylesheet/po_testimonials.css');

    	$this->language->load('information/testimonial');
		
		$this->load->model('catalog/po_testimonials');
		
		$this->document->setTitle($this->language->get('text_testimonial'));  
		$this->data['heading_title'] = $this->language->get('text_testimonial');
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}	
							
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = 10;//$this->config->get('config_catalog_limit');
		}
		
		$this->data['breadcrumbs'] = array();
		
      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);
		
		$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_testimonial'),
			'href'      => $this->url->link('information/testimonial'),
        	'separator' => $this->language->get('text_separator'),
      	);
		
		$url = '';
			
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$this->data['testimonials'] = array();
		
		$data = array(
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);
		
		$testimonial_total = $this->model_catalog_po_testimonials->getTotalTestimonials($data);; 

		$results = $this->model_catalog_po_testimonials->getTestimonials($data);

		foreach ($results as $result) {
			
			$this->data['testimonials'][] = array(
				'testimonial_id' => $result['testimonial_id'],
				'text'    	 => $result['text'],
				'author'	 => $result['firstname'] . ' ' . $result['lastname'],
			);
		}
		
		$url = '';
	
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
		
		$pagination = new Pagination();
		$pagination->total = $testimonial_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('information/testimonial', $url . '&page={page}');
		
		$this->data['pagination'] = $pagination->render();
		
		$this->data['limit'] = $limit;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/testimonial.tpl';
		} else {
			$this->template = 'default/template/information/testimonial.tpl';
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