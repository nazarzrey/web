<?php
    if (strpos($_SERVER['REQUEST_URI'], "dtl") !== false){
        $gone = "hilang";
        $mrg  = "margin-top:-55px";
    }else{
        $gone = "";
        $mrg  = "";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 2</title>

    <!-- Fontfaces CSS-->
    <link href="<?= adm_assets('css/font-face.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/font-awesome-4.7/css/font-awesome.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/font-awesome-5/css/fontawesome-all.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/mdi-font/css/material-design-iconic-font.min.css') ?>" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= adm_assets('vendor/bootstrap-4.2.1/bootstrap.min.css') ?>" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= adm_assets('vendor/animsition/animsition.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/wow/animate.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/css-hamburgers/hamburgers.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/slick/slick.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/select2/select2.min.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/perfect-scrollbar/perfect-scrollbar.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/vector-map/jqvmap.min.css') ?>" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= adm_assets('css/theme.css') ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('css/adm-custom.css')."?".date("His").rand(0,99) ?>" rel="stylesheet" media="all">
    <link href="<?= adm_assets('vendor/jqery-imgupload/dist/image-uploader.css') ?>" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div id="loader">
        <div class="spinner-border"></div>
    </div>
    <a id="base_url" class="hilang" href="<?= base_url() ?>" />
    <div class="page-wrapper">
    <?php 
        require_once(APPPATH.'views/menu.php'); 
    ?>
            <!-- PAGE CONTAINER-->
        <div class="page-container2" id="header-page" user-tipe='<?= $session['utype'] ?>' >
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2  <?= $gone ?>">
                <div class="header-wrap" style="float:left;padding: 0 50px 0 20px;height: 100%" >
                    <div class="">
                        <div class="backend-logo-title">Halaman ADMIN<br/>Masjid Jami' Al-Hidayah</div>
                    </div>
                </div>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">                
                        <div class="header-wrap2">
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu hilang">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text" placeholder="Cari Data Laporan..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <div class="header-button-item has-noti js-item-menu hilang">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>You have 3 Notifications</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a email notification</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </div>
                                            <div class="content">
                                                <p>Your account has been blocked</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <i class="zmdi zmdi-file-text"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a new file</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__footer">
                                            <a href="#">All notifications</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-lg-block">
                                        <nav class="navbar-sidebar2">
                                            <ul class="list-unstyled navbar__list">
                                                <li>
                                                    <a href="<?= admin_url("") ?>">
                                                        <i class="fas fa-home"></i>Beranda</a>
                                                </li>
                                                <li>
                                                    <a  href='<?= admin_url("rt") ?>'>
                                                        <i class="fas fa-map"></i>Data - Warga</a>
                                                </li>
                                                <li>
                                                    <a  href='<?= admin_url("inshod") ?>'>
                                                        <i class="fas fa-map"></i>Infaq Shodaqoh</a>
                                                </li>
                                                <li class="has-sub hilang">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas fa-map"></i>Add Location
                                                        <span class="arrow">
                                                            <i class="fas fa-angle-down"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings">
                                                                <i class="fas fa-plus"></i>Data Warga</a>
                                                        </li>
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings">
                                                                <i class="fas fa-plus"></i>Tambah Data</a>
                                                        </li>
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings">
                                                                <i class="fas fa-folder-open"></i>Edit Data</a>
                                                        </li>
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings">
                                                                <i class="fas fa-times"></i>Hapus Data</a>

                                                        </li>
                                                        <li class="hilang">
                                                            <a href="#">
                                                                <i class="fas fa-chart-bar"></i>Lihat Data</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="has-sub hilang">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas fa-cog"></i>Seting
                                                        <span class="arrow">
                                                            <i class="fas fa-angle-down"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings" data-frm="kecamatan">
                                                                <i class="fas fa-chart-bar"></i>Kecamatan</a>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings" data-frm="kelurahan">
                                                                <i class="fas fa-chart-bar"></i>Kelurahan</a>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings" data-frm="konstruksi">
                                                                <i class="fas fa-building"></i>Jenis Konstruksi</a>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                        <li>
                                                            <a class="mdl-open" data-href="mdl-settings" data-frm="lahan">
                                                                <i class="fas fa-building"></i>Status Lahan</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="<?= admin_url("export") ?>">
                                                        <i class="fas fa-file-pdf-o"></i>Export</a>
                                                        <span class="inbox-num hilang">3</span>
                                                </li>
                                                <li>
                                                    <a href="<?= admin_url("find") ?>">
                                                        <i class="fas fa-search"></i>Cari Data</a>
                                                        <span class="inbox-num hilang">3</span>
                                                </li>
                                                <li>
                                                    <a href="<?= admin_url("users") ?>">
                                                        <i class="fas fa-user"></i>Akun</a>
                                                </li>
                                                <li>
                                                    <a href="<?= base_url("login/logout") ?>">
                                                        <i class="fas fa-sign-out-alt"></i>Sign Out - <?= strtoupper($session["uname"]) ?></a>
                                                </li>
                                            </ul>
                                        </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
<!--             <section class="au-breadcrumb m-t-75 m-b-25 hilang" style="border-bottom: solid 1px #ddd;box-shadow: 0 0 5px #ccc">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="<?= admin_url("") ?>">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item">Dashboard</li>
                                        </ul>
                                    </div>
                                    <button class="au-btn au-btn-icon au-btn--green">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- END BREADCump -->

            <section>
                <div class="section__content section__content--p30 m-t-75">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 m-t-15 m-b-10">
                                <?php
                                #var_dump($title);
/*                                    if(isset($title)){
                                        echo $title;
                                    }*/
                                ?>
                            </div>                           
                        </div>
                    </div>
                </div>
            </section>