/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.34-MariaDB : Database - msalgrou_logistikmsal_arman
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `item_po` */

DROP TABLE IF EXISTS `item_po`;

CREATE TABLE `item_po` (
  `id` int(11) DEFAULT NULL,
  `nopo` double DEFAULT NULL,
  `nopotxt` varchar(15) DEFAULT NULL,
  `noppo` double DEFAULT NULL,
  `noppotxt` varchar(15) DEFAULT NULL,
  `refppo` varchar(255) DEFAULT NULL,
  `tglppo` datetime DEFAULT NULL,
  `tglppotxt` double DEFAULT NULL,
  `tglpo` datetime DEFAULT NULL,
  `tglpotxt` double DEFAULT NULL,
  `kodebar` double DEFAULT NULL,
  `kodebartxt` varchar(20) DEFAULT NULL,
  `nabar` varchar(255) DEFAULT NULL,
  `sat` varchar(30) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumharga` double DEFAULT NULL,
  `kodept` varchar(4) DEFAULT NULL COMMENT 'Untuk kode departemen di app logistik web',
  `namapt` varchar(100) DEFAULT NULL COMMENT 'Untuk nama departemen di app logistik web',
  `periode` datetime DEFAULT NULL,
  `periodetxt` double DEFAULT NULL,
  `thn` double DEFAULT NULL,
  `merek` varchar(200) DEFAULT NULL,
  `tglisi` datetime DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `ket` mediumtext,
  `noref` varchar(255) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `hargasblm` double DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `kurs` varchar(5) DEFAULT NULL,
  `kode_budget` double DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL,
  `main_acct` double DEFAULT NULL,
  `nama_main` varchar(255) DEFAULT NULL,
  `batal` smallint(6) DEFAULT NULL,
  `cek_pp` smallint(6) DEFAULT NULL,
  `KODE_BPO` double DEFAULT NULL,
  `JUMLAHBPO` double DEFAULT NULL,
  `kode_bebanbpo` double DEFAULT NULL,
  `nama_bebanbpo` varchar(255) DEFAULT NULL,
  `konversi` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_po` */

insert  into `item_po`(`id`,`nopo`,`nopotxt`,`noppo`,`noppotxt`,`refppo`,`tglppo`,`tglppotxt`,`tglpo`,`tglpotxt`,`kodebar`,`kodebartxt`,`nabar`,`sat`,`qty`,`harga`,`jumharga`,`kodept`,`namapt`,`periode`,`periodetxt`,`thn`,`merek`,`tglisi`,`user`,`ket`,`noref`,`lokasi`,`hargasblm`,`disc`,`kurs`,`kode_budget`,`grup`,`main_acct`,`nama_main`,`batal`,`cek_pp`,`KODE_BPO`,`JUMLAHBPO`,`kode_bebanbpo`,`nama_bebanbpo`,`konversi`) values (1,3100001,'3100001',6600001,'6600001','EST-SPP/SWJ/08/19/6600001','2019-08-15 00:00:00',20190815,'2019-08-15 00:00:00',20190815,102505950000044,'102505950000044','ABBOCATH NO.20','PCS',1,10000,19000,'1','TANAMAN','2019-08-15 16:08:59',201908,2019,'merk 1','2019-08-15 16:08:59','Staff Purchasing','-','EST/BWJ/JKT/08/19/3100001','HO',10000,10,'Rp',0,'LC & TANAM',0,NULL,0,0,0,10000,NULL,'parkir mobil tronton',0),(2,3100001,'3100001',6600001,'6600001','EST-SPP/SWJ/08/19/6600001','2019-08-15 00:00:00',20190815,'2019-08-15 00:00:00',20190815,102505950000183,'102505950000183','ABBOCATH NO 24','PCS',2,20000,40000,'1','TANAMAN','2019-08-15 15:36:21',201908,2019,'merk 2','2019-08-15 15:36:21','Staff Purchasing','-\r\n','EST/BWJ/JKT/08/19/3100001','HO',20000,0,'Rp',0,'LC & TANAM',0,NULL,0,0,0,0,NULL,'-',0),(3,3100002,'3100002',6600002,'6600002','EST-SPP/SWJ/08/19/6600002','2019-08-16 00:00:00',20190816,'2019-08-16 00:00:00',20190816,102505910000006,'102505910000006','KERTAS HVS F4','RIM',20,80000,1625000,'7','UMUM & HRD','2019-08-16 10:34:44',201908,2019,'AVS','2019-08-16 10:34:44','Staff Purchasing','ATK','EST/BWJ/JKT/08/19/3100002','HO',80000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,25000,NULL,'ONGKIR',0),(4,3100002,'3100002',6600002,'6600002','EST-SPP/SWJ/08/19/6600002','2019-08-16 00:00:00',20190816,'2019-08-16 00:00:00',20190816,102505910000012,'102505910000012','KERTAS A4','RIM',15,90000,1375000,'7','UMUM & HRD','2019-08-16 10:34:55',201908,2019,'AVS','2019-08-16 10:34:55','Staff Purchasing','ATK','EST/BWJ/JKT/08/19/3100002','HO',90000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,25000,NULL,'ONGKIR',0),(5,3100003,'3100003',6600003,'6600003','EST-SPPA/SWJ/08/19/6600003','2019-08-16 00:00:00',20190816,'2019-08-16 00:00:00',20190816,102505990000057,'102505990000057','KOMPUTER SET','SET',10,6500000,65200000,'7','UMUM & HRD','2019-08-16 10:39:04',201908,2019,'ASUS','2019-08-16 10:39:04','Dept Head','U/ PERALATAN KERJA','EST/BWJ/POA/JKT/08/19/3100003','HO',6500000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,200000,NULL,'ONGKIR',0),(6,3100004,'3100004',6600004,'6600004','EST-SPP/SWJ/08/19/6600004','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,102505990000057,'102505990000057','KOMPUTER SET','SET',10,6000000,60000000,'7','UMUM & HRD','2019-08-20 17:00:31',201908,2019,'-','2019-08-20 17:00:31','Staff Purchasing','-tes','EST/BWJ/JKT/08/19/3100004','HO',6000000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,0,NULL,'-',0),(7,3100004,'3100004',6600005,'6600005','EST-SPP/SWJ/08/19/6600005','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,102505990000348,'102505990000348','WIRELESS OUTDOOR','UNIT',5,2500000,12500000,'7','UMUM & HRD','2019-08-20 15:16:46',201908,2019,'-','2019-08-20 15:16:46','Staff Purchasing','-','EST/BWJ/JKT/08/19/3100004','HO',2500000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,0,NULL,'-',0),(8,3100004,'3100004',6600006,'6600006','EST-SPP/SWJ/08/19/6600006','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,102505990000222,'102505990000222','GENSET 15KVA','UNIT',1,3000000,3000000,'8','TEKNIK','2019-08-20 15:16:48',201908,2019,'-','2019-08-20 15:16:48','Staff Purchasing','-','EST/BWJ/JKT/08/19/3100004','HO',3000000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,0,NULL,'-',0),(9,3100004,'3100004',6600007,'6600007','EST-SPP/SWJ/08/19/6600007','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,102505990000133,'102505990000133','PRINTER','UNIT',3,2000000,6000000,'12','HSE','2019-08-20 15:16:50',201908,2019,'-','2019-08-20 15:16:50','Staff Purchasing','-','EST/BWJ/JKT/08/19/3100004','HO',2000000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,0,NULL,'-',0),(10,3100005,'3100005',6600008,'6600008','EST-SPP/SWJ/08/19/6600008','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,102505990000049,'102505990000049','HARDISK KAPASITAS 500 GB','BH',5,500000,2500000,'7','UMUM & HRD','2019-08-20 16:18:12',201908,2019,'wd','2019-08-20 16:18:12','Staff Purchasing','po tanggal 20','EST/BWJ/JKT/08/19/3100005','HO',500000,0,'Rp',0,'KANTOR',0,NULL,0,0,0,0,NULL,'-',0);

/*Table structure for table `po` */

DROP TABLE IF EXISTS `po`;

CREATE TABLE `po` (
  `id` int(11) DEFAULT NULL,
  `kd_dept` int(11) DEFAULT NULL,
  `ket_dept` varchar(100) DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL,
  `kode_budet` double DEFAULT NULL,
  `kd_subbudget` varchar(20) DEFAULT NULL,
  `ket_subbudget` varchar(100) DEFAULT NULL,
  `kode_supply` varchar(50) DEFAULT NULL,
  `nama_supply` varchar(100) DEFAULT NULL,
  `kode_pemesan` varchar(10) DEFAULT NULL,
  `pemesan` varchar(75) DEFAULT NULL,
  `nopo` double DEFAULT NULL,
  `nopotxt` varchar(15) DEFAULT NULL,
  `noppo` double DEFAULT NULL,
  `noppotxt` varchar(15) DEFAULT NULL COMMENT 'Flag 1 jika qty LPB = qty PO',
  `no_refppo` varchar(50) DEFAULT NULL,
  `tgl_refppo` datetime DEFAULT NULL,
  `tgl_reftxt` double DEFAULT NULL,
  `tglpo` datetime DEFAULT NULL,
  `tglpotxt` double DEFAULT NULL,
  `tglppo` datetime DEFAULT NULL,
  `tglppotxt` double DEFAULT NULL,
  `bayar` varchar(15) DEFAULT NULL,
  `tempo_bayar` double DEFAULT NULL,
  `lokasikirim` varchar(100) DEFAULT NULL,
  `tempo_kirim` double DEFAULT NULL,
  `lokasi_beli` varchar(50) DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `kodept` varchar(5) DEFAULT NULL,
  `namapt` varchar(100) DEFAULT NULL,
  `no_acc` double DEFAULT NULL,
  `ket_acc` varchar(100) DEFAULT NULL COMMENT 'Di logistik web, ini untuk data input no penawaran di menu PO',
  `periode` datetime DEFAULT NULL,
  `periodetxt` double DEFAULT NULL,
  `thn` double DEFAULT NULL,
  `tglisi` datetime DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `ppn` varchar(2) DEFAULT NULL,
  `totalbayar` double DEFAULT NULL,
  `ket_kirim` varchar(255) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `noreftxt` varchar(255) DEFAULT NULL,
  `uangmuka` double DEFAULT NULL,
  `voucher` varchar(100) DEFAULT NULL,
  `terbayar` smallint(6) DEFAULT NULL,
  `nopp` varchar(255) DEFAULT NULL,
  `batal` smallint(6) DEFAULT NULL,
  `kirim` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `po` */

insert  into `po`(`id`,`kd_dept`,`ket_dept`,`grup`,`kode_budet`,`kd_subbudget`,`ket_subbudget`,`kode_supply`,`nama_supply`,`kode_pemesan`,`pemesan`,`nopo`,`nopotxt`,`noppo`,`noppotxt`,`no_refppo`,`tgl_refppo`,`tgl_reftxt`,`tglpo`,`tglpotxt`,`tglppo`,`tglppotxt`,`bayar`,`tempo_bayar`,`lokasikirim`,`tempo_kirim`,`lokasi_beli`,`ket`,`kodept`,`namapt`,`no_acc`,`ket_acc`,`periode`,`periodetxt`,`thn`,`tglisi`,`user`,`ppn`,`totalbayar`,`ket_kirim`,`lokasi`,`noreftxt`,`uangmuka`,`voucher`,`terbayar`,`nopp`,`batal`,`kirim`) values (1,0,'','',0,'0',NULL,'0002','A YONG, BPK.','27','Staff Purchasing',3100001,'3100001',0,'1','','0000-00-00 00:00:00',0,'2019-08-15 00:00:00',20190815,'0000-00-00 00:00:00',0,'Cash',30,'lokasi kirim',30,'HO','ket 1','0','',0,'123','2019-08-15 16:08:59',201908,2019,'2019-08-15 16:08:59','Staff Purchasing','Y',59000,'ket kirim','HO','EST/BWJ/JKT/08/19/3100001',1000000,'324',0,NULL,0,1),(2,0,'','',0,'0',NULL,'562','VENUS COMPUTER/YUNITA TANWIN','27','Staff Purchasing',3100002,'3100002',0,'1','','0000-00-00 00:00:00',0,'2019-08-16 00:00:00',20190816,'0000-00-00 00:00:00',0,'Kredit',30,'HO',7,'HO','PROSESS','0','',0,'11','2019-08-16 10:34:55',201908,2019,'2019-08-16 10:34:55','Staff Purchasing','N',3000000,'SEGERA','HO','EST/BWJ/JKT/08/19/3100002',0,'-',0,NULL,0,1),(3,0,'','',0,'0',NULL,'593','PC SMART / PATRICIA TEGUH','27','Staff Purchasing',3100003,'3100003',0,'1','','0000-00-00 00:00:00',0,'2019-08-16 00:00:00',20190816,'0000-00-00 00:00:00',0,'Kredit',30,'HO',7,'HO','PERABOT KANTOR','0','',0,'11','2019-08-16 10:39:04',201908,2019,'2019-08-16 10:39:04','Dept Head','N',65200000,'SEGERA','HO','EST/BWJ/POA/JKT/08/19/3100003',0,'11',0,NULL,0,1),(4,0,'','',0,'0',NULL,'593','PC SMART / PATRICIA TEGUH','27','Staff Purchasing',3100004,'3100004',0,'0','','0000-00-00 00:00:00',0,'2019-08-20 00:00:00',20190820,'0000-00-00 00:00:00',0,'Kredit',30,'HO',20,'HO','SPP PARSIAL','0','',0,'11','2019-08-20 17:00:31',201908,2019,'2019-08-20 17:00:31','Staff Purchasing','N',81500000,'SEGERA','HO','EST/BWJ/JKT/08/19/3100004',0,'-',1,'110002',0,1),(5,0,'','',0,'0',NULL,'562','VENUS COMPUTER/YUNITA TANWIN','27','Staff Purchasing',3100005,'3100005',0,'1','','0000-00-00 00:00:00',0,'2019-08-20 00:00:00',20190820,'0000-00-00 00:00:00',0,'Kredit',30,'HO',7,'HO','-garansi resmi\n','0','',0,'11','2019-08-20 16:18:12',201908,2019,'2019-08-20 16:18:12','Staff Purchasing','N',2500000,'segera','HO','EST/BWJ/JKT/08/19/3100005',0,'-',1,'110001',0,1);

/*Table structure for table `pp` */

DROP TABLE IF EXISTS `pp`;

CREATE TABLE `pp` (
  `id` int(11) DEFAULT NULL,
  `nopp` double DEFAULT NULL,
  `nopptxt` varchar(7) DEFAULT NULL,
  `nopo` double DEFAULT NULL,
  `nopotxt` varchar(7) DEFAULT NULL,
  `tglpp` datetime DEFAULT NULL,
  `tglpptxt` double DEFAULT NULL,
  `tglpo` datetime DEFAULT NULL,
  `tglpotxt` double DEFAULT NULL,
  `ref_po` varchar(255) DEFAULT NULL,
  `kode_supply` double DEFAULT NULL,
  `kode_supplytxt` varchar(7) DEFAULT NULL,
  `nama_supply` varchar(90) DEFAULT NULL,
  `kepada` varchar(60) DEFAULT NULL,
  `bayar` varchar(10) DEFAULT NULL,
  `KURS` varchar(5) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `pajak` double DEFAULT NULL,
  `jumlahpo` double DEFAULT NULL,
  `KODE_BPO` double DEFAULT NULL,
  `jumlah_bpo` double DEFAULT NULL,
  `total_po` double DEFAULT NULL,
  `terbilang` varchar(255) DEFAULT NULL,
  `ket` varchar(90) DEFAULT NULL,
  `pt` varchar(100) DEFAULT NULL,
  `kodept` varchar(5) DEFAULT NULL,
  `periode` datetime DEFAULT NULL,
  `txtperiode` double DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `tglisi` datetime DEFAULT NULL,
  `status_vou` smallint(6) DEFAULT NULL,
  `no_vou` double DEFAULT NULL,
  `no_voutxt` varchar(20) DEFAULT NULL,
  `tgl_vou` datetime DEFAULT NULL,
  `tgl_voutxt` double DEFAULT NULL,
  `tgl_bayar_real` datetime DEFAULT NULL,
  `kasir_bayar` double DEFAULT NULL,
  `kode_budget` double DEFAULT NULL,
  `grup` varchar(255) DEFAULT NULL,
  `main_account` double DEFAULT NULL,
  `nama_account` varchar(255) DEFAULT NULL,
  `batal` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pp` */

insert  into `pp`(`id`,`nopp`,`nopptxt`,`nopo`,`nopotxt`,`tglpp`,`tglpptxt`,`tglpo`,`tglpotxt`,`ref_po`,`kode_supply`,`kode_supplytxt`,`nama_supply`,`kepada`,`bayar`,`KURS`,`jumlah`,`pajak`,`jumlahpo`,`KODE_BPO`,`jumlah_bpo`,`total_po`,`terbilang`,`ket`,`pt`,`kodept`,`periode`,`txtperiode`,`user`,`tglisi`,`status_vou`,`no_vou`,`no_voutxt`,`tgl_vou`,`tgl_voutxt`,`tgl_bayar_real`,`kasir_bayar`,`kode_budget`,`grup`,`main_account`,`nama_account`,`batal`) values (1,110001,'110001',3100005,'3100005','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,'EST/BWJ/JKT/08/19/3100005',562,'562','VENUS COMPUTER/YUNITA TANWIN','VENUS COMPUTER/YUNITA TANWIN','Kredit','Rp',2500000,0,2500000,0,0,2500000,'Dua Juta Lima Ratus Ribu','TES PP KE CABA ','MSAL HO',NULL,'2019-08-20 00:00:00',201908,'Staff Purchasing','2019-08-20 16:49:00',1,NULL,NULL,NULL,NULL,NULL,2500000,0,'',0,'',0),(2,110002,'110002',3100004,'3100004','2019-08-20 00:00:00',20190820,'2019-08-20 00:00:00',20190820,'EST/BWJ/JKT/08/19/3100004',593,'593','PC SMART / PATRICIA TEGUH','PC SMART / PATRICIA TEGUH','Kredit','Rp',81500000,0,81500000,0,0,81500000,'Delapan Puluh Satu Juta Lima Ratus Ribu','tes part 2','MSAL HO',NULL,'2019-08-20 00:00:00',201908,'Staff Purchasing','2019-08-20 17:04:38',1,NULL,NULL,NULL,NULL,NULL,81500000,0,'',0,'',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
