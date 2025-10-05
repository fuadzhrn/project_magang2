-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 05 Okt 2025 pada 01.10
-- Versi server: 11.8.3-MariaDB-log
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u848382502_pln_intership`
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
(33, '3043/STH.01.04/F16000000/2025', 'ADELIA', 'STIE MAKASSAR MAJU', '1753251879_3043_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:24:39'),
(34, '3043/STH.01.04/F16000000/2025', 'MARZAH', 'STIE MAKASSAR MAJU', '1753251899_3043_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:24:59'),
(35, '3042/STH.01.04/F16000000/2025', 'DILLA SAFIRA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753251981_3042_PERSETUJUAN_KULIAH_KERJA_PROFESI__Dilla_Safira_.pdf', '2025-07-23 06:26:21'),
(36, '1101/STH.01.04/F16000000/2025', 'PHILIPE MORI DONSO', 'SMK NEGERI 3 MAKASSAR', '1753252227_1101_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:30:27'),
(37, '1101/STH.01.04/F16000000/2025', 'M. AYMAR', 'SMK NEGERI 3 MAKASSAR', '1753252265_1101_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:31:05'),
(38, '1101/STH.01.04/F16000000/2025', 'ANDHIKA RIZKYATULLA', 'SMK NEGERI 3 MAKASSAR', '1753252290_1101_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:31:30'),
(39, '3040/STH.01.04/F16000000/2025', 'AQIDAH ISLAMIAH', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753252692_3040_STH_01_04_F16000000_2025.pdf', '2025-07-23 06:38:12'),
(40, '2276/STH.01.04/F16000000/2025', 'ATHIRAH MUTHIAH MARZUQAH', 'UNIVERSITAS TELKOM', '1753255150_2276_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:19:10'),
(41, '3272/STH.01.04/F16000000/2025', 'ANDI SATRIA RAFATARIQ AMAL KURNIA PUTRA', 'TELKOM UNIVERSITY', '1753255342_3272_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:22:22'),
(42, '3069/STH.01.04/F16000000/2025', 'JESSICA HABEL', 'UNIVERSITAS BOSOWA', '1753255608_3069_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:26:48'),
(43, '3766/STH.01.04/F16000000/2025', 'NAJWA RAMADHANI SYAM', 'UNIVERSITAS HASANUDDIN', '1753255685_3766_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:28:05'),
(44, '3766/STH.01.04/F16000000/2025', 'ANDI NURQALBI', 'UNIVERSITAS HASANUDDIN', '1753255705_3766_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:28:25'),
(45, '3766/STH.01.04/F16000000/2025', 'KHALISHAH DHAFIYAH JAYADI', 'UNIVERSITAS HASANUDDIN', '1753255727_3766_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:28:47'),
(46, '3766/STH.01.04/F16000000/2025', 'MUH. MUHAJIRIN MURSYID', 'UNIVERSITAS HASANUDDIN', '1753255751_3766_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:29:11'),
(47, '3765/STH.01.04/F16000000/2025', 'PATTA NUR YUYUNG', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753256338_3765_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:38:58'),
(48, '3765/STH.01.04/F16000000/2025', 'MUH. ALIM RAMADHAN', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753256370_3765_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:39:30'),
(49, '3493/STH.01.04/F16000000/2025', 'M. ALBY RIZADY', 'UNIVERSITAS NEGERI MAKASSAR', '1753256700_3493_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:45:00'),
(50, '3455/STH.01.04/F16000000/2025', 'ALISYA SULIFIANTI BAHASOAN', 'INSTITUT TEKNOLOGI PLN', '1753256844_3455_STH_01_04_F16000000_2025__1_.pdf', '2025-07-23 07:47:24'),
(51, '3190/STH.01.04/F16000000/2025', 'LUCIANA ALRIANI TODING', 'STIE CIPUTRA', '1753257108_3190_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:51:48'),
(52, '3191/STH.01.04/F16000000/2025', 'NAJWA PUTRI LARASATI', 'UNIVERSITAS NEGERI MAKASSAR', '1753257248_3191_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:54:08'),
(53, '3191/STH.01.04/F16000000/2025', 'SHARFINA GHAISANI', 'UNIVERSITAS NEGERI MAKASSAR', '1753257273_3191_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:54:33'),
(54, '3191/STH.01.04/F16000000/2025', 'HANI KHAIRANI SURAHMAN', 'UNIVERSITAS NEGERI MAKASSAR', '1753257309_3191_STH_01_04_F16000000_2025.pdf', '2025-07-23 07:55:09'),
(55, '3038/STH.01.04/F16000000/2025', 'SASKYA ANANDA', 'UNIVERSITAS BOSOWA', '1753283182_3038_PERSETUJUAN_MAGANG_Saskya_Ananda_Dkk.pdf', '2025-07-23 15:06:22'),
(56, '3038/STH.01.04/F16000000/2025', 'KOMANG TRYA ARTIWI', 'UNIVERSITAS BOSOWA', '1753283206_3038_PERSETUJUAN_MAGANG_Saskya_Ananda_Dkk.pdf', '2025-07-23 15:06:46'),
(57, '3038/STH.01.04/F16000000/2025', 'WULAN SUCI ASYAHRA', 'UNIVERSITAS BOSOWA', '1753283225_3038_PERSETUJUAN_MAGANG_Saskya_Ananda_Dkk.pdf', '2025-07-23 15:07:05'),
(58, '3038/STH.01.04/F16000000/2025', 'DESTY ZAKARIA', 'UNIVERSITAS BOSOWA', '1753283242_3038_PERSETUJUAN_MAGANG_Saskya_Ananda_Dkk.pdf', '2025-07-23 15:07:22'),
(59, '2773/STH.01.04/F16000000/2025', 'MAYLHA ERISA PASYHA', 'POLITEKNIK NEGERI UJUNG PANDANG', '1753284040_Surat_No__2773_2025.pdf', '2025-07-23 15:20:40'),
(60, '2773/STH.01.04/F16000000/2025', 'ULFIAH', 'POLITEKNIK NEGERI UJUNG PANDANG', '1753284056_Surat_No__2773_2025.pdf', '2025-07-23 15:20:56'),
(61, '3834/STH.01.04/F16000000/2025', 'ALYA SUJRA WARDHANA ILHAM', 'UNIVERSITAS HASANUDDIN', '1753285092_3834_STH_01_04_F16000000_2025.pdf', '2025-07-23 15:38:12'),
(62, '3834/STH.01.04/F16000000/2025', 'PUTRI ALIYAH RAMLI', 'UNIVERSITAS HASANUDDIN', '1753285113_3834_STH_01_04_F16000000_2025.pdf', '2025-07-23 15:38:33'),
(63, '3834/STH.01.04/F16000000/2025', 'WIWIK DIAN ANDANA', 'UNIVERSITAS HASANUDDIN', '1753285144_3834_STH_01_04_F16000000_2025.pdf', '2025-07-23 15:39:04'),
(64, '3834/STH.01.04/F16000000/2025', 'PATRICIA CHARISTABEL PADUDUNG', 'UNIVERSITAS HASANUDDIN', '1753285171_3834_STH_01_04_F16000000_2025.pdf', '2025-07-23 15:39:31'),
(65, '3790/STH.01.04/F16000000/2025', 'MUH RIFKI SAUIB', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753924936_3790_STH_01_04_F16000000_2025.pdf', '2025-07-31 01:22:16'),
(66, '3790/STH.01.04/F16000000/2025', 'AZIS AHMAD', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753924957_3790_STH_01_04_F16000000_2025.pdf', '2025-07-31 01:22:37'),
(67, '3790/STH.01.04/F16000000/2025', 'RIFKI ALFARIZI', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1753924979_3790_STH_01_04_F16000000_2025.pdf', '2025-07-31 01:22:59'),
(68, '3799/STH.01.04/F16000000/2025', 'MUH. FADEL', 'UNIVERSITAS ISLAM NEGERI ALAUDDIN MAKASSAR', '1753925080_3799_STH_01_04_F16000000_2025.pdf', '2025-07-31 01:24:40'),
(69, '3802/STH.01.04/F16000000/2025', 'ANANDA CAHYANI', 'UNIVERSITAS MUSLIM INDONESIA', '1753925685_3802_STH_01_04_F16000000_2025-1.pdf', '2025-07-31 01:34:45'),
(70, '3802/STH.01.04/F16000000/2025', 'MUH. FATCHUL SYAM', 'UNIVERSITAS MUSLIM INDONESIA', '1753925713_3802_STH_01_04_F16000000_2025-1.pdf', '2025-07-31 01:35:13'),
(71, '3802/STH.01.04/F16000000/2025', 'NENENG KUSNIAWATI', 'UNIVERSITAS MUSLIM INDONESIA', '1753925734_3802_STH_01_04_F16000000_2025-1.pdf', '2025-07-31 01:35:34'),
(72, '3802/STH.01.04/F16000000/2025', 'RAHMADANIA', 'UNIVERSITAS MUSLIM INDONESIA', '1753925759_3802_STH_01_04_F16000000_2025-1.pdf', '2025-07-31 01:35:59'),
(73, '3802/STH.01.04/F16000000/2025', 'ANDI HIKMA JEMMA', 'UNIVERSITAS MUSLIM INDONESIA', '1753925783_3802_STH_01_04_F16000000_2025-1.pdf', '2025-07-31 01:36:23'),
(81, '3801/STH.01.04/F16000000/2025', 'SYAHRATUL MUTHIAH M. MASIMING', 'UNIVERSITAS TELKOM', '1753933874_3801_STH_01_04_F16000000_2025.pdf', '2025-07-31 03:51:14'),
(83, '0615/STH.01.04/F16000000/2025', 'ALYA PUTRI LUTFDHIYAA LUKMAN', 'UNIVERSITAS HASANUDDIN', '1754025017_0615_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:10:17'),
(84, '0615/STH.01.04/F16000000/2025', 'INDAH NURUL FATIHAH SATRIADIN', 'UNIVERSITAS HASANUDDIN', '1754025040_0615_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:10:40'),
(85, '0615/STH.01.04/F16000000/2025', 'ASIRAH ANWAR', 'UNIVERSITAS HASANUDDIN', '1754025053_0615_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:10:53'),
(86, '2552/STH.01.04/F16000000/2025', 'ASMIRANDA', 'UPT SMK NEGERI 7 MAKASSAR', '1754027454_2552_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:50:54'),
(87, '2552/STH.01.04/F16000000/2025', 'KHADIJAH ANISA AKIB', 'UPT SMK NEGERI 7 MAKASSAR', '1754027477_2552_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:51:17'),
(88, '2552/STH.01.04/F16000000/2025', 'ZASKIA NABILA', 'UPT SMK NEGERI 7 MAKASSAR', '1754027492_2552_STH_01_04_F16000000_2025.pdf', '2025-08-01 05:51:32'),
(89, '2483/STH.01.04/F16000000/2025', 'ABD MALIK', 'UNIVERSITAS NEGERI MAKASSAR', '1754027633_Surat_No__2483_2025.pdf', '2025-08-01 05:53:53'),
(90, '2483/STH.01.04/F16000000/2025', 'ANDI MUHAMMAD FAHRI', 'UNIVERSITAS NEGERI MAKASSAR', '1754027650_Surat_No__2483_2025.pdf', '2025-08-01 05:54:10'),
(91, '3041/STH.01.04/F16000000/2025', 'WIDYA WARDA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1754029029_3041_STH_01_04_F16000000_2025.pdf', '2025-08-01 06:17:09'),
(92, '3802/STH.01.04/F16000000/2025', 'ANDI GITA AULYA HARTANTI', 'UNIVERSITAS MUSLIM IDONESIA', '1754029278_3802_STH_01_04_F16000000_2025.pdf', '2025-08-01 06:21:18'),
(93, '4460/STH.01.04/F16000000/2025', 'MUHAMMAD NUR AQIL SHODIQ', 'UNIVERSITAS ISLAM NEGERI ALAUDDIN', '1754286992_4460_STH_01_04_F16000000_2025.pdf', '2025-08-04 05:56:32'),
(94, '4462_STH.01.04_F16000000_2025', 'MUTMAINNA HERIANTO', 'UNIVERSITAS NEGERI MAKASSAR', '1754287448_4462_STH_01_04_F16000000_2025.pdf', '2025-08-04 06:04:08'),
(95, '4462/STH.01.04/F16000000/2025', 'AHMAD RAISUL AMAL', 'UNIVERSITAS NEGERI MAKASSAR', '1754287523_4462_STH_01_04_F16000000_2025.pdf', '2025-08-04 06:05:23'),
(96, '4462/STH.01.04/F16000000/2025', 'NUR ISMA', 'UNIVERSITAS NEGERI MAKASSAR', '1754287563_4462_STH_01_04_F16000000_2025.pdf', '2025-08-04 06:06:03'),
(97, '4464/STH.01.04/F16000000/2025', 'SITI KHADIJAH ABIDIN', 'UNIVERSITAS HASANUDDIN', '1754287714_4464_STH_01_04_F16000000_2025.pdf', '2025-08-04 06:08:34'),
(98, '4818/STH.01.04/F16000000/2025', 'ANGELINE CLAUDIA', 'UNIVERSITAS HASANUDDIN', '1755737775_ANGELINE_CLAUDIA.pdf', '2025-08-21 00:56:15'),
(99, '4819/STH.01.04/F16000000/2025', 'MUH. RIZQI', 'POLITEKNIK NEGERI UJUNG PANDANG', '1755738111_MUH_RIZQI.pdf', '2025-08-21 01:01:51'),
(100, '4819/STH.01.04/F16000000/2025', 'RIZALDI MUHAIMIN.K', 'POLITEKNIK NEGERI UJUNG PANDANG', '1755738266_RIZALDI_MUHAIMIN_K.pdf', '2025-08-21 01:04:26'),
(101, '4819/STH.01.04/F16000000/2025', 'MARWAN', 'POLITEKNIK NEGERI UJUNG PANDANG', '1755738361_MARWAN.pdf', '2025-08-21 01:06:01'),
(102, '4824/STH.01.04/F16000000/2025', 'KRISTINA PAULUS', 'UNIVERSITAS BOSOWA', '1755738473_KRISTINA_PAULUS.pdf', '2025-08-21 01:07:53'),
(103, '4825/STH.01.04/F16000000/2025', 'ANUGRAH MARIANI PIRADE`', 'UNIVERSITAS CIPUTRA', '1755738696_ANUGRAH_MARIANI_PIRADE_.pdf', '2025-08-21 01:11:36'),
(104, '4826/STH.01.04/F16000000/2025', 'SITI MARWA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1755738920_SITI_MARWA.pdf', '2025-08-21 01:15:20'),
(105, '4826/STH.01.04/F16000000/2025', 'ANDI CITRA AYU LESTARI', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1755738959_ANDI_CITRA_AYU_LESTARI.pdf', '2025-08-21 01:15:59'),
(106, '4826/STH.01.04/F16000000/2025', 'MULIANA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1755738993_MULIANA.pdf', '2025-08-21 01:16:33'),
(107, '4917/STH.01.04/F16000000/2025', 'RARA MADIKA BANNE', 'UNIVERSITAS FAJAR', '1755851385_UNIVERSITAS_FAJAR.pdf', '2025-08-22 08:29:45'),
(108, '4917/STH.01.04/F16000000/2025', 'ANGELIKA OKTAVIA POPANG RUMENGAN', 'UNIVERSITAS FAJAR', '1756351078_1755851385_UNIVERSITAS_FAJAR.pdf', '2025-08-28 03:17:58'),
(109, '5035/STH.01.04/F16000000/2025', 'DINDA NUR', 'UNIVERSITAS PATRIA ARTHA', '1756351816_5035_STH_01_04_F16000000_2025.pdf', '2025-08-28 03:30:16'),
(110, '5035/STH.01.04/F16000000/2025', 'ALEVADI ASTRIA', 'UNIVERSITAS PATRIA ARTHA', '1756351839_5035_STH_01_04_F16000000_2025.pdf', '2025-08-28 03:30:39'),
(111, '5008/STH.01.04/F16000000/2025', 'JHUN HERUL', 'UNIVERSITAS PATRIA ARTHA', '1756351917_5008_STH_01_04_F16000000_2025.pdf', '2025-08-28 03:31:57'),
(112, '4914/STH.01.04/F16000000/2025', 'ANNISA NURUL AULIYAH', 'UNIVERSITAS NEGERI MAKASSAR', '1756352088_Surat_No__4914__1_.pdf', '2025-08-28 03:34:48'),
(113, '4914/STH.01.04/F16000000/2025', 'LUTFIAH ARDAH PUTRI', 'UNIVERSITAS NEGERI MAKASSAR', '1756352113_Surat_No__4914.pdf', '2025-08-28 03:35:13'),
(114, '4915/STH.01.04/F16000000/2025', 'PARWATI', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', '1756352280_4915_STH_01_04_F16000000_2025.pdf', '2025-08-28 03:38:00'),
(115, '4916/STH.01.04/F16000000/2025', 'NUR SAIDA. AR', 'UNIVERSITAS NEGERI MAKASSAR', '1756352341_Surat_No__4916.pdf', '2025-08-28 03:39:01'),
(116, '4916/STH.01.04/F16000000/2025', 'NASYWAH DWI ALIKA. S', 'UNIVERSITAS NEGERI MAKASSAR', '1756352364_Surat_No__4916.pdf', '2025-08-28 03:39:24'),
(117, '4916/STH.01.04/F16000000/2025', 'ANASTASYA NOVILIA. R', 'UNIVERSITAS NEGERI MAKASSAR', '1756352392_Surat_No__4916.pdf', '2025-08-28 03:39:52'),
(118, '4823/STH.01.04/F16000000/2025', 'ANDINI WAHYUNI', 'UNIVERSITAS NEGERI MAKASSAR', '1756352990_Surat_No__4823.pdf', '2025-08-28 03:49:50'),
(119, '4823/STH.01.04/F16000000/2025', 'RESKI AMELIA', 'UNIVERSITAS NEGERI MAKASSAR', '1756353006_Surat_No__4823.pdf', '2025-08-28 03:50:06'),
(120, '800/099/SMK.3/BN/DP/2025', 'LUTFI ATMAJA', 'SMK NEGERI 3 BONE', '1756360756_4463.pdf', '2025-08-28 05:59:16'),
(121, '800/099/SMK.3/BN/DP/2025', 'HAFIZAH WAHYUDIN', 'SMK NEGERI 3 BONE', '1756360776_4463.pdf', '2025-08-28 05:59:36'),
(122, '800/099/SMK.3/BN/DP/2025', 'ANDIKA', 'SMK NEGERI 3 BONE', '1756360793_4463.pdf', '2025-08-28 05:59:53'),
(123, '387.3/K.7/IBKN/VIII/2025', 'YAYI AINUN AULIA', 'INSTITUT BISNIS DAN KEUANGAN NITRO', '1758594909_Yayi___Viona.pdf', '2025-09-23 02:35:09'),
(124, '387.3/K.7/IBKN/VIII/2025', 'VIONA', 'INSTITUT BISNIS DAN KEUANGAN NITRO', '1758594944_Yayi___Viona.pdf', '2025-09-23 02:35:44'),
(125, '2209/UN36.2/JTIK/VIII/2025', 'IMELDA YULISTIANTI PUTRI', 'UNIVERSITAS NEGERI MAKASSAR', '1758595027_IMELDA.pdf', '2025-09-23 02:37:07'),
(126, '1430/UN4.1.14/PK.01.06/2025', 'MUHAMMAD FIKHAR SURATMAN', 'UNIVERSITAS HASANUDDIN', '1758595116_MUHAMMMAD_FIKHAR.pdf', '2025-09-23 02:38:36'),
(127, '1430/UN4.1.14/PK.01.06/2025', 'MUHAMMAD ASNUL HUSADI', 'UNIVERSITAS HASANUDDIN', '1758595171_ASNUL___DHANI.pdf', '2025-09-23 02:39:31'),
(128, '1430/UN4.1.14/PK.01.06/2025', 'ACHMAD DHANI RIDWAN', 'UNIVERSITAS HASANUDDIN', '1758595199_ASNUL___DHANI.pdf', '2025-09-23 02:39:59'),
(129, '230D/UN36.1-4/KM/2025', 'A. NURHUMAERAH', 'UNIVERSITAS NEGERI MAKASSAR', '1758595448_A_NURHUMAERAH.pdf', '2025-09-23 02:44:08'),
(130, '352/PUSAT KARIR-UNIFA/E03/VIII/2025', 'YOSAFAT AMBA', 'UNIVERSITAS FAJAR', '1758595539_YOSAFAT.pdf', '2025-09-23 02:45:39'),
(131, '2209/UN36.2/JTIK/VIII/2025', 'MOH. ILHAM FARIQULZAMAN', 'UNIVERSITAS NEGERI MAKASSAR', '1758595600_MOH_ILHAM___ST_NURFADILLAH.pdf', '2025-09-23 02:46:40'),
(132, '2209/UN36.2/JTIK/VIII/2025', 'ST. NURFADILA IBRAH', 'UNIVERSITAS NEGERI MAKASSAR', '1758595635_MOH_ILHAM___ST_NURFADILLAH.pdf', '2025-09-23 02:47:15'),
(133, '2209/UN36.2/JTIK/VIII/2025', 'RHAFLY ANUGRAH HIMAWAN', 'UNIVERSITAS NEGERI MAKASSAR', '1758595696_RHAFLY____FARISIA.pdf', '2025-09-23 02:48:16'),
(134, '2209/UN36.2/JTIK/VIII/2025', 'FARISIA MAHARANI K', 'UNIVERSITAS NEGERI MAKASSAR', '1758595719_RHAFLY____FARISIA.pdf', '2025-09-23 02:48:39'),
(135, '1430/UN4.1.14/PK.01.06/2025', 'AGNES MARCELA ROMBE', 'UNIVERSITAS HASANUDDIN', '1758595768_AGNES.pdf', '2025-09-23 02:49:28'),
(136, '1474/UN4.1.14/PK.01.06/2025', 'ALMADHEA SUBA', 'UNIVERSITAS HASANUDDIN', '1758595838_ALMADHEA_SUBA.pdf', '2025-09-23 02:50:38'),
(137, '384.1/K.7/IBKN/VIII/2025', 'NURLINDA', 'INSTITUT BISNIS DAN KEUANGAN NITRO', '1758595901_NURLINDA___NADIA.pdf', '2025-09-23 02:51:41'),
(138, '384.1/K.7/IBKN/VIII/2025', 'NADIA LESTARI', 'INSTITUT BISNIS DAN KEUANGAN NITRO', '1758595927_NURLINDA___NADIA.pdf', '2025-09-23 02:52:07'),
(140, '2194/UN36.2/JTIK/VIII/2025', 'NUR FITRAH SARI', 'UNIVERSITAS NEGERI MAKASSAR', '1758596086_NUR_FITRAH_SHINTA_ALWIS_KHAERUL.pdf', '2025-09-23 02:54:46'),
(141, '2194/UN36.2/JTIK/VIII/2025', 'SHINTA DEWI AYU ARFIANA', 'UNIVERSITAS NEGERI MAKASSAR', '1758596115_NUR_FITRAH_SHINTA_ALWIS_KHAERUL.pdf', '2025-09-23 02:55:15'),
(142, '2194/UN36.2/JTIK/VIII/2025', 'ALWIS ANDINI SY', 'UNIVERSITAS NEGERI MAKASSAR', '1758596137_NUR_FITRAH_SHINTA_ALWIS_KHAERUL.pdf', '2025-09-23 02:55:37'),
(143, '2194/UN36.2/JTIK/VIII/2025', 'KHAERUL AMRI SYAM', 'UNIVERSITAS NEGERI MAKASSAR', '1758596165_NUR_FITRAH_SHINTA_ALWIS_KHAERUL.pdf', '2025-09-23 02:56:05');

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
(13, 'TENRI AULIA SARI', 'UIN ALAUDDIN MAKASSAR', 35, '1752646639_Ahmad_Faraby_Farid__2_.pdf', '2025-07-16 06:17:19'),
(14, 'ALFIAN MATTALITTI', 'UNIVERSITAS HASANUDDIN', 33, '1753427475_Sertifikat_an_Alfian_Mattalitti.pdf', '2025-07-25 07:11:15'),
(26, 'VASHAJADYAH AL FADILLAH AHMAD', 'UNIVERSITAS HASANUDDIN', 29, '1753842826_Vashajadyah_Al_Fadillah_Ahmad.pdf', '2025-07-30 02:33:46'),
(27, 'ALIAH RAMADHANI GOBEL', 'UNIVERSITAS HASANUDDIN', 29, '1753843119_No_0132_STH_00_01_F16000000_2025.pdf', '2025-07-30 02:38:39'),
(30, 'ANDI SATRIA RAFATARIQ AMAL KURNIA PUTRA', 'TELKOM UNIVERSITY ', 37, '1754465171_Sertifikat_Andi_Satria_Rafathatiq_.pdf', '2025-08-06 07:26:11'),
(32, 'SYAHRATUL MUTHI’AH M. MASIMING', 'TELKOM UNIVERSITY ', 37, '1755568448_Format_Sertifikat_Syahratul_Muthi___ah_M__Masiming.pdf', '2025-08-19 01:54:08'),
(34, 'YASYFA XENA ARLEYDA WAHYUDI', 'UNIVERSITAS MUSLIM INDONESIA', 37, '1755586748_1753841214_yasyfa0125.pdf', '2025-08-19 06:59:08'),
(35, 'ULFA RIFKY AWALIYAH', 'UNIVERSITAS MUSLIM INDONESIA', 37, '1755586933_1753841865_No_0128_STH_00_01_F16000000_2025.pdf', '2025-08-19 07:02:13'),
(36, 'RAHMA ALIA', 'UNIVERSITAS MUSLIM INDONESIA', 35, '1755587806_Format_Sertifikat_Rahma_Alia.pdf', '2025-08-19 07:16:46'),
(37, 'RADHIYATUL MARDHIYAH', 'UNIVERSITAS MUSLIM INDONESIA', 35, '1755588218_Format_Sertifikat_Radhiyatul_Mardhiyah.pdf', '2025-08-19 07:23:38'),
(38, 'ZANIRA PUTRI WARDHANI', 'UNIVERSITAS MUSLIM INDONESIA', 37, '1755588332_1755566727_Format_Sertifikat_Zanira_Putri_Wardhani.pdf', '2025-08-19 07:25:32'),
(39, 'PUTRI MAHARANI.S', 'UNIVERSITAS MUSLIM INDONESIA', 37, '1755588411_1753840592_No_0127_STH_00_01_F16000000_2025.pdf', '2025-08-19 07:26:51'),
(40, 'NAJWA PUTRI LARASATI', 'UNIVERSITAS HASANUDDIN', 31, '1755588913_Format_Sertifikat_Najwa_Putri_Larasati.pdf', '2025-08-19 07:35:13'),
(41, 'SHARFINA GHAISANI', 'UNIVERSITAS HASANUDDIN', 31, '1755589031_Format_Sertifikat_Sharfina_Ghaisani.pdf', '2025-08-19 07:37:11'),
(42, 'ANGELIN CLAUDIA RANTE KADA', 'UNIVERSITAS HASANUDDIN', 35, '1755591502_Format_Sertifika_angelin_claudia.pdf', '2025-08-19 08:18:22'),
(43, 'ALYA SUJRA WARDHANA ILHAM', 'UNIVERSITAS HASANUDDIN', 34, '1755749053_Format_Sertifikat_Alya_Sujra_Wardhana_Ilham.pdf', '2025-08-21 04:04:13'),
(44, 'ANANDA CAHYANI ', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756087574_Sertifikat_Ananda_Cahyani.pdf', '2025-08-25 02:06:14'),
(45, 'NENENG KUSNIAWATI ', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756087843_Sertifikat_Neneng_Kusniawati.pdf', '2025-08-25 02:10:43'),
(46, 'MUHAMMAD FATCHUL SYAM', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756088364_Format_Sertifikat_1_.pdf', '2025-08-25 02:19:24'),
(47, 'A. GHITA AULYA HARTANTI ', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756088759__Sertifikat_A__Ghita_Aulya_Hartanti.pdf', '2025-08-25 02:25:59'),
(48, 'RAHMADANIA', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756089110_Sertifikat_Rahmadania.pdf', '2025-08-25 02:31:50'),
(49, 'ANDI HIKMA JEMMA', 'UNIVERSITAS MUSLIM IDONESIA', 31, '1756089618_Sertifikat_Andi_Hikma_Jemma.pdf', '2025-08-25 02:40:18'),
(54, 'PRATAMA FAJAR PAREANG', 'UNIVERSITAS HASANUDDIN', 36, '1756345219_Format_Sertifikat_Pratama_Fajar_.pdf', '2025-08-28 01:40:19'),
(64, 'MATTHEW NICOLAUS OLOAN ARITONANG', 'UNIVERSITAS HASANUDDIN', 39, '1756452310_Sertifikat_Matthew_Nicolaus_Oloan_Aritonang.pdf', '2025-08-29 07:25:10'),
(65, 'JESSICA HABEL', 'UNIVERSITAS BOSOWA', 36, '1757301679_Sertifikat_Jessica_Habel.pdf', '2025-09-08 03:21:19'),
(67, 'WIDYA WARDA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', 39, '1757318679_Sertifikat_Widya_Warda.pdf', '2025-09-08 08:04:39'),
(68, 'MUH. ALIM RAMADHAN', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', 39, '1757318990_Sertifikat_Muh_alim_ramadhan.pdf', '2025-09-08 08:09:50'),
(69, 'ADELIA', 'SEKOLAH TINGGI ILMU EKONOMI MAKASSR MAJU', 40, '1757319301_sertifikat_Adelia.pdf', '2025-09-08 08:15:01'),
(70, 'MARZAH', 'SEKOLAH TINGGI ILMU EKONOMI MAKASSR MAJU', 40, '1757319419_sertifikat_Marzah.pdf', '2025-09-08 08:16:59'),
(71, 'AQIDAH ISLAMIAH', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', 30, '1757320159_sertifikat_Aqidah_Islamiah.pdf', '2025-09-08 08:29:19'),
(72, 'ANDI NURQALBI', 'UNIVERSITAS HASANUDDIN', 31, '1757385995_Sertifikat_Andi_Nurqalbi.pdf', '2025-09-09 02:46:35'),
(73, 'KHALISHAH DHAFIYAH JAYADI', 'UNIVERSITAS HASANUDDIN', 38, '1757386041_Sertifikat_Khalishah_Dhafiyah_Jayadi.pdf', '2025-09-09 02:47:21'),
(74, 'NAJWA RAMADHANI SYAM ', 'UNIVERSITAS HASANUDDIN', 35, '1757386086_Sertifikat_Najwa_Ramadhani_Syam.pdf', '2025-09-09 02:48:06'),
(75, 'MUHAMMAD RIFKY ANSHARI USMAN ', 'UNIVERSITAS HASANUDDIN', 38, '1757386140_Sertifikat_Muhammad_Rifky_Anshari_Usman.pdf', '2025-09-09 02:49:00'),
(76, 'MUH.MUHAJIRIN MURSYID', 'UNIVERSITAS HASANUDDIN', 38, '1757386199_Sertifikat_Muh_Muhajirin_Mursyid1.pdf', '2025-09-09 02:49:59'),
(77, 'HANI KHAIRANI SURAHMAN ', 'UNIVERSITAS HASANUDDIN', 31, '1757386257_Sertifikat_Hani_Khairani_Surahman.pdf', '2025-09-09 02:50:57'),
(78, 'PATTA NUR YUYUNG', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', 38, '1757656652_Sertifikat_Patta_Nur_Yuyung.pdf', '2025-09-12 05:57:32'),
(79, 'DILLA SAFIRA', 'UNIVERSITAS MUHAMMADIYAH MAKASSAR', 36, '1758094969_Sertifikat_DILLA.pdf', '2025-09-17 07:42:49'),
(80, 'MUH FADEL', 'UNIVERSITAS ISLAM NEGERI ALAUDDIN MAKASSAR', 29, '1758095573_Sertifikat_Muh_Fadel.pdf', '2025-09-17 07:52:53'),
(81, 'DESTRY ZAKARIA', 'UNIVERSITAS BOSOWA', 40, '1758520615_Sertifikat_Destry_Zakaria.pdf', '2025-09-22 05:56:55'),
(82, 'KOMANG TRYA ARTIWI', 'UNIVERSITAS BOSOWA', 40, '1758520881_Sertifikat_Komang_Trya_Artiwi.pdf', '2025-09-22 06:01:21'),
(83, 'KRISTINA PAULUS', 'UNIVERSITAS BOSOWA', 29, '1758521202_Sertifikat_Kristina_Paulus.pdf', '2025-09-22 06:06:42'),
(84, 'ASIRAH ANWAR', 'UNIVERSITAS HASANUDDIN', 34, '1758676543_Sertifikat_Asirah_Anwar.pdf', '2025-09-24 01:15:43'),
(85, 'MUHAMMAD AGIL REZKY MAPPAULE', 'UNIVERSITAS HASANUDDIN', 40, '1758676747_Sertifikat_Muhammad_Agil_Rezky_Mappaule.pdf', '2025-09-24 01:19:07'),
(86, 'A MUH AMMAR SHODDAM', 'UNIVERSITAS HASANUDDIN', 33, '1758676870_Sertifikat_A_Muh_Ammar_Shoddam.pdf', '2025-09-24 01:21:10'),
(87, 'PUTRI ALIYAH RAMLI', 'UNIVERSITAS HASANUDDIN', 34, '1758676931_Sertifikat_Putri_Aliyah_Ramli.pdf', '2025-09-24 01:22:11'),
(88, 'INDAH NURUL FATIHAH SATRIADIN', 'UNIVERSITAS HASANUDDIN', 34, '1758677027_Sertifikat_Indah_Nurul_Fatihah_Satriadin.pdf', '2025-09-24 01:23:47'),
(89, 'PATRICIA CHRISTABEL PADUDUNG', 'UNIVERSITAS HASANUDDIN', 34, '1758677103_Sertifikat_Patricia_Christabel_Padudung.pdf', '2025-09-24 01:25:03'),
(90, 'WIWIK DIAN ANDANA', 'UNIVERSITAS HASANUDDIN', 34, '1758677175_Sertifikat_Wiwik_Dian_Andana.pdf', '2025-09-24 01:26:15'),
(91, 'ALYA PUTRI LUTFDHIYAA LUKMAN', 'UNIVERSITAS HASANUDDIN', 34, '1758677313_Sertifikat_Alya_Putri_Lutfdhiyaa_Lukman.pdf', '2025-09-24 01:28:33'),
(92, 'WULAN SUCI ASYAHRA', 'UNIVERSITAS BOSOWA', 33, '1758870318_Sertifikat_Wulan_Suci_Asyahra.pdf', '2025-09-26 07:05:18'),
(93, 'SASKYA ANANDA', 'UNIVERSITAS BOSOWA', 33, '1758870350_Sertifikat_Saskya.pdf', '2025-09-26 07:05:50');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_id`, `otp_hash`, `expires_at`, `attempts`, `created_at`) VALUES
(2, 1, '$2y$10$zL58jBOjvyINmD/bJLEg9ezu2xeAReEDz8nFtrVV5Xw4eSgwo5pTy', '2025-08-11 02:14:25', 0, '2025-08-11 02:04:25');

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
(46, 'Andi Satria Rafatariq Amal Kurnia Putra', 'Telkom University ', 37, '2025-06-30', '2025-08-09', 'Selesai'),
(49, 'M. Aymar', 'SMK Negeri 3 Makassar ', 36, '2025-05-17', '2025-10-31', 'Aktif'),
(50, 'Andhika Rizkyatulla', 'SMK Negeri 3 Makassar ', 31, '2025-05-17', '2025-10-31', 'Aktif'),
(51, 'Marzah', 'STIE Makassar Maju', 40, '2025-06-09', '2025-09-01', 'Selesai'),
(54, 'Jessica Habel', 'Universitas Bosowa', 36, '2025-07-01', '2025-08-29', 'Selesai'),
(55, 'Matthew Nicholaus Oloan Aritonang', 'Universitas Hasanuddin', 39, '2025-06-30', '2025-08-22', 'Selesai'),
(56, 'Pratama fajar Pareang', 'Universitas Hasanuddin', 36, '2025-06-30', '2025-08-22', 'Selesai'),
(57, 'A Muh Ammar Shoddam', 'Universitas Hasanuddin', 33, '2025-06-30', '2025-08-22', 'Selesai'),
(58, 'Muhammad Agil Rezki Mappaule', 'Universitas Hasanuddin', 40, '2025-06-30', '2025-08-22', 'Selesai'),
(66, 'M. Alby Rizady', 'Universitas Negeri Makassar', 34, '2025-06-23', '2025-08-23', 'Selesai'),
(67, 'Luciana Alriani Toding', 'UNIVERSITAS CIPUTRA', 35, '2025-07-01', '2025-09-01', 'Selesai'),
(68, 'Najwa Putri Larasati', 'Universitas Hasanuddin', 31, '2025-06-23', '2025-08-18', 'Selesai'),
(69, 'Sharfina Ghaisani', 'Universitas Hasanuddin', 31, '2025-06-23', '2025-08-18', 'Selesai'),
(70, 'Hani Khairani Surahman', 'Universitas Hasanuddin', 31, '2025-06-23', '2025-08-29', 'Selesai'),
(71, 'Aliah Ramadhani Gobel', 'Universitas Hasanuddin', 29, '2025-02-18', '2025-07-25', 'Selesai'),
(72, 'Nauval Zaki', 'Universitas Hasanuddin', 31, '2025-05-05', '2025-08-08', 'Selesai'),
(73, 'Dilla Safira', 'Universitas Muhammadiyah Makassar', 36, '2025-07-08', '2025-09-08', 'Selesai'),
(74, 'Adelia', 'STIE Makassar Maju', 40, '2025-06-09', '2025-09-01', 'Selesai'),
(75, 'Philipe Mori Donso', 'SMK Negeri 3 Makassar ', 30, '2025-05-17', '2025-10-31', 'Aktif'),
(76, 'Aqidah Islamiah', 'Universitas Muhammadiyah Makassar', 30, '2025-07-08', '2025-09-07', 'Selesai'),
(78, 'Muh. Muhajirin Mursyid', 'Universitas Hasanuddin', 38, '2025-07-09', '2025-08-09', 'Selesai'),
(79, 'Khalishah Dhafiyah Jayadi', 'Universitas Hasanuddin', 38, '2025-07-09', '2025-08-09', 'Selesai'),
(80, 'Andi Nurqalbi', 'Universitas Hasanuddin', 31, '2025-07-09', '2025-08-09', 'Selesai'),
(81, 'Najwa Ramadhani Syam', 'Universitas Hasanuddin', 35, '2025-07-09', '2025-08-09', 'Selesai'),
(82, 'Patta Nur Yuyung', 'Universitas Muhammadiyah Makassar', 38, '2025-07-08', '2025-09-07', 'Selesai'),
(83, 'Muh. Alim Ramadhan', 'Universitas Muhammadiyah Makassar', 39, '2025-07-08', '2025-09-07', 'Selesai'),
(84, 'Alisya Sulifianti Bahasoan', 'Institut Teknologi PLN', 33, '2025-09-01', '2025-11-28', 'Aktif'),
(85, 'Saskya Ananda', 'Universitas Bosowa', 33, '2025-07-30', '2025-09-21', 'Selesai'),
(86, 'Komang Trya Artiwi', 'Universitas Bosowa', 40, '2025-07-30', '2025-09-21', 'Selesai'),
(87, 'Wulan Suci Asyahra', 'Universitas Bosowa', 33, '2025-07-30', '2025-09-21', 'Selesai'),
(88, 'Desty Zakaria', 'Universitas Bosowa', 40, '2025-07-30', '2025-09-21', 'Selesai'),
(89, 'Maylha Erisa Pasyha', 'Politeknik Negeri Ujung Pandang', 37, '2025-08-11', '2025-12-11', 'Aktif'),
(90, 'Ulfiah', 'Politeknik Negeri Ujung Pandang', 37, '2025-08-11', '2025-12-11', 'Aktif'),
(91, 'Alya Sujra Wardhana Ilham', 'Universitas Hasanuddin', 36, '2025-07-07', '2025-08-15', 'Selesai'),
(92, 'Putri Aliyah Ramli', 'Universitas Hasanuddin', 34, '2025-07-07', '2025-08-15', 'Selesai'),
(93, 'Wiwik Dian Andana', 'Universitas Hasanuddin', 34, '2025-07-07', '2025-08-15', 'Selesai'),
(94, 'Patricia Charistabel Padudung', 'Universitas Hasanuddin', 34, '2025-07-07', '2025-08-15', 'Selesai'),
(96, 'Muh. Fadel', 'Universitas Islam Negeri Alauddin Makassar', 29, '2025-08-13', '2025-09-13', 'Selesai'),
(97, 'Muh Rifki Sauib', 'Universitas Muhammadiyah Makassar', 33, '2025-07-10', '2025-09-10', 'Selesai'),
(98, 'Azis Ahmad', 'Universitas Muhammadiyah Makassar', 35, '2025-07-10', '2025-09-10', 'Selesai'),
(99, 'Rifki Alfarizi', 'Universitas Muhammadiyah Makassar', 35, '2025-07-10', '2025-09-10', 'Selesai'),
(102, 'Syahratul Muthiah M. Masiming', 'Universitas Telkom', 37, '2025-07-07', '2025-08-16', 'Selesai'),
(104, 'Asirah Anwar', 'Universitas Hasanuddin', 34, '2025-06-16', '2025-08-15', 'Selesai'),
(105, 'Indah Nurul Fatihah Satriadin', 'Universitas Hasanuddin', 34, '2025-06-16', '2025-08-15', 'Selesai'),
(106, 'Alya Putri Lutfdhiyaa Lukman', 'Universitas Hasanuddin', 34, '2025-06-16', '2025-08-15', 'Selesai'),
(107, 'Asmiranda', 'UPT SMK Negeri 7 Makassar', 29, '2025-07-16', '2025-12-12', 'Aktif'),
(108, 'Zaskia Nabila', 'UPT SMK Negeri 7 Makassar', 29, '2025-07-16', '2025-12-12', 'Aktif'),
(109, 'Khadijah Anisa Akib', 'UPT SMK Negeri 7 Makassar', 35, '2025-07-16', '2025-12-12', 'Aktif'),
(110, 'Abd Malik', 'Universitas Negeri Makassar', 33, '2025-05-26', '2025-08-25', 'Selesai'),
(111, 'Andi Muhammad Fahri', 'Universitas Negeri Makassar', 33, '2025-05-26', '2025-08-25', 'Selesai'),
(112, 'Mutmainna Herianto', 'Universitas Negeri Makassar', 37, '2025-08-04', '2025-10-04', 'Aktif'),
(113, 'Ahmad Raisul Amal', 'Universitas Negeri Makassar', 37, '2025-08-04', '2025-10-04', 'Aktif'),
(115, 'Siti Khadijah Abidin', 'Universitas Hasanuddin', 38, '2025-07-28', '2025-08-27', 'Selesai'),
(116, 'Muhammad Nur Aqil Shodiq', 'Universitas Islam Negeri Alauddin Makassar', 37, '2025-07-28', '2025-09-22', 'Selesai'),
(117, 'Kristina Paulus', 'Universitas Bosowa', 29, '2025-08-11', '2025-09-12', 'Selesai'),
(118, 'Widya Warda', 'Universitas Muhammadiyah Makassar', 39, '2025-07-08', '2025-09-07', 'Selesai'),
(119, 'Ananda Cahyani', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(120, 'Muh. Fatchul Syam', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(121, 'Neneng Kusniawati', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(122, 'Rahmadiani', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(123, 'Andi Hikma Jemma', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(124, 'Andi Gita Aulya Hartanti', 'Universitas Muslim Idonesia', 31, '2025-07-16', '2025-08-16', 'Selesai'),
(128, 'Rara Madika Banne', 'Universitas Fajar', 35, '2025-09-09', '2026-01-09', 'Aktif'),
(129, 'Angelika Oktavia Popang Rumengan', 'Universitas Fajar', 35, '2025-09-09', '2026-01-09', 'Aktif'),
(134, 'Jhun Herul', 'Universitas Patria Artha', 31, '2025-09-01', '2025-11-01', 'Aktif'),
(135, 'Annisa Nurul Auliyah', 'Universitas Negeri Makassar', 36, '2025-08-14', '2025-11-14', 'Aktif'),
(136, 'Lutfiah Ardah Putri', 'Universitas Negeri Makassar', 36, '2025-08-14', '2025-11-14', 'Aktif'),
(137, 'Nur Saida. AR', 'Universitas Negeri Makassar', 33, '2025-08-25', '2025-11-28', 'Aktif'),
(138, 'Nasywah Dwi Alika. S', 'Universitas Negeri Makassar', 35, '2025-08-25', '2025-11-28', 'Aktif'),
(139, 'Anastasya Novilia. R', 'Universitas Negeri Makassar', 36, '2025-08-25', '2025-11-28', 'Aktif'),
(140, 'Anugrah Mariani Pirade', 'Universitas Ciputra', 31, '2025-09-01', '2025-12-20', 'Aktif'),
(141, 'Andini Wahyuni', 'Universitas Negeri Makassar', 31, '2025-08-14', '2025-11-14', 'Aktif'),
(142, 'Reski Amelia', 'Universitas Negeri Makassar', 31, '2025-08-14', '2025-11-14', 'Aktif'),
(145, 'Lutfi Atmaja', 'SMK Negeri 3 Bone', 39, '2025-08-04', '2025-11-29', 'Aktif'),
(146, 'Hafizah Wahyudin', 'SMK Negeri 3 Bone', 36, '2025-08-04', '2025-11-29', 'Aktif'),
(147, 'Andika', 'SMK Negeri 3 Bone', 31, '2025-08-04', '2025-11-29', 'Aktif'),
(149, 'Nurlinda', 'Institut Bisnis dan Keuangan Nitro', 40, '2025-09-08', '2025-11-07', 'Aktif'),
(150, 'Nadia Lestari', 'Institut Bisnis dan Keuangan Nitro', 40, '2025-09-08', '2025-11-07', 'Aktif'),
(156, 'Farisia Maharani K', 'Universitas Negeri Makassar', 39, '2025-09-10', '2025-12-10', 'Aktif'),
(157, 'Almadhea Suba', 'Universitas Hasanuddin', 36, '2025-09-15', '2025-11-07', 'Aktif'),
(158, 'Agnes Marcela Rombe', 'Universitas Hasanuddin', 35, '2025-09-08', '2025-12-08', 'Aktif'),
(159, 'Rhafly Anugrah Himawan', 'Universitas Negeri Makassar', 33, '2025-09-10', '2025-12-10', 'Aktif'),
(160, 'Farisia Maharani K', 'Universitas Negeri Makassar', 33, '2025-09-10', '2025-12-10', 'Aktif'),
(161, 'Moh. Ilham Fariqulzaman', 'Universitas Negeri Makassar', 39, '2025-09-10', '2025-12-10', 'Aktif'),
(162, 'St. Nurfadila Ibrah', 'Universitas Negeri Makassar', 39, '2025-09-10', '2025-12-10', 'Aktif'),
(163, 'Imelda Yulistianti Putri', 'Universitas Negeri Makassar', 30, '2025-09-10', '2025-12-10', 'Aktif'),
(164, 'Muhammad Fikhar Suratman', 'Universitas Hasanuddin', 31, '2025-09-08', '2025-12-08', 'Aktif'),
(165, 'Muhammad Asnul Husadi', 'Universitas Hasanuddin', 38, '2025-09-08', '2025-12-08', 'Aktif'),
(166, 'Achmad Dhani Ridwan', 'Universitas Hasanuddin', 38, '2025-09-08', '2025-12-08', 'Aktif'),
(167, 'YOSAFAT AMBA', 'Universitas Fajar', 31, '2025-09-08', '2026-01-08', 'Aktif'),
(168, 'A. NURHUMAERAH', 'Universitas Negeri Makassar', 35, '2025-07-01', '2025-08-29', 'Selesai'),
(169, 'Yayi Ainun Aulia', 'Institut Bisnis dan Keuangan Nitro', 34, '2025-09-01', '2025-11-03', 'Aktif'),
(170, 'Viona', 'Institut Bisnis dan Keuangan Nitro', 34, '2025-09-01', '2025-11-03', 'Aktif'),
(171, 'Nur Rahma Rahman', 'Universitas Hasanuddin', 29, '2025-09-15', '2025-11-15', 'Aktif'),
(172, 'Sahnas Azzahra', 'Universitas Hasanuddin', 29, '2025-09-15', '2025-11-15', 'Aktif'),
(173, 'Syahrul Ramadhani', 'Universitas Indonesia Timur', 29, '2025-09-15', '2025-10-15', 'Aktif'),
(174, 'Rahmat. R', 'Universitas Indonesia Timur', 29, '2025-09-15', '2025-10-15', 'Aktif');

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
(29, 'K3', 3, '.'),
(30, 'Niaga', 2, '.'),
(31, 'Distribusi&Up2k', 5, '.'),
(33, 'Perencanaan', 4, '.'),
(34, 'Keuangan&Akutansi', 6, '.'),
(35, 'Komunikasi', 4, '.'),
(36, 'Umum', 4, '.'),
(37, 'STI', 6, '.'),
(38, 'HTD', 4, '.'),
(39, 'HC', 3, '.'),
(40, 'Pengadaan', 3, '.');

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
(9, 'fuad', '$2y$10$Ou0mZ/cxdsh00sToYCAyr.TqIXcExlUAvdc6rSh4T2RHAdinx/uuu');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT untuk tabel `data_sertifikat`
--
ALTER TABLE `data_sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta_magang`
--
ALTER TABLE `peserta_magang`
  MODIFY `id_mahasiswa` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT untuk tabel `sub_bidang`
--
ALTER TABLE `sub_bidang`
  MODIFY `id_bidang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
