-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 27, 2025 at 05:04 PM
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
-- Database: `dbpercetakan`
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
(1, 4, 'awd', 'Ahmad Muzakki', '19272342', 'jshd', 'asjdb', 'ajshbdw\r\njknasd', 1, '2025-05-18 06:48:43', '2025-05-18 06:48:43'),
(2, 4, 'Jember', 'Alan', '081238288', 'Jember', '190237', 'Asdjbiwdxz', 0, '2025-05-23 15:00:02', '2025-05-23 15:00:02');

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
('BM0009', 'tsy24', '2025-04-30'),
('BM0010', 'tsy24', '2025-05-23');

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
('173462738912', 'Mousepad', 'S0005', 50, 'S0002'),
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
('BM0009', 'SP0001', '3423531787', 50, 55000, 2750000),
('BM0010', 'SP0001', '173462738912', 50, 55000, 2750000);

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
('TR0002', 'P0003', 1, 10500),
('TR0003', 'P0002', 5, 60000),
('TR0003', 'P0001', 2, 50000),
('TR0004', 'P0002', 3, 36000),
('TR0004', 'P0001', 2, 50000),
('TR0005', 'P0002', 2, 24000),
('TR0005', 'P0003', 1, 10500),
('TR0006', 'P0002', 1, 12000),
('TR0006', 'P0001', 1, 25000),
('TR0007', 'P0002', 1, 12000),
('TR0008', 'P0003', 1, 10500);

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `persentase` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `nama`, `description`, `persentase`) VALUES
(1, 'Akhir Tahun', 'Diskon 50% setiap akhir tahun', 30);

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
  `IdBarang` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `IdSupplier` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdMasuk` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdKeluar` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporanbarang`
--

INSERT INTO `laporanbarang` (`IdLaporan`, `IdBarang`, `IdSupplier`, `IdMasuk`, `IdKeluar`, `created_at`, `updated_at`) VALUES
(112233, '6923655547512', 'SP0003', 'BM0005', 'BK0005', '2025-05-20 04:05:12', '2025-05-20 04:05:12'),
(123123, '3423531787', 'SP0001', 'BM0004', 'BK0003', '2025-05-20 04:02:26', '2025-05-20 04:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `laporantransaksi`
--

CREATE TABLE `laporantransaksi` (
  `Idlaporan_transaksi` varchar(6) NOT NULL,
  `IdTransaksi` varchar(8) NOT NULL,
  `IdProduk` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporantransaksi`
--

INSERT INTO `laporantransaksi` (`Idlaporan_transaksi`, `IdTransaksi`, `IdProduk`, `created_at`, `updated_at`) VALUES
('1213', 'T0001', 'P0001', '2025-05-20 14:44:55', '2025-05-20 14:44:55');

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
(5, '2025_05_18_131648_create_addresses_table', 3),
(6, '2025_05_22_064504_alter_produk_columns_to_nullable', 4),
(7, '2025_05_24_000000_modify_produk_table_structure', 5);

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
  `ukuran_produk` varchar(100) DEFAULT NULL,
  `jenis_bahan_produk` varchar(100) DEFAULT NULL,
  `custom_produk` varchar(100) DEFAULT NULL,
  `Img` varchar(255) DEFAULT NULL,
  `ukuran` int(6) NOT NULL,
  `deskripsi` varchar(1500) NOT NULL,
  `diskon` int(6) DEFAULT NULL,
  `id_bahan` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`IdProduk`, `NamaProduk`, `HargaProduk`, `ukuran_produk`, `jenis_bahan_produk`, `custom_produk`, `Img`, `ukuran`, `deskripsi`, `diskon`, `id_bahan`) VALUES
