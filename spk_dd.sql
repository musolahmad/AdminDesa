-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 09:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_dd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `kd_admin` char(6) NOT NULL,
  `nm_pegawai` varchar(50) NOT NULL,
  `nm_jabatan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `lvl_admin` enum('1','2','3') NOT NULL,
  `foto_profil` varchar(20) NOT NULL,
  `status_admin` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`kd_admin`, `nm_pegawai`, `nm_jabatan`, `email`, `pass`, `lvl_admin`, `foto_profil`, `status_admin`) VALUES
('ADM001', 'Admin', 'Kaur Keuangan', 'admin@gmail.com', '$2y$10$hkdk3yI9WBu3XSNBNWEyLuBeNeUVbHL9wKhAPWoQgI0KPdqeGgGJ6', '2', '230517111655.jpeg', '1'),
('ADM002', 'Admin 2', 'Kaur', 'kaur@gmail.com', '$2y$10$Ayba.7KY93wRUrujUQ5TgehBhzqe5.7gKcGU93ZPBQbPJ9w8CHl.a', '1', '230517111814.PNG', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aduan`
--

CREATE TABLE `tb_aduan` (
  `kd_aduan` char(7) NOT NULL,
  `kd_user` char(10) NOT NULL,
  `kd_topik` char(4) NOT NULL,
  `kd_dusun` char(4) NOT NULL,
  `rt` char(2) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(20) NOT NULL,
  `tgl_aduan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_aduan` enum('Masuk','Diterima','Ditolak','Diajukan') NOT NULL,
  `dibaca` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `kd_bidang` varchar(11) NOT NULL,
  `nm_bidang` varchar(50) NOT NULL,
  `jns_akun` enum('1','2') NOT NULL,
  `kd_induk` varchar(11) NOT NULL,
  `tipe_akun` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bidang`
--

INSERT INTO `tb_bidang` (`kd_bidang`, `nm_bidang`, `jns_akun`, `kd_induk`, `tipe_akun`) VALUES
('1', 'Belanja', '1', '0', '1'),
('11', 'Paaa', '1', '1', '1'),
('111', 'sdsdasd', '1', '11', '2'),
('112', 'ssdasd', '1', '11', '1'),
('12', 'ssdasd', '1', '1', '1'),
('2', 'Belanja', '2', '0', '1'),
('21', 'ssdasd', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bobotkriteria`
--

CREATE TABLE `tb_bobotkriteria` (
  `kd_bobot` char(6) NOT NULL,
  `kd_bidang` char(4) NOT NULL,
  `kd_kriteria` char(4) NOT NULL,
  `tahun` year(4) NOT NULL,
  `bobot` int(11) NOT NULL,
  `parameter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bobotkriteria`
--

INSERT INTO `tb_bobotkriteria` (`kd_bobot`, `kd_bidang`, `kd_kriteria`, `tahun`, `bobot`, `parameter`) VALUES
('242101', '21', 'KR01', 2024, 20, 70),
('242102', '21', 'KR02', 2024, 30, 80);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailkriteria`
--

CREATE TABLE `tb_detailkriteria` (
  `kd_dtl_kriteria` char(4) NOT NULL,
  `kd_kriteria` char(4) NOT NULL,
  `nm_dtl_kriteria` varchar(50) NOT NULL,
  `nilai_dtl_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_detailkriteria`
--

INSERT INTO `tb_detailkriteria` (`kd_dtl_kriteria`, `kd_kriteria`, `nm_dtl_kriteria`, `nilai_dtl_kriteria`) VALUES
('0101', 'KR01', 'Yayay', 40),
('0102', 'KR01', 'WAW', 90),
('0201', 'KR02', 'gdfgdfgfd', 40),
('0202', 'KR02', 'trtrt', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_dusun`
--

CREATE TABLE `tb_dusun` (
  `kd_dusun` char(4) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `jml_rt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dusun`
--

INSERT INTO `tb_dusun` (`kd_dusun`, `rw`, `jml_rt`) VALUES
('DS01', '1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `kd_kegiatan` char(4) NOT NULL,
  `nm_kegiatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`kd_kegiatan`, `nm_kegiatan`) VALUES
('KP01', 'Pelaksanaan Pembangunan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `kd_komentar` char(10) NOT NULL,
  `kd_aduan` char(7) NOT NULL,
  `kd_admin` char(6) NOT NULL,
  `isi_komentar` varchar(100) NOT NULL,
  `tgl_komentar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dibaca` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kd_kriteria` char(4) NOT NULL,
  `nm_kriteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kd_kriteria`, `nm_kriteria`) VALUES
('KR01', 'Aku'),
('KR02', 'yaya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_kriteria_kegiatan`
--

CREATE TABLE `tb_nilai_kriteria_kegiatan` (
  `kd_nilai_kriteria` char(7) NOT NULL,
  `kd_rencana` char(7) NOT NULL,
  `kd_bobot` char(6) NOT NULL,
  `kd_dtl_kriteria` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paguanggaran`
--

CREATE TABLE `tb_paguanggaran` (
  `kd_pagu` char(8) NOT NULL,
  `kd_bidang` char(6) NOT NULL,
  `tahun` year(4) NOT NULL,
  `pagu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_paguanggaran`
--

INSERT INTO `tb_paguanggaran` (`kd_pagu`, `kd_bidang`, `tahun`, `pagu`) VALUES
('241', '1', 2024, 2000000),
('2411', '11', 2024, 2000000),
('24111', '111', 2024, 2000000),
('242', '2', 2024, 20044444),
('2421', '21', 2024, 20044444);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelaksanaan_pembangunan`
--

CREATE TABLE `tb_pelaksanaan_pembangunan` (
  `kd_rencana` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `status_pengajuan` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `status_pelaksanaan` int(11) NOT NULL,
  `foto_lokasi_terbaru` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyusun`
--

CREATE TABLE `tb_penyusun` (
  `th_penyusun` year(4) NOT NULL,
  `kd_ketua` char(6) NOT NULL,
  `kd_penanggungjawab` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_promethee`
--

CREATE TABLE `tb_promethee` (
  `kd_rencana` char(7) NOT NULL,
  `nilai_leaving_flow` double NOT NULL,
  `nilai_entering_flow` double NOT NULL,
  `nilai_net_flow` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_referensi_aduan`
--

CREATE TABLE `tb_referensi_aduan` (
  `kd_aduan` char(7) NOT NULL,
  `kd_rencana` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rencana_pembangunan`
--

CREATE TABLE `tb_rencana_pembangunan` (
  `kd_rencana` char(7) NOT NULL,
  `kd_bidang` char(4) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kd_kegiatan` char(4) NOT NULL,
  `kd_dusun` char(4) NOT NULL,
  `rt` varchar(2) NOT NULL,
  `biaya` int(11) NOT NULL,
  `status_pengajuan` enum('1','2','3') NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `foto_lokasi` varchar(20) NOT NULL,
  `file_rab` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_selisihnilaikegiatan`
--

CREATE TABLE `tb_selisihnilaikegiatan` (
  `kd_dtl_kriteria_1` char(9) NOT NULL,
  `kd_dtl_kriteria_2` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_topik_aduan`
--

CREATE TABLE `tb_topik_aduan` (
  `kd_topik` char(4) NOT NULL,
  `nm_topik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_topik_aduan`
--

INSERT INTO `tb_topik_aduan` (`kd_topik`, `nm_topik`) VALUES
('TP01', 'Yayay');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` char(10) NOT NULL,
  `nm_user` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` enum('L','P') NOT NULL,
  `foto_profil` varchar(20) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `status_user` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_website`
--

CREATE TABLE `tb_website` (
  `kd_website` int(11) NOT NULL,
  `web_admin` varchar(50) NOT NULL,
  `web_masyarakat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indexes for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`kd_aduan`),
  ADD KEY `fk_user_aduan` (`kd_user`),
  ADD KEY `fk_topik_aduan` (`kd_topik`),
  ADD KEY `fk_dusun_aduan` (`kd_dusun`);

--
-- Indexes for table `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`kd_bidang`);

--
-- Indexes for table `tb_bobotkriteria`
--
ALTER TABLE `tb_bobotkriteria`
  ADD PRIMARY KEY (`kd_bobot`),
  ADD KEY `fk_bobot_bidang` (`kd_bidang`),
  ADD KEY `fk_kriteria_bobot` (`kd_kriteria`);

--
-- Indexes for table `tb_detailkriteria`
--
ALTER TABLE `tb_detailkriteria`
  ADD PRIMARY KEY (`kd_dtl_kriteria`),
  ADD KEY `fk_kriteria_detail` (`kd_kriteria`);

--
-- Indexes for table `tb_dusun`
--
ALTER TABLE `tb_dusun`
  ADD PRIMARY KEY (`kd_dusun`);

--
-- Indexes for table `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`kd_kegiatan`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`kd_komentar`),
  ADD KEY `fk_aduan_komentar` (`kd_aduan`),
  ADD KEY `fk_admin_komentar` (`kd_admin`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kd_kriteria`);

--
-- Indexes for table `tb_nilai_kriteria_kegiatan`
--
ALTER TABLE `tb_nilai_kriteria_kegiatan`
  ADD PRIMARY KEY (`kd_nilai_kriteria`),
  ADD KEY `fk_rencana_nilai` (`kd_rencana`),
  ADD KEY `fk_bobot_nilai` (`kd_bobot`),
  ADD KEY `fk_dtl_nilai_kirteria` (`kd_dtl_kriteria`);

--
-- Indexes for table `tb_paguanggaran`
--
ALTER TABLE `tb_paguanggaran`
  ADD PRIMARY KEY (`kd_pagu`),
  ADD KEY `fk_bidang_pagu` (`kd_bidang`);

--
-- Indexes for table `tb_pelaksanaan_pembangunan`
--
ALTER TABLE `tb_pelaksanaan_pembangunan`
  ADD PRIMARY KEY (`kd_rencana`);

--
-- Indexes for table `tb_penyusun`
--
ALTER TABLE `tb_penyusun`
  ADD PRIMARY KEY (`th_penyusun`),
  ADD KEY `fk_ketua` (`kd_ketua`),
  ADD KEY `fk_penanggungjawab` (`kd_penanggungjawab`);

--
-- Indexes for table `tb_promethee`
--
ALTER TABLE `tb_promethee`
  ADD PRIMARY KEY (`kd_rencana`);

--
-- Indexes for table `tb_referensi_aduan`
--
ALTER TABLE `tb_referensi_aduan`
  ADD PRIMARY KEY (`kd_aduan`),
  ADD KEY `fk_rencana_referensi` (`kd_rencana`);

--
-- Indexes for table `tb_rencana_pembangunan`
--
ALTER TABLE `tb_rencana_pembangunan`
  ADD PRIMARY KEY (`kd_rencana`),
  ADD KEY `fk_rencana_bidang` (`kd_bidang`),
  ADD KEY `fk_kegiatan_rencana` (`kd_kegiatan`),
  ADD KEY `fk_dusun_rencana` (`kd_dusun`);

--
-- Indexes for table `tb_selisihnilaikegiatan`
--
ALTER TABLE `tb_selisihnilaikegiatan`
  ADD PRIMARY KEY (`kd_dtl_kriteria_1`),
  ADD KEY `fk_detail2` (`kd_dtl_kriteria_2`);

--
-- Indexes for table `tb_topik_aduan`
--
ALTER TABLE `tb_topik_aduan`
  ADD PRIMARY KEY (`kd_topik`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`);

--
-- Indexes for table `tb_website`
--
ALTER TABLE `tb_website`
  ADD PRIMARY KEY (`kd_website`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD CONSTRAINT `fk_dusun_aduan` FOREIGN KEY (`kd_dusun`) REFERENCES `tb_dusun` (`kd_dusun`),
  ADD CONSTRAINT `fk_topik_aduan` FOREIGN KEY (`kd_topik`) REFERENCES `tb_topik_aduan` (`kd_topik`),
  ADD CONSTRAINT `fk_user_aduan` FOREIGN KEY (`kd_user`) REFERENCES `tb_user` (`kd_user`);

--
-- Constraints for table `tb_bobotkriteria`
--
ALTER TABLE `tb_bobotkriteria`
  ADD CONSTRAINT `fk_bobot_bidang` FOREIGN KEY (`kd_bidang`) REFERENCES `tb_bidang` (`kd_bidang`),
  ADD CONSTRAINT `fk_kriteria_bobot` FOREIGN KEY (`kd_kriteria`) REFERENCES `tb_kriteria` (`kd_kriteria`);

--
-- Constraints for table `tb_detailkriteria`
--
ALTER TABLE `tb_detailkriteria`
  ADD CONSTRAINT `fk_kriteria_detail` FOREIGN KEY (`kd_kriteria`) REFERENCES `tb_kriteria` (`kd_kriteria`);

--
-- Constraints for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `fk_admin_komentar` FOREIGN KEY (`kd_admin`) REFERENCES `tb_admin` (`kd_admin`),
  ADD CONSTRAINT `fk_aduan_komentar` FOREIGN KEY (`kd_aduan`) REFERENCES `tb_aduan` (`kd_aduan`);

--
-- Constraints for table `tb_nilai_kriteria_kegiatan`
--
ALTER TABLE `tb_nilai_kriteria_kegiatan`
  ADD CONSTRAINT `fk_bobot_nilai` FOREIGN KEY (`kd_bobot`) REFERENCES `tb_bobotkriteria` (`kd_bobot`),
  ADD CONSTRAINT `fk_dtl_nilai_kirteria` FOREIGN KEY (`kd_dtl_kriteria`) REFERENCES `tb_detailkriteria` (`kd_dtl_kriteria`),
  ADD CONSTRAINT `fk_rencana_nilai` FOREIGN KEY (`kd_rencana`) REFERENCES `tb_rencana_pembangunan` (`kd_rencana`);

--
-- Constraints for table `tb_paguanggaran`
--
ALTER TABLE `tb_paguanggaran`
  ADD CONSTRAINT `fk_bidang_pagu` FOREIGN KEY (`kd_bidang`) REFERENCES `tb_bidang` (`kd_bidang`);

--
-- Constraints for table `tb_penyusun`
--
ALTER TABLE `tb_penyusun`
  ADD CONSTRAINT `fk_ketua` FOREIGN KEY (`kd_ketua`) REFERENCES `tb_admin` (`kd_admin`),
  ADD CONSTRAINT `fk_penanggungjawab` FOREIGN KEY (`kd_penanggungjawab`) REFERENCES `tb_admin` (`kd_admin`);

--
-- Constraints for table `tb_promethee`
--
ALTER TABLE `tb_promethee`
  ADD CONSTRAINT `fk_rencana_` FOREIGN KEY (`kd_rencana`) REFERENCES `tb_rencana_pembangunan` (`kd_rencana`);

--
-- Constraints for table `tb_referensi_aduan`
--
ALTER TABLE `tb_referensi_aduan`
  ADD CONSTRAINT `fk_aduan_referensi` FOREIGN KEY (`kd_aduan`) REFERENCES `tb_aduan` (`kd_aduan`),
  ADD CONSTRAINT `fk_rencana_referensi` FOREIGN KEY (`kd_rencana`) REFERENCES `tb_rencana_pembangunan` (`kd_rencana`);

--
-- Constraints for table `tb_rencana_pembangunan`
--
ALTER TABLE `tb_rencana_pembangunan`
  ADD CONSTRAINT `fk_dusun_rencana` FOREIGN KEY (`kd_dusun`) REFERENCES `tb_dusun` (`kd_dusun`),
  ADD CONSTRAINT `fk_kegiatan_rencana` FOREIGN KEY (`kd_kegiatan`) REFERENCES `tb_kegiatan` (`kd_kegiatan`),
  ADD CONSTRAINT `fk_rencana_bidang` FOREIGN KEY (`kd_bidang`) REFERENCES `tb_bidang` (`kd_bidang`);

--
-- Constraints for table `tb_selisihnilaikegiatan`
--
ALTER TABLE `tb_selisihnilaikegiatan`
  ADD CONSTRAINT `fk_detail1` FOREIGN KEY (`kd_dtl_kriteria_1`) REFERENCES `tb_detailkriteria` (`kd_dtl_kriteria`),
  ADD CONSTRAINT `fk_detail2` FOREIGN KEY (`kd_dtl_kriteria_2`) REFERENCES `tb_detailkriteria` (`kd_dtl_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
