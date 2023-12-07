<?php
	$path = "../image/project/";
	include("config/convert_image.php");
	$web_page 	= "halaman.php?page=project_input";
	$max_pry	= 12;
	$wmax1 = 350;
	$hmax1 = 350;
	$wmax2 = 300;
	$hmax2 = 300;
	$wmax3 = 200;
	$hmax3 = 200;
	$wmax4 = 150;
	$hmax4 = 150;
	$wmax5 = 75;
	$hmax5 = 75;
?>				
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
.img_proyek_x{
	border:solid 1px blue;
	position:absolute;
	margin-left:320px;
	margin-top:-128px;
	height:150px;
}
</style>
</head>
<div>
<?php 
if(!isset($_GET['action'])){
	echo '<div style="float:right;margin-top:-10px;">
			<a href="'.$web_page.'&action=add_proj" class="button_x" >Add Proyek</a> 
		  </div>';
	$cek_priority = mysql_fetch_array(mysql_query("select count(utama) from project where utama='Y'"))or die (mysql_query());
	?>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List Proyek <i style="font-size:10px; padding-left:20px;font-weight:normal;"><?php echo $cek_priority[0];?> Project pada halaman utama </i></span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x1">Build name *</div>
		<div class="x2">Lokasi</div>
		<div class="x3">User</div>
		<div class="x3">Produk</div>
		<div class="x6">Img Utama</div>
		<div class="x6a">Img Galery</div>
		<div class="x7">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
	$proj_query = mysql_query("SELECT type,build_name,IFNULL(lokasi,'-'),IFNULL(USER,'-'),IFNULL(produk,'-'),IFNULL(kapasitas,'-'),IFNULL(unit,'-'),IFNULL(tahun,'-'),IFNULL(project_img,'-'),project_id,utama FROM project ORDER BY upd_data DESC");
		$no=1;
		while($proj_result = mysql_fetch_array($proj_query)){
			$proj_dtl_query  = mysql_query("select  count(project_id) as pro_dtl from project_detail where project_id='$proj_result[project_id]'")or die (mysql_error());
			$proj_dtl_result = mysql_fetch_array($proj_dtl_query);
			if($proj_dtl_result[0]==0){
				$img_proj_dtl= "<a href='".$web_page."&action=ins_gal&data_project=$proj_result[project_id]&action_page=galery_insert' class='button_edit'>Insert Galery</a>";
			}else{
				$img_proj_dtl= "<a href='".$web_page."&action=ins_gal&data_project=$proj_result[project_id]&action_page=galery_insert' class='button_edit'><b style='font-size:11px;color:orange;'>".$proj_dtl_result[0]." Image</b></a>";
			}
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$img_proj_utama = $proj_result[8];
			if($img_proj_utama=="-" || strlen(trim($img_proj_utama))==0){
				$img_proj_utama="<b style='color:brown'>no image inserted</b>";
			}elseif(!file_exists($path.$img_proj_utama)){
				$img_proj_utama="<b style='color:red;text-align:center;'>image not found</b>";
			}else{
				if(file_exists($path.str_replace("full-","thumb-",$img_proj_utama))){				
					$img_proj_utama="<img src='".$path.str_replace("full-","thumb-",$img_proj_utama)."' width='100%' height='100%' />";
				}else{
					$img_proj_utama="<b style='color:green;text-align:center;'>Have Image</b>";	
				}
			}
			$priority = $proj_result[10];
			if($priority=="Y"){
				$W_priority = 'style="color:green;text-decoration:none;font-size:10x;font-weight:bold;"';
				$tooltip    = "Utama";
			}else{
				$W_priority = 'style="color:blue;text-decoration:none;"';
				$tooltip    = "";
			}
			$url = "<a href='".$web_page."&action=edit_project&project_id=$proj_result[9]' title='$tooltip' class='button_edit'>Edit</a>";
			echo '
			<div class="content">
				<div id="name-list_x" class="x1 Bleft" '.$warna.'><a href="../index.php?halaman=proyek&project_id='.$proj_result[9].'" target="_blank" '.$W_priority.'>'.$proj_result[1].'<a></div>
				<div id="name-list_x" class="x2" '.$warna.'>'.$proj_result[2].'</div>
				<div id="name-list_x" class="x3" '.$warna.'>'.$proj_result[3].'</div>
				<div id="name-list_x" class="x3" '.$warna.'>'.$proj_result[4].'</div>
				<div id="name-list_x" class="x6" '.$warna.'>'.$img_proj_utama.'</div>
				<div id="name-list_x" class="x6a" '.$warna.'>'.$img_proj_dtl.'</div>
				<div id="name-list_x" class="x7" '.$warna.'>'.$url.'</div>
			</div>';
		$no++;	
		}
	?>
	</div><br/><i  class="notif">* Klik bulid name untuk melihat detail, project warna hijau adalah yang di pilih untuk halaman utama maksimal <?php echo $max_pry;?> project terpilih</i> 
	<?php
}else{
	echo '<div style="margin-left:5px;margin-top:-5px;">
			<a href="'.$web_page.'" class="button_x" >List Proyek</a>
		  </div>';
	if($_GET['action']=="add_proj"){
		require_once "proyek/tambah_proyek.php";
	}elseif($_GET['action']=="ins_gal"){
		$Nid = "project";
		require_once "proyek/galery_proyek.php";
	}elseif($_GET['action']=='edit_project'){
		require_once "proyek/edit_proyek.php";
	}	
} 
?>
</div>
</body>
</html>