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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `articles` (`id`, `aid`, `author`, `title`, `description`, `pics`, `create`, `sale`, `price`, `money`, `comments`, `status`, `likes`, `dislikes`, `oferts`) VALUES
(1,	'aid_hRiEVfN7',	'uid_u4uuCrlA',	'Maverik 86',	'Hermoso Automovil Ford Mustang maverik Mod. 86, 8 cilindros Rojo con franjas blancas.',	'pid_NC2k3N9I;pid_s785wbX9;pid_6Uf5kP5Q;pid_VQRbghAs;',	'6 2012-01-14 5:24:27:pm',	'',	16000,	'mxn',	'',	1,	'',	'',	'');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


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
  `articles` text NOT NULL,
  `email` text NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL,
  `followers` text NOT NULL,
  `followins` text NOT NULL,
  `status` int(11) NOT NULL,
  `register` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


-- 2012-01-22 22:26:04
