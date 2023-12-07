<style>
.client{
	padding-top:10px;
}
.client td{
	font-size:12px;
}
.client1{
	font-size:12px;
	font-weight:bold;
	border-bottom:solid 1px orange;
	padding-bottom:10px;
	margin-bottom:5px;
}
.client>a{
	text-decoration:none;
	font-size:12px;
	color:#666;
}
.client>a:hover{
	color:#999;
}
#slider1_container{
	background:#fff;
	border:solid 1px #001B73;
	box-shadow:0 0 10px #001B73; 
	border-radius:5px;
	padding-bottom:5px;
	margin-bottom:10px;
}
</style>
<script type="text/javascript" src="js/slide.content2.js"></script>
<body style="font-family:Arial, Verdana;background-color:#fff;">
    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 698px; height: 215px; overflow: hidden;">
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(image/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 698px; height: 215px; overflow: hidden;">
		<?php
	if(isset($_GET['proyek_dtl'])){
		$url_proyek=str_replace("-"," ",$_GET['proyek_dtl']);
        $Cl_query  = mysql_query("select * from project where produk='$url_proyek' order by upd_data desc,tahun desc limit $var_dtl")or die (mysql_error());
	}else{
		$sk = "select * from project $proyek_type order by upd_data desc,tahun desc limit $var_dtl";
		$Cl_query  = mysql_query($sk)or die (mysql_error());
	}		
			while ($Cl_result = mysql_fetch_array($Cl_query)){
				$Cl_img  = $Cl_result['project_img'];
				$Cl_href = "index.php?halaman=proyek&project_id=".$Cl_result['project_id'];
				//if(strlen($Cl_img)==0 || !file_exists("image/project/".$Cl_img)){
					echo '<div class="client">
						<a href="'.$Cl_href.'">
							<table>
								<tr><td colspan="3" class="client1">'.$Cl_result['build_name'].'<br/></td></tr>
								<tr><td width="20%">Type</td><td>:</td><td> '.$Cl_result['produk'].'</td></tr>
								<tr><td>User </td><td>:</td><td> '.$Cl_result['user'].'</td></tr>
								<tr><td>Lokasi</td><td>:</td><td> '.$Cl_result['lokasi'].'</td></tr>
								<tr><td>kapasitas</td><td>:</td><td> '.$Cl_result['kapasitas'].'</td></tr>
								<tr><td>Unit</td><td>:</td><td> '.$Cl_result['unit'].'</td></tr>
								<tr><td>tahun</td><td>:</td><td> '.$Cl_result['tahun'].'</td></tr>
							</table>
						</a>
					</div>';
					/*
				}else{
				echo '
				<div class="client" style="padding-top:13px;">
				  <a href="'.$Cl_href.'" title="('.$Cl_result['produk'].'-('.$Cl_result['kapasitas'].')-'.$Cl_result['unit'].' Unit)'.$Cl_result['lokasi'].'">
					<div class="client1">
						'.$Cl_result['build_name'].'
					</div>
					<img u="image" src="'."image/project/".$Cl_img.'" />
				  </a>
				</div>';
				}
				*/
			}
			
		?>
        </div>
        <style>
            .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av
            {
                background: url(image/b03.png) no-repeat;
                overflow:hidden;
                cursor: pointer;
            }
            .jssorb03 div { background-position: -5px -4px; }
            .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -65px -4px; }
            .jssorb03 .av { background-position: -65px -4px; }
            .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }
        </style>
        <div u="navigator" class="jssorb03" style="position: absolute; bottom: 0px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="position: absolute; width: 21px; height: 21px; text-align:center; line-height:21px; color:#666; font-size:12px;"><NumberTemplate></NumberTemplate></div>
        </div>
        <style>
            .jssora03l, .jssora03r, .jssora03ldn, .jssora03rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(image/a03.png) no-repeat;
                overflow:hidden;
            }
            .jssora03l { background-position: -3px -33px; }
            .jssora03r { background-position: -63px -33px; }
            .jssora03l:hover { background-position: -123px -33px; }
            .jssora03r:hover { background-position: -183px -33px; }
            .jssora03ldn { background-position: -243px -33px; }
            .jssora03rdn { background-position: -303px -33px; }
        </style>
        <span u="arrowleft" class="jssora03l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
        <span u="arrowright" class="jssora03r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
    </div>
    <!-- Jssor Slider End -->
</body>
</html>