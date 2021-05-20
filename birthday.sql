-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 07:45 AM
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
SET @p1=(SELECT name from users where user_id = (SELECT c_id FROM payment WHERE B_ID=v));
SET @p2=(SELECT phone_no from users where user_id = (SELECT c_id FROM payment WHERE B_ID=v));
SET @p4=(SELECT guest_count FROM booking WHERE B_ID=v);
SET @p5=(SELECT game from leisure WHERE e_id=v);
SET @p6=(SELECT photography from leisure WHERE e_id=v);
SET @p7=(SELECT video from leisure WHERE e_id=v);
SET @p8=(SELECT audio from leisure WHERE e_id=v);
SET @p9=(SELECT flavour FROM cakes WHERE cake_id=v);
SET @p10=(SELECT theme FROM cakes WHERE cake_id=v);
SET @p11=(SELECT layers FROM cakes WHERE cake_id=v);
SET @p12=(SELECT v_name from venue WHERE v_id=v);
SET @p13=(SELECT v_theme from venue WHERE v_id=v);
SET @p14=(SELECT main_course from food WHERE f_id=v);
SET @p15=(SELECT snacks from food WHERE f_id=v);
SET @p16=(SELECT desert from food WHERE f_id=v);
SET @p17=(SELECT total_amount FROM payment WHERE B_ID=v);
INSERT INTO result VALUES (@p1,@p2,v,@p4,@p5,@p6,@p7,@p8,@p9,@p10,@p11,@p12,@p13,@p14,@p15,@p16,@p17);
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
(5, 2, 37, 'faizan'),
(7, 4, 80, 'shivani');

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
(2, 'pink champagne', 'chota bheem', 1, 1500),
(4, 'vanilla', 'barbie', 1, 1400);

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
(2, 'Fried rice,Tandoori roti', 'Pizza', 'Ice cream,Shahi tukda', 7400),
(4, 'Butter chicken', 'Milk shakes/Juices/Tea', 'Phirni', 9600);

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
(2, 'Dont want', 'yes', 'yes', 'Dont want', 14000),
(4, 'Dont want', 'yes', 'no', 'Dont want', 5000);

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
(5, 2, 33221, '2021-05-20 06:15:46'),
(7, 4, 38949, '2021-05-20 06:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `name` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `b_id` int(10) NOT NULL,
  `guest_count` int(5) NOT NULL,
  `game` varchar(100) NOT NULL,
  `photography` varchar(100) NOT NULL,
  `video` varchar(100) NOT NULL,
  `audio` varchar(100) NOT NULL,
  `flavour` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `layers` varchar(100) NOT NULL,
  `venue_name` varchar(100) NOT NULL,
  `venue_theme` varchar(100) NOT NULL,
  `main_course` varchar(100) NOT NULL,
  `snacks` varchar(100) NOT NULL,
  `desert` varchar(100) NOT NULL,
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
('shivani', '4343516262', 'face', 'female', 4, 'shivani12'),
('anshu', '6767788900', 'book', 'male', 5, 'anshu12'),
('palwinder', '9960607878', 'puppy', 'female', 6, 'pp12'),
('simran', '6565434321', 'abcd123', 'female', 7, 'soni');

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
(2, 'jasmine', 'carnival', 17999, '2021-06-27', '12:00:00'),
(4, 'jasmine', 'winter', 24999, '2021-06-27', '01:00:00');

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
  MODIFY `B_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(4) NOT NULL AUTO_INCREMENT;

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
