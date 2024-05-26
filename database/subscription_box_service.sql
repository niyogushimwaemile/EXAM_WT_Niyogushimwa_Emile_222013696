-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 10:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subscription box service`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prodID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `clientId`, `descriptions`, `date`, `prodID`) VALUES
(1, 1, 'Yaguze inkweto', '2024-05-19 18:33:41', 1),
(2, 1, 'Kugura', '2024-05-22 23:21:24', 1),
(3, 2, 'Kurangura', '2024-05-22 23:26:31', 1),
(4, 2, 'Kurangura', '2024-05-22 23:27:07', 1),
(5, 1, 'Kurangura', '2024-05-22 23:28:02', 0),
(6, 1, 'Kurangura', '2024-05-22 23:28:56', 0),
(7, 1, 'Kurangura', '2024-05-22 23:30:12', 0),
(8, 1, 'subscribed on ', '2024-05-22 23:31:36', 2),
(9, 1, 'subscribed on ', '2024-05-22 23:33:32', 2),
(10, 1, 'subscribed on ', '2024-05-22 23:35:04', 2),
(11, 1, 'subscribed on ', '2024-05-22 23:37:02', 2),
(12, 1, 'subscribed on ', '2024-05-22 23:37:48', 0),
(13, 1, 'subscribed on ', '2024-05-22 23:39:40', 0),
(14, 1, 'subscribed on ', '2024-05-22 23:40:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `BillingAddressID` int(11) NOT NULL,
  `CustomerID` varchar(11) NOT NULL,
  `Address` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT 'Not Defined',
  `email` varchar(55) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `registerDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `email`, `Address`, `Phone`, `registerDate`) VALUES
(1, 'HABUMUGISHA Ben', 'emile@gmail.com', 'HUYE', '0788993773', '2024-04-30 22:00:00'),
(2, 'Not Defined', 'niyogushimwaemile@gmail.com', NULL, NULL, NULL),
(3, 'Not Defined', 'emile2@gmail.com', NULL, NULL, NULL),
(4, 'Not Defined', 'mup@hmail.fr', NULL, NULL, NULL),
(5, 'Not Defined', 'emile@gmail.com3', NULL, NULL, NULL),
(6, 'Not Defined', 'emile@gmail.comb', NULL, NULL, '2024-05-22 23:56:55'),
(7, 'Not Defined', 'emile@gmail.comm', NULL, NULL, '2024-05-23 07:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `PaymentDate` int(11) NOT NULL,
  `PaymentMethod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `description` varchar(110) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `prod_name`, `description`, `price`, `photo`, `vendor_id`) VALUES
(1, 'Amapantaro', 'Twabazaniye ama pantaron qualite  ya 1 kuva mubutariyani.', 20000, 'assets/img/userspent.jpg', 1),
(8, 'ibijumba', 'my product', 12, 'assets/img/userspotato.jpg', 1),
(9, 't-shirts', 'new vesion', 700, 'assets/img/userst-shirt.jpg', 1),
(11, 'shorts', 'q', 7000000, 'assets/img/usersshirts.jpg', 1),
(12, 'jins', 'high quality', 500, 'assets/img/usersjins.jpg', 1),
(13, 'clothes', 'new version', 3000, 'assets/img/usersaaa.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shpping_address table`
--

CREATE TABLE `shpping_address table` (
  `shippingAddressID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Address` int(11) NOT NULL,
  `City` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `Zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscriptionID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`subscriptionID`, `customerID`, `productID`, `StartDate`, `EndDate`, `Status`) VALUES
(1, 1, 1, '2024-05-01', '2024-05-31', 'Approved'),
(2, 1, 1, '2024-05-19', '2024-05-19', 'Approved'),
(3, 1, 2, '2024-05-20', '2024-05-31', 'Approved'),
(4, 1, 2, '0000-00-00', '0000-00-00', 'Approved'),
(5, 1, 2, '0000-00-00', '0000-00-00', 'Approved'),
(6, 2, 2, '0000-00-00', '0000-00-00', 'Approved'),
(7, 3, 2, '0000-00-00', '0000-00-00', 'Approved'),
(8, 3, 12, '0000-00-00', '0000-00-00', 'Approved'),
(9, 3, 2, '2024-05-22', '2024-05-29', 'Approved'),
(10, 4, 2, '2024-05-23', '2024-06-06', 'Approved'),
(11, 1, 1, '2024-05-23', '2024-05-31', 'Approved'),
(12, 1, 1, '2024-05-23', '2024-05-25', 'Approved'),
(13, 1, 1, '2024-05-23', '2024-06-08', 'Approved'),
(14, 1, 1, '2024-05-23', '2024-05-31', 'Approved'),
(15, 1, 9, '2024-05-23', '2024-06-07', 'Approved'),
(16, 1, 1, '2024-05-23', '2024-05-31', 'Approved'),
(17, 5, 8, '2024-05-23', '2024-05-30', 'Approved'),
(18, 1, 1, '2024-05-23', '2024-05-31', 'Approved'),
(19, 1, 12, '2024-05-23', '2024-06-07', 'Approved'),
(20, 1, 1, '2024-05-23', '2024-06-07', 'Approved'),
(21, 1, 8, '2024-05-23', '2024-05-31', 'Approved'),
(22, 1, 8, '2024-05-23', '2024-05-29', 'Approved'),
(23, 1, 8, '2024-05-23', '2024-06-01', 'Approved'),
(24, 1, 1, '2024-05-23', '2024-05-22', 'Approved'),
(25, 1, 1, '2024-05-23', '2024-06-06', 'Approved'),
(26, 1, 2, '2024-05-23', '2024-06-08', 'Approved'),
(27, 1, 1, '2024-05-23', '2024-05-29', 'Approved'),
(28, 1, 1, '2024-05-23', '2024-06-06', 'Approved'),
(29, 6, 1, '2024-05-23', '2024-06-08', 'Approved'),
(30, 7, 9, '2024-05-23', '2024-06-06', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_products`
--

CREATE TABLE `subscription_products` (
  `subscriptionID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendorID` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `company` varchar(55) NOT NULL,
  `address` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UserType` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendorID`, `firstname`, `lastname`, `phone`, `company`, `address`, `email`, `password`, `RegistrationDate`, `UserType`, `profile`) VALUES
(1, 'NIYOGUSHIMWA', 'Emile', '078887736', 'EmileTech Ltd', 'KIBAGABAGA', 'emile@gmail.com', '123', '2024-05-26 19:50:17', 'vendor', 'assets/img/emile.jpg'),
(2, 'MUGISHA', 'Aime', '0782203457', 'KIKUU', 'KIZIGURO', 'aime@gmail.com', '123', '2024-05-23 06:41:30', 'vendor', 'assets/img/usersbeckam.png'),
(3, 'KARIZA', 'Merisa', '0782203457', 'KIKUU', 'NGOMA', 'niyogushimwaemile@gmail.com', '5555', '2024-05-23 09:29:23', 'vendor', 'assets/img/usersWIN_20240406_16_40_00_Pro.jpg'),
(4, 'BIZIMANA', 'Claude', '112', 'Meitech LTD', 'Kimisagara', 'claude@gmail.com', '123', '2024-05-26 20:28:41', 'vendor', 'assets/img/usersdownload (2).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`BillingAddressID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemsID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `shpping_address table`
--
ALTER TABLE `shpping_address table`
  ADD PRIMARY KEY (`shippingAddressID`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscriptionID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VendorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VendorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
