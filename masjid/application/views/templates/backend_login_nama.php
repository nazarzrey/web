    <div class="page-wrapper">
        <div class="">
            <div class="container">
                <div class="login-wrap" >
                    <div class="login-content" style="box-shadow: 0 0 15px #ccc">
                        <div class="login-logo">
                            <div class="alert alert-success"><h4 style="line-height: 28px">Masjid <br/>Jami' Al-hidayah</h4></div>
                            <span>Silahkan masukan <b>PIN</b> <br/>untuk nama KK <b class="text-primary"><?php echo strtoupper(str_replace("-"," ",$warga[0])) ?></b><br/>yang tertera di kartu INFAQ</span>
                        </div>
                        <div class="login-form">
                            <form action="<?= base_url('login/validate2') ?>" method="post">
                                <div class="form-group hide">
                                    <label>NAMA KK</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="username" autocomplete="off" value="<?php echo $warga[0] ?>">
                                </div>
                                <div class="form-group pr">
                                    <label>PIN</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" id="log-pass">                                    
                                    <div class="show-pass fa fa-eye"></div>
                                </div>
                                <br/>
                                <!-- <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button> -->
                                <button class="au-btn au-btn--block au-btn--green m-b-20 text-center">Masuk</button>
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
