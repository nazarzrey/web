<!--Counter Inbox-->
<?php
    $query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
    $query2=$this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='0'");
    $jum_comment=$query2->num_rows();
    $jum_pesan=$query->num_rows();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>M-Sekolah | Data Baru</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

    <style>
        input:required{border: solid 1px tomato;}
        .radio label{padding-left: 0px;}
    </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <?php
    $this->load->view('admin/v_header');
    $this->load->view('admin/v_menu');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Calon Peserta Didik Baru
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add Data</a>
              <a class="btn btn-primary btn-flat" target="_blank"href="cetak"><span class="fa fa-print"></span> Excel</a>
            </div>
            
            <!-- /.box-header -->
            <!-- /.box-header -->
            <div class="box-body">
                  <table id="example1" class="table table-striped" style="font-size:13px;">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat/Tgl Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=0;
                        foreach ($data->result_array() as $i) :
                            $no++;
                            $id=$i['csiswa_id'];
                            $no=$i['csiswa_no'];
                            $nama=$i['csiswa_nama'];
                            $jenkel=$i['csiswa_jenkel'];
                            $tmp_lahir=$i['csiswa_tmp_lahir'];
          					        $tgl_lahir=$i['csiswa_tgl_lahir'];
                            $alamat=$i['csiswa_alamat'];
                            $photo=$i['csiswa_photo'];
                        ?>
                    <tr>
                      <?php if(empty($photo)):?>
                      <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/user_blank.png';?>"></td>
                      <?php else:?>
                      <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/'.$photo;?>"></td>
                      <?php endif;?>
                      <td><?php echo $no;?></td>
                      <td><?php echo $nama;?></td>
                      <td><?php echo $tmp_lahir.', '.$tgl_lahir;?></td>
                      <?php if($jenkel=='L'):?>
                      <td>Laki-Laki</td>
                      <?php else:?>
                      <td>Perempuan</td>
                      <?php endif;?>
                      <td><?php echo $alamat;?></td>
                      <td style="text-align:right;">
                            <a class="btn" data-toggle="modal" data-target="#ModalSync<?php echo $id;?>"><span class="fa fa-refresh"></span></a>
                            <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span></a>
                            <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $id;?>"><span class="fa fa-trash"></span></a>
               
               
                      </td>                    
                    </tr>
            <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2021.TeamPKM.Unpam.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--Modal Add Pengguna-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="myModalLabel">DAFTAR</h4>
                </div>
                <form class="form-horizontal" action="<?php echo base_url().'admin/regis/simpan_siswa'?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Form Jenis -->
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                        <div class="col-sm-7">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="Baru" name="xjenis" checked>
                                <label for="inlineRadio1"> Baru </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio2" value="Pindahan" name="xjenis">
                                <label for="inlineRadio2"> Pindahan </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio3" value="virtual" name="xjenis">
                                <label for="inlineRadio3"> Virtual </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jalur pendaftaran</label>
                        <div class="col-sm-7">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio-2" value="Regular" name="xjalur" checked>
                                <label for="inlineRadio-2"> Regular </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio-1" value="Prestasi" name="xjalur">
                                <label for="inlineRadio-1"> Prestasi </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio-3" value="Tahfidz" name="xjalur">
                                <label for="inlineRadio-3"> Tahfidz </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio-4" value="Yatim" name="xjalur">
                                <label for="inlineRadio-4"> Yatim </label>
                            </div>
                        </div>
                    </div>

                    <!-- Data Diri -->
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                        <div class="col-sm-7">
                            <input type="text" name="xno" class="form-control" id="inputUserName" placeholder="No NIK" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">NISN</label>
                        <div class="col-sm-7">
                            <input type="text" name="xnisn" class="form-control" id="inputUserName" placeholder="No NISN">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                                <label for="inlineRadio1"> Laki-Laki </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                                <label for="inlineRadio2"> Perempuan </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" name="xtmp_lahir" class="form-control" id="inputUserName" placeholder="Tempat lahir" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tanggal lahir</label>
                        <div class="col-sm-7">
                            <input type="date" name="xtgl_lahir" class="form-control" id="inputUserName" placeholder="Contoh: mm/dd/yyyy" required>
                        </div>
                    </div>

                    <!-- alamat dst -->
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                        <div class="col-sm-7">
                            <input type="text" name="xalamat" class="form-control" id="inputUserName" placeholder="Alamat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">RT / RW</label>
                        <div class="col-sm-7 row">
                            <div class="col-sm-6">
                                <input type="text" name="xrt" class="form-control" id="inputUserName" placeholder="RT" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="xrw" class="form-control" id="inputUserName" placeholder="RW" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Desa</label>
                        <div class="col-sm-7">
                            <input type="text" name="xdesa" class="form-control" id="inputUserName" placeholder="Desa" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Kecamatan</label>
                        <div class="col-sm-7">
                            <input type="text" name="xkec" class="form-control" id="inputUserName" placeholder="Kecamatan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Kabupaten</label>
                        <div class="col-sm-7">
                            <input type="text" name="xkab" class="form-control" id="inputUserName" placeholder="Kabupaten" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Kode Pos</label>
                        <div class="col-sm-7">
                            <input type="text" name="xpos" class="form-control" id="inputUserName" placeholder="Contoh: 11231">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tempat Tinggal</label>
                        <div class="col-sm-7">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="HakMilik" name="xtmp_tgl" checked>
                                <label for="inlineRadio1"> HakMilik </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="Sewa" name="xtmp_tgl">
                                <label for="inlineRadio2"> Sewa </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">No HP</label>
                        <div class="col-sm-7">
                            <input type="text" name="xhp" class="form-control" id="inputUserName" placeholder="Contoh: 628979817173" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">No Telpon</label>
                        <div class="col-sm-7">
                            <input type="text" name="xtlp" class="form-control" id="inputUserName" placeholder="Samakan HP bila tdk ada">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="text" name="xemail" class="form-control" id="inputUserName" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tinggi Badan</label>
                        <div class="col-sm-7">
                            <input type="text" name="xtinggi" class="form-control" id="inputUserName" placeholder="Contoh: 175 Cm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Berat Badan</label>
                        <div class="col-sm-7">
                            <input type="text" name="xberat" class="form-control" id="inputUserName" placeholder="Contoh: 45 Kg" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jarak Tempuh</label>
                        <div class="col-sm-7">
                            <input type="text" name="xjarak" class="form-control" id="inputUserName" placeholder="Contoh: 20 Km">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Waktu Tempuh</label>
                        <div class="col-sm-7">
                            <input type="text" name="xwaktu" class="form-control" id="inputUserName" placeholder="Contoh: 20 Menit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Jumlah saudara</label>
                        <div class="col-sm-7">
                            <input type="text" name="xsdr" class="form-control" id="inputUserName" placeholder="Saudara">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                        <div class="col-sm-7">
                            <input type="file" name="filefoto"/>
                        </div>
                    </div>

                    <!-- Data Orangtua/wali-->
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" name="xayh" class="form-control" id="inputUserName" placeholder="Nama ayah" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" name="xpdk_ayh" class="form-control" id="inputUserName" placeholder="Contoh: S1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" name="xjob_ayh" class="form-control" id="inputUserName" placeholder="Pekerjaan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Penghasilan Ayah</label>
                        <div class="col-sm-7">
                            <input type="text" name="xgaji_ayh" class="form-control" id="inputUserName" placeholder="Contoh: 4000000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" name="xibu" class="form-control" id="inputUserName" placeholder="Nama Ibu" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" name="xpdk_ibu" class="form-control" id="inputUserName" placeholder="Contoh: S1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan Ibu</label>
                        <div class="col-sm-7">
                            <input type="text" name="xjob_ibu" class="form-control" id="inputUserName" placeholder="Pekerjaan" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama wali</label>
                        <div class="col-sm-7">
                            <input type="text" name="xwali" class="form-control" id="inputUserName" placeholder="Nama wali">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pendidikan wali</label>
                        <div class="col-sm-7">
                            <input type="text" name="xpdk_wali" class="form-control" id="inputUserName" placeholder="Contoh: S1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan wali</label>
                        <div class="col-sm-7">
                            <input type="text" name="xjob_wali" class="form-control" id="inputUserName" placeholder="Pekerjaan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

  <!--Modal Edit Album-->
  <?php foreach ($data->result_array() as $i) :
              $id=$i['csiswa_id'];
              $jenis=$i['csiswa_jenis'];
              $jalur=$i['csiswa_jalur'];
              $no=$i['csiswa_no'];
              $nisn=$i['csiswa_nisn'];
              $nama=$i['csiswa_nama'];
              $jenkel=$i['csiswa_jenkel'];
              $tmp_lahir=$i['csiswa_tmp_lahir'];
              $tgl_lahir=$i['csiswa_tgl_lahir'];
              $alamat=$i['csiswa_alamat'];
              $rt=$i['csiswa_rt'];
              $rw=$i['csiswa_rw'];
              $desa=$i['csiswa_desa'];
              $kec=$i['csiswa_kec'];
              $kab=$i['csiswa_kab'];
              $pos=$i['csiswa_pos'];
              $tmp_tgl=$i['csiswa_tmp_tgl'];
              $hp=$i['csiswa_hp'];
              $tlp=$i['csiswa_tlp'];
              $email=$i['csiswa_email'];
              $tinggi=$i['csiswa_tinggi'];
              $berat=$i['csiswa_berat'];
              $jarak=$i['csiswa_jarak'];
              $waktu=$i['csiswa_waktu'];
              $sdr=$i['csiswa_sdr'];
              $photo=$i['csiswa_photo'];
              $ayh=$i['csiswa_ayh'];
              $thn_ayh=$i['csiswa_thn_ayh'];
              $pdk_ayh=$i['csiswa_pdk_ayh'];
              $job_ayh=$i['csiswa_job_ayh'];
              $gaji_ayh=$i['csiswa_gaji_ayh'];
              $no_ayh=$i['csiswa_no_ayh'];
              $ibu=$i['csiswa_ibu'];
              $thn_ibu=$i['csiswa_thn_ibu'];
              $pdk_ibu=$i['csiswa_pdk_ibu'];
              $job_ibu=$i['csiswa_job_ibu'];
              $gaji_ibu=$i['csiswa_gaji_ibu'];
              $no_ibu=$i['csiswa_no_ibu'];
              $wali=$i['csiswa_wali'];
              $thn_wali=$i['csiswa_thn_wali'];
              $pdk_wali=$i['csiswa_pdk_wali'];
              $job_wali=$i['csiswa_job_iwali'];
              $gaji_wali=$i['csiswa_gaji_wali'];
              $no_wali=$i['csiswa_no_wali'];
            ?>

        <div class="modal fade" id="ModalEdit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'admin/regis/update_siswa'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                                <input type="hidden" name="kode" value="<?php echo $id;?>"/>
                                <input type="hidden" value="<?php echo $photo;?>" name="gambar">
                                    <!-- Form Jenis -->
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                        <div class="col-sm-7">
                                          <?php if($jenis=='Baru'):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis1" value="Baru" name="xjenis" checked>
                                                <label for="jenis1"> Baru </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis2" value="Pindahan" name="xjenis">
                                                <label for="jenis2"> Pindahan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis3" value="Virtual" name="xjenis">
                                                <label for="jenis3"> Virtual </label>
                                            </div>
                                          <?php elseif($jenis=="Pindahan"):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis1" value="Baru" name="xjenis" >
                                                <label for="jenis1"> Baru </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis2" value="Pindahan" name="xjenis" checked>
                                                <label for="jenis2"> Pindahan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis3" value="Virtual" name="xjenis">
                                                <label for="jenis3"> Virtual </label>
                                            </div>
                                          <?php else:?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis1" value="Baru" name="xjenis" >
                                                <label for="jenis1"> Baru </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis2" value="Pindahan" name="xjenis">
                                                <label for="jenis2"> Pindahan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenis3" value="Virtual" name="xjenis"checked>
                                                <label for="jenis3"> Virtual </label>
                                            </div>
                                          <?php endif;?>
                                        </div>
                                    </div>
                                    <!-- Form Jalur -->
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Pendaftaran</label>
                                        <div class="col-sm-7">
                                          <?php if($jalur=='Prestasi'):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur1" value="Prestasi" name="xjalur" checked>
                                                <label for="jalur1"> Prestasi </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur2" value="Regular" name="xjalur">
                                                <label for="jalur2"> Regular </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur3" value="Tahfidz" name="xjalur">
                                                <label for="jalur3"> Tahfidz </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur4" value="Yatim" name="xjalur">
                                                <label for="jalur4"> Yatim </label>
                                            </div>
                                            <?php elseif($jalur=='Regular'):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur1" value="Prestasi" name="xjalur" checked>
                                                <label for="jalur1"> Prestasi </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur2" value="Regular" name="xjalur">
                                                <label for="jalur2"> Regular </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur3" value="Tahfidz" name="xjalur">
                                                <label for="jalur3"> Tahfidz </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur4" value="Yatim" name="xjalur">
                                                <label for="jalur4"> Yatim </label>
                                            </div>
                                              <?php elseif($jalur=='Tahfidz'):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur1" value="Prestasi" name="xjalur" checked>
                                                <label for="jalur1"> Prestasi </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur2" value="Regular" name="xjalur">
                                                <label for="jalur2"> Regular </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur3" value="Tahfidz" name="xjalur">
                                                <label for="jalur3"> Tahfidz </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur4" value="Yatim" name="xjalur">
                                                <label for="jalur4"> Yatim </label>
                                            </div>
                                              <?php else:?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur1" value="Prestasi" name="xjalur" checked>
                                                <label for="jalur1"> Prestasi </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur2" value="Regular" name="xjalur">
                                                <label for="jalur2"> Regular </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur3" value="Tahfidz" name="xjalur">
                                                <label for="jalur3"> Tahfidz </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jalur4" value="Yatim" name="xjalur">
                                                <label for="jalur4"> Yatim </label>
                                            </div>
                                              <?php endif;?>
                                        </div>
                                    </div>
                                    <!-- Data Diri -->
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">No</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xno" value="<?php echo $no;?>" class="form-control" id="inputUserName" placeholder="No" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xnama" value="<?php echo $nama;?>" class="form-control" id="inputUserName" placeholder="Nama" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-7">
                                          <?php if($jenkel=='L'):?>
                                           <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenkel1" value="L" name="xjenkel" checked>
                                                <label for="jenkel1"> Laki-Laki </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenkel2" value="P" name="xjenkel">
                                                <label for="jenkel2"> Perempuan </label>
                                            </div>
                                          <?php else:?>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenkel1" value="L" name="xjenkel">
                                                <label for="jenkel1"> Laki-Laki </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="jenkel2" value="P" name="xjenkel" checked>
                                                <label for="jenkel2"> Perempuan </label>
                                            </div>
                                          <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
                                      <div class="col-sm-7">
                                          <input type="text" name="xtmp_lahir" value="<?php echo $tmp_lahir;?>" class="form-control" id="inputUserName" placeholder="Tempat lahir" required>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Tanggal lahir</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xtgl_lahir" value="<?php echo $tgl_lahir;?>" class="form-control" id="inputUserName" placeholder="Contoh: 25 September 1993" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="xalamat" value="<?php echo $alamat;?>" class="form-control" id="inputUserName" placeholder="Alamat" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="inputUserName" class="col-sm-4 control-label">RT</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="xrt" value="<?php echo $rt;?>" class="form-control" id="inputUserName" placeholder="Contoh: 002" required>
                                    </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">RW</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xrw" value="<?php echo $rw;?>" class="form-control" id="inputUserName" placeholder="Contoh: 002" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Desa</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xdesa" value="<?php echo $desa;?>" class="form-control" id="inputUserName" placeholder="Desa" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Kecamatan</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xkec" value="<?php echo $kec;?>" class="form-control" id="inputUserName" placeholder="Kecamatan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Kabupaten</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xkab" value="<?php echo $kab;?>" class="form-control" id="inputUserName" placeholder="Kabupaten" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Kode Pos</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xpos" value="<?php echo $pos;?>" class="form-control" id="inputUserName" placeholder="Contoh: 11231" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Tempat Tinggal</label>
                                            <div class="col-sm-7">
                                                <?php if($jenkel=='HakMilik'):?>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="tinggal1" value="HakMilik" name="xtmp_tgl" checked>
                                                    <label for="tinggal1"> HakMilik </label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="tinggal2" value="Sewa" name="xtmp_tgl">
                                                    <label for="tinggal2"> Sewa </label>
                                                </div>
                                                <?php else:?>
                                                  <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="tinggal1" value="HakMilik" name="xtmp_tgl" >
                                                    <label for="tinggal1"> HakMilik </label>
                                                </div>
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="tinggal2" value="Sewa" name="xtmp_tgl" checked>
                                                    <label for="tinggal2"> Sewa </label>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">No HP</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xhp" value="<?php echo $hp;?>" class="form-control" id="inputUserName" placeholder="Contoh: 08979817173" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">No Telpon</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xtlp" value="<?php echo $tlp;?>" class="form-control" id="inputUserName" placeholder="Samakan HP bila tdk ada" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xemail" value="<?php echo $email;?>" class="form-control" id="inputUserName" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Tinggi</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xtinggi" value="<?php echo $tinggi;?>" class="form-control" id="inputUserName" placeholder="satuan cm" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Berat</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xberat" value="<?php echo $berat;?>" class="form-control" id="inputUserName" placeholder="satuan kg" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Jarak</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xjarak" value="<?php echo $jarak;?>" class="form-control" id="inputUserName" placeholder="Satuan km" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Waktu</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xwaktu" value="<?php echo $waktu;?>" class="form-control" id="inputUserName" placeholder="Satuan menit" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Jumlah saudara</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xsdr" value="<?php echo $sdr;?>" class="form-control" id="inputUserName" placeholder="Saudara" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                                          <div class="col-sm-7">
                                            <input type="file" name="filefoto"/>
                                        </div>
                                        </div>

                                        <!-- Data Orangtua/wali-->
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Nama Ayah</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xayh" value="<?php echo $ayh;?>" class="form-control" id="inputUserName" placeholder="Nama ayah" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Ayah</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xpdk_ayh" value="<?php echo $pdk_ayh;?>" class="form-control" id="inputUserName" placeholder="Contoh: S1" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan Ayah</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xjob_ayh" value="<?php echo $job_ayh;?>" class="form-control" id="inputUserName" placeholder="Pekerjaan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Penghasilan Ayah</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xgaji_ayh" value="<?php echo $gaji_ayh;?>" class="form-control" id="inputUserName" placeholder="Contoh: 4000000" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Nama Ibu</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xibu" value="<?php echo $ibu;?>" class="form-control" id="inputUserName" placeholder="Nama Ibu" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Ibu</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xpdk_ibu" value="<?php echo $pdk_ibu;?>" class="form-control" id="inputUserName" placeholder="Contoh: S1" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan Ibu</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xjob_ibu" value="<?php echo $job_ibu;?>" class="form-control" id="inputUserName" placeholder="Pekerjaan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Nama wali</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xwali" value="<?php echo $wali;?>" class="form-control" id="inputUserName" placeholder="Nama Ibu">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pendidikan wali</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xpdk_wali" value="<?php echo $pdk_wali;?>" class="form-control" id="inputUserName" placeholder="Contoh: S1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan wali</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="xjob_wali" value="<?php echo $job_wali;?>" class="form-control" id="inputUserName" placeholder="Pekerjaan">
                                            </div>
                                        </div>
                                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  <?php endforeach;?>
	<!--Modal Edit Album-->

	<?php foreach ($data->result_array() as $i) :
              $id=$i['csiswa_id'];
              $jenis=$i['csiswa_jenis'];
              $jalur=$i['csiswa_jalur'];
              $no=$i['csiswa_no'];
              $nama=$i['csiswa_nama'];
              $jenkel=$i['csiswa_jenkel'];
              $tmp_lahir=$i['csiswa_tmp_lahir'];
              $tgl_lahir=$i['csiswa_tgl_lahir'];
              $alamat=$i['csiswa_alamat'];
              $rt=$i['csiswa_rt'];
              $rw=$i['csiswa_rw'];
              $desa=$i['csiswa_desa'];
              $kec=$i['csiswa_kec'];
              $kab=$i['csiswa_kab'];
              $pos=$i['csiswa_pos'];
              $tmp_tgl=$i['csiswa_tmp_tgl'];
              $hp=$i['csiswa_hp'];
              $tlp=$i['csiswa_tlp'];
              $email=$i['csiswa_email'];
              $tinggi=$i['csiswa_tinggi'];
              $berat=$i['csiswa_berat'];
              $jarak=$i['csiswa_jarak'];
              $waktu=$i['csiswa_waktu'];
              $sdr=$i['csiswa_sdr'];
              $photo=$i['csiswa_photo'];
              $ayh=$i['csiswa_ayh'];
              $thn_ayh=$i['csiswa_thn_ayh'];
              $pdk_ayh=$i['csiswa_pdk_ayh'];
              $job_ayh=$i['csiswa_job_ayh'];
              $gaji_ayh=$i['csiswa_gaji_ayh'];
              $no_ayh=$i['csiswa_no_ayh'];
              $ibu=$i['csiswa_ibu'];
              $thn_ibu=$i['csiswa_thn_ibu'];
              $pdk_ibu=$i['csiswa_pdk_ibu'];
              $job_ibu=$i['csiswa_job_ibu'];
              $gaji_ibu=$i['csiswa_gaji_ibu'];
              $no_ibu=$i['csiswa_no_ibu'];
              $wali=$i['csiswa_wali'];
              $thn_wali=$i['csiswa_thn_wali'];
              $pdk_wali=$i['csiswa_pdk_wali'];
              $job_wali=$i['csiswa_job_iwali'];
              $gaji_wali=$i['csiswa_gaji_wali'];
              $no_wali=$i['csiswa_no_wali'];
            ?>
	<!--Modal Hapus Pengguna-->
  <div class="modal fade" id="ModalHapus<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                  <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
              </div>
              <form class="form-horizontal" action="<?php echo base_url().'admin/regis/hapus_siswa'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="kode" value="<?php echo $id;?>"/>
                <input type="hidden" value="<?php echo $photo;?>" name="gambar">
                      <p>Apakah Anda yakin mau menghapus Data <b><?php echo $nama;?></b> ?</p>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
              </div>
              </form>
          </div>
      </div>
  </div>
	<?php endforeach;?>
	<?php foreach ($data->result_array() as $i) :
              $id=$i['csiswa_id'];
              $jenis=$i['csiswa_jenis'];
              $jalur=$i['csiswa_jalur'];
              $no=$i['csiswa_no'];
              $nama=$i['csiswa_nama'];
              $jenkel=$i['csiswa_jenkel'];
              $tmp_lahir=$i['csiswa_tmp_lahir'];
              $tgl_lahir=$i['csiswa_tgl_lahir'];
              $alamat=$i['csiswa_alamat'];
              $rt=$i['csiswa_rt'];
              $rw=$i['csiswa_rw'];
              $desa=$i['csiswa_desa'];
              $kec=$i['csiswa_kec'];
              $kab=$i['csiswa_kab'];
              $pos=$i['csiswa_pos'];
              $tmp_tgl=$i['csiswa_tmp_tgl'];
              $hp=$i['csiswa_hp'];
              $tlp=$i['csiswa_tlp'];
              $email=$i['csiswa_email'];
              $tinggi=$i['csiswa_tinggi'];
              $berat=$i['csiswa_berat'];
              $jarak=$i['csiswa_jarak'];
              $waktu=$i['csiswa_waktu'];
              $sdr=$i['csiswa_sdr'];
              $photo=$i['csiswa_photo'];
              $ayh=$i['csiswa_ayh'];
              $thn_ayh=$i['csiswa_thn_ayh'];
              $pdk_ayh=$i['csiswa_pdk_ayh'];
              $job_ayh=$i['csiswa_job_ayh'];
              $gaji_ayh=$i['csiswa_gaji_ayh'];
              $no_ayh=$i['csiswa_no_ayh'];
              $ibu=$i['csiswa_ibu'];
              $thn_ibu=$i['csiswa_thn_ibu'];
              $pdk_ibu=$i['csiswa_pdk_ibu'];
              $job_ibu=$i['csiswa_job_ibu'];
              $gaji_ibu=$i['csiswa_gaji_ibu'];
              $no_ibu=$i['csiswa_no_ibu'];
              $wali=$i['csiswa_wali'];
              $thn_wali=$i['csiswa_thn_wali'];
              $pdk_wali=$i['csiswa_pdk_wali'];
              $job_wali=$i['csiswa_job_iwali'];
              $gaji_wali=$i['csiswa_gaji_wali'];
              $no_wali=$i['csiswa_no_wali'];
            ?>
	<!--Modal Hapus Pengguna-->
  <div class="modal fade" id="ModalSync<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                  <h4 class="modal-title" id="myModalLabel">Sync Data Siswa</h4>
              </div>
              <form class="form-horizontal" action="<?php echo base_url().'admin/regis/sync_siswa'?>" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <input type="hidden" name="kode" value="<?php echo $id;?>"/>
                <input type="hidden" value="<?php echo $photo;?>" name="gambar">
                <p class="text-center">Apakah Anda yakin mau menjadikan <b><?php echo $nama;?> </b> Sebagai Siswa?</p>
                <label for="inputUserName" class="col-sm-4 control-label">Kelas Berapa</label>
                <div class="col-sm-7">
                    <select name="kelas" class="form-control" required>
                        <option value="">-Pilih Kelas-</option>
                        <?php 
                        foreach ($kelas->result_array() as $s){
                            echo "<option value='".$s['kelas_id']."'>".$s['kelas_nama']."</option>";
                        }
                        ?>

                    </select>
                </div>
              </div>
            <div class="form-group">
            </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
              </div>
              </form>
          </div>
      </div>
  </div>
	<?php endforeach;?>



