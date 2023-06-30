-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 07:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatwithfriends`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitytb`
--

CREATE TABLE `activitytb` (
  `aid` int(11) NOT NULL,
  `aname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activitytb`
--

INSERT INTO `activitytb` (`aid`, `aname`) VALUES
(1, 'Gaming'),
(2, 'Singing'),
(3, 'Dancing');

-- --------------------------------------------------------

--
-- Table structure for table `chattb`
--

CREATE TABLE `chattb` (
  `chatid` int(11) NOT NULL,
  `sdid` int(11) NOT NULL,
  `rcid` int(11) NOT NULL,
  `msgtext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chattb`
--

INSERT INTO `chattb` (`chatid`, `sdid`, `rcid`, `msgtext`) VALUES
(1, 11015, 11016, 'hey'),
(2, 11015, 11016, 'hello'),
(3, 11015, 11016, 'lol'),
(4, 11015, 11016, 'new'),
(5, 11015, 11016, 'nubn'),
(6, 11015, 11016, 'try'),
(7, 11015, 11016, 'lol it works'),
(8, 11015, 11016, 'nowww'),
(9, 11015, 11016, 'try again'),
(10, 11015, 11016, 'wow'),
(11, 11015, 11016, 'new'),
(12, 11015, 11016, 'attack');

-- --------------------------------------------------------

--
-- Table structure for table `friendstb`
--

CREATE TABLE `friendstb` (
  `fno` int(11) NOT NULL,
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useracttb`
--

CREATE TABLE `useracttb` (
  `uaid` int(11) NOT NULL,
  `aid1` int(11) NOT NULL,
  `aid2` int(11) NOT NULL,
  `aid3` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useracttb`
--

INSERT INTO `useracttb` (`uaid`, `aid1`, `aid2`, `aid3`, `uid`) VALUES
(1, 1, 2, 3, 11015),
(2, 1, 2, 3, 11016),
(25, 1, 2, 3, 11039);

-- --------------------------------------------------------

--
-- Table structure for table `usertb`
--

CREATE TABLE `usertb` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `uemail` varchar(255) NOT NULL,
  `uimage` text NOT NULL,
  `utype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertb`
--

INSERT INTO `usertb` (`uid`, `uname`, `upass`, `uemail`, `uimage`, `utype`) VALUES
(11011, 'admin', 'Admin@99', 'alvfcoc@gmail.com', '', ''),
(11015, 'arin', 'Dhimar@99', 'arindhimar116@gmail.com', 'images/arin.jpg', 'user'),
(11016, 'vasu', 'Dhimar@99', 'vasubhuva001@gmail.com', 'images/vasu.jpg', 'user'),
(11039, 'try', 'Try@99999', 'try@gmail.com', 'images/649f0904b6478.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitytb`
--
ALTER TABLE `activitytb`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `chattb`
--
ALTER TABLE `chattb`
  ADD PRIMARY KEY (`chatid`),
  ADD KEY `sdid` (`sdid`),
  ADD KEY `rcid` (`rcid`);

--
-- Indexes for table `friendstb`
--
ALTER TABLE `friendstb`
  ADD PRIMARY KEY (`fno`),
  ADD KEY `uid1` (`uid1`),
  ADD KEY `uid2` (`uid2`);

--
-- Indexes for table `useracttb`
--
ALTER TABLE `useracttb`
  ADD PRIMARY KEY (`uaid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid1` (`aid1`),
  ADD KEY `aid2` (`aid2`),
  ADD KEY `aid3` (`aid3`);

--
-- Indexes for table `usertb`
--
ALTER TABLE `usertb`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitytb`
--
ALTER TABLE `activitytb`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chattb`
--
ALTER TABLE `chattb`
  MODIFY `chatid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `friendstb`
--
ALTER TABLE `friendstb`
  MODIFY `fno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useracttb`
--
ALTER TABLE `useracttb`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `usertb`
--
ALTER TABLE `usertb`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11040;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chattb`
--
ALTER TABLE `chattb`
  ADD CONSTRAINT `chattb_ibfk_1` FOREIGN KEY (`sdid`) REFERENCES `usertb` (`uid`),
  ADD CONSTRAINT `chattb_ibfk_2` FOREIGN KEY (`rcid`) REFERENCES `usertb` (`uid`);

--
-- Constraints for table `friendstb`
--
ALTER TABLE `friendstb`
  ADD CONSTRAINT `friendstb_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `usertb` (`uid`),
  ADD CONSTRAINT `friendstb_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `usertb` (`uid`);

--
-- Constraints for table `useracttb`
--
ALTER TABLE `useracttb`
  ADD CONSTRAINT `useracttb_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `usertb` (`uid`),
  ADD CONSTRAINT `useracttb_ibfk_2` FOREIGN KEY (`aid1`) REFERENCES `activitytb` (`aid`),
  ADD CONSTRAINT `useracttb_ibfk_3` FOREIGN KEY (`aid2`) REFERENCES `activitytb` (`aid`),
  ADD CONSTRAINT `useracttb_ibfk_4` FOREIGN KEY (`aid3`) REFERENCES `activitytb` (`aid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
