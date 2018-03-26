<?php
abstract class Core_Controller_Abstract {
	protected $modele;
	protected $vue;
	protected $params;
	
	/**
	 * 
	 * @param string $modeleClassName
	 * @param string $vueClassName
	 * @param string $params
	 */
	public function __construct($modeleClassName, $vueClassName, $params) {
		$this->params = $params;
		
		$this->modele = new $modeleClassName($params);
		$this->vue = new $vueClassName($params);
	}
	
	/**
	 * Action par défaut
	 */
	public function indexAction() {
		$this->vue->render($this->modele->getContent());
	}
	
	/**
	 * 
	 * @param string $uri
	 * 
	 * Effectue une redirection vers l'uri spécifié
	 */
	protected function redirect($uri) {
		header("Location: {$uri}");
	}
	
	/**
	 * 
	 * @param string $objet
	 * @param string $action
	 * @param array $params
	 * @param boolean $full
	 * 
	 * @return string l'url d'accès au controller concerné
	 */
	 public static function getUrl($objet = "index", $action = "index", $params = array(), $full = false) {
	     return Core_Clbfw::getUrl(get_called_class(), $objet, $action, $params, $full);
	}
}