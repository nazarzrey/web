<?php				
if($_GET['id_galery'] ){
	$cek_priority = mysql_fetch_array(mysql_query("select count(aktif) from galery where aktif='Y' and recid='BS'"))or die (mysql_query());
	$Egalery_query  = mysql_query("select * from galery where id_galery='$_GET[id_galery]'")or die (mysql_query());
	if(mysql_num_rows($Egalery_query)==0){
		echo "<msg>Sory Data galery for id $_GET[id_galery] not found..!, please select other</msg>";
	}else{
		$Egalery_result = mysql_fetch_array($Egalery_query);	
		?>	
		<div id="name-list" style='height:auto;padding:10px;'>
			<table border='0' width='100%'>
		  <form method="post" action="" enctype="multipart/form-data" >
			<tr><td width="17%">No Urut</td>
				<td>
				<select name='urut' style='width:50px'>
					<option value='<?php echo $Egalery_result[1]; ?>'><?php echo $Egalery_result[1]; ?></option>
					<?php
						$cek_urut  = mysql_fetch_array(mysql_query("select max(urut) as filter from galery  where recid='BS' order by urut")) or die(mysql_error());
						$no_urut = ($cek_urut[0]+1);
						for($x_urut=1;$x_urut<=$no_urut ;$x_urut++){
							echo "<option value='$x_urut'>$x_urut</option>";
						}
					?>
				</select>
				</td>
			</tr>
            <tr><td width="15%">Aktif</td>
				<td>
					 <?php
					 if(strlen($Egalery_result[3])==0){
						 $priority="N";
					 }else{
						 $priority=$Egalery_result[3];
					 }
					 if($cek_priority[0]<10 and $priority=="Y"){
					echo	'<select name="aktif" style="width:50px;">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>';							 
					}elseif($cek_priority[0]>=10 and $priority=="Y"){						
					echo	'<select name="aktif" style="width:50px;">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>';							 
					}elseif($cek_priority[0]<10 and $priority=="N"){
					echo	'<select name="aktif" style="width:50px;">
								<option value="N">N</option>
								<option value="Y">Y</option>
							</select>';							 
					}elseif($cek_priority[0]>=10 and $priority=="N"){
						echo '<input type="text" name="aktif" class="ipro ro" value="'.$priority.'" readonly style="width:40px;">';
					}
					 echo 'Total Project untuk Hal aktif '.$cek_priority[0];
					 ?>
				</td>
			</tr>
			<tr><td>Desc *</td><td><input type="text" required="required" name="Desc" maxlength="40" class="ipro" style="width:400px;" value="<?php echo $Egalery_result['info_id'];?>"></td></tr>
			<?php
			echo '<tr><td>Old Image</td><td>';
				$img_galery = $Egalery_result['img_full'];
				if($img_galery=="-" || strlen($img_galery)==0){
					$img_galery_aktif="<input type='text' class='ipro ro' value='not image' style='color:green;' name='gambar_galery'/>";
				}elseif(!file_exists($path.$img_galery)){
					$img_galery_aktif="<input type='text' class='ipro ro' value='not found' style='color:red;' name='gambar_galery'/>";
				}else{		
					$img_galery_aktif="<img src='".$path.$img_galery."' class='img_galery_x' style='max-width:500px;'/><br/>
					<input type='text' class='ipro ro' value='".$img_galery."' style='color:blue;border:solid 1px blue;' name='gambar_galery'/>";
				}
				echo $img_galery_aktif."</td></tr>";
			?>
			<tr>
				<td>Image max 2MB </td>
				<td>
					<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
				</td>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="upd_galery" class='button_s' value="Update Data" >
					<a href='halaman.php?page=slide_galery&action=edit_galery&id_galery=<?php echo $Egalery_result['id_galery']; ?>&del_data=dele'  class='button_d'>
						Delete Data
					</a>
				</td>	
			</tr>
		  </form>
			<td></td><td>
			<?php					
				if(isset($_POST["upd_galery"])){
					$galery_urut  = trim(htmlentities(mysql_real_escape_string($_POST["urut"])));
					$galery_aktf  = trim(htmlentities(mysql_real_escape_string($_POST["aktif"])));
					$galery_desc  = trim(htmlentities(mysql_real_escape_string($_POST["Desc"])));
					$max_size_upload	= 2048000; //in KB
					$galery_img_old 	= $_POST['gambar_galery'];
					$galery_img   		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
					$galery_img_tmp		= $_FILES["gambar"]["tmp_name"];
					$galery_img_size	= $_FILES["gambar"]["size"];
					$galery_img_x 		= explode(".", $galery_img); // Split file name into an array using the dot
					$galery_img_ext 	= end($galery_img_x); // Now target the last array element to get the file extension
					if(empty($galery_desc)){
						echo "<msg>Error save, field must insert data or select options</msg>";
					}else{				
						$date =date("Y`-m-d");
						$xx="select * from galery where id_galery='$Egalery_result[id_galery]'";
						$galery_query  = mysql_query($xx);
						if(mysql_num_rows($galery_query)==1){
							if(empty($galery_img)){			
								$galery_update = "update galery set 
											urut='$galery_urut',
											aktif='$galery_aktf',
											info_id='$galery_desc'
											where id_galery='$Egalery_result[id_galery]'";
								if(mysql_query($galery_update)){									
									echo "<msg>Save data sukses<msg>";
									echo '<meta http-equiv="refresh" content="1;halaman.php?page=slide_galery">';
								}else{
									echo "<msg>Error save, some data is invalid please try again</msg>";
								}
							}else{
								if($galery_img_size < ($max_size_upload+1)){
									$galery_img_ren = str_replace(" ","-",substr($galery_desc,0,15))."_".$galery_img;
									$moveResult  = move_uploaded_file($galery_img_tmp, $path.$galery_img_ren);
									if ($moveResult != true) {
										echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
									}else{									
										$full_file 	= "full-".$galery_img_ren;
										$thumb_file = "thumb-".$galery_img_ren;
										ak_img_resize($path.$galery_img_ren, $path.$full_file, $wmax2, $hmax2, $galery_img_ext);
										ak_img_resize($path.$galery_img_ren, $path.$thumb_file, $wmax4, $hmax4, $galery_img_ext);
										unlink($path.$galery_img_ren);							
										echo $galery_update = "update galery set 
													urut='$galery_urut',
													aktif='$galery_aktf',
													info_id='$galery_desc',
													img_thumb='$thumb_file',
													img_full='$full_file'
													where id_galery='$Egalery_result[id_galery]'";
										if(mysql_query($galery_update)){						
											if($galery_img_old!="not found" and $galery_img_old!="not image" ){
												$full = $path.$galery_img_old;
												$thum = $path.str_replace("full","thumb",$galery_img_old);
												//echo $full. " - ".$thum;
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}		
											echo "<msg>Save data sukses<msg>";
											echo '<meta http-equiv="refresh" content="1;halaman.php?page=slide_galery&action=edit_galery&id_galery='.$Egalery_result['id_galery'].'">';											
										}else{
											echo "<msg>Error save, some data is invalid please try again</msg>";
										}
									}
								}else{
									echo "<msg>Image size to large max 2MB and your image $galery_img_size</msg>";								
								}
							}
						}else{
							echo "<msg>Error save, data not found<msg>";
						}
					}
				}else{
					if(!isset($_GET['del_data'])){
						echo "<i style='font-size:12px;'>(*) isian tidak boleh kosong</i>";
					}else{
					?>
						<div class='box-del'>
							Apakah anda yakin data di hapus...!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=slide_galery&action=edit_galery&id_galery=<?php echo $Egalery_result['id_galery'];?>&del_data=Y' class='delY'>Yes</a>&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=slide_galery&action=edit_galery&id_galery=<?php echo $Egalery_result['id_galery']; ?>&del_data=N' class='delN'>No</a> 
							<?php 
								if($_GET['del_data']=="Y"){
									$mst_galery = "from galery where id_galery='$_GET[id_galery]'";
									$cek_galery = mysql_query("select img_full,img_thumb ".$mst_galery)or die(mysql_error());
									if($cek_galery){
										$result_galery = mysql_fetch_array($cek_galery);
										$full = $path.$result_galery[0];
										$thum = $path.$result_galery[1];
										//echo $full.$thum;														
										if(file_exists($full)){
											unlink($full);
										}
										if(file_exists($thum)){
											unlink($thum);
										}
									}
									$hps_galery = mysql_query("delete ".$mst_galery)or die(mysql_error());
									if($hps_galery){
										echo "<script>alert('Data sudah di hapus');</script>";
										echo '<meta http-equiv="refresh" content="0;halaman.php?page=slide_galery">';										
									}else{
										echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
										echo '<meta http-equiv="refresh" content="0;halaman.php?page=slide_galery&action=edit_galery&id_galery='.$_GET['id_galery'].'">';										
									}
								}elseif($_GET['del_data']=='N'){
									echo '<meta http-equiv="refresh" content="0;halaman.php?page=slide_galery&action=edit_galery&id_galery='.$_GET['id_galery'].'">';
								}
							}
							?>
						</div>
					<?php
				}
			?>
			</td>
			</tr>
			</table>
		</div>
		<?php 
	}
}
?>