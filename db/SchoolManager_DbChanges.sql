-- Add new collmn to User Table 
-- Thilani (12-07-2014)

ALTER TABLE `users` ADD `Salt` VARCHAR(12) NOT NULL AFTER `Password`;

-- Add new collmn to students Table 
-- Thilani (19-07-2014)
ALTER TABLE `students` ADD `AdmissionID` VARCHAR(50) NULL AFTER `StudentId`, ADD UNIQUE (`AdmissionID`) ;
-- ALTER TABLE `students` ADD `PeesRate` FLOAT NOT NULL DEFAULT '1' COMMENT 'value between 0 - 1, 0 - full free , 1 - pay full pees ' ;

ALTER TABLE `students` CHANGE `Name` `FirstName` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `students` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';

ALTER TABLE `students` ADD `LastName` VARCHAR(400) NULL AFTER `FirstName`;
ALTER TABLE `students` ADD `DateOfBirth` INT(11) NOT NULL AFTER `Gender`;

ALTER TABLE `students` CHANGE `Address` `AddressLine1` VARCHAR(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `students` ADD `AddressLine2` VARCHAR(450)  NULL AFTER `AddressLine1`, ADD `City` VARCHAR(200) NOT NULL AFTER `AddressLine2`;
ALTER TABLE `students` ADD `State` VARCHAR(200)  NULL AFTER `City`;
ALTER TABLE `students` ADD `Phone` VARCHAR(15) NULL AFTER `Email`;
ALTER TABLE `students` CHANGE `ParentId` `ParentFirstName` VARCHAR(400) NULL DEFAULT NULL;
ALTER TABLE `students` ADD `ParentLastName` VARCHAR(400) NULL DEFAULT NULL AFTER `ParentFirstName`, ADD `ParentPhone` VARCHAR(15) NULL DEFAULT NULL AFTER `ParentLastName`, ADD `ParentAddress` TEXT NULL DEFAULT NULL AFTER `ParentPhone`;
ALTER TABLE `students` ADD `Relation` VARCHAR(20) NULL DEFAULT NULL AFTER `ParentAddress`;
ALTER TABLE `students` CHANGE `ParentAddress` `ParentAddress` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;

ALTER TABLE `batches` ADD `LastStudentId` INT(11) NULL DEFAULT '1' ;

ALTER TABLE `users` CHANGE `DateAdded` `DateAdded` INT(11) NOT NULL;
ALTER TABLE `students` CHANGE `Gender` `Gender` BIT(1) NULL DEFAULT NULL COMMENT '0 - Female , 1 - Male';

-- ALTER TABLE `classstudents` ADD `FeesRate` FLOAT NOT NULL DEFAULT '1';

ALTER TABLE `subjects` CHANGE `IsActive` `IsActive` BIT( 1 ) NULL DEFAULT b'1';
ALTER TABLE `subjects` ADD `IsDelete` BIT( 1 ) NOT NULL DEFAULT b'0' AFTER `IsActive` ;

ALTER TABLE `batches` CHANGE `AddDate` `AddDate` INT( 11 ) NULL DEFAULT NULL ;
ALTER TABLE `batches` ADD `IsDelete` BIT( 1 ) NOT NULL DEFAULT b'0';

ALTER TABLE `batches` CHANGE `Year` `Year` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;

ALTER TABLE `classes` CHANGE `AddDate` `AddDate` INT( 11 ) NULL DEFAULT NULL ;

ALTER TABLE `classes` ADD `IsDelete` BIT( 1 ) NOT NULL DEFAULT b'0';


-- Changes 6/9/2014

ALTER TABLE `teachers` CHANGE `Name` `FirstName` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `teachers` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';
ALTER TABLE `teachers` ADD `LastName` VARCHAR(400) NULL AFTER `FirstName`;
ALTER TABLE `teachers` ADD `DateOfBirth` INT(11) NOT NULL AFTER `Gender`;
ALTER TABLE `teachers` CHANGE `Address` `AddressLine1` VARCHAR(450) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `teachers` ADD `AddressLine2` VARCHAR(450)  NULL AFTER `AddressLine1`, ADD `City` VARCHAR(200) NOT NULL AFTER `AddressLine2`;
ALTER TABLE `teachers` ADD `State` VARCHAR(200)  NULL AFTER `City`;
ALTER TABLE `teachers` ADD `Phone` VARCHAR(15) NULL AFTER `Email`;
ALTER TABLE `teachers` CHANGE `Gender` `Gender` BIT(1) NULL DEFAULT NULL COMMENT '0 - Female , 1 - Male';

ALTER TABLE `users` CHANGE `UserType` `UserType` INT(11) NOT NULL COMMENT '1 - admin, 2- assistants , 3 - teachers, 4 - students';

ALTER TABLE `teachers` ADD `AdmissionID` VARCHAR(50) NULL DEFAULT NULL AFTER `TeacherId`, ADD UNIQUE (`AdmissionID`) ;
-- Change classdates table 26/10/14
ALTER TABLE `classdates` CHANGE `Date` `DayOfWeek` VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE `classdates` ADD `StartTime` INT(11) NULL DEFAULT NULL COMMENT 'store timestamp from 1970-01-01' AFTER `Description`, ADD `EndTime` INT(11) NULL DEFAULT NULL COMMENT 'store timestamp from 1970-01-01' AFTER `StartTime`;
ALTER TABLE `classdates` ADD `Date` INT(11) NULL DEFAULT NULL AFTER `Description`;
ALTER TABLE `classdates` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'0';
ALTER TABLE `classdates` ADD `IsExtraClass` BIT(1) NOT NULL DEFAULT b'0' ;
ALTER TABLE `classdates` ADD `IsDelete` BIT(1) NOT NULL DEFAULT b'0' ;

-- Change classgroups table 
DROP TABLE IF EXISTS `classgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classgroups` (
  `ClassGroupId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ClassGroupId`),
  KEY `ClassGroupClassId` (`ClassId`),
  CONSTRAINT `ClassGroupClassId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`ClassId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `classgroups` CHANGE `Date` `DayOfWeek` VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE `classgroups` ADD `StartTime` INT(11) NULL DEFAULT NULL COMMENT 'store timestamp from 1970-01-01' AFTER `Description`, ADD `EndTime` INT(11) NULL DEFAULT NULL COMMENT 'store timestamp from 1970-01-01' AFTER `StartTime`;
ALTER TABLE `classgroups` ADD `Date` INT(11) NULL DEFAULT NULL AFTER `Description`;
ALTER TABLE `classgroups` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'0';
ALTER TABLE `classgroups` ADD `IsExtraClass` BIT(1) NOT NULL DEFAULT b'0' ;
ALTER TABLE `classgroups` ADD `IsDelete` BIT(1) NOT NULL DEFAULT b'0' ;


DROP TABLE IF EXISTS `groupstudents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupstudents` (
  `GroupStudentId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassGroupId` int(11) DEFAULT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT NULL,
  `RegDate` date DEFAULT NULL,
  PRIMARY KEY (`GroupStudentId`),
  KEY `GroupStudentStudentId` (`StudentId`),
  KEY `GroupStudentGroupId` (`GroupStudentId`),
  CONSTRAINT `GroupStudentStudentId` FOREIGN KEY (`StudentId`) REFERENCES `students` (`StudentId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `GroupStudentClassGroupId` FOREIGN KEY (`ClassGroupId`) REFERENCES `classgroups` (`ClassGroupId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Change classdates table 25/11/14
ALTER TABLE `classstudents` ADD `ClassGroupId` INT(11) NULL DEFAULT NULL AFTER `StudentId`;
ALTER TABLE `classstudents` ADD CONSTRAINT `ClassStudentClassDateId` FOREIGN KEY (`ClassGroupId`) REFERENCES `schoolmanager`.`classdates`(`ClassDateId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `classstudents` CHANGE `RegDate` `RegDate` INT(11) NULL DEFAULT NULL;
ALTER TABLE `students` ADD `BatchId` INT(11) NULL DEFAULT NULL AFTER `ParentAddress`;
ALTER TABLE `classfees` CHANGE `DueDate` `DueDate` INT(11) NULL DEFAULT NULL;

-- Drop some fields from classdates table 3/12/14

--
-- Table structure for table `extragroupclasses`
--

CREATE TABLE IF NOT EXISTS `extragroupclasses` (
  `ExtraClassId` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `DayOfWeek` varchar(10) DEFAULT NULL,
  `Description` varchar(450) DEFAULT NULL,
  `Date` int(11) DEFAULT NULL,
  `StartTime` int(11) DEFAULT NULL,
  `EndTime` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `IsDelete` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `classdates`
  DROP `DayOfWeek`,
  DROP `Description`,
  DROP `StartTime`,
  DROP `EndTime`,
  DROP `IsExtraClass`;

ALTER TABLE `classdates` ADD `ClassGroupId` TEXT NULL AFTER `ClassId`;

ALTER TABLE `classdates` ADD `ExtraClassId` INT(11) NULL DEFAULT NULL COMMENT 'If this is an extra class ' AFTER `ClassGroupId`;
ALTER TABLE `classdates` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';
ALTER TABLE `extragroupclasses` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';
ALTER TABLE `extragroupclasses` CHANGE `IsDelete` `IsDelete` BIT(1) NULL DEFAULT b'0';
ALTER TABLE `studentclassfees` ADD `Amount` DECIMAL(10,2) NULL DEFAULT NULL AFTER `ClassFeeId`;
ALTER TABLE `studentclassfees` CHANGE `Date` `Date` INT(11) NULL DEFAULT NULL;

-- ALTER TABLE `attendances` DROP FOREIGN KEY `AttendanceClassGroupd`; ALTER TABLE `attendances` ADD CONSTRAINT `AttendanceClassGroupd` FOREIGN KEY (`ClassDateId`) REFERENCES `classdates`(`ClassDateId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `classstudents` ADD `FeesRate` FLOAT NULL DEFAULT '1' COMMENT 'Value 0 - 1 / 0 - free cards , 1 - full payment' AFTER `StudentId`;
ALTER TABLE `studentclassfees` ADD `Remarks` TEXT NULL DEFAULT NULL AFTER `Amount`;

ALTER TABLE `studentclassfees` ADD `ClassDateId` INT(11) NULL DEFAULT NULL AFTER `ClassFeeId`;
ALTER TABLE `groupstudents` CHANGE `RegDate` `RegDate` INT(11) NULL DEFAULT NULL;
ALTER TABLE `groupstudents` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';
ALTER TABLE `classstudents` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';

ALTER TABLE `assistants` CHANGE `Name` `FirstName` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `assistants` ADD `LastName` VARCHAR(100) NULL DEFAULT NULL AFTER `FirstName`;
ALTER TABLE `assistants` ADD `Phone` VARCHAR(20) NULL DEFAULT NULL AFTER `UserId`;
ALTER TABLE `assistants` CHANGE `Mobile` `AdditionalPhone` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `assistants` ADD `Address` TEXT NULL DEFAULT NULL AFTER `UserId`;
ALTER TABLE `assistants` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';

ALTER TABLE `classassistants` CHANGE `IsActive` `IsActive` BIT(1) NULL DEFAULT b'1';

ALTER TABLE `assistants` ADD `AdmissionID` VARCHAR(50) NULL DEFAULT NULL AFTER `AssistantId`;
ALTER TABLE `assistants` ADD `Title` VARCHAR(5) NULL DEFAULT NULL AFTER `AdmissionID`;

ALTER TABLE `assistants` ADD `NIC` VARCHAR(15) NULL DEFAULT NULL AFTER `LastName`;

-- 10/03/2015
ALTER TABLE `assistants` ADD `AssistantKey` VARCHAR(12) NULL DEFAULT NULL ;
ALTER TABLE `attendances` CHANGE `Time` `Time` INT(11) NULL DEFAULT NULL;