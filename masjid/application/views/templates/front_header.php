<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Masjid Jami' Al-hidayah</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= assets('img/favicon.png') ?>" rel="icon">
  <link href="<?= assets('img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= assets('vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">  

  <?php 

    if(isset($galeri)){
      ?>
    <!-- add styles -->
    <link href="<?= assets('css/least.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= assets('css/main.css') ?>" rel="stylesheet" type="text/css" />

    <!-- add scripts -->
    <script src="<?= assets('js/jquery.min.js') ?>"></script>
    <script src="<?= assets('js/least.min.js') ?>"></script>
    <script src="<?= assets('js/jquery.lazyload.js') ?>"></script>
    <?php
    };

  /*
  <link href="<?= assets('vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/icofont/icofont.min.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/animate.css/animate.min.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/venobox/venobox.css') ?>" rel="stylesheet">
  <link href="<?= assets('vendor/aos/aos.css') ?>" rel="stylesheet">
  */
?>

  <link href="<?= assets('vendor/icofont/icofont.min.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= assets('css/style.css') ?>" rel="stylesheet">

  <!-- Template CUSTOM CSS File -->
  <link href="<?= assets('css/custom-style.css')."?".date("dmyhis"); ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Anyar - v2.0.0
  * Template URL: https://bootstrapmade.com/anyar-free-multipurpose-one-page-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?php
    if(isset($topbar)){
      $display = "hilang";
      $fixtop  = "style='top:0 !important'";
    }else{
      $display = $fixtop = "";
    }
  ?>
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top <?= $display ?>">
    <div class="container d-flex align-items-center">
      <div class="contact-info mr-auto">
        <ul>
          <li><i class="icofont-map"></i>Kp Jeletreng RT 03 / 04 Desa Cogreg Parung Bogor</li>
          <!-- <li><i class="icofont-map"></i>Lokasi</li> -->
        </ul>
      </div>
      <div class="cta">
        <!-- <a href="#about" class="scrollto">Get Started</a> -->

        <a href="<?= base_url("login") ?>" class="scrollto">Login</a>
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" <?= $fixtop ?>>
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo mr-auto"><a href="#header" class="scrollto">Anyar</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
       <a href="#header" class="logo mr-auto scrollto alogo">
        <h3 style="color:#fff">Masjid Jami' Al-hidayah</h3>
       </a>
       <a href="#header" class="logo mr-auto scrollto">
        &nbsp;
       </a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="<?= base_url("infaq/") ?>">Data Infaq Anda</a></li>
          <li><a href="<?= base_url("infaq/report") ?>">Laporan Infaq</a></li>
          <li class="hilang"><a href="#services">Pengerjaan</a></li>
          <li><a href="<?= base_url("galeri") ?>">Gallery</a></li>
          <li  class="hilang"><a href="#contact">Kontak</a></li>
          <li class="hilang"><a href="#infaq">Infaq</a></li>
          <li class="hilang"><a href="#faq" class="">Form Laporan</a></li>
          <?php
          if(count($session)>1){
            #debug($session);
            ?>
          <li class="drop-down"><a href=""><?= ucwords(strtolower($session["uname"])) ?></a>
            <ul>
              <li><a href="<?= base_url("login/keluar") ?>">keluar</a></li>
              <li class="drop-down gone"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li class="hilang"><a href="#">Drop Down 2</a></li>
              <li class="hilang"><a href="#">Drop Down 3</a></li>
              <li class="hilang"><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <?php
          }
          ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
