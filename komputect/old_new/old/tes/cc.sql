/*
SQLyog Ultimate v11.5 (32 bit)
MySQL - 5.5.40-cll : Database - komputec_lift
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`komputec_lift` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `komputec_lift`;

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `urut` char(2) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `contact_name` char(20) DEFAULT NULL,
  `contact_phone` char(30) DEFAULT NULL,
  `contact_email` char(60) DEFAULT NULL,
  `contact_email2` char(60) DEFAULT NULL,
  `contact_workshop` char(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `contact` */

insert  into `contact`(`urut`,`tanggal`,`contact_name`,`contact_phone`,`contact_email`,`contact_email2`,`contact_workshop`) values ('1','2012-09-19','Rahmat Hidayat','0817610929','komputeclift@gmail.com','rahmat@komputeclift.com','Jl. Baru Pemda no. 21 Cibinong Bogor');

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id_content` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'Y',
  `utama` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'Y',
  `isi_content` text COLLATE latin1_general_ci,
  `keterangan_gambar` text COLLATE latin1_general_ci,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `dibaca` int(11) DEFAULT '1',
  PRIMARY KEY (`id_content`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `content` */

insert  into `content`(`id_content`,`judul`,`aktif`,`utama`,`isi_content`,`keterangan_gambar`,`tanggal`,`jam`,`gambar`,`dibaca`) values ('X_MASTER_X','profil','Y','Y','\r\n<p><strong>CV.KOMPUTEC</strong></p>\r\n<p>Bergerak dibidang pembuatan LIFT BARANG, DUMBWAITER,PASSANGER</p>\r\n<p>Dengan berkembangnya teknologi dan pesatnya pembangunan dan sangat diperlukannya efisiensi dalam bekerja terutama efisiensi waktu dalam bisnis anda, maka kami <strong>CV.KOMPUTEC</strong> Hadir untuk menjawab solusi yang Bapak / Ibu hadapi, dengan menyediakan beberapa keunggulan yang akan berguna untuk kenyamanan dan keamanan bagi para customer.</p>',NULL,'2015-01-18','14:50:00',NULL,1),('MENU1',NULL,'Y','Y','CV  Computeclift siap melayani pengadaan & pemasangan Lift / Elevator ataupun Eskalator serta pelayanan purna jual untuk Proyek Gedung, Ruko, Perkantoran, Mall, Trade Centre, maupun Rumah tinggal. ',NULL,NULL,NULL,NULL,1),('WSH',NULL,'Y','Y','Dengan pengalaman bertahun-tahun dalam pembuatan lift/ elavator ini, senantiasa kami mendapatkan pengalaman untuk meningkatkan kestabilan, kekuatan maupun teknologi sistem elektrikalnya. Selain pabrikasi, kami juga berpengalaman dalam perbaikan dan modifikasi lift barang yang sudah ada sebelumnya baik dari teknologi maupun dari segi design, kekuatan dan kenyamanan. Dalam rangka memenuhi kebutuhan dan permintaan Cargo Lift / Elevator di Indonesia , kami siap melayani untuk seluruh Kota di Tanah Air',NULL,NULL,NULL,NULL,1),('CNT','Hubungi Kami','Y','Y','<b>CV  Computeclift</b> adalah perusahaan yang bergerak di bidang kontruksi pembuatan elevator dan lift barang baik lokal ataupun import, dengan desain sesuai kondisi tempat dan keinginan konsumen. Hubungi kami melalui form berikut untuk mendapatkan informasi detail produk/ jasa yang kami tawarkan.',NULL,NULL,NULL,NULL,1),('PROY','Proyek Kami','Y','Y',NULL,NULL,NULL,NULL,NULL,1),('MENU2',NULL,'Y','Y','Dengan didukung oleh tenaga ahli , terampil dan terlatih dibidangnya serta dukungan manajemen yang solid , kami siap melayani konsumen secara professional dan terpercaya.',NULL,NULL,NULL,NULL,1);

/*Table structure for table `counter` */

DROP TABLE IF EXISTS `counter`;

CREATE TABLE `counter` (
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `ip_client` char(20) DEFAULT NULL,
  `browser` char(50) DEFAULT NULL,
  `versi_browser` varchar(50) DEFAULT NULL,
  `os` varbinary(20) DEFAULT NULL,
  `country` char(100) DEFAULT NULL,
  `region_name` char(100) DEFAULT NULL,
  `city` char(100) DEFAULT NULL,
  `isp` char(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `counter` */

insert  into `counter`(`tanggal`,`jam`,`ip_client`,`browser`,`versi_browser`,`os`,`country`,`region_name`,`city`,`isp`) values ('2015-02-05','14:44:44','127.0.0.1','Google Chrome','39.0.2171.71','windows','Localhost','Localhost','Localhost','Localhost'),('2015-02-05','15:55:56','127.0.0.1','Internet Explorer','8.0','windows','Localhost','Localhost','Localhost','Localhost'),('2015-02-05','22:20:15','114.79.48.44','Google Chrome','39.0.2171.71','windows','Indonesia','','Jakarta','PT. Wireless Indonesia'),('2015-02-05','22:20:15','114.79.48.45','Google Chrome','39.0.2171.71','windows','Indonesia','Jakarta','Jakarta','PT. Wireless Indonesia'),('2015-02-05','22:29:37','199.30.228.150','Mozilla Firefox','3.6.13','mac','United States','Washington','Seattle','DomainTools, LLC'),('2015-02-05','22:30:58','66.249.82.228','Other Browser','?','Other Os','Australia','','','Google'),('2015-02-05','22:30:58','66.249.82.246','Other Browser','?','Other Os','Australia','','','Google'),('2015-02-05','22:33:27','66.249.84.141','Mozilla Firefox','6.0','windows','United States','California','Mountain View','Google'),('2015-02-05','22:40:36','66.249.82.228','Google Chrome','27.0.1453','linux','Australia','','','Google'),('2015-02-05','22:42:53','172.246.147.196','Internet Explorer','8.0','windows','United States','California','Los Angeles','Enzu'),('2015-02-05','22:47:07','66.249.79.19','Other Browser','?','Other Os','United States','California','Mountain View','Googlebot'),('2015-02-05','22:48:05','66.249.79.11','Other Browser','?','Other Os','United States','California','Mountain View','Googlebot'),('2015-02-05','22:48:07','66.249.79.27','Other Browser','?','Other Os','United States','California','Mountain View','Googlebot'),('2015-02-05','22:49:21','114.79.48.44','Mozilla Firefox','34.0','Other Os','Indonesia','','Jakarta','PT. Wireless Indonesia'),('2015-02-05','22:50:59','114.79.48.44','Mozilla Firefox','36.0','windows','Indonesia','','Jakarta','PT. Wireless Indonesia'),('2015-02-05','22:57:36','114.79.48.44','Internet Explorer','8.0','windows','Indonesia','','Jakarta','PT. Wireless Indonesia'),('2015-02-05','23:10:54','117.102.91.139','Apple Safari','4.0','linux','unknown','unknown','unknown','unknown');

/*Table structure for table `galery` */

DROP TABLE IF EXISTS `galery`;

CREATE TABLE `galery` (
  `recid` char(3) DEFAULT NULL,
  `urut` char(5) DEFAULT NULL,
  `id_img` char(10) DEFAULT NULL,
  `category` char(20) DEFAULT NULL,
  `info_id` char(40) DEFAULT NULL,
  `tags_id` char(20) DEFAULT NULL,
  `img_thumb` char(50) DEFAULT NULL,
  `img_full` char(50) DEFAULT NULL,
  `tags_en` char(20) DEFAULT NULL,
  `info_en` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `galery` */

insert  into `galery`(`recid`,`urut`,`id_img`,`category`,`info_id`,`tags_id`,`img_thumb`,`img_full`,`tags_en`,`info_en`) values ('BS','1',NULL,'lift','Pelita Mutiara Indah','Selamata Datang','thumb_pelita1.gif','pelita1.jpg','Welcome','Pelita Mutiara Indah'),('BS','4',NULL,'lift','Lift Rumah Sakit','Lift Hospital','thumb_lift_hospital.gif','lift_hospital.jpg','Elevator Hospital','Elevator Hospital'),('BS','6',NULL,'lift','Lift Ruko','Lift Ruko','thumb_lift_ruko.gif','lift_ruko.jpg','Elevator Shop','Elevator Shop'),('BS','3',NULL,'lift','Eskalator','Eskalator','thumb_eskalator.gif','eskalator.jpg','Escalator','Escalator'),('BS','5',NULL,'lift','Lift Barang','Freigh Elevator','thumb_freigh_elevator.gif','freigh_elevator.jpg','Freigh Elevator','Freigh Elevator'),('BS','2',NULL,'lift','Elevator / Lift','Elevator','thumb_roomless.gif','roomless.jpg','Elevator','Elevator'),('BS','7',NULL,'lift','dumbwaiter / lift cafe','Dumbwaiter','thumb_dumbwaiter.gif','dumbwaiter.jpg','Dumbwaiter','Dumbwaiter'),('BS','8',NULL,'lift','Panel - panel','Mesin & panel','thumb_machine.gif','machine.jpg','Machine & Panel','Panel - panel'),('WSH','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('WSH','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `guest_book` */

DROP TABLE IF EXISTS `guest_book`;

CREATE TABLE `guest_book` (
  `tanggal` date DEFAULT NULL,
  `jam` char(8) DEFAULT NULL,
  `nama` char(20) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `pesan` char(200) DEFAULT NULL,
  `guest_id` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `guest_book` */

insert  into `guest_book`(`tanggal`,`jam`,`nama`,`email`,`pesan`,`guest_id`) values ('2014-04-14','10:10:01','Ahmad Khothib','aakangmas@gmail.com','Mohon informasi teknis dan harga eskalator (naik-turun) untuk bangunan 2 lantai (tinggi antar lantai 4m).','a21d727adff22870dbeb907d0cdb0f60'),('2014-12-23','17:40:07','ardian syahputra','bajaantik4@gmail.com','saya ingin informasi tentang lift penumpang untuk gedung 7 lantai.. naik turun..tolong kirim brosur dan list harganya.via email saya.thx','acee9ddae91e20f6d9031fd61e3b0d24'),('2014-12-25','10:53:08','ir.hotman marpaung','marpaunghotman@yahoo.com','mohon informasi teknis dan harga eskalator(naik-turun) untuk bangunan 3 lantai (tinggi antar lantai 4m).','b127f7509faabab18c6538c8c63edbb8'),('2015-01-18','08:36:43','a','b','c','43ca701b799a419ec691bc828b990be6'),('2015-01-17','22:10:43','pesan','lift','gimana ya','8e3b3a13526b67195a103fdbc7c080d2'),('2015-01-17','21:50:09','asd','asdf','asdf','66ce9c96651ebad3919d4f38bd4c41bb'),('2015-01-17','21:48:05','as','df','asdf','85f4efff0034f4d06449fcdde5a7bd9e'),('2015-01-17','21:19:33','a','b','c','0e19b1e0e9030f28b9fc76938842a065'),('2015-01-15','21:52:29','sarip hidayat','sariphidayat1512@gmail.com','selamat malam pak. saya memiliki lift kargo merk DEMAG pada bagian rope guidenya saya mengalami kerusakan... apakah bapak memiliki suku cadangnya atau merk lain yang sekiranya cocok dengan rope guide','a3661366f2a996428b48e089929b1afe'),('2015-01-14','14:13:25','asu','nazar.zrey@gmail.com','Adeli@','64bcee37a28dbb88a20adaa102874305'),('2015-01-14','14:06:30','nazar','zrey_adhe@yahoo.com','asdfasfasf\r\nasdf\r\nas\r\ndfas\r\nfasd\r\nfa\r\nsdf\r\nasdfasd','ac39681621dfe6e9bebd4754b456cc52'),('2015-01-14','14:02:45','tessss','zrey_adhe@yahoo.com','tes kirim by website','390ff9fd0b81ba9dbad99f1fadd7d2bf'),('2015-01-14','13:59:16','nazrey','zrey_adhe@yahoo.com','tes kirim email langsung dari web','e45a9daa6f7bed0e254c802fa71dba49'),('2015-01-13','11:00:05','titi','titikprihananti@gmail.com','permohonan harga pemeliharaan lift rumah sakit','ac35a9b23f17ff79d16b4802d74c50b9'),('2015-01-18','05:23:09','asdffffsddddddddddd','ssssssssssssssssssssssssssssssssssssssssssssssssss','sdfasdfasfasf/asdf;asdf;asd fl;sadf l;asef l;asdl;fkals;kdfl;asdfk l;asdklf; klas;df kl;asdfk;lasdkfl;asdkf;laskdfl;askdfl;kasdl;fksadl;kfl;asdkfl;asdkfl;sadkfl;asdkfl;asdkfl;sadk fl;asdkfl;asdkfl;asd','bdc9720386accd7535852dda0e31cb5a'),('2015-01-18','05:24:42','asdffffsddddddddddd','ssssssssssssssssssssssssssssssssssssssssssssssssss','sdfasdfasfasf/asdf;asdf;asd fl;sadf l;asef l;asdl;fkals;kdfl;asdfk l;asdklf; klas;df kl;asdfk;lasdkfl;asdkf;laskdfl;askdfl;kasdl;fksadl;kfl;asdkfl;asdkfl;sadkfl;asdkfl;asdkfl;sadk fl;asdkfl;asdkfl;asd','cf890a2dad616508f1c19352b1b1cb82'),('2015-01-18','05:25:19','adeli','d','ds','503f60cfa7c75bf74017cad0ba1c369e'),('2015-01-18','05:27:17','b','s','e','150db7927df00c5a5e24bcd69c021b1b'),('2015-01-18','05:29:24','s','d','a','c0212b48c696fd8f6366a505b90758f0'),('2015-01-18','05:29:48','d','f','g','fc9743427a10a4c48ea6f64b3b5dcce6'),('2015-01-18','05:31:07','s','d','f','bcfce62443ce2c37f132dd4002995fd2'),('2015-01-18','05:32:55','r','y','r','05c2a256c2f05b56a5b5558d3c347f83'),('2015-01-18','05:33:24','nazar','keren','asu','86fc8ebaaa5acf474d7592951616b8da'),('2015-01-18','11:35:38','9','9','87878','18d264f990eb9d11a1a59d00d8e11f38'),('2015-01-18','15:16:56','dfdsf','fs','asdfsadf','c53f0510ee1c2d024046cc1158940299'),('2015-01-19','17:08:53','s','d','f','99fca914d965fed2de3a75a175a17ebf'),('2015-01-19','21:00:14','rthdf','ffgfth','dffgdfh','92ed2fb0823a14c55c52daa2f4ec3952'),('2015-01-21','15:08:15','fghdfghdfgh','dfghdf','ghdfghdfghdfgh','bb633ee05e880c8e09ebe361678bb248'),('2015-01-21','15:13:26','tes','tes','tes','dd542dfe150e50904ee0611821fd6d9f'),('2015-01-21','15:23:17','s','d','f','7480f6b6af60f31986e71d4ac3c55c52'),('2015-01-21','15:23:31','yt','yt','yt','c5e676ee0ded5af9b443668de6511379'),('2015-01-21','15:37:42','54','54','54','92ef9c357740e9a3a872bd27992e7710'),('2015-01-21','15:38:30','asdf','asdf','asdf','2c11635506c3db840237618897100991'),('2015-02-05','12:51:37','a','d','s','7570b624b2dc28dc6bd74be034de8558'),('2015-02-05','12:52:44','s','e','f','b40d34b1066ee21292a61082cc304d83'),('2015-02-05','12:53:06','s','e','f','dae6649e9aa6deba4df320253132f217'),('2015-02-05','12:53:56','s','e','eff','4abcaaffb773f2ccb46133c7f2722d3d');

/*Table structure for table `maps` */

DROP TABLE IF EXISTS `maps`;

CREATE TABLE `maps` (
  `latitude` char(50) DEFAULT NULL,
  `longitude` char(50) DEFAULT NULL,
  `zoom` char(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `maps` */

insert  into `maps`(`latitude`,`longitude`,`zoom`) values ('-6.2280565836944195','106.9177195429802','15');

/*Table structure for table `master_input` */

DROP TABLE IF EXISTS `master_input`;

CREATE TABLE `master_input` (
  `input_sort` char(2) DEFAULT NULL,
  `input_key` char(32) DEFAULT NULL,
  `input_desc` char(20) DEFAULT NULL,
  `input_name` char(20) DEFAULT NULL,
  `input` char(100) DEFAULT NULL,
  `input_img` char(100) DEFAULT NULL,
  `input_type` char(20) DEFAULT NULL,
  `input_size` char(5) DEFAULT NULL,
  `input_max` char(5) DEFAULT NULL,
  `input_upd` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_input` */

