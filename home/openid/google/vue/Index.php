<?php
class Home_Openid_Google_Vue_Index extends Home_Vue_Abstract {  
    public function getCurrentUrl() {
        return Home_Test_Controller_Index::getUrl("index", "index", array(), true);
    }
}