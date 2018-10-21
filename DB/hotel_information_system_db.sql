-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2013 at 06:17 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hotel_information_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `customers`
--
-- --------------------------------------------------------

--
-- Table structure for table `customer_to_room`
--

CREATE TABLE IF NOT EXISTS `customer_to_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `time_checked_in` datetime DEFAULT NULL,
  `time_checked_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `customer_to_room`
--

INSERT INTO `customer_to_room` (`id`, `customer_id`, `room_id`, `time_checked_in`, `time_checked_out`) VALUES
(43, 63, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 65, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 66, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 67, 9, '0000-00-00 00:00:00', '2013-03-18 09:49:59'),
(48, 68, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 63, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 63, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 63, 5, '2013-04-17 09:08:30', '0000-00-00 00:00:00'),
(52, 68, 5, '2013-04-16 00:00:00', NULL),
(62, 78, 7, '2013-04-17 09:54:01', '0000-00-00 00:00:00'),
(63, 79, 10, '2013-04-17 09:56:33', '2013-03-17 11:04:14'),
(64, 80, 8, '2013-04-17 11:10:56', NULL),
(65, 81, 19, '2013-04-17 11:13:01', '2013-04-18 11:00:37'),
(66, 82, 23, '2013-04-18 09:02:33', NULL),
(67, 83, 9, '2013-04-18 09:03:39', NULL),
(68, 84, 15, '2013-04-18 09:06:54', '2013-04-18 11:19:01'),
(69, 85, 25, '2013-04-18 09:07:39', '2013-04-18 11:09:51'),
(70, 86, 10, '2013-04-18 09:12:08', '2013-04-18 11:01:49'),
(71, 87, 9, '2013-04-18 11:52:25', NULL),
(72, 88, 10, '2013-04-18 12:15:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `about` varchar(200) DEFAULT NULL,
  `note_description` varchar(1000) DEFAULT NULL,
  `time_posted` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `user_id`, `about`, `note_description`, `time_posted`) VALUES
(33, 1, 'Adding notes', 'A lot of problem!', 'February 27, 2013 7:06 PM'),
(36, 1, 'git project ko', 'https://github.com/marjiecasosa/log_in_project.git', 'February 28, 2013 11:41 AM'),
(37, 16, '&lt;input type = &quot;submit&quot; value = ''imba'' /&gt; ', '&lt;input type = &quot;submit&quot; value = ''imba'' /&gt;\n', 'April 08, 2013 8:46 AM'),
(39, 1, 'SIR GIBS', 'kailan po you balik? :(', 'March 7, 2013 10:57 AM'),
(40, 1, 'Jhezz', 'love you!!', 'March 7, 2013 5:42 PM'),
(42, 16, 'Check in', 'Call to a member function prepare() on a non-object in /opt/lampp/htdocs/hotel_customer_enlistment_system/PHP/FUNCTIONS_HOME /hotel_data_functions.php on line 123', 'April 02, 2013 9:32 AM'),
(46, 16, 'payment record', ' anu ba yan .. HEHE .. hanap pa ko ng iba ^_^', 'April 02, 2013 9:33 AM'),
(49, 16, 's', 'pa post na lang dito ang mga bugs! thanks', 'April 01, 2013 2:49 PM'),
(52, 16, 'refund', 'asa na ang reimbursement ?!', 'April 01, 2013 2:06 PM'),
(93, 16, 'das', '&lt;button&gt;ada&lt;/button&gt;', 'April 01, 2013 4:52 PM'),
(94, 16, 'dsa', '&lt;ahahaha&gt;', 'April 01, 2013 4:54 PM'),
(97, 16, '&lt;input type = ''submit'' value = ''imba'' /&gt;', '&lt;input type = ''submit'' value = ''imba'' /&gt;', 'April 02, 2013 9:40 AM'),
(98, 16, 'String Reference', 'ucfirst() - Converts the first character of a string to uppercase.<br />\nucwords() - Converts the first character of each word in a string to uppercase.', 'April 02, 2013 11:12 AM'),
(100, 16, 'asd', 'Asa ka<br />\nhah &lt;button&gt;d&lt;/button&gt;', 'April 02, 2013 1:19 PM'),
(102, 16, 'Visit', 'http://www.tutorialspoint.com/mysql/mysql-useful-functions.htm', 'April 03, 2013 1:32 PM'),
(103, 16, 'REIMBURSEMENT', 'Hage!!!!!! Kaiha man ui! &gt;.&lt;', 'April 08, 2013 9:09 AM'),
(104, 16, '&lt;input type = &quot;submit&quot; value = ''now'' /&gt; ', '&lt;input type = &quot;submit&quot; value = ''yeah'' /&gt;\n', 'April 08, 2013 8:45 AM'),
(105, 16, '&amp;nbsp;', 'wew&amp;', 'April 04, 2013 7:31 AM'),
(106, 16, '&lt;input type = &quot;submit&quot; value = ''imba'' /&gt;', '', 'April 08, 2013 8:37 AM'),
(107, 16, 'Solo System', NULL, 'April 10, 2013 2:25 PM'),
(108, 16, 'gtf', 'hgfh', 'April 10, 2013 2:26 PM'),
(112, 16, 'gh', 'ghp', 'April 15, 2013 3:59 PM'),
(113, 16, 'Name of my repository', 'https://github.com/marejean/hotel_information_system.git', 'April 16, 2013 7:59 AM'),
(114, 16, 'New', 'https://github.com/jeanImba/hotel_information_system.git', 'April 16, 2013 8:09 AM'),
(115, 16, 'IIS', 'https://github.com/jeanImba/IIS.git', 'April 16, 2013 8:15 AM');

