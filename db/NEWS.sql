-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2020 at 09:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

CREATE DATABASE IF NOT EXISTS `NEWS` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci ;
USE `NEWS`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `NEWS`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID_COMMENT` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `comment` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID_COMMENT`, `date`, `username`, `comment`) VALUES
(105, '2020-07-20 21:31:09', 'mita', 'Good decision.');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID_NEWS` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `news_type` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `heading` varchar(245) COLLATE utf8_slovenian_ci NOT NULL,
  `news` mediumtext COLLATE utf8_slovenian_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID_NEWS`, `date`, `news_type`, `heading`, `news`, `photo_name`) VALUES
(21, '2020-07-20 19:18:45', 'biznis', 'Ćulibrk: Najveći rast BDP-a ne znači ništa, pa lani je Južni Sudan bio rekorder', 'Srbija je, prema izveštaju Eurostata, najbolja po stopi ekonomskog rasta u prvom kvartalu 2020.godine, ali glavni urednik nedeljnika NIN Milan Ćulibrk za N1 ukazuje da taj podatak građanima Srbije ništa ne znači, i da malo ko zna da je prošle godine svetski rekorder po rastu BDP-a bio Južni Sudan, a da su u top 10 bile zemlje poput Tadžikistana i Burundija u kojima bi, kako je istakao, malo ko želeo da živi.', 'biznis.Ćulibrk: Najveći rast BDP-a ne znači ništa, pa lani je Južni Sudan bio rekorder.jpg'),
(22, '2020-07-20 19:26:59', 'sport', 'Bogdan objasnio: Sloboda je reč koja nosi jaku poruku', 'Košarkaš Sakramento Kingsa Bogdan Bogdanović u nastavku NBA sezone na dresu neće nositi svoje prezime.Kako prenose američki mediji nekadašnji igrač Partizana i Fenerbahčea je odlučio da na dresu nosi reč \"Sloboda\" i to na srpskom jeziku.\r\n\r\n\"Bogdan će nositi “Sloboda” kao svoju društveno pravednu poruku na dresu. To znači sloboda na srpskom jeziku. Očekuje se da će više od deset igrača imati poruke socijalne pravde na različitim jezicima”, napisao je Mark Spirs.', 'sport.Bogdan objasnio: Sloboda je reč koja nosi jaku poruku.jpeg'),
(23, '2020-07-20 19:30:20', 'politika', 'Boško Obradović podneo inicijativu za poništavanje izbora', 'Lider pokreta Dveri Boško Obradović podneo je Ustavnom sudu inicijativu za poništavanje izbora zbog, kako je rekao, menjanja izbornih zakona u izbornoj godini.\r\n\r\nObradović je naveo i da proces konstituisanja Narodne skupštine treba da bude prekinut sve dok se Ustavni sud ne izjasni o regularnosti izbora.\r\n\r\n\"Ukoliko postoji Ustavni sud Srbije, da on donese jedinu moguću presudu, a to je ocena da se izmene dva izborna zakona antiustavne. Da time nastupa ništavnost, odnosno poništavanje izbornog procesa na svim izbornim novima, što otvara prostor za potpuno nove izbore u celoj Srbiji\", rekao je Obradović ispred Ustavnog suda.', 'politika.Boško Obradović podneo inicijativu za poništavanje izbora.png');

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

CREATE TABLE `news_comment` (
  `ID_NEWS` int(11) NOT NULL,
  `ID_COMMENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`ID_NEWS`, `ID_COMMENT`) VALUES
(23, 105);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(7) NOT NULL,
  `username` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `username`, `password`, `email`) VALUES
(6, 'mita', '1ab78319b368fcf02fc4e8427faa614c', 'mita@rmail.com'),
(7, 'admin', 'c93ccd78b2076528346216b3b2f701e6', 'admin@rmail.com'),
(8, 'rasha', 'c9cffdf5d32f0d3db9e2a8a2dc7230ee', 'rasha@rmail.com'),
(9, 'ivana', 'efedad5b7988f090c543f266b37c9d9f', 'ivana@rmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE `user_comment` (
  `ID_USER` int(7) NOT NULL,
  `ID_COMMENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_COMMENT`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID_NEWS`);

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD KEY `FK.news.ID_NEWS_news_comment.ID_NEWS_idx` (`ID_NEWS`),
  ADD KEY `FK.comment.ID_COMMENT_news_comment.ID_COMMENT_idx` (`ID_COMMENT`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD KEY `FK_user.ID_USER_user_comment.ID_USER_idx` (`ID_USER`),
  ADD KEY `FK_comment.ID_COMMENT_user_comment.ID_COMMENT_idx` (`ID_COMMENT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID_COMMENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `ID_NEWS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD CONSTRAINT `FK.comment.ID_COMMENT_news_comment.ID_COMMENT` FOREIGN KEY (`ID_COMMENT`) REFERENCES `comment` (`ID_COMMENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK.news.ID_NEWS_news_comment.ID_NEWS` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID_NEWS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `FK_comment.ID_COMMENT_user_comment.ID_COMMENT` FOREIGN KEY (`ID_COMMENT`) REFERENCES `comment` (`ID_COMMENT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user.ID_USER_user_comment.ID_USER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;