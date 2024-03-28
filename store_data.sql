-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 16, 2024 lúc 12:33 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `store_data`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `city` varchar(10) NOT NULL,
  `district` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_user`, `username`, `password`, `phonenumber`, `email`, `city`, `district`, `address`, `role`) VALUES
(1, 'B2106839', '12', '0834477132', 'hoangcao2307003@gmail.com', '96', '964', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 0),
(2, 'Cao Hoàng Khải', 'caohoangkhai', '0834477131', 'caokhai974@gmail.com', '96', '964', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 0),
(3, 'Hoàng Hí Hửng(Hết Wibu)', '12', '0768893383', 'hoangwibu@gmail.com', '87', '866', 'Hẻm 553 ,Đường 30/4', 0),
(4, 'Khangwibu', '123456', '0889580755', 'khang@gmail.com', '96', '971', 's a sa a a', 0),
(5, 'Yến', '1234', '0943355466', 'yen@gmail.com', '96', '964', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 1),
(6, 'Hiếupc', '12', '0943355246', 'hieupc@gmail.com', '01', '250', 'Hẻm 553 ,Đường 30/4', 0),
(7, 'Trần Thị H', 'password32', '9876543210', 'tranthih2@gmail.com', '96', '964', 'Số 320, Đường HIJ, Quận ABC', 0),
(8, 'Lê Thị I', 'password33', '1112223330', 'lethii2@gmail.com', '87', '866', 'Số 330, Đường IJK, Quận XYZ', 0),
(9, 'Phạm Văn K', 'password34', '4445556660', 'phamvank2@gmail.com', '96', '971', 'Số 340, Đường KLM, Quận ABC', 0),
(10, 'Trần Văn L', 'password35', '7778889990', 'tranvanl2@gmail.com', '87', '866', 'Số 350, Đường LMN, Quận XYZ', 0),
(11, 'Nguyễn Thị M', 'password36', '5554443330', 'nguyenthim2@gmail.com', '94', '950', 'Số 360, Đường MNO, Quận ABC', 0),
(12, 'Lê Văn N', 'password37', '2224334440', 'levann2@gmail.com', '96', '964', 'Số 370, Đường NOP, Quận XYZ', 0),
(13, 'Trần Văn O', 'password38', '6667778880', 'tranvano2@gmail.com', '87', '866', 'Số 380, Đường OPQ', 0),
(14, 'Phạm Thị P', 'password39', '9990001110', 'phamthip2@gmail.com', '96', '971', 'Số 390, Đường PQR, Quận XYZ', 0),
(15, 'Hoàng Văn Q', 'password40', '2223334440', 'hoangvanq2@gmail.com', '87', '866', 'Số 400, Đường QRS, Quận ABC', 0),
(16, 'Lê Thị R', 'password41', '5554943330', 'lethir2@gmail.com', '94', '950', 'Số 410, Đường RST, Quận XYZ', 0),
(17, 'Nguyễn Văn S', 'password42', '8889990000', 'nguyenvans2@gmail.com', '96', '971', 'Số 420, Đường STU, Quận ABC', 0),
(18, 'Trần Văn T', 'password43', '9990002110', 'tranvant2@gmail.com', '87', '866', 'Số 430, Đường TUV, Quận XYZ', 0),
(19, 'Hoàng Thị U', 'password44', '0001112220', 'hoangthiu2@gmail.com', '94', '949', 'Số 440, Đường UVW, Quận ABC', 0),
(20, 'Lê Văn V', 'password45', '3334445550', 'levanv2@gmail.com', '96', '964', 'Số 450, Đường VWX, Quận XYZ', 0),
(21, 'Phạm Thị X', 'password46', '6667978880', 'phamthix2@gmail.com', '87', '867', 'Số 460, Đường XYZ, Quận ABC', 0),
(22, 'Trần Văn Y', 'password47', '9940001110', 'tranvany2@gmail.com', '94', '950', 'Số 470, Đường YZK, Quận XYZ', 0),
(23, 'Nguyễn Thị Z', 'password48', '2221334440', 'nguyenthiz2@gmail.com', '87', '866', 'Số 480, Đường ZKL, Quận ABC', 0),
(24, 'Hoàng Văn A', 'password49', '5554643330', 'hoangvana2@gmail.com', '96', '971', 'Số 490, Đường ABC, Quận XYZ', 0),
(25, 'Lê Thị B', 'password50', '8889790000', 'lethib2@gmail.com', '96', '971', 'Số 500, Đường BCD, Quận ABC', 0),
(26, 'Nguyễn Văn G', 'password31', '1234567890', 'nguyenvang3@gmail.com', '1', '268', 'Số 510, Đường GHI, Quận XYZ', 0),
(27, 'Trần Thị H', 'password32', '9976543210', 'tranthih3@gmail.com', '96', '964', 'Số 520, Đường HIJ, Quận ABC', 0),
(28, 'Lê Thị I', 'password33', '1112242333', 'lethii3@gmail.com', '87', '866', 'Số 530, Đường IJK, Quận XYZ', 0),
(29, 'Phạm Văn K', 'password34', '4445516660', 'phamvank3@gmail.com', '96', '971', 'Số 540, Đường KLM, Quận ABC', 0),
(30, 'Trần Văn L', 'password35', '7778878990', 'tranvanl3@gmail.com', '87', '867', 'Số 550, Đường LMN, Quận XYZ', 0),
(31, 'Nguyễn Thị M', 'password36', '5558443330', 'nguyenthim3@gmail.com', '94', '950', 'Số 560, Đường MNO, Quận ABC', 0),
(32, 'Lê Văn N', 'password37', '2223337440', 'levann3@gmail.com', '96', '964', 'Số 570, Đường NOP, Quận XYZ', 0),
(33, 'Nguyễn Văn X', 'password33', '333444555', 'nguyenvanx@gmail.com', '1', '268', 'Số 33, Đường XYZ, Quận ABC', 0),
(34, 'Trần Thị Y', 'password34', '444555666', 'tranthiy@gmail.com', '96', '964', 'Số 34, Đường YZA, Quận XYZ', 0),
(35, 'Lê Thị Z', 'password35', '555666777', 'lethiz@gmail.com', '87', '866', 'Số 35, Đường ZAB, Quận ABC', 0),
(36, 'Phạm Văn A', 'password36', '666777888', 'phamvana@gmail.com', '96', '971', 'Số 36, Đường ABC, Quận XYZ', 0),
(37, 'NewUser31', 'password31', '1111222334', 'newuser31@gmail.com', '96', '971', 'New Address 31', 0),
(38, 'NewUser32', 'password32', '2222333445', 'newuser32@gmail.com', '87', '866', 'New Address 32', 0),
(39, 'NewUser33', 'password33', '3333444556', 'newuser33@gmail.com', '94', '950', 'New Address 33', 0),
(40, 'NewUser34', 'password34', '4444555667', 'newuser34@gmail.com', '96', '971', 'New Address 34', 0),
(41, 'NewUser35', 'password35', '5555666778', 'newuser35@gmail.com', '87', '866', 'New Address 35', 0),
(42, 'NewUser36', 'password36', '6666777889', 'newuser36@gmail.com', '94', '950', 'New Address 36', 0),
(43, 'NewUser37', 'password37', '7777888900', 'newuser37@gmail.com', '96', '971', 'New Address 37', 0),
(44, 'NewUser38', 'password38', '8888999111', 'newuser38@gmail.com', '87', '866', 'New Address 38', 0),
(45, 'NewUser39', 'password39', '9999000222', 'newuser39@gmail.com', '94', '950', 'New Address 39', 0),
(46, 'NewUser40', 'password40', '1111222335', 'newuser40@gmail.com', '96', '971', 'New Address 40', 0),
(47, 'NewUser41', 'password41', '2222333446', 'newuser41@gmail.com', '87', '866', 'New Address 41', 0),
(48, 'NewUser42', 'password42', '3333444557', 'newuser42@gmail.com', '94', '950', 'New Address 42', 0),
(50, 'NewUser44', 'password44', '5555666779', 'newuser44@gmail.com', '87', '866', 'New Address 44', 0),
(51, 'NewUser45', 'password45', '6666777890', 'newuser45@gmail.com', '94', '950', 'New Address 45', 0),
(52, 'NewUser46', 'password46', '7777888001', 'newuser46@gmail.com', '96', '971', 'New Address 46', 0),
(53, 'NewUser47', 'password47', '8888999112', 'newuser47@gmail.com', '87', '866', 'New Address 47', 0),
(54, 'NewUser48', 'password48', '9999000223', 'newuser48@gmail.com', '94', '950', 'New Address 48', 0),
(55, 'NewUser49', 'password49', '1111222336', 'newuser49@gmail.com', '96', '971', 'New Address 49', 0),
(56, 'NewUser50', 'password50', '2222333447', 'newuser50@gmail.com', '87', '866', 'New Address 50', 0),
(57, 'NewUser51', 'password51', '3333444558', 'newuser51@gmail.com', '94', '950', 'New Address 51', 0),
(58, 'NewUser52', 'password52', '4444555669', 'newuser52@gmail.com', '96', '971', 'New Address 52', 0),
(59, 'NewUser53', 'password53', '5555666780', 'newuser53@gmail.com', '87', '866', 'New Address 53', 0),
(60, 'NewUser54', 'password54', '6666777891', 'newuser54@gmail.com', '94', '950', 'New Address 54', 0),
(61, 'NewUser55', 'password55', '7777888002', 'newuser55@gmail.com', '96', '971', 'New Address 55', 0),
(62, 'NewUser56', 'password56', '8888999113', 'newuser56@gmail.com', '87', '866', 'New Address 56', 0),
(63, 'NewUser57', 'password57', '9999000224', 'newuser57@gmail.com', '94', '950', 'New Address 57', 0),
(64, 'NewUser58', 'password58', '1111222337', 'newuser58@gmail.com', '96', '971', 'New Address 58', 0),
(65, 'NewUser59', 'password59', '2222333448', 'newuser59@gmail.com', '87', '866', 'New Address 59', 0),
(66, 'NewUser60', 'password60', '7777888003', 'newuser60@gmail.com', '96', '971', 'New Address 60', 0),
(113, 'B2106839', '12', '0834477136', 'hoangcao230700123@gmail.com', '96', '966', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 0),
(114, 'B2106839', 'Admin@123', '', 'hoangcao230703@gmail.com', '', '', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feed_back`
--

