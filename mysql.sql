-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2014 at 02:39 PM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.24

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gammu`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(30) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `phone_number`, `client_name`, `status`) VALUES
(1, '+6281805030211', 'guntur', '0'),
(2, '+6281578762345', 'john', '0');

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2014-09-03 14:31:05', '2014-08-19 02:59:17', '004B0061006200610072002000670065006D00620069007200610020006B0069006E0069002000490053004900200055004C0041004E0047002000610064006100200062006F006E00750073006E00790061002E002000490053004900200055004C0041004E0047002000520070002000350030005200420020004800410052004900200049004E0049002000310039004100670075007300740031003400200047005200410054004900530020003200300030003000300020006B006500200073006500730061006D006100200049006E0064006F0073006100740020006200650072006C0061006B00750020003300200068006100720069002E00200042006F006E00750073002000680061006E00790061002000310078002E00200049006E0066006F003A003100300030002E002000480052003100370032', '+6281578762345', 'Default_No_Compression', '', '+62816124', -1, 'REG john', 27, '', 'true'),
('2014-09-03 14:33:02', '2014-08-19 03:03:47', '00790061', '+6281805030211', 'Default_No_Compression', '', '+62818445009', -1, 'N', 28, '', 'true');

--
-- Triggers `inbox`
--
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER //
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox`
 FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `outbox`
--

