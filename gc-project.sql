-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 22 jan. 2023 à 15:39
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

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

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `articles_name` varchar(45) NOT NULL,
  `text_content` text DEFAULT NULL,
  `media_content` varchar(45) DEFAULT NULL,
  `user_id_articles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `articles_name`, `text_content`, `media_content`, `user_id_articles`) VALUES
(7, 'Les expressions régulière en PHP', NULL, NULL, 2),
(8, 'Java inheritance', 'Inheritance in Java is a concept that acquires the properties from one class to other classes; for example, the relationship between father and son. Inheritance in Java is a process of acquiring all the behaviours of a parent object.', NULL, 3),
(10, 'Syntaxe de base', 'Pour simplifier, une expression régulière est une suite de caractères normaux et de caractères spéciaux. Cette suite de caractère constitue un masque que l’on va ensuite appliquer à une chaîne pour trouver les occurences correspondant à ce masque.', NULL, 3),
(13, 'Le MCD', 'l faut évaluer l’importance de la cardinalité minimale à 0 (zéro de chaque côté).\nSi le pourcentage d’animateurs qui n’animent pas est peu important, on traitera le 0 comme un 1 en plaçant une clé étrangère dans\nla table « Activité culturelle ».', NULL, 3),
(14, 'Warzone du weekend', 'Les expressions régulières (aussi appellées regexp [1]) sont l’outil idéal pour manipuler des données. Elles permettent, à partir d’un masque (pattern en anglais), de trouver les différentes parties d’une chaîne de caractères correspondant à ce masque.', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
  `id_discussions` int(11) NOT NULL,
  `discussions_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`id_discussions`, `discussions_name`) VALUES
(4, 'Warzone de la semaine');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_messages` int(11) NOT NULL,
  `date_time` datetime DEFAULT current_timestamp(),
  `text_content` text NOT NULL,
  `discussions_id_messages` int(11) NOT NULL,
  `user_id_messages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `pwd` varchar(90) NOT NULL,
  `email` varchar(80) NOT NULL COMMENT 'UNIQUE',
  `user_rights` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `pwd`, `email`, `user_rights`) VALUES
(2, 'Anahitsu', 'Anaelle', 'LaBosse', '$2y$10$PvRVfuPzSj4AUJH5Z.0MQuq15qcllYj7Z038.34aeq5fPxYD4PRhW', 'anaelle.vivet@imie-paris.fr', 0),
(3, 'chapplone', 'Dav', 'LeBosse', '$2y$10$t3uv/Iqu.9mpEHw6Dp7zGuK9s16A0T3WzqZ8Ido.OceSOATNzCblC', 'davidc123@gmail.com', 1),
(4, 'DavdiiiStream', 'Malek', 'tripleBosse', '$2y$10$2./BEGW/BfJJxdrmGHNGBOaRE6KxwSgoiCG8Vy3JV9xmkGB7pMHm.', 'Malek_azuri1235@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_discussions`
--

CREATE TABLE `user_discussions` (
  `user_id_discussions` int(11) NOT NULL,
  `discussions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_friends`
--

CREATE TABLE `user_friends` (
  `user_id_friends` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `friend_invite` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_ibfk_1` (`user_id_articles`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id_discussions`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_messages`),
  ADD KEY `fk_user_id_messages` (`user_id_messages`),
  ADD KEY `fk_discussions_id_messages` (`discussions_id_messages`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_discussions`
--
ALTER TABLE `user_discussions`
  ADD PRIMARY KEY (`user_id_discussions`,`discussions_id`),
  ADD KEY `fk_discussions_id` (`discussions_id`);

--
-- Index pour la table `user_friends`
--
ALTER TABLE `user_friends`
  ADD PRIMARY KEY (`user_id_friends`,`friend_id`),
  ADD KEY `fk_friend_id` (`friend_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id_discussions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `fk_user_id_discussions` FOREIGN KEY (`user_id_discussions`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
