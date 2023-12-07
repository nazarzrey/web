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
		global $jam, $tgl, $ip, $brws, $Redirected;
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
		<a href="produk/' . $Prod_result['url_grup'] . '.html"><img data-src="' . $image_ico . '" class="pro_image2">
		<div class="pro2">  
				<div class="pro_font">' . $Prod_result['deskripsi'] . '</div>
		</div>
		</a>
	</div>';
	}
	?>
</div>