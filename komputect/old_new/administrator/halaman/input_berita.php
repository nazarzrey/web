<?php
	$path = "../image/berita/";
	include("config/convert_image.php");
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
.img_berita_x{
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
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			heightStyle: "content"
		});
	});
	</script>
</head>
<div style='margin-bottom:30px;'>
<?php if(isset($_GET['action'])){
		echo '<div style="margin-left:5px;margin-top:-5px;">
				<a href="halaman.php?page=M_berita" class="button_x" >List Berita</a> 
			  </div>';
		if($_GET['action']=="add_news"){
			require_once "halaman/berita/tambah_berita.php";
		}elseif($_GET['action']=="ins_gal"){
			require_once "halaman/berita/tambah_galery_berita.php";
		}elseif($_GET['action']=="edit_berita"){
			require_once "halaman/berita/edit_berita.php";
		}
	}else{
?>
	<div style="float:right;margin-top:-10px;">
		<a href="halaman.php?page=M_berita&action=add_news" class="button_x" >Add berita</a> 
	</div>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List berita </span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7b">Aktif</div>
		<div class="x7b">Utama</div>
		<div class="x5a">Key Berita</div>
		<div class="x10">Judul ID</div>
		<div class="x8">Content ID</div>
		<div class="x5">Img Master</div>
		<div class="x7b">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
									/*     0      1     2             3        4             5          6              7     */
		$news_query = mysql_query("select aktif,utama,key_berita,judul_id,isi_berita_id,gambar_kecil,gambar_besar,id_berita from berita");
		$no=1;
		while($news_result = mysql_fetch_array($news_query)){
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='?page=M_berita&action=edit_berita&id_berita=$news_result[7]'>Edit</a>";
			$img_news = $news_result[5];
			if($img_news=="-" || strlen(trim($img_news))==0){
				$img_news_utama="<b style='color:brown'>no image inserted</b>";
			}elseif(!file_exists($path.$img_news)){
				$img_news_utama="<b style='color:red;text-align:center;'>not found</b>";
			}else{
				if(file_exists($path.$img_news)){
					$img_news_utama="<img src='".$path.$img_news."' width='100%' height='100%' />";
				}else{
					$img_news_utama="<b style='color:green;text-align:center;'>Have Image</b>";	
				}
			}
			echo '
			<div class="content_g">
				<div id="name-list_x_g" class="x7b Bleft" '.$warna.'>'.$news_result[0].'</div>
				<div id="name-list_x_g" class="x7b" '.$warna.'>'.$news_result[1].'<a></div>
				<div id="name-list_x_g" class="x5a" '.$warna.'><a href="../Info-'.str_replace(" ","-",$news_result[2]).'.html" target="_blank" style="color:blue;text-decoration:none;">'.$news_result[7].'</a></div>
				<div id="name-list_x_g" class="x10" '.$warna.'>'.$news_result[3].'</div>
				<div id="name-list_x_g" class="x8" '.$warna.'>'.$news_result[4].'</div>
				<div id="name-list_x_g" class="x5" '.$warna.'>'.$img_news_utama.'</div>
				<div id="name-list_x_g" class="x7b" '.$warna.'>'.$url.'</div>
			</div>';
		$no++;	
		}
	?>
	</div><br/><i class="notif">* Klik berita name untuk melihat detail, maksimal berita utama 4 page</i> 
<?php } ?>
</div>
</body>
</html>