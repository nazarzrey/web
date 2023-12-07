<style>
msg{
	position:relative;
	top:-38px;
	left:280px;
}
.img_produk_x{
	position:relative;
	background-color:red;
	border:solid 1px blue;
	box-shadow:0 0 2px blue;
	border-radius:5px;
	overflow:auto;
	top:-57px;
	left:310px;
	width:150px;
	height:150px;
	z-index:1;
}
</style>
<?php				
if($_GET['id_berita'] ){
	$Enews_query  = mysql_query("select * from berita where id_berita='$_GET[id_berita]'")or die (mysql_query());
	if(mysql_num_rows($Enews_query)==0){
		echo "<msg>Sory Data berita for id $_GET[id_berita] not found..!, please select other</msg>";
	}else{
		$Enews_result = mysql_fetch_array($Enews_query);
		?>	
		<div id="name-list" style='height:auto;padding:10px;'>		
		  <form method="post" action="" enctype="multipart/form-data" >
			<div id="content-menu">
				<div class='info'>
					<span class='judul' style="width:100%;">
					<?php
					echo "Aktif : ";
					if($Enews_result['aktif']=="Y"){
						$aktif1 = "Y";
						$aktif2 = "N";
					}elseif($Enews_result['aktif']=="N"){
						$aktif1 = "N";
						$aktif2 = "Y";
					}
					echo "<select name='news_aktif'>
							<option value='$aktif1'>$aktif1</option>
							<option value='$aktif2'>$aktif2</option>
						  </select>";
				echo " | Utama : ";
					if($Enews_result['utama']=="Y"){
						$utama1 = "Y";
						$utama2 = "N";
					}elseif($Enews_result['utama']=="N"){
						$utama1 = "N";
						$utama2 = "Y";
					}
					echo "<select name='news_utama'>
							<option value='$utama1'>$utama1</option>
							<option value='$utama2'>$utama2</option>
						  </select>";
					?>
					</span>	
				</div>
				
				<div class='info'>
					<span class='judul'>
						Judul Id *
					</span>		
					<span class='isi'>
						<input type="text" required="required" name="news_judul_id" class="ipro" value="<?php echo $Enews_result[2]; ?>">						
						<input name='id_berita' value='<?php echo $_GET['id_berita']; ?>' style="display:none;">
					</span>
				</div>
				<div class='info'>
					<span class='judul'>
						Judul En *
					</span>		
					<span class='isi'>
						<input type="text" required="required" name="news_judul_en" class="ipro" value="<?php echo $Enews_result[3]; ?>">
					</span>
				</div>
				<div class='info' style='height:auto;overflow:hidden;'>
					<span class='judul'>
						berita Image
					</span>		
					<span class='isi'>
						<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
					</span>
					<span class='judul'>
						Old Image 
					</span>		
					<span class='isi' style='height:120px;'>
						<?php
							$img_proj_utama = $Enews_result['gambar_besar'];
							if($img_proj_utama=="-" || strlen($img_proj_utama)==0){
								$img_proj_utama="<input type='text' class='ipro ro' value='not image' style='color:green;' name='gambar_berita'/>";
							}elseif(!file_exists($path.$img_proj_utama)){
								$img_proj_utama="<input type='text' class='ipro ro' value='not found' style='color:red;' name='gambar_berita'/>";
							}else{		
								$img_proj_utama=" <input type='text' class='ipro ro' value='".$img_proj_utama."' style='color:blue;border:solid 1px blue;box-shadow:0 0 2px blue;' name='gambar_berita'/><br/>
								<img src='".$path.$img_proj_utama."' class='img_produk_x'/>";
							}
							echo $img_proj_utama;
						?>
					</span>
					<?php
					if(isset($_GET['del_data'])){
					?>
						<div class='box-del'>
							Are you sure the data below will be deleted...!<br/>
							<div style="margin:10px;color:white;">
								<table>
								<tr><td>Aktif</td><td>: <?php echo $Enews_result['aktif']; ?></td></tr>
								<tr><td>Utama</td><td>: <?php echo $Enews_result['utama']; ?></td></tr>
								<tr><td>Berita</td><td>: <?php echo $Enews_result['judul_id']; ?></td></tr>
								</table>
							</div>
							<a href='halaman.php?page=M_berita&action=edit_berita&id_berita=<?php echo $Enews_result['id_berita'];?>&del_data=Y' class='delY'>Yes</a>&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=M_berita&action=edit_berita&id_berita=<?php echo $Enews_result['id_berita']; ?>&del_data=N' class='delN'>No</a> 
							<?php 
							if($_GET['del_data']=='Y'){
								$delete_data_berita = mysql_query("delete from berita where id_berita='$_GET[id_berita]'")or die(mysql_error());
								if($delete_data_berita){
									echo "<script>alert('Data sudah di hapus');</script>";
										echo '<meta http-equiv="refresh" content="0;halaman.php?page=M_berita">';										
								}else{
									echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
									echo '<meta http-equiv="refresh" content="0;halaman.php?page=M_berita&action=edit_berita&id_berita='.$_GET['id_berita'].'">';										
								}
							}elseif($_GET['del_data']=='N'){
								echo '<meta http-equiv="refresh" content="0;halaman.php?page=M_berita&action=edit_berita&id_berita='.$_GET['id_berita'].'">';
							}							
						?>
						</div>
					<?php } ?>
				</div>
				<div id="accordion">
					<?php 
						$PSI = $Enews_result['isi_berita_id'];
						if(strlen($PSI)!=0){
							$PSI_C = "style='color:green;'";
						}else{
							$PSI_C = "style='color:red;'";
						}
					?>
					<h3 <?php echo $PSI_C; ?>>Isi Berita Id *</h3>
					<div>
						<textarea  type="text" name="news_isi_id" class='textarea'><?php echo $Enews_result['isi_berita_id']; ?></textarea>
					</div>
					<?php 
						$PSE =$Enews_result['isi_berita_en'];
						if(strlen($PSE)!=0){
							$PSE_C = "style='color:green;'";
						}else{
							$PSE_C = "style='color:red;'";
						}
					?>
					<h3  <?php echo $PSE_C; ?>>Isi Berita En *</h3>
					<div>
						<textarea  type="text" name="news_isi_en"  class='textarea'><?php echo $Enews_result['isi_berita_en']; ?></textarea>
					</div>
				</div>
				<div class='info' style='background:#ccc;margin-top:5px;'>		
					<span class='judul' style='width:230px;margin-top:-5px;margin-left:-20px;'>
						<input type="submit" name="upd_berita" value="Simpan Data"  style='margin-top:3px;' class='button_s'>
						<a href='halaman.php?page=M_berita&action=edit_berita&id_berita=<?php echo $Enews_result['id_berita']; ?>&del_data=dele'  class='button_d'  style='margin-top:3px;' >
						Delete Data</a>
					</span>
			</form>		
					<span>
					<!-- -->
					
					<!-- -->
					</span>
				</div>
			</div>
			<?php					
				if(isset($_POST["upd_berita"])){
					$news_id 		= trim($_POST["id_berita"]);
					$news_aktif 	= trim($_POST["news_aktif"]);
					$news_utama 	= trim($_POST["news_utama"]);
					$news_judul_id 	= trim($_POST["news_judul_id"]);
					$news_key	 	= str_replace(" ","-",$news_judul_id);
					$news_judul_en 	= trim($_POST["news_judul_en"]);
					$news_isi_id 	= trim($_POST["news_isi_id"]);
					$news_isi_en 	= trim($_POST["news_isi_en"]);
					$max_size_upload = 2048000; //in KB
					$news_img_old 	= $_POST['gambar_berita'];
					$news_img 		= strtolower(trim($_FILES["gambar"]["name"]));
					$news_img_tmp	= $_FILES["gambar"]["tmp_name"];
					$news_img_size	= $_FILES["gambar"]["size"];
					//echo $news_img_size.$news_img_tmp.$news_img;
					$news_img_x 		= explode(".", $news_img); // Split file name into an array using the dot
					$news_img_ext 	= end($news_img_x); // Now target the last array element to get the file extensionif(empty($news_judul_id) || empty($news_judul_en) || empty($news_isi_id) || empty($news_isi_en)){
					if(empty($news_judul_id) || empty($news_judul_en) || empty($news_isi_id) || empty($news_isi_en)){
							echo "<msg>Error save, field must insert data or select options</msg>";
					}else{
						$date =date("Y-m-d");
						$jam  =date("H:i:s");
						$xx="select * from berita where id_berita='$Enews_result[id_berita]'";
						$berita_query  = mysql_query($xx);
						if(mysql_num_rows($berita_query)==1){
							if(empty($news_img)){
								$berita_update = "update berita set
												aktif='$news_aktif',
												utama='$news_utama',
												judul_id='$news_judul_id',
												judul_en='$news_judul_en',
												isi_berita_id='$news_isi_id',
												isi_berita_en='$news_isi_en'
												where id_berita='$news_id'";
								if(mysql_query($berita_update)){									
									echo "<msg>Save data sukses<msg>";
									echo '<meta http-equiv="refresh" content="1;halaman.php?page=M_berita">';
								}else{
									echo "<msg>Error save, some data is invalid please try again</msg>";
								}
							}else{
								if($news_img_size < ($max_size_upload+1)){
									$news_img_ren = str_replace(" ","-",$news_id)."_".$news_img;
									$moveResult  = move_uploaded_file($news_img_tmp, $path.$news_img_ren);
									if ($moveResult != true){
										echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
									}else{
										$resized_file 	= "full-".$news_img_ren;
										$thumb_file 	= "thumb-".$news_img_ren;
										ak_img_resize($path.$news_img_ren, $path.$resized_file, $wmax2, $hmax2, $news_img_ext);
										ak_img_resize($path.$news_img_ren, $path.$thumb_file, $wmax4, $hmax4, $news_img_ext);
										unlink($path.$news_img_ren);				
										$berita_update = "update berita set
												aktif='$news_aktif',
												utama='$news_utama',
												judul_id='$news_judul_id',
												judul_en='$news_judul_en',
												isi_berita_id='$news_isi_id',
												isi_berita_en='$news_isi_en',
												gambar_kecil='$resized_file',
												gambar_besar='$thumb_file'
												where id_berita='$news_id'";
												echo $berita_update;
										if(mysql_query($berita_update)){						
											if($news_img_old!="not found" and $news_img_old!="not image" ){
												$image_icon = $path.$news_img_old;
												$image_full = $path.str_replace("full","thumb",$news_img_old);
												if(file_exists($image_icon)){
													unlink($image_icon);
												}
												if(file_exists($image_full)){
													unlink($image_full);
												}
											}		
											echo "<msg>the data has been successfully updated<msg>";
											echo '<meta http-equiv="refresh" content="1;halaman.php?page=M_berita&action=edit_berita&id_berita='.$Enews_result['id_berita'].'">';	
										}else{
											echo "<msg>Error save, some data is wrong please try again...</msg>";
										}
									}
								}else{
									echo "<msg>Image size to large max 2MB and your image $news_img_size</msg>";								
								}
							}
						}else{
							echo "<msg>Error save, data not found<msg>";
						}
					}
				}
			?>
		</div>
		<?php 
	}
}
?>