-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2016 at 04:57 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promotions`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_type` enum('event','brand') COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `category`, `category_type`, `icon`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'คอมพิวเตอร์ / IT', 'computer', 'event', 'computer.png', 10, NULL, NULL),
(2, 'เฟอร์นิเจอร์ / ของใช้ในบ้าน', 'furniture', 'event', 'furniture.png', 11, NULL, NULL),
(3, 'บันเทิง / ดนตรี / ภาพยนตร์', 'entertainment', 'event', 'entertainment.png', 12, NULL, NULL),
(4, 'การเงิน-ธนาคาร', 'money-bank', 'event', 'money_bank.png', 13, NULL, NULL),
(5, 'บ้าน / คอนโด', 'home-condo', 'event', 'home_condo.png', 14, NULL, NULL),
(6, 'ยานยนต์', 'automotive', 'event', 'automotive.png', 15, NULL, NULL),
(7, 'สุขภาพ / ร่างกาย', 'health', 'event', 'health.png', 16, NULL, NULL),
(8, 'หนังสือ / เครื่องเขียน', 'book-stationery', 'event', 'book.png', 17, NULL, NULL),
(9, 'กล้อง / ถ่ายภาพ', 'camera-photograph', 'event', 'camera.png', 18, NULL, NULL),
(10, 'ของขวัญ', 'gift', 'event', 'gift.png', 19, NULL, NULL),
(11, 'เครื่องใช้สำนักงาน', 'office-supplies', 'event', 'office_supplies.png', 20, NULL, NULL),
(12, 'เด็ก', 'kids', 'event', 'kids.png', 21, NULL, NULL),
(13, 'สัตว์เลี้ยง', 'pet', 'event', 'pet.png', 22, NULL, NULL),
(14, 'การศึกษา', 'education', 'event', 'education.png', 23, NULL, NULL),
(15, 'เครื่องอุปโภคบริโภค', 'consumer-goods', 'event', 'consumer_goods.png', 24, NULL, NULL),
(16, 'อาหาร / เครื่องดื่ม', 'food-drink', 'event', 'food_drink.png', 1, NULL, NULL),
(17, 'เสื้อผ้า / แฟชั่น / เครื่องประดับ', 'clothes', 'event', 'clothes.png', 2, NULL, NULL),
(18, 'เครื่องสำอาง / ความงาม', 'cosmetic', 'event', 'cosmetic.png', 3, NULL, NULL),
(19, 'ห้างฯ / ซูเปอร์มาเก็ต', 'supermarket', 'event', 'supermarket.png', 4, NULL, NULL),
(20, 'สายการบิน / การเดินทาง', 'airline', 'event', 'airline.png', 5, NULL, NULL),
(21, 'กีฬา', 'sport', 'event', 'sport.png', 6, NULL, NULL),
(22, 'มือถือ / สื่อสาร', 'mobile', 'event', 'mobile.png', 7, NULL, NULL),
(23, 'เครื่องใช้ไฟฟ้า', 'electronics', 'event', 'electronics.png', 8, NULL, NULL),
(24, 'ท่องเที่ยว / ที่พัก / โรงแรม / รีสอร์ท', 'travel', 'event', 'travel.png', 9, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
