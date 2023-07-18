-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2023 pada 08.55
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `time_in` date NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `bulan` varchar(11) NOT NULL,
  `tahun` varchar(11) NOT NULL,
  `keterangan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Katolik'),
(4, 'Hindu'),
(5, 'Budha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X TKJ 2'),
(10, 'X TKJ 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(5, 'Simulasi Digital'),
(6, 'Sistem Komputer'),
(7, 'Komputer & Jaringan Dasar '),
(8, 'Teknologi Jaringan Layanan'),
(9, 'Dasar Desain Grafis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_guru`
--

CREATE TABLE `mapel_guru` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mapel_guru`
--

INSERT INTO `mapel_guru` (`id`, `mapel_id`, `user_id`, `created_at`) VALUES
(10, 8, 50, '2023-07-17 10:46:49'),
(11, 9, 50, '2023-07-17 10:46:49'),
(14, 7, 52, '2023-07-17 10:53:07'),
(15, 9, 52, '2023-07-17 10:53:07'),
(35, 5, 53, '2023-07-17 11:39:08'),
(36, 6, 53, '2023-07-17 11:39:08'),
(37, 7, 53, '2023-07-17 11:39:08'),
(38, 8, 53, '2023-07-17 11:39:08'),
(39, 9, 53, '2023-07-17 11:39:08'),
(43, 6, 37, '2023-07-17 15:48:08'),
(44, 8, 37, '2023-07-17 15:48:08'),
(45, 9, 37, '2023-07-17 15:48:08'),
(46, 7, 51, '2023-07-17 15:53:56'),
(47, 8, 51, '2023-07-17 15:53:56'),
(48, 9, 51, '2023-07-17 15:53:56'),
(49, 6, 54, '2023-07-17 16:16:21'),
(50, 8, 54, '2023-07-17 16:16:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap`
--

CREATE TABLE `rekap` (
  `id_rekap` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `time_rekap` int(11) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_absen`
--

CREATE TABLE `rekap_absen` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `created` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_agama`, `id_kelas`, `id_status`, `nis`, `nama`, `no_hp`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`) VALUES
(11, 1, 2, 0, '0123456789', 'Muhammad Soleh', '082285639924', 'Jln. Buncis Aimas', 'Kaimana', '', 'Laki-laki'),
(13, 3, 2, 0, '0123456777', 'Dina Aninam', '082285639924', 'Jln. Ahmad yani', 'Sorong', '04/06/2005', 'Perempuan'),
(14, 1, 2, 0, '0123456781', 'Sugianto', '082285639924', 'Jln. Lumba-lumba', 'Sorong', '05/04/2005', 'Laki-laki'),
(15, 1, 2, 0, '0123456765', 'Benyamin Cahyono', '085601133391', 'Jln. Yos sudarso', 'Sorong', '02/14/2005', 'Laki-laki'),
(16, 1, 1, 0, '0123456782', 'Fitria Nur Astuti', '082398716465', 'Jln. Mawar', 'Sorong', '01/31/2005', 'Perempuan'),
(17, 3, 1, 0, '0123456712', 'Delianti Ningsih', '082398716460', 'Jln. Rambutan', 'Sorong', '04/10/2005', 'Perempuan'),
(18, 2, 1, 0, '0123456783', 'Hendrawan', '082298546263', 'Jln. Sudirman', 'Sorong', '05/02/2005', 'Laki-laki'),
(19, 3, 1, 0, '0123456784', 'Yedit Forno', '082197526465', 'Jln. Sudirman', 'Sorong', '05/05/2005', 'Perempuan'),
(20, 2, 1, 0, '0123456785', 'Santi', '081365828374', 'Jln. Gambas', 'Sorong', '06/20/2005', 'Perempuan'),
(21, 2, 10, 0, '0123456786', 'Anny Urbinas', '081365828390', 'Jln. Mawar', 'Sorong', '07/17/2005', 'Perempuan'),
(22, 3, 10, 0, '0123456787', 'Yuli Petronela', '6285866060023', 'Jln. Timun', 'Sorong', '03/28/2005', 'Perempuan'),
(23, 2, 10, 0, '0123455667', 'Ovalin ', '081365827678', 'Jln. Osok', 'Sorong', '03/02/2005', 'Perempuan'),
(24, 1, 10, 0, '0123455778', 'Muhammad Irfan', '081298737654', 'Jln. Perkutut', 'Sorong', '04/25/2005', 'Laki-laki'),
(25, 2, 10, 0, '0123456772', 'Mario', '081298737698', 'Jln. Kentang', 'Sorong', '04/11/2005', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Mahasiswa'),
(2, 'PNS'),
(3, 'Tenaga Honor'),
(4, 'Sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tipe` int(11) NOT NULL,
  `submit_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_mapel`, `id_kelas`, `id_agama`, `id_status`, `nip`, `nama`, `username`, `password`, `no_hp`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `file`, `tipe`, `submit_at`) VALUES
