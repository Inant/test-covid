-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2021 pada 06.24
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_covid_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemeriksaan`
--

CREATE TABLE `detail_pemeriksaan` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_pemeriksaan` int(10) UNSIGNED NOT NULL,
  `tipe_pemeriksaan` tinyint(3) UNSIGNED NOT NULL,
  `hasil` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pemeriksaan`
--

INSERT INTO `detail_pemeriksaan` (`id_detail`, `id_pemeriksaan`, `tipe_pemeriksaan`, `hasil`) VALUES
(1, 1, 1, 'NON REAKTIF'),
(2, 1, 2, 'NON REAKTIF'),
(3, 1, 3, 'NON REAKTIF'),
(4, 1, 4, 'NON REAKTIF'),
(5, 2, 1, 'NON REAKTIF'),
(6, 2, 2, 'NON REAKTIF'),
(7, 2, 3, 'NON REAKTIF'),
(8, 2, 4, 'NON REAKTIF'),
(9, 3, 1, 'NON REAKTIF'),
(10, 3, 2, 'NON REAKTIF'),
(11, 3, 3, 'NON REAKTIF'),
(12, 3, 4, 'NON REAKTIF'),
(13, 4, 1, 'NON REAKTIF'),
(14, 4, 2, 'NON REAKTIF'),
(15, 4, 3, 'NON REAKTIF'),
(16, 4, 4, 'NON REAKTIF'),
(17, 5, 1, 'NON REAKTIF'),
(18, 5, 2, 'NON REAKTIF'),
(19, 5, 3, 'NON REAKTIF'),
(20, 5, 4, 'NON REAKTIF'),
(21, 6, 2, 'NON REAKTIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` tinyint(3) UNSIGNED NOT NULL,
  `nama_dokter` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`) VALUES
(1, 'dr. Louis'),
(2, 'isaias.bayer'),
(3, 'nelda.hilpert'),
(4, 'jmcclure'),
(5, 'keebler.lemuel'),
(6, 'dixie.haag');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_17_182358_create_pemeriksaans_table', 2),
(5, '2021_07_17_182424_create_pasiens_table', 2),
(6, '2021_07_17_182811_create_tipe_tests_table', 2),
(7, '2021_07_17_195940_create_detail_pemeriksaans_table', 2),
(8, '2021_07_17_201455_relationship_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(10) UNSIGNED NOT NULL,
  `nama_pasien` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` tinyint(4) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `umur`, `alamat`) VALUES
(1, 'clabadie', 27, '610 Wehner Canyon'),
(2, 'ephraim38', 24, '708 Esmeralda Bypass'),
(3, 'orrin.okon', 26, '64899 Stark Flats Suite 231'),
(4, 'eloise01', 27, '730 Wiza Field Suite 015'),
(5, 'nasir82', 27, '57500 Bernhard Place'),
(6, 'norma53', 27, '59548 Jaclyn Track Apt. 078'),
(7, 'qkling', 27, '4331 Alfonzo Pike Suite 291'),
(8, 'gorczany.willa', 23, '71384 Amelia Extensions'),
(9, 'cveum', 27, '681 Lilian Circles Suite 175'),
(10, 'tsauer', 28, '8961 Lisa Highway'),
(11, 'pfannerstill.reuben', 30, '511 Huels Pike'),
(12, 'lessie.lueilwitz', 29, '50725 Kub Hill Suite 155'),
(13, 'marion.lemke', 30, '50164 Stehr Dam'),
(14, 'mzieme', 26, '24585 Skyla Passage'),
(15, 'fgaylord', 23, '88583 Feeney Tunnel Apt. 781'),
(16, 'trystan65', 24, '89043 Lavonne Trail Suite 577'),
(17, 'gbarrows', 22, '959 Roger Courts'),
(18, 'herzog.aidan', 25, '191 Collier Turnpike Apt. 640'),
(19, 'marc19', 26, '8642 Bogisich Plains Apt. 418'),
(20, 'sister24', 21, '96227 Skiles Row Suite 736'),
(21, 'Dani', 22, 'Bangsal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id_pemeriksaan` int(10) UNSIGNED NOT NULL,
  `no_reg` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengirim` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pasien` int(10) UNSIGNED NOT NULL,
  `id_dokter` tinyint(3) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pemeriksaan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id_pemeriksaan`, `no_reg`, `pengirim`, `id_pasien`, `id_dokter`, `keterangan`, `tgl_pemeriksaan`) VALUES
(1, 'nomer registrasi 0', 'iyek', 9, 1, 'tidak ada keterangan untuk sementara', '2021-07-20 12:25:28'),
(2, 'nomer registrasi 1', 'iyek', 6, 2, 'tidak ada keterangan untuk sementara', '2021-07-20 12:25:28'),
(3, 'nomer registrasi 2', 'iyek', 6, 1, 'tidak ada keterangan untuk sementara', '2021-07-20 12:25:28'),
(4, 'nomer registrasi 3', 'iyek', 7, 4, 'tidak ada keterangan untuk sementara', '2021-07-20 12:25:28'),
(5, 'nomer registrasi 4', 'iyek', 8, 1, 'tidak ada keterangan untuk sementara', '2021-07-20 12:25:28'),
(6, '111', 'Rsa', 21, 1, 'Masih Default', '2021-07-20 12:26:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_test`
--

CREATE TABLE `tipe_test` (
  `id_tipe` tinyint(3) UNSIGNED NOT NULL,
  `tipe` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_normal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tipe_test`
--

INSERT INTO `tipe_test` (`id_tipe`, `tipe`, `nilai_normal`) VALUES
(1, 'IMUNOSEROLOGI', 'NON REAKTIF'),
(2, 'RAPID TEST COVID - 19', 'NON REAKTIF'),
(3, 'igG COVID - 19', 'NON REAKTIF'),
(4, 'igM COVID - 19', 'NON REAKTIF'),
(5, 'PCR', 'NON REAKTIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','operator') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'admin@mail.com', NULL, '$2y$10$BXf0HypbSRihp0ZIsx4b.Or8aWuPKcXVsBhey/DnQzsnXP3Z7hKDm', 'admin', NULL, '2021-07-17 09:26:33', '2021-07-17 09:26:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pemeriksaan`
--
ALTER TABLE `detail_pemeriksaan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id_pemeriksaan`);

--
-- Indeks untuk tabel `tipe_test`
--
ALTER TABLE `tipe_test`
  ADD PRIMARY KEY (`id_tipe`);

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
-- AUTO_INCREMENT untuk tabel `detail_pemeriksaan`
--
ALTER TABLE `detail_pemeriksaan`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id_pemeriksaan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tipe_test`
--
ALTER TABLE `tipe_test`
  MODIFY `id_tipe` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
