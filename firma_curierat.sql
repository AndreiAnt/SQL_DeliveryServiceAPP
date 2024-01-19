-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 10:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firma_curierat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Username`, `Password`) VALUES
(0, 'user0', 'parola0'),
(1, 'user1', 'parola1'),
(2, 'user2', 'parola2'),
(3, 'user3', 'parola3'),
(4, 'user4', 'parola4'),
(5, 'user5', 'parola5');

-- --------------------------------------------------------

--
-- Table structure for table `curieri`
--

CREATE TABLE `curieri` (
  `Curieri_ID` int(11) NOT NULL,
  `Nume` varchar(255) DEFAULT NULL,
  `Prenume` varchar(255) DEFAULT NULL,
  `Varsta` int(11) DEFAULT NULL,
  `CNP` varchar(255) DEFAULT NULL,
  `Numar_Permis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curieri`
--

INSERT INTO `curieri` (`Curieri_ID`, `Nume`, `Prenume`, `Varsta`, `CNP`, `Numar_Permis`) VALUES
(1, 'Ionescu', 'Ana', 28, '1980712345678', 'AB 123456'),
(2, 'Ionescu', 'Andrei', 28, '1981123456789', 'BC 234567'),
(3, 'Radulescu', 'Elena', 22, '1990312345678', 'CD 345678'),
(4, 'Dumitrescu', 'Florin', 40, '1980523456789', 'DE 456789'),
(5, 'Vasilescu', 'Maria', 31, '1990723456789', 'EF 567890');

-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE `date` (
  `Date_Persoana_ID` int(11) NOT NULL,
  `Telefon` varchar(255) DEFAULT NULL,
  `CUI` varchar(255) DEFAULT NULL,
  `CNP` varchar(255) DEFAULT NULL,
  `Adresa` varchar(255) DEFAULT NULL,
  `Cont_Bancar` varchar(255) DEFAULT NULL,
  `Cod_Client` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Nume_Persoana_Contact` varchar(255) DEFAULT NULL,
  `Telefon_Persoana_Contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `date`
--

INSERT INTO `date` (`Date_Persoana_ID`, `Telefon`, `CUI`, `CNP`, `Adresa`, `Cont_Bancar`, `Cod_Client`, `Email`, `Nume_Persoana_Contact`, `Telefon_Persoana_Contact`) VALUES
(1, '0722123456', 'RO123456', '1234567890123', 'Strada Exemplu nr. 1', 'RO12BANK1234567890123456', 'C123', 'john.doe@example.com', 'John Doe', '0711122333'),
(2, '0733123456', 'RO654321', '9876543210123', 'Strada Test nr. 2', 'RO34BANK1234567890123456', 'C456', 'jane.smith@example.com', 'Jane Smith', '0722333444'),
(3, '0744123456', 'RO789012', '4567890123456', 'Strada Sample nr. 3', 'RO56BANK1234567890123456', 'C789', 'alex.jones@example.com', 'Alex Jones', '0733444555'),
(4, '0755123456', 'RO987654', '7890123456789', 'Strada Demo nr. 4', 'RO78BANK1234567890123456', 'C012', 'emily.white@example.com', 'Emily White', '0744555666'),
(5, '0766123456', 'RO543210', '3210987654321', 'Strada Showcase nr. 5', 'RO90BANK1234567890123456', 'C345', 'peter.green@example.com', 'Peter Green', '0755666777');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `Factura_ID` int(11) NOT NULL,
  `AWB_ID` int(11) DEFAULT NULL,
  `Platitor_ID` int(11) DEFAULT NULL,
  `Pret` int(11) DEFAULT NULL,
  `Data_Incasarii` datetime DEFAULT NULL,
  `Data_Emiterii` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factura`
--

