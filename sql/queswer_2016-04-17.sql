# ************************************************************
# Sequel Pro SQL dump
# バージョン 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# ホスト: 192.168.99.100 (MySQL 5.7.11)
# データベース: queswer
# 作成時刻: 2016-04-17 00:55:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ examinations
# ------------------------------------------------------------

LOCK TABLES `examinations` WRITE;
/*!40000 ALTER TABLE `examinations` DISABLE KEYS */;

INSERT INTO `examinations` (`id`, `examination_name`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'ITパスポート試験',NULL,NULL,NULL),
	(2,'基本情報技術者試験午前',NULL,NULL,NULL),
	(3,'応用情報技術者試験午前',NULL,NULL,NULL),
	(4,'ITストラテジスト',NULL,NULL,NULL);

/*!40000 ALTER TABLE `examinations` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ questions
# ------------------------------------------------------------



# テーブルのダンプ rounds
# ------------------------------------------------------------

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;

INSERT INTO `rounds` (`id`, `round_name`, `examination_id`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'平成21年度春',3,NULL,NULL,NULL),
	(2,'平成21年度秋',3,NULL,NULL,NULL),
	(3,'平成22年度春',3,NULL,NULL,NULL),
	(4,'平成22年度秋',3,NULL,NULL,NULL),
	(5,'平成23年度特別',3,NULL,NULL,NULL),
	(6,'平成23年度秋',3,NULL,NULL,NULL),
	(7,'平成24年度春',3,NULL,NULL,NULL),
	(8,'平成24年度秋',3,NULL,NULL,NULL),
	(9,'平成25年度春',3,NULL,NULL,NULL),
	(10,'平成25年度秋',3,NULL,NULL,NULL),
	(11,'平成26年度春',3,NULL,NULL,NULL),
	(12,'平成26年度秋',3,NULL,NULL,NULL),
	(13,'平成27年度春',3,NULL,NULL,NULL),
	(14,'平成27年度秋',3,NULL,NULL,NULL);

/*!40000 ALTER TABLE `rounds` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
