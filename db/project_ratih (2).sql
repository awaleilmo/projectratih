-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 12:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ratih`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_acara` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `nomor_invoice`, `id_produk`, `tgl_acara`) VALUES
(1, 'INV20230526134645', 1, '2023-05-27'),
(2, 'INV20230526134645', 2, '2023-05-28'),
(3, 'INV20230526161134', 1, '0000-00-00'),
(4, 'INV20230527133518', 1, '2023-06-11'),
(5, 'INV20230527133518', 2, '2023-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(100) NOT NULL,
  `kode_diskon` varchar(255) NOT NULL,
  `diskon_persen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id`, `id_user`, `id_produk`) VALUES
(23, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis_produk` int(11) NOT NULL,
  `jenis_media` varchar(255) NOT NULL,
  `media` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`id`, `nama`, `deskripsi`, `jenis_produk`, `jenis_media`, `media`) VALUES
(1, 'Prewed 1', 'Hasil photo prewed 1', 1, 'photo', '1.jpg'),
(2, 'Prewed 1', 'Hasil Prewed 2', 2, 'photo', '2.jpg'),
(3, 'Prewed 3', 'Hasil Prewed 3', 3, 'photo', '3.jpg'),
(4, 'Prewed 4', 'Hasil Prewed 4', 4, 'photo', '4.jpg'),
(5, 'Prewed 5', 'Hasil Prewed 5', 5, 'photo', '5.jpg'),
(6, 'Dummy1', 'DDDD', 2, 'photo', '6.jpg'),
(10, 'Tting', '12312', 2, 'photo', '10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id` int(100) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id`, `jenis_produk`) VALUES
(1, 'Weeding Special Package'),
(2, 'Prewedding Package'),
(3, 'Prewedding Indoor Package'),
(4, 'Engagement Package'),
(5, 'Maternity Indoor');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_produk` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `id_produk`) VALUES
(18, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `media` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`id`, `id_user`, `nomor_invoice`, `status`, `media`, `keterangan`, `created_at`, `updated_at`) VALUES
(10, 2, 'INV20230526134645', 'ditolak', '230708113324.jpg', '123123', '2023-07-08 23:33:24', '2023-07-09 00:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `payment_penjualan`
--

CREATE TABLE `payment_penjualan` (
  `id` int(11) NOT NULL,
  `nomor_invoice` varchar(100) NOT NULL,
  `pembayaran` int(100) NOT NULL,
  `jenis_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `nama_pembayar` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_penjualan`
--

INSERT INTO `payment_penjualan` (`id`, `nomor_invoice`, `pembayaran`, `jenis_pembayaran`, `bukti_pembayaran`, `nama_pembayar`, `status`, `created_at`) VALUES
(1, 'INV20230526134645', 8500000, 'BCA', 'INV20230526134645.jpg', 'Dimas', 'approved', '2023-05-26 13:46:45'),
(2, 'INV20230526161134', 3000000, 'BCA', 'INV20230526161134.jpg', 'DImas', 'ditolak', '2023-05-26 16:11:34'),
(4, 'INV20230526161134', 500000, 'BCA', 'INV20230526161134_2.jpg', 'DImas', 'ditolak', '2023-05-26 17:10:15'),
(5, 'INV20230527133518', 8500000, 'BCA', 'INV20230527133518.jpg', 'Samid Mada Artupas', 'pending', '2023-05-27 13:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `nomor_invoice` varchar(255) NOT NULL,
  `id_user` int(100) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kode_diskon` varchar(255) NOT NULL,
  `potongan` int(100) NOT NULL,
  `sisa` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nomor_invoice`, `id_user`, `tgl_transaksi`, `kode_diskon`, `potongan`, `sisa`, `total`) VALUES
('INV20230526134645', 2, '2023-05-26 13:46:45', 'null', 0, 0, 8500000),
('INV20230526161134', 2, '2023-05-26 16:11:34', 'null', 0, 500000, 3500000),
('INV20230527133518', 2, '2023-05-27 13:35:18', 'null', 0, 8500000, 8500000);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(100) NOT NULL,
  `id_user_1` int(100) NOT NULL,
  `id_user_2` int(100) NOT NULL,
  `isi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `id_user_1`, `id_user_2`, `isi`, `created_at`, `read`) VALUES
(7, 2, 1, 'Test', '2023-05-25 13:32:27', 1),
(8, 1, 2, 'Halo, selamat datang. ada yang bisa kami bantu ?', '2023-05-25 13:32:46', 1),
(9, 2, 1, 'Saya ingin tanya sesuatu', '2023-05-25 13:33:34', 1),
(10, 1, 2, 'apa tuh ?', '2023-05-25 13:33:45', 1),
(11, 2, 1, 'ta', '2023-05-25 13:36:11', 1),
(12, 1, 2, 'asda', '2023-05-25 13:36:35', 1),
(13, 1, 2, 'Halo', '2023-05-25 13:47:57', 1),
(14, 2, 1, 'Yah', '2023-05-25 13:48:00', 1),
(16, 2, 1, 'Test', '2023-05-25 16:41:15', 1),
(17, 2, 1, 'asdasd', '2023-06-16 15:59:14', 1),
(18, 2, 1, 'test', '2023-06-16 15:59:18', 1),
(19, 1, 2, 're', '2023-06-16 16:02:58', 1),
(20, 1, 2, 'yeeee', '2023-06-16 16:12:31', 1),
(21, 1, 2, 'asdasdas', '2023-06-16 16:12:42', 1),
(22, 1, 2, 'asdasd', '2023-06-16 16:12:49', 1),
(23, 2, 1, 'rteteter', '2023-06-16 16:19:04', 1),
(24, 1, 2, 'asdasd', '2023-06-16 16:23:40', 1),
(25, 2, 1, 'asdasdasdas', '2023-06-16 16:40:49', 1),
(26, 1, 2, 'test', '2023-06-17 22:33:52', 1),
(27, 2, 1, '1', '2023-06-17 22:35:11', 1),
(28, 2, 1, '2', '2023-06-17 22:35:14', 1),
(29, 2, 1, '3', '2023-06-17 22:35:16', 1),
(30, 1, 2, '4', '2023-06-17 22:35:32', 1),
(31, 1, 2, '5', '2023-06-17 22:35:34', 1),
(32, 1, 2, '6', '2023-06-17 22:35:37', 1),
(33, 1, 2, '2', '2023-06-17 22:35:42', 1),
(34, 1, 2, '1', '2023-06-17 22:35:44', 1),
(35, 1, 2, '5', '2023-06-17 22:35:47', 1),
(36, 2, 1, '2', '2023-06-17 22:41:12', 1),
(37, 1, 2, 'test', '2023-06-17 22:43:39', 1),
(38, 1, 2, 'teeee1', '2023-06-17 22:43:49', 1),
(39, 1, 2, 's', '2023-06-17 23:13:11', 1),
(40, 1, 2, '23123123', '2023-06-17 23:13:27', 1),
(41, 1, 2, 'sss', '2023-06-17 23:14:40', 1),
(42, 1, 2, 'sssss', '2023-06-17 23:19:38', 1),
(43, 1, 2, '2', '2023-06-17 23:19:41', 1),
(44, 1, 2, '3', '2023-06-17 23:19:45', 1),
(45, 1, 2, '2', '2023-06-17 23:27:17', 1),
(46, 1, 2, '22', '2023-06-17 23:31:00', 1),
(47, 1, 2, '3', '2023-06-17 23:31:04', 1),
(48, 1, 2, '2', '2023-06-17 23:37:11', 1),
(49, 1, 2, '2', '2023-06-17 23:37:19', 1),
(50, 2, 1, 'ssss', '2023-06-17 23:42:42', 1),
(51, 2, 1, '1', '2023-06-17 23:43:02', 1),
(52, 2, 1, '222', '2023-06-17 23:44:30', 1),
(53, 2, 1, '1', '2023-06-17 23:45:15', 1),
(54, 2, 1, '2', '2023-06-17 23:45:21', 1),
(55, 2, 1, '2', '2023-06-18 00:40:47', 1),
(56, 2, 1, '2', '2023-06-18 00:40:49', 1),
(57, 1, 2, '222', '2023-06-18 00:41:18', 1),
(58, 1, 2, '111', '2023-06-18 00:41:26', 1),
(59, 1, 2, '2', '2023-06-18 00:42:39', 1),
(60, 1, 2, '22', '2023-06-18 00:42:46', 1),
(61, 1, 2, '1', '2023-06-18 00:42:48', 1),
(62, 1, 2, '', '2023-06-18 00:42:49', 1),
(63, 1, 2, '333', '2023-06-18 00:42:51', 1),
(64, 1, 2, '', '2023-06-18 00:43:03', 1),
(65, 9, 1, 'Test', '2023-06-24 13:55:22', 1),
(66, 1, 9, 'teet', '2023-07-08 15:08:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(100) NOT NULL,
  `jenis_produk` int(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `jenis_produk`, `photo`, `video`) VALUES
(1, 'Standart Wedding Package', 'Lorem Ipsum', 3500000, 1, '230708065538.jpg', '230708065538.mp4'),
(2, 'Medium Wedding Packagess', 'Lorem Ipsumssss', 5000000, 1, '230710094334.png', '230710101309.mp4'),
(3, 'Premium Wedding Package', 'Lorem Ipsum\r\n', 8000000, 1, '', ''),
(4, 'Silver Package', 'Lorem Ipsum', 1800000, 2, '', ''),
(5, 'Gold Package', 'Lorem Ipsum', 3000000, 2, '', ''),
(6, 'Luxury Package', 'Lorem Ipsum', 5000000, 2, '', ''),
(7, 'Silver Package', 'Lorem Ipsum', 500000, 3, '', ''),
(8, 'Gold Package', 'Lorem Ipsum', 900000, 3, '', ''),
(9, 'Diamond Package', 'Lorem Ipsum', 1200000, 3, '', ''),
(10, 'Silver Package', 'Lorem Ipsum', 1500000, 4, '', ''),
(11, 'Gold Package', 'Lorem Ipsum', 2500000, 4, '', ''),
(12, 'Silver Package', 'Lorem Ipsum', 550000, 5, '', ''),
(13, 'Gold Package', 'Lorem Ipsum', 1200000, 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `id_user`, `id_produk`, `nomor_invoice`, `pesan`, `rating`, `display`) VALUES
(1, 2, 1, '', 'Mantap', 5, 1),
(2, 3, 3, '', 'Betul', 5, 1),
(10, 2, 1, 'INV20230526134645', 'sssss', 5, 0),
(11, 2, 2, 'INV20230526134645', 'ss', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reschedule`
--

CREATE TABLE `reschedule` (
  `id` int(11) NOT NULL,
  `detail_penjualan` int(11) NOT NULL,
  `tgl_asal` date NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reschedule`
--

INSERT INTO `reschedule` (`id`, `detail_penjualan`, `tgl_asal`, `tgl_pengajuan`, `keterangan`, `status`) VALUES
(2, 4, '2023-06-10', '2023-06-11', 'Test', 'diterima'),
(3, 5, '2023-11-11', '2023-06-10', 'test 2', 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_komplain`
--

CREATE TABLE `timeline_komplain` (
  `id` int(11) NOT NULL,
  `id_komplain` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeline_komplain`
--

INSERT INTO `timeline_komplain` (`id`, `id_komplain`, `created_at`, `created_by`, `status`, `description`) VALUES
(9, 10, '2023-07-08 23:33:24', 2, 'komplain dibuat', 'Membuat komplain invoice #INV20230526134645'),
(10, 10, '2023-07-09 00:33:10', 1, 'dalam proses', 'Komplain sedang di proses'),
(15, 10, '2023-07-09 00:54:07', 1, 'ditolak', 'Alasan Tidak Jelas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `no_telpon` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `email`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `no_telpon`, `photo`, `is_admin`) VALUES
(1, 'administrators', 'admin', 'admin', 'admin@sistem.co.id', 'Global', 'Laki-laki', '2023-05-01', '08888', '78379b7983212668.png', 1),
(2, 'Test', 'samid', 'qwe', 'test2123@ggg', '-', 'Laki-laki', '2023-05-01', '08888', 'bd37219b3422a927.jpg', 0),
(3, 'administrators', 'mada', 'qwe', 'admin@sistem.co.id', 'Global', 'Laki-laki', '2023-05-01', '08888', 'profile_user_3.jpg', 0),
(5, 'administrators', 'dimmascool1231', '12312312312312', 'admin@sistem.co.id', 'Global', 'Laki-laki', '2023-05-01', '08888', 'default.jpg', 0),
(6, 'administrators', '12312', '123123', 'admin@sistem.co.id', 'Global', 'Laki-laki', '2023-05-01', '08888', 'default.jpg', 0),
(7, 'administrators', 'samid', '123123123', 'admin@sistem.co.id', 'Global', 'Laki-laki', '2023-05-01', '08888', 'default.jpg', 0),
(8, 'Dimas', 'dimasadmin', 'admin', 'dimasadam058@gmail.com', 'Taman Ciruas Permai Blok E3 No.3', 'Laki-laki', '2023-06-01', '081384077181', 'default.jpg', 1),
(9, 'ucup', 'ucup', 'ucup', 'Samsul@mgail.com', 'Mars', 'Laki-laki', '2023-06-01', '09991111', 'default.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_penjualan`
--
ALTER TABLE `payment_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nomor_invoice`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reschedule`
--
ALTER TABLE `reschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline_komplain`
--
ALTER TABLE `timeline_komplain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_penjualan`
--
ALTER TABLE `payment_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reschedule`
--
ALTER TABLE `reschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timeline_komplain`
--
ALTER TABLE `timeline_komplain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
