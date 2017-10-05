-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 04:41 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buaro`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `barangay`, `municipality`, `province`) VALUES
(1, 'B0', 'M0', 'P0'),
(2, 'B1', 'M1', 'P1'),
(3, 'B2', 'M2', 'P2'),
(4, 'B3', 'M3', 'P3'),
(5, 'B4', 'M4', 'P4');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_type` int(11) NOT NULL,
  `address` int(11) DEFAULT NULL,
  `college` int(11) DEFAULT NULL,
  `first_name` char(255) NOT NULL,
  `middle_name` char(255) NOT NULL,
  `last_name` char(255) NOT NULL,
  `sex` tinyint(1) NOT NULL COMMENT '0 if male, 1 if female',
  `contact_no` varchar(20) DEFAULT NULL,
  `bdate` date NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `profile_img` varchar(500) DEFAULT NULL,
  `cover_photo` varchar(500) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 if active, 0 if inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_type`, `address`, `college`, `first_name`, `middle_name`, `last_name`, `sex`, `contact_no`, `bdate`, `email`, `username`, `password`, `profile_img`, `cover_photo`, `state`) VALUES
(1, 1, 1, NULL, 'Fname0', 'Mname0', 'Lname0', 0, '09772044506', '1998-12-30', '0@example.com', 'user0', '754ea1d0fb21a2ba706619100e60061c', NULL, NULL, 1),
(12, 2, 2, 3, 'Fname1', 'Mnme1', 'Lname1', 0, NULL, '2017-09-04', NULL, 'user1', '87f5e873e4cc3ebaed6f289303417020', NULL, NULL, 1),
(13, 2, 3, 7, 'Fname2', 'Mname2', 'Lname2', 0, NULL, '2017-09-25', '2@example.com', 'user2', '222222222', NULL, NULL, 1),
(14, 2, 4, 2, 'Fname3', 'Mname3', 'Lname3', 1, '098765443210', '2017-08-16', NULL, 'user3', '1d7579089c1d958b219b0e3450472477', NULL, NULL, 1),
(15, 2, 5, 7, 'Fname4', 'Mname4', 'Lname4', 1, '0987657862', '2017-09-04', NULL, 'user4', 'aeb5f991b117b589b2c5d664982a80ca', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_type`
--

CREATE TABLE `admin_type` (
  `admin_type_id` int(11) NOT NULL,
  `label` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_type`
--

INSERT INTO `admin_type` (`admin_type_id`, `label`) VALUES
(2, 'COLLEGE_ADMIN'),
(1, 'PARENT_ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(11) NOT NULL,
  `label` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `label`) VALUES
(1, 'College of Arts and Letters'),
(2, 'College of Business Economic and Management'),
(3, 'College of Education'),
(4, 'College of Engineering'),
(5, 'College of Industrial Technology'),
(6, 'College of Nursing'),
(7, 'College of Science'),
(8, 'College of Social Science and Philosophy'),
(9, 'Institute of Architecture'),
(10, 'Institute of Physical Education Sports and Recreation');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `nick` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `mem_id`, `content`, `nick`, `timestamp`) VALUES
(1, 13, 'Data', 'Franco', '2017-09-22 07:44:42'),
(2, 13, 'Gusto Mo bang kumita? Contact 098273526321', 'Aim Global', '2017-10-05 01:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `college_id`, `label`) VALUES
(1, 1, 'AB English'),
(2, 7, 'BSCS'),
(3, 9, 'Architecture'),
(4, 7, 'BSIT'),
(5, 3, 'BS Math'),
(6, 1, 'Mass Communication'),
(7, 10, 'PE');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedemail` varchar(255) DEFAULT NULL,
  `feedmessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedemail`, `feedmessage`) VALUES
(1, 'email@email.com', 'hope this works'),
(2, 'tryemail@yahoo.com', 'Write something one more time...'),
(61, NULL, 'AAA'),
(62, NULL, 'AAA'),
(63, NULL, 'AAA'),
(64, NULL, 'AAA'),
(65, NULL, 'AAA'),
(66, NULL, 'AAA'),
(67, NULL, 'AAA'),
(68, NULL, 'AAA'),
(69, NULL, 'AAA'),
(70, NULL, 'AAA'),
(71, NULL, 'Sample feedback'),
(72, NULL, 'Sample feedback'),
(73, NULL, 'Sample feedback'),
(74, NULL, 'Sample feedback'),
(75, NULL, 'Sample feedback'),
(76, NULL, 'Sample feedback'),
(77, NULL, 'Sample feedback'),
(78, NULL, 'Sample feedback'),
(79, NULL, 'Sample feedback'),
(80, NULL, 'Sample feedback'),
(81, NULL, 'Sample feedback'),
(82, NULL, 'Sample feedback'),
(83, NULL, 'Sample feedback'),
(84, NULL, 'Sample feedback'),
(85, NULL, 'Sample feedback'),
(86, NULL, 'Sample feedback'),
(87, NULL, 'Sample feedback'),
(88, NULL, 'Sample feedback'),
(89, NULL, 'Sample feedback'),
(90, NULL, 'Sample feedback'),
(91, NULL, 'Sample feedback'),
(92, NULL, 'Sample feedback'),
(93, NULL, 'Sample feedback'),
(94, NULL, 'Sample feedback'),
(95, NULL, 'Sample feedback'),
(96, NULL, 'Sample feedback'),
(97, NULL, 'Sample feedback'),
(98, NULL, 'Sample feedback'),
(99, NULL, 'Sample feedback'),
(100, NULL, 'Sample feedback'),
(101, NULL, 'Sample feedback'),
(102, NULL, 'Sample feedback'),
(103, NULL, 'Sample feedback'),
(104, NULL, 'Sample feedback'),
(105, NULL, 'Sample feedback'),
(106, NULL, 'Sample feedback'),
(107, NULL, 'Sample feedback');

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `grad_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `grad_year` year(4) NOT NULL,
  `grad_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduates`
--

INSERT INTO `graduates` (`grad_id`, `course_id`, `grad_year`, `grad_num`) VALUES
(1, 1, 2017, 231),
(2, 3, 2014, 190),
(3, 2, 2017, 230),
(4, 4, 2017, 321),
(5, 4, 2017, 150);

-- --------------------------------------------------------

--
-- Table structure for table `memorabilia`
--

CREATE TABLE `memorabilia` (
  `mem_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `label` char(255) NOT NULL,
  `description` text,
  `img_path` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `memorabilia`
--

INSERT INTO `memorabilia` (`mem_id`, `admin_id`, `label`, `description`, `img_path`) VALUES
(13, 1, 'adff', 'adfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfasadfas', '../../data/e-shop/default-profile-cover-photo.jpg'),
(14, 1, 'kghhhjg', 'jgfhfh', '../../data/e-shop/default-profile-cover-photo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `post_type` int(11) NOT NULL,
  `imgbanner` varchar(500) DEFAULT NULL,
  `imglinks` varchar(1000) DEFAULT NULL,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'shown',
  `eventdate` date DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `unique_visitors` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `admin_id`, `post_type`, `imgbanner`, `imglinks`, `title`, `content`, `status`, `eventdate`, `view_count`, `unique_visitors`, `timestamp`) VALUES
