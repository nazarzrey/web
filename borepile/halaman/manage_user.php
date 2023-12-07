<?php
$Redirected = "?halaman=" . $_GET["halaman"];
#echo "kecamatan";
$table     = "pu_master_user";
$id_data   = "call id_alamat()";
$field1    = "user_name";
$field2    = "nama";
$field3    = "email";
$field4    = "user_grup";
$field5    = "telp";
$cek_pass  = "password";
$cek_id    = "id_user";
$content   = "User";
$post_x    = "a";
$query     = "SELECT a.id_user,a.user_name,a.nama,a.email,a.user_grup,a.aktif,COUNT(DISTINCT(b.id_user)) AS total
			FROM pu_master_user a LEFT OUTER JOIN pu_log_user b
			ON a.id_user=b.id_user
			GROUP BY a.id_user
			ORDER BY a.nama";
#where a.id_user!='$Ms_id'
$cek_row = "ada " . count($db->select($query)) . " data " . $content;
$hdr_table = "<tr><td class='td_hdr'>No</td><td class='td_hdr'>Login</td><td class='td_hdr'>Nama</td><td class='td_hdr wx50'>Grup</td><td class='td_hdr w10'>Aktif</td><td class='td_hdr w10'>Used</td><td class='td_hdr wx60'>Action</td></tr>";
function cek_admin($data)
{
	global $adeliaabizar;
	if ($data == $adeliaabizar) {
		echo "<h1> User Administrator tidak bisa di ubah2</h1>";
		die;
		return;
	}
}
?>
<div style="max-height:500px;overflow:auto;" class="content_dtl2_admin">
	<?php if (!isset($_GET["action"])) { ?>
		<a href="<?= $Redirected . "&action=add"; ?>">
			<div id="add" style="padding:5px;float:left; border-radius:5px;margin-bottom:5px;" class="button4">
				<img src="../gambar/add2.png" class="add_icon" style="float:left;width:20px"><label style="margin:3px;float:left">Add User</label>
			</div>
		</a>
		<div class="data_exists"><?= $cek_row; ?></div>
		<div class="icon_notif"><span style='float:left'><a class='edit'></a> Edit </span> <span style='float:left'> <a class='delete'></a> Hapus </span> <span style='float:left'><a class='reset'></a> Reset Password </span></div>
		<div id="list_result" style="max-height:450px;overflow:auto;width:100%;">
			<?php
			$cek_list_data = $db->select($query);
			echo "<table>";
			echo $hdr_table;
			$x = 1;
			while ($hsl_list_data = mysql_fetch_array($cek_list_data)) {
				if ($hsl_list_data["aktif"] == "Y" and $hsl_list_data["total"] != 0) {
					$style_aktif = "style='color:#006ab4';";
					$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'>";
				} elseif ($hsl_list_data["aktif"] == "Y" and $hsl_list_data["total"] == 0) {
					$style_aktif = "style='color:#006ab4';";
					$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[0]' class='delete'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'></a></a>";
				} elseif ($hsl_list_data["aktif"] == "N" and $hsl_list_data["total"] != 0) {
					$style_aktif = "style='color:#828282;'";
					$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'>";
				} elseif ($hsl_list_data["aktif"] == "N" and $hsl_list_data["total"] == 0) {
					$style_aktif = "style='color:#d46e04;'";
					$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[0]' class='delete'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'></a></a>";
				} else {
					$style_aktif = "style='color:red;'";
					$url_action = "";
				}
				#echo $hsl_list_data["id_user"]."-".$adeliaabizar;
				if ($hsl_list_data["id_user"] == $adeliaabizar || $hsl_list_data["id_user"] == $Ms_id) {
					$url_action = "";
				} else {
					if ($Ms_id == $adeliaabizar) {
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[0]' class='delete'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'></a></a>";
					} else {
						if ($hsl_list_data["user_grup"] != "admin") {
							$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[0]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[0]' class='delete'></a><a href='$Redirected&action=reset&data_dtl=$hsl_list_data[0]' class='reset'></a></a>";
						} else {
							$url_action = $url_action;
						}
					}
				}
				echo "<tr class='tr'><td class='right'  $style_aktif>$x</td><td class='right'  $style_aktif>" . $hsl_list_data[1] . "</td><td  $style_aktif>" . $hsl_list_data[2] . "</td><td $style_aktif>" . $hsl_list_data[4] . "</td><td  $style_aktif>$hsl_list_data[aktif]</td><td>$hsl_list_data[total]</td><td>$url_action</td></tr>";
				$x++;
			}
			?>
		</div>
	<?php
	} else {
		if (isset($_GET["data_dtl"])) {
			$data_dtl = escape($_GET["data_dtl"]);
		} else {
			$data_dtl = "data tidak ada";
		}
		cek_admin($data_dtl);
		if ($_GET["action"] == "add") {
			$hdr_notif = "Tambah";
			$button    = "button3";
			$select     = '<option value="Y">Y</option>';
			$catatan    = "<i style='color:blue'>* Password default user baru adalah 123</i>";
			$input_tipe = "";
			$input_btn  = "Simpan";
		} elseif ($_GET["action"] == "delete") {
			$hdr_notif = "delete";
			$button    = "button5";
			$select     = '<option value="X">X</option>';
			$catatan    = "<i style='color:red'>* Akan di hapus permanen, karena belum pernah login</i>";
			$input_tipe = "readonly";
			$input_btn  = "Delete";
		} elseif ($_GET["action"] == "edit") {
			$hdr_notif = "edit";
			$button    = "button2";
			$select     = '<option value="Y">Y</option><option value="N">N</option>';
			$catatan    = "";
			$input_tipe = "";
			$input_btn  = "Simpan";
		} elseif ($_GET["action"] == "reset") {
			$hdr_notif = "reset";
			$button    = "button1";
			$select     = '<option value="Y">Y</option><option value="N">N</option>';
			$catatan    = "<i style='color:blue'>* merubah default password jadi 123</i>";
			$input_tipe = "";
			$input_btn  = "Reset Password";
		} else {
			die();
		}
		#echo $data_dtl;
		#global $Var_url,$Url_back,$id,$page_num,$msg_stat;
		function cek_post_user($data_post, $field)
		{
			if ($_GET["action"] == "add") {
				if (isset($_POST[$data_post])) {
					echo escape($_POST[$data_post]);
				}
			} else {
				global $data_dtl, $table, $cek_id;
				$query1 = "select distinct($field) from $table where $cek_id='$data_dtl'";
				$cek_data_exists1 = mysql_query($query1);
				if (count($cek_data_exists1) == 1) {
					echo mysql_fetch_array($cek_data_exists1)[0];
				} else {
					echo "data tidak ada";
				}
			}
		}
		function cek_status()
		{
			if ($_GET["action"] != "add") {
				global $data_dtl, $table, $cek_id;
				$query1 = "select distinct(aktif) from $table where $cek_id='$data_dtl'";
				$cek_data_exists1 = mysql_query($query1);
				if (count($cek_data_exists1) == 1) {
					$data_result = mysql_fetch_array($cek_data_exists1)[0];
					echo "<input type='text' class='input wx25' readonly value='" . $data_result . "'>";
				} else {
					echo "data tidak ada";
				}
			}
		}
		function readonly()
		{
			if (isset($_GET["action"])) {
				if ($_GET["action"] == "add") {
					echo "";
				} elseif ($_GET["action"] == "edit") {
					echo "";
				} else {
					echo "readonly";
				}
			}
		}
	?>
		<form method="post" action="" enctype="multipart/form-data">
			<a href="<?= $Redirected; ?>">
				<div class="<?= $button; ?>" style="padding:5px">Kembali</div>
			</a>
			<table>
				<tr>
					<td colspan="2">
						<h1 style="margin:0;padding:0;padding:8px;float:left; border-radius:5px;margin-bottom:5px;"><?= $hdr_notif . " " . $content; ?></h1>
					</td>
				</tr>
				<tr>
					<td width="10%" class="td_right">Login</td>
					<td>
						<input type='text' class='input wx250' required name='post_1' id='post_1' <?php readonly() ?> maxlength="20" autocomplete="off" placeholder="*" value="<?php cek_post_user("post_1", $field1); ?>" />
					</td>
				</tr>
				<tr>
					<td width="10%" class="td_right">Nama</td>
					<td>
						<input type='text' class='input wx250' required name='post_2' id='post_2' <?php readonly() ?> maxlength="20" autocomplete="off" placeholder="*" value="<?php cek_post_user("post_2", $field2); ?>" />
					</td>
				</tr>
				<tr>
					<td width="10%" class="td_right">Telp</td>
					<td>
						<input type='text' class='input wx250' required name='post_5' id='post_5' <?php readonly() ?> maxlength="20" autocomplete="off" onkeypress="return isNumberKey(event)" pattern="[0-9]+([,\.][0-9]+)?" placeholder="*" value="<?php cek_post_user("post_5", $field5); ?>" />
					</td>
				</tr>
				<tr>
					<td width="10%" class="td_right">Email</td>
					<td>
						<input type='text' class='input wx350' required name='post_3' id='post_3' <?php readonly() ?> maxlength="50" autocomplete="off" placeholder="*" value="<?php cek_post_user("post_3", $field3); ?>" />
					</td>
				</tr>
				<tr>
					<td width="10%" class="td_right">Grup</td>
					<td>
						<select name="post_4" class="select wx100">
							<option value="X">Pilih Grup</option>
							<option value="admin">Admin</option>
							<option value="operator">Operator</option>
							<option value="user">User</option>
						</select>
						<?php #cek_post_user("post_4",$field4); 
						?>
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
						<input type='submit' class='input wx200 button4' name='simpan' id='simpan' value="<?= $input_btn . " " . $content; ?>" />
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
			$post_4 = escape($_POST["post_4"]);
			$post_5 = escape($_POST["post_5"]);
			$status = escape($_POST["status"]);
			if ($_GET["action"] == "reset" or $_GET["action"] == "delete") {
				$cek_post = "YX";
			} else {
				if (empty($post_1) || empty($post_2) || empty($post_3) || empty($post_5) || $post_4 == "X") {
					$cek_post = "NZ";
				} else {
					$cek_post = "YZ";
				}
			}
			if (substr($cek_post, 0, 1) == "N") {
				$Msg = "Ada data yang masih kosong / belum dipilih";
			} else {
				$kolom     = "daftar,id_user,user_name,password,nama,email,user_grup,aktif,telp";
				$encrypt   = "'" . date("Y-m-d H:i:s") . "','$post_1','" . ucwords($post_2) . "','" . ucwords($post_3) . "','$status'";
				$id_data   = substr(md5($encrypt), 0, 15);
				$pass_awal = encrypt_pass(md5('123'));
				$isi_kolom     = "'" . date("Y-m-d H:i:s") . "','$id_data','$post_1','$pass_awal','" . ucwords($post_2) . "','$post_3','$post_4','$status','$post_5'";
				$field_cek1 = $post_1;
				$field_cek2 = $post_2;
				$field_cek3 = $post_3;
				$field_cek4 = $post_4;
				$field_cek5 = $post_5;
				if ($_GET["action"] == "add") {
					$cek_data_exists = $db->select("select 1 from $table where $field1='$field_cek1' and $field2='$field_cek2' and $field3='$field_cek3'");
					if (count($cek_data_exists) == 0) {
						$insert_data = "insert into $table ($kolom) values ($isi_kolom)";
						#break;
						if ($db->query($insert_data)) {
							$Msg = "Y";
							mysql_query($id_data);
						} else {
							$Msg = "error sintak";
						}
					} else {
						$Msg = "$field_cek1 / $field_cek2 / $field_cek3<br/>sudah ada didatabae";
					}
				} elseif ($_GET["action"] == "edit") {
					$xa = "select 1 from $table where $cek_id='$data_dtl'";
					$cek_data_exists = mysql_query($xa);
					if (count($cek_data_exists) == 1) {
						$edit_data = "update $table set $field1='$field_cek1',$field2='$field_cek2',$field3='$field_cek3',$field4='$field_cek4',$field5='$field_cek5',aktif='$status' where $cek_id='$data_dtl'";
						#break;
						if ($db->query($edit_data)) {
							$Msg = "Y";
						} else {
							$Msg = "error sintak";
						}
					} else {
						$Msg = "$content $field_cek1 tidak ada didatabae";
					}
				} elseif ($_GET["action"] == "reset") {
					$xa = "select 1 from $table where $cek_id='$data_dtl'";
					$cek_data_exists = mysql_query($xa);
					if (count($cek_data_exists) == 1) {
						$edit_data = "update $table set $cek_pass='$pass_awal' where $cek_id='$data_dtl'";
						if ($db->query($edit_data)) {
							$Msg = "Y";
							$Msg2 = "password sudah di reset jadi 123";
						} else {
							$Msg = "error sintak";
						}
					} else {
						$Msg = "$content $field_cek1 tidak ada didatabae";
					}
				} elseif ($_GET["action"] == "delete") {
					$xa = "select 1 from $table where $cek_id='$_GET[data_dtl]'";
					$cek_data_exists = mysql_query($xa);
					if (count($cek_data_exists) == 1) {
						$xx = "select 1 from pu_log_user where $cek_id='$_GET[data_dtl]'";
						$cek_data_used = mysql_query($xx);
						if (count($cek_data_used) != 0 and $Ms_id != $adeliaabizar) {
							$Msg = "User sudah pernah login anda tidak bisa menghapus usernya, kecuali anda administrator";
						} else {
							#break;
							$upd_data = "delete from $table where $cek_id='$data_dtl'";
							if (mysql_query($upd_data)) {
								$Msg = "Y";
								$Msg2 = "dihapus";
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
				if (isset($Msg2)) {
					$Msgx = "<br/>" . $Msg2;
					$timeout = 1500;
				} else {
					$Msgx = "";
					$timeout = 500;
				}
			?>
				<script>
					alert("Sukses....! <?= $Msgx; ?>");
					setTimeout(
						function() {
							window.location.href = "<?= $Redirected; ?>";
						},
						<?= $timeout; ?>);
				</script>
	<?php
			}
		}
	} ?>
</div>