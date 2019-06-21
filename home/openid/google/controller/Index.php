<?php
class Home_Openid_Google_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $datas = $this->modele->getContent();
        
        $this->redirect($datas["auth_url"]);
    }
    
    public function resultAction() {
        if(array_key_exists("code", $this->params)) {
            $datas = $this->modele->authenticate($this->params["code"]);
            $this->redirect($datas["redirect_uri"]);
        } else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
        
    }
}