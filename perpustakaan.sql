-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Jul 2025 pada 06.30
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `anggota_sejak` datetime DEFAULT NULL,
  `tanggal_registrasi` datetime DEFAULT NULL,
  `berlaku_hingga` datetime DEFAULT NULL,
  `institusi` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_keanggotaan` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_identitas` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `tunda_keanggotaan` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `katasandi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konfirmasi_katasandi_baru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `surel`, `tanggal_lahir`, `anggota_sejak`, `tanggal_registrasi`, `berlaku_hingga`, `institusi`, `tipe_keanggotaan`, `jenis_kelamin`, `nomor_identitas`, `catatan`, `tunda_keanggotaan`, `foto`, `katasandi`, `konfirmasi_katasandi_baru`, `program_studi_id`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'budi@example.com', '1998-06-15', '2022-07-05 07:15:53', '2022-07-05 07:15:53', '2027-07-05 07:15:53', 'Universitas A', 'Mahasiswa', 'Laki-laki', '123456789', 'Anggota aktif', 0, NULL, '$2y$12$NfZB9/skIoU/5KBKqBHK9.IdGYaNtPOcxzf8FrXZygbKkDDBZWuU2', NULL, 1, NULL, NULL),
(2, 'Siti Aisyah', 'siti@example.com', '1995-09-21', '2020-07-05 07:15:53', '2020-07-05 07:15:53', '2026-07-05 07:15:53', 'Universitas B', 'Dosen', 'Perempuan', '987654321', 'Sering meminjam buku', 0, NULL, '$2y$12$0j4IYxz4m.iGhcYGdHv62.YHCwR.dwNzqYRc5uqzLksk21ZJ5l6dS', NULL, 2, NULL, NULL),
(3, 'Ahmad Fauzi', 'ahmad@example.com', '2000-12-10', '2023-07-05 07:15:53', '2023-07-05 07:15:53', '2028-07-05 07:15:53', 'Universitas C', 'Mahasiswa', 'Laki-laki', '456789123', NULL, 0, NULL, '$2y$12$OsJuGjevjV.1xYfYg76wz.vGo2fIvFrS3hdU5oV3rgCyEoxhh/QNW', NULL, 3, NULL, NULL),
(4, 'Dewi Lestari', 'dewi@example.com', '1988-03-05', '2017-07-05 07:15:54', '2017-07-05 07:15:54', '2027-07-05 07:15:54', 'Universitas D', 'Dosen', 'Perempuan', '741852963', 'Mengajar bidang teknologi', 0, NULL, '$2y$12$AGHlD3upehgLd5pDc6SMo.3RQXQ4z4yULgPstQDyNSuJuCIrVmpp2', NULL, 4, NULL, NULL),
(5, 'Joko Widodo', 'joko@example.com', '1975-07-20', '2015-07-05 07:15:54', '2015-07-05 07:15:54', '2030-07-05 07:15:54', 'Umum', 'Umum', 'Laki-laki', '852963741', 'Anggota umum aktif', 0, NULL, '$2y$12$Y3ZBgh6Q/Zb7okoJH89u2ueIzNtseHWEqOgnDlg.FlKCZap2NYTni', NULL, NULL, NULL, NULL),
(6, 'Agus Harimurti', 'agust1@gmail.com', '2000-07-19', '2025-07-05 00:00:00', '2025-07-05 00:00:00', '2029-07-05 00:00:00', 'Politeknik Negeri Banyuwangi', 'Mahasiswa', 'Laki-laki', '362055401121', 'aman', 0, 'foto-anggota/0Bioj3yJFhnNVCI85Nwr8MQCTnljcPPVMWtJymYW.png', '$2y$12$bDOd7lL533TeNJDEKJj6dOvr.iuzukZR2owsxjEoszMz7GWWfwrDS', NULL, 1, '2025-07-05 00:30:35', '2025-07-05 00:30:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `geolocations`
--

CREATE TABLE `geolocations` (
  `id` bigint UNSIGNED NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `geolocations`
--

INSERT INTO `geolocations` (`id`, `latitude`, `longitude`, `deskripsi`, `created_at`, `updated_at`) VALUES
(5, -8.295625, 114.307099, 'Gedung TI', '2025-07-08 06:14:48', '2025-07-08 06:14:48'),
(6, -8.294457, 114.307432, 'Perpustakaan', '2025-07-08 06:14:48', '2025-07-08 06:14:48'),
(7, -8.294563, 114.306584, 'Gedung A', '2025-07-08 06:14:48', '2025-07-08 06:14:48'),
(8, -8.293746, 114.307088, 'Musholla', '2025-07-08 06:14:48', '2025-07-08 06:14:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_anggota_perpustakaan_digital`
--

