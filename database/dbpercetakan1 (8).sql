-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 03:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpercetakan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `label` varchar(255) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `full_address` text NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `label`, `recipient_name`, `phone_number`, `city`, `postal_code`, `full_address`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 4, 'awd', 'Ahmad Muzakki', '19272342', 'jshd', 'asjdb', 'ajshbdw\r\njknasd', 1, '2025-05-18 06:48:43', '2025-05-18 06:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `IdKeluar` varchar(6) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `tglKeluar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`IdKeluar`, `username`, `tglKeluar`) VALUES
('BK0001', 'tsy24', '2023-05-30'),
('BK0002', 'tsy24', '2023-06-01'),
('BK0003', 'tsy24', '2023-06-03'),
('BK0004', 'tsy24', '2023-06-06'),
('BK0005', 'tsy24', '2023-06-10'),
('BK0006', 'tsy24', '2023-06-13'),
('BK0007', 'tsy24', '2023-06-18'),
('BK0008', 'admin', '2023-06-18'),
('BK0009', 'tsy24', '2025-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `IdMasuk` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tglMasuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`IdMasuk`, `username`, `tglMasuk`) VALUES
('BM0001', 'tsy24', '2023-05-30'),
('BM0002', 'tsy24', '2023-05-30'),
('BM0003', 'tsy24', '2023-06-01'),
('BM0004', 'tsy24', '2023-06-10'),
('BM0005', 'tsy24', '2023-06-13'),
('BM0006', 'tsy24', '2023-06-13'),
('BM0007', 'tsy24', '2023-06-13'),
('BM0008', 'tsy24', '2023-06-13'),
('BM0009', 'tsy24', '2025-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `databarang`
--

CREATE TABLE `databarang` (
  `IdBarang` varchar(13) NOT NULL,
  `NamaBarang` varchar(25) DEFAULT NULL,
  `IdJenisBarang` varchar(6) DEFAULT NULL,
  `JumlahStok` int(11) NOT NULL DEFAULT 0,
  `IdSatuan` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`IdBarang`, `NamaBarang`, `IdJenisBarang`, `JumlahStok`, `IdSatuan`) VALUES
('3423531787', 'Banner', 'S0001', 30, 'S0006'),
('4005401171027', 'F4', 'S0001', 33, 'S0001'),
('4970129727514', 'Buffalo', 'S0001', 26, 'S0002'),
('4970129759652', 'A4', 'S0001', 45, 'S0001'),
('6923655547512', 'Tinta', 'S0003', 8, 'S0004'),
('8991389230237', 'A5', 'S0001', 27, 'S0001');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barangkeluar`
--

CREATE TABLE `detail_barangkeluar` (
  `IdKeluar` varchar(6) DEFAULT NULL,
  `IdBarang` varchar(13) DEFAULT NULL,
  `QtyKeluar` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barangkeluar`
--

INSERT INTO `detail_barangkeluar` (`IdKeluar`, `IdBarang`, `QtyKeluar`) VALUES
('BK0003', '4970129759652', 4),
('BK0003', '6923655547512', 5),
('BK0004', '6923655547512', 5),
('BK0005', '8991389230237', 3),
('BK0005', '6923655547512', 15),
('BK0006', '4970129759652', 10),
('BK0007', '4970129727514', 5),
('BK0008', '4970129727514', 3),
('BK0009', '3423531787', 20);

--
-- Triggers `detail_barangkeluar`
--
DELIMITER $$
CREATE TRIGGER `UpdateStokDeleteKeluar` AFTER DELETE ON `detail_barangkeluar` FOR EACH ROW UPDATE databarang
SET databarang.JumlahStok = databarang.JumlahStok + OLD.QtyKeluar
WHERE databarang.IdBarang = OLD.IdBarang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stokKeluar` AFTER INSERT ON `detail_barangkeluar` FOR EACH ROW BEGIN
UPDATE databarang
SET JumlahStok = JumlahStok - NEW.QtyKeluar
WHERE IdBarang = NEW.IdBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_barangmasuk`
--

CREATE TABLE `detail_barangmasuk` (
  `IdMasuk` varchar(6) DEFAULT NULL,
  `IdSupplier` varchar(6) DEFAULT NULL,
  `IdBarang` varchar(13) DEFAULT NULL,
  `QtyMasuk` int(3) DEFAULT NULL,
  `HargaSatuan` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barangmasuk`
--

INSERT INTO `detail_barangmasuk` (`IdMasuk`, `IdSupplier`, `IdBarang`, `QtyMasuk`, `HargaSatuan`, `SubTotal`) VALUES
('BM0004', 'SP0002', '4970129727514', 20, 55000, 1100000),
('BM0005', 'SP0003', '8991389230237', 25, 50000, 1250000),
('BM0006', 'SP0002', '4970129759652', 54, 45000, 2430000),
('BM0007', 'SP0003', '6923655547512', 3, 34000, 102000),
('BM0007', 'SP0003', '4005401171027', 4, 45000, 180000),
('BM0008', 'SP0001', '4005401171027', 5, 38500, 192500),
('BM0009', 'SP0001', '3423531787', 50, 55000, 2750000);

--
-- Triggers `detail_barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `UpdateStokDeleteMasuk` AFTER DELETE ON `detail_barangmasuk` FOR EACH ROW UPDATE databarang
SET databarang.JumlahStok = databarang.JumlahStok - OLD.QtyMasuk
WHERE databarang.IdBarang = OLD.IdBarang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stokMasuk` AFTER INSERT ON `detail_barangmasuk` FOR EACH ROW BEGIN
UPDATE databarang
SET JumlahStok = JumlahStok + NEW.QtyMasuk
WHERE IdBarang = NEW.IdBarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `IdTransaksi` varchar(8) DEFAULT NULL,
  `IdProduk` varchar(6) DEFAULT NULL,
  `QtyProduk` int(3) DEFAULT NULL,
  `SubTotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`IdTransaksi`, `IdProduk`, `QtyProduk`, `SubTotal`) VALUES
('TR0002', 'P0002', 1, 12000),
('TR0002', 'P0003', 1, 10500);

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `IdJenisBarang` varchar(6) NOT NULL,
  `JenisBarang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`IdJenisBarang`, `JenisBarang`) VALUES
('S0001', 'Kertas'),
('S0002', 'Lem'),
('S0003', 'Tinta'),
('S0004', 'Plat'),
('S0005', 'Fountain'),
('S0006', 'Plastik'),
('S0007', 'Karton'),
('S0008', 'Koko');

-- --------------------------------------------------------

--
-- Table structure for table `laporanbarang`
--

CREATE TABLE `laporanbarang` (
  `IdLaporan` bigint(20) UNSIGNED NOT NULL,
  `IdBarang` varchar(13) NOT NULL,
  `IdSupplier` bigint(20) UNSIGNED DEFAULT NULL,
  `QtyMasuk` int(11) NOT NULL DEFAULT 0,
  `QtyKeluar` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_transaksis`
--

CREATE TABLE `laporan_transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL DEFAULT 'Belum Lunas',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_transaksis`
--

INSERT INTO `laporan_transaksis` (`id`, `kode_transaksi`, `nama_pelanggan`, `produk`, `jumlah`, `harga_satuan`, `total_harga`, `tanggal_transaksi`, `status_pembayaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'TR0002', 'Ahmad Muzakki', 'Brosur', 1, 12000.00, 12000.00, '2025-05-17', 'Belum Lunas', 'Pesanan baru', '2025-05-17 09:09:13', '2025-05-17 09:09:13'),
(4, 'TR0002', 'Ahmad Muzakki', 'Kartu Nama', 1, 10500.00, 10500.00, '2025-05-17', 'Belum Lunas', 'Pesanan baru', '2025-05-17 09:09:13', '2025-05-17 09:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_05_03_103216_add_img_to_produk_table', 1),
(2, '2025_05_06_134412_create_laporans_table', 1),
(3, '2025_05_06_150856_create_laporan_transaksis_table', 1),
(4, '2025_05_18_131611_create_addresses_table', 2),
(5, '2025_05_18_131648_create_addresses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jasjus148@gmail.com', '$2y$12$4Q6l4BNrx8fPE3Dfxt87ge7FQfe2FU85OVS6heZrY/2JUHddvbPNO', '2024-06-10 05:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `IdProduk` varchar(6) NOT NULL,
  `NamaProduk` varchar(25) DEFAULT NULL,
  `HargaProduk` int(11) DEFAULT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`IdProduk`, `NamaProduk`, `HargaProduk`, `Img`) VALUES
('P0001', 'Kalender', 25000, NULL),
('P0002', 'Brosur', 12000, NULL),
('P0003', 'Kartu Nama', 10500, NULL),
('P0004', 'Buku', 30000, NULL),
('P0005', 'Spanduk', 60000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2024-02-28 02:12:01', '2024-02-28 02:12:01'),
(2, 'user', 'User', 'User', '2024-02-28 02:12:01', '2024-02-28 02:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(1, 2, 'App\\Models\\User'),
(2, 81, 'App\\Models\\User'),
(2, 83, 'App\\Models\\User'),
(2, 84, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `IdSatuan` varchar(6) NOT NULL,
  `Satuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`IdSatuan`, `Satuan`) VALUES
('S0001', 'Rim'),
('S0002', 'Pack'),
('S0003', 'Kg'),
('S0004', 'Set'),
('S0005', 'Pcs'),
('S0006', 'Roll'),
('S0009', 'Cm');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `IdSupplier` varchar(6) NOT NULL,
  `NamaSupplier` varchar(30) DEFAULT NULL,
  `NoTelp` char(13) DEFAULT NULL,
  `Alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`IdSupplier`, `NamaSupplier`, `NoTelp`, `Alamat`) VALUES
('SP0001', 'Putra', '084567654323', 'Jl.Kalimantan No.12'),
('SP0002', 'Ramai Jaya', '083567676567', 'Jl.Sumatera No.122'),
('SP0003', 'Suka Aja', '0986252728', 'Jl.Sana'),
('SP0004', 'Mentari', '0856436896435', 'Jl.Kenanga'),
('SP0005', 'matahari', '087876565678', 'Jl.Karimata'),
('SP0006', 'Cita Jaya', '087876567656', 'Jl.Jawa'),
('SP0007', 'Citra Baru', '089765678765', 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` varchar(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `Bayar` int(11) NOT NULL,
  `SisaBayar` int(11) DEFAULT NULL,
  `Kembali` int(11) DEFAULT NULL,
  `GrandTotal` int(11) NOT NULL,
  `tglTransaksi` datetime NOT NULL,
  `StatusPembayaran` varchar(20) NOT NULL,
  `StatusPesanan` varchar(20) DEFAULT NULL,
  `tglUpdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IdTransaksi`, `username`, `id`, `Bayar`, `SisaBayar`, `Kembali`, `GrandTotal`, `tglTransaksi`, `StatusPembayaran`, `StatusPesanan`, `tglUpdate`) VALUES
('T0001', 'tsy24', 1, 1000000, NULL, NULL, 1000000, '2025-05-06 18:43:00', 'Lunas', 'lunas', '2025-05-06 23:43:01'),
('TR0002', 'jasjus841', 4, 0, 22500, 0, 22500, '2025-05-17 16:09:13', 'Belum Lunas', 'Menunggu Konfirmasi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user` varchar(10) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `email`, `nomor_telepon`, `email_verified_at`, `username`, `password`, `user`, `alamat`, `remember_token`, `img`) VALUES
(1, 'Admin', 'admin1@gmail.com', '', '2025-04-30 08:50:56', 'admin', '$2y$10$a5CeW7r8VeUPy2hQXI5xJuNhnPo8CWfDwJJQhauP0g1BJ/77olWh.', 'Admin', '', '', 'images/1815883516605523.jpeg'),
(4, 'Ahmad Muzakki', 'jasjus841@gmail.com', '0879272342', '2025-05-15 05:45:23', 'jasjus841', '$2y$12$JWa3fqRjlAanqrOJZAOdy.Sr3f7JXn/2sYOwpJoDRhwmIcEb/xUSK', 'User', '', NULL, ''),
(2, 'Fanidiya Tasya', 'admin@gmail.com', '', '2025-05-15 17:01:28', 'tsy24', '$2y$10$1MVL2kvJawHkzZ5uqlNeJ.CeTnwkzyaWJaMxI.6A.EE.xOf2L2WDu', 'Admin', '', 'b9GaHBMAqVks5ZMEyXqrDfLwLXClqgEykN2FOSRWmhAbH5M9w5dtLUG8lPKL', 'images/1815883516605523.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`IdKeluar`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`IdMasuk`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`IdBarang`),
  ADD KEY `IdJenisBarang` (`IdJenisBarang`),
  ADD KEY `IdSatuan` (`IdSatuan`);

--
-- Indexes for table `detail_barangkeluar`
--
ALTER TABLE `detail_barangkeluar`
  ADD KEY `IdKeluar` (`IdKeluar`),
  ADD KEY `IdBarang` (`IdBarang`);

--
-- Indexes for table `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  ADD KEY `IdMasuk` (`IdMasuk`),
  ADD KEY `IdBarang` (`IdBarang`),
  ADD KEY `IdSupplier` (`IdSupplier`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `IdTransaksi` (`IdTransaksi`),
  ADD KEY `IdProduk` (`IdProduk`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`IdJenisBarang`);

--
-- Indexes for table `laporanbarang`
--
ALTER TABLE `laporanbarang`
  ADD PRIMARY KEY (`IdLaporan`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_transaksis`
--
ALTER TABLE `laporan_transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`IdProduk`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`IdSatuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`IdSupplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IdTransaksi`),
  ADD KEY `username` (`username`),
  ADD KEY `IdCust` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporanbarang`
--
ALTER TABLE `laporanbarang`
  MODIFY `IdLaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_transaksis`
--
ALTER TABLE `laporan_transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD CONSTRAINT `barangkeluar_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `databarang`
--
ALTER TABLE `databarang`
  ADD CONSTRAINT `databarang_ibfk_1` FOREIGN KEY (`IdJenisBarang`) REFERENCES `jenisbarang` (`IdJenisBarang`),
  ADD CONSTRAINT `databarang_ibfk_2` FOREIGN KEY (`IdSatuan`) REFERENCES `satuan` (`IdSatuan`);

--
-- Constraints for table `detail_barangkeluar`
--
ALTER TABLE `detail_barangkeluar`
  ADD CONSTRAINT `detail_barangkeluar_ibfk_2` FOREIGN KEY (`IdKeluar`) REFERENCES `barangkeluar` (`IdKeluar`),
  ADD CONSTRAINT `detail_barangkeluar_ibfk_3` FOREIGN KEY (`IdBarang`) REFERENCES `databarang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  ADD CONSTRAINT `detail_barangmasuk_ibfk_2` FOREIGN KEY (`IdMasuk`) REFERENCES `barangmasuk` (`IdMasuk`),
  ADD CONSTRAINT `detail_barangmasuk_ibfk_3` FOREIGN KEY (`IdSupplier`) REFERENCES `supplier` (`IdSupplier`),
  ADD CONSTRAINT `detail_barangmasuk_ibfk_4` FOREIGN KEY (`IdBarang`) REFERENCES `databarang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`IdProduk`) REFERENCES `produk` (`IdProduk`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`IdTransaksi`) REFERENCES `transaksi` (`IdTransaksi`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
