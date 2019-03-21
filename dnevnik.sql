-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2019 at 09:00 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnevnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `title`) VALUES
(1, 'Ponedeljak'),
(2, 'Utorak'),
(3, 'Sreda'),
(4, 'Cetvrtak'),
(5, 'Petak'),
(6, 'Subota');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` enum('1','2','3','4') NOT NULL,
  `year` enum('I','II','III','IV') NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `year`, `user_id`) VALUES
(1, '1', 'I', 15),
(2, '2', 'II', 16),
(3, '3', 'I', 15),
(4, '4', 'I', 15),
(5, '2', 'I', 16),
(6, '2', 'II', 15);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('1','2','3','4','5') DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `title`, `date`) VALUES
(2, '2', '2019-01-20 19:43:13'),
(3, '3', '2019-01-20 19:43:13'),
(4, '4', '2019-01-20 19:43:13'),
(5, '5', '2019-01-20 19:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1547109937),
('m130524_201442_init', 1547109944);

-- --------------------------------------------------------

--
-- Table structure for table `roll`
--

DROP TABLE IF EXISTS `roll`;
CREATE TABLE IF NOT EXISTS `roll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roll`
--

INSERT INTO `roll` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'teacher'),
(3, 'director'),
(4, 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `days_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `classes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `subject_id` (`subject_id`),
  KEY `days_id` (`days_id`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `days_id`, `subject_id`, `department_id`, `classes_id`) VALUES
(202, 1, 2, 2, 1),
(203, 1, 1, 2, 2),
(204, 1, 3, 2, 3),
(205, 1, 4, 2, 4),
(206, 1, NULL, 2, 5),
(207, 1, NULL, 2, 6),
(208, 1, NULL, 2, 7),
(209, 2, 1, 2, 1),
(210, 2, 2, 2, 2),
(211, 2, 6, 2, 3),
(212, 2, 5, 2, 4),
(213, 2, 9, 2, 5),
(214, 2, 7, 2, 6),
(215, 2, NULL, 2, 7),
(216, 3, 3, 2, 1),
(217, 3, 5, 2, 2),
(218, 3, 3, 2, 3),
(219, 3, 1, 2, 4),
(220, 3, 4, 2, 5),
(221, 3, 4, 2, 6),
(222, 3, NULL, 2, 7),
(223, 4, 3, 2, 1),
(224, 4, 1, 2, 2),
(225, 4, 2, 2, 3),
(226, 4, 3, 2, 4),
(244, 1, 2, 1, 1),
(245, 1, 1, 1, 2),
(246, 1, 2, 1, 3),
(247, 1, 2, 1, 4),
(248, 1, NULL, 1, 5),
(249, 1, NULL, 1, 6),
(250, 1, NULL, 1, 7),
(251, 2, 3, 1, 1),
(252, 2, 2, 1, 2),
(253, 2, 2, 1, 3),
(254, 2, 2, 1, 4),
(255, 2, NULL, 1, 5),
(256, 2, NULL, 1, 6),
(257, 2, NULL, 1, 7),
(258, 3, 5, 1, 1),
(259, 3, 1, 1, 2),
(260, 3, 3, 1, 3),
(261, 3, 4, 1, 4),
(262, 3, 3, 1, 5),
(263, 3, NULL, 1, 6),
(264, 3, NULL, 1, 7),
(265, 4, 2, 1, 1),
(266, 4, 2, 1, 2),
(267, 4, 1, 1, 3),
(268, 4, 5, 1, 4),
(269, 4, 3, 1, 5),
(270, 4, NULL, 1, 6),
(271, 4, NULL, 1, 7),
(272, 5, 5, 1, 1),
(273, 5, 2, 1, 2),
(274, 5, 7, 1, 3),
(275, 5, 3, 1, 4),
(276, 5, 2, 1, 5),
(277, 5, 9, 1, 6),
(278, 5, NULL, 1, 7),
(279, 6, 8, 1, 1),
(280, 6, 8, 1, 2),
(281, 6, 8, 1, 3),
(282, 6, 8, 1, 4),
(283, 6, 8, 1, 5),
(284, 6, 8, 1, 6),
(285, 6, 8, 1, 7),
(286, 1, 2, 1, 1),
(287, 1, 1, 1, 2),
(288, 1, 2, 1, 3),
(289, 1, 2, 1, 4),
(290, 1, NULL, 1, 5),
(291, 1, NULL, 1, 6),
(292, 1, NULL, 1, 7),
(293, 2, 3, 1, 1),
(294, 2, 2, 1, 2),
(295, 2, 2, 1, 3),
(296, 2, 2, 1, 4),
(297, 2, NULL, 1, 5),
(298, 2, NULL, 1, 6),
(299, 2, NULL, 1, 7),
(300, 3, 5, 1, 1),
(301, 3, 1, 1, 2),
(302, 3, 3, 1, 3),
(303, 3, 4, 1, 4),
(304, 3, 3, 1, 5),
(305, 3, NULL, 1, 6),
(306, 3, NULL, 1, 7),
(307, 4, 2, 1, 1),
(308, 4, 2, 1, 2),
(309, 4, 1, 1, 3),
(310, 4, 5, 1, 4),
(311, 4, 3, 1, 5),
(312, 4, NULL, 1, 6),
(313, 4, NULL, 1, 7),
(314, 5, 5, 1, 1),
(315, 5, 2, 1, 2),
(316, 5, 7, 1, 3),
(317, 5, 3, 1, 4),
(318, 5, 2, 1, 5),
(319, 5, 9, 1, 6),
(320, 5, NULL, 1, 7),
(321, 6, 8, 1, 1),
(322, 6, 8, 1, 2),
(323, 6, 8, 1, 3),
(324, 6, 8, 1, 4),
(325, 6, 8, 1, 5),
(326, 6, 8, 1, 6),
(327, 6, 8, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `JMBG` bigint(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `first_name`, `last_name`, `JMBG`, `address`, `phone`, `user_id`, `department_id`) VALUES
(1, 'Mika', 'Mikic', 1234567897894, 'DSFDGH', '113665116', 18, 1),
(2, 'pERA', 'Peric', 1234567897894, 'eguroigng', '894465498', 19, 1),
(3, 'Olja', 'Toto', 1234567891234, 'uvvjb', '1685313548', 18, 1),
(4, 'Kristina', 'Pejcic', 1234567891234, 'uvvjb', '1685313548', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

DROP TABLE IF EXISTS `student_subject`;
CREATE TABLE IF NOT EXISTS `student_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` int(11) DEFAULT '0',
  `final_grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`id`, `student_id`, `subject_id`, `grade`, `final_grade`) VALUES
