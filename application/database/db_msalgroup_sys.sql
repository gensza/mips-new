/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.34-MariaDB : Database - db_msalgroup_sys
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `codegroup` */

DROP TABLE IF EXISTS `codegroup`;

CREATE TABLE `codegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL COMMENT 'isi dari code ini',
  `group_n` varchar(50) DEFAULT NULL COMMENT 'nama untuk groupnya',
  `inisial` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `is_deleted` int(1) DEFAULT '0',
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `codegroup` */

insert  into `codegroup`(`id`,`nama`,`value`,`group_n`,`inisial`,`deskripsi`,`is_deleted`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'ALL','0','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(2,'HO','1','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(3,'RO','2','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(4,'PKS','3','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(5,'EST1','6','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(6,'EST2','7','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(7,'EST3','8','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(8,'ALL EST','678','NOAC_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(9,'Asset','Asset','NOAC_GROUP',NULL,'Group di Table NOAC',0,NULL,NULL,NULL,NULL),(10,'Liability','Liability','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(11,'Capital','Capital','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(12,'Revenue','Revenue','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(13,'Expenses','Expenses','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(14,'Other Capital','Other Capital','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(15,'Other Revenue','Other Revenue','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(16,'Other Expenses','Other Expenses','NOAC_GROUP',NULL,NULL,0,NULL,NULL,NULL,NULL),(17,'1','1','NOAC_LEVEL',NULL,'Ini untuk urutan Noac , misal header,parent, terus sub',0,NULL,NULL,NULL,NULL),(18,'2','2','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(19,'3','3','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(20,'4','4','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(21,'5','5','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(22,'6','6','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(23,'7','7','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(24,'8','8','NOAC_LEVEL',NULL,NULL,0,NULL,NULL,NULL,NULL),(25,'AMPUL','AMPUL','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(26,'ASSY','ASSY','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(27,'BH','BH','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(28,'BJ','BJ','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(29,'BOX','BOX','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(30,'BTG','BTG','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(31,'BTL','BTL','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(32,'BUK','BUK','NOAC_SATUAN',NULL,NULL,0,NULL,NULL,NULL,NULL),(33,'Payment','Payment','CABA_PAY',NULL,NULL,0,NULL,NULL,NULL,NULL),(34,'Receive','Receive','CABA_PAY',NULL,NULL,0,NULL,NULL,NULL,NULL),(35,'Kas','Kas','CABA_KAS',NULL,NULL,0,NULL,NULL,NULL,NULL),(36,'Bank','Bank','CABA_KAS',NULL,NULL,0,NULL,NULL,NULL,NULL),(37,'PO/PP','PO/PP','CABA_REF',NULL,NULL,0,NULL,NULL,NULL,NULL),(38,'PO/PK','PO/PK','CABA_REF',NULL,NULL,1,NULL,NULL,NULL,NULL),(39,'PO/Budget','PO/Budget','CABA_REF',NULL,NULL,1,NULL,NULL,NULL,NULL),(40,'01-HO','01','CABA_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(41,'02-RO','02','CABA_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(42,'06-EST1','06','CABA_DIVISI',NULL,NULL,0,NULL,NULL,NULL,NULL),(43,'-','-','CABA_REF',NULL,NULL,0,NULL,NULL,NULL,NULL),(44,'HO','1','LOKASI_USERS',NULL,NULL,0,NULL,NULL,NULL,NULL),(45,'ESTATE','3','LOKASI_USERS',NULL,NULL,0,NULL,NULL,NULL,NULL),(46,'RO','2','LOKASI_USERS',NULL,NULL,0,NULL,NULL,NULL,NULL),(47,'GL','1','GROUP_MODULE',NULL,NULL,0,NULL,NULL,NULL,NULL),(48,'CABA','2','GROUP_MODULE',NULL,NULL,0,NULL,NULL,NULL,NULL),(49,'PKS','4','LOKASI_USERS',NULL,NULL,0,NULL,NULL,NULL,NULL),(50,'MITRA','5','LOKASI_USERS',NULL,NULL,0,NULL,NULL,NULL,NULL);

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `position` int(1) DEFAULT NULL COMMENT '1=Parent,2=Child',
  `have_child` varchar(1) DEFAULT 'N' COMMENT 'Y=Punya,N=Tidak Punya',
  `parent` int(10) DEFAULT '0',
  `sequence` varchar(1) NOT NULL,
  `line` int(1) DEFAULT '0',
  `is_deleted` int(1) DEFAULT '0',
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`icon`,`name`,`controller`,`position`,`have_child`,`parent`,`sequence`,`line`,`is_deleted`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'','Bank Data','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:06:06',NULL,NULL),(2,'','Pengaturan','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:06:22',NULL,NULL),(3,NULL,'Data Pengguna','users/index',2,'N',1,'0',0,0,'1','2019-07-18 09:06:42',NULL,NULL),(4,NULL,'Module','module/index',2,'N',2,'0',0,0,'1','2019-07-18 09:07:01',NULL,NULL),(5,NULL,'Role','#',2,'N',2,'0',0,0,'1','2019-07-18 09:32:38',NULL,NULL),(6,'','Default','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:34:26',NULL,NULL),(7,'','Setup Account','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:34:47',NULL,NULL),(8,'','Transaksi','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:35:02',NULL,NULL),(9,'','Posting','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:35:24',NULL,NULL),(10,'','Report','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:42:55',NULL,NULL),(11,'','Utility','#',1,'Y',0,'0',0,0,'1','2019-07-18 09:43:25',NULL,NULL),(12,NULL,'Currency Table','#',2,'N',6,'0',0,0,'1','2019-07-18 10:18:35',NULL,NULL),(13,NULL,'Currency Rate','#',2,'N',6,'0',1,0,'1','2019-07-18 10:18:47',NULL,NULL),(14,NULL,'Periode','#',2,'N',6,'0',0,0,'1','2019-07-18 10:19:09',NULL,NULL),(15,NULL,'Setup Control Account','#',2,'N',6,'0',0,0,'1','2019-07-18 10:19:24',NULL,NULL),(16,NULL,'Setup COA Tahun Tanam','#',2,'N',6,'0',0,0,'1','2019-07-18 10:19:39',NULL,NULL),(17,NULL,'Table Department','#',2,'N',6,'0',0,0,'1','2019-07-18 10:19:47',NULL,NULL),(18,'','Input COA','gl/master_input',2,'N',7,'0',0,0,'1','2019-07-18 10:20:13','1','2019-07-18 11:34:19'),(19,'','Table COA','gl/master_tabel',2,'N',7,'0',0,0,'1','2019-07-18 10:20:22','1','2019-07-18 11:34:37'),(20,NULL,'Saldo Awal','#',2,'N',7,'0',0,0,'1','2019-07-18 10:20:33',NULL,NULL),(21,NULL,'Sub System','#',2,'N',8,'0',0,0,'1','2019-07-18 10:20:59',NULL,NULL),(22,NULL,'Transaksi Jurnal','gl/transaksi_input',2,'N',8,'0',0,0,'1','2019-07-18 10:21:18','1','2019-07-18 11:35:30'),(23,NULL,'Koreksi Jurnal','gl/transaksi_table_entry',2,'N',8,'0',0,0,'1','2019-07-18 10:21:27','1','2019-08-20 10:26:56'),(24,NULL,'Posting / Update','gl/posting_harian',2,'N',9,'0',0,0,'1','2019-07-18 10:21:50',NULL,NULL),(25,NULL,'Year Closing','#',2,'N',9,'0',0,0,'1','2019-07-18 10:21:59',NULL,NULL),(26,NULL,'Accounts File','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:22:28',NULL,NULL),(27,NULL,'Saldo Awal','#',2,'N',10,'0',0,0,'1','2019-07-18 10:22:43',NULL,NULL),(28,NULL,'Register Voucher','#',2,'N',10,'0',0,0,'1','2019-07-18 10:22:55',NULL,NULL),(29,NULL,'Journal','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:23:07',NULL,NULL),(30,NULL,'Buku Besar','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:23:25',NULL,NULL),(31,NULL,'Trial Balance','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:23:37',NULL,NULL),(32,NULL,'Income Statement','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:23:55',NULL,NULL),(33,NULL,'Balance','#',2,'Y',10,'0',0,0,'1','2019-07-18 10:24:04',NULL,NULL),(34,NULL,'Report PKRM','#',2,'N',10,'0',0,0,'1','2019-07-18 10:24:21',NULL,NULL),(35,NULL,'Financial Conditions','#',2,'N',10,'0',0,0,'1','2019-07-18 10:24:39',NULL,NULL),(36,NULL,'Detail Account','gl/account_detail',3,'N',26,'0',0,0,'1','2019-07-18 10:25:05','1','2019-07-18 11:39:46'),(37,NULL,'All Accounts','#',3,'N',26,'0',0,0,'1','2019-07-18 10:25:15',NULL,NULL),(38,NULL,'Jurnal','gl/report_jurnal',3,'N',29,'0',0,0,'1','2019-07-18 10:25:34','1','2019-07-18 11:40:01'),(39,NULL,'Module','gl/report_module',3,'N',29,'0',0,0,'1','2019-07-18 10:25:41','1','2019-07-18 11:40:10'),(40,NULL,'All Accounts','gl/report_buku_besar',3,'N',30,'0',0,0,'1','2019-07-18 10:25:59','1','2019-07-18 11:40:35'),(41,NULL,'Periode','#',3,'N',30,'0',0,0,'1','2019-07-18 10:26:10',NULL,NULL),(42,NULL,'All Accounts','gl/report_trialbalance',3,'N',31,'0',0,0,'1','2019-07-18 10:27:33','1','2019-07-25 11:23:04'),(43,NULL,'Select SBU Accounts','#',3,'N',31,'0',0,0,'1','2019-07-18 10:27:40','1','2019-07-18 10:28:17'),(44,NULL,'All Accounts','#',3,'N',32,'0',0,0,'1','2019-07-18 10:28:50',NULL,NULL),(45,NULL,'Select SBU','#',3,'N',32,'0',0,0,'1','2019-07-18 10:28:59',NULL,NULL),(46,NULL,'All Accounts','#',3,'N',33,'0',0,0,'1','2019-07-18 10:29:15',NULL,NULL),(47,NULL,'Select SBU Accounts','#',3,'N',33,'0',0,0,'1','2019-07-18 10:29:29',NULL,NULL),(48,NULL,'Password Maintenance','#',2,'N',11,'0',0,0,'1','2019-07-18 10:30:50',NULL,NULL),(49,NULL,'Toolbar','#',2,'Y',11,'0',0,0,'1','2019-07-18 10:31:15',NULL,NULL),(50,NULL,'Backup Data','#',2,'N',11,'0',0,0,'1','2019-07-18 10:31:29',NULL,NULL),(51,NULL,'Restore Data','#',2,'N',11,'0',0,0,'1','2019-07-18 10:31:38',NULL,NULL),(52,NULL,'Edit No. Ref','#',2,'N',11,'0',0,0,'1','2019-07-18 10:31:52',NULL,NULL),(53,NULL,'Repair Database','#',2,'N',11,'0',0,0,'1','2019-07-18 10:32:02',NULL,NULL),(54,NULL,'Compact/kompres Database','#',2,'N',11,'0',0,0,'1','2019-07-18 10:32:21',NULL,NULL),(55,'','File','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:42:25',NULL,NULL),(56,'','Input','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:42:42',NULL,NULL),(57,'','Posting','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:43:08',NULL,NULL),(58,'','Laporan','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:45:40',NULL,NULL),(59,'','Utilities','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:46:09',NULL,NULL),(60,'','Exit','#',1,'Y',0,'0',0,0,'1','2019-07-18 11:46:35',NULL,NULL),(61,NULL,'Company','#',2,'N',55,'0',0,0,'1','2019-07-18 11:47:00',NULL,NULL),(62,NULL,'Saldo Awal','cash_bank/saldo_awal',2,'N',55,'0',0,0,'1','2019-07-18 11:47:09','1','2019-07-18 12:49:50'),(63,NULL,'Setup Account','#',2,'N',55,'0',0,0,'1','2019-07-18 11:47:20',NULL,NULL),(64,NULL,'Account','#',2,'N',55,'0',0,0,'1','2019-07-18 11:47:31',NULL,NULL),(65,NULL,'Voucher','cash_bank/input_voucher',2,'N',56,'0',0,0,'1','2019-07-18 11:48:12','1','2019-07-18 12:47:01'),(66,'','Posting Harian','cash_bank/posting_harian',2,'N',57,'0',0,0,'1','2019-07-18 11:49:35','1','2019-08-26 09:16:30'),(67,'','Transfer Ke GL','cash_bank/posting_ke_gl',2,'N',57,'0',0,0,'1','2019-07-18 11:49:48','1','2019-08-28 08:49:14'),(68,NULL,'Monthly Closing','#',2,'N',57,'0',0,0,'1','2019-07-18 11:50:00',NULL,NULL),(69,NULL,'Voucher','#',2,'Y',58,'0',0,0,'1','2019-07-18 11:50:27',NULL,NULL),(70,NULL,'Saldo Akhir','cash_bank/saldo_akhir',2,'N',58,'0',0,0,'1','2019-07-18 11:50:49',NULL,NULL),(71,NULL,'Register','cash_bank/laporan_vouc_register',3,'N',69,'0',0,0,'1','2019-07-18 11:51:54',NULL,NULL),(72,NULL,'Journal','cash_bank/laporan_vouc_journal',3,'N',69,'0',0,0,'1','2019-07-18 11:52:05',NULL,NULL),(73,NULL,'Rekap','#',3,'N',69,'0',0,0,'1','2019-07-18 11:52:11',NULL,NULL),(74,NULL,'Aktifitas Account','#',3,'N',69,'0',0,0,'1','2019-07-18 11:52:22',NULL,NULL),(75,NULL,'Tabel Monitoring','#',2,'N',59,'0',0,0,'1','2019-07-18 11:52:46',NULL,NULL),(76,NULL,'Konfigurasi','cash_bank/configurasi',2,'N',59,'0',0,0,'1','2019-07-18 11:54:10',NULL,NULL),(77,NULL,'Password','#',2,'N',59,'0',0,0,'1','2019-07-18 11:54:25',NULL,NULL),(78,NULL,'Backup','#',2,'N',59,'0',0,0,'1','2019-07-18 11:54:39',NULL,NULL),(79,NULL,'Repair','#',2,'N',59,'0',0,0,'1','2019-07-18 11:54:47',NULL,NULL),(80,NULL,'Kirim Data','#',2,'N',59,'0',0,0,'1','2019-07-18 11:54:57',NULL,NULL),(81,NULL,'Terima Data','#',2,'N',59,'0',0,0,'1','2019-07-18 11:55:14',NULL,NULL),(82,NULL,'Koreksi Transaksi GL','gl/transaksi_table',2,'N',8,'0',0,0,'1','2019-08-20 10:26:27',NULL,NULL);

/*Table structure for table `module_permission` */

DROP TABLE IF EXISTS `module_permission`;

CREATE TABLE `module_permission` (
  `id_module_role` int(20) DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL,
  `cbx` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `module_permission` */

insert  into `module_permission`(`id_module_role`,`id_module`,`cbx`) values (1,1,1),(1,3,1),(1,2,1),(1,4,1),(1,5,1),(3,55,1),(3,61,1),(3,62,1),(3,63,1),(3,64,1),(3,56,1),(3,65,1),(3,57,1),(3,66,1),(3,67,1),(3,68,1),(3,58,1),(3,69,1),(3,71,1),(3,72,1),(3,73,1),(3,74,1),(3,70,1),(3,59,1),(3,75,1),(3,76,1),(3,77,1),(3,78,1),(3,79,1),(3,80,1),(3,81,1),(3,60,1),(2,6,1),(2,12,1),(2,13,1),(2,14,1),(2,15,1),(2,16,1),(2,17,1),(2,7,1),(2,18,1),(2,19,1),(2,20,1),(2,8,1),(2,21,1),(2,22,1),(2,23,1),(2,82,1),(2,9,1),(2,24,1),(2,25,1),(2,10,1),(2,26,1),(2,36,1),(2,37,1),(2,27,1),(2,28,1),(2,38,1),(2,39,1),(2,30,1),(2,40,1),(2,41,1),(2,31,1),(2,42,1),(2,43,1),(2,32,1),(2,44,1),(2,45,1),(2,33,1),(2,46,1),(2,47,1),(2,34,1),(2,35,1),(2,11,1),(2,48,1),(2,49,1),(2,50,1),(2,51,1),(2,52,1),(2,53,1),(2,54,1);

/*Table structure for table `module_role` */

DROP TABLE IF EXISTS `module_role`;

CREATE TABLE `module_role` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `is_deleted` int(1) DEFAULT '0',
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `module_role` */

insert  into `module_role`(`id`,`nama`,`is_deleted`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,'Superadmin',0,NULL,NULL,NULL,NULL),(2,'GL',0,'1','2019-07-18 08:48:12',NULL,NULL),(3,'Cash Bank',0,'1','2019-07-18 08:49:27',NULL,NULL);

/*Table structure for table `site_pt` */

DROP TABLE IF EXISTS `site_pt`;

CREATE TABLE `site_pt` (
  `id` int(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `inisial` varchar(20) DEFAULT NULL,
  `deskripsi` text,
  `logo` varchar(100) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `site_pt` */

insert  into `site_pt`(`id`,`nama`,`inisial`,`deskripsi`,`logo`,`is_deleted`) values (1,'HO','HO',NULL,NULL,0),(2,'PT. MULIA SAWIT AGRO LESTARI','MSAL',NULL,'msal.jpeg',0),(3,'PT. PERSADA SEJAHTERA AGRO MAKMUR','PEAK',NULL,'psam.jpeg',0),(4,'PT. MITRA AGRO PERSADA ABADI','MAPA',NULL,'mapa.jpeg',0),(5,'PT. PERSADA ERA AGRO KENCANA','PSAM',NULL,'peak.jpeg',0),(11,'HO - MSAL','HOMSAL',NULL,NULL,0),(12,'HO - PSAM','HOPSAM',NULL,NULL,0),(13,'HO - MAPA','HOMAPA',NULL,NULL,0),(14,'HO - PEAK','HOPEAK',NULL,NULL,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pt` int(11) DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_module_role` int(10) DEFAULT '0',
  `login_lst` datetime DEFAULT NULL,
  `login_exp` datetime DEFAULT NULL,
  `token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aktif` int(1) DEFAULT '1',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cookie` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_modul` int(10) DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `UNIQ_5CAB8173C05FB297` (`token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `users` */

