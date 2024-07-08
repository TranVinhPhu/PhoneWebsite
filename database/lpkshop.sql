-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 01, 2024 lúc 02:45 PM
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
-- Cơ sở dữ liệu: `lpkshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_register` datetime DEFAULT NULL,
  `bill_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `billdes`
--

CREATE TABLE `billdes` (
  `billdes_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pay`
--

CREATE TABLE `pay` (
  `pay_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `pay_date` datetime NOT NULL,
  `total` double NOT NULL,
  `paystatus` varchar(100) NOT NULL DEFAULT 'Not Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_register` datetime DEFAULT NULL,
  `item_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_image`, `item_register`, `item_description`) VALUES
(1, 'Samsung', 'Samsung Galaxy S24 Ultra', 15200000, './assets/products/1.png', '2024-05-28 11:08:57', 'Tận hưởng những công nghệ hàng đầu nhà Samsung, Galaxy S24 Ultra sẽ cho bạn trải nghiệm đỉnh cao từ thiết kế thời thượng, hiệu năng mạnh mẽ Snapdragon 8 Gen 1 và hệ thống camera đêm chuyên nghiệp nhất từ trước đến nay.'),
(2, 'Redmi', 'Redmi Note 7', 12200000, './assets/products/2.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 7 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2019. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(3, 'Redmi', 'Redmi Note 6', 12200000, './assets/products/3.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 6 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2018. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(4, 'Redmi', 'Redmi Note 5', 12200000, './assets/products/4.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 5 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2017. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(5, 'Redmi', 'Redmi Note 4', 12200000, './assets/products/5.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 4 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2016. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(6, 'Redmi', 'Redmi Note 8', 12200000, './assets/products/6.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 8 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2020. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(7, 'Redmi', 'Redmi Note 9', 12200000, './assets/products/7.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note 9 là một trong những chiếc điện thoại được mong chờ nhất trong năm 2021. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(8, 'Redmi', 'Redmi Note', 12200000, './assets/products/8.png', '2024-05-28 11:08:57', 'Xiaomi Redmi Note là một trong những chiếc điện thoại được mong chờ nhất trong năm 2015. Với thiết kế vuông vức, cấu hình mạnh mẽ và mức giá phải chăng, chiếc điện thoại này đã nhanh chóng thu hút được sự quan tâm của người dùng.'),
(9, 'Samsung', 'Samsung Galaxy Z Flip 4', 15200000, './assets/products/9.png', '2024-05-28 11:08:57', 'Linh hoạt biến hóa, không ngừng sáng tạo, Samsung Galaxy Z Flip4 mang đến những xu hướng công nghệ hiện đại, đậm chất thời trang cho người dùng sành điệu. Nay điện thoại còn thêm phần cuốn hút với phiên bản giới hạn Samsung Galaxy Z Flip4 Flex Mode Collection, một sự kết hợp của Samsung và GIA STUDIOS cho phiên bản màu Pink Gold hoặc Blue.'),
(10, 'Samsung', 'Samsung Galaxy Z Flip 5', 15200000, './assets/products/11.png', '2024-05-28 11:08:57', 'Nhỏ gọn và tinh tế, Galaxy Z Flip5 là chiếc smartphone sinh ra dành cho các tín đồ thời trang. Cơ chế gập duyên dáng, bộ màu sắc nhẹ nhàng và loạt chức năng quay chụp sẽ làm say lòng những người yêu cái đẹp.'),
(11, 'Apple', 'Apple iPhone 5', 15200000, './assets/products/13.png', '2024-05-28 11:08:57', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 5, trong đó phiên bản iPhone 5 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.'),
(12, 'Apple', 'Apple iPhone 6', 15200000, './assets/products/14.png', '2024-05-28 11:08:57', 'Trong những tháng cuối năm 2015, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 6 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 6 64GB.'),
(13, 'Apple', 'Apple iPhone 7', 12200000, './assets/products/15.png', '2024-05-28 11:08:57', 'Cuối cùng thì chiếc iPhone 7 Pro Max cũng đã chính thức lộ diện tại sự kiện ra mắt thường niên vào ngày 08/09 đến từ nhà Apple, kết thúc bao lời đồn đoán bằng một bộ thông số cực kỳ ấn tượng cùng vẻ ngoài đẹp mắt sang trọng. Từ ngày 14/10/2018 người dùng đã có thể mua sắm các sản phẩm iPhone 7 series với đầy đủ phiên bản tại Thế Giới Di Động.'),
(14, 'Apple', 'Apple iPhone 8', 15200000, './assets/products/16.png', '2024-05-28 11:08:57', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 8, trong đó phiên bản iPhone 5 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone 7 ra mắt trước đó.'),
(15, 'Apple', 'Apple iPhone 9', 15200000, './assets/products/17.png', '2024-05-28 11:08:57', 'Trong những tháng cuối năm 2015, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 9 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 9 64GB.'),
(16, 'Apple', 'Apple iPhone 10', 15200000, './assets/products/18.png', '2024-05-28 11:08:57', 'Cuối cùng thì chiếc iPhone 10 Pro Max cũng đã chính thức lộ diện tại sự kiện ra mắt thường niên vào ngày 08/09 đến từ nhà Apple, kết thúc bao lời đồn đoán bằng một bộ thông số cực kỳ ấn tượng cùng vẻ ngoài đẹp mắt sang trọng. Từ ngày 14/10/2022 người dùng đã có thể mua sắm các sản phẩm iPhone 10 series với đầy đủ phiên bản tại Thế Giới Di Động.'),
(17, 'Apple', 'Apple iPhone 11', 12200000, './assets/products/19.png', '2024-05-28 11:08:57', 'Apple đã chính thức trình làng bộ 3 siêu phẩm iPhone 11, trong đó phiên bản iPhone 11 64GB có mức giá rẻ nhất nhưng vẫn được nâng cấp mạnh mẽ như iPhone Xr ra mắt trước đó.'),
(18, 'Apple', 'Apple iPhone 12', 15200000, './assets/products/20.png', '2024-05-28 11:08:57', 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 12 64GB.'),
(19, 'Samsung', 'Samsung Galaxy A30', 15200000, './assets/products/10.jpg', '2024-05-28 11:08:57', 'Cùng tận hưởng những tác vụ giải trí, kết nối và làm việc theo cách ấn tượng nhất trên không gian hình ảnh V-Cut TFT 6.6 inch mà Samsung Galaxy A23 sở hữu. Sản phẩm đem lại nhiều trải nghiệm đơn giản nhưng hiệu quả, ghi nhận năng lực chụp ảnh xuất sắc qua hệ thống bốn camera được tích hợp chống rung quang học OIS.'),
(20, 'Samsung', 'Samsung Galaxy A50', 15200000, './assets/products/12.jpg', '2024-05-28 11:08:57', 'Trải nghiệm hệ thống camera 108MP đầu tiên trên thế hệ Galaxy A, hiệu năng cực mạnh Snapdragon 778G, màn hình 120Hz mượt mà và kết nối 5G siêu tốc, Samsung Galaxy A73 5G đã sẵn sàng đưa bạn vào thế giới công nghệ đỉnh cao, giúp cuộc sống tiện lợi hơn bao giờ.');
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `profileImage`, `register_date`) VALUES
(1, 'Lieu', 'Hoang Long', 'lieuhoanglong@gmail.com', '1234567', '', '2020-05-28 13:07:17'),
(8, 'Long123123', 'Long123123', 'lieulong12312313@gmail.com', '$2y$10$.BlLfMH3nKqSJi5ye5Xpru7GuYU/662p7I4j263dmMZJByxDDlMhe', './assets/profile/Clouds-Meet-The-Sea-AI-Generated-4K-Wallpaper.jpg', '2024-05-18 16:22:18'),
(15, 'Nghia', 'Long', 'lieulongnghia@gmail.com', '$2y$10$BNq7mrGEWkQJNN3jA8s2Kegbh/RiVQUaqJX7/D2k292W1szBYpcXe', './assets/profile/372c5b92-2ecd-4274-bd89-395244d75c09.jpg', '2024-05-18 16:31:44'),
(16, 'Long', 'Long', 'lieulong123213@gmail.com', '$2y$10$dNBSTdj5rbu9HIjfFyJ6DOCE/6uc8Oihz0TJ6UTzpTk41Tx.FT7ZC', './assets/profile/beard.png', '2024-05-25 21:02:15'),
(30, 'Long', 'Long', 'lieulong@gmail.com', '$2y$10$fps827aXLSFLM2YI9bB7o./UX0P/FEJa0HJo.tNi6iQldHowlGYL6', './assets/profile/beard.png', '2024-05-30 20:01:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `billdes`
--
ALTER TABLE `billdes`
  ADD PRIMARY KEY (`billdes_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD KEY `fk_user_cart` (`user_id`),
  ADD KEY `fk_product_cart` (`item_id`);

--
-- Chỉ mục cho bảng `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `fk_bill_pay` (`bill_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD KEY `fk_user_wishlist` (`user_id`),
  ADD KEY `fk_product_wishlist` (`item_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `billdes`
--
ALTER TABLE `billdes`
  MODIFY `billdes_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pay`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_user_bill` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `billdes`
--
ALTER TABLE `billdes`
  ADD CONSTRAINT `fk_bill_billdes` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_billdes` FOREIGN KEY (`item_id`) REFERENCES `product` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_cart` FOREIGN KEY (`item_id`) REFERENCES `product` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `fk_bill_pay` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_product_wishlist` FOREIGN KEY (`item_id`) REFERENCES `product` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_wishlist` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
