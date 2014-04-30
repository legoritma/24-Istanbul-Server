SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS istanbul24db DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE istanbul24db;

CREATE TABLE categories (
  ID tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  LastUpdateDate date NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `options` (
  ID tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  QuestionID tinyint(3) unsigned NOT NULL,
  `Name` varchar(64) NOT NULL,
  TagID tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (ID),
  KEY FK_tag_option_idx (TagID),
  KEY FK_question_option_idx (QuestionID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE questions (
  ID tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  Question varchar(255) NOT NULL,
  LastUpdateDate date NOT NULL,
  CategoryID tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (ID),
  KEY CategoryID (CategoryID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE tags (
  ID tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  CategoryID tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (ID),
  KEY UQ_tag_name (`Name`),
  KEY FK_tag_category_idx (CategoryID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE venue_meta (
  ID int(10) unsigned NOT NULL AUTO_INCREMENT,
  venueID varchar(36) NOT NULL,
  tagID tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (ID),
  KEY FK_venue_meta_idx (venueID),
  KEY FK_tag_meta_idx (tagID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE venues (
  ID varchar(36) NOT NULL,
  `Name` varchar(255) NOT NULL,
  Latitude float(10,6) NOT NULL,
  Longitude float(10,6) NOT NULL,
  LastUpdateDate date NOT NULL,
  Address varchar(255) DEFAULT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE options
  ADD CONSTRAINT FK_question_option FOREIGN KEY (QuestionID) REFERENCES questions (ID),
  ADD CONSTRAINT FK_tag_option FOREIGN KEY (TagID) REFERENCES tags (ID);

ALTER TABLE questions
  ADD CONSTRAINT questions_ibfk_1 FOREIGN KEY (CategoryID) REFERENCES categories (ID);

ALTER TABLE tags
  ADD CONSTRAINT FK_tag_category FOREIGN KEY (CategoryID) REFERENCES categories (ID);

ALTER TABLE venue_meta
  ADD CONSTRAINT FK_tag_meta FOREIGN KEY (tagID) REFERENCES tags (ID),
  ADD CONSTRAINT FK_venue_meta FOREIGN KEY (venueID) REFERENCES venues (ID);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
