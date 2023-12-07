<?PHP
//untuk php ver 5.5 tapi masih pake mysql
error_reporting(E_ALL ^ E_DEPRECATED);
//===
$pc_name =  str_replace("pc","",str_replace("-","",strtolower(gethostbyaddr($_SERVER['REMOTE_ADDR']))));
if($pc_name=="adna"){
	$host = "192.168.2.180:3309";
	$user = "root";
	$pass = "";
	$db   = "komputec";
}else{
	$host = "localhost";
	$user = "n42r3y_kompute";
	$pass = "GileluNdr0@kompute";
	$db   = "n42r3y_komputec";
}
$conn = mysql_connect($host,$user,$pass);
if ($conn){
mysql_select_db($db) or die (" ".mysql_error());
$sql = mysql_query("select * from profile");
	if (!$sql){
		echo '<script language="javascript">';
		echo 'window.location.href="404.php";';
		echo '</script>';
	}
}
date_default_timezone_set('Asia/Jakarta');
?>