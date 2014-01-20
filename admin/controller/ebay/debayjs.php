<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 18.07.13
 * Time: 11:49
 * To change this template use File | Settings | File Templates.
 */

class ControllerEbayDebayJs extends Controller{

        public function index()
        {
            $this->template = 'ebay/debay_js.tpl';

            if(isset($this->request->get['site']))
            {
                $this->data['site'] = $this->request->get['site'];
            }
            elseif(isset($this->request->post['site']))
            {
                $this->data['site'] = $this->request->post['site'];
            }
            else
            {
                $this->data['site'] = '';
            }



            $this->response->setOutput($this->render());
        }
}