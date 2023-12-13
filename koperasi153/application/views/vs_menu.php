<!-- Sidebar -->
<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("dashboard") ?>">
    <div class="sidebar-brand-text mx-3"> A D M I N<br />Koperasi 153
    </div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0" />
  <li class="nav-item <?= active("dashboard", $uri1, "0") ?>">
    <a class="nav-link" href="<?= base_url("dashboard") ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>HOME</span>
    </a>
  </li>
  <hr class="sidebar-divider" />
  <div class="sidebar-heading">DATA USER</div>
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url("report") ?>">
      <i class="fas fa-fw fa-list"></i>
      <span>MY REPORT</span>
    </a>
  </li>
  <hr class="sidebar-divider" />
  <div class="<?= menu_admin("menu", $this->session->userdata("type"), "") ?>">
    <div class="sidebar-heading">MENU ADMIN</div>
    <li class="nav-item  <?php echo active("data", $uri1, "0");
                          echo hide_inet(); ?>">
      <a class="nav-link" href="<?= base_url("data/all") ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>TRANSAKSI</span>
      </a>
    </li>
    <li class="nav-item <?= active("iuran", $uri1, "0") ?>">
      <a class="nav-link" href="<?= base_url("iuran/" . date("Y")) ?>">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>DATA IURAN</span>
      </a>
    </li>
    <li class="nav-item hide <?= active("iuran", $uri1, "0") ?>">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebayaran" aria-expanded="true" aria-controls="collapsebayaran">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>IURAN</span>
      </a>
      <div id="collapsebayaran" class="collapse " aria-labelledby="headingkeuangan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url("iuran/" . date("Y")) ?>">Input Iuran</a>
          <a class="collapse-item" href="<?= base_url() ?>data/alldata">Data Iuran</a>
        </div>
      </div>
    </li>
    <li class="nav-item <?= active("pinjaman", $uri1, "0") ?>">
      <a class="nav-link" href="<?= base_url("pinjaman") ?>">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>DATA PINJAMAN</span>
      </a>
    </li>
    <li class="nav-item  <?= active("pinjaman", $uri2, "0") ?> hide">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsmember" aria-expanded="true" aria-controls="collapsmember">
        <i class="fas fa-fw fa-dollar-sign"></i>
        <span>PINJAMAN</span>
      </a>
      <div id="collapsmember" class="collapse" aria-labelledby="headingkeuangan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url() ?>pinjaman/member">Member</a>
        </div>
      </div>
    </li>
    <hr class="sidebar-divider mt-2" />
  </div>
  <div class="sidebar-heading">PENGATURAN</div>
  <li class="nav-item <?= menu_admin("menu", $this->session->userdata("type"), "") ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>MASTER</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= base_url() ?>master/user">Data Admin</a>
        <a class="collapse-item" href="<?= base_url() ?>master/anggota">Data Anggota</a>
      </div>
    </div>
  </li>
  <li class="nav-item <?= active("soon", $uri2, "0") ?>">
    <a class="nav-link collapsed" href="<?= base_url() ?>soon" data-toggle=" collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
      <i class="fas fa-fw fa-cog"></i>
      <span>USER SETTING</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="#">Pengaturan User</a>
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