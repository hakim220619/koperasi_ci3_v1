-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2022 at 08:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koprasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_angsuran` varchar(30) NOT NULL,
  `jumlah_angsuran` int(20) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_virtual` varchar(30) NOT NULL,
  `status` char(3) NOT NULL DEFAULT '',
  `order_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id`, `id_pinjaman`, `id_user`, `no_angsuran`, `jumlah_angsuran`, `nilai`, `tanggal`, `metode_pembayaran`, `no_virtual`, `status`, `order_id`) VALUES
(32453, 1600, 17, 'ANG438', 1, 180000, '2022-08-18 14:02:19', 'Online', '67517415822|bca', '100', '1608288879'),
(32454, 1600, 17, 'ANG438', 2, 180000, '2022-08-18 14:02:19', 'Online', '67517415822|bca', '100', '1608288879'),
(32455, 1600, 17, 'ANG438', 3, 180000, '2022-08-31 13:43:57', 'Manual', '', '200', ''),
(32456, 1600, 17, 'ANG438', 4, 180000, '2022-08-31 13:43:57', 'Manual', '', '200', ''),
(32457, 1600, 17, 'ANG438', 5, 180000, '2022-08-31 13:43:57', 'Manual', '', '200', ''),
(32459, 3009, 17, 'ANG276', 1, 400000, '2022-08-31 13:46:06', 'Manual', '', '200', ''),
(32460, 3009, 17, 'ANG276', 2, 400000, '2022-08-31 13:46:06', 'Manual', '', '200', ''),
(32461, 9769, 17, 'ANG428', 1, 120000, '2022-08-31 13:54:56', 'Manual', '', '200', ''),
(32462, 9769, 17, 'ANG428', 2, 120000, '2022-08-31 13:58:02', 'Manual', '', '200', ''),
(32463, 3332, 17, 'ANG139', 1, 240000, '2022-09-10 12:28:34', 'Manual', '', '200', ''),
(32464, 3332, 17, 'ANG139', 2, 240000, '2022-09-10 12:28:34', 'Manual', '', '200', ''),
(32465, 8050, 17, 'ANG550', 1, 108334, '2022-09-10 12:31:09', 'Online', '67517420743|bca', '100', '1630709385'),
(32466, 8050, 17, 'ANG550', 2, 108334, '2022-09-10 12:31:09', 'Online', '67517420743|bca', '100', '1630709385');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Komed', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', 'logo1.png', 'Copy Right ©', '1.0.0.0', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `lama`
--

CREATE TABLE `lama` (
  `id` int(11) NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lama`
--

INSERT INTO `lama` (`id`, `lama`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_pinjaman` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `lama` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_user`, `no_pinjaman`, `jumlah`, `tanggal`, `lama`, `bunga`, `status`) VALUES
(1600, 17, 'ANG438', '900000', '2022-08-18 11:35:36', 6, 20, 'Y'),
(3009, 17, 'ANG276', '2000000', '2022-08-18 11:56:11', 6, 20, 'Y'),
(3332, 17, 'ANG139', '2000000', '2022-09-10 12:27:43', 10, 20, 'Y'),
(8050, 17, 'ANG550', '1000000', '2022-09-10 12:30:31', 12, 30, 'Y'),
(9769, 17, 'ANG428', '1000000', '2022-08-17 19:58:17', 10, 20, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nik` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL,
  `no_virtual` varchar(30) NOT NULL,
  `status` char(4) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `tanggal_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id`, `id_user`, `nik`, `jumlah`, `metode_pembayaran`, `no_virtual`, `status`, `order_id`, `tanggal_bayar`) VALUES
