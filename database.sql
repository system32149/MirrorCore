-- Adminer 5.4.1 MariaDB 12.0.2-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `gjLevels`;
CREATE TABLE `gjLevels` (
      `gameVersion` tinyint(4) NOT NULL COMMENT 'GD version',
      `levelID` int(11) NOT NULL AUTO_INCREMENT,
      `levelName` tinytext NOT NULL,
      `description` text NOT NULL,
      `userID` int(11) NOT NULL,
      `userName` tinytext NOT NULL,
      `levelVersion` tinyint(4) NOT NULL,
      `difficultyNumerator` tinyint(2) NOT NULL,
      `officialSong` tinyint(2) NOT NULL,
      `downloads` mediumint(9) NOT NULL,
      `likes` mediumint(9) NOT NULL,
      PRIMARY KEY (`levelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci COMMENT='Contains level metadata (except for levelstrings)';


DROP TABLE IF EXISTS `gjUsers`;
CREATE TABLE `gjUsers` (
      `userID` int(11) NOT NULL AUTO_INCREMENT,
      `userName` tinytext NOT NULL,
      `udid` text NOT NULL,
      PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci COMMENT='User information';


-- 2025-10-22 13:48:40 UTC
