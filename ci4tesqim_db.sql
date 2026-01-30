-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 06:21 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4tesqim_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(255) NOT NULL,
  `nidn` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `nidn`, `prodi`) VALUES
(1, 'Lia Fathina', '111119', 'Teknik Informatika'),
(2, 'Muammar Ma\'ruf', '123456', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int(11) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `nama_mk`, `kode_mk`, `sks`) VALUES
(1, 'Keamanan Sistem', 'P001', 2),
(3, 'Pemrograman Berbasis Web', 'P002', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `id_dosen_mk` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_mk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id_dosen_mk`, `id_dosen`, `id_mk`) VALUES
(1, 1, 1),
(3, 2, 1),
(4, 2, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `nidn` (`nidn`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD UNIQUE KEY `kode unik mata kuliah` (`kode_mk`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id_dosen_mk`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_mk` (`id_mk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id_dosen_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `fk_mengajar_dosen`
    FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mengajar_mk`
    FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  ADD UNIQUE KEY `unique_dosen_mk` (`id_dosen`, `id_mk`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