CREATE TABLE `feed_back` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `feed_back`
--

INSERT INTO `feed_back` (`id`, `username`, `phonenumber`, `email`, `address`, `note`, `created`) VALUES
(36, 'Cao Hoàng Khải', '0834477131', 'hoangcao230703@gmail.com', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 'hi chào admin', '2024-03-10 15:39:48'),
(37, 'B2106839', '0943355466', 'hoangcao230703@gmail.com', 'Hẻm 553 ,Đường 30/4', 'hihi', '2024-03-13 13:10:33'),
(38, 'Cao Hoàng Khải', '0943355467', 'caokhai974@gmail.com', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', '', '2024-03-13 13:45:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_customer`
--

CREATE TABLE `order_customer` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `email` varchar(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `type` varchar(40) NOT NULL,
  `price` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `order_customer`
--

INSERT INTO `order_customer` (`id_order`, `id_user`, `username`, `phonenumber`, `address`, `note`, `email`, `status`, `type`, `price`, `created`) VALUES
(42, 1, 'Cao Hoàng Khải', '0943355467', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', 'hàng dễ vỡ', 'hoangcao230703@gmail.com', 3, 'Thanh_Toan_Qua_Ngan_Hang', '20000', '2024-03-14 08:58:58'),
(43, 1, 'Cao Hoàng Khải', '0834477131', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', '', 'dclsmd3107@dcctb.com', 2, 'Thanh_Toan_Qua_Ngan_Hang', '95000', '2024-03-14 09:21:35'),
(45, 1, 'Cao Hoàng Khải', '0943355467', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', '', 'hieupc@gmail.com', 0, 'Thanh_Toan_Qua_Ngan_Hang', '20000', '2024-03-13 11:11:45'),
(46, 22, 'Trần Văn Y', '9940001110', 'Số 470, Đường YZK, Quận XYZ', 'giao hàng đúng giờ, hàng dễ vỡ, điện trước khi giao', 'dclsmd3107@dcctb.com', 0, 'Thanh_Toan_Bang_Vi_Dien_Tu', '20000', '2024-03-13 12:57:16'),
(47, 1, 'B2106839', '0943355466', 'Hẻm 553 ,Đường 30/4', '', 'hieupc@gmail.com', 0, 'Thanh_Toan_Khi_Nhan_Hang', '70000', '2024-03-13 13:07:53'),
(48, 3, 'Hoàng Wibu', '0943355466', 'Nhà Bè', '', 'hoangwibu@gmail.com', 1, 'Thanh_Toan_Khi_Nhan_Hang', '35000', '2024-03-16 09:28:15'),
(49, 1, 'Cao Hoàng Khải', '0943355466', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', '', 'hieupc@gmail.com', 3, 'Thanh_Toan_Bang_Vi_Dien_Tu', '707000', '2024-03-16 09:27:22'),
(52, 114, 'Cao Hoàng Khải', '0943355466', '61-63,Lý Văn Lâm,Khóm 3,Phường 1', '', 'caokhai974@gmail.com', 0, 'Thanh_Toan_Khi_Nhan_Hang', '6900000', '2024-03-16 11:09:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_product` int(11) NOT NULL,
  `price` varchar(20) NOT NULL,
  `item_code` varchar(40) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `product_id`, `quantity_product`, `price`, `item_code`, `id_order`) VALUES
