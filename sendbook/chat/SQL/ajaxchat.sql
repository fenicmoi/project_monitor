CREATE TABLE `useronline` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `expire` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
)  AUTO_INCREMENT=9 ;


INSERT INTO `useronline` VALUES (8, 'man', 1135014024);