(19, 1, 1, NULL, NULL),
(20, 1, 2, NULL, NULL),
(21, 1, 3, NULL, NULL),
(22, 1, 4, NULL, NULL),
(23, 1, 5, NULL, NULL),
(24, 1, 6, NULL, NULL),
(25, 1, 7, NULL, NULL),
(26, 1, 8, NULL, NULL),
(27, 1, 9, NULL, NULL),
(28, 4, 1, NULL, NULL),
(29, 4, 2, NULL, NULL),
(30, 4, 3, NULL, NULL),
(31, 4, 4, NULL, NULL),
(32, 4, 5, NULL, NULL),
(33, 4, 6, NULL, NULL),
(34, 4, 7, NULL, NULL),
(35, 4, 8, NULL, NULL),
(36, 4, 9, NULL, NULL),
(37, 2, 1, NULL, NULL),
(38, 2, 2, NULL, NULL),
(39, 2, 3, NULL, NULL),
(40, 2, 4, NULL, NULL),
(41, 2, 5, NULL, NULL),
(42, 2, 6, NULL, NULL),
(43, 2, 7, NULL, NULL),
(44, 2, 8, NULL, NULL),
(45, 2, 9, NULL, NULL),
(46, 3, 1, NULL, NULL),
(47, 3, 2, NULL, NULL),
(48, 3, 3, NULL, NULL),
(49, 3, 4, NULL, NULL),
(50, 3, 5, NULL, NULL),
(51, 3, 6, NULL, NULL),
(52, 3, 7, NULL, NULL),
(53, 3, 8, NULL, NULL),
(54, 3, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

DROP TABLE IF EXISTS `student_subjects`;
CREATE TABLE IF NOT EXISTS `student_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `student_id`, `subject_id`) VALUES
(1, 3, 2),
(2, 1, 1),
(3, 1, 2),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7),
(9, 1, 8),
(10, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `title`) VALUES
(1, 'Matematika'),
(2, 'Srpski Jezik'),
(3, 'Muzicko'),
(4, 'Likovno'),
(5, 'Fizika'),
(6, 'Fizicko'),
(7, 'Priroda i drustvo'),
(8, 'Engleski Jezik'),
(9, 'Ruski jezik');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `JMBG` bigint(13) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `roll_id` (`roll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `roll_id`, `first_name`, `last_name`, `JMBG`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Marija', 'Stojiljkovic', 0, 'gia', '54ICU0YqTmYG4GRblTX9-fK2tETlouoG', '$2y$13$ogeijhiXEa0MstL02dRi2uDYj.W6I4DRiK/L1.NzNUPeOz5VAOBuC', NULL, 'marija@gmail.com', 10, 1547119510, 1547460779),
(14, 1, 'ilijan', 'militar', 3333333333333, 'Ilijan123', 'PvZN13aQUPVoyx8qD3Ht-pcqWgQQKkx1', '$2y$13$IiJE9Ho.YueLwKBrfXmMlOyZzlL4I49vta8F6MI0X82m2/0b4varW', NULL, 'ilijan@gmail.com', 10, 1547544121, 1547544121),
(15, 2, 'zika', 'zikic', 3333333333333, 'zika123', 'E5QlyumOyklUB-WS_4QrkKmcjHO-T4AU', '$2y$13$dkgJ.hM1ArKjIjerEb33Zuui3OQjh1sPO7kdmbyUnWD7tNOe2lpxe', NULL, 'zika@gmail.com', 10, 1547631218, 1547631218),
(16, 2, 'Pera', 'Peric', 3333333333334, 'Ilijan', '60I_YAAzM6UAeUEtYtBrIOSTzQvZy0kd', '$2y$13$1IJoczAIyZswNu.WhZdkSevcCC8s8DgZ3kYLuwAScN/1muBW07WQC', NULL, 'peki@gmail.com', 10, 1547631610, 1547631610),
(17, 1, 'admin', 'admin', 1234567891111, 'admin', 'DZ07IW4MUQu4eIYo34DE5csUue-SfzT8', '$2y$13$gprYNFvFH.Um9yM7Hu/dxONpa/1ySvY9EPfcNWKS1eNE5L3uCLvfW', NULL, 'admin@admin.com', 10, 1547723519, 1547723519),
(18, 4, 'Milica', 'Mikic', 1234567897894, 'MMikic', 'sIBRPs1c_L1E5yjAPOAW1Jz7Id5cBun3', '$2y$13$yMMG3iqhIimgBV8it98P/e3Fn6inXb73txim6RsrVG/ob8z/MQLtS', NULL, 'bbb@gmail.com', 10, 1547803776, 1547803776),
(19, 4, 'Ilijan', 'bbb', 1234567897894, 'Kristinas', 'jSk3wCi1q78-nq_keohqN0pP1hsMIB7l', '$2y$13$MXC2ftPHrY7GxtbblVZn7.umefuXe8RWi9VARv6WmCEousDKL/K0S', NULL, 'bbsb@gmail.com', 10, 1547803802, 1547803802);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`days_id`) REFERENCES `days` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD CONSTRAINT `student_subjects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roll_id`) REFERENCES `roll` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
