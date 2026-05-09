-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2026 at 08:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discover_saudi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'mohannad', 'mhnd12345');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `features` text DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `landmarks` text DEFAULT NULL,
  `main_image` varchar(255) NOT NULL,
  `gallery_image_one` varchar(255) NOT NULL,
  `gallery_image_two` varchar(255) NOT NULL,
  `gallery_image_three` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `city`, `region`, `description`, `features`, `activities`, `landmarks`, `main_image`, `gallery_image_one`, `gallery_image_two`, `gallery_image_three`, `created_at`) VALUES
(2, 'العلا', 'المدينة', 'العلا هي وجهة تاريخية تشتهر بالمقابر القديمة والمناظر الصحراوية والتكوينات الصخرية الفريدة.', 'المواقع التاريخية، مناظر الصحراء، التكوينات الصخرية', 'زيارة المعالم السياحية، التصوير الفوتوغرافي، المشي لمسافات طويلة', 'هجرا، صخرة الفيل، مدينة العلا القديمة', '/uploads/places/alula-main.jpg', '/uploads/places/alula-1.jpg', '/uploads/places/alula-2.jpg', '/uploads/places/alula-3.jpg', '2026-04-26 15:28:44'),
(17, 'خميس مشيط', 'عسير', 'اجرب الموقع', 'سهل وسريع', 'اهلا اخلا', 'سهل وسلس', '/uploads/places/IMG_4601.jpeg', '/uploads/places/Screenshot 2026-02-20 at 21.36.02.png', '/uploads/places/Screenshot 2025-12-22 at 22.13.43.png', '/uploads/places/Screenshot 1447-06-26 at 18.18.37 (2).png', '2026-04-27 00:44:47'),
(54, 'ثادق', 'الرياض', 'اجرب الموقع', 'سهل وسريع', 'اهلا ,اخلا', 'اهلا،', '/uploads/places/GroubBite (1).png', '/uploads/places/GroubBite.png', '/uploads/places/vecteezy_tasty-burger-on-the-wooden-board-with-dark-lighting-and_27671389.jpg', '/uploads/places/vecteezy_homemade-strawberry-cake-topping-with-icing-sugar-sweet_8020292.jpg', '2026-04-28 22:46:18'),
(55, 'السودة', 'عسير', 'اجرب الموقع', 'سهل وسريع', 'اهلا اخلا', 'afd', '/uploads/places/IMG_4646.jpeg', '/uploads/places/IMG_4667.jpeg', '/uploads/places/IMG_4643.jpeg', '/uploads/places/IMG_4601.jpeg', '2026-04-28 23:01:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
