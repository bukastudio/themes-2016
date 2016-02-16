<?php

class ControllerPosIndex extends Controller {

    public function index() {
        
        $this->session->data['is_for_pos'] = true;
        $data['payment'] = $this->getChild('payment/' . $this->session->data['payment_method']['code']);

        $this->response->setOutput($this->load->view('default/template/pos/pay.tpl', $data));
    }

    //payment success page 
    public function success() {
        
        $data['html'] = html_entity_decode($this->session->data['invoice_html']);

        //remove old total from counter cash if online payment chosen 
        $query = $this->db->query("select user_id, total, payment_method from `" . DB_PREFIX . "order` where order_id = '".$this->session->data['order_id']."'");
        $row = $query->row;

        $sql = "update " . DB_PREFIX . "user set cash = cash - ".$row['total']." where user_id = ".$this->session->data['order_user_id'];
        $this->db->query($sql);

        if (isset($this->session->data['order_id'])) {
            $this->cart->clear();

            unset($this->session->data['invoice_html']);
            unset($this->session->data['shipping_method']);
            unset($this->session->data['shipping_methods']);
            unset($this->session->data['payment_method']);
            unset($this->session->data['payment_methods']);
            unset($this->session->data['guest']);
            unset($this->session->data['comment']);
            unset($this->session->data['order_id']);
            unset($this->session->data['order_user_id']);
            unset($this->session->data['coupon']);
            unset($this->session->data['reward']);
            unset($this->session->data['voucher']);
            unset($this->session->data['vouchers']);
            unset($this->session->data['totals']);
        }

        $this->language->load('pos/success');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_message'] = $this->language->get('text_message');

        $this->response->setOutput($this->load->view('default/template/pos/success.tpl', $data));        
    }
}

?>
