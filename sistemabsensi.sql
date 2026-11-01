-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 04:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemabsensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `ID` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `keluar` varchar(50) DEFAULT NULL,
  `tanggal` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`ID`, `nama`, `masuk`, `keluar`, `tanggal`, `keterangan`, `bukti`) VALUES
(1, 'Ahmad Azka Al Husaini', '21:44:33', '22:06:31', '14-09-2024', 'Hadir', NULL),
(1, 'Ahmad Azka Al Husaini', '06:18:10', '06:18:16', '15-09-2024', 'Hadir', NULL),
(3, 'Muhammad Mumtaz sajjad', 'IZIN', 'IZIN', '15-09-2024', 'Ada Acara keluarga', 'Arisan-Prodi-21-Mei-2023-1.jpeg'),
(4, 'Pakcik Love Crypto', 'SAKIT', 'SAKIT', '15-09-2024', 'Cacar Monyet', '6-gejala-cacar-air-yang-perlu-diketahui.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(20) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `username`, `password`, `nama`, `level`, `jabatan`, `email`, `phone`, `gambar`) VALUES
(1, 'azka', '123', 'Ahmad Azka Al Husaini', 'user', 'Staff of NOC', 'ahmadazkaalhusaini@gmail.com', '089620266145', 'profileUser.png'),
(2, 'syarif', '456', 'Syarif Haidar Haka', 'admin', 'Admin', 'syarif@gmail.com', '089628289181', 'Crash Bandicoot.jpeg'),
(3, 'mumtaz', '777', 'Muhammad Mumtaz sajjad', 'user', 'Staff of Asset', 'mumtazlucu@gmail.com', '089628289181', 'King Piggies.png'),
(4, 'pakcik', '1234', 'Pakcik Love Crypto', 'user', 'Staff of Retail', 'pakcik@gmail.com', '08237272819', 'menbois.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD KEY `fk_absen_id` (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `fk_absen_id` FOREIGN KEY (`ID`) REFERENCES `login` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
