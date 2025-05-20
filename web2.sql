-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2025 at 07:17 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryCode` int NOT NULL COMMENT 'Category Code',
  `categoryDesc` char(50) DEFAULT NULL COMMENT 'Category Description'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryCode`, `categoryDesc`) VALUES
(12, 'Sports & Outdoor Equipment'),
(11, 'Health & Beauty'),
(10, 'Toys & Games'),
(9, 'Books & Media'),
(8, 'Automotive Parts'),
(7, 'Clothing & Apparel'),
(13, 'Pet Supplies'),
(14, 'Office Equipment'),
(15, 'Industrial Tools'),
(16, 'Baby Products');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int NOT NULL,
  `customerName` char(35) DEFAULT NULL,
  `CustomerType` char(1) DEFAULT NULL,
  `customerPhone` char(10) DEFAULT NULL,
  `customerAddress` char(50) DEFAULT NULL,
  `customerGSM` int DEFAULT NULL,
  `customerEmail` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `customerName`, `CustomerType`, `customerPhone`, `customerAddress`, `customerGSM`, `customerEmail`) VALUES
(12006, 'Salim Al-Balushi', 'I', '79456789', 'Flat 301, Ruwi High St', 945678901, 'sbalushi@personal.om'),
(12005, 'Aisha Al-Rashidi', 'I', '79345678', 'Building 9, Ghubra', 934567890, 'a.rashidi@example.om'),
(12004, 'Khalid Al-Harthy', 'I', '79234567', 'Villa 45, Shatti Qurm', 923456789, 'k.alharthy@omantel.om'),
(12003, 'Fatma Al-Saidi', 'I', '79123456', 'House 123, Al Khuwair', 912345678, 'f.alsaidi@mail.om'),
(11010, 'IT Support Division', 'D', '2451005', 'Data Center Complex', 0, 'itsupport@org.om'),
(11009, 'Marketing Department', 'D', '2451004', 'East Tower Level 5', 0, 'marketing@org.om'),
(11008, 'Quality Assurance Dept.', 'D', '2451003', 'South Wing Room 412', 0, 'qa@org.om'),
(11007, 'Research & Development', 'D', '2451002', 'Innovation Center Block B', 0, 'research@org.om'),
(11006, 'Human Resources Dept.', 'D', '2451001', 'Main Building Floor 3', 0, 'hr@organization.com'),
(12007, 'Mariam Al-Nabhani', 'I', '79567890', 'House 678, Al Azaiba', 956789012, 'm.nabhani@domain.om'),
(12008, 'Yousuf Al-Mamari', 'I', '79678901', 'Villa 22, Madinat Qaboos', 967890123, 'y.mamari@contact.om'),
(12009, 'Laila Al-Hinai', 'I', '79789012', 'Building 5, Al Ghubra', 978901234, 'l.hinai@example.om'),
(12010, 'Hamad Al-Badi', 'I', '79890123', 'Flat 102, Al Khuwair', 989012345, 'h.badi@mail.om'),
(12011, 'Amal Al-Siyabi', 'I', '79901234', 'House 334, Bausher', 990123456, 'a.siyabi@personal.om'),
(12012, 'Said Al-Touqi', 'I', '79012345', 'Villa 11, Al Hail', 901234567, 's.touqi@contact.om'),
(12013, 'Cash Customer 2', 'I', '2450000', 'General Sales', 0, ''),
(11011, 'Legal Department', 'D', '2451006', 'North Wing Room 201', 0, 'legal@org.om'),
(12014, 'Hamed Al-Barwani', 'I', '79111222', 'Building 8, Al Harthy Complex', 911122233, 'h.barwani@example.om'),
(11012, 'Procurement Dept.', 'D', '2451007', 'Central Warehouse Office', 0, 'procurement@org.om');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `issueSeq` int NOT NULL COMMENT 'issue Seq no',
  `issueItemCode` char(8) NOT NULL COMMENT 'Item Code issued',
  `issueCustomerId` int NOT NULL COMMENT 'customer id',
  `issueDate` date DEFAULT NULL COMMENT 'Issue date',
  `issueQty` int DEFAULT NULL COMMENT 'quantity issued',
  `issueItemPrice` double DEFAULT NULL COMMENT 'Price of Item issued',
  `issueInvoiceNo` int DEFAULT NULL COMMENT 'Invoice no',
  `issueInvoiceDate` date DEFAULT NULL COMMENT 'Invoice date',
  `issuieItemCost` double DEFAULT NULL COMMENT 'cost of Item issued',
  `issueShpmntBy` int DEFAULT NULL COMMENT 'shipment id',
  `issueComment` varchar(50) DEFAULT NULL COMMENT 'Comment',
  `issueDateTime` date DEFAULT NULL COMMENT 'Date and Time of Data Entery'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issueSeq`, `issueItemCode`, `issueCustomerId`, `issueDate`, `issueQty`, `issueItemPrice`, `issueInvoiceNo`, `issueInvoiceDate`, `issuieItemCost`, `issueShpmntBy`, `issueComment`, `issueDateTime`) VALUES
(1, '04-00008', 11000, '2015-05-01', 1, NULL, 123, NULL, NULL, 3, NULL, '0000-00-00'),
(2, '04-00002', 11002, '2010-04-30', 5, NULL, 23, NULL, NULL, 1, NULL, '0000-00-00'),
(3, '03-00006', 1, '2025-05-12', 1, NULL, 1, NULL, NULL, NULL, '', '2025-05-12'),
(4, '03-00007', 1, '2025-05-12', 1, NULL, 123, NULL, NULL, NULL, 'test', '2025-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `iCode` char(8) NOT NULL COMMENT 'Item Code',
  `iCategoryCode` int NOT NULL COMMENT 'icut Category Code',
  `iDesc` char(50) DEFAULT NULL COMMENT 'Item Description',
  `iSpec` char(50) DEFAULT NULL COMMENT 'Item Specification',
  `iQtyOnHand` int NOT NULL DEFAULT '0' COMMENT 'Quantity On Hand',
  `iStorageLoc` char(50) DEFAULT NULL COMMENT 'Storage Location',
  `iCost` double DEFAULT NULL COMMENT 'Item Cost',
  `iPrice` double NOT NULL DEFAULT '0' COMMENT 'Item Price',
  `iLastSupplierId` int DEFAULT NULL COMMENT 'Last Supplier ID',
  `iStatus` char(1) DEFAULT NULL COMMENT 'Status of Item (A:Active,N:Not)',
  `iLastCustomerId` int DEFAULT NULL COMMENT 'Last Customer Id',
  `iQtyLastPurchased` int DEFAULT NULL COMMENT 'Last Quantity Purchases',
  `iQtyLastIssued` int DEFAULT NULL COMMENT 'Last Quantity Issued',
  `iDateLastIssued` date DEFAULT NULL COMMENT 'Last Date Item Issued',
  `iDateLastPurchased` date DEFAULT NULL COMMENT 'Last Date Item Purchased'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`iCode`, `iCategoryCode`, `iDesc`, `iSpec`, `iQtyOnHand`, `iStorageLoc`, `iCost`, `iPrice`, `iLastSupplierId`, `iStatus`, `iLastCustomerId`, `iQtyLastPurchased`, `iQtyLastIssued`, `iDateLastIssued`, `iDateLastPurchased`) VALUES
('01-00054', 1, 'Mouse Pad XXL', 'Waterproof, Non-Slip', 50, 'M01-04', 3.5, 7.99, 1011, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00004', 6, 'Laundry Basket 50L', 'Plastic, Foldable', 20, 'Store2-R', 8, 12.95, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00053', 5, 'Printer Paper A4', '80gsm, 500 Sheets', 40, 'Small store', 4, 6.5, 1006, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00053', 4, 'Filing Cabinet 2-Drawer', 'Lockable, Letter Size', 6, 'Workshop-M', 130, 179.95, 1004, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00053', 3, 'Honey 500g Jar', 'Pure Natural', 25, 'R01-01', 6.5, 9.99, 1017, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00053', 2, 'Electric Kettle 1.7L', 'Stainless Steel, Auto-Off', 10, 'Store2-R', 25, 34.95, 1013, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00053', 1, 'Webcam Logitech C920', '1080p, Built-in Mic', 18, 'M01-04', 55, 79.99, 1010, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00003', 6, 'Tool Kit 32pc', 'Socket Set + Screwdrivers', 8, 'Workshop-M', 45, 65, 1002, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00002', 6, 'Stepladder 3-Step', 'Aluminum, 150kg Capacity', 12, 'Workshop-R', 35, 49.99, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00001', 6, 'Vacuum Cleaner 2000W', 'Bagless, HEPA Filter', 5, 'Store2-L', 89, 129.95, 1012, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00052', 5, 'File Box Plastic', 'Letter Size, Stackable', 30, 'L02-01', 6, 9.99, 1005, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00051', 5, 'Whiteboard 120x90cm', 'Magnetic Surface', 8, 'Small store', 45, 64.95, 1007, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00050', 5, 'Stapler Heavy Duty', '50 Sheet Capacity', 45, 'L02-02', 8.5, 12.99, 1006, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00052', 4, 'Folding Table 180x80cm', 'Plastic Top, Metal Frame', 15, 'Workshop-R', 55, 79.95, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00051', 4, 'Office Chair Ergonomic', 'Adjustable Arms', 10, 'Workshop-L', 95, 129.99, 1003, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00050', 4, 'Bookshelf Oak 180cm', '5 Shelves, Wall Mount', 7, 'Workshop-M', 120, 159.99, 1002, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00052', 3, 'Pasta Spaghetti 500g', 'Durum Wheat', 60, 'R01-02', 1.2, 2.25, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00051', 3, 'Olive Oil 1L', 'Extra Virgin', 20, 'R01-01', 8, 12.5, 1017, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00050', 3, 'Sugar 5kg Bag', 'Pure Cane Sugar', 40, 'R01-02', 4.5, 6.99, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00052', 2, 'Iron Steamfast SF-717', '1500W, Auto Shutoff', 8, 'L01-03', 25, 34.99, 1013, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00051', 2, 'Blender Philips 500W', 'Glass Jar, 3 Speeds', 15, 'Store2-L', 35, 49.95, 1020, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00050', 2, 'Microwave Panasonic 20L', '800W, Stainless Steel', 6, 'Store2-R', 80, 109.99, 1012, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00052', 1, 'Monitor Samsung 27\"', '4K UHD, IPS Panel', 12, 'M01-03', 300, 399, 1011, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00051', 1, 'Keyboard Logitech MX Keys', 'Wireless, Backlit', 25, 'M01-04', 65, 89.99, 1010, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00050', 1, 'Laptop Dell XPS 13', '13\" FHD, Core i7, 16GB RAM', 8, 'R02-02', 850, 1100, 1008, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00027', 3, 'Item-17', 'Spec-1', 4, 'Workshop-R', 16.25, 101.98, 1011, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('04-00028', 5, 'Item-507', 'Spec-27', 85, 'Workshop-R', 44.32, 98.29, 1007, 'A', 1, 0, 0, '0000-00-00', '0000-00-00'),
('04-00029', 3, 'Item-464', 'Spec-22', 75, 'Workshop-R', 7.64, 18.5, 1008, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('04-00030', 4, 'Item-452', 'Spec-45', 92, 'Workshop-R', 26.72, 82.89, 1020, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('04-00031', 1, 'Item-790', 'Spec-90', 17, 'Workshop-R', 16.49, 43.13, 1007, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('04-00032', 2, 'Item-336', 'Spec-7', 35, 'Workshop-R', 56.87, 115.43, 1006, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('04-00033', 2, 'Item-230', 'Spec-29', 80, 'Workshop-R', 11.72, 26.71, 1018, 'A', 11005, 0, 0, '0000-00-00', '0000-00-00'),
('04-00034', 6, 'Item-982', 'Spec-23', 23, 'Workshop-R', 44.4, 79.37, 1018, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('05-00001', 2, 'Item-280', 'Spec-58', 9, 'L02-02', 72.32, 48.59, 1003, 'A', 11004, 0, 0, '0000-00-00', '0000-00-00'),
('05-00002', 3, 'Item-877', 'Spec-10', 90, 'L02-02', 19.54, 39.96, 1012, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('05-00003', 2, 'Item-491', 'Spec-88', 95, 'L02-02', 12.74, 114.74, 1009, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('05-00004', 5, 'Item-627', 'Spec-94', 85, 'L02-02', 44.56, 98.1, 1011, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('05-00005', 6, 'Item-7', 'Spec-8', 41, 'Small store', 82.45, 130.3, 1012, 'A', 11004, 0, 0, '0000-00-00', '0000-00-00'),
('05-00006', 2, 'Item-676', 'Spec-68', 40, 'Small store', 95.28, 83.56, 1003, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('05-00007', 1, 'Item-455', 'Spec-11', 19, 'Small store', 64.79, 97.23, 1008, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('05-00008', 4, 'Item-488', 'Spec-65', 82, 'Small store', 16.08, 48.26, 1014, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('05-00009', 4, 'Item-591', 'Spec-8', 65, 'Small store', 3.65, 30.54, 1018, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('05-00010', 1, 'Item-477', 'Spec-95', 34, 'L02-01', 84.08, 27.14, 1010, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('05-00011', 6, 'Item-981', 'Spec-9', 51, 'L02-01', 29.31, 138.64, 1006, 'A', 11005, 0, 0, '0000-00-00', '0000-00-00'),
('05-00012', 6, 'Item-118', 'Spec-68', 7, 'L02-01', 33.74, 67.17, 1005, 'A', 12002, 0, 0, '0000-00-00', '0000-00-00'),
('02-00054', 2, 'Air Purifier 30m²', 'HEPA + Carbon Filter', 4, 'Store2-L', 150, 199.99, 1020, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00002', 4, 'Item-406', 'Spec-45', 6, 'R02-01', 94.75, 82.19, 1020, 'A', 1, 0, 0, '0000-00-00', '0000-00-00'),
('01-00003', 1, 'Item-962', 'Spec-37', 98, 'R02-01', 81.49, 16.61, 1005, 'A', 11005, 0, 0, '0000-00-00', '0000-00-00'),
('01-00004', 4, 'Item-863', 'Spec-60', 43, 'R02-01', 37.29, 82.58, 1017, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('01-00005', 3, 'Item-901', 'Spec-21', 36, 'M01-04', 17.12, 115.45, 1011, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('01-00006', 2, 'Item-958', 'Spec-82', 23, 'M01-04', 72.78, 138.16, 1005, 'A', 12002, 0, 0, '0000-00-00', '0000-00-00'),
('01-00007', 6, 'Item-778', 'Spec-27', 3, 'M01-03', 34.32, 92.63, 1003, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('01-00008', 3, 'Item-534', 'Spec-30', 89, 'M01-03', 58.65, 36.04, 1016, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('01-00009', 4, 'Item-56', 'Spec-28', 24, 'M01-02', 38.92, 30.42, 1008, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('01-00010', 1, 'Item-999', 'Spec-52', 62, 'M01-01', 54.06, 125.32, 1016, 'A', 1, 0, 0, '0000-00-00', '0000-00-00'),
('02-00001', 5, 'Item-707', 'Spec-53', 54, 'R02-01', 10.93, 138.2, 1014, 'A', 1, 0, 0, '0000-00-00', '0000-00-00'),
('02-00002', 2, 'Item-886', 'Spec-44', 58, 'L01-03', 55.72, 6.74, 1009, 'A', 12002, 0, 0, '0000-00-00', '0000-00-00'),
('02-00003', 3, 'Item-787', 'Spec-74', 36, 'L01-02', 56.92, 114.71, 1016, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('02-00004', 3, 'Item-50', 'Spec-22', 99, 'L01-02', 29.9, 75.36, 1007, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('02-00005', 5, 'Item-184', 'Spec-44', 68, 'L01-02', 6.65, 43.2, 1009, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('02-00006', 6, 'Item-238', 'Spec-30', 82, 'Store2-R', 21.34, 87.46, 1008, 'A', 11004, 0, 0, '0000-00-00', '0000-00-00'),
('02-00007', 2, 'Item-577', 'Spec-27', 65, 'Store2-R', 46.12, 49.31, 1004, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('02-00008', 3, 'Item-396', 'Spec-76', 61, 'Store2-R', 77.72, 7.74, 1016, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('02-00009', 2, 'Item-694', 'Spec-53', 59, 'Store2-L', 35.01, 146.69, 1006, 'A', 12002, 0, 0, '0000-00-00', '0000-00-00'),
('02-00010', 2, 'Item-797', 'Spec-41', 66, 'Sotre2-L', 10.39, 77.25, 1013, 'A', 1, 0, 0, '0000-00-00', '0000-00-00'),
('02-00011', 4, 'Item-203', 'Spec-28', 81, 'L01-01', 20.33, 87.45, 1015, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('02-00012', 3, 'Item-112', 'Spec-55', 41, 'L01-01', 42.17, 129.66, 1011, 'A', 11003, 0, 0, '0000-00-00', '0000-00-00'),
('02-00013', 4, 'Item-541', 'Spec-18', 29, 'L01-01', 94.56, 124.24, 1002, 'A', 11001, 0, 0, '0000-00-00', '0000-00-00'),
('03-00001', 6, 'Item-604', 'Spec-38', 9, 'R01-02', 32.98, 54.63, 1011, 'A', 11002, 0, 0, '0000-00-00', '0000-00-00'),
('03-00002', 6, 'Item-858', 'Spec-75', 18, 'R01-02', 68.61, 129.49, 1008, 'A', 11000, 0, 0, '0000-00-00', '0000-00-00'),
('03-00003', 2, 'Item-33', 'Spec-24', 10, 'R01-02', 81.93, 115.51, 1005, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('03-00004', 6, 'Item-440', 'Spec-64', 88, 'R01-02', 49.94, 126.41, 1010, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('03-00005', 4, 'Item-18', 'Spec-42', 8, 'R01-01', 15.72, 78.04, 1015, 'A', 12001, 0, 0, '0000-00-00', '0000-00-00'),
('03-00006', 3, 'Item-745', 'Spec-57', 61, 'R01-01', 37.92, 6.05, 1017, 'A', 11001, 0, 0, '2025-05-12', '0000-00-00'),
('03-00007', 4, 'Item-166', 'Spec-97', 35, 'R01-01', 85.52, 32.43, 1016, 'A', 12001, 0, 0, '2025-05-12', '2025-05-12'),
('03-00054', 3, 'Canned Tuna 200g', 'In Olive Oil', 35, 'R01-02', 1.8, 3.25, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00054', 4, 'Bar Stool Adjustable', 'Metal Base, PU Seat', 8, 'Workshop-L', 45, 64.95, 1003, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00054', 5, 'Sticky Notes 100pk', '75x75mm, Assorted Colors', 100, 'L02-02', 2.5, 4.99, 1007, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00005', 6, 'Broom with Dustpan', 'Soft Bristles', 15, 'Store2-R', 6, 9.95, 1012, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00055', 1, 'USB Hub 4-Port', 'USB 3.0, Aluminum', 30, 'M01-04', 12, 19.99, 1010, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00055', 2, 'Desk Fan 12\"', '3 Speeds, Oscillating', 12, 'Store2-L', 28, 39.95, 1013, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00055', 3, 'Rice Basmati 5kg', 'Aged, Premium Quality', 25, 'R01-02', 12, 18.5, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00055', 4, 'Conference Table 3m', 'Wood Veneer, 10 Seater', 2, 'Workshop-R', 450, 599.99, 1001, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00055', 5, 'Permanent Markers 4pk', 'Fine Tip, Assorted', 60, 'L02-02', 3, 5.99, 1005, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00006', 6, 'Plastic Storage Box', '60L, Clear with Lid', 18, 'Workshop-M', 12, 17.95, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00056', 1, 'SSD 1TB Samsung 870', 'SATA III, 560MB/s', 15, 'M01-03', 85, 119.99, 1009, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00056', 2, 'Electric Grill Plate', 'Non-Stick, 1500W', 7, 'Store2-R', 45, 64.95, 1013, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00056', 3, 'Cooking Oil 5L', 'Vegetable, Cholesterol Free', 12, 'R01-01', 10, 15.99, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00056', 4, 'Reception Desk L-Shaped', 'Laminate Surface', 3, 'Workshop-L', 320, 429.99, 1002, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00056', 5, 'Paper Clips 100pk', 'Assorted Sizes', 200, 'L02-02', 1.2, 2.5, 1006, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00007', 6, 'Step Trash Can 30L', 'Stainless Steel', 10, 'Store2-R', 25, 34.95, 1012, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00057', 1, 'Router TP-Link AX3000', 'WiFi 6, Dual Band', 9, 'R02-01', 75, 99.99, 1011, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00057', 2, 'Immersion Blender', '300W, 5 Speed', 8, 'Store2-L', 32, 44.95, 1020, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00057', 3, 'Salt Iodized 1kg', 'Free Flow', 50, 'R01-02', 0.8, 1.99, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00057', 4, 'Folding Chair Plastic', 'Stackable, 100kg Capacity', 25, 'Workshop-R', 12, 16.95, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00057', 5, 'Envelopes C4 50pk', 'Brown Kraft, Self-Seal', 40, 'Small store', 8, 12.99, 1007, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00008', 6, 'Dustbin Bags 30L', '50pk, Heavy Duty', 30, 'Store2-R', 6.5, 9.95, 1012, 'A', NULL, NULL, NULL, NULL, NULL),
('01-00058', 1, 'External HDD 2TB', 'USB 3.0, Portable', 12, 'M01-03', 65, 89.99, 1009, 'A', NULL, NULL, NULL, NULL, NULL),
('02-00058', 2, 'Electric Water Kettle', '1.8L, Cordless', 10, 'Store2-R', 30, 42.5, 1013, 'A', NULL, NULL, NULL, NULL, NULL),
('03-00058', 3, 'Flour All-Purpose 10kg', 'Wheat, Unbleached', 8, 'R01-02', 7, 10.99, 1015, 'A', NULL, NULL, NULL, NULL, NULL),
('04-00058', 4, 'Locker Cabinet 12-Pack', 'Steel, Key Lock', 4, 'Workshop-M', 280, 379.99, 1004, 'A', NULL, NULL, NULL, NULL, NULL),
('05-00058', 5, 'Calculator Scientific', '240 Functions, Solar', 15, 'L02-02', 15, 24.95, 1005, 'A', NULL, NULL, NULL, NULL, NULL),
('06-00009', 6, 'Mop & Bucket Set', 'Spin Mop, 2 Refills', 8, 'Store2-R', 18, 26.95, 1018, 'A', NULL, NULL, NULL, NULL, NULL),
('66', 12, 'test', 'cat', 1, 'nizwa', 5, 6, 1021, 'A', NULL, NULL, NULL, NULL, NULL),
('1', 12, 'a', 'a', 1, 'n', 1, 2, 1038, 'A', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchSeq` int NOT NULL COMMENT 'Purchase Seq no.',
  `purchItemCode` char(8) NOT NULL COMMENT 'item Code purchased',
  `purchSuppID` int NOT NULL COMMENT 'Supplier Id',
  `purchQty` int DEFAULT NULL COMMENT 'Quantity purchased',
  `purchOrderNo` int DEFAULT NULL COMMENT 'Order No',
  `purchOrderDate` date DEFAULT NULL COMMENT 'Order Date ',
  `purchDate` date DEFAULT NULL COMMENT 'Purchase Date',
  `purchItemCost` double DEFAULT NULL COMMENT 'item Cost',
  `purchComment` varchar(50) DEFAULT NULL COMMENT 'comment',
  `purchDateTime` datetime DEFAULT NULL COMMENT 'entry date to system'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchSeq`, `purchItemCode`, `purchSuppID`, `purchQty`, `purchOrderNo`, `purchOrderDate`, `purchDate`, `purchItemCost`, `purchComment`, `purchDateTime`) VALUES
(1, '04-00010', 1005, 70, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(2, '04-00001', 1018, 99, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(3, 'Chair,', 1018, 99, NULL, '2015-07-01', NULL, NULL, NULL, NULL),
(4, '03-00007', 1001, 1, 1, NULL, '2025-05-12', NULL, '', '2025-05-12 00:00:00'),
(5, '03-00007', 1001, 2, 1, NULL, '2025-05-12', NULL, 'test', '2025-05-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` int NOT NULL DEFAULT '0',
  `supplierName` char(35) DEFAULT NULL,
  `supplierAddress` char(40) DEFAULT NULL,
  `supplierPhone` varchar(15) DEFAULT NULL,
  `supplierEmail` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `supplierName`, `supplierAddress`, `supplierPhone`, `supplierEmail`) VALUES
