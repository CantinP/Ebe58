-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 15 mars 2019 à 14:54
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebe58`
--

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_partner`
--

DROP TABLE IF EXISTS `ebe58_partner`;
CREATE TABLE IF NOT EXISTS `ebe58_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `logo` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_partner`
--

INSERT INTO `ebe58_partner` (`id`, `name`, `link`, `logo`, `description`) VALUES
(1, 'test', 'https://www.secours-catholique.org/', 'logo-Secours-Catholique.jpg', 'Le Secours catholique est une association à but non lucratif créée le 8 septembre 1946 par l\'abbé Jean Rodhain. Le Secours catholique est attentif aux problèmes de pauvreté et d\'exclusion de tous les publics et cherche à promouvoir la justice...');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_services`
--

DROP TABLE IF EXISTS `ebe58_services`;
CREATE TABLE IF NOT EXISTS `ebe58_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `banner` text NOT NULL,
  `text` text NOT NULL,
  `product` text NOT NULL,
  `pdf` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_services`
--

INSERT INTO `ebe58_services` (`id`, `name`, `link`, `banner`, `text`, `product`, `pdf`) VALUES
(3, 'Cantin', 'rfgbfvbfdfbfdcezfsz', '7f7dexihtnfa7f6m.jpg', 'egvbddhsbdfgvzsegfsdvgbdsfgvsgdv', '1', 'vhp8pr6rayowm18t.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_texts`
--

DROP TABLE IF EXISTS `ebe58_texts`;
CREATE TABLE IF NOT EXISTS `ebe58_texts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `text` mediumtext NOT NULL,
  `page` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_texts`
--

INSERT INTO `ebe58_texts` (`id`, `title`, `text`, `page`) VALUES
(1, '0', 'L\'EBE58 est une entreprise à but d\'emploi basée sur le développement local, qu\'il soit économique, environnemental ou citoyen.\r\n    Dans le respect de la non-concurrence sur le Territoire, pour ne pas nuire au tissu économique local déjà installé, des activités utiles ont été créées pour répondre aux besoins, repérés par les acteurs socio-économiques, des habitants de la commune (Ex-Communauté de communes « Entre Nièvres et Forêts »).\r\n    L\'objectif de l\'EBE58 : créer des emplois pérennes, adaptés aux compétences disponibles des personnes volontaires, en recherche d\'emploi depuis plus d\'un an. L\'expérimentation menée vise à résorber le chômage de longue durée sur le territoire de Prémery (58) en définissant une autre façon de vivre ensemble la ruralité.\r\n    Visitez notre site Internet, découvrez les services que l\'EBE58 propose, faites vos achats en ligne ou venez tout simplement nous rendre visite dans nos locaux à Prémery... Que vous soyez particulier, entreprise ou collectivité locale, en étant client de l\'EBE58, vous participez à la redynamisation de votre Territoire ! Agissons ensemble pour bien vivre !', 'home'),
(2, '1', 'René Faust, Président de l\'EBE58', 'home');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `rank`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cantin Poiseau', NULL, 'cantarabac@gmail.com', NULL, '$2y$10$YiK07J0Jllw7Hu1.0oGIJevet/3fQYC/FDeBGS2FFwWPl6ntOLFkK', 2, 'LngEP38STjcLzv44rsb7MWkzflTFPV9ykLiGeQTF5eXrzuLU4XPYyd9CE146', '2019-03-05 13:47:41', '2019-03-05 13:47:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
