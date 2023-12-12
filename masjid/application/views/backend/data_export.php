<section id="export-usulan" class="xhilang">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- RECENT REPORT 2-->
                    <div class="peta">
                        <div class="row">
                            <div class="col-md-9">
                                <iframe id="iframe" src="" style="width: 100%;min-height:75vh " frameBorder="0"></iframe>
                            </div>
                            <div class="col-md-3">
                                <div class="container-fluid  shadow-smooth">
                                <h3 class="title-5 text-center p-t-10">Export Data</h3>
                                    <form id="export-form" data-href="form-tambah" enctype="multipart/form-data">                                      
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
                                                echo "<option value='$date'>$date</option>";
                                                for($x=$date-3;$x<=$date+2;$x++){
                                                    if($x!=$date){
                                                        echo "<option value='$x'>$x</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                          </div>
                                      </div>
                                    <div class="form-group  col-md-12">
                                        <button type="button" class="btn btn-primary m-t-20 w-100 m-b-20" id="btn-export">Export Data</button>
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