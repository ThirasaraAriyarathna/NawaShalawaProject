CREATE DATABASE  IF NOT EXISTS `schoolmanager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `schoolmanager`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: schoolmanager
-- ------------------------------------------------------
-- Server version	5.5.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `studentclassfees`
--

DROP TABLE IF EXISTS `studentclassfees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentclassfees` (
  `StudentClassFeeId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassStudentId` int(11) DEFAULT NULL,
  `ClassFeeId` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`StudentClassFeeId`),
  KEY `StudentClassFeeClassFeeId` (`ClassFeeId`),
  KEY `StudentClassFeeClassStudentId` (`ClassStudentId`),
  CONSTRAINT `StudentClassFeeClassStudentId` FOREIGN KEY (`ClassStudentId`) REFERENCES `classstudents` (`ClassStudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StudentClassFeeClassFeeId` FOREIGN KEY (`ClassFeeId`) REFERENCES `classfees` (`ClassFees`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentclassfees`
--

LOCK TABLES `studentclassfees` WRITE;
/*!40000 ALTER TABLE `studentclassfees` DISABLE KEYS */;
/*!40000 ALTER TABLE `studentclassfees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classfees`
--

DROP TABLE IF EXISTS `classfees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classfees` (
  `ClassFees` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`ClassFees`),
  KEY `ClassFeeClassId` (`ClassId`),
  CONSTRAINT `ClassFeeClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classfees`
--

LOCK TABLES `classfees` WRITE;
/*!40000 ALTER TABLE `classfees` DISABLE KEYS */;
/*!40000 ALTER TABLE `classfees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `BatchId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `Year` varchar(4) DEFAULT NULL,
  `TargetExamId` int(11) DEFAULT NULL,
  PRIMARY KEY (`BatchId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classassistants`
--

DROP TABLE IF EXISTS `classassistants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classassistants` (
  `ClassAssistantId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `AssistantId` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ClassAssistantId`),
  KEY `ClassAssistantAssistantId` (`AssistantId`),
  KEY `ClassAssistantClassId` (`ClassId`),
  CONSTRAINT `ClassAssistantAssistantId` FOREIGN KEY (`AssistantId`) REFERENCES `assistants` (`AssistantId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClassAssistantClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classassistants`
--

LOCK TABLES `classassistants` WRITE;
/*!40000 ALTER TABLE `classassistants` DISABLE KEYS */;
/*!40000 ALTER TABLE `classassistants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classdates`
--

DROP TABLE IF EXISTS `classdates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classdates` (
  `ClassDateId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ClassDateId`),
  KEY `ClassDatesClassId` (`ClassId`),
  CONSTRAINT `ClassDatesClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classdates`
--

LOCK TABLES `classdates` WRITE;
/*!40000 ALTER TABLE `classdates` DISABLE KEYS */;
/*!40000 ALTER TABLE `classdates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `StudentId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(400) NOT NULL,
  `Address` varchar(450) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `District` varchar(45) DEFAULT NULL,
  `Gender` bit(1) DEFAULT NULL,
  `School` varchar(100) DEFAULT NULL,
  `ParentId` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`StudentId`),
  KEY `StudentUserId` (`UserId`),
  CONSTRAINT `StudentUserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classstudents`
--

DROP TABLE IF EXISTS `classstudents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classstudents` (
  `ClassStudentId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  `RegDate` date DEFAULT NULL,
  PRIMARY KEY (`ClassStudentId`),
  KEY `ClassStudentStudentId` (`StudentId`),
  KEY `ClassStudentClassId` (`ClassId`),
  CONSTRAINT `ClassStudentStudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClassStudentClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classstudents`
--

LOCK TABLES `classstudents` WRITE;
/*!40000 ALTER TABLE `classstudents` DISABLE KEYS */;
/*!40000 ALTER TABLE `classstudents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `ClassId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `TeacherId` int(11) DEFAULT NULL,
  `BatchId` int(11) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `AddDate` date DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  PRIMARY KEY (`ClassId`),
  KEY `ClassBatchId` (`BatchId`),
  KEY `ClassTeacherId` (`TeacherId`),
  KEY `ClassSubjectId` (`SubjectId`),
  CONSTRAINT `ClassTeacherId` FOREIGN KEY (`TeacherId`) REFERENCES `teachers` (`TeacherId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClassSubjectId` FOREIGN KEY (`SubjectId`) REFERENCES `subjects` (`SubjectId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClassBatchId` FOREIGN KEY (`BatchId`) REFERENCES `batches` (`BatchId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `TeacherId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(400) DEFAULT NULL,
  `Address` varchar(450) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `Gender` bit(1) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`TeacherId`),
  KEY `TeacherUserId` (`UserId`),
  CONSTRAINT `TeacherUserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assistants`
--

DROP TABLE IF EXISTS `assistants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assistants` (
  `AssistantId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `Mobile` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`AssistantId`),
  KEY `AssistantUserId` (`UserId`),
  CONSTRAINT `AssistantUserId` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistants`
--

LOCK TABLES `assistants` WRITE;
/*!40000 ALTER TABLE `assistants` DISABLE KEYS */;
/*!40000 ALTER TABLE `assistants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `UserType` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `AddedBy` varchar(45) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentexams`
--

DROP TABLE IF EXISTS `studentexams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentexams` (
  `StudentExamId` int(11) NOT NULL AUTO_INCREMENT,
  `ExamId` int(11) DEFAULT NULL,
  `ClassStudentId` int(11) DEFAULT NULL,
  `Marks` decimal(10,2) DEFAULT NULL,
  `Comment` varchar(450) DEFAULT NULL,
  `Grade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`StudentExamId`),
  KEY `studentExamExamId` (`ExamId`),
  KEY `StudentExamClassStudentId` (`ClassStudentId`),
  CONSTRAINT `studentExamExamId` FOREIGN KEY (`ExamId`) REFERENCES `exams` (`ExamId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StudentExamClassStudentId` FOREIGN KEY (`ClassStudentId`) REFERENCES `classstudents` (`ClassStudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentexams`
--

LOCK TABLES `studentexams` WRITE;
/*!40000 ALTER TABLE `studentexams` DISABLE KEYS */;
/*!40000 ALTER TABLE `studentexams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `SubjectId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`SubjectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `AttendanceId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassDateId` int(11) DEFAULT NULL,
  `ClassStudentId` int(11) DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `IsManual` bit(1) DEFAULT NULL,
  PRIMARY KEY (`AttendanceId`),
  KEY `AttendanceClassDateId` (`ClassDateId`),
  KEY `AttendanceClassStudetId` (`ClassStudentId`),
  CONSTRAINT `AttendanceClassDateId` FOREIGN KEY (`ClassDateId`) REFERENCES `classdates` (`ClassDateId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `AttendanceClassStudetId` FOREIGN KEY (`ClassStudentId`) REFERENCES `classstudents` (`ClassStudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exams` (
  `ExamId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Dsescription` varchar(450) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ExamId`),
  KEY `ExamClassId` (`ClassId`),
  CONSTRAINT `ExamClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-06 12:34:52