(1022, 'Nizwa Hardware Center', 'Nizwa, Birkat Al Mouz', '92548673', 'sales@nizwahardware.om'),
(1023, 'Muscat Office Solutions', 'Muscat, Ruwi High Street', '24459876', 'support@muscatoffices.com'),
(1024, 'Dhofar Food Supplies', 'Salalah, Al Hafa Street', '23217654', 'orders@dhofarfoods.om'),
(1025, 'Al Nahda Furniture', 'Sohar, Industrial Area', '26843567', 'nahdafurniture@oman.om'),
(1026, 'Global Tech Oman', 'Muscat, CBD Area', '24567890', 'tech@globaloman.com'),
(1027, 'Barka Kitchenware', 'Barka, Main Souq Road', '79321456', ''),
(1028, 'Sur Electricals', 'Sur, Al Ayjah', '25544332', 'surelect@omantel.net.om'),
(1029, 'Jalan Bani Bu Ali Crafts', 'Sharqiyah, JBB Ali', '91234567', 'crafts@jbbali.om'),
(1030, 'Al Batinah Stationery', 'Sohar, City Center', '26888881', 'stationery@batinah.om'),
(1031, 'Salalah Cold Stores', 'Salalah, Ittin Road', '23219876', 'coldstore@salalahfood.om'),
(1032, 'Rustaq Building Materials', 'Al Rustaq, Souq Area', '26871234', ''),
(1033, 'Ibri Tech Solutions', 'Ibri, New Industrial Zone', '25671234', 'tech@ibrisolutions.om'),
(1034, 'Al Dakhiliyah Farms', 'Nizwa, Birkat Al Mouz', '92551234', 'dairy@dakhiliyahfarms.om'),
(1035, 'Muscat Modern Interiors', 'Muscat, Al Ghubra', '24561234', 'design@moderninteriors.om'),
(1036, 'Sohar Port Supplies', 'Sohar, Port Area', '26800001', 'portsupplies@sohar.om'),
(1037, 'Al Wusta Electronics', 'Haima, Main Road', '23221111', 'electronics@wusta.om'),
(1038, 'Al Sharqiyah Paper Co.', 'Ibra, Industrial Zone', '25550000', 'paper@sharqiyah.om'),
(1039, 'Dhofar Coffee Traders', 'Salalah, Al Muntazah', '23223333', 'coffee@dhofartraders.om'),
(1040, 'Muscat Safety Equipment', 'Muscat, Mabela', '24564567', 'safety@muscatequip.om');

