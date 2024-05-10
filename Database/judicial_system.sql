-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 01:50 PM
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
-- Database: `judicial_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocate_details`
--

CREATE TABLE `advocate_details` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `licence_number` varchar(50) NOT NULL,
  `bar_association` varchar(100) NOT NULL,
  `experience` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `id_proof` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advocate_details`
--

INSERT INTO `advocate_details` (`id`, `userid`, `name`, `phone`, `email`, `address`, `licence_number`, `bar_association`, `experience`, `qualification`, `photo`, `id_proof`) VALUES
(1, 3, 'Michael Thompson', '9567456321', 'michel@gmail.com', '789 Advocate Road, Justicetown, State, ZIP', 'K/003547/2010', 'Bar Association of Trivandrum Court', '10 years', 'Master of Laws (LLM)', 'user/1919734448testimonial-3.jpg', 'user/15040787222NF.PNG'),
(2, 4, 'Alice Johnson', '9995812912', 'alice@gmail.com', '789 Advocate Road, Justicetown, TVM, Kerala', 'K/003547/2010', 'Memeber of Bar Council of Kerala', '6 years', 'MA, LLM', 'user/17574554testimonial-4.jpg', 'user/17614293831NF.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `case_details`
--

CREATE TABLE `case_details` (
  `case_id` int(11) NOT NULL,
  `case_number` varchar(100) DEFAULT NULL,
  `case_title` varchar(200) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `filing_date` varchar(50) DEFAULT NULL,
  `defendant_name` varchar(150) NOT NULL,
  `case_status` varchar(50) DEFAULT NULL,
  `incident_date` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `defendent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_details`
--

INSERT INTO `case_details` (`case_id`, `case_number`, `case_title`, `description`, `category`, `filing_date`, `defendant_name`, `case_status`, `incident_date`, `user_id`, `created_date`, `defendent_id`) VALUES
(1, 'CASE-2024-3010', 'XYZ Corporation Sues Emily Johnson for Breach of Contract', 'Emily Johnson is being sued for breach of contract by XYZ Corporation. The plaintiff alleges that Ms. Johnson failed to fulfill her obligations under the contract signed on [date], resulting in financial losses for the company. The contract pertained to the delivery of goods and services as outlined in the agreement. XYZ Corporation seeks compensation for damages incurred due to Ms. Johnson\\\'s failure to adhere to the terms of the contract', 'Civil', '23-03-2024', 'Emily Johnson', 'Hearing', '2024-03-14', 1, '2024-03-23 13:28:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `case_documents`
--

CREATE TABLE `case_documents` (
  `document_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `file_name` varchar(300) NOT NULL,
  `advocate_id` int(11) NOT NULL,
  `case_handling_id` int(11) NOT NULL,
  `description_details` varchar(500) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_documents`
--

INSERT INTO `case_documents` (`document_id`, `case_id`, `document_type`, `file_name`, `advocate_id`, `case_handling_id`, `description_details`, `upload_date`) VALUES
(1, 1, 'Legal Memorandum', 'documents/1099171862NF_res.PNG', 3, 1, 'Legal analysis or arguments presented', '2024-03-23 16:12:46'),
(2, 1, 'Case Update Report', 'documents/13079021911NF_res.PNG', 3, 1, 'Orders issued by the court. Updates on case progress.', '2024-03-23 16:13:18'),
(3, 1, 'Evidence Submission', 'documents/15473679831NF.PNG', 3, 1, 'Key arguments presented by the advocate. Responses from opposing counsel or parties involved.', '2024-03-23 16:14:18'),
(4, 1, 'Phone Recordings', 'documents/8235626623NF.PNG', 4, 2, 'XYZ Corporation seeks compensation for damages incurred due to Ms. Johnson\\\'s failure to adhere to the terms of the contract', '2024-03-23 18:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `case_handling_advocates`
--

CREATE TABLE `case_handling_advocates` (
  `id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `advocate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_handling_advocates`
--

