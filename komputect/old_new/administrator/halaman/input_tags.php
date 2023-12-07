<html>
<body>
<head>
<style>
.ipro{
	width:300px;
	border:solid 1px #ccc;
	box-shadow:0 0 5px #ddd;
	border-radius:2px;
	font-family:courier;
}
#name-list input{
	margin:2px;
	padding:2px;
	padding-left:5px;
	font-family:courier;
}
#name-list select{
	margin:2px;
	padding:2px;
	padding-left:5px;
	width:160px;
	font-family:courier;
}
.ro{
	background-color:#ddd;
}
.box-del{
	width:450px;
	padding:5px;
	background-color:orange;
	position:relative;
	box-shadow:0 0 2px orange;
	border:solid 1px #888;
	overflow:auto;
}
.img_Tags_x{
	border:solid 1px blue;
	position:absolute;
	margin-left:320px;
	margin-top:-128px;
	height:150px;
}
.content{
	height:25px;
}
.list_style{
	float:left;
	margin-bottom:5px;
	margin-top:5px;
	font-size:16px;
	font-weight:bold;
}
</style>
</head>
<div>
<?php 
	echo '<div style="float:right;margin-top:-10px;">
			<a href="halaman.php?page=input_tags&action=add_tags" class="button_x" >Add Tags</a> 
		  </div>';
	?>
	<span class="list_style">
		List Tags 
	</span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7">Urut</div>
		<div class="x7">Recid</div>
		<div class="x10">Tags ID</div>
		<div class="x5x">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
	$tags_query = mysql_query("SELECT *FROM tags ORDER BY urut asc ");
		$no=1;
		while($tags_result = mysql_fetch_array($tags_query)){			
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='?page=input_tags&action=edit_tags&tags_id=$tags_result[1]'>Edit</a>";
			$url2 = "<a href='?page=input_tags&action=dele_tags&tags_id=$tags_result[1]'>Delete</a>";
			echo '
			<div class="content">
				<div id="name-list_x" class="x7 Bleft" '.$warna.'>'.$tags_result[3].'</div>
				<div id="name-list_x" class="x7" '.$warna.'>'.$tags_result[0].'</div>
				<div id="name-list_x" class="x10" '.$warna.'>'.$tags_result[1].'</div>
				<div id="name-list_x" class="x5x" '.$warna.'>'.$url.' | '.$url2.'</div>
			</div>';
		$no++;	
		}
	?>
	</div>

