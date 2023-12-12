/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.4.6-MariaDB : Database - uji
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `berkas_pengaduan` */

DROP TABLE IF EXISTS `berkas_pengaduan`;

CREATE TABLE `berkas_pengaduan` (
  `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT,
  `upd_rec` datetime DEFAULT current_timestamp(),
  `pelapor` char(20) DEFAULT NULL,
  `jalan` char(200) DEFAULT NULL,
  `kecamatan` char(20) DEFAULT NULL,
  `kelurahan` char(20) DEFAULT NULL,
  `kordinat` char(50) DEFAULT NULL,
  `konstruksi` char(50) DEFAULT NULL,
  `lahan` char(50) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `status_laporan` char(20) DEFAULT NULL,
  `progres` char(5) DEFAULT NULL,
  `lampiran` char(1) DEFAULT NULL,
  `aktif` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`),
  KEY `KEY` (`kecamatan`,`kelurahan`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

/*Data for the table `berkas_pengaduan` */

insert  into `berkas_pengaduan`(`id_pengaduan`,`upd_rec`,`pelapor`,`jalan`,`kecamatan`,`kelurahan`,`kordinat`,`konstruksi`,`lahan`,`tahun`,`status_laporan`,`progres`,`lampiran`,`aktif`) values 
(1,'2020-05-21 03:57:23','234324','w3','11','7','2234234','13','7','2018','1',NULL,'1','y'),
(2,'2020-05-21 03:57:31','234324','w3','11','7','2234234','13','7','2018','1',NULL,'1','y'),
(3,'2020-05-21 04:01:09','234324','w3','11','7','2234234','13','7','2018','1',NULL,'1','y'),
(4,'2020-05-21 04:02:41','123213','123','11','11','123','12','8','2018','1',NULL,'1','y'),
(5,'2020-05-21 04:02:59','123213','123','11','11','123','12','8','2018','1',NULL,'1','y'),
(6,'2020-05-21 04:08:40','123213','123','11','11','123','12','8','2018','1',NULL,'1','y'),
(7,'2020-05-21 04:09:00','123','32453','11','10','121343','12','8','2020','2',NULL,'1','y'),
(8,'2020-05-21 04:09:28','123','32453','11','10','121343','12','8','2020','4',NULL,'1','y'),
(9,'2020-05-21 04:10:41','432r4','21312','11','7','123213','12','6','2020','3',NULL,'1','y'),
(10,'2020-05-21 04:12:55','041243','041243','041243','041243','041243','041243','041243','2020','1',NULL,'1','y'),
(11,'2020-05-21 04:14:05','041359','041359','041359','041359','041359','041359','041359','2020','5',NULL,'1','y'),
(12,'2020-05-21 04:15:11','041505','041505','041505','041505','041505','041505','041505','2020','5',NULL,'1','y'),
(13,'2020-05-21 04:15:42','041538','041538','041538','041538','041538','041538','041538','2020','1',NULL,'1','y'),
(14,'2020-05-21 10:01:24','100043','100043','11','8','100043','13','8','2020','5',NULL,'1','y'),
(15,'2020-05-21 10:16:37','101618','101618','2','38','101618','12','10','2020','1',NULL,'1','y');

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_berkas` int(11) NOT NULL,
  `nama_file` char(100) DEFAULT NULL,
  `path` char(100) DEFAULT NULL,
  `korelasi_id` int(11) DEFAULT NULL,
  `group` char(10) DEFAULT NULL,
  `updrec_date` datetime DEFAULT NULL,
  `recid` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_berkas`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`id_berkas`,`nama_file`,`path`,`korelasi_id`,`group`,`updrec_date`,`recid`) values 
