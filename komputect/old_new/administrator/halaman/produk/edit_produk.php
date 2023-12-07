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
if($_GET['product_id'] ){
	$Eprod_query  = mysql_query("select * from product where product_id='$_GET[product_id]'")or die (mysql_query());
	if(mysql_num_rows($Eprod_query)==0){
		echo "<msg>Sory Data product for id $_GET[product_id] not found..!, please select other</msg>";
	}else{
		$Eprod_result = mysql_fetch_array($Eprod_query);	
		?>	
		<div id="name-list" style='height:auto;padding:10px;'>		
		  <form method="post" action="" enctype="multipart/form-data" >
			<div id="content-menu">
				<div class='info'>
					<span class='judul'>
						No Urut
					</span>		
					<span class='isi'>
						<select name='urut' style='width:50px'>
							<option value='<?php echo $Eprod_result[0]; ?>'><?php echo $Eprod_result[0]; ?></option>
							<?php
								$cek_urut  = mysql_query("select  distinct (urut) as filter from product order by urut") or die(mysql_error());
								while($cek_urutx = mysql_fetch_array($cek_urut)){									
									echo "<option value='$cek_urutx[0]'>$cek_urutx[0]</option>";
								}
							?>
						</select>
					</span>
				</div>
				<div class='info'>
					<span class='judul'>
						Product Name *
					</span>		
					<span class='isi'>
						<input type="text" required="required" name="prd_name" class="ipro" value="<?php echo $Eprod_result[3]; ?>">
					</span>
				</div>
				<div class='info' style='height:auto;overflow:hidden;'>
					<span class='judul'>
						Product Image
					</span>		
					<span class='isi'>
						<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
					</span>
					<span class='judul'>
						Old Image 
					</span>		
					<span class='isi' style='height:100px;'>
						<?php
							$img_proj_utama = $Eprod_result['image_full'];
							if($img_proj_utama=="-" || strlen($img_proj_utama)==0){
								$img_proj_utama="<input type='text' class='ipro ro' value='not image' style='color:green;' name='gambar_product'/>";
							}elseif(!file_exists($path.$img_proj_utama)){
								$img_proj_utama="<input type='text' class='ipro ro' value='not found' style='color:red;' name='gambar_product'/>";
							}else{		
								$img_proj_utama=" <input type='text' class='ipro ro' value='".$img_proj_utama."' style='color:blue;border:solid 1px blue;box-shadow:0 0 2px blue;' name='gambar_product'/><br/>
								<img src='".$path.$img_proj_utama."' class='img_produk_x'/>";
							}
							echo $img_proj_utama;
						?>
					</span>
					<span class='judul' style='color:green;'>
					<?php 
						$XX="select count(*) from product_detail where product_id='$Eprod_result[product_id]'";
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
							No Urut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $Eprod_result['urut']; ?><br/>
							Product Name : <?php echo $Eprod_result['product_name']; ?><br/>
							</div>
							<a href='halaman.php?page=product_input&action=edit_product&product_id=<?php echo $Eprod_result['product_id'];?>&del_data=Y' class='delY'>Yes</a>&nbsp;&nbsp;&nbsp;
							<a href='halaman.php?page=product_input&action=edit_product&product_id=<?php echo $Eprod_result['product_id']; ?>&del_data=N' class='delN'>No</a> 
							<?php 
							if($_GET['del_data']=="Y"){
								/**/							
								//mysql_query("delete from product_detail where product_id='$Eproy_result[product_id]'")or die(mysql_error());												
								$mst_dtl_product = "from product_detail where product_id='$_GET[product_id]'";
								$cek_dtl_product = mysql_query("select small_img,big_img ".$mst_dtl_product)or die(mysql_error());
								if($cek_dtl_product){
									while($result_dtl_product = mysql_fetch_array($cek_dtl_product)){
										$full = $path.$result_dtl_product[0];
										$thum = $path.$result_dtl_product[1];
										//echo $full.$thum;														
										if(file_exists($full)){
											unlink($full);
										}
										if(file_exists($thum)){
											unlink($thum);
										}
									}
									$hps_dtl_product = mysql_query("delete ".$mst_dtl_product)or die(mysql_error());
									if($hps_dtl_product){
										$mst_product = "from product where product_id='$_GET[product_id]'";
										$cek_product = mysql_query("select image_full,image_ico ".$mst_product)or die(mysql_error());
										if($cek_product){
											$result_product = mysql_fetch_array($cek_product);
											$full = $path.$result_product[0];
											$thum = $path.$result_product[1];
											//echo $full.$thum;														
											if(file_exists($full)){
												unlink($full);
											}
											if(file_exists($thum)){
												unlink($thum);
											}
										}
										$hps_product = mysql_query("delete ".$mst_product)or die(mysql_error());
										if($hps_product){
											echo "<script>alert('Data sudah di hapus');</script>";
											echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input">';										
										}else{
											echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
											echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input&action=edit_product&product_id='.$_GET['product_id'].'">';										
										}
									}else{
										echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
										echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input&action=edit_product&product_id='.$_GET['product_id'].'">';										
									}
								}	
								/**/	
							}elseif($_GET['del_data']=='N'){
								echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input&action=edit_product&product_id='.$_GET['product_id'].'">';
							}							
						?>
						</div>
					<?php } ?>
				</div>
				<div id="accordion">
					<?php 
						$PSI = $Eprod_result[7];
						if(strlen($PSI)!=0){
							$PSI_C = "style='color:green;'";
						}else{
							$PSI_C = "style='color:red;'";
						}
					?>
					<h3 <?php echo $PSI_C; ?>>Product Spek *</h3>
					<div>
						<textarea  type="text" name="prd_s" class='textarea'><?php echo $Eprod_result[7]; ?></textarea>
					</div>
					<?php 
						$PDI = $Eprod_result[8];
						if(strlen($PDI)!=0){
							$PDI_C = "style='color:green;'";
						}else{
							$PDI_C = "style='color:red;'";
						}
					?>
					<h3  <?php echo $PDI_C; ?>>Product Desc *</h3>
					<div>
						<textarea  type="text" name="prd_d" class='textarea'><?php echo $Eprod_result[8]; ?></textarea>
					</div>
				</div>
				<div class='info' style='background:#ccc;margin-top:5px;'>		
					<span class='judul' style='width:230px;margin-top:-5px;margin-left:-20px;'>
						<input type="submit" name="upd_product" value="Simpan Data"  style='margin-top:3px;' class='button_s'>
						<a href='halaman.php?page=product_input&action=edit_product&product_id=<?php echo $Eprod_result['product_id']; ?>&del_data=dele'  class='button_d'  style='margin-top:3px;' >
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
				if(isset($_POST["upd_product"])){
					if(isset($_POST['del_galery'])){
						$hapus_galery = "Y";
					}else{
						$hapus_galery = "N";
					}
					$urut	  = trim(htmlentities(mysql_real_escape_string($_POST["urut"])));
					$prd_name = trim(htmlentities(mysql_real_escape_string($_POST["prd_name"])));
					$prd_s	  = trim($_POST["prd_s"]);
					$prd_d 	  = trim($_POST["prd_d"]);
					$max_size_upload = 2048000; //in KB
					$prd_img_old 	= $_POST['gambar_product'];
					$prd_img 		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
					$prd_img_tmp	= $_FILES["gambar"]["tmp_name"];
					$prd_img_size	= $_FILES["gambar"]["size"];
					$prd_img_x 		= explode(".", $prd_img); // Split file name into an array using the dot
					$prd_img_ext 	= end($prd_img_x); // Now target the last array element to get the file extension
					if(empty($prd_name) || empty($prd_s) || empty($prd_d)){
						echo "<msg>Error save, field must insert data or select options</msg>";
					}else{					
						$date =date("Y`-m-d");
						$xx="select * from product where product_id='$Eprod_result[product_id]'";
					//	echo $xx;
						$product_query  = mysql_query($xx);
						if(mysql_num_rows($product_query)==1){
							if(empty($prd_img)){								
								$product_update = "update product 
												set urut='$urut',
												product_name='$prd_name',
												product_spek='$prd_s',
												product_desc='$prd_d'
												where product_id='$Eprod_result[product_id]'";
								echo $product_update;
								if(mysql_query($product_update)){
									if($hapus_galery=="Y"){
										//mysql_query("delete from product_detail where product_id='$Eproy_result[product_id]'")or die(mysql_error());												
										$mst_dtl_product = "from product_detail where product_id='$_GET[product_id]'";
										$cek_dtl_product = mysql_query("select small_img,big_img ".$mst_dtl_product)or die(mysql_error());
										if($cek_dtl_product){
											while($result_dtl_product = mysql_fetch_array($cek_dtl_product)){
												$full = $path.$result_dtl_product[0];
												$thum = $path.$result_dtl_product[1];
												//echo $full.$thum;
												if(file_exists($full)){
													unlink($full);
												}
												if(file_exists($thum)){
													unlink($thum);
												}
											}
											$hps_dtl_product = mysql_query("delete ".$mst_dtl_product)or die(mysql_error());
											if($hps_dtl_product){
												echo "<script>alert('Data sudah di hapus');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input">';
											}else{
												echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
												echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input&action=edit_product&product_id='.$_GET['product_id'].'">';										
											}
										}
									}										
									echo "<msg>Save data sukses<msg>";
									echo '<meta http-equiv="refresh" content="1;halaman.php?page=product_input">';
								}else{
									echo "<msg>Error save, some data is invalid please try again</msg>";
								}
							}else{
								//echo $prd_img_size;
								//break;
								if($prd_img_size < ($max_size_upload+1)){
									$prd_img_ren = str_replace(" ","-",$prd_name)."_".$prd_img;
									$moveResult  = move_uploaded_file($prd_img_tmp, $path.$prd_img_ren);
									if ($moveResult != true) {
										echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
									}else{									
										$full_size 		= "full-".$prd_img_ren;
										$thumb_file 	= "thumb-".$prd_img_ren;
										ak_img_resize($path.$prd_img_ren, $path.$full_size, $wmax2, $hmax2, $prd_img_ext);
										ak_img_resize($path.$prd_img_ren, $path.$thumb_file, $wmax4, $hmax4, $prd_img_ext);
										unlink($path.$prd_img_ren);						
										$product_update = "update product 
												set urut='$urut',
												product_name='$prd_name',
												image_ico='$thumb_file',
												image_full='$full_size',
												product_spek='$prd_s',
												product_desc='$prd_d'
												where product_id='$Eprod_result[product_id]'";
										if(mysql_query($product_update)){						
											if($prd_img_old!="not found" and $prd_img_old!="not image" ){
												$image_icon = $path.$prd_img_old;
												$image_full = $path.str_replace("full","thumb",$prd_img_old);
												if(file_exists($image_icon)){
													unlink($image_icon);
												}
												if(file_exists($image_full)){
													unlink($image_full);
												}
											}	
											if($hapus_galery=="Y"){
												//mysql_query("delete from product_detail where product_id='$Eproy_result[product_id]'")or die(mysql_error());												
												$mst_dtl_product = "from product_detail where product_id='$_GET[product_id]'";
												$cek_dtl_product = mysql_query("select small_img,big_img ".$mst_dtl_product)or die(mysql_error());
												if($cek_dtl_product){
													while($result_dtl_product = mysql_fetch_array($cek_dtl_product)){
														$full = $path.$result_dtl_product[0];
														$thum = $path.$result_dtl_product[1];
														//echo $full.$thum;														
														if(file_exists($full)){
															unlink($full);
														}
														if(file_exists($thum)){
															unlink($thum);
														}
													}
													$hps_dtl_product = mysql_query("delete ".$mst_dtl_product)or die(mysql_error());
													if($hps_dtl_product){
														echo "<script>alert('Data sudah di hapus');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input">';
													}else{
														echo "<script>alert('Data tidak terhapus silahkan di ulangi');</script>";
														echo '<meta http-equiv="refresh" content="0;halaman.php?page=product_input&action=edit_product&product_id='.$_GET['product_id'].'">';										
													}
												}
											}				
											echo "<msg>the data has been successfully updated<msg>";
											echo '<meta http-equiv="refresh" content="1;halaman.php?page=product_input&action=edit_product&product_id='.$Eprod_result['product_id'].'">';
											
										}else{
											echo "<msg>Error save, some data is wrong please try again</msg>";
										}
									}
								}else{
									echo "<msg>Image size to large max 2MB and your image $prd_img_size</msg>";								
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