<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exporting extends CI_Controller {
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
        $this->load->library('pdf');
        if(!$this->session->userdata('uid')){
            redirect(base_url('login'));
        }
    }

    public function sesi($value='')
    {
        if($value!=""){
            return $this->session->userdata()[$value];
        }else{
            return $this->session->userdata();
        }       
    }
}