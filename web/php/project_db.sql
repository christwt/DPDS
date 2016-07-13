CREATE DATABASE IF NOT EXISTS project_db;
USE project_db;

CREATE TABLE IF NOT EXISTS `Clients` (
`Id` int(2) UNIQUE auto_increment,
`Name` varchar(40) NOT NULL,
`Password` varchar(20) NOT NULL,
`Business` varchar(40) NOT NULL,
`Lat` float NOT NULL,
`Lon` float NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `Clients` (`Id`, `Name`, `Password`, `Business`, `Lat`, `Lon` ) VALUES
(NULL, 'Will Christie', 'password', 'WTC', 39.7555, -105.2211),
(NULL, 'Paul Laliberte', 'password', 'PRKL', 39.7392, -104.9903),
(NULL, 'Kylee Budai', 'password', 'KMB', 30.0150, -105.2705),
(NULL, 'Nicholas Johnston', 'password', 'NJJ', 39.9205, -105.0867),
(NULL, 'Bill Christie', 'password','BTC', 39.8028, -105.0875);

CREATE TABLE IF NOT EXISTS `Orders` (
`Id` int(6) UNIQUE auto_increment,
`ClientId` int(2) NOT NULL,
`DroneId` int(6) NULL,
`OrderTimestamp` int(32) NOT NULL,
`Lat` float NOT NULL,
`Lon` float NOT NULL,
`Status` int(1) NOT NULL,
`TimeOut` int(32) NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT = 121111;

INSERT INTO `Orders` (`Id`, `ClientId`, `DroneId`, `OrderTimestamp`, `Lat`, `Lon`, `Status`, `TimeOut`) VALUES
(NULL, 1, 111111, 1466682030, 39.8367, -105.0372, 1, 1466682930),
(NULL, 2, 111113, 1466030713, 39.9778, -105.1319, 1, 1466031613),
(NULL, 3, 111115, 1466126100, 39.9614, -105.5108, 1, 1466127000),
(NULL, 4, 111117, 1466673175, 40.0861, -105.9395, 1, 1466674075);


CREATE TABLE IF NOT EXISTS `Drones` (
`Id` int(6) UNIQUE auto_increment,
`Status` int(1) NOT NULL,
`Renter` int(2) NOT NULL,
`Lat` float NOT NULL,
`Lon` float NOT NULL, 
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT = 111111; 

INSERT INTO `Drones` (`Id`, `Status`,`Renter`,`Lat`,`Lon`) VALUES
(NULL, 2,01, 39.8028, -105.088),
(NULL, 4,01, 39.7555, -105.221),
(NULL, 2,02, 39.8367, -105.037),
(NULL, 4,02, 39.7392, -104.99),
(NULL, 2,03,  39.2547,  -105.227),
(NULL, 4,03,  30.015,  -105.271),
(NULL, 2,04, 39.945, -105.817),
(NULL, 4,04,  39.9205, -105.087),
(NULL, 4,05,  39.8028, -105.088),
(NULL, 4,05,  39.8028,  -105.08);


CREATE TABLE IF NOT EXISTS `Status` (
`Id` int(1) UNIQUE auto_increment,
`Description` varchar(128) NOT NULL,
PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Status` (`Id`, `Description`) VALUES
(NULL, 'Processing'),
(NULL, 'In Transit'),
(NULL, 'Delivered'),
(NULL, 'Available');

