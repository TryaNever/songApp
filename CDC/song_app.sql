-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 09 avr. 2025 à 14:36
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `song_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `libelle_categorie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Rap');

-- --------------------------------------------------------

--
-- Structure de la table `chanson`
--

CREATE TABLE `chanson` (
  `id_chanson` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `date` date DEFAULT NULL,
  `id_chanteur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chanson`
--

INSERT INTO `chanson` (`id_chanson`, `titre`, `date`, `id_chanteur`, `id_categorie`) VALUES
(1, 'popopo', '2018-09-24', 1, 1),
(2, 'poooooop', '2018-02-24', 3, 1),
(3, 'RockRock', '2017-02-24', 2, 2),
(4, 'Rockkkkkk', '2017-08-24', 1, 2),
(5, 'RapRapRap', '2017-08-12', 2, 3),
(6, 'Rapppppppp', '2012-08-12', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `chanteur`
--

CREATE TABLE `chanteur` (
  `id_chanteur` int(11) NOT NULL,
  `nom_chanteur` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chanteur`
--

INSERT INTO `chanteur` (`id_chanteur`, `nom_chanteur`) VALUES
(1, 'nathan'),
(2, 'gustave'),
(3, 'thibault');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `chanson`
--
ALTER TABLE `chanson`
  ADD PRIMARY KEY (`id_chanson`),
  ADD UNIQUE KEY `id_chanson` (`id_chanson`),
  ADD KEY `id_chanteur` (`id_chanteur`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `chanteur`
--
ALTER TABLE `chanteur`
  ADD PRIMARY KEY (`id_chanteur`),
  ADD UNIQUE KEY `id_chanteur` (`id_chanteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `chanson`
--
ALTER TABLE `chanson`
  MODIFY `id_chanson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `chanteur`
--
ALTER TABLE `chanteur`
  MODIFY `id_chanteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chanson`
--
ALTER TABLE `chanson`
  ADD CONSTRAINT `chanson_ibfk_1` FOREIGN KEY (`id_chanteur`) REFERENCES `chanteur` (`id_chanteur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chanson_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
