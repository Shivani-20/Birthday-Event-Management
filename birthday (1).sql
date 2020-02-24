-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2018 at 08:08 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `birthday`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ClearHistory` ()  BEGIN
delete from booking where B_ID in(select v_id from venue where DATE=CURRENT_DATE);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `discount1` ()  BEGIN
DECLARE discount INT DEFAULT 5;
update payment set total_amount=total_amount-(total_amount*(discount/100));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `discount2` ()  BEGIN
DECLARE discount INT DEFAULT 10;
update payment set total_amount=total_amount-(total_amount*(discount/100));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `discount3` ()  BEGIN
DECLARE discount INT DEFAULT 15;
update payment set total_amount=total_amount-(total_amount*(discount/100));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getData` (IN `date1` DATE)  BEGIN
DECLARE done INT DEFAULT FALSE;
DECLARE v INT;
DECLARE p CURSOR FOR SELECT v_id from venue WHERE date=date1;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=TRUE;
OPEN p;
read_loop: LOOP
Fetch p into v;
IF done THEN
LEAVE read_loop;
END IF;
SET @p2=(SELECT c_id FROM payment WHERE B_ID=v);
SET @p3=(SELECT total_amount FROM payment WHERE B_ID=v);
INSERT INTO result VALUES (@p2,v,@p3);
END LOOP;
CLOSE p;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `C_ID` int(11) NOT NULL,
  `B_ID` int(10) NOT NULL,
  `GUEST_COUNT` int(5) NOT NULL,
  `CELEBRANT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`C_ID`, `B_ID`, `GUEST_COUNT`, `CELEBRANT`) VALUES
(5, 59, 20, 'ankita'),
(5, 60, 50, 'anshu'),
(6, 61, 75, 'sangamesh');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `noGuest` AFTER INSERT ON `booking` FOR EACH ROW BEGIN
SET @P1=(SELECT GUEST_COUNT FROM booking WHERE B_ID=(SELECT MAX(B_ID) FROM booking));
if @P1 < 10 then
SIGNAL SQLSTATE '45000' 
SET message_text = "guest count>10" ;
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `cake_id` int(10) NOT NULL,
  `flavour` varchar(20) NOT NULL,
  `theme` varchar(30) NOT NULL,
  `layers` int(1) NOT NULL,
  `amount` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`cake_id`, `flavour`, `theme`, `layers`, `amount`) VALUES
(59, 'vanilla', 'castle', 1, 1420),
(60, 'chocolate', 'jungle', 5, 3435),
(61, 'red velvet', 'mickey', 4, 2800);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `NAME` varchar(30) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `SUBJECT` varchar(100) NOT NULL,
  `contact_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`NAME`, `EMAIL`, `SUBJECT`, `contact_id`) VALUES
('ifrah', 'ifrah@gmail.com', 'cake was not', 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `f_id` int(11) NOT NULL,
  `main_course` varchar(300) NOT NULL,
  `snacks` varchar(300) NOT NULL,
  `desert` varchar(300) NOT NULL,
  `amount` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`f_id`, `main_course`, `snacks`, `desert`, `amount`) VALUES
(59, 'Butter chicken,Tandoori roti', 'Samosa', 'Ice cream', 3600),
(60, 'Fried rice,Chole bhature,Daal tadka', 'Chowmein,Pizza', 'Phirni,Jalebi/Imarti', 15000),
(61, 'Butter chicken,Fried rice,Naan,Dum aloo,Daal tadka', 'Pav bhaji', 'Khoya Kulfi', 27000);

-- --------------------------------------------------------

--
-- Table structure for table `leisure`
--

CREATE TABLE `leisure` (
  `e_id` int(10) NOT NULL,
  `game` varchar(30) NOT NULL,
  `photography` varchar(3) NOT NULL,
  `video` varchar(3) NOT NULL,
  `audio` varchar(10) NOT NULL,
  `amount` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leisure`
--

INSERT INTO `leisure` (`e_id`, `game`, `photography`, `video`, `audio`, `amount`) VALUES
(59, 'Dont want', 'no', 'yes', 'dj', 19000),
(60, 'Ring game', 'yes', 'no', 'Dont want', 7000),
(61, 'Mini golf game', 'no', 'yes', 'Sound syst', 13000);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `admin_name` varchar(30) NOT NULL,
  `admin_id` int(3) NOT NULL,
  `admin_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`admin_name`, `admin_id`, `admin_password`) VALUES
('faizan', 35, 'oscar'),
('shivani', 76, 'comb');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `c_id` int(11) NOT NULL,
  `b_id` int(10) NOT NULL,
  `total_amount` int(8) NOT NULL,
  `date_of_booking` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`c_id`, `b_id`, `total_amount`, `date_of_booking`) VALUES
(5, 59, 37379, '2018-12-01 12:29:43'),
(5, 60, 38418, '2018-12-01 12:31:01'),
(6, 61, 55619, '2018-12-01 12:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `c_id` int(11) NOT NULL,
  `b_id` int(10) NOT NULL,
  `total_amount` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `NAME` varchar(30) NOT NULL,
  `PHONE_NO` varchar(11) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `GENDER` varchar(6) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `LOGIN_ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NAME`, `PHONE_NO`, `PASSWORD`, `GENDER`, `USER_ID`, `LOGIN_ID`) VALUES
('shivani', '7795805163', 'hh', 'female', 5, 'ss1'),
('faizan', '8767564523', 'ff', 'male', 6, 'ff9'),
('priya', '8767667998', 'ugh', 'female', 7, '76DS');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `v_id` int(10) NOT NULL,
  `v_name` varchar(20) NOT NULL,
  `v_theme` varchar(30) NOT NULL,
  `amount` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`v_id`, `v_name`, `v_theme`, `amount`, `date`, `time`) VALUES
(59, 'silver oak', 'carnival', 21999, '2018-12-25', '18:30:00'),
(60, 'empire yolee grande', 'super hero', 19499, '2018-12-26', '15:00:00'),
(61, 'gravity', 'sports', 18999, '2018-12-26', '20:30:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`B_ID`),
  ADD KEY `C_ID_3` (`C_ID`);

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD UNIQUE KEY `cake_id` (`cake_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD UNIQUE KEY `f_id` (`f_id`);

--
-- Indexes for table `leisure`
--
ALTER TABLE `leisure`
  ADD UNIQUE KEY `e_id` (`e_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD UNIQUE KEY `b_id` (`b_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`),
  ADD UNIQUE KEY `LOGIN_ID` (`LOGIN_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD UNIQUE KEY `v_id` (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `B_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `users` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cakes`
--
ALTER TABLE `cakes`
  ADD CONSTRAINT `cakes_ibfk_1` FOREIGN KEY (`cake_id`) REFERENCES `booking` (`B_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `booking` (`B_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leisure`
--
ALTER TABLE `leisure`
  ADD CONSTRAINT `leisure_ibfk_1` FOREIGN KEY (`e_id`) REFERENCES `booking` (`B_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `users` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `booking` (`B_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `booking` (`B_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