INSERT INTO `outbox` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `SendBefore`, `SendAfter`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `Class`, `TextDecoded`, `ID`, `MultiPart`, `RelativeValidity`, `SenderID`, `SendingTimeOut`, `DeliveryReport`, `CreatorID`) VALUES
('2014-09-03 07:16:07', '2014-09-03 07:16:07', '2014-09-03 07:16:07', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Silakan pilih kasus di bawah ini:\r\nDemam Berdarah (K1)Batuk Berdahak (K2)', 1, 'false', -1, NULL, '2014-09-03 07:16:07', 'default', 'Gammu'),
('2014-09-03 07:16:33', '2014-09-03 07:16:33', '2014-09-03 07:16:33', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Mohon maaf, terjadi error, silakan mulai dari awal.', 2, 'false', -1, NULL, '2014-09-03 07:16:33', 'default', 'Gammu'),
('2014-09-03 07:16:56', '2014-09-03 07:16:56', '2014-09-03 07:16:56', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Silakan pilih kasus di bawah ini:\r\nDemam Berdarah (K1)Batuk Berdahak (K2)', 3, 'false', -1, NULL, '2014-09-03 07:16:56', 'default', 'Gammu'),
('2014-09-03 07:17:56', '2014-09-03 07:17:11', '2014-09-03 07:17:11', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Apakah terdapat bintik-bintik merah di sekitar kulit?\nJawab dengan Y / N.', 4, 'false', -1, NULL, '2014-09-03 07:17:11', 'default', 'Gammu'),
('2014-09-03 07:17:32', '2014-09-03 07:17:32', '2014-09-03 07:17:32', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Mohon maaf, terjadi error, silakan mulai dari awal.', 5, 'false', -1, NULL, '2014-09-03 07:17:32', 'default', 'Gammu'),
('2014-09-03 07:26:35', '2014-09-03 07:26:35', '2014-09-03 07:26:35', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Silakan pilih kasus di bawah ini:\r\nDemam Berdarah (K1)Batuk Berdahak (K2)', 6, 'false', -1, NULL, '2014-09-03 07:26:35', 'default', 'Gammu'),
('2014-09-03 07:26:45', '2014-09-03 07:26:45', '2014-09-03 07:26:45', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Apakah terdapat bintik-bintik merah di sekitar kulit?\r\nJawab dengan Y / N.', 7, 'false', -1, NULL, '2014-09-03 07:26:45', 'default', 'Gammu'),
('2014-09-03 07:27:08', '2014-09-03 07:27:08', '2014-09-03 07:27:08', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Pertanyaan ke-2:\r\nApakah demam terjadi secara mendadak?\r\nJawab dengan Y / N.', 8, 'false', -1, NULL, '2014-09-03 07:27:08', 'default', 'Gammu'),
('2014-09-03 07:27:29', '2014-09-03 07:27:29', '2014-09-03 07:27:29', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Diagnosis: Demam Berdarah Akut\r\nSaran: Segera ke dokter. Pertolongan pertama minum obat.', 9, 'false', -1, NULL, '2014-09-03 07:27:29', 'default', 'Gammu'),
('2014-09-03 07:53:23', '2014-09-03 07:53:23', '2014-09-03 07:53:23', '23:59:59', '00:00:00', NULL, '081578762345', 'Default_No_Compression', NULL, -1, 'coba!', 10, 'false', -1, NULL, '2014-09-03 07:53:23', 'default', 'Gammu'),
('2014-09-03 07:55:41', '2014-09-03 07:55:41', '2014-09-03 07:55:41', '23:59:59', '00:00:00', NULL, '081578762345', 'Default_No_Compression', NULL, -1, 'hello world!', 11, 'false', -1, NULL, '2014-09-03 07:55:41', 'default', 'Gammu'),
('2014-09-03 13:43:01', '2014-09-03 13:43:01', '2014-09-03 13:43:01', '23:59:59', '00:00:00', NULL, '+6281578762345', 'Default_No_Compression', NULL, -1, 'Terimakasih. Anda telah terdaftar.', 12, 'false', -1, NULL, '2014-09-03 13:43:01', 'default', 'Gammu'),
('2014-09-03 14:25:56', '2014-09-03 14:25:56', '2014-09-03 14:25:56', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Silakan pilih kasus di bawah ini:\r\nDemam Berdarah (K1)Batuk Berdahak (K2)', 13, 'false', -1, NULL, '2014-09-03 14:25:56', 'default', 'Gammu'),
('2014-09-03 14:26:15', '2014-09-03 14:26:15', '2014-09-03 14:26:15', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Apakah terdapat bintik-bintik merah di sekitar kulit?\r\nJawab dengan Y / N.', 14, 'false', -1, NULL, '2014-09-03 14:26:15', 'default', 'Gammu'),
('2014-09-03 14:31:05', '2014-09-03 14:31:05', '2014-09-03 14:31:05', '23:59:59', '00:00:00', NULL, '+6281578762345', 'Default_No_Compression', NULL, -1, 'Maaf, anda telah terdaftar, silakan mulai konsultasi dengan mengetikkan START.', 15, 'false', -1, NULL, '2014-09-03 14:31:05', 'default', 'Gammu'),
('2014-09-03 14:32:08', '2014-09-03 14:32:08', '2014-09-03 14:32:08', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Silakan pilih kasus di bawah ini:\r\nDemam Berdarah (K1)Batuk Berdahak (K2)', 16, 'false', -1, NULL, '2014-09-03 14:32:08', 'default', 'Gammu'),
('2014-09-03 14:32:33', '2014-09-03 14:32:33', '2014-09-03 14:32:33', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Apakah terdapat bintik-bintik merah di sekitar kulit?\r\nJawab dengan Y / N.', 17, 'false', -1, NULL, '2014-09-03 14:32:33', 'default', 'Gammu'),
('2014-09-03 14:32:47', '2014-09-03 14:32:47', '2014-09-03 14:32:47', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Pertanyaan ke-2:\r\nApakah demam terjadi secara mendadak?\r\nJawab dengan Y / N.', 18, 'false', -1, NULL, '2014-09-03 14:32:47', 'default', 'Gammu'),
('2014-09-03 14:33:02', '2014-09-03 14:33:02', '2014-09-03 14:33:02', '23:59:59', '00:00:00', NULL, '+6281805030211', 'Default_No_Compression', NULL, -1, 'Diagnosis: Demam Berdarah Akut\r\nSaran: Segera ke dokter. Pertolongan pertama minum obat.', 19, 'false', -1, NULL, '2014-09-03 14:33:02', 'default', 'Gammu');

--
-- Triggers `outbox`
--
DROP TRIGGER IF EXISTS `outbox_timestamp`;
DELIMITER //
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL DEFAULT '-1',
  `Name` text NOT NULL,
  `Number` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `Name` text NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`ID`, `UpdatedInDB`, `InsertIntoDB`, `TimeOut`, `Send`, `Receive`, `IMEI`, `Client`, `Battery`, `Signal`, `Sent`, `Received`) VALUES
('', '2014-08-19 08:12:15', '2014-08-19 02:57:43', '2014-08-19 08:12:25', 'yes', 'yes', '012345678901234', 'Gammu 1.32.0, Windows Server 2007 SP1, GCC 4.7, MinGW 3.11', 0, 100, 2, 2);

--
-- Triggers `phones`
--
DROP TRIGGER IF EXISTS `phones_timestamp`;
DELIMITER //
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sentitems`
--

INSERT INTO `sentitems` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `DeliveryDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `SenderID`, `SequencePosition`, `Status`, `StatusError`, `TPMR`, `RelativeValidity`, `CreatorID`) VALUES
('2014-08-19 03:01:47', '2014-08-19 03:01:20', '2014-08-19 03:01:47', NULL, '0072006F006C006500730079007300740065006D0020006B006F006E00730075006C0074006100730069', '081805030211', 'Default_No_Compression', '', '+62816124', -1, 'rolesystem konsultasi', 1, '', 1, 'SendingOKNoReport', -1, 233, 255, 'Gammu'),
('2014-08-19 08:04:27', '2014-08-19 08:04:03', '2014-08-19 08:04:27', NULL, '00680061006C006F0021', '081578762345', 'Default_No_Compression', '', '+62816124', -1, 'halo!', 2, '', 1, 'SendingOKNoReport', -1, 2, 255, 'Gammu');

--
-- Triggers `sentitems`
--
DROP TRIGGER IF EXISTS `sentitems_timestamp`;
DELIMITER //
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `case_solved` int(11) NOT NULL,
  `sms_count` int(11) NOT NULL,
  `sms_tariff` int(11) NOT NULL,
  `spam_counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `case_solved`, `sms_count`, `sms_tariff`, `spam_counter`) VALUES
(1, 1, 7, 350, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
