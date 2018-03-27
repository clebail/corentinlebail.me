<?php
class Home_About_Vue_Index extends Home_Vue_Abstract {
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "A propos", "url" => Home_About_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }public function getTitle($datas) {
        return "A propos - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef de projet et lead developpeur en génie logiciel - a propos";
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("about/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_About_Controller_Index::getUrl("index", "index", array(), true);
    }
}