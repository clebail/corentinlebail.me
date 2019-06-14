<?php
class Home_Test_Controller_Index extends Core_Controller_Abstract {
    public function resultAction() {
        echo "<pre>";
        print_r($this->params);
        echo "</pre>";
        
    }
    
    public function infoAction() {
        phpinfo();
    }
}