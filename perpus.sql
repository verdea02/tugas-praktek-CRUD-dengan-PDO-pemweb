-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2022 pada 11.23
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `Id_buku` int(11) NOT NULL,
  `Judul` varchar(50) NOT NULL,
  `Penulis` varchar(50) NOT NULL,
  `Penerbit` varchar(50) NOT NULL,
  `Tahun_terbit` year(4) NOT NULL,
  `Cover_buku` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`Id_buku`, `Judul`, `Penulis`, `Penerbit`, `Tahun_terbit`, `Cover_buku`) VALUES
(22, 'alice in wonderland', 'lewis carroll', 'Project Gutenberg', 1991, '04-24-22.11-08-15.julyalice19319.jpg'),
(23, 'The Adventures of Sherlock Holmes', 'Arthur Conan Doyle', 'The Project Gutenberg', 2002, '04-24-22.11-11-41.10047597.jpg'),
(24, 'Scooby-Doo! & the monster menace', 'Earl Kress', 'London : Titan', 2005, '04-24-22.11-15-14.1840239999.jpg'),
(25, 'The weather disaster', 'McElligott, Matthew', 'New York : Crown Books for Young Readers', 2016, '04-24-22.11-17-56.A17sAaEe43L.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `Id_peminjaman` int(11) NOT NULL,
  `nama_peminjam` varchar(25) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `waktu_peminjaman` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`Id_peminjaman`, `nama_peminjam`, `judul_buku`, `waktu_peminjaman`) VALUES
(5, 'fikri', 'alice in wonderland', '2022-04-24 09:19:51'),
(6, 'ahmad', 'alice in wonderland', '2022-04-24 09:19:57'),
(7, 'dito', 'Scooby-Doo! & the monster menace', '2022-04-24 09:20:04'),
(8, 'husain', 'The Adventures of Sherlock Holmes', '2022-04-24 09:20:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `Id_user` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `Hak_akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`Id_user`, `Username`, `Password`, `Hak_akses`) VALUES
(5, 'admin', 'admin', 'admin'),
(6, 'admin2', 'admin2', 'admin'),
(7, 'anggota', 'anggota', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`Id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`Id_peminjaman`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `Id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `Id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
