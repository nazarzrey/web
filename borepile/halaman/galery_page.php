<div class="isi_content" style="padding-bottom:30px;width:100%;border:none;">
	<div style="padding:20px;border:none;">
		<p style="font-size:13px;"><?php
									$Redirected = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
									?></p>
		<?php

		function cek_foto_proses($option)
		{
			global $tgl_jam, $Redirected, $path_img, $db;
			$sintak_data_proses = "SELECT gambar_utama  AS big,REPLACE(gambar_utama,'full_','thumb_') AS small FROM master_grup WHERE gambar_utama IS NOT NULL
									UNION 
									SELECT id_dtl_img AS big ,REPLACE(id_dtl_img,'full_','thumb_') AS small  FROM proyek  WHERE id_dtl_img IS NOT NULL
									UNION 
									SELECT full_file_name AS  big,thumb_file_name AS small FROM galery WHERE id_attach IN (
									SELECT galeri FROM master_grup WHERE gambar_utama IS NOT NULL
									UNION 
									SELECT galeri FROM proyek  WHERE galeri IS NOT NULL)";
			if ($sql = $db->select($sintak_data_proses)) {
				$hsl_data = count($sql);
				if (strlen($option) > 1) {
					$hsl_data = $hsl_data;
				} else {
					if ($hsl_data > 0) {
						echo "<div class='row'>";
						echo "<div class='galcolumn'>";
						$z = 1;
						$rms = ceil(count($sql) / 4);
						foreach ($sql as $key => $data_foto) {
							$cek_img_icon = $data_foto['small'];
							$cek_img_full = $data_foto['big'];
							if (file_exists($path_img . $cek_img_icon)) {
								$thumb_img = $path_img . $cek_img_icon;
							} else {
								if (file_exists($path_img . $cek_img_full)) {
									$thumb_img = $path_img . $cek_img_full;
								} else {
									$thumb_img = "gambar/no_image.jpg";
								}
							}
							if (file_exists($path_img . $cek_img_full)) {
								$full_img = $path_img . $cek_img_full;
							} else {
								$full_img = "gambar/no_image.jpg";
							}
		?>
							<a onclick="OpenPopupCenter('<?= $full_img; ?>', 'TEST!?', 480, 320);return false;">
								<img data-src="<?= $thumb_img; ?>" style='width:100%'>
							</a>
		<?php
							if ($z == $rms) {
								// echo $z;
								echo "<br/>";
								echo "</div><div class='galcolumn'>";
								$z = 0;
							} else {
								// echo $z;
							}
							$z++;
							/* 		?>
							<div class="pro_int">
								
							</div>
		<?php */
						}
						echo "</div>";
						echo "</div>";
					}
				}
			} else {
				$hsl_data = "Error sintak";
				log_error($Redirected, $sintak_data_proses);
			}
			return $hsl_data;
		}
		?>
		<div id="update_picture">
			<div style='overflow:auto;padding:2px;margin:2px;'>
				<?php cek_foto_proses("A"); ?>
			</div>
		</div>
	</div>
</div>