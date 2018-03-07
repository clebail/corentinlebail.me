<?php
class Home_Controller_Index extends Core_Controller_Abstract {
    public function logoutAction() {
        $this->modele->logout();
        
        $this->redirect(Home_Controller_Index::getUrl());
    }
}