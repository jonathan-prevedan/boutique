-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 11 juin 2020 à 21:48
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `commentaire`, `id_produits`, `id_users`, `date`) VALUES
(1, 'dddd', 2, 4, '2020-05-07'),
(2, 'qdf', 2, 4, '2020-05-07');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `nom_barre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `nom_barre`) VALUES
(3, 'test', 'test'),
(4, 'test2', 'test2');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `adresse` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `h` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `id_produits`, `chemin`, `h`, `l`) VALUES
(2, 2, '../img/T4ladwgMeE.jpg', 200, 200),
(3, 3, '../img/SUvzsQdIzc.jpg', 200, 200);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_utilisateurs`, `id_produits`, `quantite`, `prix`) VALUES
(4, 4, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_souscat` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `id_categorie`, `id_souscat`, `description`, `prix`) VALUES
(2, 'a', 3, 1, 'a', 1),
(3, 'Vapormax', 3, 1, 'Vapormax aka la legerete', 200);

-- --------------------------------------------------------

--
-- Structure de la table `souscat`
--

DROP TABLE IF EXISTS `souscat`;
CREATE TABLE IF NOT EXISTS `souscat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  `h` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscat`
--

INSERT INTO `souscat` (`id`, `nom`, `chemin`, `h`, `l`) VALUES
(1, 't', '../img/3dUMuVSoUB.jpg', 200, 200),
(2, 'test', '../img/K2F18ZLSoY.jpg', 200, 200),
(3, 'kok', '../img/xuJ5453F15.jpg', 200, 200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `droit` varchar(255) NOT NULL DEFAULT 'visitor',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nom`, `prenom`, `email`, `droit`) VALUES
(5, 'Jon', '$2y$10$/U0aTjivvcmwlVdddfFg1ePePc2HyrEchokqhnmWhr9AzSasTOXs6', 'jon', 'jon', 'jon@jon.fr', 'visitor'),
(4, 'a', '$2y$10$llQ6SOhxSbBvFULRYmN1F.aCbCRYb4oRHE8rD0mvOLSbyQvrLLRYO', 'abc', 'a', 'admin@admin.com', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
