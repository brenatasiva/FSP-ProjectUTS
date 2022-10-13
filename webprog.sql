-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 04:48 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webprog`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemain`
--

CREATE TABLE `detail_pemain` (
  `idmovie` int(11) NOT NULL,
  `idpemain` int(11) NOT NULL,
  `peran` enum('Utama','Pembantu','Cameo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_pemain`
--

INSERT INTO `detail_pemain` (`idmovie`, `idpemain`, `peran`) VALUES
(1, 1, 'Utama'),
(1, 2, 'Utama'),
(2, 3, 'Cameo'),
(4, 2, 'Utama'),
(7, 1, 'Utama');

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `idgambar` int(11) NOT NULL,
  `extension` varchar(4) DEFAULT NULL,
  `idmovie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`idgambar`, `extension`, `idmovie`) VALUES
(8, 'jpg', 4),
(12, 'jpg', 1),
(13, 'jpg', 2),
(14, 'jpg', 5),
(15, 'jpg', 6),
(16, 'jpg', 7),
(17, 'jpg', 8),
(18, 'jpg', 10),
(19, 'jpg', 11),
(20, 'jpg', 12),
(21, 'jpg', 13),
(22, 'jpg', 14),
(23, 'jpg', 15),
(24, 'jpg', 16),
(25, 'jpg', 17),
(26, 'jpg', 18),
(27, 'jpg', 19),
(28, 'jpg', 20),
(29, 'jpg', 21);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `idgenre` int(11) NOT NULL,
  `nama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`idgenre`, `nama`) VALUES
(1, 'Comedy'),
(2, 'Drama'),
(3, 'Sci-fi'),
(4, 'Horror'),
(5, 'Thriller'),
(6, 'Romance'),
(7, 'War'),
(8, 'Biography'),
(9, 'History'),
(10, 'Action'),
(11, 'Adventure'),
(12, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `genre_movie`
--

CREATE TABLE `genre_movie` (
  `idmovie` int(11) NOT NULL,
  `idgenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre_movie`
--

INSERT INTO `genre_movie` (`idmovie`, `idgenre`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(4, 2),
(4, 3),
(5, 2),
(5, 4),
(5, 5),
(6, 1),
(6, 5),
(7, 1),
(7, 5),
(8, 1),
(8, 2),
(8, 3),
(10, 1),
(10, 2),
(11, 2),
(11, 8),
(11, 9),
(12, 2),
(12, 3),
(13, 10),
(13, 11),
(13, 12),
(14, 10),
(14, 11),
(14, 12),
(15, 2),
(15, 9),
(15, 10),
(16, 10),
(16, 11),
(17, 2),
(17, 3),
(17, 11),
(18, 4),
(18, 5),
(19, 2),
(19, 6),
(19, 8),
(20, 1),
(20, 2),
(20, 6),
(21, 3),
(21, 4),
(21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `nama`, `link`) VALUES
(1, 'Tambah Movie', 'w1/insermovie.php'),
(2, 'Index', 'w1/index.php');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `idmovie` int(11) NOT NULL,
  `judul` varchar(75) DEFAULT NULL,
  `rilis` date DEFAULT NULL,
  `skor` double DEFAULT NULL,
  `sinopsis` varchar(500) DEFAULT NULL,
  `serial` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`idmovie`, `judul`, `rilis`, `skor`, `sinopsis`, `serial`) VALUES
(1, 'A Million Ways To Die In The West', '2014-01-01', 6.2, 'As a cowardly farmer begins to fall for the mysterious new woman in town, he must put his newly found courage to the test when her husband, a notorious gun-slinger, announces his arrival.																						', 0),
(2, '1917', '2019-01-01', 8.9, 'April 6th, 1917. As a regiment assembles to wage war deep in enemy territory, two soldiers are assigned to race against time and deliver a message that will stop 1,600 men from walking straight into a deadly trap.							', 0),
(4, 'Superman', '2021-02-01', 10, 'GAk super																												', 1),
(5, 'Annabelle', '2014-01-01', 5.4, 'A couple begins to experience terrifying supernatural occurrences involving a vintage doll shortly after their home is invaded by satanic cultists.										', 1),
(6, 'The Conjuring', '2013-01-01', 7.5, 'Paranormal investigators Ed and Lorraine Warren work to help a family terrorized by a dark presence in their farmhouse.						', 1),
(7, 'The Conjuring 2', '2016-01-01', 7.3, 'Ed and Lorraine Warren travel to North London to help a single mother raising four children alone in a house plagued by a supernatural spirit.', 1),
(8, 'Doraemon the Movie: Nobita\'s New Dinosaur', '2020-01-01', 7.1, 'Nobita accidentally found a fossil dinosaur egg mixed with rocks in the dinosaur fossil exhibition site that he had visited before. He returned it to its original state with the \"Time blanket\". After hatching, the egg hatches a new species of dinosaur that is not named in the Cosmic Encyclopedia and names them Kyu and Myu Although they want to take care of them secretly, there are dinosaurs in the city still discovered by residents; Nobita and his friends were forced to bring them back to the Cr', 0),
(10, 'Good Will Hunting', '1997-01-01', 8.3, 'Will Hunting, a janitor at M.I.T., has a gift for mathematics, but needs help from a psychologist to find direction in his life.', 1),
(11, 'Hacksaw Ridge', '2016-01-01', 8.1, 'World War II American Army Medic Desmond T. Doss, who served during the Battle of Okinawa, refuses to kill people, and becomes the first man in American history to receive the Medal of Honor without firing a shot.', 0),
(12, 'Interstellar', '2014-01-01', 8.6, 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.', 1),
(13, 'Justice League', '2017-01-01', 6.2, 'Fueled by his restored faith in humanity and inspired by Superman\'s selfless act, Bruce Wayne enlists the help of his new-found ally, Diana Prince, to face an even greater enemy.', 1),
(14, 'Pacific Rim', '2013-01-01', 6.9, 'As a war between humankind and monstrous sea creatures wages on, a former pilot and a trainee are paired up to drive a seemingly obsolete special weapon in a desperate effort to save the world from the apocalypse.', 1),
(15, 'Pearl Harbour', '2001-01-01', 6.2, 'A tale of war and romance mixed in with history. The story follows two lifelong friends and a beautiful nurse who are caught up in the horror of an infamous Sunday morning in 1941.', 0),
(16, 'The Dark Night Rises', '2012-01-01', 8.4, 'Eight years after the Joker\'s reign of anarchy, Batman, with the help of the enigmatic Catwoman, is forced from his exile to save Gotham City from the brutal guerrilla terrorist Bane.', 1),
(17, 'The Martian', '2015-01-01', 8, 'An astronaut becomes stranded on Mars after his team assume him dead, and must rely on his ingenuity to find a way to signal to Earth that he is alive.', 1),
(18, 'The Nun', '2018-01-01', 5.3, 'A priest with a haunted past and a novice on the threshold of her final vows are sent by the Vatican to investigate the death of a young nun in Romania and confront a malevolent force in the form of a demonic nun.', 1),
(19, 'The Theory of Everything', '2014-01-01', 7.7, 'A look at the relationship between the famous physicist Stephen Hawking and his wife.', 0),
(20, 'You Are the Apple of My Eye', '2011-01-01', 7.6, 'A group of close friends who attend a private school all have a debilitating crush on the sunny star pupil, Shen Jiayi. The only member of the group who claims not to is Ke Jingteng, but he ends up loving her as well.', 1),
(21, 'The Platform', '2019-01-01', 7, 'A vertical prison with one cell per level. Two people per cell. Only one food platform and two minutes per day to feed. An endless nightmare trapped in The Hole.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemain`
--

CREATE TABLE `pemain` (
  `idpemain` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pemain`
--

INSERT INTO `pemain` (`idpemain`, `nama`, `gender`) VALUES
(1, 'Leonardo', 'Pria'),
(2, 'Tom Cruise', 'Pria'),
(3, 'Barbie', 'Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `idprofile` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`idprofile`, `nama`) VALUES
(1, 'manager'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `profile_has_menu`
--

CREATE TABLE `profile_has_menu` (
  `profile_idprofile` int(11) NOT NULL,
  `menu_idmenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(10) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(5) DEFAULT NULL,
  `idprofile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `salt`, `idprofile`) VALUES
('admin', 'mario', '32c2d7f9b877765008a4d1e65d2f7776f8d9cfb7', 'ossm5', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pemain`
--
ALTER TABLE `detail_pemain`
  ADD PRIMARY KEY (`idmovie`,`idpemain`),
  ADD KEY `fk_movie_has_pemain_pemain1_idx` (`idpemain`),
  ADD KEY `fk_movie_has_pemain_movie1_idx` (`idmovie`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`idgambar`),
  ADD KEY `fk_gambar_movie1_idx` (`idmovie`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idgenre`);

--
-- Indexes for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD PRIMARY KEY (`idmovie`,`idgenre`),
  ADD KEY `fk_movie_has_genre_genre1_idx` (`idgenre`),
  ADD KEY `fk_movie_has_genre_movie_idx` (`idmovie`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`idmovie`);

--
-- Indexes for table `pemain`
--
ALTER TABLE `pemain`
  ADD PRIMARY KEY (`idpemain`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`idprofile`);

--
-- Indexes for table `profile_has_menu`
--
ALTER TABLE `profile_has_menu`
  ADD PRIMARY KEY (`profile_idprofile`,`menu_idmenu`),
  ADD KEY `fk_profile_has_menu_menu1_idx` (`menu_idmenu`),
  ADD KEY `fk_profile_has_menu_profile1_idx` (`profile_idprofile`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_users_profile1_idx` (`idprofile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `idgambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `idmovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `idprofile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemain`
--
ALTER TABLE `detail_pemain`
  ADD CONSTRAINT `fk_movie_has_pemain_movie1` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movie_has_pemain_pemain1` FOREIGN KEY (`idpemain`) REFERENCES `pemain` (`idpemain`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `fk_gambar_movie1` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD CONSTRAINT `fk_movie_has_genre_genre1` FOREIGN KEY (`idgenre`) REFERENCES `genre` (`idgenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movie_has_genre_movie` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profile_has_menu`
--
ALTER TABLE `profile_has_menu`
  ADD CONSTRAINT `fk_profile_has_menu_menu1` FOREIGN KEY (`menu_idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_has_menu_profile1` FOREIGN KEY (`profile_idprofile`) REFERENCES `profile` (`idprofile`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profile1` FOREIGN KEY (`idprofile`) REFERENCES `profile` (`idprofile`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
