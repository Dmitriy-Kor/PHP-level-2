←
phpMyAdmin
HomeEmpty session dataphpMyAdmin documentationDocumentationNavigation panel settingsReload navigation panel
RecentFavorites
Collapse allUnlink from main panel
New
Expand/CollapseDatabase operationsinformation_schema
Expand/CollapseDatabase operationsmysql
Expand/CollapseDatabase operationsperformance_schema
Database operationsshop
NewNew
Expand/CollapseStructurebasket
Expand/CollapseStructureproducts
Expand/CollapseStructureusers
Expand/CollapseDatabase operationssys
Server: localhost:8889 »Database: shop
Structure Structure
SQL SQL
Search Search
Query Query
Export Export
Import Import
Operations Operations
Privileges Privileges
Routines Routines
Events Events
Triggers Triggers
More
Click on the bar to scroll to top of page
SQL Query Console Console
ascendingdescendingOrder:Debug SQLExecution orderTime takenOrder by:Group queries
Some error occurred while getting SQL debug info.
OptionsSet default
Always expand query messages
Show query history at start
Show current browsing query
 Execute queries on Enter and insert new line with Shift + Enter. To make this permanent, view settings.
Switch to dark theme

[ Back ]

[ Refresh ]
-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2020 at 12:33 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `product_id`) VALUES
(1, '123qwerty', 1),
(2, '123qwerty', 2),
(3, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(4, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(5, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(6, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(7, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(8, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(9, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(10, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(11, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1),
(12, 'd3u0rtb4mqb3fvf3tl6c9opmoc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `img`) VALUES
(1, 'Smart Phone', 'White color', 500, 'product_1.jpg'),
(2, 'Speaker', 'Stereo speaker', 200, 'product_2.jpg'),
(3, 'Cable', 'usb cable 1 meter', 30, 'product_3.jpg'),
(4, 'Laptop', '15 inch', 2000, 'product_4.jpg'),
(9, 'Headphones', 'stereo 24 om', 120, 'product_5.jpg'),
(38, 'Tablet', '9 inch', 400, 'product_6.jpg'),
(43, 'Smart Phone', 'Black color', 300, 'product_7.jpg'),
(44, 'Keyboard', 'Ru-Eng', 50, 'product_8.jpg'),
(45, 'Drone', '4k camera', 1500, 'product_9.jpg'),
(46, 'Headphones', 'Stereo 12 om', 55, 'product_10.jpg'),
(47, 'Game Console', 'white color', 250, 'product_11.jpg'),
(48, 'Lens', '100 mm', 275, 'product_12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(1, 'admin', '123'),
(2, 'user', '123'),
(3, 'user2', 'qwerty');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);


[ Back ]

[ Refresh ]
Open new phpMyAdmin window