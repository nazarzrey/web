    <div class="page-wrapper">
        <div class="">
            <div class="container">
                <div class="login-wrap" >
                    <div class="login-content" style="box-shadow: 0 0 10px #143218">
                        <div class="login-logo">
                            <div>
                                <h3 style="padding: 15px 0">Login Halaman Admin</h3>
                                <h6>Masjid Jami' Al-hidayah</h6>
                                <h6>Kp Jeletreng Rt 03 / 04 Desa Cogreg</h6>
                            </div>
                        </div>
                        <div class="login-form">
                            <form action="<?= base_url('login/validasi') ?>" method="post">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="username" autocomplete="off">
                                </div>
                                <div class="form-group pr">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" id="log-pass">                                    
                                    <div class="show-pass fa fa-eye"></div>
                                </div>
                                <br/>
                                <!-- <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button> -->
                                <button class="au-btn au-btn--block au-btn--blue m-b-20 text-center">Masuk</button>
                                <?php
                                if($this->session->flashdata('result_login')){
                                    echo '<label class="alert alert-warning w100" id="error-login">'.$this->session->flashdata('result_login').'</label>';
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
