<?php
class Home_Ajax_User_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function activeAction() {
        if($this->isRequestGood()) {
            $datas = $this->modele->active($this->params["post"]["id"], $this->params["post"]["active"]);
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}