-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 02:13 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ygsaloon`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `app_date` varchar(255) NOT NULL,
  `app_time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `mobile`, `app_date`, `app_time`, `status`, `updated_at`) VALUES
(1, 'app one', 'one@gmail.com', '12343123', '2023-04-30', '09:11', 'Cancel', 0),
(2, 'app two', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Complete', 0),
(3, 'app three', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Cancel', 0),
(4, 'app four', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Pending', 0),
(5, 'app five', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Complete', 0);

-- --------------------------------------------------------

--
-- Table structure for table `our_blogs`
--

CREATE TABLE `our_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_desc` longtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_blogs`
--

INSERT INTO `our_blogs` (`id`, `title`, `blog_image`, `blog_desc`, `published`, `updated_at`) VALUES
(1, 'one', 'facial-ser.jpg', 'What is Lorem Ipsum?', 1, '2023-05-22 07:54:07'),
(2, 'two', 'foot-spa.jpg', 'What is Lorem Ipsum? Updated\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-05-22 08:04:31'),
(3, 'third', '../uploads/massage-ser.jpg', 'What is Lorem Ipsum?', 1, '2023-05-22 07:29:41'),
(7, 'four', '../uploads/makeup.jpg', 'What is Lorem Ipsum? Updated Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2023-05-22 08:17:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_blogs`
--
ALTER TABLE `our_blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `our_blogs`
--
ALTER TABLE `our_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