(87,0,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(88,0,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(89,0,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(90,0,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(91,0,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(92,0,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(93,0,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(94,0,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(95,0,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(96,1,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(97,1,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(98,1,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(99,2,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(100,2,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(101,2,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(102,3,'WIN_20191103_15_45_41_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(106,7,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(107,7,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(108,8,'WIN_20171209_08_46_04_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(109,8,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(110,9,'WIN_20171126_10_11_45_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(111,9,'WIN_20171231_11_36_28_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(112,9,'WIN_20171231_11_37_10_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(114,11,'WIN_20171209_08_46_07_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(115,12,'WIN_20171224_11_20_23_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(116,13,'WIN_20171224_11_23_01_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(117,14,'WIN_20190730_09_16_06_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(118,14,'WIN_20171216_15_37_36_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(119,14,'WIN_20171216_15_38_02_Pro_(3).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(120,14,'WIN_20171216_15_38_03_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(121,14,'WIN_20171216_15_38_02_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(122,14,'WIN_20171216_15_38_03_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(123,14,'WIN_20171216_15_37_29_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(124,14,'WIN_20171216_15_38_02_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(125,14,'WIN_20171216_15_38_01_Pro_(4).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(126,14,'naz.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(127,14,'WIN_20190821_13_19_21_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(128,14,'WIN_20190821_13_19_33_Pro.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(129,14,'nazrey.jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(130,14,'WIN_20190821_13_18_34_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1'),
(131,15,'WIN_20181225_19_19_06_Pro_(2).jpg','./gallery/200521/',NULL,'gallery','0000-00-00 00:00:00','1');

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `id_kec` int(9) NOT NULL AUTO_INCREMENT,
  `nama` char(100) DEFAULT NULL,
  `latitude` char(50) DEFAULT NULL,
  `longitude` char(50) DEFAULT NULL,
  `updrec_date` datetime DEFAULT current_timestamp(),
  `recid` char(1) DEFAULT '1',
  PRIMARY KEY (`id_kec`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`id_kec`,`nama`,`latitude`,`longitude`,`updrec_date`,`recid`) values 
(1,'Beji','-6.373328','106.820374','2016-11-12 12:54:23','0'),
(2,'Pancoran Mas','-6.398890','106.800181','2016-10-24 05:44:02','1'),
(3,'Cipayung','-6.428050','106.802184','2016-10-24 05:44:02','0'),
(4,'Sukmajaya','-6.397469','106.844067','2016-10-24 05:44:02','0'),
(5,'Cilodong','-6.429598','106.839987','2016-10-24 05:44:02','0'),
(6,'Limo','-6.367910','106.780487','2016-10-24 05:44:02','0'),
(7,'Cinere','-6.331498','106.787966','2016-10-24 05:44:02','0'),
(8,'Cimanggis','-6.367955','106.867162','2016-10-24 05:44:02','0'),
(9,'Tapos','-6.420808','106.879835','2016-10-24 05:44:02','0'),
(10,'Sawangan','-6.399134','106.759463','2016-10-24 05:44:02','0'),
(11,'Bojongsari','-6.393127','106.739554','2016-11-17 20:06:59','1');

/*Table structure for table `kelurahan` */

DROP TABLE IF EXISTS `kelurahan`;

CREATE TABLE `kelurahan` (
  `id_kel` int(11) NOT NULL AUTO_INCREMENT,
  `id_fk_kec` int(11) NOT NULL,
  `nama` char(100) DEFAULT NULL,
  `latitude` char(100) DEFAULT NULL,
  `longitude` char(100) DEFAULT NULL,
  `updrec_date` datetime DEFAULT current_timestamp(),
  `recid` char(1) DEFAULT '1',
  PRIMARY KEY (`id_kel`,`id_fk_kec`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

/*Data for the table `kelurahan` */

insert  into `kelurahan`(`id_kel`,`id_fk_kec`,`nama`,`latitude`,`longitude`,`updrec_date`,`recid`) values 
(1,1,'Beji',NULL,NULL,'2020-05-17 22:44:58','0'),
(2,1,'Beji Timur',NULL,NULL,'2020-05-17 22:44:58','0'),
(3,1,'Kemiri Muka',NULL,NULL,'2020-05-17 22:44:58','0'),
(4,1,'Kukusan',NULL,NULL,'2020-05-17 22:44:58','0'),
(5,1,'Pondok Cina',NULL,NULL,'2020-05-17 22:44:58','0'),
(6,1,'Tanah Baru',NULL,NULL,'2020-05-17 22:44:58','0'),
(7,11,'Bojongsari',NULL,NULL,'2020-05-17 22:44:58','1'),
(8,11,'Bojongsari Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(9,11,'Curug',NULL,NULL,'2020-05-17 22:44:58','1'),
(10,11,'Duren Mekar',NULL,NULL,'2020-05-17 22:44:58','1'),
(11,11,'Duren Seribu',NULL,NULL,'2020-05-17 22:44:58','1'),
(12,11,'Pondok Petir',NULL,NULL,'2020-05-17 22:44:58','1'),
(13,11,'Serua',NULL,NULL,'2020-05-17 22:44:58','1'),
(14,5,'Cilodong',NULL,NULL,'2020-05-17 22:44:58','0'),
(15,5,'Jatimulya',NULL,NULL,'2020-05-17 22:44:58','0'),
(16,5,'Kalibaru',NULL,NULL,'2020-05-17 22:44:58','0'),
(17,5,'Kalimulya',NULL,NULL,'2020-05-17 22:44:58','0'),
(18,5,'Sukamaju',NULL,NULL,'2020-05-17 22:44:58','0'),
(19,8,'Cisalak Pasar',NULL,NULL,'2020-05-17 22:44:58','0'),
(20,8,'Curug',NULL,NULL,'2020-05-17 22:44:58','0'),
(21,8,'Harjamukti',NULL,NULL,'2020-05-17 22:44:58','0'),
(22,8,'Mekarsari',NULL,NULL,'2020-05-17 22:44:58','0'),
(23,8,'Pasir Gunung Selatan',NULL,NULL,'2020-05-17 22:44:58','0'),
(24,8,'Tugu',NULL,NULL,'2020-05-17 22:44:58','0'),
(25,7,'Cinere',NULL,NULL,'2020-05-17 22:44:58','0'),
(26,7,'Gandul',NULL,NULL,'2020-05-17 22:44:58','0'),
(27,7,'Pangkalan Jati',NULL,NULL,'2020-05-17 22:44:58','0'),
(28,7,'Pangkalan Jati Baru',NULL,NULL,'2020-05-17 22:44:58','0'),
(29,3,'Bojong Pondok Terong',NULL,NULL,'2020-05-17 22:44:58','0'),
(30,3,'Cipayung',NULL,NULL,'2020-05-17 22:44:58','0'),
(31,3,'Cipayung Jaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(32,3,'Pondok Jaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(33,3,'Ratu Jaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(34,6,'Grogol',NULL,NULL,'2020-05-17 22:44:58','0'),
(35,6,'Krukut',NULL,NULL,'2020-05-17 22:44:58','0'),
(36,6,'Limo',NULL,NULL,'2020-05-17 22:44:58','0'),
(37,6,'Meruyung',NULL,NULL,'2020-05-17 22:44:58','0'),
(38,2,'Depok',NULL,NULL,'2020-05-17 22:44:58','1'),
(39,2,'Depok Jaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(40,2,'Mampang',NULL,NULL,'2020-05-17 22:44:58','0'),
(41,2,'Pancoran Mas',NULL,NULL,'2020-05-17 22:44:58','0'),
(42,2,'Rangkapan Jaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(43,2,'Rangkapan Jaya Baru',NULL,NULL,'2020-05-17 22:44:58','0'),
(44,10,'Bedahan',NULL,NULL,'2020-05-17 22:44:58','0'),
(45,10,'Cinangka',NULL,NULL,'2020-05-17 22:44:58','0'),
(46,10,'Kedaung',NULL,NULL,'2020-05-17 22:44:58','0'),
(47,10,'Pasir Putih',NULL,NULL,'2020-05-17 22:44:58','0'),
(48,10,'Pengasinan',NULL,NULL,'2020-05-17 22:44:58','0'),
(49,10,'Sawangan',NULL,NULL,'2020-05-17 22:44:58','0'),
(50,10,'Sawangan Baru',NULL,NULL,'2020-05-17 22:44:58','0'),
(51,4,'Abadijaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(52,4,'Baktijaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(53,4,'Cisalak',NULL,NULL,'2020-05-17 22:44:58','0'),
(54,4,'Mekarjaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(55,4,'Sukmajaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(56,4,'Tirtajaya',NULL,NULL,'2020-05-17 22:44:58','0'),
(57,9,'Cilangkap',NULL,NULL,'2020-05-17 22:44:58','0'),
(58,9,'Cimpaeun',NULL,NULL,'2020-05-17 22:44:58','0'),
(59,9,'Jatijajar',NULL,NULL,'2020-05-17 22:44:58','0'),
(60,9,'Leuwinanggung',NULL,NULL,'2020-05-17 22:44:58','0'),
(61,9,'Sukamaju Baru',NULL,NULL,'2020-05-17 22:44:58','0'),
(62,9,'Sukatani',NULL,NULL,'2020-05-17 22:44:58','0'),
(63,9,'Tapos',NULL,NULL,'2020-05-17 22:44:58','0');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desk` char(20) DEFAULT NULL,
  `config1` char(20) DEFAULT NULL,
  `config2` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `KEY` (`config1`,`config2`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`id`,`desk`,`config1`,`config2`) values 
(1,'usulan','status',NULL),
(2,'survey','status',NULL),
(3,'layak','status','survey'),
(4,'tidak layak','status','survey'),
(5,'bukan kewenangan','status','survey'),
(6,'pemerintah','lahan',NULL),
(7,'wakaf','lahan',NULL),
(8,'warisan','lahan',NULL),
(9,'sengketa','lahan',NULL),
(10,'belum laku','lahan',NULL),
(11,'bini ke 2','lahan',NULL),
(12,'aspal','konstruksi',NULL),
(13,'tambal','konstruksi',NULL),
(14,'hotmik','konstruksi',NULL),
(15,'membuat turab','konstruksi',NULL),
(16,'jalan','jenis',NULL),
(17,'saluran','jenis',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
