<div id="name-list" style='height:auto;padding:10px;'>
  <form method="post" action="" enctype="multipart/form-data" >
	<?php 
		$cek_urut  = mysql_fetch_array(mysql_query("select  max(urut) as maksimal from galery where recid='BS'")) or die(mysql_error());
	?>
	<table>
	<tr><td width='20%'>No Urut</td>
		<td>
			<input type="text" name="urut" class="ipro ro tengah" value="<?php echo ($cek_urut[0]+1); ?>" readonly style="width:40px;">
		</td>
	</tr>
    <?php
		$cek_priority = mysql_fetch_array(mysql_query("select count(aktif) from galery where aktif='Y' and recid='BS'"))or die (mysql_query());
	?>
  <form method="post" action="" enctype="multipart/form-data" >
	<tr><td width='20%'>Aktif</td>
		<td>
			 <?php
			 if($cek_priority[0]<10){
			echo	'<select name="aktif" style="width:40px;">
						<option value="Y">Y</option>
						<option value="N">N</option>
					</select>';							 
			}elseif($cek_priority[0]>=10){
				echo '<input type="text" name="aktif" class="ipro ro tengah" value="N" readonly style="width:40px;">';
			}
			 echo 'Total Project untuk Hal aktif '.$cek_priority[0];
			 ?>
		</td>
	</tr>	
	<tr><td>Desc *</td><td><input type="text" required="required" name="Desc" maxlength="40" class="ipro" style="width:550px;"></td></tr>
	<tr><td>Image max 2MB *</td>
		<td>
			<input type="file" name="gambar" class="ipro" required="required" accept="image/jpg,image/jpeg,image/JPG,image/JPEG"> <i style='font-size:10px;'>Disarankan Image pixelnya 700 x 215</i>
		</td>
	</tr>
	<tr><td><input type="submit" name="save_proyek" value="Simpan Data" class='button_s'></td>	
  </form>
		<td>
		<?php
			if(isset($_POST["save_proyek"])){
				$galery_urut  = trim(htmlentities(mysql_real_escape_string($_POST["urut"])));
				$galery_aktf  = trim(htmlentities(mysql_real_escape_string($_POST["aktif"])));
				$galery_desc = trim(htmlentities(mysql_real_escape_string($_POST["Desc"])));
				$max_size_upload	= 2048000; //in KB
				$galery_img   		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
				$galery_img_tmp		= $_FILES["gambar"]["tmp_name"];
				$galery_img_size	= $_FILES["gambar"]["size"];
				$galery_img_x 		= explode(".", $galery_img); // Split file name into an array using the dot
				$galery_img_ext 	= end($galery_img_x); // Now target the last array element to get the file extension
				if(empty($galery_desc)){
					echo "<msg>Error save, field must insert data or select options</msg>";
				}else{					
					$date_time = date("Y-m-d H:i:s");
					$key_galery = md5($date_time.$galery_urut.$galery_desc.$galery_aktf.$galery_img);
					$proyek_query  = mysql_query("select * from galery where id_galery='$key_galery'")or die(mysql_error());
					if(mysql_fetch_row($proyek_query)==0){
						if(!empty($galery_img)){
							//echo $galery_img_size;
							//break;
							if($galery_img_size < ($max_size_upload+1)){
								$galery_img_ren = str_replace(" ","-",substr($galery_desc,0,15))."_".$galery_img;
								$moveResult  	= move_uploaded_file($galery_img_tmp, $path.$galery_img_ren);
								if ($moveResult != true) {
									echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
								}else{									
									$full_file 	= "full-".$galery_img_ren;
									$thumb_file = "thumb-".$galery_img_ren;
									ak_img_resize($path.$galery_img_ren, $path.$full_file, $wmax0, $hmax0, $galery_img_ext);
									ak_img_resize($path.$galery_img_ren, $path.$thumb_file, $wmax4, $hmax4, $galery_img_ext);
									unlink($path.$galery_img_ren);
									$insert = "insert into galery  (recid,urut,id_galery,aktif,info_id,img_full,img_thumb) values ('BS','$galery_urut', '$key_galery', '$galery_aktf', '$galery_desc', '$full_file', '$thumb_file')";
									//echo $insert;
									$proyek_insert = mysql_query($insert);
									if($proyek_insert){										
										echo "<msg>Save data sukses<msg>";
										echo '<meta http-equiv="refresh" content="1;halaman.php?page=slide_galery">';
									}else{
										echo "<msg>Error save, some data is invalid please try again</msg>";
									}
								}
							}else{
								echo "<msg>Image size to large max 2MB and your image $galery_img_size</msg>";								
							}
						}
					}else{
						echo "<msg>Error save, data already exists<msg>";
					}
				}
			}else{
				echo "<i style='font-size:12px;'>(*) isian tidak boleh kosong</i>";
			}
		?>
		</td>
	</tr>
	</table>
</div>