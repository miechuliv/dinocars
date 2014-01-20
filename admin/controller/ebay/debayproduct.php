<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 18.07.13
 * Time: 11:29
 * To change this template use File | Settings | File Templates.
 */

class ControllerEbayDebayProduct extends Controller {

    public function __construct($registry)
    {

        parent::__construct($registry);
        if(isset($this->request->get['site']))
        {
            debay::setSite($this->request->get['site']);

        }
        if(isset($this->request->post['site']))
        {
            debay::setSite($this->request->post['site']);

        }


    }

   public function index(){


          $this->getForm();
   }

    private function getLang()
    {
               $this->load->language('ebay/debay');


    }

    private function getForm()
    {

        $this->data['site'] = $site = $this->request->get['site'];

        // id jezyka potrzebne do opisuw
        $this->load->model('localisation/language');

        $data = array(
            'filter_code' => ($site=='gb'?'en':$site)
        );

        $langs = $this->model_localisation_language->getLanguages($data);

        $language = array_shift($langs);

        $language_id = $language['language_id'];


        $this->getLang;

        $this->load->model('ebay/debay');

        $this->data['main_categories'] = $this->model_ebay_debay->getFirstLevel($site);

        $this->load->model('catalog/product');

        $this->load->model('allegro/product');

        $product = $this->model_allegro_product->getProduct($this->request->get['product_id'],$language_id);

        $categories = $this->model_allegro_product->getCategories( $this->request->get['product_id'] ) ;

        $this->data['product_id'] = $this->request->get['product_id'];

        $this->load->model('ebay/debay');





        // templatki

        $this->load->model('ebay/debaytemplates');

        $templates = $this->model_ebay_debaytemplates->getSzablony($site);

        $this->data['templates'] = array();

        $url = '&site='.$this->request->get['site'];

        foreach($templates as $template)
        {
            $this->data['templates'][] = array(
                'name' => $template['name'],
                'title' => $template['title'],
                'href' => $this->url->link('ebay/debayproduct/showtemplate', 'token=' . $this->session->data['token'] . '&name='.$template['name'].'&price='.$product['price'] .'&product_id='.$this->request->get['product_id']. $url, 'SSL')
            );
        }




        // nazwa
        if(isset($this->session->data['debay_fields']['Title']))
        {
            $this->data['Title'] = $this->session->data['debay_fields']['Title'];
        }
        else
        {


                // 50 znaków ograniczenie allegro
            $Title = substr($product['name'],0,50);


            // skrocenie tytułu
            $this->data['Title'] = trim($Title);
        }

        $this->data['price'] = $product['price'];





        // cena kup teraz
        if(isset($this->session->data['debay_fields']['StartPrice']))
        {
            $this->data['BuyItNowPrice'] = $this->session->data['debay_fields']['BuyItNowPrice'];
        }
        else
        {
            $this->data['BuyItNowPrice'] = $product['price'];
        }

        // cena wywoławcza
        if(isset($this->session->data['debay_fields']['StartPrice']))
        {
            $this->data['StartPrice'] = $this->session->data['debay_fields']['StartPrice'];
        }
        else
        {
            $this->data['StartPrice'] = NULL;
        }

        // cena minimalna
        if(isset($this->session->data['debay_fields']['StartPrice']))
        {
            $this->data['ReservePrice'] = $this->session->data['debay_fields']['ReservePrice'];
        }
        else
        {
            $this->data['ReservePrice'] = NULL;
        }

        // lokalizacja
        if(isset($this->session->data['debay_fields']['Location']))
        {
            $this->data['Location'] = $this->session->data['debay_fields']['Location'];
        }
        else
        {
            $this->data['Location'] = NULL;
        }

        // lista lokalizacji
        $this->data['regions'] = $this->model_ebay_debay->getRegionDetails();

        // casz trwania
        if(isset($this->session->data['debay_fields']['ListingDuration']))
        {
            $this->data['ListingDuration'] = $this->session->data['debay_fields']['ListingDuration'];
        }
        else
        {
            $this->data['ListingDuration'] = NULL;
        }

        $this->data['duration_codes'] = array(
            'Days_3' => '3 dni',
            'Days_5' => '5 dni',
            'Days_7' => '7 dni',
            'Days_10' => '10 dni',
            'Days_14' => '14 dni',
            'Days_21' => '21 dni',
            'Days_30' => '30 dni',
            'Days_60' => '60 dni',
        );

        // kraj, na razie nastałe Niemcy
   /*     if(isset($this->session->data['debay_fields']['Country']))
        {
            $this->data['Country'] = $this->session->data['debay_fields']['Country'];
        }
        else
        {
            $this->data['Country'] = $this->config->get('debay_country');
        }

        $this->data['countries'] = $this->model_ebay_debay->getCountryCodes();

        // waluta, na razie na stałe zapsawam EUR
        if(isset($this->session->data['debay_fields']['Currency']))
        {
            $this->data['Currency'] = $this->session->data['debay_fields']['Currency'];
        }
        else
        {
            $this->data['Currency'] = $this->config->get('debay_currency');
        }

        $this->data['currencies'] = $this->model_ebay_debay->getCurrency(); */

   /*     // strona, na razie na stale DE ( miecny)
        if(isset($this->session->data['debay_fields']['Site']))
        {
            $this->data['Site'] = $this->session->data['debay_fields']['Site'];
        }
        else
        {
            $this->data['Site'] = 'US';
        } */

        // @todo zrobić wbyów zdjecia do miniaturki
        $this->data['PictureDetails'] = $product['image'];

        // stan przedmiotu
        if(isset($this->session->data['debay_fields']['ConditionID']))
        {
            $this->data['ConditionID'] = $this->session->data['debay_fields']['ConditionID'];
        }
        else
        {
            $this->data['ConditionID'] = NULL;
        }

        // @todo lista stanów
        // http://developer.ebay.com/DevZone/XML/docs/WebHelp/wwhelp/wwhimpl/js/html/wwhelp.htm?context=eBay_XML_API&topic=ItemCondition

        $this->data['conditions'] = array(
            '1000' => 'Nowy',
            '3000' => 'Używany',
            '7000' => 'Na częsci',
        );


        // maksymalny czas wysyłki
        if(isset($this->session->data['debay_fields']['DispatchTimeMax']))
        {
            $this->data['DispatchTimeMax'] = $this->session->data['debay_fields']['DispatchTimeMax'];
        }
        else
        {
            $this->data['DispatchTimeMax'] = $this->config->get('debay_dispatch_time');
        }

        $this->data['disptach_time_codes'] = $this->model_ebay_debay->getDispatchTime();

        $this->data['dispatch_code_translate'] = array(
           0 => 'Natychmiast',
            1 => '1 Dzień',
            2 => '2 Dni',
            3 => '3 Dni',
            4 => '4 Dni',
            5 => '5 Dni',
            10 => '10 Dni',
            15 => '15 Dni',
            20 => '20 Dni',
            30 => '30 Dni',

        );
        // metody płatności


        $url = '';
        $this->data['debay_product_add_action'] = $this->url->link('ebay/debayproduct/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $url = '';
        $this->data['debay_product_show_template'] = $this->url->link('ebay/debayproduct/viewtemplate', 'token=' . $this->session->data['token'] . $url, 'SSL');


        $this->template = 'ebay/debay_product.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
            'ebay/debayjs'
        );

        $this->response->setOutput($this->render());
    }

