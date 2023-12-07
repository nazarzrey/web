<div id="dialog2">
	<div class="dialog2" style="">
		<div class="dialog2_top">
			<?= $notif; ?>
			<a href="<?= $Url_direct2 . "&info_action=hapus"; ?>" class="dialog2_closed" style="margin-right:25px;">Hapus</a><a href="<?= $Url_direct; ?>" class="dialog2_closed">X</a>
		</div>
		<div class="dialog2_bot">
			<textarea readonly><?= $msg; ?></textarea>
		</div>
	</div>
</div>

<?php
if (isset($_GET["info_action"]) == "hapus") {
?>
	<div id="dialog2">
		<div class="dialog2" style="width:500px;height:auto;overflow:hidden;margin-top:150px;">
			<div class="dialog2_top">
				Hapus data informasi...!
				<a href="<?= $Url_direct2; ?>" class="dialog2_closed">X</a>
			</div>
			<div class="dialog2_bot" style="height:120px;overflow:hidden">
				<textarea readonly style="text-align:center;height:50px;overflow:hidden;"><?= $notif; ?></textarea>
				<div style="text-align:center;">
					<form method="post" action="">
						<input type="submit" name="hapus_info" value="Ya" class="submit2">
						<input type="submit" name="hapus_info" value="Tidak" class="submit2">
					</form>
					<?php
					if (isset($_GET["dtl_info2"])) {
						$id_info = $_GET["dtl_info2"];
					} elseif (isset($_GET["dtl_info"])) {
						$id_info = $_GET["dtl_info"];
					} else {
						$id_info = "";
					}
					if (!is_null($id_info)) {
						if (isset($_POST["hapus_info"])) {
							//echo $_POST["hapus_info"].$id_info;
							if ($_POST["hapus_info"] == "Ya") {
								echo "<span style='position:absolute;top:5px;color:white;font-style:italic;'>data sudah di hapus</span>";
								//echo "<script>window.location.href='".$Url_direct2."';</script>";
							} else {
								echo "<script>window.location.href='" . $Url_direct2 . "';</script>";
							}
						}
					}
					?>
				</div>
				<label class="notif_2" style="float:left;font-size:10px;"><br />Info : Apabila data info yang di hapus dari outbox, maka akan menghapus semua info kiriman dari user yang bersangkutan ke semua user yang dituju</label>
			</div>
		</div>
	</div>
<?php
}
?>