-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 03:03 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zhiva`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE `activations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `register_date` datetime NOT NULL,
  `key_generate_date` datetime NOT NULL,
  `private_key` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `register_date`, `key_generate_date`, `private_key`, `public_key`, `userid`) VALUES
(8, '2020-09-19 17:17:57', '2020-09-20 15:26:37', '555979', '158f759262c1fac18f6cf0c5fce9976109ae33c92c1600519677625.8', 15),
(9, '2020-09-20 14:26:51', '2020-09-20 14:26:51', '520113', '16c4402f17e4f1ffc6ae2cda63dd716392f7b3a0861600595811511.1', 16);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cityid` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` char(10) DEFAULT NULL,
  `customerid` bigint(20) UNSIGNED NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `cityid`, `address`, `postal_code`, `customerid`, `lat`, `lng`) VALUES
(16, 117, 'آدرس من', NULL, 4, 35.7163, 51.494),
(17, 117, 'دومین آدرس من', '1111111111', 4, 35.7164, 51.494),
(18, 117, 'سومین آدرس من', NULL, 4, 35.6993, 51.4515),
(19, 117, 'چهارمین آدرس من (ورزشگاه آزادی)', NULL, 4, 35.7241, 51.2719);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `provinceid` int(10) UNSIGNED NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `provinceid`, `city`) VALUES
(1, 1, 'تبريز'),
(2, 1, 'كندوان'),
(3, 1, 'بندر شرفخانه'),
(4, 1, 'مراغه'),
(5, 1, 'ميانه'),
(6, 1, 'شبستر'),
(7, 1, 'مرند'),
(8, 1, 'جلفا'),
(9, 1, 'سراب'),
(10, 1, 'هاديشهر'),
(11, 1, 'بناب'),
(12, 1, 'كليبر'),
(13, 1, 'تسوج'),
(14, 1, 'اهر'),
(15, 1, 'هريس'),
(16, 1, 'عجبشير'),
(17, 1, 'هشترود'),
(18, 1, 'ملكان'),
(19, 1, 'بستان آباد'),
(20, 1, 'ورزقان'),
(21, 1, 'اسكو'),
(22, 1, 'آذر شهر'),
(23, 1, 'قره آغاج'),
(24, 1, 'ممقان'),
(25, 1, 'صوفیان'),
(26, 1, 'ایلخچی'),
(27, 1, 'خسروشهر'),
(28, 1, 'باسمنج'),
(29, 1, 'سهند'),
(30, 2, 'اروميه'),
(31, 2, 'نقده'),
(32, 2, 'ماكو'),
(33, 2, 'تكاب'),
(34, 2, 'خوي'),
(35, 2, 'مهاباد'),
(36, 2, 'سر دشت'),
(37, 2, 'چالدران'),
(38, 2, 'بوكان'),
(39, 2, 'مياندوآب'),
(40, 2, 'سلماس'),
(41, 2, 'شاهين دژ'),
(42, 2, 'پيرانشهر'),
(43, 2, 'سيه چشمه'),
(44, 2, 'اشنويه'),
(45, 2, 'چایپاره'),
(46, 2, 'پلدشت'),
(47, 2, 'شوط'),
(48, 3, 'اردبيل'),
(49, 3, 'سرعين'),
(50, 3, 'بيله سوار'),
(51, 3, 'پارس آباد'),
(52, 3, 'خلخال'),
(53, 3, 'مشگين شهر'),
(54, 3, 'مغان'),
(55, 3, 'نمين'),
(56, 3, 'نير'),
(57, 3, 'كوثر'),
(58, 3, 'كيوي'),
(59, 3, 'گرمي'),
(60, 4, 'اصفهان'),
(61, 4, 'فريدن'),
(62, 4, 'فريدون شهر'),
(63, 4, 'فلاورجان'),
(64, 4, 'گلپايگان'),
(65, 4, 'دهاقان'),
(66, 4, 'نطنز'),
(67, 4, 'نايين'),
(68, 4, 'تيران'),
(69, 4, 'كاشان'),
(70, 4, 'فولاد شهر'),
(71, 4, 'اردستان'),
(72, 4, 'سميرم'),
(73, 4, 'درچه'),
(74, 4, 'کوهپایه'),
(75, 4, 'مباركه'),
(76, 4, 'شهرضا'),
(77, 4, 'خميني شهر'),
(78, 4, 'شاهين شهر'),
(79, 4, 'نجف آباد'),
(80, 4, 'دولت آباد'),
(81, 4, 'زرين شهر'),
(82, 4, 'آران و بيدگل'),
(83, 4, 'باغ بهادران'),
(84, 4, 'خوانسار'),
(85, 4, 'مهردشت'),
(86, 4, 'علويجه'),
(87, 4, 'عسگران'),
(88, 4, 'نهضت آباد'),
(89, 4, 'حاجي آباد'),
(90, 4, 'تودشک'),
(91, 4, 'ورزنه'),
(92, 6, 'ايلام'),
(93, 6, 'مهران'),
(94, 6, 'دهلران'),
(95, 6, 'آبدانان'),
(96, 6, 'شيروان چرداول'),
(97, 6, 'دره شهر'),
(98, 6, 'ايوان'),
(99, 6, 'سرابله'),
(100, 7, 'بوشهر'),
(101, 7, 'تنگستان'),
(102, 7, 'دشتستان'),
(103, 7, 'دير'),
(104, 7, 'ديلم'),
(105, 7, 'كنگان'),
(106, 7, 'گناوه'),
(107, 7, 'ريشهر'),
(108, 7, 'دشتي'),
(109, 7, 'خورموج'),
(110, 7, 'اهرم'),
(111, 7, 'برازجان'),
(112, 7, 'خارك'),
(113, 7, 'جم'),
(114, 7, 'کاکی'),
(115, 7, 'عسلویه'),
(116, 7, 'بردخون'),
(117, 8, 'تهران'),
(118, 8, 'ورامين'),
(119, 8, 'فيروزكوه'),
(120, 8, 'ري'),
(121, 8, 'دماوند'),
(122, 8, 'اسلامشهر'),
(123, 8, 'رودهن'),
(124, 8, 'لواسان'),
(125, 8, 'بومهن'),
(126, 8, 'تجريش'),
(127, 8, 'فشم'),
(128, 8, 'كهريزك'),
(129, 8, 'پاكدشت'),
(130, 8, 'چهاردانگه'),
(131, 8, 'شريف آباد'),
(132, 8, 'قرچك'),
(133, 8, 'باقرشهر'),
(134, 8, 'شهريار'),
(135, 8, 'رباط كريم'),
(136, 8, 'قدس'),
(137, 8, 'ملارد'),
(138, 9, 'شهركرد'),
(139, 9, 'فارسان'),
(140, 9, 'بروجن'),
(141, 9, 'چلگرد'),
(142, 9, 'اردل'),
(143, 9, 'لردگان'),
(144, 9, 'سامان'),
(145, 10, 'قائن'),
(146, 10, 'فردوس'),
(147, 10, 'بيرجند'),
(148, 10, 'نهبندان'),
(149, 10, 'سربيشه'),
(150, 10, 'طبس مسینا'),
(151, 10, 'قهستان'),
(152, 10, 'درمیان'),
(153, 11, 'مشهد'),
(154, 11, 'نيشابور'),
(155, 11, 'سبزوار'),
(156, 11, 'كاشمر'),
(157, 11, 'گناباد'),
(158, 11, 'طبس'),
(159, 11, 'تربت حيدريه'),
(160, 11, 'خواف'),
(161, 11, 'تربت جام'),
(162, 11, 'تايباد'),
(163, 11, 'قوچان'),
(164, 11, 'سرخس'),
(165, 11, 'بردسكن'),
(166, 11, 'فريمان'),
(167, 11, 'چناران'),
(168, 11, 'درگز'),
(169, 11, 'كلات'),
(170, 11, 'طرقبه'),
(171, 11, 'سر ولایت'),
(172, 12, 'بجنورد'),
(173, 12, 'اسفراين'),
(174, 12, 'جاجرم'),
(175, 12, 'شيروان'),
(176, 12, 'آشخانه'),
(177, 12, 'گرمه'),
(178, 12, 'ساروج'),
(179, 13, 'اهواز'),
(180, 13, 'ايرانشهر'),
(181, 13, 'شوش'),
(182, 13, 'آبادان'),
(183, 13, 'خرمشهر'),
(184, 13, 'مسجد سليمان'),
(185, 13, 'ايذه'),
(186, 13, 'شوشتر'),
(187, 13, 'انديمشك'),
(188, 13, 'سوسنگرد'),
(189, 13, 'هويزه'),
(190, 13, 'دزفول'),
(191, 13, 'شادگان'),
(192, 13, 'بندر ماهشهر'),
(193, 13, 'بندر امام خميني'),
(194, 13, 'اميديه'),
(195, 13, 'بهبهان'),
(196, 13, 'رامهرمز'),
(197, 13, 'باغ ملك'),
(198, 13, 'هنديجان'),
(199, 13, 'لالي'),
(200, 13, 'رامشیر'),
(201, 13, 'حمیدیه'),
(202, 13, 'دغاغله'),
(203, 13, 'ملاثانی'),
(204, 13, 'شادگان'),
(205, 13, 'ویسی'),
(206, 14, 'زنجان'),
(207, 14, 'ابهر'),
(208, 14, 'خدابنده'),
(209, 14, 'كارم'),
(210, 14, 'ماهنشان'),
(211, 14, 'خرمدره'),
(212, 14, 'ايجرود'),
(213, 14, 'زرين آباد'),
(214, 14, 'آب بر'),
(215, 14, 'قيدار'),
(216, 15, 'سمنان'),
(217, 15, 'شاهرود'),
(218, 15, 'گرمسار'),
(219, 15, 'ايوانكي'),
(220, 15, 'دامغان'),
(221, 15, 'بسطام'),
(222, 16, 'زاهدان'),
(223, 16, 'چابهار'),
(224, 16, 'خاش'),
(225, 16, 'سراوان'),
(226, 16, 'زابل'),
(227, 16, 'سرباز'),
(228, 16, 'نيكشهر'),
(229, 16, 'ايرانشهر'),
(230, 16, 'راسك'),
(231, 16, 'ميرجاوه'),
(232, 17, 'شيراز'),
(233, 17, 'اقليد'),
(234, 17, 'داراب'),
(235, 17, 'فسا'),
(236, 17, 'مرودشت'),
(237, 17, 'خرم بيد'),
(238, 17, 'آباده'),
(239, 17, 'كازرون'),
(240, 17, 'ممسني'),
(241, 17, 'سپيدان'),
(242, 17, 'لار'),
(243, 17, 'فيروز آباد'),
(244, 17, 'جهرم'),
(245, 17, 'ني ريز'),
(246, 17, 'استهبان'),
(247, 17, 'لامرد'),
(248, 17, 'مهر'),
(249, 17, 'حاجي آباد'),
(250, 17, 'نورآباد'),
(251, 17, 'اردكان'),
(252, 17, 'صفاشهر'),
(253, 17, 'ارسنجان'),
(254, 17, 'قيروكارزين'),
(255, 17, 'سوريان'),
(256, 17, 'فراشبند'),
(257, 17, 'سروستان'),
(258, 17, 'ارژن'),
(259, 17, 'گويم'),
(260, 17, 'داريون'),
(261, 17, 'زرقان'),
(262, 17, 'خان زنیان'),
(263, 17, 'کوار'),
(264, 17, 'ده بید'),
(265, 17, 'باب انار/خفر'),
(266, 17, 'بوانات'),
(267, 17, 'خرامه'),
(268, 17, 'خنج'),
(269, 17, 'سیاخ دارنگون'),
(270, 18, 'قزوين'),
(271, 18, 'تاكستان'),
(272, 18, 'آبيك'),
(273, 18, 'بوئين زهرا'),
(274, 19, 'قم'),
(275, 5, 'طالقان'),
(276, 5, 'نظرآباد'),
(277, 5, 'اشتهارد'),
(278, 5, 'هشتگرد'),
(279, 5, 'كن'),
(280, 5, 'آسارا'),
(281, 5, 'شهرک گلستان'),
(282, 5, 'اندیشه'),
(283, 5, 'كرج'),
(284, 5, 'نظر آباد'),
(285, 5, 'گوهردشت'),
(286, 5, 'ماهدشت'),
(287, 5, 'مشکین دشت'),
(288, 20, 'سنندج'),
(289, 20, 'ديواندره'),
(290, 20, 'بانه'),
(291, 20, 'بيجار'),
(292, 20, 'سقز'),
(293, 20, 'كامياران'),
(294, 20, 'قروه'),
(295, 20, 'مريوان'),
(296, 20, 'صلوات آباد'),
(297, 20, 'حسن آباد'),
(298, 21, 'كرمان'),
(299, 21, 'راور'),
(300, 21, 'بابك'),
(301, 21, 'انار'),
(302, 21, 'کوهبنان'),
(303, 21, 'رفسنجان'),
(304, 21, 'بافت'),
(305, 21, 'سيرجان'),
(306, 21, 'كهنوج'),
(307, 21, 'زرند'),
(308, 21, 'بم'),
(309, 21, 'جيرفت'),
(310, 21, 'بردسير'),
(311, 22, 'كرمانشاه'),
(312, 22, 'اسلام آباد غرب'),
(313, 22, 'سر پل ذهاب'),
(314, 22, 'كنگاور'),
(315, 22, 'سنقر'),
(316, 22, 'قصر شيرين'),
(317, 22, 'گيلان غرب'),
(318, 22, 'هرسين'),
(319, 22, 'صحنه'),
(320, 22, 'پاوه'),
(321, 22, 'جوانرود'),
(322, 22, 'شاهو'),
(323, 23, 'ياسوج'),
(324, 23, 'گچساران'),
(325, 23, 'دنا'),
(326, 23, 'دوگنبدان'),
(327, 23, 'سي سخت'),
(328, 23, 'دهدشت'),
(329, 23, 'ليكك'),
(330, 24, 'گرگان'),
(331, 24, 'آق قلا'),
(332, 24, 'گنبد كاووس'),
(333, 24, 'علي آباد كتول'),
(334, 24, 'مينو دشت'),
(335, 24, 'تركمن'),
(336, 24, 'كردكوي'),
(337, 24, 'بندر گز'),
(338, 24, 'كلاله'),
(339, 24, 'آزاد شهر'),
(340, 24, 'راميان'),
(341, 25, 'رشت'),
(342, 25, 'منجيل'),
(343, 25, 'لنگرود'),
(344, 25, 'رود سر'),
(345, 25, 'تالش'),
(346, 25, 'آستارا'),
(347, 25, 'ماسوله'),
(348, 25, 'آستانه اشرفيه'),
(349, 25, 'رودبار'),
(350, 25, 'فومن'),
(351, 25, 'صومعه سرا'),
(352, 25, 'بندرانزلي'),
(353, 25, 'كلاچاي'),
(354, 25, 'هشتپر'),
(355, 25, 'رضوان شهر'),
(356, 25, 'ماسال'),
(357, 25, 'شفت'),
(358, 25, 'سياهكل'),
(359, 25, 'املش'),
(360, 25, 'لاهیجان'),
(361, 25, 'خشک بيجار'),
(362, 25, 'خمام'),
(363, 25, 'لشت نشا'),
(364, 25, 'بندر کياشهر'),
(365, 26, 'خرم آباد'),
(366, 26, 'ماهشهر'),
(367, 26, 'دزفول'),
(368, 26, 'بروجرد'),
(369, 26, 'دورود'),
(370, 26, 'اليگودرز'),
(371, 26, 'ازنا'),
(372, 26, 'نور آباد'),
(373, 26, 'كوهدشت'),
(374, 26, 'الشتر'),
(375, 26, 'پلدختر'),
(376, 27, 'ساري'),
(377, 27, 'آمل'),
(378, 27, 'بابل'),
(379, 27, 'بابلسر'),
(380, 27, 'بهشهر'),
(381, 27, 'تنكابن'),
(382, 27, 'جويبار'),
(383, 27, 'چالوس'),
(384, 27, 'رامسر'),
(385, 27, 'سواد كوه'),
(386, 27, 'قائم شهر'),
(387, 27, 'نكا'),
(388, 27, 'نور'),
(389, 27, 'بلده'),
(390, 27, 'نوشهر'),
(391, 27, 'پل سفيد'),
(392, 27, 'محمود آباد'),
(393, 27, 'فريدون كنار'),
(394, 28, 'اراك'),
(395, 28, 'آشتيان'),
(396, 28, 'تفرش'),
(397, 28, 'خمين'),
(398, 28, 'دليجان'),
(399, 28, 'ساوه'),
(400, 28, 'سربند'),
(401, 28, 'محلات'),
(402, 28, 'شازند'),
(403, 29, 'بندرعباس'),
(404, 29, 'قشم'),
(405, 29, 'كيش'),
(406, 29, 'بندر لنگه'),
(407, 29, 'بستك'),
(408, 29, 'حاجي آباد'),
(409, 29, 'دهبارز'),
(410, 29, 'انگهران'),
(411, 29, 'ميناب'),
(412, 29, 'ابوموسي'),
(413, 29, 'بندر جاسك'),
(414, 29, 'تنب بزرگ'),
(415, 29, 'بندر خمیر'),
(416, 29, 'پارسیان'),
(417, 29, 'قشم'),
(418, 30, 'همدان'),
(419, 30, 'ملاير'),
(420, 30, 'تويسركان'),
(421, 30, 'نهاوند'),
(422, 30, 'كبودر اهنگ'),
(423, 30, 'رزن'),
(424, 30, 'اسدآباد'),
(425, 30, 'بهار'),
(426, 31, 'يزد'),
(427, 31, 'تفت'),
(428, 31, 'اردكان'),
(429, 31, 'ابركوه'),
(430, 31, 'ميبد'),
(431, 31, 'طبس'),
(432, 31, 'بافق'),
(433, 31, 'مهريز'),
(434, 31, 'اشكذر'),
(435, 31, 'هرات'),
(436, 31, 'خضرآباد'),
(437, 31, 'شاهديه'),
(438, 31, 'حمیدیه شهر'),
(439, 31, 'سید میرزا'),
(440, 31, 'زارچ');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `familiy` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `userid`, `name`, `familiy`, `email`, `phone`) VALUES
(4, 15, 'کوروش', 'سیف اشرفی', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dr_comments`
--

CREATE TABLE `dr_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `approved` smallint(1) NOT NULL COMMENT '3=notApproved,1=general,2=private',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `replay` bigint(20) UNSIGNED DEFAULT NULL,
  `insert_time` datetime NOT NULL,
  `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_comments`
--

INSERT INTO `dr_comments` (`id`, `productid`, `userid`, `approved`, `comment`, `replay`, `insert_time`, `ip`, `device`) VALUES
(1, 6, 15, 1, 'asd', NULL, '2020-09-22 14:49:09', '::1', 'Unknown - Windows 10 - Chrome 85.0.4183'),
(2, 6, 15, 1, 'سلام.\r\nسوال داشتم', NULL, '2020-09-22 14:56:01', '::1', 'Unknown - Windows 10 - Chrome 85.0.4183'),
(3, 6, 15, 1, 'بله بفرمایین', 2, '2020-10-31 11:16:19', '::1', 'Unknown - Windows 10 - Chrome 86.0.4240'),
(4, 6, 15, 1, 'منم سوال دارم', NULL, '2020-10-31 11:16:59', '::1', 'Unknown - Windows 10 - Chrome 86.0.4240'),
(5, 6, 15, 1, 'در خدمتم', 4, '2020-10-31 15:17:28', '::1', 'Unknown - Windows 10 - Chrome 86.0.4240');

-- --------------------------------------------------------

--
-- Table structure for table `dr_countries`
--

CREATE TABLE `dr_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_countries`
--

INSERT INTO `dr_countries` (`id`, `country`, `flag`) VALUES
(1, 'Afghanistan', 'af.png'),
(2, 'Albania', 'al.png'),
(3, 'Algeria', 'dz.png'),
(4, 'American Samoa', 'as.png'),
(5, 'Andorra', 'ad.png'),
(6, 'Angola', 'ao.png'),
(7, 'Anguilla', 'ai.png'),
(8, 'Antarctica', 'aq.png'),
(9, 'Antigua and Barbuda', 'ag.png'),
(10, 'Argentina', 'ar.png'),
(11, 'Armenia', 'am.png'),
(12, 'Aruba', 'aw.png'),
(13, 'Australia', 'au.png'),
(14, 'Austria', 'at.png'),
(15, 'Azerbaijan', 'az.png'),
(16, 'Bahamas', 'bs.png'),
(17, 'Bahrain', 'bh.png'),
(18, 'Bangladesh', 'bd.png'),
(19, 'Barbados', 'bb.png'),
(20, 'Belarus', 'by.png'),
(21, 'Belgium', 'be.png'),
(22, 'Belize', 'bz.png'),
(23, 'Benin', 'bj.png'),
(24, 'Bermuda', 'bm.png'),
(25, 'Bhutan', 'bt.png'),
(26, 'Bolivia', 'bo.png'),
(27, 'Bosnia and Herzegovina', 'ba.png'),
(28, 'Botswana', 'bw.png'),
(29, 'Bouvet Island', 'bv.png'),
(30, 'Brazil', 'br.png'),
(31, 'British Indian Ocean Territory', 'io.png'),
(32, 'Brunei Darussalam', 'bn.png'),
(33, 'Bulgaria', 'bg.png'),
(34, 'Burkina Faso', 'bf.png'),
(35, 'Burundi', 'bi.png'),
(36, 'Cambodia', 'kh.png'),
(37, 'Cameroon', 'cm.png'),
(38, 'Canada', 'ca.png'),
(39, 'Cape Verde', 'cv.png'),
(40, 'Cayman Islands', 'ky.png'),
(41, 'Central African Republic', 'cf.png'),
(42, 'Chad', 'td.png'),
(43, 'Chile', 'cl.png'),
(44, 'China', 'cn.png'),
(45, 'Christmas Island', 'cx.png'),
(46, 'Cocos (Keeling) Islands', 'cc.png'),
(47, 'Colombia', 'co.png'),
(48, 'Comoros', 'km.png'),
(49, 'Congo', 'cg.png'),
(50, 'Congo, the Democratic Republic of the', 'cd.png'),
(51, 'Cook Islands', 'ck.png'),
(52, 'Costa Rica', 'cr.png'),
(53, 'Cote D\'Ivoire', 'ci.png'),
(54, 'Croatia', 'hr.png'),
(55, 'Cuba', 'cu.png'),
(56, 'Cyprus', 'cy.png'),
(57, 'Czech Republic', 'cz.png'),
(58, 'Denmark', 'dk.png'),
(59, 'Djibouti', 'dj.png'),
(60, 'Dominica', 'dm.png'),
(61, 'Dominican Republic', 'do.png'),
(62, 'Ecuador', 'ec.png'),
(63, 'Egypt', 'eg.png'),
(64, 'El Salvador', 'sv.png'),
(65, 'Equatorial Guinea', 'gq.png'),
(66, 'Eritrea', 'er.png'),
(67, 'Estonia', 'ee.png'),
(68, 'Ethiopia', 'et.png'),
(69, 'Falkland Islands (Malvinas)', 'fk.png'),
(70, 'Faroe Islands', 'fo.png'),
(71, 'Fiji', 'fj.png'),
(72, 'Finland', 'fi.png'),
(73, 'France', 'fr.png'),
(74, 'French Guiana', 'gf.png'),
(75, 'French Polynesia', 'pf.png'),
(76, 'French Southern Territories', 'tf.png'),
(77, 'Gabon', 'ga.png'),
(78, 'Gambia', 'gm.png'),
(79, 'Georgia', 'ge.png'),
(80, 'Germany', 'de.png'),
(81, 'Ghana', 'gh.png'),
(82, 'Gibraltar', 'gi.png'),
(83, 'Greece', 'gr.png'),
(84, 'Greenland', 'gl.png'),
(85, 'Grenada', 'gd.png'),
(86, 'Guadeloupe', 'gp.png'),
(87, 'Guam', 'gu.png'),
(88, 'Guatemala', 'gt.png'),
(89, 'Guinea', 'gn.png'),
(90, 'Guinea-Bissau', 'gw.png'),
(91, 'Guyana', 'gy.png'),
(92, 'Haiti', 'ht.png'),
(93, 'Heard Island and Mcdonald Islands', 'hm.png'),
(94, 'Holy See (Vatican City State)', 'va.png'),
(95, 'Honduras', 'hn.png'),
(96, 'Hong Kong', 'hk.png'),
(97, 'Hungary', 'hu.png'),
(98, 'Iceland', 'is.png'),
(99, 'India', 'in.png'),
(100, 'Indonesia', 'id.png'),
(101, 'Iran, Islamic Republic of', 'ir.png'),
(102, 'Iraq', 'iq.png'),
(103, 'Ireland', 'ie.png'),
(104, 'Israel', 'il.png'),
(105, 'Italy', 'it.png'),
(106, 'Jamaica', 'jm.png'),
(107, 'Japan', 'jp.png'),
(108, 'Jordan', 'jo.png'),
(109, 'Kazakhstan', 'kz.png'),
(110, 'Kenya', 'ke.png'),
(111, 'Kiribati', 'ki.png'),
(112, 'Korea, Democratic People\'s Republic of', 'kp.png'),
(113, 'Korea, Republic of', 'kr.png'),
(114, 'Kuwait', 'kw.png'),
(115, 'Kyrgyzstan', 'kg.png'),
(116, 'Lao People\'s Democratic Republic', 'la.png'),
(117, 'Latvia', 'lv.png'),
(118, 'Lebanon', 'lb.png'),
(119, 'Lesotho', 'ls.png'),
(120, 'Liberia', 'lr.png'),
(121, 'Libyan Arab Jamahiriya', 'ly.png'),
(122, 'Liechtenstein', 'li.png'),
(123, 'Lithuania', 'lt.png'),
(124, 'Luxembourg', 'lu.png'),
(125, 'Macao', 'mo.png'),
(126, 'Macedonia, the Former Yugoslav Republic of', 'mk.png'),
(127, 'Madagascar', 'mg.png'),
(128, 'Malawi', 'mw.png'),
(129, 'Malaysia', 'my.png'),
(130, 'Maldives', 'mv.png'),
(131, 'Mali', 'ml.png'),
(132, 'Malta', 'mt.png'),
(133, 'Marshall Islands', 'mh.png'),
(134, 'Martinique', 'mq.png'),
(135, 'Mauritania', 'mr.png'),
(136, 'Mauritius', 'mu.png'),
(137, 'Mayotte', 'yt.png'),
(138, 'Mexico', 'mx.png'),
(139, 'Micronesia, Federated States of', 'fm.png'),
(140, 'Moldova, Republic of', 'md.png'),
(141, 'Monaco', 'mc.png'),
(142, 'Mongolia', 'mn.png'),
(143, 'Montserrat', 'ms.png'),
(144, 'Morocco', 'ma.png'),
(145, 'Mozambique', 'mz.png'),
(146, 'Myanmar', 'mm.png'),
(147, 'Namibia', 'na.png'),
(148, 'Nauru', 'nr.png'),
(149, 'Nepal', 'np.png'),
(150, 'Netherlands', 'nl.png'),
(151, 'Netherlands Antilles', 'an.png'),
(152, 'New Caledonia', 'nc.png'),
(153, 'New Zealand', 'nz.png'),
(154, 'Nicaragua', 'ni.png'),
(155, 'Niger', 'ne.png'),
(156, 'Nigeria', 'ng.png'),
(157, 'Niue', 'nu.png'),
(158, 'Norfolk Island', 'nf.png'),
(159, 'Northern Mariana Islands', 'mp.png'),
(160, 'Norway', 'no.png'),
(161, 'Oman', 'om.png'),
(162, 'Pakistan', 'pk.png'),
(163, 'Palau', 'pw.png'),
(164, 'Palestinian Territory, Occupied', 'ps.png'),
(165, 'Panama', 'pa.png'),
(166, 'Papua New Guinea', 'pg.png'),
(167, 'Paraguay', 'py.png'),
(168, 'Peru', 'pe.png'),
(169, 'Philippines', 'ph.png'),
(170, 'Pitcairn', 'pn.png'),
(171, 'Poland', 'pl.png'),
(172, 'Portugal', 'pt.png'),
(173, 'Puerto Rico', 'pr.png'),
(174, 'Qatar', 'qa.png'),
(175, 'Reunion', 're.png'),
(176, 'Romania', 'ro.png'),
(177, 'Russian Federation', 'ru.png'),
(178, 'Rwanda', 'rw.png'),
(179, 'Saint Helena', 'sh.png'),
(180, 'Saint Kitts and Nevis', 'kn.png'),
(181, 'Saint Lucia', 'lc.png'),
(182, 'Saint Pierre and Miquelon', 'pm.png'),
(183, 'Saint Vincent and the Grenadines', 'vc.png'),
(184, 'Samoa', 'ws.png'),
(185, 'San Marino', 'sm.png'),
(186, 'Sao Tome and Principe', 'st.png'),
(187, 'Saudi Arabia', 'sa.png'),
(188, 'Senegal', 'sn.png'),
(189, 'Serbia and Montenegro', 'cs.png'),
(190, 'Seychelles', 'sc.png'),
(191, 'Sierra Leone', 'sl.png'),
(192, 'Singapore', 'sg.png'),
(193, 'Slovakia', 'sk.png'),
(194, 'Slovenia', 'si.png'),
(195, 'Solomon Islands', 'sb.png'),
(196, 'Somalia', 'so.png'),
(197, 'South Africa', 'za.png'),
(198, 'South Georgia and the South Sandwich Islands', 'gs.png'),
(199, 'Spain', 'es.png'),
(200, 'Sri Lanka', 'lk.png'),
(201, 'Sudan', 'sd.png'),
(202, 'Suriname', 'sr.png'),
(203, 'Svalbard and Jan Mayen', 'sj.png'),
(204, 'Swaziland', 'sz.png'),
(205, 'Sweden', 'se.png'),
(206, 'Switzerland', 'ch.png'),
(207, 'Syrian Arab Republic', 'sy.png'),
(208, 'Taiwan, Province of China', 'tw.png'),
(209, 'Tajikistan', 'tj.png'),
(210, 'Tanzania, United Republic of', 'tz.png'),
(211, 'Thailand', 'th.png'),
(212, 'Timor-Leste', 'tl.png'),
(213, 'Togo', 'tg.png'),
(214, 'Tokelau', 'tk.png'),
(215, 'Tonga', 'to.png'),
(216, 'Trinidad and Tobago', 'tt.png'),
(217, 'Tunisia', 'tn'),
(218, 'Turkey', 'tr.png'),
(219, 'Turkmenistan', 'tm.png'),
(220, 'Turks and Caicos Islands', 'tc.png'),
(221, 'Tuvalu', 'tv.png'),
(222, 'Uganda', 'ug.png'),
(223, 'Ukraine', 'ua.png'),
(224, 'United Arab Emirates', 'ae.png'),
(225, 'United Kingdom', 'gb.png'),
(226, 'United States', 'us.png'),
(227, 'United States Minor Outlying Islands', 'um.png'),
(228, 'Uruguay', 'uy.png'),
(229, 'Uzbekistan', 'uz.png'),
(230, 'Vanuatu', 'vu.png'),
(231, 'Venezuela', 've.png'),
(232, 'Viet Nam', 'vn.png'),
(233, 'Virgin Islands, British', 'vg.png'),
(234, 'Virgin Islands, U.s.', 'vi.png'),
(235, 'Wallis and Futuna', 'wf.png'),
(236, 'Western Sahara', 'eh.png'),
(237, 'Yemen', 'ye.png'),
(238, 'Zambia', 'zm.png'),
(239, 'Zimbabwe', 'zw.png');

-- --------------------------------------------------------

--
-- Table structure for table `dr_factors`
--

CREATE TABLE `dr_factors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_price` bigint(20) UNSIGNED NOT NULL,
  `payment_type` int(1) NOT NULL COMMENT '1=online',
  `discount` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL COMMENT '0=before_bank,1=success,2=failed',
  `addressid` bigint(20) UNSIGNED NOT NULL,
  `insert_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dr_helpful_comments`
--

CREATE TABLE `dr_helpful_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commentid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `insert_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dr_hottest_products`
--

CREATE TABLE `dr_hottest_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `serialization` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dr_manufacturers`
--

CREATE TABLE `dr_manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `countryid` bigint(20) UNSIGNED NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_manufacturers`
--

INSERT INTO `dr_manufacturers` (`id`, `countryid`, `company`, `company_en`, `website`) VALUES
(1, 1, 'تست', 'test', 'https://www.google.com/'),
(3, 226, 'اوپتیمم', 'optimum', 'https://www.google.com/'),
(4, 80, 'شرکت یک', 'comapny 1', 'http://german.com');

-- --------------------------------------------------------

--
-- Table structure for table `dr_meta_products`
--

CREATE TABLE `dr_meta_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `canonical` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_meta_products`
--

INSERT INTO `dr_meta_products` (`id`, `title`, `description`, `keywords`, `slug`, `canonical`, `redirect`) VALUES
(6, 'کراتین منوهیدرات', 'کراتین منوهیدرات برای افزایش توان عالی است.', 'کراتین منوهیدرات', '%DA%A9%D8%B1%D8%A7%D8%AA%DB%8C%D9%86-%D9%85%D9%86%D9%88%D9%87%DB%8C%D8%AF%D8%B1%D8%A7%D8%AA', NULL, NULL),
(14, 'asd', 'sasd', 'asd', 'asd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dr_meta_tags`
--

CREATE TABLE `dr_meta_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `tagid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_meta_tags`
--

INSERT INTO `dr_meta_tags` (`id`, `productid`, `tagid`) VALUES
(4, 6, 2),
(5, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dr_nutritions`
--

CREATE TABLE `dr_nutritions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `p_optionid` bigint(20) UNSIGNED NOT NULL,
  `p_tasteid` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dailyneed` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_nutritions`
--

INSERT INTO `dr_nutritions` (`id`, `productid`, `p_optionid`, `p_tasteid`, `title`, `amount`, `dailyneed`) VALUES
(4, 6, 10, 1, 'nothing', '0 gr', '*'),
(5, 6, 9, 1, 'creatine', '6 gr', '*'),
(6, 6, 10, 1, 'creatine', '5 gr', '*'),
(7, 6, 10, 2, 'ala', '3 mg', '*');

-- --------------------------------------------------------

--
-- Table structure for table `dr_products`
--

CREATE TABLE `dr_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `metaid` bigint(20) UNSIGNED NOT NULL,
  `fa_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serving_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visit` bigint(20) UNSIGNED NOT NULL,
  `darft` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_products`
--

INSERT INTO `dr_products` (`id`, `metaid`, `fa_name`, `en_name`, `serving_size`, `visit`, `darft`) VALUES
(6, 6, 'کراتین منوهیدرات', 'creatine monohydrate', '1 اسکوپ (5 گرم)', 0, 0),
(14, 14, 'asd', 'asd', 'asd', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dr_product_details`
--

CREATE TABLE `dr_product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `p_optionid` bigint(20) UNSIGNED DEFAULT NULL,
  `p_tasteid` bigint(20) UNSIGNED DEFAULT NULL,
  `img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `off` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_product_details`
--

INSERT INTO `dr_product_details` (`id`, `productid`, `p_optionid`, `p_tasteid`, `img`, `stock`, `off`, `is_default`) VALUES
(11, 6, 9, 1, 'http://localhost/zhivafit/public/supplement/products/6/9-1', 0, 0, 0),
(12, 6, 10, 1, 'http://localhost/zhivafit/public/supplement/products/6/10-1', 7, 2000, 1),
(13, 6, 10, 2, 'http://localhost/zhivafit/public/supplement/products/6/10-2', 2, 0, 0),
(14, 14, 12, 1, 'http://localhost/zhivafit/public/supplement/products/14/12-1', 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dr_product_manufacturers`
--

CREATE TABLE `dr_product_manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufacturerid` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_product_manufacturers`
--

INSERT INTO `dr_product_manufacturers` (`id`, `manufacturerid`, `productid`) VALUES
(5, 3, 6),
(9, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `dr_product_navs`
--

CREATE TABLE `dr_product_navs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `navid` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_product_navs`
--

INSERT INTO `dr_product_navs` (`id`, `productid`, `navid`, `is_default`) VALUES
(7, 6, 8, 1),
(12, 14, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dr_product_options`
--

CREATE TABLE `dr_product_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `type` int(1) NOT NULL COMMENT '1=weight,2=dosage,3=tablet',
  `value` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_product_options`
--

INSERT INTO `dr_product_options` (`id`, `productid`, `type`, `value`, `price`) VALUES
(9, 6, 1, '100 گرم', 30000),
(10, 6, 1, '300 گرم', 87000),
(12, 14, 1, '1 kg', 700000);

-- --------------------------------------------------------

--
-- Table structure for table `dr_product_tastes`
--

CREATE TABLE `dr_product_tastes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `optionid` bigint(20) UNSIGNED NOT NULL,
  `tasteid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_product_tastes`
--

INSERT INTO `dr_product_tastes` (`id`, `optionid`, `tasteid`) VALUES
(7, 9, 1),
(8, 10, 1),
(9, 10, 2),
(11, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dr_properties`
--

CREATE TABLE `dr_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `property` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `fani` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`fani`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_properties`
--

INSERT INTO `dr_properties` (`id`, `productid`, `property`, `fani`) VALUES
(6, 6, '{\"key\":[\"\\u062a\\u0628 \\u06cc\\u06a9\",\"\\u062a\\u0628 \\u062f\\u0648\\u0645\"],\"value\":[\"<p>\\u0645\\u062d\\u062a\\u0648\\u0627 \\u06cc\\u06a9<\\/p>\",\"<p>\\u0645\\u062d\\u062a\\u0648\\u0627 \\u062f\\u0648\\u0645<\\/p>\"]}', '{\"\\u0645\\u0642\\u062f\\u0627\\u0631 \\u0641\\u0646\\u06cc \\u06cc\\u06a9\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0641\\u0646 \\u06cc\\u06a9\",\"\\u0645\\u0642\\u062f\\u0627\\u0631 \\u0641\\u0646\\u06cc \\u062f\\u0648\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0641\\u0646 \\u062f\\u0648\"}'),
(10, 14, '{\"key\":[\"asd\"],\"value\":[\"<p>asd asd<p>asd<\\/p><p><img src=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/assets\\/images\\/items\\/load.svg\\\" alt=\\\"asd\\\" width=\\\"633\\\" height=\\\"479\\\" class=\\\"lazy\\\" srcset=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/3.png 633w,http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/mobile\\/3.png 400w\\\" sizes=\\\"(max-width: 425px) 400px, 633px\\\" data-src=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/3.png\\\"><\\/p><p>&nbsp;<\\/p><p>asd<\\/p><p><img src=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/assets\\/images\\/items\\/load.svg\\\" alt=\\\"a\\\" width=\\\"641\\\" height=\\\"479\\\" class=\\\"lazy\\\" srcset=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/1.png 641w,http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/mobile\\/1.png 400w\\\" sizes=\\\"(max-width: 425px) 400px, 641px\\\" data-src=\\\"http:\\/\\/localhost\\/zhivafit\\/public\\/supplement\\/info\\/20-09\\/1.png\\\"><\\/p><\\/p>\\n\"]}', '{\"asd\":\"asd\"}');

-- --------------------------------------------------------

--
-- Table structure for table `dr_scores`
--

CREATE TABLE `dr_scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `score1` int(1) UNSIGNED NOT NULL COMMENT 'اثر بخشی',
  `score2` int(1) UNSIGNED NOT NULL COMMENT 'بسته بندی',
  `score3` int(1) UNSIGNED NOT NULL COMMENT 'ارزش نسبت به قیمت',
  `userid` bigint(20) UNSIGNED NOT NULL,
  `insert_time` datetime NOT NULL,
  `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_scores`
--

INSERT INTO `dr_scores` (`id`, `productid`, `score1`, `score2`, `score3`, `userid`, `insert_time`, `ip`, `device`) VALUES
(1, 6, 3, 4, 5, 15, '2020-11-11 17:53:15', '::1', 'Unknown - Windows 10 - Chrome 86.0.4240');

-- --------------------------------------------------------

--
-- Table structure for table `dr_short_message_services`
--

CREATE TABLE `dr_short_message_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_short_message_services`
--

INSERT INTO `dr_short_message_services` (`id`, `productid`, `userid`) VALUES
(3, 6, 15),
(4, 6, 15),
(5, 6, 15),
(6, 6, 15),
(7, 6, 15),
(8, 6, 15),
(9, 6, 15),
(10, 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `dr_tags`
--

CREATE TABLE `dr_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_tags`
--

INSERT INTO `dr_tags` (`id`, `name`) VALUES
(1, 'filter 1'),
(2, 'filter 2');

-- --------------------------------------------------------

--
-- Table structure for table `dr_tastes`
--

CREATE TABLE `dr_tastes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `taste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dr_tastes`
--

INSERT INTO `dr_tastes` (`id`, `taste`, `icon`) VALUES
(1, 'بدون طعم', 'http://localhost/zhivafit/public/taste/15.jpg'),
(2, 'طعم', 'http://localhost/zhivafit/public/taste/galleryb.png');

-- --------------------------------------------------------

--
-- Table structure for table `meta_navigations`
--

CREATE TABLE `meta_navigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `navid` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meta_navigations`
--

INSERT INTO `meta_navigations` (`id`, `navid`, `title`, `description`, `keywords`, `content`) VALUES
(1, 15, 'title', 'description', 'keywords', '<p>content</p>');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lft` int(10) UNSIGNED NOT NULL,
  `rgt` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `lft`, `rgt`, `name`, `slug`, `feature`) VALUES
(1, 3, 4, 'پروتئین وی', 'shop/whey-protein', 0),
(2, 5, 6, 'گینر', 'shop/gainer', 0),
(3, 7, 8, 'کازئین', 'shop/casein', 0),
(4, 2, 9, 'پروتئین', 'shop/protein', 1),
(5, 11, 12, 'قبل تمرین', 'shop/pre-workout', 0),
(6, 13, 14, 'حین تمرین', 'shop/intra-workout', 0),
(7, 15, 16, 'پس از تمرین', 'shop/post-workout', 0),
(8, 17, 18, 'انرژی و استقامت', 'shop/energy', 0),
(9, 10, 19, 'افزایش عملکرد', 'shop/performance', 2),
(10, 21, 22, 'چربی سوز', 'shop/fat-burner', 0),
(11, 23, 24, 'کنترل اشتها', 'shop/appetite-control', 0),
(12, 25, 26, 'سی ال ای', 'shop/cla', 0),
(13, 27, 28, 'ال کارنتین', 'shop/l-carnitine', 0),
(14, 20, 29, 'مدیریت وزن', 'shop/weight-management', 3),
(15, 1, 30, 'مکمل ها', 'shop/', 0),
(16, 31, 48, 'مجله', 'blog/', 1),
(17, 49, 54, 'مربیان', 'coaches/', 0),
(49, 33, 34, 'منو جدید 2', 'shop/', 0),
(50, 35, 36, 'منو جدید 4', 'shop/', 0),
(51, 32, 37, 'منو جدید 1', 'shop/', 1),
(52, 39, 40, 'منو جدید 1', 'shop/', 0),
(53, 38, 41, 'منو جدید 3', 'shop/', 0),
(54, 43, 44, 'منو جدید 2', 'shop/', 0),
(55, 45, 46, 'منو جدید 3', 'shop/', 0),
(56, 42, 47, 'منو جدید 1', 'shop/', 0),
(57, 51, 52, 'منو جدید 2', 'shop/', 0),
(58, 50, 53, 'منو جدید 1', 'shop/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'expire, due date, done' CHECK (json_valid(`custom`)),
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `userid`, `title`, `content`, `custom`, `seen`, `created_at`) VALUES
(1, 15, 'مبل و دکوراسیون توکامارت', 'خرید مبل به صورت اینترنتی همواره چالش‌های فراوانی برای مشتریان و فروشگاه های آنلاین مبل داشته که حل آن‌ها نیازمند مطالعه و تحقیق دقیق در زمینه بازار مبل، رفتار مشتریان هنگام خرید مبل، چه به صورت آنلاین و چه خرید حضوری، و البته آشنایی کامل با این صنعت و تولید و فروش مبل است. ما در توکامارت با تجربه بیش از 10 سال تولید و عرضه انواع مدل های مبلمان استیل یا همان سلطنتی، مبل کلاسیک و راحتی و سرویس خواب و سایر محصولات صنعت دکوراسیون، به خوبی با بازار این صنعت آشنا هستیم و از سلایق گوناگون مردم ایران در این حوزه کاملاً آگاهیم.', '{\"expire\": \"2020-11-23 14:43:20\", \"key2\": \"value2\"}', 0, '2020-09-20 15:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `province` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province`) VALUES
(1, 'آذربايجان شرقي'),
(2, 'آذربايجان غربي'),
(3, 'اردبيل'),
(4, 'اصفهان'),
(5, 'البرز'),
(6, 'ايلام'),
(7, 'بوشهر'),
(8, 'تهران'),
(9, 'چهارمحال بختياري'),
(10, 'خراسان جنوبي'),
(11, 'خراسان رضوي'),
(12, 'خراسان شمالي'),
(13, 'خوزستان'),
(14, 'زنجان'),
(15, 'سمنان'),
(16, 'سيستان و بلوچستان'),
(17, 'فارس'),
(18, 'قزوين'),
(19, 'قم'),
(20, 'كردستان'),
(21, 'كرمان'),
(22, 'كرمانشاه'),
(23, 'كهكيلويه و بويراحمد'),
(24, 'گلستان'),
(25, 'گيلان'),
(26, 'لرستان'),
(27, 'مازندران'),
(28, 'مركزي'),
(29, 'هرمزگان'),
(30, 'همدان'),
(31, 'يزد');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `accessibility` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'admin=1,drugStore=2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mobile`, `pass`, `active`, `accessibility`) VALUES
(15, '09211403302', '$2y$10$8biT3ordSpWtG5hdYcLdh.0BzZ/5aAq8sB9Kzr20gfUQqo4OAn8zu', 1, 1),
(16, '09211403303', '$2y$10$DNW.nlvr.xcg2kbJmMZYc.cKw7aoODK7xPOOFosn6qz3vd047tHH2', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active_user` (`userid`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_address` (`customerid`),
  ADD KEY `city_address` (`cityid`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_province` (`provinceid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_customer` (`userid`);

--
-- Indexes for table `dr_comments`
--
ALTER TABLE `dr_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_product` (`productid`),
  ADD KEY `comment_user` (`userid`);

--
-- Indexes for table `dr_countries`
--
ALTER TABLE `dr_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_factors`
--
ALTER TABLE `dr_factors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factor_user` (`addressid`);

--
-- Indexes for table `dr_helpful_comments`
--
ALTER TABLE `dr_helpful_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_helpful` (`commentid`),
  ADD KEY `user_commenting_comment` (`userid`);

--
-- Indexes for table `dr_hottest_products`
--
ALTER TABLE `dr_hottest_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hot_product` (`productid`);

--
-- Indexes for table `dr_manufacturers`
--
ALTER TABLE `dr_manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_country` (`countryid`);

--
-- Indexes for table `dr_meta_products`
--
ALTER TABLE `dr_meta_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `dr_meta_tags`
--
ALTER TABLE `dr_meta_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_tag_product` (`productid`),
  ADD KEY `listTags_tag` (`tagid`);

--
-- Indexes for table `dr_nutritions`
--
ALTER TABLE `dr_nutritions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nutrition_product` (`productid`);

--
-- Indexes for table `dr_products`
--
ALTER TABLE `dr_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metaid` (`metaid`);

--
-- Indexes for table `dr_product_details`
--
ALTER TABLE `dr_product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_detail` (`productid`);

--
-- Indexes for table `dr_product_manufacturers`
--
ALTER TABLE `dr_product_manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_manufacturer` (`productid`),
  ADD KEY `manufacturerList_manufacturer` (`manufacturerid`);

--
-- Indexes for table `dr_product_navs`
--
ALTER TABLE `dr_product_navs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_menu` (`productid`),
  ADD KEY `nav_category` (`navid`);

--
-- Indexes for table `dr_product_options`
--
ALTER TABLE `dr_product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_option` (`productid`);

--
-- Indexes for table `dr_product_tastes`
--
ALTER TABLE `dr_product_tastes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_taste` (`optionid`),
  ADD KEY `taste_list` (`tasteid`);

--
-- Indexes for table `dr_properties`
--
ALTER TABLE `dr_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_property` (`productid`);

--
-- Indexes for table `dr_scores`
--
ALTER TABLE `dr_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_product` (`productid`),
  ADD KEY `score_user` (`userid`);

--
-- Indexes for table `dr_short_message_services`
--
ALTER TABLE `dr_short_message_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_product` (`productid`),
  ADD KEY `sms_user` (`userid`);

--
-- Indexes for table `dr_tags`
--
ALTER TABLE `dr_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dr_tastes`
--
ALTER TABLE `dr_tastes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_navigations`
--
ALTER TABLE `meta_navigations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_nav` (`navid`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_news` (`userid`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dr_comments`
--
ALTER TABLE `dr_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dr_countries`
--
ALTER TABLE `dr_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `dr_factors`
--
ALTER TABLE `dr_factors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dr_helpful_comments`
--
ALTER TABLE `dr_helpful_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dr_hottest_products`
--
ALTER TABLE `dr_hottest_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dr_manufacturers`
--
ALTER TABLE `dr_manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dr_meta_products`
--
ALTER TABLE `dr_meta_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dr_meta_tags`
--
ALTER TABLE `dr_meta_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dr_nutritions`
--
ALTER TABLE `dr_nutritions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dr_products`
--
ALTER TABLE `dr_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dr_product_details`
--
ALTER TABLE `dr_product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `dr_product_manufacturers`
--
ALTER TABLE `dr_product_manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dr_product_navs`
--
ALTER TABLE `dr_product_navs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dr_product_options`
--
ALTER TABLE `dr_product_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dr_product_tastes`
--
ALTER TABLE `dr_product_tastes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dr_properties`
--
ALTER TABLE `dr_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dr_scores`
--
ALTER TABLE `dr_scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dr_short_message_services`
--
ALTER TABLE `dr_short_message_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dr_tags`
--
ALTER TABLE `dr_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dr_tastes`
--
ALTER TABLE `dr_tastes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meta_navigations`
--
ALTER TABLE `meta_navigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activations`
--
ALTER TABLE `activations`
  ADD CONSTRAINT `active_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `city_address` FOREIGN KEY (`cityid`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_address` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `city_province` FOREIGN KEY (`provinceid`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `user_customer` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_comments`
--
ALTER TABLE `dr_comments`
  ADD CONSTRAINT `comment_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_factors`
--
ALTER TABLE `dr_factors`
  ADD CONSTRAINT `factor_user` FOREIGN KEY (`addressid`) REFERENCES `addresses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_helpful_comments`
--
ALTER TABLE `dr_helpful_comments`
  ADD CONSTRAINT `comment_helpful` FOREIGN KEY (`commentid`) REFERENCES `dr_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_commenting_comment` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_hottest_products`
--
ALTER TABLE `dr_hottest_products`
  ADD CONSTRAINT `hot_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_manufacturers`
--
ALTER TABLE `dr_manufacturers`
  ADD CONSTRAINT `manufacturer_country` FOREIGN KEY (`countryid`) REFERENCES `dr_countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_meta_tags`
--
ALTER TABLE `dr_meta_tags`
  ADD CONSTRAINT `listTags_tag` FOREIGN KEY (`tagid`) REFERENCES `dr_tags` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_tag_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_nutritions`
--
ALTER TABLE `dr_nutritions`
  ADD CONSTRAINT `nutrition_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_products`
--
ALTER TABLE `dr_products`
  ADD CONSTRAINT `product_meta` FOREIGN KEY (`metaid`) REFERENCES `dr_meta_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_product_details`
--
ALTER TABLE `dr_product_details`
  ADD CONSTRAINT `product_detail` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_product_manufacturers`
--
ALTER TABLE `dr_product_manufacturers`
  ADD CONSTRAINT `manufacturerList_manufacturer` FOREIGN KEY (`manufacturerid`) REFERENCES `dr_manufacturers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_manufacturer` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_product_navs`
--
ALTER TABLE `dr_product_navs`
  ADD CONSTRAINT `nav_category` FOREIGN KEY (`navid`) REFERENCES `navigations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_menu` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_product_options`
--
ALTER TABLE `dr_product_options`
  ADD CONSTRAINT `product_option` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_product_tastes`
--
ALTER TABLE `dr_product_tastes`
  ADD CONSTRAINT `option_taste` FOREIGN KEY (`optionid`) REFERENCES `dr_product_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `taste_list` FOREIGN KEY (`tasteid`) REFERENCES `dr_tastes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_properties`
--
ALTER TABLE `dr_properties`
  ADD CONSTRAINT `product_property` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_scores`
--
ALTER TABLE `dr_scores`
  ADD CONSTRAINT `score_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `score_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dr_short_message_services`
--
ALTER TABLE `dr_short_message_services`
  ADD CONSTRAINT `sms_product` FOREIGN KEY (`productid`) REFERENCES `dr_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sms_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meta_navigations`
--
ALTER TABLE `meta_navigations`
  ADD CONSTRAINT `meta_nav` FOREIGN KEY (`navid`) REFERENCES `navigations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `user_news` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
