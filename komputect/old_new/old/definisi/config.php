<?php
?>

<?PHP
//untuk php ver 5.5 tapi masih pake mysql
error_reporting(E_ALL ^ E_DEPRECATED);
//===
/*
$pc_name =  str_replace("pc","",str_replace("-","",strtolower(gethostbyaddr($_SERVER['REMOTE_ADDR']))));
if($pc_name=="adna"){
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "komputec";
}else{
*/
	$host = "localhost";
	$user = "komputec_lift";
	$pass = "Gilelundro@komputeC";
	$db   = "komputec_lift";
//}
$conn = mysql_connect($host,$user,$pass);
if ($conn){
mysql_select_db($db) or die (" ".mysql_error());
$sql = mysql_query("select * from profile");
	if (!$sql){
		echo '<script language="javascript">';
		echo 'window.location.href="konstruk.html";';
		echo '</script>';
	}
}
date_default_timezone_set('Asia/Jakarta');
?>