    public function getattributes()
    {
        ob_start();



        //debay::setSite($this->request->post['site']);

        $json = array();

        if(!isset($this->request->post['category_id']))
        {
            $json['error'] = 'Brak kategorii';
        }

        if(!isset($json['error']))
        {
            $this->load->model('ebay/debay');

            try{
                $json['attributes'] = $this->model_ebay_debay->updateCategoryAttributesFromEbay($this->request->post['category_id']);

                if(empty($json['attributes']))
                {
                    $json['empty'] = true;
                }

            }catch(Exception $e)
            {
                $json['error'] = "Bład przy pobieraniu atrybutów ".$e->getMessage();
            }




        }

        ob_end_clean();

        $this->response->setOutput(json_encode($json));
    }

    public function getsubcategory()
    {
        ob_start();

        $json = array();

        if(!isset($this->request->post['category_id']))
        {
            $json['error'] = 'Brak kategorii';
        }

        if(!isset($json['error']))
        {
            $this->load->model('ebay/debay');

            $json['categories'] = $this->model_ebay_debay->getChildrenById($this->request->post['category_id'],$this->request->post['site']);

            if(empty($json['categories']))
            {
                $json['empty'] = true;
            }
        }

        ob_end_clean();

        $this->response->setOutput(json_encode($json));

    }

