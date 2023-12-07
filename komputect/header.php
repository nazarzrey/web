<?php
require_once "config/config.db.php";
require_once "config/config.web.php";
$db = new Db();
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if gt IE 9]> <html lang="en" class="ie"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from htmlcoder.me/preview/idea/v.1.5/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Jul 2017 01:14:05 GMT -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="bogor elevator,chain hoist,dumbwaiter,dumbwaiter bogor,elevator,elevator bogor,foto lift barang,home lift,komputec,komputeclift,lift barang,lift barang murah,lift bogor,lift di bogor,lift makan,lift murah,lift penumpang,liftbarang,liftmakan,panel lift,panel lift penumpang,pasang lift di bogor,penangkal petir,rope hoist,Komputeclift" />
	<meta name="robots" content="index, follow">
	<meta name="description" content="Kontraktor Lift / Elevator / Eskalator Di Bogor Indonesia, Kami melayani penjualan dan service lift / elevator, eskalator, Panel Kontrol juga Maintenance lift serta penggantian suku cadang dan kelistrikannya" />

	<title>Komputeclift</title>
	<?php
	if (isset($_GET["product_name"]) || isset($_GET["project_name"])) {
		$whitelist = array('127.0.0.1', "::1");

		if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
			echo '<base href="https://komputeclift.com/">';
		} else {
			echo '<base href="http://localhost/project/komputec/">';
		}
	}
	?>

	<meta name="description" content="Koleksi Lift dan Elevator">
	<meta name="author" content="htmlcoder.html">

	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- Web Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Font Awesome CSS -->
	<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Fontello CSS -->
	<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

	<!-- Plugins -->
	<link href="plugins/rs-plugin/css/settings.css" media="screen" rel="stylesheet">
	<link href="plugins/rs-plugin/css/extralayers.css" media="screen" rel="stylesheet">
	<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
	<link href="css/animations.css" rel="stylesheet">
	<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

	<!-- iDea core CSS file -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/addstyle.css" rel="stylesheet">
	<link href="css/custom-style.css" rel="stylesheet">

	<!-- Style Switcher Styles (Remove these two lines) -->
	<link href="#" data-style="styles" rel="stylesheet">
	<link href="style-switcher/style-switcher.css" rel="stylesheet">

	<!-- Custom css -->
	<link href="css/custom.css" rel="stylesheet">
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134777881-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'UA-134777881-1');
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-6XY1JNQYJT"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-6XY1JNQYJT');
	</script>

	<style type="text/css">
		.fixed-header-on .header .site-slogan {
			display: block;
		}

		.btn-overlay {
			top: 150px;
			text-align: right;
			transition: all 0.7s;
			z-index: 123;
			position: absolute;
			right: 0;
		}

		.btn-overlay button {
			transition: all 0.7s;
			z-index: 1234;
			right: 0;
		}

		.btn-close {
			position: absolute;
			right: 10px;
			top: 10px;
			font-size: 16px;
			/*   border:solid 2px #fff */
		}

		.modal-content .modal-title {
			font-size: 20px;
			color: #ffffff;
		}

		.modal-title {
			margin: 0;

			/* line-height: 1.42857143; */
		}

		.modal-title a {
			color: #fff !important;
			font-size: 15px;
			width: 100%;
			float: left;
		}

		.mr10 {
			margin-right: 10px;
		}

		.mt10 {
			padding: 7px 0
		}

		.modal-body a {
			color: #000 !important
		}

		.modal-body a:hover {
			color: blue !important
		}

		.more-contact {
			padding: 0;
			/*     list-style-type: none; */
			float: none;
			width: 100%;
		}

		.more-contact .kontak_name {
			padding-left: 10px
		}

		.more-contact li {
			/*   border:solid 1px; */
			list-style: none;
			width: 32.3%;
			display: inline-block;
			text-align: center;
		}

		.more-contact .fa {
			color: green;
			font-size: 38px !important;
			padding-top: 20px;
		}

		.more-contact li div {
			font-size: 13px;
			position: absolute;
			width: 30%;
			display: none;
		}

		@media (max-width: 1024px) {

			.btn-overlay {
				margin: 0 !important;
				padding: 0 !important;
				opacity: 0.7;
			}

			.btn-overlay span {
				display: none;
			}

			.btn-overlay .btn {
				padding: 10px !important;
				min-width: auto;
			}

			.btn-overlay .btn.btn-lg {
				padding: 10px !important;
			}
		}
	</style>
</head>

<!-- body classes: 
			"boxed": boxed layout mode e.g. <body class="boxed">
			"pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> 
	-->

<body class="front no-trans">
	<!-- scrollToTop -->
	<!-- ================ -->
	<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

	<!-- page wrapper start -->
	<!-- ================ -->
	<div class="page-wrapper">

		<!-- header start classes:
				fixed: fixed navigation mode (sticky menu) e.g. <header class="header fixed clearfix">
				 dark: dark header version e.g. <header class="header dark clearfix">
			================ -->
		<header class="header fixed clearfix">
			<div class="container">
				<div class="row">
					<div class="company-info col-md-4">

						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">

							<!-- logo -->
							<div class="logo" style="float: left;">
								<a href=""><img id="logo" src="img/komput.png" alt="komputeclift"></a>
							</div>


							<!-- name-and-slogan -->
							<div class="site-info">
								<div class="site-slogan">
									<h2 class="no_mp"><b>Komputeclift</b></h2>
								</div>
								<div style="font-size: 12px;">
									Jl. Baru Pemda no. 21 Cibinong Bogor
									<br />
									0812-9698-5375 / 0817-6109-29
									<br />
									komputeclift@gmail.com
								</div>
							</div>

						</div>
						<!-- header-left end -->
						<div style="clear: both;"></div>
					</div>
					<div class="company-menu col-md-8">

						<!-- header-right start -->
						<!-- ================ -->
						<div class="header-right clearfix">

							<!-- main-navigation start -->
							<!-- ================ -->
							<div class="main-navigation animated">

								<!-- navbar start -->
								<!-- ================ -->
								<nav class="navbar navbar-default" role="navigation">
									<div class="container-fluid">

										<!-- Toggle get grouped for better mobile display -->
										<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										</div>

										<!-- Collect the nav links, forms, and other content for toggling -->
										<div class="collapse navbar-collapse" id="navbar-collapse-1">
											<ul class="nav navbar-nav navbar-right">
												<li>
													<a href="index.php">Home</a>
												</li>
												<li>
													<a href="product.php">Product</a>
												</li>
												<!-- mega-menu start -->
												<li>
													<a href="proyek.php">Proyek dan Servis</a>
												</li>
												<!-- mega-menu end -->
												<!-- mega-menu start -->
												<li>
													<a href="about.php">Tentang Kami</a>
												</li>
												<!-- mega-menu end -->
												<li>
													<a href="contact.php">Kontak Kami</a>
												</li>
											</ul>
										</div>

									</div>
								</nav>
								<!-- navbar end -->

							</div>
							<!-- main-navigation end -->

						</div>
						<!-- header-right end -->

					</div>
				</div>
			</div>
		</header>