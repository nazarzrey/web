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
.img_ym_x{
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
			<a href="halaman.php?page=messenger&action=add_ym" class="button_x" >Add ym</a> 
		  </div>';
								
	?>
	<span class="list_style">
		List yahoo messenger
	</span>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<br/>
	<div id="name-counter">
		<div class="x7a">No</div>
		<div class="x5">ID</div>
		<div class="x10">Yahoo mail</div>
		<div class="x5 tengah">Action</div>
	</div>
	<div id="name-list" style='height:200px;overflow:auto;'>
	<?php
	$ym_query = mysql_query("SELECT *FROM ym ");
		$no=1;
		while($ym_result = mysql_fetch_array($ym_query)){			
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='?page=messenger&action=edit_ym&ym_id=$ym_result[1]'>Edit</a>";
			$url2 = "<a href='?page=messenger&action=dele_ym&ym_id=$ym_result[1]'>Delete</a>";
			echo '
			<div class="content">
				<div id="name-list_x" class="x7a Bleft" '.$warna.'>'.$no.'</div>
				<div id="name-list_x" class="x5" '.$warna.'>'.$ym_result[0].'</div>
				<div id="name-list_x" class="x10" '.$warna.'>'.$ym_result[1].'</div>
				<div id="name-list_x" class="x5 tengah" '.$warna.'>'.$url.' | '.$url2.'</div>
			</div>';
		$no++;	
		}
	?>
	</div>
<?php
if(isset($_GET['action'])){
	if($_GET['action']=="add_ym"){
		?>
		<div class='action' style='border-color:blue'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Add ym 
			</span>
			<span><a href="halaman.php?page=messenger" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td width="17%">ID</td>
				<td>
                	<input type="text" name="id" required="required" maxlength='15' class="ipro"  style="width:150px;"/>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="id_ym" required="required" maxlength='50' class="ipro"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="font-style:italic;font-size:11px;">Ex : zrey_adhe@yahoo.com  / zrey_adhe</td>
			</tr>
			<tr><td></td><td><input type="submit" name="save_ym" value="Simpan Data ym" class='button_s'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["save_ym"])){
				if(empty($_POST["id_ym"]) || empty($_POST["id"])){
					$msg = "Maaf Data masih ada kosong";
				}else{
					$user_id_x	= $_POST["id_ym"];
					$pisah 		= explode("@", $user_id_x); // Split file name into an array using the dot
					$user_id 	= max($pisah); // Now target the last array element to get the file extension
					$ym_cek = mysql_num_rows(mysql_query("select * from ym where id_mail='$user_id'"));
					if($ym_cek==0){
						$ym_insert = mysql_query("insert into ym values('$_POST[id]','$user_id')");
						if($ym_insert){
							$msg = "Data sudah di simpan";							
						}else{
							$msg = "Gagal simpan, coba lagi";							
						}
					}else{
						$msg = "Data sudah ada";
					}
				}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=messenger">';										
			}
			?>
		</div>
		<?php
	}elseif($_GET['action']=="edit_ym"){
		?>
		<div class='action' style='border-color:green'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Edit ym 
			</span>
			<span><a href="halaman.php?page=messenger" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<?php 
				$sk="select * from ym where id_mail='$_GET[ym_id]'";
				$Eym_cek = mysql_fetch_row(mysql_query($sk)); //or die (mysql_error());
			?>
			<form method="post" action="" enctype="multipart/form-data" >			
			<table class="action_in" >
			<tr><td width="17%">ID</td>
				<td>
                	<input type="text" name="id" required="required" maxlength='15' class="ipro" value="<?php echo $Eym_cek[0];?>" style="width:150px;"/>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="id_ym" required="required" maxlength='50' value="<?php echo $Eym_cek[1];?>" class="ipro"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="font-style:italic;font-size:11px;">Ex : zrey_adhe@yahoo.com / zrey_adhe</td>
			</tr>
			<tr><td></td><td><input type="submit" name="upd_ym" value="Update Data ym" class='button_u'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["upd_ym"])){
				if(empty($_POST["id_ym"]) || empty($_POST["id"])){
					$msg = "Maaf Data masih ada kosong";
				}else{
					$user_id_x	= $_POST["id_ym"];
					$pisah 		= explode("@", $user_id_x); // Split file name into an array using the dot
					$user_id 	= max($pisah); // Now target the last array element to get the file extension
					$ym_cek = mysql_num_rows(mysql_query("select * from ym where id_mail='$user_id'"));
					if($ym_cek==0){				
						$ym_insert = mysql_query("update ym set id='$_POST[id]',id_mail='$user_id' where id_mail='$_GET[ym_id]'");
						if($ym_insert){
							$msg = "Data sudah di simpan";							
						}else{
							$msg = "Gagal simpan, coba lagi";							
						}
					}else{
						$msg = "Data sudah ada";
					}
				}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=messenger">';										
			}
			?>
		</div>
		<?php
	}elseif($_GET['action']=="dele_ym"){
		?>
		<div class='action' style='border-color:red'>
			<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
				Delete ym 
			</span>
			<span><a href="halaman.php?page=messenger" class="X_close">X</a></span>
			<hr width="97%" align="center" color="orange" style="float:left;">
			<br/>
			<?php 
				$Eym_cek = mysql_fetch_row(mysql_query("select * from ym where id_mail='$_GET[ym_id]'")); //or die (mysql_error());
			?>
			<form method="post" action="" enctype="multipart/form-data" >
			<table class="action_in" >
			<tr><td width="17%">ID</td><td><input type="text" name="id_ym" class="ipro ro"  readonly value="<?php echo $Eym_cek[0]; ?>" style="width:150px;"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="id_ym" class="ipro ro"  readonly value="<?php echo $Eym_cek[1]; ?>"/></td>
			</tr>
			<tr><td colspan="2"><input type="submit" name="dele_ym" value="Delete Data ym"  class='button_d'></td></tr>
			</table>
			</form>
			<?php
			if(isset($_POST["dele_ym"])){
					$ym_cek = mysql_num_rows(mysql_query("select * from ym where id_mail='$_GET[ym_id]'"));
					if($ym_cek==1){
						$ym_insert = mysql_query("delete from  ym where id_mail='$_GET[ym_id]'");
						if($ym_insert){
							$msg = "Data sudah di hapus";							
						}else{
							$msg = "Gagal hapus, coba lagi";							
						}
					}else{
						$msg = "Data tidak di temukan";
					}
				echo "<msg>$msg</msg>";	
				echo '<meta http-equiv="refresh" content="1;halaman.php?page=messenger">';										
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