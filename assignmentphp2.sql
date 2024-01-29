-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 29, 2024 lúc 10:05 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `assignmentphp2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `ma_binhluan` int(11) NOT NULL,
  `tennguoibinhluan` varchar(225) NOT NULL,
  `ngaybinhluan` date NOT NULL,
  `noidungbinhluan` varchar(225) NOT NULL,
  `FK_ma_taikhoan` int(11) NOT NULL,
  `FK_ma_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`ma_binhluan`, `tennguoibinhluan`, `ngaybinhluan`, `noidungbinhluan`, `FK_ma_taikhoan`, `FK_ma_sp`) VALUES
(3, 'Phạm Ngọc Bảo An', '2024-01-18', 'sản phẩm quá đẹp, quá hợp với túi tiền :3', 4, 10),
(4, 'Phạm Ngọc Bảo An', '2024-01-19', 'đẹp', 4, 26),
(5, 'Phạm Ngọc Bảo An', '2024-01-19', 'đẹp', 4, 27),
(6, 'Phạm Ngọc Bảo An', '2024-01-22', 'vừa xịn vừa rẻ', 4, 12),
(7, 'Đoàn Nhật Hiếu', '2024-01-22', 'cũng đc', 5, 12),
(8, 'Đoàn Nhật Hiếu', '2024-01-22', 'xấu\r\n', 5, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ma_chitietdonhang` int(11) NOT NULL,
  `FK_ma_donhang` int(225) NOT NULL,
  `FK_ma_sanpham` int(225) NOT NULL,
  `soluong_chitiet` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ma_chitietdonhang`, `FK_ma_donhang`, `FK_ma_sanpham`, `soluong_chitiet`) VALUES
(26, 108, 26, 1),
(27, 108, 27, 4),
(28, 108, 19, 1),
(29, 108, 26, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `ma_danhmuc` int(11) NOT NULL,
  `ten_danhmuc` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`ma_danhmuc`, `ten_danhmuc`) VALUES
(1, 'Mô hình One Piece'),
(2, 'Mô hình Naruto'),
(3, 'Liên Minh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ma_donhang` int(11) NOT NULL,
  `tennguoidung` varchar(225) NOT NULL,
  `diachinguoidung` varchar(225) NOT NULL,
  `sdtnguoidung` varchar(11) NOT NULL,
  `emailnguoidung` varchar(225) NOT NULL,
  `tensanpham` varchar(225) NOT NULL,
  `soluong` varchar(225) NOT NULL,
  `tongtien` varchar(225) NOT NULL,
  `trangthai` set('chua-xac-nhan','dang-chuan-bi','dang-giao-hang','giao-hang-thanh-cong','huy-don') NOT NULL DEFAULT 'chua-xac-nhan',
  `FK_ma_taikhoan` int(11) NOT NULL,
  `FK_ma_voucher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ma_donhang`, `tennguoidung`, `diachinguoidung`, `sdtnguoidung`, `emailnguoidung`, `tensanpham`, `soluong`, `tongtien`, `trangthai`, `FK_ma_taikhoan`, `FK_ma_voucher`) VALUES
(108, 'Phạm Ngọc Bảo An', 'Cam Thành', '0927553664', 'anpnb79@gmail.com', 'Mô hình Renekton - Liên Minh ,Mô hình Aatrox - Liên minh ,', '1 ,4 ,', '105060000', 'chua-xac-nhan', 4, 5),
(109, 'Phạm Ngọc Bảo An', 'Cam Thành', '0927553664', 'anpnb79@gmail.com', 'Mô hình Naruto - Lục Đạo ,', '1 ,', '21030000', 'chua-xac-nhan', 4, 5),
(110, 'Phạm Ngọc Bảo An', 'Cam Thành', '0927553664', 'anpnb79@gmail.com', 'Mô hình Renekton - Liên Minh ,', '1 ,', '21030000', 'chua-xac-nhan', 4, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `ma_lienhe` int(11) NOT NULL,
  `ten_nguoilienhe` varchar(100) NOT NULL,
  `email_nguoilienhe` varchar(100) NOT NULL,
  `sdt_nguoilienhe` varchar(11) NOT NULL,
  `noidung_lienhe` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`ma_lienhe`, `ten_nguoilienhe`, `email_nguoilienhe`, `sdt_nguoilienhe`, `noidung_lienhe`) VALUES
