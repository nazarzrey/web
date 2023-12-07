<div id="name-list" style='height:auto;padding:10px;'>
  <form method="post" action="" enctype="multipart/form-data" >
	<div id="content-menu">
		<div class='info'>
			<span class='judul'>
				Aktif
			</span>		
			<span class='isi'>
				<select name="news_aktif">
					<option value="Y">Y</option>
					<option value="N">N</option>
				</select>
				<?php 
				$cek_urut = mysql_fetch_array(mysql_query("select count(*) as total from berita"));
				if($cek_urut[0]<10){
					$id_berita = "BR00".($cek_urut[0]+1);
				}elseif($cek_urut[0]<100){					
					$id_berita = "BR0".($cek_urut[0]+1);	
				}elseif($cek_urut[0]<1000){			
					$id_berita = "BR".($cek_urut[0]+1);					
				}
				?>
				<input name='id_berita' value='<?php echo $id_berita; ?>' style="display:none;">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Utama
			</span>		
			<span class='isi'>
				<select name="news_utama">
					<option value="Y">Y</option>
					<option value="N">N</option>
				</select>
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Judul ID *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="news_judul_id" class="ipro" maxlength="200" style="width:500px;">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Judul EN *
			</span>		
			<span class='isi'>
				<input type="text" required="required" name="news_judul_en" class="ipro" maxlength="200" style="width:500px;">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Gambar berita
			</span>		
			<span class='isi'>
				<input type="file" name="gambar" class="ipro" accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
			</span>
		</div>
		<div id="accordion">
			<h3>Konten Berita ID *</h3>
			<div>
				<textarea  type="text" name="news_isi_id" class='textarea'></textarea>
			</div>
			<h3>Konten Berita EN *</h3>
			<div>
				<textarea  type="text" name="news_isi_en"  class='textarea'></textarea>
			</div>
		</div>
		<div class='info'>
			<span class='judul'>
				<input type="submit" name="save_berita" value="Simpan Data"  style='margin-top:-2px; width:120px;'>
			</span>				
			<span class='isi'>
				<?php 
				if(!isset($_POST["save_berita"])){
					echo "<i style='font-size:12px;'>(*) isian tidak boleh kosong</i>";
				}
				?>
			</span>
			
		</div>
	</div>
  </form>
<?php
if(isset($_POST["save_berita"])){
	$news_id 		= trim($_POST["id_berita"]);
	$news_aktif 	= trim($_POST["news_aktif"]);
	$news_utama 	= trim($_POST["news_utama"]);
	$news_judul_id 	= trim($_POST["news_judul_id"]);
	$news_key	 	= str_replace(" ","-",$news_judul_id);
	$news_judul_en 	= trim($_POST["news_judul_en"]);
	$news_isi_id 	= trim($_POST["news_isi_id"]);
	$news_isi_en 	= trim($_POST["news_isi_en"]);
	$max_size_upload = 2048000; //in KB
	$news_img 		= strtolower(trim($_FILES["gambar"]["name"]));
	$news_img_tmp	= $_FILES["gambar"]["tmp_name"];
	$news_img_size	= $_FILES["gambar"]["size"];
	//echo $news_img_size.$news_img_tmp.$news_img;
	$news_img_x 		= explode(".", $news_img); // Split file name into an array using the dot
	$news_img_ext 	= end($news_img_x); // Now target the last array element to get the file extension
	if(empty($news_judul_id) || empty($news_judul_en) || empty($news_isi_id) || empty($news_isi_en)){
		echo "<msg>Error save, field must insert data or select options</msg>";
	}else{					
		$date =date("Y-m-d");
		$jam  =date("H:i:s");
		$berita_query  = mysql_query("select * from berita where id_berita='$news_id'")or die(mysql_error());
		if(mysql_fetch_row($berita_query)==0){
			if(empty($news_img)){
				$berita_insert = mysql_query("insert into berita (id_berita,key_berita,judul_id,judul_en,aktif,utama,isi_berita_id,isi_berita_en,tanggal,jam) 
														   values('$news_id','$news_key','$news_judul_id','$news_judul_en','$news_aktif','$news_utama','$news_isi_id','$news_isi_en','$date','$jam')");							
				if($berita_insert){										
					echo "<msg>Save data sukses<msg>";
					echo '<meta http-equiv="refresh" content="1;halaman.php?page=M_berita">';
				}else{
					echo "<msg>Error save, some data is invalid please try again</msg>";
				}
			}else{
				//echo $news_img_size;
				//break;
				if($news_img_size < ($max_size_upload+1)){
					$news_img_ren = str_replace(" ","-",$news_id)."_".$news_img;
					$moveResult  = move_uploaded_file($news_img_tmp, $path.$news_img_ren);
					if ($moveResult != true) {
						echo "<msg>ERROR: File not uploaded. maybe size of image to large, please try again</msg>";
					}else{									
						$resized_file 	= "full-".$news_img_ren;
						$thumb_file 	= "thumb-".$news_img_ren;
						ak_img_resize($path.$news_img_ren, $path.$resized_file, $wmax2, $hmax2, $news_img_ext);
						ak_img_resize($path.$news_img_ren, $path.$thumb_file, $wmax4, $hmax4, $news_img_ext);
						unlink($path.$news_img_ren);
						$berita_insert = mysql_query("insert into berita (id_berita,key_berita,judul_id,judul_en,aktif,utama,isi_berita_id,isi_berita_en,tanggal,jam,gambar_kecil,gambar_besar) 
														   values('$news_id','$news_key','$news_judul_id','$news_judul_en','$news_aktif','$news_utama','$news_isi_id','$news_isi_en','$date','$jam','$thumb_file','$resized_file')");
						if($berita_insert){										
							echo "<msg>Save data sukses<msg>";
							echo '<meta http-equiv="refresh" content="1;halaman.php?page=M_berita">';
						}else{
							echo "<msg>Error save, some data is invalid please try again</msg>";
						}
					}
				}else{
					echo "<msg>Image size to large max 2MB and your image $news_img_size</msg>";								
				}
			}
		}else{
			echo "<msg>Error save, data already exists<msg>";
		}
	}
}
?>
</div>