    public function add()
    {

     //  ob_start();


        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $site = $this->request->post['site'];

            error_reporting(E_ALL);
            ini_set('display_errors', '1');

            $this->load->model('catalog/product');

            $product = $this->model_catalog_product->getProduct($this->request->post['product_id']);



            // dane niezbedne do wystawienia produktu:
            // metody wysyłki

            $this->load->model('ebay/debay');
            // lista metod
            $this->data['shipping_services'] = $this->model_ebay_debay->getShippingServiceDetails($site);


            // spraawdza ktore z nich sa zdefiniowanie ww config
            foreach($this->data['shipping_services'] as $key => $value)
            {
                if($this->config->get('debay_shipping_cost_'.$value->ShippingService))
                {
                    $this->data['shipping_services'][$key]->Cost = $this->config->get('debay_shipping_cost_'.$value->ShippingService);
                }
                else
                {
                   unset($this->data['shipping_services'][$key]);
                }
            }


            $shipping = array();

            $shipping['ShippingType'] = 'Flat';
            $options = array();

            foreach($this->data['shipping_services'] as $key => $service)
            {
                 $options[] = array(
                     'ShippingService' => $service->ShippingService,
                     'ShippingServiceCost' => $service->Cost,
                  //   'ShippingServiceAdditionalCost' => 0.0,
                     'ShippingServicePriority' => $key+1,
                     'ExpeditedService' => false,
                 );


            }

            $shipping['ShippingServiceOptions'] = $options;

            // metody płatnosci

            $payment_methods = array(
                'CashOnPickup' => 'Zapłata przy odbiorze',
                'PayPal' => 'PayPal',
                'VisaMC' => 'Płatność kartą visa mastercard',
            );


            foreach($payment_methods as $key => $payment)
            {
                if(!$this->config->get('debay_payment_method_'.$site.'_'.$key))
                {
                    unset($payment_methods[$key]);
                }

            }



            $payment_methods = array_flip($payment_methods);

            $extraNodes = array();

            foreach($payment_methods as $payment)
            {
                $extraNodes[] = array(
                    'parent' => 'Item',
                    'namespace' => 'ns1',
                    'name' => 'PaymentMethods',
                    'value' => $payment,
                );
            }





            $returnPolicy = array(

                'ReturnsAcceptedOption' => ($this->config->get('debay_ReturnsAccepted_'.$site)) ? 'ReturnsAccepted' : 'ReturnsNotAccepted',
                'RefundOption' => 'MoneyBack',
            //   'ReturnsWithinOption' => ($this->config->get('debay_ReturnsWithinOption_'.$site)) ? $this->config->get('debay_ReturnsWithinOption_'.$site) : NULL,
                'Description' =>($this->config->get('debay_Description_'.$site)) ? $this->config->get('debay_Description_'.$site) : NULL,
            //    'ShippingCostPaidByOption' => 'Buyer',
            );






            $subcategories = array();

            foreach($this->request->post as $key => $value)
            {
                   if(strpos($key,'subcategory')!==false)
                   {
                       $subcategories[] = $value;
                   }
            }

            $category = array_pop($subcategories);

            // ch-ka danej kategorii
            $features = $this->model_ebay_debay->updateCategoryFeaturesFromEbay($category);

            $rules = $features->Category;


            // to do walidacji
            $errors = $this->checkCategoryRules($rules,$options);


            // specyfikacja produktu

            $specs = array();

            foreach($this->request->post as $key => $value)
            {
                if(strpos($key,'attribute')!==false)
                {
                    $tmp = explode('_',$key);

                    $specs[]=array(
                        'Name' => $tmp[1],
                        'Value' => $value,
                    );
                }
            }



            $itemSpecifics = array('NameValueList' => $specs);

            $this->load->model('tool/image');

            if(isset($this->request->post['BuyItNowPrice']) AND $this->request->post['BuyItNowPrice']!=='' )
            {
                $price = $this->request->post['BuyItNowPrice'];
            }
                    else
                    {
                        $price = false;
                    }


            $currency = debay::getSiteCurrency();

            $site_code = debay::getSiteCode();

            $localisation = $this->config->get('debay_localisation_'.$site);

            $country = $this->config->get('debay_country_'.$site);

            $pay_pal_email = $this->config->get('debay_paypal_email_'.$site);

            $site_ebay = 'US';

            if($site_code == 0)
            {
                $site_ebay = 'US';
            }
            if($site_code == 3)
            {
                $site_ebay = 'UK';
            }
            if($site_code == 77)
            {
                $site_ebay = 'Germany';
            }

            $item = array(
                'PrimaryCategory' => array('CategoryID' => $category ),  // ok
                'Title' => $this->request->post['Title'],
                // @todo zrobixc templating
               // 'Description' => $this->request->post['Description'],
                'Description' => $this->gettemplate($price,$this->request->post['template'],$this->request->post['product_id']),

                // na razie na sztywno
                'Country' => $country,//

                // tak samoi
                // @todo zmieniac walute wg kraju
                'Currency' => $currency,//

                'ListingDuration' =>  $this->request->post['ListingDuration'],//
                // @todo z produktu, w przyszłości wybór zdjęcia, działa ale potrzebna miniaturka
                'PictureDetails' => array(

                    // @todo tu można wcisna takie opcje jak podswietlenie http://developer.ebay.com/devzone/xml/docs/reference/ebay/types/GalleryTypeCodeType.html
                    'GalleryType' => 'Gallery',
                    'GalleryURL' => $this->model_tool_image->resize($product['image'], 200, 200),
                    'PictureURL' => $this->model_tool_image->resize($product['image'], 200, 200),
                ),
                    //
                // na razie na sztywno

                'Site' => $site_ebay,//
                // @todo do wbicia gdzie najlepiej w config debaya
                'Location' => $localisation?$localisation:'N/A',//

                'PayPalEmailAddress' => $pay_pal_email?$pay_pal_email:'none@wp.pl',//
                // @todo w konfig ptrzebne dodatkowe pola bo to zacznie więcej opcji
                'ShippingDetails' => $shipping,//
                'DispatchTimeMax' => $this->request->post['DispatchTimeMax'],//


                'ItemSpecifics' => $itemSpecifics,
                'Quantity' => $this->request->post['Quantity'],

                //@todo dodatkowe
                // 'SellerContactDetails'

            );


            if($this->ConditionEnabled)
            {
                $item['ConditionID'] = $this->request->post['ConditionID'];
            }

            if($this->returnAllowed)
            {
                $item['ReturnPolicy'] = $returnPolicy;
            }

            // ListingType standardowo ustawiony jest na aukcję !!!
            if($this->request->post['cena']=='kup-teraz')
            {
                $item['ListingType'] = 'FixedPriceItem';
                $item['StartPrice'] = (int)$this->request->post['BuyItNowPrice'];

            }
            elseif($this->request->post['cena']=='aukcja')
            {
                $item['StartPrice'] = (int)$this->request->post['StartPrice'];
                $item['ReservePrice'] = (int)$this->request->post['ReservePrice'];
            }





            $params = array(
                'Version' => 831,
                'Item' => $item,
                'ErrorLanguage' => 'en_GB',

            );

            if($this->request->post['real']=='true')
            {
                $method = 'AddItem';


            }
            else
            {
                $method = 'VerifyAddItem';
            }



            $this->data['response']=array();




            try{

                $resp =  debay::sendRequest($method,$params,$extraNodes);



                if(isset($resp) AND ($resp->Ack=='Success' OR $resp->Ack=='Warning'))
                {

                    if($this->request->post['real']=='true'){
                        // zapis id produktu na sklepie, przydzielonego id ebay oraz liczby wystawionych
                    $this->model_ebay_debay->addAuction($this->request->post['product_id'],$resp->ItemID,$this->request->post['Quantity']);
                    }

                    $this->data['response']['auction_id'] = $resp->ItemID;
                 //   $this->data['response']['start_time'] = strtotime($resp->StartTime);
                 //   $this->data['response']['end_time'] = strtotime($resp->EndTime);
                    $url = '';
                //    $this->data['response']['confirm'] = $this->url->link('ebay/debayproduct/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

                    $this->data['response']['fees'] = array();

                    $this->data['response']['total'] = 0;

                    $this->data['response']['success'] = true;

                    settype($this->data['response']['total'],'float');

                    foreach($resp->Fees->Fee as $fee)
                    {


                        if($fee->Fee->_!==(float)0)
                        {
                             $this->data['response']['fees'][] = array(
                                 'name' => $fee->Name,
                                 'amount' => $fee->Fee->_.' '.$fee->Fee->currencyID,
                             );

                            $this->data['response']['total'] += (float)$fee->Fee->_;

                        }
                    }
                }



            }
            catch(Exception $e)
            {
                $this->data['error'] = 'Wystapił błąd podczas dodawania aukcji! Szczeguły: '.$e->getMessage();

                if($this->config->get('debay_debug'))
                {
                      echo $this->data['error'];
                }
                else
                {
                     $this->logger->error($this->data['error'],'debay_additem');

                    if($e->getMessage()=='21919067')
                    {
                        $this->data['response']['error'] = "Wystawiono już produkt o tej nazwie, proszę zmienić nazwę!";
                    }

                }
            }

        }


