<?php
class ControllerInformationPaymentConfirmation extends Controller {
	private $error = array();

  	public function index() {

		$this->language->load('information/payment_confirmation');

    	$this->document->setTitle($this->language->get('heading_title'));

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/payment_confirmation'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['text_mail_payment_confirmation'] = $this->language->get('text_mail_payment_confirmation');
		$this->data['text_mail_store'] = $this->language->get('text_mail_store');
		$this->data['text_mail_orderid'] = $this->language->get('text_mail_orderid');
		$this->data['text_mail_fullname'] = $this->language->get('text_mail_fullname');
		$this->data['text_mail_email'] = $this->language->get('text_mail_email');
		$this->data['text_mail_date'] = $this->language->get('text_mail_date');
		$this->data['text_mail_amount'] = $this->language->get('text_mail_amount');
		$this->data['text_mail_message'] = $this->language->get('text_mail_message');
		$this->data['text_mail_sender'] = $this->language->get('text_mail_sender');
		$this->data['text_mail_receiver'] = $this->language->get('text_mail_receiver');
		$this->data['text_mail_bank_sender'] = $this->language->get('text_mail_bank_sender');
		$this->data['text_mail_bank_receiver'] = $this->language->get('text_mail_bank_receiver');
		$this->data['text_mail_transaction_type'] = $this->language->get('text_mail_transaction_type');
		$this->data['text_mail_acc_no'] = $this->language->get('text_mail_acc_no');
		$this->data['text_mail_acc_holder'] = $this->language->get('text_mail_acc_holder');

		$this->data['this_store_name'] = $this->config->get('config_name');

		$this->data['confirm_thankyou'] = $this->language->get('confirm_thankyou');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			//$this->load->model('account/order');
			//$order_id = $this->request->post['invoice_number'];
			//$order_info = $this->model_account_order->getOrderConfirmation($order_id);
		   // $this->data['store_name'] = $order_info['store_name'];

			// HTML Mail Start
			// $message  = '<html dir="ltr" lang="en">' . "\n";
			// $message .= '<head>' . "\n";
			// $message .= '<title>' . $this->language->get('email_subject') . '</title>' . "\n";
			// $message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			// $message .= '</head>' . "\n";
			//$message .= '<body>' . html_entity_decode($this->request->post['message'], ENT_QUOTES, 'UTF-8') . '</body>' . "\n";
			// $message .= '<body>' . "\n";
			// $message .= '<table cellpadding="0" cellspacing="0" align="center" width="100%">' . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<td>' . "\n";
			// $message .= "<table style=\"font:12px 'Segoe UI', 'Lucida Sans Unicode', Arial, sans-serif; color:#666; line-height:17px; margin:0 auto\" cellpadding=\"8\" cellspacing=\"0\" width=\"600\">" . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<th colspan="2" style="font-size:24px; background-color:#ccc; color:#222; text-align:left; padding:15px 8px; line-height:20px;">' . "\n";
			// $message .= $this->data['text_mail_payment_confirmation'] . "\n";
			// $message .= '</th>' . "\n";
			// $message .= '<th style="text-align:left;background-color:#ccc; color:#222; font-weight:normal">' . "\n";
			// $message .= '<strong style="color:#333;">' . $this->data['text_mail_store'] . '</strong><br/>' . "\n";
			// $message .= $this->data['this_store_name'] . "\n";
			// $message .= '</th>' . "\n";
			// $message .= '<th style="text-align:left;background-color:#ccc; color:#222; font-weight:normal">' . "\n";
			// $message .= '<strong style="color:#333;">' . $this->data['text_mail_orderid'] . '</strong><br/>' . "\n";
			// $message .= $this->request->post['invoice_number'] . "\n";
			// $message .= '</th>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<td colspan="2" style="font-size:16px; color:#000; background-color:#f0f0f0">' . $this->data['text_mail_sender'] . '</td>' . "\n";
			// $message .= '<td colspan="2" style="font-size:16px; color:#000; background-color:#f0f0f0;">' . $this->data['text_mail_receiver'] . '</td>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<td style="color:#333; font-weight:bold; border-bottom:1px solid #eee" width="100">' . "\n";
			// $message .= $this->data['text_mail_fullname'] . '<br/>' . "\n";
			// $message .= $this->data['text_mail_email'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '<td style="border-bottom:1px solid #eee" width="200">' . "\n";
			// $message .= $this->request->post['name'] . '<br/>' . "\n";
			// $message .= $this->request->post['email'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '<td style="color:#333; font-weight:bold; border-bottom:1px solid #eee"  width="100">' . "\n";
			// $message .= $this->data['text_mail_date'] . '<br/>' . "\n";
			// $message .= $this->data['text_mail_amount'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '<td style="border-bottom:1px solid #eee"  width="200">' . "\n";
			// $message .= $this->request->post['payment_date_day'] . " " .$this->request->post['payment_date_month'] . " " . $this->request->post['payment_date_year'] . '<br/>' . "\n";
			// $message .= $this->request->post['payment_amount'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<td colspan="2"  style="border-bottom:1px solid #eee">' . "\n";
			// $message .= '<strong style="color:#333;">' . $this->data['text_mail_bank_sender'] . '</strong><br/>' . "\n";
			// $message .= $this->request->post['bank_sender'] . ' ' .$this->data['text_mail_acc_no'] . $this->request->post['account_number'] . '<br/>' . "\n";
			// $message .= $this->data['text_mail_acc_holder'] . ' ' . $this->request->post['account_name'] . '<br/>' . "\n";
			// $message .= '*' . $this->data['text_mail_transaction_type'] . ' ' . $this->request->post['transaction_type'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '<td colspan="2" style="border-bottom:1px solid #eee">' . "\n";
			// $message .= '<strong style="color:#333;">' . $this->data['text_mail_bank_receiver'] . '</strong><br/>' . "\n";
			// $message .= $this->request->post['bank_receiver'] . '<br/>' . "\n";
			// $message .= 'a/n Hendy Nurrizal' . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '<tr>' . "\n";
			// $message .= '<td colspan="4" style="border-bottom:1px solid #eee">' . "\n";
			// $message .= '<strong style="color:#333;">' . $this->data['text_mail_message'] . '</strong><br/>' . "\n";
			// $message .= $this->request->post['message'] . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '</table>' . "\n";
			// $message .= '</td>' . "\n";
			// $message .= '</tr>' . "\n";
			// $message .= '</table>' . "\n";
			// $message .= '</body>' . "\n";
			// $message .= '</html>' . "\n";
			// HTML Mail End
			$message = "<strong>Konfirmasi Pembayaran</strong> <br /> \n\n";
			$message .= "Order ID: #" . $this->request->post['invoice_number'] . "<br />\n\n";
			$message .= "Email: " . $this->request->post['email'] . "<br />\n\n";
			$message .= "Ditransfer ke rekening: " . $this->request->post['bank_receiver'] . "<br />\n\n";
			$message .= "Tanggal: " . $this->request->post['payment_date_day'] . " " .$this->request->post['payment_date_month'] . " " . $this->request->post['payment_date_year'] . "<br />\n\n";
			$message .= "Sejumlah: " . $this->request->post['payment_amount'] . "<br />\n\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
			$mail->setTo($this->config->get('config_email') . ',' . $this->request->post['email']);
	  	//$mail->setFrom($this->request->post['email']);
	  	$mail->setFrom($this->config->get('config_email'));
			//$mail->setReply($this->request->post['email']);
			//$mail->addCC($this->request->post['email']);
  		$mail->setSender($this->request->post['email']);
  		$mail->setSubject("Payment Confirmation");
  		$mail->setHtml($message);
    		$mail->send();

				$emails = explode(',', $this->config->get('config_alert_emails'));
				//$emails = "'" . $this->request->post['email'] . "'";

				foreach ($emails as $email) {
					if ($email && preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
						$mail->setTo($email);
						$mail->send();
					}
				}

	  		$this->redirect(HTTPS_SERVER . 'index.php?route=information/payment_confirmation/success');
    	}



