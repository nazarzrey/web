<style>
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
	width:200px;	
	border-radius:5px;
	cursor:pointer;
	padding:3px;
	border:solid 1px orange;
	font-family:courier;
}
.div_x input:focus{
	border:solid 1px blue;
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
</style>
<div>
<?php 
$MU_query = mysql_query("select recid,urut,id_id,id_en,url from master_web where grup1='menu-header' order by urut")or die (mysql_error());
$MU_rows  = mysql_num_rows($MU_query);
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
	echo "<td $warna><a href='?page=M_utama&url=$MU_result[url]&isi_id=$MU_result[id_id]&isi_en=$MU_result[id_en]&aktif=$MU_result[recid]&urut=$MU_result[urut]'>Edit</a></td></tr>";
$x++;	
}
echo "</table>";
?>
</div>
<p/>
<div class='div_x'>
<?php
if(isset($_GET['url'])){
	echo "<form method='post'><table width='50%'>";
		echo "<tr><td width='20%'>Urut</td>
				<td>
				<select name='urut'>					
					<option value='$_GET[urut]'>$_GET[urut]</option>";
					for($urut=1;$urut<=$MU_rows+1;$urut++){
						echo "<option value='$urut'>$urut</option>";
					}
		echo "	</select>
				</td>
			  </tr>";
		echo "<tr><td>Aktif</td><td>";
			if($_GET['aktif']=="Y"){
				$aktif1 = "Y";
				$aktif2 = "N";
			}elseif($_GET['aktif']=="N"){
				$aktif1 = "N";
				$aktif2 = "Y";
			}
			echo "<select name='aktif'>
					<option value='$aktif1'>$aktif1</option>
					<option value='$aktif2'>$aktif2</option>
				  </select>";
		echo "</td></tr>";
		echo "<tr><td>Isi ID</td><td><input type='text' value='$_GET[isi_id]' name='cnt_id' maxlength='20'/></td></tr>";
		echo "<tr><td>Isi EN</td><td><input type='text' value='$_GET[isi_en]' name='cnt_en' maxlength='20'/></td></tr>";
		echo "<tr><td>Key</td><td><input class='Ds' type='text' readonly='readonly' value='$_GET[url]' name='url' maxlength='20'/></td></tr>";
		echo "<tr><td colspan='2'><input type='submit' name='simpan' value='simpan data'/></td></tr>";
		echo "</table></form>";
	//echo $_GET['url'].$_GET['isi_id'];
}
if(isset($_POST['simpan'])){
	echo "<div float='left'>";
	if(empty($_POST['cnt_id']) or empty($_POST['cnt_en'])){
		echo "isi Bahasa tidak boleh ada yang kosong";
	}else{
		$save_data = mysql_query("update master_web set urut='$_POST[urut]',recid='$_POST[aktif]',id_id='$_POST[cnt_id]',id_en='$_POST[cnt_en]' where grup1='menu-header' and url='$_POST[url]'")or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di simpan");';
			echo 'window.location.href="halaman.php?page=M_utama";';
			echo '</script>';		
		}else{
			echo "terjadi maslah pada saat save data silahkan ulangi";
		}
	}
	"</div>";
}
?>
</div>