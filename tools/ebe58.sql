-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : ebefrrwbcnebe58.mysql.db
-- Généré le :  sam. 30 nov. 2019 à 00:27
-- Version du serveur :  5.6.43-log
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebefrrwbcnebe58`
--

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_ajouter`
--

CREATE TABLE `ebe58_ajouter` (
  `id` int(11) NOT NULL,
  `id_Produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_avoir`
--

CREATE TABLE `ebe58_avoir` (
  `id` int(11) NOT NULL,
  `id_Produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_client`
--

CREATE TABLE `ebe58_client` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `city` varchar(255) NOT NULL,
  `rank_users` int(11) NOT NULL DEFAULT '0',
  `id_users` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_commenter`
--

CREATE TABLE `ebe58_commenter` (
  `id` int(11) NOT NULL,
  `id_Users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_comments`
--

CREATE TABLE `ebe58_comments` (
  `id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `name` text NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_migrations`
--

CREATE TABLE `ebe58_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_news`
--

CREATE TABLE `ebe58_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_users` int(11) NOT NULL,
  `prio` int(11) DEFAULT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_paiement`
--

CREATE TABLE `ebe58_paiement` (
  `id` int(11) NOT NULL,
  `id_Panier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_panier`
--

CREATE TABLE `ebe58_panier` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_partner`
--

CREATE TABLE `ebe58_partner` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `logo` text NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_partner`
--

INSERT INTO `ebe58_partner` (`id`, `name`, `link`, `logo`, `description`) VALUES
(5, 'Secours Catholique', 'https://www.secours-catholique.org/', 'nsbqooms264yrubk.png', 'Le Secours catholique est une association à but non lucratif créée le 8 septembre 1946 par l\'abbé Jean Rodhain. Le Secours catholique est attentif aux problèmes de pauvreté et d\'exclusion de tous les publics et cherche à promouvoir la justice...'),
(3, 'ATD Quart Monde', 'https://www.atd-quartmonde.fr/', 'lgw5k34vb21w4fpw.png', 'Le Mouvement ATD Quart Monde a fait évoluer la lutte contre la pauvreté pour la faire passer d’objet de charité à lutte pour les droits de l’homme. Né dans un bidonville de Noisy-le-Grand dans les années 50, il est à l’origine d’un grand nombre d’avancées législatives comme le Revenu Minimum d’Insertion (RMI, ancêtre du RSA), la Couverture Maladie Universelle (CMU) ou le Droit au logement opposable (DALO).\r\nVous trouverez ici les étapes de son histoire.');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_produit`
--

CREATE TABLE `ebe58_produit` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` text NOT NULL,
  `height` text NOT NULL,
  `weight` text NOT NULL,
  `quantity` text NOT NULL,
  `width` text NOT NULL,
  `activity` text NOT NULL,
  `image` text NOT NULL,
  `categorie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `ebe58_produit`
--

INSERT INTO `ebe58_produit` (`id`, `name`, `description`, `price`, `height`, `weight`, `quantity`, `width`, `activity`, `image`, `categorie`) VALUES
(3, 'qsd', 'sd', '2.000', '2', '2', '2', '2', '2', '', ''),
(4, 'tomate roma', 'tomate juteuse super pour faire la sauce tomate', '3', '3', '1', '200', '3', '0', '6fw4rhks97i4q4on.png', ''),
(10, 'Coeur de boeuf', 'La coeur de boeuf est savoureuse, parfumée, sucrée et compacte. Idéale pour des salades ou gaspacho', '3', '180', '90', '500', '2', '0', '8mxf22ygwb2amdt5.png', ''),
(13, 'meuble', 'meuble', '35.000', '123', '25', '1', '96', '2', 'NULL', ''),
(14, 'qsdffez', 'qzsdf', '14.000', '2', '2', '1', '2', '3', 'yf5qm7klzpt9qcfv.png', '');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_services`
--

CREATE TABLE `ebe58_services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL,
  `text` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text,
  `text4` text,
  `video` varchar(100) DEFAULT NULL,
  `pdf` varchar(255) NOT NULL,
  `button` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_services`
--

INSERT INTO `ebe58_services` (`id`, `name`, `link`, `banner`, `color`, `text`, `text2`, `text3`, `text4`, `video`, `pdf`, `button`, `logo`) VALUES
(42, 'Bois et Affouages', '#', 'pt49wz90ggzkkhje.jpg', '#b56c24', 'Adresse : 3 cour du château 58700 Prémery', 'Numéro : 03 86 38 26 64', 'Horaires : Du Lundi au Vendredi de 9h à 12h - 13h à 17h00', 'Description :\r\n\r\nPour le moment, tout le contenu de cette page est temporaire.', 'NULL', 'l64epzjfudoefne3.pdf', 'pe5odaljtboe7kux.jpg', 'aa1dqv0ikpw8s3c5.jpg'),
(44, 'Maraîchage', '#', '24f5fdi2rjo2sp9g.jpg', '#327e40', '3 cour du château 58700 Prémery', 'Numéro : 03 86 38 26 64', 'Horaires : Du Lundi au Vendredi de 9h à 12h - 13h à 17h00', 'Description : Pour le moment, tout le contenu de cette page est temporaire.', 'NULL', '4cseumdksnns5yte.pdf', '9i9sgonn4oq9ogcq.jpg', '3ii5dcm3g0z5mv3n.jpg'),
(45, 'Recyclerie', '#', 'k1ikd5951lb8igr3.jpg', '#000000', 'Adresse : 9 rue Auguste Lambiotte 58700 Prémery', 'Numéro : 03 86 60 51 71', 'Horaires : Du Lundi au Vendredi de 8h30 à 12h - 13h à 17h30 et le samedi de 9h à 17h', 'Description : Pour le moment, tout le contenu de cette page est temporaire.', 'NULL', 'kz0ktiz71ss1u3v3.pdf', '5zitabaiiu5bz0qp.jpg', 'uazjq90uo10utbvm.jpg'),
(46, 'Motoculture', '#', 'n6fh3bezqueet0bq.jpg', '#2e2e49', 'Adresse : 9 rue Auguste Lambiotte 58700 Prémery', 'Numéro : 03 86 60 51 70', 'Horaires : Du Lundi au Vendredi de 8h à 12h - 13h30 à 17h30 et le samedi de 9h à 12h', 'Description : Pour le moment, tout le contenu de cette page est temporaire.', 'NULL', 'dvbsji90cuxo9iz0.pdf', 'qdkupambsisi6aaj.jpg', '392017sg31jc08hd.jpg'),
(47, 'Bois et Nature', 'NULL', 'h3gtbt752ux14p8b.jpg', '#845424', 'Adresse : 3 cour du château 58700 Prémery', 'Numéro : 03 86 38 26 64', 'Horaires : Du Lundi au Vendredi de 9h à 12h - 13h à 17h00', 'Description : Pour le moment, tout le contenu de cette page est temporaire.', 'NULL', 'b5gf4t22qy2oo2pe.pdf', 'ttn694wqjovoall4.jpg', '3wh7bz56qaczebna.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_social`
--

CREATE TABLE `ebe58_social` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_social`
--

INSERT INTO `ebe58_social` (`id`, `name`, `link`, `logo`) VALUES
(5, 'Facebook', 'https://www.facebook.com/EBE.Premery58/', 'facebook.png'),
(4, 'Youtube', 'https://www.youtube.com/channel/UCDO-DV2Ngj3beYyqX9VRSQw', 'youtube.png'),
(6, 'Twitter', 'https://twitter.com/ebe58_tzc', 'twitter.png');

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_team`
--

CREATE TABLE `ebe58_team` (
  `id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `rank_users` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ebe58_texts`
--

CREATE TABLE `ebe58_texts` (
  `id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `page` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ebe58_texts`
--

INSERT INTO `ebe58_texts` (`id`, `text`, `page`) VALUES
(2, 'Bonjour et bienvenue sur le site internet de l\'Entreprise à But d\'Emploi, autrement appelée, EBE58. Depuis maintenant plusieurs mois, la direction de l\'entreprise et moi même travaillons en relation afin de vous proposer un site internet le plus propre possible aussi bien sur Ordinateur que sur Mobile ! Malgré tout, le site n\'est pas encore totalement finalisé, car comme vous pourrez le constater, toutes les informations ne sont pas à jour ! Merci à vous pour votre patience le temps que tout cela se régularise, et n\'hésitez pas à nous faire vos retour via la section contact du site.', 'home'),
(3, 'Cantin Poiseau, Développeur chez EBE58', 'home'),
(4, 'Page en cours de maintenance.', 'qui'),
(5, 'Brigitte Allouche - Cantin Poiseau', 'credits'),
(7, 'Cantin Poiseau', 'credits'),
(8, 'Cantin Poiseau - Anaïs Dulieu', 'credits'),
(9, 'Cantin Poiseau -', 'credits'),
(1, 'Informations', 'home');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `rank`, `remember_token`, `created_at`, `updated_at`, `link`) VALUES
(1, 'Cantin Poiseau', NULL, 'cantarabac@gmail.com', NULL, '$2y$10$YiK07J0Jllw7Hu1.0oGIJevet/3fQYC/FDeBGS2FFwWPl6ntOLFkK', 2, 'c9uqn1yfrTt8gUO7Ii05ETvP5WuGCUUjOljYiLEwI7T113uwEImJfaZzWFRA', '2019-03-05 13:47:41', '2019-03-05 13:47:41', NULL),
(2, 'Cantin Poiseau', NULL, 'cantin.poiseau@gmail.com', NULL, '$2y$10$0DkTp0PHonC5M9MkBwuNTOWKkbCXWbtHQ3qZEtla5Ca1ZPCTRBtmO', 1, '3kkdZjNhz4BqlI9b7rcrWCUH7wTbR4j1vuBHNhPkGALQ386sxAWezvt7HQFx', '2019-05-17 09:44:41', '2019-05-17 09:44:41', '0'),
(4, 'Libbrecht', NULL, 'contact@laboutiquesaisons.com', NULL, '$2y$10$ReLEpsnDF6O3f8uA0IS.1uY4ZnYECfZ5vgC0oncsSyRoxlHv/IAeW', 1, NULL, '2019-11-27 13:26:07', '2019-11-27 13:26:07', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ebe58_ajouter`
--
ALTER TABLE `ebe58_ajouter`
  ADD PRIMARY KEY (`id`,`id_Produit`),
  ADD KEY `Ajouter_Produit0_FK` (`id_Produit`);

--
-- Index pour la table `ebe58_avoir`
--
ALTER TABLE `ebe58_avoir`
  ADD PRIMARY KEY (`id`,`id_Produit`),
  ADD KEY `Avoir_Produit0_FK` (`id_Produit`);

--
-- Index pour la table `ebe58_client`
--
ALTER TABLE `ebe58_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_commenter`
--
ALTER TABLE `ebe58_commenter`
  ADD PRIMARY KEY (`id`,`id_Users`),
  ADD KEY `Commenter_Users0_FK` (`id_Users`);

--
-- Index pour la table `ebe58_comments`
--
ALTER TABLE `ebe58_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_migrations`
--
ALTER TABLE `ebe58_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_news`
--
ALTER TABLE `ebe58_news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_paiement`
--
ALTER TABLE `ebe58_paiement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Paiement_Panier_AK` (`id_Panier`);

--
-- Index pour la table `ebe58_panier`
--
ALTER TABLE `ebe58_panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_partner`
--
ALTER TABLE `ebe58_partner`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_produit`
--
ALTER TABLE `ebe58_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_services`
--
ALTER TABLE `ebe58_services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_social`
--
ALTER TABLE `ebe58_social`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_team`
--
ALTER TABLE `ebe58_team`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ebe58_texts`
--
ALTER TABLE `ebe58_texts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ebe58_client`
--
ALTER TABLE `ebe58_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_comments`
--
ALTER TABLE `ebe58_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_migrations`
--
ALTER TABLE `ebe58_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_news`
--
ALTER TABLE `ebe58_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `ebe58_paiement`
--
ALTER TABLE `ebe58_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_panier`
--
ALTER TABLE `ebe58_panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_partner`
--
ALTER TABLE `ebe58_partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ebe58_produit`
--
ALTER TABLE `ebe58_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `ebe58_services`
--
ALTER TABLE `ebe58_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `ebe58_social`
--
ALTER TABLE `ebe58_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ebe58_team`
--
ALTER TABLE `ebe58_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ebe58_texts`
--
ALTER TABLE `ebe58_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ebe58_ajouter`
--
ALTER TABLE `ebe58_ajouter`
  ADD CONSTRAINT `Ajouter_Panier_FK` FOREIGN KEY (`id`) REFERENCES `ebe58_panier` (`id`),
  ADD CONSTRAINT `Ajouter_Produit0_FK` FOREIGN KEY (`id_Produit`) REFERENCES `ebe58_produit` (`id`);

--
-- Contraintes pour la table `ebe58_avoir`
--
ALTER TABLE `ebe58_avoir`
  ADD CONSTRAINT `Avoir_Produit0_FK` FOREIGN KEY (`id_Produit`) REFERENCES `ebe58_produit` (`id`),
  ADD CONSTRAINT `Avoir_Services_FK` FOREIGN KEY (`id`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
