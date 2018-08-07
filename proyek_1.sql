-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2018 at 02:48 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kebutuhan_obat`
--

CREATE TABLE `daftar_kebutuhan_obat` (
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_kebutuhan` int(11) NOT NULL DEFAULT '20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_kebutuhan_obat`
--

INSERT INTO `daftar_kebutuhan_obat` (`kode_obat`, `jumlah_kebutuhan`) VALUES
('KO111', 20),
('KO112', 20);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_obat_kadaluarsa`
--

CREATE TABLE `daftar_obat_kadaluarsa` (
  `no_masuk` int(11) NOT NULL,
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_obat_kadaluarsa` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daftar_obat_kadaluarsa`
--

INSERT INTO `daftar_obat_kadaluarsa` (`no_masuk`, `kode_obat`, `jumlah_obat_kadaluarsa`) VALUES
(1, 'KO111', 20);

-- --------------------------------------------------------

--
-- Table structure for table `detail_obat_masuk`
--

CREATE TABLE `detail_obat_masuk` (
  `no_masuk` int(11) NOT NULL,
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_obat_masuk`
--

INSERT INTO `detail_obat_masuk` (`no_masuk`, `kode_obat`, `jumlah_masuk`, `tanggal_kadaluarsa`) VALUES
(1, 'KO111', 20, '2018-08-31'),
(2, 'KO111', 30, '2018-08-08'),
(1, 'KO112', 40, '2018-08-05'),
(1, 'KO113', 30, '2018-08-05'),
(1, 'KO114', 50, '2018-08-08'),
(1, 'KO115', 20, '2018-08-08'),
(2, 'KO115', 30, '2018-08-08');

--
-- Triggers `detail_obat_masuk`
--
DELIMITER $$
CREATE TRIGGER `tambah_data_obat_masuk` AFTER INSERT ON `detail_obat_masuk` FOR EACH ROW UPDATE obat
SET jumlah_obat = jumlah_obat+new.jumlah_masuk
WHERE kode_obat = new.kode_obat
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemusnahan_obat`
--

CREATE TABLE `detail_pemusnahan_obat` (
  `no_pemusnahan` int(11) NOT NULL,
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_obat_kadaluarsa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemusnahan_obat`
--

INSERT INTO `detail_pemusnahan_obat` (`no_pemusnahan`, `kode_obat`, `jumlah_obat_kadaluarsa`) VALUES
(1, 'KO111', 20);

--
-- Triggers `detail_pemusnahan_obat`
--
DELIMITER $$
CREATE TRIGGER `kurang_data_obat_kadaluarsa` AFTER INSERT ON `detail_pemusnahan_obat` FOR EACH ROW UPDATE obat
SET jumlah_obat = jumlah_obat-new.jumlah_obat_kadaluarsa
WHERE kode_obat = new.kode_obat
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan_obat`
--

CREATE TABLE `detail_pengadaan_obat` (
  `no_pengadaan` int(11) NOT NULL,
  `kode_obat` varchar(7) NOT NULL,
  `jumlah_kebutuhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pengadaan_obat`
--

INSERT INTO `detail_pengadaan_obat` (`no_pengadaan`, `kode_obat`, `jumlah_kebutuhan`) VALUES
(1, 'KO111', 20);

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kode_obat` varchar(7) NOT NULL,
  `nama_obat` varchar(35) NOT NULL,
  `harga_jual` varchar(20) NOT NULL,
  `jumlah_obat` int(11) NOT NULL DEFAULT '0',
  `stok_minimal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kode_obat`, `nama_obat`, `harga_jual`, `jumlah_obat`, `stok_minimal`) VALUES
('KO111', 'Paracetamol', '20000', 85, 5),
('KO112', 'Amoxilin', '10000', 90, 5),
('KO113', 'Panadol', '8000', 65, 5),
('KO114', 'Promag', '5000', 95, 5),
('KO115', 'Ibuprofen', '15000', 50, 5);

-- --------------------------------------------------------

--
-- Table structure for table `obat_masuk`
--

CREATE TABLE `obat_masuk` (
  `no_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat_masuk`
--

INSERT INTO `obat_masuk` (`no_masuk`, `tanggal_masuk`) VALUES
(1, '2018-08-05'),
(2, '2018-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan_obat`
--

CREATE TABLE `pemusnahan_obat` (
  `no_pemusnahan` int(11) NOT NULL,
  `username` varchar(7) NOT NULL,
  `tanggal_pengajuan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemusnahan_obat`
--

INSERT INTO `pemusnahan_obat` (`no_pemusnahan`, `username`, `tanggal_pengajuan`) VALUES
(1, 'kepala', '2018-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_obat`
--

CREATE TABLE `pengadaan_obat` (
  `no_pengadaan` int(11) NOT NULL,
  `kode_supplier` varchar(7) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tanggal_pesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan_obat`
--

INSERT INTO `pengadaan_obat` (`no_pengadaan`, `kode_supplier`, `username`, `tanggal_pesan`) VALUES
(1, 'KS211', 'kepala', '2018-08-05');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(35) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `akses_level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`username`, `password`, `nama_lengkap`, `tanggal_lahir`, `alamat`, `no_telepon`, `akses_level`) VALUES
('kepala', 'kepala', 'Diva Krishna', '1999-05-06', 'Jl. Sarijadi No. 6 Bandung, Jawa Barat', '089677709045', 'kepala'),
('staf', 'staf', 'Dwi Yulianingsih', '1999-07-09', 'Jl. Sarijadi No. 9 Bandung, Jawa Barat', '089332878502', 'staf');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(7) NOT NULL,
  `nama_supplier` varchar(35) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telepon`) VALUES
('KS211', 'Sumber Jaya', 'Jl. Setia Budi No. 6 Bandung, Jawa Barat', '03610821444'),
('KS212', 'Aneka Makmur', 'Jl. Setia Budi No. 9 Bandung, Jawa Barat', '03617443890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indexes for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD PRIMARY KEY (`no_masuk`);

--
-- Indexes for table `pemusnahan_obat`
--
ALTER TABLE `pemusnahan_obat`
  ADD PRIMARY KEY (`no_pemusnahan`);

--
-- Indexes for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  ADD PRIMARY KEY (`no_pengadaan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  MODIFY `no_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemusnahan_obat`
--
ALTER TABLE `pemusnahan_obat`
  MODIFY `no_pemusnahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengadaan_obat`
--
ALTER TABLE `pengadaan_obat`
  MODIFY `no_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
