-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 07:34 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bozoksis`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicians`
--

CREATE TABLE `academicians` (
  `academician_id` int(11) NOT NULL,
  `academician_fullname` varchar(50) NOT NULL,
  `academician_username` varchar(50) NOT NULL,
  `academician_email` varchar(50) NOT NULL,
  `academician_password` varchar(50) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `academician_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academicians`
--

INSERT INTO `academicians` (`academician_id`, `academician_fullname`, `academician_username`, `academician_email`, `academician_password`, `faculty_id`, `department_id`, `academician_status`) VALUES
(0, 'Undefined Academician', 'undefined', 'undefined@bozok.edu.tr', 'dsafb7r73r7b3tr723rbt72b8b12by3', 0, 0, 2),
(2, 'Joan E. Glover', 'joan.glover', 'joan.glover@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 1, 4, 2),
(3, 'Virginia M. Lopez', 'virginia.lopez', 'virginia.lopez@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 1, 4, 2),
(4, 'Dorothy S. Hudson', 'dorothy.hudson', 'dorothy.hudson@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 4, 8, 2),
(5, 'Craig M. Hilliard', 'craig.hilliard', 'craig.hilliard@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 2, 11, 2),
(6, 'Anna C. Farrell', 'anna.farrell', 'anna.farrell@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 4, 8, 2),
(7, 'Mary D. Mitchell', 'mary.mitchell', 'mary.mitchell@yobu.edu.tr', '7c7acc7b44071e147e255cc697b32085', 6, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `academic_terms`
--

CREATE TABLE `academic_terms` (
  `academic_term_id` int(11) NOT NULL,
  `academic_term` varchar(50) NOT NULL,
  `academic_term_start_date` date NOT NULL,
  `academic_term_end_date` date NOT NULL,
  `academic_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_terms`
--

INSERT INTO `academic_terms` (`academic_term_id`, `academic_term`, `academic_term_start_date`, `academic_term_end_date`, `academic_year`) VALUES
(2, 'Michaelmas Term', '2019-12-09', '2019-12-26', 3),
(3, 'Spring Semester', '2020-02-04', '2020-06-28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `academic_year_id` int(11) NOT NULL,
  `academic_year` varchar(50) NOT NULL,
  `academic_year_start_date` date NOT NULL,
  `academic_year_end_date` date NOT NULL,
  `academic_year_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`academic_year_id`, `academic_year`, `academic_year_start_date`, `academic_year_end_date`, `academic_year_status`) VALUES
(3, '2019-2020', '2019-12-04', '2019-12-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_fullname` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_fullname`, `admin_email`, `admin_username`, `admin_password`, `admin_status`) VALUES
(1, 'Administrator', 'admin@bozok.edu.tr', 'admin', 'e9fd363bedc114628fe2cdce1493db15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_student` int(11) NOT NULL,
  `attendance_lesson` int(11) NOT NULL,
  `attendance_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `attendance_student`, `attendance_lesson`, `attendance_time`) VALUES
(3, 1, 4, 7),
(4, 2, 4, 2),
(5, 1, 3, 5),
(6, 2, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `course_selection_dates`
--

CREATE TABLE `course_selection_dates` (
  `course_selection_date_id` int(11) NOT NULL,
  `course_selection_start_date` date NOT NULL,
  `course_selection_end_date` date NOT NULL,
  `course_selection_date_status` tinyint(4) NOT NULL,
  `academic_term` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_selection_dates`
--

INSERT INTO `course_selection_dates` (`course_selection_date_id`, `course_selection_start_date`, `course_selection_end_date`, `course_selection_date_status`, `academic_term`) VALUES
(1, '2019-12-17', '2019-12-28', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(50) DEFAULT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `department_head` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_code`, `department_name`, `faculty_id`, `department_head`) VALUES
(0, '000', 'undefined department', 0, 0),
(1, '811', 'computer engineering', 1, 2),
(2, '111', 'mechanical engineering', 1, 0),
(4, '211', 'civil engineering', 1, 0),
(5, '611', 'electrical and electronics engineering', 1, 0),
(6, '111', 'radio television and cinema', 6, 0),
(7, '311', 'public relations and advertising', 6, 0),
(8, '211', 'journalism', 6, 0),
(9, '111', 'plant protection', 2, 0),
(10, '411', 'agricultural economy', 2, 0),
(11, '111', 'business administration', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `faculty_code` varchar(10) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `faculty_dean` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_code`, `faculty_name`, `faculty_dean`) VALUES
(0, '0000', 'undefined faculty ', 0),
(1, '1600', 'faculty of engineering and architecture', 0),
(2, '1680', 'faculty of agriculture', 0),
(3, '1620', 'faculty of economics and administrative sciences', 2),
(4, '1660', 'faculty of education', 0),
(5, '1610', 'faculty of art and science', 0),
(6, '1690', 'faculty of communication', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `grade_lesson` int(11) NOT NULL,
  `grade_student` int(11) NOT NULL,
  `grade_grader` int(11) NOT NULL,
  `midterm_grade` int(11) NOT NULL,
  `final_grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade_lesson`, `grade_student`, `grade_grader`, `midterm_grade`, `final_grade`) VALUES
(9, 4, 2, 5, 80, 78),
(10, 3, 2, 6, 22, 36),
(11, 4, 1, 5, 1, 1),
(12, 3, 1, 6, 100, 99);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` varchar(50) NOT NULL,
  `lesson_year` tinyint(4) NOT NULL,
  `lesson_term` int(11) NOT NULL,
  `lesson_credit` int(11) NOT NULL,
  `lesson_time` int(11) NOT NULL,
  `lesson_faculty` int(11) NOT NULL,
  `lesson_department` int(11) NOT NULL,
  `lesson_lecturer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_year`, `lesson_term`, `lesson_credit`, `lesson_time`, `lesson_faculty`, `lesson_department`, `lesson_lecturer`) VALUES
(1, 'Algorithms', 2, 2, 5, 4, 1, 1, 7),
(2, 'Software Engineering', 3, 2, 4, 6, 1, 1, 5),
(3, 'Data Structures', 2, 2, 3, 2, 1, 1, 6),
(4, 'Programming Language Concepts.', 2, 2, 4, 6, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `selected_lessons`
--

CREATE TABLE `selected_lessons` (
  `selected_lesson_id` int(11) NOT NULL,
  `selected_lesson_student` int(11) NOT NULL,
  `selected_lesson_term` int(11) NOT NULL,
  `selected_lessons` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `selected_lessons`
--

INSERT INTO `selected_lessons` (`selected_lesson_id`, `selected_lesson_student`, `selected_lesson_term`, `selected_lessons`) VALUES
(7, 1, 2, '1,3,4'),
(9, 2, 2, '1,3,4');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_fullname` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` varchar(50) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `student_year` int(11) DEFAULT NULL,
  `student_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_fullname`, `student_email`, `student_username`, `student_password`, `faculty_id`, `department_id`, `student_year`, `student_status`) VALUES
(1, 'Christopher P. Pettey', '16008118012@ogr.bozok.edu.tr', '16008118012', '67eb01c1b23b07f776f3dcd6d60cdfa1', 1, 1, 2, 2),
(2, 'Thomas S. Leonard', '16008118099@ogr.bozok.edu.tr', '16008118099', '67eb01c1b23b07f776f3dcd6d60cdfa1', 1, 1, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicians`
--
ALTER TABLE `academicians`
  ADD PRIMARY KEY (`academician_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `academic_terms`
--
ALTER TABLE `academic_terms`
  ADD PRIMARY KEY (`academic_term_id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`academic_year_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `attendance_student` (`attendance_student`),
  ADD KEY `attendance_lesson` (`attendance_lesson`);

--
-- Indexes for table `course_selection_dates`
--
ALTER TABLE `course_selection_dates`
  ADD PRIMARY KEY (`course_selection_date_id`),
  ADD KEY `academic_term` (`academic_term`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `department_head` (`department_head`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `faculties` (`faculty_dean`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `grade_lesson` (`grade_lesson`),
  ADD KEY `grade_student` (`grade_student`),
  ADD KEY `grade_grader` (`grade_grader`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `lesson_faculty` (`lesson_faculty`),
  ADD KEY `lesson_department` (`lesson_department`),
  ADD KEY `lesson_lecturer` (`lesson_lecturer`),
  ADD KEY `lesson_term` (`lesson_term`);

--
-- Indexes for table `selected_lessons`
--
ALTER TABLE `selected_lessons`
  ADD PRIMARY KEY (`selected_lesson_id`),
  ADD KEY `selected_lesson_student` (`selected_lesson_student`),
  ADD KEY `selected_lesson_term` (`selected_lesson_term`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicians`
--
ALTER TABLE `academicians`
  MODIFY `academician_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `academic_terms`
--
ALTER TABLE `academic_terms`
  MODIFY `academic_term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `academic_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_selection_dates`
--
ALTER TABLE `course_selection_dates`
  MODIFY `course_selection_date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `selected_lessons`
--
ALTER TABLE `selected_lessons`
  MODIFY `selected_lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academicians`
--
ALTER TABLE `academicians`
  ADD CONSTRAINT `academicians_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `academicians_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `academic_terms`
--
ALTER TABLE `academic_terms`
  ADD CONSTRAINT `academic_terms_ibfk_1` FOREIGN KEY (`academic_year`) REFERENCES `academic_years` (`academic_year_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`attendance_student`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`attendance_lesson`) REFERENCES `lessons` (`lesson_id`);

--
-- Constraints for table `course_selection_dates`
--
ALTER TABLE `course_selection_dates`
  ADD CONSTRAINT `course_selection_dates_ibfk_1` FOREIGN KEY (`academic_term`) REFERENCES `academic_terms` (`academic_term_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`department_head`) REFERENCES `academicians` (`academician_id`);

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties` FOREIGN KEY (`faculty_dean`) REFERENCES `academicians` (`academician_id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`grade_lesson`) REFERENCES `lessons` (`lesson_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`grade_student`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`grade_student`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`grade_grader`) REFERENCES `academicians` (`academician_id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`lesson_faculty`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`lesson_department`) REFERENCES `departments` (`department_id`),
  ADD CONSTRAINT `lessons_ibfk_3` FOREIGN KEY (`lesson_lecturer`) REFERENCES `academicians` (`academician_id`),
  ADD CONSTRAINT `lessons_ibfk_4` FOREIGN KEY (`lesson_term`) REFERENCES `academic_terms` (`academic_term_id`);

--
-- Constraints for table `selected_lessons`
--
ALTER TABLE `selected_lessons`
  ADD CONSTRAINT `selected_lessons_ibfk_1` FOREIGN KEY (`selected_lesson_student`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `selected_lessons_ibfk_2` FOREIGN KEY (`selected_lesson_term`) REFERENCES `academic_terms` (`academic_term_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
