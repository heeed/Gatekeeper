-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2012 at 08:40 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.11-1~dotdeb.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gatekeeper`
--
CREATE DATABASE `gatekeeper` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gatekeeper`;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `Attendee #` int(9) DEFAULT NULL,
  `Date` varchar(11) DEFAULT NULL,
  `Last Name` varchar(12) DEFAULT NULL,
  `First Name` varchar(7) DEFAULT NULL,
  `Email` varchar(34) DEFAULT NULL,
  `QTY` int(1) DEFAULT NULL,
  `Ticket Type` varchar(6) DEFAULT NULL,
  `Order #` int(8) DEFAULT NULL,
  `present` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

