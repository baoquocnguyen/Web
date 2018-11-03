-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 30, 2017 lúc 04:15 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vn_nagecco`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `luot_xem` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `album`
--

INSERT INTO `album` (`id`, `cat`, `ten`, `chu_thich`, `hinh`, `hien_thi`, `time`, `user`, `luot_xem`) VALUES
(1, 1, '1', '', '1-1.jpg', 1, 1501556646, 5, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `id` int(11) NOT NULL,
  `tenkh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_den` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_di` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tong_cong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `do_la` int(20) NOT NULL,
  `loai_phong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_phong` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `so_nguoi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tre_em` int(20) NOT NULL,
  `nguoi_lon` int(11) NOT NULL,
  `thanh_toan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `dua_don` int(1) NOT NULL,
  `thoi_gian_den` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chuyen_bay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_di` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gia_dua_don` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenphong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room_id` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`id`, `tenkh`, `sdt`, `dia_chi`, `email`, `ngay_den`, `ngay_di`, `tong_cong`, `do_la`, `loai_phong`, `so_phong`, `so_nguoi`, `tre_em`, `nguoi_lon`, `thanh_toan`, `noi_dung`, `dua_don`, `thoi_gian_den`, `chuyen_bay`, `thoi_gian_di`, `gia_dua_don`, `last_name`, `tenphong`, `room_id`, `time`) VALUES
(1, 'Ho Ten', '0987654321', '', 'Email@gmail.com', '', '', '', 0, 'Tieu de', '', '', 0, 0, '', 'Noi dung', 0, '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `yeu_cau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `tien` int(11) NOT NULL,
  `congty` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ma` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `thanh_toan` varchar(255) NOT NULL,
  `custom_id` int(11) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id`, `ten`, `diachi`, `tel`, `email`, `yeu_cau`, `noi_dung`, `time`, `status`, `tien`, `congty`, `ma`, `thanh_toan`, `custom_id`, `cod`, `activate`) VALUES
