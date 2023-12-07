<style>
#name-counter{
	width:685px;
	border:solid 1px #ccc;
	box-shadow:0 0 5px $ddd;
	overflow:auto;
}
#name-counter div{
	float:left;
	border-right:solid 1px;
	padding:2px;
	font-size:14px;
	font-weight:bold;
}
#name-list{
	width:685px;
	box-shadow:0 0 5px $ddd;
	overflow:auto;
	height:425px;
}
#name-list_x{
	float:left;
	border-right:solid 1px #8CB5FF;
	border-bottom:solid 1px #8CB5FF;
	padding:2px;
	font-size:11px;
	font-family:verdana;
	overflow:auto;
	height:50px;
}
.content{
	height:10px;
}
.no{
	width:30px;
}
.build{
	width:140px;
	overflow:hidden;
}
.user{
	width:100px;
	overflow:hidden;
}
.lokasi{
	width:160px;
	overflow:hidden;
}
.type{
	width:100px;
	overflow:hidden;
}
.kapasitas{
	width:100px;
	overflow:hidden;
}
.client{
	padding-top:10px;
	float:left;
	width:220px;
	height:200px;
	margin:5px;
	box-shadow:0px 0px 5px #ccc;
	border-radius:5px;
	overflow:hidden;
}
.client1{
	font-size:13px;
	font-weight:bold;
	padding-bottom:10px;
	margin-bottom:5px;
	text-align:center;
}
.client>a{
	text-decoration:none;
	font-size:12px;
	color:#666;
}
.client>a:hover{
	color: #D57D0C;
}
.navi{
	border-bottom:solid 1px orange;
	border-top:solid 1px orange;
	overflow:hidden;
	width:100%;
	text-align:right;
	padding:3px;
}
.paging{
	text-decoration:none;
	font-weight:bold;
	color:blue;
}
.paging_text{
	color:#ccc;	
}
.paging_pilih{
	color:#ccc;		
}
.box>a{
	color: #D57D0C;
}
.box>a:hover{
	color: blue;
}
.box>a:active{
	color: green;
}
.box>a:focus{
	color: green;
}
.project_image{
	border-radius:5px;
	box-shadow: 0 0 5px rgba(0,0,0,0.9);
	float:left;
	height:200px;
	width:200px;
	margin:6.5px; 
}
.box2{
	width:93%;
	background:#FFF;
	padding:2%;
	box-shadow:0px 0px 5px #ddd;
	border-radius:5px;
	margin:10px;
	border:solid 1px #ccc;
	overflow:hidden;
}
.href{
	color:blue;
	text-decoration:none;
	font-size:12px;
}
.href:hover{
	color:red;
	text-decoration:underline;
}
</style>
<div style="padding:10px; background:#fff;border-radius:5px;box-shadow:0 0 3px #fff;border:solid 1px #ccc;line-height:18px;overflow:auto;">
<?php
if(isset($_GET['project_id'])){
	$J = "SELECT * from project where project_id='".$_GET['project_id']."'";
	//echo $J;
    $Prld_query = mysql_query($J) or die (mysql_error());
    $Prld_rows  = mysql_num_rows($Prld_query);
    if($Prld_rows==1){
        $Prld_result = mysql_fetch_array($Prld_query);
        $Prld_img = $Prld_result['project_img'];
        if(strlen($Prld_img)==0 || !file_exists("image/project/".$Prld_img)){
            $Prld_img_show = "image/no_image.jpg";
        }else{
            $Prld_img_show = "image/project/".$Prld_img;
        }	
		
			echo '<div class="box2">
						<table style="float:left;">
						<tr><td colspan="3" class="client1">'.$Prld_result['build_name'].'<br/></td></tr>
						<tr><td width="20%">Type</td>	<td>:</td>	<td> '.$Prld_result['produk'].'</td></tr>
						<tr><td>User</td>				<td>:</td>	<td> '.$Prld_result['user'].'</td></tr>
						<tr><td>Lokasi</td>				<td>:</td>	<td> '.$Prld_result['lokasi'].'</td></tr>
						<tr><td>Kapasitas</td>			<td>:</td>	<td> '.$Prld_result['kapasitas'].'</td></tr>
						<tr><td>Unit</td>				<td>:</td>	<td> '.$Prld_result['unit'].'</td></tr>
						<tr><td>Tahun</td>				<td>:</td>	<td> '.$Prld_result['tahun'].'</td></tr>
						</table>
					<img style="width:150px;height:150px; float:right; border:solid 5px #ccc;border-radius:10px;box-shadow:0px 0px 5px #ccc;" src="'.$Prld_img_show.'" />
				  </div>';		  
				  echo "<div class='box2'>";
					$Proj_dtl_query  = mysql_query("select ifnull(small_img,'x'),ifnull(big_img,'x') from project_detail where project_id='$_GET[project_id]' and recid='X' order by urut")or die (Myer);
					while($Proj_dtl_result = mysql_fetch_array($Proj_dtl_query)){
						//echo strlen($Proj_dtl_result[0]);
						if(strlen($Proj_dtl_result['0'])==0){
							$Imgs = "X";
						}else{
							$Imgs = $Proj_dtl_result['0'];
						}
						if(strlen($Proj_dtl_result['1'])==0){
							$Imgb = "X";
						}else{
							$Imgb = $Proj_dtl_result['1'];
						}
						$Img_ico = "image/project/".trim($Imgs);
						$Img_big = "image/project/".trim($Imgb);
						//echo $Img_big."<br/>".$Img_ico;
						if(!file_exists($Img_ico) and !file_exists($Img_big)){
							$Img_ico_x = "image/no_image.jpg";
							$Img_big_x = "image/no_image.jpg";
						}elseif(file_exists($Img_ico) and !file_exists($Img_big)){
							$Img_ico_x = $Img_ico;
							$Img_big_x = $Img_ico;
						}elseif(!file_exists($Img_ico) and file_exists($Img_big)){
							$Img_ico_x = $Img_big;
							$Img_big_x = $Img_big;
						}elseif(file_exists($Img_ico) and file_exists($Img_big)){
							$Img_ico_x = $Img_ico;
							$Img_big_x = $Img_big;
						}
						//echo $Img_big_x."<br/>".$Img_ico_x;
						echo  "<a href='".$Img_big_x."' target='_blank'><img src='".$Img_ico_x."' class='project_image' style='float:left;width:144px; height:144px;' /></a>"; 
					}				  
				echo "</div>";
    }else{			
        require_once "halaman/404.php";	
    }
}else{
?>
    <span style="float:left;margin-bottom:10px; font-size:20px;">Proyek Kami
    <?php
    if(isset($_GET['proyek_dtl'])){
		$url_proyek=str_replace("-"," ",$_GET['proyek_dtl']);
        echo "- ".$url_proyek;
    }
    ?>
    </span>
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
        <div class="build">Proyek</div>
        <div class="user">User</div>
        <div class="lokasi">Lokasi</div>
        <div class="type">Type</div>
        <div class="kapasitas">Kapasitas</div>
    </div>
    <div id="name-list">
    <?php
    if(isset($_POST['submit'])){
        $limit = " limit ".$_POST['limit'];
    }else{
        $limit = " limit 7";
    }
    if(isset($_GET['proyek_dtl'])){
		$url_proyek=str_replace("-"," ",$_GET['proyek_dtl']);
        $Gs_query = mysql_query("select * from project  where produk='$url_proyek' order by upd_data desc".$limit);
    }else{
      $Gs_query = mysql_query("select * from project $proyek_type order by upd_data desc".$limit);
    }
        $no=1;
        while($Gs_result = mysql_fetch_array($Gs_query)){
            if(strlen($Gs_result['build_name'])>1){
                $build = $Gs_result['build_name'];
            }else{
                $build = "-";
            }
            if(strlen($Gs_result['user'])>1){
                $user = $Gs_result['user'];
            }else{
                $user = "-";
            }
            if(strlen($Gs_result['lokasi'])>1){
                $lokasi = $Gs_result['lokasi'];
            }else{
                $lokasi = "-";
            }
            //
            if(strlen($Gs_result['produk'])>1){
                $produk = $Gs_result['produk'];
            }else{
                $produk = "-";
            }
            if(strlen($Gs_result['kapasitas'])>1){
                $kapasitas = $Gs_result['kapasitas'];
            }else{
                $kapasitas = "-";
            }
            if(strlen($Gs_result['kapasitas'])>1){
                $kapasitas = $Gs_result['kapasitas'];
            }else{
                $kapasitas = "-";
            }
            //
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
                <div id="name-list_x" class="no" '.$warna.'>'.$no.'</div>
                <div id="name-list_x" class="build" '.$warna.'><a href="index.php?halaman=proyek&project_id='.$Gs_result['project_id'].'" class="href">'.$build.'</a></div>
                <div id="name-list_x" class="user" '.$warna.'>'.$user.'</div>
                <div id="name-list_x" class="lokasi" '.$warna.'>'.$lokasi.'</div>
                <div id="name-list_x" class="type" '.$warna.'>'.$produk.'</div>
                <div id="name-list_x" class="kapasitas" '.$warna.'>'.$kapasitas.'</div>
            </div>';
        $no++;	
        }
    ?>
    </div>
    <?php } ?>
</div>