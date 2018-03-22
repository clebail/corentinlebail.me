<?php
require_once("core/Cache.php");

class Core_Clbfw {
	const ADMIN_THEME = "admin";
	const DEFAULT_FRONT_THEME = "default";
	
	public static function getClassFileName($className) {
		$key = self::makeCachePrefix()."#getClassFileName#{$className}";
		
		if(($fileName = Core_Cache::get($key)) == false) {
		    self::syslog("{$key} are not in cache, get it");
			
			$items = explode("_", $className);
			$fileName = "";
			$s = "";
			
			foreach($items as $id => $value) {
				if($id == count($items)-1) {
					$fileName .= $s.$value.".php";
				}else {
					$fileName .= $s.strtolower($value);
				}
				$s="/";
			}
			
			self::sysLog("Require_once file : {$fileName} ({$className})");
			
			Core_Cache::set($key, $fileName);
		}
		
		return $fileName;
	}
	
	public static function parseUri($uri, $get, &$baseClassName, &$objet, &$action, &$params) {
		$key = self::makeCachePrefix()."#parseUri#{$uri}";
		
		if(($values = Core_Cache::get($key)) == false) { 
		    self::syslog("{$key} are not in cache, get it");
			
			$classNameIsFinish = false;
			$onObjetAction = false;
			
			$items = explode("/", $uri);
		
			$values = array();
			$values["baseClassName"] = "";
			$values["params"] = array();
			$values["action"] = "index";
			$values["objet"] = "index";
			
			$s = "";
			$inSearch = false;
		
			foreach($items as $item) {
				if(strlen($item) != 0) {
					if(!$classNameIsFinish) {
						if($item == "p") {
							$classNameIsFinish = true;
						}else if(substr($item, 0 ,1) == "_") {
						    $values["action"] = substr($item, 1);
						} else {
						    $values["baseClassName"].=$s.ucfirst(strtolower($item));
						}
					}else {
						if($onObjetAction) {
							$onObjetAction = false;
							
						}else {
							if ($item == 'search') {
								$inSearch = true;
							} else {
								if ($inSearch) {
									$params['search'] = base64_decode($item);
									$inSearch = false;
								} else {
									$p = $item;
									if(strpos($item, "B64_") === 0) {
										$p = base64_decode(substr($p, 4));
									} else {
										$p = rawurldecode($p);
									}
									$values["params"][] = $p;
								}
							}
						}
					}
					
					$s="_";
				}
			}
			
			Core_Cache::set($key, $values);
		}
		
		$baseClassName = $values["baseClassName"];
		$objet  = $values["objet"];
		$action  = $values["action"];
		$params  = $values["params"];
		
		if(is_array($get)) {
			$params = array_merge($params, $get);
		}
	}
	
	public static function sysLog($message) {
		if(Core_Config::getConfigValue("debug/enable")) {
			self::log($message);
		}
	}
	
	public static function log($message) {
		$e = new Exception();
		$trace = $e->getTrace();
		$lastCall = $trace[1];
		
		if(is_array($message) || is_object($message)) {
			ob_start();
			print_r($message);
			$message = ob_get_contents();
			ob_end_clean();
		}
		
		error_log(date("Y-m-d H:i:s")." - ".$lastCall["file"]." - ".$message."\n", 3, Core_Config::getConfigValue("debug/fileName"));
	}
	
	public static function removeAccents($str, $charset='utf-8', $replaceSpace = false) {
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);		
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
		$str = preg_replace('#&[^;]+;#', '', $str);
		$str = preg_replace('[\']', '', $str);
		
		if($replaceSpace) {
			$str = preg_replace('/\s+/', '_', $str);
		}
		
