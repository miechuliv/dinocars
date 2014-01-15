<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 16.07.13
 * Time: 15:50
 * To change this template use File | Settings | File Templates.
 */

class Debay {

     // @todo aktualizacja tokenów
     // test token
    // private static $_token = "AgAAAA**AQAAAA**aAAAAA**A1HlUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpWBpg2dj6x9nY+seQ**nUcCAA**AAMAAA**Pd7nwyCk/qVFAozflbzwpGo1OsYqb8m8EUFsxA0eaM5jCSnlSKkzlaMl06Eb7NdlvCmFCCfy2cQlu2bMAPTAA9n5Oksp98a1yF7uA4VUUuSYpi+ukima4a8GQMOdGzIn/UogtCZ4WMUveVqzKiSLj6qygjY96m2icxwmp70txF3xvec0u8SUuALox4bDR9Qcu7T1u+Dv5RG55pjsTt1BY+DJl94Tgfee+yb3KLJYyeCaRTcI71aQQbUmquyDjEWbhKuzsh9CFU1XT+mEoJMJRXHcv3E/7E7qPDt89q+7McincSnHsG4XNPTnt1a8rmDhTHU2uKXbA4+HoIVupMnOz+po+kO2x7Bia63YIexGbHuFMbhmBgL6Dq5ahMoTPNPaPGz3AKG4hS0NcLAqcD+xbhr51odu2E+BxjRE8HIqI/PKPYCcqbXszbHUAvqowrar5cum30FQKWTFjTnjCapLcnjE+u8iBBSOJA4U2NWQIW6tVAezlySScl6xjADaUF2w6WqskDmnKdvdARORlNrkY1fwDsHD5M9RPDkM6HXVJXgt8EoIjwar2OQKBRswVFzJv93T+eYAYGI3feFBwXd6cVZZ4LIVlsXuAfPWvI59gKjZ5kJ6tVqFE71/6cSxInJwNlSarTUh07CJc3kdLQS2Vfiq4D9eQAvaTD/mstRLUUoKqh+7mQeCVz9O3gOvz7cmUBKGJJjo64/Qbe6Ebf4pQYyRHHNfqKATZK3KAr87my9sTWxW0rWX/fBw8iFRa2IK";
    // production token
    // @todo wygenerowac tokeny
    private static $_token =
        array(
           'de' => "AgAAAA**AQAAAA**aAAAAA**A1HlUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpWBpg2dj6x9nY+seQ**nUcCAA**AAMAAA**Pd7nwyCk/qVFAozflbzwpGo1OsYqb8m8EUFsxA0eaM5jCSnlSKkzlaMl06Eb7NdlvCmFCCfy2cQlu2bMAPTAA9n5Oksp98a1yF7uA4VUUuSYpi+ukima4a8GQMOdGzIn/UogtCZ4WMUveVqzKiSLj6qygjY96m2icxwmp70txF3xvec0u8SUuALox4bDR9Qcu7T1u+Dv5RG55pjsTt1BY+DJl94Tgfee+yb3KLJYyeCaRTcI71aQQbUmquyDjEWbhKuzsh9CFU1XT+mEoJMJRXHcv3E/7E7qPDt89q+7McincSnHsG4XNPTnt1a8rmDhTHU2uKXbA4+HoIVupMnOz+po+kO2x7Bia63YIexGbHuFMbhmBgL6Dq5ahMoTPNPaPGz3AKG4hS0NcLAqcD+xbhr51odu2E+BxjRE8HIqI/PKPYCcqbXszbHUAvqowrar5cum30FQKWTFjTnjCapLcnjE+u8iBBSOJA4U2NWQIW6tVAezlySScl6xjADaUF2w6WqskDmnKdvdARORlNrkY1fwDsHD5M9RPDkM6HXVJXgt8EoIjwar2OQKBRswVFzJv93T+eYAYGI3feFBwXd6cVZZ4LIVlsXuAfPWvI59gKjZ5kJ6tVqFE71/6cSxInJwNlSarTUh07CJc3kdLQS2Vfiq4D9eQAvaTD/mstRLUUoKqh+7mQeCVz9O3gOvz7cmUBKGJJjo64/Qbe6Ebf4pQYyRHHNfqKATZK3KAr87my9sTWxW0rWX/fBw8iFRa2IK",
           'en' => "AgAAAA**AQAAAA**aAAAAA**06TWUg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wCl4ahDZCFow6dj6x9nY+seQ**7OoBAA**AAMAAA**11GXWShOqDq1LdvDd/zQjmg2q9F/hdchPo4PgBq6cmOYoz/IsltL9T2Yr5vVE8T4WqY3Lc/l25mJX5LaPN//Ol7QhBwvNBdfLxQzwh3X7yQwsAw/ObkXbdEwZYxVybvw9mivhxL33VqZ3CKQoTUOv2L1TypXwyz/poOsmvASsv4CwojIbgiBqLD6BMImRP9BmQzEIoiSJqgaqZhWQBHCdeinklZwN5uPxvsrX9zv6Xo1p8Ty83RGlN2xiDXBIjNAkeHhHy/TsAkkv4FVXeGOKHK6l0216bBwntg4qgZ3yN7isolbifwCfcNnGUWPYVhRuGawOyilCyOautz87QjMTs1XZC9q4Qp8/sWC/hSawIJO1RzjGvGsWb+k9oUGF6+wSEpGvPhJthHYdYE/OD3JmQMOnJ0X6ZU7lzn0EZpDyHsoA2oaULglxs9sEcxDx/Dd20kG2PSM61GQKoru0S6729YCOX8kvAlWCE7vcKPMXT8z7FZkUEN+pBhYBV4RWyo7vh828ohCk3lW7A9XvqdO6zpyGXsNTbHR7VQN5G9qQiRsMmstpoQMEGGRAiiC4G7jM75LTsXP0TSeYqIOlaEKrItFP+g7Kv7p88jFlWyJoFs+tfEnasYc7Xc8djnIm6h3AEWn+zV1bSUpRene8k4iUUIiI4LNXO+EHQUOQ6lduz90HbPT1ywkDTmIsREI4RhJ3tZVm4+IKJTdMww2IgdzEbGF/X66v8soayhvgQ171RQCHuJfUMjmypDWtw7gtYR0",
            'us' => "AgAAAA**AQAAAA**aAAAAA**A1HlUQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhCpWBpg2dj6x9nY+seQ**nUcCAA**AAMAAA**Pd7nwyCk/qVFAozflbzwpGo1OsYqb8m8EUFsxA0eaM5jCSnlSKkzlaMl06Eb7NdlvCmFCCfy2cQlu2bMAPTAA9n5Oksp98a1yF7uA4VUUuSYpi+ukima4a8GQMOdGzIn/UogtCZ4WMUveVqzKiSLj6qygjY96m2icxwmp70txF3xvec0u8SUuALox4bDR9Qcu7T1u+Dv5RG55pjsTt1BY+DJl94Tgfee+yb3KLJYyeCaRTcI71aQQbUmquyDjEWbhKuzsh9CFU1XT+mEoJMJRXHcv3E/7E7qPDt89q+7McincSnHsG4XNPTnt1a8rmDhTHU2uKXbA4+HoIVupMnOz+po+kO2x7Bia63YIexGbHuFMbhmBgL6Dq5ahMoTPNPaPGz3AKG4hS0NcLAqcD+xbhr51odu2E+BxjRE8HIqI/PKPYCcqbXszbHUAvqowrar5cum30FQKWTFjTnjCapLcnjE+u8iBBSOJA4U2NWQIW6tVAezlySScl6xjADaUF2w6WqskDmnKdvdARORlNrkY1fwDsHD5M9RPDkM6HXVJXgt8EoIjwar2OQKBRswVFzJv93T+eYAYGI3feFBwXd6cVZZ4LIVlsXuAfPWvI59gKjZ5kJ6tVqFE71/6cSxInJwNlSarTUh07CJc3kdLQS2Vfiq4D9eQAvaTD/mstRLUUoKqh+7mQeCVz9O3gOvz7cmUBKGJJjo64/Qbe6Ebf4pQYyRHHNfqKATZK3KAr87my9sTWxW0rWX/fBw8iFRa2IK",
        );

