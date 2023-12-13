<?php 
class M_regis extends CI_Model{

	function get_all_siswa(){
		$hsl=$this->db->query("SELECT * FROM tbl_daftar");
		return $hsl;
	}

	function simpan_siswa($jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$photo,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali){
		$hsl=$this->db->query("INSERT INTO tbl_daftar (csiswa_jenis,csiswa_jalur,csiswa_no,csiswa_nama,csiswa_jenkel,csiswa_tmp_lahir,csiswa_tgl_lahir,csiswa_alamat,csiswa_rt,csiswa_rw,csiswa_desa,csiswa_kec,csiswa_kab,csiswa_pos,csiswa_tmp_tgl,csiswa_hp,csiswa_tlp,csiswa_email,csiswa_tinggi,csiswa_berat,csiswa_jarak,csiswa_waktu,csiswa_sdr,csiswa_photo,csiswa_ayh,csiswa_thn_ayh,csiswa_pdk_ayh,csiswa_job_ayh,csiswa_no_ayh,csiswa_gaji_ayh,csiswa_ibu,csiswa_thn_ibu,csiswa_pdk_ibu,csiswa_job_ibu,csiswa_gaji_ibu,csiswa_no_ibu,csiswa_wali,csiswa_thn_wali,csiswa_pdk_wali,csiswa_job_wali,csiswa_gaji_wali,csiswa_no_wali) VALUES ('$jenis','$jalur','$no','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$alamat','$rt','$rw','$desa','$kec','$kab','$pos','$tmp_tgl','$hp','$tlp','$email','$tinggi','$berat','$jarak','$waktu','$sdr','$photo','$ayh','$thn_ayh','$pdk_ayh','$job_ayh','$gaji_ayh','$no_ayh','$ibu','$thn_ibu','$pdk_ibu','$job_ibu','$gaji_ibu','$no_ibu','$wali','$thn_wali','$pdk_wali','$job_wali','$gaji_wali','$no_wali')");
		return $hsl;
	}
	function simpan_siswa_tanpa_img($jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali){
		$hsl=$this->db->query("INSERT INTO tbl_daftar (csiswa_jenis,csiswa_jalur,csiswa_no,csiswa_nama,csiswa_jenkel,csiswa_tmp_lahir,csiswa_tgl_lahir,csiswa_alamat,csiswa_rt,csiswa_rw,csiswa_desa,csiswa_kec,csiswa_kab,csiswa_pos,csiswa_tmp_tgl,csiswa_hp,csiswa_tlp,csiswa_email,csiswa_tinggi,csiswa_berat,csiswa_jarak,csiswa_waktu,csiswa_sdr,csiswa_ayh,csiswa_thn_ayh,csiswa_pdk_ayh,csiswa_job_ayh,csiswa_no_ayh,csiswa_gaji_ayh,csiswa_ibu,csiswa_thn_ibu,csiswa_pdk_ibu,csiswa_job_ibu,csiswa_gaji_ibu,csiswa_no_ibu,csiswa_wali,csiswa_thn_wali,csiswa_pdk_wali,csiswa_job_wali,csiswa_gaji_wali,csiswa_no_wali) VALUES ('$jenis','$jalur','$no','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$alamat','$rt','$rw','$desa','$kec','$kab','$pos','$tmp_tgl','$hp','$tlp','$email','$tinggi','$berat','$jarak','$waktu','$sdr','$ayh','$thn_ayh','$pdk_ayh','$job_ayh','$gaji_ayh','$no_ayh','$ibu','$thn_ibu','$pdk_ibu','$job_ibu','$gaji_ibu','$no_ibu','$wali','$thn_wali','$pdk_wali','$job_wali','$gaji_wali','$no_wali')");
		return $hsl;
	}