<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<!-- page script -->
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
  <?php if($this->session->flashdata('msg')=='error'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Error',
                      text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                      showHideTransition: 'slide',
                      icon: 'error',
                      hideAfter: false,
                      position: 'bottom-right',
                      bgColor: '#FF4859'
                  });
          </script>

      <?php elseif($this->session->flashdata('msg')=='success'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Success',
                      text: "Data Berhasil disimpan.",
                      showHideTransition: 'slide',
                      icon: 'success',
                      hideAfter: false,
                      position: 'bottom-right',
                      bgColor: '#7EC857'
                  });
          </script>
      <?php elseif($this->session->flashdata('msg')=='info'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Info',
                      text: "Data berhasil di update",
                      showHideTransition: 'slide',
                      icon: 'info',
                      hideAfter: false,
                      position: 'bottom-right',
                      bgColor: '#00C9E6'
                  });
          </script>
      <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
          <script type="text/javascript">
                  $.toast({
                      heading: 'Success',
                      text: "Data Berhasil dihapus.",
                      showHideTransition: 'slide',
                      icon: 'success',
                      hideAfter: false,
                      position: 'bottom-right',
                      bgColor: '#7EC857'
                  });
          </script>
      <?php else:?>

      <?php endif;?>
      <!-- End Function.nya -->
</body>
</html>