('P0001', 'Kalender', 25000, NULL, NULL, NULL, 'produk/kalender.jpg', 1, '🗓️ Kalender Custom: Promosi & Hadiah yang Tahan Lama!\r\n\r\nKalender adalah media promosi sepanjang tahun. Cocok untuk souvenir akhir tahun, branding perusahaan, atau kebutuhan pribadi.\r\n\r\n📐 Jenis Kalender:\r\n\r\nKalender Meja: Ukuran A5, A6 (14 Halaman + Cover)\r\n\r\nKalender Dinding: Ukuran A3 / A4 (1 Lembar atau 12 Lembar)\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Paper 150gr / 210gr\r\n\r\nIvory 260gr / Duplex\r\n\r\n💰 Harga Mulai Rp8.000 / pcs (untuk cetak banyak)\r\n\r\nKeunggulan:\r\n☑️ Bisa Custom Foto, Logo, & Warna\r\n☑️ Sudah Termasuk Spiral & Dudukan (untuk kalender meja)\r\n☑️ Cocok untuk Hadiah & Branding Perusahaan\r\n☑️ Minimal order hanya 10 pcs', 1, '8991389230237'),
('P0002', 'Brosur', 12000, NULL, NULL, NULL, 'produk/brosur.jpg', 1, '📄 Cetak Brosur: Media Informasi Cepat & Efisien untuk Promosi\r\n\r\nBrosur adalah cara jitu menyampaikan informasi lengkap dalam satu genggaman. Cocok untuk promosi produk, jasa, event, atau profil perusahaan.\r\n\r\n📐 Ukuran Tersedia: A5, A4, A3 (Lipat 2 atau 3)\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Paper 120gr / 150gr\r\n\r\nArt Carton 190gr / 210gr\r\n\r\nFinishing: Laminasi, Lipat Dua / Tiga\r\n\r\n💰 Harga Mulai Rp150 / lembar (untuk cetak banyak)\r\n\r\nKelebihan:\r\n☑️ Hasil Cetak Tajam & Warna Cerah\r\n☑️ Gratis Cek File Desain\r\n☑️ Bisa Pakai Template atau Desain Sendiri\r\n☑️ Proses cepat, hasil maksimal!', NULL, '8991389230237'),
('P0003', 'Kartu Nama', 10500, NULL, NULL, NULL, 'produk/kartunama.jpg', 1, '👔 Cetak Kartu Nama Eksklusif: Bangun Citra Profesional dari Pertemuan Pertama\r\n\r\nKartu nama adalah kesan pertama yang tak terlupakan. Cetak kartu nama kamu dengan kualitas terbaik, bahan premium, dan desain eksklusif di Citra Media!\r\n\r\n📐 Ukuran Standard: 9 x 5.5 cm\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Carton 260gr / 310gr\r\n\r\nLinen / Ivory / Matte Paper\r\n\r\nFinishing: Laminasi Doff / Glossy, Sudut Tumpul (Rounded)\r\n\r\n💰 Harga Mulai Rp30.000 / 100 pcs\r\n\r\nKelebihan:\r\n☑️ Desain Custom atau Pakai Template Siap Cetak\r\n☑️ Proses Cepat 1–2 Hari Kerja\r\n☑️ Bisa Cetak 1 atau 2 Sisi\r\n☑️ Bonus File Digital untuk Branding Online', NULL, '8991389230237'),
('P0004', 'Buku', 30000, NULL, NULL, NULL, 'produk/buku.jpg', 1, 'Custom Buku Cetak - Citra Media Digital Printing\r\n\r\n📚 Cetak Buku Custom: Solusi Cetak Profesional untuk Kebutuhan Kamu!\r\n\r\nKini kamu bisa mencetak buku custom untuk berbagai kebutuhan seperti laporan tahunan, skripsi, modul pelatihan, buku yasin, hingga buku agenda pribadi. Citra Media menghadirkan layanan cetak buku dengan kualitas tinggi dan pilihan finishing lengkap yang bisa disesuaikan!\r\n\r\n📏 Tersedia Berbagai Ukuran Populer\r\nMulai dari A5, A4, B5, hingga ukuran custom sesuai kebutuhanmu. Uk', NULL, '8991389230237'),
('P0005', 'Spanduk', 60000, NULL, NULL, NULL, 'produk/spanduk.jpg', 1, '📢 Cetak Spanduk Custom: Media Promosi Andal & Efektif!\r\n\r\nTingkatkan daya tarik bisnis dan event kamu dengan spanduk berkualitas dari Citra Media Digital Printing! Kami melayani cetak spanduk berbagai ukuran dan bahan sesuai kebutuhan promosi kamu.\r\n\r\n🖼️ Ukuran Tersedia:\r\nMulai dari ukuran kecil 50x50cm, 100x50cm, hingga ukuran besar seperti 3x4m, 4x6m, 10x5m.\r\n\r\n💰 Harga Mulai Rp13.000/meter (untuk pemesanan banyak)\r\nHarga normal Rp19.500/m — sudah FREE Finishing\r\n\r\nBahan yang Tersedia:\r\n\r\nChina', NULL, '8991389230237');

-- --------------------------------------------------------

--
-- Table structure for table `produk_size`
--

CREATE TABLE `produk_size` (
  `IdProduk` varchar(6) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 5, 'App\\Models\\User'),
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
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id_ukuran` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `panjang` int(10) NOT NULL,
  `lebar` int(10) NOT NULL,
  `id_satuan` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id_ukuran`, `nama`, `panjang`, `lebar`, `id_satuan`) VALUES
