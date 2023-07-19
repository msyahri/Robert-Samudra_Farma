-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2023 pada 03.33
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_robert`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` varchar(25) NOT NULL,
  `barang_satuan` varchar(30) DEFAULT 'unit',
  `barang_harpok` double DEFAULT NULL,
  `barang_har_srp` double DEFAULT NULL,
  `barang_har_srp_pot` double DEFAULT NULL COMMENT 'srp promo',
  `barang_harmin` double DEFAULT NULL COMMENT 'harga minimal',
  `barang_harmax` double DEFAULT NULL COMMENT 'harga maximal',
  `barang_stok` int(11) DEFAULT 1,
  `barang_min_stok` int(11) DEFAULT 1,
  `barang_tgl_input` timestamp NULL DEFAULT current_timestamp(),
  `barang_tgl_last_update` datetime DEFAULT NULL,
  `barang_merek_id` double DEFAULT NULL,
  `barang_user_id` int(11) DEFAULT NULL,
  `barang_warna` varchar(50) DEFAULT NULL,
  `toko_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0 = sold1 = available (JAVASCRIPT)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`barang_id`, `barang_satuan`, `barang_harpok`, `barang_har_srp`, `barang_har_srp_pot`, `barang_harmin`, `barang_harmax`, `barang_stok`, `barang_min_stok`, `barang_tgl_input`, `barang_tgl_last_update`, `barang_merek_id`, `barang_user_id`, `barang_warna`, `toko_id`, `status`) VALUES
('1', 'Pcs', 1000, 2500, 2000, 2000, 3000, 100, 10, '2023-02-01 04:01:56', NULL, 845, 1, '1', 0, 1),
('BRG-001', 'unit', 40000, 2000, NULL, 50000, 57000, 100, 1, '2023-07-09 16:23:08', NULL, 845, 1, '1', 0, 1),
('BRG-0012', 'unit', 40000, 2000, NULL, 70000, 10000, 10, 1, '2023-07-19 02:58:45', NULL, 1, 1, '1', 0, 1),
('BRG-002', 'unit', 40000, 2000, NULL, 70000, 100000, 100, 1, '2023-07-09 16:31:58', NULL, 1, 1, '1', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_beli`
--

