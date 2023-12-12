    <!--  least.js gallery -->
    <section>
        <ul id="gallery">
            <li id="fullPreview"></li>
            <?php
            $dir    = './gallery/image/';
            $files1 = scandir($dir);
            // $files2 = scandir($dir, 1);
            foreach ($files1 as $key => $value) {
                if(strlen($value)>4){
                    if($value!="index.php"){
                        $img   = $dir.$value;
                        if(file_exists($thumb = $dir."thumb/thumb_".$value)){
                            $icon = $thumb;
                        }else{
                            $icon = $img;
                        }
                        ?>
                        <li>
                            <a href="<?= base_url($icon) ?>"></a>
                            <img data-original="<?= base_url($icon) ?>" src="<?= base_url($icon) ?>" alt="Photo 1" />

                            <div class="overLayer"></div>
                            <div class="infoLayer">
                                <ul>
                                    <li><h2>Photo 1</h2></li>
                                </ul>
                            </div>
                        </li>
                        <?php
                    }
                };
            }
            ?>


        </ul>
    </section>