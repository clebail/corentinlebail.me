<?php
class Home_Music_Vue_Index extends Home_Vue_Abstract {
    public function renderBody($datas) {
        echo $this->callTemplate("music/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Music_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Musique", "url" => Home_Game_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Musique - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef et lead developpeur en génie logiciel - musique";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
}
