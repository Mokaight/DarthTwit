-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 10 Mai 2016 à 19:25
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `touiter`
--

-- --------------------------------------------------------

--
-- Structure de la table `arobases`
--

CREATE TABLE `arobases` (
  `idArobase` int(11) NOT NULL,
  `Apseudonyme` varchar(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `arobases`
--

INSERT INTO `arobases` (`idArobase`, `Apseudonyme`) VALUES
(1, '@Benoit'),
(2, '@emilie'),
(14, '@Nicolas'),
(5, '@Benjamin');

-- --------------------------------------------------------

--
-- Structure de la table `contenua`
--

CREATE TABLE `contenua` (
  `idMsg` int(11) NOT NULL,
  `idArobase` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenua`
--

INSERT INTO `contenua` (`idMsg`, `idArobase`) VALUES
(1, 2),
(11, 5),
(1011, 5);

-- --------------------------------------------------------

--
-- Structure de la table `contenuh`
--

CREATE TABLE `contenuh` (
  `idMsg` int(11) NOT NULL,
  `idHashtag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenuh`
--

INSERT INTO `contenuh` (`idMsg`, `idHashtag`) VALUES
(1, 1),
(11, 3);

-- --------------------------------------------------------

--
-- Structure de la table `hashtags`
--

CREATE TABLE `hashtags` (
  `idHashtag` int(11) NOT NULL,
  `titre` varchar(140) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `hashtags`
--

INSERT INTO `hashtags` (`idHashtag`, `titre`) VALUES
(1, '#J\'AIMELESLEGUMES'),
(2, '#VACANCES'),
(3, '#BEAUSIROP'),
(4, '#PASSEMONTAGNE'),
(5, '#RELANCEDE12'),
(6, '#LEGRASCESTLAVIE'),
(7, '#BATAILLEDEBOULEDENEIGE'),
(8, '#GUIGOUZETMAXOUZ'),
(9, '#CDUTERROIR'),
(10, '#GUIGOUZETMAXOUZ');

-- --------------------------------------------------------

--
-- Structure de la table `retouites`
--

CREATE TABLE `retouites` (
  `idMsgRet` int(11) NOT NULL,
  `idMsgSource` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `retouites`
--

INSERT INTO `retouites` (`idMsgRet`, `idMsgSource`) VALUES
(1011, 11),
(1002, 1);

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

CREATE TABLE `suivre` (
  `idDemandeur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  `demande` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `suivre`
--

INSERT INTO `suivre` (`idDemandeur`, `idReceveur`, `demande`) VALUES
(1, 2, 'R'),
(1336, 3, 'R'),
(1336, 4, 'E'),
(1, 5, 'V'),
(1, 6020, 'V'),
(6020, 9004, 'E'),
(1, 7, 'V'),
(2, 3001, 'R'),
(2, 7, 'V'),
(2, 10, 'R'),
(5, 8, 'E'),
(2, 3, 'V'),
(6, 6045, 'V'),
(3512, 3, 'R'),
(2, 6045, 'E'),
(8, 10, 'E'),
(5, 6, 'E'),
(6, 3512, 'E'),
(4, 9004, 'V'),
(3, 2, 'V'),
(9004, 3001, 'E'),
(4, 9, 'V'),
(4, 1, 'E'),
(4, 3, 'R'),
(5, 3, 'V'),
(5, 1, 'R'),
(5, 4, 'V'),
(6, 5, 'E'),
(6, 8, 'V'),
(6, 9, 'R'),
(6, 2, 'E'),
(6, 1, 'R'),
(7, 3512, 'R'),
(7, 9004, 'E'),
(7, 9, 'V'),
(7, 3, 'R'),
(8, 9, 'R'),
(8, 3, 'R'),
(8, 9004, 'V'),
(9, 3, 'R'),
(1336, 3512, 'V'),
(1336, 11, 'V'),
(6020, 11, 'V'),
(6020, 3, 'R'),
(3001, 9004, 'R'),
(3001, 6045, 'V'),
(3512, 7, 'E'),
(6045, 3512, 'E'),
(6045, 4, 'V'),
(6045, 3, 'E'),
(6045, 1336, 'R'),
(9004, 3, 'R');

-- --------------------------------------------------------

--
-- Structure de la table `touites`
--

CREATE TABLE `touites` (
  `idMsg` int(11) NOT NULL,
  `laDate` date NOT NULL,
  `texte` varchar(140) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touites`
--

INSERT INTO `touites` (`idMsg`, `laDate`, `texte`) VALUES
(1, '2015-09-09', 'j aime la mousse au chocolat :)'),
(11, '2015-11-15', 'Je suis perdu dans ma life'),
(14, '2015-12-25', 'Joyeux noël !! <3'),
(1011, '2015-11-16', 'Comme tous le temps.'),
(1002, '2015-09-30', 'ouai moi aussi bien epaisse ! ;)'),
(1001, '2015-11-16', 'Je suis perdu dans ma life'),
(1014, '2016-05-09', 'Bonjour mon amis ! \n');

-- --------------------------------------------------------

--
-- Structure de la table `touitesnormaux`
--

CREATE TABLE `touitesnormaux` (
  `idMsg` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touitesnormaux`
--

INSERT INTO `touitesnormaux` (`idMsg`) VALUES
(1),
(11);

-- --------------------------------------------------------

--
-- Structure de la table `touitesprives`
--

CREATE TABLE `touitesprives` (
  `idMsg` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  `idMsgSource` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touitesprives`
--

INSERT INTO `touitesprives` (`idMsg`, `idAuteur`, `idReceveur`, `idMsgSource`) VALUES
(11, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `touitespublics`
--

CREATE TABLE `touitespublics` (
  `idMsg` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touitespublics`
--

INSERT INTO `touitespublics` (`idMsg`, `idAuteur`) VALUES
(1001, 11),
(1, 1),
(11, 3),
(1011, 6045),
(1002, 2),
(1014, 2);

-- --------------------------------------------------------

--
-- Structure de la table `touitesreponses`
--

CREATE TABLE `touitesreponses` (
  `idMsgRep` int(11) NOT NULL,
  `idMsgSource` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touitesreponses`
--

INSERT INTO `touitesreponses` (`idMsgRep`, `idMsgSource`) VALUES
(1001, 11);

-- --------------------------------------------------------

--
-- Structure de la table `touitos`
--

CREATE TABLE `touitos` (
  `id` int(11) NOT NULL,
  `pseudonyme` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motPasse` varchar(20) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `statut` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `touitos`
--

INSERT INTO `touitos` (`id`, `pseudonyme`, `email`, `motPasse`, `photo`, `statut`) VALUES
(1, 'Martin', 'Martin@gmail.com', '25609510gg', 'O', 'La vie n\'est pas un long fleuve tranquille'),
(2, 'Bernard', 'Bernard@gmail.com', 'Beber949', 'N', 'Bonjour\n'),
(3, 'Juan', 'Juan@gmail.com', 'MexiqueEnForce', 'N', 'Quand est-ce qu\'on mange des fajitas ?'),
(5, 'Françoise', 'Françoise@gmail.com', '15485248', 'O', 'Je pars en vacances !'),
(7, 'Alexandre', 'Alex@outlook.com', 'Ab61d9c8', 'O', 'LOL'),
(8, 'Tomas', 'Tom77@gmail.com', '96248256', 'O', 'Plus de chauffage chez moi j\'ai froid'),
(9, 'Banski42', 'Banski42@gmail.com', 'mdp42banski', 'N', 'T\'as vu ! il y a Banksi dans la rue'),
(10, 'Nicolas', 'CocoLasticot@hotmail.com', '598624762', 'O', 'J\'adore les Star Wars!'),
(11, 'Fabienne', 'Fafa@hotmail.com', '2569842', 'O', 'Je ramasse le raisin de mon jardin'),
(1336, 'Emilie', 'Emilie@gmail.com', 'Emi359', 'N', 'LOL'),
(6020, 'Michael', 'Jackson@free.fr', 'c84fd5p', 'O', 'Beat it !'),
(3001, 'Justine', 'Juju@outlook.com', 'ILoveIceCream', 'N', 'Trop envie de dormir...'),
(3512, 'Kevin', 'Kevin@gmail.com', '21091995', 'O', 'J ai croisé Martin Freeman au centre commercial !'),
(6045, 'Benjamin', 'benji@gmail.com', 'moon6', 'N', 'Je veux un Oculus Rift'),
(9004, 'Alyson', 'Brie@gmail.com', '985642lok12', 'O', 'Je reprend le sport !'),
(4, 'Benoit', 'Benoit@gmail.com', 'NiceIsBeautiful', 'O', 'LOL'),
(6, 'Sarah', 'Sarah@free.com', 'Troispetitspoissons', 'N', 'Once upon a time...');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `arobases`
--
ALTER TABLE `arobases`
  ADD PRIMARY KEY (`idArobase`);

--
-- Index pour la table `contenua`
--
ALTER TABLE `contenua`
  ADD PRIMARY KEY (`idMsg`,`idArobase`),
  ADD KEY `idArobase` (`idArobase`);

--
-- Index pour la table `contenuh`
--
ALTER TABLE `contenuh`
  ADD PRIMARY KEY (`idMsg`,`idHashtag`),
  ADD KEY `idHashtag` (`idHashtag`);

--
-- Index pour la table `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`idHashtag`);

--
-- Index pour la table `retouites`
--
ALTER TABLE `retouites`
  ADD PRIMARY KEY (`idMsgRet`),
  ADD KEY `idMsgSource` (`idMsgSource`);

--
-- Index pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD PRIMARY KEY (`idDemandeur`,`idReceveur`),
  ADD KEY `idReceveur` (`idReceveur`);

--
-- Index pour la table `touites`
--
ALTER TABLE `touites`
  ADD PRIMARY KEY (`idMsg`);

--
-- Index pour la table `touitesnormaux`
--
ALTER TABLE `touitesnormaux`
  ADD PRIMARY KEY (`idMsg`);

--
-- Index pour la table `touitesprives`
--
ALTER TABLE `touitesprives`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `idAuteur` (`idAuteur`),
  ADD KEY `idReceveur` (`idReceveur`),
  ADD KEY `idMsgSource` (`idMsgSource`);

--
-- Index pour la table `touitespublics`
--
ALTER TABLE `touitespublics`
  ADD PRIMARY KEY (`idMsg`),
  ADD KEY `idAuteur` (`idAuteur`);

--
-- Index pour la table `touitesreponses`
--
ALTER TABLE `touitesreponses`
  ADD PRIMARY KEY (`idMsgRep`),
  ADD KEY `idMsgSource` (`idMsgSource`);

--
-- Index pour la table `touitos`
--
ALTER TABLE `touitos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudonyme` (`pseudonyme`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `arobases`
--
ALTER TABLE `arobases`
  MODIFY `idArobase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `idHashtag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `touites`
--
ALTER TABLE `touites`
  MODIFY `idMsg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;
--
-- AUTO_INCREMENT pour la table `touitos`
--
ALTER TABLE `touitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9005;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
