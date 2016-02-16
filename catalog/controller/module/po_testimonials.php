<?php
class ControllerModulePOTestimonials extends Controller {
	protected function index($setting) {
		//$this->document->addScript('catalog/view/javascript/jquery.quovolver.js');
		//$this->document->addStyle('catalog/view/theme/default/stylesheet/po_testimonials.css');

		$this->language->load('module/po_testimonials');

      	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_view_all'] = $this->language->get('text_view_all');
		$this->data['view_all'] = $this->url->link('information/testimonial');

		$this->data['testimonials'] = array();

		if(isset($setting['testimonials'])) {

			$testimonial = $setting['testimonials'];
			$count_testimonial = count($testimonial);
			$testimonial_string = '';
			for ($i = 0; $i < $count_testimonial ; $i ++) {
				$testimonial_string .= $testimonial[$i];
				if(!($i + 1 == $count_testimonial)) {
					$testimonial_string .= ' , ';
				}
			}

			$this->load->model('catalog/po_testimonials');


		$results = $this->model_catalog_po_testimonials->getTestimonialsbyID($testimonial_string);
		foreach ($results as $result) {

			$this->data['testimonials'][] = array(
				'testimonial_id' => $result['testimonial_id'],
				'text'    	 => $result['text'],
				'author'	 => $result['firstname'] . ' ' . $result['lastname'],
			);

			}

		}





		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/po_testimonials.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/po_testimonials.tpl';
		} else {
			$this->template = 'default/template/module/po_testimonials.tpl';
		}

		$this->render();
	}
}
?>