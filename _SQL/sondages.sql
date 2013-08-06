-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 06 Août 2013 à 17:01
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sondages`
--
CREATE DATABASE IF NOT EXISTS `sondages` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sondages`;

-- --------------------------------------------------------

--
-- Structure de la table `enquetes`
--

DROP TABLE IF EXISTS `enquetes`;
CREATE TABLE IF NOT EXISTS `enquetes` (
  `id_enq` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titre_enq` varchar(255) NOT NULL,
  `description_enq` varchar(500) DEFAULT NULL,
  `id_user_user` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_enq`),
  KEY `FK_enquetes_id_user_user` (`id_user_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `enquetes`:
--   `id_user_user`
--       `user` -> `id_user`
--

-- --------------------------------------------------------

--
-- Structure de la table `propositions`
--

DROP TABLE IF EXISTS `propositions`;
CREATE TABLE IF NOT EXISTS `propositions` (
  `id_prop` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle_prop` varchar(100) NOT NULL,
  `id_quest_questions` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_prop`),
  KEY `FK_propositions_id_quest_questions` (`id_quest_questions`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `propositions`:
--   `id_quest_questions`
--       `questions` -> `id_quest`
--

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_quest` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `libelle_quest` varchar(255) NOT NULL,
  `type_quest` enum('text','nb','qcm') NOT NULL,
  `id_enq_enquetes` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_quest`),
  KEY `FK_questions_id_enq_enquetes` (`id_enq_enquetes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS POUR LA TABLE `questions`:
--   `id_enq_enquetes`
--       `enquetes` -> `id_enq`
--

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
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

--
-- RELATIONS POUR LA TABLE `reponses`:
--   `id_prop_propositions`
--       `propositions` -> `id_prop`
--   `id_quest_questions`
--       `questions` -> `id_quest`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `mdp_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_user` (`email_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
