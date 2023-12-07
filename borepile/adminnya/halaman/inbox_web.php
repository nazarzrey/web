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
<div style="max-height:100%;overflow:auto;" class="content_dtl2_admin frm_input">
	<?php
	if (isset($_GET["action"])) {
		if (!isset($_GET["data_dtl"])) {
			die();
		}
		$data_dtl1 = escape($_GET["action"]);
		$data_dtl2 = escape($_GET["data_dtl"]);
		$upd_column = "status='1'";
		update_data_func('pesan', $upd_column, 'id_halaman', $data_dtl2, $Redirected);
		function ready_data($field)
		{

			global $data_dtl2, $Redirected, $db;
			$field = escape($field);
			if (isset($_POST[$field])) {
				$hasil_data = $_POST[$field];
			} else {
				$adelia = "SELECT $field FROM pesan where id_halaman='$data_dtl2'";
				if ($hsl_data = $db->select($adelia)) {
				} else {
					log_error($Redirected, $adelia);
					$hsl_data = "x";
				}
				$hasil_data = $hsl_data[0];
			}
			return $hasil_data[$field];
		}
		if ($data_dtl1 == "view") {
			$button = "button3";
			$aktif  = "display:none;";
		} elseif ($data_dtl1 == "baca") {
			$button = "button2";
			$aktif  = "";
		} else {
			die();
		}
	?>
		<form method="post" action="" enctype="multipart/form-data">
			<div class="<?= $button; ?>" style="padding:5px">Form baca Laporan</div>
			<table>
				<tr>
					<td class="td_right">Tgl Jam</td>
					<td>
						<input type='text' class='input' readonly value="<?= ready_data("upd_rec"); ?>" />
					</td>
				</tr>
				<tr>
					<td class="td_right">Pengirim</td>
					<td>
						<input type='text' class='input wx500' readonly value="<?= ready_data("pengirim"); ?>" />
					</td>
				</tr>
				<tr>
					<td class="td_right">Email</td>
					<td>
						<input type='text' class='input wx500' readonly value="<?= ready_data("email"); ?>" />
					</td>
				</tr>
				<tr>
					<td class="td_right">Isi</td>
					<td>
						<textarea placeholder="*" name='isi' readonly id='isi' style="height:100px;" class="textarea w98"><?= ready_data("isi"); ?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' class='input wx150 button5' style="margin:2px;<?= $aktif; ?>" name='simpan' id='simpan' value="Hapus Data" />
						<a href="<?= $Redirected; ?>"><input type="button" class="input wx150 button4" style="margin:2px;" value='Kembali' readonly /></a>
					</td>
					</td>
			</table>
		</form>
		<?php
		if (isset($_POST["simpan"])) {
			if (isset($_POST["status"])) {
				$status = "Y";
			} else {
				$status = "X";
			}
			$upd_data = "delete  from pesan  where id_halaman='$data_dtl2'";
			#break;
			if ($db->query($upd_data)) {
				$Msg = "Y";
			} else {
				log_error($Redirected, $insert_data);
				$Msg = "error sintak, silahkan di ulang";
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
					$timeout = 1000;
				} else {
					$Msgx = "";
					$timeout = 500;
				}
			?>
				<script>
					alert("Pesan sudash di hapus..! <?= $Msgx; ?>");
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
		$num_rec_per_page = 10; //pagination
		if (isset($_GET['page'])) {
			if (empty($_GET['page']) or $_GET["page"] < 1) {
				$project_page = 1;
			} else {
				$project_page = $_GET['page'];
			}
		} else {
			$project_page = 1;
		}
		$Page = "&page=$project_page";
		if (isset($_GET["page"])) {
			if (empty($_GET['page']) or $_GET["page"] < 1) {
				$page = 1;
			} else {
				$page  = $_GET["page"];
			}
		} else {
			$page = 1;
		};
		$start_from = ($page - 1) * $num_rec_per_page;
		$query = "select * from pesan order by  status asc, upd_rec desc  limit $start_from, $num_rec_per_page";
		$cek_list_data = $db->select($query);
		$Qry	= $db->select("select count(1) from pesan");
		echo "<table>";
		echo "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx75  show_td'>Tgl Jam</td><td class='td_hdr'>Pengirim</td><td class='td_hdr wx200 show_td'>Email</td><td class='td_hdr '>Isi Pesan</td><td class='td_hdr wx75'>Action</td></tr>";
		if ($page == 1) {
			$no = 1;
		} else {
			$no = 10 * ($page - 1) + 1;
		}
		foreach ($cek_list_data as $key => $hsl_list_data) {
			$format_tgl = substr($hsl_list_data['upd_rec'], 8, 2) . "." . substr($hsl_list_data['upd_rec'], 5, 2) . "." . substr($hsl_list_data['upd_rec'], 2, 2) . " " . substr($hsl_list_data['upd_rec'], 11, 2) . ":" . substr($hsl_list_data['upd_rec'], 14, 2);
			if ($hsl_list_data['status'] == "0") {
				$frm_baca = "<a href='$Redirected&action=view&data_dtl=$hsl_list_data[id_halaman]' class='button3' style='padding:3px;border-radius:50px'> detail </a>";
			} else {
				$frm_baca = "<a href='$Redirected&action=baca&data_dtl=$hsl_list_data[id_halaman]' class='button5' style='padding:3px;border-radius:50px'>delete</a>";
			}
			$get_dtl_it = $hsl_list_data["id_halaman"];
			$get_url = $Redirected;
			echo "<tr class='tr'><td class='right'>$no</td><td class=' show_td'>" . $format_tgl . "</td><td class='more_x'>$hsl_list_data[pengirim]</td><td class='show_td'>$hsl_list_data[email]</td><td >" . paragrap($hsl_list_data['isi'], 15) . "</td><td>$frm_baca</td></tr>";
			$no++;
		}
		echo "</table>";
		$jmldata = count($Qry);
		if ($jmldata[0] > $num_rec_per_page) {
			echo '<div  class="page_pagination"><label style="float:right;width:100%;text-align:right;">';
			$jml_page = ceil($jmldata[0] / $num_rec_per_page);
			if ($project_page > 1) {
				$previous = $project_page - 1;
				echo "<a href=$Redirected&page=1 ><<</a> <a href=$Redirected&page=$previous ><</a> ";
			} else {
				echo "<a><<</a> <a><</a>";
			}

			$angka = ($project_page > 3 ? "<b>... </b>" : " ");
			for ($i = $project_page - 2; $i < $project_page; $i++) {
				if ($i < 1)
					continue;
				$angka .= "<a href=$Redirected&page=$i >$i</a> ";
			}

			$angka .= " <span class='paging_pilih'>$project_page</span> ";
			for ($i = $project_page + 1; $i < ($project_page + 3); $i++) {
				if ($i > $jml_page)
					break;
				$angka .= "<a href=$Redirected&page=$i >$i</a> ";
			}
			$angka .= ($project_page + 2 < $jml_page ? "<b>... </b>
					  <a href=$Redirected&page=$jml_page >$jml_page</a> " : " ");
			echo $angka;
			if ($project_page < $jml_page) {
				$next = $project_page + 1;
				echo "&nbsp;<a href=$Redirected&page=$next >></a> <a href=$Redirected&page=$jml_page >>></a> ";
			} else {
				echo "&nbsp;<a>></a> <a>>></a>";
			}
			echo "</label></div>";
		}
	}
		?>
		</div>
		<i class="xnotif">Keter Action (biru sudah pernah di baca, hijau belum pernah di baca)</i>
</div>
<script type="text/javascript" src="skrip/autosize.min.js"></script>
<script type="text/javascript">
	autosize(document.querySelectorAll('textarea'));
</script>