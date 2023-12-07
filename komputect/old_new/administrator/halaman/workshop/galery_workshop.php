<style>
.img_gal{
	margin:5px;
	float:left;
	border:solid 1px green;
	box-shadow:0 0 5px green;
	border-radius:5px;
}
.img_gal img{
	border:solid 5px #ffc;
	box-shadow:0 0 5px #ccc;
	border-radius:5px;
	cursor:pointer;
	width:63px;
	height:50px;
}
.img_gal img:active{
	border:solid 5px gold;
}
</style>
<div class='action' style='border-color:green;box-shadow:0 0 10px green;	'>
	<?php if($var_workshop=="add_galery"){?>
	<span style="margin-top:5px; font-size:16px;font-weight:bold;">
		Add Galery <?php echo $Nid;	 ?> 
	</span>
	<span><a href="<?php echo $web_page; ?>" class="X_close">X</a></span>
	<hr width="97%" align="center" color="orange" style="float:left;">
			<table border='0' width='100%' class="action_in">
		  <form method="post" action="" enctype="multipart/form-data" >
			<?php
			$wshp_dtl_query  = mysql_query("select count(recid),max(urut) from galery where recid='$Key'")or die(mysql_error());
			$wshp_dtl_result= mysql_fetch_array($wshp_dtl_query);
			echo '<tr><td width="20%">Galery </td><td><input type="text" class="ipro ro" value="'.$Nid.'"readonly style="background:#ddd;border:none;padding:3px;"></td></tr>';
			echo '<tr><td>Image Galery</td><td>';
				echo '<input type="text" name="max_galery"  value="'.($wshp_dtl_result[1]+1).'"readonly style="display:none;">';
				echo '<input type="text" name="total_galery" class="ipro ro" value="'.$wshp_dtl_result[0].'"readonly style="width:30px;text-align:center;background:#ddd;border:none;padding:3px;"> Image</td></tr>"';
			?>
					
			<tr><td></td><td><i style='font-size:12px;'>Max upload all image 10MB,</i></td></tr>
			<tr><td></td><td>
					<input type="file" name="berkas2[]" class="ipro" required="required" multiple accept="image/jpg,image/jpeg,image/JPG,image/JPEG">
				</td>
			</tr>
			<tr><td></td><td><input type="submit" name="save_galery" value="Upload Galery" class="button_s" ></td></tr>	
		  </form>
			<tr>
				<td></td><td>
				<?php
					if(isset($_POST["save_galery"])){
						$max_size_upload = 10240000; //in KB
						if(isset($_FILES['berkas2'])) {
							$cnt=0;
							foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
								$fileName 	= strtolower("{$_FILES['berkas2']['name'][$key]}");			
								$fileSize 	= ("{$_FILES['berkas2']['size'][$key]}"); // File size in bytes	
								//echo $fileName." -> ".($fileSize)."</br>";
								//echo $size."</br>";
								$cnt += $fileSize;
								}
							}
							//echo $cnt;
							if($cnt!=0){
								if($cnt >$max_size_upload ){
									echo '<script>alert("Maaf total file melebihi ketentuan yaitu '.$max_size_upload.' \\njadi tidak bisa di upload")</script>';
								}else{
									if($_POST['max_galery']==0){
										$Pno=1;
									}else{
										$Pno=$_POST['max_galery'];
									}
									foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
										$date_time		= date("Y-m-d H:i:s");
										$str_DT			= date("Y-m-dHis");
										$str_arr2 		= array(',',"'",'"','@',';',':','+','*',"/","\\","?","&");
										$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
										$kaboom 		= explode(".", $file_name); // Split file name into an array using the dot
										$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
										move_uploaded_file($tmp_name, $path.$file_name);
										$ren_file		= substr(md5($Nid.$Key.$Pno.$date_time.$file_name),0,10).$str_DT.".".$fileExt;
										$full_file 		= "full_galery_".str_replace($str_arr2,"",str_replace(" ","-",$Nid."_".$ren_file));
										$thumb_file 	= "thumb_galery_".str_replace($str_arr2,"",str_replace(" ","-",$Nid."_".$ren_file));
										$id_galery		= md5($Nid.$Key.$Pno.$full_file.$thumb_file.$date_time);
										ak_img_resize($path.$file_name, $path.$full_file, $wmax2, $hmax2, $fileExt);
										ak_img_resize($path.$file_name, $path.$thumb_file, $wmax4, $hmax4, $fileExt);
										unlink($path.$file_name);
										$insert_agent_dtl = mysql_query("insert into galery(recid,urut,id_galery,img_thumb,img_full)	values ('$Key','$Pno','$id_galery','$thumb_file','$full_file')")or die(mysql_error());
									$Pno++;
									}
									echo "<msg>Image galery for workshop $Nid has uploaded</msg>";
									echo '<meta http-equiv="refresh" content="1;'.$web_page.'">';
								}
							}else{
								echo "<msg>Image galery for workshop is empty</msg>";
							}
						}
				?>
				</td>
			</tr>
			</table>
	<?php }elseif($var_workshop=="edit_galery"){ 
		$wshp_master	= " from galery where recid='$Key' order by urut";
		$wshp_dtl_query = mysql_query("select count(recid) ".$wshp_master)or die(mysql_error());
		$wshp_dtl_result= mysql_fetch_array($wshp_dtl_query);
	?>
	<span style="margin-top:5px; font-size:16px;font-weight:bold;">
		Manage Galery <?php echo $Nid //." | have ".$wshp_dtl_result[0]." image"; ?> 
	</span>
	<span><a href="<?php echo $web_page; ?>" class="X_close">X</a></span>
	<hr width="97%" align="center" color="orange" style="float:left;">
	<form method="post" action="" enctype="multipart/form-data" >
		<div style="float:left;max-height:305px;overflow:auto;width:98%;">
		<?php 
			$wshp_query = mysql_query("select img_thumb,img_full,id_galery ".$wshp_master);
			$del = 1;
			while($wshp_galery = mysql_fetch_array($wshp_query)){
				$id_del1 = "id='del_gal".$del."'";
				$id_del2 = "for='del_gal".$del."'";
				//echo $id_del1.$id_del2;
				$image_thumb = $path.$wshp_galery[0];
				$image_full  = $path.$wshp_galery[1];
				if(file_exists($image_thumb)){
					echo "<div class='img_gal'><label $id_del2>
							<img src='$image_thumb'><br/>
							<input type='checkbox' name='delete_galery[".$wshp_galery[2]."]' $id_del1 >Delete</label>
						  </div>";
				}
				$del++;
			}
		?>
		</div>
		<input type="submit" name="upd_galery" value="Update Galery" class="button_u" style="margin-left:5px;margin-top:5px;">
	</form>
	<div style="float:left;	">
	<?php
		if(isset($_POST["upd_galery"])){
			if(isset($_POST['delete_galery'])){
				$delete = $_POST['delete_galery'];
				foreach ($delete as $id => $val) {
					if(isset($val)){
						$hapus_master = "from galery where id_galery='$id'";
						$hapus_galery = mysql_fetch_array(mysql_query("select img_thumb,img_full ".$hapus_master)) or die(mysql_error());
						if($hapus_galery){
							unlink($path.$hapus_galery[0]);
							unlink($path.$hapus_galery[1]);
							$hapus_data = mysql_query("delete ".$hapus_master) or die(mysql_error());
						}
					}
				}
			echo "<span class='notif' style='margin:10px;'>Data sudah di hapus</span>";
			echo '<meta http-equiv="refresh" content="0;'.$web_page.'&action=edit_gal">';
			}
		}
	?>
	</div>
	<?php } ?>
</div> 