insert  into `master_input`(`input_sort`,`input_key`,`input_desc`,`input_name`,`input`,`input_img`,`input_type`,`input_size`,`input_max`,`input_upd`) values ('1','c01','contact_us','co_name','Nama Anda (dibutuhkan)',NULL,'text','50','20',NULL),('2','c02','contact_us','co_email','Email Anda (dibutuhkan)',NULL,'text','50','50',NULL),('3','c03','contact_us','co_message','Pesan Anda (dibutuhkan)',NULL,'textarea','80','8',NULL);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `urut` decimal(3,0) DEFAULT NULL,
  `recid` char(1) DEFAULT NULL,
  `category` char(30) DEFAULT NULL,
  `product_name` char(50) DEFAULT NULL,
  `image_ico` char(80) DEFAULT NULL,
  `image_full` char(100) DEFAULT NULL,
  `product_id` char(32) DEFAULT NULL,
  `product_spek` text,
  `product_desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `produk` */

insert  into `produk`(`urut`,`recid`,`category`,`product_name`,`image_ico`,`image_full`,`product_id`,`product_spek`,`product_desc`) values ('2',NULL,'lift','room elevator','index_ico1.jpg','room_elevator.jpg','b0c692dfadd0c307dd702eda94fe89cd',NULL,NULL),('3',NULL,'lift','roomless elevator','index_ico2.jpg','roomless_elevator.jpg','130399b08c7753e6840a4d45eeed6e73','a','b'),('4',NULL,'lift','home lift','index_ico3.jpg','home_lift.jpg','703f55f68ca9180470575fafc41fd97a',NULL,NULL),('5',NULL,'lift','panoramic lift','index_ico4.jpg','panoramic.jpg','437a62db6a1a9c0fd25bbaee3b4cb8e0',NULL,NULL),('6',NULL,'lift','hospital elevator','index_ico5.jpg','hospital.jpg','16c17edc473fc84663ff604b4435a8e7',NULL,NULL),('7',NULL,'lift','car & freig elevator','index_ico6.jpg','car.jpg','b72ac9d14c998990922175db7ae816dc',NULL,NULL),('8',NULL,'lift','eskalator','index_ico7.jpg','eskalator.jpg','eada9a7200e462b66daf74504716719e',NULL,NULL),('9',NULL,'lift','walk eskalator','index_ico8.jpg','walk_eskalator.jpg','0327cc444f009a1874c187344f73c46c',NULL,NULL),('10',NULL,'lift','Dumbwaiter','dumb_ico.jpg','dumbwaiter.jpg','795ab2c824e99f6d34efff59d2734a75',NULL,NULL);

/*Table structure for table `produk_detail` */

DROP TABLE IF EXISTS `produk_detail`;

CREATE TABLE `produk_detail` (
  `product_id` char(32) DEFAULT NULL,
  `urut` char(3) DEFAULT NULL,
  `recid` char(1) DEFAULT NULL,
  `small_img` char(100) DEFAULT NULL,
  `big_img` char(100) DEFAULT NULL,
  `upd_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `produk_detail` */

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` char(10) DEFAULT NULL,
  `content` char(100) DEFAULT NULL,
  `ico` char(100) DEFAULT NULL,
  `urut` char(2) DEFAULT NULL,
  `recid` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`id`,`content`,`ico`,`urut`,`recid`) values ('company','CV Komputeclift',NULL,'1','X'),('address','Jl. Baru Pemda no. 21 Cibinong Bogor',NULL,'2','X'),('phone','021-9193611','ico\\contact.png','3','X'),('fax','021-87925515',NULL,'4','X'),('mail1','info@komputeclift.com','ico\\contact.png','6',NULL),('mobile','081296985375,0817610929',NULL,'5','Y'),('mail2','komputeclift@gmail.com',NULL,'7','X'),('address','Jl. Baru Pemda no. 21 Cibinong Bogor',NULL,'1','W');

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `project_id` char(32) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `build_name` char(80) DEFAULT NULL,
  `lokasi` char(80) DEFAULT NULL,
  `user` char(50) DEFAULT NULL,
  `produk` char(50) DEFAULT NULL,
  `kapasitas` char(50) DEFAULT NULL,
  `unit` char(2) DEFAULT NULL,
  `tahun` char(5) DEFAULT NULL,
  `project_img` char(100) DEFAULT NULL,
  `project_desc` varchar(3000) DEFAULT NULL,
  `upd_data` date DEFAULT NULL,
  `agent_id` char(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `project` */

insert  into `project`(`project_id`,`type`,`build_name`,`lokasi`,`user`,`produk`,`kapasitas`,`unit`,`tahun`,`project_img`,`project_desc`,`upd_data`,`agent_id`) values ('a79cee37172b2c4338caa58d80572ddc','proyek','Pantai Indah Kapuk','Pantai Indah Kapuk','Bpk. Sutarmin','Dumbwaiter','100kg / 3','-','2014',NULL,NULL,'2015-02-05',NULL),('8cfff40303a652ba4b82044d2edc7b69','proyek','Ruko Muara Karang','Muara Karang','-','Install Mecanical, Commisioning','750kg / 4','-','2014',NULL,NULL,'2015-02-05',NULL),('ce1880bf7e25959c07383e1be0630849','proyek','PT. Bangun Cemara Hotel','Menteng, Jakarta','-','Lift Penumpang','750kg / 5','-','2014',NULL,NULL,'2015-02-05',NULL),('e57c2568fc4e68d59dd292ac5f777274','proyek','Geologi Bandung','Bandung, Jawa Barat','-','Modernisasi lift dan Panel','550kg / 4','-','2014',NULL,NULL,'2015-02-05',NULL),('fd817d483af5e0484f68fa3fded1645b','proyek','Sarang Walet','Depok, Jawa Barat','Bambang','Dumbwaiter','100kg / 2','1','2014',NULL,NULL,'2015-02-05',NULL),('30e979916e6424023e407130d831069a','proyek','PT. Dua Berlian','Pulo Gadung, Jakarta','','Dumbwaiter','200kg / 4','1','2014',NULL,NULL,'2015-02-05',NULL),('af3f3ebd6f4f0716dd0cfd8a55634fca','proyek','Restauran Margonda','Depok, Jawa Barat','Bpk. Eman Sulaeman','Lift Barang','700kg / 4','1','2014',NULL,NULL,'2015-02-05',NULL),('2ae564687d3b307cb844e756fdddaaf3','proyek','UIN Sunan Gunung Jati','Bandung, Jawa Barat','-','Modernisasi lift dan Panel','750kg / 6','-','2014',NULL,NULL,'2015-02-05',NULL),('50807b91a1b34de31a4db427e5fbfc9d','proyek','Uin Bandung','Bandung, Jawa Barat','-','Lift Penumpang','-','1','2014','uin_bandung_20150127_154303.jpg',NULL,'2015-02-05',NULL),('783ffbda46c05eb0595e52fdb1bc2555','proyek','Cipinang','Jakarta Timur','-','Lift Barang','-','1','2014','cipinang_Foto0326.jpg',NULL,'2015-02-05',NULL),('4985d1359463049abc820cac9869aee9','proyek','Laboratorium Perikanan','Pluit, Jakarta Utara','Bpk. Jimy','Modernisasi lift dan Panel','550kg / 3','1','2014','lab_pluit_IMG-20141230-00756.jpg',NULL,'2015-02-05',NULL);

/*Table structure for table `project_detail` */

DROP TABLE IF EXISTS `project_detail`;

CREATE TABLE `project_detail` (
  `project_id` char(32) DEFAULT NULL,
  `urut` char(3) DEFAULT NULL,
  `recid` char(1) DEFAULT NULL,
  `small_img` char(100) DEFAULT NULL,
  `big_img` char(100) DEFAULT NULL,
  `upd_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `project_detail` */

