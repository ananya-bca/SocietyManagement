-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 19, 2024 at 02:44 PM
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
-- Database: `society_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(4) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `mail`, `pwd`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `member_name` char(50) NOT NULL,
  `wing` varchar(10) NOT NULL,
  `flat_number` int(4) NOT NULL,
  `bill_type` varchar(30) NOT NULL,
  `charge` float NOT NULL,
  `last_date` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `member_id`, `member_name`, `wing`, `flat_number`, `bill_type`, `charge`, `last_date`, `status`) VALUES
(1, 1, 'Ram', 'A', 2, 'Maintenance', 500, '30-12-2023', 'paid'),
(2, 3, 'Vivan', 'A', 2, 'Parking', 500, '', 'paid'),
(5, 3, 'Vivan', 'A', 2, 'Management', 1000, '', 'paid'),
(6, 3, 'Vivan', 'A', 2, 'Management', 1000, '', 'Paid'),
(8, 1, 'Ram', 'A', 1, 'Parking', 500, '', 'Paid'),
(11, 3, 'Vivan', 'A', 2, 'Maintenance', 500, '', 'pending'),
(13, 30, 'Divyanshi', 'A', 55, 'New Year celebration', 200, '2024-01-02', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complain_id` int(10) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_name` char(50) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `complain_date` date NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `member_id`, `member_name`, `subject`, `complain_date`, `message`, `status`) VALUES
(1, 1, 'Ram', 'Water supply', '2023-12-07', 'Water supply is not proper.', 'unsolved'),
(2, 1, 'Ram', 'Water supply', '2023-12-07', 'Water supply is not proper.', 'solved'),
(3, 1, 'Ram', 'Water supply', '2023-12-07', 'Water supply is not proper.', 'solved'),
(5, 1, 'Ram', 'Parkin', '2023-12-07', 'Car parking facility', 'solved'),
(10, 30, 'Divyanshi', 'Electricity', '2024-01-01', 'Electricity is not provided.', 'solved'),
(12, 1, 'Ram', 'Water supply', '2024-01-16', 'water supply bis not proper', 'solved');

-- --------------------------------------------------------

--
-- Table structure for table `complain_reply`
--

CREATE TABLE `comp_reply` (
  `complain_id` int(10) NOT NULL,
  `member_id` int(10) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `reply_msg` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complain_reply`
--

INSERT INTO `comp_reply` (`complain_id`, `member_id`, `subject`, `reply_msg`) VALUES
(1, 1, 'Water supply', 'This will be solve today'),
(9, 1, 'Water supply', 'This will be solved fastly.'),
(9, 1, 'Water supply', 'ok'),
(9, 1, 'Water supply', 'ok'),
(9, 1, 'Water supply', 'ok'),
(3, 1, 'Water supply', 'ok, this will be solve as soon as possible.'),
(10, 30, 'Electricity', 'ok. this will be solve today.'),
(2, 1, 'Water supply', 'lklf lkdflakdf lk jldkfjal flkdf'),

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(10) NOT NULL,
  `name` char(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` int(10) NOT NULL,
  `message` char(200) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `contact`, `message`, `status`) VALUES
(1, 'ananya', 'www@gmail.com', 1234567890, 'Hello, I want to buy a flat. What is the process?', 'Contacted'),
(2, 'ananya', 'www@gmail.com', 34556, 'helloo', 'Contacted'),
(3, 'Divyanshi Kansara', 'div@gmail.com', 123987456, 'I want to contact with you, because I will buy 2bhk plot.', 'Contacted'),
(4, 'shiwani', 'sh@gmail.com', 123644, 'How can i become your society member', 'Contacted'),
(6, 'shiwani', 'sh@gmail.com', 123644, 'I want to join your society as a watchman', 'Contacted');

-- --------------------------------------------------------

--
-- Table structure for table `flat`
--

CREATE TABLE `flat` (
  `flat_id` int(11) NOT NULL,
  `flat_wing` varchar(10) NOT NULL,
  `flat_number` int(4) NOT NULL,
  `flat_floor` int(4) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`flat_id`, `flat_wing`, `flat_number`, `flat_floor`, `status`) VALUES
(20, 'A', 1, 1, 'Booked'),
(28, 'A', 2, 1, 'Booked'),
(31, 'A', 5, 2, 'Booked'),
(36, 'B', 1, 1, 'Booked'),
(38, 'A', 12, 7, 'Available'),
(39, 'A', 13, 7, 'Booked'),
(40, 'C', 1, 1, 'Booked'),
(41, 'B', 6, 4, 'Booked'),
(43, 'C', 3, 2, 'Booked'),
(45, 'A', 7, 3, 'Available'),
(48, 'C', 10, 7, 'Available'),
(49, 'A', 55, 7, 'Booked'),
(50, 'B', 4, 2, 'Booked'),
(51, 'A', 20, 13, 'Available'),
(52, 'C', 30, 16, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(10) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` int(10) NOT NULL,
  `wing` varchar(10) NOT NULL,
  `flat_number` int(4) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_name`, `email`, `contact`, `wing`, `flat_number`, `floor_number`, `date`) VALUES
(1, 'Ram', 'ram@gmail.com', 12345678, 'A', 1, 1, '2023-11-11'),
(3, 'Vivan', 'viv@gmail.com', 2147483647, 'A', 2, 1, '2023-12-07'),
(6, 'Sakhi Wagle', 'sakh@gmail.com', 25479651, 'A', 3, 2, '0000-00-00'),
(15, 'Ananya', 'ananya@gmail.com', 1236958047, 'C', 1, 1, '2023-12-30'),
(16, 'Bhavesh', 'bhav@gmail.com', 123456789, 'C', 3, 2, '2023-12-30'),
(30, 'Divyanshi', 'divya@gmail.com', 1456329885, 'A', 55, 7, '2024-01-01'),
(31, 'Ananya', 'tyb@gmail.com', 2147483647, 'B', 4, 2, '2024-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `n_id` int(10) NOT NULL,
  `n_name` char(50) NOT NULL,
  `n_sub` varchar(40) NOT NULL,
  `notice_type` char(20) NOT NULL,
  `member_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`n_id`, `n_name`, `n_sub`, `notice_type`, `member_id`, `date`, `message`) VALUES
