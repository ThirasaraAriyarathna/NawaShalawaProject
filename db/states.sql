--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `ProvinceId` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ProvinceName` varchar(20) NOT NULL,
  PRIMARY KEY (`ProvinceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`ProvinceId`, `ProvinceName`) VALUES
(1, ' Central'),
(2, 'Eastern'),
(3, 'North Central'),
(4, 'Northern'),
(5, 'North Western'),
(6, 'Sabaragamuwa'),
(7, 'Southern'),
(8, 'Uva'),
(9, 'Western');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;