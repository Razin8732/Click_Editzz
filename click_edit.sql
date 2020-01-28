-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 06:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `click_edit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(1, 'admin1@email.com', 'admin1', 'Admin 1', '2020-01-27 08:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `path` varchar(100) NOT NULL,
  `lern` text NOT NULL,
  `prereq` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `amount` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `i_id`, `title`, `description`, `path`, `lern`, `prereq`, `status`, `amount`, `created_at`) VALUES
(1, 1, 'Adobe Photoshop CC  Essentials Training Course', '<p>Hi there, my name is Dan Scott. I am an Adobe Certified Instructor (ACI) for Photoshop.&nbsp;</p><p>Are you struggling to learn Photoshop on your own? This course will allow you to use Photoshop professionally. You will be able to add Photoshop to your CV &amp;&nbsp;start getting paid for your Photoshop skills.</p><p>In this course I will teach you everything you need to know about getting started with Photoshop. You''ll learn how to use Photoshop for use in Graphic Design &amp; for Photoshop Retouching. You will create lots of your own projects that you can add to your own portfolio to help your employment.</p><ul><li><p><strong><em>David:&nbsp;</em></strong><em>"AMAZING course Dan! Thank you so much for sharing your skills with us!! Your teaching style is very professional and easy to understand. I feel comfortable with the skill set you''ve given me to handle small projects now. I''ve already purchased your Advanced Training Course in Photoshop and can''t wait to dive in!! Thanks again!</em></p></li></ul><p>This course is for beginners. You do not need any previous knowledge of Photoshop, photography or design. We will start right at the beginning and work our way through step by step.&nbsp;</p><p>You will learn the Photoshop ''secret sauce'' whereby we will magically enhance our background and when necessary completely remove people from images.</p><p>There are exercise files available to download so that you can follow along with me in the videos. There are lots of assignments I will set so that you can practice the skills you have learned.&nbsp;</p><ul><li><p><strong><em>Simon:&nbsp;</em></strong><em>"I just finished the Adobe Photoshop Essentials Training Course and I want to say I totally loved it! For me, a person who had zero experience in using Photoshop this course was very helpful to get into the graphic design area with a lot of interest and fun. This course is very good structured - from easy to hard topics. Also it has a lot of detailed explanations and really fun practical tasks. I''ve got all I needed for starting to work on my own first graphic design projects. And again, Daniel is just a great teacher! His teaching style is awesome and I am really glad I picked his courses for learning my new profession. With Daniel it''s really fun and interesting journey."</em></p></li></ul><p>If you have never opened Photoshop before or you have already opened Photoshop and are struggling with the basics, follow me and together we will learn how to make beautiful images using Photoshop.</p><div class="audience" data-purpose="course-audience"><div class="audience__title">Who this course is for:</div><ul class="audience__list"><li>Anyone who wants to start using Photoshop in their career &amp; get paid for their Photoshop skills.</li><li>Newbie''s, amateurs, graphic designers, motion graphics artists, Illustrator users, and any creatives who want to design their own graphics and edit their own photos from scratch</li></ul></div>', 'courses/Adobe Photoshop CC  Essentials Training Course/', '<ul>\r\n<li>You will be able to start earning money from your Photoshop Skills.</li>\r\n<li>You will have over 20 of your own projects to add to your portfolio.</li>\r\n</ul>', '<ul>\r\n<li class="requirements__item">Any version of Adobe Photoshop, preferably the CC (Creative Cloud) version.</li>\r\n<li class="requirements__item">No prior knowledge or experience with Photoshop is required</li>\r\n</ul>', 'paid', 500, '2020-01-23 17:38:52'),
(2, 1, 'Course 2', '<p>Hi there, my name is Dan Scott. I am an Adobe Certified Instructor (ACI) for Photoshop.&nbsp;</p>\r\n<p>Are you struggling to learn Photoshop on your own? This course will allow you to use Photoshop professionally. You will be able to add Photoshop to your CV &amp;&nbsp;start getting paid for your Photoshop skills.</p>\r\n<p>In this course I will teach you everything you need to know about getting started with Photoshop. You''ll learn how to use Photoshop for use in Graphic Design &amp; for Photoshop Retouching. You will create lots of your own projects that you can add to your own portfolio to help your employment.</p>\r\n<ul>\r\n<li>\r\n<p><strong><em>David:&nbsp;</em></strong><em>"AMAZING course Dan! Thank you so much for sharing your skills with us!! Your teaching style is very professional and easy to understand. I feel comfortable with the skill set you''ve given me to handle small projects now. I''ve already purchased your Advanced Training Course in Photoshop and can''t wait to dive in!! Thanks again!</em></p>\r\n</li>\r\n</ul>\r\n<p>This course is for beginners. You do not need any previous knowledge of Photoshop, photography or design. We will start right at the beginning and work our way through step by step.&nbsp;</p>\r\n<p>You will learn the Photoshop ''secret sauce'' whereby we will magically enhance our background and when necessary completely remove people from images.</p>\r\n<p>There are exercise files available to download so that you can follow along with me in the videos. There are lots of assignments I will set so that you can practice the skills you have learned.&nbsp;</p>\r\n<ul>\r\n<li>\r\n<p><strong><em>Simon:&nbsp;</em></strong><em>"I just finished the Adobe Photoshop Essentials Training Course and I want to say I totally loved it! For me, a person who had zero experience in using Photoshop this course was very helpful to get into the graphic design area with a lot of interest and fun. This course is very good structured - from easy to hard topics. Also it has a lot of detailed explanations and really fun practical tasks. I''ve got all I needed for starting to work on my own first graphic design projects. And again, Daniel is just a great teacher! His teaching style is awesome and I am really glad I picked his courses for learning my new profession. With Daniel it''s really fun and interesting journey."</em></p>\r\n</li>\r\n</ul>\r\n<p>If you have never opened Photoshop before or you have already opened Photoshop and are struggling with the basics, follow me and together we will learn how to make beautiful images using Photoshop.</p>\r\n<div class="audience" data-purpose="course-audience">\r\n<div class="audience__title">Who this course is for:</div>\r\n<ul class="audience__list">\r\n<li>Anyone who wants to start using Photoshop in their career &amp; get paid for their Photoshop skills.</li>\r\n<li>Newbie''s, amateurs, graphic designers, motion graphics artists, Illustrator users, and any creatives who want to design their own graphics and edit their own photos from scratch</li>\r\n</ul>\r\n</div>', 'courses/Adobe Photoshop CC  Essentials Training Course/', '<ul>\r\n<li>You will be able to start earning money from your Photoshop Skills.</li>\r\n<li>You will have over 20 of your own projects to add to your portfolio.</li>\r\n</ul>', '<ul>\r\n<li class="requirements__item">Any version of Adobe Photoshop, preferably the CC (Creative Cloud) version.</li>\r\n<li class="requirements__item">No prior knowledge or experience with Photoshop is required</li>\r\n</ul>', 'free', 0, '2020-01-23 07:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `enduser`
--

CREATE TABLE IF NOT EXISTS `enduser` (
`id` int(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enduser`
--

