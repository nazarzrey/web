<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("dashboard") ?>">
    <div class="sidebar-brand-icon">
      <!-- <i class="fas fa-laugh-wink"></i> -->
      <img src="<?= base_url("assets/images/logo-sdi-small.png") ?>" />
    </div>
    <div class="sidebar-brand-text mx-3"> S I A K
    </div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0" />
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url("dashboard") ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider" />
  <!-- Heading -->
  <div class="sidebar-heading">Keuangan</div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebayaran" aria-expanded="true" aria-controls="collapsebayaran">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Infaq</span>
    </a>
    <div id="collapsebayaran" class="collapse " aria-labelledby="headingkeuangan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="#">Infaq</a>
        <!-- <a class="collapse-item" href="#">Ujian</a>
        <a class="collapse-item" href="#">Uang Masuk</a>
        <a class="collapse-item" href="#">Uang Pangkal</a>
        <a class="collapse-item" href="#">Uang Bangunan</a> -->
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsekeuangan" aria-expanded="true" aria-controls="collapsekeuangan">
      <i class="fas fa-fw fa-dollar-sign"></i>
      <span>Tabungan</span>
    </a>
    <div id="collapsekeuangan" class="collapse" aria-labelledby="headingkeuangan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= base_url() ?>tabungan/input">Input Tabungan</a>
        <!-- <a class="collapse-item" href="<?= base_url() ?>tabungan/periode">Data Tabungan Periode</a> -->
        <a class="collapse-item" href="<?= base_url() ?>tabungan/alldata/semua">Data Tabungan</a>
      </div>
    </div>
  </li>
  <!-- Heading -->
  <hr class="sidebar-divider mt-2" />
  <div class="sidebar-heading">Pengaturan</div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
        <a class="collapse-item" href="<?= base_url() ?>master/guru">Data Guru</a>
        <a class="collapse-item" href="<?= base_url() ?>master/siswa">Data Siswa</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
      <i class="fas fa-fw fa-cog"></i>
      <span>Data User</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
        <a class="collapse-item" href="#">Pengaturan User</a>
        <a class="collapse-item" href="#">Profile</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <div class="hide">
    <hr class="sidebar-divider mt-2" />
    <!-- Heading -->
    <div class="sidebar-heading">Addons</div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>
          <a class="collapse-item" href="login.html">Login</a>
          <a class="collapse-item" href="register.html">Register</a>
          <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
          <div class="collapse-divider"></div>
          <h6 class="collapse-header">Other Pages:</h6>
          <a class="collapse-item" href="404.html">404 Page</a>
          <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
      </div>
    </li>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
      <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span>
      </a>
    </li>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
      <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span>
      </a>
    </li>
    <!-- Divider -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  </div>
</ul>
<!-- End of Sidebar -->