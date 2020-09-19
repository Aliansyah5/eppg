SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `aviaticket`
--




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


INSERT INTO access_control VALUES
("1","1","1","a","1","2018-10-10 09:28:44","2018-10-10 09:28:44"),
("2","1","2","a","1","2018-10-10 09:28:44","2018-10-10 09:28:44"),
("3","1","3","a","1","2018-10-10 09:28:44","2018-10-10 09:28:44"),
("4","2","1","a","1","2018-10-10 09:28:49","2018-10-10 09:28:49"),
("5","2","2","a","1","2018-10-10 09:28:49","2018-10-10 09:28:49"),
("6","2","3","a","1","2018-10-10 09:28:49","2018-10-10 09:28:49"),
("7","3","1","v","1","2018-10-10 09:28:54","2018-10-10 09:28:54"),
("8","3","2","v","1","2018-10-10 09:28:54","2018-10-10 09:28:54"),
("9","3","3","v","1","2018-10-10 09:28:54","2018-10-10 09:28:54");




CREATE TABLE `assignee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(45) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO assignee VALUES
("1","adi","2019-09-06 15:37:27","2019-09-06 15:37:27","donny","1"),
("2","ysa","2019-09-06 15:37:37","2019-09-06 15:37:37","donny","1"),
("3","agus","2019-09-06 15:37:45","2019-09-06 15:37:45","donny","1"),
("4","alvin","2019-09-06 15:37:50","2019-09-06 15:37:50","donny","1"),
("5","deviana","2019-09-06 15:37:57","2019-09-06 15:37:57","donny","1"),
("6","donny","2019-09-06 15:38:03","2019-09-06 15:38:03","donny","1"),
("7","nat","2019-09-06 15:38:10","2019-09-06 15:38:10","donny","1"),
("8","noel","2019-09-06 15:38:15","2019-09-06 15:38:15","donny","1"),
("9","paulus","2019-09-06 15:38:20","2019-09-06 15:38:20","donny","1"),
("10","gunadisan","2019-09-06 15:38:25","2019-09-06 15:38:25","donny","1");




CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO category VALUES
("1","Report Macro","1","2019-08-06 08:33:03","2019-08-06 08:33:03","donny"),
("2","Hardware","1","2019-08-06 09:23:48","2019-08-06 08:55:59","donny"),
("3","Lain - lain","1","2019-08-27 09:30:11","2019-08-27 08:54:35","donny");




CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `comment` text NOT NULL,
  `type` enum('log','comment') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `attachment` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;


INSERT INTO comment VALUES
("1","acc07","Mohon info estimasi penyelesaian","comment","2019-09-19 09:22:52","2019-09-19 09:22:52","1",""),
("2","noel","Estimasi sesuai di email","comment","2019-09-19 09:24:38","2019-09-19 09:24:38","1",""),
("3","noel","Sudah dibuatkan report maco sesuai dengan permintaan.\nNama File : SO Tonase - Value\nSheet : Sales Shipment\nParameter :\nBgn Date \nEnd Date\nFormat :\nCompany | Branch | Customer | Date | Code | Amount Include VAT | Tonase GW","comment","2019-09-19 16:12:31","2019-09-19 16:12:31","4",""),
("4","noel","Pada report macro sudah ditambahkan informasi status SPK\nstatus SPK : Released / Finished","comment","2019-09-20 16:03:37","2019-09-20 16:03:37","5",""),
("5","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\nNama File : PR to Invoice\nSheet : PO - Invoice Price\nParameter :\nCompany \nBranch\nBgn Date PO\nEnd Date PO\n\nFormat :\nBranch | PO | Order Date | Vendor No | Vendor Name | Line No | Item No | Description | PO Qty | Uom | PO Price | Invoice No | Inv Qty | Inv Price","comment","2019-09-20 17:30:58","2019-09-20 17:30:58","2",""),
("6","noel","Ditambahkan Kolom selisih Qty PO dan Qty Inv\nDitambahkan kolom selisih Price PO dan Price Inv","comment","2019-09-20 18:00:47","2019-09-20 18:00:47","2",""),
("7","noel","Report","comment","2019-09-20 18:01:40","2019-09-20 18:01:40","2",""),
("8","noel","Sudah dibuatkan report sesuai dengan permintaan.\nNama File : SPK Actual Consum - Pipa\n\nFilter :\nBranch : ALL, IPC, IPW\nPeriod : bgn Date / end Date\nStatus : ALL / Released / Finished\nVariance : (input number)\nRemark : ALL / CEK\n\nFormat : \nProduction No | Status | Line No | Prod Item | Inv Post Group | Output |  Output (converted) | Material Group | Material Code | Qty Bom | Qty Actual | Variance | Variance % | Tolerance | Remark\nLocation\nItem No\nOrder No","comment","2019-09-24 14:57:21","2019-09-24 14:57:21","1",""),
("9","ysa","pak, sudah bisa ya, tolong dicoba lagi. terima kasih.","comment","2019-09-27 09:52:53","2019-09-27 09:52:53","11",""),
("10","noel","Dear Pak Budi.\nSaat ini sistem NAV tidak mencatat waktu produksi melalukan request ke RnD untuk approve SPK.","comment","2019-10-02 06:25:49","2019-10-02 06:25:49","14",""),
("11","adi","apakah tdk lebih baik Report makro Konsensi Inc Inspectionnya diberi pilihan Konsesi / Diterima / All ?\n( sehingga 1 report bs mengakomodasi ketiganya )","comment","2019-10-03 11:39:38","2019-10-03 11:39:38","16",""),
("12","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\nNama File : Mutasi Persediaan.\nLokasi :  Z - PUSAT - ACCOUNTING - REPORT MACRO\n\nParameter : \nCompany\nFrom  -  To\nBgn Date   - End Date\nInv Post Group\n\nFormat :\nGen Prod Post Group |  Item | Description | Uom | Qty | Amount","comment","2019-10-03 14:07:57","2019-10-03 14:07:57","10",""),
("13","noel","Dear Pak Budi,\nSetelah dipertimbangkan, untuk sistem saat ini tidak memungkinkan untuk ditambahkan penanda waktu approval oleh RnD.","comment","2019-10-07 17:09:19","2019-10-07 17:09:19","14",""),
("14","nat","lg dikerjakan","comment","2019-10-09 10:11:24","2019-10-09 10:11:24","17",""),
("15","nat","sudah selesai","comment","2019-10-09 10:38:42","2019-10-09 10:38:42","17",""),
("16","nat","lg dikerjakan","comment","2019-10-09 14:29:33","2019-10-09 14:29:33","18",""),
("17","nat","sudah di pindah","comment","2019-10-10 14:49:04","2019-10-10 14:49:04","20",""),
("18","noel","Format yang diminta :\nKode Item | Description | Qty on Hand | Outstanding Qty PO | Outstanding Qty SO","comment","2019-10-11 09:22:37","2019-10-11 09:22:37","21",""),
("19","noel","Sudah dibuatkan modul Claim di program Logistic.","comment","2019-10-11 09:23:39","2019-10-11 09:23:39","3",""),
("20","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\n\nAda penambahan kolom Uom\n\nsemua quantity ditampilkan dalam satuan terkecil","comment","2019-10-11 14:45:09","2019-10-11 14:45:09","21",""),
("21","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\n\nAda penambahan kolom Uom\n\nsemua quantity ditampilkan dalam satuan terkecil","comment","2019-10-11 14:46:33","2019-10-11 14:46:33","21",""),
("22","ysa","sudah selesai dikerjakan dan diberikan ke Pak Tian","comment","2019-10-16 14:46:58","2019-10-16 14:46:58","22",""),
("23","nat","sudah di pindah","comment","2019-10-18 13:08:03","2019-10-18 13:08:03","23",""),
("24","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\nAda tambahan sheet baru. Per Shift.","comment","2019-10-21 08:31:46","2019-10-21 08:31:46","19",""),
("25","noel","Parameter report berubah menjadi :\nBranch\nBegin Date\nEnd Date\nLocation","comment","2019-10-21 08:32:36","2019-10-21 08:32:36","19",""),
("26","noel","Dibuatkan program untuk input Down time dan reject oleh admin produksi pipa.","comment","2019-10-21 08:33:30","2019-10-21 08:33:30","19",""),
("27","scm02","Sheet Per Shift, yang dalam Persen apakah bisa diubah menjadi format % dengan 1 angka di belakang koma?\n\nSheet summary yang langsung menunjukkan 1 bulan masih belum ada, jadi filter date nya langsung bulan bukan tanggal, kolom date dan shift tidak usah ditampilkan.","comment","2019-10-21 08:47:29","2019-10-21 08:47:29","19",""),
("28","nat","ok","comment","2019-10-25 09:51:23","2019-10-25 09:51:23","26",""),
("29","noel","Sudah dibuatkan report macro sesuai dengan permintaan.\nNama report macro : Rollback Item Stock\nParameter :\nBgn Date\nEnd Date\nLocation\nBin\n\nFormat :\nInventory Posting Group | Date | Location | Bin | Item No | Uom | Bgn Qty | Bgn Amount | End Qty | End Amount","comment","2019-10-28 08:10:09","2019-10-28 08:10:09","12",""),
("30","nat","diproses","comment","2019-10-28 15:46:15","2019-10-28 15:46:15","27",""),
("31","noel","Report macro sudah dimodifikasi sesuai dengan permintaan.","comment","2019-10-30 17:43:44","2019-10-30 17:43:44","28",""),
("32","noel","Ditambahkan sheet baru dengan format yang sudah disesuaikan dengan permintaan.","comment","2019-10-30 17:44:34","2019-10-30 17:44:34","28",""),
("33","nat","on proses","comment","2019-10-31 08:59:55","2019-10-31 08:59:55","30",""),
("34","noel","Sudah dibuatkan report maco sesuai dengan permintaan.\nNama Report Macro : Stock Opname Packaging\nParameter : \nBgn Date\nEnd Date\n\nFormat : \nItem | Description | Location | Transfer IN | Stock | Production FG","comment","2019-10-31 16:33:57","2019-10-31 16:33:57","24",""),
("35","noel","Dibuatkan program untuk membandingkan data WMS dan NAV.","comment","2019-11-01 13:04:48","2019-11-01 13:04:48","13",""),
("36","nat","untuk yg item 02LL-TRHI tdk bisa di ubah pur. unit of measure nya karna UOM nya hanya ada BALL","comment","2019-11-05 16:11:27","2019-11-05 16:11:27","31",""),
("37","donny","Username rdp06 untuk Avia Ticket sudah ditambahkan Bu.\nTerima kasih","comment","2019-11-07 08:25:00","2019-11-07 08:25:00","35",""),
("38","adi","Spek Notebook HP14S-cf0045tx. permintaan sama dengan no RDP05-1911-00002 tgl 7 Nop 2019. Kami akan tindak lanjuti dengan PP ke Purchasing utk notebook dan speakernya","comment","2019-11-07 14:19:15","2019-11-07 14:19:15","37",""),
("39","adi","Spek Notebook HP14S-cf0045tx. permintaan sama dengan no RDP06-1911-00001 tgl 7 Nop 2019. Kami akan tindak lanjuti dengan PP ke Purchasing utk notebook dan speakernya ( PP-AAP-1911-00064 tgl 7 Nop 2019 )","comment","2019-11-07 14:57:40","2019-11-07 14:57:40","36",""),
("40","rdp05","Laptop belum diterima, proses penutupan ditolak.","comment","2019-11-07 22:32:00","2019-11-07 22:32:00","36",""),
("41","adi","Dept IT sudah menidaklanjuti dengan PP-AAP-1911-00064 tgl 7 Nop 2019. Proses approval PP sampai dengan Barang diterima di handle oleh Dept Purchasing.  ( perlu appr oleh GM, P Robert, penawaran dari vendor dan PO yang semuanya oleh Dept Purchasing ) yang tidak mungkin dalam waktu 3 hari, padahal app Ticket ini untuk pengukur KPI dari IT. bkn dept Purchasing.\n\nDemikian penjelasan dari IT","comment","2019-11-08 07:15:05","2019-11-08 07:15:05","36",""),
("42","noel","Sudah dibuatkan report sesuai dengan permintaan.\nReport digabung dengan report yang sudah ada yaitu Mutasi Stock Finish Good.xlsm\nDitambahkan sheet baru : Stock Mutation FG","comment","2019-11-12 07:24:12","2019-11-12 07:24:12","32","scm01-1911-00001-comment-12112019072412-Screenshot.jpg"),
("43","adi","Folder RND11 sdh di ganti menjadi RND11 Nastiti dan RND05 sdh diganti menjadi RND05 Angelica.","comment","2019-11-12 13:30:33","2019-11-12 13:30:33","39",""),
("44","adi","perpindahan user PSRG16 ke RDR02 ( files, profile Nav, akses folder server Nav & email ) sdh dilakukan.","comment","2019-11-12 16:37:53","2019-11-12 16:37:53","40",""),
("45","adi","mengubah prioritas dari 3H menjadi 9H","log","2019-11-12 16:47:50","2019-11-12 16:47:50","40","");




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


INSERT INTO media_library VALUES
("0","noprofileimage","png","img/noprofileimage.png","1159","1","2017-05-30 02:56:03","2017-05-30 02:56:03");




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


INSERT INTO modules VALUES
("1","Master User Level","users-level","1","1","2017-10-17 14:07:07","2017-10-17 14:43:43"),
("2","Master User","users-user","1","1","2017-10-17 14:16:51","2017-10-17 14:49:30"),
("3","Media Library","media-library","1","1","2017-10-17 14:19:28","2018-06-03 12:40:18");




CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `user_modified` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO settings VALUES
("1","web_title","AVIA Ticket","Oei Donny","2017-06-13 07:27:16","2019-08-02 09:18:38"),
("2","logo","img/logo.png","1","2017-06-13 07:27:16","2018-06-03 12:58:24"),
("3","email_admin","admin@admin.com","Oei Donny","2017-06-13 07:27:16","2019-08-02 09:18:38"),
("4","web_description","","Oei Donny","2017-07-24 06:56:28","2019-08-02 09:18:38");




CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `attachment_1` varchar(100) DEFAULT NULL,
  `attachment_2` varchar(100) DEFAULT NULL,
  `attachment_3` varchar(100) DEFAULT NULL,
  `prioritas` varchar(45) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `assignee` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_jawab` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `active` int(1) NOT NULL,
  `no_ticket` varchar(45) DEFAULT NULL,
  `user_request_close` varchar(45) DEFAULT NULL,
  `request_close_date` datetime DEFAULT NULL,
  `user_close` varchar(45) DEFAULT NULL,
  `close_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;


INSERT INTO ticket VALUES
("1","Report Actual consume (PIPA)","Dear Pak Noel\n\nMohon dibuatkan Report Actual consume (PIPA) yang sama dengan CAT\n\nTerimakasih","","","","9H","2019-09-19","noel","1","2019-09-19 09:16:28","2019-09-26 16:48:43","noel","noel","4","acc07","1","acc07-1909-00001","noel","2019-09-24 14:57:52","system","2019-09-26 16:48:43"),
("2","report Makro PO dan PI","Report untuk menampilkan item barang,harga satuan dan jumlah di PO secara item untuk dicompare dengan harga satuan yang ada di PI dari tagihan dari Suplier.","","","","9H","2019-09-19","noel","1","2019-09-19 09:32:45","2019-09-25 16:48:46","noel","noel","4","ina02","1","ina02-1909-00001","noel","2019-09-23 08:24:12","system","2019-09-25 16:48:46"),
("3","report claim penggantian barang jadi","report untuk pencatatan klaim akibat ada kecelakaan kerja yang merusakkan atau menjatuhkan semua stok barang jadi .","","","","9H","2019-10-08","noel","3","2019-09-19 09:38:36","2019-10-16 23:47:41","noel","noel","4","ina02","1","ina02-1909-00002","noel","2019-10-14 09:07:56","system","2019-10-16 23:47:41"),
("4","report macro","report macro tonase dan value untuk SJ, ditambah dengan periode waktu","","","","9H","2019-09-19","noel","1","2019-09-19 16:05:58","2019-09-21 23:48:58","noel","noel","4","mkt01","1","mkt01-1909-00001","noel","2019-09-19 16:12:47","system","2019-09-21 23:48:58"),
("5","Tambah kolom status di report actual consume","Dear Pak Noel\n\nMohon menambahkan kolom status di report actual consume\n\nTerimkasih","","","","3H","2019-09-20","noel","1","2019-09-20 13:08:10","2019-09-22 23:48:55","noel","noel","4","acc07","1","acc07-1909-00002","noel","2019-09-20 16:03:56","system","2019-09-22 23:48:55"),
("6","Edit data base NAV","Mohon edit data di database NAV\nPosting date : 19/09/2019\nDokumen no : RPOP-IPW-1909-01471\nItem no : POPIDDC0P040\nData yang dirubah : Kode mesin/Tangki\n                                 data existing : E16\n                                 dirubah menjadi : E15\n\nfile lampiran screen shoot  ada di serv 104 Z:/SHARE FOR ALL/AAIP/EDIT JURNAL.JPEG","","","","3H","2019-09-20","nat","3","2019-09-20 15:10:54","2019-09-22 23:48:59","nat","nat","4","pwtn04","1","pwtn04-1909-00001","nat","2019-09-20 15:42:54","system","2019-09-22 23:48:59"),
("7","Revisi Report Makro SO Update","Memunculkan Qty to Shipped\nSisa SO = Qty SO - Qty to Shipped - Qty Shipped","","","","3H","2019-09-23","noel","1","2019-09-20 16:36:21","2019-09-25 16:48:50","noel","noel","4","scm02","1","scm02-1909-00001","noel","2019-09-23 13:00:04","system","2019-09-25 16:48:50"),
("8","Injek kode item baru ke NAV","Mohon injek ke NAV terlampir","pwtn04-1909-00002-1-template item baru.xls","","","3H","2019-09-25","nat","3","2019-09-25 10:45:20","2019-09-26 09:24:15","nat","nat","4","pwtn04","1","pwtn04-1909-00002","nat","2019-09-25 11:20:45","pwtn04","2019-09-26 09:24:15"),
("9","Injek kode baru ke NAV","Mohon injek kode item baru terlampir\n\nnote : lampiran sheet inject dan sheet lain","pwtn04-1909-00003-1-template item baru.xls","","","3H","2019-09-27","nat","3","2019-09-26 09:26:42","2019-09-27 03:09:20","nat","nat","4","pwtn04","1","pwtn04-1909-00003","nat","2019-09-27 00:36:38","pwtn04","2019-09-27 03:09:20"),
("10","Macro Mutasi Persediaan Antar Cabang","Dear Pak Noel\n\nMohon dibuatkan Macro Mutasi Persediaan Antar Cabang (CAT/PIPA) format di Z ACC7 CS Cari Macro Mutasi Persediaan Antar Cabang, cara pengecekan untuk PIPA bisa membandingkan antara amount di macro dengan account persediaan barang jadi beda waktu (untuk FG).\n\nSalam\n\nJeffry","","","","9H","2019-09-30","noel","1","2019-09-27 02:05:39","2019-10-04 08:02:09","noel","noel","4","acc07","1","acc07-1909-00003","noel","2019-10-03 14:09:41","acc07","2019-10-04 08:02:09"),
("11","TKTW Peduli (Customer Care)","Ketika jalankan program TKTW Peduli,kemudian input nama cabang:\nmisalnya \"Palembang Selatan\"\nbegitu tekan enter, keluar error \"Could not read the file\"\ntekan enter lagi, keluar error \"No data exist for the row/column\"\nMohon bantuan. Terima kasih","","","","3H","2019-09-27","ysa","1","2019-09-27 09:37:57","2019-09-27 09:56:44","ysa","ysa","4","pwtn03","1","pwtn03-1909-00001","ysa","2019-09-27 09:53:23","pwtn03","2019-09-27 09:56:44"),
("12","Report Macro Roll Back Persediaan","Dear Pak Noel\n\nMohon Bantu untuk dipersiapkan Report Macro Roll Back Persediaan untuk kepentingan Audit.\n\nTerimakasih","","","","9H","2019-10-21","noel","1","2019-10-01 04:41:54","2019-10-30 23:46:57","noel","noel","4","acc07","1","acc07-1910-00001","noel","2019-10-28 08:10:43","system","2019-10-30 23:46:57"),
("13","report makro analisa BP antara WMS dengan NAV","report makro analisa BP antara WMS dengan NAV","","","","9H","2019-10-31","noel","3","2019-10-01 08:33:23","2019-11-08 23:46:29","noel","noel","4","ina02","1","ina02-1910-00001","noel","2019-11-06 15:52:03","system","2019-11-08 23:46:29"),
("14","Report Macro Tanggal Aprroval SPK","Tujuan pembuatan report macro ini untuk mengetahui gap waktu \n/tanggal antara permintaan approval SPK dari produksi dengan approval yang dilakukan oleh pihak RnD.","psdj01-1910-00001-1-Format Report Macro Approval.xlsx","","","9H","2019-10-07","noel","1","2019-10-02 03:19:16","2019-10-09 23:48:02","noel","noel","4","psdj01","1","psdj01-1910-00001","noel","2019-10-07 17:09:45","system","2019-10-09 23:48:02"),
("15","Revisi  Description2  NAV","Mohon di replace  description 2 item card sbb :\n\nKode : 01BB-PV1501C\nDescription 2  : A299P\n                         di revisi menjadi : A 229 P","","","","3H","2019-10-03","nat","3","2019-10-02 08:40:14","2019-10-05 23:48:15","nat","nat","4","pwtn04","1","pwtn04-1910-00001","nat","2019-10-03 00:53:59","system","2019-10-05 23:48:15"),
("16","Report Macro Laporan Inspection Raw Material","Bentuk tabel sama dengan laporan Inpection Konsesi, tapi yang ini ditampilkan semua baik konsesi maupun tdk konsesi\nreport di Z:Pusat/Purchasing/Report Macro/Konsesi Inc Insp","","","","3H","2019-10-04","adi","1","2019-10-03 03:29:37","2019-10-05 23:48:21","adi","adi","4","pur09","1","pur09-1910-00001","adi","2019-10-03 16:22:35","system","2019-10-05 23:48:21"),
("17","Menambahkan Due Date new","Dear Bu Natalia\n\nMohon bantu Menambahkan Due Date new pada PPI \n\nTerimakasih\n\nJeffry","","","","3H","2019-10-09","nat","3","2019-10-09 09:44:39","2019-10-11 23:47:56","nat","nat","4","acc07","1","acc07-1910-00002","nat","2019-10-09 10:38:57","system","2019-10-11 23:47:56"),
("18","Modif item","Mohon Menampilkan barcode pada cetakan SPK\nunt item card sbb :\n - 05AD-POPVPU2\n - 05AD-POPVPU82\n - 05AD-POPVPUB2","","","","3H","2019-10-09","nat","3","2019-10-09 14:22:34","2019-10-09 14:40:13","nat","nat","4","pwtn04","1","pwtn04-1910-00002","","","pwtn04","2019-10-09 14:40:13"),
("19","Laporan Produksi Harian","Untuk mengetahui Laporan Produksi Harian per mesin, downtime, reject","scm02-1910-00001-1-Template Laporan Produksi Harian.xlsx","scm02-1910-00001-2-Cap per Hour.xlsx","","9H","2019-10-14","noel","1","2019-10-10 09:33:33","2019-10-23 23:47:19","noel","noel","4","scm02","1","scm02-1910-00001","noel","2019-10-21 08:33:45","system","2019-10-23 23:47:19"),
("20","Copy file","Mohon copy file\n104/data(Z):/SHARE FOR ALL/AAIP/KPI    ke   106/Data(E)/DATA/Plant wotan/PWTN04","","","","3H","2019-10-10","nat","3","2019-10-10 14:31:28","2019-10-12 23:47:53","nat","nat","4","pwtn04","1","pwtn04-1910-00003","nat","2019-10-10 14:49:22","system","2019-10-12 23:47:53"),
("21","Report macro kartu warna","report macro kartu warna, tabel sudah sy sampaikan ke natalia. Report ini yang mengunakan adalah design (bu Sanny)","","","","3H","2019-10-11","noel","1","2019-10-11 08:22:55","2019-10-13 23:47:50","noel","noel","4","mkt01","1","mkt01-1910-00001","noel","2019-10-11 14:47:03","system","2019-10-13 23:47:50"),
("22","report macro penjualan barang khusus","report macro penjualan barang khusus","","","","3H","2019-10-16","ysa","1","2019-10-16 13:44:31","2019-10-18 23:47:35","ysa","ysa","4","mkt01","1","mkt01-1910-00002","ysa","2019-10-16 14:47:11","system","2019-10-18 23:47:35"),
("23","Copy file","Mohon copy file Data(Z);/SHARE FOR ALL/AAIP/BO 15102019\nke 106/E/DATA/Plant wotan/PWTN04","","","","3H","2019-10-18","nat","3","2019-10-18 13:03:30","2019-10-20 23:47:29","nat","nat","4","pwtn04","1","pwtn04-1910-00004","nat","2019-10-18 13:08:17","system","2019-10-20 23:47:29"),
("24","Report Stock Opname Barang Kemas","digunakan untuk mempermudah pencarian barang pada saat stock opname harian","psdj01-1910-00002-1-REPORT STOCK OPNAME.xlsx","","","9H","2019-10-25","noel","1","2019-10-24 12:57:09","2019-11-02 23:46:58","noel","noel","4","psdj01","1","psdj01-1910-00002","noel","2019-10-31 16:34:20","system","2019-11-02 23:46:58"),
("25","Report Stock Opname Barang Kemas","digunakan untuk mempermudah pencarian barang pada saat stock opname harian","psdj01-1910-00003-1-REPORT STOCK OPNAME.xlsx","","","","","","","2019-10-24 12:57:26","2019-10-24 12:59:05","","psdj01","4","psdj01","1","psdj01-1910-00003","","","psdj01","2019-10-24 12:59:05"),
("26","Cpoy file","Mohon copy file di Z:/SHARE FOR ALL/AAIP/Produksi detail\nke  E/DATA/Plant wotan/PWTN04","","","","3H","2019-10-25","nat","3","2019-10-25 09:48:18","2019-10-27 23:47:06","nat","nat","4","pwtn04","1","pwtn04-1910-00005","nat","2019-10-25 09:52:26","system","2019-10-27 23:47:06"),
("27","Revisi nomor mesin","Dear tim IT\nMohon bantuannya untuk revisi spk RPOP-IPW-1910-02338 tanggal 27-10-2019\nnomor mesin yang benar adalah I37","","","","3H","2019-10-28","nat","3","2019-10-28 15:44:49","2019-10-30 23:47:01","nat","nat","4","pwtn02","1","pwtn02-1910-00001","nat","2019-10-28 16:52:02","system","2019-10-30 23:47:01"),
("28","Report makro SO Oustanding","report makro SO Outstanding dilakukan  modifikasi sbb :\n- Penambahan kolom Kota dan kolom Outstanding Berat (kg)\n- Penghapusan Kolom kode sales dan nama sales serta penghilangan tulisan outsatanding di kolom outsatanding UOM","","","","3H","2019-10-30","noel","1","2019-10-30 11:35:49","2019-11-01 23:47:02","noel","noel","4","pwtn07","1","pwtn07-1910-00001","noel","2019-10-30 17:44:57","system","2019-11-01 23:47:02"),
("29","Pembuatan report macro untuk OEE","Dear tim IT\nmohon dibuatkan report macro untuk laporan OEE dengan contoh terlampir","pwtn02-1910-00002-1-OEE SEPTEMBER 2019.xlsx","","","9H","2019-11-18","noel","1","2019-10-30 11:43:28","2019-10-31 15:03:52","noel","noel","2","pwtn02","1","pwtn02-1910-00002","","","",""),
("30","Revisi nomor mesin dan kode mould","Dear tim IT\nMohon bantuanya untuk revisi nomor mesin dan kode mould yang salah, berikut saya lampirkan nomor spk yang perlu di revisi","pwtn02-1910-00003-1-SPK salah nomor mesin dan kode mould.xlsx","","","9H","2019-10-31","nat","3","2019-10-30 17:48:48","2019-11-03 23:46:57","nat","nat","4","pwtn02","1","pwtn02-1910-00003","nat","2019-11-01 14:14:58","system","2019-11-03 23:46:57"),
("31","Replace purchase unit of Measure NAV","Mohon replace  purch. unit of measure  item card sbb :\n - 02KM-P085040 --> Purch unit of measure : LBR replace menjadi KG\n - 02LL-TRHI --> Purch unit of measure : BALL replace menjadi KG","","","","3H","2019-11-05","nat","3","2019-11-05 14:09:04","2019-11-06 09:28:38","nat","nat","4","pwtn04","1","pwtn04-1911-00001","nat","2019-11-05 16:20:45","pwtn04","2019-11-06 09:28:38"),
("32","Pembuatan Report Mutasi Stock Barang Jadi","Request kolom2 di report ada di server nav \nscm/share for scm/form mutasi stock barang jadi","","","","9H","2019-11-08","noel","1","2019-11-05 15:54:37","2019-11-12 07:29:03","noel","noel","3","scm01","1","scm01-1911-00001","noel","2019-11-12 07:29:03","",""),
("33","penambahan di report makro inventory ratio","Penambahan keterangan \nBO Power\nBO Power Max\nBO Fitting\n\ndan penambahan kolom back order","","","","9H","2019-11-11","noel","1","2019-11-06 14:43:01","2019-11-06 15:52:24","noel","noel","2","pwtn28","1","pwtn28-1911-00001","","","",""),
("34","Macro Payable aging memakai tgl PB","Dear Pak Noel\n\nMohon menambahkan sheet baru di macro Payment Aging, sama seperti Payable aging tapi tanggal Doc Date diganti tanggal PB\n\nTerimakasih","","","","9H","2019-11-25","noel","1","2019-11-06 15:34:12","2019-11-06 15:53:26","noel","noel","2","acc07","1","acc07-1911-00001","","","",""),
("35","PERMINTAAN USERNAME AVIA TICKET RDP06","Dear IT Team,\n\nmohon dibantu untuk pembuatan username baru untuk RDP06\nterima kasih.\n\nangelica.","","","","3H","2019-11-07","donny","3","2019-11-07 08:15:39","2019-11-07 08:48:50","donny","donny","4","rdp05","1","rdp05-1911-00001","donny","2019-11-07 08:26:33","rdp05","2019-11-07 08:48:50"),
("36","ORDER LAPTOP & SPEAKER UNTUK TRAINER","Dear IT Team,\n\nmohon dibelikan 1 set Laptop dan speaker untuk trainir yang dapat digunakan untuk office, compress gambar, video editor dan akses NAV. \nLaptop diberikan pada Suci RnD. thanks.\n\nangelica.","","","","3H","2019-11-07","adi","3","2019-11-07 08:17:18","2019-11-08 14:37:56","adi","adi","4","rdp05","1","rdp05-1911-00002","adi","2019-11-07 14:58:11","rdp05","2019-11-08 14:37:56"),
("37","Tolong dibelikan laptop untuk training","Dengan keperluan/spesifikasi:\n1. Ukuran 13 atau 14 inch\n2. Diinstalkan Microsoft office\n3. Bisa untuk pembuatan/editing video\n4. Speaker bagus","","","","3H","2019-11-07","adi","3","2019-11-07 09:13:53","2019-11-09 23:46:37","adi","adi","4","rdp06","1","rdp06-1911-00001","adi","2019-11-07 14:19:31","system","2019-11-09 23:46:37"),
("38","Loc Code pd Account 5.04.00.00.002","Dear Pak Noel\n\nMohon bantu membuatkan macro pd Account 5.04.00.00.002.\nTabelnya Poting date, doc number, GL Account no, GL account name, description, branch,amount,Loc code\n\nTerimakasih","","","","9H","2019-11-14","noel","1","2019-11-07 14:05:24","2019-11-07 17:22:30","noel","noel","2","acc07","1","acc07-1911-00002","","","",""),
("39","PEMBUATAN FOLDER RDP11 UNTUK NASTITI","Dear IT team,\n\nTolong dibantu untuk pembuatan Folder RDP11 untuk Nastiti.\nCara penamaan Folder disesuaikan dengan yang lain: RDP11 Nastiti.\n\nMohon ganti nama folder RDP05 menjadi RDP05 Angelica.\n\nterima kasih.","","","","3H","2019-11-12","adi","3","2019-11-12 07:00:54","2019-11-12 16:47:12","adi","adi","3","rdp05","1","rdp05-1911-00003","adi","2019-11-12 16:47:12","",""),
("40","PEROMBAKAN STRUKTUR FOLDER NAV RND","Dear Pak Adi,\n\nSaya ada email ttg perombakan struktur Folder RnD pada tgl 7 Nov dan sampai hari ini tidak ada reply sama sekali.\n\nemailnya sbb:\nDear Pak Adi dan Bu Yenny,\n\nSaya ada rencana untuk merapikan folder2 di NAV.\nMohon dibantu untuk pembagin folder sbb.\nSaran saya dilakukan diluar jam kerja supya tidak mengganggu pekerjaan mereka.\n\nTolong dilihat dl listnya dan bila ada masukan dapat disampaikan. Thanks.\n\nBesar harapan saya supaya email ini mendapat balasan tanpa perlu reminder. Terima kasih.\n\nAngelica.\n\n>> adapun perombakan ini akhirnya lgs saya sampaikan ke Pak Robert dan Approved.  jadi mohon segera dieksekusi. mohon eksekusi tidak dilakukan di waktu kerja supaya tidak  mengganggu aktifitas kerja. Tolong dilakukan saat weekend saja.\n\nsaya berharap eksekusi ini tidak ada delay lagi seperti jawaban email yang tak kunjung tiba.\n\nterima kasih.","rdp05-1911-00004-1-LIST USERNAME.xlsx","","","9H","2019-11-12","adi","3","2019-11-12 07:06:07","2019-11-12 16:47:50","adi","adi","2","rdp05","1","rdp05-1911-00004","","","",""),
("41","cekclock Avian tower khusus karyawan AAIP","Saat ini karyawan AAIP yang dinas di tower dan bisa dibaca mesin cekclock nya hanya Chika dan Dinda (Accounting) data dikirim setiap hari oleh bu Mar\n\nMinta tolong khusus karyawan AAIP lain yang dinas di tower bisa dikirimkan cekclock nya mengingat akan semakin banyak karyawan AAIP yang dinas di Avian tower\n\nkami lampirkan contoh cekclock yang dikirim setiap hari dari bu Mar\n\nAtas perhatian dan kerja samanya kami sampaikan terima kasih\n\n\nbest regards\nAndri","pwtn10-1911-00001-1-data cekclock AAIP-Avian tower.pdf","","","","","","","2019-11-12 08:50:58","2019-11-12 08:50:58","","pwtn10","1","pwtn10","1","pwtn10-1911-00001","","","","");




CREATE TABLE `user_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `active` int(1) DEFAULT NULL,
  `user_modified` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO user_levels VALUES
