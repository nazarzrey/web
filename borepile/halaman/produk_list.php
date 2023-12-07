<div style="max-height:100%;overflow:auto;" class="xcontent_dtl1">
	<?php

	$Redirected = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

	require_once "seting/browser.php";
	$tgl  	 = date("Y-m-d");
	$jam  	 = date("H:i:s");
	$ip   	 = getenv("REMOTE_ADDR");
	$brws 	 = $browser_name;
	$table   = "master_grup";
	$field   = "deskripsi";
	$cek_id  = "id_grup";
	$key	 = "produk";
	$content = "Produk";
	function prod_fav($content_id)
	{
		global $jam, $tgl, $ip, $brws, $Redirected, $db;
		$jam_query = "DATE_FORMAT(upd_rec,'%Y-%m-%d')='$tgl'";
		#$jam_query = "substr(upd_rec,1,16)=substr('$jam',1,16)";
		$data_ready = "
	SELECT 1 FROM favorit_produk WHERE $jam_query AND ip_address='::1' AND browser='Google Chrome' 
	AND id_fk_content IN (
		SELECT id_grup FROM master_grup WHERE url_grup='$content_id'
	)";
		$cek_data = $db->select($data_ready);
		if ($cek_data) {
			if (count($cek_data) == 0) {
				$kosong = "insert into favorit_produk select id_grup,'$tgl $jam','$ip','$brws' from master_grup where url_grup='$content_id'";
				$insert_data = $db->query($kosong);
				if (!$insert_data) {
					log_error($Redirected, $kosong);
				}
			}
		} else {
			log_error($Redirected, $data_ready);
		}
	}
	$Prod_query = $db->select("SELECT a.url_grup,a.id_grup,a.deskripsi,a.aktif,a.konten,a.gambar_utama,a.galeri,COUNT(b.id_fk_proy) AS total
				FROM $table a LEFT OUTER JOIN proyek b
				ON a.id_grup=b.id_fk_prod
				WHERE grup='$key'
				GROUP BY a.id_grup
				ORDER BY id_grup");
	if (isset($_GET['prod_dtl'])) {
		$get_id = $db->escape($_GET['prod_dtl']);
		prod_fav($get_id);
		$sintak1 = "SELECT url_grup,deskripsi,konten,gambar_utama,galeri FROM master_grup WHERE grup='produk' and url_grup='$get_id'";
		$Prdt_result  = $db->select($sintak1);
		if (count($Prdt_result) == 0) {
			echo "data tidak di temukan";
		} else {
			$image = $Prdt_result[0]['gambar_utama'];
			if (strlen($image) == 0 ||  !file_exists($path_img1 . $image)) {
				$image_ico = $path_img2 . "no_image.jpg";
				$image_full = $path_img2 . "no_image.jpg";
			} else {
				$image_ico = $path_img1 . str_replace('full_', 'thumb_', $image);
				$image_full = $path_img1 . $image;
			}
	?>
			<div class="pro_dtl1">
				<img src="<?= $image_full; ?>" class="pro_image">
				<div style='height:auto;overflow:auto; float:left;'>
					<?php
					$sintak2 = "SELECT full_file_name,base_name FROM galery WHERE id_attach='" . $Prdt_result[0]['galeri'] . "'";
					$Prod_dtl_query  = $db->select($sintak2);
					foreach ($Prod_dtl_query as $Prod_dtl_result) {
						$Img_full = $path_img1 . $Prod_dtl_result['full_file_name'];
						if (!file_exists($Img_full) || strlen($Prod_dtl_result['full_file_name']) == 0) {
							$image_ico_x = $path_img2 . "no_image.jpg";
							$image_full_x = $path_img2 . "no_image.jpg";
						} else {
							$image_ico_x = $path_img1 . str_replace('full_', 'thumb_', $Prod_dtl_result['full_file_name']);
							$image_full_x = $path_img1 . $Prod_dtl_result['full_file_name'];
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
				<b class='color66 font_1' style="float:left;padding-bottom:5px; border-bottom:solid 5px #0064ab;font-size:28px;">
					<?= strtoupper($Prdt_result[0]['deskripsi']); ?></b>&nbsp;
				<p />&nbsp;
				<p />
				<?php
				?>
				<?= "<p class='font12 font_c color66'>" . $Prdt_result[0]['konten'] . "</p>"; ?>
				<p />&nbsp;
				<h3 style="padding-bottom:5px; border-bottom:solid 2px #0064ab;">List Proyek - <?= $Prdt_result[0]['deskripsi'] ?></h3>
				<div style="padding:5px;">
					<?php
					$sintak = "
						SELECT a.url_dtl,a.nama_proyek,b.url_grup,b.deskripsi AS produk,a.galeri FROM
						proyek a LEFT OUTER JOIN master_grup b
						ON a.id_fk_prod=b.id_grup 
						WHERE b.url_grup='$get_id'
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
		foreach ($Prod_query as $Prod_result) {
			$image = $Prod_result['gambar_utama'];
			if (strlen($image) == 0 ||  !file_exists($path_img1 . $image)) {
				$image_ico = $path_img2 . "no_image.jpg";
				$image_full = $path_img2 . "no_image.jpg";
			} else {
				$image_ico = $path_img1 . str_replace('full_', 'thumb_', $image);
				$image_full = $path_img1 . $image;
			}
			echo '<div class="pro">	
				<a href="produk/' . $Prod_result['url_grup'] . '.html"><img src="' . $image_ico . '" class="pro_image2">
				<div class="pro2">  
						<div class="pro_font">' . $Prod_result['deskripsi'] . '</div>
				</div>
				</a>
			</div>';
		}
	}
	?>
</div>