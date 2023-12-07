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
	$(function() {
		var f = function() {
			$(this).next().text($(this).is(':checked') ? ':checked' : ':not(:checked)');
		};
		$('input').change(f).trigger('change');
	});
</script>
<?php /*
if(!isset($id_jenis)){
	die();
} */
require_once "../seting/convert_image.php";
$wmax1 = 750;
$hmax1 = 750;
$wmax3 = 250;
$hmax3 = 250;
$wmax5 = 75;
$hmax5 = 75;
$str_arr   	= array(',', "'", '"', '@', ';', ':', '+', '*', "/", "\\", "?", "!", ".", "<", ">", "=", '~', '#', '$', '%', '^', '(', ')', '{', '}', '[', ']', '&');
$hdr_page   = escape($_GET[$page]);
$periode 		= date("Y-m-d H:i:s");
if (isset($_GET["dtl_cnt"])) {
	$data_page  = escape($_GET["dtl_cnt"]);
	$Redirected = $get_page . "=" . $hdr_page . "&dtl_cnt=" . $data_page;
	$id_content = str_replace('-', ' ', $data_page);
	$table      = "content_dtl";
	$content    = $id_content;
	if ($content == "utama") {
		$query      = "SELECT a.deskripsi,b.*,c.nama FROM 
					content_hdr a RIGHT OUTER JOIN content_dtl b
					ON a.id_hdr_content=b.id_fk_jenis
					LEFT OUTER JOIN master_user  c
					ON b.user_add=c.id_user where b.aktif='Y' and b.utama='Y' order by aktif desc, utama desc, upd_rec desc";
		$query_ttl = "SELECT count(1) FROM 
					content_hdr a RIGHT OUTER JOIN content_dtl b
					ON a.id_hdr_content=b.id_fk_jenis
					LEFT OUTER JOIN master_user  c
					ON b.user_add=c.id_user
					where b.aktif='Y' and b.utama='Y'";
		$query_ttl_utama	= "select utama_max from content_hdr";
		$hdr_table  = "<tr><td class='td_hdr wx25 show_td'>No</td><td class='td_hdr show_td wx75'>Tgl Jam</td><td class='td_hdr wx75'>Jenis</td><td class='td_hdr'>Judul</td><td class='td_hdr'>Isi</td><td class='td_hdr wx100 show_td'>User Add</td><td class='td_hdr wx50'>Img</td><td class='td_hdr wx10'>A</td><td class='td_hdr wx10'>U</td><td class='td_hdr wx50'>Action</td></tr>";
	} elseif ($content == "favorit") {
		$query      = "
					SELECT c.deskripsi,a.*, COUNT(b.id_fk_content) AS nama FROM 
					favorit_content b LEFT OUTER JOIN content_dtl a
					ON a.id_dtl_content = b.id_fk_content
					LEFT OUTER JOIN content_hdr c
					ON c.id_hdr_content=a.id_fk_jenis				
					WHERE (a.aktif = 'Y')
					GROUP BY b.id_fk_content
					ORDER BY COUNT(a.id_dtl_content)DESC";
		$query_ttl = "
					SELECT  COUNT(DISTINCT(b.id_fk_content)) FROM 
					favorit_content b LEFT OUTER JOIN content_dtl a
					ON a.id_dtl_content = b.id_fk_content
					LEFT OUTER JOIN content_hdr c
					ON c.id_hdr_content=a.id_fk_jenis				
					WHERE (a.aktif = 'Y')
					ORDER BY COUNT(a.id_dtl_content)DESC";
		$query_ttl_utama	= "select utama_max from content_hdr";
		$hdr_table  = "<tr><td class='td_hdr wx25 show_td'>No</td><td class='td_hdr show_td wx75'>Tgl Jam</td><td class='td_hdr wx75'>Jenis</td><td class='td_hdr'>Judul</td><td class='td_hdr'>Isi</td><td class='td_hdr wx100  show_td'>Visit</td><td class='td_hdr wx50'>Img</td><td class='td_hdr wx10'>A</td><td class='td_hdr wx10'>U</td><td class='td_hdr wx50'>Action</td></tr>";
	} else {
		$query      = "SELECT a.deskripsi,b.*,c.nama FROM 
					content_hdr a RIGHT OUTER JOIN content_dtl b
					ON a.id_hdr_content=b.id_fk_jenis
					LEFT OUTER JOIN master_user  c
					ON b.user_add=c.id_user
					where a.deskripsi='$id_content' order by aktif desc, utama desc, upd_rec desc";
		$query_ttl = "SELECT count(1) FROM 
					content_hdr a RIGHT OUTER JOIN content_dtl b
					ON a.id_hdr_content=b.id_fk_jenis
					LEFT OUTER JOIN master_user  c
					ON b.user_add=c.id_user
					where a.deskripsi='$id_content' and b.aktif='Y' and b.utama='Y'";
		$query_ttl_utama	= "select utama_max from content_hdr where deskripsi='$id_content'";
		$hdr_table  = "<tr><td class='td_hdr wx25 show_td'>No</td><td class='td_hdr show_td wx75'>Tgl Jam</td><td class='td_hdr'>Judul</td><td class='td_hdr'>Isi</td><td class='td_hdr wx100  show_td'>User Add</td><td class='td_hdr wx50  show_td'>Urut</td><td class='td_hdr wx50'>Img</td><td class='td_hdr wx10'>A</td><td class='td_hdr wx10'>U</td><td class='td_hdr wx50'>Action</td></tr>";
	}
} else {
	$data_page  = "";
	$Redirected = $get_page . "=" . $hdr_page;
	$id_content = str_replace('-', ' ', $data_page);
	$table      = "content_dtl";
	$content    = $id_content;
	$query      = "SELECT a.deskripsi,b.*,c.nama FROM 
				content_hdr a RIGHT OUTER JOIN content_dtl b
				ON a.id_hdr_content=b.id_fk_jenis
				LEFT OUTER JOIN master_user  c
				ON b.user_add=c.id_user order by aktif desc, utama desc,  upd_rec desc";
	$query_ttl = "SELECT count(1) FROM 
				content_hdr a RIGHT OUTER JOIN content_dtl b
				ON a.id_hdr_content=b.id_fk_jenis
				LEFT OUTER JOIN master_user  c
				ON b.user_add=c.id_user and b.aktif='Y'  and b.utama='Y'";
	$hdr_table  = "<tr><td class='td_hdr wx25 show_td'>No</td><td class='td_hdr show_td wx75'>Tgl Jam</td><td class='td_hdr'>Judul</td><td class='td_hdr'>Isi</td><td class='td_hdr wx100'>Jenis</td><td class='td_hdr wx100  show_td'>User Add</td><td class='td_hdr wx50  show_td'>Urut</td><td class='td_hdr wx50'>Img</td><td class='td_hdr wx10'>A</td><td class='td_hdr wx10'>U</td></tr>";
}
$cek_id		= "id_dtl_content";
$cek_row    = "&nbsp;&nbsp;ada " . count($db->select($query)) . " data " . $content;
#echo $query;
#require_once "modal.php";
?>
<div style="max-height:100%;overflow:auto;" class="content_dtl2_admin frm_input">
	<?php
	if (!isset($_GET["action"])) {
		if (isset($_GET["dtl_cnt"])) {
			if ($_GET["dtl_cnt"] !== "utama" and $_GET["dtl_cnt"] !== "favorit") {
	?>

				<a href="<?= $Redirected . "&action=add"; ?>">
					<div id="add" style="padding:5px;float:left; border-radius:5px;margin-bottom:5px;" class="button4">
						<img src="../gambar/add2.png" class="add_icon" style="float:left;width:20px"><label style="margin:3px;float:left">Add <?= ucwords($id_content) ?></label>
					</div>
				</a>
				<div class="data_exists"><?= $cek_row; ?></div>
				<div class="icon_notif"><span style='float:left'><a class='edit'></a> Edit </span> <span style='float:left'> <a class='delete'></a> Hapus </span><span style="margin-left:5px;font-weight:bold">A:aktif, U:utama</span></div>
		<?php
			}
		}
		?>
		<div id="list_result" style="max-height:450px;overflow:auto;width:99%;border:solid 1px #ddd;">
			<?php
			$cek_list_data = $db->select($query);
			echo "<table>";
			echo $hdr_table;
			$x = 1;
			foreach ($cek_list_data as $hsl_list_data) {
				$img = trim($hsl_list_data["img_content"]);
				if (!empty($img) and file_exists($path_img . str_replace("full_", "thumb_", $img))) {
					$gambar = "<img src='" . $path_img . str_replace("full_", "thumb_", $img) . "' width='50px' style='border:solid 1px #ccc' />";
				} else {
					$gambar = "";
				}
				$jdl_content = paragrap($hsl_list_data["judul"], 10);
				$isi_content = trim(paragrap($hsl_list_data["isi"], 20));
				if (!empty($data_page)) {
					if ($hsl_list_data["aktif"] == "Y") {
						$style_aktif = "style='color:#006ab4';";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_dtl_content]' class='edit'></a>";
					} elseif ($hsl_list_data["aktif"] == "N") {
						$style_aktif = "style='color:#006ab4';";
						$url_action = "<a href='$Redirected&action=edit&data_dtl=$hsl_list_data[id_dtl_content]' class='edit'></a> <a href='$Redirected&action=delete&data_dtl=$hsl_list_data[id_dtl_content]' class='delete'></a>";
					} else {
						$style_aktif = "style='color:red;'";
						$url_action = "";
					}
				} else {
					$style_aktif = "style='color:#333;'";
					$url_action = "";
				}
				if (isset($_GET["dtl_cnt"])) {
					if ($content == "utama") {
						echo "<tr class='tr'><td class='right show_td'  $style_aktif>$x</td><td class='right show_td'  $style_aktif>" . substr($hsl_list_data['upd_rec'], 2, 14) . "</td><td class='right'  $style_aktif>" . $hsl_list_data['deskripsi'] . "</td><td class='right'  $style_aktif>" . $jdl_content . "</td><td  $style_aktif>" . $isi_content . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['nama'] . "</td><td $style_aktif>" . $gambar . "</td><td  $style_aktif>$hsl_list_data[aktif]</td><td  $style_aktif>$hsl_list_data[utama]</td><td>$url_action</td></tr>";
					} elseif ($content == "favorit") {
						echo "<tr class='tr'><td class='right show_td'  $style_aktif>$x</td><td class='right show_td'  $style_aktif>" . substr($hsl_list_data['upd_rec'], 2, 14) . "</td><td class='right'  $style_aktif>" . $hsl_list_data['deskripsi'] . "</td><td class='right'  $style_aktif>" . $jdl_content . "</td><td  $style_aktif>" . $isi_content . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['nama'] . "</td><td $style_aktif>" . $gambar . "</td><td  $style_aktif>$hsl_list_data[aktif]</td><td  $style_aktif>$hsl_list_data[utama]</td><td>$url_action</td></tr>";
					} else {
						echo "<tr class='tr'><td class='right show_td'  $style_aktif>$x</td><td class='right show_td'  $style_aktif>" . substr($hsl_list_data['upd_rec'], 2, 14) . "</td><td class='right'  $style_aktif>" . $jdl_content . "</td><td  $style_aktif>" . $isi_content . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['nama'] . "</td><td $style_aktif>" . $hsl_list_data['urut'] . "</td><td $style_aktif>" . $gambar . "</td><td  $style_aktif>$hsl_list_data[aktif]</td><td  $style_aktif>$hsl_list_data[utama]</td><td>$url_action</td></tr>";
					}
				} else {
					echo "<tr class='tr'><td class='right show_td'  $style_aktif>$x</td><td class='right show_td'  $style_aktif>" . substr($hsl_list_data['upd_rec'], 2, 14) . "</td><td class='right'  $style_aktif>" . $jdl_content . "</td><td  $style_aktif>" . $isi_content . "</td><td $style_aktif>" . $hsl_list_data['deskripsi'] . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['nama'] . "</td><td $style_aktif>" . $hsl_list_data['urut'] . "</td><td $style_aktif>" . $gambar . "</td><td  $style_aktif>$hsl_list_data[aktif]</td><td  $style_aktif>$hsl_list_data[utama]</td></tr>";
				}
				$x++;
			}
			?>
			</table>
		</div>
		<i class="xnotif">* jika tidak aktif / bukan utama maka urut akan menjadi 999</i>
	<?php
	} else {
		if (isset($_GET["data_dtl"])) {
			$data_dtl = escape($_GET["data_dtl"]);
		} else {
			$data_dtl = "data tidak ada";
		}
		function ready_data($field)
		{
			global $Ms_id, $table, $cek_id, $data_dtl, $periode, $content, $db;
			if ($field == "aktif" or $field == "utama") {
				if (isset($_POST[$field])) {
					$hasil_data = "Y";
				} else {
					$aa = "select $field from $table where id_dtl_content='$data_dtl'";
					$cek_data = $db->select($aa);

					if ($cek_data) {
						$hsl_data = $cek_data[0][$field];
					} else {
						$hsl_data = "";
					}
					if ($hsl_data == "Y") {
						$hasil_data = "Y";
					} else {
						$hasil_data = "N";
					}
				}
			} elseif ($field == "upd_rec") {
				if (isset($_GET["data_dtl"])) {
					$zf = "select $field from $table where id_dtl_content='$data_dtl'";
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
					$zf = "select $field from $table where id_dtl_content='$data_dtl'";
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
					$zf = "select $field from $table where id_dtl_content='$data_dtl'";
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
		function content_dtl($field)
		{
			global $Ms_id, $table, $cek_id, $data_dtl, $periode, $db;
			if ($field == "favorit" or $field == "utama") {
				if (isset($_GET["data_dtl"])) {
					$aa = "SELECT a.deskripsi FROM 
					content_hdr a RIGHT OUTER JOIN content_dtl b
					ON a.id_hdr_content=b.id_fk_jenis
					WHERE id_dtl_content='$data_dtl'";
					$cek_data = $db->select($aa);
					if ($cek_data) {
						$hsl_data = $cek_data[0][$field];
					} else {
						$hsl_data = "";
					}
					if (!empty($hsl_data[0])) {
						echo ' Jenis <input type="text" class="input" readonly value="' . $hsl_data[0] . '"/>';
					} else {
						echo ' Jenis <input type="text" class="input" readonly value="tidak di ketahui"/>';
					}
				}
			}
		}
		function ready_data_dtl($data_dtl)
		{
			global $table, $db;
			$cek_data = $db->select("select ifnull(img_content,'X') from $table where id_dtl_content='$data_dtl'");
			if ($cek_data) {
				$hsl_data = $cek_data[0][$field];
			} else {
				$hsl_data = "";
			}
			return $hsl_data;
		}
		function post_data($data_post)
		{
			if (isset($data_post)) {
				return $data_post;
			}
		}
		function upload_image_fnc($data_img)
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
		if (isset($query_ttl_utama)) {
			$ttl_utama  = count($db->select($query_ttl_utama));
			if (!empty($ttl_utama[0])) {
				$max = $ttl_utama[0];
			} else {
				$max = 7;
			}
		} else {
			$max = 7;
		}
		if ($_GET["action"] == "add") {
			$hdr_notif = "Tambah";
			$button    = "button3";
			$ttl  = count($db->select($query_ttl));
			#echo $ttl[0];
			if ($ttl[0] >= $max) {
				$select     = 'X';
			} else {
				$select     = 'Z';
			}
			$catatan    = "<i style='color:blue;'>* maksimal $max $id_content yang aktif</i>";
			$input_tipe = "";
			$input_btn  = "Simpan";
			$aktif_content = " checked ";
		} elseif ($_GET["action"] == "delete") {
			$hdr_notif = "delete";
			$button    = "button5";
			$select     = ' disabled ';
			$catatan    = "<i style='color:red'>* Akan di hapus permanen, karena belum pernah login</i>";
			$input_tipe = "readonly";
			$input_btn  = "Delete";
			$ttl  = count($db->select($query_ttl));
			$result_aktif = ready_data("aktif");
			if ($result_aktif == "Y") {
				$aktif_content = " checked disabled";
			} else {
				$aktif_content = " disabled ";
			}
		} elseif ($_GET["action"] == "edit") {
			$hdr_notif = "edit";
			$button    = "button2";
			$ttl  = count($db->select($query_ttl));
			if ($ttl[0] >= $max) {
				$select     = 'X';
			} else {
				$select     = 'Z';
			}
			$catatan    = "<i style='color:blue;'>* maksimal $max $id_content yang aktif</i>";
			$input_tipe = "";
			$input_btn  = "Simpan";
			$result_aktif = ready_data("aktif");
			if ($result_aktif == "Y") {
				$aktif_content = " checked ";
			} else {
				$aktif_content = " ";
			}
		} else {
			die();
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
		function urut_show($nomor)
		{
			global  $table, $content, $db;
			$zahwa 		= "select max(ifnull(urut,0)+1) from $table where urut!='999' and aktif='Y' and utama='Y' AND id_fk_jenis IN (SELECT id_hdr_content FROM content_hdr WHERE deskripsi='$content')";
			$cek_data 	= $db->select($zahwa);
			$hsl_cek  	= count($cek_data);
			$hasil_data = "<select name='urut' class='select wx75'>";
			if (empty($hsl_cek[0])) {
				$hasil_data .= "<option value='1'>1</option>";
			} else {
				if ($nomor == "999") {
					$hasil_data .= "<option value='$hsl_cek[0]'>$hsl_cek[0]</option>";
				} else {
					$hasil_data .= "<option value='$nomor'>$nomor</option>";
				}
				for ($firdaus = 1; $firdaus <= $hsl_cek[0]; $firdaus++) {
					if ($firdaus <> $nomor) {
						$hasil_data .= "<option value='$firdaus'>$firdaus</option>";
					}
				}
			}
			$hasil_data .= "</select>";
			echo $hasil_data;
		}
	?>
		<form method="post" action="" enctype="multipart/form-data">
			<div class="<?= $button; ?>" style="padding:5px">Form <?= ucwords($hdr_notif . " " . $id_content); ?></div>
			<table>
				<tr>
					<td width="10%" class="td_right">Status</td>
					<td>
						<div class="status_input"><?php
										#echo $result = ready_data("aktif");
										?>
							<label for="status" style="padding-top:8px;float:left;margin-right:5px;">Aktif</label>
							<input type="checkbox" <?= $aktif_content; ?> class="flipswitch input" id="status" name="status" />
						</div>
						<div class="status_input"><?php
										#echo $result = ready_data("utama").$select;
										?>
							<label for="utama" style="padding-top:8px;float:left;margin-right:5px;">Berita utama</label>
							<input type="checkbox" <?php
										$result = ready_data("utama") . $select;
										if ($result == "YX") {
											echo " checked ";
										} elseif ($result == "YZ") {
											echo " checked ";
										} elseif ($result == "NX") {
											echo " disabled ";
										} elseif ($result == "NZ") {
											echo " ";
										} else {
											echo " disabled ";
										}
										?> class="flipswitch input" name="utama" />
						</div>
						<div class="status_input">
							<label style="padding-top:8px;float:left;margin-right:5px;">Utama Aktif</label>
							<input type="text" class="input wx35 tengah" style='padding:5px;' readonly value="<?= $ttl[0]; ?>" />
						</div>
					</td>
				</tr>
				<tr>
					<td class="td_right">Tgl Jam</td>
					<td>
						<input type='text' class='input' readonly value="<?= ready_data("upd_rec"); ?>" />
						<?php content_dtl($content); ?>
					</td>
				</tr>
				<tr>
					<td class="td_right">Urut Show</td>
					<td>
						<?php
						if (ready_data("urut") <= $max) {
							$show_urut =  ready_data("urut");
						} else {
							$show_urut =  "999";
						}
						if ($_GET["action"] == "edit") {
							urut_show($show_urut);
						} else {
							echo "<input type='text' class='input wx75' readonly  name='urut' id='urut' value='$show_urut'/>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="td_right">Judul</td>
					<td>
						<input type='text' class='input wx500' name='judul' id='judul' required maxlength="100" autocomplete="off" placeholder="*" value="<?= ready_data("judul"); ?>" />
					</td>
				</tr>
				<tr>
					<td class="td_right">Isi</td>
					<td>
						<textarea placeholder="*" name='isi' id='isi' required class="textarea w98 " style="height:100px;background:#fff;"><?= ready_data("isi"); ?></textarea>
					</td>
				</tr>
				<tr>
					<td class="td_right">Gambar</td>
					<td>
						<input type='file' class='input wx250' name='gambar' id='attach' accept="image/*" onchange="GetFileInfo()" /> ext gambar yang di terima jpg, jpeg, png, tif
					</td>
				</tr>
				<?php if ($_GET["action"] != "add") { ?>
					<tr>
						<td class="td_right">Gambar Lama</td>
						<td>
							<?php
							if (!empty(ready_data("img_content")) and file_exists($path_img . ready_data("img_content"))) {
								echo '<img src="' . $path_img . ready_data("img_content") . '" class="wx350" style="border:solid 3px #ccc;"/>';
							} else {
								echo "<i>tidak ada gambar</i>";
							} ?>

						</td>
					</tr>
				<?php } ?>
				<tr>
					<td></td>
					<td>
						<input type='submit' class='input wx150 <?= $button; ?>' style="margin:2px;" name='simpan' id='simpan' value="<?= ucwords($hdr_notif); ?> Data" />
						<a href="<?= base_url($Redirected); ?>"><input type="button" class="input wx150 button4" style="margin:2px;" value='Kembali' readonly /></a>
					</td>
					</td>
			</table>
		</form>
		<?php
		echo $catatan;
		if (isset($_POST["simpan"])) {
			#			break;
			$urut  = escape($_POST["urut"]);
			$judul  = escape($_POST["judul"]);
			$isi    = escape($_POST["isi"]);
			$gambar = escape($_FILES["gambar"]["tmp_name"]);
			if (isset($_POST["status"])) {
				$status = "Y";
			} else {
				$status = "N";
			}
			if (isset($_POST["utama"])) {
				$utama = "Y";
			} else {
				$utama = "N";
			}
			if ($status . $utama == "YY") {
				$urut = $urut;
			} elseif ($status . $utama == "YN") {
				$urut = "999";
			} elseif ($status . $utama == "NY") {
				$urut = "999";
			} else {
				$urut = "999";
			}
			if (empty($judul) || empty($isi)) {
				$cek_post = "NZ";
			} else {
				$cek_post = "YZ";
			}
			if (substr($cek_post, 0, 1) == "N") {
				$Msg = "Ada data yang masih kosong / belum dipilih";
			} else {
				$judul  = substr($judul, 0, 100);
				$random = rand(1, 99);
				$id_fk_content  = date("YmdHis") . $random;
				$id_fk_judul	= strtolower(str_replace(" ", "-", str_replace($str_arr, '', $judul)));
				$id_fk_jenis	= $id_jenis;
				$id_fk_user		= $Ms_id;
				if (!empty($gambar)) {
					$upload_img = upload_image_fnc($_FILES["gambar"]);
					if ($upload_img) {
						$kolom     = "id_dtl_content,id_judul,id_fk_jenis,judul,isi,img_content,upd_rec,user_add,aktif,utama,urut";
						$isi_kolom = "'$id_fk_content','$id_fk_judul','$id_fk_jenis','$judul','$isi','$upload_img','$periode','$Ms_id','$status','$utama','$urut'";
						$edit_data = "update $table set id_judul='$id_fk_judul',judul='$judul',urut='$urut',isi='$isi',img_content='$upload_img',aktif='$status',utama='$utama' where $cek_id='$data_dtl'";
						$uplod = "Y";
					} else {
						$uplod = "Z";
					}
				} else {
					$kolom     = "id_dtl_content,id_judul,id_fk_jenis,judul,isi,upd_rec,user_add,aktif,utama,urut";
					$isi_kolom = "'$id_fk_content','$id_fk_judul','$id_fk_jenis','$judul','$isi','$periode','$Ms_id','$status','$utama','$urut'";
					$edit_data = "update $table set id_judul='$id_fk_judul',judul='$judul',urut='$urut',isi='$isi',aktif='$status',utama='$utama' where $cek_id='$data_dtl'";
					$uplod     = "N";
				}
				#break;
				if ($uplod == "Z") {
					$Msg = "Data gagal upload, silahkan ulangi inputan";
				} else {
					if ($_GET["action"] == "add") {
						$insert_data = "insert into $table ($kolom) values ($isi_kolom)";
						#break;
						if ($db->query($insert_data)) {
							$Msg = "Y";
						} else {
							log_error($Redirected, $insert_data);
							$Msg = "error sintak, silahkan di ulang";
						}
					} elseif ($_GET["action"] == "edit") {
						if (!empty(ready_data_dtl($data_dtl))) {
							if ($uplod == "Y") {
								$full_file = $path_img . ready_data_dtl($data_dtl);
								$thumb_file = $path_img . str_replace('full_', 'thumb_', ready_data_dtl($data_dtl));
								if (file_exists($full_file) || file_exists($thumb_file)) {
									unlink($full_file);
									unlink($thumb_file);
								}
							}
							if ($db->query($edit_data)) {
								$Msg = "Y";
								$Msg2 = "di edit";
								#mysql_query($id_data);
							} else {
								log_error($Redirected, $edit_data);
								$Msg = "error sintak";
							}
						} else {
							$Msg = "$content $field_cek1 tidak ada didatabae";
						}
					} elseif ($_GET["action"] == "delete") {
						if (!empty(ready_data_dtl($data_dtl))) {
							$full_file = $path_img . ready_data_dtl($data_dtl);
							$thumb_file = $path_img . str_replace('full_', 'thumb_', ready_data_dtl($data_dtl));
							if (file_exists($full_file) || file_exists($thumb_file)) {
								unlink($full_file);
								unlink($thumb_file);
							}
							$upd_data = "delete from $table where $cek_id='$data_dtl'";
							if (mysql_query($upd_data)) {
								$Msg = "Y";
								$Msg2 = "dihapus";
							} else {
								log_error($Redirected, $upd_data);
								$Msg = "error sintak";
							}
						}
					} else {
						die();
					}
				}
			}
			if ($Msg != "Y") {
		?>
				<script>
					/*$("#dialog2").hide();*/
					alert("<?= $Msg; ?>");
				</script>
			<?php
			} else {
				if (isset($Msg2)) {
					$Msgx = "<br/>" . $Msg2;
					$timeout = 1000;
				} else {
					$Msgx = "";
					$timeout = 1000;
				}
			?>
				<script>
					/*$("#dialog2").hide();*/
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
	} ?>
</div>