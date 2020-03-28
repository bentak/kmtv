-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2020 at 05:09 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.3.12-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmtv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `created_at`, `updated_at`, `password`, `status`) VALUES
(1, 'loyal', '2020-03-25', '2020-03-25', 'loyal123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'aggressive', '2020-03-25', '2020-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commented_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `video_id`, `user_id`, `comment`, `commented_at`) VALUES
(1, 1, 1, 'some comment', '2020-03-25'),
(2, 1, 1, 'more comments', '2020-03-25'),
(3, 1, 1, 'more comments', '2020-03-25'),
(4, 1, 1, 'more comments', '2020-03-25'),
(5, 1, 1, 'more new comments', '2020-03-25'),
(6, 1, 1, 'more new comments', '2020-03-25'),
(7, 1, 1, 'more new comments', '2020-03-25'),
(8, 1, 1, 'more new comments', '2020-03-25'),
(9, 1, 1, 'more new comments', '2020-03-25'),
(10, 1, 1, 'more new comments', '2020-03-25'),
(11, 1, 1, 'more new comments', '2020-03-25'),
(12, 1, 1, 'more new comments', '2020-03-25');

-- --------------------------------------------------------

--
-- Table structure for table `likedvideos`
--

CREATE TABLE `likedvideos` (
  `id` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likedvideos`
--

INSERT INTO `likedvideos` (`id`, `videoid`, `userid`, `liked_at`) VALUES
(4, 1, 1, '2020-03-28 03:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `network` varchar(100) NOT NULL,
  `response_code` varchar(40) NOT NULL,
  `status` int(11) NOT NULL,
  `paid_at` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `sub_id` int(11) NOT NULL,
  `sub_plan` varchar(150) NOT NULL,
  `amount` varchar(40) NOT NULL,
  `duration` varchar(40) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_subscribe` varchar(40) NOT NULL,
  `status` int(11) NOT NULL,
  `sub_id` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `phone`, `email`, `password`, `is_subscribe`, `status`, `sub_id`, `created_at`, `updated_at`) VALUES
(1, 'loyal', '0548478745', 'loyal@gmail.com', 'loyal123', '1', 1, '1', '2020-03-28', '2020-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `descrption` text NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `preview_url` varchar(255) NOT NULL,
  `thumbnail_url` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `upload_time` varchar(255) NOT NULL DEFAULT '',
  `edited_time` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `category_id`, `admin_id`, `title`, `descrption`, `video_url`, `preview_url`, `thumbnail_url`, `views`, `likes`, `upload_time`, `edited_time`, `status`) VALUES
(1, 1, 1, 'first video', 'some video description here', 'video url', 'preview url', 'thumbnail url', 3, 8, '2020-03-25', '2020-03-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `viewed_videos`
--

CREATE TABLE `viewed_videos` (
  `id` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `viewed_videos`
--

INSERT INTO `viewed_videos` (`id`, `videoid`, `userid`, `viewed_at`) VALUES
(1, 1, 1, '2020-03-28 04:37:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likedvideos`
--
ALTER TABLE `likedvideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);
ALTER TABLE `videos` ADD FULLTEXT KEY `search` (`title`,`descrption`);

--
-- Indexes for table `viewed_videos`
--
ALTER TABLE `viewed_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `likedvideos`
--
ALTER TABLE `likedvideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `viewed_videos`
--
ALTER TABLE `viewed_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
