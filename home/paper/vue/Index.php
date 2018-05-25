<?php
class Home_Paper_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addJs("/js/highlight.min.js");
        
        $this->addCss("highlight.min.css");
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => $datas["title"], "url" => Home_Paper_Controller_Index::getUrl("index", "index", $this->params));
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return $datas["title"]." - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail article ". $datas["title"];
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("paper/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Paper_Controller_Index::getUrl("index", "index", $this->params, true);
    }
    
    public function getJSONLD($datas) {
        return $this->callTemplate("paper/jsonld/index", $datas);
    }
}