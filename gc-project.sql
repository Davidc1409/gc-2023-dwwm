-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 avr. 2023 à 12:54
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
-- Base de données : `gc-project`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `articles_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `text_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `media_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id_articles` int NOT NULL,
  `created_at` datetime NOT NULL,
  `feature` tinyint DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carousel` tinyint DEFAULT NULL,
  `figcaption` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `articles_display` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `articles_ibfk_1` (`user_id_articles`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `articles_name`, `text_content`, `media_content`, `user_id_articles`, `created_at`, `feature`, `summary`, `carousel`, `figcaption`, `articles_display`) VALUES
(7, 'Une communication qui se laisse désirer chez Nintendo', 'Ce week-end, cependant, des infos sorties de nulle part ont fait surface, mais clairement pas sur la plate-forme la plus obscure qui soit, loin de là. La surprise est cependant venue du site de Micromania. Si la fiche produit officielle du jeu, à l\'instar d\'autres plates-formes comme la Fnac ou Cdiscount, a repris le bref descriptif du site officiel de l\'éditeur, sa très étrange page de précommande se permet un descriptif beaucoup plus complet, et extrêmement différent, qu\'on ne retrouve nulle part ailleurs, sur aucune plate-forme, et dans aucune communication officielle de Nintendo…', '../ressources/images/1681396061-9255-capture-d-ecran.png', 2, '2023-01-04 22:53:18', NULL, 'Lorem Ipsum is therefore always free from repetition, injected ', 1, NULL, NULL),
(8, 'Java inheritance', 'Inheritance in Java is a concept that acquires the properties from one class to other classes; for example, the relationship between father and son. Inheritance in Java is a process of acquiring all the behaviours of a parent object.', '../ressources/images/9-Years-of-Shadows-poster.jpg', 3, '2023-01-12 00:00:00', 2, 'Inheritance in Java is a concept that acquires the properties from one class to other classes; for example, the relationship between father and son. Inheritance in Java is a process of acquiring all the behaviours of a parent object.', NULL, NULL, NULL),
(10, 'Syntaxe de base', 'Pour simplifier, une expression régulière est une suite de caractères normaux et de caractères spéciaux. Cette suite de caractère constitue un masque que l’on va ensuite appliquer à une chaîne pour trouver les occurences correspondant à ce masque.', '../ressources/images/godofwarragnarok-00173.jpg', 3, '2023-01-08 00:00:00', NULL, 'Pour simplifier, une expression régulière est une suite de caractères normaux et de caractères spéciaux. Cette suite de caractère constitue un masque que l’on va ensuite appliquer à une chaîne pour trouver les occurences correspondant à ce masque.', 3, NULL, NULL),
(14, 'Diablo IV beta success', 'Inheritance in Java is a concept that acquires the properties from one class to other classes; for example, the relationship between father and son. Inheritance in Java is a process of acquiring all the behaviours of a parent object.', '../ressources/images/diablo-4_6082669.webp', 3, '2023-01-09 00:00:00', 1, 'When is the release date for Diablo season 4? The Diablo franchise has offered the gaming community some top-quality games. Diablo 3: Reaper of Souls, in particular, has kept its player base strong even after all these years.', NULL, NULL, NULL),
(16, 'Wesh !', 'l faut évaluer l’importance de la cardinalité minimale à 0 (zéro de chaque côté).\nSi le pourcentage d’animateurs qui n’animent pas est peu important, on traitera le 0 comme un 1 en plaçant une clé étrangère dans\nla table « Activité culturelle ».', '../ressources/images/super-mario-bros-movie-second-trailer.jpeg', 3, '2023-01-15 22:55:41', NULL, 'l faut évaluer l’importance de la cardinalité minimale à 0 (zéro de chaque côté).\nSi le pourcentage d’animateurs qui n’animent pas est peu important, on traitera le 0 comme un 1 en plaçant une clé étrangère dans\nla table « Activité culturelle ».', 2, NULL, NULL),
(17, 'Nino Kuni', 'blablabla', '../ressources/images/Ni-No-Kuni-II-Poster.jpg', 3, '2023-01-25 00:00:00', 4, 'Ni No Kuni II: Revenant Kingdom is a hybrid JRPG and city management simulator created by Level-5 and released worldwide on March 23rd, 2018, by Bandai Namco and Level-5. In many ways, this is one of the most original JRPGs put out in years.', NULL, NULL, NULL),
(18, 'Guild wars 2', 'blablabla', '../ressources/images/guild-wars-3-unreal-engine-5-580x334.jpg', 3, '2023-02-02 18:40:17', NULL, NULL, NULL, NULL, NULL),
(19, 'Dead space', 'blablabla', '../ressources/images/Fd0ADFrXoAIQ9qY-889x500.jpg', 3, '2023-02-12 00:00:00', NULL, NULL, NULL, NULL, NULL),
(20, 'Forspoken', 'blablabla', '../ressources/images/411390_638a0ff36c100.jpg', 3, '2023-02-06 00:00:00', NULL, NULL, NULL, NULL, NULL),
(21, 'The Division 2', 'blablabla', '../ressources/images/k3TFCDPZ6Jtdw674AWViyW-1920-80.jpg.webp', 3, '2023-02-14 00:00:00', NULL, NULL, NULL, NULL, NULL),
(22, 'Fortnite chapter 4 season 2', 'blablabla', '../ressources/images/fort-1536x864.jpg', 3, '2023-01-18 00:00:00', 3, 'Fortnite Chapter 4 Season 2 Release Date is making fans pretty anxious given the fact that the first one that was released last year was a huge banger. In the previous installment, we saw the game release with a brand new map for the users to play within ', NULL, NULL, NULL),
(26, 'The Pokémon Company hosted a special Pokémon Presents event on February 27', 'blablabla', '../ressources/images/pokemonkeyart-1677510847194.png', 3, '2023-02-23 00:00:00', NULL, NULL, NULL, NULL, NULL),
(29, 'Apex c\'est génial', 'Saveurs d’antan “Quand nous avons commencé ce projet, nous voulions créer quelque chose qui ravive notre amour pour ce jeu de tir arcade au rythme effrené” nous explique Mark Rubin, producteur exécutif du projet, lors d’un événement réservé à la presse. L’objectif d’Ubisoft : créer un FPS qui soit “fluide | propre”, via des mouvements “qui ne donnent pas l’impression d’être complexes”. Sans oublier les factions, qui offrent à chaque fois un attribut passif, deux compétences actives (il faut en choisir une avant de partir au combat), un coup ultime. Lors de son lancement en bêta fermée le 14 avril 2023, XDefiant proposera 5 classes, 14 cartes, 24 armes (avec 44 accessoires en prime) ainsi que 5 modes de jeu.', '../ressources/images/elden-ring-889x500.jpg', 3, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL),
(30, 'New wolrd meilleur MMO 2023', 'Direction 2024\r\n\r\nRocksteady n\'est pas n\'importe quel studio : la firme anglaise a tout de même cassé les codes du jeu de superhéros et même du jeu d\'action avec ses Batman Arkham, véritables pépites adorées de la communauté vidéoludique. Et c\'est bien pour cela que Suicide Squad : Kill the Justice League est attendu au tournant : voilà bientôt neuf ans que le dernier jeu de l\'entreprise est sorti… et ça commence à bien faire.', '../ressources/images/Fd0ADFrXoAIQ9qY-889x500.jpg', 3, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL),
(31, 'Superman apperçu à Paris', 'Cette approche souffre de deux inconvénients :\r\n\r\nC\'est long à écrire ; surtout lorsque l\'on doit l\'utiliser en de nombreux endroits dans notre code source, ce qui est souvent le cas[1].\r\nLe chemin vers le répertoire du fichier est calculé à l\'exécution de la portion de code ; ce qui est coûteux, en terme de performances.\r\n\r\nPour répondre à ce besoin, en évitant les problèmes posés par la solution à base de dirname, PHP 5.3 introduit une nouvelle constante magique : __DIR__.\r\nCelle-ci vaut exactement la même chose que dirname(__FILE__), mais évite les deux problèmes soulevés plus haut :\r\n\r\nElle ne fait que quelques caractères : elle est donc plus rapide à saisir, et diminue le risque de fautes de frappe,\r\nEt elle est calculée à la compilation du code, entrainant un gain au niveau des performances par rapport à la première version.', '../ressources/images/High-on-Life.jpg', 3, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, '<p>Cette approche souffre de deux inconv&eacute;nients&nbsp;:</p>\r\n<ul>\r\n<li>C\'est long &agrave; &eacute;crire&nbsp;; surtout lorsque l\'on doit l\'utiliser en de nombreux endroits dans notre code source, ce qui est souvent le cas<sup>[<a id=\"rev-wiki-footnote-1\" href=\"https://blog.pascal-martin.fr/post/php-5.3-constante-magique-__dir__/#wiki-footnote-1\">1</a>]</sup>.</li>\r\n<li>Le chemin vers le r&eacute;pertoire du fichier est calcul&eacute; &agrave; l\'ex&eacute;cution de la portion de code&nbsp;; ce qui est co&ucirc;teux, en terme de performances.</li>\r\n</ul>\r\n<p>Pour r&eacute;pondre &agrave; ce besoin, en &eacute;vitant les probl&egrave;mes pos&eacute;s par la solution &agrave; base de <code>dirname</code>, PHP 5.3 introduit une nouvelle constante magique&nbsp;: <code>__DIR__</code>. <br>Celle-ci vaut exactement la m&ecirc;me chose que <code>dirname(__FILE__)</code>, mais &eacute;vite les deux probl&egrave;mes soulev&eacute;s plus haut&nbsp;:</p>\r\n<ul>\r\n<li>Elle ne fait que quelques caract&egrave;res&nbsp;: elle est donc plus rapide &agrave; saisir, et diminue le risque de fautes de frappe,</li>\r\n<li>Et elle est calcul&eacute;e &agrave; la compilation du code, entrainant un gain au niveau des performances par rapport &agrave; la premi&egrave;re version.</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE IF NOT EXISTS `discussions` (
  `id_discussions` int NOT NULL AUTO_INCREMENT,
  `discussions_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_discussions`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`id_discussions`, `discussions_name`) VALUES
(4, 'Paradise'),
(16, 'Warzone top1'),
(17, 'Tower of fantasy'),
(18, 'DWWM'),
(19, 'Dead space');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_messages` int NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `text_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discussions_id_messages` int NOT NULL,
  `user_id_messages` int NOT NULL,
  PRIMARY KEY (`id_messages`),
  KEY `fk_user_id_messages` (`user_id_messages`),
  KEY `fk_discussions_id_messages` (`discussions_id_messages`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pwd` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'UNIQUE',
  `user_rights` tinyint NOT NULL,
  `birthdate` date NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `pwd`, `email`, `user_rights`, `birthdate`, `avatar`) VALUES
(2, 'Anahitsu', 'Anaelle', 'undefined', '$2y$10$PvRVfuPzSj4AUJH5Z.0MQuq15qcllYj7Z038.34aeq5fPxYD4PRhW', 'anaelle.vivet@imie-paris.fr', 0, '2003-04-15', '../ressources/images/anahitsu-avatar.png'),
(3, 'Davdiii', 'David', 'dev@dev', '$2y$10$t3uv/Iqu.9mpEHw6Dp7zGuK9s16A0T3WzqZ8Ido.OceSOATNzCblC', 'davidc123@gmail.com', 1, '1987-09-25', '../ressources/images/davdiii-avatar.png'),
(4, 'Brrrrr', 'Brian', 'GigaChad', '$2y$10$LEQ4/u.WHAs682U5CrT5uuftn2ms0UP6PcZFcv5mWk6xrbwEiHF1W', 'pioupiou@gmail.com', 0, '1996-04-11', '../ressources/images/brrrrr-avatar.png'),
(7, 'GTR_92', 'Alexi', 'Goncalves', '$2y$10$A37ApQ4sYSci04I749Hhk.e2uoWYyOsd6CsVQAhKR/O7MHiZwgL2a', 'postman@free.fr', 0, '2004-04-01', '../ressources/images/gtr_92-avatar.png'),
(13, 'Edz', 'Eden', 'Labosse', '$2y$10$IX.GJQJKQqMTUJNcjNBwGOljA9p7PzPnA8oOIHXrGLo7q84Shz/h2', 'edz123@gmail.com', 0, '2023-04-03', '../ressources/images/discussion_icon.png');

-- --------------------------------------------------------

--
-- Structure de la table `user_discussions`
--

DROP TABLE IF EXISTS `user_discussions`;
CREATE TABLE IF NOT EXISTS `user_discussions` (
  `user_id_discussions` int NOT NULL,
  `discussions_id` int NOT NULL,
  `creator` tinyint NOT NULL,
  PRIMARY KEY (`user_id_discussions`,`discussions_id`),
  KEY `fk_discussions_id` (`discussions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_discussions`
--

INSERT INTO `user_discussions` (`user_id_discussions`, `discussions_id`, `creator`) VALUES
(2, 17, 0),
(2, 18, 0),
(3, 17, 0),
(3, 18, 1),
(3, 19, 1),
(4, 18, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;
CREATE TABLE IF NOT EXISTS `user_friends` (
  `user_id_friends` int NOT NULL,
  `friend_id` int NOT NULL,
  `friend_invite` tinyint NOT NULL,
  PRIMARY KEY (`user_id_friends`,`friend_id`),
  KEY `fk_friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_friends`
--

INSERT INTO `user_friends` (`user_id_friends`, `friend_id`, `friend_invite`) VALUES
(3, 2, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id_articles`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_discussions_id_messages` FOREIGN KEY (`discussions_id_messages`) REFERENCES `discussions` (`id_discussions`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_messages` FOREIGN KEY (`user_id_messages`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_discussions`
--
ALTER TABLE `user_discussions`
  ADD CONSTRAINT `fk_discussions_id` FOREIGN KEY (`discussions_id`) REFERENCES `discussions` (`id_discussions`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_discussions` FOREIGN KEY (`user_id_discussions`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user_friends`
--
ALTER TABLE `user_friends`
  ADD CONSTRAINT `fk_friend_id` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id_friends`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
