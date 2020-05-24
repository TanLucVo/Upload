-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2020 lúc 08:48 AM
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
(152, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/1', 'user2', 1),
(162, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/1/upload.sql', 'user2', 1),
(164, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user3/upload.sql', 'user3', 1),
(169, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/1/123', 'user2', 1),
(170, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/1/123/Web - Diem giua ky.zip', 'user2', 1),
(171, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/12356', 'user3', 0),
(172, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/123123123', 'user3', 0),
(173, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user2/qweqwe.pdf', 'user1', 0),
(175, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user11.html', 'user1', 0),
(186, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/# (1).html', 'user1', 0),
(187, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/#.html', 'user1', 0),
(195, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1/New-Text-Document.txt', 'user1', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `limitupload`
--

CREATE TABLE `limitupload` (
  `data` int(11) NOT NULL,
  `numfile` int(11) NOT NULL,
  `filedata` int(11) NOT NULL,
  `typeNotAceppt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `limitupload`
--

INSERT INTO `limitupload` (`data`, `numfile`, `filedata`, `typeNotAceppt`) VALUES
(1073741824, 10, 1073741824, 'py sql');

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
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/user1', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/admin/user1', 'admin'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user3/123', 'user3'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user3/1', 'user3'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user3/1234 (2).html', 'user3'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user2/123', 'user2'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user2/abvc', 'user2'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/1234 (1).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/1234 (2).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/1234.html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/123456 (1).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/123456 (2).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/123456 (3).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/123456 (4).html', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/1513760249041_generic-sale-template', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/51800900-2 (3).rar', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/51800900-2 (4).rar', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/AAA (1).rar', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/AAA (2).rar', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/AAA.rar', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/CheatEngine 6.5.2 (1).apk', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/CheatEngine 6.5.2.apk', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/Web - Diem giua ky.zip', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/qwe (9).zip', 'user1'),
(0, 'C:/xampp/htdocs/BuffaloDrive/Upload/files/trash/user1/test.png', 'user1');

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
('user2', '123456', 'yassuo', ''),
('user3', '123456', 'Vo Tan Luc', 'asdasd@gmail.com'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
