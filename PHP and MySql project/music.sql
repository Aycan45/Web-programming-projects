-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 юни 2020 в 18:04
-- Версия на сървъра: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Структура на таблица `albums`
--

CREATE TABLE `albums` (
  `album_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `album_genre_id` int(10) UNSIGNED NOT NULL COMMENT 'ВК към жанр',
  `name` varchar(64) NOT NULL COMMENT 'Име на албума',
  `price` int(4) DEFAULT NULL COMMENT 'Цена на албума',
  `description` text DEFAULT NULL COMMENT 'описание',
  `picture` varchar(32) DEFAULT NULL COMMENT 'снимка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Албуми';

--
-- Схема на данните от таблица `albums`
--

INSERT INTO `albums` (`album_id`, `album_genre_id`, `name`, `price`, `description`, `picture`) VALUES
(1, 1, 'The Marshall Mathers LP', 100, 'Един от най-добрите албуми на рапъра Eminem', 'img/em.jpg'),
(2, 1, 'Astroworld', 120, 'Най-успешният албум на Travis Scott', 'img/travis.jpg'),
(3, 1, 'Heaven or hell', 100, 'Първият албум на Don Toliver', 'img/don.jpg'),
(4, 2, 'Art of war', 50, 'Много добър албум на Sabaton', 'img/saba.jpg'),
(5, 2, 'The Last stand', 60, 'Класика на Sabaton', 'img/sa.jpg'),
(6, 3, 'Thank U, next', 130, 'Хубави песни на Ariana Grande', 'img/ariana.jpg'),
(7, 3, 'Loud', 70, 'Класика на Rihanna', 'img/rihanna.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `album_genres`
--

CREATE TABLE `album_genres` (
  `album_genre_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `genre` varchar(32) NOT NULL COMMENT 'жанр на албума'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Жанрове на албуми';

--
-- Схема на данните от таблица `album_genres`
--

INSERT INTO `album_genres` (`album_genre_id`, `genre`) VALUES
(1, 'Рап'),
(2, 'Метъл'),
(3, 'Поп');

-- --------------------------------------------------------

--
-- Структура на таблица `persons`
--

CREATE TABLE `persons` (
  `person_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `username` varchar(16) NOT NULL COMMENT 'Потребителско име',
  `person_type` tinyint(1) NOT NULL COMMENT 'Тип потребител: 1-администратор',
  `pass` varchar(16) NOT NULL COMMENT 'Парола',
  `name` varchar(128) NOT NULL COMMENT 'Име'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `persons`
--

INSERT INTO `persons` (`person_id`, `username`, `person_type`, `pass`, `name`) VALUES
(1, 'admin', 1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `aalbum_genre_id` (`album_genre_id`);

--
-- Indexes for table `album_genres`
--
ALTER TABLE `album_genres`
  ADD PRIMARY KEY (`album_genre_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `album_genres`
--
ALTER TABLE `album_genres`
  MODIFY `album_genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ПК', AUTO_INCREMENT=2;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`album_genre_id`) REFERENCES `album_genres` (`album_genre_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
