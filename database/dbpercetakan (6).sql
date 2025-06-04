-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 04, 2025 at 06:52 AM
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
(1, 4, 'awd', 'Ahmad Muzakki', '19272342', 'jshd', 'asjdb', 'ajshbdw\r\njknasd', 0, '2025-05-18 06:48:43', '2025-05-31 00:02:12'),
(2, 4, 'Jember', 'Alan', '081238288', 'Jember', '190237', 'Jalan Kamilantan', 0, '2025-05-23 15:00:02', '2025-05-31 00:02:12');

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
  `IdSatuan` varchar(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`IdBarang`, `NamaBarang`, `IdJenisBarang`, `JumlahStok`, `IdSatuan`, `created_at`, `updated_at`) VALUES
('173462738912', 'Satin', 'S0005', 50, 'S0006', NULL, '2025-06-02 21:26:47'),
('3423531787', 'Banner', 'S0001', 30, 'S0006', NULL, '2025-05-31 09:35:20'),
('4005401171027', 'F4', 'S0001', 33, 'S0001', NULL, '2025-05-31 09:35:20'),
('4970129727514', 'Buffalo', 'S0001', 26, 'S0002', NULL, '2025-05-31 09:35:20'),
('4970129759652', 'A4', 'S0001', 45, 'S0001', NULL, '2025-05-31 09:35:20'),
('6923655547512', 'Tinta', 'S0003', 8, 'S0004', NULL, '2025-05-31 09:35:20'),
('8991389230237', 'A5', 'S0001', 27, 'S0001', NULL, '2025-05-31 09:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barangkeluar`
--

CREATE TABLE `detail_barangkeluar` (
  `IdKeluar` varchar(6) DEFAULT NULL,
  `IdBarang` varchar(13) DEFAULT NULL,
  `QtyKeluar` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barangkeluar`
--

INSERT INTO `detail_barangkeluar` (`IdKeluar`, `IdBarang`, `QtyKeluar`, `created_at`, `updated_at`) VALUES
('BK0003', '4970129759652', 4, NULL, NULL),
('BK0003', '6923655547512', 5, NULL, NULL),
('BK0004', '6923655547512', 5, NULL, NULL),
('BK0005', '8991389230237', 3, NULL, NULL),
('BK0005', '6923655547512', 15, NULL, NULL),
('BK0006', '4970129759652', 10, NULL, NULL),
('BK0007', '4970129727514', 5, NULL, NULL),
('BK0008', '4970129727514', 3, NULL, NULL),
('BK0009', '3423531787', 20, NULL, NULL);

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
  `SubTotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barangmasuk`
--

INSERT INTO `detail_barangmasuk` (`IdMasuk`, `IdSupplier`, `IdBarang`, `QtyMasuk`, `HargaSatuan`, `SubTotal`, `created_at`, `updated_at`) VALUES
('BM0004', 'SP0002', '4970129727514', 20, 55000, 1100000, NULL, '2025-05-31 09:32:43'),
('BM0005', 'SP0003', '8991389230237', 25, 50000, 1250000, NULL, '2025-05-31 09:32:43'),
('BM0006', 'SP0002', '4970129759652', 54, 45000, 2430000, NULL, '2025-05-31 09:32:43'),
('BM0007', 'SP0003', '6923655547512', 3, 34000, 102000, NULL, '2025-05-31 09:32:43'),
('BM0007', 'SP0003', '4005401171027', 4, 45000, 180000, NULL, '2025-05-31 09:32:43'),
('BM0008', 'SP0001', '4005401171027', 5, 38500, 192500, NULL, '2025-05-31 09:32:43'),
('BM0009', 'SP0001', '3423531787', 50, 55000, 2750000, NULL, '2025-05-31 09:32:43'),
('BM0010', 'SP0001', '173462738912', 50, 55000, 2750000, NULL, '2025-05-31 09:32:43');

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
  `id_ukuran` int(6) DEFAULT NULL,
  `QtyProduk` int(3) DEFAULT NULL,
  `SubTotal` int(11) DEFAULT NULL,
  `CustomUkuran` varchar(100) DEFAULT NULL,
  `design_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`IdTransaksi`, `IdProduk`, `id_ukuran`, `QtyProduk`, `SubTotal`, `CustomUkuran`, `design_file`) VALUES
('TR0001', 'P0006', 4, 3, 60000, NULL, 'designs/3T0CvMQDUVb4plSbCV83fgUE62CRwdr146f5aNw5.png'),
('TR0001', 'P0006', NULL, 4, 112000, NULL, 'designs/gjT7SjIbYb9q2zrQGwdUrfWPSfZltViJypORZPaF.png'),
('TR0001', 'P0001', NULL, 2, 112000, '2x3 Meter', 'designs/YiZJu6uAqvMlvlD9knNbEoXn8Zgv6gBGvABb96p4.jpg'),
('TR0002', 'P0006', NULL, 3, 84000, '2x3 Meter', 'designs/Ou8v0DXcwZMeFCKuLK63BGZ0gXcekx3DFnWlqKEt.jpg'),
('TR0003', 'P0003', 3, 1, 23000, NULL, 'designs/f7dfT11iPKU0JbHUqGc5ktuvIyPgkUT4zl5V4B3y.png'),
('TR0004', 'P0002', 1, 3, 120000, NULL, 'designs/tCBS6Z7J6OCePudJKn8y4BSZOaoXcGF9Ea2RX1O8.jpg'),
('TR0005', 'P0003', NULL, 2, 64000, '2x3 Meter', 'designs/qZhbtWimkJyHGzkJPuohfeV83yTzK9HmH5JBN9nu.jpg');

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
('S0005', 'Kain'),
('S0007', 'Karton'),
('S0001', 'Kertas'),
('S0008', 'Koko'),
('S0002', 'Lem'),
('S0006', 'Plastik'),
('S0004', 'Plat'),
('S0003', 'Tinta');

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
(7, '2025_05_24_000000_modify_produk_table_structure', 5),
(8, '2025_05_30_084741_add_design_file_to_detail_transaksi_table', 6),
(9, '2025_06_02_093641_add_shipping_method_to_transaksi_table', 7),
(10, '2025_06_02_095211_add_notes_to_transaksi_table', 8);

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
  `custom_harga` int(50) NOT NULL,
  `Img` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(1500) NOT NULL,
  `id_bahan` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`IdProduk`, `NamaProduk`, `custom_harga`, `Img`, `deskripsi`, `id_bahan`) VALUES
