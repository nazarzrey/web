<?php
$hdr_page   = $db->escape($_GET[$page]);
$Redirected = $hdr_page . "/";
?>
<style>

</style>
<div class="aktual">
	<div class="utama">
		<div class="aktual_hdr cl_akt1">Info utama</div>
		<div style="overflow:auto;height:500px;" class="xutama">
			<?php
			$cek_favorit = "select id_judul,judul from content_dtl where aktif='Y' and utama='Y' order by upd_rec limit 20";
			if ($sql = $db->select($cek_favorit)) {
				$query_data = $sql;
				foreach ($query_data as $hsl_data) {
					echo "<div class='news'><a href='" . $Redirected . $hsl_data['id_judul'] . ".html'>" . ucfirst(strtolower(trim(paragrap($hsl_data['judul'], 5)))) . "</a></div>";
				}
			} else {
				log_error($Redirected, $cek_favorit);
			}
			?>
		</div>
	</div>
	<div class="favorit">
		<div class="aktual_hdr cl_akt2">Info favorit</div>
		<div style="overflow:auto;height:500px;" class="xfavorit">
			<?php
			$cek_favorit = "select id_judul,judul from view_favorit limit 20";
			if ($sql = $db->select($cek_favorit)) {
				$query_data = $sql;
				foreach ($query_data as $hsl_data) {
					echo "<div class='news'><a href='" . $Redirected . $hsl_data['id_judul'] . ".html'>" . ucfirst(strtolower(trim(paragrap($hsl_data['judul'], 5)))) . "</a></div>";
				}
			} else {
				log_error($Redirected, $cek_favorit);
			}
			?>
		</div>
	</div>
	<div class="new">
		<div class="aktual_hdr cl_akt2">Info terbaru</div>
		<div style="overflow:auto;height:500px;" class="xnew">
			<?php
			$cek_favorit = "select id_judul,judul from content_dtl where aktif='Y' order by upd_rec limit 20";
			if ($sql = $db->select($cek_favorit)) {
				$query_data = $sql;
				foreach ($query_data as $hsl_data) {
					echo "<div class='news'><a href='" . $Redirected . $hsl_data['id_judul'] . ".html'>" . ucfirst(strtolower(trim(paragrap($hsl_data['judul'], 5)))) . "</a></div>";
				}
			} else {
				log_error($Redirected, $cek_favorit);
			}
			?>
		</div>
	</div>
</div>