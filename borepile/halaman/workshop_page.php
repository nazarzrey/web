<div class="isi_content" style="padding-bottom:30px;width:100%;border:none;">
	<div style="padding:20px;border:none;">
		<p style="font-size:13px;"><?php
									$Redirected = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
									echo select_data_func("content_other", "content_dtl", "id_content", "workshop", $Redirected);
									?></p>
		<?php
		function cek_foto_proses($option)
		{
			global $tgl_jam, $Redirected, $path_img, $db;
			$sintak_data_proses = "select full_file_name,thumb_file_name,key_attach from galery where id_attach in (SELECT galeri FROM content_other where id_content='workshop') limit 100";
			if ($sql = $db->select($sintak_data_proses)) {
				$query_data = $sql;
				$hsl_data = count($query_data);
				if (strlen($option) > 1) {
					$hsl_data = $hsl_data;
				} else {
					if ($hsl_data > 0) {
						echo "<div class='row'>";
						echo "<div class='galcolumn'>";
						$z = 1;
						$rms = ceil(count($sql) / 4);
						foreach ($query_data as $data_foto) {
							$cek_img_icon = $data_foto['thumb_file_name'];
							$cek_img_full = $data_foto['full_file_name'];
							$key_attach   = $data_foto['key_attach'];
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
							/* ?>
							<div class="pro_int">
								<a onclick="OpenPopupCenter('<?= $full_img; ?>', 'TEST!?', 480, 320);return false;">
									<img src="<?= $thumb_img; ?>">
								</a>
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
			<div style='overflow:auto;adding:2px;margin:2px;'>
				<?php cek_foto_proses("A"); ?>
			</div>
		</div>
	</div>
</div>