		return $str;
	}
	
	public static function getBaseDirname() {
		return dirname(__FILE__)."/..";
	}
	
	public static function sendHTMLMail($from, $replyTo, $to, $subject, $htmlMessage, $ccs = array()) {
		$headers = "";
		$headers .= "From: \"{$from}\"\n";
		$headers .= "Reply-To: {$replyTo}\n";
		$headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
		$headers .= "Content-Transfer-Encoding: 8bit";
		
		if(count($ccs) != 0) {
			$headers .= "\nCc: ";
			$s="";
			foreach($ccs as $cc) {
				$headers .= $s.$cc;
				$s = ", ";
			}
		}
		
		$sujet = "=?utf-8?B?".base64_encode($subject)."?=";
		
		if(is_array($to)) {
			$to = implode(", ", $to);
		}
		mail($to, $sujet, $htmlMessage, $headers, "-f{$from}");
	}
	
	public static function getUrl($calledClass, $objet = "index", $action = "index", $params = array(), $hash = "") {
		$key = self::makeCachePrefix()."#getUrl#{$calledClass}_{$objet}_{$action}";
		
		if(($url = Core_Cache::get($key)) == false) {
		    self::syslog("{$key} are not in cache, get it");
			
			$items = explode("_", $calledClass);
			unset($items[count($items)-1]);
		
			$url = "";
			$s = "/";
			foreach($items as $item) {
				$item = strtolower($item);
					
				if($item != "controller") {
					$url .= $s . strtolower($item);
				}
			}
		
			$objet = strtolower(self::removeAccents($objet));
			$action = self::removeAccents($action);
		
			if($objet != "index") {
				$url.="/".$objet;
			}
			
			if($action != "index") {
			    $url.="/_".$action;
			}
			
			Core_Cache::set($key, $url);
		}
	
		$s="";
	
		if(count($params)) {
		    $url.="/p/";
            foreach($params as $key => $param) {
        		if(!is_array($param)) {
        			$p = $param;
        			if(strpos($param, "/") !== false) {
        				$p = "B64_".base64_encode($p);
        			}else {
        				$p = rawurlencode($p);
        			}
        			if($p == "") {
        				$p=0;
        			}
        
        			$url.=$s.$p;
        			$s="/";
        		}
        	}
		}
	
		if(!empty($hash)) {
			$url.="#{$hash}";
		}
	
		return $url;
	}
	
	public static function makeTemplate($theme, $templateName) {
		$key = self::makeCachePrefix()."#makeTemplate#{$theme}#{$templateName}";
		
		if(($template = Core_Cache::get($key)) == FALSE) { 
		    self::syslog("{$key} are not in cache, get it");
			
			$template = self::getBaseDirname()."/render/{$theme}/{$templateName}.phtml";
			
			if(!file_exists($template)) {
				$template = null;
				
				if($theme != self::ADMIN_THEME) {
				    $theme = self::DEFAULT_FRONT_THEME;
					
					$template = self::getBaseDirname()."/render/{$theme}/{$templateName}.phtml";
					if(!file_exists($template)) {
					    self::sysLog("No template {$template}");
						
						$template = null;
					}
				}
			}
			
			if($template != null) {
				Core_Cache::set($key, $template);
			}
		}
		
		return $template;
	}
	
	private static function getAllClass($basePath) {
		$key = self::makeCachePrefix()."#getAllClass#{$basePath}";
		
		if(($clazz = Core_Cache::get($key)) == FALSE) {
		    self::syslog("{$key} are not in cache, get it");
			
			$path = self::getBaseDirname().$basePath;
			$clazz = array();
		
			$allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
			$phpFiles = new RegexIterator($allFiles, '/\.php$/');
			foreach ($phpFiles as $phpFile) {
				$dirName = dirname($phpFile->getRealPath());
					
				$content = file_get_contents($phpFile->getRealPath());
				$tokens = token_get_all($content);
				 
				for ($index = 0; isset($tokens[$index]); $index++) {
					if(!isset($tokens[$index][0])) {
						continue;
					}
		
					if (T_CLASS === $tokens[$index][0]) {
						$index += 2; // Skip class keyword and whitespace
						$clazz[] = $tokens[$index][1];
					}
				}
			}
			
			Core_Cache::set($key, $clazz);
		}
	
		return $clazz;
	}
	
	private static function makeCachePrefix() {
	    return Core_Config::getConfigValue("cache/prefix");
	}
}