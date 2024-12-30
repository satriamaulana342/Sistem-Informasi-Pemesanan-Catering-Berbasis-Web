-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Sep 2024 pada 06.56
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_catering`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id_feedback` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id_feedback`, `nama_lengkap`, `email`, `pesan`) VALUES
(2, 'mudita', 'mudita@gmail.com', 'Penyajiannya tepat waktu dan kualitas makanannya juga baik sekali, terutama menu soto ayam kudusnya'),
(3, 'Rahayu', 'rahayu@gmail.com', 'Rasa masakannya istimewa terutama krecek tahu, dendeng balado dan waiternya pun sigap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id_item` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_item`
--

INSERT INTO `tbl_item` (`id_item`, `id_menu`, `nama_item`) VALUES
(1, 6, 'pisang'),
(2, 6, 'jeruk'),
(3, 2, 'nasi putih'),
(4, 2, 'nasi kuning'),
(5, 8, 'ayam goreng'),
(6, 8, 'Ayam Opor'),
(7, 10, 'Gulai'),
(9, 9, 'rendang'),
(10, 9, 'semur'),
(11, 1, 'Tongkol Balado'),
(12, 1, 'Ikan Bakar'),
(14, 6, 'apel'),
(15, 8, 'Ayam Teriyaki'),
(16, 8, 'ayam bumbu kecap'),
(17, 8, 'ayam asam manis'),
(18, 8, 'ayam bakar'),
(20, 19, 'kerupuk ikan'),
(21, 19, 'kerupuk sapi'),
(22, 17, 'soto bandung'),
(23, 16, 'bistik ayam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `custom_item` varchar(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kontrak`
--

