<html>
<head>
<style type="text/css">
.produk{
	border-radius:5px;
	box-shadow: 0 0 5px rgba(0,0,0,0.9);
	float:left;
	height:200px;
	width:200px;
	margin:15px 15px 75px 15px  ; 
}
.produk_image{
	border-radius:5px;
	box-shadow: 0 0 5px rgba(0,0,0,0.9);
	float:left;
	height:200px;
	width:200px;
	margin:8px; 
}
.produk1{
	/*border-radius:30px 0px 30px 0px;*/
	height:30px;
	float:left;
	overflow:hidden;
}
.produk>a:focus{
	color:green;
}
.produk>a:active{
	color:green;
}
.produk2{
	box-shadow: 0 0 6px rgba(0,0,0,0.9);
	width:100%;
	float:left;
	font-family:tahoma;
	border-radius:5px;
	padding:3px;
}
.produk_font{
	margin:6px 0px 5px 10px;
	width:70%;
	background-color: #CCC;
	border-radius:5px;
	padding:0px 5px 2px 5px;
	float:left;
	font-size:14px;
	font-family:tahoma;
	font-weight:bold;
	color:grey;
	text-align:center;
	box-shadow:0px 0px 5px #666;
}
.produk_font:hover{
	background-color: #006;
	font-weight:bold;
	color:orange;
}
.produk_dtl1{
	float:left;
	padding:10px;
	width:32%;
	border-right:solid 1px #ddd;
	overflow:hidden;
}
.produk_dtl2{
	float:right;
	padding:10px;
	width:60%;
	overflow:hidden;
}
</style>  
</head>
<body>
<div>     
<?php
$Prod_query = mysql_query("select * from produk  where IFNULL(recid,'0')!='X' order by urut")or die (mysql_error());
if(!empty($var_product)){
?>
<div>
	<ul style="list-style:none;">
		<?php 
	  	while($Prod_result = mysql_fetch_array($Prod_query)){
			echo '
			<li class="produk_list">
				<a class="font12 color66 a_hide font_2" href="product_id-'.$Prod_result['product_id'].'.html" >
				<img style="height:25px; width:25px;" src="'.Img.'produk/'.$Prod_result['image_ico'].'"/>&nbsp;&nbsp;'.$Prod_result['product_name'].'
				</a>
			</li>';
		}
		?>
	</ul>
</div>
<?php    
}else{
	if(isset($_GET['product_id'])){
		$Prdt_query  = mysql_query("select product_name,image_full,image_ico,product_spek,product_desc from produk where product_id='$_GET[product_id]'")or die (mysql_error());
		if(mysql_num_rows($Prdt_query)==0){
			require_once E_404;
		}else{
		$Prdt_result = mysql_fetch_array($Prdt_query);
		?>
			<div class="produk_dtl1">
				<img src="<?php echo "image/produk/".$Prdt_result['1']; ?>" class="produk_image">
				<div style='height:450px;overflow:auto; float:left;'>
				<?php
					$Prod_dtl_query  = mysql_query("select small_img,big_img from produk_detail where product_id='$_GET[product_id]' and recid='X' order by urut")or die (mysql_error());
					while($Prod_dtl_result = mysql_fetch_array($Prod_dtl_query)){
						$Img_ico = "image/produk/".$Prod_dtl_result['0'];
						if(file_exists($Img_ico)){
							$Img_ico_x = $Img_ico;
						}else{							
							$Img_ico_x = "image/no_image.jpg";
						}
						$Img_full = "image/produk/".$Prod_dtl_result['1'];
						if(file_exists($Img_full)){
							$Img_full_x = $Img_full;
						}else{							
							$Img_full_x = "image/no_image.jpg";
						}
						echo  "<a href='".$Img_full_x."' target='_blank'><img src='".$Img_ico_x."' class='produk_image' style='float:left;width:55px; height:55px;' /></a>"; 
					}
				?>
				</div>
			</div>
			<div class="produk_dtl2">
				<b class='font30 color66 font_1' style="float:left;padding-bottom:5px; border-bottom:solid 5px orange;"><?php echo strtoupper($Prdt_result['0']); ?></b>&nbsp;<p/>&nbsp;<p/>
				<?php
				echo "<h3>Produk Detail</h3><p class='font12 font_c color66' style='text-align:justify;'>$Prdt_result[3]</p>";
				echo "<h3>Produk Deskripsi</h3><p class='font12 font_c color66' style='text-align:justify'>$Prdt_result[4]</p>";
				?>
			</div>
		<?php
		}
	}else{
	  	while($Prod_result = mysql_fetch_array($Prod_query)){
			echo '<div class="produk">	
				<a href="index.php?halaman=produk&product_id='.$Prod_result['product_id'].'"><img src="'."image/produk/".$Prod_result['image_full'].'" class="produk_image">
				<div class="produk2">  
						<div class="produk1" align="center">
						<img src="'."image/produk/".$Prod_result['image_ico'].'" height="30px" width="30px">
						</div> 
						<div class="produk_font">'.$Prod_result['product_name'].'</div>
				</div>
				</a>
			</div>';	
		}
	}
}
  ?>
</div> 
<!--
<script type="text/javascript">
	$(document).ready(function(){
		$('.ThumbaGallery').Thumba({});
	});
</script>
-->
</body> 
</html>