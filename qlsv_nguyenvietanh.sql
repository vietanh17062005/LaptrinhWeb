-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 7, 2024 lúc 01:40 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsv_nguyenvietanh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `table_students`
--

CREATE TABLE `table_students` (
  `id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `dob` datetime NOT NULL,
  `gender` int(5) NOT NULL,
  `hometown` varchar(100) NOT NULL,
  `level_id` int(10) NOT NULL,
  `group_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `table_students`
--

INSERT INTO `table_students` (`id`, `full_name`, `dob`, `gender`, `hometown`, `level_id`, `group_id`) VALUES
(1, 'Nguyễn Việt Anh', '2005-06-17 06:00:00', 1, 'Thanh Hóa', 3, 7),
(2, 'Nguyễn Việt Hoàng An', '2005-06-03 07:00:00', 1, 'TP Hồ Chí Minh', 3, 7),
(3, 'Nguyễn Ngọc Bích', '2005-10-01 08:00:00', 0, 'Hà Nội', 3, 7),
(4, 'Lại Văn Hưng', '2005-09-01 09:00:00', 1, 'Thanh Hóa', 3, 7),
(5, 'Trần Duy Hưng', '2005-04-27 10:00:00', 1, 'Hà Nội', 3, 7),
(6, 'Nguyễn Ngọc Linh', '2005-08-22 11:00:00', 0, 'Đà Nẵng', 3, 7);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `table_students`
--
ALTER TABLE `table_students`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
