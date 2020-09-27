-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2020 at 04:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atom-pocket`
--

-- --------------------------------------------------------

--
-- Table structure for table `dompet`
--

CREATE TABLE `dompet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `referensi` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `nilai` decimal(10,0) NOT NULL,
  `dompet_id` int(10) NOT NULL,
  `kategori_id` int(10) DEFAULT NULL,
  `istransaksimasuk` tinyint(1) NOT NULL,
  `transaksi_type_id` int(10) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_type`
--

CREATE TABLE `transaksi_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prefix` varchar(20) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `current_no` int(10) NOT NULL DEFAULT 100000,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_type`
--

INSERT INTO `transaksi_type` (`id`, `prefix`, `deskripsi`, `current_no`, `updated_at`, `created_at`, `nama`) VALUES
(1, 'WIN', NULL, 100000, NULL, NULL, 'dompet_masuk'),
(2, 'WOUT', NULL, 100000, NULL, NULL, 'dompet_keluar');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `v_transaksi` (
`id` bigint(20) unsigned
,`kode` varchar(20)
,`deskripsi` varchar(100)
,`tanggal` date
,`nilai` decimal(10,0)
,`dompet_id` int(10)
,`kategori_id` int(10)
,`istransaksimasuk` tinyint(1)
,`transaksi_type_id` int(10)
,`updated_at` timestamp
,`created_at` timestamp
,`kategori_nama` varchar(50)
,`dompet_nama` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `v_transaksi`
--
DROP TABLE IF EXISTS `v_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_transaksi`  AS  select `transaksi`.`id` AS `id`,`transaksi`.`kode` AS `kode`,`transaksi`.`deskripsi` AS `deskripsi`,`transaksi`.`tanggal` AS `tanggal`,`transaksi`.`nilai` AS `nilai`,`transaksi`.`dompet_id` AS `dompet_id`,`transaksi`.`kategori_id` AS `kategori_id`,`transaksi`.`istransaksimasuk` AS `istransaksimasuk`,`transaksi`.`transaksi_type_id` AS `transaksi_type_id`,`transaksi`.`updated_at` AS `updated_at`,`transaksi`.`created_at` AS `created_at`,`kategori`.`nama` AS `kategori_nama`,`dompet`.`nama` AS `dompet_nama` from ((`transaksi` join `dompet` on(`dompet`.`id` = `transaksi`.`dompet_id`)) left join `kategori` on(`kategori`.`id` = `transaksi`.`kategori_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dompet`
--
ALTER TABLE `dompet`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `transaksi_type`
--
ALTER TABLE `transaksi_type`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `transaksi_type_nama_unique_index` (`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dompet`
--
ALTER TABLE `dompet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `transaksi_type`
--
ALTER TABLE `transaksi_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
