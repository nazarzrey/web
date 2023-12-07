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
	$table   = "proyek";
	$field   = "nama_proyek";
	$cek_id  = "id_dtl";
	$content = "Proyek";
	$key	 = strtolower($content);
	$periode = date("Y-m-d H:i:s");
	$query   = "SELECT a.id_dtl,a.tahun,a.nama_proyek,a.id_dtl_img,a.aktif,b.deskripsi AS produk,c.deskripsi AS proyek,a.galeri FROM
				proyek a LEFT OUTER JOIN master_grup b
				ON a.id_fk_prod=b.id_grup
				LEFT OUTER JOIN master_grup c
				ON a.id_fk_proy=c.id_grup ORDER BY a.upd_rec DESC";
	$cek_row = "ada " . count($db->select($query)) . " data " . $content;
	$hdr_table = "<tr><td class='td_hdr wx10'>Tahun</td><td class='td_hdr wx350'>Proyek</td><td class='td_hdr wx100'>Grup Produk</td><td class='td_hdr w20'>Grup Proyek</td><td class='td_hdr w10 tengah'>Gambar</td><td class='td_hdr w10 tengah'>Galery</td><td class='td_hdr wx15 tengah'>Aktif</td><td class='td_hdr w5'>Action</td></tr>";
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
				foreach ($cek_list_data as $key => $hsl_list_data) {
					if ($hsl_list_data["aktif"] == "Y") {
						$style_aktif = "style='color:#006ab4';";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_dtl]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[id_dtl]' class='delete'></a>";
					} elseif ($hsl_list_data["aktif"] == "N") {
						$style_aktif = "style='color:#d46e04;'";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_dtl]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[id_dtl]' class='delete'></a>";
					} else {
						$style_aktif = "style='color:red;'";
						$url_action = "";
					}
					$img_full = $hsl_list_data["id_dtl_img"];
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
						$galery = "<a  href='$Redirected&action=galery&data_dtl=$hsl_list_data[id_dtl]' class='galery'>insert galery</a>";
					} else {
						$galery = "<a href='$Redirected&action=galery&data_dtl=$hsl_list_data[id_dtl]'  class='galery gal_exists'>" . $cek_galery . " image</a>";
					}
					echo "<tr class='tr'><td class='right'  $style_aktif>" . $hsl_list_data["tahun"] . "</td><td  $style_aktif>" . $hsl_list_data["nama_proyek"] . "</td><td  $style_aktif>" . $hsl_list_data["produk"] . "</td><td  $style_aktif>" . $hsl_list_data["proyek"] . "</td><td  $style_aktif class='tengah'>" . $imgx . "</td><td $style_aktif class='tengah'>" . $galery . "</td><td $style_aktif class='tengah'>" . $hsl_list_data["aktif"] . "</td><td >$url_action</td></tr>";
				}
				echo "</table>";
				?>
			</div>
			<i class="notif_1">* jika proyek ada isinya, data tidak bisa di hapus, untuk hapus data di nonaktifkan terlebih dahulu</i>
		<?php
		} else {
			if ($_GET["action"] == "add") {
				$hdr_notif = "tambah";
				$button    = "button3";
				$select     = '<option value="Y">Y</option><option value="N">N</option>';
				$catatan    = "";
				$input_tipe = "";
				$css_input_tipe = "";
				$input_btn  = "Simpan";
			} elseif ($_GET["action"] == "delete") {
				$hdr_notif = "hapus";
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
					$query1 = "select distinct($field) as $field from $table where $cek_id='$data_dtl'";
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
				global $path_img, $wmax1, $hmax1, $wmax3, $hmax3, $str_arr;
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
						if ($cek_data) {
							$hsl_data = $cek_data[0][$field];
						} else {
							$hsl_data = "";
						}
						if ($hsl_data[0] == "Y") {
							$hasil_data = "Y";
						} else {
							$hasil_data = "N";
						}
					}
				} elseif ($field == "upd_rec") {
					if (isset($_GET["data_dtl"])) {
						$zf = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($zf);
						if ($cek_data) {
							$hsl_data = $cek_data[0][$field];
						} else {
							$hsl_data = "";
						}
						$hasil_data = $hsl_data[0];
					} else {
						$hasil_data = $periode;
					}
				} elseif ($field == "urut") {
					if (isset($_GET["data_dtl"])) {
						$zf = "select $field from $table where $cek_id='$data_dtl'";
						$cek_data = $db->select($zf);
						if ($cek_data) {
							$hsl_data = $cek_data[0][$field];
						} else {
							$hsl_data = "";
						}
						$hasil_data = $hsl_data[0];
					} else {/* 
					echo $zf = "select max(ifnull($field,0))+1 from $table where urut!='999' and aktif='Y' and utama='Y'
							AND id_fk_jenis IN (
							SELECT id_hdr_content FROM content_hdr WHERE deskripsi='$content')"; */
						$zf = "select max(ifnull($field,0))+1 as $field from $table where urut!='999' and aktif='Y' and utama='Y'
							AND id_fk_jenis IN (
							SELECT id_hdr_content FROM content_hdr WHERE deskripsi='$content')";
						$cek_data = $db->select($zf);
						$rslt_data = $cek_data[0][$field];
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
						if ($cek_data) {
							$hsl_data = $cek_data[0][$field];
						} else {
							$hsl_data = "";
						}
						$hasil_data = $hsl_data;
					}
				}
				return $hasil_data;
			}
			function ready_data_dtl($data_dtl)
			{
				global $table, $cek_id, $db;
				$cek_data = $db->select("select ifnull(id_dtl_img,'X') as id_dtl_img from $table where $cek_id='$data_dtl'");
				if ($cek_data) {
					$hsl_data = $cek_data[0]["id_dtl_img"];
				} else {
					$hsl_data = "";
				}
				return $hsl_data;
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
							<input type='text' class='input wx500 <?= $css_input_tipe; ?>' required <?= $input_tipe; ?> name='nama' id='nama' maxlength="100" value="<?= ready_data("nama_proyek");  ?>" autocomplete="off" placeholder="*" />
						</td>
					</tr>
					<tr>
						<td class='td_right'>Tahun</td>
						<td>
							<select name="tahun" id="tahun" class="select wx100 <?= $css_input_tipe; ?>" required <?= $input_tipe; ?>>
								<?php
								if (isset($_GET["data_dtl"])) {
									echo "<option value='" . ready_data("tahun") . "'>" . ready_data("tahun") . "</option>";
									for ($thn = date("Y"); $thn >= date("Y") - 10; $thn = $thn - 1) {
										if ($thn <> ready_data("tahun")) {
											echo "<option value='" . $thn . "'>" . $thn . "</option>";
										}
									}
								} else {
									for ($thn = date("Y"); $thn >= date("Y") - 10; $thn = $thn - 1) {
										echo "<option value='" . $thn . "'>" . $thn . "</option>";
									}
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class='td_right'>Lokasi</td>
						<td>
							<input type='text' class='input wx500<?= $css_input_tipe; ?>' required <?= $input_tipe; ?> name='lokasi' id='lokasi' maxlength="200" autocomplete="off" placeholder="* ex (Bogor, Jawa Barat)" value="<?= ready_data("lokasi");  ?>" />
						</td>
					</tr>
					<tr>
						<td class='td_right'>Grup Produk *</td>
						<td>
							<select name="grup_produk" id="grup_produk" class="select wx300 <?= $css_input_tipe; ?>" required <?= $input_tipe; ?>>
								<?php

								if (isset($_POST["grup_produk"])) {
									if ($_POST["grup_produk"] == "") {
										echo "<option value=''>Pilih data</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where aktif='Y' and grup='produk' order by id_grup");
									} else {
										$cek_ready_grup   = $db->select("select id_grup,deskripsi from master_grup  where id_grup='$_POST[grup_produk]' and grup='produk'");
										echo "<option value='$cek_ready_grup[0][id_grup][id_grup]'>" . ucwords($cek_ready_grup[0][id_grup]["deskripsi"]) . "</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup  where id_grup!='$_POST[grup_produk]' and aktif='Y'  and grup='produk' order by id_grup");
									}
									foreach ($cek_grup as $key => $hsl_grup_laporan) {
										echo "<option value='$hsl_grup_laporan[id_grup]'>" . ucwords($hsl_grup_laporan["deskripsi"]) . "</option>";
									}
								} else {
									if (isset($_GET["data_dtl"])) {
										$query_grup = $db->select("select id_grup,deskripsi from master_grup where grup='produk' and id_grup in (select id_fk_prod from proyek where id_dtl='$_GET[data_dtl]')");
										$result_grup = $query_grup;
										echo "<option value='" . $result_grup[0]["id_grup"] . "'>" . $result_grup[0]["deskripsi"] . "</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where grup='produk' and id_grup not in (select id_fk_prod from proyek where id_dtl='$_GET[data_dtl]') order by id_grup");
									} else {
										echo "<option value=''>Pilih data</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where aktif='Y'  and grup='produk' order by id_grup");
									}
									foreach ($cek_grup as $key => $hsl_grup_laporan) {
										echo "<option value='$hsl_grup_laporan[id_grup]'>" . ucwords($hsl_grup_laporan["deskripsi"]) . "</option>";
									}
								}
								?>
								<!-- </select> -->
						</td>
					</tr>
					<tr>
						<td class='td_right'>Grup Proyek *</td>
						<td>
							<select name="grup_proyek" id="grup_proyek" class="select wx300 <?= $css_input_tipe; ?>" required <?= $input_tipe; ?>>
								<!--<option value='grup_proyek'>grup_proyek</option> -->
								<?php
								if (isset($_POST["grup_proyek"])) {
									if ($_POST["grup_proyek"] == "") {
										echo "<option value=''>Pilih data</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where aktif='Y'  and grup='building' order by id_grup");
									} else {
										$cek_ready_grup   = $db->select("select id_grup,deskripsi from master_grup  where id_grup='$_POST[grup_proyek]' and grup='building' ");
										echo "<option value='$cek_ready_grup[0][id_grup]'>" . ucwords($cek_ready_grup[0]["deskripsi"]) . "</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup  where id_grup!='$_POST[grup_proyek]' and aktif='Y' and grup='building'  order by id_grup");
									}
								} else {
									if (isset($_GET["data_dtl"])) {
										$query_grup = $db->select("select id_grup,deskripsi from master_grup where grup='building' and id_grup in (select id_fk_proy from proyek where id_dtl='$_GET[data_dtl]')");
										$result_grup = $query_grup;
										echo "<option value='" . $result_grup[0]["id_grup"] . "'>" . $result_grup[0]["deskripsi"] . "</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where grup='building' and id_grup not in (select id_fk_proy from proyek where id_dtl='$_GET[data_dtl]') order by id_grup");
									} else {
										echo "<option value=''>Pilih data</option>";
										$cek_grup = $db->select("select id_grup,deskripsi from master_grup where aktif='Y'  and grup='building' order by id_grup");
									}

									foreach ($cek_grup as $key => $hsl_grup_laporan) {
										echo "<option value='$hsl_grup_laporan[id_grup]'>" . ucwords($hsl_grup_laporan["deskripsi"]) . "</option>";
									}
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class='td_right' valign="top">Detail <?= $content; ?></td>
						<td>
							<textarea class="textarea w98<?= $css_input_tipe; ?>" required <?= $input_tipe; ?> style="background:#fff" name="content_laporan" id="content_laporan" placeholder="*"><?= ready_data("detail_proyek"); ?></textarea>
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
									if (!empty(ready_data("id_dtl_img")) and file_exists($path_img . ready_data("id_dtl_img"))) {
										echo '<img src="' . $path_img . ready_data("id_dtl_img") . '" class="wx250" style="border:solid 3px #ccc;"/>
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
				$thun_input = escape($_POST["tahun"]);
				$loka_input = escape($_POST["lokasi"]);
				$proy_input = escape($_POST["grup_proyek"]);
				$prod_input = escape($_POST["grup_produk"]);
				$cont_input = escape($_POST["content_laporan"]);
				$gambar 	= $_FILES["attach"]["tmp_name"];
				$media	 	= escape($_POST["me_visit"]);
				$url_dtl	= strtolower(str_replace(' ', '-', $name_input));
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
				if (empty($name_input) or empty($thun_input) or empty($loka_input) or $loka_input == "" or $proy_input == "" or $prod_input == "" or empty($cont_input)) {
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
									$kolom = "url_dtl,id_fk_proy,id_fk_prod,nama_proyek,detail_proyek,tahun,lokasi,id_dtl_img,upd_rec,aktif";
									$isi_kolom = "'" . strtolower(str_replace(' ', '-', $name_input)) . "','$proy_input','$prod_input','" . ucwords($name_input) . "','$cont_input','$thun_input','$loka_input','$upload_img','" . date("Y-m-d H:i:s") . "','Y'";
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
								$kolom = "url_dtl,id_fk_proy,id_fk_prod,nama_proyek,detail_proyek,tahun,lokasi,upd_rec,aktif";
								$isi_kolom = "'" . strtolower(str_replace(' ', '-', $name_input)) . "','$proy_input','$prod_input','" . ucwords($name_input) . "','$cont_input','$thun_input','$loka_input','" . date("Y-m-d H:i:s") . "','Y'";
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
							echo "kupret";
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
								$edit_data = "update $table set url_dtl='$url_dtl',id_fk_proy='$proy_input',id_fk_prod='$prod_input',nama_proyek='$name_input',detail_proyek='$cont_input',tahun='$thun_input',lokasi='$loka_input',upd_rec=now(),aktif='$aktif',id_dtl_img='$upload_img' where $cek_id='$data_dtl'";
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
								$edit_data = "update $table set url_dtl='$url_dtl',id_fk_proy='$proy_input',id_fk_prod='$prod_input',nama_proyek='$name_input',detail_proyek='$cont_input',tahun='$thun_input',lokasi='$loka_input',upd_rec=now(),aktif='$aktif',id_dtl_img=null where $cek_id='$data_dtl'";
							} else {
								$edit_data = "update $table set url_dtl='$url_dtl',id_fk_proy='$proy_input',id_fk_prod='$prod_input',nama_proyek='$name_input',detail_proyek='$cont_input',tahun='$thun_input',lokasi='$loka_input',upd_rec=now(),aktif='$aktif' where $cek_id='$data_dtl'";
							}
							if (!$db->query($edit_data)) {
								log_error($Redirected, $edit_data);
								$Msg	 = "Error when update data with image, check error_log";
							}
						}
					} elseif ($_GET["action"] == "delete") {
						$xx = "select 1 from $table where $cek_id='$data_dtl'";
						$cek_data_used = $db->select($xx);
						if (count($cek_data_used) == 0) {
							$Msg = "data tidak ada..!";
						} else {
							#break;
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
							1000);
					</script>
		<?php
				}
			}
		} ?>
	</div>
<?php
}
?>