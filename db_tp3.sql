-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 05:44 PM
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
-- Database: `db_tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `developer_id` int(11) NOT NULL,
  `developer_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`developer_id`, `developer_nama`) VALUES
(1, 'Hazelight Studios'),
(2, 'Rockstar North'),
(3, 'Supercell'),
(4, 'Avalanche Software'),
(5, 'ConcernedApe'),
(6, 'Maxis'),
(7, 'Ghost Town Games'),
(8, 'Hidden Path Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `game_foto` varchar(255) NOT NULL,
  `game_nama` varchar(255) NOT NULL,
  `game_genre` varchar(255) NOT NULL,
  `game_platform` varchar(255) NOT NULL,
  `developer_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `game_foto`, `game_nama`, `game_genre`, `game_platform`, `developer_id`, `publisher_id`) VALUES
(1, 'itt.jpeg', 'It Takes Two', 'Action-adventure, platform', 'PlayStation 4, PlayStation 5, Windows, Xbox One, Xbox Series X/S, Nintendo Switch', 1, 1),
(2, 'gtav.jpg', 'Grand Theft Auto V', 'Action-adventure', 'PlayStation 3, Xbox 360, PlayStation 4, Xbox One, Windows, PlayStation 5, Xbox Series X/S', 2, 2),
(3, 'coc.jpg', 'Clash of Clans', 'Strategy', 'iOS, iPadOS, Android', 3, 3),
(4, 'hl.jpg', 'Hogwarts Legacy', 'Action role-playing', 'PlayStation 5, Windows, Xbox Series X/S, PlayStation 4, Xbox One, Nintendo Switch', 4, 4),
(5, 'sv.jpg', 'Stardew Valley', 'Simulation, role-playing', 'Windows, macOS, Linux, PlayStation 4, Xbox One, Nintendo Switch, PlayStation Vita, iOS, Android', 5, 5),
(6, 'thesims4.jpeg', 'The Sims™ 4', 'Social simulation', 'Windows, OS X, PlayStation 4, Xbox One', 6, 1),
(7, 'overcooked2.jpeg', 'Overcooked 2', 'Simulation', 'Linux, macOS, Nintendo Switch, PlayStation 4, Windows, Xbox One, PlayStation 5, Xbox Series X/S, Google Stadia', 7, 6),
(8, 'csgo.jpg', 'Counter-Strike: Global Offensive', 'Tactical first-person shooter', 'OS X, PlayStation 3, Windows, Xbox 360, Linux', 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `publisher_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `publisher_nama`) VALUES
(1, 'Electronic Arts'),
(2, 'Rockstar Games'),
(3, 'Supercell'),
(4, 'Warner Bros. Games'),
(5, 'ConcernedApe'),
(6, 'Team17'),
(7, 'Valve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`developer_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `developer_id` (`developer_id`,`publisher_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `developer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`developer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
