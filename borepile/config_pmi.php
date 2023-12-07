<?PHP
//untuk php ver 5.5 tapi masih pake mysql
// error_reporting(E_ALL ^ E_DEPRECATED);
//===
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pmi_new";
$conn = mysql_pconnect($host, $user, $pass);
if ($conn) {
	mysql_select_db($db) or die(" " . mysql_error());
	$sql = mysql_query("select * from master_web");
	if (!$sql) {
		echo '<script language="javascript">';
		echo 'window.location.href="../construk.php";';
		echo '</script>';
	}
	date_default_timezone_set('Asia/Jakarta');
} else {
	echo '<script language="javascript">';
	echo 'window.location.href="../construk.php";';
	echo '</script>';
}
