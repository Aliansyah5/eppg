/*
 Navicat Premium Data Transfer

 Source Server         : Local MAMP
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost:3306
 Source Schema         : ppgapps

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : 65001

 Date: 21/01/2021 05:10:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absensi
-- ----------------------------
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengajian` int(10) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `tempat` int(10) DEFAULT NULL,
  `kelompok` varchar(50) DEFAULT NULL,
  `peserta` varchar(50) DEFAULT NULL,
  `tingkat` int(10) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_akhir` time DEFAULT NULL,
  `quran` int(10) DEFAULT NULL,
  `pengajar_quran` int(10) DEFAULT NULL,
  `ayat_awal` int(10) DEFAULT NULL,
  `ayat_akhir` int(10) DEFAULT NULL,
  `hadist` int(10) DEFAULT NULL,
  `pengajar_hadist` int(10) DEFAULT NULL,
  `hal_awal` int(10) DEFAULT NULL,
  `hal_akhir` int(10) DEFAULT NULL,
  `penasehat` varchar(10) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `user_modified` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of absensi
-- ----------------------------
BEGIN;
INSERT INTO `absensi` VALUES (6, 2, '2020-12-25', 11, '[\"10\",\"9\"]', '[\"2\",\"5\"]', 2, '20:50:00', '20:53:00', 1, 2, 12, 14, 4, 5, 14, 14, '5', 1, 'ibra', '2020-12-25 20:48:25', '2020-12-25 20:48:47');
INSERT INTO `absensi` VALUES (7, 2, '2021-01-11', 11, '[\"2\",\"6\"]', '[\"1\"]', 1, '19:16:00', '19:20:00', 2, 2, 4, 5, 1, 4, 4, 4, '4', 1, 'ibra', '2021-01-17 19:16:34', '2021-01-17 19:16:34');
INSERT INTO `absensi` VALUES (8, 2, '2021-01-17', 11, '[\"6\",\"6\"]', '[\"3\",\"6\"]', 3, '19:20:00', '19:21:00', 4, 1, 10, 11, 11, 5, 44, 44, '5', 1, 'ibra', '2021-01-17 19:18:06', '2021-01-17 19:18:06');
COMMIT;

-- ----------------------------
-- Table structure for access_control
-- ----------------------------
DROP TABLE IF EXISTS `access_control`;
CREATE TABLE `access_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `content` text,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of access_control
-- ----------------------------
BEGIN;
INSERT INTO `access_control` VALUES (1, 1, 1, 'a', 1, '2018-10-10 09:28:44', '2018-10-10 09:28:44');
INSERT INTO `access_control` VALUES (2, 1, 2, 'a', 1, '2018-10-10 09:28:44', '2018-10-10 09:28:44');
INSERT INTO `access_control` VALUES (3, 1, 3, 'a', 1, '2018-10-10 09:28:44', '2018-10-10 09:28:44');
INSERT INTO `access_control` VALUES (4, 2, 1, 'a', 1, '2018-10-10 09:28:49', '2018-10-10 09:28:49');
INSERT INTO `access_control` VALUES (5, 2, 2, 'a', 1, '2018-10-10 09:28:49', '2018-10-10 09:28:49');
INSERT INTO `access_control` VALUES (6, 2, 3, 'a', 1, '2018-10-10 09:28:49', '2018-10-10 09:28:49');
INSERT INTO `access_control` VALUES (7, 3, 1, 'v', 1, '2018-10-10 09:28:54', '2018-10-10 09:28:54');
INSERT INTO `access_control` VALUES (8, 3, 2, 'v', 1, '2018-10-10 09:28:54', '2018-10-10 09:28:54');
INSERT INTO `access_control` VALUES (9, 3, 3, 'v', 1, '2018-10-10 09:28:54', '2018-10-10 09:28:54');
COMMIT;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES (1, 'CABERAWIT', 1, '2020-09-19 22:12:21', '2020-09-19 22:12:21', 'ibra');
INSERT INTO `category` VALUES (2, 'PRA-REMAJA (SMP)', 1, '2020-09-20 12:35:48', '2020-09-20 12:35:48', 'ibra');
INSERT INTO `category` VALUES (3, 'REMAJA (SMA/SMK)', 1, '2020-09-20 12:36:13', '2020-09-20 12:36:13', 'ibra');
INSERT INTO `category` VALUES (4, 'SMA', 0, '2020-09-20 12:36:55', '2020-09-20 12:36:55', 'ibra');
INSERT INTO `category` VALUES (5, 'MAHASISWA', 1, '2020-09-19 22:12:38', '2020-09-19 22:12:38', 'ibra');
INSERT INTO `category` VALUES (6, 'KERJA', 1, '2020-09-19 22:12:51', '2020-09-19 22:12:51', 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for dabsensi
-- ----------------------------
DROP TABLE IF EXISTS `dabsensi`;
CREATE TABLE `dabsensi` (
  `id` int(10) unsigned NOT NULL,
  `idx` int(10) unsigned NOT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `status` enum('A','H','S','I') DEFAULT 'A',
  `keterangan` text,
  `jam_datang` time DEFAULT NULL,
  `user_modified` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idx`,`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dabsensi
-- ----------------------------
BEGIN;
INSERT INTO `dabsensi` VALUES (6, 1, 7, 'H', 'asd', '20:48:59', 'ibra', '2020-12-25 20:48:49', '2020-12-25 20:48:59');
INSERT INTO `dabsensi` VALUES (7, 1, 4, 'H', NULL, '19:19:42', 'ibra', '2021-01-17 19:19:37', '2021-01-17 19:19:42');
INSERT INTO `dabsensi` VALUES (6, 2, 8, 'S', 'asdx', NULL, 'ibra', '2020-12-25 20:48:49', '2020-12-25 20:49:03');
COMMIT;

-- ----------------------------
-- Table structure for detail_absensi
-- ----------------------------
DROP TABLE IF EXISTS `detail_absensi`;
CREATE TABLE `detail_absensi` (
  `id` int(10) NOT NULL,
  `idx` int(10) DEFAULT NULL,
  `id_siswa` int(10) DEFAULT NULL,
  `status` enum('A','H','S','I') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for detail_mt
-- ----------------------------
DROP TABLE IF EXISTS `detail_mt`;
CREATE TABLE `detail_mt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Idx` int(11) NOT NULL,
  `kodeFA` varchar(50) NOT NULL,
  `kodeKomponen` varchar(50) NOT NULL,
  `Qty` double(17,2) unsigned DEFAULT '0.00',
  `assetid` int(11) DEFAULT NULL,
  `user_modified` varchar(10) DEFAULT NULL,
  `user_add` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`Idx`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_mt
-- ----------------------------
BEGIN;
INSERT INTO `detail_mt` VALUES (1, 1, '8985', 'Ball Matic', 1.00, 8985, NULL, 'serang', '2020-07-23 15:01:56', NULL);
INSERT INTO `detail_mt` VALUES (1, 2, '8985', 'Push Bottom Emergency Stop', 2.00, 8985, NULL, 'serang', '2020-07-23 15:01:56', NULL);
INSERT INTO `detail_mt` VALUES (2, 1, 'PM00315', 'Oli Regulator', 5.00, 3296, NULL, 'chamim', '2020-07-27 11:27:09', NULL);
INSERT INTO `detail_mt` VALUES (3, 1, 'PM00315', 'Membran', 2.00, 3296, NULL, 'chamim', '2020-07-27 11:45:00', NULL);
INSERT INTO `detail_mt` VALUES (3, 2, 'PM00315', 'Oli Regulator', 0.30, 3296, NULL, 'chamim', '2020-07-27 11:45:00', NULL);
INSERT INTO `detail_mt` VALUES (3, 3, 'PM00315', 'Back-up', 2.00, 3296, NULL, 'chamim', '2020-07-27 11:45:00', NULL);
INSERT INTO `detail_mt` VALUES (4, 1, 'SM00045', 'Filter Udara', 1.00, 8031, NULL, 'chamim', '2020-08-27 08:31:33', NULL);
INSERT INTO `detail_mt` VALUES (5, 1, 'PM00620', 'Membran', 2.00, 3562, NULL, 'chamim', '2020-08-27 08:36:38', NULL);
INSERT INTO `detail_mt` VALUES (6, 1, 'PM00620', 'Membran', 2.00, 3562, NULL, 'chamim', '2020-08-27 08:38:02', NULL);
INSERT INTO `detail_mt` VALUES (7, 1, 'PM00620', 'Membran', 2.00, 3562, NULL, 'chamim', '2020-08-27 09:13:44', NULL);
INSERT INTO `detail_mt` VALUES (8, 1, 'PK00240', 'Ban Forklift Depan', 1.00, 2861, NULL, 'ibra', '2020-08-27 10:17:54', NULL);
INSERT INTO `detail_mt` VALUES (9, 1, 'PK00240', 'Ban Forklift Depan', 2.00, 2861, NULL, 'ibra', '2020-08-27 10:18:42', NULL);
INSERT INTO `detail_mt` VALUES (10, 1, 'PK00240', 'Ban Forklift Depan', 7.00, 2861, NULL, 'ibra', '2020-08-27 10:19:13', NULL);
INSERT INTO `detail_mt` VALUES (11, 1, 'PK00240', 'Filter Oli Mesin', 14.00, 2861, NULL, 'ibra', '2020-09-15 13:41:47', NULL);
COMMIT;

-- ----------------------------
-- Table structure for malquran
-- ----------------------------
DROP TABLE IF EXISTS `malquran`;
CREATE TABLE `malquran` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_surat` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `juz` int(11) DEFAULT NULL,
  `jumlah_ayat` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of malquran
-- ----------------------------
BEGIN;
INSERT INTO `malquran` VALUES (1, 'Al-Fatihah', NULL, 7, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (2, 'Al-Baqarah', NULL, 286, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (3, 'Ali-Imran', NULL, 200, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (4, 'An-Nisa', NULL, 176, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (5, 'Al-Maidah', NULL, 120, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (6, 'Al-Anam', NULL, 165, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (7, 'Al-Araf', NULL, 206, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (8, 'Al-Anfal', NULL, 75, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (9, 'At-Taubah', NULL, 129, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (10, 'Yunus', NULL, 109, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (11, 'Hud', NULL, 123, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (12, 'Yusuf', NULL, 111, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (13, 'Ar-Rad', NULL, 43, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (14, 'Ibrahim', NULL, 52, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (15, 'Al-Hijr', NULL, 99, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (16, 'An-Nahl', NULL, 128, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (17, 'Al-Isra', NULL, 111, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (18, 'Al-Kahf', NULL, 110, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (19, 'Maryam', NULL, 98, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (20, 'Ta-Ha', NULL, 135, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (21, 'Al-Anbiya', NULL, 112, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (22, 'Al-Hajj', NULL, 78, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (23, 'Al-Muminun', NULL, 118, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (24, 'An-Nur', NULL, 64, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (25, 'Al-Furqan', NULL, 77, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (26, 'Asy-Syuara', NULL, 227, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (27, 'An-Naml', NULL, 93, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (28, 'AL-Qasas', NULL, 88, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (29, 'Al-Ankabut', NULL, 69, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (30, 'Ar-Rum', NULL, 60, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (31, 'Luqman', NULL, 34, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (32, 'As-Sajadah', NULL, 30, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (33, 'Al-Ahzab', NULL, 73, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (34, 'Saba', NULL, 54, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (35, 'Fatir', NULL, 45, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (36, 'Ya-Sin', NULL, 83, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (37, 'As-Saffat', NULL, 182, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (38, 'Sad', NULL, 88, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (39, 'Az-Zumar', NULL, 75, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (40, 'Ghafir', NULL, 85, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (41, 'Fussilat', NULL, 54, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (42, 'Asy-Syura', NULL, 53, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (43, 'Az-Zukhruf', NULL, 89, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (44, 'Ad-Dukhan', NULL, 59, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (45, 'Al-Jasiyah', NULL, 37, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (46, 'Al-Ahqaf', NULL, 35, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (47, 'Muhammad', NULL, 38, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (48, 'Al-Fath', NULL, 29, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (49, 'Al-Hujuraat', NULL, 18, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (50, 'Qaf', NULL, 45, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (51, 'Az-Zariyat', NULL, 60, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (52, 'At-Tur', NULL, 49, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (53, 'An-Najm', NULL, 62, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (54, 'Al-Qamar', NULL, 55, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (55, 'Ar-Rahman', NULL, 78, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (56, 'Al-Waqi\'ah', NULL, 96, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (57, 'Al-Hadid', NULL, 29, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (58, 'Al-Mujadilah', NULL, 22, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (59, 'Al-Hasyr', NULL, 24, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (60, 'Al-Mumtahanah', NULL, 13, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (61, 'As-Saff', NULL, 14, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (62, 'Al-Jumuah', NULL, 11, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (63, 'Al-Munafiqun', NULL, 11, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (64, 'At-Taghabun', NULL, 18, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (65, 'At-Talaq', NULL, 12, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (66, 'At-Tahrim', NULL, 12, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (67, 'Al-Mulk', NULL, 30, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (68, 'Al-Qalam', NULL, 52, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (69, 'Al-Haqqah', NULL, 52, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (70, 'Al-Maarij', NULL, 44, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (71, 'Nuh', NULL, 28, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (72, 'Al-Jin', NULL, 28, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (73, 'Al-Muzzammil', NULL, 20, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (74, 'Al-Muddassir', NULL, 56, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (75, 'Al-Qiyamah', NULL, 40, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (76, 'Al-Insan', NULL, 31, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (77, 'Al-Mursalat', NULL, 50, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (78, 'An-Naba', NULL, 40, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (79, 'An-Naziat', NULL, 46, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (80, 'Abasa', NULL, 42, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (81, 'At-Taqwir', NULL, 29, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (82, 'Al-Infitor', NULL, 19, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (83, 'Al-Muthaffifin', NULL, 36, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (84, 'Al-Insyiqaq', NULL, 25, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (85, 'Al-Buruj', NULL, 22, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (86, 'At-Tariq', NULL, 17, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (87, 'Al-Ala', NULL, 19, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (88, 'Al-Ghasyiyah', NULL, 26, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (89, 'Al-Fajr', NULL, 30, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (90, 'Al-Balad', NULL, 20, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (91, 'Asy-Syams', NULL, 15, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (92, 'Al-Lail', NULL, 21, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (93, 'Ad-Duha', NULL, 11, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (94, 'Al-Insyirah', NULL, 8, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (95, 'At-Tin', NULL, 8, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (96, 'Al-Alaq', NULL, 19, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (97, 'Al-Qadr', NULL, 5, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (98, 'Al-Bayyinah', NULL, 8, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (99, 'Az-Zalzalah', NULL, 8, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (100, 'Al-Adiyat', NULL, 11, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (101, 'Al-Qariah', NULL, 11, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (102, 'At-Takasur', NULL, 8, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (103, 'Al-Asr', NULL, 3, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (104, 'Al-Humazah', NULL, 9, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (105, 'Al-Fiil', NULL, 5, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (106, 'Quraisy', NULL, 4, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (107, 'Al-Maun', NULL, 7, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (108, 'Al-Kausar', NULL, 3, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (109, 'Al-Kafirun', NULL, 6, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (110, 'An-Nasr', NULL, 3, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (111, 'Al-Lahab', NULL, 5, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (112, 'Al-Ikhlas', NULL, 4, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (113, 'Al-Falaq', NULL, 5, NULL, NULL, '', 1);
INSERT INTO `malquran` VALUES (114, 'An-Nas', NULL, 6, NULL, NULL, '', 1);
COMMIT;

-- ----------------------------
-- Table structure for master_mt
-- ----------------------------
DROP TABLE IF EXISTS `master_mt`;
CREATE TABLE `master_mt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL,
  `asset` varchar(50) NOT NULL,
  `kategori` int(11) NOT NULL,
  `jenis` enum('jasa','sparepart','checkup','others') DEFAULT NULL,
  `komponen` text,
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
  `HourMeter` double(17,2) unsigned DEFAULT '0.00',
  `user_modified` varchar(10) DEFAULT NULL,
  `user_add` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_mt
-- ----------------------------
BEGIN;
INSERT INTO `master_mt` VALUES (1, 'MT00001', '8985', 1, NULL, 'Ball Matic,Push Bottom Emergency Stop', 'tes', NULL, '2020-07-23', '2020-07-23', '2020-07-23', '2020-07-23', '36', NULL, 2, 0, 5220.00, NULL, 'serang', '2020-07-23 15:01:56', NULL);
INSERT INTO `master_mt` VALUES (2, 'MT00002', '3296', 1, NULL, 'Oli Regulator', 'ganti oli regulator', NULL, '2020-07-27', '2020-08-30', '2020-07-27', '2020-04-01', '15', NULL, 2, 0, 585.00, NULL, 'chamim', '2020-07-27 11:27:09', NULL);
INSERT INTO `master_mt` VALUES (3, 'MT00003', '3296', 1, NULL, 'Membran,Oli Regulator,Back-up', 'ganti mebran,oli regulator dan back-up', NULL, '2020-11-05', '2020-11-05', '2020-11-05', '2020-04-01', '15', NULL, 2, 0, 1170.00, NULL, 'chamim', '2020-07-27 11:45:00', NULL);
INSERT INTO `master_mt` VALUES (4, 'MT00004', '8031', 1, NULL, 'Filter Udara', 'Ganti filter udara', NULL, '2020-08-27', '2020-08-27', '2020-08-27', '2020-04-01', '15', NULL, 2, 0, 2031.00, 'chamim', 'chamim', '2020-08-27 08:31:33', '2020-08-27 08:49:14');
INSERT INTO `master_mt` VALUES (5, 'MT00005', '3562', 1, NULL, 'Membran', 'Membran', NULL, '2020-08-27', '2020-08-28', '2020-08-27', '2020-04-01', '15', NULL, 2, 0, 741.00, 'chamim', 'chamim', '2020-08-27 08:36:38', '2020-08-27 08:48:55');
INSERT INTO `master_mt` VALUES (6, 'MT00006', '3562', 1, NULL, 'Membran', 'Membran', NULL, '2020-08-27', '2020-08-28', '2020-08-27', '2020-04-01', '15', NULL, 2, 0, 741.00, 'chamim', 'chamim', '2020-08-27 08:38:02', '2020-08-27 08:48:46');
INSERT INTO `master_mt` VALUES (7, 'MT00007', '3562', 1, NULL, 'Membran', 'Membran', NULL, '2020-08-27', '2020-08-28', '2020-08-27', '2020-04-01', '15', NULL, 2, 0, 1481.00, 'chamim', 'chamim', '2020-08-27 09:13:43', '2020-08-27 09:14:17');
INSERT INTO `master_mt` VALUES (8, 'MT00008', '2861', 1, NULL, 'Ban Forklift Depan', 'k', NULL, '2020-08-27', '2020-08-27', '2020-08-27', '2020-04-01', '4', 'Effie', 2, 0, 3735.00, 'ibra', 'ibra', '2020-08-27 10:17:54', '2020-08-27 10:18:05');
INSERT INTO `master_mt` VALUES (9, 'MT00009', '2861', 1, NULL, 'Ban Forklift Depan', 'm', NULL, '2020-08-27', '2020-08-27', '2020-08-27', '2020-04-01', '15', 'Effie', 2, 0, 3735.00, 'ibra', 'ibra', '2020-08-27 10:18:42', '2020-08-27 10:18:52');
INSERT INTO `master_mt` VALUES (10, 'MT00010', '2861', 1, NULL, 'Ban Forklift Depan', 'k', NULL, '2020-08-27', '2020-08-28', '2020-08-27', '2020-04-01', '17', 'Effie', 2, 0, 3735.00, 'ibra', 'ibra', '2020-08-27 10:19:13', '2020-08-27 10:19:26');
INSERT INTO `master_mt` VALUES (11, 'MT00011', '2861', 1, NULL, 'Filter Oli Mesin', 'asdas', NULL, '2020-09-15', '2020-09-16', NULL, '2020-08-27', '8', 'Effie', 1, 0, 3735.00, NULL, 'ibra', '2020-09-15 13:41:47', NULL);
COMMIT;

-- ----------------------------
-- Table structure for mdaerah
-- ----------------------------
DROP TABLE IF EXISTS `mdaerah`;
CREATE TABLE `mdaerah` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_daerah` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mdaerah
-- ----------------------------
BEGIN;
INSERT INTO `mdaerah` VALUES (1, 'Surabaya Timur', NULL, '2020-09-19 17:12:37', 1, 'ibra');
INSERT INTO `mdaerah` VALUES (2, 'as', NULL, NULL, 1, NULL);
COMMIT;

-- ----------------------------
-- Table structure for mdapukan
-- ----------------------------
DROP TABLE IF EXISTS `mdapukan`;
CREATE TABLE `mdapukan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_dapukan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mdapukan
-- ----------------------------
BEGIN;
INSERT INTO `mdapukan` VALUES (1, 'ASDASD', 'QASDAS', NULL, '2020-09-19 22:39:11', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (2, 'Ketua Mu', 'ketua m', '2020-02-07 06:44:19', '2020-09-19 22:39:22', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (3, 'asd', 'asd', '2020-02-07 08:45:24', '2020-09-19 22:39:19', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (4, 'ASD', 'ASD', NULL, '2020-09-19 22:39:14', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (5, 'Sekertaris', 'asdasd', '2020-02-07 21:48:16', '2020-09-19 22:39:09', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (6, 'PPG', 'ADASD', '2020-02-07 23:16:28', '2020-09-19 22:39:16', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (7, 'Ketua Muda Mudi', 'SIdosermo', '2020-04-10 21:27:53', '2020-09-19 22:39:06', 0, 'ibra');
INSERT INTO `mdapukan` VALUES (8, 'MUBALIGH', 'MUBALIGH KELOMPOK', '2020-09-19 22:38:54', '2020-09-27 20:51:07', 1, 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for mdesa
-- ----------------------------
DROP TABLE IF EXISTS `mdesa`;
CREATE TABLE `mdesa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_desa` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mdesa
-- ----------------------------
BEGIN;
INSERT INTO `mdesa` VALUES (1, 'Desa Barat', '2020-09-19 18:25:36', '2020-09-19 18:25:36', 1, 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for media_library
-- ----------------------------
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

-- ----------------------------
-- Records of media_library
-- ----------------------------
BEGIN;
INSERT INTO `media_library` VALUES (0, 'noprofileimage', 'png', 'img/noprofileimage.png', '1159', 1, '2017-05-30 02:56:03', '2017-05-30 02:56:03');
COMMIT;

-- ----------------------------
-- Table structure for mhadist
-- ----------------------------
DROP TABLE IF EXISTS `mhadist`;
CREATE TABLE `mhadist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_hadist` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_halaman` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mhadist
-- ----------------------------
BEGIN;
INSERT INTO `mhadist` VALUES (1, 'K.Busholah', 151, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (2, 'K.Nawafil', 98, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (3, 'K.Dawat', 65, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (4, 'K.Adab', 96, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (5, 'K.Janaiz', 79, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (6, 'K.Jannah Wannar', 84, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (7, 'K.Shoum', 98, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (8, 'K.Haji', 111, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (9, 'K.Manasikil Hajji', 113, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (10, 'K.Ahkam', 124, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (11, 'K.Adilah', 96, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (12, 'K.Imaroh', 102, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (13, 'Khotbah', 152, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (14, 'K.Imaroh Kanzil Umal', 121, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (15, 'K.Manasikil Waljihad', 51, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (16, 'K.Faroidh', 133, NULL, NULL, NULL, 1);
INSERT INTO `mhadist` VALUES (17, 'K.Jihad', 63, NULL, NULL, NULL, 1);
COMMIT;

-- ----------------------------
-- Table structure for mkelompok
-- ----------------------------
DROP TABLE IF EXISTS `mkelompok`;
CREATE TABLE `mkelompok` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_desa` int(10) unsigned DEFAULT NULL,
  `id_daerah` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `desa` (`id_desa`),
  KEY `daerah` (`id_daerah`),
  CONSTRAINT `mkelompok_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `mdesa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mkelompok_ibfk_2` FOREIGN KEY (`id_daerah`) REFERENCES `mdaerah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mkelompok
-- ----------------------------
BEGIN;
INSERT INTO `mkelompok` VALUES (7, 'Kendangsari', 1, 1, '2020-09-19 22:57:21', '2020-11-28 12:59:59', 1, 'ibra');
INSERT INTO `mkelompok` VALUES (8, 'tes', 1, 2, '2020-09-19 23:06:09', '2020-09-19 23:06:12', 0, 'ibra');
INSERT INTO `mkelompok` VALUES (9, 'Sidosermo Utara', 1, 1, '2020-09-19 23:12:39', '2020-09-19 23:12:39', 1, 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for mmasjid
-- ----------------------------
DROP TABLE IF EXISTS `mmasjid`;
CREATE TABLE `mmasjid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_masjid` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelompok` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `desa` (`id_kelompok`),
  CONSTRAINT `mmasjid_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `mkelompok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of mmasjid
-- ----------------------------
BEGIN;
INSERT INTO `mmasjid` VALUES (10, 'tess', 7, '2020-11-28 12:49:45', '2020-11-28 12:55:15', 0, 'ibra');
INSERT INTO `mmasjid` VALUES (11, 'Masjid Nasrullah', 7, '2020-11-28 12:51:12', '2020-11-28 12:59:47', 1, 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for modules
-- ----------------------------
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

-- ----------------------------
-- Records of modules
-- ----------------------------
BEGIN;
INSERT INTO `modules` VALUES (1, 'Master User Level', 'users-level', 1, 1, '2017-10-17 14:07:07', '2017-10-17 14:43:43');
INSERT INTO `modules` VALUES (2, 'Master User', 'users-user', 1, 1, '2017-10-17 14:16:51', '2017-10-17 14:49:30');
INSERT INTO `modules` VALUES (3, 'Media Library', 'media-library', 1, 1, '2017-10-17 14:19:28', '2018-06-03 12:40:18');
COMMIT;

-- ----------------------------
-- Table structure for mpengajian
-- ----------------------------
DROP TABLE IF EXISTS `mpengajian`;
CREATE TABLE `mpengajian` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengajian` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `user_modified` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mpengajian
-- ----------------------------
BEGIN;
INSERT INTO `mpengajian` VALUES (2, 'Caberawit', '2020-11-28 09:50:30', '2020-11-28 09:50:30', 1, 'ibra');
INSERT INTO `mpengajian` VALUES (3, 'Muda Mudi', '2020-11-28 09:52:03', '2020-11-28 09:52:03', 1, 'ibra');
INSERT INTO `mpengajian` VALUES (4, 'Kelompok', '2020-11-28 09:52:11', '2020-11-28 09:52:11', 1, 'ibra');
INSERT INTO `mpengajian` VALUES (5, 'Mubalight', '2020-11-28 09:52:31', '2020-11-28 09:52:31', 1, 'ibra');
INSERT INTO `mpengajian` VALUES (6, 'Text', '2020-11-28 09:55:50', '2020-11-28 12:01:33', 1, 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for msiswa
-- ----------------------------
DROP TABLE IF EXISTS `msiswa`;
CREATE TABLE `msiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` int(10) unsigned DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_nikah` int(1) DEFAULT '0',
  `telp_murid` int(20) DEFAULT NULL,
  `id_kelompok` int(10) unsigned NOT NULL,
  `pendidikan` int(1) DEFAULT NULL,
  `sekolah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `walimurid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_wali` int(20) DEFAULT NULL,
  `alamat_wali` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_wali` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dapukan` int(10) unsigned DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `user_modified` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelompok` (`id_kelompok`) USING BTREE,
  KEY `id_dapukan` (`id_dapukan`) USING BTREE,
  CONSTRAINT `msiswa_ibfk_1` FOREIGN KEY (`id_kelompok`) REFERENCES `mkelompok` (`id`) ON DELETE CASCADE,
  CONSTRAINT `msiswa_ibfk_2` FOREIGN KEY (`id_dapukan`) REFERENCES `mdapukan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of msiswa
-- ----------------------------
BEGIN;
INSERT INTO `msiswa` VALUES (1, 'asdsadasd', '2020-09-27', 'P', 3, 'alamat', 'aliansyah@gmail.com', 1, 123123, 7, 3, 'asdsad', NULL, 'ayaj paijo', 2147483647, 'asd', '123213123@gmail.com', 8, 1, 'ibra', '2020-09-26 12:58:23', '2020-09-27 20:52:19');
INSERT INTO `msiswa` VALUES (2, 'yayanx', '2020-09-19', 'P', 5, 'kensax', 'aliansyah@gmail.comx', 1, 123134, 9, 5, 'abcdx', 'defhgx', 'paijox', 123125555, 'asdx', '123213123@gmail.comx', 8, 1, 'ibra', '2020-09-26 13:04:55', '2020-09-27 21:33:51');
INSERT INTO `msiswa` VALUES (3, 'COBA SUKSESNTAP', '2020-09-17', 'L', 3, 'ADASDX', 'aliansyahXX@gmail.co', 0, 12312344, 7, 4, 'UNTAGX', 'INFORMATIKAX', 'paijoX', 1251512, 'asdX', '123213123@gmail.comXX', 8, 1, 'ibra', '2020-09-26 13:08:18', '2020-09-27 20:45:35');
INSERT INTO `msiswa` VALUES (4, 'cak leg', '2020-11-28', 'L', 1, 'asdasdasd', 'aliansyah@gmail.com', 0, 1232312, 7, 4, 'asdasd', '123', 'tesss', 1231231, 'asdasdasd', '123213123@gmail.com', 8, 1, 'ibra', '2020-11-28 20:45:49', '2020-11-28 20:45:49');
INSERT INTO `msiswa` VALUES (5, 'john', '2020-11-29', 'L', 3, 'tes alamat', 'iniemail@gmail.com', 0, 2147483647, 7, 1, 'UNTAG', 'INFORMATIKAX', NULL, NULL, NULL, NULL, 8, 1, 'ibra', '2020-11-29 18:50:00', '2020-11-29 18:50:00');
INSERT INTO `msiswa` VALUES (6, 'cena', '2020-11-29', 'L', 5, 'adasd', 'aliansyah@gmail.com', 0, 123123, 9, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ibra', '2020-11-29 18:53:29', '2020-11-29 18:53:29');
INSERT INTO `msiswa` VALUES (7, 'undertaker', '2020-11-29', 'P', 5, 'ini alamat lo ya', 'iniemail@gmail.com', 0, 2147483647, 7, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ibra', '2020-11-29 18:56:05', '2020-12-25 13:16:16');
INSERT INTO `msiswa` VALUES (8, 'therock', '2020-12-24', 'L', 5, 'asd', 'aliansyah@gmail.com', 0, 12312, 7, 2, 'asdasd', 'asdsad', 'asd', 12312, 'asdas', '123213123@gmail.com', 8, 1, 'ibra', '2020-12-24 13:49:23', '2020-12-25 13:16:00');
COMMIT;

-- ----------------------------
-- Table structure for pic
-- ----------------------------
DROP TABLE IF EXISTS `pic`;
CREATE TABLE `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `seksi` int(1) NOT NULL,
  `cabangid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pic
-- ----------------------------
BEGIN;
INSERT INTO `pic` VALUES (1, 'M Nasrodin', 1, 2, 1, '2020-07-20 10:37:49', '2020-07-20 10:28:44', 'ibra');
INSERT INTO `pic` VALUES (2, 'tes', 0, 3, NULL, '2020-07-20 10:31:13', '2020-07-20 10:29:51', 'ibra');
INSERT INTO `pic` VALUES (3, 'M Sugiharto', 1, 2, 1, '2020-07-20 10:49:55', '2020-07-20 10:48:32', 'ibra');
INSERT INTO `pic` VALUES (4, 'Apit Fidianto', 1, 2, 1, '2020-07-20 11:14:12', '2020-07-20 11:14:12', 'ibra');
INSERT INTO `pic` VALUES (5, 'Ach Nurul Abdillah', 1, 2, 1, '2020-07-20 11:16:47', '2020-07-20 11:16:47', 'ibra');
INSERT INTO `pic` VALUES (6, 'Fendi Widodo', 1, 2, 1, '2020-07-20 11:23:06', '2020-07-20 11:23:06', 'ibra');
INSERT INTO `pic` VALUES (7, 'Bayu Pratama', 1, 2, 1, '2020-07-20 11:23:21', '2020-07-20 11:23:21', 'ibra');
INSERT INTO `pic` VALUES (8, 'Agung Dwi Hartanto', 1, 2, 1, '2020-07-20 11:23:35', '2020-07-20 11:23:35', 'ibra');
INSERT INTO `pic` VALUES (9, 'Yanu Trio Widianto', 1, 2, 1, '2020-07-20 11:23:51', '2020-07-20 11:23:51', 'ibra');
INSERT INTO `pic` VALUES (10, 'Andre Stristyo', 1, 2, 1, '2020-07-20 11:24:05', '2020-07-20 11:24:05', 'ibra');
INSERT INTO `pic` VALUES (11, 'M Heru', 1, 2, 1, '2020-07-20 11:24:13', '2020-07-20 11:24:13', 'ibra');
INSERT INTO `pic` VALUES (12, 'Alan Dwi Ardianyah', 1, 2, 1, '2020-07-20 11:24:26', '2020-07-20 11:24:26', 'ibra');
INSERT INTO `pic` VALUES (13, 'Reski Fajar Prakasa', 1, 2, 1, '2020-07-20 11:24:46', '2020-07-20 11:24:46', 'ibra');
INSERT INTO `pic` VALUES (14, 'Riski Hidayat', 1, 2, 1, '2020-07-20 11:24:56', '2020-07-20 11:24:56', 'ibra');
INSERT INTO `pic` VALUES (15, 'Harmanto', 1, 1, 1, '2020-07-20 11:25:12', '2020-07-20 11:25:12', 'ibra');
INSERT INTO `pic` VALUES (16, 'Mardiono', 1, 1, 1, '2020-07-20 11:25:26', '2020-07-20 11:25:26', 'ibra');
INSERT INTO `pic` VALUES (17, 'Moch Nurul Huda', 1, 1, 1, '2020-07-20 11:25:39', '2020-07-20 11:25:39', 'ibra');
INSERT INTO `pic` VALUES (18, 'Salman Farisi', 1, 1, 1, '2020-07-20 11:26:03', '2020-07-20 11:26:03', 'ibra');
INSERT INTO `pic` VALUES (19, 'Dedik Setyawan', 1, 1, 1, '2020-07-20 11:26:22', '2020-07-20 11:26:22', 'ibra');
INSERT INTO `pic` VALUES (20, 'Ahmad Badrus', 1, 1, 1, '2020-07-20 11:26:34', '2020-07-20 11:26:34', 'ibra');
INSERT INTO `pic` VALUES (21, 'Rino Aji Kurniawan', 1, 1, 1, '2020-07-20 11:26:47', '2020-07-20 11:26:47', 'ibra');
INSERT INTO `pic` VALUES (22, 'Muh. Zulfi H', 1, 1, 1, '2020-07-20 11:27:01', '2020-07-20 11:27:01', 'ibra');
INSERT INTO `pic` VALUES (23, 'Agus Prasetyo', 1, 1, 1, '2020-07-20 11:27:12', '2020-07-20 11:27:12', 'ibra');
INSERT INTO `pic` VALUES (24, 'Tasriful Ruchiyat Guntur', 1, 1, 1, '2020-07-20 11:27:30', '2020-07-20 11:27:30', 'ibra');
INSERT INTO `pic` VALUES (25, 'Sutrisno B', 1, 1, 1, '2020-07-20 11:27:46', '2020-07-20 11:27:46', 'ibra');
INSERT INTO `pic` VALUES (26, 'Hani Trihandoko', 1, 1, 1, '2020-07-20 11:28:04', '2020-07-20 11:28:04', 'ibra');
INSERT INTO `pic` VALUES (27, 'Choirul', 1, 1, 1, '2020-07-20 11:28:17', '2020-07-20 11:28:17', 'ibra');
INSERT INTO `pic` VALUES (28, 'Randi Agung S', 1, 3, 1, '2020-07-20 11:29:58', '2020-07-20 11:28:36', 'ibra');
INSERT INTO `pic` VALUES (29, 'Medi Heri P', 1, 3, 1, '2020-07-20 11:28:47', '2020-07-20 11:28:47', 'ibra');
INSERT INTO `pic` VALUES (30, 'Agung Budi', 1, 3, 1, '2020-07-20 11:28:59', '2020-07-20 11:28:59', 'ibra');
INSERT INTO `pic` VALUES (31, 'Dany Firmansyah', 1, 3, 1, '2020-07-20 11:29:11', '2020-07-20 11:29:11', 'ibra');
INSERT INTO `pic` VALUES (32, 'Widi Kurniawan', 1, 3, 1, '2020-07-20 11:29:23', '2020-07-20 11:29:23', 'ibra');
INSERT INTO `pic` VALUES (33, 'Riza Mugianto', 1, 3, 1, '2020-07-20 11:37:44', '2020-07-20 11:36:22', 'ibra');
INSERT INTO `pic` VALUES (34, 'Wawan Sulistyo', 1, 2, 1, '2020-07-20 11:31:21', '2020-07-20 11:31:21', 'ibra');
INSERT INTO `pic` VALUES (35, 'Sukidal', 1, 2, 2, '2020-07-20 14:40:09', '2020-07-20 14:40:09', 'serang');
INSERT INTO `pic` VALUES (36, 'Imam Satori', 1, 1, 2, '2020-07-20 14:40:28', '2020-07-20 14:40:28', 'serang');
INSERT INTO `pic` VALUES (37, 'Mulyono', 1, 3, 2, '2020-07-20 14:40:44', '2020-07-20 14:40:44', 'serang');
INSERT INTO `pic` VALUES (38, 'adsasd', 1, 1, 1, '2020-09-19 10:33:15', '2020-09-19 10:33:15', 'ibra');
INSERT INTO `pic` VALUES (39, 'agahah', 2, 1, 2, '2020-09-19 10:41:00', '2020-09-19 10:41:00', 'ibra');
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` text,
  `user_modified` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES (1, 'web_title', 'SIM PPG', 'Ibra', '2017-06-13 07:27:16', '2020-09-19 11:30:57');
INSERT INTO `settings` VALUES (2, 'logo', 'img/logo.png', '1', '2017-06-13 07:27:16', '2018-06-03 12:58:24');
INSERT INTO `settings` VALUES (3, 'email_admin', 'admin@admin.com', 'Oei Donny', '2017-06-13 07:27:16', '2019-08-02 09:18:38');
INSERT INTO `settings` VALUES (4, 'web_description', '', 'Ibra', '2017-07-24 06:56:28', '2020-03-09 11:20:54');
COMMIT;

-- ----------------------------
-- Table structure for user_levels
-- ----------------------------
DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE `user_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `active` int(1) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_levels
-- ----------------------------
BEGIN;
INSERT INTO `user_levels` VALUES (1, 'Super Admin', 1, 1, '2017-06-28 13:18:17', '2017-06-28 13:18:17');
INSERT INTO `user_levels` VALUES (2, 'Admin', 1, 1, '2018-06-02 22:59:51', '2018-06-02 22:59:51');
INSERT INTO `user_levels` VALUES (3, 'User', 1, 1, '2018-06-03 11:19:49', '2018-06-03 11:19:49');
COMMIT;

-- ----------------------------
-- Table structure for user_login
-- ----------------------------
DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` text,
  `tipe` varchar(10) DEFAULT NULL,
  `user_level` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `kelompok` text,
  `telp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(15) NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_login
-- ----------------------------
BEGIN;
INSERT INTO `user_login` VALUES (1, 'donny', NULL, 'AD', 'VSUPER', 'Donny', 'it_2@avianbrands.com', '[\"7\"]', 0, '2020-03-02 07:55:51', '2020-07-08 10:06:33', '', '2020-07-08 10:06:33');
INSERT INTO `user_login` VALUES (3, 'ibra', 'e10adc3949ba59abbe56e057f20f883e', 'AGEN', 'VSUPER', 'Ibra', 'it_3@avianbrands.com', '[\"7\",\"9\"]', 41, '2020-03-02 09:50:56', '2021-01-20 21:59:38', 'ibra', '2021-01-20 21:59:38');
INSERT INTO `user_login` VALUES (6, 'test', '827ccb0eea8a706c4c34a16891f84e7b', 'AGEN', 'USER', 'asd', 'asdasd@gmail.com', '[\"7\"]', 123123, '2020-03-02 16:20:46', '2020-03-11 11:36:15', 'ibra', NULL);
INSERT INTO `user_login` VALUES (39, 'testx', '827ccb0eea8a706c4c34a16891f84e7b', 'AGEN', 'USER', 'asdsad', 'tes@gmail.com', '[\"7\"]', 123123, '2021-01-17 19:05:58', '2021-01-17 19:05:58', 'ibra', NULL);
INSERT INTO `user_login` VALUES (40, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'AGEN', 'USER', 'asdsad', 'tes@gmail.com', '[\"7\"]', 123, '2021-01-17 20:08:48', '2021-01-17 20:17:24', 'ibra', NULL);
INSERT INTO `user_login` VALUES (41, 'londo', '827ccb0eea8a706c4c34a16891f84e7b', 'AGEN', 'VADM', 'londo', 'londo@gmail.com', '[\"7\",\"9\",\"10\"]', 123123123, '2021-01-17 21:33:31', '2021-01-20 22:39:14', 'ibra', '2021-01-20 22:39:14');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` text,
  `phone` text,
  `gender` enum('male','female','other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 1, 'Super', 'Admin', 0, 'superadmin@admin.com', 'Jl Madura xxxxxxx', '08383xxxxxxx', 'male', '1986-07-25', 'superadmin', '$2y$10$TkX/dDYrtvIEXidPOag5T.V8qbyluUHJg5ssBjKe6WlVqpItuN8uy', 1, 1, '2019-01-03 10:54:50', '2017-03-14 03:51:35', '2019-01-03 10:54:50');
INSERT INTO `users` VALUES (2, 2, 'Admin', 'Admin', 0, 'admin@admin.com', NULL, NULL, 'male', NULL, 'admin', '$2y$10$PQaUY4b0YsSo5qAuK8Cc.OB.WeEJHrJJ0FDgk6YE9xhXboVRou3We', 1, 1, '2019-01-02 10:17:02', '2017-04-19 21:29:01', '2019-01-02 10:17:02');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
