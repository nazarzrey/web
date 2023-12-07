<?php
date_default_timezone_set('Asia/Jakarta');	
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "localhost";
$user = "root";
$pass = "";
$db   = "bor1";
$conn = mysql_connect($host,$user,$pass) ;
if (!$conn){
		echo '<script language="javascript">';
		echo 'window.location.href="construk.php";';
		echo '</script>';
}
$cek_database = mysql_select_db($db);
?>
