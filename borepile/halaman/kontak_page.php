<script src='https://www.google.com/recaptcha/api.js'></script>
<?php
if (!isset($_GET["page"])) {
	die();
}
$hdr_page   = $db->escape($_GET[$page]);
$Redirected = $get_page . "=" . $hdr_page;
function cek_post($post)
{
	global $db;
	if (isset($_POST[$post])) {
		$data_post =  $db->escape($_POST[$post]);
	} else {
		$data_post = "";
	}
	return $data_post;
}
?>
<div style="max-height:100%;overflow:auto;" class="xcontent_dtl1 frm_input">
	<div><?php
		echo select_data_func("content_other", "content_dtl", "id_content", "contact_us", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
		?></div>
	<h3>Tinggal kan pesan anda..<h3>
			<form method="post" action="" id="komentar" enctype="multipart/form-data">
				<div style="float:left;" class="w100">
					<div id="visible"><input type='text' class='input wx250' readonly name='me_visit' id='me_visit' /></div>
					<input type='text' class='input wx350' required name='nama' id='nama' maxlength="20" autocomplete="off" placeholder="Nama (diperlukan)" value="<?= cek_post("nama"); ?>" /><br />
					<input type='email' class='input wx350 mtb15' required name='email' id='email' maxlength="100" autocomplete="off" placeholder="Email (diperlukan)" value="<?= cek_post("email");  ?>" />
					<br />
					<textarea class="textarea w98" required name="isi_komentar" id="isi_komentar" placeholder="*"><?= cek_post("isi_komentar");  ?></textarea>
					<p>
					<div class="g-recaptcha" data-sitekey="6LcQWx8TAAAAAFjdSpw0rQgQD_w06j9Vq_B9Tx6K" style='transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;width:100px;height:60px;'></div>
					<input type='submit' class='input wx150 button4 mtb15' name='simpan' id='simpan' value="simpan" />
					</p>
				</div>
			</form>
			<?php
			if (isset($_POST["simpan"])) {
				$key_page = $db->escape($_GET[$page]);
				$isi_data = $db->escape($_POST["isi_komentar"]);
				$user_add = $db->escape($_POST["nama"]);
				$mail_user = $db->escape($_POST["email"]);
				$media	 	= $db->escape($_POST["me_visit"]);
				if (empty($media)) {
					$visit_by = "unknown";
				} else {
					$visit_by = $media;
				}
				if (empty($isi_data) and empty($user_add) and empty($mail_user)) {
					$Msg = "data masih ada yang kosong";
				} else {
					if (isset($_POST['g-recaptcha-response'])) {
						$captcha = $_POST['g-recaptcha-response'];
					} else {
						$Msg = 'wrong Capcha are you robot...';
					}
					$privatekey = "6LcQWx8TAAAAAOFu4FoIqOKuv-F1c6vl7hmV8D_2";
					$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $privatekey . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']), true);
					if ($response['success'] == false) {
						$Msg = 'wrong Capcha are you robot...';
					} else {
						require_once "seting/function_web.php";
						$table = "pesan";
						$id_random = rand(0, 999);
						$id_komen  = str_replace(array(" ", ":", "-"), "", $tgl_jam) . $id_random;
						$column1 = "upd_rec,pengirim,email,halaman,id_halaman,isi,aktif,status";
						$column2 = "'$tgl_jam','$user_add','$mail_user','$key_page','$id_komen','$isi_data','Y',0";
						if (insert_data_func($table, $column1, $column2, "", "", "kontak") == "Y") {
							$Msg = "Y";
						} else {
							$Msg = "error sintak cek log..";
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
						$timeout = 1000;
					} else {
						$Msgx = "";
						$timeout = 1000;
					}
					insert_visitor($id_komen, halaman(), $visit_by);
				?>
					<script>
						alert("Pesan anda sudah di simpan..! <?= $Msgx; ?>");
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