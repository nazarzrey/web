<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIAK Admin <?php if (isset($title)) {
                      echo "| " . $title;
                    } ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    .hide {
      display: none;
    }

    .sidebar .nav-item .nav-link .img-profile,
    .topbar .nav-item .nav-link .img-profile {
      height: 2rem;
      width: auto;
    }

    .text-small th,
    .text-small td {
      font-size: 13px;
    }

    .td-left td,
    .td-left th,
    .td-right td,
    .td-right th,
    .td-center td,
    .td-center th {
      padding: 5px;
      border: solid 1px #ddd;
      text-align: left;
    }

    .td-center td,
    .td-center th {
      text-align: center;
    }

    .td-right td,
    .td-right th {
      text-align: right;
    }

    .brd {
      border: solid 1px
    }

    .brd1 {
      border: solid 1px red
    }

    .brd2 {
      border: solid 1px blue
    }

    .brd3 {
      border: solid 1px #ccc
    }

    .clr {
      background-color: #ebebeb;
    }

    a:hover {
      text-decoration: none;
    }

    .brd-left {
      border-left: double 1px;
    }

    /* #dataTableDtl td, */
    #dataTableMore td {
      text-align: right;
    }

    .beranda th {
      font-size: 15px !important;
      text-align: center !important;
    }

    .beranda td {
      font-size: 14px !important;
    }

    #dataTableMore th {
      text-align: center;
    }

    #dataTableDtl td:first-of-type,
    #dataTableMore td:first-of-type {
      text-align: center;
    }

    #dataTableDtl td,
    #jurnalTableDtl td,
    #moredataTableDtl td,
    #dataTable td {
      padding: 5px !important;
    }

    #dataTableDtl label {
      margin: 0;
    }

    #dataTableDtl input {
      font-size: 14px;
      width: 100%
    }

    .badge {
      font-size: 14px;
      padding: 4px 5px !important;
      margin-left: 5px !important;
      border: solid 1px #fff !important;
      font-weight: normal;
      background-color: #3d4583;
      min-width: 30px
    }

    input[type=checkbox] {
      /* Double-sized Checkboxes */
      -ms-transform: scale(0.75);
      /* IE */
      -moz-transform: scale(0.75);
      /* FF */
      -webkit-transform: scale(0.75);
      /* Safari and Chrome */
      -o-transform: scale(0.75);
      /* Opera */
      padding: 10px;
    }

    /* .btn-primary .badge{font-size:14px;padding:4px 5px !important;margin-left:5px !important;border:solid 1px #fff !important;font-weight: normal;background-color: #3d4583;min-width: 30px;} */
    li {
      list-style: none;
    }

    .d-text-right {
      text-align: right;
    }

    @media (min-width: 768px) {
      .sidebar .nav-item .nav-link {
        padding: 8px 1rem;
      }

      .sidebar-heading {
        padding: 5px 0px 0px 20px !important;
      }
    }

    .m-p-0 {
      padding: 0 !important;
      margin: 0 !important;
    }

    .mobile {
      display: none;
    }

    #moredataTableDtl {
      display: none;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .sidebar .sidebar-heading {
      font-weight: bold;
      letter-spacing: 1.5px;
      font-size: 15px;
      color: #fff470;
    }

    @media (max-width: 1024px) {
      .desktop {
        display: none;
      }

      .m-text-center {
        text-align: center !important;
      }

      .d-text-right {
        text-align: left;
      }

      .m-text-right {
        text-align: right;
      }

      .m-p-2 {
        padding: 10px;
      }

      .m-p-1 {
        padding: 5px;
      }

      .m-p-0 {
        padding: 0 !important;
        margin: 0 !important;
      }

    }
  </style>
</head>

<?php #/".$this->uri->segment(1)."/".$this->uri->segment(2)."/ 
?>

<body class="bg-gradient-primary" id="uid" uid="<?= $this->session->userdata("idadmin") ?>" base-url="<?= base_url("") ?>">
  <div id="waktu" style="position: fixed;z-index:999;padding:5px 10px;background:#fff;border:solid 1px; border-radius:5px;bottom:5px" class="hide">ABC</div>