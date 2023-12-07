<?php
	$web_page = "halaman.php?page=Agent";
?>
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
<div class='action' style='border-color:green;box-shadow:0 0 10px green;margin-top:-50px;'>
	<span style="margin-top:5px; font-size:16px;font-weight:bold;">
		Insert / update brosure Agent
	</span>
	<span><a href="<?php echo $web_page; ?>" class="X_close">X</a></span>
	<hr width="97%" align="center" color="orange" style="float:left;">
			<table border='0' width='100%' class="action_in">
		  <form method="post" action="" enctype="multipart/form-data" >
			<?php
			$bros_dtl_query  = mysql_query("SELECT agent_id,desc_id,brosure,agent_id FROM agent where urut<>'999' ORDER BY urut")or die(mysql_error());
			echo '<tr><td width="20%">Agent - brosur </td><td>';
				echo "<select name='agent'>";
					while($bros_dtl_result= mysql_fetch_array($bros_dtl_query)){
						$file_bros = $bros_dtl_result[2];
						if(strlen($file_bros)==0 || !file_exists($path."brosur/".$file_bros)){
							$brosure = " - Tidak ada";
						}else{							
							$brosure = " - ".$file_bros;
						}
						echo "<option value='".$bros_dtl_result[0]."'>".$bros_dtl_result[1].$brosure."</option>";
					}
				echo "</select>";
			echo '</td></tr>';
			?>
			<tr><td>File Pdf / zip</td><td>
					<input type="file" name="berkas2[]" class="ipro" required="required"  accept="application/pdf,application/zip,application/x-zip,application/x-zip-compressed,application/octet-stream">
				</td>
			</tr>
			<tr><td></td><td><i style='font-size:12px;'>Max upload file pdf / zip 10MB,</i></td></tr>
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
									foreach($_FILES['berkas2']['tmp_name'] as $key => $tmp_name) {
										$file_name 		= strtolower("{$_FILES['berkas2']['name'][$key]}");
										move_uploaded_file($tmp_name, $path."brosur/".$file_name);
										$sks = "update  agent set brosure='$file_name' where agent_id='$_POST[agent]'";
										//echo $sk;
										$update_agent_dtl = mysql_query($sks)or die(mysql_error());
									}
									echo "<msg>file $file_name 	hasbeen uploaded</msg>";
									echo '<meta http-equiv="refresh" content="1;'.$web_page.'">';
								}
							}else{
								echo "<msg>file is empty</msg>";
							}
						}
				?>
				</td>
			</tr>
			</table>
</div> 