    	$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_january'] = $this->language->get('text_january');
		$this->data['text_february'] = $this->language->get('text_february');
		$this->data['text_march'] = $this->language->get('text_march');
		$this->data['text_april'] = $this->language->get('text_april');
		$this->data['text_may'] = $this->language->get('text_may');
		$this->data['text_june'] = $this->language->get('text_june');
		$this->data['text_july'] = $this->language->get('text_july');
		$this->data['text_august'] = $this->language->get('text_august');
		$this->data['text_september'] = $this->language->get('text_september');
		$this->data['text_october'] = $this->language->get('text_october');
		$this->data['text_november'] = $this->language->get('text_november');
		$this->data['text_december'] = $this->language->get('text_december');
		$this->data['text_bank_receiver'] = $this->language->get('text_bank_receiver');
		$this->data['text_acc_no'] = $this->language->get('text_acc_no');
		$this->data['text_acc_holder'] = $this->language->get('text_acc_holder');
		$this->data['text_select_account'] = $this->language->get('text_select_account');
		$this->data['text_transaction_type'] = $this->language->get('text_transaction_type');
		$this->data['text_select_transaction'] = $this->language->get('text_select_transaction');
		$this->data['text_atm'] = $this->language->get('text_atm');
		$this->data['text_internet_banking'] = $this->language->get('text_internet_banking');
		$this->data['text_cash'] = $this->language->get('text_cash');
		$this->data['text_from_bank'] = $this->language->get('text_from_bank');
		$this->data['text_select_bank'] = $this->language->get('text_select_bank');
		$this->data['mail'] = $this->config->get('config_email');

