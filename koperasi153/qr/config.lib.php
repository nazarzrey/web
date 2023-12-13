<?php
	require_once "config/config.db.php";
	require_once "config/config.web.php";
	// require_once "config/config.browser.php";
	$http   = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
	$path   = $http.$_SERVER['HTTP_HOST']."/qr/";
?>