<style>
.content{
	height:480px;
	overflow:auto;	
}
.div_x{
	border:solid 1px orange;
	width:100%;
	margin-bottom:15px;
}
.div_x td{
	text-align:left;
	font-family:courier;
	background:#DDF8FF;
	background: linear-gradient(#B5E9FF,#DDF8FF);
}
.div_x select{
	width:40px;	
	border-radius:5px;
	cursor:pointer;
	padding:3px;
	border:solid 1px orange;
	font-family:courier;
}
.div_x select:focus{
	border:solid 1px blue;
}
.div_x input{
	width:350px;	
	border-radius:5px;
	cursor:pointer;
	padding:3px;
	border:solid 1px orange;
	font-family:courier;
}
.div_x input:focus{
	border:solid 1px blue;
}
.text1{
	resize:none;
	width:100%;
	height:100px;
}
.text2{
	resize:none;
	width:100%;
	height:50px;	
}
div td{
	text-align:center;
	border:solid 1px #ccc;
	box-shadow:0 0 1px #ddd;
	padding:5px;
	font-family:verdana;
}
#tdx{
	font-weight:bold;
	font-size:13px;
	background:#ddd;
	border:solid 1px orange;
}
table{
	border:solid 1px orange;
	
}
td a{
	text-decoration:none;
	color:green;
	font-weight:bold;
}
td a:hover{
	color:blue;
}
.Ds{
	background:#999999;
}
.button_s{
	background:#999;
	background: linear-gradient(#999,#444);
	width:100px;
	font-size:16px;
	font-weight:bold;
	color:#fff;
}
.button_s:hover{
	color:#FFCCCC;
	background: linear-gradient(#444,#999);
}
.hapus{
	color:#fff;
	background: red;
	background: linear-gradient(red, #FF8D8F);
	padding:5.5px;
	border-radius:5px;
	border:solid 1px orange;
}
</style>
<a href="?page=M_berita&Tambah_menu=Tambah">Tambah Berita</a>
<p/>
<?php
$MU_sintak = "select aktif,utama,judul_id,judul_en,isi_berita_id,isi_berita_en,gambar_kecil,gambar_besar,id_berita from berita";
if(isset($_GET['key_berita'])){
echo "<div class='div_x'>";
	$Menu_query  = mysql_query($MU_sintak." where id_berita='$_GET[key_berita]'") or die(mysql_error());
	$Menu_result = mysql_fetch_array($Menu_query);
	echo "<form method='post'><table width='100%'>";
		echo "<tr><td colspan='2'>Aktif : ";
			if($Menu_result['aktif']=="Y"){
				$aktif1 = "Y";
				$aktif2 = "N";
			}elseif($Menu_result['aktif']=="N"){
				$aktif1 = "N";
				$aktif2 = "Y";
			}
			echo "<select name='aktif'>
					<option value='$aktif1'>$aktif1</option>
					<option value='$aktif2'>$aktif2</option>
				  </select>";
		echo " | Utama : ";
			if($Menu_result['utama']=="Y"){
				$utama1 = "Y";
				$utama2 = "N";
			}elseif($Menu_result['utama']=="N"){
				$utama1 = "N";
				$utama2 = "Y";
			}
			echo "<select name='utama'>
					<option value='$utama1'>$utama1</option>
					<option value='$utama2'>$utama2</option>
				  </select>";
		echo "</td></tr>";
		echo "<tr><td width='15%'>Isi ID</td><td><textarea  class='text2' rows='5' name='cnt_id'>$Menu_result[judul_id]</textarea></td></tr>";
		echo "<tr><td>Isi EN</td><td><textarea  class='text2' name='cnt_en'>$Menu_result[judul_en]</textarea></td></tr>";
		echo "<tr><td>Deskripsi ID</td><td><textarea class='text1' name='des_id'>$Menu_result[isi_berita_id]</textarea></td></tr>";
		echo "<tr><td>Deskripsi EN</td><td><textarea  class='text1' name='des_en'>$Menu_result[isi_berita_en]</textarea></td></tr>";
		echo "<tr><td colspan='2'>
				<input class='button_s'  style='width:150px;' type='submit' name='update' value='Update Data'/>				
   			    <a class='hapus' href='?page=M_berita&Del1=".$Menu_result['id_berita']."'>Delete Data</a>
			  </td></tr>";
		echo "</table></form>";
	//echo $_GET['url'].$_GET['isi_id'];
}
if(isset($_GET['Del1'])){
	$sintak = "delete from berita where key_berita='$_GET[Del1]'";
	if(mysql_query($sintak)){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di Hapus");';
			echo 'window.location.href="halaman.php?page=M_berita";';
			echo '</script>';	
	}else{
			echo 'Data tidak terhapus coba lagi';
	}
}
if(isset($_POST['update'])){
	echo "<div float='left'>";
	if(empty($_POST['cnt_id']) or empty($_POST['cnt_en'])){
		echo "isi Bahasa tidak boleh ada yang kosong";
	}else{
		$U_utama =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['utama'])));
		$U_aktif =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['aktif'])));
		$U_jdl_i =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['cnt_id'])));
		$U_jdl_e =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['cnt_en'])));
		$U_des_i =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['des_id'])));
		$U_des_e =str_replace("'"," ",str_replace("/"," ",str_replace("&","dan",$_POST['des_en'])));
		$sn = "update berita set utama='$U_utama',aktif='$U_aktif',judul_id='$U_jdl_i',judul_en='$U_jdl_e',isi_berita_id='$U_des_i',isi_berita_en='$U_des_e' where id_berita='$_GET[key_berita]'";
		//echo $sn;
		$save_data = mysql_query($sn)or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di update");';
			echo 'window.location.href="halaman.php?page=M_berita";';
			echo '</script>';		
		}else{
			echo "terjadi maslah pada saat save data silahkan ulangi";
		}
	}
}
if(isset($_GET['Tambah_menu'])){	
	echo "<form method='post'><table width='100%' style='border:solid 3px blue;'>";
		echo "<tr><td width='20%'>Urut</td>
				<td><input type='text' name='urut' style='width:33px;' class='Ds' readonly='readonly' value='".($Mu_record+1)."'/>
				</td>
			  </tr>";
		echo "<tr><td>Aktif</td><td>";
			echo "<select name='aktif'>
					<option value='Y'>Y</option>
					<option value='N'>N</option>
				  </select>";
		echo "</td></tr>";
		echo "<tr><td>Isi ID</td><td><input type='text' name='cnt_id' maxlength='20'/></td></tr>";
		echo "<tr><td>Isi EN</td><td><input type='text' name='cnt_en' maxlength='20'/></td></tr>";
		echo "<tr><td>Key</td><td><input class='Ds' type='text' readonly='readonly'  value='menu_list' name='url'/></td></tr>";
		echo "<tr><td>Deskripsi ID</td><td><textarea name='des_id'></textarea></td></tr>";
		echo "<tr><td>Deskripsi EN</td><td><textarea name='des_en'></textarea></td></tr>";
		echo "<tr><td colspan='2'>
			  <input class='button_s' style='width:150px;' type='submit' name='save' value='Simpan Data'/>
			  </td></tr>";
		echo "</table></form>";
}
if(isset($_POST['save'])){
	if(empty($_POST['cnt_id']) or empty($_POST['cnt_en']) or empty($_POST['des_id']) or empty($_POST['des_en'])){
		echo "Kolom input tidak boleh ada yang kosong";
	}else{
		$isi_ind  =str_replace("/"," ",str_replace("&","dan",$_POST['des_id']));
		$isi_eng  =str_replace("/"," ",str_replace("&","dan",$_POST['des_en']));
		$id_ind   =str_replace("/"," ",str_replace("&","dan",$_POST['cnt_id']));
		$judul_eng   =str_replace("/"," ",str_replace("&","dan",$_POST['cnt_en']));
		/*
		UPDATE berita SET key_berita = MD5(CONCAT(IFNULL(grup1,'X'),IFNULL(grup_key,'Y'),
IFNULL('Z'),IFNULL(aktif,'A'),IFNULL(judul_id,'B'),IFNULL(judul_en,'C')))WHERE grup1 IS NOT null
*/
		$key_menu =md5('menu_list'.$_POST['urut'].$_POST['aktif'].$isi_id.$isi_eng.date("d-m-Y H:i:s"));
		$sn = "insert into  berita (grup1,aktif,judul_id,judul_en,isi_berita_id,isi_berita_en,key_berita) values('$_POST[url]','$_POST[urut]','$_POST[aktif]','$id_ind','$judul_eng','$isi_ind','$isi_eng','$key_menu')";
		//echo $sn;
		$save_data = mysql_query($sn)or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di simpan");';
			echo 'window.location.href="halaman.php?page=M_berita";';
			echo '</script>';		
		}else{
			echo "terjadi maslah pada saat save data silahkan ulangi";
		}
	}
	echo "</div>";
}
?>
<div class='content'>
<?php 
$MU_query  = mysql_query($MU_sintak." order by tanggal desc, jam desc")or die (mysql_error());
//echo $MU_rows;
echo "<table width='100%'>";
echo "<tr>
	<td id='tdx'>Aktif</td>
	<td id='tdx'>Utama</td>
	<td id='tdx'>Judul ID</td>
	<td id='tdx'>Judul EN</td>
	<td id='tdx'>Isi ID</td>
	<td id='tdx'>Isi EN</td>
	<td id='tdx'>Small IMG</td>
	<td id='tdx'>Edit Data</td>
	</tr></b>";
$x=1;
while($MU_result = mysql_fetch_array($MU_query)){
	$angka =  $x;
	if( $angka%2 == 1 ){
		$warna = 'style="background-color:#B5E9FF"';
	}
	if( $angka%2 == 0 )
	{
		$warna = 'style="background-color: #DDF8FF"';
	}
	echo "<tr>";
	for($n=0;$n<=6;$n++){
		if($n!=6){
			echo "<td $warna>".substr($MU_result[$n],0,100)."</td>";
		}else{
			$Img = A_Img."/berita/".$MU_result[$n];
			if(!file_exists($Img)){
				$img = A_Imgx;
			}else{
				$img = $Img;
			}			
			echo "<td $warna><img src='".$img."' width='100' height='100'></td>";			
		}
	}
	echo "<td $warna><a href='?page=M_berita&key_berita=$MU_result[id_berita]'>Edit</a></td></tr>";
$x++;	
}
echo "</table>";
?>
</div>