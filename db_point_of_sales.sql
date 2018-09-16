-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2018 at 09:28 AM
-- Server version: 10.1.29-MariaDB-6
-- PHP Version: 7.2.9-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_point_of_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentikasi`
--

CREATE TABLE `authentikasi` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authentikasi`
--

INSERT INTO `authentikasi` (`id`, `email`, `password`, `nama`) VALUES
(1, 'admin@pos.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `stock` int(11) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kd_barang`, `deskripsi`, `stock`, `harga_beli`, `harga_jual`) VALUES
(2, '002', 'mobile', 10, 2000, 2000),
(10, '001', 'Ciki', -10, 200000, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_detail` varchar(10) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_transaksi` int(11) NOT NULL,
  `konsumen` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_detail`, `tgl_transaksi`, `total_transaksi`, `konsumen`) VALUES
('180925', '2018-09-16 08:48:58', 4000, 'Warung');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_detail` varchar(10) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_detail`, `kd_barang`, `harga`, `qty`, `total`) VALUES
('180918', '002', 200, 2, 400),
('180919', '002', 2000, 3, 6000),
('180922', '001', 300000, 1, 300000),
('180923', '001', 300000, 2, 600000),
('180924', '001', 300000, 10, 3000000),
('180925', '002', 2000, 2, 4000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentikasi`
--
ALTER TABLE `authentikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_barang` (`kd_barang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD KEY `id_detail` (`id_detail`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authentikasi`
--
ALTER TABLE `authentikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
