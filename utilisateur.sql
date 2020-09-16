-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 sep. 2020 à 23:18
-- Version du serveur :  8.0.19
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formulaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `mail` varchar(100) DEFAULT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `commentaire` text,
  `date_avis` datetime NOT NULL,
  `lien_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`mail`, `pseudo`, `commentaire`, `date_avis`, `lien_photo`) VALUES
('lilia@feler.fr', 'Lilia', 'nbvuf', '2020-09-10 11:17:12', 'fichiers_upload/banner.jpg'),
('liviofeler971@outlook.fr', 'Livio', 'Très bon produit', '2020-09-10 11:17:30', 'fichiers_upload/banner.jpg'),
('liviofeler971@outlook.fr', 'Livio', 'Très bon produit', '2020-09-10 11:17:53', 'fichiers_upload/banner.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
