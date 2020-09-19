-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2019 at 05:51 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `builder_out`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `icon` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `fetch_method` varchar(250) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `icon`, `url`, `fetch_method`, `position`, `parent`) VALUES
(1, 'Dashboard', 'fa fa-home', 'user/dashboard', 'dashboard', 1, 0),
(2, 'Settings', 'fa fa-cog', 'settings', 'settings', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(250) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('logo', 'philips-in-spa9120b-94-original-imaf3zx3sxkbje7f.jpeg'),
('favicon', ''),
('language', 'en'),
('project_title', 'My Project Title');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `profile_pic` varchar(250) NOT NULL DEFAULT 'profile.png',
  `username` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `access_token` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `status` enum('active','pending','deleted','') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `fname`, `lname`, `profile_pic`, `username`, `email`, `password`, `access_token`, `phone`, `status`, `created_at`, `last_login`) VALUES
(1, 1, 'Manoj ', 'Kumar', 'profile_1.jpeg', 'Admin', 'admin@admin.com', '$2y$10$lQ3fFAl4nwiRuidENLLOteDZ0BCmc8hgK5EldDYN8Vj/DY.o0My6O', NULL, NULL, 'active', '2019-01-06 05:22:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
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
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;