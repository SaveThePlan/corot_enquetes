-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 06 Août 2013 à 17:51
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sondages`
--

-- --------------------------------------------------------

--
-- Structure de la table `enquetes`
--

CREATE TABLE IF NOT EXISTS `enquetes` (
  `id_enq` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titre_enq` varchar(255) NOT NULL,
  `description_enq` varchar(500) DEFAULT NULL,
  `id_user_user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_enq`),
  KEY `FK_enquetes_id_user_user` (`id_user_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `enquetes`
--

INSERT INTO `enquetes` (`id_enq`, `titre_enq`, `description_enq`, `id_user_user`) VALUES
(1, 'enquête alcool', 'enquete sur la consommation d'' alcool des gens entre 15 et  25 ans', 1),
(2, 'enquête sur les consommateurs de drogues ', 'enquête sur les differentes drogues consommées entre les jeunes entre 15 et 25 ans', 1);

-- --------------------------------------------------------

--
-- Structure de la table `propositions`
--

CREATE TABLE IF NOT EXISTS `propositions` (
  `id_prop` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle_prop` varchar(100) NOT NULL,
  `id_quest_questions` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_prop`),
  KEY `FK_propositions_id_quest_questions` (`id_quest_questions`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `propositions`
--

INSERT INTO `propositions` (`id_prop`, `libelle_prop`, `id_quest_questions`) VALUES
(1, 'Homme', 1),
(2, 'Femme', 1),
(3, 'Le cannabis', 7),
(4, 'L''heroine', 7),
(5, 'La cocaïne', 7),
(6, 'L''exctasie', 7),
(7, 'Le crack', 7),
(8, 'Le lsd', 7),
(9, 'l'' opium', 7);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id_quest` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle_quest` varchar(255) NOT NULL,
  `type_quest` enum('text','nb','qcm') NOT NULL,
  `id_enq_enquetes` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_quest`),
  KEY `FK_questions_id_enq_enquetes` (`id_enq_enquetes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id_quest`, `libelle_quest`, `type_quest`, `id_enq_enquetes`) VALUES
(1, 'Etes vous : ', 'qcm', 1),
(2, 'combien de fois allez vous dans un bistrot par jour ?', 'nb', 1),
(3, 'Que buvez vous le plus souvent comme alcool ?', 'text', 1),
(4, 'le cannabis est-il une drogue douce a des fins therapeutique?', 'qcm', 2),
(5, 'Que penses-vous de la consomation de drogue en soirée ?', 'text', 2),
(6, 'Combien de joints avez-vous fumé occasionnellement ?t ?', 'nb', 2),
(7, 'Parmi ces drogues quelle est la plus addictive ?', 'qcm', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `id_rep` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid_repondant` int(11) unsigned NOT NULL,
  `contenu_rep` varchar(255) DEFAULT NULL,
  `id_quest_questions` int(11) unsigned NOT NULL,
  `id_prop_propositions` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `FK_reponses_id_prop_propositions` (`id_prop_propositions`),
  KEY `FK_reponses_id_quest_questions` (`id_quest_questions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `mdp_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_user` (`email_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `email_user`, `mdp_user`) VALUES
(1, 'sparrow', 'jack', 'jacksparorw@hotmail.com', 'rhum'),
(2, 'degy', 'helene', 'helenedegy@yahoo.fr', 'ln');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `enquetes`
--
ALTER TABLE `enquetes`
  ADD CONSTRAINT `FK_enquetes_id_user_user` FOREIGN KEY (`id_user_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD CONSTRAINT `FK_propositions_id_quest_questions` FOREIGN KEY (`id_quest_questions`) REFERENCES `questions` (`id_quest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_questions_id_enq_enquetes` FOREIGN KEY (`id_enq_enquetes`) REFERENCES `enquetes` (`id_enq`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `FK_reponses_id_prop_propositions` FOREIGN KEY (`id_prop_propositions`) REFERENCES `propositions` (`id_prop`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reponses_id_quest_questions` FOREIGN KEY (`id_quest_questions`) REFERENCES `questions` (`id_quest`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
