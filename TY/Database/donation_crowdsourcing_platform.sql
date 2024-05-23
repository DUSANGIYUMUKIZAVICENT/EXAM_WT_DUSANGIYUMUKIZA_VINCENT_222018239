-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:47 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donation_crowdsourcing_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiariestable`
--

CREATE TABLE `beneficiariestable` (
  `beneficiaryid` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `contactinfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beneficiariestable`
--

INSERT INTO `beneficiariestable` (`beneficiaryid`, `id`, `name`, `description`, `contactinfo`) VALUES
(1, 1, 'John Doe', 'Retired military veteran', 'john.doe@example.com'),
(2, 2, 'Jane Smith', 'Single mother of two', 'jane.smith@example.com'),
(3, 3, 'David Johnson', 'College student studying computer science', 'david.johnson@example.com'),
(4, 4, 'Maria Garcia', 'Small business owner', 'maria.garcia@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `campaignstable`
--

CREATE TABLE `campaignstable` (
  `CampaignID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `CampaignName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Goal` decimal(10,2) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `OrganizerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campaignstable`
--

INSERT INTO `campaignstable` (`CampaignID`, `id`, `CampaignName`, `Description`, `Goal`, `StartDate`, `EndDate`, `OrganizerID`) VALUES
(1, 1, 'Education for All', 'Provide education to underprivileged children', '5000.00', '2024-06-01', '2024-12-31', 1001),
(2, 2, 'Clean Water Initiative', 'Ensure access to clean drinking water in rural areas', '10000.00', '2024-07-01', '2025-01-31', 1002),
(3, 3, 'Food Drive', 'Collect and distribute food to homeless shelters', '3000.00', '2024-08-01', '2024-12-31', 1003),
(4, 4, 'Healthcare Awareness', 'Raise awareness about preventive healthcare measures', '7000.00', '2024-09-01', '2025-03-31', 1004);

-- --------------------------------------------------------

--
-- Table structure for table `donationstable`
--

