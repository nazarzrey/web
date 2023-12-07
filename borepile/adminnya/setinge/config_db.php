<?php
date_default_timezone_set('Asia/Jakarta');	
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "depok2";
$conn = mysql_pconnect($host,$user,$pass) ;
if (!$conn){
		echo '<script language="javascript">';
		echo 'window.location.href="construk.php";';
		echo '</script>';
}
$cek_database = mysql_select_db($db);
?>
