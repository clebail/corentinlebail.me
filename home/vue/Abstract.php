<?php
abstract class Home_Vue_Abstract extends Core_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addCss("global.css");
        $this->addCss("responsive.css");
    }
    
    public function getTitle($datas) {
        return "Corentin Lebail";
    }
    
    public function getDescription($datas) {
        return "Corentin Lebail chef de projet en développement logiciel - site personnel";
    }
    
    public function getKeywords($datas) {
        return "Corentin,Lebail,c,cpp,c++,java,developpement,php,javascript";
    }
}