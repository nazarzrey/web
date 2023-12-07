<style>
.div_x{
	border:solid 1px orange;
	width:60%;}
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
.div_x textarea{
	resize:none;
	width:100%;
	height:100px;
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
<div>
<?php 
$MU_sintak = "select recid,urut,id_id,id_en,desc_id,desc_en,id_master from master_web";
$MU_query  = mysql_query($MU_sintak." where grup1='menu_list' order by urut")or die (mysql_error());
$Mu_record = mysql_num_rows($MU_query);
//echo $MU_rows;
echo "<table width='100%'>";
echo "<tr><td id='tdx'>No</td><td id='tdx'>Aktif</td><td id='tdx'>Urut</td><td id='tdx'>Isi Indo</td><td id='tdx'>Isi Eng</td><td id='tdx'>Edit Data</td></tr></b>";
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
	echo "<tr><td $warna>$x</td>";
	for($n=0;$n<=3;$n++){
		echo "<td $warna>".$MU_result[$n]."</td>";
	}
	echo "<td $warna><a href='?page=M_bawah&id_menu=$MU_result[id_master]'>Edit</a></td></tr>";
$x++;	
}
echo "</table>";
?>
</div>
<p/>
<a href="?page=M_bawah&Tambah_menu=Tambah">Tambah Menu List</a>
<p/>
<div class='div_x'>
<?php
if(isset($_GET['id_menu'])){
	$Menu_query  = mysql_query($MU_sintak." where id_master='$_GET[id_menu]'") or die(mysql_error());
	$Menu_result = mysql_fetch_array($Menu_query);
	echo "<form method='post'><table width='100%'>";
		echo "<tr><td width='20%'>Urut</td>
				<td>
				<select name='urut'>					
					<option value='$Menu_result[urut]'>$Menu_result[urut]</option>";
					for($urut=1;$urut<=$Mu_record+1;$urut++){
						echo "<option value='$urut'>$urut</option>";
					}
		echo "	</select>
				</td>
			  </tr>";
		echo "<tr><td>Aktif</td><td>";
			if($Menu_result['recid']=="Y"){
				$aktif1 = "Y";
				$aktif2 = "N";
			}elseif($Menu_result['recid']=="N"){
				$aktif1 = "N";
				$aktif2 = "Y";
			}
			echo "<select name='aktif'>
					<option value='$aktif1'>$aktif1</option>
					<option value='$aktif2'>$aktif2</option>
				  </select>";
		echo "</td></tr>";
		echo "<tr><td>Isi ID</td><td><input type='text' value='$Menu_result[id_id]' name='cnt_id' maxlength='20'/></td></tr>";
		echo "<tr><td>Isi EN</td><td><input type='text' value='$Menu_result[id_en]' name='cnt_en' maxlength='20'/></td></tr>";
		echo "<tr><td>Key</td><td><input class='Ds' type='text' readonly='readonly' value='$Menu_result[id_master]' name='url' maxlength='20'/></td></tr>";
		echo "<tr><td>Deskripsi ID</td><td><textarea name='des_id'>$Menu_result[desc_id]</textarea></td></tr>";
		echo "<tr><td>Deskripsi EN</td><td><textarea name='des_en'>$Menu_result[desc_en]</textarea></td></tr>";
		echo "<tr><td colspan='2'>
				<input class='button_s'  style='width:150px;' type='submit' name='update' value='Update Data'/>				
   			    <a class='hapus' href='?page=M_bawah&Del1=$Menu_result[id_master]'>Delete Data</a>
			  </td></tr>";
		echo "</table></form>";
	//echo $_GET['url'].$_GET['isi_id'];
}
if(isset($_GET['Del1'])){
	$sintak = "delete from master_web where id_master='$_GET[Del1]'";
	if(mysql_query($sintak)){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di Hapus");';
			echo 'window.location.href="halaman.php?page=M_bawah";';
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
		$sn = "update master_web set urut='$_POST[urut]',recid='$_POST[aktif]',id_id='$_POST[cnt_id]',id_en='$_POST[cnt_en]' where id_master='$_GET[id_menu]'";
		//echo $sn;
		$save_data = mysql_query($sn)or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di update");';
			echo 'window.location.href="halaman.php?page=M_bawah";';
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
		$id_eng   =str_replace("/"," ",str_replace("&","dan",$_POST['cnt_en']));
		/*
		UPDATE master_web SET id_master = MD5(CONCAT(IFNULL(grup1,'X'),IFNULL(grup_key,'Y'),
IFNULL(urut,'Z'),IFNULL(recid,'A'),IFNULL(id_id,'B'),IFNULL(id_en,'C')))WHERE grup1 IS NOT null
*/
		$key_menu =md5('menu_list'.$_POST['urut'].$_POST['aktif'].$isi_id.$isi_eng.date("d-m-Y H:i:s"));
		$sn = "insert into  master_web (grup1,urut,recid,id_id,id_en,desc_id,desc_en,id_master) values('$_POST[url]','$_POST[urut]','$_POST[aktif]','$id_ind','$id_eng','$isi_ind','$isi_eng','$key_menu')";
		//echo $sn;
		$save_data = mysql_query($sn)or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di simpan");';
			echo 'window.location.href="halaman.php?page=M_bawah";';
			echo '</script>';		
		}else{
			echo "terjadi maslah pada saat save data silahkan ulangi";
		}
	}
}
?>
</div>