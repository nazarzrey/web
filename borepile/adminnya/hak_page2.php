<?php
if($Ms_grup!="admin" and $Ms_grup!="user"){
	$page_block =  "<b class='404'>Akses menu ini ditolak...!</b>";
	require_once "404.php";
	die();
}
?>