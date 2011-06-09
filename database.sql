CREATE TABLE IF NOT EXISTS `facemash` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rating` bigint(6) DEFAULT NULL,
  `imageurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;