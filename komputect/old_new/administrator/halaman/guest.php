<style>
input.datepicker{
	width:100px;
	text-align:center;
	cursor:pointer;
	background-color:#FFC;
	font-family:courier;
	border:solid 1px #ccc;
	box-shadow:0 0 5px #ddd;
}
span a{
	text-decoration:none;
}
.action{top:145px;}
.ro{
	background-color:#ddd;
	border:solid 1px #ccc;
	padding-left:5px;
}
td input{
	font-family:courier;
}
td textarea{
	font-family:courier;
	resize:none;
	width:97.5%;
	min-height:150px;
}
msg a{
	text-decoration:none;
	color:white;
	border:solid 1px;
	padding-left:5px;
	padding-right:5px;
	}
msg a:hover{
	background-color:white;
	color:brown;
	border:solid 1px white;
}div.ui-datepicker{
 font-size:10px;
}
</style>
 <script>
  $(function() {
    //$("#datepicker").datepicker();
	$("#start").datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: '0',
		});
	$("#end").datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: '0',
		});
		/*
	$("#startdate").datepicker({ dateFormat: "dd-mm-yy" }).val()
	$("#enddate").datepicker({ dateFormat: "dd-mm-yy" }).val()
	$("#datepicker").datepicker({  maxDate: '0'}); });
	*/
  });
  </script>
<div>
<?php 
if(isset($_GET['guest_dtl'])){
	?>
	<div class='action'>
		<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
			Detail Pesan
		</span>
		<span><a href="halaman.php" class="X_close">X</a></span>
		<hr width="100%" align="center" color="orange" style="float:left;">
		<br/>
		<?php 				
			$RT ="select * from guest_book where guest_id='$_GET[guest_dtl]'";
			$Emsg_cek = mysql_fetch_row(mysql_query($RT)) or die (mysql_error());
			if($Emsg_cek){
				$upd_msg = mysql_query("update guest_book set recid='Y' where guest_id='$_GET[guest_dtl]' and recid='N'") or die(mysql_error());
			}
		?>
		<table class="action_in" >
		<tr><td width="10%">Tgl / Jam</td>
			<td><input type="text" name="id" readonly class="ipro " value="<?php echo $Emsg_cek[0]."/".$Emsg_cek[1]; ?>"/></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" readonly class="ipro " value="<?php echo $Emsg_cek[2]; ?>" style="width:98%;"/></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" readonly class="ipro " value="<?php echo $Emsg_cek[3]; ?>" style="width:98%;"/></td>
		</tr>
		<tr>
			<td>Pesan</td>
			<td><textarea name="pesan" readonly ><?php echo $Emsg_cek[4]; ?></textarea></td>
		</tr>
		<tr><td colspan="2">
			<a href='halaman.php?page=guest&guest_dtl=<?php echo $_GET['guest_dtl']?>&hapus_pesan' class='button_d'>Delete Pesan</a>
		</td></tr>
		</table>
		<?php
		if(isset($_GET["hapus_pesan"])){
			echo "<msg>Apakah Pesan ini akan di hapus <a href='halaman.php?page=guest&guest_dtl=$_GET[guest_dtl]&hapus_pesan=Y'>Yes</a> <a href='halaman.php?page=guest&guest_dtl=$_GET[guest_dtl]'>No</a></msg>";
			if($_GET["hapus_pesan"]=="Y"){
				if(mysql_query("delete from guest_book where guest_id='$_GET[guest_dtl]'")){
					echo '<script>alert("Pesan sudah di hapus")</script>';	
					echo '<meta http-equiv="refresh" content="0;halaman.php">';	
				}
			}	
		}
		?>
	</div>
	<?php
}
?>
<span style="font-size:20px;">Pesan </span><br/>&nbsp;<br/>
<i style="color:blue;">
<?php 
if(!isset($_POST["submit"])){
	echo "Default 6 pesan";
}else{
	echo "Periode : ".$_POST['start']." s/d ".$_POST['end'];
}
?></i>
    <div style="float:right;margin-top:-15px;">
    <form method="post" action="" style="box-shadow:0 0 5px orange;border:solid 1px orange;border-radius:5px;padding:2px;background-color:#ccc;">
	<!--
    Lihat 
    <select name="limit">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="500">200</option>
    </select>
	-->
Periode : <input type="text" id="start" name="start" class="datepicker" value="<?php echo date('Y-m-d');?>" readonly> s/d <input type="text" id="end" name="end" class="datepicker" value="<?php echo date('Y-m-d');?>" readonly>
 
    <input type="submit" value="Go" name="submit">
    </form>
    </div>
<br/>
<hr width="100%" align="center" color="orange" style="float:left;">
<div id="name-counter">
	<div class="x7a">No</div>
    <div class="x5">Tgl Jam</div>
    <div class="x3">Nama</div>
    <div class="x9">Email</div>
    <div class="x8">Pesan</div>
    <div class="x7">Action</div>
</div>
<div id="name-list">
<?php
if(isset($_POST['submit'])){
	$limit = "";
	$find_date = "where date(tanggal) between date('$_POST[start]') and date('$_POST[end]')";
}else{
	$limit = " limit 8";
	$find_date = "";
}
$K="select * from guest_book $find_date order by tanggal desc,jam desc ".$limit;
$Gs_query = mysql_query($K);
	$no=1;
	while($Gs_result = mysql_fetch_array($Gs_query)){
		if(strlen($Gs_result['nama'])>1){
			$nama = $Gs_result['nama'];
		}else{
			$nama = "-";
		}
		if(strlen($Gs_result['email'])>1){
			$email = $Gs_result['email'];
		}else{
			$email = "-";
		}
		if(strlen($Gs_result['pesan'])>1){
			$pesan = $Gs_result['pesan'];
		}else{
			$pesan = "-";
		}
		$angka =  $no;
		if( $angka%2 == 1 ){			
			if($Gs_result['recid']=="N"){
				$warna = 'style="background-color:#B5E9FF;color:blue;font-weight:bold;"';
			}else{
				$warna = 'style="background-color:#B5E9FF;color:#333;"';
			}
		}if( $angka%2 == 0 ){			
			if($Gs_result['recid']=="N"){
				$warna = 'style="background-color:#DDF8FF;color:blue;font-weight:bold;"';
			}else{
				$warna = 'style="background-color:#DDF8FF;color:#333;"';
			}
		//$warna = 'style="background-color: #DDF8FF"';
		}
		$url = "<a href='halaman.php?page=guest&guest_dtl=$Gs_result[guest_id]' class='button_edit'>read</a>";
		echo '
		<div class="content_g">
			<div id="name-list_x_g" class="x7a Bleft" '.$warna.'><span $zahwa>'.$no.'</span></div>
			<div id="name-list_x_g" class="x5" '.$warna.'><span $zahwa>'.$Gs_result['tanggal']." ".$Gs_result['jam'].'</span></div>
			<div id="name-list_x_g" class="x3" '.$warna.'><span $zahwa>'.$nama.'</span></div>
			<div id="name-list_x_g" class="x9" '.$warna.'><span $zahwa>'.$email.'</span></div>
			<div id="name-list_x_g" class="x8" '.$warna.'><span $zahwa>'.$pesan.'</span></div>
			<div id="name-list_x_g" class="x7" '.$warna.'><span $zahwa>'.$url.'</span></div>
		</div>';
	$no++;	
	}
?><div><i  class="notif" style="margin-top:20px;float:left;">*klik read untuk melihat detail pesan</i></div>
</div>
</div>