<?php
class Home_Game_Sokoban_Vue_Index extends Home_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addCss("sokoban.css");
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("game/sokoban/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Game_Sokoban_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Jeux", "url" => Home_Game_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Sokoban", "url" => Home_Game_Sokoban_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function getTitle($datas) {
        return "Sokoban - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef et lead developpeur en génie logiciel - jeu sokoban";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
}