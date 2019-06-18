<?php
class Home_Ajax_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function valideCookiesAction() {
        if($this->isRequestGood()) {
            Core_Session::getInstance()->setData(Home_Modele_Index::COOKIE_SESSION_NAME, true);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}