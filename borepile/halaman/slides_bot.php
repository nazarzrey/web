<style>
	.over {
		position: absolute;
		z-index: 9;
		bottom: 0px;
		font-size: 12px;
		background: #000000a6;
		width: 100%;
		padding: 3px;
		opacity: 0.8;
		filter: alpha(opacity=60);
		color: #f1f1f1;
		text-transform: uppercase;
	}

	.over:hover {
		opacity: 1;
		filter: alpha(opacity=60);
	}
</style>
<script type="text/javascript" src="skrip/slide.content.js?v2"></script>
<?php
$id_content = "201605122329562";
$query_mst 		= "select utama_max from content_hdr where id_hdr_content='$id_content'";
$cek_data_mst  	= $db->select($query_mst);
if (empty($cek_data_mst[0]['utama_max'])) {
	$max = 12;
} else {
	$max = $cek_data_mst[0]['utama_max'];
}
$query = "select * from content_dtl where id_fk_jenis='$id_content' and aktif='Y' and utama='Y' order by urut asc, upd_rec desc limit $max ";
?>
<div id="slider1_container" class="slider1_container">
	<!-- Loading Screen -->
	<div u="loading" id="slide_loading">
		<div id="slide_loading1">
		</div>
		<div id="slide_loading2">
		</div>
	</div>

	<!-- Slides Container bila ada gambar ga pake div lagi  -->

	<div u="slides" id="slider1_container_dtl">
		<?php
		$cek_data   = $db->select($query);
		foreach ($cek_data as $hsl_data) {
			$img = trim($hsl_data["img_content"]);
			if (!empty($img) and file_exists($path_img . $img)) {
		?>
				<div>
					<a href="<?= "news/" . $hsl_data["id_judul"] . ".html"; ?>" class="more_x">
						<b class='over'><?= paragrap($hsl_data["judul"], 3); ?></b>
						<img u="image" data-src="<?= $path_img . $img; ?>" width="100%" />
					</a>
				</div>
			<?php
			} else {
			?>
				<div style="margin-top:10px;">
					<a href="<?= "news/" . $hsl_data["id_judul"] . ".html"; ?>">
						<b style="padding:3px;color:#f1f1f1"><u><?= paragrap($hsl_data["judul"], 4); ?></u></b>
						<p style="padding:3px;color:#f1f1f1"><?= paragrap($hsl_data["isi"], 16) . "..."; ?></p>
					</a>
				</div>
		<?php
			}
		}
		?>
	</div>
	<!-- bullet navigator container -->
	<div u="navigator" class="jssorb03" style="position: absolute; bottom: 4px; right: 10px;">
		<!-- bullet navigator item prototype -->
		<div u="prototype" style="position: absolute; width: 20px; height: 20px; text-align:center; line-height:21px; color:white; font-size:11px;">
			<div u="numbertemplate"></div>
		</div>
	</div>
	<!-- Arrow Left -->
	<span u="arrowleft" class="jssora03l" style="width: 40px; height: 48px; top: 123px; left: 8px;"></span>
	<!-- Arrow Right -->
	<span u="arrowright" class="jssora03r" style="width: 40px; height: 48px; top: 123px; right: 15px"></span>
	<!-- Arrow Navigator Skin End -->
	<a style="display: none" href="http://www.jssor.com">Image Slider</a>
</div>