<div class="container">
  <div class="row justify-content-center mt-5 pt-4">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="p-3">
                <div class="text-center mt-5">
                  <h1 class="h4 text-gray-900 mb-1">Welcome</h1>
                  <h5 class="h5 text-gray-900 mb-4">KOPERASI 153</h5>
                </div>
                <!-- <form class="user"> -->
                <?php if ($this->session->flashdata('updpass')) { ?>
                  <form action="<?= base_url("login/updpass") ?>" method="post" id="submit-form">
                    <h6 class="pb-2 text-center">Silahkan buat password baru<br /> minimal 6 karakter</h6>
                    <div class="form-group hide">
                      <input type="text" name="uid" class="form-control form-control-user" id="uid" maxlength="6" placeholder="uid" required value='<?= $this->session->flashdata('uidpass') ?>'>
                    </div>
                    <div class="form-group">
                      <input type="password" name="npwd1" class="form-control form-control-user" id="Password" maxlength="6" placeholder="Password Baru" required>
                    </div>
                    <div class="form-group mb-0">
                      <input type="password" name="npwd2" class="form-control form-control-user" id="ConfirmPassword" maxlength="6" placeholder="Ulangi Password Baru" required>
                    </div>
                    <label id="CheckPasswordMatch"></label>
                    <div class="row">
                      <div class="w-50 p-2">
                        <button class=" btn btn-success btn-pwd btn-block">
                          Simpan Password
                        </button>
                      </div>

                      <div class="w-50 p-2">
                        <button class=" btn btn-warning btn-pwd-back  btn-block">
                          Batal
                        </button>
                      </div>
                    </div>
                  </form>
                  <div class="row pt-2">
                    <?php
                    if ($this->session->flashdata('result_login')) {
                      echo '<label class="alert text-center alert-warning w-100  fs-15" id="error-login">' . $this->session->flashdata('result_login') . '</label>';
                    } ?>
                  </div>
                <?php } else { ?>
                  <form action="<?= base_url("login/validate") ?>" method="post" id="submit-form">
                    <div class="form-group">
                      <input name="uname" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukan username anda..." required value="">
                    </div>
                    <div class="form-group">
                      <input type="password" name="upwd" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required value="">
                    </div>
                    <div class="form-group p-1">
                      <div class="custom-control custom-checkbox small hide">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                <?php } ?>
              </div>
              <div class="container">
                <?php
                if (!$this->session->flashdata('updpass')) {
                  if ($this->session->flashdata('result_login')) {
                    echo '<label class="alert text-center alert-warning w100 fs-15" id="error-login">' . $this->session->flashdata('result_login') . '</label>';
                  }
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>