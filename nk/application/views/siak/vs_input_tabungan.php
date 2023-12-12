<?php 
$dd = date("Y-m-d");
$d1 = date("Y-m-d",strtotime("-1 day"));
$d2 = date("Y-m-d",strtotime("+1 day"));
$min = $mm_tanggal[0]->min_tanggal;
$max = $mm_tanggal[0]->max_tanggal;
?>
<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary row">
                    <div class="col-md-4 col-sm-12 m-text-center">
                      <a href="<?= base_url('tabungan/input/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-success <?= active("input",$this->uri->segment(2),"0") ?>">Data Siswa</a>
                      <a href="<?= base_url('tabungan/list/'.$this->uri->segment(3)) ?>" class="btn btn-sm btn-success  <?= active("list",$this->uri->segment(2),"0") ?>">Tabungan</a>
                    </div>                        
                    <div class="col-md-4 col-sm-12  m-p-2" >     
                        <div class="input-group input-group-sm text-right float-right col-md-10 col-sm-12">
                          <div class="input-group-prepend" id="button-addon3">
                              <?php 
                              if($opt_tanggal[0]->option!=""){
                                $urx = "<a href='".base_url('tabungan/'.$this->uri->segment(2)."/".$opt_tanggal[0]->option)."' class='btn btn-primary ' type='button'><i class='fa  fa-angle-left'></i></a>";
                              }else{
                                  $urx = "<a href='#' class='btn btn-outline-secondary disabled' type='button'><i class='fa  fa-angle-left'></i></a>";
                              }
                              echo $urx;
                              ?>
                          </div>
                          <input type="date" class="form-control brd text-center"  placeholder="" aria-label="Example text with two button addons" aria-describedby="button-addon3" id="tab_tgl" value="<?= $this->uri->segment(3)!=""?$this->uri->segment(3):date("Y-m-d"); ?>" min="<?= $min ?>" max="<?= $max ?>"  >
                          <div class="input-group-append" id="button-addon4">
                              <?php 
                              if($opt_tanggal[1]->option!=""){
                                echo "<a href='".base_url('tabungan/'.$this->uri->segment(2)."/".$opt_tanggal[1]->option)."' class='btn btn-primary ' type='button'><i class='fa  fa-angle-right'></i></a>";                                
                                echo "<a href='".base_url('tabungan/'.$this->uri->segment(2)."/")."' class='btn btn-primary brd-left' type='button'>today</a>";
                              }else{
                                if($this->uri->segment(3)=="" || $this->uri->segment(3)==date("Y-m-d")){
                                  echo "<a href='#' class='btn btn-outline-secondary disabled' type='button'><i class='fa  fa-angle-right'></i></a>";
                                }else{
                                  echo "<a href='".base_url('tabungan/'.$this->uri->segment(2)."/".$opt_tanggal[1]->option)."' class='btn btn-primary ' type='button'><i class='fa  fa-angle-right'></i></a>";
                                  echo "<a href='".base_url('tabungan/'.$this->uri->segment(2)."/")."' class='btn btn-primary  brd-left' type='button'>today</a>";
                                }
                              }                              
                              ?>
                          </div>
                        </div>                    
                    </div>             
                    <div class="col-md-4  col-sm-12 text-right m-text-center">      
                      <?php 
                      if($this->uri->segment(3)=="" || $this->uri->segment(3)==date("Y-m-d")){
                        ?>
                        <span class="h5">Tabungan Harian Ini</span>
                        <?php 
                      }else{ 
                        ?>
                        <span class="h5">Tabungan : <?= tgl_indo($this->uri->segment(3)); ?> </span>
                        <?php 
                      } ?>
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
                    // dbg($tabungan);
                    $z=0;
                    if(isset($tabungan)){
                        if($tabungan){
                            foreach ($tabungan as $key => $t) {
                                if($t->tab_in>0){
                                    $btn = "border-secondary clr";
                                    $z=$z+1;
                                }else{
                                    $btn = "border-info";
                                }
                                if($t->tab_out>0){
                                    $btn1 = "border-secondary  clr";
                                    if($t->tab_in==0){
                                      $z=$z+1;
                                    }
                                }else{
                                    $btn1 = "border-warning ";
                                }
                                /*
                                    <div class='input-group-append input-sm hide'>
                                      <button class='btn btn-sm $btn tab_debit' type='button' >Simpan</button>
                                    </div>
                                    
                                    <div class='input-group-append input-sm'>
                                      <button class='btn btn-sm $btn1  tab_kredit' type='button'>Ambil</button>
                                    </div>
                                */
                                
                                echo 
                                "<tr id='siswa_".$t->siswa_id."'>
                                <td><a href='#' class='tabungan-dtl' id='".$t->siswa_id."' data-toggle='modal' data-target='#staticBackdrop' data-kelas='".$t->siswa_kelas_id."'>".Uw($t->siswa_nama)."</a></td>
                                <td class='desktop'>".Uw($t->siswa_nis)."</td>
                                <td class='desktop'>".Uw($t->siswa_kelas_id)."</td>
                                <td class='text-center debit'>                                
                                  <div class='input-group input-group-sm nilai' id='debit_".$t->siswa_id."' vlast='".NN(currency($t->tab_in))."'>
                                    <input type='number' class='form-control Dec text-right focus deci tab_in $btn' placeholder='0' aria-label='Recipient's username' aria-describedby='button-addon2' value='".NN(currency($t->tab_in))."' autocomplete='off' maxlength='6'>
                                    <div class='input-group-append input-sm hide syn-status'>
                                      <img src='".base_url("assets/images/sync.gif")."' class='brd rounded-right' height='31px'/>
                                    </div>
                                  </div>
                                </td>
                                <td class='text-center kredit'>                                
                                  <div class='input-group input-group-sm  nilai' id='kredit_".$t->siswa_id."' vlast='".NN(currency($t->tab_out))."'>
                                    <input type='number' class='form-control Dec text-right focus deci tab_out  $btn1' placeholder='0' aria-label='Recipient's username' aria-describedby='button-addon2' value='".NN(currency($t->tab_out))."'  autocomplete='off' maxlength='6'> 
                                    <div class='input-group-append input-sm syn-status hide'>
                                      <img src='".base_url("assets/images/sync.gif")."' class='brd rounded-right' height='31px'/>
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
                            <div id="tab_in" class="col-md-3"> Total Masuk : <i><?= currency($t_in); ?></i></div><br class="mobile"/>
                            <div id="tab_out" class="col-md-3">Total Keluar : <i><?= currency($t_out); ?></i></div><br class="mobile"/>
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
          <div class="card-body brd m-0 p-1" style="position: fixed;right:5px;top:23.5vh;background:#fff;border-radius:5px;cursor:pointer">
            <i class="fa fa-cog settings"> Settings</i>
            <div class="card-body brd mt-2 p-2 hide" id="setting-dtl" style="border-radius:10px;">
              <div class="setting-dtl position-relative text-left" style="width: 150px;">                    
                  <div class="input-group">  
                    <input class="form-control" type="checkbox" checked id="debit" style="height:15px;margin-top:6px"/><label for="debit">Munculkan Debit</label>
                  </div>
                  <div class="input-group">
                    <input class="form-control" type="checkbox"  checked id="kredit" style="height:15px;margin-top:6px"/><label for="kredit">Munculkan Kredit</label>
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
        <h5 class="modal-title" id="staticBackdropLabel">Input & Detail Tabungan <span></span></h5>
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
                  <h6>Input / Edit Tabungan</h6>
                </div>                           
                <form class="card-body" id="TabunganFrm" method="post" enctype="multipart/form-data">
                  <div class="table-responsive">
                    <div class="input-group mb-3">
                      <input type="date" class="form-control inputan" placeholder="Tanggal" aria-label="nominal" name="tanggal" value="<?= date("Y-m-d") ?>" required min="<?= $min ?>" max="<?= $max ?>">
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
            <div class="col-md-7">            
              <div class="card shadow">
                <div class="card-header">
                  <h6>Tabungan <b id="modalDtl"></b></h6>
                </div>                           
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableDtl" width="100%" cellspacing="0">
                      <thead><th class="text-center">Tanggal</th><th>Debit</th><th>Kredit</th><th>Saldo</th></thead>
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