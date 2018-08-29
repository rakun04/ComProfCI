-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2018 pada 04.34
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_tcb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `keahlian` text,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `foto` text,
  `akses` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_lengkap`, `jenis_kelamin`, `jabatan`, `keahlian`, `email`, `contact`, `foto`, `akses`) VALUES
(1, 'Trisna Narayana', 'L', 'Programmer', '<p>Web api , microcontroller, IoT , android developer , desktop</p>', 'trisnanarayana@gmail.com', '08988600980', '54be54f0211499ff2f6bc834d6577786.png', 'Y'),
(6, 'Irpan Komarudin', 'L', 'IT Networking', '<p>Microtik</p>', 'irpankomarudin@gmail.com', '08988600980', '29036e06caf2797fc8482c8408d05470.png', 'N'),
(9, 'Rakun', 'L', 'Programmer', '<p>Ngerii Bos</p>', 'rakun@gmail.com', '087887xxxx', 'e859fbc320b6175227ba86af79113942.png', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_client` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `say` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id_client`, `tanggal`, `nama_client`, `email`, `say`) VALUES
(1, '2018-08-20 04:05:30', 'Trisna', 'trisnanarayana@gmail.com', 'blablablbalbalbalbalbalaa'),
(2, '2018-08-20 04:33:07', 'Pt Dasentek', 'irpankomarudin@gmail.com', 'Great its a beautiful');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deskripsi`
--

