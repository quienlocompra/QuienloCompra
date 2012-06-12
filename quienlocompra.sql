-- Adminer 3.3.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `apps`;
CREATE TABLE `apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` text NOT NULL,
  `appkey` text NOT NULL,
  `author` text NOT NULL,
  `name` text NOT NULL,
  `slogan` text NOT NULL,
  `logo` text NOT NULL,
  `icon` text NOT NULL,
  `users` text NOT NULL,
  `url` text NOT NULL,
  `company` text NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `apps` (`id`, `appid`, `appkey`, `author`, `name`, `slogan`, `logo`, `icon`, `users`, `url`, `company`, `likes`, `dislikes`) VALUES
(1,	'appid_wtftrtcy',	'bcd9e33946ed32f06cfcb06bca932385',	'uid_T3lFNI5c',	'Dannegm Development',	'Soluciones a tu medida',	'pid_p4qmT6a2',	'',	'uid_T3lFNI5c;uid_x9sWw65Z;uid_8sXXNI51;uid_JwXBCx8N;uid_jKpfp9rc;',	'http://dannegm/www/example',	'Dannegm',	'',	'');

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` text NOT NULL,
  `author` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `pics` text NOT NULL,
  `create` text NOT NULL,
  `sale` text NOT NULL,
  `price` float NOT NULL,
  `money` text NOT NULL,
  `comments` text NOT NULL,
  `status` int(11) NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  `oferts` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `author` text NOT NULL,
  `message` text NOT NULL,
  `date` text NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgid` text NOT NULL,
  `to` text NOT NULL,
  `from` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `date` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notiid` text NOT NULL,
  `to` text NOT NULL,
  `from` text NOT NULL,
  `where` text NOT NULL,
  `type` int(11) NOT NULL,
  `date` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` text NOT NULL,
  `author` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `date` text NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  `uri` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pictures` (`id`, `pid`, `author`, `title`, `description`, `date`, `likes`, `dislikes`, `uri`) VALUES
(1,	'pid_p4qmT6a2',	'uid_u4uuCrlA',	'Dannegm Development',	'',	'4 2012-01-26 12:44:20:am',	'',	'',	'p4qmT6a2.png'),
(2,	'pid_9j41FPuF',	'uid_T3lFNI5c',	'',	'',	'4 2012-01-26 12:49:16:am',	'',	'',	'pid_9j41FPuF.png'),
(3,	'pid_oRqhYfjm',	'uid_55ADTGOn',	'',	'',	'4 2012-01-26 1:10:45:am',	'',	'',	'pid_oRqhYfjm.jpg'),
(4,	'pid_X8rdtBem',	'uid_x9sWw65Z',	'',	'',	'4 2012-01-26 11:27:41:am',	'',	'',	'pid_X8rdtBem.jpg'),
(5,	'pid_BoAaNkVo',	'uid_JwXBCx8N',	'',	'',	'4 2012-01-26 2:47:34:pm',	'',	'',	'pid_BoAaNkVo.jpg');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `user` text NOT NULL,
  `name` text NOT NULL,
  `pass` text NOT NULL,
  `pic` text NOT NULL,
  `login` int(11) NOT NULL,
  `apps` text NOT NULL,
  `bio` text NOT NULL,
  `type` text NOT NULL,
  `bird` text NOT NULL,
  `gen` text NOT NULL,
  `country` text NOT NULL,
  `articles` text NOT NULL,
  `email` text NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  `followers` text NOT NULL,
  `followins` text NOT NULL,
  `status` int(11) NOT NULL,
  `register` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `uid`, `user`, `name`, `pass`, `pic`, `login`, `apps`, `bio`, `type`, `bird`, `gen`, `country`, `articles`, `email`, `likes`, `dislikes`, `followers`, `followins`, `status`, `register`) VALUES
(1,	'uid_T3lFNI5c',	'dannegm',	'Daniel GarcÃ­a',	'0e3af74e57a790e3c370b3802147603a',	'pid_9j41FPuF',	1,	'appid_wtftrtcy;',	'',	'type',	'01 - 04 - 1993',	'h',	'mx',	'',	'danneg.m@gmail.com',	'',	'',	'',	'',	1,	'4 2012-01-26 12:48:43:am'),
(2,	'uid_x9sWw65Z',	'demo',	'Usuario Demo',	'd8578edf8458ce06fbc5bb76a58c5ca4',	'pid_X8rdtBem',	1,	'appid_wtftrtcy;',	'',	'type',	'23 - 01 - 2012',	'h',	'mx',	'',	'demo@localhost',	'',	'',	'',	'',	1,	'4 2012-01-26 11:25:47:am'),
(3,	'uid_8sXXNI51',	'gomosoft',	'',	'd8578edf8458ce06fbc5bb76a58c5ca4',	'',	1,	'appid_wtftrtcy;',	'',	'',	'',	'',	'',	'',	'gomo@localhost',	'',	'',	'',	'',	1,	'4 2012-01-26 2:21:35:pm'),
(4,	'uid_JwXBCx8N',	'Itzell_Garcia',	'Itzell Nataly Garcia Martinez',	'168d3c263aa44687fc3f8e78ad56d869',	'pid_BoAaNkVo',	1,	'appid_wtftrtcy;',	'',	'type',	'Ma 24 Enero, 2012',	'm',	'mx',	'',	'bebiris@live.com',	'',	'',	'',	'',	1,	'4 2012-01-26 2:45:41:pm'),
(5,	'uid_jKpfp9rc',	'tall',	'',	'd8578edf8458ce06fbc5bb76a58c5ca4',	'',	1,	'appid_wtftrtcy;',	'',	'',	'',	'',	'',	'',	'dall@qwe',	'',	'',	'',	'',	1,	'4 2012-01-26 2:49:36:pm');

-- 2012-01-27 00:11:22
