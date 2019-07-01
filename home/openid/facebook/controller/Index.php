<?php
class Home_Openid_Facebook_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $ts = time();
        $state = array("key" => md5(Core_Config::getConfigValue("openid/facebook/salt").$ts), "ts" => $ts);
        
        $url = Core_Config::getConfigValue("openid/facebook/identityurl");
        $url .= "?client_id=".Core_Config::getConfigValue("openid/facebook/client_id");
        $url .= "&redirect_uri=".urlencode(Home_Openid_Facebook_Controller_Index::getUrl("index", "result", array(), true));
        $url .= "&state=".json_encode($state);
        
        $this->redirect($url);
    }
    
    public function resultAction() {
       if(array_key_exists("code", $this->params)) {
            $keyOk = true;
            if(array_key_exists("state", $this->params)) {
                $state = json_decode($this->params["state"], true);
                $key = md5(Core_Config::getConfigValue("openid/facebook/salt").$state["ts"]);
            
                $keyOk = $state["key"] == $key;
            }
            if($keyOk) {
                $this->modele->authenticate($this->params["code"]);
            }
            $this->redirect(Home_Controller_Index::getUrl());
        } else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
        
    }
}