<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_query'));
    }
	
    public function siak($value = ""){		
		return base_url($value);
	}
    public function data($value = "")
    {
        $dd = $this->Mod_setting->get_setting($value);
        if (count($dd) > 0) {
            $data = $dd[0]->data;
        } else {
            $data = "";
        }
        return $data;
    }

    public function content($value = '', $value2 = '')
    {
        if (strlen($value) == 0) {
        } else {
            if ($value == "menu_produk") {
                $prod_sort  = $this->data("order_produk");
                $prod_data  = $this->Mod_setting->get_produk("", $prod_sort);
                $result = $prod_data;
            } else if ($value == "menu_proyek") {
                $proy_sort  = $this->data("order_proyek");
                $proy_data  = $this->Mod_setting->get_proyek("", $proy_sort);
                $result = $proy_data;
            } else {
                $result = "";
            }
            return $result;
        }
    }

    public function catat($value)
    {
        if ($value == "") {
            $value = "";
        } else {
            if (strpos($value, "/") !== false) {
                $value = $value;
            } else {
                $value = "/" . $value;
            }
        }
        $this->form_validation->set_rules("screen", "screen", "required|trim");
        $this->form_validation->set_rules("device", "device", "required|trim");

        if ($this->form_validation->run() == true) {
            $device = $_POST["device"];
            $screen = $_POST["screen"];
            $device = $_POST["device"];
            $url    = $_POST["url"];
            $ip     = $_SERVER['REMOTE_ADDR'];
            $ua     = $this->getBrowser();
            $bname  = $ua['name'];
            $bversi = $ua['version'];
            $os     = $ua['platform'];
            if (isset($_COOKIE["guid"])) {
                $guid = $_COOKIE["guid"];
            } else {
                $guid = "";
            };
            $id_page = "";
            $tgl    = date('y-m-d H:i');
            if (strpos($url, "project") !== false || strpos($url, "product") !== false) {
                $proyek = $this->Mod_query->proyek_data($_POST["project"]);
                if (strlen($proyek[0]->proyek_url)) {
                    $id_pry = $proyek[0]->proyek_id;
                    $id_prd = $proyek[0]->produk_id;
                } else {
                    $id_pry = "0";
                    $id_prd = "0";
                }
                $ins_pr  = array(
                    'url'               => $url . $value,
                    'product'           => $id_pry,
                    'project'           => $id_prd,
                    'updrec_date'       => date("Y-m-d H:i:s"),
                    'time_stamp'        => date("y-m-d H:i")
                );
                $tab    = "new_page_visit";
                $tipe   = "update";
                $id     = "";
                $kol    = array(
                    'url'               => $url . $value,
                    'product'           => $id_pry,
                    'project'           => $id_prd,
                    "time_stamp" => $tgl,
                );
                $id_page = $this->Mod_query->updLog($tab, $kol, $ins_pr, $url, $tgl);
            };
            // dbg($id_page);
            $ins  = array(
                'log_ip'                => $ip,
                'log_guid'              => $guid,
                'log_page_id'           => $id_page,
                'log_url'               => $url . $value,
                'log_device'            => $device,
                'log_browser'           => $bname,
                'log_browser_detail'    => $bversi . "|" . $os,
                'log_screen'            => $screen,
                'updrec_date'           => date("Y-m-d H:i:s")
            );

            $tbl  = "new_log";
            $klm  = array(
                "log_ip" => $ip,
                "log_guid" => $guid,
                'log_url'               => $url . $value,
                "date_format(updrec_date,'%y-%m-%d-%H-%i')" => date('y-m-d-H-i'),
                'log_device'            => $device,
                'log_screen'            => $screen
            );
            $tipe = "post";
            $id   = "";
            $cek  = $this->Mod_query->updDataForm($tbl, $tipe, $klm, $id, $ins);
            echo json_encode($cek);
        }
    }

    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        } else {
            $platform = 'Other Os';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } else {
            $bname = 'Other Browser';
            $ub = "Other Browser";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                //            $version= $matches['version'][0];
                $version = "unknown";
            }
            echo $version;
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    /* template */
    public function adm_header($header = "")
    {
        $sv = $_SERVER['SERVER_ADDR'];
        $data["uri1"] = $this->uri->segment(1);
        $data["uri2"] = $this->uri->segment(2);
        $data["uri3"] = $this->uri->segment(3);
        $this->load->view("admin/v_header", $data);
    }
    public function adm_footer()
    {
        $data[] = "";
        $this->load->view("v_footer", $data);
    }
    public function adm_template($view, $vdata, $header)
    {
        // dbg($vdata);
        $header["judul"] = "";
        if (isset($vdata["judul"])) {
            if (strlen($vdata["judul"])) {
                $header["judul"] = $vdata["judul"];
            }
        }
        if (isset($vdata["mainjudul"])) {
            if (strlen($vdata["mainjudul"])) {
                $header["judul"] = $vdata["mainjudul"];
            }
        }
        $this->adm_header($header);
        if (is_array($vdata)) {
            $this->load->view("admin/".$view, $vdata);
        } else {
            echo $view;
        }
        $this->adm_footer();
    }

    public function siak_template($view, $data)
    {
        $judul = "";
        if (isset($data["judul"])) {
            if (strlen($data["judul"])) {
                $judul = $data["judul"];
            }
        }
        $this->siak_header($judul,$data);
		$data["page"] = true;
        if($this->Mod_query->getmedia($this->session->userdata("pengguna_id"),"get")){
		    $data["userimg"] = get_img_user($this->Mod_query->getmedia($this->session->userdata("pengguna_id"),"get")->galeri_gambar);
        }else{
            $data["userimg"] = get_img_user("");
        }
        if (is_array($data)) {
            if(isset($data["page"])){
                    $data["page_view"] = $view;
                    $views = "siak/vs_page";
            }else{
                $views = "siak/".$view;
            }
            if($view=="vs_login"){
                $this->load->view("siak/".$view, $data);
            }else{                    
                $this->load->view($views, $data);
            }
        } else {
            echo $view;
        }
        $this->siak_footer();
    }

    public function siak_header($judul = "",$data="")
    {
        $sv = $_SERVER['SERVER_ADDR'];
        $data["uri1"] = $this->uri->segment(1);
        $data["uri2"] = $this->uri->segment(2);
        $data["uri3"] = $this->uri->segment(3);

        $this->load->view("siak/vs_header", $data);
    }
    public function siak_footer()
    {
        $data[] = "";
        $this->load->view("siak/vs_footer", $data);
    }
    #siswa
    public function siswa_template($view, $data)
    {
        $judul = "";
        if (isset($data["judul"])) {
            if (strlen($data["judul"])) {
                $judul = $data["judul"];
            }
        }
        $this->siswa_header($judul,$data);
		$data["page"] = true;
        if($this->Mod_query->getmedia($this->session->userdata("pengguna_id"),"get")){
		    $data["userimg"] = get_img_user($this->Mod_query->getmedia($this->session->userdata("pengguna_id"),"get")->galeri_gambar);
        }else{
            $data["userimg"] = get_img_user("");
        }
        if (is_array($data)) {
            if(isset($data["page"])){
                    $data["page_view"] = $view;
                    $views = "siswa/vsw_page";
            }else{
                $views = "siswa/".$view;
            }
            if($view=="vsw_login"){
                $this->load->view("siswa/".$view, $data);
            }else{                    
                $this->load->view($views, $data);
            }
        } else {
            echo $view;
        }
        $this->siswa_footer();
    }

    public function siswa_header($judul = "",$data="")
    {
        $sv = $_SERVER['SERVER_ADDR'];
        $data["uri1"] = $this->uri->segment(1);
        $data["uri2"] = $this->uri->segment(2);
        $data["uri3"] = $this->uri->segment(3);

        $this->load->view("siswa/vsw_header", $data);
    }
    public function siswa_footer()
    {
        $data[] = "";
        $this->load->view("siswa/vsw_footer", $data);
    }
}
