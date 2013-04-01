-- MySQL dump 10.13  Distrib 5.1.63, for pc-linux-gnu (i686)
--
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
-- Table structure for table `annoucements`
--

DROP TABLE IF EXISTS `annoucements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annoucements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(999) NOT NULL,
  `link` varchar(999) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contactus_categories`
--

DROP TABLE IF EXISTS `contactus_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactus_categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of contactus_categories
-- ----------------------------
INSERT INTO `contactus_categories` VALUES ('1', 'اقتراحات \\ ملاحظات', null);
INSERT INTO `contactus_categories` VALUES ('2', 'اخرى', null);

--
-- Table structure for table `contactus_messages`
--

DROP TABLE IF EXISTS `contactus_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactus_messages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(128) NOT NULL,
  `sender_name` varchar(128) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `content` varchar(128) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_id` int(2) NOT NULL,
  `category_id` int(8) NOT NULL DEFAULT '1',
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `nationality` varchar(32) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'السعودية', 'سعودي', null);
INSERT INTO `countries` VALUES ('2', 'البحرين', 'بحريني', null);
INSERT INTO `countries` VALUES ('3', 'الإمارات', 'إماراتي', null);
INSERT INTO `countries` VALUES ('4', 'قطر', 'قطري', null);
INSERT INTO `countries` VALUES ('5', 'عمان', 'عماني', null);
INSERT INTO `countries` VALUES ('6', 'الكويت', 'كويتي', null);
INSERT INTO `countries` VALUES ('7', 'اليمن', 'يمني', null);
INSERT INTO `countries` VALUES ('8', 'العراق', 'عراقي', null);
INSERT INTO `countries` VALUES ('9', 'فلسطين', 'فلسطيني', null);
INSERT INTO `countries` VALUES ('10', 'لبنان', 'لبناني', null);
INSERT INTO `countries` VALUES ('11', 'سوريا', 'سوري', null);
INSERT INTO `countries` VALUES ('12', 'الأردن', 'أردني', null);
INSERT INTO `countries` VALUES ('13', 'مصر', 'مصري', null);
INSERT INTO `countries` VALUES ('14', 'السودان', 'سوداني', null);

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(128) NOT NULL,
  `file_size` decimal(50,2) NOT NULL COMMENT 'in Kilobytes',
  `server_name` varchar(128) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(8) NOT NULL,
  `cat_id` int(8) NOT NULL,
  `reference_id` int(8) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files_categories`
--

DROP TABLE IF EXISTS `files_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of files_categories
-- ----------------------------
INSERT INTO `files_categories` VALUES ('1', 'ملف عام', null);
--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator', null);
INSERT INTO `groups` VALUES ('2', 'member', 'General User', null);


--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  `server_name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `description` varchar(512) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `latitude` varchar(128) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bio` varchar(999) DEFAULT NULL,
  `country` int(8) DEFAULT NULL,
  `gender` enum('1','2') DEFAULT NULL,
  `referrer_id` int(8) DEFAULT NULL COMMENT 'For faculty added by user funtion',
  `convert_remarks` longtext,
  `bb_pin` varchar(8) DEFAULT NULL,
  `adult_content` bit(1) NOT NULL DEFAULT b'0',
  `show_bb_pin` bit(1) NOT NULL COMMENT '1',
  `show_phone` bit(1) NOT NULL COMMENT '1',
  `show_email` bit(1) NOT NULL COMMENT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=987 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of meta
-- ----------------------------
INSERT INTO `meta` VALUES ('1', '1', 'Mo9a7i', null, null, null, null, null, null, null, null, null, null, '', '', '', '');

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` varchar(9999) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(8) NOT NULL,
  `status_id` int(8) NOT NULL DEFAULT '1',
  `convert_remarks` longtext,
  `slug` varchar(52) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` longtext NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(8) NOT NULL,
  `status_id` int(2) NOT NULL DEFAULT '1',
  `convert_remarks` longtext,
  `date_modified` timestamp NULL DEFAULT NULL,
  `slug` varchar(52) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6557 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posts_moderation`
--

DROP TABLE IF EXISTS `posts_moderation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_moderation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `ip_address` varchar(16) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21446 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replies` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` varchar(9999) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `author_url` varchar(255) DEFAULT NULL,
  `author_ip` varchar(16) DEFAULT NULL,
  `status_id` int(3) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12968 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `report_category` int(8) NOT NULL,
  `content` varchar(9999) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(8) NOT NULL,
  `pathname` varchar(9999) DEFAULT NULL,
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `status_id` int(3) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reports_categories`
--

