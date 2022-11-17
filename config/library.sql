-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 06:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `writerid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `published_in` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `writerid`, `title`, `year`, `genre`, `published_in`) VALUES
(1, 7, 'The Raven', 1845, 'Poem', 'New York'),
(2, 4, 'Animal Farm', 1945, 'Novella', 'England'),
(3, 1, 'Crime and Punishment', 1866, 'Novel', 'Russia'),
(4, 6, 'Women', 1978, 'Novel', 'United States'),
(5, 3, 'The Metamorphosis', 1915, 'Novella', 'Germany'),
(6, 5, 'Heart of a Dog', 1925, 'Novel', 'Russia'),
(7, 2, 'The Catcher in the Rye', 1951, 'Novel', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `writer`
--

CREATE TABLE `writer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth` int(4) NOT NULL,
  `death` int(4) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `writer`
--

INSERT INTO `writer` (`id`, `name`, `birth`, `death`, `nationality`, `img`) VALUES
(1, 'Fyodor Dostoevsky', 1821, 1881, 'Russia', 'img/writers/dostoevsky.png'),
(2, 'J. D. Salinger', 1919, 2010, 'United States', 'img/writers/salinger.png'),
(3, 'Franz Kafka', 1883, 1924, 'Germany', 'img/writers/kafka.png'),
(4, 'George Orwell', 1903, 1950, 'England', 'img/writers/orwell.png'),
(5, 'Mikhail Bulgakov', 1891, 1940, 'Russia', 'img/writers/bulgakov.png'),
(6, 'Charles Bukowski', 1920, 1994, 'United States', 'img/writers/bukowski.png'),
(7, 'Edgar Allan Poe', 1809, 1849, 'United States', 'img/writers/poe.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `writerid` (`writerid`);

--
-- Indexes for table `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `writer`
--
ALTER TABLE `writer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`writerid`) REFERENCES `writer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
