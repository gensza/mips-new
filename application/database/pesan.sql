/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.34-MariaDB : Database - db_datasys
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `pesan` */

DROP TABLE IF EXISTS `pesan`;

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subjek` varchar(100) DEFAULT NULL,
  `pesan` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pesan` */

insert  into `pesan`(`id`,`nama`,`email`,`subjek`,`pesan`,`created_at`) values 
(1,'nama','email@gmail.com','subjek','pesan','2019-05-20 09:10:05'),
(2,'asas','1','1','1','2019-05-20 09:10:50'),
(3,'AS','AS','AS','AS','2019-05-20 09:15:25'),
(4,'7','7','7','7','2019-05-20 09:16:00'),
(5,'7878','78','78','7878','2019-05-20 09:16:49');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
