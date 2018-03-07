<?php
class Home_Modele_Index extends Core_Modele_Abstract {
    public static function isLoggedIn() {
        return Core_Session::getInstance()->hasData(Core_Login_Controller_Index::SESSION_DATA_NAME);
    }
    
    public function logout() {
        Core_Session::getInstance()->destroy();
    }
}