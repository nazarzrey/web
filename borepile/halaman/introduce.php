<div class="isi_content" style="margin-bottom:10px;padding-bottom:20px;">
	<div style="padding:20px;">
		<p style="font-size:13px;"><?php
						echo select_data_func("content_other", "content_dtl", "id_content", "introduce", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
						?></p>
		<?php
		$table   = "view_produk_favorit";
		$field   = "deskripsi";
		$cek_id  = "id_grup";
		$key	 = "produk";
		$content = "Produk";
		$sql	 = "select * from view_produk_favorit order by ttl_view desc,id_grup limit 4";
		$Prod_query = $db->select($sql);
		foreach ($Prod_query as $Prod_result) {
			$image = $Prod_result['gambar_utama'];
			if (strlen($image) == 0 ||  !file_exists($path_img1 . $image)) {
				$image_ico = $path_img2 . "no_image.jpg";
				$image_full = $path_img2 . "no_image.jpg";
			} else {
				$image_ico = $path_img1 . str_replace('full_', 'thumb_', $image);
				$image_full = $path_img1 . $image;
			}
			echo '<div class="pro_int">	
				<a href="produk/' . $Prod_result['url_grup'] . '.html">
				<div class="pro_font">' . $Prod_result['deskripsi'] . '</div>
				<img data-src="' . $image_ico . '">
				</a>
			</div>';
		}
		?>
	</div>
</div>