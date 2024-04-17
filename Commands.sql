-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 06:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f1_racing`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `EventDate` date DEFAULT NULL,
  `EventVenue` varchar(100) DEFAULT NULL,
  `RaceCoordinator` varchar(100) DEFAULT NULL,
  `PodiumPositions` varchar(100) DEFAULT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_leader` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `race_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `EventDate`, `EventVenue`, `RaceCoordinator`, `PodiumPositions`, `team_name`, `team_leader`, `nationality`, `race_time`) VALUES
(123, '2024-04-23', 'thereee', 'someee', '3', 'togetherrr', 'someoneee', 'Zimbabwe', '10:30:00'),
(222, '2024-04-27', 'ggg', 'ggg', '7', 'ggg', 'ggg', 'South Africa', '10:30:00'),
(1234567, '2024-04-18', 'xxxx', 'xxxx', '4', 'xxxx', 'xxxx', 'south africa', '00:00:12'),
(723781194, '2024-04-17', 'aaa', 'aaa', '5', 'aaa', 'aaa', 'South Africa', '06:51:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=723781195;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