    public static function getSite()
    {
        return self::$site;
    }

    private static $debug = false;
     // testowy
  //   private static $_appId = 'dawidrza-1bcd-4bb7-9792-7f7dfb979810';
     // produkcyjny
     private static $_appId = 'somecomp-4d5c-4469-905d-dff647372cf4';

    public static function setDebug($debug)
    {
        self::$debug = $debug;
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


     public static function sendRequest($method,$params){

         if(!self::$site)
         {
              throw new Exception('Nie wybrano strony ebay');
         }

         $site_id = 0;

         if(self::$site == 'de')
         {
             $site_id = 77;
         }
         elseif(self::$site == 'en')
         {
             // $todo kod angielski
             $site_id = 3;

         }

         if(self::$debug)
         {
             self::$site = 'us';
             $site_id = 0;
         }




         // upewnia się ze jest wlasciwa wersja
         $param['Version'] = 805;

         $param['ErrorLanguage'] = 'en_GB';


         // site codes 0 -US 77 - DE  212 - Polska
         // test
        // $client = new SOAPClient(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => 'https://api.sandbox.ebay.com/wsapi?callname=' . $method . '&appid=' . self::$_appId . '&siteid=0&version=821&routing=new'));
//
         // production
         $client = new SOAPClient(self::$_wsdl_url, array('trace' => 1, 'exceptions' => true, 'location' => 'https://api.ebay.com/wsapi?callname=' . $method . '&appid=' . self::$_appId . '&siteid='.$site_id.'&version=821&routing=new'));
         $requesterCredentials = new stdClass();
         $requesterCredentials->eBayAuthToken = self::$_token[self::$site];

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
