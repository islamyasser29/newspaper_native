-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 12:22 AM
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
-- Database: `newspaper8`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '50d3fa08d7cb9f885af04416e7f5fc77');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_manager` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `id_manager`) VALUES
(1, 'Politics', 1),
(2, 'Sports', 2),
(5, 'Social', 4),
(6, 'International', 5),
(10, 'sports', 1);

-- --------------------------------------------------------

--
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `main_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id`, `name`, `salary`, `main_profile`) VALUES
(1, 'Ahmed', 50000, '16974949156681204.png'),
(2, 'Ali', 5500, '1697494906png-transparent-red-circle-symbol-logo-font-vip-logo-area-circle.png'),
(4, 'Noha', 7000, '1697494897pexels-pixabay-220453.jpg'),
(5, 'Sayed', 9000, '1697494891FjU2lkcWYAgNG6d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `id_editor` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `id_editor`, `id_category`, `main_image`) VALUES
(9, 'media title ', 'media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title media title ', 4, 2, '16946369411692292594Project.png'),
(11, 'wewwww', 'wewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwww', 4, 5, '16946441081692289984t1.png'),
(13, 'wewww', 'wewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwww', 5, 5, '16957358911.png'),
(14, 'wewwwww', 'wewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwwwwewwwwwwwwwwwwwwwwww', 5, 5, '1694644132x.png'),
(15, 'go reeee', 'go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee go reeee ', 4, 1, '169464426116924777156.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news_images`
--

CREATE TABLE `news_images` (
  `id` int(11) NOT NULL,
  `id_news` int(11) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_images`
--

INSERT INTO `news_images` (`id`, `id_news`, `image_name`) VALUES
(46, 9, '16946237331692289984t1.png'),
(47, 9, '16946237331692290033t1.png'),
(48, 9, '16946237331692292432Project.png'),
(49, 9, '16946237331692292448Project.png'),
(50, 9, '16946237331692292459Project.png'),
(51, 9, '16946237331692292472Project.png'),
(52, 9, '16946237331692292488Project.png'),
(53, 9, '16946237331692292594Project.png'),
(54, 9, '16946237331692292609Untitled.png'),
(55, 9, '16946237331692292876Untitled.png'),
(60, 11, '16946396371692295277t1.png'),
(68, 13, '16946397011692289984t1.png'),
(69, 13, '16946397011692290033t1.png'),
(70, 13, '16946397011692292432Project.png'),
(71, 13, '16946397011692292448Project.png'),
(72, 13, '16946397011692292459Project.png'),
(73, 13, '16946397011692292472Project.png'),
(74, 13, '16946397011692292488Project.png'),
(75, 13, '16946397011692292594Project.png'),
(76, 13, '16946397011692292609Untitled.png'),
(77, 13, '16946397011692292876Untitled.png'),
(78, 14, '16946400441692289984t1.png'),
(79, 14, '16946400441692290033t1.png'),
(80, 14, '16946400441692292432Project.png'),
(81, 14, '16946400441692292448Project.png'),
(82, 14, '16946400441692292459Project.png'),
(83, 14, '16946400441692292472Project.png'),
(84, 14, '16946400441692292488Project.png'),
(85, 14, '16946400441692292594Project.png'),
(86, 14, '16946400441692292609Untitled.png'),
(87, 14, '16946400441692292876Untitled.png'),
(88, 15, '16946442611692289984t1.png'),
(89, 15, '16946442611692290033t1.png'),
(90, 15, '16946442611692292432Project.png'),
(91, 15, '16946442611692292448Project.png'),
(92, 15, '16946442611692292472Project.png'),
(93, 15, '16946442611692292488Project.png'),
(94, 15, '16946442611692292594Project.png'),
(95, 15, '16946442611692292609Untitled.png'),
(96, 15, '16946442611692292895Project.png'),
(97, 15, '16946442611692292895t1.png'),
(98, 15, '16946442611692292895Untitled.png'),
(99, 15, '16946442611692293305Untitled.png');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_editor` (`id_editor`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `news_images`
--
ALTER TABLE `news_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_news` (`id_news`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news_images`
--
ALTER TABLE `news_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_manager`) REFERENCES `editor` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_editor`) REFERENCES `editor` (`id`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Constraints for table `news_images`
--
ALTER TABLE `news_images`
  ADD CONSTRAINT `news_images_ibfk_1` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
