<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 16.07.13
 * Time: 15:50
 * To change this template use File | Settings | File Templates.
 */

class Debay {




    private static $debug = false;

    private static $_appId = array (
        'prod' => 'somecomp-4d5c-4469-905d-dff647372cf4',
        'sandbox' => 'somecomp-6fb7-4d95-b2b9-7ca9b5776f4d'
    );


    private static $_devId = array(
        'prod' => '98c5c5a7-355b-484d-9933-cceaa90541db',
        'sandbox' => '98c5c5a7-355b-484d-9933-cceaa90541db',
    );


    private static $_certId = array(
        'sandbox' => '6f7f9ff7-f0fc-4c76-8a30-37b18072a5d6',
        'prod' => 'b89247ba-6521-452c-af9a-12d4c88f11e5',


    );

    private $ruName = 'some_company-somecomp-6fb7-4-nlfztp';

    private static  $sandboxUrl = 'https://api.sandbox.ebay.com/wsapi';

    private static  $productionUrl = 'https://api.ebay.com/wsapi';

    public static function setDebug($debug)
    {
        self::$debug = $debug;
    }

    private static function getServer()
    {
        if(self::$debug)
        {
             return self::$sandboxUrl;
        }
        else
        {
            return self::$productionUrl;
        }
    }

    private static function getApi()
    {
        if(self::$debug)
        {
            return self::$_appId['sandbox'];
        }
        else
        {
            return self::$_appId['prod'];
        }
    }

    private static function getCert()
    {
        if(self::$debug)
        {
            return self::$_certId['sandbox'];
        }
        else
        {
            return self::$_certId['prod'];
        }
    }

    private static function getDev()
    {
        if(self::$debug)
        {
            return self::$_devId['sandbox'];
        }
        else
        {
            return self::$_devId['prod'];
        }
    }




     // nowy wsdl nie działa
     //private static $_wsdl_url = 'http://developer.ebay.com/webservices/latest/eBaySvc.wsdl'; // downloaded from http://developer.ebay.com/webservices/latest/eBaySvc.wsdl
     // uzylem starszego
     private static $_wsdl_url = 'http://developer.ebay.com/webservices/805/eBaySvc.wsdl';

     private static $error_codes = array(
         196 => "Aukcja trwa albo nie ma jej już w archiwum",
         515 => "Wprowadzono błędna ilość sztuk",
         21919067 => 'Identyczny przedmiot został już wystawiony w innej auckji',
     );

     private static $site;

     public static function setSite($site)
     {
           self::$site = $site;
     }

    public static function getSite()
    {


        return self::$site;
    }


    public static function getSiteCurrency()
    {
        if(!self::$site)
        {
            throw new Exception('Nie wybrano strony ebay');
        }

        $currency = 'EUR';

        if(self::$site == 'de')
        {
            $currency = 'EUR';
        }
        elseif(self::$site == 'gb')
        {
            // $todo kod angielski
            $currency = 'GBP';

        }
        elseif(self::$site == 'us')
        {


            $currency = 'USD';

        }

        return $currency;
    }

    public static function getSiteCode()
    {
        if(!self::$site)
        {
            throw new Exception('Nie wybrano strony ebay');
        }

        $site_id = 0;

        if(self::$site == 'de')
        {
            $site_id = 77;
        }
        elseif(self::$site == 'gb')
        {
            // $todo kod angielski
            $site_id = 3;

        }
        elseif(self::$site == 'us')
        {


            $site_id = 0;

        }

        return $site_id;
    }



     public static function sendFullRequest($method,$params)
     {
         error_reporting(E_ALL);
         ini_set('display_errors', '1');

        $client = new SOAPClient(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => self::getServer().'?callname=' . $method . '&appid=' . self::getApi() . '&siteid='.self::getSiteCode().'&version=821&routing=new'));
        // $client = new SoapProxy(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => self::getServer().'?callname=' . $method . '&appid=' . self::getApi() . '&siteid='.self::getSiteCode().'&version=821&routing=new'));



         $requesterCredentials = new stdClass();
         $requesterCredentials->Credentials  = new stdClass();
         $requesterCredentials->Credentials->DevId = self::getDev();
         $requesterCredentials->Credentials->AppId = self::getApi();
         $requesterCredentials->Credentials->AuthCert = self::getCert();

         $header = new SoapHeader('urn:ebay:apis:eBLBaseComponents', 'RequesterCredentials', $requesterCredentials);

         try{

             $responseObj = $client->__soapCall($method, array($params), null, $header);  // make the API call

         }catch (Exception $e)
         {
             Throw new Exception($e->getMessage());
         }

         return $responseObj;
     }

    private static $token;

    public static function setToken($token)
    {
        self::$token = $token;
    }

    public static function getToken()
    {
        return self::$token;
    }



     public static function sendRequest($method,$params,$extraNodes = false){


         // upewnia się ze jest wlasciwa wersja
         $param['Version'] = 805;

         $param['ErrorLanguage'] = 'en_GB';

         // site codes 0 -US 77 - DE  212 - Polska
         // test
        // $client = new SOAPClient(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => 'https://api.sandbox.ebay.com/wsapi?callname=' . $method . '&appid=' . self::$_appId . '&siteid=0&version=821&routing=new'));
//

         error_reporting(0);
         ini_set('display_errors', '0');
         // production

         if($extraNodes)
         {
             $client = new SoapProxy(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => self::getServer(). '?callname=' . $method . '&appid=' . self::getApi() . '&siteid='.self::getSiteCode().'&version=821&routing=new', array('trace' => TRUE)));
             $client->setExtraNodes($extraNodes);
         }
         else
         {
             $client = new SOAPClient(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => self::getServer(). '?callname=' . $method . '&appid=' . self::getApi() . '&siteid='.self::getSiteCode().'&version=821&routing=new'));
         }



         $requesterCredentials = new stdClass();
         $requesterCredentials->eBayAuthToken = self::getToken();

         $header = new SoapHeader('urn:ebay:apis:eBLBaseComponents', 'RequesterCredentials', $requesterCredentials);

// the API call parameters

         try{
             $responseObj = $client->__soapCall($method, array($params), null, $header);  // make the API call


             if($responseObj->Ack=='Failure')
             {
                  throw new Exception("Bład metody: ".$method);
             }
         }
         catch (Exception $e)
         {
            $error =  'Exception caught. Here are the xml request & response:<br><br>';
             $error.= '$client->__getLastRequest():<br><pre><xmp>' . $client->__getLastRequest() . '</xmp></pre>';
             $error.= '$client->__getLastResponse():<br><pre><xmp>' . $client->__getLastResponse() . '</xmp></pre><br>';

             $error.= '<p>Exception trying to call ' . $method . '</p>';
             $error.= '$e->getMessage()';
             $error.= '<pre>' . $e->getMessage() . '</pre>';

             if(self::$debug)
             {
                 if(ob_get_status())
                 {
                     ob_end_clean();
                 }

                 var_dump($error);
             }

             $resp = $client->__getLastResponse();
             $z = new DOMDocument();
             $z->loadXML($resp);
             $codes = $z->getElementsByTagName('ErrorCode');

             foreach($codes as $code)
             {
                 $error = $code->nodeValue;

                 if(isset(self::$error_codes[$error]))
                 {
                     throw new Exception(self::$error_codes[$error]);
                 }
                 else
                 {
                     throw new Exception('bład'.$error);
                 }

             }






         }


         return $responseObj;
     }
}
