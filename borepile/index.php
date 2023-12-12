<?php
$path_img_default     = "gambar/";
$path_img           = "galeri/";
$page                 = "page";
$get_page             = "?" . $page;
$tgl_jam            = date("Y-m-d H:i:s");
$ipnya                   = getenv("REMOTE_ADDR");

require_once "seting/config_db.php";
require_once "seting/config_web.php";
require_once "seting/function_web.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$db = new Db();

function ready_profile($field)
{
    $db       = new Db();
    $sql       = "select deskripsi from profile_web where jenis='$field'";
    $cek_data = $db->select($sql);
    return $hsl_data = $cek_data[0]['deskripsi'];
}
$no_wa = "+62".str_replace("08","8",ready_profile('wa'));
function contact_dtl($tipe){
    global $no_wa;
    $Redirected = "hubungi";
    $table         = "content_other";
    $column        = "content_dtl";
    $get_id     = "id_content";
    $get_fk_id     = "contact_us";
    $get_content = select_data_func($table, $column, $get_id, $get_fk_id, $Redirected);
    $target = "target='_blank' href='https://api.whatsapp.com/send?phone=".$no_wa."&amp;text=Halo, saya lihat website kontraktorborepile.com dan tertarik kerjasamanya. Boleh dibantu, lebih lanjut?' style='color:#fff !important;font-size:16px' style='font-size:24px;position:relative;top:3px'";
    echo "
    <div style='padding:15px'>
        <div>".$get_content."</div>
        <div class='btn btn-success'>
            <a id='wa_click' attr='".$tipe."' ".$target." ><i class='fa fa-whatsapp'> </i> &nbsp;".ready_profile('wa')."</a>
        </div>
    </div>";
    //
}
function keywords(){
    global $db;
    $sintak = "SELECT deskripsi,deskripsi as desc2 FROM master_grup WHERE grup='produk' UNION  SELECT deskripsi,deskripsi as desc2  FROM key_tags ";
    $cek_tags = $db->select($sintak);
    //dbg($cek_tags);
    foreach ($cek_tags as $keys => $hsl_cek_tags) {
        echo ucwords($cek_tags[$keys]["desc2"]) . ", ";
    }
}
?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="<?= keywords() ?>" />
    <meta name="robots" content="index, follow">
    <meta name="description" content="Kontraktor Bore pile, Strauss pile, Tiang Pancang, Pemborong Bangunan, Pondasi Bore Pile dan Strauss Pile sangat diperlukan agar bangunan lebih kokoh, Tentunya  Jenis Pondasi  seperti Pancang (Hammer), dan Jacking pile tidak bisa digunakan karena kondisi lapangan Lahan yang sempit, Disekitar banyak bangunan yang sudah jadi Maka Solusinya ya dengan BORE PILE dan STRAUSSPILE" />

    <base href="">

    <link href="gaya/dialog.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="gaya/default.css?v4" rel="stylesheet" type="text/css">
    <link href="gaya/menu.css?v4" rel="stylesheet" type="text/css">
    <link href="gaya/slides.css?v4" rel="stylesheet" type="text/css">
    <link href="gaya/content.css?v4" rel="stylesheet" type="text/css">
    <link href="gaya/modal.css" rel="stylesheet" type="text/css">
    <link href="gaya/btn-overlay.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="gambar/ico.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Lato|Roboto|Nunito:wght@300;400;700;900&display=swap" rel="stylesheet">
    
	<!-- Bootstrap core CSS -->
	<link href="gaya/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Font Awesome CSS -->
    <link href="gaya/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

    <script type="text/javascript" src="skrip/dialog.js"></script>
    <script type="text/javascript" src="skrip/jquery.min.js"></script>
    <script type="text/javascript" src="skrip/jquery-ui.min.js"></script>
    <script type="text/javascript" src="skrip/slides.min.jquery.js"></script>
    <script type="text/javascript" src="skrip/ddaccordion.js?v4"></script>
    <script type="text/javascript" src="skrip/jssor.js"></script>
    <script type="text/javascript" src="skrip/jssor.slider.js"></script>
    <script type="text/javascript" src="skrip/autosize.min.js"></script>
    <script type="text/javascript" src="skrip/content.js?v4"></script>
    <script type="text/javascript">
        

        $(document).on("click","#wa_click",function() {
            $id = $(this).attr("attr")            
            $.post("ajax/ajax_post.php?p05T",
            {
                ipaddr:"<?= $ipnya ?>",
                content: $id,
                path:window.location.href,
                media:screen.width+"x"+screen.height
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
            });

        })
        $(function() {
            autosize(document.querySelectorAll('textarea'));
            $('#menu').click(function() {
                var ada = $('#menu_mobile_hdr').is(':hover');
                if (ada == false) {
                    $("#menu_mobile_hdr").hide("slide", {
                        direction: "left"
                    }, "fast");
                    $('#menu').fadeOut();
                }
            });
            $("#menu_mobile").click(function() {
                $("#menu").fadeIn();
                $("#menu_mobile_hdr").show("slide", {
                    direction: "left"
                }, "fast");
            });
            $("#closed").click(function() {
                $("#menu_mobile_hdr").hide("slide", {
                    direction: "left"
                }, "fast");
                $('#menu').fadeOut();
            });
            var w_screen = window.innerWidth;
            var tinggi = document.documentElement.scrollHeight;
            if (w_screen <= 1000) {
                $("#menu").css('height', tinggi + 'px');
                $("#menu_mobile_hdr ul li ").click(function(e) {
                    if ($(this).has('ul')) {
                        $('.xdropdown').removeClass('.xdropdown').hide();
                    }
                    $(this).find('ul').addClass('.xdropdown').show();
                })
            }
            $("#refresh").click(function() {
                var request_uri = location.pathname + location.search;
                window.location.href = request_uri;
            })
            $("#tabs").tabs();
            $("#tabs_thn").tabs();
            $("#tabs_bln").tabs();
            var h_screen = window.innerHeight;
            var scr_width = screen.width;
            var scr_height = screen.height;
            //alert(scr_width+" "+scr_height);	
            visitor_cek(scr_width, scr_height);
            /*slide*/

            // Set starting slide to 1
            var startSlide = 1;
            // Get slide number if it exists
            if (window.location.hash) {
                startSlide = window.location.hash.replace('#', '');
            }
            // Initialize Slides
            $('#slides').slides({
                preload: true,
                preloadImage: 'img/loading.gif',
                generatePagination: true,
                play: 5000,
                pause: 2500,
                hoverPause: true,
                // Get the starting slide
                start: startSlide,
                animationComplete: function(current) {
                    // Set the slide number as a hash
                    window.location.hash = '#' + current;
                }
            });
        })
        $(window).resize(function() {
            var w_screen = window.innerWidth;
            var tinggi = document.documentElement.scrollHeight;
            if (w_screen > 1000) {
                $("#menu").css('height', 'auto');
                $("#menu_mobile_hdr").show();
                $('#menu').show();
                /*admin*/
            } else {
                $("#menu").css('height', tinggi + 'px');
                $("#menu_mobile_hdr ul li ").click(function(e) {
                    if ($(this).has('ul')) {
                        $('.xdropdown').removeClass('.xdropdown').hide();
                    }
                    $(this).find('ul').addClass('.xdropdown').show();
                })
            }
        })
    </script>
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92587649-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-92587649-1');
    </script> -->
    <?php
    if (isset($_GET["label"])) {
        $title = ucwords(str_replace("-", " ", $_GET["label"]));
        echo "<title>$title - CV.MITRA PONDASI, Kontraktor Bored Pile, Bore pile, straus pile</title>";
    } else {
        echo "<title>CV.MITRA PONDASI, Kontraktor Bored Pile, Bore pile, straus pile</title>";
    }

    ?>
    <style>
        .galcolumn {
            /* -ms-flex: 50%; */
            /* IE 10 */
            flex: 24%;
            padding: 0 4px;
        }

        .galcolumn img {
            margin-top: 8px;
            vertical-align: middle;
        }

        html,
        body,
        body a {
            font-family: "Lato", "tahoma" !important;
        }
    </style>
