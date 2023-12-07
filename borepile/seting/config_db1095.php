<?php
date_default_timezone_set('Asia/Jakarta');	
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "192.168.10.95";
$user = "support";
$pass = "GileluNdr0";
$db   = "depok2";
$conn = mysql_pconnect($host,$user,$pass) ;
if (!$conn){
		echo '<script language="javascript">';
		echo 'window.location.href="construk.php";';
		echo '</script>';
}
$cek_database = mysql_select_db($db);
?>
