-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-06-23 10:08:07
-- 服务器版本： 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_manage`
--

-- --------------------------------------------------------

--
-- 表的结构 `academy`
--

CREATE TABLE `academy` (
  `id` int(11) NOT NULL,
  `academy_no` varchar(25) CHARACTER SET utf8 NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `academy`
--

INSERT INTO `academy` (`id`, `academy_no`, `name`, `address`) VALUES
(1, '9656AD21', '信息科学与技术学院', '成都理工大学第五教学楼'),
(2, '9651AD23', '数学学院', '成都理工大学第一教学楼'),
(3, '9585AD22', '机械工程学院', '成都理工大学第二教学楼'),
(4, '9685AD21', '材料科学与工程学院', '成都理工大学第三教学楼'),
(5, '9696AD12', '法学院', '成都理工大学第四教学楼'),
(6, '8541AD21', '能源与动力工程学院', '成都理工大学第六教学楼'),
(7, '9652AD21', '口腔医学院', '成都理工大学第七教学楼'),
(8, '9876AD25', ' 管理学院', '成都理工大学第八教学楼'),
(9, '9956AD23', '环境研究院', '成都理工大学第九教学楼'),
(10, '8796AD21', ' 控制科学与工程学院', '成都理工大学第十教学楼');

-- --------------------------------------------------------

--
-- 表的结构 `bulletin`
--

CREATE TABLE `bulletin` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `content` varchar(255) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bulletin`
--

INSERT INTO `bulletin` (`id`, `time`, `content`, `publisher_id`) VALUES
(1, '2018-04-13 16:29:45', '下周六将进行毕业生头像采集，地点六教。', 2),
(2, '2018-04-09 15:35:39', '这周四至周五运动会！', 1),
(3, '2018-04-13 21:58:37', '<p>重要通知：</p>\r\n<ol>\r\n<li>明天下雨。</li>\r\n<li>后天<strong>不放假</strong>。</li>\r\n<li>周日晚上不<em>上晚自习</em>。</li>\r\n</ol>', 2),
(5, '2018-05-04 21:32:25', '<p><a title=\"百度\" href=\"http://www.baidu.com\" target=\"_blank\">www.baidu.com</a>&nbsp;是一个近乎全能的搜索网站。</p>', 1);

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `year` varchar(4) CHARACTER SET utf8 NOT NULL,
  `class_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `num_people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`id`, `major_id`, `year`, `class_no`, `num_people`) VALUES
(1, 1, '4', '112212', 30),
(2, 2, '4', '113621', 30),
(3, 3, '4', '163542', 30),
(4, 4, '4', '169853', 30),
(5, 5, '4', '163524', 30),
(6, 6, '4', '514235', 30),
(7, 7, '4', '965652', 30),
(8, 8, '4', '523652', 30),
(9, 9, '4', '856412', 30),
(10, 10, '4', '857412', 30),
(11, 9, '4', '856412', 30),
(12, 10, '4', '857412', 30),
(13, 11, '4', '896512', 30),
(14, 12, '4', '874412', 30),
(15, 13, '4', '857856', 30),
(16, 14, '4', '858745', 30),
(17, 15, '4', '865212', 30),
(18, 16, '4', '886522', 30),
(19, 17, '4', '887452', 30),
(20, 18, '4', '965142', 30),
(21, 19, '4', '868412', 30),
(22, 20, '4', '854522', 30),
(23, 21, '4', '963521', 30),
(24, 22, '4', '857451', 30),
(25, 23, '4', '896524', 30),
(26, 26, '4', '965441', 30),
(27, 27, '4', '784512', 30),
(28, 28, '4', '748512', 30),
(29, 29, '4', '775412', 30),
(30, 30, '4', '632213', 30);

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_no` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `semester` varchar(20) NOT NULL,
  `period` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `credit` float NOT NULL,
  `if_optional` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `course_no`, `name`, `semester`, `period`, `teacher_id`, `credit`, `if_optional`) VALUES
(1, 'AC5124', '高等数学（一）', '2016-2017', 120, 1, 2.5, 0),
(2, 'AC1202', '大学体育（一）', '2016-2017', 120, 2, 3, 0),
(3, 'AC5121', '大学体育（二）', '2017-2018', 90, 2, 2.5, 1),
(4, 'AC5364', '形势与政策（4）', '2017-2018', 90, 1, 1.5, 1),
(6, 'AC5122', '系统分析与设计', '2017-2018', 120, 3, 2, 1),
(7, 'AC5299', '计算机信息基础', '2018-2019', 120, 3, 2.5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `major`
--

CREATE TABLE `major` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `major_num` varchar(20) CHARACTER SET utf8 NOT NULL,
  `class_num` int(11) NOT NULL,
  `academy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `major`
--

