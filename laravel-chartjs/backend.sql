-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2023 at 03:42 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_group`
--

CREATE TABLE `access_group` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  `access_detail` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_group`
--

INSERT INTO `access_group` (`id`, `nama`, `keterangan`, `access_detail`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(1, 'super', NULL, 'barang_manage;;barang_create;;barang_read;;barang_update;;barang_delete;;access_group_create;;access_group_read;;access_group_update;;users_delete;;', '2022-06-23 11:04:47', 1, '2023-09-20 13:34:29', 1),
(2, 'admin', NULL, 'barang_manage;;barang_create;;barang_read;;barang_update;;barang_delete;;', '2022-07-07 10:56:24', 1, '2022-11-10 05:11:32', 1),
(3, 'dev', NULL, 'access_group_create;;access_group_read;;access_group_update;;', '2022-07-04 11:21:40', 1, '2023-09-20 13:34:46', 1),
(4, 'k', 'wqe', NULL, '2022-11-10 04:59:03', 1, '2023-09-20 13:34:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_group_detail`
--

CREATE TABLE `access_group_detail` (
  `id_access_group` int NOT NULL,
  `id_access_master` int NOT NULL,
  `priority` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_group_detail`
--

INSERT INTO `access_group_detail` (`id_access_group`, `id_access_master`, `priority`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 3, NULL),
(1, 4, NULL),
(1, 5, NULL),
(1, 6, NULL),
(1, 7, NULL),
(1, 8, NULL),
(1, 9, NULL),
(1, 10, NULL),
(1, 11, NULL),
(1, 12, NULL),
(1, 13, NULL),
(1, 14, NULL),
(1, 15, NULL),
(1, 16, NULL),
(1, 17, NULL),
(1, 18, NULL),
(1, 19, NULL),
(1, 23, NULL),
(1, 24, NULL),
(1, 25, NULL),
(1, 26, NULL),
(1, 27, NULL),
(1, 28, NULL),
(1, 29, NULL),
(1, 30, NULL),
(1, 31, NULL),
(1, 32, NULL),
(1, 33, NULL),
(1, 36, NULL),
(1, 37, NULL),
(1, 38, NULL),
(1, 39, NULL),
(1, 40, NULL),
(1, 41, NULL),
(1, 42, NULL),
(1, 43, NULL),
(1, 44, NULL),
(1, 45, NULL),
(1, 46, NULL),
(1, 47, NULL),
(1, 48, NULL),
(1, 49, NULL),
(1, 50, NULL),
(1, 51, NULL),
(1, 52, NULL),
(1, 53, NULL),
(1, 54, NULL),
(1, 55, NULL),
(1, 56, NULL),
(1, 57, NULL),
(1, 58, NULL),
(1, 59, NULL),
(4, 2, NULL),
(4, 3, NULL),
(4, 4, NULL),
(2, 11, NULL),
(2, 12, NULL),
(2, 13, NULL),
(2, 14, NULL),
(2, 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `access_master`
--

CREATE TABLE `access_master` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_master`
--

INSERT INTO `access_master` (`id`, `nama`, `keterangan`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(1, 'access_group_manage', NULL, '2022-07-12 14:40:27', 1, '2022-10-28 07:01:03', 5),
(2, 'access_group_create', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(3, 'access_group_read', NULL, '2022-07-12 14:40:27', 1, '2022-10-28 10:50:14', 1),
(4, 'access_group_update', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(5, 'access_group_delete', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(6, 'access_master_manage', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(7, 'access_master_create', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(8, 'access_master_read', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(9, 'access_master_update', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(10, 'access_master_delete', NULL, '2022-07-12 14:40:27', 1, '2022-07-12 14:40:27', 1),
(11, 'barang_manage', NULL, '2022-10-28 10:45:20', 1, '2022-10-28 10:46:29', 1),
(12, 'barang_create', NULL, '2022-10-28 10:45:20', 1, '2022-10-28 10:46:33', 1),
(13, 'barang_read', NULL, '2022-10-28 10:46:13', 1, '2022-10-28 10:46:13', 1),
(14, 'barang_update', NULL, '2022-10-28 10:46:13', 1, '2022-10-28 10:46:13', 1),
(15, 'barang_delete', NULL, '2022-10-28 10:46:13', 1, '2022-10-28 10:46:13', 1),
(16, 'users_manage', NULL, '2022-10-28 11:00:46', 1, '2022-10-28 11:00:46', 1),
(17, 'users_create', NULL, '2022-10-28 11:00:46', 1, '2022-10-28 11:00:46', 1),
(18, 'users_read', NULL, '2022-10-28 11:00:46', 1, '2022-10-28 11:01:00', 1),
(19, 'users_update', NULL, '2022-10-28 11:00:46', 1, '2022-10-28 11:00:46', 1),
(20, 'users_delete', NULL, '2022-10-28 11:00:46', 1, '2022-10-28 11:00:46', 1),
(22, 'asdf', 'qwe', '2022-10-31 05:48:25', 5, '2022-10-31 05:48:25', 5),
(23, 'order_manage', NULL, '2022-11-10 06:44:07', 1, '2022-11-10 06:44:07', 1),
(24, 'order_create', NULL, '2022-11-10 06:44:22', 1, '2022-11-10 06:44:22', 1),
(25, 'order_read', NULL, '2022-11-10 06:44:27', 1, '2022-11-10 06:44:27', 1),
(26, 'order_update', NULL, '2022-11-10 06:44:37', 1, '2022-11-10 06:44:37', 1),
(27, 'order_delete', NULL, '2022-11-10 06:44:42', 1, '2022-11-10 06:44:42', 1),
(28, 'minta_manage', NULL, '2022-11-10 07:58:39', 1, '2022-11-10 07:58:39', 1),
(29, 'minta_create', NULL, '2022-11-10 07:58:45', 1, '2022-11-10 07:58:45', 1),
(30, 'minta_read', NULL, '2022-11-10 07:58:51', 1, '2022-11-10 07:58:51', 1),
(31, 'minta_update', NULL, '2022-11-10 07:58:57', 1, '2022-11-10 07:58:57', 1),
(32, 'minta_delete', NULL, '2022-11-10 07:59:02', 1, '2022-11-10 07:59:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `beli_minta`
--

CREATE TABLE `beli_minta` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_dibutuhkan` date NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `id_user_pemohon` int NOT NULL,
  `id_user_menyetujui` int NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = not completed, \r\n1 = completed, \r\n2 = partial,\r\n3 = canceled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_id` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli_minta`
--

INSERT INTO `beli_minta` (`id`, `tanggal`, `tanggal_dibutuhkan`, `no_faktur`, `id_user_pemohon`, `id_user_menyetujui`, `status`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(7, '2023-09-20', '2023-09-28', '12345', 3, 4, 0, '2023-09-19 23:11:04', 7, '2023-09-19 23:11:04', 7);

-- --------------------------------------------------------

--
-- Table structure for table `beli_order`
--

CREATE TABLE `beli_order` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_dibutuhkan` date NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `id_m_vendor` varchar(255) NOT NULL,
  `id_user_verifikasi` int NOT NULL,
  `jumlah` double NOT NULL DEFAULT '0' COMMENT 'total sebelum ppn',
  `ppn_percent` double NOT NULL DEFAULT '11',
  `pp_nominal` double NOT NULL DEFAULT '0',
  `total` double NOT NULL COMMENT 'total setelah ppn',
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = not completed,\r\n1 = completed,\r\n2 = partial,\r\n3 = canceled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beli_order`
--

INSERT INTO `beli_order` (`id`, `tanggal`, `tanggal_dibutuhkan`, `no_faktur`, `id_m_vendor`, `id_user_verifikasi`, `jumlah`, `ppn_percent`, `pp_nominal`, `total`, `status`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(2, '2023-09-20', '2023-09-21', '12345', 'PT Indofood', 1, 150000, 10, 10000, 150000, 0, '2023-09-19 22:39:54', 7, '2023-09-19 22:39:54', 7);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`id`, `nama`, `keterangan`, `status`, `created_at`, `created_id`, `updated_at`, `updated_id`) VALUES
(1, 'Barang 1', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 00:56:36', 1, '2023-09-20 06:35:59', 1),
(2, 'Barang 2', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 00:58:14', 1, '2023-09-20 06:36:01', 1),
(3, 'Barang 3', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 00:59:22', 1, '2023-09-20 06:36:04', 1),
(4, 'Barang 3', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 00:59:26', 1, '2023-09-20 06:36:06', 1),
(5, 'Barang 4', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 00:59:34', 1, '2023-09-20 06:36:08', 1),
(6, 'Barang 5', 'Lorem ipsum dolor sit amet.', 1, '2022-10-28 01:00:03', 1, '2023-09-20 06:36:11', 1),
(7, 'Barang 6', 'Lorem ipsum dolor sit amet.', 1, '2023-09-19 22:00:06', 7, '2023-09-20 06:36:13', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_access_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `id_access_group`) VALUES
(1, 'toros', 'toro@mail.com', '$2y$10$zwpPy0pCJ4IX.OWH0nC.YeP7gnDhjGKhWTeP6fuyzH6N3xlgHqqCO', '2022-07-07 09:10:39', '2022-07-19 08:27:13', 1),
(2, 'admin', 'admin@mail.com', '$2y$10$Rl23qhE5YKNPmz9O2liHLO5RYWHi.oRK1NHiemv6.FPx859XOQK8S', '2022-07-07 09:10:39', '2022-11-10 06:40:08', 2),
(3, 'min', 'min@mail.com', '$2y$10$fziFZu43CZbDQ.MV9lhc6eaoiMJfbxbqTRbwMLzs6wpO6MIMKOsdu', '2022-07-07 09:52:13', '2022-07-07 14:01:16', 2),
(4, 'new2', 'new2@mail.com', '$2y$10$.uPawK1oIkLugbxTuyUgaeHAcPqbTn.ZxIEGhFChy1B8kQYoVNIVW', '2022-07-19 05:22:11', '2022-07-19 05:22:11', 2),
(5, 'qwe', 'sad@asd', '$2y$10$2LD69jCbG7U7Qe2rlkou.OKY08QewTT6O23ffWfOq1Y5qd1.I86Z2', '2022-10-31 05:47:45', '2022-10-31 05:47:45', 1),
(6, 'Michael', 'toro@mail.comqwe', '$2y$10$9jvATfwpOVmQ4BAOActWi.wl.9lIeMXsqI69Hu.Ir/wVcHGeuehy2', '2022-11-10 05:08:55', '2022-11-10 05:09:38', 2),
(7, 'MinMax', 'admin@gmail.com', '$2y$10$xTuEQFkUlagUa6IAqWzdc.9V48NY9COHt0dftEznVaBOXojoLB0kG', '2023-09-19 13:35:43', '2023-09-20 13:42:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_group`
--
ALTER TABLE `access_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_created_id1` (`created_id`),
  ADD KEY `fk_updated_id2` (`updated_id`);

--
-- Indexes for table `access_group_detail`
--
ALTER TABLE `access_group_detail`
  ADD KEY `fk_id_access_group` (`id_access_group`),
  ADD KEY `fk_id_access_master` (`id_access_master`);

--
-- Indexes for table `access_master`
--
ALTER TABLE `access_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beli_minta`
--
ALTER TABLE `beli_minta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_pemohon` (`id_user_pemohon`),
  ADD KEY `id_user_menyetujui` (`id_user_menyetujui`);

--
-- Indexes for table `beli_order`
--
ALTER TABLE `beli_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_group`
--
ALTER TABLE `access_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `access_master`
--
ALTER TABLE `access_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `beli_minta`
--
ALTER TABLE `beli_minta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `beli_order`
--
ALTER TABLE `beli_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beli_minta`
--
ALTER TABLE `beli_minta`
  ADD CONSTRAINT `beli_minta_ibfk_1` FOREIGN KEY (`id_user_pemohon`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `beli_minta_ibfk_2` FOREIGN KEY (`id_user_menyetujui`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
