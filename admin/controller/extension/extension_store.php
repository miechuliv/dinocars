<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 24.01.14
 * Time: 11:00
 * To change this template use File | Settings | File Templates.
 */

class ControllerExtensionExtensionStore extends Controller{

    public function index()
    {

        error_reporting(E_ALL);
ini_set('display_errors', '1');

        $this->load->model('setting/extension_to_store');

        $this->load->model('setting/store');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_setting_extension_to_store->save($this->request->post['extensions']);
        }
        // get all extensions


        $this->data['stores'] = $this->model_setting_store->getStores();

        $this->data['action'] = $this->url->link('extension/extension_store','token='.$this->session->data['token']);


        $this->data['extensions'] = $this->model_setting_extension_to_store->getAllExtensions();


        $this->template = 'setting/extension_to_store.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());


    }

    public function save()
    {

    }
}