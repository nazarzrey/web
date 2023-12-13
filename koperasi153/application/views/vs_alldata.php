          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <?php
                // for($x=date("Y");$x>=2021;$x--){
                //   echo "<a href='".base_url("data/".$x)."' class='".pilih($x,$this->uri->segment(2), "btn-sm btn-primary","btn-sm btn-success")." m-1'>".$x."</a>";
                // }
                // echo "<a href='".base_url("data/all")."' class='".pilih("all",$this->uri->segment(2), "btn-sm btn-primary","btn-sm btn-success")." m-1'>All Anggota</a>";
                ?>
                <span class="float-left font-weight-normal col-md-3 col-sm-12  m-p-2 d-text-left"><i>Detail data klik Nama</i></span>
                <span class="float-right font-weight-normal col-md-7 col-sm-12  m-p-2 d-text-right text-danger"><i>Penghitungan Istimewa ada penambahan 10% dari total pinjaman</i></span>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th colspan="4" class="m-0 p-0"></th>
                      <th colspan="3" class="text-center m-0 p-1 bg-light">Sisa Pinjaman</th>
                    </tr>
                    <tr>
                      <th class="m-0 py-1">No</th>
                      <!-- <th class="m-0 py-1">Id</th> -->
                      <th class="m-0 py-1">Nama</th>
                      <th class="m-0 py-1">Type</th>
                      <th class="text-center m-0 p-1" style="width:120px">Total Iuran</th>
                      <th class="text-center m-0 p-1 bg-light" style="width:120px">Umum</th>
                      <th class="text-center m-0 p-1 bg-light" style="width:120px">Istimewa</th>
                      <th class="text-center m-0 p-1 bg-light" style="width:120px">Emergency</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $c_in = $c_out = $c_all = 0;
                    if (isset($iuran)) {
                      if ($iuran) {
                        $z = 1;
                        //dbg($iuran);
                        foreach ($iuran as $key => $t) {
                          if ($t->member == "member") {
                            $class  = "";
                            $member = "<a href='#' class='jurnal-dtl' id='" . $t->uid . "' data-toggle='modal' data-target='#staticBackdrop'>" . Uw($t->nama) . "</a>";
                          } else {
                            $class  = "class='bg-light text-success'";
                            $member = Uw($t->nama);
                          }
                          // $member = 

                          // <td>".$t->uid."</td>
                          echo
                          "<tr $class>
                            <td>" . ($key + 1) . "</td>
                            <td>$member</td>
                            <td >" . $t->member . "</td>
                            <td class='text-right'>" . currency($t->iuran) . "</td>
                            <td class='text-right bg-light'>" . currency($t->pinjaman) . "</td>
                            <td class='text-right bg-light'>" . currency($t->istimewa) . "</td>
                            <td class='text-right bg-light'>" . currency($t->emergency) . "</td>
                            </tr>";
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
                            <span id="tab_in" class="m-4"> Total Masuk : <i><?= currency($c_in); ?></i></span>
                            <span id="tab_out">Total Keluar : <i><?= currency($c_out); ?></i></span>
                            <span id="sisa" class="m-4">Saldo : <i><?= currency($c_all); ?></i></span>
                          </th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </table>
              </div>
            </div>
          </div>

          <!-- Button trigger modal -->
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

          <!-- Modal -->
          <div class="modal fade " id="staticBackdrop" data-backdrop="xstatic" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <!-- modal-dialog-centered  -->
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Detail Transaksi - <b id="modalDtl"></b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="card shadow brd3">
                          <div class="card-body p-3">
                            <div class="col-12">
                              <?php
                              if (isset($transaksi)) {
                                if ($transaksi) {
                                  echo "<li class='text-left btn btn-md btn-success w-100 my-1 jurnal-ba'  id='bayar-pinjaman'><a class='text-light w-100 '>Transaksi</a></li>";
                                  echo "<li class='text-left btn btn-md btn-secondary w-100 my-1 jurnal-menu'  id='jurnal-all'><a class='text-light w-100 '>All Trans <span class='badge float-right'></span></a></li>";
                                  foreach ($transaksi as $key => $value) {
                                    echo "<li class='text-left btn btn-md btn-primary w-100 my-1 jurnal-menu'  id='jurnal-" . $value->mid . "'><a class='text-light w-100 '>" . Uw($value->name) . " <span class='badge float-right'></span></a></li>";
                                  }
                                }
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-9 m-p-2">
                        <div class="card shadow">
                          <div class="table-responsive">
                            <table class="table table-bordered hide" id="jurnalTableDtl" width="100%" cellspacing="0">
                              <thead>
                                <th class="text-center">Tanggal</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Tipe</th>
                                <th>Deskripsi</th>
                                <th>Acc</th>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                            <div id="frmBayarPinjaman">
                              <!--  -->
                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary float-left">
                                    <button class="btn btn-sm btn-info mt-1 trans-iuran-dtl" tahun='<?= $tahun ?>' nama='' id=''>Bayar Iuran</button>
                                    <button class="btn btn-sm btn-primary mt-1">Umum</button>
                                    <button class="btn btn-sm btn-success mt-1">Istimewa</button>
                                    <button class="btn btn-sm btn-danger mt-1">Emergency</button>
                                  </h6>
                                  <div class="float-right">

                                    <select name="ket" class="form-control opsi-pinjaman hide">
                                      <option value="pinjam-in">Bayar Pinjaman</option>
                                      <option value="pinjam-out">Lakukan Peminjaman</option>
                                    </select>

                                  </div>
                                </div>
                                <!-- <div class="card-body bg-warning text-dark"> -->

                                <div class="table-responsive" id="frm-iuran">
                                  <table class="table table-bordered" id="dataTableDtl" width="100%" cellspacing="0">
                                    <thead>
                                      <th class="text-center" style="width:160px">Tahun Bulan</th>
                                      <th style="width:100px">Iuran</th>
                                      <th style="width:250px">Deskripsi</th>
                                      <th>Acc</th>
                                      <th>Aksi</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                  </table>
                                </div>
                                <div class="card-body bg-success text-light hide" id="frm-pinjam">
                                  <div class="container">
                                    <h4 class="text-center font-weight-bold">Form <span>Bayar Pinjaman</span> - <span>Umum</span> </h4>
                                    <form method="post" id="submit-hutang">
                                      <div class="mb-3 col-12">
                                        <label for="formGroupExampleInput2" class="form-label">Sisa Pinjaman</label>
                                        <input type="number" name="sisa" class="form-control" disabled>
                                      </div>
                                      <div class="mb-3 col-12">
                                        <div class="row">
                                          <div class="col-5">
                                            <label for="formGroupExampleInput2" class="form-label">Bayar Pinjaman</label>
                                            <input type="number" name="nominal" class="form-control">
                                          </div>
                                          <div class="col-7">
                                            <label for="formGroupExampleInput2" class="form-label">keterangan</label>
                                            <input type="text" name="desk" class="form-control">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3">
                                      </div>
                                      <div class="mb-3">
                                        <input type="hidden" name="uid" class="form-control">
                                        <input type="hidden" name="type" class="form-control">
                                        <input type="hidden" name="acc" class="form-control">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <!--  -->

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