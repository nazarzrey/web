<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
    .brd-shadow{border: solid 1px #ccc;box-shadow: 0 0 5px 1px #ddd;}
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
  @page {
    size: 210mm 330mm; /* Ukuran kertas F4 dalam milimeter */
    margin: 0; /* Batas margin yang diatur ke 0 */
  }

  body {
    width: 210mm; /* Lebar konten sesuai dengan ukuran kertas F4 */
    height: 330mm; /* Tinggi konten sesuai dengan ukuran kertas F4 */
  }
  table{margin: 2%;width: 96%;margin-bottom: 4%;}
  table td{padding: 2px;}

  </style>
</head>

<?php 
// dbg($data_siswa[0]) ?>
<div class="container">
    <div class="row">
        <!-- <button class="btn btn-primary" onclick="window.print()">Print</button> -->
        <?php 
        foreach ($data_siswa as $key => $s) {
            $qr = "qr".substr($s->siswa_qr,0,15).".png";
            $img_qr = './gallery/'.$qr;
            if(file_exists($img_qr)){
                $img = $img_qr;
            }else{
                $img = './assets/images/blank.png';
            }

            ?>
        <div class="col-md-6 p-2 my-2" style="width:127mm;height:78mm">
            <div class="brd-shadow " style="border-radius: 5px;">
                <h5 class="text-center pt-4">
                    <img src="<?= base_url("assets/images/logo-sdi-small.png")?>" /> <b class="pl-2">SDI NURUL KARIMAH</b>
                </h5>
                <hr>
                <div class="qr">
                    <table>
                        <tr>
                            <td class="pr-2">NAMA</td>
                            <td colspan="2">: <?= $s->siswa_nama ?></td>
                        </tr>
                        <tr>
                            <td class="pr-2">KELAS</td>
                            <td colspan="2">: <?= $s->siswa_kelas_id ?></td>
                        </tr>
                        <tr>
                            <td class="pr-2">NIS </td>
                            <td>: <?= $s->siswa_nis ?></td>                           
                            <td rowspan="3" class="text-right"><img src="<?= base_url($img_qr) ?>" alt="" width="100px"></td>
                        </tr>
                        <tr>
                            <td class="pr-2">NISN </td>
                            <td>: <?= $s->siswa_nisn ?></td>
                        </tr>
                        <tr>
                            <td class="pr-2">PASSWORD </td>
                            <td>: <?= $s->siswa_password ?></td>
                        </tr>
                        <tr>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>
