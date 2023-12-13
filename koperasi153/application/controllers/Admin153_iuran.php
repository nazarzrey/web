<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_iuran extends Settings
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			redirect(base_url("login"));
		};
		if (!menu_admin("page", $this->session->userdata("type"), "")) {
			redirect(base_url("dashboard"));
		}
		$this->load->model(array('Mod_iuran', 'Mod_query'));
	}
	function index()
	{
		$this->alldata(date("Y"));
		// $data[] = "";
		// $tahun = $this->Mod_query->Query("tbl_tahun","1=1");
		// $data["tahun"] = $tahun;
		// $this->admin_template("vs_input_iuran",$data);
	}
	function alldata($value = "")
	{
		// if($value==""){
		// 	$value = date("Y");
		// }
		$tahun = $this->Mod_query->Query("tbl_tahun", "1=1");
		$data["tahun"] = $tahun;
		$iuran = exec_prc("call grup_iuran('all')", "array");
		$data["iuran"] = $iuran;
		$this->admin_template("vs_iuran", $data);
	}

	function iuran($value = "", $periode = "")
	{
		// dbg($value);
		$data[]   = "";
		$tahun = $this->Mod_query->Query("tbl_tahun", "1=1");
		$data["tahun"] = $tahun;
		if ($value == "periode") {
			// dbg($periode);
			if ($periode == "") {
				$prd  = date("Ym");
				$data["periode"] = date("F Y");
			} else {
				if (is_numeric($periode)) {
					$prd = $periode;
					$data["periode"] = date("F", mktime(0, 0, 0, substr($prd, 5, 2))) . " " . substr($prd, 0, 4);
				} else {
					$prd = date("Ym");
					$data["periode"] = date("F Y");
				}
			}
			$data["prd"] = $prd;
			$sql  = $this->Mod_query->qryOther("SELECT cash_in AS opsi,COUNT(1) AS total FROM tbl_transaksi WHERE fk_mid='2' GROUP BY cash_in ORDER BY 2 DESC");
			$data["opsiBayar"] = $sql;
			$iuran = exec_prc("call bayar_iuran('$prd')", "array");
			$data["iuran"] = $iuran;
		} else {
			$bulan = $this->Mod_query->qryOther("select left(bulan,3) as bulan from tbl_bulan");
			$data["bulan"] = $bulan;
			$iuran = exec_prc("call grup_iuran($value)", "array");
			$data["iuran"] = $iuran;
		}
		$this->admin_template("vs_iuran", $data);
	}
	// function list($periode=""){
	// 	$data[]   = "";
	// 	$sql      = $this->Mod_iuran->input_iuran($periode,"list");
	// 	$iuran = $this->Mod_iuran->iuran_sum($periode,"list");
	// 	$optionTgl = $this->Mod_iuran->cektanggal($periode,"list");
	// 	$data["iuran"] = $sql;
	// 	$data["kelas"] = $this->Mod_kelas->data_kelas();	
	// 	$data["alliuran"] = $iuran;
	// 	$data["opt_tanggal"] = $optionTgl;
	// 	$data["mm_tanggal"] = $this->Mod_iuran->min_max();
	// 	$this->admin_template("vs_input_iuran",$data);		
	// }
	// function periode(){
	// 	$data[] = "";
	// 	$this->admin_template("soon",$data);
	// }

}
