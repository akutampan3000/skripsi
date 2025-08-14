-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2025 at 11:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spsparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_history`
--

CREATE TABLE `diagnostic_history` (
  `history_id` int NOT NULL,
  `user_id` int NOT NULL,
  `result_sparepart_id` varchar(20) NOT NULL,
  `diagnosed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `diagnostic_history`
--

INSERT INTO `diagnostic_history` (`history_id`, `user_id`, `result_sparepart_id`, `diagnosed_at`) VALUES
(1, 2, 'sp_mes_07', '2025-06-11 09:42:36'),
(2, 2, 'sp_mes_02', '2025-06-11 09:43:29'),
(3, 4, 'sp_mes_07', '2025-06-11 10:17:44'),
(4, 2, 'sp_kel_03', '2025-06-11 10:48:04'),
(5, 4, 'sp_kel_03', '2025-06-11 11:34:36'),
(6, 4, 'sp_kel_01', '2025-06-12 15:53:48'),
(7, 4, 'sp_kel_01', '2025-06-12 15:54:42'),
(8, 4, 'sp_kel_08', '2025-06-12 15:54:51'),
(9, 4, 'sp_kel_08', '2025-06-12 15:55:10'),
(10, 4, 'sp_kel_08', '2025-06-12 15:56:24'),
(11, 2, 'sp_kel_04', '2025-06-16 11:09:04'),
(12, 2, 'sp_kel_02', '2025-06-16 11:22:22'),
(13, 2, 'sp_mes_02', '2025-06-16 12:47:29'),
(14, 2, 'sp_mes_11', '2025-06-18 10:15:12'),
(15, 2, 'sp_kel_03', '2025-07-09 11:11:37'),
(16, 2, 'sp_mes_11', '2025-07-21 18:14:27'),
(17, 2, 'sp_mes_05', '2025-07-21 18:14:47'),
(18, 2, 'sp_kel_11', '2025-07-21 18:58:34'),
(19, 2, 'sp_mes_05', '2025-07-21 18:58:47'),
(20, 2, 'sp_mes_11', '2025-07-21 18:58:58'),
(21, 2, 'sp_mes_06', '2025-07-21 18:59:21'),
(22, 2, 'sp_mes_15', '2025-07-21 18:59:43'),
(23, 2, 'sp_kel_02', '2025-07-21 19:00:06'),
(24, 2, 'sp_kel_02', '2025-07-21 19:01:03'),
(25, 2, 'sp_mes_11', '2025-07-21 19:04:23'),
(26, 2, 'sp_kel_13', '2025-07-21 19:05:04'),
(27, 2, 'sp_mes_02', '2025-07-24 08:10:11'),
(28, 2, 'sp_kel_03', '2025-07-24 08:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` varchar(20) NOT NULL,
  `problem_type` enum('electrical','engine') NOT NULL,
  `question_text` text NOT NULL,
  `next_if_yes` varchar(20) DEFAULT NULL,
  `next_if_no` varchar(20) DEFAULT NULL,
  `is_initial` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `problem_type`, `question_text`, `next_if_yes`, `next_if_no`, `is_initial`) VALUES
