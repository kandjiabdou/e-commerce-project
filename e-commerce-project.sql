-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 juin 2022 à 02:06
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-commerce-project`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(255) NOT NULL,
  `descriptionCategorie` text NOT NULL,
  PRIMARY KEY (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `nomCategorie`, `descriptionCategorie`) VALUES
(1, 'telephone', 'Téléphone portable high tech'),
(2, 'ordinateur', 'Ordinateur portable'),
(3, 'caméra', 'caméra'),
(4, 'montre', 'montre');

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortDefault` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config`
--

INSERT INTO `config` (`id`, `sortDefault`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `lignepanier`
--

DROP TABLE IF EXISTS `lignepanier`;
CREATE TABLE IF NOT EXISTS `lignepanier` (
  `lignePanierID` int(11) NOT NULL AUTO_INCREMENT,
  `panierID` int(11) NOT NULL,
  `produitID` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  PRIMARY KEY (`lignePanierID`),
  KEY `panierID` (`panierID`),
  KEY `produitID` (`produitID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignepanier`
--

INSERT INTO `lignepanier` (`lignePanierID`, `panierID`, `produitID`, `quantité`) VALUES
(15, 1, 27, 1),
(16, 1, 37, 1),
(20, 2, 19, 1),
(21, 2, 6, 2),
(22, 2, 8, 1),
(23, 2, 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `etatPanier` int(11) NOT NULL,
  `HeureAchat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nbProduit` int(11) DEFAULT NULL,
  `prixTotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`panierID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`panierID`, `userID`, `etatPanier`, `HeureAchat`, `nbProduit`, `prixTotal`) VALUES
(1, 2, 1, '2022-06-20 00:17:54', 3, 522),
(2, 2, 1, '2022-06-20 01:37:25', 4, 1361);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `produitID` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(255) COLLATE utf8_bin NOT NULL,
  `prix` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `cheminimage` varchar(500) COLLATE utf8_bin NOT NULL,
  `categorieID` int(11) NOT NULL,
  `quantiteProduit` int(11) NOT NULL,
  PRIMARY KEY (`produitID`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produitID`, `nomProduit`, `prix`, `description`, `cheminimage`, `categorieID`, `quantiteProduit`) VALUES
