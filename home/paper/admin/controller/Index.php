<?php
class Home_Paper_Admin_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        if(Home_Modele_Index::isLoggedIn()) {
            $email = Home_Openid_Google_Modele_Index::getEmail();
            
            if($email == "corentin.lebail@gmail.com") {
                parent::indexAction();
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
    public function addAction() {
        if(Home_Modele_Index::isLoggedIn()) {
            $email = Home_Openid_Google_Modele_Index::getEmail();
            
            if($email == "corentin.lebail@gmail.com") {
                $this->modele->add();
                $this->redirect(Home_Paper_Admin_Controller_Index::getUrl());
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
    
    public function deleteAction() {
        if(Home_Modele_Index::isLoggedIn()) {
            $email = Home_Openid_Google_Modele_Index::getEmail();
            
            if($email == "corentin.lebail@gmail.com") {
                $this->modele->delete($this->params["post"]["id"]);
                $this->redirect(Home_Paper_Admin_Controller_Index::getUrl());
            }else {
                $this->redirect(Home_Controller_Index::getUrl());
            }
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}