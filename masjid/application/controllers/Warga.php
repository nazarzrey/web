<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Warga extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model(array('Mod_query'));
  }

  public function index($value=''){
    $this->xdata("");
  }
  public function xdata($value='')
  {
    echo "<style>body{font-family:'Arial Narrow';font-size:9px}table{border-collapse:collapse}</style>";
    $xx = 1;
    $zz = 5;
    if($value!=""){
      $xx = str_replace("0","",$value);
      $zz = $xx;
    }
    for($x=$xx;$x<=$zz;$x++){
      $rt = "select a.* from warga a where rt='0".$x."' order by nomor";
      $sq = $this->Mod_query->Query($rt);
      echo "<h1>RT 0".$x;
      echo "<br/>";
      echo "<table border='1' width='50%'>";
      // echo "<tr><td>No</td><td>Nama</td><td>Kelas</td></tr>";
      $r=1;
      $bg = "";
      foreach ($sq as $key => $z) {
        if($z->cetak=="b"){
          $bg = "style='background:blue;color:#fff'";
          $bg = "";
        }
        if($key==31 || $key==68 || $key==105 || $key==142){
          echo "<tr><td colspan='3' style='text-align:center'>JUMLAH</td></tr>";
          echo "<tr $bg><td>$z->nomor</td><td>$z->nama</td><td>$z->kelas</td></tr>";
        }else{
          echo "<tr $bg><td>$z->nomor</td><td>$z->nama</td><td>$z->kelas</td></tr>";
        }
      }
      echo "</table>";
    } 
    /*
      $sq = "select * from login";
      $qs = $this->Mod_query->Query($sq);
      echo "<div style='position:fixed;right:0;top:0;width:240px'><table border='1' width='100%'>";
      foreach ($qs as $key => $zz) {
          echo "<tr><td>$zz->nama</td><td>$zz->masuk</td></tr>";
      }
      echo "</table></div>";
      */
  }
}