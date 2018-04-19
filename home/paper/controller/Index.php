<?php
class Home_Paper_Controller_Index extends Core_Controller_Abstract {
    public function indexAction() {
        $datas = $this->modele->getContent();
        
        if(count($datas) != 0) {
            $this->vue->render($datas);
        } else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}