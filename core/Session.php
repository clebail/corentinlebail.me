<?php
class Core_Session {
	private static $instance = null;
	
		private function __construct() {
	}
	
	public static function getInstance() {
		if(self::$instance == null) {
			self::$instance = new Core_Session();
		}
		
		return self::$instance;
	}
	
	public function setData($key, $data) {
		if($this->isSessionStarted()) {
			$_SESSION[$key] = $data;
		}
	}
	
	public function getData($key) {
		if($this->isSessionStarted() && isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}

		return null;
	}
	
	public function hasData($key) {
		if($this->isSessionStarted() && isset($_SESSION[$key])) {
			return true;
		}
		
		return false;
	}
	
	public function destroy($key = null) {
		if($key == null) {
			foreach($_SESSION as $key => $session) {
				unset($_SESSION[$key]);
			}
		}else {
			if($this->hasData($key)) {
				unset($_SESSION[$key]);
			}
		}
	}
	
	private function isSessionStarted() {
		if(version_compare(phpversion(), '5.4.0', '>=')) {
			return session_status() != PHP_SESSION_NONE;
		}else {
			return session_id() !== '';
		}
	}
} 
?>