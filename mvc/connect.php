<?php
session_start();
ob_start();

spl_autoload_register('AutoLoader');

define("APP_ROOT", dirname(dirname(__FILE__)));
define("PHARMACY", APP_ROOT . "/mvc");


function AutoLoader($classname) {
	$dir =  PHARMACY. "/view/";
	$extention = ".php";
	$path = $dir . $classname . $extention;
	if (!file_exists($path)) {
		$dir =  PHARMACY . "/controller/";
		$path = $dir . $classname . $extention;
		if (!file_exists($path)) {
			$dir =  PHARMACY . "/model/";
			$path = $dir . $classname . $extention;
			if (!file_exists($path)) {
				if (!file_exists($path)) {
					$dir =  PHARMACY . "/database/";
					$path = $dir . $classname . $extention;
					if (!file_exists($path)) {
						echo "Internal Error";
						exit();
					}
				}
			}
		}
	}

	include_once $path;
}

?>