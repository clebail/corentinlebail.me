<?php
class Home_Openid_Github_Vue_Index extends Home_Vue_Abstract {  
    public function getCurrentUrl() {
        return Home_Openid_Github_Controller_Index::getUrl("index", "index", array(), true);
    }
}