(2988, 17, 2147483647, 800000, 'Online', '67517411495|bca', '200', '436274537', '2022-08-17 21:57:52'),
(7079, 17, 2147483647, 1000000, 'Online', '67517404653|bca', '100', '1908549903', '2022-08-17 20:57:01'),
(26053, 17, 2147483647, 300000, 'Manual', '', '200', '', '2022-08-18 11:16:04'),
(37292, 17, 2147483647, 9000000, 'Manual', '', '200', '', '2022-08-18 11:42:46'),
(38237, 17, 2147483647, 500000, 'Manual', '', '200', '', '2022-08-18 13:14:25'),
(58583, 17, 2147483647, 200000, 'Online', '67517110409|bca', '100', '345607383', '2022-08-17 20:57:55'),
(70279, 17, 2147483647, 900000, 'Online', '67517059569|bca', '100', '1119327640', '2022-09-10 12:32:22'),
(82619, 17, 2147483647, 0, 'Manual', '', '200', '', '2022-09-01 09:35:41'),
(83753, 17, 2147483647, 90000, 'Online', '67517553680|bca', '100', '1611308789', '2022-08-18 13:54:48'),
(83906, 17, 2147483647, 900000, 'Manual', '', '200', '', '2022-09-10 12:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_menu`
--

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_akses_menu`
--

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES
(1, 1, 1, 'Y'),
(2, 1, 2, 'Y'),
(43, 4, 1, 'Y'),
(44, 4, 2, 'N'),
(62, 5, 1, 'N'),
(63, 5, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_submenu`
--

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_akses_submenu`
--

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(7, 1, 8, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(13, 1, 14, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(26, 1, 15, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(30, 1, 17, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(32, 1, 18, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(34, 1, 19, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(36, 1, 20, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(59, 4, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(60, 4, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(61, 4, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(62, 4, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(63, 4, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(64, 4, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(65, 4, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(66, 4, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(67, 4, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(68, 4, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(72, 5, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(73, 5, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(74, 5, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(75, 5, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(76, 5, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(77, 5, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(78, 5, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(79, 5, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(80, 5, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(81, 5, 20, 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, 'Y', 'Y'),
(2, 'System', '#', 'fas fa-cogs', 2, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) UNSIGNED NOT NULL,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES
(1, 'Menu', 'menu', 'far fa-circle', 2, 'Y'),
(2, 'SubMenu', 'submenu', 'far fa-circle', 2, 'Y'),
(7, 'Aplikasi', 'aplikasi', 'far fa-circle', 2, 'Y'),
(8, 'User', 'user', 'far fa-circle', 2, 'Y'),
(10, 'User Level', 'userlevel', 'far fa-circle', 2, 'Y'),
(15, 'Barang', 'barang', 'far fa-circle', 32, 'Y'),
(17, 'Kategori', 'kategori', 'far fa-circle', 32, 'Y'),
(18, 'Satuan', 'satuan', 'far fa-circle', 32, 'Y'),
(19, 'Pembelian', 'pembelian', 'far fa-circle', 41, 'Y'),
(20, 'Penjualan', 'penjualan', 'far fa-circle', 41, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nik` int(40) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `tlp` varchar(20) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `username`, `full_name`, `tlp`, `alamat`, `jenis_kelamin`, `password`, `id_level`, `image`, `is_active`) VALUES
(10, 0, 'admin', 'dani', '085797887711', '', 'laki-laki', '$2y$05$oDJNmsPd0unSj1xbw2qP6.oeeuDhBhi.PBrwsCD1xkkMm/Iy2D.J6', 1, 'admin.jpg', 'Y'),
(17, 2147483647, 'lukman', 'lukman hakim', '089636337580', 'sirau', 'laki-laki', '$2y$05$G44YpBTsKHkoaZxHagHhBuGrqtVL/g1s3Ehdx2CqwrDF.y9NJ2E5O', 3, 'lukman.jpg', 'Y'),
(18, 2147483647, 'pegawai1', 'pegawai', '245245245', 'JL. Rawabaliiii', 'laki-laki', '$2y$05$q7qYoSlZdgZYQsD9/GXRDeQhPEKp4jtkXA4LNN2bdy3YmBF5M1nN6', 2, 'pegawai1.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'pegawai'),
(3, 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lama`
--
ALTER TABLE `lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32467;

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lama`
--
ALTER TABLE `lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9827;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95862;

--
-- AUTO_INCREMENT for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
