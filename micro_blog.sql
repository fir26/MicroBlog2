-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2018 at 07:12 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micro_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `votes` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `contenu`, `date`, `votes`) VALUES
(1, 'Test 1', 1516378410, 0),
(3, 'Test 3', 1516378432, 0),
(14, 'Insertion', 1516378440, 0),
(15, 'Message test 1', 1516378820, 0),
(16, 'Bonjour', 1516378825, 0),
(17, 'Test Page 2', 1516378843, 0),
(18, 'Pagination OK', 1516378854, 0),
(19, 'Inscription OK', 1516378867, 0),
(20, 'Connexion OK', 1516378874, 0),
(21, 'Supprimer OK', 1516378882, 1),
(22, 'Modifier OK', 1516378886, 0),
(24, 'test@test.fr', 1523466851, 1),
(29, 'https://www.google.fr/', 1523473235, 4);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `sid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `mdp`, `sid`) VALUES
(1, 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'e8d294fad9b89726f09ac314a74d2a97'),
(21, 'bapt@test.com', '924eca6f95a36f1e6de6f1d70aac95e9', 'f3fd75d7582c153e02107127c0b032e1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
