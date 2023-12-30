-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2023 pada 14.17
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_emading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel`
--

CREATE TABLE `tb_artikel` (
  `id` int(4) NOT NULL,
  `judul` varchar(360) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `status` enum('publish','draft') NOT NULL,
  `id_user` int(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_artikel`
--

INSERT INTO `tb_artikel` (`id`, `judul`, `deskripsi`, `isi`, `gambar`, `status`, `id_user`, `created_at`, `updated_at`) VALUES
(11, 'Panji Sang Petualang', 'Cerita epik seorang pemuda yang berhasil mengatasi tantangan hewan-hewan liar dan buas', '                                <span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px; text-align: justify;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classica</span>Masukkan isi artikel\r\n                                        ', 'bhayangkari.png', 'draft', 1, NULL, NULL),
(12, 'Jejak Petualang', 'Petualangan anak bangsa menjelajahi keindahan alam Indonesia mengeksplorasi pesona alam', '<h1 style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 70px; line-height: 90px; color: rgb(0, 0, 0); text-align: center;\">Lorem Ipsum</h1><h4 style=\"margin: 10px 10px 5px; padding: 0px; font-size: 14px; line-height: 18px; text-align: center; font-style: italic; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"</h4><h5 style=\"margin: 5px 10px 20px; padding: 0px; font-size: 12px; line-height: 14px; text-align: center; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"</h5>', 'beruang.jpg', 'publish', 5, NULL, NULL),
(14, 'Eye Shield 21', 'Kisah tim rugby negeri sakura yang berjuang untuk menang.', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Where does it come from?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum</p>', 'download.png', 'publish', 1, '2023-12-30 10:33:53', '2023-12-30 10:33:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(4) NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Haikal Fajari', 'Haikal15', 'e850a6d4c78da4c42e9863aed5f6d63c', '2023-12-29 14:29:36', '2023-12-29 14:29:36'),
(5, 'Arif Pangestu', 'Arif12345', 'd53d757c0f838ea49fb46e09cbcc3cb1', NULL, '2023-12-30 08:45:23'),
(10, 'Muhammad Hatami', 'Hatami12345', '539a74bf1ef7b30f466195d94ed44717', '2023-12-30 00:00:00', '2023-12-30 08:41:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_artikel`
--
ALTER TABLE `tb_artikel`
  ADD CONSTRAINT `tb_artikel_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
