-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 01:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meteor_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` varchar(12) NOT NULL COMMENT 'Admin login username',
  `adminName` varchar(60) NOT NULL COMMENT 'Admin name',
  `password` varchar(30) NOT NULL COMMENT 'Admin password',
  `role` varchar(5) NOT NULL DEFAULT 'ADMIN' COMMENT 'To differentiate from patients'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `adminName`, `password`, `role`) VALUES
('A01', 'Vinci', '12345678', 'ADMIN'),
('A02', 'Victoria', '$2y$10$G4P3YF7JSC2eBG0S3u4AYOB', 'ADMIN'),
('A03', 'Rayhan', '$2y$10$AU/X.wIhqMp2t3hK/Xo5z..', 'ADMIN'),
('A04', 'Jocelyn', '$2y$10$RM3M2816go8xU7PQnR5YuOS', 'ADMIN'),
('A067', 'Testin', '$2y$10$XnazkloVZy8s.MH8WncbDuY', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointmentID` int(11) NOT NULL,
  `patientIC` varchar(12) NOT NULL COMMENT 'Reference to patients table',
  `doctorID` int(11) NOT NULL COMMENT 'Reference to doctors table',
  `appointmentType` varchar(20) NOT NULL DEFAULT 'CONSULTATION' COMMENT 'Type of appointments',
  `appointmentDate` date NOT NULL,
  `appointmentTime` time NOT NULL,
  `issue` varchar(500) DEFAULT NULL COMMENT 'Description of symptoms',
  `preferredPaymentType` varchar(30) DEFAULT 'CASH' COMMENT 'Preferred payment type for appointment',
  `screeningType` varchar(60) DEFAULT NULL COMMENT 'Mandatory column for health-screening appointment',
  `preferredPlatform` varchar(100) DEFAULT NULL COMMENT 'Mandatory column for telemedicine appointment',
  `appointmentStatus` varchar(30) DEFAULT 'PENDING' COMMENT 'Admin edit after review'
) ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointmentID`, `patientIC`, `doctorID`, `appointmentType`, `appointmentDate`, `appointmentTime`, `issue`, `preferredPaymentType`, `screeningType`, `preferredPlatform`, `appointmentStatus`) VALUES
(1, '990101145678', 2, 'CONSULTATION', '2023-11-15', '10:00:00', 'General Checkup', 'credit card', NULL, NULL, 'PENDING'),
(2, '980430145679', 3, 'HEALTH-SCREENING', '2023-11-16', '02:30:00', 'Annual Health Checkup', 'debit card', 'Full Body Checkup', NULL, 'PENDING'),
(3, '921225128765', 4, 'TELEMEDICINE', '2023-11-17', '11:45:00', 'Medication Follow-up', 'online transfer', NULL, 'Zoom', 'PENDING'),
(5, '950320147891', 6, 'HEALTH-SCREENING', '2023-11-19', '09:30:00', 'Blood Pressure Check', 'cash', 'Basic Health Checkup', NULL, 'PENDING'),
(6, '941005054320', 7, 'TELEMEDICINE', '2023-11-20', '01:45:00', 'Follow-up Consultation', 'online transfer', NULL, 'Skype', 'PENDING'),
(7, '931113056788', 8, 'CONSULTATION', '2023-11-21', '10:30:00', 'Chronic Pain', 'insurance', NULL, NULL, 'PENDING'),
(10, '060925567890', 11, 'CONSULTATION', '2023-11-24', '04:30:00', 'Allergies', 'Credit Card', NULL, NULL, 'REJECT'),
(11, '900815123456', 12, 'TELEMEDICINE', '2023-12-05', '01:00:00', 'Follow-up Consultation', 'credit card', NULL, 'Zoom', 'PENDING'),
(12, '980430145679', 13, 'TELEMEDICINE', '2023-12-08', '03:45:00', 'Medication Review', 'debit card', NULL, 'Skype', 'PENDING'),
(14, '990101145678', 2, 'CONSULTATION', '2023-11-15', '10:00:00', 'General Checkup', 'credit card', NULL, NULL, 'PENDING'),
(15, '980430145679', 3, 'HEALTH-SCREENING', '2023-11-16', '02:30:00', 'Annual Health Checkup', 'debit card', 'Full Body Checkup', NULL, 'PENDING'),
(16, '921225128765', 4, 'TELEMEDICINE', '2023-11-17', '11:45:00', 'Medication Follow-up', 'online transfer', NULL, 'Zoom', 'PENDING'),
(18, '950320147891', 6, 'HEALTH-SCREENING', '2023-11-19', '09:30:00', 'Blood Pressure Check', 'cash', 'Basic Health Checkup', NULL, 'PENDING'),
(19, '941005054320', 7, 'TELEMEDICINE', '2023-11-20', '01:45:00', 'Follow-up Consultation', 'online transfer', NULL, 'Skype', 'PENDING'),
(20, '931113056788', 8, 'CONSULTATION', '2023-11-21', '10:30:00', 'Chronic Pain', 'insurance', NULL, NULL, 'PENDING'),
(23, '060925567890', 11, 'CONSULTATION', '2023-11-24', '04:30:00', 'Allergies', 'online transfer', NULL, NULL, 'PENDING'),
(24, '900815123456', 12, 'TELEMEDICINE', '2023-12-05', '01:00:00', 'Follow-up Consultation', 'credit card', NULL, 'Zoom', 'PENDING'),
(25, '980430145679', 13, 'TELEMEDICINE', '2023-12-08', '03:45:00', 'Medication Review', 'debit card', NULL, 'Skype', 'PENDING'),
(26, '041219789012', 13, 'TELEMEDICINE', '2023-12-12', '11:30:00', 'Psychological Counseling', 'online transfer', NULL, 'Google Meet', 'APPROVED'),
(27, '071114112233', 15, 'TELEMEDICINE', '2023-12-15', '02:15:00', 'Dietary Consultation', 'credit card', NULL, 'Microsoft Teams', 'PENDING'),
(28, '021228456789', 16, 'TELEMEDICINE', '2023-12-18', '09:45:00', 'Chronic Condition Management', 'credit card', NULL, 'Zoom', 'APPROVED'),
(29, '990601345678', 17, 'TELEMEDICINE', '2023-12-21', '01:30:00', 'Mental Health Checkup', 'debit card', NULL, 'Skype', 'APPROVED'),
(30, '060925567890', 18, 'TELEMEDICINE', '2023-12-25', '10:00:00', 'General Wellness Check', 'online transfer', NULL, 'Zoom', 'APPROVED'),
(31, '001212234567', 19, 'TELEMEDICINE', '2023-12-28', '03:15:00', 'Medication Adjustment', 'credit card', NULL, 'Skype', 'APPROVED'),
(32, '091015345678', 20, 'TELEMEDICINE', '2023-12-31', '11:30:00', 'Teletherapy Session', 'online transfer', NULL, 'Zoom', 'APPROVED'),
(33, '041219789012', 21, 'TELEMEDICINE', '2024-01-03', '02:45:00', 'Medication Refill', 'online banking', NULL, 'Microsoft Teams', 'APPROVED'),
(34, '041219789012', 22, 'TELEMEDICINE', '2023-12-05', '01:30:00', 'Medication Follow-up', 'credit card', NULL, 'Zoom', 'APPROVED'),
(35, '071114112233', 23, 'TELEMEDICINE', '2023-12-08', '03:15:00', 'Mental Health Consultation', 'online transfer', NULL, 'Skype', 'APPROVED'),
(36, '021228456789', 27, 'TELEMEDICINE', '2023-12-12', '11:00:00', 'Follow-up Consultation', 'debit card', NULL, 'Google Meet', 'APPROVED'),
(37, '990601345678', 24, 'TELEMEDICINE', '2023-12-15', '02:45:00', 'Dietary Counseling', 'credit card', NULL, 'Zoom', 'APPROVED'),
(38, '060925567890', 25, 'TELEMEDICINE', '2023-12-18', '10:30:00', 'Teletherapy Session', 'online banking', NULL, 'Microsoft Teams', 'APPROVED'),
(39, '001212234567', 26, 'TELEMEDICINE', '2023-12-21', '01:15:00', 'Medication Review', 'online transfer', NULL, 'Zoom', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctorID` int(11) NOT NULL COMMENT 'Doctor ID',
  `doctorName` varchar(60) NOT NULL COMMENT 'Doctor name',
  `specialtyID` int(11) NOT NULL COMMENT 'Reference to specialties table',
  `qualifications` varchar(255) NOT NULL COMMENT 'Description of ability',
  `designation` varchar(100) DEFAULT NULL COMMENT 'Position in hospital',
  `officeNum` varchar(12) NOT NULL COMMENT 'Office phone number',
  `workDay` varchar(30) NOT NULL DEFAULT 'Mon - Sat' COMMENT 'Working days',
  `officeHour` varchar(30) NOT NULL DEFAULT '8.30am - 6pm' COMMENT 'Office Hour'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctorID`, `doctorName`, `specialtyID`, `qualifications`, `designation`, `officeNum`, `workDay`, `officeHour`) VALUES
(2, 'Dr. Tan Wei Lin', 1006, 'MBBS (UM), M Anaes (Mal)', 'Anesthesiologist', 'A306', 'Mon - Fri', '9am - 5pm'),
(3, 'Dr. Lim Chee Meng', 1001, 'MD (UKM), MRCP (UK), Dip Cardiology (London), FNHAM', 'Cardiologist', 'B202', 'Mon -\r\nSat', '8.30am - 6pm'),
(4, 'Dr. Siti Aisyah Abdul Rahman', 1002, 'MBBS (AIMST) , MRCP (UK), Adv.M.Derm (UKM), SCE DERMATOLOGY \r\n(UK)', 'Dermatologist', 'C404', 'Tue - Sat', '10am - 7pm'),
(5, 'Dr. Mohamed Faizal bin Abdullah', 1003, 'MBBS (UM), MRCP (UK), FRCP (GLASGOW), FRCP (EDINBURGH)', 'Emergency Physician', 'B101', 'Mon - Sun', '8:30am - 6pm'),
(6, 'Dr. Liew Mei Ling', 1004, 'MBBS (Hons) (Aus), B Sc Med (Hons) (Aus), FRCP (UK), AM (Mal)', 'Endocrinologist', 'C407', 'Mon - Fri', '9am - 5pm'),
(7, 'Dr. Ahmad bin Hassan', 1005, 'M.D. (USM), M. MED (USM) Fellow Gastroent(Melbourne, Australia)', 'Gastroenterologist', 'A502', 'Wed - Sat', '10am - 6pm'),
(8, 'Dr. Lim Kah Wei', 1005, 'MBBS (IMU), MRCP (UK), ESEGH, Fellowship in Gastroenterology and Hepatology (MAL), \r\nFellowship in Advanced Endoscopy (Australia), Member of the Asian Novel Bio-Imaging and Intervention Group (ANBIIG)', 'Gastroenterologist', 'A504', 'Tue - Sat', '10am - 6pm'),
(9, 'Dr. Chong Mei Ling', 1005, 'MMed (Mal), MB. BCh. BAO. (Hons) LRCPI & LRCSI (Ire), B. Biomed Sci. (Hons) (UM)', 'Gastroenterologist', 'A506', 'Mon - Fri', '9am - 5pm'),
(10, 'Dr. Ng Li Hua', 1012, 'MB BCH BAO LRCP & SI (Ireland), Dr of General Surgery (UKM), FRCSI (Ireland)', 'General\r\nSurgeon', 'A204', 'Mon - Fri', '8.30am - 5pm'),
(11, 'Dr. Raj Kumar a/l Subramaniam', 1013, 'MBBS (Mal), MRCP (UK), FRCP (Lon), FRCPA (Haem) Aust ', 'Hematologist', 'D301', 'Tue - Sat', '9am - 6pm'),
(12, 'Dr. Tan Mei Yen', 1014, 'MBBS (MMMC), MRCP (UK), Fellowship in Neurology (Malaysia)', 'Neurologist', 'C505', 'Mon -\r\nFri', '10am - 7pm'),
(13, 'Dr. Raju a/l Muthu', 1015, 'MBBS, FRCP (Edin), FRCP (Glasg), FCCP (USA), FACA (USA), FAMS', 'Pulmonologist', 'D304', 'Tue - Sat', '9am - 5pm'),
(15, 'Dr. Tan Wei Ling', 1006, 'MBBS (UM), M Anaes (Mal)', 'Anesthesiologist', 'A305', 'Mon - Fri', '9am - 5pm'),
(16, 'Dr. Lim Chee Meng', 1001, 'MD (UKM), MRCP (UK), Dip Cardiology (London), FNHAM', 'Cardiologist', 'B202', 'Mon -\r\nSat', '8.30am - 6pm'),
(17, 'Dr. Siti Aisyah Abdul Rahman', 1002, 'MBBS (AIMST) , MRCP (UK), Adv.M.Derm (UKM), SCE DERMATOLOGY \r\n(UK)', 'Dermatologist', 'C404', 'Tue - Sat', '10am - 7pm'),
(18, 'Dr. Mohamed Faizal bin Abdullah', 1003, 'MBBS (UM), MRCP (UK), FRCP (GLASGOW), FRCP (EDINBURGH)', 'Emergency Physician', 'B101', 'Mon - Sun', '8:30am - 6pm'),
(19, 'Dr. Liew Mei Ling', 1004, 'MBBS (Hons) (Aus), B Sc Med (Hons) (Aus), FRCP (UK), AM (Mal)', 'Endocrinologist', 'C407', 'Mon - Fri', '9am - 5pm'),
(20, 'Dr. Ahmad bin Hassan', 1005, 'M.D. (USM), M. MED (USM) Fellow Gastroent(Melbourne, Australia)', 'Gastroenterologist', 'A502', 'Wed - Sat', '10am - 6pm'),
(21, 'Dr. Lim Kah Wei', 1005, 'MBBS (IMU), MRCP (UK), ESEGH, Fellowship in Gastroenterology and Hepatology (MAL), \r\nFellowship in Advanced Endoscopy (Australia), Member of the Asian Novel Bio-Imaging and Intervention Group (ANBIIG)', 'Gastroenterologist', 'A504', 'Tue - Sat', '10am - 6pm'),
(22, 'Dr. Chong Mei Ling', 1005, 'MMed (Mal), MB. BCh. BAO. (Hons) LRCPI & LRCSI (Ire), B. Biomed Sci. (Hons) (UM)', 'Gastroenterologist', 'A506', 'Mon - Fri', '9am - 5pm'),
(23, 'Dr. Ng Li Hua', 1012, 'MB BCH BAO LRCP & SI (Ireland), Dr of General Surgery (UKM), FRCSI (Ireland)', 'General\r\nSurgeon', 'A204', 'Mon - Fri', '8.30am - 5pm'),
(24, 'Dr. Raj Kumar a/l Subramaniam', 1013, 'MBBS (Mal), MRCP (UK), FRCP (Lon), FRCPA (Haem) Aust ', 'Hematologist', 'D301', 'Tue - Sat', '9am - 6pm'),
(25, 'Dr. Tan Mei Yen', 1014, 'MBBS (MMMC), MRCP (UK), Fellowship in Neurology (Malaysia)', 'Neurologist', 'C505', 'Mon -\r\nFri', '10am - 7pm'),
(26, 'Dr. Raju a/l Muthu', 1015, 'MBBS, FRCP (Edin), FRCP (Glasg), FCCP (USA), FACA (USA), FAMS', 'Pulmonologist', 'D304', 'Tue - Sat', '9am - 5pm'),
(27, 'Dr. Wong Mei Kwan', 1016, 'MBBS(Mal), M. Med(Radiology), FRCR(London)', 'Radiologist', 'B203', 'Mon - Fri', '8am -\r\n4pm'),
(28, 'Dr. Lee Ming Hui', 1006, 'MD.M.Med, (Anaes) UKM, AM', 'Anesthesiologist', 'A301', 'Mon - Fri', '8am - 4pm'),
(29, 'Dr. Tan Mei Yen', 1016, 'MBBS (UM), FRCS (Edinburgh), Board Certified Urologist (Malaysia), FRCS (Urology) \r\nGlasgow', 'Urologist', 'A301', 'Mon - Fri', '8am - 4pm'),
(30, 'Testt=2', 1002, 'Testt=2', 'Testt=2', 'Testt=2', 'Testt=2', 'Testt=2');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donationID` int(11) NOT NULL COMMENT 'Donation ID',
  `donor` varchar(60) NOT NULL COMMENT 'Donor name',
  `donorContact` varchar(12) NOT NULL COMMENT 'Donor contact number',
  `donorEmail` varchar(50) NOT NULL COMMENT 'Donor email',
  `amount` decimal(10,2) NOT NULL COMMENT 'Amount of donation',
  `paymentType` varchar(30) NOT NULL COMMENT 'Payment type',
  `message` varchar(255) NOT NULL COMMENT 'Remarks'
) ;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donationID`, `donor`, `donorContact`, `donorEmail`, `amount`, `paymentType`, `message`) VALUES
(1, 'Ahmad bin Hassan', '0123456789', 'ahmad.hassan@gmail.com', 500.00, 'Credit Card', 'Donation to hospital \r\nas gratitude'),
(2, 'Siti Nur Syamira', '0186548889', 'syamira.cute@gmail.com', 200.00, 'Credit Card', 'Further improve \r\nfacilities'),
(3, 'Mohamed Faizal bin Abdullah', '0145678901', 'mohamed.faizal@gmail.com', 100.00, 'Bank Transfer', 'Generosity'),
(4, 'Siti Aisyah binti Abdul Rahman', '0145678901', 'mohamed.faizal@gmail.com', 100.00, 'Bank Transfer', 'Generosity'),
(5, 'Lim Chee Meng', '0198765432', 'cheemeng.lim@gmail.com', 100.00, ' e-Wallet', 'Charity'),
(6, 'Tan Min Yan', '0131567820', 'mytan89@gmail.com', 500.00, 'e-Wallet', 'To help others in need.'),
(7, 'Raj Kumar a/l Subramaniam', '0123456789', 'raj.subramaniam@gmail.com', 1000.00, 'Credit Card', 'For the \r\nhospital staffs hardwork and gratitude for never giving up on me. Thank you so much.'),
(8, 'Tan Hui Xian', '01699887766', 'tan.huixian@hotmail.com', 50.00, 'e-Wallet', 'Supporting our local \r\nhospital.'),
(9, 'Mohammad Ali bin Ibrahim', '01233445566', 'mohd.ali@gmail.com', 200.00, 'e-Wallet', 'Show kindness to \r\nothers just as others have shown me.'),
(10, 'Evelyn Tan Mei Yee', '0172394296', 'evelyn.tan@yahoo.com', 350.00, 'Bank Transfer', 'Big thank you for \r\nhelping my sister.'),
(11, 'Ho Xing Lin', '01131421987', 'vinci@gmail.com', 100.00, 'Credit Card', 'Donation to hospital as gratitude'),
(12, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(13, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(14, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(15, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(16, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(17, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(18, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(19, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(20, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(21, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(22, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(23, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(24, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(25, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(26, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(27, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(28, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(29, 'x', '123', 'e@gmail.com', 10.00, 'online banking', ''),
(30, 'Test 2', '01131441987', 'e@gmail.com', 30.00, 'TNG', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineID` int(11) NOT NULL COMMENT 'Medicine ID',
  `medicineName` varchar(60) NOT NULL COMMENT 'Medicine name',
  `price` decimal(10,2) NOT NULL COMMENT 'Price per unit',
  `expirationDate` date NOT NULL COMMENT 'Expiration date',
  `description` varchar(255) NOT NULL COMMENT 'Description in brief'
) ;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineID`, `medicineName`, `price`, `expirationDate`, `description`) VALUES
(1, 'Paracetamol', 15.99, '2023-12-01', 'Analgesic and antipyretic for pain and fever relief.'),
(2, 'Ibuprofen', 22.50, '2024-02-15', 'NSAID for pain and inflammation.'),
(3, 'Amoxicillin', 30.75, '2023-11-20', 'Broad-spectrum antibiotic for bacterial infections.'),
(4, 'Omeprazole', 18.60, '2024-01-10', 'Proton pump inhibitor for gastric acid reduction.'),
(5, 'Aspirin', 12.99, '2023-10-05', 'Analgesic and anti-inflammatory for pain relief.'),
(6, 'Simvastatin', 40.25, '2024-03-22', 'HMG-CoA reductase inhibitor for cholesterol management.'),
(7, 'Cetirizine', 8.75, '2023-12-18', 'Antihistamine for allergy relief.'),
(8, 'Metformin', 15.30, '2024-02-28', 'Oral antidiabetic for type 2 diabetes control.'),
(9, 'Albuterol Inhaler', 45.99, '2023-11-15', 'Short-acting bronchodilator for asthma management.'),
(10, 'Lisinopril', 25.00, '2024-01-05', 'ACE inhibitor for hypertension.'),
(11, 'Ciprofloxacin', 32.75, '2023-12-12', 'Fluoroquinolone antibiotic for various infections.'),
(12, 'Diazepam', 14.20, '2024-02-20', 'Benzodiazepine for anxiety and muscle spasms.'),
(13, 'Levothyroxine', 17.90, '2023-11-25', 'Thyroid hormone replacement for hypothyroidism.'),
(14, 'Amlodipine', 21.30, '2024-01-15', 'Calcium channel blocker for hypertension.'),
(15, 'Prednisone', 13.45, '2023-10-10', 'Corticosteroid for inflammation and immune system suppression.'),
(16, 'Cephalexin', 28.60, '2024-03-05', 'First-generation cephalosporin antibiotic for bacterial infections.'),
(17, 'Atorvastatin', 35.25, '2023-12-28', 'Statins for cholesterol management.'),
(18, 'Furosemide', 19.50, '2024-02-10', 'Loop diuretic for edema and hypertension.'),
(19, 'Metoprolol', 27.15, '2023-09-22', 'Beta-blocker for hypertension and angina.'),
(20, 'Hydroxyzine', 23.40, '2024-04-15', 'Antihistamine and anxiolytic for allergy and anxiety.');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientIC` varchar(12) NOT NULL COMMENT 'IC number without dash',
  `patientName` varchar(60) NOT NULL COMMENT 'Patient name',
  `password` varchar(30) NOT NULL COMMENT 'Password',
  `patientDOB` date NOT NULL COMMENT 'Date of Birth',
  `gender` varchar(6) NOT NULL DEFAULT 'MALE' COMMENT 'Gender',
  `patientEmail` varchar(50) NOT NULL COMMENT 'Email',
  `patientAddress` varchar(255) NOT NULL COMMENT 'Address in short',
  `patientContact` varchar(12) NOT NULL COMMENT 'Contact number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientIC`, `patientName`, `password`, `patientDOB`, `gender`, `patientEmail`, `patientAddress`, `patientContact`) VALUES
