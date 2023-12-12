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
  .qr{
    font-size: 22px;
    margin-top: 5px;
    margin-left:30mm;
    color:blue
  }
  .top{position: absolute;top:0;right:0}
  td{border:transparent;border-bottom: solid 1px #ddd;}
  th{padding: 10px;}
  td{padding:2px 15px;}
  </style>
</head>

<?php 
// dbg($data_siswa[0]) ?>
<div class="container">
    <div class="row">
        <!-- <button class="btn btn-primary" onclick="window.print()">Print</button> -->
        <?php 
        if(isset($data_santunan)){
          foreach ($data_santunan as $key => $s) {
            if($s->almarhum!=""){
              $alm = " - alm Bpk ".$s->almarhum;
            }else{
              $alm ="";
            }
              ?>
          <!-- <div class="col-md-12 p-2 my-2" style="height: 300mm;" >
              <div  style="border-radius: 5px;margin-top:33mm">
              -->
          <div class="col-md-12 p-2 my-2" style="height: 405mm;" >
              <div  style="border-radius: 5px;">
                  <div class="qr">
                    <?php echo "Yatim" ?>
                    <?php #= substr($s->nama,0,1) ?>
                  </div>
              </div>
          </div>
              <?php
          }
        }elseif(isset($cetak_santunan)){
          ?>
            <table border="1" class="w-100 mt-2">
              <thead>
                <th>No</th><th>Nama</th><th>Almarhum</th><th>Desk</th><th>RT</th><th>Ceklist</th>
              </thead>
          <?php
          $sts = "Y";
          $no  = 1;
          foreach ($cetak_santunan as $key => $s) {
            if($s->status==$sts){
              $sts = $s->status;
              $no++;
            }else{
              $sts = $s->status;
              echo "<tr><td colspan='6' class='text-center'><b>Janda / Jompo</b></td></tr>";
              $no = 1;
            }
              ?>
                    <tr>
                        <td class="pr-2 text-center"><?= $no ?></td>
                        <td> <?= $s->nama ?></td>
                        <td> <?= $s->almarhum ?></td>
                        <td> <?= $s->status=="Y"?"Yatim":"Janda/Jompo" ?></td>
                        <td> <?= $s->rt ?></td>
                        <td style="width: 50px;"> <input type="text" style="width: 50px;"></td>
                    </tr>
              <?php
          }
          echo "</table>";
        }
        ?>
    </div>
</div>
