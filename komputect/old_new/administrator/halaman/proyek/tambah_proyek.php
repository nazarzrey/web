<div id="name-list" style='height:auto;padding:10px;'>
	<table border='0' width='100%'>
    <?php
		$cek_priority = mysql_fetch_array(mysql_query("select count(utama) from project where utama='Y'"))or die (mysql_query());
	?>
  <form method="post" action="" enctype="multipart/form-data" >
	<tr><td width='20%'>Hal Utama</td>
				<td>
					 <?php
					 if($cek_priority[0]<$max_pry){
					echo	'<select name="utama" style="width:50px;">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>';							 
					}elseif($cek_priority[0]>=$max_pry){
						echo '<input type="text" name="utama" class="ipro ro" value="N" readonly style="width:40px;">';
					}
					 echo 'Total Project untuk Hal Utama '.$cek_priority[0];
					 ?>
				</td>
			</tr>
	<tr><td width='20%'>Type</td>
		<td>
		<select name="tipe">
			<option value='proyek'>proyek</option>
			<option value='servis'>servis</option>
		</select>
		</td>
	</tr>
	<tr><td>Build Name *</td><td><input type="text" required="required" name="bld" class="ipro"></td></tr>
	<tr><td>Lokasi *</td><td><input type="text" required="required" name="lok" class="ipro" style="width:400px;"></td></tr>
	<tr><td>User *</td><td><input type="text" required="required" name="usr" class="ipro"></td></tr>
	<tr><td>Produk *</td>
		<td>
			<?php 
			   $produk_query  = mysql_query("select distinct product_name from product order by product_name")or die(mysql_error());
			   echo "<select name='prd'>";
			   echo "<option value='X'>Pilih Produk</option>";
			   while($produk_result = mysql_fetch_array($produk_query)){
				   echo "<option value='$produk_result[0]'>$produk_result[0]</option>";
			   }
			   echo "</select>";
			?>
		</td>
	</tr>
	<tr><td>Kapasitas *</td><td><input type="text" required="required" name="kap" class="ipro"></td></tr>
	<tr><td>Unit *</td><td><input type="text" required="required" name="unt" class="ipro" style="width:50px;"></td></tr>
	<tr><td>Tahun *</td><td><input type="text" required="required" name="thn" class="ipro"  style="width:100px;"></td></tr>
	<tr><td>Agent</td>
		<td>
			<?php 
			   $agent_query  = mysql_query("select desc_name,agent_id from agent order by urut desc")or die(mysql_error());
			   echo "<select name='agn' style='width:310px;'>";
			   while($agent_result = mysql_fetch_array($agent_query)){
				   echo "<option value='$agent_result[1]'>".strtolower($agent_result[0])."</option>";
			   }
			   echo "</select>";
			?>
		</td>
	</tr>
	<tr><td>Image max 2MB</td>
		<td>
			<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
		</td>
	</tr>
	<tr><td><input type="submit" name="save_proyek" value="Simpan Data" class='button_s'></td>	
  </form>
		<td>
		<?php
			if(isset($_POST["save_proyek"])){
				$pry_utm = trim(htmlentities(mysql_real_escape_string($_POST["utama"])));
				$pry_typ = trim(htmlentities(mysql_real_escape_string($_POST["tipe"])));
				$pry_bld = trim(htmlentities(mysql_real_escape_string($_POST["bld"])));
				$pry_lok = trim(htmlentities(mysql_real_escape_string($_POST["lok"])));
				$pry_usr = trim(htmlentities(mysql_real_escape_string($_POST["usr"])));
				$pry_prd = trim(htmlentities(mysql_real_escape_string($_POST["prd"])));
				$pry_kap = trim(htmlentities(mysql_real_escape_string($_POST["kap"])));
				$pry_unt = trim(htmlentities(mysql_real_escape_string($_POST["unt"])));
				$pry_thn = trim(htmlentities(mysql_real_escape_string($_POST["thn"])));
				$pry_agn = trim(htmlentities(mysql_real_escape_string($_POST["agn"])));
				$max_size_upload = 2048000; //in KB
				$pry_img 		= strtolower(trim(htmlentities(mysql_real_escape_string($_FILES["gambar"]["name"]))));
				$pry_img_tmp	= $_FILES["gambar"]["tmp_name"];
				$pry_img_size	= $_FILES["gambar"]["size"];
				//echo $pry_img_size.$pry_img_tmp.$pry_img;
				$pry_img_x 		= explode(".", $pry_img); // Split file name into an array using the dot
				$pry_img_ext 	= end($pry_img_x); // Now target the last array element to get the file extension
				if(empty($pry_bld) || empty($pry_lok) || empty($pry_usr) || empty($pry_kap) || empty($pry_unt) || empty($pry_thn) || $pry_prd=="X"){
					echo "<msg>Error save, field must insert data or select options</msg>";
				}else{					
					$date =date("Y-m-d");
					$key_proyek = md5($date.$pry_typ.$pry_bld.$pry_lok.$pry_usr.$pry_prd.$pry_kap.$pry_unt.$pry_thn.$pry_agn);
					$proyek_query  = mysql_query("select * from project where project_id='$key_proyek'")or die(mysql_error());
					if(mysql_fetch_row($proyek_query)==0){
						if(empty($pry_img)){
							$proyek_insert = mysql_query("insert into project values('$key_proyek','$pry_typ','$pry_bld','$pry_lok','$pry_usr','$pry_prd','$pry_kap','$pry_unt','$pry_thn',null,null,'$date','$pry_agn','$pry_utm')");							
							if($proyek_insert){										
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
									$proyek_insert = mysql_query("insert into project values('$key_proyek','$pry_typ','$pry_bld','$pry_lok','$pry_usr','$pry_prd','$pry_kap','$pry_unt','$pry_thn','$resized_file',null,'$date','$pry_agn','$pry_utm')");
									if($proyek_insert){										
										echo "<msg>Save data sukses<msg>";
										echo '<meta http-equiv="refresh" content="1;halaman.php?page=project_input">';
									}else{
										echo "<msg>Error save, some data is invalid please try again</msg>";
									}
								}
							}else{
								echo "<msg>Image size to large max 2MB and your image $pry_img_size</msg>";								
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