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
  `surat_laporan` char(50) NOT NULL,
  `upd_rec` datetime DEFAULT current_timestamp(),
  `pelapor` char(20) DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `lokasi` char(200) DEFAULT NULL,
  `kecamatan` char(20) DEFAULT NULL,
  `kelurahan` int(11) DEFAULT NULL,
  `kordinat` char(50) DEFAULT NULL,
  `konstruksi` char(50) DEFAULT NULL,
  `lahan` char(50) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `grup_laporan` char(100) DEFAULT NULL,
  `judul` char(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status_laporan` char(20) DEFAULT NULL,
  `progres` char(5) DEFAULT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `aktif` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`,`surat_laporan`),
  KEY `KEY` (`kecamatan`,`kelurahan`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `berkas_pengaduan` */

insert  into `berkas_pengaduan`(`id_pengaduan`,`surat_laporan`,`upd_rec`,`pelapor`,`telp`,`lokasi`,`kecamatan`,`kelurahan`,`kordinat`,`konstruksi`,`lahan`,`tahun`,`grup_laporan`,`judul`,`deskripsi`,`status_laporan`,`progres`,`lampiran`,`aktif`) values 
(1,'WEB/6/VI/16','2016-06-21 09:39:56','Zunaidi','08135648974','JL. RAYA SAWANGAN','2',NULL,NULL,NULL,NULL,NULL,'001','Pemeliharaan jalan Berlubang','Pemeliharaan Jalan Raya sawangan Kecamatan Pancoran Mas. Jalan Rusak dan Berlubang.','selesai',NULL,NULL,'Y'),
(2,'WEB/7/VI/16','2016-06-21 09:51:18','Mansur','08569453216','JL. PASIR PUTIH SAWANGAN PERMAI','2',NULL,NULL,NULL,NULL,NULL,'001','Pemeliharaan Jalan','Jalan rusak berbatuan menghambat pengguna jalan.','survey',NULL,NULL,'Y'),
(3,'WEB/8/VI/16','2016-06-21 10:06:40','Ara','0857122166520','JL. RAYA SAWANGAN','10',NULL,NULL,NULL,NULL,NULL,'003','Pemeliharaan saluran','Banyak rumput dan daun yg tumbuh di gorong2 menghambat saluran air.','selesai',NULL,NULL,'Y'),
(4,'WEB/9/VI/16','2016-06-21 10:20:40','Mansur','0813156947521','JL. SASAK SDN 03 LIMO','6',NULL,NULL,NULL,NULL,NULL,'001','Pemeliharaan jalan','Jalan berbatu dan berlubang','selesai',NULL,NULL,'Y'),
(5,'WEB/10/VI/16','2016-06-21 10:24:10','Zunaidi','08574563211','JL. PASIR PUTIH NGURUK BESKOS','10',NULL,NULL,NULL,NULL,NULL,'001','Pemeliharaan jalan','Jalan rusak dan berbatu.','survey',NULL,NULL,'Y'),
(6,'WEB/11/VI/16','2016-06-21 10:33:02','Hairul Malik','081322555877','JL. RAYA DEPOK - SAWANGAN DEPAN SEKOLAH NURUR RAHMAN','2',NULL,NULL,NULL,NULL,NULL,'003','Pemeliharaan Saluran dan gorong-gorong','gorong-gorong tersumbat dan tidak mengalir. saluran jadi kotor.','selesai',NULL,NULL,'Y'),
(7,'WEB/12/VI/16','2016-06-21 10:48:31','Ara','085633222587','JL. Raya RTM','8',23,NULL,NULL,NULL,NULL,'003','Pemeliharaan Saluran','Normalisasi Saluran. membersihkan rumput2 bahu jalan.','selesai',NULL,NULL,'Y'),
(8,'WEB/13/VI/16','2016-06-21 10:55:10','mansur','085745888963','JL. RH BRIGIF GANDUL','7',NULL,NULL,NULL,NULL,NULL,'003','Pemeliharaan Saluran','Normalisasi Saluran.','selesai',NULL,NULL,'Y'),
(9,'WEB/14/VI/16','2016-06-22 12:50:43','Zunaidi','081396385274','JL. RAYA CIPAYUNG','3',NULL,NULL,NULL,NULL,NULL,'001','Jalan Longsor Ambles','jalan ambles dan longsor','survey',NULL,NULL,'Y'),
(10,'WEB/15/VI/16','2016-06-22 12:54:58','ara','0817951753250','JL. RAYA RTM','8',NULL,NULL,NULL,NULL,NULL,'001','pembersihan bahu jalan','banyaknya rumput di saluran menghambat aliran air di gorong2.','selesai',NULL,NULL,'Y'),
(11,'WEB/16/VI/16','2016-06-28 11:58:18','mansur','08567412589','JL. H. HAMBALI (Brigif)','8',19,NULL,NULL,NULL,NULL,'001','Jalan Berlubang dan berbatu','Jalan berlubang dan berbatu membahayakan pengendara motor','selesai',NULL,NULL,'Y'),
(12,'WEB/17/VI/16','2016-06-28 12:01:48','ara','081244956322','JL. H. HAMBALI (Brigif)','8',19,NULL,NULL,NULL,NULL,'001','Jalan Rusak','Jalan berlubang dan rusak','selesai',NULL,NULL,'Y'),
(13,'WEB/18/VI/16','2016-06-28 12:04:50','anda suhanda','0217756654','tole iskandar','4',NULL,NULL,NULL,NULL,NULL,'001','perbaikan jalan yg bolong','ada beberapa jalan bolong di beberapa titik','survey',NULL,NULL,'X'),
(14,'WEB/19/VI/16','2016-06-28 12:06:00','mansur','081744458963','JL. KERAKATAU CINERE','7',NULL,NULL,NULL,NULL,NULL,'001','Jalan Rusak','Jalan tidak rata, rusak menghambat pengguna jalan','selesai',NULL,NULL,'Y'),
(15,'WEB/20/VI/16','2016-06-28 12:07:32','anda suhanda','08121831642','jl. raya keadilan','2',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak','dititik jl. raya keadilan ada bagian jalan yg rusak berat','proses',NULL,NULL,'X'),
(16,'WEB/21/VI/16','2016-06-28 12:07:54','Mansur','085796832154','JL. BUKIT CINERE','7',NULL,NULL,NULL,NULL,NULL,'001','Jalan berlubang','jalan berlubang berbatu','selesai',NULL,NULL,'Y'),
(17,'WEB/22/VI/16','2016-06-28 12:10:48','hendy','08128376202','jl. Kostrad','5',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak','jl. berlubang di beberapa titik','usulan',NULL,NULL,'X'),
(18,'WEB/23/VI/16','2016-06-28 12:11:24','surya','081322136588','JL. RAYA KEADILAN','2',NULL,NULL,NULL,NULL,NULL,'001','Jalan tidak rata dan rusak','Jalan tidak rata bergelombang dan rusak di beberapa titik','selesai',NULL,NULL,'Y'),
(19,'WEB/24/VI/16','2016-06-28 12:16:47','anda','021777666421','jl. cipayung','3',NULL,NULL,NULL,NULL,NULL,'004','pinggiran jalan deket air rusak','cenderung seperti jebol atau tergeser bagian pinggiran jalan','selesai',NULL,NULL,'X'),
(20,'WEB/25/VI/16','2016-06-28 12:17:10','zunaidi','081578945611','JL. RAYA SAWANGAN PERTIGAAN ARCO','10',NULL,NULL,NULL,NULL,NULL,'001','jalan berbatu','jalan rusak dan berbatu','survey',NULL,NULL,'Y'),
(21,'WEB/26/VI/16','2016-06-28 12:33:17','ara','081311666488','JL. AKSES UI','8',19,NULL,NULL,NULL,NULL,'001','Jalan berlubang besar','bahu jalan berlubang besar sangat berbahaya','selesai',NULL,NULL,'Y'),
(22,'WEB/27/VI/16','2016-06-28 12:33:55','awih','0856772346','GDC KOTA KEMBANG','4',NULL,NULL,NULL,NULL,NULL,'001','JALAN RUSAK','jalan bolong dan rusak di beberapa tempat','proses',NULL,NULL,'X'),
(23,'WEB/28/VI/16','2016-06-28 12:34:48','awih','0856772346','GDC KOTA KEMBANG','4',NULL,NULL,NULL,NULL,NULL,'001','JALAN RUSAK','jalan bolong dan rusak di beberapa tempat','selesai',NULL,NULL,'X'),
(24,'WEB/29/VI/16','2016-06-28 12:38:05','hairul maliq','081977584632','JL. RAYA KEADILAN','2',NULL,NULL,NULL,NULL,NULL,'001','jalan retak','Jalan retak','selesai',NULL,NULL,'Y'),
(25,'WEB/30/VI/16','2016-06-28 12:44:01','zunaidi','08151697485','JL. RAYA SAWANGAN','2',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak tidak rata','jalan rusak','selesai',NULL,NULL,'Y'),
(26,'WEB/31/VI/16','2016-06-30 09:25:23','zunaidi','0857778452521','JL. RAYA MUKTAR SAWANGAN','10',NULL,NULL,NULL,NULL,NULL,'001','Jalan Berlubang dan Rusak','Jalan rusak berlubang di beberapa sudut jalan','survey',NULL,NULL,'X'),
(27,'WEB/32/VI/16','2016-06-30 09:30:47','Surya','0812116598571','SIMPANG LIMA DAN DEPAN PASAR JAYA PANMAS','2',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak dan berlubang','jalan berlubang rusak di sudut jalan','usulan',NULL,NULL,'X'),
(28,'WEB/33/VI/16','2016-06-30 09:33:22','Ara','081978546231','JL. H. HAMBALI (Brigif)','8',20,NULL,NULL,NULL,NULL,'001','Jalan berlubang berbatu','Jalan tidak rata dan berlubang','usulan',NULL,NULL,'X'),
(29,'WEB/34/VI/16','2016-06-30 09:36:49','surya','085769385421','JL. PASAR MUSI SUKMA JAYA','4',NULL,NULL,NULL,NULL,NULL,'001','Jalan tidak rata berbatu','jalan berbatu tidak rata dan kasar','usulan',NULL,NULL,'X'),
(30,'WEB/35/VI/16','2016-06-30 09:58:01','Ara','081312457896','JL. NAKULA','8',21,NULL,NULL,NULL,NULL,'001','Jalan bergelombang dan tidak rata','jalan bergelombang tidak rata','usulan',NULL,NULL,'X'),
(31,'WEB/36/VI/16','2016-06-30 10:07:13','Surya','081564578932','JL. PASAR MISI','4',NULL,NULL,NULL,NULL,NULL,'001','jalan tidak rata dan berbatu','jalan tidak rata dan berbatu','survey',NULL,NULL,'X'),
(32,'WEB/37/VI/16','2016-06-30 10:10:08','Zunaidi','085633326598','JL. RAYA SAWANGAN','2',NULL,NULL,NULL,NULL,NULL,'001','Jalan rusak dan berlubang','Jalan rusak di bahu jalan dan berlubang di beberapa titik','usulan',NULL,NULL,'X'),
(33,'WEB/38/VI/16','2016-06-30 10:13:43','mansur','081311666277','JL. H. HAMBALI (Brigif)','8',NULL,NULL,NULL,NULL,NULL,'001','Jalan rusak dan berlubang','Jalan rusak dan berlubang','usulan',NULL,NULL,'X'),
(34,'WEB/39/VI/16','2016-06-30 10:49:34','Surya','081547896325','JL. PASAR AGUNG KE2','4',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak','jalan rusak berbatu dan bergelombang','usulan',NULL,NULL,'X'),
(35,'WEB/40/VI/16','2016-06-30 11:03:11','suhanda','081212456730','jl raya margonda','4',NULL,NULL,NULL,NULL,NULL,'003','saluran bolong besar dan kotor','saluran bolong besar dan kotor  berbahaya bagi pengendara dan juga apabila ada org yg berjalan melewati area tersebut','survey',NULL,NULL,'X'),
(36,'WEB/41/VI/16','2016-06-30 11:04:20','suhanda','081212456730','jl raya margonda','4',NULL,NULL,NULL,NULL,NULL,'003','saluran bolong besar dan kotor','saluran bolong besar dan kotor  berbahaya bagi pengendara dan juga apabila ada org yg berjalan melewati area tersebut','usulan',NULL,NULL,'X'),
(37,'WEB/42/VI/16','2016-06-30 11:19:41','Zunaidi','081546987542','JL. RAYA SAWANGAN','2',NULL,NULL,NULL,NULL,NULL,'001','jalan berlubang dan berbatu','jalan rusak dan berlubang','usulan',NULL,NULL,'X'),
(38,'WEB/43/VI/16','2016-06-30 11:22:32','Ara','0815456789653','JL. H. HAMBALI','8',NULL,NULL,NULL,NULL,NULL,'001','jalan berlubang','jalan berlubang berbahaya bagi pengguna jalan','usulan',NULL,NULL,'X'),
(39,'WEB/44/VI/16','2016-06-30 11:23:42','suhanda','081202363996','jl raya margonda','1',NULL,NULL,NULL,NULL,NULL,'003','bersihkan saluran jalan','saluran air dijln sekitar wilaya depan itc margonda tersendat','usulan',NULL,NULL,'X'),
(40,'WEB/45/VI/16','2016-06-30 11:27:28','awih','08128963456','gdc cilodong','5',NULL,NULL,NULL,NULL,NULL,'001','jala rusak','jalan rusak di bbrapa titik','usulan',NULL,NULL,'X'),
(41,'WEB/46/VI/16','2016-06-30 11:40:44','Ara','081215975365','JL. RADAR AURI','8',NULL,NULL,NULL,NULL,NULL,'001','jalan retak dan pecah','jalan rusak retak dan pecah','usulan',NULL,NULL,'X'),
(42,'WEB/47/VI/16','2016-06-30 11:56:38','Ara','081544569632','JL. BUKIT CENGKEH','8',20,NULL,NULL,NULL,NULL,'001','jalan rusak','jalan rusak','usulan',NULL,NULL,'X'),
(43,'WEB/48/VI/16','2016-06-30 12:05:10','Ara','085644896952','JL. H. HAMBALI (Brigif)','8',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak dan tidak rata','jalan rusak dan tidak rata','usulan',NULL,NULL,'X'),
(44,'WEB/49/VI/16','2016-06-30 12:09:55','Ara','08121546967548','JL. MEKAR SARI','8',24,NULL,NULL,NULL,NULL,'001','jalan berlubang','jalan berlubang','usulan',NULL,NULL,'X'),
(45,'WEB/50/VI/16','2016-06-30 12:16:45','Ara','08564569954','JL. MEKAR SARI (DEP. TRUBUS)','8',20,NULL,NULL,NULL,NULL,'001','jalan retak dan rusak','jalan retak dan rusak','selesai',NULL,NULL,'X'),
(46,'WEB/51/VI/16','2016-06-30 12:18:22','Zunaidi','081213664659','JL. MUKTAR SAWANGAN','10',NULL,NULL,NULL,NULL,NULL,'001','jalan rusak','jalan rusak','selesai',NULL,NULL,'X'),
(47,'WEB/52/VIII/16','2016-08-02 18:19:00','Mahdar Helmi','081283939853','Grand Cinere','6',NULL,NULL,NULL,NULL,NULL,'001','Jalan di perempatan Limo-Cinere (Depan Living Plaza) rusak','Kondisi badan jalan di perempatan Limo-Cinere rusak, tepatnya di depan Living Plaza. Kedalaman lobang mencapai 10 Cm. Kondisi tersebut mengakibatkan kemacetan panjang. Dan beberapa kali terdapat kecelakaan pengendara sepeda motor.','usulan',NULL,NULL,'Y'),
(48,'WEB/53/V/20','2020-05-04 15:21:26','na','123','123','1',NULL,NULL,NULL,NULL,NULL,'002','324','324324','usulan',NULL,NULL,'X'),
(49,'WEB/54/V/20','2020-05-04 15:21:41','na','123','123','1',NULL,NULL,NULL,NULL,NULL,'002','324','324324','usulan',NULL,NULL,'X');

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
(1,'Beji','-6.373328','106.820374','2016-11-12 12:54:23','1'),
(2,'Pancoran Mas','-6.398890','106.800181','2016-10-24 05:44:02','1'),
(3,'Cipayung','-6.428050','106.802184','2016-10-24 05:44:02','1'),
(4,'Sukmajaya','-6.397469','106.844067','2016-10-24 05:44:02','1'),
(5,'Cilodong','-6.429598','106.839987','2016-10-24 05:44:02','1'),
(6,'Limo','-6.367910','106.780487','2016-10-24 05:44:02','1'),
(7,'Cinere','-6.331498','106.787966','2016-10-24 05:44:02','1'),
(8,'Cimanggis','-6.367955','106.867162','2016-10-24 05:44:02','1'),
(9,'Tapos','-6.420808','106.879835','2016-10-24 05:44:02','1'),
(10,'Sawangan','-6.399134','106.759463','2016-10-24 05:44:02','1'),
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
(1,1,'Beji',NULL,NULL,'2020-05-17 22:44:58','1'),
(2,1,'Beji Timur',NULL,NULL,'2020-05-17 22:44:58','1'),
(3,1,'Kemiri Muka',NULL,NULL,'2020-05-17 22:44:58','1'),
(4,1,'Kukusan',NULL,NULL,'2020-05-17 22:44:58','1'),
(5,1,'Pondok Cina',NULL,NULL,'2020-05-17 22:44:58','1'),
(6,1,'Tanah Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(7,11,'Bojongsari',NULL,NULL,'2020-05-17 22:44:58','1'),
(8,11,'Bojongsari Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(9,11,'Curug',NULL,NULL,'2020-05-17 22:44:58','1'),
(10,11,'Duren Mekar',NULL,NULL,'2020-05-17 22:44:58','1'),
(11,11,'Duren Seribu',NULL,NULL,'2020-05-17 22:44:58','1'),
(12,11,'Pondok Petir',NULL,NULL,'2020-05-17 22:44:58','1'),
(13,11,'Serua',NULL,NULL,'2020-05-17 22:44:58','1'),
(14,5,'Cilodong',NULL,NULL,'2020-05-17 22:44:58','1'),
(15,5,'Jatimulya',NULL,NULL,'2020-05-17 22:44:58','1'),
(16,5,'Kalibaru',NULL,NULL,'2020-05-17 22:44:58','1'),
(17,5,'Kalimulya',NULL,NULL,'2020-05-17 22:44:58','1'),
(18,5,'Sukamaju',NULL,NULL,'2020-05-17 22:44:58','1'),
(19,8,'Cisalak Pasar',NULL,NULL,'2020-05-17 22:44:58','1'),
(20,8,'Curug',NULL,NULL,'2020-05-17 22:44:58','1'),
(21,8,'Harjamukti',NULL,NULL,'2020-05-17 22:44:58','1'),
(22,8,'Mekarsari',NULL,NULL,'2020-05-17 22:44:58','1'),
(23,8,'Pasir Gunung Selatan',NULL,NULL,'2020-05-17 22:44:58','1'),
(24,8,'Tugu',NULL,NULL,'2020-05-17 22:44:58','1'),
(25,7,'Cinere',NULL,NULL,'2020-05-17 22:44:58','1'),
(26,7,'Gandul',NULL,NULL,'2020-05-17 22:44:58','1'),
(27,7,'Pangkalan Jati',NULL,NULL,'2020-05-17 22:44:58','1'),
(28,7,'Pangkalan Jati Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(29,3,'Bojong Pondok Terong',NULL,NULL,'2020-05-17 22:44:58','1'),
(30,3,'Cipayung',NULL,NULL,'2020-05-17 22:44:58','1'),
(31,3,'Cipayung Jaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(32,3,'Pondok Jaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(33,3,'Ratu Jaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(34,6,'Grogol',NULL,NULL,'2020-05-17 22:44:58','1'),
(35,6,'Krukut',NULL,NULL,'2020-05-17 22:44:58','1'),
(36,6,'Limo',NULL,NULL,'2020-05-17 22:44:58','1'),
(37,6,'Meruyung',NULL,NULL,'2020-05-17 22:44:58','1'),
(38,2,'Depok',NULL,NULL,'2020-05-17 22:44:58','1'),
(39,2,'Depok Jaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(40,2,'Mampang',NULL,NULL,'2020-05-17 22:44:58','1'),
(41,2,'Pancoran Mas',NULL,NULL,'2020-05-17 22:44:58','1'),
(42,2,'Rangkapan Jaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(43,2,'Rangkapan Jaya Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(44,10,'Bedahan',NULL,NULL,'2020-05-17 22:44:58','1'),
(45,10,'Cinangka',NULL,NULL,'2020-05-17 22:44:58','1'),
(46,10,'Kedaung',NULL,NULL,'2020-05-17 22:44:58','1'),
(47,10,'Pasir Putih',NULL,NULL,'2020-05-17 22:44:58','1'),
(48,10,'Pengasinan',NULL,NULL,'2020-05-17 22:44:58','1'),
(49,10,'Sawangan',NULL,NULL,'2020-05-17 22:44:58','1'),
(50,10,'Sawangan Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(51,4,'Abadijaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(52,4,'Baktijaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(53,4,'Cisalak',NULL,NULL,'2020-05-17 22:44:58','1'),
(54,4,'Mekarjaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(55,4,'Sukmajaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(56,4,'Tirtajaya',NULL,NULL,'2020-05-17 22:44:58','1'),
(57,9,'Cilangkap',NULL,NULL,'2020-05-17 22:44:58','1'),
(58,9,'Cimpaeun',NULL,NULL,'2020-05-17 22:44:58','1'),
(59,9,'Jatijajar',NULL,NULL,'2020-05-17 22:44:58','1'),
(60,9,'Leuwinanggung',NULL,NULL,'2020-05-17 22:44:58','1'),
(61,9,'Sukamaju Baru',NULL,NULL,'2020-05-17 22:44:58','1'),
(62,9,'Sukatani',NULL,NULL,'2020-05-17 22:44:58','1'),
(63,9,'Tapos',NULL,NULL,'2020-05-17 22:44:58','1');

/*Table structure for table `status_laporan` */

DROP TABLE IF EXISTS `status_laporan`;

CREATE TABLE `status_laporan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desk` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `status_laporan` */

insert  into `status_laporan`(`id`,`desk`) values 
(1,'usulan'),
(2,'survey'),
(3,'proses'),
(4,'selesai'),
(5,'tolak');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
