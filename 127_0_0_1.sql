-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mai 2024 à 11:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parc_auto`
--
CREATE DATABASE IF NOT EXISTS `parc_auto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `parc_auto`;

-- --------------------------------------------------------

--
-- Structure de la table `bc`
--

DROP TABLE IF EXISTS `bc`;
CREATE TABLE IF NOT EXISTS `bc` (
  `num_bc` int(11) NOT NULL,
  `untite_naftal` int(25) NOT NULL,
  `date_bc` date NOT NULL,
  `n_magasin` int(25) NOT NULL,
  `num` int(5) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`num_bc`),
  KEY `num` (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `bc`:
--   `num`
--       `demande_i` -> `num`
--

--
-- Déchargement des données de la table `bc`
--

INSERT INTO `bc` (`num_bc`, `untite_naftal`, `date_bc`, `n_magasin`, `num`, `date_insertion`) VALUES
(33, 4444444, '2024-05-08', 3444, 100009, '2024-05-18 10:55:33');

-- --------------------------------------------------------

--
-- Structure de la table `demande_i`
--

DROP TABLE IF EXISTS `demande_i`;
CREATE TABLE IF NOT EXISTS `demande_i` (
  `num` int(10) NOT NULL,
  `date_i` date NOT NULL,
  `type` varchar(15) NOT NULL,
  `nature` varchar(30) NOT NULL,
  `matricule_v` int(15) NOT NULL,
  `constat` varchar(25) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`num`),
  KEY `matricule_v` (`matricule_v`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `demande_i`:
--   `matricule_v`
--       `véhicule` -> `matricule_v`
--

--
-- Déchargement des données de la table `demande_i`
--

INSERT INTO `demande_i` (`num`, `date_i`, `type`, `nature`, `matricule_v`, `constat`, `date_insertion`) VALUES
(1, '2024-05-14', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(22337765, '2024-05-22', '', 'Changement de plaquette de Fre', 223344, '', '2024-05-18 10:55:33'),
(233400566, '2024-05-15', '', 'Changement de plaquette de Fre', 223344, '', '2024-05-18 10:55:33'),
(9999, '2024-05-08', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(0, '2024-05-14', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(134, '2024-05-08', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(990, '2024-05-01', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(122, '2024-05-08', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(128, '2024-05-29', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(2334, '2024-05-09', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(234, '2024-05-16', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(3667, '2024-05-16', '', 'Changement de plaquette de Fre', 223344, '', '2024-05-18 10:55:33'),
(237, '2024-05-08', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(99876, '2024-05-23', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(120093, '2024-05-15', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(10956, '2024-05-07', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(4, '2024-05-15', '', 'Changement de plaquette de Fre', 223344, '', '2024-05-18 10:55:33'),
(100009, '2024-05-01', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(99876581, '2024-05-02', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(6783450, '2024-05-29', '', 'Changement de chaine', 223344, '', '2024-05-18 10:55:33'),
(2147483647, '2024-05-16', '', 'vidange', 223344, '', '2024-05-18 10:55:33'),
(2987553, '2024-05-16', '', 'Changement de chaine', 223344, '', '2024-05-18 10:55:33'),
(209863664, '2024-05-25', '', 'Changement de plaquette de Fre', 223344, '', '2024-05-18 10:55:33'),
(9812, '2024-05-16', '', 'vidange', 223345, '', '2024-05-18 10:55:33'),
(125568, '2024-05-21', '', 'vidange', 223344, '', '2024-05-19 10:23:45');

-- --------------------------------------------------------

--
-- Structure de la table `demande_v`
--

DROP TABLE IF EXISTS `demande_v`;
CREATE TABLE IF NOT EXISTS `demande_v` (
  `id_demande` int(10) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(15) NOT NULL,
  `num_departement` int(10) NOT NULL,
  `distance` int(10) NOT NULL,
  `date_deplacement` date NOT NULL,
  `date_de_retour` date NOT NULL,
  `raison_deplacement` varchar(50) NOT NULL,
  `avec_chauffeur` varchar(1) NOT NULL,
  `flag` int(5) NOT NULL,
  `nom_prenom` varchar(15) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_demande`),
  KEY `mat_employe` (`matricule`),
  KEY `num_departement` (`num_departement`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `demande_v`:
--   `matricule`
--       `employe` -> `matricule`
--   `num_departement`
--       `departement` -> `num_departement`
--

--
-- Déchargement des données de la table `demande_v`
--

INSERT INTO `demande_v` (`id_demande`, `matricule`, `num_departement`, `distance`, `date_deplacement`, `date_de_retour`, `raison_deplacement`, `avec_chauffeur`, `flag`, `nom_prenom`, `date_insertion`) VALUES
(4, '2000003', 10, 2000, '2024-05-10', '2024-05-11', 'travaille', 'O', 4, '', '2024-05-18 10:55:33'),
(5, '2000003', 10, 10000, '2024-05-24', '2024-05-18', 'mission', 'N', 1, '', '2024-05-18 10:55:33'),
(7, '200003', 10, 233, '2024-05-14', '2024-05-08', '333', 'O', 1, '', '2024-05-18 10:55:33'),
(8, '200003', 10, 10002, '2024-05-16', '2024-05-16', '222', 'N', 2, '', '2024-05-18 10:55:33'),
(12, '123456', 10, 200, '2024-05-10', '2024-05-26', 'maladie', 'N', 2, '', '2024-05-18 10:55:33'),
(9, '200003', 10, 10000, '2024-05-17', '2024-05-24', 'work', 'N', 2, '', '2024-05-18 10:55:33'),
(10, '200003', 10, 2344, '2024-05-16', '2024-05-26', 'pinic', 'N', 1, '', '2024-05-18 10:55:33'),
(11, '123456', 10, 12334, '2024-05-15', '2024-05-19', 'work', 'N', 2, '', '2024-05-18 10:55:33'),
(13, '123456', 10, 100, '2024-05-12', '2024-05-31', 'travaille', 'O', 2, '<br />\r\n<b>Warn', '2024-05-18 10:55:33'),
(14, '123456', 10, 200, '2024-05-16', '2024-05-31', 'travaille', 'O', 0, 'gacem_meriem', '2024-05-18 10:55:33'),
(15, '123456', 10, 2233, '0000-00-00', '0000-00-00', '333333333', 'O', 0, 'gacem_meriem', '2024-05-24 00:08:47'),
(16, '123456', 10, 223, '0000-00-00', '0000-00-00', '3', 'O', 0, 'gacem_meriem', '2024-05-24 00:10:06');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `num_departement` int(10) NOT NULL,
  `nom_departement` varchar(15) NOT NULL,
  PRIMARY KEY (`num_departement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `departement`:
--

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`num_departement`, `nom_departement`) VALUES
(1, 'Ressources Huma'),
(2, 'Informatique'),
(3, 'Marketing'),
(4, 'Ventes'),
(5, 'Finance'),
(6, 'Recherche et Dé'),
(7, 'Service Client'),
(8, 'Production'),
(9, 'Logistique'),
(10, 'Qualité');

-- --------------------------------------------------------

--
-- Structure de la table `details_bc`
--

DROP TABLE IF EXISTS `details_bc`;
CREATE TABLE IF NOT EXISTS `details_bc` (
  `num_detail` int(5) NOT NULL AUTO_INCREMENT,
  `codear` int(5) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `quantite_dem` int(4) NOT NULL,
  `quantite_liv` int(4) NOT NULL,
  `observation` varchar(30) NOT NULL,
  `n_bonsortie` int(5) NOT NULL,
  `date_livraison` date NOT NULL,
  `num_bc` int(5) NOT NULL,
  PRIMARY KEY (`num_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `details_bc`:
--   `num_bc`
--       `bc` -> `num_bc`
--

--
-- Déchargement des données de la table `details_bc`
--

INSERT INTO `details_bc` (`num_detail`, `codear`, `designation`, `quantite_dem`, `quantite_liv`, `observation`, `n_bonsortie`, `date_livraison`, `num_bc`) VALUES
(1, 6666, '55555', 0, 44444444, '4444444', 2147483647, '2024-05-23', 33);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `matricule` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(40) NOT NULL,
  `adresse` varchar(25) NOT NULL,
  `telephone` int(15) NOT NULL,
  `mot_passe` varchar(10) NOT NULL,
  `role` varchar(15) NOT NULL,
  `date_recrutement` date NOT NULL,
  `fonction` varchar(10) NOT NULL,
  `num_permis` varchar(10) NOT NULL,
  `num_departement` int(10) NOT NULL,
  PRIMARY KEY (`matricule`),
  KEY `num_departement` (`num_departement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `employe`:
--   `num_departement`
--       `departement` -> `num_departement`
--

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`matricule`, `username`, `nom`, `prenom`, `date_naissance`, `email`, `adresse`, `telephone`, `mot_passe`, `role`, `date_recrutement`, `fonction`, `num_permis`, `num_departement`) VALUES
(2134567, 'aya2003', 'dechir', 'aya', '2024-04-09', 'email@gmail.com', '34cff', 8879990, 'naftal1', 'G', '0000-00-00', 'hhhhh', '12', 10),
(123456, 'mimi2003', 'gacem', 'meriem', '2014-04-17', 'gacemmeriem@gmail.co', 'Alger', 7839555, 'mimi', 'd', '0000-00-00', 'INGENIEUR ', '62399237', 10),
(23490, 'Hakim234', 'Hakim', 'mohammed', '2022-03-22', 'hakim@gmail.com', ' bab ezzouar', 555667444, 'Hakim123', 'c', '2024-05-05', 'chauffeur', '62399237', 10),
(21345677, 'alinordine', 'nordin', 'ali', '2022-03-22', 'ali@gmail.com', ' bab ezzouar', 555667644, 'nafta12', 'c', '2024-05-05', 'chauffeur', '23', 10),
(8, 'chloe.legrand', 'Legrand', 'Chloe', '1985-02-26', 'chloe.legrand@example.com', '40 rue des Fleurs, 75018 ', 1, 'Pa$$word!', 'g', '2017-01-15', 'Chef de pr', 'OP654321', 75),
(6, 'sophie.martinez', 'Martinez', 'Sophie', '1992-05-21', 'sophie.martinez@example.com', '30 avenue du Général Lecl', 1, 'S3cretPass', 'r', '2019-07-12', 'Développeu', 'KL987654', 75),
(7, 'alexandre.berna', 'Bernard', 'Alexandre', '1980-09-19', 'alexandre.bernard@example.com', '35 rue de Strasbourg, 670', 3, 'Pa$$w0rd', 'c', '2012-11-30', 'Analyste', 'MN123456', 67),
(5, 'lucas.roche', 'Roche', 'Lucas', '1987-12-08', 'lucas.roche@example.com', '25 boulevard de la Libert', 3, 'P@ssw0rd!', 'g', '2016-04-10', 'Commercial', 'IJ654321', 59),
(4, 'julie.lambert', 'Lambert', 'Julie', '1978-03-15', 'julie.lambert@example.com', '15 rue de Nice, 06000 Nic', 4, 'MyP@ssw0rd', 'c', '2013-08-25', 'Designer', 'GH123456', 6),
(3, 'pierre.martin', 'Martin', 'Pierre', '1982-07-14', 'pierre.martin@example.com', '20 rue de Lyon, 69001 Lyo', 4, 'Secret123', 'r', '2010-09-01', 'Chef de pr', 'EF987654', 69),
(2, 'marie.durand', 'Durand', 'Marie', '1990-11-02', 'marie.durand@example.com', '5 avenue de la République', 4, 'P@ssword!', 'c', '2018-03-20', 'Analyste', 'CD654321', 13),
(1, 'jean.dupont', 'Dupont', 'Jean', '1985-04-23', 'jean.dupont@example.com', '10 rue de Paris, 75001 Pa', 1, 'Passw0rd!', 'g', '2015-06-15', 'Développeu', 'AB123456', 75),
(9, 'thomas.barbe', 'Barbe', 'Thomas', '1975-10-04', 'thomas.barbe@example.com', '45 boulevard Saint-Michel', 1, 'Passw0rd!', 'r', '2011-05-10', 'Designer', 'QR987654', 75),
(10, 'emma.dubois', 'Dubois', 'Emma', '1993-07-11', 'emma.dubois@example.com', '50 avenue de l\'Opéra, 750', 1, 'MyPass123!', 'c', '2020-09-01', 'Commercial', 'ST123456', 75),
(23445, '', 'Jony', 'smith', '0000-00-00', 'USER@gmail.com', '', 0, '', 'C', '0000-00-00', '', '', 10);

-- --------------------------------------------------------

--
-- Structure de la table `ordre_mission`
--

DROP TABLE IF EXISTS `ordre_mission`;
CREATE TABLE IF NOT EXISTS `ordre_mission` (
  `id_or` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(25) NOT NULL,
  `adress_admin` varchar(15) NOT NULL,
  `emplacement` varchar(15) NOT NULL,
  `raison` varchar(30) NOT NULL,
  `matricule_v` varchar(15) NOT NULL,
  `date_dep` date NOT NULL,
  `date_ret` date NOT NULL,
  `matricule` varchar(11) NOT NULL,
  `flag` int(5) NOT NULL,
  PRIMARY KEY (`id_or`),
  KEY `matricule_v` (`matricule_v`),
  KEY `matricule` (`matricule`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `ordre_mission`:
--   `matricule`
--       `employe` -> `matricule`
--   `matricule_v`
--       `véhicule` -> `matricule_v`
--

--
-- Déchargement des données de la table `ordre_mission`
--

INSERT INTO `ordre_mission` (`id_or`, `nom_prenom`, `adress_admin`, `emplacement`, `raison`, `matricule_v`, `date_dep`, `date_ret`, `matricule`, `flag`) VALUES
(1, 'John Doe', '123 Admin Stree', 'Paris', 'Business Meeting', 'ABC123', '2024-05-20', '2024-05-25', 'XYZ789', 1),
(2, 'Jane Smith', '456 Corporate A', 'Lyon', 'Conference', 'DEF456', '2024-06-10', '2024-06-15', 'XYZ789', 1),
(3, 'Robert Johnson', '789 Executive B', 'Marseille', 'Site Visit', 'GHI789', '2024-07-01', '2024-07-05', 'XYZ789', 0),
(10, 'smith Jony', 'QSDFGHLLLLLLL', '22222222222', '222222222222222222222222222', '223344', '2024-05-07', '2024-05-01', '1', 0),
(11, 'smith Jony', 'QSDFGHLLLLLLL', '22222222222', '222222222222222222222222222', '223344', '2024-05-30', '2024-05-01', '1', 0),
(12, 'smith Jony', 'QSDFGHLLLLLLL', '22222222222', '222222222222222222222222222', '223344', '2024-05-30', '2024-05-01', '1', 0),
(13, 'Dupont Jean', 'QSDFGHLLLLLLL', '22222222222', '222222222222222222222222222', '223344', '2024-05-30', '2024-05-01', '1', 0),
(14, 'AYAAA', 'QSDFGHLLLLLLL', '22222222222', '222222222222222222222222222', '223344', '2024-05-30', '2024-05-01', '1', 0);

-- --------------------------------------------------------

--
-- Structure de la table `suivi_v`
--

DROP TABLE IF EXISTS `suivi_v`;
CREATE TABLE IF NOT EXISTS `suivi_v` (
  `id_suivi` int(11) NOT NULL AUTO_INCREMENT,
  `matricule_v` int(20) NOT NULL,
  `km_dep` int(10) NOT NULL,
  `km_ret` int(10) NOT NULL,
  `consom_car` varchar(100) NOT NULL,
  `date_s` date NOT NULL,
  PRIMARY KEY (`id_suivi`),
  KEY `matricule_v` (`matricule_v`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `suivi_v`:
--   `matricule_v`
--       `véhicule` -> `matricule_v`
--

--
-- Déchargement des données de la table `suivi_v`
--

INSERT INTO `suivi_v` (`id_suivi`, `matricule_v`, `km_dep`, `km_ret`, `consom_car`, `date_s`) VALUES
(61, 223344, 0, 2000, '23', '2024-05-08'),
(62, 223344, 0, 8000, '77', '2024-05-09'),
(63, 3334445, 0, 10000, '1000', '2024-05-23'),
(64, 223344, 0, 40000, '200', '2024-05-08'),
(65, 223344, 0, 20000, '2', '2024-05-24'),
(66, 223344, 0, 1223, '000', '2024-05-08'),
(67, 223344, 0, 200, '2999', '2024-05-15'),
(68, 223344, 0, 1000, '098', '2024-05-08'),
(69, 223344, 10000, 20000, '100', '2024-05-08'),
(70, 223344, 0, 70000, '100', '2024-05-08'),
(71, 223344, 0, 10000, '1000', '2024-05-08'),
(72, 223344, 0, 40000, '2000', '2024-05-08'),
(73, 223344, 0, 20000, '200', '2024-05-09'),
(74, 223345, 0, 10000, '11111', '2024-05-15'),
(75, 223344, 0, 60000, '2000', '2024-05-15'),
(76, 12345678, 0, 75000, '5555', '2024-05-14'),
(77, 223344, 3000, 2000, '222', '2024-05-14'),
(78, 223345, 1000, 2000, '200', '2024-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `traitement_cv`
--

DROP TABLE IF EXISTS `traitement_cv`;
CREATE TABLE IF NOT EXISTS `traitement_cv` (
  `id_traitement` int(10) NOT NULL AUTO_INCREMENT,
  `id_demande` int(10) NOT NULL,
  `matricule_chauff` int(11) NOT NULL,
  `matricule_v` int(11) NOT NULL,
  PRIMARY KEY (`id_traitement`),
  KEY `matricule_chauff` (`matricule_chauff`),
  KEY `matricule_v` (`matricule_v`) USING BTREE,
  KEY `id_demande` (`id_demande`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `traitement_cv`:
--   `id_demande`
--       `demande_v` -> `id_demande`
--   `matricule_chauff`
--       `employe` -> `matricule`
--   `matricule_v`
--       `véhicule` -> `matricule_v`
--

--
-- Déchargement des données de la table `traitement_cv`
--

INSERT INTO `traitement_cv` (`id_traitement`, `id_demande`, `matricule_chauff`, `matricule_v`) VALUES
(9, 5, 23490, 12345678),
(10, 7, 21345677, 223345);

-- --------------------------------------------------------

--
-- Structure de la table `véhicule`
--

DROP TABLE IF EXISTS `véhicule`;
CREATE TABLE IF NOT EXISTS `véhicule` (
  `matricule_v` int(10) NOT NULL,
  `marque` varchar(15) NOT NULL,
  `modele` int(10) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `puissance` int(10) NOT NULL,
  `anne_v` date NOT NULL,
  `couleur` varchar(10) NOT NULL,
  `km_init` int(10) NOT NULL,
  `km_actuel` int(20) NOT NULL,
  `vidange` int(10) NOT NULL,
  `chaine` int(10) NOT NULL,
  `seuil_v` int(10) NOT NULL,
  `seuil_plaquette` int(25) NOT NULL,
  `seuil_pch` int(10) NOT NULL,
  PRIMARY KEY (`matricule_v`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `véhicule`:
--

--
-- Déchargement des données de la table `véhicule`
--

INSERT INTO `véhicule` (`matricule_v`, `marque`, `modele`, `flag`, `puissance`, `anne_v`, `couleur`, `km_init`, `km_actuel`, `vidange`, `chaine`, `seuil_v`, `seuil_plaquette`, `seuil_pch`) VALUES
(223344, 'fiat', 500, 1, 10, '2024-04-02', 'jaune', 350000, 59000, 0, 59000, 10000, 70000, 50000),
(223345, 'fiat', 200, 1, 800, '2024-04-01', 'rouge', 10010, 11000, 1000, 11000, 10000, 70000, 50000),
(3334445, 'renault', 45, 1, 30, '2024-04-30', 'jaune', 70000, 0, 0, 0, 10000, 70000, 50000),
(12345678, 'duster', 3, 1, 30, '2024-04-30', 'vert', 0, 75000, 75000, 75000, 10000, 70000, 50000),
(2099873, 'partner', 200, 0, 0, '2024-05-17', 'gris', 50000, 0, 0, 0, 10000, 70000, 50000),
(21009983, 'clio', 12, 1, 10, '2024-05-22', 'Blanc', 10000, 0, 0, 0, 10000, 70000, 50000),
(123456, 'Renault', 0, 1, 90, '2022-12-12', 'Bleu', 10000, 15000, 15000, 15000, 15000, 50000, 30000),
(789012, 'Peugeot', 208, 1, 110, '2015-11-02', 'Blanc', 8000, 12000, 12000, 12000, 12000, 45000, 28000),
(345678, 'Volkswagen', 0, 0, 120, '2014-05-08', 'Noir', 12000, 18000, 18000, 18000, 18000, 55000, 32000),
(567890, 'Toyota', 0, 0, 85, '2020-05-05', 'Rouge', 11000, 16000, 16000, 16000, 16000, 48000, 29000);
--
-- Base de données : `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

DROP TABLE IF EXISTS `pma__bookmark`;
CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

--
-- RELATIONS POUR LA TABLE `pma__bookmark`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

DROP TABLE IF EXISTS `pma__central_columns`;
CREATE TABLE IF NOT EXISTS `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL,
  PRIMARY KEY (`db_name`,`col_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

--
-- RELATIONS POUR LA TABLE `pma__central_columns`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

DROP TABLE IF EXISTS `pma__column_info`;
CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__column_info`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__designer_settings`
--

DROP TABLE IF EXISTS `pma__designer_settings`;
CREATE TABLE IF NOT EXISTS `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- RELATIONS POUR LA TABLE `pma__designer_settings`:
--

--
-- Déchargement des données de la table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"snap_to_grid\":\"off\",\"angular_direct\":\"direct\",\"relation_lines\":\"true\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__export_templates`
--

DROP TABLE IF EXISTS `pma__export_templates`;
CREATE TABLE IF NOT EXISTS `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- RELATIONS POUR LA TABLE `pma__export_templates`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

DROP TABLE IF EXISTS `pma__favorite`;
CREATE TABLE IF NOT EXISTS `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

--
-- RELATIONS POUR LA TABLE `pma__favorite`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

DROP TABLE IF EXISTS `pma__history`;
CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__history`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

DROP TABLE IF EXISTS `pma__navigationhiding`;
CREATE TABLE IF NOT EXISTS `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

--
-- RELATIONS POUR LA TABLE `pma__navigationhiding`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

DROP TABLE IF EXISTS `pma__pdf_pages`;
CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__pdf_pages`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

DROP TABLE IF EXISTS `pma__recent`;
CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- RELATIONS POUR LA TABLE `pma__recent`:
--

--
-- Déchargement des données de la table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"parc_auto\",\"table\":\"ordre_mission\"},{\"db\":\"parc_auto\",\"table\":\"v\\u00e9hicule\"},{\"db\":\"parc_auto\",\"table\":\"employe\"},{\"db\":\"parc_auto\",\"table\":\"traitement_cv\"},{\"db\":\"parc_auto\",\"table\":\"demande_v\"},{\"db\":\"parc_auto\",\"table\":\"demande_i\"},{\"db\":\"parc_auto\",\"table\":\"details_bc\"},{\"db\":\"parc_auto\",\"table\":\"bc\"},{\"db\":\"parc_auto\",\"table\":\"departement\"},{\"db\":\"parc_auto\",\"table\":\"suivi_v\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

DROP TABLE IF EXISTS `pma__relation`;
CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

--
-- RELATIONS POUR LA TABLE `pma__relation`:
--

--
-- Déchargement des données de la table `pma__relation`
--

INSERT INTO `pma__relation` (`master_db`, `master_table`, `master_field`, `foreign_db`, `foreign_table`, `foreign_field`) VALUES
('parc_auto', 'bc', 'num', 'parc_auto', 'demande_i', 'num'),
('parc_auto', 'demande_i', 'matricule_v', 'parc_auto', 'véhicule', 'matricule_v'),
('parc_auto', 'demande_v', 'matricule', 'parc_auto', 'employe', 'matricule'),
('parc_auto', 'demande_v', 'num_departement', 'parc_auto', 'departement', 'num_departement'),
('parc_auto', 'details_bc', 'num_bc', 'parc_auto', 'bc', 'num_bc'),
('parc_auto', 'employe', 'num_departement', 'parc_auto', 'departement', 'num_departement'),
('parc_auto', 'ordre_mission', 'matricule', 'parc_auto', 'employe', 'matricule'),
('parc_auto', 'ordre_mission', 'matricule_v', 'parc_auto', 'véhicule', 'matricule_v'),
('parc_auto', 'suivi_v', 'matricule_v', 'parc_auto', 'véhicule', 'matricule_v'),
('parc_auto', 'traitement_cv', 'id_demande', 'parc_auto', 'demande_v', 'id_demande'),
('parc_auto', 'traitement_cv', 'matricule_chauff', 'parc_auto', 'employe', 'matricule'),
('parc_auto', 'traitement_cv', 'matricule_v', 'parc_auto', 'véhicule', 'matricule_v');

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

DROP TABLE IF EXISTS `pma__savedsearches`;
CREATE TABLE IF NOT EXISTS `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

--
-- RELATIONS POUR LA TABLE `pma__savedsearches`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

DROP TABLE IF EXISTS `pma__table_coords`;
CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

--
-- RELATIONS POUR LA TABLE `pma__table_coords`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

DROP TABLE IF EXISTS `pma__table_info`;
CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__table_info`:
--

--
-- Déchargement des données de la table `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('parc_auto', 'demande_v', 'matricule'),
('parc_auto', 'employe', 'nom'),
('parc_auto', 'ordre_mission', 'nom_prenom'),
('parc_auto', 'suivi_v', 'consom_car'),
('parc_auto', 'véhicule', 'marque');

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

DROP TABLE IF EXISTS `pma__table_uiprefs`;
CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- RELATIONS POUR LA TABLE `pma__table_uiprefs`:
--

--
-- Déchargement des données de la table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'parc_auto', 'demande_i', '[]', '2024-05-03 15:10:52'),
('root', 'parc_auto', 'demande_v', '{\"CREATE_TIME\":\"2024-05-07 23:53:35\",\"sorted_col\":\"`flag` DESC\"}', '2024-05-10 13:27:34'),
('root', 'parc_auto', 'véhicule', '[]', '2024-05-08 07:13:27');

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

DROP TABLE IF EXISTS `pma__tracking`;
CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__tracking`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

DROP TABLE IF EXISTS `pma__userconfig`;
CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- RELATIONS POUR LA TABLE `pma__userconfig`:
--

--
-- Déchargement des données de la table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-05-24 09:50:41', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":205,\"lang\":\"fr\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

DROP TABLE IF EXISTS `pma__usergroups`;
CREATE TABLE IF NOT EXISTS `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`usergroup`,`tab`,`allowed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

--
-- RELATIONS POUR LA TABLE `pma__usergroups`:
--

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

DROP TABLE IF EXISTS `pma__users`;
CREATE TABLE IF NOT EXISTS `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL,
  PRIMARY KEY (`username`,`usergroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- RELATIONS POUR LA TABLE `pma__users`:
--
--
-- Base de données : `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
