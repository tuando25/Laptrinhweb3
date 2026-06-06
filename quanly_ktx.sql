-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2026 at 10:28 AM
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
-- Database: `quanly_ktx`
--

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` int(11) NOT NULL,
  `id_phong` int(11) NOT NULL,
  `thang_nam` varchar(7) NOT NULL,
  `tien_phong` decimal(10,2) NOT NULL,
  `tien_dien` decimal(10,2) DEFAULT 0.00,
  `tien_nuoc` decimal(10,2) DEFAULT 0.00,
  `tong_tien` decimal(10,2) NOT NULL,
  `trang_thai` varchar(30) DEFAULT 'Chưa thanh toán'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `id_phong`, `thang_nam`, `tien_phong`, `tien_dien`, `tien_nuoc`, `tong_tien`, `trang_thai`) VALUES
(3, 4, '2026-05', 1300000.00, 120000.00, 40000.00, 1460000.00, 'Đã thanh toán'),
(4, 5, '2026-05', 1300000.00, 210000.00, 80000.00, 1590000.00, 'Đã thanh toán'),
(5, 7, '2026-05', 800000.00, 310000.00, 110000.00, 1220000.00, 'Đã thanh toán'),
(6, 8, '2026-05', 1300000.00, 95000.00, 35000.00, 1430000.00, 'Đã thanh toán'),
(7, 7, '2026-06', 800000.00, 100000.00, 25000.00, 925000.00, 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id` int(11) NOT NULL,
  `ten_phong` varchar(50) NOT NULL,
  `loai_phong` varchar(50) NOT NULL,
  `suc_chua` int(11) NOT NULL,
  `so_nguoi_o` int(11) DEFAULT 0,
  `gia_phong` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`id`, `ten_phong`, `loai_phong`, `suc_chua`, `so_nguoi_o`, `gia_phong`) VALUES
(3, 'P103', 'Nam', 6, 0, 100000.00),
(4, 'P104', 'Nữ', 4, 2, 1300000.00),
(5, 'P201', 'Nữ', 4, 2, 1300000.00),
(6, 'P202', 'Nữ', 6, 0, 1100000.00),
(7, 'P203', 'Nam', 8, 2, 800000.00),
(8, 'P204', 'Nữ', 4, 2, 1300000.00),
(9, 'P301', 'Nam', 4, 0, 1200000.00),
(10, 'P302', 'Nữ', 4, 0, 1300000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `id` int(11) NOT NULL,
  `ma_sv` varchar(20) NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `gioi_tinh` varchar(10) NOT NULL,
  `id_phong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`id`, `ma_sv`, `ho_ten`, `gioi_tinh`, `id_phong`) VALUES
(1, 'SV01', 'Nguyễn Văn An', 'Nam', 8),
(2, 'SV02', 'Trần Minh Bảo', 'Nam', 8),
(3, 'SV03', 'Lê Hoàng Cường', 'Nam', NULL),
(4, 'SV04', 'Phạm Đức Duy', 'Nam', NULL),
(5, 'SV05', 'Vũ Hoàng Hải', 'Nam', NULL),
(6, 'SV06', 'Nguyễn Thu Hà', 'Nữ', 4),
(7, 'SV07', 'Trần Thị Hương', 'Nữ', 4),
(8, 'SV08', 'Nguyễn Mai Lan', 'Nữ', 5),
(9, 'SV09', 'Phạm Hồng Nhung', 'Nữ', 5),
(10, 'SV10', 'Bùi Phan Khánh', 'Nam', 7),
(11, 'SV11', 'Đỗ Tiến Đạt', 'Nam', 7),
(12, 'SV12', 'Nguyễn Khánh Linh', 'Nữ', 8),
(13, 'sv67abc', 'abc', 'Nam', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ho_ten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `ho_ten`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Quản Trị Viên');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_phong` (`ten_phong`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ma_sv` (`ma_sv`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `sinh_vien_ibfk_1` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
