-- phpMyAdmin SQL Dump
-- version 3.4.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2014 at 12:49 AM
-- Server version: 5.0.95
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minibutmighty`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL auto_increment,
  `winner_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('A','N','D') NOT NULL default 'A',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `winner_id`, `name`, `status`, `created`) VALUES
(1, 0, 'First Testing', 'A', '2014-04-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nomination_by`
--

CREATE TABLE IF NOT EXISTS `nomination_by` (
  `id` int(11) NOT NULL auto_increment,
  `campaign_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `nomination_by`
--

INSERT INTO `nomination_by` (`id`, `campaign_id`, `name`, `email`, `dob`, `fb`, `twitter`, `created`) VALUES
(1, 1, 'Neha Verma', 'nv2412@gmail.com', '1-11-1982', '', '', '2014-05-02 01:16:18'),
(2, 1, 'Tester', 'test@gmail.com', '1-1-2014', '', '', '2014-05-02 01:18:46'),
(3, 1, 'fgdehjdf', 'nbhfgnjf', '1-1-2014', '', '', '2014-05-02 01:20:08'),
(4, 1, 'nsdkjfbh', 'gdfhd', '1-1-2014', '', '', '2014-05-02 01:20:49'),
(5, 1, 'bfgndg', 'dfbgdfbhd', '1-1-2014', '', '', '2014-05-02 01:21:49'),
(6, 1, 'gghdh', 'bhdghgd', '1-1-2014', '', '', '2014-05-02 16:22:55'),
(7, 1, '', '', '1-1-2014', '', '', '2014-05-02 16:35:55'),
(8, 1, 'kjhlh', 'hkjhlkh', '1-1-2014', '', '', '2014-05-02 17:00:52'),
(9, 1, 'kjhlh', 'hkjhlkh', '1-1-2014', '', '', '2014-05-02 17:01:10'),
(10, 1, 'kjhlh', 'hkjhlkh', '1-1-2014', '', '', '2014-05-02 17:01:35'),
(11, 1, 'kjhlh', 'hkjhlkh', '1-1-2014', '', '', '2014-05-02 17:02:13'),
(12, 1, 'kjhlh', 'hkjhlkh', '1-1-2014', '', '', '2014-05-02 17:03:19'),
(13, 1, 'hfjfjf', 'hjfghf', '1-1-2014', '', '', '2014-05-02 17:39:56'),
(14, 1, 'gfhf', 'gjfjfg', '1-1-2014', '', '', '2014-05-02 17:53:38'),
(15, 1, 'bghfghf', 'hfgjgh', '1-1-2014', '', '', '2014-05-02 18:24:41'),
(16, 1, 'refyge', 'gyruyr', '1-1-2014', '', '', '2014-05-05 16:43:13'),
(17, 1, 'dhdhj', 'fthfj', '1-1-2014', '', '', '2014-05-05 16:59:48'),
(18, 1, 'fgdfhd', 'hfjdf', '1-1-2014', '', '', '2014-05-05 17:04:59'),
(19, 1, 'dgfh', 'fgddh', '1-1-2014', '', '', '2014-05-05 17:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `nomination_option`
--

CREATE TABLE IF NOT EXISTS `nomination_option` (
  `id` int(11) NOT NULL auto_increment,
  `campaign_id` int(11) NOT NULL,
  `option` text NOT NULL,
  `status` enum('Y','N') NOT NULL default 'Y',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `nomination_option`
--

INSERT INTO `nomination_option` (`id`, `campaign_id`, `option`, `status`, `created`) VALUES
(1, 1, 'Sweet like Auntie Anne''s Cinnamon Sugar Pretzel Nuggets', 'Y', '2014-04-28 00:00:00'),
(2, 1, 'Classic like Auntie Anne''s Original Pretzel Nuggets', 'Y', '2014-04-28 00:00:00'),
(3, 1, 'A bundle of joy like Auntie Anne''s Mini Pretzel Dogs', 'Y', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nominees`
--

CREATE TABLE IF NOT EXISTS `nominees` (
  `id` int(11) NOT NULL auto_increment,
  `campaign_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `nomination_by` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `img` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `status` enum('A','D','F') NOT NULL default 'A',
  `city` varchar(20) NOT NULL,
  `state` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `nominees`
--

INSERT INTO `nominees` (`id`, `campaign_id`, `option_id`, `nomination_by`, `name`, `email`, `img`, `description`, `twitter`, `status`, `city`, `state`, `created`) VALUES
(1, 1, 1, 1, 'Parthvi', 'parthvi@gmail.com', '5748_8294_app1.jpg', '<p>Johnny T.  is a volunteer for Fort Meyers High School, and is involved with school-wide solutions to help students in need. He has a positive attitude and is driven to succeed. As a charismatic and motivated young man, Johnny T. helped his breakdancing group, the Service B-Boys Club, host a dancing "battle" fundraiser for two of the group''s teen members diagnosed with cancer.</p>\r\n                    <p>Johnny additionally addresses suicide prevention through conversations that tie into bullying, domestic violence, drug &amp; alcohol abuse, and sexual assault.</p>\r\n                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum egestas risus in lorem aliquet bibendum id eget nunc. Donec rutrum luctus aliquam. Nam eu condimentum tortor. Nam dictum posuere imperdiet. Fusce dictum volutpat iaculis. Sed non interdum nisi. Nam enim diam, fringilla vulputate metus ut, imperdiet dignissim dui. Praesent tempus urna vel risus pellentesque, eu imperdiet est adipiscing. Vivamus quis massa ligula. Sed sem purus, mollis vel fermentum quis, lacinia ultrices metus. Aenean massa erat, aliquam sed neque quis, pretium tempor diam. Pellentesque quis libero metus. </p>', '@parthvi', 'A', 'abc', 'WV', '2014-05-02 01:16:18'),
(2, 1, 2, 2, 'new', 'ew@gmail.com', '2342_1937_app2.jpg', '', '@test', 'A', 'westborough', 'MA', '2014-05-02 01:18:46'),
(3, 1, 1, 3, 'KP', 'kp@gmail.com', '6262_8315_app5.jpg', '', '@kp', 'A', 'city1', 'CA', '2014-05-02 01:20:08'),
(4, 1, 1, 4, 'New Test', 'fgdhfgjhj', '1215_3674_app4.jpg', '', 'dfcsxhfghnbdf', 'A', 'testcity', 'AZ', '2014-05-02 01:20:49'),
(5, 1, 1, 5, 'testagain', 'nfdlksngvs', '7803_1429_app4.jpg', '', 'fdcbgcbdfc', 'A', 'cityyyy', 'GA', '2014-05-02 01:21:49'),
(6, 1, 1, 6, 'Mahesh', 'mahesh@gmail.com', '1683_1939_user.png', 'sawfdrfhgfgbhdggsgdhds', '@mahesh', 'A', 'fwsfgw', 'AL', '2014-05-02 16:22:55'),
(7, 1, 2, 7, '', '', '7787_3063_app1.jpg', '', '', 'A', '', 'AL', '2014-05-02 16:35:55'),
(8, 1, 2, 9, 'hjklhlh', 'hklhjlh', '8199_1602_user-icon.png', 'hklhlkh', 'hkhlh', 'A', 'khlh', 'AL', '2014-05-02 17:01:10'),
(9, 1, 2, 10, 'hjklhlh', 'hklhjlh', '5411_2739_user-icon.png', 'dfgbhdhdhd', 'hkhlh', 'A', 'dfdgd', 'AL', '2014-05-02 17:01:35'),
(10, 1, 2, 11, 'hjklhlh', 'hklhjlh', '3367_6499_app3.jpg', 'bgfchfcgnbd', 'hkhlh', 'A', 'bfhfghf', 'AL', '2014-05-02 17:02:13'),
(11, 1, 2, 12, 'hjklhlh', 'hklhjlh', '3157_8581_app3.jpg', 'bgfchfcgnbd', 'hkhlh', 'F', 'bfhfghf', 'AL', '2014-05-02 17:03:19'),
(12, 1, 1, 13, 'dbhdfghd', 'fchdfhdf', '1801_8770_app4.jpg', 'njgjff', 'bghfhcfh', 'F', 'vbcgh', 'AL', '2014-05-02 17:39:56'),
(13, 1, 1, 14, 'fvhjfghjf', 'fjfgjf', '2876_3599_20131225_163136.jpg', '<p>Johnny T.  is a volunteer for Fort Meyers High School, and is involved with school-wide solutions to help students in need. He has a positive attitude and is driven to succeed. As a charismatic and motivated young man, Johnny T. helped his breakdancing group, the Service B-Boys Club, host a dancing "battle" fundraiser for two of the group''s teen members diagnosed with cancer.</p>\r\n                    <p>Johnny additionally addresses suicide prevention through conversations that tie into bullying, domestic violence, drug &amp; alcohol abuse, and sexual assault.</p>\r\n                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum egestas risus in lorem aliquet bibendum id eget nunc. Donec rutrum luctus aliquam. Nam eu condimentum tortor. Nam dictum posuere imperdiet. Fusce dictum volutpat iaculis. Sed non interdum nisi. Nam enim diam, fringilla vulputate metus ut, imperdiet dignissim dui. Praesent tempus urna vel risus pellentesque, eu imperdiet est adipiscing. Vivamus quis massa ligula. Sed sem purus, mollis vel fermentum quis, lacinia ultrices metus. Aenean massa erat, aliquam sed neque quis, pretium tempor diam. Pellentesque quis libero metus. </p>', 'fgjfj', 'F', 'gjfgjf', 'AL', '2014-05-02 17:53:38'),
(14, 1, 1, 15, 'jfghkjf', 'fghjfgj', '6691_1801_app1.png', 'kmghlkghlg', 'ghjkkg', 'F', 'hjghkg', 'AL', '2014-05-02 18:24:41'),
(15, 1, 1, 16, 'tyhtyuj', 'hjftgyjg', '2255_5467_android.jpg', 'rhrjrjrj', 'yjtgykjt', 'F', 'gjftj', 'AL', '2014-05-05 16:43:13'),
(16, 1, 1, 17, 'fjfk', 'fgjfg', '8206_7344_apple-app.png', 'jgjgj', 'ghjnmgh', 'F', 'ygjg', 'AL', '2014-05-05 16:59:48'),
(17, 1, 1, 18, 'fnfgmf', 'nhfjf', '1768_7027_app2.jpg', 'fnjfjf', 'nhfhjf', 'F', 'njfjf', 'AL', '2014-05-05 17:04:59'),
(18, 1, 1, 19, 'gdg', 'gdgh', '1433_4244_report-icon.png', 'ghdfghdbddfvd', '@xbdcf', 'F', 'dfgd', 'AL', '2014-05-05 17:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL auto_increment,
  `vote_for` int(11) NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `vote_for`, `added`) VALUES
(1, 11, '2014-05-06 00:00:14'),
(2, 11, '2014-05-06 00:00:24'),
(3, 11, '2014-05-06 00:09:42'),
(4, 11, '2014-05-06 00:11:19'),
(5, 11, '2014-05-06 00:13:55'),
(6, 12, '2014-05-06 00:14:59'),
(7, 13, '2014-05-06 00:22:58');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
