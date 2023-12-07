<style>
msg{
	position:relative;
	top:-38px;
	left:280px;
}
.img_agentuk_x{
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
if($_GET['agent_id'] ){
	$Eagent_query  = mysql_query("select * from agent where agent_id='$_GET[agent_id]'")or die (mysql_query());
	if(mysql_num_rows($Eagent_query)==0){
		echo "<msg>Sory Data agent for id $_GET[agent_id] not found..!, please select other</msg>";
	}else{
		$Eagent_result = mysql_fetch_array($Eagent_query);	
		?>	
<div id="name-list" style='height:auto;padding:10px;'>
  <form method="post" action="" enctype="multipart/form-data" >
	<?php 
		$cek_urut  = mysql_fetch_array(mysql_query("select  max(urut) as maksimal from agent where urut<>'999'")) or die(mysql_error());
	?>
	<div id="content-menu">
		<div class='info'>
			<span class='judul'>
				No Urut
			</span>			
			<span class='isi'>
				<?php 
				if($Eagent_result[1]=="999"){
				?>
					<input type="text" required="required" name="urut" class="ipro ro" readonly value="<?php echo $Eagent_result[1]; ?>" style='width:50px;'>
				<?php
				}else{
				?>
				<select name='urut' style='width:50px' >
					<option value='<?php echo $Eagent_result[1]; ?>'><?php echo $Eagent_result[1]; ?></option>							
					<?php
						$max_urut = $cek_urut[0];
						for($max_ur = 1;$max_ur<=$max_urut;$max_ur++){
							echo "<option value='$max_ur'>$max_ur</option>";
						}	
						$max_urut_x = ($max_urut+1);
						echo "<option value='$max_urut_x'>$max_urut_x</option>";
					?>
				</select>
				<?php
				}
				?>						
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent Id *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_id" class="ipro" style="width:175px;"  value="<?php echo $Eagent_result[0 ]; ?>">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent Name *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_name" class="ipro" value="<?php echo $Eagent_result[2]; ?>">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent URL *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_url" class="ipro" value="<?php echo $Eagent_result[4]; ?>"><label class="label_x">wwww.facebook.com</label>
			</span>
		</div>
				<div class='info' style='height:auto;overflow:hidden;'>
					<span class='judul'>
						agent Image
					</span>		
					<span class='isi'>
						<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
					</span>
					<span class='judul'>
						Old Image 
					</span>		
					<span class='isi' style='height:100px;'>
						<?php
							$img_agn_utama = $Eagent_result['img'];
							if($img_agn_utama=="-" || strlen($img_agn_utama)==0){
								$img_agn_utama="<input type='text' class='ipro ro' value='not image' style='color:green;' name='gambar_agent'/>";
							}elseif(!file_exists($path.$img_agn_utama)){
								$img_agn_utama="<input type='text' class='ipro ro' value='not found' style='color:red;' name='gambar_agent'/>";
							}else{		
								$img_agn_utama=" <input type='text' class='ipro ro' value='".$img_agn_utama."' style='color:blue;border:solid 1px blue;box-shadow:0 0 2px blue;' name='gambar_agent'/><br/>
								<img src='".$path.$img_agn_utama."' class='img_agentuk_x'/>";
							}
							echo $img_agn_utama;
						?>
					</span>
					<span class='judul' style='color:green;'>
					<?php 
						$XX="select count(*) from agent_detail where agent_id='$Eagent_result[agent_id]'";
						$gal_cek = mysql_query($XX) or die (mysql_error());
						$gal_res = mysql_fetch_row($gal_cek);
						if($gal_res[0]>0){					
						echo "
							Galery <b>$gal_res[0]</b> data</span>
							<span class='isi'>
							<div style='float:left;'>
							<input type='checkbox' name='del_galery' id='del_gal' style='height:20px;width:20px;'></div>
							<div style='margin-top:6px;'><label for='del_gal'>Hapus Data Galery</label></div>
						";	
						}else{
							echo "<div style='height:20px;'></div>";
						}
					?>
					</span>	
					<?php
					if(isset($_GET['del_data'])){
					?>
						<div class='box-del'>
							Are you sure the data below will be deleted...!<br/>
							<div style="margin:10px;color:white;">
							No Urut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $Eagent_result['urut']; ?><br/>
							agent Name : <?php echo $Eagent_result['desc_name']; ?><br/>
							</div>
							<a href='halaman.php?page=Agent&action=edit_agent&agent_id=<?php echo $Eagent_result['agent_id'];?>&del_data=Y' class='delY'>Yes</a>&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=Agent&action=edit_agent&agent_id=<?php echo $Eagent_result['agent_id']; ?>&del_data=N' class='delN'>No</a> 
							<?php 
							if($_GET['del_data']=='Y'){						
								$mst_dtl_agent = "from agent_detail where agent_id='$_GET[agent_id]'";
								$cek_dtl_agent = mysql_query("select small_img,big_img ".$mst_dtl_agent)or die(mysql_error());
								if($cek_dtl_agent){
									while($result_dtl_agent = mysql_fetch_array($cek_dtl_agent)){
										$full = $path.$result_dtl_agent[0];
										$thum = $path.$result_dtl_agent[1];											
										if(file_exists($full)){
											unlink($full);
										}
										if(file_exists($thum)){
											unlink($thum);
										}
									}
									$hps_dtl_agent = mysql_query("delete ".$mst_dtl_agent)or die(mysql_error());
									if($hps_dtl_agent){
										$mst_agent = "from agent where agent_id='$_GET[agent_id]'";
										$cek_agent = mysql_query("select img ".$mst_agent)or die(mysql_error());
										if($cek_agent){
											$result_agent = mysql_fetch_array($cek_agent);
											$full = $path.$result_agent[0];
											$thum = $path.str_replace("full","thumb",$result_agent[0]);
											//echo $full.$thum;														
											if(file_exists($full)){
												unlink($full);
											}
											if(file_exists($thum)){
												unlink($thum);
											}
										}
										$hps_agent = mysql_query("delete ".$mst_agent)or die(mysql_error());
										if($hps_agent){
											echo "<script>alert('Data sudah di hapus');</script>";
											echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent">';										
										}else{
											echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
											echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_agent&agent_id='.$_GET['agent_id'].'">';										
										}
									}else{
										echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
										echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_agent&agent_id='.$_GET['agent_id'].'">';										
									}
								}	/*	
								$delete_data_agent = mysql_query("delete from agent where agent_id='$_GET[agent_id]'")or die(mysql_error());
								if($delete_data_agent){
									echo "<script>alert('Data sudah di hapus');</script>";
									echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent">';										
								}else{
									echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
									echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_agent&agent_id='.$_GET['agent_id'].'">';										
								}*/
							}elseif($_GET['del_data']=='N'){
								echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_agent&agent_id='.$_GET['agent_id'].'">';
							}							
						?>
						</div>
					<?php } ?>
				</div>
				<div id="accordion">
					<?php 
						$PDI = $Eagent_result[6];
						if(strlen($PDI)!=0){
							$PDI_C = "style='color:green;'";
						}else{
							$PDI_C = "style='color:red;'";
						}
					?>
					<h3  <?php echo $PDI_C; ?>>agent Desc Id *</h3>
					<div>
						<textarea  type="text" name="agn_d_id" class='textarea'><?php echo $Eagent_result[6]; ?></textarea>
					</div>
					<?php 
						$PDE = $Eagent_result[7];
						if(strlen($PDE)!=0){
							$PDE_C = "style='color:green;'";
						}else{
							$PDE_C = "style='color:red;'";
						}
					?>
					<h3  <?php echo $PDE_C; ?>>agent Desc En *</h3>
					<div>
						<textarea  type="text" name="agn_d_en" class='textarea'><?php echo $Eagent_result[7]; ?></textarea>
					</div>
				</div>
				<div class='info' style='background:#ccc;margin-top:5px;'>		
					<span class='judul' style='width:230px;margin-top:-5px;'>
						<input type="submit" name="upd_agent" value="Simpan Data"  style='margin-top:3px;' class='button_s'>
						<?php							
							if($Eagent_result[1]!="999"){
						?>
						<a href='halaman.php?page=Agent&action=edit_agent&agent_id=<?php echo $Eagent_result['agent_id']; ?>&del_data=dele'  class='button_d'  style='margin-top:3px;' >
						Delete Data</a>
						<?php }?>
					</span>
			</form>		
					<span>
					</span>
				</div>
			</div>
			<?php					
				if(isset($_POST["upd_agent"])){
					if(isset($_POST['del_galery'])){
						$hapus_galery = "Y";
					}else{
						$hapus_galery = "N";
					}
					$urut	  = trim(htmlentities(mysql_real_escape_string($_POST["urut"])));
					$agn_id   = trim(htmlentities(mysql_real_escape_string($_POST["agn_id"])));
					$agn_name = trim(htmlentities(mysql_real_escape_string($_POST["agn_name"])));
					$agn_d_id = trim($_POST["agn_d_id"]);
					$agn_d_en = trim($_POST["agn_d_en"]);
					$max_size_upload = 2048000; //in KB
					$agn_img_old 	= $_POST['gambar_agent'];
					$agn_img 		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
					$agn_img_tmp	= $_FILES["gambar"]["tmp_name"];
					$agn_img_size	= $_FILES["gambar"]["size"];
					$agn_img_x 		= explode(".", $agn_img); // Split file name into an array using the dot
					$agn_img_ext 	= end($agn_img_x); // Now target the last array element to get the file extension
					if(empty($agn_id) || empty($agn_name) || empty($agn_d_id) || empty($agn_d_en)){
						echo "<msg>Error save, field must insert data or select options</msg>";
					}else{					
						$date =date("Y`-m-d");
						$xx="select * from agent where agent_id='$Eagent_result[agent_id]'";
					//	echo $xx;
						$agent_query  = mysql_query($xx);
						if(mysql_num_rows($agent_query)==1){
							if(empty($agn_img)){								
								$agent_update = "update agent 
												set urut='$urut',
												desc_id='$agn_id',
												desc_name='$agn_name',
												agent_desc_id='$agn_d_id',
												agent_desc_en='$agn_d_en'
												where agent_id='$Eagent_result[agent_id]'";
							//	echo $agent_update;
								if(mysql_query($agent_update)){
									if($hapus_galery=="Y"){
										//mysql_query("delete from agent_detail where agent_id='$Eproy_result[agent_id]'")or die(mysql_error());												
										$mst_dtl_agent = "from agent_detail where agent_id='$_GET[agent_id]'";
										$cek_dtl_agent = mysql_query("select small_img,big_img ".$mst_dtl_agent)or die(mysql_error());
										if($cek_dtl_agent){
											while($result_dtl_agent = mysql_fetch_array($cek_dtl_agent)){
												$full = $path.$result_dtl_agent[0];
												$thum = $path.$result_dtl_agent[1];
												//echo $full.$thum;
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}
											$hps_dtl_agent = mysql_query("delete ".$mst_dtl_agent)or die(mysql_error());
											if($hps_dtl_agent){
												echo "<script>alert('Data sudah di hapus');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent">';
											}else{
												echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_project&agent_id='.$_GET['agent_id'].'">';										
											}
										}
									}										
									echo "<msg>Save data sukses<msg>";
									echo '<meta http-equiv="refresh" content="1;halaman.php?page=Agent">';
								}else{
									echo "<msg>Error save, some data is invalid please try again</msg>";
								}
							}else{
								//echo $agn_img_size;
								//break;
								if($agn_img_size < ($max_size_upload+1)){
									$agn_img_ren = str_replace(" ","-",$agn_name)."_".$agn_img;
									$moveResult  = move_uploaded_file($agn_img_tmp, $path.$agn_img_ren);
									if ($moveResult != true) {
										echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
									}else{									
										$resized_file 	= "full-".$agn_img_ren;
										$thumb_file 	= "thumb-".$agn_img_ren;
										ak_img_resize($path.$agn_img_ren, $path.$resized_file, $wmax2, $hmax2, $agn_img_ext);
										ak_img_resize($path.$agn_img_ren, $path.$thumb_file, $wmax4, $hmax4, $agn_img_ext);
										unlink($path.$agn_img_ren);						
										$agent_update = "update agent 
												set urut='$urut',
												desc_id='$agn_id',
												desc_name='$agn_name',
												img='$thumb_file',
												agent_desc_id='$agn_d_id',
												agent_desc_en='$agn_d_en'
												where agent_id='$Eagent_result[agent_id]'";
										if(mysql_query($agent_update)){						
											if($agn_img_old!="not found" and $agn_img_old!="not image" ){
												$image_icon = $path.$agn_img_old;
												$img = $path.str_replace("full","thumb",$agn_img_old);
												if(file_exists($image_icon)){
													unlink($image_icon);
												}
												if(file_exists($img)){
													unlink($img);
												}
											}	
											if($hapus_galery=="Y"){
												//mysql_query("delete from agent_detail where agent_id='$Eproy_result[agent_id]'")or die(mysql_error());												
												$mst_dtl_agent = "from agent_detail where agent_id='$_GET[agent_id]'";
												$cek_dtl_agent = mysql_query("select small_img,big_img ".$mst_dtl_agent)or die(mysql_error());
												if($cek_dtl_agent){
													while($result_dtl_agent = mysql_fetch_array($cek_dtl_agent)){
														$full = $path.$result_dtl_agent[0];
														$thum = $path.$result_dtl_agent[1];
														//echo $full.$thum;														
														if(file_exists($full)){
															unlink($full);
														}
														if(file_exists($thum)){
															unlink($thum);
														}
													}
													$hps_dtl_agent = mysql_query("delete ".$mst_dtl_agent)or die(mysql_error());
													if($hps_dtl_agent){
														echo "<script>alert('Data sudah di hapus');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent">';
													}else{
														echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=Agent&action=edit_project&agent_id='.$_GET['agent_id'].'">';										
													}
												}
											}				
											echo "<msg>the data has been successfully updated<msg>";
											echo '<meta http-equiv="refresh" content="1;halaman.php?page=Agent&action=edit_agent&agent_id='.$Eagent_result['agent_id'].'">';
											
										}else{
											echo "<msg>Error save, some data is wrong please try again</msg>";
										}
									}
								}else{
									echo "<msg>Image size to large max 2MB and your image $agn_img_size</msg>";								
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