<?php
class Home_User_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $session = Core_Session::getInstance();
        
        if($session->hasData(Core_Login_Controller_Index::SESSION_DATA_NAME)) {
            $userData = $session->getData(Core_Login_Controller_Index::SESSION_DATA_NAME);
            
            if($userData["login"]["id"] == 1) {
                parent::indexAction();
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}