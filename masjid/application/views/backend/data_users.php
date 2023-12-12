
<section id="list-user" class="xhilang">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <!-- RECENT REPORT 2-->
                    <div class="peta">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <span class="title-3">Form Users</span>
                                <ul class="nav nav-tabs" id="laporan" role="tablist">                                                    
                                  <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Data Users</a>
                                  </li>
                                  <?php if($uid[1]=="super"){ 
                                    ?>
                                  <a  href="<?= admin_url("users/new") ?>" class="btn btn-danger" aria-selected="false" style="margin:1px !important">Tambah Data
                                  </a>
                                  <?php } ?>
                              </ul>
                                <div class="tab-content" id="UsersContent" style="overflow: auto">
                                  <div class="tab-pane fade active show" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                     <div class="container"> 
                                        <form id="modal-form-users" enctype="multipart/form-data" style="padding-top:18px; ">
                                                <div class="row">
                                                <div class="col-md-7 users-form">
                                                 
                                                  <?php
                                                    #$coloring = "";
                                                    if($useredit){
                                                      echo '<div class="data-disable"></div>';
                                                    }
                                                    if($users){
                                                   # debug($users);
                                                  # echo "XXX";
                                                        echo "<table class='table table-bordered table-hover' style='border:none'>
                                                              <thead>
                                                                <tr>
                                                                  <th scope='col'>No</th>
                                                                  <th scope='col'>Nama</th>
                                                                  <th scope='col'>Tipe</th>
                                                                  <th scope='col'>Status</th>
                                                                  <th scope='col'>Aksi</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>";
                                                        foreach ($users as $key => $value) {
                                                         # echo $key;
                                                            if($value->uid==$uid[0]){
                                                              $rows = "style='color:tomato;font-weight:bold;font-size:16px'";
                                                            }else{
                                                              $rows = "";
                                                            }
                                                            if(is_array($useredit)){
                                                              if($value->uid==$useredit[0]->uid){
                                                                $rows = "style='background: #30539c;font-weight:bold;font-size:16px;color:#fff'";
                                                              }
                                                            }
                                                            if($value->recid=="0"){
                                                                $akt = "<a href='#' class='badge badge-pill badge-warning'>Tidak Aktif</a>";                                                                
                                                            }else{
                                                                $akt = "<a href='#' class='badge badge-pill badge-success'>Aktif</a>";
                                                            }
                                                            $aksi  = "<a  class='btn btn-sm btn-primary data-settings-edit' href='".admin_url("users/".$value->uid)."'>Edit</a>";  
                                                            $num = ($key+1); 
                                                        echo "
                                                            <tr $rows>
                                                            <td>".$num."</td>
                                                            <td>".$value->name."</td>
                                                            <td>".$value->tipe."</td>
                                                            <td class='text-center'>".$akt."</td>
                                                            <td>".$aksi."</td>
                                                            </tr>";
                                                        }
                                                        echo "
                                                          </tbody>
                                                        </table>";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-5 users-list prela" >
                                                    <?php 
                                                    #debug($useredit);
                                                    if($useredit){
                                                      if($useredit=="new"){
                                                        $title = "new";
                                                        $pass  = "";
                                                        $euid  = "999";
                                                        $enama = "";
                                                        $epass = "";
                                                        $etipe = tipe_user("",$uid[1]);
                                                        $eakt  = explode(",",'1:aktif,0:tidak aktif');
                                                        $xtipe = "";
                                                        $xakt  = "";
                                                        foreach ($eakt as $key => $value) {
                                                          $val   = explode(":",$value);
                                                          $xakt .= "<option value='$val[0]'>$val[1]</option>";
                                                        } 
                                                        $akt = "";
                                                        $hil = "hilang";
                                                      }else{
                                                        $title = "edit";
                                                        $pass  = "*****";
                                                        $euid  = $useredit[0]->uid;
                                                        $enama = $useredit[0]->name;
                                                        $epass = $useredit[0]->pwd;
                                                        #debug(tipe_user($useredit[0]->gtipe));
                                                        #$etipe = tipe_user();
                                                        $etipe = tipe_user($useredit[0]->gtipe,$uid[1]);
                                                        $eakt  = explode(",",$useredit[0]->grecid);
                                                        $xtipe = "";
                                                        $xakt  = "";
                                                        foreach ($eakt as $key => $value) {
                                                          $val   = explode(":",$value);
                                                          $xakt .= "<option value='$val[0]'>$val[1]</option>";
                                                        }
                                                        #debug($uid[0].$euid);
                                                        if($uid[0]!=$euid){
                                                          $akt = "readonly";
                                                          $hil = "";
                                                        }else{       
                                                          $akt = "";
                                                          $hil = "hilang";
                                                        }
                                                        #debug($useredit[0]->gtipe);
                                                      }
                                                        foreach ($etipe as $key => $value) {
                                                          $xtipe .= "<option value='$value'>$value</option>";
                                                        }
                                                      ?>                                           
                                                      <div class="form-row">
                                                    <div class="col-md-12 form-group">
                                                     <form id="user-form">
                                                      <input type="text" name="users[]" class="form-control users-form hilang" id="users-frm" placeholder="id" value="<?= $title ?>" />
                                                      <input type="text" name="users[]" class="form-control users-form hilang" id="users-id" placeholder="id" value="<?= $euid ?>" />
                                                      <input type="text" name="users[]" class="form-control users-form" id="users-settings"  placeholder="nama"  value="<?= $enama ?>"   autocomplete="off"/>
                                                      <input type="password" <?= $akt; ?> name="users[]" class="form-control users-form" id="users-form" placeholder="new-pass"  autocomplete="off" value="<?= $pass ?>"/>
                                                      <select name="users[]" class="form-control users-form" id="users-tipe">
                                                        <?= $xtipe; ?>
                                                      </select>
                                                      <select name="users[]" class="form-control users-form" id="users-aktif">
                                                        <?= $xakt; ?>
                                                      </select>
                                                      <br/>
                                                      <div class="col-md-12">
                                                          <div class="row">
                                                              <div class="text-center w100" id="btn-settings2">
                                                                  <button type="button" class="btn btn-primary" id="btn-user-save" data-id="<?= $euid ?>">Simpan</button>
                                                                  <button type="button" class="btn btn-danger <?= $hil ?>" id="btn-user-delete" data-id="<?= $euid ?>">Hapus</button>
                                                                  <a href="<?= admin_url("users") ?>" class="btn btn-secondary" id="btn-user-batal">Batal</a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="msgpopup hide"><label></label></div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                  </div>                                
                                  <div class="tab-pane fade hide " id="tab2" role="tabpanel" aria-labelledby="tab2-tab"></div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>