
<?php 
#$peta = "OpenPopupCenter('".base_url("peta/131")."', 'TEST!?', 720, 480);return false;";
?>

<section id="cari-data" class="xhilang">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- RECENT REPORT 2-->
                    <div class="peta">
                        <div class="row">
                            <div class="col-md-8 col-xl-9">
                                <div id="xframe"  style="width: 100%;min-height:75vh;overflow: auto">
                              </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="container-fluid  shadow-smooth" >
                                <!-- <h3 class="title-5 text-center p-t-10">Cari Data</h3> -->
                                    <form id="cari-form" data-href="form-find" enctype="multipart/form-data"  style="padding: 10px 20px">
                                      <div class="form-row">
                                          <div class="form-group col-md-12">
                                            <select name="kecamatan" id="kecamatan" class="form-control" data-msg="kecamatan belum di pilih" data-rule="required">
                                                <option value="x">All Kecamatan</option>                                   
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
                                          </div>
                                          <div class="form-group  col-md-12">
                                            <input name="kelurahan[]" value="x" class="hilang">
                                            <select name="kelurahan[]" id="kelurahan" class="form-control" data-msg="kelurahan belum di pilih" data-rule="required"  disabled="">
                                                <option value="x">All Kelurahan</option>
                                            </select>
                                          </div>
                                      </div>
                                      <div class="form-row">
                                          <div class="form-group  col-md-12">
                                            <select name="jasal" id="jasal" class="form-control" data-msg="jenis jalan / saluran belum di pilih" data-rule="required">
                                                <option value="x">All Jalan / Saluran</option>
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
                                          </div>
                                          <div class="form-group  col-md-12">
                                            <select name="konstruksi" id="konstruksi" class="form-control" data-msg="jenis konstruksi belum di pilih" data-rule="required">
                                                <option value="x">All Konstruksi</option>
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
                                          </div>
                                      </div>
                                      <div class="form-row">
                                          <div class="form-group  col-md-12">
                                            <select name="lahan" id="lahan" class="form-control" data-msg="Status lahan belum di pilih" data-rule="required">
                                                <option value="x">All Lahan</option>
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
                                          </div>
                                          <div class="form-group  col-md-12">
                                            <select name="status_laporan" id="status_laporan" class="form-control" data-msg="Status lahan belum di pilih" data-rule="required">
                                                <option value="x">All Status</option>
                                                <?php
                                                    $lahan = $this->Mod_query->settings('status','');
                                                    #var_dump($lahan);
                                                    if($lahan){
                                                        foreach ($lahan as $key => $value) {
                                                           # echo $value->id;
                                                            echo "<option value='$value->id'>$value->desk</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                          </div>
                                          <div class="form-group  col-md-12">
                                            <select name="tahun" id="tahun" class="form-control" data-msg="" data-rule="required">
                                                <?php
                                                $date = date("Y");
                                                // echo "<option value='x'>All Tahun</option>";
                                                echo "<option value='$date'>$date</option>";
                                                for($x=$date-3;$x<=$date+2;$x++){
                                                    if($x!=$date){
                                                        echo "<option value='$x'>$x</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                          </div>
                                          <div class="form-group  col-md-12">
                                            <input type="text" name="find" id="cari-input" class="form-control brd" data-rule="required" placeholder="input nama jalan" autocomplete="off" value="">
                                          </div>
                                        <div class="form-group  col-md-12">
                                            <button type="button" class="btn btn-danger m-t-10 w-100 m-b-10 p-t-10 p-b-10" id="btn-find">Cari Data</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>