<?php
$isi ="y";
$val = "";
if($isi=="y"){
    $val=date("His");
}
?>
            
            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- RECENT REPORT 2-->
                                <div class="peta">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12">
                                            <div id="googleMap" style="width:100%;height:400px;background: tomato" class="">Peta tinggal di remark di footer</div>
                                        </div>
                                        <div class="col-lg-3 col-md-12">
                                                <div style="width:100%;height:400px;" class="laporan-calur">
                                                    

                                                <div class="title m-b-10 p-2" style="background: #f1f1f1;box-shadow: 0 0 5px #ccc;border: solid 1px #ddd">
                                                    <!-- <span>View Peta / Table</span> -->

                                                    <div class="custom-control custom-switch">
                                                      <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                      <label class="custom-control-label" for="customSwitch2">View Peta</label>
                                                    </div>
                                                </div>
                                            <?php
                                            if(isset($calur)){
                                            ?>
                                                
                                                    <nav class="navbar-sidebar2">
                                                        <ul class="list-unstyled navbar__list">
                                                        <?php
                                                        $x  = 0;
                                                        $z  = count($calur);
                                                        $kc = "";
                                                        foreach ($calur as $key => $data) {
                                                                if($kc!=$data->kecamatan){
                                                                    if($x==0){
                                                                            echo "<li class='has-sub'>";
                                                                    }else{
                                                                        echo "
                                                                        </ul>
                                                                    </li>
                                                                <li class='has-sub'>";
                                                                    }
                                                                    echo "
                                                                    <a class='js-arrow' href='#'>
                                                                        <i class='fas fa-align-right'></i>".$data->kecamatan."
                                                                        <span class='arrow'>
                                                                            <i class='fas fa-angle-down'></i>
                                                                        </span>
                                                                    </a>                                                                    
                                                                    <ul class='list-unstyled navbar__sub-list js-sub-list'>
                                                                        <li>
                                                                            <a href='".admin_url("laporan/kec/".$data->id_kec)."'>
                                                                                <i class='p-l-15'></i>Semua Kelurahan</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href='".admin_url("laporan/kec/".$data->id_kec."/".$data->id_kel)."'>
                                                                                <i class='p-l-15'></i>".$data->kelurahan."</a>
                                                                        </li>
                                                                    ";
                                                                }else{
                                                                    if($x==$z){
                                                                        echo "                                                                    
                                                                            <li>
                                                                            <a href='".admin_url("laporan/kec/".$data->id_kec."/".$data->id_kel)."'>
                                                                                    <i class='p-l-15'></i>".$data->kelurahan."</a>
                                                                            </li>
                                                                        </ul>";
                                                                    }else{
                                                                    echo "                                                                    
                                                                        <li>
                                                                            <a href='".admin_url("laporan/kec/".$data->id_kec."/".$data->id_kel)."'>
                                                                                <i class='p-l-15'></i>".$data->kelurahan."</a>
                                                                        </li>";
                                                                    }
                                                                }
                                                                $kc = $data->kecamatan;
                                                                $x++;
                                                        }
                                                        ?>
                                                    </ul>
                                                </nav>
                                            <?php
                                            }
                                            ?>
                                                </div>
                                        </div>
                                        </div>
                                </div>
                                <!-- END RECENT REPORT 2             -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
    
            <section class="modal-form">
                <div class="hilang">
                    <button type="button" id="mdl-add" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Tambah Data" data-tombol="success">Open modal for @mdo</button>
                    <button type="button" id="mdl-edit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Edit Data" data-tombol="primary">Open modal for @fat</button>
                    <button type="button" id="mdl-del" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Hapus Data" data-tombol="danger">Open modal for @getbootstrap</button>
                </div>
                <div class="xmodal xfade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="modal-form" data-href="form-tambah" enctype="multipart/form-data">
                          <div class="form-row">
                            <div class="col-md-12 form-group">
                              <input type="text" name="jalan" class="form-control" id="jalan" placeholder="Nama jalan" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter" autocomplete="off" value="<?= $val; ?>" />
                              <div class="validate"></div>
                            </div>
                          </div>
                          <div class="form-row">
                              <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="longlat" id="longlat" placeholder="Titik kordinat" data-rule="minlen:4" data-msg="titik kordinat harus di isi"  autocomplete="off" value="<?= $val; ?>"/>
                                <div class="validate"></div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group col-md-6">
                                <select name="kecamatan" id="kecamatan" class="form-control" data-msg="kecamatan belum di pilih" data-rule="required">
                                    <option value="">Kecamatan</option>                                   
                                    <?php
                                        $camat = $this->Mod_query->getCamatLurah("kec_only","");
                                        if($camat){
                                            foreach ($camat as $key => $value) {
                                               # echo $value->id;
                                                echo "<option value='$value->id_kec'>$value->kecamatan</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group  col-md-6">
                                <select name="kelurahan" id="kelurahan" class="form-control" data-msg="kelurahan belum di pilih" data-rule="required"  disabled="">
                                    <option value="">Kelurahan</option>
                                </select>
                                <div class="validate"></div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group  col-md-6">
                                <select name="jasal" id="jasal" class="form-control" data-msg="jenis jalan / saluran belum di pilih" data-rule="required">
                                    <option value="">Jalan / Saluran</option>
                                    <?php
                                        $jenis = $this->Mod_query->settings('jenis','');
                                        if($jenis){
                                            foreach ($jenis as $key => $value) {
                                               # echo $value->id;
                                                echo "<option value='$value->id'>$value->desk</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group  col-md-6">
                                <select name="konstruksi" id="konstruksi" class="form-control" data-msg="jenis konstruksi belum di pilih" data-rule="required">
                                    <option value="">Jenis Konstruksi</option>
                                    <?php
                                        $konstruksi = $this->Mod_query->settings('konstruksi','');
                                        if($konstruksi){
                                            foreach ($konstruksi as $key => $value) {
                                               # echo $value->id;
                                                echo "<option value='$value->id'>$value->desk</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="form-group  col-md-6">
                                <select name="lahan" id="lahan" class="form-control" data-msg="Status lahan belum di pilih" data-rule="required">
                                    <option value="">Status Lahan</option>
                                    <?php
                                        $lahan = $this->Mod_query->settings('lahan','');
                                        #var_dump($lahan);
                                        if($lahan){
                                            foreach ($lahan as $key => $value) {
                                               # echo $value->id;
                                                echo "<option value='$value->id'>$value->desk</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group  col-md-6">
                                <select name="tahun" id="tahun" class="form-control" data-msg="" data-rule="required">
                                    <?php
                                    $date = date("Y");
                                    echo "<option value='$date'>$date</option>";
                                    for($x=$date-3;$x<=$date+2;$x++){
                                        if($x!=$date){
                                            echo "<option value='$x'>$x</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-12 form-group">
                              <input type="text" name="pengusul" class="form-control" id="pengusul" placeholder="Nama Pengusul" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off" value="<?= $val; ?>" />
                              <div class="validate"></div>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="input-field col-md-12 form-group">
                                <label class="active">Foto</label>
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                          </div>
                          <div class="mb-3 hilang">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <div class="col-md-6">
                            <div class="pull-left">
                                <label class="alert alert-danger hide" style="padding: 7px 10px;margin-top: 10px">masih ada data yang harus di isi / dipilih</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" id="btn-frm">Simpan</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
