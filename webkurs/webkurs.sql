-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 28 2020 г., 23:27
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `webkurs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `estate`
--

CREATE TABLE IF NOT EXISTS `estate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `price` decimal(32,0) NOT NULL,
  `login_users` varchar(32) NOT NULL,
  `square` decimal(32,0) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `publication_date` datetime NOT NULL,
  `info` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `estate`
--

INSERT INTO `estate` (`id`, `type`, `price`, `login_users`, `square`, `adress`, `publication_date`, `info`) VALUES
(1, 'Ð”Ð¾Ð¼', '5000000', '1231', '123', 'Ð‘Ñ€ÑÐ½ÑÐº, 1', '2020-12-27 15:55:30', 'Ð¡ÑƒÐ¿ÐµÑ€ ÐºÐ²Ð°Ñ€Ñ‚Ð¸Ñ€Ñ‹ Ð¿Ð¾ ÑÑƒÐ¿ÐµÑ€ Ñ†ÐµÐ½Ð°Ð¼!'),
(2, 'Ð”Ð¾Ð¼', '15000000', '123123', '150', 'Ð‘Ñ€ÑÐ½ÑÐº, 2', '2020-12-27 18:53:51', 'Ð¡ÑƒÐ¿ÐµÑ€ Ð´Ð¾Ð¼ Ð¿Ð¾ ÑÑƒÐ¿ÐµÑ€ Ð½Ð¸Ð·ÐºÐ¾Ð¹ Ñ†ÐµÐ½Ðµ! Ð•ÑÑ‚ÑŒ Ð³Ð°Ð·, Ð²Ð¾Ð´Ð°, Ð¾Ñ‚Ð¾Ð¿Ð»ÐµÐ½Ð¸Ðµ, ÑÑ‚ÐµÐ½Ñ‹, Ð¿Ð¾Ð», Ð¿Ð¾Ñ‚Ð¾Ð»Ð¾Ðº, ÐºÐ°Ð½Ð°Ð»Ð¸Ð·Ð°Ñ†Ð¸Ñ, ÐºÑ€Ñ‹ÑˆÐ°, Ð´Ð²ÐµÑ€ÑŒ, 3 Ð¾ÐºÐ½Ð°, ÐºÑ€Ð¾Ð²Ð°Ñ‚ÑŒ, Ð¿Ð»Ð¸Ñ‚Ð°!'),
(6, 'ÐšÐ¾Ð¼Ð½Ð°Ñ‚a', '123', '1231', '123', 'Ð‘Ñ€ÑÐ½ÑÐº, 3', '2020-12-28 00:47:21', 'Ñ‚ÐµÑÑ‚ Ñ Ñ„Ð¾Ñ‚Ð¾ ÐºÐ¾Ð¼Ð½Ð°Ñ‚Ð°'),
(8, 'Ð”Ð¾Ð¼', '1231', '1231', '321', 'Ð‘Ñ€ÑÐ½ÑÐº, 4', '2020-12-28 01:06:16', 'Ñ‚ÐµÑÑ‚ ÐºÐ°Ñ€Ñ‚Ð¸Ð½ÐºÐ¸ 3 ÐºÐ¾Ð¼Ð¼ Ð½ÐµÐ´Ð²'),
(9, 'Ð”Ð¾Ð¼', '123123', '1231', '12312', 'ÐœÐ¾ÑÐºÐ²Ð°, 1', '2020-12-28 12:40:13', 'Ñ‚ÐµÑÑ‚ ÐºÐ°Ñ€Ñ‚Ð¸Ð½ÐºÐ¸');

-- --------------------------------------------------------

--
-- Структура таблицы `estate_photos`
--

CREATE TABLE IF NOT EXISTS `estate_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estate` int(10) unsigned NOT NULL,
  `photo_path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `photo_path` (`photo_path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `estate_photos`
--

INSERT INTO `estate_photos` (`id`, `id_estate`, `photo_path`) VALUES
(1, 1, 'assets/uploads/e2a155f1abd8adb7c874b51fa39f56d8.jpg'),
(2, 1, 'assets/uploads/b85cfbd9b0f2e92c9aa653634a3e9a7b.jpg'),
(3, 1, 'assets/uploads/b7aa5bb0edff8fefc738ed3953794966.jpg'),
(4, 2, 'assets/uploads/d3de4182486d003e3921a6ad580bb92a.jpg'),
(5, 2, 'assets/uploads/0b3992e4a7a22e04f8acdd440b09c522.jpg'),
(6, 6, 'assets/uploads/be0bc41f1265748f882f27936663c7cd.jpg'),
(7, 6, 'assets/uploads/daeae4b2376c59c7efd2b66ecf262bad.jpg'),
(8, 6, 'assets/uploads/74204d9224f269c0a8b408b4c153445e.jpg'),
(9, 6, 'assets/uploads/253adea46d0d516a3ea4ed291fc112f3.jpg'),
(10, 8, 'assets/uploads/0ec9f1f339e79ca479adced141d89e28.jpg'),
(11, 8, 'assets/uploads/8999677f5efd8832f6431b2fac3ee656.jpg'),
(12, 9, 'assets/uploads/2abebf1450768d6f38d87f0fd3a659ef.jpg'),
(13, 9, 'assets/uploads/d6f37bfcdbb8627b2b76fed4d2960529.jpg'),
(14, 9, 'assets/uploads/de8333a2949988d682036fe5d8ea5473.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `pseudonym` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `number` varchar(32) DEFAULT NULL,
  `root` varchar(32) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`login`),
  UNIQUE KEY `pseudonym` (`pseudonym`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `pseudonym`, `mail`, `number`, `root`) VALUES
(1, '123123', '63ee451939ed580ef3c4b6f0109d1fd0', '123123', '123123', '123', 'user'),
(5, '1231', '6e9665ab37ca1887a7e0179c5fac0dc0', '1231', '123123', '880055535351', 'admin'),
(7, '1111', '74be16979710d4c4e7c6647856088456', '1111', '1111', '1111', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `users_connects`
--

CREATE TABLE IF NOT EXISTS `users_connects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` int(10) unsigned NOT NULL,
  `hash` varchar(32) NOT NULL,
  `login_users` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_users` (`login_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `users_connects`
--

INSERT INTO `users_connects` (`id`, `ip`, `hash`, `login_users`) VALUES
(9, 2130706433, 'e574919cf1dd97b0ce7d8fdb04a1b0c9', '1231');

-- --------------------------------------------------------

--
-- Структура таблицы `users_favorite_estate`
--

CREATE TABLE IF NOT EXISTS `users_favorite_estate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estate` int(10) unsigned NOT NULL,
  `login_users` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_repass`
--

CREATE TABLE IF NOT EXISTS `users_repass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) NOT NULL,
  `repass_time` datetime NOT NULL,
  `login_users` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_users` (`login_users`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