DROP TABLE IF EXISTS `reports_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports_categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of reports_categories
-- ----------------------------
INSERT INTO `reports_categories` VALUES ('1', 'إساءة', null);
INSERT INTO `reports_categories` VALUES ('2', 'غير صحيح', null);
--
-- Table structure for table `resource_types`
--

DROP TABLE IF EXISTS `resource_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_types` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='This table describes the types of objects in our database, r';
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of resource_types
-- ----------------------------
INSERT INTO `resource_types` VALUES ('1', 'users', null);
INSERT INTO `resource_types` VALUES ('2', 'posts', null);
INSERT INTO `resource_types` VALUES ('3', 'pages', null);
INSERT INTO `resource_types` VALUES ('4', 'institutes', null);
INSERT INTO `resource_types` VALUES ('5', 'contactus', null);
INSERT INTO `resource_types` VALUES ('7', 'ratings', null);
INSERT INTO `resource_types` VALUES ('8', 'evaluations', null);
INSERT INTO `resource_types` VALUES ('9', 'votes', null);
INSERT INTO `resource_types` VALUES ('10', 'comments', null);
--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `var_name` varchar(32) NOT NULL,
  `value` varchar(512) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'maintenance', '0', null);
INSERT INTO `settings` VALUES ('2', 'maintenance_message', '', null);
INSERT INTO `settings` VALUES ('3', 'site_title', 'MyCI_Template', null);
INSERT INTO `settings` VALUES ('4', 'admin_email', 'admin@mail.com', null);
INSERT INTO `settings` VALUES ('5', 'registeration', '1', null);
INSERT INTO `settings` VALUES ('6', 'auto_activate_user', '1', null);
INSERT INTO `settings` VALUES ('7', 'faculty_register', '1', null);
INSERT INTO `settings` VALUES ('20', 'comment_auto_active', '1', null);
INSERT INTO `settings` VALUES ('25', 'advanced_settings', '1', null);
INSERT INTO `settings` VALUES ('26', 'site_description', 'Site description goes here', null);
INSERT INTO `settings` VALUES ('27', 'mail_protocol', '0', null);
INSERT INTO `settings` VALUES ('28', 'smtp_host', '444445', null);
INSERT INTO `settings` VALUES ('29', 'smtp_port', '0', null);
INSERT INTO `settings` VALUES ('30', 'smtp_user', '0', null);
INSERT INTO `settings` VALUES ('31', 'smtp_password', '0', null);
INSERT INTO `settings` VALUES ('32', 'registeration', '1', null);
INSERT INTO `settings` VALUES ('33', 'default_user_points', '0', null);
INSERT INTO `settings` VALUES ('35', 'meta_description', 'Meta description goes here', null);
INSERT INTO `settings` VALUES ('36', 'keywords', 'website kewords, separated, by, commas', null);
INSERT INTO `settings` VALUES ('37', 'registeration_schedule', '0', null);
INSERT INTO `settings` VALUES ('38', 'welcome_message', '1', null);
INSERT INTO `settings` VALUES ('39', 'down_votes_count', '5', null);
INSERT INTO `settings` VALUES ('40', 'up_votes_count', '5', null);
INSERT INTO `settings` VALUES ('41', 'visitor_comments', '1', null);
--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES ('1', 'مفعل', null);
INSERT INTO `statuses` VALUES ('2', 'غير مفعل', null);
INSERT INTO `statuses` VALUES ('3', 'ممسوح', null);
INSERT INTO `statuses` VALUES ('4', 'بإنتظار الموافقة', null);
--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(999) DEFAULT NULL,
  `count` int(8) NOT NULL DEFAULT '0',
  `convert_remarks` longtext,
  `filtered` bit(1) DEFAULT b'0' COMMENT '1 is yes 0 is no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags_relations`
--

DROP TABLE IF EXISTS `tags_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL,
  `resource_type` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urls` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `link` varchar(512) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(8) NOT NULL,
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` int(10) unsigned NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1138 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '0', 'Mo9a7i', 'b028a096fd8686bb6f74c232a0b143d2ccaedc4e', '00643f42b3', 'mohannad.otaibi@gmail.com', null, null, null, '2013-03-17 00:05:06', '0000-00-00 00:00:00', '1', '');
--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1095 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1', '1', null);

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `views` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `count` int(128) NOT NULL DEFAULT '0',
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2326 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `value` int(8) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `resource_id` int(8) NOT NULL,
  `resource_type` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `convert_remarks` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2566 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-01 15:12:19
