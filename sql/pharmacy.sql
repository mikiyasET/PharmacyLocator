-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2022 at 05:15 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAdmin` (IN `id` VARCHAR(13), IN `user` VARCHAR(50), IN `pass` TEXT)  NO SQL
insert into admin (aid,username,password) VALUES(id,user,pass)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` varchar(13) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
('61f0f82b4ea7b', 'Admin', '$2y$10$LmOCG9KE.N4GUD8mG7x.RuS9nxmKf52E.iKeKPWIiLSk9MeDh2rku');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lid` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lid`, `name`) VALUES
('61f0506de86cf', 'Lideta'),
('61f05116b7ff4', 'Mexico'),
('61f0512881174', 'Jemo'),
('61f0513235337', 'Piyassa');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `mid` varchar(13) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `aid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`mid`, `name`, `description`, `img`, `aid`) VALUES
('61f10201ba942', 'SUPERSTAR Sneakers ', 'asas', '61f10201ba359FIB4SxJWUAAXmE8.jpg', '61f0f82b4ea7b'),
('61f11e8e3a4f9', 'Denim Plain', 'asdasdasd', '61f11e8e336d7[CodeAbay-Services-Image] - 6183ffc09b0e2.jpg', '61f0f82b4ea7b');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `pid` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `mapLink` text NOT NULL,
  `lid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`pid`, `name`, `email`, `password`, `mapLink`, `lid`) VALUES
('61f0fc492f449', 'Axum Pharmacy', 'mikiyaslemlemu@gmail.com', '$2y$10$ehlaaPzt00K6nOKr2FrEduFRCXz1ejkeakN7gKcYRd0pwexww0KsG', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15763.458220486058!2d38.718106869775376!3d8.984608899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b87d890be4bf3%3A0xa2ec290b1db4e2c1!2sHealth%20Corner%20Pharmacy!5e0!3m2!1sen!2set!4v1643142597555!5m2!1sen!2set', '61f05116b7ff4');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `rid` varchar(13) NOT NULL,
  `uid` varchar(13) NOT NULL,
  `mid` varchar(13) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `sid` varchar(13) NOT NULL,
  `mid` varchar(13) NOT NULL,
  `pid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`sid`, `mid`, `pid`) VALUES
('61f16899d8522', '61f11e8e3a4f9', '61f0fc492f449');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `fk_medicine_admin` (`aid`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fk_pharmacy_location` (`lid`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `fk_record_medicine` (`mid`),
  ADD KEY `fk_record_users` (`uid`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `fk_store_medicine` (`mid`),
  ADD KEY `fk_store_pharmacy` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `fk_medicine_admin` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `fk_pharmacy_location` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `fk_record_medicine` FOREIGN KEY (`mid`) REFERENCES `medicine` (`mid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_record_users` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_store_medicine` FOREIGN KEY (`mid`) REFERENCES `medicine` (`mid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_store_pharmacy` FOREIGN KEY (`pid`) REFERENCES `pharmacy` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
