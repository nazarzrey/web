<?php
$dd = date("Y-m-d");
$d1 = date("Y-m-d", strtotime("-1 day"));
$d2 = date("Y-m-d", strtotime("+1 day"));
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary row">
      <div class="col-md-4 col-sm-12 m-text-center">
        <?php
        if (isset($tahun)) {
          foreach ($tahun as $key => $value) {
            // echo $value->tahun." ".date("Y")." ".$this->uri->segment(2)."ZZ";          
            if ($value->tahun == date("Y") && $this->uri->segment(2) == "") {
              $akt = "";
            } else {
              $akt = $value->tahun;
            }
            echo " <a href='" . base_url('iuran/' . $value->tahun) . "' class='btn btn-sm btn-success " . active($akt, $this->uri->segment(2), "0") . "'>" . $value->tahun . "</a>";
          }
        }
        ?>
        <a href="<?= base_url('iuran/alldata/' . $this->uri->segment(3)) ?>" class="btn btn-sm btn-success <?= active("all", $this->uri->segment(2), "0") ?>">All Data Iuran</a>
      </div>
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama</th>
            <th class='desktop'>Nis</th>
            <th class='desktop'>Kelas</th>
            <th class="debit">Debit</th>
            <th class="kredit">Kredit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $t_in = $t_out = $t_all = 0;
          // dbg($iuran);
          $z = 0;
          if (isset($iuran)) {
            if ($iuran) {
              foreach ($iuran as $key => $t) {
                if ($t->tab_in > 0) {
                  $btn = "border-secondary clr";
                  $z = $z + 1;
                } else {
                  $btn = "border-info";
                }
                if ($t->tab_out > 0) {
                  $btn1 = "border-secondary  clr";
                  if ($t->tab_in == 0) {
                    $z = $z + 1;
                  }
                } else {
                  $btn1 = "border-warning ";
                }

                echo
                "<tr id='siswa_" . $t->siswa_id . "'>
                                <td><a href='#' class='iuran-dtl' id='" . $t->siswa_id . "' tahun='" . $this->uri->segment(2) . "' data-toggle='modal' data-target='#staticBackdrop'>" . Uw($t->siswa_nama) . "</a></td>
                                <td class='desktop'>" . Uw($t->siswa_nis) . "</td>
                                <td class='desktop'>" . Uw($t->siswa_kelas_id) . "</td>
                                <td class='text-center debit'>                                
                                  <div class='input-group input-group-sm nilai' id='debit_" . $t->siswa_id . "' vlast='" . NN(currency($t->tab_in)) . "'>
                                    <input type='number' class='form-control Dec text-right focus deci tab_in $btn' placeholder='0' aria-label='Recipient's username' aria-describedby='button-addon2' value='" . NN(currency($t->tab_in)) . "' autocomplete='off' maxlength='6'>
                                    <div class='input-group-append input-sm hide syn-status'>
                                      <img src='" . base_url("assets/images/sync.gif") . "' class='brd rounded-right' height='31px'/>
                                    </div>
                                  </div>
                                </td>
                                <td class='text-center kredit'>                                
                                  <div class='input-group input-group-sm  nilai' id='kredit_" . $t->siswa_id . "' vlast='" . NN(currency($t->tab_out)) . "'>
                                    <input type='number' class='form-control Dec text-right focus deci tab_out  $btn1' placeholder='0' aria-label='Recipient's username' aria-describedby='button-addon2' value='" . NN(currency($t->tab_out)) . "'  autocomplete='off' maxlength='6'> 
                                    <div class='input-group-append input-sm syn-status hide'>
                                      <img src='" . base_url("assets/images/sync.gif") . "' class='brd rounded-right' height='31px'/>
                                    </div>
                                  </div>
                                  
                                </td>
                                </tr>";

                $t_in = $t_in + $t->tab_in;
                $t_out = $t_out + $t->tab_out;
                $t_all = $t_all + $t->total;
              }
            }
          }
          ?>
        </tbody>
      </table>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <tfoot>
            <tr class="bg-primary text-light">
              <th class="col-12">
                <div class="row">
                  <div id="total" class="col-md-3">Siswa Nabung : <i><?= $z; ?></i></div>
                  <div id="tab_in" class="col-md-3"> Total Masuk : <i><?= currency($t_in); ?></i></div><br class="mobile" />
                  <div id="tab_out" class="col-md-3">Total Keluar : <i><?= currency($t_out); ?></i></div><br class="mobile" />
                  <div id="sisa" class="col-md-3">Saldo : <i><?= currency($t_all); ?></i></div>
                </div>
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="hide card-body brd m-0 p-1" style="position: fixed;right:5px;top:23.5vh;background:#fff;border-radius:5px;cursor:pointer">
  <i class="fa fa-cog settings"> Settings</i>
  <div class="card-body brd mt-2 p-2 hide" id="setting-dtl" style="border-radius:10px;">
    <div class="setting-dtl position-relative text-left" style="width: 150px;">
      <div class="input-group">
        <input class="form-control" type="checkbox" checked id="debit" style="height:15px;margin-top:6px" /><label for="debit">Munculkan Debit</label>
      </div>
      <div class="input-group">
        <input class="form-control" type="checkbox" checked id="kredit" style="height:15px;margin-top:6px" /><label for="kredit">Munculkan Kredit</label>
      </div>
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
        <h5 class="modal-title" id="staticBackdropLabel">Input & Detail iuran <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="row">
            <div class="col-md-5">
              <div class="card shadow brd3">
                <div class="card-header">
                  <h6>Input / Edit iuran</h6>
                </div>
                <form class="card-body" id="iuranFrm" method="post" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <div class="input-group mb-3">
                      <input type="date" class="form-control inputan" placeholder="Tanggal" aria-label="nominal" name="tanggal" value="<?= date("Y-m-d") ?>" required min="<?= $min ?>" max="<?= $max ?>">
                    </div>

                    <input type="text" class="hide" name="uid" value="<?= $this->session->userdata("idadmin") ?>">
                    <input type="text" class="siswa_id hide" name="siswa_id">
                    <input type="text" class="refresh hide" data-check="false">
                    <div class="input-group mb-3">
                      <input type="number" class="form-control deci text-right inputan" placeholder="Nominal" aria-label="nominal" name="nominal" maxlength="6" required>
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
                    <button type="button" class="btn  btn-sm btn-success" id="iuranSave">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
                  <label class="alert-sm text-center p-2 alert-info w-100 popup hide">Sukses Di simpan</label>
                </form>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card shadow">
                <div class="card-header">
                  <h6>iuran <b id="modalDtl"></b></h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableDtl" width="100%" cellspacing="0">
                      <thead>
                        <th class="text-center">Tanggal</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                      </thead>
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
</div>