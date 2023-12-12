<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Struktur extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_struktur');
	}


	function index(){
		$x['data']=$this->m_struktur->get_all_struktur();
		$this->load->view('admin/v_struktur',$x);
	}

	function simpan_struktur(){
		$struktur=strip_tags($this->input->post('xstruktur'));
		$kebutuhan=strip_tags($this->input->post('xkebutuhan'));
		$this->m_struktur->simpan_struktur($struktur,$kebutuhan);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/struktur');
	}

	function update_struktur(){
		$kode=strip_tags($this->input->post('kode'));
		$struktur=strip_tags($this->input->post('xstruktur'));
		$kebutuhan=strip_tags($this->input->post('xkebutuhan'));
		$this->m_struktur->update_struktur($kode,$struktur,$kebutuhan);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/struktur');
	}
	function hapus_struktur(){
		$kode=strip_tags($this->input->post('kode'));
		$this->m_struktur->hapus_struktur($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/struktur');
	}

}
