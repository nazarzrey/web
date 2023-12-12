<?php
	class Mod_query extends CI_Model {
    function Query($query){
      $sql =  $this->db->query($query);
      if($sql->num_rows()>1){
        $result =  result_query($sql);
      }else{
        if($sql->num_rows()!=0){
          $result =  array(single_query($sql));    
        }else{
          $result = "";
        }
      }
      return $result;
    }
    // login

    function persentase($tgl,$rt){
      $sintak = "call persentase('$tgl','$rt')";
      $sql    = $this->db->query($sintak);      
      return all_query($sql);
    }
    function persen($tgl,$rt,$tipe){
      if($tipe=="dtl"){
        $sintak = "SELECT  *,CEIL(warga_masuk/warga_ttl*100) AS persen_warga,CEIL(infaq_masuk/infaq_ttl*100) AS persen_infaq FROM persen_data a RIGHT JOIN persen_masuk b ON a.rt=b.rt where tanggal='$tgl' and a.rt='$rt'";
      }else{
        $sintak = "SELECT  
                    SUM(warga_ttl),SUM(infaq_ttl),SUM(warga_masuk),SUM(infaq_masuk),
                    CEIL(SUM(warga_masuk)/SUM(warga_ttl)*100) AS persen_warga,CEIL(SUM(infaq_masuk)/SUM(infaq_ttl)*100) AS persen_infaq 
                    FROM persen_data a RIGHT JOIN persen_masuk b ON a.`rt`=b.`rt`
                    WHERE tanggal='$tgl'";
      }
      $sql    = $this->db->query($sintak);      
      return all_query($sql);
    }
    function catat_log($page,$warga,$jenis,$detail){
      if($jenis=="login"){
        $sql = "INSERT INTO log_user values ('$warga','$detail','$page',now())";
      }else{
        if($page==""){
          $page =  base_url(uri_string());
        }
        $sql = "
        INSERT INTO log_visit (log_akses,log_detail,log_date)
        SELECT * FROM (SELECT '$page', $detail,now()) AS tmp
        WHERE NOT EXISTS (
            SELECT 1 FROM log_visit WHERE log_detail = '$detail' and date_format(log_date,'%Y-%m-%d')=curdate() and log_akses='$page'
        ) LIMIT 1";
      }
      $this->db->query($sql);
    }
    function max_tgl(){      
      $sintak = "select date_format(max(tanggal),'%d-%m-%Y') as max_tgl from infaq";
      $sql    =  $this->db->query($sintak); 
      return all_query($sql);
    }
    function cekUser($username, $password, $tipe) {
      /*$this->db->where("name", $username);
      $this->db->where("pwd", md5($password));*/
      #echo $password;
      #die($tipe);
      if($tipe=="profile"){
        $has = $this->db->get_where("warga",array('lower(nama)'=>str_replace("-"," ",strtolower($username))));    
      }elseif($tipe=="warga"){
        $has = $this->db->get_where("warga",array('lower(nama)'=>str_replace("-"," ",strtolower($username)),'pwd'=>$password));    
      }else{
        $has = $this->db->get_where("users",array('lower(name)'=>strtolower($username),'pwd'=>md5($password)));
      }
      return $has;
    }

   /* function getLoginData($usr, $psw) {
      $u = $usr;
      $p = md5($psw);
      $q_cek_login = $this->db->get_where('users', array('name' => $u, 'pwd' => $p, 'recid'=>'1'));
      if (count($q_cek_login->result()) > 0) {
        foreach ($q_cek_login->result() as $qck) {
          foreach ($q_cek_login->result() as $qad) {
            $sess_data['logged_in'] = TRUE;
            $sess_data['uid'] = $qad->id;
            $sess_data['name'] = $qad->username;
            $sess_data['pwd'] = $qad->password;
            $sess_data['tipe'] = $qad->nama;
            $sess_data['recid'] = $qad->level; // redirect('route', 'refresh');
            $this->session->set_userdata($sess_data);
          }
          redirect(base_url('admin'));
        }
      } else {
          $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
          header('location:' . base_url() . 'login');
        }
    }*/
/*
    function getID($ID) {
      $this->db->where("id",$ID);
      return $this->db->get("tuser");
    }*/
    // end login
    function addOpsi($table){
      if($table=="camat"){
        $table = "kecamatan";
        $kolom = "id_kec as qid,nama as qvalue";
        $where = "recid='1'";
      }elseif($table=="lurah"){
        $table = "kelurahan";
        $kolom = "id_kel as qid,nama as qvalue";
        $where = "recid='1'";
      }elseif($table=="kons"){
        $table = "settings";
        $kolom = "id as qid,desk as qvalue";
        $where = "config1='konstruksi' and recid='1'";
      }elseif($table=="lahan"){
        $table = "settings";
        $kolom = "id as qid,desk as qvalue";
        $where = "config1='lahan' and recid='1'";
      }else{
        die("0");
      }
      $sintak = "select $kolom from $table where $where"; 
      #debug($sintak);
      $sql =  $this->db->query($sintak); 
      return all_query($sql);

    }
    function settings($value='',$value1='')
    {
      if($value1==""){
        $sintak = " where config1='$value' and recid='1'";
      }else{
        $sintak = " where config1='$value' and config2='$value1' and recid='1'";
      }
      $query = "select id,desk from settings ".$sintak;      
      $sql =  $this->db->query($query); 
      return all_query($sql);
    }

    function get_peta(){
      $query = "select jalan,kordinat from berkas_pengaduan where jalan='jeletreng2020-05-31'";
        $sql =  $this->db->query($query); 
        return all_query($sql);      
    }
    function delete_data($id,$column,$table)
    {
      $query = "delete from $table where $column='$id'";
      $sql   =  $this->db->query($query); 
      return $sql;
    }
    function update_gambar($id,$tipe)
    {
      if($tipe=="del"){
        $query = "delete from gallery where  id='$id'";
        $sql =  $this->db->query($query); 
        return $sql;
      }else{
        $query = "select id,nama_file,path from gallery where id_berkas='$id'";
        $sql =  $this->db->query($query); 
        return all_query($sql);
      }
    }
    function newId(){
      $sintak = "SELECT MAX(id_pengaduan + 1) AS id FROM berkas_pengaduan";
      #$sintak = "SELECT IFNULL((SELECT MAX(id_pengaduan + 1) AS id FROM berkas_pengaduan),1) AS id_pengaduan";
      return result_query($this->db->query($sintak));
    }
    function masukin_data($array,$table,$tipe){
      #var_dump($array);
        if($tipe=="batch"){
          $this->db->insert_batch($table, $array); 
        }else{
          $this->db->insert($table, $array); 
        }
        if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

    function editin_data($array,$table,$tipe){
      #var_dump($array);
        if($tipe=="batch"){
          $this->db->insert_batch($table, $array); 
        }else{
          $this->db->replace($table, $array); 
        }
        if ($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        return FALSE;
    }
    function getCamatLurah($tipe,$id){
      #$tipe ### id_kec / id_kel
      #echo $tipe.$id;
      if($tipe==""){
        $sintak = "where b.recid='1'";
        $kolom  = "id_kec,a.nama AS kecamatan,id_kel,b.nama AS kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }elseif(is_numeric($tipe)){
        $sintak = "where id_kel='$id' and id_kec='$tipe' and b.recid='1' ";
        $kolom  = "id_kec,a.nama AS kecamatan,id_kel,b.nama AS kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }elseif($tipe=="kec_only"){
        $sintak = "where a.recid='1' group by kecamatan";
        $kolom  = "id_kec,a.nama AS kecamatan,'' as id_kel,'' as  kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }elseif($tipe=="kec_all"){
        $sintak = "group by kecamatan";
        $kolom  = "id_kec,a.nama AS kecamatan,'' as id_kel,'' as  kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }elseif($tipe=="kel_only"){
        $sintak = "where id_kec='$id' and b.recid='1'";
        $kolom  = "id_kec,a.nama AS kecamatan,id_kel,b.nama  as kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }else{
        $sintak = "where id_kec='$id' and b.recid='1' group by id_kec";
        $kolom  = "id_kec,a.nama AS kecamatan,'' as id_kel,'' as  kelurahan, CONCAT(a.latitude,',',a.longitude) AS kordinat";
      }
      #echo $sintak;
      $query = "SELECT $kolom FROM kecamatan a LEFT JOIN kelurahan b ON a.id_kec=b.id_fk_kec ".$sintak;

      $sql =  $this->db->query($query); 
      return all_query($sql); 
/*      if($tipe==""){
        return result_query($this->db->query($query));    
      }else{
        return single_query($this->db->query($query));
      }*/
    }
    function dtlCamatLurah($value1,$value2){
      if($value1=="kec"){
        $sintak = "where kecamatan='$value2'";
      }elseif(is_numeric($value1)){
        $sintak = "where kecamatan='$value1' and kelurahan='$value2'";
      }elseif($value1=="" && $value2==""){
        $sintak = " where kecamatan='$camat' and kelurahan='$lurah'";
      }
     $query = "SELECT a.*,b.nama AS nama_kelurahan FROM berkas_pengaduan a
                    LEFT JOIN kelurahan b 
                    ON a.kelurahan=b.id_kel 
                    left join kecamatan c 
                    on a.kecamatan=c.id_kec
                    ".$sintak." ORDER BY status_laporan, upd_rec DESC";
      return result_query($this->db->query($query));    
    }
    function dtlLaporan($value1,$value2,$laporan){  
      if(trim($value1)==""){
        $sintak = "where";
      }elseif(trim($value2)==""){
        $sintak = "where kecamatan='$value1' and";
      }else{
        $sintak = "where kecamatan='$value1' and kelurahan='$value2' and";
      }
      #echo $value1.trim($value2).$laporan;
      if(is_numeric($laporan)){
        $kolom  = "
          a.id_pengaduan,
          a.upd_rec,
          a.pelapor,
          a.jalan,
          a.pagu,
          replace(CONCAT(CONCAT(a.kecamatan,':',c.nama),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id_kec,':',nama)),'x') FROM kecamatan zz WHERE zz.id_kec!=a.kecamatan and zz.recid='1')),',x','') AS kecamatan,
          replace(CONCAT(CONCAT(a.kelurahan,':',b.nama),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id_kel,':',nama)),'x') FROM kelurahan yy WHERE yy.id_kel!=a.kelurahan AND id_fk_kec=a.`kecamatan`)),',x','') AS kelurahan,
          a.kordinat,
          replace(CONCAT(CONCAT(a.konstruksi,':',d.desk),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id,':',desk)),'x') FROM settings xx WHERE xx.id!=a.konstruksi AND config1='konstruksi' and xx.recid='1')),',x','') AS konstruksi,
          replace(CONCAT(CONCAT(a.lahan,':',e.desk),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id,':',desk)),'x') FROM settings xx WHERE xx.id!=a.lahan AND config1='lahan' and xx.recid='1')),',x','') AS lahan,
          replace(CONCAT(CONCAT(a.jasal,':',h.desk),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id,':',desk)),'x') FROM settings xx WHERE xx.id!=a.jasal AND config1='jenis' and xx.recid='1')),',x','') AS jenis,
          a.tahun,
          ifnull(CONCAT(CONCAT(a.status_laporan,':',f.desk),',',(SELECT ifnull(GROUP_CONCAT(CONCAT(id,':',desk)),'') FROM settings xx WHERE xx.id!=a.status_laporan AND config1='status'  and xx.recid='1')),'1') AS status_laporan,
          a.status_laporan as old_status,
          a.progres,
          a.lampiran,
          a.aktif,
          a.alasan,
          replace(CONCAT((SELECT ifnull(GROUP_CONCAT(CONCAT(id,':',path,':',nama_file)),'x') FROM gallery WHERE id_berkas=a.`id_pengaduan`)),',x','') AS foto";
        $usulan = "where id_pengaduan='$laporan'";
      }else{
        $kolom  = "
                a.*,a.status_laporan as old_status,b.nama AS nama_kelurahan,c.nama AS nama_kecamatan,
                d.desk AS konstruksi,e.desk AS lahan,replace(f.`desk`,' ','') AS 'status_lap',COUNT(g.id_berkas) AS foto,
                h.desk as jenis
        ";
        $usulan = $sintak." status_laporan=(SELECT id FROM settings WHERE replace(desk,' ','-')='$laporan' and config1='status')";
      }
      $query = "SELECT $kolom
                    FROM berkas_pengaduan a
                    LEFT JOIN kelurahan b 
                    ON a.kelurahan=b.id_kel 
                    LEFT JOIN kecamatan c 
                    ON a.kecamatan=c.id_kec
                    LEFT JOIN settings d
                    ON d.id=a.konstruksi
                    LEFT JOIN settings e
                    ON a.lahan=e.id
                    left join settings f
                    on a.status_laporan=f.id
                    LEFT JOIN gallery g
                    ON a.id_pengaduan=g.id_berkas
                    left join settings h
                    on a.jasal=h.id
                    ".$usulan."
                    group by a.id_pengaduan
                    ORDER BY status_laporan, upd_rec DESC";
      #echo $query;
      $sql =  $this->db->query($query); 
      $col =  $sql->list_fields($sql); 
      return array(all_query($sql),$col); 
    }

