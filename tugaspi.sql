-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2025 pada 11.29
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugaspi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buta_warna`
--

CREATE TABLE `buta_warna` (
  `id` int(3) NOT NULL,
  `file` varchar(50) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `jawaban` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buta_warna`
--

INSERT INTO `buta_warna` (`id`, `file`, `jenis`, `jawaban`) VALUES
(1, 'img/hijau.png', 'hijau', '11'),
(2, 'img/Circled Number5.png', 'hijau', '5'),
(3, 'img/deu3.png', 'hijau', '5'),
(4, 'img/deu4.png', 'hijau', '20'),
(5, 'img/Circled Number22.png', 'hijau', '22'),
(7, 'img/Circled Number2.png', 'hijau', '2'),
(8, 'img/deu8.png', 'hijau', '17'),
(9, 'img/deu9.png', 'hijau', '7'),
(10, 'img/deu10.png', 'hijau', '27'),
(11, 'img/pro1.png', 'merah', '3'),
(12, 'img/pro2.png', 'merah', '60'),
(13, 'img/Circled Number3.png', 'merah', '3'),
(14, 'img/Circled Number9 (1).png', 'merah', '9'),
(15, 'img/Circled Number23 (1).png', 'merah', '23'),
(16, 'img/Circled Number4.png', 'merah', '4'),
(17, 'img/Circled Number6.png', 'merah', '6'),
(18, 'img/Circled Number18.png', 'merah', '18'),
(19, 'img/pro9.png', 'merah', '10'),
(20, 'img/pro10.png', 'merah', '11'),
(21, 'img/tri1.png', 'biru', '9'),
(22, 'img/tri2.png', 'biru', '4'),
(23, 'img/tri3.png', 'biru', '5'),
(24, 'img/tri4.png', 'biru', '17'),
(25, 'img/tri5.png', 'biru', '1'),
(26, 'img/tri6.png', 'biru', '8'),
(27, 'img/tri7.png', 'biru', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(2) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `diagnosa` varchar(25) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `jenis`, `diagnosa`, `ket`) VALUES
(1, 'Abnormal', 'Protanomali', 'merupakan kelemahan warna merah'),
(2, 'Abnormal', 'Deuteranomali', ' kelemahan warna hijau.'),
(3, 'Abnormal', 'Tritanomali', 'kelemahan warna biru.'),
(4, 'Dikromasi', 'Protanopia', 'jenis buta warna di mana sel-sel kerucut yang peka terhadap warna merah tidak berfungsi dengan baik. Orang yang menderita protanopia tidak dapat melihat warna merah.'),
(5, 'Dikromasi', 'Deuteranopia', 'jenis buta warna hijau di mana sel-sel kerucut yang peka terhadap warna hijau tidak berfungsi dengan baik. Orang yang menderita deuteranopia tidak dapat melihat warna hijau.'),
(6, 'Dikromasi', 'Tritanopia', 'jenis buta warna biru di mana sel-sel kerucut yang peka terhadap warna biru tidak berfungsi dengan baik. Orang yang menderita tritanopia tidak dapat melihat warna biru.'),
(7, 'Akromasi', 'Akromasi', 'dikenal sebagai buta warna total, adalah kondisi di mana seseorang tidak bisa melihat warna sama sekali. Semua yang mereka lihat hanyalah nuansa abu-abu.'),
(8, 'Trikromasi', 'Normal', 'Anda memiliki persepsi warna yang normal');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `buta_warna`
--
ALTER TABLE `buta_warna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `buta_warna`
--
ALTER TABLE `buta_warna`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
