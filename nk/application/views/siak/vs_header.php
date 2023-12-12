<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIAK Admin <?php if(isset($title)){ echo "| ".$title;} ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    .hide{display: none;}
    .sidebar .nav-item .nav-link .img-profile,.topbar .nav-item .nav-link .img-profile {
        height: 2rem;
        width:auto;
    }
    .td-left td,.td-left th,
    .td-right td,.td-right th,
    .td-center td,.td-center th{
      padding: 5px;
      border: solid 1px #ddd;
      text-align: left;
    }
    .td-center td,.td-center th{
      text-align: center;
    }
    .td-right td,.td-right th{
      text-align: right;
    }
    .brd{border:solid 1px}
    .brd1{border:solid 1px red}
    .brd2{border:solid 1px blue}
    .brd3{border:solid 1px #ccc}
    .clr{background-color: #ebebeb;}
    a:hover{text-decoration: none;}
    .brd-left{border-left: double 1px;}
    #dataTableDtl td,
    #dataTableMore td{text-align: right;}
    #dataTableMore th{text-align: center;}
    #dataTableDtl td:first-of-type,
    #dataTableMore td:first-of-type
    {text-align:center;}


      .d-text-right{
        text-align: right;
      }   
       @media (min-width: 768px) {
        .sidebar .nav-item .nav-link {
            padding: 8px 1rem;
        }
        .sidebar-heading{
          padding: 5px 0px 0px 20px !important;
        }
    }
    .mobile{display: none;}
    @media (max-width: 1024px) {
      .desktop{display: none;}
      .m-text-center{
        text-align: center !important;
      }
      .d-text-right{
        text-align: left;
      }   
      .m-text-right{
        text-align: right;
      }
      .m-p-2{
        padding:10px;
      }
      .m-p-1{
        padding:5px;
      }
      .m-p-0{
        padding: 0;
      }
    }
  </style>
</head>

<body class="bg-gradient-primary" id="uid" uid="<?= $this->session->userdata("idadmin") ?>" base-url="<?= "/".$this->uri->segment(1)."/".$this->uri->segment(2)."/" ?>">
