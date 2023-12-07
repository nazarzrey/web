<script type="text/javascript">
	function GetFileInfo() {
		var attach = document.getElementById("attach");
		var xsize = 0;
		var re = /(?:\.([^.]+))?$/;
		for (i = 0; i < attach.files.length; i++) {
			var file = attach.files[i];
			if ('name' in file) {
				Nfile = file.name;
			} else {
				Nfile = file.fileName;
			}
			Ext = re.exec(Nfile.toLowerCase())[1];
			if (Ext !== "png") {
				$("#simpan").prop('disabled', true);
				$("#simpan").removeClass('button4').addClass('button_disable');
				AdAb = "X";
			} else {
				AdAb = "Y";
			}
			if ('size' in file) {
				xsize += file.size;
			} else {
				xsize += file.fileSize;
			}
		}
		var Asize = 1024000;
		var fSExt = new Array('Bytes', 'KB', 'MB', 'GB');
		fSize = xsize;
		i = 0;
		while (fSize > 900) {
			fSize /= 1024;
			i++;
		}
		var ttl_size1 = (Math.round(fSize * 100) / 100) + ' ' + fSExt[i];
		AfSize = Asize;
		i = 0;
		while (AfSize > 900) {
			AfSize /= 1024;
			i++;
		}
		var ttl_size2 = (Math.round(AfSize * 100) / 100) + ' ' + fSExt[i];
		if (AdAb == "Y") {
			if (xsize > Asize) {
				$("#simpan").prop('disabled', true);
				$("#simpan").removeClass('button4').addClass('button_disable');
				alert("data upload terlalu besar <br/> maksimal " + ttl_size2 + " file yang di upload adalah " + ttl_size1);
			} else {
				$("#simpan").prop('disabled', false);
				$("#simpan").removeClass('button_disable').addClass('button4');
			}
		} else {
			$("#simpan").prop('disabled', true);
			$("#simpan").removeClass('button4').addClass('button_disable');
			alert("gambar di tolak <br/>Silahkan lihat ekstensi gambar yang bisa di upload");
		}
	}
</script>
<?php
$Redirected = $get_page . "=" . $_GET["halaman"];
#echo "kecamatan";
$table     	= "profile_web";
$cek_id    	= "web_id";
$field1		= "profile1";
$field2		= "profile2";
$field3		= "profile3";
$field4		= "profile4";
$field5		= "address";
$field6		= "icon";
?>
<div style="max-height:500px;overflow:auto;" class="content_dtl2_admin frm_input">
	<?php
	function ready_data($field)
	{
		global $Ms_id, $table, $cek_id;
		$cek_data = $db->select("select deskripsi from $table where jenis='$field'");
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
		<table>
			</tr>
			<tr>
				<td width="10%" class="td_right">Profile1</td>
				<td>
					<input type='text' class='input wx500' name='post_1' id='post_1' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field1); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Profile2</td>
				<td>
					<input type='text' class='input wx500' required name='post_2' id='post_2' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field2); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Profile3</td>
				<td>
					<input type='text' class='input wx500' required name='post_3' id='post_3' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field3); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Kota</td>
				<td>
					<input type='text' class='input wx200' required name='post_4' id='post_4' maxlength="50" autocomplete="off" placeholder="*" value="<?= ready_data($field4); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Alamat</td>
				<td>
					<input type='text' class='input wx500' name='post_5' id='post_5' maxlength="100" autocomplete="off" value="<?= ready_data($field5); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">New Icon</td>
				<td>
					<input type='file' class='input wx250' name='post_6' id='attach' accept="image/png" onchange="GetFileInfo()" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Old Icon</td>
				<td>
					<img src="<?= $path_img_default . ready_data($field6); ?>" width="70px;" />
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
		$post_6 = escape($_FILES["post_6"]["tmp_name"]);
		if (empty($post_1) || empty($post_2) || empty($post_3) || empty($post_4) || empty($post_5)) {
			$Msg = "Ada data yang masih kosong";
		} else {
			$field_cek1 = $post_1;
			$field_cek2 = $post_2;
			$field_cek3 = $post_3;
			$field_cek4 = $post_4;
			$field_cek5 = $post_5;
			if (!empty($post_6)) {
				$tmp_file = $_FILES["post_6"]["tmp_name"];
				$file_name = date("Ymdhis") . $_FILES["post_6"]["name"];
				$field_cek6 = $file_name;
				#break;
				$upload_file = move_uploaded_file($tmp_file, $path_img_default . $file_name);
				//move_uploaded_file($post_6, $path_img_default.$file_name);
				if ($upload_file) {
					$Msg = "";
					$edit_data = "update $table set deskripsi='$field_cek1' where jenis='$field1'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					$edit_data = "update $table set deskripsi='$field_cek2' where jenis='$field2'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					$edit_data = "update $table set deskripsi='$field_cek3' where jenis='$field3'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					$edit_data = "update $table set deskripsi='$field_cek4' where jenis='$field4'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					$edit_data = "update $table set deskripsi='$field_cek5' where jenis='$field5'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					$edit_data = "update $table set deskripsi='$field_cek6' where jenis='$field6'";
					if ($db->query($edit_data)) {
						$Msg .= "Y";
					} else {
						$Msg .= "X";
					}
					#echo $Msg;
					$pecah = str_split($Msg);
					if (in_array("X", $pecah)) {
						$Msg = "ada yang tidak terupdate, silahkan coba lagi";
					} else {
						$Msg = "Y";
					}
				} else {
					$Msg = "Gagal upload data tidak ada yang di update";
				}
			} else {
				$Msg = "";
				$edit_data = "update $table set deskripsi='$field_cek1' where jenis='$field1'";
				if ($db->query($edit_data)) {
					$Msg .= "Y";
				} else {
					$Msg .= "X";
				}
				$edit_data = "update $table set deskripsi='$field_cek2' where jenis='$field2'";
				if ($db->query($edit_data)) {
					$Msg .= "Y";
				} else {
					$Msg .= "X";
				}
				$edit_data = "update $table set deskripsi='$field_cek3' where jenis='$field3'";
				if ($db->query($edit_data)) {
					$Msg .= "Y";
				} else {
					$Msg .= "X";
				}
				$edit_data = "update $table set deskripsi='$field_cek4' where jenis='$field4'";
				if ($db->query($edit_data)) {
					$Msg .= "Y";
				} else {
					$Msg .= "X";
				}
				$edit_data = "update $table set deskripsi='$field_cek5' where jenis='$field5'";
				if ($db->query($edit_data)) {
					$Msg .= "Y";
				} else {
					$Msg .= "X";
				}
				#echo $Msg;
				$pecah = str_split($Msg);
				if (in_array("X", $pecah)) {
					$Msg = "ada yang tidak terupdate, silahkan coba lagi";
				} else {
					$Msg = "Y";
				}
				#break;
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
						window.location.href = "<?= $Redirected; ?>";
					},
					<?= $timeout; ?>);
			</script>
	<?php
		}
	}
	?>
</div>