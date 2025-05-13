-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 02:02 PM
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
('BK0008', 'admin', '2023-06-18');

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `IdCust` varchar(6) NOT NULL,
  `NamaCust` varchar(50) DEFAULT NULL,
  `NoTelp` char(13) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Alamat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`IdCust`, `NamaCust`, `NoTelp`, `Email`, `Alamat`) VALUES
('C0001', 'gatau', '678765456789', 'gatau@gmail.com', 'sinilo'),
('C0003', 'Sumiati', '086798743234', 'sumiati@gmail.com', 'Banyuwangi'),
('C0004', 'Mawar', '087676545423', 'mawarmelati@gmail.com', 'Taman'),
('C0005', 'Bunga', '087876565643', 'bunga@gmail.com', 'banyuwangi');

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
('3423531787', 'Banner', 'S0001', 50, 'S0006'),
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
('BK0008', '4970129727514', 3);

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
('TR0001', 'P0003', 6, 10500),
('TR0002', 'P0002', 7, 12000),
('TR0002', 'P0001', 5, 25000),
('TR0003', 'P0001', 5, 25000),
('TR0003', 'P0003', 6, 10500),
('TR0004', 'P0001', 5, 25000),
('TR0004', 'P0002', 10, 12000),
('TR0005', 'P0002', 4, 12000),
('TR0006', 'P0003', 10, 10500),
('TR0007', 'P0002', 15, 12000),
('TR0008', 'P0002', 12, 12000),
('TR0009', 'P0002', 5, 12000),
('TR0012', 'P0001', 5, 25000),
('TR0013', 'P0003', 5, 52500);

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
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `IdProduk` varchar(6) NOT NULL,
  `NamaProduk` varchar(25) DEFAULT NULL,
  `HargaProduk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`IdProduk`, `NamaProduk`, `HargaProduk`) VALUES
('P0001', 'Kalender', 25000),
('P0002', 'Brosur', 12000),
('P0003', 'Kartu Nama', 10500),
('P0004', 'Buku', 30000),
('P0005', 'Spanduk', 60000);

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
  `IdCust` varchar(6) NOT NULL,
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

INSERT INTO `transaksi` (`IdTransaksi`, `username`, `IdCust`, `Bayar`, `SisaBayar`, `Kembali`, `GrandTotal`, `tglTransaksi`, `StatusPembayaran`, `StatusPesanan`, `tglUpdate`) VALUES
('TR0001', 'tsy24', 'C0003', 50000, 13000, 0, 63000, '2023-06-02 10:51:58', 'Belum Lunas', NULL, NULL),
('TR0002', 'tsy24', 'C0004', 210000, 0, 1000, 209000, '2023-06-05 11:59:49', 'Lunas', 'Sedang Proses', NULL),
('TR0003', 'tsy24', 'C0004', 100000, 88000, 0, 188000, '2023-06-09 14:19:53', 'Belum Lunas', NULL, NULL),
('TR0004', 'tsy24', 'C0003', 200000, 45000, 0, 245000, '2023-06-11 14:21:15', 'Lunas', 'Selesai', '2023-06-14 19:48:04'),
('TR0005', 'tsy24', 'C0004', 50000, 0, 2000, 48000, '2023-06-11 14:30:34', 'Lunas', 'Selesai', '2023-06-17 12:31:04'),
('TR0006', 'tsy24', 'C0004', 100000, 5000, 0, 105000, '2023-06-11 14:31:50', 'Lunas', 'Sedang Proses', '2023-06-14 19:50:35'),
('TR0007', 'tsy24', 'C0004', 100000, 80000, 0, 180000, '2023-06-11 14:33:08', 'Belum Lunas', NULL, '2023-06-17 13:20:27'),
('TR0008', 'tsy24', 'C0004', 200000, 0, 56000, 144000, '2023-06-06 14:37:30', 'Lunas', 'Selesai', '2023-06-17 12:45:03'),
('TR0009', 'tsy24', 'C0003', 60000, 0, 0, 60000, '2023-06-05 14:57:57', 'Lunas', 'Selesai', '2023-06-17 12:56:32'),
('TR0010', 'tsy24', 'C0005', 150000, 100000, 0, 250000, '2023-06-13 21:56:10', 'Belum Lunas', NULL, NULL),
('TR0011', 'tsy24', 'C0005', 150000, 0, 25000, 125000, '2023-06-13 22:14:24', 'Lunas', 'Sedang Proses', NULL),
('TR0012', 'tsy24', 'C0004', 150000, 0, 25000, 125000, '2023-06-13 22:32:12', 'Lunas', 'Sedang Proses', NULL),
('TR0013', 'tsy24', 'C0005', 55000, 0, 2500, 52500, '2023-06-17 13:29:56', 'Lunas', 'Sedang Proses', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user` varchar(10) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `email`, `email_verified_at`, `username`, `password`, `user`, `remember_token`, `img`) VALUES
(1, 'Admin', 'admin1@gmail.com', '2025-04-30 08:50:56', 'admin', '$2y$10$a5CeW7r8VeUPy2hQXI5xJuNhnPo8CWfDwJJQhauP0g1BJ/77olWh.', 'Admin', '', 'images/1815883516605523.jpeg'),
(2, 'Fanidiya Tasya', 'admin@gmail.com', '2025-04-30 08:50:56', 'tsy24', '$2y$10$1MVL2kvJawHkzZ5uqlNeJ.CeTnwkzyaWJaMxI.6A.EE.xOf2L2WDu', 'Admin', '2Kgb3f2zZcQTS6r3BfqxWctEldLkIJYjsIeKH5I3io3VEA6bVLSAYQXNs3z0', 'images/1815883516605523.jpeg');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`IdCust`);

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
  ADD KEY `IdCust` (`IdCust`);

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`IdCust`) REFERENCES `customer` (`IdCust`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