/*    $data = [
        'title' => $title,
        'name'  => $name,
        'date'  => $date
];

$builder->where('id', $id);
$builder->update($data);
*/
    function Expor($qry)
    {
      $query = "SELECT
                DATE_FORMAT(a.upd_rec, '%d-%m-%Y') AS tgl,
                a.pelapor,
                a.jalan,
                a.pagu,
                a.`kordinat`,
                b.nama AS kelurahan,
                c.nama AS kecamatan,
                d.desk AS konstruksi,
                e.desk AS lahan,
                h.desk AS jenis,
                REPLACE(f.`desk`, ' ', '') AS 'status_lap',
                a.alasan,
                a.tahun
              FROM
                berkas_pengaduan a
                LEFT JOIN kelurahan b
                  ON a.kelurahan = b.id_kel
                LEFT JOIN kecamatan c
                  ON a.kecamatan = c.id_kec
                LEFT JOIN settings d
                  ON d.id = a.konstruksi
                LEFT JOIN settings e
                  ON a.lahan = e.id
                LEFT JOIN settings f
                  ON a.status_laporan = f.id
                LEFT JOIN gallery g
                  ON a.id_pengaduan = g.id_berkas
                LEFT JOIN settings h
                  ON a.jasal = h.id
                  $qry
              GROUP BY a.id_pengaduan
              ORDER BY status_laporan,
                upd_rec DESC";
      $sql   = $this->db->query($query); 
      $col   = $sql->list_fields($sql); 
      return array(all_query($sql),$col,$query); 
    }
    function find($qry)
    {
       $query = "SELECT
                a.*,a.status_laporan as old_status,b.nama AS nama_kelurahan,c.nama AS nama_kecamatan,
                d.desk AS konstruksi,e.desk AS lahan,replace(f.`desk`,' ','') AS 'status_lap',COUNT(g.id_berkas) AS foto,
                h.desk as jenis
              FROM
                berkas_pengaduan a
                LEFT JOIN kelurahan b
                  ON a.kelurahan = b.id_kel
                LEFT JOIN kecamatan c
                  ON a.kecamatan = c.id_kec
                LEFT JOIN settings d
                  ON d.id = a.konstruksi
                LEFT JOIN settings e
                  ON a.lahan = e.id
                LEFT JOIN settings f
                  ON a.status_laporan = f.id
                LEFT JOIN gallery g
                  ON a.id_pengaduan = g.id_berkas
                LEFT JOIN settings h
                  ON a.jasal = h.id
                  $qry
              GROUP BY a.id_pengaduan
              ORDER BY status_laporan,
                upd_rec DESC";
      $sql   = $this->db->query($query);
      return all_query($sql); 
    }
    function qryOther($sql){
      $sql   =  $this->db->query($sql);
      return all_query($sql); 
    }
    function cekOther($tabel,$array){
      $query = "select * from $tabel ".db_array($array,"select");
      $sql   =  $this->db->query($query);
      return all_query($sql); 
    }
    function saveOther($tabel,$array,$tipe){
      if($tipe=="add"){
        $query = " insert into $tabel ".db_array($array,"insert");
      }elseif($tipe=="update"){
        $query = "update $tabel ".db_array($array,"update");
      }elseif($tipe=="delete"){
        $query = "delete from $tabel ".db_array($array,"delete");
      }
      #debug($query);
      $sql   =  $this->db->query($query);
      return $sql; 
    }
    function dataSettings($value1='',$value2=''){
      if($value1=="status"){
        $conf2 = "";
        if($value2!=''){
          $conf2 = "and config2='$value2'";
        }
        $query = "select id,desk,lower(replace(desk,' ','-')) as class_id,recid from settings where config1='$value1' ".$conf2;
      }else{
        $query = "SELECT id,desk,lower(replace(desk,' ','-')) as class_id,COUNT($value1) AS total,a.recid FROM settings a LEFT JOIN berkas_pengaduan b ON a.id=b.$value1 where config1='$value1' GROUP BY id";
      }
      #echo $query;
      $sql   =  $this->db->query($query);
      return all_query($sql);
    }
    function kelurSettings($value1='',$value2=''){
      #$query = "SELECT id,desk,lower(replace(desk,' ','-')) as class_id,COUNT($value1) AS total,a.recid FROM settings a LEFT JOIN berkas_pengaduan b ON a.id=b.$value1 where config1='$value1' GROUP BY id";
      $query = "SELECT a.".$value2." AS id,a.nama AS desk,LOWER(REPLACE(a.nama,' ','-')) AS class_id,COUNT(b.".$value1.") AS total,a.recid,a.latitude,a.longitude FROM ".$value1." a LEFT JOIN berkas_pengaduan b ON a.".$value2."=b.".$value1." GROUP BY a.".$value2;
      if($value1=="kelurahan"){
          $query = "SELECT
                    a.".$value2." AS id,
                    c.nama AS desk,
                    a.nama AS desk2,
                    LOWER(REPLACE(a.nama, ' ', '-')) AS class_id,
                    COUNT(b.".$value1.") AS total,
                    a.recid,
                    a.latitude,a.longitude
                  FROM
                    ".$value1." a
                    LEFT JOIN berkas_pengaduan b
                      ON a.".$value2." = b.".$value1."
                    LEFT JOIN kecamatan c
                      ON a.`id_fk_kec` = c.`id_kec`
                  GROUP BY a.".$value2."
                  ORDER BY desk";
      }
      
      #echo $query;
      $sql   =  $this->db->query($query);
      return all_query($sql);
    }
    function getGallery($id){
      if($id!=""){
        $sintak = "select id,concat(path,':',nama_file) as img from gallery where grup='gallery' and id_berkas='$id'";
        $sql   =  $this->db->query($sintak);
        return all_query($sql); 
      }else{
        return "";
      }
    }
    function ttl_usulan($value1,$value2,$grup){
     # echo $value2.$value1;
      if($value1!="" and $value2==""){
        $sintak = "and kecamatan='$value1'";
      }elseif($value2!=""){
        $sintak = "and kecamatan='$value1' and kelurahan='$value2'";
      }else{
        $sintak = "";
      }
      if($grup==""){        
        $grup   = "GROUP BY a.status_laporan";
      }else{
        $grup   = "";        
      }
      $query = "SELECT b.id,replace(b.desk,' ','-') as desk,COUNT(a.status_laporan)  as ttl FROM berkas_pengaduan a RIGHT JOIN settings b ON a.status_laporan=b.id where config1='status' $sintak $grup";      
      
      $sql =  $this->db->query($query); 
      return all_query($sql); 
    }
    function getProvinsi($id){
      $id = strtolower($id);
      if(empty($id) || $id==""){
        $sintak = "";
        $kolom  = " distinct(provinsi)";
      }else{
        $sintak = " where REPLACE(LOWER(provinsi),' ','-')='$id'";
        $kolom  = " distinct(kabupaten_kota)";
      }
      $query = "select ".$kolom." as nama from provinsi ".$sintak." order by nama";
      return result_query($this->db->query($query));    
    }
    function getIsp($id){
      if(empty($id) || $id==""){
        $sintak = "";
      }else{
        $sintak = " where nomor='$id'";
      }
      $query = "select * from isp ".$sintak." order by nomor";
      return result_query($this->db->query($query));    
    }
    function getLink($link){
      if(empty($link) || $link=="" || $link=="all"){
        $sintak = "";
      }else{
        $sintak = " where grup='$link'";
      }
      $query = "select * from link ".$sintak." order by id";
      return result_query($this->db->query($query));    
    }
    function saveData($sintak){      
      return $this->db->query($sintak);    
    }
    function resultPeserta($peserta){
      $query = "select * from data_peserta order by id";
      $field = $this->db->list_fields("data_peserta");
      return array(result_query($this->db->query($query)),$field);    
    }
	}
?>