-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2023 at 10:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int NOT NULL,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `poid` int NOT NULL,
  `age` int NOT NULL,
  `race` varchar(255) NOT NULL,
  `taille` int NOT NULL,
  `enclos_id` int NOT NULL,
  `imgid` int DEFAULT NULL,
  `vie` int DEFAULT '100',
  `bouffe` int DEFAULT '100',
  `dead` int NOT NULL DEFAULT '0',
  `deathcause` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Inconnu',
  `created_at` timestamp NULL DEFAULT NULL,
  `lastfoodupdate` timestamp NULL DEFAULT NULL,
  `lastvieupdate` timestamp NULL DEFAULT NULL,
  `lastageupdate` timestamp NULL DEFAULT NULL,
  `lastfrauduleuxvieupdate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `poid`, `age`, `race`, `taille`, `enclos_id`, `imgid`, `vie`, `bouffe`, `dead`, `deathcause`, `created_at`, `lastfoodupdate`, `lastvieupdate`, `lastageupdate`, `lastfrauduleuxvieupdate`) VALUES
(91, '1', 1, 10, 'Mouton', 1, 2, 2, 100, 62, 1, 'Noyade', '2023-03-26 19:38:01', '2023-03-26 21:32:30', '2023-03-26 19:38:01', '2023-03-26 21:32:30', '2023-03-26 21:32:30'),
(92, '1', 1, 1, 'Mouton', 1, 2, 3, 100, 100, 1, 'Noyade', '2023-03-26 21:49:31', '2023-03-26 21:49:31', '2023-03-26 21:49:31', '2023-03-26 21:49:31', '2023-03-26 21:49:31'),
(98, '1', 1, 31, 'Mouton', 1, 1, 1, 100, -22, 1, 'Famine', '2023-03-26 21:53:11', '2023-03-27 04:00:41', '2023-03-26 23:00:38', '2023-03-27 04:00:41', '2023-03-26 23:00:38'),
(99, '1', 1, 1, 'Poulet', 1, 3, 6, 100, 100, 1, 'Graille', '2023-03-26 21:54:01', '2023-03-26 21:54:01', '2023-03-26 21:54:01', '2023-03-26 21:54:01', '2023-03-26 21:54:01'),
(100, '1', 1, 61, 'Renard', 1, 1, 1, 100, -140, 1, 'Famine', '2023-03-27 09:01:33', '2023-03-27 21:04:25', '2023-03-27 09:01:33', '2023-03-27 21:04:25', '2023-03-27 09:01:33'),
(101, '1', 1, 103, 'Poissons', 1, 2, 22, 100, 80, 1, 'Vieux', '2023-03-27 21:06:44', '2023-03-27 22:06:51', '2023-03-27 21:06:44', '2023-03-27 22:06:51', '2023-03-27 22:06:51'),
(102, '1', 1, 1, 'Poissons', 1, 2, 10, 100, 100, 0, 'Inconnu', '2023-03-27 22:33:21', '2023-03-27 22:33:21', '2023-03-27 22:33:21', '2023-03-27 22:33:21', '2023-03-27 22:33:21'),
(103, '1', 12, 1, 'Renard', 60, 4, 1, 100, 100, 0, 'Inconnu', '2023-03-26 21:41:58', '2023-03-26 21:41:58', '2023-03-26 21:41:58', '2023-03-26 21:41:58', '2023-03-26 21:41:58'),
(104, 'Pierre', 40, 4, 'Renard', 12, 4, 4, 100, 100, 0, 'Inconnu', '2023-03-26 21:42:07', '2023-03-26 21:42:07', '2023-03-26 21:42:07', '2023-03-26 21:42:07', '2023-03-26 21:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `enclos`
--

CREATE TABLE `enclos` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `dirty` varchar(255) NOT NULL,
  `animals_amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enclos`
--

INSERT INTO `enclos` (`id`, `name`, `type`, `dirty`, `animals_amount`) VALUES
(1, 'Mouton', 'Terrestre', 'Mauvaise', 0),
(2, 'Poissons', 'Aquarium', 'Mauvaise', 1),
(3, 'Poulet', 'Voliere', 'Mauvaise', 1),
(4, 'Renard', 'Terrestre', 'Mauvaise', 2),
(5, 'Cimetiere', 'Cimetiere', 'OSEF', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enclos`
--
ALTER TABLE `enclos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `enclos`
--
ALTER TABLE `enclos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
