-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2011 at 06:30 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mitsps`
--

-- --------------------------------------------------------

--
-- Table structure for table `end_sem_grade`
--

CREATE TABLE IF NOT EXISTS `end_sem_grade` (
  `REGNO` varchar(15) DEFAULT NULL,
  `SESS` int(11) DEFAULT NULL,
  `SUB` varchar(50) DEFAULT NULL,
  `GRADES` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE IF NOT EXISTS `guardian` (
  `GID` varchar(15) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `PHOTO` blob NOT NULL,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`GID`, `NAME`, `PHOTO`) VALUES
('G001', 'Mr. Sarvesh', ''),
('G002', 'Mr. Santosh', ''),
('G003', 'Mr. Kamath', '');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `SUBCODE` varchar(10) NOT NULL,
  `SUBNAME` varchar(20) DEFAULT NULL,
  `SUB_CREDIT` int(11) DEFAULT NULL,
  `DEPT` varchar(10) DEFAULT NULL,
  `SEM` int(11) DEFAULT NULL,
  PRIMARY KEY (`SUBCODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`SUBCODE`, `SUBNAME`, `SUB_CREDIT`, `DEPT`, `SEM`) VALUES
('CS-1', 'Computer Graphics', 5, 'CS', 5),
('ICT-1', 'Computer Networks', 5, 'ICT', 5),
('ICT-2', 'Computer Graphics', 5, 'ICT', 5);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `USERID` varchar(15) NOT NULL,
  `PASS` varchar(40) DEFAULT NULL,
  `TYPE` char(2) DEFAULT NULL,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`USERID`, `PASS`, `TYPE`) VALUES
('G001', '452c1d6ce8630b4974f6948a06be0959', 'G'),
('S001', '452c1d6ce8630b4974f6948a06be0959', 'S'),
('T001', '452c1d6ce8630b4974f6948a06be0959', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MID` int(11) NOT NULL AUTO_INCREMENT,
  `EMPCODE` varchar(15) DEFAULT NULL,
  `MESSAGE` text,
  `GID` varchar(15) DEFAULT NULL,
  `TYPE` int(11) NOT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`MID`, `EMPCODE`, `MESSAGE`, `GID`, `TYPE`) VALUES
(1, 'T001', 'LOL!', 'G001 ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sess_marks`
--

CREATE TABLE IF NOT EXISTS `sess_marks` (
  `REGNO` varchar(15) DEFAULT NULL,
  `SESS` int(11) DEFAULT NULL,
  `SUBCODE` varchar(50) DEFAULT NULL,
  `MARKS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sess_marks`
--

INSERT INTO `sess_marks` (`REGNO`, `SESS`, `SUBCODE`, `MARKS`) VALUES
('S001', 1, 'ICT-1', '19'),
('S001', 2, 'ICT-1', '15'),
('S001', 3, 'ICT-1', '13'),
('S002', 1, 'ICT-1', '11'),
('S002', 2, 'ICT-1', '12'),
('S002', 3, 'ICT-1', '14');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `REGNO` varchar(15) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `DEPT` varchar(10) DEFAULT NULL,
  `SEM` int(11) DEFAULT NULL,
  `SEC` char(2) DEFAULT NULL,
  `GID` varchar(15) DEFAULT NULL,
  `PHOTO` blob NOT NULL,
  PRIMARY KEY (`REGNO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`REGNO`, `NAME`, `DEPT`, `SEM`, `SEC`, `GID`, `PHOTO`) VALUES
('S001', 'Dhananjay Singh', 'IT', 5, 'A', 'G001', ''),
('S002', 'Saurav Sood', 'IT', 5, 'A', 'G002', ''),
('S003', 'Ram Anand', 'CS', 5, 'B', 'G001', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `EMPCODE` varchar(15) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `DEPT` varchar(10) DEFAULT NULL,
  `PHOTO` blob NOT NULL,
  PRIMARY KEY (`EMPCODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`EMPCODE`, `NAME`, `DEPT`, `PHOTO`) VALUES
('T001', 'Dr. Prasad', 'IT', ''),
('T002', 'Mr. Ravi', 'IT', ''),
('T003', 'Mr. Farahaz', 'CS', '');

-- --------------------------------------------------------

--
-- Table structure for table `tsmap`
--

CREATE TABLE IF NOT EXISTS `tsmap` (
  `EMPCODE` varchar(15) NOT NULL DEFAULT '',
  `SUBCODE` varchar(10) DEFAULT NULL,
  `SEM` int(11) DEFAULT NULL,
  `SEC` char(2) DEFAULT NULL,
  `DEPT` varchar(10) DEFAULT NULL,
  `YEAR` int(11) NOT NULL DEFAULT '2009',
  PRIMARY KEY (`EMPCODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tsmap`
--

INSERT INTO `tsmap` (`EMPCODE`, `SUBCODE`, `SEM`, `SEC`, `DEPT`, `YEAR`) VALUES
('T001', 'ICT-1', 5, 'A', 'IT', 2009),
('T002', 'ICT-2', 5, 'A', 'IT', 2009),
('T003', 'CS-1', 5, 'A', 'CS', 2009);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
