-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 14, 2024 at 05:26 PM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
                                          (1, 'bread'),
                                          (3, 'vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `id` int(11) NOT NULL,
                          `user_id` int(11) DEFAULT NULL,
                          `total` decimal(10,2) DEFAULT NULL,
                          `payment_method` varchar(255) DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT current_timestamp(),
                          `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `payment_method`, `created_at`, `updated_at`) VALUES
                                                                                                  (1, 1, 169.94, 'PayPal', '2024-04-14 16:39:13', '2024-04-14 16:39:13'),
                                                                                                  (2, 1, 169.94, 'PayPal', '2024-04-14 16:39:44', '2024-04-14 16:39:44'),
                                                                                                  (3, 1, 169.94, 'PayPal', '2024-04-14 16:40:12', '2024-04-14 16:40:12'),
                                                                                                  (4, 1, 169.94, 'PayPal', '2024-04-14 16:43:43', '2024-04-14 16:43:43'),
                                                                                                  (5, 1, 169.94, 'PayPal', '2024-04-14 16:44:19', '2024-04-14 16:44:19'),
                                                                                                  (6, 1, 169.94, 'PayPal', '2024-04-14 16:44:44', '2024-04-14 16:44:44'),
                                                                                                  (7, 1, 169.94, 'PayPal', '2024-04-14 16:45:04', '2024-04-14 16:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
                                  `order_id` int(11) DEFAULT NULL,
                                  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
                           `id` int(11) NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `price` decimal(10,2) NOT NULL,
                           `description` varchar(8000) NOT NULL,
                           `image` varchar(255) NOT NULL,
                           `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
    (1, 'Ciabatta', 2.50, 'Ciabatta (which translates to slipper!) is an Italian bread made with wheat flour, salt, yeast, and water. Though it\'s texture and crust vary slightly throughout Italy, the essential ingredients remain the same. Ciabatta is best for sandwiches and paninis, naturally.', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/957759184-1529703875.jpg?crop=1.00xw:0.645xh;0,0.104xh&resize=980:*', 1),
(2, 'Whole Wheat Bread', 2.00, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/whole-wheat-bread-horizontal-1-jpg-1590195849.jpg?crop=0.735xw:0.735xh;0.187xw,0.128xh&resize=980:*', 1),
(3, 'Artichoke', 1.50, 'Artichokes contain an unusual organic acid called cynarin which affects taste and may be the reason why water appears to taste sweet after eating artichokes. The flavour of wine is similarly altered and many wine experts believe that wine shouldn’t accompany artichokes.', 'https://www.vegetables.co.nz/assets/vegetables/_resampled/FillWyI0MDAiLCIzMDAiXQ/artichokes-globe.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text DEFAULT NULL,
  `productPrice` float NOT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productDescription`, `productPrice`, `productImage`, `productQuantity`) VALUES
(1, 'Widget ', 'A high-quality widget', 19.99, 'images/image.jpeg', 100),
(2, 'Gadget', 'An innovative gadget', 29.99, 'images/R.jpeg', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `firstName`, `lastName`, `email`, `password`, `phone`, `address`, `address2`, `country`, `zip`, `dateOfBirth`, `role`) VALUES
(1, 'username', 'user', 'user', 'user@user.user', 'username', '1234567890', '123 Main St', 'Apt 456', 'The Netherlands', '12345', '1990-01-01', 'user'),
(3, 'Test', 'Test', 'Test', 'Test', '$2y$10$3FirB3nPKDb5.jReMHHVIuMLGYXW8BjTa1JPw68fFIy5jr0CmGNxG', '123123', 'Test', '', 'Test', 'Test', '1111-11-11', 'user'),
(4, 'customer', 'customer', 'customer', 'customer@customer.customer', '$2y$10$TFzm5RcC4tdCY0IavmTss.c9GKfpsoKQ90VnQo5TSq7TOTwaGURTq', '123123', 'customer', '123', 'The Netherlands', '2122AS', '1111-11-11', 'user'),
(5, 'admin', 'admin', 'admin', 'Admin@Admin.Admin', '$2y$10$KH8rxAGVxljIzBKS5Gk6TOw3TajBCojr.vZwi2KVwh9CXbvuVFtOS', '123123', 'admin', 'admin', 'The Netherlands', '3123SA', '1111-11-11', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`productID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
