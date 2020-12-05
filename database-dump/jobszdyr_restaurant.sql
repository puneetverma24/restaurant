-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2020 at 09:08 AM
-- Server version: 10.3.25-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobszdyr_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` varchar(50) COLLATE utf8_bin NOT NULL,
  `permission` varchar(12) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`uid`, `username`, `password`, `role`, `permission`) VALUES
(1, 'admin', 'admin', 'Admin', '11111110'),
(2, 'Raju', '123456', 'Waiter', '00001100');

-- --------------------------------------------------------

--
-- Table structure for table `discount_table`
--

CREATE TABLE `discount_table` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `d_description` varchar(128) COLLATE utf8_bin NOT NULL,
  `d_rate` varchar(50) COLLATE utf8_bin NOT NULL,
  `d_type` tinyint(4) NOT NULL,
  `d_coupon` varchar(12) COLLATE utf8_bin NOT NULL,
  `d_expiry` datetime NOT NULL,
  `d_activate` tinyint(4) NOT NULL,
  `d_mbill` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `discount_table`
--

INSERT INTO `discount_table` (`d_id`, `d_name`, `d_description`, `d_rate`, `d_type`, `d_coupon`, `d_expiry`, `d_activate`, `d_mbill`) VALUES
(1, 'OFFER 50', '2019-12-26', '50', 0, 'DMF50', '2019-12-26 00:00:00', 1, 200);

-- --------------------------------------------------------

--
-- Table structure for table `food_menu_item`
--

CREATE TABLE `food_menu_item` (
  `item_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `item_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(50) COLLATE utf8_bin NOT NULL,
  `item_description` varchar(128) COLLATE utf8_bin NOT NULL,
  `item_price` double(9,2) NOT NULL,
  `item_discount_price` double(9,2) NOT NULL,
  `item_discount_expiry` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item_image_url` varchar(256) COLLATE utf8_bin NOT NULL,
  `category_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `item_visibility` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `food_menu_item`
--

INSERT INTO `food_menu_item` (`item_id`, `restaurant_id`, `item_name`, `item_type`, `item_description`, `item_price`, `item_discount_price`, `item_discount_expiry`, `item_image_url`, `category_name`, `item_visibility`) VALUES
(1, 1, 'Fish Curry', 'Veg', 'NULL', 200.00, 0.00, '0000-00-00 00:00:00', 'index.png', 'Fish', 1),
(2, 1, 'Fish', 'Veg', 'NULL', 250.00, 0.00, '0000-00-00 00:00:00', 'index.png', 'Fish', 1),
(3, 1, 'Cold Drink', 'Veg', 'NULL', 52.00, 0.00, '0000-00-00 00:00:00', 'index.png', 'Berveges', 1),
(4, 1, 'Cake', 'Veg', 'NULL', 502.00, 0.00, '0000-00-00 00:00:00', 'THU_1577288107.jpg', 'Fish', 1),
(5, 1, 'Anil', 'Veg', 'NULL', 50.00, 0.00, '0000-00-00 00:00:00', 'THU_1577264984.jpg', 'Fish', 1),
(6, 1, 'Noodles', 'Veg', 'NULL', 100.00, 0.00, '0000-00-00 00:00:00', 'THU_1577270544.jpg', 'Chinese', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `order_items` varchar(50) COLLATE utf8_bin NOT NULL,
  `order_qty` int(11) NOT NULL,
  `current_price` double(9,2) NOT NULL,
  `item_price` double(9,2) NOT NULL,
  `order_bill` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_date` date NOT NULL,
  `order_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`order_id`, `restaurant_id`, `order_items`, `order_qty`, `current_price`, `item_price`, `order_bill`, `user_id`, `order_time`, `order_date`, `order_status`) VALUES
(1, 1, '1,2,3', 1, 200.00, 150.00, '504', 1, '2019-12-25 07:40:18', '2019-12-25', 1),
(2, 1, '3', 4, 52.00, 52.00, '208', 1, '2019-12-25 07:43:44', '2019-12-25', 1),
(3, 1, '1', 3, 200.00, 150.00, '450', 1, '2019-12-25 08:20:09', '2019-12-25', 1),
(4, 1, '4,3,2', 1, 502.00, 502.00, '804', 1, '2019-12-25 10:36:55', '2019-12-25', 1),
(5, 1, '1,3,5', 2, 200.00, 150.00, '402', 1, '2019-12-25 10:39:05', '2019-12-25', 1),
(6, 1, '2,3,4', 1, 250.00, 250.00, '804', 1, '2019-12-25 15:26:54', '2019-12-25', 1),
(7, 1, '4,3,6', 1, 502.00, 502.00, '1010', 1, '2020-11-05 13:01:20', '2020-11-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`category_id`, `category_name`, `restaurant_id`) VALUES
(1, 'Fish', 1),
(4, 'Berveges', 1),
(5, 'Chinese', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `item_order` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `table_no`, `item_order`) VALUES
(19, 1, '{\"Id\":\"4\",\"Name\":\"Cake\",\"Image\":\"THU_1577288107.jpg\",\"Category\":\"Fish\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"502.00\",\"count\":1}'),
(18, 1, '{\"Id\":\"3\",\"Name\":\"Cold Drink\",\"Image\":\"index.png\",\"Category\":\"Berveges\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"52.00\",\"count\":1}'),
(17, 1, '{\"Id\":\"2\",\"Name\":\"Fish\",\"Image\":\"index.png\",\"Category\":\"Fish\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"250.00\",\"count\":1}'),
(21, 5, '{\"Id\":\"3\",\"Name\":\"Cold Drink\",\"Image\":\"index.png\",\"Category\":\"Berveges\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"52.00\",\"count\":1,\"pcount\":1,\"kcount\":0}'),
(22, 5, '{\"Id\":\"2\",\"Name\":\"Fish\",\"Image\":\"index.png\",\"Category\":\"Fish\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"250.00\",\"count\":6}'),
(23, 5, '{\"Id\":\"1\",\"Name\":\"Fish Curry\",\"Image\":\"index.png\",\"Category\":\"Fish\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"200.00\",\"count\":1}'),
(24, 5, '{\"Id\":\"4\",\"Name\":\"Cake\",\"Image\":\"THU_1577288107.jpg\",\"Category\":\"Fish\",\"Discount_price\":\"0\",\"Discount_expiry\":\"0000-00-00\",\"Price\":\"502.00\",\"count\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_details`
--