    	$this->data['entry_name'] = $this->language->get('entry_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_invoice_number'] = $this->language->get('entry_invoice_number');
		$this->data['entry_payment_date'] = $this->language->get('entry_payment_date');
		$this->data['entry_payment_amount'] = $this->language->get('entry_payment_amount');
		$this->data['entry_account_name'] = $this->language->get('entry_account_name');
		$this->data['entry_account_number'] = $this->language->get('entry_account_number');
		$this->data['entry_message'] = $this->language->get('entry_message');

    	$this->data['entry_enquiry'] = $this->language->get('entry_enquiry');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

		// if (isset($this->error['name'])) {
    // 		$this->data['error_name'] = $this->error['name'];
		// } else {
		// 	$this->data['error_name'] = '';
		// }

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['invoice_number'])) {
			$this->data['error_invoice_number'] = $this->error['invoice_number'];
		} else {
			$this->data['error_invoice_number'] = '';
		}

		if (isset($this->error['payment_date_day'])) {
			$this->data['error_payment_date_day'] = $this->error['payment_date_day'];
		} else {
			$this->data['error_payment_date_day'] = '';
		}

		if (isset($this->error['payment_date_month'])) {
			$this->data['error_payment_date_month'] = $this->error['payment_date_month'];
		} else {
			$this->data['error_payment_date_month'] = '';
		}

		if (isset($this->error['payment_date_year'])) {
			$this->data['error_payment_date_year'] = $this->error['payment_date_year'];
		} else {
			$this->data['error_payment_date_year'] = '';
		}

		if (isset($this->error['payment_amount'])) {
			$this->data['error_payment_amount'] = $this->error['payment_amount'];
		} else {
			$this->data['error_payment_amount'] = '';
		}

		if (isset($this->error['bank_receiver'])) {
			$this->data['error_bank_receiver'] = $this->error['bank_receiver'];
		} else {
			$this->data['error_bank_receiver'] = '';
		}

		// if (isset($this->error['bank_sender'])) {
		// 	$this->data['error_bank_sender'] = $this->error['bank_sender'];
		// } else {
		// 	$this->data['error_bank_sender'] = '';
		// }
//
		// if (isset($this->error['transaction_type'])) {
		// 	$this->data['error_transaction_type'] = $this->error['transaction_type'];
		// } else {
		// 	$this->data['error_transaction_type'] = '';
		// }
//
		// if (isset($this->error['account_name'])) {
		// 	$this->data['error_account_name'] = $this->error['account_name'];
		// } else {
		// 	$this->data['error_account_name'] = '';
		// }
//
		// if (isset($this->error['account_number'])) {
		// 	$this->data['error_account_number'] = $this->error['account_number'];
		// } else {
		// 	$this->data['error_account_number'] = '';
		// }
//
		// if (isset($this->error['message'])) {
		// 	$this->data['error_message'] = $this->error['message'];
		// } else {
		// 	$this->data['error_message'] = '';
		// }

 		if (isset($this->error['captcha'])) {
			$this->data['error_captcha'] = $this->error['captcha'];
		} else {
			$this->data['error_captcha'] = '';
		}

    $this->data['button_continue'] = $this->language->get('button_continue');

		$this->data['action'] = HTTP_SERVER . 'index.php?route=information/payment_confirmation';

		// if (isset($this->request->post['name'])) {
		// 	$this->data['name'] = $this->request->post['name'];
		// } else {
		// 	$this->data['name'] = '';
		// }

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['invoice_number'])) {
			$this->data['invoice_number'] = $this->request->post['invoice_number'];
		} else {
			$this->data['invoice_number'] = '';
		}

		if (isset($this->request->post['payment_date_day'])) {
			$this->data['payment_date_day'] = $this->request->post['payment_date_day'];
		} else {
			$this->data['payment_date_day'] = '';
		}

		if (isset($this->request->post['payment_date_month'])) {
			$this->data['payment_date_month'] = $this->request->post['payment_date_month'];
		} else {
			$this->data['payment_date_month'] = '';
		}

		// Menampilkan data tahun start
		$this->data['this_year'] = date("Y");
		$this->data['one_year_before'] = ($this->data['this_year'] - 1);
		// Menampilkan data tahun end
		if (isset($this->request->post['payment_date_year'])) {
			$this->data['payment_date_year'] = $this->request->post['payment_date_year'];
		} else {
			$this->data['payment_date_year'] = '';
		}

		if (isset($this->request->post['payment_amount'])) {
			$this->data['payment_amount'] = $this->request->post['payment_amount'];
		} else {
			$this->data['payment_amount'] = '';
		}

		if (isset($this->request->post['bank_receiver'])) {
			$this->data['bank_receiver'] = $this->request->post['bank_receiver'];
		} else {
			$this->data['bank_receiver'] = '';
		}

		// if (isset($this->request->post['bank_sender'])) {
		// 	$this->data['bank_sender'] = $this->request->post['bank_sender'];
		// } else {
		// 	$this->data['bank_sender'] = '';
		// }
