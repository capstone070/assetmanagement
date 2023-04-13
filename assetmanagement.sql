-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 04:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assetmanagement`
--

CREATE database IF NOT EXISTS assetmanagement CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE assetmanagement;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serialNum` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `purchasedDate` date NOT NULL,
  `assetAge` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `assetassignment`
--

CREATE TABLE `assetassignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assetId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `assignDate` date NOT NULL,
  `remarks` varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `assetdisposal`
--

CREATE TABLE `assetdisposal` (
  `serialNum` int(20) NOT NULL,
  `disposeDate` date NOT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `assetimage`
--

CREATE TABLE `assetimage` (
  `serialNum` int(11) NOT NULL,
  `imageFile` geometry NOT NULL,
  `qrcode` varchar(50) NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchId` int(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phoneNum` varchar(15) NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentId` int(20) NOT NULL,
  `branchId` int(20) NOT NULL,
  `departmentName` int(30) NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DepartmentId` int(20) NULL,
  `BranchId` int(20) NULL,
  `MobileNumber` varchar(15) NULL,
  `HomeNumber` varchar(15) NULL,
  `EmailAdd` varchar(50) NULL,
  `Address` varchar(100) NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`FirstName`, `LastName`, `DepartmentId`, `BranchId`, `MobileNumber`, `HomeNumber`, `EmailAdd`, `Address`) VALUES
('Ana Amor', 'Bacani', 1, 1, '', '', 'AnaAmor@gmail.com', ''),
('Niel', '', 2, 1, '', '', 'Niel@gmail.com', ''),
('Luismaria', 'Villacorta', 1, 1, '', '', 'Luismaria@gmail.com', ''),
('Louie', '', 1, 1, '', '', 'Louie@gmail.com', ''),
('John', 'Doe', 1, 1, '', '', 'JohnDoe@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeId` int(11) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `UserLevel` varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`employeeId`, `UserName`, `Password`, `UserLevel`) VALUES
(1, 'Ana', '72019bbac0b3dac88beac9ddfef0ca808919104f', 'Asset Admin'),
(2, 'Niel', '0725549666f937c131c1af253e47237aadefec9a', 'Asset Manager'),
(3, 'Luis', 'faea5242a00c52da62a0f00df168c199b7ab748d', 'Admin'),
(4, 'Louie', '06555c65c3e6f7492f12f77da5b05044764d5da4', 'User'),
(5, 'johndoe', '8cb2237d0679ca88db6464eac60da96345513964', 'Admin');


CREATE TABLE `log` (
  `id` INT NOT NULL AUTO_INCREMENT , 
  `userId` INT NOT NULL , 
  `message` VARCHAR(255) NOT NULL , 
  `dateCreated` DATETIME NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