('P0001', 'Kalender', 6000, 'produk/kalender.jpg', '🗓️ Kalender Custom: Promosi & Hadiah yang Tahan Lama!\r\n\r\nKalender adalah media promosi sepanjang tahun. Cocok untuk souvenir akhir tahun, branding perusahaan, atau kebutuhan pribadi.\r\n\r\n📐 Jenis Kalender:\r\n\r\nKalender Meja: Ukuran A5, A6 (14 Halaman + Cover)\r\n\r\nKalender Dinding: Ukuran A3 / A4 (1 Lembar atau 12 Lembar)\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Paper 150gr / 210gr\r\n\r\nIvory 260gr / Duplex\r\n\r\n💰 Harga Mulai Rp8.000 / pcs (untuk cetak banyak)\r\n\r\nKeunggulan:\r\n☑️ Bisa Custom Foto, Logo, & Warna\r\n☑️ Sudah Termasuk Spiral & Dudukan (untuk kalender meja)\r\n☑️ Cocok untuk Hadiah & Branding Perusahaan\r\n☑️ Minimal order hanya 10 pcs', '8991389230237'),
('P0002', 'Brosur', 7000, 'produk/brosur.jpg', '📄 Cetak Brosur: Media Informasi Cepat & Efisien untuk Promosi\r\n\r\nBrosur adalah cara jitu menyampaikan informasi lengkap dalam satu genggaman. Cocok untuk promosi produk, jasa, event, atau profil perusahaan.\r\n\r\n📐 Ukuran Tersedia: A5, A4, A3 (Lipat 2 atau 3)\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Paper 120gr / 150gr\r\n\r\nArt Carton 190gr / 210gr\r\n\r\nFinishing: Laminasi, Lipat Dua / Tiga\r\n\r\n💰 Harga Mulai Rp150 / lembar (untuk cetak banyak)\r\n\r\nKelebihan:\r\n☑️ Hasil Cetak Tajam & Warna Cerah\r\n☑️ Gratis Cek File Desain\r\n☑️ Bisa Pakai Template atau Desain Sendiri\r\n☑️ Proses cepat, hasil maksimal!', '6923655547512'),
('P0003', 'Kartu Nama', 9000, 'produk/kartunama.jpg', '👔 Cetak Kartu Nama Eksklusif: Bangun Citra Profesional dari Pertemuan Pertama\r\n\r\nKartu nama adalah kesan pertama yang tak terlupakan. Cetak kartu nama kamu dengan kualitas terbaik, bahan premium, dan desain eksklusif di Citra Media!\r\n\r\n📐 Ukuran Standard: 9 x 5.5 cm\r\n\r\n🎨 Jenis Kertas:\r\n\r\nArt Carton 260gr / 310gr\r\n\r\nLinen / Ivory / Matte Paper\r\n\r\nFinishing: Laminasi Doff / Glossy, Sudut Tumpul (Rounded)\r\n\r\n💰 Harga Mulai Rp30.000 / 100 pcs\r\n\r\nKelebihan:\r\n☑️ Desain Custom atau Pakai Template Siap Cetak\r\n☑️ Proses Cepat 1–2 Hari Kerja\r\n☑️ Bisa Cetak 1 atau 2 Sisi\r\n☑️ Bonus File Digital untuk Branding Online', '8991389230237'),
('P0004', 'Buku', 9000, 'produk/buku.jpg', 'Custom Buku Cetak - Citra Media Digital Printing\r\n\r\n📚 Cetak Buku Custom: Solusi Cetak Profesional untuk Kebutuhan Kamu!\r\n\r\nKini kamu bisa mencetak buku custom untuk berbagai kebutuhan seperti laporan tahunan, skripsi, modul pelatihan, buku yasin, hingga buku agenda pribadi. Citra Media menghadirkan layanan cetak buku dengan kualitas tinggi dan pilihan finishing lengkap yang bisa disesuaikan!\r\n\r\n📏 Tersedia Berbagai Ukuran Populer\r\nMulai dari A5, A4, B5, hingga ukuran custom sesuai kebutuhanmu. Uk', '6923655547512'),
('P0005', 'Spanduk', 7000, 'produk/H6CrHNmMCNzUDvaSFtd8Bkl3yeg9qhT231yNdv9v.png', '📢 Cetak Spanduk Custom: Media Promosi Andal & Efektif!\r\n\r\nTingkatkan daya tarik bisnis dan event kamu dengan spanduk berkualitas dari Citra Media Digital Printing! Kami melayani cetak spanduk berbagai ukuran dan bahan sesuai kebutuhan promosi kamu.\r\n\r\n🖼️ Ukuran Tersedia:\r\nMulai dari ukuran kecil 50x50cm, 100x50cm, hingga ukuran besar seperti 3x4m, 4x6m, 10x5m.\r\n\r\n💰 Harga Mulai Rp13.000/meter (untuk pemesanan banyak)\r\nHarga normal Rp19.500/m — sudah FREE Finishing\r\n\r\nBahan yang Tersedia:\r\n\r\nChina', '4005401171027'),
('P0006', 'Sticker Label', 8000, 'produk/LPsFKlRNXHoVA2vyWxZ5RN7PanozEq07pwVvdsac.jpg', 'Cetak Stiker Label Custom - Identitas Produk Anda dalam Genggaman!\r\n\r\nIngin produk Anda tampil beda dan profesional? Ciptakan sticker label custom yang unik dan personal untuk bisnis, kemasan, atau acara Anda! Tersedia dalam berbagai bentuk, ukuran, dan bahan berkualitas tinggi yang tahan air dan awet. Desain sesuka hati Anda, kami cetak dengan presisi terbaik! Mulai dari label makanan, logo produk, hingga stiker komunitas, semua bisa Anda wujudkan di sini. Desain mudah, hasil maksimal!', '4970129727514'),
('P0007', 'Poster', 3000, 'produk/3KV93nhR5oRXIwuMNhnUphqFvFq2m0KCcA190W76.png', 'Poster Edukasi adalah media yang memuat informasi berupa teks atau gambar atau kombinasi antara teks dan gambar yang didesain dengan indah dan untuk pengetahuan umum anak. di Produksi dengan Mesin yang berKualitas HP Indigo 10000', '173462738912');

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

