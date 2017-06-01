-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 21, 2016 at 08:38 AM
-- Server version: 5.7.16
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB_0160748855`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `id` int(6) UNSIGNED NOT NULL,
  `car` varchar(30) DEFAULT NULL,
  `driver_id` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`id`, `car`, `driver_id`) VALUES
(4, 'Citroen C8', 11),
(5, 'Alfa Romeo 164', 11),
(13, 'Fiat 126', 15),
(14, 'Audi A6', 15),
(15, 'Polonez FSO fiat 125p', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

CREATE TABLE `Reservations` (
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `ride_id` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Reservations`
--

INSERT INTO `Reservations` (`user_id`, `ride_id`) VALUES
(12, 6),
(10, 6),
(10, 7),
(15, 6),
(11, 9),
(11, 10),
(12, 9),
(12, 11);

-- --------------------------------------------------------

--
-- Table structure for table `Rides`
--

CREATE TABLE `Rides` (
  `id` int(6) UNSIGNED NOT NULL,
  `car_id` int(6) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` time DEFAULT NULL,
  `start` varchar(20) DEFAULT NULL,
  `destination` varchar(20) DEFAULT NULL,
  `places` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rides`
--

INSERT INTO `Rides` (`id`, `car_id`, `date`, `hour`, `start`, `destination`, `places`) VALUES
(6, 4, '2016-11-28', '10:00:00', 'Luxembourg', 'Poznan', 1),
(7, 4, '2016-11-30', '12:00:00', 'Poznan', 'Slupsk', 3),
(8, 15, '2016-11-30', '08:30:00', 'Luxembourg', 'Porto', 2),
(9, 13, '2016-11-23', '10:00:00', 'Esch', 'Luxembourg', 1),
(10, 13, '2016-11-23', '18:00:00', 'Luxembourg', 'Esch', 2),
(11, 13, '2016-11-26', '12:00:00', 'Luxembourg', 'Warsaw', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(6) UNSIGNED NOT NULL COMMENT 'on delete cascade',
  `username` varchar(20) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(40) NOT NULL,
  `salt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `first_name`, `last_name`, `email`, `address`, `birth_date`, `valid`, `password`, `salt`) VALUES
(10, 'marta', 'Marta', 'Bojarska', 'marta@gmail.com', 'Wroclaw', '1989-04-05', 1, '5fb0692d4745e51af2bfb1bf2cd90d80', 'b6787'),
(11, 'klaudia', 'Klaudia', 'Bojarska', 'klaudia.bojarska@gmail.com', 'Slupsk', '1995-04-10', 1, '3ee07a23b6c6a9ff18229696109cfcad', '6b971'),
(12, 'jorge', 'Jorge', 'Viana da Cruz', 'jorge@uni.lu', 'Luksembourg', '1994-10-30', 1, '5173fb2453e8767772390f6f4b07f118', 'd86e9'),
(15, 'user', 'Jan', 'Kowalski', 'jan@gmail.com', 'Warszawa', '1960-01-01', 1, 'd32652f570cdf0f1ec4bb73747eac237', '5dde6'),
(16, 'grzes', 'Grzegorz', 'Brzeczyszczykiewicz', 'g@gmail.com', 'Luxembourg', '1970-02-28', 0, '96e3c0efd65b2835b2fb51f4cb49b0c2', '38ca2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ride_id` (`ride_id`);

--
-- Indexes for table `Rides`
--
ALTER TABLE `Rides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Rides`
--
ALTER TABLE `Rides`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'on delete cascade', AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cars`
--
ALTER TABLE `Cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`ride_id`) REFERENCES `Rides` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Rides`
--
ALTER TABLE `Rides`
  ADD CONSTRAINT `rides_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `Cars` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
