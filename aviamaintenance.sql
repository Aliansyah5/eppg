/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - aviamaintenance
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`aviamaintenance` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `aviamaintenance`;

/*Table structure for table `access_control` */

DROP TABLE IF EXISTS `access_control`;

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `access_control` */

insert  into `access_control`(`id`,`user_level_id`,`module_id`,`content`,`user_modified`,`created_at`,`updated_at`) values 
(1,1,1,'a',1,'2018-10-10 09:28:44','2018-10-10 09:28:44'),
(2,1,2,'a',1,'2018-10-10 09:28:44','2018-10-10 09:28:44'),
(3,1,3,'a',1,'2018-10-10 09:28:44','2018-10-10 09:28:44'),
(4,2,1,'a',1,'2018-10-10 09:28:49','2018-10-10 09:28:49'),
(5,2,2,'a',1,'2018-10-10 09:28:49','2018-10-10 09:28:49'),
(6,2,3,'a',1,'2018-10-10 09:28:49','2018-10-10 09:28:49'),
(7,3,1,'v',1,'2018-10-10 09:28:54','2018-10-10 09:28:54'),
(8,3,2,'v',1,'2018-10-10 09:28:54','2018-10-10 09:28:54'),
(9,3,3,'v',1,'2018-10-10 09:28:54','2018-10-10 09:28:54');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`id`,`category`,`active`,`created_at`,`updated_at`,`user_modified`) values 
(1,'MECHANICAL',1,'2020-07-20 10:29:06','2020-07-20 10:27:44','ibra'),
(2,'ELECTRICAL',1,'2020-07-20 10:31:03','2020-07-20 10:28:58','ibra'),
(12,'yadayada',0,'2020-03-20 14:09:12','2020-03-20 14:07:47','ibra'),
(3,'UTILITIES',1,'2020-03-20 14:08:16','2020-03-20 14:06:10','ibra'),
(13,'POTATO',0,'2020-03-20 14:17:02','2020-03-20 14:15:38','ibra'),
(14,'CYLINDRICAL',0,'2020-03-20 16:42:32','2020-03-20 16:41:07','ibra'),
(15,'SPHERE',0,'2020-03-20 16:42:28','2020-03-20 16:41:03','ibra');

/*Table structure for table `detail_mt` */

DROP TABLE IF EXISTS `detail_mt`;

CREATE TABLE `detail_mt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Idx` int(11) NOT NULL,
  `kodeFA` varchar(50) NOT NULL,
  `kodeKomponen` varchar(50) NOT NULL,
  `Qty` double(17,2) unsigned DEFAULT 0.00,
  `assetid` int(11) DEFAULT NULL,
  `user_modified` varchar(10) DEFAULT NULL,
  `user_add` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`Idx`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `detail_mt` */

insert  into `detail_mt`(`id`,`Idx`,`kodeFA`,`kodeKomponen`,`Qty`,`assetid`,`user_modified`,`user_add`,`created_at`,`updated_at`) values 
(1,1,'8985','Ball Matic',1.00,8985,NULL,'serang','2020-07-23 15:01:56',NULL),
(1,2,'8985','Push Bottom Emergency Stop',2.00,8985,NULL,'serang','2020-07-23 15:01:56',NULL),
(2,1,'PM00315','Oli Regulator',5.00,3296,NULL,'chamim','2020-07-27 11:27:09',NULL),
(3,1,'PM00315','Membran',2.00,3296,NULL,'chamim','2020-07-27 11:45:00',NULL),
(3,2,'PM00315','Oli Regulator',0.30,3296,NULL,'chamim','2020-07-27 11:45:00',NULL),
(3,3,'PM00315','Back-up',2.00,3296,NULL,'chamim','2020-07-27 11:45:00',NULL),
(4,1,'SM00045','Filter Udara',1.00,8031,NULL,'chamim','2020-08-27 08:31:33',NULL),
(5,1,'PM00620','Membran',2.00,3562,NULL,'chamim','2020-08-27 08:36:38',NULL),
(6,1,'PM00620','Membran',2.00,3562,NULL,'chamim','2020-08-27 08:38:02',NULL),
(7,1,'PM00620','Membran',2.00,3562,NULL,'chamim','2020-08-27 09:13:44',NULL),
(8,1,'PK00240','Ban Forklift Depan',1.00,2861,NULL,'ibra','2020-08-27 10:17:54',NULL),
(9,1,'PK00240','Ban Forklift Depan',2.00,2861,NULL,'ibra','2020-08-27 10:18:42',NULL),
(10,1,'PK00240','Ban Forklift Depan',7.00,2861,NULL,'ibra','2020-08-27 10:19:13',NULL),
(11,1,'PK00240','Filter Oli Mesin',14.00,2861,NULL,'ibra','2020-09-15 13:41:47',NULL);