(32, 1, 2, '../../data/events-stories/5001', '', '2017 Search for Most Outstanding Bicol University Alumni', 'Bicol University, through the Alumni Relations Office, aims to recognize the meritorious achievements and contributions of alumni to the society as an outgrowth of their professional training in Bicol University. In this connection, may we invite nominations for the 2017 Search for Outstanding BU ALUMNI and Most Distinguished Alumni in the following areas:\r&lt;br/&gt;a. Good governance and public service;\r&lt;br/&gt;b.  Engineering and allied fields;\r&lt;br/&gt;c. Food and Industrial Technology;\r&lt;br/&gt;d.  Information and Communication Technology;\r&lt;br/&gt;e.  Media Communication;\r&lt;br/&gt;f. Culture Arts;\r&lt;br/&gt;g.  Medical and Public Health Promotion and Services;\r&lt;br/&gt;h.  Education;\r&lt;br/&gt;i. Sports and Development;\r&lt;br/&gt;j.  Accountancy and Financial Services;\r&lt;br/&gt;k.  Social Work;\r&lt;br/&gt;l. Agriculture, Forestry and Fisheries;\r&lt;br/&gt;m. Peace and Social Cohesion; and\r&lt;br/&gt;n. Entrepreneurship, Business and Employment Creation.\r&lt;br/&gt;Please submit nominations of your best batch mates or any BU graduate whose accomplishments may serve as an inspiration to others.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;Here is the Nomination Form and Guidelines .\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;For further inquiries, you may email us at bualumnirelations@bicol-u.edu.ph.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;Thank you.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '2016-03-09', 0, 0, '2017-09-25 04:00:52'),
(33, 1, 2, '../../data/events-stories/19171', '', 'BU Polangui Campus Alumni Association', 'Congratulations to the new set of officers of the Bicol University Polangui Campus Alumni Association. Re-organizational meeting was held last August 19, 2017 at the BUPC Dormtel\r&lt;br/&gt;\r&lt;br/&gt;  President:  Jey Vera\r&lt;br/&gt; Vice-President: Marivie Posoga\r&lt;br/&gt; Secretary:  Aiza Ocbian\r&lt;br/&gt;  Treasurer:  Arman Olivas\r&lt;br/&gt; Auditor:  Jay Ann Panday\r&lt;br/&gt; PIO:  Mary June Ombao\r&lt;br/&gt;  Business Managers:  â€¢  Daniel Ilarde\r&lt;br/&gt;â€¢  Mark Anthony Castro\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;Batch Coordinators: ( we are still looking for volunteers to serve as coordinators in the following batches)\r&lt;br/&gt;\r&lt;br/&gt;  Batch 2001: Jey Vera\r&lt;br/&gt; Batch 2002: Marivie Posoga\r&lt;br/&gt; Batch 2003: Aiza Ocbian\r&lt;br/&gt;  Batch 2004: Arman Olivas\r&lt;br/&gt; Batch 2005: Jay Ann Panday\r&lt;br/&gt; Batch 2006: Mary June Ombao\r&lt;br/&gt;  Batch 2007: \r&lt;br/&gt; Batch 2008: \r&lt;br/&gt; Batch 2009: \r&lt;br/&gt; Batch 2010: \r&lt;br/&gt; Batch 2011: \r&lt;br/&gt; Batch 2012: Ralph Marlo\r&lt;br/&gt;  Batch 2013: \r&lt;br/&gt; Batch 2014: Albert Corbilla\r&lt;br/&gt;  Batch 2015: Daniel Ilarde\r&lt;br/&gt;  Batch 2016: Julius Bolano\r&lt;br/&gt;  Batch 2017: Teejay Mora\r&lt;br/&gt;BUPC Alumni Coordinator:  Marimel S. Narvaez, RN, MAN\r&lt;br/&gt;', 'shown', '2017-08-19', 0, 0, '2017-09-25 04:02:09'),
(34, 1, 2, '', '', 'First ANS-BTC-BUCE Grand Alumni Homecoming held', 'HAPPINESS IN THE SERVICE: The former deans of BUCE Dr. Nelia S. Ciocson, Dr. Violeta M. Diaz, Dr. Faith M. Bachiller, Dr. Helen M. Llenaresas, Dr. Obdulla Rojas and current dean Dr. Lorna M. MiÃƒÂ±a were given a simple token of gratitude during the First Grand Alumni Homecoming last December 28, 2016.\r&lt;br/&gt;\r&lt;br/&gt;The first grand alumni homecoming of Albay Normal School (ANS), Bicol TeachersÃ¢â‚¬â„¢ College (BTC) and Bicol University College of Education (BUCE) was held last December 28, 2016 at the BUCE ILS Elementary Quadrangle. Despite the aftermath of Typhoon Nina on December 25 the steering committee deemed it necessary to push through activity as all arrangements have already been made and finalized.\r&lt;br/&gt;\r&lt;br/&gt;The newly elected officials of the BUCE Alumni Association, Inc. are sworn into office by VPAA Dr. Helen M. Llenaresas.\r&lt;br/&gt;\r&lt;br/&gt;Participated in by less than a hundred alumni of ANS, BTC and BUCE, the homecoming was started with a holy mass at 9:00 AM followed by the opening program hosted by Alona Lleno-NuÃƒÂ±ez, an alumna of BUCE now based in Maryland, USA. Dr. Arnulfo MascariÃƒÂ±as, SUC President IV of Bicol University,Dr. Helen M. Llenaresas, Vice President for Academic Affairs and Engineer Joseph Esplana, BU Alumni Regent gave their messages. In recognition of their dedicated service to the institution, former deans of BUCE, Dr. Nelia S. Ciocson, Dr. Violeta M. Diaz, Dr. Faith M. Bachiller,Dr. Helen M. Llenaresas, Dr. Obdulla Rojas and current dean Dr. Lorna M. MiÃƒÂ±a were given a simple token of gratitude.\r&lt;br/&gt;\r&lt;br/&gt;WHATÃ¢â‚¬â„¢S IN THE BAG? Participants joined the games facilitated by Prof. Alan Lucilo of the BUCEILS Elementary Dept.\r&lt;br/&gt;\r&lt;br/&gt;Elected and sworn into office were the new set of officers of the BUCE Alumni Association (BUCEAA), Inc. The elected officers are: Maritess Callope-Orellana, President; Marcia Corazon PenetranteÃ¢â‚¬â€œRico, Vice President; Ma. Teresa Moralde-Abainza, Secretary; Renelyn Ebio-Bautista, Treasurer; Imelda I. Daet, Auditor; Espedito Lobetania and Janet Alibin, Business Managers and Angela E. Lorenzana, PIO. As of the latest, the BUCEAA, Inc. officers plan to have the second grand alumni homecoming on April 17, 2017.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '2016-12-28', 0, 0, '2017-09-25 04:03:07'),
(35, 1, 2, '', '../../data/events-stories/8376817-09-25/130283808547thBU.jpg;../../data/events-stories/8376817-09-25/94006932647thBU1.jpg;../../data/events-stories/8376817-09-25/184672651547thBU2.jpg;../../data/events-stories/8376817-09-25/101195248247thBU3.jpg;../../data/events-stories/8376817-09-25/130919109747thBU4.jpg;../../data/events-stories/8376817-09-25/127113184947thBU5.jpg;../../data/events-stories/8376817-09-25/46576990947thBU6.jpg', '47th BU Charter Day Celebration', '', 'shown', '2016-06-21', 0, 0, '2017-09-25 04:03:50'),
(36, 1, 2, '', '../../data/events-stories/8219917-09-25/1176777853AlumniDay.jpg;../../data/events-stories/8219917-09-25/903186561AlumniDay1.jpg;../../data/events-stories/8219917-09-25/1531017105AlumniDay2.jpg;../../data/events-stories/8219917-09-25/301650429AlumniDay3.jpg', 'Alumni Day', '', 'shown', '2015-09-19', 0, 0, '2017-09-25 04:05:10'),
(37, 1, 2, '', '../../data/events-stories/2752317-09-25/828421020Exemplar.jpg;../../data/events-stories/2752317-09-25/97883446Exemplar1.jpg;../../data/events-stories/2752317-09-25/1757725521Exemplar2.jpg;../../data/events-stories/2752317-09-25/978716817Exemplar3.jpg', 'Exemplar Awards', '', 'shown', '2016-12-20', 0, 0, '2017-09-25 04:06:09'),
(38, 1, 2, '', '../../data/events-stories/4539717-09-25/937598710valentin6.jpg;../../data/events-stories/4539717-09-25/432946013valentine.jpg;../../data/events-stories/4539717-09-25/1656077326valentine1.jpg;../../data/events-stories/4539717-09-25/1464369302valentine2.jpg;../../data/events-stories/4539717-09-25/1861609034valentine3.jpg;../../data/events-stories/4539717-09-25/1037893949valentine4.jpg;../../data/events-stories/4539717-09-25/1697254257valentine5.jpg;../../data/events-stories/4539717-09-25/1254249307valentine7.jpg', 'Valentine Date with the Alumni', '', 'shown', '2016-02-14', 0, 0, '2017-09-25 04:07:12'),
(39, 1, 2, '', '', 'Search for Most Outstanding Alumni', 'Search for Most Outstanding Alumni\r&lt;br/&gt;Most Outstanding Alumni\r&lt;br/&gt;DR. RAUL G. BRADECINA\r&lt;br/&gt;Most Distinguished Alumni in PEACE and Social Cohesion\r&lt;br/&gt;BGEN ALEXIS D. TAMONDONG, AFP (Ret)\r&lt;br/&gt;Most Distinguished Alumni in Agriculture, Forestry &amp; Fisheries\r&lt;br/&gt;DR. RAUL G. BRADECINA\r&lt;br/&gt;Most Distinguished Alumni in Culture &amp; Arts\r&lt;br/&gt;DR. ZEUS A. SALAZAR\r&lt;br/&gt;Most Distinguished Alumni in Management &amp; Human Resource Development\r&lt;br/&gt;DR. DIOSDADO M. SAN ANTONIO\r&lt;br/&gt;Most Distinguished Alumni in Education\r&lt;br/&gt;PROF. NELLY M. WADSWORTH\r&lt;br/&gt;Most Distinguished Alumni in Good Governance &amp; Public Service\r&lt;br/&gt;CONG. ALFREDO A. GARBIN JR.\r&lt;br/&gt;Most Distinguished Alumni in Media Communication\r&lt;br/&gt;Mr. GLENN J. BARCELON\r&lt;br/&gt;Most Distinguished Alumni in Corporate Social Responsibility\r&lt;br/&gt;Ms. MARIA VENUS B. RAJ\r&lt;br/&gt;Most Distinguished Alumni in Entrepreneurship, Business &amp; Employment Creation\r&lt;br/&gt;CONG. CHRISTOPHER S. CO\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '2016-03-21', 0, 0, '2017-09-25 04:08:02'),
(40, 1, 1, '', '../../data/events-stories/6341017-09-25/1646783105BUCE.jpg;../../data/events-stories/6341017-09-25/1836726403BUCE1.jpg;../../data/events-stories/6341017-09-25/705007876BUCE2.jpg;../../data/events-stories/6341017-09-25/1162718873BUCE3.jpg', 'Two Alumni Reconnect with BUCE', '<p>July 26, 2017, two BUCE graduates returned and shared with teachers and students their experiences in teaching in a foreign land. Rosario E. Leuterio, based in California teaches at International Studies Learning Center a school which belongs to Los Angeles Unified School District, the second largest school district in the United States. Ms. Leuterio, a Math Major, belongs to batch 1988 and served as the Editor-in-Chief of The Mentor for two years. She met with the Science and Math majors who were having a club activity at the BUCE Training Hall 1. She gamely answered questions regarding her feats as a Filipina Math Teacher in the US particularly that of classroom management. She gave out souvenir items for those who asked questions and some books to those who professed love for reading.\r\n<br/>\r\n<br/>On the other hand, Ferdie A. Sevilla, Quality and Development Manager for International Preschools, met with the English and Preschool Majors. Mr. Sevilla lives in Sweden but is a native of Imalnod, Legazpi City. He graduated from BUCE in 1998 as an English Major. Prior to moving to Sweden for his Masters of Comparative and International Education, he taught in Thailand as an elementary school teacher for two years. He is in the country for a project named Global Citizenship, a partnership of his organization with the Department of Education, Legazpi City Division. The recipient of their community reach out program is the Banquerohan Elementary School in Legazpi City.\r\n<br/>\r\n<br/>The students asked so many questions that they had to be reminded of Mr. Sevillaâ€™s scheduled meeting with the BUCE teachers. Mr. Sevilla readily recounted some of his achievements and involvements that sparked the interest of the teachers. Hence, they asked Mr. Sevilla of the possibility of a research collaboration with his organization to which he positively replied. As the Quality and Development Manager of Futuraskolan International Schools, he manages nineteen (19) schools in the Stockholm region.\r\n<br/>Both meetings were capped with a photo session of the participants with Mr. Sevilla.\r\n<br/>\r\n<br/>Ms. Rosario E. Leuterio explains how she manages her students who are unruly in her class. She tells the students that in terms of abilities and capabilities, students in the Philippines are at par with students in the US.\r\n<br/>\r\n<br/>Ferdie A. Sevilla poses with the BUCE teachers after a meeting with them.\r\n<br/></p>', 'shown', '2017-06-26', 0, 0, '2017-09-25 04:10:17'),
(41, 1, 1, '../../data/events-stories/14356', '', 'DR.ZEUS SALAZAR', 'Dr. Zeus Salazar has always been a man in the move.\r&lt;br/&gt;Born to Atty. Irineo Salazar of Tiwi, Albay and Mrs. Luz Atayza of Pilar, Sorsogon, Salazar was born in Tiwi, Albay on April 29, 1938 but grew up in Malilipot, Albay where his father served as Judge. His fatherâ€™s postings brought him to Manila and Europe.\r&lt;br/&gt;Dr. Zeus A. Salazar would get his grade school education from San Beda- Mendiola where he is considered one of its notable alumni. Together with his six (6) younger siblings â€“ Cesar, Nora, Ruby, Oscar, Lulu Fe, and Maria Luz â€“ and his parents, he would find himself back in Bicol.\r&lt;br/&gt;He would get his secondary diploma from Albay High School in 1951. At Albay High School, he shone as editor of the school paper. Perhaps not surprising since he lived in Sagpon which the late Bienvenido N. Santos described as a BARRIO OF WRITERS. In the essay, Santos wrote:\r&lt;br/&gt;\r&lt;br/&gt;Then there is Zeus Salazar who graduated from the UP summa cum laude. There is the littlehouse where he lived. That is his father waiting for a bus for Sorsogon, showing Sagpon folks the latest letter from Sorbonne, where his son is a UP scholar.\r&lt;br/&gt;Perhaps it was from Santos who lived across the street that Salazar learned to love chess.\r&lt;br/&gt;Zeus A. Salazar began his career as a historian in the University of the Philippines, where he completed a degree in AB history in 1955. He was the first to receive SUMMA CUM LAUDE award from UPâ€™s Department of History.\r&lt;br/&gt;This achievement earned Salazar a scholarship to a Paris university. In 1958 he commenced graduate studies in France, obtaining various diplomas in ethnology, anthropology, and linguistics. His studies culminated in a doctorate in cultural anthropology in 1968 from the prestigious Sarbonne UniversitÃ© de Paris a â€œTrÃ¨s Bienâ€ stamped on his dissertation.\r&lt;br/&gt;Upon returning to the Phiippines later that year, he rejoined the UP History Department. Where he has taught until his retirement. He came home with wife Marlies Spieker with whom he has three children: Irineo, Wigan and Ligaya.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:11:52'),
(44, 1, 1, '../../data/events-stories/25334', '', 'Dr. RAUL G. BRADECINA', 'The Most Outstanding BU Alumni in the 2016 search was Dr. RAUL G. BRADECINA. He was also recipient of the Most Distinguished Award in AGRICULTURE, FORESTRY AND FISHERIES.\r&lt;br/&gt;Dr. Bradecina is a University Professor and the incumbent President of Partido State University in Camarines Sur. He is a loyal alumnus of BU Tabaco Campus having attended high school, college and graduate course in the BU College of Fisheries from 1982 until 2009.\r&lt;br/&gt;\r&lt;br/&gt;Dr Bradecina is a scholar, a scientist, a research and extension manager, an academic institution administrator, a resource and environment economist expert, an outstanding teacher and researcher, a development and institutional planner, and an advocate for poverty alleviation of marginalized fishing and upland communities through grassroots participation in resource governance, biodiversity conservation, sustainable ecotourism and coastal resource management. He is also a poet, a technical writer and book author and a scientific journal editor and reviewer of technical papers of varied fields. His research interests ranges from marine ecotoxicology, oceanography, aquaculture, limnology, crustacean taxonomy and ecology, biodiversity conservation, coastal resource and fisheries management, ecotourism, behavioral economics, resource and environmental economics, climate change adaptation in coastal communities, resettlement, biodiversity conservation and management, marine protected areas, contingent valuation of coastal ecosystem services, ex-ante and ex-post impact evaluation of R&amp;D programs, project evaluation, and institutional and tourism planning.\r&lt;br/&gt;\r&lt;br/&gt;As a scholar, he was a consistent honor student graduating class valedictorian from BUTC high school and awarded various academic merit and scholarship awards in college and in graduate studies. He was awarded academic merit award as college scholar by UP Visayas as a graduate student in Master of Science in Ocean Science. He was awarded the prestigious and highly competitive DOST-JSPS PhD Dissertation Fellowship at Kochi University, Japan to pursue a PhD course in resource and environmental economics. He finished two masterÃ¢â‚¬â„¢s degree (MS Ocean Science and Master in Public Administration) and completed full time academic units for a graduate course in Fisheries Technology at BU Graduate School.\r&lt;br/&gt;\r&lt;br/&gt;As a scientist, he was awarded the most coveted 2014 Dr Elvira Tan Outstanding Publications in Fisheries Research (1st Best Published Paper, Marine Fisheries) by DOST-PCARRD. He won and was awarded competitive research projects and funds by reputable research organizations to pursue researches which include: economic analysis of mussel industry S&amp;T industry strategic plan in the Philippines by the DOST-PCAARRD; economic valuation of beachscapes in Caramoan by economy and Environment program for Southeast Asia; Freshwater shrimp diversity assessment by CHED; economics of climate change adaptation strategy in coastal communities by Worldfish-CGIAR; relocation of non-tenured migrants outside protected area by CARE-UNDP; biodiversity threat reduction assessment by CARE-UNDP; tourism planning for sustainable development and inclusive growth by Partido Development Administration. He worked and collaborated with top researchers in international (Kochi, Japan), national (UPLB and UPV) and local (Bicol University, BFAR) research institutions. He gave his services, expertise and profound thoughts as advocate of research productivity and capacity development in research to various SUCs and HEIs in the region. He has presented various research papers in international, national and regional research conferences and symposia and awarded best papers. He has also published/co-published several research articles in national and international refereed journals.\r&lt;br/&gt;\r&lt;br/&gt;As a research and extension manager, he steered the research directions of Partido State University in the last 8 years as Research Director and Vice President for Research and Extension. He was responsible for the establishment of the Coastal and Wetland Resources Center for Research and Management, a BOR approved research center in PSU. He was responsible in having PSU a CHED-accredited refereed research journal. He forged enter-institutional research collaboration with various organizations such as UP Visayas, Worldfish, PCARRD, Bicol University, DA-BAR, DOST and conducted capacity development in RDE for faculty members.\r&lt;br/&gt;As an academic institution administrator, he was chosen as the 3rd President of Partido State University and pursues massive capacity development, improvement of academic-related infrastructure, initiation and establishment of research centers, enhancement of discipline-specific faculty profile via vertical articulation, upgrading of curriculum and innovations to improve studentsÃ¢â‚¬â„¢ performance in board examinations, networking with research and extension institutions.\r&lt;br/&gt;\r&lt;br/&gt;As a resource and environment economist expert, he was given recognition as expert in fisheries economics research by DOST-PCARRD. His services was recognized and sought by various organizations as consultant and project leader, as trainer-lecturer and as technical reviewer of technical papers and manuscripts in research fora and as plenary speaker in scientific symposia. These include his stints as trainer in regional TOT in ex-ante and ex-post impact evaluation of natural and aquatic resources research projects by BCARRD; as senior economist of a climate change in coastal communities study funded by Worldfish-DA BAR; as project leader of tourism master plan commissioned by Partido Development Administration and LGUs of Partido District; as panelist-reviewer in economics and resource governance researches of Bicol SUCs and research consortia research reviews and the BFAR-NFRDI project reviews; as plenary speaker in national scientific conference in fisheries by BFAR and NFRDI among others. As an outstanding teacher and researcher, he was adjudged 1997 Metro Bank Outstanding Teachers of the Philippines in Tech-Voc category as semi-finalist among the ten top nominees selected from a pool of 360 national nominees. He was also awarded Outstanding University Faculty member of Partido State University in 2006 and as Outstanding University researcher of the same institution in 2012 because of his commitment, strong advocacy and exemplary performance in pursuit of instructional competitiveness and research productivity in the academe.\r&lt;br/&gt;\r&lt;br/&gt;As a development and institutional planner, he conceptualized and authored the Partido Tourism Master Plan a research-based tourism blue print for the 10 LGUs of Partido District which adopted a multi-stakeholder tourism planning process, concept of poverty-reduction oriented tourism paradigm focusing on sustainable livelihood and rural enterprise, environmental protection through coastal resource management, sustainable financing through payment for environmental services -user fee scheme, participatory resource governance and economic valuation as input for project worth analysis. He also led the crafting of the 10 year comprehensive development plan of Partido State University. Both studies lasted one year in completion. He also gave his services to LGUs as technical expert in CRM planning and social development projects packaging.\r&lt;br/&gt;\r&lt;br/&gt;As an advocate for poverty alleviation of marginalized fishing and upland communities through grassroots participation in resource governance, biodiversity conservation, sustainable ecotourism and coastal resource management, he conceptualized and implemented for 4 consecutive years the PSU-Sangay LGU supported extension project in coastal resource management with focus on marine protected area as management tool. As project leader, he implemented integrated CRM interventions which include livelihood skills training, alternative livelihood promotion for fishers, participatory coastal resource management, academe-led participatory community CRM planning, law enforcement through strengthening and capacity development of Bantay Dagat members, generation of information to influence municipal ordinance that promote CRM; organization and institutionalization of Municipal CRM Board; marine conservation awareness Ã¢â‚¬â€œraising through IECs, cross visitations to successful MPAs among others. He has also worked as biodiversity threat reduction technical expert in Mt Isarog and generated information on the status biodiversity and conservation initiatives to influence policies and promote sustainable management of forest resources. He authored the design of a sustainable, socially, culturally and economically viable resettlement plan of non-tenured migrants in MT Isarog featuring respect for indigenous people, insights on the impact of economic dislocation, and reduction of anthropogenic pressur4es inside the protected area. He popularized key biodiversity and conservation information in the Mt Isarog area to educate stakeholders and strengthen their support for the integrated conservation development project (ICDP) in Mt Isarog.\r&lt;br/&gt;\r&lt;br/&gt;As a technical writer and book author and a scientific journal editor and reviewer of technical papers of varied fields, his works on economic valuation of Caramoan beachscapes has been published in Marine and Coastal ecosystem valuation and Policy in Southeast Asia published by Springer-EEPSEA Singapore; He has co-authored a chapter on the Necessity of Multilevel Governance for marine Protected Areas (MPAs): An Analysis from their Functions and the Cost of Commons with foreign social scientists appearing in the book, Rural and Urban Sustainability Governance published by United Nations University Press, Tokyo, The United Nations. He is the concurrent editor-in-chief of Bicol Science Journal, a CHED-accredited referred journal. His expertise was solicited by refereed scientific journals as reviewer such as the Ocean and Coastal Management Journal published by Elsevier. He authored a monograph on coastal valuation published by the Economy and Environment Program for Southeast Asia. Just this month, he freshly has released a technical coffee table book on the riverine ecosystems of Bicol Key Biodiversity Areas as sole author and funded by CHED-GIA. He also developed and published a manual on the species identification of freshwater shrimps for stock enhancement in riverine ecosystems of Bicol KBAs.\r&lt;br/&gt;\r&lt;br/&gt;Dr. RAUL G. BRADECINA, the total package of an outstanding Bicol University Alumni. We are so proud of you. You are an epitome of scholarship, leadership, character and service. May all the accomplishments you had contribute in the social, economic and environmental development of the Bicol Region, of the country and globally.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:19:40'),
(45, 1, 1, '../../data/events-stories/17973', NULL, 'Dr. DIOSDADO M. SAN ANTONIO', 'The most distinguished alumni in MANAGEMENT AND HUMAN RESOURCE DEVELOPMENT was Dr. DIOSDADO M. SAN ANTONIO, at present the Regional Director of DepEd Region IVA (CALABARZON). Dr. San Antonio graduated in the Bicol University Graduate School in 1994 with a degree in Master of Education where he was a recipient of the Local Scholarship Program of the Civil Service Commission. \r&lt;br/&gt;\r&lt;br/&gt;To be a recipient of a scholarship seems to become part of his life as a student. He, too, was a recipient of the International Postgraduate Research Scholarship and the University of Newcastle Research Scholarship in 2006 where he studied in the University of Newcastle, Australia finishing a Doctor of Philosophy in Education degree. He, too, finished a Diploma on Strategic Business Economics Program from July, 2014 to June 2015 at the University of Asia and the Pacific being a recipient of a scholarship from FIDEI.\r&lt;br/&gt;Dr. San Antonio was given various citations and awards by international, national and local institutions and organizations. He, too has attended several training programs and workshops within and outside the Philippines. More important to mention, though, are his initiatives and innovations which contributed much in change to education, without him, his work/service area may have been different from what it is now.\r&lt;br/&gt;\r&lt;br/&gt;As a Regional Director, Dr. San Antonio introduced his advocacy for a Transparent, Ethical and Accountable (TEA) governance in DepEd Region IVA (CALABARZON) by implementing SCOUTERS ROCK (a leadership/ management/ governance framework towards efficient, effective and corrupt-free public service) which focuses on:\r&lt;br/&gt;Strengthening the merit system\r&lt;br/&gt;Creating and nurturing partnership\r&lt;br/&gt;Opening communication channels\r&lt;br/&gt;Upholding the 8 norms of conduct for public servants\r&lt;br/&gt;Taking active part in instructional supervision\r&lt;br/&gt;Enabling every child to enjoy high quality basic education services\r&lt;br/&gt;Recognizing and scaling up best practices\r&lt;br/&gt;Sustaining push for higher levels of school-based management\r&lt;br/&gt;Rendering prompt, regular and accurate financial and other reports\r&lt;br/&gt;Optimizing ICT in education\r&lt;br/&gt;Conserving water, energy and other resources\r&lt;br/&gt;Keeping schools and offices safe and eco-friendly\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;Indeed, Dr. San Antonio contributed much in education not only during his term as a regional director but way before when he was a school principal, assistant schools division superintendent and assistant regional director. He was instrument in saving substantial amount of government funds by strictly implementing RA 9184 as BAC Chair in DepEd Region V (Bicol). He nurtured a strong merit system by implementing open ranking procedures, also in DepEd Bicol. He initiated/introduced Project HEARTS, Project SMILE, Project ASSET and a lot more.\r&lt;br/&gt;He has 72 google scholar citations as of 22 June 2016. This is because of his authorship of several modules, books and manuscripts. Dr. San Antonio must be a prolific writer. Aside from being a writer, he, too, is respected speaker. He is often invited as resource speaker, lecturer, keynote speaker and/or plenary speaker in several important events. He was able to present several papers in international, national and local research conferences.\r&lt;br/&gt;Dr. DIOSDADO M. SAN ANTONIO is a BU Alumnus, a leader bringing change for social transformation and development. Can you be like him? The challenge is on.\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:20:33'),
(46, 1, 1, '../../data/events-stories/2695', '', 'BGEN ALEXIS D. TAMONDONG AFP (Ret)', 'BGEN ALEXIS D TAMONDONG AFP (Ret) exemplifies the typical graduate of Secondary Trade School of Bicol University formerly known as BUSAT in 1975, With humble beginning, he started his military profession when he took the Summer Camp Training at Camp Capinpin, Tanay Rizal in the Summer of 1977. After spending two(2) years at BU College of Agriculture, he transferred to Metro Manila and shifted course to BS Agricultural Engineering at De La Salle Araneta University (DLSAU). As sophomore college student, he took the ROTC Advance Course at U.P. Diliman and was among the top graduate of his class under the Metropolitan Citizens Military Training Command (MCMTC). In the summer of 1980, he completed the MS43 or P2LT Course in preparation for commission in the AFP. He graduated from his academic course in October 1980 and subsequently passed the Board of Agricultural Engineering the following year. He worked briefly as Technical Staff Engineer in one of the multinational company in Metro Manila before he was called to military duty as an active officer in the Regular Force on 30 June 1982.\r&lt;br/&gt;\r&lt;br/&gt;BGEN TAMONDONG served as the 17th Commander of Army Reserve Command. His rise to the military hierarchy is more than just a story of struggle and sacrifices. His faith and strong determination to succeed made him overcome the seemingly insurmountable challenges to reach his dream. Throughout his military career, he was recognized for his professionalism, exemplary and dedication to duty which earned him more than 141 awards, plaques, certificates of appreciation, resolutions of appreciation, letters of commendations and recognition both from the military and civilian sector. An officer who aspired to cultivate a culture of excellence and performed to the best of his ability, he distinguished himself as one of The Outstanding Philippine Soldier (TOPS) 2011 awardee sponsored by Metrobank Foundation. The award was the most prestigious from the private sector conferred by no less than the President of the Republic on 26 August 2011 during a formal ceremony at Malacanang Palace. He was also the recipient of The Outstanding ROTC Alumni Award 2014 ( Active Military Officer Category) awarded by no less than the Chief of Staff AFP on March 15, 2014 during the celebration of Reservist Week. He also received the United Nation Service Medal and the International Force East Timor Medal conferred by the Australian government in recognition of his tour of duty in East Timor from 1999 to 2000. Guided by the notion of competence, professionalism and hard work, he received several plaques of appreciations, recognition and commendations from the private sector, local and national government agencies as well as several certificates of merits from service schools for academic excellence. Among the significant awards he received includes three (3) Distinguished Service Stars, the Gold Cross Medal, four (4) Gawad sa Kaunlaran (GSK) medals, three (3) Bronze Cross Medals, Silver Wing Medal, Wounded Personnel Medal, 25- Military Merit Medals, 15- Military Commendation Medals, five (5) Military Civic Action Medals, five (5) Disaster Response and Rehabilitation Ribbon, three (3) Presidential Unit Citation Badges, Combat Commander Kagitingan Badge, Sharpshooter badge for M16 and Cal.45, Luzon Campaign Medal, Visayas Campaign Medal and Mindanao-Sulo Campaign Medal. He was also conferred as the Best Company Commander and Best Battalion Commander during his command duties as field-grade officer. His awards from the private sector includes Plaque of Appreciations from the Provincial Governors of Negros Occidental, Negros Oriental, Basilan and Pangasinan and from the Mayors of Medelin, Cebu, Himamaylan, Negros Occidental, Kabankalan City, Negros Occidental, Talisay City, Tanjay City, Palapag, Northern Samar and Manaoag, Pangasinan. He was also awarded as one of the Outstanding Alumnus of Technological Institute of the \r&lt;br/&gt;Philippines during its 50th Foundation day on February 2012, Outstanding Alumnus at De La Salle Araneta University in 2011, Outstanding Graduate of Philippine Christian University in 2011 and recently as Outstanding Graduate of Bicol University given on 2016.\r&lt;br/&gt;\r&lt;br/&gt;His inclination for higher learning and education earned him several scholarships for post-graduate studies which include MasterÃ¢â‚¬â„¢s Degree in Public Administration (MPAD) from West Negros College (2005), Masters in Business Administration (MBA) from Philippine Christian University Manila (2006) and Masters in Social Science (Defense Studies) from Universiti Kebangsaan Malaysia (2008). Among the various career and specialized military trainings he completed includes courses taken from: Basic and Advance Engineer Courses at Tradoc, PA, CGSC Fort Bonifacio; U.S. Army Engineer School Fort Belvoir Virginia USA; U.S. Defense Mapping School Virginia USA; Canadian International Peacekeeping Centre, Nova Scotia Canada; Mobile International Defense Resource Management Course, Naval Post Graduate School Monterey, California; Crisis Management Center, Swedish Defence College; and Malaysian Armed Forces Defence College in Kuala Lumpur Malaysia. His quest for excellence allowed him to graduate with distinction in his military career and specialized courses where he consistently landed among the top student of his class.\r&lt;br/&gt;\r&lt;br/&gt;Despite the limited time in position as Commander of ARESCOM, he was able to accomplished gigantic tasks in terms of reserve force development as well as boosted the morale of his troops by constructing new training and recreation facilities at national headquarters of ARESCOM. He also effectively managed the pool of Army Reservists composed of three (3) Infantry Divisions with 24 Infantry Brigades increasing their number from 120,000 to 150,00 Ready Reserve in record time. His stint at ARESCOM marked the focus of the command towards helping build a credible reserve force as well as help respond to the communities affected by natural calamities to saved lives in times of peace. Under his leadership, he was able to mobilize in a very short notice more than 3,000 reservist and ROTC cadets combined to respond to the massive calamity in Central Visayas brought about by Typhoon Yolanda in November 2013. Despite some casualties from the pool of reservists and ROTC cadets deployed at Tacloban, for Humanitarian Assistance and Disaster Response (HADR) Operation, the concerted effort of Team Arescom under his leadership helped normalize the situation in the affected areas. This resulted in the retrieval of 200 decomposing bodies at Tacloban City and adjoining areas, Clearing the airport road along Bgy San Jose, Repacking of thousands of relief goods in Metro Manila and Central Visayas, Conduct of medical mission in Eastern Visayas, Northern Cebu and Western Visayas, Assisted in the handling and distribution of thousands of tons of relief goods from local and foreign relief agencies. The HADR conducted by ARESCOM benefitted tens of thousands calamity victims in three (3) Visayan regions.\r&lt;br/&gt;\r&lt;br/&gt;His command experience from tactical to strategic level covering the geographical areas of Luzon, Visayas and Mindanao honed his competencies in managing complex environment with security implications. He was a seasoned combat and engineer officer who spent most of his assignment in the field which exposed him to diversified leadership challenges and complex engineering works while engaging in community-based development projects. He started his military career as a Platoon Leader, Company Ex-o, Company Commander, Field Staff Officer and Battalion Commander to units assigned in the hinterlands of Bicol Region, Northern Samar, Bondoc Peninsula, Northern Luzon, Panay, Bohol, Negros Island, Basilan and Sulo. He was also selected to serve the pioneer batch of Filipino soldiers sent to East Timor as Logistic Officer of the contingent from 1999 to 2000. Prior to his assignment as Commander, ARESCOM, he was the Deputy Brigade Commander of 51st Engineer Brigade from December 2012 to September 2013 and Deputy Brigade Commander of 54th Engineer Brigade from April 2010 to November 2012. He also spent two years as Deputy Chief Engineer, AFP while serving as member of several working committees that brought about relevant policies and defense reforms in the AFP. Similarly he served as Group Commander and Directing Staff at AFP Command and General Staff College from 2005-06, Battalion Commander of Army Engineers in Western Visayas from 2002-05 and Battalion Commander of Composite Engineer Battalion under the AFP Task Force Basilan from 1994-96.\r&lt;br/&gt;\r&lt;br/&gt;His colorful military career ended after serving 34 years of dedicated service to the nation when he compulsory retired from the military service on his 56th birthday on February 12, 2015. He is a proud father of two daughters and one son from his loving wife, the former Misss Catherine Sabalza of Palapag, Northern Samar. At present, he keeps himself engaged in community outreach in his home town of Manito, Albay to help his town mates uplift their living condition.\r&lt;br/&gt;With these sterling accomplishments, he proved his mettle not only as a combatant commander but more so as a builder to win the peace and bring progress in the countryside. On a more personal note, BGEN ALEXIS D. TAMONDONG remained a very humble person we have known in high school, so kind and helpful to all the people in need. Indeed, you are one source of pride of Bicol University.\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:22:22'),
(47, 1, 1, '../../data/events-stories/20659', '', 'NELLY M. WADSWORTH', 'Committed to helping international and domestic students achieve their educational goals, NELLY MALATE WADSWORTH, graduated in  from the Bicol University College of Agriculture with a BS degree in Agriculture. While she pursued a Master in Business Administration at Divine Word College in Legazpi City, she finished her Master of Arts in Intercultural Relations with concentration in Foreign Student Advising at Lesley University in Cambridge, MA. She took an additional coursework in Cross Cultural Negotiation and Conflict Resolution, too.\r&lt;br/&gt;\r&lt;br/&gt;The road to success may not also be easy. It was a journey of hardwork and perseverance coupled with high intellectual abilities to become the Director of the International Education Center at Fitchburg State University in Fitchburg, MA, where she occupied the position since July 10, 2016 Ã¢â‚¬â€œ present. She is described as a highly creative program leader and groundbreaker with deep experience in the realm of international student and exchange programs, leveraging direct personal experience as an immigrant to compassionately assist international students to seamlessly make the transition to the United States. She is passionate about spreading awareness and conveying the importance of global cultures in the university setting and the benefits felt within the community.\r&lt;br/&gt;She has the key strength in the recruitment of international students and the management and expansion of programs. Talent for facilitating strategic partnerships with all stakeholders both in the United States and abroad to ensure students have the support, guidance, resources and advice needed for international students and domestic students participating in the study abroad and facultyÃ‚Â¬led programs.\r&lt;br/&gt;\r&lt;br/&gt;Before her work at Fitchburg, she was with SALEM STATE UNIVERSITY, Salem, MA from 1994 Ã¢â‚¬â€œ July 9, 2016. In Salem, she worked as Associate Director, International Student Programs (2013 Ã¢â‚¬â€œ Present) and Assistant Director, International Student Programs (2009 Ã¢â‚¬â€œ 2013) after being the Staff Associate/Assistant (1994 Ã¢â‚¬â€œ 2009).\r&lt;br/&gt;At Salem State University, she is to deliver strategic vision of the International Program to broaden cultural diversity and lead international education exchange initiatives to provide services, guidance, and resources needed to aid in the transition to the United States and Salem State University. Moreover, she is to drive extensive global recruitment strategies to increase the number of international students at the university and elevate the universityÃ¢â‚¬â„¢s profile worldÃ‚-wide through connections to alumni abroad. She evaluated foreign credentials, direct a team of five (interns, administrative assistant, graduate assistant); and previously administered program budget. She performed, to name a few, the following tasks with Salem:\r&lt;br/&gt;ï‚§ Spearhead program expansion effort, which has increased student enrollment from 45 in 1992 to 530 in 2015, representing 70 countries. Promoted sisterÃ‚Â¬school agreements with overseas institutions and built partnerships with local placement agencies, recruiting agents, community colleges, international centers, language schools, advising centers, and local businesses. Participated in a student recruitment tour in nine Asian countries and South America.\r&lt;br/&gt;ï‚§ Manage compliance to SEVIS (F visas) immigration regulations, advising students on requirements, collecting data, and reporting. Assist students with the completion of various government forms and applications, Change of Status, Reinstatements, and the Curricular and Optional Practical Training applications. Serve as Designated School Official (F status) and Responsible Officer (J status).\r&lt;br/&gt;ï‚§  Assist in all aspect of student engagement within academia and daily living, including admissions, housing and employment opportunities, cultural adjustments, and reÃ‚Â¬entry. Develop and coordinate crossÃ‚Â¬cultural programs and events, including the TeachÃ‚Â¬in, student conferences, and host family programs that benefit international students and the community. Collaborate with university departments to facilitate the integration of international students to the campus community.\r&lt;br/&gt;ï‚§  Coordinate with the Alumni Office to facilitate the creation of international alumni groups, which provide networking opportunities and sustains an emotional bond with Salem State University. Developed the Japan Alumni Group, the first alumni group outside of the U.S.\r&lt;br/&gt;ï‚§  Advise the International Students Association (ISA), which provides leadership skills and brings awareness to the community of global cultures through various community events, speaking engagements, etc.\r&lt;br/&gt;ï‚§ Conducted numerous conference presentations and crossÃ‚Â¬cultural workshops for students, community organizations and host family program participants, providing subject matter expertise on the importance of international programs.\r&lt;br/&gt;ï‚§ Contributed to managing the study abroad program by promoting the program to American students, advising prospective study abroad students on available programs, resources, and processes, creating a study abroad orientation handbook and risk management policy, meeting with providers of study abroad programs, and assisting with creating the sister school relationships with Montpellier, France and Oxford Brooks University in England.\r&lt;br/&gt;ï‚§ Assisted in the development of the English as a Second Language Program, authoring and designing orientation manuals, a handbook, and informational and promotional brochures.\r&lt;br/&gt;\r&lt;br/&gt;Prior to all these, Mdm. Nelly worked as Assistant Activities Director for Hunt Nursing and Retirement Home, Danvers, MA, and Brigham Manor Nursing Home, Newburyport, MA.; Development Project Administrator for Provincial Planning and Development Office, Legazpi City, Philippines, and Technical Researcher for Bicol River Basin Development Program, Naga City, Philippines\r&lt;br/&gt;Among the awards and presentations she had, included the following:\r&lt;br/&gt;ï‚§ Advisor of the Year Award, 2013 and 2005, Salem State University\r&lt;br/&gt;ï‚§  Commonwealth Citation for Outstanding Performance, Massachusetts\r&lt;br/&gt;ï‚§  Volunteer of the Year Award, Community Service of HamiltonÃ‚Â¬Wenham, Massachusetts\r&lt;br/&gt;ï‚§ Presented at NAFSA, MACIE, AAUW conferences\r&lt;br/&gt;ï‚§ Conducted numerous crossÃ‚Â¬cultural workshops for elementary and high school teachers, high school students, community organizations, and host family program participants\r&lt;br/&gt;ï‚§ Conducted extensive adult education and farmerÃ¢â‚¬â„¢s trainings in the Philippines.\r&lt;br/&gt;Some significant committee work she had were:\r&lt;br/&gt;ï‚§ Salem State UniversityÃ¢â‚¬â„¢s Presidential Advisory Committee on Diversity, Student Behavioural and Intervention Committee\r&lt;br/&gt;ï‚§  MASSACHUSETTS COUNCIL ON INTERNATIONAL EDUCATION Member of the Executive Board, 2008 Ã¢â‚¬â€œ Present &amp; 1993 Ã¢â‚¬â€œ 1996 | President, 2009 Ã¢â‚¬â€œ 2010\r&lt;br/&gt;Ms WadsworthÃ¢â‚¬â„¢s PROFESSIONAL &amp; COMMUNITY CONTRIBUTIONS:\r&lt;br/&gt;ï‚§  AMERICAN ASSOCIATION OF UNIVERSITY WOMEN,\r&lt;br/&gt;Board Member/NSAB Newsletter Production Editor, 2010 Ã¢â‚¬â€œ Present\r&lt;br/&gt;President, North Shore Branch, 1999Ã‚Â¬2001, July, 2005 Ã¢â‚¬â€œ 2007\r&lt;br/&gt;State Membership ViceÃ‚Â¬President, Massachusetts, 1995 Ã¢â‚¬â€œ 1997\r&lt;br/&gt;State Diversity Resource Team Member, 1995 Ã¢â‚¬â€œ 2004\r&lt;br/&gt;ï‚§  PAX POPULI\r&lt;br/&gt;Director of Onboarding and Board Member, 2013 Ã¢â‚¬â€œ present\r&lt;br/&gt;ï‚§ NAFSA: ASSOCIATION OF INTERNATIONAL EDUCATORS\r&lt;br/&gt;Member, 1991 Ã¢â‚¬â€œ present\r&lt;br/&gt;ï‚§ OPERATION BOOTSTRAP, Lynn, MA\r&lt;br/&gt;ViceÃ‚Â¬President, 2009 Ã¢â‚¬â€œ 2010 | Member of the Board of Directors, 2005 Ã¢â‚¬â€œ 2010\r&lt;br/&gt;ï‚§  INTERNATIONAL CAREERS CONSORTIUM, Member of the Board of Directors (1995-2001)\r&lt;br/&gt;ï‚§  MASSACHUSETTS WOMEN ON PUBLIC HIGHER EDUCATION, President (1998-1999), Member of the Board of Directors (1997-2000)\r&lt;br/&gt;NELLY MALATE WADSWORTH must have gained the respect not only among us Filipinos but also those whom she had worked with in those parts of the world. We can proudly say, that indeed, alumni of the Bicol University are par excellence with other graduates from all parts of the universe. WE SALUTE YOU MS. WADSWORTH MAY YOUR TRIBE INCREASE...\r&lt;br/&gt;\r&lt;br/&gt;*', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:24:10');
INSERT INTO `post` (`post_id`, `admin_id`, `post_type`, `imgbanner`, `imglinks`, `title`, `content`, `status`, `eventdate`, `view_count`, `unique_visitors`, `timestamp`) VALUES
(48, 1, 1, '../../data/events-stories/7178', '', 'Hon. ALFREDO A. GARBIN JR.', 'Hon. ALFREDO ABAROA GARBIN JR, completed a Local Development Management Course at the Asian Institute of Management in 2008. â€œPidoâ€ to his friends, graduated from the Bicol University College of Arts and Sciences, now the Bicol University College of Business Economics and Management with a degree in Bachelor of Science in Business Administration, in 1997, major in Management. It was his grandfather, Mr. Mariano Abaroa who motivated and encouraged him to take Law. His grandfather passed away while he was a freshman in the College of Law. It was during this tearful moment of his life that made him pursue with more vigor and passion his dream of becoming a lawyer. Despite his predicament, he never gave up trying to help support his family. He worked part-time in the supply section of the Department of Health Regional Office. Determined and more serious about achieving his goals, he attained high grades.\r&lt;br/&gt;\r&lt;br/&gt;For the next two years, he juggled his time carrying heavy boxes of medical supplies to the adjacent provincial hospital at daytime and studying the intricacies of the provisions of the laws at night. While preparing for the bar examinations in 2001, Atty. Garbin applied and was accepted as the legal assistant in the Aquende Law Office. It was during this time that his interest and admiration about law even became stronger.\r&lt;br/&gt;GOD looked favorably to him in 2002. It was a day that marked a special year and the turning point in the young ALFREDO GARBIN Jr in his quest for truth, excellence and justice as he passed the BAR examinations with an average score of 81.4%. Moreover, he was accepted as a managing partner of a successful law firm known for its competence, credibility and integrity, finally fulfilling his grandfatherÃ¢â‚¬â„¢s dream for him. Furthermore, it was in this year when he became the youngest president of the National Movement of Young Legislators- Albay Chapter and Junior Chamber International, Legazpi City Chapter.\r&lt;br/&gt;Recognized for his humanitarian work and civic litigations, he was visited by the City Mayor, hence, the start of his political battle that changed the course of his life journey. The following years showed the epic performance of Atty. Garbin as a legislator and civic leader, working and hoping to ultimately transform the moral and social fiber in the community he serves.\r&lt;br/&gt;\r&lt;br/&gt;At present, Atty. Garbin is a Member in the House of Representatives and serves as Deputy Minority Leader and an ex officio member of all standing committees in the 17th Congress. The latest of the awards received included the Icon Award, given by the National Movement of Young Legislators in 2017.He, too, is a participant to several international studies/trainings/workshops. He attended the Leaders in Development Program at Harvard Kennedy School, Cambridge, Massachusettes, SA in 2017; Internationale Tourismus-Borse (ITB) in Berlin, Germany in 2017; Australian Political Exchange Program, Sydney, Canberra and Melbourne in 2012, to name a few.\r&lt;br/&gt;As one of the representative of the AKO BICOL Partylist, he is pursuing the organizationÃ¢â‚¬â„¢s agenda of supporting residents of the Bicol Region, people born of Bicolano parents, or those simply interested in the promotion of the welfare and interest of the region and its people, collectively known as Bicolanos.\r&lt;br/&gt;Atty. ALFREDO A. GARBIN, a leader, living and bringing the ideals of the Bicol University, a true pride of the BU community.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:25:00'),
(49, 1, 1, '../../data/events-stories/30350', NULL, 'HON. CHRISTOPHER S. CO', 'Hon. CHRISTOPHER S. CO graduated from the Bicol University High School now the Bicol University Integrated Laboratory School. He came from a simple life with big dreams. Through his strong faith, hardwork, determination, and dedication to his craft, he was able to rise above this simple life. At this point, he strongly commits with an unwavering devotion and personal vow to help others by continuously inspiring people and help them in his own little ways.\r&lt;br/&gt;\r&lt;br/&gt;He is a businessman by profession engaging in the fields of construction, tourism, agriculture, and food industry. Through the years, he led his companies in every challenge that comes along the way without forgetting his advocacies in public service. He offered himself to the people and he is known for character and integrity.\r&lt;br/&gt;As a public servant, he led a good and respectable life grounded in humility. He spearheaded various programs that have shaped the people as empowered members of a community, where they can contribute to regional and national development. In all his personal and professional endeavors, the welfare of the people has always been his priority.\r&lt;br/&gt;Cong. CoÃ¢â‚¬â„¢s service record in the government started as a representative of the AKO BICOL PARTYLIST in 2010 to 2013. It continued up to the present, which means that he is now in his third term.\r&lt;br/&gt;As a Member of 15th Congress, he was a member of various committees. These were the following:\r&lt;br/&gt;ï‚§  Committee on Bicol Recovery and Economic Development\r&lt;br/&gt;ï‚§  Committee on Higher and Technical Education\r&lt;br/&gt;ï‚§ Committee on Information and Communications Technology\r&lt;br/&gt;ï‚§  Committee on Millennium Development Goals\r&lt;br/&gt;ï‚§ Committee on People&apos;s participation\r&lt;br/&gt;ï‚§  Committee on Science and Technology\r&lt;br/&gt;ï‚§ Committee on Social Services\r&lt;br/&gt;\r&lt;br/&gt;On the other hand, his committee membership during the 16th Congress included the following:\r&lt;br/&gt;ï‚§  Committee on Civil Service and Professional Regulation\r&lt;br/&gt;ï‚§  Committee on Health\r&lt;br/&gt;ï‚§ Committee on Information and Communication Technology\r&lt;br/&gt;ï‚§ Committee on Inter parliamentary Relations and Diplomacy\r&lt;br/&gt;ï‚§  Committee on Cooperatives Development\r&lt;br/&gt;ï‚§ Special Committee on Globalization and WTO\r&lt;br/&gt;ï‚§  Special Committee on Bicol Recovery and economic Development\r&lt;br/&gt;At present in the 17th Congress, Cong. Co chairs the Climate Change Committee and still a House Committee Member of the following:\r&lt;br/&gt;Aquaculture And Fisheries Resources\r&lt;br/&gt;Banks And Financial Intermediaries\r&lt;br/&gt;Bicol Recovery And Economic Development\r&lt;br/&gt;Public Works And Highways\r&lt;br/&gt;Revision Of Laws\r&lt;br/&gt;Rural Development\r&lt;br/&gt;Small Business &amp; Entrepreneurship Development\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;As chairman of the Climate Change Committee, he has to take the challenge toformulate policies for implementing activities and projects which will address the issues on climate change. His future projects will focus on sustainable development answering the call of the changing environment.\r&lt;br/&gt;As Congressman, he has authored and co-authored a total of 658 measures in Congress that made him the third most prolific legislator. Moreover, through his efforts, thousands of scholars have enjoyed free tertiary education. Through several collaborations that he personally initiated with the Technical and Educational Skills Development Authority (TESDA), a big number of students, too, have graduated with competencies that increased their chances of getting employment through technical trainings. It was also though him that a building for Persons with Disability (PWD) in Naga, Camarines Sur was constructed to primarily cater to the needs of the PWDs whose sector is under represented in the communities, thus creating a centralized system for all their concerns and requests.\r&lt;br/&gt;\r&lt;br/&gt;Cong. Co is also a strong advocate of employment and livelihood opportunities for the people. He continuously create more jobs and /or provide livelihood through distribution of various supplies and equipment like farming and fishing implements.\r&lt;br/&gt;Congressman CHRISTOPHER S. CO, a leader, a public servant, an entrepreneur, an environmentalist, in every inch exemplifying a true friend, a KAPAMILYA, KAPUSO, KAPATID, and so much more. We are happy to be part of your journey.\r&lt;br/&gt;\r&lt;br/&gt;\r&lt;br/&gt;', 'shown', '0000-00-00', 0, 0, '2017-09-25 04:26:40'),
(53, 12, 6, NULL, NULL, 'Project Title', 'Description goes here..', 'shown', '0000-00-00', 0, 0, '2017-09-19 22:12:13'),
(54, 13, 6, NULL, NULL, 'PROJECT TITLE', 'Description here', 'shown', '0000-00-00', 0, 0, '2017-09-19 22:45:53'),
(55, 14, 6, NULL, NULL, 'A school for children in Kenya', 'Education is the basis of all change in society - therefore school plays a vital role for the development of third world countries. The school system in Kenya is not ideal in this respect - it lacks proper funding; classes are huge and teachers underpaid. Attending a primary state school is free in principle - however, additional costs make it difficult for families to afford school for all of their children; especially if those children are needed for providing financial support to the family by their labour. &lt;br/&gt;&lt;br/&gt;In 2007 we decided to buy land in Kilifi, Kenya, to build a school. We officially registered our school in Kenya and pay all running costs (teachers, food, books, school uniforms, medical treatment) via donations. &lt;br/&gt;&lt;br/&gt;By now, 400 children are attending our school from Kindergarten up the the 4th grade of primary school. We have built school buildings with classrooms for each class, a hall and a toilet building. Still we are planning to extend those buildings - our school will be growing until we offer education up to the 8th grade. Each year we welcome a new class of pupils at our school and hope to provide them with an education which will be their start into a better life.', 'shown', '0000-00-00', 0, 0, '2017-09-20 04:05:34'),
(56, 1, 4, NULL, NULL, 'ABOUT BU Alumni Relations Office', '#### **The Bicol University Alumni Relations Office serves as the line between the alumni and the BU Community. It seeks to:**\n1. Invite wide alumni participation and contribution to the development of the esucation gaols of Bicol University.\n2. Recognize the meritorious services and achivemens of the alumni, and\n3. Provide leadership in coordinating, planning, implementing and monitoring of the development programs of the alumni associations.\n4. Plan and implement Alumni Continuing Education and other activities designed for the continuing professional growth of the Alumni.\n5. Coordinate the organization of an alumni fund and other source of support funds.\n\n#### **Objectives:**\nTo maintain and strengthen a productive partnership and to encourage and facilitate professional and social linkage between Bicol University and its Alumni.\n\n#### **ARO Services for Alumni:**\n* Develop and maintain an Alumni Database of Alumni Records\n* Recognize Alumni achievements\n* Collects and Disseminates News/Information\n* Assits the Unit/College Alumni Associations in Fund Campaigns, Homecomnings ', 'shown', NULL, 0, 0, '2017-09-20 23:49:51'),
(57, 1, 5, NULL, NULL, 'CONTACT US', 'BUREPC Building&lt;br/&gt;Bicol University&lt;br/&gt;Legazpi City, Philippines&lt;br/&gt;&lt;br/&gt;**Email**: bualumnirelations@bicol-u.edu.ph&lt;br/&gt;**Tel. No.**(052) 480-01-79/(052) 483-45-88&lt;br/&gt;**Facebook Page**: http://wwww.facebook.com/BUAlumniRelations', 'shown', NULL, 0, 0, '2017-09-21 03:05:11'),
(58, 13, 1, '', '../../data/events-stories/7595817-10-05/10397763233f5974b6af7a498a9efb9188022e1a027c223b1fc381aae357a1392afc9fe059.png;../../data/events-stories/7595817-10-05/9386575468fdf1d8a51fc25f3e6e29a64b8b5b377d345a56fb7d8a9d20591a23a6a8cfd05.jpg;../../data/events-stories/7595817-10-05/4881231009c9ecc60a48bb21a7e15cfbd2cf31a87d9cca4e7d71634da0dbf18d801b974af.jpg', 'Story', 'Content', 'shown', NULL, 0, 0, '2017-10-05 02:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `post_type`
--

CREATE TABLE `post_type` (
  `post_type_id` int(11) NOT NULL,
  `label` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_type`
--

INSERT INTO `post_type` (`post_type_id`, `label`) VALUES
(4, 'ABOUT'),
(3, 'BULLETIN_ITEM'),
(5, 'CONTACT'),
(6, 'DONATION_LINK'),
(2, 'EVENT'),
(1, 'STORY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `admin_type` (`admin_type`),
  ADD KEY `address` (`address`),
  ADD KEY `college` (`college`);

--
-- Indexes for table `admin_type`
--
ALTER TABLE `admin_type`
  ADD PRIMARY KEY (`admin_type_id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `graduates`
--
ALTER TABLE `graduates`
  ADD PRIMARY KEY (`grad_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `memorabilia`
--
ALTER TABLE `memorabilia`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `label` (`label`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `post_type` (`post_type`);

--
-- Indexes for table `post_type`
--
ALTER TABLE `post_type`
  ADD PRIMARY KEY (`post_type_id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `admin_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `grad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `memorabilia`
--
ALTER TABLE `memorabilia`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `post_type`
--
ALTER TABLE `post_type`
  MODIFY `post_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`address_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`college`) REFERENCES `college` (`college_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`admin_type`) REFERENCES `admin_type` (`admin_type_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `memorabilia` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`) ON DELETE NO ACTION;

--
-- Constraints for table `graduates`
--
ALTER TABLE `graduates`
  ADD CONSTRAINT `graduates_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION;

--
-- Constraints for table `memorabilia`
--
ALTER TABLE `memorabilia`
  ADD CONSTRAINT `memorabilia_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
