<?php
class Home_Paper_Vue_Index extends Home_Vue_Abstract {
    public function getTitle($datas) {
        return $datas["title"]." - Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail article ". $datas["title"];
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("paper/index", $datas);
    }
}