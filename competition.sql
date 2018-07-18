-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 18 Juillet 2018 à 09:38
-- Version du serveur :  5.7.22-0ubuntu0.17.10.1
-- Version de PHP :  7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `competition`
--

-- --------------------------------------------------------

--
-- Structure de la table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `competition`
--

INSERT INTO `competition` (`id`, `nom`) VALUES
(1, 'Mondial');

-- --------------------------------------------------------

--
-- Structure de la table `duel`
--

CREATE TABLE `duel` (
  `id` int(11) NOT NULL,
  `typeduel_id` int(11) NOT NULL,
  `equipe1_id` int(11) NOT NULL,
  `equipe2_id` int(11) NOT NULL,
  `horaire` datetime DEFAULT NULL,
  `score_equipe1` int(11) DEFAULT NULL,
  `score_equipe2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `duel`
--

INSERT INTO `duel` (`id`, `typeduel_id`, `equipe1_id`, `equipe2_id`, `horaire`, `score_equipe1`, `score_equipe2`) VALUES
(121, 1, 7, 13, '2017-01-11 20:45:00', 16, 31),
(122, 1, 7, 16, '2017-01-15 20:45:00', 27, 24),
(123, 1, 7, 18, '2017-01-17 14:00:00', 26, 39),
(124, 1, 7, 19, '2017-01-14 14:45:00', 28, 24),
(125, 1, 7, 21, '2017-01-19 14:00:00', 24, 28),
(126, 1, 13, 16, '2017-01-13 17:45:00', 31, 19),
(127, 1, 13, 18, '2017-01-15 17:45:00', 31, 28),
(128, 1, 13, 19, '2017-01-19 17:45:00', 26, 25),
(129, 1, 13, 21, '2017-01-17 20:45:00', 35, 24),
(130, 1, 16, 18, '2017-01-19 20:45:00', 23, 38),
(131, 1, 16, 19, '2017-01-17 17:45:00', 25, 26),
(132, 1, 16, 21, '2017-01-12 17:45:00', 29, 39),
(133, 1, 18, 19, '2017-01-12 20:45:00', 22, 20),
(134, 1, 18, 21, '2017-01-14 17:45:00', 28, 24),
(135, 1, 19, 21, '2017-01-16 20:45:00', 20, 24),
(136, 1, 2, 12, '2017-01-16 20:45:00', 22, 42),
(137, 1, 2, 15, '2017-01-17 20:45:00', 19, 33),
(138, 1, 2, 17, '2017-01-14 20:45:00', 22, 31),
(139, 1, 2, 22, '2017-01-14 14:00:00', 25, 42),
(140, 1, 2, 24, '2017-01-19 14:00:00', 34, 43),
(141, 1, 12, 15, NULL, NULL, NULL),
(142, 1, 12, 17, NULL, NULL, NULL),
(143, 1, 12, 22, NULL, NULL, NULL),
(144, 1, 12, 24, NULL, NULL, NULL),
(145, 1, 15, 17, NULL, NULL, NULL),
(146, 1, 15, 22, NULL, NULL, NULL),
(147, 1, 15, 24, NULL, NULL, NULL),
(148, 1, 17, 22, NULL, NULL, NULL),
(149, 1, 17, 24, NULL, NULL, NULL),
(150, 1, 22, 24, NULL, NULL, NULL),
(151, 1, 1, 3, NULL, NULL, NULL),
(152, 1, 1, 6, NULL, NULL, NULL),
(153, 1, 1, 8, NULL, NULL, NULL),
(154, 1, 1, 9, NULL, NULL, NULL),
(155, 1, 1, 14, NULL, NULL, NULL),
(156, 1, 3, 6, NULL, NULL, NULL),
(157, 1, 3, 8, NULL, NULL, NULL),
(158, 1, 3, 9, NULL, NULL, NULL),
(159, 1, 3, 14, NULL, NULL, NULL),
(160, 1, 6, 8, NULL, NULL, NULL),
(161, 1, 6, 9, NULL, NULL, NULL),
(162, 1, 6, 14, NULL, NULL, NULL),
(163, 1, 8, 9, NULL, NULL, NULL),
(164, 1, 8, 14, NULL, NULL, NULL),
(165, 1, 9, 14, NULL, NULL, NULL),
(166, 1, 4, 5, NULL, NULL, NULL),
(167, 1, 4, 10, NULL, NULL, NULL),
(168, 1, 4, 11, NULL, NULL, NULL),
(169, 1, 4, 20, NULL, NULL, NULL),
(170, 1, 4, 23, NULL, NULL, NULL),
(171, 1, 5, 10, NULL, NULL, NULL),
(172, 1, 5, 11, NULL, NULL, NULL),
(173, 1, 5, 20, NULL, NULL, NULL),
(174, 1, 5, 23, NULL, NULL, NULL),
(175, 1, 10, 11, NULL, NULL, NULL),
(176, 1, 10, 20, NULL, NULL, NULL),
(177, 1, 10, 23, NULL, NULL, NULL),
(178, 1, 11, 20, NULL, NULL, NULL),
(179, 1, 11, 23, NULL, NULL, NULL),
(180, 1, 20, 23, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`id`, `nom`, `pays`) VALUES
(1, 'Allemagne', 'Allemagne'),
(2, 'Angola', 'Angola'),
(3, 'Arabie saoudite', 'Arabie saoudite'),
(4, 'Argentine', 'Argentine'),
(5, 'Bahreïn', 'Bahreïn'),
(6, 'Biélorussie', 'Biélorussie'),
(7, 'Brésil', 'Brésil'),
(8, 'Chili', 'Chili'),
(9, 'Croatie', 'Croatie'),
(10, 'Danemark', 'Danemark'),
(11, 'Égypte', 'Égypte'),
(12, 'Espagne', 'Espagne'),
(13, 'France', 'France'),
(14, 'Hongrie', 'Hongrie'),
(15, 'Islande', 'Islande'),
(16, 'Japon', 'Japon'),
(17, 'Macédoine', 'Macédoine'),
(18, 'Norvège', 'Norvège'),
(19, 'Pologne', 'Pologne'),
(20, 'Qatar', 'Qatar'),
(21, 'Russie', 'Russie'),
(22, 'Slovénie', 'Slovénie'),
(23, 'Suède', 'Suède'),
(24, 'Tunisie', 'Tunisie');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `competition_id`, `nom`) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 1, 'C'),
(4, 1, 'D');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_equipe`
--

CREATE TABLE `groupe_equipe` (
  `groupe_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `groupe_equipe`
--

INSERT INTO `groupe_equipe` (`groupe_id`, `equipe_id`) VALUES
(1, 7),
(1, 13),
(1, 16),
(1, 18),
(1, 19),
(1, 21),
(2, 2),
(2, 12),
(2, 15),
(2, 17),
(2, 22),
(2, 24),
(3, 1),
(3, 3),
(3, 6),
(3, 8),
(3, 9),
(3, 14),
(4, 4),
(4, 5),
(4, 10),
(4, 11),
(4, 20),
(4, 23);

-- --------------------------------------------------------

--
-- Structure de la table `type_duel`
--

CREATE TABLE `type_duel` (
  `id` int(11) NOT NULL,
  `type_duel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_type_duel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `type_duel`
--

INSERT INTO `type_duel` (`id`, `type_duel`, `code_type_duel`) VALUES
(1, 'Poule', 'PO'),
(2, 'Huitièmes de finale', '8F'),
(3, 'Quarts de finale', '4F'),
(4, 'Demi-finales', '2F'),
(5, 'Finale', '1F');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `duel`
--
ALTER TABLE `duel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9BB4A762DABC0BE5` (`typeduel_id`),
  ADD KEY `IDX_9BB4A7624265900C` (`equipe1_id`),
  ADD KEY `IDX_9BB4A76250D03FE2` (`equipe2_id`);

--
-- Index pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B98C217B39D312` (`competition_id`);

--
-- Index pour la table `groupe_equipe`
--
ALTER TABLE `groupe_equipe`
  ADD PRIMARY KEY (`groupe_id`,`equipe_id`),
  ADD KEY `IDX_4F77462F7A45358C` (`groupe_id`),
  ADD KEY `IDX_4F77462F6D861B89` (`equipe_id`);

--
-- Index pour la table `type_duel`
--
ALTER TABLE `type_duel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `duel`
--
ALTER TABLE `duel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT pour la table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `type_duel`
--
ALTER TABLE `type_duel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `duel`
--
ALTER TABLE `duel`
  ADD CONSTRAINT `FK_9BB4A7624265900C` FOREIGN KEY (`equipe1_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_9BB4A76250D03FE2` FOREIGN KEY (`equipe2_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_9BB4A762DABC0BE5` FOREIGN KEY (`typeduel_id`) REFERENCES `type_duel` (`id`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `FK_4B98C217B39D312` FOREIGN KEY (`competition_id`) REFERENCES `competition` (`id`);

--
-- Contraintes pour la table `groupe_equipe`
--
ALTER TABLE `groupe_equipe`
  ADD CONSTRAINT `FK_4F77462F6D861B89` FOREIGN KEY (`equipe_id`) REFERENCES `equipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4F77462F7A45358C` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
