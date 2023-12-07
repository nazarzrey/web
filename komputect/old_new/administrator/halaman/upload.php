<?php
	include_once "definisi/config.php";
?>
<form enctype="multipart/form-data" method="post" action="">
<table border='1'>
	
</table>
Choose your file here : 
<input name="berkas2[]" type="file" multiple accept="image/jpg,image/JPG,image/jpeg,image/JPEG" required="required"><p/>
Pilih folder upload : 
<select name="berkas" required="required">
	<option value="image/tes">tes</option>
	<option value="image">Default</option>
	<option value="image/produk">Produk</option>
	<option value="image/project">Proyek</option>
	<option value="image/slide">slide</option>
</select><p/>
<input type="submit" value="Upload It" name='upload_img'/>
Max Upload Image 10 MB
</form>
<?php
$max_size_upload = 10240000; //in KB
if(isset($_POST['upload_img'])){
	if(isset($_FILES['berkas2'])) {
		$cnt=0;
		foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
			$fileName 	= strtolower("{$_FILES['berkas2']['name'][$key]}");			
			$fileSize 	= ("{$_FILES['berkas2']['size'][$key]}"); // File size in bytes	
			//echo $fileName." -> ".($fileSize)."</br>";
			//echo $size."</br>";
			$cnt += $fileSize;
			}
		}
		echo $cnt;
		if($cnt >$max_size_upload ){
			echo '<script>alert("Maaf total file melebihi ketentuan yaitu '.$max_size_upload.' \\njadi tidak bisa di upload")</script>';
		}else{
			include_once("convert_image.php");
				foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
					$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
					$kaboom 		= explode(".", $file_name); // Split file name into an array using the dot
					$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
					$target_file 	= $_POST['berkas']."/$file_name";
						move_uploaded_file($tmp_name, $target_file);
					$resized_file 	= $_POST['berkas']."/resized_$file_name";
					$thumb_file 	= $_POST['berkas']."/thumb_$file_name";
					ak_img_resize($target_file, $resized_file, $wmax1, $hmax1, $fileExt);
					ak_img_resize($target_file, $thumb_file, $wmax2, $hmax2, $fileExt);
					unlink($target_file);
				}
				//echo '<meta http-equiv="refresh" content="0;upload.php">';
			}
		}
		//echo $cnt;
		
	/*
	include_once("convert_image.php");
		$wmax1 = 350;
		$hmax1 = 350;
		$wmax2 = 100;
		$hmax2 = 100;
		foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
			$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
			$kaboom 		= explode(".", $file_name); // Split file name into an array using the dot
			$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
			$target_file 	= $_POST['berkas']."/$file_name";
				move_uploaded_file($tmp_name, $target_file);
			$resized_file 	= $_POST['berkas']."/resized_$file_name";
			$thumb_file 	= $_POST['berkas']."/thumb_$file_name";
			ak_img_resize($target_file, $resized_file, $wmax1, $hmax1, $fileExt);
			ak_img_resize($target_file, $thumb_file, $wmax2, $hmax2, $fileExt);
			unlink($target_file);
		}
		//echo '<meta http-equiv="refresh" content="0;upload.php">';
	}
	*/
}
?>