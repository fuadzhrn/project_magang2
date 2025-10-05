-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Sep 2025 pada 00.35
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln_intership`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `balasan_surat`
--

CREATE TABLE `balasan_surat` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `asal_instansi` varchar(100) DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `balasan_surat`
--

INSERT INTO `balasan_surat` (`id`, `nomor_surat`, `nama_pengirim`, `asal_instansi`, `file_pdf`, `created_at`) VALUES
(8, '25/05/8', 'MUH FUAD ZAHRAN', 'UNIVERSITAS NEGERI MAKASSAR', '1751699993_Modul_2_STK_-_Week__3_-_Pengantar_Bahasa_Python__Library_.pdf', '2025-07-05 07:19:53'),
(9, '424123523532', 'HANUM', 'UNIVERSITAS NEGERI MAKASSAR', '1751822737_data_mahasiswa.pdf', '2025-07-06 17:25:37'),
(10, '5352352424', 'AYU', 'UNIVERSITAS NEGERI MAKASSAR', '1751822755_data_mahasiswa.pdf', '2025-07-06 17:25:55'),
(11, '42544364562352523', 'NAYAKO', 'UNIVERSITAS NEGERI MAKASSAR', '1751822767_data_mahasiswa.pdf', '2025-07-06 17:26:07'),
(12, '23553424342', 'NAYAKO', 'UNIVERSITAS NEGERI MAKASSAR', '1751822784_data_mahasiswa.pdf', '2025-07-06 17:26:24'),
(25, '5532525324', 'ADAM', 'UNIVERSITAS NEGERI MAKASSAR', '1752513150_data_mahasiswa.pdf', '2025-07-14 17:12:30'),
(30, '5532525324', 'MUH FUAD ZAHRAN', 'UNIVERSITAS NEGERI MAKASSAR', '1752513581_data_mahasiswa.pdf', '2025-07-14 17:19:41'),
(31, '25/05/8', 'HANUM', 'UNIVERSITAS HASANUDDIN', '1753239634_data_mahasiswa.pdf', '2025-07-23 03:00:34'),
(32, '424123523532', 'SYAHRATUL MUTHI\'AH M. MASIMING', 'UNIVERSITAS NEGERI MAKASSAR', '1753934493_CV_Muh__Fuad_Zahran_F__2_.pdf', '2025-07-31 04:01:33'),
(33, '5532525324', 'SYAHRA.,;\\\"TUL MUTHI\\\'AH M. MASIMING', 'UNIVERSITAS HASANUDDIN', '1753934813_CV_Muh__Fuad_Zahran_F__2_.pdf', '2025-07-31 04:06:53'),
(34, '424123523532', 'SYAHRA.\\\'TUL MUTHI\\\\\\\'AH M. MASIMING', 'UNIVERSITAS HASANUDDIN', '1753935362_CV_Muh__Fuad_Zahran_F__2_.pdf', '2025-07-31 04:16:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_sertifikat`
--

CREATE TABLE `data_sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `asal_instansi` varchar(150) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `file_sertifikat` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_sertifikat`
--

