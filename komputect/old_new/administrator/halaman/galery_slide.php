<?php
	$path = "../image/slide/";
	include("config/convert_image.php");
	$wmax0 = 500;
	$hmax0 = 500;
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
	}
	#name-list select{
		margin:2px;
		width:50px;
		font-family:courier;
	}
	.ro{
		background-color:#ddd;
	}
	#content-menu{
		padding:0px 5px 0px 5px;
		width:100%;
	/*	padding:1% 3.5% 1% 3.5% ; */
		overflow:hidden;
		float:right;
	}
	.judul{
		float:left;
		width:20%;
		padding-top:5px;
		padding-left:26px;
		font-weight:bold;
		color:#888;
	}
	.isi{
		float:left;
		width:70%;		
	}
	.info{
		height:30px;
		margin-bottom:2px;
		width;100%;
		border:solid 1px #ddd;
		border-radius:5px;
		background-color:#fff;
		padding:2px;
	}
.img_galery_x{
	border:solid 1px blue;
}
.box-del{
	width:550px;
	height:auto;
	padding:50px;
	background-color:orange;
	position:absolute;
	top:250px;
	box-shadow:0 0 20px 10px orange;
	border:solid 1px brown;
	border-radius:10px;
	overflow:auto;
	z-index:1;
}
</style>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
</head>
<div style='margin-bottom:30px;'>
<?php if(isset($_GET['action'])){
		echo '<div style="margin-left:5px;margin-top:-5px;">
				<a href="halaman.php?page=slide_galery" class="button_x" >List galery slide</a> 
			  </div>';
		if($_GET['action']=="add_galery"){
			require_once "galery/tambah_galery.php";
		}elseif($_GET['action']=="ins_gal"){
			require_once "galery/tambah_galery_galery.php";
		}elseif($_GET['action']=="edit_galery"){
			require_once "galery/edit_galery.php";
		}
	}else{
?>
	<div style="float:right;margin-top:-10px;">
		<a href="halaman.php?page=slide_galery&action=add_galery" class="button_x" >Add galery slide</a> 
	</div>
	<?php	
		$cek_priority = mysql_fetch_array(mysql_query("select count(aktif) from galery where aktif='Y' and recid='BS'"))or die (mysql_query());
	?>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List galery slide Halaman utama
		<i style="font-size:10px; padding-left:20px;font-weight:normal;"><?php echo $cek_priority[0];?> Project pada halaman utama </i>
	</span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7c">No</div>
		<div class="x7c">Urut</div>
		<div class="x7">Aktif</div>
		<div class="x8">Desc</div>
		<div class="x2">Img Master</div>
		<div class="x5 tengah">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
									/*     0      1     2             3        4             5          6              7     */
		$galery_query = mysql_query("SELECT urut,info_id,img_thumb,img_full,aktif,id_galery FROM galery WHERE recid='BS' order by urut");
		$no=1;
		while($galery_result = mysql_fetch_array($galery_query)){
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url1 = "<a href='?page=slide_galery&action=edit_galery&id_galery=$galery_result[5]'>Edit</a>";
			//$url2 = "<a href='?page=slide_galery&action=delete_galery&id_galery=$galery_result[5]'>Delete</a>";
			$img_galery = $galery_result[3];
			if($img_galery=="-" || strlen(trim($img_galery))==0){
				$img_galery_utama="<b style='color:brown'>no image inserted</b>";
			}elseif(!file_exists($path.$img_galery)){
				$img_galery_utama="<b style='color:red;text-align:center;'>not found</b>";
			}else{
				if(file_exists($path.$img_galery)){
					$img_galery_utama="<img src='".$path.$img_galery."' width='100%' height='100%' />";
				}else{
					$img_galery_utama="<b style='color:green;text-align:center;'>Have Image</b>";	
				}
			}
			if($galery_result['aktif']=="Y"){
				$aktif="style='color:blue;font-weight:normal;'";
			}else{
				$aktif="style='color:red;'";
			}
			echo '
			<div class="content_g">
				<div id="name-list_x_g" class="x7c Bleft" '.$warna.'>'.$no.'</div>
				<div id="name-list_x_g" class="x7c" '.$warna.'>'.$galery_result[0].'</div>
				<div id="name-list_x_g" class="x7" '.$warna.'>'.$galery_result[4].'</div>
				<div id="name-list_x_g" class="x8" '.$warna.'><b '.$aktif.'>'.$galery_result[1].'</b></div>
				<div id="name-list_x_g" class="x2" '.$warna.'>'.$img_galery_utama.'</div>
				<div id="name-list_x_g" class="x5 tengah" '.$warna.'>'.$url1.'</div>
			</div>';
		$no++;	
		}
	?>
	</div><br/><i class="notif">* semakin banyak image galery halaman utama maka akan semakin berat laod halaman di awal Maksimal galery pada menu slide 10 gambar</i> 
<?php } ?>
</div>
</body>
</html>