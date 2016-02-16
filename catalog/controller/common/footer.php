<?php
class ControllerCommonFooter extends Controller {
  protected function index() {
    $this->language->load('common/footer');

    $this->data['text_information'] = $this->language->get('text_information');
    $this->data['text_service'] = $this->language->get('text_service');
    $this->data['text_extra'] = $this->language->get('text_extra');
    $this->data['text_contact'] = $this->language->get('text_contact');
    $this->data['text_return'] = $this->language->get('text_return');
    $this->data['text_sitemap'] = $this->language->get('text_sitemap');
    $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
    $this->data['text_voucher'] = $this->language->get('text_voucher');
    $this->data['text_affiliate'] = $this->language->get('text_affiliate');
    $this->data['text_special'] = $this->language->get('text_special');
    $this->data['text_account'] = $this->language->get('text_account');
    $this->data['text_order'] = $this->language->get('text_order');
    $this->data['text_wishlist'] = $this->language->get('text_wishlist');
    $this->data['text_newsletter'] = $this->language->get('text_newsletter');

    // Bukatoko -- Text
    $this->data['text_social_media'] = $this->language->get('text_social_media');
    $this->data['text_payment_confirmation'] = $this->language->get('text_payment_confirmation');
    $this->data['payment_confirmation'] = $this->url->link('information/payment_confirmation');
    $this->data['text_testimonial'] = $this->language->get('text_testimonial');
    $this->data['testimonial'] = $this->url->link('information/testimonial', '', 'SSL');
    $this->data['text_blog'] = $this->language->get('text_blog');
    $this->data['blog'] = $this->url->link('blog/all', '', 'SSL');
    $this->data['text_pages'] = $this->language->get('text_pages');
    $this->data['text_address'] = $this->language->get('text_address');

    $this->data['logged'] = $this->customer->isLogged();
    // End

    $this->load->model('catalog/information');

    $this->data['informations'] = array();

    foreach ($this->model_catalog_information->getInformations() as $result) {
      if ($result['bottom']) {
        $this->data['informations'][] = array(
          'title' => $result['title'],
          'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
        );
      }
    }

    $this->data['contact'] = $this->url->link('information/contact');
    $this->data['return'] = $this->url->link('account/return/insert', '', 'SSL');
    $this->data['sitemap'] = $this->url->link('information/sitemap');
    $this->data['manufacturer'] = $this->url->link('product/manufacturer');
    $this->data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
    $this->data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
    $this->data['special'] = $this->url->link('product/special');
    $this->data['account'] = $this->url->link('account/account', '', 'SSL');
    $this->data['order'] = $this->url->link('account/order', '', 'SSL');
    $this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
    $this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');

    $this->data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

    // if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == '// on') || ($this->request->server['HTTPS'] == '1'))) {
    //     HTTP_IMAGE = HTTPS_SERVER . 'image/';
    //   } else {
    //     HTTP_IMAGE = HTTP_SERVER. 'image/';
    //   }
      if ($this->config->get('config_footericons_1') && file_exists(DIR_IMAGE . $this->config->get('config_footericons_1'))) {
        $this->data['footericons_1'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_footericons_1')));
      } else {
        $this->data['footericons_1'] = '';
      }
      if ($this->config->get('config_footericons_2') && file_exists(DIR_IMAGE . $this->config->get('config_footericons_2'))) {
        $this->data['footericons_2'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_footericons_2')));
      } else {
        $this->data['footericons_2'] = '';
      }
      if ($this->config->get('config_footericons_3') && file_exists(DIR_IMAGE . $this->config->get('config_footericons_3'))) {
        $this->data['footericons_3'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_footericons_3')));
      } else {
        $this->data['footericons_3'] = '';
      }
      if ($this->config->get('config_footericons_4') && file_exists(DIR_IMAGE . $this->config->get('config_footericons_4'))) {
        $this->data['footericons_4'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_footericons_4')));
      } else {
        $this->data['footericons_4'] = '';
      }
      if ($this->config->get('config_footericons_5') && file_exists(DIR_IMAGE . $this->config->get('config_footericons_5'))) {
        $this->data['footericons_5'] = base64_encode(file_get_contents(HTTP_IMAGE . $this->config->get('config_footericons_5')));
      } else {
        $this->data['footericons_5'] = '';
      }
    // Bukatoko -- Links

      // Countdown Timer
if($this->config->get('countdowntimer_category')){
  $this->load->language('module/countdowntimer');
  $this->data['text_countdown'] = $this->language->get('text_countdown');

  $this->data['countdowntimer_category_texttimer'] = $this->config->get('countdowntimer_category_texttimer');
  $this->data['countdowntimer_category_days'] = $this->config->get('countdowntimer_category_days');
  $this->data['countdowntimer_category_countdays'] = $this->config->get('countdowntimer_category_countdays');
  $this->data['countdowntimer_category_seconds'] = $this->config->get('countdowntimer_category_seconds');

  if($this->config->get('countdowntimer_category_texttimer')){
    $this->data['config_language'] = $this->config->get('config_language');
    $this->data['text_countdown_days'] = $this->language->get('text_countdown_days');
    $this->data['text_countdown_hours'] = $this->language->get('text_countdown_hours');
    $this->data['text_countdown_minutes'] = $this->language->get('text_countdown_minutes');
    $this->data['text_countdown_seconds'] = $this->language->get('text_countdown_seconds');
  }
}
// End
    // Whos Online
    if ($this->config->get('config_customer_online')) {
      $this->load->model('tool/online');

      if (isset($this->request->server['REMOTE_ADDR'])) {
        $ip = $this->request->server['REMOTE_ADDR'];
      } else {
        $ip = '';
      }

      if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
        $url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
      } else {
        $url = '';
      }

      if (isset($this->request->server['HTTP_REFERER'])) {
        $referer = $this->request->server['HTTP_REFERER'];
      } else {
        $referer = '';
      }

      $this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
    }

    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
      $this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
    } else {
      $this->template = 'default/template/common/footer.tpl';
    }

    $this->children = array(
      'common/footer_column'
    );

    $this->render();
  }
}
?>
