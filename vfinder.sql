-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: 118.123.21.160
-- 生成日期: 2015 年 05 月 27 日 21:26
-- 服务器版本: 5.1.65
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `vfinder`
--

-- --------------------------------------------------------

--
-- 表的结构 `book_torrent`
--

CREATE TABLE IF NOT EXISTS `book_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` int(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `up` int(11) NOT NULL DEFAULT '0',
  `down` int(11) NOT NULL DEFAULT '0',
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `book_torrent`
--

INSERT INTO `book_torrent` (`torrent_id`, `uid`, `title`, `post_link`, `filepath`, `file_size`, `file_count`, `md5`, `time`, `mtime_link`, `category`, `up`, `down`, `quality`, `download`) VALUES
(1, 1, '[大卫科波菲尔]david.copperfield.pdf.torrent', '', 'data/torrent/1421239400/4a5e74d8e2f19fc49acd0b36db833e2d.torrent', '3.33MB', 1, '2ea7ad8c6016aed697c37e15f0a36257', '2015-01-14 12:43:29', '', 'book', 0, 0, 'Unknown', 41),
(2, 1, '[社交网站界面设计]designing.social.interfaces.tqw.darksiderg.torrent', '', 'data/torrent/1421239480/49a5ce9dbc862f7b339a727847eaa263.torrent', '10.36MB', 3, 'af3be9150640eb5292c3c4c23b2f2847', '2015-01-14 12:44:46', '', 'book', 0, 0, 'Unknown', 39),
(3, 1, '[午夜之子]midnight.s.children.3142.torrent', '', 'data/torrent/1421239510/d11c3501c8ae197ac66c3e9e6b68490e.torrent', '2.53MB', 2, '7362e109db99e424b812be167354d8bd', '2015-01-14 12:45:14', '', 'book', 0, 0, 'Unknown', 36),
(4, 1, '[HTML5高级程序设计]pro.html5.performance.by.jay.bryant.mike.jones.torrent', '', 'data/torrent/1421453819/65c6ddbeef38545447b7b054f57ccd1a.torrent', '8.18MB', 1, '0c899e2839d6ecc76ca8adb3a9f99ba2', '2015-01-17 00:17:03', '', 'book', 0, 0, 'Unknown', 38);

-- --------------------------------------------------------

--
-- 表的结构 `book_torrent_cmt`
--

CREATE TABLE IF NOT EXISTS `book_torrent_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `parent_id` int(8) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `show` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `show`) VALUES
(1, 0, 'Fruit', 0),
(2, 0, 'Meat', 0),
(3, 1, 'Apple', 0),
(4, 1, 'Orange', 0),
(5, 2, 'Pork', 0),
(6, 2, 'Beef', 0),
(7, 3, 'Small Apple', 0),
(8, 3, 'Medium Apple', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dictionary`
--

CREATE TABLE IF NOT EXISTS `dictionary` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `english` varchar(50) NOT NULL,
  `chinese` varchar(50) NOT NULL,
  `release` varchar(10) NOT NULL DEFAULT '0',
  `category` varchar(15) NOT NULL DEFAULT 'Movie',
  `poster_link` varchar(150) NOT NULL,
  `mtime_link` varchar(150) NOT NULL,
  `remark` varchar(300) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `english` (`english`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- 转存表中的数据 `dictionary`
--

INSERT INTO `dictionary` (`id`, `english`, `chinese`, `release`, `category`, `poster_link`, `mtime_link`, `remark`, `time`) VALUES
(1, 'The Shawshank Redemption', '﻿肖申克的救赎', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(2, 'Godfather', '教父', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(3, 'The Professional: Leon', '这个杀手不太冷', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(4, 'Legend Of 1900', '海上钢琴师', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(5, 'Donnie Darko', '死亡幻觉', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(6, 'Gattaca', '千钧一发', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(7, 'Marry & Marx', '玛丽和马克思', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(8, 'The Bodyguard', '保镖', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(9, 'Before Sunrise', '爱在黎明破晓前', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(10, 'Edward Scissorhands', '剪刀手爱德华', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(11, 'Harry Potter', '哈利波特', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(12, 'Dance With Wolves', '与狼共舞', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(13, 'Cold Mountains', '冷山', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(14, 'Cleopatra', '埃及艳后', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(15, 'E.T.: The Extra-Terrestrial', 'ET外星人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(16, 'Schindler’s List', '辛德勒名单', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(17, 'Braveheart', '勇敢的心', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(18, 'Finding Nemo', '海底总动员', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(19, 'The Shining', '闪灵', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(20, 'La Vita E Bella', '美丽人生', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(21, 'Crash', '撞车', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(22, 'Good Will Hunting', '心灵捕手', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(23, 'Hachi: A Dog’s Tale', '忠犬八公', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(24, 'Les Choristes', '放牛班的春天', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(25, 'Scent Of Woman', '闻香识女人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(26, 'Eight Below', '南极大冒险', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(27, 'To Kill A Mockingbird', '杀死一只知更鸟', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(28, 'Cast Away', '荒岛余生', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:21'),
(29, 'Rosso Come Il Cielo', '听见天堂', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(30, 'Dead Poets Society', '死亡诗社', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(31, 'Artificial Intelligence', '人工智能', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(32, 'The Others', '小岛惊魂', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(33, 'The Skeleton Key', '万能钥匙', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(34, 'Law Abiding Citizen', '守法公民', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(35, 'Intouchables', '触不可及', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(36, 'Best Laid Plan', '完美计划', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(37, 'A Clockwork Orange', '发条橙', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(38, 'Fight Club', '搏击俱乐部', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(39, 'The Exorcist', '驱魔人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(40, 'Night Train', '暗夜列车', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(41, 'The Pianist', '钢琴家', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(42, 'Taxi Driver', '出租车司机', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(43, 'Titanic', '泰坦尼克号', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(44, 'Forrest Gump', '阿甘正传', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(45, 'The Truman Show', '楚门的世界', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(46, '1408', '幻影凶间', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(47, 'Identity', '致命ID', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(48, 'The Call', '致命呼叫', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(49, 'Cube', '心慌方', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(50, 'The Thirteenth Floor', '异次元骇客', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(51, 'The Sixth Sense', '灵异第六感', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(52, 'Muholland Dr.', '穆赫兰道', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(53, 'Flipped', '怦然心动', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(54, 'The Usual Suspects', '非常嫌疑犯', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(55, 'Phone Booth', '狙击电话亭', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(56, 'The Pursuit Of Happyness', '当幸福来敲门', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(57, 'Wall E', '机器人瓦力', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(58, 'Pulp Fiction', '低俗小说', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(59, 'Fly Away Home', '伴我同行', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(60, 'Contact', '超时空接触', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(61, 'Frequency', '黑洞频率', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(62, 'Up', '飞屋环游记', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(63, 'Rain Man', '雨人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(64, 'The Silence Of The Lambs', '沉默的羔羊', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(65, 'One Flew Over The Cuckoo’s Nest', '飞越疯人院', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(66, 'There’s No Country For An Old Man', '老无所依', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(67, 'The Graduate', '毕业生', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(68, 'Memento', '时间碎片', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(69, 'The Prestige', '致命魔术', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(70, 'A Beautiful Mind', '美丽心灵', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(71, 'Green Miles', '绿里奇迹', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:22'),
(72, 'Butterfly Effects', '蝴蝶效应', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(73, 'Sideways', '杯酒人生', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(74, 'Million Dollar Baby', '百万美元宝贝', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(75, 'Primal Fear', '一级恐惧', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(76, 'Big Fish', '大鱼老爸', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(77, 'Dear Diary', '公主日记', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(78, 'High School Musical', '歌舞青春', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(79, 'Melody', '两小无猜', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(80, 'My Girl', '我的小情人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(81, 'The Conjuring', '招魂', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(82, 'One Day', '一天', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(83, 'Detour', '迷途', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(84, 'Reservoir Dogs', '落水狗', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(85, 'Sleuth', '足迹', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(86, 'Cars', '汽车总动员', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(87, 'Despicable Me', '卑鄙的我', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(88, 'Hotel Transylvania', '精灵旅店', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(89, 'Turbo', '极速蜗牛', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(90, 'A Bug’s Life', '虫虫总动员', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(91, 'Final Destination', '死神来了', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(92, 'Kill Bill', '杀死比尔', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(93, 'Iron Man', '钢铁侠', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(94, 'Lord Of Ring', '指环王', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(95, 'Jurassic Park', '侏罗纪公园', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(96, 'V For Vendetta', 'V字仇杀队', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(97, 'The Bourne', '谍影重重', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(98, 'Speed', '生死时速', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(99, 'Blade', '刀锋战士', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(100, 'Mr. & Mrs. Smith', '史密斯夫妇', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(101, 'Saving Private Ryan', '拯救大兵瑞恩', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(102, 'Constantine', '地狱神探', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(103, 'The Matrix', '黑客帝国', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(104, 'Inception', '盗梦空间', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(105, 'Man On Fire', '怒火救援', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(106, 'Taken', '飓风营救', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(107, 'I Am Legend', '我是传奇', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(108, 'The Dark Knight', '蝙蝠侠2：黑暗骑士', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:23'),
(109, 'Spider-Man ,', '蜘蛛侠', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(110, 'Wanted', '刺客联盟', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(111, 'Eagle Eye', '鹰眼', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(112, 'The Incredibles', '超人总动员', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(113, 'The Terminator', '终结者', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(114, 'Transpotting', '猜火车', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(115, 'Monsters Inc.', '怪兽电力公司', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(116, 'Superman Returns', '超人归来', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(117, 'Gladiator', '角斗士', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(118, 'The Negotiator', '王牌对王牌', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(119, 'Collateral', '借刀杀人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(120, 'Seven', '七宗罪', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(121, 'Die Hard', '虎胆龙威', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(122, 'Indiana Jones', '夺宝奇兵', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(123, 'The Transporter', '非常人贩', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(124, 'King Kong', '金刚', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(125, 'Pirates Of The Caribbean', '加勒比海盗', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(126, 'Firehouse Dog', '消防犬', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(127, 'Cats & Dogs', '猫狗大战', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(128, 'Kung Fu Panda', '功夫熊猫', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(129, 'Hitman', '杀手代号47', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(130, 'Black Hawk Down', '黑鹰坠落', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(131, 'Now You See Me', '惊天魔盗团', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(132, 'Source Code', '源代码', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(133, 'Epic', '森林战士', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24'),
(134, 'Gone Girl', '消失的爱人', '0', 'Movie', '', '', NULL, '2014-12-22 07:56:24');

-- --------------------------------------------------------

--
-- 表的结构 `game_torrent`
--

CREATE TABLE IF NOT EXISTS `game_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` tinyint(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mail_verify`
--

CREATE TABLE IF NOT EXISTS `mail_verify` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL DEFAULT '',
  `code` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `mail_verify`
--

INSERT INTO `mail_verify` (`id`, `email`, `code`, `time`) VALUES
(1, '1084046180@qq.com', '5cea9dd934ed3bc83a7103c7b65d7f69', '2015-03-31 17:12:03');

-- --------------------------------------------------------

--
-- 表的结构 `movie_torrent`
--

CREATE TABLE IF NOT EXISTS `movie_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` int(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `up` int(11) NOT NULL DEFAULT '0',
  `down` int(11) NOT NULL DEFAULT '0',
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `movie_torrent`
--

INSERT INTO `movie_torrent` (`torrent_id`, `uid`, `title`, `post_link`, `filepath`, `file_size`, `file_count`, `md5`, `time`, `mtime_link`, `category`, `up`, `down`, `quality`, `download`) VALUES
(1, 1, '[爆裂鼓手]whiplash.2014.hdrip.xvid.juggs.etrg.torrent', '', 'data/torrent/1421239237/ad43563b68055ac399f4c943d9c41000.torrent', '709.21MB', 5, '99e815641092a2fca02e5daaf6c7ce0f', '2015-01-14 12:40:40', '', 'movie', 0, 0, 'HDRip', 39),
(2, 1, '[美国狙击手]American Sniper (2014) DVDScr x264 AAC 800MB SmartGuy.torrent', '', 'data/torrent/1421239455/24fdfa7465931269b92a1c62f55fb2bb.torrent', '804.14MB', 5, '1f8d3fd4490ef76980b80d825e916f94', '2015-01-14 12:44:19', '', 'movie', 1, 0, 'DVDSCR', 21),
(3, 1, '[夜行者]nightcrawler.2014.dvdscr.xvid.ac3.acab.torrent', '', 'data/torrent/1421239535/0f0fd55db5d2cd1bd8a43dab6efcd876.torrent', '825.9MB', 3, '0ee21571f92232d65e485a97f3b08777', '2015-01-14 12:45:40', '', 'movie', 0, 0, 'DVDSCR', 29),
(4, 1, '[狂怒]Fury.2014.1080p.torrent', '', 'data/torrent/1421453838/f519c86bbebfc96b78b8b52d92a92122.torrent', '1.96GB', 2, '7a202f610ca130149fc5537c2a8c42bf', '2015-01-17 00:17:22', '', 'movie', 0, 0, '1080p', 38),
(5, 1, '[法官老爹]The.Judge.2014.720p.torrent', '', 'data/torrent/1421453849/ed21e29f3eff3b070ae30a84cea7af97.torrent', '932.28MB', 2, '98007254e0d27c3248ba45365224f6ce', '2015-01-17 00:17:32', '', 'movie', 0, 0, '720p', 39),
(6, 1, '[法官老爹]The.Judge.2014.1080p.torrent', '', 'data/torrent/1421453859/e9a1e0c382f1e2ce4432a92b6cf492aa.torrent', '2.06GB', 2, '87589f22e052f1e94036db0b0ed87762', '2015-01-17 00:17:41', '', 'movie', 0, 0, '1080p', 41),
(7, 1, '[狂怒]Fury.2014.720p.torrent', '', 'data/torrent/1421453869/cd0ab411359631ecbe7df7f49074e8c1.torrent', '928.26MB', 2, 'c6ab36a8b15b687838ee39427bb87c6a', '2015-01-17 00:17:52', '', 'movie', 1, 0, '720p', 39),
(8, 1, '[木星上行]-Jupiter Ascending (2015) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617041/2db59f8806e3f205cbb92b6091767857.torrent', '874.08MB', 2, '2ec57d5ff571d741bdcd46277f3906f4', '2015-05-26 05:10:44', '', 'movie', 0, 0, '720p', 0),
(9, 1, '[银河护卫队]-Guardians Of The Galaxy (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617050/035dc81e5c7a926c70473c4a7b7c0f1f.torrent', '871.09MB', 2, 'b00e89a0cf0dc7e3788debe535ba4d13', '2015-05-26 05:10:56', '', 'movie', 0, 0, '720p', 0),
(10, 1, '[不速之客]-The Guest (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617069/4653d695c732834d933e6e8762cd0833.torrent', '757.05MB', 2, '28f9e4311415707f5067016afc655cb0', '2015-05-26 05:11:11', '', 'movie', 0, 0, '720p', 0),
(11, 1, '[X战警：逆转未来]-X Men Days Of Future Past (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617078/133da80005db8e83d028b5c8907cf3df.torrent', '877.39MB', 2, '2a89a0cd48a231c6ef8d3f13f4d7f0b5', '2015-05-26 05:11:20', '', 'movie', 0, 0, '720p', 0),
(12, 1, '[飓风营救3]-Taken 3 (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617090/110738722f859f99d5a4fab402fb6327.torrent', '814.77MB', 2, 'e6e6a4d58456b3608eee5efec19213ea', '2015-05-26 05:11:32', '', 'movie', 0, 0, '720p', 0),
(13, 1, '[王牌特工：特工学院]-Kingsman The Secret Service (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432617166/22a87bc639cb120af00407f3fc32ca32.torrent', '875.08MB', 2, 'dd9b7e47958f477e1e40b86992c8affb', '2015-05-26 05:12:47', '', 'movie', 0, 0, '720p', 0),
(14, 1, '[法官老爹]-The Judge (2014) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432618658/369fda8156fc785a71e9a382bbef968e.torrent', '932.28MB', 2, '0090b912e9cbff0338415d5d3d9bcc00', '2015-05-26 05:37:40', '', 'movie', 0, 0, '720p', 5),
(15, 1, '[机械姬]- Ex Machina (2015) [720p] YIFY - YTS.torrent', '', 'data/torrent/1432618667/974147a70717da0545cb6556da8a6331.torrent', '808.19MB', 2, '0eb509b1415d295921b9826f1dff18cc', '2015-05-26 05:37:52', '', 'movie', 0, 0, '720p', 4);

-- --------------------------------------------------------

--
-- 表的结构 `movie_torrent_cmt`
--

CREATE TABLE IF NOT EXISTS `movie_torrent_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `music_torrent`
--

CREATE TABLE IF NOT EXISTS `music_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` int(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `music_torrent_cmt`
--

CREATE TABLE IF NOT EXISTS `music_torrent_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `tags` varchar(150) NOT NULL,
  `category` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `download` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `subtitle`
--

CREATE TABLE IF NOT EXISTS `subtitle` (
  `subtitle_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filepath` varchar(150) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(15) NOT NULL,
  `quality` varchar(20) NOT NULL,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `post_link` varchar(150) NOT NULL DEFAULT '',
  `up` int(5) NOT NULL DEFAULT '0',
  `down` int(5) NOT NULL DEFAULT '0',
  `download` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subtitle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `subtitle`
--

INSERT INTO `subtitle` (`subtitle_id`, `uid`, `title`, `filepath`, `file_size`, `md5`, `time`, `category`, `quality`, `mtime_link`, `post_link`, `up`, `down`, `download`) VALUES
(1, 1, '[消失的爱人中英双字]Gone.Girl.2014.BRrip.ass', 'data/subtitle/1421239579/58955a2c496a9c3ec4336892d091f58d.ass', '398.27KB', 'caf049fc4eaa05788d757d5a53877169', '2015-01-14 12:46:30', 'movie', 'BRRip', '', '', 0, 0, 13),
(2, 1, '[霍比特人：意外之旅中英]The.Hobbit-An.Unexpected.Journey.2012.Extended.720p.BluRay.x264.AAC.srt', 'data/subtitle/1421239911/28f257e283fe65ca85d7673c7a4d6032.srt', '243.1KB', '4a15fe27edb0f9ae0ee64df960507569', '2015-01-14 12:51:59', 'movie', 'BluRay', '', '', 1, 0, 24);

-- --------------------------------------------------------

--
-- 表的结构 `subtitle_cmt`
--

CREATE TABLE IF NOT EXISTS `subtitle_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `subtitle_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `torrent_file`
--

CREATE TABLE IF NOT EXISTS `torrent_file` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` tinyint(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tv_torrent`
--

CREATE TABLE IF NOT EXISTS `tv_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(200) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` int(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `quality` varchar(15) NOT NULL,
  `up` int(4) NOT NULL DEFAULT '0',
  `down` int(4) NOT NULL DEFAULT '0',
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tv_torrent`
--

INSERT INTO `tv_torrent` (`torrent_id`, `uid`, `title`, `post_link`, `filepath`, `file_size`, `file_count`, `md5`, `time`, `mtime_link`, `category`, `quality`, `up`, `down`, `download`) VALUES
(1, 1, '[老友记全十季]friends.seasons.1.10.1080p.bdrip.x264.ac3.5.1.torrent', '', 'data/torrent/1421239315/fe946c878388caaeb5987c5289067828.torrent', '404.2GB', 233, '82af4c50a157578d3f0a9e6a52074d69', '2015-01-14 12:42:10', '', 'tv', 'BDRip', 0, 0, 24),
(2, 1, '[豪森医生1-8季]house.md.complete.series.seasons.1.8.torrent', '', 'data/torrent/1421239436/8b87818134066e7ed718b8afbdd3b1a9.torrent', '60.65GB', 176, '266a1486bca8c16238f7c97db986fd41', '2015-01-14 12:44:03', '', 'tv', 'Unknown', 4, 1, 25),
(3, 1, '[迷失全六季]lost.season.1.2.3.4.5.6.hdtv.dvd.box.set.extras.webisodes.deleted.scenes.interviews.etc.trusted1.torrent', '', 'data/torrent/1421456220/5946a1d9aaec139026ca35f16e16be8f.torrent', '52.23GB', 283, 'efea7ee41478f01233b28cc8b42455b7', '2015-01-17 00:57:05', '', 'tv', 'DVD', 0, 0, 15),
(4, 1, '[绝望主妇全8季]-Desperate.housewives.season.1.2.3.4.5.6.7.8.extras.dvdr.torrent', '', 'data/torrent/1432616781/e3464fead6b5f0d0bb6009df64b287a7.torrent', '64.12GB', 250, '8c81c3ccc880d2fb82d0dd4381124d8f', '2015-05-26 05:06:25', '', 'tv', 'DVD', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tv_torrent_cmt`
--

CREATE TABLE IF NOT EXISTS `tv_torrent_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `rand` varchar(32) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `signup_ip` varchar(15) NOT NULL DEFAULT '',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mail_verify` tinyint(1) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `forbid` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `email`, `password`, `rand`, `type`, `signup_ip`, `last_ip`, `reg_time`, `mail_verify`, `online`, `forbid`) VALUES
(1, 'NingerJohn', 'test@test.com', 'eab8722324dd180986954547a937b3c6', '747c1bcceb6109a4ef936bc70cfe67de', NULL, '180.109.245.192', '', '2015-05-26 12:10:38', 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_action`
--

CREATE TABLE IF NOT EXISTS `user_action` (
  `uid` int(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  `action_type` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `uid` int(8) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `real_name` varchar(20) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `birthday` varchar(12) DEFAULT NULL,
  `homeland` varchar(45) DEFAULT NULL,
  `live_place` varchar(45) DEFAULT NULL,
  `interest` varchar(100) DEFAULT '',
  `major` varchar(30) DEFAULT NULL,
  `job` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`uid`, `username`, `real_name`, `gender`, `birthday`, `homeland`, `live_place`, `interest`, `major`, `job`) VALUES
(1, NULL, 'Ninger;0', '1;1', '1989;1', '连云港;1', '南京;1', '电影:1;美剧:4;', '商务英语;1', '英语;1'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL),
(3, NULL, '刘军;1', '1;1', '25;1', '湖南;1', '湖南;1', '', ';1', ';1'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `video_torrent`
--

CREATE TABLE IF NOT EXISTS `video_torrent` (
  `torrent_id` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_link` varchar(150) DEFAULT '',
  `filepath` varchar(300) NOT NULL,
  `file_size` varchar(20) NOT NULL,
  `file_count` int(3) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mtime_link` varchar(150) NOT NULL DEFAULT '',
  `category` varchar(15) NOT NULL,
  `up` int(11) NOT NULL DEFAULT '0',
  `down` int(11) NOT NULL DEFAULT '0',
  `quality` varchar(15) NOT NULL,
  `download` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`torrent_id`),
  KEY `title` (`title`),
  KEY `title_2` (`title`),
  FULLTEXT KEY `title_3` (`title`),
  FULLTEXT KEY `title_4` (`title`),
  FULLTEXT KEY `title_5` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `video_torrent`
--

INSERT INTO `video_torrent` (`torrent_id`, `uid`, `title`, `post_link`, `filepath`, `file_size`, `file_count`, `md5`, `time`, `mtime_link`, `category`, `up`, `down`, `quality`, `download`) VALUES
(1, 1, '[Bootstrap基础教程]tutsplus.bootstrap.3.0.essentials.february.18.2014.torrent', '', 'data/torrent/1421239361/9774a76aaa3ffe2ed6885a068dbf9e88.torrent', '1.81GB', 19, '232a7cf316e189a490dea7f6d392e89a', '2015-01-14 12:42:50', '', 'video', 0, 0, 'Unknown', 47),
(2, 1, '[Web设计之Bootstrap]tutsplus.bootstrap.3.for.web.design.27.jun.2014.torrent', '', 'data/torrent/1421239379/dc7532f5c84684fad248523523fe6c61.torrent', '1.29GB', 19, '06053a1cdeb488a7bc2d4ae336aeb780', '2015-01-14 12:43:05', '', 'video', 1, 0, 'WEB', 60),
(3, 1, '[Angular JS视频教程]egghead.io.angular.js.torrent', '', 'data/torrent/1432616478/d55ca81e0a8af9c9258b3964ac0ffd37.torrent', '1004.08MB', 44, '81b24bd34cc2d387228a227a83002988', '2015-05-26 05:01:21', '', 'video', 0, 0, 'Unknown', 1),
(4, 1, '[ 通过Ionic框架与AngularJS构建手机应用 ] - building.mobile.apps.with.the.ionic.framework.and.angularjs.torrent', '', 'data/torrent/1432616578/5de09595fc719feb1d95a367b2de74c2.torrent', '719.85MB', 1, '2d45d54acea04546d4f1ff145ebaf1a1', '2015-05-26 05:03:02', '', 'video', 0, 0, 'Unknown', 0);

-- --------------------------------------------------------

--
-- 表的结构 `video_torrent_cmt`
--

CREATE TABLE IF NOT EXISTS `video_torrent_cmt` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `vshare`
--

CREATE TABLE IF NOT EXISTS `vshare` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `tags` varchar(150) NOT NULL,
  `category` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `download` int(8) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `vshare_cmt`
--

CREATE TABLE IF NOT EXISTS `vshare_cmt` (
  `cmt_id` int(10) NOT NULL,
  `vshare_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `content` varchar(300) CHARACTER SET latin1 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `at` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
