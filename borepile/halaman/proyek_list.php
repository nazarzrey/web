<div style="max-height:100%;overflow:auto;" class="xcontent_dtl1">
	<?php
	$table   = "master_grup";
	$field   = "deskripsi";
	$cek_id  = "id_grup";
	$key	 = "proyek";
	$content = "Proyek";
	$Redirected = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	require_once "seting/browser.php";
	$tgl  = date("Y-m-d");
	$jam  = date("H:i:s");
	$ip   = getenv("REMOTE_ADDR");
	$brws = $browser_name;
	function proy_fav($content_id)
	{
		global $jam, $tgl, $ip, $brws, $Redirected, $db;
		$jam_query = "DATE_FORMAT(upd_rec,'%Y-%m-%d')='$tgl'";
		#$jam_query = "substr(upd_rec,1,16)=substr('$jam',1,16)";
		$data_ready = "select 1 from favorit_proyek where $jam_query and ip_address='$ip' and browser='$brws' and id_fk_content in (select id_dtl from proyek where url_dtl='$content_id')";
		$cek_data = $db->select($data_ready);
		if ($cek_data) {
			if (count($cek_data) == 0) {
				$kosong = "insert into favorit_proyek select id_dtl,'$tgl $jam','$ip','$brws' from proyek where url_dtl='$content_id'";
				$insert_data = $db->select($kosong);
				if (!$insert_data) {
					log_error($Redirected, $kosong);
				}
			}
		} else {
			log_error($Redirected, $data_ready);
		}
	}
	function prod_fav($content_id)
	{
		global $jam, $tgl, $ip, $brws, $Redirected, $db;
		$jam_query = "DATE_FORMAT(upd_rec,'%Y-%m-%d')='$tgl'";
		#$jam_query = "substr(upd_rec,1,16)=substr('$jam',1,16)";
		$data_ready = "
	SELECT 1 FROM favorit_produk WHERE $jam_query AND ip_address='::1' AND browser='Google Chrome' 
	AND id_fk_content IN (SELECT id_grup FROM master_grup WHERE id_grup IN (SELECT id_fk_prod FROM proyek WHERE url_dtl='$content_id'))";
		$cek_data = $db->select($data_ready);
		if ($cek_data) {
			if (count($cek_data) == 0) {
				$kosong = "insert into favorit_produk select id_grup,'$tgl $jam','$ip','$brws' from master_grup where id_grup in (SELECT id_fk_prod FROM proyek WHERE url_dtl='$content_id')";
				$insert_data = $db->select($kosong);
				if (!$insert_data) {
					log_error($Redirected, $kosong);
				}
			}
		} else {
			log_error($Redirected, $data_ready);
		}
	}
	if (isset($_GET['proy_grup'])) {
		$grup_proyek =  escape($_GET['proy_grup']);
		$Prod_query = $db->select("SELECT a.url_dtl,a.tahun,a.nama_proyek,a.lokasi,a.id_dtl_img,b.deskripsi AS produk,c.deskripsi AS proyek,a.galeri FROM
				proyek a LEFT OUTER JOIN master_grup b
				ON a.id_fk_prod=b.id_grup
				LEFT OUTER JOIN master_grup c
				ON a.id_fk_proy=c.id_grup 				
				WHERE c.url_grup='$grup_proyek'
				ORDER BY a.upd_rec DESC");
	} else {
		$Prod_query = $db->select("SELECT a.url_dtl,a.tahun,a.nama_proyek,a.lokasi,a.id_dtl_img,b.deskripsi AS produk,c.deskripsi AS proyek,a.galeri FROM
				proyek a LEFT OUTER JOIN master_grup b
				ON a.id_fk_prod=b.id_grup
				LEFT OUTER JOIN master_grup c
				ON a.id_fk_proy=c.id_grup ORDER BY a.upd_rec DESC");
	}
	if (isset($_GET['proy_dtl'])) {
		$get_id = escape($_GET['proy_dtl']);
		proy_fav($get_id);
		prod_fav($get_id);
		$sintak1 = "SELECT  url_dtl,nama_proyek,detail_proyek,tahun,lokasi,id_dtl_img,galeri,id_fk_proy,id_fk_prod FROM proyek where url_dtl='$get_id'";
		$Prdt_query  = $db->select($sintak1);
		if (count($Prdt_query) == 0) {
			echo "data tidak di temukan";
		} else {
			$Prdt_result = $Prdt_query;
			$image = $Prdt_result[0]['id_dtl_img'];
			if (strlen($image) == 0 ||  !file_exists($path_img1 . $image)) {
				$image_ico = $path_img2 . "no_image.jpg";
				$image_full = $path_img2 . "no_image.jpg";
			} else {
				$image_ico = $path_img1 . str_replace('full_', 'thumb_', $image);
				$image_full = $path_img1 . $image;
			}
	?>
			<div class="pro_dtl1">
				<img data-src="<?= $image_full; ?>" class="pro_image">
				<div style='height:auto;overflow:auto; float:left;'>
					<?php
					$sintak2 = "SELECT full_file_name,base_name FROM galery WHERE id_attach='" . $Prdt_result[0]['galeri'] . "'";
					$proy_dtl_query  = $db->select($sintak2);
					foreach ($proy_dtl_query as $proy_dtl_result) {
						$Img_full = $path_img1 . $proy_dtl_result['full_file_name'];
						if (!file_exists($Img_full) || strlen($proy_dtl_result['full_file_name']) == 0) {
							$image_ico_x = $path_img2 . "no_image.jpg";
							$image_full_x = $path_img2 . "no_image.jpg";
						} else {
							$image_ico_x = $path_img1 . str_replace('full_', 'thumb_', $proy_dtl_result['full_file_name']);
							$image_full_x = $path_img1 . $proy_dtl_result['full_file_name'];
						}
					?>
						<a onclick="OpenPopupCenter('<?= $image_full_x; ?>', 'TEST!?', 640, 420);return false;">
							<img data-src='<?= $image_ico_x; ?>' class='pro_image' style='float:left;width:55px; height:55px;' />
						</a>
					<?php
					}
					?>
				</div>
			</div>
			<div class="pro_dtl2">
				<span class='color66 font_1' style="float:left;padding-bottom:5px; border-bottom:solid 5px #0064ab;font-size:22px;">
					<?= strtoupper($Prdt_result[0]['nama_proyek']); ?></span>
				<?php
				echo "<p class='font12 font_c color66' style='margin-top:50px !important'>" . $Prdt_result[0]['detail_proyek'] . "</p>";
				?>
				<?php
				$sintak = "SELECT deskripsi  FROM master_grup  WHERE id_grup='" . $Prdt_result[0]['id_fk_proy'] . "'";
				$query = $db->select($sintak);
				?>
				<h3 style="padding-bottom:5px; border-bottom:solid 2px #0064ab;">List Proyek - <?= $query[0]['deskripsi']; ?></h3>
				<div style="padding:5px;">
					<?php
					$sintak = "
						SELECT a.url_dtl,a.nama_proyek,b.deskripsi  FROM proyek a RIGHT JOIN master_grup  b
						ON a.id_fk_proy=b.id_grup  WHERE b.id_grup='" . $Prdt_result[0]['id_fk_proy'] . "' and a.url_dtl!='$get_id'
						ORDER BY a.upd_rec DESC limit 10";
					$query = $db->select($sintak);
					foreach ($query as $result) {
						echo "<a href='" . "proyek/" . $result['url_dtl'] . ".html' class='pro_list'>" . strtoupper($result['nama_proyek']) . "," . "</a> ";
					}
					?>
				</div>
				<p />&nbsp;
				<?php
				$sintak = "SELECT deskripsi  FROM master_grup  WHERE id_grup='" . $Prdt_result[0]['id_fk_prod'] . "'";
				$query = $db->select($sintak);
				?>
				<h3 style="padding-bottom:5px; border-bottom:solid 2px #0064ab;">List Proyek - <?= $query[0]['deskripsi']; ?></h3>
				<div style="padding:5px;">
					<?php
					$sintak = "
						SELECT a.url_dtl,a.nama_proyek,b.deskripsi  FROM proyek a RIGHT JOIN master_grup  b
						ON a.id_fk_prod=b.id_grup  WHERE b.id_grup='" . $Prdt_result[0]['id_fk_prod'] . "' and a.url_dtl!='$get_id'
						ORDER BY a.upd_rec DESC limit 10";
					$query = $db->select($sintak);
					foreach ($query as $result) {
						echo "<a href='proyek/" . $result['url_dtl'] . ".html' class='pro_list'>" . strtoupper($result['nama_proyek']) . "," . "</a> ";
					}
					?>
				</div>
			</div>
	<?php
		}
	} else {
		if (count($Prod_query) != 0) {
			foreach ($Prod_query as $Prod_result) {
				$image = $Prod_result['id_dtl_img'];
				if (strlen($image) == 0 ||  !file_exists($path_img1 . $image)) {
					$image_ico = $path_img2 . "no_image.jpg";
					$image_full = $path_img2 . "no_image.jpg";
				} else {
					$image_ico = $path_img1 . str_replace('full_', 'thumb_', $image);
					$image_full = $path_img1 . $image;
				}
				echo '<div class="pro">	
					<a href="proyek/' . $Prod_result['url_dtl'] . '.html">
						<img data-src="' . $image_ico . '" class="pro_image2">
						<div class="pro2">  
								<div class="pro_font">
								<a>' . $Prod_result['produk'] . '</a>
								<br/>
								<a>' . $Prod_result['proyek'] . '</a>
								<br/>
								' . $Prod_result['nama_proyek'] . ' (' . $Prod_result['lokasi'] . ')
								<br/>
								' . $Prod_result['tahun'] . '
								</div>
						</div>
					</a>
				</div>';
			}
		} else {
			echo "<h1>Belum ada data</h1>";
		}
	}
	?>
</div>