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
.img_gal img:hover{
	border-color:gold;
}
.galery_link{
	height:100px;
	background:orange;
	padding:10px;
	color:white;
	font-weight:bold;
	text-decoration:none;
	border:solid 1px orange;
	margin:0
}
.galery_link:hover{
	height:100px;
	padding:10px;
	color:black;
	font-weight:bold;
	text-decoration:none;
	border:solid 1px orange;
	margin:0
}
.galery_linkb{
	height:100px;
	padding:10px;
	color:black;
	font-weight:bold;
	text-decoration:none;
	border:solid 1px orange;
}
.galery_linkb:hover{
	height:100px;
	padding:10px;
	background:orange;
	color:black;
	font-weight:bold;
	text-decoration:none;
	border:solid 1px orange;
}
</style>
<div class='action' style='border-color:green;box-shadow:0 0 10px green;top:150px' id="close">
<?php 
	$data_dtl = $_GET["data_product"];
	$web_page2 = $web_page."&action=ins_gal&data_product=$data_dtl";
	$data_cntn  = mysql_fetch_array(mysql_query("select product_name,urut from product where product_id='$data_dtl'")) or die(mysql_error());
	if($_GET["action_page"]=="galery_insert"){
?>
	<span><a href="<?php echo $web_page; ?>" class="X_close">X</a></span>
	<a href="<?php echo $web_page2; ?>&action_page=galery_insert" class="galery_link" style="border-radius:10px 0 0 0">Add Galery</a>
	<a href="<?php echo $web_page2; ?>&action_page=galery_manage" class="galery_linkb" style="margin-left:-5px;border-radius:0 10px 0 0">Manage Galery</a> 
	<hr width="100%" align="center" color="orange" style="float:left;margin-top:3px;">	
		<table border='0' width='100%' class="action_in">
		  <form method="post" action="" enctype="multipart/form-data" >
			<?php
			$dtl_query  = mysql_query("select count(recid),max(urut) from product_detail where product_id='$data_dtl'")or die(mysql_error());
			$dtl_result = mysql_fetch_array($dtl_query);
			echo '<tr><td width="17%">Galery </td><td><input type="text" class="ipro ro" value="'.$Nid.'" readonly ></td></tr>';
			echo '<tr><td >product Name </td><td><input type="text" class="ipro ro" name="data_name" value="'.$data_cntn[0].'" readonly ></td></tr>';
			echo '<tr><td >Urut</td><td><input type="text" class="ipro ro" value="'.$data_cntn[1].'" readonly style="width:30px;text-align:center;"></td></tr>';
			echo '<tr><td>Image Galery</td><td>';
				echo '<input type="text" name="max_galery"  value="'.($dtl_result[1]+1).'"readonly style="display:none;">';
				echo '<input type="text" name="total_galery" class="ipro ro" value="'.$dtl_result[0].'"readonly style="width:30px;text-align:center;"> Image</td></tr>';
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
									$data_name = $_POST["data_name"];
									foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
										$date_time		= date("Y-m-d H:i:s");
										$str_DT			= date("Y-m-dHis");
										$str_arr2 		= array(',',"'",'"','@',';',':','+','*',"/","\\","?","&");
										$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
										$kaboom 		= explode(".", $file_name); // Split file name into an array using the dot
										$fileExt 		= end($kaboom); // Now target the last array element to get the file extension
										move_uploaded_file($tmp_name, $path.$file_name);
										$ren_file		= substr(md5($Nid.$_POST['data_name'].$Pno.$date_time.$file_name),0,10).$str_DT.".".$fileExt;
										$full_file 		= "full_gal_".str_replace($str_arr2,"",str_replace(" ","-",$Nid."_".$data_name."_".$ren_file));
										$thumb_file 	= "thumb_gal_".str_replace($str_arr2,"",str_replace(" ","-",$Nid."_".$data_name."_".$ren_file));
										$id_galery		= md5($Nid.$_POST['data_name'].$Pno.$full_file.$thumb_file.$date_time);
										ak_img_resize($path.$file_name, $path.$full_file, $wmax2, $hmax2, $fileExt);
										ak_img_resize($path.$file_name, $path.$thumb_file, $wmax4, $hmax4, $fileExt);
										unlink($path.$file_name);
										$insert_dtl = mysql_query("insert into product_detail(product_id,urut,recid,small_img,big_img,upd_data,id_galery)	values ('$data_dtl','$Pno','X','$thumb_file','$full_file',now(),'$id_galery')")or die(mysql_error());
									$Pno++;
									}
									echo "<msg>Image galery for $Nid $_POST[data_name] has uploaded</msg>";
									echo '<meta http-equiv="refresh" content="1;'.$web_page2.'&action_page=galery_manage">';
								}
							}else{
								echo "<msg>Image galery for $Nid is empty</msg>";
							}
						}
				?>
				</td>
			</tr>
			</table>
	<?php 
		}elseif($_GET["action_page"]=="galery_manage"){
		$master = " from product_detail where product_id='$data_dtl'";
		$dtl_query = mysql_query("select count(recid) ".$master)or die(mysql_error());
		$dtl_result= mysql_fetch_array($dtl_query);
	?>
	<span><a href="<?php echo $web_page; ?>" class="X_close">X</a></span>
	<a href="<?php echo $web_page2; ?>&action_page=galery_insert" class="galery_linkb"style="border-radius:10px 0 0 0">Add Galery</a>
	<a href="<?php echo $web_page2; ?>&action_page=galery_manage" class="galery_link" style="margin-left:-5px;border-radius:0 10px 0 0">Manage Galery</a> 
	<hr width="100%" align="center" color="orange" style="float:left;margin-top:3px;">
	<form method="post" action="" enctype="multipart/form-data" >
		<div style="max-height:305px;overflow:auto;" class="action_in">
		<?php 
			$query = mysql_query("select small_img,big_img,id_galery,urut ".$master." order by urut ");
			$del = 1;
			while($galery = mysql_fetch_array($query)){
				$id_urut  = $galery[3];
				$id_del1 = "id='del_gal".$del."'";
				$id_del2 = "for='del_gal".$del."'";
				//echo $id_del1.$id_del2;
				$image_thumb = $path.$galery[0];
				$image_full  = $path.$galery[1];
				if(file_exists($image_thumb)){
					echo "<div class='img_gal'><label $id_del2>
							<img src='$image_thumb'><br/>
							<input type='checkbox' name='delete_galery[".$galery[2]."]' $id_del1 >Delete</label>
						  </div>";
				}
				$del++;
			}
		?>
		</div>
		<div style=" width:100%; border:none; overflow:auto;">
		<input type="submit" name="upd_galery" value="Update Galery" class="button_u" style="margin-left:0px;margin-top:5px;">
		&nbsp;&nbsp;<?php echo $data_cntn[0]." - ".$data_cntn[1]?>
		</div>
	</form>
	<div style="float:left;	">
	<?php
		if(isset($_POST["upd_galery"])){
			if(isset($_POST['delete_galery'])){
				$delete = $_POST['delete_galery'];
				foreach ($delete as $id => $val) {
					if(isset($val)){
						$hapus_master = "from product_detail where id_galery='$id'";
						$hapus_galery = mysql_fetch_array(mysql_query("select small_img,big_img ".$hapus_master)) or die(mysql_error());
						if($hapus_galery){
							unlink($path.$hapus_galery[0]);
							unlink($path.$hapus_galery[1]);
							$hapus_data = mysql_query("delete ".$hapus_master) or die(mysql_error());
						}
					}
				}
			echo "<span class='notif' style='margin:10px;'>Data sudah di hapus</span>";
			echo '<meta http-equiv="refresh" content="0;'.$web_page2.'&action_page=galery_manage">';
			}
		}
	?>
	</div>
	<?php } ?>
</div> 

<script type="text/javascript">
var elem = $( '#close' )[0];     
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( elem ).hide();
    }
	window.location.href="<?php echo $web_page;?>";
});
</script>