INSERT INTO `data_sertifikat` (`id_sertifikat`, `nama_lengkap`, `asal_instansi`, `id_bidang`, `file_sertifikat`, `tanggal_dibuat`) VALUES
(10, 'MUH FUAD ZAHRAN', 'UNIVERSITAS NEGERI MAKASSAR', 29, '1752513737_data_mahasiswa.pdf', '2025-07-14 17:22:17'),
(11, 'ANJAY', 'UNIVERSITAS SAA', 38, '1753239865_data_mahasiswa.pdf', '2025-07-23 03:04:25'),
(12, 'SYAHRA.,;\"TUL MUTHI\'AH M. MASIMING', 'UNIVERSITAS HASANUDDIN', 33, '1753935308_CV_Muh__Fuad_Zahran_F__2_.pdf', '2025-07-31 04:15:08'),
(13, 'SYAHRA\'TUL MUTHI\'AH M. MASIMING', 'UNIVERSITAS NEGERI MAKASSAR', 30, '1753935449_CV_Muh__Fuad_Zahran_F__2_.pdf', '2025-07-31 04:17:29'),
(14, 'SYAHRA\'TUL MUTHI\'AH M. MASIMING', 'UNIVERSITAS BOSOWA', 35, '1753935476_CV_Muh__Fuad_Zahran_F__3_.pdf', '2025-07-31 04:17:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp_hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_magang`
--

CREATE TABLE `peserta_magang` (
  `id_mahasiswa` int(100) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `asal_instansi` varchar(50) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peserta_magang`
--

INSERT INTO `peserta_magang` (`id_mahasiswa`, `nama_mahasiswa`, `asal_instansi`, `id_bidang`, `tgl_masuk`, `tgl_keluar`, `status`) VALUES
(36, 'Muh Fuad Zarhan F', 'Universitas Negeri Makassar', 30, '2025-07-14', '2025-07-14', 'Selesai'),
(37, 'bambangg', 'Universitas Hasanuddin', 36, '2025-07-15', '2025-07-25', 'Selesai'),
(38, 'Muh Fuad Zarhan F', 'Universitas Negeri Makassar', 34, '2025-07-09', '2025-07-30', 'Selesai'),
(39, 'bambang', 'Universitas Islam Negeri', 33, '2025-07-15', '2025-07-25', 'Selesai'),
(41, 'addek', 'Unismu', 35, '2025-07-15', '2025-08-28', 'Selesai'),
(47, 'addek', 'Universitas Negeri Makassar', 37, '2025-07-16', '2025-07-16', 'Selesai'),
(50, 'Muh Fuad Zarhan F', 'Universitas Negeri Makassar', 41, '2025-07-16', '2025-07-16', 'Selesai'),
(51, 'bambangg', 'Universitas Negeri Makassar', 41, '2025-07-16', '2025-07-17', 'Selesai'),
(52, 'addek', 'Universitas Negeri Makassar', 40, '2025-07-17', '2025-07-24', 'Selesai'),
(53, 'Muh Fuad Zarhan F', 'universitas saa', 36, '2025-07-17', '2025-07-24', 'Selesai'),
(54, 'dasdada', 'universitas saa', 38, '2025-07-17', '2025-07-24', 'Selesai'),
(55, 'dasdada', 'universitas saa', 30, '2025-07-17', '2025-07-24', 'Selesai'),
(56, 'nayako', 'Universitas Negeri Makassarrr', 33, '2025-07-23', '2025-07-31', 'Selesai'),
(57, 'Muh Fuad Zarhan F', 'Universitas Hasanuddin', 39, '2025-07-23', '2025-07-24', 'Selesai'),
(58, 'bjirr', 'qwwqrq', 38, '2025-07-28', '2025-08-23', 'Selesai'),
(59, 'halodok', 'Universitas Hasanuddin', 41, '2025-07-24', '2025-07-29', 'Selesai'),
(60, 'baim', 'Universitas Negeri Makassar', 40, '2025-07-24', '2025-07-29', 'Selesai'),
(61, 'Muh Fuad Zarhan F', 'universitas saa', 30, '2025-07-26', '2025-07-28', 'Selesai'),
(62, 'SYAHRA.,;\\\"TUL MUTHI\\\'AH M. MASIMING', 'Universitas Hasanuddin', 34, '2025-07-31', '2025-08-21', 'Selesai'),
(63, 'addek', 'Universitas Negeri Makassar', 36, '2025-07-31', '2025-08-21', 'Selesai'),
(64, 'Muh Fuad Zarhan Frrff', 'Universitas Negeri Makassar', 41, '2025-07-31', '2025-08-21', 'Selesai'),
(65, 'asdsadfaqwfa', 'Universitas Hasanuddin', 41, '2025-07-31', '2025-08-20', 'Selesai'),
(66, 'ewtertregyr', 'Universitas Bosowa', 41, '2025-07-31', '2025-08-18', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_bidang`
--

CREATE TABLE `sub_bidang` (
  `id_bidang` int(100) NOT NULL,
  `nama_bidang` varchar(50) NOT NULL,
  `kouta` int(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_bidang`
--

INSERT INTO `sub_bidang` (`id_bidang`, `nama_bidang`, `kouta`, `deskripsi`) VALUES
(29, 'K3', 2, '.'),
(30, 'Niaga', 3, '.'),
(33, 'Perencanaan', 2, '.'),
(34, 'Keuangan&Akutansi', 3, '.'),
(35, 'Komunikasi', 4, '.'),
(36, 'Umum', 6, '.'),
(37, 'Distribusi&Up2k', 3, '.'),
(38, 'Pengadaan', 3, '.'),
(39, 'HC', 2, '.'),
(40, 'HTD', 1, '.'),
(41, 'STI', 2, '.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$BrZluMkdWH8AgDoHVFoHLuG68qSyae8ik7qhWTeWAmfe6WqunU5aC'),
(9, 'fuad', '$2y$10$Sw5QuQZY0.QTewxUwjUdz.GpH0oAWF2TEf/eHatINbkkRsKNhukye');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `ulasan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id`, `nama`, `instansi`, `rating`, `ulasan`, `tanggal`) VALUES
(7, 'Samuel Turner', 'CTO', 4.9, '          Their customer service is fantastic. Prompt responses and excellent support every time!\r\n', '2025-07-06 00:01:10'),
(8, 'James Miller', 'Sales Manager', 0.0, '          With Pagedone, I\'ve gained so much visibility into my team\'s productivity and workflows. Highly recommended.\r\n', '2025-07-06 00:01:10'),
(9, 'Sarah Allen', 'UX Researcher', 5.0, '          I love how simple everything is. We integrated it in days, and the learning curve was nearly zero.\r\n', '2025-07-06 00:02:44'),
(10, 'Tom Parker', 'Operations Director', 0.0, '          Great tool for small businesses. We\'ve cut hours from our weekly reporting thanks to this.\r\n', '2025-07-06 00:02:44'),
(11, 'Sarah Allen', 'UX Researcher', 5.0, '          I love how simple everything is. We integrated it in days, and the learning curve was nearly zero.\r\n', '2025-07-06 00:02:48'),
(12, 'Tom Parker', 'Operations Director', 0.0, '          Great tool for small businesses. We\'ve cut hours from our weekly reporting thanks to this.\r\n', '2025-07-06 00:02:48'),
(15, 'Ayu Permata', 'Universitas Hasanuddin', 4.8, 'Magangnya menyenangkan dan penuh pembelajaran.', '2025-07-06 00:38:19'),
(16, 'Budi Santoso', 'Politeknik Negeri Ujung Pandang', 5.0, 'Saya belajar banyak hal baru selama magang.', '2025-07-06 00:38:19'),
(17, 'Citra Dewi', 'Universitas Negeri Makassar', 4.7, 'Lingkungan kerja sangat mendukung.', '2025-07-06 00:38:19'),
(18, 'Dimas Hidayat', 'Institut Teknologi PLN', 4.5, 'Saya terlibat langsung dalam proyek PLN.', '2025-07-06 00:38:19'),
(19, 'Nayako', 'Universitas Negeri Makassar', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-06 16:12:43'),
(20, 'Noharman Takbi', 'Universitas islam', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:15:04'),
(21, 'fuad', 'Universitas Negeri Makassar', 4.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:15:27'),
(22, 'fuad', 'Universitas Negeri Makassar', 4.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:15:45'),
(23, 'Noharman Takbi', 'Universitas Negeri Makassar', 3.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:16:32'),
(24, 'Noharman Takbi', 'Universitas Negeri Makassar', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:16:43'),
(25, 'Noharman Takbi', 'Universitas Negeri Makassar', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:17:00'),
(26, 'Nayako', 'Universitas Negeri Makassar', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:18:02'),
(27, 'Nayako', 'Universitas Negeri Makassar', 5.0, 'wah keren bangett magang di pln kakak2nya baik semua betah pokoknya semoga nextnya masi bisa magang di sana pesan buat mentor2nya sehat-sehat yaa dan rejekinya tambah banyak lovvv pokoknyaa', '2025-07-10 18:18:37'),
(28, 'fuad', 'Universitas Negeri Makassar', 5.0, 'hallno p', '2025-07-14 02:32:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `balasan_surat`
--
ALTER TABLE `balasan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_sertifikat`
--
ALTER TABLE `data_sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `peserta_magang`
--
ALTER TABLE `peserta_magang`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `sub_bidang`
--
ALTER TABLE `sub_bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `balasan_surat`
--
ALTER TABLE `balasan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `data_sertifikat`
--
ALTER TABLE `data_sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `id_mahasiswa` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `sub_bidang`
--
ALTER TABLE `sub_bidang`
  MODIFY `id_bidang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_sertifikat`
--
ALTER TABLE `data_sertifikat`
  ADD CONSTRAINT `data_sertifikat_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `sub_bidang` (`id_bidang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
