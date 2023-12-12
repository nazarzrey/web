<?php
class Cetak extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_cetak');
	}


	function index(){
		$x['data']=$this->m_cetak->get_all_siswa();
		$this->load->view('admin/cetak/export_data',$x);
	}
	
}
?>
