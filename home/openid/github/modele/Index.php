<?php
class Home_Openid_Github_Modele_Index extends Home_Openid_Modele_Abstract {
    protected static $provider = "github";
    
    public function authenticate($code) {
        $ret = array();
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_URL, Core_Config::getConfigValue("openid/github/accesstokenurl")."?client_id=".Core_Config::getConfigValue("openid/github/client_id")."&client_secret=".Core_Config::getConfigValue("openid/github/client_secret")."&code={$code}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        
        if(($data = curl_exec($ch)) !== false) {
            $data = json_decode($data, true);
            
            Core_Session::getInstance()->setData(Home_Openid_Modele_Abstract::ACCESS_TOKEN, $data["access_token"]);
            if(($user = $this->getUserInfo($data["access_token"])) != null) {
                $this->storeSessionDatas($user["email"], $user["name"], $user["avatar"]);
                $this->storeUserData($user["email"], $user["name"], $user["avatar"]);
            }
        } else {
            Core_Clbfw::log(curl_error($ch));
        }
        
        curl_close($ch);
        
        $ret["redirect_uri"] = Home_Controller_Index::getUrl();
        
        return $ret;
    }
    
    private function getUserInfo($token) {
        $ret = null;
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, Core_Config::getConfigValue("openid/github/user"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: token {$token}", "User-Agent: corentinlebail-app"));
        
        if(($data = curl_exec($ch)) !== false) {
            $data = json_decode($data, true);
            
            $ret["email"] = $data["login"];
            $ret["name"] = $data["name"];
            $ret["avatar"] = $data["avatar_url"];
        } else {
            Core_Clbfw::log(curl_error($ch));
        }
        
        curl_close($ch);
        
        return $ret;
    }
}