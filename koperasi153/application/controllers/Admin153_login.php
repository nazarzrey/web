<?php
require_once(APPPATH . 'controllers/Settings.php');
class Admin153_login extends Settings
{


    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
    }
    function index()
    {
        $data["page"] = false;
        $this->admin_template("vs_login", $data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
    public function updpass()
    {
        $psw1 = $this->input->post('npwd1');
        $psw2 = $this->input->post('npwd2');
        $uid = $this->input->post('uid');
        if ($psw1 == "" || $psw2 == "") {
            $this->session->set_flashdata('result_login', 'Password Baru tidak boleh ada yang kosong');
            $this->session->set_flashdata('updpass', true);
            redirect(base_url("login"));
        } else {
            if (md5($psw1) != md5($psw2)) {
                $this->session->set_flashdata('result_login', 'Password Baru tidak sama');
                $this->session->set_flashdata('updpass', true);
                redirect(base_url("login"));
            } else {
                $updatepass = $this->Mod_query->editin_data(array("updrec_pass" => date("Y-m-d H:i:s"), "pwd" => $psw1, "password" => md5($psw1)), "tbl_user", "", array("uid" => $uid));
                if ($updatepass) {
                    $this->session->set_flashdata('result_login', 'Sukses update password silahkan login ulang');
                    redirect(base_url("login"));
                } else {
                    $this->session->set_flashdata('result_login', 'Ada masalah, silahkan coba lagi');
                    redirect(base_url("login"));
                }
            }
        }
    }
    function validate()
    {
        $u = $this->form_validation->set_rules('uname', 'uname', 'required|trim');
        $p = $this->form_validation->set_rules('upwd', 'upwd', 'required|trim');
        // dbg($this->input->post());
        // $c = $this->form_validation->set_rules('captcha', 'captcha', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('result_login', 'Username atau Password tidak boleh ada yang kosong');
            redirect(base_url("login"));
        } else {

            // $gre = $this->input->post('g-recaptcha-response');
            $usr = $this->input->post('uname');
            $psw = $this->input->post('upwd');
            // $recha = get_recapture_score($gre);

            // if ($recha==0) {
            //     $this->session->set_userdata(array('user'=> $usr,"passw"=>$psw));
            //     $this->session->set_flashdata('result_login', 'Pastikan anda buka robot ');
            //     redirect(base_url("login"));
            // }
            $cek = $this->Mod_query->Query("tbl_user", array('username' => $usr, 'password' => md5($psw)));
            // dbg(md5($psw));
            // dbg(count($cek) );
            if (count($cek) > 0) {
                if ($cek[0]->updrec_pass) {
                    $this->session->unset_userdata("passw");
                    $this->session->unset_userdata("qrcreate");
                    $this->session->set_userdata('masuk', true);
                    foreach ($cek as $user) {
                        // die($user->media_path . $user->media_name);
                        $sess_data['idadmin']            = $user->uid;
                        $sess_data['username']           = $user->username;
                        $sess_data['nama']           = $user->nama;
                        $sess_data['type']           = $user->user_type;
                        $sess_data['member']           = $user->user_member;
                        #$sess_data['app']            = $user->user_app;
                        // $sess_data['user_images']    = get_img_user($user->media_path . $user->media_name, "web");
                    }
                    // $insert_log = array("fk_uid"=>$user->uid,"uq"=>$cek[0]->id,"ip"=>get_client_ip());
                    $insert_log = array("fk_uid" => $user->uid, "ip" => get_client_ip());
                    $this->Mod_query->masukin_data($insert_log, "user_log", "");
                    $this->Mod_query->editin_data(array("last_login" => date("Y-m-d H:i:s")), "tbl_user", "", array("uid" => $user->uid));
                    // editin_data($array, $table, $tipe, $where)
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('success', 'Login Berhasil !');
                    redirect(base_url("dashboard"));
                } else {
                    $this->session->set_flashdata('uidpass', $cek[0]->uid);
                    $this->session->set_flashdata('updpass', true);
                    redirect(base_url("login"));
                }
            } else {
                $break = $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
                redirect(base_url("login"));
            }
        }
    }

    function qrcreate($value = '')
    {
        $this->load->library('ciqrcode');
        $params['data'] = 'This is a text to encode become QR Code';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'tes.png';
        $this->ciqrcode->generate($params);
    }
    function qrlogin($value = '')
    {
        if ($value == "unsetcetaknis") {
            $this->session->unset_userdata("qrcreate");
        } elseif ($value == "cetaknis") {
            if ($this->session->userdata('qrcreate')) {

                $this->load->model('Mod_siswa', 'MS');
                $data["data_siswa"] = $this->MS->data_siswa("order");
                $this->load->view("cetak_nis", $data);
            } else {
?>
                <form action="" method="post">
                    <input type="text" name="pwd" placeholder="Password Hari ini" required>
                    <button type="submit">submit</button>
                </form>
<?php
                $rms = date("d") * date("m") + date("m") + date("Y");
                if (isset($_POST['pwd'])) {
                    $pwd = $this->input->post('pwd');
                    if (md5($pwd) == md5($rms)) {
                        $this->session->set_userdata('qrcreate', true);
                    } else {
                        echo "Password salah";
                    }
                }
            }
        } else {
            echo "xx";
        }
    }
}
