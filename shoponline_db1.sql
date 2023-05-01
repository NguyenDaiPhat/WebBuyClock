-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 01, 2022 lúc 06:59 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29
create database shoponline_db;
use shopOnline_db;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoponline_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(200) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`ID`, `user_id`, `name`, `price`, `quantity`, `image`, `brand`) VALUES
(1, 1, 'ORIENT WATCH FAG02003W0', 733, 2, 'ORIENT WATCH FAG02003W0.jpg', 'ORIENT'),
(57, 2, 'ORIENT WATCH RA-AK0008S10B', 1240, 1, 'ORIENT WATCH RA-AK0008S10B.jpg', 'ORIENT'),
(58, 2, 'ORIENT WATCH RE-AV0B03B00B', 2575, 1, 'ORIENT WATCH RE-AV0B03B00B.jpg', 'ORIENT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`ID`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(7, 5, 'Jonny', 'abcd@123.com', '12312', '134'),
(9, 2, 'Jonny', 'abcd@123.com', '213', '12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `detail_address` varchar(200) NOT NULL,
  `commune` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT "pending"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ID`, `user_id`, `name`, `number`, `email`, `method`, `detail_address`, `commune`, `district`, `city`, `country`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(3, 2, 'Jonny', '0788087260', 'abcd@123.com', 'Payment method', '12 Dong Coi', 'Nam Giang', 'Namtruc', 'Namdinh', 'Việt Namm', '12 Dong Coi, Nam Giang, Namtruc, Namdinh, Việt Namm', '<br>ORIENT WATCH FAG03001D0 (1) <br>ORIENT WATCH FAG02003W0 (1) ', 1665, '01-Aug-2022', 'Pending'),
(4, 2, 'Jonny', '0788087260', 'abcd@123.com', 'Payment method', '12 Dong Coi', 'Nam Giang', 'Namtruc', 'Namdinh', 'Việt Nam', '12 Dong Coi, Nam Giang, Namtruc, Namdinh, Việt Nam', '<br>ORIENT WATCH RA-AK0008S10B (1) <br>BENTLEY WATCH BL1869-101MKNN-DMK-GL-X (1) ', 1651, '01-Aug-2022', 'pending'),
(5, 0, 'Jonny', '0789184291', 'abcd@123.com', 'Payment method', '12 Dong Coi', 'Nam Giang', 'Namtruc', 'Namdinh', 'Việt Nam', '12 Dong Coi, Nam Giang, Namtruc, Namdinh, Việt Nam', '<br>ORIENT WATCH FAG03001D0 (2) <br>ORIENT WATCH FAG02003W0 (2) <br>ORIENT WATCH RE-AV0B03B00B (2) <br>Olympia WATCH FA03W0 (2) ', 9946, '01-Aug-2022', 'pending'),
(6, 0, 'Jonny', '0789184291', 'abcd@123.com', 'card', '12 Dong Coi', 'Nam Giang', 'Namtruc', 'Namdinh', 'Việt Namawefr', '12 Dong Coi, Nam Giang, Namtruc, Namdinh, Việt Namawefr', '<br>ORIENT WATCH RA-AK0008S10B (1) ', 1240, '01-Aug-2022', 'pending'),
(7, 0, 'Jonny', '0789184291', 'abcd@123.com', 'card', '12 Dong Coi', 'Nam Giang', 'Namtruc', 'Namdinh', 'Việt Namawefr phatdz', '12 Dong Coi, Nam Giang, Namtruc, Namdinh, Việt Namawefr phatdz', '<br>ORIENT WATCH RA-AK0008S10B (1) <br>ORIENT WATCH RE-AV0B03B00B (1) <br>BENTLEY WATCH BL1869-101MKNN-DMK-GL-X (10) ', 7925, '01-Aug-2022', 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `image` varchar(100) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `name`, `price`, `image`, `detail`, `brand`) VALUES
(1, 'ORIENT WATCH FAG03001D0', 932, 'ORIENT WATCH FAG03001D0.jpg', 'Open Heart design with trendy navy blue di', 'ORIENT'),
(3, 'ORIENT WATCH RA-AK0008S10B', 1240, 'ORIENT WATCH RA-AK0008S10B.jpg', 'Open Heart design with delicate silver cladding', 'ORIENT'),
(4, 'ORIENT WATCH RE-AV0B03B00B', 2575, 'ORIENT WATCH RE-AV0B03B00B.jpg', 'Open Heart design with elegant silver paneling', 'ORIENT'),
(5, 'ORIENT WATCH FAC7W0', 805, 'ORIENT WATCH FAC7W0.jpg', 'Charming curved glass legend', 'ORIENT'),
(6, 'BENTLEY WATCH BL1869-101MKNN-DMK-GL-X', 411, 'BENTLEY WATCH BL1869-101MKNN-DMK-GL-X.jpg', 'Classically simple but sophisticating', 'BENTLEY'),
(7, 'BENTLEY WATCH BL1869-101MWWB-DMS-GL-T', 397, 'BENTLEY WATCH BL1869-101MWWB-DMS-GL-T.jpg', 'An irreplaceable BENTLEY huge hit', 'BENTLEY'),
(8, 'BENTLEY WATCH BL1832-25MKWD', 584, 'BENTLEY WATCH BL1832-25MKWD.jpg', 'Exemplary traditional craftwork', 'BENTLEY'),
(9, 'BENTLEY WATCH BL778588K-T', 845, 'BENTLEY WATCH BL1850-15MTWI-AMSK-T.jpg', 'Elegant fashion through the ages', 'BENTLEY'),
(10, 'BENTLEY WATCH BL4444L-X', 329, 'BENTLEY WATCH BL1869-10MWNN-MS-GL-X.jpg', 'Open Heart design with the color of the ocean', 'BENTLEY'),
(11, 'Olympia WATCH FD0', 932, '1.jpg', 'Highlights Open Heart design with trendy navy blue dial', 'Olympia'),
(12, 'Olympia WATCH FA03W0', 733, '2.jpg', 'Outstanding design of Open Heart with luxurious PVD gold plating', 'Olympia'),
(13, 'Olympia WATCH RA8S10B', 1240, '3.jpg', 'Outstanding design of Open Heart with delicate silver cladding', 'Olympia'),
(14, 'Olympia WATCH 0B03B00B', 2575, '4.jpg', 'Outstanding design Open Heart with elegant silver paneling', 'Olympia'),
(15, 'Olympia WATCH FAC07W0', 805, '5.jpg', 'Charming, sophisticated and contemporary curved glass mythology', 'Olympia'),
(16, 'Olympia WATCH BL69-108477-GL-X', 411, '6.jpg', 'Classically simple but sophisticated', 'Olympia'),
(17, 'Olympia WATCH BL186M777S-GL-T', 397, '7.jpg', 'Subtle silhouette of the Patek Philippe Geneve Nautilus', 'Olympia'),
(18, 'Olympia WATCH BL888183D', 584, '8.jpg', 'The pinnacle of traditional,magnificent and opulent craftsmanship', 'Olympia'),
(19, 'Ogival WATCH BL1833350SK-T', 845, '9.jpg', 'Elegant fashion through the ages', 'Ogival'),
(20, 'Ogival WATCH BL-10MWN454N-MS-GL-X', 329, '10.jpg', 'Open Heart design with the color of the ocean', 'Ogival'),
(21, 'Ogival WATCH FAG0444401D0', 932, '11.jpg', 'Highlights Open Heart design with trendy navy blue dial', 'Ogival'),
(22, 'Ogival WATCH F005553W0', 733, '12.jpg', 'Outstanding design of Open Heart with delicate silver cladding', 'Ogival'),
(23, 'Ogival WATCH RE-AV777000B', 2575, '14.jpg', 'Open Heart design with elegant silver paneling', 'Ogival'),
(24, 'Ogival WATCH FAC08354157W0', 805, '15.jpg', 'Charming curved glass legend', 'Ogival'),
(25, 'Citizen WATCH BL14358', 411, '16.jpg', 'Classically simple crafting but sophisticated and opulent, a smash hit', 'Citizen'),
(26, 'Citizen WATCH BL145301MS-GL-T', 397, '17.jpg', 'Subtle silhouette of the Patek Philippe Geneve Nautilus', 'Citizen'),
(27, 'Citizen WATCH BL5MKWD', 584, '18.jpg', 'The pinnacle of traditional,magnificent and opulent craftsmanship', 'Citizen'),
(28, 'Citizen WATCH BL18856MSK-T', 845, '19.jpg', 'Elegant fashion through the ages', 'Citizen'),
(29, 'Citizen WATCH BL18545', 329, '20.jpg', 'Opulent, fashionating and Open Heart design with the power of the ocean', 'Citizen'),
(30, 'Citizen WATCH FAG4241D0', 932, '21.jpg', 'Highlights Open Heart design with trendy navy blue dial', 'Citizen'),
(31, 'Citizen WATCH FA7572003W0', 733, '22.jpg', 'Open Heart design with luxurious PVD gold plating', 'Citizen'),
(32, 'Citizen WATCH R08568B', 1240, '23.jpg', 'Outstanding design of Open Heart with delicate silver cladding', 'Citizen'),
(33, 'Citizen WATCH R065780B', 2575, '24.jpg', 'Outstanding design Open Heart with elegant silver paneling', 'Citizen'),
(34, 'Citizen WATCH F51567851W0', 805, '25.jpg', 'Charming curved glass legend', 'Citizen'),
(35, 'Freelook WATCH B55754154-X', 411, '26.jpg', 'Classical simplicity but sophisticated', 'Freelook'),
(36, 'Freelook WATCH BL175785564T', 397, '27.jpg', 'Subtle silhouette of the Patek Philippe Geneve Nautilus', 'Freelook'),
(37, 'Freelook WATCH BL656785489D', 584, '28.jpg', 'The pinnacle of classic crafting', 'Freelook'),
(38, 'Freelook WATCH B5857456T', 845, '29.jpg', 'Elegant, sophisticated and opulent fashion through the ages', 'Freelook'),
(39, 'Freelook WATCH BL5783661465X', 329, '30.jpg', 'Open Heart design with the power of the ocean', 'Freelook'),
(40, 'Freelook WATCH R56783560B', 1240, '31.jpg', 'Open Heart design with delicate silver cladding', 'Freelook'),
(41, 'Freelook WATCH RE65415B00B', 2575, '32.jpg', 'Open Heart design with delicate silver paneling', 'Freelook'),
(42, 'Freelook WATCH FA61265007W0', 805, '33.jpg', 'Charming curved glass legend', 'Freelook'),
(43, 'Freelook WATCH BL45845451-GL-X', 411, '34.jpg', 'Classical simplicity but sophisticated', 'Freelook'),
(44, 'Freelook WATCH BL15515WB-DMS-GL-T', 397, '35.jpg', 'Subtle silhouette of the Patek Philippe Geneve Nautilus', 'Freelook'),
(45, 'Freelook WATCH B8774478WD', 584, '36.jpg', 'Elegant, The pinnacle of classic crafting', 'Freelook'),
(46, 'Freelook WATCH BL45145-T', 845, '37.jpg', 'Elegant, sophisticated and opulent fashion through the ages', 'Freelook');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL DEFAULT "user"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users` password: 123
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'), 
(2, 'abc', 'abcd@123.com', '202cb962ac59075b964b07152d234b70', 'user'),
(3, 'user', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'user1', 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(5, '123', '123@gmail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
