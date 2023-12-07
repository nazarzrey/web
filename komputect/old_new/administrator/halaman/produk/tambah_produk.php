<div id="name-list" style='height:auto;padding:10px;'>
  <form method="post" action="" enctype="multipart/form-data" >
	<?php 
		$cek_urut  = mysql_fetch_array(mysql_query("select  max(urut) as maksimal from product")) or die(mysql_error());
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
				Product Name *
			</span>		
			<span class='isi'>
				<input type="text" required name="pro_name" class="ipro">
			</span>
		</div>
		<div class='info'>
			<span class='judul'>
				Product Image *
			</span>		
			<span class='isi'>
				<input type="file" name="gambar" class="ipro" required accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
			</span>
		</div>
		<div id="accordion">
			<h3>Product Spek *</h3>
			<div>
				<textarea  type="text" name="pro_s" class='textarea'></textarea>
			</div>
			<h3>Product Desc *</h3>
			<div>
				<textarea  type="text" name="pro_d" class='textarea'></textarea>
			</div>
		</div>
		<div class='info'>
			<span class='judul'>
				<input type="submit" name="save_product" value="Simpan Data"  style='margin-top:-2px; width:120px;'>
			</span>				
			<span class='isi'>
				<?php 
				if(!isset($_POST["save_product"])){
					echo "<i style='font-size:12px;'>(*) isian tidak boleh kosong</i>";
				}
				?>
			</span>
			
		</div>
	</div>
  </form>
<?php
if(isset($_POST["save_product"])){
	$prd_urut 	= trim($_POST["urut"]);
	$prd_name 	= trim($_POST["pro_name"]);
	$prd_s 		= trim($_POST["pro_s"]);
	$prd_d 		= trim($_POST["pro_d"]);
	$max_size_upload = 2048000; //in KB
	$prd_img 		 = strtolower(trim($_FILES["gambar"]["name"]));
	$prd_img_tmp	 = $_FILES["gambar"]["tmp_name"];
	$prd_img_size	 = $_FILES["gambar"]["size"];
	$prd_img_x 		 = explode(".", $prd_img); // Split file name into an array using the dot
	$prd_img_ext 	 = end($prd_img_x); // Now target the last array element to get the file extension
	if(empty($prd_name) || empty($prd_s) || empty($prd_d)){
		echo "<msg>Error save, field must insert data or select options</msg>";
	}else{					
		$date =date("Y-m-d");
		$key_product = md5($date.$prd_urut.$prd_name.$prd_s.$prd_d);
		$product_query  = mysql_query("select * from product where product_id='$key_product'")or die(mysql_error());
		if(mysql_fetch_row($product_query)==0){
			if(empty($prd_img)){
				$product_insert = mysql_query("insert into product (product,urut,product_name,product_spek,product_desc) values('$key_product','$prd_urut','$prd_name','$prd_s','$prd_d')");							
				if($product_insert){										
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
						$full_file 		= "full-".$prd_img_ren;
						$thumb_file 	= "thumb-".$prd_img_ren;
						ak_img_resize($path.$prd_img_ren, $path.$full_file, $wmax2, $hmax2, $prd_img_ext);
						ak_img_resize($path.$prd_img_ren, $path.$thumb_file, $wmax4, $hmax4, $prd_img_ext);
						unlink($path.$prd_img_ren);
						$product_insert = mysql_query("insert into product (product_id,urut,product_name,image_ico,image_full,product_spek,product_desc) values('$key_product','$prd_urut','$prd_name','$thumb_file','$full_file','$prd_s','$prd_d')");							
						if($product_insert){										
							echo "<msg>Save data sukses<msg>";
							echo '<meta http-equiv="refresh" content="1;halaman.php?page=product_input">';
						}else{
							echo "<msg>Error save, some data is invalid please try again</msg>";
						}
					}
				}else{
					echo "<msg>Image size to large max 2MB and your image $prd_img_size</msg>";								
				}
			}
		}else{
			echo "<msg>Error save, data already exists<msg>";
		}
	}
}
?>
</div>