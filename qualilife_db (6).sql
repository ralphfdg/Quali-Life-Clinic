-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 10:27 PM
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
-- Database: `qualilife_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `salt` varchar(128) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `expiration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `username`, `password`, `email_address`, `salt`, `account_type_id`, `status_id`, `date_created`, `date_updated`, `expiration_date`) VALUES
(1, 'superadmin', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'superadmin@qualilife.com', '1700000000', 1, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(2, 'admin_jane', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'jane@qualilife.com', '1700000000', 2, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(3, 'admin_john', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'john@qualilife.com', '1700000000', 2, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(4, 'dr_house', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.house@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(5, 'dr_grey', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.grey@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(6, 'dr_lim', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.lim@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(7, 'dr_addison', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.addison@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(8, 'dr_murphy', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.murphy@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(9, 'dr_shepherd', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.shepherd@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(10, 'dr_karev', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.karev@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(11, 'dr_torres', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.torres@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(12, 'dr_webber', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.webber@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(13, 'dr_yang', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.yang@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(14, 'dr_reid', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.reid@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(15, 'dr_cox', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.cox@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(16, 'dr_turk', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.turk@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(17, 'dr_elliot', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.elliot@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(18, 'dr_finch', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.finch@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(19, 'dr_becker', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.becker@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(20, 'dr_luke', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.luke@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(21, 'dr_leia', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.leia@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(22, 'dr_han', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.han@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(23, 'dr_chewie', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'dr.chewie@clinic.com', '1700000000', 3, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(24, 'pat_alice', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'alice@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(25, 'pat_bob', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'bob@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(26, 'pat_cathy', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'cathy@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(27, 'pat_david', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'david@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(28, 'pat_emily', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'emily@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(29, 'pat_frank', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'frank@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(30, 'pat_grace', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'grace@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(31, 'pat_harry', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'harry@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(32, 'pat_irene', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'irene@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(33, 'pat_jacob', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'jacob@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(34, 'pat_kelly', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'kelly@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(35, 'pat_leo', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'leo@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(36, 'pat_mia', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'mia@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(37, 'pat_nora', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'nora@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(38, 'pat_oscar', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'oscar@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(39, 'pat_penny', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'penny@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(40, 'pat_quinn', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'quinn@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(41, 'pat_ryan', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ryan@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(42, 'pat_sara', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'sara@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(43, 'pat_tom', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'tom@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(44, 'pat_uma', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'uma@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(45, 'pat_victor', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'victor@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(46, 'pat_wendy', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'wendy@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(47, 'pat_xavier', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'xavier@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(48, 'pat_yara', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'yara@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(49, 'pat_zane', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'zane@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(50, 'pat_ann', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ann@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(51, 'pat_ben', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ben@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(52, 'pat_chloe', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'chloe@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(53, 'pat_drake', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'drake@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(54, 'pat_ella', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ella@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(55, 'pat_finn', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'finn@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(56, 'pat_gigi', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'gigi@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(57, 'pat_henry', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'henry@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(58, 'pat_ivy', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ivy@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(59, 'pat_jake', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'jake@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(60, 'pat_karen', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'karen@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(61, 'pat_liam', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'liam@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(62, 'pat_maya', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'maya@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(63, 'pat_noah', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'noah@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(64, 'pat_olivia', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'olivia@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(65, 'pat_peter', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'peter@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(66, 'pat_queenie', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'queenie@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(67, 'pat_russell', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'russell@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(68, 'pat_susan', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'susan@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(69, 'pat_theo', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'theo@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(70, 'pat_ursula', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'ursula@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(71, 'pat_vince', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'vince@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(72, 'pat_will', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'will@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL),
(73, 'pat_xena', '0f7a4797b7f9dbeb342cea76ea99422d3c7b359e', 'xena@pat.com', '1700000000', 4, 1, '2025-11-25 05:00:54', '2025-11-25 05:17:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_type`
--

CREATE TABLE `tbl_account_type` (
  `id` int(11) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_account_type`
--

INSERT INTO `tbl_account_type` (`id`, `type`) VALUES
(1, 'super admin'),
(2, 'admin'),
(3, 'doctor'),
(4, 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `booked_by_account_id` int(11) DEFAULT NULL COMMENT 'Who booked it? (Patient, Admin, or Super Admin)',
  `schedule_datetime` datetime NOT NULL,
  `appointment_status_id` int(11) NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL COMMENT 'Notes from Admin/Secretary',
  `cancellation_reason` text DEFAULT NULL,
  `date_booked` datetime NOT NULL DEFAULT current_timestamp(),
  `sms_reminder_sent` tinyint(1) NOT NULL DEFAULT 0,
  `email_reminder_sent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`id`, `patient_account_id`, `doctor_account_id`, `booked_by_account_id`, `schedule_datetime`, `appointment_status_id`, `notes`, `cancellation_reason`, `date_booked`, `sms_reminder_sent`, `email_reminder_sent`) VALUES
(1, 24, 4, 24, '2025-11-20 10:00:00', 4, 'Headache follow-up.', NULL, '2025-11-18 10:00:00', 0, 0),
(2, 25, 5, 25, '2025-11-20 11:00:00', 4, 'Heart follow-up.', NULL, '2025-11-18 11:00:00', 0, 0),
(3, 26, 4, 2, '2025-11-21 09:00:00', 4, 'Routine checkup.', NULL, '2025-11-19 09:00:00', 0, 0),
(4, 27, 6, 27, '2025-11-21 10:00:00', 5, 'Patient Canceled.', NULL, '2025-11-19 10:00:00', 0, 0),
(5, 28, 4, 2, '2025-11-22 14:00:00', 4, 'Rash check.', NULL, '2025-11-20 14:00:00', 0, 0),
(6, 29, 5, 29, '2025-11-22 15:00:00', 4, 'General fatigue.', NULL, '2025-11-20 15:00:00', 0, 0),
(7, 30, 4, 30, '2025-11-25 09:00:00', 1, 'Pediatric checkup.', NULL, '2025-11-23 09:00:00', 0, 0),
(8, 31, 6, 31, '2025-11-25 10:00:00', 1, 'Orthopedic follow-up.', NULL, '2025-11-23 10:00:00', 0, 0),
(9, 32, 4, 2, '2025-11-25 11:00:00', 1, 'Prenatal checkup.', NULL, '2025-11-23 11:00:00', 0, 0),
(10, 33, 5, 33, '2025-11-26 10:00:00', 1, NULL, NULL, '2025-11-24 10:00:00', 0, 0),
(11, 34, 4, 34, '2025-11-26 11:00:00', 1, NULL, NULL, '2025-11-24 11:00:00', 0, 0),
(12, 35, 6, 2, '2025-11-27 10:00:00', 1, NULL, NULL, '2025-11-25 10:00:00', 0, 0),
(13, 36, 4, 36, '2025-11-20 12:00:00', 6, 'No-show.', NULL, '2025-11-18 12:00:00', 0, 0),
(14, 37, 5, 37, '2025-11-21 13:00:00', 4, 'Finished consultation.', NULL, '2025-11-19 13:00:00', 0, 0),
(15, 38, 4, 2, '2025-11-22 16:00:00', 4, 'General checkup.', NULL, '2025-11-20 16:00:00', 0, 0),
(16, 39, 6, 39, '2025-11-23 10:00:00', 4, 'Completed therapy session.', NULL, '2025-11-21 10:00:00', 0, 0),
(17, 40, 4, 40, '2025-11-24 10:00:00', 5, 'Patient Canceled.', NULL, '2025-11-22 10:00:00', 0, 0),
(18, 41, 5, 41, '2025-11-24 11:00:00', 4, 'Completed checkup.', NULL, '2025-11-22 11:00:00', 0, 0),
(19, 42, 4, 42, '2025-11-27 14:00:00', 1, NULL, NULL, '2025-11-25 14:00:00', 0, 0),
(20, 43, 6, 2, '2025-11-28 09:00:00', 1, NULL, NULL, '2025-11-26 09:00:00', 0, 0),
(21, 44, 4, 44, '2025-11-25 06:00:00', 4, 'Annual health screen completed.', NULL, '2025-11-25 08:30:00', 0, 0),
(22, 45, 5, 2, '2025-11-25 06:15:00', 4, 'ECG analysis completed.', NULL, '2025-11-25 08:30:00', 0, 0),
(23, 46, 6, 46, '2025-11-25 06:30:00', 4, 'Immunization completed.', NULL, '2025-11-25 08:30:00', 0, 0),
(24, 47, 7, 2, '2025-11-25 06:45:00', 4, 'Post-delivery follow-up.', NULL, '2025-11-25 08:30:00', 0, 0),
(25, 48, 8, 48, '2025-11-25 07:00:00', 4, 'Neuro exam normal, consultation finished.', NULL, '2025-11-25 08:30:00', 0, 0),
(26, 49, 9, 2, '2025-11-25 07:15:00', 3, 'Post-op checkup.', NULL, '2025-11-25 08:30:00', 0, 0),
(27, 50, 10, 50, '2025-11-25 07:30:00', 3, 'Vaccine booster administered.', NULL, '2025-11-25 08:30:00', 0, 0),
(28, 51, 11, 2, '2025-11-25 07:45:00', 3, 'Physical therapy review.', NULL, '2025-11-25 08:30:00', 0, 0),
(29, 52, 12, 52, '2025-11-25 08:00:00', 3, 'Blood work review.', NULL, '2025-11-25 08:30:00', 0, 0),
(30, 53, 13, 2, '2025-11-25 08:15:00', 3, 'New cardiology patient intake.', NULL, '2025-11-25 08:30:00', 0, 0),
(31, 54, 14, 54, '2025-11-25 08:30:00', 2, 'First time therapy session.', NULL, '2025-11-25 08:30:00', 0, 0),
(32, 55, 15, 2, '2025-11-25 08:45:00', 2, 'General checkup and flu shot.', NULL, '2025-11-25 08:30:00', 0, 0),
(33, 56, 16, 56, '2025-11-25 09:00:00', 2, 'Wrist fracture follow-up.', NULL, '2025-11-25 08:30:00', 0, 0),
(34, 57, 17, 2, '2025-11-25 09:15:00', 2, 'Psoriasis consultation.', NULL, '2025-11-25 08:30:00', 0, 0),
(35, 58, 18, 58, '2025-11-25 09:30:00', 2, 'Routine eye exam.', NULL, '2025-11-25 08:30:00', 0, 0),
(36, 59, 19, 2, '2025-11-25 09:45:00', 2, 'Chemo planning session.', NULL, '2025-11-25 08:30:00', 0, 0),
(37, 60, 20, 60, '2025-11-25 10:00:00', 1, 'General consultation.', NULL, '2025-11-25 08:30:00', 0, 0),
(38, 61, 21, 2, '2025-11-25 10:15:00', 1, 'Maternity check-in.', NULL, '2025-11-25 08:30:00', 0, 0),
(39, 62, 22, 62, '2025-11-25 10:30:00', 1, 'Eczema flare-up.', NULL, '2025-11-25 08:30:00', 0, 0),
(40, 63, 23, 2, '2025-11-25 10:45:00', 1, 'Follow-up cough.', NULL, '2025-11-25 08:30:00', 0, 0),
(41, 64, 4, 64, '2025-11-25 11:00:00', 1, 'New patient intake.', NULL, '2025-11-25 08:30:00', 0, 0),
(42, 65, 5, 2, '2025-11-25 11:15:00', 1, 'Heart stress test booking.', NULL, '2025-11-25 08:30:00', 0, 0),
(43, 66, 6, 66, '2025-11-25 11:30:00', 1, 'Infant wellness check.', NULL, '2025-11-25 08:30:00', 0, 0),
(44, 67, 7, 2, '2025-11-25 11:45:00', 1, 'Post-c-section exam.', NULL, '2025-11-25 08:30:00', 0, 0),
(45, 68, 8, 68, '2025-11-25 04:30:00', 5, NULL, 'Patient felt better in the morning.', '2025-11-25 08:30:00', 0, 0),
(46, 69, 9, 2, '2025-11-25 04:45:00', 6, 'Patient did not respond to calls.', NULL, '2025-11-25 08:30:00', 0, 0),
(47, 70, 10, 70, '2025-11-25 05:00:00', 5, NULL, 'Canceled due to scheduling conflict.', '2025-11-25 08:30:00', 0, 0),
(48, 71, 11, 2, '2025-11-25 05:15:00', 6, 'No call, no show.', NULL, '2025-11-25 08:30:00', 0, 0),
(49, 72, 12, 72, '2025-11-25 05:30:00', 5, NULL, 'Canceled by patient online.', '2025-11-25 08:30:00', 0, 0),
(50, 73, 13, 2, '2025-11-25 05:45:00', 6, 'No call, no show.', NULL, '2025-11-25 08:30:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment_status`
--

CREATE TABLE `tbl_appointment_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_appointment_status`
--

INSERT INTO `tbl_appointment_status` (`id`, `status_name`, `description`) VALUES
(1, 'Scheduled', 'Appointment has been booked.'),
(2, 'Arrived', 'Patient has checked in.'),
(3, 'In Consultation', 'Patient is currently with the doctor.'),
(4, 'Completed', 'Consultation is finished.'),
(5, 'Canceled', 'Appointment was canceled by patient or admin.'),
(6, 'No-Show', 'Patient did not arrive for their appointment.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `id` int(11) NOT NULL,
  `user_account_id` int(11) NOT NULL COMMENT 'FK to tbl_account. Who performed the action.',
  `action` varchar(255) NOT NULL COMMENT 'e.g., LOGIN, CREATE_PATIENT, VIEW_RECORD',
  `target_entity` varchar(100) DEFAULT NULL COMMENT 'e.g., tbl_patient, tbl_doctor',
  `target_id` int(11) DEFAULT NULL COMMENT 'The ID of the record that was affected',
  `details` text DEFAULT NULL COMMENT 'JSON or text blob of old/new values',
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_audit_log`
--

INSERT INTO `tbl_audit_log` (`id`, `user_account_id`, `action`, `target_entity`, `target_id`, `details`, `ip_address`, `timestamp`) VALUES
(1, 1, 'LOGIN', 'tbl_account', 1, 'User logged in successfully.', NULL, '2025-11-25 08:00:00'),
(2, 2, 'CREATE_APPOINTMENT', 'tbl_appointment', 7, 'Booked for Patient ID: 30', NULL, '2025-11-25 08:05:00'),
(3, 4, 'VIEW_PATIENT_RECORD', 'tbl_user', 24, NULL, NULL, '2025-11-25 08:10:00'),
(4, 24, 'LOGIN', 'tbl_account', 24, 'User logged in successfully.', NULL, '2025-11-25 08:15:00'),
(5, 4, 'CREATE_CONSULTATION', 'tbl_consultation_record', 10, 'SOAP Note created for walk-in', NULL, '2025-11-25 09:00:00'),
(6, 5, 'UPDATE_STATUS', 'tbl_appointment', 11, 'Changed status to: Arrived', NULL, '2025-11-25 09:15:00'),
(7, 1, 'CREATE_SPECIALIZATION', 'tbl_specialization', 11, 'Added: Podiatry', NULL, '2025-11-25 10:00:00'),
(8, 4, 'LOGOUT', 'tbl_account', 4, 'User logged out.', '::1', '2025-11-24 22:07:01'),
(9, 1, 'LOGIN', 'tbl_account', 1, 'User logged in successfully.', '::1', '2025-11-24 22:10:40'),
(10, 1, 'LOGOUT', 'tbl_account', 1, 'User logged out.', '::1', '2025-11-24 22:12:44'),
(11, 2, 'LOGIN', 'tbl_account', 2, 'User logged in successfully.', '::1', '2025-11-24 22:12:54'),
(12, 2, 'LOGOUT', 'tbl_account', 2, 'User logged out.', '::1', '2025-11-24 22:17:19'),
(13, 4, 'LOGIN', 'tbl_account', 4, 'User logged in successfully.', '::1', '2025-11-24 22:17:30'),
(14, 4, 'LOGOUT', 'tbl_account', 4, 'User logged out.', '::1', '2025-11-24 22:22:16'),
(15, 2, 'LOGIN', 'tbl_account', 2, 'User logged in successfully.', '::1', '2025-11-24 22:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_birth_history`
--

CREATE TABLE `tbl_birth_history` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `blood_type` int(2) DEFAULT NULL,
  `term` int(1) DEFAULT NULL,
  `type_of_delivery` int(1) DEFAULT NULL,
  `birth_weight` float DEFAULT NULL,
  `birth_length` float DEFAULT NULL,
  `birth_head_circumference` float DEFAULT NULL,
  `birth_chest_circumference` float DEFAULT NULL,
  `birth_abdominal_circumference` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_birth_history`
--

INSERT INTO `tbl_birth_history` (`id`, `account_id`, `blood_type`, `term`, `type_of_delivery`, `birth_weight`, `birth_length`, `birth_head_circumference`, `birth_chest_circumference`, `birth_abdominal_circumference`) VALUES
(1, 24, 1, 1, 1, 3.2, 50, NULL, NULL, NULL),
(2, 25, 2, 1, 1, 3.8, 52, NULL, NULL, NULL),
(3, 26, 7, 2, 2, 4.1, 53.5, NULL, NULL, NULL),
(4, 27, 8, 1, 1, 3, 49, NULL, NULL, NULL),
(5, 28, 5, 2, 2, 3.5, 51, NULL, NULL, NULL),
(6, 29, 6, 1, 1, 3.4, 50.5, NULL, NULL, NULL),
(7, 30, 3, 3, 2, 2.8, 45, NULL, NULL, NULL),
(8, 31, 4, 1, 1, 3.6, 51.5, NULL, NULL, NULL),
(9, 32, 1, 2, 1, 4.5, 54, NULL, NULL, NULL),
(10, 33, 7, 1, 2, 3.3, 50, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultation_record`
--

CREATE TABLE `tbl_consultation_record` (
  `id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL COMMENT 'Links SOAP notes to a specific appointment',
  `subjective` text DEFAULT NULL,
  `objective` text DEFAULT NULL,
  `assessment` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `date_of_consultation` date NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_consultation_record`
--

INSERT INTO `tbl_consultation_record` (`id`, `patient_account_id`, `doctor_account_id`, `appointment_id`, `subjective`, `objective`, `assessment`, `plan`, `notes`, `date_of_consultation`, `status_id`) VALUES
(1, 24, 4, 1, 'Reports throbbing headache, mild photophobia.', 'BP 125/80, non-focal neurological exam.', 'Tension Headache.', 'Prescribed Ibuprofen. Recommend stress reduction.', NULL, '2025-11-20', 1),
(2, 25, 5, 2, 'Reports slight shortness of breath on exertion.', 'ECG stable. Heart rate 75 bpm.', 'Stable Angina Pectoris.', 'Continue medication. Schedule stress test next month.', NULL, '2025-11-20', 1),
(3, 26, 4, 3, 'No new complaints. Routine follow-up.', 'Vitals stable. No abnormal findings.', 'Healthy checkup.', 'Return in 6 months for routine check.', NULL, '2025-11-21', 1),
(4, 28, 4, 5, 'Reports itchy rash on the arms for 1 week.', 'Maculopapular rash, localized to bilateral forearms.', 'Contact Dermatitis.', 'Prescribed topical corticosteroid. Avoid new detergents.', NULL, '2025-11-22', 1),
(5, 29, 5, 6, 'Reports constant tiredness and difficulty concentrating.', 'Blood work pending. Vitals stable.', 'Fatigue syndrome (query anemia).', 'Ordered full blood count. Follow-up after labs.', NULL, '2025-11-22', 1),
(6, 37, 5, 14, 'Check up for medication renewal.', 'Patient is compliant with treatment.', 'Generalized Anxiety Disorder, controlled.', 'Renew prescription for 3 months.', NULL, '2025-11-21', 1),
(7, 38, 4, 15, 'Routine health review.', 'All vitals within normal limits.', 'Preventative Care.', 'Recommended age-appropriate screenings.', NULL, '2025-11-22', 1),
(8, 39, 6, 16, 'Discussed recent progress in physical therapy.', 'Improved range of motion in the shoulder.', 'Post-operative recovery, satisfactory progress.', 'Continue therapy 3x/week for next month.', NULL, '2025-11-23', 1),
(9, 41, 5, 18, 'Reports difficulty sleeping.', 'Insomnia scale score moderate.', 'Primary Insomnia.', 'Recommended sleep hygiene changes. Prescribed a mild sleep aid short-term.', NULL, '2025-11-24', 1),
(10, 24, 4, NULL, 'Cough and sore throat for 2 days. (Walk-in)', 'Fever 38.5C, mild pharyngeal erythema.', 'Viral Upper Respiratory Infection.', 'Rest, hydration, and OTC symptomatic relief.', NULL, '2025-11-25', 1),
(11, 25, 5, NULL, 'Routine physical for work.', 'Normal physical exam.', 'Fit for Work.', 'Documentation provided.', NULL, '2025-11-25', 1),
(12, 26, 6, NULL, 'Injury from minor fall 1 hour ago. (Urgent care)', 'Small laceration on the knee, needs stitches.', 'Laceration, knee.', '4 stitches applied. Tetanus status reviewed.', NULL, '2025-11-25', 1),
(13, 28, 4, NULL, 'Follow-up on rash.', 'Rash significantly improved.', 'Contact Dermatitis, resolving.', 'Taper topical medication.', NULL, '2025-11-25', 1),
(14, 29, 5, NULL, 'Follow-up on labs from Consultation ID 5.', 'FBC shows mild iron-deficiency anemia.', 'Iron-Deficiency Anemia.', 'Prescribed oral iron supplements.', NULL, '2025-11-25', 1),
(15, 30, 4, 7, 'Infant with fever and irritability.', 'Tympanic temperature 39.0C. Mild ear drum redness.', 'Otitis Media (Ear Infection).', 'Prescribed Amoxicillin.', NULL, '2025-11-25', 1),
(16, 44, 4, 21, 'Routine screen, no complaints.', 'Vitals stable, BMI normal.', 'Well-woman examination.', 'Follow-up next year. Recommended dental checkup.', NULL, '2025-11-25', 1),
(17, 45, 5, 22, 'Checked for chest tightness after exercise.', 'ECG results confirm minor arrhythmia.', 'Cardiac Arrhythmia, managed.', 'Continue Beta-Blockers. Lifestyle modifications reviewed.', NULL, '2025-11-25', 1),
(18, 46, 6, 23, 'Infant for scheduled vaccine.', 'Weight 6.5 kg. No signs of fever.', 'Routine Immunization.', 'Administered Hepatitis B and BCG. Schedule next vaccine in 2 months.', NULL, '2025-11-25', 1),
(19, 47, 7, 24, '6 weeks post-delivery check.', 'Slight abdominal tenderness, no fever.', 'Postpartum check, recovering well.', 'Prescribed iron supplements. Return in 3 months.', NULL, '2025-11-25', 1),
(20, 48, 8, 25, 'Reports minor tremors in left hand.', 'Neurological exam normal. MRI scheduled next week.', 'Essential Tremor (Rule out Neuropathy).', 'Ordered an MRI scan. Prescribed low dose Propranolol.', NULL, '2025-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor_schedule`
--

CREATE TABLE `tbl_doctor_schedule` (
  `id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `day_of_week` int(1) NOT NULL COMMENT '0=Sunday, 1=Monday, 2=Tuesday, 3=Wednesday, 4=Thursday, 5=Friday, 6=Saturday',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_doctor_schedule`
--

INSERT INTO `tbl_doctor_schedule` (`id`, `doctor_account_id`, `day_of_week`, `start_time`, `end_time`, `status_id`) VALUES
(1, 4, 1, '09:00:00', '17:00:00', 1),
(2, 4, 3, '09:00:00', '17:00:00', 1),
(3, 4, 5, '09:00:00', '17:00:00', 1),
(4, 7, 1, '08:00:00', '16:00:00', 1),
(5, 7, 3, '08:00:00', '16:00:00', 1),
(6, 7, 5, '08:00:00', '16:00:00', 1),
(7, 9, 1, '13:00:00', '18:00:00', 1),
(8, 9, 2, '13:00:00', '18:00:00', 1),
(9, 9, 3, '13:00:00', '18:00:00', 1),
(10, 12, 1, '10:00:00', '15:00:00', 1),
(11, 12, 3, '10:00:00', '15:00:00', 1),
(12, 12, 5, '10:00:00', '15:00:00', 1),
(13, 14, 1, '14:00:00', '19:00:00', 1),
(14, 14, 2, '14:00:00', '19:00:00', 1),
(15, 14, 3, '14:00:00', '19:00:00', 1),
(16, 14, 4, '14:00:00', '19:00:00', 1),
(17, 16, 2, '07:00:00', '12:00:00', 1),
(18, 16, 4, '07:00:00', '12:00:00', 1),
(19, 19, 2, '08:00:00', '17:00:00', 1),
(20, 19, 3, '08:00:00', '17:00:00', 1),
(21, 19, 4, '08:00:00', '17:00:00', 1),
(22, 21, 1, '15:00:00', '20:00:00', 1),
(23, 21, 3, '15:00:00', '20:00:00', 1),
(24, 5, 2, '08:00:00', '12:00:00', 1),
(25, 5, 4, '08:00:00', '12:00:00', 1),
(26, 5, 6, '08:00:00', '12:00:00', 1),
(27, 8, 2, '10:00:00', '16:00:00', 1),
(28, 8, 4, '10:00:00', '16:00:00', 1),
(29, 8, 5, '10:00:00', '16:00:00', 1),
(30, 11, 1, '09:00:00', '14:00:00', 1),
(31, 11, 3, '09:00:00', '14:00:00', 1),
(32, 11, 6, '09:00:00', '14:00:00', 1),
(33, 13, 2, '13:00:00', '19:00:00', 1),
(34, 13, 4, '13:00:00', '19:00:00', 1),
(35, 17, 3, '10:00:00', '16:00:00', 1),
(36, 17, 5, '10:00:00', '16:00:00', 1),
(37, 17, 6, '10:00:00', '16:00:00', 1),
(38, 20, 2, '11:00:00', '17:00:00', 1),
(39, 20, 4, '11:00:00', '17:00:00', 1),
(40, 20, 6, '11:00:00', '17:00:00', 1),
(41, 22, 2, '16:00:00', '20:00:00', 1),
(42, 22, 4, '16:00:00', '20:00:00', 1),
(43, 22, 5, '16:00:00', '20:00:00', 1),
(44, 6, 1, '10:00:00', '14:00:00', 1),
(45, 6, 3, '10:00:00', '14:00:00', 1),
(46, 6, 5, '10:00:00', '14:00:00', 1),
(47, 10, 2, '14:00:00', '18:00:00', 1),
(48, 10, 4, '14:00:00', '18:00:00', 1),
(49, 15, 1, '08:00:00', '12:00:00', 1),
(50, 15, 2, '08:00:00', '12:00:00', 1),
(51, 15, 3, '08:00:00', '12:00:00', 1),
(52, 15, 4, '08:00:00', '12:00:00', 1),
(53, 18, 1, '13:00:00', '17:00:00', 1),
(54, 18, 5, '13:00:00', '17:00:00', 1),
(55, 23, 5, '12:00:00', '18:00:00', 1),
(56, 23, 6, '12:00:00', '18:00:00', 1),
(57, 23, 0, '12:00:00', '18:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_immunization`
--

CREATE TABLE `tbl_immunization` (
  `id` int(11) NOT NULL,
  `immunization` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_immunization`
--

INSERT INTO `tbl_immunization` (`id`, `immunization`, `description`, `status_id`) VALUES
(1, 'BCG (Tuberculosis)', 'Vaccine for Tuberculosis', 1),
(2, 'Hepatitis B', 'Vaccine for Hepatitis B', 1),
(3, 'Pentavalent 1', 'First dose for Diptheria, Tetanus, Pertusis, Hib, and Hepatitis B', 1),
(4, 'Pentavalent 2', 'Second dose for DPT-HepB-HiB', 1),
(5, 'Pentavalent 3', 'Third dose for DPT-HepB-HiB', 1),
(6, 'OPV (Polio)', 'Oral Polio Vaccine', 1),
(7, 'IPV (Polio)', 'Inactivated Polio Vaccine', 1),
(8, 'MMR', 'Vaccine for measles, mumps, rubella', 1),
(9, 'Flu Vaccine', 'Seasonal Influenza Vaccine', 1),
(10, 'COVID-19 Booster', 'Booster shot for COVID-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_immunization_record`
--

CREATE TABLE `tbl_immunization_record` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `immunization_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_immunization_record`
--

INSERT INTO `tbl_immunization_record` (`id`, `account_id`, `immunization_id`, `date`, `remarks`, `status_id`) VALUES
(1, 24, 1, '1995-04-11', 'Given at birth', 1),
(2, 25, 2, '1965-02-07', 'Given at birth', 1),
(3, 26, 3, '2000-03-01', 'First dose', 1),
(4, 27, 4, '1947-03-08', 'Second dose', 1),
(5, 28, 8, '1985-05-15', 'MMR shot', 1),
(6, 29, 9, '2024-01-01', 'Annual Flu Shot', 1),
(7, 30, 10, '2024-05-01', 'COVID Booster', 1),
(8, 31, 1, '1980-08-01', 'Given at birth', 1),
(9, 32, 2, '1985-05-02', 'Given at birth', 1),
(10, 33, 3, '1990-08-19', 'First dose', 1),
(11, 34, 4, '1989-04-05', 'Second dose', 1),
(12, 35, 8, '1995-03-01', 'MMR shot', 1),
(13, 36, 9, '2024-01-15', 'Annual Flu Shot', 1),
(14, 37, 10, '2024-05-15', 'COVID Booster', 1),
(15, 38, 1, '1854-10-17', 'Given at birth', 1),
(16, 39, 2, '1985-12-03', 'Given at birth', 1),
(17, 40, 3, '1993-03-01', 'First dose', 1),
(18, 41, 4, '1979-07-10', 'Second dose', 1),
(19, 42, 8, '1987-12-26', 'MMR shot', 1),
(20, 43, 9, '2024-02-01', 'Annual Flu Shot', 1),
(21, 44, 10, '2024-06-01', 'COVID Booster', 1),
(22, 45, 1, '1978-01-02', 'Given at birth', 1),
(23, 46, 2, '1900-01-02', 'Given at birth', 1),
(24, 47, 3, '1980-03-01', 'First dose', 1),
(25, 48, 4, '1988-03-01', 'Second dose', 1),
(26, 49, 8, '1999-03-01', 'MMR shot', 1),
(27, 50, 9, '2024-02-15', 'Annual Flu Shot', 1),
(28, 51, 10, '2024-06-15', 'COVID Booster', 1),
(29, 52, 1, '1988-01-02', 'Given at birth', 1),
(30, 53, 2, '1968-01-09', 'Given at birth', 1),
(31, 54, 3, '1990-03-01', 'First dose', 1),
(32, 55, 4, '1993-03-01', 'Second dose', 1),
(33, 56, 8, '1995-06-23', 'MMR shot', 1),
(34, 57, 9, '2024-03-01', 'Annual Flu Shot', 1),
(35, 58, 10, '2024-07-01', 'COVID Booster', 1),
(36, 59, 1, '1980-01-02', 'Given at birth', 1),
(37, 60, 2, '1981-01-02', 'Given at birth', 1),
(38, 61, 3, '1990-03-13', 'First dose', 1),
(39, 62, 4, '1985-03-01', 'Second dose', 1),
(40, 63, 8, '1996-07-09', 'MMR shot', 1),
(41, 64, 9, '2024-03-15', 'Annual Flu Shot', 1),
(42, 65, 10, '2024-07-15', 'COVID Booster', 1),
(43, 66, 1, '1902-01-02', 'Given at birth', 1),
(44, 67, 2, '1975-06-05', 'Given at birth', 1),
(45, 68, 3, '1964-03-01', 'First dose', 1),
(46, 69, 4, '1998-03-01', 'Second dose', 1),
(47, 70, 8, '1964-03-01', 'MMR shot', 1),
(48, 71, 9, '2024-04-01', 'Annual Flu Shot', 1),
(49, 72, 10, '2024-08-01', 'COVID Booster', 1),
(50, 73, 1, '1970-01-02', 'Given at birth', 1),
(51, 24, 8, '2000-01-01', 'MMR Booster', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `doctor_account_id` int(11) NOT NULL,
  `consultation_id` int(11) NOT NULL,
  `prescription` text NOT NULL,
  `date_of_prescription` date NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_prescription`
--

INSERT INTO `tbl_prescription` (`id`, `patient_account_id`, `doctor_account_id`, `consultation_id`, `prescription`, `date_of_prescription`, `status_id`) VALUES
(1, 24, 4, 1, 'Ibuprofen 400mg PRN for pain.', '2025-11-20', 1),
(2, 28, 4, 4, 'Hydrocortisone Cream 1% BID.', '2025-11-22', 1),
(3, 37, 5, 6, 'Sertraline 50mg daily. QTY: 90.', '2025-11-21', 1),
(4, 39, 6, 8, 'No medication prescribed, only physical therapy.', '2025-11-23', 1),
(5, 41, 5, 9, 'Zolpidem 5mg PRN for sleep (max 7 days).', '2025-11-24', 1),
(6, 24, 4, 10, 'Paracetamol 500mg PRN for fever.', '2025-11-25', 1),
(7, 29, 5, 14, 'Ferrous Sulfate 325mg daily. QTY: 60.', '2025-11-25', 1),
(8, 30, 4, 15, 'Amoxicillin 250mg/5mL, 5mL BID for 10 days.', '2025-11-25', 1),
(9, 25, 5, 2, 'Aspirin 81mg daily, Plavix 75mg daily.', '2025-11-20', 1),
(10, 28, 4, 13, 'Taper off Hydrocortisone Cream 1%.', '2025-11-25', 1),
(11, 44, 4, 16, 'No medication prescribed, advised vitamins.', '2025-11-25', 1),
(12, 45, 5, 17, 'Metoprolol 25mg daily. QTY: 30.', '2025-11-25', 1),
(13, 47, 7, 19, 'Ferrous Fumarate 325mg daily. QTY: 60.', '2025-11-25', 1),
(14, 48, 8, 20, 'Propranolol 10mg PRN for tremor.', '2025-11-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_specialization`
--

CREATE TABLE `tbl_specialization` (
  `id` int(11) NOT NULL,
  `specialization_name` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_specialization`
--

INSERT INTO `tbl_specialization` (`id`, `specialization_name`, `status_id`) VALUES
(1, 'General Medicine', 1),
(2, 'Pediatrics', 1),
(3, 'Obstetrics and Gynecology', 1),
(4, 'Cardiology', 1),
(5, 'Neurology', 1),
(6, 'Dermatology', 1),
(7, 'Orthopedics', 1),
(8, 'Ophthalmology', 1),
(9, 'Oncology', 1),
(10, 'Psychiatry', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `middlename` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) NOT NULL,
  `qualifier` varchar(128) DEFAULT NULL,
  `dob` date NOT NULL,
  `specialization` varchar(255) DEFAULT NULL COMMENT 'Legacy free-text field',
  `specialization_id` int(11) DEFAULT NULL COMMENT 'FK to tbl_specialization for booking wizard',
  `ptr_number` varchar(128) DEFAULT NULL,
  `license_number` varchar(128) DEFAULT NULL,
  `license_expiration` date DEFAULT NULL,
  `s2_number` varchar(128) DEFAULT NULL,
  `s2_expiration` date DEFAULT NULL,
  `maxicare_number` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `name_of_father` varchar(128) DEFAULT NULL,
  `father_dob` date DEFAULT NULL,
  `name_of_mother` varchar(128) DEFAULT NULL,
  `mother_dob` date DEFAULT NULL,
  `school` varchar(128) DEFAULT NULL,
  `gender` int(1) NOT NULL,
  `mother_contact_number` varchar(11) DEFAULT NULL,
  `father_contact_number` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `account_id`, `firstname`, `middlename`, `lastname`, `qualifier`, `dob`, `specialization`, `specialization_id`, `ptr_number`, `license_number`, `license_expiration`, `s2_number`, `s2_expiration`, `maxicare_number`, `address`, `mobile_number`, `name_of_father`, `father_dob`, `name_of_mother`, `mother_dob`, `school`, `gender`, `mother_contact_number`, `father_contact_number`) VALUES
(1, 1, 'Max', NULL, 'Sterling', NULL, '1980-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Head Office', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 2, 'Jane', NULL, 'Foster', NULL, '1990-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Admin Desk', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(3, 3, 'John', NULL, 'Connor', NULL, '1988-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Admin Desk', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, 4, 'Gregory', NULL, 'House', NULL, '1975-06-11', NULL, 1, NULL, 'L10004', NULL, NULL, NULL, NULL, 'Consultation Room 1', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 5, 'Meredith', NULL, 'Grey', NULL, '1982-03-01', NULL, 4, NULL, 'L10005', NULL, NULL, NULL, NULL, 'Consultation Room 2', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(6, 6, 'Audrey', NULL, 'Lim', NULL, '1980-11-10', NULL, 2, NULL, 'L10006', NULL, NULL, NULL, NULL, 'Pediatric Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(7, 7, 'Addison', NULL, 'Montgomery', NULL, '1978-07-22', NULL, 3, NULL, 'L10007', NULL, NULL, NULL, NULL, 'OB/GYN Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(8, 8, 'Shaun', NULL, 'Murphy', NULL, '1990-09-18', NULL, 5, NULL, 'L10008', NULL, NULL, NULL, NULL, 'Neurology Ward', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(9, 9, 'Derek', NULL, 'Shepherd', NULL, '1966-10-04', NULL, 5, NULL, 'L10009', NULL, NULL, NULL, NULL, 'Neurology Ward', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(10, 10, 'Alex', NULL, 'Karev', NULL, '1975-09-24', NULL, 2, NULL, 'L10010', NULL, NULL, NULL, NULL, 'Pediatric Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 11, 'Callie', NULL, 'Torres', NULL, '1975-06-20', NULL, 7, NULL, 'L10011', NULL, NULL, NULL, NULL, 'Orthopedics Center', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(12, 12, 'Richard', NULL, 'Webber', NULL, '1955-08-01', NULL, 1, NULL, 'L10012', NULL, NULL, NULL, NULL, 'Consultation Room 3', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(13, 13, 'Cristina', NULL, 'Yang', NULL, '1970-11-01', NULL, 4, NULL, 'L10013', NULL, NULL, NULL, NULL, 'Cardiology Center', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(14, 14, 'Spencer', NULL, 'Reid', NULL, '1981-10-12', NULL, 10, NULL, 'L10014', NULL, NULL, NULL, NULL, 'Psychiatry Unit', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 15, 'Perry', NULL, 'Cox', NULL, '1959-10-22', NULL, 1, NULL, 'L10015', NULL, NULL, NULL, NULL, 'Consultation Room 4', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(16, 16, 'Chris', NULL, 'Turk', NULL, '1971-08-16', NULL, 7, NULL, 'L10016', NULL, NULL, NULL, NULL, 'Orthopedics Center', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(17, 17, 'Elliot', NULL, 'Reid', NULL, '1973-10-09', NULL, 6, NULL, 'L10017', NULL, NULL, NULL, NULL, 'Dermatology Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(18, 18, 'Lionel', NULL, 'Finch', NULL, '1970-02-17', NULL, 8, NULL, 'L10018', NULL, NULL, NULL, NULL, 'Eye Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(19, 19, 'John', NULL, 'Becker', NULL, '1955-06-19', NULL, 9, NULL, 'L10019', NULL, NULL, NULL, NULL, 'Oncology Department', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(20, 20, 'Luke', NULL, 'Skywalker', NULL, '1977-05-25', NULL, 1, NULL, 'L10020', NULL, NULL, NULL, NULL, 'Consultation Room 5', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(21, 21, 'Leia', NULL, 'Organa', NULL, '1977-05-25', NULL, 3, NULL, 'L10021', NULL, NULL, NULL, NULL, 'OB/GYN Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(22, 22, 'Han', NULL, 'Solo', NULL, '1980-05-21', NULL, 6, NULL, 'L10022', NULL, NULL, NULL, NULL, 'Dermatology Clinic', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(23, 23, 'Chewbacca', NULL, 'Wookiee', NULL, '1977-05-25', NULL, 1, NULL, 'L10023', NULL, NULL, NULL, NULL, 'Consultation Room 6', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(24, 24, 'Alice', NULL, 'Johnson', NULL, '1995-04-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123 Wonderland Ave', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(25, 25, 'Bob', NULL, 'Marley', NULL, '1965-02-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '456 Reggae Rd', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(26, 26, 'Cathy', NULL, 'Smith', NULL, '2000-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '789 Suburbia St', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(27, 27, 'David', NULL, 'Bowie', NULL, '1947-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111 Stardust Ln', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(28, 28, 'Emily', NULL, 'Blunt', NULL, '1983-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '222 Quiet Pl', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(29, 29, 'Frank', NULL, 'Sinatra', NULL, '1915-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '333 My Way', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(30, 30, 'Grace', NULL, 'Kelly', NULL, '1929-11-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444 Monaco Ct', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(31, 31, 'Harry', NULL, 'Potter', NULL, '1980-07-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4 Privet Drive', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(32, 32, 'Irene', NULL, 'Adler', NULL, '1985-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '221B Baker St', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(33, 33, 'Jacob', NULL, 'Black', NULL, '1990-06-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Forks WA', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(34, 34, 'Kelly', NULL, 'Kapoor', NULL, '1989-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Scranton PA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(35, 35, 'Leo', NULL, 'DiCaprio', NULL, '1974-11-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hollywood CA', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(36, 36, 'Mia', NULL, 'Wallace', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LA CA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(37, 37, 'Nora', NULL, 'Jones', NULL, '1979-03-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New York NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(38, 38, 'Oscar', NULL, 'Wilde', NULL, '1854-10-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dublin Ireland', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(39, 39, 'Penny', NULL, 'Hofstadter', NULL, '1985-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pasadena CA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(40, 40, 'Quinn', NULL, 'Fabray', NULL, '1993-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lima OH', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(41, 41, 'Ryan', NULL, 'Howard', NULL, '1979-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Scranton PA', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(42, 42, 'Sara', NULL, 'Lance', NULL, '1987-12-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Starling City', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(43, 43, 'Tom', NULL, 'Hanks', NULL, '1956-07-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Anywhere USA', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(44, 44, 'Uma', NULL, 'Thurman', NULL, '1970-04-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boston MA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(45, 45, 'Victor', NULL, 'Krum', NULL, '1978-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Europe', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(46, 46, 'Wendy', NULL, 'Darling', NULL, '1900-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'London UK', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(47, 47, 'Xavier', NULL, 'Mendes', NULL, '1980-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Portugal', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(48, 48, 'Yara', NULL, 'Greyjoy', NULL, '1988-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Iron Islands', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(49, 49, 'Zane', NULL, 'Smith', NULL, '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'California', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(50, 50, 'Ann', NULL, 'Perkins', NULL, '1985-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pawnee IN', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(51, 51, 'Ben', NULL, 'Wyatt', NULL, '1970-07-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pawnee IN', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(52, 52, 'Chloe', NULL, 'Sullivan', NULL, '1988-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Smallville KS', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(53, 53, 'Drake', NULL, 'Ramoray', NULL, '1968-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NYC NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(54, 54, 'Ella', NULL, 'Lopez', NULL, '1990-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Los Angeles CA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(55, 55, 'Finn', NULL, 'Hudson', NULL, '1993-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lima OH', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(56, 56, 'Gigi', NULL, 'Hadid', NULL, '1995-04-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LA CA', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(57, 57, 'Henry', NULL, 'Jones', NULL, '1901-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Princeton NJ', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(58, 58, 'Ivy', NULL, 'Pepper', NULL, '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gotham City', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(59, 59, 'Jake', NULL, 'Peralta', NULL, '1980-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Brooklyn NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(60, 60, 'Karen', NULL, 'Fillipelli', NULL, '1981-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Stamford CT', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(61, 61, 'Liam', NULL, 'Hemsworth', NULL, '1990-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Australia', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(62, 62, 'Maya', NULL, 'Hansen', NULL, '1985-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tennessee', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(63, 63, 'Noah', NULL, 'Centineo', NULL, '1996-05-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Florida', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(64, 64, 'Olivia', NULL, 'Benson', NULL, '1969-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NYC NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(65, 65, 'Peter', NULL, 'Quill', NULL, '1980-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Missouri', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(66, 66, 'Queenie', NULL, 'Goldstein', NULL, '1902-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New York City', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(67, 67, 'Russell', NULL, 'Brand', NULL, '1975-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UK', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(68, 68, 'Susan', NULL, 'Mayer', NULL, '1964-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fairview', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(69, 69, 'Theo', NULL, 'Raeken', NULL, '1998-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Beacon Hills', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(70, 70, 'Ursula', NULL, 'Buffay', NULL, '1964-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NYC NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(71, 71, 'Vince', NULL, 'Chase', NULL, '1975-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Queens NY', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(72, 72, 'Will', NULL, 'Schuester', NULL, '1977-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lima OH', '09288736929', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(73, 73, 'Xena', NULL, 'Warrior', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ancient Greece', '09288736929', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_type_to_account_account_type_id_idx` (`account_type_id`),
  ADD KEY `FK_status_to_account_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_appointment_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_appointment_doctor_id_idx` (`doctor_account_id`),
  ADD KEY `FK_account_to_appointment_booked_by_id_idx` (`booked_by_account_id`),
  ADD KEY `FK_status_to_appointment_status_id_idx` (`appointment_status_id`);

--
-- Indexes for table `tbl_appointment_status`
--
ALTER TABLE `tbl_appointment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_audit_log_user_id_idx` (`user_account_id`);

--
-- Indexes for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_birth_history_account_id_idx` (`account_id`);

--
-- Indexes for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_consultation_record_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_consultation_record_doctor_account_id_idx` (`doctor_account_id`),
  ADD KEY `FK_status_to_consultation_record_status_id_idx` (`status_id`),
  ADD KEY `FK_appointment_to_consultation_appointment_id_idx` (`appointment_id`);

--
-- Indexes for table `tbl_doctor_schedule`
--
ALTER TABLE `tbl_doctor_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_schedule_doctor_id_idx` (`doctor_account_id`),
  ADD KEY `FK_status_to_schedule_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_to_immunization_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_immunization_record_account_id_idx` (`account_id`),
  ADD KEY `FK_immunization_to_immunization_record_immunization_id_idx` (`immunization_id`),
  ADD KEY `FK_status_to_immunization_record_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_prescription_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_prescription_doctor_account_id_idx` (`doctor_account_id`),
  ADD KEY `FK_status_to_prescription_status_id_idx` (`status_id`),
  ADD KEY `FK_consultation_to_prescription_consultation_id_idx` (`consultation_id`);

--
-- Indexes for table `tbl_specialization`
--
ALTER TABLE `tbl_specialization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_status_to_specialization_status_id_idx` (`status_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_to_user_account_id_idx` (`account_id`),
  ADD KEY `FK_specialization_to_user_specialization_id_idx` (`specialization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_appointment_status`
--
ALTER TABLE `tbl_appointment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_doctor_schedule`
--
ALTER TABLE `tbl_doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_specialization`
--
ALTER TABLE `tbl_specialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `FK_account_type_to_account_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `tbl_account_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_account_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD CONSTRAINT `FK_account_to_appointment_booked_by_id` FOREIGN KEY (`booked_by_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_appointment_doctor_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_appointment_patient_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_appointment_status_id` FOREIGN KEY (`appointment_status_id`) REFERENCES `tbl_appointment_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  ADD CONSTRAINT `FK_account_to_audit_log_user_id` FOREIGN KEY (`user_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  ADD CONSTRAINT `FK_account_to_birth_history_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  ADD CONSTRAINT `FK_account_to_consultation_record_doctor_account_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_consultation_record_patient_account_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_appointment_to_consultation_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_consultation_record_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_doctor_schedule`
--
ALTER TABLE `tbl_doctor_schedule`
  ADD CONSTRAINT `FK_account_to_schedule_doctor_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_schedule_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  ADD CONSTRAINT `FK_status_to_immunZzation_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  ADD CONSTRAINT `FK_account_to_immunization_record_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_immunization_to_immunization_record_immunization_id` FOREIGN KEY (`immunization_id`) REFERENCES `tbl_immunization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_immunization_record_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD CONSTRAINT `FK_account_to_prescription_doctor_account_id` FOREIGN KEY (`doctor_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_prescription_patient_account_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_consultation_to_prescription_consultation_id` FOREIGN KEY (`consultation_id`) REFERENCES `tbl_consultation_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_status_to_prescription_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_specialization`
--
ALTER TABLE `tbl_specialization`
  ADD CONSTRAINT `FK_status_to_specialization_status_id` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `FK_account_to_user_account_id` FOREIGN KEY (`account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_specialization_to_user_specialization_id` FOREIGN KEY (`specialization_id`) REFERENCES `tbl_specialization` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
