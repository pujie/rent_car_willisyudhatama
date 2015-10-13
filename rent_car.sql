-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2015 at 02:02 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rent_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `detil_kontrak`
--

CREATE TABLE IF NOT EXISTS `detil_kontrak` (
  `id_detil_kontrak` int(11) NOT NULL AUTO_INCREMENT,
  `id_kontrak` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  PRIMARY KEY (`id_detil_kontrak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `detil_kontrak`
--

INSERT INTO `detil_kontrak` (`id_detil_kontrak`, `id_kontrak`, `id_mobil`, `id_driver`) VALUES
(8, 1, 3, 1),
(9, 2, 6, 0),
(11, 3, 3, 3),
(12, 3, 5, 0),
(13, 4, 3, 0),
(14, 5, 4, 4),
(15, 6, 3, 8),
(16, 6, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(100) NOT NULL,
  `tgl_invoice` date NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `terbayar` double NOT NULL,
  `tgl_terbayar` date NOT NULL,
  PRIMARY KEY (`id_invoice`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `no_invoice`, `tgl_invoice`, `id_kontrak`, `tgl_jatuh_tempo`, `terbayar`, `tgl_terbayar`) VALUES
(3, '001/INV/09-215', '2015-10-11', 1, '2015-10-26', 0, '0000-00-00'),
(4, '002/INV/09-215', '2015-10-12', 6, '2015-10-27', 25000000, '2015-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE IF NOT EXISTS `kontrak` (
  `id_kontrak` int(11) NOT NULL,
  `no_kontrak` varchar(100) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `periode_sewa` int(11) NOT NULL,
  `total_harga_sewa` double NOT NULL,
  `cancel` tinyint(1) NOT NULL,
  `keterangan_cancel` text NOT NULL,
  PRIMARY KEY (`id_kontrak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id_kontrak`, `no_kontrak`, `id_pelanggan`, `tgl_mulai`, `tgl_berakhir`, `periode_sewa`, `total_harga_sewa`, `cancel`, `keterangan_cancel`) VALUES
(1, '001/RM/09-2015', 3, '2015-10-15', '2015-11-14', 1, 7000000, 0, ''),
(2, '002/RM/09-2015', 5, '2015-07-08', '2015-09-06', 2, 12000000, 0, ''),
(3, '003/RM/09-2015', 4, '2015-09-08', '2015-10-08', 1, 13000000, 0, ''),
(4, '004/RM/09-2015', 8, '2015-09-02', '2015-10-02', 1, 6000000, 0, ''),
(5, '005/RM/09-2015', 2, '2015-10-14', '2015-12-13', 2, 13000000, 0, ''),
(6, '007/RM/09-2015', 4, '2015-10-12', '2015-12-11', 2, 28000000, 1, 'uji coba cancel hari ini');

-- --------------------------------------------------------

--
-- Table structure for table `m_driver`
--

CREATE TABLE IF NOT EXISTS `m_driver` (
  `id_driver` int(11) NOT NULL AUTO_INCREMENT,
  `nama_driver` varchar(500) NOT NULL,
  `alamat` varchar(1000) NOT NULL,
  `no_telp_driver` varchar(50) NOT NULL,
  PRIMARY KEY (`id_driver`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `m_driver`
--

INSERT INTO `m_driver` (`id_driver`, `nama_driver`, `alamat`, `no_telp_driver`) VALUES
(1, 'Toni', 'Bagusan, Gedeg', '081'),
(2, 'Agus', 'Kemantren, Mojokerto', '081'),
(3, 'Roni', 'Krian', '081'),
(4, 'Panca', 'Mojokerto', '081'),
(7, 'Awim', 'Mojokerto', '085'),
(8, 'Rio', 'Gresik', '081');

-- --------------------------------------------------------

--
-- Table structure for table `m_mobil`
--

CREATE TABLE IF NOT EXISTS `m_mobil` (
  `id_mobil` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(500) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `no_pol` varchar(50) NOT NULL,
  `tahun_keluaran` int(11) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `sewa_bulanan` double NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `m_mobil`
--

INSERT INTO `m_mobil` (`id_mobil`, `merk`, `jenis`, `tipe`, `no_pol`, `tahun_keluaran`, `warna`, `sewa_bulanan`) VALUES
(2, 'Avanza', 'Toyota ', 'MT', 'L 8624 WR', 2010, 'Hitam', 5500000),
(3, 'Innova', 'Daihatsu', 'AT', 'L 8274 YK', 2011, 'Hijau', 6000000),
(4, 'Innova', 'Daihatsu', 'MT', 'L 5811 AJ', 2010, 'Hitam', 5500000),
(5, 'Avanza', 'Toyota ', 'MT', 'W 863 SS', 2013, 'Silver', 6000000),
(6, 'Avanza', 'Toyota ', 'MT', 'W 8964 PE', 2014, 'Hitam', 6000000),
(7, 'Avanza', 'Toyota', 'MT', 'S 1563 KL', 2013, 'Silver', 6500000),
(8, 'Avanza', 'Toyota', 'MT', 'L 5320 RT', 2014, 'Hitam', 7000000),
(9, 'Xenia', 'Daihatsu', 'MT', 'L 4591 TR', 2012, 'Hijau', 5000000),
(10, 'Xenia', 'Daihatsu', 'MT', 'L 6701 YL', 2012, 'Hijau', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `m_pelanggan`
--

CREATE TABLE IF NOT EXISTS `m_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `perusahaan` varchar(1000) NOT NULL,
  `penanggung_jwb` varchar(500) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `kota` varchar(500) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `m_pelanggan`
--

INSERT INTO `m_pelanggan` (`id_pelanggan`, `perusahaan`, `penanggung_jwb`, `no_telp`, `kota`) VALUES
(1, 'PT Kamoro', 'Sam', '081', 'Sidoarjo'),
(2, 'PT Belant Persada', 'Afif', '081', 'Sidoarjo'),
(3, 'PT Ignite', 'Roy', '081', 'Surabaya'),
(4, 'PT Ako Media', 'Deni', '081', 'Sidoarjo'),
(5, 'PT Mitra Integrasi', 'Eka', '081', 'Surabaya'),
(6, 'PT Bukalapak', 'Lina', '081', 'Sidoarjo'),
(7, 'PT Emerio', 'Yuli', '081', 'Surabaya'),
(8, 'PT Prima Integrasi', 'Nia', '081', 'Sidoarjo');

-- --------------------------------------------------------

--
-- Table structure for table `temp_det_kontrak`
--

CREATE TABLE IF NOT EXISTS `temp_det_kontrak` (
  `id_temp_det_kontrak` int(11) NOT NULL AUTO_INCREMENT,
  `id_kontrak` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  PRIMARY KEY (`id_temp_det_kontrak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `temp_det_kontrak`
--

