-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 02:43 PM
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
  `city` tinytext DEFAULT NULL,
  `hospitals` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`count`, `patid`, `patname`, `docname`, `appdate`, `apptime`, `status`, `city`, `hospitals`) VALUES
(2, '460RIC13', 'Rick', 'john wick', '2019-11-14', '9', 'Rejected', 'London', 'Wockhardt'),
(3, '457SHA41', 'shane', 'john wick', '2019-11-13', '10', 'Rejected', 'London', 'Nuttfield'),
(15, '460RIC13', 'Rick', 'Dominic Turret', '2019-11-13', '14', 'pending', 'Bangalore', 'Hackensack'),
(16, '457SHA41', 'shane', 'shane reaper', '2019-11-13', '12', 'Rejected', 'London', 'Mayo'),
(17, '457SHA41', 'shane', 'Dawson Turret', '2019-11-13', '9', 'pending', 'London', 'Fortis'),
(18, '460RIC13', 'Rick', 'Dominic Turret', '2019-11-14', '10', 'pending', 'Bangalore', 'Hackensack');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `docid` int(11) NOT NULL,
  `docfname` tinytext NOT NULL,
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

INSERT INTO `doctors` (`docid`, `docfname`, `docphone`, `docemail`, `doc_no_of_hospitals`, `doc_areas_of_specialization`, `password`, `hospitals`) VALUES
(1, 'shane reaper', '8556983211', 'shane011@gmail.com', 16, 'Allergists;Anesthesiologists;Cardiologists;Colon and Rectal Surgeons', '$2y$10$xVmQ/z.d6AxOw2EUQud/FuKbKpgmVjUljsVQVjTazfHVEPQJogjh.', 'Fortis,Narayana,Mayo'),
(2, 'john wick', '8556983211', 'john@gmail.com', 13, 'Allergists;Cardiologists;Colon and Rectal Surgeons', '$2y$10$5bdbNIrWAD8YBx/bH61GPOwus5N0Y2KM8WkjWju624nCiBe7MjLgy', 'Wockhardt,Nuttfield,UpperRiverValley'),
(3, 'Dominic Turret', '9876543210', 'dominic@gmail.com', 15, 'Radiologists;Urologists', '$2y$10$7wensa9Ob7uZTwobtKELF.5YIfUqz4FXi1OBuEt7liFnWGGMTb.H.', 'Hackensack,LegacySalmonCreek'),
(4, 'Dawson Turret', '9999999999', 'dawson@gmail.com', 12, 'Cardiologists;Osteopaths;Radiologists;Rheumatologists;Urologists', '$2y$10$szTF6fg/y5Wz9FA1ZKUCNeDEDFczZzcb8e.KqiyIy8ZgPBu1vC5E.', 'Fortis,JohnHopkins,Cleveland');

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
(10, 'shane', 'reaper', 'shane00@gmail.com', '8556983211', '$2y$10$fAzOVD15st7POjIJOo2uD.Fh2c6sdI.D39giNoapkflJ0kW7GYQna', '589SHA71', 'California'),
(11, 'shane', 'reaper', 'shane55@gmail.com', '8556983211', '$2y$10$O70vc2MhThOQwHyC4rmUqeyaUOcQRe0EyLnWYMC7.6XuHn5wU6oTK', '457SHA41', 'London'),
(12, 'Donald', 'Dominic', 'dominic@gmail.com', '9876543210', '$2y$10$EYU7hk1NaZx5dANNyMFvpeivlwyIWxZD4RcHwa0a0hhaTUDUPeBdG', '725DON78', 'Sao Paulo');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(10) NOT NULL,
  `idnumber` tinytext NOT NULL,
  `docname` tinytext NOT NULL,
  `dateupload` tinytext NOT NULL,
  `filename` longtext NOT NULL,
  `timeupload` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `idnumber`, `docname`, `dateupload`, `filename`, `timeupload`) VALUES
(2, '460RIC13', 'john wick', '2019-11-15', 'thumb-1920-53716.jpg', '09:21:35am'),
(4, '460RIC13', 'john wick', '2019-11-15', '2cb6977ba40a14d8da842cd2df5b774f.jpg', '10:20:52am');

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
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `count` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
