-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 04:39 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccr`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga_barang` int(100) NOT NULL,
  `stock_barang` int(100) NOT NULL,
  `stock_std` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `satuan`, `kategori`, `harga_barang`, `stock_barang`, `stock_std`) VALUES
(18, '5000024804', 'Trizact 1 1/4', 'ROL', 'DIRECT', 1821827, 0, 8),
(6, '5661482', 'tim tom', 'kilo', 'Indirect', 1000000, 180, 5),
(8, '5661482', 'ciken', 'ton', 'Indirect', 8500, 16, 5),
(16, '5000023265', 'Nylon Cloth 400cm x 400cm', 'PC', 'DIRECT', 258600, 40, 50),
(17, '5000023456', 'Shin Nhn Wex Glove @10pairs  XT002274550', 'BAG', 'Indirect', 878000, 20, 0),
(19, '5000012647', 'SBP XX  (WASH BENZINE)', 'L', 'Direct', 7000, 320, 0),
(20, '5000026331', 'Sankyo Wool Sponge Pad ( D75 x T5 )', 'PC', 'Indirect', 7400, 10, 20),
(22, '100', 'barang cadangan', 'pc', 'direct', 5000, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jalur`
--

CREATE TABLE `jalur` (
  `id_jalur` int(11) NOT NULL,
  `nama_jalur` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jalur`
--

INSERT INTO `jalur` (`id_jalur`, `nama_jalur`) VALUES
(1, 'Final'),
(2, 'Trimming0'),
(3, 'Trimming1-2'),
(4, 'Chassis1'),
(5, 'Chassis2'),
(6, 'Pretrimming'),
(7, 'Doorline'),
(8, 'SPS'),
(9, 'Jundate'),
(10, 'RM'),
(11, 'Project');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id_ket` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_ket`, `ket`) VALUES
(1, 'Produksi'),
(2, '2 S'),
(3, 'TPM'),
(4, 'Improvement');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id_order_history` int(11) NOT NULL,
  `nama_jalur` varchar(100) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_order` int(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `total_harga` int(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nama_pic` varchar(50) NOT NULL,
  `npk_pic` int(50) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `konfirmasi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_history_view`
-- (See below for the actual view)
--
CREATE TABLE `order_history_view` (
`id_order_history` int(11)
,`nama_jalur` varchar(100)
,`kode_barang` varchar(50)
,`nama_barang` varchar(100)
,`jumlah_order` int(50)
,`satuan` varchar(50)
,`kategori` varchar(50)
,`harga` int(100)
,`total_harga` int(100)
,`keterangan` varchar(100)
,`nama_pic` varchar(50)
,`npk_pic` int(50)
,`shift` varchar(50)
,`tanggal` date
,`barcode` varchar(100)
,`konfirmasi` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `npk` varchar(10) NOT NULL,
  `shift` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jalur` varchar(100) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `aktifasi` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `npk`, `shift`, `username`, `password`, `level`, `jalur`, `no_telepon`, `aktifasi`) VALUES
(18, 'farel', '61555', 'Non Shift', 'farel', '77e2edcc9b40441200e31dc57dbb8829', 'Admin', 'PROJECT', '089624035192', 'on');

-- --------------------------------------------------------

--
-- Structure for view `order_history_view`
--
DROP TABLE IF EXISTS `order_history_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_history_view`  AS  select `order_history`.`id_order_history` AS `id_order_history`,`order_history`.`nama_jalur` AS `nama_jalur`,`order_history`.`kode_barang` AS `kode_barang`,`order_history`.`nama_barang` AS `nama_barang`,`order_history`.`jumlah_order` AS `jumlah_order`,`order_history`.`satuan` AS `satuan`,`order_history`.`kategori` AS `kategori`,`order_history`.`harga` AS `harga`,`order_history`.`total_harga` AS `total_harga`,`order_history`.`keterangan` AS `keterangan`,`order_history`.`nama_pic` AS `nama_pic`,`order_history`.`npk_pic` AS `npk_pic`,`order_history`.`shift` AS `shift`,`order_history`.`tanggal` AS `tanggal`,`order_history`.`barcode` AS `barcode`,`order_history`.`konfirmasi` AS `konfirmasi` from `order_history` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jalur`
--
ALTER TABLE `jalur`
  ADD PRIMARY KEY (`id_jalur`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id_ket`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id_order_history`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jalur`
--
ALTER TABLE `jalur`
  MODIFY `id_jalur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id_ket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id_order_history` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
