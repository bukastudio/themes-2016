<?php  
class Controllermoduleoutofstockenquiry extends Controller {
	public function enquiryForm() {
	
	
		$this->language->load('module/out-of-stock-enquiry'); // Loading the language file of out-of-stock-enquiry 
 
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_phone'] = $this->language->get('entry_phone');
		$this->data['entry_subject'] = $this->language->get('entry_subject');
		$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
	
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['error_required'] = $this->language->get('error_required');
	
	
	
	
			
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} else {
			$this->data['name'] = $this->customer->getFirstName();
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['phone'])) {
			$this->data['phone'] = $this->request->post['phone'];
		} else {
			$this->data['phone'] = '';
		}
		
		if (isset($this->request->post['subject'])) {
			$this->data['subject'] = $this->request->post['subject'];
		} else {
			$this->data['subject'] = '';
		}
		
		if (isset($this->request->post['enquiry'])) {
			$this->data['enquiry'] = $this->request->post['enquiry'];
		} else {
			$this->data['enquiry'] = '';
		}
	
	
	
	
	
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/out-of-stock-enquiry.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/module/out-of-stock-enquiry.tpl';
				} else {
					$this->template = 'default/template/module/out-of-stock-enquiry.tpl';
				}
				$this->response->setOutput($this->render()); // Rendering the Output
	}
	
	public function send() {

		$this->language->load('module/out-of-stock-enquiry'); // Loading the language file of out-of-stock-enquiry 

		$data =array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
	
		$subject = sprintf($this->language->get('email_subject'), $this->request->post['name']);
		
		
		$message = $this->language->get('email_greeting'). "<br/><br/>";
		//$message .= $this->language->get('email_text_1'). "\n\n";

		$message .= '<strong>Name: </strong>' .$this->request->post['name']. "<br/>";
		$message .= '<strong>Email: </strong>' .$this->request->post['email']. "<br/>";
		$message .= '<strong>Telephone: </strong>' .$this->request->post['phone']. "<br/>";
		$message .= '<strong>Subject: </strong>' .$this->request->post['subject']. "<br/>";
		$message .= '<strong>Enquiry: </strong>' .$this->request->post['enquiry']. "<br/>";
	
	
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->hostname = $this->config->get('config_smtp_host');
		$mail->username = $this->config->get('config_smtp_username');
		$mail->password = $this->config->get('config_smtp_password');
		$mail->port = $this->config->get('config_smtp_port');
		$mail->timeout = $this->config->get('config_smtp_timeout');
		$mail->setTo($this->config->get('config_email'));
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject($subject);
		$mail->setHtml($message);
		$mail->send();
		
		$data['success'] = $this->language->get('email_success');
	
		echo json_encode($data);
		exit;
		}
	}
	
		protected function validate() {
		/*if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = 'Please enter this field';
		}

		if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			$this->error['email'] = 'Please enter this field';
		}

		if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
			$this->error['enquiry'] = 'Please enter this field';
		}*/

		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}  	  
	}
}
?>