CREATE TABLE `deskripsi` (
  `id_deskripsi` int(11) NOT NULL,
  `desc_product` text NOT NULL,
  `desc_solution` text NOT NULL,
  `desc_data_center` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `deskripsi`
--

INSERT INTO `deskripsi` (`id_deskripsi`, `desc_product`, `desc_solution`, `desc_data_center`) VALUES
(1, '<p style=\"text-align: justify;\">Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil.</p>', '<h2>Where does it come from?</h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_project`
--

CREATE TABLE `detail_project` (
  `id_detail` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deskripsi` text,
  `id_anggota` int(11) DEFAULT NULL,
  `id_project` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_project`
--

INSERT INTO `detail_project` (`id_detail`, `waktu`, `deskripsi`, `id_anggota`, `id_project`) VALUES
(2, '2017-10-31 05:45:44', 'Pembuatan Box', 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id_info` int(11) NOT NULL,
  `judul_info` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `img` text,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id_info`, `judul_info`, `deskripsi`, `img`, `tgl_input`) VALUES
(1, 'Lorem Ipsum', '<p><span id=\"selection-marker-1\" class=\"redactor-selection-marker\">Lorem Ipsum</span> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>', '1020a298d9b91afa56ddf81956c6b267.jpg', '2018-08-15 09:14:26'),
(2, 'Lorem Ipsum', '<p><strong style=\"background-color: initial;\">Lorem Ipsum</strong> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>', '580421162d05a0f4059f1ca4e7b43773.png', '2018-08-15 07:16:23'),
(3, 'Lorem Ipsum', '<p><strong style=\"background-color: initial;\">Lorem Ipsum</strong> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.</p>', 'b5174294ce25286e6febce1a81fc3d59.png', '2018-08-15 07:17:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karir`
--

CREATE TABLE `karir` (
  `id_karir` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `upload_cv` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karir`
--

INSERT INTO `karir` (`id_karir`, `tanggal`, `email`, `upload_cv`) VALUES
(1, '2018-08-20 03:44:03', 'trisnanarayana@gmail.com', 'karir--1534736643.pdf'),
(2, '2018-08-20 04:25:48', 'irpankomarudin@gmail.com', 'karir--1534739148.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `judul_kategori` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `judul_kategori`, `deskripsi`) VALUES
(1, 'Data Center & Network Insfratucture', 'Lorem Ipsum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_mitra` varchar(100) DEFAULT NULL,
  `alamat_mitra` text,
  `kontak_mitra` varchar(20) DEFAULT NULL,
  `email_mitra` varchar(100) DEFAULT NULL,
  `foto_mitra` text,
  `deskripsi` text,
  `link_mitra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `alamat_mitra`, `kontak_mitra`, `email_mitra`, `foto_mitra`, `deskripsi`, `link_mitra`) VALUES
(6, 'PT Daya Sentra Teknik', 'Perumahan Taman Mutiara', '08988700980', 'dasentek@dasentek.com', '20f604670e246419c815f7c5526daf58.png', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a</p>', 'http://dasentek.com'),
(7, 'Intek', 'asdasdasdas', '08988700980', 'trisannarayana@gmail.com', 'fa1ca1f2e5c0e24537066d2e9a43328b.png', '<p>dasdasdasdasdasdaxasxasxasx</p>', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deskripsi` varchar(100) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deskripsi` varchar(100) DEFAULT NULL,
  `jumlah` bigint(20) DEFAULT NULL,
  `img_struk` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `tgl_masuk` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(100) DEFAULT NULL,
  `message` text,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `tgl_masuk`, `nama`, `email`, `telepon`, `message`, `status`) VALUES
(1, '2017-11-01 02:25:16', 'Trisna Narayana', 'trisnanarayana@gmail.com', '08988600980', 'trisna', 'R'),
(2, '2017-10-31 17:00:00', 'Irpan Komarudin', 'irpankomarudin10@gmail.com', '089887690', 'Harap kontak saya saya tertarik untuk pembuatan sistem informasi', 'R'),
(3, '2017-11-01 02:49:16', 'Ryan', 'trisnanarayana@gmail.com', '08988600999', 'Saya mau bikin monitoring mechine', 'R'),
(4, '2017-11-06 09:00:13', 'test', 'trisnanarayana@gmail.com', '08988600980', 'testtt', 'R'),
(5, '2017-11-11 04:42:58', 'wilman', 'wilmanrabas@gmail.com', '085250573359', 'Bsa tlg d buatkan prgram sstem prmahan', 'R'),
(6, '2018-04-29 01:44:09', NULL, NULL, NULL, NULL, 'R'),
(7, '2018-05-05 21:13:42', NULL, NULL, NULL, NULL, 'R'),
(8, '2018-06-12 17:04:08', NULL, NULL, NULL, NULL, 'D'),
(9, '2018-06-19 15:07:39', NULL, NULL, NULL, NULL, 'D'),
(10, '2018-07-30 00:43:56', NULL, NULL, NULL, NULL, 'D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nama_product` varchar(100) DEFAULT NULL,
  `dibuat_pada` date DEFAULT NULL,
  `deskripsi` text,
  `foto_product` text,
  `id_sub_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `nama_product`, `dibuat_pada`, `deskripsi`, `foto_product`, `id_sub_kategori`) VALUES
(4, 'Harness', '2018-09-01', '<p>The world population is continuously growing and reached a significant \r\nevolution of the society, where the number of people living in cities \r\nsurpassed the number of people in rural areas. This puts national and \r\nlocal governments under pressure because the limited resources, such as \r\nwater, electricity, and transports, must thus be optimized to cover the \r\nneeds of the citizens. Therefore, different tools, from sensors to \r\nprocesses, service, and artificial intelligence, are used to coordinate \r\nthe usage of infrastructures and assets of the cities to build the so \r\ncalled smart cities.</p>', '5d5b05ee3e70c40984f58b34a6cbd97a.png', 4),
(5, 'Harness', '2018-09-01', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 'd91761dcde170f336c830e49d53966de.png', 4),
(6, 'Harness', '2018-09-01', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', '37b670323efec94f92c4d1eead1fdcf9.png', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `deskripsi` text,
  `foto_profile` text,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `jam_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profile`, `deskripsi`, `foto_profile`, `visi`, `misi`, `alamat`, `email`, `telepon`, `fax`, `jam_kerja`) VALUES
(1, '<p style=\"text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'fa97751e2aa7375e07f6e444f7e43eac.png', '<p style=\"text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content satu.</p>', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Jln. Jongjolong no.25 Kel.Burangrang Dec.Lengkong Bandung', 'admin@talicahayabuana.com', '08988600980', '08988600980', 'Monday - Friday | 09:00 Am - 17:00 PM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `nama_project` varchar(100) DEFAULT NULL,
  `dibuat_pada` date DEFAULT NULL,
  `deskripsi` text,
  `foto_project` text,
  `client` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `status` enum('Internal','Process','Portopolio') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `servis`
--

CREATE TABLE `servis` (
  `id_servis` int(11) NOT NULL,
  `nama_servis` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `img_servis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `servis`
--

INSERT INTO `servis` (`id_servis`, `nama_servis`, `deskripsi`, `img_servis`) VALUES
(1, 'Data Center & Network Insfratucture', '<p>&lt;?php } } } ?&gt;</p>', '8be2e25c165b45e8776b43951141f414.png'),
(3, 'Security Monitoring (IP Camera)', '<p>Teststetsttets</p>', 'dc24b088730dc993e68a08118d3efad5.png'),
(6, 'Hardware & Software Equipment', '<p>asdasdasd</p>', '8d1b26a5284221267594d487364f6b0b.png'),
(8, 'Military Grade Electrical Components', '<p>Blablabblalablbalbalasadasda</p>', '147149f2fdb8cf4d346248a0afac45a2.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nama_slider` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `tampilkan` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `date`, `nama_slider`, `image`, `tampilkan`) VALUES
(6, '2018-08-15 08:11:24', 'Slide 1', 'slider--1534325339.jpg', 'Y'),
(7, '2018-08-15 08:22:51', 'Slide 2', 'slider--1534321370.jpg', 'Y'),
(8, '2018-08-15 09:42:39', 'Slide 3', 'slider--1534327853.jpg', 'N'),
(9, '2018-08-15 09:43:06', 'Slide 4', 'slider--1534326185.jpg', 'N'),
(10, '2018-08-15 09:43:20', 'Slide 5', 'slider--1534327871.jpg', 'Y'),
(11, '2018-08-15 09:43:31', 'Slide 6', 'slider--1534326210.jpg', 'Y'),
(12, '2018-08-15 09:43:44', 'Slide 7', 'slider--1534326223.jpg', 'Y'),
(13, '2018-08-15 09:46:08', 'Slide 8', 'slider--1534327889.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `id_sub_kategori` int(11) NOT NULL,
  `nama_sub_kategori` varchar(100) NOT NULL,
  `deskripsi_sub_kategori` text NOT NULL,
  `img_sub` text NOT NULL,
  `id_servis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kategori`
--

INSERT INTO `sub_kategori` (`id_sub_kategori`, `nama_sub_kategori`, `deskripsi_sub_kategori`, `img_sub`, `id_servis`) VALUES
(4, 'Server', '<p style=\"text-align: justify;\"><strong style=\"background-color: initial;\">Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '8305942f510a51cf74b504aef2a5fe01.png', 1),
(5, 'Racking System', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '162cf0c3d108254e6610ef53ebee0c85.png', 1),
(6, 'Wireless Technology ', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'bcfc501fced8219f0fa4ff248ac1e4fd.png', 1),
(7, 'Indoor & Outdoor CCTV', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'd85ef6a5d1568062a01a7fbcb4f3f2a5.png', 3),
(8, 'Visual Monitoring', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '1dd4c17491877ded302dfe7ca0f6f9ff.png', 3),
(9, 'Harness', '<p>Lorem Ipsum</p>', 'f22e5bdddf7988374ff4a019ed30d85d.png', 8),
(10, 'Grounding', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'a6120b0254eb3726376d6f22b305038a.png', 6),
(11, 'Screen Projector', '<p style=\"text-align: justify;\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '7527eb88569172077a8f75556aad0d25.png', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(100) DEFAULT NULL,
  `password` text,
  `id_user` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `id_user`, `id_anggota`) VALUES
('demoweb', 'afdf07346d6338603f2b16609e8618cd', 16, 1),
('anis', '38a1ffb5ccad9612d3d28d99488ca94b', 17, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `judul_video` varchar(100) NOT NULL,
  `video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `video`
--

INSERT INTO `video` (`id_video`, `judul_video`, `video`) VALUES
(3, 'Data Insfractucture', 'video1534836688.mp4'),
(4, 'test', '1534836804.mp4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `visitor`
--

INSERT INTO `visitor` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2018-08-28', 11, '1535451939'),
('192.168.12.1', '2018-08-16', 12, '12312dqwqwdqw'),
('192.168.12.2', '2018-08-07', 123, '123123124'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('127.0.0.1', '2018-08-25', 1, '1535187678'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939'),
('::1', '2018-08-28', 11, '1535451939');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indeks untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  ADD PRIMARY KEY (`id_deskripsi`);

--
-- Indeks untuk tabel `detail_project`
--
ALTER TABLE `detail_project`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeks untuk tabel `karir`
--
ALTER TABLE `karir`
  ADD PRIMARY KEY (`id_karir`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indeks untuk tabel `servis`
--
ALTER TABLE `servis`
  ADD PRIMARY KEY (`id_servis`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`id_sub_kategori`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  MODIFY `id_deskripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_project`
--
ALTER TABLE `detail_project`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `karir`
--
ALTER TABLE `karir`
  MODIFY `id_karir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `servis`
--
ALTER TABLE `servis`
  MODIFY `id_servis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `sub_kategori`
--
ALTER TABLE `sub_kategori`
  MODIFY `id_sub_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
