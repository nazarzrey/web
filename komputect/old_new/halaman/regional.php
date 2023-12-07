<?php
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
	$isp      = $query['isp'];
	$country  = $query ['country'];
	$reg_name = $query['regionName'];
	$city     = $query['city'];
} else {
	if($ip=="127.0.0.1"){
		$isp      = "Localhost";
		$country  = "Localhost";
		$reg_name = "Localhost";
		$city     = "Localhost";
	}else{
		$isp      = "Unknown";
		$country  = "Unknown";
		$reg_name = "Unknown";
		$city     = "Unknown";
	}
}
?>