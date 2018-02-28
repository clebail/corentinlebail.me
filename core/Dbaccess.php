<?php
class Core_Dbaccess {
	private static $instance = null;
	private $pdo;
	
	public static function getInstance() {
		if(self::$instance == null) {
			self::$instance = new Core_Dbaccess();
		}
		
		return self::$instance;
	}
	
	private function __construct() {
		$this->createPDo();

		$this->pdo->exec("SET NAMES 'utf8'");
		$this->pdo->exec("SET CHARACTER SET utf8");
	}
	
	private function createPDO() {
		$this->pdo = new PDO(Core_Config::getConfigValue("pdo/dns"), Core_Config::getConfigValue("pdo/user"), Core_Config::getConfigValue("pdo/password"));
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	public function getPdo() {
		return $this->pdo;
	}
}