("1","Super Admin","1","1","2017-06-28 13:18:17","2017-06-28 13:18:17"),
("2","Admin","1","1","2018-06-02 22:59:51","2018-06-02 22:59:51"),
("3","User","1","1","2018-06-03 11:19:49","2018-06-03 11:19:49");




CREATE TABLE `user_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `user_level` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_modified` varchar(15) NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;


INSERT INTO user_ticket VALUES
("1","donny","VSUPER","Donny","it_2@avianbrands.com","2019-09-06 15:17:44","2019-11-12 14:07:33","donny","2019-11-12 14:07:33"),
("2","adi","VSUPER","Adi","it_1@avianbrands.com","2019-09-06 15:21:59","2019-11-12 16:36:18","donny","2019-11-12 16:36:18"),
("3","ysa","VSUPER","Yenny","it_1@avianbrands.com","2019-09-06 15:22:13","2019-10-16 13:49:15","donny","2019-10-16 13:49:15"),
("4","agus","VADM","Agus","ardo_1777@yahoo.com","2019-09-06 15:22:28","2019-10-01 08:25:36","donny","2019-10-01 08:25:36"),
("5","alvin","VADM","Alvin","it_2@avianbrands.com","2019-09-06 15:22:41","2019-09-06 15:22:41","donny",""),
("6","deviana","VADM","Deviana","it_2@avianbrands.com","2019-09-06 15:22:53","2019-09-06 15:22:53","donny",""),
("7","nat","VADM","Natalia","it_2@avianbrands.com","2019-09-06 15:23:07","2019-11-05 16:10:06","donny","2019-11-05 16:10:06"),
("8","noel","VADM","Noel","it_2@avianbrands.com","2019-09-06 15:23:30","2019-11-12 16:31:57","donny","2019-11-12 16:31:57"),
("9","paulus","VADM","Paulus","it_2@avianbrands.com","2019-09-06 15:24:23","2019-09-06 15:24:23","donny",""),
("10","gunadisan","VADM","Gunadi","it_2@avianbrands.com","2019-09-06 15:24:40","2019-09-06 15:24:40","donny",""),
("11","acc01","USER","Oky","acc_1@avianbrands.com","2019-09-06 15:24:50","2019-09-06 15:24:50","donny",""),
("12","acc02","USER","Eri","acc_2@avianbrands.com","2019-09-06 15:25:06","2019-09-06 15:25:06","donny",""),
("13","acc06","USER","Fanny","acc_4@avianbrands.com","2019-09-06 15:25:19","2019-10-09 14:54:06","donny","2019-10-09 14:54:06"),
("14","acc07","USER","Jefry","acc_4@avianbrands.com","2019-09-06 15:25:58","2019-11-07 14:01:51","donny","2019-11-07 14:01:51"),
("15","dsg02","USER","Indyana","dsg_3@avianbrands.com","2019-09-06 15:26:19","2019-09-06 15:26:19","donny",""),
("16","ehs01","USER","Eko","ehs_1@avianbrands.com","2019-09-06 15:26:30","2019-09-06 15:26:30","donny",""),
("17","fa01","USER","Anton","fa_1@avianbrands.com","2019-09-06 15:26:40","2019-09-06 15:26:40","donny",""),
("18","fin01","USER","Henny","fin_1@avianbrands.com","2019-09-06 15:26:52","2019-09-06 15:26:52","donny",""),
("19","findir01","USER","Kurnia Hadi","kurnia.hadi@avianbrands.com","2019-09-06 15:27:07","2019-11-08 13:03:28","adi",""),
("20","gm01","USER","Iwan","gm_1@avianbrands.com","2019-09-06 15:27:44","2019-09-06 15:27:44","donny",""),
("21","hrd01","USER","Aliki","hrd_3@avianbrands.com","2019-09-06 15:27:58","2019-11-08 13:04:30","adi",""),
("22","hrd02","USER","Maryatun","hrd_1@avianbrands.com","2019-09-06 15:28:22","2019-09-06 15:28:22","donny",""),
("23","ina02","USER","Devyka","ina_2@avianbrands.com","2019-09-06 15:29:14","2019-11-01 15:12:19","donny","2019-11-01 15:12:19"),
("24","ina03","USER","Sarwono","ina_1@avianbrands.com","2019-09-06 15:29:31","2019-10-16 08:44:29","donny","2019-10-16 08:44:29"),
("25","kal04","USER","Andri","kal_1@avianbrands.com","2019-09-06 15:29:43","2019-09-06 15:29:43","donny",""),
("26","log01","USER","Tresno","log_1@avianbrands.com","2019-09-06 15:29:55","2019-09-06 15:29:55","donny",""),
("27","log03","USER","Titus","log_3@avianbrands.com","2019-09-06 15:30:06","2019-09-06 15:30:06","donny",""),
("28","mkt01","USER","Tian","marketing@avianbrands.com","2019-09-06 15:30:17","2019-10-16 13:43:54","donny","2019-10-16 13:43:54"),
("29","msdo01","USER","Ardy","msdo_1@avianbrands.com","2019-09-06 15:30:52","2019-09-06 15:30:52","donny",""),
("30","pas02","USER","Vero","pas_2@avianbrands.com","2019-09-06 15:31:03","2019-09-06 15:31:03","donny",""),
("31","pas03","USER","Lina","pas_3@avianbrands.com","2019-09-06 15:31:13","2019-09-06 15:31:13","donny",""),
("32","pas04","USER","Edwin","pas_4@avianbrands.com","2019-09-06 15:31:24","2019-09-06 15:31:24","donny",""),
("33","pcrb01","USER","Barkah","pcrb_1@pipapower.com","2019-09-06 15:31:35","2019-09-06 15:31:35","donny",""),
("34","hermanto.tanoko","USER","Hermanto Tanoko","hermanto.tanoko@avianbrands.com","2019-09-06 15:31:48","2019-09-06 15:31:48","donny",""),
("35","pcrb02","USER","Deden","pcrb_5@pipapower.com","2019-09-06 15:32:01","2019-09-06 15:32:01","donny",""),
("36","pcrb03","USER","Yudha","pcrb_3@pipapower.com","2019-09-06 15:32:12","2019-10-16 13:45:03","donny","2019-10-16 13:45:03"),
("37","pmdn01","USER","Denny","pmdn_2@avianbrands.com","2019-09-06 15:32:24","2019-11-01 13:40:10","donny","2019-11-01 13:40:10"),
("38","psdj01","USER","Budi Santoso","psdj_1@avianbrands.com","2019-09-06 15:33:10","2019-10-24 11:53:47","donny","2019-10-24 11:53:47"),
("39","psdj02","USER","Sajum","psdj_2@avianbrands.com","2019-09-06 15:33:21","2019-09-06 15:33:21","donny",""),
("40","psrg01","USER","Citro","psrg_1@avianbrands.com","2019-09-06 15:33:32","2019-09-06 15:33:32","donny",""),
("41","psrg02","USER","Deddy","psrg_2@avianbrands.com","2019-09-06 15:33:41","2019-09-06 15:33:41","donny",""),
("42","ppc01","USER","Yohannes","ppc_1@avianbrands.com","2019-09-06 15:33:51","2019-09-06 15:33:51","donny",""),
("43","pur01","USER","Melly","pur_1@avianbrands.com","2019-09-06 15:34:01","2019-09-06 15:34:01","donny",""),
("44","pur06","USER","Grace","pas_1@avianbrands.com","2019-09-06 15:34:10","2019-09-06 15:34:10","donny",""),
("45","pur09","USER","Silvya","pur_9@avianbrands.com","2019-09-06 15:34:26","2019-10-03 03:26:45","donny","2019-10-03 03:26:45"),
("46","pwtn01","USER","David","pwtn_1@pipapower.com","2019-09-06 15:34:37","2019-09-06 15:34:37","donny",""),
("47","pwtn02","USER","Sumarsono","pwtn_2@pipapower.com","2019-09-06 15:34:48","2019-11-05 10:22:20","donny","2019-11-05 10:22:20"),
("48","pwtn03","USER","Irwan","qcp_1@pipapower.com","2019-09-06 15:34:58","2019-09-27 09:30:06","donny","2019-09-27 09:30:06"),
("49","pwtn04","USER","Haryanto","ppc_1@pipapower.com","2019-09-06 15:35:08","2019-11-06 09:26:45","donny","2019-11-06 09:26:45"),
("50","pwtn07","USER","Albert","log_1@pipapower.com","2019-09-06 15:35:18","2019-10-30 11:17:16","donny","2019-10-30 11:17:16"),
("51","pwtn10","USER","Erick Yaseta","hrd_1@pipapower.com","2019-09-06 15:35:29","2019-11-12 08:29:25","donny","2019-11-12 08:29:25"),
("52","rdp01","USER","Indranilla","rdp_1@avianbrands.com","2019-09-06 15:35:49","2019-09-06 15:35:49","donny",""),
("53","rdp02","USER","Bambang","rdp_2@avianbrands.com","2019-09-06 15:35:58","2019-09-06 15:35:58","donny",""),
("54","rdp04","USER","Cipto","rdp_4@avianbrands.com","2019-09-06 15:36:10","2019-09-06 15:36:10","donny",""),
("55","rdp05","USER","Angelica","angelica.jozar@avianbrands.com","2019-09-06 15:36:20","2019-11-12 06:58:33","donny","2019-11-12 06:58:33"),
("56","robert.tanoko","USER","Robert Tanoko","robert.tanoko@avianbrands.com","2019-09-06 15:36:34","2019-09-06 15:36:34","donny",""),
("57","scm01","USER","Tri","scm_1@avianbrands.com","2019-09-06 15:36:44","2019-11-05 15:49:33","donny","2019-11-05 15:49:33"),
("58","tek01","USER","Nico","tek_1@avianbrands.com","2019-09-06 15:36:54","2019-09-06 15:36:54","donny",""),
("59","qcp01","USER","Agung","qcp_2@avianbrands.com","2019-09-06 15:37:06","2019-11-11 07:32:43","donny","2019-11-11 07:32:43"),
("60","scm02","USER","Christina","scm_2@avianbrands.com","2019-09-20 13:24:45","2019-10-23 10:29:52","donny","2019-10-23 10:29:52"),
("61","acc05","USER","Asmaul","tax@avianbrands.com","2019-10-17 11:42:53","2019-10-17 11:42:53","donny",""),
("62","pwtn28","USER","Singgih","mkt_1@pipapower.com","2019-11-06 13:45:03","2019-11-06 14:39:00","donny","2019-11-06 14:39:00"),
("63","rdp06","USER","Sylviana","rdp_6@avianbrands.com","2019-11-07 08:22:30","2019-11-07 08:31:19","donny","2019-11-07 08:31:19");




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


INSERT INTO users VALUES
("1","1","Super","Admin","0","superadmin@admin.com","Jl Madura xxxxxxx","08383xxxxxxx","male","1986-07-25","superadmin","$2y$10$TkX/dDYrtvIEXidPOag5T.V8qbyluUHJg5ssBjKe6WlVqpItuN8uy","1","1","2019-01-03 10:54:50","2017-03-14 03:51:35","2019-01-03 10:54:50"),
("2","2","Admin","Admin","0","admin@admin.com","","","male","","admin","$2y$10$PQaUY4b0YsSo5qAuK8Cc.OB.WeEJHrJJ0FDgk6YE9xhXboVRou3We","1","1","2019-01-02 10:17:02","2017-04-19 21:29:01","2019-01-02 10:17:02");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;