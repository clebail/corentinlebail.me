<?php
function myAutoloader($className) {
	$classFileName = Core_Clbfw::getClassFileName($className);
	if(file_exists($classFileName)) {
	    require_once($classFileName);
	}
}

spl_autoload_register('myAutoloader');