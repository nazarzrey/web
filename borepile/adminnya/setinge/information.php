<style>
.new_info_left{
	height:450px;
	text-align:justify;	
	overflow:hidden;
	width:70%;
	float:left;
	border:solid 1px #ddd;
    position: relative;
}
.new_info_right{
	height:500px;
	text-align:justify;	
	overflow:hidden;
	width:29%;
	float:right;
	border:solid 1px #ddd;
    position: relative;
}
.info_list{
	line-height:15px;
	float:left;
	height:auto;
	border-bottom:solid 1px #ddd;
	border-left:solid 1px #ddd;
	padding:11px;
}
.info_list_read{
	line-height:15px;
	float:left;
	height:auto;
	border-bottom:solid 1px #ddd;
	padding:11px;
	background:#f7f7f7;
}
.info_list:hover{
	background:#f7fcc5;
}
.info_list_read:hover{	
	background:#eafdef;
}
.info_list2{
	line-height:15px;
	float:left;
	width:97%;
	height:auto;
	border-bottom:solid 1px #ddd;
	padding:5px;
}
.info_list2:hover{
	background:#eafdef;
}
.add_info{
	position:absolute;
	background:linear-gradient(#f1f1f1,#fff);
	border:solid 1px green;
	padding:2px;
	z-index:9999;
	width:50px;
	border-radius:10px 0 10px 10px;
	box-shadow:0 0 2px green;
	margin:auto;
	right:0px;
	width:80px;
}
.add_info:hover{
	background:linear-gradient(#ddd,#fff);
	border:solid 1px blue;
	color:blue;
	box-shadow:0 0 2px blue;
}
.inf_box{
	position:absolute;
	background:linear-gradient(#f1f1f1,#fff);
	border:solid 1px #ccc;
	padding:5px;
	text-align:center;
	z-index:1;
	width:50px;
	border-radius:0 10px 10px 10px;
	box-shadow:0 0 2px #ccc;
	left:0;
}
.berita_dtl{
	color:<?php echo $tpl_warna2; ?>;
}
.berita_dtl2{
	color:<?php echo $tpl_warna2; ?>;
}
.judul_inf{
	font-size:12px;
	font-weight:bold;
}
.from{
	font-size:10px;
	color:#888;
	line-height:20px;
}

.ui-autocomplete.ui-widget {
  font-family: Verdana,Arial,sans-serif;
  font-size: 12px;
  max-height:400px;
  overflow:hidden;
}
.dialog2{border:solid 1px #c4e9fb;}
.dialog2_bot{
	text-align:justify;	
	color:#000;
	line-height:18px;
}
.dialog2_closed2{
	margin-top:10px;
	margin-bottom:-10px;
}
.dialog2{
	width:80%;
	top:50px;
	height:495px;
}
.dialog2_bot{
	height:435px;
	overflow:auto;	
}
.dialog2_bot textarea{
	border:none;
	width:99%;
	height:99%;
	background:#f1f1f1;
}
</style>
<?php 
require_once ("seting/config_web.php");
if(!isset($_GET["add_info"])){
?>
<div class="new_info_left">
<a href="?page=informasi&add_info" class="add_info"><img src="gambar/Add-icon.png"><span style="position:absolute;top:5px;right:5px;">Add Info</span></a>
	<span class="inf_box">Inbox</span>
	<div style="overflow:auto;height:450px;width:104.5%;margin-top:25px;">
	<?php 
	$inf_query  = mysql_query("select * from info where untuk='$Id_user' order by tanggal desc")or die (mysql_error());
	while ($inf_result = mysql_fetch_row($inf_query)){
			if($inf_result[4]!="N"){
				$add_style = "style='color:#888;'";
				$add_style2 = "style='color:#888;'";
				$info_backgr = "info_list_read";
			}else{
				$add_style = "";
				$add_style2 = "";
				$info_backgr = "";
			}
			echo "
			<div class='info_list $info_backgr' style='width:46%;height:120px;;'>
				<a href='?page=informasi&dtl_info=$inf_result[0]' class='berita_dtl'>
					<span class='judul_inf' $add_style>".$inf_result[6]."</span><br/>
				</a>";
			$pengirim = mysql_fetch_row(mysql_query("select nama from master_user where id_user='$inf_result[2]'"))or die(mysql_error());
			if(strlen($pengirim[0])>0){
				$Pengirim = $pengirim[0];
			}else{
				$Pengirim = "tidak di ketahui";
			}
			echo "<i class='from'>Dari $Pengirim $inf_result[8], $inf_result[1]</i><p/>
				<span $add_style2>";
				paragrap($inf_result[7],26);
				echo "</span><a href='?page=informasi&dtl_info=$inf_result[0]' class='berita_dtl'> more....</a>";
			echo "
			</div>";
		}
	?>
	</div>
</div>
<div class="new_info_right">
	<span class="inf_box">Outbox</span>
	<div style="overflow:auto;height:500px;width:105%;margin-top:25px;">
		<?php 
		$inf_query  = mysql_query("SELECT *  FROM info  WHERE dari='$Id_user'  GROUP BY isi ORDER BY tanggal DESC")or die (mysql_error());
		while($inf_result2 = mysql_fetch_array($inf_query)){
				$send_to = $inf_result2["send_to"];
				if(strlen($send_to)>10){
					$send_to = substr($send_to,0,5);
				}else{
					$send_to = $send_to;
				}
				echo "
				<a href='?page=informasi&dtl_info2=$inf_result2[0]' class='berita_dtl2'>
					<div class='info_list2'>
							<span class='judul_inf'>".$inf_result2[6]."</span><br/>";
				echo "<i class='from'>Untuk $send_to, $inf_result2[1]</i>
					</div>
				</a>";		
			}
		?>
	</div>
</div>
<span class="notif_2">klik more... atau judul untuk membuka info, dan notif INFO akan hilang jika info sudah terbuka semua</span>
<?php
if(isset($_GET["dtl_info"])){
	$inf_query  = mysql_query("SELECT c.*,a.nama FROM info c,MASTER_USER a WHERE c.dari=a.id_user AND c.id_info='$_GET[dtl_info]'") or die (mysql_error());
	$inf_rows = mysql_num_rows($inf_query);
	if($inf_rows>0){
		$inf_resutl = mysql_fetch_array($inf_query);
		mysql_query("update info set recid='Y',upd_data='".date("Y-m-d")." ".date("H:i:s")."' where id_info='$inf_resutl[0]'") or die("error update info.. ".mysql_error());
		$notif      = "dari  ".$inf_resutl['nama']." - ".$inf_resutl['kode_dc'].", ".$inf_resutl['judul'];
		$Url_direct = "?page=informasi";
		$Url_direct2 = "?page=informasi&dtl_info=".$_GET["dtl_info"];
		$msg        = $inf_resutl['isi'];
		require_once "halaman/dialog3.php";
	}
}elseif(isset($_GET["dtl_info2"])){
	$inf_query  = mysql_query("SELECT c.*,a.nama FROM info c,MASTER_USER a WHERE c.dari=a.id_user AND c.id_info='$_GET[dtl_info2]'") or die (mysql_error());
	$inf_rows = mysql_num_rows($inf_query);
	if($inf_rows>0){
		$inf_resutl = mysql_fetch_array($inf_query);
		$notif      = $inf_resutl['judul'].", Untuk ".$inf_resutl['send_to'];
		$Url_direct = "?page=informasi";
		$Url_direct2 = "?page=informasi&dtl_info2=".$_GET["dtl_info2"];
		$msg        = $inf_resutl['isi'];
		require_once "halaman/dialog3.php";
	}
}
?>
</div>
<?php 
}else{
	?>
<script type="text/javascript" src="skrip/jquery-ui.autocomplete.js"></script>
<script>
$(function() {
	var availableTags = [
	<?php
	if($Ms_grup!="DC"){
		echo '"Support DC",';
	}else{
		echo '"LOGHO","IT",';
	}
	if($Ms_grup!="DC"){
		$inf_grup = "select distinct(group_user) from master_user ";
	}else{		
		$inf_grup = "select distinct(group_user) from master_user where kode_dc='$Ms_dc'";
	}
	$sintak = $inf_grup;
		$query  = mysql_query($sintak) or die ("Error : ".mysql_error());
		while($hasil = mysql_fetch_row($query)){				
			echo '"'.strtoupper($hasil[0]).'",';
		}	
		
	if($Ms_grup=="IT"){
		$inf_grup2 = "SELECT kode_dc,nama_dc FROM master_dc  GROUP BY kode_dc";
	}elseif($Ms_grup=="LOGHO"){
		$inf_grup2 = "SELECT kode_dc,nama_dc FROM master_dc  GROUP BY kode_dc";
	}elseif($Ms_grup=="DC"){
		$inf_grup2 = "select kode_dc,nama from master_user where kode_dc='$Ms_dc'";
	}
	$sintak1 = $inf_grup2;
		//echo $sintak;
		$query1  = mysql_query($sintak1) or die ("Error : ".mysql_error());
		while($hasil1 = mysql_fetch_row($query1)){
			if($Ms_grup=="DC"){
				echo '"'.strtoupper($hasil1[1]).'",';
			}else{
				echo '"'.strtoupper($hasil1[0])." - ".strtoupper($hasil1[1]).'",';
			}
		}
		echo '""';
	?>
	];
	$( "#send_info" ).autocomplete({
		minLength:0,
		source: availableTags
	});
});
</script>	
<div>
	<form method='post' action=''>
		<table border='0' width="100%">
			<tr>
			 <td width="15%">
				Untuk *
			 </td>
			 <td>	
				<input type="text" required size="50" name="send_to"  id="send_info" placeholder="Grup user / Usernya ... ex Support DC" />	
			 </td>
			</tr>
			<tr>
			  <td>
			  Judul
			  </td>
			  <td>			 
				<input type="text" required size="50" name="judul" maxlength='50' id="send_info" placeholder="Judul info / berita" style='width:79.2%;' />
			  </td>
			</tr>
			<tr>
			  <td>
			  Isi
			  </td>
			  <td>
			  <textarea name='isi' maxlength='5000' style='width:80%;height:300px;resize:none;' required></textarea>
			  </td>
			</tr>
			<tr>
			<td></td>
			<td>
			  <input type='submit' value='Kirim' name='save' class="submit2">
			  <?php if($Ms_grup!="DC"){echo '<span class="notif_2">* Pemilihan pengirim, (DC = ALL USER DC), (Support DC = hanya ALL Support DC dan dc user tidak terima infonya)</span>'; } ?>
			</td>
			</tr>
		</table>
	</form>
</div>

<?php
}
if(isset($_POST['save'])){
	$untuk 		 	 = trim(htmlentities(mysql_real_escape_string($_POST["send_to"])));
	if($Ms_grup=="DC" and $untuk=="Support DC"){
		echo "<script>alert('Anda tidak berhak memilih grup tersebut...')</script>";
	}else{
		if($untuk!="DC" and $untuk!="IT" and $untuk!="LOGHO" and $untuk!="Support DC"){
			$cek_nama_send = mysql_query("select upper(nama) from master_user where nama='".strtoupper($untuk)."'");
			if(mysql_num_rows($cek_nama_send)==0){
				$cek_dc_send = mysql_query("select distinct(upper(kode_dc)) from master_user where kode_dc='".substr(strtoupper($untuk),0,4)."'");
				if(mysql_num_rows($cek_dc_send)==0){
					echo "<script>alert('Nama tujuan tidak di temukan...')</script>";
					return false;					
				}else{			
					$untuk = substr(strtoupper($untuk),0,4);
					$sdc   = "YES";
				}
			}else{
				$untuk = $untuk;
				$sdc   = "NO";
			}
		}else{
			$untuk = $untuk;
			$sdc   = "NO";
		}
		$jam   			 = date('H:i:s');
		$tgl   			 = date('Y-m-d');
		$dari  			 = $Id_user;
		$cek_send  		 = mysql_query("select distinct(group_user) as grup from master_user union ALL select distinct(kode_dc) as grup from master_user where  kode_dc<>'HO'") or die(mysql_error());
		while($rslt_send = mysql_fetch_array($cek_send)){
			if($rslt_send[0]==$untuk){
				$send_grup = "Y";
			}
		}
		if($untuk=="Support DC"){
			$send_grup="Y";
		}
		if(isset($send_grup)){
			$send_grup="Y";
		}else{
			$send_grup="N";
		}
		$jdl = trim(htmlentities(mysql_real_escape_string($_POST['judul'])));
		$isi = trim(htmlentities(mysql_real_escape_string($_POST['isi'])));
		$id_info  = md5($jam.$tgl.$untuk.$dari);
	//	echo $send_grup;
	//	break;
		if($send_grup=='Y'){
			if($sdc=="YES"){
				$sintak = mysql_query("select id_user from master_user where kode_dc='".$untuk."'");
			}else{
				if($untuk=="Support DC"){
					$sintak = mysql_query("select id_user from master_user where group_user='DC' and type_user='support'") or die(mysql_error());
				}elseif($untuk=="DC" and $Ms_grup=="DC"){
					$sintak = mysql_query("select id_user from master_user where kode_dc='".$Ms_dc."'") or die(mysql_error());
				}elseif($untuk=="DC" and $Ms_grup!="DC"){
					$sintak = mysql_query("select id_user from master_user where group_user='".$untuk."'") or die(mysql_error());
				}else{			
					$sintak = mysql_query("select id_user from master_user where group_user='".$untuk."'") or die(mysql_error());
				}
			}
		//echo $untuk." ".$send_grup." ".$sdc." ".$sintak;
			$adelia_abizar = 1;
			while ($insert = mysql_fetch_array($sintak)){
				$untuk2     = $insert[0];
				$id_info2  = md5($id_info.$adelia_abizar);
				$AD_AB = "insert into info values ('$id_info2','".$tgl." ".$jam."','$dari','$untuk2','N',null,'$jdl','$isi','$Ms_dc','$untuk')";
				$query     = mysql_query($AD_AB)or die(mysql_error());
				$adelia_abizar++;
			}
			$inf_msg = "info / berita sudah di kirim untuk ALL ".$untuk;
		}elseif($send_grup=='N'){
			if($Ms_grup=="DC"){
				$Query_inf = "select id_user from master_user where nama='".trim(strtolower($untuk))."'";
			}else{
				$Query_inf = "select id_user from master_user where kode_dc='".substr($untuk,0,4)."'";
			}
			//echo $Query_inf;
			$sintak = mysql_query($Query_inf);
			$adelia_abizar = 1;
			while($insert = mysql_fetch_array($sintak)){
				$untuk3     = $insert[0];
				$id_info2  = md5($id_info.$adelia_abizar);
				$AD_AB ="insert into info values ('$id_info2','".$tgl." ".$jam."','$dari','$untuk3','N',null,'$jdl','$isi','$Ms_dc','$untuk')";			
				$query     = mysql_query($AD_AB);
				$adelia_abizar++;
			}
			$inf_msg = "info / berita sudah di kirim untuk ".$untuk;
		}else{		
			$inf_msg = "Ada kesalahan pada saat pilih / save, coba di ulangi ";
		}
		$notif 		= "Info / berita sudah di kirim..";
		$Url_direct = "?page=informasi";
		$msg1       = $inf_msg;
		require_once "halaman/dialog1.php";
	}
}
?>

