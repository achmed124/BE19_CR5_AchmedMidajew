-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 01:17 PM
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
-- Database: `be19_cr5_animal_adoption_achmedmidajew`
--
CREATE DATABASE IF NOT EXISTS `be19_cr5_animal_adoption_achmedmidajew` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be19_cr5_animal_adoption_achmedmidajew`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_breed` varchar(50) NOT NULL,
  `pet_age` int(11) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `pet_location` varchar(100) NOT NULL,
  `pet_description` varchar(200) NOT NULL,
  `pet_vaccinated` enum('yes','no') NOT NULL,
  `pet_size` enum('large','small','medium') NOT NULL,
  `pet_status` enum('available','adopted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `pet_name`, `pet_breed`, `pet_age`, `picture`, `pet_location`, `pet_description`, `pet_vaccinated`, `pet_size`, `pet_status`) VALUES
(1, 'Max', 'Labrador Retriever', 3, 'https://upload.wikimedia.org/wikipedia/commons/2/26/YellowLabradorLooking_new.jpg', 'New York', 'Friendly and playful dog', 'yes', 'large', 'adopted'),
(2, 'Luna', 'Siamese', 2, 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Siam_lilacpoint.jpg/640px-Siam_lilacpoint.jpg', 'Los Angeles', 'Affectionate and talkative cat', 'yes', 'medium', 'available'),
(3, 'Rockyy', 'German Shepherd', 6, 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/German_Shepherd_-_DSC_0346_%2810096362833%29.jpg/220px-German_Shepherd_-_DSC_0346_%2810096362833%29.jpg', 'Chicago', 'Energetic and loyal dog', 'no', 'large', 'available'),
(4, 'Simba', 'Maine Coon', 12, 'https://www.futterhaus.de/fileadmin/user_upload/Ratgeber/ImportedImages/2fd66e77-334a-4d68-b9cb-74bdec103e1f/22707df4-a7fd-4e6d-b739-83e524d86774-0.91678700_1628615292.jpeg', 'San Francisco', 'Regal and gentle giant cat', 'yes', 'large', 'adopted'),
(5, 'Bella', 'Golden Retriever', 10, 'https://upload.wikimedia.org/wikipedia/commons/9/93/Golden_Retriever_Carlos_%2810581910556%29.jpg', 'Miami', 'Friendly and outgoing dog', 'yes', 'large', 'adopted'),
(6, 'Milo', 'Ragdoll', 7, 'https://www.tieranzeigen.at/magazin/katzen/katzenrassen/ragdoll/ragdoll.jpg', 'Seattle', 'Gentle and affectionate cat', 'no', 'small', 'adopted'),
(7, 'Charlie', 'French Bulldog', 9, 'https://www.akc.org/wp-content/uploads/2017/11/French-Bulldog-standing-outdoors.jpg', 'Boston', 'Playful and adorable dog', 'yes', 'small', 'adopted'),
(8, 'Lucky', 'Tabby', 11, 'https://upload.wikimedia.org/wikipedia/commons/4/47/Gato_en_Boiro_Galicia.jpg', 'Dallas', 'Curious and friendly cat', 'yes', 'small', 'adopted'),
(9, 'Daisy', 'Bulldog', 2, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Bulldog_inglese.jpg/1200px-Bulldog_inglese.jpg', 'Atlanta', 'Calm and affectionate dog', 'yes', 'large', 'adopted'),
(10, 'Whiskers', 'Persian', 14, 'https://www.thesprucepets.com/thmb/5OSN_p9hUfPssKsJORQDGnAz_tQ=/1963x0/filters:no_upscale():strip_icc()/GettyImages-181861505-4e63227ed0a14dc9bfe86848ef54caf3.jpg', 'Houston', 'Independent and elegant cat', 'yes', 'small', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `adoption_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`id`, `user_id`, `pet_id`, `adoption_date`) VALUES
(1, 3, 9, '2023-08-02'),
(2, 3, 1, '2023-08-02'),
(3, 3, 7, '2002-08-23'),
(4, 7, 6, '2023-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `phone_number`, `address`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(2, 'Achmed', 'Midajew', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 0, '', '1999-09-29', 'achmed@gmail.com', 'avatar.png', 'adm'),
(3, 'Test', 'Test', '123123', 0, '', '2023-08-01', 'test@test.com', 'avatar.png', 'user'),
(7, ' achmed    ', ' midajew a  ', '', 0, '', '2023-08-10', 'test1@gmail.com', 'avatar.png', 'user'),
(8, 'Hallo', 'Hallo', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 0, '', '2023-08-09', 'Hallo@gmail.com', 'avatar.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
