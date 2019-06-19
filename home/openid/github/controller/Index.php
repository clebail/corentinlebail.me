<?php
class Home_Openid_Github_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $this->redirect(Core_Config::getConfigValue("openid/github/identityurl")."?client_id=".Core_Config::getConfigValue("openid/github/client_id"));
    }
    
    public function resultAction() {
        if(array_key_exists("code", $this->params)) {
            $datas = $this->modele->authenticate($this->params["code"]);
            $this->redirect($datas["redirect_uri"]);
        } else {
            $this->redirect(Home_Test_Controller_Index::getUrl());
        }
        
    }
}