('q_kel_01', 'electrical', 'Apakah motor tidak bisa di-starter sama sekali (tidak ada suara apapun)?', 'q_kel_02', 'q_kel_03', 1),
('q_kel_02', 'electrical', 'Apakah saat tombol starter ditekan hanya terdengar bunyi \"cetek-cetek\" dari area jok/aki?', 'sp_kel_08', 'q_kel_09', 0),
('q_kel_03', 'electrical', 'Apakah klakson motor bersuara lemah (sember) atau tidak berbunyi sama sekali?', 'sp_kel_01', 'q_kel_04', 0),
('q_kel_04', 'electrical', 'Apakah lampu utama (depan) mati total, namun lampu lain menyala?', 'sp_kel_04', 'q_kel_05', 0),
('q_kel_05', 'electrical', 'Apakah lampu utama menyala tapi sangat redup?', 'q_kel_11', 'q_kel_06', 0),
('q_kel_06', 'electrical', 'Apakah lampu sein (kedua sisi) tidak mau berkedip sama sekali (hanya menyala diam)?', 'sp_kel_05', 'q_kel_07', 0),
('q_kel_07', 'electrical', 'Apakah salah satu lampu sein (kanan atau kiri) berkedip lebih cepat dari biasanya?', 'sp_kel_04', 'q_kel_08', 0),
('q_kel_08', 'electrical', 'Apakah lampu rem tidak menyala saat tuas rem ditekan?', 'sp_kel_06', 'q_kel_09', 0),
('q_kel_09', 'electrical', 'Apakah lampu di panel spidometer mati total?', 'sp_kel_03', 'q_kel_10', 0),
('q_kel_10', 'electrical', 'Apakah motor sering mati mendadak saat sedang berjalan?', 'sp_kel_11', 'q_kel_14', 0),
('q_kel_11', 'electrical', 'Apakah aki motor sering tekor (soak) padahal baru saja diganti?', 'sp_kel_02', 'q_kel_12', 0),
('q_kel_12', 'electrical', 'Apakah lampu motor sering putus padahal baru diganti?', 'sp_kel_02', 'q_kel_13', 0),
('q_kel_13', 'electrical', 'Apakah starter motor kadang berfungsi, kadang tidak?', 'sp_kel_07', 'q_kel_17', 0),
('q_kel_14', 'electrical', 'Apakah mesin terasa \"brebet\" atau tersendat-sendat pada putaran mesin tertentu?', 'sp_kel_10', 'q_kel_15', 0),
('q_kel_15', 'electrical', 'Apakah ada bau seperti kabel terbakar dari area depan motor?', 'sp_kel_13', 'q_kel_21', 0),
('q_kel_16', 'electrical', 'Apakah jarum indikator bensin di spidometer tidak bergerak atau menunjukkan informasi yang salah?', 'sp_kel_12', 'q_kel_29', 0),
('q_kel_17', 'electrical', 'Apakah dinamo starter terdengar \"ngelos\" atau tidak memutar mesin?', 'sp_kel_09', 'q_kel_18', 0),
('q_kel_18', 'electrical', 'Apakah lampu senja (lampu kota) mati?', 'sp_kel_04', 'q_kel_19', 0),
('q_kel_19', 'electrical', 'Apakah sekring utama motor sering putus?', 'sp_kel_13', 'q_kel_20', 0),
('q_kel_20', 'electrical', 'Apakah motor sulit dinyalakan saat kondisi mesin dingin di pagi hari?', 'sp_mes_01', 'q_kel_26', 0),
('q_kel_21', 'electrical', 'Apakah motor bisa hidup tapi lampu-lampu redup semua?', 'sp_kel_02', 'q_kel_22', 0),
('q_kel_22', 'electrical', 'Apakah ada percikan api atau korsleting saat motor dinyalakan?', 'sp_kel_13', 'q_kel_26', 0),
('q_kel_23', 'electrical', 'Apakah motor bisa hidup tapi sering mati saat lampu utama dinyalakan?', 'sp_kel_02', 'q_kel_24', 0),
('q_kel_24', 'electrical', 'Apakah ada bunyi \"dengung\" dari area kiprok saat motor hidup?', 'sp_kel_02', 'q_kel_25', 0),
('q_kel_25', 'electrical', 'Apakah lampu speedometer berkedip-kedip tidak normal?', 'sp_kel_03', 'q_kel_35', 0),
('q_kel_26', 'electrical', 'Apakah motor susah starter saat cuaca hujan atau lembab?', 'sp_kel_16', 'q_kel_36', 0),
('q_kel_27', 'electrical', 'Apakah ada percikan api di area kontak atau kunci motor?', 'sp_kel_17', 'q_kel_37', 0),
('q_kel_28', 'electrical', 'Apakah lampu hazard tidak berfungsi sama sekali?', 'sp_kel_18', 'q_kel_33', 0),
('q_kel_29', 'electrical', 'Apakah motor bisa hidup tapi lampu-lampu berkedip tidak normal?', 'sp_kel_19', 'q_kel_30', 0),
('q_kel_30', 'electrical', 'Apakah ada suara \"mendesis\" dari area aki saat motor hidup?', 'sp_kel_20', 'sp_kel_21', 0),
('q_kel_31', 'electrical', 'Apakah motor injeksi mengalami rpm naik turun tidak stabil?', 'sp_kel_23', 'q_kel_32', 0),
('q_kel_32', 'electrical', 'Apakah pengapian terasa lemah atau timing tidak tepat?', 'sp_kel_22', 'sp_kel_10', 0),
('q_kel_33', 'electrical', 'Apakah motor injeksi sering mengalami error code di dashboard?', 'sp_kel_23', 'q_kel_34', 0),
('q_kel_34', 'electrical', 'Apakah sistem pengisian aki tidak berfungsi optimal?', 'sp_kel_24', 'sp_kel_02', 0),
('q_kel_35', 'electrical', 'Apakah lampu indikator di dashboard sering berkedip atau error?', 'sp_kel_23', 'sp_kel_03', 0),
('q_kel_36', 'electrical', 'Apakah motor bisa hidup tapi lampu-lampu tidak menyala sama sekali?', 'sp_kel_03', 'sp_kel_02', 0),
('q_kel_37', 'electrical', 'Apakah sistem starter elektrik tidak merespon sama sekali?', 'sp_kel_08', 'sp_kel_01', 0),
('q_mes_01', 'engine', 'Apakah tarikan motor terasa berat atau tidak bertenaga (ngempos)?', 'q_mes_04', 'q_mes_03', 1),
('q_mes_02', 'engine', 'Apakah keluar asap putih tipis/tebal dari knalpot?', 'sp_mes_04', 'q_mes_05', 0),
('q_mes_03', 'engine', 'Apakah terdengar suara \"ngelitik\" atau \"kemlitik\" dari area kepala silinder mesin?', 'sp_mes_05', 'q_mes_08', 0),
('q_mes_04', 'engine', 'Apakah konsumsi bahan bakar terasa lebih boros dari biasanya?', 'sp_mes_02', 'q_mes_14', 0),
('q_mes_05', 'engine', 'Apakah mesin motor cepat panas (overheat)?', 'sp_mes_15', 'q_mes_06', 0),
('q_mes_06', 'engine', 'Apakah terjadi slip saat perpindahan gigi (untuk motor manual)?', 'sp_mes_03', 'q_mes_07', 0),
('q_mes_07', 'engine', 'Apakah tuas kopling terasa sangat keras atau terlalu ringan?', 'sp_mes_03', 'q_mes_16', 0),
('q_mes_08', 'engine', 'Apakah terdengar suara kasar atau berisik dari area CVT (untuk motor matic)?', 'sp_mes_06', 'q_mes_09', 0),
('q_mes_09', 'engine', 'Apakah ada getaran tidak normal pada motor saat akselerasi awal (untuk motor matic)?', 'sp_mes_07', 'q_mes_10', 0),
('q_mes_10', 'engine', 'Apakah knalpot mengeluarkan suara \"nembak\" saat gas dilepas?', 'sp_mes_11', 'q_mes_15', 0),
('q_mes_11', 'engine', 'Apakah oli mesin terlihat berkurang drastis padahal tidak ada kebocoran?', 'q_mes_02', 'q_mes_12', 0),
('q_mes_12', 'engine', 'Apakah ada rembesan atau tetesan oli dari bawah mesin?', 'sp_mes_14', 'q_mes_13', 0),
('q_mes_13', 'engine', 'Apakah motor sulit langsam (stasioner) atau sering mati saat berhenti?', 'q_mes_19', 'q_mes_10', 0),
('q_mes_14', 'engine', 'Apakah warna busi menjadi hitam pekat dan basah oleh bensin?', 'sp_mes_11', 'q_mes_06', 0),
('q_mes_15', 'engine', 'Apakah terdengar suara \"ngorok\" saat motor berakselerasi?', 'sp_mes_02', 'q_mes_17', 0),
('q_mes_16', 'engine', 'Apakah rantai motor sering kendur atau menimbulkan suara berisik?', 'sp_mes_08', 'q_mes_21', 0),
('q_mes_17', 'engine', 'Apakah air radiator (coolant) pada tabung reservoir sering habis? (untuk motor berpendingin cairan)', 'sp_mes_15', 'q_mes_30', 0),
('q_mes_18', 'engine', 'Apakah motor terasa \"ndut-ndutan\" saat berjalan pada kecepatan konstan?', 'sp_mes_01', 'q_mes_20', 0),
('q_mes_19', 'engine', 'Apakah tendangan kick starter terasa ringan atau \"ngelos\" tanpa perlawanan?', 'sp_mes_04', 'q_mes_11', 0),
('q_mes_20', 'engine', 'Apakah ada bau bensin yang sangat menyengat di sekitar motor?', 'sp_mes_12', 'q_mes_23', 0),
('q_mes_21', 'engine', 'Apakah motor susah distarter saat mesin panas?', 'sp_mes_01', 'q_mes_37', 0),
('q_mes_22', 'engine', 'Apakah ada suara aneh dari area transmisi saat motor berjalan?', 'sp_mes_08', 'q_mes_32', 0),
('q_mes_23', 'engine', 'Apakah motor terasa \"ngempos\" saat tanjakan?', 'sp_mes_18', 'q_mes_36', 0),
('q_mes_24', 'engine', 'Apakah ada suara \"tek-tek-tek\" dari area klep saat mesin hidup?', 'sp_mes_19', 'q_mes_25', 0),
('q_mes_25', 'engine', 'Apakah oli mesin berubah warna menjadi putih susu?', 'sp_mes_20', 'q_mes_26', 0),
('q_mes_26', 'engine', 'Apakah motor susah hidup saat tangki bensin hampir kosong?', 'sp_mes_21', 'q_mes_24', 0),
('q_mes_27', 'engine', 'Apakah ada bau gosong dari area kopling saat motor berjalan?', 'sp_mes_22', 'q_mes_28', 0),
('q_mes_28', 'engine', 'Apakah putaran mesin tidak stabil saat langsam?', 'sp_mes_23', 'q_mes_29', 0),
('q_mes_29', 'engine', 'Apakah ada suara \"kletek-kletek\" dari area timing chain?', 'sp_mes_24', 'q_mes_30', 0),
('q_mes_30', 'engine', 'Apakah mesin overheat padahal air radiator masih penuh?', 'sp_mes_25', 'q_mes_34', 0),
('q_mes_31', 'engine', 'Apakah ada suara \"ngik-ngik\" dari area klep buang?', 'sp_mes_26', 'q_mes_25', 0),
('q_mes_32', 'engine', 'Apakah oli mesin cepat habis tanpa ada kebocoran yang terlihat?', 'sp_mes_27', 'q_mes_33', 0),
('q_mes_33', 'engine', 'Apakah ada suara \"kletek\" dari area noken as saat mesin hidup?', 'sp_mes_28', 'sp_mes_04', 0),
('q_mes_34', 'engine', 'Apakah ada kebocoran oli dari area pompa oli?', 'sp_mes_27', 'q_mes_35', 0),
('q_mes_35', 'engine', 'Apakah timing pengapian terasa tidak tepat atau terlambat?', 'sp_mes_28', 'sp_kel_22', 0),
('q_mes_36', 'engine', 'Apakah motor terasa kurang bertenaga saat akselerasi penuh?', 'sp_mes_02', 'sp_mes_01', 0),
('q_mes_37', 'engine', 'Apakah ada suara aneh dari area mesin saat putaran tinggi?', 'sp_mes_05', 'sp_mes_04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `spareparts`
--

CREATE TABLE `spareparts` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `problem_type` enum('electrical','engine') NOT NULL,
  `category` varchar(50) NOT NULL COMMENT 'Contoh: Busi, Aki, Filter, Oli',
  `performance_level` enum('standard','oem','racing') NOT NULL COMMENT 'Level performa atau kualitas sparepart',
  `brands` text COMMENT 'Merek motor yang kompatibel (Honda, Yamaha, Suzuki, dll)',
  `related_symptoms` text COMMENT 'Gejala-gejala yang terkait dengan sparepart ini',
  `compatibility_score` decimal(3,2) DEFAULT '1.00' COMMENT 'Skor kompatibilitas untuk CBF (0.00-1.00)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spareparts`
--

INSERT INTO `spareparts` (`id`, `name`, `description`, `problem_type`, `category`, `performance_level`, `brands`, `related_symptoms`, `compatibility_score`) VALUES
('sp_kel_01', 'Aki (Accumulator)', 'Sumber utama listrik. Ganti jika motor tidak bisa starter, klakson lemah, atau lampu redup.', 'electrical', 'Aki', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'motor tidak bisa starter,klakson lemah,lampu redup,starter tidak bunyi,lampu mati total,panel spidometer mati', '0.95'),
('sp_kel_02', 'Kiprok (Regulator/Rectifier)', 'Mengatur pengisian ke aki. Ganti jika aki sering tekor atau lampu mudah putus.', 'electrical', 'Regulator', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'aki sering tekor,lampu mudah putus,overcharge,undercharge', '0.90'),
('sp_kel_03', 'Sekring (Fuse)', 'Pengaman sirkuit listrik. Ganti jika ada komponen listrik mati total.', 'electrical', 'Komponen Kelistrikan', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'komponen listrik mati,lampu mati,panel spidometer mati', '0.98'),
('sp_kel_04', 'Bohlam Lampu (Bulb)', 'Ganti jika lampu spesifik (depan, rem, sein) mati.', 'electrical', 'Lampu', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'lampu depan mati,lampu rem mati,lampu sein mati,lampu senja mati,penerangan kurang,lampu berkedip', '0.99'),
('sp_kel_05', 'Flasher Sein', 'Komponen yang membuat lampu sein berkedip. Ganti jika sein tidak berkedip atau berkedip terlalu cepat.', 'electrical', 'Komponen Kelistrikan', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'sein tidak berkedip,sein berkedip cepat,sein menyala terus', '0.92'),
('sp_kel_06', 'Switch Rem', 'Saklar yang menyalakan lampu rem. Ganti jika lampu rem tidak menyala saat tuas ditekan.', 'electrical', 'Switch', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'lampu rem tidak menyala,switch rem rusak', '0.94'),
('sp_kel_07', 'Switch Starter', 'Tombol untuk menyalakan motor. Ganti jika starter kadang berfungsi kadang tidak.', 'electrical', 'Switch', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'starter kadang berfungsi,tombol starter rusak,starter tidak respon', '0.93'),
('sp_kel_08', 'Bendik Starter (Relay Starter)', 'Menghubungkan arus dari aki ke dinamo. Ganti jika saat starter hanya terdengar bunyi \"cetek-cetek\".', 'electrical', 'Relay', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'bunyi cetek-cetek,starter tidak berputar,relay rusak', '0.91'),
('sp_kel_09', 'Dinamo Starter', 'Motor listrik yang memutar mesin. Servis/ganti jika starter ngelos atau tidak bertenaga.', 'electrical', 'Dinamo', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'starter ngelos,dinamo tidak berputar,starter lemah', '0.88'),
('sp_kel_10', 'Koil Pengapian (Ignition Coil)', 'Menaikkan tegangan listrik untuk busi. Ganti jika mesin brebet atau pengapian hilang.', 'electrical', 'Pengapian', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'mesin brebet,pengapian hilang,mesin tersendat,susah starter,motor mati mendadak', '0.89'),
('sp_kel_11', 'CDI / ECU', 'Otak sistem pengapian (CDI) atau kontrol mesin (ECU). Ganti jika motor mati total dan pengapian hilang.', 'electrical', 'ECU', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'motor mati total,pengapian hilang,mesin tidak hidup', '0.85'),
('sp_kel_12', 'Sensor Bensin', 'Sensor level bensin di tangki. Ganti jika indikator bensin tidak akurat.', 'electrical', 'Sensor', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'indikator bensin salah,jarum bensin tidak bergerak', '0.89'),
('sp_kel_13', 'Kabel Body Motor', 'Kabel kelistrikan body motor lengkap dengan soket', 'electrical', 'wiring', 'standard', 'Honda,Yamaha,Kawasaki,Suzuki', 'korsleting,kabel terbakar,percikan api', '0.75'),
('sp_kel_14', 'Rumah/Fiting Lampu', 'Dudukan bohlam. Ganti jika sudah meleleh atau berkarat.', 'electrical', 'Lampu', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'fiting meleleh,dudukan lampu berkarat,lampu tidak pas', '0.96'),
('sp_kel_15', 'Klakson (Horn)', 'Ganti jika suara sember atau mati total.', 'electrical', 'Aksesoris', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'klakson sember,klakson mati,suara klakson lemah', '0.97'),
('sp_kel_16', 'Kabel Busi', 'Kabel penghubung koil ke busi. Ganti jika motor susah starter saat lembab atau ada kebocoran arus.', 'electrical', 'Pengapian', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'susah starter saat hujan,kebocoran arus,pengapian lemah', '0.91'),
('sp_kel_17', 'Switch Kontak', 'Saklar utama motor. Ganti jika ada percikan api atau kontak tidak stabil.', 'electrical', 'Switch', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'percikan api kontak,kontak tidak stabil,kunci macet', '0.94'),
('sp_kel_18', 'Relay Hazard', 'Relay untuk lampu hazard. Ganti jika lampu hazard tidak berfungsi.', 'electrical', 'Relay', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'hazard tidak berfungsi,relay rusak', '0.93'),
('sp_kel_19', 'Stator/Spul', 'Pembangkit listrik motor. Ganti jika sistem pengisian tidak berfungsi atau lampu redup saat RPM rendah.', 'electrical', 'Pengisian', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'lampu redup rpm rendah,aki tidak terisi,sistem pengisian rusak', '0.87'),
('sp_kel_20', 'Rectifier/Dioda', 'Penyearah arus AC ke DC. Ganti jika aki overcharge atau undercharge.', 'electrical', 'Pengisian', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'aki overcharge,aki undercharge,tegangan tidak stabil', '0.88'),
('sp_kel_21', 'Voltage Regulator', 'Pengatur tegangan listrik. Ganti jika tegangan tidak stabil atau komponen listrik cepat rusak.', 'electrical', 'Regulator', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'tegangan tidak stabil,komponen listrik cepat rusak,lampu putus terus', '0.89'),
('sp_kel_22', 'CDI Unit', 'Unit pengapian elektronik yang mengatur timing pengapian', 'electrical', 'ignition', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'mesin susah hidup,putaran tidak stabil,brebet saat gas', '0.90'),
('sp_kel_23', 'Sensor TPS (Throttle Position)', 'Sensor posisi throttle untuk injeksi', 'electrical', 'sensor', 'oem', 'Honda,Yamaha,Suzuki', 'rpm tidak stabil,konsumsi bbm boros,tenaga kurang responsif', '0.80'),
('sp_kel_24', 'Alternator/Spul Pengisian', 'Komponen yang menghasilkan listrik untuk mengisi aki', 'electrical', 'charging', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'aki sering tekor,lampu redup,motor mati saat rpm rendah', '0.85'),
('sp_mes_01', 'Busi (Spark Plug)', 'Pemantik api di ruang bakar. Ganti jika tarikan berat, brebet, atau sulit dinyalakan.', 'engine', 'Pengapian', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'tarikan berat,mesin brebet,sulit dinyalakan,mesin ndut-ndutan,susah starter mesin panas,langsam tidak stabil', '0.95'),
('sp_mes_02', 'Filter Udara', 'Menyaring udara ke ruang bakar. Ganti jika tarikan berat dan bensin boros.', 'engine', 'Filter', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'tarikan berat,bensin boros,suara ngorok,performa menurun,asap putih,oli masuk ruang bakar', '0.93'),
('sp_mes_03', 'Kampas Kopling', 'Mentransfer tenaga mesin ke transmisi. Ganti jika terjadi selip kopling.', 'engine', 'Transmisi', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'slip kopling,kopling keras,kopling ringan,perpindahan gigi sulit', '0.90'),
('sp_mes_04', 'Piston & Ring Piston', 'Komponen utama di ruang bakar. Ganti jika tenaga ngempos dan keluar asap putih.', 'engine', 'Komponen Mesin', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'tenaga ngempos,asap putih,oli berkurang,kick starter ringan', '0.82'),
('sp_mes_05', 'Klep (Valve)', 'Mengatur masuknya bensin dan keluarnya gas buang. Setel/skir jika kompresi bocor atau suara mesin kasar.', 'engine', 'Komponen Mesin', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'suara ngelitik,kompresi bocor,suara mesin kasar', '0.84'),
('sp_mes_06', 'V-Belt & Roller', 'Komponen transmisi CVT pada motor matic. Ganti jika ada getaran atau tarikan awal berat.', 'engine', 'CVT', 'oem', 'Honda,Yamaha,Suzuki', 'suara CVT berisik,getaran tidak normal,tarikan awal berat', '0.88'),
('sp_mes_07', 'Kampas Ganda', 'Kopling otomatis di CVT motor matic. Ganti jika akselerasi awal selip.', 'engine', 'CVT', 'oem', 'Honda,Yamaha,Suzuki', 'akselerasi awal selip,getaran saat akselerasi', '0.89'),
('sp_mes_08', 'Rantai & Gir (Sprocket)', 'Transmisi akhir motor manual. Ganti jika sudah aus, tajam, atau berisik.', 'engine', 'Transmisi', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'rantai kendur,suara berisik,rantai aus,suara kletek,tenaga berkurang,putaran tidak halus', '0.91'),
('sp_mes_09', 'Oli Mesin', 'Pelumas utama. Ganti rutin untuk mencegah mesin panas dan kasar.', 'engine', 'Pelumas', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'mesin panas,suara mesin kasar,oli kotor', '0.98'),
('sp_mes_10', 'Filter Oli', 'Menyaring kotoran di oli. Ganti setiap beberapa kali ganti oli.', 'engine', 'Filter', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'oli kotor,sirkulasi oli buruk,mesin kasar', '0.94'),
('sp_mes_11', 'Injektor / Karburator', 'Penyuplai bahan bakar. Servis/bersihkan jika motor brebet atau boros.', 'engine', 'Sistem Bahan Bakar', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'motor brebet,bensin boros,knalpot nembak,busi hitam', '0.87'),
('sp_mes_12', 'Pompa Bensin (Fuel Pump)', 'Memompa bensin ke injektor. Ganti jika tekanan lemah atau motor tidak bisa hidup.', 'engine', 'Sistem Bahan Bakar', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'motor tidak hidup,tekanan bensin lemah,bau bensin menyengat', '0.86'),
('sp_mes_13', 'Seal Klep', 'Mencegah oli masuk ke ruang bakar. Ganti jika knalpot mengeluarkan asap putih.', 'engine', 'Seal', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'asap putih,oli masuk ruang bakar', '0.92'),
('sp_mes_14', 'Paking Blok Mesin', 'Mencegah kebocoran. Ganti jika ada rembesan oli.', 'engine', 'Seal', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'rembesan oli,tetesan oli,kebocoran mesin', '0.93'),
('sp_mes_15', 'Air Radiator (Coolant)', 'Cairan pendingin mesin. Isi/ganti jika mesin sering overheat.', 'engine', 'Sistem Pendingin', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'mesin overheat,air radiator habis,mesin panas', '0.96'),
('sp_mes_16', 'Piston Kit', 'Set piston lengkap dengan ring dan pin', 'engine', 'internal', 'oem', 'Honda,Yamaha,Kawasaki,Suzuki', 'kompresi rendah,asap putih,tenaga hilang', '0.90'),
('sp_mes_17', 'Klep Motor', 'Klep in dan klep out untuk motor 4 tak', 'engine', 'valve', 'oem', 'Honda,Yamaha,Kawasaki,Suzuki', 'suara kasar,kompresi rendah,susah starter', '0.88'),
('sp_mes_18', 'Karburator/Throttle Body', 'Sistem pencampur udara dan bensin. Servis/ganti jika motor ngempos saat tanjakan.', 'engine', 'Sistem Bahan Bakar', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'motor ngempos,tarikan lemah,bensin boros,rpm tidak stabil', '0.86'),
('sp_mes_19', 'Rocker Arm/Pelatuk Klep', 'Komponen penggerak klep. Setel/ganti jika ada suara tek-tek dari area klep.', 'engine', 'Komponen Mesin', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'suara tek-tek klep,klep berisik,setelan klep longgar', '0.87'),
('sp_mes_20', 'Gasket Kepala Silinder', 'Paking antara blok dan kepala silinder. Ganti jika oli berubah warna putih susu.', 'engine', 'Seal', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'oli putih susu,air masuk oli,overheat,kompresi bocor', '0.84'),
('sp_mes_21', 'Saringan Bensin', 'Filter bensin di dalam tangki. Ganti jika motor susah hidup saat bensin sedikit.', 'engine', 'Filter', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki,Universal', 'susah hidup bensin sedikit,suplai bensin terhambat,filter kotor', '0.95'),
('sp_mes_22', 'Kampas Kopling Manual', 'Kampas kopling untuk motor manual. Ganti jika ada bau gosong dari area kopling.', 'engine', 'Transmisi', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'bau gosong kopling,kopling selip,perpindahan gigi sulit', '0.89'),
('sp_mes_23', 'Pilot Jet/Idle Jet', 'Spuyer langsam pada karburator. Bersihkan/ganti jika putaran langsam tidak stabil.', 'engine', 'Sistem Bahan Bakar', 'standard', 'Honda,Yamaha,Suzuki,Kawasaki', 'langsam tidak stabil,rpm naik turun,mesin mati saat idle', '0.92'),
('sp_mes_24', 'Timing Chain/Rantai Keteng', 'Rantai penggerak noken as. Ganti jika ada suara berisik dari area kepala silinder.', 'engine', 'Timing', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'suara berisik kepala silinder,timing tidak tepat,rantai kendur', '0.85'),
('sp_mes_25', 'Water Pump/Pompa Air', 'Pompa sirkulasi air pendingin. Ganti jika mesin overheat padahal air radiator cukup.', 'engine', 'Sistem Pendingin', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'overheat air cukup,sirkulasi air buruk,pompa bocor', '0.86'),
('sp_mes_26', 'Exhaust Valve/Klep Buang', 'Klep pembuangan gas sisa pembakaran. Ganti jika kompresi rendah atau suara kasar dari knalpot.', 'engine', 'Komponen Mesin', 'oem', 'Honda,Yamaha,Suzuki,Kawasaki', 'kompresi rendah,suara kasar knalpot,gas buang tidak lancar', '0.83'),
('sp_mes_27', 'Oil Pump/Pompa Oli', 'Pompa yang mensirkulasikan oli mesin', 'engine', 'lubrication', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'suara kasar mesin,oli cepat habis,mesin panas berlebihan', '0.88'),
('sp_mes_28', 'Camshaft/Noken As', 'Poros yang menggerakkan klep masuk dan buang', 'engine', 'valve', 'racing', 'Honda,Yamaha,Suzuki,Kawasaki', 'suara kletek dari atas mesin,tenaga berkurang,putaran tidak halus', '0.92');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirm_password`, `created_at`, `is_admin`) VALUES
(1, 'admin', 'admin@super.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-03-05 13:23:27', 1),
(2, 'gstve', 'gustave410@gmail.com', '$2y$10$WNjbADmE6hzwKxAwZmaS0uuypyc32n3MsQbFZF4Sit7OiZNRJpsti', NULL, '2025-03-05 13:26:25', 0),
(4, 'udin', 'udin@udin.com', '$2y$10$q3TjPIK/4kioEninpZ5Ce.NPTkEOQiPy4VO7dHnb0OF9MwN8FgQk.', NULL, '2025-06-11 04:47:28', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnostic_history`
--
ALTER TABLE `diagnostic_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `result_sparepart_id` (`result_sparepart_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spareparts`
--
ALTER TABLE `spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnostic_history`
--
ALTER TABLE `diagnostic_history`
  MODIFY `history_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diagnostic_history`
--
ALTER TABLE `diagnostic_history`
  ADD CONSTRAINT `diagnostic_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diagnostic_history_ibfk_2` FOREIGN KEY (`result_sparepart_id`) REFERENCES `spareparts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
