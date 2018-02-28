<?php
abstract class Home_Vue_Abstract extends Core_Vue_Abstract {
    public function __construct($params) {
        parent::__construct($params);
        
        $this->addCss("global.css");
        $this->addCss("responsive.css");
    }
}