<?php
class Guru extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('administrator');
            redirect($url);
        };
		$this->load->model('m_guru');
		$this->load->model('m_struktur');
		$this->load->model('m_pengguna');
		$this->load->library('upload');
	}


	function index(){
		$x['data']=$this->m_guru->get_all_guru();
		$x['stru']=$this->m_struktur->get_all_struktur_option();
		$x['stru2']=$this->m_struktur->get_all_struktur();
		$nip = $this->m_guru->get_last_nip()->last_nip;
		if($nip<10){
			$nip="00".$nip;
		}elseif($nip>=10 && $nip<100){
			$nip="0".$nip;
		}
		$x['newnip']=$nip;
		$this->load->view('admin/v_guru',$x);
	}
	
	function simpan_guru(){
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
					$nip=strip_tags($this->input->post('xnip'));
					$nama=strip_tags($this->input->post('xnama'));
					$jenkel=strip_tags($this->input->post('xjenkel'));
					$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
					$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
					$mapel=strip_tags($this->input->post('xmapel'));

					$this->m_guru->simpan_guru($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$photo);
					echo $this->session->set_flashdata('msg','success');
					redirect('admin/guru');
			}else{
				echo $this->session->set_flashdata('msg','warning');
				redirect('admin/guru');
			}
				
		}else{
			$nip=strip_tags($this->input->post('xnip'));
			$nama=strip_tags($this->input->post('xnama'));
			$jenkel=strip_tags($this->input->post('xjenkel'));
			$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
			$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
			$mapel=strip_tags($this->input->post('xmapel'));

			$this->m_guru->simpan_guru_tanpa_img($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel);
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/guru');
		}
				
	}
	
	function update_guru(){
				
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
	                        $img=$this->input->post('gambar');
							$path=FCPATH.'assets/images/'.$img;
							if(file_exists($path)){
								unlink($path);
							}

	                        $photo=$gambar['file_name'];
	                        $kode=$this->input->post('kode');
							$nip=strip_tags($this->input->post('xnip'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
							$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
							$mapel=strip_tags($this->input->post('xmapel'));

				dbg($gambar);
							$this->m_guru->update_guru($kode,$nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$photo);
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/guru');
	                    
	                }else{
	                    echo $this->session->set_flashdata('msg','warning');
	                    redirect('admin/guru');
	                }
	                
	            }else{
							$kode=$this->input->post('kode');
							$nip=strip_tags($this->input->post('xnip'));
							$nama=strip_tags($this->input->post('xnama'));
							$jenkel=strip_tags($this->input->post('xjenkel'));
							$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
							$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
							$mapel=strip_tags($this->input->post('xmapel'));
							// $this->m_guru->update_guru_tanpa_img($kode,$nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel);
							$this->m_guru->update_guru($kode,$nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,"");
							echo $this->session->set_flashdata('msg','info');
							redirect('admin/guru');
	            } 

	}
	function hapus_guru(){
		$kode=$this->input->post('kode');
		$gambar=$this->input->post('gambar');
		$path='./assets/images/'.$gambar;
		unlink($path);
		$this->m_guru->hapus_guru($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/guru');
	}
}