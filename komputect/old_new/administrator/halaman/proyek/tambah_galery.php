<div id="name-list" style='height:auto;padding:10px;'>
	<table border='0' width='100%'>
  <form method="post" action="" enctype="multipart/form-data" >
	<?php
	$prj_dtl_query  = mysql_query("select * from project where project_id='$_GET[data_project]'")or die(mysql_error());
	if(mysql_num_rows($prj_dtl_query)==0){
		echo "data not found";
	}else{
		$prj_dtl_result= mysql_fetch_array($prj_dtl_query);
		echo "<input typ='text' name='key_proy_dtl' value='$prj_dtl_result[project_id]' style='display:none;'>";
		echo '<tr><td width="15%">Type & Produk</td><td><input type="text" required="required" name="bld" class="ipro ro" value="'.$prj_dtl_result['type']." - ".$prj_dtl_result['produk'].'" readonly></tr>';
		echo '<tr><td>Build Name</td><td><input type="text" required="required" name="bld" class="ipro ro" value="'.$prj_dtl_result['build_name'].'" readonly></td></tr>';
		echo '<tr><td>Lokasi</td><td><input type="text" required="required" name="lok" class="ipro ro" value="'.$prj_dtl_result['lokasi'].'" readonly></td></tr>';
		echo '<tr><td>Image Proyek</td><td>';
			$img_proj_utama = $prj_dtl_result['project_img'];
			if($img_proj_utama=="-" || strlen($img_proj_utama)==0){
				$img_proj_utama="<input type='text' class='ipro ro' value='No image inserted' style='color:green;'/>";
			}elseif(!file_exists($path.$img_proj_utama)){
				$img_proj_utama="<input type='text' class='ipro ro' value='not found' style='color:red;'/>";
			}else{		
				$img_proj_utama="<img src='".$path.$img_proj_utama."'/>";				
			}
			echo $img_proj_utama."</td></tr>";
	}
	?>
	<tr><td></td><td><i style='font-size:12px;'>Max upload all image 10MB,</i></td></tr>
	<tr><td></td><td>
			<input type="file" name="berkas2[]" class="ipro" multiple accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
		</td>
	</tr>
	<tr><td></td><td><input type="submit" name="save_galery" value="Upload Galery" ></td></tr>	
  </form>
	<tr>
		<td></td><td>
		<?php
			if(isset($_POST["save_galery"])){
				$max_size_upload = 10240000; //in KB
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
					//echo $cnt;
					if($cnt >$max_size_upload ){
						echo '<script>alert("Maaf total file melebihi ketentuan yaitu '.$max_size_upload.' \\njadi tidak bisa di upload")</script>';
					}else{
							$Pno=1;
							foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
								$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
								$kaboom 		= explode(".", $file_name); // Split file name into an array using the dot
								$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
								move_uploaded_file($tmp_name, $path.$file_name);
								$full_file 		= "full_galery_".str_replace(" ","-",$_POST['bld']."_".$file_name);
								$thumb_file 	= "thumb_galery_".str_replace(" ","-",$_POST['bld']."_".$file_name);
								ak_img_resize($path.$file_name, $path.$full_file, $wmax2, $hmax2, $fileExt);
								ak_img_resize($path.$file_name, $path.$thumb_file, $wmax4, $hmax4, $fileExt);
								unlink($path.$file_name);
								$insert_project_dtl = mysql_query("insert into project_detail values ('$_POST[key_proy_dtl]','$Pno','X','$thumb_file','$full_file',now())")or die(mysql_error());
								$Pno++;
							}
						}
					echo "<msg>Image galery for project $_POST[bld] has uploaded</msg>";
					echo '<meta http-equiv="refresh" content="1;halaman.php?page=project_input">';
				}
		?>
		</td>
	</tr>
	</table>
</div>