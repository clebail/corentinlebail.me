<?php
class Home_Openid_Github_Modele_Index extends Core_Modele_Abstract {
    public function authenticate($code) {
        $ret = array();
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_URL, Core_Config::getConfigValue("openid/github/accesstokenurl")."?client_id=".Core_Config::getConfigValue("openid/github/client_id")."&client_secret=".Core_Config::getConfigValue("openid/github/client_secret")."&code={$code}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        
        if(($data = curl_exec($ch)) !== false) {
            $data = json_decode($data, true);
            //TODO store access_token in session            
        } else {
            Core_Clbfw::log(curl_error($ch));
        }
        
        curl_close($ch);
        
        $ret["redirect_uri"] = Home_Controller_Index::getUrl();
        
        return $ret;
    }
}