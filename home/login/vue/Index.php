<?php
class Home_Login_Vue_Index extends Home_Vue_Abstract {
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "<i class='material-icons'>home</i>", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Identification", "url" => Home_Login_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
	public function renderBody($datas) {
		echo $this->callTemplate("login/index", $datas);
	}
	
	public function getTitle() {
	    return "Corentin Lebail - Login";
	}
	
	public function getDescription() {
	    return "Login sur le site Corentin Lebail";
	}
	
	public function getKeywords() {
	    return "login Corentin Lebail";
	}
}