-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 02:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bayar`
--

CREATE TABLE `tbl_bayar` (
  `id_bayar` bigint(20) NOT NULL,
  `nominal_uang` decimal(10,2) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL,
  `tanggal_bayar` date NOT NULL DEFAULT current_timestamp(),
  `waktu_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bayar`
--

INSERT INTO `tbl_bayar` (`id_bayar`, `nominal_uang`, `total_harga`, `kembalian`, `tanggal_bayar`, `waktu_bayar`) VALUES
(2501201708183, 40000.00, 30000.00, 10000.00, '2025-01-21', '2025-01-21 13:45:46'),
(2501202205960, 90000.00, 90000.00, 0.00, '2025-01-21', '2025-01-21 13:46:06'),
(2501211502797, 60000.00, 50000.00, 10000.00, '2025-01-22', '2025-01-22 08:04:16'),
(2501231309645, 80000.00, 80000.00, 0.00, '2025-01-23', '2025-01-23 13:58:19'),
(2501242131228, 320000.00, 318000.00, 2000.00, '2025-01-24', '2025-01-24 14:43:14'),
(2501242150977, 175000.00, 175000.00, 0.00, '2025-01-24', '2025-01-24 14:53:51'),
(2501242210151, 170000.00, 165000.00, 5000.00, '2025-01-24', '2025-01-24 15:26:48'),
(2501242229914, 600000.00, 585000.00, 15000.00, '2025-01-24', '2025-01-24 15:30:58'),
(2501252111400, 215000.00, 215000.00, 0.00, '2025-01-25', '2025-01-25 14:13:46'),
(2501252127534, 100000.00, 100000.00, 0.00, '2025-01-26', '2025-01-25 17:04:52'),
(2501252229598, 270000.00, 265000.00, 5000.00, '2025-01-26', '2025-01-25 17:02:43'),
(2501260005155, 675000.00, 675000.00, 0.00, '2025-01-26', '2025-01-25 17:07:49'),
(2501260117756, 300000.00, 270000.00, 30000.00, '2025-02-28', '2025-02-28 02:59:25'),
(2502242324671, 2000000.00, 1890000.00, 110000.00, '2025-02-24', '2025-02-24 16:26:13'),
(2502272138479, 200000.00, 195000.00, 5000.00, '2025-02-28', '2025-02-28 03:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftar_menu`
--

