<?php
class Home_Test_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $datas = $this->modele->getContent();
        
        $this->redirect($datas["auth_url"]);
    }
    
    public function resultAction() {
        if(array_key_exists("code", $this->params)) {
            $datas = $this->modele->authenticate($this->params["code"]);
            $this->redirect($datas["redirect_uri"]);
        } else {
            $this->redirect(Home_Test_Controller_Index::getUrl());
        }
        
    }
    
    public function infoAction() {
        if(Core_Session::getInstance()->hasData(Home_Test_Modele_Index::ACCESS_TOKEN)) {
            $accessToken = Core_Session::getInstance()->getData(Home_Test_Modele_Index::ACCESS_TOKEN);
            
            echo "<pre>";
            print_r($accessToken);
            echo "</pre>";
            
            $client = Home_Test_Modele_Index::getGoogleClient();
            $client->setAccessToken($accessToken);
            $plus = new Google_Service_Plus($client);
            $me = $plus->people->get("me");
            echo "<pre>";
            print_r($me);
            echo "</pre>";
        }
        
        phpinfo();
    }
}