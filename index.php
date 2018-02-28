<?php
require_once("core/Clbfw.php");
require_once("core/Config.php");

function __autoload($className) {
	$classFileName = Core_Clbfw::getClassFileName($className);
	if(file_exists($classFileName)) {
	    require_once(Core_Clbfw::getClassFileName($className));
	}
}

function shutDown() {
	global $params;

	$error = error_get_last();
	$result = ob_get_contents();
	ob_end_clean();

	if (is_array($error)) {
		ob_start();

		echo '
			<pre>
				Error : <br />';
		print_r($error);
		echo '
			Paramètres : <br />';
		print_r($params);
		echo '</pre>';

		$errorMessage = ob_get_contents();
		ob_end_clean();

		echo $errorMessage;
		echo "<hr />";
	}
	
	echo $result;
}

register_shutdown_function('shutDown');

date_default_timezone_set("Europe/Paris");

$uri = trim($_SERVER["REQUEST_URI"]);

if($uri == "" || $uri == "/") {
	$uri = Home_Controller_Index::getUrl();
}else if(strpos($uri, Core_Config::getConfigValue("admin/base")) == 0 || strpos($uri, Core_Config::getConfigValue("admin/base")) == 1) {
	$uri = str_replace(Core_Config::getConfigValue("admin/base"), "admin", $uri);
}

ini_set('session.gc_maxlifetime', 36000);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);

session_save_path(dirname(__FILE__) . '/sessions');

session_start();

Core_Clbfw::parseUri($uri, $_GET, $baseClassName, $objet, $action, $params);

unset($_GET);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$params['post'] = $_POST;
	
	if(isset($_FILES)) {
		$params['files'] = $_FILES;
		unset($_FILES);
	}

	unset($_POST);
}

$objet = ucfirst($objet);
$controllerClassName = $baseClassName.'_Controller_'.$objet;
$methodeName = $action."Action";
$modeleClassName = $baseClassName.'_Modele_'.$objet;
$vueClassName = $baseClassName.'_Vue_'.$objet;

if(!class_exists($controllerClassName)) {
	Core_Clbfw::sysLog("{$controllerClassName} not found !");
	header("HTTP/1.0 404 Not Found");
	include_once("404.html");
	exit();
}
	
ob_start();

$controller = new $controllerClassName($modeleClassName, $vueClassName, $params);
$controller->$methodeName();
?>