INSERT INTO `enduser` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(1, 'user1@email.com', 'user1', 'user1', '2020-01-20 13:25:05'),
(2, 'user2@email.com', 'user2', 'User2', '2020-01-20 15:44:58'),
(3, 'user3@email.com', 'user3', 'User3', '2020-01-20 15:45:51'),
(4, 'user4@email.com', 'user4', 'User4', '2020-01-22 05:58:05'),
(5, 'user5@email.com', 'user5', 'User5', '2020-01-28 09:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `enduser_course`
--

CREATE TABLE IF NOT EXISTS `enduser_course` (
`id` int(10) NOT NULL,
  `u_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enduser_course`
--

INSERT INTO `enduser_course` (`id`, `u_id`, `c_id`, `created_at`) VALUES
(1, 1, 1, '2020-01-23 07:35:47'),
(2, 1, 2, '2020-01-23 07:36:09'),
(3, 1, 1, '2020-01-23 09:14:01'),
(4, 2, 2, '2020-01-24 07:16:24'),
(5, 1, 1, '2020-01-28 16:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
`id` int(10) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(1, 'instructor1@email.com', 'instructor1', 'Instructor 1', '2020-01-18 09:25:54'),
(2, 'instructor2@email.com', 'instructor2', 'Instructor 2', '2020-01-28 06:21:31'),
(20, '', '', 'ervf', '2020-01-28 16:48:12'),
(21, 'instructor3@email.com', 'lalalala', 'jksnbhf', '2020-01-28 17:04:15'),
(22, 'instructor3@email.com', 'instructor3', 'Instructor 3', '2020-01-28 17:04:50'),
(23, 'instructor4@email.com', 'instructor4', 'Instructor 4', '2020-01-28 17:05:05'),
(24, 'instructor5@email.com', 'instructor5', 'Instructor 5', '2020-01-28 17:05:22'),
(25, 'instructor6@email.com', '', 'Instructor 6', '2020-01-28 17:05:35'),
(26, 'instructor7@email.com', 'instructor7', 'Instructor 7', '2020-01-28 17:06:02'),
(27, 'instructor8@email.com', 'instructor8', 'Instructor 8', '2020-01-28 17:06:19'),
(28, 'instructor9@email.com', 'instructor9', 'Instructor 9', '2020-01-28 17:06:54'),
(29, 'instructor10@email.com', 'instructor10', 'Instructor 10', '2020-01-28 17:07:13'),
(30, 'instructor11@email.com', 'instructor11', 'Instructor 11', '2020-01-28 17:08:15'),
(31, 'instructor12@email.com', 'instructor12', 'Instructor 12', '2020-01-28 17:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_by_user`
--

CREATE TABLE IF NOT EXISTS `payment_by_user` (
`id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_by_user`
--

INSERT INTO `payment_by_user` (`id`, `u_id`, `c_id`, `created_at`) VALUES
(1, 1, 1, '2020-01-23 07:35:47'),
(2, 1, 2, '2020-01-23 07:36:09'),
(3, 1, 1, '2020-01-23 09:14:01'),
(4, 2, 2, '2020-01-24 07:16:25'),
(7, 2, 2, '2020-01-28 10:48:18'),
(8, 1, 1, '2020-01-28 16:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `payment_to_instructor`
--

CREATE TABLE IF NOT EXISTS `payment_to_instructor` (
`id` int(10) NOT NULL,
  `i_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `amount` int(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_to_instructor`
--

INSERT INTO `payment_to_instructor` (`id`, `i_id`, `c_id`, `amount`, `created_at`) VALUES
(1, 1, 1, 300, '2020-01-23 07:35:47'),
(2, 1, 2, 0, '2020-01-23 07:36:09'),
(3, 1, 1, 300, '2020-01-23 09:14:01'),
(4, 1, 2, 0, '2020-01-24 07:16:25'),
(5, 1, 1, 300, '2020-01-28 16:06:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enduser`
--
ALTER TABLE `enduser`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `enduser_course`
--
ALTER TABLE `enduser_course`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_by_user`
--
ALTER TABLE `payment_by_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_to_instructor`
--
ALTER TABLE `payment_to_instructor`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enduser`
--
ALTER TABLE `enduser`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `enduser_course`
--
ALTER TABLE `enduser_course`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `payment_by_user`
--
ALTER TABLE `payment_by_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment_to_instructor`
--
ALTER TABLE `payment_to_instructor`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
