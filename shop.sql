-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 09:23 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visablity` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visablity`, `Allow_Comment`, `Allow_Ads`) VALUES
(2, 'secret', 'Secret Category', 3, 1, 1, 1),
(3, 'Toys', 'Toys Category', 2, 0, 1, 1),
(4, 'Phones', '', 1, 1, 1, 0),
(5, 'Videos', '', 2, 0, 0, 0),
(6, 'Aflam', '', 3, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Statues` varchar(255) NOT NULL,
  `Rating` smallint(11) NOT NULL,
  `Cat_Id` int(11) NOT NULL,
  `Member_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_Id`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Statues`, `Rating`, `Cat_Id`, `Member_Id`) VALUES
(17, 'Samsung S9', 'Phone', '$1000', '2018-05-04', 'China', '', '1', 0, 4, 3),
(18, 'Samsung S8', 'fkdekd', '$234', '2018-05-05', 'japan', '', '1', 0, 4, 3),
(19, 'phone', 'ss', '$199', '2018-05-05', 'china', '', '2', 0, 4, 3),
(20, 'Nokia n80', '', '$100', '2018-05-09', 'china', '', '1', 0, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` text NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'admin or member (0 for members)',
  `TrustStatues` int(11) NOT NULL DEFAULT '0' COMMENT 'seller rank',
  `RegStatues` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approval ',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatues`, `RegStatues`, `Date`) VALUES
(3, 'admin', '601f1889667efaebb33b8c12572835da3f027f78', 'weloahmed532@yahoo.com', 'mohamed ahmed mohamed', 1, 0, 1, '2018-04-10'),
(4, 'mohamed', 'c348c1794df04a0473a11234389e74a236833822', 'nono@yahoo.com', 'medo ff', 1, 0, 1, '2018-04-08'),
(5, 'admin5', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mondoelsendbad4@gmail.com', 'medooo', 0, 0, 1, '2018-04-11'),
(12, 'fathy', '601f1889667efaebb33b8c12572835da3f027f78', 'bemine866@yahoo.com', 'fathy saber', 0, 0, 0, '2018-04-13'),
(13, 'admin2', '8cb2237d0679ca88db6464eac60da96345513964', 'jkhjk@ihkh.com', 'hjkhj mnhmhh', 0, 0, 1, '2018-05-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_Id`),
  ADD KEY `member_1` (`Member_Id`),
  ADD KEY `cat_1` (`Cat_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_Id`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_Id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
