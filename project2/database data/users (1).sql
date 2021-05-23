-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 04:46 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`item`, `user`, `price`, `quantity`) VALUES
('sandwich', 'gowtham', 1440, 12),
('burger', 'gowtham', 1560, 12),
('sandwich', 'gowtham', 480, 4),
('burger', 'gowtham', 520, 2),
('sandwich', 'gowtham', 480, 4),
('burger', 'gowtham', 520, 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `quant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item`, `price`, `quant`) VALUES
('burger', 130, 12),
('donut', 50, 7),
('sandwich', 120, 15),
('shake', 70, 15);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `user` varchar(100) NOT NULL,
  `items` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`user`, `items`, `quantity`, `price`, `date`, `time`) VALUES
('sriKarthik', ' sandwich,burger,donut,shake', ' 1✕sandwich,1✕burger,1✕donut,1✕shake', 370, '2021-04-25', '06:20:00'),
('sriKarthik', ' burger,donutshake', ' 2✕burger,2✕donut1✕shake', 430, '2021-04-25', '06:21:00'),
('sriKarthik', ' sandwich,donut', ' 1✕sandwich,1✕donut', 170, '2021-04-25', '06:23:00'),
('sriKarthik', ' burger', ' 2✕burger', 260, '2021-04-26', '11:09:00'),
('sriKarthik', ' sandwich', ' 4✕sandwich', 480, '2021-04-26', '11:10:00'),
('sriKarthik', ' shake', ' 5✕shake', 350, '2021-04-26', '11:10:00'),
('sriKarthik', ' sandwich', ' 2✕sandwich', 240, '2021-04-26', '11:23:00'),
('sriKarthik', ' sandwich', ' 1✕sandwich', 120, '2021-04-26', '11:29:00'),
('sriKarthik', ' burgershake', ' 3✕burger2✕shake', 530, '2021-04-26', '11:30:00'),
('sriKarthik', ' shake', ' 1✕shake', 70, '2021-04-26', '11:42:00'),
('sriKarthik', ' donut', ' 1✕donut', 50, '2021-04-26', '11:46:00'),
('sriKarthik', ' donut', ' 1✕donut', 50, '2021-04-27', '12:48:00'),
('sriKarthik', ' sandwich,shake', ' 1✕sandwich,1✕shake', 190, '2021-04-27', '12:57:00'),
('sriKarthik', ' burger', ' 1✕burger', 130, '2021-04-27', '01:00:00'),
('sriKarthik', ' sandwich,burger', ' 1✕sandwich,2✕burger', 380, '2021-05-02', '05:48:00'),
('sriKarthik', ' donutshake', ' 1✕donut1✕shake', 120, '2021-05-02', '10:09:00'),
('sriKarthik', ' burgershake', ' 1✕burger1✕shake', 200, '2021-05-02', '11:28:00'),
('sriKarthik', ' sandwich,shake', ' 2✕sandwich,1✕shake', 310, '2021-05-04', '11:10:00'),
('sriKarthik', ' sandwich,shake', ' 2✕sandwich,1✕shake', 310, '2021-05-06', '10:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users`, `phone`, `email`, `password`) VALUES
('dummy', '9898989898', 'dummy@gmail.com', '32cadc6a0761d421a0e1865433adee95'),
('san', '9999999999', 'sanj@gmail.com', '59f7f2be38afe3cc2c18ecb62b23614d'),
('sriKarthik', '9441238305', '121810307062@gitam.in', '822aa1249a43fd35bb71b30bad7da3fe'),
('usha', '9491360247', 'ushadevi831@gmail.com', '5152aab83081b08d75223a2e4d8bafb0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item`),
  ADD KEY `price` (`price`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD KEY `fk` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk` FOREIGN KEY (`user`) REFERENCES `users` (`users`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
