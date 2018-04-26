<?php
class Home_Game_Mine_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addCss("mine.css");
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("game/mine/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Game_Mine_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Jeux", "url" => Home_Game_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Démineur", "url" => Home_Game_Mine_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Démineur - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef et lead developpeur en génie logiciel - jeu du démineur";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
}