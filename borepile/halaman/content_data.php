<div style="max-height:100%;overflow:auto;" class="xcontent_dtl1">
	<?php
	if (!isset($_GET["page"])) {
		die();
	}
	$hdr_page   = $db->escape($_GET[$page]);
	$Redirected = $get_page . "=" . $hdr_page;
	require_once "seting/browser.php";
	$tgl  = date("Y-m-d");
	$jam  = date("H:i:s");
	$ip   = getenv("REMOTE_ADDR");
	$brws = $browser_name;
	function favorit($content_id)
	{
		global $jam, $tgl, $ip, $brws, $Redirected, $db;
		$jam_query = "DATE_FORMAT(upd_rec,'%Y-%m-%d')='$tgl'";
		#$jam_query = "substr(upd_rec,1,16)=substr('$jam',1,16)";
		$data_ready = "select 1 from favorit_content where $jam_query and ip_address='$ip' and browser='$brws' and id_fk_content in (select id_dtl_content from content_dtl where id_judul='$content_id')";
		$cek_data = $db->select($data_ready);
		if ($cek_data) {
			if (count($cek_data) == 0) {
				$kosong = "insert into favorit_content select id_dtl_content,'$tgl $jam','$ip','$brws' from content_dtl where id_judul='$content_id'";
				$insert_data = $db->query($kosong);
				if (!$insert_data) {
					log_error($Redirected, $kosong);
				}
			}
		} else {
			log_error($Redirected, $data_ready);
		}
	}
	if (!isset($_GET["ct"])) {
		require_once "halaman/berita_aktual.php";
	} else {
		$id_content =  $db->escape($_GET["ct"]);
		favorit($id_content);
		#break;
		$query = "select * from content_dtl where id_judul='$id_content' and aktif='Y' order by upd_rec limit 10 ";
		$cek_data   = $db->select($query);
		$hsl_data = $cek_data;
		$img = trim($hsl_data[0]["img_content"]);
		echo '<div class="open_content_data w100">';
		if (!empty($img) and file_exists($path_img . $img)) {
			#echo $path_img.$img;
	?>
			<img data-src="<?= $path_img . $img; ?>" />
			<div class="judul"><?= $hsl_data[0]["judul"]; ?></div>
			<p>
				<?= "<i>" . $hsl_data[0]["upd_rec"] . "</i>
			<textarea readonly class='textarea2 w100' style='height:100%'>" . $hsl_data[0]["isi"] . "</textarea>"; ?>
			</p>
		<?php
		} else {
		?>
			<div class="judul"><?= $hsl_data[0]["judul"]; ?></div>
			<p>
				<?= "<i style='font-size:10px;color#999;'>" . $hsl_data[0]["upd_rec"] . "</i><br/><textarea readonly class='textarea2 w100'  style='height:100%'>" . $hsl_data[0]["isi"] . "</textarea>"; ?>
			</p>
	<?php
		}
		echo '</div>';
		require_once "halaman/terkait.php";
	}
	?>
</div>