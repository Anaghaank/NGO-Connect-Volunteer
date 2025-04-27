-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 08:35 AM
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
-- Database: `volunteer_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badge_id` int(11) NOT NULL,
  `badge_name` varchar(100) DEFAULT NULL,
  `badge_description` text DEFAULT NULL,
  `badge_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `badge_name`, `badge_description`, `badge_icon`) VALUES
(1, 'Community Builder', 'Awarded to volunteers who actively engage and bring people together in community initiatives.', 'https://example.com/icons/community_builder_icon.png'),
(2, 'Outstanding Volunteer', 'Given to volunteers who have shown exceptional dedication and impact in their projects.', 'https://example.com/icons/outstanding_volunteer_icon.png'),
(3, 'Newcomer', 'Awarded to volunteers who have recently joined and made an immediate positive impact.', 'https://example.com/icons/newcomer_icon.png'),
(4, 'Event Organizer', 'For volunteers who have successfully organized and led community events.', 'https://example.com/icons/event_organizer_icon.png'),
(5, 'Environmental Advocate', 'Given to volunteers who work towards environmental conservation and sustainability efforts.', 'https://example.com/icons/environmental_advocate_icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `ngo_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `completion_hours` int(11) NOT NULL,
  `status` enum('upcoming','ongoing','completed') DEFAULT 'upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `ngo_id`, `name`, `type`, `location`, `event_date`, `event_time`, `completion_hours`, `status`) VALUES