(29, 1, 1, '20000 ', '4961', 42),
(30, 1, 1, '20000 ', '9944', 43),
(31, 2, 1, '35000', '9944', 43),
(32, 3, 1, '40000', '9944', 43),
(33, 1, 1, '20000 ', '7434', 45),
(34, 1, 1, '20000 ', '1728', 46),
(35, 2, 2, '35000', '496', 47),
(36, 1, 1, '20000 ', '2257', 48),
(37, 5, 1, '15000', '2257', 48),
(38, 1, 7, '20000 ', '2572', 49),
(39, 2, 6, '35000', '2572', 49),
(40, 9, 1, '26000', '2572', 49),
(41, 10, 2, '23000', '2572', 49),
(42, 3, 6, '40000', '2572', 49),
(43, 4, 2, '15000', '2572', 49),
(44, 5, 1, '15000', '2572', 49),
(45, 1, 3, '20000 ', '3280', 50),
(46, 2, 2, '35000', '3280', 50),
(47, 3, 2, '40000', '3280', 50),
(48, 9, 1, '26000', '3280', 50),
(49, 8, 2, '20000', '3280', 50),
(50, 6, 1, '45000', '3280', 50),
(51, 4, 4, '15000', '3280', 50),
(52, 18, 1, '45000', '3280', 50),
(53, 1, 35, '20000 ', '921', 52),
(54, 3, 41, '40000', '921', 52),
(55, 4, 44, '15000', '921', 52),
(56, 5, 48, '15000', '921', 52),
(57, 11, 50, '19500', '921', 52),
(58, 18, 49, '45000', '921', 52);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(4) NOT NULL,
  `product_name` text NOT NULL,
  `type` text NOT NULL,
  `image` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `type`, `image`, `price`, `quantity`, `sold`) VALUES
