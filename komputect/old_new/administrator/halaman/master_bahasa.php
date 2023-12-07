<style>
.content{
	height:230px;
	overflow:auto;	
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
	width:500px;	
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
</style>
<div>
<?php 
$MU_query = mysql_query("select id_id,id_en from master_web where grup_key='words' and ifnull(id_id,'0')!='0' AND id_id<>''")or die (mysql_error());
$MU_rows  = mysql_num_rows($MU_query);
//echo $MU_rows;
echo "<div  class='content'><table width='100%'>";
echo "<tr><td id='tdx'>No</td><td id='tdx'>Text Indo</td><td id='tdx'>Text Eng</td><td id='tdx'>Edit Data</td></tr></b>";
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
	for($n=0;$n<=1;$n++){
		echo "<td $warna>".$MU_result[$n]."</td>";
	}
	echo "<td $warna><a href='?page=M_language&url=Words&isi_id=$MU_result[id_id]&isi_en=$MU_result[id_en]'>Edit</a></td></tr>";
$x++;	
}
echo "</table></div>";
?>
</div>
<p/>
<div class='div_x'>
<?php
if(isset($_GET['url'])){
	echo "<form method='post'><table width='98%'>";
		echo "<tr><td width='20%'>Isi ID</td><td><textarea name='cnt_id'>$_GET[isi_id]</textarea></td></tr>";
		echo "<tr><td>Isi EN</td><td><textarea name='cnt_en'>$_GET[isi_en]</textarea></td></tr>";
		echo "<tr><td>Key</td><td><input class='Ds' type='text' readonly='readonly' value='$_GET[url]' name='url' maxlength='20'/></td></tr>";
		echo "<tr><td colspan='2'><input class='button_s' style='width:150px;' type='submit' name='simpan'value='simpan data'/></td></tr>";
		echo "</table></form>";
	//echo $_GET['url'].$_GET['isi_id'];
}
if(isset($_POST['simpan'])){
	echo "<div>";
	if(empty($_POST['cnt_id']) or empty($_POST['cnt_en'])){
		echo "isi Bahasa tidak boleh ada yang kosong";
	}else{
		$sn = "update master_web set id_id='$_POST[cnt_id]',id_en='$_POST[cnt_en]' where grup_key='words' and id_id='$_GET[isi_id]' and id_en='$_GET[isi_en]'";
		//echo $sn;
		$save_data = mysql_query($sn)or die (mysql_error());
		if($save_data){
			echo '<script language="javascript">';
			echo  'alert("Data berhasil di simpan");';
			echo 'window.location.href="halaman.php?page=M_language";';
			echo '</script>';		
		}else{
			echo "terjadi maslah pada saat save data silahkan ulangi";
		}
	}
	"</div>";
}
?>
</div>