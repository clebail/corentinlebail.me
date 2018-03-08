<?php
class Home_Login_Create_Controller_Index extends Core_Controller_Abstract {
    public function createAction() {
        if($this->modele->create()) {
            $this->redirect(Home_Login_Create_Success_Controller_Index::getUrl());
        }else {
            $datas = array();
            $datas["content"] = array(
                "firstname" => $this->params["post"]["firstname"],
                "lastname" => $this->params["post"]["lastname"],
                "email" => $this->params["post"]["email"],
                "comments" => $this->params["post"]["comments"],
            );
            $datas["error"] = "Création de compte impossible, merci de réessayer ultérieuement";
            
            $this->vue->render($datas);
        }
    }
}