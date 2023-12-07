<style>
.no{
	width:30px;
}
.tanggal{
	width:70px;
}
.jam{
	width:60px;
}
.browser{
	width:110px;
}
.os{
	width:80px;
}
.negara{
	width:80px;
}
.kota{
	width:80px;
	}
.isp{
	width:185px;
}
</style>
<div>
<span style="float:left;margin-bottom:10px; font-size:20px;">List Pengunjung </span>
    <div style="float:right">
    <form method="post" action="">
    Lihat 
    <select name="limit">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
        <option value="500">200</option>
    </select>
        <input type="submit" value="Go" name="submit">
    </form>
    </div>
<br/>
<hr width="100%" align="center" color="orange" style="float:left;">
<div id="name-counter">
	<div class="no">No</div>
    <div class="tanggal">Tanggal</div>
    <div class="jam">Jam</div>
    <div class="browser">Browser</div>
    <div class="os">O S</div>
    <div class="negara">Negara</div>
    <div class="kota">Kota</div>
    <div class="isp">Isp</div>
</div>
<div id="name-list">
<?php
if(isset($_POST['submit'])){
	$limit = " limit ".$_POST['limit'];
}else{
	$limit = " limit 17";
}
$Vis_query = mysql_query("select *  from counter order by tanggal desc, jam desc ".$limit);
	$no=1;
	while($Vis_result = mysql_fetch_array($Vis_query)){
		if(strlen($Vis_result['browser'])>1){
			$browser = $Vis_result['browser'];
		}else{
			$browser = "unknown";
		}
		if(strlen($Vis_result['os'])>1){
			$os = $Vis_result['os'];
		}else{
			$os = "unknown";
		}
		if(strlen($Vis_result['country'])>1){
			$country = $Vis_result['country'];
		}else{
			$country = "unknown";
		}
		if(strlen($Vis_result['city'])>1){
			$city = $Vis_result['city'];
		}else{
			$city = "unknown";
		}
		if(strlen($Vis_result['isp'])>1){
			$isp = $Vis_result['isp'];
		}else{
			$isp = "unknown";
		}
		$angka =  $no;
		if( $angka%2 == 1 ){
		$warna = 'style="background-color:#B5E9FF"';
		}
		if( $angka%2 == 0 )
		{
		$warna = 'style="background-color: #DDF8FF"';
		}
		echo '
		<div class="content">
			<div id="name-list_x" class="no Bleft" '.$warna.'>'.$no.'</div>
			<div id="name-list_x" class="tanggal" '.$warna.'>'.$Vis_result['tanggal'].'</div>
			<div id="name-list_x" class="jam" '.$warna.'>'.$Vis_result['jam'].'</div>
			<div id="name-list_x" class="browser" '.$warna.'>'.$browser.'</div>
			<div id="name-list_x" class="os" '.$warna.'>'.$os.'</div>
			<div id="name-list_x" class="negara" '.$warna.'>'.$country.'</div>
			<div id="name-list_x" class="kota" '.$warna.'>'.$city.'</div>
			<div id="name-list_x" class="isp" '.$warna.'>'.$isp.'</div>
		</div>';
	$no++;	
	}
?>
</div>
</div>
