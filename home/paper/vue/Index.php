<?php
class Home_Paper_Vue_Index extends Home_Vue_Abstract {
    public function getTitle() {
        return $this->params[1]." - Corentin Lebail";
    }
    
    public function getDescription() {
        return "Corentin Lebail article ".$this->params[1];
    }
    
    public function renderBody($datas) {
        echo $this->callTemplate("paper/index", $datas);
    }
}