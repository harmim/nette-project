SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `nette-project` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `nette-project`;

CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`id`, `title`, `author`, `link`) VALUES
(1,	'David Grudl: Je to frajer',	'Jan Boček',	'http://www.zive.cz/clanky/david-grudl-je-to-frajer/sc-3-a-163582'),
(3,	'Symfony po krůčkách',	'Dennis Fridrich',	'https://www.zdrojak.cz/clanky/symfony-po-kruckach-oblekame-microkernel/'),
(4,	'Doctrine 2: úvod do systému',	'Jan Tichý',	'https://www.zdrojak.cz/clanky/doctrine-2-uvod-do-systemu/'),
(5,	'Nette Framework: Cache',	'David Grudl',	'https://www.zdrojak.cz/clanky/nette-framework-cache/'),
(6,	'V čem je PHP navrženo lépe než Java',	'Jakub Vrána',	'https://www.zdrojak.cz/clanky/php-navrzeno-lepe-nez-java/');

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`) VALUES
(1,	'demo',	'$2y$10$23kG0ynul.JlqK1.xDBNP.AQ0NQW6sqPMSdW0DI7oiNTM92j1/Qhm',	'John',	'Smith');
