-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.10


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema kelanidb
--

CREATE DATABASE IF NOT EXISTS kelanidb;
USE kelanidb;

--
-- Definition of table `acadamicyear`
--

DROP TABLE IF EXISTS `acadamicyear`;
CREATE TABLE `acadamicyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acadamicyear`
--

/*!40000 ALTER TABLE `acadamicyear` DISABLE KEYS */;
INSERT INTO `acadamicyear` (`id`,`year`) VALUES 
 (1,'2011'),
 (2,'2012'),
 (3,'2013'),
 (4,'2014'),
 (5,'2015'),
 (6,'2016');
/*!40000 ALTER TABLE `acadamicyear` ENABLE KEYS */;


--
-- Definition of table `alqulification_tbl`
--

DROP TABLE IF EXISTS `alqulification_tbl`;
CREATE TABLE `alqulification_tbl` (
  `Index_no` varchar(10) NOT NULL,
  `Year` int(4) DEFAULT NULL,
  `Medium` varchar(1) DEFAULT NULL,
  `Center_no` varchar(10) DEFAULT NULL,
  `District_tbl_District_ID` int(11) NOT NULL,
  `District_rank` int(5) DEFAULT NULL,
  `Island_rank` int(5) DEFAULT NULL,
  `Z_core` decimal(5,4) DEFAULT NULL,
  `GeneralTestMarks` int(3) DEFAULT NULL,
  `ALStream` varchar(1) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `ALQulification_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Index_no`),
  KEY `fk_ALQulification_tbl_District_tbl1_idx` (`District_tbl_District_ID`),
  CONSTRAINT `fk_ALQulification_tbl_District_tbl1` FOREIGN KEY (`District_tbl_District_ID`) REFERENCES `district_tbl` (`District_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alqulification_tbl`
--

/*!40000 ALTER TABLE `alqulification_tbl` DISABLE KEYS */;
INSERT INTO `alqulification_tbl` (`Index_no`,`Year`,`Medium`,`Center_no`,`District_tbl_District_ID`,`District_rank`,`Island_rank`,`Z_core`,`GeneralTestMarks`,`ALStream`,`CreateDate`,`CreateUser`,`ALQulification_status`) VALUES 
 ('0111111111',2016,'E','12222',2,12500,1500,'1.0256',88,'B','2016-02-11 11:03:43','Admin',1),
 ('0485400000',2016,'E','0485200000',2,15200,25220,'1.2222',88,'B','2016-02-12 10:54:52','Admin',1),
 ('1222545871',2015,'E','10',2,220,1500,'1.2555',80,'B','2016-02-06 15:59:00','Admin',1),
 ('1255554587',1205,'E','1',2,1,1,'1.0000',1,'B','2016-02-06 15:45:29','Admin',1),
 ('2310002500',5820,'E','2351151200',2,26254,15120,'8.0000',651,'B','2016-02-12 11:13:34','Admin',1),
 ('2515',2011,'S','1520',2,2,2,'1.2500',52,'B','2016-02-06 12:25:28','Admin',1),
 ('4784500000',2016,'E','1250',2,45120,41252,'1.5600',64,'B','2016-02-11 15:14:16','Admin',1),
 ('4880000000',5820,'E','2351151200',2,21,12520,'3.0000',11,'A','2016-02-29 12:50:41','aaa',1),
 ('6323000000',5820,'E','2351151200',2,26254,52123,'1.0000',78,'B','2016-02-15 16:52:31','Admin',1),
 ('7848484840',2016,'S','5150100',16,54108,52150,'3.0000',0,'A','2016-02-29 11:18:54',NULL,1),
 ('9956200',2011,'S','7859',1,500,2500,'1.2500',50,'B','2016-02-05 10:37:38','Admin',1);
/*!40000 ALTER TABLE `alqulification_tbl` ENABLE KEYS */;


--
-- Definition of table `alqulification_tbl_has_alsubject_tbl`
--

DROP TABLE IF EXISTS `alqulification_tbl_has_alsubject_tbl`;
CREATE TABLE `alqulification_tbl_has_alsubject_tbl` (
  `ALQulification_tbl_Index_no` varchar(10) NOT NULL,
  `ALSubject_tbl_SubjectID` int(11) NOT NULL,
  `Grade` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`ALQulification_tbl_Index_no`,`ALSubject_tbl_SubjectID`),
  KEY `fk_ALQulification_tbl_has_ALSubject_tbl_ALSubject_tbl1_idx` (`ALSubject_tbl_SubjectID`),
  KEY `fk_ALQulification_tbl_has_ALSubject_tbl_ALQulification_tbl1_idx` (`ALQulification_tbl_Index_no`),
  CONSTRAINT `fk_ALQulification_tbl_has_ALSubject_tbl_ALQulification_tbl1` FOREIGN KEY (`ALQulification_tbl_Index_no`) REFERENCES `alqulification_tbl` (`Index_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ALQulification_tbl_has_ALSubject_tbl_ALSubject_tbl1` FOREIGN KEY (`ALSubject_tbl_SubjectID`) REFERENCES `alsubject_tbl` (`SubjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alqulification_tbl_has_alsubject_tbl`
--

/*!40000 ALTER TABLE `alqulification_tbl_has_alsubject_tbl` DISABLE KEYS */;
INSERT INTO `alqulification_tbl_has_alsubject_tbl` (`ALQulification_tbl_Index_no`,`ALSubject_tbl_SubjectID`,`Grade`) VALUES 
 ('1222545871',1,'A'),
 ('1222545871',2,'B'),
 ('1222545871',3,'B'),
 ('1255554587',1,'B'),
 ('2310002500',1,'A'),
 ('2310002500',2,'A'),
 ('2310002500',3,'B'),
 ('2310002500',4,'C'),
 ('2515',1,'F'),
 ('2515',2,'C'),
 ('2515',3,'F'),
 ('4784500000',1,'B'),
 ('4784500000',2,'A'),
 ('4784500000',3,'A'),
 ('4880000000',2,'A'),
 ('4880000000',3,'B'),
 ('4880000000',4,'B'),
 ('6323000000',1,'A'),
 ('6323000000',2,'A'),
 ('6323000000',5,'C'),
 ('7848484840',3,'A'),
 ('7848484840',7,'A'),
 ('7848484840',13,'A'),
 ('7848484840',17,'A'),
 ('9956200',1,'A'),
 ('9956200',2,'A'),
 ('9956200',3,'A');
/*!40000 ALTER TABLE `alqulification_tbl_has_alsubject_tbl` ENABLE KEYS */;


--
-- Definition of table `alsubject_tbl`
--

DROP TABLE IF EXISTS `alsubject_tbl`;
CREATE TABLE `alsubject_tbl` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `ALSubject_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`SubjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alsubject_tbl`
--

/*!40000 ALTER TABLE `alsubject_tbl` DISABLE KEYS */;
INSERT INTO `alsubject_tbl` (`SubjectID`,`Name`,`ALSubject_status`) VALUES 
 (1,'Physics',1),
 (2,'Sinhala',1),
 (3,'Econ',1),
 (4,'Bio',1),
 (5,'Accounting',1),
 (6,'hhujh',1),
 (7,'123',1),
 (8,'111111',1),
 (9,'aaaa',1),
 (10,'1220',1),
 (11,'1250',1),
 (12,'4555',1),
 (13,'aaaaaaaa',1),
 (14,'444444',1),
 (15,'444444',1),
 (16,'Mathss',1),
 (17,'aaaaaaaa',1),
 (18,'axax',1),
 (19,'aaaaaaaaaaaaaaaa',1),
 (20,'kjhkjhkjhkjhkj',1),
 (21,'azzzzz',1),
 (22,'azzzzzazaza',1),
 (23,'aaaaassssssss',1),
 (24,'Physics',1),
 (25,'Sinhala aa',1),
 (26,'Sinhala xx',1),
 (27,'Axxxxax',1),
 (28,'Axxxxax11',1),
 (29,'0000000',1),
 (30,'asdfgh',1),
 (31,'bbbbbbbbbsdvv',1),
 (32,'tttyui',1),
 (33,'tyuio',1),
 (34,'tyuio',1),
 (35,'tyuio',1),
 (36,'tyuiopoo',1),
 (37,'sinhala lit',1),
 (38,'AAAAAA',1),
 (39,'qazwsx',1),
 (40,'nilllls',1),
 (41,'bandara',1),
 (42,'bandara1',1),
 (43,'PPPP',1),
 (44,'A11111111111',1),
 (45,'Qqqqqqqqqqqqq',1),
 (46,'Qqqqqqqqqqqqq',1),
 (47,'seg',1),
 (48,'awawaw',1),
 (49,'aefdsdvsd',1),
 (50,'asdsadasdasds',1),
 (51,'plmkijhhb',1),
 (52,'ghjkyui',1),
 (53,'nidha',1),
 (54,'dsvsd',1),
 (55,'asdaaaaaaaaaaaa',1),
 (56,'dadv',1),
 (57,'advsdvsdvsdv',1),
 (58,'addv',1),
 (59,'sdsdvsd',1),
 (60,'dvdsdv',1),
 (61,'pppppppp',1),
 (62,'pppppppp',1),
 (63,'ppppppppsa',1),
 (64,'SDV',1),
 (65,'OOOPPPOPO',1);
/*!40000 ALTER TABLE `alsubject_tbl` ENABLE KEYS */;


--
-- Definition of table `attendance_tbl`
--

DROP TABLE IF EXISTS `attendance_tbl`;
CREATE TABLE `attendance_tbl` (
  `StudentId` varchar(13) NOT NULL,
  `Date` date NOT NULL,
  `Time` time DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`Date`),
  KEY `FK_Attendance_tbl_Student_idx` (`StudentId`),
  CONSTRAINT `FK_Attendance_tbl_Student` FOREIGN KEY (`StudentId`) REFERENCES `student_tb` (`Student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance_tbl`
--

/*!40000 ALTER TABLE `attendance_tbl` DISABLE KEYS */;
INSERT INTO `attendance_tbl` (`StudentId`,`Date`,`Time`,`CreateUser`) VALUES 
 ('16HAL00001','2016-02-16','12:01:29',NULL),
 ('16HAL00002','2016-02-16','12:01:42',NULL),
 ('16KEL00001','2016-02-16','12:00:37',NULL),
 ('16KEL00001','2016-02-29','13:49:29',NULL),
 ('16KEL00002','2016-02-16','12:01:24',NULL),
 ('16KEL00003','2016-02-16','12:01:52',NULL);
/*!40000 ALTER TABLE `attendance_tbl` ENABLE KEYS */;


--
-- Definition of table `attendanceemployee_tbl`
--

DROP TABLE IF EXISTS `attendanceemployee_tbl`;
CREATE TABLE `attendanceemployee_tbl` (
  `Employee_tb_Emp_id` varchar(6) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Employee_tb_Emp_id`,`Date`,`Time`),
  KEY `fk_AttendanceEmployee_tbl_Employee_tb1_idx` (`Employee_tb_Emp_id`),
  CONSTRAINT `fk_AttendanceEmployee_tbl_Employee_tb1` FOREIGN KEY (`Employee_tb_Emp_id`) REFERENCES `employee_tb` (`Emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendanceemployee_tbl`
--

/*!40000 ALTER TABLE `attendanceemployee_tbl` DISABLE KEYS */;
INSERT INTO `attendanceemployee_tbl` (`Employee_tb_Emp_id`,`Date`,`Time`,`CreateUser`) VALUES 
 ('HAL001','2016-02-11','21:37:19',NULL),
 ('KEL001','2016-02-26','21:37:02',NULL),
 ('Pan001','2016-02-26','11:22:21','aaa');
/*!40000 ALTER TABLE `attendanceemployee_tbl` ENABLE KEYS */;


--
-- Definition of table `branch_tbl`
--

DROP TABLE IF EXISTS `branch_tbl`;
CREATE TABLE `branch_tbl` (
  `Branch_id` varchar(3) NOT NULL,
  `City` varchar(45) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `TP1` varchar(10) DEFAULT NULL,
  `TP2` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branch_tbl`
--

/*!40000 ALTER TABLE `branch_tbl` DISABLE KEYS */;
INSERT INTO `branch_tbl` (`Branch_id`,`City`,`Address`,`TP1`,`TP2`,`Email`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 ('AXA','Axa','Axa','0470001010','0774040404','illi@ili.illi','2016-02-24 14:54:05','Admin',1),
 ('HAL','Halawatha','No 10,\r\nMain Street,\r\nHalawatha.','0669850888','0605889888','halawatha@kelani.lk','2016-02-03 16:06:45','Admin',1),
 ('KEL','Kelaniya ','NO 216/3, Kandy Road, \r\nDhalugama,\r\nKelaniya.','0112589985','0112458800','kelaniya@kelani.lk','2016-01-27 15:11:33','Admin',1),
 ('PAN','Panadura','aaaa','0381650880','0385566655','03855666@uuiiu.com','2016-02-26 10:28:39','aaa',1);
/*!40000 ALTER TABLE `branch_tbl` ENABLE KEYS */;


--
-- Definition of table `course_tbl`
--

DROP TABLE IF EXISTS `course_tbl`;
CREATE TABLE `course_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_tbl`
--

/*!40000 ALTER TABLE `course_tbl` DISABLE KEYS */;
INSERT INTO `course_tbl` (`id`,`Name`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 (1,'BA','2016-02-01 10:17:10','Admin',1),
 (2,'BBmgt','2016-01-27 11:20:15','Admin',1),
 (3,'BCom','2016-01-27 11:20:06','Admin',1),
 (4,'Aa','2016-02-03 15:28:53','Admin',1),
 (5,'BA','2016-02-07 10:12:03','Admin',1),
 (6,'A','2016-02-12 23:27:47','Admin',1),
 (7,'Saaaa','2016-02-24 14:38:48','Admin',1),
 (8,'axxxxx','2016-02-26 10:30:53','aaa',1);
/*!40000 ALTER TABLE `course_tbl` ENABLE KEYS */;


--
-- Definition of table `courseprocess`
--

DROP TABLE IF EXISTS `courseprocess`;
CREATE TABLE `courseprocess` (
  `AcadamicYear_id` int(11) NOT NULL,
  `Course_tbl_id` int(11) NOT NULL,
  `Part_tbl_id` int(11) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`AcadamicYear_id`,`Course_tbl_id`,`Part_tbl_id`),
  KEY `fk_CourseProcess_AcadamicYear1_idx` (`AcadamicYear_id`),
  KEY `fk_CourseProcess_Course_tbl1_idx` (`Course_tbl_id`),
  KEY `fk_CourseProcess_Part_tbl1_idx` (`Part_tbl_id`),
  CONSTRAINT `fk_CourseProcess_AcadamicYear1` FOREIGN KEY (`AcadamicYear_id`) REFERENCES `acadamicyear` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CourseProcess_Course_tbl1` FOREIGN KEY (`Course_tbl_id`) REFERENCES `course_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_CourseProcess_Part_tbl1` FOREIGN KEY (`Part_tbl_id`) REFERENCES `part_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courseprocess`
--

/*!40000 ALTER TABLE `courseprocess` DISABLE KEYS */;
INSERT INTO `courseprocess` (`AcadamicYear_id`,`Course_tbl_id`,`Part_tbl_id`,`StartDate`,`EndDate`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 (1,1,7,'2015-10-01','2016-01-01','2016-02-11 10:13:55','Admin',1),
 (1,2,7,'2016-02-01','2016-10-18','2016-02-11 10:15:49','Admin',1),
 (3,2,8,'2016-02-18','2016-02-26','2016-02-11 10:16:25','Admin',1),
 (3,3,8,'2016-02-04','2016-02-25','2016-02-11 10:17:46','Admin',1),
 (6,1,7,'2015-10-01','2016-05-01','2016-02-15 09:07:37','Admin',1),
 (6,1,15,'2016-02-24','2016-02-27','2016-02-26 10:52:21','aaa',1),
 (6,3,7,'2016-02-01','2016-05-31','2016-02-29 14:19:59','aaa',1),
 (6,5,12,'2016-02-10','2017-03-10','2016-02-11 10:18:09','Admin',1);
/*!40000 ALTER TABLE `courseprocess` ENABLE KEYS */;


--
-- Definition of table `designation_tbl`
--

DROP TABLE IF EXISTS `designation_tbl`;
CREATE TABLE `designation_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation_tbl`
--

/*!40000 ALTER TABLE `designation_tbl` DISABLE KEYS */;
INSERT INTO `designation_tbl` (`id`,`Name`) VALUES 
 (1,'Manager'),
 (2,'Lecturer'),
 (3,'Cashier'),
 (4,'Data Entry'),
 (5,'Assistant '),
 (6,'AAAA'),
 (7,'ASA'),
 (8,'kolmk'),
 (9,'kolmk'),
 (10,'Apple');
/*!40000 ALTER TABLE `designation_tbl` ENABLE KEYS */;


--
-- Definition of table `district_tbl`
--

DROP TABLE IF EXISTS `district_tbl`;
CREATE TABLE `district_tbl` (
  `District_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`District_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district_tbl`
--

/*!40000 ALTER TABLE `district_tbl` DISABLE KEYS */;
INSERT INTO `district_tbl` (`District_ID`,`Name`,`CreateDate`,`CreateUser`) VALUES 
 (1,'Ampara','2016-01-01 00:00:00','Admin'),
 (2,'Anuradhapura','2016-01-01 00:00:00','Admin'),
 (3,'Badulla','2016-01-01 00:00:00','Admin'),
 (4,'Batticaloa','2016-01-01 00:00:00','Admin'),
 (5,'Colombo','2016-01-01 00:00:00','Admin'),
 (6,'Galle','2016-01-01 00:00:00','Admin'),
 (7,'Gampaha','2016-01-01 00:00:00','Admin'),
 (8,'Hambantota','2016-01-01 00:00:00','Admin'),
 (9,'Jaffna','2016-01-01 00:00:00','Admin'),
 (10,'Kalutara','2016-01-01 00:00:00','Admin'),
 (11,'Kandy','2016-01-01 00:00:00','Admin'),
 (12,'Kegalle','2016-01-01 00:00:00','Admin'),
 (13,'Kilinochchi','2016-01-01 00:00:00','Admin'),
 (14,'Kurunegala','2016-01-01 00:00:00','Admin'),
 (15,'Mannar','2016-01-01 00:00:00','Admin'),
 (16,'Matale','2016-01-01 00:00:00','Admin'),
 (17,'Matara','2016-01-01 00:00:00','Admin'),
 (18,'Moneragala','2016-01-01 00:00:00','Admin'),
 (19,'Mullaitivu','2016-01-01 00:00:00','Admin'),
 (20,'Nuwara Eliya','2016-01-01 00:00:00','Admin'),
 (21,'Polonnaruwa','2016-01-01 00:00:00','Admin'),
 (22,'Puttalam','2016-01-01 00:00:00','Admin'),
 (23,'Ratnapura','2016-01-01 00:00:00','Admin'),
 (24,'Trincomalee','2016-01-01 00:00:00','Admin'),
 (25,'Vavuniya','2016-01-01 00:00:00','Admin');
/*!40000 ALTER TABLE `district_tbl` ENABLE KEYS */;


--
-- Definition of table `employee_tb`
--

DROP TABLE IF EXISTS `employee_tb`;
CREATE TABLE `employee_tb` (
  `Emp_id` varchar(6) NOT NULL,
  `Branch_tbl_Branch_id` varchar(3) NOT NULL,
  `Designation_tbl_id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `NameInitial` varchar(100) DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `NIC` varchar(12) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `TP_home` varchar(10) DEFAULT NULL,
  `TP_mob` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Emp_id`),
  UNIQUE KEY `NIC_UNIQUE` (`NIC`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  KEY `fk_Employee_tb_Branch_tbl1_idx` (`Branch_tbl_Branch_id`),
  KEY `fk_Employee_tb_Designation_tbl1_idx` (`Designation_tbl_id`),
  CONSTRAINT `fk_Employee_tb_Branch_tbl1` FOREIGN KEY (`Branch_tbl_Branch_id`) REFERENCES `branch_tbl` (`Branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Employee_tb_Designation_tbl1` FOREIGN KEY (`Designation_tbl_id`) REFERENCES `designation_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_tb`
--

/*!40000 ALTER TABLE `employee_tb` DISABLE KEYS */;
INSERT INTO `employee_tb` (`Emp_id`,`Branch_tbl_Branch_id`,`Designation_tbl_id`,`Name`,`NameInitial`,`Gender`,`NIC`,`DOB`,`Address`,`TP_home`,`TP_mob`,`Email`,`Picture`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 ('AXA001','AXA',1,'axax','axax','M','121212121212','2016-02-10','jmj jh h','0110101010','0770410101','jum@gjijk.bon','1','2016-02-24 16:25:05','Admin',1),
 ('HAL001','HAL',2,'Kamal','joojo','M','899858989V','1970-01-01','45121jbj j','knkkn','0775479817','nishan4r@gmail.com','1','2016-02-11 15:42:50','Admin',1),
 ('HAL002','HAL',1,'Jagath','ilili','F','922390707V','1990-12-30','Aaaaa','1221212121','1212121212','ninn@gkm.vom','img/Employee/HAL002.jpg','2016-02-24 14:33:36','Admin',1),
 ('KEL001','KEL',2,'Kapila','kapila om','F','988560808V','1985-12-31','15jbbjmkmnkm \r\nmk, n,\r\nml,','0850000000','0778457877','nkl@inxm.com','1','2016-02-11 15:35:09','Admin',1),
 ('KEL002','KEL',2,'Amila','A M I L Aberathne','M','123456789000','1994-01-10','kniknkn\r\nmknknvkd\r\ndmvkdmvldmld','0772420000','0115101506','nini@lplmk.cm','img/Employee/KEL002.jpg','2016-02-24 14:18:48','Admin',1),
 ('PAN001','PAN',1,'Axaxax','Axscsc','M','922685858V','1989-12-31','iomk','nik','0777777777','ni@mkim0vom.vom','1','2016-02-26 10:57:26','aaa',1);
/*!40000 ALTER TABLE `employee_tb` ENABLE KEYS */;


--
-- Definition of table `examcenter_tbl`
--

DROP TABLE IF EXISTS `examcenter_tbl`;
CREATE TABLE `examcenter_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `ExamCenter_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examcenter_tbl`
--

/*!40000 ALTER TABLE `examcenter_tbl` DISABLE KEYS */;
INSERT INTO `examcenter_tbl` (`id`,`name`,`ExamCenter_status`) VALUES 
 (1,'Colombo',1),
 (2,'Puththalama',1),
 (3,'Panadura',1),
 (4,'Panadura',1),
 (5,'Aasxaaaaaa',1),
 (6,'Xaaaa',1),
 (7,'Aaaaaaaaaaaaa',1);
/*!40000 ALTER TABLE `examcenter_tbl` ENABLE KEYS */;


--
-- Definition of table `form_tbl`
--

DROP TABLE IF EXISTS `form_tbl`;
CREATE TABLE `form_tbl` (
  `FormID` varchar(6) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`FormID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_tbl`
--

/*!40000 ALTER TABLE `form_tbl` DISABLE KEYS */;
INSERT INTO `form_tbl` (`FormID`,`Name`) VALUES 
 ('alsubj','AL Subject'),
 ('branch','Branch Details'),
 ('coumng','Course Management'),
 ('coupro','Course Process'),
 ('desmng','Designation'),
 ('empath','Employee Attendance View'),
 ('empatt','Employee Attendance'),
 ('empmng','Employee Management'),
 ('expenc','Expenses'),
 ('exsece','Exam⁄Seminar Center'),
 ('lecpay','Lecturer Payment'),
 ('lecpyh','Lecture Payment History'),
 ('partmg','Part'),
 ('poldiv','Polling Divisions'),
 ('spform','Profit & Lost'),
 ('stuath','Student Attendance History'),
 ('stuatt','Student Attendance'),
 ('stuedt','Student Management'),
 ('stumng','Student Management'),
 ('stupay','Student Payment'),
 ('stupyh','Student Payment History'),
 ('stusub','Student Subjects'),
 ('stuviw','Student View'),
 ('subcou','Subject and Course Management'),
 ('submng','Subject Management'),
 ('usrmng','User'),
 ('usrviw','View User');
/*!40000 ALTER TABLE `form_tbl` ENABLE KEYS */;


--
-- Definition of table `lecturerpayment_tbl`
--

DROP TABLE IF EXISTS `lecturerpayment_tbl`;
CREATE TABLE `lecturerpayment_tbl` (
  `date` date NOT NULL,
  `Student_Subject_Course_tbl_id` int(11) NOT NULL,
  `Employee_tb_Emp_id` varchar(6) NOT NULL,
  `numberStudent` int(11) DEFAULT NULL,
  `subjectAmount` decimal(10,2) DEFAULT NULL,
  `commission` decimal(5,2) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `allowance` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `PayedDate` date DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT '1',
  PRIMARY KEY (`date`,`Student_Subject_Course_tbl_id`,`Employee_tb_Emp_id`),
  KEY `fk_LecturerPayment_tbl_Student_Subject_Course_tbl1_idx` (`Student_Subject_Course_tbl_id`),
  KEY `fk_LecturerPayment_tbl_Employee_tb1_idx` (`Employee_tb_Emp_id`),
  CONSTRAINT `fk_LecturerPayment_tbl_Employee_tb1` FOREIGN KEY (`Employee_tb_Emp_id`) REFERENCES `employee_tb` (`Emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_LecturerPayment_tbl_Student_Subject_Course_tbl1` FOREIGN KEY (`Student_Subject_Course_tbl_id`) REFERENCES `student_subject_course_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lecturerpayment_tbl`
--

/*!40000 ALTER TABLE `lecturerpayment_tbl` DISABLE KEYS */;
INSERT INTO `lecturerpayment_tbl` (`date`,`Student_Subject_Course_tbl_id`,`Employee_tb_Emp_id`,`numberStudent`,`subjectAmount`,`commission`,`salary`,`allowance`,`total`,`PayedDate`,`CreateUser`,`Status`) VALUES 
 ('2015-12-16',155,'KEL001',1,'300.00','5.00','15.00','5.00','20.00','2016-02-19','Admin',1),
 ('2016-01-16',155,'HAL001',1,'300.00','80.00','240.00','-40.00','200.00','2016-02-19','Admin',1),
 ('2016-02-16',155,'HAL001',1,'300.00','80.00','240.00','0.00','0.00','2016-02-24','Admin',1),
 ('2016-02-16',155,'KEL001',1,'300.00','80.00','240.00','-100.00','140.00','2016-02-24','Admin',1),
 ('2016-02-16',155,'KEL002',1,'300.00','70.00','210.00','40.00','250.00','2016-02-24','Admin',1),
 ('2016-02-16',158,'HAL001',1,'450.00','80.00','360.00','-100.00','260.00','2016-02-26','aaa',1),
 ('2016-02-16',160,'HAL001',1,'250.00','80.00','200.00','-100.00','100.00','2016-02-19','Admin',1),
 ('2016-02-16',166,'HAL001',1,'120.00','150.00','180.00','50.00','230.00','2016-02-26','aaa',1),
 ('2016-02-16',167,'KEL002',1,'120.00','50.00','60.00','60.00','120.00','2016-02-26','aaa',1);
/*!40000 ALTER TABLE `lecturerpayment_tbl` ENABLE KEYS */;


--
-- Definition of table `olqulification_tbl`
--

DROP TABLE IF EXISTS `olqulification_tbl`;
CREATE TABLE `olqulification_tbl` (
  `Index_no` varchar(10) NOT NULL,
  `Year` int(4) DEFAULT NULL,
  `Pass` int(1) DEFAULT NULL,
  `English_grade` varchar(1) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `OLQulification__status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Index_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `olqulification_tbl`
--

/*!40000 ALTER TABLE `olqulification_tbl` DISABLE KEYS */;
INSERT INTO `olqulification_tbl` (`Index_no`,`Year`,`Pass`,`English_grade`,`CreateDate`,`CreateUser`,`OLQulification__status`) VALUES 
 ('01250000',2008,1,'B','2016-02-06 12:25:28','Admin',1),
 ('0450141100',0,1,'A','2016-02-29 12:50:41','aaa',1),
 ('1111111111',2016,1,'B','2016-02-06 15:40:03','Admin',1),
 ('1212222222',2016,1,'B','2016-02-29 11:18:54',NULL,1),
 ('122',2008,1,'B','2016-02-06 09:54:41','Admin',1),
 ('1225000000',2016,1,'B','2016-02-11 15:14:15','Admin',1),
 ('1233333333',2016,1,'B','2016-02-11 11:03:43','Admin',1),
 ('1234567890',2010,1,'C','2016-02-06 15:45:29','Admin',1),
 ('1478520125',20015,1,'B','2016-02-06 15:59:00','Admin',1),
 ('4512111111',0,1,'B','2016-02-12 11:13:33','Admin',1),
 ('4521002000',2008,1,'B','2016-02-15 16:52:30','Admin',1),
 ('7895121100',1216,1,'B','2016-02-12 10:54:52','Admin',1),
 ('9999999999',2008,1,'B','2016-02-05 10:37:38','Admin',1);
/*!40000 ALTER TABLE `olqulification_tbl` ENABLE KEYS */;


--
-- Definition of table `otherexpenses_tbl`
--

DROP TABLE IF EXISTS `otherexpenses_tbl`;
CREATE TABLE `otherexpenses_tbl` (
  `esp` varchar(10) NOT NULL,
  `InvoiceNumber` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `SuplierName` varchar(100) DEFAULT NULL,
  `Des` varchar(200) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`esp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otherexpenses_tbl`
--

/*!40000 ALTER TABLE `otherexpenses_tbl` DISABLE KEYS */;
INSERT INTO `otherexpenses_tbl` (`esp`,`InvoiceNumber`,`Date`,`Time`,`SuplierName`,`Des`,`Amount`,`CreateUser`,`Status`) VALUES 
 ('ESP0000001','5102','2016-02-18','00:11:01','512032hb j jk ','j j lkk  ','10.00','Admin',1),
 ('ESP0000002','00000000000000000000','2016-02-26','00:16:19','nnk l','5120','10000.00','Admin',1),
 ('ESP0000003','65 knkKL','2016-02-05','00:18:51','olmp; kl4522 512102020 63125','olmo','62512.00','Admin',1),
 ('ESP0000004','51251515','2016-12-31','12:18:55','ujbjjb','ibujnnjkn','10000.00','Admin',1),
 ('ESP0000005','51251515','2016-12-31','12:19:06','ujbjjb','ibujnnjkn','10000000.00','Admin',1),
 ('ESP0000006','2621323','2016-02-03','09:41:42','Slml','jnkl ,k n kl ','65000.00','Admin',1),
 ('ESP0000007','','2016-02-19','09:42:47','','rjyjuku','10000.00','Admin',1),
 ('ESP0000008','','2016-02-19','09:42:47','','rjyjuku','10000.00','Admin',1),
 ('ESP0000009','','2016-02-19','09:42:47','','rjyjuku','10000.00','Admin',1),
 ('ESP0000010','','2016-02-08','16:38:42','','asas','100.00','Admin',1),
 ('ESP0000011','','2016-02-08','16:38:42','','asas','100.00','Admin',1),
 ('ESP0000012','00855','2016-02-22','12:18:45','mjini','iiniin','150000.00','aaa',1);
/*!40000 ALTER TABLE `otherexpenses_tbl` ENABLE KEYS */;


--
-- Definition of table `otherqulification_tbl`
--

DROP TABLE IF EXISTS `otherqulification_tbl`;
CREATE TABLE `otherqulification_tbl` (
  `QulificationID` varchar(5) NOT NULL,
  `Name` varchar(150) DEFAULT NULL,
  `Institute` varchar(150) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Grade` varchar(45) DEFAULT NULL,
  `Year` int(4) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Student_tb_Student_id` varchar(13) NOT NULL,
  PRIMARY KEY (`QulificationID`),
  KEY `fk_OtherQulification_tbl_Student_tb1_idx` (`Student_tb_Student_id`),
  CONSTRAINT `fk_OtherQulification_tbl_Student_tb1` FOREIGN KEY (`Student_tb_Student_id`) REFERENCES `student_tb` (`Student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `otherqulification_tbl`
--

/*!40000 ALTER TABLE `otherqulification_tbl` DISABLE KEYS */;
INSERT INTO `otherqulification_tbl` (`QulificationID`,`Name`,`Institute`,`Subject`,`Grade`,`Year`,`CreateDate`,`CreateUser`,`Student_tb_Student_id`) VALUES 
 ('10','aaa','Wijaya Graphic','aaa','A A A',2000,'2016-02-29 12:50:42','aaa','16PAN00001'),
 ('4','Diploma in Graphic Design','Wijaya Graphic','Ps, In ,iL, ','A A A',2000,'2016-02-11 11:03:44','Admin','16KEL00001'),
 ('5','Iojn','okoko','oko','A',6644,'2016-02-11 15:14:16','Admin','16KEL00002'),
 ('6','Jijijin ','ojmml','ok n ','ko ',8555,'2016-02-12 10:54:52','Admin','16HAL00001'),
 ('7','Diploma in Graphic Design','Wijaya Graphic','Ps, In ,iL, ','A A A',2015,'2016-02-12 11:17:11','Admin','16HAL00002'),
 ('8','nklll','kooo','2016','12',2016,'2016-02-15 16:52:31','Admin','16KEL00003'),
 ('9','Diploma in Graphic Design','Wijaya Graphic','aaa bb','A A A',2000,'2016-02-29 11:18:55',NULL,'16HAL00003');
/*!40000 ALTER TABLE `otherqulification_tbl` ENABLE KEYS */;


--
-- Definition of table `part_tbl`
--

DROP TABLE IF EXISTS `part_tbl`;
CREATE TABLE `part_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_tbl`
--

/*!40000 ALTER TABLE `part_tbl` DISABLE KEYS */;
INSERT INTO `part_tbl` (`id`,`name`) VALUES 
 (7,'P1 A'),
 (8,'P1 B'),
 (11,'P2'),
 (12,'P3'),
 (13,'P12'),
 (14,'P 16'),
 (15,'5652s');
/*!40000 ALTER TABLE `part_tbl` ENABLE KEYS */;


--
-- Definition of table `payment_detail_tbl`
--

DROP TABLE IF EXISTS `payment_detail_tbl`;
CREATE TABLE `payment_detail_tbl` (
  `Payment_tbl_InvoiceNo` varchar(10) NOT NULL,
  `Student_Subject_Course_tbl_id` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `PaidAmount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Payment_tbl_InvoiceNo`,`Student_Subject_Course_tbl_id`),
  KEY `fk_Payment_tbl_has_Student_Subject_Course_tbl_Student_Subje_idx` (`Student_Subject_Course_tbl_id`),
  KEY `fk_Payment_tbl_has_Student_Subject_Course_tbl_Payment_tbl1_idx` (`Payment_tbl_InvoiceNo`),
  CONSTRAINT `fk_Payment_tbl_has_Student_Subject_Course_tbl_Payment_tbl1` FOREIGN KEY (`Payment_tbl_InvoiceNo`) REFERENCES `payment_tbl` (`InvoiceNo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Payment_tbl_has_Student_Subject_Course_tbl_Student_Subject1` FOREIGN KEY (`Student_Subject_Course_tbl_id`) REFERENCES `student_subject_course_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_detail_tbl`
--

/*!40000 ALTER TABLE `payment_detail_tbl` DISABLE KEYS */;
INSERT INTO `payment_detail_tbl` (`Payment_tbl_InvoiceNo`,`Student_Subject_Course_tbl_id`,`Date`,`Price`,`PaidAmount`) VALUES 
 ('INV0000001',158,'2016-01-17','450.00','450.00'),
 ('INV0000001',159,'2016-01-17','300.00','300.00'),
 ('INV0000001',160,'2016-01-17','250.00','250.00'),
 ('INV0000001',161,'2016-01-17','100.00','100.00'),
 ('INV0000002',158,'2016-04-01','450.00','450.00'),
 ('INV0000002',159,'2016-04-01','300.00','300.00'),
 ('INV0000002',160,'2016-04-01','250.00','250.00'),
 ('INV0000002',161,'2016-04-01','100.00','100.00'),
 ('INV0000003',158,'2016-02-29','450.00','450.00'),
 ('INV0000003',159,'2016-02-29','300.00','300.00'),
 ('INV0000003',160,'2016-02-29','250.00','250.00'),
 ('INV0000003',161,'2016-02-29','100.00','100.00'),
 ('INV0000004',158,'2016-02-29','450.00','450.00'),
 ('INV0000004',159,'2016-02-29','300.00','300.00'),
 ('INV0000004',160,'2016-02-29','250.00','250.00'),
 ('INV0000004',161,'2016-02-29','100.00','100.00');
/*!40000 ALTER TABLE `payment_detail_tbl` ENABLE KEYS */;


--
-- Definition of table `payment_tbl`
--

DROP TABLE IF EXISTS `payment_tbl`;
CREATE TABLE `payment_tbl` (
  `InvoiceNo` varchar(10) NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Discount` decimal(10,2) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL,
  `Settle` decimal(10,2) DEFAULT NULL,
  `Balance` decimal(10,2) DEFAULT NULL,
  `DueAmount` decimal(10,2) DEFAULT NULL,
  `Student_tb_Student_id` varchar(13) NOT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT '0',
  PRIMARY KEY (`InvoiceNo`),
  KEY `fk_Payment_tbl_Student_tb1_idx` (`Student_tb_Student_id`),
  CONSTRAINT `fk_Payment_tbl_Student_tb1` FOREIGN KEY (`Student_tb_Student_id`) REFERENCES `student_tb` (`Student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_tbl`
--

/*!40000 ALTER TABLE `payment_tbl` DISABLE KEYS */;
INSERT INTO `payment_tbl` (`InvoiceNo`,`Date`,`Time`,`Total`,`Discount`,`SubTotal`,`Settle`,`Balance`,`DueAmount`,`Student_tb_Student_id`,`CreateUser`,`Status`) VALUES 
 ('INV0000001','2016-01-17','12:15:39','1100.00','0.00','1100.00','500.00','-600.00','600.00','16KEL00001','Admin',1),
 ('INV0000002','2016-04-01','12:19:22','2800.00','0.00','2800.00','3000.00','200.00','0.00','16KEL00001','Admin',1),
 ('INV0000003','2016-01-29','13:38:55','1100.00','0.00','1100.00','1100.00','0.00','0.00','16KEL00001','Admin',1),
 ('INV0000004','2016-02-29','13:43:05','1100.00','0.00','1100.00','1100.00','0.00','0.00','16KEL00001','aaa',1);
/*!40000 ALTER TABLE `payment_tbl` ENABLE KEYS */;


--
-- Definition of table `polling_devition_tbl`
--

DROP TABLE IF EXISTS `polling_devition_tbl`;
CREATE TABLE `polling_devition_tbl` (
  `Polling_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Polling_devition_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Polling_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `polling_devition_tbl`
--

/*!40000 ALTER TABLE `polling_devition_tbl` DISABLE KEYS */;
INSERT INTO `polling_devition_tbl` (`Polling_ID`,`Name`,`CreateDate`,`CreateUser`,`Polling_devition_status`) VALUES 
 (1,'Colombo Central','2016-01-27 16:02:30','Admin',1),
 (2,'Colombo Central','2016-01-27 16:03:14','Admin',1),
 (3,'Colombo North','2016-01-27 16:04:53','Admin',1),
 (4,'Mathara','2016-01-28 15:23:55','Admin',1),
 (5,'Colombo West','2016-01-29 13:26:53','Admin',1),
 (6,'Axxxxxax','2016-02-24 16:49:17','Admin',1),
 (7,'Apple','2016-02-29 11:09:48','aaa',1);
/*!40000 ALTER TABLE `polling_devition_tbl` ENABLE KEYS */;


--
-- Definition of table `privileges_tbl`
--

DROP TABLE IF EXISTS `privileges_tbl`;
CREATE TABLE `privileges_tbl` (
  `UserLevel_tbl_id` int(11) NOT NULL,
  `Form_tbl_FormID` varchar(6) NOT NULL,
  `R` int(11) DEFAULT NULL,
  `W` int(11) DEFAULT NULL,
  `D` int(11) DEFAULT NULL,
  KEY `fk_Privileges_tbl_Form_tbl1_idx` (`Form_tbl_FormID`),
  KEY `fk_Privileges_tbl_UserLevel_tbl1_idx` (`UserLevel_tbl_id`),
  CONSTRAINT `fk_Privileges_tbl_Form_tbl1` FOREIGN KEY (`Form_tbl_FormID`) REFERENCES `form_tbl` (`FormID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Privileges_tbl_UserLevel_tbl1` FOREIGN KEY (`UserLevel_tbl_id`) REFERENCES `userlevel_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges_tbl`
--

/*!40000 ALTER TABLE `privileges_tbl` DISABLE KEYS */;
INSERT INTO `privileges_tbl` (`UserLevel_tbl_id`,`Form_tbl_FormID`,`R`,`W`,`D`) VALUES 
 (1,'alsubj',1,1,1),
 (1,'branch',1,1,0);
/*!40000 ALTER TABLE `privileges_tbl` ENABLE KEYS */;


--
-- Definition of table `student_subject_course_tbl`
--

DROP TABLE IF EXISTS `student_subject_course_tbl`;
CREATE TABLE `student_subject_course_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_tb_Student_id` varchar(13) DEFAULT NULL,
  `AcadamicYear` varchar(45) DEFAULT NULL,
  `Subject_Course_tbl_Course_tbl_id` int(11) NOT NULL,
  `Subject_Course_tbl_Part_table_id` int(11) NOT NULL,
  `Subject_Course_tbl_Subject_tbl_id` int(11) NOT NULL,
  `Part` varchar(45) DEFAULT NULL,
  `Price` decimal(7,2) DEFAULT NULL,
  `Grade` varchar(6) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_Student_tb_has_Subject_Course_tbl_Student_tb1_idx` (`Student_tb_Student_id`),
  KEY `fk_Student_Subject_Course_Subject_Course_tbl1_idx` (`Subject_Course_tbl_Subject_tbl_id`,`Subject_Course_tbl_Course_tbl_id`,`Subject_Course_tbl_Part_table_id`),
  CONSTRAINT `fk_Student_Subject_Course_Subject_Course_tbl1` FOREIGN KEY (`Subject_Course_tbl_Subject_tbl_id`, `Subject_Course_tbl_Course_tbl_id`, `Subject_Course_tbl_Part_table_id`) REFERENCES `subject_course_tbl` (`Subject_tbl_id`, `Course_tbl_id`, `Part_table_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_has_Subject_Course_tbl_Student_tb1` FOREIGN KEY (`Student_tb_Student_id`) REFERENCES `student_tb` (`Student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_subject_course_tbl`
--

/*!40000 ALTER TABLE `student_subject_course_tbl` DISABLE KEYS */;
INSERT INTO `student_subject_course_tbl` (`id`,`Student_tb_Student_id`,`AcadamicYear`,`Subject_Course_tbl_Course_tbl_id`,`Subject_Course_tbl_Part_table_id`,`Subject_Course_tbl_Subject_tbl_id`,`Part`,`Price`,`Grade`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 (154,'16HAL00001','2016',1,7,28,'P1 A','450.00','O','2016-02-15 10:09:02','Admin',1),
 (155,'16HAL00001','2016',1,7,29,'P1 A','300.00','O','2016-02-15 10:09:02','Admin',1),
 (156,'16HAL00001','2016',1,7,30,'P1 A','250.00','O','2016-02-15 10:09:02','Admin',1),
 (157,'16HAL00001','2016',1,7,32,'P1 A','100.00','O','2016-02-15 10:09:03','Admin',1),
 (158,'16KEL00001','2016',1,7,28,'P1 A','450.00','O','2016-02-15 10:09:26','Admin',1),
 (159,'16KEL00001','2016',1,7,29,'P1 A','300.00','O','2016-02-15 10:09:26','Admin',1),
 (160,'16KEL00001','2016',1,7,30,'P1 A','250.00','O','2016-02-15 10:09:26','Admin',1),
 (161,'16KEL00001','2016',1,7,32,'P1 A','100.00','O','2016-02-15 10:09:27','Admin',1),
 (162,'16KEL00002','2016',1,7,28,'P1 A','450.00','O','2016-02-15 10:40:01','Admin',1),
 (163,'16KEL00002','2016',1,7,29,'P1 A','300.00','O','2016-02-15 10:40:01','Admin',1),
 (164,'16KEL00002','2016',1,7,30,'P1 A','250.00','O','2016-02-15 10:40:01','Admin',1),
 (165,'16KEL00002','2016',1,7,32,'P1 A','100.00','O','2016-02-15 10:40:01','Admin',1),
 (166,'16HAL00002','2016',1,8,31,'P1 B','120.00','O','2016-02-15 16:03:55','Admin',0),
 (167,'16HAL00002','2016',1,8,31,'P1 B','120.00','O','2016-02-24 11:25:09','Admin',0),
 (168,'16PAN00001','2016',3,7,13,'P1 A','500.00','A plus','2016-02-29 14:18:28','aaa',0),
 (169,'16PAN00001','2016',3,7,14,'P1 A','500.00','O','2016-02-29 14:18:28','aaa',1),
 (170,'16PAN00001','2016',3,7,16,'P1 A','500.00','O','2016-02-29 14:18:28','aaa',1);
/*!40000 ALTER TABLE `student_subject_course_tbl` ENABLE KEYS */;


--
-- Definition of table `student_tb`
--

DROP TABLE IF EXISTS `student_tb`;
CREATE TABLE `student_tb` (
  `Branch_tbl_Branch_id` varchar(3) NOT NULL,
  `Student_id` varchar(13) NOT NULL,
  `Old_student_id` varchar(13) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Name` varchar(150) DEFAULT NULL,
  `NIC` varchar(12) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Address1` varchar(255) DEFAULT NULL,
  `Address2` varchar(255) DEFAULT NULL,
  `Nationality` varchar(45) DEFAULT NULL,
  `TP_Home` varchar(10) DEFAULT NULL,
  `TP_Office` varchar(10) DEFAULT NULL,
  `TP_mob` varchar(10) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Reg_Date` date DEFAULT NULL,
  `Signature` varchar(100) DEFAULT NULL,
  `Picture` varchar(100) DEFAULT NULL,
  `District_tbl_District_ID` int(11) NOT NULL,
  `Polling_devition_tbl_Polling_ID` int(11) NOT NULL,
  `Course_tbl_Course_ID` varchar(10) NOT NULL,
  `Medium` varchar(1) DEFAULT NULL,
  `ExamCenter_tbl_id` int(11) NOT NULL,
  `OLQulification_tbl_Index_no` varchar(10) NOT NULL,
  `ALQulification_tbl_Index_no` varchar(10) NOT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Student_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Student_id`),
  UNIQUE KEY `NIC_UNIQUE` (`NIC`),
  UNIQUE KEY `TP_mob_UNIQUE` (`TP_mob`),
  KEY `fk_Student_tb_District_tbl_idx` (`District_tbl_District_ID`),
  KEY `fk_Student_tb_Polling_devition_tbl1_idx` (`Polling_devition_tbl_Polling_ID`),
  KEY `fk_Student_tb_OLQulification_tbl1_idx` (`OLQulification_tbl_Index_no`),
  KEY `fk_Student_tb_ALQulification_tbl1_idx` (`ALQulification_tbl_Index_no`),
  KEY `fk_Student_tb_Branch_tbl1_idx` (`Branch_tbl_Branch_id`),
  KEY `fk_Student_tb_ExamCenter_tbl1_idx` (`ExamCenter_tbl_id`),
  CONSTRAINT `fk_Student_tb_ALQulification_tbl1` FOREIGN KEY (`ALQulification_tbl_Index_no`) REFERENCES `alqulification_tbl` (`Index_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_Branch_tbl1` FOREIGN KEY (`Branch_tbl_Branch_id`) REFERENCES `branch_tbl` (`Branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_District_tbl` FOREIGN KEY (`District_tbl_District_ID`) REFERENCES `district_tbl` (`District_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_ExamCenter_tbl1` FOREIGN KEY (`ExamCenter_tbl_id`) REFERENCES `examcenter_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_OLQulification_tbl1` FOREIGN KEY (`OLQulification_tbl_Index_no`) REFERENCES `olqulification_tbl` (`Index_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Student_tb_Polling_devition_tbl1` FOREIGN KEY (`Polling_devition_tbl_Polling_ID`) REFERENCES `polling_devition_tbl` (`Polling_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_tb`
--

/*!40000 ALTER TABLE `student_tb` DISABLE KEYS */;
INSERT INTO `student_tb` (`Branch_tbl_Branch_id`,`Student_id`,`Old_student_id`,`FullName`,`Name`,`NIC`,`DOB`,`Gender`,`Address1`,`Address2`,`Nationality`,`TP_Home`,`TP_Office`,`TP_mob`,`Email`,`Reg_Date`,`Signature`,`Picture`,`District_tbl_District_ID`,`Polling_devition_tbl_Polling_ID`,`Course_tbl_Course_ID`,`Medium`,`ExamCenter_tbl_id`,`OLQulification_tbl_Index_no`,`ALQulification_tbl_Index_no`,`CreateDate`,`CreateUser`,`Student_status`) VALUES 
 ('HAL','16HAL00001','1542202222222','Janaka Wikramasinghe','J Wikramasinghe','988586205V','1990-12-31','M','Kurunagala','Gampaha','other','0780000000','0778000000','0778877888','aaaa@hhi.com','2016-12-31','img/Signature/16HAL00001.jpg','img/Student/16HAL00001.jpg',2,3,'0','E',2,'7895121100','0485400000','2016-02-12 10:54:52','Admin',1),
 ('HAL','16HAL00002','9841515151000','Shalini Senananayake','Shalini Senananayake','9555555555','1980-12-31','F','Badulla','Jkok  ','SriLankan','0775555555','0775500000','0778550000','jjo@gmail.com','2016-12-31','img/Signature/16HAL00002.jpg','img/Student/16HAL00002.jpg',1,2,'0','S',1,'4512111111','2310002500','2016-02-12 11:17:11','Admin',1),
 ('HAL','16HAL00003','0485105101411','Kamal Addaraarachchi','Kamal Addaraarachchi','121585085401','1976-12-31','M','xlmklml\r\nll;\';\',;,\r\nllml','jikjnik\r\nnjknokj\r\nnikn','other','0112620500','0150950950','0582055909','miji@nuuj.com','2015-12-31','img/Signature/16HAL00003.jpg','img/Student/16HAL00003.jpg',2,4,'0','S',3,'1212222222','7848484840','2016-02-29 11:18:54',NULL,1),
 ('KEL','16KEL00001','123444','Namal Munasinghe','N Munasinghe','922690707V','1992-12-31','M','Moratuwa','Panadura','other','0112586895','0385598888','0779856120','namal@gmail.com','2016-12-31','img/Signature/16KEL00001.jpg','img/Student/16KEL00001.jpg',2,4,'0','S',2,'1233333333','0111111111','2016-02-11 11:03:44','Admin',1),
 ('KEL','16KEL00002','123589','Amal  Perise','Amal  Perise','988658787V','1992-12-30','M','Pamankada','Ambepusse','other','0778888888','0407777777','0778521500','amal@gmail.com','2016-12-31','img/Signature/16KEL00002.jpg','img/Student/16KEL00002.jpg',2,5,'0','S',3,'1225000000','4784500000','2016-02-11 15:14:16','Admin',1),
 ('KEL','16KEL00003','1235125200202','Nimal silva','Nimal Silva Liyanage','988451205120','1998-12-31','M','Kollupitiya','Kollupitiya','other','0116520052','0111612050','0155020581','NHIKN@HUKN.ONN','2016-01-31','img/Signature/16KEL00003.jpg','img/Student/16KEL00003.jpg',2,3,'0','E',2,'4521002000','6323000000','2016-02-15 16:52:31','Admin',1),
 ('PAN','16PAN00001','0000000000000','Panadura Panadura','P Panadura','548408408480','1980-12-31','M','PanaduraPanadura','PanaduraPanadura','other','0116260000','0775500000','0715555555','njnkk@oijoml.mmm','2015-12-31','img/Signature/16PAN00001.jpg','img/Student/16PAN00001.jpg',1,3,'0','S',1,'0450141100','4880000000','2016-02-29 12:50:42','aaa',1);
/*!40000 ALTER TABLE `student_tb` ENABLE KEYS */;


--
-- Definition of table `subject_course_tbl`
--

DROP TABLE IF EXISTS `subject_course_tbl`;
CREATE TABLE `subject_course_tbl` (
  `AcadamicYear_id` int(11) NOT NULL,
  `Course_tbl_id` int(11) NOT NULL,
  `Part_table_id` int(11) NOT NULL,
  `Subject_tbl_id` int(11) NOT NULL,
  `Price` decimal(7,2) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Course_tbl_id`,`Part_table_id`,`Subject_tbl_id`,`AcadamicYear_id`),
  KEY `fk_Subject_tbl_has_Course_tbl_Course_tbl1_idx` (`Course_tbl_id`),
  KEY `fk_Subject_tbl_has_Course_tbl_Subject_tbl1_idx` (`Subject_tbl_id`),
  KEY `fk_Subject_Course_tbl_Part_table1_idx` (`Part_table_id`),
  KEY `fk_Subject_Course_tbl_AcadamicYear1_idx` (`AcadamicYear_id`),
  CONSTRAINT `fk_Subject_Course_tbl_AcadamicYear1` FOREIGN KEY (`AcadamicYear_id`) REFERENCES `acadamicyear` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Subject_Course_tbl_Part_table1` FOREIGN KEY (`Part_table_id`) REFERENCES `part_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Subject_tbl_has_Course_tbl_Course_tbl1` FOREIGN KEY (`Course_tbl_id`) REFERENCES `course_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Subject_tbl_has_Course_tbl_Subject_tbl1` FOREIGN KEY (`Subject_tbl_id`) REFERENCES `subject_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_course_tbl`
--

/*!40000 ALTER TABLE `subject_course_tbl` DISABLE KEYS */;
INSERT INTO `subject_course_tbl` (`AcadamicYear_id`,`Course_tbl_id`,`Part_table_id`,`Subject_tbl_id`,`Price`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 (6,1,7,28,'450.00','2016-02-02 11:30:46','Admin',1),
 (6,1,7,29,'300.00','2016-02-02 11:47:27','Admin',1),
 (6,1,7,30,'250.00','2016-02-02 11:47:40','Admin',1),
 (6,1,7,32,'100.00','2016-02-02 11:54:24','Admin',1),
 (6,1,7,33,'550.00','2016-02-02 11:53:51','Admin',1),
 (6,1,7,36,'600.00','2016-02-02 11:55:02','Admin',1),
 (6,1,7,37,'140.00','2016-02-02 11:55:21','Admin',1),
 (6,1,7,38,'255.00','2016-02-02 11:55:57','Admin',1),
 (6,1,7,39,'880.00','2016-02-02 11:56:10','Admin',1),
 (6,1,8,31,'120.00','2016-02-02 11:53:06','Admin',1),
 (1,2,7,28,'100.00','2016-02-24 15:08:38','Admin',1),
 (6,3,7,13,'500.00','2016-02-05 19:30:35','Admin',1),
 (6,3,7,14,'500.00','2016-02-05 19:30:53','Admin',1),
 (6,3,7,15,'500.00','2016-02-05 19:31:16','Admin',1),
 (6,3,7,16,'500.00','2016-02-05 19:31:33','Admin',1),
 (6,3,8,22,'150.00','2016-02-11 12:04:25','Admin',1),
 (6,3,11,21,'500.00','2016-02-11 12:05:28','Admin',1),
 (6,3,11,22,'450.00','2016-02-11 12:05:39','Admin',1),
 (6,3,11,23,'650.00','2016-02-11 12:05:48','Admin',1),
 (6,3,11,27,'650.00','2016-02-11 12:06:14','Admin',1),
 (6,8,14,23,'1500.00','2016-02-26 10:33:52','aaa',1);
/*!40000 ALTER TABLE `subject_course_tbl` ENABLE KEYS */;


--
-- Definition of table `subject_tbl`
--

DROP TABLE IF EXISTS `subject_tbl`;
CREATE TABLE `subject_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectname` varchar(100) DEFAULT NULL,
  `Subjectcode` varchar(10) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_tbl`
--

/*!40000 ALTER TABLE `subject_tbl` DISABLE KEYS */;
INSERT INTO `subject_tbl` (`id`,`subjectname`,`Subjectcode`,`CreateDate`,`CreateUser`,`Status`) VALUES 
 (13,'Business Accounting ','BSAC','2016-02-01 10:23:59','Admin',1),
 (14,'Business Communication  ','BSCM','2016-02-01 10:24:37','Admin',1),
 (15,'Business Economic ','BSEC','2016-02-01 10:24:59','Admin',1),
 (16,'Business Law','BSLW','2016-02-01 10:25:16','Admin',1),
 (17,'Costing Accounting','CSAC','2016-02-01 10:25:39','Admin',1),
 (18,'Human Resours Management ','HRM','2016-02-01 10:26:21','Admin',1),
 (19,'Marketing','MRK','2016-02-01 10:26:31','Admin',1),
 (20,'Information Technology ','IT','2016-02-01 10:26:46','Admin',1),
 (21,'OTP','OTP','2016-02-01 10:26:57','Admin',1),
 (22,'Financial Accounting','FIAC','2016-02-01 10:27:09','Admin',1),
 (23,'Operations Management','OPMG','2016-02-01 10:27:27','Admin',1),
 (24,'Organizational Behavior','ORBV','2016-02-01 10:27:41','Admin',1),
 (25,'Strategic Management','STMG','2016-02-01 10:41:23','Admin',1),
 (26,'Research Management','REMG','2016-02-01 10:41:39','Admin',1),
 (27,'Total Quality Management','TQMG','2016-02-01 10:41:55','Admin',1),
 (28,'Archaeology','ARCH ','2016-02-01 10:42:40','Admin',1),
 (29,'Buddhist Culture','BUCU','2016-02-01 10:42:59','Admin',1),
 (30,'Buddhist Philosophy','BUPH','2016-02-01 10:43:13','Admin',1),
 (31,'Christian Culture','CHCU','2016-02-01 10:43:28','Admin',1),
 (32,'Development Studies','DVST','2016-02-01 10:43:43','Admin',1),
 (33,'Drama','DMAT','2016-02-01 10:43:56','Admin',1),
 (34,'Economics','ECON','2016-02-01 10:44:13','Admin',1),
 (35,'English','ENGL','2016-02-01 10:44:58','Admin',1),
 (36,'French','FREN','2016-02-01 10:45:20','Admin',1),
 (37,'Geography','GEOG','2016-02-01 10:45:43','Admin',1),
 (38,'German','GERM','2016-02-01 10:45:55','Admin',1),
 (39,'Hindi','HIND','2016-02-01 10:49:35','Admin',1),
 (40,'History','HIST','2016-02-01 10:50:55','Admin',1),
 (41,'Image Art','IMAT','2016-02-01 10:51:11','Admin',1),
 (42,'International Relations','INST','2016-02-01 10:51:25','Admin',1),
 (43,'Japanese','JAPA','2016-02-01 10:51:36','Admin',1),
 (44,'Language Translation Methods','TRMD','2016-02-01 10:51:52','Admin',1),
 (45,'Library & Information Science','LISC','2016-02-01 10:52:19','Admin',1),
 (46,'Mass Communication','MACO','2016-02-01 10:52:31','Admin',1),
 (47,'Performance Art','PART','2016-02-01 10:52:43','Admin',1),
 (48,'Philosophy','PHIL','2016-02-01 10:52:56','Admin',1),
 (49,'Physiology','PSYC','2016-02-01 10:53:16','Admin',1),
 (50,'Political Science','POLS','2016-02-01 10:53:29','Admin',1),
 (51,'Sinhala','SINH','2016-02-01 10:53:43','Admin',1),
 (52,'Social Statistics','SOST','2016-02-01 10:53:56','Admin',1),
 (53,'Sociology','SOCI','2016-02-01 10:54:09','Admin',1),
 (54,'Tourism Management','TCRM','2016-02-01 10:57:17','Admin',1),
 (55,'Visual Arts','VIAT','2016-02-01 10:57:29','Admin',1),
 (56,'Aaaaa','AAA','2016-02-03 09:43:26','Admin',1),
 (57,'iiii','iiiii','2016-02-15 13:31:40','Admin',1),
 (58,'Bio','SIN','2016-02-15 14:44:38','Admin',1),
 (59,'Avvvvv','AVVV','2016-02-15 16:38:31','Admin',1),
 (60,'','Subject ','2016-02-23 20:37:22','Admin',1),
 (61,'Subject ','','2016-02-23 20:37:29','Admin',1),
 (62,'','Subject ','2016-02-23 20:37:33','Admin',1),
 (63,'AXSA','Axsasa','2016-02-24 14:49:04','Admin',1),
 (64,'SAXS','Sinhalix','2016-02-29 15:00:29','aaa',1);
/*!40000 ALTER TABLE `subject_tbl` ENABLE KEYS */;


--
-- Definition of table `tempalsubject_tbl`
--

DROP TABLE IF EXISTS `tempalsubject_tbl`;
CREATE TABLE `tempalsubject_tbl` (
  `SubjectID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `ALSubject_status` int(11) DEFAULT NULL,
  `Grade` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`SubjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tempalsubject_tbl`
--

/*!40000 ALTER TABLE `tempalsubject_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tempalsubject_tbl` ENABLE KEYS */;


--
-- Definition of table `tempamount_tbl`
--

DROP TABLE IF EXISTS `tempamount_tbl`;
CREATE TABLE `tempamount_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tempamount_tbl`
--

/*!40000 ALTER TABLE `tempamount_tbl` DISABLE KEYS */;
INSERT INTO `tempamount_tbl` (`id`,`amount`) VALUES 
 (1,'125.00');
/*!40000 ALTER TABLE `tempamount_tbl` ENABLE KEYS */;


--
-- Definition of table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE `user_tbl` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `UserLevel_tbl_id` int(11) NOT NULL,
  `Emp_id` varchar(6) DEFAULT NULL,
  `CreateUser` varchar(20) DEFAULT NULL,
  `CreateDate` date DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`Username`),
  KEY `fk_User_tbl_UserLevel_tbl1_idx` (`UserLevel_tbl_id`),
  CONSTRAINT `fk_User_tbl_UserLevel_tbl1` FOREIGN KEY (`UserLevel_tbl_id`) REFERENCES `userlevel_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tbl`
--

/*!40000 ALTER TABLE `user_tbl` DISABLE KEYS */;
INSERT INTO `user_tbl` (`Username`,`Password`,`UserLevel_tbl_id`,`Emp_id`,`CreateUser`,`CreateDate`,`Status`) VALUES 
 ('a','Zz2221',1,'AXA001',NULL,'2016-02-26',1),
 ('A111111','Zz2221',1,'HAL001','Admin',NULL,1),
 ('aaa','47bce5c74f589f4867dbd57e9ca9f808',1,NULL,'Admin','2016-01-01',1),
 ('Jagath','0e6d36b024e667bb7e91b3bc32f2feaf',1,'KEL001','aaa','2016-03-02',1);
/*!40000 ALTER TABLE `user_tbl` ENABLE KEYS */;


--
-- Definition of table `userlevel_tbl`
--

DROP TABLE IF EXISTS `userlevel_tbl`;
CREATE TABLE `userlevel_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lavel_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlevel_tbl`
--

/*!40000 ALTER TABLE `userlevel_tbl` DISABLE KEYS */;
INSERT INTO `userlevel_tbl` (`id`,`lavel_name`) VALUES 
 (1,'Admin'),
 (2,'Cashier'),
 (3,'Asis');
/*!40000 ALTER TABLE `userlevel_tbl` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
