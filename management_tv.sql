-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 13 mai 2022 à 18:49
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `management_tv`
--

-- -------------------------------------------------------

--
-- Structure de la table `categoriecsa`
--

CREATE TABLE `categoriecsa` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categoriecsa`
--

INSERT INTO `categoriecsa` (`id`, `libelle`) VALUES
(1, 'Tout public'),
(2, '-10'),
(3, '-12'),
(4, '-16'),
(5, '-18');

-- --------------------------------------------------------

--
-- Structure de la table `diffusion`
--

CREATE TABLE `diffusion` (
  `id` int(11) NOT NULL,
  `lejour` date NOT NULL,
  `horaire` time NOT NULL,
  `direct` tinyint(1) NOT NULL,
  `id_programme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `diffusion`
--

INSERT INTO `diffusion` (`id`, `lejour`, `horaire`, `direct`, `id_programme_id`) VALUES
(1, '2017-05-19', '21:00:00', 0, 1),
(2, '2018-07-15', '17:00:00', 1, 2),
(3, '2016-01-13', '21:00:00', 0, 3),
(4, '2022-05-08', '21:00:00', 0, 4),
(5, '2010-01-01', '20:00:00', 1, 5),
(6, '2017-05-26', '21:00:00', 0, 6),
(7, '2021-11-26', '21:00:00', 0, 7),
(8, '2019-07-15', '21:00:00', 0, 2),
(9, '2010-10-30', '12:00:00', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220316155751', '2022-04-13 14:09:37', 204),
('DoctrineMigrations\\Version20220316163014', '2022-04-13 14:09:38', 73),
('DoctrineMigrations\\Version20220316163303', '2022-04-13 14:09:38', 87),
('DoctrineMigrations\\Version20220316165318', '2022-04-13 14:09:38', 134),
('DoctrineMigrations\\Version20220316165637', '2022-04-13 14:09:38', 83),
('DoctrineMigrations\\Version20220321073903', '2022-04-13 14:09:38', 83),
('DoctrineMigrations\\Version20220407152520', '2022-04-13 14:09:38', 0);

-- --------------------------------------------------------

--
-- Structure de la table `emission`
--

CREATE TABLE `emission` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titreoriginal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anneproduction` date NOT NULL,
  `numsaison` int(11) DEFAULT NULL,
  `id_genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emission`
--

INSERT INTO `emission` (`id`, `titre`, `titreoriginal`, `anneproduction`, `numsaison`, `id_genre_id`) VALUES
(1, 'Top Chef', 'Top Chef - S1', '2014-03-10', 1, 1),
(2, 'Final CDM 2018', 'Final CDM 2018', '2018-07-15', NULL, 2),
(3, 'James Bond', 'James Bond', '2006-06-21', NULL, 3),
(4, 'Doctor Strange', 'Doctor Strange', '2015-08-09', NULL, 4),
(5, 'Journal de 20 heures', 'Journal de 20 heures', '2010-01-01', 1, 5),
(6, 'Les 12 coups de midi', 'Les 12 coups de midi - S1', '2010-10-17', 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `libelle`) VALUES
(1, 'Cuisine'),
(2, 'Football'),
(3, 'Film d\'action'),
(4, 'Super-héros'),
(5, 'Actualité'),
(6, 'Jeu télévisé');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` bigint(20) NOT NULL,
  `id_emission_id` int(11) NOT NULL,
  `id_categoriecsa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`id`, `titre`, `duree`, `id_emission_id`, `id_categoriecsa_id`) VALUES
(1, 'Top Chef - S1 E1', 150, 1, 1),
(2, 'Final CDM 2018', 90, 2, 1),
(3, 'Casino Royale', 144, 3, 3),
(4, 'Doctor Strange 1', 115, 4, 1),
(5, 'Journal de 20h du 01-01-2010', 44, 5, 1),
(6, 'Top Chef - S1 E2', 140, 1, 1),
(7, '007 Spectre', 148, 3, 3),
(8, 'Les 12 coups de midi - S1 E1', 42, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'axel', '[\"ROLE_USER\"]', '$2y$13$WwNZtSQakeDgJGulF7lwmO3kzahOa3erYrJoyKk3E1KYidrPmuscC'),
(2, 'axelEditor', '[\"ROLE_USER\", \"ROLE_EDITOR\"]', '$2y$13$oCbOprs1znkvFcFnXx3Mpu54VqlAlnbS5oeSO7L9KMZkAsmwyodpO'),
(3, 'axelAdmin', '[\"ROLE_USER\", \"ROLE_EDITOR\", \"ROLE_ADMIN\"]', '$2y$13$wHrFfUSPt7dRNumsBkZFNuJ6CicXL5SHTStjZjz0JpOtQ0AdCwxOS');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categoriecsa`
--
ALTER TABLE `categoriecsa`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `diffusion`
--
ALTER TABLE `diffusion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5938415B417A0F9C` (`id_programme_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `emission`
--
ALTER TABLE `emission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F0225CF4124D3F8A` (`id_genre_id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3DDCB9FFFF08087` (`id_emission_id`),
  ADD KEY `IDX_3DDCB9FFD5408C8` (`id_categoriecsa_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categoriecsa`
--
ALTER TABLE `categoriecsa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `diffusion`
--
ALTER TABLE `diffusion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `emission`
--
ALTER TABLE `emission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `diffusion`
--
ALTER TABLE `diffusion`
  ADD CONSTRAINT `FK_5938415B417A0F9C` FOREIGN KEY (`id_programme_id`) REFERENCES `programme` (`id`);

--
-- Contraintes pour la table `emission`
--
ALTER TABLE `emission`
  ADD CONSTRAINT `FK_F0225CF4124D3F8A` FOREIGN KEY (`id_genre_id`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `FK_3DDCB9FFD5408C8` FOREIGN KEY (`id_categoriecsa_id`) REFERENCES `categoriecsa` (`id`),
  ADD CONSTRAINT `FK_3DDCB9FFFF08087` FOREIGN KEY (`id_emission_id`) REFERENCES `emission` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
