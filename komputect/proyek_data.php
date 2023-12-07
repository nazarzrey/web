<?php
	if(isset($_GET["product_name"])){
		$url = $_GET["product_name"];
		$id  = get_data_project($url,"product_id","product");
		$qry = " where produk='$id' and aktif='1'";
	}else{
		$url = "";
		$id  = "";
		$qry = " WHERE aktif='1' ";
	}
?>
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">Data Proyek</h1>
							<div class="separator-2"></div>
							<!-- page-title end -->
							
							<!-- isotope filters start -->
							<?php if(!isset($_GET["product_name"])){?>
							<div class="filters project-menu">
								<ul class="nav nav-pills">
									<li class="active"><a href="#" data-filter="*">All</a></li>
									<?php
										$sintak = "SELECT a.url,COUNT(b.produk) AS ttl FROM product a LEFT JOIN project b
										ON a.product_id=b.produk GROUP BY b.produk HAVING(COUNT(b.produk)>0) ORDER BY COUNT(b.produk) DESC
										";
										$query = $db->select($sintak);
										foreach ($query as $result) {
											echo "<li><a href='#' data-filter='.".strtolower($result["url"])."'>".str_replace("-"," ",$result["url"])."</a></li>";
										}
									?>
								</ul>
							</div>
							<?php } ?>
							<!-- isotope filters end -->

							<!-- portfolio items start -->
							<div class="isotope-container row">
							<?php
								$sintak = "
									SELECT b.url AS url_project,a.url,a.product_name,build_name,lokasi,kapasitas,
									IF(IFNULL(project_img,'')='',a.image_full,b.project_img) AS gambar
									FROM product a RIGHT JOIN project b ON a.product_id=b.produk $qry order by upd_data desc";
								$query  = $db->select($sintak);
								foreach ($query as $result) {
									$img = "img/".$result["gambar"];
									if(file_exists($img)){
										$img = $img;
									}else{
										$img = "img/noimage.png";
									}
									?>
								  <a href="project/<?php echo $result["url_project"]; ?>.html">
									<div class="col-md-4 col-sm-6 isotope-item <?php echo $result["url"]; ?>">
										<div class="image-box">
											<div class="overlay-container">
											<img src="<?php echo $img; ?>" alt="komputeclift <?= strtolower($result['build_name']); ?>">
											<div class="overlay">
												<span>click for detail</span>
											</div>
										</div>
										<div class="image-box-body" style="color:#555 !important">
											<h3 class="title"><?php echo $result["build_name"]; ?></h3>
											Alamat    : <?php echo $result["lokasi"]; ?><br>
											Jenis     : <?php echo $result["product_name"]; ?><br>
											Kapasitas : <?php echo $result["kapasitas"]; ?>											
										</div>
									</div>
								  </a>
								</div>
									<?php
								}
							?>
						</div>
					</div>