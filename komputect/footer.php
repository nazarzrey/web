			<footer id="footer">

				<!-- .subfooter start -->
				<!-- ================ -->
				<div class="subfooter">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<p>Copyright © 2018 Komputeclift</p>
							</div>
							<div class="col-md-6">

							</div>
						</div>
					</div>
				</div>
				<!-- .subfooter end -->

			</footer>
			<!-- footer end -->

			</div>
			<!-- page-wrapper end -->

			<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
			<!-- Jquery and Bootstap core js files -->
			<script type="text/javascript" src="plugins/jquery.min.js"></script>
			<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

			<!-- Modernizr javascript -->
			<script type="text/javascript" src="plugins/modernizr.js"></script>

			<!-- jQuery REVOLUTION Slider  -->
			<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
			<script type="text/javascript" src="plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

			<!-- Isotope javascript -->
			<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

			<!-- Owl carousel javascript -->
			<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>

			<!-- Magnific Popup javascript -->
			<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

			<!-- Appear javascript -->
			<script type="text/javascript" src="plugins/jquery.appear.js"></script>

			<!-- Count To javascript -->
			<script type="text/javascript" src="plugins/jquery.countTo.js"></script>

			<!-- Parallax javascript -->
			<script src="plugins/jquery.parallax-1.1.3.js"></script>

			<!-- Contact form -->
			<script src="plugins/jquery.validate.js"></script>

			<!-- SmoothScroll javascript -->
			<script type="text/javascript" src="plugins/jquery.browser.js"></script>
			<script type="text/javascript" src="plugins/SmoothScroll.js"></script>

			<!-- Initialization of Plugins -->
			<script type="text/javascript" src="js/template.js"></script>
			<script type="text/javascript" src="js/jquery.scrollTo.js"></script>

			<!-- Custom Scripts -->
			<script type="text/javascript" src="js/custom.js"></script>
			<!-- WhatsHelp.io widget -->
			<!-- WhatsHelp.io widget -->
			<!-- <script type="text/javascript">
				(function() {
					var options = {
						whatsapp: "+62817610929", // WhatsApp number
						email: "komputeclift@gmail.com", // Email
						sms: "+62817610929", // Sms phone number
						call: "+62817610929", // Call phone number
						company_logo_url: "//static.whatshelp.io/img/flag.png", // URL of company logo (png, jpg, gif)
						greeting_message: "Hallo, Ada yang bisa Kami bantu !", // Text of greeting message
						call_to_action: "", // Call to action
						button_color: "#FF6550", // Color of button
						position: "right", // Position may be 'right' or 'left'
						order: "whatsapp,email,call,sms" // Order of buttons
					};
					var proto = document.location.protocol,
						host = "whatshelp.io",
						url = proto + "//static." + host;
					var s = document.createElement('script');
					s.type = 'text/javascript';
					s.async = true;
					s.src = url + '/widget-send-button/js/init.js';
					s.onload = function() {
						WhWidgetSendButton.init(host, proto, options);
					};
					var x = document.getElementsByTagName('script')[0];
					x.parentNode.insertBefore(s, x);
				})();
			</script> -->
			<!-- /WhatsHelp.io widget -->
			<div class="btn-overlay">
				<button class="btn btn-warning btn-xl rounded-0" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
					<i class="fa fa-arrow-left pe-3 py-3"></i><span> Hubungi Kami</span></button>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">

				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
					<div class="modal-content rounded-0">
						<div class="modal-header">
							<div>
								<p class="modal-title"><strong class="h5">Komputeclift</strong><br>
									Jl. Kol. Edy Yoso Martadipura No.21/52, Pakansari, Cibinong, Kabupaten Bogor, Jawa Barat 16915
									<a href="mailto:komputeclift@gmail.com"><i class="fa fa-envelope"></i>&nbsp;komputeclift@gmail.com</a>&nbsp;&nbsp;
									<a target="_blank" href="https://api.whatsapp.com/send?phone=+62817610929&amp;text=Halo, saya lihat website Komputec dan tertarik dengan liftnya. Boleh dibantu, lebih lanjut?"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;+6221 81296985375</a>
								</p>
							</div>
							<div>
							</div>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-8" id="peta">
									<div class="peta-data">
										<div id="googleMap_result" class="frm-peta" style="height: 460px;"><img alt="Maps CV Komputeclift" class="loaded" src="img/komputec_maps.png" data-was-processed=" true"></div>
									</div>
									<script>
										function myMap() {
											var bounds_result = new google.maps.LatLngBounds();
											var mapProp_result = {
												center: new google.maps.LatLng(-6.492431, 106.835013),
												zoom: 14,
											};
											var peta_result = new google.maps.Map(document.getElementById("googleMap_result"), mapProp_result);
											peta_result.setTilt(45);
											var markers_result = [
												['Komputeclift', -6.492431, 106.835013]
											];
											// Info Window Content
											var infoWindowContent_result = [
												['<div class="maps-info">' +
													'<b>Komputeclift</b><br/>' + '<b>Head Office </b><p>Jl. Kol. Edy Yoso Martadipura No.21/52, Pakansari, Cibinong, Kabupaten Bogor, Jawa Barat 16915</p>' +
													'<b>Kontak</b><p><a href="tel:+6281296985375">Telp &nbsp;&nbsp;: +62 81296985375</a><br/><a href="https://api.whatsapp.com/send?phone=+62817610929&text=Halo,%20saya%20lihat%20website%20Komputec%20dan%20tertarik%20dengan%20liftnya.%20Boleh%20dibantu,%20lebih%20lanjut?">Whatsapp : +62 817610929</a><br/><a href="mailto:komputeclift@gmail.com">Email : komputeclift@gmail.com</a>' +
													'<h6><a class="btn btn-warning btn-sm w-100 rounded-0" href="https://goo.gl/maps/QcX3LrymvTgP2QAu8">Navigasi ke Lokasi</a></h6>' +
													'</div>'
												]
											];

											// Display multiple markers on a map
											var infoWindow_result = new google.maps.InfoWindow();
											var marker_result, i;
											// Loop through our array of markers & place each one on the map
											for (i = 0; i < markers_result.length; i++) {
												var position_result = new google.maps.LatLng(markers_result[i][1], markers_result[i][2]);
												var iconFX_result = {
													url: markers_result[i][3],
													scaledSize: new google.maps.Size(40, 40), // scaled size
													origin: new google.maps.Point(0, 0), // origin
													anchor: new google.maps.Point(17, 65) // anchor
												};
												bounds_result.extend(position_result);
												marker_result = new google.maps.Marker({
													position: position_result,
													map: peta_result,
													animation: google.maps.Animation.DROP,
													title: markers_result[i][0],
													icon: iconFX_result
												});

												// Allow each marker to have an info window
												google.maps.event.addListener(marker_result, 'click', (function(marker_result, i) {
													return function() {
														infoWindow_result.setContent(infoWindowContent_result[i][0]);
														infoWindow_result.open(peta_result, marker_result);
													}
												})(marker_result, i));

												// Automatically center the map fitting all markers on the screen
												peta_result.fitBounds(bounds_result);
											}

											//Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
											var boundsListener_result = google.maps.event.addListener((peta_result), 'bounds_changed', function(event) {
												this.setZoom(19);
												google.maps.event.removeListener(boundsListener_result);
											});
										}
									</script>

									<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJC-ZNPMNPRkKl9BHRJEEtxoWWKEIcww8&callback=myMap" type="text/javascript"></script>
								</div>
								<div class="col-md-4" id="get-kontak">
									<div class="kontak-table">
										<table>
											<tbody>
												<tr>
													<td colspan="2" class="mt10"><b>Rahmat</b></td>
												</tr>
												<tr>
													<td><i class="fa fa-envelope mr10"></i></td>
													<td><a data-toggle="modal" data-target="#kontakDetail" data-name="Rahmat" data-phone="+62 81296895375" data-email="komputeclift@gmail.com">komputeclift@gmail.com</a></td>
												</tr>
												<tr>
													<td><a><i class="fa fa-whatsapp"></i></a></td>
													<td><a data-toggle="modal" data-target="#kontakDetail" data-name="Rahmat" data-phone="+62 817610929" data-email="komputeclift@gmail.com">+62 817610929</a></td>
												</tr>
												<tr>
													<td><a><i class="fa fa-whatsapp"></i></a></td>
													<td><a data-toggle="modal" data-target="#kontakDetail" data-name="Rahmat" data-phone="+62 81296895375" data-email="komputeclift@gmail.com">+62 81296895375</a></td>
												</tr>
												<tr>
													<td colspan="2" class="mt10"><b>M. Ridwan</b></td>
												</tr>
												<tr class="brbtl">
													<td><a><i class="fa fa-whatsapp"></i></a></td>
													<td><a data-toggle="modal" data-target="#kontakDetail" data-name="M. Ridwan" data-phone="+62 81287965989" data-email="komputeclift@gmail.com">+62 81287965989</a></td>
												</tr>
												<tr>
													<td colspan="2" class="mt10"><b>Dani</b></td>
												</tr>
												<tr class="brbtl">
													<td><a><i class="fa fa-whatsapp"></i></a></td>
													<td><a data-toggle="modal" data-target="#kontakDetail" data-name="Dani" data-phone="+62 81228009667" data-email="komputeclift@gmail.com">+62 81228009667</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="modal fade" id="kontakDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="kontakDetail" aria-hidden="true">

				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" style="padding-top:10%">
					<div class="modal-content rounded-0">
						<div class="modal-header" style='background: #ffc107;'>
							<div>
								<p class="modal-title"><strong class="h5">Komputeclift</strong><br>
									Jl. Kol. Edy Yoso Martadipura No.21/52, Pakansari, Cibinong, Kabupaten Bogor, Jawa Barat 16915
									<a href="mailto:komputeclift@gmail.com"><i class="fa fa-envelope"></i>&nbsp;komputeclift@gmail.com</a>&nbsp;&nbsp;
									<a target="_blank" href="https://api.whatsapp.com/send?phone=+62817610929&amp;text=Halo, saya lihat website Komputec dan tertarik dengan liftnya. Boleh dibantu, lebih lanjut?"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;+6221 81296985375</a>
								</p>
							</div>
							<div>
							</div>
							<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
						</div>
						<div class="modal-body">
							<div class="row more-contact">
								<div class="kontak_name">Untuk info lebih lanjut dengan <b>Syukron</b> marketing kami, silahkan klik pilihan di bawah</div>
								<ul>
									<li class="kontak_email">
										<a target="_blank">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<div>rahmat@gmail.com</div>
										</a>
									</li>
									<li class="kontak_wa">
										<a target="_blank">
											<i class="fa fa-whatsapp" aria-hidden="true"></i>
											<div>rahmat@gmail.com</div>
										</a>
									</li>
									<li class="kontak_tel">
										<a target="_blank">
											<i class="fa fa-phone" aria-hidden="true"></i>
											<div>0872154</div>
										</a>
									</li>
								</ul>

							</div>
						</div>
					</div>
				</div>
			</div>
			</body>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					window.addEventListener('scroll', function() {
						if (window.scrollY > 50) {
							// console.log(window);
							var tinggi = window.innerHeight;
							$(".btn-overlay").fadeIn();
							$(".btn-overlay").attr("style", "top:" + (window.scrollY + tinggi - (tinggi / 2)) + "px")
							// document.getElementById('navbar_top').classList.add('fixed-top');
							navbar_height = document.querySelector('.navbar').offsetHeight;
							document.body.style.paddingTop = navbar_height + 'px';
						} else {
							$(".btn-overlay").fadeOut();
							// document.getElementById('navbar_top').classList.remove('fixed-top');
							// remove padding top from body
							document.body.style.paddingTop = '0';
						}
					});
				});

				$(document).ready(function() {
					$('#kontakDetail').on('show.bs.modal', function(e) {
						//get data-id attribute of the clicked element
						var nama = $(e.relatedTarget).data('name');
						var email = $(e.relatedTarget).data('email');
						var telp = $(e.relatedTarget).data('phone');
						var wa = "https://api.whatsapp.com/send?phone=" + telp + "&text=Halo Pak " + nama + ", saya lihat website komputec dan tertarik dengan liftnya. Boleh dibantu, lebih lanjut?";
						$(".kontak_name b").text(nama);
						$(".kontak_email a").attr("href", "mailto:" + email);
						$(".kontak_email div").text(email);
						$(".kontak_tel a").attr("href", "tel:" + telp);
						$(".kontak_tel div").text(telp);
						$(".kontak_wa a").attr("href", wa);
						$(".kontak_wa div").text(telp);
					});
				})
			</script>

			<!-- Mirrored from htmlcoder.me/preview/idea/v.1.5/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Jul 2017 01:17:06 GMT -->

			</html>