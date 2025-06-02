-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 06:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab_5b`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `matric` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accessLevel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `matric`, `name`, `email`, `password`, `accessLevel`) VALUES
(1, '02000', 'Nur Ariffin Mohd ZIn', 'nnnnnnn@gmail.com', '$2y$10$EhcCOpVCpYK3gyJOqn1YXeasaKu9BWgEIn71NbkdfwtadOB94CgM.', 'lecturer'),
(2, 'A100', 'Ahmad', 'ahmad@gmail.com', '$2y$10$EJGCR9mq126hdiFpJWWtWu8Gt99rIS0nuq3egF2f3UND9ttCy7MP.', 'Student'),
(3, 'A101', 'Abu', 'Abu@gmail.com', '$2y$10$PjmeuoqNIlHDxQgu70.Zj.r0Cp65pfBUhHlpMJwPFvSCbuPYr3cba', 'Student'),
(4, 'A103', 'Ahmad bin Abu', 'ahmadabu@gmail.com', '$2y$10$1LD1ezR13Nbvo3aEgxvahep06WcVXOG2reip9DSLa4Wsie1zg1U3e', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
