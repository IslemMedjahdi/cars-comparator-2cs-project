-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 12:06 AM
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
-- Table structure for table `brand_review`
--

CREATE TABLE `brand_review` (
  `userId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` varchar(256) DEFAULT NULL,
  `status` enum('pending','accepted','blocked') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_review`
--

INSERT INTO `brand_review` (`userId`, `brandId`, `rate`, `review`, `status`, `createdAt`) VALUES
(9, 10, 2, 'This Brand is good', 'accepted', '2024-01-02 12:02:53'),
(9, 11, 5, 'Chevrolet is good', 'accepted', '2024-01-10 23:53:06'),
(13, 10, 5, 'BMW is the best brand', 'accepted', '2024-01-02 12:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `comparison_history`
--

CREATE TABLE `comparison_history` (
  `userId` int(11) NOT NULL,
  `vehicle1Id` int(11) NOT NULL,
  `vehicle2Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comparison_history`
--

INSERT INTO `comparison_history` (`userId`, `vehicle1Id`, `vehicle2Id`) VALUES
(9, 71, 72),
(9, 71, 73),
(9, 71, 74),
(9, 72, 73),
(9, 73, 74),
(12, 71, 72),
(12, 71, 73),
(12, 72, 73),
(12, 73, 74),
(13, 71, 72),
(14, 71, 72);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `email`, `phone_number`, `address`, `title`, `description`) VALUES
(1, 'cars-comparer@gmail.com', '123-456-789', '123 Main S', 'Carcompass', 'Discover your ideal ride with CarCompass – your ultimate destination for insightful car comparisons. Navigate through an extensive database, explore detailed specs, and make informed decisions on the perfect vehicle for your journey. Your trusted companion in the world of cars');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `ImageURL` varchar(256) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `ImageURL`, `createdAt`) VALUES
(2, '2024 Lexus RZ300e with Front-Wheel Drive Costs Less, Goes Farther', 'The Lexus RZ is currently the luxury brand\'s only EV model, and it hasn\'t exactly lit the world on fire. Although the all-wheel-drive RZ450e we tested had the characteristics of a satisfying Lexus, it was mostly disappointing as an electric SUV. Among our chief complaints was its limited driving range. The good news for the 2024 model year is there\'s a new front-wheel-drive configuration that not only offers considerably more range, but it also costs less too.\r\n\r\nRZ300e Has More Range\r\nThe 2024 Lexus RZ300e arrives as the front-drive alternative to the all-wheel-drive RZ450e. The FWD RZ removes the 107-hp electric motor mounted on the AWD model\'s rear axle and replaces it with a unique subframe that Lexus says is designed to reduce vibration and noise.', '/uploads/news/658304bfe98b8_1703085247.jpg', '2023-12-20 16:14:07'),
(3, 'Revolutionizing the Roads: Futuristic Solar-Powered Vehicles Take Center Stage', 'In a groundbreaking leap towards sustainable transportation, a new era of solar-powered vehicles is emerging, promising to reshape the way we travel. These sleek, eco-friendly machines harness the power of the sun to fuel our journeys, offering a glimpse into a cleaner and greener future for transportation.\r\n\r\nWith solar panels seamlessly integrated into the vehicle\'s design, these cutting-edge cars are not only energy-efficient but also contribute to reducing our carbon footprint. The solar technology embedded in the vehicles is capable of capturing and converting sunlight into electricity, providing an eco-friendly alternative to traditional fuel sources.\r\n\r\nThe adoption of solar-powered vehicles marks a significant step towards achieving a more sustainable and environmentally conscious transportation system. As concerns about climate change and environmental impact continue to grow, this innovation represents a tangible solution for reducing reliance on fossil fuels and mitigating the effects of carbon emissions.\r\n\r\nThe sleek design and advanced technology of these solar-powered vehicles are turning heads in the automotive industry. Not only do they offer a sustainable mode of transportation, but they also boast cutting-edge features such as smart connectivity, autonomous driving capabilities, and enhanced safety measures.\r\n\r\nAs the automotive landscape evolves, manufacturers are investing heavily in research and development to bring these solar-powered marvels to the mass market. The potential for a widespread shift towards solar energy in transportation is not only exciting for environmentalists but also for individuals looking for cost-effective and innovative solutions for their daily commutes.\r\n\r\nThis solar revolution in the automotive industry signals a brighter and more sustainable future for our roads. With advancements in technology, the dream of solar-powered vehicles becoming a mainstream mode of transportation is becoming increasingly tangible. Stay tuned as these futuristic vehicles roll out onto the streets, paving the way for a cleaner and greener tomorrow.', '/uploads/news/659e9045756a8_1704890437.jpg', '2024-01-10 13:40:37'),
(4, 'Electric Adventure Unleashed: Off-Road Electric Vehicle Series Promises Thrilling Escapades', 'Get ready for an adrenaline-packed journey as off-road enthusiasts have a new reason to rejoice with the latest wave of electric adventure vehicles hitting the market. This new breed of robust, all-terrain electric vehicles is set to redefine the off-road experience, combining eco-consciousness with thrilling escapades.\r\n\r\nThe featured off-road electric vehicles are designed to tackle the most challenging terrains, from rocky mountainsides to sandy dunes, all while producing zero emissions. These rugged machines not only promise an exhilarating off-road adventure but also contribute to the preservation of our natural landscapes with their eco-friendly electric powertrains.\r\n\r\nEquipped with powerful electric motors, these off-road vehicles deliver instant torque for impressive acceleration, making them ideal for conquering steep inclines and navigating through tough off-road conditions. The absence of traditional combustion engines ensures a quieter ride, allowing adventurers to connect with nature without disturbing the environment.\r\n\r\nManufacturers are embracing innovation in battery technology to extend the range and durability of these off-road electric vehicles, ensuring that enthusiasts can explore remote and challenging terrains with confidence. The vehicles also feature advanced suspension systems and smart off-road navigation technology, enhancing both safety and performance.\r\n\r\nAs the demand for sustainable and thrilling off-road experiences grows, the off-road electric vehicle market is poised for significant expansion. From weekend warriors to outdoor enthusiasts, these electric adventure vehicles are capturing the attention of a diverse audience seeking both excitement and a commitment to environmental responsibility.\r\n\r\nPrepare to embark on a new era of off-road exploration, where the roar of engines is replaced by the hum of electric motors. The off-road electric vehicle revolution is not just a shift in gear; it\'s a paradigm change in the way we experience adventure. Buckle up for an electrifying journey into the heart of nature with these off-road electric marvels.', '/uploads/news/659e908426b6a_1704890500.jpg', '2024-01-10 13:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE `style` (
  `id` int(11) NOT NULL,
  `logoUrl` varchar(256) DEFAULT NULL,
  `primary_color` varchar(10) DEFAULT NULL,
  `facebook_url` varchar(128) DEFAULT NULL,
  `linkedin_url` varchar(128) DEFAULT NULL,
  `instagram_url` varchar(128) DEFAULT NULL,
  `faviconUrl` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `style`
--

INSERT INTO `style` (`id`, `logoUrl`, `primary_color`, `facebook_url`, `linkedin_url`, `instagram_url`, `faviconUrl`) VALUES
(1, '/uploads/style/658356de22046_1703106270.png', '#5c67ff', NULL, NULL, NULL, '/uploads/style/658356de274d6_1703106270.png');

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
(9, 'admin', 'Admin', 'Admin', 'admin@carcompass.com', 'admin', 'male', '2002-05-06', '$2y$10$P0SnjKC6x60nPV5qk.alsemCrFoHgSSGED4Sis9s2fKc3L9T5YPkm', '2023-12-10 22:35:15.513885', 'accepted', '2023-12-26 22:27:27.000000'),
(12, 'ki_medjahdi', 'Islem', 'Medjahdi', 'ki_medjahdi@esi.dz', 'user', 'male', '2002-05-06', '$2y$10$NXbw40XWZtmlapO1poutFemn75efR96MLT.DXQi2HR6FcmjRizft.', '2023-12-15 01:51:50.857843', 'accepted', '2024-01-08 17:26:20.000000'),
(13, 'islem_medjahdi', 'Islem', 'Medjahdi', 'ki_medjahdi@esi.dz', 'user', 'male', '2002-05-06', '$2y$10$Sn/x8oqtnWeNMR9NoYpHO.MSRteEMVUyLMkvXyBX6Xlsbb2AYYKyi', '2023-12-20 20:20:20.658805', 'accepted', '2023-12-20 20:20:48.000000'),
(14, 'badro_medjahdi', 'IslemBadro', 'Medjahdi', 'test@gmail.com', 'user', 'male', '2002-05-06', '$2y$10$qj2FHbu.Vx4WmwTz.61EHuv1hH5JfhMh1QNi0VXP/d0mgnZcsT0GO', '2024-01-10 13:43:01.142087', 'accepted', '2024-01-10 13:44:19.000000'),
(15, 'moncef_moussaoui', 'Moncef', 'Moussaoui', 'moncef@esi.dz', 'user', 'male', '1966-02-11', '$2y$10$xCoKhHRcH5AiTEFfEZOhs.FdqJYq6wkZs9c3Q9kx2Snu.WU9yYIym', '2024-01-10 13:43:27.582786', 'accepted', '2024-01-10 13:44:21.000000'),
(16, 'kk_habouche', 'Abderrahmene', 'Habouche', 'kk_habouche@esi.dz', 'user', 'male', '2002-05-02', '$2y$10$eDfmLCk9X6dZ/V/L8cu.M.lzC0./dBHX4defr7V89BY1e14lWQ402', '2024-01-10 13:43:52.394018', 'accepted', '2024-01-10 13:44:23.000000');

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
(74, 12, 'Peugeot 308', 'GT Line Hatch', 2023, 147, 180, 427, 6, '1.6L Turbocharged Inline-4', 220, 'Stylish hatchback with advanced safety features', 'gasoline', 28000, 38000, 8, '/uploads/vehicles/657ba08fb2fb9_1702600847.jpg'),
(75, 10, 'X5', 'M Sport', 2023, 175, 201, 494, 10, ' 3.0L V6 TwinPower Turbo', 250, 'The BMW X5 M Sport combines luxury with high-performance features, offering a thrilling driving experience with its powerful engine and dynamic design.', 'diesel', 60000, 75000, 6, '/uploads/vehicles/659e8d21a6de1_1704889633.jpg'),
(76, 15, 'Camry', 'Hybrid LE', 2022, 147, 184, 488, 5, ' 2.5L 4-Cylinder', 180, 'The Toyota Camry Hybrid LE offers a perfect blend of fuel efficiency and comfort, making it an ideal choice for environmentally-conscious drivers.', 'hybrid', 28000, 34000, 8, '/uploads/vehicles/659e8dbaa162d_1704889786.jpg'),
(77, 18, 'C-Class', 'AMG Line', 2024, 143, 181, 469, 5, '2.0L Inline-4 Turbo', 240, 'The Mercedes C-Class AMG Line showcases a perfect blend of elegance and performance, providing a luxurious driving experience with its cutting-edge features.', 'diesel', 45000, 55000, 6, '/uploads/vehicles/659e8e2eabe33_1704889902.jpg'),
(78, 11, 'Malibu', 'Premier', 2023, 146, 184, 494, 7, '1.5L Turbocharged Inline-4', 210, 'The Chevrolet Malibu Premier offers a stylish and comfortable ride, with advanced safety features and modern technology.', 'gasoline', 25000, 32000, 8, '/uploads/vehicles/659e8eb0414da_1704890032.jpg'),
(79, 12, '308', 'GT Line', 2022, 147, 180, 425, 4, '1.6L BlueHDi Diesel', 200, 'The Peugeot 308 GT Line combines sporty design with fuel efficiency, making it a practical and stylish choice for urban driving.', 'diesel', 30000, 36000, 9, '/uploads/vehicles/659e8f064377e_1704890118.jpg'),
(80, 16, 'Duster', 'Prestige', 2023, 167, 180, 434, 7, '1.3L TCe Turbocharged', 190, 'The Dacia Duster Prestige is a rugged and affordable SUV, designed for off-road adventures and everyday practicality.', 'gasoline', 20000, 26000, 10, '/uploads/vehicles/659e8f7313676_1704890227.jpg'),
(81, 17, 'Megane', 'R.S. Trophy', 2024, 142, 187, 463, 4, ' 1.6L TCe E-TECH ', 260, 'The Renault Megane R.S. Trophy brings together performance and eco-friendliness with its hybrid engine, delivering an exhilarating driving experience in a stylish and compact package.', 'hybrid', 38000, 46000, 7, '/uploads/vehicles/659e8feca8d71_1704890348.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_review`
--

CREATE TABLE `vehicle_review` (
  `userId` int(11) NOT NULL,
  `vehicleId` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` varchar(256) DEFAULT NULL,
  `status` enum('pending','accepted','blocked') NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_review`
--

INSERT INTO `vehicle_review` (`userId`, `vehicleId`, `rate`, `review`, `status`, `createdAt`) VALUES
(9, 71, 2, NULL, 'accepted', '2023-12-23 02:06:01'),
(9, 73, 1, 'This Car is horrible', 'accepted', '2023-12-25 14:18:14'),
(9, 74, 4, 'I like this car but it\'s so expensive for its features', 'accepted', '2023-12-26 22:20:40'),
(9, 79, 2, 'This car is good', 'accepted', '2024-01-10 23:52:31'),
(12, 71, 4, NULL, 'accepted', '2023-12-22 00:00:00'),
(12, 72, 3, NULL, 'accepted', '2023-12-22 01:16:35'),
(12, 73, 3, 'This car is bad', 'accepted', '2023-12-26 22:29:56'),
(13, 71, 5, 'This car is good', 'accepted', '2023-12-22 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_review`
--
ALTER TABLE `brand_review`
  ADD PRIMARY KEY (`userId`,`brandId`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `comparison_history`
--
ALTER TABLE `comparison_history`
  ADD PRIMARY KEY (`userId`,`vehicle1Id`,`vehicle2Id`),
  ADD KEY `vehicle1Id` (`vehicle1Id`),
  ADD KEY `vehicle2Id` (`vehicle2Id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `style`
--
ALTER TABLE `style`
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
-- Indexes for table `vehicle_review`
--
ALTER TABLE `vehicle_review`
  ADD PRIMARY KEY (`userId`,`vehicleId`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `style`
--
ALTER TABLE `style`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_review`
--
ALTER TABLE `brand_review`
  ADD CONSTRAINT `brand_review_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `brand_review_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `brand` (`id`);

--
-- Constraints for table `comparison_history`
--
ALTER TABLE `comparison_history`
  ADD CONSTRAINT `comparison_history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comparison_history_ibfk_2` FOREIGN KEY (`vehicle1Id`) REFERENCES `vehicle` (`id`),
  ADD CONSTRAINT `comparison_history_ibfk_3` FOREIGN KEY (`vehicle2Id`) REFERENCES `vehicle` (`id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `vehicle_review`
--
ALTER TABLE `vehicle_review`
  ADD CONSTRAINT `vehicle_review_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vehicle_review_ibfk_2` FOREIGN KEY (`vehicleId`) REFERENCES `vehicle` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