-- --------------------------------------------------------

--
-- Table structure for table `usrdt`
--

CREATE TABLE `usrdt` (
  `usrid` varchar(50) NOT NULL,
  `usrpswd` varchar(255) NOT NULL,
  `usrname` varchar(100) NOT NULL,
  `usremail` varchar(100) NOT NULL,
  `usrtype` enum('A','N') NOT NULL,
  `usrlastlogindate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usrdt`
--

INSERT INTO `usrdt` (`usrid`, `usrpswd`, `usrname`, `usremail`, `usrtype`, `usrlastlogindate`) VALUES
('92339122', 'M1234', 'Mohammed Alnaamani', 'qwe@utas.edu', 'A', '2025-05-18 20:44:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryCode`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`issueSeq`),
  ADD KEY `issueCustomerId` (`issueCustomerId`) USING BTREE,
  ADD KEY `issueItemCode` (`issueItemCode`) USING BTREE;

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iCode`),
  ADD KEY `iLastCustomerId` (`iLastCustomerId`),
  ADD KEY `iLastSupplierId` (`iLastSupplierId`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchSeq`),
  ADD KEY `PurchItemCode` (`purchItemCode`) USING BTREE,
  ADD KEY `purchSuppId` (`purchSuppID`) USING BTREE;

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `usrdt`
--
ALTER TABLE `usrdt`
  ADD PRIMARY KEY (`usrid`),
  ADD UNIQUE KEY `usremail` (`usremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryCode` int NOT NULL AUTO_INCREMENT COMMENT 'Category Code', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `issueSeq` int NOT NULL AUTO_INCREMENT COMMENT 'issue Seq no', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchSeq` int NOT NULL AUTO_INCREMENT COMMENT 'Purchase Seq no.', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
