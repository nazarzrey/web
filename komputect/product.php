<?php include "header.php"; ?>
			<!-- header end -->

			<!-- banner start -->
			<!-- ================ -->
			<div class="banner">
				<div class="fixed-image section dark-translucent-bg parallax-bg-3">
					
				</div>
			</div>
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
							<h1 class="page-title">Product</h1>
							<div class="separator-2"></div>
							<!-- page-title end -->
							
							<!-- shop items start -->
							<div class="masonry-grid-fitrows row grid-space-20">

							<?php
								$sintak = "SELECT url,product_name,image_full FROM product ";
								$query  = $db->select($sintak);
								foreach ($query as $result) {
									$img = "img/".$result["image_full"];
									if(file_exists($img)){
										$img = $img;
									}else{
										$img = "img/noimage.png";
									}
									?>
								<div class="col-md-4 col-sm-6 col-xs-12 masonry-grid-item">
									<div class="listing-item">
										<div class="overlay-container">
											<img src="<?php echo $img; ?>" alt="Komputeclift <?php echo strtolower($result["product_name"]); ?> ">
											<a href="product/<?php echo $result["url"]; ?>.html" class="overlay small">
												<i class="fa fa-plus"></i>
												<span>View Details</span>
											</a>
										</div>
										<div class="listing-item-body clearfix">
											<h3 class="title text-center">
												<a href="product/<?php echo $result["url"]; ?>.html"><?php echo ucwords($result["product_name"]); ?></a>
											</h3>
										</div>
									</div>
								</div>
									<?php
								}
							?>
							</div>
							<!-- shop items end -->
							
							<div class="clearfix"></div>

							
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->

			<!-- footer start (Add "light" class to #footer in order to enable light footer) -->
			<!-- ================ -->
<?php include "footer.php"; ?>