INSERT INTO `factura` (`Factura_ID`, `AWB_ID`, `Platitor_ID`, `Pret`, `Data_Incasarii`, `Data_Emiterii`) VALUES
(1, 1, 1, 50, '2023-11-20 10:00:00', '2023-11-19 08:30:00'),
(2, 2, 2, 30, '2023-11-21 12:15:00', '2023-11-19 09:45:00'),
(3, 3, 3, 70, '2023-11-22 15:30:00', '2023-11-19 11:00:00'),
(4, 4, 4, 40, '2023-11-23 18:45:00', '2023-11-19 13:15:00'),
(5, 5, 5, 60, '2023-11-24 21:00:00', '2023-11-18 14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `livrare`
--

CREATE TABLE `livrare` (
  `AWB_ID` int(11) NOT NULL,
  `Pachet_ID` int(11) DEFAULT NULL,
  `Metoda_ID` int(11) DEFAULT NULL,
  `Expeditor_ID` int(11) DEFAULT NULL,
  `Destinatar_ID` int(11) DEFAULT NULL,
  `Tip` varchar(255) DEFAULT NULL,
  `Cod_Unic` varchar(255) DEFAULT NULL,
  `Durata` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livrare`
--

INSERT INTO `livrare` (`AWB_ID`, `Pachet_ID`, `Metoda_ID`, `Expeditor_ID`, `Destinatar_ID`, `Tip`, `Cod_Unic`, `Durata`) VALUES
(1, 1, 1, 1, 2, 'Urgenta', 'ABC123', '24 ore'),
(2, 2, 2, 3, 4, 'Normala', 'DEF456', '48 ore'),
(3, 3, 3, 5, 1, 'Urgenta', 'GHI789', '12 ore'),
(4, 4, 4, 2, 3, 'Normala', 'JKL012', '72 ore'),
(5, 5, 1, 4, 5, 'Urgenta', 'MNO345', '36 ore');

-- --------------------------------------------------------

--
-- Table structure for table `livrare_curier`
--

CREATE TABLE `livrare_curier` (
  `Curieri_ID` int(11) NOT NULL,
  `AWB_ID` int(11) NOT NULL,
  `Ore_Munca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livrare_curier`
--

INSERT INTO `livrare_curier` (`Curieri_ID`, `AWB_ID`, `Ore_Munca`) VALUES
(1, 1, 5),
(2, 2, 8),
(3, 3, 6),
(4, 4, 7),
(5, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `metoda`
--

CREATE TABLE `metoda` (
  `Metoda_ID` int(11) NOT NULL,
  `Denumire` varchar(255) DEFAULT NULL,
  `PretUM` int(11) DEFAULT NULL,
  `Unitate_Masura` varchar(255) DEFAULT NULL,
  `Viteza_Medie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metoda`
--

INSERT INTO `metoda` (`Metoda_ID`, `Denumire`, `PretUM`, `Unitate_Masura`, `Viteza_Medie`) VALUES
(1, 'Avion', 15, 'Km', 900),
(2, 'Masina', 1, 'Km', 50),
(3, 'Dubita', 1, 'Km', 90),
(4, 'Scooter', 3, 'Km', 60);

-- --------------------------------------------------------

--
-- Table structure for table `pachet`
--

CREATE TABLE `pachet` (
  `Pachet_ID` int(11) NOT NULL,
  `Persoana_Plecare_ID` int(11) DEFAULT NULL,
  `Persoana_Sosire_ID` int(11) DEFAULT NULL,
  `Dimensiune_Lenght` int(11) DEFAULT NULL,
  `Dimensiune_Width` int(11) DEFAULT NULL,
  `Dimensiune_Height` int(11) DEFAULT NULL,
  `Locatie_Plecare` varchar(255) DEFAULT NULL,
  `Locatie_Sosire` varchar(255) DEFAULT NULL,
  `Greutate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pachet`
--

INSERT INTO `pachet` (`Pachet_ID`, `Persoana_Plecare_ID`, `Persoana_Sosire_ID`, `Dimensiune_Lenght`, `Dimensiune_Width`, `Dimensiune_Height`, `Locatie_Plecare`, `Locatie_Sosire`, `Greutate`) VALUES
(1, 2, 2, 40, 30, 20, 'Adresa11', 'Adresa12', 7),
(2, 3, 4, 35, 25, 15, 'Adresa13', 'Adresa14', 5),
(3, 5, 1, 45, 35, 18, 'Adresa15', 'Adresa16', 9),
(4, 2, 3, 25, 15, 8, 'Adresa17', 'Adresa18', 3),
(5, 4, 5, 55, 45, 25, 'Adresa19', 'Adresa20', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `curieri`
--
ALTER TABLE `curieri`
  ADD PRIMARY KEY (`Curieri_ID`);

--
-- Indexes for table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`Date_Persoana_ID`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`Factura_ID`),
  ADD KEY `AWB_ID` (`AWB_ID`),
  ADD KEY `Platitor_ID` (`Platitor_ID`);

--
-- Indexes for table `livrare`
--
ALTER TABLE `livrare`
  ADD PRIMARY KEY (`AWB_ID`),
  ADD KEY `Pachet_ID` (`Pachet_ID`),
  ADD KEY `Metoda_ID` (`Metoda_ID`),
  ADD KEY `Expeditor_ID` (`Expeditor_ID`),
  ADD KEY `Destinatar_ID` (`Destinatar_ID`);

--
-- Indexes for table `livrare_curier`
--
ALTER TABLE `livrare_curier`
  ADD PRIMARY KEY (`Curieri_ID`,`AWB_ID`),
  ADD KEY `AWB_ID` (`AWB_ID`);

--
-- Indexes for table `metoda`
--
ALTER TABLE `metoda`
  ADD PRIMARY KEY (`Metoda_ID`);

--
-- Indexes for table `pachet`
--
ALTER TABLE `pachet`
  ADD PRIMARY KEY (`Pachet_ID`),
  ADD KEY `Persoana_Plecare_ID` (`Persoana_Plecare_ID`),
  ADD KEY `Persoana_Sosire_ID` (`Persoana_Sosire_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`AWB_ID`) REFERENCES `livrare` (`AWB_ID`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`Platitor_ID`) REFERENCES `date` (`Date_Persoana_ID`);

--
-- Constraints for table `livrare`
--
ALTER TABLE `livrare`
  ADD CONSTRAINT `livrare_ibfk_1` FOREIGN KEY (`Pachet_ID`) REFERENCES `pachet` (`Pachet_ID`),
  ADD CONSTRAINT `livrare_ibfk_2` FOREIGN KEY (`Metoda_ID`) REFERENCES `metoda` (`Metoda_ID`),
  ADD CONSTRAINT `livrare_ibfk_3` FOREIGN KEY (`Expeditor_ID`) REFERENCES `date` (`Date_Persoana_ID`),
  ADD CONSTRAINT `livrare_ibfk_4` FOREIGN KEY (`Destinatar_ID`) REFERENCES `date` (`Date_Persoana_ID`);

--
-- Constraints for table `livrare_curier`
--
ALTER TABLE `livrare_curier`
  ADD CONSTRAINT `livrare_curier_ibfk_1` FOREIGN KEY (`Curieri_ID`) REFERENCES `curieri` (`Curieri_ID`),
  ADD CONSTRAINT `livrare_curier_ibfk_2` FOREIGN KEY (`AWB_ID`) REFERENCES `livrare` (`AWB_ID`);

--
-- Constraints for table `pachet`
--
ALTER TABLE `pachet`
  ADD CONSTRAINT `pachet_ibfk_1` FOREIGN KEY (`Persoana_Plecare_ID`) REFERENCES `date` (`Date_Persoana_ID`),
  ADD CONSTRAINT `pachet_ibfk_2` FOREIGN KEY (`Persoana_Sosire_ID`) REFERENCES `date` (`Date_Persoana_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
