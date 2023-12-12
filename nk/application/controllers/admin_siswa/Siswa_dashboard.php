<?php

require_once(APPPATH . 'controllers/Settings.php');
class Siswa_dashboard extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_siswa','Mod_tabungan','Mod_kelas'));
	}
	function index(){		
		$guru     = $this->Mod_query->qryOther("SELECT guru_nama FROM tbl_guru");
		$siswa    = $this->Mod_siswa->siswa_sum();
		$tabungan = $this->Mod_tabungan->tabungan_sum("");
		$data[] = "";
		$data["guru"] = $guru;
		$data["siswa"] = $siswa;
		$data["tabungan"] = $tabungan;
		$this->siswa_template("vsw_beranda",$data);
	}
	function profile($value=""){	
		$data[] = "";
		if($value=="infaq"){
			$this->siswa_template("soon",$data);
		}else{
			if($this->uri->segment(2)=="" || $value=="tabungan"){
				$data[]   = "";
				$report      = $this->Mod_tabungan->report_tabungan("","");
				$data["reporttabungan"] = $report;
				$this->siswa_template("vsw_siswa_profile",$data);
			}else{
				$data[]   = "";
				$sql =  $this->Mod_siswa->data_siswa("siswa_".$this->session->userdata('idadmin'));
				$data["profile"] = $sql;
				$this->siswa_template("vsw_siswa_profile_settings",$data);
			}
		}
	}
	
}