CREATE TABLE `tbl_kontrak` (
  `id_kontrak` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `status_kontrak` enum('kontrak','tidak kontrak','habis kontrak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_kontrak`
--

INSERT INTO `tbl_kontrak` (`id_kontrak`, `id_user`, `tanggal_awal`, `tanggal_akhir`, `harga_paket`, `status_kontrak`) VALUES
(3, 4, '2024-08-01', '2024-09-01', 30000, 'habis kontrak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `kategori` enum('nasi kotak','prasmanan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `kategori`) VALUES
(1, 'ikan', 'nasi kotak'),
(2, 'nasi', 'nasi kotak'),
(6, 'buah', 'nasi kotak'),
(8, 'daging ayam', 'nasi kotak'),
(9, 'daging sapi', 'nasi kotak'),
(10, 'daging kambing', 'nasi kotak'),
(11, 'Sayur', 'nasi kotak'),
(14, 'lalapan', 'nasi kotak'),
(15, 'air mineral', 'nasi kotak'),
(16, 'main course', 'prasmanan'),
(17, 'soup/appetizer', 'prasmanan'),
(18, 'dessert', 'prasmanan'),
(19, 'pelengkap', 'prasmanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `id_paket` int(11) NOT NULL,
  `id_paket_kategori` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `minimal_pemesanan` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_paket`
--

INSERT INTO `tbl_paket` (`id_paket`, `id_paket_kategori`, `nama_paket`, `harga`, `minimal_pemesanan`, `foto`) VALUES
(1, 1, 'Paket 1 Aqiqah', 20000, 10, 'ikan-dory-saus-BBQ2.jpg'),
(2, 1, 'Paket 2 Aqiqah', 30000, 10, 'menu-ayam-goreng-mentega1.jpg'),
(3, 2, 'Paket 1 Pelatihan', 20000, 10, 'ikan-dory-saus-BBQ3.jpg'),
(4, 3, 'paket 1 pernikahan', 20000, 10, 'ikan-dory-saus-BBQ.jpg'),
(5, 4, 'paket 1 ulang tahun', 20000, 10, 'ikan-dory-saus-BBQ1.jpg'),
(6, 2, 'Paket 2 Pelatihan', 30000, 10, 'Ayam-Bumbu-Kecap4.jpg'),
(7, 3, 'Paket 2 Pernikahan', 30000, 10, 'Ayam-Goreng-Asam-Manis2.jpg'),
(8, 4, 'Paket 2 Ulang Tahun', 30000, 10, 'Ayam-Goreng-Sambal-Ijo1.jpg'),
(9, 1, 'Paket 3 Aqiqah', 40000, 10, 'Daging-Lada-Hitam2.jpg'),
(10, 2, 'Paket 3 Pelatihan', 40000, 10, 'Daging-Lada-Hitam21.jpg'),
(11, 3, 'Paket 3 Pernikahan', 40000, 10, 'Daging-Lada-Hitam22.jpg'),
(12, 4, 'Paket 3 Ulang Tahun', 40000, 10, 'Daging-Lada-Hitam23.jpg'),
(13, 1, 'Paket 4 Aqiqah', 50000, 10, 'Soto-Sulung-Daging-Sapi.jpg'),
(14, 2, 'Paket 4 Pelatihan', 50000, 10, 'Soto-Sulung-Daging-Sapi1.jpg'),
(15, 3, 'Paket 4 Pernikahan', 50000, 10, 'Soto-Sulung-Daging-Sapi2.jpg'),
(16, 4, 'Paket 4 Ulang Tahun', 50000, 10, 'Soto-Sulung-Daging-Sapi3.jpg'),
(17, 8, 'Prasmanan 1', 40000, 100, 'pras_1.jpeg'),
(18, 8, 'Prasmanan 2', 50000, 100, 'pras_2.jpeg'),
(19, 8, 'Prasmanan 3', 30000, 100, 'pras_3.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket_custom`
--

CREATE TABLE `tbl_paket_custom` (
  `id_paket_custom` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_paket_custom`
--

INSERT INTO `tbl_paket_custom` (`id_paket_custom`, `id_paket`, `id_menu`, `id_item`) VALUES
(1, 1, 6, 2),
(3, 1, 2, 4),
(5, 1, 1, 11),
(6, 1, 1, 12),
(7, 3, 6, 2),
(9, 2, 2, 4),
(10, 2, 6, 2),
(11, 1, 2, 3),
(12, 1, 6, 14),
(13, 1, 6, 1),
(14, 3, 6, 14),
(15, 3, 6, 1),
(16, 3, 2, 4),
(17, 3, 2, 3),
(18, 3, 1, 12),
(19, 3, 1, 11),
(20, 4, 6, 14),
(21, 4, 6, 2),
(22, 4, 6, 1),
(23, 4, 2, 4),
(24, 4, 2, 3),
(25, 4, 1, 12),
(26, 4, 1, 11),
(27, 5, 6, 14),
(28, 5, 6, 2),
(29, 5, 6, 1),
(30, 5, 2, 4),
(31, 5, 2, 3),
(32, 5, 1, 12),
(33, 5, 1, 11),
(34, 2, 6, 14),
(35, 2, 6, 1),
(36, 2, 2, 3),
(37, 2, 8, 17),
(38, 2, 8, 18),
(39, 2, 8, 16),
(40, 2, 8, 5),
(41, 2, 8, 6),
(42, 2, 8, 15),
(43, 6, 6, 14),
(44, 6, 6, 2),
(45, 6, 6, 1),
(46, 6, 2, 4),
(47, 6, 2, 3),
(48, 6, 8, 17),
(49, 6, 8, 18),
(50, 6, 8, 16),
(51, 6, 8, 5),
(52, 6, 8, 6),
(53, 6, 8, 15),
(54, 7, 6, 14),
(55, 7, 6, 2),
(56, 7, 6, 1),
(57, 7, 2, 4),
(58, 7, 2, 3),
(59, 7, 8, 17),
(61, 7, 8, 18),
(62, 7, 8, 16),
(63, 7, 8, 5),
(64, 7, 8, 6),
(65, 7, 8, 15),
(66, 8, 6, 14),
(67, 8, 6, 2),
(68, 8, 6, 1),
(69, 8, 2, 4),
(70, 8, 2, 3),
(71, 8, 8, 17),
(72, 8, 8, 18),
(73, 8, 8, 16),
(74, 8, 8, 5),
(75, 8, 8, 6),
(76, 8, 8, 15),
(77, 9, 6, 14),
(78, 9, 6, 2),
(79, 9, 6, 1),
(80, 9, 2, 4),
(81, 9, 2, 3),
(82, 9, 10, 7),
(83, 10, 6, 14),
(84, 10, 6, 2),
(85, 10, 6, 1),
(86, 10, 2, 4),
(87, 10, 2, 3),
(88, 10, 10, 7),
(89, 12, 6, 14),
(90, 12, 6, 2),
(91, 12, 6, 1),
(92, 12, 2, 4),
(93, 12, 2, 3),
(94, 12, 10, 7),
(95, 13, 6, 14),
(96, 13, 6, 2),
(97, 13, 6, 1),
(98, 13, 2, 4),
(99, 13, 2, 3),
(100, 13, 9, 9),
(101, 13, 9, 10),
(102, 14, 6, 14),
(103, 14, 6, 2),
(104, 14, 6, 1),
(105, 14, 2, 4),
(106, 14, 2, 3),
(107, 14, 9, 9),
(108, 14, 9, 10),
(109, 15, 6, 14),
(110, 15, 6, 2),
(111, 15, 6, 1),
(112, 15, 2, 4),
(113, 15, 2, 3),
(114, 15, 9, 9),
(115, 15, 9, 10),
(116, 16, 6, 14),
(117, 16, 6, 2),
(118, 16, 6, 1),
(119, 16, 2, 4),
(120, 16, 2, 3),
(121, 16, 9, 9),
(122, 16, 9, 10),
(124, 17, 19, 21),
(125, 17, 19, 20),
(126, 17, 17, 22),
(127, 17, 16, 23);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket_kategori`
--

CREATE TABLE `tbl_paket_kategori` (
  `id_paket_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_paket_kategori`
--

INSERT INTO `tbl_paket_kategori` (`id_paket_kategori`, `nama_kategori`) VALUES
(1, 'aqiqah'),
(2, 'pelatihan'),
(3, 'pernikahan'),
(4, 'ulang tahun'),
(8, 'prasmanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket_menu`
--

CREATE TABLE `tbl_paket_menu` (
  `id_paket_menu` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_paket_menu`
--

INSERT INTO `tbl_paket_menu` (`id_paket_menu`, `id_paket`, `id_menu`, `deskripsi`) VALUES
(1, 1, 1, ''),
(2, 1, 2, ''),
(4, 1, 6, ''),
(5, 3, 6, ''),
(6, 3, 1, ''),
(7, 3, 2, ''),
(8, 4, 6, ''),
(9, 5, 6, ''),
(10, 2, 2, ''),
(12, 1, 14, ''),
(13, 1, 11, ''),
(14, 3, 14, ''),
(15, 3, 11, ''),
(16, 4, 1, ''),
(17, 4, 14, ''),
(18, 4, 2, ''),
(19, 4, 11, ''),
(20, 5, 1, ''),
(21, 5, 14, ''),
(22, 5, 2, ''),
(23, 5, 11, ''),
(24, 2, 15, ''),
(25, 2, 6, ''),
(26, 2, 14, ''),
(27, 2, 10, ''),
(28, 2, 11, ''),
(29, 9, 15, ''),
(30, 9, 6, ''),
(31, 9, 10, ''),
(32, 9, 14, ''),
(33, 9, 2, ''),
(34, 9, 11, ''),
(35, 13, 15, ''),
(36, 13, 6, ''),
(37, 13, 10, ''),
(38, 13, 14, ''),
(39, 13, 2, ''),
(40, 13, 11, ''),
(41, 6, 15, ''),
(42, 6, 6, ''),
(43, 6, 8, ''),
(44, 6, 14, ''),
(45, 6, 2, ''),
(46, 6, 11, ''),
(47, 10, 15, ''),
(48, 10, 6, ''),
(49, 10, 10, ''),
(50, 10, 14, ''),
(51, 10, 2, ''),
(52, 10, 11, ''),
(53, 14, 15, ''),
(54, 14, 6, ''),
(55, 14, 9, ''),
(56, 14, 14, ''),
(57, 14, 2, ''),
(58, 14, 11, ''),
(59, 7, 15, ''),
(60, 7, 6, ''),
(61, 7, 8, ''),
(62, 7, 14, ''),
(63, 7, 2, ''),
(64, 7, 11, ''),
(65, 11, 15, ''),
(66, 11, 6, ''),
(67, 11, 10, ''),
(68, 11, 14, ''),
(69, 11, 2, ''),
(70, 11, 11, ''),
(71, 15, 15, ''),
(72, 15, 6, ''),
(73, 15, 9, ''),
(74, 15, 14, ''),
(75, 15, 2, ''),
(76, 15, 11, ''),
(77, 8, 15, ''),
(78, 8, 6, ''),
(79, 8, 8, ''),
(80, 8, 14, ''),
(81, 8, 2, ''),
(82, 8, 11, ''),
(83, 12, 15, ''),
(84, 12, 6, ''),
(85, 12, 10, ''),
(86, 12, 14, ''),
(87, 12, 2, ''),
(88, 12, 11, ''),
(89, 16, 15, ''),
(90, 16, 6, ''),
(91, 16, 9, ''),
(92, 16, 14, ''),
(93, 12, 2, ''),
(94, 16, 11, ''),
(95, 17, 16, 'NASI PUTIH \r\n\r\nFETTUCINI CARBONARA\r\n\r\nBISTIK AYAM\r\n\r\nSWEET AND SOUR DORY FISH\r\n\r\nSAPO TAHU'),
(96, 17, 17, 'SOUP JAGUNG\r\nsoto bandung'),
(97, 17, 18, 'JAJANAN PASAR 50%\r\n\r\nANEKA BUAH POTONG SEGAR 50%'),
(98, 17, 19, 'KERUPUK \r\nSAMBAL \r\nACAR, PERALATAN MAKAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembatalan_pesanan`
--

CREATE TABLE `tbl_pembatalan_pesanan` (
  `id_pembatalan_pesanan` int(11) NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `kode_pesanan` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pemesanan` datetime DEFAULT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `waktu_pengiriman` time NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `opsi_pembayaran` varchar(100) NOT NULL,
  `uang_muka` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `sisa_pembayaran` int(11) NOT NULL,
  `status_pembayaran` varchar(100) DEFAULT 'tidak diterima',
  `status_pengiriman` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `keterangan_ditolak` text DEFAULT NULL,
  `batas_waktu_upload` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan_detail`
--

CREATE TABLE `tbl_pesanan_detail` (
  `id_pesanan_detail` int(11) NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `custom_item` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan_detail_perusahaan`
--

CREATE TABLE `tbl_pesanan_detail_perusahaan` (
  `id_pesanan_detail_perusahaan` int(11) NOT NULL,
  `id_pesanan_perusahaan` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `custom_item` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan_perusahaan`
--

CREATE TABLE `tbl_pesanan_perusahaan` (
  `id_pesanan_perusahaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `waktu_pengiriman` time NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `status_pengiriman` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id_reset_password` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_pesanan` varchar(10) NOT NULL,
  `bukti_transfer_lunas` varchar(255) DEFAULT NULL,
  `tgl_transfer_lunas` date DEFAULT NULL,
  `bukti_transfer_dp_awal` varchar(255) DEFAULT NULL,
  `tgl_transfer_dp_awal` date DEFAULT NULL,
  `bukti_transfer_dp_akhir` varchar(255) DEFAULT NULL,
  `tgl_transfer_dp_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_role`, `nama_lengkap`, `email`, `no_telp`, `password`, `is_active`, `date_created`) VALUES
(1, 1, 'staff administrasi umum', 'satriamaulana716@gmail.com', '085156469347', '$2y$10$noy4EHnAwbVAMjzpewdG1.CyUmCINVX1Cuukr.sCgWV2bli80gHsi', 1, '22:46:46'),
(2, 3, 'direktur', 'theskinner342@gmail.com', '085156469348', '$2y$10$40pge/EL86NhHlWP8B7fYuF0VmREAFB3tRDO.iE/t7GnfxlqqW5Ym', 1, '22:48:31'),
(3, 2, 'satria', 'satria.10520730@mahasiswa.unikom.ac.id', '085156469349', '$2y$10$tY5WPcmtW8/l90LflV3ILu0LFTj3uG8Is2prRxOvSFtWCSiifyB2K', 1, '22:50:11'),
(4, 4, 'PT TOTO', 'akmal.10520708@mahasiswa.unikom.ac.id', '085156469341', '$2y$10$3YTYmVyB1NbM93vWSKd9wefppYpohZ5T/ZR/Qk5rvWPqcoqmXjh0K', 1, '22:53:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id_role`, `role`) VALUES
(1, 'Staff Administrasi Umum'),
(2, 'User'),
(3, 'Direktur'),
(4, 'Perusahaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_token`
--

CREATE TABLE `tbl_user_token` (
  `id_user_token` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indeks untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_menu` (`id_menu`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_user` (`id_user`) USING BTREE,
  ADD KEY `fk_paket` (`id_paket`);

--
-- Indeks untuk tabel `tbl_kontrak`
--
ALTER TABLE `tbl_kontrak`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `f_u` (`id_user`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `fk_paket_kategori` (`id_paket_kategori`);

--
-- Indeks untuk tabel `tbl_paket_custom`
--
ALTER TABLE `tbl_paket_custom`
  ADD PRIMARY KEY (`id_paket_custom`),
  ADD KEY `fk_item` (`id_item`),
  ADD KEY `fk_pakettt` (`id_paket`),
  ADD KEY `fk_menuuu` (`id_menu`);

--
-- Indeks untuk tabel `tbl_paket_kategori`
--
ALTER TABLE `tbl_paket_kategori`
  ADD PRIMARY KEY (`id_paket_kategori`);

--
-- Indeks untuk tabel `tbl_paket_menu`
--
ALTER TABLE `tbl_paket_menu`
  ADD PRIMARY KEY (`id_paket_menu`),
  ADD KEY `fk_pakett` (`id_paket`),
  ADD KEY `fk_menuu` (`id_menu`);

--
-- Indeks untuk tabel `tbl_pembatalan_pesanan`
--
ALTER TABLE `tbl_pembatalan_pesanan`
  ADD PRIMARY KEY (`id_pembatalan_pesanan`),
  ADD KEY `fk_pss` (`kode_pesanan`);

--
-- Indeks untuk tabel `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`kode_pesanan`),
  ADD KEY `fk_userr` (`id_user`);

--
-- Indeks untuk tabel `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  ADD PRIMARY KEY (`id_pesanan_detail`),
  ADD KEY `fk_paketttt` (`id_paket`),
  ADD KEY `fk_pesanan` (`kode_pesanan`);

--
-- Indeks untuk tabel `tbl_pesanan_detail_perusahaan`
--
ALTER TABLE `tbl_pesanan_detail_perusahaan`
  ADD PRIMARY KEY (`id_pesanan_detail_perusahaan`),
  ADD KEY `f_pp` (`id_pesanan_perusahaan`),
  ADD KEY `f_p` (`id_paket`);

--
-- Indeks untuk tabel `tbl_pesanan_perusahaan`
--
ALTER TABLE `tbl_pesanan_perusahaan`
  ADD PRIMARY KEY (`id_pesanan_perusahaan`),
  ADD KEY `fk_uu` (`id_user`);

--
-- Indeks untuk tabel `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id_reset_password`),
  ADD KEY `fk_userrrrr` (`id_user`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_kp` (`kode_pesanan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_role` (`id_role`);

--
-- Indeks untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD PRIMARY KEY (`id_user_token`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `tbl_kontrak`
--
ALTER TABLE `tbl_kontrak`
  MODIFY `id_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_paket_custom`
--
ALTER TABLE `tbl_paket_custom`
  MODIFY `id_paket_custom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT untuk tabel `tbl_paket_kategori`
--
ALTER TABLE `tbl_paket_kategori`
  MODIFY `id_paket_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_paket_menu`
--
ALTER TABLE `tbl_paket_menu`
  MODIFY `id_paket_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembatalan_pesanan`
--
ALTER TABLE `tbl_pembatalan_pesanan`
  MODIFY `id_pembatalan_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  MODIFY `id_pesanan_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan_detail_perusahaan`
--
ALTER TABLE `tbl_pesanan_detail_perusahaan`
  MODIFY `id_pesanan_detail_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan_perusahaan`
--
ALTER TABLE `tbl_pesanan_perusahaan`
  MODIFY `id_pesanan_perusahaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id_reset_password` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  MODIFY `id_user_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id_menu`);

--
-- Ketidakleluasaan untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `fk_paket` FOREIGN KEY (`id_paket`) REFERENCES `tbl_paket` (`id_paket`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD CONSTRAINT `fk_paket_kategori` FOREIGN KEY (`id_paket_kategori`) REFERENCES `tbl_paket_kategori` (`id_paket_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
