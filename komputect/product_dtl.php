<?php include "header.php"; ?>
<?php
	$prd = "";
	$nama_prd = "";
	$img      = "";
	if(isset($_GET["product_name"])){
		$prd      = ucwords(str_replace("_"," ",$_GET["product_name"]));		
		$nama_prd = get_data_project(strtolower($_GET["product_name"]),"product_name","product");
		$img      = get_data_project($_GET["product_name"],"image_full","product");
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
							<h1 class="page-title"><?php echo ucwords($nama_prd);  ?></h1>
							<div class="separator-2"></div>
							<!-- page-title end -->

							<div class="row">
								<div class="col-md-6">
									<p><strong>Komputeclift</strong> bergerak dibidang pembuatan LIFT BARANG, DUMBWAITER,PASSANGER</p>
									<p>Dengan berkembangnya teknologi dan pesatnya pembangunan dan sangat diperlukannya efisiensi dalam bekerja terutama efisiensi waktu dalam bisnis anda, maka kami Komputeclift Hadir untuk menjawab solusi yang Bapak / Ibu hadapi, dengan menyediakan beberapa keunggulan yang akan berguna untuk kenyamanan dan keamanan bagi para customer.</p>
								</div>

								<!-- sidebar start -->
								<aside class="sidebar col-md-6">
									<div class="side vertical-divider-left">
										<div class="block clearfix">
											<img src="img/<?php echo $img; ?>" alt="">
										</div>
									</div>
								</aside>
								<!-- sidebar end -->
							</div>

						</div>
						<!-- main end -->
						<!-- project list by projduct name -->
						
						<?php
							require_once "proyek_data.php";
						?>

					</div>
				</div>
			</section>
			<!-- main-container end -->

			
<?php include "footer.php"; ?>