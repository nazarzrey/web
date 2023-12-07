<style>
	.ipro {
		width: 300px;
		border: solid 1px #ccc;
		box-shadow: 0 0 5px #ddd;
		border-radius: 2px;
		font-family: courier;
	}

	#name-list input {
		margin: 2px;
		padding: 2px;
		padding-left: 5px;
		font-family: courier;
	}

	#name-list select {
		margin: 2px;
		padding: 2px;
		padding-left: 5px;
		width: 160px;
		font-family: courier;
	}

	.ro {
		background-color: #ddd;
	}

	.box-del {
		width: 450px;
		padding: 5px;
		background-color: orange;
		position: relative;
		box-shadow: 0 0 2px orange;
		border: solid 1px #888;
		overflow: auto;
	}

	.img_Tags_x {
		border: solid 1px blue;
		position: absolute;
		margin-left: 320px;
		margin-top: -128px;
		height: 150px;
	}

	.content {
		height: 25px;
	}

	.tags td {
		border: solid 1px #ccc;
		padding: 5px
	}

	.action {
		height: auto;
		width: 500px;
		position: absolute;
		top: 50px;
		padding: 10px;
		line-height: 30px;
		box-shadow: 0 0 5px #888;
		overflow: auto;
		background: #eef4f7;
		z-index: 1;
	}

	.action_in {
		height: 100px;
		border: solid 1px #ccc;
		box-shadow: 0 0 5px #888;
		background-color: #FFFFCC;
		opacity: 0.8;
		float: left;
		min-width: 100%;
	}

	.X_close {
		text-decoration: none;
		color: white;
		background-color: red;
		font-weight: bold;
		font-size: 16px;
		padding: 0 10px;
		border-radius: 5px;
		float: right;
		margin-top: -5px;
		margin-right: -5px;
		box-shadow: 0 0 3px red;
	}