(1, 'Maintenance', 'Light issue', '', 0, '2023-11-17', 'There will be light issue from 2am to 6am in whole society.'),
(3, 'Maintenance', 'Light issue', '', 0, '2023-12-05', 'adjflic  adielkd'),
(7, 'Meeting', 'Christimus Celebration', 'all_members', 0, '2023-12-26', 'There will be meeting for christimus celebration in society club.'),
(8, 'Parking', 'not proper parking', 'Particular_memb', 3, '2023-12-23', 'You are not parking your vechile at your given area. '),
(9, 'Parking', 'not proper parking', 'Particular_member', 1, '2023-12-23', 'ldf l lkdfjldskf ijd jlsj lfkd ds'),
(17, 'Maintenance', 'Light issue', 'all_members', 0, '2023-12-26', 'There should be light issue in society.'),
(18, 'Meeting', 'Meeting', 'all_members', 0, '2024-01-01', 'Society meeting is today. please come on time.'),
(19, 'Maintenance', 'j jhjhmnb', 'all_members', 0, '2024-01-16', 'hgfxngxnd nhg ghn hgf hg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `member_id` int(11) NOT NULL,
  `member_name` char(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `contact` int(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `wing` char(2) NOT NULL,
  `flat_num` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`member_id`, `member_name`, `mail`, `contact`, `pwd`, `wing`, `flat_num`) VALUES
(1, '0', '0', 0, '0', '0', 1),
(3, 'Ananya kansara', 'ananya@gmail.com', 0, 'ananya123', 'A', 3),
(4, 'Ram', 'ram@gmail.com', 1234562122, 'Ram&123', 'A', 1),
(5, 'Vivan', 'viv@gmail.com', 123456987, 'viv123viv', 'A', 2),
(6, 'Sak', 'sakh@gmail.com', 25479651, 'sakh', 'A', 3),
(7, 'john saikh', 'john@gmail.com', 1236540987, 'johnjohn', 'A', 1),
(8, 'Anvi', 'anvi@gmail.com', 1020304050, 'anvita', 'A', 56),
(9, 'MyName', 'my@gmail.com', 1203698547, 'My&1234', 'B', 10),
(11, 'MyName', 'my@gmail.com', 1203698547, 'My&1234', 'B', 10),
(12, 'Neela', 'neel@gmail.com', 2147483647, 'Neel@123', 'C', 23),
(13, 'MyName', 'my@gmail.com', 1234567890, 'My&1234', 'A', 23),
(14, 'Bhavesh', 'Bhav@gmail.com', 1479632580, 'Bhav$123', 'B', 2),
(15, 'Ananya', 'ananya@gmail.com', 1456329807, 'Ananya&123', 'A', 9),
(16, 'Ananya', 'ananya@gmail.com', 1234567890, 'Ananya&123', 'C', 1),
(17, 'Bhavesh', 'bhav@gmail.com', 123456789, 'Bhav&123', 'C', 3), 
(18, 'Divyanshi', 'divya@gmail.com', 2147483647, 'Divi&&123', 'A', 55),
(19, 'Ananya', 'tyb@gmail.com', 1234567890, 'Kirti&123', 'B', 4);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `v_id` int(10) NOT NULL,
  `v_name` char(50) NOT NULL,
  `v_contact` int(10) NOT NULL,
  `v_wing` varchar(10) NOT NULL,
  `v_flat` int(4) NOT NULL,
  `v_floor` int(4) NOT NULL,
  `v_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`v_id`, `v_name`, `v_contact`, `v_wing`, `v_flat`, `v_floor`, `v_date`) VALUES
(1, 'john', 2147483647, 'A', 2, 1, '2023-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `wing`
--

CREATE TABLE `wing` (
  `wing_id` int(4) NOT NULL,
  `wing` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wing`
--

INSERT INTO `wing` (`wing_id`, `wing`) VALUES
(1, 'A'),
(3, 'B'),
(6, 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complain_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flat`
--
ALTER TABLE `flat`
  ADD PRIMARY KEY (`flat_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `wing`
--
ALTER TABLE `wing`
  ADD PRIMARY KEY (`wing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complain_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `flat`
--
ALTER TABLE `flat`
  MODIFY `flat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `n_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `v_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wing`
--
ALTER TABLE `wing`
  MODIFY `wing_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
