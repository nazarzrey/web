<?php
$path_img = "../../galeri/";
require_once "../../seting/convert_image.php";
require_once "../../seting/function_web.php";
require_once "../../seting/config_db.php";
$wmax1 = 550;
$hmax1 = 550;
$wmax2 = 450;
$hmax2 = 450;
$wmax3 = 175;
$hmax3 = 175;
function upload_image_fnc($data_img, $id_attach, $insert)
{
	global $path_img, $wmax1, $hmax1, $wmax3, $hmax3, $str_arr;
	$xx = 1;
	$result = "";
	foreach ($data_img['tmp_name'] as $key => $tmp_file) {
		#echo $tmp_file;
		#echo $data_img['name'][$key];
		#die();
		$date_time	= date("Y-m-d H:i:s");
		$str_DT		= date("YmdHis");
		$random     = rand(1, 999);
		$nama_file 	= str_replace(' ', '', strtolower("{$data_img['name'][$key]}"));
		$kaboom 	= explode(".", $nama_file); // Split file name into an array using the dot
		$fileExt 	= end($kaboom); // Now target the last array element to get the file extension
		$file_name	= strtolower(date("Ymdhis") . $random . "." . $fileExt);
		$id_file	= substr($id_attach, 0, 7) . $str_DT . $xx;
		$full_file 	= "full_" . str_replace($str_arr, ".", $file_name);
		$thumb_file = "thumb_" . str_replace($str_arr, ".", $file_name);
		#break;
		$upload_file = move_uploaded_file($tmp_file, $path_img . $file_name);
		if ($upload_file) {
			ak_img_resize($path_img . $file_name, $path_img . $full_file, $wmax1, $hmax1, $fileExt);
			ak_img_resize($path_img . $file_name, $path_img . $thumb_file, $wmax3, $hmax3, $fileExt);
			unlink($path_img . $file_name);
			if ($insert == "Y") {
				$ins_gal = "insert into galery values ('$id_attach','$id_file','$full_file','$thumb_file','$file_name','$date_time',null)";
				$insert_dtl = mysql_query($ins_gal) or die(mysql_error());
			}
			$result .= $full_file;
		} else {
			$result = "Z";
		}
		$xx++;
	}
	return $result;
}

if (isset($_POST["simpan"])) {
	$gambar 	= $_FILES["attach"];
	$date_time	= date("Y-m-d H:i:s");
	echo $upload_img = upload_image_fnc($gambar, $date_time, 'Y');
}
?>

<form method="post" action="" enctype="multipart/form-data">
	<tr>
		<td class='td_right'>Gambar Utama</td>
		<td>
			<input type='file' required class='input wx350' name='attach[]' id='attach' maxlength="50" accept="image/*" multiple onchange="GetFileInfo()" />
		</td>
	</tr>
	<tr>
		<td class='td_right'></td>
		<td>
			<input type='submit' class='input wx150 <?= $button; ?>' style="margin:2px;" name='simpan' id='simpan' value="save" />
		</td>
	</tr>
</form>