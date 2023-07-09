-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.22-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table bsi_init.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `session_id` char(36) NOT NULL DEFAULT uuid(),
  `session_expire` timestamp NOT NULL DEFAULT current_timestamp(),
  `area_manager` varchar(30) NOT NULL DEFAULT '',
  `pj_aosm` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.admin: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`username`, `password`, `session_id`, `session_expire`, `area_manager`, `pj_aosm`) VALUES
	('bsi', '8cb2237d0679ca88db6464eac60da96345513964', '6f2b6d9d-5fec-11ed-8fed-0a0027000008', '2022-11-09 12:07:40', '(belum ditentukan)', '(belum ditentukan)');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- membuang struktur untuk table bsi_init.beban
CREATE TABLE IF NOT EXISTS `beban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '',
  `rekening` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.beban: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `beban` DISABLE KEYS */;
INSERT INTO `beban` (`id`, `nama`, `rekening`) VALUES
	(1, 'Setor Tunai', '');
/*!40000 ALTER TABLE `beban` ENABLE KEYS */;

-- membuang struktur untuk procedure bsi_init.delete_jurnal
DELIMITER //
CREATE PROCEDURE `delete_jurnal`(
	IN `p_id` INT
)
BEGIN
	SELECT debit, kredit, waktu INTO @delD, @delK, @delW FROM jurnal WHERE id = p_id;
	UPDATE jurnal
	SET saldo = saldo + IFNULL(@delD, 0) - IFNULL(@delK, 0)
	WHERE waktu >= @delW AND id > p_id;
	DELETE FROM jurnal WHERE id = p_id;
END//
DELIMITER ;

-- membuang struktur untuk procedure bsi_init.get_jurnal
DELIMITER //
CREATE PROCEDURE `get_jurnal`(
	IN `awal` DATE,
	IN `akhir` DATE
)
BEGIN	
	SELECT j.id, j.waktu, j.nomor, j.nama, j.debit, j.kredit, j.saldo FROM jurnal j
	WHERE j.waktu >= awal AND j.waktu <= akhir + INTERVAL 1 DAY
	UNION (SELECT 0, '', 0, 'Saldo Sebelumnya', NULL, NULL, 
		IFNULL((SELECT saldo FROM jurnal 
		WHERE YEAR(waktu) = YEAR(awal) AND waktu < awal 
		ORDER BY waktu DESC LIMIT 1), 0)
	FROM DUAL)
	ORDER BY waktu ASC, id ASC;
END//
DELIMITER ;

-- membuang struktur untuk procedure bsi_init.insert_penyelesaian
DELIMITER //
CREATE PROCEDURE `insert_penyelesaian`(
	IN `pbeban` INT,
	IN `ppersekot` INT,
	IN `pjumlah` INT,
	IN `prekening` VARCHAR(50)
)
BEGIN
	INSERT INTO penyelesaian SET
		beban = pbeban,
		jumlah = pjumlah,
		rekening = prekening,
		persekot = ppersekot;
	UPDATE persekot SET
		sisa = sisa - pjumlah
		WHERE id = ppersekot;
	INSERT INTO jurnal SET
		nama = (SELECT b.nama FROM beban b WHERE b.id = pbeban),
		kredit = pjumlah,
		saldo = IFNULL((SELECT s.saldo FROM jurnal s 
		WHERE YEAR(s.waktu) = YEAR(NOW()) 
		ORDER BY s.id DESC LIMIT 1), 0) + pjumlah;
END//
DELIMITER ;

-- membuang struktur untuk procedure bsi_init.insert_persekot
DELIMITER //
CREATE PROCEDURE `insert_persekot`(
	IN `pnarasi` VARCHAR(100),
	IN `pjenis` INT,
	IN `pjumlah` INT
)
BEGIN
	INSERT INTO persekot SET 
		narasi = pnarasi, 
		jenis = pjenis, 
		jumlah = pjumlah, 
		sisa = pjumlah;
	INSERT INTO jurnal SET 
		nama = pnarasi, 
		debit = pjumlah, 
		saldo = IFNULL((SELECT s.saldo FROM jurnal s 
		WHERE YEAR(s.waktu) = YEAR(NOW()) 
		ORDER BY s.id DESC LIMIT 1), 0) - pjumlah;
END//
DELIMITER ;

-- membuang struktur untuk table bsi_init.jenis_persekot
CREATE TABLE IF NOT EXISTS `jenis_persekot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '',
  `rekening` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.jenis_persekot: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `jenis_persekot` DISABLE KEYS */;
