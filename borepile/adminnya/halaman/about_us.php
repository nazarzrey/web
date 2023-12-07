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
$get_fk_id 	= "about_us";
$get_content = select_data_func($table, $column, $get_id, $get_fk_id, $Redirected);
?>
<div style="background:white;padding:5px;border:#ddd solid 1px">
	<form method="post" action="" enctype="multipart/form-data">
		<textarea name='isi' id='isi' required style="max-height:100px;background:#fff;" class="textarea w98"><?= $get_content; ?></textarea>
		<input type='submit' class='input wx150 button3' style="margin:2px;" name='simpan' id='simpan' value="Simpan Data" />
	</form>
	<?php
	if (isset($_POST["simpan"])) {
		$isi = trim($_POST["isi"]);
		if (strlen($isi) == 0) {
			$Msg = "Isian masih ada yang kosong";
		} else {
			$upd_column = "upd_rec='" . date('Y-m-d H:i:s') . "',user_add='$Ms_id',$column='$isi'";
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