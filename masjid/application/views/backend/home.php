
            <section id="laporan-usulan" class="xhilang">
                <div id="data-href">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="container">
                                </div>
                                <!-- RECENT REPORT 2-->
                                <!-- <h4 style="margin-top: -10px;margin-bottom: 10px">Data Warga Kp Jeletreng</h4> -->
                                <div class="peta">
                                    <?php
                                    $soon = "soon";
                                    $file = APPPATH."/views/soon.php";
                                    require_once $file;
                                    ?>
                                    <div class="row hilang">
                                        <div class="col-lg-9 col-md-12">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                              <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                              </li>
                                              <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                              </li>
                                              <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                              </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p></div>
                                              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 laporan-calur">
                                            <div class="title m-b-10 p-2" style="background: #fefefe;border: solid 1px #f1f1f1"><nav class="navbar-sidebar2">
                                            <ul class="list-unstyled navbar__list">
                                                <li class="active">
                                                    <a href="<?= admin_url("rt") ?>">
                                                        <i class="fas fa-home"></i>Data Warga per RT</a>
                                                </li>
                                                <li>
                                                    <a href="<?= admin_url("rt") ?>">
                                                        <i class="fas fa-home"></i>Data Warga per Kelas</a>
                                                </li>
                                                <li class="has-sub hilang">
                                                    <a class="js-arrow" href="#">
                                                        <i class="fas fa-cog"></i>Seting
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-file-pdf-o"></i> Export</a>
                                                        <span class="inbox-num hilang">3</span>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-search"></i>Cari Data</a>
                                                        <span class="inbox-num hilang">3</span>
                                                </li>
                                            </ul>
                                        </nav>
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