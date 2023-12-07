<html>
<body>
<head>
<style>
.ipro{
	width:250px;
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
</style>
</head>
<div>
<?php 
	echo '<div style="float:right;margin-top:-10px;">
			<a href="halaman.php?page=kontak_update&action=add_kontak" class="button_x" >Tambah Kontak</a> 
		  </div>';
	?>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List kontak </span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7a">Urut</div>
		<div class="x3">Nama *</div>
		<div class="x2">Phone</div>
		<div class="x2">Email1</div>
		<div class="x2">Email2</div>
		<div class="x5 tengah">Action</div>
	</div>
	<div id="name-list" style='height:205px;overflow:auto;'>
	<?php
	$kontak_query = mysql_query("SELECT urut,contact_name,contact_phone,contact_email,contact_email2 FROM contact ORDER BY urut");
		$no=1;
		while($kontak_result = mysql_fetch_array($kontak_query)){
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$priority = $kontak_result[0];
			if($priority=="1"){
				$W_priority = 'style="color:green;text-decoration:none;font-size:10x;font-weight:bold;"';
			}else{
				$W_priority = '';
			}
			$url  = "<a href='?page=kontak_update&action=edit_kontak&kontak_id=$kontak_result[1]'>Edit</a>";
			$url2 = "<a href='?page=kontak_update&action=dele_kontak&kontak_id=$kontak_result[1]'>Delete</a>";
			echo '
			<div class="content">
				<div id="name-list_x" class="x7a Bleft" '.$warna.' >'.$kontak_result[0].'</div>
				<div id="name-list_x" class="x3" '.$warna.'><a '.$W_priority.'>'.$kontak_result[1].'</a></div>
				<div id="name-list_x" class="x2" '.$warna.'>'.$kontak_result[2].'</div>
				<div id="name-list_x" class="x2" '.$warna.'>'.$kontak_result[3].'</div>
				<div id="name-list_x" class="x2" '.$warna.'>'.$kontak_result[4].'</div>
				<div id="name-list_x" class="x5 tengah" '.$warna.'>'.$url.' | '.$url2.'</div>
			</div>';
		$no++;	
		}
	?>
	</div>
    <br/>
    <i class="notif">* Nama kontak di bold warna hijau, adalah selalu tertera pada kontak utama (no urut ke 1)</i>
	<?php
if(isset($_GET['action'])){
	if($_GET['action']=="add_kontak"){
	?>
	<div class='action' style='border-color:green'>
		<span style="margin-top:5px; font-size:16px;font-weight:bold;">
			Add Kontak 
		</span>
			<span><a href="halaman.php?page=kontak_update" class="X_close">X</a></span>
		<hr width="97%" align="center" color="orange" style="float:left;">
		<form method="post" action="" enctype="multipart/form-data" >
		<table class="action_in" >
		<tr><td width="20%">Urut</td>
			<td>
				<?php
					$max_kontak = mysql_fetch_array(mysql_query("select max(urut) as maximal from contact")) or die(mysql_error());
					if($max_kontak){
						echo "<select name='urut' class='ro'>";
						/*for($x_k=1;$x_k<=$max_kontak[0];$x_k++){
							echo "<option value='$x_k'>$x_k</option>";
						}*/
						$x_x =($max_kontak[0]+1);
						echo "<option value='$x_x'>$x_x</option>";
						echo "</select>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="name" required="required" maxlength='20' class="ipro" /></td>
		</tr>
		<tr>
			<td>Telp</td>
			<td><input type="text" name="telp" required="required" maxlength='20' class="ipro"/></td>
		</tr>
		<tr>
			<td>Telp2</td>
			<td><input type="text" name="telp2" required="required" maxlength='20' class="ipro"/></td>
		</tr>
		<tr>
			<td>Pin BBM</td>
			<td><input type="text" name="bbm" required="required" maxlength='20' class="ipro"/></td>
		</tr>
		<tr>
			<td>Email1</td>
			<td><input type="text" name="email" required="required" maxlength='60' class="ipro"/></td>
		</tr>
		<tr>
			<td>Email2</td>
			<td><input type="text" name="email2" required="required" maxlength='60' class="ipro"/></td>
		</tr>
		<tr><td colspan="2"><input type="submit" name="save_kontak" value="Simpan Data kontak" class='button_u'></td></tr>
		</table>
		</form>
		<?php
		if(isset($_POST["save_kontak"])){
			if(empty($_POST["name"]) || empty($_POST["telp"]) || empty($_POST["email"]) || empty($_POST["email2"])){
				$msg = "Maaf Data masih kosong";
			}else{
				$kontak_cek = mysql_num_rows(mysql_query("select * from contact where contact_name='$_POST[name]'"));
				if($kontak_cek==0){
					$kontak_insert = mysql_query("insert into contact (urut,contact_name,contact_phone,contact_email,contact_email2,contact_phone2,contact_pinbb) 
					values ('$_POST[urut]','$_POST[name]','$_POST[telp]','$_POST[email]','$_POST[email2]','$_POST[telp2]','$_POST[bbm]')");
					if($kontak_insert){
						$msg = "Data sudah di simpan";							
					}else{
						$msg = "Gagal simpan, coba lagi";							
					}
				}else{
					$msg = "Data sudah ada";
				}
			}
			echo "<msg>$msg</msg>";	
			echo '<meta http-equiv="refresh" content="1;halaman.php?page=kontak_update">';										
		}
		?>
	</div>
	<?php
	}elseif($_GET['action']=="dele_kontak"){
	?>
        <div class='action' style='border-color:red'>
            <span style="margin-top:5px; font-size:16px;font-weight:bold;">
                Hapus Kontak 
            </span>
			<span><a href="halaman.php?page=kontak_update" class="X_close">X</a></span>
            <hr width="97%" align="center" color="orange" style="float:left;">
            <?php 
                $edit_query = mysql_fetch_array(mysql_query("SELECT urut,contact_name,contact_phone,contact_email,contact_email2,contact_phone2,contact_pinbb FROM contact where contact_name='$_GET[kontak_id]'")) or die(mysql_error());
            ?>
            <form method="post" action="" enctype="multipart/form-data" >
            <table class="action_in" >
            <tr><td width="20%">Urut</td>
                <td>
                    <?php
                        $max_kontak = mysql_fetch_array(mysql_query("select max(urut) as maximal from contact")) or die(mysql_error());
                        if($max_kontak){
                            echo "<select name='urut'>";
                            echo "<option value='$edit_query[0]'>$edit_query[0]</option>";
                            for($x_k=1;$x_k<=$max_kontak[0];$x_k++){
                                echo "<option value='$x_k'>$x_k</option>";
                            }
                            $x_x =($max_kontak[0]+1);
                            echo "<option value='$x_x'>$x_x</option>";
                            echo "</select>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="name" required="required" maxlength='20' class="ipro" value="<?php echo $edit_query[1]; ?>" /></td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="dele_kontak" value="Delete Data kontak" class='button_d'></td></tr>
            </table>
            </form>
            <?php
            if(isset($_POST["dele_kontak"])){
                    $XX = "delete from  contact where contact_name='$_GET[kontak_id]'";
                    $kontak_dele = mysql_query($XX);
                    if($kontak_dele){
						echo '<script>alert("data '.$_GET['kontak_id'].' sudah di hapus")</script>';
						echo '<meta http-equiv="refresh" content="1;halaman.php?page=kontak_update">';							
                    }else{
						echo '<script>alert("gagal hapus '.$_GET['kontak_id'].'")</script>';
						//echo '<meta http-equiv="refresh" content="1;halaman.php?page=kontak_update&action=dele_kontak&kontak_id=$_GET[kontak_id]">';							
                    }										
            }
            ?>
        </div>
	<?php
	}elseif($_GET['action']=='edit_kontak'){
	?>
	<div class='action' style='border-color:blue'>
		<span style="margin-top:5px; font-size:16px;font-weight:bold;">
			Edit Kontak 
		</span>
			<span><a href="halaman.php?page=kontak_update" class="X_close">X</a></span>
		<hr width="97%" align="center" color="orange" style="float:left;">
        <?php 
			$edit_query = mysql_fetch_array(mysql_query("SELECT urut,contact_name,contact_phone,contact_email,contact_email2,contact_phone2,contact_pinbb FROM contact where contact_name='$_GET[kontak_id]'")) or die(mysql_error());
		?>
		<form method="post" action="" enctype="multipart/form-data" >
		<table class="action_in" >
		<tr><td width="20%">Urut</td>
			<td>
				<?php
					$max_kontak = mysql_fetch_array(mysql_query("select max(urut) as maximal from contact")) or die(mysql_error());
					if($max_kontak){
						echo "<select name='urut'>";
						echo "<option value='$edit_query[0]'>$edit_query[0]</option>";
						for($x_k=1;$x_k<=$max_kontak[0];$x_k++){
							echo "<option value='$x_k'>$x_k</option>";
						}
						$x_x =($max_kontak[0]+1);
						echo "<option value='$x_x'>$x_x</option>";
						echo "</select>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="name" required="required" maxlength='20' class="ipro" value="<?php echo $edit_query[1]; ?>" /></td>
		</tr>
		<tr>
			<td>Telp</td>
			<td><input type="text" name="telp" required="required" maxlength='20' class="ipro"  value="<?php echo $edit_query[2]; ?>"/></td>
		</tr>
		<tr>
			<td>Telp2</td>
			<td><input type="text" name="telp2" required="required" maxlength='20' class="ipro"   value="<?php echo $edit_query[5]; ?>"/></td>
		</tr>
		<tr>
			<td>Pin BBM</td>
			<td><input type="text" name="bbm" required="required" maxlength='20' class="ipro"   value="<?php echo $edit_query[6]; ?>"/></td>
		</tr>
		<tr>
			<td>Email1</td>
			<td><input type="text" name="email" required="required" maxlength='60' class="ipro"  value="<?php echo $edit_query[3]; ?>"/></td>
		</tr>
		<tr>
			<td>Email2</td>
			<td><input type="text" name="email2" required="required" maxlength='60' class="ipro"  value="<?php echo $edit_query[4]; ?>"/></td>
		</tr>
		<tr><td colspan="2"><input type="submit" name="upd_kontak" value="Update Data kontak" class='button_s'></td></tr>
		</table>
		</form>
		<?php
		if(isset($_POST["upd_kontak"])){
			if(empty($_POST["name"]) || empty($_POST["telp"]) || empty($_POST["email"]) || empty($_POST["email2"])){
				$msg = "Maaf Data masih kosong";
			}else{
				$XX = "update contact set urut='$_POST[urut]',
						contact_name='$_POST[name]',
						contact_phone='$_POST[telp]',
						contact_email='$_POST[email]',
						contact_email2='$_POST[email2]',
						contact_phone2='$_POST[telp2]',
						contact_pinbb='$_POST[bbm]'
						where contact_name='$_GET[kontak_id]'
						";
				$kontak_insert = mysql_query($XX);
				if($kontak_insert){
					$msg = "Data sudah di simpan";							
				}else{
					$msg = "Gagal simpan, coba lagi";							
				}
			}
			echo "<msg>$msg</msg>";	
			echo '<meta http-equiv="refresh" content="1;halaman.php?page=kontak_update">';										
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