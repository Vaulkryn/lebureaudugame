-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 15 mars 2024 à 11:45
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_logs`
--

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE IF NOT EXISTS `admin_logs` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_token` varchar(255) NOT NULL,
  `media` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `media_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `proposal` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `proposal_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logs_time` time NOT NULL,
  `logs_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `uploaded_files`
--

DROP TABLE IF EXISTS `uploaded_files`;
CREATE TABLE IF NOT EXISTS `uploaded_files` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_token` varchar(255) NOT NULL,
  `game_name` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `title` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descript` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ext` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `serial_no` int UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` time NOT NULL,
  `upload_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `uploaded_files_pending`
--

DROP TABLE IF EXISTS `uploaded_files_pending`;
CREATE TABLE IF NOT EXISTS `uploaded_files_pending` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_token` varchar(255) NOT NULL,
  `game_name` varchar(25) NOT NULL,
  `category` varchar(25) NOT NULL,
  `title` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descript` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ext` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `serial_no` int UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` time NOT NULL,
  `upload_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `avatar_path` varchar(50) DEFAULT NULL,
  `user_token` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users_logs`
--

DROP TABLE IF EXISTS `users_logs`;
CREATE TABLE IF NOT EXISTS `users_logs` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `total_uploads` int UNSIGNED DEFAULT NULL,
  `upload_validated` int UNSIGNED DEFAULT NULL,
  `upload_refused` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users_proposal`
--

DROP TABLE IF EXISTS `users_proposal`;
CREATE TABLE IF NOT EXISTS `users_proposal` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_token` varchar(255) NOT NULL,
  `proposal_text` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `proposal_time` time NOT NULL,
  `proposal_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `video_comments`
--

DROP TABLE IF EXISTS `video_comments`;
CREATE TABLE IF NOT EXISTS `video_comments` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_token` varchar(255) NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_time` time NOT NULL,
  `comment_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
