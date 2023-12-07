<?php

$pecah = explode('-', $id_content);
$total_data = count($pecah);
$cari = "";
$z = 1;
foreach ($pecah as $pecahin) {
	if ($z != $total_data) {
		$cari .= "%" . $pecahin . "%' or judul like '";
	} else {
		$cari .= " %" . $pecahin . "%";
	}
	$z++;
}
$query = "select * from content_dtl where id_judul!='$id_content' and (judul like '$cari') and aktif='Y' order by upd_rec desc limit 12";
$cek_data   = $db->select($query);
if (count($cek_data) != 0) {
?>

	<div class="content-terkait" style="width:100%;height:auto;margin:0;">
		<!-- <div style="border-bottom:double 3px #ccc;font-size:14px;margin-bottom:5px;">Info terkait</div> -->

		<?php
		foreach ($cek_data as $hsl_data) {
			$img = trim($hsl_data["img_content"]);
			if (!empty($img) and file_exists($path_img . $img)) {
		?>
				<div class="terkait-dtl">
					<a href="<?= "news/" . $hsl_data["id_judul"] . ".html"; ?>" class="more_x">
						<img u="image" data-src="<?= $path_img . $img; ?>" width="100%" />
						<div class='over2'><?= strtoupper($hsl_data["judul"]); ?></div>
					</a>
				</div>
			<?php
			} else {
			?>
				<div class="terkait-dtl">
					<a href="<?= "news/" . $hsl_data["id_judul"] . ".html"; ?>">
						<b style="padding:3px;"><?= $hsl_data["judul"]; ?></b>
						<p><?= paragrap($hsl_data["isi"], 16) . "..."; ?></p>
					</a>
				</div>
		<?php
			}
		}
		?>
		<!-- </div> -->
	</div>
<?php } ?>