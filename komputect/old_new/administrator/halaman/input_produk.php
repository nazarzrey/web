<?php
	$path = "../image/product/";
	include("config/convert_image.php");
	$web_page = "halaman.php?page=product_input";
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
		width:160px;
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
		width:25%;
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
.img_produk_x{
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
				<a href="halaman.php?page=product_input" class="button_x" >List product</a> 
			  </div>';
		if($_GET['action']=="add_prod"){
			require_once "produk/tambah_produk.php";
		}elseif($_GET['action']=="ins_gal"){
			$Nid = "product";
			require_once "produk/galery_produk.php";
		}elseif($_GET['action']=="edit_product"){
			require_once "produk/edit_produk.php";
		}
	}else{
?>
	<div style="float:right;margin-top:-10px;">
		<a href="halaman.php?page=product_input&action=add_prod" class="button_x" >Add product</a> 
	</div>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List product </span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7">Urut</div>
		<div class="x3">Product Name</div>
		<div class="x10">Product Spek ID</div>
		<div class="x10">Product Desc ID</div>
		<div class="x5">Img Master</div>
		<div class="x5">Img Galery</div>
		<div class="x7">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
								/*     0            1				2          3           4        5       6            */
	$prod_query = mysql_query("SELECT product_name,product_spek,product_desc,image_ico,image_full,urut,product_id FROM product where ifnull(recid,'0')<>'X' ORDER BY urut");
		$no=1;
		while($prod_result = mysql_fetch_array($prod_query)){
			$prod_dtl_query  = mysql_query("select  count(product_id) as pro_dtl from product_detail where product_id='$prod_result[product_id]'")or die (mysql_error());
			$prod_dtl_result = mysql_fetch_array($prod_dtl_query);
			if($prod_dtl_result[0]==0){
				$img_prod_dtl= "<a href='".$web_page."&action=ins_gal&data_product=$prod_result[product_id]&action_page=galery_insert' class='button_edit'>Insert Galery</a>";
			}else{
				$img_prod_dtl= "<a href='".$web_page."&action=ins_gal&data_product=$prod_result[product_id]&action_page=galery_insert' class='button_edit'><b style='font-size:11px;color:orange;'>".$prod_dtl_result[0]." Image</b></a>";
			}
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='?page=product_input&action=edit_product&product_id=$prod_result[6]' class='button_edit'>Edit</a>";
			$img_prod_utama = $prod_result[4];
			if($img_prod_utama=="-" || strlen(trim($img_prod_utama))==0){
				$img_prod_utama="<b style='color:brown'>no image inserted</b>";
			}elseif(!file_exists($path.$img_prod_utama)){
				$img_prod_utama="<b style='color:red;text-align:center;'>not found</b>";
			}else{
				if(file_exists($path.str_replace("full-","thumb-",$img_prod_utama))){				
					$img_prod_utama="<img src='".$path.str_replace("full-","thumb-",$img_prod_utama)."' width='100%' height='100%' />";
				}else{
					$img_prod_utama="<b style='color:green;text-align:center;'>Have Image</b>";	
				}
			}
			echo '
			<div class="content">
				<div id="name-list_x" class="x7 Bleft" '.$warna.'>'.$prod_result[5].'</div>
				<div id="name-list_x" class="x3" '.$warna.'><a href="../?halaman=produk&product_id='.$prod_result[6].'" target="_blank" style="color:blue;text-decoration:none;">'.$prod_result[0].'<a></div>
				<div id="name-list_x" class="x10" '.$warna.'>'.$prod_result[1].'</div>
				<div id="name-list_x" class="x10" '.$warna.'>'.$prod_result[2].'</div>
				<div id="name-list_x" class="x5" '.$warna.'>'.$img_prod_utama.'</div>
				<div id="name-list_x" class="x5" '.$warna.'>'.$img_prod_dtl.'</div>
				<div id="name-list_x" class="x7" '.$warna.'>'.$url.'</div>
			</div>';
		$no++;	
		}
	?>
	</div><br/><i class="notif">* Klik product name untuk melihat detail</i> 
<?php } ?>
</div>
</body>
</html>