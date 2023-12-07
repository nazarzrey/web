<?php				
if($_GET['project_id'] ){
	$Eproy_query  = mysql_query("select * from project where project_id='$_GET[project_id]'")or die (mysql_query());
	$cek_priority = mysql_fetch_array(mysql_query("select count(utama) from project where utama='Y'"))or die (mysql_query());
	if(mysql_num_rows($Eproy_query)==0){
		echo "<msg>Sory Data project for id $_GET[project_id] not found..!, please select other</msg>";
	}else{
		$Eproy_result = mysql_fetch_array($Eproy_query);	
		?>	
		<div id="name-list" style='height:auto;padding:10px;'>
			<table border='0' width='100%'>
		  <form method="post" action="" enctype="multipart/form-data" >
			<tr><td width='20%'>Hal Utama</td>
				<td>
					 <?php
					 if($cek_priority[0]<$max_pry and $Eproy_result[13]=="Y"){
					echo	'<select name="utama" style="width:50px;">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>';							 
					}elseif($cek_priority[0]>=$max_pry and $Eproy_result[13]=="Y"){						
					echo	'<select name="utama" style="width:50px;">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>';							 
					}elseif($cek_priority[0]<$max_pry and $Eproy_result[13]=="N"){
					echo	'<select name="utama" style="width:50px;">
								<option value="N">N</option>
								<option value="Y">Y</option>
							</select>';							 
					}elseif($cek_priority[0]>=$max_pry and $Eproy_result[13]=="N"){
						echo '<input type="text" name="utama" class="ipro ro" value="'.$Eproy_result[13].'" readonly style="width:40px;">';
					}
					 echo 'Total Project untuk Hal Utama '.$cek_priority[0];
					/*else{
						echo '<input type="text" name="utama" class="ipro ro" value="'.$Eproy_result[13].'" readonly style="width:40px;"> Total Project untuk Hal Utama '.$cek_priority[0];
					}
						/*
					echo	'<select name="utama" style="width:50px;">					
								<option value="N">N</option>
								<option value="Y">Y</option>
							</select>';								 
						 }
					 }else{
						
					 }
					 */
					 ?>
				</td>
			</tr>
			<tr><td width='20%'>Type</td>
				<td>
					<input type="text" name="typ" class="ipro ro" value="<?php echo $Eproy_result[1]?>" readonly style="width:100px;">
				</td>
			</tr>
			<tr><td>Build Name *</td><td><input type="text" required="required" name="bld" class="ipro" value="<?php echo $Eproy_result[2]?>"></td></tr>
			<tr><td>Lokasi *</td><td><input type="text" required="required" name="lok" class="ipro" value="<?php echo $Eproy_result[3]?>" style="width:450px;"></td></tr>
			<tr><td>User *</td><td><input type="text" required="required" name="usr" class="ipro" value="<?php echo $Eproy_result[4]?>"></td></tr>
			<tr><td>Produk *</td>
				<td>
					<?php 
					   echo "<select name='prd' style='width:300px;'>";
					   echo "<option value='$Eproy_result[5]'>$Eproy_result[5]</option>";
					   $produk_query  = mysql_query("select distinct product_name from product order by product_name")or die(mysql_error());
					   while($produk_result = mysql_fetch_array($produk_query)){
						   echo "<option value='$produk_result[0]'>$produk_result[0]</option>";
					   }
					   echo "</select>";
					?>
				</td>
			</tr>
			<tr><td>Kapasitas *</td><td><input type="text" required="required" name="kap" class="ipro" value="<?php echo $Eproy_result[6]?>"></td></tr>
			<tr><td>Unit *</td><td><input type="text" required="required" name="unt" class="ipro" value="<?php echo $Eproy_result[7]?>" style="width:50px;"></td></tr>
			<tr><td>Tahun *</td><td><input type="text" required="required" name="thn" class="ipro"  value="<?php echo $Eproy_result[8]?>" style="width:100px;"></td></tr>
			<tr><td>Agent *</td>
				<td>
					<?php 
					   $Magent_query  = mysql_fetch_array(mysql_query("select desc_name,agent_id from agent  where agent_id='$Eproy_result[12]'")); // or die(mysql_error());
					   echo "<select name='agn' style='width:300px;'>";
					   echo "<option value='$Magent_query[1]'>".strtolower($Magent_query[0])."</option>";
					   $agent_query  = mysql_query("select desc_name,agent_id from agent order by urut desc")or die(mysql_error());
					   while($agent_result = mysql_fetch_array($agent_query)){
						   echo "<option value='$agent_result[1]'>".strtolower($agent_result[0])."</option>";
					   }
					   echo "</select>";
					?>
				</td>
			</tr>
			<?php
			echo '<tr><td>Old Image</td><td>';
				$img_proj_utama = $Eproy_result['project_img'];
				if($img_proj_utama=="-" || strlen($img_proj_utama)==0){
					$img_proj_utama="<input type='text' class='ipro ro' value='not image' style='color:green;' name='gambar_project'/>";
				}elseif(!file_exists($path.$img_proj_utama)){
					$img_proj_utama="<input type='text' class='ipro ro' value='not found' style='color:red;' name='gambar_project'/>";
				}else{		
					$img_proj_utama="<img src='".$path.$img_proj_utama."' class='img_project_x'/><br/><input type='text' class='ipro ro' value='".$img_proj_utama."' style='color:blue;border:solid 1px blue;' name='gambar_project'/>";
				}
				echo $img_proj_utama."</td></tr>";
			?>
				<?php 
					$gal_cek = mysql_query("select count(*) from project_detail where project_id='$Eproy_result[project_id]'");
					$gal_res = mysql_fetch_row($gal_cek);
					if($gal_res[0]>0){					
					echo "<tr>
						<td><span style='color:green;'>Galery <b>$gal_res[0]</b> data</span></td>
						<td><div style='float:left;'><input type='checkbox' name='del_galery' id='del_gal' style='height:20px;width:20px;'></div><div style='margin-top:6px;'><label for='del_gal'>Hapus Data Galery</label></div></td>
					</tr>";	
					}
				?>
			<tr>
				<td>New Image max 2MB</td>
				<td>
					<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
				</td>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="upd_project" class='button_s' value="Update Data" >
					<a href='halaman.php?page=project_input&action=edit_project&project_id=<?php echo $Eproy_result['project_id']; ?>&del_data=dele'  class='button_d'>
						Delete Data
					</a>
				</td>	
			</tr>
		  </form>
			<td></td><td>
			<?php					
				if(isset($_POST["upd_project"])){
					if(isset($_POST['del_galery'])){
						$hapus_galery = "Y";
					}else{
						$hapus_galery = "N";
					}
					$pry_utm = trim(htmlentities(mysql_real_escape_string($_POST["utama"])));
					$pry_bld = trim(htmlentities(mysql_real_escape_string($_POST["bld"])));
					$pry_lok = trim(htmlentities(mysql_real_escape_string($_POST["lok"])));
					$pry_usr = trim(htmlentities(mysql_real_escape_string($_POST["usr"])));
					$pry_prd = trim(htmlentities(mysql_real_escape_string($_POST["prd"])));
					$pry_kap = trim(htmlentities(mysql_real_escape_string($_POST["kap"])));
					$pry_unt = trim(htmlentities(mysql_real_escape_string($_POST["unt"])));
					$pry_thn = trim(htmlentities(mysql_real_escape_string($_POST["thn"])));
					$pry_agn = trim(htmlentities(mysql_real_escape_string($_POST["agn"])));
					$max_size_upload = 2048000; //in KB
					$pry_img_old 	= $_POST['gambar_project'];
					$pry_img 		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
					$pry_img_tmp	= $_FILES["gambar"]["tmp_name"];
					$pry_img_size	= $_FILES["gambar"]["size"];
					//echo $pry_img_size.$pry_img_tmp.$pry_img;
					$pry_img_x 		= explode(".", $pry_img); // Split file name into an array using the dot
					$pry_img_ext 	= end($pry_img_x); // Now target the last array element to get the file extension
					if(empty($pry_bld) || empty($pry_lok) || empty($pry_usr) || empty($pry_kap) || empty($pry_unt) || empty($pry_thn)){
						echo "<msg>Error save, field must insert data or select options</msg>";
					}else{					
						$date =date("Y`-m-d");
						//$key_project = md5($date.$pry_typ.$pry_bld.$pry_lok.$pry_usr.$pry_prd.$pry_kap.$pry_unt.$pry_thn.$pry_agn);
						$xx="select * from project where project_id='$Eproy_result[project_id]'";
					//	echo $xx;
						$project_query  = mysql_query($xx);
						if(mysql_num_rows($project_query)==1){
							if(empty($pry_img)){								
								$project_update = "update project set 
													build_name='$pry_bld',
													lokasi='$pry_lok',
													user='$pry_usr',
													produk='$pry_prd',
													kapasitas='$pry_kap',
													unit='$pry_unt',
													tahun='$pry_thn',
													agent_id='$pry_agn',
													utama='$pry_utm'
													where project_id='$Eproy_result[project_id]'";
								//echo $project_update;
								if(mysql_query($project_update)){
									if($hapus_galery=="Y"){
										/***/						
										$mst_dtl_project = "from project_detail where project_id='$_GET[project_id]'";
										$cek_dtl_project = mysql_query("select small_img,big_img ".$mst_dtl_project)or die(mysql_error());
										if($cek_dtl_project){
											while($result_dtl_project = mysql_fetch_array($cek_dtl_project)){
												$full = $path.$result_dtl_project[0];
												$thum = $path.$result_dtl_project[1];
												//echo $full.$thum;
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}
											$hps_dtl_project = mysql_query("delete ".$mst_dtl_project)or die(mysql_error());
											if($hps_dtl_project){
												echo "<script>alert('Data sudah di hapus');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input">';										
											}else{
												echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input&action=edit_project&project_id='.$_GET['project_id'].'">';										
											}
										}
									}
									echo "<msg>Save data sukses<msg>";
									echo '<meta http-equiv="refresh" content="1;halaman.php?page=project_input">';
								}else{
									echo "<msg>Error save, some data is invalid please try again</msg>";
								}
							}else{
								//echo $pry_img_size;
								//break;
								if($pry_img_size < ($max_size_upload+1)){
									$pry_img_ren = str_replace(" ","-",$pry_bld)."_".$pry_img;
									$moveResult  = move_uploaded_file($pry_img_tmp, $path.$pry_img_ren);
									if ($moveResult != true) {
										echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
									}else{									
										$resized_file 	= "full-".$pry_img_ren;
										$thumb_file 	= "thumb-".$pry_img_ren;
										ak_img_resize($path.$pry_img_ren, $path.$resized_file, $wmax2, $hmax2, $pry_img_ext);
										ak_img_resize($path.$pry_img_ren, $path.$thumb_file, $wmax4, $hmax4, $pry_img_ext);
										unlink($path.$pry_img_ren);										
										$project_update = mysql_query("
											update project 
											set build_name='$pry_bld',
												lokasi='$pry_lok',
												user='$pry_usr',
												produk='$pry_prd',
												kapasitas='$pry_kap',
												unit='$pry_unt',
												tahun='$pry_thn',
												agent_id='$pry_agn',
												upd_data='$date',
												project_img='$resized_file',
												utama='$pry_utm'
											where project_id='$Eproy_result[project_id]'");	
										if($project_update){						
											if($pry_img_old!="not found" and $pry_img_old!="not image" ){
												$full = $path.$pry_img_old;
												$thum = $path.str_replace("full","thumb",$pry_img_old);
												//echo $full. " - ".$thum;
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}
											if($hapus_galery=="Y"){
												//mysql_query("delete from project_detail where project_id='$Eproy_result[project_id]'")or die(mysql_error());												
												$mst_dtl_project = "from project_detail where project_id='$_GET[project_id]'";
												$cek_dtl_project = mysql_query("select small_img,big_img ".$mst_dtl_project)or die(mysql_error());
												if($cek_dtl_project){
													while($result_dtl_project = mysql_fetch_array($cek_dtl_project)){
														$full = $path.$result_dtl_project[0];
														$thum = $path.$result_dtl_project[1];
														//echo $full.$thum;														
														if(file_exists($full)){
															unlink($full);
														}
														if(file_exists($thum)){
															unlink($thum);
														}
													}
													$hps_dtl_project = mysql_query("delete ".$mst_dtl_project)or die(mysql_error());
													if($hps_dtl_project){
														echo "<script>alert('Data sudah di hapus');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input">';
													}else{
														echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input&action=edit_project&project_id='.$_GET['project_id'].'">';										
													}
												}
											}			
											echo "<msg>Save data sukses<msg>";
											echo '<meta http-equiv="refresh" content="1;halaman.php?page=project_input&action=edit_project&project_id='.$Eproy_result['project_id'].'">';
											
										}else{
											echo "<msg>Error save, some data is invalid please try again</msg>";
										}
									}
								}else{
									echo "<msg>Image size to large max 2MB and your image $pry_img_size</msg>";								
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
							<a href='halaman.php?page=project_input&action=edit_project&project_id=<?php echo $Eproy_result['project_id'];?>&del_data=Y' class='delY'>Yes</a>&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=project_input&action=edit_project&project_id=<?php echo $Eproy_result['project_id']; ?>&del_data=N' class='delN'>No</a> 
							<?php 
								if($_GET['del_data']=="Y"){
									//mysql_query("delete from project_detail where project_id='$Eproy_result[project_id]'")or die(mysql_error());												
									$mst_dtl_project = "from project_detail where project_id='$_GET[project_id]'";
									$cek_dtl_project = mysql_query("select small_img,big_img ".$mst_dtl_project)or die(mysql_error());
									if($cek_dtl_project){
										while($result_dtl_project = mysql_fetch_array($cek_dtl_project)){
											$full = $path.$result_dtl_project[0];
											$thum = $path.$result_dtl_project[1];
											//echo $full.$thum;														
											if(file_exists($full)){
												unlink($full);
											}
											if(file_exists($thum)){
												unlink($thum);
											}
										}
										$hps_dtl_project = mysql_query("delete ".$mst_dtl_project)or die(mysql_error());
										if($hps_dtl_project){
											$mst_project = "from project where project_id='$_GET[project_id]'";
											$cek_project = mysql_query("select project_img ".$mst_project)or die(mysql_error());
											if($cek_project){
												$result_project = mysql_fetch_array($cek_project);
												$full = $path.$result_project[0];
												$thum = $path.str_replace("full","thumb",$result_project[0]);
												//echo $full.$thum;														
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}
											$hps_project = mysql_query("delete ".$mst_project)or die(mysql_error());
											if($hps_project){
												echo "<script>alert('Data sudah di hapus');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input">';										
											}else{
												echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input&action=edit_project&project_id='.$_GET['project_id'].'">';										
											}
										}else{
											echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
											echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input&action=edit_project&project_id='.$_GET['project_id'].'">';										
										}
									}									
								}elseif($_GET['del_data']=='N'){
									echo '<meta http-equiv="refresh" content="0;halaman.php?page=project_input&action=edit_project&project_id='.$_GET['project_id'].'">';
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