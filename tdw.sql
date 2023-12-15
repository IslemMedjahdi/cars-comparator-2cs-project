-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 01:49 AM
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
-- Database: `tdw`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `name` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `CountryOfOrigin` varchar(50) NOT NULL,
  `YearFounded` int(11) NOT NULL,
  `WebsiteURL` varchar(256) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `LogoImageURL` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`name`, `id`, `CountryOfOrigin`, `YearFounded`, `WebsiteURL`, `Description`, `LogoImageURL`) VALUES
('BMW', 10, 'Germany', 1916, 'https://bmw.com', 'Bayerische Motoren Werke AG, abbreviated as BMW, is a German multinational manufacturer of luxury vehicles and motorcycles headquartered in Munich, Bavaria, Germany. The company was founded in 1916 as a manufacturer of aircraft engines, which it produced from 1917 to 1918 and again from 1933 to 1945.', '/uploads/brands/656dc927bfb8d_1701693735.png'),
('Chevrolet', 11, 'United States', 1911, 'https://www.chevrolet.com/', 'Chevrolet is an American automobile division of the manufacturer General Motors. Louis Chevrolet, Arthur Chevrolet and ousted General Motors founder William C. Durant started the company on November 3, 1911 as the Chevrolet Motor Car Company.', '/uploads/brands/656dc99538dca_1701693845.png'),
('Peugeot', 12, 'France', 1896, 'https://www.peugeot.com/', 'Peugeot is a French brand of automobiles owned by Stellantis. The family business that preceded the current Peugeot companies was founded in 1810, is regarded as the oldest car company in the world. On 20 November 1858, Émile Peugeot applied for the lion trademark.', '/uploads/brands/656dd32d69f1f_1701696301.png'),
('Toyota', 15, 'Japan', 1937, 'https://www.toyota.com/', 'Toyota Motor Corporation is a Japanese multinational automotive manufacturer headquartered in Toyota City, Aichi, Japan. It was founded by Kiichiro Toyoda and incorporated on August 28, 1937. Toyota is the largest automobile manufacturer in the world, producing about 10 million vehicles per year.', '/uploads/brands/6575eb4cd4a42_1702226764.png'),
('Dacia', 16, 'Romania', 1966, 'https://www.dacia.fr/', 'S.C. Automobile Dacia S.A., commonly known as Dacia, is a Romanian car manufacturer that takes its name from the historical region that constitutes present-day Romania. The company was established in 1966. In 1999, after 33 years, the Romanian government sold Dacia to the French car manufacturer Groupe Renault.', '/uploads/brands/6575ebae3b64c_1702226862.png'),
('Renault', 17, 'France', 1899, 'https://www.renault.dz', 'Groupe Renault is a French multinational automobile manufacturer established in 1899. The company produces a range of cars and vans and in the past, has manufactured trucks, tractors, tanks, buses/coaches, aircraft and aircraft engines, and autorail vehicles.', '/uploads/brands/6575ebf6ce113_1702226934.png'),
('Mercedes', 18, 'Germany', 1926, 'https://www.mercedes-benz.com', 'Mercedes-Benz, commonly referred to as Mercedes and sometimes as Benz, is a German luxury and commercial vehicle automotive brand established in 1926. Mercedes-Benz AG is headquartered in Stuttgart, Baden-Württemberg, Germany.', '/uploads/brands/6575ec5a947a8_1702227034.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `sexe` enum('male','female') NOT NULL,
  `birthDate` date NOT NULL,
  `password` varchar(256) NOT NULL,
  `createdAt` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `status` enum('accepted','rejected','pending','blocked') NOT NULL DEFAULT 'pending',
  `statusDate` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `email`, `role`, `sexe`, `birthDate`, `password`, `createdAt`, `status`, `statusDate`) VALUES
(9, 'admin', 'Admin', 'Admin', 'admin@carcompass.com', 'admin', 'male', '2002-05-06', '$2y$10$P0SnjKC6x60nPV5qk.alsemCrFoHgSSGED4Sis9s2fKc3L9T5YPkm', '2023-12-10 22:35:15.513885', 'accepted', '2023-12-10 22:35:15.513885');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model` varchar(50) NOT NULL,
  `version` varchar(50) NOT NULL,
  `year` int(5) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  `engine` varchar(256) NOT NULL,
  `speed` int(11) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `fuel_type` varchar(50) NOT NULL,
  `pricing_range_from` int(11) NOT NULL,
  `pricing_range_to` int(11) NOT NULL,
  `acceleration` int(11) NOT NULL,
  `ImageURL` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `brand_id`, `model`, `version`, `year`, `height`, `width`, `length`, `consumption`, `engine`, `speed`, `description`, `fuel_type`, `pricing_range_from`, `pricing_range_to`, `acceleration`, `ImageURL`) VALUES
(71, 10, 'BMW 3 Series', '330i Sedan', 2023, 142, 183, 468, 8, '2.0L Turbocharged Inline-4', 250, 'Sporty sedan with cutting-edge technology', 'gasoline', 35000, 45000, 6, '/uploads/vehicles/657b9d3bbddeb_1702599995.jpg'),
(72, 10, 'BMW X5', 'xDrive40i', 2023, 175, 200, 500, 11, '3.0L TwinPower Turbo Inline-6', 225, 'Luxury SUV with top-notch safety features', 'gasoline', 50000, 65000, 5, '/uploads/vehicles/657b9eac36071_1702600364.jpg'),
(73, 11, 'Chevrolet Bolt', 'LT Electric', 2022, 161, 177, 418, 10, 'Electric Motor', 150, 'All-electric hatchback with long range', 'electric', 40000, 50000, 7, '/uploads/vehicles/657b9fc79ced5_1702600647.jpg'),
(74, 12, 'Peugeot 308', 'GT Line Hatch', 2023, 147, 180, 427, 6, '1.6L Turbocharged Inline-4', 220, 'Stylish hatchback with advanced safety features', 'gasoline', 28000, 38000, 8, '/uploads/vehicles/657ba08fb2fb9_1702600847.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