--
-- Dumping data for table `produk_size`
--

INSERT INTO `produk_size` (`IdProduk`, `id_ukuran`, `harga`, `created_at`, `updated_at`) VALUES
('P0001', 1, 50000, '2024-03-30 22:23:27', '2024-05-05 16:08:36'),
('P0001', 2, 40000, '2022-01-01 00:23:25', '2022-01-01 00:23:25'),
('P0002', 1, 40000, '2025-06-02 02:15:05', '2025-06-02 02:15:05'),
('P0003', 2, 17000, '2025-06-02 02:15:57', '2025-06-02 02:15:57'),
('P0003', 3, 23000, '2025-06-02 02:15:57', '2025-06-02 02:15:57'),
('P0004', 1, 40000, '2025-06-02 21:25:07', '2025-06-02 21:25:07'),
('P0004', 2, 33000, '2025-06-02 21:25:07', '2025-06-02 21:25:07'),
('P0005', 1, 23000, '2025-06-02 21:26:05', '2025-06-02 21:26:05'),
('P0006', 3, 10000, '2025-05-28 07:02:32', '2025-05-28 07:04:59'),
('P0006', 4, 20000, '2025-05-28 07:02:32', '2025-05-28 07:04:59'),
('P0007', 2, 20000, '2025-06-02 21:52:05', '2025-06-02 21:52:05'),
('P0007', 6, 12000, '2025-06-02 21:52:05', '2025-06-02 21:52:05');

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
('S0009', 'Cm'),
('S0003', 'Kg'),
('S0002', 'Pack'),
('S0005', 'Pcs'),
('S0001', 'Rim'),
('S0006', 'Roll'),
('S0004', 'Set');

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
(1, 'A3', 430, 530, 'S0009'),
(2, 'A5', 500, 450, 'S0001'),
(3, 'Sticker Pendek', 33, 10, 'S0009'),
(4, 'Sticker Medium', 44, 22, 'S0009'),
(6, 'A2', 30, 40, 'S0009');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `IdSupplier` varchar(6) NOT NULL,
  `NamaSupplier` varchar(30) DEFAULT NULL,
  `NoTelp` char(13) DEFAULT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`IdSupplier`, `NamaSupplier`, `NoTelp`, `Alamat`, `created_at`, `updated_at`) VALUES
