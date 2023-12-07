<script type="text/javascript" src="../skrip/nicEdit.js"></script>
<script type="text/javascript">
	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	bkLib.onDomLoaded(function() {
		new nicEditor().panelInstance('content_laporan');
	});
</script>
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
			if (Ext !== "jpg" && Ext !== "jpeg" && Ext !== "png" && Ext !== "tif") {
				document.getElementById("simpan").disabled = true;
				document.getElementById("simpan").style.backgroundColor = "grey";
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
		var Asize = 1536000;
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
			alert("Lampiran di tolak <br/>Silahkan lihat ekstensi lampiran yang bisa di upload");
		}
	}
	$($("#checkbox").function() {
		var f = function() {
			$(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
		};
		$('input').change(f).trigger('change');
	});
</script>
<style>
	.list_content_dtl {
		max-height: 60px;
		overflow: hidden;
	}
</style>
<?php
if (isset($_GET["halaman"])) {
	require_once "../seting/convert_image.php";
	$wmax1 = 750;
	$hmax1 = 750;
	$wmax3 = 250;
	$hmax3 = 250;
	$wmax5 = 75;
	$hmax5 = 75;
	$str_arr   	= array(',', "'", '"', '@', ';', ':', '+', '*', "/", "\\", "?", "!", ".", "<", ">", "=", '~', '#', '$', '%', '^', '(', ')', '{', '}', '[', ']', '&');
	$Redirected = "?halaman=" . $_GET["halaman"];
	$table   = "master_grup";
	$field   = "deskripsi";
	$cek_id  = "id_grup";
	$key	 = "produk";
	$content = "Produk";
	$periode = date("Y-m-d H:i:s");
	$query   = "SELECT a.url_grup,a.id_grup,a.deskripsi,a.aktif,a.konten,a.gambar_utama,a.galeri,COUNT(b.id_fk_proy) AS total
				FROM $table a LEFT OUTER JOIN proyek b
				ON a.id_grup=b.id_fk_prod
				WHERE grup='$key'
				GROUP BY a.id_grup
				ORDER BY id_grup";
	$cek_row = "ada " . count($db->select($query)) . " data " . $content;
	$hdr_table = "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr w15'>Nama</td><td class='td_hdr w50'>Deskripsi</td><td class='td_hdr wx100 tengah'>Gambar</td><td class='td_hdr wx100 tengah'>Galery</td><td class='td_hdr wx10'>Proyek</td><td class='td_hdr wx10'>Aktif</td><td class='td_hdr wx50'>Action</td></tr>";
?>
	<style>
	</style>
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
					$img_full = $hsl_list_data["gambar_utama"];
					if (!file_exists($path . $img_full) or strlen(trim($img_full)) < 1) {
						$imgx = "...";
					} else {
						$img_thumb = str_replace("full_", "thumb_", $img_full);
						if (!file_exists($path . $img_thumb)) {
							$imgx = "<img src='$path$img_full' width='100px'>";
						} else {
							$imgx = "<img src='$path$img_thumb' width='100px' height='50px'>";
						}
					}
					$cek_galery = count($db->select("select 1 from galery where id_attach='$hsl_list_data[galeri]'"));
					if ($cek_galery == 0) {
						$galery = "<a  href='$Redirected&action=galery&data_dtl=$hsl_list_data[id_grup]' class='galery'>insert galery</a>";
					} else {
						$galery = "<a href='$Redirected&action=galery&data_dtl=$hsl_list_data[id_grup]'  class='galery gal_exists'>" . $cek_galery . " image</a>";
					}
					echo "<tr class='tr'><td class='right'  $style_aktif>" . $nomor . "</td><td  $style_aktif>" . $hsl_list_data["deskripsi"] . "</td><td  $style_aktif><div class='list_content_dtl'>" . $hsl_list_data["konten"] . "</div></td><td  $style_aktif class='tengah'>" . $imgx . "</td><td $style_aktif class='tengah'>" . $galery . "</td><td $style_aktif class='tengah'>" . $hsl_list_data["total"] . "</td><td $style_aktif class='tengah'>" . $hsl_list_data["aktif"] . "</td><td >$url_action</td></tr>";
					$nomor++;
				}
				echo "</table>";
				?>
			</div>
			<i class="notif_1">* jika kolom proyek ada isinya, data tidak bisa di hapus, untuk hapus data di nonaktifkan terlebih dahulu</i>
		<?php
		} else {
			if ($_GET["action"] == "add") {
				$hdr_notif = "Tambah";
				$button    = "button3";
				$select     = '<option value="Y">Y</option><option value="N">N</option>';
				$catatan    = "";
				$input_tipe = "";
				$css_input_tipe = "";
				$input_btn  = "Simpan";
			} elseif ($_GET["action"] == "delete") {
				$hdr_notif = "delete";
				$button    = "button5";
				$select     = '<option value="X">X</option>';
				$catatan    = "<i style='color:red'>* Akan di hapus permanen, karena di data laporan memang belum ada datanya</i>";
				$input_tipe = "readonly";
				$css_input_tipe = " ro ";
				$input_btn  = "Delete";
			} elseif ($_GET["action"] == "edit") {
				$hdr_notif = "edit";
				$button    = "button2";
				$select     = '<option value="Y">Y</option><option value="N">N</option>';
				$catatan    = "";
				$input_tipe = "";
				$css_input_tipe = "";
				$input_btn  = "Edit";
			} elseif ($_GET["action"] == "galery") {
				require_once "halaman/manage_galery.php";
				die();
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
			function upload_image($data_img)
			{
				global $path_img, $wmax1, $hmax1, $wmax3, $hmax3, $str_arr, $db;
				$tmp_file 	= $data_img["tmp_name"];
				$random     = rand(1, 999);
				$nama_file 	= str_replace(' ', '', $data_img["name"]);
				$kaboom 	= explode(".", $nama_file); // Split file name into an array using the dot
				$fileExt 	= end($kaboom); // Now target the last array element to get the file extension
				$file_name	= strtolower(date("Ymdhis") . $random . "." . $fileExt);
				$full_file 	= "full_" . str_replace($str_arr, ".", $file_name);
				$thumb_file = "thumb_" . str_replace($str_arr, ".", $file_name);
				#break;
				$upload_file = move_uploaded_file($tmp_file, $path_img . $file_name);
				if ($upload_file) {
					ak_img_resize($path_img . $file_name, $path_img . $full_file, $wmax1, $hmax1, $fileExt);
					ak_img_resize($path_img . $file_name, $path_img . $thumb_file, $wmax3, $hmax3, $fileExt);
					unlink($path_img . $file_name);
					$result = $full_file;
				} else {
					$result = "Z";
				}
				return $result;
			}
			function ready_data($field)
			{
				global $Ms_id, $table, $cek_id, $data_dtl, $periode, $content, $db;
				if ($field == "aktif") {
					if (isset($_POST[$field])) {
						$hasil_data = "Y";
					} else {
						$aa = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($aa);
						if ($cek_data[0][$field] == "Y") {
							$hasil_data = "Y";
						} else {
							$hasil_data = "N";
						}
					}
				} elseif ($field == "upd_rec") {
					if (isset($_GET["data_dtl"])) {
						$zf = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($zf);
						$hasil_data = $cek_data[$field];
					} else {
						$hasil_data = $periode;
					}
				} elseif ($field == "urut") {
					if (isset($_GET["data_dtl"])) {
						$zf = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($zf);
						$hasil_data = $cek_data[$field];
					} else {/* 
					echo $zf = "select max(ifnull($field,0))+1 from $table where urut!='999' and aktif='Y' and utama='Y'
							AND id_fk_jenis IN (
							SELECT id_hdr_content FROM content_hdr WHERE deskripsi='$content')"; */
						$zf = "select max(ifnull($field,0))+1 from $table where urut!='999' and aktif='Y' and utama='Y'
							AND id_fk_jenis IN (
							SELECT id_hdr_content FROM content_hdr WHERE deskripsi='$content')";
						$cek_data = $db->select($zf);
						$rslt_data = $cek_data[0];
						#echo "z".$rslt_data[0];
						if (empty($rslt_data[0])) {
							$hasil_data = "1";
						} else {
							$hasil_data = $rslt_data[0];
						}
					}
				} else {
					if (isset($_POST[$field])) {
						$hasil_data = $_POST[$field];
					} else {
						$zf = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($zf);
						if ($cek_data) {;
							$hasil_data = $cek_data[0][$field];
						} else {
							$hasil_data = "";
						}
					}
				}
				return $hasil_data;
			}
			function ready_data_dtl($data_dtl)
			{
				global $table, $cek_id, $db;
				$cek_data = $db->select("select ifnull(gambar_utama,'X') as gambar from $table where $cek_id='$data_dtl'");
				$hsl_data = $cek_data[0];
				return $hsl_data["gambar"];
			}
		?>
			<form method="post" action="" enctype="multipart/form-data" id="form_post">
				<div class="<?= $button; ?>" style="padding:5px">Form <?= ucwords($hdr_notif . " " . $content); ?></div>
				<table>
					<tr id="visible">
						<td class='td_right w10'>Media</td>
						<td>
							<input type='text' class='input wx250' readonly name='me_visit' id='me_visit' />
						</td>
					</tr>
					<tr>
						<td class='td_right w10'>Aktif</td>
						<td>
							<div class="status_input"><?php
											#echo $result = ready_data("aktif");
											?>
								<input type="checkbox" id="checkbox" <?php
													if ($_GET["action"] == "add") {
														echo " checked ";
													} else {
														$result = ready_data("aktif");
														if ($result == "Y") {
															echo " checked ";
														} elseif ($result == "N") {
															echo " ";
														} else {
															echo " ";
														}
													}
													?> class="flipswitch input" name="aktif" />
							</div>
						</td>
					</tr>
					<tr>
						<td class='td_right w10'>Nama <?= $content; ?></td>
						<td>
							<input type='text' class='input wx500 <?= $css_input_tipe; ?>' required <?= $input_tipe; ?> name='nama' id='nama' maxlength="100" value="<?= ready_data("deskripsi");  ?>" autocomplete="off" placeholder="*" />
						</td>
					</tr>
					<tr>
						<td class='td_right' valign="top">Deskripsi <?= $content; ?></td>
						<td>
							<textarea class="textarea w98 <?= $css_input_tipe; ?>" <?= $input_tipe; ?> style="background:#fff" name="content_laporan" id="content_laporan" placeholder="*"><?= ready_data("konten");  ?></textarea>
						</td>
					</tr>
					<tr>
						<td class='td_right'>Gambar Utama</td>
						<td>
							<input type='file' class='input wx350 <?= $css_input_tipe; ?>' <?= $input_tipe; ?> name='attach' id='attach' accept="image/*" onchange="GetFileInfo()" />
						</td>
					</tr>
					<?php if ($_GET["action"] != "add") { ?>
						<tr>
							<td class="td_right">Gambar Lama</td>
							<td>
								<div style="border:solid 1px #006ab4;float:left;padding:5px;border-radius:3px;">
									<?php
									if (!empty(ready_data("gambar_utama")) and file_exists($path_img . ready_data("gambar_utama"))) {
										echo '<img src="' . $path_img . ready_data("gambar_utama") . '" class="wx250" style="border:solid 3px #ccc;"/>
								<br/>
								<input type="checkbox" name="hps_gambar" id="hps_gambar" style="margin-top:2px;float:left"/>
								<label for="hps_gambar">Hapus gambar lama</label>
						';
									} else {
										echo "<i>tidak ada gambar</i>";
									} ?>
								</div>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td class='td_right'></td>
						<td>
							<input type='submit' class='input wx150 <?= $button; ?>' style="margin:2px;" name='simpan' id='simpan' value="<?= $input_btn . " " . $content; ?>" />
							<a href="<?= base_url($Redirected); ?>"><input type="button" class="input wx150 button4" style="margin:2px;" value='Kembali' readonly /></a>
							<br />* harus di isi / dipilih
						</td>
					</tr>
				</table>
			</form>
			<?php
			if (isset($_POST["simpan"])) {
				$name_input = escape($_POST["nama"]);
				#$cont_input = escape($_POST["content_laporan"]);
				$cont_input = $_POST["content_laporan"];
				$media	 	= escape($_POST["me_visit"]);
				$gambar 	= $_FILES["attach"]["tmp_name"];
				$url_grup	= strtolower(str_replace(' ', '-', $name_input));
				if (isset($_POST["aktif"])) {
					$aktif = "Y";
				} else {
					$aktif = "N";
				}
				if (isset($_POST["hps_gambar"])) {
					$hapus_gambar = "Y";
				} else {
					$hapus_gambar = "N";
				}
				if (empty($media)) {
					$visit_by = "unknown";
				} else {
					$visit_by = $media;
				}
				if (empty($name_input) or empty($cont_input)) {
					$Msg = "Data masih ada yang kosong <br/> atau belum di pilih";
				} else {
					#echo "XA";
					#die;#$id_data   = "call id_group()";
					$field_cek = $name_input;
					if ($_GET["action"] == "add") {
						$cek = "select 1 from $table where $field='$field_cek'";
						$cek_data_exists = $db->select($cek);
						if (count($cek_data_exists) == 0) {
							$Msg		= "Y";
							if (!empty($gambar)) {
								$upload_img = upload_image($_FILES["attach"]);
								if ($upload_img) {
									$kolom 		 = "url_grup,upd_rec,deskripsi,user_add,aktif,grup,konten,gambar_utama";
									$isi_kolom 	 = "'" . $url_grup . "',now(),'" . ucwords($name_input) . "','$Ms_id','$aktif','$key','$cont_input','$upload_img'";
									$insert_data = "insert into $table ($kolom) values ($isi_kolom)";
									if (!$db->query($insert_data)) {
										log_error($Redirected, $insert_data);
										$Msg	 = "Error when insert data with image, check error_log";
									}
								} else {
									$insert_data = "error when upload image";
									log_error($Redirected, $insert_data);
									$Msg	 	 = $insert_data;
								}
							} else {
								$kolom = "url_grup,upd_rec,deskripsi,user_add,aktif,grup,konten";
								$isi_kolom = "'" . $url_grup . "',now(),'" . ucwords($name_input) . "','$Ms_id','$aktif','$key','$cont_input'";
								$insert_data = "insert into $table ($kolom) values ($isi_kolom)";
								if (!$db->query($insert_data)) {
									log_error($Redirected, $insert_data);
									$Msg	 = "Error when insert data, check error_log";
								}
							}
						} else {
							$Msg = "$content $field_cek sudah ada didatabae";
						}
					} elseif ($_GET["action"] == "edit") {
						$Msg = "Y";
						if (!empty($gambar)) {
							if (!empty(ready_data_dtl($data_dtl))) {
								$full_file = $path_img . ready_data_dtl($data_dtl);
								$thumb_file = $path_img . str_replace('full_', 'thumb_', ready_data_dtl($data_dtl));
								if (file_exists($full_file) || file_exists($thumb_file)) {
									unlink($full_file);
									unlink($thumb_file);
								}
							}
							$upload_img = upload_image($_FILES["attach"]);
							if ($upload_img) {
								$edit_data = "update $table set url_grup='$url_grup',deskripsi='" . ucwords($name_input) . "',aktif='$aktif',user_add='$Ms_id',konten='$cont_input',gambar_utama='$upload_img' where $cek_id='$data_dtl'";
								if (!$db->query($edit_data)) {
									log_error($Redirected, $edit_data);
									$Msg	 = "Error when update data with image, check error_log";
								}
							} else {
								$edit_data = "error when upload image";
								log_error($Redirected, $edit_data);
								$Msg	 	 = $edit_data;
							}
						} else {
							if ($hapus_gambar == "Y") {
								if (!empty(ready_data_dtl($data_dtl))) {
									$full_file = $path_img . ready_data_dtl($data_dtl);
									$thumb_file = $path_img . str_replace('full_', 'thumb_', ready_data_dtl($data_dtl));
									if (file_exists($full_file) || file_exists($thumb_file)) {
										unlink($full_file);
										unlink($thumb_file);
									}
								}
								$edit_data = "update $table set url_grup='$url_grup',deskripsi='" . ucwords($name_input) . "',aktif='$aktif',user_add='$Ms_id',konten='$cont_input',gambar_utama=null where $cek_id='$data_dtl'";
							} else {
								$edit_data = "update $table set url_grup='$url_grup',deskripsi='" . ucwords($name_input) . "',aktif='$aktif',user_add='$Ms_id',konten='$cont_input' where $cek_id='$data_dtl'";
							}
							if (!$db->query($edit_data)) {
								log_error($Redirected, $edit_data);
								$Msg	 = "Error when update data with image, check error_log";
							}
						}
					} elseif ($_GET["action"] == "delete") {
						$xa = "select 1 from $table where $cek_id='$data_dtl'";
						$cek_data_exists = $db->select($xa);
						if (count($cek_data_exists) == 1) {
							$xx = "select 1 from proyek where id_fk_prod='$data_dtl'";
							$cek_data_used = $db->select($xx);
							if (count($cek_data_used) != 0) {
								$Msg = "Sudah ada datanya di data proyek, jadi tidak bisa di hapus";
							} else {
								#break;
								delete_galery($data_dtl, $Redirected);
								if (!empty(ready_data_dtl($data_dtl))) {
									$full_file = $path_img . ready_data_dtl($data_dtl);
									$thumb_file = $path_img . str_replace('full_', 'thumb_', ready_data_dtl($data_dtl));
									if (file_exists($full_file) || file_exists($thumb_file)) {
										unlink($full_file);
										unlink($thumb_file);
									}
								}
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
								window.location.href = "<?= base_url($Redirected); ?>";
							},
							2000);
					</script>
		<?php

					// dbg($Redirected);
				}
			}
		} ?>
	</div>
<?php
}
?>