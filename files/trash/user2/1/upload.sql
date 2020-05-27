-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2020 lúc 02:05 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `upload`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user` char(20) NOT NULL,
  `public` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `file`
--

INSERT INTO `file` (`id`, `link`, `user`, `public`) VALUES
(152, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/1', 'user2', 0),
(155, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user3/1', 'admin', 0),
(156, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1', 'admin', 1),
(157, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/AAA (2).rar', 'admin', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trash`
--

CREATE TABLE `trash` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `trash`
--

INSERT INTO `trash` (`id`, `link`, `user`) VALUES
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/# (1).html', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/admin', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `pass`, `name`, `email`) VALUES
('admin', '123456', 'Chủ tịch', ''),
('user1', '123456', 'Trần Đức Bo', ''),
('user10', '123456', 'Vo Tan Luc', 'asdasd@gmail.com'),
('user112', '123789', 'Vo Tan Luc', 'asdasd@gmail.com'),
('user2', '123456', 'yassuo', ''),
('user4', '123456', 'Vo Tan Luc', 'lucpk12@gmail.com'),
('user5', '123456', 'Vo Tan Luc', 'lucpk12@gmail.com'),
('user6', '123456', 'Vo Tan Luc', 'lucpk12@gmail.com'),
('user7', '123456', 'Vo Tan Luc', 'lucpk12@gmail.com'),
('user8', '456789', 'Vo Tan Luc', 'lucpk12@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `link` (`link`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
