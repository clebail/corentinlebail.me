<?php
abstract class Home_Openid_Modele_Abstract extends Core_Modele_Abstract {
    const ACCESS_TOKEN = "access_token";
    const SESSION_DATAS = "openid_session_datas";
    
    public static function getEmail() {
        return self::getData("email");
    }
    
    public static function getName() {
        return self::getData("name");
    }
    
    public static function getAvatar() {
        return self::getData("avatar");
    }
    
    protected function storeSessionDatas($email, $name, $avatar) {
        Core_Session::getInstance()->setData(Home_Openid_Modele_Abstract::SESSION_DATAS, array(
            "email" => $email,
            "name" => $name,
            "avatar" => $avatar,
        ));
    }
    
    private static function getData($key) {
        if(Core_Session::getInstance()->hasData(Home_Openid_Modele_Abstract::SESSION_DATAS) && Core_Session::getInstance()->hasData(Home_Openid_Modele_Abstract::ACCESS_TOKEN)) {
            $datas = Core_Session::getInstance()->getData(Home_Openid_Modele_Abstract::SESSION_DATAS);
            
            if(is_array($datas) && array_key_exists($key, $datas)) {
                return $datas[$key];
            }
        }
        
        return null;
    }
}