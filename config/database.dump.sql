-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2014 at 01:33 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `istanbul24db`
--
CREATE DATABASE `istanbul24db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `istanbul24db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `LastUpdateDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `QuestionID` tinyint(3) unsigned NOT NULL,
  `Name` varchar(64) NOT NULL,
  `TagID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_tag_option_idx` (`TagID`),
  KEY `FK_question_option_idx` (`QuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Question` varchar(255) NOT NULL,
  `LastUpdateDate` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `CategoryID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UQ_tag_name` (`Name`),
  KEY `FK_tag_category_idx` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `venue_meta`
--

CREATE TABLE IF NOT EXISTS `venue_meta` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `venueID` varchar(36) NOT NULL,
  `tagID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_venue_meta_idx` (`venueID`),
  KEY `FK_tag_meta_idx` (`tagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `ID` varchar(36) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Latitude` float(10,6) NOT NULL,
  `Longitude` float(10,6) NOT NULL,
  `LastUpdateDate` date NOT NULL,
  `Rating` float(4,2) unsigned DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `FK_question_option` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`ID`),
  ADD CONSTRAINT `FK_tag_option` FOREIGN KEY (`TagID`) REFERENCES `tags` (`ID`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `FK_tag_category` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `venue_meta`
--
ALTER TABLE `venue_meta`
  ADD CONSTRAINT `FK_tag_meta` FOREIGN KEY (`tagID`) REFERENCES `tags` (`ID`),
  ADD CONSTRAINT `FK_venue_meta` FOREIGN KEY (`venueID`) REFERENCES `venues` (`ID`);
