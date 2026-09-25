-- Tạo cơ sở dữ liệu DaiLyGiaHuy
CREATE DATABASE IF NOT EXISTS `DaiLyGiaHuy` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `DaiLyGiaHuy`;

-- --------------------------------------------------------
-- Bảng: Gas
-- --------------------------------------------------------
CREATE TABLE `Gas` (
  `GasID` INT NOT NULL AUTO_INCREMENT,
  `TenGas` NVARCHAR(100),
  `ThuongHieu` NVARCHAR(100),
  `MauSac` NVARCHAR(50),
  `TrongLuongVoBinh` FLOAT,
  `GiaThanh` NVARCHAR(50),
  `ThongTin` TEXT,
  `HinhAnh` varchar(255),
  PRIMARY KEY (`GasID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Bảng: Gao
-- --------------------------------------------------------
CREATE TABLE `Gao` (
  `GaoID` INT NOT NULL AUTO_INCREMENT,
  `TenGao` NVARCHAR(100),
  `ThuongHieu` NVARCHAR(100),
  `LoaiGao` NVARCHAR(100),
  `TrongLuong` FLOAT,
  `GiaThanh` NVARCHAR(50),
  `ThongTin` TEXT,
  `HinhAnh` varchar(255),
  PRIMARY KEY (`GaoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Bảng: NuocUong
-- --------------------------------------------------------
CREATE TABLE `NuocUong` (
  `NuocUongID` INT NOT NULL AUTO_INCREMENT,
  `TenNuocUong` NVARCHAR(100),
  `ThuongHieu` NVARCHAR(100),
  `ThanhPhan` NVARCHAR(50),
  `DungTich` FLOAT,
  `QuyCach` NVARCHAR(100),
  `ChungLoai` NVARCHAR(100),
  `GiaThanh` INT,
  `ThongTin` TEXT,
  `HinhAnh` varchar(255),
  PRIMARY KEY (`NuocUongID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Đang đổ dữ liệu cho bảng `Gas`
-- --------------------------------------------------------
INSERT INTO `Gas` (`TenGas`, `ThuongHieu`, `MauSac`, `TrongLuongVoBinh`, `GiaThanh`, `ThongTin`, `HinhAnh`) 
VALUES 
('Gas Dầu Khí Màu Hồng 45kg', 'Dầu Khí', 'Hồng', 45, 'Liên hệ', 'Bình gas màu hồng dung tích lớn, thích hợp cho nhà hàng, quán ăn.', 'gas_DK_mau_hong_45kg.png'),
('Gas Dầu Khí Màu Xám 45kg', 'Dầu Khí', 'Xám', 45, 'Liên hệ', 'Bình gas công nghiệp, an toàn và tiết kiệm nhiên liệu.', 'gas_DK_mau_xam_45kg.png'),
('Gas Dầu Khí Màu Xám 12kg', 'Dầu Khí', 'Xám', 12, 'Liên hệ', 'Bình gas 12kg phù hợp cho hộ gia đình sử dụng hằng ngày.', 'gas_DK_mau_xam_12kg.png'),
('Gas PetroVietNam Màu Đỏ 12kg', 'PetroVietNam', 'Đỏ', 12, 'Liên hệ', 'Gas chính hãng, chất lượng cao từ PetroVietNam.', 'gas_PetroVN_mau_do_12kg.png'),
('Gas PetroVietNam Màu Hồng 12kg', 'PetroVietNam', 'Hồng', 12, 'Liên hệ', 'Bình gas màu hồng bắt mắt, độ an toàn cao.', 'gas_PetroVN_mau_hong_12kg.png'),
('Gas PetroVietNam Màu Xám 12kg', 'PetroVietNam', 'Xám', 12, 'Liên hệ', 'Sản phẩm đáng tin cậy cho nhu cầu sinh hoạt hằng ngày.', 'gas_PetroVN_mau_xam_12kg.png'),
('Gas ELF Màu Đỏ 12kg', 'ELF', 'Đỏ', 12, 'Liên hệ', 'Gas chất lượng cao, đảm bảo áp suất ổn định khi sử dụng.', 'gas_ELF_mau_do_12kg.png'),
('Gas Petrolimex Màu Xanh Dương Nhạt 12kg', 'Petrolimex', 'Xanh Dương Nhạt', 12, 'Liên hệ', 'Sản phẩm phân phối bởi Petrolimex, an toàn tuyệt đối.', 'gas_Petrolimex_mau_xanh_duong_nhat_12kg.png'),
('Gas Petrolimex Màu Xanh Dương 12kg', 'Petrolimex', 'Xanh Dương', 12, 'Liên hệ', 'Bình gas 12kg màu xanh dương, thân thiện môi trường.', 'gas_Petrolimex_mau_xanh_duong_12kg.png'),
('Gas Saigon Petro Màu Xám 12kg', 'Saigon Petro', 'Xám', 12, 'Liên hệ', 'Gas chính hãng Saigon Petro, hiệu suất đun nấu cao.', 'gas_SP_mau_xam_12kg.png'),
('Gas VT Màu Xám 12kg', 'VT', 'Xám', 12, 'Liên hệ', 'Giải pháp tiết kiệm năng lượng cho mọi gia đình.', 'gas_VT_mau_xam_12kg.png'),
('Gas VT Màu Xanh Dương 12kg', 'VT', 'Xanh Dương', 12, 'Liên hệ', 'Thiết kế bền bỉ, gas đốt sạch, không ám mùi.', 'gas_VT_mau_xanh_duong_12kg.png');

-- --------------------------------------------------------
-- Đang đổ dữ liệu cho bảng `Gao`
-- --------------------------------------------------------
INSERT INTO `Gao` (`TenGao`, `ThuongHieu`, `LoaiGao`, `TrongLuong`, `GiaThanh`, `ThongTin`, `HinhAnh`) 
VALUES 
('Gạo Thơm Jasmin (5kg)', 'Phước Thành IV', 'Gạo thơm', 5, 'Liên hệ', 'Gạo hạt dài, thơm nhẹ, cơm mềm và dẻo khi nấu.', 'gao_thom_jasmin.png'),
('Gạo Thơm Thái (5kg)', 'Lộc Phượng', 'Gạo thơm', 5, 'Liên hệ', 'Gạo chất lượng nhập khẩu, vị ngọt nhẹ, dẻo mềm.', 'gao_LP.png'),
('Gạo Thơm Dứa (5kg)', 'Thơm Dứa', 'Gạo thơm', 5, 'Liên hệ', 'Mùi thơm tự nhiên như lá dứa, thích hợp dùng mỗi ngày.', 'gao_TD.png'),
('Gạo Tài Nguyên (5kg)', 'Phước Thành IV', 'Gạo Tài Nguyên', 5, 'Liên hệ', 'Loại gạo truyền thống, cơm tơi xốp, không dính tay.', 'gao_TN.png');

-- --------------------------------------------------------
-- Đang đổ dữ liệu cho bảng `NuocUong`
-- --------------------------------------------------------
INSERT INTO `NuocUong` (`TenNuocUong`, `ThuongHieu`, `ThanhPhan`, `DungTich`, `QuyCach`, `ChungLoai`, `GiaThanh`, `ThongTin`, `HinhAnh`) 
VALUES 
('Nước khoáng Vikoda chai 500ml (thùng 24 chai)', 'Vikoda', 'Nước khoáng thiên nhiên', 500, 'Thùng 24 chai', 'Chai', 74000, 'Thích hợp dùng trong gia đình, văn phòng, tiện mang theo.', 'chai_vikoda.png'),
('Nước khoáng Vikoda bình 20l (có vòi)', 'Vikoda', 'Nước khoáng thiên nhiên', 20, 'Bình có vòi', 'Bình', 52000, 'Phù hợp sử dụng tại nhà, vòi tiện dụng, dễ rót nước.', 'binh_vikoda_co_voi.png'),
('Nước khoáng Vikoda bình 20l (không vòi)', 'Vikoda', 'Nước khoáng thiên nhiên', 20, 'Bình không vòi', 'Bình', 52000, 'Bình lớn dùng cho máy nóng lạnh, tiết kiệm chi phí.', 'binh_vikoda_khong_voi.png'),
('Nước uống Trường Hảo bình 20l (có vòi)', 'Trường Hảo', 'Nước lọc', 20, 'Bình có vòi', 'Bình', 15000, 'Giải pháp kinh tế cho hộ gia đình, nước tinh khiết an toàn.', 'binh_TH_co_voi.png'),
('Nước khoáng Onsen bình 20l (có vòi)', 'Onsen', 'Nước khoáng thiên nhiên', 20, 'Bình có vòi', 'Bình', 38000, 'Nguồn khoáng chất tự nhiên, hỗ trợ tiêu hóa.', 'binh_onsen_co_voi.png'),
('Nước khoáng Onsen bình 20l (không vòi)', 'Onsen', 'Nước khoáng thiên nhiên', 20, 'Bình không vòi', 'Bình', 38000, 'Thích hợp cho máy nóng lạnh, hương vị thanh mát.', 'binh_onsen_khong_voi.png');