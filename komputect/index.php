<?php include "header.php"; ?>
<!-- header end -->

<!-- banner start -->
<!-- ================ -->
<div class="banner">

	<!-- slideshow start -->
	<!-- ================ -->
	<div class="slideshow">

		<!-- slider revolution start -->
		<!-- ================ -->
		<div class="slider-banner-container">
			<div class="slider-banner">
				<ul>

					<?php

					$sintak = " SELECT img_full as gambar FROM galery WHERE recid='BNR' AND aktif='Y' ORDER BY urut";
					$query  = $db->select($sintak);
					$nom    = "1";
					foreach ($query as $result) {
						$img = "img/banner/" . $result["gambar"];
						if (file_exists($img)) {
							$img = $img;
						} else {
							$img = "img/noimage.png";
						}
						if ($nom == "1") {
							$aktif  = "active";
						} else {
							$aktif  = "";
						}
					?>
						<!-- slide 1 start -->
						<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">
							<img src="<?= $img ?>" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

						</li>
					<?php
					} /*
					?>
					<!-- slide 1 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/elevator-427969_1920.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

					</li>
					<!-- slide 1 end -->
					<!-- slide 2 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/elevator-939515_1920.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">

					</li>
					<!-- slide 2 end -->

					<!-- slide 3 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/elevator-2540026_1920.jpg" alt="kenburns" data-bgposition="left center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="115" data-bgpositionend="right center">

					</li>
					<!-- slide 3 end -->
					<!-- slide 4 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/elevators-1756630_1920.jpg" alt="kenburns" data-bgposition="left center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="115" data-bgpositionend="right center">

					</li>
					<!-- slide 4 end -->
					<!-- slide 5 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/escalator-283448_1920.jpg" alt="kenburns" data-bgposition="left center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="115" data-bgpositionend="right center">

					</li>
					<!-- slide 5 end -->
					<!-- slide 6 start -->
					<li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Powerful Bootstrap Theme">

						<!-- main image -->
						<img src="img/escalator-2471204_1920.jpg" alt="kenburns" data-bgposition="left center" data-kenburns="on" data-duration="10000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="115" data-bgpositionend="right center">

					</li>
					<!-- slide 6 end -->
					*/
					?>

				</ul>
				<div class="tp-bannertimer tp-bottom"></div>
			</div>
		</div>
		<!-- slider revolution end -->

	</div>
	<!-- slideshow end -->

</div>
<!-- banner end -->

<!-- page-top start-->
<!-- ================ -->
<div class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="call-to-action">
					<h1 class="title">Komputeclift</h1>
					<p>
						Bergerak dibidang pembuatan LIFT BARANG, DUMBWAITER,PASSANGER<br /><br />

						Dengan berkembangnya teknologi dan pesatnya pembangunan dan sangat diperlukannya efisiensi dalam bekerja terutama efisiensi waktu dalam bisnis anda, maka kami Komputeclift Hadir untuk menjawab solusi yang Bapak / Ibu hadapi, dengan menyediakan beberapa keunggulan yang akan berguna untuk kenyamanan dan keamanan bagi para customer.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- page-top end -->

<!-- main-container start -->
<!-- ================ -->
<section class="main-container gray-bg">

	<!-- main start -->
	<!-- ================ -->
	<div class="main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center title">Keunggulan</h1>
					<div class="separator"></div>
					<div class="row">
						<div class="col-sm-4">
							<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="0">
								<i class="fa fa-arrows"></i>
								<h2>Flexible</h2>
								<p>Ukuran LIFT bisa disesuaikan</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">
								<i class="fa fa-sign-in"></i>
								<h2>By Request</h2>
								<p>Interior sesuai permintaan</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="400">
								<i class="fa fa-check-square"></i>
								<h2>Others</h2>
								<p>Arrival Buzzer, Gong dan Sound</p>
							</div>
						</div>
						<div class="col-sm-2"></div>
						<div class="col-sm-4">
							<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="200">
								<i class="fa fa-money"></i>
								<h2>Harga Ekonomis</h2>
								<p>Harga murah dan pastinya berkwalitas</p>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="400">
								<i class="fa fa-wrench"></i>
								<h2>Service</h2>
								<p>Layanan Service selamanya</p>
							</div>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<br />
			<br />
			<h1 class="text-center title">Proyek dan service</h1>
			<div class="separator"></div>
			<div class="row">
				<div class="col-sm-12">
					<div class="box-style-1 white-bg object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="0">
						<div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
							<div class="carousel-inner">
								<?php
								include("proyek_slide.php");
								?>
							</div>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main-container end -->

<?php include "footer.php"; ?>