INSERT INTO `major` (`id`, `name`, `major_num`, `class_num`, `academy_id`) VALUES
(1, '计算机科学与技术', '653232', 3, 1),
(2, '信息安全', '653322', 3, 1),
(3, '网络工程', '632133', 3, 1),
(4, '通信工程', '562311', 4, 1),
(5, '电子信息工程', '635212', 5, 1),
(6, '软件工程', '653211', 4, 1),
(7, '统计学', '653532', 4, 2),
(8, '计算数学系', '653221', 5, 2),
(9, '金融数学系', '654432', 5, 2),
(10, '数学与应用数学', '653224', 4, 2),
(11, '信息与计算科学', '653355', 4, 2),
(12, '机械设计制造及其自动化', '663352', 4, 3),
(13, '材料成型及控制工程', '665322', 4, 3),
(14, '材料腐蚀与防护', '653431', 5, 4),
(15, '电子信息材料与材料设计', '663322', 5, 4),
(16, '材料加工工程与自动化', '654433', 5, 4),
(17, '思想政治教育系', '695451', 5, 5),
(18, '法律系', '693232', 5, 5),
(19, '政治学与行政管理系', '693532', 4, 5),
(20, '工程热力学', '698832', 4, 6),
(21, '电工与电子技术', '695564', 4, 6),
(22, '儿童口腔医学', '693211', 4, 7),
(23, '人体解剖学', '699621', 4, 7),
(24, '口腔解剖生理学', '688212', 5, 7),
(25, '行政管理', '988766', 3, 8),
(26, '财务管理', '968862', 3, 8),
(27, '工商管理', '968744', 4, 8),
(28, '市场营销', '857456', 3, 8),
(29, '环境规划与管理', '988554', 3, 9),
(30, '测控技术与仪器', '944113', 4, 10);

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'defult_user.jpg',
  `dob` date NOT NULL,
  `gender` varchar(2) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `detail` varchar(20) DEFAULT NULL,
  `enrolment` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '12345',
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`id`, `student_id`, `name`, `avatar`, `dob`, `gender`, `qq`, `phone`, `email`, `province`, `city`, `detail`, `enrolment`, `username`, `password`, `class_id`) VALUES
(1, '201513130117', '张雨绮', '5b1d024ee08b9.jpg', '1996-05-02', '女', '56214214', '028-24521965', '56214214@qq.com', '四川', '成都', '黄河小区', '2015-09-01', '054321', '12345', 1),
(2, '201513130101', '李彦龙', 'defult_user.jpg', '1996-05-01', '男', '56214212216', '028-24521965', '56214214@qq.com', '四川', '成都', '黄河小区', '2015-09-02', '058652', '12345', 1),
(3, '201513130321', '李宏娜', 'defult_user.jpg', '1998-01-12', '女', '58452215', '028-15421541', '58452215@qq.com', '四川', '成都', '建设南路1段', '2015-09-01', '015421', '12345', 1),
(4, '201513130110', '李凌薇', 'defult_user.jpg', '1996-10-21', '男', '85745121', '028-21205634', '85745121@qq.com', '四川', '成都', '剑南路2段21号', '2015-09-02', '012524', '12345', 1),
(5, '201513130121', '高洪', 'defult_user.jpg', '1997-05-11', '男', '', '028-20214121', '2541214@163.com', '四川', '成都', '水碾河2段', '2015-09-01', '511361', '12345', 1),
(7, '201613130302', '张秉心', 'defult_user.jpg', '1998-06-17', '男', '968812012', '028-54114230', '968812012@qq.com', '湖北', '宜昌', '绿茵小区', '2016-06-15', '824781', '12345', 2),
(8, '201613130302', '黄奕文', 'defult_user.jpg', '1998-07-21', '男', '9689611012', '028-54114230', '9689611012@qq.com', '湖北', '宜昌', '皇宫小区', '2016-06-02', '485699', '12345', 2),
(9, '201613130302', '黄诗语', 'defult_user.jpg', '1998-07-10', '女', '9682201012', '028-54114230', '9681102012@qq.com', '湖北', '宜昌', '皇宫小区', '2016-06-02', '146675', '12345', 2),
(10, '201613130101	', '何意杰', 'defult_user.jpg', '1997-10-14', '男', '024474123', '028-55411396', '024474123@qq.com', '重庆市', '重庆市', '和砂小区', '2015-06-11', '575932', '12345', 5),
(11, '201613130101', '何伟龙', 'defult_user.jpg', '1998-06-10', '男', '562143322', '028-22532542', '562143322@qq.com', '四川', '宜宾', '水碾河2段', '2016-09-09', '746820', '12345', 27);

-- --------------------------------------------------------

