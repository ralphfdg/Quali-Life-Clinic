-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 06:13 AM
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
(1, 'sadmin', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'superadmin@qualilife.com', '1700000000', 1, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(2, 'admin_jane', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'jane@qualilife.com', '1700000000', 2, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(3, 'admin_john', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'john@qualilife.com', '1700000000', 2, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(4, 'dr_house', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'house@qualilife.com', '1700000000', 3, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(5, 'dr_grey', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'grey@qualilife.com', '1700000000', 3, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(6, 'dr_lim', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'lim@qualilife.com', '1700000000', 3, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(7, 'dr_addison', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'addison@qualilife.com', '1700000000', 3, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(8, 'dr_murphy', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'murphy@qualilife.com', '1700000000', 3, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(9, 'pat_alice', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'alice@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(10, 'pat_bob', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'bob@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(11, 'pat_cathy', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'cathy@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(12, 'pat_david', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'david@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(13, 'pat_emily', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'emily@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(14, 'pat_frank', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'frank@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL),
(15, 'pat_grace', '9b6616d5554e103f16d061b1e754b3524b892b0c', 'grace@gmail.com', '1700000000', 4, 1, '2025-11-09 19:23:24', '2025-11-09 19:23:24', NULL);

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
(1, 9, 4, 2, '2025-11-01 10:00:00', 4, 'Patient felt dizzy.', NULL, '2025-10-30 09:00:00', 0, 0),
(2, 10, 5, 10, '2025-11-09 11:00:00', 2, 'Regular checkup.', NULL, '2025-11-05 14:00:00', 0, 0),
(3, 11, 4, 3, '2025-11-12 14:00:00', 1, '', NULL, '2025-11-07 16:00:00', 0, 0),
(4, 9, 4, 9, '2025-11-17 10:00:00', 1, 'Follow-up check.', NULL, '2025-11-02 09:00:00', 0, 0);

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
(1, 1, 'LOGIN', 'tbl_account', 1, '{\"ip\":\"127.0.0.1\"}', '127.0.0.1', '2025-11-09 10:00:00'),
(2, 2, 'CREATE_APPOINTMENT', 'tbl_appointment', 1, '{\"patient_id\":9, \"doctor_id\":4}', '127.0.0.1', '2025-11-09 10:05:00'),
(3, 4, 'VIEW_PATIENT_RECORD', 'tbl_user', 9, NULL, '127.0.0.1', '2025-11-09 10:10:00'),
(4, 9, 'LOGIN', 'tbl_account', 9, '{\"ip\":\"192.168.1.10\"}', '192.168.1.10', '2025-11-09 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE `tbl_billing` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `patient_account_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('Pending','Paid','Waived') NOT NULL DEFAULT 'Pending',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_paid` datetime DEFAULT NULL,
  `created_by_account_id` int(11) NOT NULL COMMENT 'FK to tbl_account (Admin/SuperAdmin)',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_billing`
--

INSERT INTO `tbl_billing` (`id`, `appointment_id`, `patient_account_id`, `amount`, `payment_status`, `date_created`, `date_paid`, `created_by_account_id`, `notes`) VALUES
(1, 1, 9, 150.00, 'Paid', '2025-11-01 10:30:00', '2025-11-01 10:31:00', 2, 'Consultation Fee');

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
(1, 11, 1, 1, 1, 3.5, 50, NULL, NULL, NULL);

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
(1, 9, 4, 1, 'Patient reports dizziness and nausea.', 'BP 120/80, Pulse 72. No nystagmus.', 'Benign Positional Vertigo.', 'Prescribed Meclizine. Recommended Epley maneuver.', NULL, '2025-11-01', 1);

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
(4, 5, 2, '08:00:00', '12:00:00', 1),
(5, 5, 4, '08:00:00', '12:00:00', 1);

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
(1, 'Bacille Calmette-Guérin (BCG)', 'Vaccine for Tuberculosis', 1),
(2, 'Hepatitis B', 'Vaccine for Hepatitis B', 1),
(3, 'Pentavalent Vaccine (DPT-HepB-HiB)', 'Vaccine for Diptheria, Tetanus, Pertusis, Hib, and Hepatitis B', 1),
(4, 'Measles Mumps Rubella (MMR)', 'Vaccine for measles, mumps, rubella', 1);

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
(1, 9, 4, '1996-06-15', 'Booster shot', 1);

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
(1, 9, 4, 1, 'Meclizine 25mg. Take 1 tablet every 8 hours as needed for dizziness.', '2025-11-01', 1);

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
(5, 'Neurology', 1);

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

INSERT INTO `tbl_user` (`id`, `account_id`, `firstname`, `middlename`, `lastname`, `qualifier`, `dob`, `specialization`, `specialization_id`, `ptr_number`, `license_number`, `license_expiration`, `s2_number`, `s2_expiration`, `maxicare_number`, `address`, `name_of_father`, `father_dob`, `name_of_mother`, `mother_dob`, `school`, `gender`, `mother_contact_number`, `father_contact_number`) VALUES
(1, 1, 'Sam', 'A.', 'Superadmin', NULL, '1980-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(2, 2, 'Jane', 'M.', 'Doe', NULL, '1990-05-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(3, 3, 'John', 'R.', 'Smith', NULL, '1988-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(4, 4, 'Gregory', '', 'House', NULL, '1975-06-11', NULL, 1, NULL, 'L10001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(5, 5, 'Meredith', '', 'Grey', NULL, '1982-03-01', NULL, 4, NULL, 'L10002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(6, 6, 'Audrey', '', 'Lim', NULL, '1980-11-10', NULL, 2, NULL, 'L10003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(7, 7, 'Addison', '', 'Montgomery', NULL, '1978-07-22', NULL, 3, NULL, 'L10004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(8, 8, 'Shaun', '', 'Murphy', NULL, '1990-09-18', NULL, 5, NULL, 'L10005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(9, 9, 'Alice', 'W.', 'Johnson', NULL, '1995-04-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123 Wonderland Ave', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(10, 10, 'Bob', 'L.', 'Marley', NULL, '1965-02-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '456 Reggae Rd', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(11, 11, 'Phoenix', 'T.', 'Smith', '', '2000-01-01', '', NULL, '', '', '0000-00-00', '', '0000-00-00', '', '789 Suburbia St', '', '0000-00-00', '', '0000-00-00', '', 2, '', ''),
(12, 12, 'David', 'R.', 'Bowie', NULL, '1947-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '111 Stardust Ln', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(13, 13, 'Emily', 'K.', 'Blunt', NULL, '1983-02-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '222 Quiet Pl', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL),
(14, 14, 'Frank', 'F.', 'Sinatra', NULL, '1915-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '333 My Way', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL),
(15, 15, 'Grace', 'P.', 'Kelly', NULL, '1929-11-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '444 Monaco Ct', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL);

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
-- Indexes for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_appointment_to_billing_appointment_id_idx` (`appointment_id`),
  ADD KEY `FK_account_to_billing_patient_id_idx` (`patient_account_id`),
  ADD KEY `FK_account_to_billing_created_by_id_idx` (`created_by_account_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_account_type`
--
ALTER TABLE `tbl_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_appointment_status`
--
ALTER TABLE `tbl_appointment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_birth_history`
--
ALTER TABLE `tbl_birth_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_consultation_record`
--
ALTER TABLE `tbl_consultation_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_doctor_schedule`
--
ALTER TABLE `tbl_doctor_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_immunization`
--
ALTER TABLE `tbl_immunization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_immunization_record`
--
ALTER TABLE `tbl_immunization_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_specialization`
--
ALTER TABLE `tbl_specialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- Constraints for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD CONSTRAINT `FK_account_to_billing_created_by_id` FOREIGN KEY (`created_by_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_account_to_billing_patient_id` FOREIGN KEY (`patient_account_id`) REFERENCES `tbl_account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_appointment_to_billing_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
