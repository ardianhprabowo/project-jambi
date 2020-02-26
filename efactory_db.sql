/*
 Navicat Premium Data Transfer

 Source Server         : ggvmcon
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : efactory_db

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 26/02/2020 19:34:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for divisi
-- ----------------------------
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE `divisi`  (
  `iddivisi` int(11) NOT NULL AUTO_INCREMENT,
  `divisi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`iddivisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisi
-- ----------------------------
INSERT INTO `divisi` VALUES (1, 'HC dan Umum', 1);
INSERT INTO `divisi` VALUES (2, 'Teknik dan Humas', 1);
INSERT INTO `divisi` VALUES (3, 'Keuangan Akuntansi dan PKBL', 1);
INSERT INTO `divisi` VALUES (4, 'Pelayanan', 1);
INSERT INTO `divisi` VALUES (5, 'Kepala Cabang', 1);

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan`  (
  `idjabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT 1,
  PRIMARY KEY (`idjabatan`) USING BTREE,
  UNIQUE INDEX `idjabatan`(`idjabatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES (1, 'KABANG', 1);
INSERT INTO `jabatan` VALUES (2, 'KAUNIT', 1);
INSERT INTO `jabatan` VALUES (3, 'STAFF', 1);

-- ----------------------------
-- Table structure for jenis_barang
-- ----------------------------
DROP TABLE IF EXISTS `jenis_barang`;
CREATE TABLE `jenis_barang`  (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_brg` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_jenis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_barang
-- ----------------------------
INSERT INTO `jenis_barang` VALUES (1, 'ATK');
INSERT INTO `jenis_barang` VALUES (2, 'KERTAS');
INSERT INTO `jenis_barang` VALUES (3, 'TINTA');
INSERT INTO `jenis_barang` VALUES (4, 'LAINNYA');
INSERT INTO `jenis_barang` VALUES (51, '');

-- ----------------------------
-- Table structure for pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_brg` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengeluaran
-- ----------------------------
INSERT INTO `pengeluaran` VALUES (28, 'Teknik dan Humas', 'JR001', 10, '2020-02-13');
INSERT INTO `pengeluaran` VALUES (29, 'Teknik dan Humas', 'JR001', 10, '2020-02-13');

-- ----------------------------
-- Table structure for permintaan
-- ----------------------------
DROP TABLE IF EXISTS `permintaan`;
CREATE TABLE `permintaan`  (
  `id_permintaan` int(100) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idjabatan` int(11) NULL DEFAULT NULL,
  `unit` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_brg` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_permintaan`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permintaan
-- ----------------------------
INSERT INTO `permintaan` VALUES (12, 'Budi Purwanto', 2, 'Teknik dan Humas', 'JR001', 1, 10, '2020-02-12', '', 4);
INSERT INTO `permintaan` VALUES (13, 'Budi Purwanto', 2, 'Teknik dan Humas', 'JR001', 1, 2, '2020-02-14', '', 4);

-- ----------------------------
-- Table structure for satuan_barang
-- ----------------------------
DROP TABLE IF EXISTS `satuan_barang`;
CREATE TABLE `satuan_barang`  (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of satuan_barang
-- ----------------------------
INSERT INTO `satuan_barang` VALUES (1, 'Pcs');
INSERT INTO `satuan_barang` VALUES (2, 'Lusin');
INSERT INTO `satuan_barang` VALUES (3, 'Rim');
INSERT INTO `satuan_barang` VALUES (4, 'Kodi');
INSERT INTO `satuan_barang` VALUES (5, 'Gross');
INSERT INTO `satuan_barang` VALUES (6, 'Pack');

-- ----------------------------
-- Table structure for sementara
-- ----------------------------
DROP TABLE IF EXISTS `sementara`;
CREATE TABLE `sementara`  (
  `id_sementara` int(100) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `idjabatan` int(11) NULL DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_brg` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_sementara`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for stokbarang
-- ----------------------------
DROP TABLE IF EXISTS `stokbarang`;
CREATE TABLE `stokbarang`  (
  `kode_brg` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` int(2) NOT NULL,
  `nama_brg` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `keluar` int(11) NULL DEFAULT 0,
  `sisa` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `suplier` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`kode_brg`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stokbarang
-- ----------------------------
INSERT INTO `stokbarang` VALUES ('JR001', 1, 'Bolpoin', 'Pcs', 10000, 290, 9710, '2020-02-04', '');
INSERT INTO `stokbarang` VALUES ('JR002', 1, 'Pensil', 'Pcs', 200, 0, 200, '2020-02-05', '');
INSERT INTO `stokbarang` VALUES ('JR003', 2, 'A4', 'Rim', 200, 0, 200, '2020-02-24', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cabang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kaunit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `idjabatan` int(11) NOT NULL,
  `level` enum('administrator','staff','supervisor') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `idjabatan`(`idjabatan`) USING BTREE,
  INDEX `user_ibfk_2`(`iddivisi`) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idjabatan`) REFERENCES `jabatan` (`idjabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`iddivisi`) REFERENCES `divisi` (`iddivisi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Syafaat Rahman', 'syafaat', '827ccb0eea8a706c4c34a16891f84e7b', 'Jambi', 'Syafaat Rahman', 1, 2, 'administrator', NULL);
INSERT INTO `user` VALUES (17, 'Ardian Haryo Prabowo', 'aryo', 'a49519b36eb08d076628b8c2bc5f6292', 'Jambi', '1', 5, 1, 'administrator', NULL);
INSERT INTO `user` VALUES (18, 'Budi Purwanto', 'budipurwanto', 'a49519b36eb08d076628b8c2bc5f6292', 'Jambi', 'Budi Purwanto', 2, 2, 'supervisor', NULL);
INSERT INTO `user` VALUES (19, 'Geger Anggon', 'geger', 'a49519b36eb08d076628b8c2bc5f6292', 'Jambi', 'Budi Purwanto', 2, 3, 'staff', NULL);

-- ----------------------------
-- Triggers structure for table pengeluaran
-- ----------------------------
DROP TRIGGER IF EXISTS `TG_STOK_UPDATE`;
delimiter ;;
CREATE TRIGGER `TG_STOK_UPDATE` AFTER INSERT ON `pengeluaran` FOR EACH ROW BEGIN
	update stokbarang SET keluar=keluar + NEW.jumlah, 
	sisa=stok-keluar WHERE 
	kode_brg = NEW.kode_brg;

	update permintaan SET status=1 WHERE kode_brg=NEW.kode_brg AND 
	unit=NEW.unit;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