(1, 'A3', 430, 530, 'S0009');

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
('TR0002', 'jasjus841', 4, 0, 22500, 0, 22500, '2025-05-17 16:09:13', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0003', 'jasjus841', 4, 0, 110000, 0, 110000, '2025-05-19 00:27:29', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0004', 'jasjus841', 4, 0, 86000, 0, 86000, '2025-05-19 06:23:48', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0005', 'jasjus841', 4, 0, 34500, 0, 34500, '2025-05-20 08:34:42', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0006', 'jasjus841', 4, 0, 37000, 0, 37000, '2025-05-23 21:46:47', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0007', 'jasjus841', 4, 0, 12000, 0, 12000, '2025-05-23 22:03:53', 'Belum Lunas', 'Menunggu Konfirmasi', NULL),
('TR0008', 'jasjus841', 4, 10500, 0, 0, 10500, '2025-05-23 22:08:41', 'Lunas', 'Menunggu Konfirmasi', NULL);

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
(4, 'Ahmad Muzakki', 'jasjus841@gmail.com', '0879272342', '2025-05-23 15:34:22', 'jasjus841', '$2y$12$X4cGX1XP/QkWh9c5bVOrKO8b5a68gTdscbDHNGMEn/.KUmqf/ZCui', 'User', '', 'f5eGUIj1N7fF7JyvK5qZSgxx3GK2KoFmAGApnvndW1J0WD3vmRscsVdpJd6i', ''),
(5, 'Ahmad Rojali', 'rojali@gmail.com', '08970833227', '2025-05-23 15:16:50', 'rojali', '$2y$12$0o0UcbPaQuotlWGvgAtXceAz.fzSfuIhfOXx8XRwJ8M6pNbhRPhYS', 'User', '', NULL, 'default-avatar.png'),
(2, 'Fanidiya Tasya', 'admin@gmail.com', '082472332', '2025-05-24 09:11:37', 'tsy24', '$2y$12$X4cGX1XP/QkWh9c5bVOrKO8b5a68gTdscbDHNGMEn/.KUmqf/ZCui', 'Admin', '', 'OBU0oXgUD5G7R8Ic1ssg6A7QO849vmZlYjHI62q4Q3NlueLFuYZoZl18bYm9', 'images/1815883516605523.jpeg');

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
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`IdJenisBarang`);

--
-- Indexes for table `laporanbarang`
--
ALTER TABLE `laporanbarang`
  ADD PRIMARY KEY (`IdLaporan`),
  ADD UNIQUE KEY `IdBarang` (`IdBarang`,`IdSupplier`),
  ADD UNIQUE KEY `IdMasuk` (`IdMasuk`,`IdKeluar`),
  ADD KEY `IdSupplier` (`IdSupplier`),
  ADD KEY `IdKeluar` (`IdKeluar`);

--
-- Indexes for table `laporantransaksi`
--
ALTER TABLE `laporantransaksi`
  ADD PRIMARY KEY (`Idlaporan_transaksi`),
  ADD UNIQUE KEY `IdTransaksi` (`IdTransaksi`,`IdProduk`),
  ADD KEY `IdProduk` (`IdProduk`);

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
  ADD PRIMARY KEY (`IdProduk`),
  ADD KEY `diskon` (`diskon`,`id_bahan`),
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `ukuran` (`ukuran`);

--
-- Indexes for table `produk_size`
--
ALTER TABLE `produk_size`
  ADD PRIMARY KEY (`IdProduk`,`id_ukuran`),
  ADD KEY `produk_size_id_ukuran_foreign` (`id_ukuran`);

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
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_ukuran`),
  ADD KEY `id_satuan` (`id_satuan`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laporanbarang`
--
ALTER TABLE `laporanbarang`
  MODIFY `IdLaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123124;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_ukuran` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `laporanbarang`
--
ALTER TABLE `laporanbarang`
  ADD CONSTRAINT `laporanbarang_ibfk_1` FOREIGN KEY (`IdBarang`) REFERENCES `databarang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanbarang_ibfk_2` FOREIGN KEY (`IdSupplier`) REFERENCES `supplier` (`IdSupplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanbarang_ibfk_3` FOREIGN KEY (`IdMasuk`) REFERENCES `detail_barangmasuk` (`IdMasuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporanbarang_ibfk_4` FOREIGN KEY (`IdKeluar`) REFERENCES `detail_barangkeluar` (`IdKeluar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporantransaksi`
--
ALTER TABLE `laporantransaksi`
  ADD CONSTRAINT `laporantransaksi_ibfk_1` FOREIGN KEY (`IdTransaksi`) REFERENCES `transaksi` (`IdTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporantransaksi_ibfk_2` FOREIGN KEY (`IdProduk`) REFERENCES `produk` (`IdProduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `databarang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`diskon`) REFERENCES `diskon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`ukuran`) REFERENCES `size` (`id_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk_size`
--
ALTER TABLE `produk_size`
  ADD CONSTRAINT `produk_size_id_ukuran_foreign` FOREIGN KEY (`id_ukuran`) REFERENCES `size` (`id_ukuran`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_size_idproduk_foreign` FOREIGN KEY (`IdProduk`) REFERENCES `produk` (`IdProduk`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`IdSatuan`);

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
