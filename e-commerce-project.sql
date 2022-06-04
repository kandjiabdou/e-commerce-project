-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 04 juin 2022 à 01:43
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
(1, 'Vêtements', 'Tout ce qui sert à couvrir le corps humain pour le protéger ; pièce de l\'habillement. Littéraire. Ce qui habille, recouvre quelque chose ; parure, manteau.'),
(2, 'Accessoires', 'Des élèments indispensables pour ton bon geek'),
(3, 'Vaisselle', 'Ensemble des pièces et accessoires destinés au service de la table'),
(4, 'Jeu vidéo', 'Un jeu vidéo est une activité de loisir basée sur des périphériques informatiques (écran LCD, manette/joystick, hauts parleurs, ...) permettant d\'interagir dans un environnement virtuel conformément à un ensemble de règles prédéfinies');

-- --------------------------------------------------------

--
-- Structure de la table `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE IF NOT EXISTS `counter` (
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `counter`
--

INSERT INTO `counter` (`value`) VALUES
(20);

-- --------------------------------------------------------

--
-- Structure de la table `lignepanier`
--

DROP TABLE IF EXISTS `lignepanier`;
CREATE TABLE IF NOT EXISTS `lignepanier` (
  `lignePanierID` int(11) NOT NULL AUTO_INCREMENT,
  `panierID` int(11) NOT NULL,
  `numeroLignePanier` int(11) NOT NULL,
  `produitID` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  PRIMARY KEY (`lignePanierID`),
  KEY `panierID` (`panierID`),
  KEY `produitID` (`produitID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignepanier`
--

INSERT INTO `lignepanier` (`lignePanierID`, `panierID`, `numeroLignePanier`, `produitID`, `quantité`) VALUES
(1, 1, 1, 1, 4),
(2, 1, 1, 2, 1),
(3, 2, 1, 2, 2);

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
  PRIMARY KEY (`panierID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`panierID`, `userID`, `etatPanier`, `HeureAchat`) VALUES
