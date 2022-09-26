-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 26 sep. 2022 à 15:21
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Vêtement'),
(2, 'Sport'),
(3, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `t_delivery`
--

CREATE TABLE `t_delivery` (
  `idDelivery` int(11) NOT NULL,
  `delMethod` varchar(100) NOT NULL,
  `delType` varchar(10) DEFAULT NULL,
  `delExtra` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_delivery`
--

INSERT INTO `t_delivery` (`idDelivery`, `delMethod`, `delType`, `delExtra`) VALUES
(1, 'Par la poste', 'CHF', 7.95),
(2, 'Retrait au magasin', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_order`
--

CREATE TABLE `t_order` (
  `idOrder` int(11) NOT NULL,
  `ordTotal` double NOT NULL,
  `ordDate` date NOT NULL,
  `ordName` varchar(50) NOT NULL,
  `ordFirstname` varchar(50) NOT NULL,
  `ordStreet` varchar(100) NOT NULL,
  `ordStreetNb` varchar(10) NOT NULL,
  `ordLocality` varchar(100) NOT NULL,
  `ordNpa` int(6) NOT NULL,
  `fkDelivery` int(11) NOT NULL,
  `fkPaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_orderproduct`
--

CREATE TABLE `t_orderproduct` (
  `fkOrder` int(11) NOT NULL,
  `fkProduct` int(11) NOT NULL,
  `ordProQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_paid`
--

CREATE TABLE `t_paid` (
  `idPaid` int(11) NOT NULL,
  `paiMethod` varchar(100) NOT NULL,
  `paiType` varchar(10) DEFAULT NULL,
  `paiExtra` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_paid`
--

INSERT INTO `t_paid` (`idPaid`, `paiMethod`, `paiType`, `paiExtra`) VALUES
(1, 'Sur facture', 'CHF', 2),
(2, 'Paiement par avance', NULL, NULL),
(3, 'Carte de crédit', '%', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_product`
--

CREATE TABLE `t_product` (
  `idProduct` int(11) NOT NULL,
  `proName` varchar(50) NOT NULL,
  `proDescription` text,
  `proPrice` float DEFAULT NULL,
  `proQuantity` smallint(6) DEFAULT NULL,
  `proImage` text,
  `proLike` int(11) NOT NULL DEFAULT '0',
  `fkCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_product`
--

INSERT INTO `t_product` (`idProduct`, `proName`, `proDescription`, `proPrice`, `proQuantity`, `proImage`, `proLike`, `fkCategory`) VALUES
(1, 'Pullover', 'Pullover synthétique', 20.9, 10, 'pull.png', 0, 1),
(2, 'Pantalon', 'Pantalon en Jean\'s véritable', 49.9, 25, 'pants.png', 0, 1),
(3, 'Clé Usb ', 'Clé Usb de 4 Go offrant une fiabilité inégalée.', 4.95, 4, 'usb.png', 10, 3),
(4, 'Disque dur externe', 'Disque dur externe de 1 To, idéal pour stocker et sauvegarder vos données de manière sécurisée.', 79.95, 2, 'harddisk.png', 0, 3),
(5, 'T-Shirt Fox', NULL, 14.9, 50, 'shirt1.png', 0, 2),
(6, 'T-Shirt Mignon', NULL, 14.9, 20, 'shirt2.png', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `useLogin` varchar(20) NOT NULL,
  `usePassword` text NOT NULL,
  `useRight` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `useLogin`, `usePassword`, `useRight`) VALUES
(1, 'admin', '$2y$10$UZ6NOFmrq5QY.XDdicl8EO0vxy.D/d4H48GrbRdTcKYQ0Kwqoo.ie', 'admin'),
(2, 'customer', '$2y$10$.8sXz4/qH5sngNgdEnn8HesHO3qoDvUcYmslZyGIpCUz1He0OmOAS', 'customer');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_delivery`
--
ALTER TABLE `t_delivery`
  ADD PRIMARY KEY (`idDelivery`);

--
-- Index pour la table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `fkDelivery` (`fkDelivery`),
  ADD KEY `fkPaid` (`fkPaid`);

--
-- Index pour la table `t_orderproduct`
--
ALTER TABLE `t_orderproduct`
  ADD KEY `fkOrder` (`fkOrder`),
  ADD KEY `fkProduct` (`fkProduct`);

--
-- Index pour la table `t_paid`
--
ALTER TABLE `t_paid`
  ADD PRIMARY KEY (`idPaid`);

--
-- Index pour la table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `Index_Category` (`fkCategory`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_delivery`
--
ALTER TABLE `t_delivery`
  MODIFY `idDelivery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_order`
--
ALTER TABLE `t_order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `t_paid`
--
ALTER TABLE `t_paid`
  MODIFY `idPaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_order`
--
ALTER TABLE `t_order`
  ADD CONSTRAINT `fkDelivery` FOREIGN KEY (`fkDelivery`) REFERENCES `t_delivery` (`idDelivery`),
  ADD CONSTRAINT `fkPaid` FOREIGN KEY (`fkPaid`) REFERENCES `t_paid` (`idPaid`);

--
-- Contraintes pour la table `t_orderproduct`
--
ALTER TABLE `t_orderproduct`
  ADD CONSTRAINT `fkOrder` FOREIGN KEY (`fkOrder`) REFERENCES `t_order` (`idOrder`),
  ADD CONSTRAINT `fkProduct` FOREIGN KEY (`fkProduct`) REFERENCES `t_product` (`idProduct`);

--
-- Contraintes pour la table `t_product`
--
ALTER TABLE `t_product`
  ADD CONSTRAINT `t_product_ibfk_1` FOREIGN KEY (`fkCategory`) REFERENCES `t_category` (`idCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
