CREATE TABLE IF NOT EXISTS `l_authors` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `years` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='List of authors';

CREATE TABLE IF NOT EXISTS `l_books` (
  `barcode` int(12) NOT NULL AUTO_INCREMENT COMMENT '448900000000 + this',
  `typecode` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Material type',
  `dewey` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Dewey Decimal Number',
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Author ID',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Quantity and type',
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Year of Publication or Release',
  `isbn10` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'International Standard Book Number 10',
  `isbn13` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'International Standard Book Number 13',
  `issn` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'International Standard Serial Number',
  `lccn` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Library of Congress Control Number',
  `lccat` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Library of Congress Cataloging Number',
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'avail' COMMENT 'Status code',
  `location` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Location code',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Subject Keywords',
  PRIMARY KEY (`barcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='List of books';

CREATE TABLE IF NOT EXISTS `l_circ` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL COMMENT 'Borrower ID',
  `bookid` int(12) NOT NULL COMMENT 'Book/borrowed item ID',
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Date borrowed',
  `due` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Date due',
  `returned` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Date returned. If 0, material not returned.',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='List of materials currently checked out';

CREATE TABLE IF NOT EXISTS `l_config` (
  `library_home` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `library_barcode` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `library_local_repository` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `library_remote_mailto` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `l_locations` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Locations of library materials';

CREATE TABLE IF NOT EXISTS `l_serials` (
  `barcode` int(12) NOT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`barcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `l_statuses` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Statuses for library materials';