	function update_siswa($kode,$jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$photo,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali){
		$hsl=$this->db->query("UPDATE tbl_daftar SET csiswa_jenis='$jenis',csiswa_jalur='$jalur',csiswa_no='$no',csiswa_nama='$nama',csiswa_jenkel='$jenkel',csiswa_tmp_lahir='$tmp_lahir',csiswa_tgl_lahir='$tgl_lahir',csiswa_alamat='$alamat',csiswa_rt='$rt',csiswa_rw='$rw',csiswa_desa='$desa',csiswa_kec='$kec',csiswa_kab='$kab',csiswa_pos='$pos',csiswa_tmp_tgl='$tmp_tgl',csiswa_hp='$hp',csiswa_tlp='$tlp',csiswa_email='$email',csiswa_tinggi='$tinggi',csiswa_berat='$berat',csiswa_jarak='$jarak',csiswa_waktu='$waktu',csiswa_sdr='$sdr',csiswa_photo='$photo',csiswa_ayh='$ayh',csiswa_thn_ayh='$thn_ayh',csiswa_pdk_ayh='$pdk_ayh',csiswa_job_ayh='$job_ayh',csiswa_gaji_ayh='$gaji_ayh',csiswa_no_ayh='$no_ayh',csiswa_ibu='$ibu',csiswa_thn_ibu='$thn_ibu',csiswa_pdk_ibu='$pdk_ibu',csiswa_job_ibu='$job_ibu',csiswa_gaji_ibu='$gaji_ibu',csiswa_no_ibu='$no_ibu',csiswa_wali='$wali',csiswa_thn_wali='$thn_wali',csiswa_pdk_wali='$pdk_wali',csiswa_job_wali='$job_wali',csiswa_gaji_wali='$gaji_wali',csiswa_no_wali='$no_wali' WHERE csiswa_id='$kode'");
		return $hsl;
	}
	function update_siswa_tanpa_img($kode,$jenis,$jalur,$no,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$alamat,$rt,$rw,$desa,$kec,$kab,$pos,$tmp_tgl,$hp,$tlp,$email,$tinggi,$berat,$jarak,$waktu,$sdr,$ayh,$thn_ayh,$pdk_ayh,$job_ayh,$gaji_ayh,$no_ayh,$ibu,$thn_ibu,$pdk_ibu,$job_ibu,$gaji_ibu,$no_ibu,$wali,$thn_wali,$pdk_wali,$job_wali,$gaji_wali,$no_wali){
		$hsl=$this->db->query("UPDATE tbl_daftar SET csiswa_jenis='$jenis',csiswa_jalur='$jalur',csiswa_no='$no',csiswa_nama='$nama',csiswa_jenkel='$jenkel',csiswa_tmp_lahir='$tmp_lahir',csiswa_tgl_lahir='$tgl_lahir',csiswa_alamat='$alamat',csiswa_rt='$rt',csiswa_rw='$rw',csiswa_desa='$desa',csiswa_kec='$kec',csiswa_kab='$kab',csiswa_pos='$pos',csiswa_tmp_tgl='$tmp_tgl',csiswa_hp='$hp',csiswa_tlp='$tlp',csiswa_email='$email',csiswa_tinggi='$tinggi',csiswa_berat='$berat',csiswa_jarak='$jarak',csiswa_waktu='$waktu',csiswa_sdr='$sdr',csiswa_ayh='$ayh',csiswa_thn_ayh='$thn_ayh',csiswa_pdk_ayh='$pdk_ayh',csiswa_job_ayh='$job_ayh',csiswa_gaji_ayh='$gaji_ayh',csiswa_no_ayh='$no_ayh',csiswa_ibu='$ibu',csiswa_thn_ibu='$thn_ibu',csiswa_pdk_ibu='$pdk_ibu',csiswa_job_ibu='$job_ibu',csiswa_gaji_ibu='$gaji_ibu',csiswa_no_ibu='$no_ibu',csiswa_wali='$wali',csiswa_thn_wali='$thn_wali',csiswa_pdk_wali='$pdk_wali',csiswa_job_wali='$job_wali',csiswa_gaji_wali='$gaji_wali',csiswa_no_wali='$no_wali' WHERE csiswa_id='$kode'");
		return $hsl;
	}
	function hapus_siswa($kode){
		$hsl=$this->db->query("DELETE FROM tbl_daftar WHERE csiswa_id='$kode'");
		return $hsl;
	}
	function siswa(){
		$hsl=$this->db->query("SELECT * FROM tbl_daftar");
		return $hsl;
	}
	function siswa_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT * FROM tbl_daftar limit $offset,$limit");
		return $hsl;
	}

}