<?php

function server()
{
	$server = strtolower($_SERVER["SERVER_NAME"]);
	if ($server == "localhost" || $server == "127.0.0.1" || $server == "192.168.6.106" || $server == "192.168.12.97") {
		$server = $_SERVER["SERVER_NAME"] . "/proyek/bor/";
		#$server = $_SERVER["SERVER_NAME"].":808/";
	} else {
		$server = $_SERVER["SERVER_NAME"] . "/";
	}
	return "http://" . $server;
}

function paragrap($sentence, $word_count)
{
	$space_count = 0;
	$print_string = '';
	for ($i = 0; $i < strlen($sentence); $i++) {
		if ($sentence[$i] == ' ')
			$space_count++;
		$print_string .= $sentence[$i];
		if ($space_count == $word_count)
			break;
	}
	return $print_string;
}
function Redirect($url, $permanent = false)
{
	header('Location: ' . $url, true, $permanent ? 301 : 302);
	exit();
}

function encrypt_pass($password)
{
	$keyword = "abizar";
	$panjang_key  = strlen($keyword);
	$panjang_pass = strlen($password);
	$ins_key = $panjang_key;
	$hasil = "";
	for ($key = 0; $key <= $panjang_key; $key++) {
		$rumus = $key * $ins_key;
		$hasil .= substr($keyword, $key, 1) . substr($password, $rumus, $ins_key);
	}
	return $hasil;
}
function left($str, $length)
{
	return substr($str, 0, $length);
}
function right($str, $length)
{
	return substr($str, -$length);
}
function log_error($page, $error)
{
	global $db;
	$err2 = $db->escape($page);
	$err3 = $db->escape($error);
	$db->query("insert into error_log values (now(),'$err2','$err3')");
}
function escape($data)
{
	global $db;
	if (strlen($data) != 0) {
		$hasil = $db->escape($data);
	} else {
		$hasil = $data;
	}
	return $hasil;
}
function pecah_id($idnya)
{
	$adelia 		= "8,14,17,20";
	$abizar 		= "6,3,3";
	$right_id	 	= right($idnya, 3);
	$str_id			= substr($idnya, 0, 6) . substr($right_id, 0, 1) . substr($idnya, 6, 3) . substr($right_id, 1, 1) . substr($idnya, 9, 3) . substr($right_id, 2, 1) . substr($idnya, 12, 5);
	$encrypt_id		= "17" . substr($str_id, 0, 3) . "-20" . substr($str_id, 3, 6) . "-14" . substr($str_id, 9, 3) . "-8" . substr($str_id, 12, 8);
	return $encrypt_id;
}
function gabung_id($idnya)
{
	$char_array  	= array("-20", "-14", "-8");
	$str_id			= str_replace($char_array, "", $idnya);
	$str_pass2 	 	= str_replace($char_array, "", $str_id);
	$decrypt_id		= substr($str_pass2, 2, 6) . substr($str_pass2, 9, 3) . substr($str_pass2, 13, 3) . substr($str_pass2, 17, 5);
	return $decrypt_id;
}
#echo format_tgl(date("Y-m-d H:i:s"),"-","2");
# 2016-05-29 13:13:13
# 1234567890123456790
function format_tgl($tanggal, $pemisah, $tahun)
{
	$panjang_char = trim(strlen($tanggal));
	$tgl	= substr($tanggal, 8, 2);
	$bln	= substr($tanggal, 5, 2);
	if ($tahun == 2) {
		$thn 	= substr($tanggal, 2, 2);
	} else {
		$thn 	= substr($tanggal, 0, 4);
	}
	if ($panjang_char == 19 || $panjang_char == 10 || $panjang_char == 20) {
		$new_tanggal = $tgl . $pemisah . $bln . $pemisah . $thn;
	} else {
		$new_tanggal = $tanggal;
	}
	return $new_tanggal;
}
function hari($value)
{
	$hari = strtolower(substr($value, 0, 3));
	if ($hari == "sun") {
		$harinya = "Minggu";
	} elseif ($hari == "mon") {
		$harinya = "Senin";
	} elseif ($hari == "tue") {
		$harinya = "Selasa";
	} elseif ($hari == "wed") {
		$harinya = "Rabu";
	} elseif ($hari == "thu") {
		$harinya = "Kamis";
	} elseif ($hari == "fri") {
		$harinya = "Jum'at";
	} elseif ($hari == "sat") {
		$harinya = "Sabtu";
	} else {
		$harinya = "Unknown";
	}
	return $harinya;
}

function halaman()
{
	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
#insert_visitor("1",halaman(),"as");
function insert_visitor($idnya, $halaman, $medianya)
{
	global $tgl_jam, $ipnya, $db;
	$syntax_insert_visitor = "insert into pengunjung_web values ('$tgl_jam','$idnya','$medianya','$ipnya','$halaman')";
	if (!$db->query($syntax_insert_visitor)) {
		log_error($tgl_jam, $halaman, $syntax_insert_visitor);
	}
}
function redirected()
{
	echo '<META http-equiv="refresh" content="0;URL=?page=404">';
}
function redirected_adm()
{
	echo '<META http-equiv="refresh" content="0;URL=?halaman=404">';
}


if (!function_exists('br')) {
	function br($sintak)
	{
		if (is_array($sintak)) {
			foreach ($sintak as $key => $value) {
				echo "<i style='color:red !important;'>" . $value . "</i> - ";
			}
		} else {
			echo "<br/><i style='color:red !important;'>" . $sintak . "</i>";
		}
	}
}
if (!function_exists('debug')) {
	function debug($sintak, $posisi)
	{
		if ($posisi == "") {
			$pos = "left:0";
		} else {
			$pos = "right:0";
		}
		echo "<pre style='position:fixed;z-index:999999999999;background:#ffffffc9;$pos'>" . print_r($sintak, true) . "</pre>";
	}
}
if (!function_exists('dbg')) {
	function dbg($sintak)
	{
		echo "<pre style='background:#ffffffc9;color:000'>" . print_r($sintak, true) . "</pre>";
	}
}
if (!function_exists('prin')) {
	function prin($sintak)
	{
		echo "<pre style='position:fixed;z-index:999999999999;top:0;background:#ffffffc9;'>" . print_r($sintak, true) . "</pre>";
	}
}

if (!function_exists('popup')) {
	function popup($no, $sintak)
	{
		if ($no == 0) {
			$no = "top:0";
		} else {
			$no = "top:" . ($no * 35) . "px";
		}
		echo "<pre style='background:#e5e5e5e3;position:fixed;color:#000;font-size:14px;z-index:9999999;padding:5px 20px;border:solid 1px #ccc;$no'>" . print_r($sintak, true) . "</pre>";
	}
}

function  base_url($url)
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $url;
	return $CurPageURL;
}
