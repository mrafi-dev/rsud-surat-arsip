-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Sep 2025 pada 11.38
-- Versi server: 8.0.30
-- Versi PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat_arsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsips`
--

CREATE TABLE `arsips` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `activity`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, 'HAPUS PENGGUNA', 'Menghapus pengguna dengan nama \"adminsalsa\"', '2025-09-01 08:17:13', '2025-09-01 08:17:13'),
(2, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 222222', '2025-09-01 08:17:31', '2025-09-01 08:17:31'),
(3, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 12345', '2025-09-01 08:18:25', '2025-09-01 08:18:25'),
(4, 3, 'TAMBAH SURAT KELUAR', 'Menambahkan surat keluar baru dengan nomor 123456789', '2025-09-01 08:19:16', '2025-09-01 08:19:16'),
(5, 3, 'TAMBAH PENGGUNA', 'Menambahkan pengguna baru dengan nama \"adminsalsa\"', '2025-09-01 08:23:48', '2025-09-01 08:23:48'),
(6, 4, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 12345', '2025-09-01 08:39:19', '2025-09-01 08:39:19'),
(7, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 12345', '2025-09-01 16:20:28', '2025-09-01 16:20:28'),
(8, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 4', '2025-09-01 16:32:42', '2025-09-01 16:32:42'),
(9, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 63', '2025-09-01 16:37:17', '2025-09-01 16:37:17'),
(10, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor EWQE', '2025-09-01 16:37:36', '2025-09-01 16:37:36'),
(11, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 11', '2025-09-02 13:30:44', '2025-09-02 13:30:44'),
(12, 4, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 022', '2025-09-04 14:09:53', '2025-09-04 14:09:53'),
(13, 4, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 022', '2025-09-04 14:38:33', '2025-09-04 14:38:33'),
(14, 4, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 8', '2025-09-04 14:40:21', '2025-09-04 14:40:21'),
(15, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 11114', '2025-09-04 15:24:50', '2025-09-04 15:24:50'),
(16, 3, 'UBAH SURAT MASUK', 'Memperbarui data surat masuk dengan nomor 11114', '2025-09-04 15:25:13', '2025-09-04 15:25:13'),
(17, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 11114', '2025-09-04 15:25:21', '2025-09-04 15:25:21'),
(18, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 8', '2025-09-04 15:25:25', '2025-09-04 15:25:25'),
(19, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 11', '2025-09-04 15:25:27', '2025-09-04 15:25:27'),
(20, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor EWQE', '2025-09-04 15:25:29', '2025-09-04 15:25:29'),
(21, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 63', '2025-09-04 15:25:31', '2025-09-04 15:25:31'),
(22, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 4', '2025-09-04 15:25:33', '2025-09-04 15:25:33'),
(23, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 12345', '2025-09-04 15:25:34', '2025-09-04 15:25:34'),
(24, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 1', '2025-09-04 15:25:37', '2025-09-04 15:25:37'),
(25, 3, 'HAPUS SURAT MASUK', 'Menghapus surat masuk dengan nomor 2', '2025-09-04 15:25:38', '2025-09-04 15:25:38'),
(26, 3, 'TAMBAH SURAT KELUAR', 'Menambahkan surat keluar baru dengan nomor 1114', '2025-09-04 15:26:09', '2025-09-04 15:26:09'),
(27, 3, 'UBAH SURAT KELUAR', 'Memperbarui data surat keluar dengan nomor 1114', '2025-09-04 15:26:49', '2025-09-04 15:26:49'),
(28, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 1114', '2025-09-04 15:26:58', '2025-09-04 15:26:58'),
(29, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 123456789', '2025-09-04 15:27:02', '2025-09-04 15:27:02'),
(30, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 0111', '2025-09-04 15:27:04', '2025-09-04 15:27:04'),
(31, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 022', '2025-09-04 15:27:06', '2025-09-04 15:27:06'),
(32, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 5', '2025-09-04 15:27:08', '2025-09-04 15:27:08'),
(33, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 3', '2025-09-04 15:27:10', '2025-09-04 15:27:10'),
(34, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 2', '2025-09-04 15:27:12', '2025-09-04 15:27:12'),
(35, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 1', '2025-09-04 15:27:14', '2025-09-04 15:27:14'),
(36, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 03', '2025-09-04 15:27:16', '2025-09-04 15:27:16'),
(37, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 400', '2025-09-04 15:27:18', '2025-09-04 15:27:18'),
(38, 3, 'HAPUS SURAT KELUAR', 'Menghapus surat keluar dengan nomor 445', '2025-09-04 15:27:20', '2025-09-04 15:27:20'),
(39, 3, 'TAMBAH PENGGUNA', 'Menambahkan pengguna baru dengan nama \"Pa Yan0\"', '2025-09-04 15:28:33', '2025-09-04 15:28:33'),
(40, 3, 'UBAH PENGGUNA', 'Memperbarui data pengguna dengan nama \"Pa Yanto\"', '2025-09-04 15:28:45', '2025-09-04 15:28:45'),
(41, 3, 'HAPUS PENGGUNA', 'Menghapus pengguna dengan nama \"admin rafi\"', '2025-09-04 15:28:50', '2025-09-04 15:28:50'),
(42, 3, 'HAPUS PENGGUNA', 'Menghapus pengguna dengan nama \"admin sasa\"', '2025-09-04 15:28:55', '2025-09-04 15:28:55'),
(43, 3, 'HAPUS PENGGUNA', 'Menghapus pengguna dengan nama \"adminsalsa\"', '2025-09-04 15:28:57', '2025-09-04 15:28:57'),
(44, 3, 'TAMBAH PENGGUNA', 'Menambahkan pengguna baru dengan nama \"RafiSasa\"', '2025-09-04 15:29:39', '2025-09-04 15:29:39'),
(45, 3, 'TAMBAH SURAT KELUAR', 'Menambahkan surat keluar baru dengan nomor 022', '2025-09-04 15:30:46', '2025-09-04 15:30:46'),
(46, 3, 'TAMBAH SURAT KELUAR', 'Menambahkan surat keluar baru dengan nomor 021', '2025-09-04 15:34:30', '2025-09-04 15:34:30'),
(47, 3, 'TAMBAH SURAT KELUAR', 'Menambahkan surat keluar baru dengan nomor 020', '2025-09-04 15:36:34', '2025-09-04 15:36:34'),
(48, 3, 'TAMBAH SURAT MASUK', 'Menambahkan surat masuk baru dengan nomor 022', '2025-09-04 15:39:10', '2025-09-04 15:39:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@rsud.com|127.0.0.1', 'i:5;', 1754747450),
('laravel-cache-admin@rsud.com|127.0.0.1:timer', 'i:1754747450;', 1754747450),
('laravel-cache-rafi@unjani.com|127.0.0.1', 'i:1;', 1754335720),
('laravel-cache-rafi@unjani.com|127.0.0.1:timer', 'i:1754335720;', 1754335720);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_04_174709_create_surat_masuks_table', 2),
(5, '2025_08_04_174710_create_surat_keluars_table', 2),
(6, '2025_08_04_174711_create_arsips_table', 2),
(7, '2025_08_04_174713_create_audit_logs_table', 2),
(8, '2025_08_04_190936_add_role_to_users_table', 2),
(9, '2025_08_10_122151_create_surat_masuk_table', 3),
(10, '2025_08_10_125324_create_surat_keluar_table', 4),
(11, '2025_08_10_161802_add_isi_surat_html_to_surat_keluar_table', 5),
(12, '2025_08_24_150226_add_foto_profil_to_users_table', 6),
(13, '025_09_01_150355_create_audit_logs_table', 1),
(14, '025_09_01_150355_create_audit_logs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9f9XDXuq7ckVjW6XtAFPkCH2JPS6cBzGJllTs6fC', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNDJvQWdmRXFMTFh4RjV1UHU2RDBtOWFkbGFUaGNGa1dCNWxLeFNUVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvY2hhcnQtZGF0YT9wZXJpb2RlPTF5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1757516276),
('LHRbiODUSCP62Osh2m7RObpyXEO06OL069bF4cfa', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOUxKWVpYWjRjYUlTTERaTEtjbjFRQWt2czlHQ1BKaFZzMXdMR0hFOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvY2hhcnQtZGF0YT9wZXJpb2RlPTZtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1757507450),
('TFCFHQE2Gj5wMyGJmtdeMJIwJ3sDoYwsQNHWu9m7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaThJS0JuWHZvMnBhR1VCVEgzRlZ5cXZpMU5sRHJNVnBYRWQ1VFEwbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1757246765);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `isi_surat_html` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `nomor_surat`, `tanggal_surat`, `tujuan`, `perihal`, `keterangan`, `isi_surat_html`, `file_surat`, `user_id`, `created_at`, `updated_at`) VALUES
(14, '022', '2025-09-04', 'Test', 'testing', 'mencoba fitur fitur', '<p>mencoba fitur fitur</p>', 'surat-keluar/surat-keluar-1756999845.pdf', 3, '2025-09-04 15:30:46', '2025-09-04 15:30:46'),
(15, '021', '2025-09-04', 'mencoba', 'tessting', 'test test test test&nbsp; test&nbsp; test&nbsp; test', '<p>test<strong> test</strong><i><strong> test<u> test&nbsp;</u></strong></i><span style=\"background-color:hsl(120, 75%, 60%);\"> test&nbsp;</span><span class=\"text-huge\" style=\"background-color:hsl(120, 75%, 60%);\"> test</span><span class=\"text-huge\" style=\"background-color:hsl(120, 75%, 60%);font-family:\'Times New Roman\', Times, serif;\">&nbsp;</span><span class=\"text-huge\" style=\"background-color:hsl(0, 0%, 100%);font-family:\'Times New Roman\', Times, serif;\"> test</span></p>', 'surat-keluar/surat-keluar-1757000070.pdf', 3, '2025-09-04 15:34:30', '2025-09-04 15:34:30'),
(16, '020', '2025-09-04', 'mencoba fitur 3', 'testing 03', 'halo saya lagi mencoba fitur testing mencoba mengetik&nbsp; 12345667890-', '<p>halo saya lagi mencoba fitur testing mencoba mengetik<span style=\"background-color:hsl(120, 75%, 60%);\">&nbsp;</span><span style=\"background-color:hsl(0, 0%, 30%);\"> 12345667890-</span></p>', 'surat-keluar/surat-keluar-1757000193.pdf', 3, '2025-09-04 15:36:34', '2025-09-04 15:36:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluars`
--

