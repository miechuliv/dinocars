<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 18.07.13
 * Time: 15:35
 * To change this template use File | Settings | File Templates.
 */

class ControllerEbayDebayConfig extends Controller{


    public function __construct($registry)
    {

        parent::__construct($registry);
        if(isset($this->request->get['site']))
        {
            debay::setSite($this->request->get['site']);

        }

    }

      public function index()
      {

          $site = $this->request->get['site'];

          $this->load->model('setting/setting');




          if (($this->request->server['REQUEST_METHOD'] == 'POST')) {


               // można wybrać max cztery metody wysyłki
              $shipping_count = 0;
              foreach($this->request->post as $key => $field)
              {
                   if(strpos($key,'debay_shipping_cost_')!==false AND $field!='')
                  {
                      $shipping_count++;
                  }
              }



              if($shipping_count<5)
              {
                  $this->model_setting_setting->editSetting('debay_'.$site, $this->request->post);

                  $this->redirect($this->url->link('ebay/debayconfig', 'token=' . $this->session->data['token'].'&site='.$site , 'SSL'));

              }
              else
              {
                  $this->data['error_msg'] ='Można wybrać maksymalnie cztery metody wysyłki!';
              }




          }




          // kody czasów zwrotu
          $this->data['return_duration_codes'] = array(
               'Days_3' => '3 dni',
              'Days_7' => '7 dni',
              'Days_10' => '10 dni',
              'Days_14' => '14 dni',
              'Days_30' => '30 dni',
              'Days_60' => '60 dni',
          );

          $this->data['debay_ReturnsWithinOption'] = $this->config->get('debay_ReturnsWithinOption_'.$site);

          // czy zgadzasz się na zwroty?
          $this->data['debay_ReturnsAccepted'] = $this->config->get('debay_ReturnsAccepted_'.$site);

          $this->data['debay_Description'] = $this->config->get('debay_Description_'.$site);

          // metody płatności

          // @todo walidacja metod, nie wkzdym ebayu wszystkie sa dostepne, mozna ja przeprowadzic za pomoca metody getCategoryFeatures z opodiwednim filtrem
          $this->data['payment_methods'] = array(
              $site.'_'.'CashOnPickup' => 'Zapłata przy odbiorze',
              $site.'_'.'PayPal' => 'PayPal',
              $site.'_'.'VisaMC' => 'Płatność kartą visa mastercard',
          );

          // metody platnosci maja swoje prefixy krajowe
          $this->data['debay_payment_method'] = array();
          foreach($this->data['payment_methods'] as $key => $payment)
          {
                $this->data['debay_payment_method'][$key] = $this->config->get('debay_payment_method_'.$key);
          }


          $this->data['debay_paypal_email'] = $this->config->get('debay_paypal_email_'.$site);



          // texts

          $this->data['text_config'] = 'Konfiguracja aukcji ebay';

          $this->data['text_shipping'] = 'Metody wysyłki';

          $this->data['text_payment'] = 'Metody płatności';

          $this->data['text_return_policy'] = 'Polityka zwrotów';

          $this->load->model('ebay/debay');

          $this->data['shipping_services'] = $this->model_ebay_debay->getShippingServiceDetails($site);


          // shiping services maja swoje prefixy krajowe
          foreach($this->data['shipping_services'] as $key => $value)
          {
              if($this->config->get('debay_shipping_cost_'.$value->ShippingService))
              {
                  $this->data['shipping_services'][$key]->Cost = $this->config->get('debay_shipping_cost_'.$value->ShippingService);
              }
              else
              {
                  $this->data['shipping_services'][$key]->Cost = '';
              }

          }

          $url = '&site='.$site;
          $this->data['debay_config_action'] = $this->url->link('ebay/debayconfig', 'token=' . $this->session->data['token'] . $url);

          $this->data['site'] = $site;
          // field list

          // render

          $this->template = 'ebay/debay_config.tpl';
          $this->children = array(
              'common/header',
              'common/footer'
          );

          $this->response->setOutput($this->render());





      }
}