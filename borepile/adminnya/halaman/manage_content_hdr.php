<?php
require_once "../seting/convert_image.php";
$wmax1 = 750;
$hmax1 = 750;
$wmax3 = 250;
$hmax3 = 250;
$wmax5 = 75;
$hmax5 = 75;
if (!isset($content_hdr)) {
	die("<h1>content_hdr tidak di set</h1>");
}
?>
<script type="text/javascript" src="../skrip/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		nicEditors.allTextAreas()
	});
</script>
<?php

$hdr_page   = escape($_GET[$page]);
$Redirected = $get_page . "=" . $hdr_page;
$table 		= "content_other";
$column		= "content_dtl";
$get_id 	= "id_content";
$get_fk_id 	= escape($content_hdr);
$get_content = select_data_func($table, $column, $get_id, $get_fk_id, $Redirected);
?>
<div style="background:white;padding:5px;border:#ddd solid 1px;overflow:auto;margin-bottom:5px;">
	<form method="post" action="" enctype="multipart/form-data">
		<textarea name='isi' id='isi' required style="max-height:100px;background:#fff;" class="textarea w98"><?= $get_content; ?></textarea>
		<input type='submit' class='input wx150 button3' style="margin:2px;float:left" name='simpan' id='simpan' value="Simpan Data" />

		<?php
		/*
		if($get_fk_id=="workshop"){
		?>
		<a href="<?= base_url($Redirected); ?>&action=galery">
		<div id="add" style="padding:4px;float:left; border-radius:5px;margin-top:2px;" class="button4">
			<img src="../gambar/add2.png" class="add_icon" style="float:left;width:20px"><label  style="margin:3px;float:left">Add Galery <?= $get_fk_id; ?></label>
		</div>
		</a>
		<?php } 
		*/
		?>
	</form>
	<?php
	if (isset($_POST["simpan"])) {
		$isi = trim($_POST["isi"]);
		if (strlen($isi) == 0) {
			$Msg = "Isian masih ada yang kosong";
		} else {
			$upd_column = "upd_rec='" . date('Y-m-d H:i:s') . "',user_add='$Ms_id',$column='$isi',galeri='$get_fk_id'";
			$Msg = update_data_func($table, $upd_column, $get_id, $get_fk_id, $Redirected);
		}
		if ($Msg != "Y") {
	?>
			<script>
				alert("<?= $Msg; ?>");
			</script>
		<?php
		} else {
			if (isset($Msg2)) {
				$Msgx = "<br/>" . $Msg2;
				$timeout = 1000;
			} else {
				$Msgx = "";
				$timeout = 500;
			}
		?>
			<script>
				alert("Sukses....! <?= $Msgx; ?>");
				setTimeout(
					function() {
						window.location.href = "<?= base_url($Redirected); ?>";
					},
					<?= $timeout; ?>);
			</script>
	<?php
		}
	}
	?>
</div>
<?php
if ($get_fk_id == "workshop") {
	$content 	= "workshop";
	require_once "halaman/manage_galery.php";
}
?>