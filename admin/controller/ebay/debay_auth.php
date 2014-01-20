<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 16.01.14
 * Time: 12:17
 * To change this template use File | Settings | File Templates.
 */

class ControllerEbayDebayAuth extends Controller{

    public function index()
    {
        $runMane = 'some_company-somecomp-6fb7-4-nlfztp';

        $site = $this->request->get['site'];

        $params = array(

            'Version' => 831,
            'RuName' => $runMane,

        );

        debay::setDebug(true);
        debay::setSite($site);
        $resp = debay::sendFullRequest('GetSessionID',$params);

        $this->session->data['SessionID']  = $resp->SessionID;

        $magic_url = 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll?SignIn&RuName='.$runMane.'&SessID='.$resp->SessionID;

        header("Location: ".$magic_url);
        die();

    }

    public function fetchToken()
    {
        $runMane = 'some_company-somecomp-6fb7-4-nlfztp';

        $site = $this->request->get['site'];

        $params = array(

            'Version' => 831,
            'SessionID' => $this->session->data['SessionID'],

        );


        $resp = debay::sendFullRequest('FetchToken',$params);

        if($resp AND isset($resp->eBayAuthToken))
        {
            $this->saveToken($resp->eBayAuthToken);

            unset($this->session->data['SessionID']);

            $this->data['msg'] = 'Token zostal pobrany, możesz teraz korzystać z integracji z Ebay';
        }
        else
        {

            $this->data['msg'] = 'wystapił błąd podczas pobierania Tokenu, integracja z Ebay nie jest w tej chwili mozliwa';
        }

        $this->template = 'ebay/debay_auth.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    private function saveToken($token)
    {
        $this->load->model('setting/setting');

        $site = $this->request->get['site'];

        $this->model_setting_setting->editSetting('debay_'.$site, array('debay_token_'.$site => $token));


    }
}