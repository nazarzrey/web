<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_page extends CI_Controller {
	function __construct() {
		parent::__construct();
		// if ($this->session->userdata('username')) {
		//   redirect(base_url('site'));
		// }
		// $this->load->model(array('Mod_data',
		//                           'Mod_karyawan',
		//                           'Mod_siswa',
		//                           'Mod_proses'));
		$this->load->model(array('Mod_query'));
    	$this->load->library('user_agent');
		#$this->load->helper('fungsi');
	}
	public function sesi($value='')
	{
		if(!$this->session->userdata('uid')){
			redirect(base_url('nama'));
		}
		if($value!=""){
			return $this->session->userdata()[$value];
		}else{
			return $this->session->userdata();
		}		
	}
	public function index($value=""){
		// catat_log();
		$whitelist = array(
			'127.0.0.1',
			'::1',
			'localhost'
		);
		if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){			
			$this->load->view("notready");
		}else{
			$data["session"] = $this->sesi("");
			$this->template('frontend/landing_page',$data);
		}
	}
	public function cetak($value="")
	{
		if($value!=""){
			$sql  = "and rt='$value'";
		}else{
			$sql  = "";
			// $sql  = "where id in(430,596,274,577,20,79)";
		}
		$qry  = "SELECT id,nomor,nama,pwd AS pin,rt,kelas,CONCAT('www.jami-alhidayah.com/nama/',REPLACE(LOWER(nama),' ','-')) AS link,qr FROM warga where recid!='x' ".$sql."  order by nomor desc limit 35";
		$wrg  = $this->Mod_query->Query($qry);
		$data["cetak"] = $wrg;
		$this->load->view("cetak",$data);
	}
	public function revisi($value="")
	{
		if($value!=""){
			$sql  = "and rt='$value'";
		}else{
			$sql  = "";
			// $sql  = "where id in(430,596,274,577,20,79)";
		}
		$qry  = "SELECT id,nomor,nama,pwd AS pin,rt,kelas,CONCAT('www.jami-alhidayah.com/nama/',REPLACE(LOWER(nama),' ','-')) AS link,qr FROM warga where recid!='x' ".$sql."  and kelas='2' order by nomor desc limit 2";
		$wrg  = $this->Mod_query->Query($qry);
		$data["cetak"] = $wrg;
		$this->load->view("cetak_revisi",$data);
	}
	public function warga($value='')
	{
		$sesi   		 = $this->sesi("");
		$data["session"] = $sesi;
		$data["topbar"]  = "disable";
		$qry  			 = "select * from warga where id='".$sesi["uid"]."'";
		$qry2   		 = "select tanggal,nominal from infaq where donatur_id='".$sesi["uid"]."'";
		$data["warga"]   = $this->Mod_query->Query($qry);
		$data["infaq"]   = $this->Mod_query->Query($qry2);
		$data["max_tgl"] = $this->Mod_query->max_tgl();
		$this->template('frontend/data_warga',$data);
	}

	public function infaq($value='')
	{
		$sesi   		 = $this->sesi("");
		$data["session"] = $sesi;
		if($value=="report"){
			$data["topbar"]  = "disable";
			$qry  			 = "select * from warga where id='".$sesi["uid"]."'";
			$qry2   		 = "select * from gabung_infaq";
			$qry3 			 = "SELECT rt,DATE_FORMAT(tanggal,'%Y-%m') AS periode, SUM(nominal) AS total FROM infaq a LEFT JOIN warga b ON a.donatur_id=b.id GROUP BY rt,DATE_FORMAT(tanggal,'%Y-%m')";
			//$qry4 			 = "SELECT  *,CEIL(warga_masuk/warga_ttl*100) AS persen_warga,CEIL(infaq_masuk/infaq_ttl*100) AS persen_infaq FROM persen_data a RIGHT JOIN persen_masuk b ON a.rt=b.rt";
			$data["warga"]   = $this->Mod_query->Query($qry);
			$data["infaqdtl"]= $this->Mod_query->Query($qry2);
			$data["total"]   =$this->Mod_query->Query($qry3);
			$data["max_tgl"] = $this->Mod_query->max_tgl();
			//$data["persen"]  = $this->Mod_query->Query($qry4);
			$this->template('frontend/infaq_report',$data);
		}else{
			$this->p404();
		}
	}
	#template
	public function gambar(){
		// $data["soon"]  	 = "404";
		$data["topbar"]  = "disable";
		$data["galeri"]  = "yes";
		$this->template('gallery/index',$data);
	}
	#template
	public function p404(){
		$data["soon"]  	 = "404";
		$data["topbar"]  = "disable";
		$this->template('soon',$data);
	}
	public function header($data)
	{		
		$data["session"] = $this->sesi("");
		$this->load->view("templates/front_header",$data);
	}
	public function footer()
	{
		$this->load->view("templates/front_footer");
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