-- --------------------------------------------------------

--
-- Table structure for table `payment_record`
--

CREATE TABLE IF NOT EXISTS `payment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `amount_given` double DEFAULT NULL,
  `amount_to_pay` double DEFAULT NULL,
  `amount_change` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_to_customers` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `payment_record`
--

INSERT INTO `payment_record` (`id`, `customer_id`, `amount_given`, `amount_to_pay`, `amount_change`) VALUES
(59, 85, 1000, 0, 1000),
(60, 84, 190, 0, 190),
(61, 87, 2400, 2400, 0),
(62, 88, 2500, 2400, 100);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `reserve_to_firstname` varchar(50) DEFAULT NULL,
  `reserve_to_lastname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `room_id`, `reserve_to_firstname`, `reserve_to_lastname`) VALUES
(21, 17, 'hgf', 'hfg'),
(22, 18, 'wew', 'mj'),
(23, 15, 'lemuel', 'lucanas');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` int(11) DEFAULT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `floor_number` int(11) DEFAULT NULL,
  `room_price` float DEFAULT NULL,
  `room_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type`, `floor_number`, `room_price`, `room_status`) VALUES
(5, 203, 'single bed room', 2, 750, 'available'),
(7, 205, 'single bed room', 2, 750, 'available'),
(8, 206, 'family size bed room', 3, 1200, 'available'),
(9, 207, 'family size bed room', 3, 1200, 'available'),
(10, 208, 'family size bed room', 3, 1200, 'available'),
(11, 209, 'family size bed room', 3, 1200, 'available'),
(12, 301, 'single bed room', 3, 1200, 'reserved'),
(13, 302, 'family size bed room', 3, 1200, 'available'),
(14, 303, 'family size bed room', 3, 1200, 'available'),
(15, 304, 'family size bed room', 3, 1200, 'available'),
(17, 305, 'single bed room', 3, 650, 'reserved'),
(18, 306, 'family size bed room', 3, 1200, 'reserved'),
(19, 307, 'family size bed room', 3, 1200, 'available'),
(20, 308, 'family size bed room', 3, 1200, 'available'),
(21, 309, 'family size bed room', 3, 1200, 'available'),
(22, 310, 'family size bed room', 3, 1200, 'available'),
(23, 311, 'twin bed room', 3, 950, 'available'),
(24, 312, 'twin bed room', 3, 950, 'available'),
(25, 313, 'twin bed room', 3, 950, 'available'),
(28, 316, 'single bed room', 3, 650, 'available'),
(30, 201, 'single bed room', 3, 650, 'available'),
(31, 318, 'single bed room', 3, 650, 'available'),
(32, 329, 'single bed room', 5, 750, 'available'),
(33, 319, 'single bed room', 3, 0, 'available'),
(34, 320, 'single bed room', 3, 0, 'available'),
(35, 321, 'single bed room', 3, 750, 'available'),
(43, 319, 'single bed room', 534, 750, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `gender`, `age`, `birthday`, `address`, `contact_number`, `username`, `password`, `type`) VALUES
(1, 'Marejean', 'Perpinosa', 'female', 16, 'February 15, 1996', 'Brgy. Balinsasayao Abuyog, Leyte', NULL, 'marejean', '*8907669E0EFF218EC9CA1E201FA3A7444FBF0838', 'ADMINISTRATOR'),
(16, 'Jennilyn', 'Orion', 'Female', 17, 'January 1, 1995', 'Palo', '09071815762', 'jennilyn', '*8907669E0EFF218EC9CA1E201FA3A7444FBF0838', 'ATTENDANT'),
(18, 'Aldrin', 'Gwapoh', 'Male', 17, 'June 5, 1995', 'Ormoc City', '09111234333', 'Tingloyzkie', '*437F1809645E0A92DAB553503D2FE21DB91270FD', 'ATTENDANT');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_to_room`
--
ALTER TABLE `customer_to_room`
  ADD CONSTRAINT `customer_to_room_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_to_room_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_to_room_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_to_room_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `link_to_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_record`
--
ALTER TABLE `payment_record`
  ADD CONSTRAINT `link_to_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `payment_record_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
