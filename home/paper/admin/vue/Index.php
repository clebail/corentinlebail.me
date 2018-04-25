<?php
class Home_Paper_Admin_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addJs("/js/jquery.magnific-popup.min.js");
        $this->addJs("/js/jquery.form-validator.min.js");
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Administration des articles", "url" => Home_Paper_Admin_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Administration des article - Corentin Lebail";
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("paper/admin/index", $datas);
    }
    
    public function showSocialNetwork() {
        return false;
    }
    
    public function asAnalytics() {
        return false;
    }
}