     //   ob_end_clean();

        if($this->request->post['real']=='true')
        {

            $this->data = $this->data['response'];


            $this->template = 'ebay/debay_success.tpl';
            $this->children = array(
                'common/header',
                'common/footer',
                'ebay/debayjs'
            );

            $this->response->setOutput($this->render());


        }
        else
        {


            $json['response'] = $this->data['response'];

            $this->response->setOutput(json_encode($json));
        }




    }

    private function checkCategoryRules($rules,$shipping_methods)
    {


        $errors = array();
        // sprawdzamy maksymalna oplate za wysylke
        if(isset($rules->MaxFlatShippingCost) AND $rules->MaxFlatShippingCost)
        {
            foreach($shipping_methods as $method)
            {

                if((int)$method['ShippingServiceCost'] > (int)$rules->MaxFlatShippingCost->_)
                {
                    $errors[] = array(
                        'type' => 'ShippingCost',
                        'desc' => 'Wybrana kategoria ma ograniczenia kosztów wysyłki: '.$rules->MaxFlatShippingCost->_.'
                         '.$rules->MaxFlatShippingCost->currencyID.' Skonfiguruj koszt wysyłki dla danego kraju aby móc wystawiać w tej kategorii',
                    );

                    break;
                }
            }

            return $errors;
        }

        // sprawdxzamy czy jest wymagane zasady zwrotuw
        if(isset($rules->ReturnPolicyEnabled) AND !$rules->ReturnPolicyEnabled)
        {
            $this->returnAllowed = false;
        }

        if(isset($rules->ConditionEnabled) AND $rules->ConditionEnabled)
        {
            $this->ConditionEnabled = true;
        }

        // $todo trzeba tez sprawdzić jakei sa ConditionValues bo moga byc inne dla niektorych kategorii
        // lista pozostalych warunkow: http://developer.ebay.com/DevZone/XML/docs/reference/ebay/types/FeatureIDCodeType.html





    }

    private $returnAllowed = true;

    private $ConditionEnabled = false;

    public function finalize()
    {

    }

    public function showtemplate()
    {

           echo $this->gettemplate($this->request->get['price'],$this->request->get['name'],$this->request->get['product_id'],$this->request->get['site']);

    }

    private function gettemplate($price,$name,$product_id)
    {

        // miechu fix
        if(!defined('HTTP_IMAGE'))
        {

            define('HTTP_IMAGE',HTTP_CATALOG.'image/');

        }


        if(isset($this->request->post['site']))
        {
            $site  = $this->request->post['site'];
        }
        elseif(isset($this->request->get['site']))
        {
            $site  = $this->request->get['site'];
        }


        // id jezyka potrzebne do opisuw
        $this->load->model('localisation/language');

        $data = array(
            'filter_code' => ($site=='gb'?'en':$site)
        );

        $langs = $this->model_localisation_language->getLanguages($data);

        $language = array_shift($langs);

        $language_id = $language['language_id'];

        $this->load->model( 'allegro/product' ) ;
        // wyciagamy opis po niemiecku
        $Product = $this->model_allegro_product->getProduct( $product_id , $language_id ) ;
        $ProductImages = $this->model_allegro_product->getProductImages( $product_id ) ;
        $Categories = $this->model_allegro_product->getCategories( $product_id ) ;
        $Options = $this->model_allegro_product->getProductOptions( $product_id ) ;

        require_once DIR_SYSTEM . 'library/HTMLPurifier.auto.php';

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        //  $config->set('HTML.Doctype', 'HTML'); // replace with your doctype
        $config->set('CSS.AllowedProperties', array());
        $purifier = new HTMLPurifier($config);

      //  $ProductDescription = $purifier->purify(html_entity_decode( $Product['description'] )) ;

        $ProductDescription = html_entity_decode($Product['description'])  ;

        $Price='';

        if(isset($price))
        {
            $Price = $price;
            $Price=$this->currency->format($Price, $this->config->get('config_currency'));

            $Price = str_ireplace('€','&euro;',$Price);
           
        }

        $Delivery='';
        $ExtImages = '' ;

        $Manufacturer=$this->model_allegro_product->getManuName( $Product['manufacturer_id'] );

        //$Manufacturer='';
        // miechu
        $IMG= HTTP_IMAGE . $Product['image'] ;
        foreach ( $ProductImages as $ProductImage ) {

            $ExtImages .= '<a  href="' . HTTP_IMAGE . $ProductImage['image'] . '"><img class ="small" src="' . HTTP_IMAGE . $ProductImage['image'] . '"></a>' ;
        }

        $ExtOptions='';

        foreach ( $Options as $Option ) {



            $ExtOptions .= '<p><strong>'.$Option['name'].': </strong></p><p>' ;
            if(isset($Option['product_option_value']) AND is_array($Option['product_option_value']))
            {
                foreach ($Option['product_option_value'] as $value) {
                    $ExtOptions .= ' '.$value['name'].', ' ;
                }

            }
            else
            {
                $ExtOptions .= ' '.$Option['option_value'].' ' ;
            }

            $ExtOptions .= '</p><br/><br/>';
        }

        $ExtCategories='<p>';
        foreach ( $Categories as $Category ) {

            $ExtCategories .= ''.$this->model_allegro_product->getCategoryName( $Category ).' ' ;
            break;
        }
        $ExtCategories.='</p>';


        $this->load->model('ebay/debaytemplates');

        $ShowTemplate = $this->model_ebay_debaytemplates->showTemplate( $name ) ;





        //   var_dump($ShowTemplate);
        $Template = str_replace( array( '{PRODUCT_NAME}', '{PRODUCT_DESCRIPTION}', '{IMAGES}', '{PRODUCT_MODEL}', '{PRODUCT_PRICE}', '{PRODUCT_CATEGORY}', '{PRODUCT_OPTIONS}', '{PRODUCT_DELIVERY}', '{PRODUCT_MANU}', '{IMG}','{MAKE_NAME}','{MODEL_NAME}'), array( $Product['name'], $ProductDescription, $ExtImages, $Product['model'], $Price, $ExtCategories, $ExtOptions, $Delivery, $Manufacturer, $IMG,$Product['make_name'],$Product['model_name'] ), html_entity_decode($ShowTemplate['value']) ) ;

        return $Template ;




    }

    public function ajaxvalidate()
    {
        ob_start();

        $json['error'] = array();

        // @todo poprawic walidację, walidacja template


        $post = $this->request->post;


        if(!$post['Title'] OR $post['Title']=='')
        {
            $json['error']['Title'] = 'Brak nazwy produktu';
        }

        if(strlen($post['Title'])>50)
        {
            $json['error']['Title'] = 'Zbyt długa nazwa prodktu, maksymalnie 50 znaków';
        }

        if($post['cena']=='kup-teraz' AND (!isset($post['BuyItNowPrice']) OR $post['BuyItNowPrice']==''))
        {
            $json['error']['BuyItNowPrice'] = 'Proszę podać cenę "Kup teraz"';
        }

        if($post['cena']=='aukcja' AND $post['StartPrice']=='')
        {
            $json['error']['StartPrice'] = 'Proszę podać cenę początkową';
        }

        if($post['cena']=='aukcja' AND $post['ReservePrice']=='')
        {
            $json['error']['ReservePrice'] = 'Proszę podać cenę minimalną';
        }

        if($post['Quantity']=='')
        {
            $json['error']['Quantity'] = 'Proszę podać ilość sztuk';
        }

        $this->load->model('ebay/debay');

        $result = $this->model_ebay_debay->checkQuantity($post['product_id']);

        if((int)$post['Quantity']>(int)$result['quantity'])
        {
            $json['error']['Quantity'] = 'Próbujesz wystawić wiecej sztuk niż jest na stanie!';
        }

        if($post['category']=='' OR $post['category']=='none')
        {
            $json['error']['category'] = 'Proszę wybrać główna kategorię';
        }

        $subcategories = array();

        foreach($post  as $key =>  $sub)
        {

            if(strpos($key,'subcategory')!==false AND $sub=='Wybierz podkategorię')
            {
                $json['error']['subcategory'] = 'Proszę dokładnie okreslić kategorię';
            }
            elseif(strpos($key,'subcategory')!==false)
            {
                $subcategories[] = $sub;
            }

        }

        $this->load->model('ebay/debay');
        // lista metod
        $this->data['shipping_services'] = $this->model_ebay_debay->getShippingServiceDetails($post['site']);

        // spraawdza ktore z nich sa zdefiniowanie ww config
        foreach($this->data['shipping_services'] as $key => $value)
        {
            if($this->config->get('debay_shipping_cost_'.$value->ShippingService))
            {
                $this->data['shipping_services'][$key]->Cost = $this->config->get('debay_shipping_cost_'.$value->ShippingService);
            }
            else
            {
                unset($this->data['shipping_services'][$key]);
            }
        }


        $options = array();

        foreach($this->data['shipping_services'] as $key => $service)
        {
            $options[] = array(
                'ShippingService' => $service->ShippingService,
                'ShippingServiceCost' => $service->Cost,
                //   'ShippingServiceAdditionalCost' => 0.0,
                'ShippingServicePriority' => $key+1,
                'ExpeditedService' => false,
            );


        }

        $category = array_pop($subcategories);

        // ch-ka danej kategorii
        $features = $this->model_ebay_debay->updateCategoryFeaturesFromEbay($category);

        $rules = $features->Category;

        $errors = $this->checkCategoryRules($rules,$options);

        if(!empty($errors))
        {
            foreach($errors as $error)
            {
                $json['error'][$error['type']] = $error['desc'];
            }
        }



        if(empty($json['error']))
        {
            unset($json['error']);
        }


        ob_end_clean();

        $this->response->setOutput(json_encode($json));
    }

    public function resell()
    {



        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            if(!isset($this->request->post['item_id']))
            {
                ob_start();
                var_dump($this->request->post);
                $contents = ob_get_contents();
                ob_end_clean();
                $this->logger->warning("Prblem id aukcji przy probie ponownego wystawienia ".$contents,'ebay');
            }

            $params = array(
                'Version' => 831,
                'Item' => array('ItemID' => $this->request->post['item_id'] , 'Quantity' => $this->request->post['Quantity'] )

            );


                $method = 'RelistItem';

            try{
                $resp =  debay::sendRequest($method,$params);

                $this->load->model('ebay/debayauctions');

                // @todo sprawdzanie tylko dla jednego danego przedmiotu zeby było szybciej
                $this->model_ebay_debayauctions->checkauctions();

                $result = $this->model_ebay_debay->getProductByAuction($this->request->post['item_id']);

                if(!isset($result['product_id']))
                {
                    ob_start();
                    var_dump($result);
                    var_dump($this->request->post['item_id']);
                    $contents = ob_get_contents();
                    ob_end_clean();
                    $this->logger->warning("Nie udalo sie odzyskac info o aukcji przy ponownym wystawianiu ".$contents,'ebay');
                    throw new Exception("Nie udało sie ponownie wystawic aukcji!");
                }


                $this->model_ebay_debay->addAuction($result['product_id'],$this->request->post['item_id'],$this->request->post['Quantity']);

                $this->data['response']['success'] = "Przedmiot wystawiono ponownie";

                $this->data['response']['fees'] = array();

                $this->data['response']['total'] = 0;

                $this->data['response']['auction_id'] = $resp->ItemID;



                settype($this->data['response']['total'],'float');

                foreach($resp->Fees->Fee as $fee)
                {


                    if($fee->Fee->_!==(float)0)
                    {
                        $this->data['response']['fees'][] = array(
                            'name' => $fee->Name,
                            'amount' => $fee->Fee->_.' '.$fee->Fee->currencyID,
                        );

                        $this->data['response']['total'] += (float)$fee->Fee->_;

                    }
                }

                $this->data = $this->data['response'];

            }catch(Exception $e)
            {
                $this->data['error']  = 'Wystapił błąd: '.$e->getMessage();
            }




        }
        elseif(isset($this->request->get['item_id']))
        {
             $this->data['item_id'] = $this->request->get['item_id'];
             $url = '';
             $this->data['action'] = $this->url->link('ebay/debayproduct/resell', 'token=' . $this->session->data['token'] . $url, 'SSL');
        }
        else
        {
             $this->data['error'] = "Bład: Brak ID przedmiotu";
        }

        $this->data['return_action'] = $this->url->link('ebay/debayseller/active', 'token=' . $this->session->data['token'] . $url , 'SSL');


        $this->template = 'ebay/debay_relist.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
            'ebay/debayjs'
        );

        $this->response->setOutput($this->render());
    }
}