<?php
class Home_Test_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addJs("/js/jquery-dropdown.js");
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Test", "url" => Home_Test_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Test - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef de projet et lead developpeur en génie logiciel - a propos";
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("test/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Test_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    public function render($datas) {
        echo $this->callTemplate("test/index", $datas);
    }
}