//
		// if (isset($this->request->post['transaction_type'])) {
		// 	$this->data['transaction_type'] = $this->request->post['transaction_type'];
		// } else {
		// 	$this->data['transaction_type'] = '';
		// }
		// Mengambil data banks account start
		$this->load->model('information/payment_confirmation');

		$this->data['banks'] = array();

    	$results= $this->model_information_payment_confirmation->getBanks();

    	foreach ($results as $result) {
    	   $this->data['banks'][] = array(
          'bank_id'    => $result['bank_id'],
          'name'    => $result['name'],
					'branch'   => $result['branch'],
					'account_number'   => $result['account_number'],
					'account_holder'   => $result['account_holder']
          );
    	}

    	// Mengambil data banks account end

    	// Mengambil data banks name start
		$this->load->model('information/payment_confirmation');

		$this->data['banks_name'] = array();

    	$results= $this->model_information_payment_confirmation->getBanksName();

    	foreach ($results as $result) {
    	   $this->data['banks_name'][] = array(
            	'bank_id'    => $result['bank_id'],
            	'name'    => $result['name']
          );
    	}

    	// Mengambil data banks account end

		if (isset($this->request->post['account_name'])) {
			$this->data['account_name'] = $this->request->post['account_name'];
		} else {
			$this->data['account_name'] = '';
		}

		if (isset($this->request->post['account_number'])) {
			$this->data['account_number'] = $this->request->post['account_number'];
		} else {
			$this->data['account_number'] = '';
		}

		// if (isset($this->request->post['message'])) {
		// 	$this->data['message'] = $this->request->post['message'];
		// } else {
		// 	$this->data['message'] = '';
		// }

		if (isset($this->request->post['captcha'])) {
			$this->data['captcha'] = $this->request->post['captcha'];
		} else {
			$this->data['captcha'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/payment_confirmation.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/payment_confirmation.tpl';
		} else {
			$this->template = 'default/template/information/payment_confirmation.tpl';
		}

		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);

 		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
  	}

  	public function success() {
		$this->language->load('information/payment_confirmation');

		$this->document->setTitle($this->language->get('heading_title'));

      $this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	);

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('information/payment_confirmation'),
        	'separator' => $this->language->get('text_separator')
      	);

    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_message'] = $this->language->get('text_message');

    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = HTTP_SERVER . 'index.php?route=common/home';

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

 		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	public function captcha() {
		$this->load->library('captcha');

		$captcha = new Captcha();

		$this->session->data['captcha'] = $captcha->getCode();

		$captcha->showImage();
	}

  	private function validate() {
    	//if ((strlen(utf8_decode($this->request->post['name'])) < 3) || (strlen(utf8_decode($this->request->post['name'])) >// 32)) {
      //		$this->error['name'] = $this->language->get('error_name');
    	//}

		$pattern = '/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i';

    	if (!preg_match($pattern, $this->request->post['email'])) {
      		$this->error['email'] = $this->language->get('error_email');
    	}

		if ((strlen(utf8_decode($this->request->post['invoice_number'])) < 1) || (strlen(utf8_decode($this->request->post['invoice_number'])) > 32)) {
      		$this->error['invoice_number'] = $this->language->get('error_invoice_number');
    	}

		if ((strlen(utf8_decode($this->request->post['payment_date_day'])) < 1) || (strlen(utf8_decode($this->request->post['payment_date_day'])) > 2)) {
      		$this->error['payment_date_day'] = $this->language->get('error_payment_date_day');
    	}

		if ((strlen(utf8_decode($this->request->post['payment_amount'])) < 1)) {
      		$this->error['payment_amount'] = $this->language->get('error_payment_amount');
    	}

    	if ($this->request->post['bank_receiver'] == "") {
      		$this->error['banks'] = $this->language->get('error_banks');
    	}

		// if ((strlen(utf8_decode($this->request->post['account_name'])) < 1)) {
    //   		$this->error['account_name'] = $this->language->get('error_account_name');
    // 	}
//
		// if ((strlen(utf8_decode($this->request->post['account_number'])) < 1)) {
    //   		$this->error['account_number'] = $this->language->get('error_account_number');
    // 	}

    	if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
      		$this->error['captcha'] = $this->language->get('error_captcha');
    	}

		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}
  	}
}
?>