(16, 'Phạm An', 'anpnb79@gmail.com', '0973109607', 'làm ơn tư vấn giúp em'),
(17, 'Phạm An', 'Anpnb79@gmail.com', '0973109607', 'làm ơn tư vấn giúp em');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_sp` int(11) NOT NULL,
  `ten_sp` varchar(225) NOT NULL,
  `anh_sp` varchar(225) NOT NULL,
  `gia_sp` int(225) NOT NULL,
  `mota_sp` varchar(225) NOT NULL,
  `luotxem` int(100) NOT NULL DEFAULT 0,
  `FK_ma_danhmuc` int(11) DEFAULT NULL,
  `FK_ma_xuatxu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ma_sp`, `ten_sp`, `anh_sp`, `gia_sp`, `mota_sp`, `luotxem`, `FK_ma_danhmuc`, `FK_ma_xuatxu`) VALUES
(9, 'mô hình Enel - OnePiece', 'imagePrd/enel.jpg', 10000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 8, 1, 1),
(10, 'mô hình râu đen - OnePiece', 'imagePrd/teach.png', 10000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 22, 1, 1),
(11, 'Mô hình Croscodie - OnePiece', 'imagePrd/croscodie.jpg', 15000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 3, 1, 1),
(12, 'Mô hình Kuza - OnePiece', 'imagePrd/kuzan.jpg', 15000300, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 7, 1, 2),
(13, 'Mô hình Kaido - OnePiece', 'imagePrd/kaido.jpg', 21000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 2, 1, 2),
(14, 'Mô hình Donflmingo - OnePiece', 'imagePrd/dofi.png', 21000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 9, 1, 2),
(15, 'Mô hình Brook - OnePiece', 'imagePrd/brook.jpg', 17000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 8, 1, 1),
(16, 'Mô hình Râu Trắng - OnePiece', 'imagePrd/rautrang.png', 24000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 3, 1, 1),
(17, 'Mô hình Luffy - OnePiece', 'imagePrd/luffi.png', 21000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 2, 1, 1),
(18, 'Mô hình Sengoku - OnePiece', 'imagePrd/sengoku.png', 21000000, 'Độ Chính Xác Cao: Sản phẩm mô hình của chúng tôi được xây dựng trên nền tảng công nghệ tiên tiến nhất, mang lại độ chính xác cao với kết quả đáng tin cậy.  Tích Hợp Trí Tuệ Nhân Tạo (AI): Với sự tích hợp của trí tuệ nhân tạo,', 2, 1, 1),
(19, 'Mô hình Naruto - Lục Đạo', 'imagePrd/naruto1.jpg', 21000000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 1, 2, 2),
(20, 'Mô hình Pain - Naruto', 'imagePrd/naruto3.jpg', 2650000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 0, 2, 2),
(21, 'Mô hình Sasuke - Naruto', 'imagePrd/naruto2.jpg', 21000000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 3, 2, 2),
(22, 'Mô hình Itachi - Naruto', 'imagePrd/naruto4.jpg', 1450000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 3, 2, 1),
(24, 'Mô hình zambuza - Naruto', 'imagePrd/naruto5.jpg', 21000000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 13, 2, 1),
(25, 'Mô hình Jiraiza - Naruto', 'imagePrd/product.jpg', 21000000, 'Dòng mô hình Naruto Uzumaki là một kiệt tác nghệ thuật, tái tạo chân thực nhân vật chính của loạt truyện. Bạn sẽ đắm chìm trong chi tiết tinh xảo, từ áo đen chất kỳ đến khuôn mặt đầy tính cách với đôi mắt sáng ngời. Được làm ', 0, 2, 2),
(26, 'Mô hình Renekton - Liên Minh', 'imagePrd/renekton.jpg', 21000000, 'Chào mừng các tín đồ Liên Minh Chiến Binh! Bạn đã bước vào một không gian độc đáo và phong cách, nơi mà chúng tôi tự hào giới thiệu bộ sưu tập mô hình Liên Minh với sự đa dạng về nhân vật và chi tiết chân thực. Hãy khám phá n', 16, 3, 2),
(27, 'Mô hình Aatrox - Liên minh', 'imagePrd/aatrox.jpg', 21000000, 'Chào mừng các tín đồ Liên Minh Chiến Binh! Bạn đã bước vào một không gian độc đáo và phong cách, nơi mà chúng tôi tự hào giới thiệu bộ sưu tập mô hình Liên Minh với sự đa dạng về nhân vật và chi tiết chân thực. Hãy khám phá n', 4, 3, 1),
(28, 'Mô hình Misfortun - Liên Minh', 'imagePrd/mis4.jpg', 21000000, 'Chào mừng các tín đồ Liên Minh Chiến Binh! Bạn đã bước vào một không gian độc đáo và phong cách, nơi mà chúng tôi tự hào giới thiệu bộ sưu tập mô hình Liên Minh với sự đa dạng về nhân vật và chi tiết chân thực. Hãy khám phá n', 16, 3, 2),
(29, 'Mô hình Akali KDA - Liên Minh', 'imagePrd/akali.jpg', 21000000, 'Chào mừng các tín đồ Liên Minh Chiến Binh! Bạn đã bước vào một không gian độc đáo và phong cách, nơi mà chúng tôi tự hào giới thiệu bộ sưu tập mô hình Liên Minh với sự đa dạng về nhân vật và chi tiết chân thực. Hãy khám phá n', 10, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ma_tk` int(11) NOT NULL,
  `hovaten` varchar(225) NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `diachi` varchar(225) NOT NULL,
  `anhnguoidung` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `matkhau` varchar(225) NOT NULL,
  `quyen` set('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`ma_tk`, `hovaten`, `sodienthoai`, `diachi`, `anhnguoidung`, `email`, `matkhau`, `quyen`) VALUES
(1, 'admin', '', '', 'imageUser/QD813740.jpg', 'admin@gmail.com', 'pass', 'admin'),
(4, 'Phạm Ngọc Bảo An', '0927553664', 'Cam Thành', 'imageUser/311526788_1247343795807512_3391778957275628089_n.jpg', 'anpnb79@gmail.com', 'pass', 'user'),
(5, 'Đoàn Nhật Hiếu', '0927553664', 'hòa do 7, Nghĩa Phú', 'imageUser/373399957_1372076893705929_5146613791926094101_n.jpg', 'hieudn79@gmail.com', 'pass', 'user'),
(6, 'Nguyễn Thông Thiên', '0927553664', 'Cam Thành', 'imageUser/Cristofano_dell\'altissimo,_saladino,_ante_1568_-_Serie_Gioviana.jpg', 'thiennt68@gmail.com', 'thien123', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `ma_voucher` int(11) NOT NULL,
  `ten_voucher` varchar(225) DEFAULT NULL,
  `solansudung` int(255) DEFAULT 100,
  `giatri` int(100) DEFAULT NULL,
  `ngaybatdau` date DEFAULT NULL,
  `ngayketthuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`ma_voucher`, `ten_voucher`, `solansudung`, `giatri`, `ngaybatdau`, `ngayketthuc`) VALUES
(1, 'FREESHIP', 84, 0, '2024-01-15', '2024-09-07'),
(2, 'giam30%', 18, 30, '2024-01-15', '2024-09-07'),
(3, 'giam20%', 20, 20, '2024-01-15', '2024-09-07'),
(4, 'giam5%', 98, 5, '2024-01-15', '2024-09-07'),
(5, NULL, 100, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuatxu`
--

CREATE TABLE `xuatxu` (
  `ma_xuatxu` int(11) NOT NULL,
  `noi_xuatxu` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `xuatxu`
--

INSERT INTO `xuatxu` (`ma_xuatxu`, `noi_xuatxu`) VALUES
(1, 'Trung Quốc'),
(2, 'Nhật Bản');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ma_binhluan`),
  ADD KEY `FK_ma_sp` (`FK_ma_sp`),
  ADD KEY `FK_ma_taikhoan` (`FK_ma_taikhoan`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ma_chitietdonhang`),
  ADD KEY `FK_ma_donhang` (`FK_ma_donhang`),
  ADD KEY `FK_ma_sanpham` (`FK_ma_sanpham`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`ma_danhmuc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ma_donhang`),
  ADD KEY `FK_ma_taikhoan` (`FK_ma_taikhoan`),
  ADD KEY `FK_ma_voucher` (`FK_ma_voucher`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`ma_lienhe`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_sp`),
  ADD KEY `FK_ma_danhmuc` (`FK_ma_danhmuc`),
  ADD KEY `FK_ma_xuatxu` (`FK_ma_xuatxu`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ma_tk`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`ma_voucher`);

--
-- Chỉ mục cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  ADD PRIMARY KEY (`ma_xuatxu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ma_binhluan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ma_chitietdonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `ma_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ma_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `ma_lienhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `ma_tk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `ma_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  MODIFY `ma_xuatxu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`FK_ma_sp`) REFERENCES `sanpham` (`ma_sp`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`FK_ma_taikhoan`) REFERENCES `taikhoan` (`ma_tk`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`FK_ma_donhang`) REFERENCES `donhang` (`ma_donhang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`FK_ma_sanpham`) REFERENCES `sanpham` (`ma_sp`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`FK_ma_taikhoan`) REFERENCES `taikhoan` (`ma_tk`),
  ADD CONSTRAINT `donhang_ibfk_3` FOREIGN KEY (`FK_ma_voucher`) REFERENCES `voucher` (`ma_voucher`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`FK_ma_danhmuc`) REFERENCES `danhmuc` (`ma_danhmuc`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`FK_ma_xuatxu`) REFERENCES `xuatxu` (`ma_xuatxu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
