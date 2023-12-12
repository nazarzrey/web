<?php 
	#$usulan = $this->Mod_query->find("where id_berkas='87'");
#	debug($peta);
	if($peta){
		if(kordinat($peta[0]->kordinat)=="1"){
?>

            <div class="peta-data" >
                <div id="googleMap_result" class="frm-peta" style="height: 97vh">akan segera tayang</div>
            </div>  
  			<script>
  				function myMap() {
  				 var bounds_result = new google.maps.LatLngBounds();
                            var mapProp_result = {
                                center:new google.maps.LatLng(<?= $peta[0]->kordinat ?>),
                                zoom:14,
                            };
                            var peta_result = new google.maps.Map(document.getElementById("googleMap_result"),mapProp_result);
                            peta_result.setTilt(45);                        
                            var markers_result = [
                            	<?= "['".$peta[0]->jalan."',".$peta[0]->kordinat.",'".jasal($peta[0]->jenis)."']" ?>

                            ];
                            // Info Window Content
                            var infoWindowContent_result = [
                                ['<div>'+'<h3 class="no_mp"><?= $peta[0]->jalan ?></h3>'+'<p>Kecamatan : <?= $peta[0]->nama_kecamatan ?><br/>Kelurahan : <?= $peta[0]->nama_kelurahan ?><br/>Lahan : <?= $peta[0]->lahan ?><br/>Konstruksi : <?= $peta[0]->konstruksi ?><br/>Tahun : <?= $peta[0]->tahun ?> <br/>Pelapor : <?= $peta[0]->pelapor ?><br/>Foto : <?= $peta[0]->foto ?></br>Nilai Pagu : <?= $peta[0]->pagu ?></br><a href="<?= base_url("admin/dtl/".$peta[0]->id_pengaduan) ?>"class="card-link" data-toggle="modal" >Lihat Detail</a></p>'+'</div>']];

                            // Display multiple markers on a map
                            var infoWindow_result = new google.maps.InfoWindow();
                            var marker_result, i;  
                            // Loop through our array of markers & place each one on the map
                            for (i = 0; i < markers_result.length; i++) {
                                var position_result = new google.maps.LatLng(markers_result[i][1], markers_result[i][2]);    
                                var iconFX_result = {
                                        url         : markers_result[i][3],
                                        scaledSize  : new google.maps.Size(25, 25), // scaled size
                                        origin      : new google.maps.Point(0,0), // origin
                                        anchor      : new google.maps.Point(10,15) // anchor
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
                                google.maps.event.addListener(marker_result, 'click', (function (marker_result, i) {
                                    return function () {
                                        infoWindow_result.setContent(infoWindowContent_result[i][0]);
                                        infoWindow_result.open(peta_result, marker_result);
                                    }
                                })(marker_result, i));

                                // Automatically center the map fitting all markers on the screen
                                peta_result.fitBounds(bounds_result);
                            }

                            //Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
                            var boundsListener_result = google.maps.event.addListener((peta_result), 'bounds_changed', function (event) {
                                this.setZoom(15);
                                google.maps.event.removeListener(boundsListener_result);
                            });
                        }
            </script> 
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJC-ZNPMNPRkKl9BHRJEEtxoWWKEIcww8&callback=myMap" type="text/javascript"></script> 
		<?php
		}else{
			echo "<h1>Sepertinya kordinat ini <u>".$peta[0]->kordinat."</u> untuk jalan <u>".$peta[0]->jalan."</u> tidak sesuai format";
		}
	}else{
		echo "<h1>data tidak ditemukan";
	}
	?>
