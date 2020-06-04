-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 10:02 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

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
  `ID` smallint(6) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT '0',
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(2, 'Toys', 'This Is Toys For kids', 1, 1, 1, 1),
(4, 'Playstation 4', 'Playstation 4 Games', 2, 1, 1, 1),
(5, 'Playstation 3', 'Playstation Games', 4, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Cat_ID`, `Member_ID`) VALUES
(1, 'Resident Evil', 'Welcome to the official site of the Resident Evil videogame franchise.', '30$', '2020-02-16', 'Japanese', '', '4', 0, 0, 0),
(2, 'pubg', 'PLAYERUNKNOWN\'S BATTLEGROUNDS and PUBG are registered trademarks, trademarks or service marks of PUBG CORPORATION.', '40$', '2020-02-16', 'USA', '', '1', 0, 0, 0),
(3, 'Heavy Rain', 'Amazing PS3 Game', '100$', '2020-02-16', 'Japaneis', '', '1', 0, 5, 2),
(4, 'Middle Earth', 'PS4 Game', '300$', '2020-02-16', 'USA', '', '3', 0, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To Ideintify User',
  `Username` varchar(255) NOT NULL COMMENT 'Username To Login',
  `Password` varchar(255) NOT NULL COMMENT 'Password To Login',
  `Email` varchar(255) NOT NULL COMMENT 'Email To Login',
  `FullName` varchar(255) NOT NULL COMMENT 'Fullname To Login',
  `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'Ideintify User Group',
  `TrustStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'Seller Rank',
  `RegStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approvel',
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `TrustStatus`, `RegStatus`, `Date`) VALUES
(1, 'ahmad', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a.com', 'Programmer Ahmad', 1, 0, 1, '0000-00-00'),
(2, 'Abeer', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'b@b.com', 'Abeer Love', 0, 0, 1, '2020-01-07'),
(3, 'Dodo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'd@d.com', 'Dodo Dodo', 0, 0, 1, '2020-01-20'),
(8, 'Soso', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 's@s.com', 'Soso Soso', 0, 0, 1, '2020-02-04'),
(10, 'Rbab ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'r@r.com', 'Rbab Raba', 0, 0, 1, '2020-02-04'),
(12, 'rasha', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'rr@rr.com', 'Rasha Love', 0, 0, 0, '2020-02-04'),
(13, 'Ayaa', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'aa@aa.com', 'Aya Love', 0, 0, 1, '2020-02-04'),
(23, 'Lolo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'l@l.com', 'Lolo Lolo', 0, 0, 1, '2020-01-04');

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
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Ideintify User', AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
