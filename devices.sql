-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2017 at 06:09 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fleetsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `device_id` int(10) NOT NULL AUTO_INCREMENT,
  `device_label` varchar(30) NOT NULL,
  `device_reported_datetime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `device_status` enum('OK','OFFLINE') NOT NULL,
  PRIMARY KEY (`device_id`),
  FULLTEXT KEY `device_label` (`device_label`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `device_label`, `device_reported_datetime`, `device_status`) VALUES
(1, 'Device 1', '2017-12-20 11:51:22', 'OK'),
(2, 'Device 2', '2017-12-20 19:51:22', 'OFFLINE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