--
-- 表的结构 `student_course`
--

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `grade` float DEFAULT NULL,
  `grade_point` float DEFAULT NULL,
  `score_type` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `storage_time` datetime DEFAULT NULL,
  `storage_staff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `grade`, `grade_point`, `score_type`, `storage_time`, `storage_staff`) VALUES
(1, 1, 1, 81, 3.1, '正常', '2017-06-20 13:32:31', 2),
(2, 2, 1, 60, 0, '正常', '2018-06-10 18:40:18', 1),
(3, 3, 1, 54, 0, '正常', '2017-06-20 15:37:31', 2),
(4, 3, 3, 62, 1.2, '补考', '2018-01-20 13:30:27', 2),
(5, 4, 1, 71, 2.1, '正常', '2017-06-20 15:30:32', 2),
(6, 1, 2, 65, 1.5, '正常', '2017-06-20 16:42:44', 1),
(7, 2, 2, 73, 2.3, '正常', '2017-06-20 19:44:45', 1),
(8, 3, 2, 85, 3.5, '正常', '2017-06-20 17:43:43', 1),
(9, 4, 2, 67, 1.7, '正常', '2017-06-20 18:46:46', 1),
(12, 5, 3, 59, 0, '重修', '2018-05-15 17:04:30', 1),
(13, 5, 4, 60, 0, '正常', '2018-06-10 18:51:29', 1),
(14, 1, 7, NULL, NULL, NULL, NULL, NULL),
(18, 5, 6, NULL, NULL, NULL, NULL, NULL),
(19, 10, 4, NULL, NULL, NULL, NULL, NULL),
(22, 2, 1, NULL, NULL, NULL, NULL, NULL),
(23, 3, 7, NULL, NULL, NULL, NULL, NULL),
(36, 1, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `teacher_no` varchar(20) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'defult_user.jpg',
  `academic_title` varchar(25) CHARACTER SET utf8 NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(2) CHARACTER SET utf8 NOT NULL,
  `qq` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `inauguration_date` date NOT NULL,
  `leave_date` date DEFAULT NULL,
  `academy_id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '12345',
  `role` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`id`, `teacher_no`, `name`, `avatar`, `academic_title`, `dob`, `gender`, `qq`, `phone`, `email`, `inauguration_date`, `leave_date`, `academy_id`, `username`, `password`, `role`) VALUES
(1, '5621621212', '陈伟杰', 'defult_user.jpg', '教授', '1957-01-21', '男', '', '028-52412546', '524125@163.com', '1976-06-28', NULL, 1, '012312', '12345', '2'),
(2, '5621621216', '李昊然', 'defult_user.jpg', '副教授', '1959-05-12', '男', '95624125', '028-96585124', '95624125@qq.com', '1979-06-10', NULL, 1, '012345', '12345', '1'),
(3, '5621621217', '满兴隆', 'defult_user.jpg', '讲师', '1974-12-04', '男', '586522365', '028-542521452', '586522365@qq.com', '1995-05-15', '0000-00-00', 7, '254621', '12345', '1'),
(4, '5621621213', '梦何然', 'defult_user.jpg', '讲师', '1970-02-04', '女', '84561254121', '028-96898554', '84561254121@qq.com', '2011-02-09', '0000-00-00', 9, '689010', '12345', '1'),
(5, '5621521214', '胡文语', 'defult_user.jpg', '讲师', '1989-05-11', '男', '9685344', '028-69664742', '9685344@qq.com', '2014-02-05', '0000-00-00', 2, '400167', '12345', '1'),
(6, '8577142325', '王子莫', 'defult_user.jpg', '讲师', '1985-01-28', '女', '85521112', '028-52442358', '85521112@qq.com', '2015-06-11', '2018-05-28', 3, '449813', '12345', '1'),
(7, '4075274419', '廖杰', 'defult_user.jpg', '讲师', '1979-05-30', '男', '', '028-65885212', '', '1999-05-04', '2018-02-20', 3, '833032', '12345', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bulletin_fk0` (`publisher_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_fk0` (`major_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_fk0` (`teacher_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major_fk0` (`academy_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_fk0` (`class_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_course_fk0` (`student_id`),
  ADD KEY `student_course_fk1` (`course_id`),
  ADD KEY `student_course_fk2` (`storage_staff`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_fk0` (`academy_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `academy`
--
ALTER TABLE `academy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `major`
--
ALTER TABLE `major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用表AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 限制导出的表
--

--
-- 限制表 `bulletin`
--
ALTER TABLE `bulletin`
  ADD CONSTRAINT `bulletin_fk0` FOREIGN KEY (`publisher_id`) REFERENCES `teacher` (`id`);

--
-- 限制表 `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_fk0` FOREIGN KEY (`major_id`) REFERENCES `major` (`id`);

--
-- 限制表 `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_fk0` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`);

--
-- 限制表 `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_fk0` FOREIGN KEY (`academy_id`) REFERENCES `academy` (`id`);

--
-- 限制表 `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_fk0` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- 限制表 `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_fk0` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_course_fk1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `student_course_fk2` FOREIGN KEY (`storage_staff`) REFERENCES `teacher` (`id`);

--
-- 限制表 `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_fk0` FOREIGN KEY (`academy_id`) REFERENCES `academy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
