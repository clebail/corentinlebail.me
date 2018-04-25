<?php
class Home_Game_Vue_Index extends Home_Vue_Abstract {
    public function renderBody($datas) {
        echo $this->callTemplate("game/index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Game_Controller_Index::getUrl("index", "index", array(), true);
    }
    
    public function getTitle($datas) {
        return "Jeux - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef et lead developpeur en génie logiciel - jeux";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
}