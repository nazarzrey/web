<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model(array('Mod_query'));
    $this->load->library('user_agent');
  }

  public function index($value='') {
    $data = array("");
    $this->load->view("templates/backend_login_header");
    $this->load->view("templates/backend_login",$data);
    $this->load->view("templates/backend_login_footer");
  }

  public function wrg() {
    $data = array("");
    $this->load->view("templates/backend_login_header");
    $this->load->view("templates/profile_login",$data);
    $this->load->view("templates/backend_login_footer");
  }

  public function warga($value='',$value1='') {
    if($value1!=""){
      $warga         = $value."-".$value1;
      $data["warga"] = array($warga);
    }else{
      $warga         = $value;
      $data["warga"] = array($warga);
    }
    $cek = $this->Mod_query->cekUser($warga,"","profile");
    $this->load->view("templates/backend_login_header");
    if(count($cek->result())>0){
      $this->load->view("templates/profile_login_nama",$data);
    }else{
      $this->load->view("templates/profile_login",$data);
    }
    $this->load->view("templates/backend_login_footer");
  }

  public function logout(){
      debug($this->session->sess_destroy());
      redirect(base_url(''));
  }
  public function keluar(){
      debug($this->session->sess_destroy());
      redirect(base_url(''));
  }
  function validasi(){
    $u = $this->form_validation->set_rules('username', 'username', 'required|trim');
    $p = $this->form_validation->set_rules('password', 'password', 'required|trim');

    if ($this->form_validation->run() == FALSE){
        redirect(base_url('login'));
    } else {
      $usr = $this->input->post('username');
      $psw = $this->input->post('password');
      $tipe = "admin";
      $cek = $this->Mod_query->cekUser($usr, $psw, $tipe);
/*
      echo $cek->num_rows();
      debug($cek->num_rows());*/
      if ($cek->num_rows() > 0) {
        $result = $cek->result();
        #die(debug($result[0]->recid));
        if($result[0]->recid==0){
          $this->session->set_flashdata('result_login', 'User tidak aktif, silahkan hubungi admin');
          redirect(base_url('login'));
        }else{
          foreach ($result as $qad) {
            $sess_data['uid']     = $qad->uid;
            $sess_data['uname']   = $qad->name;
            $sess_data['utipe']   = $qad->tipe;
            $sess_data['urec']    = $qad->recid;
            $this->session->set_userdata($sess_data);
          }
          #debug("sukses");($page,$warga,$jenis){
            $this->Mod_query->catat_log("login-admin",$qad->uid,"login",$this->agen());
            $this->session->set_flashdata('success', 'Login Berhasil !');
            redirect(base_url('admin'));
          }        
      }else{
        $break = $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
        redirect(base_url('login'));
      }
    }
  }

  function validate(){
    $u = $this->form_validation->set_rules('username', 'username', 'required|trim');
    $p = $this->form_validation->set_rules('password', 'password', 'required|trim');

    if ($this->form_validation->run() == FALSE){
        redirect(base_url('nama'));
    } else {
      $usr = $this->input->post('username');
      $psw = $this->input->post('password');
      $tipe = "warga";
      $cek = $this->Mod_query->cekUser($usr, $psw, $tipe);
/*
      echo $cek->num_rows();
      debug($cek->num_rows());*/
      if ($cek->num_rows() > 0) {
        $result = $cek->result();
        #die(debug($result[0]->recid));
        if($result[0]->recid==0){
          $this->session->set_flashdata('result_login', 'User tidak aktif, silahkan hubungi admin');
          redirect(base_url('nama'));
        }else{
          foreach ($result as $qad) {
            $sess_data['uid']     = $qad->id;
            $sess_data['uname']   = $qad->nama;
            $sess_data['urt']   = $qad->rt;
            $sess_data['ukelas']   = $qad->kelas;
            $sess_data['urec']    = $qad->recid;
            $this->session->set_userdata($sess_data);
          }
            $this->Mod_query->catat_log("login-warga",$qad->id,"login",$this->agen());
            $this->session->set_flashdata('success', 'Login Berhasil !');
            redirect(base_url('infaq'));
          }        
      }else{
        $break = $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
        redirect(base_url('nama'));
      }
    }
  }
  function validate2(){
    $u   = $this->form_validation->set_rules('username', 'username', 'required|trim');
    $p   = $this->form_validation->set_rules('password', 'password', 'required|trim');
    $xsr = $this->input->post('username');
    $usr = str_replace("-"," ",$xsr);
    $psw = $this->input->post('password');
    $tipe = "warga";
    $cek = $this->Mod_query->cekUser($usr, $psw, $tipe);
    if ($this->form_validation->run() == FALSE){
        redirect(base_url('nama/'.$xsr));
    } else {
    #die($usr." ".$psw." ".$tipe." ".$cek->num_rows() );
/*
      echo $cek->num_rows();
      debug($cek->num_rows());*/
      if ($cek->num_rows() > 0) {
        $result = $cek->result();
        #die(debug($result[0]->recid));
        if($result[0]->recid==0){
          $this->session->set_flashdata('result_login', 'User tidak aktif, silahkan hubungi admin');
          redirect(base_url('nama/'.$xsr));
        }else{
          foreach ($result as $qad) {
            $sess_data['uid']     = $qad->id;
            $sess_data['uname']   = $qad->nama;
            $sess_data['urt']   = $qad->rt;
            $sess_data['ukelas']   = $qad->kelas;
            $sess_data['urec']    = $qad->recid;
            $this->session->set_userdata($sess_data);
          }
            $this->Mod_query->catat_log("login-warga",$qad->id,"login",$this->agen());
            $this->session->set_flashdata('success', 'Login Berhasil !');
            redirect(base_url('infaq'));
          }        
      }else{
        $break = $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
        redirect(base_url('nama/'.$xsr));
      }
    }
  }



  public function agen(){
        $browser    = $this->agent->browser();
        $browser_version = $this->agent->version();
        $os       = $this->agent->platform();
        $ip_address = $this->input->ip_address();
        return $ip_address."|".$os."|".$browser."|".$browser_version;
  }

  public function log($value='')
  {
    # code...
  }
  #template
  public function header($data)
  {
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