<?php
if(isset($_GET['action'])){
	if($_GET['action']=="add_tags"){
		?>
		<div class='action' style='border-color:green'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Add Tags 
			</span>
			<span><a href="halaman.php?page=input_tags" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td>Recid</td>
				<td>
					<?php
						$recid_tags = mysql_query("select distinct flag from tags") or die(mysql_error());
						if($recid_tags){
							echo "<select name='flag'>";
							while($recid_tags_x = mysql_fetch_array($recid_tags)){
								echo "<option value='$recid_tags_x[0]'>$recid_tags_x[0]</option>";
							}
							echo "</select>";
						}
					?>
				</td>
			</tr>
			<tr><td>Urut</td>
				<td>
					<?php $max_tags = mysql_fetch_array(mysql_query("select max(urut) from tags")) or die(mysql_error()); ?>
					<input type="text" name="urut" required="required" maxlength='50' readonly class="ipro ro tengah" value='<?php echo ($max_tags[0]+1); ?>' style="width:30px;"/>
				</td>
			</tr>
			<tr>
				<td>Content</td>
				<td><input type="text" name="C_tags" required="required" maxlength='50' class="ipro"/></td>
			</tr>
			<tr><td colspan="2"><input type="submit" name="save_tags" value="Simpan Data Tags" class='button_s'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["save_tags"])){
				if(empty($_POST["C_tags"])){
					$msg = "Maaf Data masih kosong";
				}else{
					$tags_cek = mysql_num_rows(mysql_query("select * from tags where tag1='$_POST[C_tags]'"));
					if($tags_cek==0){
						$tags_insert = mysql_query("insert into tags values('$_POST[flag]','$_POST[C_tags]',null,'$_POST[urut]')");
						if($tags_insert){
							$msg = "Data sudah di simpan";							
						}else{
							$msg = "Gagal simpan, coba lagi";							
						}
					}else{
						$msg = "Data sudah ada";
					}
				}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=input_tags">';										
			}
			?>
		</div>
		<?php
	}elseif($_GET['action']=="edit_tags"){
		?>
		<div class='action' style='border-color:blue'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Edit Tags 
			</span>
			<span><a href="halaman.php?page=input_tags" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<?php 
				$Etag_cek = mysql_fetch_row(mysql_query("select * from tags where tag1='$_GET[tags_id]'")); //or die (mysql_error());
			?>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td>Recid</td>
				<td>
					<?php
						$recid_tags = mysql_query("select distinct flag from tags") or die(mysql_error());
						if($recid_tags){
							echo "<select name='flag'>";
								echo "<option value='$Etag_cek[0]'>$Etag_cek[0]</option>";
							while($recid_tags_x = mysql_fetch_array($recid_tags)){
								echo "<option value='$recid_tags_x[0]'>$recid_tags_x[0]</option>";
							}
							echo "</select>";
						}
					?>
				</td>
			</tr>
			<tr><td>Urut</td>
				<td>
					<?php 
						$max_tags = mysql_fetch_array(mysql_query("select max(urut) from tags")) or die(mysql_error());
						echo "<select name='urut'>";
							echo "<option value='$max_tags[0]'>$max_tags[0]</option>";
							for($max_tag=1;$max_tag<=($max_tags[0]+1);$max_tag++){							
								echo "<option value='$max_tag'>$max_tag</option>";
							}
						echo "</select>";
					?>
				</td>
			</tr>
			<tr>
				<td>Content</td>
				<td><input type="text" name="C_tags" class="ipro" value="<?php echo $Etag_cek[1]; ?>"/></td>
			</tr>
			<tr><td colspan="2"><input type="submit" name="edit_tags" required="required" value="Update Data Tags"  class='button_u'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["edit_tags"])){
				if(empty($_POST["C_tags"])){
					$msg = "Maaf Data masih kosong";
				}else{
					$tags_cek = mysql_num_rows(mysql_query("select * from tags where tag1='$_GET[tags_id]'"));
					if($tags_cek==1){
						$tags_insert = mysql_query("update tags set flag='$_POST[flag]',tag1='$_POST[C_tags]',urut='$_POST[urut]' where tag1='$_GET[tags_id]'");
						if($tags_insert){
							$msg = "Data sudah di update";							
						}else{
							$msg = "Gagal update, coba lagi";							
						}
					}else{
						$msg = "Data sudah ada";
					}
				}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=input_tags">';										
			}
			?>
		</div>
		<?php
	}elseif($_GET['action']=="dele_tags"){
		?>
		<div class='action' style='border-color:blue'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Edit Tags 
			</span>
			<span><a href="halaman.php?page=input_tags" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<?php 
				$Etag_cek = mysql_fetch_row(mysql_query("select * from tags where tag1='$_GET[tags_id]'")); //or die (mysql_error());
			?>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td>Recid</td><td><input type="text" name="C_tags" class="ipro ro tengah"  readonly value="<?php echo $Etag_cek[0]; ?>" style="width:30px;"></td>
			</tr>
			<tr><td>Urut</td>
				<td>
					<input type="text" name="urut" required="required" maxlength='50' readonly class="ipro ro tengah" value='<?php echo $Etag_cek[3]; ?>' style="width:30px;"/>
				</td>
			</tr>
			<tr>
			<tr>
				<td>Content</td>
				<td><input type="text" name="C_tags" class="ipro ro"  readonly value="<?php echo $Etag_cek[1]; ?>"/></td>
			</tr>
			<tr><td colspan="2"><input type="submit" name="dele_tags" value="Delete Data Tags"  class='button_d'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["dele_tags"])){
				if(empty($_POST["C_tags"])){
					$msg = "Maaf Data masih kosong";
				}else{
					$tags_cek = mysql_num_rows(mysql_query("select * from tags where tag1='$_GET[tags_id]'"));
					if($tags_cek==1){
						$tags_insert = mysql_query("delete from  tags where tag1='$_GET[tags_id]'");
						if($tags_insert){
							$msg = "Data sudah di hapus";							
						}else{
							$msg = "Gagal hapus, coba lagi";							
						}
					}else{
						$msg = "Data sudah ada";
					}
				}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=input_tags">';										
			}
			?>
		</div>
		<?php
	}
} 
?>
</div>
</body>
</html>