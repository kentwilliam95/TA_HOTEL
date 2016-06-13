-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2016 at 06:46 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

DROP TABLE IF EXISTS `bed`;
CREATE TABLE IF NOT EXISTS `bed` (
  `id_bed` varchar(10) NOT NULL,
  `nama_bed` varchar(20) NOT NULL,
  PRIMARY KEY (`id_bed`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id_bed`, `nama_bed`) VALUES
('BD003', 'Double Bed'),
('BD001', 'Single Bed'),
('BD002', 'Twin Bed');

-- --------------------------------------------------------

--
-- Table structure for table `booked_room`
--

DROP TABLE IF EXISTS `booked_room`;
CREATE TABLE IF NOT EXISTS `booked_room` (
  `id_bookedRoom` int(11) NOT NULL AUTO_INCREMENT,
  `id_reservasi` varchar(20) NOT NULL,
  `id_useroom` int(4) NOT NULL,
  `id_checkin` varchar(20) NOT NULL,
  `tgl_checkin` varchar(20) NOT NULL,
  `tgl_reservasi` date NOT NULL,
  `id_tipekamar` varchar(20) NOT NULL,
  `id_bed` varchar(20) NOT NULL,
  `passengers` varchar(20) NOT NULL,
  `nama_reservasi` varchar(50) NOT NULL,
  `id_kamar` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_checkout` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  PRIMARY KEY (`id_bookedRoom`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `booked_room`
--

INSERT INTO `booked_room` (`id_bookedRoom`, `id_reservasi`, `id_useroom`, `id_checkin`, `tgl_checkin`, `tgl_reservasi`, `id_tipekamar`, `id_bed`, `passengers`, `nama_reservasi`, `id_kamar`, `status`, `tgl_checkout`, `tgl_masuk`) VALUES
(18, '20160607001', 11, '20160607001', '2016-06-07', '2016-06-07', 'Anggrek', 'Double Bed', '10', 'anabel', '868', 'Blocked', '2016-06-08', '0000-00-00'),
(17, '20160526001', 10, '20160526001', '2016-05-27', '2016-05-26', 'Anggrek', 'Double Bed', '2', 'abc', '323', 'Blocked', '2016-05-28', '0000-00-00'),
(16, '20160525001', 9, '20160525001', '2016-05-25', '2016-05-25', 'Anggrek', 'Double Bed', '10', 'cobra', '323', 'Blocked', '2016-05-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

DROP TABLE IF EXISTS `checkin`;
CREATE TABLE IF NOT EXISTS `checkin` (
  `id_reservasi` varchar(12) NOT NULL,
  `id_checkin` varchar(20) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  PRIMARY KEY (`id_checkin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id_reservasi`, `id_checkin`, `tgl_checkin`, `tgl_checkout`) VALUES
('20160607001', '20160607001', '2016-06-07', '2016-06-08'),
('20160526001', '20160526001', '2016-05-27', '2016-05-28'),
('20160525001', '20160525001', '2016-05-25', '2016-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

DROP TABLE IF EXISTS `chef`;
CREATE TABLE IF NOT EXISTS `chef` (
  `id_chef` varchar(20) NOT NULL,
  `nama_chef` varchar(50) NOT NULL,
  `alamat_chef` varchar(50) NOT NULL,
  `telepon_chef` int(20) NOT NULL,
  `jk_chef` varchar(10) NOT NULL,
  `ttl_chef` date NOT NULL,
  `skill_chef` varchar(50) NOT NULL,
  PRIMARY KEY (`id_chef`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`id_chef`, `nama_chef`, `alamat_chef`, `telepon_chef`, `jk_chef`, `ttl_chef`, `skill_chef`) VALUES
('CH002', 'Dedoty', 'Lampung', 888888, 'L', '2015-12-17', '<p>mmmmm</p>'),
('CH001', 'Juna', 'Lampung', 888888, 'L', '1901-01-02', '<p>mmmmm</p>');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(10) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(50) NOT NULL,
  `alamat_customer` varchar(50) NOT NULL,
  `ttl_customer` date NOT NULL,
  `jk_customer` varchar(10) NOT NULL,
  `telepon_customer` int(10) NOT NULL,
  `status_member` varchar(10) NOT NULL,
  `nomor_ktp` varchar(10) NOT NULL,
  `pekerjaan` varchar(10) NOT NULL,
  `status_nikah` varchar(5) NOT NULL,
  `company_customer` varchar(20) NOT NULL,
  `id_checkin` varchar(20) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat_customer`, `ttl_customer`, `jk_customer`, `telepon_customer`, `status_member`, `nomor_ktp`, `pekerjaan`, `status_nikah`, `company_customer`, `id_checkin`) VALUES
(1, 'Paul', 'Jakarta', '1974-03-01', 'L', 2147483647, 'Ya', '282828282', 'Vocalist', 'Belum', '-', ''),
(2, 'Geraldo Chang', 'Sutorejo Indah 44', '1990-03-01', 'L', 6464646, 'Ya', '333333333', 'CEO', 'Belum', 'PT Kencana Indah', ''),
(3, 'Pokemon', 'a', '2016-03-05', 'L', 22222222, 'Ya', '2222222222', 'wiraswasta', 'Menik', 'bbb', '');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--


-- --------------------------------------------------------

--
-- Table structure for table `depositoawal`
--

DROP TABLE IF EXISTS `depositoawal`;
CREATE TABLE IF NOT EXISTS `depositoawal` (
  `id_checkin` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `terbayar` varchar(20) NOT NULL,
  `sisa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

DROP TABLE IF EXISTS `inventaris`;
CREATE TABLE IF NOT EXISTS `inventaris` (
  `id_kategoriinventaris` varchar(20) NOT NULL,
  `id_item` varchar(20) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `start_guarantee` date NOT NULL,
  `end_guarantee` date NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_kategoriinventaris`, `id_item`, `nama_item`, `start_guarantee`, `end_guarantee`) VALUES
('Elektronik', 'IN001', 'TV Plasma', '2016-01-07', '2016-01-30'),
('Peralatan Mandi 2', 'IN002', 'Sabun', '2016-02-06', '2016-02-29'),
('Elektronik', 'IN003', 'Radio', '2016-02-24', '2016-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_pegawai`
--

DROP TABLE IF EXISTS `jabatan_pegawai`;
CREATE TABLE IF NOT EXISTS `jabatan_pegawai` (
  `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `gaji_pokok` int(20) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

DROP TABLE IF EXISTS `kamar`;
CREATE TABLE IF NOT EXISTS `kamar` (
  `id_tipekamar` varchar(50) NOT NULL,
  `id_bed` varchar(10) NOT NULL,
  `id_kamar` varchar(10) NOT NULL,
  `gambar_kamar` varchar(50) NOT NULL,
  `view_kamar` varchar(20) NOT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `pegawai2` varchar(100) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Times` int(11) NOT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_tipekamar`, `id_bed`, `id_kamar`, `gambar_kamar`, `view_kamar`, `id_pegawai`, `pegawai2`, `Status`, `Times`) VALUES
('Anggrek', 'Double Bed', '323', 'download_(3)1.jpg', 'Beach', 'Donald', '', 'OCCUPIED', 0),
('Anggrek', 'Double Bed', '868', 'Crown-Plaza-Hotel-Superior-Room.jpg', 'Pantai', 'Bro', '', 'OCCUPIED', 1),
('Antorium', 'Double Bed', '790', 'download_(3).jpg', 'Lobby', 'Bro', '', 'VACANT READY', 0),
('Antorium', 'Double Bed', '754', 'Web-Hotel-Ork-Standard-room-221.jpg', 'Kolam Renang Atas', 'Bro', '', 'VACANT READY', 0),
('Flamboyan', 'Single Bed', '909', 'Web-Hotel-Ork-Standard-room-22.jpg', 'Mall', 'Bro', '', 'VACANT READY', 0),
('Flamboyan', 'Double Bed', '532', 'Crown-Plaza-Hotel-Superior-Room2.jpg', 'Jembatan Suramadu', 'Lauwinna Vincensya', '', 'VACANT READY', 0),
('Anggrek', 'Single Bed', '606', 'Crown-Plaza-Hotel-Superior-Room3.jpg', 'Garden', 'Lauwinna Vincensya', '', 'VACANT READY', 0),
('Lily', 'Double Bed', '222', 'ta.jpg', 's', 'Lauwinna Vincensya', 'Donald', 'VACANT READY', 0),
('Lily', 'Single Bed', '001', '', 'beach', '0', '0', 'VACANT READY', 0),
('Reflesia 1', 'Twin Bed', '015', '', 'beach', '0', '0', 'VACANT READY', 0),
('Reflesia 1', 'Single Bed', '029', '', 'bar', '0', '0', 'VACANT READY', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategoriinventaris`
--

DROP TABLE IF EXISTS `kategoriinventaris`;
CREATE TABLE IF NOT EXISTS `kategoriinventaris` (
  `id_kategoriinventaris` varchar(20) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategoriinventaris`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoriinventaris`
--

INSERT INTO `kategoriinventaris` (`id_kategoriinventaris`, `nama_kategori`) VALUES
('KI001', 'Elektronik'),
('KI002', 'Peralatan Mandi 2');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_fasilitas`
--

DROP TABLE IF EXISTS `kategori_fasilitas`;
CREATE TABLE IF NOT EXISTS `kategori_fasilitas` (
  `id_kategorifas` bigint(10) NOT NULL AUTO_INCREMENT,
  `nama_kategorifas` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategorifas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_fb`
--

DROP TABLE IF EXISTS `kategori_fb`;
CREATE TABLE IF NOT EXISTS `kategori_fb` (
  `id_kategorifb` varchar(10) NOT NULL,
  `nama_kategorifb` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategorifb`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_fb`
--

INSERT INTO `kategori_fb` (`id_kategorifb`, `nama_kategorifb`) VALUES
('KFB001', 'Main Course'),
('KFB002', 'Appetizer'),
('KFB003', 'Beverages'),
('KFB004', 'Dessert'),
('KFB005', 'Asian Cuisine'),
('KFB006', 'Western Cuisine'),
('KFB007', 'Indonesian Cuisine');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pengeluaran`
--

DROP TABLE IF EXISTS `kategori_pengeluaran`;
CREATE TABLE IF NOT EXISTS `kategori_pengeluaran` (
  `id_kategoripengeluaran` varchar(20) NOT NULL,
  `nama_kategoripengeluaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_pengeluaran`
--

INSERT INTO `kategori_pengeluaran` (`id_kategoripengeluaran`, `nama_kategoripengeluaran`) VALUES
('1', 'asd'),
('2', 'asd'),
('KP001', 'kakaka');

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

DROP TABLE IF EXISTS `laundry`;
CREATE TABLE IF NOT EXISTS `laundry` (
  `id_laundry` varchar(10) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `harga_laundry` int(20) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `nama_satuan` varchar(5) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_laundry`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laundry`
--

INSERT INTO `laundry` (`id_laundry`, `nama_item`, `harga_laundry`, `satuan`, `nama_satuan`, `keterangan`) VALUES
('LA001', 'Jas', 15000, '20', 'Kg', 'Dry Cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

DROP TABLE IF EXISTS `lembur`;
CREATE TABLE IF NOT EXISTS `lembur` (
  `id_pegawai` varchar(20) NOT NULL,
  `start_lembur` int(20) NOT NULL,
  `end_lembur` int(20) NOT NULL,
  `totaljam_lembur` int(20) NOT NULL,
  `tanggal_lembur` date NOT NULL,
  `gaji_lembur` int(20) NOT NULL,
  `totalgaji_lembur` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_restaurant`
--

DROP TABLE IF EXISTS `menu_restaurant`;
CREATE TABLE IF NOT EXISTS `menu_restaurant` (
  `id_penyajian` varchar(20) NOT NULL,
  `tgl_sajian` date NOT NULL,
  `id_menu` varchar(20) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `id_chef` varchar(20) NOT NULL,
  `id_kategorifb` varchar(20) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_restaurant`
--

INSERT INTO `menu_restaurant` (`id_penyajian`, `tgl_sajian`, `id_menu`, `nama_menu`, `id_chef`, `id_kategorifb`, `status`) VALUES
('', '2016-02-19', 'RES010', 'Bibimbap', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES004', 'Espresso Coffee', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES003', 'Tteokbokki', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES005', 'Kwetiauw Goreng', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES005', 'Kwetiauw Goreng', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES002', 'Jjampong', 'CH002', 'Main Course', 'Qualified'),
('R2', '2016-02-19', 'RES006', 'Almond Pudding', 'CH002', 'Main Course', 'Qualified');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `id_penggajian` varchar(20) NOT NULL,
  `tgl_penggajian` date NOT NULL,
  `id_pegawai` varchar(20) NOT NULL,
  `gajipokok` int(10) NOT NULL,
  `bonus` int(10) NOT NULL,
  `substraction` int(10) NOT NULL,
  `description` varchar(20) NOT NULL,
  `overtime` int(10) NOT NULL,
  `total_gaji` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `ttl_pegawai` varchar(20) NOT NULL,
  `telepon_pegawai` int(10) NOT NULL,
  `jabatan_pegawai` varchar(30) NOT NULL,
  `jk_pegawai` varchar(10) NOT NULL,
  `password_pegawai` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tipe_pegawai` int(11) NOT NULL COMMENT '1=admin 2=manager 3=housekeeper 4=frontdesk',
  PRIMARY KEY (`id_pegawai`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `ttl_pegawai`, `telepon_pegawai`, `jabatan_pegawai`, `jk_pegawai`, `password_pegawai`, `username`, `tipe_pegawai`) VALUES
('PG001', 'Arabella Buckley', 'Lebak Indah 33', '2011-05-01', 5944991, 'Admin', 'L', 'arabella', 'arabella', 1),
('PG002', 'Veronica Liem', 'Undaan Kulon 123', '1987-12-01', 76464646, 'Admin', 'P', 'veronica', 'veronica', 2),
('PG003', 'Donald', 'Jl Pengampon 11', '1980-01-11', 6258990, 'Housekeeping', 'L', 'donald', 'donald', 3),
('PG004', 'Lauwinna Vincensya', 'Jl Embong Ploso 23', '1994-03-24', 3244421, 'Housekeeping', 'P', 'lauwina', 'lauwina', 4),
('PG005', 'x', 'klampis indah ', '2016-02-04', 2147483647, 'Food&Beverage', 'L', 'william', 'william', 5),
('PG006', 'susihana', 'darmo baru barat', '2016-05-03', 0, 'Admin', 'L', 'hana', 'susi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_checkin` varchar(15) NOT NULL,
  `no_debit` varchar(10) NOT NULL,
  `akun_bayar` varchar(10) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `terbayar` varchar(10) NOT NULL,
  `sisa` varchar(10) NOT NULL,
  `id_promo` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_checkin`, `no_debit`, `akun_bayar`, `jumlah`, `terbayar`, `sisa`, `id_promo`, `status_pembayaran`, `jenis_pembayaran`) VALUES
('2016040600', '1234444444', 'Private', '1595000', '500000', '935500', 'PR0001', 'WAITING', 'Cash'),
('20160406001', '1234555555', 'Private', '675000', '500000', '0', 'PR0001', 'PAID', 'Cash'),
('20160406001', '1111111111', 'Private', '675000', '500000', '0', 'PR0001', 'PAID', 'Cash'),
('20160503001', '12345', 'Private', '185000', '150000', '0', 'PR0001', 'PAID', 'Cash'),
('20160525001', 'o198398127', 'Private', '450000', '100000', '0', 'PR0001', 'PAID', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_kategoripengeluaran` varchar(10) NOT NULL,
  `id_pengeluaran` bigint(10) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `nominal` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_kategoripengeluaran`, `id_pengeluaran`, `tanggal`, `nominal`, `keterangan`) VALUES
('asd', 1, '2016-05-26', 100000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `user`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'fbeverage', 'fbeverage');

-- --------------------------------------------------------

--
-- Table structure for table `potongan`
--

DROP TABLE IF EXISTS `potongan`;
CREATE TABLE IF NOT EXISTS `potongan` (
  `id_pegawai` int(20) NOT NULL,
  `tanggal_potongan` date NOT NULL,
  `kategori_potongan` varchar(50) NOT NULL,
  `total_potongan` int(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` varchar(20) NOT NULL,
  `nama_promo` varchar(50) NOT NULL,
  `tglawal_promo` date NOT NULL,
  `tglakhir_promo` date NOT NULL,
  `gambar_promo` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status_promo` varchar(50) NOT NULL,
  `disc_value` int(10) NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `nama_promo`, `tglawal_promo`, `tglakhir_promo`, `gambar_promo`, `keterangan`, `status_promo`, `disc_value`) VALUES
('PR0001', 'a', '2016-04-20', '2016-04-23', '', '<p>f</p>', 'Berlaku', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE IF NOT EXISTS `reservasi` (
  `id_reservasi` varchar(20) NOT NULL,
  `tgl_reservasi` date NOT NULL,
  `passengers` int(10) NOT NULL,
  `nama_reservasi` varchar(20) NOT NULL,
  `status_reservasi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_reservasi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `tgl_reservasi`, `passengers`, `nama_reservasi`, `status_reservasi`) VALUES
('20160607001', '2016-06-07', 10, 'anabel', 'Fixed'),
('20160526001', '2016-05-26', 2, 'abc', 'Fixed'),
('20160525001', '2016-05-25', 10, 'cobra', 'Fixed');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE IF NOT EXISTS `restaurant` (
  `id_menu` varchar(20) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `gambar_menu` varchar(50) NOT NULL,
  `harga_menu` int(20) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id_menu`, `nama_menu`, `gambar_menu`, `harga_menu`) VALUES
('RES001', 'Sushi', 'feng-sushi-kensington3.jpg', 30000),
('RES002', 'Jjampong', 'download3.jpg', 20000),
('RES003', 'Tteokbokki', 'ddeokbboki_01-.jpg', 40000),
('RES004', 'Espresso Coffee', 'download_(1).jpg', 35000),
('RES005', 'Kwetiauw Goreng', 'Kwetiau-Goreng-Spesial.jpg', 25000),
('RES006', 'Almond Pudding', 'Cara-Membuat-Cemilan-Puding-Almond-Lezat.jpg', 20000),
('RES007', 'Fruit Pie', 'Hummus-Cups-1.jpg', 15000),
('RES008', 'Strawberry Cupcake', 'download_(2).jpg', 12000),
('RES011', 'v', 'download1.jpg', 4),
('RES010', 'Bibimbap', 'cin_bibimbap.jpg', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `room_price`
--

DROP TABLE IF EXISTS `room_price`;
CREATE TABLE IF NOT EXISTS `room_price` (
  `id_price` varchar(10) NOT NULL,
  `id_tipekamar` varchar(20) NOT NULL,
  `jenis_harga` varchar(50) NOT NULL,
  `tgl_awalharga` date NOT NULL,
  `tgl_akhirharga` date NOT NULL,
  `transit` int(10) NOT NULL,
  `weekday` int(10) NOT NULL,
  `weekend` int(10) NOT NULL,
  PRIMARY KEY (`id_price`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_price`
--

INSERT INTO `room_price` (`id_price`, `id_tipekamar`, `jenis_harga`, `tgl_awalharga`, `tgl_akhirharga`, `transit`, `weekday`, `weekend`) VALUES
('HR001', 'Anggrek', 'elle', '2016-01-01', '2016-01-09', 180000, 225000, 235000),
('HR002', 'Antorium', 'elle', '2016-03-21', '2016-03-23', 145000, 185000, 195000),
('HR003', 'Flamboyan', 'elle', '2016-03-21', '2016-03-22', 100000, 135000, 150000),
('HR004', 'Lily', 'elle', '2016-03-21', '2016-03-22', 100000, 135000, 150000),
('HR005', 'Reflesia 1', 'elle', '2016-03-21', '2016-03-22', 100000, 140000, 150000),
('HR006', 'Reflesia 2', 'elle', '2016-03-21', '2016-03-22', 100000, 130000, 140000),
('HR007', 'Villa 1', 'elle', '2016-03-21', '2016-03-22', 0, 600000, 600000),
('HR008', 'Villa 2', 'elle', '2016-03-21', '2016-03-22', 0, 450000, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

DROP TABLE IF EXISTS `tipe_kamar`;
CREATE TABLE IF NOT EXISTS `tipe_kamar` (
  `id_tipekamar` varchar(10) NOT NULL,
  `nama_tipe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipekamar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipekamar`, `nama_tipe`) VALUES
('TP001', 'Anggrek'),
('TP002', 'Antorium'),
('TP003', 'Flamboyan'),
('TP004', 'Lily'),
('TP005', 'Raflesia 1'),
('TP006', 'Raflesia 2'),
('TP007', 'Villa 1'),
('TP008', 'Villa 2');

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

DROP TABLE IF EXISTS `tmp`;
CREATE TABLE IF NOT EXISTS `tmp` (
  `id_menu` varchar(20) NOT NULL,
  `id_chef` varchar(20) NOT NULL,
  `id_kategorifb` varchar(20) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_penyajian` varchar(20) NOT NULL,
  `tgl_sajian` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp`
--

INSERT INTO `tmp` (`id_menu`, `id_chef`, `id_kategorifb`, `nama_menu`, `status`, `id_penyajian`, `tgl_sajian`) VALUES
('RES001', 'undefined', 'undefined', 'Sushi', 'undefined', 'R20160328001', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `useinventaris`
--

DROP TABLE IF EXISTS `useinventaris`;
CREATE TABLE IF NOT EXISTS `useinventaris` (
  `id_kamar` varchar(20) NOT NULL,
  `id_item` varchar(20) NOT NULL,
  `nama_item` varchar(20) NOT NULL,
  `jumlah_item` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useinventaris`
--

INSERT INTO `useinventaris` (`id_kamar`, `id_item`, `nama_item`, `jumlah_item`) VALUES
('', 'IN001', 'TV Plasma', '2'),
('', 'IN002', 'Sabun', '2'),
('222', 'IN003', 'Radio', '1'),
('606', 'IN003', 'Radio', '2'),
('606', 'IN001', 'TV Plasma', '1'),
('868', 'IN001', 'TV Plasma', '2'),
('222', 'IN002', 'Sabun', '7'),
('222', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `uselaundy`
--

DROP TABLE IF EXISTS `uselaundy`;
CREATE TABLE IF NOT EXISTS `uselaundy` (
  `id_uselaundry` int(10) NOT NULL AUTO_INCREMENT,
  `id_item` varchar(10) NOT NULL,
  `id_checkin` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_uselaundry`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `uselaundy`
--

INSERT INTO `uselaundy` (`id_uselaundry`, `id_item`, `id_checkin`, `jumlah`, `subtotal`, `total`) VALUES
(3, 'LA001', '20160406001', 10, 150000, 0),
(4, 'LA001', '20160503001', 5, 75000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userestaurant`
--

DROP TABLE IF EXISTS `userestaurant`;
CREATE TABLE IF NOT EXISTS `userestaurant` (
  `id_menu` varchar(10) NOT NULL,
  `id_checkin` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_userestaurant` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_userestaurant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userestaurant`
--

INSERT INTO `userestaurant` (`id_menu`, `id_checkin`, `jumlah`, `subtotal`, `total`, `id_userestaurant`) VALUES
('RES001', '20160328001', 1, 30000, 0, 2),
('RES001', '20160503001', 1, 30000, 0, 3),
('RES008', '20160525001', 2, 24000, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `useroom`
--

DROP TABLE IF EXISTS `useroom`;
CREATE TABLE IF NOT EXISTS `useroom` (
  `id_useroom` int(11) NOT NULL AUTO_INCREMENT,
  `id_reservasi` varchar(15) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `id_tipekamar` varchar(20) NOT NULL,
  `id_bed` varchar(20) NOT NULL,
  PRIMARY KEY (`id_useroom`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `useroom`
--

INSERT INTO `useroom` (`id_useroom`, `id_reservasi`, `tgl_checkin`, `tgl_checkout`, `id_tipekamar`, `id_bed`) VALUES
(9, '20160525001', '2016-05-25', '2016-05-27', 'Anggrek', 'Double Bed'),
(10, '20160526001', '2016-05-27', '2016-05-28', 'Anggrek', 'Double Bed'),
(11, '20160607001', '2016-06-07', '2016-06-08', 'Anggrek', 'Double Bed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
