<?php 
    error_reporting(0);
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $jum_pesan=$query->num_rows();
    $query2=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
    $jum_comment=$query2->num_rows(); 
?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!-- <li class="header">Menu Utama</li> -->
        <li class="<?= active("dashboard",$this->uri->segment(2),"0") ?>" style="border-top:solid 2px" >
          <a href="<?php echo base_url().'admin/dashboard'?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= active(array("tulisan","kategori"),$this->uri->segment(2),"0") ?>">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>Berita</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">
            <li class="<?= active("tulisan",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/tulisan'?>"><i class="fa fa-list"></i> List Berita</a></li>
            <li class="<?= active("tulisan",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/tulisan/add_tulisan'?>"><i class="fa fa-thumb-tack"></i> Post Berita</a></li>
            <li class="<?= active("kategori",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/kategori'?>"><i class="fa fa-wrench"></i> Kategori</a></li>
          </ul>
        </li>
        <li class="<?= active("pengguna",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/pengguna'?>">
            <i class="fa fa-users"></i> <span>Pengguna</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= active("agenda",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/agenda'?>">
            <i class="fa fa-calendar"></i> <span>Agenda</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= active("pengumuman",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/pengumuman'?>">
            <i class="fa fa-volume-up"></i> <span>Pengumuman</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="<?= active("files",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/files'?>">
            <i class="fa fa-download"></i> <span>Download</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li class="treeview <?= active(array("album","galeri"),$this->uri->segment(2),"0") ?>">
          <a href="#">
            <i class="fa fa-camera"></i>
            <span>Gallery</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= active("album",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/album'?>"><i class="fa fa-clone"></i> Album</a></li>
            <li class="<?= active("galeri",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/galeri'?>"><i class="fa fa-picture-o"></i> Photos</a></li>
          </ul>
        </li>

        <li class="treeview <?= active(array("struktur","guru"),$this->uri->segment(2),"0") ?>">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Struktur Sekolah</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= active("guru",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/guru'?>"><i class="fa fa-graduation-cap"></i> Data Guru</a></li>
            <li class="<?= active("struktur",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/struktur'?>"><i class="fa fa-cog"></i> Struktur Sekolah</a></li>
          </ul>
        </li>

        <li class="treeview <?= active(array("siswa","regis"),$this->uri->segment(2),"0") ?>">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Kesiswaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?= active("siswa",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
            <li class="<?= active("regis",$this->uri->segment(2),"0") ?>"><a href="<?php echo base_url().'admin/regis'?>"><i class="fa fa-star-o"></i> Peserta Didik Baru</a></li>
          </ul>
        </li>

        <li class="<?= active("inbox",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/inbox'?>">
            <i class="fa fa-envelope"></i> <span>Inbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $jum_pesan;?></small>
            </span>
          </a>
        </li>

        <li class="<?= active("komentar",$this->uri->segment(2),"0") ?>">
          <a href="<?php echo base_url().'admin/komentar'?>">
            <i class="fa fa-comments"></i> <span>Komentar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?php echo $jum_comment;?></small>
            </span>
          </a>
        </li>

         <li>
         <a href="<?php echo base_url().'admin/login/logout'?>">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>


      </ul>
    </section>
  </aside>