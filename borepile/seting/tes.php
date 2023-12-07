<?php
// echo "this nginx coy";
date_default_timezone_set('Asia/Jakarta');	
error_reporting(E_ALL ^ E_DEPRECATED);/* 
if(!file_exists("../zre.txt")){
	$host = "192.168.10.95";
	$user = "root";
	$pass = "sd3123456";
	$db   = "helpdesk";
}else{  */
	$host = "192.168.10.192";
	$user = "support";
	$pass = "Support@sd3";
	$db   = "helpdesk";
//}
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
$conn = mysql_pconnect($host,$user,$pass) ;

$s1 = mysql_query("show full tables");

while($ss = mysql_fetch_array($s1)){
	echo $ss[0]."</br>";
}
