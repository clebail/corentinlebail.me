<?php
abstract class Core_Login_Controller_Index extends Core_Controller_Abstract {
	const SESSION_DATA_NAME = "adminLogin";
	
	public function postAction() {
		
		if($this->modele->loginSuccess($this->params["post"]["login"], $this->params["post"]["password"], $userData)) {
			Core_Session::getInstance()->setData(Core_Login_Controller_Index::SESSION_DATA_NAME, $userData);
			
			$this->redirect($this->getRedirectUrl());
		}else {
			$datas = array();
			$datas["content"] = array("login" => $this->params["post"]["login"]);
			$datas["error"] = "Connexion impossible, vérifier vos identifiants";
			
			$this->vue->render($datas);
		}
	}
	
	protected abstract function getRedirectUrl();
}