CREATE TABLE `donationstable` (
  `DonationID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `CampaignID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PaymentStatus` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donationstable`
--

INSERT INTO `donationstable` (`DonationID`, `id`, `CampaignID`, `Amount`, `Timestamp`, `PaymentStatus`) VALUES
(2, 1, 1, '100.00', '2024-05-18 10:29:51', 'Completed'),
(3, 2, 2, '200.50', '2024-05-18 10:29:51', 'Completed'),
(4, 3, 3, '75.25', '2024-05-18 10:29:51', 'Pending'),
(5, 4, 4, '150.75', '2024-05-18 10:29:51', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktable`
--

CREATE TABLE `feedbacktable` (
  `FeedbackID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacktable`
--

INSERT INTO `feedbacktable` (`FeedbackID`, `id`, `Rating`, `Comment`) VALUES
(1, 1, 4, 'Great campaign! Really made a difference.'),
(2, 2, 5, 'Excellent work, keep it up!'),
(3, 3, 3, 'Good effort, but could use some improvements.'),
(4, 4, 4, 'Really appreciated the awareness raised.');

-- --------------------------------------------------------

--
-- Table structure for table `mediatable`
--

CREATE TABLE `mediatable` (
  `MediaID` int(11) NOT NULL,
  `CampaignID` int(11) DEFAULT NULL,
  `MediaURL` varchar(255) DEFAULT NULL,
  `MediaType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mediatable`
--

INSERT INTO `mediatable` (`MediaID`, `CampaignID`, `MediaURL`, `MediaType`) VALUES
(1, 1, 'http://example.com/image1.jpg', 'Image'),
(2, 2, 'http://example.com/video1.mp4', 'Video'),
(3, 3, 'http://example.com/image2.jpg', 'Image'),
(4, 4, 'http://example.com/video2.mp4', 'Video');

-- --------------------------------------------------------

--
-- Table structure for table `notificationtable`
--

CREATE TABLE `notificationtable` (
  `NotificationID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsRead` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notificationtable`
--

INSERT INTO `notificationtable` (`NotificationID`, `id`, `Message`, `Timestamp`, `IsRead`) VALUES
(1, 1, 'You have a new message.', '2024-05-18 10:51:37', 0),
(2, 2, 'Reminder: Event tomorrow at 10 AM.', '2024-05-18 10:51:37', 0),
(3, 3, 'Your donation was successfully received.', '2024-05-18 10:51:37', 1),
(4, 4, 'New campaign launched. Join now!', '2024-05-18 10:51:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paymenttable`
--

CREATE TABLE `paymenttable` (
  `PaymentID` int(11) NOT NULL,
  `TransactionID` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymenttable`
--

INSERT INTO `paymenttable` (`PaymentID`, `TransactionID`, `Amount`, `Timestamp`) VALUES
(1, '001', '50.00', '2024-05-18 10:57:51'),
(2, '002', '100.00', '2024-05-18 10:57:51'),
(3, '003', '75.25', '2024-05-18 10:57:51'),
(4, '004', '150.75', '2024-05-18 10:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `reportstable`
--

CREATE TABLE `reportstable` (
  `ReportID` int(11) NOT NULL,
  `ReportName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportstable`
--

INSERT INTO `reportstable` (`ReportID`, `ReportName`, `Description`) VALUES
(1, 'Monthly Sales Report', 'Summary of sales data for the month of May.'),
(2, 'Financial Year Budget', 'Budget projection for the upcoming financial year.'),
(3, 'Customer Satisfaction Survey Results', 'Analysis of customer feedback from recent surveys.'),
(4, 'Employee Performance Review', 'Evaluation of employee performance for the quarter.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `activation_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `activation_code`) VALUES
(1, 'dusangiyumukiza', 'vincent', 'dusangiyumukizavincent@gmail.com', 'dusangiyumukizavincent@gmail.com', '0798887777', '$2y$10$Az6RqEQr0GObHs2Vk6ygQODT6iDI.uHUrXaf7e0E/Dn4Ru9Nkwa8O', '6666'),
(2, 'kam', 'vestine', 'kalisa', 'kalisa@gmail.com', '07889999000', 'ka', '2'),
(3, 'uwa', 'jose', 'jose', 'jose@gmail.com', '078434343', 'jo', '3'),
(4, 'shema', 'peter', 'peter', 'peter@gmail.com', '076655555', 'pe', '4'),
(5, 'nepo', 'iradu', 'nepom', 'iradunep@gmail.com', '23453456', '$2y$10$939qs8FST7943UFaRAeYPuHV.GH1aj7CRgd.VoN4wSIfib2dj36Qa', '3333');

-- --------------------------------------------------------

--
-- Table structure for table `volunteertable`
--

CREATE TABLE `volunteertable` (
  `VolunteerID` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `ContactInfo` varchar(255) DEFAULT NULL,
  `Skills` text DEFAULT NULL,
  `Availability` varchar(255) DEFAULT NULL,
  `AssignedTasks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteertable`
--

INSERT INTO `volunteertable` (`VolunteerID`, `id`, `ContactInfo`, `Skills`, `Availability`, `AssignedTasks`) VALUES
(1, 1, 'kalisa@example.com', 'Event planning, Communication', 'Weekends', 'Event setup, Registration'),
(2, 2, 'shema@example.com', 'Social media marketing, Graphic design', 'Evenings', 'Content creation, Social media management'),
(3, 3, 'kezaon@example.com', 'Programming, Data analysis', 'Weekdays', 'Database management, Data visualization'),
(4, 4, 'ange@example.com', 'Customer service, Sales', 'Flexible', 'Customer inquiries, Sales support');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiariestable`
--
ALTER TABLE `beneficiariestable`
  ADD PRIMARY KEY (`beneficiaryid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `campaignstable`
--
ALTER TABLE `campaignstable`
  ADD PRIMARY KEY (`CampaignID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `donationstable`
--
ALTER TABLE `donationstable`
  ADD PRIMARY KEY (`DonationID`),
  ADD KEY `id` (`id`),
  ADD KEY `CampaignID` (`CampaignID`);

--
-- Indexes for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `mediatable`
--
ALTER TABLE `mediatable`
  ADD PRIMARY KEY (`MediaID`),
  ADD KEY `CampaignID` (`CampaignID`);

--
-- Indexes for table `notificationtable`
--
ALTER TABLE `notificationtable`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `paymenttable`
--
ALTER TABLE `paymenttable`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `reportstable`
--
ALTER TABLE `reportstable`
  ADD PRIMARY KEY (`ReportID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteertable`
--
ALTER TABLE `volunteertable`
  ADD PRIMARY KEY (`VolunteerID`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficiariestable`
--
ALTER TABLE `beneficiariestable`
  MODIFY `beneficiaryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `campaignstable`
--
ALTER TABLE `campaignstable`
  MODIFY `CampaignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donationstable`
--
ALTER TABLE `donationstable`
  MODIFY `DonationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mediatable`
--
ALTER TABLE `mediatable`
  MODIFY `MediaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notificationtable`
--
ALTER TABLE `notificationtable`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paymenttable`
--
ALTER TABLE `paymenttable`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reportstable`
--
ALTER TABLE `reportstable`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `volunteertable`
--
ALTER TABLE `volunteertable`
  MODIFY `VolunteerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiariestable`
--
ALTER TABLE `beneficiariestable`
  ADD CONSTRAINT `beneficiariestable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `campaignstable`
--
ALTER TABLE `campaignstable`
  ADD CONSTRAINT `campaignstable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `donationstable`
--
ALTER TABLE `donationstable`
  ADD CONSTRAINT `donationstable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `donationstable_ibfk_2` FOREIGN KEY (`CampaignID`) REFERENCES `campaignstable` (`CampaignID`);

--
-- Constraints for table `feedbacktable`
--
ALTER TABLE `feedbacktable`
  ADD CONSTRAINT `feedbacktable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mediatable`
--
ALTER TABLE `mediatable`
  ADD CONSTRAINT `mediatable_ibfk_1` FOREIGN KEY (`CampaignID`) REFERENCES `campaignstable` (`CampaignID`);

--
-- Constraints for table `notificationtable`
--
ALTER TABLE `notificationtable`
  ADD CONSTRAINT `notificationtable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `volunteertable`
--
ALTER TABLE `volunteertable`
  ADD CONSTRAINT `volunteertable_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