(1, 'GẠO LỨT TÍM THAN', 'Gao_Lut', 'gao_lut_tim_than.png', '20000 ', 50, 50),
(2, 'GẠO HUYẾT RỒNG', 'Gao_Dac_San', 'gao_huyet_rong.png', '35000', 39, 11),
(3, 'GẠO LỨT HUYẾT RỒNG', 'Gao_Lut', 'gao_lut_huyet_rong_7.png', '40000', 50, 50),
(4, 'GẠO TẤM SÀ MƠ', 'Gao_Tam', 'gao_tam_sa_mo.png', '15000', 50, 50),
(5, 'GẠO TẤM ĐÀI LOAN', 'Gao_Tam', 'gao_tam_dai_loan.png', '15000', 50, 50),
(6, 'GẠO NẾP NƯƠNG ĐIỆN BIÊN', 'Gao_Nep', 'nep_nuong_dien_bien.png', '45000', 49, 1),
(7, 'HẠT NGỌC TRỜI (TIÊN NỮ)', 'Gao_Dac_San', 'hat_ngoc_troi_tien_nu.png', '38000', 50, 0),
(8, 'GẠO 64 THƠM DỨA', 'Gao_Deo_Thom', 'gao_64_thom_dua.png', '20000', 48, 2),
(9, 'GẠO ĐÀI LOAN SỮA', 'Gao_Deo_Thom', 'gao_dai_loan_sua.png', '26000', 48, 2),
(10, 'GẠO HƯƠNG LÀI (ĐẶC BIỆT)', 'Gao_Deo_Thom', 'gao_huong_lai_dac_biet.png', '23000', 48, 2),
(11, 'GẠO LÀI SỮA', 'Gao_Deo_Thom', 'gao_lai_sua.png', '19500', 0, 50),
(12, 'GẠO NÀNG HOA', 'Gao_Deo_Thom', 'gao_nang_hoa.png', '19000', 50, 0),
(13, 'GẠO JASMINE', 'Gao_Deo_Thom', 'gao_thom_jesmine.png', '20000', 50, 0),
(14, 'GẠO THƠM LÀI AA', 'Gao_Deo_Thom', 'gao_thom_lai_AAA.png', '19000', 50, 0),
(15, 'GẠO THƠM LÀI NHẬT', 'Gao_Deo_Thom', 'gao_thom_lai_nhat.png', '19000', 50, 0),
(16, 'GẠO THƠM MỸ', 'Gao_Deo_Thom', 'gao_thom_my.png', '20000', 50, 0),
(17, 'GẠO THƠM THÁI LAN', 'Gao_Deo_Thom', 'gao_thom_thai.png', '19500', 50, 0),
(18, 'GẠO LỨT TRẮNG', 'Gao_Lut', 'gao_lut_trang.png', '45000', 0, 50),
(19, 'GẠO NẾP CẨM', 'Gao_Nep', 'gao_nep_cam.png', '20000', 50, 0),
(20, 'GẠO NẾP THÁI', 'Gao_Nep', 'gao_nep_thai.png', '25000', 50, 0),
(21, 'GẠO NẾP TÚ LÊ', 'Gao_Nep', 'gao_nep_tu_le.png', '60000', 50, 0),
(22, 'GẠO NẾP BẮC CÁI HOA VÀNG', 'Gao_Nep', 'nep_bac_cai_hoa_vang.png', '35000', 50, 0),
(23, 'GẠO NẾP CÁI HOA VÀNG', 'Gao_Nep', 'nep_cai_hoa_vang.png', '35000', 50, 0),
(24, 'GẠO NẾP ĐIỆN BIÊN', 'Gao_Nep', 'nep_nuong_dien_bien.png', '45000', 50, 0),
(25, 'GẠO TẤM THƠM-PMT', 'Gao_Tam', 'gao_tam_thom_PMT.png', '27500', 50, 0),
(26, 'GẠO TẤM TÀI NGUYÊN', 'Gao_Tam', 'gao_tam_tai_nguyen.png', '16000', 50, 0),
(27, 'Gạo Tấm Thơm Angel', 'Gao_Tam', 'gao_tam_thom_Angel_Fine_Foods.png', '42500 ', 50, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity_sp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `id_user`, `product_id`, `quantity_sp`) VALUES
(51, 5, 1, 4),
(52, 5, 6, 0),
(53, 5, 11, 0),
(54, 5, 9, 2),
(56, 1, 1, 1),
(57, 1, 2, 0),
(58, 1, 9, 0),
(59, 1, 10, 0),
(65, 1, 6, 0),
(66, 1, 8, 0),
(67, 1, 3, 1),
(72, 1, 4, 0),
(73, 22, 1, 0),
(74, 1, 7, 0),
(75, 3, 1, 0),
(76, 3, 5, 0),
(77, 3, 4, 1),
(78, 1, 12, 1),
(79, 1, 11, 0),
(80, 1, 5, 0),
(85, 114, 1, 3),
(89, 114, 3, 0),
(90, 114, 4, 0),
(102, 1, 18, 0),
(103, 1, 13, 0),
(104, 1, 20, 0),
(105, 1, 27, 0),
(106, 1, 25, 0),
(107, 1, 14, 0),
(108, 1, 16, 0),
(109, 114, 5, 0),
(110, 114, 11, 0),
(111, 114, 18, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`);

--
-- Chỉ mục cho bảng `feed_back`
--
ALTER TABLE `feed_back`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  ADD PRIMARY KEY (`id_order`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_cart_ibfk_1` (`id_user`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT cho bảng `feed_back`
--
ALTER TABLE `feed_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `order_customer`
--
ALTER TABLE `order_customer`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `customer` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
