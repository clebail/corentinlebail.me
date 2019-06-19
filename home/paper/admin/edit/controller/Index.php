<?php
class Home_Paper_Admin_Edit_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        if(Home_Modele_Index::isLoggedIn()) {
            $email = Home_Openid_Modele_Abstract::getEmail();
            
            if($email == "corentin.lebail@gmail.com") {
                parent::indexAction();
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
    public function saveAction() {
        if(Home_Modele_Index::isLoggedIn()) {
            $email = Home_Openid_Modele_Abstract::getEmail();
            
            if($email == "corentin.lebail@gmail.com") {
                $this->modele->save($this->params["post"]["id"]);
                $this->redirect(Home_Paper_Admin_Edit_Controller_Index::getUrl("index", "index", array($this->params["post"]["id"])));
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}