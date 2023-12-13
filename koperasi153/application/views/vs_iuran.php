          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary float-left mt-3">
                <?php

                if (isset($tahun)) {
                  foreach ($tahun as $key => $value) {
                    // echo $value->tahun." ".date("Y")." ".$this->uri->segment(2)."ZZ";          
                    if ($value->tahun == date("Y") && $this->uri->segment(2) == "") {
                      $akt = "";
                    } else {
                      $akt = $value->tahun;
                    }
                    echo " <a href='" . base_url("iuran/" . $value->tahun) . "' class='" . pilih($akt, $this->uri->segment(2), "btn btn-sm btn-primary", "btn btn-sm  btn-success") . " mt-1'>" . $value->tahun . "</a>";
                    // echo " <a href='".base_url('iuran/'.$value->tahun)."' class='btn btn-sm btn-success ".active($akt,$this->uri->segment(2),"0")."'>".$value->tahun."</a>";
                  }
                }
                ?>
                <?= "<a href='" . base_url("iuran/alldata") . "' class='" . pilih("alldata", $this->uri->segment(2), "btn btn-sm btn-primary", "btn btn-sm btn-success") . " mt-1'>All Iuran</a>"; ?>
                <?= "<a href='" . base_url("iuran/periode") . "' class='" . pilih("periode", $this->uri->segment(2), "btn btn-sm btn-primary", "btn btn-sm btn-outline-success") . " mt-1'>Input Periode</a>"; ?>
              </h6>

              <?php if ($this->uri->segment(2) == "periode") { ?>
                <div class="float-right">
                  <div class="row">
                    <div class="mr-2 ">
                      Periode<br />
                      <input class="form-control text-center border-1" type="month" id="periode" min="2021-01" max="<?= date("Y-m") ?>" placeholder="Masukan Priode" value="<?= substr($prd, 0, 4) . "-" . substr($prd, 4, 2) ?>">
                    </div>
                    <div style="width: 130px;">
                      Nominal Iuran<br />
                      <select class="form-control text-center" id="opsiBayar">
                        <?php if (isset($opsiBayar)) {
                          foreach ($opsiBayar as $key => $o) {
                            echo "<option value='" . currency($o->opsi) . "'>" . currency($o->opsi) . "</option>";
                          }
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr <?= isset($bulan) ? "class='text-small'" : ""; ?>>
                      <!-- <th class="m-0 py-1">No</th> -->
                      <th class="m-0 py-1">Nama</th>
                      <?php
                      if (isset($bulan)) {
                        foreach ($bulan as $key => $bln) {
                          echo '<th class="text-center m-0 p-1 bg-light" style="width:120px">' . $bln->bulan . '</th>';
                        }

                        echo '<th class="m-0 py-1">Total</th>';
                      } elseif ($this->uri->segment(2) == "alldata") {
                        foreach ($tahun as $key => $thn) {
                          echo '<th class="text-center m-0 p-1 bg-light" style="width:120px">' . $thn->tahun . '</th>';
                        }
                      } else {
                        echo "<th class='text-center m-0 p-1' style='width:50px'>Member</th>";
                        echo "<th class='text-center m-0 p-1' style='width:200px'>Iuran - $periode</th>";
                        echo "<th class='text-center m-0 p-1' style='width:200px'>Acc</th>";
                        echo "<th class='text-center m-0 p-1 bg-light' style='width:120px'>Bayar</th>";
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // dbg($iuran[0]);
                    $c_in = $c_out = $c_all = 0;
                    if (isset($iuran)) {
                      if ($iuran) {
                        $z = 1;
                        if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "alldata") {
                          foreach ($iuran as $keys => $t) {
                            $arr = (array)($t);
                            if ($t->member == "1") {
                              $class  = "";
                              $member = "<a href='#' class='info' info-text='untuk data detail silahkan pilih tahunnya' id='" . $t->uid . "' tahun='" . $this->uri->segment(2) . "'>" . Uw($t->nama) . "</a>";
                            } else {
                              $class  = "class='bg-light text-success'";
                              $member = Uw($t->nama);
                            }
                            echo
                            "<tr $class>
                                  <td>$member</td>";
                            foreach ($tahun as $key => $thn) {
                              echo "<td class='text-right bg-light'>" . currency($arr["iu_" . $thn->tahun]) . "</td>";
                            }
                            echo "</tr>";
                          }
                        } elseif ($this->uri->segment(2) == "periode") {
                          $c_in = 0;
                          foreach ($iuran as $keys => $t) {
                            $arr = (array)($t);
                            if ($t->member == "1") {
                              $class  = "class='text-small'";
                              $member = "<a href='#' class='iuran-dtl' id='" . $t->uid . "' tahun='" . $this->uri->segment(2) . "'>" . Uw($t->nama) . "</a>";
                              $anggota = "<i class='fa fa-check'></i>";
                            } else {
                              $class  = "class='bg-light text-success text-small'";
                              $member = Uw($t->nama);
                              $anggota = "";
                            }
                            if ($t->cash_in > 0) {
                              $bayar = $t->cash_in;
                              $cekbox = "checked";
                            } else {
                              $bayar = "";
                              $cekbox = "";
                            }
                            $disabled = $t->member == "0" ? "disabled" : "";
                            $input = "<input type='checkbox' $disabled class='form-control form-control-sm bayar-iuran-prd' $cekbox id='" . $t->uid . "' value=''>";
                            echo "<tr $class  id='iuran-prd-" . $t->id . "' trn_id='$t->id' periode='" . $t->periode . "'>
                                  <td>$member</td>
                                  <td class='text-center'>$anggota</td>
                                  <td class='text-right data-iuran-nominal' id='iuranPrd-" . $t->uid . "'>$bayar</td>
                                  <td id='iuranAcc-" . $t->uid . "' class='data-iuran-prd'>" . Uw($t->acc) . "</td>
                                  <td class='text-center'>$input</td>
                                  </tr>";
                            $c_in += str_replace(".", "", $t->cash_in);
                          }
                        } else {
                          foreach ($iuran as $keys => $t) {
                            $arr = (array)($t);
                            if ($t->member == "1") {
                              $class  = "class='text-small'";
                              $member = "<a href='#' class='iuran-dtl' id='" . $t->uid . "' tahun='" . $this->uri->segment(2) . "' data-toggle='modal' data-target='#staticBackdrop'>" . Uw($t->nama) . "</a>";
                            } else {
                              $class  = "class='bg-light text-success text-small'";
                              $member = Uw($t->nama);
                            }
                            echo
                            "<tr $class>
                                  <td>$member</td>";
                            foreach ($bulan as $key => $bln) {
                              echo "<td>" . currency($arr[$bln->bulan]) . "</td>";
                            }
                            echo "<td>" . currency($t->total) . "</td>";
                            echo "</tr>";
                          }
                        }
                      }
                    }
                    ?>
                  </tbody>
                  <?php if ($this->uri->segment(2) == "periode") { ?>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tfoot>
                          <tr class="bg-primary text-light">
                            <th>
                              <!-- <span id="total">Siswa Nabung : <i><?= $z; ?></i></span> -->
                              <span id="tab_in" class="m-4"> Total Iuran : <i id="total-iuran-prd"><?= currency($c_in); ?></i></span>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div class="col-md-12 p-1">
                      <i class="label text-info">Jika opsi bulan tidak muncul, Pastikan Browser Anda sudah update</i>
                    </div>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-backdrop="xstatic" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
              <!-- modal-dialog-centered  -->
              <div class="modal-content ">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">
                    <h6>Detail Data Iuran <b id="modalDtl" uid=""></b></h6>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body m-p-0 ">
                  <div class="row">
                    <div class="col-md-12 m-p-2">
                      <div class="card shadow">
                        <div class="table-responsive">
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>