('SP0001', 'Putra', '084567654323', 'Jl.Kalimantan No.13', NULL, '2025-05-31 09:33:51'),
('SP0002', 'Ramai Jaya', '083567676567', 'Jl.Sumatera No.122', NULL, '2025-05-31 09:33:51'),
('SP0003', 'Suka Aja', '0986252728', 'Jl.Sana', NULL, '2025-05-31 09:33:51'),
('SP0004', 'Mentari', '0856436896435', 'Jl.Kenanga', NULL, '2025-05-31 09:33:51'),
('SP0005', 'matahari', '087876565678', 'Jl.Karimata', NULL, '2025-05-31 09:33:51'),
('SP0006', 'Cita Jaya', '087876567656', 'Jl.Jawa', NULL, '2025-05-31 09:33:51'),
('SP0007', 'Citra Baru', '089765678765', 'Surabaya', NULL, '2025-05-31 09:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` varchar(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `alamat_pengiriman` varchar(255) NOT NULL,
  `Bayar` int(11) NOT NULL,
  `GrandTotal` int(11) NOT NULL,
  `tglTransaksi` datetime NOT NULL,
  `StatusPembayaran` varchar(20) NOT NULL,
  `StatusPesanan` varchar(20) DEFAULT NULL,
  `tglUpdate` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `shipping_method` varchar(255) DEFAULT NULL,
  `shipping_type` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IdTransaksi`, `username`, `id`, `address_id`, `alamat_pengiriman`, `Bayar`, `GrandTotal`, `tglTransaksi`, `StatusPembayaran`, `StatusPesanan`, `tglUpdate`, `created_at`, `updated_at`, `shipping_method`, `shipping_type`, `notes`) VALUES
('TR0001', 'jasjus841', 4, 2, 'Jalan Kamilantan', 0, 224000, '2025-05-31 08:08:47', 'Belum Lunas', 'Menunggu Konfirmasi', NULL, '2025-06-02 06:14:26', '2025-06-02 06:14:26', NULL, NULL, NULL),
('TR0002', 'jasjus841', 4, 2, 'Jalan Kamilantan', 104000, 104000, '2025-05-31 08:36:44', 'Lunas', 'Menunggu Konfirmasi', '2025-05-31 08:36:44', '2025-06-02 06:14:26', '2025-06-02 06:14:26', NULL, NULL, NULL),
('TR0003', 'jasjus841', 4, 2, 'Jalan Kamilantan', 0, 58000, '2025-06-02 09:45:18', 'Belum Lunas', 'Menunggu Konfirmasi', '2025-06-02 09:45:18', '2025-06-02 09:45:18', '2025-06-02 09:45:18', 'kurir', 'Express', NULL),
('TR0004', 'jasjus841', 4, 2, 'Jalan Kamilantan', 0, 120000, '2025-06-02 09:46:13', 'Belum Lunas', 'Menunggu Konfirmasi', '2025-06-02 09:46:13', '2025-06-02 09:46:13', '2025-06-02 09:46:13', 'pickup', NULL, NULL),
('TR0005', 'jasjus841', 4, 2, 'Jalan Kamilantan', 84000, 84000, '2025-06-03 04:15:23', 'Lunas', 'Menunggu Konfirmasi', '2025-06-03 04:15:23', '2025-06-03 04:15:23', '2025-06-03 04:15:23', 'kurir', 'Reguler', 'test note');

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
(4, 'Ahmad Muzakki', 'jasjus841@gmail.com', '0879272342', '2025-06-04 03:37:46', 'jasjus841', '$2y$12$X4cGX1XP/QkWh9c5bVOrKO8b5a68gTdscbDHNGMEn/.KUmqf/ZCui', 'User', '', 'ZZ7cPQgK1Mk3XqaQpMRjdtqtTyVDRRYIV4spb798VQiZ4fXwT71SfB5Nh1Uw', ''),
(5, 'Ahmad Rojali', 'rojali@gmail.com', '08970833227', '2025-05-23 15:16:50', 'rojali', '$2y$12$0o0UcbPaQuotlWGvgAtXceAz.fzSfuIhfOXx8XRwJ8M6pNbhRPhYS', 'User', '', NULL, 'default-avatar.png'),
(2, 'Fanidiya Tasya', 'admin@gmail.com', '082472332', '2025-06-02 09:25:09', 'tsy24', '$2y$12$X4cGX1XP/QkWh9c5bVOrKO8b5a68gTdscbDHNGMEn/.KUmqf/ZCui', 'Admin', '', 'cn6qC26YYn2VTxHObHkskWa2cV98hMp6Xn9xhXhtVA1Ogo3F7bYsSORVHVLn', 'images/1815883516605523.jpeg');

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
  ADD KEY `IdProduk` (`IdProduk`),
  ADD KEY `id_ukuran` (`id_ukuran`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`IdJenisBarang`),
  ADD UNIQUE KEY `JenisBarang` (`JenisBarang`);

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
  ADD KEY `id_bahan` (`id_bahan`);

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
  ADD PRIMARY KEY (`IdSatuan`),
  ADD UNIQUE KEY `Satuan` (`Satuan`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_ukuran`),
  ADD UNIQUE KEY `nama` (`nama`),
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
  ADD KEY `IdCust` (`id`),
  ADD KEY `address_id` (`address_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_ukuran` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_ukuran`) REFERENCES `produk_size` (`id_ukuran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_bahan`) REFERENCES `databarang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
