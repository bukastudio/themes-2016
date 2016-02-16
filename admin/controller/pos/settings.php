<?php

class ControllerPosSettings extends Controller {

        public function index(){

            $this->currency->set($this->config->get('config_currency'));

            $this->load->model('pos/pos');
            $this->language->load('pos/pos');

            $this->document->setTitle($this->language->get('heading_title'));
            $this->load->model('user/user_group');

            $this->load->model('setting/setting');

            if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
              $this->model_pos_pos->editSettingValue('pos_user_group_id',$this->request->post['pos_user_group_id']);
              $this->model_pos_pos->editSettingValue('pos_tin_no',$this->request->post['pos_tin_no']);
              $this->model_pos_pos->editSettingValue('pos_show_telephone',$this->request->post['pos_show_telephone']);
              $this->model_pos_pos->editSettingValue('pos_show_address',$this->request->post['pos_show_address']);
              $this->model_pos_pos->editSettingValue('pos_show_store_name',$this->request->post['pos_show_store_name']);
              $this->model_pos_pos->editSettingValue('pos_show_tin_no',$this->request->post['pos_show_tin_no']);
              $this->model_pos_pos->editSettingValue('pos_default_store',$this->request->post['pos_default_store']);

              $this->session->data['success'] = $this->language->get('text_success');
              $this->redirect($this->url->link('pos/settings', 'token=' . $this->session->data['token'], 'SSL'));
              }

            if (isset($this->session->data['success'])) {
                    $this->data['success'] = $this->session->data['success'];

                    unset($this->session->data['success']);
            } else {
                    $this->data['success'] = '';
            }

            $this->data['action'] = $this->url->link('pos/settings', 'token=' . $this->session->data['token'], 'SSL');
            $this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

            $this->load->model('setting/store');
            $this->data['stores'] = $this->model_setting_store->getStores();
            $this->data['config_name'] = $this->config->get('config_name');
            $this->data['user_groups'] = $this->model_user_user_group->getUserGroups();

            if (isset($this->request->post['pos_user_group_id'])) {
                    $this->data['pos_user_group_id'] = $this->request->post['pos_user_group_id'];
            } else {
                    $this->data['pos_user_group_id'] = $this->config->get('pos_user_group_id');
            }

            if (isset($this->request->post['pos_tin_no'])) {
                    $this->data['pos_tin_no'] = $this->request->post['pos_tin_no'];
            } else {
                    $this->data['pos_tin_no'] = $this->config->get('pos_tin_no');
            }

            if (isset($this->request->post['pos_show_store_name'])) {
                    $this->data['pos_show_store_name'] = $this->request->post['pos_show_store_name'];
            } else {
                    $this->data['pos_show_store_name'] = $this->config->get('pos_show_store_name');
            }

            if (isset($this->request->post['pos_default_store'])) {
                    $this->data['pos_default_store'] = $this->request->post['pos_default_store'];
            } else {
                    $this->data['pos_default_store'] = $this->config->get('pos_default_store');
            }

            if (isset($this->request->post['pos_show_tin_no'])) {
                    $this->data['pos_show_tin_no'] = $this->request->post['pos_show_tin_no'];
            } else {
                    $this->data['pos_show_tin_no'] = $this->config->get('pos_show_tin_no');
            }

            if (isset($this->request->post['pos_show_telephone'])) {
                    $this->data['pos_show_telephone'] = $this->request->post['pos_show_telephone'];
            } else {
                    $this->data['pos_show_telephone'] = $this->config->get('pos_show_telephone');
            }

            if (isset($this->request->post['pos_show_address'])) {
                    $this->data['pos_show_address'] = $this->request->post['pos_show_address'];
            } else {
                    $this->data['pos_show_address'] = $this->config->get('pos_show_address');
            }

            $this->template = 'pos/setting.tpl';
            $this->children = array(
                'common/header',
                'common/footer'
            );
            $this->response->setOutput($this->render());
        }
}
?>