(1, 'Xiaomi Redmi Note ', 169, 'Pile(s) / Batterie(s) : ‏ : ‎ 1 Lithium-polymère nécessite des piles.\r\nIs Discontinued By Manufacturer ‏ : ‎ Non\r\nDimensions du produit (L x l x h) ‏ : ‎ 0.89 x 7.53 x 16.18 cm; 490 grammes\r\nDate de mise en ligne sur Amazon.fr ‏ : ‎ 20 mai 2021\r\nFabricant ‏ : ‎ Xiaomi\r\nASIN ‏ : ‎ B095BMDKGM\r\nNuméro du modèle de l\'article ‏ : ‎ Redmi Note 10\r\nPays d\'origine ‏ : ‎ Hong Kong', 'telephone/1.jpg', 1, 0),
(2, 'DOOGEE S98(2022) Android', 369, 'DOOGEE S98 adopte une nouvelle génération d\'Android 12, une grande mémoire de 8 + 256 Go et un écran arrière intelligent innovant. C\'est un téléphone portable incassable avec des performances de coût élevées.', 'telephone/2.jpg', 1, 8),
(3, 'Xiaomi YS45', 65, 'Un smartphone avec un écran de 5,0 pouces fournit des visuels de haute qualité et des couleurs vives pour votre contenu, images, réseaux sociaux, photos et vidéos. 1 go de RAM + 4 go de Rom, 4 go de stockage multimédia extensible de 32 go de Rom de grande capacité via la carte Micro SD..', 'telephone/3.jpg', 1, 8),
(4, 'Samsung Galaxy SM-A226B', 165, 'Pile(s) / Batterie(s)  : 1 Lithium-polymère - incluse(s)\r\nIs Discontinued By Manufacturer :  Non\r\nDimensions du produit (L x l x h): 0.9 x 7.64 x 16.72 cm; 203 grammes\r\nDate de mise en ligne sur Amazon.fr : 9 juillet 2021\r\nFabricant  :  Samsung', 'telephone/4.jpg', 1, 7),
(5, 'Huawei P40 Lite ', 292, 'Smartphone débloqué 4G (6,4 pouces - 6/128go - Double Nano SIM EMUI 10.1 & AppGallery ) Noir', 'telephone/5.jpg', 1, 5),
(6, 'Apple iPhone 11 128Go', 409, 'Écran LCD Liquid Retina HD 6,1 pouces. Résistant à la poussière et à l’eau (jusqu’à 2 mètres pendant 30 minutes maximum, IP68). Double appareil photo avec ultra grand-angle et grand-angle 12 Mpx, mode Nuit, mode Portrait et vidéo 4K jusqu’à 60 i/s', 'telephone/6.jpg', 1, 7),
(7, 'Apple iPhone 7 32Go Or Rose', 65, 'Le produit est reconditionné, il est entièrement fonctionnel et en \"Excellent état\". Il bénéficie de la garantie d’un an Amazon Renewed.', 'telephone/7.jpg', 1, 7),
(8, 'Apple iPhone 13 (128 Go) ', 65, 'Dans le cadre de nos efforts pour atteindre nos objectifs environnementaux, iPhone 13 n\'inclut plus d\'EarPods. Veuillez utiliser vos EarPods existants ou acheter cet accessoire séparément.', 'telephone/8.jpg', 1, 7),
(9, 'Asus Vivobook 14 E410MA', 394, '1,3 kg : Avec son poids plume et son format compact, le VivoBook 14 E410 vous aide à atteindre le summum de la productivité.', 'ordinateur/9.jpg', 2, 4),
(10, 'Lenovo IdeaPad 3 15IGL05', 279, 'Caméra 0.3MP avec PrivacyShutter qui bloque les regards indiscrets lorsque vous souhaitez protéger votre vie privée, Grâce à son écran 17.3\" HD d’une résolution de (1366x768) pixels, le PC portable Lenovo Ideapad 3 vous permet de profiter de vos contenus avec une image nette', 'ordinateur/10.jpg', 2, 5),
(11, 'Microsoft Surface Laptop', 589, 'Taille de l\'affichage:12.4 pouces\r\nDescription du disque dur:SSD\r\nVitesse du modèle CPU:4.2 GHz\r\nTaille de la mémoire:8 Go', 'ordinateur/11.jpg', 2, 4),
(12, 'Microsoft Surface Pro 8', 799, 'Technologie de communication sans fil:Wi-Fi, Système d\'exploitation:Windows 11, Taille de l\'affichage:13 pouces Capacité:256 Go', 'ordinateur/12.jpg', 2, 8),
(13, 'Apple MacBook Pro 2019', 2899, '16 Pouces, 16Go RAM, 1To de Stockage - Gris Sidéral', 'ordinateur/13.jpg', 2, 4),
(14, 'MacBook Air 13 - Reconditionné', 389, 'Le produit est reconditionné, il est entièrement fonctionnel et en \"Excellent état\". Il bénéficie de la garantie d’un an Amazon Renewed.', 'ordinateur/14.jpg', 2, 4),
(15, 'LIGE Montre Mode Spor', 39, 'Acier inoxydable: confortable, l\'acier inoxydable argenté s\'adapte facilement à la longueur du poignet, ce qui est un excellent cadeau pour votre famille, vos amis, vous-même.', 'montre/15.jpg', 4, 4),
(16, 'Montre Chronographe Diesel', 180, 'Finition polie et brossée, Boucle déployante. Le design des boîtes à montres Diesel se renouvelle à chaque saison, Étanchéité: 10 ATM.', 'montre/16.jpg', 4, 8),
(17, 'Montres intelligentes - Slothcloud', 59, 'La montre intelligente peut surveiller avec précision les trois données de fréquence cardiaque,d\'oxygène sanguin et de pression artérielle.Vous pouvez afficher ces données directement sur votre montre pour vous aider à mieux comprendre votre santé.Vous devez ajuster votre style de vie raisonnablement.fournir une analyse complète de la qualité de votre sommeil', 'montre/17.jpg', 4, 8),
(18, 'FOSSIL - Automatique Montre', 129, 'Montre FOSSIL homme - Boîtier rond (diam. 44 mm) en acier inoxydable, finition polie et brossée - Etanche 5 ATM', 'montre/18.jpg', 4, 1),
(19, 'Apple Watch SE 2021', 279, '2021 Apple Watch SE GPS, Boîtier en aluminium argent de 40 mm, Bracelet Sport bleu abysse - Regular', 'montre/19.jpg', 4, 2),
(20, 'Apple Watch Series 3', 219, 'Apple Watch Series 3 (GPS, 38mm) Boîtier en Aluminium Gris Sidéral - Bracelet Sport Noir', 'montre/20.jpg', 4, 8),
(21, 'Apple Watch Series 7', 399, 'Apple Watch Series 7 (GPS) Boîtier en Aluminium Minuit de 41 mm, Bracelet Sport Minuit - Regular - Noir', 'montre/21.jpg', 4, 8),
(22, 'Camera Ultra HD 48MP Vlogging', 189, 'Appareil photo numérique haute résolution 4K 48MP: Cet appareil photo numérique peut enregistrer des vidéos de résolution jusqu\'à 4K / 30 FPS et des images de 48,0 mégapixels. Cette caméra de vlog prend également en charge le zoom avant ou le zoom arrière 16x. Il est équipé d\'un objectif grand angle 0.45X52mm, d\'un objectif macro et d\'une carte mémoire 32G. Cet appareil photo est conçu pour que les débutants profitent du charme de la photographie', 'camera/22.jpg', 3, 8),
(23, 'Appareil Ultra HD 48MP Vlogging', 199, 'Appareil photo numérique haute résolution 4K 48MP: Cet appareil photo numérique peut enregistrer des vidéos de résolution jusqu\'à 4K / 30 FPS et des images de 48,0 mégapixels. Appareil Photo numérique 4K 48MP Appareil Photo Compact, Appareil Photo de vlogging à écran Ultra-Clair', 'camera/23.jpg', 3, 8),
(24, 'Canon EOS 2000d', 609, 'Kit Exclusif Amazon: Canon EOS 2000D + EF-S 18-55mm f/3.5-5.6 IS II. Type d appareil photo: Kit d appareil-photo SLR. Résolution d image maximale: 6000 x 4000 pixels. La sensibilité ISO (max): 12800. Longueur focale: 18 - 55 mm. Vitesse maximale d obturation de la caméra: 1/4000 s. Wifi. Type HD: Full HD', 'camera/24.jpg', 3, 8),
(26, 'Canon Powershot G5 X', 549, 'Capteur d\'image : CMOS rétroéclairé de type 1,0 Processeur : Digic 6 avec technologie iSAPS\r\nZoom optique 4 x Ecran : 3 pouces Full HD\r\nDistance focale : 24 mm - 100 mm\r\nType de batterie : Lithium Ion', 'camera/26.jpg', 3, 1),
(27, 'AGFA PHOTO Realishot DC5200', 44, 'Appareil Photo Numérique Compact (21 MP, Ecran LCD 2.4’’, Zoom Digital 8X, Batterie Lithium) Violet. RÉSOLUTION PHOTO ET VIDEO - L\'appareil photo numérique Realishot DC5200 est doté d\'une résolution photo de 21 MP et d\'une qualité vidéo HD (1280x720)', 'camera/27.jpg', 3, 9),
(37, 'Appareil Photo Etanche', 69, 'Caméra étanche 1080P et 30MP: Cette appareil photo etanche  récemment mise à niveau prend en charge la vidéo 1080P et les photos 30MP avec un zoom numérique jusqu\'à 16x. Il peut vous aider à capturer des photos plus merveilleuses et réelles. Cette caméra haute définition 1080P peut donner vie à vos vidéos en capturant vos moments préférés avec une qualité incroyable. C\'est le choix parfait pour les photographes débutants.', 'camera/25.jpg', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `role`, `username`, `password`) VALUES
(1, 'Admin', 'TestAdmin', 1, 'admin@test.fr', '202cb962ac59075b964b07152d234b70'),
(2, 'Firstname', 'Lastname', 2, 'user@test.fr', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lignepanier`
--
ALTER TABLE `lignepanier`
  ADD CONSTRAINT `lignepanier_ibfk_1` FOREIGN KEY (`panierID`) REFERENCES `panier` (`panierID`),
  ADD CONSTRAINT `lignepanier_ibfk_2` FOREIGN KEY (`produitID`) REFERENCES `produit` (`produitID`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`categorieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
