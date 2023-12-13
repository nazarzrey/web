<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_laporan extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_kelas','Mod_iuran'));
	}
	function index(){
		$data[] = "";
		$this->admin_template("blank",$data);
	}
	function alldata($value=""){
		// dbg($value);
		$data[]   = "";
		$iuran    = $this->Mod_iuran->data_iuran($value,"input");

		// $alliuran = $this->Mod_iuran->iuran_sum("");
		// $report      = $this->Mod_iuran->report_iuran("","");
		// $optionTgl   = $this->Mod_iuran->cektanggal($value,"input");
		$data["iuran"] = $iuran;
		// $data["pilih_kelas"] = $value;		
		// $data["alliuran"] = $alliuran;
		// $data["reportiuran"] = $report;
		// $data["opt_tanggal"] = $optionTgl;
		$this->admin_template("vs_iuran",$data);
	}
	
	function input($periode=""){
		$data[]   = "";
		$sql      = $this->Mod_iuran->input_iuran($periode,"input");
		$iuran = $this->Mod_iuran->iuran_sum($periode,"input");
		$optionTgl = $this->Mod_iuran->cektanggal($periode,"input");
		$data["pilih_kelas"] = $periode;	
		$data["iuran"] = $sql;
		$data["kelas"] = $this->Mod_kelas->data_kelas();	
		$data["alliuran"] = $iuran;
		$data["opt_tanggal"] = $optionTgl;
		$data["mm_tanggal"] = $this->Mod_iuran->min_max();
		$this->admin_template("vs_input_iuran",$data);		
	}
	function list($periode=""){
		$data[]   = "";
		$sql      = $this->Mod_iuran->input_iuran($periode,"list");
		$iuran = $this->Mod_iuran->iuran_sum($periode,"list");
		$optionTgl = $this->Mod_iuran->cektanggal($periode,"list");
		$data["iuran"] = $sql;
		$data["kelas"] = $this->Mod_kelas->data_kelas();	
		$data["alliuran"] = $iuran;
		$data["opt_tanggal"] = $optionTgl;
		$data["mm_tanggal"] = $this->Mod_iuran->min_max();
		$this->admin_template("vs_input_iuran",$data);		
	}
	// function report($periode=""){
	// 	$data[]   = "";
	// 	$sql      = $this->Mod_iuran->input_iuran($periode,"input");
	// 	$iuran = $this->Mod_iuran->iuran_sum($periode,"input");
	// 	$optionTgl = $this->Mod_iuran->cektanggal($periode,"input");
	// 	$data["pilih_kelas"] = $periode;	
	// 	$data["iuran"] = $sql;
	// 	$data["kelas"] = $this->Mod_kelas->data_kelas();	
	// 	$data["alliuran"] = $iuran;
	// 	$data["opt_tanggal"] = $optionTgl;
	// 	$this->admin_template("vs_report_iuran",$data);		
	// }
	function periode(){
		$data[] = "";
		$this->admin_template("soon",$data);
	}
	
}