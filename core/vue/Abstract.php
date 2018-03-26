<?php
abstract class Core_Vue_Abstract {
	protected $params;
	protected $jss;
	protected $csss;
	protected $theme;
	private $breadCrumbs;
	private $templates;
	
	public function __construct($params) {
		$this->params = $params;
		$this->jss = array();
		$this->csss = array();
		
		$this->theme =  Core_Clbfw::DEFAULT_FRONT_THEME;
		$this->breadCrumbs = array();
		$this->templates = array();
	}
	
	public function render($datas) {
	    $this->breadCrumbs = array_merge($this->breadCrumbs, $this->createBreadCrumbs($datas));
	    echo $this->callTemplate("page", $datas);
	}
	
	public function callTemplate($templateName, $datas = array()) {
		ob_start();
		if(isset($this->templates[$templateName])) {
		    $template = $this->templates[$templateName];
		}else {
		    $template = Core_Clbfw::makeTemplate($this->theme, $templateName);
		    $this->templates[$templateName] = $template;
		}
		require($template);
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
	
	public function getTitle($datas) {
	    return "Clbfw";
	}
	
	public function getDescription($datas) {
	    return "Clbfw";
	}
	
	public function getKeywords($datas) {
	    return "Clbfw";
	}
	
	public function getCurrentUrl() {
	    return Core_Controller_Abstract::getUrl("index", "index", array(), true);
	}
	
	public function showSocialNetwork() {
	    return true;
	}
	
	protected function addJs($js, $id = null, $datas = null) {
		$this->jss [] = array("src" => $js, "id" => $id, "datas" => $datas);
	}
	
	protected function addCss($css) {
		$this->csss [] = "/css/{$this->theme}/{$css}";
	}
	
	protected function renderBody($datas) {
	}
	
	protected function createBreadCrumbs($datas) {
	    return array();
	}
} 