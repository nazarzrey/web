<div style="margin:5px 0;overflow:auto;background:#fff;">

	<?php
	$id_content = "201605122329563";
	$query_mst 		= "select utama_max from content_hdr where id_hdr_content='$id_content'";
	$cek_data_mst  	= $db->select($query_mst);
	if (empty($cek_data_mst[0]["utama_max"])) {
		$max = 10;
	} else {
		$max = $cek_data_mst[0]["utama_max"];
	}

	$query = "select * from content_dtl where id_fk_jenis='$id_content' and aktif='Y' order by urut, upd_rec desc limit $max ";
	$cek_data   = $db->select($query);
	$nomor = 1;
	foreach ($cek_data as $hsl_data) {
		$img = trim($hsl_data["img_content"]);
		echo '<div class="content_dtl1">';
		if (!empty($img) and file_exists($path_img . str_replace("full_", "thumb_", $img))) {
			$get_url = "news/$hsl_data[id_judul].html";
	?>
			<div style="font-weight:normal;">
				<a href="<?= $get_url; ?>" class="more_z">
					<span>
						<img data-src="<?= $path_img . str_replace("full_", "thumb_", $img); ?>" />
					</span>
					<span>
						<div class='judul'>
							<?= ucwords(strtolower(paragrap($hsl_data["judul"], 10))); ?>
						</div>
						<p>
							<?= ucfirst(strtolower(paragrap($hsl_data["isi"], 20))); ?>
						</p>
					</span>
				</a>
			</div>
		<?php
		} else {
			$get_url = "news/$hsl_data[id_judul].html";
		?>
			<div style="font-weight:normal;">
				<div>
					<a href="<?= $get_url; ?>" class="more_z"><?= paragrap($hsl_data["judul"], 5); ?></a>
				</div>
				<p>
					<?= paragrap($hsl_data["isi"], 60); ?>
				</p>
				<p>
					<a href="<?= $get_url; ?>" class="more_x">selengkapnya...</a>
				</p>
			</div>
		<?php }	?>
</div>
<?php
		$nomor++;
	}
?>
</div>