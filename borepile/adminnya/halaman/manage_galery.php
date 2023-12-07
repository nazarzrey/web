<?php
if ($content == "Produk") {
	$table_mst  = "master_grup";
	$field_mst  = "id_grup";
	$get_id_mst = "";
	$id_dtl_mst = "";
	$kolom1		= "deskripsi";
	$kolom2		= "gambar_utama";
	$kolom3		= "url_grup";
	$kolom4		= "";
	$data_dtl	= escape($_GET['data_dtl']);
	$cek_id		= $cek_id;
	$display	= "";
} elseif ($content == "Proyek") {
	$table_mst  = "proyek";
	$field_mst  = "id_dtl";
	$get_id_mst = "";
	$id_dtl_mst = "";
	$kolom1		= "nama_proyek";
	$kolom2		= "id_dtl_img";
	$kolom3		= "url_dtl";
	$kolom4		= "";
	$data_dtl	= escape($_GET['data_dtl']);
	$cek_id		= $cek_id;
	$display	= "";
} elseif ($content == "workshop") {
	$table_mst  = "content_other";
	$field_mst  = "id_content";
	$get_id_mst = "";
	$id_dtl_mst = "";
	$kolom1		= "id_content";
	$kolom2		= "galeri";
	$kolom3		= "id_content";
	$kolom4		= "";
	$data_dtl	= escape($content);
	$cek_id		= "id_content";
	$display	= "display:none";
} else {
	die();
}
function ready_data_galery($field, $foto)
{
	global $Ms_id, $table, $cek_id, $periode, $data_dtl, $db;
	#echo $data_dtl;
	if (isset($_POST[$field])) {
		$hasil_data = $_POST[$field];
	} else {
		if ($foto == "Y") {
			$zf = "select thumb_file_name as galeri from galery where id_attach in (select $field from $table where $cek_id='$data_dtl')";
		} else {
			$zf = "select $field from $table where $cek_id='$data_dtl'";
		}
		$cek_data = $db->select($zf); #;
		if ($cek_data) {
			$hsl_data = $cek_data[0][$field];
		} else {
			$hsl_data = "";
		}
		$hasil_data = $hsl_data;
	}
	return $hasil_data;
}
function cek_foto_proses($option)
{
	global $data_id, $tgl_jam, $Redirected, $path, $table_mst, $field_mst, $data_dtl, $db;
	$sintak_data_proses = "select full_file_name,thumb_file_name,key_attach from galery where id_attach in (SELECT galeri FROM " . $table_mst . " where " . $field_mst . "='$data_dtl')";
	if ($query_data = $db->select($sintak_data_proses)) {
		$hsl_data = count($query_data);
		if (strlen($option) > 1) {
			$hsl_data = $hsl_data;
		} else {
			if ($hsl_data > 0) {
				foreach ($query_data as $key => $data_foto) {
					$cek_img_icon = $data_foto['thumb_file_name'];
					$cek_img_full = $data_foto['full_file_name'];
					$key_attach   = $data_foto['key_attach'];
					if (file_exists($path . $cek_img_icon)) {
						$thumb_img = $path . $cek_img_icon;
					} else {
						if (file_exists($path . $cek_img_full)) {
							$thumb_img = $path . $cek_img_full;
						} else {
							$thumb_img = "../gambar/no_image.jpg";
						}
					}
					if (file_exists($path . $cek_img_full)) {
						$full_img = $path . $cek_img_full;
					} else {
						$full_img = "../gambar/no_image.jpg";
					}
?>
					<div style="border:solid 1px #ccc;float:left;margin:2px;border-radius:5px;">
						<div>
							<label for="<?= $key_attach; ?>" class="lbl_del_img">
								<a onclick="OpenPopupCenter('<?= $full_img; ?>', 'TEST!?', 480, 320);return false;">
									<img src='<?= $thumb_img; ?>' width='65px;' height='60px' style='margin:2px;border:solid 3px #ccc'>
								</a>
							</label>
							<br />
						</div>
						<div style="float:left;margin-top:2px;width:100%">
							<input type="checkbox" id="<?= $key_attach; ?>" class="del_img" style="margin-top:-2px;float:left" />
							<label for="<?= $key_attach; ?>" class="lbl_del_img">delete</label>
						</div>
					</div>
<?php
				}
			}
		}
	} else {
		$hsl_data = "Error sintak";
		log_error($Redirected, $sintak_data_proses);
	}
	return $hsl_data;
}
function upload_more_image($data_img, $id_attach, $insert)
{
	global $path_img, $wmax1, $hmax1, $wmax3, $hmax3, $str_arr, $db;
	$xx = 1;
	$result = "";
	foreach ($data_img['tmp_name'] as $key => $tmp_file) {
		#echo $tmp_file;
		#echo $data_img['name'][$key];
		#die();
		$date_time	= date("Y-m-d H:i:s");
		$str_DT		= date("YmdHis");
		$random     = rand(1, 999);
		$nama_file 	= str_replace(' ', '', strtolower("{$data_img['name'][$key]}"));
		$kaboom 	= explode(".", $nama_file); // Split file name into an array using the dot
		$fileExt 	= end($kaboom); // Now target the last array element to get the file extension
		$file_name	= strtolower(date("Ymdhis") . $random . "." . $fileExt);
		$id_file	= substr($id_attach, 0, 7) . $str_DT . $xx;
		$full_file 	= "full_" . str_replace($str_arr, ".", $file_name);
		$thumb_file = "thumb_" . str_replace($str_arr, ".", $file_name);
		#break;
		$upload_file = move_uploaded_file($tmp_file, $path_img . $file_name);
		if ($upload_file) {
			ak_img_resize($path_img . $file_name, $path_img . $full_file, $wmax1, $hmax1, $fileExt);
			ak_img_resize($path_img . $file_name, $path_img . $thumb_file, $wmax3, $hmax3, $fileExt);
			unlink($path_img . $file_name);
			if ($insert == "Y") {
				$ins_gal = $db->query("insert into galery values ('$id_attach','$id_file','$full_file','$thumb_file','$file_name','$date_time',null)");
			}
			$result .= $full_file;
		} else {
			$result = "Adeli@";
		}
		$xx++;
	}
	return $result;
}
if (isset($_POST["back"])) {
	echo '<script>';
	echo 'window.location.href="' . $Redirected . '";';
	echo '</script>';
}
$Redirected =  $_SERVER['REQUEST_URI'];
if (isset($_POST["simpan_data"])) {
	$gambar 	= $_FILES["attach"];
	$date_time	= date("Y-m-d H:i:s");
	if (isset($_GET["data_dtl"])) {
		$dtl_data = escape($_GET["data_dtl"]);
	} else {
		$dtl_data = date("Y-m-d H:i:s");
	}
	if (empty(ready_data_galery("galeri", "N"))) {
		$id_galery = md5($dtl_data . $date_time . ready_data_galery($kolom3, "N"));
	} else {
		$id_galery = ready_data_galery("galeri", "N");
	}
	$upload_img = upload_more_image($gambar, $id_galery, 'Y');
	if ($upload_img == "Adeli@") {
		$Msg = "Error when upload galery";
	} else {
		if (empty(ready_data_galery("galeri", "N"))) {
			update_data_func($table_mst, "galeri='$id_galery'", "$field_mst", $data_dtl, $Redirected);
		}
	}
	echo '<script>';
	echo 'window.location.href="' . $_SERVER['REQUEST_URI'] . '";';
	echo '</script>';
}
?>
<form method="post" action="" enctype="multipart/form-data" id="form_post" style="padding:5px;border:solid 1px #ddd;">

	<div class="button3" style="padding:5px;<?= $display; ?>;">Form Galery <?= ucwords($content); ?></div>
	<table>
		<tr style="<?= $display; ?>">
			<td class='td_right w10'>Nama <?= $content; ?></td>
			<td>
				<input type='text' class='input wx500' readonly name='nama' id='nama' maxlength="100" value="<?= ready_data_galery($kolom1, "N"); ?>" autocomplete="off" placeholder="*" />
			</td>
		</tr>
		<tr style="<?= $display; ?>">
			<td class="td_right">Gambar Utama</td>
			<td>
				<?php
				if (!empty(ready_data_galery($kolom2, "N")) and file_exists($path_img . ready_data_galery($kolom2, "N"))) {
					echo '<img src="' . $path_img . ready_data_galery($kolom2, "N") . '" class="wx250" style="border:solid 3px #ccc;"/>';
				} else {
					echo "<i>tidak ada gambar</i>";
				} ?>
			</td>
		</tr>
		<tr>
			<td class='td_right' style="<?= $display; ?>">Galery</td>
			<td>
				<input type='file' class='input wx350' name='attach[]' id='attach' maxlength="50" accept="image/*" multiple onchange="GetFileInfo()" />
			</td>
		</tr>
		<?php if (!empty(ready_data_galery("galeri", "Y"))) { ?>
			<tr>
				<td style="<?= $display; ?>"></td>
				<td class="td_right">
					<div style='float:left;border:solid 1px #ccc;padding:2px;border-radius:5px;' class="w98" id="update_picture">
						<div style='float:left;border:solid 1px #ccc;padding:2px;border-radius:5px;margin:2px;'>
							<?php cek_foto_proses("A"); ?>
						</div>
						<input type='button' class='input w99 button1' style="margin:2px;" name='update_image' id='update_image' value="Hapus gambar dipilih" />
					</div>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<td class='td_right' style="<?= $display; ?>"></td>
			<td>
				<input type='submit' class='input wx150 button3' style="margin:2px;" name='simpan_data' id='simpan_data' value="Simpan Galery <?= $content; ?>" />
				<input type='submit' class='input wx150 button4' style="margin:2px;<?= $display; ?>" name='back' id='back' value="Kembali" />
				<br />* harus di isi / dipilih
			</td>
		</tr>
	</table>
</form>
<script>
	$(document).ready(function() {
		$("#update_image").click(function() {
			var id = "";
			var hapus_gambar = $("input.del_img").map(function() {
				//var id = "Id: " + $(this).attr("id") + " v : " + $(this).val() + " c : " + $(this).is(":checked");
				if ($(this).is(":checked")) {
					return id = $(this).attr("id");
				}
			}).get().join(",");
			hapus_img(hapus_gambar);
		})
	})

	function hapus_img(datanya) {
		if (datanya.length == 0) {
			alert("tidak gambar yang di pilih");
		} else {
			$.get('ajax/ajax_request.php?hapus_gambar=' + datanya, function(data, status) {
				if (data == "Y") {
					// alert("gambar sudah di hapus sdafasdfas fsa2d1fa2sf2safd32asd2fsda1f");
					// setTimeout(
					// 	function() {
					// 		var request_uri = location.pathname + location.search;
					// 		window.location.href = request_uri;
					// 	},
					// 	5000);
				} else {
					// setTimeout(function() {
					// 	alert(data);
					// }, 5000);
				}
			});
		}
	}
</script>