<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {
	function __construct() {
		parent::__construct();
		// if ($this->session->userdata('username')) {
		//   redirect(base_url('site'));
		// }
		// $this->load->model(array('Mod_data',
		//                           'Mod_karyawan',
		//                           'Mod_siswa',
		//                           'Mod_proses'));
		#$this->load->model(array('Mod_query'));
		#$this->load->helper('fungsi');
		$this->load->model(array('Mod_query'));
	}

	public function index($value=""){
		$data  = array("");
		$data["calur"] = $this->Mod_query->getCamatLurah("","");
		$data["title"] = "Add Location / Tambah Data";
		$this->template('backend/back_page',$data,);
	}
	public function tambah($value='')
	{
		echo "z";
	}
	public function report($value='',$kec='',$kel=''){
		$data["calur"] = $this->Mod_query->getCamatLurah("","");
		$data["title"] = "Data Laporan Masyarakat";
		//$data["detail"]= $this->Mod_query->dtlCamatLurah($value,$kec,$kel);
		#echo $kec."XXXXXXXXXX".$kel;
		if($kec!="" && $kel==""){
			$data["kelur"] = $this->Mod_query->getCamatLurah("id_kec",$kec);
		}elseif($kec!=="" && $kel!=""){
			$data["kelur"] = $this->Mod_query->getCamatLurah($kec,$kel);
		}else{
			$data["kelur"] = "Semua Kecamatan";
		}
		$this->template('backend/data_laporan',$data);
	}
	#template
	public function header($data)
	{
		$this->load->view("templates/backend_header",$data);
	}
	public function footer()
	{
		$this->load->view("templates/backend_footer");
	}
	
	public function template($view,$data)
	{
		$this->header($data);
		if(is_array($data)){
			$this->load->view($view,$data);
		}else{
			echo h3($view);
		}
		$this->footer();
	}
}
