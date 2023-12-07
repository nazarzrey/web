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
$table     	= "pu_kontak";
$cek_id    	= "web_id";
$field1		= "telp";
$field2		= "email";
$field3		= "facebook";
$field4		= "twitter";
#$field5		= "instagram";
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
	function ready_data_url($field)
	{
		global $Ms_id, $table, $cek_id;
		$cek_data = $db->select("select url from $table where jenis='$field'");
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
				<td width="10%" class="td_right">Telp</td>
				<td>
					<input type='text' class='input wx500' required name='post_1' id='post_1' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field1); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Email</td>
				<td>
					<input type='text' class='input wx500' required name='post_2' id='post_2' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field2); ?>" />
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Facebook</td>
				<td>
					<input type='text' class='input wx200' required name='post_3' id='post_3' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field3); ?>" />
				</td>
			</tr>
			<tr>
				<td class='td_right'>
					URL
				</td>
				<td>
					<input type='text' class='input wx500' required name='post_3x' id='post_3x' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data_url($field3); ?>" />
					<br /><label class='notif_info'>ex https://web.facebook.com/zrey.mv?_rdr</label>
				</td>
			</tr>
			<tr>
				<td width="10%" class="td_right">Twitter</td>
				<td>
					<input type='text' class='input wx200' required name='post_4' id='post_4' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data($field4); ?>" />
				</td>
			</tr>
			<tr>
				<td class='td_right'>
					URL
				</td>
				<td>
					<input type='text' class='input wx500' required name='post_4x' id='post_4x' maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data_url($field4); ?>" />
					<br /><label class='notif_info'>ex https://web.facebook.com/zrey.mv?_rdr</label>
				</td>
			</tr>
			<?php /*
			<tr>
				<td width="10%"  class="td_right">Instagram</td>
				<td>
				<input type='text' class='input wx200'required name='post_5' id='post_5'  maxlength="100"  autocomplete="off"  placeholder="*" value="<?= ready_data($field5); ?>"/>
				</td>
			</tr>
			<tr>
			<td class='td_right'>
			URL
			</td>
				<td>
				<input type='text' class='input wx500' required name='post_5x' id='post_5x'  maxlength="100x"  autocomplete="off"  placeholder="*" value="<?= ready_data_url($field5); ?>"/>
				<br/><label class='notif_info'>ex https://web.facebook.com/zrey.mv?_rdr</label>				
				</td>
			</tr>
				<td></td>
				<td>
				<input type='submit' class='input wx150 button4' name='simpan' id='simpan' value="Simpan Data" />
				</td>
			</td>
			*/ ?>
		</table>
	</form>
	<?php
	if (isset($_POST["simpan"])) {
		$post_1  = escape($_POST["post_1"]);
		$post_2  = escape($_POST["post_2"]);
		$post_3  = escape($_POST["post_3"]);
		$post_3x = escape($_POST["post_3x"]);
		$post_4  = escape($_POST["post_4"]);
		$post_4x = escape($_POST["post_4x"]);
		/*
			$post_5  = escape($_POST["post_5"]);
			$post_5x = escape($_POST["post_5x"]); */
		#if(empty($post_1) || empty($post_2) || empty($post_3) || empty($post_4)|| empty($post_5) || empty($post_3x) || empty($post_4x)|| empty($post_5x)){
		if (empty($post_1) || empty($post_2) || empty($post_3) || empty($post_4) || empty($post_3x) || empty($post_4x)) {
			$Msg = "Ada data yang masih kosong";
		} else {
			$field_cek1  = $post_1;
			$field_cek2  = $post_2;
			$field_cek3  = $post_3;
			$field_cek3x = $post_3x;
			$field_cek4  = $post_4;
			$field_cek4x = $post_4x;
			/*
				$field_cek5  = $post_5;
				$field_cek5x = $post_5x;
				*/
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
			$edit_data = "update $table set url='$field_cek3x' where jenis='$field3'";
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
			$edit_data = "update $table set url='$field_cek4x' where jenis='$field4'";
			if ($db->query($edit_data)) {
				$Msg .= "Y";
			} else {
				$Msg .= "X";
			}
			/*
				$edit_data = "update $table set deskripsi='$field_cek5' where jenis='$field5'";
				if($db->query($edit_data)){ $Msg .= "Y"; }else{ $Msg .= "X";}
				$edit_data = "update $table set url='$field_cek5x' where jenis='$field5'";
				if($db->query($edit_data)){ $Msg .= "Y"; }else{ $Msg .= "X";} */
			#echo $Msg;
			$pecah = str_split($Msg);
			if (in_array("X", $pecah)) {
				$Msg = "ada yang tidak terupdate, silahkan coba lagi";
			} else {
				$Msg = "Y";
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