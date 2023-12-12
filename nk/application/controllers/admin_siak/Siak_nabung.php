<?php

require_once(APPPATH . 'controllers/Settings.php');
class Siak_nabung extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_kelas','Mod_tabungan'));
	}
	function index(){
		$data[] = "";
		$this->siak_template("blank",$data);
	}
	function alldata($value=""){
		// dbg($value);
		$data[]   = "";
		$tabungan    = $this->Mod_tabungan->data_tabungan($value,"input");
		$alltabungan = $this->Mod_tabungan->tabungan_sum("");
		$report      = $this->Mod_tabungan->report_tabungan("","");
		$optionTgl   = $this->Mod_tabungan->cektanggal($value,"input");
		$data["tabungan"] = $tabungan;
		$data["kelas"] = $this->Mod_kelas->data_kelas();
		$data["pilih_kelas"] = $value;		
		$data["alltabungan"] = $alltabungan;
		$data["reporttabungan"] = $report;
		$data["opt_tanggal"] = $optionTgl;
		$this->siak_template("vs_tabungan",$data);
	}
	
	function input($periode=""){
		$data[]   = "";
		$sql      = $this->Mod_tabungan->input_tabungan($periode,"input");
		$tabungan = $this->Mod_tabungan->tabungan_sum($periode,"input");
		$optionTgl = $this->Mod_tabungan->cektanggal($periode,"input");
		$data["pilih_kelas"] = $periode;	
		$data["tabungan"] = $sql;
		$data["kelas"] = $this->Mod_kelas->data_kelas();	
		$data["alltabungan"] = $tabungan;
		$data["opt_tanggal"] = $optionTgl;
		$data["mm_tanggal"] = $this->Mod_tabungan->min_max();
		$this->siak_template("vs_input_tabungan",$data);		
	}
	function list($periode=""){
		$data[]   = "";
		$sql      = $this->Mod_tabungan->input_tabungan($periode,"list");
		$tabungan = $this->Mod_tabungan->tabungan_sum($periode,"list");
		$optionTgl = $this->Mod_tabungan->cektanggal($periode,"list");
		$data["tabungan"] = $sql;
		$data["kelas"] = $this->Mod_kelas->data_kelas();	
		$data["alltabungan"] = $tabungan;
		$data["opt_tanggal"] = $optionTgl;
		$data["mm_tanggal"] = $this->Mod_tabungan->min_max();
		$this->siak_template("vs_input_tabungan",$data);		
	}
	// function report($periode=""){
	// 	$data[]   = "";
	// 	$sql      = $this->Mod_tabungan->input_tabungan($periode,"input");
	// 	$tabungan = $this->Mod_tabungan->tabungan_sum($periode,"input");
	// 	$optionTgl = $this->Mod_tabungan->cektanggal($periode,"input");
	// 	$data["pilih_kelas"] = $periode;	
	// 	$data["tabungan"] = $sql;
	// 	$data["kelas"] = $this->Mod_kelas->data_kelas();	
	// 	$data["alltabungan"] = $tabungan;
	// 	$data["opt_tanggal"] = $optionTgl;
	// 	$this->siak_template("vs_report_tabungan",$data);		
	// }
	function periode(){
		$data[] = "";
		$this->siak_template("soon",$data);
	}
	
}