(1, 3, 1, '2016-11-18 13:28:18'),
(2, 5, 0, '2016-11-18 13:28:18'),
(4, 3, 1, '2016-05-03 12:28:18');

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
  PRIMARY KEY (`produitID`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produitID`, `nomProduit`, `prix`, `description`, `cheminimage`, `categorieID`) VALUES
(1, 't-shirt star wars keep caml', 20, 'Magnifique t-shirt de la licence star wars. Imprimé Dark Vador avec \"Keep Kalm and use the force\"', 'Images/Produit/1.jpg', 1),
(2, 'Lampe Tetris', 30, 'La lampe qu\'il faut pour ton appart !', 'Images/Produit/2.jpg', 3),
(3, 'Tasse Winston', 15, 'Tasse à l\'effigie du personnage de Winston du jeu Overwatch', 'Images/Produit/3.jpg', 2),
(4, 'Tasse Reaper', 15, 'Tasse à l\'effigie du personnage de Reaper du jeu Overwatch', 'Images/Produit/4.jpg', 1),
(5, 'Tasse Tracer', 15, 'Tasse à l\'effigie du personnage de Tracer du jeu Overwatch', 'Images/Produit/5.jpg', 4),
(6, 'Starcraft 2 Legacy of the void - PC', 35, 'StarCraft II poursuit la saga épique de Protoss, des Terrans et des Zergs ! Ces trois puissantes races s\'affrontent une nouvelle fois dans ce jeu de stratégie en temps réel au rythme rapide, suite du légendaire StarCraft. Des légions d\'unités expérimentées, modernisées, et entièrement nouvelles combattront dans toute la galaxie, alors que chaque faction lutte pour sa survie !', 'Images/Produit/6.jpg', 4),
(7, 'Bravely Default - Nintendo 3DS', 41, 'La lueur du cristal s\'évanouit progressivement. Sa lumière faiblissante laisse présager un grand malheur. Il faut agir…\nDans Bravely Default, la quête à travers Luxendarc pour réveiller les cristaux est un RPG unique et innovant, en exclusivité sur les consoles de la famille Nintendo 3DS. ', 'Images/Produit/7.jpg', 4),
(8, 'Souris Pro Gamer', 110, 'Logitech G900 Chaos Spectrum Souris Pro Gamer sans-fil ambidextre Noir', 'Images/Produit/8.jpg', 2),
(9, 'Volant de course', 110, 'Volant de course pour PC, PS3 et PS4, en cuir et métal - noir', 'Images/Produit/9.jpg', 3),
(10, 'T-Shirt - Geek en Charge', 19, 'Les t-shirts Geek s\'adresse aux accros à Internet, jeux video, mangas et geekerie en tout genre! Une idée cadeau pour vos amis geeks et qui n\'a pas d\'amis geek de nos jours..? Pour chaque geekerie il y a le tee shirt Geek qui convient.', 'Images/Produit/10.jpg', 1),
(11, 'T-Shirt - Geek Level Up', 19, 'Les t-shirts Geek s\'adresse aux accros à Internet, jeux video, mangas et geekerie en tout genre! Une idée cadeau pour vos amis geeks et qui n\'a pas d\'amis geek de nos jours..? Pour chaque geekerie il y a le tee shirt Geek qui convient.', 'Images/Produit/11.jpg', 1),
(12, 'T-Shirt Homme STAR WARS - Yoda Cool Stereo', 20, '- T-Shirt Star Wars Pour Homme - Motif à l\'Avant de DJ Yoda Avec des Lunettes Brillantes et un Casque Autour du Cou - Les Éléments Bleus Sont Sérigraphiés Avec une Matière Brillante - Modèle 100% Officiel de la Licence Star Wars', 'Images/Produit/12.jpg', 1),
(13, 'Porte tablette retro', 99, 'iCADE Arcade Cabinet', 'Images/Produit/13.jpg', 3),
(14, 'Chaussures zelda', 52, 'Vivre sa passion c\'est bien. La porter c\'est encore mieux.', 'Images/Produit/14.jpg', 2),
(15, 'Baskettes tetris', 49, 'Nous les Geek on a les armoires remplies de fringues complètement Geek. Ce qu’il nous manque bien souvent par contre, ce sont des chaussures ou des basquettes Geek.', 'Images/Produit/15.jpg', 4),
(16, 'Baskettes Angry Birds', 109, 'Chaussures-Collector', 'Images/Produit/16.jpg', 2),
(17, 'Baskettes Star wars', 109, 'Chaussures-Collector', 'Images/Produit/17.jpg', 2),
(18, 'Tasse \"gamer fuel\"', 12, 'Un geek a besoin de recharger ses batteries', 'Images/Produit/18.jpg', 1),
(19, 'Bébé Groot Dansant', 35, 'Comme nous, vous avez aimé The Guardiens Of The Galaxy (alias les Gardiens de la Galaxie) ? Vous allez adorer le bébé groot dansant ! Oui le Baby Groot Dancing, reprend l’une des dernières scène du film où on retrouve Groot, un extraterrestre végétal à mi-chemin entre la racine et l’arbre, qui, alors qu’il avait brûlé, repousse en dansant sur I Want You Back des Jackson Five dans un pot de fleur. Le bébé groot dansant sur ton bureau !', 'Images/Produit/19.png', 3),
(20, 'Poubelle Domestique R2-D2', 105, 'On ne peut pas dire que la vie est belle pour l’ex-robot R2D2 qui depuis sa retraite, ne cesse d’endosser des sous rôles. J’entends sur le registre du marketing, évidemment. Aujourd’hui il joue les poubelles hi-tech pour Geek. Un accessoire indispensable pour maintenir de l’ordre dans sa chambre.', 'Images/Produit/20.jpg', 3),
(21, 'Tasse game boy', 52, 'Mug game boy', 'Images/Produit/21.jpg', 1),
(22, 'Boite à gateaux sonore tardis docteur who', 29, 'On ne s\'arrête pas de baver d\'envie devant cette boîte à cookies sonore Doctor Who en forme de Tardis... Conçue en plastique alimentaire pour une meilleure hygiène et équipée d\'un couvercle amovible, elle sait comment s\'y prendre pour garder nos gâteaux à l\'abri. Mais ce qui nous fait véritablement craquer, ce sont ses effets sonores et lumineux qui émettent des sons du Tardis et font s\'illuminer la lanterne lorsque l’on referme le couvercle ou lorsque l’on appuie dessus !', 'Images/Produit/22.jpg', 2),
(23, 'Haut-Parleurs Panda', 24, 'On aime son petit look animal vraiment adorable et son côté pratique pour écouter de la musique façon insolite : oreille gauche (noire), vous pourrez régler le son de votre playlist, oreille droite, c’est les tonalités de la chanson que vous réglez, histoire de vous faire un joli son. Alimenté par un port USB, comme maintenant tous les gadgets geek et high-tech, ce petit panda haut-parleur pourrait bien devenir votre meilleur ami.', 'Images/Produit/23.png', 3),
(24, 'Sac à Dos BB-8', 55, 'Arrêtez tout, on a LE cadeau de Noël : le sac à dos Buddies BB-8 ! Oui le petit droïde vedette de Star Wars 7 débarque en mode sac pour transporter tout votre petit matos geek sur le dos. Un sac à dos Star Wars très réussi où vous pourrez ranger votre anti-stress étoile noire ou votre portefeuille R2-D2.', 'Images/Produit/24.png', 4),
(25, 'Lampe Torche Sabre Laser', 29, 'Tout le monde devrait avoir son sabre laser de Jedi dans cette jungle qu’est devenu le monde ! Et bien cette réplique de sabre laser Star Wars vous aidera dans votre combat quotidien contre le mal, en tout cas contre le côté obscur de la Force puisque c’est une lampe torche !', 'Images/Produit/25.png', 3),
(26, 'Peluche Faucon Millenium', 9, 'Le Faucon Millenium, le célèbre vaisseau Star Wars de Han Solo atterrit dans le berceau de bébé ! Une bien jolie peluche reprenant donc le design du Faucon Millenium, pour rappel le vaisseau le plus rapide de la galaxie. Rien que ça. Et puis inutile de la gagner en jouant aux cartes contre Lando Calrissian pour obtenir le Faucon Millenium peluche : il suffit de l’ajouter à votre panier ! Une peluche Star Wars qui fera rêver les petits et plaisir aux papas !', 'Images/Produit/26.png', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mode` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `mode`, `username`, `password`) VALUES
(1, 'Reynaert', 'Vincent', 1, 'vincent.reynaert@isen-lille.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(2, 'Sobczak', 'Nicolas', 1, 'nicolas.sobczak@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(3, 'Pryfer', 'Sylvain', 2, 'feitte@gmail.com', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(4, 'Elsa', 'Queen of Arendelle', 2, 'anna.elsa@gmail.com', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(5, 'Pika', 'Chu', 2, 'pikachu@nintendo.com', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(6, 'Landais', 'Baudouin', 2, 'baudouin.landais@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(7, 'Levert', 'Quentin', 2, 'quentin.levert@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(8, 'Noet', 'Kevin', 2, 'kevin.noet@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(9, 'Percq', 'Timothée', 2, 'timothee.percq@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(10, 'Polaert', 'Francis', 2, 'francis.polaert@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(11, 'Valencourt', 'Vivien', 2, 'vivien.valencourt@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(12, 'Vandierdonck', 'Guillaume', 2, 'guillaume.vandierdonck@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(13, 'Vanmarcke', 'Romain', 2, 'romain.vanmarcke@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(14, 'Vermeil', 'Julien', 2, 'julien.vermeil@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(15, 'You', 'Qi', 2, 'qi.you@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(16, 'Yue', 'Cuize', 2, 'cuize.yue@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(17, 'Trouche', 'Pierre', 2, 'trouchyLeMalade@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(18, 'Abdou', 'kandji', 2, 'a@k.k', '81dc9bdb52d04dc20036dbd8313ed055');

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
