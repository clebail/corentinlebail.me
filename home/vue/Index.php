<?php
class Home_Vue_Index extends Home_Vue_Abstract {
    public function renderBody($datas) {
        echo $this->callTemplate("index", $datas);
    }
    
    public function getCurrentUrl() {
        return Home_Controller_Index::getUrl("index", "index", array(), true);
    }
}