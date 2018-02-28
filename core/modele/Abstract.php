<?php
abstract class Core_Modele_Abstract {
	protected $params;
	
	public function __construct($params) {
		$this->params = $params;
	}
	
	public function getContent() {
		return array();
	}
}