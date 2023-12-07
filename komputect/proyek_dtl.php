<?php include "header.php"; ?>
<?php
	$prd = "";
	$id_project = "";
	if(isset($_GET["project_name"])){
		$prd = ucwords(str_replace("-"," ",str_replace("_"," ",$_GET["project_name"])));
 		$id_project = get_data_project(strtolower($_GET["project_name"]),"project_id","project");
	}

?>
			<!-- header end -->

			<!-- banner start -->
			<!-- ================ -->
			<!-- <div class="banner">
				<div class="fixed-image section dark-translucent-bg" style="background-image:url('img/elevator-2540026_1920.jpg');">					
				</div>
			</div> -->
			<!-- banner end -->

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">
				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">Project <?php echo $prd;  ?></h1>
							<div class="separator-2"></div>
							<!-- page-title end -->

							<div class="row">
								<div class="col-md-6">
									<p><strong>Komputeclift</strong> bergerak dibidang pembuatan LIFT BARANG, DUMBWAITER,PASSANGER</p>
									<p style="display: none">
										detail proyek <?php echo $prd;  ?>
									</p>
								</div>

								<!-- sidebar start -->
								<aside class="sidebar col-md-6">
									<div class="side vertical-divider-left">
										<div class="block clearfix">
											<img src="img/Elevator Passenger.jpg" alt="">
										</div>
									</div>
								</aside>
								<!-- sidebar end -->
							</div>

						</div>
						<!-- main end -->
						<!-- project list by projduct name -->

						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">Gallery proyek <?php echo $prd;  ?></h1>
							<div class="separator-2"></div>
							
							<!-- isotope filters start -->
							<!-- isotope filters end -->

							<!-- portfolio items start -->
							<div class="isotope-container row">
								<!-- gallery start -->
								<?php
									$sintak = "select big_img from project_gallery where project_id='$id_project'";
									$query  = $db->select($sintak);
									foreach ($query as $result) {
										$img = "img/project/".$result["big_img"];
										if(file_exists($img)){
											$img = $img;
										?>
										<div class="col-md-4 col-sm-6 isotope-item dumbwaiter">
											<div class="image-box">
												<div class="overlay-container">
													<img src="<?php echo $img; ?>" alt="komputeclift proyek <?= strtolower($result['build_name']); ?>">
													<div class="overlay">
														<div class="overlay-links">													
															<a href="<?php echo $img; ?>" class="popup-img">
																<i class="fa fa-search-plus"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
										}else{
											$img = "img/noimage.png";
										}
									}
								?>
								<!-- gallery end-->
							</div>
							<!-- portfolio items end -->
							
						</div>

					</div>
				</div>
			</section>
			<!-- main-container end -->

			
<?php include "footer.php"; ?>