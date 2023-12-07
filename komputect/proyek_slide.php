								<?php
								$sintak = "
									SELECT b.url AS url_project,a.url,a.product_name,build_name,lokasi,kapasitas,
									IF(IFNULL(project_img,'')='',a.image_full,b.project_img) AS gambar 
									FROM product a RIGHT JOIN project b ON a.product_id=b.produk where aktif='1' order by upd_data desc";
								$query  = $db->select($sintak);
								$nom    = "1";
								foreach ($query as $result) {
									$img = "img/".$result["gambar"];
									if(file_exists($img)){
										$img = $img;
									}else{
										$img = "img/noimage.png";
									}
									if($nom=="1"){
										$aktif  = "active";
									}else{
										$aktif  = "";
									}
									?>
									    <div class="item <?php echo $aktif; ?>">
									      <div class="col-md-3 col-sm-6 col-xs-12 proyek_slide" >
									      	<a href="#">
									      		<!-- <img src="http://placehold.it/500/e499e4/fff&text=1" class="img-responsive"> -->
									      		<img src="<?php echo $img; ?>" alt="" class="img-responsive">
									      		<div>
													<h3 class="title"><?php echo $result["build_name"]; ?></h3>
													Alamat    : <?php echo $result["lokasi"]; ?><br>
													Jenis     : <?php echo $result["product_name"]; ?><br>
													Kapasitas : <?php echo $result["kapasitas"]; ?>	
												</div>
									      	</a>
									      </div>
									    </div>
									<?php
									$nom++;
								}
								?>