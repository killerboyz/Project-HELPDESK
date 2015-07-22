-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2015 at 03:04 AM
-- Server version: 5.5.43
-- PHP Version: 5.4.41-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE IF NOT EXISTS `emp` (
  `empID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Employee ID',
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Username',
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password',
  `empName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Employee Name',
  `empEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Employee E-mail',
  `empTel` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Employee Telephone',
  `Class` enum('admin','support','user') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user' COMMENT 'Code for IT',
  `Create_On` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create User On',
  `last_log_on` timestamp NULL DEFAULT NULL COMMENT 'Last log on',
  PRIMARY KEY (`empID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of Employee' AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faqID` int(3) NOT NULL AUTO_INCREMENT COMMENT 'FAQ ID',
  `faqTopic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `faqType` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `faqDescript` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Content Of FAQ',
  `Create_By` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Create By',
  `Create_On` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create On',
  `Edit_By` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Edit_On` timestamp NULL DEFAULT NULL,
  `hits` int(6) NOT NULL DEFAULT '0' COMMENT 'View Count',
  PRIMARY KEY (`faqID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='FAQ' AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `TicketID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Ticket ID',
  `TicketTopic` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ticket Topic',
  `TicketType` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ticket Type',
  `TroubleDetail` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Trouble Detail',
  `Priority` enum('Low','Normal','High') COLLATE utf8_unicode_ci NOT NULL COMMENT 'Priority',
  `psrPath` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Path of PSR File',
  `Create_On` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create ticket on',
  `Create_By` int(10) NOT NULL COMMENT 'Create ticket by (EmpID)',
  `Support_On` timestamp NULL DEFAULT NULL COMMENT 'Support ticket on',
  `Support_By` int(10) DEFAULT NULL COMMENT 'Support ticket by (EmpID)',
  `Status` enum('Open','Processing','Solved','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Open' COMMENT 'Status of ticket',
  PRIMARY KEY (`TicketID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Ticket Table' AUTO_INCREMENT=74 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `emp` (`empID`, `username`, `password`, `empName`, `empEmail`, `empTel`, `Class`, `Create_On`, `last_log_on`) VALUES
(1, 'admin', 'admin', 'Adminstrator', 'project.helpdesk.siam@gmail.com', '012345678', 'admin', NULL, NULL);
