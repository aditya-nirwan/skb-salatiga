-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5989
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for skb_salatiga
CREATE DATABASE IF NOT EXISTS `skb_salatiga` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `skb_salatiga`;

-- Dumping structure for table skb_salatiga.tb_loker
CREATE TABLE IF NOT EXISTS `tb_loker` (
  `loker_id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan_id` int(11) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `deskripsi_loker` text NOT NULL,
  `syarat` text NOT NULL,
  `gaji` varchar(50) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`loker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_loker: ~5 rows (approximately)
/*!40000 ALTER TABLE `tb_loker` DISABLE KEYS */;
INSERT INTO `tb_loker` (`loker_id`, `perusahaan_id`, `posisi`, `tipe`, `jenis`, `lokasi`, `deskripsi_loker`, `syarat`, `gaji`, `created`, `deadline`) VALUES
	(1, 1, 'Game Programmer', 'Fulltime', 'Game', 'Salatiga', 'Membuat game edukasi anak-anak usia 3-6 tahun', 'Mahir menggunakan unity 3d', NULL, '2022-03-08', '2022-03-31'),
	(13, 1, 'Android Developer', 'Fulltime', 'Developer', 'Salatiga', 'Membuat aplikasi android sesuai dengan kebutuhan perusahaan', 'Mahir android studio kotlin/java', '>5jt', '2022-03-25', '2022-03-31'),
	(14, 1, 'Customer Service', 'Fulltime', 'Komunikasi', 'Salatiga', 'Melayani pelanggan ', 'Punya pengalaman di bidang yg sama 1 tahun', 'UMK Kota Salatiga', '2022-03-25', '2022-03-30'),
	(15, 1, 'Graphic Designer', 'Parttime', 'Kreatif', 'Online', 'Membuat desain sesuai kebutuhan perusahaan', 'Dapat menggunakan corel draw, ps, ai, dll', '3jt an', '2022-03-25', '2022-03-28'),
	(16, 1, 'Frontend Web Developer', 'Fulltime', 'Web', 'Salatiga', 'Membuat  frontend untuk kebutuhan perusahaan', 'Dapat membuat frontend dengan react', '>5 jt', '2022-03-25', '2022-04-01'),
	(17, 1, 'Backend Web', 'Fulltime', 'Web', 'Salatiga', 'Bekerja sama dengan tim frontend membangun web sesuai kebutuhan perusahaan', 'Menguasai Js', 'UMK Kota Salatiga', '2022-03-25', '2022-04-01'),
	(18, 3, 'Operator produksi', 'Fulltime', 'Manufaktur', 'Salatiga', 'Bekerja sesuai SOP, mengikuti PFC, melakukan urutan kerja sesuai lembar kerja yang sudah ada', 'Usia minimal 18 tahun, Pendidikan minimal SMA/SMK', 'UMK Kota Salatiga', '2022-03-25', '2022-04-09'),
	(19, 3, 'Operator Jahit', 'Fulltime', 'Manufaktur', 'Salatiga', 'Membuat produk jahit yang berkualitas baik', 'Memiliki skill menjahit dasar', 'UMK Kota Salatiga', '2022-03-25', '2022-04-09'),
	(20, 3, 'Operator Quality', 'Fulltime', 'Manufaktur', 'Salatiga', 'Membuat data hasil pengecekan produk', 'Memiliki pengalaman kerja min 1 tahun di bagian Quality', 'UMK Kota Salatiga', '2022-03-25', '2022-04-09'),
	(21, 3, 'Operator CE', 'Fulltime', 'Manufaktur', 'Salatiga', 'Bertanggung jawab dalam pengontrolan suhu dan checklist ', 'Pendidikan minimal sma/k', 'UMK Kota Salatiga', '2022-03-25', '2022-04-09'),
	(22, 3, 'OPERATOR MAINTENANCE VEHICLE', 'Fulltime', 'Manufaktur', 'Salatiga', 'Memastikan kendaraan siap untuk beroperasi, Melakukan pemantauan terhadap kondisi kendaraan, Melakukan perbaikan dan perawatan kendaraan', 'Memahami cara perbaikan dan perawatan kendaraan', 'UMK Kota Salatiga', '2022-03-25', '2022-04-09');
/*!40000 ALTER TABLE `tb_loker` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_notif
CREATE TABLE IF NOT EXISTS `tb_notif` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `pd_id` int(11) NOT NULL,
  `loker_id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `read_pd` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`notif_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_notif: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_notif` DISABLE KEYS */;
INSERT INTO `tb_notif` (`notif_id`, `pd_id`, `loker_id`, `jenis`, `perusahaan`, `posisi`, `tanggal`, `read_pd`) VALUES
	(24, 21, 21, 'Pengajuan', 'PT SCI', 'Operator CE', '2022-03-25', 'Y'),
	(25, 16, 21, 'Pengajuan', 'PT SCI', 'Operator CE', '2022-03-25', 'Y');
/*!40000 ALTER TABLE `tb_notif` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_notif_admin
CREATE TABLE IF NOT EXISTS `tb_notif_admin` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `loker_id` int(11) NOT NULL,
  `perusahaan` varchar(50) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `read` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_notif_admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_notif_admin` DISABLE KEYS */;
INSERT INTO `tb_notif_admin` (`notif_id`, `loker_id`, `perusahaan`, `posisi`, `tanggal`, `read`) VALUES
	(8, 13, 'Educa Studio', 'Android Developer', '2022-03-25', 'Y'),
	(9, 14, 'Educa Studio', 'Customer Service', '2022-03-25', 'Y'),
	(10, 15, 'Educa Studio', 'Graphic Designer', '2022-03-25', 'Y'),
	(11, 16, 'Educa Studio', 'Frontend Web Developer', '2022-03-25', 'Y'),
	(12, 17, 'Educa Studio', 'Backend Web', '2022-03-25', 'Y'),
	(13, 18, 'PT SCI', 'Operator produksi', '2022-03-25', 'Y'),
	(14, 19, 'PT SCI', 'Operator Jahit', '2022-03-25', 'Y'),
	(15, 20, 'PT SCI', 'Operator Quality', '2022-03-25', 'Y'),
	(16, 21, 'PT SCI', 'Operator CE', '2022-03-25', 'Y'),
	(17, 22, 'PT SCI', 'OPERATOR MAINTENANCE VEHICLE', '2022-03-25', 'Y');
/*!40000 ALTER TABLE `tb_notif_admin` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_notif_perusahaan
CREATE TABLE IF NOT EXISTS `tb_notif_perusahaan` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan_id` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL,
  `loker_id` int(11) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `read_perusahaan` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`notif_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_notif_perusahaan: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_notif_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_notif_perusahaan` (`notif_id`, `perusahaan_id`, `pd_id`, `loker_id`, `posisi`, `tanggal`, `read_perusahaan`) VALUES
	(21, 3, 21, 21, 'Operator CE', '2022-03-25', 'Y'),
	(22, 3, 16, 21, 'Operator CE', '2022-03-25', 'Y');
/*!40000 ALTER TABLE `tb_notif_perusahaan` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_pd
CREATE TABLE IF NOT EXISTS `tb_pd` (
  `pd_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pd` varchar(50) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`pd_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_pd: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_pd` DISABLE KEYS */;
INSERT INTO `tb_pd` (`pd_id`, `nama_pd`, `gender`, `tgl_lahir`, `user_id`) VALUES
	(1, 'Rian Okta', 'L', '1999-10-10', 4),
	(11, 'Okta Rian', 'L', '2000-02-02', 45),
	(12, 'Haryu P', 'L', '2000-10-10', 46),
	(13, 'Sapto Tri', 'L', '1998-05-05', 47),
	(14, 'Faqih', 'L', '1999-05-15', 48),
	(15, 'Baskoro', 'L', '1999-02-18', 49),
	(16, 'Fian', 'L', '2000-06-20', 50),
	(17, 'Fadhil Dwi', 'L', '2005-11-10', 51),
	(18, 'Fara', 'L', '2000-09-25', 52),
	(21, 'Irfan', 'L', '2000-02-02', 55);
/*!40000 ALTER TABLE `tb_pd` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_pengajuan
CREATE TABLE IF NOT EXISTS `tb_pengajuan` (
  `pengajuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `loker_id` int(11) NOT NULL,
  PRIMARY KEY (`pengajuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_pengajuan: ~5 rows (approximately)
/*!40000 ALTER TABLE `tb_pengajuan` DISABLE KEYS */;
INSERT INTO `tb_pengajuan` (`pengajuan_id`, `loker_id`) VALUES
	(22, 21);
/*!40000 ALTER TABLE `tb_pengajuan` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_pengajuan_detail
CREATE TABLE IF NOT EXISTS `tb_pengajuan_detail` (
  `pengajuan_id` int(11) NOT NULL,
  `pd_id` int(11) NOT NULL,
  `tgl_pengajuan` date DEFAULT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_pengajuan_detail: ~11 rows (approximately)
/*!40000 ALTER TABLE `tb_pengajuan_detail` DISABLE KEYS */;
INSERT INTO `tb_pengajuan_detail` (`pengajuan_id`, `pd_id`, `tgl_pengajuan`, `status`) VALUES
	(22, 21, '2022-03-25', 'Y'),
	(22, 16, '2022-03-25', 'W');
/*!40000 ALTER TABLE `tb_pengajuan_detail` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_perusahaan
CREATE TABLE IF NOT EXISTS `tb_perusahaan` (
  `perusahaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `bidang` varchar(20) NOT NULL,
  `profil` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`perusahaan_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_perusahaan: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_perusahaan` DISABLE KEYS */;
INSERT INTO `tb_perusahaan` (`perusahaan_id`, `nama_perusahaan`, `no_telp`, `bidang`, `profil`, `user_id`) VALUES
	(1, 'Educa Studio', '123', 'Game', 'It was started by two PC game products, they were Marbel and Shoot Empire (as the first winner of Game Competition 2008). Later on, the founder decided to take it more professional by establishing Educa Studio on 1st April 2012. At that moment, we only focused on Edu PC Games. Later, in 2012, we plunged into Mobile Apps and Games. In 2013, we expanded into broader mobile platforms such as Windows Phone and Apple Store (iOS). We have a lot of sucessul IP such as Marbel for Educational Games for Kids, Riri for Interactive Story Books, Kabi for Moslem Kids, Kolak for Interactive Kids Song. In 2017, its amazing year we have a lot of platform to build quality content and expanding our company into merchandising, board games, interactive animation and teacher platform.', 2),
	(3, 'PT SCI', '123', 'Manufaktur', 'PT Selalu Cinta Indonesia', 33);
/*!40000 ALTER TABLE `tb_perusahaan` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_sekolah
CREATE TABLE IF NOT EXISTS `tb_sekolah` (
  `pd_id` int(11) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `tahun_masuk` varchar(10) NOT NULL,
  `tahun_lulus` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_sekolah: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_sekolah` DISABLE KEYS */;
INSERT INTO `tb_sekolah` (`pd_id`, `sekolah`, `tahun_masuk`, `tahun_lulus`, `keterangan`) VALUES
	(1, 'SMK Muhammadiyah Salatiga', '2015', '2018', '');
/*!40000 ALTER TABLE `tb_sekolah` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_sertifikat
CREATE TABLE IF NOT EXISTS `tb_sertifikat` (
  `pd_id` int(11) NOT NULL,
  `pelatihan` varchar(50) NOT NULL,
  `penyelenggara` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_sertifikat: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_sertifikat` DISABLE KEYS */;
INSERT INTO `tb_sertifikat` (`pd_id`, `pelatihan`, `penyelenggara`, `tahun`) VALUES
	(1, 'Menyetir', 'Unistama', '2022'),
	(1, 'Aplikasi Kantor', 'SKB Salatiga', '2020'),
	(1, 'Canva', 'SKB Salatiga', '2020');
/*!40000 ALTER TABLE `tb_sertifikat` ENABLE KEYS */;

-- Dumping structure for table skb_salatiga.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin, 2:ph, 3:pd',
  `created` date DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table skb_salatiga.tb_user: ~8 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`user_id`, `username`, `password`, `email`, `alamat`, `no_hp`, `level`, `created`, `image`) VALUES
	(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'adit@gmail.com', 'Salatiga', '6285726556966', 1, '2022-03-05', 'admin-220325-41aa53a1e0.png'),
	(2, 'educa', 'ce34f92d78c342a9a4f11071a6af3dc1fe8b4b4e', 'info@educa.com', 'Salatiga', '6281222333444', 2, '2022-03-05', 'perusahaan-220325-4b7c354783.png'),
	(4, 'rian', '4116e0e25dcad2dd4b202b3eaf2b4f1ae6497e25', 'rian@gmail.com', 'Pabelan, Semarang', '6283838358682', 3, '2022-03-06', 'item-220325-d9f9acf1c2.png'),
	(6, 'adit', '2e445949d370543ad32c166c38b1278d67316509', 'adit@timbiru.com', 'Ampel, Boyolali', '6281234567890', 1, '2022-03-07', NULL),
	(33, 'sci', 'd39590e8cade1c238a5e4dec331b7589fbc91b98', 'info@sci.com', 'Argomulyo, Salatiga', '6285766667777', 2, '2022-03-08', 'perusahaan-220325-6f6ded0185.png'),
	(45, 'okta', '0004ce55d3e7483604d06abbf27126641b135221', 'okta@gmail.com', 'Pabelan, Semarang', '6285726556966', 3, '2022-03-25', 'item-220325-5c723b43fd.png'),
	(46, 'haryu', 'ebcd95a988d8457a9b9ec19dbc309c72e92c2525', 'haryu@gmail.com', 'Suruh, Semarang', '6285726556966', 3, '2022-03-25', 'item-220325-78c521c18b.png'),
	(47, 'sapto', 'c1960de5402012ba3e8b103c6513a6e5922939bd', 'sapto@timmerah.com', 'Teras, Boyolali', '6285726556966', 3, '2022-03-25', NULL),
	(48, 'faqih', '0d404ffe041254a08fbc819a2c6224e2c295be61', 'irfan@timbiru.com', 'Noborejo, Salatiga', '6285726556966', 3, '2022-03-25', NULL),
	(49, 'baskoro', '1bdd48472fc4e0f5c3e6e5d7ee71ec316aa0a48f', 'baskoro@gmail.com', 'Jetis, Salatiga', '6285726556966', 3, '2022-03-25', NULL),
	(50, 'fian', '93bbdbef9394560676c030e8da80e0d10dcc616f', 'fian@timmerah.com', 'Ampel, Boyolali', '6285726556966', 3, '2022-03-25', 'item-220325-0e14fd8b74.png'),
	(51, 'fadhil', '9cf949c125e5af6dc3bb8379638be8b32058c7d9', 'fadhil@gmail.com', 'Ampel, Boyolali', '6285726556966', 3, '2022-03-25', NULL),
	(52, 'fara', '751216d4c8664d10796f49e5f28f350a90e42f00', 'fara@gmail.com', 'Ampel, Boyolali', '6285726556966', 3, '2022-03-25', NULL),
	(55, 'irfan', 'd12f14157c21b39cc8cc257dc5662f34217524f9', 'irfan@timbiru.com', 'Noborejo, Salatiga', '6285726556966', 3, '2022-03-25', 'item-220325-c8861ed879.png');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
