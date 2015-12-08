-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2015 at 08:16 PM
-- Server version: 5.5.43
-- PHP Version: 5.4.43-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yii2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `role_alias` varchar(255) NOT NULL,
  `allow_registration` tinyint(1) DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` varchar(11) DEFAULT NULL,
  `updated_at` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `role_alias`, `allow_registration`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, 'Admin', 1, NULL, NULL, '2015-07-31 ', '1445239497'),
('backend:site:Index', 2, 'Allow call to Site Index', '', NULL, NULL, NULL, NULL, NULL),
('backend:site:Login', 2, 'Allow call to Site Login', '', NULL, NULL, NULL, NULL, NULL),
('backend:site:Logout', 2, 'Allow call to Site Logout', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:About', 2, 'Allow call to Site About', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:Contact', 2, 'Allow call to Site Contact', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:Index', 2, 'Allow call to Site Index', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:Login', 2, 'Allow call to Site Login', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:Logout', 2, 'Allow call to Site Logout', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:RequestPasswordReset', 2, 'Allow call to Site RequestPasswordReset', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:ResetPassword', 2, 'Allow call to Site ResetPassword', '', NULL, NULL, NULL, NULL, NULL),
('frontend:site:Signup', 2, 'Allow call to Site Signup', '', NULL, NULL, NULL, NULL, NULL),
('guest', 1, NULL, 'Guest', 0, NULL, NULL, '2015-07-31 ', '1445239486'),
('superadmin', 1, NULL, 'Super Admin', 1, NULL, NULL, '2015-07-31 ', '1445239433'),
('user', 1, NULL, 'User', 1, NULL, NULL, '1441872891', '1445239438'),
('usermgmt:group-permission:GetChild', 2, 'Allow call to GroupPermission GetChild', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:group-permission:GetChildRole', 2, 'Allow call to GroupPermission GetChildRole', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:group-permission:GetParent', 2, 'Allow call to GroupPermission GetParent', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:group-permission:GetRolePermission', 2, 'Allow call to GroupPermission GetRolePermission', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:group-permission:Index', 2, 'Allow call to GroupPermission Index', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:group-permission:Load', 2, 'Allow call to GroupPermission Load', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:rbac:Init', 2, 'Allow call to Rbac Init', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:role-and-permission:DeleteRole', 2, 'Allow call to RoleAndPermission DeleteRole', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:role-and-permission:Edit', 2, 'Allow call to RoleAndPermission Edit', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:role-and-permission:Index', 2, 'Allow call to RoleAndPermission Index', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:role-and-permission:Save', 2, 'Allow call to RoleAndPermission Save', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:role-and-permission:View', 2, 'Allow call to RoleAndPermission View', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:setting:Edit', 2, 'Allow call to Setting Edit', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:setting:Index', 2, 'Allow call to Setting Index', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:site:Dashboard', 2, 'Allow call to Site Dashboard', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:site:Index', 2, 'Allow call to Site Index', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:site:Login', 2, 'Allow call to Site Login', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:site:Logout', 2, 'Allow call to Site Logout', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:site:ShowName', 2, 'Allow call to Site ShowName', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Approve', 2, 'Allow call to User Approve', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:ChangePassword', 2, 'Allow call to User ChangePassword', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:ChangeUserPassword', 2, 'Allow call to User ChangeUserPassword', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:ClearCache', 2, 'Allow call to User ClearCache', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Dashboard', 2, 'Allow call to User Dashboard', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Delete', 2, 'Allow call to User Delete', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Edit', 2, 'Allow call to User Edit', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:EditProfile', 2, 'Allow call to User EditProfile', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Index', 2, 'Allow call to User Index', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Login', 2, 'Allow call to User Login', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Logout', 2, 'Allow call to User Logout', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:LogoutUser', 2, 'Allow call to User LogoutUser', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:MyProfile', 2, 'Allow call to User MyProfile', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Online', 2, 'Allow call to User Online', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:PermissionDenied', 2, 'Allow call to User PermissionDenied', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Register', 2, 'Allow call to User Register', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:RequestPasswordReset', 2, 'Allow call to User RequestPasswordReset', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:ResetFilter', 2, 'Allow call to User ResetFilter', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:ResetPassword', 2, 'Allow call to User ResetPassword', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Save', 2, 'Allow call to User Save', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:SendVerifyEmail', 2, 'Allow call to User SendVerifyEmail', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:Status', 2, 'Allow call to User Status', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:StatusUser', 2, 'Allow call to User StatusUser', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:VerifyEmail', 2, 'Allow call to User VerifyEmail', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:VerifySms', 2, 'Allow call to User VerifySms', '', NULL, NULL, NULL, NULL, NULL),
('usermgmt:user:View', 2, 'Allow call to User View', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('superadmin', 'admin'),
('guest', 'frontend:site:Index'),
('user', 'usermgmt:user:ChangePassword'),
('user', 'usermgmt:user:Dashboard'),
('user', 'usermgmt:user:EditProfile'),
('guest', 'usermgmt:user:Login'),
('guest', 'usermgmt:user:Logout'),
('user', 'usermgmt:user:Logout'),
('user', 'usermgmt:user:MyProfile'),
('guest', 'usermgmt:user:PermissionDenied'),
('guest', 'usermgmt:user:Register'),
('guest', 'usermgmt:user:RequestPasswordReset'),
('guest', 'usermgmt:user:ResetPassword'),
('guest', 'usermgmt:user:SendVerifyEmail'),
('user', 'usermgmt:user:SendVerifyEmail'),
('guest', 'usermgmt:user:VerifyEmail'),
('user', 'usermgmt:user:VerifyEmail'),
('user', 'usermgmt:user:VerifySms');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `name_public`, `value`, `type`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier', 'Asia/Calcutta', 'input'),
(2, 'siteName', 'Enter Your Site Name', 'Rupaiya Exchange', 'input'),
(3, 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox'),
(4, 'allowDeleteAccount', 'Allow users to delete account', '1', 'checkbox'),
(5, 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox'),
(6, 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '1', 'checkbox'),
(7, 'emailVerification', 'Want to verify user''s email address?', '1', 'checkbox'),
(8, 'emailFromAddress', 'Enter email by which emails will be send.', 'rxexchnage@rupaiyaexchange.com', 'input'),
(9, 'emailFromName', 'Enter Email From Name', 'Rosh', 'input'),
(10, 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input'),
(11, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox'),
(12, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input'),
(13, 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox'),
(14, 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', NULL, 'input'),
(15, 'loginRedirectUrlForAdmin', 'Enter URL where ADMIN will be redirected after login ', 'user/dashboard', 'input'),
(16, 'logoutRedirectUrlForAdmin', 'Enter URL where ADMIN will be redirected after logout\r\n(Warning: It should be a public action)', 'user/login', 'input'),
(17, 'loginRedirectUrlForUser', 'Enter URL where USER will be redirected after login', 'user/dashboard', 'input'),
(18, 'logoutRedirectUrlForUser', 'Enter URL where USER will be redirected after logout \r\n(Warning: It should be a public action)', 'user/index', 'input'),
(19, 'default_status_for_new_user', 'The new registering user will be registered as by default. For ACTIVE(Checked) or INACTIVE(Unchecked) ', '1', 'checkbox'),
(20, 'defaultRoleName', 'Enter default Role name for user registration (Warning: This role should exist in the Roles of your application(if you are using permisssions))', 'user', 'input'),
(21, 'adminRoleName', 'Enter Admin Role Name \r\n(Warning:By deafult ''Superadmin'' is the super admin on application roles(user roles) and this can never be deleted. If you want to specify other user role as admin, you can do that here)', 'admin', 'input'),
(22, 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox'),
(23, 'adminPermissions', 'Do you want to check permissions for Admin?', '0', 'checkbox'),
(24, 'app_images_directory', 'Directory for application images ', 'app_images', 'input'),
(25, 'user_profile_images_directory', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in (frontend or backend respectively)/web/images directory', 'user_photos', 'input'),
(26, 'user_profile_default_image', 'Default image for profile image not found', 'user-default.jpg', 'input'),
(27, 'default_page_size', 'No. of results to show per page in listing ', '10', 'input'),
(28, 'date_format', 'Date Format to show the dates in application', 'F jS, Y', 'input'),
(29, 'useRecaptcha', 'Do you want to captcha support on registration form?', '0', 'checkbox'),
(30, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', 'currently not in use', 'input'),
(31, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', 'currently not in use', 'input'),
(49, 'not_found_text', 'The text to show when results not found for a particular attribute', '<span style="color:red;">Not Found</span>', NULL),
(50, 'ajax_loading_big_image', 'Big ajax loading image for ajax requests while in process', 'circle-loading-animation.gif', 'input');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_emails`
--

