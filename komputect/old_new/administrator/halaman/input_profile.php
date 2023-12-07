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
.img_profile_x{
	border:solid 1px blue;
	position:absolute;
	margin-left:320px;
	margin-top:-128px;
	height:150px;
}
.content{
	height:25px;
}
.action{
	height:200px;
	width:700px;
	position:absolute;
	border:solid 1px  #eef4f7;
	top:200px;
	padding-left:10px;
	line-height:30px;
	box-shadow:0 0 5px #888;
	border-radius:10px;
	overflow:auto;
	padding-bottom:5px;
	background: #eef4f7;
}
.action_in{
	height:auto;
	width:97%;
	border:solid 1px #ccc;
	box-shadow:0 0 5px #888;
	padding:5px;
	padding-top:20px;
	padding-bottom:20px;
	background-color:#FFFFCC;
	opacity:0.8;
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
	<span class="list_style">
		List profile 
	</span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7">No</div>
		<div class="x5 tengah">Id</div>
		<div class="x10a">Content</div>
		<div class="x5 tengah">Action</div>
	</div>
	<div id="name-list" style='height:250px;overflow:auto;'>
	<?php
	$profile_query = mysql_query("SELECT urut,recid,id,content FROM profile");
		$no=1;
		while($profile_result = mysql_fetch_array($profile_query)){			
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='halaman.php?page=profile_update&action=edit_profile&profile_id=$profile_result[2]&rec_id=$profile_result[1]' >Edit</a>";
			echo '
			<div class="content">
				<div id="name-list_x" class="x7 Bleft" '.$warna.'>'.$no.'</div>
				<div id="name-list_x" class="x5" '.$warna.'>'.$profile_result[2].'</div>
				<div id="name-list_x" class="x10a" '.$warna.'>'.$profile_result[3].'</div>
				<div id="name-list_x" class="x5 tengah" '.$warna.'>'.$url.'</div>
			</div>';
		$no++;	
		}
	?>
	</div>

<?php
if(isset($_GET['action'])){
	if($_GET['profile_id']){
		?>
		<div class='action'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Edit profile 
			</span>
			<span><a href="halaman.php?page=profile_update" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<?php 				
				$RT ="select id,content from profile where id='$_GET[profile_id]'";
				$Etag_cek = mysql_fetch_row(mysql_query($RT)) or die (mysql_error());
			?>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td width="10%">ID</td>
				<td><input type="text" name="id" required="required" class="ipro ro" readonly value="<?php echo $Etag_cek[0]; ?>"/></td>
			</tr>
			<tr>
				<td>Content</td>
				<td><input type="text" name="content" required="required" class="ipro" value="<?php echo $Etag_cek[1]; ?>" style="width:100%;"/></td>
			</tr>
			<tr><td colspan="2">
				<input type="submit" name="edit_profile"  value="Update Data"  class='button_u'>
				<input type="submit" name="reset"  value="Reset"  class='button_c' style="margin-left:20px;">
			</td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["edit_profile"])){
				if(empty($_POST["content"])){
					$msg = "Maaf Data masih kosong";
				}else{
					$profile_insert = mysql_query("update profile set content='$_POST[content]' where id='$_POST[id]' and recid='$_GET[rec_id]'");
					if($profile_insert){
						$msg = "Data sudah di update";							
					}else{
						$msg = "Gagal update, coba lagi";							
					}
				}
				echo '<script>alert("'.$msg.'")</script>';	
				echo '<meta http-equiv="refresh" content="0;halaman.php?page=profile_update">';										
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