CREATE TABLE `tbl_daftar_menu` (
  `id_menu` int(11) NOT NULL,
  `gambar_menu` varchar(200) NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_daftar_menu`
--

INSERT INTO `tbl_daftar_menu` (`id_menu`, `gambar_menu`, `nama_menu`, `keterangan`, `id_kategori`, `harga`) VALUES
(15, 'Ramen Shoyu.jpeg', 'Ramen Shoyu', 'Ramen dengan kuah kecap asin (shoyu) yang gurih, dilengkapi ayam panggang, telur rebus, nori, dan daun bawang. Rasa yang klasik dan nikmat.', 20, 65000.00),
(16, 'Ramen Tonkotsu.jpeg', 'Ramen Tonkotsu', 'Ramen dengan kuah tulang babi yang creamy, dilengkapi daging chashu, telur setengah matang, dan jamur. Cocok untuk pecinta rasa autentik.', 20, 75000.00),
(17, 'Sushi Roll California.jpeg', 'Sushi Roll California', 'Sushi roll dengan isian daging kepiting, alpukat, dan mentimun, dibalut nasi lembut dan taburan wijen. Nikmat dengan wasabi dan kecap asin.', 21, 55000.00),
(18, 'Sashimi Tuna.jpeg', 'Sashimi Tuna', 'Irisan tuna segar premium dengan rasa alami yang manis. Disajikan dengan kecap asin dan wasabi.', 22, 80000.00),
(19, 'Tempura Udang.jpeg', 'Tempura Udang', 'Udang segar berbalut adonan ringan khas Jepang, digoreng renyah keemasan dan disajikan dengan saus celup.', 23, 50000.00),
(20, 'Gyoza.jpeg', 'Gyoza', 'Pangsit goreng berisi ayam dan sayuran, renyah di luar dan lembut di dalam, disajikan dengan saus celup khas Jepang.', 24, 40000.00),
(22, 'Unagi Donburi.jpeg', 'Unagi Donburi', 'Nasi putih dengan topping belut panggang yang dibalur saus manis khas Jepang. Nikmat dan mengenyangkan.\r\n', 20, 95000.00),
(23, 'Takoyaki.jpeg', 'Takoyaki', 'Bola adonan tepung dengan isian gurita, digoreng hingga renyah, dan disajikan dengan saus takoyaki, mayo, dan katsuobushi.', 25, 35000.00),
(24, 'Katsu Curry Rice.jpeg', 'Katsu Curry Rice', 'Nasi putih dengan saus kari kental, dilengkapi potongan katsu ayam yang renyah. Rasa yang gurih dan pedas.', 20, 70000.00),
(25, 'Okonomiyaki.jpeg', 'Okonomiyaki', 'Pancake gurih berisi kol, tepung, dan pilihan topping seperti daging atau seafood, disajikan dengan saus okonomiyaki dan mayo.', 20, 60000.00),
(26, 'Matcha Latte.jpeg', 'Matcha Latte', 'Minuman berbahan dasar teh hijau matcha dengan susu yang creamy, memberikan rasa manis yang seimbang.', 26, 35000.00),
(27, 'Ocha (Green Tea).jpeg', 'Ocha (Green Tea)', 'Teh hijau Jepang tanpa gula dengan rasa alami yang menyegarkan. Cocok untuk menemani makan.', 26, 20000.00),
(28, 'Sakura Lemonade.jpeg', 'Sakura Lemonade', 'Lemonade dengan sentuhan bunga sakura, menawarkan rasa manis dan asam yang segar.', 27, 30000.00),
(29, 'Yuzu Honey Tea.jpeg', 'Yuzu Honey Tea', 'Teh herbal manis dengan campuran jeruk Yuzu khas Jepang dan madu alami, memberikan rasa segar dan sedikit asam.', 26, 28000.00),
(30, 'Japanese Plum Wine (Umeshu).jpeg', 'Japanese Plum Wine (Umeshu)', 'Minuman manis dari plum Jepang yang memberikan rasa buah yang segar dan khas.', 28, 75000.00),
(31, 'Ramune.jpeg', 'Ramune', 'Soda Jepang dengan rasa manis dan segar, disajikan dalam botol unik dengan bola kaca.', 27, 25000.00),
(32, 'Sake.jpeg', 'Sake', 'Minuman beralkohol khas Jepang yang terbuat dari fermentasi beras, disajikan panas atau dingin.', 28, 95000.00),
(33, 'Melon Soda.jpeg', 'Melon Soda', 'Soda manis dengan rasa melon khas Jepang, sering disajikan dengan es krim vanila.', 27, 30000.00),
(34, 'Genmaicha.jpeg', 'Genmaicha', 'Teh hijau Jepang dengan campuran beras panggang, memberikan rasa kacang yang ringan dan menyegarkan.', 29, 25000.00),
(35, 'Hojicha Latte.jpeg', 'Hojicha Latte', 'Latte dengan teh hijau panggang (Hojicha) yang memiliki rasa smoky dan creamy.', 26, 35000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_menu`
--

CREATE TABLE `tbl_kategori_menu` (
  `id_kategori` int(11) NOT NULL,
  `jenis_menu` varchar(200) NOT NULL,
  `kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kategori_menu`
--

INSERT INTO `tbl_kategori_menu` (`id_kategori`, `jenis_menu`, `kategori`) VALUES
(20, 'Makanan', 'Makanan Utama'),
(21, 'Makanan', 'Sushi'),
(22, 'Makanan', 'Sashimi'),
(23, 'Makanan', 'Gorengan'),
(24, 'Makanan', 'Appetizer'),
(25, 'Makanan', 'Snack'),
(26, 'Minuman', 'Minuman Panas/Dingin'),
(27, 'Minuman', 'Minuman Dingin'),
(28, 'Minuman', 'Minuman Beralkohol'),
(29, 'Minuman', 'Minuman Herbal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list_order`
--

CREATE TABLE `tbl_list_order` (
  `id_list_order` int(11) NOT NULL,
  `id_order` bigint(20) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_list_order`
--

INSERT INTO `tbl_list_order` (`id_list_order`, `id_order`, `id_menu`, `jumlah`, `catatan`, `status`) VALUES
(40, 2501242131228, 16, 2, '', '2'),
(41, 2501242131228, 23, 3, '', '2'),
(42, 2501242131228, 29, 1, '', '2'),
(43, 2501242131228, 26, 1, '', '2'),
(44, 2501242150977, 17, 2, '', '1'),
(45, 2501242150977, 33, 1, '', '2'),
(46, 2501242150977, 35, 1, 'Gak pakai gula', '2'),
(47, 2501242210151, 24, 1, '', '1'),
(48, 2501242210151, 32, 1, '', '1'),
(49, 2501242229914, 18, 3, '', '1'),
(50, 2501242229914, 20, 3, '', ''),
(51, 2501242229914, 30, 3, '', '2'),
(52, 2501252111400, 22, 1, '', ''),
(53, 2501252111400, 19, 2, '', ''),
(54, 2501252111400, 27, 1, '', ''),
(55, 2501252127534, 15, 1, '', '2'),
(56, 2501252127534, 26, 1, '', '2'),
(57, 2501252229598, 25, 3, '', ''),
(58, 2501252229598, 34, 1, '', ''),
(59, 2501252229598, 31, 1, '', ''),
(60, 2501252229598, 35, 1, '', ''),
(61, 2501260005155, 20, 5, '', ''),
(62, 2501260005155, 32, 5, '', ''),
(63, 2502242324671, 32, 12, '', ''),
(64, 2502242324671, 16, 10, '', ''),
(65, 2502272138479, 15, 3, '', ''),
(67, 2501260117756, 20, 2, '', ''),
(68, 2501260117756, 22, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` bigint(20) NOT NULL,
  `pelanggan` varchar(200) NOT NULL,
  `meja` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tanggal_order` date NOT NULL DEFAULT current_timestamp(),
  `waktu_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `pelanggan`, `meja`, `id`, `tanggal_order`, `waktu_order`, `status_pembayaran`) VALUES
(2501242131228, 'Fikri', 1, 9, '2025-01-24', '2025-01-25 14:51:10', 'Lunas'),
(2501242150977, 'Salsa', 5, 9, '2025-01-24', '2025-01-25 14:51:15', 'Lunas'),
(2501242210151, 'Dinda', 7, 9, '2025-01-24', '2025-01-25 14:51:19', 'Lunas'),
(2501242229914, 'Daniel', 2, 9, '2025-01-24', '2025-01-25 14:51:26', 'Lunas'),
(2501252111400, 'Samuel', 9, 9, '2025-01-25', '2025-01-25 14:51:31', 'Lunas'),
(2501252127534, 'Vira', 3, 9, '2025-01-25', '2025-01-25 14:27:36', ''),
(2501252229598, 'Kevin', 4, 9, '2025-01-25', '2025-01-25 15:30:11', ''),
(2501260005155, 'Niel', 2, 9, '2025-01-26', '2025-01-25 17:06:19', ''),
(2501260117756, 'Danang', 1, 9, '2025-01-26', '2025-01-25 18:18:10', ''),
(2502242324671, 'flora', 1000, 48, '2025-02-24', '2025-02-24 16:25:13', ''),
(2502272138479, 'jjjjjjjj', 1, 33, '2025-02-27', '2025-02-27 14:38:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `level` int(1) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `username`, `level`, `nohp`, `alamat`, `password`, `gambar`) VALUES
(1, 'admin', 'admin@gmail.com', 1, '081234567891', 'jl.mawar', '$2y$10$2m.QUuJcpZ8iQWpdShgb2uKNfV/L46H7ln0yCccIi8eFWJSgfhxnK', 'admin@gmail.com.jpg'),
(2, 'kasir', 'kasir@gmail.com', 2, '081234567892', 'jl.mawar', '$2y$10$2m.QUuJcpZ8iQWpdShgb2uKNfV/L46H7ln0yCccIi8eFWJSgfhxnK', 'kasir@gmail.com.jpg'),
(3, 'pelayan', 'pelayan@gmail.com', 3, '081234567893', 'jl.mawar', '$2y$10$2m.QUuJcpZ8iQWpdShgb2uKNfV/L46H7ln0yCccIi8eFWJSgfhxnK', 'pelayan@gmail.com.jpg'),
(4, 'dapur', 'dapur@gmail.com', 4, '081234567894', 'jl.mawar', '$2y$10$2m.QUuJcpZ8iQWpdShgb2uKNfV/L46H7ln0yCccIi8eFWJSgfhxnK', 'dapur@gmail.com.jpg'),
(9, 'Imanuel', 'imanuel@gmail.com', 1, '081234567895', 'jl.bkkbn\r\n\r\n', '$2y$10$Cr0YJiT4QIRd6QlEnrFiiO1bTp2bUE3xPoJdfSw.zQgDSOvvUjE7q', 'imanuel@gmail.com.jpg'),
(33, 'wili', 'wili@gmail.com', 1, '081234567896', 'jl. bahagiaaaaa', '$2y$10$GsXjXzqdXQT6N3mF2PcR0uYjxnrOjqLEQFt3ennHbCY6ztQJ9l2cW', 'wili@gmail.com.jpg'),
(48, 'flora', 'flora@gmail.com', 1, '081277098515', 'jl. makmur No.177', '$2y$10$h2EzLOkLnNc9wH5p94em/OxgRGz.F/XwlpyzaXc7UNUjWNGlKO2JS', 'flora@gmail.com.jpg'),
(50, 'test', 'test@gmail.com', 1, '081234567000', 'jl. garuda', '12345', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bayar`
--
ALTER TABLE `tbl_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tbl_daftar_menu`
--
ALTER TABLE `tbl_daftar_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `tbl_kategori_menu`
--
ALTER TABLE `tbl_kategori_menu`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_list_order`
--
ALTER TABLE `tbl_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `id_menu` (`id_menu`,`id_order`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_daftar_menu`
--
ALTER TABLE `tbl_daftar_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_kategori_menu`
--
ALTER TABLE `tbl_kategori_menu`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_list_order`
--
ALTER TABLE `tbl_list_order`
  MODIFY `id_list_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_daftar_menu`
--
ALTER TABLE `tbl_daftar_menu`
  ADD CONSTRAINT `tbl_daftar_menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori_menu` (`id_kategori`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_list_order`
--
ALTER TABLE `tbl_list_order`
  ADD CONSTRAINT `tbl_list_order_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbl_daftar_menu` (`id_menu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_list_order_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `tbl_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