</style>
<div>
	<?php
	if (!isset($_GET['action'])) {
	?>
		<div style="margin:10px;">
			<a href="?halaman=keywords&action=add_tags" class="button1" style="padding:5px 10px;border-radius:5px;">Add Tags</a>
		</div>
		<div style="margin:10px" class="tags">
			<table>
				<tr>
					<td>No</td>
					<td>Urut</td>
					<td>Kata Kunci</td>
					<td>Action</td>
				</tr>
				<?php
				$tags_query = $db->select("select *FROM key_tags ORDER BY urut asc ");
				$no = 1;
				foreach ($tags_query as $tags_result) {
					$angka =  $no;
					if ($angka % 2 == 1) {
						$warna = 'style="background-color:#B5E9FF"';
					}
					if ($angka % 2 == 0) {
						$warna = 'style="background-color: #DDF8FF"';
					}
					$url = "<a href='?halaman=keywords&action=edit_tags&tags_id=$tags_result[deskripsi]'>Edit</a>";
					$url2 = "<a href='?halaman=keywords&action=dele_tags&tags_id=$tags_result[deskripsi]'>Delete</a>";
					echo '
			<tr class="">
				<td ' . $warna . '>' . $no . '</td>
				<td id="name-list_x" class="x10" ' . $warna . '>' . $tags_result["urut"] . '</td>
				<td id="name-list_x" class="x10" ' . $warna . '>' . $tags_result["deskripsi"] . '</td>
				<td id="name-list_x" class="x5x" ' . $warna . '>' . $url . ' | ' . $url2 . '</td>
			</tr>';
					$no++;
				}
				?>
			</table>
		</div>
		<?php
	} else {
		if ($_GET['action'] == "add_tags") {
		?>
			<div class='action' style='border-color:green'>
				<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
					Form Tambah
				</span>
				<span><a href="?halaman=keywords" class="X_close">X</a></span>
				<hr width="97%" align="center" color="orange" style="float:left;">
				<br />
				<form method="post" action="" enctype="multipart/form-data">
					<table class="action_in">
						<tr>
							<td>Urut</td>
							<td>
								<?php
								$recid_tags = $db->select("select MAX(IFNULL(urut,'1')+1) as maxi FROM key_tags");
								if ($recid_tags) {
									echo "<select name='urut'>";
									foreach ($recid_tags as $key => $recid_tags_x) {
										echo "<option value='$recid_tags_x[maxi]'>$recid_tags_x[maxi]</option>";
									}
									echo "</select>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Content</td>
							<td><input type="text" name="C_tags" required="required" maxlength='50' class="ipro" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="save_tags" value="Simpan Data Tags" class='button_s'></td>
						</tr>
					</table>
				</form>
				<?php
				if (isset($_POST["save_tags"])) {
					if (empty($_POST["C_tags"])) {
						$msg = "Maaf Data masih kosong";
					} else {
						$tags_cek = count($db->select("select * from key_tags where deskripsi='$_POST[C_tags]'"));
						if ($tags_cek == 0) {
							$tags_insert = $db->query("insert into key_tags values('$_POST[urut]','$_POST[C_tags]')");
							if ($tags_insert) {
								$msg = "Data sudah di simpan";
							} else {
								$msg = "Gagal simpan, coba lagi";
							}
						} else {
							$msg = "Data sudah ada";
						}
					}
					echo "<msg>$msg</msg>";
					echo '<meta http-equiv="refresh" content="1;?halaman=keywords">';
				}
				?>
			</div>
		<?php
		} elseif ($_GET['action'] == "edit_tags") {
		?>
			<div class='action' style='border-color:blue'>
				<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
					Form Edit
				</span>
				<span><a href="?halaman=keywords" class="X_close">X</a></span>
				<hr width="97%" align="center" color="orange" style="float:left;">
				<br />
				<?php
				$sql = "select * from key_tags where deskripsi='$_GET[tags_id]'";
				$Etag_cek = $db->select($sql)[0]; //or die (mysql_error());
				?>
				<form method="post" action="" enctype="multipart/form-data">
					<table class="action_in">
						<tr>
							<td>Urut</td>
							<td>
								<?php
								$recid_tags = $db->select("select distinct urut from key_tags");
								if ($recid_tags) {
									echo "<select name='urut'>";
									echo "<option value='$Etag_cek[urut]'>$Etag_cek[urut]</option>";
									// $nomor = 1;
									// foreach ($recid_tags as $key => $recid_tags_x) {
									// 	echo "<option value='$recid_tags_x[urut]'>$recid_tags_x[urut] </option>";
									// 	$nomor++;
									// }
									// echo "<option value='" . $nomor . "'>" . $nomor . "</option>";
									echo "</select>";
								}
								?>
							</td>
						</tr>
						<tr>
							<td>Content</td>
							<td><input type="text" name="C_tags" class="ipro" value="<?= $Etag_cek["deskripsi"]; ?>" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="edit_tags" required="required" value="Update Kata Kunci" class='button_u'></td>
						</tr>
					</table>
				</form>
				<?php
				if (isset($_POST["edit_tags"])) {
					if (empty($_POST["C_tags"])) {
						$msg = "Maaf Data masih kosong";
					} else {
						$tags_cek = count($db->select("select * from key_tags where deskripsi='$_GET[tags_id]'"));
						if ($tags_cek == 1) {
							// if ($Etag_cek["urut"] != $_POST["urut"]) {
							// 	$sintak = "call replace_urut('$_POST[urut]','$Etag_cek[urut]','$_POST[C_tags]','$_GET[tags_id]')";
							// } else {
							$sintak = "update key_tags set urut='$_POST[urut]',deskripsi='$_POST[C_tags]' where urut='$_POST[urut]'";
							// }
							// echo $sintak;
							$tags_insert = $db->query($sintak);
							if ($tags_insert) {
								$msg = "Data sudah di update";
							} else {
								$msg = "Gagal update, coba lagi";
							}
						} else {
							$msg = "Data sudah ada";
						}
					}
					echo "<msg>$msg</msg>";
					// echo '<meta http-equiv="refresh" content="1;?halaman=keywords">';
				}
				?>
			</div>
		<?php
		} else {
		?>
			<div class='action' style='border-color:blue'>
				<span style="float:left;margin-top:5px; font-size:16px;font-weight:bold;">
					Form Delete
				</span>
				<span><a href="?halaman=keywords" class="X_close">X</a></span>
				<hr width="97%" align="center" color="orange" style="float:left;">
				<br />
				<?php
				$Etag_cek = $db->select("select * from key_tags where deskripsi='$_GET[tags_id]'")[0]; //or die (mysql_error());
				?>
				<form method="post" action="" enctype="multipart/form-data">
					<table class="action_in">
						<tr>
							<td>Recid</td>
							<td><input type="text" name="C_tags" class="ipro ro" readonly value="<?= $Etag_cek["urut"]; ?>" style="width:30px;"></td>
						</tr>
						<tr>
							<td>Content</td>
							<td><input type="text" name="C_tags" class="ipro ro" readonly value="<?= $Etag_cek["deskripsi"]; ?>" /></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="dele_tags" value="Delete kata kunci" class='button_d'></td>
						</tr>
					</table>
				</form>
				<?php
				if (isset($_POST["dele_tags"])) {
					if (empty($_POST["C_tags"])) {
						$msg = "Maaf Data masih kosong";
					} else {
						$tags_cek = count($db->select("select * from key_tags where deskripsi='$_GET[tags_id]'"));
						if ($tags_cek == 1) {
							$tags_insert = $db->query("delete from  key_tags where deskripsi='$_GET[tags_id]'");
							if ($tags_insert) {
								$msg = "Data sudah di hapus";
							} else {
								$msg = "Gagal hapus, coba lagi";
							}
						} else {
							$msg = "Data sudah ada";
						}
					}
					echo "<msg>$msg</msg>";
					echo '<meta http-equiv="refresh" content="1;?halaman=keywords">';
				}
				?>
			</div>
	<?php
		}
	}
	?>
</div>