CREATE TABLE `restaurant_details` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(128) COLLATE utf8_bin NOT NULL,
  `restaurant_phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `restaurant_address` varchar(128) COLLATE utf8_bin NOT NULL,
  `restaurant_gstno` varchar(50) COLLATE utf8_bin NOT NULL,
  `restaurant_taxtype` varchar(12) COLLATE utf8_bin NOT NULL,
  `no_of_table` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `restaurant_details`
--

INSERT INTO `restaurant_details` (`restaurant_id`, `restaurant_name`, `restaurant_phone`, `restaurant_address`, `restaurant_gstno`, `restaurant_taxtype`, `no_of_table`) VALUES
(1, 'Bay Leaf', '9192025252', 'Bangalore', 'GST/2019/725', '5', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `user_gender` varchar(12) COLLATE utf8_bin NOT NULL,
  `user_dob` date NOT NULL,
  `user_email` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_address` varchar(150) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `user_name`, `user_phone`, `user_gender`, `user_dob`, `user_email`, `user_address`) VALUES
(1, 'Guest', '8669046705', 'male', '2019-12-25', 'anilkumar.vp@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `discount_table`
--
ALTER TABLE `discount_table`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `food_menu_item`
--
ALTER TABLE `food_menu_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount_table`
--
ALTER TABLE `discount_table`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_menu_item`
--
ALTER TABLE `food_menu_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