(1, 1, 'Helping Hands Fundraiser', 'Fundraiser', 'Mumbai', '2025-05-10', '10:00:00', 5, 'completed'),
(2, 1, 'Green Earth Clean-Up Drive', 'Clean-Up', 'Delhi', '2025-06-15', '09:00:00', 4, 'completed'),
(3, 1, 'EduSpark Workshop', 'Workshop', 'Bangalore', '2025-07-20', '14:00:00', 6, 'completed'),
(4, 2, 'Women Rise Awareness Program', 'Awareness', 'Kolkata', '2025-08-05', '11:00:00', 3, 'completed'),
(5, 2, 'CareBridge Charity Walk', 'Walk', 'Chennai', '2025-09-25', '08:00:00', 4, 'upcoming'),
(6, 2, 'Hope Circle Health Camp', 'Health Camp', 'Pune', '2025-06-01', '09:30:00', 8, 'completed'),
(7, 3, 'TreeLife Tree Plantation', 'Plantation', 'Hyderabad', '2025-09-10', '07:00:00', 5, 'upcoming'),
(8, 3, 'Youth Empower Mentorship', 'Mentorship', 'Ahmedabad', '2025-10-12', '15:00:00', 4, 'completed'),
(9, 3, 'Bright Future Skill Development', 'Skill Development', 'Jaipur', '2025-11-05', '10:00:00', 6, 'upcoming'),
(10, 4, 'Eco Savers Beach Clean-Up', 'Clean-Up', 'Lucknow', '2025-12-15', '08:00:00', 5, 'upcoming'),
(11, 4, 'Food for All Charity Lunch', 'Fundraiser', 'Surat', '2025-05-18', '12:00:00', 4, 'upcoming'),
(12, 5, 'Shelter India Shelter Building', 'Construction', 'Nagpur', '2025-06-28', '08:30:00', 10, 'upcoming'),
(13, 5, 'Vision Aid Vision Screening', 'Health Camp', 'Indore', '2025-07-15', '10:00:00', 6, 'upcoming'),
(14, 6, 'SkillSpring Career Counseling', 'Counseling', 'Bhopal', '2025-08-01', '14:00:00', 3, 'upcoming'),
(15, 6, 'Peace Forum Mental Health Seminar', 'Seminar', 'Kanpur', '2025-09-05', '11:00:00', 4, 'upcoming'),
(16, 7, 'Heal Hearts Blood Donation', 'Blood Donation', 'Patna', '2025-10-25', '09:00:00', 5, 'upcoming'),
(17, 7, 'Youth Help Clean-Up Campaign', 'Clean-Up', 'Vadodara', '2025-11-10', '07:00:00', 4, 'upcoming'),
(18, 8, 'Green Future Green Day', 'Festival', 'Visakhapatnam', '2025-12-01', '15:00:00', 6, 'upcoming'),
(19, 8, 'Rise Again Homeless Shelter', 'Shelter', 'Coimbatore', '2025-06-20', '08:00:00', 8, 'upcoming'),
(20, 9, 'SupportNow Free Medical Camp', 'Health Camp', 'Thiruvananthapuram', '2025-07-07', '09:00:00', 6, 'upcoming'),
(21, 9, 'Helping Hands Blood Donation', 'Blood Donation', 'Mumbai', '2025-08-20', '10:00:00', 4, 'upcoming'),
(22, 10, 'Green Earth Recycling Drive', 'Recycling', 'Delhi', '2025-09-30', '14:00:00', 5, 'upcoming'),
(23, 10, 'EduSpark Student Counseling', 'Counseling', 'Bangalore', '2025-10-10', '11:00:00', 3, 'upcoming'),
(24, 11, 'Women Rise Gender Equality Talk', 'Talk', 'Kolkata', '2025-11-15', '15:00:00', 4, 'upcoming'),
(25, 11, 'CareBridge Education Program', 'Workshop', 'Chennai', '2025-12-10', '10:00:00', 6, 'upcoming'),
(26, 12, 'Hope Circle Mental Health Workshop', 'Workshop', 'Pune', '2025-05-25', '11:00:00', 5, 'upcoming'),
(27, 12, 'TreeLife Wildlife Conservation', 'Conservation', 'Hyderabad', '2025-06-10', '08:00:00', 7, 'upcoming'),
(28, 13, 'Youth Empower Youth Leadership Camp', 'Camp', 'Ahmedabad', '2025-07-22', '09:00:00', 6, 'upcoming'),
(29, 13, 'Bright Future Study Support', 'Tutoring', 'Jaipur', '2025-08-01', '10:00:00', 5, 'upcoming'),
(30, 14, 'Eco Savers River Clean-Up', 'Clean-Up', 'Lucknow', '2025-09-01', '07:30:00', 4, 'upcoming'),
(31, 14, 'Food for All Donation Drive', 'Fundraiser', 'Surat', '2025-10-05', '12:00:00', 5, 'upcoming'),
(32, 15, 'Shelter India Rehabilitation Program', 'Rehabilitation', 'Nagpur', '2025-11-12', '14:00:00', 8, 'upcoming'),
(33, 15, 'Vision Aid Blood Screening', 'Health Camp', 'Indore', '2025-12-01', '09:00:00', 6, 'upcoming'),
(34, 16, 'SkillSpring Leadership Training', 'Training', 'Bhopal', '2025-05-30', '10:00:00', 5, 'upcoming'),
(35, 16, 'Peace Forum Yoga Therapy', 'Therapy', 'Kanpur', '2025-06-15', '07:00:00', 4, 'upcoming'),
(36, 17, 'Heal Hearts Medical Outreach', 'Outreach', 'Patna', '2025-07-18', '08:00:00', 6, 'upcoming'),
(37, 17, 'Youth Help Recycling Program', 'Recycling', 'Vadodara', '2025-08-20', '09:00:00', 4, 'upcoming'),
(38, 18, 'Green Future Earth Day', 'Festival', 'Visakhapatnam', '2025-09-05', '15:00:00', 7, 'upcoming'),
(39, 18, 'Rise Again Fundraiser Gala', 'Fundraiser', 'Coimbatore', '2025-10-15', '18:00:00', 5, 'upcoming'),
(40, 19, 'SupportNow Awareness Drive', 'Awareness', 'Thiruvananthapuram', '2025-11-25', '10:00:00', 6, 'upcoming'),
(41, 19, 'Helping Hands Blood Donation', 'Blood Donation', 'Mumbai', '2025-06-20', '08:00:00', 5, 'upcoming'),
(42, 20, 'Green Earth Education Camp', 'Workshop', 'Delhi', '2025-05-30', '10:00:00', 4, 'upcoming'),
(43, 20, 'Youth Empower Counseling Program', 'Counseling', 'Bangalore', '2025-08-01', '12:00:00', 3, 'upcoming'),
(44, 1, 'Youth Upliftment Camp', 'Camp', 'Bangalore', '2024-02-15', '10:00:00', 6, 'completed'),
(45, 1, 'Health Screening Drive', 'Health Camp', 'Delhi', '2024-01-25', '09:00:00', 5, 'completed'),
(46, 1, 'Fundraiser Gala Night', 'Fundraiser', 'Mumbai', '2024-03-10', '18:00:00', 4, 'completed'),
(47, 2, 'Mental Health Workshop', 'Workshop', 'Kolkata', '2024-04-12', '11:00:00', 3, 'completed'),
(48, 2, 'Food Donation Drive', 'Donation', 'Chennai', '2024-05-01', '08:00:00', 5, 'completed'),
(49, 2, 'Vocational Training Session', 'Skill Development', 'Pune', '2024-06-18', '14:00:00', 6, 'completed'),
(50, 3, 'Women Empowerment Talk', 'Awareness', 'Hyderabad', '2024-03-07', '10:00:00', 4, 'completed'),
(51, 3, 'Child Education Support Meet', 'Meetup', 'Ahmedabad', '2024-02-05', '15:00:00', 2, 'completed'),
(52, 3, 'Annual Blood Donation Camp', 'Health Camp', 'Surat', '2024-04-21', '09:30:00', 6, 'completed'),
(53, 4, 'Raincoat Distribution Drive', 'Distribution', 'Nagpur', '2024-05-09', '07:00:00', 2, 'completed'),
(54, 4, 'Hygiene Awareness Rally', 'Awareness', 'Patna', '2024-01-30', '10:00:00', 3, 'completed'),
(55, 4, 'Waste Management Workshop', 'Workshop', 'Indore', '2024-06-02', '13:00:00', 5, 'completed'),
(56, 5, 'Orphanage Visit and Activity', 'Visit', 'Bhopal', '2024-03-18', '11:00:00', 4, 'completed'),
(57, 5, 'Senior Citizens’ Meet', 'Meetup', 'Lucknow', '2024-02-28', '10:30:00', 3, 'completed'),
(58, 5, 'Vaccination Support Program', 'Medical', 'Kanpur', '2024-04-10', '09:00:00', 6, 'completed'),
(59, 6, 'Clothes Collection Drive', 'Donation', 'Ranchi', '2024-05-15', '12:00:00', 2, 'completed'),
(60, 6, 'STEM Workshop for Girls', 'Workshop', 'Mysore', '2024-02-22', '10:00:00', 4, 'completed'),
(61, 6, 'Nutrition Awareness Program', 'Awareness', 'Amritsar', '2024-03-05', '11:00:00', 3, 'completed'),
(62, 7, 'Sanitary Pad Distribution', 'Distribution', 'Coimbatore', '2024-06-10', '08:00:00', 2, 'completed'),
(63, 7, 'Disability Rights Seminar', 'Seminar', 'Vijayawada', '2024-04-16', '14:00:00', 5, 'completed'),
(64, 7, 'NGO Partnership Meet', 'Meetup', 'Tirupati', '2024-05-30', '15:00:00', 2, 'completed'),
(65, 8, 'Environmental Talk Show', 'Awareness', 'Panaji', '2024-03-11', '12:00:00', 4, 'completed'),
(66, 8, 'Legal Aid Awareness', 'Seminar', 'Thiruvananthapuram', '2024-04-25', '10:00:00', 3, 'completed'),
(67, 8, 'Free Eye Check-up Camp', 'Medical', 'Madurai', '2024-05-22', '09:00:00', 5, 'completed'),
(68, 9, 'River Cleanup Initiative', 'Clean-Up', 'Udaipur', '2024-02-17', '07:00:00', 6, 'completed'),
(69, 9, 'Water Purifier Installation', 'Installation', 'Nashik', '2024-04-04', '08:30:00', 3, 'completed'),
(70, 9, 'Community Gardening', 'Gardening', 'Gwalior', '2024-06-03', '07:30:00', 4, 'completed'),
(71, 10, 'Online Tutoring Bootcamp', 'Workshop', 'Siliguri', '2024-03-23', '16:00:00', 5, 'completed'),
(72, 10, 'Fundraising Carnival', 'Fundraiser', 'Shimla', '2024-02-11', '17:00:00', 6, 'completed'),
(73, 10, 'Job Readiness Program', 'Skill Development', 'Jodhpur', '2024-05-04', '10:30:00', 4, 'completed'),
(74, 11, 'Flood Relief Campaign', 'Relief', 'Guwahati', '2024-04-08', '11:00:00', 8, 'completed'),
(75, 11, 'Animal Shelter Volunteering', 'Volunteering', 'Vellore', '2024-01-20', '08:00:00', 3, 'completed'),
(76, 11, 'COVID Awareness Drive', 'Awareness', 'Noida', '2024-06-07', '09:00:00', 4, 'completed'),
(77, 12, 'Blood Grouping Camp', 'Medical', 'Bareilly', '2024-03-02', '10:00:00', 4, 'completed'),
(78, 12, 'Free Library Launch', 'Inauguration', 'Thrissur', '2024-04-29', '12:00:00', 3, 'completed'),
(79, 12, 'Digital Literacy Training', 'Workshop', 'Warangal', '2024-05-18', '10:00:00', 5, 'completed'),
(80, 13, 'Sports Event for Underprivileged', 'Sports', 'Raipur', '2024-02-19', '09:00:00', 6, 'completed'),
(81, 13, 'Waste Segregation Awareness', 'Awareness', 'Bhilai', '2024-03-28', '11:00:00', 4, 'completed'),
(82, 13, 'Rural Health Monitoring', 'Health Camp', 'Dehradun', '2024-05-12', '10:00:00', 6, 'completed'),
(83, 14, 'Rehabilitation Talk', 'Seminar', 'Haridwar', '2024-06-01', '14:00:00', 3, 'completed'),
(84, 14, 'Job Fair for Disabled', 'Fair', 'Faridabad', '2024-04-13', '09:00:00', 5, 'completed'),
(85, 14, 'Library Management Workshop', 'Workshop', 'Ajmer', '2024-05-07', '13:00:00', 4, 'completed'),
(86, 15, 'Food Processing Demo', 'Demo', 'Guntur', '2024-01-29', '15:00:00', 3, 'completed'),
(87, 15, 'Clean India Hackathon', 'Hackathon', 'Kozhikode', '2024-04-17', '10:00:00', 6, 'completed'),
(88, 15, 'Unity Marathon', 'Marathon', 'Kakinada', '2024-03-09', '06:30:00', 5, 'completed'),
(89, 16, 'Cultural Heritage Tour', 'Tour', 'Puducherry', '2024-02-10', '08:00:00', 6, 'completed'),
(90, 16, 'Traditional Art Workshop', 'Workshop', 'Dharwad', '2024-05-26', '11:00:00', 4, 'completed'),
(91, 16, 'Green School Initiative', 'Awareness', 'Erode', '2024-04-01', '10:00:00', 4, 'completed'),
(92, 17, 'Women Coding Camp', 'Camp', 'Trichy', '2024-06-14', '09:00:00', 6, 'completed'),
(93, 1, 'Summer Coding Bootcamp', 'Workshop', 'Bangalore', '2025-04-20', '10:00:00', 6, 'ongoing'),
(94, 2, 'Youth Leadership Program', 'Training', 'Delhi', '2025-04-21', '09:30:00', 5, 'ongoing'),
(95, 3, 'Community Kitchen Service', 'Volunteering', 'Mumbai', '2025-04-22', '08:00:00', 4, 'ongoing'),
(96, 4, 'Environmental Education Series', 'Awareness', 'Kolkata', '2025-04-23', '11:00:00', 3, 'ongoing'),
(97, 5, 'Tech Skills for Rural Youth', 'Skill Development', 'Chennai', '2025-04-20', '13:00:00', 6, 'ongoing'),
(98, 6, 'Hygiene Kit Distribution', 'Distribution', 'Pune', '2025-04-24', '09:00:00', 2, 'ongoing'),
(99, 7, 'Water Conservation Drive', 'Campaign', 'Hyderabad', '2025-04-19', '10:30:00', 4, 'ongoing'),
(100, 8, 'Career Counselling Camp', 'Camp', 'Ahmedabad', '2025-04-23', '14:00:00', 3, 'ongoing'),
(101, 9, 'Children’s Book Donation', 'Donation', 'Surat', '2025-04-22', '12:00:00', 2, 'ongoing'),
(102, 10, 'Online Safety Awareness', 'Webinar', 'Lucknow', '2025-04-24', '17:00:00', 1, 'ongoing'),
(103, 1, 'Cleaning drive', 'Cleaning environment', 'Mangalore', '2025-04-29', '06:20:00', 3, 'upcoming'),
(109, 1, 'TechGig', 'Teaching', 'Udupi', '2025-04-30', '09:25:00', 5, 'upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `event_applications`
--

CREATE TABLE `event_applications` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `completion_hours` int(11) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_applications`
--

INSERT INTO `event_applications` (`application_id`, `user_id`, `email`, `password`, `event_id`, `completion_hours`, `applied_at`) VALUES
(3, 21, 'volunteer1@example.com', 'password123', 4, 3, '2025-04-27 04:31:10'),
(4, 21, 'volunteer1@example.com', 'password123', 6, 8, '2025-04-27 04:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('ngo','volunteer') NOT NULL,
  `ngo_name` varchar(100) DEFAULT NULL,
  `ngo_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `age`, `date_of_birth`, `gender`, `occupation`, `phone_number`, `email`, `address`, `password`, `role`, `ngo_name`, `ngo_location`) VALUES