CREATE TABLE `tbl_beli` (
  `beli_nofak` varchar(25) DEFAULT NULL,
  `beli_tanggal` date DEFAULT NULL,
  `beli_suplier_id` int(11) DEFAULT NULL,
  `beli_user_id` int(11) DEFAULT NULL,
  `beli_kode` varchar(15) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `beli_pembayaran` varchar(30) DEFAULT NULL,
  `beli_tempo` date DEFAULT NULL COMMENT 'jatuh tempo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_beli`
--

INSERT INTO `tbl_beli` (`beli_nofak`, `beli_tanggal`, `beli_suplier_id`, `beli_user_id`, `beli_kode`, `timestamp`, `beli_pembayaran`, `beli_tempo`) VALUES
('10/6/23/1', '2023-07-10', 101, 1, 'BL090723000001', '2023-07-09 16:23:08', 'Tunai', '0000-00-00'),
('10/6/23/10', '2023-07-10', 101, 1, 'BL090723000002', '2023-07-09 16:31:58', 'Tunai', '0000-00-00'),
('10/6/23/1', '2023-07-19', 101, 1, 'BL190723000001', '2023-07-19 02:57:52', 'Tunai', '0000-00-00'),
('10/6/23/1', '2023-07-19', 101, 1, 'BL190723000002', '2023-07-19 02:58:09', 'Tunai', '0000-00-00'),
('10/6/23/1', '2023-07-19', 101, 1, 'BL190723000003', '2023-07-19 02:58:45', 'Tunai', '0000-00-00');

--
-- Trigger `tbl_beli`
--
DELIMITER $$
CREATE TRIGGER `update_hutang` BEFORE UPDATE ON `tbl_beli` FOR EACH ROW BEGIN

UPDATE tbl_hutang set hutang_id=new.beli_nofak WHERE hutang_id=old.beli_nofak;

UPDATE tbl_detail_hutang set hutang_id=new.beli_nofak WHERE hutang_id=old.beli_nofak;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cara_bayar`
--

CREATE TABLE `tbl_cara_bayar` (
  `crbyr_id` int(11) NOT NULL,
  `crbyr_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_cara_bayar`
--

INSERT INTO `tbl_cara_bayar` (`crbyr_id`, `crbyr_nama`) VALUES
(11, 'Tunai'),
(12, 'Tunai'),
(13, 'Non-Tunai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_nofak` varchar(50) NOT NULL,
  `cart_imei` varchar(30) NOT NULL,
  `cart_merek_barang_id` int(11) NOT NULL,
  `cart_merek_barang` varchar(30) NOT NULL,
  `cart_warna_id` int(11) NOT NULL,
  `cart_warna` varchar(30) NOT NULL,
  `cart_harga_pokok` double NOT NULL,
  `cart_harga_srp` double NOT NULL,
  `cart_harga_min` double NOT NULL,
  `cart_harga_max` double NOT NULL,
  `cart_jumlah` int(50) NOT NULL,
  `cart_subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_cart_jual`
--

CREATE TABLE `tbl_cart_jual` (
  `cart_jual_id` double NOT NULL,
  `cart_jual_id_admin` int(11) NOT NULL,
  `cart_jual_imei` varchar(255) NOT NULL,
  `cart_jual_nama_merek` varchar(100) NOT NULL,
  `cart_jual_warna` varchar(100) NOT NULL,
  `cart_jual_id_warna` int(11) NOT NULL,
  `cart_jual_harga_srp` double NOT NULL,
  `cart_jual_harga_jual` double NOT NULL,
  `cart_jual_qty` int(11) NOT NULL,
  `cart_jual_diskon` double NOT NULL,
  `cart_jual_subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` double NOT NULL,
  `customer_nama` varchar(255) NOT NULL,
  `customer_telp` varchar(15) NOT NULL,
  `customer_alamat` varchar(255) NOT NULL,
  `customer_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_hint` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_nama`, `customer_telp`, `customer_alamat`, `customer_timestamp`, `customer_hint`) VALUES
(3893, 'Xaleb', '+624878378', 'Aceh', '2023-07-09 16:24:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_beli`
--

CREATE TABLE `tbl_detail_beli` (
  `d_beli_id` double NOT NULL,
  `d_beli_nofak` varchar(25) DEFAULT NULL,
  `d_beli_barang_id` varchar(25) DEFAULT NULL,
  `d_beli_harga` double DEFAULT NULL,
  `d_beli_jumlah` int(11) DEFAULT NULL,
  `d_beli_total` double DEFAULT NULL,
  `d_beli_kode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_detail_beli`
--

INSERT INTO `tbl_detail_beli` (`d_beli_id`, `d_beli_nofak`, `d_beli_barang_id`, `d_beli_harga`, `d_beli_jumlah`, `d_beli_total`, `d_beli_kode`) VALUES
(9748, '10/6/23/1', 'BRG-001', 40000, 100, 4000000, 'BL090723000001'),
(9749, '10/6/23/10', 'BRG-002', 40000, 100, 4000000, 'BL090723000002'),
(9750, '10/6/23/1', 'BRG-0012', 40000, 10, 400000, 'BL190723000003');

--
-- Trigger `tbl_detail_beli`
--
DELIMITER $$
CREATE TRIGGER `update_detail_beli` AFTER UPDATE ON `tbl_detail_beli` FOR EACH ROW BEGIN

UPDATE tbl_detail_hutang set hutang_awal= (SELECT SUM(d_beli_total) from tbl_detail_beli WHERE hutang_id= d_beli_nofak), hutang_sisa = hutang_awal - hutang_bayar WHERE hutang_id=old.d_beli_nofak;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_hutang`
--

CREATE TABLE `tbl_detail_hutang` (
  `d_hutang_id` int(11) NOT NULL,
  `hutang_id` varchar(255) NOT NULL COMMENT 'ini nomor faktur',
  `hutang_awal` double NOT NULL,
  `hutang_bayar` double NOT NULL,
  `hutang_sisa` double NOT NULL,
  `tanggal` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_jual`
--

CREATE TABLE `tbl_detail_jual` (
  `d_jual_id` double NOT NULL,
  `d_jual_nofak` varchar(25) DEFAULT NULL,
  `d_jual_barang_id` varchar(25) DEFAULT NULL,
  `d_jual_barang_har_srp_pot` double DEFAULT NULL COMMENT 'sebelumnya harpok',
  `d_jual_barang_har_srp` double DEFAULT NULL,
  `d_jual_qty` int(11) DEFAULT NULL,
  `d_jual_diskon` double DEFAULT NULL,
  `d_jual_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_piutang`
--

CREATE TABLE `tbl_detail_piutang` (
  `d_piutang_id` int(11) NOT NULL,
  `piutang_id` varchar(255) NOT NULL,
  `piutang_awal` double NOT NULL,
  `piutang_bayar` double NOT NULL,
  `piutang_sisa` double NOT NULL,
  `tanggal` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_service`
--

CREATE TABLE `tbl_detail_service` (
  `d_service_id` double NOT NULL,
  `d_service_nofak` varchar(25) DEFAULT NULL,
  `d_service_nama` varchar(255) DEFAULT NULL,
  `d_service_barang_har_srp_pot` double DEFAULT NULL COMMENT 'sebelumnya harpok',
  `d_service_qty` int(11) DEFAULT NULL,
  `d_service_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hutang`
--

CREATE TABLE `tbl_hutang` (
  `hutang_id` varchar(255) NOT NULL,
  `hutang_tempo` date NOT NULL,
  `hutang_status` int(11) NOT NULL COMMENT '1 lunas, 0 belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jual`
--

CREATE TABLE `tbl_jual` (
  `jual_nofak` varchar(25) NOT NULL,
  `jual_tanggal` datetime DEFAULT current_timestamp(),
  `jual_total` double DEFAULT NULL,
  `jual_jml_uang` double DEFAULT NULL,
  `jual_kembalian` double DEFAULT NULL,
  `jual_user_id` int(11) DEFAULT NULL,
  `jual_keterangan` varchar(20) DEFAULT NULL COMMENT '1= aktif\r\n2= batal',
  `jual_pembayaran` varchar(30) DEFAULT NULL,
  `jual_customer` double DEFAULT NULL,
  `jual_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Trigger `tbl_jual`
--
DELIMITER $$
CREATE TRIGGER `update_piutang` BEFORE UPDATE ON `tbl_jual` FOR EACH ROW BEGIN

UPDATE tbl_piutang set piutang_id=new.jual_nofak WHERE piutang_id=old.jual_nofak;

UPDATE tbl_detail_piutang set piutang_awal=new.jual_total,piutang_bayar=new.jual_jml_uang,piutang_sisa=new.jual_total-new.jual_jml_uang, piutang_id=new.jual_nofak WHERE piutang_id=old.jual_nofak;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_merek`
--

CREATE TABLE `tbl_merek` (
  `merek_id` double NOT NULL,
  `nama_merek` varchar(255) DEFAULT NULL,
  `kategori_merek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_merek`
--

INSERT INTO `tbl_merek` (`merek_id`, `nama_merek`, `kategori_merek`) VALUES
(1, 'Bodrex Flu dan Batuk', '1'),
(842, 'Bodrex Migrain', '1'),
(843, 'Promag Tablet', '1'),
(844, 'Promag Cair', '1'),
(845, 'Antangin JRG', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mutasi`
--

CREATE TABLE `tbl_mutasi` (
  `mutasi_id` int(11) NOT NULL,
  `mutasi_imei` varchar(15) NOT NULL,
  `mutasi_toko_asal` varchar(100) NOT NULL,
  `mutasi_toko_tujuan` varchar(15) NOT NULL,
  `mutasi_tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_piutang`
--

CREATE TABLE `tbl_piutang` (
  `piutang_id` varchar(255) NOT NULL,
  `piutang_tempo` date NOT NULL,
  `piutang_status` int(11) NOT NULL COMMENT '1 lunas, 0 belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_retur`
--

CREATE TABLE `tbl_retur` (
  `retur_id` double NOT NULL,
  `retur_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `retur_barang_id` varchar(15) DEFAULT NULL,
  `retur_barang_nama` varchar(150) DEFAULT NULL,
  `retur_barang_satuan` varchar(30) DEFAULT NULL,
  `retur_harjul` double DEFAULT NULL,
  `retur_qty` int(11) DEFAULT NULL,
  `retur_subtotal` double DEFAULT NULL,
  `retur_keterangan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_retur_beli`
--

CREATE TABLE `tbl_retur_beli` (
  `retur_id` double NOT NULL,
  `retur_tanggal` date DEFAULT current_timestamp(),
  `retur_barang_id` varchar(15) DEFAULT NULL,
  `retur_harpok` double DEFAULT NULL,
  `retur_qty` int(11) DEFAULT NULL,
  `retur_keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_retur_jual`
--

CREATE TABLE `tbl_retur_jual` (
  `retur_id` double NOT NULL,
  `retur_tanggal` date DEFAULT current_timestamp(),
  `retur_barang_id` varchar(15) DEFAULT NULL,
  `retur_harjul` double DEFAULT NULL,
  `retur_qty` int(11) DEFAULT NULL,
  `retur_keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_nofak` varchar(15) NOT NULL,
  `service_tanggal` datetime DEFAULT current_timestamp(),
  `service_total` double DEFAULT NULL,
  `service_dp` double DEFAULT NULL,
  `service_kekurangan` double DEFAULT NULL,
  `service_user_id` int(11) DEFAULT NULL,
  `service_keterangan` varchar(20) DEFAULT NULL COMMENT '1= aktif2= batal',
  `service_pembayaran` varchar(30) DEFAULT NULL,
  `service_customer` double DEFAULT NULL,
  `service_toko` varchar(100) DEFAULT NULL,
  `service_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `suplier_id` int(11) NOT NULL,
  `suplier_nama` varchar(35) DEFAULT NULL,
  `suplier_alamat` varchar(60) DEFAULT NULL,
  `suplier_notelp` varchar(20) DEFAULT NULL,
  `suplier_perusahaan` varchar(255) NOT NULL COMMENT 'nama perusahaan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`suplier_id`, `suplier_nama`, `suplier_alamat`, `suplier_notelp`, `suplier_perusahaan`) VALUES
(100, 'Xamwell', 'Tokyo, United States', '+134433', 'IndiFarma'),
(101, 'Jono', 'Aceh', '+624395949', 'Jono Bersaudara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toko`
--

CREATE TABLE `tbl_toko` (
  `toko_id` int(11) NOT NULL,
  `toko_nama` varchar(255) NOT NULL,
  `toko_alamat` varchar(255) NOT NULL,
  `toko_status` int(11) NOT NULL COMMENT '0 = Pusat\r\n1 = Cabang',
  `toko_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_toko`
--

INSERT INTO `tbl_toko` (`toko_id`, `toko_nama`, `toko_alamat`, `toko_status`, `toko_telp`) VALUES
(5, 'APOTEK SAMUDRA FARMA', 'Jl. Prof. Moh Yamin RT 04/ RW 03 Karangklesem Purwokerto Selatan', 0, '08xxxx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(35) DEFAULT NULL,
  `user_username` varchar(30) DEFAULT NULL,
  `user_password` varchar(35) DEFAULT NULL,
  `user_level` varchar(2) DEFAULT NULL COMMENT '1=admin 2=owner 3=kasir',
  `user_status` varchar(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_level`, `user_status`) VALUES
(1, 'Robert', 'Admin', '827ccb0eea8a706c4c34a16891f84e7b', '1', '1'),
(2, 'Prayoga', 'Owner', '827ccb0eea8a706c4c34a16891f84e7b', '2', '1'),
(3, 'Kiki', 'Kasir', '827ccb0eea8a706c4c34a16891f84e7b', '3', '1'),
(17, 'superuser', 'super', '8451ba8a14d79753d34cb33b51ba46b4b02', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_warna`
--

CREATE TABLE `tbl_warna` (
  `warna_id` int(11) NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_warna`
--

INSERT INTO `tbl_warna` (`warna_id`, `warna`) VALUES
(1, 'Paracetamol'),
(2, 'Dexamethasone'),
(54, 'Acid mefenamic'),
(55, 'Antasida'),
(56, 'Biru');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_user_id` (`barang_user_id`),
  ADD KEY `barang_kategori_id` (`barang_merek_id`);

--
-- Indeks untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD PRIMARY KEY (`beli_kode`),
  ADD KEY `beli_user_id` (`beli_user_id`),
  ADD KEY `beli_suplier_id` (`beli_suplier_id`),
  ADD KEY `beli_id` (`beli_kode`);

--
-- Indeks untuk tabel `tbl_cara_bayar`
--
ALTER TABLE `tbl_cara_bayar`
  ADD PRIMARY KEY (`crbyr_id`);

--
-- Indeks untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indeks untuk tabel `tbl_cart_jual`
--
ALTER TABLE `tbl_cart_jual`
  ADD PRIMARY KEY (`cart_jual_id`);

--
-- Indeks untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD PRIMARY KEY (`d_beli_id`),
  ADD KEY `d_beli_barang_id` (`d_beli_barang_id`),
  ADD KEY `d_beli_nofak` (`d_beli_nofak`),
  ADD KEY `d_beli_kode` (`d_beli_kode`);

--
-- Indeks untuk tabel `tbl_detail_hutang`
--
ALTER TABLE `tbl_detail_hutang`
  ADD PRIMARY KEY (`d_hutang_id`);

--
-- Indeks untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD PRIMARY KEY (`d_jual_id`),
  ADD KEY `d_jual_barang_id` (`d_jual_barang_id`),
  ADD KEY `d_jual_nofak` (`d_jual_nofak`);

--
-- Indeks untuk tabel `tbl_detail_piutang`
--
ALTER TABLE `tbl_detail_piutang`
  ADD PRIMARY KEY (`d_piutang_id`);

--
-- Indeks untuk tabel `tbl_detail_service`
--
ALTER TABLE `tbl_detail_service`
  ADD PRIMARY KEY (`d_service_id`),
  ADD KEY `d_jual_nofak` (`d_service_nofak`);

--
-- Indeks untuk tabel `tbl_hutang`
--
ALTER TABLE `tbl_hutang`
  ADD PRIMARY KEY (`hutang_id`);

--
-- Indeks untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD PRIMARY KEY (`jual_nofak`),
  ADD KEY `jual_user_id` (`jual_user_id`);

--
-- Indeks untuk tabel `tbl_merek`
--
ALTER TABLE `tbl_merek`
  ADD PRIMARY KEY (`merek_id`);

--
-- Indeks untuk tabel `tbl_mutasi`
--
ALTER TABLE `tbl_mutasi`
  ADD PRIMARY KEY (`mutasi_id`);

--
-- Indeks untuk tabel `tbl_piutang`
--
ALTER TABLE `tbl_piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indeks untuk tabel `tbl_retur`
--
ALTER TABLE `tbl_retur`
  ADD PRIMARY KEY (`retur_id`);

--
-- Indeks untuk tabel `tbl_retur_beli`
--
ALTER TABLE `tbl_retur_beli`
  ADD PRIMARY KEY (`retur_id`);

--
-- Indeks untuk tabel `tbl_retur_jual`
--
ALTER TABLE `tbl_retur_jual`
  ADD PRIMARY KEY (`retur_id`);

--
-- Indeks untuk tabel `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_nofak`),
  ADD KEY `jual_user_id` (`service_user_id`);

--
-- Indeks untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indeks untuk tabel `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD PRIMARY KEY (`toko_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_warna`
--
ALTER TABLE `tbl_warna`
  ADD PRIMARY KEY (`warna_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_cara_bayar`
--
ALTER TABLE `tbl_cara_bayar`
  MODIFY `crbyr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4158;

--
-- AUTO_INCREMENT untuk tabel `tbl_cart_jual`
--
ALTER TABLE `tbl_cart_jual`
  MODIFY `cart_jual_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4056;

--
-- AUTO_INCREMENT untuk tabel `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3895;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  MODIFY `d_beli_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9751;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_hutang`
--
ALTER TABLE `tbl_detail_hutang`
  MODIFY `d_hutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1518;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  MODIFY `d_jual_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9518;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_piutang`
--
ALTER TABLE `tbl_detail_piutang`
  MODIFY `d_piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_service`
--
ALTER TABLE `tbl_detail_service`
  MODIFY `d_service_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_merek`
--
ALTER TABLE `tbl_merek`
  MODIFY `merek_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=846;

--
-- AUTO_INCREMENT untuk tabel `tbl_mutasi`
--
ALTER TABLE `tbl_mutasi`
  MODIFY `mutasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4982;

--
-- AUTO_INCREMENT untuk tabel `tbl_retur`
--
ALTER TABLE `tbl_retur`
  MODIFY `retur_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_retur_beli`
--
ALTER TABLE `tbl_retur_beli`
  MODIFY `retur_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tbl_retur_jual`
--
ALTER TABLE `tbl_retur_jual`
  MODIFY `retur_id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `tbl_toko`
--
ALTER TABLE `tbl_toko`
  MODIFY `toko_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_warna`
--
ALTER TABLE `tbl_warna`
  MODIFY `warna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`barang_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_ibfk_2` FOREIGN KEY (`barang_merek_id`) REFERENCES `tbl_merek` (`merek_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_beli`
--
ALTER TABLE `tbl_beli`
  ADD CONSTRAINT `tbl_beli_ibfk_1` FOREIGN KEY (`beli_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_beli_ibfk_2` FOREIGN KEY (`beli_suplier_id`) REFERENCES `tbl_suplier` (`suplier_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_beli`
--
ALTER TABLE `tbl_detail_beli`
  ADD CONSTRAINT `tbl_detail_beli_ibfk_1` FOREIGN KEY (`d_beli_barang_id`) REFERENCES `tbl_barang` (`barang_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_beli_ibfk_2` FOREIGN KEY (`d_beli_kode`) REFERENCES `tbl_beli` (`beli_kode`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_detail_jual`
--
ALTER TABLE `tbl_detail_jual`
  ADD CONSTRAINT `tbl_detail_jual_ibfk_1` FOREIGN KEY (`d_jual_barang_id`) REFERENCES `tbl_barang` (`barang_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_jual_ibfk_2` FOREIGN KEY (`d_jual_nofak`) REFERENCES `tbl_jual` (`jual_nofak`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_jual`
--
ALTER TABLE `tbl_jual`
  ADD CONSTRAINT `tbl_jual_ibfk_1` FOREIGN KEY (`jual_user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
