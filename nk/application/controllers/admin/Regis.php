<?php
class Regis extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_regis');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_regis->get_all_siswa();
		$x["kelas"]=$this->m_regis->get_kelas();
		$this->load->view('admin/v_regis',$x);
	}

	function export(){
		$x['data']=$this->m_regis->export_data();
		$this->load->view('admin/export_data/v_export_data',$x);
	}
	
	function simpan_siswa(){
				$config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {
	                if ($this->upload->do_upload('filefoto'))
                      {
                              $gambar = $this->upload->data();
                              //Compress Image
                              $config['image_library']='gd2';
                              $config['source_image']='./assets/images/'.$gambar['file_name'];
                              $config['create_thumb']= FALSE;
                              $config['maintain_ratio']= FALSE;
                              $config['quality']= '60%';
                              $config['width']= 300;
                              $config['height']= 300;
                              $config['new_image']= './assets/images/'.$gambar['file_name'];
                              $this->load->library('image_lib', $config);
                              $this->image_lib->resize();

                              $photo=$gambar['file_name'];
							  $jenis=strip_tags($this->input->post('xjenis'));
							  $jalur=strip_tags($this->input->post('xjalur'));
                              $no=strip_tags($this->input->post('xno'));
                              $nisn=strip_tags($this->input->post('xnisn'));
                              $nama=strip_tags($this->input->post('xnama'));
                              $jenkel=strip_tags($this->input->post('xjenkel'));
							  $tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
							  $tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
                              $alamat=strip_tags($this->input->post('xalamat'));
                              $rt=strip_tags($this->input->post('xrt'));
                              $rw=strip_tags($this->input->post('xrw'));
                              $desa=strip_tags($this->input->post('xdesa'));
                              $kec=strip_tags($this->input->post('xkec'));
                              $kab=strip_tags($this->input->post('xkab'));
                              $pos=strip_tags($this->input->post('xpos'));
                              $tmp_tgl=strip_tags($this->input->post('xtmp_tgl'));
                              $hp=strip_tags($this->input->post('xhp'));
                              $tlp=strip_tags($this->input->post('xtlp'));
                              $email=strip_tags($this->input->post('xemail'));
                              $tinggi=strip_tags($this->input->post('xtinggi'));
                              $berat=strip_tags($this->input->post('xberat'));
                              $jarak=strip_tags($this->input->post('xjarak'));
                              $waktu=strip_tags($this->input->post('xwaktu'));
                              $sdr=strip_tags($this->input->post('xsdr'));
                              $ayh=strip_tags($this->input->post('xayh'));
                              $thn_ayh=strip_tags($this->input->post('xthn_ayh'));
                              $pdk_ayh=strip_tags($this->input->post('xpdk_ayh'));
                              $job_ayh=strip_tags($this->input->post('xjob_ayh'));
                              $gaji_ayh=strip_tags($this->input->post('xgaji_ayh'));
							  $no_ayh=strip_tags($this->input->post('xno_ayh'));
                              $ibu=strip_tags($this->input->post('xibu'));
                              $thn_ibu=strip_tags($this->input->post('xthn_ibu'));
                              $pdk_ibu=strip_tags($this->input->post('xpdk_ibu'));
                              $job_ibu=strip_tags($this->input->post('xjob_ibu'));
                              $gaji_ibu=strip_tags($this->input->post('xgaji_ibu'));
							  $no_ibu=strip_tags($this->input->post('xno_ibu'));
							  $wali=strip_tags($this->input->post('xwali'));
							  $thn_wali=strip_tags($this->input->post('xthn_wali'));
							  $pdk_wali=strip_tags($this->input->post('xpdk_wali'));
							  $job_wali=strip_tags($this->input->post('xjob_wali'));
							  $gaji_wali=strip_tags($this->input->post('xgaji_wali'));
							  $no_wali=strip_tags($this->input->post('xno_wali'));
                              

                              $this->m_regis->simpan_siswa($jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$photo,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali,$nisn);
                              echo $this->session->set_flashdata('msg','success');
                              redirect('admin/regis');
                          }else{
                                  echo $this->session->set_flashdata('msg','warning');
                                  redirect('admin/regis');
                              }
	                 
	            }else{
					$jenis=strip_tags($this->input->post('xjenis'));
					$jalur=strip_tags($this->input->post('xjalur'));
					$no=strip_tags($this->input->post('xno'));
                    $nisn=strip_tags($this->input->post('xnisn'));
					$nama=strip_tags($this->input->post('xnama'));
					$jenkel=strip_tags($this->input->post('xjenkel'));
					$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
					$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
					$alamat=strip_tags($this->input->post('xalamat'));
					$rt=strip_tags($this->input->post('xrt'));
					$rw=strip_tags($this->input->post('xrw'));
					$desa=strip_tags($this->input->post('xdesa'));
					$kec=strip_tags($this->input->post('xkec'));
					$kab=strip_tags($this->input->post('xkab'));
					$pos=strip_tags($this->input->post('xpos'));
					$tmp_tgl=strip_tags($this->input->post('xtmp_tgl'));
					$hp=strip_tags($this->input->post('xhp'));
					$tlp=strip_tags($this->input->post('xtlp'));
					$email=strip_tags($this->input->post('xemail'));
					$tinggi=strip_tags($this->input->post('xtinggi'));
					$berat=strip_tags($this->input->post('xberat'));
					$jarak=strip_tags($this->input->post('xjarak'));
					$waktu=strip_tags($this->input->post('xwaktu'));
					$sdr=strip_tags($this->input->post('xsdr'));
					$ayh=strip_tags($this->input->post('xayh'));
					$thn_ayh=strip_tags($this->input->post('xthn_ayh'));
					$pdk_ayh=strip_tags($this->input->post('xpdk_ayh'));
					$job_ayh=strip_tags($this->input->post('xjob_ayh'));
					$gaji_ayh=strip_tags($this->input->post('xgaji_ayh'));
					$no_ayh=strip_tags($this->input->post('xno_ayh'));
					$ibu=strip_tags($this->input->post('xibu'));
					$thn_ibu=strip_tags($this->input->post('xthn_ibu'));
					$pdk_ibu=strip_tags($this->input->post('xpdk_ibu'));
					$job_ibu=strip_tags($this->input->post('xjob_ibu'));
					$gaji_ibu=strip_tags($this->input->post('xgaji_ibu'));
					$no_ibu=strip_tags($this->input->post('xno_ibu'));
                    $wali=strip_tags($this->input->post('xwali'));
					$thn_wali=strip_tags($this->input->post('xthn_wali'));
					$pdk_wali=strip_tags($this->input->post('xpdk_wali'));
					$job_wali=strip_tags($this->input->post('xjob_wali'));
					$gaji_wali=strip_tags($this->input->post('xgaji_wali'));
                    $no_wali=strip_tags($this->input->post('xno_wali'));

					

					$this->m_regis->simpan_siswa_tanpa_img($jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali,$nisn);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/regis');
              }
				
	}
	
	function update_siswa(){
				
	            $config['upload_path'] = './assets/images/'; //path folder
	            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

	            $this->upload->initialize($config);
	            if(!empty($_FILES['filefoto']['name']))
	            {
	                if ($this->upload->do_upload('filefoto'))
	                {
	                        $gambar = $this->upload->data();
	                        //Compress Image
	                        $config['image_library']='gd2';
	                        $config['source_image']='./assets/images/'.$gambar['file_name'];
	                        $config['create_thumb']= FALSE;
	                        $config['maintain_ratio']= FALSE;
	                        $config['quality']= '60%';
	                        $config['width']= 300;
	                        $config['height']= 300;
	                        $config['new_image']= './assets/images/'.$gambar['file_name'];
	                        $this->load->library('image_lib', $config);
	                        $this->image_lib->resize();
	                        $gambar=$this->input->post('gambar');
							$path='./assets/images/'.$gambar;
							unlink($path);

							$photo=$gambar['file_name'];
							$kode=$this->input->post('kode');
							$jenis=strip_tags($this->input->post('xjenis'));
							$jalur=strip_tags($this->input->post('xjalur'));
							$no=strip_tags($this->input->post('xno'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
							$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
							$alamat=strip_tags($this->input->post('xalamat'));
							$rt=strip_tags($this->input->post('xrt'));
							$rw=strip_tags($this->input->post('xrw'));
							$desa=strip_tags($this->input->post('xdesa'));
							$kec=strip_tags($this->input->post('xkec'));
							$kab=strip_tags($this->input->post('xkab'));
							$pos=strip_tags($this->input->post('xpos'));
							$tmp_tgl=strip_tags($this->input->post('xtmp_tgl'));
							$hp=strip_tags($this->input->post('xhp'));
							$tlp=strip_tags($this->input->post('xtlp'));
							$email=strip_tags($this->input->post('xemail'));
							$tinggi=strip_tags($this->input->post('xtinggi'));
							$berat=strip_tags($this->input->post('xberat'));
							$jarak=strip_tags($this->input->post('xjarak'));
							$waktu=strip_tags($this->input->post('xwaktu'));
							$sdr=strip_tags($this->input->post('xsdr'));
							$ayh=strip_tags($this->input->post('xayh'));
							$thn_ayh=strip_tags($this->input->post('xthn_ayh'));
							$pdk_ayh=strip_tags($this->input->post('xpdk_ayh'));
							$job_ayh=strip_tags($this->input->post('xjob_ayh'));
							$gaji_ayh=strip_tags($this->input->post('xgaji_ayh'));
							$no_ayh=strip_tags($this->input->post('xno_ayh'));
							$ibu=strip_tags($this->input->post('xibu'));
							$thn_ibu=strip_tags($this->input->post('xthn_ibu'));
							$pdk_ibu=strip_tags($this->input->post('xpdk_ibu'));
							$job_ibu=strip_tags($this->input->post('xjob_ibu'));
							$gaji_ibu=strip_tags($this->input->post('xgaji_ibu'));
							$no_ibu=strip_tags($this->input->post('xno_ibu'));
							$wali=strip_tags($this->input->post('xwali'));
							$thn_wali=strip_tags($this->input->post('xthn_wali'));
							$pdk_wali=strip_tags($this->input->post('xpdk_wali'));
							$job_wali=strip_tags($this->input->post('xjob_wali'));
							$gaji_wali=strip_tags($this->input->post('xgaji_wali'));
							$no_wali=strip_tags($this->input->post('xno_wali'));

	                        $this->m_regis->update_siswa($kode,$jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$photo,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali);
                            echo $this->session->set_flashdata('msg','success');
                            redirect('admin/regis');
	                }else{
	                        echo $this->session->set_flashdata('msg','warning');
	                        redirect('admin/regis');
	                }
	                
	            }else{
					
					$kode=$this->input->post('kode');
					$jenis=strip_tags($this->input->post('xjenis'));
					$jalur=strip_tags($this->input->post('xjalur'));
					$no=strip_tags($this->input->post('xno'));
					$nama=strip_tags($this->input->post('xnama'));
					$jenkel=strip_tags($this->input->post('xjenkel'));
					$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
					$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
					$alamat=strip_tags($this->input->post('xalamat'));
					$rt=strip_tags($this->input->post('xrt'));
					$rw=strip_tags($this->input->post('xrw'));
					$desa=strip_tags($this->input->post('xdesa'));
					$kec=strip_tags($this->input->post('xkec'));
					$kab=strip_tags($this->input->post('xkab'));
					$pos=strip_tags($this->input->post('xpos'));
					$tmp_tgl=strip_tags($this->input->post('xtmp_tgl'));
					$hp=strip_tags($this->input->post('xhp'));
					$tlp=strip_tags($this->input->post('xtlp'));
					$email=strip_tags($this->input->post('xemail'));
					$tinggi=strip_tags($this->input->post('xtinggi'));
					$berat=strip_tags($this->input->post('xberat'));
					$jarak=strip_tags($this->input->post('xjarak'));
					$waktu=strip_tags($this->input->post('xwaktu'));
					$sdr=strip_tags($this->input->post('xsdr'));
					$ayh=strip_tags($this->input->post('xayh'));
					$thn_ayh=strip_tags($this->input->post('xthn_ayh'));
					$pdk_ayh=strip_tags($this->input->post('xpdk_ayh'));
					$job_ayh=strip_tags($this->input->post('xjob_ayh'));
					$gaji_ayh=strip_tags($this->input->post('xgaji_ayh'));
					$no_ayh=strip_tags($this->input->post('xno_ayh'));
					$ibu=strip_tags($this->input->post('xibu'));
					$thn_ibu=strip_tags($this->input->post('xthn_ibu'));
					$pdk_ibu=strip_tags($this->input->post('xpdk_ibu'));
					$job_ibu=strip_tags($this->input->post('xjob_ibu'));
					$gaji_ibu=strip_tags($this->input->post('xgaji_ibu'));
					$no_ibu=strip_tags($this->input->post('xno_ibu'));
                    $wali=strip_tags($this->input->post('xwali'));
					$thn_wali=strip_tags($this->input->post('xthn_wali'));
					$pdk_wali=strip_tags($this->input->post('xpdk_wali'));
					$job_wali=strip_tags($this->input->post('xjob_wali'));
					$gaji_wali=strip_tags($this->input->post('xgaji_wali'));
                    $no_wali=strip_tags($this->input->post('xno_wali'));

					$this->m_regis->update_siswa_tanpa_img($kode,$jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/regis');
	            } 

	}

	function hapus_siswa(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_regis->hapus_siswa($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/regis');
	}
	function sync_siswa(){
		$kode=$this->input->post('kode');
		$kelas=$this->input->post('kelas');
		$this->m_regis->sync_siswa($kode,$kelas);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/regis');
	}
	function export_data(){
		$kode=$this->input->post('kode');
		$this->m_regis->export_data($kode);
		redirect('admin/regis/export_data');
	}
	

}