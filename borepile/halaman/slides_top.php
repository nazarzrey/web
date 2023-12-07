<style>
	.open_content_data {
		float: left;
		width: auto;
		background: #fcfcfc;
		height: auto;
	}

	.judul {
		font-weight: bold;
		font-size: 16px;
		margin: 5px;
	}

	.open_content_data p {
		margin: 5px;
		padding: 0;
		text-align: normal;
		line-height: 20px;
	}

	.open_content_data img {
		width: auto;
		float: left;
		margin: 5px;
	}
</style>
<div id="slides">
	<div class="slides_container">
		<?php
		$id_content 	= "201605122329561";
		$query_mst 		= "select utama_max from pu_content_hdr where id_hdr_content='$id_content'";
		$cek_data_mst  	= count($db->select($query_mst));
		if (empty($cek_data_mst[0])) {
			$max = 7;
		} else {
			$max = $cek_data_mst[0];
		}
		$query = "select * from pu_content_dtl where id_fk_jenis='$id_content' and aktif='Y' and utama='Y' order by urut asc, upd_rec desc limit $max ";
		$cek_data   = $db->select($query);
		while ($hsl_data = mysql_fetch_array($cek_data)) {
			$img = trim($hsl_data["img_content"]);
			if (!empty($img) and file_exists($path_img . $img)) {
		?>
				<div class="slide">
					<span class="slide_img">
						<img src="<?= $path_img . $img; ?>" height="180px" width="100%" />
					</span>
					<span class="slide_content">
						<h2><a href="?page=news&ct=<?= $hsl_data["id_judul"]; ?>"><?= paragrap($hsl_data["judul"], 15); ?></a></h2>
						<p style="line-height:20px;"><?= paragrap($hsl_data["isi"], 25); ?></p>
						<p><a href="?page=news&ct=<?= $hsl_data["id_judul"]; ?>" class="more_x">selengkapnya...</a></p>
					</span>
				</div>
			<?php
			} else {
			?>
				<div class="slide">
					<span class="slide_content" style="width:auto;float:left">
						<h2 class="more_h2"><a href="?page=news&ct=<?= $hsl_data["id_judul"]; ?>" class="more_x"><?= paragrap($hsl_data["judul"], 15); ?></a></h2>
						<p><?= paragrap($hsl_data["isi"], 70); ?></p>
						<p class="more"><a href="?page=news&ct=<?= $hsl_data["id_judul"]; ?>" class="more_x">selengkapnya...</a></p>
					</span>
				</div>
		<?php
			}
		}
		?>
	</div>
</div>