('001212234567', 'Alice Lee Yin Ling', 'Alic3_wonderl4nd*', '2000-12-12', 'female', 'alice.lee@hotmail.com', '14 Jalan Kuchai Lama, Kuala Lumpur', '01122334455'),
('021228456789', 'Tan Mei Yen', 'idkWhatP@$$w0rdToPut', '2002-12-28', 'female', 'tan.meiyen@yahoo.com', '28 Jalan Gasing, Petaling Jaya', '01622334455'),
('030810456782', 'Linda Wong Mei Ling', '1ceCream$@', '2003-08-10', 'female', 'linda.wong@gmail.com', '18 Jalan Pudu, Kuala Lumpur', '01344556677'),
('041201080774', 'Vinci', '12345678', '2004-12-01', 'FEMALE', 'xinglinho6@gmail.com', 'jytrewdq', '01131441987'),
('041201080775', 'test', '$2y$10$LMbeKrWil35oubrd5eqHie2', '2023-10-31', 'Male', 's@gmail.com', 'Bukit Bintang', '0123122345'),
('041219789012', 'Emily Tan Mei Sze', 'my1maginaryBoyfri3nd#FANTASIA', '2004-12-19', 'female', 'emily.tan@yahoo.com', '22 Jalan Bukit Tinggi, Klang', '01777889900'),
('060925567890', 'Mohammad Ali bin Ibrahim', 'Alibaba.com/ali1', '2006-09-25', 'male', 'mohd.ali@gmail.com', '8 Jalan Ampang, Johor Bahru', '01233445566'),
('071114112233', 'Kumar a/l Rajan', '0Xkumar@taj_mahal', '2007-11-14', 'male', 'kumar.rajan@yahoo.com', '25 Lorong Ampang, Penang', '01911223344'),
('080325123456', 'Lim Wei Jie', 'qwer1234zxc.M', '2008-03-25', 'male', 'lim.weijie@gmail.com', '35 Jalan Damansara, Petaling Jaya', '01455667788'),
('091015345678', 'Ravi a/l Subramaniam', 'R@vi_Subr@m', '2009-10-15', 'male', 'ravi.subramaniam@gmail.com', '50 Lorong Masjid, Penang', '01933445566'),
('123456789871', 'Testing', '#Vinci0774', '2023-11-01', 'Male', 'xinglin@gmail.com', 'Bukit Bintang', '01231441987'),
('870701052344', 'Wong Mei Ling', 'MLWong@0707', '1987-07-01', 'female', 'meiling.wong@gmail.com', '17 Jalan Damansara, Petaling Jaya', '0176543210'),
('880512084320', 'Siti Aisyah binti Abdul Rahman', 'UnknownPassword!!!', '1988-05-12', 'female', 'siti.aisyah@gmail.com', '25 Jalan Ampang, Selangor', '0112345678'),
('890602081235', 'Tan Mei Yen', 'meimeiTAN89.', '1989-06-02', 'female', 'meiyen.tan@gmail.com', '22 Jalan Subang, Subang Jaya', '0131234567'),
('900815123456', 'Ng Li Hua', 'Hanak1re1<3', '1990-08-15', 'female', 'lihua.ng@gmail.com', '10 Jalan Cheras, Kuala Lumpur', '0154321098'),
('921225128765', 'Lim Chee Meng', 'MengLim@321', '1992-12-25', 'male', 'cheemeng.lim@gmail.com', '8 Jalan Klang Lama, Kuala Lumpur', '0198765432'),
('931113056788', 'Mohamed Faizal bin Abdullah', 'coolMaN931113/3', '1993-11-13', 'male', 'mohamed.faizal@gmail.com', '7 Jalan Sentul, Kuala Lumpur', '0145678901'),
('941005054320', 'Raj Kumar a/l Subramaniam', 'oooo08kuma8Ooooo', '1994-10-05', 'male', 'raj.subramaniam@gmail.com', '14 Jalan Pudu, Kuala Lumpur', '0123456789'),
('950320147891', 'Raju a/l Muthu', 'RAJAAAAa#00000', '1995-03-20', 'male', 'raju.muthu@gmail.com', '3 Jalan Puchong, Puchong', '0167890123'),
('980430145679', 'Chong Mei Ling', '!!Bellringing88!!', '1998-04-30', 'female', 'meiling.chong@gmail.com', '5 Jalan Kuchai Lama, Kuala Lumpur', '0168765432'),
('990101145678', 'Ahmad bin Hassan', 'P@ssw0rd123', '1999-01-01', 'male', 'ahmad.hassan@gmail.com', '12 Jalan Bukit Bintang, Kuala Lumpur', '0123456789'),
('990601345678', 'Tan Hui Xian', 'mou1kaimou1kai*2', '1999-06-01', 'female', 'tan.huixian@hotmail.com', '30 Jalan Sultan Ismail, Kuala Lumpur', '01699887766');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL COMMENT 'Payment ID',
  `patientIC` varchar(12) NOT NULL COMMENT 'Reference to patients table',
  `telemedicineID` int(11) NOT NULL COMMENT 'Reference to telemedicine table',
  `amount` decimal(10,2) NOT NULL COMMENT 'Amount paid',
  `paymentDate` date NOT NULL COMMENT 'Date of payment made',
  `paymentType` varchar(30) NOT NULL COMMENT 'Payment type'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentID`, `patientIC`, `telemedicineID`, `amount`, `paymentDate`, `paymentType`) VALUES
(1, '071114112233', 10, 320.00, '2023-11-12', 'Credit Card'),
(2, '941005054320', 12, 300.00, '2023-11-12', 'Credit Card'),
(3, '041219789012', 8, 285.65, '2023-11-12', 'Bank Transfer'),
(4, '890602081235', 5, 450.00, '2023-11-12', 'e-Wallet'),
(5, '041219789012', 4, 500.00, '2023-11-12', 'Bank Transfer'),
(6, '931113056788', 11, 250.00, '2023-11-12', 'Credit Card'),
(7, '071114112233', 6, 380.00, '2023-11-12', 'Credit Card'),
(8, '931113056788', 13, 650.70, '2023-11-12', 'Credit Card'),
(9, '990601345678', 9, 180.00, '2023-11-12', 'Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `shippingID` int(11) NOT NULL COMMENT 'Shipping ID',
  `telemedicineID` int(11) NOT NULL COMMENT 'Reference to telemedicine table',
  `remarks` varchar(255) DEFAULT NULL COMMENT 'Remarks',
  `shippingDate` date NOT NULL COMMENT 'Date of shipping',
  `shippingStatus` varchar(30) DEFAULT 'NOT SHIPPED OUT' COMMENT 'Send out or not'
) ;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`shippingID`, `telemedicineID`, `remarks`, `shippingDate`, `shippingStatus`) VALUES
(1, 10, '', '2023-11-12', 'SHIPPED'),
(2, 12, '', '2023-11-12', 'SHIPPED'),
(3, 8, '', '2023-11-12', 'SHIPPED'),
(4, 5, 'Bubblewrap', '2023-11-12', 'SHIPPED'),
(5, 4, '', '2023-11-12', 'SHIPPED'),
(6, 11, 'Bubblewrap', '2023-11-12', 'SHIPPED'),
(7, 6, 'Extra Protection', '2023-11-12', 'SHIPPED'),
(8, 13, 'Allergy Protection, Shipping Protection', '2023-11-12', 'SHIPPED'),
(9, 9, '', '2023-11-12', 'SHIPPED'),
(11, 1, 'Paracetamol - 2 After Eating', '2023-12-01', 'NOT SHIPPED OUT'),
(12, 1, 'Paracetamol - 2 After Eating', '2023-12-01', 'NOT SHIPPED OUT'),
(13, 1, 'Paracetamol - 2 After Eating', '2023-12-01', 'NOT SHIPPED OUT'),
(14, 1, 'Paracetamol - 2 After Eating', '2023-12-01', 'NOT SHIPPED OUT');

-- --------------------------------------------------------

--
-- Table structure for table `shippings_medicine`
--

CREATE TABLE `shippings_medicine` (
  `shippingID` int(11) NOT NULL,
  `medicineID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shippings_medicine`
--

INSERT INTO `shippings_medicine` (`shippingID`, `medicineID`, `quantity`) VALUES
(1, 9, 1),
(1, 14, 2),
(1, 17, 1),
(4, 8, 5),
(6, 4, 10),
(7, 11, 8),
(14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `specialtyID` int(11) NOT NULL,
  `specialtyName` varchar(60) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`specialtyID`, `specialtyName`, `location`) VALUES
(1001, 'Cardiology', 'Block B, Level 2, Unit 8'),
(1002, 'Dermatology', 'Block C, Level 4, Unit 10'),
(1003, 'Emergency Medicine', 'Block B, Level 1, Unit 3'),
(1004, 'Endocrinology', 'Block C, Level 3A, Unit 7'),
(1005, 'Gastroenterology', 'Block A, Level 5, Unit 12'),
(1006, 'Anesthesiology', 'Block A, Level 3, Unit 5'),
(1012, 'General Surgery', 'Block A, Level 2, Unit 6'),
(1013, 'Hematology', 'Block D, Level 3, Unit 9'),
(1014, 'Neurology', 'Block C, Level 5, Unit 8'),
(1015, 'Pulmonology', 'Block D, Level 3, Unit 3A'),
(1016, 'Radiology', 'Block B, Level 2, Unit 11');

-- --------------------------------------------------------

--
-- Table structure for table `telemedicine`
--

CREATE TABLE `telemedicine` (
  `telemedicineID` int(11) NOT NULL COMMENT 'Telemedicine ID',
  `appointmentID` int(11) NOT NULL COMMENT 'Appointment ID',
  `platformLink` varchar(200) DEFAULT NULL COMMENT 'Edit by admin after appointment has been approved',
  `fee` decimal(10,2) NOT NULL COMMENT 'Fee need to pay',
  `teleStatus` varchar(20) DEFAULT 'UNCOMPLETED' COMMENT 'Completed or not'
) ;

--
-- Dumping data for table `telemedicine`
--

INSERT INTO `telemedicine` (`telemedicineID`, `appointmentID`, `platformLink`, `fee`, `teleStatus`) VALUES
(1, 26, 'google_meet_link_here', 50.00, 'UNCOMPLETED'),
(2, 28, 'zoom_link_here', 60.00, 'UNCOMPLETED'),
(3, 29, 'skype_link_here', 55.00, 'UNCOMPLETED'),
(4, 30, 'zoom_link_here', 50.00, 'UNCOMPLETED'),
(5, 31, 'skype_link_here', 60.00, 'UNCOMPLETED'),
(6, 32, 'zoom_link_here', 50.00, 'UNCOMPLETED'),
(7, 33, 'teams_link_here', 40.00, 'UNCOMPLETED'),
(8, 34, 'zoom_link_here', 60.00, 'UNCOMPLETED'),
(9, 35, 'skype_link_here', 50.00, 'UNCOMPLETED'),
(10, 36, 'google_meet_link_here', 55.00, 'UNCOMPLETED'),
(11, 37, 'zoom_link_here', 60.00, 'UNCOMPLETED'),
(12, 38, 'teams_link_here', 40.00, 'UNCOMPLETED'),
(13, 39, 'zoom_link_here', 50.00, 'UNCOMPLETED'),
(14, 31, '', 20.00, 'COMPLETED'),
(15, 31, '', 20.00, 'UNCOMPLETED'),
(16, 31, '', 20.00, 'UNCOMPLETED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `patientIC` (`patientIC`),
  ADD KEY `doctorID` (`doctorID`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctorID`),
  ADD KEY `specialtyID` (`specialtyID`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donationID`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientIC`),
  ADD UNIQUE KEY `patients_email_un` (`patientEmail`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `payments_patientIC_fk` (`patientIC`),
  ADD KEY `payments_telemedicine_fk` (`telemedicineID`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`shippingID`),
  ADD KEY `shippings_telemedicineID_fk` (`telemedicineID`);

--
-- Indexes for table `shippings_medicine`
--
ALTER TABLE `shippings_medicine`
  ADD PRIMARY KEY (`shippingID`,`medicineID`),
  ADD KEY `medicineID` (`medicineID`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`specialtyID`);

--
-- Indexes for table `telemedicine`
--
ALTER TABLE `telemedicine`
  ADD PRIMARY KEY (`telemedicineID`),
  ADD KEY `telemedicine_appointmentID_fk` (`appointmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctorID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Doctor ID', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donationID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Donation ID';

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Medicine ID';

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Payment ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `shippingID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Shipping ID';

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `specialtyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT for table `telemedicine`
--
ALTER TABLE `telemedicine`
  MODIFY `telemedicineID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Telemedicine ID';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientIC`) REFERENCES `patients` (`patientIC`) ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctorID`) REFERENCES `doctors` (`doctorID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specialtyID`) REFERENCES `specialties` (`specialtyID`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_patientIC_fk` FOREIGN KEY (`patientIC`) REFERENCES `patients` (`patientIC`),
  ADD CONSTRAINT `payments_telemedicine_fk` FOREIGN KEY (`telemedicineID`) REFERENCES `telemedicine` (`telemedicineID`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_telemedicineID_fk` FOREIGN KEY (`telemedicineID`) REFERENCES `telemedicine` (`telemedicineID`);

--
-- Constraints for table `shippings_medicine`
--
ALTER TABLE `shippings_medicine`
  ADD CONSTRAINT `shippings_medicine_ibfk_1` FOREIGN KEY (`shippingID`) REFERENCES `shippings` (`shippingID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `shippings_medicine_ibfk_2` FOREIGN KEY (`medicineID`) REFERENCES `medicine` (`medicineID`) ON UPDATE CASCADE;

--
-- Constraints for table `telemedicine`
--
ALTER TABLE `telemedicine`
  ADD CONSTRAINT `telemedicine_appointmentID_fk` FOREIGN KEY (`appointmentID`) REFERENCES `appointments` (`appointmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
