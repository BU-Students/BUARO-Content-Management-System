-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2017 at 04:13 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Bagumbayan', 'Daraga', 'Albay'),
(2, 'Bascaran', 'Daraga', 'Albay'),
(9, 'b1', 'm1', 'p1'),
(10, 'b2', 'm2', 'p2'),
(11, 'b3', 'm3', 'p3'),
(12, 'Sagpon', 'Daraga', 'Albay');

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
  `profile_img` varchar(500) NOT NULL DEFAULT '../img/default-profile-img.png',
  `cover_photo` varchar(500) NOT NULL DEFAULT '../img/default-cover-photo.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_type`, `address`, `college`, `first_name`, `middle_name`, `last_name`, `sex`, `contact_no`, `bdate`, `email`, `username`, `password`, `profile_img`, `cover_photo`) VALUES
(2, 1, 1, NULL, 'Christian', 'Amaranto', 'Collamar', 0, '09772044506', '1998-12-30', 'christian.collamar@bicol-u.edu.ph', 'user', '754ea1d0fb21a2ba706619100e60061c', '../data/profile-img-2.png', ''),
(3, 2, 2, 1, 'Angelo', 'Lumbo', 'Duran', 0, '', '1998-09-13', 'angelo.duran@bicol-u.edu.ph', 'angelo', '371ef2078a775ac6d9d825edf440504d', '../data/profile-img-1.jpg', ''),
(8, 2, 9, 2, 'fname', 'mname', 'lname', 0, NULL, '1991-04-13', '1@example.com', '1', '87f5e873e4cc3ebaed6f289303417020', '../img/default-profile-img.png', ''),
(9, 2, 10, 2, 'fname2', 'mname2', 'lname2', 1, '09876543210', '2017-08-27', NULL, '2', 'ee262c7610a18ee3babfa4e36ade34a3', '../img/default-profile-img.png', ''),
(11, 2, 12, 12, 'Harold', 'Guriba', 'Nacido', 0, NULL, '1999-03-24', NULL, 'nacido_nacido', '81f41e5d97b945c3487a2df13e14e378', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(12, 2, 12, 14, 'mark', 'ret', 'yeah', 0, NULL, '2017-09-11', NULL, 'louii', '150a05ec596ad344a1bea5b9e9bb87a3', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(13, 2, NULL, 7, 'agustin', 'faustino', 'guillermo', 0, NULL, '2017-08-09', NULL, 'agustin', '7ef22fc9e3f3f6232efe094129c88917', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(14, 2, NULL, 11, 'aleja', 'kol', 'juso', 1, NULL, '2017-09-06', NULL, 'alei', '546f9bc80a524e47b7a1d531179764d1', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(15, 2, NULL, 3, 'kyle', 'kolp', 'aser', 0, NULL, '2017-09-08', NULL, 'kyle', '5c7befd972f6caa4cfcf9deabde23267', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(16, 2, NULL, 13, 'jhoan', '', 'de la torre', 1, NULL, '2017-09-20', NULL, 'jhoan', '99df010fad60ecdf1a6fe4d2e3feab5f', '../img/default-profile-img.png', '../img/default-cover-photo.jpg'),
(17, 2, NULL, 10, 'rey', 'balbo', 'rex', 0, NULL, '2017-09-25', NULL, 'rey', '69cca05ed0890d5a39cbb54393e328c7', '../img/default-profile-img.png', '../img/default-cover-photo.jpg');

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
(6, ''),
(2, 'College of Arts and Letters'),
(12, 'College of Business Economic and Management'),
(13, 'College of Education'),
(7, 'College of Engineering'),
(11, 'College of Industrial Technology'),
(3, 'College of Nursing'),
(1, 'College of Science'),
(14, 'College of Social Science and Philosophy'),
(10, 'Institute of Architecture'),
(15, 'Institute of Physical Education Sports and Recreation');

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
(1, 1, 'BS Computer Science'),
(2, 1, 'BS Information Technology'),
(3, 1, 'BS Biology'),
(4, 7, 'BS Civil Engineering'),
(5, 7, 'BS Mechanical Engineering'),
(6, 7, 'BS Chemical Engineering'),
(7, 7, 'BS Geodetic Engineering'),
(8, 7, 'BS Mining Engineering'),
(9, 2, 'AB English'),
(10, 2, 'AB Journalism'),
(11, 7, 'BS Electrical Engineering'),
(12, 2, 'AB Broadcasting'),
(13, 2, 'AB Speech and Theater Arts'),
(14, 2, 'BA Communication'),
(15, 12, 'BS Accountancy'),
(16, 12, 'AB Economics'),
(17, 12, 'BS Management'),
(18, 12, 'BS Entrepreneurship'),
(19, 12, 'BSBA'),
(20, 14, 'AB Political Science'),
(21, 14, 'AB Philosophy'),
(22, 14, 'AB Social Work'),
(23, 14, 'AB Sociology'),
(24, 14, 'BA Peace and Studies'),
(25, 11, 'BS Civil Technology'),
(26, 11, 'BS Electrical Technology'),
(27, 11, 'BS Electronics Technology'),
(28, 11, 'BS Food Technology'),
(29, 11, 'BS Industrial Education'),
(30, 11, 'BS Mechanical Technology'),
(31, 3, 'BS Nursing'),
(32, 1, 'BS Chemistry'),
(33, 13, 'BEED'),
(34, 13, 'BSED'),
(35, 10, 'BS Architecture');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graduates`
--

CREATE TABLE `graduates` (
  `grad_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `grad_year` year(4) NOT NULL,
  `grad_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduates`
--

INSERT INTO `graduates` (`grad_id`, `course_id`, `grad_year`, `grad_num`) VALUES
(1, 1, 2017, 254),
(2, 2, 2017, 314),
(3, 9, 2017, 145),
(4, 10, 2017, 157),
(5, 12, 2017, 142),
(6, 13, 2017, 150),
(7, 14, 2017, 148),
(8, 15, 2017, 201),
(9, 16, 2017, 139),
(10, 17, 2017, 151),
(11, 18, 2017, 153),
(12, 19, 2017, 157),
(13, 20, 2017, 155),
(14, 21, 2017, 149),
(15, 22, 2017, 147),
(16, 23, 2017, 150),
(17, 24, 2017, 135),
(18, 4, 2017, 176),
(19, 5, 2017, 155),
(20, 6, 2017, 150),
(21, 7, 2017, 144),
(22, 8, 2017, 146),
(23, 11, 2017, 157),
(24, 25, 2017, 139),
(25, 26, 2017, 138),
(26, 27, 2017, 134),
(27, 28, 2017, 156),
(28, 29, 2017, 148),
(29, 30, 2017, 140),
(30, 31, 2017, 154),
(31, 3, 2017, 156),
(32, 32, 2017, 150),
(33, 33, 2017, 161),
(34, 34, 2017, 167),
(35, 35, 2017, 164);

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

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `post_type` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `unique_visitors` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `admin_id`, `post_type`, `title`, `content`, `view_count`, `unique_visitors`, `timestamp`) VALUES
(46, 2, 1, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pharetra diam a augue porttitor sagittis. Proin vitae augue nibh. Quisque elementum eget lacus at elementum. Vestibulum lacinia sem ut blandit pretium. Etiam pulvinar est at sem ultrices congue ac venenatis erat. Maecenas tempor at massa sed aliquet. Nulla vel nibh ex. Curabitur molestie dui a erat rutrum, sed finibus metus sagittis. Curabitur rhoncus laoreet nulla ut imperdiet. Maecenas pulvinar facilisis magna vel hendrerit. Suspendisse in nisl eget justo maximus ultricies a lacinia urna. Nulla facilisis turpis eget sapien efficitur aliquam. Ut non urna rhoncus, finibus mi eu, pretium lacus.&lt;br/&gt;&lt;br/&gt;Integer fringilla porttitor elementum. Donec molestie felis nibh, pretium placerat justo tempus et. Sed suscipit leo a purus pulvinar, lobortis egestas turpis posuere. Etiam consequat ipsum ut sem consequat lacinia. Donec consequat ultricies lectus. Pellentesque nec pellentesque erat. Nunc lacinia molestie elementum. Maecenas pulvinar auctor nisl, ac ultricies nulla ornare ut. Mauris dapibus turpis ac varius iaculis. Vestibulum blandit vulputate felis ac facilisis. Suspendisse sit amet vulputate orci.', 24, 19, '2017-09-02 13:13:05'),
(47, 2, 1, 'Sample Story', 'Sample content.', 16, 15, '2017-09-06 16:41:28'),
(55, 2, 1, 'What Is Lorem Ipsum', 'Ang **Lorem Ipsum** ay ginagamit na modelo ng industriya ng pagpriprint at pagtytypeset. Ang Lorem Ipsum ang naging regular na modelo simula pa noong 1500s, noong may isang di kilalang manlilimbag and kumuha ng galley ng type at ginulo ang pagkaka-ayos nito upang makagawa ng libro ng mga type specimen. Nalagpasan nito hindi lang limang siglo, kundi nalagpasan din nito ang paglaganap ng electronic typesetting at nanatiling parehas. Sumikat ito noong 1960s kasabay ng pag labas ng Letraset sheets na mayroong mga talata ng Lorem Ipsum, at kamakailan lang sa mga desktop publishing software tulad ng *Aldus Pagemaker* ginamit ang mga bersyon ng Lorem Ipsum.', 3, 3, '2017-09-10 09:30:06'),
(56, 2, 1, 'Another Sample Story', 'With some short content.', 32, 29, '2017-09-10 09:37:09'),
(57, 2, 1, 'Title', '', 1, 1, '2017-09-10 09:37:31'),
(58, 2, 1, '2017 Search for Most Outstanding Bicol University Alumni', 'Bicol University, through the Alumni Relations Office, aims to recognize the meritorious achievements and contributions of alumni to the society as an outgrowth of their professional training in Bicol University. In this connection, may we invite nominations for the 2017 Search for Outstanding BU ALUMNI and Most Distinguished Alumni in the following areas:&lt;br/&gt;&lt;br/&gt;* Good governance and public service;&lt;br/&gt;* Engineering and allied fields;&lt;br/&gt;* Food and Industrial Technology;&lt;br/&gt;* Information and Communication Technology;&lt;br/&gt;* Media Communication;&lt;br/&gt;* Culture Arts;&lt;br/&gt;* Medical and Public Health Promotion and Services;&lt;br/&gt;* Education;&lt;br/&gt;* Sports and Development;&lt;br/&gt;* Accountancy and Financial Services;&lt;br/&gt;* Social Work;&lt;br/&gt;* Agriculture, Forestry and Fisheries;&lt;br/&gt;* Peace and Social Cohesion; and&lt;br/&gt;* Entrepreneurship, Business and Employment Creation.&lt;br/&gt;&lt;br/&gt;Please submit nominations of your best batch mates or any BU graduate whose accomplishments may serve as an inspiration to others.&lt;br/&gt;&lt;br/&gt;Here is the [Nomination Form and Guidelines](https://drive.google.com/drive/folders/0BzJJChjRhSq7bktvY1Fxbm9HbjQ).&lt;br/&gt;&lt;br/&gt;or further inquiries, you may email us at *bualumnirelations@bicol-u.edu.ph*.&lt;br/&gt;&lt;br/&gt;Thank you.', 0, 0, '2017-09-10 10:04:04'),
(59, 2, 1, 'ABOUT BU Alumni Relations Office', 'The Bicol University Alumni Relations Office serves as the line between the alumni and the BU Community. It seeks to:&lt;br/&gt;&gt; Invite wide alumni participation and contribution to the development of the esucation gaols of Bicol University.&lt;br/&gt;&gt; Recognize the meritorious services and achivemens of the alumni, and&lt;br/&gt;&gt; Provide leadership in coordinating, planning, implementing and monitoring of the development programs of the alumni associations.&lt;br/&gt;&gt; Plan and implement Alumni Continuing Education and other activities designed for the continuing professional growth of the Alumni.&lt;br/&gt;&gt; Coordinate the organization of an alumni fund and other source of support funds.', 0, 0, '2017-09-11 04:35:49');

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
(4, 'ABOUT_BUARO'),
(3, 'BULLETIN_ITEM'),
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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `admin_type` (`admin_type`),
  ADD KEY `admin_ibfk_3` (`college`),
  ADD KEY `admin_ibfk_2` (`address`);

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
  ADD PRIMARY KEY (`college_id`),
  ADD UNIQUE KEY `label` (`label`);

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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `admin_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `graduates`
--
ALTER TABLE `graduates`
  MODIFY `grad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `memorabilia`
--
ALTER TABLE `memorabilia`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `post_type`
--
ALTER TABLE `post_type`
  MODIFY `post_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_type`) REFERENCES `admin_type` (`admin_type_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`address`) REFERENCES `address` (`address_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`college`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `college` (`college_id`);

--
-- Constraints for table `graduates`
--
ALTER TABLE `graduates`
  ADD CONSTRAINT `graduates_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `memorabilia`
--
ALTER TABLE `memorabilia`
  ADD CONSTRAINT `memorabilia_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`post_type`) REFERENCES `post_type` (`post_type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