(1, 'NGO Admin 1', 35, '1989-05-15', 'Male', 'Coordinator', '9000000001', 'ngo1@example.com', 'Address 1', 'password123', 'ngo', 'Helping Hands', 'Mumbai'),
(2, 'NGO Admin 2', 40, '1984-04-22', 'Female', 'Director', '9000000002', 'ngo2@example.com', 'Address 2', 'password123', 'ngo', 'Green Earth', 'Delhi'),
(3, 'NGO Admin 3', 42, '1982-08-30', 'Male', 'Manager', '9000000003', 'ngo3@example.com', 'Address 3', 'password123', 'ngo', 'EduSpark', 'Bangalore'),
(4, 'NGO Admin 4', 38, '1986-11-12', 'Female', 'Coordinator', '9000000004', 'ngo4@example.com', 'Address 4', 'password123', 'ngo', 'Women Rise', 'Kolkata'),
(5, 'NGO Admin 5', 45, '1979-03-10', 'Other', 'Founder', '9000000005', 'ngo5@example.com', 'Address 5', 'password123', 'ngo', 'CareBridge', 'Chennai'),
(6, 'NGO Admin 6', 36, '1988-01-15', 'Male', 'Manager', '9000000006', 'ngo6@example.com', 'Address 6', 'password123', 'ngo', 'Hope Circle', 'Pune'),
(7, 'NGO Admin 7', 39, '1985-06-18', 'Female', 'Director', '9000000007', 'ngo7@example.com', 'Address 7', 'password123', 'ngo', 'TreeLife', 'Hyderabad'),
(8, 'NGO Admin 8', 41, '1983-02-25', 'Male', 'Advisor', '9000000008', 'ngo8@example.com', 'Address 8', 'password123', 'ngo', 'Youth Empower', 'Ahmedabad'),
(9, 'NGO Admin 9', 37, '1987-07-07', 'Female', 'Coordinator', '9000000009', 'ngo9@example.com', 'Address 9', 'password123', 'ngo', 'Bright Future', 'Jaipur'),
(10, 'NGO Admin 10', 43, '1981-10-01', 'Male', 'Manager', '9000000010', 'ngo10@example.com', 'Address 10', 'password123', 'ngo', 'Eco Savers', 'Lucknow'),
(11, 'NGO Admin 11', 34, '1990-09-14', 'Female', 'Coordinator', '9000000011', 'ngo11@example.com', 'Address 11', 'password123', 'ngo', 'Food for All', 'Surat'),
(12, 'NGO Admin 12', 46, '1978-12-19', 'Male', 'Advisor', '9000000012', 'ngo12@example.com', 'Address 12', 'password123', 'ngo', 'Shelter India', 'Nagpur'),
(13, 'NGO Admin 13', 44, '1980-05-27', 'Other', 'Founder', '9000000013', 'ngo13@example.com', 'Address 13', 'password123', 'ngo', 'Vision Aid', 'Indore'),
(14, 'NGO Admin 14', 32, '1992-03-03', 'Male', 'Coordinator', '9000000014', 'ngo14@example.com', 'Address 14', 'password123', 'ngo', 'SkillSpring', 'Bhopal'),
(15, 'NGO Admin 15', 48, '1976-06-11', 'Female', 'Director', '9000000015', 'ngo15@example.com', 'Address 15', 'password123', 'ngo', 'Peace Forum', 'Kanpur'),
(16, 'NGO Admin 16', 40, '1984-08-21', 'Male', 'Manager', '9000000016', 'ngo16@example.com', 'Address 16', 'password123', 'ngo', 'Heal Hearts', 'Patna'),
(17, 'NGO Admin 17', 37, '1987-04-05', 'Female', 'Coordinator', '9000000017', 'ngo17@example.com', 'Address 17', 'password123', 'ngo', 'Youth Help', 'Vadodara'),
(18, 'NGO Admin 18', 39, '1985-11-23', 'Male', 'Director', '9000000018', 'ngo18@example.com', 'Address 18', 'password123', 'ngo', 'Green Future', 'Visakhapatnam'),
(19, 'NGO Admin 19', 35, '1989-02-28', 'Other', 'Advisor', '9000000019', 'ngo19@example.com', 'Address 19', 'password123', 'ngo', 'Rise Again', 'Coimbatore'),
(20, 'NGO Admin 20', 41, '1983-07-19', 'Male', 'Founder', '9000000020', 'ngo20@example.com', 'Address 20', 'password123', 'ngo', 'SupportNow', 'Thiruvananthapuram'),
(21, 'Volunteer 1', 25, '1999-01-01', 'Male', 'Volunteer', '1234567890', 'volunteer1@example.com', 'Address 1', 'password123', 'volunteer', NULL, NULL),
(22, 'Volunteer 2', 28, '1996-02-01', 'Female', 'Volunteer', '1234567891', 'volunteer2@example.com', 'Address 2', 'password123', 'volunteer', NULL, NULL),
(23, 'Volunteer 3', 22, '2002-03-01', 'Other', 'Volunteer', '1234567892', 'volunteer3@example.com', 'Address 3', 'password123', 'volunteer', NULL, NULL),
(24, 'Volunteer 4', 26, '1998-04-01', 'Male', 'Volunteer', '1234567893', 'volunteer4@example.com', 'Address 4', 'password123', 'volunteer', NULL, NULL),
(25, 'Volunteer 5', 27, '1997-05-01', 'Female', 'Volunteer', '1234567894', 'volunteer5@example.com', 'Address 5', 'password123', 'volunteer', NULL, NULL),
(26, 'Volunteer 6', 24, '2000-06-01', 'Male', 'Volunteer', '1234567895', 'volunteer6@example.com', 'Address 6', 'password123', 'volunteer', NULL, NULL),
(27, 'Volunteer 7', 30, '1994-07-01', 'Female', 'Volunteer', '1234567896', 'volunteer7@example.com', 'Address 7', 'password123', 'volunteer', NULL, NULL),
(28, 'Volunteer 8', 25, '1999-08-01', 'Male', 'Volunteer', '1234567897', 'volunteer8@example.com', 'Address 8', 'password123', 'volunteer', NULL, NULL),
(29, 'Volunteer 9', 29, '1995-09-01', 'Other', 'Volunteer', '1234567898', 'volunteer9@example.com', 'Address 9', 'password123', 'volunteer', NULL, NULL),
(30, 'Volunteer 10', 26, '1998-10-01', 'Female', 'Volunteer', '1234567899', 'volunteer10@example.com', 'Address 10', 'password123', 'volunteer', NULL, NULL),
(31, 'Volunteer 11', 27, '1997-11-01', 'Male', 'Volunteer', '1234567900', 'volunteer11@example.com', 'Address 11', 'password123', 'volunteer', NULL, NULL),
(32, 'Volunteer 12', 28, '1996-12-01', 'Female', 'Volunteer', '1234567901', 'volunteer12@example.com', 'Address 12', 'password123', 'volunteer', NULL, NULL),
(33, 'Volunteer 13', 22, '2002-01-01', 'Other', 'Volunteer', '1234567902', 'volunteer13@example.com', 'Address 13', 'password123', 'volunteer', NULL, NULL),
(34, 'Volunteer 14', 26, '1998-02-01', 'Male', 'Volunteer', '1234567903', 'volunteer14@example.com', 'Address 14', 'password123', 'volunteer', NULL, NULL),
(35, 'Volunteer 15', 29, '1995-03-01', 'Female', 'Volunteer', '1234567904', 'volunteer15@example.com', 'Address 15', 'password123', 'volunteer', NULL, NULL),
(36, 'Volunteer 16', 24, '2000-04-01', 'Male', 'Volunteer', '1234567905', 'volunteer16@example.com', 'Address 16', 'password123', 'volunteer', NULL, NULL),
(37, 'Volunteer 17', 30, '1994-05-01', 'Female', 'Volunteer', '1234567906', 'volunteer17@example.com', 'Address 17', 'password123', 'volunteer', NULL, NULL),
(38, 'Volunteer 18', 25, '1999-06-01', 'Other', 'Volunteer', '1234567907', 'volunteer18@example.com', 'Address 18', 'password123', 'volunteer', NULL, NULL),
(39, 'Volunteer 19', 27, '1997-07-01', 'Male', 'Volunteer', '1234567908', 'volunteer19@example.com', 'Address 19', 'password123', 'volunteer', NULL, NULL),
(40, 'Volunteer 20', 28, '1996-08-01', 'Female', 'Volunteer', '1234567909', 'volunteer20@example.com', 'Address 20', 'password123', 'volunteer', NULL, NULL),
(41, 'Volunteer 21', 22, '2002-09-01', 'Other', 'Volunteer', '1234567910', 'volunteer21@example.com', 'Address 21', 'password123', 'volunteer', NULL, NULL),
(42, 'Volunteer 22', 26, '1998-10-01', 'Male', 'Volunteer', '1234567911', 'volunteer22@example.com', 'Address 22', 'password123', 'volunteer', NULL, NULL),
(43, 'Volunteer 23', 29, '1995-11-01', 'Female', 'Volunteer', '1234567912', 'volunteer23@example.com', 'Address 23', 'password123', 'volunteer', NULL, NULL),
(44, 'Volunteer 24', 24, '2000-12-01', 'Male', 'Volunteer', '1234567913', 'volunteer24@example.com', 'Address 24', 'password123', 'volunteer', NULL, NULL),
(45, 'Volunteer 25', 30, '1994-01-01', 'Female', 'Volunteer', '1234567914', 'volunteer25@example.com', 'Address 25', 'password123', 'volunteer', NULL, NULL),
(46, 'Volunteer 26', 25, '1999-02-01', 'Other', 'Volunteer', '1234567915', 'volunteer26@example.com', 'Address 26', 'password123', 'volunteer', NULL, NULL),
(47, 'Volunteer 27', 28, '1996-03-01', 'Male', 'Volunteer', '1234567916', 'volunteer27@example.com', 'Address 27', 'password123', 'volunteer', NULL, NULL),
(48, 'Volunteer 28', 22, '2002-04-01', 'Female', 'Volunteer', '1234567917', 'volunteer28@example.com', 'Address 28', 'password123', 'volunteer', NULL, NULL),
(49, 'Volunteer 29', 26, '1998-05-01', 'Other', 'Volunteer', '1234567918', 'volunteer29@example.com', 'Address 29', 'password123', 'volunteer', NULL, NULL),
(50, 'Volunteer 30', 29, '1995-06-01', 'Male', 'Volunteer', '1234567919', 'volunteer30@example.com', 'Address 30', 'password123', 'volunteer', NULL, NULL),
(51, 'Volunteer 31', 24, '2000-07-01', 'Female', 'Volunteer', '1234567920', 'volunteer31@example.com', 'Address 31', 'password123', 'volunteer', NULL, NULL),
(52, 'Volunteer 32', 30, '1994-08-01', 'Other', 'Volunteer', '1234567921', 'volunteer32@example.com', 'Address 32', 'password123', 'volunteer', NULL, NULL),
(53, 'Volunteer 33', 25, '1999-09-01', 'Male', 'Volunteer', '1234567922', 'volunteer33@example.com', 'Address 33', 'password123', 'volunteer', NULL, NULL),
(54, 'Volunteer 34', 28, '1996-10-01', 'Female', 'Volunteer', '1234567923', 'volunteer34@example.com', 'Address 34', 'password123', 'volunteer', NULL, NULL),
(55, 'Volunteer 35', 22, '2002-11-01', 'Other', 'Volunteer', '1234567924', 'volunteer35@example.com', 'Address 35', 'password123', 'volunteer', NULL, NULL),
(56, 'Volunteer 36', 26, '1998-12-01', 'Male', 'Volunteer', '1234567925', 'volunteer36@example.com', 'Address 36', 'password123', 'volunteer', NULL, NULL),
(57, 'Volunteer 37', 29, '1995-01-01', 'Female', 'Volunteer', '1234567926', 'volunteer37@example.com', 'Address 37', 'password123', 'volunteer', NULL, NULL),
(58, 'Volunteer 38', 24, '2000-02-01', 'Other', 'Volunteer', '1234567927', 'volunteer38@example.com', 'Address 38', 'password123', 'volunteer', NULL, NULL),
(59, 'Volunteer 39', 30, '1994-03-01', 'Male', 'Volunteer', '1234567928', 'volunteer39@example.com', 'Address 39', 'password123', 'volunteer', NULL, NULL),
(60, 'Volunteer 40', 25, '1999-04-01', 'Female', 'Volunteer', '1234567929', 'volunteer40@example.com', 'Address 40', 'password123', 'volunteer', NULL, NULL),
(61, 'Volunteer 41', 28, '1996-05-01', 'Other', 'Volunteer', '1234567930', 'volunteer41@example.com', 'Address 41', 'password123', 'volunteer', NULL, NULL),
(62, 'Volunteer 42', 22, '2002-06-01', 'Male', 'Volunteer', '1234567931', 'volunteer42@example.com', 'Address 42', 'password123', 'volunteer', NULL, NULL),
(63, 'Volunteer 43', 26, '1998-07-01', 'Female', 'Volunteer', '1234567932', 'volunteer43@example.com', 'Address 43', 'password123', 'volunteer', NULL, NULL),
(64, 'Volunteer 44', 29, '1995-08-01', 'Other', 'Volunteer', '1234567933', 'volunteer44@example.com', 'Address 44', 'password123', 'volunteer', NULL, NULL),
(65, 'Volunteer 45', 24, '2000-09-01', 'Male', 'Volunteer', '1234567934', 'volunteer45@example.com', 'Address 45', 'password123', 'volunteer', NULL, NULL),
(66, 'Volunteer 46', 30, '1994-10-01', 'Female', 'Volunteer', '1234567935', 'volunteer46@example.com', 'Address 46', 'password123', 'volunteer', NULL, NULL),
(67, 'Volunteer 47', 25, '1999-11-01', 'Other', 'Volunteer', '1234567936', 'volunteer47@example.com', 'Address 47', 'password123', 'volunteer', NULL, NULL),
(68, 'Volunteer 48', 28, '1996-12-01', 'Male', 'Volunteer', '1234567937', 'volunteer48@example.com', 'Address 48', 'password123', 'volunteer', NULL, NULL),
(69, 'Volunteer 49', 22, '2002-01-01', 'Female', 'Volunteer', '1234567938', 'volunteer49@example.com', 'Address 49', 'password123', 'volunteer', NULL, NULL),
(70, 'Volunteer 50', 26, '1998-02-01', 'Other', 'Volunteer', '1234567939', 'volunteer50@example.com', 'Address 50', 'password123', 'volunteer', NULL, NULL),
(71, 'Volunteer 51', 25, '1999-01-01', 'Male', 'Volunteer', '1234567940', 'volunteer51@example.com', 'Address 51', 'password123', 'volunteer', NULL, NULL),
(72, 'Volunteer 52', 28, '1996-02-01', 'Male', 'Volunteer', '1234567941', 'volunteer52@example.com', 'Address 52', 'password123', 'volunteer', NULL, NULL),
(73, 'Volunteer 53', 24, '2000-03-01', 'Male', 'Volunteer', '1234567942', 'volunteer53@example.com', 'Address 53', 'password123', 'volunteer', NULL, NULL),
(74, 'Volunteer 54', 29, '1995-04-01', 'Male', 'Volunteer', '1234567943', 'volunteer54@example.com', 'Address 54', 'password123', 'volunteer', NULL, NULL),
(75, 'Volunteer 55', 27, '1997-05-01', 'Male', 'Volunteer', '1234567944', 'volunteer55@example.com', 'Address 55', 'password123', 'volunteer', NULL, NULL),
(76, 'Volunteer 56', 30, '1994-06-01', 'Male', 'Volunteer', '1234567945', 'volunteer56@example.com', 'Address 56', 'password123', 'volunteer', NULL, NULL),
(77, 'Volunteer 57', 25, '1999-07-01', 'Male', 'Volunteer', '1234567946', 'volunteer57@example.com', 'Address 57', 'password123', 'volunteer', NULL, NULL),
(78, 'Volunteer 58', 26, '1998-08-01', 'Male', 'Volunteer', '1234567947', 'volunteer58@example.com', 'Address 58', 'password123', 'volunteer', NULL, NULL),
(79, 'Volunteer 59', 29, '1995-09-01', 'Male', 'Volunteer', '1234567948', 'volunteer59@example.com', 'Address 59', 'password123', 'volunteer', NULL, NULL),
(80, 'Volunteer 60', 24, '2000-10-01', 'Male', 'Volunteer', '1234567949', 'volunteer60@example.com', 'Address 60', 'password123', 'volunteer', NULL, NULL),
(81, 'Volunteer 61', 28, '1996-11-01', 'Male', 'Volunteer', '1234567950', 'volunteer61@example.com', 'Address 61', 'password123', 'volunteer', NULL, NULL),
(82, 'Volunteer 62', 30, '1994-12-01', 'Male', 'Volunteer', '1234567951', 'volunteer62@example.com', 'Address 62', 'password123', 'volunteer', NULL, NULL),
(83, 'Volunteer 63', 22, '2002-01-01', 'Male', 'Volunteer', '1234567952', 'volunteer63@example.com', 'Address 63', 'password123', 'volunteer', NULL, NULL),
(84, 'Volunteer 64', 26, '1998-02-01', 'Male', 'Volunteer', '1234567953', 'volunteer64@example.com', 'Address 64', 'password123', 'volunteer', NULL, NULL),
(85, 'Volunteer 65', 25, '1999-03-01', 'Male', 'Volunteer', '1234567954', 'volunteer65@example.com', 'Address 65', 'password123', 'volunteer', NULL, NULL),
(86, 'Volunteer 66', 27, '1997-04-01', 'Male', 'Volunteer', '1234567955', 'volunteer66@example.com', 'Address 66', 'password123', 'volunteer', NULL, NULL),
(87, 'Volunteer 67', 24, '2000-05-01', 'Male', 'Volunteer', '1234567956', 'volunteer67@example.com', 'Address 67', 'password123', 'volunteer', NULL, NULL),
(88, 'Volunteer 68', 28, '1996-06-01', 'Male', 'Volunteer', '1234567957', 'volunteer68@example.com', 'Address 68', 'password123', 'volunteer', NULL, NULL),
(89, 'Volunteer 69', 29, '1995-07-01', 'Male', 'Volunteer', '1234567958', 'volunteer69@example.com', 'Address 69', 'password123', 'volunteer', NULL, NULL),
(90, 'Volunteer 70', 30, '1994-08-01', 'Male', 'Volunteer', '1234567959', 'volunteer70@example.com', 'Address 70', 'password123', 'volunteer', NULL, NULL),
(91, 'Volunteer 71', 25, '1999-09-01', 'Male', 'Volunteer', '1234567960', 'volunteer71@example.com', 'Address 71', 'password123', 'volunteer', NULL, NULL),
(92, 'Volunteer 72', 27, '1997-10-01', 'Male', 'Volunteer', '1234567961', 'volunteer72@example.com', 'Address 72', 'password123', 'volunteer', NULL, NULL),
(93, 'Volunteer 73', 28, '1996-11-01', 'Male', 'Volunteer', '1234567962', 'volunteer73@example.com', 'Address 73', 'password123', 'volunteer', NULL, NULL),
(94, 'Volunteer 74', 22, '2002-12-01', 'Male', 'Volunteer', '1234567963', 'volunteer74@example.com', 'Address 74', 'password123', 'volunteer', NULL, NULL),
(95, 'Volunteer 75', 30, '1994-01-01', 'Male', 'Volunteer', '1234567964', 'volunteer75@example.com', 'Address 75', 'password123', 'volunteer', NULL, NULL),
(96, 'Volunteer 76', 26, '1998-02-01', 'Female', 'Volunteer', '1234567965', 'volunteer76@example.com', 'Address 76', 'password123', 'volunteer', NULL, NULL),
(97, 'Volunteer 77', 27, '1997-03-01', 'Female', 'Volunteer', '1234567966', 'volunteer77@example.com', 'Address 77', 'password123', 'volunteer', NULL, NULL),
(98, 'Volunteer 78', 29, '1995-04-01', 'Female', 'Volunteer', '1234567967', 'volunteer78@example.com', 'Address 78', 'password123', 'volunteer', NULL, NULL),
(99, 'Volunteer 79', 24, '2000-05-01', 'Female', 'Volunteer', '1234567968', 'volunteer79@example.com', 'Address 79', 'password123', 'volunteer', NULL, NULL),
(100, 'Volunteer 80', 28, '1996-06-01', 'Female', 'Volunteer', '1234567969', 'volunteer80@example.com', 'Address 80', 'password123', 'volunteer', NULL, NULL),
(101, 'Volunteer 81', 25, '1999-07-01', 'Female', 'Volunteer', '1234567970', 'volunteer81@example.com', 'Address 81', 'password123', 'volunteer', NULL, NULL),
(102, 'Volunteer 82', 30, '1994-08-01', 'Female', 'Volunteer', '1234567971', 'volunteer82@example.com', 'Address 82', 'password123', 'volunteer', NULL, NULL),
(103, 'Volunteer 83', 26, '1998-09-01', 'Female', 'Volunteer', '1234567972', 'volunteer83@example.com', 'Address 83', 'password123', 'volunteer', NULL, NULL),
(104, 'Volunteer 84', 29, '1995-10-01', 'Female', 'Volunteer', '1234567973', 'volunteer84@example.com', 'Address 84', 'password123', 'volunteer', NULL, NULL),
(105, 'Volunteer 85', 22, '2002-11-01', 'Female', 'Volunteer', '1234567974', 'volunteer85@example.com', 'Address 85', 'password123', 'volunteer', NULL, NULL),
(106, 'Volunteer 86', 27, '1997-12-01', 'Female', 'Volunteer', '1234567975', 'volunteer86@example.com', 'Address 86', 'password123', 'volunteer', NULL, NULL),
(107, 'Volunteer 87', 28, '1996-01-01', 'Female', 'Volunteer', '1234567976', 'volunteer87@example.com', 'Address 87', 'password123', 'volunteer', NULL, NULL),
(108, 'Volunteer 88', 24, '2000-02-01', 'Female', 'Volunteer', '1234567977', 'volunteer88@example.com', 'Address 88', 'password123', 'volunteer', NULL, NULL),
(109, 'Volunteer 89', 29, '1995-03-01', 'Female', 'Volunteer', '1234567978', 'volunteer89@example.com', 'Address 89', 'password123', 'volunteer', NULL, NULL),
(110, 'Volunteer 90', 25, '1999-04-01', 'Female', 'Volunteer', '1234567979', 'volunteer90@example.com', 'Address 90', 'password123', 'volunteer', NULL, NULL),
(111, 'Volunteer 91', 22, '2002-05-01', 'Other', 'Volunteer', '1234567980', 'volunteer91@example.com', 'Address 91', 'password123', 'volunteer', NULL, NULL),
(112, 'Volunteer 92', 28, '1996-06-01', 'Male', 'Volunteer', '1234567981', 'volunteer92@example.com', 'Address 92', 'password123', 'volunteer', NULL, NULL),
(113, 'Volunteer 93', 27, '1997-07-01', 'Male', 'Volunteer', '1234567982', 'volunteer93@example.com', 'Address 93', 'password123', 'volunteer', NULL, NULL),
(114, 'Volunteer 94', 26, '1998-08-01', 'Male', 'Volunteer', '1234567983', 'volunteer94@example.com', 'Address 94', 'password123', 'volunteer', NULL, NULL),
(115, 'Volunteer 95', 25, '1999-09-01', 'Male', 'Volunteer', '1234567984', 'volunteer95@example.com', 'Address 95', 'password123', 'volunteer', NULL, NULL),
(116, 'Volunteer 96', 29, '1995-10-01', 'Male', 'Volunteer', '1234567985', 'volunteer96@example.com', 'Address 96', 'password123', 'volunteer', NULL, NULL),
(117, 'Volunteer 97', 30, '1994-11-01', 'Male', 'Volunteer', '1234567986', 'volunteer97@example.com', 'Address 97', 'password123', 'volunteer', NULL, NULL),
(118, 'Volunteer 98', 22, '2002-12-01', 'Male', 'Volunteer', '1234567987', 'volunteer98@example.com', 'Address 98', 'password123', 'volunteer', NULL, NULL),
(119, 'Volunteer 99', 24, '2000-01-01', 'Male', 'Volunteer', '1234567988', 'volunteer99@example.com', 'Address 99', 'password123', 'volunteer', NULL, NULL),
(120, 'Volunteer 100', 25, '1999-02-01', 'Male', 'Volunteer', '1234567989', 'volunteer100@example.com', 'Address 100', 'password123', 'volunteer', NULL, NULL),
(121, '', 0, '1970-01-01', '', '', '', '', '', '', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `idx_ngo_id` (`ngo_id`);

--
-- Indexes for table `event_applications`
--
ALTER TABLE `event_applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `event_applications`
--
ALTER TABLE `event_applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`ngo_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_applications`
--
ALTER TABLE `event_applications`
  ADD CONSTRAINT `event_applications_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
