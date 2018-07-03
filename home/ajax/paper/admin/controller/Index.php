<?php
class Home_Ajax_Paper_Admin_Controller_Index extends Home_Ajax_Controller_Abstract {
    public function renderAction() {
        if($this->isRequestGood()) {
            $this->vue->renderContent($this->modele->createRender());
        }else {
            $this->redirect(Home_Controller_Index::getUrl());
        }
    }
}