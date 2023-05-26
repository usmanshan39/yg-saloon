-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 12:58 PM
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `mobile`, `app_date`, `app_time`, `status`, `updated_at`) VALUES
(1, 'app one', 'one@gmail.com', '12343123', '2023-04-30', '09:11', 'Cancel', '0000-00-00 00:00:00'),
(2, 'app two', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Complete', '0000-00-00 00:00:00'),
(3, 'app three', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Cancel', '0000-00-00 00:00:00'),
(4, 'app four', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Pending', '0000-00-00 00:00:00'),
(5, 'app five', 'one@gmail.com', '12343123', '2023-05-02', '14:31:38', 'Complete', '0000-00-00 00:00:00'),
(6, 'app isx', 'is@gmail.com', '123123112', '2023-05-29', '13:13', 'Pending', '2023-05-25 08:17:58'),
(7, 'app seven', 'seven@gmail.com', '3123123', '2023-05-30', '01:19', 'Pending', '2023-05-25 08:18:45'),
(8, 'App Eight', 'eight@gmail.com', '12312312321', '2023-05-09', '14:58', 'Pending', '2023-05-26 09:56:14'),
(9, 'app nine', 'nine@gmail.com', '12331231', '2023-12-01', '13:59', 'Pending', '2023-05-26 09:57:51'),
(10, 'ten', 'ten@gmail.com', '12313132123', '2024-11-01', '01:59', 'Pending', '2023-05-26 09:59:50'),
(11, 'eleven', 'eleven@gmail.com', '12343223', '2021-02-02', '12:58', 'Pending', '2023-05-26 10:01:56'),
(12, 'twle', 'twele@gmail.com', '123123123', '2024-02-02', '14:01', 'Pending', '2023-05-26 10:03:00'),
(13, 'oneb', 'oneb@gmail.com', '1232123123', '2023-12-02', '01:00', 'Pending', '2023-05-26 10:04:57'),
(14, 'onec', 'oneb@gmail.com', '2323232', '2024-02-01', '11:59', 'Pending', '2023-05-26 10:06:05'),
(15, 'blog1', 'blog1@gmail.com', '1231231', '2023-01-01', '01:59', 'Pending', '2023-05-26 10:10:44');

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
  `meta_title` varchar(255) NOT NULL,
  `meta_desc` longtext NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_blogs`
--

INSERT INTO `our_blogs` (`id`, `title`, `blog_image`, `blog_desc`, `published`, `meta_title`, `meta_desc`, `updated_at`) VALUES
(1, 'one', '../uploads/massage-ser.jpg', 'What is Lorem Ipsum?', 1, 'one title', 'one meta desc', '2023-05-26 10:42:48'),
(2, 'two', '../uploads/massage-ser.jpg', 'What is Lorem Ipsum? Updated\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'two title', 'two meta desc', '2023-05-26 10:42:50'),
(7, 'four', '../uploads/makeup.jpg', 'What is Lorem Ipsum? Updated Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 'four title', 'four meta desc', '2023-05-26 10:39:38'),
(8, 'home 1', '../uploads/nails-ser.jpg', 'The modal plugin toggles your hidden content on demand, via data attributes or JavaScript. It also overrides default scrolling behavior and generates a .modal-backdrop to provide a click area for dismissing shown modals when clicking outside the modal.\r\nThe modal plugin toggles your hidden content on demand, via data attributes or JavaScript. It also overrides default scrolling behavior and generates a .modal-backdrop to provide a click area for dismissing shown modals when clicking outside the modal.\r\nThe modal plugin toggles your hidden content on demand, via data attributes or JavaScript. It also overrides default scrolling behavior and generates a .modal-backdrop to provide a click area for dismissing shown modals when clicking outside the modal.', 1, 'home-12', 'The modal plugin toggles your hidden content on demand, via data attributes or JavaScript. It also overrides default scrolling behavior and generates a .modal-backdrop to provide a click area for dismissing shown modals when clicking outside the modal.', '2023-05-26 10:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`, `user_type`, `updated_at`) VALUES
(1, 'user1 updated', 'user12@gmail.com', '$2y$10$CjmqvTVZwHFYxKM1jZ80pufEXtsU2l3enChV4OM4aN8vT3KMuCseC', 'super', 0),
(3, 'user2', 'user2@gmail.com', '$2y$10$83LWcHNCT9OS8OCzChAKfeO5DXr/iqLARVCgeaZo4XYXlMp0kqOtO', 'admin', 0);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `our_blogs`
--
ALTER TABLE `our_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
