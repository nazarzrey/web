<?php
$isi ="";
$val = "";
if($isi=="y"){
    $val=date("His");
}
#if($pengusul){
  if($this->session->userdata("pengusul")){
    $pengusul = $this->session->userdata("pengusul");
  }else{    
    $pengusul = "";
  }
#}

#$rand = rand(0,99);
?>    
            <section class="modal-foto">           
                <div class="modal fade" id="modalfoto" tabindex="-1" role="dialog" aria-labelledby="modalfoto" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">                                
                              <ol class="carousel-indicators">
                              </ol>
                              <div class="carousel-inner">
                                <!-- <div class="input-images-2" style="padding-top: .5rem;"></div> -->
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
            </section>
            <section class="modal-tambah">           
                <div class="modal fade" id="modalusulan" tabindex="-1" role="dialog" aria-labelledby="modalusulan" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Edit / Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <form id="modal-edit" data-href="form-edit" enctype="multipart/form-data">
                        </form>
                      </div>
                      <div class="modal-footer">
                        <div class="col-md-6 col-sm-12 col-sx-12">
                            <div class="pull-left">
                                <label class="alert alert-danger hide" style="padding: 7px 10px;margin-top: 10px">masih ada data yang harus di isi / dipilih</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-sx-12">
                            <div class="pull-right" id="usulan-button">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" id="edit-btn-frm" class="btn btn-primary">Simpan</button>
                                <button type="button" id="dele-btn-frm" class="btn btn-danger" data-id="">Hapus</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
            <section class="modal-form">
                <div class="hilang">
                    <button type="button" id="mdl-add" class="btn btn-primary" data-toggle="modal" data-target="#modalusulan" data-whatever="Tambah Data" data-tombol="success">Open modal for @mdo</button>
                    <button type="button" id="mdl-settings" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" data-whatever="Edit Data" data-tombol="primary">Open modal for @fat</button>
                    <button type="button" id="mdl-del" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="Hapus Data" data-tombol="danger">Open modal for @getbootstrap</button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group  col-md-6">
                                <select name="konstruksi" id="konstruksi" class="form-control" data-msg="jenis konstruksi belum di pilih" data-rule="required">
                                    <option value="">Jenis Konstruksi</option>
                                    <?php
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
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                              <div class="form-group  col-md-6">
                                <select name="tahun" id="tahun" class="form-control" data-msg="" data-rule="required">
                                    <?php
                                    ?>
                                </select>
                                <div class="validate"></div>
                              </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 form-group">
                              <input type="text" name="pagu" class="form-control Dec" id="pagu" placeholder="Nilai Pagu" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off" value="<?= $val; ?>" />
                              <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                              <input type="text" name="pengusul" class="form-control" id="pengusul" placeholder="Nama Pengusul" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off" value="<?= $pengusul; ?>" />
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
                        <div class="col-md-6 col-sm-12 col-sx-12">
                            <div class="pull-left">
                                <label class="alert alert-danger hide" style="padding: 7px 10px;margin-top: 10px">masih ada data yang harus di isi / dipilih</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-sx-12">
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" id="btn-frm">Simpan</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Setting form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">


                          <div class="row">
                            <div class="col-md-8" id="settings-data">
                                <div class="settings-disable">
                                </div>
                                <div class="settings-content">
                                </div>                                
                            </div>
                            <div class="col-md-4" id="settings-form">
                                <div id="settings-popup">
                                    <div class="container tambahan">
                                        <h3 class="title-3">
                                            Form <span class="setting-title">title</span>
                                        </h3>
                                    </div>
                                    <div class="col-md-12 tambahan">
                                        <form id="modal-form-settings" enctype="multipart/form-data" style="padding-top:18px; ">
                                                <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-row">
                                                    <div class="col-md-12 form-group">
                                                      <input type="text" name="form[]" class="form-control data-form hide" id="data-id" />
                                                      <input type="text" name="form[]" class="form-control data-form hide" id="data-settings" readonly="" />
                                                      <input type="text" name="form[]" class="form-control data-form hide" id="data-form"readonly="" />
                                                      <input type="text" name="form[]" class="form-control data-form" id="data-desk" placeholder="Deskripsi" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter" autocomplete="off" readonly=""  required="" />
                                                      <select name="form[]" class="form-control data-form" id="data-aktif" readonly="">
                                                        <!-- <option value="0">Aktif</option> -->
                                                      </select>
                                                      <div class="optional-form">
                                                        <div class="optional-data">
                                                        </div>
                                                      </div>
                                                      <br/>
                                                      <div class="msgpopup hide"><label></label></div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center" id="btn-settings1">
                                            <button type="button" class="btn btn-success" id="btn-setting-add">Add</button>
                                        </div>
                                        <div class="text-center  hilang" id="btn-settings2">
                                            <button type="button" class="btn btn-primary" id="btn-setting-save">Simpan</button>
                                            <button type="button" class="btn btn-danger" id="btn-setting-delete">Hapus</button>
                                            <button type="button" class="btn btn-secondary" id="btn-setting-batal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                      </div>
                      <div class="modal-footer hilang">
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="<?= adm_assets('vendor/jquery-3.2.1.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/jqery-imgupload/dist/image-uploader.js')."?".date("His").rand(0,99) ?>"></script>    

    <!-- Bootstrap JS-->
    <script src="<?= adm_assets('vendor/bootstrap-4.1/popper.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/bootstrap-4.2.1/bootstrap.min.js') ?>"></script>
    <!-- Vendor JS       -->
    <script src="<?= adm_assets('vendor/slick/slick.min.js') ?>">
    </script>
    <script src="<?= adm_assets('vendor/wow/wow.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/animsition/animsition.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>">
    </script>
    <script src="<?= adm_assets('vendor/counter-up/jquery.waypoints.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/counter-up/jquery.counterup.min.js') ?>">
    </script>
    <script src="<?= adm_assets('vendor/circle-progress/circle-progress.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="<?= adm_assets('vendor/chartjs/Chart.bundle.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/select2/select2.min.js') ?>">
    </script>
    <script src="<?= adm_assets('vendor/vector-map/jquery.vmap.js') ?>"></script>
    <script src="<?= adm_assets('vendor/vector-map/jquery.vmap.min.js') ?>"></script>
    <script src="<?= adm_assets('vendor/vector-map/jquery.vmap.sampledata.js') ?>"></script>
    <script src="<?= adm_assets('vendor/vector-map/jquery.vmap.world.js') ?>"></script>

    <!-- Maps -->

    <!-- Main JS-->
    <script src="<?= adm_assets('js/main.js') ?>"></script>
    <script src="<?= adm_assets('js/autoNumeric.js')."?".date("His").rand(0,99) ?>"></script>
    <script src="<?= adm_assets('js/custom.js')."?".date("His").rand(0,99) ?>"></script>
    <script src="<?= adm_assets('js/peta.js')."?".date("His").rand(0,99) ?>"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNXa67hbtbAKlxvYb54Ztu4VYZZqXU2Yk&callback=initMap"></script> -->

</body>

</html>
<!-- end document-->