(1, 0, 0, 1, 1, '148320716025', 'Fitri Febry Irianti', 'admin', '$2y$10$UJonY5JekA/8u9c65liGvOsiLIp0hzY9EEn7gdy4CbzyT5yYI/qBq', '082198516263', 'Jl. Mawar, Mariat Pantai, Aimas', 'Sorong', '', 'Perempuan', '', 99, 0),
(17, 0, 8, 0, 4, '4567898765', 'Dimas', '4567898765', '$2y$10$fcWmdx3DSpRkjTPCV84tIuv11h.yQRKWXqaFDjCQ/JJFf0H7hS016', '0987654356', '', '', NULL, 'Laki-laki', NULL, 77, 1597159864),
(30, 0, 2, 0, 4, '0123456789', 'Muhammad Soleh', '0123456789', '$2y$10$EwpwzYlAFjJ7nwu1Qjzp6e1vdoSRZcSujisZ/IdC9tqDsST5keWoC', '082187526364', '', '', NULL, 'Laki-laki', NULL, 77, 1599704610),
(31, 0, 10, 0, 4, '0123455778', 'Muhammad Irfan', '0123455778', '$2y$10$HGtUj.A66vHcdNQP4toUne9b/KVKwOKJusCfy1UVE4YGVVKpnnQ0u', '081298737654', '', '', NULL, 'Laki-laki', NULL, 77, 1599704676),
(33, 5, 0, 1, 0, '123456789101112131', 'Ajeng Ravina Yolanda', 'ajeng', '$2y$10$/LIUa6QplCp0KyDLLSqfhOB4iroHGQVpCCkKZ68VaR/fi37SiAMHi', '081276516264', 'Jln. Cempedak', 'Sorong', '', 'Perempuan', NULL, 88, 1599746418),
(34, 6, 0, 1, 0, '989898989898989898', 'Muhammad Rahmatul Fauzi', 'fauzi', '$2y$10$4wY7RFBwIS86QzYqSoiWV.GytljDSECMdYUT/jPkM..S7aVHJL5B.', '082276516263', 'Jln. Makbon', 'Sorong', '', 'Laki-laki', NULL, 88, 1599747051),
(35, 7, 0, 2, 2, '123456789101112133', 'Hesty Ningsih Huwae', 'hesty', '$2y$10$zKwET7PGsPMDPr2TyhJtmuEXESaM.GU1Tb.oFpou1FhACJSObT8Di', '082189514345', 'Jln. Baru', 'Sorong', '', 'Perempuan', NULL, 88, 1688144158),
(36, 7, 0, 1, 0, '979797979797979797', 'Fazrin Alfino', 'fazrin', '$2y$10$A5ILurzwMQSS0JPAm9xfDO8cLER2Cr7ytCR0moIZrvxYsXF7wKAPu', '081344657678', 'Jln. Melati', 'Sorong', '', 'Laki-laki', NULL, 88, 1599748290),
(37, 0, 0, 1, 2, '123456789012345678', 'Trio Nurdianto', 'trio', '$2y$10$y9KaoDohxQa9itx8mpYze.V0kEPDN3V7pthjcyDV/16G7d4puV8iW', '081344657670', 'Jln. Mawar', 'Sorong', '07/13/2023', 'Laki-laki', NULL, 88, 1689583688),
(38, 5, 0, 1, 0, '123456789011111111', 'Ajeng Ravina Yolanda', 'ravina', '$2y$10$Op2g0x6EH0RPQSL0FltGuumLL46MyedKif.Fla2P1e9RO6cR5A4UG', '081344656560', 'Jln. Cempedak', 'Sorong', '', 'Perempuan', NULL, 88, 1599748457),
(40, 5, 0, 1, 0, '123456789987654321', 'Ajeng Ravina', 'jeng', '$2y$10$ku4iSVUomPZwK3.2eRo5LeL2P6z7qGzlNGstfsFuMMI6RbR5ABP8q', '081344517273', 'Jln. Cempedak', 'Sorong', '', 'Perempuan', NULL, 88, 1599774464),
(41, 9, 0, 1, 2, '987654321123456789', 'Fazrin Alfino Larat', 'fino', '$2y$10$nJbr0/0KAMVFCVZr9HVG4Ohm3KyWpKEqA828TtXQSjdDpB7HuXd1S', '081344517092', 'Jln. Srikaya', 'Sorong', '', 'Laki-laki', NULL, 88, 1599774574),
(42, 5, 0, 1, 2, '020419981234567899', 'Fitri Febry Irianti', 'febry', '$2y$10$4NeXcQK5UFUaLoRyG8T/OObKsg4gqJanZGvGyHGO7HoNABIuZlf.i', '082198516263', 'Jln. Mawar', 'Sorong', '', 'Perempuan', NULL, 88, 1599774831),
(43, 8, 0, 1, 2, '123456789123456789', 'Muhammad Rahmatul Fauzi', 'uji', '$2y$10$C2LhKOV2PYry9OeO5axGh.aaIWfAypUU9Zv8ktHfb.2GXgXYfqkAi', '082298516465', 'Jln. Makbon', 'Sorong', '', 'Laki-laki', NULL, 88, 1600250413),
(44, 0, 12, 0, 4, '1234455668', 'Khasanah', '1234455668', '$2y$10$g4MuAgDbiAjydhQQnAZ7eOVUPodYg4yn7MD/gLd6oo6guQPbxKBDW', '08243545454', '', '', NULL, 'Perempuan', NULL, 77, 1600304922),
(45, 0, 0, 1, 2, '329872398798273897', '32872397', '79879238787', '$2y$10$.M1cwdXz/iLI4znPSBtrC.hBNn5XXdQH5qopmdBp6kQbBLy8FkyT.', '9837298729', '98729387', '9238798', '07/09/2023', 'Laki-laki', NULL, 88, 1689563873),
(46, 0, 0, 1, 2, '239872389723979827', '3298798', '98798', '$2y$10$vvXPDs3EwxowD3b4gEmEd.stuXs4joIxiQZ9PjwJb/75GtDb6CZ06', '79879', '8798', 'jakarta', '07/04/2023', 'Laki-laki', NULL, 88, 1689564140),
(47, 0, 0, 1, 2, '728192810281029382', '2398798', '987', '$2y$10$M9OBCg7GKpsjv3pYXniIouazneBbZZlbydiEPhq0/7TijR6id/QnC', '9879', '797', 'jakarta', '07/04/2023', 'Laki-laki', NULL, 88, 1689564251),
(48, 0, 0, 1, 2, '239872837987298798', '938879879', '8798798', '$2y$10$nA9kcPoXzdCljIlsOiyM9ObUEUlKlfy1ymtGJgSwCKF5JsvbTAn8q', '7987', '98798', 'jakarta', '06/27/2023', 'Laki-laki', NULL, 88, 1689564371),
(49, 0, 0, 1, 2, '348732987239872389', '8309', '98309', '$2y$10$rGvpHolkigtY0VGaJrAjQuMm7k6Zw0NjgBlnsoQVnx0cGlOeweadq', '09820980', '98098', 'jakarta', '07/10/2023', 'Laki-laki', NULL, 88, 1689564643),
(50, 0, 0, 1, 2, '398272938723798798', '98798', '987987', '$2y$10$j7bfl5c1S3RhtbLQXFqRK.nbbL5LnDFmygGA8GRLe7wE4SoRkIWGm', '987987', '98798797', 'jakarta', '07/04/2023', 'Laki-laki', NULL, 88, 1689565609),
(51, 0, 0, 1, 2, '329872938798237992', '98327982987', '98398', '$2y$10$wcwnDTQ6jdY1PK3J12kETeSVXUWk8J5GMSV8UK95zYjnbBacgeMwu', '98398', '79832987', 'jakarta', '07/05/2023', 'Laki-laki', NULL, 88, 1689584036),
(52, 0, 0, 1, 2, '7867899879', '98237', '9839898', '$2y$10$WYR9./Y1RgJuT/77uVLNx.NRhFlgMNTu3XCNshmtaS7.cG.73rF4C', '92889239', '93892389', 'jakarta', '07/03/2023', 'Laki-laki', NULL, 88, 1689567020),
(53, 0, 0, 1, 2, '123463873828208210', 'satu', '3982398', '$2y$10$3AzIJ4DEVfs2tnFqlD2U2ew7669JEU2PvoVCVPmzeB3lP5dW8Bf4i', '298298210', 'jakarta', 'jakarta', '06/29/2023', 'Laki-laki', NULL, 88, 1689568748),
(54, 0, 0, 1, 2, '878236982379723987', 'user satu', '123', '$2y$10$3fES9cVeF6wOvtygbczz.ek0a.so1Efxw1zEvuNHcEsIxrTb9bXaS', '9238872938', 'jakarta', 'jakarta', '07/05/2023', 'Laki-laki', NULL, 88, 1689585381);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `mapel_guru`
--
ALTER TABLE `mapel_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Indeks untuk tabel `rekap_absen`
--
ALTER TABLE `rekap_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_mapel` (`id_mapel`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT untuk tabel `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mapel_guru`
--
ALTER TABLE `mapel_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap_absen`
--
ALTER TABLE `rekap_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
