-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 16.Jan 2025, 14:59
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `traveler`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `destination`
--

INSERT INTO `destination` (`id`, `city`, `country`) VALUES
(1, 'Roma', 'Italy'),
(2, 'Venice', 'Italy'),
(3, 'London', 'England'),
(4, 'Rimini', 'Italy'),
(5, 'Istambul', 'Turkey');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(250) NOT NULL,
  `duration` int(11) NOT NULL,
  `person` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `idcity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `img`, `duration`, `person`, `price`, `idcity`) VALUES
(1, 'Roma-4*American Palace', 'Rome, the Eternal City, welcomes you with a unique atmosphere full of history, culture and Italian charm. Discover iconic monuments such as the Colosseum, the Trevi Fountain and St. Peter\'s Basilica, which will be the center of the Holy Year celebrations in 2025 - a unique spiritual event. After a day full of experiences, relax at the American Palace Hotel, which offers elegant rooms, excellent Italian cuisine and a great location with easy access to the main attractions.', 'img/Tour_Rome.jpg', 2, 2, 169, 1),
(2, 'London 4*Hampton by Hilton London Park Royal', 'More than 16 million foreign visitors take photos at Big Ben and Buckingham Palace every year. The Palace of Westminster, also known as the Houses of Parliament, is the seat of the Parliament of Great Britain and Northern Ireland. You probably already knew that. But did you know, for example, that it contains eight bars, six restaurants, 1,000 rooms, 100 staircases, 11 courtyards and even a hairdresser? Come and see the capital of England with us and bring home even more interesting experiences than most of the millions of tourists who visit every year.', 'img/Tour_London.jpg', 5, 2, 599, 3),
(3, 'Rimini-3*Up Hotel', 'Visit the picturesque seaside town of Rimini with our exclusive travel package. Enjoy your holiday at the stylish UP Hotel, known for its modern design and comfortable facilities. Start your day with a delicious breakfast before exploring all that Rimini has to offer. From beautiful beaches to historical monuments - there\'s something for everyone. Now with direct flights from Vienna.', 'img/Tour_Rimini.jpg', 7, 2, 799, 4),
(4, 'Istanbul-3*Mevlana', 'The city from which three great empires ruled - Roman, Byzantine and Ottoman, and each of them left their own traces here. A city standing with one foot in Europe and the other in Asia. Visit the legendary Blue Mosque, or the Hagia Sophia, which is one of the largest domed buildings in the world. In the heart of Istanbul you will find minarets, the 4th century Column of Constantine, Turkish baths and incredible museums. Peek into the Sultan\'s harem, or admire the incredible mix of goods in the Grand Bazaar - Kapalı Çarşı, which has become the largest covered bazaar in the world due to its size.', 'img/Tour_Istambul.jpg', 5, 1, 269, 5);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2 COMMENT '1 Admin 2 Editor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin@traveler.sk', 'admin', 1),
(2, 'user', 'user', 'user@traveler.sk', 'user', 2);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