CREATE TABLE `kartu_anggota_perpustakaan_digital` (
  `id` bigint UNSIGNED NOT NULL,
  `anggota_id` bigint UNSIGNED NOT NULL,
  `nim` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kartu_anggota_perpustakaan_digital`
--

INSERT INTO `kartu_anggota_perpustakaan_digital` (`id`, `anggota_id`, `nim`, `masa_berlaku`, `created_at`, `updated_at`) VALUES
(1, 1, 'A123456', '2028-07-05', NULL, NULL),
(2, 2, 'B654321', '2027-07-05', NULL, NULL),
(3, 3, 'C789012', '2029-07-05', NULL, NULL),
(4, 4, 'D345678', '2030-07-05', NULL, NULL),
(5, 5, 'E987654', '2028-07-05', NULL, NULL),
(6, 6, '362055401121', '2029-07-05', '2025-07-05 00:34:16', '2025-07-05 00:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_kunjungan`
--

CREATE TABLE `kategori_kunjungan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_kunjungan`
--

INSERT INTO `kategori_kunjungan` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Baca Buku', NULL, NULL),
(2, 'Pinjam Buku', NULL, NULL),
(3, 'Diskusi', NULL, NULL),
(4, 'Mengerjakan Tugas', NULL, NULL),
(5, 'Lainnya', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungans`
--

CREATE TABLE `kunjungans` (
  `id` bigint UNSIGNED NOT NULL,
  `kartu_anggota_id` bigint UNSIGNED NOT NULL,
  `kategori_kunjungan_id` bigint UNSIGNED DEFAULT NULL,
  `waktu_kunjungan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kunjungans`
--

INSERT INTO `kunjungans` (`id`, `kartu_anggota_id`, `kategori_kunjungan_id`, `waktu_kunjungan`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-07-05 00:41:21', -6.20000000, 106.80000000, '2025-07-05 00:41:21', '2025-07-05 00:41:21'),
(2, 2, 4, '2025-07-04 00:41:21', -6.19000000, 106.81000000, '2025-07-05 00:41:21', '2025-07-05 00:41:21'),
(3, 3, 1, '2025-07-03 00:41:21', -6.18000000, 106.82000000, '2025-07-05 00:41:21', '2025-07-05 00:41:21'),
(4, 4, 4, '2025-07-02 00:41:21', -6.17000000, 106.83000000, '2025-07-05 00:41:21', '2025-07-05 00:41:21'),
(5, 5, 1, '2025-07-01 00:41:21', -6.16000000, 106.84000000, '2025-07-05 00:41:21', '2025-07-05 00:41:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kunjungan`
--

CREATE TABLE `laporan_kunjungan` (
  `id` bigint UNSIGNED NOT NULL,
  `kunjungan_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT '2025-07-05 07:14:31',
  `online_offline` enum('Online','Offline') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_keanggotaan` enum('Mahasiswa','Dosen','Umum') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_kunjungan`
--

INSERT INTO `laporan_kunjungan` (`id`, `kunjungan_id`, `tanggal`, `online_offline`, `jenis_keanggotaan`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-07-05 07:41:47', 'Offline', 'Mahasiswa', NULL, NULL),
(2, 2, '2025-07-03 07:41:47', 'Online', 'Dosen', NULL, NULL),
(3, 3, '2025-06-30 07:41:47', 'Offline', 'Umum', NULL, NULL),
(4, 4, '2025-06-28 07:41:47', 'Online', 'Mahasiswa', NULL, NULL),
(5, 5, '2025-06-05 07:41:47', 'Offline', 'Dosen', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `library_cards`
--

CREATE TABLE `library_cards` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rfid_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `library_cards`
--

INSERT INTO `library_cards` (`id`, `user_id`, `barcode`, `rfid_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'BC-000001', 'RFID-AEN1SYH7', 'aktif', '2025-07-05 00:17:07', '2025-07-05 00:28:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_01_040205_create_library_cards_table', 1),
(6, '2025_03_07_094350_create_program_studi_table', 1),
(7, '2025_03_07_101208_create_kategori_kunjungan_table', 1),
(8, '2025_03_07_191553_create_laporan_kunjungan_table', 1),
(9, '2025_03_07_192340_create_anggota_table', 1),
(10, '2025_03_07_192608_create_kartu_anggota_perpustakaan_digital_table', 1),
(11, '2025_03_07_193430_create_users_detail_table', 1),
(12, '2025_06_08_204100_create_kunjungans_table', 1),
(13, '2025_07_03_122821_create_geolocations_table', 1),
(14, '2025_07_05_064059_update_kunjungans_replace_user_id', 1),
(15, '2025_07_05_070348_add_kunjungan_id_to_laporan_kunjungan_table', 1),
(16, '2025_07_05_141245_remove_tujuan_from_kunjungans_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_studi`
--

CREATE TABLE `program_studi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_prodi` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_prodi` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_studi`
--

INSERT INTO `program_studi` (`id`, `nama_prodi`, `kode_prodi`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 'TI', NULL, NULL),
(2, 'Sistem Informasi', 'SI', NULL, NULL),
(3, 'Manajemen', 'MN', NULL, NULL),
(4, 'Akuntansi', 'AK', NULL, NULL),
(5, 'Teknik Elektro', 'TE', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('mahasiswa','dosen','pegawai','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Perpus', 'admin@perpus.com', '$2y$12$mrzT07HiMksX4O1YLhtcyugvP9WLab4jLA73yitfq3cq2nnYDFPIa', 'admin', '2025-07-05 00:17:07', '2025-07-05 00:17:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_detail`
--

CREATE TABLE `users_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `laporan_kunjungan_id` bigint UNSIGNED DEFAULT NULL,
  `kategori_kunjungan_id` bigint UNSIGNED DEFAULT NULL,
  `program_studi_id` bigint UNSIGNED DEFAULT NULL,
  `kartu_anggota_digital_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_surel_unique` (`surel`),
  ADD UNIQUE KEY `anggota_nomor_identitas_unique` (`nomor_identitas`),
  ADD KEY `anggota_program_studi_id_foreign` (`program_studi_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `geolocations`
--
ALTER TABLE `geolocations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kartu_anggota_perpustakaan_digital`
--
ALTER TABLE `kartu_anggota_perpustakaan_digital`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartu_anggota_perpustakaan_digital_anggota_id_unique` (`anggota_id`),
  ADD UNIQUE KEY `kartu_anggota_perpustakaan_digital_nim_unique` (`nim`);

--
-- Indeks untuk tabel `kategori_kunjungan`
--
ALTER TABLE `kategori_kunjungan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungans`
--
ALTER TABLE `kunjungans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kunjungans_kategori_kunjungan_id_foreign` (`kategori_kunjungan_id`),
  ADD KEY `kunjungans_kartu_anggota_id_foreign` (`kartu_anggota_id`);

--
-- Indeks untuk tabel `laporan_kunjungan`
--
ALTER TABLE `laporan_kunjungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kunjungan_kunjungan_id_foreign` (`kunjungan_id`);

--
-- Indeks untuk tabel `library_cards`
--
ALTER TABLE `library_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `library_cards_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `library_cards_rfid_code_unique` (`rfid_code`);

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
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_detail_user_id_foreign` (`user_id`),
  ADD KEY `users_detail_laporan_kunjungan_id_foreign` (`laporan_kunjungan_id`),
  ADD KEY `users_detail_kategori_kunjungan_id_foreign` (`kategori_kunjungan_id`),
  ADD KEY `users_detail_program_studi_id_foreign` (`program_studi_id`),
  ADD KEY `users_detail_kartu_anggota_digital_id_foreign` (`kartu_anggota_digital_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `geolocations`
--
ALTER TABLE `geolocations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kartu_anggota_perpustakaan_digital`
--
ALTER TABLE `kartu_anggota_perpustakaan_digital`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori_kunjungan`
--
ALTER TABLE `kategori_kunjungan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kunjungans`
--
ALTER TABLE `kunjungans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `laporan_kunjungan`
--
ALTER TABLE `laporan_kunjungan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `library_cards`
--
ALTER TABLE `library_cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studi` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `kartu_anggota_perpustakaan_digital`
--
ALTER TABLE `kartu_anggota_perpustakaan_digital`
  ADD CONSTRAINT `kartu_anggota_perpustakaan_digital_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kunjungans`
--
ALTER TABLE `kunjungans`
  ADD CONSTRAINT `kunjungans_kartu_anggota_id_foreign` FOREIGN KEY (`kartu_anggota_id`) REFERENCES `kartu_anggota_perpustakaan_digital` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kunjungans_kategori_kunjungan_id_foreign` FOREIGN KEY (`kategori_kunjungan_id`) REFERENCES `kategori_kunjungan` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `laporan_kunjungan`
--
ALTER TABLE `laporan_kunjungan`
  ADD CONSTRAINT `laporan_kunjungan_kunjungan_id_foreign` FOREIGN KEY (`kunjungan_id`) REFERENCES `kunjungans` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `users_detail`
--
ALTER TABLE `users_detail`
  ADD CONSTRAINT `users_detail_kartu_anggota_digital_id_foreign` FOREIGN KEY (`kartu_anggota_digital_id`) REFERENCES `kartu_anggota_perpustakaan_digital` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_detail_kategori_kunjungan_id_foreign` FOREIGN KEY (`kategori_kunjungan_id`) REFERENCES `kategori_kunjungan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_detail_laporan_kunjungan_id_foreign` FOREIGN KEY (`laporan_kunjungan_id`) REFERENCES `laporan_kunjungan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_detail_program_studi_id_foreign` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studi` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_detail_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
