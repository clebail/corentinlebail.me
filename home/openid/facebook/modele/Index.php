<?php
class Home_Openid_Facebook_Modele_Index extends Home_Openid_Modele_Abstract {
    protected static $provider = "facebook";
    
    public function authenticate($code) {
        $ret = null;
        
        $ch = curl_init();
        
        $url = Core_Config::getConfigValue("openid/facebook/accesstokenurl");
        $url .= "?client_id=".Core_Config::getConfigValue("openid/facebook/client_id");
        $url .= "&redirect_uri=".urlencode(Home_Openid_Facebook_Controller_Index::getUrl("index", "result", array(), true));
        $url .= "&client_secret=".Core_Config::getConfigValue("openid/facebook/client_secret");
        $url .= "&code={$code}";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        
        if(($data = curl_exec($ch)) !== false) {
            $data = json_decode($data, true);
            
            if(($user = $this->getUserInfo($data["access_token"])) != null) {
                $this->storeSessionDatas($user["email"], $user["name"], $user["avatar"]);
                $this->storeUserData($user["email"], $user["name"], $user["avatar"]);
                
                Core_Session::getInstance()->setData(Home_Openid_Modele_Abstract::ACCESS_TOKEN, $data["access_token"]);
            }
        } else {
            Core_Clbfw::log(curl_error($ch));
        }
        
        curl_close($ch);
    }
    
    private function getUserInfo($token) {
        $ret = null;
        
        $ch = curl_init();
        
        $url = Core_Config::getConfigValue("openid/facebook/user");
        $url .= "?access_token={$token}";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        
        if(($data = curl_exec($ch)) !== false) {
            $data = json_decode($data, true);
            
            $fileName = md5($data["id"]).".jpg";
            $fullFileName = Core_Config::getConfigValue("avatars/path").$fileName;
            
            file_put_contents($fullFileName, file_get_contents(Core_Config::getConfigValue("openid/facebook/user")."/picture?access_token={$token}"));
            
            $ret["email"] = $data["id"];
            $ret["name"] = $data["name"];
            $ret["avatar"] = Core_Config::getConfigValue("avatars/relativepath").$fileName;
        } else {
            Core_Clbfw::log(curl_error($ch));
        }
        
        curl_close($ch);
        
        return $ret;
    }
}