insert  into `project_detail`(`project_id`,`urut`,`recid`,`small_img`,`big_img`,`upd_data`) values ('783ffbda46c05eb0595e52fdb1bc2555','1','X','','cipinang_Foto0326.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','2','X',NULL,'cipinang_Foto0328.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','3','X',NULL,'cipinang_Foto0329.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','4','X',NULL,'cipinang_Foto0330.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','5','X',NULL,'cipinang_Foto0331.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','6','X',NULL,'cipinang_Hall Door.jpg',NULL),('783ffbda46c05eb0595e52fdb1bc2555','7','X',NULL,'cipinang_Safety Device system.jpg',NULL),('468029a843bbaf5d1be0e56484e2aa38','1','X',NULL,'lab_pluit_IMG-20141230-00754.jpg',NULL),('468029a843bbaf5d1be0e56484e2aa38','2','X',NULL,'lab_pluit_IMG-20141230-00756.jpg',NULL),('468029a843bbaf5d1be0e56484e2aa38','3','X',NULL,'lab_pluit_IMG-20141230-00760.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','1','X',NULL,'uin_bandung_20150127_154159.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','2','X',NULL,'uin_bandung_20150127_154217.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','3','X',NULL,'uin_bandung_20150127_154303.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','4','X',NULL,'uin_bandung_20150127_154419.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','5','X',NULL,'uin_bandung_IMG-20150126-00835.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','6','X',NULL,'uin_bandung_IMG-20150126-00840.jpg',NULL),('50807b91a1b34de31a4db427e5fbfc9d','7','X',NULL,'uin_bandung_Rancasari-20141216-00713.jpg',NULL);

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `flag` char(1) DEFAULT NULL,
  `tag1` char(50) DEFAULT NULL,
  `href_tag1` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tags` */

insert  into `tags`(`flag`,`tag1`,`href_tag1`) values ('1','lift murah','www.komputeclift.com'),('1','home lift','www.komputeclift.com'),('1','lift penumpang','www.komputeclift.com'),('1','panel lift','www.komputeclift.com'),('1','foto lift barang','www.komputeclift.com'),('1','penangkal petir','www.komputeclift.com'),('1','lift barang murah','www.komputeclift.com'),('1','elevator','www.komputeclift.com'),('1','dumbwaiter','www.komputeclift.com'),('1','liftbarang','www.komputeclift.com'),('1','lift makan','www.komputeclift.com'),('1','liftmakan','www.komputeclift.com'),('1','lift barang','www.komputeclift.com'),('1','panel lift penumpang','www.komputeclift.com'),('1','lift bogor','www.komputeclift.com'),('1','lift di bogor','www.komputeclift.com'),('1','pasang lift di bogor','www.komputeclift.com'),('1','dumbwaiter bogor','www.komputeclift.com'),('1','elevator bogor','www.komputeclift.com'),('1','bogor elevator','www.komputeclift.com'),('1','komputec','www.komputeclift.com'),('1','komputeclift','www.komputeclift.com');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `tanggal` date DEFAULT NULL,
  `id_user` char(10) NOT NULL,
  `id_name` char(15) DEFAULT NULL,
  `id_pass` char(40) DEFAULT NULL,
  `id_type` char(5) DEFAULT NULL,
  `id_log_in` date DEFAULT NULL,
  `id_time_in` char(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`tanggal`,`id_user`,`id_name`,`id_pass`,`id_type`,`id_log_in`,`id_time_in`) values ('2012-09-19','admin','administrator','0b41dcce326d068cfdc231046071285e','admin','0000-00-00','null'),('2012-09-27','nazar','nazarudin','6c1da0f1dea08bc9f650a01e54c21b9f','admin','2012-09-27','22:21:05'),('2012-10-13','zrey','nazarudin','6c1da0f1dea08bc9f650a01e54c21b9f','admin','2012-10-13','19:44:32');

/*Table structure for table `ym` */

DROP TABLE IF EXISTS `ym`;

CREATE TABLE `ym` (
  `id` char(15) DEFAULT NULL,
  `id_mail` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ym` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
