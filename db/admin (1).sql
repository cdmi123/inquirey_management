-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 12:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inquery_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL COMMENT '1=admin,2=faculty,3=receptionist,4=branch manager,5=hod,6=college faculty,7=HR,8=Tele Caller',
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `branch_id` int(11) DEFAULT 1,
  `dept_id` int(11) NOT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL,
  `salary` int(11) NOT NULL DEFAULT 0,
  `pro_tax` int(11) NOT NULL DEFAULT 0,
  `payment_mode` varchar(20) NOT NULL DEFAULT 'CASH',
  `department` varchar(20) NOT NULL DEFAULT 'MULTIMEDIA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `old_id`, `name`, `email`, `mobile`, `status`, `role`, `password`, `image`, `branch_id`, `dept_id`, `fullname`, `designation`, `salary`, `pro_tax`, `payment_mode`, `department`) VALUES
(1, 1, 'Paresh Chauhan', 'paresh@cdmi.in', 9879233407, '1', '1', 'dc4cb4fbc4529ac1b50ecd85e78f2757', 'user.png', 1, 24, 'CHAUHAN PARESHBHAI PRAVINBHAI', NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(2, 2, 'Keyur Varsadiya', 'keyur@cdmi.in', 7383834030, '1', '1', '6320a358d1000c8227da4e3ca5c98eda', 'user.png', 1, 0, 'VARSADIYA KEYUR DEVSHIBHAI', NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(3, 3, 'Rajni Shingala', 'rajni@cdmi.in', 9427280713, '1', '1', '334b402e44e3745cd88226694d9c442d', 'user.png', 1, 24, 'SHINGALA RAJNIKANT HARIBHAI', NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(4, 4, 'Shailesh Oslaniya', 'shailesh.oslaniya@gmail.com', 9377097697, '1', '1', 'e6a042432655a037d091a673efa46731', 'user.png', 1, 0, 'OSLANIYA SHAILESH BHAGVANBHAI', NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(5, 5, 'Chirag Mangukiya', 'chirag@gmail.com', 9737439827, '1', '3', '12e72924ac005b88a89af25a560dfeba', 'user.png', 1, 0, 'MANGUKIYA CHIRAG BHUPATBHAI', 'HEAD OF DESIGN DEPARMENT', 60000, 200, 'BANK-TRANSFER', 'MULTIMEDIA'),
(6, 6, 'Ridham Kevadiya', 'ridham24@gmail.com', 9714173719, '1', '3', '24a1f8358e5d8e5cd9816e4a0cc878af', 'user.png', 1, 24, 'KEVADIYA RIDHAM GHANSHYAMBHAI', 'HEAD OF PROGRAMMING DEPARTMENT', 60000, 200, 'BANK-TRANSFER', 'MULTIMEDIA'),
(7, 7, 'Drashti Suvagiya', 'dishusuvagiya5@gmail.com', 9909251324, '1', '3', '3892ae22807c9974ca61c9e023794b77', 'DISHU.jpeg', 1, 0, 'SUHAGIYA DRASHTI DINESHBHAI', 'FRONT DESK MANAGER', 20000, 0, 'CASH', 'MULTIMEDIA'),
(8, 8, 'Ekta Balar', 'balar@gmail.com', 6351645574, '1', '7', '88b5e44b7fcfb54de05a0db87fd7b6e6', 'user.png', 1, 0, 'BALAR EKTA NILESHBHAI', 'COUNSELOR CUM HR MANAGER', 14000, 0, 'CASH', 'MULTIMEDIA'),
(9, 11, 'Najim Khatik', 'shaikhnhk@gmail.com', 8999445693, '1', '2', 'd61bf2f4c8c7ff266a342c5fa8679884', 'user.png', 1, 0, 'NAJIM HAROON KHATIK', 'SENIOR GRAPHIC & ANIMATION FACULTY', 40000, 200, 'BANK-TRANSFER', 'MULTIMEDIA'),
(10, 25, 'Kakadiya Charmi', 'charmi3174@gmail.com', 9081703174, '1', '3', '7637cbbb487b3406c201afa82235bda7', 'user.png', 1, 0, NULL, NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(11, 19, 'Gautam Shingala', 'gautam@cdmi.in', 9909151897, '1', '1', '2262c1bad7a11c4c780af8d244a90d08', 'user.png', 2, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(12, 20, 'Shailesh Oslaniya', 'shailesh.oslaniya@gmail.com', 9377097697, '1', '1', '4682f08e589c743b59a48b8e5f8e8a3e', 'user.png', 2, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(13, 26, 'Haresh Chotaliya', 'haresh@gmail.com', 8980362456, '2', '3', '4297f44b13955235245b2497399d7a93', 'user.png', 2, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(14, 39, 'Haresh Shiyani', 'hpshiyani@gmail.com', 9687400737, '1', '3', 'bb554d4fcac969d7aaa744d90ee0dce8', '1648963986696.jpg', 2, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(15, 40, 'Mohit Godhani', 'm1g@gmail.com', 1111111111, '1', '3', 'b509c66bd0737c27172aebabcc868b69', 'user.png', 2, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(16, 42, 'JATIN RADADIYA', 'jatin@gmail.com', 9712838848, '1', '3', '666ab7c9e38fa2a868683211e2c5bc71', 'google.jpg', 2, 14, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(17, 9, 'Komal Varsadiya', 'komalvarsadiya@gmail.com', 9016193783, '1', '1', 'e3344d285d52b21af30c44bd3731ab4b', 'user.png', 3, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(18, 11, 'Uttam Bhadiyadra', 'uttam@gmail.com', 8140007751, '1', '5', '07406e89fbc4361345407e22895546de', 'user.png', 3, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(19, 13, 'Falakiya Pratham', 'prathamfalakiya@gmail.com', 9586965881, '1', '5', '2afd8fbd11f17812963bda3eadd7c6f4', 'WhatsApp_Image_2023-07-17_at_4_16_52_PM_(1).jpg', 3, 14, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(20, 7, 'Dharmesh Harkhani', 'dharmesh.cdmi@gmail.com', 9726174891, '1', '1', 'de88dbde1c1be8c622f8e37359c7b60f', 'user.png', 4, 24, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(21, 9, 'Zarna Parvatia', 'Zarnacdmi@gmail.com', 8866303925, '1', '3', '589bce76c5a2f51bd6748746215b7ad8', 'user.png', 4, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(22, 10, 'Julla Patel', 'jullacdmi01@gmail.com', 8128359944, '1', '7', '036d5aac01a166dcd77edfed5417a35e', 'user.png', 4, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(23, 20, 'Ashish Sharma', 'ashish.cdmi@gmail.com', 9999999999, '1', '4', '902bac209087d312dbc5be7e7c2edef9', 'user.png', 4, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(24, 23, 'Tushar Prajapati', 'tushar.cdmi@gmail.com', 0, '1', '4', '3677c94e8f5e3dbfa52718fe4076881c', 'user.png', 4, 0, '', '', 0, 0, 'CASH', 'MULTIMEDIA'),
(25, 100, 'test', 'test@gmail.com', 1234567890, '1', '1', '202cb962ac59075b964b07152d234b70', 'user.jpg', 3, 1, 'test', 'test', 0, 0, 'CASH', 'MULTIMEDIA'),
(26, 72, 'Avadhi Badhiya', 'avadhi@gmail.com', 9510148413, '1', '3', '83c10e9906091a5a5cdd57b5353479de', 'user.png', 2, 0, NULL, NULL, 0, 0, 'CASH', 'MULTIMEDIA'),
(27, 37, 'Staff Training', 'stafftraining@gmail.com', 0, '1', '3', 'f09e2fa7b19117d5b6637dcc6388fffa', 'user.png', 1, 0, NULL, NULL, 0, 0, 'CASH', 'MULTIMEDIA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
