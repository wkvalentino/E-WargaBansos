-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 02:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bansos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bansos`
--

CREATE TABLE `jenis_bansos` (
  `id_bansos` int(11) NOT NULL,
  `nama_bansos` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_bansos`
--

INSERT INTO `jenis_bansos` (`id_bansos`, `nama_bansos`) VALUES
(1, 'PKH (Program Keluarga Harapan)'),
(2, 'BPNT (Bantuan Pangan Non Tunai)'),
(3, 'KIS (Kartu Indonesia sehat)'),
(4, 'BPUM (Bantuan Produktif Usaha Mikro)'),
(5, 'BSU (Bantuan Subsidi Upah)');

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `desa_kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kabupaten_kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nik`, `nama`, `alamat`, `rt`, `rw`, `desa_kelurahan`, `kecamatan`, `kabupaten_kota`, `provinsi`) VALUES
(1, '3571021401000001', 'Budi Santoso', 'Jalan Setono, gang 5, no. 85', '2', '1', 'Ngadirejo', 'Ngasem', 'Kediri', 'Jawa Timur'),
(2, '3571021401000002', 'Siti Rohma', 'Jalan Ngadisimo, gang 2, no. 8', '1', '1', 'Ngadirejo', 'Kota', 'Kediri', 'Jawa Timur'),
(3, '3571021401000003', 'Rina Lestari', 'Jalan Banjaran, gang Carik, no.9', '2', '3', 'Dandangan', 'Kota', 'Kediri', 'Jawa Timur'),
(4, '3571021401000004', 'Dewi Anggraini ', 'Jalan Veteran, gang 3, no.2', '2', '1', 'Mojoroto', 'Mojoroto', 'Kediri', 'Jawa Timur'),
(5, '3571021401000005', 'Eko Wahyudi ', 'Jalan Burengan, Gang 6, no. 8', '2', '3', 'Burengan', 'Pesantren', 'Kediri', 'Jawa Timur'),
(6, '3571010402060004', 'Alex nugraha', 'jalan Kh. Ahmad Dahlan, gang 5, no. 15', '6', '2', 'Mojoroto', 'Mojoroto', 'Kediri', 'Jawa timur'),
(7, '3571010402060005', 'Adi Purnomo', 'jalan Kh. Ahmad Dahlan, gang 6, no. 4', '4', '1', 'Mojoroto', 'Mojoroto', 'Kediri', 'Jawa timur'),
(8, '3571021308010002', 'Adi ', 'Jalan Veteran no 2', '09', '02', 'Bandar Lor', 'Mojoroto', 'Kediri', 'Jawa Timur'),
(27, '5', 'test 1', 'Mojoroto Gg 5 Barat No 15', '09', '01', 'Bandar Lor', '5', 'KEDIRI Kota', 'JAWA TIMUR'),
(31, '3571021308010004', 'Hadi', 'Mojoroto Gg 5 Barat No 15', '09', '02', 'mojotoro', 'Mojoroto', 'KEDIRI Kota', 'JAWA TIMUR'),
(32, '3571021401000007', 'Ahmad Fauzi', 'Jalan Joyoboyo, gang 1, no. 4', '02', '01', 'Banjaran', 'Kota', 'Kediri', 'Jawa Timur'),
(33, '3571021401000008', 'Lina Marlina', 'Jalan Hasanudin, gang 4, no. 12', '03', '02', 'Setono Pande', 'Kota', 'Kediri', 'Jawa Timur'),
(45, '3571021401000011', 'Fitri', 'Jalan KH Wachid Hasyim, gang 3, no. 6', '02', '02', 'Pesantren', 'Pesantren', 'Kediri', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `penyaluran`
--

CREATE TABLE `penyaluran` (
  `id_penyaluran` int(11) NOT NULL,
  `id_penerima` int(10) NOT NULL,
  `id_bansos` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `tanggal_penyaluran` date NOT NULL,
  `status` enum('Tersalur','Belum Tersalur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyaluran`
--

INSERT INTO `penyaluran` (`id_penyaluran`, `id_penerima`, `id_bansos`, `periode`, `tanggal_penyaluran`, `status`) VALUES
(1, 5, 3, '2023', '2023-12-04', 'Tersalur'),
(2, 1, 2, '2024', '2024-01-05', 'Tersalur'),
(3, 2, 3, '2024', '2024-08-09', 'Tersalur'),
(4, 3, 1, '2025', '2025-11-11', 'Tersalur'),
(5, 4, 5, '2025', '2025-12-01', 'Belum Tersalur'),
(6, 6, 1, '2024', '2024-08-09', 'Tersalur'),
(7, 7, 4, '2025', '2025-12-19', 'Tersalur'),
(8, 8, 2, '2025', '2025-12-19', 'Tersalur'),
(14, 27, 1, '2025', '2025-12-22', 'Tersalur'),
(17, 31, 4, '2025', '2025-12-27', 'Tersalur'),
(18, 32, 3, '2025', '2025-12-09', 'Tersalur'),
(19, 33, 4, '2025', '2025-12-09', 'Tersalur'),
(20, 45, 5, '2025', '2025-12-16', 'Tersalur');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama`) VALUES
(1, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Petugas Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id_tracking` int(11) NOT NULL,
  `id_penyaluran` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `status_tracking` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id_tracking`, `id_penyaluran`, `waktu`, `lokasi`, `status_tracking`) VALUES
(1, 1, '0000-00-00 00:00:00', '', 'Belum diterima'),
(2, 2, '2025-12-24 09:06:00', 'Ngadirejo', 'Sudah diterima'),
(3, 3, '2025-12-22 17:45:00', 'Ngadirejo', 'Sudah diterima'),
(4, 7, '2025-12-19 14:37:52', 'Ngadirejo', 'Sudah diterima'),
(5, 5, '0000-00-00 00:00:00', '', 'Belum diterima'),
(6, 4, '2025-12-17 12:16:04', 'mojoroto', 'Sudah diterima'),
(7, 6, '0000-00-00 00:00:00', '', 'Sudah diterima'),
(8, 8, '2025-12-24 09:08:00', 'mojoroto', 'Sudah diterima'),
(14, 14, '2025-12-24 09:53:00', 'mojoroto', 'Sudah diterima'),
(17, 17, '2026-01-04 20:38:00', 'mojoroto', 'Sudah diterima'),
(18, 18, '2026-01-04 20:42:00', 'Banjaran', 'Sudah diterima'),
(19, 19, '2025-12-11 18:28:00', 'Kota', 'Sudah diterima'),
(20, 20, '0000-00-00 00:00:00', '', 'Belum Diterima');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_bansos`
--
ALTER TABLE `jenis_bansos`
  ADD PRIMARY KEY (`id_bansos`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `penyaluran`
--
ALTER TABLE `penyaluran`
  ADD PRIMARY KEY (`id_penyaluran`),
  ADD KEY `id_penerima` (`id_penerima`),
  ADD KEY `id_bansos` (`id_bansos`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id_tracking`),
  ADD KEY `id_penyaluran` (`id_penyaluran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `penyaluran`
--
ALTER TABLE `penyaluran`
  MODIFY `id_penyaluran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id_tracking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penyaluran`
--
ALTER TABLE `penyaluran`
  ADD CONSTRAINT `penyaluran_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`),
  ADD CONSTRAINT `penyaluran_ibfk_2` FOREIGN KEY (`id_bansos`) REFERENCES `jenis_bansos` (`id_bansos`);

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`id_penyaluran`) REFERENCES `penyaluran` (`id_penyaluran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