/*Table structure for table `master_asset` */

DROP TABLE IF EXISTS `master_asset`;

CREATE TABLE `master_asset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AssetID` varchar(50) NOT NULL,
  `schedule_mt` int(11) NOT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `master_asset` */

insert  into `master_asset`(`id`,`AssetID`,`schedule_mt`,`user_modified`) values 
(1,'PREIT03386',0,'ibra'),
(2,'PREIT03385',8000,'ibra');

/*Table structure for table `master_assigne` */

DROP TABLE IF EXISTS `master_assigne`;

CREATE TABLE `master_assigne` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_assigne` */

/*Table structure for table `master_hourmt` */

DROP TABLE IF EXISTS `master_hourmt`;

CREATE TABLE `master_hourmt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `asset` varchar(50) NOT NULL,
  `HourMeter` double(17,2) unsigned DEFAULT 0.00,
  `user_modified` varchar(10) DEFAULT NULL,
  `user_add` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`kode`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `master_hourmt` */

insert  into `master_hourmt`(`id`,`kode`,`asset`,`HourMeter`,`user_modified`,`user_add`,`created_at`,`updated_at`) values 
(2,'5271','COMPRESSOR KAESER CSD 125',27014.00,NULL,'tek08','2020-08-11 10:25:30','2020-08-11 10:25:30'),
(3,'8031','COMPRESSOR KAESSER CSD125 75 KW',2031.00,NULL,'tek08','2020-08-11 10:25:30','2020-08-11 10:25:30'),
(4,'3451','Compressor Kaeser TE-122',0.00,NULL,'tek08','2020-08-11 10:25:30','2020-08-11 10:25:30'),
(5,'3453','Compressor Kaeser CSD-125',23786.00,NULL,'tek08','2020-08-11 10:25:30','2020-08-11 10:25:30'),
(6,'2905','FORKLIFT TOYOTA 6FHD25',4318.00,NULL,'chamim','2020-08-25 10:12:37','2020-08-25 10:12:37'),
(7,'2765','FORKLIFT TOYOTA 6FHD25',562.00,NULL,'chamim','2020-08-25 10:12:37','2020-08-27 08:24:36'),
(8,'2935','FORKLIFT TOYOTA 8FHD25 ',13967.00,NULL,'chamim','2020-08-25 10:12:37','2020-08-25 10:12:37'),
(9,'2766','FORKLIFT TOYOTA 5FHD25',8554.00,NULL,'chamim','2020-08-25 10:12:37','2020-08-27 08:24:36'),
(10,'2745','FORKLIFT TOYOTA 6FHD25',2940.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(11,'2747','FORKLIFT TOYOTA 6FHD25',4085.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(12,'2748','FORKLIFT TOYOTA 6FHD25',150.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(13,'2754','FORKLIFT TOYOTA 6FHD25',337.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(14,'2764','FORKLIFT TOYOTA 5FHD25',2967.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(15,'2903','FORKLIFT 60-B FD 25 (RINJANI)',2986.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(16,'2830','FORKLIFT TOYOTA 5FDN25',2218.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(17,'2832','FORKLIFT TOYOTA 5FDN25',1128.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(18,'2856','FORKLIFT TOYOTA 5FDN25',3717.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(19,'2952','FORKLIFT TOYOTA TYPE 62 8FD25 KAP 2.5 TON ',4006.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(20,'2857','FORKLIFT TOYOTA 6FHD25',6215.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(21,'2861','FORKLIFT TOYOTA 5FDN25',3735.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(22,'2991','FORKLIFT TOYOTA 5FD25',2953.00,NULL,'chamim','2020-08-27 08:24:36','2020-08-27 08:24:36'),
(23,'2798','FORKLIFT TOYOTA 7FHD30',3762.00,NULL,'chamim','2020-08-27 08:27:23','2020-08-27 08:27:23'),
(24,'2992','FORKLIFT TOYOTA 7FD25',16645.00,NULL,'chamim','2020-08-27 08:27:23','2020-08-27 08:27:23');

/*Table structure for table `master_mt` */

DROP TABLE IF EXISTS `master_mt`;

CREATE TABLE `master_mt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `asset` varchar(50) NOT NULL,
  `kategori` int(11) NOT NULL,
  `jenis` enum('jasa','sparepart','checkup','others') DEFAULT NULL,
  `komponen` text DEFAULT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `detailid` int(10) DEFAULT NULL,
  `tgl_realisasi` date NOT NULL,
  `tgl_perkiraan` date NOT NULL,
  `tgl_selesaimt` date DEFAULT NULL,
  `tgl_lastmaintdate` date DEFAULT NULL,
  `assignee` varchar(10) NOT NULL,
  `supervisor` varchar(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `lama_mt` int(10) unsigned DEFAULT NULL,
  `HourMeter` double(17,2) unsigned DEFAULT 0.00,
  `user_modified` varchar(10) DEFAULT NULL,
  `user_add` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `master_mt` */

insert  into `master_mt`(`id`,`kode`,`asset`,`kategori`,`jenis`,`komponen`,`keterangan`,`detailid`,`tgl_realisasi`,`tgl_perkiraan`,`tgl_selesaimt`,`tgl_lastmaintdate`,`assignee`,`supervisor`,`active`,`lama_mt`,`HourMeter`,`user_modified`,`user_add`,`created_at`,`updated_at`) values 
(1,'MT00001','8985',1,NULL,'Ball Matic,Push Bottom Emergency Stop','tes',NULL,'2020-07-23','2020-07-23','2020-07-23','2020-07-23','36',NULL,2,0,5220.00,NULL,'serang','2020-07-23 15:01:56',NULL),
(2,'MT00002','3296',1,NULL,'Oli Regulator','ganti oli regulator',NULL,'2020-07-27','2020-08-30','2020-07-27','2020-04-01','15',NULL,2,0,585.00,NULL,'chamim','2020-07-27 11:27:09',NULL),
(3,'MT00003','3296',1,NULL,'Membran,Oli Regulator,Back-up','ganti mebran,oli regulator dan back-up',NULL,'2020-11-05','2020-11-05','2020-11-05','2020-04-01','15',NULL,2,0,1170.00,NULL,'chamim','2020-07-27 11:45:00',NULL),
(4,'MT00004','8031',1,NULL,'Filter Udara','Ganti filter udara',NULL,'2020-08-27','2020-08-27','2020-08-27','2020-04-01','15',NULL,2,0,2031.00,'chamim','chamim','2020-08-27 08:31:33','2020-08-27 08:49:14'),
(5,'MT00005','3562',1,NULL,'Membran','Membran',NULL,'2020-08-27','2020-08-28','2020-08-27','2020-04-01','15',NULL,2,0,741.00,'chamim','chamim','2020-08-27 08:36:38','2020-08-27 08:48:55'),
(6,'MT00006','3562',1,NULL,'Membran','Membran',NULL,'2020-08-27','2020-08-28','2020-08-27','2020-04-01','15',NULL,2,0,741.00,'chamim','chamim','2020-08-27 08:38:02','2020-08-27 08:48:46'),
(7,'MT00007','3562',1,NULL,'Membran','Membran',NULL,'2020-08-27','2020-08-28','2020-08-27','2020-04-01','15',NULL,2,0,1481.00,'chamim','chamim','2020-08-27 09:13:43','2020-08-27 09:14:17'),
(8,'MT00008','2861',1,NULL,'Ban Forklift Depan','k',NULL,'2020-08-27','2020-08-27','2020-08-27','2020-04-01','4','Effie',2,0,3735.00,'ibra','ibra','2020-08-27 10:17:54','2020-08-27 10:18:05'),
(9,'MT00009','2861',1,NULL,'Ban Forklift Depan','m',NULL,'2020-08-27','2020-08-27','2020-08-27','2020-04-01','15','Effie',2,0,3735.00,'ibra','ibra','2020-08-27 10:18:42','2020-08-27 10:18:52'),
(10,'MT00010','2861',1,NULL,'Ban Forklift Depan','k',NULL,'2020-08-27','2020-08-28','2020-08-27','2020-04-01','17','Effie',2,0,3735.00,'ibra','ibra','2020-08-27 10:19:13','2020-08-27 10:19:26'),
(11,'MT00011','2861',1,NULL,'Filter Oli Mesin','asdas',NULL,'2020-09-15','2020-09-16',NULL,'2020-08-27','8','Effie',1,0,3735.00,NULL,'ibra','2020-09-15 13:41:47',NULL);

/*Table structure for table `media_library` */

DROP TABLE IF EXISTS `media_library`;

CREATE TABLE `media_library` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `media_library` */

insert  into `media_library`(`id`,`name`,`type`,`url`,`size`,`user_created`,`created_at`,`updated_at`) values 
(0,'noprofileimage','png','img/noprofileimage.png','1159',1,'2017-05-30 02:56:03','2017-05-30 02:56:03');

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(20) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`slug`,`active`,`user_modified`,`created_at`,`updated_at`) values 
(1,'Master User Level','users-level',1,1,'2017-10-17 14:07:07','2017-10-17 14:43:43'),
(2,'Master User','users-user',1,1,'2017-10-17 14:16:51','2017-10-17 14:49:30'),
(3,'Media Library','media-library',1,1,'2017-10-17 14:19:28','2018-06-03 12:40:18');

/*Table structure for table `pic` */

DROP TABLE IF EXISTS `pic`;

CREATE TABLE `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `seksi` int(1) NOT NULL,
  `cabangid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `pic` */

insert  into `pic`(`id`,`nama`,`active`,`seksi`,`cabangid`,`created_at`,`updated_at`,`user_modified`) values 
(1,'M Nasrodin',1,2,1,'2020-07-20 10:37:49','2020-07-20 10:28:44','ibra'),
(2,'tes',0,3,NULL,'2020-07-20 10:31:13','2020-07-20 10:29:51','ibra'),
(3,'M Sugiharto',1,2,1,'2020-07-20 10:49:55','2020-07-20 10:48:32','ibra'),
(4,'Apit Fidianto',1,2,1,'2020-07-20 11:14:12','2020-07-20 11:14:12','ibra'),
(5,'Ach Nurul Abdillah',1,2,1,'2020-07-20 11:16:47','2020-07-20 11:16:47','ibra'),
(6,'Fendi Widodo',1,2,1,'2020-07-20 11:23:06','2020-07-20 11:23:06','ibra'),
(7,'Bayu Pratama',1,2,1,'2020-07-20 11:23:21','2020-07-20 11:23:21','ibra'),
(8,'Agung Dwi Hartanto',1,2,1,'2020-07-20 11:23:35','2020-07-20 11:23:35','ibra'),
(9,'Yanu Trio Widianto',1,2,1,'2020-07-20 11:23:51','2020-07-20 11:23:51','ibra'),
(10,'Andre Stristyo',1,2,1,'2020-07-20 11:24:05','2020-07-20 11:24:05','ibra'),
(11,'M Heru',1,2,1,'2020-07-20 11:24:13','2020-07-20 11:24:13','ibra'),
(12,'Alan Dwi Ardianyah',1,2,1,'2020-07-20 11:24:26','2020-07-20 11:24:26','ibra'),
(13,'Reski Fajar Prakasa',1,2,1,'2020-07-20 11:24:46','2020-07-20 11:24:46','ibra'),
(14,'Riski Hidayat',1,2,1,'2020-07-20 11:24:56','2020-07-20 11:24:56','ibra'),
(15,'Harmanto',1,1,1,'2020-07-20 11:25:12','2020-07-20 11:25:12','ibra'),
(16,'Mardiono',1,1,1,'2020-07-20 11:25:26','2020-07-20 11:25:26','ibra'),
(17,'Moch Nurul Huda',1,1,1,'2020-07-20 11:25:39','2020-07-20 11:25:39','ibra'),
(18,'Salman Farisi',1,1,1,'2020-07-20 11:26:03','2020-07-20 11:26:03','ibra'),
(19,'Dedik Setyawan',1,1,1,'2020-07-20 11:26:22','2020-07-20 11:26:22','ibra'),
(20,'Ahmad Badrus',1,1,1,'2020-07-20 11:26:34','2020-07-20 11:26:34','ibra'),
(21,'Rino Aji Kurniawan',1,1,1,'2020-07-20 11:26:47','2020-07-20 11:26:47','ibra'),
(22,'Muh. Zulfi H',1,1,1,'2020-07-20 11:27:01','2020-07-20 11:27:01','ibra'),
(23,'Agus Prasetyo',1,1,1,'2020-07-20 11:27:12','2020-07-20 11:27:12','ibra'),
(24,'Tasriful Ruchiyat Guntur',1,1,1,'2020-07-20 11:27:30','2020-07-20 11:27:30','ibra'),
(25,'Sutrisno B',1,1,1,'2020-07-20 11:27:46','2020-07-20 11:27:46','ibra'),
(26,'Hani Trihandoko',1,1,1,'2020-07-20 11:28:04','2020-07-20 11:28:04','ibra'),
(27,'Choirul',1,1,1,'2020-07-20 11:28:17','2020-07-20 11:28:17','ibra'),
(28,'Randi Agung S',1,3,1,'2020-07-20 11:29:58','2020-07-20 11:28:36','ibra'),
(29,'Medi Heri P',1,3,1,'2020-07-20 11:28:47','2020-07-20 11:28:47','ibra'),
(30,'Agung Budi',1,3,1,'2020-07-20 11:28:59','2020-07-20 11:28:59','ibra'),
(31,'Dany Firmansyah',1,3,1,'2020-07-20 11:29:11','2020-07-20 11:29:11','ibra'),
(32,'Widi Kurniawan',1,3,1,'2020-07-20 11:29:23','2020-07-20 11:29:23','ibra'),
(33,'Riza Mugianto',1,3,1,'2020-07-20 11:37:44','2020-07-20 11:36:22','ibra'),
(34,'Wawan Sulistyo',1,2,1,'2020-07-20 11:31:21','2020-07-20 11:31:21','ibra'),
(35,'Sukidal',1,2,2,'2020-07-20 14:40:09','2020-07-20 14:40:09','serang'),
(36,'Imam Satori',1,1,2,'2020-07-20 14:40:28','2020-07-20 14:40:28','serang'),
(37,'Mulyono',1,3,2,'2020-07-20 14:40:44','2020-07-20 14:40:44','serang');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `user_modified` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`id`,`name`,`value`,`user_modified`,`created_at`,`updated_at`) values 
(1,'web_title','AVIA Maintenance','Ibra','2017-06-13 07:27:16','2020-03-09 11:20:54'),
(2,'logo','img/logo.png','1','2017-06-13 07:27:16','2018-06-03 12:58:24'),
(3,'email_admin','admin@admin.com','Oei Donny','2017-06-13 07:27:16','2019-08-02 09:18:38'),
(4,'web_description','','Ibra','2017-07-24 06:56:28','2020-03-09 11:20:54');

/*Table structure for table `user_levels` */

DROP TABLE IF EXISTS `user_levels`;

CREATE TABLE `user_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `active` int(1) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_levels` */

insert  into `user_levels`(`id`,`name`,`active`,`user_modified`,`created_at`,`updated_at`) values 
(1,'Super Admin',1,1,'2017-06-28 13:18:17','2017-06-28 13:18:17'),
(2,'Admin',1,1,'2018-06-02 22:59:51','2018-06-02 22:59:51'),
(3,'User',1,1,'2018-06-03 11:19:49','2018-06-03 11:19:49');

/*Table structure for table `user_login` */

DROP TABLE IF EXISTS `user_login`;

CREATE TABLE `user_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text DEFAULT NULL,
  `reldag` varchar(45) DEFAULT NULL,
  `tipe` varchar(10) DEFAULT NULL,
  `user_level` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `kategori` int(11) DEFAULT NULL,
  `telp` int(11) DEFAULT NULL,
  `section` varchar(45) NOT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `supervisor` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(15) NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `user_login` */

insert  into `user_login`(`id`,`username`,`password`,`reldag`,`tipe`,`user_level`,`name`,`email`,`kategori`,`telp`,`section`,`jabatan`,`supervisor`,`created_at`,`updated_at`,`user_modified`,`last_activity`,`area`) values 
(1,'donny',NULL,'donny','AD','VSUPER','Donny','it_2@avianbrands.com',2,0,'ALL','','','2020-03-02 07:55:51','2020-07-08 10:06:33','','2020-07-08 10:06:33','AAP'),
(3,'ibra','e10adc3949ba59abbe56e057f20f883e','ibra','AGEN','VSUPER','Ibra','it_3@avianbrands.com',NULL,41,'ALL','IT Rnd','Effie','2020-03-02 09:50:56','2020-09-15 13:40:42','ibra','2020-09-15 13:40:42','AAP'),
(6,'test','827ccb0eea8a706c4c34a16891f84e7b','asd','AGEN','USER','asd','asdasd@gmail.com',2,123123,'ALL','d','sd','2020-03-02 16:20:46','2020-03-11 11:36:15','ibra',NULL,'AAP'),
(7,'chamim','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Chamim','tek10@avian.com',NULL,NULL,'MECHANICAL',NULL,NULL,'2020-03-20 10:05:52','2020-08-27 08:17:35','ibra','2020-08-27 08:17:35','AAP'),
(8,'andri','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Andri','kal02@avian.com',NULL,NULL,'ALL',NULL,NULL,'2020-03-20 10:06:46','2020-03-20 13:50:44','ibra','2020-03-20 13:50:44','AAP'),
(9,'effie','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VSUPER','Effie','it_3@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-03-20 11:12:25','2020-08-24 08:31:37','ibra','2020-08-24 08:31:37','AAP'),
(17,'tek01','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','tek01','tek01@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-17 07:44:51','2020-08-27 08:41:20','ibra','2020-08-27 08:41:20','AAP'),
(15,'psrg03','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Noviar','psrg03@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-07 14:30:50','2020-08-25 23:09:34','ibra','2020-08-25 23:09:34','AAS'),
(14,'psrg05','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Ian Rizky','psrg05@avian.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-07 14:30:23','2020-08-24 19:58:55','ibra','2020-08-24 19:58:55','AAS'),
(16,'serang','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','serang','serang@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-08 14:32:57','2020-08-21 13:26:12','ibra','2020-08-21 13:26:12','AAS'),
(18,'robert','a82762f30c1a27faa4f256b24fcaff24',NULL,'AGEN','VADM','robert','robert.tanoko@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-22 09:04:28','2020-07-29 15:21:13','effie','2020-07-29 15:21:13','AAP'),
(19,'tek08','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','tek08','mantohar26@gmail.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-24 14:25:38','2020-08-25 12:52:09','ibra','2020-08-25 12:52:09','AAP'),
(20,'tek07','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','tek07','nasrodin7@gmail.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-24 14:26:15','2020-08-12 11:46:23','ibra','2020-08-12 11:46:23','AAP'),
(21,'tek03','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','tek03','randiagung96@gmail.com',NULL,NULL,'ALL',NULL,NULL,'2020-07-24 14:26:52','2020-08-27 07:42:14','ibra','2020-08-27 07:42:14','AAP'),
(22,'nasrodin','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Nasrodin','nasrodin7@gmail.com',NULL,NULL,'ELECTRICAL',NULL,NULL,'2020-07-29 15:38:16','2020-07-29 15:39:25','ibra','2020-07-29 15:39:25','AAP'),
(24,'tek11','827ccb0eea8a706c4c34a16891f84e7b',NULL,'AGEN','VADM','Hendrik','tek11@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-14 16:50:43','2020-08-27 08:17:43','ibra','2020-08-27 08:17:43','AAP'),
(25,'PM','827ccb0eea8a706c4c34a16891f84e7b','PM','AGEN','VSUPER','Citro','psrg_1@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-21 13:37:21','2020-08-24 13:53:04','ibra',NULL,'AAS'),
(26,'OM','827ccb0eea8a706c4c34a16891f84e7b','OM','AGEN','VSUPER','Noviar Agung','psrg_3@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-21 13:38:23','2020-08-24 13:53:20','ibra',NULL,'AAS'),
(27,'ENG01','827ccb0eea8a706c4c34a16891f84e7b','ENG01','AGEN','VSUPER','Deni','psrg_5@avianbrands.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-21 13:39:46','2020-08-27 07:31:26','ibra','2020-08-27 07:31:26','AAS'),
(28,'ENG02','827ccb0eea8a706c4c34a16891f84e7b','ENG02','AGEN','VSUPER','Sukidal','sukidal41@gmail.com',NULL,NULL,'ELECTRICAL',NULL,NULL,'2020-08-21 13:43:23','2020-08-24 13:54:46','ibra',NULL,'AAS'),
(29,'ENG03','827ccb0eea8a706c4c34a16891f84e7b','ENG03','AGEN','VSUPER','Imam Tori','avser.064@gmail.com',NULL,NULL,'MECHANICAL',NULL,NULL,'2020-08-21 13:44:30','2020-08-24 13:54:57','ibra',NULL,'AAS'),
(30,'ENG04','827ccb0eea8a706c4c34a16891f84e7b','ENG04','AGEN','VSUPER','Mulyono','tututwkwk1234@gmail.com',NULL,NULL,'UTILITIES',NULL,NULL,'2020-08-21 13:46:57','2020-08-24 13:55:11','ibra',NULL,'AAS'),
(31,'ENG05','827ccb0eea8a706c4c34a16891f84e7b','ENG05','AGEN','VSUPER','Ian','ian.rizki1993@gmail.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-21 13:48:12','2020-08-26 09:13:29','ibra','2020-08-26 09:13:29','AAS'),
(32,'Yudi','827ccb0eea8a706c4c34a16891f84e7b','Yudi','AGEN','USER','Yudi','avser.014@gmail.com',NULL,NULL,'ALL',NULL,NULL,'2020-08-26 16:15:34','2020-08-26 16:15:34','ibra',NULL,'AAS');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`user_level_id`,`firstname`,`lastname`,`avatar_id`,`email`,`address`,`phone`,`gender`,`birthdate`,`username`,`password`,`active`,`user_modified`,`last_activity`,`created_at`,`updated_at`) values 
(1,1,'Super','Admin',0,'superadmin@admin.com','Jl Madura xxxxxxx','08383xxxxxxx','male','1986-07-25','superadmin','$2y$10$TkX/dDYrtvIEXidPOag5T.V8qbyluUHJg5ssBjKe6WlVqpItuN8uy',1,1,'2019-01-03 10:54:50','2017-03-14 03:51:35','2019-01-03 10:54:50'),
(2,2,'Admin','Admin',0,'admin@admin.com',NULL,NULL,'male',NULL,'admin','$2y$10$PQaUY4b0YsSo5qAuK8Cc.OB.WeEJHrJJ0FDgk6YE9xhXboVRou3We',1,1,'2019-01-02 10:17:02','2017-04-19 21:29:01','2019-01-02 10:17:02');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
