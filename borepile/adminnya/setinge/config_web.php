<?php
$tbl_prefix = "support_";
$tbl_user   = $tbl_prefix."user";
define("CSS","css/");
define("JS","js/");
define("Img","image/");
define("tb_user",$tbl_user);

function paragrap($sentence,$word_count){
	$space_count = 0;
	$print_string = '';
	for($i=0;$i<strlen($sentence);$i++){
		if($sentence[$i]==' ')
		$space_count ++;
		$print_string .= $sentence[$i];
		if($space_count == $word_count)
		break;
	}
	echo $print_string;
}
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

function encrypt_pass($password){
	$keyword = "abizar";
	$panjang_key  = strlen($keyword);
	$panjang_pass = strlen($password);
	$ins_key = $panjang_key;
	$hasil = "";
	for($key=0;$key<=$panjang_key;$key++){
		$rumus = $key*$ins_key;
		$hasil .= substr($keyword,$key,1).substr($password,$rumus,$ins_key);
	}
	return $hasil;
}
?>