CREATE TABLE IF NOT EXISTS `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `zipcode` int(6) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `img_path` varchar(256) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `about` text,
  `industry` tinyint(2) NOT NULL COMMENT '0 => Service Sector, 1 => Business',
  `accept_tnc` tinyint(1) NOT NULL COMMENT 'Accept Terms and conditions',
  `group_id` tinyint(3) DEFAULT '0',
  `role` tinyint(1) DEFAULT '0',
  `type` tinyint(4) NOT NULL COMMENT '1 => "As an individual", 2 => "Company"',
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `fb_email` varchar(100) DEFAULT NULL,
  `friends` text,
  `totalFriends` int(11) NOT NULL DEFAULT '0',
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `profile_updated` tinyint(1) NOT NULL DEFAULT '0',
  `documents_updated` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified` tinyint(1) DEFAULT '0',
  `sms_token` varchar(6) DEFAULT NULL,
  `sms_verified` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `by_admin` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `new_user` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `gender`, `address`, `city_id`, `state_id`, `zipcode`, `phone_number`, `img_path`, `dob`, `about`, `industry`, `accept_tnc`, `group_id`, `role`, `type`, `fb_id`, `fb_access_token`, `twt_id`, `twt_access_token`, `fb_email`, `friends`, `totalFriends`, `twt_access_secret`, `ldn_id`, `profile_updated`, `documents_updated`, `status`, `approved`, `email_verified`, `sms_token`, `sms_verified`, `last_login`, `by_admin`, `created`, `modified`, `new_user`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', 'pcQqQ3YdTxnkxFKvHzdWXrizdNyI1WTJ', '$2y$13$YTgLUbG1AF996Bao664HQufNVyO7pgrNpMw9XTUQlFc5vq6TOBgjm', NULL, NULL, NULL, 276354, 781495, 324234, '8237482736', '2251445258144images2.jpeg', '1997-07-31', 'sdfsdf', 1, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 1, 1, 1, NULL, 0, '2015-09-09 23:29:42', 0, '2015-07-31 06:56:05', '2015-08-25 00:24:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `name`, `username`, `email`, `useragent`, `user_id`, `last_action`, `last_url`, `logout_time`, `user_browser`, `ip_address`, `logout`, `deleted`, `status`, `created`, `modified`) VALUES
(1, 'admin admin', 'admin', 'admin@admin.com', NULL, 1, NULL, 'usermgmt/user/dashboard', NULL, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.120 Chrome/37.0.2062.120 Safari/537.36', '127.0.0.1', 0, 0, 1, '2015-11-10 12:11:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL COMMENT 'M=>Male, F=>Femaile, O=>Any Other',
  `photo` text,
  `bday` varchar(10) DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `marital_status` enum('M','U','D','W') DEFAULT NULL COMMENT 'M => Married, U=>Unmarried, D=>Divorced, W=>Widowed',
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `photo`, `bday`, `location`, `marital_status`, `cellphone`, `web_page`, `created`, `modified`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