INSERT INTO `jenis_persekot` (`id`, `nama`, `rekening`) VALUES
	(1, 'Default', '0');
/*!40000 ALTER TABLE `jenis_persekot` ENABLE KEYS */;

-- membuang struktur untuk table bsi_init.jurnal
CREATE TABLE IF NOT EXISTS `jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `nomor` varchar(15) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL DEFAULT '',
  `debit` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `saldo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `waktu` (`waktu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.jurnal: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `jurnal` DISABLE KEYS */;
/*!40000 ALTER TABLE `jurnal` ENABLE KEYS */;

-- membuang struktur untuk table bsi_init.penyelesaian
CREATE TABLE IF NOT EXISTS `penyelesaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `beban` int(11) NOT NULL DEFAULT 0,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `rekening` varchar(100) NOT NULL DEFAULT '',
  `persekot` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `waktu` (`waktu`),
  KEY `beban` (`beban`),
  KEY `FK_penyelesaian_persekot` (`persekot`),
  CONSTRAINT `FK__beban` FOREIGN KEY (`beban`) REFERENCES `beban` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_penyelesaian_persekot` FOREIGN KEY (`persekot`) REFERENCES `persekot` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.penyelesaian: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `penyelesaian` DISABLE KEYS */;
/*!40000 ALTER TABLE `penyelesaian` ENABLE KEYS */;

-- membuang struktur untuk table bsi_init.persekot
CREATE TABLE IF NOT EXISTS `persekot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(15) NOT NULL DEFAULT '',
  `narasi` varchar(100) NOT NULL DEFAULT '',
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 0,
  `sisa` int(11) NOT NULL DEFAULT 0,
  `keterangan` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `waktu` (`waktu`),
  KEY `sisa` (`sisa`),
  KEY `FK_persekot_jenis_persekot` (`jenis`),
  CONSTRAINT `FK_persekot_jenis_persekot` FOREIGN KEY (`jenis`) REFERENCES `jenis_persekot` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init.persekot: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `persekot` DISABLE KEYS */;
/*!40000 ALTER TABLE `persekot` ENABLE KEYS */;

-- membuang struktur untuk table bsi_init._riwayat
CREATE TABLE IF NOT EXISTS `_riwayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `tipe` tinyint(4) NOT NULL DEFAULT 0,
  `idkey` varchar(30) NOT NULL DEFAULT '',
  `keterangan` varchar(100) NOT NULL DEFAULT '',
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel bsi_init._riwayat: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `_riwayat` DISABLE KEYS */;
INSERT INTO `_riwayat` (`id`, `waktu`, `tipe`, `idkey`, `keterangan`, `jumlah`) VALUES
	(25, '2022-11-10 20:07:40', 4, '1', 'Setor Tunai:', NULL),
	(26, '2023-07-07 21:09:35', 35, '7', 'Default:0', NULL);
/*!40000 ALTER TABLE `_riwayat` ENABLE KEYS */;

-- membuang struktur untuk trigger bsi_init.beban_delete_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `beban_delete_update` BEFORE DELETE ON `beban` FOR EACH ROW BEGIN
	UPDATE penyelesaian SET beban = 1 WHERE beban = OLD.id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init.jurnal_pengambilan
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `jurnal_pengambilan` AFTER INSERT ON `persekot` FOR EACH ROW BEGIN
	INSERT INTO jurnal SET 
		nama = NEW.narasi, 
		debit = NEW.jumlah,
		nomor = NEW.nomor,
		saldo = IFNULL((SELECT s.saldo FROM jurnal s 
		WHERE YEAR(s.waktu) = YEAR(NOW()) 
		ORDER BY s.id DESC LIMIT 1), 0) - NEW.jumlah;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init.jurnal_persekot_penyelesaian
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `jurnal_persekot_penyelesaian` AFTER INSERT ON `penyelesaian` FOR EACH ROW BEGIN
	UPDATE persekot SET
		sisa = sisa - NEW.jumlah
		WHERE id = NEW.persekot;
	INSERT INTO jurnal SET
		nama = (SELECT b.nama FROM beban b WHERE b.id = NEW.beban),
		kredit = NEW.jumlah,
		nomor = (SELECT p.nomor FROM persekot p WHERE p.id = NEW.persekot),
		saldo = IFNULL((SELECT s.saldo FROM jurnal s 
		WHERE YEAR(s.waktu) = YEAR(NOW()) 
		ORDER BY s.id DESC LIMIT 1), 0) + NEW.jumlah;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init.penyelesaian_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `penyelesaian_after_delete` AFTER DELETE ON `penyelesaian` FOR EACH ROW BEGIN
	UPDATE persekot
	SET sisa = sisa + OLD.jumlah
	WHERE id = OLD.persekot;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_01_pengambilan_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_01_pengambilan_insert` AFTER INSERT ON `persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 1,
idkey = CONCAT(NEW.jenis, ':', NEW.id),
keterangan = CONCAT(NEW.nomor, ':', NEW.narasi),
jumlah = NEW.jumlah
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_02_penyelesaian_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_02_penyelesaian_insert` AFTER INSERT ON `penyelesaian` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 2,
idkey = CONCAT(NEW.persekot, ':', NEW.id),
keterangan = (SELECT nama FROM beban WHERE id = NEW.beban),
jumlah = NEW.jumlah
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_03_jenis_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_03_jenis_insert` AFTER UPDATE ON `jenis_persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 3,
idkey = NEW.id,
keterangan = CONCAT(NEW.nama, ':', NEW.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_04_beban_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_04_beban_insert` AFTER INSERT ON `beban` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 4,
idkey = NEW.id,
keterangan = CONCAT(NEW.nama, ':', NEW.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_17_pengambilan_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_17_pengambilan_update` AFTER UPDATE ON `persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 17,
idkey = CONCAT(NEW.jenis, ':', NEW.id),
keterangan = CONCAT(NEW.nomor, ':', NEW.narasi),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_19_jenis_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_19_jenis_update` BEFORE UPDATE ON `jenis_persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 19,
idkey = NEW.id,
keterangan = CONCAT(NEW.nama, ':', NEW.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_20_beban_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_20_beban_update` BEFORE UPDATE ON `beban` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 20,
idkey = NEW.id,
keterangan = CONCAT(NEW.nama, ':', NEW.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_33_pengambilan_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_33_pengambilan_delete` BEFORE DELETE ON `persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 33,
idkey = CONCAT(OLD.jenis, ':', OLD.id),
keterangan = CONCAT(OLD.nomor, ':', OLD.narasi),
jumlah = OLD.jumlah
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_34_penyelesaian_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_34_penyelesaian_delete` BEFORE DELETE ON `penyelesaian` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 34,
idkey = CONCAT(OLD.persekot, ':', OLD.id),
keterangan = (SELECT nama FROM beban WHERE id = OLD.beban),
jumlah = OLD.jumlah
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_35_jenis_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_35_jenis_delete` BEFORE DELETE ON `jenis_persekot` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 35,
idkey = OLD.id,
keterangan = CONCAT(OLD.nama, ':', OLD.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- membuang struktur untuk trigger bsi_init._riwayat_36_beban_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `_riwayat_36_beban_delete` BEFORE DELETE ON `beban` FOR EACH ROW BEGIN
INSERT INTO _riwayat SET
tipe = 36,
idkey = OLD.id,
keterangan = CONCAT(OLD.nama, ':', OLD.rekening),
jumlah = NULL
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