(2, 'BÃ¹i quang tÃ­n', 'ÄÃ  Náºµng', '0909090909', 'buiquang@gmail.com', 'okk', '<table width=\"100%\" cellpadding=\"3\" cellspacing=\"3\" class=\"table table-hover table-condensed\" ><tr><th>TÃªn sáº£n pháº©m</th><th>GiÃ¡</th><th>Sá»‘ lÆ°á»£ng</th><th>ThÃ nh tiá»n</th></tr><tr><td>Sáº£n pháº©m #4</td><td>120.000 <sup>Ä‘/sp</sup></td><td>1 </td><td>120.000 <sup>Ä‘</sup></td></tr><tr><td>Sáº£n pháº©m #3</td><td>400.000 <sup>Ä‘/sp</sup></td><td>1 </td><td>400.000 <sup>Ä‘</sup></td></tr><tr><td>Sáº£n pháº©m #2</td><td>200.000 <sup>Ä‘/sp</sup></td><td>5 </td><td>1.000.000 <sup>Ä‘</sup></td></tr><tr><td>Sáº£n pháº©m #1</td><td>350.000 <sup>Ä‘/sp</sup></td><td>1 </td><td>350.000 <sup>Ä‘</sup></td></tr><tr><td colspan=\"3\"><b>Tá»•ng cá»™ng </b><br /></td><td><b style=\"font-weight: bold; font-size: 15px; color: #ff0000;\">1.870.000 <sup>Ä‘</sup></b></td></tr></table>', 1505791819, 0, 1870000, 'Vina', '5Eh5BM89', 'Thanh toÃ¡n báº±ng hÃ¬nh thá»©c chuyá»ƒn khoáº£n', 0, '', 0),
(3, 'BÃ¹i minh tÃº', 'Quáº£ng Nam', '0987444333', 'buiquang@gmail.com', 'Ã¡dasd', '<table width=\"100%\" cellpadding=\"3\" cellspacing=\"3\" class=\"table table-hover table-condensed\" ><tr><th>TÃªn sáº£n pháº©m</th><th>GiÃ¡</th><th>Sá»‘ lÆ°á»£ng</th><th>ThÃ nh tiá»n</th></tr><tr><td>Sáº£n pháº©m #1</td><td>350.000 <sup>Ä‘/sp</sup></td><td>1 </td><td>350.000 <sup>Ä‘</sup></td></tr><tr><td colspan=\"3\"><b>Tá»•ng cá»™ng </b><br /></td><td><b style=\"font-weight: bold; font-size: 15px; color: #ff0000;\">350.000 <sup>Ä‘</sup></b></td></tr></table>', 1505792110, 0, 350000, '', NULL, 'Thanh toÃ¡n báº±ng tiá»n máº·t', 0, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangsx`
--

CREATE TABLE `hangsx` (
  `id` int(5) NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quocgia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kichhoat_kh`
--

CREATE TABLE `kichhoat_kh` (
  `id` int(11) NOT NULL,
  `cod` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `donhang_id` int(11) NOT NULL,
  `hien_thi` int(1) DEFAULT '0',
  `kh_id` int(11) NOT NULL,
  `time_kh` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kichhoat_kh`
--

INSERT INTO `kichhoat_kh` (`id`, `cod`, `activate`, `user_id`, `donhang_id`, `hien_thi`, `kh_id`, `time_kh`, `time`) VALUES
(1, 'se8687', 1, 1, 1, 1, 25, 1503908116, 0),
(2, '2469iK', 0, 1, 1, 1, 23, 1503977168, 0),
(3, 'Lm4232', 0, 0, 2, 0, 9, 0, 1505791819),
(4, '9vm532', 0, 0, 2, 0, 8, 0, 1505791819),
(5, 'c748I9', 0, 0, 2, 0, 7, 0, 1505791819),
(6, 's8F248', 0, 0, 2, 0, 6, 0, 1505791819);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `thu_tu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `language`
--

INSERT INTO `language` (`id`, `name`, `code`, `display`, `thu_tu`) VALUES
(1, 'Viá»‡t Nam', 'vn', 1, 1),
(10, 'English', 'en', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `view` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `ten`, `email`, `noi_dung`, `dia_chi`, `tieu_de`, `phone`, `company_name`, `post_id`, `time`, `view`) VALUES
(4, 'BÃ¹i quang tÃ­n', 'buiquang@gmail.com', 'text', '', '', '0909090909', '', 0, 1506417404, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_file`
--

CREATE TABLE `list_file` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `luot_tai` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `noi_bat` int(1) NOT NULL,
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `luot_xem` int(11) NOT NULL DEFAULT '0',
  `ngon_ngu` int(1) NOT NULL,
  `kieu` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `cat1` int(11) NOT NULL,
  `cat2` int(11) NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `luot_xem` int(11) NOT NULL,
  `noi_bat` int(1) NOT NULL DEFAULT '0',
  `post_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_edit` int(11) NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_edit` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `option1` int(1) NOT NULL DEFAULT '0',
  `option2` int(1) NOT NULL DEFAULT '0',
  `thu_tu` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dir_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `giang_vien` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `cat`, `cat1`, `cat2`, `hinh`, `hien_thi`, `time`, `user`, `luot_xem`, `noi_bat`, `post_type`, `time_edit`, `dir`, `user_edit`, `option1`, `option2`, `thu_tu`, `file`, `file_size`, `dir_file`, `giang_vien`) VALUES
(1, 1, 0, 0, 'no', 1, 1506311306, '5', 0, 0, 'about_us_detail', 1506311306, '', '5', 0, 0, 1, '', '', '', 0),
(2, 1, 0, 0, 'no', 1, 1506311323, '5', 0, 0, 'about_us_detail', 1506311323, '', '5', 0, 0, 2, '', '', '', 0),
(3, 1, 0, 0, 'no', 1, 1506311337, '5', 0, 0, 'about_us_detail', 1506311337, '', '5', 0, 0, 3, '', '', '', 0),
(4, 1, 0, 0, 'no', 1, 1506311358, '5', 0, 0, 'about_us_detail', 1506311358, '', '5', 0, 0, 4, '', '', '', 0),
(5, 4, 2, 0, '5-khoi-cong-du-an-muong-thanh-hotel.jpg', 1, 1506330667, '5', 26, 1, 'post_detail', 1506496058, '2017-09/post/', '5', 1, 0, 0, '', '', '', 0),
(6, 4, 2, 0, '6-tin-tuc-1.jpg', 1, 1506330678, '5', 1, 1, 'post_detail', 1506496050, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(7, 34, 0, 0, 'no', 1, 1506481196, '5', 0, 0, 'video_detail', 1506481196, '', '5', 0, 0, 0, '', '', '', 0),
(8, 34, 0, 0, 'no', 1, 1506481213, '5', 0, 0, 'video_detail', 1506481213, '', '5', 0, 0, 0, '', '', '', 0),
(9, 34, 0, 0, 'no', 1, 1506481230, '5', 0, 0, 'video_detail', 1506481230, '', '5', 0, 0, 0, '', '', '', 0),
(10, 34, 0, 0, 'no', 1, 1506481245, '5', 0, 0, 'video_detail', 1506481245, '', '5', 0, 0, 0, '', '', '', 0),
(11, 34, 0, 0, 'no', 1, 1506481259, '5', 0, 0, 'video_detail', 1506481259, '', '5', 0, 0, 0, '', '', '', 0),
(12, 34, 0, 0, 'no', 1, 1506481271, '5', 0, 0, 'video_detail', 1506481271, '', '5', 0, 0, 0, '', '', '', 0),
(13, 34, 0, 0, 'no', 1, 1506481287, '5', 0, 0, 'video_detail', 1506481287, '', '5', 0, 0, 0, '', '', '', 0),
(14, 13, 10, 0, '14-lap-du-an-1.jpg', 1, 1506655103, '5', 0, 0, 'catproduct_detail', 1506671270, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(15, 17, 15, 10, '15-chung-cu-1.jpg', 1, 1506655460, '5', 0, 0, 'catproduct_detail', 1506655460, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(16, 17, 15, 10, '16-chung-cu-2.jpg', 1, 1506655482, '5', 0, 0, 'catproduct_detail', 1506655482, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(17, 17, 15, 10, '17-chung-cu-3.jpg', 1, 1506655505, '5', 0, 0, 'catproduct_detail', 1506655505, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(18, 17, 15, 10, '18-chung-cu-4.jpg', 1, 1506655553, '5', 0, 0, 'catproduct_detail', 1506655553, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(19, 17, 15, 10, '19-chung-cu-5.jpg', 1, 1506655570, '5', 0, 0, 'catproduct_detail', 1506655570, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0),
(20, 17, 15, 10, '20-chung-cu-6.jpg', 1, 1506655587, '5', 0, 0, 'catproduct_detail', 1506655587, '2017-09/post/', '5', 0, 0, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `postcat`
--

CREATE TABLE `postcat` (
  `id` int(5) NOT NULL,
  `cat` int(5) NOT NULL,
  `hien_thi` int(2) NOT NULL,
  `noi_bat` int(1) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(1) NOT NULL,
  `dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `postcat`
--

INSERT INTO `postcat` (`id`, `cat`, `hien_thi`, `noi_bat`, `thu_tu`, `hinh`, `level`, `dir`, `post_type`) VALUES
(1, 0, 1, 0, 0, '', 1, '', 'about_us'),
(2, 0, 1, 0, 1, '', 1, '', 'post'),
(3, 0, 1, 0, 1, '', 1, '', 'post'),
(4, 2, 1, 0, 1, '', 2, '', 'post'),
(5, 2, 1, 0, 2, '', 2, '', 'post'),
(6, 2, 1, 0, 3, '', 2, '', 'post'),
(7, 3, 1, 0, 1, '', 2, '', 'post'),
(8, 3, 1, 0, 2, '', 2, '', 'post'),
(9, 3, 1, 0, 3, '', 2, '', 'post'),
(10, 0, 1, 0, 1, '10-tu-van-thiet-ke.jpg', 1, '2017-09/postcat/', 'catproduct'),
(11, 0, 1, 0, 2, '11-tu-van-quan-ly-du-an-va-giam-sat.jpg', 1, '2017-09/postcat/', 'catproduct'),
(12, 0, 1, 0, 3, '12-khao-sat-do-dac-thi-cong-xay-dung-nen-mong-.jpg', 1, '2017-09/postcat/', 'catproduct'),
(13, 10, 1, 0, 1, '13-lap-du-an.jpg', 2, '2017-09/postcat/', 'catproduct'),
(14, 10, 1, 0, 2, '14-thiet-ke-quy-hoach.jpg', 2, '2017-09/postcat/', 'catproduct'),
(15, 10, 1, 0, 3, '15-thiet-ke-kien-truc.jpg', 2, '2017-09/postcat/', 'catproduct'),
(16, 10, 1, 0, 4, '16-dich-vu-giay-phep.jpg', 2, '2017-09/postcat/', 'catproduct'),
(17, 15, 1, 0, 1, '17-chung-cu.jpg', 3, '2017-09/postcat/', 'catproduct'),
(18, 15, 1, 0, 2, '18-van-phong.jpg', 3, '2017-09/postcat/', 'catproduct'),
(19, 15, 1, 0, 3, '19-khach-san-resort.jpg', 3, '2017-09/postcat/', 'catproduct'),
(20, 15, 1, 0, 4, '20-giao-duc.jpg', 3, '2017-09/postcat/', 'catproduct'),
(21, 15, 1, 0, 5, '21-van-hoa-the-thao.jpg', 3, '2017-09/postcat/', 'catproduct'),
(22, 15, 1, 0, 6, '22-trung-tam-thuong-mai.jpg', 3, '2017-09/postcat/', 'catproduct'),
(23, 15, 1, 0, 7, '23-cong-trinh-nong-nghiep.jpg', 3, '2017-09/postcat/', 'catproduct'),
(24, 11, 1, 0, 1, '24-tham-tra-thiet-ke-va-du-toan.jpg', 2, '2017-09/postcat/', 'catproduct'),
(25, 11, 1, 0, 2, '25-danh-gia-tac-dong-moi-truong.jpg', 2, '2017-09/postcat/', 'catproduct'),
(26, 11, 1, 0, 3, '26-tu-van-dau-thau.jpg', 2, '2017-09/postcat/', 'catproduct'),
(27, 11, 1, 0, 4, '27-giam-sat-thi-cong.jpg', 2, '2017-09/postcat/', 'catproduct'),
(28, 11, 1, 0, 5, '28-quan-ly-du-an.jpg', 2, '2017-09/postcat/', 'catproduct'),
(29, 11, 1, 0, 6, '29-chung-nhan-phu-hop.jpg', 2, '2017-09/postcat/', 'catproduct'),
(30, 11, 1, 0, 7, '30-kiem-dinh-chat-luong.jpg', 2, '2017-09/postcat/', 'catproduct'),
(31, 12, 1, 0, 1, '31-do-dac-dia-hinh-va-lap-ban-do.jpg', 2, '2017-09/postcat/', 'catproduct'),
(32, 12, 1, 0, 2, '32-thi-cong-xay-dung-nen-mong.jpg', 2, '2017-09/postcat/', 'catproduct'),
(33, 12, 1, 0, 3, '33-khao-sat-dia-chat.jpg', 2, '2017-09/postcat/', 'catproduct'),
(34, 0, 1, 0, 0, '', 1, '', 'video');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `postcat_lang`
--

CREATE TABLE `postcat_lang` (
  `id` int(11) NOT NULL,
  `postcat_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_seo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `postcat_lang`
--

INSERT INTO `postcat_lang` (`id`, `postcat_id`, `lang_id`, `name`, `slug`, `note`, `title_seo`, `keywords`, `description`) VALUES
(1, 1, 'vn', 'Giá»›i thiá»‡u', 'gioi-thieu', '', '', '', ''),
(2, 2, 'vn', 'Tin tá»©c', 'tin-tuc', '', '', '', ''),
(3, 3, 'vn', 'GÃ³c tÆ° váº¥n', 'goc-tu-van', '', '', '', ''),
(4, 4, 'vn', 'Tin tá»©c Nagecco', 'tin-tuc-nagecco', '', '', '', ''),
(5, 5, 'vn', 'Quan há»‡ cá»• Ä‘Ã´ng', 'quan-he-co-dong', '', '', '', ''),
(6, 6, 'vn', 'Tin tá»©c tá»•ng há»£p', 'tin-tuc-tong-hop', '', '', '', ''),
(7, 7, 'vn', 'Thiáº¿t káº¿', 'thiet-ke', '', '', '', ''),
(8, 8, 'vn', 'Quáº£n lÃ½ dá»± Ã¡n vÃ  giÃ¡m sÃ¡t', 'quan-ly-du-an-va-giam-sat', '', '', '', ''),
(9, 9, 'vn', 'Kháº£o sÃ¡t - Ä‘o Ä‘áº¡c - thi cÃ´ng xÃ¢y dá»±ng ná»n mÃ³ng ', 'khao-sat-do-dac-thi-cong-xay-dung-nen-mong-', '', '', '', ''),
(34, 34, 'vn', 'ThÆ° viá»‡n video', 'thu-vien-video', '', '', '', ''),
(10, 10, 'vn', 'TÆ° váº¥n thiáº¿t káº¿', 'tu-van-thiet-ke', '', '', '', ''),
(11, 11, 'vn', 'TÆ° váº¥n quáº£n lÃ½ dá»± Ã¡n vÃ  giÃ¡m sÃ¡t', 'tu-van-quan-ly-du-an-va-giam-sat', '', '', '', ''),
(12, 12, 'vn', 'Kháº£o sÃ¡t - Ä‘o Ä‘áº¡c - thi cÃ´ng xÃ¢y dá»±ng ná»n mÃ³ng', 'khao-sat-do-dac-thi-cong-xay-dung-nen-mong', '', '', '', ''),
(13, 13, 'vn', 'Láº­p dá»± Ã¡n', 'lap-du-an', '', '', '', ''),
(14, 14, 'vn', 'Thiáº¿t káº¿ quy hoáº¡ch', 'thiet-ke-quy-hoach', '', '', '', ''),
(15, 15, 'vn', 'Thiáº¿t káº¿ kiáº¿n trÃºc', 'thiet-ke-kien-truc', '', '', '', ''),
(16, 16, 'vn', 'Dá»‹ch vá»¥ giáº¥y phÃ©p', 'dich-vu-giay-phep', '', '', '', ''),
(17, 17, 'vn', 'Chung cÆ°', 'chung-cu', '', '', '', ''),
(18, 18, 'vn', 'VÄƒn phÃ²ng', 'van-phong', '', '', '', ''),
(19, 19, 'vn', 'KhÃ¡ch sáº¡n - Resort', 'khach-san-resort', '', '', '', ''),
(20, 20, 'vn', 'GiÃ¡o dá»¥c', 'giao-duc', '', '', '', ''),
(21, 21, 'vn', 'VÄƒn hÃ³a - Thá»ƒ thao', 'van-hoa-the-thao', '', '', '', ''),
(22, 22, 'vn', 'Trung tÃ¢m thÆ°Æ¡ng máº¡i', 'trung-tam-thuong-mai', '', '', '', ''),
(23, 23, 'vn', 'CÃ´ng trÃ¬nh nÃ´ng nghiá»‡p', 'cong-trinh-nong-nghiep', '', '', '', ''),
(24, 24, 'vn', 'Tháº©m tra thiáº¿t káº¿ vÃ  dá»± toÃ¡n', 'tham-tra-thiet-ke-va-du-toan', '', '', '', ''),
(25, 25, 'vn', 'ÄÃ¡nh giÃ¡ tÃ¡c Ä‘á»™ng mÃ´i trÆ°á»ng', 'danh-gia-tac-dong-moi-truong', '', '', '', ''),
(26, 26, 'vn', 'TÆ° váº¥n Ä‘áº¥u tháº§u', 'tu-van-dau-thau', '', '', '', ''),
(27, 27, 'vn', 'GiÃ¡m sÃ¡t thi cÃ´ng', 'giam-sat-thi-cong', '', '', '', ''),
(28, 28, 'vn', 'Quáº£n lÃ½ dá»± Ã¡n', 'quan-ly-du-an', '', '', '', ''),
(29, 29, 'vn', 'Chá»©ng nháº­n phÃ¹ há»£p', 'chung-nhan-phu-hop', '', '', '', ''),
(30, 30, 'vn', 'Kiá»ƒm Ä‘á»‹nh cháº¥t lÆ°á»£ng', 'kiem-dinh-chat-luong', '', '', '', ''),
(31, 31, 'vn', 'Äo Ä‘áº¡c Ä‘á»‹a hÃ¬nh vÃ  láº­p báº£n Ä‘á»“', 'do-dac-dia-hinh-va-lap-ban-do', '', '', '', ''),
(32, 32, 'vn', 'Thi cÃ´ng xÃ¢y dá»±ng ná»n mÃ³ng', 'thi-cong-xay-dung-nen-mong', '', '', '', ''),
(33, 33, 'vn', 'Kháº£o sÃ¡t Ä‘á»‹a cháº¥t', 'khao-sat-dia-chat', '', '', '', ''),
(35, 2, 'en', 'News', 'news', '', '', '', ''),
(36, 3, 'en', 'Consultation', 'consultation', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_album`
--

CREATE TABLE `post_album` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `catalog` int(11) NOT NULL,
  `ten` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'no',
  `time` int(11) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(11) NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_album_menu`
--

CREATE TABLE `post_album_menu` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `sp_id` int(11) NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_file`
--

CREATE TABLE `post_file` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `catalog` int(11) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `noi_dung` text NOT NULL,
  `file` varchar(100) DEFAULT 'no',
  `file_size` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(11) NOT NULL,
  `dir` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_file_lang`
--

CREATE TABLE `post_file_lang` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `lang_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_file_menu`
--

CREATE TABLE `post_file_menu` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `sp_id` int(11) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `dir` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_file_menu_lang`
--

CREATE TABLE `post_file_menu_lang` (
  `id` int(11) NOT NULL,
  `file_menu_id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text COLLATE utf8_unicode_ci NOT NULL,
  `lang_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_lang`
--

CREATE TABLE `post_lang` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_kd` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich_kd` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung_kd` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_seo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `old_price` varchar(255) NOT NULL,
  `new_price` varchar(255) NOT NULL,
  `wholesale_price` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `post_lang`
--

INSERT INTO `post_lang` (`id`, `post_id`, `lang_id`, `ten`, `ten_kd`, `chu_thich`, `chu_thich_kd`, `noi_dung`, `noi_dung_kd`, `keywords`, `slug`, `title_seo`, `description`, `old_price`, `new_price`, `wholesale_price`) VALUES
(1, 1, 'vn', 'Giá»›i thiá»‡u chung', 'Gioi thieu chung', '', '', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '', 'gioi-thieu-chung.html', '', '', '', '', ''),
(2, 2, 'vn', 'TuyÃªn ngÃ´n cháº¥t lÆ°á»£ng', 'Tuyen ngon chat luong', '', '', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '', 'tuyen-ngon-chat-luong.html', '', '', '', '', ''),
(3, 3, 'vn', 'QuÃ¡ trÃ¬nh hÃ¬nh thÃ nh', 'Qua trinh hinh thanh', '', '', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '', 'qua-trinh-hinh-thanh.html', '', '', '', '', ''),
(4, 4, 'vn', 'SÆ¡ Ä‘á»“ tá»• chá»©c', 'So do to chuc', '', '', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, wisi lorem tempor eu rutrum massa, duis felis quis magna nullam nulla pharetra, pede ut pellentesque nulla varius quisque. Nulla a vel erat, dolor vestibulum at nec commodo et sit, ut lacinia id mauris hac. Faucibus morbi elit sed, nulla tincidunt nec lacus sit dolor quam, vivamus dolor pulvinar, montes amet et elementum pellentesque amet aliquet. Sed dolor, arcu ultrices lorem mollis nostra gravida. Sit varius, metus nullam sapiente, adipiscing a, pharetra eget laoreet justo malesuada. Tellus ultrices, ut nibh hymenaeos maecenas pharetra, aliquam dictum mollis per sit sit fermentum, duis excepteur mauris etiam. Praesent quam nunc sodales tempus, sed nullam enim eget, pellentesque eu turpis, malesuada quis tincidunt wisi, neque ante tincidunt nulla. Ac pulvinar sed amet wisi. Justo mauris, amet pretium dignissim mi sed metus aliquam. Ultrices quisque, non aenean vel iaculis, ligula a nullam ac. Porttitor risus nulla, in elementum purus at.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Tellus egestas ornare mi vel montes. Vestibulum aliquet arcu luctus in. Accumsan arcu lectus. Eum nonummy. Urna orci sit ut vitae tempor. Ipsum nullam potenti ipsum volutpat, mauris fermentum sed auctor, tellus at quisque a amet vestibulum donec, vel vivamus. Est ac urna aenean sed, nisl ac ac scelerisque sapien, lacus curabitur luctus nullam dignissim in vitae. Integer nulla libero lectus fames. Pede sed in dui pellentesque et justo, faucibus pretium ut ultrices a viverra molestie, nisl vehicula justo donec, aliquam officiis eget commodo eu. Consectetuer dictumst a nec ad metus nihil, nec eget pede, nascetur lorem tristique. Amet velit, eget cursus ad ut.</p>\r\n', '', 'so-do-to-chuc.html', '', '', '', '', ''),
(5, 5, 'vn', 'Khá»Ÿi cÃ´ng dá»± Ã¡n MÆ°á»ng Thanh Hotel', 'Khoi cong du an Muong Thanh Hotel', 'Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi.', 'Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi. Orci mi. Eu nulla ante enim, justo tempor, praesent ut bibendum erat etiam leo nisl, ut quis molestie, congue dui vehicula nunc. Id at phasellus pede vel faucibus a, integer cras ligula eget, mauris et eros luctus lectus, sed nullam, venenatis dignissim pulvinar a elementum. Purus cras, porta eu amet lacus massa dui, eu amet pulvinar eu tristique.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Magna sit eleifend, adipiscing accumsan consequat suspendisse ac ipsum enim, sodales ac commodo dignissim scelerisque neque, mi ut pede nisl in porttitor nec. Sed augue, est est quisque imperdiet consequatur vel fermentum, wisi sagittis donec, nascetur vestibulum, suspendisse a non placerat conubia ut. Et sed etiam mauris. Tellus justo rhoncus tortor justo ac porttitor, congue consectetuer vitae vulputate. A lacus diam tristique ut habitant, etiam porta, mi sit eu sagittis, ultrices non. Malesuada faucibus sed risus porta massa, eros laoreet quis non, cras ut tellus ex dolor quis semper, vel id auctor. Id porta minima, lacinia vel mi, sapien metus justo volutpat, id hac dui sodales suspendisse, consequat vel. Vitae blandit tellus ornare curabitur, nunc vitae, vitae in nec vel enim interdum gravida. Ut elit facilisis leo sem pharetra consequat. Dolor nascetur adipiscing dolor quam, ultrices orci donec vestibulum, etiam sed diam diam, tincidunt gravida velit nonummy. Nisl mattis pharetra mauris, maecenas quis, ullamcorper mattis mi, auctor metus, ullamcorper auctor id. Id est libero donec, ac pulvinar nulla elit lacinia ac, erat dui nibh a ut pellentesque vel, a dui odio pellentesque varius nec, mauris fermentum id sit at.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi. Orci mi. Eu nulla ante enim, justo tempor, praesent ut bibendum erat etiam leo nisl, ut quis molestie, congue dui vehicula nunc. Id at phasellus pede vel faucibus a, integer cras ligula eget, mauris et eros luctus lectus, sed nullam, venenatis dignissim pulvinar a elementum. Purus cras, porta eu amet lacus massa dui, eu amet pulvinar eu tristique.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Magna sit eleifend, adipiscing accumsan consequat suspendisse ac ipsum enim, sodales ac commodo dignissim scelerisque neque, mi ut pede nisl in porttitor nec. Sed augue, est est quisque imperdiet consequatur vel fermentum, wisi sagittis donec, nascetur vestibulum, suspendisse a non placerat conubia ut. Et sed etiam mauris. Tellus justo rhoncus tortor justo ac porttitor, congue consectetuer vitae vulputate. A lacus diam tristique ut habitant, etiam porta, mi sit eu sagittis, ultrices non. Malesuada faucibus sed risus porta massa, eros laoreet quis non, cras ut tellus ex dolor quis semper, vel id auctor. Id porta minima, lacinia vel mi, sapien metus justo volutpat, id hac dui sodales suspendisse, consequat vel. Vitae blandit tellus ornare curabitur, nunc vitae, vitae in nec vel enim interdum gravida. Ut elit facilisis leo sem pharetra consequat. Dolor nascetur adipiscing dolor quam, ultrices orci donec vestibulum, etiam sed diam diam, tincidunt gravida velit nonummy. Nisl mattis pharetra mauris, maecenas quis, ullamcorper mattis mi, auctor metus, ullamcorper auctor id. Id est libero donec, ac pulvinar nulla elit lacinia ac, erat dui nibh a ut pellentesque vel, a dui odio pellentesque varius nec, mauris fermentum id sit at.</p>\r\n', '', 'khoi-cong-du-an-muong-thanh-hotel.html', '', '', '', '', ''),
(6, 6, 'vn', 'Tin tá»©c #1', 'Tin tuc #1', 'Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate', 'Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi. Orci mi. Eu nulla ante enim, justo tempor, praesent ut bibendum erat etiam leo nisl, ut quis molestie, congue dui vehicula nunc. Id at phasellus pede vel faucibus a, integer cras ligula eget, mauris et eros luctus lectus, sed nullam, venenatis dignissim pulvinar a elementum. Purus cras, porta eu amet lacus massa dui, eu amet pulvinar eu tristique.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Magna sit eleifend, adipiscing accumsan consequat suspendisse ac ipsum enim, sodales ac commodo dignissim scelerisque neque, mi ut pede nisl in porttitor nec. Sed augue, est est quisque imperdiet consequatur vel fermentum, wisi sagittis donec, nascetur vestibulum, suspendisse a non placerat conubia ut. Et sed etiam mauris. Tellus justo rhoncus tortor justo ac porttitor, congue consectetuer vitae vulputate. A lacus diam tristique ut habitant, etiam porta, mi sit eu sagittis, ultrices non. Malesuada faucibus sed risus porta massa, eros laoreet quis non, cras ut tellus ex dolor quis semper, vel id auctor. Id porta minima, lacinia vel mi, sapien metus justo volutpat, id hac dui sodales suspendisse, consequat vel. Vitae blandit tellus ornare curabitur, nunc vitae, vitae in nec vel enim interdum gravida. Ut elit facilisis leo sem pharetra consequat. Dolor nascetur adipiscing dolor quam, ultrices orci donec vestibulum, etiam sed diam diam, tincidunt gravida velit nonummy. Nisl mattis pharetra mauris, maecenas quis, ullamcorper mattis mi, auctor metus, ullamcorper auctor id. Id est libero donec, ac pulvinar nulla elit lacinia ac, erat dui nibh a ut pellentesque vel, a dui odio pellentesque varius nec, mauris fermentum id sit at.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, lectus quis elit eget mattis ut nunc, faucibus ut. Nunc neque maecenas nec adipiscing, sit nunc consequat consequat duis vulputate, donec lorem quam mi. Orci mi. Eu nulla ante enim, justo tempor, praesent ut bibendum erat etiam leo nisl, ut quis molestie, congue dui vehicula nunc. Id at phasellus pede vel faucibus a, integer cras ligula eget, mauris et eros luctus lectus, sed nullam, venenatis dignissim pulvinar a elementum. Purus cras, porta eu amet lacus massa dui, eu amet pulvinar eu tristique.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Magna sit eleifend, adipiscing accumsan consequat suspendisse ac ipsum enim, sodales ac commodo dignissim scelerisque neque, mi ut pede nisl in porttitor nec. Sed augue, est est quisque imperdiet consequatur vel fermentum, wisi sagittis donec, nascetur vestibulum, suspendisse a non placerat conubia ut. Et sed etiam mauris. Tellus justo rhoncus tortor justo ac porttitor, congue consectetuer vitae vulputate. A lacus diam tristique ut habitant, etiam porta, mi sit eu sagittis, ultrices non. Malesuada faucibus sed risus porta massa, eros laoreet quis non, cras ut tellus ex dolor quis semper, vel id auctor. Id porta minima, lacinia vel mi, sapien metus justo volutpat, id hac dui sodales suspendisse, consequat vel. Vitae blandit tellus ornare curabitur, nunc vitae, vitae in nec vel enim interdum gravida. Ut elit facilisis leo sem pharetra consequat. Dolor nascetur adipiscing dolor quam, ultrices orci donec vestibulum, etiam sed diam diam, tincidunt gravida velit nonummy. Nisl mattis pharetra mauris, maecenas quis, ullamcorper mattis mi, auctor metus, ullamcorper auctor id. Id est libero donec, ac pulvinar nulla elit lacinia ac, erat dui nibh a ut pellentesque vel, a dui odio pellentesque varius nec, mauris fermentum id sit at.</p>\r\n', '', 'tin-tuc-1.html', '', '', '', '', ''),
(7, 7, 'vn', 'Video #1', 'Video #1', 'RoU2I0gx3AQ', 'RoU2I0gx3AQ', '', '', '', 'video-1.html', '', '', '', '', ''),
(8, 8, 'vn', 'Video #2', 'Video #2', '3cJFEnGahPM', '3cJFEnGahPM', '', '', '', 'video-2.html', '', '', '', '', ''),
(9, 9, 'vn', 'Video #3', 'Video #3', 'Z9WoL7v3Yz8', 'Z9WoL7v3Yz8', '', '', '', 'video-3.html', '', '', '', '', ''),
(10, 10, 'vn', 'Video #4', 'Video #4', 'Cc20DMHLLc4', 'Cc20DMHLLc4', '', '', '', 'video-4.html', '', '', '', '', ''),
(11, 11, 'vn', 'Video #5', 'Video #5', 'tkXr-V87Z1I', 'tkXr-V87Z1I', '', '', '', 'video-5.html', '', '', '', '', ''),
(12, 12, 'vn', 'Video #6', 'Video #6', 'AjCld7dSbKo', 'AjCld7dSbKo', '', '', '', 'video-6.html', '', '', '', '', ''),
(13, 13, 'vn', 'Video #7', 'Video #7', 'uvXsEoqg6V8', 'uvXsEoqg6V8', '', '', '', 'video-7.html', '', '', '', '', ''),
(14, 14, 'vn', 'Láº­p dá»± Ã¡n #1', 'Lap du an #1', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'lap-du-an-1.html', '', '', '', '', ''),
(15, 15, 'vn', 'Chung cÆ° #1', 'Chung cu #1', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-1.html', '', '', '', '', ''),
(16, 16, 'vn', 'Chung cÆ° #2', 'Chung cu #2', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-2.html', '', '', '', '', ''),
(17, 17, 'vn', 'Chung cÆ° #3', 'Chung cu #3', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-3.html', '', '', '', '', ''),
(18, 18, 'vn', 'Chung cÆ° #4', 'Chung cu #4', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-4.html', '', '', '', '', ''),
(19, 19, 'vn', 'Chung cÆ° #5', 'Chung cu #5', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', '<span style=\"font-family:arial,helvetica,sans-serif;\"></span><span style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif;\">Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</span>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<span style=\"font-family:arial,helvetica,sans-serif;\"></span><span style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif;\">Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</span>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-5.html', '', '', '', '', '');
INSERT INTO `post_lang` (`id`, `post_id`, `lang_id`, `ten`, `ten_kd`, `chu_thich`, `chu_thich_kd`, `noi_dung`, `noi_dung_kd`, `keywords`, `slug`, `title_seo`, `description`, `old_price`, `new_price`, `wholesale_price`) VALUES
(20, 20, 'vn', 'Chung cÆ° #6', 'Chung cu #6', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', 'Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis.', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Lorem ipsum dolor sit amet, vestibulum pharetra velit sed nisl. Nostra ligula facilisis a feugiat nulla vel, nec leo in sociis. Dis elit et scelerisque sodales eget integer, massa cursus interdum nec ridiculus, donec mauris lectus erat, donec pede hendrerit erat a nec. Vitae ligula adipiscing donec vel, conubia rutrum justo diam vestibulum, vel malesuada in donec, tortor phasellus irure et. Porta suscipit donec dis volutpat volutpat, semper aenean aliquet eleifend id, ut in. Integer dictum arcu suspendisse vehicula ipsum, mauris sociis varius convallis rutrum, donec vivamus et vel non, pellentesque non amet per vehicula vitae orci, facilisis vestibulum at cursus. Venenatis et et risus placerat.</p>\r\n<p align=\"justify\" style=\"color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; margin-bottom: 0px;\">\r\n	Nam a vestibulum eros integer mi imperdiet, mattis lectus vel enim nunc, pede a eget praesent et vel felis, purus libero lorem, tellus eget et aliquam vestibulum posuere. Luctus eros, in vestibulum massa nulla sed nam, ac litora nulla, cum etiam lorem condimentum nobis sagittis sed. Imperdiet enim parturient ultrices, fusce non aut donec. Vivamus luctus tortor luctus orci, vel ac, aptent natoque posuere sed luctus convallis. Sociosqu eu, eros at sodales suscipit magna pellentesque. Aliquam velit dapibus augue sodales natoque, justo vitae, mi erat vestibulum. Vitae maecenas suspendisse mollis, non placerat commodo diam maecenas, curabitur eros auctor elementum elit porttitor. Nam pede pulvinar per non etiam, leo eleifend adipiscing pulvinar adipiscing quam turpis. Placerat magna quisque molestie, ornare feugiat ipsum eleifend consequat mauris. Eget eget fringilla.</p>\r\n', '', 'chung-cu-6.html', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_meta`
--

CREATE TABLE `post_meta` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_meta_key`
--

CREATE TABLE `post_meta_key` (
  `id` int(11) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rows` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `post_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idmenu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slug`
--

CREATE TABLE `slug` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `post_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `slug`
--

INSERT INTO `slug` (`id`, `cat`, `post_type`, `slug`, `name`) VALUES
(1, 1, 'about_us', 'gioi-thieu', ''),
(2, 1, 'about_us_detail', 'gioi-thieu-chung.html', ''),
(3, 2, 'about_us_detail', 'tuyen-ngon-chat-luong.html', ''),
(4, 3, 'about_us_detail', 'qua-trinh-hinh-thanh.html', ''),
(5, 4, 'about_us_detail', 'so-do-to-chuc.html', ''),
(6, 2, 'post', 'tin-tuc', ''),
(7, 3, 'post', 'goc-tu-van', ''),
(8, 4, 'post', 'tin-tuc-nagecco', ''),
(9, 5, 'post', 'quan-he-co-dong', ''),
(10, 6, 'post', 'tin-tuc-tong-hop', ''),
(11, 7, 'post', 'thiet-ke', ''),
(12, 8, 'post', 'quan-ly-du-an-va-giam-sat', ''),
(13, 9, 'post', 'khao-sat-do-dac-thi-cong-xay-dung-nen-mong-', ''),
(40, 0, 'contact', 'lien-he.html', 'lienhe_vn'),
(14, 10, 'catproduct', 'tu-van-thiet-ke', ''),
(15, 11, 'catproduct', 'tu-van-quan-ly-du-an-va-giam-sat', ''),
(16, 12, 'catproduct', 'khao-sat-do-dac-thi-cong-xay-dung-nen-mong', ''),
(17, 13, 'catproduct', 'lap-du-an', ''),
(18, 14, 'catproduct', 'thiet-ke-quy-hoach', ''),
(19, 15, 'catproduct', 'thiet-ke-kien-truc', ''),
(20, 16, 'catproduct', 'dich-vu-giay-phep', ''),
(21, 17, 'catproduct', 'chung-cu', ''),
(22, 18, 'catproduct', 'van-phong', ''),
(23, 19, 'catproduct', 'khach-san-resort', ''),
(24, 20, 'catproduct', 'giao-duc', ''),
(25, 21, 'catproduct', 'van-hoa-the-thao', ''),
(26, 22, 'catproduct', 'trung-tam-thuong-mai', ''),
(27, 23, 'catproduct', 'cong-trinh-nong-nghiep', ''),
(28, 24, 'catproduct', 'tham-tra-thiet-ke-va-du-toan', ''),
(29, 25, 'catproduct', 'danh-gia-tac-dong-moi-truong', ''),
(30, 26, 'catproduct', 'tu-van-dau-thau', ''),
(31, 27, 'catproduct', 'giam-sat-thi-cong', ''),
(32, 28, 'catproduct', 'quan-ly-du-an', ''),
(33, 29, 'catproduct', 'chung-nhan-phu-hop', ''),
(34, 30, 'catproduct', 'kiem-dinh-chat-luong', ''),
(35, 31, 'catproduct', 'do-dac-dia-hinh-va-lap-ban-do', ''),
(36, 32, 'catproduct', 'thi-cong-xay-dung-nen-mong', ''),
(37, 33, 'catproduct', 'khao-sat-dia-chat', ''),
(38, 5, 'post_detail', 'khoi-cong-du-an-muong-thanh-hotel.html', ''),
(39, 6, 'post_detail', 'tin-tuc-1.html', ''),
(41, 0, 'contact', 'contact.html', 'lienhe_en'),
(42, 0, 'gallery', 'hinh-anh.html', 'hinhanh_vn'),
(43, 0, 'gallery', 'gallery.html', 'hinhanh_en'),
(44, 0, 'video', 'video.html', 'Video'),
(45, 34, 'video', 'thu-vien-video', ''),
(46, 7, 'video_detail', 'video-1.html', ''),
(47, 8, 'video_detail', 'video-2.html', ''),
(48, 9, 'video_detail', 'video-3.html', ''),
(49, 10, 'video_detail', 'video-4.html', ''),
(50, 11, 'video_detail', 'video-5.html', ''),
(51, 12, 'video_detail', 'video-6.html', ''),
(52, 13, 'video_detail', 'video-7.html', ''),
(53, 0, 'doi_tac', 'doi-tac.html', 'doitac_vn'),
(54, 0, 'doi_tac', 'partner.html', 'doitac_en'),
(55, 14, 'catproduct_detail', 'lap-du-an-1.html', ''),
(56, 15, 'catproduct_detail', 'chung-cu-1.html', ''),
(57, 16, 'catproduct_detail', 'chung-cu-2.html', ''),
(58, 17, 'catproduct_detail', 'chung-cu-3.html', ''),
(59, 18, 'catproduct_detail', 'chung-cu-4.html', ''),
(60, 19, 'catproduct_detail', 'chung-cu-5.html', ''),
(61, 20, 'catproduct_detail', 'chung-cu-6.html', ''),
(62, 2, 'post', 'news', ''),
(63, 3, 'post', 'consultation', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_bien`
--

CREATE TABLE `vn_bien` (
  `ten` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gia_tri` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_bien`
--

INSERT INTO `vn_bien` (`ten`, `gia_tri`) VALUES
('email', 'buiquangtinit@gmail.com'),
('lien_ket', ''),
('meta_author', ''),
('meta_copyright', 'Copyright Â© 2017 HOATIEN.com.vn, All Rights Reserved'),
('meta_description', ''),
('meta_keywords', ''),
('title', 'Nagecco'),
('link_g', 'plus.google.com'),
('link_yahoo', ''),
('link_skype', ''),
('link_fb', 'https://www.facebook.com/'),
('link_tt', 'twitter.com'),
('link_1', 'linkedin.com'),
('link_2', ''),
('link_3', ''),
('link_4', ''),
('usd', '22,450.00'),
('maps', '14.399406, 107.964942'),
('title_en', ''),
('hotline', '+ 84Â 909 999 999'),
('tel', '0909 999 999 - 0909 888 999'),
('fax', ''),
('address', '29 Bis  ÄÆ°á»ng Nguyá»…n ÄÃ¬nh Chiá»ƒu, P.Äakao ,Q.1 , Tp.Há»“ ChÃ­ Minh.'),
('address_en', '29 Bis  ÄÆ°á»ng Nguyá»…n ÄÃ¬nh Chiá»ƒu, P.Äakao ,Q.1 , Tp.Há»“ ChÃ­ Minh'),
('pass_transport', ''),
('companyname', ''),
('idyoutube', ''),
('email1', 'buiquangtinit@gmail.com1'),
('tel1', '0909 999 999 - 0909 888 999.'),
('address1', '303TrÆ°á»ng chinh - Quáº­n Thanh KhÃª - Tp. ÄÃ  Náºµng.'),
('link_fb1', 'https://www.facebook.com1/'),
('link_tt1', 'twitter.com1'),
('link_g1', 'plus.google.com1'),
('link_11', 'linkedin.com1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_cat`
--

CREATE TABLE `vn_cat` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hien_thi` int(1) NOT NULL,
  `noi_bat` int(1) NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thu_tu` int(11) NOT NULL DEFAULT '1',
  `_product` int(1) DEFAULT '0',
  `_cms` int(1) NOT NULL DEFAULT '0',
  `_gallery` int(1) NOT NULL DEFAULT '0',
  `_file` int(1) NOT NULL DEFAULT '0',
  `_list` int(1) NOT NULL DEFAULT '0',
  `_project` int(1) NOT NULL DEFAULT '0',
  `_anhsp` int(1) NOT NULL DEFAULT '0',
  `_filesp` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_cat`
--

INSERT INTO `vn_cat` (`id`, `ten`, `ten_en`, `hien_thi`, `noi_bat`, `hinh`, `thu_tu`, `_product`, `_cms`, `_gallery`, `_file`, `_list`, `_project`, `_anhsp`, `_filesp`) VALUES
(1, 'List', 'List', 0, 0, '', 1, 0, 0, 0, 0, 1, 0, 0, 0),
(2, 'Gallery', 'Gallery', 1, 1, '', 1, 0, 0, 1, 0, 0, 0, 0, 0),
(3, 'Album', 'Album', 1, 0, '', 1, 0, 0, 0, 0, 0, 0, 1, 0),
(5, 'File Manager', '', 1, 0, '', 1, 0, 0, 0, 1, 0, 0, 0, 0),
(7, 'ThÆ° viá»‡n', '', 1, 0, '', 1, 0, 0, 1, 0, 0, 0, 0, 0),
(9, 'Video', 'video', 0, 0, '', 1, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_danhgia`
--

CREATE TABLE `vn_danhgia` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `danhgia` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `kiem_duyet` int(1) NOT NULL DEFAULT '0',
  `noi_dung` text NOT NULL,
  `traloi` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `cat` int(11) NOT NULL,
  `luot_xem` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_danhgia`
--

INSERT INTO `vn_danhgia` (`id`, `ten`, `hoten`, `danhgia`, `time`, `hien_thi`, `kiem_duyet`, `noi_dung`, `traloi`, `email`, `cat`, `luot_xem`) VALUES
(1, 'BÃ¹i quang tÃ­n', '', 5, 1502870762, 0, 1, '<p>Hihi em th&iacute;ch b&agrave;i há»c n&agrave;y ráº¥t chi tiáº¿t v&agrave; Ä‘áº§y Ä‘á»§. Cháº¯c pháº£i há»c máº¥y ng&agrave;y má»›i háº¿t Ä‘Æ°á»£c. c&aacute;m Æ¡n áº¡.</p>\r\n', '<p>Cáº£m Æ¡n em</p>\r\n', 'buiquangtinit@gmail.com', 25, 0),
(2, 'Nguyá»…n thá»‹ tÆ°á»ng nga', '', 4, 1502871995, 0, 1, '<p>Ráº¥t Ä‘Æ¡n giáº£n, x&uacute;c t&iacute;ch, dá»… hiá»ƒu. Biáº¿t c&aacute;ch l&ecirc;n ná»™i dung, v&agrave; xá»­ l&yacute; pháº§n má»m há»— trá»£ má»™t c&aacute;ch hiá»‡u quáº£.</p>\r\n', '', 'tuongngaqt@gmail.com', 25, 0),
(9, 'BÃ¹i Quang TÃ­n', '', 3, 1504154291, 0, 1, '<p>ok ok</p>\r\n', '', 'buiquangtinit@gmail.com', 25, 0),
(8, 'BÃ¹i Quang TÃ­n', '', 4, 1504153657, 0, 1, '<p>Ráº¥t ok</p>\r\n', '', 'buiquangtinit@gmail.com', 25, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_doc`
--

CREATE TABLE `vn_doc` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `chu_thich` text NOT NULL,
  `file` varchar(255) DEFAULT 'no',
  `file_size` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `gia` double DEFAULT NULL,
  `time` int(11) NOT NULL,
  `luot_tai` int(11) NOT NULL DEFAULT '0',
  `noi_bat` int(1) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_doc_menu`
--

CREATE TABLE `vn_doc_menu` (
  `id` int(11) NOT NULL,
  `cat` varchar(20) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_file`
--

CREATE TABLE `vn_file` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'no',
  `file_size` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `noi_bat` int(1) NOT NULL,
  `loai` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `luot_xem` int(11) NOT NULL DEFAULT '0',
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_file_lang`
--

CREATE TABLE `vn_file_lang` (
  `id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lien_ket` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_file_menu`
--

CREATE TABLE `vn_file_menu` (
  `id` int(11) NOT NULL,
  `cat` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `post_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_file_menu_lang`
--

CREATE TABLE `vn_file_menu_lang` (
  `id` int(11) NOT NULL,
  `file_menu_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_gallery`
--

CREATE TABLE `vn_gallery` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'no',
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `noi_bat` int(1) NOT NULL,
  `loai` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `luot_xem` int(11) NOT NULL DEFAULT '0',
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thu_tu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_gallery`
--

INSERT INTO `vn_gallery` (`id`, `cat`, `hinh`, `hien_thi`, `noi_bat`, `loai`, `time`, `user`, `luot_xem`, `dir`, `thu_tu`) VALUES
(1, 1, '1-trai-nghiem-hoc-tap-khong-gioi-han.jpg', 1, 0, 0, 1501635576, 5, 0, 'media_gal/', 4),
(2, 1, '2-trai-nghiem-hoc-tap-khong-gioi-han.jpg', 1, 0, 0, 1501635588, 5, 0, 'media_gal/', 0),
(3, 1, '3-trai-nghiem-hoc-tap-khong-gioi-han1.jpg', 1, 0, 0, 1501635592, 5, 0, 'media_gal/', 2),
(4, 2, '4-wxua7e.jpg', 1, 0, 0, 1502093008, 5, 0, 'media_gal/', 0),
(5, 2, '5-xhrca7.jpg', 1, 0, 0, 1502093008, 5, 0, 'media_gal/', 0),
(6, 2, '6-icqu1g.jpg', 1, 0, 0, 1502093008, 5, 0, 'media_gal/', 0),
(7, 3, '7-clzapj.jpg', 1, 0, 0, 1502093019, 5, 0, 'media_gal/', 0),
(8, 3, '8-8uxo5e.jpg', 1, 0, 0, 1502093019, 5, 0, 'media_gal/', 0),
(9, 4, '9-8a3oky.jpg', 1, 0, 0, 1502093029, 5, 0, 'media_gal/', 0),
(10, 4, '10-z220sp.jpg', 1, 0, 0, 1502093029, 5, 0, 'media_gal/', 0),
(11, 4, '11-4kqgr9.jpg', 1, 0, 0, 1502093029, 5, 0, 'media_gal/', 0),
(12, 5, '12-yva9ci.jpg', 1, 0, 0, 1502093039, 5, 0, 'media_gal/', 0),
(14, 5, '14-dbwgwo.jpg', 1, 0, 0, 1502093039, 5, 0, 'media_gal/', 0),
(15, 5, '15-q1wk5x.jpg', 1, 0, 0, 1502093039, 5, 0, 'media_gal/', 0),
(17, 6, '17-0img-gt.jpg', 1, 0, 0, 1505448234, 5, 0, 'media_gal/', 0),
(18, 6, '18-1img-gt1.jpg', 1, 0, 0, 1505448234, 5, 0, 'media_gal/', 0),
(19, 6, '19-2img-gt2.jpg', 1, 0, 0, 1505448234, 5, 0, 'media_gal/', 0),
(20, 6, '20-3img-gt3.jpg', 1, 0, 0, 1505448234, 5, 0, 'media_gal/', 0),
(21, 7, '21-ati0oy.jpg', 1, 0, 0, 1505465201, 5, 0, 'media_gal/', 0),
(22, 7, '22-bwgp29.jpg', 1, 0, 0, 1505465201, 5, 0, 'media_gal/', 0),
(23, 7, '23-0js86g.jpg', 1, 0, 0, 1505465201, 5, 0, 'media_gal/', 0),
(24, 7, '24-jbx5g9.jpg', 1, 0, 0, 1505465205, 5, 0, 'media_gal/', 0),
(25, 7, '25-ugocq5.jpg', 1, 0, 0, 1505465205, 5, 0, 'media_gal/', 0),
(26, 7, '26-dejtcu.jpg', 1, 0, 0, 1505465205, 5, 0, 'media_gal/', 0),
(27, 7, '27-jqeeya.jpg', 1, 0, 0, 1505465212, 5, 0, 'media_gal/', 0),
(28, 8, '28-02.jpg', 1, 0, 0, 1505698496, 5, 0, 'media_gal/', 0),
(29, 8, '29-02.jpg', 1, 0, 0, 1505699771, 5, 0, 'media_gal/', 0),
(30, 8, '30-02.jpg', 1, 0, 0, 1505700671, 5, 0, 'media_gal/', 0),
(31, 8, '31-02.jpg', 1, 0, 0, 1505701421, 5, 0, 'media_gal/', 0),
(33, 8, '33-02.jpg', 1, 0, 0, 1505719073, 5, 0, 'media_gal/', 0),
(34, 8, '34-02.jpg', 1, 0, 0, 1505743431, 5, 0, 'media_gal/', 0),
(35, 8, '35-02.jpg', 1, 0, 0, 1505788930, 5, 0, 'media_gal/', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_gallery_lang`
--

CREATE TABLE `vn_gallery_lang` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lien_ket` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_gallery_lang`
--

INSERT INTO `vn_gallery_lang` (`id`, `gallery_id`, `lang_id`, `ten`, `chu_thich`, `lien_ket`, `noi_dung`) VALUES
(1, 1, 'vn', 'Tráº£i nghiá»‡m há»c táº­p khÃ´ng giá»›i háº¡n', '', '', ''),
(2, 1, 'en', 'Z408JM', '', '', ''),
(3, 2, 'vn', 'Tráº£i nghiá»‡m há»c táº­p khÃ´ng giá»›i háº¡n', '', '', ''),
(4, 2, 'en', 'DZGOU6', '', '', ''),
(5, 3, 'vn', 'Tráº£i nghiá»‡m há»c táº­p khÃ´ng giá»›i háº¡n1', '', '', ''),
(6, 3, 'en', 'K7T6Y5', '', '', ''),
(7, 4, 'vn', 'WXUA7E', '', '', ''),
(8, 4, 'en', 'WXUA7E', '', '', ''),
(9, 5, 'vn', 'XHRCA7', '', '', ''),
(10, 5, 'en', 'XHRCA7', '', '', ''),
(11, 6, 'vn', 'ICQU1G', '', '', ''),
(12, 6, 'en', 'ICQU1G', '', '', ''),
(13, 7, 'vn', 'CLZAPJ', '', '', ''),
(14, 7, 'en', 'CLZAPJ', '', '', ''),
(15, 8, 'vn', '8UXO5E', '', '', ''),
(16, 8, 'en', '8UXO5E', '', '', ''),
(17, 9, 'vn', '8A3OKY', '', '', ''),
(18, 9, 'en', '8A3OKY', '', '', ''),
(19, 10, 'vn', 'Z220SP', '', '', ''),
(20, 10, 'en', 'Z220SP', '', '', ''),
(21, 11, 'vn', '4KQGR9', '', '', ''),
(22, 11, 'en', '4KQGR9', '', '', ''),
(23, 12, 'vn', 'YVA9CI', '', '', ''),
(24, 12, 'en', 'YVA9CI', '', '', ''),
(27, 14, 'vn', 'DBWGWO', '', '', ''),
(28, 14, 'en', 'DBWGWO', '', '', ''),
(29, 15, 'vn', 'Q1WK5X', '', '', ''),
(30, 15, 'en', 'Q1WK5X', '', '', ''),
(33, 17, 'vn', 'HZVVJ3', '', '', ''),
(34, 18, 'vn', 'X3V2RM', '', '', ''),
(35, 19, 'vn', '0OUZ43', '', '', ''),
(36, 20, 'vn', 'Z1R2IC', '', '', ''),
(37, 21, 'vn', 'ATI0OY', '', '', ''),
(38, 22, 'vn', 'BWGP29', '', '', ''),
(39, 23, 'vn', '0JS86G', '', '', ''),
(40, 24, 'vn', 'JBX5G9', '', '', ''),
(41, 25, 'vn', 'UGOCQ5', '', '', ''),
(42, 26, 'vn', 'DEJTCU', '', '', ''),
(43, 27, 'vn', 'JQEEYA', '', '', ''),
(44, 28, 'vn', 'Banner trang liÃªn há»‡', '', '', ''),
(45, 29, 'vn', 'Banner trang tin tá»©c & tuyá»ƒn dá»¥ng', '', '', ''),
(46, 30, 'vn', 'Banner trang giá»›i thiá»‡u', '', '', ''),
(47, 31, 'vn', 'Banner tÆ° váº¥n - thiáº¿t káº¿ & nguyÃªn cá»©u', '', '', ''),
(49, 33, 'vn', 'Banner trang sáº£n pháº©m', '', '', ''),
(50, 34, 'vn', 'Banner trang chi tiáº¿t sáº£n pháº©m', '', '', ''),
(51, 35, 'vn', 'Banner trang giá» hÃ ng', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_gallery_menu`
--

CREATE TABLE `vn_gallery_menu` (
  `id` int(11) NOT NULL,
  `cat` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thu_tu` int(11) NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `post_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_gallery_menu`
--

INSERT INTO `vn_gallery_menu` (`id`, `cat`, `thu_tu`, `hien_thi`, `hinh`, `post_type`) VALUES
(1, '2', 1, 1, 'no', 'catgal'),
(2, '7', 1, 1, 'no', ''),
(3, '7', 2, 1, 'no', ''),
(4, '7', 3, 1, 'no', ''),
(5, '7', 4, 1, 'no', ''),
(6, '2', 2, 1, 'no', 'catgal'),
(7, '2', 3, 1, 'no', 'catgal'),
(8, '2', 4, 1, 'no', 'catgal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_gallery_menu_lang`
--

CREATE TABLE `vn_gallery_menu_lang` (
  `id` int(11) NOT NULL,
  `gallery_menu_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_gallery_menu_lang`
--

INSERT INTO `vn_gallery_menu_lang` (`id`, `gallery_menu_id`, `lang_id`, `ten`, `chu_thich`, `slug`) VALUES
(1, 1, 'vn', 'Slide Trang Chá»§', '', 'slide-trang-chu'),
(2, 2, 'vn', 'ThÆ° viá»‡n #1', '', 'thu-vien-#1'),
(3, 2, 'en', 'Gallery #1', '', 'gallery-#1'),
(4, 3, 'vn', 'ThÆ° viá»‡n #2', '', 'thu-vien-#2'),
(5, 3, 'en', 'Gallery #2', '', 'gallery-#2'),
(6, 4, 'vn', 'ThÆ° viá»‡n #3', '', 'thu-vien-#3'),
(7, 4, 'en', 'Gallery #3', '', 'gallery-#3'),
(8, 5, 'vn', 'ThÆ° viá»‡n #4', '', 'thu-vien-#4'),
(9, 5, 'en', 'Gallery #4', '', 'gallery-#4'),
(10, 6, 'vn', 'HÃ¬nh anh cho Ä‘oáº¡n giá»›i thiá»‡u trang chá»§', '', 'hinh-anh-cho-doan-gioi-thieu-trang-chu'),
(11, 7, 'vn', 'Slide Ä‘á»‘i tÃ¡c', '', 'slide-doi-tac'),
(12, 8, 'vn', 'Banner Trang Con', '', 'banner-trang-con');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_gianhang`
--

CREATE TABLE `vn_gianhang` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dien_thoai` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kiem_duyet` int(1) NOT NULL DEFAULT '0',
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_mail`
--

CREATE TABLE `vn_mail` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_mail`
--

INSERT INTO `vn_mail` (`id`, `ten`, `time`) VALUES
(1, 'buiquangtinit@gmail.com', 1501740772),
(2, 'buiquangtinit@gmail.com', 1501741679),
(3, 'buiquangtinit@gmail.com', 1501741708),
(4, 'buiquangtinit@gmail.com', 1501741750),
(5, 'buiquangtinit@gmail.com', 1501742275),
(6, 'buiquangtinit@gmail.com', 1501742442),
(7, 'buiquangtinit@gmail.com', 1501742451),
(8, 'buiquangtinit@gmail.com', 1501742464),
(9, 'buiquangtinit@gmail.com', 1501742581),
(10, 'buiquangtinit@gmail.com', 1501742604),
(11, 'buiquangtinit@gmail.com', 1501742629),
(12, 'buiquangtinit@gmail.com', 1501742630),
(13, 'buiquangtinit@gmail.com', 1501742638),
(14, 'buiquangtinit@gmail.com', 1501742695),
(15, 'buiquangtinit@gmail.com', 1501742726),
(16, 'buiquangtinit@gmail.com', 1501742776),
(17, 'buiquangtinit@gmail.com', 1501742786),
(18, 'buiquangtinit@gmail.com', 1501742803),
(19, 'buiquangtinit@gmail.com', 1501742832),
(20, 'buiquangtinit@gmail.com', 1501742849),
(21, 'buiquangtinit@gmail.com', 1501742898);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_online`
--

CREATE TABLE `vn_online` (
  `ip` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(255) NOT NULL DEFAULT '',
  `site` varchar(255) NOT NULL DEFAULT '',
  `agent` varchar(255) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_online`
--

INSERT INTO `vn_online` (`ip`, `time`, `site`, `agent`, `user`) VALUES
('127.0.0.1', '1506676410', '', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/66.4.104 Chrome/60.4.3112.104 Safari/537.36', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_online_daily`
--

CREATE TABLE `vn_online_daily` (
  `ngay` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `bo_dem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vn_online_daily`
--

INSERT INTO `vn_online_daily` (`ngay`, `bo_dem`) VALUES
('28/08/2017', 43),
('29/08/2017', 16),
('30/08/2017', 9),
('31/08/2017', 17),
('05/09/2017', 8),
('06/09/2017', 22),
('07/09/2017', 16),
('08/09/2017', 11),
('09/09/2017', 3),
('11/09/2017', 5),
('12/09/2017', 8),
('14/09/2017', 10),
('15/09/2017', 22),
('17/09/2017', 14),
('18/09/2017', 34),
('19/09/2017', 15),
('20/09/2017', 2),
('21/09/2017', 6),
('22/09/2017', 10),
('24/09/2017', 5),
('25/09/2017', 16),
('26/09/2017', 25),
('27/09/2017', 20),
('28/09/2017', 12),
('29/09/2017', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_page`
--

CREATE TABLE `vn_page` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `luot_xem` int(11) DEFAULT '1',
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `option1` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_page`
--

INSERT INTO `vn_page` (`id`, `alias`, `time`, `user`, `luot_xem`, `hinh`, `dir`, `option1`) VALUES
(1, 'gioi_thieu', 1502095522, 5, 28, '', '', 0),
(2, 'huong_dan', 1502095925, 5, 6, '', '', 0),
(3, 'tien_mat', 1505791709, 5, 131, '', '', 0),
(4, 'chuyen_khoan', 1505791679, 5, 131, '', '', 0),
(5, 'coc', 1505791697, 5, 64, '', '', 0),
(6, 'gioi_thieu_home', 1505448458, 5, 465, '', '', 0),
(7, 'tt_hotro', 1505466383, 5, 342, '', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_page_lang`
--

CREATE TABLE `vn_page_lang` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `lang_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chu_thich` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_seo` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_page_lang`
--

INSERT INTO `vn_page_lang` (`id`, `page_id`, `lang_id`, `ten`, `chu_thich`, `url`, `noi_dung`, `title_seo`, `keywords`, `description`) VALUES
(1, 1, 'vn', 'Giá»›i thiá»‡u', '', '', '<p align=\"justify\">1Lorem ipsum dolor sit amet, tristique arcu amet pellentesque, hac arcu nec aliquam ligula platea, sodales eget eu etiam nibh, duis ultricies duis. Eu nunc, et felis accumsan amet orci massa, consectetuer turpis vestibulum eget viverra, eros magnis pede cum, nullam parturient at nec morbi. Mi duis felis ultrices, dui tempus elementum, a at pellentesque vitae. Quam eu habitant arcu habitant justo ante, donec fermentum aliquam sodales sed, donec egestas. Suscipit consequat integer est sodales, posuere dui pede, labore magnis volutpat nec, justo a vitae elementum imperdiet integer fringilla, ultrices metus elementum wisi morbi rutrum. Viverra morbi quam justo, dictum ullamcorper eu eros nullam sit, leo ligula eros morbi viverra, eu dui lorem quis wisi dignissim, scelerisque id. Duis nibh quis adipiscing interdum dolor.</p>\r\n\r\n<p align=\"justify\">Pharetra cras nascetur sit non elit metus. Tellus aliquam, vestibulum habitant tortor risus mollis enim. Vulputate odio at elit mauris. Ultrices congue nec, praesent pede vel tempus a nibh duis. Eu nam cras molestie duis in eget, nullam id, fringilla nibh nulla commodo sem, accumsan in amet et rhoncus faucibus nibh.</p>\r\n\r\n<p align=\"justify\">Libero augue, lorem in non vulputate. Quisque magna non at etiam libero luctus, nam sem odio purus mauris odio erat, natoque mi ante amet, dapibus quis vivamus, elit a. Cras tincidunt ut, nam in pede tincidunt at lorem, quis mi vitae mauris, lacus ac. Mauris tincidunt magna, consectetuer lacus. Nunc luctus proin hendrerit euismod, fames semper veniam ac.</p>\r\n\r\n<p align=\"justify\">Tellus dolor sit. Ut ante, tempor lorem viverra. Volutpat sed suscipit libero non varius, duis lacinia risus consectetuer amet libero nullam, id faucibus, pede dui. Turpis tortor, amet et bibendum. In consequat dolor risus, est erat.</p>\r\n', '', '', ''),
(2, 1, 'en', 'About us', '', '', '<p align=\"justify\">Lorem ipsum dolor sit amet, tristique arcu amet pellentesque, hac arcu nec aliquam ligula platea, sodales eget eu etiam nibh, duis ultricies duis. Eu nunc, et felis accumsan amet orci massa, consectetuer turpis vestibulum eget viverra, eros magnis pede cum, nullam parturient at nec morbi. Mi duis felis ultrices, dui tempus elementum, a at pellentesque vitae. Quam eu habitant arcu habitant justo ante, donec fermentum aliquam sodales sed, donec egestas. Suscipit consequat integer est sodales, posuere dui pede, labore magnis volutpat nec, justo a vitae elementum imperdiet integer fringilla, ultrices metus elementum wisi morbi rutrum. Viverra morbi quam justo, dictum ullamcorper eu eros nullam sit, leo ligula eros morbi viverra, eu dui lorem quis wisi dignissim, scelerisque id. Duis nibh quis adipiscing interdum dolor.</p>\r\n\r\n<p align=\"justify\">Pharetra cras nascetur sit non elit metus. Tellus aliquam, vestibulum habitant tortor risus mollis enim. Vulputate odio at elit mauris. Ultrices congue nec, praesent pede vel tempus a nibh duis. Eu nam cras molestie duis in eget, nullam id, fringilla nibh nulla commodo sem, accumsan in amet et rhoncus faucibus nibh.</p>\r\n\r\n<p align=\"justify\">Libero augue, lorem in non vulputate. Quisque magna non at etiam libero luctus, nam sem odio purus mauris odio erat, natoque mi ante amet, dapibus quis vivamus, elit a. Cras tincidunt ut, nam in pede tincidunt at lorem, quis mi vitae mauris, lacus ac. Mauris tincidunt magna, consectetuer lacus. Nunc luctus proin hendrerit euismod, fames semper veniam ac.</p>\r\n\r\n<p align=\"justify\">Tellus dolor sit. Ut ante, tempor lorem viverra. Volutpat sed suscipit libero non varius, duis lacinia risus consectetuer amet libero nullam, id faucibus, pede dui. Turpis tortor, amet et bibendum. In consequat dolor risus, est erat.</p>\r\n', '', '', ''),
(3, 2, 'vn', 'HÆ°á»›ng dáº«n thanh toÃ¡n', '', '', '<p align=\"justify\">1Lorem ipsum dolor sit amet, tristique arcu amet pellentesque, hac arcu nec aliquam ligula platea, sodales eget eu etiam nibh, duis ultricies duis. Eu nunc, et felis accumsan amet orci massa, consectetuer turpis vestibulum eget viverra, eros magnis pede cum, nullam parturient at nec morbi. Mi duis felis ultrices, dui tempus elementum, a at pellentesque vitae. Quam eu habitant arcu habitant justo ante, donec fermentum aliquam sodales sed, donec egestas. Suscipit consequat integer est sodales, posuere dui pede, labore magnis volutpat nec, justo a vitae elementum imperdiet integer fringilla, ultrices metus elementum wisi morbi rutrum. Viverra morbi quam justo, dictum ullamcorper eu eros nullam sit, leo ligula eros morbi viverra, eu dui lorem quis wisi dignissim, scelerisque id. Duis nibh quis adipiscing interdum dolor.</p>\r\n\r\n<p align=\"justify\">Pharetra cras nascetur sit non elit metus. Tellus aliquam, vestibulum habitant tortor risus mollis enim. Vulputate odio at elit mauris. Ultrices congue nec, praesent pede vel tempus a nibh duis. Eu nam cras molestie duis in eget, nullam id, fringilla nibh nulla commodo sem, accumsan in amet et rhoncus faucibus nibh.</p>\r\n\r\n<p align=\"justify\">Libero augue, lorem in non vulputate. Quisque magna non at etiam libero luctus, nam sem odio purus mauris odio erat, natoque mi ante amet, dapibus quis vivamus, elit a. Cras tincidunt ut, nam in pede tincidunt at lorem, quis mi vitae mauris, lacus ac. Mauris tincidunt magna, consectetuer lacus. Nunc luctus proin hendrerit euismod, fames semper veniam ac.</p>\r\n\r\n<p align=\"justify\">Tellus dolor sit. Ut ante, tempor lorem viverra. Volutpat sed suscipit libero non varius, duis lacinia risus consectetuer amet libero nullam, id faucibus, pede dui. Turpis tortor, amet et bibendum. In consequat dolor risus, est erat.</p>\r\n', '', '', ''),
(4, 2, 'en', 'Payment guide', '', '', '<p align=\"justify\">1Lorem ipsum dolor sit amet, tristique arcu amet pellentesque, hac arcu nec aliquam ligula platea, sodales eget eu etiam nibh, duis ultricies duis. Eu nunc, et felis accumsan amet orci massa, consectetuer turpis vestibulum eget viverra, eros magnis pede cum, nullam parturient at nec morbi. Mi duis felis ultrices, dui tempus elementum, a at pellentesque vitae. Quam eu habitant arcu habitant justo ante, donec fermentum aliquam sodales sed, donec egestas. Suscipit consequat integer est sodales, posuere dui pede, labore magnis volutpat nec, justo a vitae elementum imperdiet integer fringilla, ultrices metus elementum wisi morbi rutrum. Viverra morbi quam justo, dictum ullamcorper eu eros nullam sit, leo ligula eros morbi viverra, eu dui lorem quis wisi dignissim, scelerisque id. Duis nibh quis adipiscing interdum dolor.</p>\r\n\r\n<p align=\"justify\">Pharetra cras nascetur sit non elit metus. Tellus aliquam, vestibulum habitant tortor risus mollis enim. Vulputate odio at elit mauris. Ultrices congue nec, praesent pede vel tempus a nibh duis. Eu nam cras molestie duis in eget, nullam id, fringilla nibh nulla commodo sem, accumsan in amet et rhoncus faucibus nibh.</p>\r\n\r\n<p align=\"justify\">Libero augue, lorem in non vulputate. Quisque magna non at etiam libero luctus, nam sem odio purus mauris odio erat, natoque mi ante amet, dapibus quis vivamus, elit a. Cras tincidunt ut, nam in pede tincidunt at lorem, quis mi vitae mauris, lacus ac. Mauris tincidunt magna, consectetuer lacus. Nunc luctus proin hendrerit euismod, fames semper veniam ac.</p>\r\n\r\n<p align=\"justify\">Tellus dolor sit. Ut ante, tempor lorem viverra. Volutpat sed suscipit libero non varius, duis lacinia risus consectetuer amet libero nullam, id faucibus, pede dui. Turpis tortor, amet et bibendum. In consequat dolor risus, est erat.</p>\r\n', '', '', ''),
(5, 3, 'vn', 'Tiá»n máº·t', '', '', '<p>\r\n	Update</p>\r\n', '', '', ''),
(6, 4, 'vn', 'Chuyá»ƒn khoáº£n', '', '', '<p>\r\n	update</p>\r\n', '', '', ''),
(7, 5, 'vn', 'Giao hÃ ng thu tiá»n', '', '', '<p>\r\n	update</p>\r\n', '', '', ''),
(8, 0, 'vn', 'Äoáº¡n giá»›i thiá»‡u trang chá»§', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '', '', '', '', ''),
(9, 6, 'vn', 'Äoáº¡n giá»›i thiá»‡u trang chá»§', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '', '', '', '', ''),
(10, 7, 'vn', 'ThÃ´ng tin há»• trá»£ trang chá»§', '', '', '<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<img alt=\"\" src=\"/uploads/images/images/dv1.png\" style=\"width: 69px; height: 69px; float: left;\" /><strong>MIá»„N PH&Iacute; Váº¬N CHUYá»‚N</strong><br />\r\n				Cho Ä‘Æ¡n h&agrave;ng tr&ecirc;n 5.000.000</td>\r\n			<td>\r\n				<img alt=\"\" src=\"/uploads/images/images/dv2.png\" style=\"width: 69px; height: 69px; float: left;\" /><strong>CH&Iacute;NH S&Aacute;CH Äá»”I TRáº¢</strong><br />\r\n				Miá»…n ph&iacute; Ä‘á»•i tráº£ vá»›i h&agrave;ng lá»—i</td>\r\n			<td>\r\n				<img alt=\"\" src=\"/uploads/images/images/dv3.png\" style=\"width: 69px; height: 69px; float: left;\" /><strong>Há»– TRá»¢ TÆ¯ Váº¤N 24/7</strong><br />\r\n				TÆ° váº¥n mua h&agrave;ng 24/7</td>\r\n			<td>\r\n				<img alt=\"\" src=\"/uploads/images/images/dv4.png\" style=\"width: 69px; height: 69px; float: left;\" /><strong>Æ¯U Ä&Atilde;I KH&Aacute;CH H&Agrave;NG</strong><br />\r\n				Chiáº¿t kháº¥u cao cho Ä‘áº¡i l&yacute;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />\r\n', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_support`
--

CREATE TABLE `vn_support` (
  `id` int(11) NOT NULL,
  `tieude` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `yahoo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `skype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hien_thi` int(1) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `luot_xem` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_thanh_vien`
--

CREATE TABLE `vn_thanh_vien` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dien_thoai` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `trang_thai` int(1) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL,
  `yahoo` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `ngay` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_thanh_vien`
--

INSERT INTO `vn_thanh_vien` (`id`, `ten`, `email`, `password`, `dien_thoai`, `dia_chi`, `trang_thai`, `time`, `yahoo`, `facebook`, `skype`, `ngay`) VALUES
(1, 'BÃ¹i Quang TÃ­n', 'buiquangtinit@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '0972696904', 'ÄÃ  náºµng', 1, 1502961918, '', '', '', '17/08/2017');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_trang_thai`
--

CREATE TABLE `vn_trang_thai` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trang_thai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vn_trang_thai`
--

INSERT INTO `vn_trang_thai` (`id`, `video_id`, `user_id`, `trang_thai`) VALUES
(1, 13, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vn_user`
--

CREATE TABLE `vn_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'no',
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dien_thoai` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dia_chi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `level` int(1) DEFAULT '0',
  `trang_thai` int(1) NOT NULL DEFAULT '0',
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `vn_user`
--

INSERT INTO `vn_user` (`id`, `username`, `password`, `ten`, `email`, `dien_thoai`, `dia_chi`, `level`, `trang_thai`, `images`, `time`, `dir`) VALUES
(5, 'coder', '0ea4a0db010efd4ed3ca4ebee723b65c', 'BÃ¹i quang tÃ­n', 'buiquangtinit@gmail.com', '0972696904', 'ÄÃ  Náºµng', 0, 1, '5-coder.jpg', 1466390221, 'member/'),
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmai.com', '09999999999', 'ÄÃ  Náºµng', 1, 1, '4-admin.jpg', 1465871477, 'member/');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hangsx`
--
ALTER TABLE `hangsx`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `kichhoat_kh`
--
ALTER TABLE `kichhoat_kh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_file`
--
ALTER TABLE `list_file`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `postcat`
--
ALTER TABLE `postcat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `postcat_lang`
--
ALTER TABLE `postcat_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_album`
--
ALTER TABLE `post_album`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_album_menu`
--
ALTER TABLE `post_album_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_file`
--
ALTER TABLE `post_file`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_file_lang`
--
ALTER TABLE `post_file_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_file_menu`
--
ALTER TABLE `post_file_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_file_menu_lang`
--
ALTER TABLE `post_file_menu_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_lang`
--
ALTER TABLE `post_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_meta`
--
ALTER TABLE `post_meta`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post_meta_key`
--
ALTER TABLE `post_meta_key`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slug`
--
ALTER TABLE `slug`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_bien`
--
ALTER TABLE `vn_bien`
  ADD PRIMARY KEY (`ten`);

--
-- Chỉ mục cho bảng `vn_cat`
--
ALTER TABLE `vn_cat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_danhgia`
--
ALTER TABLE `vn_danhgia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_doc`
--
ALTER TABLE `vn_doc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_doc_menu`
--
ALTER TABLE `vn_doc_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_file`
--
ALTER TABLE `vn_file`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_file_lang`
--
ALTER TABLE `vn_file_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_file_menu`
--
ALTER TABLE `vn_file_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_file_menu_lang`
--
ALTER TABLE `vn_file_menu_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_gallery`
--
ALTER TABLE `vn_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_gallery_lang`
--
ALTER TABLE `vn_gallery_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_gallery_menu`
--
ALTER TABLE `vn_gallery_menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_gallery_menu_lang`
--
ALTER TABLE `vn_gallery_menu_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_gianhang`
--
ALTER TABLE `vn_gianhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_mail`
--
ALTER TABLE `vn_mail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_page`
--
ALTER TABLE `vn_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Chỉ mục cho bảng `vn_page_lang`
--
ALTER TABLE `vn_page_lang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_support`
--
ALTER TABLE `vn_support`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tieude` (`tieude`);

--
-- Chỉ mục cho bảng `vn_thanh_vien`
--
ALTER TABLE `vn_thanh_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_trang_thai`
--
ALTER TABLE `vn_trang_thai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vn_user`
--
ALTER TABLE `vn_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `hangsx`
--
ALTER TABLE `hangsx`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `kichhoat_kh`
--
ALTER TABLE `kichhoat_kh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `list_file`
--
ALTER TABLE `list_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT cho bảng `postcat`
--
ALTER TABLE `postcat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT cho bảng `postcat_lang`
--
ALTER TABLE `postcat_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT cho bảng `post_album`
--
ALTER TABLE `post_album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_album_menu`
--
ALTER TABLE `post_album_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_file`
--
ALTER TABLE `post_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_file_lang`
--
ALTER TABLE `post_file_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_file_menu`
--
ALTER TABLE `post_file_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_file_menu_lang`
--
ALTER TABLE `post_file_menu_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_lang`
--
ALTER TABLE `post_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT cho bảng `post_meta`
--
ALTER TABLE `post_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `post_meta_key`
--
ALTER TABLE `post_meta_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `slug`
--
ALTER TABLE `slug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT cho bảng `vn_cat`
--
ALTER TABLE `vn_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `vn_danhgia`
--
ALTER TABLE `vn_danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `vn_doc`
--
ALTER TABLE `vn_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_doc_menu`
--
ALTER TABLE `vn_doc_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_file`
--
ALTER TABLE `vn_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_file_lang`
--
ALTER TABLE `vn_file_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_file_menu`
--
ALTER TABLE `vn_file_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_file_menu_lang`
--
ALTER TABLE `vn_file_menu_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_gallery`
--
ALTER TABLE `vn_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT cho bảng `vn_gallery_lang`
--
ALTER TABLE `vn_gallery_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT cho bảng `vn_gallery_menu`
--
ALTER TABLE `vn_gallery_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `vn_gallery_menu_lang`
--
ALTER TABLE `vn_gallery_menu_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `vn_gianhang`
--
ALTER TABLE `vn_gianhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_mail`
--
ALTER TABLE `vn_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT cho bảng `vn_page`
--
ALTER TABLE `vn_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `vn_page_lang`
--
ALTER TABLE `vn_page_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `vn_support`
--
ALTER TABLE `vn_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `vn_thanh_vien`
--
ALTER TABLE `vn_thanh_vien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `vn_trang_thai`
--
ALTER TABLE `vn_trang_thai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `vn_user`
--
ALTER TABLE `vn_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