CREATE TABLE `surat_keluars` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_diterima` date NOT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dilihat` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `nomor_surat`, `tanggal_surat`, `tanggal_diterima`, `pengirim`, `perihal`, `keterangan`, `file_surat`, `dilihat`, `user_id`, `created_at`, `updated_at`) VALUES
(12, '022', '2025-08-04', '2025-08-05', 'rafi', 'mencoba arsip', 'tetst', 'surat-masuk/CSvG5Td89EMf1iFdVsQDR2kMxeLeWNyB9LA6dI2m.pdf', 1, 3, '2025-09-04 15:39:10', '2025-09-04 15:40:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuks`
--

CREATE TABLE `surat_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `foto_profil`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Admin IT', 'admin@gmail.com', 'foto-profil/j2m20r51YagMEo5FE3Tcw78Olli80khgA0gu2Zwi.jpg', '2025-08-04 19:16:11', '$2y$12$zR4m9xv9.uP4U2pSFLLrfOGZohSrVDQBlKW9FeJfELz3HACucPWJW', 'RBweufQnGQKTKlqYia6tQiMwHsm4xLKKi3x9sYPbuge35CwDonggK24V8SgF', 'admin', '2025-08-04 19:16:11', '2025-09-04 15:23:56'),
(4, 'Petugas TU', 'tu@gmail.com', 'foto-profil/MFC2KC8A6FBPa4B8BtnPFResL29EFV70DzZCtMog.jpg', '2025-08-04 19:16:11', '$2y$12$x.gJ7KpDoHjYh6w1JAZI..6W2fW1in5PBdfpQp.SE1Wy9oD1fCyyq', 'xqSP1o3Ebp8zLP3O3uz10NaOu1nTnKhDOuaGUi8xmSLmzRzImKXTw9nzoWAN', 'tu', '2025-08-04 19:16:11', '2025-09-01 08:38:24'),
(13, 'Pa Yanto', 'payanto@gmail.com', NULL, NULL, '$2y$12$te.DLmJVn7A60pv2qk298uyoZz6fDrpq7Gb6pQeYVA5FPiPECAZwy', NULL, 'admin', '2025-09-04 15:28:33', '2025-09-04 15:28:45'),
(14, 'RafiSasa', 'rafisasa@gmail.com', NULL, NULL, '$2y$12$gLwoh0VhF1TwuCmCly76DeJmJaaXx6m6vwhew2vSFTJPsxXeDfvcW', NULL, 'tu', '2025-09-04 15:29:39', '2025-09-04 15:29:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsips`
--
ALTER TABLE `arsips`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_keluar_nomor_surat_unique` (`nomor_surat`),
  ADD KEY `surat_keluar_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_masuk_nomor_surat_unique` (`nomor_surat`),
  ADD KEY `surat_masuk_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `surat_masuks`
--
ALTER TABLE `surat_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `arsips`
--
ALTER TABLE `arsips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `surat_keluars`
--
ALTER TABLE `surat_keluars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `surat_masuks`
--
ALTER TABLE `surat_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `surat_keluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
