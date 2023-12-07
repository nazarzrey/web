<?php
// echo "this nginx coy";
date_default_timezone_set('Asia/Jakarta');	
error_reporting(E_ALL ^ E_DEPRECATED);
if(!file_exists("../zre.txt")){
	$host = "192.168.10.95";
	$user = "root";
	$pass = "sd3123456";
	$db   = "helpdesk";
}else{ 
	$host = "127.0.0.1";
	$user = "root";
	$pass = "";
	$db   = "helpdesk";
}
	//echo "file zre.txt ada";
//}
/* else{
	$host = "localhost:1558";
	$user = "root";
	$pass = "Adeli@4bidzaR";
	$db   = "helpdesk";	
	//echo "file zre.txt ada";
}
 *//*
$my['host'] = "192.168.46.100";
$my['user'] = "root";
$my['pass'] = "12345678";
$my['dbs'] = "support_dc";
*/
$conn = mysql_connect($host,$user,$pass) ;
if (!$conn){
		echo '<script language="javascript">';
		echo 'window.location.href="construk.php";';
		echo '</script>';
}
	$cf_con = "Koneksi : Sukes";
	$cek_database = mysql_select_db($db);
	if ($cek_database){
			$cf_out = "Database : OK";
		}else{
			$cf_out = "Maaf Database tidak ketemu";
		}
	$config= $cf_con." | ".$cf_out;
define ("DBF",$config);
date_default_timezone_set('Asia/Jakarta');
?>
