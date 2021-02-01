-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 09:23 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID` int(11) NOT NULL,
  `comtext` text NOT NULL,
  `comon` int(11) NOT NULL,
  `sender` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID`, `comtext`, `comon`, `sender`, `date`) VALUES
(1, 'aaaa', 9, 'admin', '19/01/2021 - 18:51'),
(2, 'dipshit\r<br>', 9, 'null', '19/01/2021 - 18:51'),
(3, 'Ass', 9, 'crilluz', '19/01/2021 - 18:53'),
(4, 'I\'m on tv', 5, 'crilluz', '19/01/2021 - 18:54'),
(5, 'Justified!', 6, 'hjalle_chad', '19/01/2021 - 19:34'),
(6, 'Based', 11, 'admin', '19/01/2021 - 19:34'),
(8, 'Fake news\r<br>', 11, 'mst_chefen', '19/01/2021 - 20:00'),
(9, 'No fake news', 11, 'null', '19/01/2021 - 20:01'),
(10, 'ass', 11, 'admin', '19/01/2021 - 21:14'),
(11, 'reeeeeeeeeeee', 8, 'ghost', '19/01/2021 - 21:17');

-- --------------------------------------------------------

--
-- Table structure for table `inlagg`
--

CREATE TABLE `inlagg` (
  `id` int(11) NOT NULL,
  `bild` text NOT NULL,
  `content` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inlagg`
--

INSERT INTO `inlagg` (`id`, `bild`, `content`, `date`) VALUES
(4, 'img/asdada.png', '<h2>Lokal Hjalle irriterad på normies</h2><b>\"De förstör vårat gaming community, I am outraged\" -Sir Utsi</b><br><p>Den massiva chaden vid namn Hjalle har tappat sin nyfunna fred då han hörde ett gäng 12 åringar snacka skit om Twilight Princess. \r</p><p>\r</p><p>\"De ska vara glada att jag håller 2 meters avstånd, annars skulle det smälla!\"</p>', '19/01/2021'),
(5, 'img/download.jpg', '<h2>Lokal terrorist arresterad</h2><b>Efter 3 år på watchlisten har SÄPO äntligen arresterat neo-fascisten.</b><br><p>En höger-extremist i Luleåområdet blev arresterad vid 12:43 idag efter månader av suspekt aktivitet. Mannen har bland annat laddat ner flertal pdfer om vapenbygge, flertal bombmanualer, 3d filer för automatgevär, samt hittades Mein kampf, UNA-bomber manifestet, och en säck LSD på plats.\r</p><p>\r</p><p>\"Det känns skönt att landet är en gnutta säkrare från \'människor\' som honom\" sade Klas Friberg, säkerhetspolischef.\r</p><p>\r</p><p>Terroristen har ca 6 dagar på sig att tänka över sina brott innan giljotinen används igen för första gången på 400 år.</p>', '19/01/2021'),
(6, 'img/ekrvoxe6f3y11.jpg', '<h2>JUST NU: Hettat gamermoment på bro.</h2><b>\"Han får inte säga Nigger, bara svarta och kriminella säger sånt\" - Lokal antirasist.</b><br><p>BalderNytt har just fått in nyheter om att en lokal man, som är vitare än måsskit, har sagt ett ord han är flertal nyanser för ljus för att säga idag.\r\n</p><p>\r\n</p><p>Vi tog debatten vidare med Isa, en lokal antirasist.\r\n</p><p>\r\n</p><p>-Jadu Isa, vad tycker du om vad som hänt i idag?\r\n</p><p>\r\n</p><p>Isa: \"Det är hemskt, det är ett starkt ord, så mycket förtryck och hat är laddat i ordet. Ingen vit ska använda det. Bästa fall bör det vara olagligt!\"\r\n</p><p>\r\n</p><p>-Vad känner du personligen om just \"n-ordet\"?\r\n</p><p>\r\n</p><p>Isa: \"Det är helt sjukt att vita än idag går runt och kallar folk för niggers. Det är inte rätt. Bara kriminella och svarta får säga det.\"\r\n</p><p>\r\n</p><p>-Du antyder alltså att kriminella som är vita får säga det?\r\n</p><p>\r\n</p><p>Isa: \"Var inte fånig, det finns inga vita kriminella.\"</p>', '19/01/2021'),
(8, 'img/Snapchat-1309262907.jpg', '<h2>Notorisk blottare i farten igen.</h2><b>\"Det var inte jag det var alkoholen, I promise\" - Notoriska Blottaren</b><br><p>Den notoriska blottaren från Porsön har ännu en gång visat sitt ansikte (och könsorgan) runtom Lab-trakterna.\r</p><p>\r</p><p>\"Sluta fan\" - Lokal boende</p>', '19/01/2021'),
(9, 'img/timpa.png', '<h2>Lokal ginger konspirerar mot BalderNytt</h2><b>Redan 1 timme efter BalderNytts premiär har gingern satt igång hatvågen.</b><br><p>Lokal ginger ville inte läsa BalderNytt, i försvar sade Gingern \"Ooga booga jag ska plugga fysik\" </p>', '19/01/2021'),
(10, 'img/Untitled.png', '<h2>The man who challenged Gordon Ramsay, and lived!</h2><b>Fake News media won\'t tell you about this man!</b><br><p>idk what to put here</p>', '19/01/2021'),
(11, 'img/radical.png', '<h2>Lärare på LTU radikaliserar elever</h2><b>En lärare på LTU har gjort en hel klass till ancaps.</b><br><p>\"Jamen vadå, det är ju common sense\" - Läraren\r</p><p>\r</p><p>MST Luleå har fått en våg av nya rekryter efter att en lärare på Luleå Tekniska Universitet har, under en lektion i programmering, gått på en lång rant om hur skatter är stöld.\r</p><p>\r</p><p>\"Vi tror detta kommer leda till att fler blir intellectuals som oss.\" - Johan Ekman, Ledare för MST\r</p><p>\r</p><p>Administrationen på LTU har ännu inte gått ut med ett officiellt uttalande angående händelsen.</p>', '19/01/2021');

-- --------------------------------------------------------

--
-- Table structure for table `msgz`
--

CREATE TABLE `msgz` (
  `ID` int(11) NOT NULL,
  `sender` text NOT NULL,
  `msg` text NOT NULL,
  `msgTo` text NOT NULL,
  `isRead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msgz`
--

INSERT INTO `msgz` (`ID`, `sender`, `msg`, `msgTo`, `isRead`) VALUES
(1, 'admin', 'ass', 'crilluz', 0),
(2, 'crilluz', 'dadad', 'admin', 1),
(3, 'crilluz', 'dadada', 'admin', 1),
(4, 'crilluz', 'fasffsasafsaf', 'admin', 1),
(5, 'crilluz', 'safsafsafsafasf', 'admin', 1),
(6, 'admin', 'How ya doin', 'hjalle_chad', 1),
(7, 'admin', 'ass', 'crilluz', 0),
(8, 'hjalle_chad', 'wtf bro', 'admin', 1),
(9, 'hjalle_chad', 'ogaboga', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `img` text NOT NULL,
  `power` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `img`, `power`) VALUES
('Admin', 'b94e604c15871f0a91c084869dbde1be6188b71540c2ed2d314e09c8d11c2f18', 'pp/adminasfasfas.png', 1),
('hjalle_chad', '84172186da6ee6caacab650b83d4283779683590db727b12baac2234494d925e', 'pp/hjalle_chadD_84ve3UwAEz-ao.jpg', 1),
('null', 'ccf991050883801613aef8a1ae29342460010d1d426124326bafa03d6aaa64b2', 'pp/null4864864684.gif', 0),
('mst_chefen', 'b7189997bcb223fbf5922b0c65a2c45e9185c4313a89526b9fc0de6082691a1e', 'pp/noimg.jpg', 0),
('Carlus', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'pp/noimg.jpg', 0),
('CrilluZ', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'pp/noimg.jpg', 0),
('ASSMAN', '4bfdc6fd836975f3f384bcd1f5126c46a7204cb12be5397a5283a583a553f225', 'pp/noimg.jpg', 0),
('megafag', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'pp/noimg.jpg', 0),
('ghost', 'ead6ef03d61ee60c533d6d450c50a1e559a8a37f6b796a4094cd0dac6b744428', 'pp/noimg.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inlagg`
--
ALTER TABLE `inlagg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msgz`
--
ALTER TABLE `msgz`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inlagg`
--
ALTER TABLE `inlagg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `msgz`
--
ALTER TABLE `msgz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
