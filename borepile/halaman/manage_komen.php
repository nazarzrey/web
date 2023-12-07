<?php
/*
if(isset($_SESSION["msg"])){
	unset($_SESSION["msg"]);
} */
$Message = "";
if (isset($page_content)) {
	$page_content = $page_content;
} else {
	$page_content = "";
}

if (isset($_GET["page_num"])) {
	$page_num = "&page_num=" . $_GET["page_num"];
} else {
	$page_num = "";
}
$Redirected = $get_page . "=" . $page_content . $page_num;
require_once "../seting/convert_image.php";
$wmax1 = 550;
$hmax1 = 550;
$wmax2 = 450;
$hmax2 = 450;
$wmax3 = 300;
$hmax3 = 300;
$wmax4 = 250;
$hmax4 = 250;
$wmax5 = 75;
$hmax5 = 75;
?>
<?php 	#if(isset($_GET["dtl1"])){ echo 'belum di rapikan u/ versi mobile'; } 
?>
<div style="max-height:100%;overflow:auto;" class="content_dtl2_admin frm_input">
	<?php
	if (isset($_GET["dtl1"]) || isset($_GET["dtl2"])) {
		if (isset($_GET["page_num"])) {
			$page_num = "&page_num=" . $_GET["page_num"];
		} else {
			$page_num = "";
		}
		if (!isset($_GET["dtl2"])) {
			die();
		}
		echo '<a href="' . $Redirected . '"><div class="button1" style="padding:5px" >Kembali</div></a>';
		$get_dtl1 = trim(htmlentities(mysqli_real_escape_string($_GET["dtl1"]);
		$get_dtl2 = trim(htmlentities(mysqli_real_escape_string($_GET["dtl2"]);
		$get_url = $Redirected . "&dtl1=" . $get_dtl1 . "&dtl2=" . $get_dtl2;
	?>
		<div style="overflow:auto;">
			<div class="list_result" style="width:100%;padding-bottom:10px;float:left;">
				<?php
				$data_id  = gabung_id($get_dtl1);
				$quer = "select * from view_group_alamat where substr(id_pengaduan,1,17)='$data_id'";
				$cek_data = mysqli_query($quer);
				$hsl_data = mysqli_fetch_array($cek_data);
				$id_dtl_data = $hsl_data['id_pengaduan'];
				$status_laporan = $hsl_data['status_laporan'];
				if (mysqli_num_rows($cek_data) == 1) {
					$format_tgl1 	= format_tgl($hsl_data['upd_rec'], "/", 2);
					$stats_lapor 	= cek_progress($id_dtl_data);
					$wdlist			= "w100";
					if (empty($stats_lapor) || str_replace("%", "", $stats_lapor) == "0") {
						$wdlist		= "w100";
						echo "<div class='button3' style='padding:6px;overflow:auto;margin-bottom:5px;'>
									<b>No Surat : </b>" . $hsl_data['surat_laporan'] . ",  Tgl : " . $format_tgl1 . ", Kecamatan : " . $hsl_data['default_kecamatan'] . ", Grup : " . $hsl_data['default_grup'] . " 
									<span style='float:right;'>Status : " . $status_laporan . "</span>
								</div>
								<div style='float:left;min-height:300px' class='$wdlist data_detail'>
									<table><tr  class='button4' style='border:none;border-bottom:solid 1px #ddd;padding:5px;'><td colspan='2'>Detail Laporan</td></tr>
									<tr><td width='60px;'><b>Dari </b></td><td>: " . ucwords($hsl_data['pelapor']) . "</td></tr>
									<tr><td><b>Lokasi </b></td><td>: " . $hsl_data['lokasi'] . "</td></tr>
									<tr><td><b>Judul </b></td><td>: " . $hsl_data['judul'] . "</td></tr>
									<tr><td colspan='2'><b>Isi Laporan</b><textarea readonly class='textarea2 w100' >" . $hsl_data['deskripsi'] . "</textarea></td></tr></table>
								</div>";
					} else {
						$cek_pengerjaan = mysqli_query("select * from pu_pengaduan_proses where id_pengaduan='$id_dtl_data' order by CAST(progress AS UNSIGNED) desc");
						if (mysqli_num_rows($cek_pengerjaan) > 0) {
							$wdlist		= "wd50";
						} else {
							$wdlist		= "w100";
						}
						echo "<div class='button3' style='padding:6px;overflow:auto;margin-bottom:5px;'>
									<b>No Surat : </b>" . $hsl_data['surat_laporan'] . ",  Tgl : " . $format_tgl1 . ", Kecamatan : " . $hsl_data['default_kecamatan'] . ", Grup : " . $hsl_data['default_grup'] . " 
									<span style='float:right;'>Status : " . $status_laporan . "  " . $stats_lapor . "</span>
								</div>
								<div style='float:left;min-height:300px' class='$wdlist data_detail'>
									<table><tr  class='button4' style='border:none;border-bottom:solid 1px #ddd;'><td colspan='2'>Detail Laporan</td></tr>
									<tr><td width='60px;'><b>Dari </b></td><td>: " . ucwords($hsl_data['pelapor']) . "</td></tr>
									<tr><td><b>Lokasi </b></td><td>: " . $hsl_data['lokasi'] . "</td></tr>
									<tr><td><b>Judul </b></td><td>: " . $hsl_data['judul'] . "</td></tr>
									<tr><td colspan='2'><b>Isi Laporan</b><textarea readonly class='textarea2 w100' >" . $hsl_data['deskripsi'] . "</textarea></td></tr></table>
								</div>";
						if (mysqli_num_rows($cek_pengerjaan) > 0) {
							echo "<div style='float:left;min-height:270px' class='wd50 data_detail'>
										<table>
										<tr  class='button4' style='border:none;border-bottom:solid 1px #ddd;'><td colspan='4'>Detail Pengerjaan</td></tr>";
							while ($hasil_cek_pengerjaan = mysqli_fetch_array($cek_pengerjaan)) {
								echo "<tr><td class='w10'><b>Tgl</b></td><td class='w30'>" . format_tgl($hasil_cek_pengerjaan['upd_rec'], "-", 4) . "</td><td class='w10'><b>Progress</b></td><td>" . $hasil_cek_pengerjaan["progress"] . "</td></tr>";
								if (strlen($hasil_cek_pengerjaan["deskripsi"]) > 0) {
									echo "<tr><td  colspan='2'  valign='top'><b>Kondisi</b><br/>" . $hasil_cek_pengerjaan["kondisi"] . "</td><td colspan='2' valign='top'><b>Uraian</b><br/> " . $hasil_cek_pengerjaan["uraian"] . "</td></tr>";
									echo "<tr class='btm'><td colspan='4'><b>Keterangan</b><br/><textarea class='textarea w100' readonly style='margin:0;padding:2px;min-height:20px;border:none;box-shadow:none'>" . $hasil_cek_pengerjaan["deskripsi"] . "</textarea></td></tr>";
								} else {
									echo "<tr  class='btm'><td  colspan='2'  valign='top'><b>Kondisi</b><br/>" . $hasil_cek_pengerjaan["kondisi"] . "</td><td colspan='2' valign='top'><b>Uraian</b><br/> " . $hasil_cek_pengerjaan["uraian"] . "</td></tr>";
								}
							}
							echo "
										</table>
									</div>";
						}
					}
				} else {
					echo "<table class='data_detail'><tr><td class='wx50'>data tidak ditemukan </td></tr></table>";
				}
				?>
			</div>
			<div class="list_galery_dtl">
				<table>
					<tr>
						<td class='td_hdr' width='50%'>Foto Sebelum</td>
						<td class='td_hdr'>Foto Sesudah</td>
					</tr>
					<tr>
						<?php
						if (!empty($hsl_data['lampiran'])) {
							$cek_image1 = "select * from pu_galery_img where id_attach='$hsl_data[id_pengaduan]' and recid='B'";
							$cek_img = mysqli_query($cek_image1);
							if (mysqli_num_rows($cek_img) > 0) {
								echo "<td>";
								while ($hsl_cek_img = mysqli_fetch_array($cek_img)) {
									$cek_img_icon = $hsl_cek_img['thumb_file_name'];
									$cek_img_full = $hsl_cek_img['full_file_name'];
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
									<a onclick="OpenPopupCenter('<?= $full_img; ?>', 'TEST!?', 480, 320);return false;"><img src='<?= $thumb_img; ?>' width='65px;' height='60px' style='margin:2px;border:solid 3px #ccc'></a>
								<?php
								}
								echo "</td>";
							}
							$cek_image2 = "select * from pu_galery_img where id_attach='$hsl_data[id_pengaduan]' and recid='A'";
							$cek_img = mysqli_query($cek_image2);
							if (mysqli_num_rows($cek_img) > 0) {
								echo "<td>";
								while ($hsl_cek_img = mysqli_fetch_array($cek_img)) {
									$cek_img_icon = $hsl_cek_img['thumb_file_name'];
									$cek_img_full = $hsl_cek_img['full_file_name'];
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
									<a onclick="OpenPopupCenter('<?= $full_img; ?>', 'TEST!?', 480, 320);return false;"><img src='<?= $thumb_img; ?>' width='65px;' height='60px' style='margin:2px;border:solid 3px #ccc'></a>
						<?php
								}
								echo "</td>";
							}
						}
						?>
					</tr>
				</table>
			</div>
		</div>
		<div style="border-top:solid 1px #ccc;">
			<div class="komen_post" style="padding-left:10px;overflow:auto">
				<h3 class="mtb10">Komentar</h3>
				<div class="komen_post_dtl" style="margin:0 5px 0 0;border:solid 1px #ccc;max-height:400px;overflow:auto;box-shadow:0 1px 3px #ddd;">
					<?php
					require_once "../halaman/show_komeng.php";
					?>
				</div>
			</div>
		</div>

		<?php
	} else {
		if (isset($_GET["action"])) {
			if (!isset($_GET["data_dtl"]) || !isset($_GET["idk"])) {
				die();
			}
			$data_dtl1 = trim(htmlentities(mysqli_real_escape_string($_GET["action"]);
			$data_dtl2 = trim(htmlentities(mysqli_real_escape_string($_GET["data_dtl"]);
			$data_idk  = trim(htmlentities(mysqli_real_escape_string($_GET["idk"]);
			$upd_column = "status='Y'";
			update_data_func('pu_komentar', $upd_column, 'id_komentar', $data_idk, $Redirected);
			function ready_data($field)
			{
				global $Ms_id, $data_dtl2, $data_idk;
				$field = trim(htmlentities(mysqli_real_escape_string($field)));
				if (isset($_POST[$field])) {
					$hasil_data = $_POST[$field];
				} else {
					$adelia = "SELECT $field FROM pu_komentar where id_halaman='$data_dtl2' and id_komentar='$data_idk' and id_reply='x'";
					if (mysqli_query($adelia)) {
						$hsl_data = mysqli_fetch_array(mysqli_query($adelia));
					} else {
						$hsl_data = " ";
					}
					$hasil_data = $hsl_data[0];
				}
				return $hasil_data;
			}
			function ready_data_berkas($field)
			{
				global $Ms_id, $data_dtl2;
				$field = trim(htmlentities(mysqli_real_escape_string($field)));
				$data_dtl = gabung_id($data_dtl2);
				if (isset($_POST[$field])) {
					$hasil_data = $_POST[$field];
				} else {
					$adelia = "SELECT $field FROM pu_pengaduan_berkas WHERE SUBSTR(id_pengaduan,1,17)='$data_dtl'";
					if (mysqli_query($adelia)) {
						$hsl_data = mysqli_fetch_array(mysqli_query($adelia));
					} else {
						$hsl_data = " ";
					}
					$hasil_data = $hsl_data[0];
				}
				return $hasil_data;
			}
			if ($data_dtl1 == "balas") {
				$button = "button3";
				$aktif  = "Simpan Komentar";
			} elseif ($data_dtl1 == "baca") {
				$button = "button2";
				$aktif  = "Baca";
			} elseif ($data_dtl1 == "hapus") {
				$button = "button5";
				$aktif  = "Hapus Komentar";
			} else {
				die();
			}
		?>
			<form method="post" action="" enctype="multipart/form-data">
				<div class="<?= $button; ?>" style="padding:5px">Form <?= $aktif; ?></div>
				<table>
					<tr id="visible">
						<td class="td_right" width="10%">id halaman</td>
						<td>
							<input type='text' class='input' name="no_surat" readonly value="<?= ready_data_berkas("surat_laporan"); ?>" />
						</td>
					</tr>
					<tr id="visible">
						<td class="td_right" width="10%">reply</td>
						<td>
							<input type='text' class='input' name="reply_id" readonly value="<?= ready_data("id_komentar"); ?>" />
						</td>
					</tr>
					<tr>
						<td class="td_right" width="10%">Tgl Jam</td>
						<td>
							<input type='text' class='input' readonly value="<?= ready_data("upd_rec"); ?>" />
						</td>
					</tr>
					<tr>
						<td class="td_right">Pengirim</td>
						<td>
							<input type='text' class='input wx500' readonly value="<?= ready_data("user_komen") . " - " . ready_data("user_email"); ?>" />
						</td>
					</tr>
					<tr>
						<td class="td_right">Data Singkat</td>
						<td>
							<div placeholder="*" name='isi' readonly id='isi' class="textarea w98"><?php
																									echo
																									"<div><b>Laporan : </b>" . ready_data_berkas("judul") . "</div>
						<div><b>Isi  :</b> " . paragrap(ready_data_berkas("deskripsi"), 15) . "</div><br/>
						<b>Komentar : </b>
						<textarea   class='textarea w100' readonly style='border:none;font-size:12px;max-height:100%'>" . ready_data("isi_komentar") . "</textarea>";
																									?></div>
						</td>
					</tr>
					<?php if ($data_dtl1 == "balas") { ?>
						<tr>
							<td class="td_right">Balas Komentar</td>
							<td>
								<textarea placeholder="*" name='balasan' required id='balasan' style="background:#fff" class="textarea w98"><?= ready_data("balasan"); ?></textarea>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td>
							<input type='submit' class='input wx150 <?= $button; ?>' style="margin:2px;" name='simpan' id='simpan' value="<?= $aktif; ?>" />
							<?php
							if (isset($_GET["page_num"])) {
								$page_num = "&page_num=" . $_GET["page_num"];
							} else {
								$page_num = "";
							}
							if ($data_dtl1 != 'hapus') {
								$url_back = $Redirected . $page_num;
								$form_del = $url_back . "&action=hapus&data_dtl=" . $data_dtl2 . "&idk=" . $data_idk;
								if (ready_data("status") == "Y") {
									echo "<a href='$form_del'><input type='button' class='input wx150 button5' style='margin:2px;' name='simpan' id='simpan' value='Hapus komentar' /></a>";
								}
							} elseif ($data_dtl1 == 'hapus') {
								$url_back = $Redirected . $page_num . "&action=balas&data_dtl=" . $data_dtl2 . "&idk=" . $data_idk;
							} else {
								$url_back = $Redirected . $page_num;
							}
							?>
							<a href="<?php
										echo $url_back; ?>"><input type="button" class="input wx150 button4" style="margin:2px;" value='Kembali' readonly /></a>
						</td>
						</td>
				</table>
			</form>
			<?php
			if (isset($_POST["simpan"])) {
				$table 			= "pu_komentar";
				if ($data_dtl1 != 'hapus') {
					if (empty(trim($_POST["balasan"]))) {
						$Msg = "komentar balasan belum di isi";
					} else {
						$key_dtl1 		= $data_dtl2;
						$key_dtl2	 	= $data_idk;
						$key_page 		= $data_dtl1;
						$isi_data 		= trim(htmlentities(mysqli_real_escape_string($_POST["balasan"]);
						$user_add 		= trim(htmlentities(mysqli_real_escape_string($Ms_grup)));
						$mail_user 		= "admin@admin";
						$id_komen  		= $_POST["no_surat"];
						$id_reply	  	= $_POST["reply_id"];
						$id_random 		= rand(0, 999);
						$id_komen_id	= str_replace(array(" ", ":", "-"), "", $tgl_jam) . $id_random;
						$column1 		= "upd_rec,user_komen,user_email,halaman,id_halaman,id_halaman_dtl,id_komentar,id_reply,isi_komentar,aktif,status";
						$column2 		= "'$tgl_jam','$user_add','$mail_user','$key_page','$key_dtl1','$id_komen','$id_komen_id','$id_reply','$isi_data','X','Y'";
						if (insert_data_func($table, $column1, $column2, "", "", $url_back) == "Y") {
							$Msg = "Y";
						} else {
							$Msg = "error sintak cek log..";
						}
					}
				} else {
					if (delete_data_func($table, 'id_komentar', $data_idk, $url_back) == "Y") {
						$Msg  = "Y";
						$Msg2 = "komentar sudah di hapus..!";
					} else {
						$Msg  = "error sintak, hub admin web";
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
						$timeout = 1000;
					}
				?>
					<script>
						alert("sukses..!<?= $Msgx; ?>");
						setTimeout(
							function() {
								window.location.href = "<?= $Redirected; ?>";
							},
							<?= $timeout; ?>);
					</script>
			<?php
				}
			}
		} else {
			?>
			<div id="list_result" style="border:solid 1px #ddd">
		<?php
			$num_rec_per_page = 12; //pagination
			if (isset($_GET['page_num'])) {
				if (empty($_GET['page_num']) or $_GET["page_num"] < 1) {
					$project_page = 1;
				} else {
					$project_page = $_GET['page_num'];
				}
			} else {
				$project_page = 1;
			}
			$Page = "&page_num=$project_page";
			if (isset($_GET["page_num"])) {
				if (empty($_GET['page_num']) or $_GET["page_num"] < 1) {
					$page_num = 1;
				} else {
					$page_num  = $_GET["page_num"];
				}
			} else {
				$page_num = 1;
			};
			$start_from = ($page_num - 1) * $num_rec_per_page;
			$query = "
			select * from pu_komentar where aktif='Y' order by status ASC, upd_rec desc
			limit $start_from, $num_rec_per_page";
			$cek_list_data = mysqli_query($query));
			$Qry	= mysqli_query("select count(1) from pu_komentar where id_reply='x'");
			echo "<table>";
			echo "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx75  show_td'>Tgl Jam</td><td class='td_hdr wx75'>Sumber</td><td class='td_hdr show_td'>Pengirim</td><td class='td_hdr wx200 show_td'>Email</td><td class='td_hdr '>Isi komentar</td><td class='td_hdr wx75'>Action</td></tr>";
			if ($page_num == 1) {
				$no = 1;
			} else {
				$no = 12 * ($page_num - 1) + 1;
			}
			while ($hsl_list_data = mysqli_fetch_array($cek_list_data)) {
				$format_tgl = substr($hsl_list_data['upd_rec'], 8, 2) . "." . substr($hsl_list_data['upd_rec'], 5, 2) . "." . substr($hsl_list_data['upd_rec'], 2, 2) . " " . substr($hsl_list_data['upd_rec'], 11, 2) . ":" . substr($hsl_list_data['upd_rec'], 14, 2);
				if (isset($_GET["page_num"])) {
					$page_num = "&page_num=" . $_GET["page_num"];
				} else {
					$page_num = "";
				}
				if ($hsl_list_data['status'] == "X") {
					$frm_baca = "<a href='$Redirected$page_num&action=balas&data_dtl=$hsl_list_data[id_halaman]&idk=$hsl_list_data[id_komentar]' class='button3' style='padding:3px;border-radius:50px'> balas </a>";
				} else {
					$frm_baca = "<a href='$Redirected$page_num&action=balas&data_dtl=$hsl_list_data[id_halaman]&idk=$hsl_list_data[id_komentar]' class='button1' style='padding:3px;border-radius:50px'> balas </a>";
				}
				$status_laporan = $hsl_list_data['aktif'];
				if (substr($hsl_list_data['id_halaman'], 0, 2) != "XX") {
					$class_lampiran = "";
					$get_id 		= $hsl_list_data['id_halaman'];
				} else {
					$class_lampiran = "style='color:#006ab4'";
					$get_id 		= $hsl_list_data['id_halaman'];
				}
				$get_url = $Redirected . $page_num . "&dtl1=" . $get_id . "&dtl2=" . $hsl_list_data['id_halaman_dtl'];
				echo "<tr class='tr'><td class='right'>$no</td><td class=' show_td'>" . $format_tgl . "</td><td class='more_x'><a href='$get_url' class='no_surat' $class_lampiran>$hsl_list_data[id_halaman_dtl]</a></td><td class='show_td'>$hsl_list_data[user_komen]</td><td class='show_td'>$hsl_list_data[user_email]</td><td >" . paragrap($hsl_list_data['isi_komentar'], 10) . "</td><td>$frm_baca</td></tr>";
				$no++;
			}
			echo "</table>";
			/*pagination start*/
			$jmldata = mysqli_fetch_row($Qry);
			if ($jmldata[0] > $num_rec_per_page) {
				echo '<div  class="page_pagination"><label style="float:right;width:100%;text-align:right;">';
				$jml_page = ceil($jmldata[0] / $num_rec_per_page);
				if ($project_page > 1) {
					$previous = $project_page - 1;
					echo "<a href=$Redirected&page_num=1 ><<</a> <a href=$Redirected&page_num=$previous ><</a> ";
				} else {
					echo "<a><<</a> <a><</a>";
				}

				$angka = ($project_page > 3 ? "<b>... </b>" : " ");
				for ($i = $project_page - 2; $i < $project_page; $i++) {
					if ($i < 1)
						continue;
					$angka .= "<a href=$Redirected&page_num=$i >$i</a> ";
				}

				$angka .= " <span class='paging_pilih'>$project_page</span> ";
				for ($i = $project_page + 1; $i < ($project_page + 3); $i++) {
					if ($i > $jml_page)
						break;
					$angka .= "<a href=$Redirected&page_num=$i >$i</a> ";
				}
				$angka .= ($project_page + 2 < $jml_page ? "<b>... </b>
						  <a href=$Redirected&page_num=$jml_page >$jml_page</a> " : " ");
				echo $angka;
				if ($project_page < $jml_page) {
					$next = $project_page + 1;
					echo "&nbsp;<a href=$Redirected&page_num=$next >></a> <a href=$Redirected&page_num=$jml_page >>></a> ";
				} else {
					echo "&nbsp;<a>></a> <a>>></a>";
				}
				echo "</label></div>";
			}
		}
	}
		?>
			</div>
			<i class="xnotif">Status komentar (hijau belum di buka, biru sudah pernah buka)</i>
</div>
<script type="text/javascript" src="skrip/autosize.min.js"></script>
<script type="text/javascript">
	autosize(document.querySelectorAll('textarea'));
</script>