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
				<input type="text" name="urut" class="ipro ro" value="<?php echo ($cek_urut[0]+1); ?>" readonly style="width:50px;">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent Id *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_id" class="ipro" style="width:175px;">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent Name *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_name" class="ipro">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent URL *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="agn_url" class="ipro">ex : http://wwww.facebook.com
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Agent Image
			</span>		
			<span class='isi'>
				<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
			</span>
		</div>
		<div id="accordion">
			<h3>Agent Desc Id *</h3>
			<div>
				<textarea  type="text" name="agn_d_id" class='textarea'></textarea>
			</div>
			<h3>Agent Desc En *</h3>
			<div>
				<textarea  type="text" name="agn_d_en"  class='textarea'></textarea>
			</div>
		</div>
		<div class='info'>
			<span class='judul'>
				<input type="submit" name="save_agent" value="Simpan Data"  style='margin-top:-2px; width:120px;'>
			</span>				
			<span class='isi'>
				<?php 
				if(!isset($_POST["save_agent"])){
					echo "<i style='font-size:12px;'>(*) isian tidak boleh kosong</i>";
				}
				?>
			</span>			
		</div>
	</div>
  </form>
<?php
if(isset($_POST["save_agent"])){
	$agn_urut = trim($_POST["urut"]);
	$agn_id	  = trim($_POST["agn_id"]);
	$agn_name = trim($_POST["agn_name"]);
	$agn_url = trim($_POST["agn_url"]);
	$agn_d_id = trim($_POST["agn_d_id"]);
	$agn_d_en = trim($_POST["agn_d_en"]);
	$max_size_upload = 2048000; //in KB
	$agn_img 		= strtolower(trim($_FILES["gambar"]["name"]));
	$agn_img_tmp	= $_FILES["gambar"]["tmp_name"];
	$agn_img_size	= $_FILES["gambar"]["size"];
	//echo $agn_img_size.$agn_img_tmp.$agn_img;
	$agn_img_x 		= explode(".", $agn_img); // Split file name into an array using the dot
	$agn_img_ext 	= end($agn_img_x); // Now target the last array element to get the file extension
	if(empty($agn_name) || empty($agn_d_id) || empty($agn_d_en)){
		echo "<msg>Error save, field must insert data or select options</msg>";
	}else{					
		$date =date("Y-m-d");
		$key_agent = md5($date.$agn_urut.$agn_name.$agn_id.$agn_url.$agn_d_id.$agn_d_en);
		$agent_query  = mysql_query("select * from agent where agent_id='$key_agent'")or die(mysql_error());
		if(mysql_fetch_row($agent_query)==0){
			if(empty($agn_img)){
				$agent_insert = mysql_query("insert into agent (agent_id,urut,desc_id,desc_name,url,agent_desc_id,agent_desc_en,upd)values('$key_agent','$agn_urut','$agn_id','$agn_name','$agn_url','$agn_d_id','$agn_d_en','$date')") or die(mysql_error());
				if($agent_insert){										
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
						$agent_insert = mysql_query("insert into agent (agent_id,urut,desc_id,desc_name,url,agent_desc_id,agent_desc_en,upd,img)values('$key_agent','$agn_urut','$agn_id','$agn_name','$agn_url','$agn_d_id','$agn_d_en','$date','$resized_file')") or die(mysql_error());	
						if($agent_insert){										
							echo "<msg>Save data sukses<msg>";
							echo '<meta http-equiv="refresh" content="1;halaman.php?page=Agent">';
						}else{
							echo "<msg>Error save, some data is invalid please try again</msg>";
						}
					}
				}else{
					echo "<msg>Image size to large max 2MB and your image $agn_img_size</msg>";								
				}
			}
		}else{
			echo "<msg>Error save, data already exists<msg>";
		}
	}
}
?>
</div>