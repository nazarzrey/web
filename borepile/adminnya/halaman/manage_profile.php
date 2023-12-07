<?php
$Redirected = $get_page . "=" . $_GET["halaman"];
#echo "kecamatan";
$table     	= "master_user";
$cek_id    	= "id_user";
$field2		= "user_name";
$field3		= "nama";
$field4		= "email";
$field5		= "password";
?>
<div style="max-height:500px;overflow:auto;" class="content_dtl2_admin">
	<?php
	function ready_data($field)
	{
		global $Ms_id, $table, $cek_id, $db;
		$cek_data = $db->select("select $field from $table where $cek_id='$Ms_id'");
		if ($cek_data) {
			$hsl_data = $cek_data[0][$field];
		} else {
			$hsl_data = "";
		}
		return $hsl_data;
	}
	function administrator()
	{
		global $Ms_id, $adeliaabizar;
		if ($Ms_id == $adeliaabizar) {
			echo "readonly";
		}
	}
	?>
	<form method="post" action="" enctype="multipart/form-data">
		<table border="1">
			</tr>
			<tr>
				<td width="10%" class="td_right">Id User</td>
				<td>
					<input type='text' class='input wx150' name='post_1' id='post_1' readonly maxlength="20" autocomplete="off" placeholder="*" value="<?= ready_data($cek_id); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">User Name</td>
				<td>
					<input type='text' class='input wx200' required name='post_2' id='post_2' <?php administrator() ?> maxlength="20" autocomplete="off" placeholder="*" value="<?= ready_data($field2); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Full Name</td>
				<td>
					<input type='text' class='input wx250' required name='post_3' id='post_3' maxlength="20" autocomplete="off" placeholder="*" value="<?= ready_data($field3); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Email</td>
				<td>
					<input type='text' class='input wx350' required name='post_4' id='post_4' maxlength="50" autocomplete="off" placeholder="*" value="<?= ready_data($field4); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">New Password</td>
				<td>
					<input type='password' class='input wx200' name='post_5' id='post_5' <?php administrator() ?> maxlength="20" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Re New Password</td>
				<td>
					<input type='password' class='input wx200' name='post_6' id='post_6' <?php administrator() ?> maxlength="20" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type='submit' class='input wx150 button4' name='simpan' id='simpan' value="Simpan Data" />
				</td>
				</td>
		</table>
	</form>
	<?php
	if (isset($_POST["simpan"])) {
		$post_1 = escape($_POST["post_1"]);
		$post_2 = escape($_POST["post_2"]);
		$post_3 = escape($_POST["post_3"]);
		$post_4 = escape($_POST["post_4"]);
		$post_5 = escape($_POST["post_5"]);
		$post_6 = escape($_POST["post_6"]);
		if (empty($post_2) || empty($post_3) || empty($post_4)) {
			$Msg = "Ada data yang masih kosong";
		} else {
			$field_cek2 = $post_2;
			$field_cek3 = $post_3;
			$field_cek4 = $post_4;
			if (!empty($post_5)) {
				$pass1 = md5($post_5);
				$pass2 = md5($post_6);
				if ($pass1 <> $pass2) {
					$Msg = "Password tidak sesuai";
				} else {
					$pass_save = encrypt_pass(md5($post_5));
					$edit_data = "update $table set $field2='$field_cek2',$field3='$field_cek3',$field4='$field_cek4',$field5='$pass_save' where $cek_id='$Ms_id'";
					#break;
					if ($db->query($edit_data)) {
						$Msg = "Y";
						$Msg2 = "Silahkan login kembali";
						$Redirected = $get_page . "=keluar";
					} else {
						$Msg = "error sintak";
					}
				}
			} else {
				$xa = "select 1 from $table where $cek_id='$Ms_id'";
				$cek_data_exists = mysql_query($xa);
				if (count($cek_data_exists) == 1) {
					$edit_data = "update $table set $field2='$field_cek2',$field3='$field_cek3',$field4='$field_cek4' where $cek_id='$Ms_id'";
					if ($db->query($edit_data)) {
						$Msg = "Y";
						$Redirected = $get_page . "=keluar";
						$Msg2 = "Silahkan login kembali";
					} else {
						$Msg = "error sintak";
					}
				} else {
					$Msg = "$content $field_cek1 tidak ada didatabae";
				}
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
				$timeout = 2500;
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