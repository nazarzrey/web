<?php
require_once "../seting/config_db.php";
require_once "../seting/config_web.php";
if(isset($_POST)){
	$db = New Db();
	$insert = $db->query("insert ignore into counter (tanggal,jam,ip_client,browser,versi_browser,path,media) values (curdate(),curtime(),'".$_POST["ipaddr"]."','wa_click','".$_POST["content"]."','".$_POST["path"]."','".$_POST["media"]."');");
	echo json_encode($insert);
}else{
	echo "need post...";
}