INSERT INTO `case_handling_advocates` (`id`, `case_id`, `advocate_id`, `user_id`, `status`) VALUES
(1, 1, 3, 1, 1),
(2, 1, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coordinator_details`
--

CREATE TABLE `coordinator_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `experience` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator_details`
--

INSERT INTO `coordinator_details` (`id`, `user_id`, `name`, `email`, `phone`, `gender`, `experience`, `qualification`) VALUES
(1, 7, 'Jeeva A S', 'jeeva@gmail.com', '9578456987', 'Female', '3 Years at session court, Ernakulam', 'MS LLB');

-- --------------------------------------------------------

--
-- Table structure for table `hearing_schedule`
--

CREATE TABLE `hearing_schedule` (
  `hearing_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `hearing_date` varchar(30) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `hearing_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hearing_schedule`
--

INSERT INTO `hearing_schedule` (`hearing_id`, `case_id`, `hearing_date`, `judge_id`, `description`, `hearing_status`) VALUES
(1, 1, '2024-03-22', 5, 'First hearing intimation report sent to all involved parties for scheduling and preparation', 1),
(2, 1, '2024-03-23', 5, 'Second Trial Hearing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `judgement_details`
--

CREATE TABLE `judgement_details` (
  `judgement_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `judge_id` int(11) NOT NULL,
  `success_user_id` int(11) NOT NULL,
  `judgement_date` datetime NOT NULL DEFAULT current_timestamp(),
  `judgement_notes` varchar(500) NOT NULL,
  `judgement_penalty` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `judge_details`
--

CREATE TABLE `judge_details` (
  `jid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `specialization` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judge_details`
--

INSERT INTO `judge_details` (`jid`, `user_id`, `name`, `gender`, `email`, `phone`, `specialization`, `address`, `description`, `photo`, `status`) VALUES
(1, 5, 'John Doe', 'Male', 'johndoe@gmail.com', '7845698826', 'Criminal Judges', '789 Justice Avenue, Courthouse City, Trivandrum, Kerala', 'John Doe is a highly experienced judge with over 20 years of practice in criminal law. He has presided over numerous high-profile cases, demonstrating a deep understanding of legal principles and a commitment to upholding justice. ', 'user/2060981295team-1.jpg', 1),
(2, 6, 'Sarah Rodriguez', 'Female', 'sarah@gmail.com', '9745698823', 'Specialized Tribunals and Courts', '789 Green Street, Eco City, Tvm', 'Sarah Rodriguez is a dedicated judge specializing in environmental law, committed to protecting the planet and ensuring sustainable development.', 'user/2084067459testimonial-4.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `email`, `password`, `user_type`, `status`) VALUES
(1, 'john@gmail.com', 'Pwd@123', 'public', 1),
(2, 'emily@gmail.com', 'Pwd@123', 'public', 1),
(3, 'michel@gmail.com', 'Pwd@123', 'Advocate', 1),
(4, 'alice@gmail.com', 'Pwd@123', 'Advocate', 1),
(5, 'johndoe@gmail.com', 'Pwd@123', 'Judge', 1),
(6, 'sarah@gmail.com', 'Pwd@123', 'Judge', 1),
(7, 'jeeva@gmail.com', 'Pwd@123', 'coordinator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `uid` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `id_proof` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`uid`, `user_id`, `name`, `email`, `phone`, `address`, `id_proof`) VALUES
(1, 1, 'John Smith', 'john@gmail.com', '9567903333', '456 Elm Street, Townsville, TVM, Kerala', 'user/215602843NF.PNG'),
(2, 2, 'Emily Johnson', 'emily@gmail.com', '9457896698', '901 Pine Road, Hamletville, Trivandrum, Kerala', 'user/215602843NF.PNG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advocate_details`
--
ALTER TABLE `advocate_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_details`
--
ALTER TABLE `case_details`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `case_documents`
--
ALTER TABLE `case_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `case_handling_advocates`
--
ALTER TABLE `case_handling_advocates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coordinator_details`
--
ALTER TABLE `coordinator_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hearing_schedule`
--
ALTER TABLE `hearing_schedule`
  ADD PRIMARY KEY (`hearing_id`);

--
-- Indexes for table `judgement_details`
--
ALTER TABLE `judgement_details`
  ADD PRIMARY KEY (`judgement_id`);

--
-- Indexes for table `judge_details`
--
ALTER TABLE `judge_details`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advocate_details`
--
ALTER TABLE `advocate_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `case_details`
--
ALTER TABLE `case_details`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_documents`
--
ALTER TABLE `case_documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `case_handling_advocates`
--
ALTER TABLE `case_handling_advocates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coordinator_details`
--
ALTER TABLE `coordinator_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hearing_schedule`
--
ALTER TABLE `hearing_schedule`
  MODIFY `hearing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `judgement_details`
--
ALTER TABLE `judgement_details`
  MODIFY `judgement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `judge_details`
--
ALTER TABLE `judge_details`
  MODIFY `jid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
