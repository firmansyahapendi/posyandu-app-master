/*
 Navicat Premium Data Transfer

 Source Server         : MacOs okal
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : db_posyandu

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 13/04/2023 11:07:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_anak
-- ----------------------------
DROP TABLE IF EXISTS `tb_anak`;
CREATE TABLE `tb_anak` (
  `id_anak` int(5) NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama_anak` varchar(100) DEFAULT NULL,
  `tmp_lhr` varchar(50) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `bb_lahir` double DEFAULT NULL,
  `tb_lahir` double DEFAULT NULL,
  `jenkel` varchar(1) DEFAULT NULL,
  `anak_ke` tinyint(2) DEFAULT NULL,
  `kms` tinyint(1) DEFAULT NULL,
  `id_ibu` int(5) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_anak`),
  UNIQUE KEY `nik` (`nik`),
  KEY `id_ibu` (`id_ibu`),
  CONSTRAINT `tb_anak_ibfk_1` FOREIGN KEY (`id_ibu`) REFERENCES `tb_ibu` (`id_ibu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_anak
-- ----------------------------
BEGIN;
INSERT INTO `tb_anak` VALUES (1, '3204102602980003', 'Dani Setiawan', 'Bandung', '2022-07-14', 3.5, 75.1, 'L', 3, 0, 5, 0, '2022-12-14 14:56:41', '2023-02-11 15:43:15');
INSERT INTO `tb_anak` VALUES (2, '3217110304590021', 'chamilo', 'Bandung', '2022-07-15', 3.5, 82, 'P', 1, NULL, 6, 0, '2023-01-24 17:51:06', '2023-01-24 21:38:26');
INSERT INTO `tb_anak` VALUES (3, '3217110356990021', 'Audrey Nixie Aribah Santoso', 'BANDUNG', '2023-02-11', 3.9, 123, 'P', 4, NULL, 5, 0, '2023-02-11 15:25:17', '2023-02-11 15:47:37');
COMMIT;

-- ----------------------------
-- Table structure for tb_bidan
-- ----------------------------
DROP TABLE IF EXISTS `tb_bidan`;
CREATE TABLE `tb_bidan` (
  `id_bidan` int(5) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) NOT NULL,
  `nama_bidan` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` int(5) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id_bidan`),
  KEY `user_id` (`id_user`),
  CONSTRAINT `tb_bidan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_bidan
-- ----------------------------
BEGIN;
INSERT INTO `tb_bidan` VALUES (1, '0450162078', 'Rosmalia, AMD.KEB', '0897676544134', 'Bandung', 14, 0, '2023-03-25 20:36:44', '2023-03-25 20:58:23');
COMMIT;

-- ----------------------------
-- Table structure for tb_ibu
-- ----------------------------
DROP TABLE IF EXISTS `tb_ibu`;
CREATE TABLE `tb_ibu` (
  `id_ibu` int(5) NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `tmp_lhr` varchar(50) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `nama_suami` varchar(100) DEFAULT NULL,
  `pekerjaan_suami` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `id_user` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ibu`),
  UNIQUE KEY `nik` (`nik`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `tb_ibu_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_ibu
-- ----------------------------
BEGIN;
INSERT INTO `tb_ibu` VALUES (4, '3204102602980003', 'Julia Angelina', 'Bandung', '2022-12-12', 'IRT', 'Ijal', NULL, 'Jl. Saar Genggong, Karangtanjung, Cililin, Kabupaten Bandung Barat, Jawa Barat 40562', '089616169308', 0, 5, '2022-12-12 13:56:33', '2022-12-12 13:57:10');
INSERT INTO `tb_ibu` VALUES (5, '3204102602980005', 'Dani', 'Bandung', '2022-12-12', 'IRT', 'Ucup', 'ss', 'Jl. Saar Genggong, Karangtanjung, Cililin, Kabupaten Bandung Barat, Jawa Barat 40562', '089616169308', 0, 4, '2022-12-12 13:56:33', '2023-03-25 22:28:49');
INSERT INTO `tb_ibu` VALUES (6, '3204102607980003', 'Anisa Maemun', 'Bandung', '1997-03-03', 'IRT', 'Sodikin', 'Buruh', 'Cililin', '08976546788', 0, 3, '2023-01-22 19:25:18', '2023-01-22 19:25:18');
INSERT INTO `tb_ibu` VALUES (8, '1234567899823456', 'Ani Priatni, S.ST.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 8, '2023-01-23 10:03:06', '2023-01-23 10:03:06');
INSERT INTO `tb_ibu` VALUES (9, '3204102606780003', 'Vina Vinandiani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 9, '2023-03-09 09:42:33', '2023-03-09 09:42:33');
COMMIT;

-- ----------------------------
-- Table structure for tb_imunisasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_imunisasi`;
CREATE TABLE `tb_imunisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vaksin` int(5) DEFAULT '0',
  `id_anak` int(5) DEFAULT NULL,
  `tanggal_imunisasi` date DEFAULT NULL,
  `booster` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_vaksin` (`id_vaksin`),
  KEY `id_anak` (`id_anak`),
  CONSTRAINT `tb_imunisasi_ibfk_1` FOREIGN KEY (`id_vaksin`) REFERENCES `tb_vaksin_imun` (`id_vaksin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_imunisasi_ibfk_2` FOREIGN KEY (`id_anak`) REFERENCES `tb_anak` (`id_anak`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_imunisasi
-- ----------------------------
BEGIN;
INSERT INTO `tb_imunisasi` VALUES (1, 2, 1, '2023-01-21', 'Ya', 'Keterangan', 0, '2023-01-21 19:42:50', '2023-01-21 19:42:50');
INSERT INTO `tb_imunisasi` VALUES (2, 3, 1, '2023-01-23', 'Ya', 'Ujicooba edit kedua', 0, '2023-01-23 19:51:24', '2023-01-23 20:21:22');
INSERT INTO `tb_imunisasi` VALUES (3, 7, 1, '2023-01-23', 'Tidak', 'Ujicooba', 1, '2023-01-23 19:51:24', '2023-01-23 20:19:59');
COMMIT;

-- ----------------------------
-- Table structure for tb_petugas
-- ----------------------------
DROP TABLE IF EXISTS `tb_petugas`;
CREATE TABLE `tb_petugas` (
  `id_petugas` int(5) NOT NULL AUTO_INCREMENT,
  `nip` varchar(15) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` int(5) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `user_id` (`id_user`),
  CONSTRAINT `tb_petugas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_petugas
-- ----------------------------
BEGIN;
INSERT INTO `tb_petugas` VALUES (1, '4567756', 'Petugas Kader', 'Ketua', '0998865', 'bandung', 16, 0, '2023-03-25 21:12:31', '2023-03-25 21:12:31');
COMMIT;

-- ----------------------------
-- Table structure for tb_timbangan
-- ----------------------------
DROP TABLE IF EXISTS `tb_timbangan`;
CREATE TABLE `tb_timbangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `umur` int(11) DEFAULT NULL,
  `tanggal_pencatatan` date DEFAULT NULL,
  `tinggi_badan` double DEFAULT NULL,
  `berat_badan` double DEFAULT '0',
  `kasus` tinyint(2) DEFAULT NULL,
  `id_anak` int(5) DEFAULT NULL,
  `status_gizi` varchar(255) DEFAULT NULL,
  `ket_timbangan` varchar(255) DEFAULT NULL,
  `indikasi_naik` varchar(255) DEFAULT NULL,
  `indikasi_tidak_timbang_bulan_lalu` tinyint(1) DEFAULT NULL,
  `indikasi_baru_timbang_bulan_lalu` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_anak` (`id_anak`),
  CONSTRAINT `tb_timbangan_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `tb_anak` (`id_anak`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_timbangan
-- ----------------------------
BEGIN;
INSERT INTO `tb_timbangan` VALUES (63, 6, '2023-01-24', 120, 5.3, NULL, 2, 'BB Sangat Kurang', 'Balita BGM', 'belum', 1, 1, 0, '2023-01-24 21:33:33', '2023-01-24 21:33:33');
INSERT INTO `tb_timbangan` VALUES (64, 6, '2023-01-24', 89, 5.3, NULL, 1, 'BB Sangat Kurang', 'Balita BGM', 'belum', 1, 1, 0, '2023-01-24 21:37:59', '2023-01-24 21:37:59');
INSERT INTO `tb_timbangan` VALUES (65, 6, '2023-02-11', 143, 6.3, NULL, 1, 'BB Normal', 'Balita Normal', 'naik', 1, 0, 0, '2023-02-11 15:48:56', '2023-02-11 15:48:56');
INSERT INTO `tb_timbangan` VALUES (66, 1, '2023-03-11', 153, 8.3, NULL, 3, 'BB Lebih', 'Balita Gemuk', 'belum', 1, 1, 0, '2023-03-11 10:18:11', '2023-03-11 10:18:11');
INSERT INTO `tb_timbangan` VALUES (68, 8, '2023-03-25', 120, 15, NULL, 1, 'BB Sangat Kurang', 'Balita BGM', 'naik', 1, 1, 0, '2023-03-25 21:43:38', '2023-03-25 21:43:38');
COMMIT;

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `role` enum('admin','bidan','ibu') DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
BEGIN;
INSERT INTO `tb_users` VALUES (1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1', 'admin', 0, '2022-12-14 21:52:28', '2022-12-14 21:52:28');
INSERT INTO `tb_users` VALUES (2, 'ibu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1', 'ibu', 0, '2022-12-14 21:52:28', '2022-12-14 21:52:28');
INSERT INTO `tb_users` VALUES (3, 'anisa', '$2y$10$PydHdm8NSdT2/QLaJKq/ruRZJq7NQFs2gAvM8fgPX9IlJuurpaPOK', '1', 'ibu', 0, '2023-01-22 19:25:18', '2023-01-22 20:02:14');
INSERT INTO `tb_users` VALUES (4, 'dani', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1', 'ibu', 0, '2023-01-22 19:41:24', '2023-01-22 19:41:24');
INSERT INTO `tb_users` VALUES (5, 'julia', '$2y$10$v.MCbIl.f7/c1oA83SkMJ.OE6zGEsH4LGRHZAwGukIVArUfL0J54m', '1', 'ibu', 0, '2023-01-22 19:41:46', '2023-01-22 20:02:25');
INSERT INTO `tb_users` VALUES (8, 'ani', '$2y$10$v.MCbIl.f7/c1oA83SkMJ.OE6zGEsH4LGRHZAwGukIVArUfL0J54m', '1', 'ibu', 0, '2023-01-23 10:03:06', '2023-01-23 11:02:35');
INSERT INTO `tb_users` VALUES (9, 'vina', '$2y$10$LorY9T1fTvA1194NiYKKkOWDJ0Pa5DM8t0TSfNNIEhXExELOJPTK6', '1', 'ibu', 0, '2023-03-09 09:42:33', '2023-03-11 10:17:22');
INSERT INTO `tb_users` VALUES (14, 'rosmalia', '$2y$10$9E5OCr8y/cDkpkNOMtBqDew89HPJF8qvd9FHn4/qLaYcKMPeJa20O', '1', 'admin', 0, '2023-03-25 20:36:44', '2023-03-25 20:59:29');
INSERT INTO `tb_users` VALUES (16, 'petugas', '$2y$10$HOJoaWr.jGrKyhFfO8SJLe/Ut8dOgbEysM7bo71hvf14aqHj3EQlO', '1', 'admin', 0, '2023-03-25 21:12:31', '2023-03-25 21:12:31');
COMMIT;

-- ----------------------------
-- Table structure for tb_vaksin_imun
-- ----------------------------
DROP TABLE IF EXISTS `tb_vaksin_imun`;
CREATE TABLE `tb_vaksin_imun` (
  `id_vaksin` int(5) NOT NULL AUTO_INCREMENT,
  `nama_vaksin` varchar(255) DEFAULT NULL,
  `umur` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_vaksin`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_vaksin_imun
-- ----------------------------
BEGIN;
INSERT INTO `tb_vaksin_imun` VALUES (1, 'DBDD', 12, 0, '2022-12-15 16:13:38', '2022-12-15 16:13:38');
INSERT INTO `tb_vaksin_imun` VALUES (2, 'HBOO', 23, 0, '2022-12-15 09:20:25', '2022-12-15 09:23:12');
INSERT INTO `tb_vaksin_imun` VALUES (3, 'HBOO', 24, 0, '2022-12-15 09:33:37', '2023-01-23 20:18:53');
INSERT INTO `tb_vaksin_imun` VALUES (4, 'DBD', 25, 0, '2022-12-15 09:33:58', '2022-12-15 09:34:05');
INSERT INTO `tb_vaksin_imun` VALUES (5, 'Obat Cacing', 26, 0, '2023-01-14 05:00:01', '2023-01-14 05:00:01');
INSERT INTO `tb_vaksin_imun` VALUES (6, 'DBD', 24, 0, '2023-01-18 14:12:51', '2023-01-18 14:14:39');
INSERT INTO `tb_vaksin_imun` VALUES (7, 'HBOO', 14, 0, '2023-01-18 14:14:59', '2023-01-18 14:15:38');
INSERT INTO `tb_vaksin_imun` VALUES (8, 'DVDD', 14, 0, '2023-01-18 14:15:51', '2023-01-18 14:15:51');
COMMIT;

-- ----------------------------
-- Table structure for tb_vitaminA
-- ----------------------------
DROP TABLE IF EXISTS `tb_vitaminA`;
CREATE TABLE `tb_vitaminA` (
  `id_vitA` int(5) NOT NULL AUTO_INCREMENT,
  `id_anak` int(5) NOT NULL,
  `tgl_vitA` date NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vitA`),
  KEY `id_anak` (`id_anak`),
  CONSTRAINT `tb_vitamina_ibfk_1` FOREIGN KEY (`id_anak`) REFERENCES `tb_anak` (`id_anak`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tb_vitaminA
-- ----------------------------
BEGIN;
INSERT INTO `tb_vitaminA` VALUES (1, 1, '2023-01-21', 'Vitamin A Merah', '2023-01-21 19:50:12', '2023-01-21 19:50:15');
INSERT INTO `tb_vitaminA` VALUES (3, 1, '2023-01-22', 'Vitamin A Biru', '2023-01-22 00:25:53', '2023-01-22 00:25:53');
INSERT INTO `tb_vitaminA` VALUES (4, 1, '2023-02-11', 'Vitamin A Biru', '2023-02-11 15:48:56', '2023-04-12 16:09:36');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
