          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <?php                 
                $lvl = $this->session->userdata("pengguna_level");
                $kls = $this->session->userdata("kelas");
                if($lvl=="admin"){                  
                  echo "<a href='".base_url("tabungan/alldata/")."' class='".pilih("all",$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success")." m-1'>All Siswa</a>";
                  if(isset($kelas)){
                      foreach ($kelas as $key => $k) {
                          echo "<a href='".base_url("tabungan/alldata/".$k->kelas_id)."' class='".pilih($k->kelas_id,$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success")." m-1'>".$k->kelas_nama."</a>";
                      }
                  }
                }else{
                  echo "<a href='".base_url("tabungan/alldata/".$kls)."' class='".pilih($kls,$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success")." m-1'>Kelas ".$kls."</a>";
                }
                ?>
                <a href="<?= base_url("tabungan/alldata/report") ?>" class='<?= pilih("report",$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success") ?>'>Report Bulanan</a>
                <a href="<?= base_url("tabungan/alldata/semua") ?>" class='<?= pilih("semua",$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success") ?>'>Total Tabungan</a>
                <?php 
                if($pilih_kelas!="report"){
                  $info = "Nama Siswa";
                }else{
                  $info = "Periode";
                }
                ?>
                <span class="float-right font-weight-normal col-md-4 col-sm-12  m-p-2 d-text-right"><i>detail tabungan klik <?= $info; ?></i></span>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <?php if($pilih_kelas=="semua"){ ?>
                  <thead>
                    <tr class="text-center">
                      <th>Periode</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $at_in = $at_out = $at_all = 0;
                    if(isset($alltabungan)){
                        if($alltabungan){
                            foreach ($alltabungan as $key => $at) {
                                echo 
                                "<tr>
                                <td class='text-center'>".$at->kelas_nama."</td>
                                <td class='text-right'>".currency($at->tab_in)."</td>
                                <td class='text-right'>".currency($at->tab_out)."</td>
                                <td class='text-right'>".currency($at->total)."</td>
                                </tr>";                            
                                $at_in = $at_in + $at->tab_in;
                                $at_out = $at_out + $at->tab_out;
                                $at_all = $at_all + $at->total;
                            }      
                        }                  
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th class="text-right"><?= currency($at_in); ?></th>
                      <th class="text-right"><?= currency($at_out); ?></th>
                      <th class="text-right"><?= currency($at_all); ?></th>
                    </tr>
                  </tfoot>
                <?php }elseif($pilih_kelas=="report"){ ?>
                  
                  <thead>
                    <tr class="text-center">
                      <th>Periode</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $at_in = $at_out = $at_all = 0;
                  if(isset($reporttabungan)){
                    if($reporttabungan){
                      // dbg($reporttabungan);
                      foreach ($reporttabungan as $key => $rt) {                        
                        echo 
                          "<tr>                          
                          <td><a href='#' class='more-dtl' id='".$rt->tgl_id."' data-toggle='modal' data-target='#loadMore'>".$rt->tab_tanggal."</a></td>
                          <td class='text-right'>".currency($rt->tab_in)."</td>
                          <td class='text-right'>".currency($rt->tab_out)."</td>
                          <td class='text-right'>".currency($rt->total)."</td>
                          </tr>
                          ";          
                          $at_in = $at_in + $rt->tab_in;
                          $at_out = $at_out + $rt->tab_out;
                          $at_all = $at_all + $rt->total;               
                      }
                      ?>
                      
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th class="text-right"><?= currency($at_in); ?></th>
                      <th class="text-right"><?= currency($at_out); ?></th>
                      <th class="text-right"><?= currency($at_all); ?></th>
                    </tr>
                  </tfoot>
                      <?php
                    }
                  }
                ?>
                
                <?php }else{ ?>
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Nis</th>
                      <th>Kelas</th>
                      <th>Debit</th>
                      <th>Kredit</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $t_in = $t_out = $t_all = 0;
                    if(isset($tabungan)){
                        if($tabungan){
                          $z=1;
                            foreach ($tabungan as $key => $t) {
                                echo 
                                "<tr>
                                <td><a href='#' class='tabungan-dtl' id='".$t->siswa_id."' data-toggle='modal' data-target='#staticBackdrop' data-kelas='".$t->siswa_kelas_id."'>".Uw($t->siswa_nama)."</a></td>
                                <td class='desktop'>".$t->siswa_nis."</td>
                                <td class='text-center desktop'>".$t->siswa_kelas_id."</td>
                                <td class='text-right'>".currency($t->tab_in)."</td>
                                <td class='text-right'>".currency($t->tab_out)."</td>
                                <td class='text-right'>".currency($t->total)."</td>
                                </tr>";                            
                                $t_in = $t_in + $t->tab_in;
                                $t_out = $t_out + $t->tab_out;
                                $t_all = $t_all + $t->total;
                            }      
                        }                  
                    }
                    ?>
                  </tbody>
                
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <tfoot>
                      <tr class="bg-primary text-light">
                        <th>
                          <!-- <span id="total">Siswa Nabung : <i><?= $z; ?></i></span> -->
                          <span id="tab_in" class="m-4"> Total Masuk : <i><?= currency($t_in); ?></i></span>
                          <span id="tab_out">Total Keluar : <i><?= currency($t_out); ?></i></span>
                          <span id="sisa" class="m-4">Saldo : <i><?= currency($t_all); ?></i></span>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
          
        <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- modal-dialog-centered  -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Input & Detail Tabungan <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-p-0">
        <div class="col-12">
          <div class="row">
            <div class="col-md-5">             
              <div class="card shadow brd3">
                <div class="card-header">
                  <h6>Input / Edit Tabungan</h6>
                </div>                           
                <form class="card-body" id="TabunganFrm" method="post" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <div class="input-group mb-3">
                      <input type="date" class="form-control inputan" placeholder="Tanggal" aria-label="nominal" name="tanggal" value="<?= date("Y-m-d") ?>" required>
                    </div>                    
                    
                      <input type="text" class="hide"name="uid" value="<?= $this->session->userdata("idadmin") ?>">
                      <input type="text" class="siswa_id hide" name="siswa_id" >
                      <input type="text" class="refresh hide" data-check="false">
                    <div class="input-group mb-3">
                      <input type="number" class="form-control text-right inputan" placeholder="Nominal" aria-label="nominal" name="nominal" maxlength="6" required>
                    </div>                    
                    <div class="input-group">
                      <div class="form-check w-50">
                        <input class="form-check-input" type="radio" name="tipe_trans" id="exampleRadios1" value="debit" checked style="position: relative;top:1px;">
                        <label class="form-check-label" for="exampleRadios1">
                          Tambah
                        </label>
                      </div>
                      <div class="form-check w-50">
                        <input class="form-check-input" type="radio" name="tipe_trans" id="exampleRadios2" value="kredit" style="position: relative;top:1px;">
                        <label class="form-check-label" for="exampleRadios2">
                          Ambil
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn  btn-sm btn-success" id="TabunganSave">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
                  <label class="alert-sm text-center p-2 alert-info w-100 popup hide">Sukses Di simpan</label>
                  </form>      
              </div>
            </div>
            <div class="col-md-7 m-p-2">            
              <div class="card shadow">
                <div class="card-header">
                  <h6>Tabungan <b id="modalDtl"></b></h6>
                </div>                     
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableDtl" width="100%" cellspacing="0">
                      <thead><th class="text-center">Tanggal</th><th>Debit</th><th>Kredit</th><th>Aksi</th></thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
