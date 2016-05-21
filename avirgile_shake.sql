-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2015 at 04:35 AM
-- Server version: 5.6.23
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `avirgile_shake`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `activity` varchar(999) NOT NULL,
  `position` varchar(999) NOT NULL,
  `type` varchar(999) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity`, `position`, `type`, `id`) VALUES
('American Football', 'Wide Receiver', 'Repeated High Intensity', 1),
('American Football', 'Running Back', 'Repeated High Intensity', 2),
('American Football', 'Kicker / Punter', 'Skill', 3),
('American Football', 'Quarterback', 'Skill', 4),
('American Football', 'Tight End', 'Repeated High Intensity', 5),
('American Football', 'Linebacker', 'Repeated High Intensity', 6),
('American Football', 'Lineman', 'Repeated High Intensity', 7),
('American Football', 'Defensive Back', 'Repeated High Intensity', 8),
('Baseball and Softball', 'Infielder', 'Skill', 9),
('Baseball and Softball', 'Outfielder', 'Skill', 10),
('Baseball and Softball', 'Designated Hitter', 'Skill', 11),
('Baseball and Softball', 'Catcher', 'Skill', 12),
('Baseball and Softball', 'Pitcher', 'Repeated High Intensity', 13),
('Basketball', 'Forward', 'Repeated High Intensity', 14),
('Basketball', 'Guard', 'Repeated High Intensity', 15),
('Basketball', 'Center', 'Repeated High Intensity', 16),
('Bodybuilding ', 'N/A', 'Repeated High Intensity', 17),
('Bowling', 'N/A', 'Skill', 18),
('Combat Sports ', 'N/A', 'Repeated High Intensity', 19),
('Cricket', 'N/A', 'Skill', 20),
('Cross Country', 'N/A', 'Endurance', 21),
('CrossFit', 'N/A', 'Repeated High Intensity', 22),
('Swimming', '550m - 4000m', '', 23),
('Swimming', '50m -500m', 'Endurance', 24),
('Running', '> 800m', 'Endurance', 25),
('Running', '150m - 800m', 'Repeated High Intensity', 26),
('Running', '30m - 100m', 'Skill', 27),
('Bicycling', '', 'Endurance', 28),
('Field Hockey', 'Goalie', 'Skill', 29),
('Field Hockey', 'Defense', 'Repeated High Intensity', 30),
('Field Hockey', 'Midfielder', 'Repeated High Intensity', 31),
('Field Hockey', 'Striker', 'Repeated High Intensity', 32),
('Figure Skating', 'N/A', 'Skill', 33),
('Golf', 'N/A', 'Skill', 34),
('Gymnastics', 'Floor Exercise', 'Repeated High Intensity', 35),
('Gymnastics', 'Balance Beam', 'Skill', 36),
('Gymnastics', 'Uneven Bars', 'Repeated High Intensity', 37),
('Gymnastics', 'Vault', 'Repeated High Intensity', 38),
('Ice Hockey', 'Goalie', 'Skill', 39),
('Ice Hockey', 'Defenseman', 'Repeated High Intensity', 40),
('Ice Hockey', 'Forward', 'Repeated High Intensity', 41),
('Iron Man', 'N/A', 'Endurance', 42),
('Lacrosse', 'Forward', 'Repeated High Intensity', 43),
('Lacrosse', 'Defenseman', 'Repeated High Intensity', 44),
('Lacrosse', 'Midfielder', 'Repeated High Intensity', 45),
('Lacrosse', 'Goalie', 'Skill', 46),
('Powerlifting', 'N/A', 'Skill', 47),
('Rowing', '', '', 48),
('Rugby', 'Back', 'Repeated High Intensity', 49),
('Rugby', 'Forward', 'Endurance', 50),
('Snow Sports', 'Skiing - Cross Country', 'Endurance', 51),
('Snow Sports', 'Skiing - Alpine', 'Repeated High Intensity', 52),
('Snow Sports', 'Skiing - Ski Jumping', 'Skill', 53),
('Snow Sports', 'Snowboarding', 'Repeated High Intensity', 54),
('Soccer', 'Forward', 'Repeated High Intensity', 55),
('Soccer', 'Defenseman', 'Repeated High Intensity', 56),
('Soccer', 'Midfielder', 'Repeated High Intensity', 57),
('Soccer', 'Goalie', 'Skill', 58),
('Swimming - 50m-500m', '', 'Repeated High Intensity', 59),
('Swimming - 800m-4000m', '', 'Endurance', 60),
('Tennis', 'N/A', 'Repeated High Intensity', 61),
('Tough Mudder', 'N/A', 'Endurance', 62),
('Track and Field ', '> 800m', 'Endurance', 63),
('Track and Field', '150m - 800m', 'Repeated High Intensity', 64),
('Track and Field ', '30m - 100m', 'Skill', 65),
('Track and Field ', 'High Jump', 'Skill', 66),
('Track and Field ', 'Triple Jump', 'Skill', 67),
('Track and Field ', 'Pole Vault', 'Skill', 68),
('Track and Field ', 'Long Jump', 'Skill', 69),
('Track and Field ', 'Shotput', 'Skill', 70),
('Track and Field ', 'Javelin', 'Skill', 71),
('Track and Field ', 'Hammer', 'Skill', 72),
('Track and Field ', 'Discus', 'Skill', 73),
('Track and Field', 'Run - Sprints (20m - 400m)', 'Skill', 74),
('Track and Field', 'Run - Middle Distance (800m - 1500m)', 'Repeated High Intensity', 75),
('Track and Field', 'Run - Long Distance (3000m - Marathon) ', 'Endurance', 76),
('Triathalon', '', 'Endurance', 77),
('Volleyball', 'Outside Hitter', 'Repeated High Intensity', 78),
('Volleyball', 'Middle Blocker', 'Repeated High Intensity', 79),
('Volleyball', 'Setter', 'Repeated High Intensity', 80),
('Volleyball', 'Libero / Defensive Specialist', 'Skill', 81),
('Water Sports', '', 'Skill', 82),
('Weightlifting', 'Circuits, Low Intensity', 'Endurance', 83),
('Weightlifting', 'Low Intensity', 'Skill', 84),
('Weightlifting', 'High Intensity', 'Repeated High Intensity', 85),
('Weightlifting', 'Circuits, High Intensity', 'Repeated High Intensity', 86),
('Wrestling', 'N/A', 'Repeated High Intensity', 87);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `owner` varchar(999) NOT NULL,
  `calories` int(255) NOT NULL,
  `protein` int(255) NOT NULL,
  `fat` int(255) NOT NULL,
  `carbs` int(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `dateadded` date NOT NULL,
  `activity` varchar(999) NOT NULL,
  `type` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `owner`, `calories`, `protein`, `fat`, `carbs`, `weight`, `dateadded`, `activity`, `type`) VALUES
(25, 'nickgermaine', 3772, 214, 44, 629, 230, '2014-12-19', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(26, 'nickgermaine', 3721, 214, 44, 343, 110, '2014-12-01', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(27, 'nickgermaine', 3772, 214, 44, 629, 100, '2014-12-16', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(28, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(29, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(30, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(31, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(32, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(33, 'avirgile', 0, 0, 0, 0, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(34, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(35, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(36, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(37, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(38, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(39, 'avirgile', 3772, 214, 44, 629, 100, '2014-12-20', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(40, 'avirgile', 3772, 214, 44, 629, 100, '2015-01-06', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(41, 'avirgile', 3772, 214, 44, 629, 100, '2015-01-06', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(42, 'avirgile', 2910, 160, 30, 500, 100, '2015-02-21', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(43, 'avirgile', 5561, 321, 70, 910, 120, '2015-03-03', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(44, 'avirgile', 5561, 321, 70, 910, 120, '2015-03-03', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(45, 'avirgile', 0, 0, 0, 0, 120, '2015-03-03', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(46, 'avirgile', 0, 0, 0, 0, 115, '2015-03-04', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(47, 'avirgile', 0, 0, 0, 0, 115, '2015-03-04', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(48, 'avirgile', 5329, 308, 68, 872, 115, '2015-03-04', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(49, 'avirgile', 5329, 308, 68, 872, 115, '2015-03-04', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(50, 'avirgile', 0, 0, 0, 0, 215, '2015-03-04', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(51, '', 0, 0, 0, 0, 140, '2015-07-22', 'Track and Field  - Shotput', 'Skill'),
(52, '', 0, 0, 0, 0, 0, '2015-07-23', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(53, '', 0, 0, 0, 0, 0, '2015-07-31', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(54, '', 0, 0, 0, 0, 0, '2015-08-31', 'American Football - Wide Receiver', 'Repeated High Intensity'),
(55, '', 0, 0, 0, 0, 0, '2015-08-31', 'American Football - Wide Receiver', 'Repeated High Intensity');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE IF NOT EXISTS `research` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(999) NOT NULL,
  `summary` varchar(9999) NOT NULL,
  `url` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`id`, `title`, `summary`, `url`) VALUES
(1, 'Research demo', 'This is to show how the research will be pulled out onto the shakebot research page.  This is only a test, linking to a test page.', 'http://pointybracket.net'),
(2, 'Research demonstration 2', 'This is to show how the research will be pulled out onto the shakebot research page.  This is only a test, linking to a test page.  Additionally, no use will come of clicking on this link.  Don''t, unless you want to see how it will load.', 'http://pointybracket.net');

-- --------------------------------------------------------

--
-- Table structure for table `userActivities`
--

CREATE TABLE IF NOT EXISTS `userActivities` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `activity` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `userActivities`
--

INSERT INTO `userActivities` (`id`, `activity`, `owner`, `type`, `position`) VALUES
(1, 'American Football', 'nickgermaine', 'RHI', 'Quarterback'),
(2, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(3, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(4, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(5, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(6, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(7, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(8, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(9, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(10, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(11, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(12, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(13, 'Wrestling', 'avirgile', 'Repeated High Intensity', 'N/A'),
(14, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(15, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(16, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(17, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(18, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(19, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(20, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(21, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(22, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(23, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(24, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(25, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(26, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(27, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(28, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(29, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(30, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(31, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(32, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(33, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(34, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(35, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(36, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(37, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(38, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(39, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(40, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(41, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(42, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(43, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(44, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(45, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(46, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(47, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(48, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(49, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(50, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(51, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(52, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(53, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(54, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(55, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(56, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(57, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(58, 'Baseball and Softball', 'avirgile', 'Skill', 'Outfielder'),
(59, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(60, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(61, 'Triathalon', 'avirgile', 'Endurance', ''),
(62, 'Triathalon', 'avirgile', 'Endurance', ''),
(63, 'Triathalon', 'avirgile', 'Endurance', ''),
(64, 'Triathalon', 'avirgile', 'Endurance', ''),
(65, 'Triathalon', 'avirgile', 'Endurance', ''),
(66, 'Triathalon', 'avirgile', 'Endurance', ''),
(67, 'Triathalon', 'avirgile', 'Endurance', ''),
(68, 'Triathalon', 'avirgile', 'Endurance', ''),
(69, 'Triathalon', 'avirgile', 'Endurance', ''),
(70, 'Triathalon', 'avirgile', 'Endurance', ''),
(71, 'Triathalon', 'avirgile', 'Endurance', ''),
(72, 'Triathalon', 'avirgile', 'Endurance', ''),
(73, 'Triathalon', 'avirgile', 'Endurance', ''),
(74, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(75, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(76, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(77, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(78, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(79, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(80, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(81, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(82, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(83, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(84, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(85, 'Soccer', 'avirgile', 'Skill', 'Goalie'),
(86, 'Ice Hockey', 'avirgile', 'Repeated High Intensity', 'Forward'),
(87, 'Ice Hockey', 'avirgile', 'Repeated High Intensity', 'Forward'),
(88, 'Ice Hockey', 'avirgile', 'Repeated High Intensity', 'Forward'),
(89, 'Ice Hockey', 'avirgile', 'Repeated High Intensity', 'Forward'),
(90, 'Swimming', 'avirgile', '', '550m - 4000m'),
(91, 'Swimming', 'avirgile', '', '550m - 4000m'),
(92, 'Swimming', 'avirgile', '', '550m - 4000m'),
(93, 'Swimming', 'avirgile', '', '550m - 4000m'),
(94, 'Swimming', 'avirgile', '', '550m - 4000m'),
(95, 'Swimming', 'avirgile', '', '550m - 4000m'),
(96, 'American Football', 'avirgile', 'Skill', 'Quarterback'),
(97, 'American Football', 'avirgile', 'Repeated High Intensity', 'Tight End'),
(98, 'American Football', 'avirgile', 'Repeated High Intensity', 'Tight End'),
(99, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(100, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(101, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(102, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(103, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(104, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(105, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(106, 'American Football', 'avirgile', 'Skill', 'Kicker / Punter'),
(107, 'American Football', 'avirgile', 'Skill', 'Kicker / Punter'),
(108, 'American Football', 'avirgile', 'Skill', 'Kicker / Punter'),
(109, 'American Football', 'avirgile', 'Skill', 'Kicker / Punter'),
(110, 'Basketball', 'avirgile', 'Repeated High Intensity', 'Guard'),
(111, 'Basketball', 'avirgile', 'Repeated High Intensity', 'Guard'),
(112, 'American Football', 'avirgile', 'Repeated High Intensity', 'Running Back'),
(113, 'American Football', 'avirgile', 'Repeated High Intensity', 'Running Back'),
(114, 'American Football', 'avirgile', 'Repeated High Intensity', 'Linebacker'),
(115, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(116, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(117, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(118, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(119, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(120, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(121, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(122, 'Basketball', 'avirgile', 'Repeated High Intensity', 'Center'),
(123, 'Basketball', 'avirgile', 'Repeated High Intensity', 'Center'),
(124, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(125, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(126, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(127, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(128, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(129, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(130, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(131, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(132, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(133, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(134, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(135, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(136, 'American Football', 'nickgermaine', 'Skill', 'Quarterback'),
(137, 'Bowling', 'avirgile', 'Skill', 'N/A'),
(138, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(139, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(140, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(141, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(142, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(143, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(144, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(145, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(146, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(147, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(148, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(149, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(150, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(151, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(152, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(153, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(154, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(155, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(156, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(157, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(158, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(159, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(160, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(161, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(162, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(163, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(164, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(165, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(166, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(167, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(168, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(169, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(170, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(171, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(172, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(173, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(174, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(175, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(176, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(177, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(178, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(179, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(180, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(181, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(182, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(183, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(184, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(185, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(186, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(187, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(188, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(189, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(190, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(191, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(192, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(193, 'Baseball and Softball', 'avirgile', 'Repeated High Intensity', 'Pitcher'),
(194, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(195, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(196, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(197, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(198, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(199, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(200, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(201, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(202, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(203, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(204, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(205, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(206, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(207, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(208, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(209, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(210, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(211, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(212, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(213, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(214, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(215, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(216, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(217, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(218, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(219, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(220, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(221, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(222, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(223, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(224, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(225, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(226, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(227, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(228, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(229, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(230, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(231, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(232, 'American Football', 'avirgile', 'Repeated High Intensity', 'Wide Receiver'),
(233, 'Baseball and Softball', 'avirgile', 'Skill', 'Infielder'),
(234, 'Wrestling', '', 'Repeated High Intensity', 'N/A'),
(235, 'American Football', '', 'Repeated High Intensity', 'Wide Receiver'),
(236, 'American Football', '', 'Repeated High Intensity', 'Wide Receiver'),
(237, 'American Football', '', 'Repeated High Intensity', 'Wide Receiver'),
(238, 'American Football', '', 'Repeated High Intensity', 'Wide Receiver'),
(239, 'American Football', '', 'Repeated High Intensity', 'Wide Receiver');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(999) NOT NULL,
  `password` varchar(999) NOT NULL,
  `firstname` varchar(999) NOT NULL,
  `lastname` varchar(999) NOT NULL,
  `email` varchar(999) NOT NULL,
  `weight` varchar(999) NOT NULL,
  `card` varchar(999) NOT NULL,
  `avatar` varchar(999) NOT NULL,
  `weighttype` varchar(999) NOT NULL,
  `height` int(11) NOT NULL,
  `heighttype` varchar(999) NOT NULL,
  `cover` varchar(999) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(25) NOT NULL,
  `dispDob` varchar(25) NOT NULL,
  `dispWeight` varchar(25) NOT NULL,
  `dispAct` varchar(25) NOT NULL,
  `dispHeight` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `weight`, `card`, `avatar`, `weighttype`, `height`, `heighttype`, `cover`, `type`, `status`, `dispDob`, `dispWeight`, `dispAct`, `dispHeight`, `birthdate`) VALUES
(1, 'nickgermaine', 'b7925873597ae0177ff8abea5da3f8fc', 'Nick', 'Germaine', 'nickgermaine1024@gmail.com', '100', '', '/tmp/nickgermaine/16739-highway-through-the-desert-1680x1050-world-wallpaper.jpg', 'kg', 70, 'inches', '/tmp/nickgermaine/aurora_from_space-wallpaper-1920x1200.jpg', 'coach', '', '', '', 'Display', 'Display', '0000-00-00'),
(2, 'avirgile', 'f16263eebec711ade3a5a5ece572370e', 'Adam', 'Virgile', 'adam.virgile@gmail.com', '215', '', '/tmp/avirgile/picture007.jpg', 'kg', 60, 'inches', '/tmp/Avirgile/white background.jpg', '', '', '', '', '', '', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