insert  into `users`(`id`,`id_pt`,`id_lokasi`,`nama`,`email`,`username`,`password`,`id_module_role`,`login_lst`,`login_exp`,`token`,`aktif`,`avatar`,`cookie`,`group_modul`,`is_deleted`,`created_by`,`created_at`,`updated_by`,`updated_at`) values (1,2,1,'Saeful Bahri','sf.bahri@yahoo.co.id','superadmin','e61eb30e63a83beec52c360479c17470e15459225db4aa45dfb73b167421256d8de86ac161189e347b1835ac1f75a7a707a9e5710c2d8453d6bd3968e71d5ad1',1,'2019-08-28 11:46:19','2019-08-28 15:46:19','34cfn2Vo3oTYtRg',1,'assets/avatar/av_201220171513703226H17DD.png',NULL,0,0,NULL,NULL,0,'2019-08-27 11:40:54'),(14,2,1,'GL_HO 1','gl@gmail.com','glho_1','e61eb30e63a83beec52c360479c17470e15459225db4aa45dfb73b167421256d8de86ac161189e347b1835ac1f75a7a707a9e5710c2d8453d6bd3968e71d5ad1',2,'2019-08-22 07:00:43','2019-08-22 11:00:43','qafwtMU9xlQqXmj',1,NULL,NULL,1,0,0,'2019-07-18 09:48:47',0,'2019-08-27 11:40:45'),(15,2,2,'GL_ESTATE 1','gl@gmail.com','glestate_1','e61eb30e63a83beec52c360479c17470e15459225db4aa45dfb73b167421256d8de86ac161189e347b1835ac1f75a7a707a9e5710c2d8453d6bd3968e71d5ad1',2,NULL,NULL,NULL,1,NULL,NULL,1,0,0,'2019-07-18 09:49:22',0,'2019-08-27 11:41:07'),(16,2,1,'CB_HO 1','c@gmail.com','cbho_1','e61eb30e63a83beec52c360479c17470e15459225db4aa45dfb73b167421256d8de86ac161189e347b1835ac1f75a7a707a9e5710c2d8453d6bd3968e71d5ad1',3,'2019-08-28 11:49:51','2019-08-28 15:49:51','cTXsJD0lgBcE2tb',1,NULL,NULL,2,0,0,'2019-07-18 11:58:33',0,'2019-08-27 11:41:14'),(17,2,2,'CB_ESTATE 1','c@gmail.com','cbestate_1','e61eb30e63a83beec52c360479c17470e15459225db4aa45dfb73b167421256d8de86ac161189e347b1835ac1f75a7a707a9e5710c2d8453d6bd3968e71d5ad1',3,'2019-08-21 08:02:42','2019-08-21 12:02:42','25bRqi5w5nh89J5',1,NULL,NULL,2,0,0,'2019-07-18 11:58:59',0,'2019-08-27 11:45:59');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
