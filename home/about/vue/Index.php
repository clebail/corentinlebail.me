<?php
class Home_About_Vue_Index extends Home_Vue_Abstract {
    public function getTitle($datas) {
        return "Corentin Lebail - A propos";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef de projet en développement logiciel - a propos";
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("about/index", $datas);
    }
}