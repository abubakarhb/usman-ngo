-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2023 at 06:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usman_ngo`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `header` varchar(350) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `author`, `image`, `header`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'lolo.jpg', 'Hurricane Irma has devastated Florida', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '2023-02-28 16:40:15', '2023-02-28 16:40:15'),
(2, 'Admin', 'lolo.jpg', 'Hurricane Irma has devastated Florida', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '2023-02-28 16:40:42', '2023-02-28 16:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `email` varchar(400) NOT NULL,
  `number` float NOT NULL,
  `subject` varchar(300) NOT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `number`, `subject`, `msg`, `created_at`) VALUES
(1, 'mohammed', 'Admin@gmail.com', 908988000, 'Duden flows by their place', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '2023-02-28 17:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `event2`
--

CREATE TABLE `event2` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `organizer` varchar(255) NOT NULL,
  `header` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event2`
--

INSERT INTO `event2` (`id`, `image`, `organizer`, `header`, `description`, `date`, `time_from`, `time_to`, `location`) VALUES
(1, 'txt.jpg', 'Admin', 'World Wide Donation', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '2023-03-01', '10:10:22', '13:12:22', 'Main Campus'),
(2, 'lolo.jpg', 'Admin', 'Hurricane Irma has devastated Florida', 'A small river named Duden flows by their place and supplies it with the necessary regelialia.', '2023-03-01', '10:10:22', '13:12:22', 'Minna');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(350) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `img` varchar(350) NOT NULL,
  `header` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `total_donation` float NOT NULL,
  `amount_donated` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `img`, `header`, `description`, `total_donation`, `amount_donated`, `created_at`, `updated_at`) VALUES
(1, 'lolo.jpg', 'individual or corporate body in Akwaibom,', 'remittances to the Akwaibom government has been made easy…', 300, 100, '2023-02-28 16:19:02', '2023-02-28 16:19:02'),
(2, 'lolo.jpg', 'Clean water for the urban area', 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life', 30000, 12000, '2023-02-28 16:25:33', '2023-02-28 16:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `people_number` varchar(350) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `people_number`, `created_at`, `updated_at`) VALUES
(1, '1000', '2023-02-28 13:29:47', '2023-02-28 16:06:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event2`
--
ALTER TABLE `event2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event2`
--
ALTER TABLE `event2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
