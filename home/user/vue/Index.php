<?php
class Home_User_Vue_Index extends Home_Vue_Abstract {
    public function renderBody($datas) {
        echo $this->callTemplate("user/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_User_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Gestion des utilisateurs", "url" => Home_User_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Gestion des utilisateurs - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef et lead developpeur en génie logiciel - gestion des utilisateurs";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
    
    public function showSocialNetwork() {
        return false;
    }
    
    public function asAnalytics() {
        return false;
    }
}