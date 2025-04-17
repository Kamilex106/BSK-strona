-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Lis 04, 2024 at 06:25 PM
-- Wersja serwera: 10.11.9-MariaDB
-- Wersja PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catName`) VALUES
(1, 'Moto'),
(2, 'Electronics'),
(3, 'Toys'),
(4, 'Food');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `prodName` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `prodName`, `category`) VALUES
(1, 199.99, 'Motorcycle Helmet', 1),
(2, 15000.00, 'Electric Scooter', 1),
(3, 599.99, 'Smartphone', 2),
(4, 299.99, 'Wireless Headphones', 2),
(5, 19.99, 'Building Blocks', 3),
(6, 29.99, 'Action Figure', 3),
(7, 5.49, 'Organic Apple', 4),
(8, 2.99, 'Energy Bar', 4),
(9, 75.00, 'Motorcycle Gloves', 1),
(10, 1800.00, 'Car Audio System', 1),
(11, 999.99, 'Laptop', 2),
(12, 45.00, 'Wireless Mouse', 2),
(13, 299.99, 'Remote Control Car', 3),
(14, 9.99, 'Puzzle Set', 3),
(15, 1.49, 'Bottled Water', 4),
(16, 7.99, 'Bag of Chips', 4),
(17, 3.99, 'Organic Milk', 4),
(18, 12.99, 'Chocolate Bar', 4);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
