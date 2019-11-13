-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 03:16 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `count` int(10) NOT NULL,
  `patid` varchar(20) NOT NULL,
  `patname` tinytext NOT NULL,
  `docname` tinytext NOT NULL,
  `appdate` varchar(20) NOT NULL,
  `apptime` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `city` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`count`, `patid`, `patname`, `docname`, `appdate`, `apptime`, `status`, `city`) VALUES
(2, '460RIC13', 'Rick', 'john wick', '2019-11-13', '9', 'pending', 'London'),
(3, '457SHA41', 'shane', 'john wick', '2019-11-13', '10', 'pending', 'London'),
(15, '460RIC13', 'Rick', 'Dominic Turret', '2019-11-13', '14', 'pending', 'Bangalore');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `docid` int(11) NOT NULL,
  `docfname` tinytext NOT NULL,
  `doclname` tinytext NOT NULL,
  `docphone` varchar(12) DEFAULT NULL,
  `docemail` tinytext NOT NULL,
  `doc_no_of_hospitals` smallint(6) NOT NULL,
  `doc_areas_of_specialization` longtext NOT NULL,
  `password` longtext NOT NULL,
  `hospitals` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`docid`, `docfname`, `doclname`, `docphone`, `docemail`, `doc_no_of_hospitals`, `doc_areas_of_specialization`, `password`, `hospitals`) VALUES
(1, 'shane reaper', 'reaper', '8556983211', 'shane011@gmail.com', 16, 'Allergists;Anesthesiologists;Cardiologists;Colon and Rectal Surgeons', '$2y$10$xVmQ/z.d6AxOw2EUQud/FuKbKpgmVjUljsVQVjTazfHVEPQJogjh.', 'Fortis,Narayana,Mayo'),
(2, 'john wick', 'wick', '8556983211', 'john@gmail.com', 13, 'Allergists;Cardiologists;Colon and Rectal Surgeons', '$2y$10$5bdbNIrWAD8YBx/bH61GPOwus5N0Y2KM8WkjWju624nCiBe7MjLgy', 'Wockhardt,Nuttfield,UpperRiverValley'),
(3, 'Dominic Turret', 'Turret', '9876543210', 'dominic@gmail.com', 15, 'Radiologists;Urologists', '$2y$10$7wensa9Ob7uZTwobtKELF.5YIfUqz4FXi1OBuEt7liFnWGGMTb.H.', 'Hackensack,LegacySalmonCreek,');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patid` int(12) NOT NULL,
  `patfname` tinytext NOT NULL,
  `patlname` tinytext NOT NULL,
  `patemail` tinytext NOT NULL,
  `patphone` varchar(12) NOT NULL,
  `password` tinytext NOT NULL,
  `patidlogin` tinytext DEFAULT NULL,
  `city` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patid`, `patfname`, `patlname`, `patemail`, `patphone`, `password`, `patidlogin`, `city`) VALUES
(1, 'Rick', 'reaper', 'shane011@gmail.com', '8556983211', '$2y$10$moEMhZcxXI2pXaz1zCkSV./EXp/NA4UgEqZzWOQXUwBBWsTPCLyrm', '460RIC13', 'Bangalore'),
(2, 'shane', 'reaper', 'shane0101@gmail.com', '8556983211', '$2y$10$bTe9y/E4z.ulD5oCm.jqreP6PGT/Doh1bQtjbqxpc53mgSYwhxOsm', '459SHA36', 'Bangalore'),
(4, 'Donald', 'reaper', 'rupertreaper@gmail.com', '9999999999', '$2y$10$zAQOa7pI4Qr0qsoTWyyPPOKml6gxfi9yVwv.UGzoNRYSDnqiPsD/q', '561DON71', 'Bombay'),
(5, 'Donald', 'Duck', 'raert@gmail.com', '1234567891', '$2y$10$lSZ.rSCXktPpsAKpVVJtI.hCFy7h7CsRKb8.zNigNfkDxXUsNTCSu', '723DON40', 'New York'),
(10, 'shane', 'reaper', 'shane00@gmail.com', '8556983211', '$2y$10$fAzOVD15st7POjIJOo2uD.Fh2c6sdI.D39giNoapkflJ0kW7GYQna', '589SHA71', 'California'),
(11, 'shane', 'reaper', 'shane55@gmail.com', '8556983211', '$2y$10$O70vc2MhThOQwHyC4rmUqeyaUOcQRe0EyLnWYMC7.6XuHn5wU6oTK', '457SHA41', 'London');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `pid` int(11) NOT NULL,
  `idnumber` tinytext NOT NULL,
  `timeupload` varchar(20) NOT NULL,
  `dateupload` varchar(20) NOT NULL,
  `filename` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`pid`, `idnumber`, `timeupload`, `dateupload`, `filename`) VALUES
(1, '460RIC13', '05:21:30pm', '2019-11-08', '2cb6977ba40a14d8da842cd2df5b774f.jpg'),
(3, '460RIC13', '05:29:38pm', '2019-11-08', 'gwRtRhF-black-wallpaper-1080p.jpg'),
(16, '457SHA41', '11:10:18am', '2019-11-10', 'yMDtxk.jpg'),
(18, '457SHA41', '11:22:37am', '2019-11-10', 'gwRtRhF-black-wallpaper-1080p.jpg'),
(23, '457SHA41', '04:35:55pm', '2019-11-12', 'thumb-1920-53716.jpg'),
(24, '457SHA41', '09:10:39pm', '2019-11-12', 'tank-wallpapers-11.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`count`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patid`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `count` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
