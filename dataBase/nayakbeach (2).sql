-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2024 at 04:29 AM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nayakbeach`
--

-- --------------------------------------------------------

--
-- Table structure for table `activityfeed`
--

CREATE TABLE `activityfeed` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL DEFAULT '',
  `type` varchar(250) NOT NULL,
  `bid` int(11) NOT NULL DEFAULT 0,
  `bdid` int(11) DEFAULT NULL,
  `oldData` text DEFAULT NULL,
  `changedata` text DEFAULT NULL,
  `ipaddres` varchar(250) DEFAULT NULL,
  `result` varchar(150) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `addBy` varchar(50) DEFAULT '',
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activityfeed`
--

INSERT INTO `activityfeed` (`id`, `hotelId`, `type`, `bid`, `bdid`, `oldData`, `changedata`, `ipaddres`, `result`, `reason`, `addBy`, `addOn`) VALUES
(1, '12345', '1', 0, 0, '', '', '117.198.19.16', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-05 14:27:58'),
(2, '12345', '1', 0, 0, '', '', '117.198.19.16', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-05 14:54:25'),
(3, '12345', '1', 0, 0, '', '', '117.198.19.16', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-06 17:24:00'),
(4, '12345', '6', 0, 0, '', '', '2401:4900:3bc2:7aa:ddbf:227d:d54f:f083', '', 'Reservation nayak-a1325f has been created', 'a_1', '2024-06-06 17:47:52'),
(5, '12345', '1', 0, 0, '', '', '117.198.31.31', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-06 18:54:31'),
(6, '12345', '1', 0, 0, '', '', '117.198.24.107', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-07 19:53:05'),
(7, '12345', '1', 0, 0, '', '', '117.198.28.21', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-08 12:51:18'),
(8, '12345', '1', 0, 0, '', '', '117.198.16.83', 'success', '<b>bhabesh_nayak</b> username is login.', 'a_1', '2024-06-13 11:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `sysAId` int(11) NOT NULL DEFAULT 0,
  `orderBy` int(11) NOT NULL DEFAULT 0,
  `hotelId` varchar(11) NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `img` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addBy` varchar(11) DEFAULT NULL,
  `add_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `bookinId` varchar(250) NOT NULL,
  `reciptNo` int(11) DEFAULT 0,
  `openFolio` int(11) NOT NULL DEFAULT 1,
  `mainCheckIn` date DEFAULT NULL,
  `checkInTime` time DEFAULT NULL,
  `checkInDetail` varchar(5000) DEFAULT NULL,
  `mainCheckOut` date DEFAULT NULL,
  `checkOutTime` time DEFAULT NULL,
  `checkOutDetail` varchar(5000) DEFAULT NULL,
  `userPay` float DEFAULT 0,
  `nroom` int(11) NOT NULL DEFAULT 0,
  `couponCode` varchar(250) DEFAULT NULL,
  `pickUp` float DEFAULT NULL,
  `payment_status` varchar(250) DEFAULT NULL,
  `payment_id` varchar(250) NOT NULL DEFAULT '',
  `bookingSource` int(11) NOT NULL DEFAULT 0,
  `paymethodId` int(11) NOT NULL DEFAULT 0,
  `reservationType` int(11) NOT NULL DEFAULT 0,
  `salesType` int(11) NOT NULL DEFAULT 0,
  `bussinessSource` int(11) NOT NULL DEFAULT 0,
  `voucherNumber` varchar(250) NOT NULL DEFAULT '',
  `comPlanId` int(11) NOT NULL DEFAULT 0,
  `comValue` float NOT NULL DEFAULT 0,
  `coompanyId` int(11) NOT NULL DEFAULT 0,
  `paytypeId` int(11) NOT NULL DEFAULT 0,
  `commission` float NOT NULL DEFAULT 0,
  `extra_amount` float NOT NULL DEFAULT 0,
  `booking_attr` varchar(250) NOT NULL DEFAULT '',
  `billingMode` varchar(250) NOT NULL DEFAULT '',
  `organisation` varchar(250) NOT NULL DEFAULT '',
  `companynameid` varchar(250) NOT NULL DEFAULT '',
  `compayName` varchar(250) DEFAULT NULL,
  `gstno` varchar(250) NOT NULL DEFAULT '',
  `traveltype` varchar(250) NOT NULL DEFAULT '',
  `bookingref` varchar(250) NOT NULL DEFAULT '',
  `travelagent` varchar(250) NOT NULL DEFAULT '',
  `totalPrice` float DEFAULT NULL,
  `roundTotalPrice` int(11) DEFAULT NULL,
  `communication` varchar(250) DEFAULT NULL,
  `specialCare` int(11) NOT NULL DEFAULT 0,
  `specialRequest` text DEFAULT NULL,
  `billingInfo` text DEFAULT NULL,
  `addBy` text NOT NULL DEFAULT '',
  `actionOn` datetime DEFAULT NULL,
  `add_on` datetime DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `hotelId`, `bookinId`, `reciptNo`, `openFolio`, `mainCheckIn`, `checkInTime`, `checkInDetail`, `mainCheckOut`, `checkOutTime`, `checkOutDetail`, `userPay`, `nroom`, `couponCode`, `pickUp`, `payment_status`, `payment_id`, `bookingSource`, `paymethodId`, `reservationType`, `salesType`, `bussinessSource`, `voucherNumber`, `comPlanId`, `comValue`, `coompanyId`, `paytypeId`, `commission`, `extra_amount`, `booking_attr`, `billingMode`, `organisation`, `companynameid`, `compayName`, `gstno`, `traveltype`, `bookingref`, `travelagent`, `totalPrice`, `roundTotalPrice`, `communication`, `specialCare`, `specialRequest`, `billingInfo`, `addBy`, `actionOn`, `add_on`, `status`, `deleteRec`) VALUES
(1, '12345', 'nayak-a1325f', 1, 1, '2024-06-06', '02:21:00', '', '2024-06-07', '17:21:00', '', 0, 0, NULL, NULL, '1', '', 8, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, '', 'guest', '0', '', '', '', '', '', '', NULL, NULL, 'Phone Call,Whatsapp', 1, '', '', 'a_1', NULL, '2024-06-06 10:47:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookingby`
--

CREATE TABLE `bookingby` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `type` enum('travelAgent','organisation','other') NOT NULL DEFAULT 'other',
  `travelType` int(11) NOT NULL,
  `organizationId` int(11) NOT NULL DEFAULT 0,
  `staffName` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(12) DEFAULT NULL,
  `number` varchar(12) DEFAULT NULL,
  `pinCode` varchar(6) DEFAULT NULL,
  `block` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingby`
--

INSERT INTO `bookingby` (`id`, `bid`, `hotelId`, `type`, `travelType`, `organizationId`, `staffName`, `name`, `email`, `whatsapp`, `number`, `pinCode`, `block`, `address`, `district`, `state`) VALUES
(1, 1, '12345', 'other', 0, 0, 1, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetail`
--

CREATE TABLE `bookingdetail` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(25) DEFAULT NULL,
  `bid` int(11) NOT NULL,
  `openFolio` int(11) NOT NULL DEFAULT 0,
  `hkId` int(11) NOT NULL DEFAULT 0,
  `roomId` int(11) NOT NULL,
  `roomDId` int(11) NOT NULL,
  `smoking` enum('no','yes') NOT NULL DEFAULT 'no',
  `room_number` int(11) NOT NULL DEFAULT 0,
  `checkIn` date DEFAULT NULL,
  `checkOut` date DEFAULT NULL,
  `adult` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `exBd` int(11) NOT NULL DEFAULT 0,
  `noOfRooms` int(11) NOT NULL DEFAULT 1,
  `roomPrice` float NOT NULL DEFAULT 0,
  `adultPrice` float NOT NULL DEFAULT 0,
  `childPrice` float NOT NULL DEFAULT 0,
  `gstPer` int(11) DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `checkinstatus` int(11) DEFAULT 1,
  `checkinBy` datetime DEFAULT NULL,
  `checkOutBy` datetime DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingdetail`
--

INSERT INTO `bookingdetail` (`id`, `hotelId`, `bid`, `openFolio`, `hkId`, `roomId`, `roomDId`, `smoking`, `room_number`, `checkIn`, `checkOut`, `adult`, `child`, `exBd`, `noOfRooms`, `roomPrice`, `adultPrice`, `childPrice`, `gstPer`, `totalPrice`, `checkinstatus`, `checkinBy`, `checkOutBy`, `addOn`, `deleteRec`) VALUES
(1, '12345', 1, 0, 0, 3, 0, 'no', 0, '2024-06-06', '2024-06-07', 8, 0, 0, 4, 20000, 0, 0, 12, 22400, 1, NULL, NULL, '2024-06-06 17:47:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_folio`
--

CREATE TABLE `booking_folio` (
  `folioId` int(11) NOT NULL,
  `gName` varchar(250) DEFAULT '',
  `hotelId` varchar(250) DEFAULT '',
  `bid` int(11) NOT NULL DEFAULT 0,
  `bdId` int(11) NOT NULL DEFAULT 0,
  `posId` int(11) NOT NULL DEFAULT 0,
  `addService` varchar(250) NOT NULL DEFAULT '',
  `gst` int(11) NOT NULL DEFAULT 0,
  `gstPer` int(11) NOT NULL DEFAULT 0,
  `charged` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `received` float NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `complimentary_room` int(11) NOT NULL DEFAULT 0,
  `particulars` varchar(250) NOT NULL DEFAULT '',
  `ref` varchar(250) NOT NULL DEFAULT '',
  `remark` text NOT NULL DEFAULT '',
  `addBy` varchar(50) NOT NULL DEFAULT '',
  `ipaddress` varchar(50) NOT NULL DEFAULT '',
  `chargeDate` date DEFAULT NULL,
  `addOn` timestamp NULL DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cashiering`
--

CREATE TABLE `cashiering` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `bookingSource` varchar(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `contactPerson` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `type` varchar(20) NOT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `addBy` text NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `couponcode`
--

CREATE TABLE `couponcode` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL DEFAULT '',
  `offerType` int(11) NOT NULL DEFAULT 0,
  `coupon_code` varchar(250) NOT NULL,
  `coupon_type` enum('P','F') NOT NULL,
  `min_value` float NOT NULL,
  `coupon_value` float NOT NULL,
  `expire_on` date NOT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addBy` text NOT NULL DEFAULT '',
  `add_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emailcount`
--

CREATE TABLE `emailcount` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `ip` varchar(250) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bookingId` varchar(50) NOT NULL,
  `roomNum` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(150) NOT NULL,
  `amount` float NOT NULL,
  `paymentMode` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `addBy` int(11) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facing`
--

CREATE TABLE `facing` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `img` varchar(150) NOT NULL,
  `addOn` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folioparticulars`
--

CREATE TABLE `folioparticulars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `clr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `text` varchar(250) NOT NULL DEFAULT '',
  `imgId` varchar(250) NOT NULL,
  `addBy` text NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `type` enum('booking','pos') DEFAULT NULL,
  `accessId` int(11) NOT NULL DEFAULT 0,
  `bookId` int(11) DEFAULT NULL,
  `kotId` int(11) DEFAULT 0,
  `bookingdId` int(11) DEFAULT 0,
  `verify` varchar(250) NOT NULL DEFAULT '',
  `serial` varchar(11) NOT NULL DEFAULT '0',
  `nameTitle` enum('Mr.','Ms.','Mrs.') NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `whatsapp` varchar(12) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(150) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `comGst` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `block` varchar(250) DEFAULT NULL,
  `district` varchar(250) DEFAULT NULL,
  `zip` varchar(8) DEFAULT NULL,
  `full_address` varchar(250) DEFAULT '',
  `image` varchar(250) DEFAULT NULL,
  `kyc_file` varchar(250) DEFAULT NULL,
  `kyc_number` varchar(250) DEFAULT NULL,
  `kyc_type` varchar(2) DEFAULT '0',
  `file_upload_type` varchar(10) DEFAULT NULL,
  `proof_file_upload_type` varchar(11) DEFAULT NULL,
  `groupadmin` int(11) DEFAULT 0,
  `birthday` varchar(250) DEFAULT NULL,
  `anniversary` varchar(250) DEFAULT NULL,
  `addBy` text DEFAULT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `hotelId`, `type`, `accessId`, `bookId`, `kotId`, `bookingdId`, `verify`, `serial`, `nameTitle`, `name`, `email`, `whatsapp`, `phone`, `gender`, `company_name`, `comGst`, `country`, `state`, `city`, `block`, `district`, `zip`, `full_address`, `image`, `kyc_file`, `kyc_number`, `kyc_type`, `file_upload_type`, `proof_file_upload_type`, `groupadmin`, `birthday`, `anniversary`, `addBy`, `addOn`, `deleteRec`) VALUES
(1, '12345', NULL, 0, 1, 0, 1, '', '1', 'Mr.', 'test', 'test@gmail.com', '', '1234567890', NULL, NULL, NULL, NULL, 'Odisha', NULL, '', '', '', '', NULL, NULL, NULL, '0', NULL, NULL, 1, NULL, NULL, NULL, '2024-06-06 10:47:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guestamenddetail`
--

CREATE TABLE `guestamenddetail` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(150) DEFAULT NULL,
  `bid` int(11) NOT NULL,
  `bdid` int(11) NOT NULL,
  `checkInTime` timestamp NULL DEFAULT NULL,
  `checkOutTime` timestamp NULL DEFAULT NULL,
  `addbycheckin` varchar(250) DEFAULT NULL,
  `addbycheckout` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guestamenddetail`
--

INSERT INTO `guestamenddetail` (`id`, `hotelId`, `bid`, `bdid`, `checkInTime`, `checkOutTime`, `addbycheckin`, `addbycheckout`) VALUES
(1, '12345', 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guest_review`
--

CREATE TABLE `guest_review` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `adminId` int(11) DEFAULT NULL,
  `guestId` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `msg` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addBy` text DEFAULT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `hCode` varchar(8) NOT NULL,
  `shortCode` varchar(50) NOT NULL DEFAULT '',
  `hotel_id` varchar(12) NOT NULL DEFAULT '',
  `retrodId` varchar(12) NOT NULL DEFAULT '',
  `slug` varchar(250) NOT NULL,
  `hotelName` varchar(150) NOT NULL DEFAULT '',
  `hotelEmailId` varchar(250) NOT NULL DEFAULT '',
  `landlineNum` varchar(15) NOT NULL DEFAULT '',
  `hotelPhoneNum` varchar(250) NOT NULL DEFAULT '',
  `waNum` varchar(15) DEFAULT '',
  `website` varchar(250) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `commission` int(11) NOT NULL DEFAULT 0,
  `paymentGetway` varchar(50) NOT NULL DEFAULT '',
  `billingMode` enum('commission','subscribe') DEFAULT NULL,
  `beLink` varchar(250) NOT NULL DEFAULT '',
  `direction` text DEFAULT '',
  `addBy` varchar(80) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `hotelAddOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `pid`, `hCode`, `shortCode`, `hotel_id`, `retrodId`, `slug`, `hotelName`, `hotelEmailId`, `landlineNum`, `hotelPhoneNum`, `waNum`, `website`, `description`, `commission`, `paymentGetway`, `billingMode`, `beLink`, `direction`, `addBy`, `status`, `hotelAddOn`) VALUES
(1, 0, '12345', 'NH', '', 'RT0524-023', 'nayakhotel', 'Nayak Hotel', 'info@nayakhotels.com', '', '76828-222-09', '', 'nayakhotels.com', NULL, 0, '', NULL, '', '', NULL, 1, '2024-04-27 03:17:53'),
(2, 1, '12346', 'NBR', '', 'RT0524-024', 'nbresort', 'Nayak Beach Resort', 'info@nayakhotels.com', '', '', '', '', NULL, 0, '', NULL, '', '', NULL, 1, '2024-04-27 03:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `hotelpagelink`
--

CREATE TABLE `hotelpagelink` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `aboutPage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `contactPage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `hotelPolicy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `cancelPolicy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `refundPolicy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hotelpagelink`
--

INSERT INTO `hotelpagelink` (`id`, `hotelId`, `aboutPage`, `contactPage`, `hotelPolicy`, `cancelPolicy`, `refundPolicy`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hotelprofile`
--

CREATE TABLE `hotelprofile` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `lightlogo` varchar(250) NOT NULL DEFAULT '0',
  `darklogo` varchar(250) NOT NULL DEFAULT '0',
  `favicon` varchar(150) NOT NULL DEFAULT '0',
  `kotLogo` varchar(150) NOT NULL DEFAULT '0',
  `gst` varchar(250) NOT NULL DEFAULT '',
  `pan` varchar(250) NOT NULL DEFAULT '',
  `hsn` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL DEFAULT '',
  `checkIn` time NOT NULL DEFAULT '00:00:00',
  `checkOut` time NOT NULL DEFAULT '00:00:00',
  `chatBoturl` varchar(250) NOT NULL DEFAULT '',
  `addBy` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotelprofile`
--

INSERT INTO `hotelprofile` (`id`, `hotelId`, `lightlogo`, `darklogo`, `favicon`, `kotLogo`, `gst`, `pan`, `hsn`, `description`, `checkIn`, `checkOut`, `chatBoturl`, `addBy`) VALUES
(1, '12345', '24', '27', '25', '26', '', '', '', '', '00:00:00', '00:00:00', '', NULL),
(2, '12346', '20', '21', '22', '23', '', '', '', '', '00:00:00', '00:00:00', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotelservice`
--

CREATE TABLE `hotelservice` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `serviceId` int(11) NOT NULL DEFAULT 0,
  `commission` float NOT NULL DEFAULT 0,
  `voucher` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotelservice`
--

INSERT INTO `hotelservice` (`id`, `hotelId`, `serviceId`, `commission`, `voucher`, `status`) VALUES
(1, '12345', 3, 0, 'nayak', 1),
(2, '12346', 3, 0, 'nayak-beach', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotelsociallink`
--

CREATE TABLE `hotelsociallink` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `slId` int(11) NOT NULL,
  `link` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoteluser`
--

CREATE TABLE `hoteluser` (
  `id` int(11) NOT NULL,
  `hotelMainId` int(11) DEFAULT NULL,
  `hotelId` varchar(10) DEFAULT NULL,
  `displayName` varchar(250) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `imageId` int(11) DEFAULT 0,
  `userId` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `role` int(11) DEFAULT 0,
  `permission` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `block` int(11) NOT NULL DEFAULT 1,
  `addBy` varchar(11) DEFAULT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRecord` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoteluser`
--

INSERT INTO `hoteluser` (`id`, `hotelMainId`, `hotelId`, `displayName`, `name`, `email`, `phone`, `designation`, `bio`, `imageId`, `userId`, `password`, `role`, `permission`, `status`, `block`, `addBy`, `addOn`, `deleteRecord`) VALUES
(1, 1, '12345', 'Bhabesh', 'Bhabesh Nayak', 'bhabeshnayakgroup@gmail.com', NULL, NULL, NULL, 0, 'bhabesh_nayak', 'Bhabesh@2024', 1, NULL, 1, 1, NULL, '2024-04-27 08:48:27', 1),
(3, 1, '12345', 'avi', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 'Business dev', '', 0, 'avinab', '123456', 2, NULL, 1, 1, NULL, '2024-05-04 02:27:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_billing`
--

CREATE TABLE `hotel_billing` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `billingMode` enum('commission','subscribe') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_billing_timeline`
--

CREATE TABLE `hotel_billing_timeline` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(25) NOT NULL,
  `time` varchar(25) NOT NULL,
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `addOn` datetime NOT NULL,
  `addBy` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_booking_attr`
--

CREATE TABLE `hotel_booking_attr` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(150) NOT NULL,
  `bookingAttrId` int(11) NOT NULL,
  `value` float NOT NULL DEFAULT 0,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_floor_plan`
--

CREATE TABLE `hotel_floor_plan` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `shortCode` varchar(15) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `clr` varchar(25) DEFAULT NULL,
  `bg` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_image`
--

CREATE TABLE `hotel_image` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `accessId` int(11) NOT NULL DEFAULT 0,
  `accessValue` varchar(250) DEFAULT NULL,
  `source` varchar(250) DEFAULT 'login.retrod.in',
  `image` varchar(250) DEFAULT NULL,
  `altTag` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `private` enum('public','private') NOT NULL DEFAULT 'public',
  `addBy` varchar(15) DEFAULT NULL,
  `ipAddress` varchar(50) DEFAULT '',
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_image`
--

INSERT INTO `hotel_image` (`id`, `hotelId`, `accessId`, `accessValue`, `source`, `image`, `altTag`, `title`, `private`, `addBy`, `ipAddress`, `addOn`) VALUES
(1, '12347', 0, 'room', 'login.retrod.in', 'standard-room-356689.jpeg', NULL, NULL, 'public', 'a_1', '', '2024-04-30 20:18:25'),
(2, '12347', 1, 'room', 'login.retrod.in', 'standard-room-161373.jpeg', NULL, NULL, 'public', 'a_1', '', '2024-04-30 20:19:25'),
(3, '12347', 0, 'logo', 'login.retrod.in', 'undefined-102171.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 14:30:18'),
(4, '12347', 0, 'logo', 'login.retrod.in', 'undefined-205051.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 14:30:31'),
(5, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-267807.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 16:31:43'),
(6, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-416083.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 16:31:56'),
(7, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-918364.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 23:54:15'),
(8, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-929550.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 23:54:18'),
(9, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-759516.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 23:54:22'),
(10, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-500138.png', NULL, NULL, 'public', 'a_1', '', '2024-05-03 23:54:27'),
(11, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-711951.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:10:55'),
(12, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-805334.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:00'),
(13, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-476881.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:04'),
(14, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-626487.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:09'),
(15, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-800912.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:27'),
(16, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-386816.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:31'),
(17, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-811675.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:35'),
(18, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-724791.png', NULL, NULL, 'public', 'a_1', '', '2024-05-07 21:11:40'),
(19, '12346', 0, 'logo', 'login.retrod.in', 'nayakhotel-765475.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:36:49'),
(20, '12346', 0, 'logo', 'login.retrod.in', 'nbresort-698158.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:16'),
(21, '12346', 0, 'logo', 'login.retrod.in', 'nbresort-700436.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:23'),
(22, '12346', 0, 'logo', 'login.retrod.in', 'nbresort-469983.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:28'),
(23, '12346', 0, 'logo', 'login.retrod.in', 'nbresort-691535.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:32'),
(24, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-940224.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:39'),
(25, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-479006.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:44'),
(26, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-881442.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 14:55:48'),
(27, '12345', 0, 'logo', 'login.retrod.in', 'nayakhotel-307743.png', NULL, NULL, 'public', 'a_1', '', '2024-05-09 15:38:30'),
(28, '12345', 0, 'guest', 'login.retrod.in', '-995946.jpg', NULL, NULL, 'private', 'a_1', '', '2024-05-23 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_layout`
--

CREATE TABLE `hotel_layout` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `layoutId` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_page`
--

CREATE TABLE `hotel_page` (
  `id` int(11) NOT NULL,
  `hotelId` int(11) NOT NULL,
  `proId` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `pageName` varchar(250) NOT NULL,
  `bgImg` varchar(250) NOT NULL,
  `img1` varchar(250) DEFAULT NULL,
  `img2` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `srtDes` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rurl` varchar(250) DEFAULT NULL,
  `rurlBtn` varchar(250) DEFAULT NULL,
  `addBy` text DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_pay_roll`
--

CREATE TABLE `hotel_pay_roll` (
  `id` int(11) NOT NULL,
  `getwayId` int(11) DEFAULT NULL,
  `keyId` varchar(250) NOT NULL,
  `keySecret` varchar(250) NOT NULL,
  `env` varchar(250) NOT NULL,
  `keyIndex` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_theme_color`
--

CREATE TABLE `hotel_theme_color` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `primaryClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `primaryClrHover` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `textClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `bgClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `bgClr2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderClr2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderHoverClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `waBtnClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `warning` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `warning2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `tooltipClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `tooltipBg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hotel_theme_color`
--

INSERT INTO `hotel_theme_color` (`id`, `hotelId`, `primaryClr`, `primaryClrHover`, `textClr`, `bgClr`, `bgClr2`, `borderClr`, `borderClr2`, `borderHoverClr`, `waBtnClr`, `warning`, `warning2`, `tooltipClr`, `tooltipBg`) VALUES
(1, '41517', '#bd6e00,', '#9e5c00,#9e5c00', ',#ffffff', '#ffffff,#000000', '', '', '', '', '', '', '', ',#ff0000', ''),
(2, '55051', '', '', '', '\',#000000', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `housekeeping`
--

CREATE TABLE `housekeeping` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `roomNum` varchar(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `remark` text NOT NULL DEFAULT '',
  `formDate` date DEFAULT NULL,
  `toDate` date DEFAULT NULL,
  `assigningHK` int(11) NOT NULL DEFAULT 0,
  `addBy` varchar(12) NOT NULL DEFAULT '',
  `processTime` datetime DEFAULT NULL,
  `completeTime` datetime DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_detail_id` int(11) DEFAULT NULL,
  `add_date` date NOT NULL,
  `room` int(11) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `price2` float NOT NULL DEFAULT 0,
  `eAdult` float NOT NULL,
  `eChild` float NOT NULL,
  `addBy` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotgstprice`
--

CREATE TABLE `kotgstprice` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `igst` int(11) DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotguestdetail`
--

CREATE TABLE `kotguestdetail` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `addOn` timestamp NULL DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotorder`
--

CREATE TABLE `kotorder` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `billno` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `resturantId` int(11) NOT NULL DEFAULT 0,
  `servicePropertyId` int(11) NOT NULL,
  `bookingDetailId` int(11) NOT NULL DEFAULT 0,
  `orderType` int(11) NOT NULL DEFAULT 1,
  `bookingId` int(11) NOT NULL DEFAULT 0,
  `personId` int(11) NOT NULL DEFAULT 0,
  `totalProductPrice` float NOT NULL,
  `kotDisPro` varchar(10) NOT NULL DEFAULT '0',
  `kotDisValue` float NOT NULL DEFAULT 0,
  `subTotal` float NOT NULL,
  `tax` float NOT NULL,
  `totalPrice` float NOT NULL,
  `kotAdvancePay` float NOT NULL DEFAULT 0,
  `kotBalancePay` float NOT NULL DEFAULT 0,
  `settlementAmount` int(11) NOT NULL DEFAULT 0,
  `folioId` int(11) NOT NULL DEFAULT 0,
  `noteAdd` text DEFAULT '',
  `totalPerson` int(11) NOT NULL DEFAULT 0,
  `waiter` int(11) NOT NULL DEFAULT 0,
  `turnAroundTime` time DEFAULT NULL,
  `orderStatus` int(11) NOT NULL DEFAULT 0,
  `addOn` timestamp NULL DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotorderdetail`
--

CREATE TABLE `kotorderdetail` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `proId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `note` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotorderstatus`
--

CREATE TABLE `kotorderstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `bgcolor` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotprouct_attr`
--

CREATE TABLE `kotprouct_attr` (
  `id` int(11) NOT NULL,
  `pId` int(11) NOT NULL DEFAULT 0,
  `attrName` varchar(250) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotprouct_cat`
--

CREATE TABLE `kotprouct_cat` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotprouct_hotel`
--

CREATE TABLE `kotprouct_hotel` (
  `id` int(11) NOT NULL,
  `hotelid` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `pCat` int(11) NOT NULL DEFAULT 0,
  `accessKey` varchar(250) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `productcat` int(150) DEFAULT NULL,
  `mealTime` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kotprouct_sys`
--

CREATE TABLE `kotprouct_sys` (
  `id` int(11) NOT NULL,
  `accessKey` varchar(250) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `price` float NOT NULL,
  `productcat` int(150) NOT NULL,
  `mealTime` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kottable`
--

CREATE TABLE `kottable` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `resId` int(11) NOT NULL DEFAULT 0,
  `tableNum` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_qty_unit`
--

CREATE TABLE `kot_qty_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `fullForm` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_raw_product_list`
--

CREATE TABLE `kot_raw_product_list` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL,
  `sku` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL,
  `priceCalculateBy` varchar(150) NOT NULL,
  `proCat` int(11) NOT NULL,
  `img` varchar(150) DEFAULT NULL,
  `tag` varchar(250) NOT NULL DEFAULT '',
  `qty` int(11) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `addBy` int(11) NOT NULL DEFAULT 0,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_restaurant`
--

CREATE TABLE `kot_restaurant` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(15) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_stock`
--

CREATE TABLE `kot_stock` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `rawProId` int(11) NOT NULL,
  `qty` float NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp(),
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_stock_category`
--

CREATE TABLE `kot_stock_category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot_stock_timeline`
--

CREATE TABLE `kot_stock_timeline` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `kotStockId` int(11) NOT NULL,
  `action` enum('buy','sell') NOT NULL,
  `qty` float NOT NULL,
  `totalPrice` float DEFAULT NULL,
  `addBy` int(11) NOT NULL DEFAULT 0,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live`
--

CREATE TABLE `live` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lost_found`
--

CREATE TABLE `lost_found` (
  `hotelId` varchar(250) NOT NULL,
  `id` int(11) NOT NULL,
  `type` enum('lost','found') NOT NULL DEFAULT 'lost',
  `activityDate` timestamp NULL DEFAULT NULL,
  `item_name` varchar(250) DEFAULT NULL,
  `item_color` varchar(250) DEFAULT NULL,
  `lost_location` varchar(250) DEFAULT NULL,
  `who_found` varchar(250) DEFAULT NULL,
  `found_location` varchar(250) DEFAULT NULL,
  `room` int(11) NOT NULL DEFAULT 0,
  `item_value` float NOT NULL DEFAULT 0,
  `co_name` varchar(250) DEFAULT NULL,
  `co_phone` varchar(250) DEFAULT NULL,
  `co_address` varchar(250) DEFAULT NULL,
  `co_country` varchar(250) DEFAULT NULL,
  `co_state` varchar(250) DEFAULT NULL,
  `co_city` varchar(250) DEFAULT NULL,
  `co_pin` int(11) NOT NULL DEFAULT 0,
  `status` varchar(11) DEFAULT NULL,
  `status_by` varchar(250) DEFAULT NULL,
  `status_date` timestamp NULL DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `add_by` int(11) NOT NULL,
  `add_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailinvoice`
--

CREATE TABLE `mailinvoice` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(150) DEFAULT NULL,
  `reservationGuest` text DEFAULT NULL,
  `checkinGuest` text DEFAULT NULL,
  `checkoutGuest` text DEFAULT NULL,
  `payment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `orgType` varchar(250) DEFAULT NULL,
  `orgConName` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `organisationEmail` varchar(255) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `cpwhatsappNumber` varchar(50) DEFAULT NULL,
  `cpPhoneNumber` varchar(50) DEFAULT NULL,
  `organisationAddress` varchar(255) DEFAULT NULL,
  `organisationCity` varchar(100) DEFAULT NULL,
  `organisationState` varchar(100) DEFAULT NULL,
  `organisationCountry` varchar(100) DEFAULT NULL,
  `organisationPostCode` varchar(20) DEFAULT NULL,
  `organisationNumber` varchar(20) DEFAULT NULL,
  `organisationGstNo` varchar(20) DEFAULT NULL,
  `ratePlan` varchar(50) DEFAULT NULL,
  `salesManager` varchar(100) DEFAULT NULL,
  `organisationDiscount` decimal(10,2) DEFAULT NULL,
  `organisationNote` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `hotelId` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `img` varchar(250) NOT NULL,
  `car` int(11) NOT NULL,
  `duration` float NOT NULL,
  `description` text NOT NULL,
  `room` int(11) NOT NULL,
  `rdid` int(11) NOT NULL,
  `discount` float NOT NULL,
  `pickup` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `addBy` text NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_policy`
--

CREATE TABLE `package_policy` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_link`
--

CREATE TABLE `payment_link` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `paymentId` varchar(250) NOT NULL,
  `proId` int(11) NOT NULL DEFAULT 0,
  `accessId` int(11) NOT NULL DEFAULT 0,
  `transactionId` varchar(250) DEFAULT NULL,
  `paymentSrtLink` varchar(250) DEFAULT NULL,
  `paymentLink` text NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `amount` float NOT NULL,
  `reason` varchar(500) DEFAULT NULL,
  `paymentStatus` enum('process','failed','success','expired') NOT NULL DEFAULT 'process',
  `status` int(11) NOT NULL DEFAULT 1,
  `deletRec` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_link`
--

INSERT INTO `payment_link` (`id`, `hotelId`, `paymentId`, `proId`, `accessId`, `transactionId`, `paymentSrtLink`, `paymentLink`, `name`, `email`, `phone`, `amount`, `reason`, `paymentStatus`, `status`, `deletRec`, `addOn`) VALUES
(1, '41517', '', 0, 0, '41517', '', 'https://mercury-t2.phonepe.com/transact/pg?token=MGE1OWRmZGExNzI3NzI4OGE0NGQ5Y2I3YmU3NjA3N2FmNjRlMGY2NWVmZjJhNTIyNTdhYjk3NTYyMzg5NDNkNDU2MmE1MTI2ODcxMGYwOjE0YjQ2MDMzYjg4YmFkMGY0NDM5NzRjZTBlMjY2ODQx', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '0000-00-00 00:00:00'),
(2, '41517', '225', 0, 0, '41517', '', 'https://mercury-t2.phonepe.com/transact/pg?token=OWQwNDQ4M2Y0NGQ0YTM4ZmY5MDk4YjI5OTVjNzYyYThkODRmZDI0MjA5ZDQyMmU3NzAzZDEzZGJhMzM3ODBiNzI4ZGE5OTMxYzk4NTk4OmQ3YWJkZDhhNGM5MTA5ZmI5Y2YxMWI2MzEwOTJkMjAz', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '0000-00-00 00:00:00'),
(3, '41517', '226', 0, 0, '41517', '', 'https://mercury-t2.phonepe.com/transact/pg?token=MjNhNmE4MWM1NmY0OTJkMmQ0ZWI5M2Q0NTc1ZWViMjFiODJjMjRhMGFjNTY0ZWU0OTRhOGQ4YmRjYTUyMGRhYzYyZjc1MjA3NzgzNzE2OjNhZGY1ZDYwNTE2MWFmNGQzMDNiODQ4NWY5MTg3MjNk', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '0000-00-00 00:00:00'),
(4, '12345', '227', 0, 0, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=Yjc5N2M2ZjZjZDc0MTYxNjlhYWQxMWViMTc1NDg2ZTE0YTYyYzY0M2U0MTllZTU2NGIxODYyN2M4MzM0NDU3MGU5OTgxMzE3NDE0OGNlOjk1ZTNiNzg1MjA2YTgyNzkxNDkyODE2NmQ4M2U5YTU1', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '0000-00-00 00:00:00'),
(5, '12345', '228', 0, 0, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=Njk1ZTAwNzUxNDhmMGYzZGNkMTc0ZDgzOWY4NzBlZWFkNzg0NmIwYjQxODU5NjJlMjI3MjVhZmVlZTJjNWQyZDg0OGJlMGI3YjU1MWFjOjg3ZjcyNDIyZTdiYzBiZGUyN2M1MGZjYWYyNjE2ZTdh', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '2024-05-06 18:30:00'),
(6, '12345', '299', 0, 0, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=NzViMWU3NWY3ZjYxNDYzNWRlMzk5NGUzZGVlZmMzZDUyNmE1ZGI3Njc0YTBiNzYzMGI4ZjMyZWExMmU2M2UxYTgwMTYwMzk5ZGI5MjFjOjUxMzllMWExZTMwNDViNGZlNGExN2E1YmZiODI0ZDY2', 'Avinab', 'avinabgiri9439@gmail.com', '09439706344', 1, 'test', 'process', 1, 1, '2024-05-09 18:30:00'),
(7, '12345', '338', 0, 0, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=ZWE1MDcxZmZhZDg4NjdiNTg0NzhlYTI3Mzc4ZDc3M2I3ZDJkOWY0NDhhMGI5OTYzOTJjNjdiMzE3YzE4ZTdjMDBhMDZjOTI5Y2MwMjowM2QwZWM2ZGNmYTdiZGRhY2U4MWM0OGMxOTU4N2QxOQ', 'Dishanee Satpathy', 'dishanee@retrodtech.com', '06295919110', 1, '', 'process', 1, 1, '2024-05-23 07:00:00'),
(8, '12345', '339', 0, 7, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=ZDk4OTExMGQ1NjUwM2UyZjNmYjRmYTFhMGZhZjEwYzRkYjQxYTI1OTQ0NThjNDQ2ODg0ZGUxZTYxZThhM2UwYjZhODlhYjg4YjM0MWYxOjQ3MmUxNGIyODRhYjQzN2VjODhkMmM3OTQ4YTBkNzcz', 'Dishanee Satpathy', 'dishanee@retrodtech.com', '06295919110', 10, '', 'process', 1, 1, '2024-05-23 07:00:00'),
(9, '12345', '340', 0, 0, '12345', '', 'https://mercury-t2.phonepe.com/transact/pg?token=ZTZkOWZiOTljZjNhODI0ZmJjMDIzOTUzOWM2MGM3OWFmOGJjMjYzOTFmNzA3NTFiMzdkY2M4OGU0NDgyZWU2NjEzZTAxNTdhZmIxMDhhOmJjM2ZjZThmYjc0OGYwOThkNTk4Y2JiZDVlZmNmYjI3', 'Dishanee Satpathy', 'avi@gmail.com', '6295919110', 1, '', 'process', 1, 1, '2024-05-23 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`id`, `name`, `addOn`) VALUES
(1, 'Success', '2022-08-26 00:56:35'),
(2, 'Failed', '2022-08-26 00:56:47'),
(3, 'Return', '2022-08-26 00:57:07'),
(4, 'Pending', '2024-01-09 10:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `payment_timeline`
--

CREATE TABLE `payment_timeline` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) DEFAULT NULL,
  `billingNo` int(11) NOT NULL DEFAULT 0,
  `proId` int(11) NOT NULL DEFAULT 0,
  `proSubId` int(11) NOT NULL DEFAULT 0,
  `bid` int(11) NOT NULL DEFAULT 0,
  `posId` int(11) NOT NULL DEFAULT 0,
  `accessId` int(11) NOT NULL DEFAULT 0,
  `amount` float NOT NULL,
  `tip` float NOT NULL DEFAULT 0,
  `paymentMethod` int(11) NOT NULL,
  `openFolio` int(11) NOT NULL DEFAULT 1,
  `remark` text DEFAULT NULL,
  `payment_status` enum('success','return','failed') NOT NULL DEFAULT 'success',
  `statusUpdateOn` datetime DEFAULT NULL,
  `paidOn` datetime DEFAULT NULL,
  `statusUpdateRemark` varchar(500) DEFAULT NULL,
  `addBy` varchar(11) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_timeline`
--

INSERT INTO `payment_timeline` (`id`, `hotelId`, `billingNo`, `proId`, `proSubId`, `bid`, `posId`, `accessId`, `amount`, `tip`, `paymentMethod`, `openFolio`, `remark`, `payment_status`, `statusUpdateOn`, `paidOn`, `statusUpdateRemark`, `addBy`, `addOn`) VALUES
(1, '12345', 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, NULL, 'success', NULL, '0000-00-00 00:00:00', NULL, 'a_1', '2024-06-06 17:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `payment_verify`
--

CREATE TABLE `payment_verify` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `proof` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propertycounlist`
--

CREATE TABLE `propertycounlist` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `addBy` int(11) DEFAULT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propertyinfo`
--

CREATE TABLE `propertyinfo` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `sn` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `type` enum('information','policies') NOT NULL,
  `addBy` int(11) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propertylocation`
--

CREATE TABLE `propertylocation` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `address` varchar(500) DEFAULT '',
  `address2` varchar(250) DEFAULT NULL,
  `city` varchar(250) NOT NULL DEFAULT '',
  `district` varchar(250) DEFAULT '',
  `pincode` varchar(25) DEFAULT '',
  `country` varchar(50) DEFAULT '',
  `state` varchar(50) DEFAULT '',
  `latitude` varchar(50) NOT NULL DEFAULT '',
  `longitude` varchar(50) NOT NULL DEFAULT '',
  `mapLink` varchar(250) NOT NULL DEFAULT '',
  `mapIfrem` varchar(500) DEFAULT '',
  `mapIfremStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propertylocation`
--

INSERT INTO `propertylocation` (`id`, `hotelId`, `address`, `address2`, `city`, `district`, `pincode`, `country`, `state`, `latitude`, `longitude`, `mapLink`, `mapIfrem`, `mapIfremStatus`) VALUES
(1, '12345', 'Nayak Beach Resort, Niladri Beach, ChakraTirtha ( C.T.) Road, <br/> Puri - 752002 ( Landmark - Near Hotel Mayfair )', NULL, '', '', '', '', '', '', '', 'https://maps.app.goo.gl/ws85m1X5zDjDTrac6', '', 0),
(2, '12346', 'Nayak Beach Resort, Niladri Beach, ChakraTirtha ( C.T.) Road, <br/> Puri - 752002 ( Landmark - Near Hotel Mayfair )', NULL, '', '', '', '', '', '', '', 'https://maps.app.goo.gl/ws85m1X5zDjDTrac6', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `propertyrateplan`
--

CREATE TABLE `propertyrateplan` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(20) NOT NULL,
  `srtcode` varchar(11) NOT NULL,
  `fullForm` varchar(250) NOT NULL,
  `icon` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propertysetting`
--

CREATE TABLE `propertysetting` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `adultRestriction` varchar(250) DEFAULT NULL,
  `childRestriction` varchar(250) DEFAULT NULL,
  `maxRoomCapacity` int(11) DEFAULT NULL,
  `advancePay` float DEFAULT NULL,
  `pckupDropPrice` float DEFAULT NULL,
  `pckupDropCaption` text DEFAULT NULL,
  `PartialPaymentPrice` varchar(250) DEFAULT NULL,
  `partialPaymentCaption` text DEFAULT NULL,
  `pckupDropStatus` int(11) DEFAULT NULL,
  `partialPaymentStatus` int(11) DEFAULT NULL,
  `advancePayStatus` int(11) DEFAULT NULL,
  `payByRoomStatus` int(11) DEFAULT NULL,
  `bookingCode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propertysetting`
--

INSERT INTO `propertysetting` (`id`, `hotelId`, `adultRestriction`, `childRestriction`, `maxRoomCapacity`, `advancePay`, `pckupDropPrice`, `pckupDropCaption`, `PartialPaymentPrice`, `partialPaymentCaption`, `pckupDropStatus`, `partialPaymentStatus`, `advancePayStatus`, `payByRoomStatus`, `bookingCode`) VALUES
(1, '12345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '12346', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_addon_charges`
--

CREATE TABLE `property_addon_charges` (
  `id` int(11) NOT NULL,
  `hotelid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_pg`
--

CREATE TABLE `property_pg` (
  `id` int(11) NOT NULL,
  `hid` varchar(11) NOT NULL,
  `type` enum('retrod','hotel') NOT NULL DEFAULT 'retrod',
  `pPayId` int(11) NOT NULL DEFAULT 1,
  `paymentGetway` int(11) NOT NULL DEFAULT 0,
  `keyId` varchar(250) NOT NULL DEFAULT '',
  `keySecret` varchar(250) NOT NULL DEFAULT '',
  `env` varchar(250) NOT NULL DEFAULT '',
  `keyIndex` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_seo`
--

CREATE TABLE `property_seo` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `beTitle` varchar(60) NOT NULL,
  `beMetaDesc` varchar(160) NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `chartBoot` text NOT NULL,
  `googleAnalytics` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_term`
--

CREATE TABLE `property_term` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `policyType` enum('hotel','cancel','refund') NOT NULL DEFAULT 'hotel',
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quickpay`
--

CREATE TABLE `quickpay` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `orderId` varchar(250) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(250) NOT NULL,
  `room` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `nOfRoom` int(11) NOT NULL DEFAULT 1,
  `roomPrice` float NOT NULL,
  `qickPayNote` text NOT NULL,
  `totalAmount` float NOT NULL DEFAULT 0,
  `amount` float NOT NULL,
  `checkIn` date NOT NULL,
  `checkOut` date NOT NULL,
  `paymentId` varchar(250) DEFAULT NULL,
  `paymentStatus` varchar(250) NOT NULL,
  `addBy` text NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `minDay` int(11) NOT NULL DEFAULT 1,
  `shortCode` varchar(10) NOT NULL DEFAULT '',
  `header` varchar(250) NOT NULL,
  `sName` varchar(150) NOT NULL DEFAULT '',
  `bedtype` varchar(250) NOT NULL,
  `totalroom` int(11) NOT NULL DEFAULT 0,
  `roomcapacity` int(11) NOT NULL,
  `description` text NOT NULL,
  `noAdult` int(11) NOT NULL,
  `noChild` int(11) NOT NULL,
  `add_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `mrp` float NOT NULL,
  `roomArea` varchar(150) DEFAULT NULL,
  `noBed` varchar(150) DEFAULT NULL,
  `noBathroom` varchar(150) DEFAULT NULL,
  `faceId` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `booking` int(11) NOT NULL DEFAULT 0,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addBy` text NOT NULL DEFAULT '',
  `ipaddres` varchar(150) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `hotelId`, `slug`, `minDay`, `shortCode`, `header`, `sName`, `bedtype`, `totalroom`, `roomcapacity`, `description`, `noAdult`, `noChild`, `add_on`, `status`, `mrp`, `roomArea`, `noBed`, `noBathroom`, `faceId`, `view`, `booking`, `deleteRec`, `addBy`, `ipaddres`) VALUES
(1, '12347', 'super-deluxe', 1, '', 'Super Deluxe', '', 'king', 0, 3, '', 2, 0, '2024-05-01 01:49:17', 1, 3000, NULL, NULL, NULL, 0, 0, 0, 1, '', ''),
(2, '12345', 'super-deluxe', 1, '', 'Super Deluxe', '', 'king', 0, 3, '', 2, 0, '2024-05-04 05:25:19', 1, 5000, NULL, NULL, NULL, 0, 0, 0, 1, '', ''),
(3, '12345', 'studio-room', 1, '', 'Studio Room', '', 'king', 0, 0, '', 0, 0, '2024-05-04 05:25:32', 1, 0, NULL, NULL, NULL, 0, 0, 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `roomfeature`
--

CREATE TABLE `roomfeature` (
  `id` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `featureId` int(11) NOT NULL,
  `value` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roomnumber`
--

CREATE TABLE `roomnumber` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `roomNo` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `constuctionStatus` int(11) NOT NULL DEFAULT 1,
  `hkid` int(11) NOT NULL DEFAULT 0,
  `addBy` text NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomnumber`
--

INSERT INTO `roomnumber` (`id`, `hotelId`, `roomNo`, `roomId`, `status`, `constuctionStatus`, `hkid`, `addBy`, `addOn`, `deleteRec`) VALUES
(1, '12347', 101, 1, 1, 1, 0, 'a_1', '2024-05-01 01:48:02', 1),
(2, '12347', 102, 1, 1, 1, 0, 'a_1', '2024-05-01 01:48:04', 1),
(3, '12347', 103, 1, 1, 1, 0, 'a_1', '2024-05-01 01:48:06', 1),
(4, '12345', 0, 4, 1, 1, 0, '', '2024-05-13 16:34:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomratetype`
--

CREATE TABLE `roomratetype` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `singlePrice` float NOT NULL,
  `doublePrice` float NOT NULL DEFAULT 0,
  `extra_adult` float NOT NULL,
  `extra_child` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomratetype`
--

INSERT INTO `roomratetype` (`id`, `room_id`, `title`, `singlePrice`, `doublePrice`, `extra_adult`, `extra_child`, `status`) VALUES
(1, 1, '1', 2500, 2800, 800, 500, 1),
(2, 2, '', 0, 0, 0, 0, 1),
(3, 3, '', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomstatus`
--

CREATE TABLE `roomstatus` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `pId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `color` varchar(150) NOT NULL,
  `bg` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities`
--

CREATE TABLE `room_amenities` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `amenitie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_block`
--

CREATE TABLE `room_block` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(250) NOT NULL,
  `sartDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `roomNum` int(11) NOT NULL DEFAULT 0,
  `reason` text DEFAULT NULL,
  `addBy` varchar(150) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_img`
--

CREATE TABLE `room_img` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_img`
--

INSERT INTO `room_img` (`id`, `room_id`, `image`) VALUES
(1, 0, '1'),
(2, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `sales_type_list`
--

CREATE TABLE `sales_type_list` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sts_pay_roll`
--

CREATE TABLE `sts_pay_roll` (
  `id` int(11) NOT NULL,
  `getwayId` int(11) DEFAULT NULL,
  `keyId` varchar(250) NOT NULL,
  `keySecret` varchar(250) NOT NULL,
  `env` varchar(250) NOT NULL,
  `keyIndex` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sty_default_value`
--

CREATE TABLE `sty_default_value` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `shortName` varchar(50) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_rp`
--

CREATE TABLE `system_rp` (
  `id` int(11) NOT NULL,
  `shortCut` varchar(10) NOT NULL,
  `fullName` varchar(250) NOT NULL,
  `clr` varchar(50) NOT NULL,
  `bg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_rp`
--

INSERT INTO `system_rp` (`id`, `shortCut`, `fullName`, `clr`, `bg`) VALUES
(1, 'EP', 'Only Room', '', ''),
(2, 'CP', 'Room With Breakfast', '', ''),
(3, 'MAP', 'MAP', '', ''),
(4, 'AP', 'AP', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_activitystatus`
--

CREATE TABLE `sys_activitystatus` (
  `id` int(11) NOT NULL,
  `accessKey` varchar(150) NOT NULL,
  `title` varchar(250) NOT NULL,
  `svg` text DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `bgClr` varchar(10) DEFAULT NULL,
  `style` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_activitystatus`
--

INSERT INTO `sys_activitystatus` (`id`, `accessKey`, `title`, `svg`, `color`, `bgClr`, `style`) VALUES
(1, 'login', 'Log In', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\">  <g id=\"login\"> 	<path d=\"M14.1,45.5H3.8c1.5-11.3,11.1-19.9,22.7-19.9c2.4,0,4.9,0.4,7.2,1.1c0.8,0.3,1.6-0.2,1.9-1 		c0.3-0.8-0.2-1.6-1-1.9c-0.6-0.2-1.3-0.4-1.9-0.5C35.9,21.1,38,17.3,38,13c0-6.9-5.6-12.6-12.6-12.6S12.9,6.1,12.9,13 		c0,4.5,2.4,8.5,6,10.7C8.8,26.8,1.3,35.9,0.6,46.9c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0.1,0,0.1c0,0.1,0,0.1,0,0.2c0,0,0,0.1,0,0.1 		c0,0,0,0.1,0,0.1c0,0,0,0.1,0.1,0.1c0,0,0,0.1,0.1,0.1c0,0,0.1,0.1,0.1,0.1C0.9,47.9,1,48,1,48c0,0,0.1,0.1,0.1,0.1 		c0,0,0.1,0.1,0.1,0.1c0,0,0.1,0.1,0.1,0.1c0,0,0.1,0,0.1,0.1c0,0,0.1,0,0.1,0.1c0,0,0.1,0,0.1,0c0.1,0,0.1,0,0.2,0c0,0,0.1,0,0.1,0 		c0,0,0.1,0,0.1,0c0,0,0,0,0,0h12c0.8,0,1.5-0.7,1.5-1.5S14.9,45.5,14.1,45.5z M15.9,13c0-5.3,4.3-9.6,9.6-9.6S35,7.7,35,13 		c0,5.3-4.3,9.6-9.6,9.6S15.9,18.3,15.9,13z\"/> 	<path class=\"st0\" d=\"M48.7,35.3l-0.2-0.8c-0.2-0.7-0.4-1.6-0.9-2.4c-0.7-1-1.7-1.5-3-1.6c-1.7-0.1-3.3-0.1-5,0 		c-0.8,0-1.5,0-2.3,0c-2.2,0-4,1.7-4.1,3.9H20.5c-0.4,0-0.8,0.2-1.1,0.4l-3.3,3.4c-0.6,0.6-0.6,1.5,0,2.1l3.3,3.4 		c0.3,0.3,0.7,0.4,1.1,0.4h5.8c0.8,0,1.5-0.7,1.5-1.5s-0.7-1.5-1.5-1.5h-5.2l-1.9-1.9l1.9-1.9h13.7c0.8,0,1.5-0.7,1.5-1.5v-1.3 		c0-0.6,0.5-1.1,1.1-1.1c0.8,0,1.5,0,2.3,0c1.6,0,3.2,0,4.8,0c0.5,0,0.6,0.2,0.7,0.3c0.2,0.3,0.3,0.8,0.5,1.4l0.2,0.8 		c0.4,1.4,0.7,2.8,0.6,4c-0.1,0.8-0.3,1.7-0.5,2.5c-0.1,0.3-0.2,0.6-0.2,0.9l-0.1,0.2c-0.1,0.5-0.3,1.1-0.5,1.4 		c-0.1,0.1-0.2,0.3-0.8,0.4c-0.3,0-0.6,0-1,0l-6,0c-0.6,0-1.1-0.5-1.1-1.1v-1.6c0-0.8-0.7-1.5-1.5-1.5s-1.5,0.7-1.5,1.5v1.6 		c0,2.3,1.8,4.1,4.1,4.1h5.5l0.4,0c0.2,0,0.3,0,0.5,0c0.3,0,0.5,0,0.8,0c0.5,0,2.2-0.2,3.2-1.8c0.5-0.8,0.7-1.6,0.8-2.3l0.1-0.2 		c0.1-0.3,0.1-0.5,0.2-0.8c0.3-1,0.5-2,0.6-3.1C49.5,38.5,49.1,36.9,48.7,35.3z\"/> 	<circle cx=\"42.3\" cy=\"39.3\" r=\"1.9\"/> </g> </svg>', '#155724', '', 'border: 1px dashed #155724; background: #d4edda; color: #155724;'),
(2, 'checkin', 'Check in', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\" >  <g id=\"checkin\"> 	<path d=\"M43.4,5.8h-5.1V3.4c0-0.6-0.4-1-1-1s-1,0.4-1,1v2.4H19.8V3.4c0-0.6-0.4-1-1-1s-1,0.4-1,1v2.4 		h-5.2c-2.8,0-5.1,2.3-5.1,5.1v15.9c0,0.6,0.4,1,1,1s1-0.4,1-1v-5.6h37v21.5c0,1.7-1.4,3.1-3.1,3.1H12.6c-1.7,0-3.1-1.4-3.1-3.1 		v-5.1c0-0.6-0.4-1-1-1s-1,0.4-1,1v5.1c0,2.8,2.3,5.1,5.1,5.1h30.8c2.8,0,5.1-2.3,5.1-5.1V10.9C48.5,8.1,46.2,5.8,43.4,5.8z 		 M9.5,19.2v-8.3c0-1.7,1.4-3.1,3.1-3.1h5.2v2.6c-1.2,0.4-2.1,1.5-2.1,2.9c0,1.7,1.4,3.1,3.1,3.1s3.1-1.4,3.1-3.1 		c0-1.3-0.9-2.5-2.1-2.9V7.8h16.5v2.6c-1.2,0.4-2.1,1.5-2.1,2.9c0,1.7,1.4,3.1,3.1,3.1s3.1-1.4,3.1-3.1c0-1.3-0.9-2.5-2.1-2.9V7.8 		h5.1c1.7,0,3.1,1.4,3.1,3.1v8.3H9.5z M18.8,12.3c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S18.3,12.3,18.8,12.3z 		 M37.3,12.3c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S36.7,12.3,37.3,12.3z\"/> 	<path d=\"M17.9,36.9c-0.4,0.4-0.3,1,0.1,1.4c0.2,0.2,0.4,0.3,0.7,0.3c0.3,0,0.5-0.1,0.7-0.3l5-5.5 		c0,0,0-0.1,0.1-0.1c0,0,0,0,0-0.1c0,0,0-0.1,0.1-0.1c0,0,0,0,0,0c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0,0,0,0,0,0 		c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0,0-0.1-0.1-0.1-0.1c0,0,0,0,0-0.1c0,0,0-0.1-0.1-0.1l-5-5.3 		c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l3.4,3.6H2c-0.6,0-1,0.4-1,1s0.4,1,1,1h19.4L17.9,36.9z\"/> </g> </svg>', '#0030d5', '', ''),
(3, 'checkout', 'Check Out', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\" >  <g id=\"checkout\"> 	<path d=\"M39.4,35.3c-0.6,0-1,0.4-1,1v4.9c0,1.6-1.3,2.9-2.9,2.9H6.1c-1.6,0-2.9-1.3-2.9-2.9V20.8h35.2 		V26c0,0.6,0.4,1,1,1s1-0.4,1-1V10.9c0-2.7-2.2-4.9-4.9-4.9h-4.8V3.7c0-0.6-0.4-1-1-1s-1,0.4-1,1V6H13V3.7c0-0.6-0.4-1-1-1 		s-1,0.4-1,1V6h-5c-2.7,0-4.9,2.2-4.9,4.9v30.3c0,2.7,2.2,4.9,4.9,4.9h29.4c2.7,0,4.9-2.2,4.9-4.9v-4.9 		C40.4,35.8,39.9,35.3,39.4,35.3z M6.1,8h5v2.4c-1.1,0.4-2,1.5-2,2.8c0,1.6,1.3,3,3,3s3-1.3,3-3c0-1.3-0.8-2.4-2-2.8V8h15.6v2.4 		c-1.1,0.4-2,1.5-2,2.8c0,1.6,1.3,3,3,3s3-1.3,3-3c0-1.3-0.8-2.4-2-2.8V8h4.8c1.6,0,2.9,1.3,2.9,2.9v7.9H3.1v-7.9 		C3.1,9.3,4.5,8,6.1,8z M12,12.2c0.5,0,1,0.4,1,1c0,0.5-0.4,1-1,1c-0.5,0-1-0.4-1-1C11,12.6,11.5,12.2,12,12.2z M29.6,12.2 		c0.5,0,1,0.4,1,1c0,0.5-0.4,1-1,1c-0.5,0-1-0.4-1-1C28.7,12.6,29.1,12.2,29.6,12.2z\"/> 	<path d=\"M48.4,30.1H30l3.2-3.4c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0l-4.8,5c0,0,0,0.1-0.1,0.1 		c0,0,0,0,0,0.1c0,0-0.1,0.1-0.1,0.1c0,0,0,0,0,0c0,0.1,0,0.1,0,0.2c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c0,0,0,0,0,0c0,0.1,0,0.1,0,0.2 		c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c0,0,0,0.1,0.1,0.1c0,0,0,0,0,0.1c0,0,0,0.1,0.1,0.1l4.8,5.2c0.2,0.2,0.5,0.3,0.7,0.3 		c0.2,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0.1-1.4L30,32.1h18.4c0.6,0,1-0.4,1-1S48.9,30.1,48.4,30.1z\"/> </g> </svg>', '#ed143d', '', ''),
(4, 'payment', 'Payment', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\" > <g id=\"payment\"> 	<path d=\"M21.8,11.8c-5.8,0-11.6,0-17.3,0c-0.4,0-0.5,0.1-0.5,0.5c0,1.8,0,3.5,0,5.3C4,18.4,3.5,19,2.8,19 		c-0.7,0-1.2-0.5-1.2-1.4c0-3.4,0-6.8,0-10.2c0-3.2,2.7-5.9,5.9-5.9c9.6,0,19.1,0,28.7,0c3.2,0,5.9,2.6,5.9,5.8c0,1.1,0,2.2,0,3.3 		c0,0.3,0,0.4,0.4,0.4c3.4-0.1,6,2.8,6,6.1c-0.1,6.2,0,12.4,0,18.6c0,3.6-2.6,6.1-6.1,6.1c-3.7,0-7.5,0-11.2,0 		c-0.8,0-1.3-0.5-1.3-1.1c0-0.7,0.5-1.2,1.3-1.2c3.7,0,7.4,0,11.1,0c0.4,0,0.9,0,1.3-0.2c1.6-0.5,2.6-1.8,2.6-3.6 		c0-4.5,0-8.9,0-13.4c0,0,0-0.1,0-0.1c0-0.2-0.1-0.3-0.3-0.3c-1.1,0-2.2,0-3.4,0C42,22,42,22.2,42,22.4c0,1.4,0,2.7,0,4.1 		c0,3.3-2.7,5.9-5.9,5.9c-1.4,0-2.7,0-4.1,0c-0.9,0-1.4-0.5-1.4-1.2c0-0.7,0.5-1.2,1.4-1.2c1.3,0,2.6,0,4,0c2.2,0,3.7-1.5,3.7-3.7 		c0-4.7,0-9.3,0-14c0-0.4-0.1-0.5-0.5-0.5C33.4,11.8,27.6,11.8,21.8,11.8z M21.8,9.5c5.8,0,11.5,0,17.3,0c0.1,0,0.2,0,0.3,0 		c0.1,0,0.2-0.1,0.2-0.2c0-0.9,0.1-1.8-0.1-2.7c-0.4-1.6-1.8-2.6-3.6-2.6c-9.4,0-18.7,0-28.1,0c-0.1,0-0.2,0-0.2,0 		C5.8,4,4.4,5.2,4.1,6.9C3.9,7.6,4.1,8.3,4,9c0,0.4,0.1,0.5,0.5,0.5C10.3,9.5,16,9.5,21.8,9.5z M42,16.5c0,0.9,0,1.8,0,2.8 		c0,0.2,0,0.4,0.3,0.4c1.1,0,2.2,0,3.4,0c0.2,0,0.3-0.1,0.3-0.3c0-0.8,0-1.7,0-2.5c-0.1-1.9-1.7-3.4-3.6-3.4c-0.3,0-0.4,0.1-0.4,0.4 		C42,14.7,42,15.6,42,16.5z\"/> 	<path d=\"M15.2,17.4c2.1,0,4.3,0,6.4,0c1.4,0,2.4,0.7,2.8,2c0.4,1.3,1.2,2.1,2.5,2.6c1.3,0.5,1.9,1.4,1.9,2.7 		c-0.2,4-0.4,8.1-0.7,12.1c-0.4,5.3-4.8,10-10,11.1c-7.4,1.5-14.3-3.2-15.5-10.6c-0.2-1.4-0.3-2.9-0.3-4.3c-0.2-2.7-0.3-5.4-0.4-8.1 		c-0.1-1.6,0.5-2.4,2-3c1.1-0.4,1.9-1.2,2.3-2.4c0.5-1.6,1.4-2.2,3-2.2C11.1,17.4,13.1,17.4,15.2,17.4z M15.3,19.8 		c-2.1,0-4.2,0-6.3,0c-0.4,0-0.6,0.1-0.7,0.5c-0.6,1.9-1.8,3.2-3.6,3.8c-0.4,0.1-0.5,0.3-0.5,0.8C4.2,26.9,4.3,29,4.4,31 		c0.1,1.8,0.1,3.6,0.4,5.4c0.7,5.8,6,10.4,12.5,9.2c4.4-0.8,8.1-4.8,8.4-9.2c0.3-3.9,0.5-7.8,0.7-11.6c0-0.4-0.1-0.6-0.5-0.8 		c-1.8-0.7-3.1-2-3.6-3.8c-0.1-0.4-0.3-0.5-0.7-0.5C19.4,19.8,17.3,19.8,15.3,19.8z\"/> 	<path d=\"M32.6,20.5c-0.9,0-1.7,0-2.6,0c-0.8,0-1.3-0.5-1.3-1.2c0-0.7,0.5-1.2,1.3-1.2c1.8,0,3.5,0,5.3,0 		c0.8,0,1.3,0.5,1.3,1.2c0,0.7-0.6,1.2-1.3,1.2C34.3,20.5,33.5,20.5,32.6,20.5z\"/> 	<path d=\"M35,37.2c-0.7,0-1.2-0.5-1.2-1.2c0-0.7,0.6-1.2,1.2-1.2c0.6,0,1.2,0.6,1.2,1.2C36.3,36.7,35.7,37.2,35,37.2 		z\"/> 	<path d=\"M35.1,22.5c0.7,0,1.2,0.6,1.2,1.2c0,0.6-0.6,1.2-1.2,1.2c-0.7,0-1.2-0.6-1.2-1.2 		C33.9,23,34.4,22.5,35.1,22.5z\"/> 	<path d=\"M39.1,37.2c-0.7,0-1.2-0.5-1.2-1.2c0-0.6,0.5-1.2,1.2-1.2c0.6,0,1.2,0.5,1.2,1.2 		C40.2,36.6,39.7,37.2,39.1,37.2z\"/> 	<path d=\"M12.2,35.6c0.6,0,0.9,0.3,1.2,0.8c0.5,0.9,1.3,1.3,2.3,1.1c1-0.2,1.6-1.1,1.5-2.1c-0.1-0.9-0.8-1.7-1.8-1.8 		c-0.9-0.1-1.8-0.3-2.5-0.8c-1.4-0.9-2.1-2.1-2-3.8c0.1-1.8,1-3.1,2.6-3.8c0.4-0.2,0.6-0.4,0.6-0.9c-0.1-0.5,0.2-1,0.7-1.2 		c0.4-0.2,0.8-0.2,1.2,0.1c0.4,0.3,0.5,0.7,0.5,1.2c0,0.4,0.1,0.7,0.5,0.8c1.1,0.4,1.9,1.2,2.4,2.3c0.3,0.6,0.1,1.2-0.4,1.5 		c-0.6,0.3-1.3,0.2-1.7-0.4c-0.1-0.1-0.1-0.2-0.2-0.3c-0.5-0.9-1.5-1.4-2.4-1.1c-0.9,0.3-1.5,1.2-1.4,2.1c0.1,1.1,0.9,1.8,2,1.8 		c2,0.1,3.5,1.2,4.1,3c0.7,2.2-0.4,4.6-2.6,5.4c-0.3,0.1-0.4,0.3-0.4,0.6c0,0.2,0,0.4,0,0.6c0,0.6-0.5,1-1.1,1.1 		c-0.6,0.1-1.1-0.3-1.2-0.9c-0.1-0.3-0.1-0.6,0-0.8c0-0.3-0.1-0.4-0.3-0.5c-1.2-0.4-2-1.1-2.6-2.2C10.6,36.5,11.1,35.6,12.2,35.6z\" 		/> </g> </svg>', '#671ab3', '', ''),
(5, 'mail', 'Mail Sent', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\">  <path id=\"email\" d=\"M47.2,11.3H35.6c-0.1-1-0.4-2.3-1-3.6c-1.8-3.7-5.8-6.1-9.7-5.9c-0.4,0-0.7,0.1-0.8,0.1 	c-2.7,0.4-5.2,1.8-6.9,3.8c-1.3,1.6-2,3.6-2.2,5.6H2.8c-0.6,0-1,0.4-1,1v2.9v29.2c0,0,0,0,0,0c0,0.1,0,0.2,0.1,0.3c0,0,0,0.1,0,0.1 	c0,0,0,0.1,0.1,0.1C2,45,2,45.1,2.1,45.2c0,0,0,0,0,0c0,0,0.1,0.1,0.1,0.1c0.1,0,0.1,0.1,0.2,0.1c0.1,0,0.2,0.1,0.4,0.1h44.4 	c0.1,0,0.3,0,0.4-0.1c0.1,0,0.1-0.1,0.2-0.1c0,0,0.1,0,0.1-0.1c0,0,0,0,0,0c0.1-0.1,0.1-0.1,0.2-0.2c0,0,0-0.1,0.1-0.1 	c0,0,0-0.1,0-0.1c0-0.1,0-0.2,0-0.2c0,0,0,0,0,0V15.2v-2.9C48.2,11.8,47.8,11.3,47.2,11.3z M19.2,28.6l5.2,3.8 	c0.4,0.3,0.8,0.3,1.2,0l5.2-3.9l14.1,14.9H5.1L19.2,28.6z M3.8,42V17.2l13.8,10.2L3.8,42z M32.5,27.4l13.8-10.2v24.7L32.5,27.4z 	 M15,13.3c0.1,1.2,0.4,2.4,1,3.4c2.3,4.5,6.5,6,7,6.1c0.1,0,0.2,0,0.3,0c0.4,0,0.8-0.3,1-0.7c0.2-0.5-0.1-1.1-0.6-1.3 	c-0.2-0.1-3.9-1.3-5.8-5.1c-1.4-2.8-1-6.5,1-8.9c1.3-1.7,3.4-2.8,5.6-3.1c0.1,0,0.3,0,0.6-0.1c3.1-0.1,6.4,1.9,7.9,4.8 	c1,2.1,0.9,4,0.8,4.6c-0.1,1-0.9,4.3-2.4,5.1c-0.5,0.3-0.9,0-1.1-0.1c-0.3-0.2-0.7-0.6-0.7-1.1v-4.6c0,0,0,0,0-0.1 	c0-0.1,0-0.2,0-0.3c0-2.4-1.9-4.3-4.3-4.3s-4.3,1.9-4.3,4.3s1.9,4.3,4.3,4.3c0.8,0,1.6-0.3,2.3-0.7l0,0.1l0,1.1 	c0,1.1,0.6,2.2,1.6,2.8c1,0.6,2.1,0.6,3.1,0.1c2.8-1.5,3.5-6.6,3.5-6.7c0,0,0-0.1,0-0.1h10.6v1.4L25,30.4L3.8,14.7v-1.4H15z 	 M25.2,14.6c-1.3,0-2.3-1-2.3-2.3s1-2.3,2.3-2.3s2.3,1,2.3,2.3S26.4,14.6,25.2,14.6z\"/> </svg>', '#f56565', '', ''),
(6, 'reservation', 'Reservation', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"booking\"> 	<path d=\"M10.7,1.5c9.5,0,19.1,0,28.6,0c0.1,0,0.2,0.1,0.3,0.1c4.1,0.5,7.4,3.4,8.5,7.3c0.1,0.5,0.2,1.1,0.4,1.6 		c0,0.7,0,1.4,0,2.1c-0.1,0.4-0.1,0.8-0.2,1.2c-1.1,4.7-5.1,7.8-9.9,7.9c-5.6,0-11.3,0-16.9,0c-0.2,0-0.4,0-0.5,0c0,1.5,0,2.9,0,4.4 		c1.5-0.4,2.9-0.2,4.1,0.8c1.6-1.3,3.7-1.5,5.5,0c1.2-0.8,1.8-1,2.5-1c2.5-0.1,4.4,1.7,4.4,4.2c0,2.4,0,4.9,0,7.3 		c0,0.5,0,1.1-0.1,1.6c-0.8,4.5-3.4,7.6-7.8,9c-0.7,0.2-1.5,0.3-2.2,0.5c-1.6,0-3.2,0-4.8,0c-0.1,0-0.2-0.1-0.4-0.1 		c-1.1-0.3-2.2-0.4-3.2-0.9c-4.2-2-6.4-5.4-6.5-10c-0.1-5.1,0-10.2,0-15.2c0-0.2,0-0.4,0-0.6c-0.4,0-0.7,0-1.1,0 		c-4.3-0.1-8.1-2.8-9.5-6.9c-0.2-0.7-0.3-1.4-0.5-2.1c0-0.7,0-1.4,0-2.1c0-0.1,0.1-0.2,0.1-0.3C2.3,6.1,4.6,3.3,8.6,2 		C9.3,1.7,10,1.6,10.7,1.5z M25,4.3c-4.4,0-8.8,0-13.3,0c-0.4,0-0.9,0-1.3,0.1c-3.1,0.5-5.6,2.9-6.1,6c-0.5,3.1,1,6.1,3.7,7.6 		c1.4,0.8,2.9,0.9,4.5,0.9c0.3,0,0.5-0.1,0.7-0.3c1.6-2.5,5.2-2.5,6.9,0c0.2,0.3,0.4,0.4,0.7,0.4c5.9,0,11.7,0,17.6,0 		c0.3,0,0.7,0,1-0.1c4.9-0.7,7.7-5.9,5.5-10.4c-1.3-2.7-3.6-4.1-6.6-4.1C33.9,4.2,29.5,4.3,25,4.3z M15.3,29.6 		C15.3,29.6,15.3,29.6,15.3,29.6c0,2.6,0,5.2,0,7.8c0,4.2,2.7,7.5,6.8,8.2c1.4,0.2,3,0.1,4.4,0.2c0.6,0,1.2-0.1,1.7-0.2 		c3.8-0.9,6.4-4.1,6.4-8.2c0-2.4,0-4.7,0-7.1c0-0.2,0-0.4,0-0.5c-0.1-0.7-0.7-1.1-1.4-1.1c-0.7,0-1.2,0.5-1.3,1.2 		c0,0.2,0,0.3-0.1,0.5c-0.1,0.6-0.7,1.1-1.3,1.1c-0.8,0-1.4-0.5-1.4-1.4c0-0.6-0.4-1-0.9-1.2c-0.9-0.3-1.7,0.3-1.9,1.4 		c-0.1,0.8-0.6,1.3-1.4,1.3c-0.7,0-1.3-0.6-1.4-1.3c-0.1-0.8-0.6-1.4-1.4-1.4c-0.8,0-1.4,0.7-1.4,1.4c0,0.8-0.7,1.4-1.5,1.3 		c-0.8,0-1.3-0.6-1.3-1.5c0-2.9,0-5.8,0-8.7c0-0.2,0-0.5-0.1-0.7c-0.2-0.7-0.9-1.2-1.7-1c-0.7,0.2-1,0.7-1,1.5 		C15.3,23.8,15.3,26.7,15.3,29.6z\"/> 	<path d=\"M25.5,11.5c0-2.4,1.9-4.3,4.3-4.3c2.3,0,4.3,1.9,4.3,4.3c0,2.4-1.9,4.3-4.3,4.3 		C27.5,15.8,25.5,13.9,25.5,11.5z M29.8,9.5c-1.1,0-2,0.9-2,2c0,1.1,0.9,1.9,1.9,2c1.1,0,2-0.9,2-2C31.8,10.4,30.9,9.5,29.8,9.5z\"/> 	<path d=\"M24.1,11.5c0,2.4-1.9,4.3-4.3,4.3c-2.4,0-4.3-2-4.3-4.4c0-2.3,2-4.2,4.3-4.2C22.2,7.2,24.1,9.2,24.1,11.5z 		 M19.8,9.5c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2c1.1,0,1.9-0.9,2-2C21.8,10.4,20.9,9.6,19.8,9.5z\"/> 	<path d=\"M10.4,15.8c-0.3,0-0.6,0-1,0c-0.8,0-1.3-0.5-1.3-1.3c0-2,0-4.1,0-6.1c0-0.7,0.4-1.2,1-1.2 		c0.8,0,1.5-0.1,2.3,0c1.6,0.2,2.6,1.8,2.1,3.4c0,0.2,0,0.4,0.1,0.5c0.7,0.9,0.8,1.9,0.3,3c-0.5,1.1-1.4,1.6-2.6,1.6 		C11.1,15.8,10.8,15.8,10.4,15.8C10.4,15.8,10.4,15.8,10.4,15.8z M10.5,13.5c0.4,0,0.7,0.1,1,0c0.2,0,0.4-0.3,0.4-0.5 		c0.1-0.3-0.1-0.5-0.4-0.5c-0.3,0-0.7,0-1,0C10.5,12.8,10.5,13.1,10.5,13.5z M10.5,9.5c0,0.2,0,0.4,0,0.6c0.2,0,0.4,0,0.6,0 		c0.1,0,0.2-0.2,0.3-0.3c-0.1-0.1-0.2-0.2-0.3-0.3C10.9,9.5,10.7,9.5,10.5,9.5z\"/> 	<path d=\"M38.2,8.8c0.5-0.4,0.9-0.8,1.3-1.2C40.1,7,40.8,7,41.3,7.5c0.5,0.5,0.4,1.2-0.2,1.7c-0.7,0.7-1.4,1.3-2,1.8 		c0.7,0.8,1.5,1.6,2.2,2.4c0.2,0.2,0.4,0.5,0.5,0.8c0.1,0.5-0.1,1-0.6,1.2c-0.4,0.2-0.9,0.2-1.4-0.2c-0.5-0.5-1-1-1.6-1.6 		c0,0.3,0,0.6,0,0.8c0,0.6-0.5,1.1-1.1,1.1c-0.6,0-1.1-0.5-1.1-1.1c0-2.1,0-4.3,0-6.4c0-0.6,0.5-1.1,1.2-1.1c0.6,0,1.1,0.5,1.1,1.1 		C38.2,8.3,38.2,8.5,38.2,8.8z\"/> </g> </svg>', '#129f30', '', NULL),
(7, 'reservationCancel', 'Reservation Cancel', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\" >  <g id=\"reservationCancel\"> 	<path d=\"M46.7,19.6c0-0.1,0-0.2-0.1-0.3V9.8c0-3-2.4-5.4-5.4-5.4h-5.3V1.9c0-0.6-0.5-1.1-1.1-1.1 		c-0.6,0-1.1,0.5-1.1,1.1v2.5H16.5V1.9c0-0.6-0.5-1.1-1.1-1.1s-1.1,0.5-1.1,1.1v2.5H8.7c-3,0-5.4,2.4-5.4,5.4v33.5 		c0,3,2.4,5.4,5.4,5.4h32.4c3,0,5.4-2.4,5.4-5.4V19.9C46.7,19.8,46.7,19.7,46.7,19.6z M8.7,6.5h5.5v2.7c-1.3,0.5-2.2,1.7-2.2,3.1 		c0,1.8,1.5,3.3,3.3,3.3s3.3-1.5,3.3-3.3c0-1.4-0.9-2.6-2.2-3.1V6.5h17.2v2.7c-1.3,0.5-2.2,1.7-2.2,3.1c0,1.8,1.5,3.3,3.3,3.3 		c1.8,0,3.3-1.5,3.3-3.3c0-1.4-0.9-2.6-2.2-3.1V6.5h5.3c1.8,0,3.2,1.4,3.2,3.2v8.7H5.5V9.8C5.5,8,7,6.5,8.7,6.5z M15.4,11.2 		C15.4,11.2,15.4,11.2,15.4,11.2C15.4,11.2,15.4,11.2,15.4,11.2c0.6,0,1.1,0.5,1.1,1.1c0,0.6-0.5,1.1-1.1,1.1 		c-0.6,0-1.1-0.5-1.1-1.1C14.3,11.7,14.8,11.2,15.4,11.2z M34.8,11.2C34.8,11.2,34.8,11.2,34.8,11.2C34.8,11.2,34.8,11.2,34.8,11.2 		c0.6,0,1.1,0.5,1.1,1.1c0,0.6-0.5,1.1-1.1,1.1c-0.6,0-1.1-0.5-1.1-1.1C33.8,11.7,34.2,11.2,34.8,11.2z M41.2,46.5H8.7 		c-1.8,0-3.2-1.4-3.2-3.2V20.7h38.9v22.6C44.4,45,43,46.5,41.2,46.5z\"/> 	<path d=\"M31.1,25.7c-0.4-0.4-1.1-0.4-1.6,0L25,30.5l-4.5-4.7c-0.4-0.4-1.1-0.5-1.6,0 		c-0.4,0.4-0.5,1.1,0,1.6l4.6,4.8l-4.6,5c-0.4,0.4-0.4,1.2,0.1,1.6c0.2,0.2,0.5,0.3,0.8,0.3c0.3,0,0.6-0.1,0.8-0.4l4.5-4.9l4.5,4.9 		c0.2,0.2,0.5,0.4,0.8,0.4c0.3,0,0.5-0.1,0.8-0.3c0.4-0.4,0.5-1.1,0.1-1.6l-4.6-5l4.6-4.8C31.5,26.8,31.5,26.1,31.1,25.7z\"/> </g> </svg>', '', '', NULL),
(8, 'guestInvoice', 'Guest Invoice Download', '', '#141727', '', NULL),
(9, 'logout', 'Logout', '', '#721c24', '', 'border: 1px dashed #d7a9ae; background: #f8d7da; color: #721c24;'),
(10, 'domain', 'Domain', NULL, NULL, NULL, NULL),
(11, 'info', 'Info', NULL, NULL, NULL, NULL),
(12, 'image', 'Image', NULL, NULL, NULL, NULL),
(13, 'roomMove', 'Room Move', NULL, NULL, NULL, NULL),
(14, 'reservationDelete', 'Reservation Delete', NULL, NULL, NULL, NULL),
(15, 'paymentLink', 'Payment link', NULL, '#990076', NULL, NULL),
(16, 'password', 'Password', NULL, NULL, NULL, NULL),
(17, 'posOrder', 'Pos Order', NULL, NULL, NULL, NULL),
(18, 'posSettlment', 'Pos settlment', NULL, NULL, NULL, NULL),
(19, 'newHotel', 'New Hotel', NULL, NULL, NULL, NULL),
(20, 'inventory', 'Inventory', NULL, NULL, NULL, NULL),
(21, 'paymentFailed', 'Payment Failed', NULL, NULL, NULL, NULL),
(22, 'otp', 'OTP', NULL, NULL, NULL, NULL),
(23, 'houseKeeper', 'House Keeper', NULL, NULL, NULL, NULL),
(24, 'roomAdd', 'Room add', NULL, NULL, NULL, NULL),
(25, 'posPayment', 'POS Payment', NULL, NULL, NULL, NULL),
(26, 'discount', 'Discount', NULL, NULL, NULL, NULL),
(27, 'addCharge', 'Add Charge', NULL, NULL, NULL, NULL),
(28, 'user', 'User', NULL, NULL, NULL, NULL),
(29, 'extendedStay', 'Stay extended', NULL, NULL, NULL, NULL),
(30, 'noShow', 'No Show', NULL, NULL, NULL, NULL),
(31, 'blockRoom', 'Block Room', NULL, NULL, NULL, NULL),
(32, 'permission', 'Permission', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_addon_charge`
--

CREATE TABLE `sys_addon_charge` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_addon_charge`
--

INSERT INTO `sys_addon_charge` (`id`, `name`) VALUES
(1, 'Addons'),
(2, 'Extra Components'),
(3, 'Extra Fees'),
(4, 'Extra Taxes'),
(5, 'Retention Charge');

-- --------------------------------------------------------

--
-- Table structure for table `sys_amenities`
--

CREATE TABLE `sys_amenities` (
  `id` int(11) NOT NULL,
  `catId` int(11) NOT NULL DEFAULT 0,
  `title` varchar(250) NOT NULL,
  `img` text NOT NULL DEFAULT '',
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `addBy` varchar(11) DEFAULT NULL,
  `add_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_amenities`
--

INSERT INTO `sys_amenities` (`id`, `catId`, `title`, `img`, `deleteRec`, `status`, `addBy`, `add_on`) VALUES
(1, 1, 'Comfortable beds', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0V0z\" fill=\"none\"/><path d=\"M7 13c1.65 0 3-1.35 3-3S8.65 7 7 7s-3 1.35-3 3 1.35 3 3 3zm12-6h-8v7H3V7H1v10h22v-6c0-2.21-1.79-4-4-4z\"/></svg>', 1, 1, '', '2023-12-17 21:07:41'),
(2, 1, 'Turndown service', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 14.1\" style=\"enable-background:new 0 0 24 14.1;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_5_\">\r\n	<path id=\"XMLID_32_\" d=\"M17.4,8h-15V6.5l2.5,0v0.9c0,0.2,0.2,0.3,0.3,0.3c0.2,0,0.3-0.2,0.3-0.3V6.2c0,0,0,0,0,0c0,0,0,0,0,0\r\n		c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0\r\n		c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0-0.1,0c0,0,0,0,0,0l0,0c0,0,0,0,0,0c0,0,0,0,0,0l-2.8,0V3.5C2.4,3.2,2.1,3,1.9,3H0.7\r\n		C0.4,3,0.2,3.2,0.2,3.5v9.9c0,0.2,0.2,0.3,0.3,0.3s0.3-0.2,0.3-0.3V3.6h0.9v7.9c0,0.2,0.2,0.3,0.3,0.3h15v1.5\r\n		c0,0.2,0.2,0.3,0.3,0.3s0.3-0.2,0.3-0.3v-1.9v0v-1.1V8.5V8.3C17.7,8.1,17.5,8,17.4,8z\"/>\r\n	<path id=\"XMLID_34_\" d=\"M23.8,7.6L22.3,4c-0.3-0.6-0.9-1-1.5-1c-0.2,0-0.4,0-0.6,0.1c-0.8,0.3-1.2,1.1-1,1.9L17,6.9\r\n		c-0.1,0.1-0.2,0.3,0,0.5c0.1,0.1,0.2,0.1,0.3,0.1c0.1,0,0.2,0,0.2-0.1l2.3-2c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0\r\n		c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0\r\n		c-0.2-0.5,0-1.1,0.5-1.3c0.1,0,0.2-0.1,0.4-0.1c0.4,0,0.8,0.2,0.9,0.6L23,7.5l-0.3,0.1c0,0,0,0,0,0c0,0,0,0,0,0\r\n		c-0.1,0-0.1,0.1-0.2,0.2c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0,0,0,0,0l0,5.4c0,0.2,0.2,0.3,0.3,0.3c0.2,0,0.3-0.2,0.3-0.3l0-5.2L23.6,8\r\n		c0.1,0,0.1-0.1,0.2-0.2C23.8,7.8,23.8,7.7,23.8,7.6z\"/>\r\n	<path id=\"XMLID_35_\" d=\"M22,8.4C22,8.4,22,8.4,22,8.4C22,8.4,22,8.3,22,8.4C22,8.3,22,8.3,22,8.4c0-0.1,0-0.1,0-0.1c0,0,0,0,0,0\r\n		c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0-0.1,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0-0.1,0\r\n		c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0-0.1,0c0,0,0,0,0,0l-0.4,0.1l-0.9-2.1C20.3,6,20.1,5.9,19.9,6c-0.2,0.1-0.3,0.3-0.2,0.4l1,2.4\r\n		C20.8,9,20.9,9.1,21,9.1c0,0,0.1,0,0.1,0l0.1,0l-0.9,4.3c0,0.2,0.1,0.4,0.3,0.4c0,0,0,0,0.1,0c0.2,0,0.3-0.1,0.3-0.3L22,8.4\r\n		C22,8.5,22,8.5,22,8.4C22,8.5,22,8.5,22,8.4C22,8.4,22,8.4,22,8.4z\"/>\r\n	<path id=\"XMLID_38_\" d=\"M19.7,2.8c0.7,0,1.3-0.6,1.3-1.3c0-0.7-0.6-1.3-1.3-1.3c-0.7,0-1.3,0.6-1.3,1.3C18.4,2.2,19,2.8,19.7,2.8z\r\n		 M19.7,0.9c0.3,0,0.6,0.3,0.6,0.6c0,0.3-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6C19.1,1.2,19.3,0.9,19.7,0.9z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:07:41'),
(3, 1, 'In-room safe', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 17\" style=\"enable-background:new 0 0 24 17;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_49_\" d=\"M12.5,14.9c0,0.3,0,0.5,0,0.7c0,0,0,0.1,0.1,0.1c0.2,0.3,0.2,0.6-0.1,0.9c-0.2,0.2-0.6,0.2-0.9,0\r\n		c-0.2-0.2-0.3-0.6-0.1-0.9c0-0.1,0.1-0.1,0.1-0.2c0-0.2,0-0.4,0-0.6c-0.4,0-0.8,0.1-1.1,0.1c-0.3,0.1-0.6,0.1-1,0.2\r\n		c-0.3,0.1-0.4,0.3-0.2,0.5c0.2,0.3,0.1,0.6-0.1,0.8c-0.2,0.2-0.6,0.2-0.8,0c-0.2-0.2-0.3-0.6-0.1-0.8c0.1-0.1,0.1-0.2,0.1-0.3\r\n		c0-0.5,0.2-0.8,0.7-1c0.8-0.3,1.5-0.4,2.3-0.4c0.2,0,0.2-0.1,0.2-0.2c0-0.3,0-0.6,0-0.9c-0.1,0-0.2,0-0.3,0c0-0.3,0-0.7,0-1\r\n		c-0.5-0.1-0.9-0.1-1.4-0.2c-0.3-0.1-0.7-0.2-1-0.3c-0.2-0.1-0.4-0.3-0.6-0.5c0,0-0.1-0.1-0.1-0.1c-0.7,0-1.2-0.6-1.2-1.3\r\n		c0-0.2,0-0.5,0-0.8c-0.1,0-0.2,0-0.3,0c-0.2,0-0.3-0.1-0.4-0.4c0-0.1,0-0.3,0-0.4c0-0.2,0.1-0.4,0.4-0.4c0.4,0,0.8,0,1.2,0\r\n		c0.2,0,0.4,0.1,0.4,0.4c0,0.1,0,0.2,0,0.3c0,0.2-0.1,0.4-0.4,0.4c-0.1,0-0.2,0-0.2,0c0,0.3,0,0.7,0,1c0,0.3,0.4,0.5,0.6,0.5\r\n		c0,0,0.1,0,0.1-0.1C8.7,10,9,9.9,9.2,9.9c0.9,0,1.7,0,2.6,0c1,0,2,0,3.1,0c0.3,0,0.5,0.1,0.7,0.3c0,0,0.1,0,0.1,0.1\r\n		c0.3,0,0.6-0.2,0.7-0.6c0-0.3,0-0.6,0-0.9c-0.1,0-0.2,0-0.3,0c-0.2,0-0.4-0.1-0.4-0.4c0-0.1,0-0.2,0-0.4c0-0.2,0.1-0.4,0.4-0.4\r\n		c0.4,0,0.8,0,1.2,0c0.2,0,0.3,0.1,0.4,0.4c0,0.1,0,0.3,0,0.4c0,0.2-0.1,0.3-0.3,0.4c-0.1,0-0.2,0-0.3,0c0,0.3,0,0.5,0,0.8\r\n		c0,0.8-0.5,1.3-1.2,1.3c0,0-0.1,0-0.1,0.1c-0.2,0.3-0.4,0.4-0.7,0.6c-0.5,0.2-1,0.3-1.5,0.4c-0.2,0-0.5,0-0.7,0.1c0,0.3,0,0.7,0,1\r\n		c-0.1,0-0.1,0-0.1,0c-0.1,0-0.1,0-0.1,0.1c0,0.3,0,0.5,0,0.8c0,0.1,0,0.2,0.2,0.2c0.8,0,1.6,0.2,2.3,0.4c0.3,0.1,0.6,0.3,0.7,0.7\r\n		c0,0.3,0.1,0.5,0.2,0.8c0.1,0.3,0,0.6-0.3,0.7c-0.3,0.2-0.6,0.1-0.8-0.1c-0.2-0.2-0.2-0.6,0-0.8c0.2-0.2,0.1-0.4-0.2-0.5\r\n		c-0.3-0.1-0.7-0.2-1-0.2C13.3,15,12.9,14.9,12.5,14.9z\"/>\r\n	<path id=\"XMLID_48_\" d=\"M8.8,5.6c0-0.3,0-0.6,0.1-0.8C8.9,4,8.9,3.3,9,2.5c0-0.1,0-0.3,0.1-0.4c0.2-0.7,0.6-1,1.3-1\r\n		c1.1,0,2.2,0,3.3,0c0.8,0,1.3,0.4,1.4,1.3c0.1,0.6,0.1,1.1,0.2,1.7c0,0.5,0.1,1,0.1,1.5c0,0,0,0.1,0,0.1C13.2,5.6,11,5.6,8.8,5.6z\"\r\n		/>\r\n	<path id=\"XMLID_45_\" d=\"M2.7,1.5c0-0.1,0-0.3,0-0.4c0-0.4,0.3-0.7,0.7-0.7c0.5,0,0.9,0,1.4,0c0.4,0,0.7,0.3,0.7,0.7\r\n		c0,0.1,0,0.2,0,0.4c0.1,0,0.1,0,0.2,0c0.3,0,0.5,0,0.8,0c0.4,0,0.7,0.3,0.7,0.7c0,0.1,0,0.1,0,0.2c0,0.8,0,1.7,0,2.5\r\n		c0,0.5-0.3,0.8-0.8,0.8c-1.5,0-2.9,0-4.4,0c-0.5,0-0.8-0.3-0.8-0.8c0-0.8,0-1.7,0-2.5c0-0.5,0.3-0.8,0.8-0.8\r\n		C2.2,1.5,2.4,1.5,2.7,1.5z M4.9,1.5c0-0.1,0-0.3,0-0.4c0-0.1-0.1-0.1-0.2-0.1c-0.4,0-0.9,0-1.3,0C3.4,1,3.3,1,3.3,1.1\r\n		c0,0.1,0,0.3,0,0.4C3.8,1.5,4.4,1.5,4.9,1.5z\"/>\r\n	<path id=\"XMLID_44_\" d=\"M12.1,6c3.7,0,7.4,0,11.1,0c0.4,0,0.6,0.2,0.6,0.5c0,0.3-0.2,0.5-0.5,0.5c-0.1,0-0.1,0-0.2,0\r\n		c-7.4,0-14.8,0-22.2,0c-0.1,0-0.2,0-0.3,0C0.5,7,0.3,6.8,0.3,6.5c0-0.2,0.2-0.4,0.5-0.5C0.9,6,0.9,6,1,6C4.7,6,8.4,6,12.1,6z\"/>\r\n	<path id=\"XMLID_40_\" d=\"M3.3,16.7c-0.5,0-0.9,0-1.4,0c0-3.1,0-6.2,0-9.3c0.5,0,0.9,0,1.4,0C3.3,10.6,3.3,13.7,3.3,16.7z\"/>\r\n	<path id=\"XMLID_39_\" d=\"M20.9,7.5c0.5,0,0.9,0,1.4,0c0,3.1,0,6.2,0,9.3c-0.5,0-0.9,0-1.4,0C20.9,13.7,20.9,10.6,20.9,7.5z\"/>\r\n	<path id=\"XMLID_38_\" d=\"M15.4,7.5c-0.1,0.3-0.3,0.6-0.5,0.8c-0.3,0.2-0.6,0.3-1,0.3c-1.2,0-2.4,0-3.6,0c-0.4,0-0.8-0.1-1.1-0.4\r\n		C8.9,8,8.8,7.8,8.7,7.5C11,7.5,13.2,7.5,15.4,7.5z\"/>\r\n	<path id=\"XMLID_37_\" d=\"M13.1,9.5c-0.7,0-1.4,0-2.1,0c0-0.2,0-0.3,0-0.5c0.7,0,1.4,0,2.1,0C13.1,9.1,13.1,9.3,13.1,9.5z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:08:54'),
(4, 2, 'Free Wi-Fi', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M1 9l2 2c4.97-4.97 13.03-4.97 18 0l2-2C16.93 2.93 7.08 2.93 1 9zm8 8l3 3 3-3c-1.65-1.66-4.34-1.66-6 0zm-4-4l2 2c2.76-2.76 7.24-2.76 10 0l2-2C15.14 9.14 8.87 9.14 5 13z\"/></svg>', 1, 1, '', '2023-12-17 21:10:15'),
(5, 2, 'Computers and printers', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 22.3 24\" style=\"enable-background:new 0 0 22.3 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_39_\" d=\"M16.2,18.6c0.1,0.1,0.2,0.3,0.2,0.5c-0.1,0.3-0.4,0.4-0.7,0.4c-0.2,0-0.5,0-0.7,0c-2.8,0-5.6,0-8.4,0\r\n		c-0.1,0-0.3,0-0.4,0c-0.3-0.1-0.4-0.3-0.4-0.5c0-0.2,0.2-0.4,0.4-0.5c0.1,0,0.3,0,0.4,0c2.5,0,4.9,0,7.4,0c0.3,0,0.7,0,1,0\r\n		c0.3,0,0.7-0.1,1,0C16.1,18.5,16.2,18.5,16.2,18.6z\"/>\r\n	<path id=\"XMLID_38_\" d=\"M11.1,21.5c-1.5,0-3.1,0-4.6,0c-0.1,0-0.2,0-0.4,0c-0.3-0.1-0.4-0.3-0.4-0.5c0-0.3,0.2-0.5,0.5-0.5\r\n		c0.1,0,0.2,0,0.4,0c2.8,0,5.7,0,8.5,0c0.3,0,0.6,0,1,0c0.3,0,0.4,0.2,0.4,0.5c0,0.3-0.2,0.5-0.4,0.6c-0.1,0-0.2,0-0.3,0\r\n		C14.2,21.5,12.6,21.5,11.1,21.5z\"/>\r\n	<path id=\"XMLID_37_\" d=\"M8.7,16.3c0.7,0,1.5,0,2.2,0c0.1,0,0.3,0,0.4,0.1c0.2,0.1,0.3,0.3,0.3,0.5c0,0.2-0.1,0.4-0.4,0.5\r\n		c-0.1,0-0.3,0-0.4,0c-1.5,0-2.9,0-4.4,0c-0.1,0-0.2,0-0.3,0c-0.3,0-0.5-0.2-0.5-0.5c0-0.3,0.2-0.5,0.4-0.5c0.1,0,0.2,0,0.3,0\r\n		C7.3,16.3,8,16.3,8.7,16.3z\"/>\r\n	<path id=\"XMLID_24_\" d=\"M21.8,9.4c0-1.5-1.2-2.7-2.7-2.7c-0.2,0-0.4,0-0.5,0V6.3c0-1.7,0-3.4,0-5c0-0.5-0.2-0.7-0.7-0.7\r\n		c-3.2,0-6.5,0-9.7,0c-0.3,0-0.5,0.1-0.7,0.3C6.3,1.9,5.2,3.1,4.1,4.2c-0.3,0.3-0.4,0.6-0.4,1c0,0.5,0,1.1,0,1.6c-0.2,0-0.4,0-0.5,0\r\n		c-1.6,0-2.8,1.2-2.8,2.8c0,2.4,0,4.8,0,7.2c0,1.6,1.2,2.8,2.8,2.8c0.2,0,0.3,0,0.5,0v0.4c0,1.1,0,2.2,0,3.3c0,0.4,0.2,0.6,0.6,0.6\r\n		c0.1,0,0.2,0,0.3,0h13.1c0.1,0,0.2,0,0.4,0c0.3,0,0.5-0.2,0.5-0.5c0-1,0-2,0-3c0-0.6,0-0.6,0.6-0.7c0.5-0.1,1.5-0.5,1.7-0.7\r\n		c0.6-0.5,0.9-1.2,0.9-2C21.8,14.3,21.8,11.9,21.8,9.4z M18,9.9c0.5,0,0.9,0.4,0.9,0.9c0,0.5-0.4,0.9-0.9,0.9\r\n		c-0.5,0-0.9-0.4-0.9-0.9C17.1,10.3,17.5,9.9,18,9.9z M4.8,5.3c0.1,0,0.2,0,0.4,0c0.9,0,1.7,0,2.6,0c0.6,0,0.7-0.2,0.7-0.7\r\n		c0-0.9,0-1.7,0-2.6V1.6h9v5.1H4.8V5.3z M15.9,10.7c0,0.5-0.4,0.9-0.9,0.9c-0.5,0-0.9-0.4-0.9-0.9c0-0.5,0.4-0.8,0.9-0.8\r\n		C15.5,9.9,15.9,10.2,15.9,10.7z M17.5,20.3c0,1.2,0,2.4,0,2.4c0,0-12.7,0-12.7,0v-7.5h12.7c0,0.9,0,1.8,0,2.6\r\n		C17.5,18,17.5,19.1,17.5,20.3z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:10:15'),
(6, 2, 'In-room work desk', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 22.7\" style=\"enable-background:new 0 0 24 22.7;\" xml:space=\"preserve\">\r\n<g>\r\n	<path d=\"M20.9,12.6c-3.1,0-6.1,0-9.2,0c0,0.2,0,0.4,0,0.6c0,2.8,0,5.6,0,8.5c0,0.5-0.2,0.6-0.6,0.6c-3,0-6.1,0-9.1,0\r\n		c-0.5,0-0.6-0.1-0.6-0.6c0-2.7,0-5.5,0-8.2c0-0.8,0-0.8-0.8-0.8c-0.1,0-0.2,0-0.4,0c0-0.4,0-0.7,0-1.1c0-0.3,0-0.7,0-1.1\r\n		c7.9,0,15.7,0,23.6,0c0,0.7,0,1.4,0,2.2c-0.4,0-0.8,0-1.3,0.1c0,3.2,0,6.4,0,9.6c-0.5,0-0.9,0-1.2,0c-0.4,0-0.3-0.3-0.3-0.5\r\n		c0-1.4,0-2.9,0-4.3C20.9,15.9,20.9,14.3,20.9,12.6z M6.8,20.4c1,0,2,0,2.9,0c0.5,0,0.7-0.2,0.7-0.7c0-0.5,0-0.9,0-1.4\r\n		c0-0.2-0.2-0.6-0.3-0.6c-0.5,0-1.2-0.1-1.5,0.1c-0.7,0.6-1.5,0.7-2.3,0.6c-0.3,0-0.7-0.1-0.9-0.3c-0.5-0.4-0.9-0.5-1.5-0.5\r\n		c-0.5,0-0.7,0.2-0.7,0.7c0,0.4,0,0.8,0,1.3c0,0.6,0.2,0.7,0.7,0.7C4.9,20.4,5.8,20.4,6.8,20.4z M6.8,16.4c1,0,1.9,0,2.9,0\r\n		c0.4,0,0.7-0.2,0.7-0.6c0-0.5,0-1,0-1.6c0-0.3-0.2-0.5-0.6-0.5c-0.6,0-1.1,0.1-1.6,0.5c-0.6,0.5-2.2,0.5-2.8,0\r\n		c-0.5-0.4-1-0.6-1.6-0.5c-0.4,0-0.6,0.2-0.6,0.6c0,0.5,0,0.9,0,1.4c0,0.6,0.2,0.7,0.7,0.7C4.9,16.5,5.9,16.4,6.8,16.4z\"/>\r\n	<path d=\"M14.9,9.7c0.5-0.4,0.9-0.8,0.7-1.6c-0.7,0-1.5,0-2.3,0c-1.3,0-1.3,0-1.3-1.3c0-1.6,0-3.2,0-4.8c0-0.7,0.2-0.9,0.9-0.9\r\n		c2.5,0,5,0,7.5,0c0.7,0,0.9,0.2,0.9,0.9c0,1.7,0,3.5,0,5.2c0,0.7-0.2,0.8-0.9,0.9c-0.9,0-1.8,0-2.6,0c-0.1,0.7-0.1,0.7,0.7,1.6\r\n		C17.2,9.7,16.1,9.7,14.9,9.7z M16.6,6.7c1.2,0,2.3,0,3.5,0c0.4,0,0.5-0.1,0.5-0.5c0-1.3,0-2.6,0-4c0-0.3-0.1-0.5-0.5-0.5\r\n		c-2.4,0-4.8,0-7.2,0c-0.4,0-0.5,0.1-0.5,0.5c0,1.3,0,2.6,0,3.9c0,0.4,0.1,0.5,0.5,0.5C14.3,6.7,15.4,6.7,16.6,6.7z\"/>\r\n	<path d=\"M7.2,0.2c0.1,0.2,0.3,0.3,0.4,0.5c0.2,0.5,0.5,0.7,1,0.8C9.2,1.5,9.6,2,10,2.5c0.2,0.3,0.2,0.5-0.2,0.7\r\n		C8.8,3.7,7.7,4.2,6.6,4.7C6.3,4.9,6.1,4.8,6,4.4C5.8,3.8,5.8,3.1,6.1,2.6c0.2-0.3,0.2-0.6,0-0.9C5.7,0.9,5.7,0.9,6.5,0.5\r\n		C6.7,0.4,6.9,0.3,7.2,0.2z\"/>\r\n	<path d=\"M5.5,9.6c-0.6,0-1.1,0-1.7,0c-0.5,0-0.7-0.3-0.4-0.7C3.6,8.7,3.8,8.5,4,8.4c1-0.5,2.1-0.5,3.1,0c0.2,0.1,0.3,0.2,0.4,0.4\r\n		C7.7,9,7.7,9.2,7.8,9.5C7.6,9.5,7.4,9.6,7.2,9.6C6.6,9.7,6.1,9.6,5.5,9.6C5.5,9.6,5.5,9.6,5.5,9.6z\"/>\r\n	<path d=\"M3,4.6C2.8,4.4,2.7,4.2,2.5,4C3,3.5,3.5,3,4,2.5c0.2-0.2,0.3-0.4,0.4-0.6c0.1-0.4,0.4-0.6,0.8-0.6c0.4,0,0.6,0.3,0.6,0.7\r\n		c0,0.4-0.2,0.6-0.6,0.8C5,2.7,4.8,2.8,4.6,3C4.1,3.5,3.5,4.1,3,4.6z\"/>\r\n	<path d=\"M2.3,6C2.6,5.8,2.8,5.7,3,5.5c0.6,0.6,1.3,1.3,1.9,2C4.5,7.7,4.1,7.8,3.8,7.3C3.4,6.8,2.9,6.4,2.3,6z\"/>\r\n	<path d=\"M1.9,4.4C2.4,4.4,2.7,4.7,2.6,5c0,0.4-0.2,0.6-0.6,0.6C1.6,5.6,1.4,5.4,1.4,5C1.5,4.7,1.7,4.5,1.9,4.4z\"/>\r\n	<path d=\"M6.3,19.4c0.4,0,0.7,0,1.1,0c0,0,0,0.1,0,0.1c-0.4,0-0.7,0-1.1,0C6.3,19.5,6.3,19.4,6.3,19.4z\"/>\r\n	<path d=\"M7.4,15.6c-0.4,0-0.8,0-1.1,0c0,0,0-0.1,0-0.1c0.4,0,0.7,0,1.1,0C7.4,15.5,7.4,15.6,7.4,15.6z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:10:58'),
(7, 2, 'Phone with voicemail', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 24\" style=\"enable-background:new 0 0 24 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_31_\" d=\"M15.8,17.7c2,1.1,3.9,2.1,5.8,3.2c-0.4,0.8-1,1.5-1.8,1.9c-1.1,0.7-2.2,0.9-3.5,0.8c-2.1-0.1-4-0.9-5.7-2\r\n		c-2.1-1.3-4-3-5.7-4.8c-1.3-1.4-2.4-2.9-3.3-4.7c-0.5-1.1-1-2.2-1.2-3.3C0.2,7.4,0.3,5.9,1,4.5c0.5-0.9,1.3-1.8,2.1-2.1\r\n		c0.2,0.3,0.4,0.7,0.5,1C4.5,4.9,5.4,6.5,6.2,8c0.1,0.1,0.1,0.2,0,0.3C5.9,8.6,5.7,8.8,5.5,9.1c-0.6,0.6-0.7,1.3-0.4,2\r\n		c0.5,1,1.1,1.9,1.8,2.7c1.4,1.6,2.9,3.1,4.7,4.3c0.4,0.3,0.9,0.5,1.4,0.8c0.7,0.3,1.4,0.2,2-0.4C15.2,18.3,15.5,18,15.8,17.7z\"/>\r\n	<path id=\"XMLID_28_\" d=\"M11.6,14.2c0.3-0.5,0.6-1,0.7-1.6c0-0.2,0.1-0.4,0.1-0.6c0-0.1-0.1-0.3-0.2-0.4c-1-1-1.6-2.2-1.8-3.6\r\n		c-0.3-2,0.2-3.7,1.4-5.3c1-1.3,2.3-2,3.9-2.3c3.3-0.7,6.7,1.4,7.6,4.7c1.1,3.6-1.1,7.5-4.8,8.4c-1.4,0.3-2.8,0.2-4.2-0.4\r\n		c-0.2-0.1-0.4-0.1-0.6,0.1C13.1,13.7,12.4,14,11.6,14.2z M15.7,8.3c0-0.1,0.1-0.1,0.1-0.2c0.4-0.5,0.5-1.1,0.4-1.7\r\n		c-0.2-1.2-1.4-2-2.6-1.8c-1,0.2-1.8,1-1.9,2c-0.2,1.3,0.8,2.5,2.1,2.6c2.2,0,4.4,0,6.5,0c0.1,0,0.1,0,0.2,0\r\n		c1.2-0.2,2.1-1.4,1.9-2.6c-0.2-1.3-1.4-2.2-2.6-2c-1.7,0.3-2.5,2.2-1.5,3.6c0,0,0.1,0.1,0.1,0.2C17.4,8.3,16.6,8.3,15.7,8.3z\"/>\r\n	<path id=\"XMLID_27_\" d=\"M16.4,17.1c0.1-0.1,0.2-0.2,0.3-0.3c0.3-0.3,0.7-0.4,1.1-0.1c1.3,0.7,2.5,1.4,3.8,2.2\r\n		c0.5,0.3,0.6,0.7,0.4,1.3C20.1,19.1,18.3,18.1,16.4,17.1z\"/>\r\n	<path id=\"XMLID_26_\" d=\"M3.9,2.1c0.6-0.2,1-0.1,1.3,0.5c0.7,1.2,1.4,2.4,2.1,3.6c0.3,0.6,0.3,1-0.4,1.5C5.9,5.8,4.9,3.9,3.9,2.1z\"\r\n		/>\r\n	<path id=\"XMLID_25_\" d=\"M21.6,6.8c0,0.8-0.7,1.5-1.5,1.5c-0.8,0-1.4-0.7-1.4-1.5c0-0.8,0.7-1.5,1.5-1.5C21,5.3,21.6,6,21.6,6.8z\"/>\r\n	<path id=\"XMLID_24_\" d=\"M15.3,6.8c0,0.8-0.7,1.5-1.5,1.5c-0.8,0-1.5-0.7-1.4-1.5c0-0.8,0.7-1.4,1.5-1.4C14.7,5.3,15.3,6,15.3,6.8z\"\r\n		/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:10:58'),
(8, 3, 'Room service', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\" ><path d=\"M0 0h24v24H0V0z\" fill=\"none\"/><path d=\"M2 17h20v2H2zm11.84-9.21c.1-.24.16-.51.16-.79 0-1.1-.9-2-2-2s-2 .9-2 2c0 .28.06.55.16.79C6.25 8.6 3.27 11.93 3 16h18c-.27-4.07-3.25-7.4-7.16-8.21z\"/></svg>', 1, 1, '', '2023-12-17 21:10:58'),
(9, 3, 'Bar/lounge', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 17.3\" style=\"enable-background:new 0 0 24 17.3;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_137_\" d=\"M2.1,11.8c-1.3-0.3-1.9-1-1.8-2.1c0.1-1.1,1-1.6,2.6-1.6c0.7,0,1.2,0.3,1.3,0.8c0.1,0.5,0,1.1,0,1.5\r\n		c0.6-0.1,1.2-0.2,1.8-0.2c1.9,0,3.8,0,5.6,0c0.6,0,1.1,0,1.6,0.6c0-0.5,0-0.9,0-1.3c0-0.9,0.5-1.3,1.4-1.3c0.3,0,0.7,0,1,0\r\n		c0.9,0.1,1.6,0.9,1.6,1.7c0,0.8-0.5,1.5-1.4,1.8c-0.1,0-0.2,0.1-0.4,0.1c0,1,0,2,0,3.1c0,1-0.2,1.1-1.1,1.2c-0.2,0-0.3,0-0.5,0\r\n		c-0.2,0.4,0.2,1.2-0.7,1.2c-0.8-0.1-0.5-0.7-0.6-1.1c-2.5,0-5,0-7.5,0c-0.2,0.4,0.2,1.2-0.7,1.1c-0.8,0-0.5-0.7-0.6-1.2\r\n		c-0.3,0-0.6,0-0.9,0c-0.6,0-0.8-0.2-0.8-0.8C2.1,14,2.1,12.9,2.1,11.8z\"/>\r\n	<path id=\"XMLID_126_\" d=\"M4.6,9.9c-0.3-1.8-0.5-2-2-2.1c0-0.2,0-0.4,0-0.5c0-1.4,0-2.8,0-4.3c0-1.5,0.9-2.4,2.4-2.4\r\n		c2.5,0,5,0,7.5,0C14.1,0.5,15,1.4,15,3c0,1.6,0,3.1,0,4.6c-0.6,0.3-1.3,0.4-1.7,0.8c-0.4,0.4-0.4,1-0.6,1.6\r\n		C10.1,9.9,7.4,9.9,4.6,9.9z M6.3,8.1C6.3,8,6.3,8,6.3,8.1C6.4,7.8,6,7.5,5.8,7.4C5.6,7.3,5.4,7.6,5.3,7.7C5.2,7.8,5.1,7.9,5.2,8\r\n		c0,0.1,0,0.1,0.1,0.1c0.1,0.1,0.1,0.1,0.2,0.2c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.3,0C6.1,8.4,6.3,8.2,6.3,8.1z M9.3,6\r\n		C9.3,6,9.3,5.9,9.3,6c0.1-0.3-0.4-0.7-0.6-0.7C8.4,5.2,8.1,5.4,8.2,5.8c0,0.2,0.2,0.4,0.4,0.5C8.8,6.4,9,6.2,9.2,6.1\r\n		C9.3,6,9.3,6,9.3,6z M5.7,6.6c0.2-0.2,0.6-0.5,0.5-0.8c0-0.2-0.2-0.3-0.3-0.4C5.8,5.3,5.7,5.2,5.5,5.3C5.5,5.4,5.4,5.5,5.3,5.6\r\n		C5.2,5.6,5.2,5.7,5.2,5.8c0,0.1,0.1,0.3,0.2,0.4C5.4,6.3,5.6,6.5,5.7,6.6z M8.8,7.3c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0.1-0.1,0.1\r\n		C8.4,7.5,8.3,7.6,8.2,7.7c0,0.1-0.1,0.1-0.1,0.2c0,0.1,0.1,0.2,0.1,0.3c0.1,0.1,0.2,0.2,0.4,0.3c0.2,0,0.3,0,0.5-0.2\r\n		C9.3,8.1,9.2,7.8,9,7.6C9,7.5,8.9,7.4,8.8,7.3z M5.8,3.1C5.7,3.1,5.6,3.1,5.4,3.2C5.4,3.3,5.3,3.4,5.2,3.5c0,0.1-0.1,0.1-0.1,0.2\r\n		c0,0.1,0.1,0.2,0.1,0.3c0.1,0.2,0.3,0.3,0.5,0.3c0.2,0,0.4-0.2,0.4-0.4c0-0.2-0.1-0.4-0.2-0.6C6,3.2,5.9,3.2,5.8,3.1z M12.3,5.9\r\n		C12.3,5.9,12.3,5.9,12.3,5.9c0-0.1,0-0.2,0-0.3c-0.2-0.4-0.7-0.5-1-0.1c-0.1,0.1-0.2,0.3-0.2,0.4c0,0.2,0.1,0.4,0.3,0.4\r\n		c0.1,0,0.3,0,0.4-0.1C12,6.2,12.1,6.1,12.3,5.9C12.3,6,12.3,5.9,12.3,5.9z M12.3,8.1c0.1-0.2-0.1-0.4-0.3-0.5\r\n		c-0.3-0.2-0.5-0.2-0.7,0c-0.1,0.1-0.2,0.2-0.2,0.3c0,0.1,0,0.3,0.1,0.4c0.1,0.1,0.2,0.2,0.3,0.2c0.2,0,0.4-0.1,0.6-0.3\r\n		C12.2,8.2,12.3,8.1,12.3,8.1z M12.3,3.6c0-0.2-0.3-0.4-0.6-0.4c-0.3-0.1-0.6,0.2-0.5,0.5c0.1,0.3,0.4,0.6,0.7,0.5\r\n		c0.1,0,0.2-0.2,0.3-0.3C12.3,3.8,12.3,3.7,12.3,3.6z M8.8,3.1c-0.1-0.1-0.2,0-0.3,0.1C8.4,3.3,8.3,3.4,8.3,3.5\r\n		c0,0.1-0.1,0.1-0.1,0.2C8.1,3.9,8.4,4.2,8.7,4.3C9,4.4,9.3,4.1,9.2,3.8C9.2,3.6,9,3.2,8.8,3.1z\"/>\r\n	<path id=\"XMLID_116_\" d=\"M19.8,15.8c0-2.1,0-4.2,0-6.4c-0.6,0-1.2,0-1.8,0c-0.5,0-0.8-0.2-0.8-0.7c0-0.4,0.3-0.7,0.8-0.7\r\n		c0.2,0,0.4,0,0.6,0c0.4,0,0.6-0.2,0.7-0.7c0.1-0.6-0.1-1.1-0.6-1.5c-0.3-0.2-0.5-0.4-0.8-0.7c0-0.1,0.1-0.1,0.1-0.2\r\n		c0.9,0,1.9,0,3,0c-0.5,0.5-0.9,0.9-1.2,1.2c-0.4,0.4-0.3,1.5,0.1,1.7c0.1,0.1,0.3,0.1,0.4,0.1c0.9,0,1.7,0,2.6,0c0.6,0,1,0.3,1,0.7\r\n		c0,0.4-0.3,0.7-0.9,0.7c-0.5,0-1.1,0-1.7,0c0,2.1,0,4.2,0,6.3c0.1,0,0.2,0,0.3,0.1c0.4,0.1,0.6,0.3,0.6,0.7c0,0.4-0.2,0.7-0.6,0.7\r\n		c-0.7,0-1.4,0-2.1,0c-0.4,0-0.6-0.3-0.6-0.7c0-0.4,0.2-0.7,0.6-0.7C19.6,15.9,19.7,15.9,19.8,15.8z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:10:58'),
(10, 3, 'Complimentary breakfast', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 19.8\" style=\"enable-background:new 0 0 24 19.8;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_13_\" d=\"M20.8,11c-0.1,1.3-0.2,2.6-0.3,3.9c0,0.3-0.1,0.6-0.3,0.9c-0.1,0.1-0.2,0.3-0.2,0.4c0,0.1-0.1,0.1-0.1,0.2\r\n		c-0.1,0.3-0.4,0.5-0.6,0.6c-0.1,0.1-0.3,0.2-0.4,0.3c-0.3,0.2-0.6,0.3-0.9,0.4c0,0-0.1,0-0.1,0c-0.2,0-0.4,0-0.5,0c-1,0-2,0-3.1,0\r\n		c0,0-0.1,0-0.1,0c0.1-0.2,0.2-0.4,0.3-0.7c0.1-0.4,0-0.7-0.3-1c-0.5-0.6-1.1-1.1-1.8-1.5c-0.1-0.1-0.2-0.2-0.3-0.3\r\n		c-0.1-0.1-0.2-0.2-0.2-0.3c-0.1-0.1-0.2-0.3-0.2-0.4c-0.1-0.9-0.1-1.8-0.2-2.7c0-0.3,0.1-0.3,0.3-0.3c2.8,0,5.6,0,8.4,0\r\n		C20.8,10.4,20.9,10.5,20.8,11z\"/>\r\n	<path id=\"XMLID_61_\" d=\"M6.3,12.2c0-1.6,0-3.3,0-4.9c0.1,0,0.2,0,0.3,0c1.7,0,3.5,0,5.2,0c0.2,0,0.3,0.1,0.3,0.3c0,0.7,0,1.4,0,2.2\r\n		c0,0.2,0,0.3-0.3,0.3c-0.5,0-0.8,0.2-0.7,0.8c0,0.8,0.1,1.6,0.1,2.4c0,0.1,0,0.1,0,0.2c-0.5-0.2-0.9-0.3-1.3-0.5\r\n		c-0.2-0.1-0.4-0.1-0.5-0.3c-0.1-0.2-0.4-0.3-0.7-0.3c-0.7-0.2-1.4-0.2-2.1-0.1C6.5,12.2,6.5,12.2,6.3,12.2z\"/>\r\n	<path id=\"XMLID_60_\" d=\"M10.3,18.2c3.3,0,6.5,0,9.8,0c0.3,0,0.4,0.1,0.4,0.4c0,0.6-0.2,0.9-0.9,0.9c-6.2,0-12.4,0-18.6,0\r\n		c-0.7,0-1-0.4-0.9-1.1c0-0.1,0.1-0.1,0.1-0.1c0.1,0,0.2,0,0.2,0C3.8,18.2,7,18.2,10.3,18.2z\"/>\r\n	<path id=\"XMLID_59_\" d=\"M6,17.8c-0.3-1.1-0.4-2.1-0.3-3.2c0-0.4,0.1-0.9,0.1-1.3c0-0.2,0.1-0.4,0.4-0.5c0.9-0.3,1.8-0.3,2.8,0\r\n		c0.2,0.1,0.3,0.2,0.3,0.4c0.2,0.9,0.2,1.8,0.1,2.8c0,0.5-0.2,1.1-0.3,1.6c0,0.1-0.1,0.2-0.2,0.2C7.9,17.8,7,17.8,6,17.8z\"/>\r\n	<path id=\"XMLID_58_\" d=\"M12.1,6.9c-1.9,0-3.9,0-5.8,0c0-0.7,0-1.3,0-2c0-0.1,0.1-0.2,0.2-0.2c0.1,0,0.2,0,0.4,0\r\n		C6.8,4,6.7,3.3,6.5,2.6c0-0.1-0.1-0.2-0.2-0.2C5.5,2,4.8,1.5,4,1.1C3.9,1.1,3.9,1.1,3.8,1C3.6,0.9,3.6,0.7,3.7,0.5\r\n		C3.8,0.3,4,0.3,4.2,0.4c0.2,0.1,0.4,0.2,0.6,0.3C5.5,1,6.2,1.4,6.9,1.8c0.2,0.1,0.3,0.3,0.4,0.5C7.4,3,7.5,3.7,7.7,4.4\r\n		c0,0.2,0.1,0.2,0.3,0.2c1.3,0,2.6,0,3.8,0c0.4,0,0.4,0,0.4,0.4c0,0.5,0,1,0,1.5C12.2,6.7,12.2,6.8,12.1,6.9z\"/>\r\n	<path id=\"XMLID_57_\" d=\"M9.4,17.8c0.4-1.5,0.4-3,0.2-4.5c0.8,0.2,1.5,0.5,2.1,1c0.1,0.1,0.1,0.2,0.1,0.2c0.1,1,0.1,2-0.3,3\r\n		c-0.1,0.2-0.2,0.3-0.4,0.2C10.6,17.7,10.1,17.8,9.4,17.8z\"/>\r\n	<path id=\"XMLID_56_\" d=\"M5.3,13.3c0,0.8-0.1,1.5,0,2.2c0,0.7,0.2,1.4,0.2,2.2c-0.2,0-0.4,0-0.6,0c-0.4,0-0.7,0-1.1,0\r\n		c-0.2,0-0.3-0.1-0.4-0.3c-0.3-0.8-0.3-1.6-0.3-2.4c0,0,0-0.1,0-0.1c-0.1-0.6,0.3-0.9,0.8-1.1C4.4,13.7,4.8,13.5,5.3,13.3z\"/>\r\n	<path id=\"XMLID_55_\" d=\"M20.8,15.6c0-0.2,0.1-0.5,0.1-0.7c0-0.1,0.1-0.1,0.2-0.1c0.7-0.2,1.3-0.6,1.6-1.2c0.2-0.3,0.3-0.7,0.2-1.1\r\n		c-0.1-0.7-0.6-1-1.3-0.7c-0.2,0.1-0.3,0.2-0.5,0.3c0-0.3,0-0.5,0-0.8c0-0.1,0.1-0.1,0.1-0.1c1.3-0.6,2.4,0.2,2.5,1.4\r\n		c0.1,1.5-1.3,3-2.9,3.1C20.9,15.7,20.9,15.6,20.8,15.6z\"/>\r\n	<path id=\"XMLID_54_\" d=\"M19,4.1c0,0.3-0.2,0.8-0.4,1.1c-0.2,0.3-0.4,0.6-0.5,1c-0.2,0.4-0.1,0.8,0.2,1.1c0.2,0.2,0.2,0.4,0,0.6\r\n		c-0.2,0.2-0.4,0.2-0.6-0.1c-0.5-0.5-0.6-1.1-0.4-1.8c0.1-0.4,0.3-0.8,0.5-1.1c0.5-0.8,0.4-1.4-0.2-2.1c-0.2-0.3-0.2-0.5,0-0.6\r\n		c0.2-0.2,0.4-0.1,0.6,0.1C18.7,2.9,19,3.5,19,4.1z\"/>\r\n	<path id=\"XMLID_53_\" d=\"M15.4,4.1c0,0.5-0.2,0.9-0.4,1.3c-0.2,0.3-0.3,0.6-0.5,1c-0.2,0.4-0.1,0.7,0.2,1.1C15.1,7.6,15,8,14.7,8.1\r\n		c-0.1,0-0.3-0.1-0.4-0.1c-0.5-0.5-0.6-1-0.5-1.7c0.1-0.4,0.3-0.8,0.5-1.2c0.5-0.9,0.5-1.4-0.2-2.2c-0.2-0.2-0.2-0.4,0-0.6\r\n		c0.2-0.1,0.4-0.1,0.6,0.1C15.2,2.9,15.5,3.4,15.4,4.1z\"/>\r\n	<path id=\"XMLID_52_\" d=\"M12.3,14.9c0.2,0.1,0.3,0.2,0.4,0.3c0.4,0.4,0.8,0.7,1.2,1.1c0.3,0.3,0.3,0.6,0.1,0.9\r\n		c-0.2,0.3-0.4,0.5-0.8,0.5c-0.4,0-0.8,0-1.3,0C12.2,16.8,12.3,15.9,12.3,14.9z\"/>\r\n	<path id=\"XMLID_51_\" d=\"M3,17.7c-0.5,0-1,0.1-1.5,0c-0.5-0.1-0.8-0.8-0.5-1.3c0.4-0.6,1-1,1.6-1.3C2.8,15.9,2.9,16.8,3,17.7z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:10:58'),
(11, 4, 'Fitness center/gym', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 22.8\" style=\"enable-background:new 0 0 24 22.8;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_19_\" d=\"M8.9,8.8C8.4,9.4,8,10,7.5,10.5c-0.3,0.3-0.7,0.5-1.1,0.3C6,10.7,5.7,10.4,5.6,10C5.6,9.6,5.5,9.2,5.5,8.8\r\n		C5.4,7.9,5.3,7,5.2,6.1C5.2,6.1,5.1,6,5.1,6C4.6,6,4.2,6,3.7,6c0,0.5,0,0.9,0,1.4c0,0.2,0,0.4,0,0.6c0,0.3-0.2,0.5-0.5,0.5\r\n		c-0.3,0-0.6,0-0.9,0C2,8.4,1.9,8.3,1.9,7.9c0-0.6,0-1.3,0-2C1.6,6,1.4,6,1.2,6c-0.4,0-0.6-0.3-0.6-0.6C0.5,5,0.7,4.7,1,4.6\r\n		c0.1,0,0.3-0.1,0.4-0.1c0.2,0,0.3,0,0.5,0c0-0.1,0-0.3,0-0.4c0-0.5,0-1,0-1.6c0-0.3,0.1-0.5,0.4-0.5c0.3,0,0.6,0,1,0\r\n		c0.3,0,0.4,0.2,0.4,0.4c0,0.6,0,1.1,0,1.7c0,0.1,0,0.2,0,0.3c0.5,0,0.9,0,1.3,0c0-0.4,0.1-0.7,0.4-0.9c0.2-0.1,0.4-0.2,0.6-0.2\r\n		c0.6,0,0.9,0.3,1.1,1.1c0.4,0,0.7,0,1.1,0c0.5,0,0.8,0.1,1,0.5c0.7,1.1,1.8,1.6,3.1,1.4c1.1-0.1,1.9-0.7,2.4-1.6\r\n		c0.1-0.2,0.2-0.3,0.5-0.3c0.4,0,0.9,0,1.3,0c0.1,0,0.2,0,0.2-0.2c0.1-0.7,0.5-1,1.1-1c0.4,0,1,0.4,1,1.1c0,0,0,0,0,0\r\n		c0.4,0,0.9,0,1.3,0c0-0.1,0-0.2,0-0.2c0-0.6,0-1.1,0-1.7c0-0.3,0.1-0.5,0.5-0.5c0.3,0,0.6,0,0.8,0c0.4,0,0.5,0.1,0.5,0.5\r\n		c0,0.6,0,1.3,0,1.9c0.2,0,0.4,0,0.6,0c0.3,0,0.5,0.1,0.7,0.4c0.1,0.3,0.1,0.5-0.1,0.8C23.2,5.9,23,6,22.8,6c-0.2,0-0.3,0-0.5,0\r\n		c0,0.2,0,0.3,0,0.5c0,0.5,0,1,0,1.5c0,0.3-0.1,0.4-0.4,0.4c-0.3,0-0.7,0-1,0c-0.3,0-0.4-0.2-0.4-0.5c0-0.6,0-1.3,0-2\r\n		c-0.5,0-1,0-1.5,0c0,0.4-0.1,0.7-0.1,1.1c-0.1,1-0.2,1.9-0.3,2.9c0,0.5-0.3,0.7-0.7,0.9c-0.4,0.1-0.8,0-1.1-0.3\r\n		c-0.4-0.5-0.8-1-1.3-1.5c-0.1-0.1-0.1-0.2-0.2-0.3c0,0.1,0,0.2,0,0.2c0,1.2,0,2.4,0,3.6c0,0.2,0.1,0.2,0.2,0.3\r\n		c1.1,0.5,2.2,0.9,3.4,1.4c0.8,0.3,1.1,0.8,1.2,1.6c0.2,1.4,0.4,2.9,0.6,4.3c0.1,0.4,0.1,0.8,0,1.1c-0.2,0.5-0.8,0.9-1.3,0.9\r\n		c-0.6,0-1.1-0.4-1.3-1c-0.1-0.6-0.2-1.2-0.3-1.9c-0.1-0.8-0.2-1.6-0.4-2.5c0-0.1-0.1-0.2-0.2-0.2c-1.1-0.5-2.2-0.9-3.3-1.4\r\n		c-0.1,0-0.2,0-0.2,0c-1,0-1.9,0-2.9,0c-0.1,0-0.2,0-0.3,0.1c-1.1,0.4-2.2,0.9-3.3,1.3c-0.1,0-0.2,0.1-0.2,0.2\r\n		c-0.2,1.3-0.4,2.6-0.6,4c-0.1,0.7-0.5,1.2-1.1,1.3c-0.9,0.2-1.8-0.6-1.6-1.6c0.3-1.7,0.5-3.3,0.8-5c0.1-0.6,0.4-1,0.9-1.2\r\n		c1.2-0.5,2.4-1,3.6-1.5c0.1,0,0.2-0.1,0.2-0.2c0-1.3,0-2.5,0-3.8C9,8.9,9,8.9,8.9,8.8z M7.5,7.3C7.9,6.8,8.2,6.4,8.6,6\r\n		C8.2,6,7.8,6,7.3,6C7.4,6.4,7.4,6.8,7.5,7.3z M16.8,6c-0.4,0-0.8,0-1.3,0c0.4,0.4,0.7,0.8,1.1,1.3C16.7,6.8,16.7,6.4,16.8,6z\"/>\r\n	<path id=\"XMLID_18_\" d=\"M9.7,3.1c0-1.3,1.1-2.4,2.4-2.4c1.3,0,2.4,1.1,2.4,2.4c0,1.3-1.1,2.4-2.4,2.4C10.7,5.5,9.7,4.5,9.7,3.1z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:15:34'),
(12, 4, 'Swimming pool', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 16.4\" style=\"enable-background:new 0 0 24 16.4;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_16_\" d=\"M0.3,13.2c0.8-0.3,1.6-0.3,2.4-0.1c0.9,0.2,1.7,0.5,2.6,0.7c0.4,0.1,0.7,0.1,1.1,0c0.6-0.2,1.2-0.4,1.9-0.6\r\n		c0.9-0.3,1.8-0.2,2.6,0.3c0.3,0.2,0.7,0.3,1,0.5c0.2,0.1,0.5,0.1,0.7,0c0.3-0.2,0.6-0.3,0.8-0.5c1-0.6,2.1-0.7,3.2-0.2\r\n		c0.4,0.1,0.7,0.3,1.1,0.5c0.4,0.2,0.8,0.2,1.2-0.1c0.3-0.2,0.6-0.4,0.9-0.5c0.8-0.5,1.6-0.6,2.5-0.3c0.3,0.1,0.7,0.2,1,0.4\r\n		c0.1,0,0.1,0,0.2,0.1c0,0.8,0,1.5,0,2.3c-0.1,0-0.2,0-0.3-0.1c-0.5-0.2-1-0.4-1.5-0.6c-0.3-0.1-0.5-0.1-0.8,0.1\r\n		c-0.3,0.2-0.6,0.4-0.9,0.5c-1,0.6-2,0.7-3,0.3c-0.4-0.2-0.8-0.3-1.2-0.5c-0.5-0.2-1-0.2-1.4,0.1c-0.3,0.2-0.6,0.4-1,0.5\r\n		c-0.8,0.4-1.6,0.4-2.5,0c-0.4-0.2-0.8-0.4-1.2-0.6c-0.4-0.2-0.7-0.3-1.1-0.1c-0.5,0.2-1.1,0.3-1.6,0.5c-0.8,0.3-1.7,0.4-2.5,0.1\r\n		c-0.6-0.2-1.2-0.4-1.8-0.5c-0.5-0.2-1.1-0.3-1.7-0.1c-0.3,0.1-0.6,0.3-1,0.4C0.3,14.8,0.3,14,0.3,13.2z\"/>\r\n	<path id=\"XMLID_15_\" d=\"M4.6,12c1.2-0.6,2.3-1.2,3.5-1.9c1.1-0.6,2.3-1.2,3.4-1.8C11.7,8.2,11.8,8.1,12,8c0.2-0.2,0.3-0.3,0.1-0.6\r\n		c-0.2-0.3-0.4-0.7-0.6-1c-0.4-0.7-0.8-1.3-1.1-2c-0.2-0.3-0.3-0.7-0.4-1c-0.1-0.5,0.1-1,0.6-1.3C11.1,2,11.5,1.9,12,1.8\r\n		c1.4-0.2,2.7-0.4,4.1-0.7C17,1,18,0.8,18.9,0.6c1.2-0.2,2.1,0.9,1.8,2c-0.2,0.6-0.6,0.8-1.2,0.9c-1.6,0.2-3.2,0.5-4.8,0.7\r\n		c-0.3,0.1-0.4,0.2-0.3,0.5c0.1,0.2,0.2,0.4,0.3,0.6c1.3,2.3,2.6,4.5,3.9,6.8c0,0,0,0.1,0.1,0.2c-0.2,0-0.4,0-0.6-0.1\r\n		c-0.4-0.1-0.8-0.3-1.2-0.5c-0.9-0.4-1.8-0.5-2.7-0.1c-0.3,0.1-0.6,0.3-0.9,0.5c-0.1,0.1-0.3,0.1-0.4,0.1c-0.7,0.1-1.3-0.1-1.9-0.4\r\n		c-1-0.6-2-0.4-3-0.1c-0.2,0.1-0.4,0.1-0.7,0.2c-0.8,0.3-1.6,0.2-2.4,0.1C4.7,12.1,4.7,12,4.6,12z\"/>\r\n	<path id=\"XMLID_14_\" d=\"M20,5.3c1.5,0,2.7,1.2,2.7,2.7c0,1.5-1.2,2.6-2.8,2.6c-1.4,0-2.6-1.3-2.6-2.7C17.3,6.4,18.5,5.2,20,5.3z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:15:34'),
(13, 4, 'Spa and wellness center', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 22.9\" style=\"enable-background:new 0 0 24 22.9;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_39_\" d=\"M0.2,20.1c0.2-0.4,0.4-0.8,0.9-0.9c0.1,0,0.3,0,0.5,0c0.7,0,1.5,0,2.3,0c-0.1-0.1-0.1-0.1-0.1-0.1\r\n		c-1.1-1-1.5-2.3-1.3-3.7c0.2-1.5,0.7-2.7,1.6-3.9c0.2-0.2,0.4-0.2,0.5-0.1c0.2,0.1,0.2,0.3,0,0.5c0,0,0,0.1-0.1,0.1\r\n		c-0.9,1.2-1.4,2.6-1.4,4.1c0,1.3,0.8,2.5,2.1,3c0.2,0.1,0.3,0.1,0.5,0.1c1.4,0,2.8,0,4.2,0c0.1,0,0.2,0,0.3,0\r\n		C10,19,9.9,18.9,9.8,18.8c-0.5-0.7-0.7-1.4-0.8-2.2c0-0.2,0-0.4,0-0.7c0-0.5,0.3-0.8,0.8-0.8c0.7,0,1.3,0.1,1.9,0.3\r\n		c0.3-0.4,0.5-0.7,0.8-1.1c0.1-0.2,0.3-0.3,0.5-0.5c0.3-0.3,0.7-0.3,1.1,0c0.5,0.4,0.8,0.9,1.1,1.5c0,0.1,0.1,0.1,0.1,0.1\r\n		c0-0.1,0-0.2,0-0.2c0-0.6,0-1.1,0-1.7c0-0.2,0-0.3,0.1-0.5c0-0.1,0-0.2,0-0.2c-0.8-1.4-2-2.4-3.6-2.9c-0.1,0-0.2,0-0.3,0\r\n		c-1.2,0-2.4,0-3.6,0c-0.1,0-0.3,0-0.4,0.1c-0.5,0.3-1,0.5-1.6,0.8c-0.2,0.1-0.4,0.1-0.6,0c-0.1-0.2-0.1-0.4,0.2-0.5\r\n		C5.7,10,5.9,9.8,6.1,9.7c0.2-0.1,0.4-0.2,0.6-0.3C6.6,9.2,6.5,9,6.4,8.8C6.4,8.5,6.5,8.1,6.7,7.9c0,0,0.1-0.2,0.1-0.2\r\n		C6.6,7.3,6.7,6.9,7,6.5C6.6,5.9,6.6,5.4,7,5.1c0.3-0.2,0.3-0.5,0.3-0.8c0-0.5,0-1,0-1.5c0-1.3,0.9-2.3,2.1-2.4\r\n		C10.6,0.2,11.7,1,12,2.2C12,2.5,12,2.8,12,3.1c0,0.5,0,1,0,1.6c0,0.1,0,0.2,0.1,0.2c0.5,0.4,0.6,1,0.3,1.5c0,0,0,0,0,0.1\r\n		c0.3,0.4,0.3,0.8,0.1,1.3c0.5,0.5,0.6,1,0.2,1.6c0.1,0,0.1,0.1,0.2,0.1c1.3,0.6,2.3,1.6,3,2.8c0.1,0.1,0.1,0.2,0.3,0.2\r\n		c0.3,0,0.6,0.1,0.9,0.2c0.6,0.1,1.2,0,1.9-0.2c0.3-0.1,0.5,0,0.7,0.1c0.2,0.1,0.3,0.4,0.3,0.6c0,0.6,0,1.1,0,1.7\r\n		c0,0.2-0.1,0.4-0.3,0.4c-0.2,0-0.3-0.1-0.3-0.4c0-0.5,0-1,0-1.5c0-0.3,0-0.3-0.3-0.2c-0.9,0.3-1.8,0.3-2.7,0c-0.1,0-0.1,0-0.2,0\r\n		c0,0,0,0-0.1,0c0,0.7,0,1.3,0,2c0.3,0,0.6-0.1,0.9-0.1c0.2,0,0.3,0,0.5,0c0.3,0.1,0.6,0.3,0.6,0.7c0,0.5-0.1,1-0.1,1.5\r\n		c0,0.1,0,0.1,0,0.2c0.2,0,0.5,0,0.7,0c0.2,0,0.5,0,0.7,0c0-0.3,0-0.6,0-0.8c0-0.3,0.3-0.5,0.5-0.3c0.1,0.1,0.2,0.2,0.2,0.3\r\n		c0,0.3,0,0.5,0,0.8c0.4,0,0.7,0,1,0c0.6,0,0.9,0.5,0.7,1c-0.1,0.2-0.2,0.4-0.3,0.6c0.2,0,0.3,0,0.5,0c0.2,0,0.4,0,0.6,0\r\n		c0.6,0,1,0.3,1.2,0.9c0,0,0,0,0,0.1c0,0.2,0,0.4,0,0.6c0,0,0,0.1,0,0.1c-0.2,1-1.1,1.8-2.2,1.8c-6.3,0-12.7,0-19,0\r\n		c-1,0-1.9-0.7-2.2-1.7c0-0.1-0.1-0.2-0.1-0.3C0.2,20.5,0.2,20.3,0.2,20.1z M12,19.9c-1,0-2,0-2.9,0c-2.5,0-5,0-7.5,0\r\n		c-0.4,0-0.7,0.3-0.6,0.7c0,0.1,0,0.2,0.1,0.2C1.2,21.5,1.8,22,2.6,22c6.2,0,12.5,0,18.7,0c0.1,0,0.1,0,0.2,0c0.8,0,1.4-0.6,1.5-1.3\r\n		c0.1-0.5-0.1-0.8-0.6-0.8C18.9,19.9,15.4,19.9,12,19.9z M11.3,4.7c0-0.7,0-1.4,0-2.1c0-0.9-0.7-1.5-1.6-1.6C8.9,1,8.1,1.6,8,2.5\r\n		C8,3.1,8,3.9,8,4.6c0,0.1,0,0.1,0,0.2C9.1,4.7,10.2,4.7,11.3,4.7z M13.5,19.2c1.8-1.6,1.7-3.4,0-4.9C11.7,15.8,11.7,17.6,13.5,19.2\r\n		z M12.5,19.2c-0.8-0.9-1.2-1.9-1-3.1c-0.6-0.2-1.2-0.3-1.8-0.2C9.5,17.9,10.6,19.4,12.5,19.2z M14.5,19.2\r\n		C14.5,19.2,14.5,19.2,14.5,19.2c0.3,0,0.7,0.1,0.9,0c1.6-0.4,2-1.9,1.8-3.3c-0.6-0.1-1.5,0.1-1.8,0.3\r\n		C15.7,17.3,15.2,18.3,14.5,19.2z M9.7,8.3c-0.7,0-1.4,0-2.1,0c-0.3,0-0.5,0.1-0.5,0.4c0,0.3,0.2,0.4,0.5,0.4c1.4,0,2.8,0,4.2,0\r\n		c0.3,0,0.5-0.2,0.5-0.4c0-0.2-0.2-0.4-0.5-0.4C11.1,8.3,10.4,8.3,9.7,8.3z M21,18.3C21,18.3,21,18.2,21,18.3c-1.1,0-2.2,0-3.3,0\r\n		c-0.1,0-0.1,0-0.2,0.1c-0.2,0.3-0.4,0.6-0.6,0.9c0.1,0,0.1,0,0.2,0c0.9,0,1.9,0,2.8,0C20.4,19.2,20.9,18.7,21,18.3z M9.7,5.4\r\n		c-0.6,0-1.2,0-1.8,0c-0.3,0-0.5,0.1-0.5,0.4c0,0.2,0.2,0.4,0.5,0.4c1.2,0,2.4,0,3.6,0c0.3,0,0.5-0.1,0.5-0.4c0-0.2-0.2-0.4-0.5-0.4\r\n		C10.9,5.4,10.3,5.4,9.7,5.4z M9.7,6.9c-0.6,0-1.2,0-1.8,0C7.6,6.9,7.4,7,7.4,7.2c0,0.2,0.2,0.4,0.4,0.4c1.2,0,2.4,0,3.6,0\r\n		c0.3,0,0.4-0.1,0.4-0.4c0-0.2-0.2-0.4-0.4-0.4C10.9,6.9,10.3,6.9,9.7,6.9z\"/>\r\n	<path id=\"XMLID_36_\" d=\"M19.1,10.5c0,0.8-0.5,1.4-1.2,1.6c-0.8,0.2-1.6-0.4-1.8-1.2c-0.1-0.5,0-1,0.2-1.4c0.2-0.5,0.5-1,0.8-1.5\r\n		c0.2-0.3,0.6-0.3,0.8-0.1c0.6,0.7,1,1.5,1.1,2.5C19.1,10.4,19.1,10.5,19.1,10.5z M17.7,8.5c-0.1,0.2-0.2,0.4-0.3,0.6\r\n		c-0.2,0.4-0.4,0.8-0.4,1.3c0,0.4,0.2,0.9,0.6,1c0.5,0.2,1-0.3,1-0.8C18.5,9.8,18,9.2,17.7,8.5z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:16:03'),
(14, 4, 'Yoga or fitness classes', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 19.3 24\" style=\"enable-background:new 0 0 19.3 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_15_\" d=\"M13.2,13.2c-0.3,1.7-0.1,3.4,0.6,5c0.1,0.3,0.6,0.5,0.9,0.5c1,0.2,2,0.3,2.9,0.6c0.9,0.3,1.3,1,1.3,1.9\r\n		c0,0.9-0.5,1.5-1.3,1.9c-1.4,0.6-2.9,0.8-4.4,0.3c-1.5-0.5-3-1.1-4.5-1.7c-1-0.4-1.9-0.8-2.9-1.1c-0.3-0.1-0.6-0.1-0.9,0\r\n		c1.7,0.2,3,1.6,4.7,2.1C9.4,23,9.4,23,9.3,23c-1.9,0.5-3.9,0.9-5.9,0.6c-0.7-0.1-1.4-0.3-2-0.6c-0.7-0.4-1.1-1-1-1.8\r\n		c0-0.8,0.4-1.5,1.1-1.7c1-0.3,2-0.5,3-0.6c0.6-0.1,1-0.3,1.2-0.9c0.5-1.5,0.6-3.1,0.4-4.7c-0.1,0-0.1,0-0.2,0\r\n		c-0.1,0.8-0.3,1.5-0.4,2.3c-0.1,0.9-0.5,1.6-1.3,2.1c-0.8,0.5-1.6,0.8-2.5,1.1c-0.7,0.2-1.3-0.1-1.4-0.7c-0.2-0.6,0.2-1.2,0.9-1.4\r\n		c1.2-0.3,1.9-1,1.9-2.2c0-0.8,0.1-1.6,0.1-2.4c0-2,0.9-3.2,3.2-3.9c2.1-0.6,4.3-0.5,6.4,0c2.1,0.5,3,1.8,3.1,3.9\r\n		c0,0.9,0.1,1.8,0.2,2.7c0.1,0.9,0.6,1.4,1.4,1.7c0.2,0.1,0.3,0.1,0.5,0.1c0.7,0.2,1.1,0.8,0.9,1.4c-0.2,0.6-0.7,0.9-1.4,0.7\r\n		c-0.8-0.3-1.6-0.6-2.3-1c-0.9-0.5-1.4-1.3-1.5-2.4c0-0.7-0.2-1.4-0.3-2.1C13.3,13.2,13.3,13.2,13.2,13.2z\"/>\r\n	<path id=\"XMLID_14_\" d=\"M12.7,3.5c0,1.9-1.3,3.3-3,3.3C8,6.9,6.6,5.4,6.6,3.5c0-1.8,1.4-3.2,3.1-3.3C11.4,0.3,12.7,1.7,12.7,3.5z\"\r\n		/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:16:03'),
(15, 4, 'Massage services', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 21.4\" style=\"enable-background:new 0 0 24 21.4;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_25_\" d=\"M0.4,15.6c0.2-0.4,0.4-0.6,0.8-0.7c0.1,0,0.2,0,0.3,0c3.9,0,7.8,0,11.7,0c0.4,0,0.8,0.1,1.1,0.5\r\n		c1,1.1,2,2.1,3.1,3.1c0.1,0.1,0.2,0.2,0.4,0.2c1.5,0,3,0,4.6,0c0.7,0,1.2,0.4,1.4,1c0.2,0.7-0.3,1.5-1.1,1.6c-0.8,0-1.5,0-2.3,0\r\n		c-1,0-2.1,0-3.1,0c-0.5,0-0.9-0.2-1.2-0.5c-0.3-0.3-0.6-0.6-1-1c-0.1-0.2-0.3-0.2-0.5-0.2c-4.3,0-8.6,0-12.8,0\r\n		c-0.2,0-0.5-0.1-0.7-0.1c-0.3-0.1-0.4-0.4-0.5-0.7C0.4,17.6,0.4,16.6,0.4,15.6z\"/>\r\n	<path id=\"XMLID_24_\" d=\"M0.4,19.7c0.3,0.3,0.8,0.4,1.2,0.4c4.2,0,8.4,0,12.6,0c0.2,0,0.4,0.1,0.5,0.2c0.3,0.3,0.5,0.5,0.9,0.8\r\n		c-0.1,0-0.2,0-0.2,0c-4.9,0-9.9,0-14.8,0c0,0-0.1,0-0.1,0C0.4,20.6,0.4,20.2,0.4,19.7z\"/>\r\n	<path id=\"XMLID_23_\" d=\"M9.4,11c0.1,0.6-0.2,1-0.6,1.4c-0.3,0.3-0.6,0.6-0.9,0.9c-0.2,0.2-0.3,0.5-0.4,0.7\r\n		c-0.1,0.1-0.1,0.2-0.2,0.2c-1.5,0-3.1,0-4.6,0c0,0-0.1,0-0.1,0c0.1-0.2,0.2-0.5,0.3-0.7c0.8-1.9,1.5-3.7,2.3-5.6\r\n		c0.2-0.5,0.6-0.7,1.1-0.7c0.8,0,1.5,0.1,2.2,0.3C8.7,7.6,8.9,7.7,9,7.9c0.8,0.8,1.7,1.6,2.5,2.4c0.2,0.2,0.4,0.3,0.7,0.4\r\n		c1,0.4,1.9,0.7,2.9,1.1c0.6,0.2,0.8,0.7,0.7,1.2c-0.1,0.5-0.7,0.9-1.2,0.7c-0.6-0.2-1.3-0.5-1.9-0.7c-0.5-0.2-1.1-0.4-1.6-0.6\r\n		c-0.2-0.1-0.4-0.2-0.6-0.4C10.1,11.7,9.8,11.4,9.4,11z\"/>\r\n	<path id=\"XMLID_22_\" d=\"M18.9,17.7c-1.6,0-2.9-1.3-2.9-2.9c0-1.6,1.3-2.9,2.9-2.9c1.6,0,2.9,1.3,2.9,2.9\r\n		C21.8,16.4,20.5,17.7,18.9,17.7z\"/>\r\n	<path id=\"XMLID_21_\" d=\"M9.4,7C7.8,7,6.5,5.8,6.5,4.3c0-1.6,1.2-2.8,2.8-2.8c1.5,0,2.8,1.3,2.8,2.8C12.1,5.8,10.9,7,9.4,7z\"/>\r\n	<path id=\"XMLID_20_\" d=\"M8.2,1c-1,0.4-1.6,1.1-2,2C5.6,2.7,5.4,2.2,5.5,1.6C5.6,1,6,0.6,6.6,0.4C7.2,0.3,7.7,0.5,8.2,1z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:16:03'),
(16, 5, '24-hour front desk', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 21.3 21.8\" style=\"enable-background:new 0 0 21.3 21.8;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_14_\">\r\n	<path id=\"XMLID_23_\" d=\"M16.8,6.3c-0.3,0.3-0.4,0.7-0.3,1.1C16.7,7.8,17,8,17.5,8c0.2,0,0.5,0,0.7,0c0.5,0,1,0,1.5,0\r\n		c0.4,0,0.7-0.1,0.9-0.3c0.2-0.2,0.3-0.5,0.3-0.9c0-0.8,0-1.7,0-2.5c0-0.4,0-0.9,0-1.3c0-0.1,0-0.2,0-0.4c-0.1-0.5-0.5-0.8-1-0.7\r\n		c-0.4,0-0.8,0.4-0.9,0.8c0,0.1,0,0.2,0,0.3c0,0,0,0,0,0.1l0,0.8c-0.2-0.3-0.5-0.5-0.8-0.8c-2.6-2.3-5.5-3.2-8.8-2.7\r\n		C6.5,0.8,4.2,2.2,2.5,4.5c-1.8,2.4-2.5,5.1-2,8.1c0.4,2.5,1.5,4.6,3.4,6.3c2.1,1.8,4.4,2.7,7,2.7c0.6,0,1.2-0.1,1.8-0.2\r\n		c3-0.5,5.4-2,7.2-4.6c0.4-0.5,0.3-1.1-0.2-1.4c-0.4-0.3-1-0.2-1.4,0.3c-0.1,0.1-0.1,0.2-0.2,0.2c-0.1,0.2-0.2,0.3-0.3,0.4\r\n		c-2.3,2.7-5.2,3.7-8.6,3c-4.6-0.9-7.6-5.3-6.8-10c0.4-2.2,1.4-4.1,3.2-5.4c2.2-1.8,4.8-2.3,7.6-1.7c1.9,0.5,3.5,1.5,4.8,3.1\r\n		c0.1,0.2,0.3,0.4,0.4,0.6c-0.3,0-0.5,0-0.8,0C17.3,6.1,17,6.2,16.8,6.3z\"/>\r\n	<path id=\"XMLID_33_\" d=\"M15.3,12.1c0.4,0,0.7,0,1,0c0,0.3,0,0.5,0,0.8c-0.3,0-0.7,0-1,0c0,0.7,0,1.4,0,2.1c-0.3,0-0.6,0-1,0\r\n		c0-0.7,0-1.3,0-2.1c-1.3,0-2.5,0-3.7,0c0-0.4,0-0.7,0.2-1c1.1-1.6,2.2-3.2,3.2-4.8C14.1,7.1,14.2,7,14.3,7c0.3,0,0.6,0,1,0\r\n		C15.3,8.7,15.3,10.4,15.3,12.1z M14.3,12.1c0-1.4,0-2.7,0-4c-0.9,1.3-1.8,2.6-2.7,4C12.6,12.1,13.4,12.1,14.3,12.1z\"/>\r\n	<path id=\"XMLID_32_\" d=\"M5.3,8.6c0-0.3,0-0.7,0-1c0,0,0.1-0.1,0.1-0.1c0.9-0.6,2-0.8,3-0.5c0.9,0.3,1.5,1.2,1.4,2.2\r\n		c-0.1,0.9-0.5,1.6-1,2.2c-0.8,0.9-1.7,1.7-2.5,2.6c0,0-0.1,0.1-0.2,0.1c0,0,0,0,0,0.1c1.2,0,2.4,0,3.6,0c0,0.3,0,0.6,0,0.9\r\n		c-1.6,0-3.2,0-4.8,0c0-0.3,0-0.5,0-0.8C4.9,14.1,5,14.1,5,14c0.8-0.9,1.7-1.7,2.5-2.6c0.4-0.4,0.7-0.9,1-1.3\r\n		c0.2-0.4,0.3-0.8,0.2-1.3c-0.1-0.6-0.5-1-1.2-1.1C6.9,7.7,6.3,7.9,5.7,8.3C5.6,8.4,5.5,8.5,5.3,8.6z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:17:43'),
(17, 5, 'Concierge services', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 21.8\" style=\"enable-background:new 0 0 24 21.8;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_16_\" d=\"M4.3,8.6C4.1,9.3,3.7,9.4,3.2,9.4c-0.9,0-1.7,0-2.7,0c0-2.7,0.7-4.9,2.1-6.9c0.8-0.2,1.5-0.3,2,0.6\r\n		c1.1-0.5,2.3-1,3.4-1.5c0.5-0.2,1.1-0.4,1.6-0.7c1.6-0.9,3.2-0.7,4.7,0c2.5,1.2,5,2.5,7.5,3.7c0.4,0.2,0.8,0.4,1.2,0.6\r\n		c0.3,0.1,0.5,0.4,0.8,0.5c-0.3,0.7-0.8,0.7-1.3,0.6c-1.6-0.3-3.2-0.6-4.8-0.9c-0.3-0.9-1.1-1.2-1.9-1.5c-1.7-0.6-3.5-0.5-5.2-0.4\r\n		c-0.2,0-0.5,0.2-0.7,0.3c0.2,0.6,0.6,0.5,0.9,0.4c1.9-0.2,3.7-0.1,5.5,0.6c0.2,0.1,0.4,0.2,0.6,0.3c0.3,0.7-0.1,1-0.6,1.2\r\n		c-0.4,0.1-0.9,0.2-1.3,0.1c-2-0.3-3.8,0.1-5.4,1.4C8.1,9,6.3,9.3,4.3,8.6z\"/>\r\n	<path id=\"XMLID_15_\" d=\"M13.2,10.8c0,0,0-0.1-0.1-0.1c-0.4-0.3-1.2-0.1-1.1-0.9c0.1-0.7,0.8-0.6,1.3-0.7c0.5,0,1.1,0,1.6,0\r\n		c0.5,0,1,0.1,1,0.6c0,0.3-0.2,0.6-0.5,0.7c-0.2,0.1-0.9,0.3-0.6,0.6c0.7,0.6,1.7,0.7,2.5,1.1c1,0.5,1.8,1.2,2.4,2.1\r\n		c0.6,1,0.8,2.1,1.4,3.1c0.4,0.6,0.2,1.2-0.5,1.4c-0.3,0.1-0.5,0.1-0.8,0.1c-3.9,0-7.8,0-11.7,0c-0.2,0-0.4,0-0.6,0\r\n		c-0.8-0.1-1-0.8-0.6-1.5c0.2-0.3,0.4-0.7,0.5-1c0.5-2.3,2-3.7,4.1-4.7c0.4-0.2,0.8-0.2,1.1-0.4C12.9,11.3,13.3,11,13.2,10.8z\"/>\r\n	<path id=\"XMLID_14_\" d=\"M5.8,21.1c-0.2-0.2,0-0.8,0.1-1c0.2-0.3,0.5-0.5,0.9-0.5c0.4-0.1,0.9-0.1,1.3-0.1c3.9,0,7.7,0,11.6,0\r\n		c0.4,0,0.9,0,1.3,0.1c0.9,0.1,1.2,0.4,1.4,1.5c-0.3,0-0.6,0.1-0.9,0.1c-2.6,0-5.2,0-7.9,0c-2.5,0-5.1,0.2-7.6,0\r\n		C5.9,21.2,5.9,21.1,5.8,21.1z\"/>\r\n</g>\r\n</svg>', 1, 1, '', '2023-12-17 21:17:43'),
(18, 5, 'Luggage storage', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 19.6 24\" style=\"enable-background:new 0 0 19.6 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_2_\">\r\n	<path id=\"XMLID_30_\" d=\"M5.3,10.5c0.5,0,1.1,0,1.6,0c0-0.2,0-0.4,0-0.5c0-1.1,0.7-1.8,1.8-1.8c0.8,0,1.6,0,2.4,0\r\n		c1,0,1.7,0.7,1.7,1.7c0,0.2,0,0.4,0,0.6c0.5,0,1.1,0,1.6,0c0,4.4,0,8.8,0,13.3c-3,0-6,0-9.1,0C5.3,19.3,5.3,14.9,5.3,10.5z\r\n		 M11.5,10.5c0-0.2,0-0.4,0-0.6c0-0.3-0.2-0.5-0.5-0.5c-0.3,0-0.6,0-0.9,0c-0.5,0-1,0-1.5,0c-0.3,0-0.5,0.1-0.5,0.4\r\n		c0,0.2,0,0.5,0,0.7C9.3,10.5,10.4,10.5,11.5,10.5z\"/>\r\n	<path id=\"XMLID_27_\" d=\"M0.5,4.3C0.7,4.1,0.8,4,1,3.8C1.3,3.5,1.5,3.3,1.8,3C1.9,2.9,2,2.8,2.2,2.8c3,0,5.9,0,8.9,0\r\n		c0.2,0,0.3-0.1,0.4-0.2c0.7-1.4,1.8-2.2,3.3-2.4C16.6,0,18.5,1.3,19,3.2c0.6,2.2-0.5,4.3-2.7,5c-1.7,0.6-3.8-0.2-4.7-1.8\r\n		c-0.1-0.2-0.2-0.3-0.3-0.5c0-0.1-0.1-0.1-0.2-0.1c-0.6,0-1.2,0-1.8,0c-0.1,0-0.2-0.1-0.3-0.1C8.8,5.4,8.5,5.1,8.3,4.8\r\n		C8,5.1,7.8,5.3,7.5,5.6C7.4,5.7,7.3,5.8,7.1,5.8c-0.3,0-0.6,0-1,0c-0.1,0-0.2,0-0.3-0.1C5.6,5.4,5.3,5.1,5,4.8\r\n		C4.7,5.2,4.4,5.5,4.1,5.8C3.8,5.4,3.5,5.1,3.2,4.8C3.2,4.9,3.1,4.9,3.1,5C2.9,5.2,2.7,5.3,2.4,5.3c-0.3,0-0.6,0-0.9,0\r\n		c-0.1,0-0.1,0-0.2,0C1.1,4.9,0.8,4.6,0.5,4.3z M17.9,4.3c0-0.6-0.4-1-1-1.1c-0.6,0-1,0.5-1.1,1c0,0.6,0.5,1,1,1.1\r\n		C17.5,5.4,17.9,4.9,17.9,4.3z\"/>\r\n	<path id=\"XMLID_26_\" d=\"M4.2,23.7c-0.1,0-0.1,0-0.2,0c-0.6,0-1.2,0-1.8,0c-1,0-1.8-0.7-1.8-1.8c0-3.2,0-6.5,0-9.7\r\n		c0-1.1,0.7-1.8,1.8-1.8c0.6,0,1.3,0,1.9,0C4.2,14.9,4.2,19.3,4.2,23.7z\"/>\r\n	<path id=\"XMLID_25_\" d=\"M15.5,10.5c0.8,0,1.6-0.1,2.3,0c0.8,0.1,1.4,0.8,1.4,1.6c0,3.3,0,6.6,0,9.9c0,0.9-0.7,1.6-1.6,1.7\r\n		c-0.7,0-1.4,0-2.1,0c0,0,0,0-0.1,0C15.5,19.3,15.5,14.9,15.5,10.5z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:19:02'),
(19, 5, 'Laundry and dry cleaning services', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 24\" style=\"enable-background:new 0 0 24 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_42_\" d=\"M11.7,23.7c0,0-0.1,0-0.1,0c-1.5,0-3,0-4.5,0c-0.4,0-0.7,0-1.1,0c-0.5-0.1-1-0.3-1.3-0.8\r\n		c-0.1-0.2-0.2-0.4-0.2-0.6c0-2.4,0-4.7,0-7.1c0-0.3,0.1-0.5,0.3-0.8c0.3-0.4,0.8-0.6,1.3-0.6c0.6,0,1.3,0,1.9,0c2.3,0,4.5,0,6.8,0\r\n		c1.1,0,2.1,0,3.2,0c0.7,0,1.2,0.4,1.5,1.1c0,0,0,0.1,0,0.1c0,2.5,0,4.9,0,7.4c0,0.1-0.1,0.2-0.1,0.3c-0.3,0.6-0.8,0.9-1.5,0.9\r\n		c-1.8,0-3.7,0-5.5,0c0,0-0.1,0-0.1,0C12.1,23.7,11.9,23.7,11.7,23.7z\"/>\r\n	<path id=\"XMLID_41_\" d=\"M23.7,15.8c-0.2,0.9-0.9,1.3-1.7,1.6c-0.5,0.2-0.9,0.3-1.4,0.3c-0.1,0-0.2,0-0.2-0.1c0-0.6,0-1.2,0-1.7\r\n		c0,0,0-0.1,0.1-0.1c0.1-0.1,0.3-0.2,0.4-0.3c0.2-0.2,0.3-0.5,0.1-0.7c-0.1-0.3-0.3-0.4-0.6-0.6c-1.3-1.1-2.7-2.2-4.2-3.1\r\n		c-0.4-0.2-0.7-0.4-1.1-0.6c0,0-0.1,0-0.1,0c-1.6,0-3.1,0-4.7,0c-0.5,0-1,0-1.4,0c-0.4,0-0.8-0.4-0.9-0.8C7.8,9,7.9,8.6,8.3,8.3\r\n		c0.3-0.2,0.5-0.2,0.8-0.3c0.4,0,0.8,0,1.2,0c0,0,0,0,0.1,0c0-0.2,0-0.5,0-0.7c0-0.4,0.2-0.7,0.5-0.9c0.2-0.1,0.3-0.1,0.5-0.2\r\n		C12,6.2,12.5,6,13,5.6c0.5-0.4,0.8-1,0.7-1.6c0-0.8-0.5-1.3-1.3-1.5c-0.5-0.1-0.9,0.1-1.3,0.4c-0.2,0.2-0.4,0.3-0.6,0.5\r\n		C9.9,3.8,9,3.5,8.7,2.9C8.6,2.6,8.7,2.3,8.8,2c0.2-0.4,0.6-0.7,0.9-0.9c0.6-0.4,1.2-0.7,1.9-0.7c0.8-0.1,1.6,0.1,2.3,0.4\r\n		c0.7,0.3,1.3,0.8,1.7,1.5C16,2.8,16.2,3.4,16.2,4c0.1,1.5-0.7,2.6-1.9,3.4c-0.4,0.2-0.8,0.4-1.2,0.6c0,0,0,0,0.1,0\r\n		c0.6,0,1.2,0,1.7,0c0.3,0,0.6,0.2,0.9,0.3c1,0.5,1.9,1.2,2.8,1.9c1,0.7,1.9,1.5,2.9,2.3c0.5,0.4,1,0.8,1.4,1.3\r\n		c0.3,0.3,0.5,0.7,0.6,1.1c0,0.1,0,0.1,0,0.2C23.7,15.4,23.7,15.6,23.7,15.8z\"/>\r\n	<path id=\"XMLID_40_\" d=\"M7,9.2C7,9.3,7,9.4,7,9.5c0,0.6,0.4,1,0.9,1.3c0.1,0,0.1,0.1,0.2,0.1C8,11,7.9,11,7.8,11.1\r\n		c-1.1,0.7-2.1,1.5-3.2,2.2c-0.4,0.3-0.8,0.6-1.2,0.9c-0.2,0.1-0.3,0.3-0.4,0.5c-0.2,0.3-0.1,0.6,0.2,0.8c0.1,0.1,0.3,0.2,0.4,0.2\r\n		c0.1,0,0.1,0.1,0.1,0.1c0,0.5,0,1.1,0,1.6c0,0,0,0.1,0,0.1c0,0.1,0,0.1-0.1,0.1c-0.7-0.1-1.5-0.2-2.1-0.6c-0.5-0.3-0.9-0.7-1-1.2\r\n		c-0.1-0.4,0-0.8,0.2-1.2c0.2-0.5,0.6-0.9,1-1.3c1.1-0.9,2.3-1.8,3.4-2.6c0.6-0.5,1.2-0.9,1.9-1.4C6.9,9.3,6.9,9.3,7,9.2z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:19:02'),
(20, 5, 'Shoe shining services', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 19.1\" style=\"enable-background:new 0 0 24 19.1;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_1_\">\r\n	<path id=\"XMLID_46_\" d=\"M0.4,13.2c0.6,0.1,1.1,0.2,1.7,0.2C4,13.6,6,13.8,7.9,13.2c0.5-0.1,0.9-0.1,1.3,0.2\r\n		c1.3,0.8,2.6,1.6,3.9,2.3c0.9,0.5,2,0.8,3.1,0.9c1.4,0.1,2.6-0.5,3.4-1.6c0.1-0.2,0.2-0.2,0.5-0.2c0.7,0.1,1.3,0.2,2,0.3\r\n		c1.2,0.2,1.6,1.1,1.5,2.2c0,0.4-0.2,0.8-0.3,1.2c0,0.1-0.1,0.2-0.2,0.2c-2.8,0-5.5,0-8.3,0.1c-0.7,0-1.4-0.3-2.1-0.4\r\n		C11.1,18,9.5,17.6,8,17.3c-0.1,0-0.1,0-0.2,0c0,0.5,0,1,0,1.5c-0.1,0-0.2,0-0.3,0c-2.1,0-4.2,0-6.3,0c-0.2,0-0.3-0.1-0.3-0.2\r\n		c-0.3-0.9-0.5-1.9-0.5-2.8c0-0.8,0-1.6,0-2.4C0.4,13.3,0.4,13.2,0.4,13.2z\"/>\r\n	<path id=\"XMLID_45_\" d=\"M8.2,2.5c0.5-1.1,1.2-1.8,2.4-2c0.6-0.1,1.3,0,1.8,0.3c2.9,1.5,5.8,3,8.6,4.5c0.4,0.2,0.8,0.4,1.1,0.7\r\n		c1.1,1.1,1.2,2.6,0.3,4C17.7,7.4,12.9,5,8.2,2.5z\"/>\r\n	<path id=\"XMLID_42_\" d=\"M9.7,8.8c0.5,0.6,1,1.3,1.5,1.9c-0.2,0.3-0.5,0.5-0.7,0.8c0.2,0.2,0.5,0.4,0.7,0.6c0.3-0.3,0.5-0.6,0.8-0.9\r\n		c0.2,0.2,0.4,0.3,0.7,0.5c-0.2,0.3-0.4,0.5-0.7,0.8c0.3,0.2,0.5,0.4,0.8,0.6c0.3-0.3,0.5-0.6,0.8-0.9c0.2,0.1,0.5,0.3,0.7,0.4\r\n		c-0.2,0.3-0.4,0.6-0.6,0.9c0.3,0.2,0.6,0.4,0.8,0.5c0.2-0.3,0.5-0.7,0.7-1c1.2,0.4,2.3,0.9,3.5,1.3c-0.3,0.4-0.7,0.7-1.2,0.9\r\n		c-1,0.3-2,0.2-2.9-0.1c-0.8-0.2-1.5-0.7-2.1-1.1c-1.2-0.8-2.4-1.5-3.7-2.2c-0.1,0-0.2-0.1-0.3,0c-1.2,0.5-2.4,0.6-3.7,0.6\r\n		c-1.4,0-2.8-0.2-4.2-0.4c0,0,0,0-0.1-0.1c0.1-0.6,0.3-1.3,0.4-2c0.5,0.1,0.9,0.2,1.3,0.2c1.8,0.3,3.6,0.4,5.4-0.2\r\n		C8.4,9.9,8.9,9.6,9.7,8.8z M15.7,13.6c-0.2,0.4-0.4,0.7-0.5,1.1c0.3,0.2,0.6,0.3,0.9,0.4c0.2-0.4,0.4-0.7,0.5-1.1\r\n		C16.3,13.8,16,13.7,15.7,13.6z\"/>\r\n	<path id=\"XMLID_41_\" d=\"M14.7,8.4c-0.3-0.2-0.6-0.3-0.9-0.5c0.3-0.6,0.6-1.2,1-1.9c0.3,0.2,0.6,0.3,0.9,0.5\r\n		C15.4,7.2,15,7.8,14.7,8.4z\"/>\r\n	<path id=\"XMLID_40_\" d=\"M13.6,5.5c-0.3,0.6-0.7,1.2-1,1.9c-0.3-0.2-0.6-0.3-0.9-0.5c0.3-0.6,0.7-1.2,1-1.9\r\n		C13,5.2,13.3,5.3,13.6,5.5z\"/>\r\n	<path id=\"XMLID_39_\" d=\"M20.8,11.6c-0.3-0.2-0.6-0.3-0.9-0.5c0.3-0.6,0.6-1.2,1-1.9c0.3,0.2,0.6,0.3,0.9,0.5\r\n		C21.5,10.4,21.2,11,20.8,11.6z\"/>\r\n	<path id=\"XMLID_38_\" d=\"M9.7,5.8c0.3-0.6,0.7-1.3,1-1.9c0.3,0.2,0.6,0.3,0.9,0.5c-0.3,0.6-0.7,1.2-1,1.9C10.3,6.1,10,6,9.7,5.8z\"/>\r\n	<path id=\"XMLID_37_\" d=\"M16.7,9.5c-0.3-0.2-0.6-0.3-0.9-0.5c0.3-0.6,0.7-1.2,1-1.9c0.3,0.2,0.6,0.3,0.9,0.5\r\n		C17.4,8.3,17,8.9,16.7,9.5z\"/>\r\n	<path id=\"XMLID_36_\" d=\"M18.8,10.6c-0.3-0.2-0.6-0.3-0.9-0.5c0.3-0.6,0.7-1.2,1-1.9c0.3,0.2,0.6,0.3,0.9,0.5\r\n		C19.4,9.3,19.1,9.9,18.8,10.6z\"/>\r\n	<path id=\"XMLID_35_\" d=\"M8.5,5.2C8.2,5.1,8,4.9,7.7,4.8c0.3-0.6,0.7-1.2,1-1.9C8.9,3,9.2,3.2,9.5,3.3C9.2,4,8.9,4.6,8.5,5.2z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:19:32');
INSERT INTO `sys_amenities` (`id`, `catId`, `title`, `img`, `deleteRec`, `status`, `addBy`, `add_on`) VALUES
(21, 5, 'Wake-up service', '<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 24 24\" style=\"enable-background:new 0 0 24 24;\" xml:space=\"preserve\">\r\n<g id=\"XMLID_2_\">\r\n	<path id=\"XMLID_247_\" d=\"M17,3.1c0.2-0.4,0.4-0.5,0.7-0.5C18,2.8,18.1,3,18,3.4c0.1,0,0.2,0.1,0.3,0.1c0.2,0,0.2,0.2,0.3,0.3\r\n		c0,0.1,0.1,0.1,0.1,0.2c1.1,0.6,1.7,1.5,1.9,2.7c0.1,0.6,0,1.3-0.2,1.9c0,0.1-0.1,0.1-0.1,0.1c-0.3,0.1-0.6,0.1-0.8,0.2\r\n		c-0.3,0-0.6,0-0.9,0c1.4,1.4,2.2,3.1,2.3,5c0.1,2-0.4,3.7-1.7,5.2c0.3,0.4,0.6,0.8,1,1.1c0.3,0.4,0.2,1-0.3,1.1\r\n		c-0.3,0.1-0.5,0-0.7-0.2c-0.3-0.3-0.5-0.6-0.8-0.9c0,0-0.1-0.1-0.1-0.1c-0.4,0.2-0.7,0.5-1.1,0.7c-0.8,0.4-1.6,0.7-2.5,0.8\r\n		c-0.9,0.2-1.8,0.3-2.7,0.5c-0.2,0-0.3,0-0.5,0.1c0,0.3-0.1,0.6-0.1,0.9c0,0.4-0.4,0.7-0.7,0.6c-0.4-0.1-0.7-0.4-0.6-0.8\r\n		c0.1-0.7,0.1-1.5,0.2-2.2c-0.2,0.5-0.3,0.9-0.5,1.4c-2.5-0.6-4.3-2-5.4-4.3c-1.1-2.3-1-4.6,0.2-6.9c-0.1,0-0.3,0-0.4,0\r\n		c-0.1,0-0.2-0.1-0.2-0.1c-0.8-1.2-0.8-2.8,0-4.1C4,6.2,4.3,5.9,4.6,5.6c0.1,0,0.1-0.1,0.1-0.2c0.1-0.1,0.1-0.2,0.2-0.3\r\n		C5,5,5.1,5,5.2,5C5,4.5,5.1,4.3,5.4,4.1c0.3-0.1,0.5,0,0.8,0.4c0.4-0.1,0.6-0.4,0.8-0.7c0.1-0.3,0.2-0.7,0.3-1\r\n		c0-0.1,0.1-0.3,0.1-0.4c0.3-0.7,0.7-1.3,1.5-1.5c1.3-0.4,2.5-0.6,3.9-0.5c0.5,0,1,0.2,1.4,0.6c0.2,0.2,0.5,0.5,0.7,0.8\r\n		C15.3,2.5,16,3,17,3.1z M19.4,14.5c0-1.8-0.6-3.3-1.7-4.5c-1.5-1.5-3.3-2.2-5.5-1.7C9.7,9,8.1,11.2,8,13.7c-0.1,2,0.6,3.8,2.2,5.1\r\n		c1.9,1.7,4.8,1.9,6.9,0.4C18.6,18,19.4,16.3,19.4,14.5z M15.2,3.2c-0.2-0.2-0.5-0.5-0.7-0.7c-0.2-0.2-0.4-0.4-0.5-0.7\r\n		c-0.4-0.4-0.8-0.7-1.4-0.7c-1.2,0-2.3,0.1-3.4,0.5c-0.6,0.2-1,0.6-1.2,1.2c-0.1,0.5-0.3,1-0.5,1.5c0,0,0.1,0,0.1,0\r\n		c1.7-0.2,3.2,0.6,4,2.1c0.1,0.2,0.2,0.4,0,0.6c0,0,0,0,0,0c0.3,0,0.5,0,0.8,0c0.2,0,0.3-0.1,0.3-0.3c0-0.3,0.1-0.7,0.2-1\r\n		c0.1,0,0.1,0,0.2,0c0.2,0,0.2-0.1,0.2-0.2c0-0.1,0-0.3-0.2-0.3c-0.2,0-0.4-0.1-0.6-0.1c-0.1,0-0.2,0-0.2,0.1\r\n		c-0.2,0.2-0.1,0.4,0.2,0.5c0,0,0,0,0.1,0c-0.1,0.3-0.1,0.7-0.2,1.1c-0.1-0.2-0.3-0.3-0.2-0.5c-0.3-0.1-0.5-0.4-0.5-0.8\r\n		c-0.1-0.5,0.3-1,0.7-1.1c0.2,0,0.3,0,0.5,0c0.1,0,0.2,0,0.3-0.1c0.3-0.3,0.6-0.5,1-0.7C14.3,3.4,14.8,3.3,15.2,3.2z M10.5,6.6\r\n		C9.8,5.4,8.2,4.9,6.9,5.5C6.5,5.7,6,5.9,5.5,6.2C4.9,6.5,4.5,7.1,4.2,7.8c0,0,0,0.1,0,0.1C4.4,7.5,4.7,7.2,5.1,7\r\n		c0.4-0.3,0.8-0.4,1.3-0.1C6.6,7,6.9,7.1,7.1,7.3c-0.2-0.3-0.5-0.6-1-0.7c0.4-0.1,0.7,0,1,0.3C7.5,7.1,7.7,7.5,7.9,8\r\n		c0,0,0,0.1-0.1,0.2C7.5,8.3,7.3,8.5,7,8.7C6.6,8.9,6.3,9.2,5.9,9.4C7,9.2,9.9,7.4,10.5,6.6z M19.5,7.8C19.5,7.8,19.6,7.7,19.5,7.8\r\n		c0.3-1.5-0.6-2.8-2-3.2c-0.4-0.1-0.8-0.2-1.1-0.3c-0.4-0.1-0.8-0.2-1.2-0.1c-0.5,0.1-1,0.3-1.4,0.7c0,0,0.1,0,0.1,0\r\n		c0.3-0.2,0.7-0.3,1.1-0.4c0.5-0.1,0.9,0.2,1.1,0.6c0,0.1,0.1,0.2,0.1,0.3c0,0,0,0,0.1,0C16.1,5.2,16,4.9,16,4.6\r\n		c0.3,0.1,0.5,0.2,0.6,0.5c0.1,0.5,0,0.9-0.1,1.3c-0.8-0.2-1.5-0.2-2.3-0.2C16,6.5,17.8,7.1,19.5,7.8z M7.9,9.8\r\n		c-0.1,0-0.1,0.1-0.2,0.1c-0.5,0.4-1,0.9-1.3,1.5c-0.7,1.1-0.9,2.2-0.7,3.4c0.1,0.6,0.4,1.1,0.9,1.4c0.1,0.1,0.3,0.1,0.4,0.2\r\n		c-0.3-1.1-0.4-2.3-0.3-3.4C6.8,11.9,7.2,10.8,7.9,9.8z M5.4,15.2c-0.3-1.2-0.3-2.3,0.3-3.4C4.9,12.7,4.9,14.2,5.4,15.2z M11,21.8\r\n		C11,21.8,10.9,21.8,11,21.8c-0.2,0.4-0.3,0.7-0.3,1.1c0,0.1,0.1,0.1,0.1,0.2c0.1-0.1,0.1-0.1,0.1-0.2C10.9,22.6,11,22.2,11,21.8z\r\n		 M19.7,20.6C19.7,20.5,19.7,20.5,19.7,20.6c-0.1-0.4-0.4-0.7-0.7-1C19.2,19.9,19.4,20.3,19.7,20.6z M6.7,7.5C6.3,7.1,5.7,7,5.3,7.1\r\n		C5.8,7.1,6.3,7.2,6.7,7.5z M4.7,13.3C4.8,13,4.9,12.6,5,12.2C4.8,12.5,4.7,12.9,4.7,13.3z M15.1,4.9c0.2,0.1,0.3,0.2,0.5,0.3\r\n		C15.5,5,15.4,4.9,15.1,4.9z\"/>\r\n	<path id=\"XMLID_230_\" d=\"M2.6,10C2.3,9.5,2.2,9,2.1,8.5c-0.2-1,0-2,0.7-2.9C2.8,5.4,3,5.3,3.2,5.2c0,0,0.1,0,0.2,0\r\n		c0,0.1,0,0.1,0,0.2C3.3,5.5,3.2,5.7,3.1,5.8C2.4,6.7,2.2,7.7,2.3,8.7C2.4,9.1,2.5,9.6,2.6,10z\"/>\r\n	<path id=\"XMLID_229_\" d=\"M19.3,3.5c0.1,0.1,0.2,0.1,0.3,0.2c1.2,0.6,1.8,1.6,1.9,2.9c0,0.4,0,0.7-0.1,1.1c0,0.1-0.1,0.1-0.1,0.2\r\n		c0-0.1-0.1-0.1-0.1-0.2c-0.1-0.6-0.1-1.2-0.2-1.7C20.8,4.9,20.3,4.1,19.3,3.5C19.3,3.5,19.3,3.5,19.3,3.5\r\n		C19.3,3.5,19.3,3.5,19.3,3.5z\"/>\r\n	<path id=\"XMLID_227_\" d=\"M2.8,4.5C2.4,4.8,2.1,5.2,1.9,5.6C1.5,6.2,1.3,6.9,1.3,7.7c0,0.1,0,0.2,0,0.2C1.2,8,1.2,8,1.1,8\r\n		c0,0-0.1-0.1-0.1-0.1C1,7.8,1,7.6,1,7.5c0.1-1,0.5-1.9,1.3-2.6C2.4,4.7,2.6,4.6,2.8,4.5C2.8,4.5,2.8,4.5,2.8,4.5z\"/>\r\n	<path id=\"XMLID_225_\" d=\"M21.8,4.8c-0.3-0.6-0.7-1.1-1.2-1.5C20.2,3,19.5,2.8,19,2.6c0,0,0,0,0-0.1c0.1,0,0.1-0.1,0.2,0\r\n		c0.2,0,0.4,0,0.6,0.1C20.8,3,21.5,3.7,21.8,4.8C21.8,4.8,21.8,4.8,21.8,4.8z\"/>\r\n	<path id=\"XMLID_197_\" d=\"M14.2,13.9c0.2-0.4,0.5-0.8,0.8-1.2c0.2-0.2,0.3-0.4,0.5-0.6c0.1-0.1,0.2-0.2,0.4-0.2\r\n		c0.2-0.1,0.3,0,0.2,0.2c0,0.3-0.1,0.6-0.3,0.8c-0.4,0.5-0.9,1-1.3,1.4c-0.1,0.1-0.1,0.2-0.1,0.3c0,0.3-0.2,0.6-0.5,0.6\r\n		c-0.3,0-0.6-0.2-0.6-0.5c0-0.1-0.1-0.2-0.2-0.3c-0.7-0.4-1.5-0.8-2.2-1.1c-0.3-0.2-0.5-0.4-0.7-0.7c-0.1-0.1,0-0.3,0.1-0.3\r\n		c0.3,0,0.7,0.1,0.9,0.3c0.7,0.5,1.4,0.9,2.1,1.4c0.1,0.1,0.2,0.1,0.3,0C13.7,13.9,13.9,13.9,14.2,13.9z M14,14.5\r\n		c0-0.1-0.1-0.3-0.2-0.3c-0.1,0-0.2,0.1-0.2,0.3c0,0.1,0.1,0.3,0.3,0.3C13.9,14.8,14,14.7,14,14.5z\"/>\r\n	<path id=\"XMLID_196_\" d=\"M12.5,8.6c1.9-0.4,4.6,0.5,5.9,3c1.3,2.5,0.6,5.3-1,6.8c1.4-2.1,1.7-4.2,0.5-6.5C16.8,9.7,15,8.6,12.5,8.6\r\n		z\"/>\r\n	<path id=\"XMLID_193_\" d=\"M14.7,18.6c0.1,0.3-0.2,0.2-0.2,0.4c0.3,0,0.5,0.3,0.3,0.6c-0.1,0.2-0.3,0.2-0.5,0.1\r\n		c-0.2-0.2-0.2-0.4-0.1-0.6C14.3,18.7,14.4,18.6,14.7,18.6z M14.5,19.4C14.5,19.4,14.5,19.4,14.5,19.4c0.1-0.2,0.1-0.2,0-0.3\r\n		C14.4,19.2,14.5,19.3,14.5,19.4z\"/>\r\n	<path id=\"XMLID_190_\" d=\"M8.7,15.7c0-0.1,0-0.2,0-0.2c0.1-0.1,0.2-0.1,0.2-0.2c-0.1-0.1-0.3-0.1-0.3-0.2c-0.1-0.1,0-0.2,0-0.4\r\n		c0.1-0.2,0.3-0.2,0.5-0.1c0.2,0.2,0.1,0.8-0.1,0.9C8.9,15.6,8.8,15.6,8.7,15.7z M8.9,15c0,0,0.1,0,0.1,0c0-0.1,0-0.2-0.1-0.3\r\n		c0,0-0.1,0-0.1,0C8.8,14.8,8.8,14.9,8.9,15z\"/>\r\n	<path id=\"XMLID_189_\" d=\"M13,10.1c0-0.1,0.1-0.2,0.1-0.3c0.1-0.1,0.1-0.2,0.2-0.3c0-0.1,0-0.2,0-0.2c0,0-0.1,0-0.2,0\r\n		C12.9,9.1,12.9,9,13.1,9c0.2-0.1,0.4,0.1,0.4,0.3c0,0.2-0.1,0.3-0.2,0.5c0.1,0,0.1,0,0.2,0c0,0.1,0,0.1,0,0.2\r\n		C13.4,10,13.2,10,13,10.1z\"/>\r\n	<path id=\"XMLID_188_\" d=\"M18,13.7c0.2,0.2,0.2,0.3,0.1,0.5c-0.1,0.1-0.3,0.2-0.4,0.1c0,0-0.1-0.1-0.1-0.2c0.1-0.1,0.3,0,0.3-0.1\r\n		c0-0.1-0.1-0.1-0.2-0.2c0,0,0,0-0.1,0c0-0.1,0-0.1,0.1-0.2c0-0.1,0.1-0.1,0.1-0.1c-0.1,0-0.1,0-0.2,0c0,0,0,0-0.1,0\r\n		c0-0.1,0-0.2,0-0.2c0.1,0,0.3,0,0.4,0C18.1,13.4,18.1,13.6,18,13.7z\"/>\r\n	<path id=\"XMLID_187_\" d=\"M12.8,10.1c-0.1,0-0.2,0-0.2,0c0-0.1,0-0.3,0-0.4c0-0.1,0-0.2,0-0.4c-0.1,0-0.1,0-0.2,0.1\r\n		c0-0.1,0-0.1-0.1-0.2c0.1-0.1,0.3-0.1,0.4-0.2C12.8,9.4,12.8,9.7,12.8,10.1z\"/>\r\n	<path id=\"XMLID_186_\" d=\"M17.8,16.2c0,0.1-0.1,0.3-0.2,0.3c-0.2,0-0.3-0.1-0.3-0.3c0-0.2,0.1-0.3,0.3-0.3\r\n		C17.7,15.9,17.8,16.1,17.8,16.2z\"/>\r\n	<path id=\"XMLID_185_\" d=\"M16.4,18.4c-0.1,0-0.3-0.1-0.3-0.3c0-0.1,0.1-0.3,0.2-0.3c0.2,0,0.3,0.1,0.3,0.3\r\n		C16.6,18.3,16.5,18.4,16.4,18.4z\"/>\r\n	<path id=\"XMLID_184_\" d=\"M9.5,12.5c0,0.1-0.1,0.3-0.2,0.3c-0.2,0-0.3-0.1-0.3-0.3c0-0.1,0.1-0.3,0.2-0.3\r\n		C9.4,12.2,9.5,12.3,9.5,12.5z\"/>\r\n	<path id=\"XMLID_183_\" d=\"M17,12c-0.1,0-0.2-0.1-0.2-0.3c0-0.2,0.1-0.3,0.3-0.3c0.1,0,0.2,0.1,0.2,0.3C17.3,11.9,17.1,12,17,12z\"/>\r\n	<path id=\"XMLID_182_\" d=\"M15.4,10.3c-0.1,0-0.2-0.1-0.3-0.3c0-0.2,0.1-0.3,0.3-0.3c0.1,0,0.3,0.1,0.3,0.3\r\n		C15.6,10.1,15.5,10.3,15.4,10.3z\"/>\r\n	<path id=\"XMLID_181_\" d=\"M10.1,17.3c-0.1,0-0.3-0.1-0.3-0.2c0-0.1,0.1-0.3,0.3-0.3c0.2,0,0.3,0.1,0.3,0.2\r\n		C10.4,17.2,10.3,17.3,10.1,17.3z\"/>\r\n	<path id=\"XMLID_180_\" d=\"M11,10.4c0,0.1-0.1,0.3-0.2,0.3c-0.2,0-0.3-0.1-0.3-0.3c0-0.1,0.1-0.3,0.3-0.3C10.8,10.1,11,10.2,11,10.4z\r\n		\"/>\r\n	<path id=\"XMLID_179_\" d=\"M12.1,19c-0.1,0-0.3-0.1-0.3-0.2c0-0.2,0.1-0.3,0.3-0.3c0.1,0,0.3,0.1,0.2,0.2C12.4,18.8,12.2,19,12.1,19z\r\n		\"/>\r\n	<path id=\"XMLID_178_\" d=\"M6.5,6.2c0.6-0.1,1.1,0.3,1.3,0.7C7.7,6.9,7.6,6.8,7.5,6.7C7.3,6.6,7.2,6.5,7,6.4C6.9,6.3,6.7,6.3,6.5,6.2\r\n		z\"/>\r\n	<path id=\"XMLID_177_\" d=\"M17,5.8c-0.1-0.3-0.2-0.6-0.2-0.9C17,5,17.1,5.5,17,5.8z\"/>\r\n</g>\r\n</svg>\r\n', 1, 1, '', '2023-12-17 21:19:32'),
(22, 15, 'Television', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\" ><g><rect fill=\"none\" height=\"24\" width=\"24\"/></g><g><path d=\"M20 3H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h6v2H8v2h8v-2h-2v-2h6c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2\"/></g></svg>', 1, 1, '', '2023-12-18 06:03:41'),
(23, 16, 'Mountain View', '<svg height=\"24px\" viewBox=\"0 0 24 24\" ><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M14 6l-3.75 5 2.85 3.8-1.6 1.2C9.81 13.75 7 10 7 10l-6 8h22L14 6z\"/></svg>', 1, 1, '', '2023-12-18 06:06:27'),
(24, 16, 'Sea beach view', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M13.127 14.56l1.43-1.43 6.44 6.443L19.57 21zm4.293-5.73l2.86-2.86c-3.95-3.95-10.35-3.96-14.3-.02 3.93-1.3 8.31-.25 11.44 2.88zM5.95 5.98c-3.94 3.95-3.93 10.35.02 14.3l2.86-2.86C5.7 14.29 4.65 9.91 5.95 5.98zm.02-.02l-.01.01c-.38 3.01 1.17 6.88 4.3 10.02l5.73-5.73c-3.13-3.13-7.01-4.68-10.02-4.3z\"/></svg>', 1, 1, '', '2023-12-18 06:07:58'),
(25, 16, 'City View', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\" ><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M15 11V5l-3-3-3 3v2H3v14h18V11h-6zm-8 8H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V9h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm6 12h-2v-2h2v2zm0-4h-2v-2h2v2z\"/></svg>', 1, 1, '', '2023-12-18 06:09:09'),
(26, 11, 'Hot water', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><circle cx=\"7\" cy=\"6\" r=\"2\"/><path d=\"M11.15 12c-.31-.22-.59-.46-.82-.72l-1.4-1.55c-.19-.21-.43-.38-.69-.5-.29-.14-.62-.23-.96-.23h-.03C6.01 9 5 10.01 5 11.25V12H2v8c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-8H11.15zM7 20H5v-6h2v6zm4 0H9v-6h2v6zm4 0h-2v-6h2v6zm4 0h-2v-6h2v6zm-.35-14.14l-.07-.07c-.57-.62-.82-1.41-.67-2.2L18 3h-1.89l-.06.43c-.2 1.36.27 2.71 1.3 3.72l.07.06c.57.62.82 1.41.67 2.2l-.11.59h1.91l.06-.43c.21-1.36-.27-2.71-1.3-3.71zm-4 0l-.07-.07c-.57-.62-.82-1.41-.67-2.2L14 3h-1.89l-.06.43c-.2 1.36.27 2.71 1.3 3.72l.07.06c.57.62.82 1.41.67 2.2l-.11.59h1.91l.06-.43c.21-1.36-.27-2.71-1.3-3.71z\"/></svg>', 1, 1, '', '2023-12-18 06:13:19'),
(27, 11, 'Towels Included', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><g><rect fill=\"none\" height=\"24\" width=\"24\"/><path d=\"M21.6,18.2L13,11.75v-0.91c1.65-0.49,2.8-2.17,2.43-4.05c-0.26-1.31-1.3-2.4-2.61-2.7C10.54,3.57,8.5,5.3,8.5,7.5h2 C10.5,6.67,11.17,6,12,6s1.5,0.67,1.5,1.5c0,0.84-0.69,1.52-1.53,1.5C11.43,8.99,11,9.45,11,9.99v1.76L2.4,18.2 C1.63,18.78,2.04,20,3,20h9h9C21.96,20,22.37,18.78,21.6,18.2z M6,18l6-4.5l6,4.5H6z\"/></g></svg>', 1, 1, '', '2023-12-18 06:38:19'),
(28, 10, 'Bedside Lamps', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M3.55 18.54l1.41 1.41 1.79-1.8-1.41-1.41-1.79 1.8zM11 22.45h2V19.5h-2v2.95zM4 10.5H1v2h3v-2zm11-4.19V1.5H9v4.81C7.21 7.35 6 9.28 6 11.5c0 3.31 2.69 6 6 6s6-2.69 6-6c0-2.22-1.21-4.15-3-5.19zm5 4.19v2h3v-2h-3zm-2.76 7.66l1.79 1.8 1.41-1.41-1.8-1.79-1.4 1.4z\"/></svg>', 1, 1, '', '2023-12-18 06:42:50'),
(29, 3, 'Breakfast (Extra)', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0V0z\" fill=\"none\"/><path d=\"M20 3H4v10c0 2.21 1.79 4 4 4h6c2.21 0 4-1.79 4-4v-3h2c1.11 0 2-.9 2-2V5c0-1.11-.89-2-2-2zm0 5h-2V5h2v3zM4 19h16v2H4z\"/></svg>', 1, 1, '', '2023-12-18 06:45:12'),
(30, 1, 'Storage Facility', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><rect fill=\"none\" height=\"24\" width=\"24\"/><g><path d=\"M17,6h-2V3c0-0.55-0.45-1-1-1h-4C9.45,2,9,2.45,9,3v3H7C5.9,6,5,6.9,5,8v11c0,1.1,0.9,2,2,2c0,0.55,0.45,1,1,1 c0.55,0,1-0.45,1-1h6c0,0.55,0.45,1,1,1c0.55,0,1-0.45,1-1c1.1,0,2-0.9,2-2V8C19,6.9,18.1,6,17,6z M9.5,18H8V9h1.5V18z M12.75,18 h-1.5V9h1.5V18z M13.5,6h-3V3.5h3V6z M16,18h-1.5V9H16V18z\"/></g></svg>', 1, 1, '', '2023-12-18 06:50:25'),
(31, 15, 'Balcony', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><rect fill=\"none\" height=\"24\" width=\"24\"/><path d=\"M10,10v2H8v-2H10z M16,12v-2h-2v2H16z M21,14v8H3v-8h1v-4c0-4.42,3.58-8,8-8s8,3.58,8,8v4H21z M7,16H5v4h2V16z M11,16H9v4h2 V16z M11,4.08C8.16,4.56,6,7.03,6,10v4h5V4.08z M13,14h5v-4c0-2.97-2.16-5.44-5-5.92V14z M15,16h-2v4h2V16z M19,16h-2v4h2V16z\"/></svg>', 1, 1, '', '2023-12-18 06:53:16'),
(32, 11, 'Shower', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><g><path d=\"M0,0h24v24H0V0z\" fill=\"none\"/></g><g><circle cx=\"8\" cy=\"17\" r=\"1\"/><circle cx=\"12\" cy=\"17\" r=\"1\"/><circle cx=\"16\" cy=\"17\" r=\"1\"/><path d=\"M13,5.08V3h-2v2.08C7.61,5.57,5,8.47,5,12v2h14v-2C19,8.47,16.39,5.57,13,5.08z\"/><circle cx=\"8\" cy=\"20\" r=\"1\"/><circle cx=\"12\" cy=\"20\" r=\"1\"/><circle cx=\"16\" cy=\"20\" r=\"1\"/></g></svg>', 1, 1, '', '2023-12-18 06:54:05'),
(33, 1, 'Common hangout area', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0zm21.02 19c0 1.1-.9 2-2 2h-14c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v14z\" fill=\"none\"/><path d=\"M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM7.5 18c-.83 0-1.5-.67-1.5-1.5S6.67 15 7.5 15s1.5.67 1.5 1.5S8.33 18 7.5 18zm0-9C6.67 9 6 8.33 6 7.5S6.67 6 7.5 6 9 6.67 9 7.5 8.33 9 7.5 9zm4.5 4.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5 4.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm0-9c-.83 0-1.5-.67-1.5-1.5S15.67 6 16.5 6s1.5.67 1.5 1.5S17.33 9 16.5 9z\"/></svg>', 1, 1, '', '2023-12-18 06:55:53'),
(34, 17, 'UPI Payment Accepted', '<svg enable-background=\"new 0 0 24 24\" height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><rect fill=\"none\" height=\"24\" width=\"24\"/><path d=\"M9.5,6.5v3h-3v-3H9.5 M11,5H5v6h6V5L11,5z M9.5,14.5v3h-3v-3H9.5 M11,13H5v6h6V13L11,13z M17.5,6.5v3h-3v-3H17.5 M19,5h-6v6 h6V5L19,5z M13,13h1.5v1.5H13V13z M14.5,14.5H16V16h-1.5V14.5z M16,13h1.5v1.5H16V13z M13,16h1.5v1.5H13V16z M14.5,17.5H16V19h-1.5 V17.5z M16,16h1.5v1.5H16V16z M17.5,14.5H19V16h-1.5V14.5z M17.5,17.5H19V19h-1.5V17.5z M22,7h-2V4h-3V2h5V7z M22,22v-5h-2v3h-3v2 H22z M2,22h5v-2H4v-3H2V22z M2,2v5h2V4h3V2H2z\"/></svg>', 1, 1, '', '2023-12-18 06:57:46'),
(35, 1, 'Cafe', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.2-1.1-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41L13.41 13l1.47-1.47z\"/></svg>', 1, 1, '', '2023-12-18 07:00:32'),
(36, 1, 'Parking (private)', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M13 3H6v18h4v-6h3c3.31 0 6-2.69 6-6s-2.69-6-6-6zm.2 8H10V7h3.2c1.1 0 2 .9 2 2s-.9 2-2 2z\"/></svg>', 1, 1, '', '2023-12-18 07:01:28'),
(37, 1, 'Water Dispenser', '<svg height=\"24px\" viewBox=\"0 0 24 24\" width=\"24px\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M3 2l2.01 18.23C5.13 21.23 5.97 22 7 22h10c1.03 0 1.87-.77 1.99-1.77L21 2H3zm9 17c-1.66 0-3-1.34-3-3 0-2 3-5.4 3-5.4s3 3.4 3 5.4c0 1.66-1.34 3-3 3zm6.33-11H5.67l-.44-4h13.53l-.43 4z\"/></svg>', 1, 1, '', '2023-12-18 07:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `sys_amenities_cat`
--

CREATE TABLE `sys_amenities_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_amenities_cat`
--

INSERT INTO `sys_amenities_cat` (`id`, `name`, `addOn`, `status`) VALUES
(1, 'Accommodations', '2023-12-17 20:55:18', 1),
(2, 'Communication', '2023-12-17 20:55:18', 1),
(3, 'Dining', '2023-12-17 20:55:47', 1),
(4, 'Health and Wellness', '2023-12-17 20:55:47', 1),
(5, 'Convenience and Services', '2023-12-17 20:56:02', 1),
(6, 'Transportation', '2023-12-17 20:56:02', 1),
(7, 'Entertainment', '2023-12-17 20:56:24', 1),
(8, 'Family-Friendly', '2023-12-17 20:56:24', 1),
(9, 'Pet-Friendly', '2023-12-17 20:57:49', 1),
(10, 'In-Room', '2023-12-17 21:01:23', 1),
(11, 'Bathroom ', '2023-12-17 21:01:23', 1),
(12, 'Climate Control', '2023-12-17 21:02:13', 1),
(13, 'Security and Safety', '2023-12-17 21:02:13', 1),
(14, 'Work and Business', '2023-12-17 21:02:58', 1),
(15, 'Accessibility Features', '2023-12-17 21:03:36', 1),
(16, 'View', '2023-12-18 06:05:20', 1),
(17, 'Payment', '2023-12-18 06:57:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_banktypemethod`
--

CREATE TABLE `sys_banktypemethod` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `addBy` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_banktypemethod`
--

INSERT INTO `sys_banktypemethod` (`id`, `pid`, `name`, `status`, `addBy`, `addOn`) VALUES
(1, 0, 'Cheque', 1, '1', '2022-06-24 00:50:15'),
(2, 0, 'Credit card', 1, '1', '2022-06-24 00:50:59'),
(3, 0, 'Debit card', 1, '1', '2022-06-24 00:50:59'),
(4, 0, 'NEFT/RTGS', 1, '1', '2022-06-24 00:51:22'),
(5, 0, 'UPI', 1, '1', '2022-06-24 00:51:49'),
(6, 0, 'Cash', 1, '1', '2022-07-07 12:50:49'),
(7, 0, 'Payment Gateway', 1, '1', '2023-08-15 16:23:08'),
(8, 0, 'Other', 1, '', '2024-01-15 00:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `sys_billing_mode`
--

CREATE TABLE `sys_billing_mode` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `add_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sys_billing_mode`
--

INSERT INTO `sys_billing_mode` (`id`, `name`, `add_on`) VALUES
(1, 'Guest', '0000-00-00 00:00:00'),
(2, 'Complementary', '0000-00-00 00:00:00'),
(3, 'Company', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sys_blog_cat`
--

CREATE TABLE `sys_blog_cat` (
  `id` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bgClr` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `clr` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sys_blog_cat`
--

INSERT INTO `sys_blog_cat` (`id`, `name`, `bgClr`, `clr`) VALUES
(1, 'Sightseeing', NULL, NULL),
(2, 'Dining', NULL, NULL),
(3, 'Wellness', NULL, NULL),
(4, 'News', NULL, NULL),
(5, 'Arts & Culture', NULL, NULL),
(6, 'Nature', NULL, NULL),
(7, 'Event', NULL, NULL),
(8, 'Uncategorized', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_bookingsource`
--

CREATE TABLE `sys_bookingsource` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `img` varchar(250) NOT NULL,
  `addBy` varchar(150) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_bookingsource`
--

INSERT INTO `sys_bookingsource` (`id`, `hotelId`, `name`, `status`, `img`, `addBy`, `addOn`) VALUES
(1, '', 'Walk-In', 1, 'pms.png', '0', '2022-06-07 20:05:19'),
(2, '', 'Booking Engine', 1, 'diretBooking.png', '0', '2022-06-07 20:04:27'),
(4, '', 'Agoda', 1, 'agoda.png', '0', '2022-06-07 20:04:27'),
(5, '', 'Airbnb', 1, 'airbnb.png', '', '2024-02-03 21:00:14'),
(6, '', 'MakeMyTrip', 1, 'makeMyTrip.png', '', '2024-02-03 21:00:14'),
(7, '', 'Booking.com', 1, 'bookingcom.png', '', '2024-03-19 09:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `sys_booking_attr`
--

CREATE TABLE `sys_booking_attr` (
  `id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `str` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `formName` varchar(250) NOT NULL,
  `summary` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_booking_attr`
--

INSERT INTO `sys_booking_attr` (`id`, `type`, `str`, `name`, `formName`, `summary`) VALUES
(1, NULL, 'advancePay', 'Advance Pay', '', 0),
(2, 'f', 'pckupDrop', 'Pickup And Drop', 'bookingExtra', 1),
(3, 'p', 'partialPayment', 'Partial Payment', 'bookingAttribute', 1),
(4, NULL, 'payByRoom', 'Pay By Room', 'bookingAttribute', 1),
(5, NULL, 'payAtHotel', 'Pay At Hotel', 'bookingAttribute', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_booking_type`
--

CREATE TABLE `sys_booking_type` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `color` varchar(50) NOT NULL,
  `bgClr` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_booking_type`
--

INSERT INTO `sys_booking_type` (`id`, `name`, `color`, `bgClr`, `status`) VALUES
(1, 'Confirm Booking', '', '', 1),
(2, 'Unconfirmed Booking Inquiry', '', '', 1),
(3, 'Online Failed Booking', '', '', 1),
(4, 'Hold Confirm Booking', '', '', 1),
(5, 'Hold Unconfirm Booking', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_check_in_status`
--

CREATE TABLE `sys_check_in_status` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL,
  `bg` varchar(250) DEFAULT '',
  `status` int(11) DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_check_in_status`
--

INSERT INTO `sys_check_in_status` (`id`, `name`, `color`, `bg`, `status`, `addOn`) VALUES
(1, 'Reservation', '#ffffff', '#008000', 1, '2022-07-05 02:08:26'),
(2, 'Checked In', '#ffffff', '#eb0000', 1, '2022-07-05 02:08:26'),
(3, 'Checked Out', '#ffffff', '#3366ff', 1, '2022-07-05 02:08:41'),
(4, 'Return', '', '', 0, '2024-01-29 20:02:25'),
(5, 'Cancel', '#ffffff', '#ad0000', 1, '2024-01-29 20:02:43'),
(6, 'No show', '#ffffff', '#ddad00', 1, '2024-02-23 17:36:42'),
(7, 'Void', '#ffffff', '#ad0000', 1, '2024-02-23 17:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `sys_coupon_type`
--

CREATE TABLE `sys_coupon_type` (
  `id` int(11) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_coupon_type`
--

INSERT INTO `sys_coupon_type` (`id`, `icon`, `name`) VALUES
(1, '', 'Coupons'),
(2, '', 'Offers'),
(3, '', 'Counter'),
(4, '', 'Flash Notification');

-- --------------------------------------------------------

--
-- Table structure for table `sys_currency`
--

CREATE TABLE `sys_currency` (
  `id` int(11) NOT NULL,
  `country` varchar(150) NOT NULL,
  `locales` varchar(50) NOT NULL,
  `shortCode` varchar(150) NOT NULL,
  `valueInRs` varchar(150) NOT NULL,
  `img` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_currency`
--

INSERT INTO `sys_currency` (`id`, `country`, `locales`, `shortCode`, `valueInRs`, `img`, `icon`, `addOn`) VALUES
(1, 'India', 'en-IN', 'INR', '1', 'india.png', '<i class=\"fas fa-rupee-sign\"></i>', '2023-08-15 19:56:33'),
(2, 'United States', 'en-Us', 'USD', '0.012', 'us.png', '<i class=\"fas fa-dollar-sign\"></i>', '2023-08-15 19:56:33'),
(3, 'Euro', 'en-DE', 'EUR', '0.011', 'euro.png', '<i class=\"fas fa-euro-sign\"></i>', '2023-08-15 20:06:22'),
(4, 'British', 'en-GB', 'GBP', '0.0094', 'british.png', '<i class=\"fas fa-pound-sign\"></i>', '2023-08-15 20:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `sys_feature`
--

CREATE TABLE `sys_feature` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_feature`
--

INSERT INTO `sys_feature` (`id`, `name`, `icon`, `addOn`) VALUES
(1, 'Bathroom', '', '2023-08-19 13:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_floor_plan`
--

CREATE TABLE `sys_floor_plan` (
  `id` int(11) NOT NULL,
  `shortCode` varchar(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `clr` varchar(50) NOT NULL,
  `bg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_folio_status`
--

CREATE TABLE `sys_folio_status` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `clr` varchar(250) NOT NULL,
  `bg` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_folio_status`
--

INSERT INTO `sys_folio_status` (`id`, `name`, `clr`, `bg`) VALUES
(1, 'Reservation', '', ''),
(2, 'Unsettled', '#58151c', '#f1aeb5'),
(3, 'Settled ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_guestidproof`
--

CREATE TABLE `sys_guestidproof` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_guestidproof`
--

INSERT INTO `sys_guestidproof` (`id`, `name`, `status`, `addOn`) VALUES
(1, 'Aadhar Card', 1, '2023-10-11 16:34:29'),
(2, 'Pan Card', 1, '2024-05-22 23:52:39'),
(3, 'Voter Id', 1, '2024-05-22 23:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `sys_guest_communication`
--

CREATE TABLE `sys_guest_communication` (
  `id` int(11) NOT NULL,
  `accessCode` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_guest_communication`
--

INSERT INTO `sys_guest_communication` (`id`, `accessCode`, `name`) VALUES
(1, 'phoneCall', 'Phone Call'),
(2, 'whatsapp', 'Whatsapp'),
(3, 'eMail', 'E-Mail'),
(4, 'reservationCounter', 'Reservation Counter');

-- --------------------------------------------------------

--
-- Table structure for table `sys_kotcategory`
--

CREATE TABLE `sys_kotcategory` (
  `id` int(11) NOT NULL,
  `accessKey` varchar(150) NOT NULL,
  `color` varchar(250) DEFAULT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_kotcategory`
--

INSERT INTO `sys_kotcategory` (`id`, `accessKey`, `color`, `name`) VALUES
(2, 'veg', '#008000', 'Veg'),
(3, 'non-veg', '#ff0000', 'Non-veg');

-- --------------------------------------------------------

--
-- Table structure for table `sys_kotservice`
--

CREATE TABLE `sys_kotservice` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bdTable` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_kotservice`
--

INSERT INTO `sys_kotservice` (`id`, `hotelId`, `name`, `bdTable`, `status`, `addOn`) VALUES
(1, '', 'Table', 'kottable', 1, '2022-12-05 23:25:22'),
(2, '', 'Room', 'room', 1, '2022-12-05 23:25:33'),
(3, '', 'Service List', 'serviceList', 1, '2022-12-05 23:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `sys_kot_delivery_service`
--

CREATE TABLE `sys_kot_delivery_service` (
  `id` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sys_kot_delivery_service`
--

INSERT INTO `sys_kot_delivery_service` (`id`, `name`, `status`) VALUES
(1, 'Zomato', 1),
(2, 'Swiggy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_kot_meal_time`
--

CREATE TABLE `sys_kot_meal_time` (
  `id` int(11) NOT NULL,
  `time` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_kot_meal_time`
--

INSERT INTO `sys_kot_meal_time` (`id`, `time`, `name`, `icon`) VALUES
(1, '7-11', 'Breakfast', ''),
(2, '11-15', 'Lunch', ''),
(3, '16-19', 'Snack', ''),
(4, '19-24', 'Dinner', '');

-- --------------------------------------------------------

--
-- Table structure for table `sys_layout`
--

CREATE TABLE `sys_layout` (
  `id` int(11) NOT NULL,
  `layoutId` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `orderNo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_layout`
--

INSERT INTO `sys_layout` (`id`, `layoutId`, `content`, `orderNo`) VALUES
(1, 1, NULL, 0),
(2, 2, NULL, 0),
(3, 3, NULL, 0),
(4, 4, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_layout_content`
--

CREATE TABLE `sys_layout_content` (
  `id` int(11) NOT NULL,
  `accessKey` varchar(250) DEFAULT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_layout_content`
--

INSERT INTO `sys_layout_content` (`id`, `accessKey`, `Title`, `icon`, `content`) VALUES
(1, 'headerBe', 'Header Be', NULL, '<section id=\"heroSec\">\n            <div class=\"container\">\n                <div class=\"row\">\n                    <div class=\"col-md-9\">\n                        <div class=\"aboutContent\">\n                            <img src=\"<?= getFontImg(hotelDetail()[\'darklogo\'], \'logo\') ?>\" alt=\"<?= hotelDetail()[\'hotelName\'] . \' logo image\' ?>\" title=\"<?= hotelDetail()[\'hotelName\'] . \' Logo\' ?>\" loading=\"lazy\">\n                            <h1><?= hotelDetail()[\'hotelName\'] ?></h1>\n                            <p><?= (strlen(hotelDetail()[\'description\']) > 250) ? substr(hotelDetail()[\'description\'], 0, 250) . \' ...\' : hotelDetail()[\'description\'] ?> <button class=\"linkHover\" id=\"aboutContentReadBtn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#popUpCon\">Read More</button></p>\n                            <button class=\"heroBtn\">Book Now</button>\n                        </div>\n                    </div>\n                    <div class=\"col-md-3\">\n                        <div class=\"multiImg\">\n                            <div class=\"roomimg\">\n                                <a href=\"image/hotel2.jpg\" data-fancybox=\"gallery\" loading=\"lazy\">\n                                    <img src=\"image/hotel2.jpg\" alt=\"\">\n                                </a>\n                            </div>\n                            <div class=\" roomimg\">\n                                <a href=\"image/hotel3.jpg\" data-fancybox=\"gallery\" loading=\"lazy\">\n                                    <img src=\"image/hotel3.jpg\" alt=\"\">\n                                </a>\n                            </div>\n                            <div class=\" roomimg\">\n                                <a href=\"image/hotel4.jpg\" data-fancybox=\"gallery\" loading=\"lazy\">\n                                    <img src=\"image/hotel4.jpg\" alt=\"\">\n                                </a>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </section>'),
(2, 'bookingPageBe', 'Booking Page', NULL, '<section id=\"bookingpag\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-xl-8 col-lg-7 col-md-12 col-sm-12\">\r\n\r\n                        <div class=\"row align-items-end\">\r\n                            <div class=\"col-sm-6 col-xs-12 mb-2\">\r\n                                <div class=\"heading\">\r\n                                    <h3>Book your stay</h3>\r\n                                    <span>Select from a range of beautiful rooms</span>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"col-sm-6 col-xs-12 mb-2\">\r\n                                <div class=\"calendar\">\r\n                                    <input id=\"checkInDataPick\" type=\"text\" value=\" <?= date(\'d/m/Y\', strtotime($_SESSION[\'book_checkin\'])) ?> - <?= date(\'d/m/Y\', strtotime($_SESSION[\'book_checkout\'])) ?>\">\r\n                                    <label for=\"checkInDataPick\" id=\"checkincheckoutInput\">\r\n                                        <div class=\"svgIcon\">\r\n                                            <svg class=\"op5\" xmlns=\"http://www.w3.org/2000/svg\" height=\"1em\" viewBox=\"0 0 448 512\">\r\n                                                <path d=\"M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z\" />\r\n                                            </svg>\r\n                                        </div>\r\n                                        <div class=\"calendarDisplay\">\r\n                                            <div id=\"calendar\"></div>\r\n                                        </div>\r\n                                    </label>\r\n\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                        <ul id=\"roomListCon\"> </ul>\r\n\r\n\r\n\r\n                    </div>\r\n\r\n                    <div class=\"col-xl-4 col-lg-5 col-md-12 col-sm-12\" id=\"summarypageCol\">\r\n                        <div class=\"summarypage\">\r\n                            <div class=\"summaryTitle\">\r\n                                <h3>Summary</h3>\r\n\r\n                            </div>\r\n                            <div class=\"summaryContent\">\r\n                                <svg id=\"icon_bookinCalenderCon\">\r\n                                    <use href=\"#icon_bookinCalender\"></use>\r\n                                </svg>\r\n                            </div>\r\n\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div class=\"comformbooking\">\r\n\r\n                        <h2><span class=\"material-symbols-outlined backBtn\">arrow_back</span> Confirm your booking</h2>\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-8\">\r\n                                <div class=\"bookingform\">\r\n                                    <div class=\"guestinformation\">\r\n                                        <div class=\"details\">\r\n                                            <p>Guest Information</p>\r\n                                            <p><i class=\"material-symbols-outlined\">expand_more</i></p>\r\n                                        </div>\r\n                                        <div class=\"guestForm\">\r\n                                            <form action=\"/action_page.php\">\r\n                                                <label for=\"fname\">Name</label>\r\n                                                <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Your name..\">\r\n\r\n                                                <label for=\"fname\">Email</label>\r\n                                                <input type=\"text\" id=\"email\" name=\"email\" placeholder=\"Your name Email..\">\r\n\r\n                                                <label for=\"country\">Gender</label>\r\n                                                <select id=\"Gender\" name=\"Gender\">\r\n                                                    <option value=\"australia\">--</option>\r\n                                                    <option value=\"australia\">Femal</option>\r\n                                                    <option value=\"canada\">Male</option>\r\n                                                    <option value=\"usa\">Other</option>\r\n                                                </select>\r\n\r\n                                                <label for=\"lname\">Number</label>\r\n                                                <input type=\"text\" id=\"number\" name=\"number\" placeholder=\"Number\">\r\n\r\n                                                <label for=\"subject\">Address</label>\r\n                                                <textarea id=\"subject\" name=\"subject\" placeholder=\"Write address\" style=\"height:100px\"></textarea>\r\n                                                <div class=\"addpeople\">\r\n                                                    <h3>Not going slow? <button>Add other people details</button>\r\n\r\n                                                    </h3>\r\n                                                </div>\r\n\r\n\r\n\r\n                                            </form>\r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"polocy_form\">\r\n                                        <div class=\"details\">\r\n                                            <p>Property Policy</p>\r\n                                            <p><i class=\"material-symbols-outlined\">expand_more</i></p>\r\n                                        </div>\r\n                                        <div class=\"policyinfomation\">\r\n                                            <p>-Guests are required to pay a 21% advance at the time of booking itself. The entire balance\r\n                                                needs to be cleared upon arrival at the property during check-in.</p>\r\n                                            <p>-Our standard check-in time is 12 PM and the standard check-out time is 10 AM. Early\r\n                                                check-in and late check-out requests are subject to availability, and may also attract an\r\n                                                additional fee at the property\'s discretion.</p>\r\n                                            <p>-We strictly DO NOT allow a group of more than 6 people. In case of a group of 4 or more,\r\n                                                you might be purposefully allotted different dorm rooms. Further, if the group behaviour is\r\n                                                deemed unfit at the property, the Zostel Property Manager, upon subjective evaluation,\r\n                                                retains the full right to take required action which may also result in an on-spot\r\n                                                cancellation without refunds.</p>\r\n                                            <p>-Children below 18 years of age are not permitted entry/stay at any of our hostels, with or\r\n                                                without guardians. We do not recommend families.</p>\r\n                                            <p>-We only accept a government ID as valid identification proof. No local IDs shall be\r\n                                                accepted at the time of check-in.</p>\r\n                                            <p>-Guests are not permitted to bring outsiders inside the hostel campus.</p>\r\n                                            <p>-We believe in self-help and do not provide luggage assistance or room services.</p>\r\n                                            <p>-Drugs and any substance abuse is strictly banned inside and around the property.</p>\r\n                                            <p>-Alcohol consumption is permitted at the premises as per the property’s discretion and local\r\n                                                laws. Please reach out to the property prior to your arrival to confirm the same.</p>\r\n                                            <p>-Right to admission reserved.&nbsp;</p>\r\n\r\n                                        </div>\r\n\r\n\r\n                                    </div>\r\n                                    <div class=\"cancel_form\">\r\n                                        <div class=\"details\">\r\n                                            <p>Cancellation Policy</p>\r\n                                            <p><i class=\"material-symbols-outlined\">expand_more</i></p>\r\n                                        </div>\r\n                                        <div class=\"cancelinformation\">\r\n\r\n                                            <p>-We understand that sometimes plans change. Hence, to make it light on your pocket, we are\r\n                                                only charging a 21% advance, which is on a non-refundable basis.</p>\r\n\r\n                                            <p>-21% advance payment is non-refundable at all times, as stated above.</p>\r\n                                            <p>-If you have paid any amount over this 21%, it stands applicable for a credit only if the\r\n                                                cancellation is informed 7 days or more in advance. You will be able to avail the credited\r\n                                                amount for any future booking at any of our properties.</p>\r\n                                            <p>-If informed within 7 days of the standard check-in time (12 pm), the amount shall be\r\n                                                adjusted against the cancellation fee.</p>\r\n\r\n                                            <p>-For any other queries, please reach out to us at <a href=\"mailto:support@retrod.com\" rel=\"noopener noreferrer\" target=\"_blank\">support@retrod.com</a>.</p>\r\n\r\n                                        </div>\r\n\r\n\r\n                                    </div>\r\n\r\n                                </div>\r\n\r\n\r\n\r\n\r\n\r\n                            </div>\r\n                            <div class=\"col-md-4\">\r\n                                <div class=\"reserve_page\">\r\n                                    <h3>Summary</h3>\r\n                                    <p>9 nights <span>starting from</span> Wed 21 Jun, 2023</p>\r\n                                    <div class=\"total_bill\">\r\n\r\n                                        <div class=\"bad-name list dFlex aic jcsb\">\r\n\r\n                                            <div class=\"room_content\">\r\n                                                <img src=\"image/hotel1.jpg\" alt=\"\">\r\n                                                <div class=\"textArea\">\r\n                                                    <p> <strong>6 Bed Mixed Dorm x 2</strong></p>\r\n                                                    <p> <strong>₹1,098 x 9 nights</strong></p>\r\n                                                </div>\r\n                                            </div>\r\n\r\n                                            <p><strong>₹9,882</strong></p>\r\n\r\n                                        </div>\r\n\r\n                                        <div class=\"tax list dFlex aic jcsb\">\r\n                                            <p><strong>Tax</strong></p>\r\n                                            <p><strong>₹1,186</strong></p>\r\n\r\n                                        </div>\r\n\r\n                                        <div class=\"total_tax list dFlex aic jcsb\">\r\n                                            <p><strong>Total (tax incl.)</strong></p>\r\n                                            <p><strong>₹11,068</strong></p>\r\n\r\n                                        </div>\r\n\r\n                                        <div class=\"payable_amount list dFlex aic jcsb\">\r\n                                            <p><strong>Payable Now</strong></p>\r\n                                            <p><strong>₹2,324</strong></p>\r\n                                        </div>\r\n\r\n                                        <div class=\"form-check\">\r\n                                            <input class=\"form-check-input position-static\" type=\"checkbox\" id=\"blankCheckbox\" value=\"option1\">\r\n\r\n                                            <label for=\"vehicle1\"> I acknowledge and accept the terms and conditions mentioned in the Property Policy & Cancellation Policy. </label>\r\n                                        </div>\r\n                                        <button class=\"reserveBtn\">Reserve</button>\r\n\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n\r\n            </div>\r\n\r\n            <section id=\"reviewCon\">\r\n\r\n            </section>\r\n\r\n        </section>'),
(3, 'contactDetailsBe', 'Contact Details', NULL, '<section id=\"contactdetails\">\r\n            <div class=\"container-fluid\">\r\n                <div class=\"row\">\r\n                    <h2>Locate Us</h2>\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-5\">\r\n                            <div class=\"location\">\r\n                                <span><strong>Address:</strong>\r\n                                    <div class=\"adress\">\r\n                                        <p><?= hotelDetail(HotelId)[\'address\'] ?></p>\r\n                                    </div>\r\n                                </span>\r\n                                <span class=\"con_num\"><strong>Contact:-</strong>\r\n                                    <?php\r\n                                    foreach (explode(\',\', hotelDetail(HotelId)[\'hotelPhoneNum\']) as $numList) {\r\n                                        echo \"<a target=\'_blank\' href=\'tel:$numList\'>$numList</a>\";\r\n                                    }\r\n                                    ?>\r\n\r\n                                </span>\r\n                                <?php\r\n                                if (hotelDetail(HotelId)[\'waNum\'] != null) {\r\n                                    $waNum = hotelDetail(HotelId)[\'waNum\'];\r\n                                    echo \'<div class=\"whatsapplink\">\r\n                                                <a target=\"_blank\" href=\"https://wa.me/\' . $waNum . \'\"><i class=\"fab fa-whatsapp\"></i> WhatsApp</a>\r\n                                            </div>\';\r\n                                }\r\n                                ?>\r\n                                <div class=\"distanceRecord\">\r\n                                    <div class=\"accordian\">\r\n                                        <div class=\"accordian_head\">\r\n                                            <div class=\"accordian_toggler\">+</div>\r\n                                            <span class=\"accordian_title\">From the Train Station</span>\r\n                                        </div>\r\n                                        <div class=\"accordian_body\">\r\n                                            <p class=\"accordian_description\">\r\n                                                <?= hotelDetail(HotelId)[\'distanceTrainStation\'] ?>\r\n                                            </p>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div class=\"accordian\">\r\n                                        <div class=\"accordian_head\">\r\n                                            <div class=\"accordian_toggler\">+</div>\r\n                                            <span class=\"accordian_title\">From the Bus Stand</span>\r\n                                        </div>\r\n                                        <div class=\"accordian_body\">\r\n                                            <p class=\"accordian_description\">\r\n                                                <?= hotelDetail(HotelId)[\'distanceBusStand\'] ?>\r\n                                            </p>\r\n                                        </div>\r\n                                    </div>\r\n                                    <div class=\"accordian\">\r\n                                        <div class=\"accordian_head\">\r\n                                            <div class=\"accordian_toggler\">+</div>\r\n                                            <span class=\"accordian_title\">From the Airport</span>\r\n                                        </div>\r\n                                        <div class=\"accordian_body\">\r\n                                            <p class=\"accordian_description\">\r\n                                                <?= hotelDetail(HotelId)[\'distanceAirport\'] ?>\r\n                                            </p>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-md-7\">\r\n                            <div class=\"map\" id=\"hotelLocationMap\"></div>\r\n\r\n                        </div>\r\n\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n        </section>'),
(4, 'moreDetailsBe', 'More Details', NULL, '<section id=\"moreDetail\">\r\n            <div class=\"container\">\r\n                <div class=\"title\">\r\n                    <h2>Important Information</h2>\r\n                </div>\r\n                <div class=\"wrapper\">\r\n                    <div class=\"accordion\">\r\n                        <?php\r\n\r\n                            $infoArry = getPropertyInfoData(HotelId,\'information\');\r\n                            foreach($infoArry as $item){\r\n                                $title = $item[\'title\'];\r\n                                $description = $item[\'description\'];\r\n\r\n                                echo \'\r\n                                        <div class=\"accordion-item\">\r\n                                            <button id=\"accordion-button-2\" aria-expanded=\"false\"><span class=\"accordion-title\">\'.$title.\'</span><span class=\"icon\" aria-hidden=\"true\"></span></button>\r\n                                            <div class=\"accordion-content\">\r\n                                                \'.$description.\'\r\n                                            </div>\r\n                                        </div>\r\n                                \';\r\n                            }\r\n                        \r\n                        ?>\r\n                    </div>\r\n\r\n                </div>\r\n\r\n                <div class=\"title\">\r\n                    <h2>Policies</h2>\r\n                </div>\r\n                <div class=\"wrapper\">\r\n                    <div class=\"accordion\">\r\n                        <?php\r\n\r\n                            $infoArry = getPropertyInfoData(HotelId,\'policies\');\r\n                            foreach($infoArry as $item){\r\n                                $title = $item[\'title\'];\r\n                                $description = $item[\'description\'];\r\n\r\n                                echo \'\r\n                                        <div class=\"accordion-item\">\r\n                                            <button id=\"accordion-button-2\" aria-expanded=\"false\"><span class=\"accordion-title\">\'.$title.\'</span><span class=\"icon\" aria-hidden=\"true\"></span></button>\r\n                                            <div class=\"accordion-content\">\r\n                                                \'.$description.\'\r\n                                            </div>\r\n                                        </div>\r\n                                \';\r\n                            }\r\n                        \r\n                        ?>\r\n                    </div>\r\n\r\n                </div>\r\n\r\n            </div>\r\n        </section>');

-- --------------------------------------------------------

--
-- Table structure for table `sys_mailinvoice`
--

CREATE TABLE `sys_mailinvoice` (
  `id` int(11) NOT NULL,
  `reservationGuest` text DEFAULT NULL,
  `checkinGuest` text DEFAULT NULL,
  `checkoutGuest` text DEFAULT NULL,
  `noShow` text DEFAULT NULL,
  `payment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_mailinvoice`
--

INSERT INTO `sys_mailinvoice` (`id`, `reservationGuest`, `checkinGuest`, `checkoutGuest`, `noShow`, `payment`) VALUES
(1, '<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\"> \r\n        Welcome to <b>{brand}</b>! \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">We\'re thrilled to have you join our family, and we\'re dedicated to making your stay extraordinary. From the moment you step through our doors, your comfort and satisfaction are our top priorities.</p>\r\n    \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">Enjoy our welcoming smiles, meticulous attention, and peaceful atmosphere. Whether for business or leisure, your experience is customized just for you.</p>\r\n\r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\"> Your journey with us begins now. Relax, unwind, and let us take care of the rest.</p>\r\n\r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\"> See you soon!</p>\r\n    \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">Your Booking Details:</p>\r\n    \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">Check-in on <b>{checkin}</b>. (Booking Date: <small>{bookingTime}</small>)</p>\r\n    \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">Check-out on <b>{checkOut}</b>.</p>\r\n    \r\n    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">Notes</p>\r\n    <ul>\r\n        <li style=\"text-align:left\">This receipt serves as proof of your reservation..</li>\r\n        <li style=\"text-align:left\">Please present this receipt upon check-in at the hotel.</li>\r\n        <li style=\"text-align:left\">In case of any changes to your reservation, kindly contact us at the provided phone number or email.</li>\r\n    </ul>\r\n    \r\n    <p style=\"text-align:left\">Thank you for choosing <b>{brand}</b>. We look forward to welcoming you to a comfortable and enjoyable stay!</p>\r\n    <p style=\"text-align:left\">Please retain this receipt for your records.</p>\r\n    \r\n    <p style=\"text-align:left\">Regards,</p>\r\n    <p style=\"text-align:left\">{brand}</p>', '<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    We\'re thrilled to have you stay with us at <b>{brand}</b>! Your comfort and satisfaction are our top priorities, and we\r\n    want to ensure a smooth check-in process for you.</p>\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Check-In Details:</p>\r\n<ul style=\"text-align:left\">\r\n    <li>Check-in Date: <b>{checkin}</b></li>\r\n    <li>Check-in Time: <b>{checkinTime}</b></li>\r\n    <li>Room number: <b>{roomNum}</b></li>\r\n</ul>\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    We hope you have a wonderful and memorable stay with us. If you have any questions or need assistance during your stay, our team is here to help.</p>\r\n\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Thank you for choosing <b>{brand}</b></p>', '<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    We hope you had a delightful stay at <b>{brand}</b>! It has been our pleasure to have you as our guest, and we sincerely appreciate your choosing us for your accommodation needs.</p>\r\n<h4 style=\"font-family:Avenir Next,Arial,sans-serif;line-height:28px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Check-Out Details:</h4>\r\n<ul style=\"text-align:left\">\r\n    <li>Check-out Date: <b>{checkOut}</b></li>\r\n    <li>Check-out Time: <b>{checkOutTime}</b></li>\r\n</ul>\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Please ensure that all personal belongings are collected.</p>\r\n\r\n<h4 style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Feedback:</h4>\r\n\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    We value your feedback and would love to hear about your experience with us. Your insights are essential in helping us enhance our services. Feel free to share your thoughts with us at </p>\r\n\r\n{reviewButton}\r\n\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Wishing you safe travels as you continue your journey. If your travels bring you back to {city}, we would be honored to host you again.</p>\r\n\r\n<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n    Thank you for choosing {brand}. We hope to welcome you back in the future!</p>', NULL, '<p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n                                                                        <b>\'.$brand.\'</b> wanted to express our sincere gratitude for trusting us as your partner. We are honored and committed to delivering excellent results.</p>\r\n                                                                    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n                                                                    We look forward to a <b>successful collaboration</b> and we are excited about the journey ahead.</p>\r\n                                                                    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n                                                                    Now let’s take a step forward in setting up your properly by adding rooms to your online booking engine <b>\'.$brand.\'</b>.</p>\r\n\r\n                                                                    <p style=\"font-family:Avenir Next,Arial,sans-serif;line-height:25px; font-size:16px;color:#000;text-align:left;margin:0 0 15px;padding:0\">\r\n                                                                    Here are the following steps to do it.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `sys_payment_getway`
--

CREATE TABLE `sys_payment_getway` (
  `id` int(11) NOT NULL,
  `acc_key` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_payment_getway`
--

INSERT INTO `sys_payment_getway` (`id`, `acc_key`, `name`, `logo`, `addOn`) VALUES
(1, 'easebuzz', 'easebuzz', NULL, '2023-08-10 19:04:18'),
(2, 'razorpay', 'razorpay', NULL, '2023-08-10 19:05:01'),
(3, 'payu', 'payu', NULL, '2023-08-10 19:05:01'),
(4, 'ccavenue', 'CCAvenue', NULL, '2023-08-10 19:05:37'),
(5, 'phonepe', 'phonepe', NULL, '2023-11-20 10:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `sys_pms_pages`
--

CREATE TABLE `sys_pms_pages` (
  `id` int(11) NOT NULL,
  `pId` int(11) NOT NULL DEFAULT 0,
  `accessKey` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(250) NOT NULL,
  `payable` enum('one-time','monthly') NOT NULL DEFAULT 'one-time',
  `monthlyPrice` float NOT NULL DEFAULT 0,
  `description` varchar(500) DEFAULT NULL,
  `whyUse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_pms_pages`
--

INSERT INTO `sys_pms_pages` (`id`, `pId`, `accessKey`, `name`, `payable`, `monthlyPrice`, `description`, `whyUse`) VALUES
(1, 3, 'pms', 'PMS', 'monthly', 5833, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n<p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(2, 3, 'reservations', 'Reservations', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(3, 3, '', 'Stay View', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(4, 3, '', 'Room View', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(5, 3, '', 'Guest Database', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(6, 3, '', 'Cashiering', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(7, 14, '', 'Inventory / Rate', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(8, 3, '', 'Housekeeping ', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(9, 4, 'pos', 'POS', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(10, 4, '', 'Table', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(11, 4, '', 'Food', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(12, 4, '', 'Order', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(13, 4, '', 'Stock', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(14, 1, 'be', 'Booking Engine', 'monthly', 1500, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(15, 2, 'wb', 'Web Builder', 'one-time', 50000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(16, 2, '', 'Slider', 'one-time', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(17, 2, '', 'Gallery', 'one-time', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(18, 2, '', 'Blog', 'one-time', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(19, 15, '', 'Offer', 'one-time', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(20, 15, '', 'Feedback', 'one-time', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(21, 3, 'report', 'Report', 'monthly', 0, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(22, 6, 'payment-link', 'Payment Link', 'monthly', 1000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\n                                    <p>Peer &amp; expert code review</p>\n                                    <p>Coding exercises</p>\n                                    <p>Access to our GitHub repos</p>\n                                    <p>Community forum</p>\n                                    <p>Flashcard decks</p>\n                                    <p>New videos every week</p>'),
(23, 10, 'expense', 'Expense', 'monthly', 1000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\r\n                                    <p>Peer &amp; expert code review</p>\r\n                                    <p>Coding exercises</p>\r\n                                    <p>Access to our GitHub repos</p>\r\n                                    <p>Community forum</p>\r\n                                    <p>Flashcard decks</p>\r\n                                    <p>New videos every week</p>'),
(24, 3, 'night-audit', 'Night audit', 'monthly', 1000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\r\n                                    <p>Peer &amp; expert code review</p>\r\n                                    <p>Coding exercises</p>\r\n                                    <p>Access to our GitHub repos</p>\r\n                                    <p>Community forum</p>\r\n                                    <p>Flashcard decks</p>\r\n                                    <p>New videos every week</p>'),
(25, 10, '', 'Review', 'monthly', 1000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\r\n                                    <p>Peer &amp; expert code review</p>\r\n                                    <p>Coding exercises</p>\r\n                                    <p>Access to our GitHub repos</p>\r\n                                    <p>Community forum</p>\r\n                                    <p>Flashcard decks</p>\r\n                                    <p>New videos every week</p>'),
(27, 0, '', 'Raw products', 'monthly', 1000, 'Gain access to our full functionality of product.', '<p>Tutorials by industry experts</p>\r\n                                    <p>Peer &amp; expert code review</p>\r\n                                    <p>Coding exercises</p>\r\n                                    <p>Access to our GitHub repos</p>\r\n                                    <p>Community forum</p>\r\n                                    <p>Flashcard decks</p>\r\n                                    <p>New videos every week</p>'),
(28, 11, 'set-up', 'Set up', 'one-time', 0, NULL, NULL),
(29, 12, '', 'Report', 'one-time', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_product`
--

CREATE TABLE `sys_product` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `accessKey` varchar(50) NOT NULL,
  `name` varchar(250) NOT NULL,
  `shortForm` varchar(50) NOT NULL,
  `icon` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `voucher` int(11) NOT NULL DEFAULT 0,
  `commision` int(11) NOT NULL DEFAULT 0,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_product`
--

INSERT INTO `sys_product` (`id`, `pid`, `accessKey`, `name`, `shortForm`, `icon`, `status`, `voucher`, `commision`, `addOn`) VALUES
(1, 0, 'bookingEngine', 'Booking Engine', 'be', '', 1, 1, 1, '2023-08-27 09:47:09'),
(2, 0, 'webBuilder', 'Web builder', 'wb', '', 1, 0, 0, '2023-08-27 09:47:09'),
(3, 0, 'pms', 'PMS', 'pms', '', 1, 0, 0, '2023-08-27 09:47:27'),
(4, 0, 'pos', 'POS', 'pos', '', 1, 0, 0, '2023-09-07 06:56:44'),
(5, 1, 'quickPay', 'Quick Pay', 'qp', '', 1, 0, 0, '2023-09-28 05:55:44'),
(6, 0, 'paymentLink', 'Payment Link', 'pl', '', 1, 0, 0, '2023-11-23 06:34:27'),
(7, 0, 'marketing', 'Marketing', 'mrt', '', 1, 0, 0, '2023-10-27 20:46:26'),
(10, 0, 'expense', 'Expense', 'exp', '', 0, 0, 0, '2023-11-25 00:45:40'),
(11, 0, 'setUp', 'Set-up', 'su', '', 1, 0, 0, '2024-02-28 15:57:32'),
(12, 0, 'report', 'Report', 'report', '', 1, 0, 0, '2024-03-02 06:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `sys_rate_plan`
--

CREATE TABLE `sys_rate_plan` (
  `id` int(11) NOT NULL,
  `srtcode` varchar(25) NOT NULL,
  `fullForm` varchar(250) NOT NULL,
  `icon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_rate_plan`
--

INSERT INTO `sys_rate_plan` (`id`, `srtcode`, `fullForm`, `icon`) VALUES
(1, 'EP', 'Room Only', NULL),
(2, 'CP', 'Room With Breakfast', NULL),
(3, 'MAP', 'Room With Breakfast Plus Lunch Or Dinner', NULL),
(4, 'AP', 'All Included', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_report_list`
--

CREATE TABLE `sys_report_list` (
  `id` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `accesKey` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `svg` text DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_report_list`
--

INSERT INTO `sys_report_list` (`id`, `typeId`, `accesKey`, `name`, `svg`, `addOn`, `deleteRec`) VALUES
(1, 1, 'todays-events', 'Todays Events', '<svg>\n                                        <use xlink:href=\"#todayEventSvgIcon\"></use>\n                                    </svg>', '2023-04-01 09:26:17', 0),
(2, 1, 'checkin', 'Arrival List', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\"\r\n    style=\"enable-background:new 0 0 50 50;\">\r\n    <g id=\"checkin\">\r\n        <path fill=\"currentColor\" d=\"M43.4,5.8h-5.1V3.4c0-0.6-0.4-1-1-1s-1,0.4-1,1v2.4H19.8V3.4c0-0.6-0.4-1-1-1s-1,0.4-1,1v2.4 h-5.2c-2.8,0-5.1,2.3-5.1,5.1v15.9c0,0.6,0.4,1,1,1s1-0.4,1-1v-5.6h37v21.5c0,1.7-1.4,3.1-3.1,3.1H12.6c-1.7,0-3.1-1.4-3.1-3.1 v-5.1c0-0.6-0.4-1-1-1s-1,0.4-1,1v5.1c0,2.8,2.3,5.1,5.1,5.1h30.8c2.8,0,5.1-2.3,5.1-5.1V10.9C48.5,8.1,46.2,5.8,43.4,5.8z M9.5,19.2v-8.3c0-1.7,1.4-3.1,3.1-3.1h5.2v2.6c-1.2,0.4-2.1,1.5-2.1,2.9c0,1.7,1.4,3.1,3.1,3.1s3.1-1.4,3.1-3.1 c0-1.3-0.9-2.5-2.1-2.9V7.8h16.5v2.6c-1.2,0.4-2.1,1.5-2.1,2.9c0,1.7,1.4,3.1,3.1,3.1s3.1-1.4,3.1-3.1c0-1.3-0.9-2.5-2.1-2.9V7.8 h5.1c1.7,0,3.1,1.4,3.1,3.1v8.3H9.5z M18.8,12.3c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S18.3,12.3,18.8,12.3z M37.3,12.3c0.6,0,1.1,0.5,1.1,1.1s-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1S36.7,12.3,37.3,12.3z\">\r\n        </path>\r\n        <path fill=\"#ff0000\" d=\"M17.9,36.9c-0.4,0.4-0.3,1,0.1,1.4c0.2,0.2,0.4,0.3,0.7,0.3c0.3,0,0.5-0.1,0.7-0.3l5-5.5 c0,0,0-0.1,0.1-0.1c0,0,0,0,0-0.1c0,0,0-0.1,0.1-0.1c0,0,0,0,0,0c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0,0,0,0,0,0 c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0,0-0.1-0.1-0.1-0.1c0,0,0,0,0-0.1c0,0,0-0.1-0.1-0.1l-5-5.3 c-0.4-0.4-1-0.4-1.4,0c-0.4,0.4-0.4,1,0,1.4l3.4,3.6H2c-0.6,0-1,0.4-1,1s0.4,1,1,1h19.4L17.9,36.9z\">\r\n        </path>\r\n    </g>\r\n</svg>', '2023-04-01 09:26:17', 1),
(3, 1, 'checkout', 'Departure List', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\"\r\n    style=\"enable-background:new 0 0 50 50;\">\r\n    <g id=\"checkout\">\r\n        <path fill=\"currentColor\" d=\"M39.4,35.3c-0.6,0-1,0.4-1,1v4.9c0,1.6-1.3,2.9-2.9,2.9H6.1c-1.6,0-2.9-1.3-2.9-2.9V20.8h35.2 V26c0,0.6,0.4,1,1,1s1-0.4,1-1V10.9c0-2.7-2.2-4.9-4.9-4.9h-4.8V3.7c0-0.6-0.4-1-1-1s-1,0.4-1,1V6H13V3.7c0-0.6-0.4-1-1-1 s-1,0.4-1,1V6h-5c-2.7,0-4.9,2.2-4.9,4.9v30.3c0,2.7,2.2,4.9,4.9,4.9h29.4c2.7,0,4.9-2.2,4.9-4.9v-4.9 C40.4,35.8,39.9,35.3,39.4,35.3z M6.1,8h5v2.4c-1.1,0.4-2,1.5-2,2.8c0,1.6,1.3,3,3,3s3-1.3,3-3c0-1.3-0.8-2.4-2-2.8V8h15.6v2.4 c-1.1,0.4-2,1.5-2,2.8c0,1.6,1.3,3,3,3s3-1.3,3-3c0-1.3-0.8-2.4-2-2.8V8h4.8c1.6,0,2.9,1.3,2.9,2.9v7.9H3.1v-7.9 C3.1,9.3,4.5,8,6.1,8z M12,12.2c0.5,0,1,0.4,1,1c0,0.5-0.4,1-1,1c-0.5,0-1-0.4-1-1C11,12.6,11.5,12.2,12,12.2z M29.6,12.2 c0.5,0,1,0.4,1,1c0,0.5-0.4,1-1,1c-0.5,0-1-0.4-1-1C28.7,12.6,29.1,12.2,29.6,12.2z\">\r\n        </path>\r\n        <path fill=\"#de7500\" d=\"M48.4,30.1H30l3.2-3.4c0.4-0.4,0.4-1,0-1.4c-0.4-0.4-1-0.4-1.4,0l-4.8,5c0,0,0,0.1-0.1,0.1 c0,0,0,0,0,0.1c0,0-0.1,0.1-0.1,0.1c0,0,0,0,0,0c0,0.1,0,0.1,0,0.2c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c0,0,0,0,0,0c0,0.1,0,0.1,0,0.2 c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c0,0,0,0.1,0.1,0.1c0,0,0,0,0,0.1c0,0,0,0.1,0.1,0.1l4.8,5.2c0.2,0.2,0.5,0.3,0.7,0.3 c0.2,0,0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0.1-1.4L30,32.1h18.4c0.6,0,1-0.4,1-1S48.9,30.1,48.4,30.1z\">\r\n        </path>\r\n    </g>\r\n</svg>', '2023-04-01 09:32:13', 1),
(5, 1, 'no-show', 'No Show', '<svg  width=\"15px\" height=\"15px\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"-55 147 500 500\">\r\n    <g>\r\n        <path fill=\"currentColor\" d=\"M114.4,375.3c0,16.8,13.6,30.4,30.4,30.4c1.1,0,2.1-0.1,3.2-0.2l25.3-19.6c1.3-3.3,1.9-6.9,1.9-10.7\r\n		c0-16.8-13.6-30.4-30.4-30.4C128,344.9,114.4,358.5,114.4,375.3z M163.2,375.3c0,10.1-8.3,18.4-18.4,18.4\r\n		c-10.2,0-18.4-8.3-18.4-18.4c0-10.2,8.3-18.4,18.4-18.4C155,356.9,163.2,365.1,163.2,375.3z\" />\r\n        <path fill=\"currentColor\" d=\"M50.3,456.6c6.1-0.7,11.7,1.6,15.5,5.7c2.1,2.2,5.6,2.5,8,0.6h0c2.8-2.2,3.1-6.3,0.7-8.8c-6-6.4-14.8-10.2-24.4-9.5\r\n		c-14.4,1.1-26.3,12.4-27.9,26.8c-0.8,7.3,1,14.1,4.5,19.7c1.9,3,5.9,3.6,8.7,1.5h0c2.4-1.9,3-5.3,1.4-7.9\r\n		c-2.2-3.5-3.2-7.7-2.6-12.2C35.3,464.1,42,457.5,50.3,456.6z\" />\r\n        <path fill=\"currentColor\" d=\"M237.3,393.7c-3.9,0-7.5-1.2-10.5-3.3c-2.1-1.5-5-1.5-7,0.1l-0.3,0.2c-3,2.4-3,7,0.1,9.3c5,3.6,11.1,5.7,17.7,5.7\r\n		c16.6,0,30.3-13.5,30.4-30.2c0,0,0-0.1,0-0.1c0,0,0-0.1,0-0.1c0-3.8-0.7-7.5-2-10.9c-1.4-3.7-6-4.9-9.1-2.5l-0.3,0.2\r\n		c-2,1.6-2.7,4.3-1.8,6.7c0.8,2,1.2,4.2,1.2,6.5v0.1C255.6,385.5,247.4,393.7,237.3,393.7z\" />\r\n        <path fill=\"currentColor\" d=\"M389.6,260.1v28.3h-35.8c-1.3,0-2.6,0.4-3.7,1.3v0c-4.5,3.5-2.1,10.7,3.7,10.7h35.8v237.3c0,6.7-5.4,12.1-12.1,12.1h-363\r\n		c-0.5,0-1,0.2-1.3,0.5l-9.9,7.7c-1.6,1.3-0.7,3.9,1.3,3.9l0.1,0h372.9c13.3,0,24.1-10.8,24.1-24.1V254.1c0,0,0,0,0,0\r\n		c0-1.7-2-2.7-3.4-1.6l-7.8,6C389.9,258.8,389.6,259.4,389.6,260.1z\" />\r\n        <path fill=\"currentColor\" d=\"M-7.5,300.4h289.3c1.3,0,2.6-0.4,3.7-1.3l0,0c4.5-3.5,2-10.7-3.7-10.7H-7.5v-34.3c0-6.7,5.4-12.1,12.1-12.1h37.1l0,15.4\r\n		c0,3.3,2.5,6.2,5.8,6.2c3.4,0.1,6.2-2.6,6.2-6V242H185l0,15.4c0,3.3,2.5,6.1,5.8,6.2c3.4,0.1,6.2-2.6,6.2-6V242h131.4v15.7l0,0.1\r\n		c0,3.3,3.9,5.2,6.5,3.2l3.9-3c1-0.8,1.6-2,1.6-3.3V242h16.9c1.3,0,2.6-0.4,3.7-1.3v0c4.5-3.5,2.1-10.7-3.7-10.7h-16.9v-15.1\r\n		c0-3.4-2.8-6.1-6.2-6c-3.3,0.1-5.8,3-5.8,6.2V230H197l0-14.9c0-3.3-2.5-6.2-5.8-6.2c-3.4-0.1-6.2,2.6-6.2,6V230H53.7l0-14.9\r\n		c0-3.3-2.5-6.2-5.8-6.2c-3.4-0.1-6.2,2.6-6.2,6V230H4.6c-13.3,0-24.1,10.8-24.1,24.1v268.7c0,5,5.7,7.8,9.7,4.7h0\r\n		c1.5-1.1,2.3-2.9,2.3-4.7V300.4z\" />\r\n        <path style=\"fill: var(--bs-danger);\" d=\"M420,215.4c-2-2.6-5.8-3.1-8.4-1.1L-33.1,558.2c-2.6,2-3.1,5.8-1.1,8.4c1.2,1.5,3,2.3,4.8,2.3\r\n		c1.3,0,2.6-0.4,3.7-1.3l444.6-343.9C421.5,221.7,422,218,420,215.4z\" />\r\n        <path fill=\"currentColor\" d=\"M52.4,344.9c-16.8,0-30.4,13.6-30.4,30.4c0,16.8,13.6,30.4,30.4,30.4c16.8,0,30.4-13.6,30.4-30.4\r\n		C82.8,358.5,69.2,344.9,52.4,344.9z M52.4,393.7c-10.1,0-18.4-8.3-18.4-18.4c0-10.2,8.3-18.4,18.4-18.4c10.1,0,18.4,8.3,18.4,18.4\r\n		C70.8,385.4,62.5,393.7,52.4,393.7z\" />\r\n        <path fill=\"currentColor\" d=\"M329.7,405.7c16.8,0,30.4-13.6,30.4-30.4c0-16.8-13.6-30.4-30.4-30.4c-16.8,0-30.4,13.6-30.4,30.4\r\n		C299.3,392,312.9,405.7,329.7,405.7z M329.7,356.9c10.1,0,18.4,8.3,18.4,18.4c0,10.1-8.3,18.4-18.4,18.4\r\n		c-10.2,0-18.4-8.3-18.4-18.4C311.3,365.1,319.6,356.9,329.7,356.9z\" />\r\n        <path fill=\"currentColor\" d=\"M175.2,476.7c0.9-14.5-8.5-27-21.5-30.9c-2.4-0.7-5.1-0.3-7.1,1.3l-29.8,23.1c-1.5,1.1-2.3,2.9-2.3,4.8l0,0\r\n		c0,17.4,14.7,31.5,32.4,30.3C162,504.2,174.3,491.9,175.2,476.7z M126.5,473c0.9-8.6,7.8-15.5,16.4-16.4\r\n		c11.6-1.2,21.4,8.6,20.2,20.2c-0.9,8.6-7.8,15.6-16.4,16.4C135.1,494.3,125.3,484.6,126.5,473z\" />\r\n        <path fill=\"currentColor\" d=\"M237.3,505.3c16.8,0,30.4-13.6,30.4-30.4c0-16.8-13.6-30.4-30.4-30.4c-16.8,0-30.4,13.6-30.4,30.4\r\n		C206.9,491.6,220.5,505.3,237.3,505.3z M237.3,456.5c10.1,0,18.4,8.3,18.4,18.4c0,10.1-8.3,18.4-18.4,18.4\r\n		c-10.2,0-18.4-8.3-18.4-18.4C218.9,464.7,227.2,456.5,237.3,456.5z\" />\r\n        <path fill=\"currentColor\" d=\"M329.7,505.3c16.8,0,30.4-13.6,30.4-30.4c0-16.8-13.6-30.4-30.4-30.4c-16.8,0-30.4,13.6-30.4,30.4\r\n		C299.3,491.6,312.9,505.3,329.7,505.3z M329.7,456.5c10.1,0,18.4,8.3,18.4,18.4c0,10.1-8.3,18.4-18.4,18.4\r\n		c-10.2,0-18.4-8.3-18.4-18.4C311.3,464.7,319.6,456.5,329.7,456.5z\" />\r\n      </g>\r\n</svg>', '2023-11-12 02:28:54', 1),
(7, 1, 'void-reservation', 'Void Reservation', '\r\n<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"\r\n	 viewBox=\"0 0 50 39.3\" style=\"enable-background:new 0 0 50 39.3;\" xml:space=\"preserve\">\r\n\r\n<g fill=\"currentColor\">\r\n	<path d=\"M45,9.2C44.9,6.3,42.5,4,39.6,4h-3.9V2.5c0-0.7-0.6-1.2-1.2-1.2c-0.7,0-1.2,0.5-1.2,1.2V4H16.8V2.5\r\n		c0-0.7-0.5-1.2-1.2-1.2c-0.7,0-1.2,0.5-1.2,1.2V4h-3.9C7.4,4,5,6.4,5,9.4v3.3c0.4,0,0.8-0.1,1.2-0.1l0.9-0.1c0.1,0,0.2,0,0.3,0V9.4\r\n		c0-1.6,1.3-3,3-3h3.9v1.1c0,0.7,0.6,1.2,1.2,1.2c0.7,0,1.2-0.5,1.2-1.2V6.4h16.5v1.4c0,0.7,0.5,1.2,1.2,1.2c0.7,0,1.2-0.5,1.2-1.2\r\n		V6.4h3.9c1.6,0,3,1.3,3,3v0C43.4,9.3,44.2,9.3,45,9.2z M44.1,29l-1.5,1.3l0,0v1.9c0,1.6-1.3,3-3,3H10.4c-1.6,0-3-1.3-3-3v0\r\n		c-0.7,0.1-1.4,0.1-2.2,0.2L5,32.7c0.3,2.8,2.6,4.9,5.4,4.9h29.2c3,0,5.4-2.4,5.4-5.4v-3.3L44.1,29z\"/>\r\n</g>\r\n<g>\r\n	<path style=\"fill:#ED1C24;\" d=\"M49.3,23.3c0-1-0.3-1.9-0.3-2.9c0-0.5,0-0.8-0.6-0.9c0.2-0.2,0.4-0.3,0.6-0.5\r\n		c-0.1-1-0.2-1.9-0.3-3c0-0.6-0.1-1.1-0.7-1.4c0.2,0,0.3,0,0.6,0c-0.1-0.5-0.1-1-0.3-1.5c-0.3-0.9-1.2-1.5-2.2-1.5\r\n		c-1.9,0.1-3.7,0.3-5.6,0.5C35.3,12.5,30,13,24.8,13.4c-1,0.1-1.9,0.2-2.9,0.3c0,0.3-0.1,0.6-0.1,1c-0.2,0-0.4,0-0.5,0\r\n		c0-0.3,0-0.6,0-0.9c-2.2,0.2-4.4,0.4-6.7,0.6c0.2,0.5,0.3,0.9,0.5,1.3c0.4,0,0.8-0.1,1.2-0.1c1.2-0.1,2.4-0.2,3.6-0.3\r\n		c2.3-0.2,4.7-0.4,7-0.6c0.3,0,0.5-0.2,0.8-0.4c-0.3-0.3-0.4-0.5-0.6-0.7c0.3,0,0.6,0.1,0.8,0.3c0.5,0.5,1.2,0.6,1.9,0.5\r\n		c2.5-0.3,5-0.5,7.5-0.7c2.8-0.2,5.6-0.5,8.4-0.7c0.9-0.1,1.4,0.2,1.5,1.2c0.3,3.2,0.6,6.4,0.9,9.6c0.1,0.7-0.4,1.2-1.2,1.3\r\n		c-1.1,0.1-2.1,0.2-3.2,0.3c-0.1,0-0.2,0.1-0.5,0.2c0.4,0.2,0.6,0.3,0.8,0.4c-0.2,0.2-0.3,0.3-0.5,0.4c-0.3-0.7-0.7-0.9-1.4-0.9\r\n		c-0.8,0.1-1.5,0.1-2.3,0.2c-2.7,0.2-5.5,0.5-8.2,0.7c-1.8,0.2-3.6,0.3-5.5,0.5c0,0.4,0,0.8,0,1.2c2.3,0,4.7-0.3,7-0.5\r\n		c4.7-0.4,9.4-0.8,14.1-1.2c1.2-0.1,1.8-0.8,2-1.8C49.3,24.1,49.3,23.7,49.3,23.3z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M22.4,25.5c2.2,0,3.8-0.8,4.9-2.4c1-1.4,0.9-3.3-0.2-4.7c-2-2.5-6.2-2.6-8.3-0.1\r\n		c-1.6,1.8-1.3,4.5,0.6,6C20.3,25.1,21.4,25.5,22.4,25.5z M19.9,20.8c0.1-1,1-1.8,2.3-2.2c1.5-0.4,3.4,0.5,3.6,2\r\n		c0.1,0.7-0.1,1.3-0.5,1.8c-0.6,0.8-1.5,1.2-2.5,1.2C21,23.5,19.8,22.3,19.9,20.8z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M33.8,19.3c0.1,1.7,0.3,3.4,0.4,5.1c1.6-0.2,3.1-0.3,4.6-0.4c0.4,0,0.9-0.2,1.3-0.3\r\n		c1.7-0.6,2.9-2.3,3-4c0-1.7-1.1-3.3-2.9-3.9c-0.7-0.2-1.6-0.3-2.4-0.3c-1.4,0-2.8,0.2-4.2,0.3c-0.1,1.5,0,2.9,1.8,3.4\r\n		c0,0.2,0,0.4,0.1,0.5c-0.4-0.6-0.5,0.4-0.9,0.2c0.1-0.1,0.1-0.2,0.2-0.3C34.3,19.4,34.1,19.4,33.8,19.3z M35.9,17.5\r\n		c0.9,0,1.9-0.2,2.9-0.1c1.1,0.1,1.9,1,2,1.9c0.1,1.1-0.4,2-1.4,2.6c-0.1,0.1-0.2,0.1-0.4,0.2c0.4,0.4,0.9,0.6,1,1.1\r\n		c-0.1,0.1-0.1,0.1-0.2,0.2c-0.5-0.4-1-0.9-1.6-1.1c-0.6-0.2-1.3,0-2,0.1c-0.3-1.1,0.1-2.3-0.5-3C35.8,18.5,35.8,18.1,35.9,17.5z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M11.1,26.4c0.7-0.1,1.5-0.1,2.3-0.2c1.1-3,2.1-5.9,3.2-9c-0.7,0.1-1.4,0.1-2,0.2\r\n		c-0.1,0-0.2,0.1-0.2,0.2c-0.4,0.9-0.8,1.7-1.1,2.6c0,0.1,0.1,0.2,0.1,0.4c0.2,0.5,0.3,1.1,0.5,1.6c-0.1,0-0.1,0-0.2,0.1\r\n		c-0.2-0.5-0.3-1-0.5-1.4c0,0-0.1,0-0.1,0c-0.4,0.9-0.7,1.9-1.1,3c-1.2-2-2.3-3.9-3.4-5.8c-0.8,0.1-1.5,0.1-2.3,0.2\r\n		c0.8,1.3,1.4,2.5,2.1,3.8c0.1,0.2,0.3,0.2,0.5,0.4C8.8,22.6,10.3,25.5,11.1,26.4z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M13.8,27.8c-1.4,0.1-2.9,0.2-4.3,0.4c-0.3,0-0.5,0.2-0.9,0.3c-1.4-0.4-2.8,0.2-4.3,0.2\r\n		c0,0.1,0,0.1-0.1,0.2c0.2,0.1,0.3,0.2,0.5,0.3c-0.1,0.1-0.1,0.1-0.2,0.2c-0.3-0.2-0.5-0.5-0.8-0.6c-1.1-0.2-1.1-1.1-1.1-1.9\r\n		c0-0.3-0.1-0.7-0.1-1.1c-0.5,0.1-0.9,0.1-1.3,0.2c0.1,0.7,0.1,1.4,0.2,2.1c0.2,1.3,1.3,2.1,2.5,2c2.8-0.2,5.6-0.5,8.4-0.7\r\n		c3.9-0.3,7.7-0.7,11.6-1c0.5,0,1-0.1,1.5-0.2c0-0.5,0-0.9,0-1.3c-1.1,0.1-2.2,0.2-3.3,0.3C19.4,27.3,16.6,27.6,13.8,27.8z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M2.6,25.5c0-0.3,0-0.5-0.1-0.8c-0.1-1.1-0.2-2.2-0.3-3.3c-0.1-0.8,0.2-1.7-0.5-2.3\r\n		c-0.1-0.1,0-0.4,0-0.5c0-0.2,0.2-0.4,0.2-0.6c0-0.8,0.3-1.1,1.1-1.2c2.8-0.3,5.6-0.5,8.4-0.7c1.1-0.1,2.1-0.2,3.3-0.3\r\n		c-0.2-0.4-0.4-0.8-0.6-1.2c-0.4,0-0.8,0-1.2,0.1C11,14.6,9.2,14.8,7.3,15c-1.6,0.1-3.2,0.3-4.8,0.5c-1,0.1-1.8,1-1.8,2.1\r\n		c0,0.6,0,1.2,0.1,1.7c0.1,1.7,0.3,3.3,0.4,5C1.3,25.3,1.5,25.5,2.6,25.5z\"/>\r\n	<path style=\"fill:#ED1C24;\" d=\"M29.6,16.9c0.1,2.6,0.3,5.2,0.4,7.8c0.8-0.1,1.5-0.1,2.2-0.2c-0.1-0.7-0.1-1.4-0.2-2\r\n		c-0.4-0.1-0.9,0.3-1.1-0.5c0.3-0.1,0.7-0.1,1-0.2c0-0.2,0-0.4,0-0.6c-0.1-1.3-0.2-2.6-0.4-4c-0.1-0.7-1-1.4-1.8-1.2\r\n		c0,0.2,0.1,0.4,0.1,0.6C29.7,16.8,29.6,16.8,29.6,16.9z\"/>\r\n</g>\r\n</svg>\r\n', '2023-11-12 02:28:54', 1),
(37, 7, 'guest', 'Guest Data', '<svg>\n                                        <use xlink:href=\"#todayEventSvgIcon\"></use>\n                                    </svg>', '2024-05-20 07:01:35', 1),
(38, 7, 'guest-birthday', 'Birthday', '<svg>\n                                        <use xlink:href=\"#todayEventSvgIcon\"></use>\n                                    </svg>', '2024-05-20 07:02:28', 1),
(39, 7, 'guest-anniversary', 'Anniversary', '<svg>\n                                        <use xlink:href=\"#todayEventSvgIcon\"></use>\n                                    </svg>', '2024-05-20 07:02:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_report_type`
--

CREATE TABLE `sys_report_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_report_type`
--

INSERT INTO `sys_report_type` (`id`, `name`, `status`) VALUES
(1, 'Reservation Reports', 1),
(7, 'Guest Reports', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_reservationtype`
--

CREATE TABLE `sys_reservationtype` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `bg` varchar(250) NOT NULL,
  `clr` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_reservationtype`
--

INSERT INTO `sys_reservationtype` (`id`, `name`, `bg`, `clr`, `addOn`) VALUES
(1, 'Confirm', '#008000', '#ffffff', '2022-06-06 21:51:27'),
(2, 'Unconfirmed', '#3366ff', '#ffffff', '2022-06-06 21:51:27'),
(3, 'Online Failed', '#eb0000', '#ffffff', '2022-06-06 21:51:49'),
(4, 'Hold', '#ddad00', '#ffffff', '2022-06-06 21:51:49'),
(5, 'No Show', '#00a1a1', '#ffffff', '2022-06-06 21:52:00'),
(6, 'Void', '#ad0000', '#ffffff', '2024-05-04 18:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `sys_roomstatus`
--

CREATE TABLE `sys_roomstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL,
  `bg` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_roomstatus`
--

INSERT INTO `sys_roomstatus` (`id`, `name`, `color`, `bg`) VALUES
(1, 'Cleaned', '#fff', '#008000'),
(2, 'Book', '#fff', '#7928ca'),
(3, 'Dirty', '#fff', '#ff8100'),
(4, 'Under construction', '#fff', '#ea0606'),
(5, 'Unblock', '#000000', '#808080');

-- --------------------------------------------------------

--
-- Table structure for table `sys_room_gst`
--

CREATE TABLE `sys_room_gst` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL,
  `price` varchar(150) NOT NULL,
  `gst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_sociallink`
--

CREATE TABLE `sys_sociallink` (
  `id` int(11) NOT NULL,
  `accesKey` varchar(120) NOT NULL,
  `name` varchar(50) NOT NULL,
  `placeholder` varchar(250) NOT NULL,
  `icon` text NOT NULL,
  `img` varchar(500) NOT NULL,
  `color` varchar(250) DEFAULT NULL,
  `bgClr` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_sociallink`
--

INSERT INTO `sys_sociallink` (`id`, `accesKey`, `name`, `placeholder`, `icon`, `img`, `color`, `bgClr`, `status`) VALUES
(1, 'fb', 'Facebook', 'Enter facebook link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\">\n	<g id=\"facebook\"><path d=\"M33.6,0.8C34.4,0.9,35.2,1,36,1c0.5,0,1,0.1,1.5,0.1c0,2.6,0,5.1,0,7.7c-0.2,0-0.3,0-0.5,0\n			c-1.6,0-3.3,0-4.9,0.1c-2.1,0.1-3.2,1.2-3.3,3.3c-0.1,2.1,0,4.2,0,6.3c2.8,0,5.6,0,8.5,0c-0.4,2.9-0.7,5.8-1.1,8.7\n			c-2.5,0-4.9,0-7.4,0c0,7.4,0,14.7,0,22c-3,0-5.9,0-8.9,0c0-7.3,0-14.7,0-22c-2.5,0-4.9,0-7.4,0c0-2.9,0-5.7,0-8.6\n			c2.4,0,4.9,0,7.4,0c0-0.2,0-0.4,0-0.6c0-2.3,0-4.5,0.1-6.8c0.1-3.1,1.1-5.8,3.5-7.8c1.6-1.4,3.6-2.1,5.7-2.3c0.2,0,0.3-0.1,0.5-0.1\n			C31,0.8,32.3,0.8,33.6,0.8z\"/></g>\n</svg>', 'facebook.png', '#1976d2', '#c8def4', 1),
(2, 'in', 'Instagram', 'Enter instagram link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"instagram\"><path d=\"M1.6,37.9c0-8.6,0-17.2,0-25.8c0.1-0.3,0.1-0.5,0.2-0.8C2.6,7.1,5,4.1,9,2.4c1-0.4,2.1-0.6,3.1-0.8 		c8.6,0,17.2,0,25.8,0c0.4,0.1,0.7,0.1,1.1,0.2c4.7,1.1,7.7,3.9,9.1,8.6c0.2,0.6,0.3,1.2,0.4,1.8c0,8.6,0,17.2,0,25.8 		c-0.1,0.3-0.1,0.5-0.2,0.8C47.4,43,45,45.9,41,47.6c-1,0.4-2.1,0.6-3.1,0.8c-8.6,0-17.2,0-25.8,0c-0.4-0.1-0.7-0.1-1.1-0.2 		c-4.7-1.1-7.7-4-9-8.6C1.8,39,1.7,38.5,1.6,37.9z M25,44.5c4,0,8,0,11.9,0c0.8,0,1.6-0.2,2.3-0.4c3.2-1.1,5.3-4,5.3-7.4 		c0-7.8,0-15.5,0-23.3c0-0.4,0-0.8-0.1-1.2C44,8.6,40.6,5.6,37,5.5c-8,0-16,0-24.1,0c-0.4,0-0.8,0.1-1.2,0.1C8,6.5,5.5,9.6,5.5,13.4 		c0,7.7,0,15.5,0,23.2c0,0.4,0,0.8,0.1,1.2c0.5,3.6,3.7,6.6,7.4,6.6C17,44.5,21,44.5,25,44.5z\"/><path d=\"M25,13.3c6.5,0,11.7,5.3,11.7,11.8c0,6.5-5.3,11.7-11.7,11.7c-6.5,0-11.7-5.3-11.7-11.8 		C13.3,18.5,18.6,13.3,25,13.3z M25,17.2c-4.3,0-7.8,3.5-7.8,7.8c0,4.3,3.5,7.8,7.8,7.8c4.3,0,7.8-3.5,7.8-7.8 		C32.8,20.7,29.3,17.2,25,17.2z\"/><path d=\"M37.7,15.3c-1.6,0-2.9-1.3-2.9-2.9c0-1.6,1.4-3,3-3c1.6,0,2.9,1.4,2.9,3C40.6,13.9,39.3,15.3,37.7,15.3z\"/></g> </svg>', 'instagram.png', '#c0318c', '#f9ddea', 1),
(3, 'tw', 'Twitter', 'Enter twitter link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"twitter\"><path d=\"M0.3,40.5c5.6,0.5,10.5-0.8,14.8-4.1c-2.5-0.2-4.7-1.1-6.5-2.8c-1.3-1.2-2.3-2.7-2.7-4.3c1.4,0,2.8,0,4.2,0 		c0-0.1,0-0.1,0-0.2C5.3,27.6,2.7,24.2,2.3,19c1.5,0.7,2.9,1.2,4.5,1.3c-2.1-1.7-3.6-3.7-4.2-6.2c-0.6-2.6-0.1-5,1.2-7.3 		c5.5,6.4,12.3,10,20.8,10.6c-0.4-1.7-0.3-3.2,0.1-4.8c1.9-7.4,11.2-10.1,16.8-4.9c0.4,0.4,0.7,0.4,1.2,0.3c1.9-0.5,3.8-1.2,5.7-2.3 		c-0.8,2.4-2.2,4.2-4.1,5.6c0.6-0.1,1.2-0.2,1.8-0.4c0.6-0.1,1.2-0.3,1.8-0.5c0.6-0.2,1.2-0.4,1.7-0.6c0,0,0.1,0.1,0.1,0.1 		c-0.6,0.7-1.1,1.5-1.8,2.2C47,13,45.9,13.9,45,14.8c-0.2,0.2-0.3,0.5-0.3,0.7c0.4,11.3-6.5,23.6-18.6,28c-4.1,1.5-8.3,2-12.6,1.6 		c-4.6-0.4-8.8-1.8-12.7-4.2C0.7,40.8,0.6,40.7,0.3,40.5z\"/></g> </svg>', 'twitter.png', '#2daae1', '#d9f0fa', 1),
(4, 'li', 'LinkedIn', 'Enter linkedin link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"linkedin\"><path d=\"M49.4,49.3c-3.4,0-6.7,0-10.1,0c0-0.3,0-0.5,0-0.7c0-5,0-9.9,0-14.9c0-1.7-0.1-3.3-0.4-5 		c-0.6-3-2.7-4.1-5.6-3.8c-3,0.3-4.7,2-5,5.2c-0.1,1.2-0.2,2.3-0.2,3.5c0,5,0,10,0,15c0,0.2,0,0.5,0,0.7c-3.4,0-6.7,0-10.1,0 		c0-10.8,0-21.6,0-32.5c3.2,0,6.4,0,9.6,0c0,1.4,0,2.9,0,4.4c0.2-0.2,0.2-0.3,0.3-0.4c1.9-3,4.7-4.5,8.1-4.8c2.4-0.2,4.8,0,7.1,0.9 		c3,1.3,4.6,3.6,5.5,6.7c0.6,2.1,0.8,4.2,0.8,6.3c0,6.3,0,12.6,0,18.8C49.4,49,49.4,49.1,49.4,49.3z\"/><path d=\"M1.5,49.3c0-10.8,0-21.6,0-32.5c3.4,0,6.7,0,10,0c0,10.8,0,21.6,0,32.5C8.2,49.3,4.8,49.3,1.5,49.3z\"/><path d=\"M6.5,12.4c-3.2,0-5.9-2.7-5.9-5.9c0-3.2,2.7-5.8,5.9-5.8c3.2,0,5.9,2.7,5.8,5.9C12.3,9.8,9.7,12.4,6.5,12.4 		z\"/></g> </svg>', 'linkedin.png', '#0077b5', '#cce4f0', 1),
(5, 'yo', 'Youtube', 'Enter youtube link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"youtube\"><path d=\"M0.7,20.1c0.1-0.9,0.1-1.9,0.2-2.8c0.1-2,0.3-4,1.2-5.9c1.1-2.4,3-3.9,5.6-4.2c2.4-0.3,4.7-0.4,7.1-0.5 		c5.4-0.1,10.9-0.1,16.3-0.1c3.3,0,6.5,0.2,9.8,0.4c2.1,0.1,4,0.7,5.6,2.3c1.1,1.2,1.8,2.6,2,4.1c0.3,1.7,0.5,3.5,0.6,5.2 		c0.1,3.4,0.1,6.8,0.1,10.2c0,2.2-0.2,4.4-0.5,6.6c-0.2,1.6-0.7,3.2-1.8,4.6c-1.2,1.5-2.8,2.5-4.7,2.6c-2.7,0.2-5.4,0.4-8.1,0.5 		c-2.2,0.1-4.5,0.2-6.7,0.2c-4,0-8-0.1-12-0.2c-2.1-0.1-4.3-0.2-6.4-0.3c-1.6-0.1-3.1-0.4-4.5-1.3c-1.8-1.2-2.6-2.9-3.1-5 		C1,34.6,1,32.7,0.8,30.7c0-0.3-0.1-0.6-0.1-0.9C0.7,26.6,0.7,23.4,0.7,20.1z M24.1,40.5C24.1,40.5,24.1,40.5,24.1,40.5 		c0.6,0,1.3,0,1.9,0c4.6-0.1,9.2-0.3,13.8-0.4c1,0,2.1-0.1,3.1-0.4c1.6-0.5,2.4-1.8,2.8-3.3c0.6-2,0.6-4,0.6-6 		c0.2-4.2,0.2-8.3-0.1-12.5c-0.1-1.4-0.3-2.8-0.6-4.2c-0.4-2.1-1.8-3.3-3.9-3.5c-1.8-0.2-3.5-0.3-5.3-0.4c-2.9-0.1-5.9-0.2-8.8-0.2 		C21.4,9.4,15.1,9.6,8.8,10c-2.4,0.2-3.9,1.4-4.5,3.7c-0.5,1.9-0.6,3.9-0.6,5.9c-0.2,4.7-0.2,9.3,0.2,14c0.1,1.3,0.3,2.6,0.9,3.9 		c0.6,1.4,1.9,2.1,3.4,2.3c2.1,0.2,4.2,0.4,6.4,0.5C17.7,40.4,20.9,40.4,24.1,40.5z\"/><path d=\"M18.8,24.5c0-1.9,0.1-3.7,0-5.6c-0.1-1.6,1.5-2.7,3.1-1.9c3.4,1.9,6.9,3.8,10.4,5.7c0.7,0.4,1.2,1,1.2,1.8 		c0,0.8-0.5,1.4-1.2,1.8c-3.5,1.9-7,3.8-10.5,5.6c-1.5,0.8-3-0.1-3-1.8C18.8,28.2,18.8,26.3,18.8,24.5z M21.7,28.8 		c2.7-1.4,5.3-2.8,8-4.3c-2.7-1.5-5.3-2.9-8-4.4C21.7,23.1,21.7,25.9,21.7,28.8z\"/></g> </svg>', 'youtube.png', '#CD201F', '#f7dbdb', 1),
(6, 'pi', 'Pinterest', 'Enter pinterest link.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"pintrest\"><path id=\"XMLID_26_\" d=\"M14.3,49c-0.2-0.9-0.3-1.8-0.5-2.7c-0.1-0.9-0.1-1.8-0.2-2.7c-0.2-2.5,0.2-4.9,0.8-7.3c1-4,2-8.1,3-12.2 		c0.1-0.2,0-0.6-0.1-0.8c-0.9-2.5-1.1-5.1,0.1-7.6c0.8-1.7,2.1-2.8,3.9-3.3c2.5-0.6,4.6,1,4.7,3.6c0.1,1.3-0.2,2.6-0.6,3.9 		c-0.6,2-1.3,4.1-1.8,6.1c-0.8,2.7,1.2,5,3.8,5.3c3.1,0.3,5.5-1.2,7.3-3.6c1.6-2.1,2.4-4.4,2.7-7c0.3-2.5,0.1-4.9-0.8-7.3 		c-1.4-3.4-3.8-5.6-7.4-6.6c-3.7-1-7.3-0.9-10.8,0.8c-4.3,2-6.7,5.5-7.3,10.2c-0.3,2.8,0.3,5.4,2.2,7.6c0.2,0.3,0.3,0.6,0.2,1 		c-0.3,1-0.5,2-0.8,3c-0.2,0.8-0.5,0.9-1.2,0.5c-1.8-0.9-3.1-2.3-4.1-4C4.8,21,4.9,16,7.3,11.1C9.6,6.3,13.5,3.5,18.5,2 		c0.9-0.3,1.8-0.5,2.8-0.6c0.5-0.1,1-0.1,1.4-0.2c0.4,0,0.9-0.1,1.3-0.1c0.8,0,1.5,0,2.3,0c2.2,0,4.5,0.5,6.6,1.2 		c1.6,0.6,3.1,1.4,4.5,2.3c4.2,3,6.6,7,7,12.2c0.3,4.1-0.6,8-2.8,11.6c-1.8,3-4.3,5.3-7.6,6.6c-2.3,0.9-4.6,1.3-7,0.9 		c-2.2-0.3-4-1.2-5.4-3.1c-0.3,1.2-0.7,2.4-1,3.5c-0.8,3.2-1.8,6.3-3.6,9c-0.8,1.2-1.6,2.5-2.4,3.7C14.6,49,14.5,49,14.3,49z\"/></g> </svg>', 'pinterest.png', '#E60023', '#fcdee3', 1),
(7, 'wa', 'WhatsApp', 'Enter whatsapp number.', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\" ><g ><path id=\"XMLID_17_\" d=\"M1.8,48.3c0-0.2,0.1-0.3,0.1-0.4c1-3.7,2-7.3,3-11C5,36.5,5,36.2,4.8,35.8c-1.5-2.7-2.4-5.6-2.7-8.6 		C1.1,17.4,6.3,8.2,15,4c3.3-1.6,6.9-2.4,10.6-2.3c8.8,0.4,15.3,4.4,19.7,12c1.5,2.7,2.4,5.6,2.7,8.6c0.7,7.7-1.8,14.2-7.4,19.5 		c-3.4,3.2-7.5,5.1-12.2,5.8c-5,0.7-9.7-0.1-14.2-2.4c-0.2-0.1-0.4-0.1-0.6,0c-3.8,1-7.5,2-11.3,2.9C2.2,48.2,2.1,48.3,1.8,48.3z 		 M7.4,42.8c0.2-0.1,0.4-0.1,0.5-0.1c2.1-0.5,4.1-1.1,6.2-1.6c0.4-0.1,0.7-0.1,1,0.1c2.7,1.6,5.6,2.6,8.7,2.8 		c3.6,0.2,7-0.5,10.2-2.2c7.3-3.9,11.3-11.8,10.1-19.9c-0.7-4.4-2.6-8.1-5.9-11.1c-4.8-4.5-10.6-6.1-17-4.8c-5,1-9,3.7-11.9,8 		c-2.8,4.1-3.9,8.7-3.1,13.7c0.4,2.8,1.4,5.3,2.9,7.6c0.2,0.3,0.2,0.6,0.1,0.9C8.6,38.4,8,40.5,7.4,42.8z\"/><path d=\"M13.3,19.6c0-1.9,0.8-3.6,2.2-4.9c0.4-0.4,0.9-0.6,1.5-0.6c0.5,0,0.9,0,1.4,0.1c0.2,0,0.5,0.2,0.6,0.4 		c0.2,0.2,0.3,0.5,0.4,0.8c0.6,1.4,1.1,2.7,1.7,4.1c0.2,0.5,0.2,0.9-0.1,1.3c-0.5,0.6-0.9,1.2-1.4,1.8c-0.4,0.5-0.4,0.7-0.1,1.2 		c1.9,3.1,4.5,5.4,7.9,6.8c0.5,0.2,0.8,0.1,1.2-0.3c0.6-0.7,1.1-1.4,1.7-2.1c0.4-0.5,0.7-0.7,1.3-0.4c1.6,0.7,3.2,1.5,4.8,2.3 		c0.3,0.1,0.4,0.4,0.4,0.7c0,1.7-0.5,3.2-2.1,4.2c-1.9,1.2-3.9,1.3-6,0.7c-5.5-1.5-9.5-5-12.8-9.5c-1.1-1.5-2-3-2.5-4.8 		C13.4,20.7,13.4,20.2,13.3,19.6z\"/></g></svg>', 'whatsapp.png', '#4de35d', '#c7f2ca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_superadmin_detail`
--

CREATE TABLE `sys_superadmin_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_superadmin_detail`
--

INSERT INTO `sys_superadmin_detail` (`id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'Retrod', 'booking@retrodtech.org', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_svg_icon`
--

CREATE TABLE `sys_svg_icon` (
  `id` int(11) NOT NULL,
  `type` enum('solid','color') NOT NULL,
  `name` varchar(250) NOT NULL,
  `svg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_svg_icon`
--

INSERT INTO `sys_svg_icon` (`id`, `type`, `name`, `svg`) VALUES
(1, 'solid', 'inRoom', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\"> <g id=\"inRoom\"> 	<path d=\"M-947-342.9c0.7-1.1,1.3-2.2,2-3.3c3.4-5.8,9.9-8.8,16.1-7.3c6.4,1.5,11.1,6.7,11.8,13.3c0.2,1.8,0.1,3.7,0.1,5.5 		c0,51.5,0,103,0,154.4c0,2,0,3.9,0,6.2c50.4,0,100.3,0,151,0c0,4.9-0.1,9.5,0,14.1c0.3,22,13,38.8,34,44.4 		c4.7,1.3,9.9,1.6,14.8,1.6c91.6,0.1,183.3,0.1,274.9,0.1c2.2,0,4.3,0,7.3,0c0,1.9,0,3.6,0,5.4c0,32.2-0.2,64.3,0.1,96.5 		c0.1,9.3-2.5,16.2-11.1,20.2c-2.7,0-5.3,0-8,0c-8.7-4-11.5-10.8-11.1-20.2c0.5-13.4,0.1-26.9,0.1-40.6c-150.8,0-301.2,0-452,0 		c0,13.7-0.4,27.2,0.1,40.6c0.4,9.3-2.5,16.2-11.1,20.2c-2.7,0-5.3,0-8,0c-3.7-3.7-7.3-7.3-11-11C-947-116.3-947-229.6-947-342.9z\" 		/> 	<path d=\"M-598-503.9c10.4,4.9,14.4,12.4,10.6,20.7c-1.2,2.6-3.3,5-5.3,7.1c-10.3,10.4-20.7,20.7-31.8,31.7c2,0.2,3.2,0.5,4.4,0.5 		c6.7,0.1,13.3-0.2,20,0.1c8,0.4,14,7,14.1,14.8c0.1,7.8-5.9,14.8-13.8,14.9c-20.6,0.3-41.3,0.2-61.9,0c-6.2-0.1-10.7-3.6-13-9.4 		c-2.6-6.5-0.6-12.1,4.1-16.9c9.5-9.6,19-19.1,28.6-28.6c1.3-1.3,2.8-2.3,4.3-3.5c-0.2-0.5-0.3-1-0.5-1.5c-4.3,0-8.6,0-13,0 		c-3,0-6,0.1-9,0c-7.8-0.2-13.6-4.7-15.3-11.9c-1.5-6.7,1.9-13.3,8.7-16.8c0.7-0.4,1.3-0.8,2-1.3 		C-642.7-503.9-620.3-503.9-598-503.9z\"/> 	<path d=\"M-435-143.9c-2.4,0-4.2,0-6,0c-92,0-184,0-276,0c-13.8,0-19-5.2-19-19c0-18.2-0.1-36.3,0-54.5 		c0.2-22.1,12.6-38.8,33.6-44.7c4.4-1.2,9.2-1.7,13.8-1.7c68.7-0.1,137.3-0.1,206-0.1c28.2,0,47.5,19.2,47.6,47.3 		C-434.9-192.6-435-168.7-435-143.9z\"/> 	<path d=\"M-811.7-204c-24.8-0.7-44.8-21.3-44.2-45.6c0.6-25,21.6-45.3,45.9-44.3c25,1,44.8,21.6,44,45.8 		C-766.9-223.2-787.5-203.3-811.7-204z\"/> 	<path d=\"M-743.3-353.9c7,0,13.9-0.1,20.9,0c9.7,0.1,16.4,6.3,16.4,15.1c0,8.7-6.8,14.9-16.5,14.9c-18.8,0.1-37.6,0-56.5,0 		c-7.2,0-12.8-2.6-15.7-9.3c-2.9-6.8-0.6-12.7,4.4-17.7c10.7-10.7,21.4-21.3,33.2-33.1c-8.9,0-16.5,0.2-24,0 		c-10.8-0.4-17.7-10.6-13.8-20.4c2.4-6,7.1-9.4,13.5-9.5c20.2-0.2,40.3-0.2,60.5,0c6.4,0,11.2,3.3,13.7,9.2 		c2.7,6.4,0.9,12.1-3.8,16.9c-9.6,9.7-19.3,19.4-28.9,29c-1.3,1.3-2.8,2.3-4.2,3.4C-743.9-354.9-743.6-354.4-743.3-353.9z\"/>  	<path d=\"M44.5,23.9c-1.8-1.5-3.6-3-5.4-4.4C34.5,15.7,30,12,25.5,8.2c-0.3-0.3-0.6-0.3-0.9,0c-2.1,1.8-4.3,3.5-6.4,5.3 		C14,17,9.8,20.4,5.6,23.8c-0.4,0.3-0.5,0.6-0.5,1c0,7.4,0,14.7,0,22.1c0,0.9,0.1,0.9,0.9,0.9c6.3,0,12.6,0,18.9,0 		c6.4,0,12.7,0,19.1,0c0.7,0,0.8-0.1,0.8-0.8c0-7.4,0-14.9,0-22.3C44.9,24.5,44.7,24.1,44.5,23.9z M43.8,46.3c0,0.1,0,0.3,0,0.4 		c-12.5,0-25,0-37.5,0c0-0.2,0-0.4,0-0.6c0-6.9,0-13.8,0-20.7c0-0.4,0.1-0.7,0.5-1c5.8-4.7,11.5-9.4,17.2-14.2 		c0.2-0.1,0.3-0.2,0.5-0.4c0.5-0.6,0.6-0.6,1.2,0c1.5,1.2,2.9,2.4,4.4,3.6c4.4,3.7,8.9,7.3,13.3,11c0.3,0.2,0.5,0.4,0.5,0.8 		C43.8,32.3,43.8,39.3,43.8,46.3z\"/> 	<path d=\"M48.6,22.7c-0.1-0.1-0.2-0.2-0.3-0.3c-1.2-1-2.4-1.9-3.6-2.9C38.4,14.3,32,9.1,25.7,3.9c-0.7-0.5-0.7-0.5-1.4,0 		C17.1,9.8,10,15.7,2.8,21.6c-0.5,0.4-0.9,0.8-1.4,1.2C1.1,23,1,23.3,1.2,23.6c0.3,0.3,0.6,0.3,0.9,0c0.1,0,0.1-0.1,0.2-0.1 		C8.6,18.4,14.8,13.2,21.1,8C22.4,7,23.7,5.9,25,4.8c0.2,0.2,0.4,0.3,0.5,0.4C32.7,11.1,39.8,17,47,22.9c0.3,0.2,0.5,0.4,0.8,0.6 		c0.3,0.3,0.6,0.4,0.9,0.1C49,23.3,48.9,23,48.6,22.7z\"/> 	<path d=\"M34.8,37c-0.1,0-0.2,0-0.3,0c-3.7,0-7.5,0-11.2,0c-0.2,0-0.4,0-0.6-0.1c-0.9-0.2-1.4-0.9-1.4-1.8c0-0.2,0-0.4,0-0.6 		c-2.1,0-4.1,0-6.1,0c0-0.1,0-0.2,0-0.3c0-2.1,0-4.2,0-6.3c0-0.1,0-0.1,0-0.2c0-0.3-0.2-0.5-0.5-0.5c-0.3-0.1-0.5,0.1-0.7,0.3 		c0,0-0.1,0.1-0.1,0.1c0,4.6,0,9.2,0,13.8c0.1,0.1,0.3,0.3,0.4,0.4c0.1,0,0.2,0,0.3,0c0.4-0.2,0.5-0.4,0.5-0.8c0-0.5,0-1.1,0-1.7 		c6.1,0,12.3,0,18.4,0c0,0.6,0,1.1,0,1.7c0,0.4,0.1,0.7,0.5,0.8c0.1,0,0.2,0,0.3,0c0.4-0.2,0.5-0.4,0.5-0.8c0-1.3,0-2.6,0-3.9 		C34.8,37.2,34.8,37.1,34.8,37z\"/> 	<path d=\"M25.2,23.7c-0.2,0.2-0.3,0.4-0.2,0.7c0.1,0.2,0.3,0.4,0.5,0.4c0.8,0,1.7,0,2.5,0c0.3,0,0.6-0.3,0.6-0.6 		c0-0.3-0.2-0.6-0.6-0.6c-0.3,0-0.5,0-0.8,0c0,0-0.1,0-0.2,0c0.4-0.4,0.9-0.9,1.3-1.3c0.1-0.1,0.2-0.2,0.2-0.3 		c0.2-0.3,0-0.6-0.4-0.8c-0.9,0-1.8,0-2.7,0c0,0-0.1,0-0.1,0.1c-0.3,0.1-0.4,0.4-0.4,0.7c0.1,0.3,0.3,0.5,0.6,0.5c0.1,0,0.2,0,0.4,0 		c0.2,0,0.4,0,0.5,0c0,0,0,0,0,0.1c-0.1,0-0.1,0.1-0.2,0.1C26,23,25.6,23.3,25.2,23.7z\"/> 	<path d=\"M22.5,32.8c0,0.7,0,1.5,0,2.2c0,0.6,0.2,0.8,0.8,0.8c3.7,0,7.5,0,11.2,0c0.1,0,0.1,0,0.2,0c0-1,0-2,0-3 		c0-1.1-0.8-1.9-1.9-1.9c-2.8,0-5.6,0-8.4,0c-0.2,0-0.4,0-0.6,0.1C23.1,31.2,22.6,31.9,22.5,32.8z\"/> 	<path d=\"M19.5,33.4c1,0,1.8-0.8,1.9-1.8c0-1-0.8-1.8-1.8-1.9c-1,0-1.8,0.8-1.9,1.8C17.6,32.5,18.5,33.3,19.5,33.4z\"/> 	<path d=\"M20.2,28.1c0.1,0.3,0.3,0.4,0.6,0.4c0.8,0,1.5,0,2.3,0c0.4,0,0.7-0.3,0.7-0.6c0-0.4-0.3-0.6-0.7-0.6c-0.3,0-0.6,0-0.9,0 		c0,0,0,0,0-0.1c0.1,0,0.1-0.1,0.2-0.1c0.4-0.4,0.8-0.8,1.2-1.2c0.2-0.2,0.3-0.4,0.2-0.7c-0.1-0.2-0.3-0.4-0.6-0.4 		c-0.8,0-1.6,0-2.5,0c-0.3,0-0.4,0.1-0.5,0.4C20,25.6,20.3,26,20.7,26c0.3,0,0.6,0,1,0c-0.5,0.5-0.9,0.9-1.4,1.3 		C20.1,27.6,20,27.8,20.2,28.1z\"/> </g> </svg>'),
(2, 'solid', 'roomStatus', '<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\" style=\"enable-background:new 0 0 50 50;\">\r\n<g id=\"roomStatus\">\r\n	<path d=\"M46.7,42.9c-0.4,0-0.8,0-1.2,0c0-3.5,0-7,0-10.5c0.7,0,1.3,0.4,1.8,1.2c0.3,0.4,0.6,0.5,0.9,0.3c0.3-0.2,0.4-0.6,0.1-0.9\r\n		c-0.5-0.7-1.1-1.2-1.9-1.5c-0.1,0-0.2-0.1-0.4-0.2c0.3-0.2,0.5-0.3,0.8-0.4c0.5-0.1,0.9-0.2,1.4-0.3c0.4-0.1,0.6-0.3,0.5-0.7\r\n		c0-0.3-0.3-0.5-0.6-0.5c-0.2,0-0.4,0-0.5,0.1c-0.7,0.2-1.3,0.4-2,0.6c0,0,0-0.1,0-0.2c-0.2-0.9-0.7-1.6-1.4-2.2\r\n		c-0.3-0.2-0.7-0.2-0.9,0.1c-0.2,0.3-0.2,0.6,0.1,0.8c0.1,0.1,0.1,0.1,0.2,0.2c0.4,0.4,0.7,0.8,0.8,1.5c-0.2-0.1-0.3-0.2-0.4-0.2\r\n		c-0.7-0.4-1.4-0.6-2.2-0.6c-0.3,0-0.6,0.2-0.6,0.5c-0.1,0.3,0.1,0.6,0.5,0.7c0.1,0,0.2,0,0.3,0c0.6,0.1,1.3,0.3,1.9,0.7\r\n		c-0.2,0.1-0.3,0.1-0.4,0.2c-0.8,0.3-1.4,0.8-1.9,1.6c-0.2,0.4-0.2,0.7,0.1,0.9c0.3,0.2,0.6,0.1,0.9-0.2c0.1-0.1,0.1-0.2,0.2-0.3\r\n		c0.4-0.5,0.9-0.8,1.6-0.9c0,3.5,0,7,0,10.5c-1.3,0-2.6,0-3.9,0c0-0.2,0-0.4,0-0.5c0-5.6,0-11.2,0-16.8c0-0.1,0-0.2,0-0.4\r\n		c0-0.4-0.2-0.7-0.6-0.7c-0.4,0-0.6,0.2-0.6,0.7c0,0.1,0,0.2,0,0.4c0,5.6,0,11.2,0,16.8c0,0.2,0,0.3,0,0.5c-1.6,0-3.1,0-4.6,0\r\n		c0-0.2,0-0.4,0-0.5c0-2.7,0-5.3,0-8c0-0.8-0.2-0.9-0.9-0.9c-3.4,0-6.8,0-10.2,0c-0.1,0-0.2,0-0.4,0c-0.4,0-0.6,0.3-0.6,0.6\r\n		c0,1.2,0,2.3,0,3.5c0,0.4,0.3,0.6,0.6,0.6c0.3,0,0.6-0.3,0.6-0.7c0-0.8,0-1.6,0-2.4c0-0.1,0-0.3,0-0.4c1.4,0,2.8,0,4.2,0\r\n		c0,2.7,0,5.5,0,8.2c-1.4,0-2.8,0-4.2,0c0-0.2,0-0.3,0-0.5c0-0.8,0-1.6,0-2.3c0-0.4-0.2-0.7-0.6-0.7c-0.4,0-0.6,0.2-0.6,0.7\r\n		c0,0.6,0,1.2,0,1.8c0,0.3,0,0.7,0,1c-1.6,0-3.1,0-4.6,0c0-0.2,0-0.4,0-0.5c0-8.3,0-16.7,0-25c0-0.2,0-0.3,0-0.5\r\n		c0-0.3-0.2-0.5-0.6-0.5c-0.3,0-0.5,0.1-0.6,0.5c0,0.2,0,0.3,0,0.5c0,8.4,0,16.7,0,25.1c0,0.2,0,0.3,0,0.5c-1.3,0-2.6,0-3.9,0\r\n		c0-3.5,0-7,0-10.5c0.8,0.1,1.4,0.5,1.8,1.2c0.3,0.4,0.6,0.5,0.9,0.3c0.3-0.2,0.4-0.6,0.1-1c-0.5-0.7-1.1-1.2-1.9-1.5\r\n		c-0.1-0.1-0.3-0.1-0.5-0.2c0.3-0.2,0.5-0.3,0.7-0.4c0.5-0.1,0.9-0.2,1.4-0.3c0.4-0.1,0.6-0.3,0.6-0.6c0-0.3-0.3-0.6-0.7-0.6\r\n		c-0.2,0-0.4,0-0.5,0.1c-0.7,0.2-1.4,0.4-2.1,0.7c0,0,0-0.1,0-0.2c0.2-0.5,0.5-1,0.9-1.3c0.3-0.2,0.3-0.6,0.1-0.9\r\n		c-0.2-0.3-0.6-0.3-0.9-0.1c-0.2,0.1-0.4,0.3-0.5,0.5c-0.5,0.5-0.8,1.2-0.9,1.8c-0.8-0.2-1.6-0.4-2.4-0.6c-0.4-0.1-0.7,0.2-0.7,0.5\r\n		c0,0.4,0.2,0.6,0.7,0.7c0.6,0.1,1.1,0.3,1.6,0.5c0.1,0,0.2,0.2,0.4,0.3c-0.2,0.1-0.3,0.1-0.4,0.1c-0.8,0.3-1.5,0.8-1.9,1.6\r\n		c-0.2,0.3-0.1,0.7,0.2,0.9c0.3,0.2,0.6,0.1,0.8-0.2c0.1-0.1,0.1-0.2,0.2-0.2c0.4-0.5,1-0.9,1.7-1c0,3.5,0,7,0,10.5\r\n		c-0.4,0-0.9,0-1.3,0c-0.9,0-1.6,0.4-2,1.1c-0.2,0.2-0.2,0.5-0.4,0.8c0,0.3,0,0.5,0,0.8c0.6,1.4,1.2,1.9,2.4,1.9\r\n		c12.2,0,24.3,0,36.5,0c1.4,0,2.4-1,2.4-2.3C49.2,43.9,48.1,42.9,46.7,42.9z M29.1,34.7c1.4,0,2.7,0,4.2,0c0,2.7,0,5.5,0,8.2\r\n		c-1.4,0-2.8,0-4.2,0C29.1,40.2,29.1,37.4,29.1,34.7z M46.5,46.4c-6,0-12,0-18,0c-6,0-12,0-18,0c-0.2,0-0.5,0-0.7-0.1\r\n		C9.3,46.1,9,45.7,9,45.2c0-0.5,0.4-0.9,0.9-1c0.2,0,0.4,0,0.6,0c12,0,24,0,36.1,0c0.9,0,1.4,0.4,1.4,1.1\r\n		C48,45.9,47.4,46.4,46.5,46.4z\"/>\r\n	<path d=\"M15.2,9.4c0,0.7,0.4,1.2,1.1,1.4c0.3,0.1,0.3,0.2,0.3,0.4c0,1,0,2,0,2.9c0,0.6,0.2,0.9,0.6,0.9c0.4,0,0.6-0.3,0.6-0.9\r\n		c0-1,0-1.9,0-2.9c0-0.1,0-0.3,0-0.4c7.1,0,14.2,0,21.3,0c0,0.2,0,0.4,0,0.5c0,3.6,0,7.3,0,10.9c0,0.1,0,0.3,0,0.4\r\n		c0,0.3,0.2,0.5,0.5,0.5c0.3,0,0.6-0.1,0.6-0.4c0-0.2,0-0.3,0-0.5c0-3.7,0-7.4,0-11.1c0-0.3,0-0.4,0.3-0.5c0.6-0.1,1-0.7,1.1-1.3\r\n		c0-0.5,0-1,0-1.5c0.1-0.9-0.3-1.5-1.1-1.8c-8.1,0-16.3,0-24.4,0c-0.8,0.3-1.1,0.9-1.1,1.8C15.3,8.5,15.2,9,15.2,9.4z M16.8,7.4\r\n		c0.1,0,0.2,0,0.2,0c7.6,0,15.3,0,22.9,0c0.6,0,0.6,0,0.6,0.6c0,0.4,0,0.8,0,1.2c0,0.3-0.1,0.4-0.4,0.4c-1.8,0-3.6,0-5.4,0\r\n		c-2.1,0-4.2,0-6.3,0c-3.8,0-7.6,0-11.5,0c-0.6,0-0.6,0-0.6-0.6c0-0.4,0-0.9,0-1.3C16.4,7.5,16.5,7.4,16.8,7.4z\"/>\r\n	<path d=\"M30.7,22.3c0-0.4,0-0.8,0-1.1c0-0.7-0.4-1.1-1.1-1.1c-0.8,0-1.5,0-2.3,0c-0.7,0-1.1,0.4-1.1,1.1c0,0.8,0,1.5,0,2.3\r\n		c0,0.7,0.4,1.1,1.1,1.1c0.8,0,1.6,0,2.3,0c0.7,0,1-0.4,1.1-1.1C30.8,23,30.7,22.6,30.7,22.3z M29.5,23.3c-0.7,0-1.3,0-2,0\r\n		c0-0.7,0-1.3,0-2c0.7,0,1.3,0,2,0C29.5,21.9,29.5,22.6,29.5,23.3z\"/>\r\n	<path d=\"M20.2,22.2c0,0.4,0,0.8,0,1.2c0,0.6,0.4,1,1,1c0.8,0,1.7,0,2.5,0c0.6,0,1-0.4,1-1c0-0.8,0-1.6,0-2.4c0-0.6-0.4-1-1-1\r\n		c-0.8,0-1.7,0-2.5,0c-0.6,0-1,0.4-1,1C20.2,21.5,20.2,21.8,20.2,22.2z M21.5,21.3c0.6,0,1.3,0,2,0c0,0.6,0,1.3,0,2\r\n		c-0.7,0-1.3,0-2,0C21.5,22.6,21.5,22,21.5,21.3z\"/>\r\n	<path d=\"M32.3,22.3c0,0.4,0,0.8,0,1.2c0,0.6,0.4,1.1,1,1.1c0.8,0,1.6,0,2.5,0c0.6,0,1-0.4,1-1c0-0.8,0-1.6,0-2.4c0-0.6-0.4-1-1-1\r\n		c-0.8,0-1.6,0-2.5,0c-0.6,0-1,0.4-1,1C32.3,21.5,32.3,21.9,32.3,22.3z M33.5,21.3c0.6,0,1.3,0,2,0c0,0.7,0,1.3,0,2\r\n		c-0.7,0-1.3,0-2,0C33.5,22.6,33.5,22,33.5,21.3z\"/>\r\n	<path d=\"M27.3,17.9c0.4,0,0.8,0,1.1,0c0.4,0,0.8,0,1.1,0c0,0,0.1,0,0.1,0c0.6,0,1-0.4,1-1c0-0.8,0-1.6,0-2.5c0-0.6-0.4-1-1-1\r\n		c-0.8,0-1.6,0-2.4,0c-0.6,0-1,0.4-1,1c0,0.8,0,1.6,0,2.5C26.3,17.5,26.7,17.9,27.3,17.9z M27.5,14.7c0.7,0,1.3,0,2,0\r\n		c0,0.7,0,1.3,0,2c-0.7,0-1.3,0-2,0C27.5,16,27.5,15.4,27.5,14.7z\"/>\r\n	<path d=\"M29.7,26.6c-0.8,0-1.6,0-2.5,0c-0.6,0-1,0.4-1,1c0,0.8,0,1.7,0,2.5c0,0.6,0.4,1,1.1,1c0.4,0,0.8,0,1.2,0s0.8,0,1.2,0\r\n		c0.6,0,1.1-0.4,1.1-1c0-0.8,0-1.6,0-2.5C30.7,27,30.3,26.6,29.7,26.6z M29.5,29.9c-0.7,0-1.3,0-2,0c0-0.7,0-1.3,0-2\r\n		c0.7,0,1.3,0,2,0C29.5,28.6,29.5,29.2,29.5,29.9z\"/>\r\n	<path d=\"M21.3,31.1c0.8,0,1.6,0,2.4,0c0.6,0,1-0.4,1-1.1c0-0.8,0-1.6,0-2.4c0-0.6-0.4-1-1-1c-0.8,0-1.6,0-2.5,0c-0.6,0-1,0.4-1,1\r\n		c0,0.4,0,0.8,0,1.2c0,0.4,0,0.8,0,1.2C20.3,30.7,20.7,31.1,21.3,31.1z M21.5,27.9c0.7,0,1.3,0,2,0c0,0.7,0,1.3,0,2\r\n		c-0.7,0-1.3,0-2,0C21.5,29.2,21.5,28.5,21.5,27.9z\"/>\r\n	<path d=\"M33.3,31.1c0.8,0,1.6,0,2.5,0c0.6,0,1-0.4,1-1c0-0.4,0-0.8,0-1.2c0,0,0,0,0,0c0-0.4,0-0.8,0-1.2c0,0,0-0.1,0-0.1\r\n		c0-0.6-0.4-0.9-0.9-1c-0.8,0-1.7,0-2.5,0c-0.6,0-1,0.4-1,1c0,0.8,0,1.6,0,2.5C32.3,30.7,32.7,31.1,33.3,31.1z M33.5,27.9\r\n		c0.7,0,1.3,0,2,0c0,0.7,0,1.3,0,2c-0.7,0-1.3,0-2,0C33.5,29.2,33.5,28.5,33.5,27.9z\"/>\r\n	<path d=\"M21.3,17.9c0.8,0,1.6,0,2.4,0c0.6,0,1-0.4,1-1c0-0.8,0-1.6,0-2.4c0-0.6-0.4-1-1-1c-0.4,0-0.8,0-1.2,0c-0.4,0-0.9,0-1.3,0\r\n		c-0.6,0-1,0.4-1,1c0,0.8,0,1.6,0,2.5C20.3,17.5,20.7,17.9,21.3,17.9z M21.5,14.7c0.7,0,1.3,0,2,0c0,0.7,0,1.3,0,2c-0.7,0-1.3,0-2,0\r\n		C21.5,16,21.5,15.4,21.5,14.7z\"/>\r\n	<path d=\"M33.3,17.9c0.8,0,1.6,0,2.4,0c0.6,0,1-0.4,1-1c0-0.4,0-0.8,0-1.2c0-0.4,0-0.8,0-1.2c0-0.6-0.4-1-1-1c-0.8,0-1.6,0-2.4,0\r\n		c-0.6,0-1,0.4-1,1c0,0.8,0,1.6,0,2.4C32.3,17.5,32.7,17.9,33.3,17.9z M33.5,14.7c0.7,0,1.3,0,2,0c0,0.7,0,1.3,0,2c-0.7,0-1.3,0-2,0\r\n		C33.5,16,33.5,15.4,33.5,14.7z\"/>\r\n	<path d=\"M3.2,10c-0.3,0-0.5,0-0.8,0c-0.3,0-0.5,0.2-0.6,0.4c0,0,0,0.1,0,0.1c0,0.9,0,1.8,0,2.7c0,0,0,0,0,0\r\n		c0.1,0.3,0.3,0.5,0.7,0.5c0.2,0,0.5,0,0.7,0c0.4,0,0.7-0.3,0.7-0.7c0-0.2,0-0.4,0-0.6c0-0.6,0-1.2,0-1.8C3.8,10.3,3.6,10,3.2,10z\r\n		 M3.4,13.1c0,0.2-0.1,0.3-0.3,0.3c-0.2,0-0.5,0-0.7,0c-0.2,0-0.3-0.1-0.3-0.3c0-0.8,0-1.6,0-2.4c0-0.2,0.1-0.3,0.3-0.3\r\n		c0.2,0,0.5,0,0.7,0c0.2,0,0.3,0.1,0.3,0.3c0,0.4,0,0.8,0,1.2S3.4,12.7,3.4,13.1z\"/>\r\n	<path d=\"M9.5,7.5c0.1,0,0.2-0.1,0.2-0.3c0,0,0,0,0-0.1c0-0.9,0-1.8,0-2.7c0,0,0-0.1,0-0.1c0-0.1,0.1-0.2,0.2-0.2c0.3,0,0.6,0,0.8,0\r\n		c0.1,0,0.2,0.1,0.2,0.2c0,0,0,0.1,0,0.1c0,1.2,0,2.4,0,3.6c0,0.2,0.1,0.3,0.2,0.3c0.1,0,0.2-0.1,0.2-0.2c0-1.2,0-2.5,0-3.7\r\n		c0-0.2-0.1-0.4-0.3-0.5c-0.1-0.1-0.2-0.1-0.3-0.1c-0.4,0-0.7,0-1.1,0c0,0,0,0,0,0C9.4,3.8,9.3,4.1,9.3,4.4c0,0.9,0,1.9,0,2.8\r\n		C9.3,7.4,9.3,7.5,9.5,7.5z\"/>\r\n	<path d=\"M8.3,12.7c0,0,0.1,0.1,0.1,0.1c0.1,0,0.1,0.1,0.1,0.1c0,0.2,0,0.3,0,0.5c0,0.2,0.2,0.3,0.4,0.4c0.2,0,0.4,0,0.6,0\r\n		c0.2,0,0.4-0.1,0.4-0.4c0-0.1,0-0.3,0-0.4c0-0.1,0-0.2,0.1-0.2c0.1,0,0.1-0.1,0.2-0.1c0,0,0.1,0,0.1,0c0.1,0.1,0.3,0.1,0.4,0.2\r\n		c0.1,0,0.1,0,0.2,0.1c0.2,0,0.3-0.1,0.4-0.2c0.1-0.2,0.2-0.4,0.3-0.6c0.1-0.2,0.1-0.4-0.1-0.6c-0.1-0.1-0.2-0.1-0.3-0.2\r\n		c-0.1-0.1-0.1-0.1-0.1-0.2c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0.1-0.1c0.1-0.1,0.2-0.2,0.4-0.3c0.2-0.1,0.2-0.3,0.1-0.5\r\n		c-0.1-0.2-0.2-0.4-0.3-0.6c-0.1-0.2-0.3-0.3-0.5-0.2c-0.1,0-0.2,0.1-0.3,0.2c-0.1,0-0.2,0.1-0.2,0c0,0-0.1-0.1-0.2-0.1\r\n		c-0.1,0-0.1-0.1-0.1-0.1C10,9,10,8.8,10,8.7c0-0.2-0.2-0.3-0.4-0.3c-0.2,0-0.5,0-0.7,0c-0.2,0-0.4,0.1-0.4,0.3c0,0.1,0,0.3,0,0.4\r\n		c0,0.1,0,0.2-0.2,0.3c-0.1,0-0.1,0.1-0.2,0.1c0,0-0.1,0-0.1,0C7.9,9.3,7.8,9.3,7.7,9.2c-0.2-0.1-0.4,0-0.5,0.2\r\n		C7,9.6,6.9,9.8,6.8,10c-0.1,0.2-0.1,0.4,0.1,0.5c0.1,0.1,0.2,0.2,0.3,0.2c0.1,0.1,0.1,0.1,0.1,0.2c0,0.1,0,0.1,0,0.2\r\n		c0,0,0,0.1,0,0.1c-0.1,0.1-0.2,0.2-0.4,0.3c-0.2,0.1-0.2,0.3-0.1,0.5c0.1,0.2,0.2,0.4,0.3,0.6c0.1,0.2,0.3,0.3,0.5,0.2\r\n		c0.1,0,0.2-0.1,0.3-0.1C8.1,12.6,8.2,12.6,8.3,12.7z M7.5,12.5c-0.1-0.2-0.2-0.4-0.3-0.6c0.2-0.1,0.3-0.2,0.5-0.4\r\n		c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.3,0-0.4c0-0.1,0-0.2-0.1-0.3c-0.2-0.1-0.3-0.2-0.5-0.4C7.3,10,7.4,9.8,7.5,9.6\r\n		C7.7,9.7,7.8,9.8,8,9.8c0.1,0.1,0.2,0,0.3,0c0.1-0.1,0.2-0.2,0.4-0.2c0.1-0.1,0.2-0.1,0.2-0.2c0-0.2,0-0.4,0-0.5c0,0,0,0,0-0.1\r\n		c0.2,0,0.4,0,0.6,0c0,0.2,0,0.4,0.1,0.6c0,0.2,0.1,0.2,0.2,0.3c0.1,0.1,0.2,0.1,0.3,0.2c0.1,0.1,0.2,0.1,0.3,0\r\n		c0.2-0.1,0.3-0.2,0.5-0.3c0.1,0.2,0.2,0.4,0.3,0.6c-0.1,0.1-0.3,0.2-0.4,0.3c-0.1,0.1-0.2,0.2-0.1,0.4c0,0.1,0,0.3,0,0.4\r\n		c0,0.1,0,0.2,0.1,0.3c0.2,0.1,0.3,0.2,0.5,0.4c-0.1,0.2-0.2,0.4-0.3,0.6c-0.2-0.1-0.4-0.2-0.5-0.2c-0.1-0.1-0.2-0.1-0.3,0\r\n		c-0.1,0.1-0.2,0.2-0.4,0.2c-0.1,0.1-0.2,0.1-0.2,0.2c0,0.2,0,0.3,0,0.5c0,0.1,0,0.1-0.1,0.1c-0.2,0-0.4,0-0.6,0\r\n		c0-0.2,0-0.4-0.1-0.6c0-0.2-0.1-0.2-0.2-0.3c-0.1,0-0.2-0.1-0.3-0.2c-0.1-0.1-0.2-0.1-0.3,0C7.8,12.3,7.7,12.4,7.5,12.5z\"/>\r\n	<path d=\"M5.7,8.3c-0.3,0-0.5,0-0.8,0C4.5,8.3,4.2,8.6,4.2,9c0,0.7,0,1.4,0,2c0,0.7,0,1.4,0,2.1c0,0.4,0.3,0.6,0.6,0.6\r\n		c0.3,0,0.5,0,0.8,0c0.4,0,0.7-0.3,0.7-0.7c0-1.4,0-2.7,0-4.1C6.3,8.6,6.1,8.3,5.7,8.3z M5.9,13.1c0,0.2-0.1,0.3-0.3,0.3\r\n		c-0.2,0-0.5,0-0.7,0c-0.2,0-0.3-0.1-0.3-0.3c0-1.4,0-2.7,0-4.1c0-0.2,0.1-0.3,0.3-0.3c0.2,0,0.5,0,0.7,0c0.2,0,0.3,0.1,0.3,0.3\r\n		c0,0.7,0,1.4,0,2C5.9,11.7,5.9,12.4,5.9,13.1z\"/>\r\n	<path d=\"M6.9,8.3c0.1,0,0.3-0.1,0.3-0.2c0-0.5,0-1.1,0-1.6c0-0.2,0.1-0.3,0.3-0.3c0.2,0,0.5,0,0.7,0c0.2,0,0.3,0.1,0.3,0.3\r\n		c0,0.3,0,0.5,0,0.8c0,0.1,0.1,0.2,0.2,0.2c0.1,0,0.2-0.1,0.2-0.2c0-0.3,0-0.5,0-0.8c0-0.4-0.3-0.6-0.6-0.6c-0.3,0-0.5,0-0.8,0\r\n		C7,5.8,6.8,6.1,6.8,6.5c0,0.3,0,0.5,0,0.8c0,0.3,0,0.6,0,0.8C6.8,8.2,6.8,8.3,6.9,8.3z\"/>\r\n	<path d=\"M9.3,12.1c0.6,0,1-0.5,1-1c0-0.6-0.5-1-1-1c-0.6,0-1,0.5-1,1C8.2,11.6,8.7,12.1,9.3,12.1z M9.3,10.4c0.3,0,0.6,0.3,0.6,0.6\r\n		c0,0.3-0.3,0.6-0.6,0.6c-0.3,0-0.6-0.3-0.6-0.6C8.6,10.7,8.9,10.4,9.3,10.4z\"/>\r\n</g>\r\n</svg>\r\n'),
(3, 'solid', 'lunch', '<svg id=\"lunchIcon\" x=\"0px\" y=\"0px\" viewBox=\"0 0 35 35\"><g><path d=\"M32.4,19.9c-1.1,0-2,0.9-2,2v8.7H4.7V4.9h8.9c1.1,0,2-0.9,2-2s-0.9-2-2-2H3.3C1.9,0.9,0.7,2,0.7,3.5V32 c0,1.4,1.2,2.6,2.6,2.6h28.5c1.4,0,2.6-1.2,2.6-2.6V21.9C34.4,20.8,33.5,19.9,32.4,19.9z\"/><path d=\"M34.4,2.9C34.4,2.8,34.4,2.8,34.4,2.9c0-0.1,0-0.2,0-0.3c0,0,0,0,0,0c0,0,0,0,0-0.1c0,0,0,0,0,0 c0-0.1-0.1-0.2-0.1-0.3c0,0,0-0.1,0-0.1c0-0.1-0.1-0.2-0.1-0.3c0,0,0,0,0-0.1C34,1.7,34,1.6,33.9,1.5c0,0-0.1-0.1-0.1-0.1 c0,0,0,0,0,0c-0.1,0-0.1-0.1-0.2-0.1c0,0-0.1-0.1-0.1-0.1c-0.1-0.1-0.2-0.1-0.2-0.1c0,0-0.1,0-0.1-0.1C33.1,1,33,1,32.9,0.9 c0,0-0.1,0-0.1,0c-0.1,0-0.2,0-0.3,0c0,0-0.1,0-0.1,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0l0,0c0,0,0,0-0.1,0l-9.5,0.1 c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2c0,0,0,0,0,0l4.9,0L12.8,21c-0.8,0.8-0.7,2.1,0.1,2.8c0.4,0.4,0.9,0.5,1.4,0.5 c0.5,0,1.1-0.2,1.5-0.6L30.4,8l0,4.4c0,1.1,0.9,2,2,2c0,0,0,0,0,0c1.1,0,2-0.9,2-2L34.4,2.9C34.4,2.9,34.4,2.9,34.4,2.9 C34.4,2.9,34.4,2.9,34.4,2.9z\"/></g></svg>');

-- --------------------------------------------------------

--
-- Table structure for table `sys_theme_color`
--

CREATE TABLE `sys_theme_color` (
  `id` int(11) NOT NULL,
  `primaryClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `primaryClrHover` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `textClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `bgClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `bgClr2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderClr2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `borderHoverClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `waBtnClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `warning` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `warning2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `tooltipClr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `tooltipBg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sys_theme_color`
--

INSERT INTO `sys_theme_color` (`id`, `primaryClr`, `primaryClrHover`, `textClr`, `bgClr`, `bgClr2`, `borderClr`, `borderClr2`, `borderHoverClr`, `waBtnClr`, `warning`, `warning2`, `tooltipClr`, `tooltipBg`) VALUES
(1, '#4133b7,#03dac5', '#4133b7,#01d1bd', '#000000,#ffffff', '#ffffff,#000000', '#ffffff,#060606', '#edf2f7,#121212', '#e4e4e7,#262626', '#f4f4f5,#1d1d1d', '#26f209,#26f209', '#feebc8,#feebc8', '#744210,#744210', '#ffffff,#ffffff', '#353535,#2d2d2d');

-- --------------------------------------------------------

--
-- Table structure for table `sys_userrole`
--

CREATE TABLE `sys_userrole` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sys_userrole`
--

INSERT INTO `sys_userrole` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Chief Cashier'),
(3, 'Front Office Clerk'),
(4, 'Front Office Manager'),
(5, 'General Manager'),
(6, 'House Keeping'),
(7, 'Night Auditor'),
(8, 'Reservation Clerk'),
(9, 'Reservation Manager'),
(10, 'Waiter');

-- --------------------------------------------------------

--
-- Table structure for table `travelagentgroup`
--

CREATE TABLE `travelagentgroup` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `travelagentgroup`
--

INSERT INTO `travelagentgroup` (`id`, `name`) VALUES
(1, 'FIT'),
(2, 'GIT'),
(3, 'KDT'),
(4, 'MICE');

-- --------------------------------------------------------

--
-- Table structure for table `travel_agents`
--

CREATE TABLE `travel_agents` (
  `id` int(11) NOT NULL,
  `agentName` varchar(250) DEFAULT NULL,
  `travelagentname` varchar(255) DEFAULT NULL,
  `hotelId` varchar(255) DEFAULT NULL,
  `travelagentemail` varchar(255) DEFAULT NULL,
  `travelagentAddress` text DEFAULT NULL,
  `travelagrntCity` varchar(255) DEFAULT NULL,
  `travelagentState` varchar(255) DEFAULT NULL,
  `travelagentCountry` varchar(255) DEFAULT NULL,
  `travelagentPostCode` varchar(20) DEFAULT NULL,
  `travelagentPhoneno` varchar(20) DEFAULT NULL,
  `travelagentGstNo` varchar(20) DEFAULT NULL,
  `travelagentcommission` decimal(10,2) DEFAULT NULL,
  `travelaaagentGstonCommision` decimal(10,2) DEFAULT NULL,
  `travelaaagentTcs` decimal(10,2) DEFAULT NULL,
  `travelaaagentTds` decimal(10,2) DEFAULT NULL,
  `travelagentNote` text DEFAULT NULL,
  `travelagentGroup` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `url_mapping`
--

CREATE TABLE `url_mapping` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `short_code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `long_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `addOn` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `url_mapping`
--

INSERT INTO `url_mapping` (`id`, `hotelId`, `short_code`, `long_url`, `addOn`) VALUES
(1, '41517', '65ba177217e8e', 'https://mercury-t2.phonepe.com/transact/pg?token=ZDM5YjQ5MGM5NzAzOTljY2IxNmM3ODcxMzU3MGNkMjUyYWRhMGRkMzg1NDZlNDk5ODlhNDJmOTAxYWM5YWRmYjRkMzVhY2JiNGI0ZjBlOWY6Yzk1MTVkYmY1NGY5MmE4NGJlYWUxMWQyNDAxMDZlODM', '2024-01-31 03:18:34'),
(2, '', '65c3cbb906927', 'avinab.giri', '2024-02-07 11:58:09'),
(3, '41517', '65d8426f7c763', 'https://mercury-t2.phonepe.com/transact/pg?token=ZmE1OGI5ZWMyYTUzYWU5NDUzZGY3MWU5ZDdkMjgyMWIyMDI4YzNlMWJhNjI1MWQ1ZWQwOWQ5MGVlYjMwNjQwOTE3OTZmNzQ4OGVkYjc2MTQ6OTQ2NzFkOTMwNTQ2ZmVjYmFjZTYyNzZiMGE1Y2Q3YzI', '2024-02-23 12:29:59'),
(4, '41517', '65e58f4b48e2d', 'https://mercury-t2.phonepe.com/transact/pg?token=ZGRkYzMyOGZlZGYwNDExY2Y1ZGMxNGYzNTJlZGRmZmNkMGUyOTAwZjkxOGVjNDMzYmZmMTdmZDk3NDg4NzFlMTZmZjViOWI2ZDcyMDE4ZjM6MTAyMzZhZTU0NzczMDE2ZGEwNmY5Nzk4OWRmZDQ1MmE', '2024-03-04 02:37:23'),
(5, '41517', '65e59028b107f', 'https://mercury-t2.phonepe.com/transact/pg?token=YWFlMjk2M2ZmNjcwYmM3ZDAyYTUyNjI4NjkwMWY3ZGU1NGVmMDRiMTljNTkzNTYxOTRlOWUwYzZhYjAwMTMyY2E4YTRjNDQ3MGI0MjQ5NGE6MWQyYzRlYjFmYTkzODM5NjIwYjRiNGExYzY3NGJiZDE', '2024-03-04 02:41:04'),
(6, '41517', '65e59237d91a1', 'https://mercury-t2.phonepe.com/transact/pg?token=ZjA4NGFiNDlkYzRhMTc3YmUxYzcxOGUxNjNlNTRkNzY5NmEwNjQwYzRlNGQ1NTE1ODcwYzU5YzJjZTQ2YzJkNTJiMzY5M2FlNDI2MmY5ZTc6MjgzOTBhYmNiZTE1NTcxY2ZmYzEyODEwNDIyZjg1MzI', '2024-03-04 02:49:51'),
(7, '41517', '65e59580e625e', 'https://mercury-t2.phonepe.com/transact/pg?token=MmQwNDgzZmRkZDgzOTEwNGZiNzk5MWM0ZjVmYjJlYzA0MThlMzViYWFmZmYwNmNlNzJmNjhiYTdlNTdiZTJlNGNiOWMzNTJmMTI1NmNjNWY6NmQ4N2Y5MjJjZDk3MTQxOTBjN2JkZWRlYjQ1ZjhkNTc', '2024-03-04 03:03:52'),
(8, '41517', '65e595fedab48', 'https://mercury-t2.phonepe.com/transact/pg?token=ZTE1ZmVmMmNkZTlhNmVhYTU0YzYwYjg4YWI4MzZlOTRjMTkxNTMzNGU5YzQxY2QyOWFjM2NiZjEzYmQ5MDIyN2Y0NDU4MzVlYmEyMGFmOmFkMmY1MjNlMWQ4MDczNjU5Mzc5Njg4YTBjNjUxODY1', '2024-03-04 03:05:58'),
(9, '41517', '65e59c15008e6', 'https://mercury-t2.phonepe.com/transact/pg?token=ZmEzMjU3NTkzZmRiMjE1YTg0Mjc4NWEzYjQxZGY3MWVjZjAxNWU0NDdmYTRjNGU1YjAwOGMwYTc1MzM4MGY5ZDU0OTkxZTQwYTQ5NDAyMjA6MTFiZGRjN2JjNmM5YjNhNGMyNmYzNGY1YWUyNjExNjI', '2024-03-04 03:31:57'),
(10, '41517', '65e59f30991c2', 'https://mercury-t2.phonepe.com/transact/pg?token=ZTc4YTE5NWJmOTQyNmY0NGE0ZWJlZWUyZTBlMDEwYWE2MGQ3MzJiOWVlNTM3ZDZjNTExOWY1MDVhMGNiMWRkZWUzMjVhNTY1M2M1YTo5MzE0MGU1Mjg2ZjdiNzg3OTM3NmUxMzQ0ZGYwZmRhMg', '2024-03-04 03:45:12'),
(11, '41517', '65e5a041cea5d', 'https://mercury-t2.phonepe.com/transact/pg?token=ZGI5MzIwNDRiMmNhY2FhMDk2MDE1ZThkZmVhOWM2OTUyZTU0ODZhNDA5OGJkYzBiMjBiNjQyYzYyZTY5YjFiMjA2YjBlMDE3ZmQ3MWEyOjE3MmU2MzcwZWM1YmI0MzM0YmQyNjFkZGJmNmIzZGFj', '2024-03-04 03:49:45'),
(12, '41517', '65e5a0cb385bd', 'https://mercury-t2.phonepe.com/transact/pg?token=MWZjZGRmMjY3ZWFjOWE3ZDZlZGFmMmUyMjJkZGQyMmYyMDc4MWI4ZGUzNTZlNzY0ODVkMmQ3MjEyYzY4NWEzYjgwN2UxOGU5ZmEwYzk5OjQ1OWZjNWE1Y2M0ZjM0NjllNjRmMTViNmJkNTQ2NmI2', '2024-03-04 03:52:03'),
(13, '41517', '65e5a7c41ec8d', 'https://mercury-t2.phonepe.com/transact/pg?token=NTk2ZWY4YzgyNWQ2Yzg2ZDRkZmI2YTQ3MDdiMzU5NjcxOGVkMjU5NGEwNmFlYzY3Y2U0MDFmNGJiZTI2NWY2NWI5Y2U2NjFiMzc0NDZlOmI5MGZiMWNmMjk5ODBjMmQ1OGM5NDQyNjVkMDVmMzg1', '2024-03-04 04:21:48'),
(14, '41517', '65e5a914732ed', 'https://mercury-t2.phonepe.com/transact/pg?token=YjNiOWFjNmY2Njg1MmE1NWZhNmZjYzQ0ZGU2MzBiZmI5ZmNkMTU3NDQ2OTc4ZDQ1ZTY1YWYzMTFjZWU2MzFjZTVmM2FiNGJjY2QxMDJjOjFkNWY0OWFlODYwN2Q0YmJiMjU4NWI2N2VlYmVkN2My', '2024-03-04 04:27:24'),
(15, '41517', '65e5b474ea456', 'https://mercury-t2.phonepe.com/transact/pg?token=NTIyOGNiOWU4MjAyYjkxZGY2MjA4NzA2MDcxMmI3MjhjNDQ2ZDA4ZTBmMDIxYjM1ZTdiNzJmZDYwN2YwMmUxYzJhNzIyYjMwNzU3ODRhOmEzMThkMGJlYmQyNjcyNDkwNWQyYTJkYTkxMjYwYmVh', '2024-03-04 05:15:56'),
(16, '41517', '65e5bee072067', 'https://mercury-t2.phonepe.com/transact/pg?token=ZWZiNzhhMjcwNjUwYzQ2N2Y1YmU0Y2M0ZjkxNTI2ZDQzOTZlZjQyNTJiMGMyMmRkZmFiY2Q0YmM2MzZlZDE0NmI5NmI2MjczN2IxZDVhOjczNzkyZDU2MjQ1NGU2MjhjZjJmYjBhOTMyNTMxOGVj', '2024-03-04 06:00:24'),
(17, '41517', '65e5ca039c04d', 'https://mercury-t2.phonepe.com/transact/pg?token=OGQzOGFiNTVkOWY3ZGI0Y2Q3NmQzM2UyMTBjMDEyNmE5NzZiZjJmNWEyYWVlNWNhZGQwN2E5NmZkZGViNjFjMzBkNDQ0YmM1YWNiNGYyOmY3ODEzMjg0OGFiMTgzZDc5OTY3YTZkMDk2NzZlNDlk', '2024-03-04 06:47:55'),
(18, '41517', '65e5d1393d269', 'https://mercury-t2.phonepe.com/transact/pg?token=ZjU3YWIwNDMwZjg0NzAxMDE4Yjk5YTljNGU5NmEyMWQzMzg4M2QxYTI0YzNiZjY3N2RmM2RhMzc0NTU3NjIxN2Y0ZjExZTlmZjBhMzpkZDQ0MjhjZjEwNzVjMDQ4NzMxZGI5YmUzYTkxNTdhYg', '2024-03-04 07:18:41'),
(19, '41517', '65e6b9e6c9836', 'https://mercury-t2.phonepe.com/transact/pg?token=NGU5YTZjZmRmZjYwZmE3YjdiYzc0MmFmZGQwNjgzZWUwNGYyZDZmNWRkMDNjNzRmNDhkMTBhN2E3OTMyZTBmMGU1ZWMzNGE0ZmRjYzIzOmFhMDVhMWUyMzE3MGRiYWU0NTg1YzBlN2FjMTFiMmJj', '2024-03-05 11:51:26'),
(20, '41517', '65e6e82fb0dcd', 'https://mercury-t2.phonepe.com/transact/pg?token=NmZhOWFkOTAyZTFhY2I1NTY3MzQyN2E0ZTI3MjM5MTEwZGRkMzk4ODA1N2NlOTUyZGQyZTI4MmUzNzIzMTVhOGY1ZTEzMWNjY2FlMTZmOjVjNjZlOGZiNTQzOGM1NzkyOTliOGYwNWEwZjc0NWNj', '2024-03-05 03:08:55'),
(21, '41517', '65e9b399c5c62', 'https://mercury-t2.phonepe.com/transact/pg?token=Zjc0MTVmOTE3MGZmMjI0YTk1NTI5YmQ1NGJjZTliZDA0MmM4YmRiYWU0MjYxY2NiMjJlNDk0MGU1YTczNjZmOTRhODcwZTY5ZDIyMWNiOjJiNjc1Y2MzZDc3MDM4OWRmNWJlMjNmZWFhNGY1OWJi', '2024-03-07 06:01:21'),
(22, '41517', '65f6d1e7a45a9', 'https://mercury-t2.phonepe.com/transact/pg?token=Yjk2ZmY2MDAyYTgxMDQ4ZTVlODZmYTg5OGJjZWNiNDNiMDc5NDQyYTJlNWFkMzBlZTMxMDBmYWQyOWI3NjI1NDE2MDgzYTBhODI2OWFmOjcyODk3MzNjYTc4ZjQ3MWUyYjdkYzliNjFkMmMyMjNh', '2024-03-17 04:50:07'),
(23, '41517', '66191dd02db2e', 'https://mercury-t2.phonepe.com/transact/pg?token=ODAxNDVjYWM5NzRmZjQyNTJiZGQyMmI0Mzk0MjZiY2E3OTE1OTA4YjdjMDIyN2EwYWFhMTk3MzJhOTIxM2JmYjQ3YTA3NzBjMjZjMTkyOmNkMGMwZWU3ODllYjdjODExZjkzNjNkZGQ3ZGJkNWQy', '2024-04-12 05:11:04'),
(24, '41517', '66279212773b8', 'https://mercury-t2.phonepe.com/transact/pg?token=Yjk4OTRmODgyZDZmOWVkMDdlZDMwMjdmM2I1Mzg0NjEwOTJhNjBmMGFjNTE5NGRhZWIxYzlmMmIzMjljZDUxNDdlYTg3NTcwOTRkY2EyOmEzYzg2NzQ1ZjY4MGRkYmQ3NDdjZTkzMzU0MGEzMzE4', '2024-04-23 04:18:50'),
(25, '41517', '662792bfacb21', 'https://mercury-t2.phonepe.com/transact/pg?token=NjI2YzJkMDAzYjU1YzhjMWIwY2M5YWNkZTA2ODUxNWQ0YjYzZTgxMjhiZjJiNGE2MmYxYjVjMTQxODBmZWYyYzA2YzBjZTBkZjU5ODRmOjY3NjNlNTU1MTUxNmQ1NjU4NDQwYTliOTljY2M2MTgz', '2024-04-23 04:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(50) NOT NULL DEFAULT '',
  `userId` int(11) NOT NULL DEFAULT 0,
  `pageId` int(11) NOT NULL DEFAULT 0,
  `activityRole` enum('viewer','editor','full') NOT NULL DEFAULT 'viewer',
  `addBy` varchar(12) NOT NULL DEFAULT '',
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `hotelId`, `userId`, `pageId`, `activityRole`, `addBy`, `addOn`) VALUES
(1, '12345', 3, 2, 'editor', 'a_1', '2024-05-09 21:19:01'),
(2, '12345', 3, 5, 'editor', 'a_1', '2024-05-09 21:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `type` enum('be','website') NOT NULL DEFAULT 'be',
  `visitor_ip` varchar(250) NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_basic`
--

CREATE TABLE `wb_basic` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `voucherIdGen` varchar(25) DEFAULT NULL,
  `qpVoucherIdGen` varchar(25) DEFAULT NULL,
  `chartBoot` varchar(250) DEFAULT NULL,
  `fb_ifrm` text DEFAULT NULL,
  `wbAna` varchar(250) DEFAULT NULL,
  `beAna` varchar(250) DEFAULT NULL,
  `fbLink` varchar(250) DEFAULT NULL,
  `inLink` varchar(250) DEFAULT NULL,
  `twLink` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wb_basic`
--

INSERT INTO `wb_basic` (`id`, `hotelId`, `voucherIdGen`, `qpVoucherIdGen`, `chartBoot`, `fb_ifrm`, `wbAna`, `beAna`, `fbLink`, `inLink`, `twLink`) VALUES
(1, '41517', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '02880', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '55051', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '4132e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'b3dfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '8e076', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'c4f5c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '67e61', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'cbe6c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '351a3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '23105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '3362e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '3e6a4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'd2690', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'b508a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '91a4d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '39c50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '3a0c5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '3b0be', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '459e6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'de51a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'c754c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '0940d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '50c29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '0452f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'e0fc3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '0784a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '013f8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'acbad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wb_blog`
--

CREATE TABLE `wb_blog` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `img` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `addBy` text NOT NULL,
  `addOn` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_blog_category`
--

CREATE TABLE `wb_blog_category` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `addBy` varchar(11) DEFAULT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_feedback`
--

CREATE TABLE `wb_feedback` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `feedbackorder` int(11) NOT NULL DEFAULT 0,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT 0,
  `img` varchar(250) NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `addBy` varchar(25) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_gallery`
--

CREATE TABLE `wb_gallery` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `text` varchar(250) DEFAULT NULL,
  `img` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `addBy` text NOT NULL,
  `add_on` datetime NOT NULL DEFAULT current_timestamp(),
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wb_gallery`
--

INSERT INTO `wb_gallery` (`id`, `hotelId`, `text`, `img`, `category`, `addBy`, `add_on`, `deleteRec`) VALUES
(5, '41517', '', '43', 14, '', '2024-04-12 10:34:54', 1),
(6, '41517', '', '46', 13, '', '2024-04-12 10:37:45', 1),
(7, '41517', '', '45', 15, '', '2024-04-12 10:38:13', 1),
(8, '41517', '', '44', 13, '', '2024-04-12 10:38:46', 1),
(9, '013f8', NULL, '132', 16, 'a_37', '2024-04-26 07:11:59', 1),
(10, '013f8', NULL, '118', 16, 'a_37', '2024-04-26 07:13:27', 1),
(11, '013f8', NULL, '119', 16, 'a_37', '2024-04-26 07:13:27', 1),
(12, '013f8', NULL, '133', 16, 'a_37', '2024-04-26 07:13:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wb_gallery_category`
--

CREATE TABLE `wb_gallery_category` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1,
  `addBy` varchar(11) DEFAULT NULL,
  `addOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wb_gallery_category`
--

INSERT INTO `wb_gallery_category` (`id`, `hotelId`, `name`, `deleteRec`, `addBy`, `addOn`) VALUES
(13, '41517', 'Rooms', 1, 'a_1', '2024-04-10 01:05:24'),
(14, '41517', 'Hall', 1, 'a_1', '2024-04-10 03:46:02'),
(15, '41517', 'Rest', 1, 'a_1', '2024-04-12 02:36:13'),
(16, '013f8', 'Room', 1, 'a_37', '2024-04-26 06:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `wb_offersection`
--

CREATE TABLE `wb_offersection` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(250) NOT NULL,
  `percentage` float NOT NULL,
  `description` text NOT NULL,
  `addBy` text NOT NULL,
  `code` varchar(250) NOT NULL,
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wb_slider`
--

CREATE TABLE `wb_slider` (
  `id` int(11) NOT NULL,
  `hotelId` varchar(11) NOT NULL,
  `sliderorder` int(11) NOT NULL DEFAULT 0,
  `img` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `subTitle` varchar(250) NOT NULL DEFAULT '',
  `button` varchar(250) NOT NULL DEFAULT '',
  `buttonLink` varchar(250) NOT NULL DEFAULT '',
  `addBy` text NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT 1,
  `deleteRec` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wb_slider`
--

INSERT INTO `wb_slider` (`id`, `hotelId`, `sliderorder`, `img`, `title`, `subTitle`, `button`, `buttonLink`, `addBy`, `status`, `deleteRec`) VALUES
(1, '41517', 4, '46', 'AIC', 'AIC24', '', '', 'a_6', 1, 1),
(2, '41517', 3, '45', 'ET GOV', 'The experience of unique holidays', '', '', 'a_6', 1, 1),
(3, '41517', 2, '44', 'ffdsd', 'ffdsd', '', '', 'a_6', 1, 1),
(4, '41517', 1, '43', 'ddcs', 'ssss', '', '', 'a_6', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activityfeed`
--
ALTER TABLE `activityfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingby`
--
ALTER TABLE `bookingby`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookingdetail`
--
ALTER TABLE `bookingdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_folio`
--
ALTER TABLE `booking_folio`
  ADD PRIMARY KEY (`folioId`);

--
-- Indexes for table `cashiering`
--
ALTER TABLE `cashiering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponcode`
--
ALTER TABLE `couponcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailcount`
--
ALTER TABLE `emailcount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facing`
--
ALTER TABLE `facing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folioparticulars`
--
ALTER TABLE `folioparticulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestamenddetail`
--
ALTER TABLE `guestamenddetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_review`
--
ALTER TABLE `guest_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotelpagelink`
--
ALTER TABLE `hotelpagelink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotelprofile`
--
ALTER TABLE `hotelprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotelservice`
--
ALTER TABLE `hotelservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotelsociallink`
--
ALTER TABLE `hotelsociallink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoteluser`
--
ALTER TABLE `hoteluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_billing`
--
ALTER TABLE `hotel_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_billing_timeline`
--
ALTER TABLE `hotel_billing_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_booking_attr`
--
ALTER TABLE `hotel_booking_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_floor_plan`
--
ALTER TABLE `hotel_floor_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_image`
--
ALTER TABLE `hotel_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_layout`
--
ALTER TABLE `hotel_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_page`
--
ALTER TABLE `hotel_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_pay_roll`
--
ALTER TABLE `hotel_pay_roll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_theme_color`
--
ALTER TABLE `hotel_theme_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `housekeeping`
--
ALTER TABLE `housekeeping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_inventory` (`room_id`);

--
-- Indexes for table `kotgstprice`
--
ALTER TABLE `kotgstprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotguestdetail`
--
ALTER TABLE `kotguestdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotorder`
--
ALTER TABLE `kotorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotorderdetail`
--
ALTER TABLE `kotorderdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotorderstatus`
--
ALTER TABLE `kotorderstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotprouct_attr`
--
ALTER TABLE `kotprouct_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotprouct_cat`
--
ALTER TABLE `kotprouct_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotprouct_hotel`
--
ALTER TABLE `kotprouct_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotprouct_sys`
--
ALTER TABLE `kotprouct_sys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kottable`
--
ALTER TABLE `kottable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_qty_unit`
--
ALTER TABLE `kot_qty_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_raw_product_list`
--
ALTER TABLE `kot_raw_product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_restaurant`
--
ALTER TABLE `kot_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_stock`
--
ALTER TABLE `kot_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_stock_category`
--
ALTER TABLE `kot_stock_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kot_stock_timeline`
--
ALTER TABLE `kot_stock_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_found`
--
ALTER TABLE `lost_found`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailinvoice`
--
ALTER TABLE `mailinvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_policy`
--
ALTER TABLE `package_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_link`
--
ALTER TABLE `payment_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_timeline`
--
ALTER TABLE `payment_timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_verify`
--
ALTER TABLE `payment_verify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propertycounlist`
--
ALTER TABLE `propertycounlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propertyinfo`
--
ALTER TABLE `propertyinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propertylocation`
--
ALTER TABLE `propertylocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propertyrateplan`
--
ALTER TABLE `propertyrateplan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `propertysetting`
--
ALTER TABLE `propertysetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_addon_charges`
--
ALTER TABLE `property_addon_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel` (`hotelid`);

--
-- Indexes for table `property_pg`
--
ALTER TABLE `property_pg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_seo`
--
ALTER TABLE `property_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_term`
--
ALTER TABLE `property_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quickpay`
--
ALTER TABLE `quickpay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomfeature`
--
ALTER TABLE `roomfeature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomnumber`
--
ALTER TABLE `roomnumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomratetype`
--
ALTER TABLE `roomratetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomstatus`
--
ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_block`
--
ALTER TABLE `room_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_img`
--
ALTER TABLE `room_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_type_list`
--
ALTER TABLE `sales_type_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sts_pay_roll`
--
ALTER TABLE `sts_pay_roll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sty_default_value`
--
ALTER TABLE `sty_default_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_activitystatus`
--
ALTER TABLE `sys_activitystatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_addon_charge`
--
ALTER TABLE `sys_addon_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_amenities`
--
ALTER TABLE `sys_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_amenities_cat`
--
ALTER TABLE `sys_amenities_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_banktypemethod`
--
ALTER TABLE `sys_banktypemethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_billing_mode`
--
ALTER TABLE `sys_billing_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_blog_cat`
--
ALTER TABLE `sys_blog_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_bookingsource`
--
ALTER TABLE `sys_bookingsource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_booking_attr`
--
ALTER TABLE `sys_booking_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_booking_type`
--
ALTER TABLE `sys_booking_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_check_in_status`
--
ALTER TABLE `sys_check_in_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_coupon_type`
--
ALTER TABLE `sys_coupon_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_currency`
--
ALTER TABLE `sys_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_feature`
--
ALTER TABLE `sys_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_floor_plan`
--
ALTER TABLE `sys_floor_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_folio_status`
--
ALTER TABLE `sys_folio_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_guestidproof`
--
ALTER TABLE `sys_guestidproof`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_guest_communication`
--
ALTER TABLE `sys_guest_communication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_kotcategory`
--
ALTER TABLE `sys_kotcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_kotservice`
--
ALTER TABLE `sys_kotservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_kot_delivery_service`
--
ALTER TABLE `sys_kot_delivery_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_kot_meal_time`
--
ALTER TABLE `sys_kot_meal_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_layout`
--
ALTER TABLE `sys_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_layout_content`
--
ALTER TABLE `sys_layout_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_mailinvoice`
--
ALTER TABLE `sys_mailinvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_payment_getway`
--
ALTER TABLE `sys_payment_getway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_pms_pages`
--
ALTER TABLE `sys_pms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_product`
--
ALTER TABLE `sys_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_rate_plan`
--
ALTER TABLE `sys_rate_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_report_list`
--
ALTER TABLE `sys_report_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_report_type`
--
ALTER TABLE `sys_report_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_reservationtype`
--
ALTER TABLE `sys_reservationtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_roomstatus`
--
ALTER TABLE `sys_roomstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_room_gst`
--
ALTER TABLE `sys_room_gst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_sociallink`
--
ALTER TABLE `sys_sociallink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_superadmin_detail`
--
ALTER TABLE `sys_superadmin_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_svg_icon`
--
ALTER TABLE `sys_svg_icon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_theme_color`
--
ALTER TABLE `sys_theme_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_userrole`
--
ALTER TABLE `sys_userrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travelagentgroup`
--
ALTER TABLE `travelagentgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_agents`
--
ALTER TABLE `travel_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url_mapping`
--
ALTER TABLE `url_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_basic`
--
ALTER TABLE `wb_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_blog`
--
ALTER TABLE `wb_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_blog_category`
--
ALTER TABLE `wb_blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_feedback`
--
ALTER TABLE `wb_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_gallery`
--
ALTER TABLE `wb_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_gallery_category`
--
ALTER TABLE `wb_gallery_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_offersection`
--
ALTER TABLE `wb_offersection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wb_slider`
--
ALTER TABLE `wb_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activityfeed`
--
ALTER TABLE `activityfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookingby`
--
ALTER TABLE `bookingby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookingdetail`
--
ALTER TABLE `bookingdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_folio`
--
ALTER TABLE `booking_folio`
  MODIFY `folioId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cashiering`
--
ALTER TABLE `cashiering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `couponcode`
--
ALTER TABLE `couponcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emailcount`
--
ALTER TABLE `emailcount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facing`
--
ALTER TABLE `facing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folioparticulars`
--
ALTER TABLE `folioparticulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guestamenddetail`
--
ALTER TABLE `guestamenddetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guest_review`
--
ALTER TABLE `guest_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotelpagelink`
--
ALTER TABLE `hotelpagelink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotelprofile`
--
ALTER TABLE `hotelprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotelservice`
--
ALTER TABLE `hotelservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotelsociallink`
--
ALTER TABLE `hotelsociallink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoteluser`
--
ALTER TABLE `hoteluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel_billing`
--
ALTER TABLE `hotel_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_billing_timeline`
--
ALTER TABLE `hotel_billing_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_booking_attr`
--
ALTER TABLE `hotel_booking_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_floor_plan`
--
ALTER TABLE `hotel_floor_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_image`
--
ALTER TABLE `hotel_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `hotel_layout`
--
ALTER TABLE `hotel_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_page`
--
ALTER TABLE `hotel_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_pay_roll`
--
ALTER TABLE `hotel_pay_roll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_theme_color`
--
ALTER TABLE `hotel_theme_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `housekeeping`
--
ALTER TABLE `housekeeping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotgstprice`
--
ALTER TABLE `kotgstprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotguestdetail`
--
ALTER TABLE `kotguestdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotorder`
--
ALTER TABLE `kotorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotorderdetail`
--
ALTER TABLE `kotorderdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotorderstatus`
--
ALTER TABLE `kotorderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotprouct_attr`
--
ALTER TABLE `kotprouct_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotprouct_cat`
--
ALTER TABLE `kotprouct_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotprouct_hotel`
--
ALTER TABLE `kotprouct_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kotprouct_sys`
--
ALTER TABLE `kotprouct_sys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kottable`
--
ALTER TABLE `kottable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_qty_unit`
--
ALTER TABLE `kot_qty_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_raw_product_list`
--
ALTER TABLE `kot_raw_product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_restaurant`
--
ALTER TABLE `kot_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_stock`
--
ALTER TABLE `kot_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_stock_category`
--
ALTER TABLE `kot_stock_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kot_stock_timeline`
--
ALTER TABLE `kot_stock_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_found`
--
ALTER TABLE `lost_found`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mailinvoice`
--
ALTER TABLE `mailinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisations`
--
ALTER TABLE `organisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_policy`
--
ALTER TABLE `package_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_link`
--
ALTER TABLE `payment_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_timeline`
--
ALTER TABLE `payment_timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_verify`
--
ALTER TABLE `payment_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propertycounlist`
--
ALTER TABLE `propertycounlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propertyinfo`
--
ALTER TABLE `propertyinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propertylocation`
--
ALTER TABLE `propertylocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `propertyrateplan`
--
ALTER TABLE `propertyrateplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propertysetting`
--
ALTER TABLE `propertysetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_addon_charges`
--
ALTER TABLE `property_addon_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_pg`
--
ALTER TABLE `property_pg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_seo`
--
ALTER TABLE `property_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_term`
--
ALTER TABLE `property_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quickpay`
--
ALTER TABLE `quickpay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roomfeature`
--
ALTER TABLE `roomfeature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roomnumber`
--
ALTER TABLE `roomnumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roomratetype`
--
ALTER TABLE `roomratetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roomstatus`
--
ALTER TABLE `roomstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_amenities`
--
ALTER TABLE `room_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_block`
--
ALTER TABLE `room_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_img`
--
ALTER TABLE `room_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_type_list`
--
ALTER TABLE `sales_type_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sts_pay_roll`
--
ALTER TABLE `sts_pay_roll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sty_default_value`
--
ALTER TABLE `sty_default_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_activitystatus`
--
ALTER TABLE `sys_activitystatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sys_addon_charge`
--
ALTER TABLE `sys_addon_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_amenities`
--
ALTER TABLE `sys_amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sys_amenities_cat`
--
ALTER TABLE `sys_amenities_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sys_banktypemethod`
--
ALTER TABLE `sys_banktypemethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sys_billing_mode`
--
ALTER TABLE `sys_billing_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_blog_cat`
--
ALTER TABLE `sys_blog_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sys_bookingsource`
--
ALTER TABLE `sys_bookingsource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys_booking_attr`
--
ALTER TABLE `sys_booking_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_booking_type`
--
ALTER TABLE `sys_booking_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_check_in_status`
--
ALTER TABLE `sys_check_in_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys_coupon_type`
--
ALTER TABLE `sys_coupon_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_currency`
--
ALTER TABLE `sys_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_feature`
--
ALTER TABLE `sys_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_floor_plan`
--
ALTER TABLE `sys_floor_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_folio_status`
--
ALTER TABLE `sys_folio_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_guestidproof`
--
ALTER TABLE `sys_guestidproof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_guest_communication`
--
ALTER TABLE `sys_guest_communication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_kotcategory`
--
ALTER TABLE `sys_kotcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_kotservice`
--
ALTER TABLE `sys_kotservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_kot_delivery_service`
--
ALTER TABLE `sys_kot_delivery_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sys_kot_meal_time`
--
ALTER TABLE `sys_kot_meal_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_layout`
--
ALTER TABLE `sys_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_layout_content`
--
ALTER TABLE `sys_layout_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_mailinvoice`
--
ALTER TABLE `sys_mailinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_payment_getway`
--
ALTER TABLE `sys_payment_getway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_pms_pages`
--
ALTER TABLE `sys_pms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sys_product`
--
ALTER TABLE `sys_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sys_rate_plan`
--
ALTER TABLE `sys_rate_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_report_list`
--
ALTER TABLE `sys_report_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sys_report_type`
--
ALTER TABLE `sys_report_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys_reservationtype`
--
ALTER TABLE `sys_reservationtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sys_roomstatus`
--
ALTER TABLE `sys_roomstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_room_gst`
--
ALTER TABLE `sys_room_gst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_sociallink`
--
ALTER TABLE `sys_sociallink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sys_superadmin_detail`
--
ALTER TABLE `sys_superadmin_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_svg_icon`
--
ALTER TABLE `sys_svg_icon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sys_theme_color`
--
ALTER TABLE `sys_theme_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sys_userrole`
--
ALTER TABLE `sys_userrole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `travelagentgroup`
--
ALTER TABLE `travelagentgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `travel_agents`
--
ALTER TABLE `travel_agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `url_mapping`
--
ALTER TABLE `url_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wb_basic`
--
ALTER TABLE `wb_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `wb_blog`
--
ALTER TABLE `wb_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wb_blog_category`
--
ALTER TABLE `wb_blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wb_feedback`
--
ALTER TABLE `wb_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wb_gallery`
--
ALTER TABLE `wb_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wb_gallery_category`
--
ALTER TABLE `wb_gallery_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wb_offersection`
--
ALTER TABLE `wb_offersection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wb_slider`
--
ALTER TABLE `wb_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
