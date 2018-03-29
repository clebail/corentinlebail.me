<?php
class Home_Paper_Admin_Edit_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addJs("/js/jquery.magnific-popup.min.js");
        $this->addJs("/js/highlight.min.js");
        
        $this->addCss("highlight.min.css");
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Administration des articles", "url" => Home_Paper_Admin_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => $datas["title"], "url" => Home_Paper_Admin_Edit_Controller_Index::getUrl("index", "index", $this->params));
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Administration des article - Corentin Lebail";
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("paper/admin/edit/index", $datas);
    }
    
    public function showSocialNetwork() {
        return false;
    }
}