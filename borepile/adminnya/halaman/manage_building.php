<?php
if (isset($_GET["halaman"])) {
	$Redirected = "?halaman=" . $_GET["halaman"];
	$table   = "master_grup";
	$field   = "deskripsi";
	$cek_id  = "id_grup";
	$key	 = "building";
	$content = "Bulding Proyek";
	$query   = "SELECT a.url_grup,a.id_grup,a.deskripsi,c.nama,a.aktif ,COUNT(b.id_fk_proy) AS total
				FROM $table a LEFT OUTER JOIN proyek b
				ON a.id_grup=b.id_fk_proy
				LEFT OUTER JOIN master_user c
				ON a.user_add=c.id_user
				WHERE grup='$key'
				GROUP BY a.id_grup
				ORDER BY id_grup";
	$cek_row = "ada " . count($db->select($query)) . " data " . $content;
	$hdr_table = "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx350'>Deskripsi</td><td class='td_hdr wx100'>User Add</td><td class='td_hdr w10'>Aktif</td><td class='td_hdr w10'>Proyek</td><td class='td_hdr w10'>Action</td></tr>";
?>
	<div style="max-height:500px;overflow:auto;" class="content_dtl2_admin">
		<?php if (!isset($_GET["action"])) { ?>
			<a href="<?= $Redirected . "&action=add"; ?>">
				<div id="add" style="padding:5px;float:left; border-radius:5px;margin-bottom:5px;" class="button4">
					<img src="../gambar/add2.png" class="add_icon" style="float:left;width:20px"><label style="margin:3px;float:left">Add <?= $content; ?></label>
				</div>
			</a>
			<div class="data_exists"><?= $cek_row; ?></div>
			<div class="icon_notif"><span style='float:left'><a class='edit'></a> Edit </span> <span style='float:left'> <a class='delete'></a> Hapus </span> </div>
			<div id="list_result" style="overflow:auto;width:99%;border:solid 1px #ddd">
				<?php
				$cek_list_data = $db->select($query);
				echo "<table>";
				echo $hdr_table;
				$nomor = 1;
				foreach ($cek_list_data as $hsl_list_data) {
					if ($hsl_list_data["aktif"] == "Y") {
						$style_aktif = "style='color:#006ab4';";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_grup]' class='edit'></a>";
					} elseif ($hsl_list_data["aktif"] == "N" and $hsl_list_data["total"] != 0) {
						$style_aktif = "style='color:#828282;'";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_grup]'  class='edit'></a>";
					} elseif ($hsl_list_data["aktif"] == "N" and $hsl_list_data["total"] == 0) {
						$style_aktif = "style='color:#d46e04;'";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_grup]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[id_grup]' class='delete'></a>";
					} else {
						$style_aktif = "style='color:red;'";
						$url_action = "";
					}
					echo "<tr class='tr'><td class='right'  $style_aktif>" . $nomor . "</td><td  $style_aktif>" . $hsl_list_data["deskripsi"] . "</td><td  $style_aktif>" . $hsl_list_data["nama"] . "</td><td  $style_aktif><b>$hsl_list_data[aktif]</b></td><td $style_aktif>$hsl_list_data[total]</td><td >$url_action</td></tr>";
					$nomor++;
				}
				echo "</table>";
				?>
			</div>
			<i class="notif_1">* jika <?= $content; ?> ada isinya, data tidak bisa di hapus, untuk hapus data di nonaktifkan terlebih dahulu</i>
		<?php
		} else {
			if ($_GET["action"] == "add") {
				$hdr_notif = "Tambah";
				$button    = "button3";
				$select     = '<option value="Y">Y</option><option value="N">N</option>';
				$catatan    = "";
				$input_tipe = "";
				$input_btn  = "Simpan";
			} elseif ($_GET["action"] == "delete") {
				$hdr_notif = "delete";
				$button    = "button5";
				$select     = '<option value="X">X</option>';
				$catatan    = "<i style='color:red'>* Akan di hapus permanen, karena di data laporan memang belum ada datanya</i>";
				$input_tipe = "readonly";
				$input_btn  = "Delete";
			} elseif ($_GET["action"] == "edit") {
				$hdr_notif = "edit";
				$button    = "button2";
				$select     = '<option value="Y">Y</option><option value="N">N</option>';
				$catatan    = "";
				$input_tipe = "";
				$input_btn  = "Simpan";
			} else {
				die();
			}
			if (isset($_GET["data_dtl"])) {
				$data_dtl = escape($_GET["data_dtl"]);
			} else {
				$data_dtl = "data tidak ada";
			}
			#echo $data_dtl;
			#global $Var_url,$Url_back,$id,$page_num,$msg_stat;
			function cek_post()
			{
				global $db;
				if ($_GET["action"] == "add") {
					if (isset($_POST["post_3"])) {
						echo escape($_POST["post_3"]);
					}
				} else {
					global $data_dtl, $field, $table, $cek_id;
					$query1 = "select distinct($field) from $table where $cek_id='$data_dtl'";
					$cek_data_exists1 = $db->select($query1);
					if (count($cek_data_exists1) == 1) {
						echo $cek_data_exists1[0][$field];
					} else {
						echo "data tidak ada";
					}
				}
			}
			function cek_status()
			{
				global $db;
				if ($_GET["action"] != "add") {
					global $data_dtl, $table, $cek_id;
					$query1 = "select distinct(aktif) as aktif from $table where $cek_id='$data_dtl'";
					$cek_data_exists1 = $db->select($query1);
					if (count($cek_data_exists1) == 1) {
						$data_result = $cek_data_exists1[0]["aktif"];
						echo "<input type='text' class='input wx25' readonly value='" . $data_result . "'>";
					} else {
						echo "data tidak ada";
					}
				}
			}
		?>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="<?= $button; ?>" style="padding:5px">Form <?= $hdr_notif . " " . $content; ?></div>
				<table>
					<input type="text" name="post_1" style="display:none;" />
					<input type="text" name="post_2" style="display:none;" />
					<tr>
						<td colspan='2'>&nbsp;</td>
					</tr>
					<tr>
						<td width="10%" class="td_right"><?= $content; ?></td>
						<td>
							<input type='text' class='input wx250' required name='post_3' id='post_3' maxlength="100" autocomplete="off" placeholder="*" value="<?php cek_post() ?>" />
						</td>
					</tr>
					<tr>
						<td class="td_right">Aktif</td>
						<td>
							<select name="status" class="select wx50">
								<?= $select; ?>
							</select>
							<?php cek_status() ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type='submit' class='input wx150 <?= $button; ?>' name='simpan' id='simpan' value="<?= $input_btn . " " . $content; ?>" />
							<a href="<?= $Redirected; ?>"><input type="button" class="input wx150 button4" style="margin:2px;" value='Kembali' readonly /></a>
						</td>
						</td>
				</table>
			</form>
			<?php
			echo $catatan;
			if (isset($_POST["simpan"])) {
				$post_1 = escape($_POST["post_1"]);
				$post_2 = escape($_POST["post_2"]);
				$post_3 = escape($_POST["post_3"]);
				$status = escape($_POST["status"]);
				if (empty($post_3)) {
					$Msg = "Ada data yang masih kosong";
				} else {
					$kolom = "url_grup,upd_rec,deskripsi,user_add,aktif,grup";
					$isi_kolom = "'" . strtolower(str_replace(array(' ', ',', '.'), '-', $post_3)) . "','" . date("Y-m-d H:i:s") . "','" . ucwords($post_3) . "','$Ms_id','$status','$key'";
					#$id_data   = "call id_group()";
					$field_cek = $post_3;
					if ($_GET["action"] == "add") {
						$cek_data_exists = $db->select("select 1 from $table where $field='$field_cek'");
						if (count($cek_data_exists) == 0) {
							$insert_data = "insert into $table ($kolom) values ($isi_kolom)";
							if ($db->query($insert_data)) {
								$Msg = "Y";
								#mysql_query($id_data);
							} else {
								$Msg = "error sintak";
							}
						} else {
							$Msg = "$content $field_cek sudah ada didatabae";
						}
					} elseif ($_GET["action"] == "edit") {
						$edit_data = "update $table set $field='$field_cek',aktif='$status' where $cek_id='$data_dtl'";
						if ($db->query($edit_data)) {
							$Msg = "Y";
							#mysql_query($id_data);
						} else {
							$Msg = "error sintak";
						}
					} elseif ($_GET["action"] == "delete") {
						$xa = "select 1 from $table where $cek_id='$data_dtl'";
						$cek_data_exists = $db->select($xa);
						if (count($cek_data_exists) == 1) {
							$xx = "select 1 from proyek where id_fk_proy='$data_dtl'";
							$cek_data_used = $db->select($xx);
							if (count($cek_data_used) != 0) {
								$Msg = "Data $field sudah ada datanya, jadi tidak bisa di hapus";
							} else {
								#break;
								$upd_data = "delete from $table where $cek_id='$data_dtl'";
								if ($db->query($upd_data)) {
									$Msg = "Y";
								} else {
									$Msg = "error sintak";
								}
							}
						} else {
							$Msg = "$content $field_cek tidak ada didatabae";
						}
					} else {
						die();
					}
				}
				if ($Msg != "Y") {
			?>
					<script>
						alert("<?= $Msg; ?>");
					</script>
				<?php
				} else {
				?>
					<script>
						alert("Sukses....!");
						setTimeout(
							function() {
								window.location.href = "<?= $Redirected; ?>";
							},
							2000);
					</script>
		<?php
				}
			}
		} ?>
	</div>
<?php
}
?>