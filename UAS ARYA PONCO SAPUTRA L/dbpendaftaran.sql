-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 07:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpendaftaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_tiket`
--

CREATE TABLE `pembelian_tiket` (
  `id` int(11) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `jenis_tiket` varchar(50) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_pembayaran` int(11) DEFAULT NULL,
  `tanggal_pembelian` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_tiket`
--

INSERT INTO `pembelian_tiket` (`id`, `nama_pendaftar`, `jenis_tiket`, `jumlah_tiket`, `created_at`, `total_pembayaran`, `tanggal_pembelian`) VALUES
(1, 'Arya ponco gans', 'CAT 2', 10, '2024-12-17 04:05:31', NULL, '2024-12-17 11:37:43'),
(2, 'Arya ponco gans', 'VVIP', 2, '2024-12-17 04:08:37', NULL, '2024-12-17 11:37:43'),
(3, 'Arya ponco gans', 'CAT 3', 4, '2024-12-17 04:16:53', NULL, '2024-12-17 11:37:43'),
(4, 'nadin', 'VVIP', 4, '2024-12-17 04:26:56', NULL, '2024-12-17 11:37:43'),
(7, 'nadin', 'VVIP', 3, '2024-12-17 06:39:50', NULL, '2024-12-17 13:39:50'),
(8, 'nadin', 'VVIP', 3, '2024-12-17 06:39:50', 3000000, '2024-12-17 13:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id`, `username`, `password`, `nama_admin`, `nama_lengkap`, `telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `foto`) VALUES
(11, 'aryaadmin1', '$2y$10$vm7ehtiy.sPizkg6/c7NOOKGJsgIHUjVczl087JuXwo9o8BXXZ7pi', 'Arya ponco s', 'Arya ponco saputra', '085214264532', 'malaysia', '2024-12-12', 'L', 'profile.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbpendaftar`
--

CREATE TABLE `tbpendaftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbpendaftar`
--

INSERT INTO `tbpendaftar` (`id`, `nama`, `email`, `telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `foto`, `username`, `password`) VALUES
(13, 'Arya ponco gans', 'aryaponcssss@gmail.com', '098765432563532', 'Malaysia', '2024-12-07', '', 'Screenshot (42).png', 'aryasayangmama', '$2y$10$ge0k55OmjHpqZ7ljZTElyenqNO//sW/8jVO2vpIJn41nPRlUgeByu'),
(14, 'nadin', 'nadinkecut@gmail.com', '098735833', 'hatiku', '2024-12-06', '', 'Screenshot (44).png', 'kecutbanget', '$2y$10$TSEI6ACQpwRkAamvybGGt.bKMYymxIN8JN6L.4UI2Dyqh4TC3qX36');

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('User','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id`, `username`, `password`, `level`) VALUES
(1, 'user1', 'userpassword', 'User'),
(2, 'admin1', 'adminpassword', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pimpinan`
--

CREATE TABLE `tb_pimpinan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pimpinan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pimpinan`
--

INSERT INTO `tb_pimpinan` (`id`, `username`, `password`, `nama_pimpinan`) VALUES
(14, 'aryapemimpin', '$2y$10$y2jufkcGlFFkp5FgZVGlCeIaASyPTogqYyyqxvII3x9Xyl/I4Somm', 'Arya ponco saputra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembelian_tiket`
--
ALTER TABLE `pembelian_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpendaftar`
--
ALTER TABLE `tbpendaftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pimpinan`
--
ALTER TABLE `tb_pimpinan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembelian_tiket`
--
ALTER TABLE `pembelian_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbpendaftar`
--
ALTER TABLE `tbpendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pimpinan`
--
ALTER TABLE `tb_pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
