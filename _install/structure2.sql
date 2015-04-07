-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
-- 
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Avril 2015 à 16:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Structure de la table `colonnes`
--

DROP TABLE IF EXISTS `colonnes`;
CREATE TABLE IF NOT EXISTS `colonnes` (
  `id_col` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lib_col` varchar(15) NOT NULL,
  PRIMARY KEY (`id_col`),
  KEY `id_col` (`id_col`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id_config` varchar(10) NOT NULL,
  `value_config` varchar(70) NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

DROP TABLE IF EXISTS `taches`;
CREATE TABLE IF NOT EXISTS `taches` (
  `id_tache` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de la tache',
  `lib_tache` varchar(50) NOT NULL COMMENT 'titre de la tache',
  `com_tache` text COMMENT 'commentaire ',
  `dev_tache` int(11) unsigned NOT NULL COMMENT 'user_id from user',
  `test_tache` int(11) unsigned NOT NULL COMMENT 'user_id from user',
  `col_tache` int(11) unsigned DEFAULT NULL COMMENT 'etat de la tache',
  `couleur_tache` varchar(20) DEFAULT NULL,
  `etat_tache` varchar(10) NOT NULL COMMENT 'dev,test,debug,livraison',
  PRIMARY KEY (`id_tache`),
  KEY `dev_tache` (`dev_tache`),
  KEY `test_tache` (`test_tache`),
  KEY `col_tache` (`col_tache`),
  KEY `col_tache_2` (`col_tache`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='liste des taches';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id de l''utilisateur',
  `nom_user` varchar(10) NOT NULL COMMENT 'nom de l''utilisateur',
  `login_user` varchar(10) NOT NULL,
  `passwd_user` varchar(256) NOT NULL,
  `mail_user` varchar(255) NOT NULL COMMENT 'mail de l''utilisateur',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `nom_user` (`nom_user`,`mail_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `login_user` (`login_user`),
  KEY `login_user_2` (`login_user`),
  KEY `mail_user` (`mail_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `fk_dev_taches` FOREIGN KEY (`dev_tache`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `taches_ibfk_1` FOREIGN KEY (`test_tache`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `taches_ibfk_2` FOREIGN KEY (`col_tache`) REFERENCES `colonnes` (`id_col`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
