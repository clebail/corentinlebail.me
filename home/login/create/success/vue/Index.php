<?php
class Home_Login_Create_Success_Vue_Index extends Home_Vue_Abstract {
    protected function createBreadCrumbs($datas) {
        $breadCrumbs[] = array("key" => "Accueil", "url" => Home_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Identification", "url" => Home_Login_Controller_Index::getUrl());
        $breadCrumbs[] = array("key" => "Demande d'ouverture e compte", "url" => Home_Login_Create_Controller_Index::getUrl());
        
        return $breadCrumbs;
    }
    
    public function __construct($params) {
        parent::__construct($params);
    }
    
	public function renderBody($datas) {
		echo $this->callTemplate("login/create/success", $datas);
	}
	
	public function getTitle() {
	    return "Corentin Lebail - Demande d'ouverture de compte";
	}
	
	public function getDescription() {
	    return "Demande d'ouverture de compte sur le site Corentin Lebail";
	}
	
	public function getKeywords() {
	    return "ouverture compte Corentin Lebail";
	}
}