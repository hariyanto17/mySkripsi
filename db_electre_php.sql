-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2019 pada 16.05
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_electre_php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(200) DEFAULT NULL,
  `deskripsi` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `deskripsi`) VALUES
(1, 'A1', 'alternatif 1'),
(13, 'B2', 'data set 2'),
(14, 'B3', 'data set 2'),
(15, 'B4', 'data set 2'),
(2, 'A2', 'alternatif 2'),
(9, 'A7', 'alternatif 7'),
(10, 'A8', 'alternatif 8'),
(11, 'A9', 'alternatif 9'),
(12, 'B1', 'data set 2'),
(3, 'A3', 'alternatif 3'),
(4, 'A4', 'alternatif 4'),
(5, 'A5', 'alternatif 5'),
(8, 'A6', 'alternatif 6'),
(16, 'B5', 'data set 2'),
(17, 'B6', 'Data set 2'),
(18, 'B7', 'Data set 2'),
(19, 'B8', 'data set 2'),
(20, 'B9', 'data set 2'),
(21, 'C1', 'data set 3'),
(22, 'C2', 'data set 3'),
(23, 'C3', 'data set 3'),
(24, 'C4', 'data set 3'),
(25, 'C5', 'data set 3'),
(26, 'C6', 'data set 3'),
(27, 'C7', 'data set 3'),
(28, 'C8', 'data set 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif_kriteria`
--

CREATE TABLE `alternatif_kriteria` (
  `id_alternatif_kriteria` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif_kriteria`
--

INSERT INTO `alternatif_kriteria` (`id_alternatif_kriteria`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(25, 1, 1, 2900),
(2, 1, 2, 36),
(3, 1, 3, 2),
(4, 1, 4, 1),
(18, 4, 3, 1.2),
(6, 2, 1, 3400),
(7, 2, 2, 29),
(8, 2, 3, 1.3),
(9, 2, 4, 1),
(17, 4, 2, 28),
(11, 3, 1, 3350),
(12, 3, 2, 28),
(13, 3, 3, 1.2),
(14, 3, 4, 1),
(16, 4, 1, 4000),
(19, 4, 4, 1),
(20, 5, 1, 2200),
(21, 5, 2, 34),
(22, 5, 3, 1.2),
(23, 5, 4, 0.5),
(26, 8, 1, 2000),
(27, 8, 2, 34),
(28, 8, 3, 1.3),
(29, 8, 4, 1),
(30, 9, 1, 2500),
(31, 9, 2, 28),
(32, 9, 3, 1.2),
(33, 9, 4, 1),
(34, 10, 1, 2900),
(35, 10, 2, 26),
(36, 10, 3, 1.1),
(37, 10, 4, 1),
(38, 11, 1, 2850),
(39, 11, 2, 26),
(40, 11, 3, 1.1),
(41, 11, 4, 1),
(42, 12, 1, 2000),
(43, 12, 2, 30),
(44, 11, 3, 1.1),
(45, 12, 3, 1.1),
(46, 12, 4, 0.5),
(47, 13, 1, 1600),
(48, 13, 2, 39),
(49, 13, 3, 2.1),
(50, 13, 4, 0.5),
(51, 14, 1, 2100),
(52, 14, 2, 36),
(53, 14, 3, 2.2),
(54, 14, 4, 0.5),
(55, 15, 1, 2000),
(56, 15, 2, 39),
(57, 15, 3, 2),
(58, 15, 4, 0.25),
(59, 16, 1, 1800),
(60, 16, 2, 3.4),
(61, 16, 3, 1.2),
(62, 16, 4, 0.75),
(63, 17, 1, 500),
(64, 17, 2, 45),
(65, 17, 3, 1.5),
(66, 17, 4, 0.25),
(67, 18, 1, 1400),
(68, 18, 2, 40),
(69, 18, 3, 2),
(70, 18, 4, 0.75),
(71, 19, 1, 3000),
(72, 19, 2, 40),
(73, 19, 3, 2),
(74, 19, 4, 0.75),
(75, 20, 1, 1000),
(76, 20, 2, 38),
(77, 20, 3, 1.9),
(78, 20, 4, 1),
(79, 21, 1, 740),
(80, 21, 2, 37),
(81, 21, 3, 1.9),
(82, 21, 4, 1),
(83, 22, 1, 2350),
(84, 22, 2, 37),
(85, 22, 3, 1.9),
(86, 22, 4, 1),
(87, 23, 1, 1300),
(88, 23, 2, 37),
(89, 23, 3, 1.7),
(90, 23, 4, 0.75),
(91, 24, 1, 2100),
(92, 24, 2, 33),
(93, 24, 3, 1.4),
(94, 24, 4, 0.75),
(95, 25, 1, 2100),
(96, 25, 2, 32),
(97, 25, 3, 1.3),
(98, 25, 4, 0.75),
(99, 26, 1, 2150),
(100, 26, 2, 30),
(101, 26, 3, 1.3),
(102, 26, 4, 1),
(103, 27, 1, 1600),
(104, 27, 2, 28),
(105, 27, 3, 1.3),
(106, 27, 4, 1),
(107, 28, 1, 1500),
(108, 28, 2, 30),
(109, 28, 3, 1.1),
(110, 28, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'populasi', 0.18),
(2, 'umur', 0.3),
(3, 'berat', 0.2),
(4, 'kesehatan', 0.32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `alternatif_kriteria`
--
ALTER TABLE `alternatif_kriteria`
  ADD PRIMARY KEY (`id_alternatif_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `alternatif_kriteria`
--
ALTER TABLE `alternatif_kriteria`
  MODIFY `id_alternatif_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