</head>

<!-- <body onload="buatjam()"> -->

<body>
    <div id="container">
        <div style="background:#006ab4;height:5px;box-shadow:1px 1px 5px #ccc;">
        </div>
        <div id="header">
            <div id="logo">
                <?php
                if (strlen(ready_profile("icon") < 5) and !file_exists($path_img_default . ready_profile("icon"))) {
                    $profile_menu = "style='margin-left:0;'";
                } else {
                    $profile_menu = "";
                    echo '<div id="profile_img" ><img src="' . $path_img_default . ready_profile("icon") . '"  class="logo_img desktop"></div>';
                }
                ?>
                <div id="profile_text" <?= $profile_menu; ?>>
                    <div class="tridi">
                        <b><?= ready_profile("profile1"); ?></b><br />
                        <?= ready_profile("profile2"); ?><br />
                        <?= ready_profile("profile3"); ?><br />
                        <?= ready_profile("profile4"); ?>
                    </div>
                </div>
            </div>
            <div id="profile_menu">
                <ul>
                    <li><a href="news">News</a></li>
                    <!--<li><a href="contact">About</a></li> -->
                    <li><a href="kontak" class="active">Kontak</a></li>
                </ul>
            </div>
            <div class="menu_mobile">
                <img src="gambar/menu.png" height="35px" id="menu_mobile" style="position:absolute;right:5px;top:5px;cursor:pointer;">
            </div>
        </div>
        <div id="menu">
            <div id="menu_mobile_hdr">
                <span class="closed1" id="closed">X</span>
                <ul>
                    <li class="li_add">&nbsp;</li>
                    <li class="menu_mbl">
                        <a><img src="<?= $path_img_default . ready_profile("icon"); ?>" width="37px;" height="48px" style="float:left;">
                            <div style="margin:-2px 0px -3px 40px;font-weight:bold;font-size:12px;">
                                <?= ready_profile("profile1"); ?><br />
                                <?= ready_profile("profile3"); ?>
                            </div>
                        </a>
                    </li>
                    <li><a href="home">Beranda</a></li>
                    <li><a href="#">Produk</a>
                        <ul class="xdropdown">
                            <?php
                            $cek_grup = $db->select("select url_grup,deskripsi from master_grup where grup='produk' and aktif in ('Y','X') order by id_grup");
                            foreach ($cek_grup as $hsl_cek_grup) {
                                echo '<li><a href="' . 'produk/' . $hsl_cek_grup['url_grup'] . '.html">' . ucwords($hsl_cek_grup['deskripsi']) . '</a></li>';
                            }
                            ?>
                            <li><a href="produk">Semua Produk</a></li>
                        </ul>
                    </li>
                    <li style="border:none;"><a href="#">Proyek</a>
                        <ul class="xdropdown">
                            <?php
                            $cek_grup = $db->select("select url_grup,deskripsi from master_grup where grup='building' and aktif in ('Y','X') AND id_grup IN (
                                                                SELECT id_fk_proy FROM proyek WHERE aktif='Y'
                                                                ) order by id_grup");
                            foreach ($cek_grup as $hsl_cek_grup) {
                                echo '<li><a href="' . 'proyek/g/' . $hsl_cek_grup['url_grup'] . '.html">' . ucwords($hsl_cek_grup['deskripsi']) . '</a></li>';
                            }
                            ?>
                            <li><a href="proyek">Semua proyek</a></li>
                        </ul>
                    </li>
                    <li><a href="galery_image">Galeri</a>
                        <!-- <ul class="xdropdown">
                                                        <li><a href="galery_image">Galeri Foto</a></li>
                                                        <li><a href="galery_video">Galeri Video</a></li>
                                                </ul> -->
                    </li>
                    <li><a href="workshop">Workshop</a></li>
                    <li><a href="about">Tentang Kami</a></li>
                    <div class="menu_mobile">
                        <li><a href="news">News</a></li>
                        <li><a href="kontak">Kontak</a></li>
                        <? /* <li><a href="admin_page" class="active" >Login</a></li>  */ ?>
                    </div>
                </ul>
            </div>
        </div>
        <div id="content">
            <?php
            /***panggil kontennya*/
            require_once "panggil_content.php";
            /***/
            #echo $page_content;
            if (isset($page_content)) {
                if ($page_content == "home") {
            ?>
                    <div id="content_slide2">
                        <div class="content_slide2_dtl">
                            <?php require_once "halaman/slides_bot.php"; ?>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div id="content_slide2">
                    <div class="content_slide2_dtl">
                        <?php require_once "halaman/slides_bot.php"; ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <div id="content_dtl" style="">
                <div class="content_dtl">
                    <div id="menu_accordion">
                        <div class="arrowlist">
                            <div class="arrow_menu">Hubungi </div>
                            <div class="menu_arrow_dtl" style="height:auto;margin:0;padding:0">
                                <div id="tabs-1" class="menu_arrow_content">
                                    <?= contact_dtl("contact_home") ?>
                                </div>
                            </div>
                            <div class="arrow_menu">Proyek</div>
                            <div class="menu_arrow_dtl" style="height:auto;margin:0;padding:0">
                                <div id="tabs-1" class="menu_arrow_content">
                                    <ul>
                                        <?php
                                        $Redirected = "proyek/";
                                        $cek_favorit = "select url_dtl,nama_proyek,id_dtl_img from view_proyek_favorit limit 7";
                                        if ($query_data = $db->select($cek_favorit)) {
                                            foreach ($query_data as $hsl_data) {
                                                $data_gambar = $hsl_data['id_dtl_img'];
                                                if (file_exists($path_img . $data_gambar) and strlen($data_gambar) != 0) {
                                                    $data_gambar = $path_img . $data_gambar;
                                                } else {
                                                    $data_gambar = $path_img_default . "no_image.jpg";
                                                }
                                                echo "<a href='" . $Redirected . $hsl_data['url_dtl'] . ".html'>
                                                                                                                <li>
                                                                                                                        <div  style='width:80%;float:left;height:50px'>" . trim($hsl_data['nama_proyek']) . "</div>
                                                                                                                        <div style='height:50px'><img data-src='$data_gambar' style='height:50px;width:50px;float:right' /></div>
                                                                                                                </li>
                                                                                                          </a>";
                                            }
                                        } else {
                                            log_error($tgl_jam, $Redirected, $cek_favorit);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="arrow_menu">Info</div>
                            <div class="menu_arrow_dtl" style="height:auto;margin:0;padding:0">
                                <div id="tabs-1" class="menu_arrow_content">
                                    <ul>
                                        <?php
                                        $Redirected = "news/";
                                        $cek_favorit = "select id_judul,judul,img_content from content_dtl where aktif='Y' and utama='Y' order by upd_rec limit 5";
                                        if ($query_data = $db->select($cek_favorit)) {
                                            foreach ($query_data  as $hsl_data) {
                                                $data_gambar = $hsl_data['img_content'];
                                                if (file_exists($path_img . $data_gambar) and strlen($data_gambar) != 0) {
                                                    $data_gambar = $path_img . $data_gambar;
                                                } else {
                                                    $data_gambar = $path_img_default . "no_image.jpg";
                                                }

                                                echo "<a href='$Redirected$hsl_data[id_judul].html'>
                                                                                                                <li>
                                                                                                                        <div  style='width:80%;float:left;height:50px'>" . ucwords(strtolower(trim($hsl_data['judul']))) . "</div>
                                                                                                                        <div style='height:50px'><img data-src='$data_gambar' style='height:50px;width:50px;float:right' /></div>
                                                                                                                </li>
                                                                                                          </a>";
                                            }
                                        } else {
                                            log_error($tgl_jam, $Redirected, $cek_favorit);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!--
                                                <div class="arrow_menu">Galery</div>
                                                        <div class="menu_arrow_dtl" style="height:250px;margin:0;padding:0">
                                                                <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/jalan_depok" data-widget-id="735682090885226497">Tweet oleh @jalan_depok</a>
                                                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                                        </div>
                                                        -->
                            <div class="arrow_menu">Visitor</div>
                            <div class="menu_arrow_dtl" style="height:auto;margin:0;padding:0;overflow:hidden;">
                                <a href="#">
                                    <!-- <img src="http://s11.flagcounter.com/count2/pLet/bg_FFFFFF/txt_000000/border_FFFFFF/columns_4/maxflags_20/viewers_Pengunjung/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"> -->
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (!isset($_GET["page"]) || $_GET["page"] == "home" || $_GET["page"] == "") {
                        require_once "halaman/introduce.php";
                    }
                    ?>
                    <div class="isi_content">
                        <?php
                        if (isset($_GET["page"])) {
                            if ($_GET["page"] != "home" and $_GET["page"] != "") {
                                /*
                                                ?>
                                                                <div class="content_dtl_info xx">
                                                                        <?= $calling_content_info; ?>
                                                                </div>
                                                <?php
                                                */
                            }
                        }
                        ?>
                        <?php require_once $calling_content; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer" style="">
            <div style="width:auto;background:#f1f1f1;">
                <div id="tags">
                    <div class="tags">
                        <b style="color:#555">tags :</b><br />
                        <?php
                        $sintak = "SELECT deskripsi,deskripsi as desc2 FROM master_grup WHERE grup='produk' UNION  SELECT deskripsi,deskripsi as desc2  FROM key_tags ";
                        $cek_tags = $db->select($sintak);
                        foreach ($cek_tags as $hsl_cek_tags) {
                            echo '<a href="' . 'search/' . str_replace(" ", "-", $hsl_cek_tags['deskripsi']) . '.html">' . ucwords($hsl_cek_tags['desc2']) . '</a>, ';
                        }
                        ?>
                        <div style="display:none">
                            <?php

                            $sintak = "SELECT CONCAT(b.deskripsi,'-',a.deskripsi,'-',c.deskripsi) as deskripsi,CONCAT(b.deskripsi,' ',a.deskripsi,' ',c.deskripsi)  as desc2 FROM key_tags a, key_front b, key_region c ORDER BY a.urut";
                            if (isset($_GET["page"])) {
                                if ($_GET["page"] == "home" or strlen($_GET["page"]) == 0) {
                                    $cek_tags = $db->select($sintak);
                                    // foreach ($cek_tags as $hsl_cek_tags) {
                                    //     echo '
                                    //                                             <a href="search/' . str_replace(" ", "-", $hsl_cek_tags['deskripsi']) . '.html">' . ucwords($hsl_cek_tags['desc2']) . '</a>, ';
                                    // }
                                }
                            } else {
                                $cek_tags = $db->select($sintak);
                                // foreach ($cek_tags as $hsl_cek_tags) {
                                //     echo '
                                //                                         <a href="search/' . str_replace(" ", "-", $hsl_cek_tags['deskripsi']) . '.html">' . ucwords($hsl_cek_tags['desc2']) . '</a>, ';
                                // }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="footer_dtl">
                    <h3 style="margin:0;padding:0;margin-bottom:10px;">Pengunjung</h3>
                    <?php
                    require_once "counter.php";
                    ?>
                </div>
                <div class="footer_dtl">
                    <h3 style="margin:0;padding:0;margin-bottom:10px;">Info Favorit</h3>
                    <?php
                    $Redirected = "news/";
                    $cek_favorit = "select id_judul,judul from view_favorit limit 10";
                    if ($db->select($cek_favorit)) {
                        $query_data = $db->select($cek_favorit);
                        foreach ($query_data as $hsl_data) {
                            echo "<div class='news_footer' ><a href='$Redirected$hsl_data[id_judul].html'>" . ucwords(strtolower(paragrap($hsl_data['judul'], 5))) . "</a></div>";
                        }
                    } else {
                        log_error($tgl_jam, $Redirected, $cek_favorit);
                    }
                    ?>
                </div>
                <div class="footer_dtl">
                    <h3 style="margin:0;padding:0;margin-bottom:10px;">Kontak</h3>
                    <table>
                        <tr>
                            <td valign="top"><b>Alamat</b></td>
                            <td>
                                <?php
                                echo ready_profile("address");
                                ?>
                            </td>
                        </tr>
                        <?php
                        $hal = "index";
                        require_once "halaman/kontak.php";
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="footer" style="background:#29343e;width:100%;float:left;">
            <div class="copyright">copyright @ 2021</div>
            <div id="me_visit hide"></div>
        </div>
    </div>
    <div class="btn-overlay">
        <button class="btn btn-warning btn-xl rounded-0" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        <i class="fa fa-phone-square pe-3 py-3" style="margin:0 10px 0 5px;font-size:30px"></i><span style="position:relative;top: -3px;"> Hubungi Kami</span></button>
    </div>

			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">

				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
					<div class="modal-content rounded-0">
						<div class="modal-header bg-primary">
							<div>
								<p class="modal-title"><strong class="h3"><?= ready_profile("profile1"); ?></strong><br>
                                <?= ready_profile("profile3"); ?>
									<a href="tel:<?= str_replace("telp","",strtolower(ready_profile("profile4"))); ?>"><i class="fa fa-phone"></i>&nbsp;<?= str_replace("telp","",strtolower(ready_profile("profile4"))); ?></a>&nbsp;&nbsp;
									<a  id='wa_click' attr='header' target="_blank" href="https://api.whatsapp.com/send?phone=<?= $no_wa; ?>&amp;text=Halo, saya lihat website kontraktorborepile.com dan tertarik kerjasamanya. Boleh dibantu, lebih lanjut?"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;<?= ready_profile("wa"); ?></a>
								</p>
							</div>
							<div>
							</div>
							<button type="button" class="btn-close bg-primary" data-dismiss="modal" aria-label="Close">X</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-8" id="peta">
									<div class="peta-data">
										<div id="googleMap_result" class="frm-peta" style="height: 460px;"><img alt="Maps CV Kontraktor bore pile" class="loaded" src="" data-was-processed=" true"></div>
									</div>
									<script>
										function myMap() {
											var bounds_result = new google.maps.LatLngBounds();
											var mapProp_result = {
												center: new google.maps.LatLng(-6.958053, 110.582653),
												zoom: 14,
											};
											var peta_result = new google.maps.Map(document.getElementById("googleMap_result"), mapProp_result);
											peta_result.setTilt(45);
											var markers_result = [
												['Kontraktorborepile',-6.958053, 110.582653]
                                                
											];
											// Info Window Content
											var infoWindowContent_result = [
												['<div class="maps-info">' +
													'<b><?= ucfirst(strtolower(ready_profile("profile1"))); ?></b><br/>' + '<p><?= ready_profile("profile3");?></p>' +
													'<b>Kontak</b><p><a href="tel:<?= str_replace("telp","",strtolower(ready_profile("profile4"))); ?>">Telp &nbsp;&nbsp;: <?= str_replace("telp","",strtolower(ready_profile("profile4"))); ?></a><br/><a   id="wa_click" attr="maps" href="https://api.whatsapp.com/send?phone=<?= $no_wa; ?>&text=Halo,%20saya%20lihat%20website%20Kontraktorborepile%20dan%20tertarik%20dengan%20kerjasamanya%20Boleh%20dibantu,%20lebih%20lanjut?">Whatsapp : <?= $no_wa; ?></a><br/>' +
													'<h6><a class="btn btn-warning btn-sm w-100 rounded-0" href="https://maps.app.goo.gl/e3PPjZYsQv5jc2bu7">Navigasi ke Lokasi</a></h6>' +
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
                                        <?= contact_dtl("contact_maps") ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


    <script type="text/javascript" src="gaya/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="skrip/lazyload.js"></script>
    <script type="text/javascript">
        new LazyLoad();
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    // console.log(window);
                    var tinggi = window.innerHeight;
                    $(".btn-overlay").fadeIn();
                    $(".btn-overlay").attr("style", "top:" + (window.scrollY + tinggi - (tinggi / 2)) + "px")
                    // document.getElementById('navbar_top').classList.add('fixed-top');
                    navbar_height = "50";
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    $(".btn-overlay").fadeOut();
                    // document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
    </script>
</body>

</html>