<!DOCTYPE html>
<html>
<head>
  <title>Contoh Halaman Web</title>
</head>
<body>
  <h1>Halaman Web yang Dicetak</h1>
  <p>Ini adalah isi halaman web yang akan dicetak.</p>

  <script>
    function cetakHalaman() {
      window.print();
    }
  </script>

  <button onclick="cetakHalaman()">Cetak</button>
</body>
</html>


  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-3">
                  <div class="text-center">
                    <img src="<?= base_url("assets/images/logo-sdi.png") ?>" class="col-md-5" />
                    <h1 class="h4 text-gray-900 mb-1">Welcome to SIAK</h1>
                    <h5 class="h5 text-gray-900 mb-4">SDI Nurulkarimah</h5>
                  </div>
                  <!-- <form class="user"> -->
                    <form action="<?= base_url("login/validate") ?>" method="post" id="submit-form">
                    <div class="form-group">
                      <input name="uname" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="NIS Siswa" required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="upwd" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button  class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                </div>
                <div class="container">
                    <?php
                    if ($this->session->flashdata('result_login')) {
                        echo '<label class="alert text-center alert-warning w100 fs-15" id="error-login">' . $this->session->flashdata('result_login') . '</label>';
                    } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>